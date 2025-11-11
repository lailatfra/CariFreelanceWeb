<?php
// app/Services/MidtransService.php

namespace App\Services;

use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Transaction;
use App\Models\Payment;

class MidtransService
{
    public function __construct()
    {
        // Set your Midtrans credentials
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
                        $payment->update([
                            'status' => 'success',
                            'midtrans_transaction_status' => $transaction,
                            'midtrans_response' => $notif,
                            'paid_at' => now()
                        ]);

                        // Accept the proposal
                        $this->acceptProposal($payment);
                    }
                }
            } else if ($transaction == 'settlement') {
                $payment->update([
                    'status' => 'success',
                    'midtrans_transaction_status' => $transaction,
                    'midtrans_response' => $notif,
                    'paid_at' => now()
                ]);

                // Accept the proposal
                $this->acceptProposal($payment);

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

    private function acceptProposal(Payment $payment)
    {
        // Set proposal status to accepted
        $payment->proposal->update(['status' => 'accepted']);

        // Reject other proposals for the same project
        \App\Models\Proposal::where('project_id', $payment->project_id)
            ->where('id', '!=', $payment->proposal_id)
            ->update(['status' => 'rejected']);
    }
}