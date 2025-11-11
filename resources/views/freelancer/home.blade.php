@extends('freelancer.layout.freelancer-layout')
@section('title', 'Home - CariFreelance Freelancer')
@section('content')

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Temukan Pekerjaan Freelance Terbaik</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css">
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
                url('https://images.unsplash.com/photo-1556761175-b413da4baf72?w=1920&h=1080&fit=crop&crop=center') center/cover;
            min-height: 400px;
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

        /* Job Categories Grid */
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

        .category-link {
            text-decoration: none;
            color: inherit;
            display: block;
            width: 100%;
            height: 100%;
        }

        /* Success Tips Section */
        .tips-section {
            margin: 80px 0;
            padding: 0 20px;
            width: 100vw;
        }

        .tips-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .tip-card {
            background: white;
            padding: 40px 30px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            text-align: center;
            border: 2px solid transparent;
        }

        .tip-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 50px rgba(29, 161, 242, 0.15);
            border-color: rgba(29, 161, 242, 0.2);
        }

        .tip-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 25px;
            background: linear-gradient(135deg, #1DA1F2, #0d7ac9);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 2.2rem;
            box-shadow: 0 10px 25px rgba(29, 161, 242, 0.3);
        }

        .tip-title {
            font-size: 1.4rem;
            font-weight: 700;
            margin-bottom: 15px;
            color: #333;
        }

        .tip-desc {
            color: #666;
            line-height: 1.7;
            font-size: 1rem;
        }

.news-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 30px;
    max-width: 1400px;
    margin: 0 auto;
}

.news-item {
    background: white;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
    cursor: pointer;
    border: 2px solid transparent;
    position: relative;
}

.news-item:hover {
    transform: translateY(-10px);
    box-shadow: 0 25px 50px rgba(29, 161, 242, 0.15);
    border-color: rgba(29, 161, 242, 0.2);
}

.news-item.featured {
    grid-column: span 2;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 0;
    min-height: 300px;
}

.news-image {
    position: relative;
    overflow: hidden;
    height: 200px;
}

.news-item.featured .news-image {
    height: 100%;
}

.news-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.news-item:hover .news-img {
    transform: scale(1.05);
}

.news-badge {
    position: absolute;
    top: 15px;
    right: 15px;
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    z-index: 2;
}

.news-badge:not(.hot):not(.new) {
    background: linear-gradient(135deg, #FF6B6B, #FF8E53);
    color: white;
    box-shadow: 0 4px 15px rgba(255, 107, 107, 0.3);
}

.news-badge.hot {
    background: linear-gradient(135deg, #FF6B35, #F7931E);
    color: white;
    box-shadow: 0 4px 15px rgba(255, 107, 53, 0.3);
    animation: pulse 2s infinite;
}

.news-badge.new {
    background: linear-gradient(135deg, #4ECDC4, #44A08D);
    color: white;
    box-shadow: 0 4px 15px rgba(78, 205, 196, 0.3);
}

@keyframes pulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.05); }
}

.news-content {
    padding: 25px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    height: 100%;
}

.news-item.featured .news-content {
    padding: 40px;
}

.news-category {
    display: inline-block;
    background: linear-gradient(135deg, rgba(29, 161, 242, 0.1), rgba(13, 122, 201, 0.1));
    color: #1DA1F2;
    padding: 6px 12px;
    border-radius: 15px;
    font-size: 0.8rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 15px;
    width: fit-content;
    border: 1px solid rgba(29, 161, 242, 0.2);
}

.news-title {
    font-size: 1.3rem;
    font-weight: 700;
    color: #333;
    margin-bottom: 12px;
    line-height: 1.4;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.news-item.featured .news-title {
    font-size: 1.6rem;
    -webkit-line-clamp: 3;
    margin-bottom: 15px;
}

.news-excerpt {
    color: #666;
    font-size: 0.95rem;
    line-height: 1.6;
    margin-bottom: 20px;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
    flex-grow: 1;
}

.news-item.featured .news-excerpt {
    font-size: 1rem;
    -webkit-line-clamp: 4;
}

.news-meta {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-top: 15px;
    border-top: 1px solid rgba(0,0,0,0.1);
    font-size: 0.85rem;
    color: #888;
}

.news-date {
    font-weight: 500;
}

.news-read-time {
    color: #1DA1F2;
    font-weight: 600;
}

/* Load More Button */
.load-more-container {
    text-align: center;
    margin-top: 60px;
}

.load-more-btn {
    background: linear-gradient(135deg, #1DA1F2, #0d7ac9);
    color: white;
    border: none;
    padding: 15px 30px;
    border-radius: 50px;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 10px;
    box-shadow: 0 8px 25px rgba(29, 161, 242, 0.3);
}

.load-more-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 15px 40px rgba(29, 161, 242, 0.4);
    background: linear-gradient(135deg, #0d7ac9, #1DA1F2);
}

.load-more-btn iconify-icon {
    font-size: 1.2rem;
    transition: transform 0.3s ease;
}

.load-more-btn:hover iconify-icon {
    transform: rotate(180deg);
}

/* Responsive Design */
@media (max-width: 768px) {
    .news-grid {
        grid-template-columns: 1fr;
        gap: 20px;
    }
    
    .news-item.featured {
        grid-column: span 1;
        display: block;
    }
    
    .news-item.featured .news-image {
        height: 200px;
    }
    
    .news-title {
        font-size: 1.1rem;
    }
    
    .news-item.featured .news-title {
        font-size: 1.3rem;
    }
    
    .news-content {
        padding: 20px;
    }
    
    .news-item.featured .news-content {
        padding: 25px;
    }
}

@media (max-width: 480px) {
    .news-image {
        height: 180px;
    }
    
    .news-title {
        font-size: 1rem;
    }
    
    .news-excerpt {
        font-size: 0.9rem;
        -webkit-line-clamp: 2;
    }
    
    .load-more-btn {
        padding: 12px 25px;
        font-size: 0.9rem;
    }
}
        
        /* Responsive */
        @media (max-width: 768px) {
            .hero h1 {
                font-size: 2.5rem;
            }
            
            .hero p {
                font-size: 1.1rem;
            }
            
            .categories-grid {
                grid-template-columns: 1fr;
            }
            
            .tips-grid {
                grid-template-columns: 1fr;
            }
            
            .nav-list {
                padding: 10px 0;
            }
            
            .section-title {
                font-size: 2rem;
            }

            .activity-item {
                flex-direction: column;
                text-align: center;
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
    </style>
    <script src="https://code.iconify.design/3/3.1.1/iconify.min.js"></script>
</head>
<body>
    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h1>Temukan Pekerjaan Freelance Terbaik</h1>
            <p>Ribuan proyek menarik menunggu keahlian profesional Anda</p>
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
                <li class="nav-item"><a href="/video" class="nav-link">Video Editing</a></li>
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


    <!-- Success Tips Section -->
    <section class="tips-section">
        <div class="container">
            <h2 class="section-title animate-on-scroll">Tips Sukses Menjadi Freelancer</h2>
            <p class="section-description animate-on-scroll">Panduan untuk memaksimalkan peluang mendapatkan proyek dan meningkatkan penghasilan.</p>
            
            <div class="tips-grid">
                <div class="tip-card animate-on-scroll">
                    <div class="tip-icon">
                        <i class="bi bi-person-fill-gear"></i>
                    </div>
                    <h3 class="tip-title">Profil yang Menarik</h3>
                    <p class="tip-desc">Buat profil yang lengkap dan profesional dengan portfolio terbaik Anda. Gunakan foto profil yang berkualitas dan deskripsi yang jelas tentang keahlian Anda.</p>
                </div>

                <div class="tip-card animate-on-scroll">
                    <div class="tip-icon">
                        <i class="bi bi-lightning-charge-fill"></i>
                    </div>
                    <h3 class="tip-title">Respon Cepat</h3>
                    <p class="tip-desc">Tanggapi pesan klien dengan cepat dan profesional. Freelancer dengan response rate tinggi memiliki peluang lebih besar mendapatkan proyek.</p>
                </div>

                <div class="tip-card animate-on-scroll">
                    <div class="tip-icon">
                        <i class="bi bi-bullseye"></i>
                    </div>
                    <h3 class="tip-title">Proposal yang Tepat</h3>
                    <p class="tip-desc">Buat proposal yang spesifik dan sesuai dengan kebutuhan klien. Hindari template generic dan tunjukkan pemahaman Anda terhadap proyek.</p>
                </div>

                <div class="tip-card animate-on-scroll">
                    <div class="tip-icon">
                        <i class="bi bi-patch-check-fill"></i>
                    </div>
                    <h3 class="tip-title">Kualitas Terjamin</h3>
                    <p class="tip-desc">Selalu berikan hasil kerja terbaik dan tepat waktu. Review positif dari klien akan meningkatkan credibility dan membantu mendapatkan proyek baru.</p>
                </div>

                <div class="tip-card animate-on-scroll">
                    <div class="tip-icon">
                        <i class="bi bi-chat-dots-fill"></i>
                    </div>
                    <h3 class="tip-title">Komunikasi Efektif</h3>
                    <p class="tip-desc">Jaga komunikasi yang baik dengan klien sepanjang proyek. Update progress secara berkala dan konfirmasi jika ada perubahan requirement.</p>
                </div>

                <div class="tip-card animate-on-scroll">
                    <div class="tip-icon">
                        <i class="bi bi-graph-up-arrow"></i>
                    </div>
                    <h3 class="tip-title">Terus Berkembang</h3>
                    <p class="tip-desc">Update skill dan pengetahuan Anda secara berkala. Ikuti tren industri dan pelajari tools atau teknologi baru yang relevan dengan bidang Anda.</p>
                </div>
            </div>
        </div>
    </section>

</section>

    <script>
        // Navigation functionality
        document.querySelectorAll('.nav-item').forEach(item => {
            item.addEventListener('click', function() {
                document.querySelectorAll('.nav-item').forEach(nav => nav.classList.remove('active'));
                this.classList.add('active');
            });
        });

        // Job category navigation function
        function navigateToJobCategory(category) {
            console.log(`Navigating to ${category} jobs`);
            // window.location.href = `/jobs/category/${category}`;
        }

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

        // Activity item click handler
        document.querySelectorAll('.activity-item').forEach(item => {
            item.addEventListener('click', function() {
                const activityTitle = this.querySelector('.activity-title').textContent;
                console.log(`Viewing activity: ${activityTitle}`);
                // Add navigation to activity details here
            });
        });

        // Sticky navigation scroll effect
        window.addEventListener('scroll', function() {
            const navContainer = document.querySelector('.nav-container');
            if (window.scrollY > 100) {
                navContainer.classList.add('scrolled');
            } else {
                navContainer.classList.remove('scrolled');
            }
        });
        function openNewsDetail(newsId) {
    console.log(`Opening news detail for: ${newsId}`);
    // Ini akan dihubungkan dengan backend nanti
    // window.location.href = `/news/${newsId}`;
    
    // Temporary animation for now
    event.currentTarget.style.transform = 'scale(0.98)';
    setTimeout(() => {
        event.currentTarget.style.transform = '';
    }, 150);
}

function loadMoreNews() {
    console.log('Loading more news...');
    // Ini akan dihubungkan dengan backend nanti untuk load more news
    
    // Temporary loading animation
    const btn = event.currentTarget;
    const originalText = btn.innerHTML;
    btn.innerHTML = '<iconify-icon icon="material-symbols:hourglass-empty"></iconify-icon> Memuat...';
    btn.disabled = true;
    
    setTimeout(() => {
        btn.innerHTML = originalText;
        btn.disabled = false;
    }, 2000);
}

// Add click analytics for news items
document.querySelectorAll('.news-item').forEach(item => {
    item.addEventListener('click', function() {
        const newsTitle = this.querySelector('.news-title').textContent;
        const newsCategory = this.querySelector('.news-category').textContent;
        
        // Analytics tracking (akan diimplementasi dengan backend)
        console.log('News clicked:', {
            title: newsTitle,
            category: newsCategory,
            timestamp: new Date().toISOString()
        });
    });
});
    </script>
</body>
</html>

@endsection