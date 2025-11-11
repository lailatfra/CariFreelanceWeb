@extends('client.layout.client-layout')
@section('title', 'Home - CariFreelance')
@section('content')

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Temukan Freelancer Terbaik untuk Proyek Anda</title>
    <!-- Bootstrap Icons CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.1/font/bootstrap-icons.min.css" rel="stylesheet">
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
        }

        /* Hide all scrollbars */
        ::-webkit-scrollbar {
            display: none;
        }
        
        html, body {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        /* Hero Section */
        .hero {
            background: 
                linear-gradient(135deg, rgba(29, 161, 242, 0.8) 0%, rgba(13, 122, 201, 0.8) 50%, rgba(29, 161, 242, 0.8) 100%),
                url('https://images.unsplash.com/photo-1522202176988-66273c2fd55f?w=1920&h=1080&fit=crop&crop=center') center/cover;
            min-height: 500px;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
            margin: 0;
            padding: 0;
            width: 100vw;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000"><defs><radialGradient id="a"><stop offset="0" stop-color="%23ffffff" stop-opacity="0.1"/><stop offset="1" stop-color="%23ffffff" stop-opacity="0"/></radialGradient></defs><circle cx="200" cy="200" r="100" fill="url(%23a)"/><circle cx="800" cy="300" r="150" fill="url(%23a)"/><circle cx="600" cy="600" r="80" fill="url(%23a)"/></svg>') no-repeat center/cover;
            animation: float 20s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }

        .hero-content {
            max-width: 100%;
            width: 100%;
            margin: 0;
            padding: 80px 20px;
            text-align: center;
            position: relative;
            z-index: 2;
        }

        .hero h1 {
            font-size: 3.5rem;
            font-weight: 700;
            color: white;
            margin-bottom: 20px;
            animation: slideInDown 1s ease-out;
        }

        .hero p {
            font-size: 1.3rem;
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 40px;
            animation: slideInUp 1s ease-out 0.3s both;
        }

        /* Hero Button */
        .hero-buttons {
            display: flex;
            justify-content: center;
            align-items: center;
            animation: slideInUp 1s ease-out 0.6s both;
        }

        .hero-btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 18px 35px;
            text-decoration: none;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            cursor: pointer;
            border: none;
            min-width: 250px;
            text-align: center;
            justify-content: center;
            background: white;
            color: #1DA1F2;
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }

        .hero-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.2);
            background: #f8f9fa;
        }

        .hero-btn i {
            font-size: 1.2rem;
        }

        @keyframes slideInDown {
            from {
                opacity: 0;
                transform: translateY(-50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
.nav-container {
    background: white;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    position: sticky;
    top: 70px;
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
    margin: 0 auto; /* Center the nav */
    padding: 0 20px;
}

.nav-list {
    display: flex;
    list-style: none;
    overflow-x: auto;
    padding: 4px 0;
    gap: 90px; /* Tambah gap lebih besar */
    scrollbar-width: none;
    -ms-overflow-style: none;
    align-items: center;
    justify-content: center; /* Tambahkan ini untuk center alignment */
    flex-wrap: nowrap; /* Pastikan tidak wrap */
}

.nav-list::-webkit-scrollbar {
    display: none;
}

.nav-item {
    white-space: nowrap;
    cursor: pointer;
    padding: 8px 20px; /* Tambah horizontal padding */
    border-radius: 20px;
    transition: all 0.3s ease;
    font-weight: 500;
    color: #666;
    background: transparent;
    border: none;
    min-height: 36px;
    display: flex;
    align-items: center;
    flex-shrink: 0; /* Prevent shrinking */
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
    font-size: 14px; /* Reduced from 15px to 14px */
    font-weight: 600;
    transition: all 0.3s ease;
}

.nav-item:hover .nav-link,
.nav-item.active .nav-link {
    color: #1DA1F2;
    text-shadow: 0 0 10px rgba(29, 161, 242, 0.6);
}

        /* Main Content */
        .main-content {
            max-width: 100%;
            margin-top: 80px;
            width: 100vw;
        }

        .main-content1 {
            max-width: 100%;
            margin: 0;
            padding: 40px;
            width: 100vw;
        }

        .section-title {
            font-size: 2.5rem;
            font-weight: 700;
            text-align: center;
            margin-bottom: 50px;
            color: #333;
            position: relative;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: linear-gradient(135deg, #1DA1F2, #0d7ac9);
            border-radius: 2px;
        }

        /* Categories Grid */
        .categories-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            margin-bottom: 60px;
        }

        .category-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            cursor: pointer;
            position: relative;
            height: 200px;
        }

        .category-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(29, 161, 242, 0.8), rgba(13, 122, 201, 0.8));
            opacity: 0;
            transition: opacity 0.3s ease;
            z-index: 1;
        }

        .category-card:hover::before {
            opacity: 1;
        }

        .category-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(29, 161, 242, 0.2);
        }

        .category-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .category-card:hover .category-image {
            transform: scale(1.1);
        }

        .category-title {
            position: absolute;
            bottom: 20px;
            left: 20px;
            right: 20px;
            color: white;
            font-size: 1.4rem;
            font-weight: 600;
            z-index: 2;
            text-shadow: 0 2px 10px rgba(0,0,0,0.5);
        }

        /* Freelancer Section */
        .freelancer-section {
            margin: 80px 0;
            padding: 60px 20px;
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            width: 100vw;
        }

        .freelancer-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 30px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .freelancer-card {
            background: white;
            border-radius: 15px;
            padding: 30px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .freelancer-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(29, 161, 242, 0.15);
        }

        .freelancer-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            margin: 0 auto 20px;
            object-fit: cover;
            border: 4px solid #1DA1F2;
        }

        .freelancer-name {
            font-size: 1.4rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 10px;
        }

        .freelancer-skill {
            color: #1DA1F2;
            font-weight: 500;
            margin-bottom: 15px;
        }

        .freelancer-rating {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
            margin-bottom: 15px;
        }

        .star {
            color: #ffc107;
            font-size: 1.2rem;
        }

        .rating-text {
            color: #666;
            margin-left: 5px;
        }

        .freelancer-desc {
            color: #666;
            font-size: 0.9rem;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .freelancer-price {
            color: #1DA1F2;
            font-weight: 600;
            font-size: 1.1rem;
        }

        /* Statistics Section */
        .stats-section {
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            padding: 60px 20px;
            margin: 60px 0;
            width: 100vw;
        }

        .stats-container {
            max-width: 1000px;
            margin: 0 auto;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 40px;
            text-align: center;
        }

        .stat-item {
            animation: fadeInUp 1s ease-out;
        }

        .stat-number {
            font-size: 3rem;
            font-weight: 700;
            color: #1DA1F2;
            display: block;
            margin-bottom: 10px;
        }

        .stat-label {
            font-size: 1.1rem;
            color: #666;
            font-weight: 500;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Features Section */
        .features-section {
            margin: 80px 0;
            padding: 0 20px;
            width: 100vw;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 40px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .feature-card {
            text-align: center;
            padding: 40px 20px;
            border-radius: 15px;
            background: white;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(29, 161, 242, 0.15);
        }

        .feature-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 20px;
            background: linear-gradient(135deg, #1DA1F2, #0d7ac9);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: white;
        }

        .feature-title {
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 15px;
            color: #333;
        }

        .feature-desc {
            color: #666;
            line-height: 1.6;
        }

        /* CTA Section */
        .cta-section {
            background: linear-gradient(135deg, #1DA1F2 0%, #0d7ac9 100%);
            padding: 80px 20px;
            text-align: center;
            margin: 60px 0;
            position: relative;
            overflow: hidden;
            width: 100vw;
        }

        .cta-section::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="20" cy="20" r="2" fill="white" opacity="0.1"/><circle cx="80" cy="80" r="1" fill="white" opacity="0.1"/><circle cx="40" cy="60" r="1.5" fill="white" opacity="0.1"/></svg>');
            animation: drift 30s linear infinite;
        }

        @keyframes drift {
            0% { transform: translate(0, 0) rotate(0deg); }
            100% { transform: translate(-100px, -100px) rotate(360deg); }
        }

        .cta-content {
            position: relative;
            z-index: 2;
        }

        .cta-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: white;
            margin-bottom: 20px;
        }

        .cta-desc {
            font-size: 1.2rem;
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 40px;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .cta-button {
            display: inline-block;
            padding: 15px 40px;
            background: white;
            color: #1DA1F2;
            text-decoration: none;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }

        .cta-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .hero h1 {
                font-size: 2.5rem;
            }
            
            .hero p {
                font-size: 1.1rem;
            }

            .hero-btn {
                min-width: 280px;
                padding: 16px 30px;
            }
            
            .categories-grid {
                grid-template-columns: 1fr;
            }
            
            .nav-list {
                padding: 10px 0;
                gap: 30px;
            }
            
            .section-title {
                font-size: 2rem;
            }
        }

        /* Scroll animations */
        .animate-on-scroll {
            opacity: 0;
            transform: translateY(50px);
            transition: all 0.6s ease;
        }

        .animate-on-scroll.animated {
            opacity: 1;
            transform: translateY(0);
        }

        /* Remove all container margins and paddings */
        .container-fluid {
            padding: 0 !important;
            margin: 0 !important;
        }

        /* Full width sections */
        html, body {
            width: 100%;
            overflow-x: hidden;
            margin: 0;
            padding: 0;
        }

        /* Remove gaps */
        body > * {
            margin-left: 0 !important;
            margin-right: 0 !important;
        }

        .category-link {
            text-decoration: none;
            color: inherit;
            display: block;
            width: 100%;
            height: 100%;
        }

    </style>
</head>
<body>
    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h1>Temukan Freelancer Terbaik untuk Proyek Anda</h1>
            <p>Jutaan freelance profesional siap membantu mewujudkan ide bisnis anda</p>
            <div class="hero-buttons">
                <a href="/posting" class="hero-btn">
                    <i class="bi bi-plus-circle"></i>
                    Posting Proyek Sekarang
                </a>
            </div>
        </div>
    </section>

    <!-- Navigation -->
    <div class="nav-container">
        <nav class="nav">
            <ul class="nav-list">
                <li class="nav-item"><a href="/popular" class="nav-link">Pekerjaan Populer</a></li>
                <li class="nav-item"><a href="/grafis" class="nav-link">Grafis & Desain</a></li>
                <li class="nav-item"><a href="/dokumen" class="nav-link">Dokumen & PPT</a></li>
                <li class="nav-item"><a href="/web-app" class="nav-link">Web & App</a></li>
                <li class="nav-item"><a href="#" class="nav-link">Video Editing</a></li>
            </ul>
        </nav>
    </div>
    <!-- Main Content -->
    <main class="main-content1">
        <h2 class="section-title animate-on-scroll">Kategori Terbaru</h2>
        <p style="text-align: center; color: #666; margin-bottom: 50px; font-size: 1.1rem;" class="animate-on-scroll">Jelajahi kategori pekerjaan terpopuler dan mulai mempekerjakan freelancer terbaik.</p>

        <!-- Categories Grid -->
        <div class="categories-grid">

            <!-- Grafis & Desain -->
            <div class="category-card animate-on-scroll" onclick="navigateToCategory('grafis-desain')">
                <a href="/grafis" class="category-link">
                <img src="https://images.unsplash.com/photo-1561070791-2526d30994b5?w=500&h=300&fit=crop" alt="Grafis & Desain" class="category-image">
                <h3 class="category-title">Grafis & Desain</h3>
                </a>
            </div>

            <!-- Dokumen & PPT -->
            <div class="category-card animate-on-scroll" onclick="navigateToCategory('dokumen-ppt')">
                <a href="/dokumen" class="category-link">
                <img src="https://images.unsplash.com/photo-1455390582262-044cdead277a?w=500&h=300&fit=crop" alt="Dokumen & PPT" class="category-image">
                <h3 class="category-title">Dokumen & PPT</h3>
                </a>
            </div>

            <!-- Web & App -->
            <div class="category-card animate-on-scroll" onclick="navigateToCategory('web-app')">
                <a href="/web-app" class="category-link">
                <img src="https://images.unsplash.com/photo-1461749280684-dccba630e2f6?w=500&h=300&fit=crop" alt="Web & App" class="category-image">
                <h3 class="category-title">Web & App</h3>
                </a>
            </div>

            <!-- Video Editing -->
            <div class="category-card animate-on-scroll" onclick="navigateToCategory('video-editing')">
                <a href="#" class="category-link">
                <img src="https://images.unsplash.com/photo-1574717024653-61fd2cf4d44d?w=500&h=300&fit=crop" alt="Video Editing" class="category-image">
                <h3 class="category-title">Video Editing</h3>
                </a>
            </div>

        </div>
    </main>

    <!-- Freelancer Section -->
    <section class="freelancer-section">
        <div class="container">
            <h2 class="section-title animate-on-scroll">Jelajahi Ratusan Freelancer Profesional</h2>
            <p style="text-align: center; color: #666; margin-bottom: 50px; font-size: 1.1rem;" class="animate-on-scroll">Temukan freelancer terbaik dengan keahlian yang sesuai dengan kebutuhan proyek Anda.</p>
            
            <div class="freelancer-grid">
                <div class="freelancer-card animate-on-scroll">
                    <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=150&h=150&fit=crop&crop=face" alt="Ahmad Rizki" class="freelancer-avatar">
                    <h3 class="freelancer-name">Ahmad Rizki</h3>
                    <p class="freelancer-skill">Full Stack Developer</p>
                    <div class="freelancer-rating">
                        <span class="star">★</span>
                        <span class="star">★</span>
                        <span class="star">★</span>
                        <span class="star">★</span>
                        <span class="star">★</span>
                        <span class="rating-text">5.0 (127 reviews)</span>
                    </div>
                    <p class="freelancer-desc">Spesialis dalam pengembangan aplikasi web dengan React, Node.js, dan MongoDB. Berpengalaman 5+ tahun dalam industri teknologi.</p>
                    <p class="freelancer-price">Mulai dari Rp 150.000/jam</p>
                </div>

                <div class="freelancer-card animate-on-scroll">
                    <img src="https://images.unsplash.com/photo-1487412720507-e7ab37603c6f?w=150&h=150&fit=crop&crop=face" alt="Rika Sari" class="freelancer-avatar">
                    <h3 class="freelancer-name">Sari Melati</h3>
                    <p class="freelancer-skill">UI/UX Designer</p>
                    <div class="freelancer-rating">
                        <span class="star">★</span>
                        <span class="star">★</span>
                        <span class="star">★</span>
                        <span class="star">★</span>
                        <span class="star">★</span>
                        <span class="rating-text">4.9 (89 reviews)</span>
                    </div>
                    <p class="freelancer-desc">Desainer profesional dengan pengalaman dalam menciptakan interface yang user-friendly dan menarik untuk berbagai platform digital.</p>
                    <p class="freelancer-price">Mulai dari Rp 120.000/jam</p>
                </div>

                <div class="freelancer-card animate-on-scroll">
                    <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=150&h=150&fit=crop&crop=face" alt="Budi Santoso" class="freelancer-avatar">
                    <h3 class="freelancer-name">Budi Santoso</h3>
                    <p class="freelancer-skill">Digital Marketing Expert</p>
                    <div class="freelancer-rating">
                        <span class="star">★</span>
                        <span class="star">★</span>
                        <span class="star">★</span>
                        <span class="star">★</span>
                        <span class="star">★</span>
                        <span class="rating-text">4.8 (156 reviews)</span>
                    </div>
                    <p class="freelancer-desc">Ahli pemasaran digital dengan track record meningkatkan ROI klien hingga 300%. Spesialis dalam SEO, SEM, dan social media marketing.</p>
                    <p class="freelancer-price">Mulai dari Rp 100.000/jam</p>
                </div>

                <div class="freelancer-card animate-on-scroll">
                    <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=150&h=150&fit=crop&crop=face" alt="Nina Permata" class="freelancer-avatar">
                    <h3 class="freelancer-name">Nina Permata</h3>
                    <p class="freelancer-skill">Content Writer</p>
                    <div class="freelancer-rating">
                        <span class="star">★</span>
                        <span class="star">★</span>
                        <span class="star">★</span>
                        <span class="star">★</span>
                        <span class="star">★</span>
                        <span class="rating-text">4.9 (203 reviews)</span>
                    </div>
                    <p class="freelancer-desc">Penulis konten berpengalaman dengan keahlian dalam SEO writing, copywriting, dan content strategy untuk berbagai industri.</p>
                    <p class="freelancer-price">Mulai dari Rp 75.000/jam</p>
                </div>

                <div class="freelancer-card animate-on-scroll">
                    <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=150&h=150&fit=crop&crop=face" alt="Dimas Pratama" class="freelancer-avatar">
                    <h3 class="freelancer-name">Dimas Pratama</h3>
                    <p class="freelancer-skill">Mobile App Developer</p>
                    <div class="freelancer-rating">
                        <span class="star">★</span>
                        <span class="star">★</span>
                        <span class="star">★</span>
                        <span class="star">★</span>
                        <span class="star">★</span>
                        <span class="rating-text">5.0 (94 reviews)</span>
                    </div>
                    <p class="freelancer-desc">Developer aplikasi mobile dengan keahlian Flutter dan React Native. Telah mengembangkan 50+ aplikasi mobile yang sukses.</p>
                    <p class="freelancer-price">Mulai dari Rp 180.000/jam</p>
                </div>

                <div class="freelancer-card animate-on-scroll">
                    <img src="https://images.unsplash.com/photo-1487412720507-e7ab37603c6f?w=150&h=150&fit=crop&crop=face" alt="Rika Sari" class="freelancer-avatar">
                    <h3 class="freelancer-name">Rika Sari</h3>
                    <p class="freelancer-skill">Graphic Designer</p>
                    <div class="freelancer-rating">
                        <span class="star">★</span>
                        <span class="star">★</span>
                        <span class="star">★</span>
                        <span class="star">★</span>
                        <span class="star">★</span>
                        <span class="rating-text">4.8 (178 reviews)</span>
                    </div>
                    <p class="freelancer-desc">Desainer grafis kreatif dengan spesialisasi branding, logo design, dan marketing materials. Portfolio mencakup 200+ proyek sukses.</p>
                    <p class="freelancer-price">Mulai dari Rp 90.000/jam</p>
                </div>
            </div>
        </div>
    </section>

    <script>
        // Navigation functionality
        document.querySelectorAll('.nav-item').forEach(item => {
            item.addEventListener('click', function() {
                document.querySelectorAll('.nav-item').forEach(nav => nav.classList.remove('active'));
                this.classList.add('active');
            });
        });

        // Category navigation function
        function navigateToCategory(category) {
            // For now, just show an alert. You can replace this with actual navigation
            console.log(`Navigating to ${category} category`);
            // window.location.href = `/${category}`;
        }

        // Hero button functionality - Let it navigate naturally
        // No need to prevent default, let the link work normally

        // Scroll animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animated');
                }
            });
        }, observerOptions);

        document.querySelectorAll('.animate-on-scroll').forEach(el => {
            observer.observe(el);
        });

        // Counter animation for statistics
        function animateCounters() {
            const counters = document.querySelectorAll('.stat-number');
            counters.forEach(counter => {
                const target = counter.textContent;
                const numericTarget = parseInt(target.replace(/\D/g, ''));
                const suffix = target.replace(/[0-9]/g, '');
                
                let current = 0;
                const increment = numericTarget / 100;
                
                const timer = setInterval(() => {
                    current += increment;
                    if (current >= numericTarget) {
                        counter.textContent = target;
                        clearInterval(timer);
                    } else {
                        counter.textContent = Math.floor(current) + suffix;
                    }
                }, 20);
            });
        }

        // Trigger counter animation when stats section is visible
        const statsObserver = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateCounters();
                    statsObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.5 });

        const statsSection = document.querySelector('.stats-section');
        if (statsSection) {
            statsObserver.observe(statsSection);
        }

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Add loading animation
        window.addEventListener('load', function() {
            document.body.style.opacity = '0';
            document.body.style.transition = 'opacity 0.5s ease-in-out';
            setTimeout(() => {
                document.body.style.opacity = '1';
            }, 100);
        });

        // Freelancer card click handler
        document.querySelectorAll('.freelancer-card').forEach(card => {
            card.addEventListener('click', function() {
                const freelancerName = this.querySelector('.freelancer-name').textContent;
                console.log(`Viewing profile of ${freelancerName}`);
                // Add navigation to freelancer profile here
                // window.location.href = `/freelancer/${freelancerName.toLowerCase().replace(' ', '-')}`;
            });
        });
    </script>
</body>
</html>

@endsection