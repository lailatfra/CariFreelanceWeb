<?php

namespace App\Http\Controllers;

use App\Models\Progress;
use App\Models\Project;
use App\Models\Timeline;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProgressController extends Controller
{
    public function store(Request $request)
    {
        // Debug dengan format yang benar
        Log::info('Progress store request:', $request->all());
        Log::info('User ID:', ['user_id' => auth()->id()]); // Perbaikan di sini
        
        try {
            $validated = $request->validate([
                'project_id'   => 'required|exists:projects,id',
                'timeline_id'  => 'required|exists:timelines,id',
                'description'  => 'required|string',
                'link_url'     => 'required|url',
                'client_notes' => 'nullable|string',
            ]);
            
            Log::info('Validated data:', $validated);

            // Check if timeline exists and is not completed
            $timeline = Timeline::find($validated['timeline_id']);
                     
            if (!$timeline) {
                Log::error('Timeline not found:', ['timeline_id' => $validated['timeline_id']]);
                return response()->json([
                    'success' => false,
                    'message' => 'Timeline tidak ditemukan'
                ], 404);
            }

            // Check if timeline is already completed
            if ($timeline->status == 'selesai') {
                Log::warning('Timeline already completed:', ['timeline_id' => $validated['timeline_id']]);
                return response()->json([
                    'success' => false,
                    'message' => 'Timeline ini sudah selesai'
                ], 400);
            }

            // Create progress upload
            $progress = Progress::create([
                'project_id'   => $validated['project_id'],
                'timeline_id'  => $validated['timeline_id'],
                'description'  => $validated['description'],
                'link_url'     => $validated['link_url'],
                'client_notes' => $validated['client_notes'] ?? null,
            ]);

            Log::info('Progress created:', ['progress_id' => $progress->id]);

            // Update timeline status to completed
            $timeline->update(['status' => 'selesai']);
            
            Log::info('Timeline updated to selesai:', ['timeline_id' => $timeline->id]);

            return response()->json([
                'success' => true,
                'message' => 'Progress berhasil diupload dan timeline telah diselesaikan',
                'data'    => $progress
            ]);
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation error:', ['errors' => $e->errors()]);
            return response()->json([
                'success' => false,
                'message' => 'Data tidak valid',
                'errors' => $e->errors()
            ], 422);
            
        } catch (\Exception $e) {
            Log::error('General error in progress store:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function show($projectId)
    {
        $project = Project::find($projectId);

        if (!$project) {
            \Log::warning('Project tidak ditemukan', ['id' => $projectId]);
            return response()->json([
                'success' => false,
                'message' => 'Project tidak ditemukan'
            ], 404);
        }

        // ambil freelancer dari tabel proposalls dengan status accepted
        $freelancerName = optional(
            $project->proposalls()
                    ->where('status', 'accepted')
                    ->with('user')
                    ->first()
        )->user->name ?? '-';

        // ambil progress dari tabel progress_uploads
        $progress = \App\Models\Progress::where('project_id', $projectId)->get();

        // hitung total milestone selesai dari timelines
        $totalFiles = \App\Models\Timeline::where('project_id', $projectId)
                        ->where('status', 'selesai')
                        ->count();

        return response()->json([
            'id'    => $project->id,
            'title' => $project->title,
            'freelancer_name' => $freelancerName,
            'total_links'     => $totalFiles,
            'links'           => $progress->map(fn($p) => [
                'url' => $p->link_url, // kolom link_url di progress_uploads
            ]),
        ]);
    }



    public function index($projectId)
    {
        $progress = Progress::where('project_id', $projectId)
            ->with(['timeline', 'project'])
            ->latest()
            ->get();

        return response()->json($progress);
    }

    public function destroy($id)
    {
        $progress = Progress::findOrFail($id);
                 
        // Optionally revert timeline status back to 'belum_selesai'
        if ($progress->timeline) {
            $progress->timeline->update(['status' => 'belum_selesai']);
        }
                 
        $progress->delete();

        return response()->json([
            'success' => true,
            'message' => 'Progress berhasil dihapus',
        ]);
    }
}