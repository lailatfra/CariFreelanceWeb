<?php

namespace App\Http\Controllers;

use App\Models\Withdrawal;
use App\Models\Wallet;
use App\Models\FreelancerProfile;
use App\Models\Rating;
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

    public function showContactInfo()
    {
        return view('freelancer.settings.profil-kontak');
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
            'bio'               => 'nullable|string|max:1000',
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
            'rating'            => 0,
            'review_count'      => 0,
            'project_count'     => 0,
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
            ->with('user')
            ->first();

        $user = Auth::user();
    
    // Ambil data profil freelancer
    $freelancerProfile = FreelancerProfile::where('user_id', $user->id)->first();
    
    // Ambil data wallet
    $wallet = Wallet::where('user_id', $user->id)->first();
    
    // Hitung total pending dari tabel withdrawals dengan status 'pending'
    $totalPending = Withdrawal::where('user_id', $user->id)
        ->where('status', 'pending')
        ->sum('amount');

        // Jika belum ada profile, redirect ke halaman create
        if (!$freelancerProfile) {
            return redirect()->route('freelancer.profile.create')
                ->with('message', 'Silakan lengkapi profil freelancer Anda terlebih dahulu.');
        }

        return view('freelancer.profile.profil', compact('freelancerProfile', 'freelancerProfile', 
        'wallet', 
        'totalPending'));
    }


    public function edit()
    {
        $freelancerProfile = FreelancerProfile::where('user_id', Auth::id())
            ->with('user')
            ->first();

        if (!$freelancerProfile) {
            return redirect()->route('freelancer.profile.create');
        }

        // Gunakan view yang sama dengan profil-akun
        return view('freelancer.settings.profil-akun', compact('freelancerProfile'));
    }

    public function update(Request $request)
    {
        $freelancerProfile = FreelancerProfile::where('user_id', Auth::id())->first();

        if (!$freelancerProfile) {
            return redirect()->route('freelancer.profile.create')
                ->with('error', 'Profile tidak ditemukan. Silakan buat profile terlebih dahulu.');
        }

        // Validasi data
        $rules = [
            'full_name'         => 'required|string|max:255',
            'headline'          => 'nullable|string|max:255',
            'location'          => 'nullable|string|max:255',
            'phone'             => 'nullable|string|max:20',
            'bio'               => 'nullable|string|max:1000',
            'skills'            => 'nullable|string',
            'subskills'         => 'nullable|string',
            'experience_years'  => 'nullable|integer|min:0|max:50',
            'hourly_rate'       => 'nullable|numeric|min:0',
            'category'          => 'nullable|string|max:100',
            'work_type'         => 'nullable|string|max:50',
            'languages'         => 'nullable|string',
            'portofolio_link'   => 'nullable|url',
            'profile_photo'     => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'identity_document' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:4096',
            'npwp'              => 'nullable|string|max:30',
        ];

        // Username hanya bisa diubah jika berbeda dari yang sekarang
        if ($request->username !== $freelancerProfile->username) {
            $rules['username'] = 'required|string|max:50|unique:freelancer_profiles,username';
        }

        $validatedData = $request->validate($rules);

        // Handle file upload untuk profile photo
        if ($request->hasFile('profile_photo')) {
            // Hapus foto lama jika ada
            if ($freelancerProfile->profile_photo) {
                Storage::disk('public')->delete($freelancerProfile->profile_photo);
            }
            
            $path = $request->file('profile_photo')->store('freelancer_photos', 'public');
            $validatedData['profile_photo'] = $path;
        }

        // Handle file upload untuk identity document
        if ($request->hasFile('identity_document')) {
            // Hapus dokumen lama jika ada
            if ($freelancerProfile->identity_document) {
                Storage::disk('public')->delete($freelancerProfile->identity_document);
            }
            
            $path = $request->file('identity_document')->store('freelancer_documents', 'public');
            $validatedData['identity_document'] = $path;
        }

        // Update profile
        $freelancerProfile->update($validatedData);

        return redirect()->route('freelancer-profile-akun')
            ->with('success', 'Profil berhasil diperbarui!');
    }

    /**
     * Method untuk menampilkan profil publik berdasarkan user_id
     */
     public function showPublic($id)
    {
        $freelancerProfile = FreelancerProfile::with(['user', 'ratings.user', 'ratings.project'])
            ->where('user_id', $id)
            ->first();

        if (!$freelancerProfile) {
            return redirect()->back()
                ->with('error', 'Profil freelancer tidak ditemukan atau belum lengkap.');
        }

        // ✅ Hitung data rating
        $averageRating = $freelancerProfile->average_rating;
        $totalReviews = $freelancerProfile->total_reviews;
        $ratingBreakdown = $freelancerProfile->rating_breakdown;
        $latestReviews = $freelancerProfile->latest_reviews;
        $ratingDistribution = $freelancerProfile->rating_distribution;
        $completedProjects = $freelancerProfile->completed_projects_count;

        return view('freelancer.profile.profile-publik', compact(
            'freelancerProfile',
            'averageRating',
            'totalReviews',
            'ratingBreakdown',
            'latestReviews',
            'ratingDistribution',
            'completedProjects'
        ));
    }

    /**
     * Method untuk menampilkan profil berdasarkan username
     */
    public function showPublicByUsername($username)
    {
        $freelancerProfile = FreelancerProfile::with(['user', 'ratings.user', 'ratings.project'])
            ->where('username', $username)
            ->first();

        if (!$freelancerProfile) {
            return redirect()->back()
                ->with('error', 'Profil freelancer tidak ditemukan.');
        }

        // ✅ Hitung data rating
        $averageRating = $freelancerProfile->average_rating;
        $totalReviews = $freelancerProfile->total_reviews;
        $ratingBreakdown = $freelancerProfile->rating_breakdown;
        $latestReviews = $freelancerProfile->latest_reviews;
        $ratingDistribution = $freelancerProfile->rating_distribution;
        $completedProjects = $freelancerProfile->completed_projects_count;

        return view('freelancer.profile.profile-publik', compact(
            'freelancerProfile',
            'averageRating',
            'totalReviews',
            'ratingBreakdown',
            'latestReviews',
            'ratingDistribution',
            'completedProjects'
        ));
    }
    /**
     * Method untuk menampilkan halaman account settings
     */
    public function showAccount()
    {
        $freelancerProfile = FreelancerProfile::where('user_id', Auth::id())
            ->with('user')
            ->first();

        if (!$freelancerProfile) {
            return redirect()->route('freelancer.profile.create')
                ->with('message', 'Silakan lengkapi profil freelancer Anda terlebih dahulu.');
        }

        return view('freelancer.settings.profil-akun', compact('freelancerProfile'));
    }

    
}