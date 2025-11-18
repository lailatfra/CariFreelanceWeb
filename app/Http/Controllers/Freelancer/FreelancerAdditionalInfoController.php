<?php

namespace App\Http\Controllers\Freelancer;

use App\Http\Controllers\Controller;
use App\Models\FreelancerProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class FreelancerAdditionalInfoController extends Controller
{
    /**
     * Get freelancer additional info
     */
    public function getInfo()
{
    try {
        // Log request info
        Log::info('=== FREELANCER GET INFO START ===');
        Log::info('Request URL: ' . request()->url());
        Log::info('Request Method: ' . request()->method());
        
        $userId = Auth::id();
        Log::info('User ID: ' . $userId);
        
        if (!$userId) {
            Log::error('User not authenticated!');
            return response()->json([
                'success' => false,
                'message' => 'User not authenticated'
            ], 401);
        }
        
        $profile = FreelancerProfile::where('user_id', $userId)->first();
        Log::info('Profile found: ' . (!is_null($profile) ? 'YES' : 'NO'));
        
        if (!$profile) {
            Log::warning('Profile not found for user: ' . $userId);
            return response()->json([
                'success' => true,
                'data' => null,
                'message' => 'Profile belum dibuat'
            ]);
        }
        
        $data = [
            'bio' => $profile->bio,
            'experience' => $profile->experience_years,
            'headline' => $profile->headline,
            'skills' => $profile->skills,
            'experience_level' => $profile->experience_level,
            'portfolio_title' => $profile->portfolio_title,
            'portfolio_description' => $profile->portfolio_description,
            'portofolio_link' => $profile->portofolio_link,
            'portfolio_category' => $profile->portfolio_category,
            'portfolio_tech' => $profile->portfolio_tech,
            'education' => $profile->education,
            'graduation_year' => $profile->graduation_year,
            'certifications' => $profile->certifications,
            'courses' => $profile->courses,
            'languages' => $profile->languages ? json_decode($profile->languages, true) : [],
        ];
        
        Log::info('Data prepared successfully');
        Log::info('=== FREELANCER GET INFO END ===');
        
        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    } catch (\Exception $e) {
        Log::error('=== ERROR IN GET INFO ===');
        Log::error('Error: ' . $e->getMessage());
        Log::error('File: ' . $e->getFile());
        Log::error('Line: ' . $e->getLine());
        Log::error('Trace: ' . $e->getTraceAsString());
        
        return response()->json([
            'success' => false,
            'message' => 'Terjadi kesalahan: ' . $e->getMessage()
        ], 500);
    }
}

    /**
     * Update bio and experience
     */
    public function updateBio(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'bio' => 'required|string|min:10',
            'experience' => 'nullable|string',
            'headline' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first()
            ], 422);
        }

        try {
            $profile = FreelancerProfile::where('user_id', Auth::id())->first();
            
            if (!$profile) {
                return response()->json([
                    'success' => false,
                    'message' => 'Profile tidak ditemukan'
                ], 404);
            }

            $profile->update([
                'bio' => $request->bio,
                'experience_years' => $request->experience,
                'headline' => $request->headline,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Bio berhasil disimpan!'
            ]);
        } catch (\Exception $e) {
            Log::error('Error updateBio: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update skills
     */
    public function updateSkills(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'skills' => 'required|array|min:1',
            'custom_skills' => 'nullable|string',
            'experience_level' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first()
            ], 422);
        }

        try {
            $profile = FreelancerProfile::where('user_id', Auth::id())->first();
            
            if (!$profile) {
                return response()->json([
                    'success' => false,
                    'message' => 'Profile tidak ditemukan'
                ], 404);
            }

            // Combine checkbox skills with custom skills
            $allSkills = $request->skills;
            if ($request->custom_skills) {
                $customSkillsArray = array_map('trim', explode(',', $request->custom_skills));
                $allSkills = array_merge($allSkills, $customSkillsArray);
            }

            $profile->update([
                'skills' => implode(',', $allSkills),
                'experience_level' => $request->experience_level,
            ]);

            return response()->json([
                'success' => true,
                'message' => count($allSkills) . ' keahlian berhasil disimpan!'
            ]);
        } catch (\Exception $e) {
            Log::error('Error updateSkills: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update portfolio
     */
    public function updatePortfolio(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'portfolio_title' => 'required|string|max:255',
            'portfolio_description' => 'required|string',
            'portofolio_link' => 'nullable|url|max:255',
            'portfolio_category' => 'nullable|string',
            'portfolio_tech' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first()
            ], 422);
        }

        try {
            $profile = FreelancerProfile::where('user_id', Auth::id())->first();
            
            if (!$profile) {
                return response()->json([
                    'success' => false,
                    'message' => 'Profile tidak ditemukan'
                ], 404);
            }

            $profile->update([
                'portfolio_title' => $request->portfolio_title,
                'portfolio_description' => $request->portfolio_description,
                'portofolio_link' => $request->portofolio_link,
                'portfolio_category' => $request->portfolio_category,
                'portfolio_tech' => $request->portfolio_tech,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Portfolio berhasil disimpan!'
            ]);
        } catch (\Exception $e) {
            Log::error('Error updatePortfolio: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update education and certifications
     */
    public function updateEducation(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'education' => 'required|string|max:255',
            'graduation_year' => 'nullable|integer|min:1990|max:2030',
            'certifications' => 'nullable|string',
            'courses' => 'nullable|string',
            'languages' => 'nullable|array',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first()
            ], 422);
        }

        try {
            $profile = FreelancerProfile::where('user_id', Auth::id())->first();
            
            if (!$profile) {
                return response()->json([
                    'success' => false,
                    'message' => 'Profile tidak ditemukan'
                ], 404);
            }

            $profile->update([
                'education' => $request->education,
                'graduation_year' => $request->graduation_year,
                'certifications' => $request->certifications,
                'courses' => $request->courses,
                'languages' => json_encode($request->languages),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Pendidikan & sertifikat berhasil disimpan!'
            ]);
        } catch (\Exception $e) {
            Log::error('Error updateEducation: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}