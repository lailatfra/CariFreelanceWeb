<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;

class TraceMiddleware
{
    public function handle($request, Closure $next)
    {
        Log::info("TRACE Middleware START", [
            'path' => $request->path(),
            'user_id' => optional(auth()->user())->id,
        ]);

        $response = $next($request);

        Log::info("TRACE Middleware END", [
            'status' => $response->getStatusCode(),
        ]);

        return $response;
    }
}
