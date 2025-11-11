@extends('client.layout.client-layout')
@section('title', 'Dokumen & PPT - CariFreelance')
@section('content')

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dokumen & PPT - CariFreelance</title>
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
            background-color: #f8f9fa;
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
                url('https://images.unsplash.com/photo-1586281380349-632531db7ed4?w=1920&h=1080&fit=crop&crop=center') center/cover;
            min-height: 350px;
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
            padding: 60px 20px;
            text-align: center;
            position: relative;
            z-index: 2;
        }

        .hero h1 {
            font-size: 3rem;
            font-weight: 700;
            color: white;
            margin-bottom: 15px;
            animation: slideInDown 1s ease-out;
        }

        .hero p {
            font-size: 1.2rem;
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 30px;
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

        /* Main Layout Container */
        .main-layout {
            display: flex;
            max-width: 1400px;
            margin: 20px auto;
            gap: 25px;
            padding: 0 20px;
            min-height: calc(100vh - 400px);
        }

        /* Sidebar */
        .sidebar {
            width: 280px;
            background: white;
            border-radius: 15px;
            padding: 25px 20px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            height: fit-content;
            position: sticky;
            top: 80px;
        }

        .sidebar-title {
            font-size: 1.3rem;
            font-weight: 700;
            color: #333;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .sidebar-title::before {
            content: '▼';
            color: #1DA1F2;
            font-size: 0.8rem;
        }

        .sidebar-menu {
            list-style: none;
        }

        .sidebar-item {
            margin-bottom: 6px;
        }

        .sidebar-link {
            display: block;
            padding: 12px 15px;
            color: #666;
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.3s ease;
            font-weight: 500;
            font-size: 14px;
        }

        .sidebar-link:hover,
        .sidebar-link.active {
            background: linear-gradient(135deg, #1DA1F2, #0d7ac9);
            color: white;
            transform: translateX(5px);
        }

        /* Main Content Area */
        .content-area {
            flex: 1;
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }

        .content-header {
            margin-bottom: 25px;
        }

        .content-title {
            font-size: 2rem;
            font-weight: 700;
            color: #333;
            margin-bottom: 8px;
        }

        .content-subtitle {
            color: #666;
            font-size: 1rem;
        }

        /* Categories Grid - 2x2 Layout */
        .categories-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 18px;
            margin-bottom: 35px;
        }

        .category-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            cursor: pointer;
            position: relative;
            height: 170px;
            border: 1px solid #e9ecef;
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
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(29, 161, 242, 0.2);
        }

        .category-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .category-card:hover .category-image {
            transform: scale(1.05);
        }

        .category-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(transparent, rgba(0,0,0,0.7));
            padding: 18px;
            z-index: 2;
        }

        .category-title {
            color: white;
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 4px;
            text-shadow: 0 2px 10px rgba(0,0,0,0.5);
        }

        .category-description {
            color: rgba(255, 255, 255, 0.9);
            font-size: 0.85rem;
            text-shadow: 0 2px 10px rgba(0,0,0,0.5);
        }

        .category-link {
            display: block;
            width: 100%;
            height: 100%;
            text-decoration: none;
            color: inherit;
            position: relative;
        }

        /* Load More Section */
        .load-more-section {
            text-align: center;
            margin-top: 35px;
            padding-top: 25px;
            border-top: 1px solid #e9ecef;
        }

        .load-more-btn {
            display: inline-block;
            padding: 12px 28px;
            background: linear-gradient(135deg, #1DA1F2, #0d7ac9);
            color: white;
            text-decoration: none;
            border-radius: 25px;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }

        .load-more-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(29, 161, 242, 0.3);
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .main-layout {
                flex-direction: column;
                margin: 15px auto;
                padding: 0 15px;
                gap: 20px;
            }

            .sidebar {
                width: 100%;
                order: 2;
                position: static;
                padding: 20px 15px;
            }

            .content-area {
                order: 1;
                padding: 25px;
            }

            .categories-grid {
                grid-template-columns: 1fr;
                gap: 15px;
            }

            .category-card {
                height: 160px;
            }

            .nav-list {
                gap: 10px;
            }

            .nav-item {
                padding: 8px 15px;
            }
        }

        @media (max-width: 768px) {
            .hero h1 {
                font-size: 2.2rem;
            }
            
            .hero p {
                font-size: 1rem;
            }
            
            .nav-list {
                padding: 6px 0;
                gap: 8px;
            }

            .nav-item {
                padding: 8px 12px;
                min-height: 35px;
            }

            .nav-link {
                font-size: 14px;
            }
            
            .content-title {
                font-size: 1.7rem;
            }

            .main-layout {
                margin: 10px auto;
                padding: 0 10px;
            }

            .content-area {
                padding: 20px;
            }

            .sidebar {
                padding: 18px 15px;
                top: 125px;
            }

            .sidebar-title {
                font-size: 1.2rem;
            }

            .hero {
                min-height: 300px;
            }

            .hero-content {
                padding: 50px 15px;
            }
        }

        /* Scroll animations */
        .animate-on-scroll {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.6s ease;
        }

        .animate-on-scroll.animated {
            opacity: 1;
            transform: translateY(0);
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

        /* Navigation enhancement for sticky behavior */
        .nav-container.sticky {
            position: fixed;
            top: 60px;
            left: 0;
            right: 0;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }
    </style>
</head>
<body>
    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h1>Dokumen & PPT</h1>
            <p>Layanan profesional untuk pembuatan dokumen bisnis dan presentasi PowerPoint yang menarik</p>
        </div>
    </section>

    <!-- Navigation -->
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


    <!-- Main Layout -->
    <div class="main-layout">
        <!-- Sidebar -->
<!-- Sidebar -->
<aside class="sidebar">
    <div class="sidebar-title">Dokumen & PPT</div>
    <ul class="sidebar-menu">
        <li class="sidebar-item">
            <a href="#" class="sidebar-link" onclick="filterCategory('presentasi')">
                Desain Presentasi
            </a>
        </li>
        <li class="sidebar-item">
            <a href="#" class="sidebar-link" onclick="filterCategory('format-dokumen')">
                Format Dokumen
            </a>
        </li>
    </ul>
</aside>

        <!-- Main Content Area -->
        <main class="content-area">
            <div class="content-header">
                <h2 class="content-title">Dokumen & PPT</h2>
                <p class="content-subtitle">Solusi lengkap untuk kebutuhan dokumen bisnis dan presentasi profesional Anda</p>
            </div>

            <!-- First Row of Categories -->
            <div class="categories-grid animate-on-scroll">
                <div class="category-card" onclick="navigateToCategory('business-plan')">
                    <a href="#" class="category-link">
                        <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=500&h=300&fit=crop" alt="Business Plan" class="category-image">
                        <div class="category-overlay">
                            <h3 class="category-title">Desain Presentasi</h3>
                            <p class="category-description">Slide presentasi yang menarik dan profesional</p>
                        </div>
                    </a>
                </div>

                <div class="category-card" onclick="navigateToCategory('cv-resume')">
                    <a href="#" class="category-link">
                        <img src="https://images.unsplash.com/photo-1586281380349-632531db7ed4?w=500&h=300&fit=crop" alt="CV & Resume" class="category-image">
                        <div class="category-overlay">
                            <h3 class="category-title">Format Dokumen</h3>
                            <p class="category-description">Dokumen rapi, konsisten, dan siap digunakan secara profesional</p>
                        </div>
                    </a>
                </div>
            </div>
            </div>
        </main>
    </div>

    <script>
        // Navigation functionality
        document.querySelectorAll('.nav-item').forEach(item => {
            item.addEventListener('click', function() {
                document.querySelectorAll('.nav-item').forEach(nav => nav.classList.remove('active'));
                this.classList.add('active');
            });
        });

        // Enhanced sticky navigation
        window.addEventListener('scroll', function() {
            const navigation = document.getElementById('navigation');
            const scrollPosition = window.scrollY;
            
            if (scrollPosition > 100) {
                navigation.classList.add('scrolled');
            } else {
                navigation.classList.remove('scrolled');
            }
        });

        // Sidebar filtering
        function filterCategory(category) {
            // Remove active class from all sidebar links
            document.querySelectorAll('.sidebar-link').forEach(link => {
                link.classList.remove('active');
            });
            
            // Add active class to clicked link
            event.target.classList.add('active');
            
            console.log(`Filtering by ${category} category`);
            // Add your filtering logic here
        }

        // Category navigation function
        function navigateToCategory(category) {
            console.log(`Navigating to ${category} category`);
            // You can replace this with actual navigation
            // window.location.href = `/category/${category}`;
        }

        // Load more categories
        function loadMoreCategories() {
            console.log('Loading more categories...');
            // Add logic to load more categories
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
    </script>
</body>
</html>

@endsection