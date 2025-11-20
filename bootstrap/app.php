<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        channels: __DIR__.'/../routes/channels.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // Alias middleware
        $middleware->alias([
            'checkStatus' => \App\Http\Middleware\CheckUserStatus::class,
            'role' => \App\Http\Middleware\RoleMiddleware::class,
            'active' => \App\Http\Middleware\CheckUserActive::class,
            'admin' => \App\Http\Middleware\AdminMiddleware::class,
        ]);
        
        // 👇 TAMBAHKAN INI - Append middleware ke web group
        $middleware->web(append: [
            \App\Http\Middleware\ShareWalletData::class,
        ]);
        
        // Uncomment jika mau trace semua request
        // $middleware->append(\App\Http\Middleware\TraceMiddleware::class);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })
    ->create();