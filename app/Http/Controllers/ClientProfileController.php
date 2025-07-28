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
            'company_name' => 'required',
            'address' => 'required'
        ]);

        ClientProfile::create([
            'user_id' => auth()->id(),
            'company_name' => $request->company_name,
            'address' => $request->address,
        ]);

        Auth::logout();
        Session::forget(['register.role']);
        return redirect()->route('login')->with('success', 'Pendaftaran berhasil. Silakan login.');
    }
}

