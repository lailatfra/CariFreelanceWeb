<?php
// app/Http/Controllers/PaymentController.php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Proposal;
use App\Services\MidtransService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    protected $midtransService;
    
    // Admin fee percentage (2.5%)
    const ADMIN_FEE_PERCENTAGE = 2.5;

    public function __construct(MidtransService $midtransService)
    {
        $this->midtransService = $midtransService;
    }

    public function show(Proposal $proposal)
    {
        // Pastikan proposal ini milik project dari client yang login
        if ($proposal->project->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // Pastikan proposal masih pending
        if ($proposal->status !== 'pending') {
            return redirect()->route('projek')->with('error', 'Proposal ini sudah tidak dapat diproses.');
        }

        // Load relasi yang dibutuhkan
        $proposal->load(['user.freelancerProfile', 'project']);

        // Hitung biaya admin dan total
        $serviceAmount = $proposal->proposal_price;
        $adminFee = $serviceAmount * (self::ADMIN_FEE_PERCENTAGE / 100);
        $totalAmount = $serviceAmount + $adminFee;

        // Pass data ke view
        return view('client.payment.show', compact('proposal', 'serviceAmount', 'adminFee', 'totalAmount'));
    }

    public function processPayment(Request $request, Proposal $proposal)
    {
        try {
            // Validasi proposal
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

            // Hitung biaya
            $serviceAmount = $proposal->proposal_price;
            $adminFee = $serviceAmount * (self::ADMIN_FEE_PERCENTAGE / 100);
            $totalAmount = $serviceAmount + $adminFee;

            // Buat payment record
            $payment = new Payment();
            $payment->payment_id = $payment->generatePaymentId();
            $payment->proposal_id = $proposal->id;
            $payment->client_id = Auth::id();
            $payment->freelancer_id = $proposal->user_id;
            $payment->project_id = $proposal->project_id;
            $payment->service_amount = $serviceAmount;
            $payment->admin_fee = $adminFee;
            $payment->amount = $totalAmount; // Total amount including admin fee
            $payment->status = 'pending';
            $payment->save();

            // Buat Midtrans transaction
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

            // Get latest status from Midtrans
            try {
                $midtransStatus = $this->midtransService->getTransactionStatus($paymentId);
                
                // Update payment status based on Midtrans response
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

    private function updatePaymentStatusFromMidtrans($payment, $midtransStatus)
    {
        $transactionStatus = $midtransStatus->transaction_status;

        if (in_array($transactionStatus, ['settlement', 'capture'])) {
            $payment->update([
                'status' => 'success',
                'midtrans_transaction_status' => $transactionStatus,
                'midtrans_response' => $midtransStatus,
                'paid_at' => now()
            ]);

            // Accept proposal
            $payment->proposal->update(['status' => 'accepted']);
            
            // Reject other proposals
            Proposal::where('project_id', $payment->project_id)
                ->where('id', '!=', $payment->proposal_id)
                ->update(['status' => 'rejected']);

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