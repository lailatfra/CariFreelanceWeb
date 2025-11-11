<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SocialiteController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')
            ->stateless()
            ->with(['prompt' => 'select_account']) 
            ->redirect();

    }

    public function handleGoogleCallback() 
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            // Cek apakah user dengan email ini sudah ada
            $user = User::where('email', $googleUser->getEmail())->first();

            if ($user) {
                // Kalau user sudah ada → login
                Auth::login($user);
                return redirect()->route(getRedirectRouteByRole($user));
            } else {
                // Kalau belum ada → simpan user ke database
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'email_verified_at' => now(),
                    'role' => Session::get('register.role'), // atau null dulu
                    'password' => Hash::make(Str::random(16)), // untuk user Google
                ]);

                Auth::login($user);

                // Simpan ke sesi agar lanjut ke alur multi-step
                Session::put('register.via_google', true);
                Session::put('register.user_id', $user->id); // kalau kamu perlu

                return redirect()->route('register.step2.google'); // ganti sesuai route milikmu
            }
        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Gagal login dengan Google.');
        }
    }




}
