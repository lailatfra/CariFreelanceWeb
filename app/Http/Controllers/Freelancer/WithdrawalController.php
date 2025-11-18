<?php
// app/Http/Controllers/Freelancer/WithdrawalController.php

namespace App\Http\Controllers\Freelancer;

use App\Http\Controllers\Controller;
use App\Models\Wallet;
use App\Models\Withdrawal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class WithdrawalController extends Controller
{
    // Minimum withdrawal amount
    const MIN_WITHDRAWAL = 50000; // Rp 50.000

    public function index()
    {
        $user = Auth::user();
        
        // Get wallet
        $wallet = Wallet::firstOrCreate(
            ['user_id' => $user->id],
            ['balance' => 0, 'pending_balance' => 0]
        );

        // Get withdrawal history
        $withdrawals = Withdrawal::where('user_id', $user->id)
            ->with('processedBy')
            ->latest()
            ->paginate(10);

        return view('freelancer.withdrawals.index', compact('wallet', 'withdrawals'));
    }

    public function create()
    {
        $user = Auth::user();
        
        $wallet = Wallet::firstOrCreate(
            ['user_id' => $user->id],
            ['balance' => 0, 'pending_balance' => 0]
        );

        // Check if there's pending withdrawal
        $hasPendingWithdrawal = Withdrawal::where('user_id', $user->id)
            ->whereIn('status', ['pending', 'approved'])
            ->exists();

        if ($hasPendingWithdrawal) {
            return redirect()->route('freelancer.withdrawals.index')
                ->with('error', 'Anda masih memiliki permintaan penarikan yang sedang diproses.');
        }

        return view('freelancer.withdrawals.create', compact('wallet'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:' . self::MIN_WITHDRAWAL,
            'bank_name' => 'required|string|max:100',
            'account_number' => 'required|string|max:50',
            'account_holder_name' => 'required|string|max:100'
        ]);

        try {
            DB::beginTransaction();

            $user = Auth::user();
            $wallet = Wallet::lockForUpdate()->where('user_id', $user->id)->first();

            // Validasi saldo
            if (!$wallet || $wallet->balance < $validated['amount']) {
                DB::rollBack();
                return back()->with('error', 'Saldo tidak mencukupi.')->withInput();
            }

            // Check pending withdrawal
            $hasPending = Withdrawal::where('user_id', $user->id)
                ->whereIn('status', ['pending', 'approved'])
                ->exists();

            if ($hasPending) {
                DB::rollBack();
                return back()->with('error', 'Anda masih memiliki permintaan penarikan yang sedang diproses.')->withInput();
            }

            // Generate unique withdrawal ID
            $withdrawalId = 'WD-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -6));

            // Create withdrawal request
            $withdrawal = new Withdrawal();
            $withdrawal->withdrawal_id = $withdrawalId;
            $withdrawal->user_id = $user->id;
            $withdrawal->wallet_id = $wallet->id;
            $withdrawal->amount = $validated['amount'];
            $withdrawal->status = 'pending';
            $withdrawal->bank_name = $validated['bank_name'];
            $withdrawal->account_number = $validated['account_number'];
            $withdrawal->account_holder_name = $validated['account_holder_name'];
            $withdrawal->save();

            // Kurangi balance, tambah pending_balance
            $wallet->balance -= $validated['amount'];
            $wallet->pending_balance += $validated['amount'];
            $wallet->save();

            DB::commit();

            Log::info('Withdrawal request created', [
                'withdrawal_id' => $withdrawal->withdrawal_id,
                'user_id' => $user->id,
                'amount' => $validated['amount']
            ]);

            return redirect()->route('freelancer.withdrawals.index')
                ->with('success', 'Permintaan penarikan berhasil diajukan!');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Withdrawal request error: ' . $e->getMessage());
            
            return back()->with('error', 'Gagal mengajukan penarikan: ' . $e->getMessage())->withInput();
        }
    }

    public function show(Withdrawal $withdrawal)
    {
        // Authorization
        if ($withdrawal->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('freelancer.withdrawals.show', compact('withdrawal'));
    }
}