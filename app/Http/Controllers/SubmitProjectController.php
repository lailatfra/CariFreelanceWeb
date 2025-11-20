<?php

namespace App\Http\Controllers;

use App\Models\SubmitProject;
use App\Models\Project;
use App\Models\Progress;
use App\Models\Payment;      // ⬅️ TAMBAH
use App\Models\Wallet;       // ⬅️ TAMBAH
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;  // ⬅️ TAMBAH

class SubmitProjectController extends Controller
{
    public function store(Request $request)
    {
        \Log::info('User ID: ' . auth()->id());
        \Log::info('Request data:', $request->all());
        
        try {
            Log::info('SubmitProject Request Data:', $request->all());

            $request->validate([
                'project_id'   => 'required|exists:projects,id',
                'links'        => 'required|string',
                'description'  => 'required|string|min:10',
                'notes'        => 'nullable|string',
            ]);

            $links = [];
            if ($request->filled('links')) {
                $links = array_filter(preg_split("/\r\n|\n|\r/", $request->links));
            }

            // Cek apakah sudah ada submission untuk project ini
            $existing = SubmitProject::where('project_id', $request->project_id)
                ->where('user_id', auth()->id())
                ->first();

            if ($existing) {
                // Update existing submission (untuk resubmit setelah revisi)
                $submission = $existing->update([
                    'links'       => $links,
                    'description' => $request->description,
                    'notes'       => $request->notes,
                    'status'      => 'pending',
                ]);
            } else {
                // Create new submission
                $submission = SubmitProject::create([
                    'user_id'     => auth()->id(),
                    'project_id'  => $request->project_id,
                    'files'       => [],
                    'links'       => $links,
                    'description' => $request->description,
                    'notes'       => $request->notes,
                    'status'      => 'pending',
                ]);
            }

            Log::info('Submission completed successfully:', ['project_id' => $request->project_id]);

            return response()->json([
                'success' => true,
                'message' => $existing ? 'Resubmission berhasil disimpan!' : 'Submission berhasil disimpan!',
                'data' => $submission
            ], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            Log::error('SubmitProject Error:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        Log::info("MASUK method show START", ['id' => $id]);

        $submitProject = SubmitProject::with('project')->findOrFail($id);

        $user = auth()->user();

        $isProjectOwner = $submitProject->project
            ? $submitProject->project->user_id === $user->id
            : false;

        $isSubmitter = $submitProject->user_id === $user->id;

        Log::info('Authorization flags', [
            'isProjectOwner' => $isProjectOwner,
            'isSubmitter'    => $isSubmitter,
        ]);

        if (!$isProjectOwner && !$isSubmitter) {
            return response()->json(['success' => false, 'message' => 'Unauthorized access'], 403);
        }

        return response()->json($submitProject);
    }

    public function completed()
    {
        $userId = auth()->id();

        // Ambil semua submit_project dengan status selesai
        $completedSubmissions = SubmitProject::with(['project.client', 'project.proposalls'])
            ->where('user_id', $userId)
            ->where('status', 'selesai')
            ->get();

        // Untuk setiap submission selesai, ambil semua links dari progress_uploads dan submit_project
        $completed = $completedSubmissions->map(function ($submission) {
            $projectId = $submission->project_id;

            // Ambil links dari submit_project (final submission)
            $finalLinks = $submission->links ?? [];

            // Ambil links dari progress_uploads untuk project ini
            $progressLinks = [];
            $progressUploads = Progress::where('project_id', $projectId)
                ->where('user_id', auth()->id())
                ->get();

            foreach ($progressUploads as $progress) {
                if ($progress->link_url) {
                    $progressLinks[] = $progress->link_url;
                }
            }

            // Gabungkan semua links
            $allLinks = array_unique(array_merge($finalLinks, $progressLinks));

            // Update submission dengan semua links
            $submission->all_links = $allLinks;
            $submission->total_links_count = count($allLinks);

            return $submission;
        });

        return view('dashboard.completed', compact('completed'));
    }

    // ⬅️ ✅ METHOD YANG SUDAH DIMODIFIKASI
    public function updateStatus(Request $request, SubmitProject $submitProject)
    {
        try {
            $request->validate([
                'status' => 'required|in:pending,revisi,selesai',
                'notes'  => 'nullable|string|min:3|max:2000',
            ]);

            // Authorization check
            $user = auth()->user();
            if ($submitProject->project && $submitProject->project->user_id !== $user->id) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized access'
                ], 403);
            }

            DB::beginTransaction();

            $oldStatus = $submitProject->status;
            $updateData = ['status' => $request->input('status')];

            // Handle notes
            if ($request->filled('notes')) {
                $updateData['notes'] = $request->input('notes');
            } elseif ($request->input('status') === 'revisi' && !$request->filled('notes')) {
                DB::rollBack();
                return response()->json([
                    'success' => false,
                    'message' => 'Notes wajib diisi jika mengirim revisi.'
                ], 422);
            }

            $submitProject->update($updateData);

            // ⬅️ ✅ LOGIC BARU: Release dana ke freelancer saat status = selesai
            if ($request->input('status') === 'selesai' && $oldStatus !== 'selesai') {
                $this->releasePaymentToFreelancer($submitProject);
                
                Log::info('Project completed and payment released:', [
                    'submission_id' => $submitProject->id,
                    'project_id' => $submitProject->project_id,
                    'user_id' => $submitProject->user_id
                ]);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Status berhasil diperbarui!',
                'data' => $submitProject->fresh()
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('UpdateStatus Error:', [
                'submission_id' => $submitProject->id ?? null,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengupdate status'
            ], 500);
        }
    }

    // ⬅️ ✅ METHOD BARU: Release payment dari escrow ke freelancer wallet
    private function releasePaymentToFreelancer(SubmitProject $submitProject)
    {
        try {
            // Cari payment yang terkait dengan project ini
            $payment = Payment::where('project_id', $submitProject->project_id)
                ->where('freelancer_id', $submitProject->user_id)
                ->where('status', 'success')
                ->where('is_released_to_freelancer', false)
                ->first();

            if (!$payment) {
                Log::warning('No payment found to release', [
                    'project_id' => $submitProject->project_id,
                    'freelancer_id' => $submitProject->user_id
                ]);
                return;
            }

            // Get atau create wallet freelancer
            $wallet = Wallet::firstOrCreate(
                ['user_id' => $payment->freelancer_id],
                ['balance' => 0, 'pending_balance' => 0]
            );

            // Credit balance freelancer (Admin wallet TIDAK dikurangi)
            $wallet->credit(
                $payment->service_amount,
                "Pembayaran released dari Project #{$submitProject->project_id} - {$submitProject->project->title}",
                $payment->id
            );

            // Update payment status
            $payment->update([
                'is_released_to_freelancer' => true,
                'released_at' => now(),
                'release_notes' => 'Funds released after project completion approval by client'
            ]);

            Log::info('Payment released to freelancer', [
                'payment_id' => $payment->payment_id,
                'project_id' => $submitProject->project_id,
                'freelancer_id' => $payment->freelancer_id,
                'amount' => $payment->service_amount,
                'freelancer_balance' => $wallet->balance,
                'admin_wallet_status' => 'Not deducted (will be deducted on withdrawal)'
            ]);

        } catch (\Exception $e) {
            Log::error('Failed to release payment to freelancer:', [
                'error' => $e->getMessage(),
                'submission_id' => $submitProject->id,
                'project_id' => $submitProject->project_id,
                'trace' => $e->getTraceAsString()
            ]);
            throw $e;
        }
    }

    public function getProjectStatus($projectId)
    {
        $project = Project::find($projectId);

        if (!$project) {
            return response()->json([
                'success' => false,
                'message' => 'Project tidak ditemukan'
            ], 404);
        }

        // ambil submission (kalau memang masih dipakai)
        $submission = SubmitProject::where('project_id', $projectId)
            ->where('user_id', auth()->id())
            ->first();

        $displayStatus = $submission ? match ($submission->status) {
            'pending' => 'Menunggu Persetujuan',
            'revisi'  => 'Revisi',
            'selesai' => 'Selesai',
            default   => 'Dalam Proses'
        } : 'Dalam Proses';

        // ambil freelancer
        $freelancerName = optional(
            $project->proposalls()
                ->where('status', 'accepted')
                ->with('user')
                ->first()
        )->user->name ?? '-';

        // ambil progress link
        $progress = \App\Models\Progress::where('project_id', $projectId)->get();

        // hitung total milestone selesai
        $totalFiles = \App\Models\Timeline::where('project_id', $projectId)
                        ->where('status', 'selesai')
                        ->count();

        return response()->json([
            'project' => [
                'id'    => $project->id,
                'title' => $project->title,
            ],
            'status'  => $submission->status ?? 'dalam_proses',
            'display' => $displayStatus,
            'notes'   => $submission->notes ?? null,

            // tambahkan field yang frontend butuh:
            'freelancer_name' => $freelancerName,
            'total_links'     => $totalFiles,
            'links'           => $progress->map(fn($p) => [
                'url' => $p->link_url,
            ]),
        ]);
    }

    public function getRevisionNotes($projectId)
    {
        try {
            $submitProject = SubmitProject::where('project_id', $projectId)
                ->where('user_id', auth()->id())
                ->where('status', 'revisi')
                ->first();

            if (!$submitProject) {
                return response()->json([
                    'success' => false,
                    'notes' => 'Data revisi tidak ditemukan.'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'notes' => $submitProject->notes ?? 'Tidak ada catatan khusus dari client.'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'notes' => 'Gagal memuat catatan revisi.'
            ], 500);
        }
    }
}