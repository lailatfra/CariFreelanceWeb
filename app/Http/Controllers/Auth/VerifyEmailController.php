<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class VerifyEmailController extends Controller
{
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect($this->redirectTo());
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        // ✅ Setelah email diverifikasi, tetap login dan arahkan ke pengisian profil
        return redirect($this->redirectTo());
    }

    protected function redirectTo()
    {
        $user = Auth::user();

        if ($user->role === 'client') {
            return route('client.profile.create');
        } elseif ($user->role === 'freelancer') {
            return route('freelancer.profile.create');
        }

        return '/login'; // fallback kalau role nggak jelas
    }
}
