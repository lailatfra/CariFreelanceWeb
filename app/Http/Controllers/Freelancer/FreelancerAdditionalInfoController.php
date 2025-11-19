<?php

namespace App\Http\Controllers\Freelancer;

use App\Http\Controllers\Controller;
use App\Models\FreelancerAdditionalInfo;
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
            
            // PERBAIKAN: Gunakan model FreelancerAdditionalInfo
            $additionalInfo = FreelancerAdditionalInfo::where('user_id', $userId)->first();
            Log::info('Additional Info found: ' . (!is_null($additionalInfo) ? 'YES' : 'NO'));
            
            if (!$additionalInfo) {
                Log::warning('Additional info not found for user: ' . $userId);
                return response()->json([
                    'success' => true,
                    'data' => null,
                    'message' => 'Additional info belum dibuat'
                ]);
            }
            
            $data = [
                'bio' => $additionalInfo->bio,
                'experience' => $additionalInfo->experience,
                'headline' => $additionalInfo->headline,
                'skills' => $additionalInfo->skills,
                'experience_level' => $additionalInfo->experience_level,
                'portfolio_title' => $additionalInfo->portfolio_title,
                'portfolio_description' => $additionalInfo->portfolio_description,
                'portofolio_link' => $additionalInfo->portofolio_link,
                'portfolio_category' => $additionalInfo->portfolio_category,
                'portfolio_tech' => $additionalInfo->portfolio_tech,
                'education' => $additionalInfo->education,
                'graduation_year' => $additionalInfo->graduation_year,
                'certifications' => $additionalInfo->certifications,
                'courses' => $additionalInfo->courses,
                'languages' => $additionalInfo->languages,
                'hourly_rate' => $additionalInfo->hourly_rate,
                'project_rate' => $additionalInfo->project_rate,
                'service_types' => $additionalInfo->service_types,
                'availability' => $additionalInfo->availability,
                'response_time' => $additionalInfo->response_time,
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
            $userId = Auth::id();
            
            // PERBAIKAN: Gunakan updateOrCreate untuk tabel freelancer_additional_infos
            $additionalInfo = FreelancerAdditionalInfo::updateOrCreate(
                ['user_id' => $userId],
                [
                    'bio' => $request->bio,
                    'experience' => $request->experience,
                    'headline' => $request->headline,
                ]
            );

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
            $userId = Auth::id();

            // Combine checkbox skills with custom skills
            $allSkills = $request->skills;
            if ($request->custom_skills) {
                $customSkillsArray = array_map('trim', explode(',', $request->custom_skills));
                $allSkills = array_merge($allSkills, $customSkillsArray);
            }

            FreelancerAdditionalInfo::updateOrCreate(
                ['user_id' => $userId],
                [
                    'skills' => implode(',', $allSkills),
                    'experience_level' => $request->experience_level,
                ]
            );

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
            $userId = Auth::id();

            FreelancerAdditionalInfo::updateOrCreate(
                ['user_id' => $userId],
                [
                    'portfolio_title' => $request->portfolio_title,
                    'portfolio_description' => $request->portfolio_description,
                    'portofolio_link' => $request->portofolio_link,
                    'portfolio_category' => $request->portfolio_category,
                    'portfolio_tech' => $request->portfolio_tech,
                ]
            );

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
            $userId = Auth::id();

            FreelancerAdditionalInfo::updateOrCreate(
                ['user_id' => $userId],
                [
                    'education' => $request->education,
                    'graduation_year' => $request->graduation_year,
                    'certifications' => $request->certifications,
                    'courses' => $request->courses,
                    'languages' => $request->languages, // Cast otomatis ke array
                ]
            );

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

    /**
     * Update rate and availability
     */
    public function updateRate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'hourly_rate' => 'nullable|numeric|min:0',
            'project_rate' => 'nullable|numeric|min:0',
            'service_types' => 'nullable|array',
            'availability' => 'nullable|string',
            'response_time' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first()
            ], 422);
        }

        try {
            $userId = Auth::id();

            FreelancerAdditionalInfo::updateOrCreate(
                ['user_id' => $userId],
                [
                    'hourly_rate' => $request->hourly_rate,
                    'project_rate' => $request->project_rate,
                    'service_types' => $request->service_types, // Cast otomatis ke array
                    'availability' => $request->availability,
                    'response_time' => $request->response_time,
                ]
            );

            return response()->json([
                'success' => true,
                'message' => 'Tarif & ketersediaan berhasil disimpan!'
            ]);
        } catch (\Exception $e) {
            Log::error('Error updateRate: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}