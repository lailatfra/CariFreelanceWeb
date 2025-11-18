<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah admin sudah login
        if (!session('admin_logged_in')) {
            return redirect()->route('login.admin')->with('error', 'Silakan login terlebih dahulu.');
        }

        return $next($request);
    }
}