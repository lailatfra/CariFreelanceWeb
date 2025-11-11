<?php

// app/Http/Controllers/ProposalController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proposal;
use App\Models\Project;
use App\Models\SubmitProject;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class ProposalController extends Controller
{
    public function create(Project $project)
    {
        return view('freelancer.proposall', compact('project'));
    }
    
public function store(Request $request, Project $project)
{
    // Add debugging
    Log::info('Proposal Store Request Data:', $request->all());
    
    $request->validate([
        'proposal_description' => 'required|string',
        'proposal_price' => 'required|numeric',
    ]);

    // Handle skills - Fixed version
    $skills = [];
    if ($request->has('skills') && $request->skills) {
        if (is_string($request->skills)) {
            // If it's a comma-separated string
            $skills = array_filter(array_map('trim', explode(',', $request->skills)));
        } elseif (is_array($request->skills)) {
            $skills = $request->skills;
        }
    }

    Log::info('Processed skills:', $skills);

    // Handle file upload
    $uploadedFiles = [];
    if ($request->hasFile('files')) {
        foreach ($request->file('files') as $file) {
            $filename = time() . '_' . Str::random(8) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('proposals', $filename, 'public');
            $uploadedFiles[] = $path;
        }
    }

    Log::info('Uploaded files:', $uploadedFiles);

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

        Log::info('Proposal created successfully:', ['id' => $proposal->id]);

        // PERUBAHAN: Redirect ke halaman jobboard freelancer dengan pesan sukses
        return redirect()->route('projekf')->with('success', 'Proposal berhasil dikirim! Anda dapat memantau status proposal di halaman ini.');
        
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
        // Ambil semua proposal untuk project ini
        $proposals = $project->proposalls()
            ->with(['user.freelancerProfile']) // ambil data freelancer (nama, lokasi, dll)
            ->get();

        return view('client.freelancer.2', compact('project', 'proposals'));
    }

public function index(Project $project)
    {
        $userId = auth()->id();
        
        // Ambil completed projects (yang sudah disubmit dan status selesai)
        $completed = SubmitProject::with(['project.client', 'proposal'])
                    ->where('user_id', $userId)
                    ->where('status', 'selesai')
                    ->get();

        // Ambil ID project yang sudah SELSAI (bukan semua yang disubmit)
        $completedProjectIds = SubmitProject::where('user_id', $userId)
                                          ->where('status', 'selesai')
                                          ->pluck('project_id')
                                          ->toArray();

        // Ambil projects untuk "Sedang Dikerjakan" 
        // Hanya exclude projects yang sudah SELSAI, bukan yang pending/revisi
        $projects = Project::with(['proposalls', 'timelines'])
                          ->whereHas('proposalls', function($query) use ($userId) {
                              $query->where('user_id', $userId)
                                   ->where('status', 'accepted');
                          })
                          ->whereNotIn('id', $completedProjectIds) // Hanya exclude yang selesai
                          ->get();

        // Ambil semua proposals dari user
        $proposals = Proposal::with(['project.client'])
                           ->where('user_id', $userId)
                           ->get();

        return view('freelancer.projek', compact('completed', 'projects', 'proposals'));
    }

public function accept($id)
{
    // Ambil proposal yang dipilih
    $proposal = Proposal::findOrFail($id);

    // Pastikan proposal ini milik project dari client yang login
    if ($proposal->project->user_id !== Auth::id()) {
        abort(403, 'Unauthorized action.');
    }

    // Pastikan proposal masih pending
    if ($proposal->status !== 'pending') {
        return redirect()->back()->with('error', 'Proposal ini sudah tidak dapat diproses.');
    }

    // Redirect ke halaman pembayaran (INI YANG BERUBAH)
    return redirect()->route('payment.show', $proposal);
}

    public function showProposal(Proposal $proposal)
    {
        $proposal->load(['user.freelancerProfile', 'project']);
        return view('client.freelancer.1-1', compact('proposal'));
    }
    
}