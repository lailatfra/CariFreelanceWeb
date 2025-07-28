<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClientProfile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;



class ClientProfileController extends Controller
{
    public function create()
    {
        return view('client.profile.create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'company_name' => 'nullable|string',
            'website' => 'nullable|url',
            'phone' => 'nullable|string',
            'bio' => 'nullable|string',
        ]);

        ClientProfile::create([
            'user_id' => Auth::id(),
            'company_name' => $request->company_name,
            'website' => $request->website,
            'phone' => $request->phone,
            'bio' => $request->bio,
        ]);

        Auth::logout();
        Session::forget(['register.role']);
        return redirect()->route('login')->with('success', 'Pendaftaran berhasil. Silakan login.');
    }
}

