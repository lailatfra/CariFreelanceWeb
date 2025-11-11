@extends('client.layout.client-layout')
@section('title', $project->title . ' - CariFreelance')
@section('content')
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $project->title }} - CariFreelance</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />

    <!-- Add enhanced CSS for multi-file support -->
    <style>
        /* Enhanced File Gallery Styles */
        .file-gallery {
            background: white;
            border-radius: 12px;
            padding: 24px;
            margin-bottom: 24px;
            border: 1px solid #e1e8ed;
        }

        .file-gallery-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .file-gallery-title {
            font-size: 18px;
            font-weight: 700;
            color: #1a1a1a;
        }

        .file-count {
            font-size: 14px;
            color: #6b7280;
            background: #f3f4f6;
            padding: 4px 12px;
            border-radius: 12px;
        }

        .main-file-container {
            position: relative;
            margin-bottom: 16px;
            border-radius: 8px;
            overflow: hidden;
            background: #f8f9fa;
        }

        .main-file {
            width: 100%;
            height: 320px;
            object-fit: cover;
            display: block;
        }

        .file-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(29, 155, 240, 0.1) 0%, rgba(0, 0, 0, 0.1) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .main-file-container:hover .file-overlay {
            opacity: 1;
        }

        .file-type-badge {
            position: absolute;
            top: 16px;
            left: 16px;
            background: rgba(0, 0, 0, 0.8);
            color: white;
            padding: 6px 12px;
            border-radius: 16px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .file-type-badge.image {
            background: rgba(34, 197, 94, 0.9);
        }

        .file-type-badge.video {
            background: rgba(239, 68, 68, 0.9);
        }

        .file-type-badge.document {
            background: rgba(59, 130, 246, 0.9);
        }

        .thumbnail-gallery {
            display: flex;
            gap: 12px;
            overflow-x: auto;
            padding: 8px 0;
            scrollbar-width: thin;
        }

        .thumbnail-gallery::-webkit-scrollbar {
            height: 4px;
        }

        .thumbnail-gallery::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 2px;
        }

        .thumbnail-gallery::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 2px;
        }

        .file-thumbnail {
            position: relative;
            width: 80px;
            height: 60px;
            border-radius: 6px;
            cursor: pointer;
            opacity: 0.7;
            transition: all 0.2s ease;
            flex-shrink: 0;
            border: 2px solid transparent;
            overflow: hidden;
        }

        .file-thumbnail.active,
        .file-thumbnail:hover {
            opacity: 1;
            border-color: #1d9bf0;
            transform: scale(1.05);
        }

        .thumbnail-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .thumbnail-icon {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f3f4f6;
            color: #6b7280;
            font-size: 24px;
        }

        .thumbnail-type {
            position: absolute;
            bottom: 2px;
            right: 2px;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 8px;
            color: white;
            font-weight: bold;
        }

        .thumbnail-type.image {
            background: #22c55e;
        }

        .thumbnail-type.video {
            background: #ef4444;
        }

        .thumbnail-type.document {
            background: #3b82f6;
        }

        /* Document Viewer */
        .document-viewer {
            width: 100%;
            height: 320px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f8f9fa;
            border-radius: 8px;
            flex-direction: column;
            gap: 16px;
        }

        .document-icon {
            font-size: 64px;
            color: #3b82f6;
            margin-bottom: 8px;
        }

        .document-name {
            font-weight: 600;
            color: #1a1a1a;
            text-align: center;
            word-break: break-word;
            max-width: 200px;
        }

        .document-size {
            font-size: 14px;
            color: #6b7280;
        }

        .download-btn {
            background: #1d9bf0;
            color: white;
            padding: 8px 16px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .download-btn:hover {
            background: #1e40af;
            transform: translateY(-1px);
        }

        /* Video Player */
        .video-player {
            width: 100%;
            height: 320px;
            border-radius: 8px;
            overflow: hidden;
        }

        .video-player video {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* No Files State */
        .no-files-state {
            text-align: center;
            padding: 60px 20px;
            color: #6b7280;
        }

        .no-files-icon {
            font-size: 48px;
            margin-bottom: 16px;
            opacity: 0.5;
        }

        /* File Actions */
        .file-actions {
            position: absolute;
            top: 16px;
            right: 16px;
            display: flex;
            gap: 8px;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .main-file-container:hover .file-actions {
            opacity: 1;
        }

        .file-action-btn {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: rgba(0, 0, 0, 0.7);
            color: white;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
        }

        .file-action-btn:hover {
            background: rgba(0, 0, 0, 0.9);
            transform: scale(1.1);
        }

        /* Enhanced existing styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            line-height: 1.6;
            color: #1a1a1a;
            background-color: #fafbfc;
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


        .breadcrumb-container {
            max-width: 1400px;
            margin: 0;
            margin-left: 40px;
            padding: 0 20px;
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            color: #666;
            flex-wrap: wrap;
            padding-top: 25px;
        }

        .breadcrumb-link {
            color: #1d9bf0;
            text-decoration: none;
            font-weight: 500;
        }

        .breadcrumb-separator {
            color: #9ca3af;
        }

        .breadcrumb-current {
            color: #6b7280;
            font-weight: 500;
        }

        /* Main Container */
        .main-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 32px 24px;
            display: grid;
            grid-template-columns: 1fr 320px;
            gap: 32px;
        }

        /* Content Section */
        .content-section {
            min-width: 0;
        }

        /* Job Header */
        .job-header {
            background: white;
            border-radius: 12px;
            padding: 32px;
            margin-bottom: 24px;
            border: 1px solid #e1e8ed;
        }

        .job-title {
            font-size: 28px;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 16px;
            line-height: 1.3;
        }

        .job-meta {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .meta-item {
            font-size: 14px;
            color: #6b7280;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .badge-urgent {
            background: #fef2f2;
            color: #dc2626;
        }

        .badge-expert {
            background: #f0f9ff;
            color: #0284c7;
        }

        .badge-flexible {
            background: #fefce8;
            color: #ca8a04;
        }

        /* Sidebar styles */
        .sidebar {
            position: sticky;
            top: 120px;
            height: fit-content;
        }

        .sidebar-card {
            background: white;
            border: 1px solid #e1e8ed;
            border-radius: 12px;
            overflow: hidden;
        }

        .budget-header {
            background: linear-gradient(135deg, #edffe4ff 0%, #e4fee0ff 100%);
            padding: 20px;
            text-align: center;
            border-bottom: 1px solid #e2e8f0;
        }

        .budget-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #2a9121ff 0%, #3da353ff 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 12px;
            color: white;
            font-size: 16px;
            box-shadow: 0 2px 8px rgba(27, 189, 100, 0.2);
        }

        .budget-title {
            font-size: 16px;
            font-weight: 600;
            color: #27a532ff;
            margin-bottom: 6px;
        }

        .budget-description {
            font-size: 12px;
            color: #22ac57ff;
            line-height: 1.4;
            opacity: 0.8;
        }

        .budget-details {
            padding: 20px;
        }

        .budget-amount {
            text-align: center;
            margin-bottom: 20px;
            padding: 16px;
            background: #f8fafc;
            border-radius: 10px;
            border: 1px solid #e2e8f0;
        }

        .budget-label {
            font-size: 12px;
            color: #64748b;
            margin-bottom: 6px;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .budget-price {
            font-size: 24px;
            font-weight: 700;
            color: #187abbff;
        }

        .deadline-info {
            display: flex;
            align-items: center;
            gap: 8px;
            background: #f1f5f9;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            color: #475569;
            font-weight: 500;
            font-size: 13px;
        }

        .deadline-info i {
            font-size: 14px;
            color: #64748b;
        }

        .action-icons {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .action-icon {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 12px;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            color: #64748b;
            font-weight: 500;
            font-size: 13px;
        }

        .action-icon i {
            font-size: 14px;
            width: 16px;
            text-align: center;
        }

        .action-icon:hover {
            background: #f1f5f9;
            color: #3b82f6;
            transform: translateX(2px);
        }

        .btn-apply {
            width: 100%;
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin-top: 16px;
            box-shadow: 0 2px 8px rgba(59, 130, 246, 0.2);
        }

        .btn-apply i {
            font-size: 13px;
        }

        .btn-apply:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }

        /* Tabs */
        .tabs {
            background: white;
            border-radius: 12px;
            border: 1px solid #e1e8ed;
            margin-bottom: 24px;
            overflow: hidden;
        }

        .tab-list {
            display: flex;
            border-bottom: 1px solid #e1e8ed;
        }

        .tab {
            flex: 1;
            padding: 16px 24px;
            text-align: center;
            cursor: pointer;
            font-weight: 600;
            color: #6b7280;
            transition: all 0.2s ease;
            border-bottom: 2px solid transparent;
        }

        .tab.active {
            color: #1d9bf0;
            border-bottom-color: #1d9bf0;
            background: rgba(29, 155, 240, 0.05);
        }

        .tab-content {
            padding: 32px;
        }

        .section-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 20px;
        }

        .section-header h3 {
            font-size: 20px;
            font-weight: 700;
            color: #1a1a1a;
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .main-container {
                grid-template-columns: 1fr;
                padding: 24px 16px;
            }

            .sidebar {
                position: static;
            }
        }

        @media (max-width: 768px) {
            .main-file {
                height: 240px;
            }

            .file-gallery {
                padding: 16px;
            }

            .job-header,
            .tab-content {
                padding: 24px;
            }

            .job-title {
                font-size: 24px;
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
            <a href="/home" class="breadcrumb-link">Semua Kategori</a>
            <span class="breadcrumb-separator">›</span>
            <a href="/popular" class="breadcrumb-link">Pekerjaan Popular</a>
            <span class="breadcrumb-separator">›</span>
            <a href="/web">
                <span class="breadcrumb-current">{{ $project->category }}</span>
            </a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-container">
        <!-- Content Section -->
        <div class="content-section">
            <!-- Job Header -->
            <div class="job-header">
                <h1 class="job-title">{{ $project->title }}</h1>
                <div class="job-meta">
                    <div class="meta-item">
                        <i class="fas fa-clock"></i>
                        <span>{{ $project->posted_at ? $project->posted_at->diffForHumans() : '-' }}</span>
                    </div>
                    <div class="badge badge-urgent">
                        <i class="fas fa-exclamation-circle"></i>
                        <span>{{ $project->urgency_text }}</span>
                    </div>
                    <div class="badge badge-expert">{{ ucfirst($project->experience_level) }} Level</div>
                    <div class="badge badge-flexible">
                        {{ $project->budget_type === 'range' ? 'Budget Fleksibel' : 'Budget Tersedia' }}
                    </div>
                </div>
            </div>

            <!-- Enhanced File Gallery -->
            @if(!empty($project->attachments))
            <div class="file-gallery">
                <div class="file-gallery-header">
                    <h3 class="file-gallery-title">File Proyek</h3>
                    <div class="file-count">
                        {{ count($project->attachments) }} file
                        @if($project->attachment_info)
                        ({{ $project->attachment_info['description'] }} - {{ $project->attachment_info['size'] }})
                        @endif
                    </div>
                </div>

                <!-- Main File Display -->
                <div class="main-file-container" id="mainFileContainer">
                    @php
                    $mainAttachment = $project->main_attachment;
                    $allAttachments = $project->getAttachmentsByType();
                    @endphp

                    @if($mainAttachment)
                    @if($mainAttachment['file_type'] === 'image')
                    <img src="{{ $mainAttachment['url'] }}" alt="{{ $mainAttachment['original_name'] }}" class="main-file" id="mainFile">
                    <div class="file-type-badge image">Gambar</div>
                    @elseif($mainAttachment['file_type'] === 'video')
                    <div class="video-player">
                        <video controls class="main-file" id="mainFile">
                            <source src="{{ $mainAttachment['url'] }}" type="{{ $mainAttachment['mime_type'] }}">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                    <div class="file-type-badge video">Video</div>
                    @elseif($mainAttachment['file_type'] === 'document')
                    <div class="document-viewer">
                        <i class="fas fa-file-pdf document-icon"></i>
                        <div class="document-name">{{ $mainAttachment['original_name'] }}</div>
                        <div class="document-size">{{ number_format($mainAttachment['size'] / 1024, 0) }} KB</div>
                        <a href="{{ $mainAttachment['url'] }}" class="download-btn" target="_blank">
                            <i class="fas fa-download"></i> Download
                        </a>
                    </div>
                    <div class="file-type-badge document">Dokumen</div>
                    @endif

                    <!-- File Actions -->
                    <div class="file-actions">
                        @if($mainAttachment['file_type'] === 'image')
                        <button class="file-action-btn" onclick="openFullscreen('{{ $mainAttachment['url'] }}')">
                            <i class="fas fa-expand"></i>
                        </button>
                        @endif
                        <button class="file-action-btn" onclick="downloadFile('{{ $mainAttachment['url'] }}', '{{ $mainAttachment['original_name'] }}')">
                            <i class="fas fa-download"></i>
                        </button>
                    </div>
                    @endif

                    <div class="file-overlay">
                        <div style="text-align: center; color: white;">
                            <i class="fas fa-eye" style="font-size: 24px; margin-bottom: 8px;"></i>
                            <div>Klik untuk melihat detail</div>
                        </div>
                    </div>
                </div>

                <!-- Thumbnail Gallery -->
                @if(count($allAttachments) > 1)
                <div class="thumbnail-gallery">
                    @foreach($allAttachments as $index => $attachment)
                    <div class="file-thumbnail {{ $index === 0 ? 'active' : '' }}" onclick="switchMainFile({{ $index }}, '{{ $attachment['file_type'] }}', '{{ $attachment['url'] }}', '{{ $attachment['original_name'] }}', {{ $attachment['size'] }}, '{{ $attachment['mime_type'] ?? '' }}')">
                        @if($attachment['file_type'] === 'image')
                        <img src="{{ $attachment['url'] }}" alt="{{ $attachment['original_name'] }}" class="thumbnail-image">
                        @elseif($attachment['file_type'] === 'video')
                        <div class="thumbnail-icon">
                            <i class="fas fa-play-circle"></i>
                        </div>
                        @elseif($attachment['file_type'] === 'document')
                        <div class="thumbnail-icon">
                            @if(str_contains($attachment['extension'], 'pdf'))
                            <i class="fas fa-file-pdf"></i>
                            @elseif(str_contains($attachment['extension'], 'doc'))
                            <i class="fas fa-file-word"></i>
                            @else
                            <i class="fas fa-file"></i>
                            @endif
                        </div>
                        @endif
                        <div class="thumbnail-type {{ $attachment['file_type'] }}">
                            @if($attachment['file_type'] === 'image')
                            <i class="fas fa-image"></i>
                            @elseif($attachment['file_type'] === 'video')
                            <i class="fas fa-video"></i>
                            @elseif($attachment['file_type'] === 'document')
                            <i class="fas fa-file"></i>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
            @else
            <div class="file-gallery">
                <div class="no-files-state">
                    <i class="fas fa-folder-open no-files-icon"></i>
                    <h3>Tidak ada file lampiran</h3>
                    <p>Proyek ini tidak menyertakan file tambahan</p>
                </div>
            </div>
            @endif

            <!-- Tabs -->
            <div class="tabs">
                <div class="tab-list">
                    <div class="tab active">Deskripsi Proyek</div>
                </div>

                <div class="tab-content">
                    <div class="project-intro">
                        <h2>{{ $project->title }}</h2>
                        <p>{{ $project->description }}</p>
                    </div>

                    <!-- Project Description -->
                    <div class="content-section-block">
                        <div class="section-header">
                            <i class="fas fa-info-circle"></i>
                            <h3>Detail Kebutuhan Proyek</h3>
                        </div>
                        <div style="background: #f8f9ff; border: 1px solid #e1e8ed; border-radius: 12px; padding: 24px; margin-bottom: 24px;">
                            <p>{!! nl2br(e($project->requirements)) !!}</p>
                        </div>
                    </div>

                    <!-- Deliverables -->
                    <div class="workflow-section">
                        <div class="section-header">
                            <i class="fas fa-tasks"></i>
                            <h3>Hasil Yang Diharapkan</h3>
                        </div>
                        <div class="workflow-steps">
                            <p>{!! nl2br(e($project->deliverables)) !!}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="sidebar">
            <div class="sidebar-card">
                <div class="budget-header">
                    <div class="budget-icon">
                        <i class="fas fa-wallet"></i>
                    </div>
                    <div class="budget-title">Budget Tersedia</div>
                    <div class="budget-description">Client sudah menyiapkan budget untuk project ini</div>
                </div>

                <div class="budget-details">
                    <div class="budget-amount">
                        <div class="budget-label">Budget</div>
                        <div class="budget-price">{{ $project->formatted_budget }}</div>
                    </div>

                    <div class="deadline-info">
                        <i class="fas fa-calendar-alt"></i>
                        Timeline: {{ $project->deadline }}
                    </div>

                    <div class="action-icons">
                        <div class="action-icon">
                            <i class="far fa-bookmark"></i>
                            <span>Simpan</span>
                        </div>
                        <div class="action-icon">
                            <i class="fas fa-share-alt"></i>
                            <span>Bagikan</span>
                        </div>
                        <div class="action-icon">
                            <i class="fas fa-flag"></i>
                            <span>Laporkan</span>
                        </div>
                        <!-- Apply Button - Main CTA -->
                        @if(Auth::check() && Auth::user()->role === 'freelancer')
                            @php
                                // cek apakah user sudah pernah buat proposal untuk project ini
                                $sudahAjukan = \App\Models\Proposal::where('project_id', $project->id)
                                    ->where('user_id', Auth::id())
                                    ->exists();
                            @endphp

                            @if(!$sudahAjukan)
                                <a href="{{ route('proposal.create', ['project' => $project->id]) }}">
                                    <button class="btn-apply">
                                        <i class="fas fa-paper-plane"></i> Ajukan Proposal
                                    </button>
                                </a>
                            @endif
                        @endif


                    </div>
                </div>
            </div>

            <!-- Additional Info Card -->
            <div class="sidebar-card" style="margin-top: 20px;">
                <div style="padding: 24px;">
                    <h3 style="font-size: 18px; font-weight: 700; color: #1a1a1a; margin-bottom: 16px;">Info Tambahan</h3>

                    <div style="margin-bottom: 16px;">
                        <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
                            <span style="color: #6b7280; font-size: 14px;">Kategori</span>
                            <span style="color: #1a1a1a; font-weight: 500; font-size: 14px;">{{ $project->category }}</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
                            <span style="color: #6b7280; font-size: 14px;">Durasi</span>
                            <span style="color: #1a1a1a; font-weight: 500; font-size: 14px;">{{ $project->timeline_duration }}</span>
                        </div>
                        <div style="display: flex; justify-content: space-between;">
                            <span style="color: #6b7280; font-size: 14px;">Lokasi</span>
                            <span style="color: #1a1a1a; font-weight: 500; font-size: 14px;">Malang</span>
                        </div>
                    </div>

                    {{-- Skills --}}
                    @if(!empty($project->skills_required))
                    <div style="margin-top: 16px;">
                        <span style="color: #6b7280; font-size: 14px; display: block; margin-bottom: 8px;">Skills Required:</span>
                        <div style="display: flex; flex-wrap: wrap; gap: 6px;">
                            @foreach($project->skills_required as $skill)
                            <span style="background: #f3f4f6; color: #374151; padding: 4px 8px; border-radius: 12px; font-size: 12px;">{{ $skill }}</span>
                            @endforeach
                        </div>
                    </div>
                    @else
                    <div style="margin-top: 16px;">
                        <span style="color: #6b7280; font-size: 14px;">Tidak ada skill khusus diperlukan</span>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        // File switching functionality
        let currentAttachments = @json($allAttachments ?? []);

        function switchMainFile(index, fileType, url, originalName, size, mimeType = '') {
            // Remove active class from all thumbnails
            document.querySelectorAll('.file-thumbnail').forEach(thumb => {
                thumb.classList.remove('active');
            });

            // Add active class to clicked thumbnail
            document.querySelectorAll('.file-thumbnail')[index].classList.add('active');

            const mainContainer = document.getElementById('mainFileContainer');
            const badge = mainContainer.querySelector('.file-type-badge');

            // Clear current content
            const existingFile = mainContainer.querySelector('.main-file, .video-player, .document-viewer');
            if (existingFile) {
                existingFile.remove();
            }

            // Create new content based on file type
            if (fileType === 'image') {
                const img = document.createElement('img');
                img.src = url;
                img.alt = originalName;
                img.className = 'main-file';
                img.id = 'mainFile';
                mainContainer.insertBefore(img, mainContainer.firstChild);
                badge.textContent = 'Gambar';
                badge.className = 'file-type-badge image';

            } else if (fileType === 'video') {
                const videoContainer = document.createElement('div');
                videoContainer.className = 'video-player';
                const video = document.createElement('video');
                video.controls = true;
                video.className = 'main-file';
                video.id = 'mainFile';
                const source = document.createElement('source');
                source.src = url;
                source.type = mimeType;
                video.appendChild(source);
                videoContainer.appendChild(video);
                mainContainer.insertBefore(videoContainer, mainContainer.firstChild);
                badge.textContent = 'Video';
                badge.className = 'file-type-badge video';

            } else if (fileType === 'document') {
                const docViewer = document.createElement('div');
                docViewer.className = 'document-viewer';
                docViewer.innerHTML = `
                    <i class="fas fa-file-pdf document-icon"></i>
                    <div class="document-name">${originalName}</div>
                    <div class="document-size">${Math.round(size / 1024)} KB</div>
                    <a href="${url}" class="download-btn" target="_blank">
                        <i class="fas fa-download"></i> Download
                    </a>
                `;
                mainContainer.insertBefore(docViewer, mainContainer.firstChild);
                badge.textContent = 'Dokumen';
                badge.className = 'file-type-badge document';
            }
        }

        // File actions
        function openFullscreen(imageUrl) {
            const modal = document.createElement('div');
            modal.style.cssText = `
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.9);
                display: flex;
                align-items: center;
                justify-content: center;
                z-index: 9999;
                cursor: pointer;
            `;

            const img = document.createElement('img');
            img.src = imageUrl;
            img.style.maxWidth = '90%';
            img.style.maxHeight = '90%';
            img.style.objectFit = 'contain';

            modal.appendChild(img);
            document.body.appendChild(modal);

            modal.onclick = () => {
                document.body.removeChild(modal);
            };
        }

        function downloadFile(url, filename) {
            const link = document.createElement('a');
            link.href = url;
            link.download = filename;
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }

        // Initialize page
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Enhanced job detail page loaded');
        });
    </script>
</body>

</html>
@endsection