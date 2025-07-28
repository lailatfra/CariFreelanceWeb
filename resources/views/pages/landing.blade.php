

@extends('layouts.app')
@section('title', 'Home - CariFreelance')
@section('content')

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
        background: linear-gradient(135deg, #00B894 0%, #00A085 50%, #008F75 100%);
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
        background: linear-gradient(135deg, #00B894 0%, #00A085 100%);
        color: white;
        border: none;
        padding: 15px 30px;
        border-radius: 45px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .search-btn:hover {
        background: linear-gradient(135deg, #00A085 0%, #008F75 100%);
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

    /* Categories Section */
    .categories-section {
        padding: 80px 0;
        background: #f8f9fa;
    }

    .category-tabs {
        display: flex;
        justify-content: center;
        margin-bottom: 3rem;
        border-bottom: 2px solid #e0e0e0;
        flex-wrap: wrap;
    }

    .category-tab {
        padding: 15px 25px;
        background: none;
        border: none;
        font-size: 1rem;
        font-weight: 500;
        color: #666;
        cursor: pointer;
        transition: all 0.3s ease;
        border-bottom: 3px solid transparent;
        margin: 0 10px;
    }

    .category-tab.active {
        color: #00B894;
        border-bottom-color: #00B894;
    }

    .category-tab:hover {
        color: #00B894;
    }

    .category-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 30px;
        margin-top: 2rem;
    }

    .category-card {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .category-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0,184,148,0.2);
    }

    .category-card img {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }

    .category-card-content {
        padding: 20px;
    }

    .category-card h3 {
        font-size: 1.2rem;
        font-weight: 600;
        margin-bottom: 10px;
        color: #333;
    }

    .category-card p {
        color: #666;
        font-size: 0.9rem;
        margin-bottom: 15px;
    }

    .category-card .price {
        font-size: 1.1rem;
        font-weight: 600;
        color: #00B894;
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
        background: linear-gradient(135deg, #00B894 0%, #00A085 50%, #008F75 100%);
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
        background: linear-gradient(135deg, #00B894 0%, #00A085 50%, #008F75 100%);
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
        background: linear-gradient(135deg, #00B894 0%, #00A085 100%);
        color: white;
        padding: 15px 40px;
        border-radius: 50px;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
        border: 2px solid #00B894;
        box-shadow: 0 5px 15px rgba(0,184,148,0.3);
    }

    .btn-primary-custom:hover {
        background: linear-gradient(135deg, #00A085 0%, #008F75 100%);
        transform: translateY(-2px);
        color: white;
        box-shadow: 0 8px 25px rgba(0,184,148,0.4);
    }

    .btn-secondary-custom {
        background: transparent;
        color: #00B894;
        padding: 15px 40px;
        border-radius: 50px;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
        border: 2px solid #00B894;
    }

    .btn-secondary-custom:hover {
        background: linear-gradient(135deg, #00B894 0%, #00A085 100%);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0,184,148,0.4);
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .hero h1 {
            font-size: 2.5rem;
        }
        
        .category-tabs {
            flex-direction: column;
            align-items: center;
        }
        
        .category-tab {
            margin: 5px 0;
        }
        
        .search-container {
            max-width: 90%;
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
            
            <div class="popular-searches">
                <span>Website Development</span>
                <span>Logo Design</span>
                <span>Video Editing</span>
                <span>Content Writing</span>
                <span>Mobile App</span>
            </div>
        </div>
    </div>
</section>

<!-- Categories Section -->
<section class="categories-section">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold mb-3">Jelajahi Kategori Populer</h2>
            <p class="lead text-muted">Temukan layanan yang tepat untuk kebutuhan Anda</p>
        </div>
        
        <div class="category-tabs">
            <button class="category-tab active" data-category="popular">Pekerjaan Populer</button>
            <button class="category-tab" data-category="design">Grafis & Desain</button>
            <button class="category-tab" data-category="writing">Penulisan & Penerjemahan</button>
            <button class="category-tab" data-category="web">Web dan Pemrograman</button>
            <button class="category-tab" data-category="video">Video & Audio</button>
            <button class="category-tab" data-category="marketing">Pemasaran & Periklanan</button>
        </div>
        
        <div class="category-content">
            <!-- Popular Category -->
            <div class="category-grid" id="popular-grid">
                <div class="category-card">
                    <img src="https://images.unsplash.com/photo-1498050108023-c5249f4df085?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="Web Development">
                    <div class="category-card-content">
                        <h3>Website Development</h3>
                        <p>Buat website profesional untuk bisnis Anda</p>
                        <div class="price">Mulai dari Rp 500.000</div>
                    </div>
                </div>
                <div class="category-card">
                    <img src="https://images.unsplash.com/photo-1561070791-2526d30994b5?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="Mobile App">
                    <div class="category-card-content">
                        <h3>Mobile App Development</h3>
                        <p>Aplikasi mobile iOS dan Android</p>
                        <div class="price">Mulai dari Rp 2.000.000</div>
                    </div>
                </div>
                <div class="category-card">
                    <img src="https://images.unsplash.com/photo-1542744173-8e7e53415bb0?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="Digital Marketing">
                    <div class="category-card-content">
                        <h3>Digital Marketing</h3>
                        <p>Strategi pemasaran digital yang efektif</p>
                        <div class="price">Mulai dari Rp 300.000</div>
                    </div>
                </div>
                <div class="category-card">
                    <img src="https://images.unsplash.com/photo-1586717791821-3f44a563fa4c?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="Content Writing">
                    <div class="category-card-content">
                        <h3>Content Writing</h3>
                        <p>Artikel berkualitas untuk website dan blog</p>
                        <div class="price">Mulai dari Rp 50.000</div>
                    </div>
                </div>
            </div>
            
            <!-- Design Category -->
            <div class="category-grid" id="design-grid" style="display: none;">
                <div class="category-card">
                    <img src="https://images.unsplash.com/photo-1626785774573-4b799315345d?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="Logo Design">
                    <div class="category-card-content">
                        <h3>Logo Design</h3>
                        <p>Desain logo profesional untuk brand Anda</p>
                        <div class="price">Mulai dari Rp 150.000</div>
                    </div>
                </div>
                <div class="category-card">
                    <img src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="UI/UX Design">
                    <div class="category-card-content">
                        <h3>UI/UX Design</h3>
                        <p>Desain interface yang user-friendly</p>
                        <div class="price">Mulai dari Rp 800.000</div>
                    </div>
                </div>
                <div class="category-card">
                    <img src="https://images.unsplash.com/photo-1493421419110-74f4e85ba126?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="Branding">
                    <div class="category-card-content">
                        <h3>Branding Package</h3>
                        <p>Paket branding lengkap untuk bisnis</p>
                        <div class="price">Mulai dari Rp 1.500.000</div>
                    </div>
                </div>
                <div class="category-card">
                    <img src="https://images.unsplash.com/photo-1572044162444-ad60f128bdea?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="Print Design">
                    <div class="category-card-content">
                        <h3>Print Design</h3>
                        <p>Desain untuk keperluan cetak</p>
                        <div class="price">Mulai dari Rp 100.000</div>
                    </div>
                </div>
            </div>
            
            <!-- Writing Category -->
            <div class="category-grid" id="writing-grid" style="display: none;">
                <div class="category-card">
                    <img src="https://images.unsplash.com/photo-1455390582262-044cdead277a?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="Article Writing">
                    <div class="category-card-content">
                        <h3>Article Writing</h3>
                        <p>Artikel SEO-friendly untuk website</p>
                        <div class="price">Mulai dari Rp 75.000</div>
                    </div>
                </div>
                <div class="category-card">
                    <img src="https://images.unsplash.com/photo-1434030216411-0b793f4b4173?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="Translation">
                    <div class="category-card-content">
                        <h3>Translation Services</h3>
                        <p>Layanan penerjemahan profesional</p>
                        <div class="price">Mulai dari Rp 25.000</div>
                    </div>
                </div>
                <div class="category-card">
                    <img src="https://images.unsplash.com/photo-1516321318423-f06f85e504b3?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="Copywriting">
                    <div class="category-card-content">
                        <h3>Copywriting</h3>
                        <p>Copy yang menjual untuk marketing</p>
                        <div class="price">Mulai dari Rp 200.000</div>
                    </div>
                </div>
                <div class="category-card">
                    <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="Resume Writing">
                    <div class="category-card-content">
                        <h3>Resume Writing</h3>
                        <p>CV profesional yang menarik perhatian</p>
                        <div class="price">Mulai dari Rp 150.000</div>
                    </div>
                </div>
            </div>
            
            <!-- Web Category -->
            <div class="category-grid" id="web-grid" style="display: none;">
                <div class="category-card">
                    <img src="https://images.unsplash.com/photo-1461749280684-dccba630e2f6?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="WordPress">
                    <div class="category-card-content">
                        <h3>WordPress Development</h3>
                        <p>Website WordPress custom dan profesional</p>
                        <div class="price">Mulai dari Rp 750.000</div>
                    </div>
                </div>
                <div class="category-card">
                    <img src="https://images.unsplash.com/photo-1555066931-4365d14bab8c?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="E-commerce">
                    <div class="category-card-content">
                        <h3>E-commerce Development</h3>
                        <p>Toko online siap jual dengan fitur lengkap</p>
                        <div class="price">Mulai dari Rp 2.500.000</div>
                    </div>
                </div>
                <div class="category-card">
                    <img src="https://images.unsplash.com/photo-1580894732444-8ecded7900cd?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="API Development">
                    <div class="category-card-content">
                        <h3>API Development</h3>
                        <p>Pengembangan API untuk aplikasi</p>
                        <div class="price">Mulai dari Rp 1.000.000</div>
                    </div>
                </div>
                <div class="category-card">
                    <img src="https://images.unsplash.com/photo-1504639725590-34d0984388bd?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="Database">
                    <div class="category-card-content">
                        <h3>Database Management</h3>
                        <p>Optimasi dan pengelolaan database</p>
                        <div class="price">Mulai dari Rp 500.000</div>
                    </div>
                </div>
            </div>
            
            <!-- Video Category -->
            <div class="category-grid" id="video-grid" style="display: none;">
                <div class="category-card">
                    <img src="https://images.unsplash.com/photo-1574717024653-61fd2cf4d44d?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="Video Editing">
                    <div class="category-card-content">
                        <h3>Video Editing</h3>
                        <p>Edit video profesional untuk kebutuhan bisnis</p>
                        <div class="price">Mulai dari Rp 200.000</div>
                    </div>
                </div>
                <div class="category-card">
                    <img src="https://images.unsplash.com/photo-1598300042247-d088f8ab3a91?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="Animation">
                    <div class="category-card-content">
                        <h3>Animation</h3>
                        <p>Animasi 2D dan 3D untuk berbagai keperluan</p>
                        <div class="price">Mulai dari Rp 800.000</div>
                    </div>
                </div>
                <div class="category-card">
                    <img src="https://images.unsplash.com/photo-1478737270239-2f02b77fc618?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="Voice Over">
                    <div class="category-card-content">
                        <h3>Voice Over</h3>
                        <p>Pengisi suara profesional untuk video</p>
                        <div class="price">Mulai dari Rp 100.000</div>
                    </div>
                </div>
                <div class="category-card">
                    <img src="https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="Music Production">
                    <div class="category-card-content">
                        <h3>Music Production</h3>
                        <p>Produksi musik dan audio berkualitas</p>
                        <div class="price">Mulai dari Rp 300.000</div>
                    </div>
                </div>
            </div>
            
            <!-- Marketing Category -->
            <div class="category-grid" id="marketing-grid" style="display: none;">
                <div class="category-card">
                    <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="SEO">
                    <div class="category-card-content">
                        <h3>SEO Optimization</h3>
                        <p>Optimasi website untuk mesin pencari</p>
                        <div class="price">Mulai dari Rp 500.000</div>
                    </div>
                </div>
                <div class="category-card">
                    <img src="https://images.unsplash.com/photo-1611224923853-80b023f02d71?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="Social Media">
                    <div class="category-card-content">
                        <h3>Social Media Marketing</h3>
                        <p>Kelola media sosial untuk bisnis Anda</p>
                        <div class="price">Mulai dari Rp 400.000</div>
                    </div>
                </div>
                <div class="category-card">
                    <img src="https://images.unsplash.com/photo-1432888498266-38ffec3eaf0a?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="Google Ads">
                    <div class="category-card-content">
                        <h3>Google Ads Management</h3>
                        <p>Kelola iklan Google untuk ROI maksimal</p>
                        <div class="price">Mulai dari Rp 600.000</div>
                    </div>
                </div>
                <div class="category-card">
                    <img src="https://images.unsplash.com/photo-1590479773265-7464e5d48118?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="Email Marketing">
                    <div class="category-card-content">
                        <h3>Email Marketing</h3>
                        <p>Kampanye email yang efektif dan terukur</p>
                        <div class="price">Mulai dari Rp 250.000</div>
                    </div>
                </div>
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
    // Category tabs functionality
    document.addEventListener('DOMContentLoaded', function() {
        const categoryTabs = document.querySelectorAll('.category-tab');
        const categoryGrids = document.querySelectorAll('.category-grid');
        
        categoryTabs.forEach(tab => {
            tab.addEventListener('click', function() {
                // Remove active class from all tabs
                categoryTabs.forEach(t => t.classList.remove('active'));
                
                // Add active class to clicked tab
                this.classList.add('active');
                
                // Hide all category grids
                categoryGrids.forEach(grid => {
                    grid.style.display = 'none';
                });
                
                // Show corresponding grid
                const category = this.getAttribute('data-category');
                const targetGrid = document.getElementById(category + '-grid');
                if (targetGrid) {
                    targetGrid.style.display = 'grid';
                }
            });
        });
        
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
        
        // Add scroll animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };
        
        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);
        
        // Observe elements for animation
        document.querySelectorAll('.category-card, .feature-card, .testimonial-card').forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(20px)';
            el.style.transition = 'all 0.6s ease';
            observer.observe(el);
        });
    });
</script>

@endsection