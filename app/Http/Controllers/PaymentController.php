<?php
// app/Http/Controllers/PaymentController.php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Proposal;
use App\Models\Wallet;
use App\Models\AdminWallet;
use App\Services\MidtransService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Conversation;

class PaymentController extends Controller
{
    protected $midtransService;
    
    const ADMIN_FEE_PERCENTAGE = 2.5;

    public function __construct(MidtransService $midtransService)
    {
        $this->midtransService = $midtransService;
    }

    public function show(Proposal $proposal)
    {
        if ($proposal->project->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        if ($proposal->status !== 'pending') {
            return redirect()->route('projek')->with('error', 'Proposal ini sudah tidak dapat diproses.');
        }

        $proposal->load(['user.freelancerProfile', 'project']);

        $serviceAmount = $proposal->proposal_price;
        $adminFee = $serviceAmount * (self::ADMIN_FEE_PERCENTAGE / 100);
        $totalAmount = $serviceAmount + $adminFee;

        return view('client.payment.show', compact('proposal', 'serviceAmount', 'adminFee', 'totalAmount'));
    }

    public function processPayment(Request $request, Proposal $proposal)
    {
        try {
            if ($proposal->project->user_id !== Auth::id()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized action.'
                ], 403);
            }

            if ($proposal->status !== 'pending') {
                return response()->json([
                    'success' => false,
                    'message' => 'Proposal sudah tidak dapat diproses.'
                ], 400);
            }

            DB::beginTransaction();

            $serviceAmount = $proposal->proposal_price;
            $adminFee = $serviceAmount * (self::ADMIN_FEE_PERCENTAGE / 100);
            $totalAmount = $serviceAmount + $adminFee;

            $payment = Payment::create([
                'payment_id' => (new Payment)->generatePaymentId(),
                'proposal_id' => $proposal->id,
                'client_id' => Auth::id(),
                'freelancer_id' => $proposal->user_id,
                'project_id' => $proposal->project_id,
                'service_amount' => $serviceAmount,
                'admin_fee' => $adminFee,
                'amount' => $totalAmount,
                'status' => 'pending'
            ]);

            $snapToken = $this->midtransService->createTransaction($payment);

            DB::commit();

            return response()->json([
                'success' => true,
                'snap_token' => $snapToken,
                'payment_id' => $payment->payment_id
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Payment process error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Gagal memproses pembayaran: ' . $e->getMessage()
            ], 500);
        }
    }

    public function success($paymentId)
    {
        $payment = Payment::where('payment_id', $paymentId)->first();
        
        if (!$payment) {
            return redirect()->route('projek')->with('error', 'Payment tidak ditemukan.');
        }

        if ($payment->client_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('client.payment.success', compact('payment'));
    }

    public function pending($paymentId)
    {
        $payment = Payment::where('payment_id', $paymentId)->first();
        
        if (!$payment) {
            return redirect()->route('projek')->with('error', 'Payment tidak ditemukan.');
        }

        if ($payment->client_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('client.payment.pending', compact('payment'));
    }

    public function failed($paymentId)
    {
        $payment = Payment::where('payment_id', $paymentId)->first();
        
        if (!$payment) {
            return redirect()->route('projek')->with('error', 'Payment tidak ditemukan.');
        }

        if ($payment->client_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('client.payment.failed', compact('payment'));
    }

    public function notification(Request $request)
    {
        try {
            $payment = $this->midtransService->handleNotification($request->all());

            Log::info('Payment notification processed', [
                'payment_id' => $payment->payment_id,
                'status' => $payment->status
            ]);

            return response()->json(['status' => 'ok']);

        } catch (\Exception $e) {
            Log::error('Payment notification error: ' . $e->getMessage());
            return response()->json(['status' => 'error'], 500);
        }
    }

    public function checkStatus(Request $request, $paymentId)
    {
        try {
            $payment = Payment::where('payment_id', $paymentId)->first();
            
            if (!$payment) {
                return response()->json([
                    'success' => false,
                    'message' => 'Payment tidak ditemukan.'
                ], 404);
            }

            if ($payment->client_id !== Auth::id()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized action.'
                ], 403);
            }

            try {
                $midtransStatus = $this->midtransService->getTransactionStatus($paymentId);
                $this->updatePaymentStatusFromMidtrans($payment, $midtransStatus);
            } catch (\Exception $e) {
                Log::warning('Failed to get Midtrans status: ' . $e->getMessage());
            }

            return response()->json([
                'success' => true,
                'payment_status' => $payment->fresh()->status,
                'redirect_url' => $this->getRedirectUrl($payment)
            ]);

        } catch (\Exception $e) {
            Log::error('Check payment status error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengecek status pembayaran.'
            ], 500);
        }
    }

    // ✅ PANGGIL METHOD INI SAAT PAYMENT SUCCESS
    private function createConversation($payment)
    {
        $existingConversation = Conversation::where('project_id', $payment->project_id)
            ->where('client_id', $payment->client_id)
            ->where('freelancer_id', $payment->freelancer_id)
            ->first();
        
        if ($existingConversation) {
            return $existingConversation;
        }
        
        return Conversation::create([
            'project_id' => $payment->project_id,
            'client_id' => $payment->client_id,
            'freelancer_id' => $payment->freelancer_id,
            'proposal_id' => $payment->proposal_id,
            'last_message_at' => now(),
        ]);
    }

    // ✅ CREDIT KE ADMIN WALLET (ESCROW)
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

            Log::info('Admin wallet credited (escrow)', [
                'payment_id' => $payment->payment_id,
                'service_amount' => $payment->service_amount,
                'admin_fee' => $payment->admin_fee,
                'total_balance' => $adminWallet->total_balance
            ]);

            return true;

        } catch (\Exception $e) {
            Log::error('Failed to credit admin wallet: ' . $e->getMessage());
            throw $e;
        }
    }

    // ✅ UPDATE PAYMENT STATUS + CREDIT ADMIN WALLET
    private function updatePaymentStatusFromMidtrans($payment, $midtransStatus)
    {
        $transactionStatus = $midtransStatus->transaction_status;

        if (in_array($transactionStatus, ['settlement', 'capture'])) {
            DB::beginTransaction();
            try {
                // 1. Update payment status
                $payment->update([
                    'status' => 'success',
                    'midtrans_transaction_status' => $transactionStatus,
                    'midtrans_response' => $midtransStatus,
                    'paid_at' => now()
                ]);

                // 2. ✅ CREDIT ADMIN WALLET (INI YANG HILANG!)
                $this->creditAdminWallet($payment);

                // 3. Accept proposal
                $payment->proposal->update(['status' => 'accepted']);
                
                // 4. Reject other proposals
                Proposal::where('project_id', $payment->project_id)
                    ->where('id', '!=', $payment->proposal_id)
                    ->update(['status' => 'rejected']);

                // 5. Create conversation
                $this->createConversation($payment);

                DB::commit();

                Log::info('Payment success processed completely', [
                    'payment_id' => $payment->payment_id,
                    'admin_wallet_credited' => true
                ]);

            } catch (\Exception $e) {
                DB::rollBack();
                Log::error('Failed to process payment success: ' . $e->getMessage());
                throw $e;
            }

        } elseif ($transactionStatus === 'pending') {
            $payment->update([
                'status' => 'pending',
                'midtrans_transaction_status' => $transactionStatus,
                'midtrans_response' => $midtransStatus
            ]);
        } else {
            $payment->update([
                'status' => 'failed',
                'midtrans_transaction_status' => $transactionStatus,
                'midtrans_response' => $midtransStatus
            ]);
        }
    }

    private function getRedirectUrl($payment)
    {
        switch ($payment->status) {
            case 'success':
                return route('payment.success', $payment->payment_id);
            case 'pending':
                return route('payment.pending', $payment->payment_id);
            case 'failed':
                return route('payment.failed', $payment->payment_id);
            default:
                return route('projek');
        }
    }
}