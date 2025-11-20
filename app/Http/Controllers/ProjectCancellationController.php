<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectCancellation;
use App\Models\Proposal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProjectCancellationController extends Controller
{
    
    /**
     * Constructor - Apply auth middleware to all methods
     */
    public function __construct()
    {
        // Semua method butuh auth
        // $this->middleware('auth');
    }

    
    /**
     * Display cancellation management page for admin
     */
    public function manageCancellations(Request $request)
    {
        $query = ProjectCancellation::with(['project', 'user'])
            ->orderBy('created_at', 'desc');

        // Filter by status
        if ($request->has('status') && $request->status != '') {
            $query->where('refund_status', $request->status);
        }

        // Filter by date range
        if ($request->has('date_from') && $request->date_from != '') {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->has('date_to') && $request->date_to != '') {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        // Filter by search
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->whereHas('user', function($userQuery) use ($search) {
                    $userQuery->where('name', 'like', "%{$search}%")
                             ->orWhere('email', 'like', "%{$search}%");
                })->orWhereHas('project', function($projectQuery) use ($search) {
                    $projectQuery->where('title', 'like', "%{$search}%");
                });
            });
        }

        $cancellations = $query->paginate(10);

        // Stats for dashboard
        $stats = [
            'total_pending' => ProjectCancellation::where('refund_status', 'pending')->count(),
            'total_approved_month' => ProjectCancellation::where('refund_status', 'approved')
                ->whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year)
                ->count(),
            'total_rejected' => ProjectCancellation::where('refund_status', 'rejected')->count(),
            'total_refund_pending' => ProjectCancellation::where('refund_status', 'pending')->sum('refund_amount'),
        ];

        return view('admin.cancels.index', compact('cancellations', 'stats'));
    }

    /**
     * Get cancellation details
     */
    public function getCancellationDetails($id)
    {
        try {
            $cancellation = ProjectCancellation::with([
                'project', 
                'user',
                'project.proposalls' => function($q) {
                    $q->where('status', 'accepted')->with('user');
                }
            ])->findOrFail($id);

            return response()->json([
                'success' => true,
                'data' => $cancellation
            ], 200, [], JSON_UNESCAPED_UNICODE);

        } catch (\Exception $e) {
            Log::error('GET CANCELLATION DETAILS ERROR: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ], 404, [], JSON_UNESCAPED_UNICODE);
        }
    }

/**
 * Approve cancellation request - NO WALLET DEDUCTION
 */
public function approveCancellation(Request $request, $id)
{
    \Log::info('=== APPROVE CANCELLATION START (NO WALLET) ===', ['id' => $id]);
    
    try {
        // VALIDASI FILE
        $validated = $request->validate([
            'transfer_proof' => 'required|image|mimes:jpeg,jpg,png,pdf|max:5120'
        ]);

        DB::beginTransaction();

        $cancellation = ProjectCancellation::with(['project.proposalls'])->find($id);
        
        if (!$cancellation) {
            return response()->json([
                'success' => false,
                'message' => 'Data pembatalan tidak ditemukan'
            ], 404);
        }

        // AMBIL ACCEPTED PROPOSAL
        $acceptedProposal = $cancellation->project->proposalls()
            ->where('status', 'accepted')
            ->first();

        if (!$acceptedProposal) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Tidak ada proposal yang diterima untuk project ini'
            ], 400);
        }

        // HITUNG REFUND (TANPA DEBET WALLET)
        $proposalPrice = $acceptedProposal->proposal_price;
        $adminFee = $proposalPrice * 0.02;
        $refundAmount = $proposalPrice - $adminFee;

        // UPLOAD BUKTI TRANSFER
        $transferProofPath = null;
        if ($request->hasFile('transfer_proof')) {
            $file = $request->file('transfer_proof');
            $filename = 'transfer_proof_' . $id . '_' . time() . '.' . $file->getClientOriginalExtension();
            $transferProofPath = $file->storeAs('transfer_proofs', $filename, 'public');
        }

        // UPDATE CANCELLATION STATUS
        $cancellation->update([
            'refund_status' => 'processed',
            'refund_amount' => $refundAmount,
            'transfer_proof' => $transferProofPath,
            'processed_at' => now(),
            'updated_at' => now()
        ]);

        // CEK REPOST
        $shouldRepost = (bool) $cancellation->repost_project;

        if ($shouldRepost) {
            // RESET PROPOSALS KE PENDING
            \App\Models\Proposal::where('project_id', $cancellation->project_id)
                ->update(['status' => 'pending']);

            // UPDATE PROJECT JADI OPEN KEMBALI
            $cancellation->project->update([
                'cancellation_status' => null,
                'status' => 'open',
                'rejection_reason' => null,
                'updated_at' => now()
            ]);

            $successMessage = 
                'Pembatalan proyek disetujui! Proyek otomatis di-posting ulang, semua freelancer bisa mengirim proposal kembali.';
        } else {
            // PROJECT DIPERMANEN BATAL
            $cancellation->project->update([
                'cancellation_status' => 'approved',
                'status' => 'cancelled',
                'updated_at' => now()
            ]);

            $successMessage = 
                'Pembatalan proyek disetujui tanpa posting ulang.';
        }

        DB::commit();

        return response()->json([
            'success' => true,
            'message' => $successMessage,
            'data' => [
                'refund_amount' => $refundAmount,
                'admin_fee_deducted' => $adminFee,
                'project_reposted' => $shouldRepost
            ]
        ], 200);

    } catch (\Illuminate\Validation\ValidationException $e) {
        DB::rollBack();
        return response()->json([
            'success' => false,
            'message' => 'Validasi gagal',
            'errors' => $e->errors()
        ], 422);

    } catch (\Exception $e) {
        DB::rollBack();
        \Log::error('ERROR APPROVE CANCELLATION', [
            'error' => $e->getMessage(),
            'line' => $e->getLine(),
            'file' => $e->getFile()
        ]);

        return response()->json([
            'success' => false,
            'message' => 'Terjadi kesalahan: ' . $e->getMessage()
        ], 500);
    }
}


/**
 * Approve cancellation request - WITH TRANSFER PROOF & AUTO DEDUCT WALLET
 */
// public function approveCancellation(Request $request, $id)
// {
//     \Log::info('=== APPROVE CANCELLATION START ===', ['id' => $id]);
    
//     try {
//         // ✅ VALIDASI FILE BUKTI TRANSFER
//         $validated = $request->validate([
//             'transfer_proof' => 'required|image|mimes:jpeg,jpg,png,pdf|max:5120'
//         ]);

//         DB::beginTransaction();

//         $cancellation = ProjectCancellation::with(['project.proposalls'])->find($id);
        
//         if (!$cancellation) {
//             return response()->json([
//                 'success' => false,
//                 'message' => 'Data pembatalan tidak ditemukan'
//             ], 404);
//         }
        
//         \Log::info('Cancellation found', [
//             'id' => $cancellation->id,
//             'current_refund_status' => $cancellation->refund_status,
//             'repost_project' => $cancellation->repost_project
//         ]);

//         // ✅ GET ACCEPTED PROPOSAL & GET EXACT PROPOSAL PRICE
//         $acceptedProposal = $cancellation->project->proposalls()
//             ->where('status', 'accepted')
//             ->first();

//         if (!$acceptedProposal) {
//             DB::rollBack();
//             \Log::error('No accepted proposal found', ['project_id' => $cancellation->project_id]);
            
//             return response()->json([
//                 'success' => false,
//                 'message' => 'Tidak ada proposal yang diterima untuk project ini'
//             ], 400);
//         }

//         // ✅ AMBIL PROPOSAL PRICE TANPA PENGURANGAN (EXACT AMOUNT)
//         $refundAmount = $acceptedProposal->proposal_price;

//         \Log::info('Refund amount (exact proposal price)', [
//             'proposal_price' => $refundAmount,
//             'project_id' => $cancellation->project_id
//         ]);

//         // ✅ UPLOAD FILE BUKTI TRANSFER
//         $transferProofPath = null;
//         if ($request->hasFile('transfer_proof')) {
//             $file = $request->file('transfer_proof');
//             $filename = 'transfer_proof_' . $id . '_' . time() . '.' . $file->getClientOriginalExtension();
//             $transferProofPath = $file->storeAs('transfer_proofs', $filename, 'public');
//             \Log::info('Transfer proof uploaded', ['path' => $transferProofPath]);
//         }

//         // ✅ GET ADMIN WALLET
//         $adminWallet = \App\Models\AdminWallet::getWallet();

//         // ✅ CEK APAKAH SALDO MENCUKUPI
//         if ($adminWallet->service_balance < $refundAmount) {
//             DB::rollBack();
//             \Log::error('Insufficient admin wallet balance', [
//                 'required' => $refundAmount,
//                 'available' => $adminWallet->service_balance
//             ]);
            
//             return response()->json([
//                 'success' => false,
//                 'message' => 'Saldo service admin tidak mencukupi untuk refund. Saldo: Rp ' . number_format($adminWallet->service_balance, 0, ',', '.') . ', Dibutuhkan: Rp ' . number_format($refundAmount, 0, ',', '.')
//             ], 400);
//         }

//         // ✅ KURANGI SALDO ADMIN WALLET (EXACT PROPOSAL PRICE)
//         $adminWallet->debitService(
//             $refundAmount,
//             "Refund pembatalan project: {$cancellation->project->title} - Client: {$cancellation->user->name}",
//             null
//         );

//         \Log::info('Admin wallet debited', [
//             'amount' => $refundAmount,
//             'new_service_balance' => $adminWallet->fresh()->service_balance
//         ]);

//         // ✅ UPDATE CANCELLATION
//         $cancellation->update([
//             'refund_status' => 'processed',
//             'refund_amount' => $refundAmount,
//             'transfer_proof' => $transferProofPath,
//             'processed_at' => now(),
//             'updated_at' => now()
//         ]);
        
//         \Log::info('Cancellation approved with transfer proof and wallet deducted', [
//             'transfer_proof' => $transferProofPath,
//             'refund_amount' => $refundAmount
//         ]);

//         // ✅ CEK APAKAH USER INGIN POSTING ULANG PROJECT
//         $shouldRepost = (bool) $cancellation->repost_project;
        
//         \Log::info('Checking repost status', [
//             'repost_project' => $cancellation->repost_project,
//             'shouldRepost' => $shouldRepost
//         ]);

//         if ($shouldRepost) {
//             // ✅ RESET SEMUA PROPOSALS MENJADI PENDING (KOSONGKAN FREELANCER)
//             \App\Models\Proposal::where('project_id', $cancellation->project_id)
//                 ->update(['status' => 'pending']);
            
//             \Log::info('All proposals reset to pending', [
//                 'project_id' => $cancellation->project_id
//             ]);

//             // ✅ UPDATE PROJECT STATUS - POSTING ULANG
//             $cancellation->project->update([
//                 'cancellation_status' => null,
//                 'status' => 'open',
//                 'rejection_reason' => null,
//                 'updated_at' => now()
//             ]);
            
//             \Log::info('Project reposted successfully', [
//                 'project_id' => $cancellation->project_id,
//                 'new_status' => 'open'
//             ]);

//             $successMessage = 'Pembatalan proyek berhasil disetujui dengan bukti transfer! Proyek telah otomatis di-posting ulang dan semua freelancer dapat mengajukan proposal kembali. Saldo admin telah dikurangi sebesar Rp ' . number_format($refundAmount, 0, ',', '.');
//         } else {
//             // ✅ JIKA TIDAK POSTING ULANG - TANDAI SEBAGAI CANCELLED
//             $cancellation->project->update([
//                 'cancellation_status' => 'approved',
//                 'status' => 'cancelled',
//                 'updated_at' => now()
//             ]);
            
//             \Log::info('Project cancelled permanently (not reposted)');

//             $successMessage = 'Pembatalan proyek berhasil disetujui dengan bukti transfer! Saldo admin telah dikurangi sebesar Rp ' . number_format($refundAmount, 0, ',', '.');
//         }

//         DB::commit();
//         \Log::info('=== APPROVE CANCELLATION SUCCESS ===');
        
//         return response()->json([
//             'success' => true,
//             'message' => $successMessage,
//             'data' => [
//                 'refund_amount' => $refundAmount,
//                 'wallet_balance_after' => $adminWallet->fresh()->service_balance,
//                 'project_reposted' => $shouldRepost
//             ]
//         ], 200);

//     } catch (\Illuminate\Validation\ValidationException $e) {
//         DB::rollBack();
//         \Log::error('Validation error', ['errors' => $e->errors()]);
        
//         return response()->json([
//             'success' => false,
//             'message' => 'Validasi gagal',
//             'errors' => $e->errors()
//         ], 422);

//     } catch (\Exception $e) {
//         DB::rollBack();
//         \Log::error('=== APPROVE CANCELLATION FAILED ===', [
//             'error' => $e->getMessage(),
//             'line' => $e->getLine(),
//             'file' => $e->getFile(),
//             'trace' => $e->getTraceAsString()
//         ]);
        
//         return response()->json([
//             'success' => false,
//             'message' => 'Terjadi kesalahan: ' . $e->getMessage()
//         ], 500);
//     }
// }

/**
 * Reject cancellation request - WITH REJECTION REASON
 */
public function rejectCancellation(Request $request, $id)
{
    try {
        // ✅ VALIDASI ALASAN PENOLAKAN
        $validated = $request->validate([
            'reason' => 'required|string|min:10|max:500'
        ]);

        DB::beginTransaction();

        $cancellation = ProjectCancellation::findOrFail($id);
        
        // ✅ UPDATE DENGAN ALASAN PENOLAKAN & TANGGAL REJECT
        $cancellation->update([
            'refund_status' => 'completed', // atau buat status 'rejected' baru
            'rejection_reason' => $validated['reason'],
            'rejected_at' => now(),
            'updated_at' => now()
        ]);

        // ✅ UPDATE PROJECT STATUS
        $project = $cancellation->project;
        $previousStatus = $cancellation->project_status === 'working' ? 'in_progress' : 'open';
        
        $project->update([
            'cancellation_status' => 'rejected',
            'status' => $previousStatus,
            'rejection_reason' => $validated['reason']
        ]);

        DB::commit();

        return response()->json([
            'success' => true,
            'message' => 'Pembatalan proyek berhasil ditolak dengan alasan yang telah dicatat.'
        ], 200);

    } catch (\Exception $e) {
        DB::rollBack();
        Log::error('REJECT CANCELLATION ERROR: ' . $e->getMessage());

        return response()->json([
            'success' => false,
            'message' => 'Terjadi kesalahan: ' . $e->getMessage()
        ], 500);
    }
}

    public function cancelOpenProject(Request $request, $projectId)
{
    Log::info('🔴 CANCEL REQUEST RECEIVED', [
        'project_id' => $projectId,
        'method' => $request->method(),
        'has_files' => $request->hasFile('evidence_files'),
        'user_id' => Auth::id(),
        'repost_project' => $request->input('repost_project'), // ✅ LOG CHECKBOX
        'all_data' => $request->except('_token')
    ]);

    try {
        // Validasi input
        $validated = $request->validate([
            'reason' => 'required|string|min:10|max:500',
            'bank_name' => 'required|string',
            'account_number' => 'required|string|regex:/^[0-9]+$/',
            'repost_project' => 'nullable|boolean', // ✅ VALIDASI CHECKBOX
            'evidence_files' => 'nullable|array',
            'evidence_files.*' => 'nullable|file|mimes:jpg,jpeg,png,gif,pdf,doc,docx,txt|max:5120'
        ]);

        Log::info('✅ Validation passed', $validated);

        DB::beginTransaction();

        // Cari project
        $project = Project::findOrFail($projectId);
        
        // Cek ownership
        if ($project->user_id !== Auth::id()) {
            DB::rollBack();
            Log::warning('❌ Unauthorized access attempt');
            
            return response()->json([
                'success' => false,
                'message' => 'Anda tidak memiliki akses untuk membatalkan project ini'
            ], 403, [], JSON_UNESCAPED_UNICODE);
        }

        // Cek apakah sudah ada freelancer
        $hasFreelancer = Proposal::where('project_id', $projectId)
            ->where('status', 'accepted')
            ->exists();

        // Handle file uploads
        $evidenceFiles = [];
        if ($request->hasFile('evidence_files')) {
            foreach ($request->file('evidence_files') as $index => $file) {
                try {
                    $filename = time() . '_' . $index . '_' . $file->getClientOriginalName();
                    $path = $file->storeAs('cancellation_evidence', $filename, 'public');
                    
                    $evidenceFiles[] = [
                        'original_name' => $file->getClientOriginalName(),
                        'path' => $path,
                        'url' => Storage::url($path),
                        'size' => $file->getSize(),
                        'mime_type' => $file->getMimeType()
                    ];

                    Log::info('📎 File uploaded', ['path' => $path]);
                } catch (\Exception $e) {
                    Log::error('❌ File upload error', ['error' => $e->getMessage()]);
                    throw $e;
                }
            }
        }

        // Calculate refund amount
        $refundAmount = $project->fixed_budget ?? $project->min_budget ?? 0;

        // ✅ AMBIL NILAI CHECKBOX (bisa berupa string "1" atau "0")
        $repostProject = filter_var($request->input('repost_project', false), FILTER_VALIDATE_BOOLEAN);

        // Prepare data untuk insert
        $cancellationData = [
            'project_id' => (int) $project->id,
            'user_id' => (int) Auth::id(),
            'project_status' => 'open',
            'reason' => $validated['reason'],
            'evidence_files' => !empty($evidenceFiles) ? json_encode($evidenceFiles) : null,
            'bank_name' => $validated['bank_name'],
            'account_number' => $validated['account_number'],
            'refund_amount' => (float) $refundAmount,
            'refund_status' => 'pending',
            'repost_project' => $repostProject, // ✅ SIMPAN STATUS CHECKBOX
            'cancelled_at' => now(),
            'created_at' => now(),
            'updated_at' => now()
        ];

        Log::info('📝 Preparing to create cancellation', $cancellationData);

        // Create cancellation record
        $cancellation = ProjectCancellation::create($cancellationData);

        if (!$cancellation) {
            throw new \Exception('Failed to create cancellation record');
        }

        Log::info('✅ Cancellation record created', [
            'id' => $cancellation->id,
            'project_id' => $cancellation->project_id,
            'repost_project' => $cancellation->repost_project,
            'data_stored' => $cancellation->toArray()
        ]);

        // Update project status to pending cancellation
        $project->update([
            'cancellation_status' => 'pending',
            'status' => 'pending_cancellation'
        ]);

        DB::commit();

        // Verifikasi data tersimpan
        $savedCancellation = ProjectCancellation::find($cancellation->id);
        Log::info('✅ Data verified in database', [
            'exists' => !is_null($savedCancellation),
            'repost_project' => $savedCancellation->repost_project,
            'data' => $savedCancellation ? $savedCancellation->toArray() : null
        ]);

        // ✅ PESAN BERBEDA JIKA USER CHECKLIST POSTING ULANG
        $message = 'Pengajuan pembatalan project berhasil dikirim. Tim kami akan meninjau permintaan Anda dalam 1-2 hari kerja.';
        if ($repostProject) {
            $message .= ' Proyek akan otomatis di-posting ulang setelah pembatalan disetujui.';
        }

        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => [
                'cancellation_id' => $cancellation->id,
                'refund_amount' => number_format($refundAmount, 0, ',', '.'),
                'files_count' => count($evidenceFiles),
                'bank_name' => strtoupper($validated['bank_name']),
                'account_masked' => substr($validated['account_number'], 0, 4) . '****',
                'repost_project' => $repostProject // ✅ KIRIM INFO KE FRONTEND
            ]
        ], 200, [], JSON_UNESCAPED_UNICODE);

    } catch (\Illuminate\Validation\ValidationException $e) {
        DB::rollBack();
        
        Log::error('❌ Validation failed', ['errors' => $e->errors()]);
        
        return response()->json([
            'success' => false,
            'message' => 'Validasi gagal',
            'errors' => $e->errors()
        ], 422, [], JSON_UNESCAPED_UNICODE);

    } catch (\Exception $e) {
        DB::rollBack();
        
        Log::error('❌ CANCEL ERROR', [
            'error' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'trace' => $e->getTraceAsString()
        ]);

        return response()->json([
            'success' => false,
            'message' => 'Terjadi kesalahan: ' . $e->getMessage()
        ], 500, [], JSON_UNESCAPED_UNICODE);
    }
}

    /**
     * Delete Project Permanently
     */
    public function deleteProjectPermanently(Request $request, $projectId)
    {
        Log::info('🗑️ DELETE PROJECT REQUEST', ['project_id' => $projectId, 'user_id' => Auth::id()]);

        try {
            DB::beginTransaction();

            $project = Project::findOrFail($projectId);
            
            // Cek ownership
            if ($project->user_id !== Auth::id()) {
                DB::rollBack();
                
                return response()->json([
                    'success' => false,
                    'message' => 'Anda tidak memiliki akses untuk menghapus project ini'
                ], 403, [], JSON_UNESCAPED_UNICODE);
            }

            // Cek apakah sudah ada freelancer
            $hasFreelancer = Proposal::where('project_id', $projectId)
                ->where('status', 'accepted')
                ->exists();

            if ($hasFreelancer) {
                DB::rollBack();
                
                return response()->json([
                    'success' => false,
                    'message' => 'Tidak dapat menghapus project yang sudah memiliki freelancer. Gunakan fitur cancel.'
                ], 400, [], JSON_UNESCAPED_UNICODE);
            }

            // Hapus semua data terkait
            $project->proposalls()->delete();
            $project->timelines()->delete();
            $project->submitProjects()->delete();
            
            // Hapus project
            $project->delete();

            DB::commit();

            Log::info('✅ Project deleted permanently', ['project_id' => $projectId]);

            return response()->json([
                'success' => true,
                'message' => 'Project berhasil dihapus permanen.'
            ], 200, [], JSON_UNESCAPED_UNICODE);

        } catch (\Exception $e) {
            DB::rollBack();
            
            Log::error('❌ DELETE PROJECT ERROR', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500, [], JSON_UNESCAPED_UNICODE);
        }
    }

    /**
     * Check cancellation data (for debugging)
     */
    public function checkCancellationData()
    {
        $cancellations = ProjectCancellation::all();
        
        Log::info('📊 CURRENT CANCELLATION DATA', [
            'total_records' => $cancellations->count(),
            'records' => $cancellations->toArray()
        ]);
        
        return response()->json([
            'total' => $cancellations->count(),
            'data' => $cancellations
        ], 200, [], JSON_UNESCAPED_UNICODE);
    }

    // Di ProjectController atau cancellation controller
public function cancelWorkingProject(Request $request, $projectId)
{
    \Log::info('🟡 CANCEL WORKING REQUEST STARTED', [
        'project_id' => $projectId,
        'user_id' => auth()->id(),
        'all_data' => $request->all()
    ]);

    try {
        $validated = $request->validate([
            'reason' => 'required|min:10|max:500',
            'bank_name' => 'required|string',
            'account_number' => 'required|string',
            'repost_project' => 'sometimes|boolean',
            'evidence_files' => 'sometimes|array',
            'evidence_files.*' => 'file|max:5120',
        ]);

        \Log::info('✅ Validation passed', $validated);

        // Cari project
        $project = Project::find($projectId);
        if (!$project) {
            \Log::error('❌ Project not found', ['project_id' => $projectId]);
            return response()->json([
                'success' => false,
                'message' => 'Project tidak ditemukan'
            ], 404);
        }

        \Log::info('🔍 Project found', ['project_title' => $project->title]);

        // Hitung refund amount (contoh: 50% dari budget)
        $refundAmount = $project->budget * 0.5;
        \Log::info('💰 Refund calculated', ['budget' => $project->budget, 'refund' => $refundAmount]);

        // Data untuk cancellation
        $cancellationData = [
            'project_id' => $projectId,
            'user_id' => auth()->id(),
            'reason' => $validated['reason'],
            'bank_name' => $validated['bank_name'],
            'account_number' => $validated['account_number'],
            'refund_amount' => $refundAmount,
            'refund_status' => 'pending',
            'repost_project' => $validated['repost_project'] ?? false, // ✅ SIMPAN CHECKBOX
            'cancelled_at' => now(),
        ];

        \Log::info('📝 Cancellation data prepared', $cancellationData);

        // Simpan cancellation (TANPA cancellation_status)
        $cancellation = ProjectCancellation::create($cancellationData);
        \Log::info('✅ Cancellation record created', ['cancellation_id' => $cancellation->id]);

        // Handle file upload jika ada
        if ($request->hasFile('evidence_files')) {
            $filePaths = [];
            foreach ($request->file('evidence_files') as $file) {
                $path = $file->store('cancellation-evidence');
                $filePaths[] = $path;
                \Log::info('📁 File stored', ['path' => $path]);
            }
            $cancellation->update(['evidence_files' => $filePaths]);
        }

        // ✅ UPDATE PROJECT STATUS - set cancellation_status di tabel projects
        $project->update([
            'cancellation_status' => 'pending', // ✅ Update di tabel projects
            'status' => 'cancelled' // atau status lain yang sesuai
        ]);
        
        \Log::info('✅ Project status updated', [
            'cancellation_status' => 'pending',
            'status' => 'cancelled'
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Pengajuan pembatalan berhasil dikirim!'
        ]);

    } catch (\Illuminate\Validation\ValidationException $e) {
        \Log::error('❌ Validation failed', ['errors' => $e->errors()]);
        return response()->json([
            'success' => false,
            'message' => 'Validasi gagal: ' . implode(', ', array_flatten($e->errors()))
        ], 422);
        
    } catch (\Exception $e) {
        \Log::error('💥 Server error in cancelWorkingProject', [
            'error' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'trace' => $e->getTraceAsString()
        ]);
        
        return response()->json([
            'success' => false,
            'message' => 'Terjadi kesalahan server: ' . $e->getMessage()
        ], 500);
    }
}

    /**
     * Show cancellation history
     */
    public function history()
    {
        $cancellations = ProjectCancellation::with(['project', 'user'])
            ->where('user_id', Auth::id())
            ->orderBy('cancelled_at', 'desc')
            ->paginate(10);

        return view('client.cancellation-history', compact('cancellations'));
    }

    /**
     * Approve (legacy method)
     */
    public function approve(Request $request)
    {
        $request->validate([
            'project_id' => 'required|exists:projects,id',
        ]);

        $project = Project::find($request->project_id);
        $project->cancellation_status = 'approved';
        // $project->approved_at = now();
        $project->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Cancellation approved'
        ], 200, [], JSON_UNESCAPED_UNICODE);
    }

    /**
     * Reject (legacy method)
     */
    public function reject(Request $request)
    {
        $request->validate([
            'project_id' => 'required|exists:projects,id',
            'reason' => 'required|string',
        ]);

        $project = Project::find($request->project_id);
        $project->cancellation_status = 'rejected';
        $project->rejection_reason = $request->reason;
        // $project->rejected_at = now();
        $project->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Cancellation rejected'
        ], 200, [], JSON_UNESCAPED_UNICODE);
    }
}