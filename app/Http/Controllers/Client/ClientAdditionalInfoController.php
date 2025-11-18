<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\ClientAdditionalInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ClientAdditionalInfoController extends Controller
{
    /**
     * Update or create company information
     */
    public function updateCompanyInfo(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'company_name' => 'required|string|max:255',
            'industry' => 'required|string|max:255',
            'company_size' => 'nullable|string|max:255',
            'company_description' => 'nullable|string',
            'website' => 'nullable|url|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first()
            ], 422);
        }

        $info = ClientAdditionalInfo::updateOrCreate(
            ['user_id' => Auth::id()],
            [
                'company_name' => $request->company_name,
                'industry' => $request->industry,
                'company_size' => $request->company_size,
                'company_description' => $request->company_description,
                'website' => $request->website,
            ]
        );

        return response()->json([
            'success' => true,
            'message' => 'Informasi perusahaan berhasil disimpan!'
        ]);
    }

    /**
     * Update vision and mission
     */
    public function updateVisionMission(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'company_vision' => 'required|string',
            'company_mission' => 'required|string',
            'company_values' => 'nullable|string',
            'company_goals' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first()
            ], 422);
        }

        $info = ClientAdditionalInfo::updateOrCreate(
            ['user_id' => Auth::id()],
            [
                'company_vision' => $request->company_vision,
                'company_mission' => $request->company_mission,
                'company_values' => $request->company_values,
                'company_goals' => $request->company_goals,
            ]
        );

        return response()->json([
            'success' => true,
            'message' => 'Visi & Misi berhasil disimpan!'
        ]);
    }

    /**
     * Update communication preferences
     */
    public function updateCommunication(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'communication_platforms' => 'required|array|min:1',
            'update_frequency' => 'nullable|string',
            'timezone' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first()
            ], 422);
        }

        $info = ClientAdditionalInfo::updateOrCreate(
            ['user_id' => Auth::id()],
            [
                'communication_platforms' => $request->communication_platforms,
                'update_frequency' => $request->update_frequency,
                'timezone' => $request->timezone,
            ]
        );

        return response()->json([
            'success' => true,
            'message' => 'Preferensi komunikasi berhasil disimpan!'
        ]);
    }

    /**
     * Update social media
     */
    public function updateSocialMedia(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'social_website' => 'nullable|url|max:255',
            'social_linkedin' => 'nullable|url|max:255',
            'social_instagram' => 'nullable|url|max:255',
            'social_facebook' => 'nullable|url|max:255',
            'social_twitter' => 'nullable|url|max:255',
            'social_youtube' => 'nullable|url|max:255',
            'social_tiktok' => 'nullable|url|max:255',
            'social_other' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first()
            ], 422);
        }

        $hasSocialMedia = $request->social_website || $request->social_linkedin || 
                         $request->social_instagram || $request->social_facebook || 
                         $request->social_twitter || $request->social_youtube || 
                         $request->social_tiktok;

        if (!$hasSocialMedia) {
            return response()->json([
                'success' => false,
                'message' => 'Tambahkan minimal satu media sosial!'
            ], 422);
        }

        $info = ClientAdditionalInfo::updateOrCreate(
            ['user_id' => Auth::id()],
            [
                'social_website' => $request->social_website,
                'social_linkedin' => $request->social_linkedin,
                'social_instagram' => $request->social_instagram,
                'social_facebook' => $request->social_facebook,
                'social_twitter' => $request->social_twitter,
                'social_youtube' => $request->social_youtube,
                'social_tiktok' => $request->social_tiktok,
                'social_other' => $request->social_other,
            ]
        );

        return response()->json([
            'success' => true,
            'message' => 'Media sosial berhasil disimpan!'
        ]);
    }

    /**
     * Get client additional info
     */
    public function getInfo()
    {
        $info = ClientAdditionalInfo::where('user_id', Auth::id())->first();
        
        return response()->json([
            'success' => true,
            'data' => $info
        ]);
    }
}