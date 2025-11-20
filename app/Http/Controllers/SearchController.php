<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('q', '');
        $category = $request->input('category', 'project');

        if ($category === 'project') {
            $query = Project::published()->latest();
            
            if (!empty($keyword)) {
                $query->where('title', 'LIKE', "%{$keyword}%");
            }
            
            $projects = $query->get();
        } else {
            $projects = collect(); // Untuk kategori, kita handle di frontend
        }

        return view('search.index', [
            'keyword' => $keyword,
            'category' => $category,
            'projects' => $projects,
            'totalProjects' => $projects->count()
        ]);
    }

    public function ajaxSearch(Request $request)
    {
        $keyword = $request->input('q', '');
        $searchCategory = $request->input('category', 'project');
        
        if ($searchCategory === 'project') {
            // Search di projects (judul)
            $query = Project::published()->latest();
            
            if (!empty($keyword)) {
                $query->where('title', 'LIKE', "%{$keyword}%");
            }
            
            $projects = $query->take(20)->get()->map(function($project) {
                return [
                    'id' => $project->id,
                    'title' => $project->title,
                    'user_name' => $project->user->name ?? 'Anonim',
                    'user_avatar' => $project->user->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode($project->user->name ?? 'User') . '&background=random',
                    'posted_at' => $project->created_at->diffForHumans(),
                    'budget_type' => $project->budget_type,
                    'formatted_budget' => $project->formatted_budget,
                    'experience_level' => $project->experience_level ?? 'entry',
                    'urgency' => $project->urgency,
                    'project_type' => $project->project_type,
                    'main_attachment' => $project->main_attachment,
                    'has_image' => $project->hasImage(),
                    'image_url' => $project->image_url,
                ];
            });
            
            return response()->json([
                'projects' => $projects,
                'count' => $projects->count()
            ]);
        } else {
            // Untuk kategori, kita handle filtering di frontend
            return response()->json([
                'categories' => $this->getFilteredCategories($keyword),
                'count' => count($this->getFilteredCategories($keyword))
            ]);
        }
    }

    // Function untuk filter kategori berdasarkan keyword
    private function getFilteredCategories($keyword = '')
    {
        $allCategories = $this->getAllCategories();
        
        if (empty($keyword)) {
            return $allCategories;
        }
        
        $keyword = strtolower($keyword);
        $filtered = [];
        
        foreach ($allCategories as $category) {
            $filteredSubcategories = array_filter($category['categories'], function($subcat) use ($keyword) {
                return strpos(strtolower($subcat['title']), $keyword) !== false ||
                       strpos(strtolower($subcat['description']), $keyword) !== false ||
                       strpos(strtolower($category['title']), $keyword) !== false;
            });
            
            if (!empty($filteredSubcategories)) {
                $filtered[] = [
                    'title' => $category['title'],
                    'subtitle' => $category['subtitle'],
                    'sidebarTitle' => $category['sidebarTitle'],
                    'sidebarItems' => $category['sidebarItems'],
                    'categories' => array_values($filteredSubcategories)
                ];
            }
        }
        
        return $filtered;
    }

    // Data semua kategori (gabungan dari 5 file)
    private function getAllCategories()
    {
        return [
            [
                'title' => 'Pekerjaan Popular',
                'subtitle' => 'Kategori pekerjaan yang paling banyak dicari dan diminati oleh klien kami',
                'sidebarTitle' => 'Pekerjaan Popular',
                'sidebarItems' => [
                    ['name' => 'Website Development', 'route' => 'website-development'],
                    ['name' => 'Mobile App Development', 'route' => 'mobile-app-development'],
                    ['name' => 'Logo Design', 'route' => 'logo-design'],
                    ['name' => 'Video Editing', 'route' => 'video-editing']
                ],
                'categories' => [
                    [
                        'title' => 'Website Development',
                        'description' => 'Jasa pembuatan website profesional',
                        'image' => 'https://images.unsplash.com/photo-1461749280684-dccba630e2f6?w=500&h=300&fit=crop',
                        'route' => 'website-development'
                    ],
                    [
                        'title' => 'Mobile App Development',
                        'description' => 'Aplikasi Android dan iOS',
                        'image' => 'https://images.unsplash.com/photo-1512941937669-90a1b58e7e9c?w=500&h=300&fit=crop',
                        'route' => 'mobile-app-development'
                    ],
                    [
                        'title' => 'Logo Design',
                        'description' => 'Desain logo kreatif dan profesional',
                        'image' => 'https://images.unsplash.com/photo-1561070791-2526d30994b5?w=500&h=300&fit=crop',
                        'route' => 'logo-design'
                    ],
                    [
                        'title' => 'Video Editing',
                        'description' => 'Edit video berkualitas tinggi',
                        'image' => 'https://images.unsplash.com/photo-1574717024653-61fd2cf4d44d?w=500&h=300&fit=crop',
                        'route' => 'video-editing'
                    ]
                ]
            ],
            [
                'title' => 'Grafis & Desain',
                'subtitle' => 'Solusi desain grafis profesional untuk kebutuhan bisnis dan personal Anda',
                'sidebarTitle' => 'Grafis & Desain',
                'sidebarItems' => [
                    ['name' => 'Logo Design', 'route' => 'logo-design'],
                    ['name' => 'Brand Identity', 'route' => 'brand-identity'],
                    ['name' => 'Packaging Design', 'route' => 'packaging-design'],
                    ['name' => 'Ilustrasi Gambar', 'route' => 'ilustrasi-gambar'],
                    ['name' => 'Stiker Design', 'route' => 'stiker-design']
                ],
                'categories' => [
                    [
                        'title' => 'Logo Design',
                        'description' => 'Desain logo profesional dan berkesan',
                        'image' => 'https://images.unsplash.com/photo-1561070791-2526d30994b5?w=500&h=300&fit=crop',
                        'route' => 'logo-design'
                    ],
                    [
                        'title' => 'Brand Identity',
                        'description' => 'Identitas visual yang konsisten',
                        'image' => 'https://images.unsplash.com/photo-1558655146-9f40138edfeb?w=500&h=300&fit=crop',
                        'route' => 'brand-identity'
                    ],
                    [
                        'title' => 'Packaging Design',
                        'description' => 'Desain kemasan yang menarik',
                        'image' => 'https://images.unsplash.com/photo-1586953208448-b95a79798f07?w=500&h=300&fit=crop',
                        'route' => 'packaging-design'
                    ],
                    [
                        'title' => 'Ilustrasi Gambar',
                        'description' => 'Ilustrasi custom dan artwork',
                        'image' => 'https://images.unsplash.com/photo-1513475382585-d06e58bcb0e0?w=500&h=300&fit=crop',
                        'route' => 'ilustrasi-gambar'
                    ]
                ]
            ],
            // ... tambahkan kategori lainnya sesuai kebutuhan
        ];
    }
}