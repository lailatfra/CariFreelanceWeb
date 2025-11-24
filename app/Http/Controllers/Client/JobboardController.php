<?php

namespace App\Http\Controllers\Client;

use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Proposal;
use App\Models\ProjectCancellation;
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
            ->with(['proposalls' => function($query) {
                $query->where('status', 'accepted')->with('user');
            }])
            ->orderBy('created_at', 'asc')
            ->get();

        // PERBAIKAN: Working projects dengan filter yang benar
        $projects = Project::with([
            'proposalls' => function($query) {
                $query->where('status', 'accepted')->with('user');
            },
            'timelines',
            'submitProjects' => function($query) {
                $query->latest(); // ambil submit terbaru
            }
        ])
        ->where('user_id', $userId)
        ->whereHas('proposalls', function($query) {
            $query->where('status', 'accepted');
        })
        // PERBAIKAN: Filter hanya project yang belum selesai
        ->whereDoesntHave('submitProjects', function($query) {
            $query->where('status', 'selesai');
        })
        ->orderByDesc('created_at')
        ->get();

        // Ambil semua proposals dari client ini
        $proposals = Proposal::with(['project.client'])
            ->whereHas('project', function($q) use ($userId) {
                $q->where('user_id', $userId);
            })
            ->get();

        $cancelledProjects = \App\Models\ProjectCancellation::with(['project', 'project.proposalls.user'])
            ->where('refund_status', '!=', 'completed') 
            ->orderByDesc('cancelled_at')
            ->get();

        // PERBAIKAN: Completed projects dengan query yang lebih baik
        $completed = SubmitProject::with([
                'project', 
                'user', 
                'project.proposalls' => function($query) {
                    $query->where('status', 'accepted')->with('user');
                }
            ])
            ->whereHas('project', function ($q) use ($userId) {
                $q->where('user_id', $userId);
            })
            ->where('status', 'selesai')
            ->orderByDesc('updated_at')
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

        return view('client.projek', compact('openProjects', 'projects', 'completed', 'proposals', 'cancelledProjects'));
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

            // PERBAIKAN: Ambil juga data submission terbaru
            $latestSubmission = SubmitProject::where('project_id', $projectId)
                ->latest()
                ->first();

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
                'latest_submission' => $latestSubmission ? [
                    'id' => $latestSubmission->id,
                    'status' => $latestSubmission->status,
                    'description' => $latestSubmission->description,
                    'notes' => $latestSubmission->notes,
                    'links' => $latestSubmission->links,
                    'created_at' => $latestSubmission->created_at
                ] : null
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
                'notes' => 'nullable|string|min:10|max:1000',
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
                $updateData['notes'] = $request->notes;
                Log::info('Saving revision notes', ['notes_length' => strlen($request->notes)]);
            }

            // PERBAIKAN BESAR: Jika status selesai, proses transfer uang
            if ($request->status === 'selesai') {
                DB::beginTransaction();
                
                try {
                    // Ambil data project dan proposal yang diterima
                    $project = $submitProject->project;
                    $acceptedProposal = $project->proposalls()
                        ->where('status', 'accepted')
                        ->first();

                    if (!$acceptedProposal) {
                        throw new \Exception('Tidak ada proposal yang diterima untuk project ini');
                    }

                    $proposalPrice = $acceptedProposal->proposal_price;
                    $freelancerId = $acceptedProposal->user_id;

                    // Hitung fee admin (10%)
                    $adminFee = $proposalPrice * 0.10;
                    $freelancerAmount = $proposalPrice - $adminFee;

                    Log::info('Processing payment', [
                        'project_id' => $project->id,
                        'proposal_price' => $proposalPrice,
                        'admin_fee' => $adminFee,
                        'freelancer_amount' => $freelancerAmount,
                        'freelancer_id' => $freelancerId
                    ]);

                    // Update status submit project
                    $submitProject->update($updateData);

                    // Transfer ke wallet freelancer
                    $freelancerWallet = Wallet::firstOrCreate(
                        ['user_id' => $freelancerId],
                        ['balance' => 0]
                    );
                    
                    $freelancerWallet->balance += $freelancerAmount;
                    $freelancerWallet->save();

                    // Tambah ke admin wallet
                    $adminWallet = AdminWallet::firstOrCreate(
                        ['id' => 1],
                        ['balance' => 0]
                    );
                    
                    $adminWallet->balance += $adminFee;
                    $adminWallet->save();

                    // Log transaksi
                    Log::info('Payment processed successfully', [
                        'freelancer_wallet_balance' => $freelancerWallet->balance,
                        'admin_wallet_balance' => $adminWallet->balance
                    ]);

                    DB::commit();

                    $message = "Project berhasil disetujui! Pembayaran sebesar Rp " . number_format($freelancerAmount, 0, ',', '.') . " telah ditransfer ke freelancer (Fee admin: Rp " . number_format($adminFee, 0, ',', '.') . ")";

                } catch (\Exception $e) {
                    DB::rollBack();
                    Log::error('Error processing payment', [
                        'error' => $e->getMessage(),
                        'project_id' => $project->id ?? 'unknown'
                    ]);
                    throw $e;
                }
            } else {
                // Untuk status revisi atau lainnya, hanya update status
                $submitProject->update($updateData);
                
                $message = match($request->status) {
                    'revisi' => 'Catatan revisi berhasil dikirim ke freelancer! Status berubah menjadi "Revisi".',
                    default => 'Status berhasil diperbarui!'
                };
            }

            Log::info('Status updated successfully', [
                'submission_id' => $submitProject->id,
                'old_status' => $oldStatus,
                'new_status' => $request->status,
                'client_id' => Auth::id(),
                'notes_saved' => isset($updateData['notes']) ? 'yes' : 'no'
            ]);

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

    public function cancels(Request $request)
    {
        // Query untuk statistik
        $stats = [
            'total_pending' => ProjectCancellation::where('refund_status', 'pending')->count(),
            'total_approved_month' => ProjectCancellation::where('refund_status', 'approved')
                ->whereMonth('cancelled_at', now()->month)
                ->whereYear('cancelled_at', now()->year)
                ->count(),
            'total_rejected' => ProjectCancellation::where('refund_status', 'rejected')->count(),
            'total_refund_pending' => ProjectCancellation::where('refund_status', 'pending')
                ->sum('refund_amount')
        ];

        // Query untuk data pembatalan
        $query = ProjectCancellation::with([
            'project.user',
            'user',
            'project.proposalls' => function($q) {
                $q->where('status', 'accepted')->with('user');
            }
        ]);

        // Filter status
        if ($request->has('status') && $request->status != '') {
            $query->where('refund_status', $request->status);
        }

        // Filter tanggal
        if ($request->has('date_from') && $request->date_from != '') {
            $query->whereDate('cancelled_at', '>=', $request->date_from);
        }

        if ($request->has('date_to') && $request->date_to != '') {
            $query->whereDate('cancelled_at', '<=', $request->date_to);
        }

        // Filter pencarian
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->whereHas('user', function($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                })->orWhereHas('project', function($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%");
                });
            });
        }

        $cancellations = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.cancels.cancels', compact('stats', 'cancellations'));
    }

    public function show($id)
    {
        $cancellation = ProjectCancellation::with([
            'project.user',
            'user',
            'project.proposalls' => function($q) {
                $q->where('status', 'accepted')->with('user');
            },
            'project.timelines'
        ])->findOrFail($id);

        return response()->json($cancellation);
    }

public function getCancellationDetail($cancellationId)
{
    try {
        $cancellation = ProjectCancellation::with(['project', 'project.proposalls.user'])
            ->findOrFail($cancellationId);

        \Log::info('Cancellation Raw Data', [
            'evidence_files' => $cancellation->evidence_files,
            'transfer_proof' => $cancellation->transfer_proof,
        ]);

        // Handle evidence_files
        $evidenceFiles = [];
        $rawEvidenceFiles = $cancellation->evidence_files;
        
        if (is_array($rawEvidenceFiles)) {
            $evidenceFiles = array_filter($rawEvidenceFiles);
        } elseif (is_string($rawEvidenceFiles)) {
            $decoded = json_decode($rawEvidenceFiles, true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                $evidenceFiles = array_filter($decoded);
            } elseif (!empty($rawEvidenceFiles)) {
                $evidenceFiles = [$rawEvidenceFiles];
            }
        }

        // Handle transfer_proof
        $transferProof = null;
        $rawTransferProof = $cancellation->transfer_proof;
        
        if (is_array($rawTransferProof) && !empty($rawTransferProof)) {
            $transferProof = $rawTransferProof[0];
        } elseif (is_string($rawTransferProof) && !empty($rawTransferProof)) {
            $decoded = json_decode($rawTransferProof, true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded) && !empty($decoded)) {
                $transferProof = $decoded[0];
            } else {
                $transferProof = $rawTransferProof;
            }
        }

        // PERBAIKAN: Generate URL yang benar untuk file
        $evidenceFilesUrls = array_map(function($file) {
            if (empty($file)) return null;
            
            // Jika sudah full URL, gunakan langsung
            if (str_starts_with($file, 'http')) {
                return $file;
            }
            
            // Jika hanya filename, generate storage URL
            if (str_contains($file, 'storage/')) {
                return asset($file);
            }
            
            // Default: assume file ada di storage
            return Storage::url($file);
        }, $evidenceFiles);

        $evidenceFilesUrls = array_filter($evidenceFilesUrls);

        // Handle transfer proof URL
        $transferProofUrl = null;
        if ($transferProof) {
            if (str_starts_with($transferProof, 'http')) {
                $transferProofUrl = $transferProof;
            } elseif (str_contains($transferProof, 'storage/')) {
                $transferProofUrl = asset($transferProof);
            } else {
                $transferProofUrl = Storage::url($transferProof);
            }
        }

        \Log::info('Processed URLs', [
            'evidence_files' => $evidenceFilesUrls,
            'transfer_proof' => $transferProofUrl,
        ]);

        return response()->json([
            'success' => true,
            'reason' => $cancellation->reason,
            'evidence_files' => $evidenceFilesUrls,
            'transfer_proof' => $transferProofUrl,
        ]);

    } catch (\Exception $e) {
        \Log::error('Error in getCancellationDetail: ' . $e->getMessage());
        
        return response()->json([
            'success' => false,
            'message' => 'Gagal memuat data pembatalan',
            'error' => $e->getMessage()
        ], 500);
    }
}


}