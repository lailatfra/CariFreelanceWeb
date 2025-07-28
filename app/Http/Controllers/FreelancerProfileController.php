<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FreelancerProfile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;



class FreelancerProfileController extends Controller
{
    public function create()
    {
        return view('freelancer.profile.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'skills' => 'required',
            'portfolio_url' => 'nullable|url'
        ]);

        FreelancerProfile::create([
            'user_id' => auth()->id(),
            'skills' => $request->skills,
            'portfolio_url' => $request->portfolio_url,
        ]);

        Auth::logout();
        Session::forget(['register.role']);
        return redirect()->route('login')->with('success', 'Pendaftaran berhasil. Silakan login.');
    }
}

