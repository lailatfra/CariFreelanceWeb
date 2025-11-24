<?php
// app/Http/Controllers/ProposalController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proposal;
use App\Models\Project;
use App\Models\SubmitProject;
use App\Models\ProjectCancellation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use App\Services\NotificationService;
use Illuminate\Support\Facades\Storage; // ✅ TAMBAHKAN INI

class ProposalController extends Controller
{
    public function create(Project $project)
    {
        return view('freelancer.proposall', compact('project'));
    }
    
    public function store(Request $request, Project $project)
    {
        Log::info('Proposal Store Request Data:', $request->all());
        
        // Validasi dasar
        $request->validate([
            'proposal_description' => 'required|string',
            'proposal_price' => 'required|numeric|min:0',
        ]);

        // Validasi khusus berdasarkan budget type project
        if ($project->budget_type === 'fixed') {
            // Untuk fixed budget, harga harus sama dengan fixed_budget
            if ($request->proposal_price != $project->fixed_budget) {
                return redirect()->back()
                    ->withErrors(['proposal_price' => 'Untuk proyek dengan harga tetap, Anda harus mengajukan proposal dengan harga yang telah ditentukan: Rp ' . number_format($project->fixed_budget, 0, ',', '.')])
                    ->withInput();
            }
        } elseif ($project->budget_type === 'range') {
            // Untuk range budget, harga harus dalam range min-max
            $request->validate([
                'proposal_price' => 'required|numeric|min:' . $project->min_budget . '|max:' . $project->max_budget,
            ], [
                'proposal_price.min' => 'Harga penawaran minimal adalah Rp ' . number_format($project->min_budget, 0, ',', '.'),
                'proposal_price.max' => 'Harga penawaran maksimal adalah Rp ' . number_format($project->max_budget, 0, ',', '.'),
            ]);
        }

        // Handle skills
        $skills = [];
        if ($request->has('skills') && $request->skills) {
            if (is_string($request->skills)) {
                $skills = array_filter(array_map('trim', explode(',', $request->skills)));
            } elseif (is_array($request->skills)) {
                $skills = $request->skills;
            }
        }

        // Handle file upload
        $uploadedFiles = [];
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                if ($file->isValid()) {
                    $filename = time() . '_' . Str::random(8) . '.' . $file->getClientOriginalExtension();
                    $path = $file->storeAs('proposals', $filename, 'public');
                    $uploadedFiles[] = $path;
                }
            }
        }

        try {
            $proposal = Proposal::create([
                'project_id' => $project->id,
                'user_id' => Auth::id(),
                'proposal_title' => $project->title,
                'proposal_description' => $request->proposal_description,
                'proposal_price' => $request->proposal_price,
                'timeline' => null,
                'skills' => $skills,
                'experience' => $request->experience,
                'portfolio_links' => $request->portfolio_links,
                'files' => $uploadedFiles,
                'additional_message' => $request->additional_message,
            ]);

            // ✅ TRIGGER NOTIFIKASI KE CLIENT
            if (class_exists('App\Services\NotificationService')) {
                \App\Services\NotificationService::proposalReceived($proposal);
            }

            Log::info('Proposal created successfully:', ['id' => $proposal->id]);

            return redirect()->route('projekf')->with('success', 'Proposal berhasil dikirim! Client akan menerima notifikasi.');
            
        } catch (\Exception $e) {
            Log::error('Error creating proposal:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return redirect()->back()->withErrors(['error' => 'Gagal mengirim proposal: ' . $e->getMessage()]);
        }
    }

    public function show(Project $project)
    {
        $proposals = $project->proposalls()
            ->with(['user.freelancerProfile'])
            ->get();

        return view('client.freelancer.2', compact('project', 'proposals'));
    }

public function index()
{
    $userId = auth()->id();
    
    $cancelledProjects = \App\Models\ProjectCancellation::with([
        'project.proposalls.user'
    ])
    ->where('refund_status', 'processed')
    ->orderByDesc('cancelled_at')
    ->get();
    
    // ✅ PERBAIKAN: Completed projects dengan query yang sama seperti client
    $completed = SubmitProject::with([
            'project', 
            'project.client',
            'project.proposalls' => function($query) use ($userId) {
                $query->where('status', 'accepted')->where('user_id', $userId);
            }
        ])
        ->where('user_id', $userId)
        ->where('status', 'selesai')
        ->orderByDesc('updated_at')
        ->get();

    // ✅ PERBAIKAN: Working projects dengan filter yang sama seperti client
    $projects = Project::with([
        'proposalls' => function($query) use ($userId) {
            $query->where('user_id', $userId)
                  ->where('status', 'accepted')
                  ->with('user');
        },
        'timelines',
        'submitProjects' => function($query) use ($userId) {
            $query->where('user_id', $userId)->latest(); // ambil submit terbaru
        },
        'client'
    ])
    ->whereHas('proposalls', function($query) use ($userId) {
        $query->where('user_id', $userId)
              ->where('status', 'accepted');
    })
    // ✅ PERBAIKAN: Filter hanya project yang belum selesai - SAMA SEPERTI CLIENT
    ->whereDoesntHave('submitProjects', function($query) use ($userId) {
        $query->where('user_id', $userId)
              ->where('status', 'selesai');
    })
    // ✅ PERBAIKAN: Filter project yang status pembatalannya null/pending/rejected
    ->where(function($q) {
        $q->whereNull('cancellation_status')
          ->orWhere('cancellation_status', 'pending')
          ->orWhere('cancellation_status', 'rejected');
    })
    ->orderByDesc('created_at')
    ->get();

    $proposals = Proposal::with(['project.client'])
                       ->where('user_id', $userId)
                       ->get();

    return view('freelancer.projek', compact('completed', 'projects', 'proposals', 'cancelledProjects'));
}

    public function accept($id)
    {
        $proposal = Proposal::findOrFail($id);

        if ($proposal->project->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        if ($proposal->status !== 'pending') {
            return redirect()->back()->with('error', 'Proposal ini sudah tidak dapat diproses.');
        }

        // Redirect ke halaman pembayaran (payment akan handle accept proposal dan notifikasi)
        return redirect()->route('payment.show', $proposal);
    }

    public function showProposal(Proposal $proposal)
    {
        $proposal->load(['user.freelancerProfile', 'project']);
        return view('client.freelancer.1-1', compact('proposal'));
    }

    // ✅ TAMBAHKAN METHOD INI UNTUK DETAIL PEMBATALAN
    public function getCancellationDetail($cancellationId)
    {
        try {
            $userId = Auth::id();
            
            // Pastikan cancellation ini terkait dengan freelancer yang login
            $cancellation = ProjectCancellation::with(['project', 'project.proposalls.user'])
                ->whereHas('project.proposalls', function($query) use ($userId) {
                    $query->where('user_id', $userId)
                          ->where('status', 'accepted');
                })
                ->findOrFail($cancellationId);

            \Log::info('Freelancer Cancellation Raw Data', [
                'cancellation_id' => $cancellationId,
                'freelancer_id' => $userId,
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

            // Generate URL yang benar untuk file
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

            \Log::info('Freelancer Processed URLs', [
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
            \Log::error('Error in freelancer getCancellationDetail: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Gagal memuat data pembatalan',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}