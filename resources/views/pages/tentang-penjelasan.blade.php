@extends('layouts.app')
@section('title', 'Tentang Kami - CariFreelance')
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
    .hero-about {
        background: linear-gradient(135deg, #00B894 0%, #00A085 50%, #008F75 100%);
        min-height: 60vh;
        display: flex;
        align-items: center;
        position: relative;
        overflow: hidden;
        padding-top: 100px;
        z-index: 1;
    }

    .hero-about::before {
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
        text-align: center;
    }

    .hero-about h1 {
        font-size: 3rem;
        font-weight: 700;
        margin-bottom: 1rem;
        color: white;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
    }

    .hero-about p {
        font-size: 1.2rem;
        color: white;
        opacity: 0.9;
        max-width: 600px;
        margin: 0 auto;
    }

    /* Story Section */
    .story-section {
        padding: 80px 0;
        background: white;
        position: relative;
        z-index: 2;
    }

    .story-content {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 60px;
        align-items: center;
    }

    .story-text h2 {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 30px;
        color: #333;
    }

    .story-text p {
        font-size: 1.1rem;
        color: #666;
        margin-bottom: 25px;
        line-height: 1.8;
    }

    .story-image {
        position: relative;
        overflow: hidden;
        border-radius: 15px;
        box-shadow: 0 15px 30px rgba(0,184,148,0.2);
    }

    .story-image img {
        width: 100%;
        height: 400px;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .story-image:hover img {
        transform: scale(1.05);
    }

    /* Mission Vision Section */
    .mission-vision {
        padding: 80px 0;
        background: #f8f9fa;
        position: relative;
        z-index: 2;
    }

    .mission-vision-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
        gap: 40px;
        margin-top: 3rem;
    }

    .mission-card, .vision-card {
        background: white;
        padding: 40px;
        border-radius: 15px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .mission-card::before, .vision-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 5px;
        background: linear-gradient(135deg, #00B894 0%, #00A085 100%);
    }

    .mission-card:hover, .vision-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(0,184,148,0.2);
    }

    .mission-card h3, .vision-card h3 {
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 20px;
        color: #333;
        display: flex;
        align-items: center;
    }

    .mission-card .icon, .vision-card .icon {
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, #00B894 0%, #00A085 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 15px;
        font-size: 1.2rem;
        color: white;
    }

    /* What Makes Us Different Section */
    .different-section {
        padding: 80px 0;
        background: white;
        position: relative;
        z-index: 2;
    }

    .different-content {
        text-align: center;
        margin-bottom: 50px;
    }

    .different-content h2 {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 20px;
        color: #333;
    }

    .different-content p {
        font-size: 1.1rem;
        color: #666;
        max-width: 800px;
        margin: 0 auto;
    }

    .different-features {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 30px;
        margin-top: 3rem;
    }

    .different-card {
        background: #f8f9fa;
        padding: 30px;
        border-radius: 15px;
        text-align: center;
        transition: all 0.3s ease;
        border: 2px solid transparent;
    }

    .different-card:hover {
        background: white;
        border-color: #00B894;
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0,184,148,0.15);
    }

    .different-card .feature-icon {
        width: 70px;
        height: 70px;
        background: linear-gradient(135deg, #00B894 0%, #00A085 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        font-size: 1.5rem;
        color: white;
    }

    .different-card h4 {
        font-size: 1.2rem;
        font-weight: 600;
        margin-bottom: 15px;
        color: #333;
    }

    .different-card p {
        color: #666;
        font-size: 0.95rem;
        line-height: 1.6;
    }

    /* Team Section */
    .team-section {
        padding: 80px 0;
        background: #f8f9fa;
        position: relative;
        z-index: 2;
    }

    .team-content {
        text-align: center;
        margin-bottom: 50px;
    }

    .team-content h2 {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 20px;
        color: #333;
    }

    .team-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 30px;
        margin-top: 3rem;
    }

    .team-card {
        background: white;
        border-radius: 15px;
        padding: 30px;
        text-align: center;
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
    }

    .team-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(0,184,148,0.2);
    }

    .team-avatar {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #00B894 0%, #00A085 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        font-size: 2rem;
        color: white;
        font-weight: 600;
    }

    .team-card h4 {
        font-size: 1.2rem;
        font-weight: 600;
        margin-bottom: 5px;
        color: #333;
    }

    .team-card .position {
        color: #00B894;
        font-size: 0.9rem;
        margin-bottom: 15px;
    }

    .team-card p {
        color: #666;
        font-size: 0.9rem;
        line-height: 1.6;
    }

    /* CTA Section */
    .cta-section {
        padding: 80px 0;
        background: white;
        text-align: center;
        position: relative;
        z-index: 2;
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
        .hero-about h1 {
            font-size: 2.5rem;
        }
        
        .story-content {
            grid-template-columns: 1fr;
            gap: 40px;
        }
        
        .mission-vision-grid {
            grid-template-columns: 1fr;
        }
        
        .story-text h2,
        .different-content h2,
        .team-content h2,
        .cta-content h2 {
            font-size: 2rem;
        }
        
        .cta-buttons {
            flex-direction: column;
            align-items: center;
        }
    }

    /* Animation Classes */
    .fade-in-up {
        opacity: 0;
        transform: translateY(30px);
        transition: all 0.8s ease;
    }

    .fade-in-up.animate {
        opacity: 1;
        transform: translateY(0);
    }

    .fade-in-left {
        opacity: 0;
        transform: translateX(-30px);
        transition: all 0.8s ease;
    }

    .fade-in-left.animate {
        opacity: 1;
        transform: translateX(0);
    }

    .fade-in-right {
        opacity: 0;
        transform: translateX(30px);
        transition: all 0.8s ease;
    }

    .fade-in-right.animate {
        opacity: 1;
        transform: translateX(0);
    }

    .scale-in {
        opacity: 0;
        transform: scale(0.8);
        transition: all 0.8s ease;
    }

    .scale-in.animate {
        opacity: 1;
        transform: scale(1);
    }
</style>

<!-- Hero Section -->
<section class="hero-about">
    <div class="container">
        <div class="hero-content">
            <h1 class="fade-in-up">CariFreelance — Platform Freelancer Lokal Terpercaya</h1>
            <p class="fade-in-up">Menghubungkan talenta terbaik Indonesia dengan proyek-proyek berkualitas untuk memajukan ekonomi digital tanah air</p>
        </div>
    </div>
</section>

<!-- Story Section -->
<section class="story-section">
    <div class="container">
        <div class="story-content">
            <div class="story-text fade-in-left">
                <h2>Cerita Kami</h2>
                <p>CariFreelance adalah platform freelance profesional karya anak bangsa yang hadir untuk memudahkan kolaborasi antara pelaku bisnis, UMKM, startup, dan individu dengan para freelancer berbakat di Indonesia.</p>
                <p>Platform ini dikembangkan oleh 3 siswa berbakat dari SMK Negeri 4 Malang yang memiliki visi untuk memajukan ekonomi digital Indonesia dan memberdayakan talenta lokal.</p>
                <p>Melalui website ini, kamu bisa mencari jasa atau menawarkan keahlian secara mudah, cepat, dan aman tanpa ribet.</p>
                <p>Dari desain grafis seperti jasa desain logo, banner, kemasan produk, hingga jasa penulisan artikel, penerjemahan, pemasaran digital, entri data, editing video, hingga pengembangan website dan aplikasi — semua bisa kamu temukan di satu tempat.</p>
            </div>
            <div class="story-image fade-in-right">
                <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Tim CariFreelance">
            </div>
        </div>
    </div>
</section>

<!-- Mission & Vision Section -->
<section class="mission-vision">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fade-in-up">Misi & Visi Kami</h2>
            <p class="lead text-muted fade-in-up">Fondasi yang menguatkan langkah kami dalam membangun ekosistem freelance terbaik</p>
        </div>
        
        <div class="mission-vision-grid">
            <div class="mission-card fade-in-left">
                <h3>
                    <div class="icon">
                        <i class="fas fa-bullseye"></i>
                    </div>
                    Misi Kami
                </h3>
                <p>Menciptakan platform yang menghubungkan talenta lokal terbaik dengan peluang kerja yang berkualitas, mendorong pertumbuhan ekonomi digital Indonesia, dan memberdayakan freelancer untuk mencapai potensi maksimal mereka.</p>
            </div>
            
            <div class="vision-card fade-in-right">
                <h3>
                    <div class="icon">
                        <i class="fas fa-eye"></i>
                    </div>
                    Visi Kami
                </h3>
                <p>Menjadi platform freelance nomor satu di Indonesia yang terpercaya, inovatif, dan berkelanjutan, serta menjadi jembatan utama antara talenta lokal dan peluang global dalam era ekonomi digital.</p>
            </div>
        </div>
    </div>
</section>

<!-- What Makes Us Different Section -->
<section class="different-section">
    <div class="container">
        <div class="different-content fade-in-up">
            <h2>Apa yang Membuat CariFreelance Berbeda?</h2>
            <p>Kami menghadirkan platform dengan sistem yang ramah pengguna, baik untuk klien maupun freelancer:</p>
        </div>
        
        <div class="different-features">
            <div class="different-card fade-in-up">
                <div class="feature-icon">
                    <i class="fas fa-search"></i>
                </div>
                <h4>Posting & Temukan Proyek</h4>
                <p>Posting dan temukan proyek dengan cepat. Pembayaran aman dan transparan untuk semua pihak.</p>
            </div>
            
            <div class="different-card fade-in-up">
                <div class="feature-icon">
                    <i class="fas fa-comments"></i>
                </div>
                <h4>Chat Langsung</h4>
                <p>Chat langsung & pengelolaan proyek di satu dashboard yang mudah digunakan dan intuitif.</p>
            </div>
            
            <div class="different-card fade-in-up">
                <div class="feature-icon">
                    <i class="fas fa-briefcase"></i>
                </div>
                <h4>Kerja Fleksibel</h4>
                <p>Dukungan kerja fleksibel: kerja remote, part time, atau sampingan sesuai kebutuhan Anda.</p>
            </div>
            
            <div class="different-card fade-in-up">
                <div class="feature-icon">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <h4>Keamanan Terjamin</h4>
                <p>Sistem keamanan berlapis dengan verifikasi identitas dan jaminan pembayaran yang aman.</p>
            </div>
            
            <div class="different-card fade-in-up">
                <div class="feature-icon">
                    <i class="fas fa-star"></i>
                </div>
                <h4>Freelancer Terverifikasi</h4>
                <p>Semua freelancer telah melalui proses verifikasi ketat untuk memastikan kualitas layanan.</p>
            </div>
            
            <div class="different-card fade-in-up">
                <div class="feature-icon">
                    <i class="fas fa-headset"></i>
                </div>
                <h4>Support 24/7</h4>
                <p>Tim customer service profesional siap membantu Anda kapan saja dengan respons cepat.</p>
            </div>
        </div>
    </div>
</section>

<!-- Team Section -->
<section class="team-section">
    <div class="container">
        <div class="team-content fade-in-up">
            <h2>Tim Kami</h2>
            <p class="lead text-muted">Berkenalan dengan tim berpengalaman yang berdedikasi membangun platform terbaik untuk Anda</p>
        </div>
        
        <div class="team-grid">
            <div class="team-card scale-in">
                <div class="team-avatar">A</div>
                <h4>Ahmad Rizky</h4>
                <div class="position">Founder & CEO</div>
                <p>Visioner di balik CariFreelance dengan pengalaman 10+ tahun di industri teknologi dan startup.</p>
            </div>
            
            <div class="team-card scale-in">
                <div class="team-avatar">S</div>
                <h4>Sari Indah</h4>
                <div class="position">Head of Product</div>
                <p>Ahli UX/UI yang memastikan platform kami mudah digunakan dan memberikan pengalaman terbaik.</p>
            </div>
            
            <div class="team-card scale-in">
                <div class="team-avatar">B</div>
                <h4>Budi Santoso</h4>
                <div class="position">Head of Technology</div>
                <p>Lead developer yang membangun infrastruktur teknologi yang solid dan scalable.</p>
            </div>
            
            <div class="team-card scale-in">
                <div class="team-avatar">D</div>
                <h4>Dewi Lestari</h4>
                <div class="position">Head of Marketing</div>
                <p>Strategis marketing yang membantu menghubungkan freelancer dengan klien potensial.</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section">
    <div class="container">
        <div class="cta-content fade-in-up">
            <h2>Bergabunglah dengan CariFreelance</h2>
            <p>Mulai perjalanan Anda bersama ribuan freelancer dan klien yang telah mempercayai platform kami</p>
            <div class="cta-buttons">
                <a href="#" class="btn-primary-custom">Mulai Sebagai Klien</a>
                <a href="#" class="btn-secondary-custom">Daftar Sebagai Freelancer</a>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Intersection Observer for animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate');
                }
            });
        }, observerOptions);

        // Observe all animated elements
        document.querySelectorAll('.fade-in-up, .fade-in-left, .fade-in-right, .scale-in').forEach(el => {
            observer.observe(el);
        });

        // Smooth scrolling for anchor links
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

        // Add staggered animation delay for grid items
        document.querySelectorAll('.different-features .different-card').forEach((card, index) => {
            card.style.transitionDelay = `${index * 0.1}s`;
        });

        document.querySelectorAll('.team-grid .team-card').forEach((card, index) => {
            card.style.transitionDelay = `${index * 0.15}s`;
        });

        // Hover effects for cards
        document.querySelectorAll('.different-card, .team-card, .mission-card, .vision-card').forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-10px) scale(1.02)';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0) scale(1)';
            });
        });

        // Add loading animation for images
        document.querySelectorAll('img').forEach(img => {
            img.addEventListener('load', function() {
                this.style.opacity = '1';
            });
        });

        // Add typing effect for hero title (optional)
        function typeWriter(element, text, speed = 100) {
            let i = 0;
            element.innerHTML = '';
            function type() {
                if (i < text.length) {
                    element.innerHTML += text.charAt(i);
                    i++;
                    setTimeout(type, speed);
                }
            }
            type();
        }

        // Initialize typing effect for hero title
        setTimeout(() => {
            const heroTitle = document.querySelector('.hero-about h1');
            if (heroTitle) {
                const originalText = heroTitle.textContent;
                typeWriter(heroTitle, originalText, 50);
            }
        }, 500);
    });
</script>

@endsection