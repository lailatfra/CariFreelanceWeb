<?php
// app/Http/Controllers/Admin/AdminWalletController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminWallet;
use App\Models\AdminWalletTransaction;
use Illuminate\Http\Request;

class AdminWalletController extends Controller
{
    public function index(Request $request)
    {
        // Get atau create admin wallet
        $wallet = AdminWallet::getWallet();

        // Get filter
        $type = $request->get('type');

        // Query transactions
        $query = AdminWalletTransaction::with(['payment', 'withdrawal'])
            ->where('admin_wallet_id', $wallet->id)
            ->latest();

        // Apply filter
        if ($type && $type !== 'all') {
            $query->where('type', $type);
        }

        $transactions = $query->paginate(20);

        return view('admin.wallet.index', compact('wallet', 'transactions'));
    }
}