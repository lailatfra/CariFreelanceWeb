<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // Log untuk debugging
        Log::info('RoleMiddleware checking', [
            'user_id' => auth()->id(),
            'user_role' => optional(auth()->user())->role,
            'required_role' => $role,
            'path' => $request->path(),
        ]);

        // Cek apakah user sudah login
        if (!Auth::check()) {
            Log::warning('RoleMiddleware: User not authenticated');
            return redirect()->route('login')
                ->with('error', 'Silakan login terlebih dahulu.');
        }

        $user = Auth::user();

        // Cek apakah role user sesuai
        if ($user->role !== $role) {
            Log::warning('RoleMiddleware: Unauthorized role', [
                'user_id' => $user->id,
                'user_role' => $user->role,
                'required_role' => $role,
                'path' => $request->path(),
            ]);
            
            // Redirect dengan pesan yang jelas
            return redirect()->route('dashboard')
                ->with('error', "Akses ditolak. Role Anda: {$user->role}, Role yang dibutuhkan: {$role}");
        }

        Log::info('RoleMiddleware: Access granted');
        return $next($request);
    }
}