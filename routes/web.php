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
use App\Http\Controllers\Client\JobboardController;
use App\Http\Controllers\Client\ProjectController;
use App\Http\Controllers\PostingController;
use App\Http\Controllers\ProposalController;
use App\Http\Controllers\TimelineController;
use App\Http\Controllers\ProgressController;
use App\Http\Controllers\SubmitProjectController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\FreelancerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\WithdrawalController;
use App\Http\Controllers\Client\ClientAdditionalInfoController;
use App\Http\Controllers\Freelancer\FreelancerAdditionalInfoController;
use App\http\Controllers\ChatController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\Admin\ClientController;


Route::middleware(['auth'])->prefix('freelancer')->name('freelancer.')->group(function () {
    Route::get('/withdrawals', [App\Http\Controllers\Freelancer\WithdrawalController::class, 'index'])
        ->name('withdrawals.index');
    Route::get('/withdrawals/create', [App\Http\Controllers\Freelancer\WithdrawalController::class, 'create'])
        ->name('withdrawals.create');
    Route::post('/withdrawals', [App\Http\Controllers\Freelancer\WithdrawalController::class, 'store'])
        ->name('withdrawals.store');
    Route::get('/withdrawals/{withdrawal}', [App\Http\Controllers\Freelancer\WithdrawalController::class, 'show'])
        ->name('withdrawals.show');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('withdrawals', WithdrawalController::class)->only(['index', 'show']);
    Route::post('withdrawals/{withdrawal}/approve', [WithdrawalController::class, 'approve'])->name('withdrawals.approve');
    Route::post('withdrawals/{withdrawal}/complete', [WithdrawalController::class, 'complete'])->name('withdrawals.complete');
    Route::post('withdrawals/{withdrawal}/reject', [WithdrawalController::class, 'reject'])->name('withdrawals.reject');
});

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

Route::middleware(['auth', 'active'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::post('/akun/nonaktifkan', [AccountController::class, 'deactivate'])
        ->name('account.deactivate');
});

// Client profile
Route::middleware('auth')->group(function () {
    Route::get('/client/profile/create', [ClientProfileController::class, 'create'])->name('client.profile.create')->middleware('auth');
    Route::post('/client/profile', [ClientProfileController::class, 'store'])->name('client.profile.store')->middleware('auth');
});
Route::get('/popular', fn() => view('client.popular'))->name('popular');
Route::get('/grafis', fn() => view('client.grafis-desain'))->name('grafis');
Route::get('/dokumen', fn() => view('client.dokumen-ppt'))->name('dokumen');
Route::get('/web-app', fn() => view('client.web-app'))->name('app');
Route::get('/video', fn() => view('client.video-editing'))->name('video');

// Routes untuk kategori utama dengan subcategory
Route::get('/popular/{subcategory?}', [PostingController::class, 'showPopularCategory'])
    ->name('popular.category')
    ->where('subcategory', '[a-z0-9\-]+');

Route::get('/grafis/{subcategory?}', [PostingController::class, 'showGrafisCategory'])
    ->name('grafis.category')
    ->where('subcategory', '[a-z0-9\-]+');
// Route lama untuk backward compatibility
Route::get('/web', [PostingController::class, 'showWebCategory'])->name('web');
Route::get('/projects/{project}', [PostingController::class, 'show'])->name('projects.show');   
Route::get('/freelancer/proposal/{proposal}', [ProposalController::class, 'showProposal'])->name('freelancer.proposal.show');
Route::get('/web/job', fn() => view('client.popular.job.job1'))->name('job');
Route::get('/logo', fn() => view('client.grafis.logo-desain'))->name('logo');
Route::get('/copy', fn() => view('client.penulisan.copy-writing'))->name('copy');
Route::get('/chat', fn() => view('client.chat'))->name('chat');
Route::get('/notification', fn() => view('client.notification'))->name('notification');
Route::get('/client/profile/{id}', [ClientProfileController::class, 'show'])
    ->name('client.profile.show');


// Route::get('/profile/akun', fn() => view('client.settings.profil-akun'))->name('profile-akun');
// Route::get('/profile/kontak', fn() => view('client.settings.profil-kontak'))->name('profile-kontak');
// Route::get('/profile/manage', fn() => view('client.settings.manage-akun'))->name('manage-akun');
// Route::get('/profile/rating', fn() => view('client.settings.rating'))->name('rating');

Route::middleware(['auth', 'verified'])->group(function () {
    // Menampilkan halaman edit profil client (profil-akun)
    Route::get('/profile/akun', [ClientProfileController::class, 'showAccount'])
        ->name('profile-akun');
    
    // Update profil client (POST karena ada file upload)
    Route::post('/profile/akun/update', [ClientProfileController::class, 'updateAccount'])
        ->name('profile-akun.update');
    
    // Halaman kontak dan manage akun
    Route::get('/profile/kontak', fn() => view('client.settings.profil-kontak'))
        ->name('profile-kontak');
    Route::get('/profile/manage', fn() => view('client.settings.manage-akun'))
        ->name('manage-akun');
    
    // Rating (jika ada)
    Route::get('/profile/rating', fn() => view('client.settings.rating'))
        ->name('rating');
});

// Route::get('/profile/job', fn() => view('client.projek'))->name('projek');
Route::get('/freelancer/1', fn() => view('client.freelancer.1'))->name('freelancer1');
Route::get('/freelancer/{project}', [PostingController::class, 'freelancer'])->name('freelancer.show');
Route::get('/freelancer1', fn() => view('client.freelancer.1-1'))->name('freelancer1-1');
// Route::get('/projects/{project}/timeline', [PostingController::class, 'timeline'])
//     ->name('timeline');
   
Route::prefix('projects/{project}')->middleware('auth')->group(function () {
    Route::patch('/timelines/{timeline}/update-status', [TimelineController::class, 'updateStatus'])->name('timeline.status');
    Route::get('/timeline', [TimelineController::class, 'timeline'])->name('timeline');
    Route::get('/timeline/data', [TimelineController::class, 'index'])->name('timeline.data');
    Route::post('/timeline', [TimelineController::class, 'store'])->name('timelines.store');
    Route::get('/timelines/{timeline}', [TimelineController::class, 'show']);
    Route::put('/timelines/{timeline}', [TimelineController::class, 'update']);
    Route::delete('/timelines/{timeline}', [TimelineController::class, 'destroy']);
});

//progress
Route::post('/progress/store', [ProgressController::class, 'store'])->name('progress.store');



Route::middleware(['auth'])->group(function () {
    Route::post('/submit-projects', [SubmitProjectController::class, 'store'])
        ->name('submit-projects.store');
    Route::get('/submit-projects/{submitProject}', [SubmitProjectController::class, 'show'])
        ->name('submit-projects.show');
    Route::get('/submit-projects/status/{projectId}', [SubmitProjectController::class, 'getProjectStatus'])
        ->name('submit-projects.status');
    Route::patch('/submit-projects/{submitProject}/status', [SubmitProjectController::class, 'updateStatus'])
        ->name('submit-projects.update-status');
    Route::get('/submit-projects/revision-notes/{projectId}', [SubmitProjectController::class, 'getRevisionNotes'])
        ->name('submit-projects.revision-notes');
});



// Client routes
Route::middleware(['auth', 'role:client'])->group(function () {
    Route::get('/client/jobboard', [App\Http\Controllers\Client\JobboardController::class, 'index'])
        ->name('client.jobboard');
    
    
    Route::patch('/client/submit-projects/{submitProject}/status', [App\Http\Controllers\Client\JobboardController::class, 'updateStatus'])
        ->name('client.submit-projects.update-status');
});

    Route::get('/client/projects/{projectId}/progress', [App\Http\Controllers\Client\JobboardController::class, 'getProjectProgress'])
        ->name('client.projects.progress');


Route::middleware(['auth'])->group(function () {
    Route::post('/client/update-company-info', [ClientAdditionalInfoController::class, 'updateCompanyInfo'])->name('client.updateCompanyInfo');
    Route::post('/client/update-vision-mission', [ClientAdditionalInfoController::class, 'updateVisionMission'])->name('client.updateVisionMission');
    Route::post('/client/update-communication', [ClientAdditionalInfoController::class, 'updateCommunication'])->name('client.updateCommunication');
    Route::post('/client/update-social-media', [ClientAdditionalInfoController::class, 'updateSocialMedia'])->name('client.updateSocialMedia');
    Route::get('/client/get-info', [ClientAdditionalInfoController::class, 'getInfo'])->name('client.getInfo');
});
Route::prefix('client')->group(function () {
    Route::get('/additional-info', [ClientAdditionalInfoController::class, 'getInfo'])->name('client.additional-info.get');
    Route::post('/additional-info/company', [ClientAdditionalInfoController::class, 'updateCompanyInfo'])->name('client.additional-info.company');
    Route::post('/additional-info/vision-mission', [ClientAdditionalInfoController::class, 'updateVisionMission'])->name('client.additional-info.vision-mission');
    Route::post('/additional-info/communication', [ClientAdditionalInfoController::class, 'updateCommunication'])->name('client.additional-info.communication');
    Route::post('/additional-info/social-media', [ClientAdditionalInfoController::class, 'updateSocialMedia'])->name('client.additional-info.social-media');
});


Route::middleware(['auth'])->group(function() {
    Route::get('/freelancer/profile/contact', [FreelancerProfileController::class, 'showContactInfo'])
        ->name('freelancer-profile-kontak');
    
    Route::post('/freelancer/update-bio', [FreelancerProfileController::class, 'updateBio'])
        ->name('freelancer.updateBio');
    Route::post('/freelancer/update-skills', [FreelancerProfileController::class, 'updateSkills'])
        ->name('freelancer.updateSkills');
    Route::post('/freelancer/update-portfolio', [FreelancerProfileController::class, 'updatePortfolio'])
        ->name('freelancer.updatePortfolio');
    Route::post('/freelancer/update-education', [FreelancerProfileController::class, 'updateEducation'])
        ->name('freelancer.updateEducation');
    Route::post('/freelancer/update-rate', [FreelancerProfileController::class, 'updateRate'])
        ->name('freelancer.updateRate');
    Route::get('/freelancer/additional-info', [FreelancerAdditionalInfoController::class, 'getInfo']);
});

Route::prefix('freelancer')->middleware(['auth'])->group(function () {
    // GET route untuk mengambil data
    Route::get('/additional-info', [App\Http\Controllers\Freelancer\FreelancerAdditionalInfoController::class, 'getInfo'])->name('freelancer.additional-info.get');
    
    // POST routes untuk update data
    Route::post('/additional-info/bio', [App\Http\Controllers\Freelancer\FreelancerAdditionalInfoController::class, 'updateBio'])->name('freelancer.additional-info.bio');
    Route::post('/additional-info/skills', [App\Http\Controllers\Freelancer\FreelancerAdditionalInfoController::class, 'updateSkills'])->name('freelancer.additional-info.skills');
    Route::post('/additional-info/portfolio', [App\Http\Controllers\Freelancer\FreelancerAdditionalInfoController::class, 'updatePortfolio'])->name('freelancer.additional-info.portfolio');
    Route::post('/additional-info/education', [App\Http\Controllers\Freelancer\FreelancerAdditionalInfoController::class, 'updateEducation'])->name('freelancer.additional-info.education');
    Route::post('/additional-info/rate', [App\Http\Controllers\Freelancer\FreelancerAdditionalInfoController::class, 'updateRate'])->name('freelancer.additional-info.rate');
});

// Form buat isi profil freelancer
Route::get('/freelancer/profile/create', [FreelancerProfileController::class, 'create'])->name('freelancer.profile.create')->middleware(['auth', 'verified']); 
Route::post('/freelancer/profile', [FreelancerProfileController::class, 'store'])->name('freelancer.profile.store')->middleware(['auth', 'verified']);

Route::get('/freelancer/profile/{id}/public', [FreelancerProfileController::class, 'showPublic'])
    ->name('freelancer.profile.public');
    
Route::get('/freelancer/@{username}', [FreelancerProfileController::class, 'showPublicByUsername'])
    ->name('freelancer.profile.username');

Route::get('/freelancer/popular', fn() => view('freelancer.popular'))->name('popular');
Route::get('/freelancer/grafis', fn() => view('freelancer.grafis-desain'))->name('grafis');
Route::get('/freelancer/web', fn() => view('freelancer.popular.web-development'))->name('web');
Route::get('/freelancer/web/job', fn() => view('freelancer.popular.job.job1'))->name('job');
Route::get('/freelancer/proposal', fn() => view('freelancer.proposall'))->name('proposal');
// Route::get('/freelancer/proposal', [ProposalController::class, 'create'])->name('proposal');
Route::middleware(['auth'])->group(function () {
    Route::get('/freelancer/proposall/{project}', [ProposalController::class, 'create'])->name('proposal.create');
    Route::post('/freelancer/proposall/{project}', [ProposalController::class, 'store'])->name('proposal.store');
});
Route::get('/freelancer/profile/job', [ProposalController::class, 'index'])->name('projekf');
Route::post('/proposals/{proposal}/accept', [App\Http\Controllers\ProposalController::class, 'accept'])
    ->name('proposals.accept');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile/freelancer', [FreelancerProfileController::class, 'show'])->name('profile-freelancer');
    Route::get('/freelancer/profile/edit', [FreelancerProfileController::class, 'edit'])->name('freelancer.profile.edit');
    Route::put('/freelancer/profile', [FreelancerProfileController::class, 'update'])->name('freelancer.profile.update');
});


// Route::get('/freelancer/profile/akun', fn() => view('freelancer.settings.profil-akun'))->name('freelancer-profile-akun');
// Route::get('/freelancer/profile/kontak', fn() => view('freelancer.settings.profil-kontak'))->name('freelancer-profile-kontak');
// Route::get('/freelancer/profile/manage', fn() => view('freelancer.settings.manage-akun'))->name('freelancer-manage-akun');

Route::middleware(['auth', 'verified'])->group(function () {
    // Menampilkan halaman edit profil (profil-akun)
    Route::get('/freelancer/profile/akun', [FreelancerProfileController::class, 'showAccount'])
        ->name('freelancer-profile-akun');
    
    // Update profil freelancer
    Route::put('/freelancer/profile/update', [FreelancerProfileController::class, 'update'])
        ->name('freelancer.profile.update');
    
    // Halaman kontak dan manage akun (jika sudah dibuat)
    Route::get('/freelancer/profile/kontak', fn() => view('freelancer.settings.profil-kontak'))
        ->name('freelancer-profile-kontak');
    Route::get('/freelancer/profile/manage', fn() => view('freelancer.settings.manage-akun'))
        ->name('freelancer-manage-akun');
});


Route::get('/notification/freelancer', fn() => view('freelancer.notification'))->name('notification');


// Tambahkan di bagian route client yang sudah ada middleware auth
Route::middleware(['auth'])->group(function () {
    // ... routes lain ...
    
    Route::get('/profile/akun', [ClientProfileController::class, 'showAccount'])->name('profile-akun');
    Route::post('/profile/akun/update', [ClientProfileController::class, 'updateAccount'])->name('profile-akun.update');
    Route::post('/profile/akun/avatar', [ClientProfileController::class, 'updateAvatar'])->name('profile-akun.avatar');
});

// Dashboard
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/client/home', [ClientDashboardController::class, 'index'])->name('client.home');
});

Route::middleware(['auth', 'checkStatus'])->group(function () {
    Route::get('/home/freelancer', fn() => view('freelancer.home'))->name('home');
});

Route::get('/pending', fn() => view('auth.pending'))->name('pending');

Route::get('/test', function () {
    return view('test');
});

Route::middleware(['auth'])->group(function () {
    // Create new project (GET)
    Route::get('/posting', [PostingController::class, 'create'])->name('posting.create');
    
    // Edit existing project (GET) - akan menggunakan view yang sama dengan create
    Route::get('/projects/{project}/edit', [PostingController::class, 'edit'])->name('projects.edit');
    
    // Store new project (POST)
    Route::post('/posting', [PostingController::class, 'store'])->name('posting.store');
    
    // Update existing project (PUT)
    Route::put('/projects/{project}', [PostingController::class, 'update'])->name('projects.update');
    
    // Other routes
    Route::get('/my-projects', [PostingController::class, 'myProjects'])->name('projects.my');
    Route::delete('/projects/{project}', [PostingController::class, 'destroy'])->name('projects.destroy');
});

//jobboard
Route::middleware(['auth'])->group(function () {
    Route::get('/profile/job', [JobboardController::class, 'index'])
        ->name('projek');
});
Route::get('/profile/job/{$project}', [JobboardController::class, 'showProposal'])->name('proposals.show');
Route::get('/profile/job/{$project}/freelancer', [JobboardController::class, 'freelancer'])->name('freelancers.show');
// Route::get('/submit/download/{id}', [SubmitProjectController::class, 'download'])
//     ->name('submit.download');
Route::get('/client/projects/{projectId}/progress',[JobboardController::class, 'getProjectProgress'])->name('client.projects.progress');


// Payment routes
Route::middleware(['auth'])->group(function () {
    Route::get('/payment/{proposal}/show', [App\Http\Controllers\PaymentController::class, 'show'])
        ->name('payment.show');
    Route::post('/payment/{proposal}/process', [App\Http\Controllers\PaymentController::class, 'processPayment'])
        ->name('payment.process');
    Route::get('/payment/{paymentId}/success', [App\Http\Controllers\PaymentController::class, 'success'])
        ->name('payment.success');
    Route::get('/payment/{paymentId}/pending', [App\Http\Controllers\PaymentController::class, 'pending'])
        ->name('payment.pending');
    Route::get('/payment/{paymentId}/failed', [App\Http\Controllers\PaymentController::class, 'failed'])
        ->name('payment.failed');
    Route::get('/payment/{paymentId}/check-status', [App\Http\Controllers\PaymentController::class, 'checkStatus'])
        ->name('payment.check-status');
});

// Webhook untuk notifikasi Midtrans (tidak perlu auth)
Route::post('/payment/notification', [App\Http\Controllers\PaymentController::class, 'notification'])
    ->name('payment.notification');



Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('login.admin');
Route::post('/admin/login', function (Request $request) {
    $email = $request->input('email');
    $password = $request->input('password');

    if ($email === 'admin@gmail.com' && $password === 'password') {
        session(['admin_logged_in' => true]);
        return redirect()->route('admin.dashboard');
    }

    return redirect()->route('login.admin')->with('error', 'Email atau password salah!');
})->name('login.admin.submit');

// Admin Logout
Route::get('/admin/logout', function () {
    session()->forget('admin_logged_in');
    return redirect()->route('login.admin')->with('success', 'Berhasil logout.');
})->name('logout.admin');

// Admin Routes (dengan custom middleware 'admin')
Route::middleware(['admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // Users Management
    Route::resource('users', UserController::class);
    
    // Freelancers Management
    Route::get('/freelancers', [AdminController::class, 'freelancers'])->name('freelancers.index');
    Route::post('/freelancers/{id}/status', [AdminController::class, 'updateFreelancerStatus'])->name('freelancers.status');
    
    // Projects Management
    Route::resource('projects', ProjectController::class);
    
    // Cancels Management
    Route::get('/cancels', [AdminController::class, 'cancels'])->name('cancels.index');
    
    // Withdrawal Management
Route::controller(WithdrawalController::class)->group(function () {
    Route::get('/withdrawals', 'index')->name('withdrawals.index');
    Route::get('/withdrawals/{withdrawal}', 'show')->name('withdrawals.show');
    Route::post('/withdrawals/{withdrawal}/approve', 'approve')->name('withdrawals.approve');
    Route::post('/withdrawals/{withdrawal}/complete', 'complete')->name('withdrawals.complete');
    Route::post('/withdrawals/{withdrawal}/reject', 'reject')->name('withdrawals.reject');
});
});

// Route::prefix('admin')->middleware(['auth'])->group(function () {
// Halaman Dashboard Admin
Route::get('/admin/dashboard', [DashboardController::class, 'index'])
    ->name('admin.dashboard');
Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');
Route::post('/admin/users', [UserController::class, 'store']);
Route::put('/admin/users/{id}', [UserController::class, 'update']);
Route::delete('/admin/users/{id}', [UserController::class, 'destroy']);
// });

// Halaman Kelola Freelancer (untuk admin)
Route::get('/admin/freelancers', [FreelancerController::class, 'index'])
    ->name('admin.freelancers.index');
Route::post('/admin/freelancers/{freelancer}/status', [FreelancerController::class, 'updateStatus'])
    ->name('admin.freelancers.status');


// Kelola Projects
Route::get('/projects', [\App\Http\Controllers\Admin\ProjectController::class, 'index'])->name('admin.projects.index');


// Route logout admin
Route::get('/admin/logout', [AdminController::class, 'logout'])->name('logout.admin');

// Route di web.php - PERBAIKAN
Route::middleware(['auth'])->group(function () {
    // Route utama chat dengan name 'chat'
    Route::get('/chat', [ChatController::class, 'index'])->name('chat');
    
    // Route chat lainnya
    Route::prefix('chat')->name('chat.')->group(function () {
        Route::get('/conversations/{conversation}', [ChatController::class, 'show'])->name('show');
        Route::post('/conversations/{conversation}/send', [ChatController::class, 'sendMessage'])->name('send');
        Route::get('/conversations/{conversation}/load-more', [ChatController::class, 'loadMore'])->name('load-more');
        Route::post('/conversations/{conversation}/typing', [ChatController::class, 'typing'])->name('typing');
        Route::post('/conversations/{conversation}/mark-read', [ChatController::class, 'markAsRead'])->name('mark-read');
        Route::get('/search', [ChatController::class, 'search'])->name('search');
    });
});



// TEST ROUTE - hapus setelah selesai debug
Route::get('/test-withdrawal', function() {
    return 'Route withdrawal works!';
});

Route::get('/test-withdrawal-auth', function() {
    $user = Auth::user();
    return [
        'authenticated' => Auth::check(),
        'user' => $user ? [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'role' => $user->role,
        ] : null
    ];
})->middleware('auth');

Route::get('/test-withdrawal-controller', [App\Http\Controllers\Freelancer\WithdrawalController::class, 'index'])
    ->middleware('auth');

// Tambahkan di web.php
Route::get('/check-my-role', function() {
    $user = Auth::user();
    return response()->json([
        'authenticated' => Auth::check(),
        'user_id' => $user?->id,
        'user_role' => $user?->role,
        'user_email' => $user?->email,
        'is_freelancer' => $user?->role === 'freelancer',
    ]);
})->middleware('auth');

// Tambahkan di web.php
Route::get('/test-middleware-chain', function() {
    return 'Middleware chain passed! User: ' . Auth::user()->name . ', Role: ' . Auth::user()->role;
})->middleware(['auth', 'role:freelancer']);