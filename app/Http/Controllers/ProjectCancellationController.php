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
        $this->middleware('auth');
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
 * Approve cancellation request - FIXED VERSION
 */
/**
 * Approve cancellation request - FIXED FOR CORRECT ENUM VALUES
 */
public function approveCancellation(Request $request, $id)
{
    \Log::info('=== APPROVE CANCELLATION START ===', ['id' => $id]);
    
    try {
        DB::beginTransaction();

        $cancellation = ProjectCancellation::find($id);
        
        if (!$cancellation) {
            return response()->json([
                'success' => false,
                'message' => 'Data pembatalan tidak ditemukan'
            ], 404);
        }
        
        \Log::info('Cancellation found', [
            'id' => $cancellation->id,
            'current_refund_status' => $cancellation->refund_status
        ]);

        // ✅ PERBAIKAN: Gunakan 'processed' untuk refund_status (bukan 'approved')
        $cancellation->update([
            'refund_status' => 'processed', // ✅ INI YANG BENAR untuk project_cancellations
            'updated_at' => now()
        ]);
        
        \Log::info('Cancellation updated successfully with refund_status: processed');

        // ✅ PERBAIKAN: Gunakan 'approved' untuk cancellation_status di projects
        if ($cancellation->project) {
            $cancellation->project->update([
                'cancellation_status' => 'approved', // ✅ INI YANG BENAR untuk projects
                'status' => 'cancelled', 
                // 'approved_at' => now(),
                'updated_at' => now()
            ]);
            \Log::info('Project updated successfully with cancellation_status: approved');
        }

        DB::commit();
        \Log::info('=== APPROVE CANCELLATION SUCCESS ===');
        
        return response()->json([
            'success' => true,
            'message' => 'Pembatalan proyek berhasil disetujui! Status refund: processed'
        ], 200);

    } catch (\Exception $e) {
        DB::rollBack();
        \Log::error('=== APPROVE CANCELLATION FAILED ===', [
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
 * Reject cancellation request
 */
/**
 * Reject cancellation request - FIXED FOR CORRECT ENUM VALUES  
 */
public function rejectCancellation(Request $request, $id)
{
    try {
        $validated = $request->validate([
            'reason' => 'required|string|min:10|max:500'
        ]);

        DB::beginTransaction();

        $cancellation = ProjectCancellation::findOrFail($id);
        
        // ✅ PERBAIKAN: Untuk reject, mungkin gunakan 'completed' atau biarkan 'pending'
        // Tergantung business logic Anda
        $cancellation->update([
            'refund_status' => 'completed', // atau 'pending' tergantung kebutuhan
            'rejection_reason' => $validated['reason'],
            'updated_at' => now()
        ]);

        // ✅ PERBAIKAN: Gunakan 'rejected' untuk cancellation_status di projects
        $project = $cancellation->project;
        $previousStatus = $cancellation->project_status === 'working' ? 'in_progress' : 'open';
        
        $project->update([
            'cancellation_status' => 'rejected', // ✅ INI YANG BENAR untuk projects
            'status' => $previousStatus,
            // 'rejected_at' => now(),
            'rejection_reason' => $validated['reason']
        ]);

        DB::commit();

        return response()->json([
            'success' => true,
            'message' => 'Pembatalan proyek berhasil ditolak.'
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

    /**
     * Cancel Open Project
     */
    public function cancelOpenProject(Request $request, $projectId)
    {
        Log::info('🔴 CANCEL REQUEST RECEIVED', [
            'project_id' => $projectId,
            'method' => $request->method(),
            'has_files' => $request->hasFile('evidence_files'),
            'user_id' => Auth::id(),
            'all_data' => $request->except('_token')
        ]);

        try {
            // Validasi input
            $validated = $request->validate([
                'reason' => 'required|string|min:10|max:500',
                'bank_name' => 'required|string',
                'account_number' => 'required|string|regex:/^[0-9]+$/',
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
                'data' => $savedCancellation ? $savedCancellation->toArray() : null
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Pengajuan pembatalan project berhasil dikirim. Tim kami akan meninjau permintaan Anda dalam 1-2 hari kerja.',
                'data' => [
                    'cancellation_id' => $cancellation->id,
                    'refund_amount' => number_format($refundAmount, 0, ',', '.'),
                    'files_count' => count($evidenceFiles),
                    'bank_name' => strtoupper($validated['bank_name']),
                    'account_masked' => substr($validated['account_number'], 0, 4) . '****'
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

    /**
     * Cancel Working Project
     */
    public function cancelWorkingProject(Request $request, $projectId)
    {
        Log::info('🟡 CANCEL WORKING REQUEST', ['project_id' => $projectId, 'user_id' => Auth::id()]);

        try {
            $validated = $request->validate([
                'reason' => 'required|string|min:10|max:500'
            ]);

            DB::beginTransaction();

            $project = Project::with('proposalls')->findOrFail($projectId);
            
            if ($project->user_id !== Auth::id()) {
                DB::rollBack();
                
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized'
                ], 403, [], JSON_UNESCAPED_UNICODE);
            }

            $acceptedProposal = $project->proposalls()
                ->where('status', 'accepted')
                ->first();

            if (!$acceptedProposal) {
                DB::rollBack();
                
                return response()->json([
                    'success' => false,
                    'message' => 'Project belum memiliki freelancer'
                ], 400, [], JSON_UNESCAPED_UNICODE);
            }

            // Calculate refund based on progress
            $progress = $project->progress ?? 0;
            $refundPercentage = 100 - ($progress * 0.5);
            $refundAmount = ($acceptedProposal->proposal_price * $refundPercentage) / 100;

            $cancellation = ProjectCancellation::create([
                'project_id' => $project->id,
                'user_id' => Auth::id(),
                'project_status' => 'working',
                'reason' => $validated['reason'],
                'refund_amount' => $refundAmount,
                'refund_status' => 'pending',
                'cancelled_at' => now()
            ]);

            $project->update(['status' => 'cancelled']);

            DB::commit();

            Log::info('✅ Working project cancelled', ['cancellation_id' => $cancellation->id]);

            return response()->json([
                'success' => true,
                'message' => 'Project berhasil dibatalkan. Refund ' . round($refundPercentage, 0) . '% akan diproses.',
                'data' => [
                    'cancellation_id' => $cancellation->id,
                    'refund_amount' => number_format($refundAmount, 0, ',', '.'),
                    'refund_percentage' => round($refundPercentage, 2)
                ]
            ], 200, [], JSON_UNESCAPED_UNICODE);

        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
            
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $e->errors()
            ], 422, [], JSON_UNESCAPED_UNICODE);

        } catch (\Exception $e) {
            DB::rollBack();
            
            Log::error('❌ CANCEL WORKING ERROR', [
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