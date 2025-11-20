<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\Models\Wallet;
use Symfony\Component\HttpFoundation\Response;

class ShareWalletData
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Cek jika user sudah login
        if (Auth::check()) {
            // Get atau create wallet
            $wallet = Wallet::firstOrCreate(
                ['user_id' => Auth::id()],
                ['balance' => 0, 'pending_balance' => 0]
            );

            // Share data ke semua view
            View::share([
                'userWallet' => $wallet,
                'formattedBalance' => 'Rp ' . number_format($wallet->balance, 0, ',', '.'),
                'rawBalance' => $wallet->balance
            ]);
        } else {
            // Jika belum login, share data kosong
            View::share([
                'userWallet' => null,
                'formattedBalance' => 'Rp 0',
                'rawBalance' => 0
            ]);
        }

        return $next($request);
    }
}