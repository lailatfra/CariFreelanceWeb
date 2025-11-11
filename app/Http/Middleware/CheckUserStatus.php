<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckUserStatus
{
    /**
     * Handle an incoming request.
     */
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        if ($user && $user->role === 'freelancer' && $user->status === 'pending') {
            return redirect()->route('pending')
                ->with('error', 'Akun Anda masih pending. Tunggu persetujuan admin.');
        }

        return $next($request);
    }
}
