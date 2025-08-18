@extends('client.layout.client-layout')
@section('title', 'Pekerjaan Popular - CariFreelance')
@section('content')
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ahmad Rizki Pratama - Full Stack Web Developer</title>
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
            gap: 4px;
            background: #dbeafe;
            color: #1d4ed8;
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 0.7rem;
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
            gap: 6px;
            color: #6b7280;
            font-size: 0.875rem;
        }
        
        .stat-icon {
            color: #eab308;
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
        
        .project-showcase {
            background: #dbeafe;
            border-radius: 6px;
            padding: 16px;
            margin: 16px 0;
            border-left: 4px solid #1d4ed8;
        }
        
        .project-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 12px;
        }
        
        .project-description {
            color: #4b5563;
            line-height: 1.6;
            margin-bottom: 12px;
            font-size: 0.875rem;
        }
        
        .project-features {
            list-style: none;
            margin: 12px 0;
        }
        
        .project-features li {
            padding: 6px 0;
            color: #374151;
            position: relative;
            padding-left: 20px;
            font-size: 0.875rem;
        }
        
        .project-features li:before {
            content: "✓";
            position: absolute;
            left: 0;
            color: #10b981;
            font-weight: bold;
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
            gap: 8px;
            margin: 8px 0;
            color: #4b5563;
            font-size: 0.875rem;
        }
        
        .btn-primary {
            background: #1d4ed8;
            color: white;
            padding: 10px 20px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 600;
            display: inline-block;
            transition: background-color 0.2s ease;
            border: none;
            cursor: pointer;
            font-size: 0.8rem;
        }
        
        .btn-primary:hover {
            background: #1e40af;
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
        }
        
        .experience-years {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            background: #2563eb;
            color: white;
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 0.7rem;
            font-weight: 600;
        }
        
        .online-status {
            width: 6px;
            height: 6px;
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
        
        .package-item {
            background: #f9fafb;
            padding: 12px;
            border-radius: 6px;
            margin: 12px 0;
            border-left: 4px solid #1d4ed8;
        }
        
        .package-item h4 {
            margin-bottom: 8px;
            font-size: 0.95rem;
        }
        
        .package-item p {
            font-size: 0.8rem;
            margin-bottom: 8px;
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
            border-left: 4px solid #1d4ed8;
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
    </style>
</head>
<body>
    <div class="container1">
        <!-- Header Section -->
        <div class="header">
            <div class="profile-section">
                <div class="profile-avatar">
                    AR
                </div>
                <div class="profile-info">
                    <h1>Ahmad Rizki Pratama</h1>
                    <p class="title">Full Stack Web Developer</p>
                    <div style="display: flex; align-items: center; gap: 12px; flex-wrap: wrap;">
                        <span class="verified-badge">
                            ✓ Verified
                        </span>
                        <span class="experience-years">
                            📅 3 tahun pengalaman
                        </span>
                        <span style="color: #10b981; font-weight: 600; font-size: 0.875rem;">
                            Online <span class="online-status"></span>
                        </span>
                    </div>
                </div>
            </div>
            
            <div class="stats">
                <div class="stat-item">
                    <span class="stat-icon">⭐</span>
                    <span>4.9 (127 reviews)</span>
                </div>
                <div class="stat-item">
                    <span class="stat-icon">📁</span>
                    <span>89 proyek selesai</span>
                </div>
                <div class="stat-item">
                    <span class="stat-icon">📍</span>
                    <span>Jakarta, Indonesia</span>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-content1">
            <!-- Left Column -->
            <div>
                <!-- Skills Section -->
                <div class="card">
                    <h2>🚀 Keahlian Teknis</h2>
                    <div class="skills-grid">
                        <div class="skill-tag">Laravel</div>
                        <div class="skill-tag">MySQL</div>
                        <div class="skill-tag">TailwindCSS</div>
                        <div class="skill-tag">Midtrans</div>
                        <div class="skill-tag">E-commerce</div>
                        <div class="skill-tag">SEO</div>
                        <div class="skill-tag">PHP</div>
                        <div class="skill-tag">JavaScript</div>
                        <div class="skill-tag">Vue.js</div>
                        <div class="skill-tag">React</div>
                        <div class="skill-tag">Bootstrap</div>
                        <div class="skill-tag">API Integration</div>
                    </div>
                    
                    <div class="specialization">
                        <h3>🎯 Spesialisasi</h3>
                        <p>Spesialis pembuatan e-commerce dengan fitur lengkap: wishlist, loyalty points, dan integrasi Instagram API. Fokus pada performa, keamanan, dan desain modern.</p>
                    </div>
                </div>

                <!-- Current Project Showcase -->
                <div class="card">
                    <h2>💼 Project Terkini: UrbanStyle E-commerce</h2>
                    <div class="project-showcase">
                        <div class="project-title">🛍️ UrbanStyle - Fashion E-commerce Platform</div>
                        <div class="project-description">
                            Saya berpengalaman membuat website e-commerce berbasis Laravel dengan integrasi Midtrans. Untuk UrbanStyle, saya akan membangun katalog produk lengkap dengan berbagai kategori fashion modern.
                        </div>
                        
                        <h4 style="margin: 16px 0 12px 0; color: #1f2937; font-size: 1rem;">🎯 Fitur Yang Akan Dikembangkan:</h4>
                        <ul class="project-features">
                            <li>Katalog produk lengkap (T-shirt, hoodie, kemeja, celana, aksesoris)</li>
                            <li>Shopping cart dengan perhitungan otomatis</li>
                            <li>Sistem inventory management otomatis</li>
                            <li>Admin panel yang user-friendly</li>
                            <li>Integrasi payment gateway Midtrans</li>
                            <li>Sistem wishlist dan loyalty points</li>
                            <li>Integrasi Instagram API untuk product showcase</li>
                            <li>SEO optimization untuk meningkatkan visibility</li>
                            <li>Responsive design untuk mobile dan desktop</li>
                            <li>Dashboard analytics untuk owner</li>
                        </ul>
                        
                        <div class="pricing-section">
                            <div class="price">Rp 15.000.000</div>
                            <div class="timeline">⏱️ Estimasi: 5 minggu pengerjaan</div>
                        </div>
                    </div>
                </div>

                <!-- Portfolio Projects -->
                <div class="card">
                    <h2>🏆 Portfolio Terpilih</h2>
                    <div style="display: grid; gap: 16px;">
                        <div class="portfolio-item">
                            <h4>🛒 TokoPedia Clone</h4>
                            <p>E-commerce marketplace dengan multi-vendor, sistem rating, dan chat realtime</p>
                            <div class="tech-tags">
                                <span class="tech-tag" style="background: #e0e7ff; color: #4338ca;">Laravel</span>
                                <span class="tech-tag" style="background: #fef3c7; color: #92400e;">Vue.js</span>
                                <span class="tech-tag" style="background: #dcfce7; color: #166534;">MySQL</span>
                            </div>
                        </div>
                        
                        <div class="portfolio-item" style="border-left: 4px solid #06b6d4;">
                            <h4>🏥 Sistem Manajemen Rumah Sakit</h4>
                            <p>Aplikasi web untuk manajemen pasien, dokter, dan appointment scheduling</p>
                            <div class="tech-tags">
                                <span class="tech-tag" style="background: #fecaca; color: #dc2626;">PHP</span>
                                <span class="tech-tag" style="background: #ddd6fe; color: #7c3aed;">Bootstrap</span>
                                <span class="tech-tag" style="background: #fed7d7; color: #c53030;">MySQL</span>
                            </div>
                        </div>
                        
                        <div class="portfolio-item" style="border-left: 4px solid #10b981;">
                            <h4>📚 Learning Management System</h4>
                            <p>Platform pembelajaran online dengan fitur video streaming dan quiz interaktif</p>
                            <div class="tech-tags">
                                <span class="tech-tag" style="background: #e0f2fe; color: #0369a1;">React</span>
                                <span class="tech-tag" style="background: #f0fdf4; color: #15803d;">Node.js</span>
                                <span class="tech-tag" style="background: #fffbeb; color: #d97706;">MongoDB</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column -->
            <div>
                <!-- Contact Section -->
                <div class="card">
                    <h2>📞 Hubungi Saya</h2>
                    <div class="contact-info">
                        <div class="contact-item">
                            <span>📧</span>
                            <span>ahmad.rizki@email.com</span>
                        </div>
                        <div class="contact-item">
                            <span>📱</span>
                            <span>+62 812-3456-7890</span>
                        </div>
                        <div class="contact-item">
                            <span>💼</span>
                            <span>linkedin.com/in/ahmadrizki</span>
                        </div>
                        <div class="contact-item">
                            <span>🐙</span>
                            <span>github.com/ahmadrizki</span>
                        </div>
                    </div>
                    
                    <button class="btn-primary" style="width: 100%; margin-top: 16px;">
                        🚀 Pilih Freelancer
                    </button>
                    <button class="btn-primary" style="width: 100%; margin-top: 8px; background: #047857;">
                        👁️ Lihat Profil Lengkap
                    </button>
                </div>

                <!-- Service Packages -->
                <div class="card">
                    <h2>📦 Paket Layanan</h2>
                    
                    <div class="package-item">
                        <h4 style="color: #1e40af;">🥉 Basic Package</h4>
                        <p style="color: #374151;">Website company profile responsive</p>
                        <div class="package-price" style="color: #1e40af;">Rp 3.500.000</div>
                    </div>
                    
                    <div class="package-item" style="border-left: 4px solid #059669;">
                        <h4 style="color: #047857;">🥈 Standard Package</h4>
                        <p style="color: #374151;">E-commerce dengan admin panel</p>
                        <div class="package-price" style="color: #047857;">Rp 8.500.000</div>
                    </div>
                    
                    <div class="package-item" style="border: 1px solid #9ca3af;">
                        <h4 style="color: #6b7280;">🥇 Premium Package</h4>
                        <p style="color: #374151;">Full-stack app dengan fitur advanced</p>
                        <div class="package-price" style="color: #6b7280;">Rp 15.000.000+</div>
                    </div>
                </div>

                <!-- Testimonials -->
                <div class="card">
                    <h2>💬 Testimonial</h2>
                    
                    <div class="testimonial-item">
                        <p>"Ahmad sangat professional dan hasil kerjanya memuaskan. Website e-commerce yang dibuat sangat user-friendly!"</p>
                        <div class="testimonial-author">⭐⭐⭐⭐⭐ - Sarah (CEO Boutique Online)</div>
                    </div>
                    
                    <div class="testimonial-item" style="border-left: 4px solid #059669;">
                        <p>"Pengerjaan cepat dan sesuai deadline. Komunikasi lancar dan sangat membantu!"</p>
                        <div class="testimonial-author">⭐⭐⭐⭐⭐ - Budi (Startup Founder)</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
@endsection