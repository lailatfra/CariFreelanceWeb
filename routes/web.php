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
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;

// guest
Route::get('/', fn() => view('pages.landing'))->name('home');
Route::get('/tentang/penjelasan', fn() => view('pages.tentang-penjelasan'))->name('tentang.penjelasan');
Route::get('/tentang/foto', fn() => view('pages.tentang-foto'))->name('tentang.foto');
Route::get('/tentang/viewers-rating', fn() => view('pages.tentang-viewers-rating'))->name('tentang.rating');
Route::get('/faq', fn() => view('pages.faq'))->name('faq');

Route::get('/profil/akun', fn() => view('client.profil-akun'))->name('profil.akun');


// Multi-step Register
Route::get('/register/step1', [RegisterController::class, 'showStep1'])->name('register.step1');
Route::post('/register/step1', [RegisterController::class, 'processStep1'])->name('register.step1.post');

Route::get('/register/step2', [RegisterController::class, 'showStep2'])->name('register.step2');
Route::post('/register/step2', [RegisterController::class, 'processStep2'])->name('register.step2.post');

Route::get('/email/verify', [RegisterController::class, 'verifyNotice'])->middleware('auth')->name('verification.notice');


// Register via Google
Route::get('/auth/google/redirect', [GoogleController::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback'])->name('google.callback');

// Step set password
Route::get('/register/set-password', [GoogleController::class, 'showSetPassword'])->name('register.setPassword');
Route::post('/register/set-password', [GoogleController::class, 'savePassword'])->name('register.savePassword');

// Step pilih role
Route::get('/register/choose-role', [GoogleController::class, 'showChooseRole'])->name('register.chooseRole');
Route::post('/register/choose-role', [GoogleController::class, 'saveRole'])->name('register.saveRole');


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


// Halaman untuk request reset password
Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

// Halaman untuk form reset password
Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');


// Client profile
Route::middleware('auth')->group(function () {
    Route::get('/client/profile/create', [ClientProfileController::class, 'create'])->name('client.profile.create')->middleware('auth');
    Route::post('/client/profile', [ClientProfileController::class, 'store'])->name('client.profile.store')->middleware('auth');
});
Route::get('/popular', fn() => view('client.popular'))->name('popular');
Route::get('/grafis', fn() => view('client.grafis-desain'))->name('grafis');
Route::get('/penulisan', fn() => view('client.penulisan-penerjemahan'))->name('penulisan');
Route::get('/web', fn() => view('client.popular.web-development'))->name('web');
Route::get('/web/job', fn() => view('client.popular.job.job1'))->name('job');
Route::get('/logo', fn() => view('client.grafis.logo-desain'))->name('logo');
Route::get('/copy', fn() => view('client.penulisan.copy-writing'))->name('copy');
Route::get('/notification', fn() => view('client.notification'))->name('notification');
Route::get('/profile', fn() => view('client.profile.profil'))->name('profile');
Route::get('/profile/akun', fn() => view('client.settings.profil-akun'))->name('profile-akun');
Route::get('/profile/kontak', fn() => view('client.settings.profil-kontak'))->name('profile-kontak');
Route::get('/profile/manage', fn() => view('client.settings.manage-akun'))->name('manage-akun');
Route::get('/profile/rating', fn() => view('client.settings.rating'))->name('rating');
Route::get('/profile/job', fn() => view('client.projek'))->name('projek');
Route::get('/freelancer/1', fn() => view('client.freelancer.1'))->name('freelancer1');
Route::get('/freelancer1', fn() => view('client.freelancer.1-1'))->name('freelancer1-1');


// Freelancer profile
Route::middleware('auth')->group(function () {
Route::get('/freelancer/profile/create', [FreelancerProfileController::class, 'create'])->name('freelancer.profile.create')->middleware('auth');
Route::post('/freelancer/profile', [FreelancerProfileController::class, 'store'])->name('freelancer.profile.store')->middleware('auth');
});

// Dashboard
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/client/home', [ClientDashboardController::class, 'index'])->name('client.home');
    Route::get('/freelancer/dashboard', [FreelancerDashboardController::class, 'index'])->name('freelancer.dashboard');
});

Route::get('/test', function () {
    return view('test');
});


Route::get('/posting', fn() => view('client.posting'))->name('posting');