<?php
// app/Http/Controllers/Admin/WithdrawalController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Wallet;
use App\Models\Withdrawal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class WithdrawalController extends Controller
{
    public function index(Request $request)
    {
        // Get filter status from request
        $status = $request->get('status');
        
        // Query withdrawals
        $query = Withdrawal::with(['user', 'processedBy'])->latest();
        
        // Apply status filter if provided
        if ($status && $status !== 'all') {
            $query->where('status', $status);
        }
        
        // Paginate results
        $withdrawals = $query->paginate(20);

        return view('admin.withdrawals.index', compact('withdrawals'));
    }

    public function show(Withdrawal $withdrawal)
    {
        $withdrawal->load(['user', 'wallet', 'processedBy']);
        return view('admin.withdrawals.show', compact('withdrawal'));
    }

    public function approve(Withdrawal $withdrawal)
    {
        if ($withdrawal->status !== 'pending') {
            return back()->with('error', 'Penarikan ini tidak bisa disetujui.');
        }

        try {
            DB::beginTransaction();

            $withdrawal->status = 'approved';
            $withdrawal->processed_by = Auth::id();
            $withdrawal->processed_at = now();
            $withdrawal->save();

            DB::commit();

            Log::info('Withdrawal approved', [
                'withdrawal_id' => $withdrawal->withdrawal_id,
                'admin_id' => Auth::id()
            ]);

            return back()->with('success', 'Penarikan berhasil disetujui!');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Withdrawal approval error: ' . $e->getMessage());
            return back()->with('error', 'Gagal menyetujui penarikan.');
        }
    }

    public function complete(Request $request, Withdrawal $withdrawal)
    {
        if (!in_array($withdrawal->status, ['pending', 'approved'])) {
            return back()->with('error', 'Penarikan ini tidak bisa diselesaikan.');
        }

        $request->validate([
            'proof_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'admin_notes' => 'nullable|string|max:500'
        ]);

        try {
            DB::beginTransaction();

            // Get wallet with lock
            $wallet = Wallet::lockForUpdate()->find($withdrawal->wallet_id);

            if (!$wallet) {
                DB::rollBack();
                return back()->with('error', 'Wallet tidak ditemukan.');
            }

            // Pastikan pending balance cukup
            if ($wallet->pending_balance < $withdrawal->amount) {
                DB::rollBack();
                return back()->with('error', 'Saldo pending tidak mencukupi.');
            }

            // Upload proof
            $proofPath = $request->file('proof_image')->store('withdrawal-proofs', 'public');

            // Update withdrawal status
            $withdrawal->status = 'completed';
            $withdrawal->processed_by = Auth::id();
            $withdrawal->processed_at = now();
            $withdrawal->admin_notes = $request->admin_notes;
            $withdrawal->proof_image = $proofPath;
            $withdrawal->save();

            // PENTING: Kurangi pending_balance
            $wallet->pending_balance -= $withdrawal->amount;
            $wallet->save();

            DB::commit();

            Log::info('Withdrawal completed', [
                'withdrawal_id' => $withdrawal->withdrawal_id,
                'amount' => $withdrawal->amount,
                'admin_id' => Auth::id(),
                'remaining_pending' => $wallet->pending_balance
            ]);

            return back()->with('success', 'Penarikan berhasil diselesaikan dan saldo pending telah dikurangi!');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Withdrawal completion error: ' . $e->getMessage());
            return back()->with('error', 'Gagal menyelesaikan penarikan: ' . $e->getMessage());
        }
    }

    public function reject(Request $request, Withdrawal $withdrawal)
    {
        if ($withdrawal->status !== 'pending') {
            return back()->with('error', 'Penarikan ini tidak bisa ditolak.');
        }

        $request->validate([
            'admin_notes' => 'required|string|max:500'
        ]);

        try {
            DB::beginTransaction();

            // Get wallet with lock
            $wallet = Wallet::lockForUpdate()->find($withdrawal->wallet_id);

            if (!$wallet) {
                DB::rollBack();
                return back()->with('error', 'Wallet tidak ditemukan.');
            }

            // Update withdrawal status
            $withdrawal->status = 'rejected';
            $withdrawal->processed_by = Auth::id();
            $withdrawal->processed_at = now();
            $withdrawal->admin_notes = $request->admin_notes;
            $withdrawal->save();

            // PENTING: Kembalikan saldo dari pending ke balance
            $wallet->pending_balance -= $withdrawal->amount;
            $wallet->balance += $withdrawal->amount;
            $wallet->save();

            DB::commit();

            Log::info('Withdrawal rejected', [
                'withdrawal_id' => $withdrawal->withdrawal_id,
                'admin_id' => Auth::id(),
                'reason' => $request->admin_notes
            ]);

            return back()->with('success', 'Penarikan ditolak dan saldo dikembalikan ke user.');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Withdrawal rejection error: ' . $e->getMessage());
            return back()->with('error', 'Gagal menolak penarikan: ' . $e->getMessage());
        }
    }
}