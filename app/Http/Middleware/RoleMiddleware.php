<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    
    // public function handle($request, Closure $next, $role)
    // {
    //     if (!Auth::check() || Auth::user()->role !== $role) {
    //         if ($somethingIsWrong) {
    //             \Log::warning('RoleMiddleware blocked request', [
    //                 'user_id' => auth()->id(),
    //                 'path' => $request->path(),
    //             ]);
    //             abort(403, 'Unauthorized.');
    //         }

    //         abort(403, 'Unauthorized.');
    //     }

    //     return $next($request);
    // }
}