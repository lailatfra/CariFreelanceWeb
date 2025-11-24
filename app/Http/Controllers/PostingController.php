<?php
// app/Http/Controllers/PostingController.php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class PostingController extends Controller
{
    /**
     * Show form untuk create project baru
     */
    public function create()
    {
        return view('client.posting', [
            'project' => null,
            'isEdit' => false,
            'pageTitle' => 'Posting Proyek',
            'pageSubtitle' => 'Buat proyek yang menarik untuk mendapatkan freelancer terbaik sesuai kebutuhan proyek Anda'
        ]);
    }

    /**
     * Show form untuk edit project yang sudah ada
     */
    public function edit(Project $project)
    {
        // Check authorization
        if ($project->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('client.posting', [
            'project' => $project,
            'isEdit' => true,
            'pageTitle' => 'Edit Proyek',
            'pageSubtitle' => 'Perbarui informasi proyek Anda untuk mendapatkan freelancer terbaik'
        ]);
    }

    /**
     * Store new project
     */
    public function store(Request $request)
    {
        
        // Validation rules
        $rules = [
            'title' => 'required|string|max:100',
            'category' => 'required|string',
            'subcategory' => 'nullable|string',
            'experience_level' => 'nullable|in:entry,intermediate,expert',
            // 'project_type' => 'required|in:one-time,ongoing,contract',
            'skills_required' => 'nullable|string',
            'description' => 'required|string',
            'requirements' => 'nullable|string',
            'deliverables' => 'required|string',
            'budget_type' => 'required|in:fixed,range',
            'timeline_type' => 'required|in:weekly,daily',
            'timeline_duration' => 'required|integer|min:1|max:52',
            'deadline' => 'required|date|after:today',
            'urgency' => 'nullable|in:normal,urgent,asap',
            'additional_info' => 'nullable|string',
            'attachments.*' => 'nullable|file|max:51200|mimes:pdf,doc,docx,jpg,jpeg,png,gif,webp,mp4,mov,avi,wmv,flv,webm'
        ];

        // Dynamic budget validation
        if ($request->budget_type === 'fixed') {
            $rules['fixed_budget'] = 'required|numeric|min:0';
        } elseif ($request->budget_type === 'range') {
            $rules['min_budget'] = 'required|numeric|min:0';
            $rules['max_budget'] = 'required|numeric|min:0|gte:min_budget';
        }

        $validator = Validator::make($request->all(), $rules, [
            'title.required' => 'Judul proyek wajib diisi',
            'title.max' => 'Judul proyek tidak boleh lebih dari 100 karakter',
            'category.required' => 'Kategori wajib dipilih',
            'description.required' => 'Deskripsi proyek wajib diisi',
            'deliverables.required' => 'Hasil yang diharapkan wajib diisi',
            'budget_type.required' => 'Tipe budget wajib dipilih',
            'timeline_duration.required' => 'Durasi pengerjaan wajib dipilih',
            'deadline.required' => 'Deadline wajib diisi',
            'deadline.after' => 'Deadline harus setelah hari ini',
            'fixed_budget.required' => 'Budget tetap wajib diisi',
            'min_budget.required' => 'Budget minimum wajib diisi',
            'max_budget.required' => 'Budget maksimum wajib diisi',
            'max_budget.gte' => 'Budget maksimum harus lebih besar atau sama dengan budget minimum',
            'attachments.*.max' => 'Ukuran file tidak boleh lebih dari 50MB',
            'attachments.*.mimes' => 'Format file harus PDF, DOC, DOCX, JPG, JPEG, PNG, GIF, WEBP, MP4, MOV, AVI, WMV, FLV, atau WEBM'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            // Handle file uploads
            $attachments = [];
            if ($request->hasFile('attachments')) {
                foreach ($request->file('attachments') as $file) {
                    if ($file->isValid()) {
                        $originalName = $file->getClientOriginalName();
                        $extension = $file->getClientOriginalExtension();
                        $mimeType = $file->getMimeType();
                        $size = $file->getSize();

                        // Generate unique filename
                        $filename = time() . '_' . uniqid() . '.' . $extension;

                        // Store file in projects directory
                        $path = $file->storeAs('projects', $filename, 'public');

                        // Determine file type
                        $fileType = $this->determineFileType($mimeType, $extension);

                        // Create attachment data
                        $attachmentData = [
                            'original_name' => $originalName,
                            'stored_name' => $filename,
                            'path' => $path,
                            'size' => $size,
                            'mime_type' => $mimeType,
                            'file_type' => $fileType,
                            'extension' => strtolower($extension)
                        ];

                        // Generate thumbnail for documents and videos
                        if ($fileType === 'document') {
                            $attachmentData['thumbnail'] = $this->generateDocumentThumbnail($path, $extension);
                        } elseif ($fileType === 'video') {
                            $attachmentData['thumbnail'] = $this->generateVideoThumbnail($path);
                        }

                        $attachments[] = $attachmentData;
                    }
                }
            }

            // Process skills
            $skills = [];
            if (!empty($request->skills_required)) {
                $skills = array_map('trim', explode(',', $request->skills_required));
                $skills = array_filter($skills);
            }

            // Determine status and posted_at
            $action = $request->input('action', 'publish');
            $status = ($action === 'draft') ? 'draft' : 'open';
            $posted_at = ($action === 'draft') ? null : Carbon::now();

            // Create project data
            $projectData = [
                'user_id' => Auth::id(),
                'title' => $request->title,
                'category' => $request->category,
                'subcategory' => $request->subcategory,
                'experience_level' => $request->experience_level,
                // 'project_type' => $request->project_type,
                'skills_required' => $skills,
                'description' => $request->description,
                'requirements' => $request->requirements,
                'deliverables' => $request->deliverables,
                'attachments' => $attachments,
                'budget_type' => $request->budget_type,
                'payment_method' => 'full', // SELALU FULL
                'timeline_type' => $request->timeline_type,
                'timeline_duration' => $request->timeline_duration,
                'deadline' => Carbon::parse($request->deadline),
                'urgency' => $request->urgency ?? 'normal',
                'additional_info' => $request->additional_info,
                'status' => $status,
                'posted_at' => $posted_at
            ];

            // Add budget fields based on type
            if ($request->budget_type === 'fixed') {
                $projectData['fixed_budget'] = $request->fixed_budget;
            } elseif ($request->budget_type === 'range') {
                $projectData['min_budget'] = $request->min_budget;
                $projectData['max_budget'] = $request->max_budget;
            }

            // Create the project
            $project = Project::create($projectData);

            // Success message
            if ($action === 'draft') {
                return redirect()->route('projek')
                    ->with('success', 'Proyek berhasil disimpan sebagai draft');
            } else {
                return redirect()->route('posting.create')
                    ->with('success', 'Lowongan berhasil diposting!')
                    ->with('action', 'publish')
                    ->with('project_id', $project->id);
            }
        } catch (\Exception $e) {
            \Log::error('Error creating project: ' . $e->getMessage());

            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat menyimpan proyek. Silakan coba lagi.')
                ->withInput();
        }
    }

    /**
     * Update existing project
     */
    public function update(Request $request, Project $project)
    {
        if ($project->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // Same validation rules as store method
        $rules = [
            'title' => 'required|string|max:100',
            'category' => 'required|string',
            'subcategory' => 'nullable|string',
            'experience_level' => 'nullable|in:entry,intermediate,expert',
            // 'project_type' => 'required|in:one-time,ongoing,contract',
            'skills_required' => 'nullable|string',
            'description' => 'required|string',
            'requirements' => 'nullable|string',
            'deliverables' => 'required|string',
            'budget_type' => 'required|in:fixed,range',
            'timeline_type' => 'required|in:weekly,daily',
            'timeline_duration' => 'required|integer|min:1|max:52',
            'deadline' => 'required|date|after:today',
            'urgency' => 'nullable|in:normal,urgent,asap',
            'additional_info' => 'nullable|string',
            'attachments.*' => 'nullable|file|max:51200|mimes:pdf,doc,docx,jpg,jpeg,png,gif,webp,mp4,mov,avi,wmv,flv,webm'
        ];

        // Dynamic budget validation
        if ($request->budget_type === 'fixed') {
            $rules['fixed_budget'] = 'required|numeric|min:0';
        } elseif ($request->budget_type === 'range') {
            $rules['min_budget'] = 'required|numeric|min:0';
            $rules['max_budget'] = 'required|numeric|min:0|gte:min_budget';
        }

        $validator = Validator::make($request->all(), $rules, [
            'title.required' => 'Judul proyek wajib diisi',
            'title.max' => 'Judul proyek tidak boleh lebih dari 100 karakter',
            'category.required' => 'Kategori wajib dipilih',
            'description.required' => 'Deskripsi proyek wajib diisi',
            'deliverables.required' => 'Hasil yang diharapkan wajib diisi',
            'budget_type.required' => 'Tipe budget wajib dipilih',
            'timeline_duration.required' => 'Durasi pengerjaan wajib dipilih',
            'deadline.required' => 'Deadline wajib diisi',
            'deadline.after' => 'Deadline harus setelah hari ini',
            'fixed_budget.required' => 'Budget tetap wajib diisi',
            'min_budget.required' => 'Budget minimum wajib diisi',
            'max_budget.required' => 'Budget maksimum wajib diisi',
            'max_budget.gte' => 'Budget maksimum harus lebih besar atau sama dengan budget minimum',
            'attachments.*.max' => 'Ukuran file tidak boleh lebih dari 50MB',
            'attachments.*.mimes' => 'Format file harus PDF, DOC, DOCX, JPG, JPEG, PNG, GIF, WEBP, MP4, MOV, AVI, WMV, FLV, atau WEBM'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            // Handle existing attachments removal
            $currentAttachments = $project->attachments ?? [];

            if ($request->has('remove_attachments')) {
                $removeIndices = $request->remove_attachments;
                foreach ($removeIndices as $index) {
                    if (isset($currentAttachments[$index])) {
                        if (isset($currentAttachments[$index]['path'])) {
                            Storage::disk('public')->delete($currentAttachments[$index]['path']);
                        }
                        unset($currentAttachments[$index]);
                    }
                }
                $currentAttachments = array_values($currentAttachments);
            }

            // Handle new file uploads
            if ($request->hasFile('attachments')) {
                foreach ($request->file('attachments') as $file) {
                    if ($file->isValid()) {
                        $originalName = $file->getClientOriginalName();
                        $extension = $file->getClientOriginalExtension();
                        $mimeType = $file->getMimeType();
                        $size = $file->getSize();

                        $filename = time() . '_' . uniqid() . '.' . $extension;
                        $path = $file->storeAs('projects', $filename, 'public');
                        $fileType = $this->determineFileType($mimeType, $extension);

                        $attachmentData = [
                            'original_name' => $originalName,
                            'stored_name' => $filename,
                            'path' => $path,
                            'size' => $size,
                            'mime_type' => $mimeType,
                            'file_type' => $fileType,
                            'extension' => strtolower($extension)
                        ];

                        if ($fileType === 'document') {
                            $attachmentData['thumbnail'] = $this->generateDocumentThumbnail($path, $extension);
                        } elseif ($fileType === 'video') {
                            $attachmentData['thumbnail'] = $this->generateVideoThumbnail($path);
                        }

                        $currentAttachments[] = $attachmentData;
                    }
                }
            }

            // Process skills
            $skills = [];
            if (!empty($request->skills_required)) {
                $skills = array_map('trim', explode(',', $request->skills_required));
                $skills = array_filter($skills);
            }

            // Determine action and status
            $action = $request->input('action', 'update');

            if ($project->status === 'draft' && $action === 'publish') {
                $status = 'open';
                $posted_at = Carbon::now();
            } else {
                $status = $project->status;
                $posted_at = $project->posted_at;
            }

            // Prepare update data
            $updateData = [
                'title' => $request->title,
                'category' => $request->category,
                'subcategory' => $request->subcategory,
                'experience_level' => $request->experience_level,
                // 'project_type' => $request->project_type,
                'skills_required' => $skills,
                'description' => $request->description,
                'requirements' => $request->requirements,
                'deliverables' => $request->deliverables,
                'attachments' => $currentAttachments,
                'budget_type' => $request->budget_type,
                'payment_method' => 'full', // SELALU FULL
                'timeline_type' => $request->timeline_type,
                'timeline_duration' => $request->timeline_duration,
                'deadline' => Carbon::parse($request->deadline),
                'urgency' => $request->urgency ?? 'normal',
                'additional_info' => $request->additional_info,
                'status' => $status,
                'posted_at' => $posted_at
            ];

            // Clear budget fields first
            $updateData['fixed_budget'] = null;
            $updateData['min_budget'] = null;
            $updateData['max_budget'] = null;

            // Add budget fields based on type
            if ($request->budget_type === 'fixed') {
                $updateData['fixed_budget'] = $request->fixed_budget;
            } elseif ($request->budget_type === 'range') {
                $updateData['min_budget'] = $request->min_budget;
                $updateData['max_budget'] = $request->max_budget;
            }

            // Update the project
            $project->update($updateData);

            // Success message berdasarkan action
            if ($action === 'publish') {
                return redirect()->route('projek')
                    ->with('success', 'Proyek berhasil dipublish!');
            } else {
                return redirect()->route('projek')
                    ->with('success', 'Proyek berhasil diperbarui!');
            }

        } catch (\Exception $e) {
            \Log::error('Error updating project: ' . $e->getMessage());

            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat memperbarui proyek. Silakan coba lagi.')
                ->withInput();
        }
    }

    /**
     * Helper method - Determine file type based on MIME type and extension
     */
    private function determineFileType($mimeType, $extension)
    {
        $imageTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp'];
        $videoTypes = ['video/mp4', 'video/mov', 'video/avi', 'video/wmv', 'video/flv', 'video/webm'];
        $documentTypes = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];

        if (in_array($mimeType, $imageTypes)) {
            return 'image';
        } elseif (in_array($mimeType, $videoTypes)) {
            return 'video';
        } elseif (in_array($mimeType, $documentTypes) || in_array(strtolower($extension), ['pdf', 'doc', 'docx'])) {
            return 'document';
        }

        return 'other';
    }

    /**
     * Helper method - Generate thumbnail for documents
     */
    private function generateDocumentThumbnail($path, $extension)
    {
        $extension = strtolower($extension);
        $thumbnailMap = [
            'pdf' => 'thumbnails/pdf-icon.png',
            'doc' => 'thumbnails/word-icon.png',
            'docx' => 'thumbnails/word-icon.png',
        ];

        return $thumbnailMap[$extension] ?? 'thumbnails/document-icon.png';
    }

    /**
     * Helper method - Generate thumbnail for videos
     */
    private function generateVideoThumbnail($path)
    {
        return 'thumbnails/video-icon.png';
    }

    /**
     * Show my projects list
     */
    public function myProjects()
    {
        $projects = Project::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('client.my-projects', compact('projects'));
    }

    /**
     * Show project detail
     */
    public function show(\App\Models\Project $project)
    {
        return view('client.popular.job.job2', compact('project'));
    }

    /**
     * Delete project
     */
    public function destroy(Project $project)
    {
        if ($project->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        try {
            // Delete attachments from storage
            if ($project->attachments) {
                foreach ($project->attachments as $attachment) {
                    if (isset($attachment['path'])) {
                        Storage::disk('public')->delete($attachment['path']);
                    }
                }
            }

            $project->delete();

            return redirect()->route('projek')
                ->with('success', 'Proyek berhasil dihapus!');
        } catch (\Exception $e) {
            \Log::error('Error deleting project: ' . $e->getMessage());

            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat menghapus proyek. Silakan coba lagi.');
        }
    }

    /**
     * Show freelancers for project
     */
    public function freelancer(Project $project)
    {
        // Ambil semua proposal untuk project ini
        $proposals = $project->proposalls()
            ->with(['user.freelancerProfile'])
            ->get();

        return view('client.freelancer.2', compact('project', 'proposals'));
    }

    /**
     * Show project timeline
     */
    public function timeline(Project $project)
    {
        $projectData = [
            'deadline' => $project->deadline,
            'timeline_duration' => $project->timeline_duration,
            'project_name' => $project->name,
            'start_date' => $project->start_date ?? null,
        ];

        return view('freelancer.timeline', compact('project', 'projectData'));
    }

    /**
 * Show popular category projects - MODIFIED VERSION
 */
public function showPopularCategory($subcategory = 'website-development')
{
    $popularSubcategories = [
        'website-development' => [
            'main_category' => 'pekerjaan-popular',
            'main_subcategory' => 'website-development',
            'display_name' => 'Website Development',
            'title' => 'Jasa Pembuatan Website Terbaik dan Profesional',
            'description' => 'Temukan freelancer terbaik untuk membuat website impian Anda',
            'filters' => ['semua', 'Company Profile', 'E-Commerce', 'Landing Page', 'Blog'],
            'breadcrumb' => 'Website Development',
            'parent' => 'Pekerjaan Popular'
        ],
        'mobile-app-development' => [
            'main_category' => 'pekerjaan-popular',
            'main_subcategory' => 'mobile-app-development',
            'display_name' => 'Mobile App Development',
            'title' => 'Jasa Pembuatan Aplikasi Mobile Terbaik',
            'description' => 'Dapatkan aplikasi mobile Android dan iOS berkualitas tinggi',
            'filters' => ['semua', 'Android', 'iOS', 'React Native', 'Flutter'],
            'breadcrumb' => 'Mobile App Development',
            'parent' => 'Pekerjaan Popular'
        ],
        'logo-design' => [
            'main_category' => 'pekerjaan-popular',
            'main_subcategory' => 'logo-design',
            'display_name' => 'Logo Design',
            'title' => 'Jasa Desain Logo Kreatif dan Profesional',
            'description' => 'Ciptakan identitas brand yang memorable',
            'filters' => ['semua', 'Minimalis', 'Corporate', 'Creative', 'Modern'],
            'breadcrumb' => 'Logo Design',
            'parent' => 'Pekerjaan Popular'
        ],
        'video-editing' => [
            'main_category' => 'pekerjaan-popular',
            'main_subcategory' => 'video-editing',
            'display_name' => 'Video Editing',
            'title' => 'Jasa Edit Video Berkualitas Tinggi',
            'description' => 'Edit video profesional untuk berbagai kebutuhan',
            'filters' => ['semua', 'YouTube', 'Instagram', 'Wedding', 'Corporate'],
            'breadcrumb' => 'Video Editing',
            'parent' => 'Pekerjaan Popular'
        ]
    ];

    if (!isset($popularSubcategories[$subcategory])) {
        return redirect()->route('popular.category', ['subcategory' => 'website-development']);
    }

    $config = $popularSubcategories[$subcategory];

    // MODIFIED QUERY: Only show projects that don't have accepted proposals
    $projects = Project::published()
        ->where(function ($query) use ($subcategory) {
            // New format
            $query->where('category', 'pekerjaan-popular')
                ->where('subcategory', $subcategory);

            // Support legacy data
            if ($subcategory === 'website-development') {
                $query->orWhere('category', 'web-development')
                    ->orWhere(function ($q) {
                        $q->where('category', 'web-app')
                            ->whereIn('subcategory', ['web-development', 'website-development']);
                    });
            } elseif ($subcategory === 'logo-design') {
                $query->orWhere(function ($q) {
                    $q->where('category', 'graphic-design')
                        ->where('subcategory', 'logo-design');
                });
            } elseif ($subcategory === 'mobile-app-development') {
                $query->orWhere(function ($q) {
                    $q->where('category', 'web-app')
                        ->whereIn('subcategory', ['mobile-app-development', 'mobile-app']);
                });
            } elseif ($subcategory === 'video-editing') {
                $query->orWhere('category', 'video-editing');
            }
        })
        ->whereDoesntHave('proposalls', function ($query) {
            $query->where('status', 'accepted'); // Exclude projects with accepted proposals
        })
        ->latest()
        ->get();

    return view('client.popular.web-development', [
        'projects' => $projects,
        'subcategory' => $subcategory,
        'categoryConfig' => $config,
        'totalProjects' => $projects->count()
    ]);
}

/**
 * Show grafis category projects - MODIFIED VERSION
 */
public function showGrafisCategory($subcategory = 'logo-design')
{
    $grafisSubcategories = [
        'logo-design' => [
            'main_category' => 'grafis-desain',
            'main_subcategory' => 'logo-design',
            'display_name' => 'Logo Design',
            'title' => 'Jasa Desain Logo Kreatif dan Profesional - Grafis',
            'description' => 'Desain logo profesional dari kategori Grafis & Desain',
            'filters' => ['semua', 'Minimalis', 'Corporate', 'Creative', 'Modern'],
            'breadcrumb' => 'Logo Design',
            'parent' => 'Grafis & Desain'
        ],
        'brand-identity' => [
            'main_category' => 'grafis-desain',
            'main_subcategory' => 'brand-identity',
            'display_name' => 'Brand Identity',
            'title' => 'Jasa Desain Brand Identity Lengkap',
            'description' => 'Paket lengkap identitas brand untuk bisnis Anda',
            'filters' => ['semua', 'Logo Package', 'Brand Guidelines', 'Complete Branding'],
            'breadcrumb' => 'Brand Identity',
            'parent' => 'Grafis & Desain'
        ],
        'packaging-design' => [
            'main_category' => 'grafis-desain',
            'main_subcategory' => 'packaging-design',
            'display_name' => 'Packaging Design',
            'title' => 'Jasa Desain Kemasan Produk',
            'description' => 'Desain kemasan yang menarik dan fungsional',
            'filters' => ['semua', 'Box Design', 'Label Design', 'Bottle Design'],
            'breadcrumb' => 'Packaging Design',
            'parent' => 'Grafis & Desain'
        ],
        'ilustrasi-gambar' => [
            'main_category' => 'grafis-desain',
            'main_subcategory' => 'ilustrasi-gambar',
            'display_name' => 'Ilustrasi Gambar',
            'title' => 'Jasa Ilustrasi dan Artwork Custom',
            'description' => 'Ilustrasi custom untuk berbagai kebutuhan',
            'filters' => ['semua', 'Digital Art', 'Character Design', 'Icon Design'],
            'breadcrumb' => 'Ilustrasi Gambar',
            'parent' => 'Grafis & Desain'
        ],
        'stiker-design' => [
            'main_category' => 'grafis-desain',
            'main_subcategory' => 'stiker-design',
            'display_name' => 'Stiker Design',
            'title' => 'Jasa Desain Stiker Kreatif',
            'description' => 'Desain stiker untuk promosi dan branding',
            'filters' => ['semua', 'Promotional', 'Decorative', 'Custom Shape'],
            'breadcrumb' => 'Stiker Design',
            'parent' => 'Grafis & Desain'
        ]
    ];

    if (!isset($grafisSubcategories[$subcategory])) {
        return redirect()->route('grafis.category', ['subcategory' => 'logo-design']);
    }

    $config = $grafisSubcategories[$subcategory];

    // MODIFIED QUERY: Only show projects that don't have accepted proposals
    $projects = Project::published()
        ->where(function ($query) use ($subcategory) {
            // New format
            $query->where('category', 'grafis-desain')
                ->where('subcategory', $subcategory);

            // Support legacy data
            if ($subcategory === 'logo-design') {
                $query->orWhere(function ($q) {
                    $q->where('category', 'graphic-design')
                        ->where('subcategory', 'logo-design');
                });
            }
        })
        ->whereDoesntHave('proposalls', function ($query) {
            $query->where('status', 'accepted'); // Exclude projects with accepted proposals
        })
        ->latest()
        ->get();

    return view('client.popular.web-development', [
        'projects' => $projects,
        'subcategory' => $subcategory,
        'categoryConfig' => $config,
        'totalProjects' => $projects->count()
    ]);
}

    /**
     * Redirect index to popular category
     */
    public function index()
    {
        return redirect()->route('popular.category', ['subcategory' => 'website-development']);
    }
}