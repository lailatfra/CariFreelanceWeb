<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        // Query builder untuk proyek
        $query = Project::with('user'); // Sesuaikan dengan relasi di model Anda
        
        // Filter berdasarkan kategori
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }
        
        // Filter berdasarkan sub kategori
        if ($request->filled('subcategory')) {
            $query->where('subcategory', $request->subcategory);
        }
        
        // Filter berdasarkan experience level (opsional, jika ingin ditambahkan)
        if ($request->filled('experience_level')) {
            $query->where('experience_level', $request->experience_level);
        }
        
        // Filter berdasarkan budget type (opsional, jika ingin ditambahkan)
        if ($request->filled('budget_type')) {
            $query->where('budget_type', $request->budget_type);
        }
        
        // Filter berdasarkan urgency (opsional, jika ingin ditambahkan)
        if ($request->filled('urgency')) {
            $query->where('urgency', $request->urgency);
        }
        
        // Search berdasarkan title (opsional, jika ingin ditambahkan)
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }
        
        // Urutkan terbaru
        $query->orderBy('created_at', 'desc');
        
        // Paginate hasil
        $projects = $query->paginate(10);

        return view('admin.projects.index', compact('projects'));
    }
    
    public function store(Request $request)
    {
        // Validasi data
        $validated = $request->validate([
            'title' => 'required|string|max:100',
            'category' => 'required|string',
            'subcategory' => 'nullable|string',
            'project_type' => 'required|string',
            'skills_required' => 'required|string',
            'description' => 'required|string',
            'requirements' => 'nullable|string',
            'deliverables' => 'required|string',
            'budget_type' => 'required|in:fixed,range',
            'fixed_budget' => 'nullable|numeric|min:0',
            'min_budget' => 'nullable|numeric|min:0',
            'max_budget' => 'nullable|numeric|min:0',
            'payment_method' => 'required|in:full,dp_and_final',
            'dp_percentage' => 'nullable|numeric|min:0|max:100',
            'timeline_type' => 'required|in:daily,weekly',
            'timeline_duration' => 'required|numeric|min:1',
            'deadline' => 'nullable|date',
        ]);
        
        // Tambahkan user_id (admin yang membuat)
        $validated['user_id'] = auth()->id();
        
        // Set posted_at ke sekarang
        $validated['posted_at'] = now();
        
        // Buat project baru
        $project = Project::create($validated);
        
        return redirect()->route('admin.projects.index')
            ->with('success', 'Project berhasil dibuat!');
    }
    
    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        $projectTitle = $project->title;
        
        // Hapus project
        $project->delete();
        
        return redirect()->route('admin.projects.index')
            ->with('success', "Project '{$projectTitle}' berhasil dihapus!");
    }
}