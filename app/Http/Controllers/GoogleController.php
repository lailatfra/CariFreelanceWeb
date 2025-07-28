<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class GoogleController extends Controller
{

    public function redirectToGoogle()
    {
        session(['google_action' => 'register']);
        return Socialite::driver('google')->redirect();
    }

    public function redirectToGoogleForLogin()
    {
        session(['google_action' => 'login']);
        return Socialite::driver('google')->redirect();
    }


    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->stateless()->user();
        $action = session('google_action');

        $user = User::where('email', $googleUser->getEmail())->first();

        if ($action === 'register') {
            if ($user) {
                // Sudah terdaftar
                return redirect('/login')->with('error', 'Email sudah terdaftar. Silakan login.');
            }

            // Simpan session untuk lanjut ke pilih role dan isi profil
            session([
                'register.google' => true,
                'register.email' => $googleUser->getEmail(),
                'register.name' => $googleUser->getName(),
                'register.google_id' => $googleUser->getId(),
            ]);

            return redirect()->route('register.step2.google'); // halaman pilih role
        }

        if ($action === 'login') {
            if (!$user) {
                return redirect('/login')->with('error', 'Akun belum terdaftar. Silakan daftar dulu.');
            }

            Auth::login($user);

            // Arahkan ke dashboard sesuai role
            return match ($user->role) {
                'client' => redirect()->route('client.dashboard'),
                'freelancer' => redirect()->route('freelancer.dashboard'),
                default => redirect('/login'),
            };
        }

        return redirect('/login')->with('error', 'Aksi tidak valid.');
    }


}
