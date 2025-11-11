<?php

namespace App\Filament\Auth;

use Filament\Pages\Auth\Login as BaseLogin;
use Illuminate\Support\Facades\Auth;

class AdminLogin extends BaseLogin
{
    protected function authenticate(array $data): void
    {
        $credentials = [
            'email' => $data['email'],
            'password' => $data['password'],
            'role' => 'admin', // hanya user role admin yang bisa login
        ];

        if (!Auth::attempt($credentials, $data['remember'] ?? false)) {
            $this->addError('email', trans('auth.failed'));
        }
    }
}
