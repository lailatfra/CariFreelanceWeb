<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClientProfile;
use App\Models\ClientAdditionalInfo;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

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

    // NEW METHOD: Show account settings page
    public function showAccount()
    {
        $user = Auth::user();
        $clientProfile = ClientProfile::where('user_id', $user->id)->first();
        $additionalInfo = ClientAdditionalInfo::where('user_id', $user->id)->first();

        return view('client.settings.profil-akun', compact('user', 'clientProfile', 'additionalInfo'));
    }

    // NEW METHOD: Update account information
    public function updateAccount(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255|unique:users,username,' . Auth::id(),
            'display_name' => 'required|string|max:255',
            'birth_date' => 'nullable|date',
            'birth_month' => 'nullable|integer|between:1,12',
            'birth_year' => 'nullable|integer|min:1900|max:' . date('Y'),
            'company_name' => 'nullable|string|max:255',
            'industry' => 'nullable|string|max:255',
            'company_size' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'location' => 'nullable|string|max:255',
            'bio' => 'nullable|string|max:1000',
            'website' => 'nullable|url|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            // Update User table
            $user = User::findOrFail(Auth::id());
            $user->username = $request->username;
            $user->name = $request->display_name;
            
            // Combine birth date if all parts are provided
            if ($request->birth_date && $request->birth_month && $request->birth_year) {
                $user->birth_date = sprintf(
                    '%04d-%02d-%02d',
                    $request->birth_year,
                    $request->birth_month,
                    $request->birth_date
                );
            }
            
            $user->save();

            // Update or Create ClientProfile
            ClientProfile::updateOrCreate(
                ['user_id' => Auth::id()],
                [
                    'company_name' => $request->company_name,
                    'phone' => $request->phone,
                    'location' => $request->location,
                    'bio' => $request->bio,
                ]
            );

            // Update or Create ClientAdditionalInfo
            ClientAdditionalInfo::updateOrCreate(
                ['user_id' => Auth::id()],
                [
                    'company_name' => $request->company_name,
                    'industry' => $request->industry,
                    'company_size' => $request->company_size,
                    'website' => $request->website,
                ]
            );

            return redirect()->back()->with('success', 'Informasi akun berhasil diperbarui!');
            
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    // NEW METHOD: Update avatar/profile photo
    public function updateAvatar(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'avatar' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', 'File harus berupa gambar (jpg, jpeg, png) dan maksimal 2MB');
        }

        try {
            $clientProfile = ClientProfile::where('user_id', Auth::id())->first();
            
            // Delete old photo if exists and not default
            if ($clientProfile && $clientProfile->profile_photo && $clientProfile->profile_photo !== 'profile_photos/default.png') {
                Storage::disk('public')->delete($clientProfile->profile_photo);
            }

            // Store new photo
            $photoPath = $request->file('avatar')->store('profile_photos', 'public');

            // Update or create profile with new photo
            ClientProfile::updateOrCreate(
                ['user_id' => Auth::id()],
                ['profile_photo' => $photoPath]
            );

            return redirect()->back()->with('success', 'Foto profil berhasil diperbarui!');
            
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}