<?php

namespace App\Http\Controllers\Freelancer;

use App\Http\Controllers\Controller;
use App\Models\FreelancerProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class FreelancerProfileController extends Controller
{
    /**
     * Update bio and experience
     */
    public function updateBio(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'bio' => 'required|string|min:50',
            'experience' => 'nullable|string',
            'headline' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first()
            ], 422);
        }

        $profile = FreelancerProfile::updateOrCreate(
            ['user_id' => Auth::id()],
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

        // Combine checkbox skills with custom skills
        $allSkills = $request->skills;
        if ($request->custom_skills) {
            $customSkillsArray = array_map('trim', explode(',', $request->custom_skills));
            $allSkills = array_merge($allSkills, $customSkillsArray);
        }

        $profile = FreelancerProfile::updateOrCreate(
            ['user_id' => Auth::id()],
            [
                'skills' => implode(',', $allSkills),
                'experience_level' => $request->experience_level,
            ]
        );

        return response()->json([
            'success' => true,
            'message' => count($allSkills) . ' keahlian berhasil disimpan!'
        ]);
    }

    /**
     * Update portfolio
     */
    public function updatePortfolio(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'portfolio_title' => 'required|string|max:255',
            'portfolio_description' => 'required|string',
            'portfolio_link' => 'nullable|url|max:255',
            'portfolio_category' => 'nullable|string',
            'portfolio_tech' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first()
            ], 422);
        }

        $profile = FreelancerProfile::updateOrCreate(
            ['user_id' => Auth::id()],
            [
                'portfolio_title' => $request->portfolio_title,
                'portfolio_description' => $request->portfolio_description,
                'portofolio_link' => $request->portfolio_link,
                'portfolio_category' => $request->portfolio_category,
                'portfolio_tech' => $request->portfolio_tech,
            ]
        );

        return response()->json([
            'success' => true,
            'message' => 'Portfolio berhasil disimpan!'
        ]);
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

        $profile = FreelancerProfile::updateOrCreate(
            ['user_id' => Auth::id()],
            [
                'education' => $request->education,
                'graduation_year' => $request->graduation_year,
                'certifications' => $request->certifications,
                'courses' => $request->courses,
                'languages' => $request->languages,
            ]
        );

        return response()->json([
            'success' => true,
            'message' => 'Pendidikan & sertifikat berhasil disimpan!'
        ]);
    }

    /**
     * Update rate and availability
     */
    public function updateRate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'hourly_rate' => 'nullable|numeric|min:10000',
            'project_rate' => 'nullable|numeric|min:50000',
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

        if (!$request->hourly_rate && !$request->project_rate) {
            return response()->json([
                'success' => false,
                'message' => 'Atur minimal satu jenis tarif!'
            ], 422);
        }

        $profile = FreelancerProfile::updateOrCreate(
            ['user_id' => Auth::id()],
            [
                'hourly_rate' => $request->hourly_rate,
                'project_rate' => $request->project_rate,
                'service_types' => $request->service_types,
                'availability' => $request->availability,
                'response_time' => $request->response_time,
            ]
        );

        return response()->json([
            'success' => true,
            'message' => 'Tarif berhasil disimpan!'
        ]);
    }

    /**
     * Get freelancer profile info
     */
    public function getInfo()
    {
        $profile = FreelancerProfile::where('user_id', Auth::id())->first();
        
        return response()->json([
            'success' => true,
            'data' => $profile
        ]);
    }
}