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
            'skills' => 'required|string',
            'experience_years' => 'nullable|integer',
            'portofolio_link' => 'nullable|url',
            'phone' => 'nullable|string',
            'bio' => 'nullable|string',
        ]);

        FreelancerProfile::create([
            'user_id' => Auth::id(),
            'skills' => $request->skills,
            'experience_years' => $request->experience_years,
            'portofolio_link' => $request->portofolio_link,
            'phone' => $request->phone,
            'bio' => $request->bio,
        ]);

        Auth::logout();
        Session::forget(['register.role']);
        return redirect()->route('login')->with('success', 'Pendaftaran berhasil. Silakan login.');
    }
}

