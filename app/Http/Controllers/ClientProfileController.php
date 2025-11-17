<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClientProfile;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ClientProfileController extends Controller
{
    /**
     * Show public client profile
     */
    public function show($id)
    {
        $clientProfile = ClientProfile::with('user')
            ->where('user_id', $id)
            ->firstOrFail();

        return view('client.profile.profil', compact('clientProfile'));
    }

    /**
     * Show create profile form (for first time registration)
     */
    public function create()
    {
        return view('client.profile.create');
    }

    /**
     * Store new client profile (first time registration)
     */
    public function store(Request $request)
    {
        $request->validate([
            'company_name' => 'nullable|string|max:255',
            'tujuan' => 'nullable|string|max:500',
            'phone' => 'nullable|string|max:20',
            'bio' => 'nullable|string|max:1000',
            'location' => 'nullable|string|max:255',
            'profile_photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
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

    /**
     * Show account settings page
     */
    public function showAccount()
    {
        $user = Auth::user();
        $clientProfile = ClientProfile::where('user_id', $user->id)->first();

        return view('client.settings.profil-akun', compact('user', 'clientProfile'));
    }

    /**
     * Update account information - UNIFIED METHOD
     * Handles all fields including avatar in one request
     */
    public function updateAccount(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255|unique:users,username,' . Auth::id(),
            'display_name' => 'required|string|max:255',
            'company_name' => 'nullable|string|max:255',
            'tujuan' => 'nullable|string|max:500',
            'phone' => 'nullable|string|max:20',
            'location' => 'nullable|string|max:255',
            'bio' => 'nullable|string|max:1000',
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            // 1. Update Users table
            $user = User::findOrFail(Auth::id());
            $user->username = $request->username;
            $user->name = $request->display_name;
            $user->save();

            // 2. Prepare ClientProfile data
            $clientProfileData = [
                'company_name' => $request->company_name,
                'tujuan' => $request->tujuan,
                'phone' => $request->phone,
                'location' => $request->location,
                'bio' => $request->bio,
            ];

            // Handle avatar upload
            if ($request->hasFile('avatar')) {
                $clientProfile = ClientProfile::where('user_id', Auth::id())->first();
                
                // Delete old photo if exists and not default
                if ($clientProfile && $clientProfile->profile_photo && $clientProfile->profile_photo !== 'profile_photos/default.png') {
                    Storage::disk('public')->delete($clientProfile->profile_photo);
                }

                // Store new photo
                $photoPath = $request->file('avatar')->store('profile_photos', 'public');
                $clientProfileData['profile_photo'] = $photoPath;
            }

            // 3. Update or Create ClientProfile
            ClientProfile::updateOrCreate(
                ['user_id' => Auth::id()],
                $clientProfileData
            );

            return redirect()->route('profile-akun')
                ->with('success', 'Informasi akun berhasil diperbarui!');
            
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }
}