@extends('client.layout.client-layout')
@section('title', 'Profil Freelancer - CariFreelance')
@section('content')
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $proposal->user->name }} - Freelancer Profile</title>
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        
        .container1 {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        
        .header {
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 24px;
            margin-bottom: 24px;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.06);
        }
        
        .profile-section {
            display: flex;
            align-items: center;
            gap: 24px;
            margin-bottom: 16px;
        }
        
        .profile-avatar {
            width: 100px;
            height: 100px;
            border-radius: 8px;
            background: #1d4ed8;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 36px;
            font-weight: bold;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }
        
        .profile-info h1 {
            font-size: 1.8rem;
            font-weight: 600;
            margin-bottom: 8px;
            color: #1f2937;
        }
        
        .profile-info .title {
            font-size: 1rem;
            color: #6b7280;
            margin-bottom: 12px;
        }
        
        .verified-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #dbeafe;
            color: #1d4ed8;
            padding: 6px 12px;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
        }
        
        .stats {
            display: flex;
            gap: 24px;
            margin-top: 16px;
        }
        
        .stat-item {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #6b7280;
            font-size: 0.875rem;
        }
        
        .stat-icon {
            color: #eab308;
            font-size: 1rem;
        }
        
        .main-content1 {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 24px;
        }
        
        .card {
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.06);
        }
        
        .card h2 {
            font-size: 1.25rem;
            margin-bottom: 16px;
            color: #1f2937;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .card h2 i {
            color: #1d4ed8;
            font-size: 1.1rem;
        }
        
        .skills-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(100px, 1fr));
            gap: 10px;
            margin-bottom: 20px;
        }
        
        .skill-tag {
            background: #f3f4f6;
            color: #374151;
            padding: 6px 10px;
            border-radius: 6px;
            text-align: center;
            font-weight: 500;
            font-size: 0.75rem;
            transition: background-color 0.2s ease;
        }
        
        .skill-tag:hover {
            background: #e5e7eb;
        }
        
        .proposal-showcase {
            background: #dbeafe;
            border-radius: 6px;
            padding: 16px;
            margin: 16px 0;
            border-left: 4px solid #1d4ed8;
        }
        
        .proposal-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 12px;
        }
        
        .proposal-description {
            color: #4b5563;
            line-height: 1.6;
            margin-bottom: 12px;
            font-size: 0.875rem;
        }
        
        .pricing-section {
            text-align: center;
            background: #059669;
            color: white;
            border-radius: 6px;
            padding: 16px;
            margin: 16px 0;
        }
        
        .price {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 8px;
        }
        
        .timeline {
            font-size: 0.875rem;
            opacity: 0.9;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
        }
        
        .contact-section {
            margin-top: 16px;
        }
        
        .contact-info {
            background: #f8fafc;
            padding: 16px;
            border-radius: 8px;
            margin: 12px 0;
        }
        
        .contact-item {
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 10px 0;
            color: #4b5563;
            font-size: 0.875rem;
        }
        
        .contact-item i {
            color: #1d4ed8;
            font-size: 1rem;
            width: 16px;
            text-align: center;
        }
        
        .btn-primary {
            background: #1d4ed8;
            color: white;
            padding: 12px 20px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: background-color 0.2s ease;
            border: none;
            cursor: pointer;
            font-size: 0.875rem;
        }
        
        .btn-primary:hover {
            background: #1e40af;
        }
        
        .experience-years {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #2563eb;
            color: white;
            padding: 6px 12px;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 600;
        }
        
        .online-status {
            width: 8px;
            height: 8px;
            background: #10b981;
            border-radius: 50%;
            display: inline-block;
            margin-left: 6px;
        }
        
        .portfolio-item {
            background: #f8fafc;
            padding: 16px;
            border-radius: 8px;
            border-left: 4px solid #4f46e5;
            margin-bottom: 16px;
        }
        
        .portfolio-item h4 {
            color: #1f2937;
            margin-bottom: 8px;
            font-size: 1rem;
        }
        
        .portfolio-item p {
            color: #6b7280;
            margin-bottom: 12px;
            font-size: 0.8rem;
        }
        
        .tech-tags {
            display: flex;
            gap: 6px;
            flex-wrap: wrap;
        }
        
        .tech-tag {
            padding: 3px 8px;
            border-radius: 12px;
            font-size: 0.7rem;
        }
        
        .additional-message {
            background: #fef3c7;
            border-radius: 6px;
            padding: 12px;
            margin: 16px 0;
            border-left: 4px solid #eab308;
        }
        
        .additional-message h3 {
            font-size: 1rem;
            margin-bottom: 8px;
            color: #92400e;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .additional-message h3 i {
            color: #eab308;
        }
        
        .additional-message p {
            font-size: 0.875rem;
            color: #92400e;
            line-height: 1.5;
        }
        
        .info-item {
            background: #f9fafb;
            padding: 12px;
            border-radius: 6px;
            margin: 12px 0;
        }
        
        .info-item h4 {
            margin-bottom: 8px;
            font-size: 0.95rem;
            color: #1f2937;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        
        .info-item h4 i {
            color: #6b7280;
            font-size: 0.9rem;
        }
        
        .status-badge {
            background: #fef3c7;
            color: #92400e;
            padding: 4px 12px;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }
        
        .file-link {
            color: #1d4ed8;
            text-decoration: none;
            font-size: 0.8rem;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            margin-bottom: 4px;
        }
        
        .file-link:hover {
            text-decoration: underline;
        }
        
        .project-info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 8px;
            font-size: 0.75rem;
        }
        
        .project-info-item {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }
        
        .project-info-item .label {
            color: #6b7280;
            display: flex;
            align-items: center;
            gap: 4px;
        }
        
        .project-info-item .value {
            font-weight: 600;
        }
        
        .budget-value {
            color: #16a34a;
        }
        
        .timeline-value {
            color: #1a1a1a;
        }
        
        @media (max-width: 768px) {
            .main-content1 {
                grid-template-columns: 1fr;
            }
            
            .profile-section {
                flex-direction: column;
                text-align: center;
            }
            
            .stats {
                justify-content: center;
                flex-wrap: wrap;
            }
        }

        
.nav-container {
    background: white;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    position: sticky;
    top: -1px;
    z-index: 100;
    width: 100vw;
    
    margin: 0 !important;
    margin-left: -1.5rem !important;
    margin-right: -1.5rem !important;
    margin-top: -1.5rem !important; /* Tambahkan ini untuk menghilangkan gap atas */
    
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
    <div class="container1">
        <!-- Header Section -->
        <div class="header">
            <div class="profile-section">
                <div class="profile-avatar">
                    {{ strtoupper(substr($proposal->user->name, 0, 2)) }}
                </div>
                <div class="profile-info">
                    <h1>{{ $proposal->user->name }}</h1>
                    <p class="title">{{ optional($proposal->user->freelancerProfile)->title ?? 'Freelancer' }}</p>
                    <div style="display: flex; align-items: center; gap: 12px; flex-wrap: wrap;">
                        <span class="verified-badge">
                            <i class="bi bi-shield-check"></i>
                            Verified
                        </span>
                        <span class="experience-years">
                            <i class="bi bi-calendar-check"></i>
                            {{ optional($proposal->user->freelancerProfile)->experience ?? '-' }} tahun pengalaman
                        </span>
                        <span style="color: #10b981; font-weight: 600; font-size: 0.875rem; display: flex; align-items: center; gap: 4px;">
                            <i class="bi bi-circle-fill" style="font-size: 0.5rem;"></i>
                            Online
                        </span>
                    </div>
                </div>
            </div>
            
            <div class="stats">
                <div class="stat-item">
                    <i class="bi bi-star-fill stat-icon"></i>
                    <span>4.9 (127 reviews)</span>
                </div>
                <div class="stat-item">
                    <i class="bi bi-folder-fill stat-icon"></i>
                    <span>89 proyek selesai</span>
                </div>
                <div class="stat-item">
                    <i class="bi bi-geo-alt-fill stat-icon"></i>
                    <span>{{ optional($proposal->user->freelancerProfile)->location ?? 'Lokasi tidak tersedia' }}</span>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-content1">
            <!-- Left Column -->
            <div>
                <!-- Skills Section -->
                @if($proposal->skills && count($proposal->skills) > 0)
                <div class="card">
                    <h2><i class="bi bi-rocket-takeoff"></i> Keahlian Teknis</h2>
                    <div class="skills-grid">
                        @foreach($proposal->skills as $skill)
                            <div class="skill-tag">{{ $skill }}</div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Current Proposal Showcase -->
                <div class="card">
                    <h2><i class="bi bi-briefcase"></i> Proposal untuk: {{ $proposal->project->title }}</h2>
                    <div class="proposal-showcase">
                        <div class="proposal-title">{{ $proposal->proposal_title }}</div>
                        <div class="proposal-description">
                            {{ $proposal->proposal_description }}
                        </div>
                        
                        <div class="pricing-section">
                            <div class="price">Rp {{ number_format($proposal->proposal_price, 0, ',', '.') }}</div>
                            @if($proposal->timeline)
                                <div class="timeline">
                                    <i class="bi bi-clock"></i>
                                    Timeline: {{ $proposal->timeline }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Experience Section -->
                @if($proposal->experience)
                <div class="card">
                    <h2><i class="bi bi-trophy"></i> Pengalaman Relevan</h2>
                    <div class="portfolio-item">
                        <p style="color: #4b5563; line-height: 1.6;">{{ $proposal->experience }}</p>
                    </div>
                </div>
                @endif

                <!-- Additional Message -->
                @if($proposal->additional_message)
                <div class="card">
                    <h2><i class="bi bi-chat-dots"></i> Pesan dari Freelancer</h2>
                    <div class="additional-message">
                        <h3><i class="bi bi-bullseye"></i> Pesan Khusus</h3>
                        <p>{{ $proposal->additional_message }}</p>
                    </div>
                </div>
                @endif
            </div>

            <!-- Right Column -->
            <div>
                <!-- Contact Section -->
                <div class="card">
                    <h2><i class="bi bi-telephone"></i> Hubungi Freelancer</h2>
                    <div class="contact-info">
                        <div class="contact-item">
                            <i class="bi bi-envelope"></i>
                            <span>{{ $proposal->user->email }}</span>
                        </div>
                        @if(optional($proposal->user->freelancerProfile)->phone)
                        <div class="contact-item">
                            <i class="bi bi-phone"></i>
                            <span>{{ $proposal->user->freelancerProfile->phone }}</span>
                        </div>
                        @endif
                        @if($proposal->portfolio_links)
                        <div class="contact-item">
                            <i class="bi bi-briefcase"></i>
                            <a href="{{ $proposal->portfolio_links }}" target="_blank" style="color: #1d4ed8;">Lihat Portfolio</a>
                        </div>
                        @endif
                    </div>
                    
<a href="{{ route('payment.show', $proposal) }}" class="btn-primary" style="width: 100%; margin-top: 16px; text-align: center; display: flex; text-decoration: none;">
    <i class="bi bi-credit-card"></i>
    Pilih & Bayar Freelancer
</a>
<a href="{{ route('freelancer.profile.public', $proposal->user->id) }}" class="btn-primary" style="width: 100%; margin-top: 8px; background: #047857; text-align: center; display: flex;">
    <i class="bi bi-eye"></i>
    Lihat Profile Lengkap Freelancer 
</a>
                    
<!-- <a href="{{ route('freelancer.profile.public', $proposal->user->freelancerProfile->id ?? $proposal->user->id) }}" class="btn-primary" style="width: 100%; margin-top: 8px; background: #047857; text-align: center; display: flex;">
    <i class="bi bi-eye"></i>
    Lihat Profile Lengkap Freelancer 
</a> -->

                </div>
        
                <!-- Proposal Info -->
                <div class="card">
                    <h2><i class="bi bi-clipboard-check"></i> Info Proposal</h2>
                    
                    <div class="info-item">
                        <h4><i class="bi bi-info-circle"></i> Status</h4>
                        <span class="status-badge">
                            <i class="bi bi-clock-history"></i>
                            {{ ucfirst($proposal->status) }}
                        </span>
                    </div>
                    
                    <div class="info-item">
                        <h4><i class="bi bi-calendar-event"></i> Tanggal Dikirim</h4>
                        <p style="font-size: 0.8rem; color: #6b7280; margin: 0;">{{ $proposal->created_at->format('d M Y, H:i') }}</p>
                    </div>

                    @if($proposal->files && count($proposal->files) > 0)
                    <div class="info-item">
                        <h4><i class="bi bi-paperclip"></i> File Lampiran</h4>
                        @foreach($proposal->files as $file)
                            <div style="margin-bottom: 4px;">
                                <a href="{{ asset('storage/' . $file) }}" target="_blank" class="file-link">
                                    <i class="bi bi-file-earmark-arrow-down"></i>
                                    {{ basename($file) }}
                                </a>
                            </div>
                        @endforeach
                    </div>
                    @endif
                </div>

                <!-- Project Info -->
                <div class="card">
                    <h2><i class="bi bi-file-text"></i> Info Proyek</h2>
                    <div style="background: #f8fafc; padding: 16px; border-radius: 8px;">
                        <h4 style="color: #1f2937; margin-bottom: 8px; font-size: 1rem;">{{ $proposal->project->title }}</h4>
                        <p style="color: #6b7280; font-size: 0.8rem; margin-bottom: 12px;">
                            {{ \Illuminate\Support\Str::limit($proposal->project->description, 100, '...') }}
                        </p>
                        <div class="project-info-grid">
                            <div class="project-info-item">
                                <span class="label">
                                    <i class="bi bi-currency-dollar"></i>
                                    Budget:
                                </span>
                                <div class="value budget-value">
                                    Rp {{ number_format($proposal->project->fixed_budget, 0, ',', '.') }}
                                </div>
                            </div>
                            <div class="project-info-item">
                                <span class="label">
                                    <i class="bi bi-clock"></i>
                                    Timeline:
                                </span>
                                <div class="value timeline-value">
                                    {{ $proposal->project->timeline_duration }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
@endsection