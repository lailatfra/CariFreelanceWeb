@extends('layouts.app')
@section('title', 'Home - CariFreelance')
@section('content')
<!-- landing guest -->
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Inter', sans-serif;
        line-height: 1.6;
        color: #333;
    }

    /* Hero Section */
    .hero {
        background: linear-gradient(135deg, #1DA1F2 0%, #1DA1F2 50%, #1DA1F2 100%);
        min-height: 70vh;
        display: flex;
        align-items: center;
        position: relative;
        overflow: hidden;
        padding-top: 100px; /* Add space for navbar */
    }

    .hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('https://images.unsplash.com/photo-1522071820081-009f0129c71c?ixlib=rb-4.0.3&auto=format&fit=crop&w=1950&q=80') center/cover;
        opacity: 0.1;
        z-index: 1;
    }

    .hero-content {
        position: relative;
        z-index: 2;
    }

    .hero h1 {
        font-size: 3.5rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
    }

    .hero p {
        font-size: 1.2rem;
        margin-bottom: 2rem;
        opacity: 0.9;
    }

    .search-container {
        background: white;
        border-radius: 50px;
        padding: 8px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        max-width: 600px;
        margin: 0 auto;
    }

    .search-input {
        border: none;
        padding: 15px 25px;
        font-size: 1rem;
        border-radius: 45px;
        width: 100%;
        outline: none;
    }

    .search-btn {
        background: linear-gradient(135deg, #1DA1F2 0%, #1DA1F2 100%);
        color: white;
        border: none;
        padding: 15px 30px;
        border-radius: 45px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .search-btn:hover {
        background: linear-gradient(135deg, #1DA1F2 0%, #1DA1F2 100%);
        transform: translateY(-2px);
    }

    .popular-searches {
        margin-top: 2rem;
    }

    .popular-searches span {
        display: inline-block;
        background: rgba(255,255,255,0.2);
        color: white;
        padding: 8px 16px;
        border-radius: 20px;
        margin: 5px;
        font-size: 0.9rem;
        border: 1px solid rgba(255,255,255,0.3);
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .popular-searches span:hover {
        background: rgba(255,255,255,0.3);
        transform: translateY(-2px);
    }

    /* Latest Categories Section */
    .categories-section {
        padding: 80px 20px;
        background: #f8f9fa;
        width: 100vw;
        margin: 0;
    }

    .section-title {
        font-size: 2.5rem;
        font-weight: 700;
        text-align: center;
        margin-bottom: 20px;
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

    .section-subtitle {
        text-align: center;
        color: #666;
        margin-bottom: 50px;
        font-size: 1.1rem;
    }

    /* Categories Grid */
    .categories-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 30px;
        margin-bottom: 60px;
        max-width: 1200px;
        margin: 0 auto;
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

    /* Features Section */
    .features-section {
        padding: 80px 0;
        background: white;
    }

    .features-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 40px;
        margin-top: 3rem;
    }

    .feature-card {
        text-align: center;
        padding: 30px;
        border-radius: 15px;
        transition: all 0.3s ease;
    }

    .feature-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,184,148,0.15);
    }

    .feature-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #1DA1F2 0%, #1DA1F2 50%, #1DA1F2 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        font-size: 2rem;
        color: white;
    }

    .feature-card h3 {
        font-size: 1.3rem;
        font-weight: 600;
        margin-bottom: 15px;
        color: #333;
    }

    .feature-card p {
        color: #666;
        line-height: 1.6;
    }

    /* Stats Section */
    .stats-section {
        padding: 60px 0;
        background: linear-gradient(135deg, #1DA1F2 0%, #1DA1F2 50%, #1DA1F2 100%);
        color: white;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 40px;
    }

    .stat-card {
        text-align: center;
    }

    .stat-number {
        font-size: 3rem;
        font-weight: 700;
        margin-bottom: 10px;
    }

    .stat-label {
        font-size: 1.1rem;
        opacity: 0.9;
    }

    /* CTA Section */
    .cta-section {
        padding: 80px 0;
        background: #f8f9fa;
        text-align: center;
    }

    .cta-content h2 {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 20px;
        color: #333;
    }

    .cta-content p {
        font-size: 1.1rem;
        color: #666;
        margin-bottom: 30px;
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
    }

    .cta-buttons {
        display: flex;
        gap: 20px;
        justify-content: center;
        flex-wrap: wrap;
    }

    .btn-primary-custom {
        background: linear-gradient(135deg, #1DA1F2 0%, #1DA1F2 100%);
        color: white;
        padding: 15px 40px;
        border-radius: 50px;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
        border: 2px solid #1DA1F2;
        box-shadow: 0 5px 15px #27709eff;
    }

    .btn-primary-custom:hover {
        background: linear-gradient(135deg, #1DA1F2 0%, #1DA1F2 100%);
        transform: translateY(-2px);
        color: white;
        box-shadow: 0 8px 25px #27709eff;
    }

    .btn-secondary-custom {
        background: transparent;
        color: #1DA1F2;
        padding: 15px 40px;
        border-radius: 50px;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
        border: 2px solid #1DA1F2;
    }

    .btn-secondary-custom:hover {
        background: linear-gradient(135deg, #1DA1F2 0%, #1DA1F2 100%);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 8px 25px #206fa0ff;
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

    /* Responsive Design */
    @media (max-width: 768px) {
        .hero h1 {
            font-size: 2.5rem;
        }
        
        .search-container {
            max-width: 90%;
        }
        
        .categories-grid {
            grid-template-columns: 1fr;
        }
        
        .section-title {
            font-size: 2rem;
        }
        
        .cta-buttons {
            flex-direction: column;
            align-items: center;
        }
    }
</style>

<!-- Hero Section -->
<section class="hero">
    <div class="container">
        <div class="hero-content text-center">
            <h1 class="text-white">Temukan Freelancer Terbaik<br>untuk Proyek Anda</h1>
            <p class="text-white">Jutaan freelancer profesional siap membantu mewujudkan ide bisnis Anda</p>
            
            <div class="search-container">
                <div class="d-flex">
                    <input type="text" class="search-input flex-grow-1" placeholder="Cari layanan apapun...">
                    <button class="search-btn">Cari</button>
                </div>
            </div>
            
            <!-- <div class="popular-searches">
                <span>Website Development</span>
                <span>Logo Design</span>
                <span>Video Editing</span>
                <span>Content Writing</span>
                <span>Mobile App</span>
            </div> -->
        </div>
    </div>
</section>

<!-- Latest Categories Section -->
<section class="categories-section">
    <div class="container">
        <h2 class="section-title animate-on-scroll">Kategori Terbaru</h2>
        <p class="section-subtitle animate-on-scroll">Jelajahi kategori pekerjaan terpopuler dan mulai mempekerjakan freelancer terbaik.</p>

        <!-- Categories Grid -->
        <div class="categories-grid">
            <!-- Grafis & Desain -->
            <div class="category-card animate-on-scroll">
                <a href="/grafis" class="category-link">
                    <img src="https://images.unsplash.com/photo-1561070791-2526d30994b5?w=500&h=300&fit=crop" alt="Grafis & Desain" class="category-image">
                    <h3 class="category-title">Grafis & Desain</h3>
                </a>
            </div>

            <!-- Dokumen & PPT -->
            <div class="category-card animate-on-scroll">
                <a href="/dokumen" class="category-link">
                    <img src="https://images.unsplash.com/photo-1455390582262-044cdead277a?w=500&h=300&fit=crop" alt="Dokumen & PPT" class="category-image">
                    <h3 class="category-title">Dokumen & PPT</h3>
                </a>
            </div>

            <!-- Web & App -->
            <div class="category-card animate-on-scroll">
                <a href="/web-app" class="category-link">
                    <img src="https://images.unsplash.com/photo-1461749280684-dccba630e2f6?w=500&h=300&fit=crop" alt="Web & App" class="category-image">
                    <h3 class="category-title">Web & App</h3>
                </a>
            </div>

            <!-- Video Editing -->
            <div class="category-card animate-on-scroll">
                <a href="#" class="category-link">
                    <img src="https://images.unsplash.com/photo-1574717024653-61fd2cf4d44d?w=500&h=300&fit=crop" alt="Video Editing" class="category-image">
                    <h3 class="category-title">Video Editing</h3>
                </a>
            </div>
        </div>
    </div>
</section>

   <!-- Features Section -->
   <section class="features-section">
       <div class="container">
           <div class="text-center mb-5">
               <h2 class="display-5 fw-bold mb-3">Mengapa Memilih CariFreelance?</h2>
               <p class="lead text-muted">Platform terpercaya dengan fitur lengkap untuk kesuksesan proyek Anda</p>
           </div>
           
           <div class="features-grid">
               <div class="feature-card">
                   <div class="feature-icon">
                       <i class="fas fa-shield-alt"></i>
                   </div>
                   <h3>Keamanan Terjamin</h3>
                   <p>Sistem pembayaran yang aman dengan jaminan uang kembali 100% jika tidak puas dengan hasil pekerjaan</p>
               </div>
               <div class="feature-card">
                   <div class="feature-icon">
                       <i class="fas fa-users"></i>
                   </div>
                   <h3>Freelancer Terverifikasi</h3>
                   <p>Ribuan freelancer profesional yang sudah diverifikasi keahlian dan pengalamannya</p>
               </div>
               <div class="feature-card">
                   <div class="feature-icon">
                       <i class="fas fa-clock"></i>
                   </div>
                   <h3>Pengerjaan Cepat</h3>
                   <p>Dapatkan hasil pekerjaan berkualitas dalam waktu yang telah disepakati</p>
               </div>
               <div class="feature-card">
                   <div class="feature-icon">
                       <i class="fas fa-headset"></i>
                   </div>
                   <h3>Support 24/7</h3>
                   <p>Tim customer service yang siap membantu Anda kapan saja</p>
               </div>
               <div class="feature-card">
                   <div class="feature-icon">
                       <i class="fas fa-star"></i>
                   </div>
                   <h3>Kualitas Terbaik</h3>
                   <p>Hanya freelancer dengan rating tinggi dan portfolio terbaik</p>
               </div><div class="feature-card">
                   <div class="feature-icon">
                       <i class="fas fa-money-bill-wave"></i>
                   </div>
                   <h3>Harga Transparan</h3>
                   <p>Tidak ada biaya tersembunyi, semua harga sudah tertera dengan jelas</p>
               </div>
           </div>
       </div>
   </section>

   <!-- CTA Section -->
   <section class="cta-section">
       <div class="container">
           <div class="cta-content">
               <h2>Siap Memulai Proyek Anda?</h2>
               <p>Bergabunglah dengan ribuan klien yang telah mempercayakan proyeknya kepada freelancer terbaik di CariFreelance</p>
               <div class="cta-buttons">
                   <a href="#" class="btn-primary-custom">Mulai Proyek</a>
                   <a href="#" class="btn-secondary-custom">Jadi Freelancer</a>
               </div>
           </div>
       </div>
   </section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Search functionality
        const searchInput = document.querySelector('.search-input');
        const searchBtn = document.querySelector('.search-btn');
        
        searchBtn.addEventListener('click', function() {
            const searchTerm = searchInput.value.trim();
            if (searchTerm) {
                // Handle search functionality here
                console.log('Searching for:', searchTerm);
            }
        });
        
        searchInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                searchBtn.click();
            }
        });
        
        // Popular searches functionality
        const popularSearches = document.querySelectorAll('.popular-searches span');
        popularSearches.forEach(span => {
            span.addEventListener('click', function() {
                searchInput.value = this.textContent;
                searchBtn.click();
            });
        });
        
        // Smooth scrolling for CTA buttons
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            });
        });
        
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
        
        // Observe elements for animation
        document.querySelectorAll('.animate-on-scroll').forEach(el => {
            observer.observe(el);
        });
        
        // Add scroll animations for other elements
        document.querySelectorAll('.category-card, .feature-card').forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(20px)';
            el.style.transition = 'all 0.6s ease';
            
            const animationObserver = new IntersectionObserver(function(entries) {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, observerOptions);
            
            animationObserver.observe(el);
        });
    });
</script>

@endsection