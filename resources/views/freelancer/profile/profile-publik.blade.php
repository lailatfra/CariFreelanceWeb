@extends('freelancer.layout.freelancer-layout') 
@section('title', 'Profil Freelancer - CariFreelance')
@section('content')

<!DOCTYPE html>
<html lang="id">
    <!-- profile publik -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $freelancerProfile->full_name ?? 'Freelancer' }} - CariFreelance</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <style>
        body {
            background: #f8fafc;
            color: #1f2937;
            font-family: Arial, sans-serif;
            margin: 0;
            line-height: 1.6;
        }
        
        .container1 {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        
        .back-btn {
            background: #6b7280;
            color: white;
            border: none;
            border-radius: 8px;
            padding: 12px 20px;
            font-size: 14px;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 20px;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .back-btn:hover {
            background: #4b5563;
            color: white;
            text-decoration: none;
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
            background: #3b82f6;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 36px;
            font-weight: bold;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            background-size: cover;
            background-position: center;
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
            gap: 4px;
            background: #dbeafe;
            color: #3b82f6;
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 0.7rem;
            font-weight: 600;
            text-transform: uppercase;
        }
        
        .experience-years {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            background: #3b82f6;
            color: white;
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 0.7rem;
            font-weight: 600;
        }
        
        .stats {
            display: flex;
            gap: 24px;
            margin-top: 16px;
        }
        
        .stat-item {
            display: flex;
            align-items: center;
            gap: 6px;
            color: #6b7280;
            font-size: 0.875rem;
        }
        
        .stat-icon {
            color: #f59e0b;
            font-size: 0.875rem;
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
            margin-bottom: 24px;
        }
        
        .card h2 {
            font-size: 1.25rem;
            margin-bottom: 16px;
            color: #1f2937;
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
        
        .specialization {
            background: #fef3c7;
            border-radius: 6px;
            padding: 12px;
            margin: 16px 0;
            border-left: 4px solid #eab308;
        }
        
        .specialization h3 {
            font-size: 1rem;
            margin-bottom: 8px;
            color: #92400e;
        }
        
        .specialization p {
            font-size: 0.875rem;
            color: #374151;
        }
        
        .portfolio-item {
            background: #f8fafc;
            padding: 16px;
            border-radius: 8px;
            border-left: 4px solid #3b82f6;
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
        
        .contact-info {
            background: #f8fafc;
            padding: 16px;
            border-radius: 8px;
            margin: 12px 0;
        }
        
        .contact-item {
            display: flex;
            align-items: center;
            gap: 8px;
            margin: 8px 0;
            color: #4b5563;
            font-size: 0.875rem;
        }
        
        .btn-primary {
            background: #3b82f6;
            color: white;
            padding: 12px 20px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 600;
            display: inline-block;
            transition: background-color 0.2s ease;
            border: none;
            cursor: pointer;
            font-size: 0.875rem;
            width: 100%;
            text-align: center;
            margin-top: 12px;
        }
        
        .btn-primary:hover {
            background: #2563eb;
            color: white;
            text-decoration: none;
        }
        
        .btn-success {
            background: #10b981;
        }
        
        .btn-success:hover {
            background: #059669;
        }
        
        .package-item {
            background: #f9fafb;
            padding: 12px;
            border-radius: 6px;
            margin: 12px 0;
            border-left: 4px solid #3b82f6;
        }
        
        .package-item h4 {
            margin-bottom: 8px;
            font-size: 0.95rem;
        }
        
        .package-item p {
            font-size: 0.8rem;
            margin-bottom: 8px;
            color: #6b7280;
        }
        
        .package-price {
            font-weight: 600;
            font-size: 1rem;
        }
        
        .testimonial-item {
            background: #f8fafc;
            padding: 12px;
            border-radius: 6px;
            margin: 12px 0;
            border-left: 4px solid #3b82f6;
        }
        
        .testimonial-item p {
            font-style: italic;
            color: #4b5563;
            margin-bottom: 8px;
            font-size: 0.8rem;
        }
        
        .testimonial-author {
            color: #6b7280;
            font-size: 0.75rem;
        }
        
        .bio-text {
            color: #4b5563;
            line-height: 1.7;
            font-size: 0.9rem;
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
            
            .container1 {
                padding: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="container1">
        <!-- Back Button -->
        <a href="{{ url()->previous() }}" class="back-btn">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>

        <!-- Header Section -->
        <div class="header">
            <div class="profile-section">
                @if($freelancerProfile->profile_photo)
                    <div class="profile-avatar" style="background-image: url('{{ Storage::url($freelancerProfile->profile_photo) }}');"></div>
                @else
                    <div class="profile-avatar">{{ strtoupper(substr($freelancerProfile->full_name ?? 'U', 0, 1)) }}</div>
                @endif
                
                <div class="profile-info">
                    <h1>{{ $freelancerProfile->full_name ?? 'Nama Belum Diatur' }}</h1>
                    <p class="title">{{ $freelancerProfile->headline ?? $freelancerProfile->category ?? 'Freelancer Profesional' }}</p>
                    <div style="display: flex; align-items: center; gap: 12px; flex-wrap: wrap;">
                        <span class="verified-badge">
                            <i class="fas fa-check"></i> Verified
                        </span>
                        @if($freelancerProfile->experience_years)
                        <span class="experience-years">
                            <i class="fas fa-calendar"></i> {{ $freelancerProfile->experience_years }} tahun pengalaman
                        </span>
                        @endif
                    </div>
                </div>
            </div>
            
            <div class="stats">
                @if($freelancerProfile->rating && $freelancerProfile->review_count)
                <div class="stat-item">
                    <span class="stat-icon"><i class="fas fa-star"></i></span>
                    <span>{{ number_format($freelancerProfile->rating, 1) }} ({{ $freelancerProfile->review_count }} reviews)</span>
                </div>
                @endif
                
                @if($freelancerProfile->project_count)
                <div class="stat-item">
                    <span class="stat-icon"><i class="fas fa-briefcase"></i></span>
                    <span>{{ $freelancerProfile->project_count }} proyek selesai</span>
                </div>
                @endif
                
                <div class="stat-item">
                    <span class="stat-icon"><i class="fas fa-map-marker-alt"></i></span>
                    <span>{{ $freelancerProfile->location ?? 'Lokasi tidak diatur' }}</span>
                </div>
                
                <div class="stat-item">
                    <span class="stat-icon"><i class="fas fa-user-clock"></i></span>
                    <span>Bergabung {{ $freelancerProfile->user->created_at ? $freelancerProfile->user->created_at->format('F Y') : 'Tidak diketahui' }}</span>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-content1">
            <!-- Left Column -->
            <div>
                <!-- About Section -->
                @if($freelancerProfile->bio)
                <div class="card">
                    <h2><i class="fas fa-user"></i> Tentang Saya</h2>
                    <div class="bio-text">
                        {!! nl2br(e($freelancerProfile->bio)) !!}
                    </div>
                </div>
                @endif

                <!-- Skills Section -->
                @if($freelancerProfile->skills)
                <div class="card">
                    <h2><i class="fas fa-rocket"></i> Keahlian Teknis</h2>
                    <div class="skills-grid">
                        @php
                            $skillsArray = explode(',', $freelancerProfile->skills);
                        @endphp
                        @foreach($skillsArray as $skill)
                            <div class="skill-tag">{{ trim($skill) }}</div>
                        @endforeach
                    </div>
                    
                    @if($freelancerProfile->category)
                    <div class="specialization">
                        <h3><i class="fas fa-target"></i> Spesialisasi</h3>
                        <p>Fokus pada {{ $freelancerProfile->category }} dengan pengalaman {{ $freelancerProfile->experience_years ?? 'beberapa' }} tahun di industri teknologi.</p>
                    </div>
                    @endif
                </div>
                @endif

                <!-- Portfolio Section -->
                <div class="card">
                    <h2><i class="fas fa-trophy"></i> Portfolio</h2>
                    
                    @if($freelancerProfile->portofolio_link)
                    <p style="margin-bottom: 20px; color: #6b7280; font-size: 0.875rem;">
                        <i class="fas fa-external-link-alt"></i> 
                        Lihat portfolio lengkap: 
                        <a href="{{ $freelancerProfile->portofolio_link }}" target="_blank" style="color: #3b82f6; text-decoration: none; font-weight: 600;">
                            {{ $freelancerProfile->portofolio_link }}
                        </a>
                    </p>
                    @endif
                    
                    <div>
                        <!-- Sample Portfolio Items -->
                        <div class="portfolio-item">
                            <h4><i class="fas fa-shopping-cart"></i> E-commerce Platform</h4>
                            <p>Platform jual beli online dengan fitur lengkap menggunakan teknologi modern</p>
                            <div class="tech-tags">
                                <span class="tech-tag" style="background: #e0e7ff; color: #4338ca;">Laravel</span>
                                <span class="tech-tag" style="background: #fef3c7; color: #92400e;">JavaScript</span>
                                <span class="tech-tag" style="background: #dcfce7; color: #166534;">MySQL</span>
                            </div>
                        </div>
                        
                        <div class="portfolio-item" style="border-left: 4px solid #06b6d4;">
                            <h4><i class="fas fa-mobile-alt"></i> Mobile App Design</h4>
                            <p>Desain aplikasi mobile dengan UI/UX yang modern dan user-friendly</p>
                            <div class="tech-tags">
                                <span class="tech-tag" style="background: #fecaca; color: #dc2626;">React</span>
                                <span class="tech-tag" style="background: #ddd6fe; color: #7c3aed;">CSS</span>
                                <span class="tech-tag" style="background: #fed7d7; color: #c53030;">Figma</span>
                            </div>
                        </div>
                        
                        <div class="portfolio-item" style="border-left: 4px solid #10b981;">
                            <h4><i class="fas fa-chart-bar"></i> Dashboard Analytics</h4>
                            <p>Dashboard analitik real-time untuk monitoring bisnis dan sales</p>
                            <div class="tech-tags">
                                <span class="tech-tag" style="background: #e0f2fe; color: #0369a1;">Vue.js</span>
                                <span class="tech-tag" style="background: #f0fdf4; color: #15803d;">Chart.js</span>
                                <span class="tech-tag" style="background: #fffbeb; color: #d97706;">API</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column -->
            <div>
                <!-- Contact Section -->
                <div class="card">
                    <h2><i class="fas fa-phone"></i> Hubungi Saya</h2>
                    <div class="contact-info">
                        <div class="contact-item">
                            <i class="fas fa-envelope"></i>
                            <span>{{ $freelancerProfile->user->email ?? 'Email tidak tersedia' }}</span>
                        </div>
                        @if($freelancerProfile->phone)
                        <div class="contact-item">
                            <i class="fas fa-phone"></i>
                            <span>{{ $freelancerProfile->phone }}</span>
                        </div>
                        @endif
                        @if($freelancerProfile->portofolio_link)
                        <div class="contact-item">
                            <i class="fas fa-briefcase"></i>
                            <span>Portfolio Online</span>
                        </div>
                        @endif
                        @if($freelancerProfile->languages)
                        <div class="contact-item">
                            <i class="fas fa-language"></i>
                            <span>{{ $freelancerProfile->languages }}</span>
                        </div>
                        @endif
                    </div>
                    

                </div>

                <!-- Testimonials -->
                @if($freelancerProfile->review_count > 0)
                <div class="card">
                    <h2><i class="fas fa-comments"></i> Testimonial</h2>
                    
                    <div class="testimonial-item">
                        <p>"Freelancer yang sangat professional dan hasil kerjanya memuaskan. Sangat recommended!"</p>
                        <div class="testimonial-author">
                            <i class="fas fa-star" style="color: #f59e0b;"></i>
                            <i class="fas fa-star" style="color: #f59e0b;"></i>
                            <i class="fas fa-star" style="color: #f59e0b;"></i>
                            <i class="fas fa-star" style="color: #f59e0b;"></i>
                            <i class="fas fa-star" style="color: #f59e0b;"></i>
                            - Client Satisfied
                        </div>
                    </div>
                    
                    <div class="testimonial-item" style="border-left: 4px solid #059669;">
                        <p>"Pengerjaan cepat dan sesuai deadline. Komunikasi lancar dan sangat membantu!"</p>
                        <div class="testimonial-author">
                            <i class="fas fa-star" style="color: #f59e0b;"></i>
                            <i class="fas fa-star" style="color: #f59e0b;"></i>
                            <i class="fas fa-star" style="color: #f59e0b;"></i>
                            <i class="fas fa-star" style="color: #f59e0b;"></i>
                            <i class="fas fa-star" style="color: #f59e0b;"></i>
                            - Happy Customer
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</body>
</html>

@endsection