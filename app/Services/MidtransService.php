<?php
// app/Services/MidtransService.php

namespace App\Services;

use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Transaction;
use App\Models\Payment;
use App\Models\Proposal;
use App\Models\AdminWallet;
use App\Models\Conversation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MidtransService
{
    public function __construct()
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');
    }

    public function createTransaction(Payment $payment)
    {
        $params = [
            'transaction_details' => [
                'order_id' => $payment->payment_id,
                'gross_amount' => $payment->amount,
            ],
            'customer_details' => [
                'first_name' => $payment->client->name,
                'email' => $payment->client->email,
                'phone' => $payment->client->clientProfile->phone ?? '',
            ],
            'item_details' => [
                [
                    'id' => $payment->project->id,
                    'price' => $payment->amount,
                    'quantity' => 1,
                    'name' => $payment->project->title,
                    'category' => $payment->project->category ?? 'Freelance Project'
                ]
            ],
            'callbacks' => [
                'finish' => route('payment.success', $payment->payment_id),
                'unfinish' => route('payment.pending', $payment->payment_id),
                'error' => route('payment.failed', $payment->payment_id)
            ]
        ];

        try {
            $snapToken = Snap::getSnapToken($params);
            return $snapToken;
        } catch (\Exception $e) {
            throw new \Exception('Failed to create Midtrans transaction: ' . $e->getMessage());
        }
    }

    public function getTransactionStatus($orderId)
    {
        try {
            $status = Transaction::status($orderId);
            return $status;
        } catch (\Exception $e) {
            throw new \Exception('Failed to get transaction status: ' . $e->getMessage());
        }
    }

    public function handleNotification($notification)
    {
        try {
            $notif = new \Midtrans\Notification();
            
            $transaction = $notif->transaction_status;
            $type = $notif->payment_type;
            $order_id = $notif->order_id;
            $fraud = $notif->fraud_status;

            $payment = Payment::where('payment_id', $order_id)->first();

            if (!$payment) {
                throw new \Exception('Payment not found for order ID: ' . $order_id);
            }

            if ($transaction == 'capture') {
                if ($type == 'credit_card') {
                    if ($fraud == 'challenge') {
                        $payment->update([
                            'status' => 'pending',
                            'midtrans_transaction_status' => $transaction,
                            'midtrans_response' => $notif
                        ]);
                    } else {
                        // ✅ SUCCESS: Credit Admin Wallet
                        $this->processSuccessPayment($payment, $transaction, $notif);
                    }
                }
            } else if ($transaction == 'settlement') {
                // ✅ SUCCESS: Credit Admin Wallet
                $this->processSuccessPayment($payment, $transaction, $notif);

            } else if ($transaction == 'pending') {
                $payment->update([
                    'status' => 'pending',
                    'midtrans_transaction_status' => $transaction,
                    'midtrans_response' => $notif
                ]);
            } else if ($transaction == 'deny') {
                $payment->update([
                    'status' => 'failed',
                    'midtrans_transaction_status' => $transaction,
                    'midtrans_response' => $notif
                ]);
            } else if ($transaction == 'expire') {
                $payment->update([
                    'status' => 'failed',
                    'midtrans_transaction_status' => $transaction,
                    'midtrans_response' => $notif
                ]);
            } else if ($transaction == 'cancel') {
                $payment->update([
                    'status' => 'cancelled',
                    'midtrans_transaction_status' => $transaction,
                    'midtrans_response' => $notif
                ]);
            }

            return $payment;

        } catch (\Exception $e) {
            throw new \Exception('Failed to handle notification: ' . $e->getMessage());
        }
    }

    // ✅ PRIVATE METHOD BARU: Process Success Payment
    private function processSuccessPayment($payment, $transaction, $notif)
    {
        DB::beginTransaction();
        try {
            // 1. Update payment status
            $payment->update([
                'status' => 'success',
                'midtrans_transaction_status' => $transaction,
                'midtrans_response' => $notif,
                'paid_at' => now()
            ]);

            // 2. ✅ CREDIT ADMIN WALLET
            $this->creditAdminWallet($payment);

            // 3. Accept proposal
            $this->acceptProposal($payment);

            // 4. Create conversation
            $this->createConversation($payment);

            DB::commit();

            Log::info('Payment success processed', [
                'payment_id' => $payment->payment_id,
                'admin_wallet_credited' => true
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to process success payment: ' . $e->getMessage());
            throw $e;
        }
    }

    // ✅ CREDIT ADMIN WALLET (ESCROW)
    private function creditAdminWallet($payment)
    {
        try {
            $adminWallet = AdminWallet::getWallet();

            // Tambah saldo service (untuk freelancer nanti)
            $adminWallet->creditService(
                $payment->service_amount,
                "Pembayaran masuk dari Project #{$payment->project_id} - Service Fee (Escrow)",
                $payment->id
            );

            // Tambah saldo admin fee (keuntungan platform)
            $adminWallet->creditAdminFee(
                $payment->admin_fee,
                "Pembayaran masuk dari Project #{$payment->project_id} - Admin Fee (2.5%)",
                $payment->id
            );

            Log::info('Admin wallet credited', [
                'payment_id' => $payment->payment_id,
                'service_amount' => $payment->service_amount,
                'admin_fee' => $payment->admin_fee
            ]);

        } catch (\Exception $e) {
            Log::error('Failed to credit admin wallet: ' . $e->getMessage());
            throw $e;
        }
    }

    private function acceptProposal(Payment $payment)
    {
        $payment->proposal->update(['status' => 'accepted']);

        Proposal::where('project_id', $payment->project_id)
            ->where('id', '!=', $payment->proposal_id)
            ->update(['status' => 'rejected']);
    }

    private function createConversation($payment)
    {
        $existing = Conversation::where('project_id', $payment->project_id)
            ->where('client_id', $payment->client_id)
            ->where('freelancer_id', $payment->freelancer_id)
            ->first();
        
        if ($existing) {
            return $existing;
        }
        
        return Conversation::create([
            'project_id' => $payment->project_id,
            'client_id' => $payment->client_id,
            'freelancer_id' => $payment->freelancer_id,
            'proposal_id' => $payment->proposal_id,
            'last_message_at' => now(),
        ]);
    }
}