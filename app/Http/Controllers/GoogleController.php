<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class GoogleController extends Controller
{
    // Step 1: Redirect ke Google
    public function redirectToGoogle()
    {
        return Socialite::driver('google')
            ->stateless()
            ->with(['prompt' => 'select_account'])
            ->redirect();
    }

    // Step 2: Callback Google
    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->stateless()->user();

        // Simpan data sementara di session, belum masuk ke DB
        Session::put('register.google', [
            'name' => $googleUser->getName(),
            'email' => $googleUser->getEmail(),
            'google_id' => $googleUser->getId(),
        ]);

        return redirect()->route('register.setPassword');
    }

    // Step 3: Form set password
    public function showSetPassword()
    {
        if (!Session::has('register.google')) {
            return redirect('/login')->with('error', 'Sesi registrasi Google berakhir.');
        }
        return view('auth.set-password');
    }

    // Step 4: Simpan password ke session
    public function savePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:6|confirmed',
        ]);

        $data = Session::get('register.google');
        $data['password'] = Hash::make($request->password);
        Session::put('register.google', $data);

        return redirect()->route('register.chooseRole');
    }

    // Step 5: Pilih role
    public function showChooseRole()
    {
        if (!Session::has('register.google')) {
            return redirect('/login')->with('error', 'Sesi registrasi Google berakhir.');
        }
        return view('auth.choose-role-google');
    }

    // Step 6: Simpan user ke database
    public function saveRole(Request $request)
    {
        $request->validate([
            'role' => 'required|in:client,freelancer',
        ]);

        $data = Session::get('register.google');
        if (!$data) return redirect('/login')->with('error', 'Sesi berakhir.');

        // Insert ke tabel users
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'google_id' => $data['google_id'],
            'password' => $data['password'],
            'email_verified_at' => now(),
            'role' => $request->role,
        ]);

        // Bersihkan session
        Session::forget('register.google');

        // Login user
        Auth::login($user);

        // Redirect ke form profil sesuai role
        return match ($user->role) {
            'client' => redirect()->route('client.profile.create'),
            'freelancer' => redirect()->route('freelancer.profile.create'),
            default => redirect('/login'),
        };
    }
}
