<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ClientProfile;
use App\Models\FreelancerProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\URL;
use Laravel\Socialite\Facades\Socialite;



class RegisterController extends Controller
{
    // STEP 1: Tampilkan form
    public function showStep1()
    {
        return view('auth.register-step1');
    }

    public function processStep1(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        Session::put('register.name', $request->name);
        Session::put('register.email', $request->email);
        Session::put('register.password', bcrypt($request->password));

        return redirect()->route('register.step2');
    }

    // STEP 2: Pilih role
    public function showStep2()
    {
        return view('auth.register-step2');
    }

    public function processStep2(Request $request)
    {
        $request->validate([
            'role' => 'required|in:client,freelancer',
        ]);

        $user = User::create([
            'name' => Session::get('register.name'),
            'email' => Session::get('register.email'),
            'password' => Session::get('register.password'),
            'role' => $request->role,
        ]);

        Auth::login($user);

        // Kirim email verifikasi
        event(new Registered($user));

        return redirect()->route('verification.notice');
    }

    // STEP 3: Notifikasi verifikasi
    public function verifyNotice()
    {
        return view('auth.verify-email');
    }

    // STEP 3.1: Email diklik
    public function verifyEmail(Request $request, $id, $hash)
    {
        $user = User::findOrFail($id);

        if (!hash_equals((string) $hash, sha1($user->getEmailForVerification()))) {
            abort(403, 'Invalid verification link.');
        }

        if (!$user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
            event(new Verified($user));
        }

        Auth::login($user);


        
        // Cek apakah profil sudah ada
        if ($user->role === 'client') {
            $hasProfile = \App\Models\ClientProfile::where('user_id', $user->id)->exists();
            return $hasProfile
                ? redirect()->route('client.dashboard')
                : redirect()->route('client.profile.create');
        }

        if ($user->role === 'freelancer') {
            $hasProfile = \App\Models\FreelancerProfile::where('user_id', $user->id)->exists();
            return $hasProfile
                ? redirect()->route('freelancer.dashboard')
                : redirect()->route('freelancer.profile.create');
        }

        return redirect('/login');
    }


    // STEP 4: Form profil client
    public function showClientProfile()
    {
        return view('client.profile-create');
    }

    public function saveClientProfile(Request $request)
    {
        $request->validate([
            'company_name' => 'required',
            'address' => 'required',
        ]);

        ClientProfile::create([
            'user_id' => Auth::id(),
            'company_name' => $request->company_name,
            'address' => $request->address,
        ]);

        Auth::logout(); // keluarin user setelah simpan profil
        return redirect()->route('login')->with('success', 'Pendaftaran berhasil. Silakan login.');
    }


    // STEP 4: Form profil freelancer
    public function showFreelancerProfile()
    {
        return view('freelancer.profile-create');
    }

   public function saveFreelancerProfile(Request $request)
    {
        $request->validate([
            'skills' => 'required',
            'portfolio_url' => 'nullable|url',
        ]);

        FreelancerProfile::create([
            'user_id' => Auth::id(),
            'skills' => $request->skills,
            'portfolio_url' => $request->portfolio_url,
        ]);

        Auth::logout(); // keluarin user setelah simpan profil
        return redirect()->route('login')->with('success', 'Pendaftaran berhasil. Silakan login.');
    }


    public function showRoleForm()
    {
        $email = Session::get('register.email');
        if (!$email) {
            return redirect('/login')->with('error', 'Email tidak ditemukan di session.');
        }

        return view('auth.step2-role'); // view pilih role
    }


    public function submitRole(Request $request)
    {
        $request->validate([
            'role' => 'required|in:client,freelancer',
        ]);

        $email = Session::get('register.email');
        $user = User::where('email', $email)->first();

        if (!$user) {
            return redirect('/login')->with('error', 'User tidak ditemukan.');
        }

        $user->role = $request->role;
        $user->save();

        Auth::login($user);

        event(new Registered($user)); // Tambahkan ini

        return redirect()->route('verification.notice');
    }

}
