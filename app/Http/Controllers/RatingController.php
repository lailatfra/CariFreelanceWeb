<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    /**
     * Store a newly created rating
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'project_id' => 'required|exists:projects,id',
                'rating' => 'required|integer|min:1|max:5',
                'ketepatan_waktu' => 'required|in:excellent,good,fair,poor',
                'kualitas_kerja' => 'required|in:outstanding,excellent,good,satisfactory,needs_improvement',
                'review' => 'nullable|string|max:1000'
            ]);

            // Cek apakah user sudah memberikan rating untuk project ini
            $existingRating = Rating::where('user_id', Auth::id())
                ->where('project_id', $validated['project_id'])
                ->first();

            if ($existingRating) {
                return response()->json([
                    'success' => false,
                    'message' => 'Anda sudah memberikan rating untuk project ini.'
                ], 422);
            }

            // Buat rating baru
            $rating = Rating::create([
                'user_id' => Auth::id(),
                'project_id' => $validated['project_id'],
                'rating' => $validated['rating'],
                'ketepatan_waktu' => $validated['ketepatan_waktu'],
                'kualitas_kerja' => $validated['kualitas_kerja'],
                'review' => $validated['review'] ?? null
            ]);

            // Update project status atau field lain jika diperlukan
            $project = Project::find($validated['project_id']);
            // Tambahkan logika bisnis di sini jika diperlukan

            return response()->json([
                'success' => true,
                'message' => 'Rating berhasil disimpan!',
                'rating' => $rating
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get rating for a specific project
     */
/**
 * Get rating for a specific project
 */
public function show($projectId)
{
    try {
        // Cari rating berdasarkan project_id
        $rating = Rating::where('project_id', $projectId)->first();

        if ($rating) {
            return response()->json([
                'success' => true,
                'rating' => $rating
            ]);
        } else {
            return response()->json([
                'success' => false,
                'rating' => null,
                'message' => 'Belum ada rating untuk project ini'
            ]);
        }
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Error: ' . $e->getMessage()
        ], 500);
    }
}
}