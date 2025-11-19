<?php
// app/Http/Controllers/ProjectController.php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{
    /**
     * Display the client dashboard with projects
     */
    public function dashboard()
    {
        $userId = Auth::id();
        
        // Get projects by status for the authenticated user
        $openProjects = Project::where('user_id', $userId)
            ->whereIn('status', ['draft', 'open'])
            ->orderBy('created_at', 'desc')
            ->get();
            
        $inProgressProjects = Project::where('user_id', $userId)
            ->whereIn('status', ['in_progress', 'paused'])
            ->orderBy('updated_at', 'desc')
            ->get();
            
        $completed = Project::where('user_id', $userId)
            ->whereIn('status', ['completed', 'cancelled'])
            ->orderBy('updated_at', 'desc')
            ->get();

        return view('client.dashboard.projects', compact(
            'openProjects', 
            'inProgressProjects', 
            'completedProjects'
        ));
    }

    /**
     * Show the form for creating a new project
     */
    public function create()
    {
        return view('client.projects.create');
    }

    /**
     * Store a newly created project in storage
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'subcategory' => 'nullable|string|max:100',
            'experience_level' => 'required|in:beginner,intermediate,expert',
            'project_type' => 'required|in:one-time,ongoing',
            'skills_required' => 'required|array|min:1',
            'description' => 'required|string|min:50',
            'requirements' => 'nullable|string',
            'deliverables' => 'required|string',
            'budget_type' => 'required|in:fixed,range,hourly',
            'fixed_budget' => 'required_if:budget_type,fixed|nullable|numeric|min:0',
            'min_budget' => 'required_if:budget_type,range|nullable|numeric|min:0',
            'max_budget' => 'required_if:budget_type,range|nullable|numeric|min:0',
            'hourly_rate' => 'required_if:budget_type,hourly|nullable|numeric|min:0',
            'estimated_hours' => 'nullable|integer|min:1',
            'timeline' => 'required|in:1-week,1-2-weeks,2-4-weeks,1-2-months,2-3-months,3-months-plus',
            'urgency' => 'required|in:normal,urgent,asap',
            'deadline' => 'nullable|date|after:today',
            'additional_info' => 'nullable|string',
            'status' => 'required|in:draft,open'
        ]);

        // Additional validation for budget ranges
        if ($validated['budget_type'] === 'range') {
            if ($validated['min_budget'] >= $validated['max_budget']) {
                return back()->withErrors(['max_budget' => 'Budget maksimal harus lebih besar dari budget minimal.']);
            }
        }

        try {
            DB::beginTransaction();

            $project = Project::create([
                'user_id' => Auth::id(),
                'title' => $validated['title'],
                'category' => $validated['category'],
                'subcategory' => $validated['subcategory'],
                'experience_level' => $validated['experience_level'],
                'project_type' => $validated['project_type'],
                'skills_required' => $validated['skills_required'],
                'description' => $validated['description'],
                'requirements' => $validated['requirements'],
                'deliverables' => $validated['deliverables'],
                'budget_type' => $validated['budget_type'],
                'fixed_budget' => $validated['fixed_budget'],
                'min_budget' => $validated['min_budget'],
                'max_budget' => $validated['max_budget'],
                'hourly_rate' => $validated['hourly_rate'],
                'estimated_hours' => $validated['estimated_hours'],
                'timeline' => $validated['timeline'],
                'urgency' => $validated['urgency'],
                'deadline' => $validated['deadline'],
                'additional_info' => $validated['additional_info'],
                'status' => $validated['status'],
                'posted_at' => $validated['status'] === 'open' ? now() : null,
            ]);

            DB::commit();

            $message = $validated['status'] === 'open' 
                ? 'Project berhasil diposting dan sudah tersedia untuk freelancer!'
                : 'Project berhasil disimpan sebagai draft.';

            return redirect()->route('client.dashboard')->with('success', $message);

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Terjadi kesalahan saat menyimpan project.'])->withInput();
        }
    }

    /**
     * Show the form for editing the specified project
     */
    public function edit(Project $project)
    {
        // Ensure user can only edit their own projects
        if ($project->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // Only allow editing if project is still in draft or open status
        if (!in_array($project->status, ['draft', 'open'])) {
            return redirect()->route('client.dashboard')
                ->with('error', 'Project ini tidak dapat diedit karena sudah dalam proses atau selesai.');
        }

        return view('client.projects.edit', compact('project'));
    }

    /**
     * Update the specified project in storage
     */
    public function update(Request $request, Project $project)
    {
        // Ensure user can only update their own projects
        if ($project->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // Only allow updating if project is still in draft or open status
        if (!in_array($project->status, ['draft', 'open'])) {
            return redirect()->route('client.dashboard')
                ->with('error', 'Project ini tidak dapat diedit karena sudah dalam proses atau selesai.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'subcategory' => 'nullable|string|max:100',
            'experience_level' => 'required|in:beginner,intermediate,expert',
            'project_type' => 'required|in:one-time,ongoing',
            'skills_required' => 'required|array|min:1',
            'description' => 'required|string|min:50',
            'requirements' => 'nullable|string',
            'deliverables' => 'required|string',
            'budget_type' => 'required|in:fixed,range,hourly',
            'fixed_budget' => 'required_if:budget_type,fixed|nullable|numeric|min:0',
            'min_budget' => 'required_if:budget_type,range|nullable|numeric|min:0',
            'max_budget' => 'required_if:budget_type,range|nullable|numeric|min:0',
            'hourly_rate' => 'required_if:budget_type,hourly|nullable|numeric|min:0',
            'estimated_hours' => 'nullable|integer|min:1',
            'timeline' => 'required|in:1-week,1-2-weeks,2-4-weeks,1-2-months,2-3-months,3-months-plus',
            'urgency' => 'required|in:normal,urgent,asap',
            'deadline' => 'nullable|date|after:today',
            'additional_info' => 'nullable|string',
            'status' => 'required|in:draft,open'
        ]);

        // Additional validation for budget ranges
        if ($validated['budget_type'] === 'range') {
            if ($validated['min_budget'] >= $validated['max_budget']) {
                return back()->withErrors(['max_budget' => 'Budget maksimal harus lebih besar dari budget minimal.']);
            }
        }

        try {
            DB::beginTransaction();

            $updateData = [
                'title' => $validated['title'],
                'category' => $validated['category'],
                'subcategory' => $validated['subcategory'],
                'experience_level' => $validated['experience_level'],
                'project_type' => $validated['project_type'],
                'skills_required' => $validated['skills_required'],
                'description' => $validated['description'],
                'requirements' => $validated['requirements'],
                'deliverables' => $validated['deliverables'],
                'budget_type' => $validated['budget_type'],
                'fixed_budget' => $validated['fixed_budget'],
                'min_budget' => $validated['min_budget'],
                'max_budget' => $validated['max_budget'],
                'hourly_rate' => $validated['hourly_rate'],
                'estimated_hours' => $validated['estimated_hours'],
                'timeline' => $validated['timeline'],
                'urgency' => $validated['urgency'],
                'deadline' => $validated['deadline'],
                'additional_info' => $validated['additional_info'],
                'status' => $validated['status'],
            ];

            // Set posted_at when changing from draft to open
            if ($project->status === 'draft' && $validated['status'] === 'open') {
                $updateData['posted_at'] = now();
            }

            $project->update($updateData);

            DB::commit();

            $message = $validated['status'] === 'open' 
                ? 'Project berhasil diupdate dan sudah tersedia untuk freelancer!'
                : 'Project berhasil diupdate dan disimpan sebagai draft.';

            return redirect()->route('client.dashboard')->with('success', $message);

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Terjadi kesalahan saat mengupdate project.'])->withInput();
        }
    }

    /**
     * Remove the specified project from storage
     */
    public function destroy(Project $project)
    {
        // Ensure user can only delete their own projects
        if ($project->user_id !== Auth::id()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized action.'], 403);
        }

        // Only allow deleting if project is still in draft, open, or cancelled status
        if (in_array($project->status, ['in_progress', 'completed'])) {
            return response()->json([
                'success' => false, 
                'message' => 'Project yang sedang berjalan atau sudah selesai tidak dapat dihapus.'
            ], 400);
        }

        try {
            DB::beginTransaction();

            // Delete associated files if any
            if ($project->attachments) {
                // Implement file deletion logic here
                // foreach ($project->attachments as $file) {
                //     Storage::delete($file);
                // }
            }

            $project->delete();

            DB::commit();

            return response()->json([
                'success' => true, 
                'message' => 'Project berhasil dihapus.'
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false, 
                'message' => 'Terjadi kesalahan saat menghapus project.'
            ], 500);
        }
    }

    /**
     * Show project details
     */
    public function show(Project $project)
    {
        // Ensure user can view their own projects
        if ($project->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('client.projects.show', compact('project'));
    }

    /**
     * Show freelancer selection page
     */
    public function selectFreelancer(Project $project)
    {
        // Ensure user can select freelancer for their own projects
        if ($project->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // Only allow freelancer selection for open projects
        if ($project->status !== 'open') {
            return redirect()->route('client.dashboard')
                ->with('error', 'Freelancer hanya dapat dipilih untuk project yang berstatus terbuka.');
        }

        // Get freelancers who have applied or are suitable for this project
        // This would typically involve a separate applications or proposals table
        // For now, we'll redirect to a freelancer selection page
        
        return view('client.projects.select-freelancer', compact('project'));
    }

    /**
     * Show project progress
     */
    public function showProgress(Project $project)
    {
        // Ensure user can view progress of their own projects
        if ($project->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // Only show progress for in-progress projects
        if (!in_array($project->status, ['in_progress', 'paused', 'completed'])) {
            return redirect()->route('client.dashboard')
                ->with('error', 'Progress hanya tersedia untuk project yang sedang atau sudah dikerjakan.');
        }

        return view('client.projek', compact('project'));
    }

    /**
     * Show project files
     */
    public function showFiles(Project $project)
    {
        // Ensure user can view files of their own projects
        if ($project->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // Only show files for completed projects
        if ($project->status !== 'completed') {
            return redirect()->route('client.dashboard')
                ->with('error', 'File hanya tersedia untuk project yang sudah selesai.');
        }

        return view('client.projects.files', compact('project'));
    }

    /**
     * Download project files
     */
    public function downloadFiles(Project $project)
    {
        // Ensure user can download files of their own projects
        if ($project->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // Only allow download for completed projects
        if ($project->status !== 'completed') {
            return redirect()->route('client.dashboard')
                ->with('error', 'File hanya dapat didownload untuk project yang sudah selesai.');
        }

        // Implement file download logic here
        // This would typically create a ZIP file of all project deliverables
        
        return redirect()->route('client.dashboard')
            ->with('success', 'Download file dimulai...');
    }

    /**
     * Get projects data for AJAX requests
     */
    public function getProjectsData(Request $request)
    {
        $userId = Auth::id();
        $status = $request->get('status', 'all');
        
        $query = Project::where('user_id', $userId);
        
        if ($status !== 'all') {
            $query->where('status', $status);
        }
        
        $projects = $query->orderBy('created_at', 'desc')->get();
        
        return response()->json([
            'success' => true,
            'data' => $projects
        ]);
    }

    /**
     * Update project status
     */
    public function updateStatus(Request $request, Project $project)
    {
        // Ensure user can update status of their own projects
        if ($project->user_id !== Auth::id()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized action.'], 403);
        }

        $validated = $request->validate([
            'status' => 'required|in:draft,open,in_progress,completed,cancelled,paused'
        ]);

        try {
            $project->update(['status' => $validated['status']]);
            
            return response()->json([
                'success' => true,
                'message' => 'Status project berhasil diupdate.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengupdate status project.'
            ], 500);
        }
    }

    // ProjectController.php

public function cancelOpen(Request $request, $id)
{
    $project = Project::findOrFail($id);
    
    // Check if project has freelancer
    $hasFreelancer = $project->proposalls()->where('status', 'accepted')->exists();
    
    if ($hasFreelancer) {
        return response()->json([
            'success' => false,
            'message' => 'Project ini sudah memiliki freelancer. Gunakan cancel working.'
        ], 400);
    }
    
    // Delete permanently if no freelancer
    $project->delete();
    
    return response()->json([
        'success' => true,
        'message' => 'Project berhasil dihapus!'
    ]);
}

public function cancelWorking(Request $request, $id)
{
    $request->validate([
        'reason' => 'required|string|min:10|max:500',
        'bank_name' => 'required|string',
        'account_number' => 'required|numeric',
        'evidence_files.*' => 'nullable|file|max:5120|mimes:jpg,jpeg,png,gif,pdf,doc,docx,txt'
    ]);
    
    $project = Project::findOrFail($id);
    
    // Check if project has freelancer
    $hasFreelancer = $project->proposalls()->where('status', 'accepted')->exists();
    
    if (!$hasFreelancer) {
        return response()->json([
            'success' => false,
            'message' => 'Project ini belum memiliki freelancer.'
        ], 400);
    }
    
    // Update project with cancellation request
    $project->update([
        'cancellation_status' => 'pending',
        'cancellation_reason' => $request->reason,
        'cancellation_date' => now(),
        'cancellation_bank' => $request->bank_name,
        'cancellation_account' => $request->account_number
    ]);
    
    // Handle file uploads if any
    if ($request->hasFile('evidence_files')) {
        $filePaths = [];
        foreach ($request->file('evidence_files') as $file) {
            $path = $file->store('cancellation_evidence', 'public');
            $filePaths[] = $path;
        }
        $project->update(['cancellation_evidence' => json_encode($filePaths)]);
    }
    
    // Notify admin (optional - implement notification system)
    // event(new ProjectCancellationRequested($project));
    
    return response()->json([
        'success' => true,
        'message' => 'Pengajuan pembatalan berhasil dikirim! Tim kami akan meninjaunya dalam 1x24 jam.'
    ]);
}
}