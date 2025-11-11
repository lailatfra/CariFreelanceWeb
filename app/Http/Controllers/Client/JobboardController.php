<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Proposal;
use App\Models\SubmitProject;
use App\Models\Progress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class JobboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // Ambil projects yang dibuat oleh client ini (open projects)
        $openProjects = Project::where('user_id', $userId)
            ->where('status', 'open')
            ->with('proposalls.user')
            ->orderBy('created_at', 'asc')
            ->get();

        $projects = Project::with([
            'proposalls.user',
            'timelines',
            'submitProjects' => function($q) {
                $q->latest(); // ambil submit terbaru
            }
        ])
        ->where('user_id', $userId)
        ->whereHas('proposalls', function($query) {
            $query->where('status', 'accepted');
        })
        ->orderByDesc('created_at')
        ->get();


        // Ambil semua proposals dari client ini
        $proposals = Proposal::with(['project.client'])
            ->whereHas('project', function($q) use ($userId) {
                $q->where('user_id', $userId);
            })
            ->get();

        // Ambil completed projects (status selesai)
        $completed = SubmitProject::with(['project.client', 'user', 'proposal'])
            ->whereHas('project', function ($q) use ($userId) {
                $q->where('user_id', $userId);
            })
            ->where('status', 'selesai')
            ->get();

        // Process completed projects untuk mendapatkan semua links
        $completed = $completed->map(function($submission) use ($userId) {
            $projectId = $submission->project_id;
            
            // Ambil links dari submit_project (kolom 'links')
            $finalLinks = [];
            if (is_array($submission->links)) {
                $finalLinks = $submission->links;
            }
            
            // Ambil links dari progress_uploads (kolom 'link_url')
            $progressLinks = [];
            $progressUploads = Progress::where('project_id', $projectId)->get();
            
            foreach($progressUploads as $progress) {
                if ($progress->link_url) {
                    $progressLinks[] = $progress->link_url;
                }
            }
            
            // Gabungkan semua links
            $allLinks = array_unique(array_merge($finalLinks, $progressLinks));
            
            $submission->all_links = $allLinks;
            $submission->total_links_count = count($allLinks);
            
            return $submission;
        });

        return view('client.projek', compact('openProjects', 'projects', 'completed', 'proposals'));
    }

public function getProjectProgress($projectId)
{
    try {
        $project = Project::with(['proposalls.user'])
            ->where('id', $projectId)
            ->where('user_id', Auth::id())
            ->first();

        if (!$project) {
            return response()->json([
                'success' => false,
                'message' => 'Project tidak ditemukan atau bukan milik Anda.',
            ], 404);
        }


        // cari freelancer yang accepted
        $acceptedProposal = $project->proposalls
            ->where('status', 'accepted')
            ->first();

        $freelancerName = $acceptedProposal?->user?->name ?? 'Unknown Freelancer';

        // ambil progress uploads
        $progressUploads = \App\Models\Progress::where('project_id', $projectId)->get();

        $links = $progressUploads->map(fn($p) => [
            'url' => $p->link_url,
        ]);

        return response()->json([
            'project' => [
                'id'    => $project->id,
                'title' => $project->title,
            ],
            'freelancer_name' => $freelancerName,
            'total_links'     => $links->count(),
            'links'           => $links,
        ]);
    } catch (\Exception $e) {
        \Log::error('Error in getProjectProgress', [
            'error' => $e->getMessage(),
            'line' => $e->getLine(),
        ]);
        return response()->json([
            'success' => false,
            'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
        ], 500);
    }
}


    public function updateStatus(Request $request, SubmitProject $submitProject)
    {
        try {
            Log::info('updateStatus called', [
                'submission_id' => $submitProject->id,
                'current_status' => $submitProject->status,
                'request_status' => $request->status,
                'user_id' => Auth::id()
            ]);

            $request->validate([
                'status' => 'required|in:pending,revisi,selesai',
                'notes' => 'nullable|string|min:10|max:1000', // Untuk kolom notes
            ]);

            // Validasi: notes harus ada jika status revisi
            if ($request->status === 'revisi' && empty($request->notes)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Catatan revisi harus diisi minimal 10 karakter!'
                ], 422);
            }

            // Pastikan submit project ini milik project client yang sedang login
            if ($submitProject->project->user_id !== Auth::id()) {
                Log::warning('Unauthorized access attempt', [
                    'submission_id' => $submitProject->id,
                    'project_owner' => $submitProject->project->user_id,
                    'requesting_user' => Auth::id()
                ]);
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized access to this project'
                ], 403);
            }

            // Pastikan status saat ini memungkinkan update
            $allowedTransitions = [
                'pending' => ['revisi', 'selesai'],
                'revisi' => ['pending', 'selesai']
            ];

            $currentStatus = $submitProject->status;
            if (!isset($allowedTransitions[$currentStatus]) || !in_array($request->status, $allowedTransitions[$currentStatus])) {
                Log::warning('Invalid status transition', [
                    'current' => $currentStatus,
                    'requested' => $request->status,
                    'allowed' => $allowedTransitions[$currentStatus] ?? []
                ]);
                return response()->json([
                    'success' => false,
                    'message' => "Transisi status tidak diizinkan dari '{$currentStatus}' ke '{$request->status}'"
                ], 422);
            }

            $oldStatus = $submitProject->status;
            $updateData = ['status' => $request->status];
            
            // Simpan catatan revisi di kolom notes
            if ($request->status === 'revisi') {
                $updateData['notes'] = $request->notes; // Gunakan kolom notes untuk catatan client
                Log::info('Saving revision notes', ['notes_length' => strlen($request->notes)]);
            }

            $submitProject->update($updateData);

            Log::info('Status updated successfully', [
                'submission_id' => $submitProject->id,
                'old_status' => $oldStatus,
                'new_status' => $request->status,
                'client_id' => Auth::id(),
                'notes_saved' => isset($updateData['notes']) ? 'yes' : 'no'
            ]);

            $message = match($request->status) {
                'selesai' => 'Project berhasil disetujui dan ditandai selesai! Freelancer akan menerima pembayaran penuh.',
                'revisi' => 'Catatan revisi berhasil dikirim ke freelancer! Status berubah menjadi "Revisi".',
                default => 'Status berhasil diperbarui!'
            };

            return response()->json([
                'success' => true,
                'message' => $message,
                'data' => $submitProject->fresh()
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation error in updateStatus', [
                'submission_id' => $submitProject->id ?? 'unknown',
                'errors' => $e->errors()
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal: ' . implode(', ', array_flatten($e->errors())),
                'errors' => $e->errors()
            ], 422);
            
        } catch (\Exception $e) {
            Log::error('Error in client updateStatus:', [
                'submission_id' => $submitProject->id ?? 'unknown',
                'project_id' => $submitProject->project_id ?? 'unknown',
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'line' => $e->getLine(),
                'file' => $e->getFile()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan server: ' . $e->getMessage()
            ], 500);
        }
    }

    public function accept($id)
    {
        $proposal = Proposal::findOrFail($id);

        $proposal->status = 'accepted';
        $proposal->save();

        Proposal::where('project_id', $proposal->project_id)
            ->where('id', '!=', $proposal->id)
            ->update(['status' => 'rejected']);

        return redirect()->back()->with('success', 'Freelancer berhasil dipilih!');
    }
    
    public function showProposal(Proposal $proposal)
    {
        $proposal->load(['user.freelancerProfile', 'project']);
        return view('client.freelancer.1-1', compact('proposal'));
    }

    public function freelancer(Proposal $proposal)
    {
        $proposal->load(['user.freelancerProfile', 'project']);
        return view('freelancer.profile.profil', compact('proposal'));
    }

    
}