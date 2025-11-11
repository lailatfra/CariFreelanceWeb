@extends('client.layout.client-layout') 
@section('title', ($categoryConfig['title'] ?? 'Pekerjaan Popular') . ' - CariFreelance') 
@section('content') 
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $categoryConfig['title'] ?? 'Pekerjaan Popular' }} - CariFreelance</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            overflow-x: hidden;
            background-color: #f8f9fa;
        }

        /* Hide all scrollbars */
        ::-webkit-scrollbar {
            display: none;
        }
        
        html, body {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        /* Navigation Categories - Same styling from original */
        .nav-container {
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            position: sticky;
            top: -1px;
            z-index: 100;
            width: 100vw;
            margin: 0;
            padding: 0;
            transition: all 0.3s ease;
        }

        .nav-container.scrolled {
            box-shadow: 0 4px 20px rgba(0,0,0,0.15);
            top: 60px;
        }

        .nav {
            max-width: 100%;
            margin: 0 auto;
            padding: 0 20px;
        }

        .nav-list {
            display: flex;
            list-style: none;
            overflow-x: auto;
            padding: 4px 0;
            gap: 90px;
            scrollbar-width: none;
            -ms-overflow-style: none;
            align-items: center;
            justify-content: center;
            flex-wrap: nowrap;
        }

        .nav-list::-webkit-scrollbar {
            display: none;
        }

        .nav-item {
            white-space: nowrap;
            cursor: pointer;
            padding: 8px 20px;
            border-radius: 20px;
            transition: all 0.3s ease;
            font-weight: 500;
            color: #666;
            background: transparent;
            border: none;
            min-height: 36px;
            display: flex;
            align-items: center;
            flex-shrink: 0;
        }

        .nav-item:hover, .nav-item.active {
            background: transparent;
            color: #1DA1F2;
            text-shadow: 0 0 10px rgba(29, 161, 242, 0.6);
            box-shadow: none;
            transform: translateY(-1px);
        }

        .nav-link {
            text-decoration: none;
            color: inherit;
            display: block;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .nav-item:hover .nav-link,
        .nav-item.active .nav-link {
            color: #1DA1F2;
            text-shadow: 0 0 10px rgba(29, 161, 242, 0.6);
        }

        /* Breadcrumb */
        .breadcrumb {
            background: #f8f9fa;
            padding: 15px 0;
            border-bottom: 1px solid #e9ecef;
        }

        .breadcrumb-container {
            max-width: 1400px;
            margin: 0;
            margin-left: 5px;
            padding: 0 20px;
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            color: #666;
            flex-wrap: wrap;
        }

        .breadcrumb-link {
            color: #1DA1F2;
            text-decoration: none;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .breadcrumb-link:hover {
            text-decoration: underline;
        }

        .breadcrumb-current {
            background: transparent;
            color: #666;
            padding: 4px 0;
            border-radius: 0;
            font-weight: 600;
        }

        .breadcrumb-separator {
            color: #999;
            font-weight: normal;
        }

        /* Main Content */
        .main-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .page-title {
            font-size: 2rem;
            font-weight: 700;
            color: #333;
            margin: 30px 0 10px 0;
        }

        .page-description {
            font-size: 1.1rem;
            color: #666;
            margin-bottom: 20px;
        }

        /* Category Filters - Dinamis */
        .category-filters {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 20px;
        }

        .filter-btn {
            padding: 8px 16px;
            border: 1px solid #ddd;
            border-radius: 20px;
            background: white;
            color: #666;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s ease;
            white-space: nowrap;
        }

        .filter-btn.active {
            background: #1DA1F2;
            color: white;
            border-color: #1DA1F2;
        }

        .filter-btn:hover {
            border-color: #1DA1F2;
            color: #1DA1F2;
        }

        /* Action Bar */
        .action-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 25px;
        }

        .filter-controls {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .control-btn {
            display: flex;
            align-items: center;
            gap: 6px;
            padding: 8px 16px;
            border: 1px solid #ddd;
            border-radius: 6px;
            background: white;
            color: #666;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .control-btn:hover {
            border-color: #1DA1F2;
            color: #1DA1F2;
        }

        .control-btn.sort-btn {
            color: #1DA1F2;
            border-color: #1DA1F2;
        }

        .post-job-btn {
            background: #1DA1F2;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s ease;
            white-space: nowrap;
            text-decoration: none;
        }

        .post-job-btn:hover {
            background: #0d7ac9;
            transform: translateY(-1px);
            color: white;
        }

        /* Stats Bar */
        .stats-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 12px;
            color: #666;
            margin-bottom: 20px;
            flex-wrap: wrap;
            gap: 10px;
        }

        /* Job Cards Grid - Same styling */
        .job-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }

        .job-card {
            background: white;
            border: 1px solid #e9ecef;
            border-radius: 10px;
            overflow: hidden;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .job-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }

        .job-card-content {
            padding: 20px;
        }

        .freelancer-info {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 15px;
        }

        .freelancer-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            object-fit: cover;
        }

        .freelancer-name {
            font-weight: 600;
            font-size: 14px;
            color: #333;
        }

        .response-time {
            font-size: 12px;
            color: #999;
        }

        .job-image {
            width: 100%;
            height: 140px;
            object-fit: cover;
            border-radius: 6px;
            margin-bottom: 15px;
        }

        .job-title {
            font-weight: 600;
            font-size: 14px;
            color: #333;
            margin-bottom: 8px;
            line-height: 1.4;
        }

        .job-stats {
            font-size: 12px;
            color: #666;
            margin-bottom: 10px;
        }

        .rating {
            color: #ffc107;
        }

        .job-badges {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            margin-bottom: 15px;
        }

        .badge {
            font-size: 11px;
            padding: 4px 8px;
            border-radius: 12px;
            font-weight: 600;
        }

        .badge-urgent {
            background: #ffe6e6;
            color: #dc3545;
        }

        .badge-expert {
            background: #cce5ff;
            color: #0066cc;
        }

        .badge-flexible {
            background: #fff3cd;
            color: #856404;
        }

        .badge-rehire {
            background: #d1ecf1;
            color: #0c5460;
        }

        .job-price {
            text-align: right;
            color: #1DA1F2;
            font-weight: 700;
            font-size: 14px;
        }

        /* Empty State */
        .empty-state {
            grid-column: 1 / -1;
            text-align: center;
            padding: 60px 20px;
            color: #666;
            background: white;
            border-radius: 10px;
            margin-top: 20px;
        }

        .empty-state i {
            font-size: 48px;
            margin-bottom: 16px;
            opacity: 0.5;
            color: #1DA1F2;
        }

        .empty-state h3 {
            margin-bottom: 8px;
            font-size: 1.3rem;
            color: #333;
        }

        .empty-state p {
            font-size: 1rem;
            margin-bottom: 20px;
        }

        .empty-state-btn {
            background: #1DA1F2;
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 6px;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s ease;
        }

        .empty-state-btn:hover {
            background: #0d7ac9;
            transform: translateY(-1px);
            color: white;
        }

        /* Help Button - Same styling */
        .help-btn {
            position: fixed;
            right: 0;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(29, 161, 242, 0.1);
            color: #1DA1F2;
            padding: 15px 12px;
            border-top-left-radius: 20px;
            border-bottom-left-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-decoration: none;
            writing-mode: vertical-rl;
            text-orientation: mixed;
            z-index: 50;
            transition: all 0.3s ease;
        }

        .help-btn:hover {
            background: rgba(29, 161, 242, 0.2);
            color: #1DA1F2;
        }

        /* Same popup styling from original */
        .popup-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: rgba(0, 0, 0, 0.3);
            z-index: 1000;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .popup-overlay.show {
            opacity: 1;
            visibility: visible;
        }

        .popup-content {
            position: fixed;
            right: 20px;
            top: 55%;
            transform: translateY(-50%) translateX(100%);
            background: #fff;
            border-radius: 20px;
            width: 380px;
            max-height: 85vh;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
            transition: transform 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        .popup-overlay.show .popup-content {
            transform: translateY(-50%) translateX(0);
        }

        .popup-header {
            background: linear-gradient(135deg, #1DA1F2 0%, #0084d1 100%);
            color: white;
            padding: 20px;
            position: relative;
            text-align: center;
        }

        .popup-title {
            font-size: 18px;
            font-weight: 700;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .popup-subtitle {
            font-size: 12px;
            opacity: 0.9;
            margin-top: 5px;
        }

        .popup-close {
            position: absolute;
            top: 15px;
            right: 15px;
            background: rgba(255, 255, 255, 0.2);
            border: none;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            color: white;
            font-size: 16px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .popup-close:hover {
            background: rgba(255, 255, 255, 0.3);
        }

        .popup-body {
            padding: 20px;
            max-height: calc(85vh - 140px);
            overflow-y: auto;
        }

        .step {
            display: flex;
            align-items: flex-start;
            margin-bottom: 16px;
            padding: 12px;
            border-radius: 12px;
            background: #f8f9ff;
            border-left: 3px solid #1DA1F2;
            transition: all 0.3s ease;
        }

        .step:hover {
            background: #f0f7ff;
            transform: translateX(-3px);
        }

        .step-number {
            background: #1DA1F2;
            color: white;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 12px;
            margin-right: 12px;
            flex-shrink: 0;
        }

        .step-content {
            flex: 1;
        }

        .step-title {
            font-size: 14px;
            font-weight: 600;
            color: #333;
            margin-bottom: 4px;
        }

        .step-description {
            font-size: 12px;
            color: #666;
            line-height: 1.4;
        }

        .popup-footer {
            padding: 15px 20px;
            border-top: 1px solid #e9ecef;
            text-align: center;
            background: #f8f9fa;
        }

        .start-btn {
            background: linear-gradient(135deg, #1DA1F2 0%, #0084d1 100%);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 100%;
        }

        .start-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 8px 20px rgba(29, 161, 242, 0.3);
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .nav {
                padding: 0 15px;
            }

            .main-container {
                padding: 0 15px;
            }

            .job-grid {
                grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
                gap: 15px;
            }
        }

        @media (max-width: 768px) {
            .nav-container {
                top: 56px;
            }

            .nav {
                padding: 0 10px;
            }

            .nav-list {
                gap: 10px;
                padding: 6px 0;
                justify-content: flex-start;
            }

            .nav-item {
                padding: 8px 12px;
                min-height: 36px;
            }

            .nav-link {
                font-size: 14px;
            }

            .breadcrumb-container {
                padding: 0 10px;
            }

            .main-container {
                padding: 0 10px;
            }

            .page-title {
                font-size: 1.5rem;
                margin: 20px 0 15px 0;
            }

            .action-bar {
                flex-direction: column;
                align-items: stretch;
            }

            .filter-controls {
                order: 2;
            }

            .post-job-btn {
                order: 1;
            }

            .job-grid {
                grid-template-columns: 1fr;
            }

            .popup-content {
                width: 95%;
                max-height: 95vh;
            }
        }
    </style>
</head>
<body>
    <!-- Category Navigation -->
    <div class="nav-container">
        <nav class="nav">
            <ul class="nav-list">
                <li class="nav-item {{ request()->is('popular*') ? 'active' : '' }}">
                    <a href="/popular" class="nav-link">Pekerjaan Populer</a>
                </li>
                <li class="nav-item {{ request()->is('grafis*') ? 'active' : '' }}">
                    <a href="/grafis" class="nav-link">Grafis & Desain</a>
                </li>
                <li class="nav-item {{ request()->is('dokumen*') ? 'active' : '' }}">
                    <a href="/dokumen" class="nav-link">Dokumen & PPT</a>
                </li>
                <li class="nav-item {{ request()->is('web*') ? 'active' : '' }}">
                    <a href="/web" class="nav-link">Web & App</a>
                </li>
                <li class="nav-item {{ request()->is('video*') ? 'active' : '' }}">
                    <a href="/video" class="nav-link">Video Editing</a>
                </li>
            </ul>
        </nav>
    </div>

    <!-- Breadcrumb -->
    <div class="breadcrumb">
        <div class="breadcrumb-container">
            <a href="#" class="breadcrumb-link">Semua Kategori</a>
            <span class="breadcrumb-separator">›</span>
            <a href="#" class="breadcrumb-link">{{ $categoryConfig['parent'] ?? 'Pekerjaan Popular' }}</a>
            <span class="breadcrumb-separator">›</span>
            <span class="breadcrumb-current">{{ $categoryConfig['breadcrumb'] ?? 'Web Development' }}</span>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-container">
        <!-- Page Title & Description -->
        <h1 class="page-title">{{ $categoryConfig['title'] ?? 'Jasa Pembuatan Website Terbaik dan Profesional' }}</h1>
        @if(isset($categoryConfig['description']))
            <p class="page-description">{{ $categoryConfig['description'] }}</p>
        @endif

        <!-- Category Filters - Dinamis berdasarkan subcategory -->
        <div class="category-filters">
            @if(isset($categoryConfig['filters']) && is_array($categoryConfig['filters']))
                @foreach($categoryConfig['filters'] as $index => $filter)
                    <button class="filter-btn {{ $index === 0 ? 'active' : '' }}" data-filter="{{ strtolower($filter) }}">
                        {{ $filter }}
                    </button>
                @endforeach
            @else
                <button class="filter-btn active">semua</button>
                <button class="filter-btn">WordPress</button>
                <button class="filter-btn">Blog</button>
                <button class="filter-btn">eCommerce</button>
            @endif
        </div>

        <!-- Action Bar -->
        <div class="action-bar">
            <div class="filter-controls">
                <button class="control-btn">
                    <i class="fas fa-filter"></i>
                    Cari
                </button>
                <button class="control-btn sort-btn">
                    <i class="fas fa-sort-amount-up"></i>
                    Urutkan berdasarkan
                </button>
            </div>
            @if(Auth::check() && Auth::user()->role === 'client')
                <a href="/posting" class="post-job-btn">
                    Posting Proyek
                </a>
            @endif
        </div>

        <!-- Stats Bar -->
        <div class="stats-bar">
            <div>Pekerjaan yang ditemukan {{ $totalProjects ?? 0 }} Item</div>
            <div>Halaman 1 Dari {{ ceil(($totalProjects ?? 0) / 40) }}</div>
        </div>

        <!-- Job Cards Grid -->
        <div class="job-grid">
            @forelse($projects as $project)
                <!-- Card -->
                <article class="job-card">
                    <div class="job-card-content">
                        <a href="{{ url('/projects/'.$project->id) }}" class="job-link">
                            <div class="freelancer-info">
                                <img src="{{ $project->user->avatar ?? 'https://ui-avatars.com/api/?name='.urlencode($project->user->name ?? 'User').'&background=random' }}" 
                                     alt="{{ $project->user->name ?? 'User' }}" class="freelancer-avatar">
                                <div>
                                    <div class="freelancer-name">
                                        {{ $project->user->name ?? 'Anonim' }}
                                    </div>
                                    <div class="response-time">
                                        {{ $project->posted_at ? $project->posted_at->diffForHumans() : 'Belum diposting' }}
                                    </div>
                                </div>
                            </div>

                            <!-- Enhanced media display with video support -->
                            @if(!empty($project->attachments))
                                @php
                                    $mainAttachment = $project->main_attachment;
                                @endphp
                                
                                @if($mainAttachment)
                                    @if($mainAttachment['file_type'] === 'image')
                                        <img src="{{ $mainAttachment['url'] }}" 
                                             alt="{{ $project->title }}" 
                                             class="job-image"
                                             onerror="this.style.display='none'">
                                    @elseif($mainAttachment['file_type'] === 'video')
                                        <div style="position: relative; width: 100%; height: 140px; border-radius: 6px; overflow: hidden; margin-bottom: 15px; background: #f8f9fa;">
                                            <video class="job-image" style="width: 100%; height: 100%; object-fit: cover;" muted>
                                                <source src="{{ $mainAttachment['url'] }}" type="{{ $mainAttachment['mime_type'] ?? 'video/mp4' }}">
                                                Your browser does not support the video tag.
                                            </video>
                                            <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background: rgba(0,0,0,0.7); border-radius: 50%; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; color: white;">
                                                <i class="fas fa-play" style="font-size: 14px; margin-left: 2px;"></i>
                                            </div>
                                            <div style="position: absolute; top: 8px; left: 8px; background: rgba(239, 68, 68, 0.9); color: white; padding: 2px 6px; border-radius: 8px; font-size: 10px; font-weight: 600;">
                                                VIDEO
                                            </div>
                                        </div>
                                    @elseif($mainAttachment['file_type'] === 'document')
                                        <div style="position: relative; width: 100%; height: 140px; background: #f8f9fa; border-radius: 6px; margin-bottom: 15px; display: flex; flex-direction: column; align-items: center; justify-content: center; border: 2px dashed #e1e8ed;">
                                            @if(str_contains(strtolower($mainAttachment['extension'] ?? ''), 'pdf'))
                                                <i class="fas fa-file-pdf" style="font-size: 32px; color: #dc3545; margin-bottom: 8px;"></i>
                                            @elseif(str_contains(strtolower($mainAttachment['extension'] ?? ''), 'doc'))
                                                <i class="fas fa-file-word" style="font-size: 32px; color: #0066cc; margin-bottom: 8px;"></i>
                                            @elseif(str_contains(strtolower($mainAttachment['extension'] ?? ''), 'xls'))
                                                <i class="fas fa-file-excel" style="font-size: 32px; color: #107c41; margin-bottom: 8px;"></i>
                                            @elseif(str_contains(strtolower($mainAttachment['extension'] ?? ''), 'ppt'))
                                                <i class="fas fa-file-powerpoint" style="font-size: 32px; color: #d24726; margin-bottom: 8px;"></i>
                                            @elseif(str_contains(strtolower($mainAttachment['extension'] ?? ''), 'txt'))
                                                <i class="fas fa-file-alt" style="font-size: 32px; color: #6c757d; margin-bottom: 8px;"></i>
                                            @elseif(str_contains(strtolower($mainAttachment['extension'] ?? ''), 'zip') || str_contains(strtolower($mainAttachment['extension'] ?? ''), 'rar'))
                                                <i class="fas fa-file-archive" style="font-size: 32px; color: #fd7e14; margin-bottom: 8px;"></i>
                                            @else
                                                <i class="fas fa-file" style="font-size: 32px; color: #6c757d; margin-bottom: 8px;"></i>
                                            @endif
                                            
                                            <div style="font-size: 11px; color: #6c757d; text-align: center; font-weight: 600; max-width: 90%; word-break: break-word;">
                                                {{ strtoupper($mainAttachment['extension'] ?? 'FILE') }} DOCUMENT
                                            </div>
                                            
                                            @if(isset($mainAttachment['size']))
                                                <div style="font-size: 10px; color: #9ca3af; margin-top: 2px;">
                                                    {{ number_format($mainAttachment['size'] / 1024, 0) }} KB
                                                </div>
                                            @endif
                                            
                                            <!-- Document type badge -->
                                            <div style="position: absolute; top: 8px; left: 8px; background: rgba(59, 130, 246, 0.9); color: white; padding: 2px 6px; border-radius: 8px; font-size: 10px; font-weight: 600;">
                                                DOC
                                            </div>
                                            
                                            <!-- Download hint overlay -->
                                            <div style="position: absolute; bottom: 8px; right: 8px; background: rgba(0,0,0,0.7); color: white; border-radius: 4px; padding: 4px 6px; font-size: 10px; display: flex; align-items: center; gap: 3px;">
                                                <i class="fas fa-download" style="font-size: 8px;"></i>
                                                <span>Klik untuk unduh</span>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                            @elseif($project->hasImage())
                                <!-- Fallback for old image system -->
                                <img src="{{ $project->image_url }}" 
                                     alt="{{ $project->title }}" 
                                     class="job-image"
                                     onerror="this.style.display='none'">
                            @endif

                            <h3 class="job-title">{{ Str::limit($project->title, 60) }}</h3>
                            
                            <p class="job-stats">
                                <i class="fas fa-star rating"></i>
                                {{ $project->budget_type === 'fixed' ? 'Budget Tersedia' : 'Budget Fleksibel' }} 
                                {{ ucfirst($project->experience_level) }} 
                            </p>

                            <div class="job-badges">
                                @if($project->urgency === 'urgent')
                                    <span class="badge badge-urgent">Segera</span>
                                @elseif($project->urgency === 'asap')
                                    <span class="badge badge-urgent">Sangat Mendesak</span>
                                @endif
                                
                                
                                <span class="badge badge-flexible">
                                    {{ $project->budget_type === 'fixed' ? 'Fixed Budget' : 
                                       ($project->budget_type === 'hourly' ? 'Per Jam' : 'Budget Range') }}
                                </span>
                                
                                @if($project->project_type === 'ongoing')
                                    <span class="badge badge-rehire">Berkelanjutan</span>
                                @endif
                            </div>

                            <p class="job-price">
                                Mulai<br>{{ $project->formatted_budget }}
                            </p>
                        </a>
                    </div>
                </article>
            @empty
                <!-- Empty state -->
                <div class="empty-state">
                    <i class="fas fa-briefcase"></i>
                    <h3>Belum ada proyek {{ $categoryConfig['name'] ?? 'Web Development' }} tersedia</h3>
                    <p>Saat ini belum ada proyek di kategori {{ $categoryConfig['name'] ?? 'Web Development' }}. Coba cek lagi nanti atau posting proyek Anda sendiri!</p>
                    @if(Auth::check() && Auth::user()->role === 'client')
                        <a href="/posting" class="empty-state-btn">Posting Proyek Pertama</a>
                    @endif
                </div>
            @endforelse
        </div>
    </div>

    <!-- Help Button -->
    @if(Auth::check() && Auth::user()->role === 'client')
    <a href="#" class="help-btn">? Cara memperkerjakan</a>
    @endif

    <!-- Help Popup - Same as original -->
    <div id="helpPopup" class="popup-overlay">
        <div class="popup-content">
            <div class="popup-header">
                <button class="popup-close" onclick="closePopup()">×</button>
                <h2 class="popup-title">Cara Mempekerjakan Freelancer</h2>
                <p class="popup-subtitle">Ikuti langkah-langkah mudah untuk mendapatkan freelancer terbaik</p>
            </div>
            
            <div class="popup-body">
                <div class="step">
                    <div class="step-number">1</div>
                    <div class="step-content">
                        <div class="step-title">Posting Pekerjaan</div>
                        <div class="step-description">Klik tombol biru "Posting lowongan pekerjaan Anda" untuk membuat proyek baru dan menjelaskan kebutuhan Anda dengan detail.</div>
                    </div>
                </div>

                <div class="step">
                    <div class="step-number">2</div>
                    <div class="step-content">
                        <div class="step-title">Tunggu Pengajuan Freelancer</div>
                        <div class="step-description">Freelancer yang tertarik akan mengajukan diri untuk mengerjakan job Anda dengan proposal dan penawaran harga mereka.</div>
                    </div>
                </div>

                <div class="step">
                    <div class="step-number">3</div>
                    <div class="step-content">
                        <div class="step-title">Seleksi Freelancer</div>
                        <div class="step-description">Tinjau profil, portfolio, rating, dan ulasan dari freelancer. Pilih yang paling sesuai dengan kebutuhan proyek Anda.</div>
                    </div>
                </div>

                <div class="step">
                    <div class="step-number">4</div>
                    <div class="step-content">
                        <div class="step-title">ACC Pengajuan</div>
                        <div class="step-description">Setelah memilih freelancer terbaik, klik tombol ACC untuk menerima pengajuan dan memulai kerjasama.</div>
                    </div>
                </div>

                <div class="step">
                    <div class="step-number">5</div>
                    <div class="step-content">
                        <div class="step-title">Transfer Dana ke Saldo Website</div>
                        <div class="step-description">Transfer pembayaran ke saldo dalam website sebagai jaminan. Dana akan otomatis diberikan ke freelancer setelah pekerjaan selesai dan Anda menyetujuinya.</div>
                    </div>
                </div>
            </div>
            
            <div class="popup-footer">
                <button class="start-btn" onclick="closePopup()">Mulai Posting Pekerjaan</button>
            </div>
        </div>
    </div>

    <script>
        // Navigation functionality
        document.querySelectorAll('.nav-item').forEach(item => {
            item.addEventListener('click', function() {
                document.querySelectorAll('.nav-item').forEach(nav => nav.classList.remove('active'));
                this.classList.add('active');
            });
        });

        // Filter button functionality
        document.querySelectorAll('.filter-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                
                // Here you can add filtering logic based on data-filter attribute
                const filter = this.getAttribute('data-filter');
                console.log('Filtering by:', filter);
            });
        });

        // Control buttons
        document.querySelectorAll('.control-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                console.log('Control button clicked:', this.textContent.trim());
            });
        });

        // Popup functionality
        function showPopup() {
            const popup = document.getElementById('helpPopup');
            popup.classList.add('show');
            document.body.style.overflow = 'hidden';
        }

        function closePopup() {
            const popup = document.getElementById('helpPopup');
            popup.classList.remove('show');
            document.body.style.overflow = '';
        }

        // Show popup when help button is clicked
        if (document.querySelector('.help-btn')) {
            document.querySelector('.help-btn').addEventListener('click', function (e) {
                e.preventDefault();
                showPopup();
            });
        }

        // Close popup when clicking outside content
        document.getElementById('helpPopup').addEventListener('click', function(e) {
            if (e.target === this) {
                closePopup();
            }
        });

        // Close popup with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closePopup();
            }
        });
    </script>
</body>
</html>
@endsection