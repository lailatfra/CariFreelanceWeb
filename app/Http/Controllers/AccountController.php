<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function deactivate()
    {
        $user = Auth::user();
        $user->is_active = false;
        $user->save();

        Auth::logout();

        return redirect()->route('login')
            ->with('status', 'Akun Anda berhasil dinonaktifkan. Anda dapat mengaktifkannya kembali dengan menghubungi support.');
    }
}
