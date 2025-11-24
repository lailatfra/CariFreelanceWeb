@extends('freelancer.layout.freelancer-layout')
@section('title', 'Website Development - CariFreelance Freelancer')
@section('content')
    
    <!DOCTYPE html>
    <html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Jasa Pembuatan Website Terbaik dan Profesional - CariFreelance</title>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
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

/* Navigation Categories - Same as Home Page */
.nav-container {
    background: white;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    position: sticky;
    top: -1px;
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
    gap: 90px; /* Same large gap as home page */
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

/* Responsive - same as home page */
@media (max-width: 1024px) {
    .nav {
        padding: 0 15px;
        justify-content: flex-start;
    }
    
    .nav-list {
        justify-content: flex-start;
        gap: 15px;
    }
}

@media (max-width: 768px) {
    .nav-container {
        top: 56px;
    }

    .nav {
        padding: 0 10px;
    }

    .nav-list {
        gap: 10px;
        padding: 6px 0;
        justify-content: flex-start;
    }

    .nav-item {
        padding: 8px 12px;
        min-height: 36px;
    }

    .nav-link {
        font-size: 14px;
    }
}
            /* Breadcrumb */
            .breadcrumb {
                background: #f8f9fa;
                padding: 15px 0;
                border-bottom: 1px solid #e9ecef;
            }

            .breadcrumb-container {
                max-width: 1400px;
                margin: 0;
                margin-left: 5px;
                padding: 0 20px;
                display: flex;
                align-items: center;
                gap: 8px;
                font-size: 14px;
                color: #666;
                flex-wrap: wrap;
            }

            .breadcrumb-link {
                color: #1DA1F2;
                text-decoration: none;
                transition: all 0.3s ease;
                font-weight: 500;
            }

            .breadcrumb-link:hover {
                text-decoration: underline;
            }

            .breadcrumb-current {
                background: transparent;
                color: #666;
                padding: 4px 0;
                border-radius: 0;
                font-weight: 600;
            }

            .breadcrumb-separator {
                color: #999;
                font-weight: normal;
            }

            /* Main Content */
            .main-container {
                max-width: 1400px;
                margin: 0 auto;
                padding: 0 20px;
            }

            .page-title {
                font-size: 2rem;
                font-weight: 700;
                color: #333;
                margin: 30px 0 20px 0;
            }

            /* Category Filters */
            .category-filters {
                display: flex;
                flex-wrap: wrap;
                gap: 10px;
                margin-bottom: 20px;
            }

            .filter-btn {
                padding: 8px 16px;
                border: 1px solid #ddd;
                border-radius: 20px;
                background: white;
                color: #666;
                font-size: 14px;
                cursor: pointer;
                transition: all 0.3s ease;
                white-space: nowrap;
            }

            .filter-btn.active {
                background: #1DA1F2;
                color: white;
                border-color: #1DA1F2;
            }

            .filter-btn:hover {
                border-color: #1DA1F2;
                color: #1DA1F2;
            }

            .filter-btn.strikethrough {
                text-decoration: line-through;
                color: #999;
            }

            /* Action Bar */
            .action-bar {
                display: flex;
                justify-content: space-between;
                align-items: center;
                flex-wrap: wrap;
                gap: 15px;
                margin-bottom: 25px;
            }

            .filter-controls {
                display: flex;
                gap: 10px;
                flex-wrap: wrap;
            }

            .control-btn {
                display: flex;
                align-items: center;
                gap: 6px;
                padding: 8px 16px;
                border: 1px solid #ddd;
                border-radius: 6px;
                background: white;
                color: #666;
                font-size: 14px;
                cursor: pointer;
                transition: all 0.3s ease;
            }

            .control-btn:hover {
                border-color: #1DA1F2;
                color: #1DA1F2;
            }

            .control-btn.sort-btn {
                color: #1DA1F2;
                border-color: #1DA1F2;
            }

            .post-job-btn {
                background: #1DA1F2;
                color: white;
                padding: 10px 20px;
                border: none;
                border-radius: 6px;
                font-weight: 600;
                font-size: 14px;
                cursor: pointer;
                transition: all 0.3s ease;
                white-space: nowrap;
            }

            .post-job-btn:hover {
                background: #0d7ac9;
                transform: translateY(-1px);
            }

            /* Stats Bar */
            .stats-bar {
                display: flex;
                justify-content: space-between;
                align-items: center;
                font-size: 12px;
                color: #666;
                margin-bottom: 20px;
                flex-wrap: wrap;
                gap: 10px;
            }

            /* Job Cards Grid */
            .job-grid {
                display: grid;
                grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
                gap: 20px;
                margin-bottom: 40px;
            }

            .job-card {
                background: white;
                border: 1px solid #e9ecef;
                border-radius: 10px;
                overflow: hidden;
                transition: all 0.3s ease;
                cursor: pointer;
            }

            .job-card:hover {
                transform: translateY(-3px);
                box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            }

            .job-card-content {
                padding: 20px;
            }

            .freelancer-info {
                display: flex;
                align-items: center;
                gap: 10px;
                margin-bottom: 15px;
            }

            .freelancer-avatar {
                width: 32px;
                height: 32px;
                border-radius: 50%;
                object-fit: cover;
            }

            .freelancer-name {
                font-weight: 600;
                font-size: 14px;
                color: #333;
            }

            .response-time {
                font-size: 12px;
                color: #999;
            }

            .job-image {
                width: 100%;
                height: 140px;
                object-fit: cover;
                border-radius: 6px;
                margin-bottom: 15px;
            }

            .job-title {
                font-weight: 600;
                font-size: 14px;
                color: #333;
                margin-bottom: 8px;
                line-height: 1.4;
            }

            .job-stats {
                font-size: 12px;
                color: #666;
                margin-bottom: 10px;
            }

            .rating {
                color: #ffc107;
            }

            .job-badges {
                display: flex;
                flex-wrap: wrap;
                gap: 6px;
                margin-bottom: 15px;
            }

            .badge {
                font-size: 11px;
                padding: 4px 8px;
                border-radius: 12px;
                font-weight: 600;
            }

            .badge-gradual {
                background: #fff3cd;
                color: #856404;
            }

            .badge-rehire {
                background: #d1ecf1;
                color: #0c5460;
            }

            .job-price {
                text-align: right;
                color: #1DA1F2;
                font-weight: 700;
                font-size: 14px;
            }

            /* Help Button */
            .help-btn {
                position: fixed;
                right: 0;
                top: 50%;
                transform: translateY(-50%);
                background: rgba(29, 161, 242, 0.1);
                color: #1DA1F2;
                padding: 15px 12px;
                border-top-left-radius: 20px;
                border-bottom-left-radius: 20px;
                font-size: 12px;
                font-weight: 600;
                text-decoration: none;
                writing-mode: vertical-rl;
                text-orientation: mixed;
                z-index: 50;
                transition: all 0.3s ease;
            }

            .help-btn:hover {
                background: rgba(29, 161, 242, 0.2);
            }

    /* Chat Popup Styles */
            .popup-overlay {
                position: fixed;
                top: 0;
                left: 0;
                width: 100vw;
                height: 100vh;
                background: rgba(0, 0, 0, 0.3);
                z-index: 1000;
                opacity: 0;
                visibility: hidden;
                transition: all 0.3s ease;
            }

            .popup-overlay.show {
                opacity: 1;
                visibility: visible;
            }

            .popup-content {
                position: fixed;
                right: 20px;
                top: 55%;
                transform: translateY(-50%) translateX(100%);
                background: #fff;
                border-radius: 20px;
                width: 380px;
                max-height: 85vh;
                overflow: hidden;
                box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
                transition: transform 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            }

            .popup-overlay.show .popup-content {
                transform: translateY(-50%) translateX(0);
            }

            .popup-header {
                background: linear-gradient(135deg, #1DA1F2 0%, #0084d1 100%);
                color: white;
                padding: 20px;
                position: relative;
                text-align: center;
            }

            .popup-title {
                font-size: 18px;
                font-weight: 700;
                margin: 0;
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 8px;
            }

            .popup-subtitle {
                font-size: 12px;
                opacity: 0.9;
                margin-top: 5px;
            }

            .popup-close {
                position: absolute;
                top: 15px;
                right: 15px;
                background: rgba(255, 255, 255, 0.2);
                border: none;
                border-radius: 50%;
                width: 30px;
                height: 30px;
                color: white;
                font-size: 16px;
                cursor: pointer;
                display: flex;
                align-items: center;
                justify-content: center;
                transition: all 0.3s ease;
            }

            .popup-close:hover {
                background: rgba(255, 255, 255, 0.3);
            }

            .popup-body {
                padding: 20px;
                max-height: calc(85vh - 140px);
                overflow-y: auto;
            }

            .step {
                display: flex;
                align-items: flex-start;
                margin-bottom: 16px;
                padding: 12px;
                border-radius: 12px;
                background: #f8f9ff;
                border-left: 3px solid #1DA1F2;
                transition: all 0.3s ease;
            }

            .step:hover {
                background: #f0f7ff;
                transform: translateX(-3px);
            }

            .step-number {
                background: #1DA1F2;
                color: white;
                width: 24px;
                height: 24px;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                font-weight: 700;
                font-size: 12px;
                margin-right: 12px;
                flex-shrink: 0;
            }

            .step-content {
                flex: 1;
            }

            .step-title {
                font-size: 14px;
                font-weight: 600;
                color: #333;
                margin-bottom: 4px;
            }

            .step-description {
                font-size: 12px;
                color: #666;
                line-height: 1.4;
            }

            .popup-footer {
                padding: 15px 20px;
                border-top: 1px solid #e9ecef;
                text-align: center;
                background: #f8f9fa;
            }

            .start-btn {
                background: linear-gradient(135deg, #1DA1F2 0%, #0084d1 100%);
                color: white;
                border: none;
                padding: 10px 20px;
                border-radius: 20px;
                font-weight: 600;
                font-size: 14px;
                cursor: pointer;
                transition: all 0.3s ease;
                width: 100%;
            }

            .start-btn:hover {
                transform: translateY(-1px);
                box-shadow: 0 8px 20px rgba(29, 161, 242, 0.3);
            }

            /* Chat icon for popup title */
            .chat-icon {
                width: 20px;
                height: 20px;
            }

            /* Responsive */
            @media (max-width: 1024px) {
                .nav {
                    padding: 0 15px;
                }

                .main-container {
                    padding: 0 15px;
                }

                .job-grid {
                    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
                    gap: 15px;
                }
            }

            @media (max-width: 768px) {
                .nav-container {
                    top: 56px;
                }

                .nav {
                    padding: 0 10px;
                }

                .nav-list {
                    gap: 10px;
                    padding: 6px 0;
                }

                .nav-item {
                    padding: 8px 12px;
                    min-height: 36px;
                }

                .nav-link {
                    font-size: 14px;
                }

                .breadcrumb-container {
                    padding: 0 10px;
                }

                .main-container {
                    padding: 0 10px;
                }

                .page-title {
                    font-size: 1.5rem;
                    margin: 20px 0 15px 0;
                }

                .action-bar {
                    flex-direction: column;
                    align-items: stretch;
                }

                .filter-controls {
                    order: 2;
                }

                .post-job-btn {
                    order: 1;
                }

                .job-grid {
                    grid-template-columns: 1fr;
                }

                .popup-content {
                    width: 95%;
                    max-height: 95vh;
                }

                .popup-header {
                    padding: 20px 25px;
                }

                .popup-title {
                    font-size: 20px;
                }

                .popup-body {
                    padding: 25px 20px;
                }

                .step {
                    padding: 16px;
                    margin-bottom: 20px;
                }

                .step-number {
                    width: 28px;
                    height: 28px;
                    font-size: 13px;
                }
            }

            .badge-urgent {
        background: #ffe6e6;
        color: #dc3545;
    }

    .badge-expert {
        background: #cce5ff;
        color: #0066cc;
    }

    .badge-flexible {
        background: #fff3cd;
        color: #856404;
    }
        </style>
    </head>
    <body>

    <div class="nav-container">
        <nav class="nav">
            <ul class="nav-list">
                <li class="nav-item"><a href="/freelancer/popular" class="nav-link">Pekerjaan Populer</a></li>
                <li class="nav-item"><a href="/freelancer/grafis" class="nav-link">Grafis & Desain</a></li>
                <li class="nav-item"><a href="/freelancer/dokumen" class="nav-link">Dokumen & PPT</a></li>
                <li class="nav-item"><a href="/freelancer/web-app" class="nav-link">Web & App</a></li>
                <li class="nav-item"><a href="#" class="nav-link">Video Editing</a></li>
            </ul>
        </nav>
    </div>

        <!-- Breadcrumb -->
        <div class="breadcrumb">
            <div class="breadcrumb-container">
                <a href="#" class="breadcrumb-link">Semua Kategori</a>
                <span class="breadcrumb-separator">›</span>
                <a href="#" class="breadcrumb-link">Pekerjaan Popular</a>
                <span class="breadcrumb-separator">›</span>
                <span class="breadcrumb-current">Web Development</span>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-container">
            <!-- Page Title -->
            <h1 class="page-title">Jasa Pembuatan Website Terbaik dan Profesional</h1>

            <!-- Category Filters -->
            <div class="category-filters">
                <button class="filter-btn active">semua</button>
                <button class="filter-btn">Wordpress</button>
                <button class="filter-btn">Blog</button>
                <button class="filter-btn">eCommerce</button>
                <button class="filter-btn">Company Profile</button>
                <button class="filter-btn">Sekolah</button>
                <button class="filter-btn">Sales Mobil</button>
                <button class="filter-btn">UMKM</button>
                <button class="filter-btn">Desa</button>
                <button class="filter-btn">Berita</button>
                <button class="filter-btn strikethrough">Travel</button>
                <button class="filter-btn">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>

            <!-- Action Bar -->
            <div class="action-bar">
                <div class="filter-controls">
                    <button class="control-btn">
                        <i class="fas fa-filter"></i>
                        Cari
                    </button>
                    <button class="control-btn sort-btn">
                        <i class="fas fa-sort-amount-up"></i>
                        Urutkan berdasarkan
                    </button>
                </div>

            </div>

            <!-- Stats Bar -->
            <div class="stats-bar">
                <div>Pekerjaan yang ditemukan 4.508 Item</div>
                <div>Halaman 1 Dari 113</div>
            </div>

            <!-- Job Cards Grid -->
            <div class="job-grid">
                <!-- Card 1 -->
    <!-- Card 1 -->
    <article class="job-card">
        <div class="job-card-content">
            <a href="/freelancer/web/job" class="job-link">
                <div class="freelancer-info">
                    <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=64&h=64&fit=crop&crop=face" alt="Client avatar" class="freelancer-avatar">
                    <div>
                        <div class="freelancer-name">Client Project</div>
                        <div class="response-time">Diposting 2 hari yang lalu</div>
                    </div>
                </div>
                <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=400&h=200&fit=crop" alt="Website Development Project" class="job-image">
                <h3 class="job-title">Dicari: Freelancer untuk Pembuatan Full Website & Sistem Informasi</h3>
                <p class="job-stats">Budget Tersedia | Expert Level Required</p>
                <div class="job-badges">
                    <span class="badge badge-urgent">Segera</span>
                    <span class="badge badge-expert">Expert Level</span>
                    <span class="badge badge-flexible">Budget Fleksibel</span>
                </div>
                <p class="job-price">Mulai<br>Rp500.000+</p>
            </a>
        </div>
    </article>


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

            // Filter button functionality
            document.querySelectorAll('.filter-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    if (!this.querySelector('.fas')) {
                        document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
                        this.classList.add('active');
                    }
                });
            });

            // Job card interactions
            document.querySelectorAll('.job-card').forEach(card => {
                card.addEventListener('click', function() {
                    console.log('Job card clicked');
                    // Add navigation logic here
                });
            });

            // Control buttons
            document.querySelectorAll('.control-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    console.log('Control button clicked:', this.textContent.trim());
                });
            });

            // Post job button
            document.querySelector('.post-job-btn').addEventListener('click', function() {
                console.log('Post job button clicked');
            });

            // Popup functionality
            function showPopup() {
                const popup = document.getElementById('helpPopup');
                popup.classList.add('show');
                document.body.style.overflow = 'hidden'; // Prevent background scrolling
            }

            function closePopup() {
                const popup = document.getElementById('helpPopup');
                popup.classList.remove('show');
                document.body.style.overflow = ''; // Restore scrolling
            }

            // Show popup when help button is clicked
            document.querySelector('.help-btn').addEventListener('click', function (e) {
                e.preventDefault();
                showPopup();
            });

            // Close popup when clicking outside content
            document.getElementById('helpPopup').addEventListener('click', function(e) {
                if (e.target === this) {
                    closePopup();
                }
            });

            // Close popup with Escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    closePopup();
                }
            });
        </script>
    </body>
    </html>
    @endsection