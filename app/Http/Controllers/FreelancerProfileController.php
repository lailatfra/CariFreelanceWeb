<?php

namespace App\Http\Controllers;

use App\Models\FreelancerProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class FreelancerProfileController extends Controller
{
    public function create()
    {
        return view('freelancer.profile.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'full_name'         => 'required|string|max:255',
            'skills'            => 'nullable|string',
            'experience_years'  => 'nullable|integer',
            'portofolio_link'   => 'nullable|url',
            'phone'             => 'nullable|string|max:20',
            'profile_photo'     => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'username'          => 'required|string|max:50|unique:freelancer_profiles,username',
            'headline'          => 'nullable|string|max:255',
            'location'          => 'nullable|string|max:255',
            'category'          => 'nullable|string|max:100',
            'subskills'         => 'nullable|string',
            'bio'               => 'nullable|string',
            'identity_document' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:4096',
            'npwp'              => 'nullable|string|max:30',
            'hourly_rate'       => 'nullable|numeric',
            'languages'         => 'nullable|string',
            'work_type'         => 'nullable|string|max:50',
        ]);

        // Upload profile photo
        $profilePhotoPath = null;
        if ($request->hasFile('profile_photo')) {
            $profilePhotoPath = $request->file('profile_photo')->store('freelancer_photos', 'public');
        }

        // Upload identity document
        $identityDocPath = null;
        if ($request->hasFile('identity_document')) {
            $identityDocPath = $request->file('identity_document')->store('freelancer_documents', 'public');
        }

        FreelancerProfile::create([
            'user_id'           => Auth::id(),
            'full_name'         => $request->full_name,
            'skills'            => $request->skills,
            'experience_years'  => $request->experience_years,
            'portofolio_link'   => $request->portofolio_link,
            'phone'             => $request->phone,
            'profile_photo'     => $profilePhotoPath,
            'username'          => $request->username,
            'headline'          => $request->headline,
            'location'          => $request->location,
            'category'          => $request->category,
            'subskills'         => $request->subskills,
            'bio'               => $request->bio,
            'identity_document' => $identityDocPath,
            'npwp'              => $request->npwp,
            'hourly_rate'       => $request->hourly_rate,
            'languages'         => $request->languages,
            'work_type'         => $request->work_type,
            'rating'            => 0, // default
            'review_count'      => 0, // default
            'project_count'     => 0, // default
        ]);

        // Logout dan bersihkan session register
        Auth::logout();
        Session::forget(['register.role']);

        return redirect()->route('pending')->with('success', 'Pendaftaran berhasil. Silakan tunggu persetujuan admin.');
    }

    public function show()
    {
        // Ambil data freelancer profile berdasarkan user yang sedang login
        $freelancerProfile = FreelancerProfile::where('user_id', Auth::id())
            ->with('user') // Load relasi user untuk mendapatkan email, created_at, dll
            ->first();

        // Jika belum ada profile, redirect ke halaman create
        if (!$freelancerProfile) {
            return redirect()->route('freelancer.profile.create')
                ->with('message', 'Silakan lengkapi profil freelancer Anda terlebih dahulu.');
        }

        return view('freelancer.profile.profil', compact('freelancerProfile'));
    }

    public function edit()
    {
        $freelancerProfile = FreelancerProfile::where('user_id', Auth::id())
            ->with('user')
            ->first();

        if (!$freelancerProfile) {
            return redirect()->route('freelancer.profile.create');
        }

        return view('freelancer.profile.edit', compact('freelancerProfile'));
    }

    public function update(Request $request)
    {
        $freelancerProfile = FreelancerProfile::where('user_id', Auth::id())->first();

        $validatedData = $request->validate([
            'full_name' => 'required|string|max:255',
            'headline' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'bio' => 'nullable|string',
            'skills' => 'nullable|string',
            'subskills' => 'nullable|string',
            'experience_years' => 'nullable|integer|min:0',
            'hourly_rate' => 'nullable|integer|min:0',
            'category' => 'nullable|string|max:100',
            'work_type' => 'nullable|string|max:50',
            'languages' => 'nullable|string',
            'portofolio_link' => 'nullable|url',
            'profile_photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Handle file upload untuk profile photo
        if ($request->hasFile('profile_photo')) {
            $path = $request->file('profile_photo')->store('profile_photos', 'public');
            $validatedData['profile_photo'] = $path;
        }

        $freelancerProfile->update($validatedData);

        return redirect()->route('freelancer.profile.show')
            ->with('success', 'Profil berhasil diperbarui!');
    }

    /**
     * Method untuk menampilkan profil publik berdasarkan user_id
     * Ini yang akan digunakan dari halaman proposal
     */
    public function showPublic($id)
    {
        // Cari berdasarkan user_id, bukan id freelancer_profile
        $freelancerProfile = FreelancerProfile::with('user')
            ->where('user_id', $id)
            ->first();

        // Jika tidak ditemukan profil freelancer
        if (!$freelancerProfile) {
            return redirect()->back()
                ->with('error', 'Profil freelancer tidak ditemukan atau belum lengkap.');
        }

        return view('freelancer.profile.profile-publik', compact('freelancerProfile'));
    }

    /**
     * Method untuk menampilkan profil berdasarkan username
     */
    public function showPublicByUsername($username)
    {
        $freelancerProfile = FreelancerProfile::with('user')
            ->where('username', $username)
            ->first();

        if (!$freelancerProfile) {
            return redirect()->back()
                ->with('error', 'Profil freelancer tidak ditemukan.');
        }

        return view('freelancer.profile.profile-publik', compact('freelancerProfile'));
    }
}