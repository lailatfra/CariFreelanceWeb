@extends('layouts.app')
@section('title', 'Foto-foto - CariFreelance')
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
        background-color: #f8f9fa;
    }

    /* Header Section */
    .page-header {
        background: linear-gradient(135deg, #00B894 0%, #00A085 50%, #008F75 100%);
        padding: 120px 0 80px;
        position: relative;
        overflow: hidden;
    }

    .page-header::before {
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

    .page-header .container {
        position: relative;
        z-index: 2;
    }

    .page-header h1 {
        font-size: 3rem;
        font-weight: 700;
        color: white;
        margin-bottom: 1rem;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
    }

    .page-header p {
        font-size: 1.2rem;
        color: white;
        opacity: 0.9;
        max-width: 600px;
        margin: 0 auto;
    }

    /* Gallery Section */
    .gallery-section {
        padding: 80px 0;
        background: white;
    }

    .section-title {
        text-align: center;
        margin-bottom: 50px;
    }

    .section-title h2 {
        font-size: 2.5rem;
        font-weight: 700;
        color: #333;
        margin-bottom: 15px;
    }

    .section-title p {
        font-size: 1.1rem;
        color: #666;
        max-width: 600px;
        margin: 0 auto;
    }

    /* Category Filters */
    .category-filters {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        gap: 15px;
        margin-bottom: 50px;
    }

    .filter-btn {
        background: white;
        border: 2px solid #00B894;
        color: #00B894;
        padding: 10px 25px;
        border-radius: 25px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
    }

    .filter-btn:hover,
    .filter-btn.active {
        background: #00B894;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,184,148,0.3);
    }

    /* Gallery Grid */
    .gallery-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 30px;
        margin-bottom: 50px;
    }

    .gallery-item {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
        cursor: pointer;
        position: relative;
    }

    .gallery-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0,184,148,0.2);
    }

    .gallery-item img {
        width: 100%;
        height: 250px;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .gallery-item:hover img {
        transform: scale(1.05);
    }

    .gallery-item-content {
        padding: 20px;
    }

    .gallery-item h3 {
        font-size: 1.2rem;
        font-weight: 600;
        color: #333;
        margin-bottom: 8px;
    }

    .gallery-item p {
        color: #666;
        font-size: 0.9rem;
        margin-bottom: 10px;
    }

    .gallery-item .category-tag {
        display: inline-block;
        background: #e8fdf7;
        color: #00B894;
        padding: 4px 12px;
        border-radius: 15px;
        font-size: 0.8rem;
        font-weight: 500;
    }

    /* Carousel Section */
    .carousel-section {
        padding: 80px 0;
        background: #f8f9fa;
    }

    .carousel-container {
        position: relative;
        overflow: hidden;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }

    .carousel-track {
        display: flex;
        transition: transform 0.5s ease;
    }

    .carousel-slide {
        min-width: 100%;
        position: relative;
    }

    .carousel-slide img {
        width: 100%;
        height: 500px;
        object-fit: cover;
    }

    .carousel-caption {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(transparent, rgba(0,0,0,0.7));
        color: white;
        padding: 40px 30px 30px;
    }

    .carousel-caption h3 {
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 8px;
    }

    .carousel-caption p {
        font-size: 1rem;
        opacity: 0.9;
    }

    .carousel-nav {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background: rgba(255,255,255,0.9);
        border: none;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        z-index: 10;
    }

    .carousel-nav:hover {
        background: white;
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    }

    .carousel-nav.prev {
        left: 20px;
    }

    .carousel-nav.next {
        right: 20px;
    }

    .carousel-nav i {
        font-size: 1.2rem;
        color: #00B894;
    }

    .carousel-dots {
        display: flex;
        justify-content: center;
        gap: 10px;
        margin-top: 20px;
    }

    .carousel-dot {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background: #ddd;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .carousel-dot.active {
        background: #00B894;
        transform: scale(1.2);
    }

    /* Modal */
    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.9);
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .modal.show {
        display: flex;
        opacity: 1;
        align-items: center;
        justify-content: center;
    }

    .modal-content {
        position: relative;
        max-width: 90%;
        max-height: 90%;
        transform: scale(0.8);
        transition: transform 0.3s ease;
    }

    .modal.show .modal-content {
        transform: scale(1);
    }

    .modal-content img {
        width: 100%;
        height: 100%;
        object-fit: contain;
        border-radius: 10px;
    }

    .modal-close {
        position: absolute;
        top: -40px;
        right: 0;
        color: white;
        font-size: 2rem;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .modal-close:hover {
        color: #00B894;
        transform: scale(1.1);
    }

    /* Statistics Section */
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

    /* Responsive Design */
    @media (max-width: 768px) {
        .page-header h1 {
            font-size: 2.5rem;
        }
        
        .gallery-grid {
            grid-template-columns: 1fr;
        }
        
        .category-filters {
            flex-direction: column;
            align-items: center;
        }
        
        .carousel-slide img {
            height: 300px;
        }
        
        .carousel-nav {
            width: 40px;
            height: 40px;
        }
    }

    /* Animation */
    .gallery-item {
        opacity: 0;
        transform: translateY(20px);
        animation: fadeInUp 0.6s ease forwards;
    }

    .gallery-item:nth-child(1) { animation-delay: 0.1s; }
    .gallery-item:nth-child(2) { animation-delay: 0.2s; }
    .gallery-item:nth-child(3) { animation-delay: 0.3s; }
    .gallery-item:nth-child(4) { animation-delay: 0.4s; }
    .gallery-item:nth-child(5) { animation-delay: 0.5s; }
    .gallery-item:nth-child(6) { animation-delay: 0.6s; }

    @keyframes fadeInUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<!-- Page Header -->
<section class="page-header">
    <div class="container">
        <div class="text-center">
            <h1>Galeri Foto CariFreelance</h1>
            <p>Koleksi hasil karya terbaik dari freelancer profesional kami yang telah dipercaya oleh ribuan klien</p>
        </div>
    </div>
</section>

<!-- Gallery Section -->
<section class="gallery-section">
    <div class="container">
        <div class="section-title">
            <h2>Portofolio Hasil Karya</h2>
            <p>Temukan inspirasi dari berbagai kategori layanan yang tersedia di platform kami</p>
        </div>

        <!-- Category Filters -->
        <div class="category-filters">
            <button class="filter-btn active" data-category="all">Semua</button>
            <button class="filter-btn" data-category="website">Website</button>
            <button class="filter-btn" data-category="design">Design</button>
            <button class="filter-btn" data-category="mobile">Mobile App</button>
            <button class="filter-btn" data-category="marketing">Marketing</button>
            <button class="filter-btn" data-category="video">Video</button>
        </div>

        <!-- Gallery Grid -->
        <div class="gallery-grid" id="galleryGrid">
            <!-- Website Category -->
            <div class="gallery-item" data-category="website">
                <img src="https://images.unsplash.com/photo-1498050108023-c5249f4df085?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="E-commerce Website">
                <div class="gallery-item-content">
                    <h3>E-commerce Modern</h3>
                    <p>Website toko online dengan desain modern dan fitur lengkap</p>
                    <span class="category-tag">Website</span>
                </div>
            </div>

            <div class="gallery-item" data-category="website">
                <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="Corporate Website">
                <div class="gallery-item-content">
                    <h3>Corporate Website</h3>
                    <p>Website perusahaan dengan tampilan profesional dan responsif</p>
                    <span class="category-tag">Website</span>
                </div>
            </div>

            <div class="gallery-item" data-category="website">
                <img src="https://images.unsplash.com/photo-1555066931-4365d14bab8c?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="Portfolio Website">
                <div class="gallery-item-content">
                    <h3>Portfolio Website</h3>
                    <p>Website portfolio dengan galeri interaktif dan animasi smooth</p>
                    <span class="category-tag">Website</span>
                </div>
            </div>

            <!-- Design Category -->
            <div class="gallery-item" data-category="design">
                <img src="https://images.unsplash.com/photo-1626785774573-4b799315345d?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="Logo Design">
                <div class="gallery-item-content">
                    <h3>Logo Design Premium</h3>
                    <p>Desain logo yang memorable dan mencerminkan identitas brand</p>
                    <span class="category-tag">Design</span>
                </div>
            </div>

            <div class="gallery-item" data-category="design">
                <img src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="UI/UX Design">
                <div class="gallery-item-content">
                    <h3>UI/UX Design</h3>
                    <p>Desain interface yang user-friendly dengan pengalaman optimal</p>
                    <span class="category-tag">Design</span>
                </div>
            </div>

            <div class="gallery-item" data-category="design">
                <img src="https://images.unsplash.com/photo-1493421419110-74f4e85ba126?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="Branding Package">
                <div class="gallery-item-content">
                    <h3>Branding Package</h3>
                    <p>Paket branding lengkap dengan konsep visual yang konsisten</p>
                    <span class="category-tag">Design</span>
                </div>
            </div>

            <!-- Mobile App Category -->
            <div class="gallery-item" data-category="mobile">
                <img src="https://images.unsplash.com/photo-1512941937669-90a1b58e7e9c?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="Mobile App">
                <div class="gallery-item-content">
                    <h3>Mobile App iOS</h3>
                    <p>Aplikasi mobile dengan design modern dan performa optimal</p>
                    <span class="category-tag">Mobile App</span>
                </div>
            </div>

            <div class="gallery-item" data-category="mobile">
                <img src="https://images.unsplash.com/photo-1551650975-87deedd944c3?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="Android App">
                <div class="gallery-item-content">
                    <h3>Android App</h3>
                    <p>Aplikasi Android dengan fitur lengkap dan interface intuitif</p>
                    <span class="category-tag">Mobile App</span>
                </div>
            </div>

            <!-- Marketing Category -->
            <div class="gallery-item" data-category="marketing">
                <img src="https://images.unsplash.com/photo-1542744173-8e7e53415bb0?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="Social Media Design">
                <div class="gallery-item-content">
                    <h3>Social Media Design</h3>
                    <p>Desain konten media sosial yang engaging dan on-brand</p>
                    <span class="category-tag">Marketing</span>
                </div>
            </div>

            <div class="gallery-item" data-category="marketing">
                <img src="https://images.unsplash.com/photo-1432888498266-38ffec3eaf0a?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="Marketing Campaign">
                <div class="gallery-item-content">
                    <h3>Marketing Campaign</h3>
                    <p>Kampanye marketing digital yang efektif dan terukur</p>
                    <span class="category-tag">Marketing</span>
                </div>
            </div>

            <!-- Video Category -->
            <div class="gallery-item" data-category="video">
                <img src="https://images.unsplash.com/photo-1574717024653-61fd2cf4d44d?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="Video Production">
                <div class="gallery-item-content">
                    <h3>Video Production</h3>
                    <p>Produksi video berkualitas tinggi untuk kebutuhan promosi</p>
                    <span class="category-tag">Video</span>
                </div>
            </div>

            <div class="gallery-item" data-category="video">
                <img src="https://images.unsplash.com/photo-1598300042247-d088f8ab3a91?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="Animation">
                <div class="gallery-item-content">
                    <h3>Animation Video</h3>
                    <p>Video animasi yang menarik dan mudah dipahami</p>
                    <span class="category-tag">Video</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Carousel Section -->
<section class="carousel-section">
    <div class="container">
        <div class="section-title">
            <h2>Showcase Terbaik</h2>
            <p>Karya-karya pilihan terbaik dari freelancer profesional kami</p>
        </div>

        <div class="carousel-container">
            <div class="carousel-track" id="carouselTrack">
                <div class="carousel-slide">
                    <img src="https://images.unsplash.com/photo-1551650975-87deedd944c3?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80" alt="Showcase 1">
                    <div class="carousel-caption">
                        <h3>Aplikasi E-learning Interaktif</h3>
                        <p>Platform pembelajaran online dengan fitur video call dan quiz interaktif</p>
                    </div>
                </div>
                <div class="carousel-slide">
                    <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80" alt="Showcase 2">
                    <div class="carousel-caption">
                        <h3>Dashboard Analytics</h3>
                        <p>Dashboard business intelligence dengan visualisasi data yang komprehensif</p>
                    </div>
                </div>
                <div class="carousel-slide">
                    <img src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80" alt="Showcase 3">
                    <div class="carousel-caption">
                        <h3>Brand Identity Design</h3>
                        <p>Desain identitas brand yang konsisten dan memorable untuk startup teknologi</p>
                    </div>
                </div>
                <div class="carousel-slide">
                    <img src="https://images.unsplash.com/photo-1572044162444-ad60f128bdea?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80" alt="Showcase 4">
                    <div class="carousel-caption">
                        <h3>Marketing Campaign</h3>
                        <p>Kampanye digital marketing yang berhasil meningkatkan engagement 300%</p>
                    </div>
                </div>
            </div>
            <button class="carousel-nav prev" onclick="moveSlide(-1)">
                <i class="fas fa-chevron-left"></i>
            </button>
            <button class="carousel-nav next" onclick="moveSlide(1)">
                <i class="fas fa-chevron-right"></i>
            </button>
        </div>
        
        <div class="carousel-dots" id="carouselDots"></div>
    </div>
</section>



<!-- Modal -->
<div class="modal" id="imageModal">
    <div class="modal-content">
        <span class="modal-close">&times;</span>
        <img id="modalImage" src="" alt="">
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Gallery Filter Functionality
    const filterBtns = document.querySelectorAll('.filter-btn');
    const galleryItems = document.querySelectorAll('.gallery-item');
    
    filterBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            // Remove active class from all buttons
            filterBtns.forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            
            const category = this.getAttribute('data-category');
            
            galleryItems.forEach(item => {
                if (category === 'all' || item.getAttribute('data-category') === category) {
                    item.style.display = 'block';
                    item.style.animation = 'fadeInUp 0.6s ease forwards';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });
    
    // Modal Functionality
    const modal = document.getElementById('imageModal');
    const modalImage = document.getElementById('modalImage');
    const modalClose = document.querySelector('.modal-close');
    
    galleryItems.forEach(item => {
        item.addEventListener('click', function() {
            const img = this.querySelector('img');
            modalImage.src = img.src;
            modal.classList.add('show');
        });
    });
    
    modalClose.addEventListener('click', function() {
        modal.classList.remove('show');
    });
    
    modal.addEventListener('click', function(e) {
        if (e.target === modal) {
            modal.classList.remove('show');
        }
    });
    
    // Carousel Functionality
    let currentSlide = 0;
    const slides = document.querySelectorAll('.carousel-slide');
    const totalSlides = slides.length;
    const carouselTrack = document.getElementById('carouselTrack');
    const carouselDots = document.getElementById('carouselDots');
    
    // Create dots
    for (let i = 0; i < totalSlides; i++) {
        const dot = document.createElement('div');
        dot.classList.add('carousel-dot');
        if (i === 0) dot.classList.add('active');
        dot.addEventListener('click', () => goToSlide(i));
        carouselDots.appendChild(dot);
    }
    
    function updateCarousel() {
        const translateX = -currentSlide * 100;
        carouselTrack.style.transform = `translateX(${translateX}%)`;
        
        // Update dots
        document.querySelectorAll('.carousel-dot').forEach((dot, index) => {
            dot.classList.toggle('active', index === currentSlide);
        });
    }
    
    function moveSlide(direction) {
        currentSlide += direction;
        if (currentSlide >= totalSlides) currentSlide = 0;
        if (currentSlide < 0) currentSlide = totalSlides - 1;
        updateCarousel();
    }
    
    function goToSlide(index) {
        currentSlide = index;
        updateCarousel();
    }
    
    // Auto-play carousel
    setInterval(() => {
        moveSlide(1);
    }, 5000);
    
    // Touch/swipe support for mobile
    let startX = 0;
    let endX = 0;
    
    carouselTrack.addEventListener('touchstart', (e) => {
        startX = e.touches[0].clientX;
    });
    
    carouselTrack.addEventListener('touchend', (e) => {
        endX = e.changedTouches[0].clientX;
        handleSwipe();
    });
    
    function handleSwipe() {
        const threshold = 50;
        const diff = startX - endX;
        
        if (Math.abs(diff) > threshold) {
            if (diff > 0) {
                moveSlide(1); // Swipe left - next slide
            } else {
                moveSlide(-1); // Swipe right - previous slide
            }
        }
    }
    
    // Keyboard navigation
    document.addEventListener('keydown', (e) => {
        if (e.key === 'ArrowLeft') moveSlide(-1);
        if (e.key === 'ArrowRight') moveSlide(1);
        if (e.key === 'Escape') modal.classList.remove('show');
    });
    
    // Smooth scroll animation observer
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
    document.querySelectorAll('.section-title, .stat-card').forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(20px)';
        el.style.transition = 'all 0.6s ease';
        observer.observe(el);
    });
});

// Global function for carousel navigation buttons
function moveSlide(direction) {
    const event = new CustomEvent('carouselMove', { detail: { direction } });
    document.dispatchEvent(event);
}

// Listen for carousel move events
document.addEventListener('carouselMove', (e) => {
    const direction = e.detail.direction;
    let currentSlide = parseInt(document.getElementById('carouselTrack').getAttribute('data-current') || '0');
    const totalSlides = document.querySelectorAll('.carousel-slide').length;
    
    currentSlide += direction;
    if (currentSlide >= totalSlides) currentSlide = 0;
    if (currentSlide < 0) currentSlide = totalSlides - 1;
    
    const translateX = -currentSlide * 100;
    document.getElementById('carouselTrack').style.transform = `translateX(${translateX}%)`;
    document.getElementById('carouselTrack').setAttribute('data-current', currentSlide);
    
    // Update dots
    document.querySelectorAll('.carousel-dot').forEach((dot, index) => {
        dot.classList.toggle('active', index === currentSlide);
    });
});
</script>
@endsection