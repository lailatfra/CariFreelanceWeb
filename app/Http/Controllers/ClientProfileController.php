<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClientProfile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class ClientProfileController extends Controller
{
    public function show($id)
{
    $clientProfile = ClientProfile::with('user')
        ->where('user_id', $id)
        ->firstOrFail();

    return view('client.profile.profil', compact('clientProfile'));
}


    public function create()
    {
        return view('client.profile.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'company_name' => 'nullable|string',
            'tujuan' => 'nullable|string',
            'phone' => 'nullable|string',
            'bio' => 'nullable|string',
            'location' => 'nullable|string',
            'profile_photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // max 2MB
        ]);

        $profilePhotoPath = $request->hasFile('profile_photo')
            ? $request->file('profile_photo')->store('profile_photos', 'public')
            : 'profile_photos/default.png';

        ClientProfile::create([
            'user_id' => Auth::id(),
            'company_name' => $request->company_name,
            'tujuan' => $request->tujuan,
            'phone' => $request->phone,
            'bio' => $request->bio,
            'location' => $request->location,
            'profile_photo' => $profilePhotoPath,
        ]);
        

        Auth::logout();
        Session::forget(['register.role']);
        return redirect()->route('login')->with('success', 'Pendaftaran berhasil. Silakan login.');
    }
}
