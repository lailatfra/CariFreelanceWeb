<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\ClientProfileController;
use App\Models\ClientProfile;
use App\Http\Controllers\FreelancerProfileController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Verified;
use App\Models\User;
use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\Client\ClientDashboardController;
use App\Http\Controllers\Freelancer\FreelancerDashboardController;
use App\Http\Controllers\Auth\LoginController;


Route::get('/', fn() => view('pages.landing'))->name('home');
Route::get('/tentang/penjelasan', fn() => view('pages.tentang-penjelasan'))->name('tentang.penjelasan');
Route::get('/tentang/foto', fn() => view('pages.tentang-foto'))->name('tentang.foto');
Route::get('/tentang/viewers-rating', fn() => view('pages.tentang-viewers-rating'))->name('tentang.rating');
Route::get('/faq', fn() => view('pages.faq'))->name('faq');

// Multi-step Register
Route::get('/register/step1', [RegisterController::class, 'showStep1'])->name('register.step1');
Route::post('/register/step1', [RegisterController::class, 'processStep1'])->name('register.step1.post');

Route::get('/register/step2', [RegisterController::class, 'showStep2'])->name('register.step2');
Route::post('/register/step2', [RegisterController::class, 'processStep2'])->name('register.step2.post');

Route::get('/email/verify', [RegisterController::class, 'verifyNotice'])->middleware('auth')->name('verification.notice');

//Step2-Google
Route::get('/register/step2/google', function () {
    if (!Session::has('register.google')) {
        return redirect('/login');
    }

    return view('auth.choose-role-google');
})->name('register.step2.google');

Route::post('/register/step2/google', function (Request $request) {
    $request->validate([
        'role' => 'required|in:client,freelancer',
    ]);

    $email = Session::get('register.email');

    $user = \App\Models\User::where('email', $email)->first();

    if (!$user) {
        $user = \App\Models\User::create([
            'name' => Session::get('register.name'),
            'email' => $email,
            'google_id' => Session::get('register.google_id'),
            'email_verified_at' => now(),
            'role' => $request->role,
            'password' => Hash::make(Str::random(6)), 
        ]);
    } else {
        $user->role = $request->role;
        $user->save();
    }

    Session::forget('register.google');
    Session::forget('register.email');
    Session::forget('register.name');
    Session::forget('register.google_id');

    Auth::login($user);

    return redirect()->route(getRedirectRouteByRole($user));
})->name('register.step2.google.submit');




// Register via Google
Route::get('/auth/google/redirect', [GoogleController::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

// Login via Google
Route::get('/auth/google/login', [GoogleController::class, 'redirectToGoogleForLogin'])->name('google.login');
Route::get('/auth/google/login/callback', [GoogleController::class, 'handleGoogleLoginCallback']);



// Route untuk mengirim ulang email verifikasi
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Link verifikasi telah dikirim ulang ke email kamu.');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');


// Email verification route
Route::get('/email/verify/{id}/{hash}', [RegisterController::class, 'verifyEmail'])
    ->middleware(['signed'])
    ->name('verification.verify');


// Resend verification
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Link verifikasi telah dikirim ulang ke email kamu.');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

//login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


// Client profile
Route::middleware('auth')->group(function () {
    Route::get('/client/profile/create', [ClientProfileController::class, 'create'])->name('client.profile.create')->middleware('auth');
    Route::post('/client/profile', [ClientProfileController::class, 'store'])->name('client.profile.store')->middleware('auth');
});

// Freelancer profile
Route::middleware('auth')->group(function () {
Route::get('/freelancer/profile/create', [FreelancerProfileController::class, 'create'])->name('freelancer.profile.create')->middleware('auth');
Route::post('/freelancer/profile', [FreelancerProfileController::class, 'store'])->name('freelancer.profile.store')->middleware('auth');
});

// Dashboard
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/client/dashboard', [ClientDashboardController::class, 'index'])->name('client.dashboard');
    Route::get('/freelancer/dashboard', [FreelancerDashboardController::class, 'index'])->name('freelancer.dashboard');
});


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});
