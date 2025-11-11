<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CariFreelance - Guest Header</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Clean Header Styles */
        .clean-header {
            background: #ffffff;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1030;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        /* Body padding untuk compensate fixed header */
        body {
            padding-top: 80px;
            background-color: #f8fafc;
        }

        @media (max-width: 768px) {
            body {
                padding-top: 70px;
            }
        }

        .clean-navbar {
            padding: 0.75rem 0;
            min-height: 70px;
        }

        /* Logo Styles */
        .brand-logo {
            display: flex;
            align-items: center;
            text-decoration: none !important;
            transition: all 0.3s ease;
        }

        .brand-logo:hover {
            transform: translateY(-1px);
        }

        .brand-logo img {
            height: 40px;
            width: auto;
            transition: all 0.3s ease;
        }

        /* Navigation Icons - Now in Header Actions */
        .nav-icons {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .nav-icon {
            position: relative;
            background: none;
            border: 2px solid #e2e8f0;
            color: #64748b;
            font-size: 1.25rem;
            padding: 0.75rem;
            border-radius: 12px;
            transition: all 0.3s ease;
            cursor: pointer;
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
        }

        .nav-icon:hover {
            background: #f8fafc;
            color: #3b82f6;
            border-color: #3b82f6;
            transform: translateY(-1px);
        }

        .nav-icon.active {
            background: #f8fafc;
            color: #3b82f6;
            border-color: #3b82f6;
        }

        /* Dropdown arrow for nav icons */
        .nav-icon.dropdown-toggle::after {
            content: '';
            display: inline-block;
            margin-left: 0.5rem;
            vertical-align: 0.125em;
            border-top: 0.3em solid;
            border-right: 0.3em solid transparent;
            border-bottom: 0;
            border-left: 0.3em solid transparent;
            transition: transform 0.3s ease;
        }

        .nav-icon.dropdown-toggle.active::after {
            transform: rotate(180deg);
        }

        /* Tentang Kami Dropdown */
        .nav-dropdown {
            position: relative;
        }

        .dropdown-menu-nav {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border: none;
            border-radius: 16px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.12);
            padding: 0.75rem 0;
            margin-top: 0.75rem;
            min-width: 200px;
            overflow: hidden;
            position: absolute;
            right: 0;
            top: 100%;
            z-index: 1050;
            display: none;
        }

        .dropdown-menu-nav.show {
            display: block;
        }

        .dropdown-menu-nav .dropdown-item {
            padding: 0.875rem 1.5rem;
            color: #374151;
            font-weight: 500;
            transition: all 0.2s ease;
            border: none;
            background: none;
            width: 100%;
            text-align: left;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-size: 0.95rem;
            text-decoration: none;
        }

        .dropdown-menu-nav .dropdown-item:hover {
            background: #f8fafc;
            color: #1f2937;
            transform: translateX(4px);
        }

        .dropdown-menu-nav .dropdown-item i {
            color: #3b82f6;
            width: 16px;
        }

        .dropdown-menu-nav .dropdown-divider {
            margin: 0.5rem 1rem;
            border-color: #e5e7eb;
        }

        /* Header Actions */
        .header-actions {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .action-btn {
            position: relative;
            background: none;
            border: 2px solid #e2e8f0;
            color: #64748b;
            font-size: 1.25rem;
            padding: 0.75rem;
            border-radius: 12px;
            transition: all 0.3s ease;
            cursor: pointer;
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
        }

        .action-btn:hover {
            background: #f8fafc;
            color: #3b82f6;
            border-color: #3b82f6;
            transform: translateY(-1px);
        }

        .notification-badge {
            position: absolute;
            top: -2px;
            right: -2px;
            background: #ef4444;
            color: white;
            font-size: 0.7rem;
            padding: 0.125rem 0.375rem;
            border-radius: 50px;
            min-width: 16px;
            height: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            border: 2px solid white;
        }

        /* Auth Buttons */
        .auth-buttons {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .btn-outline-clean {
            border: 2px solid #3b82f6;
            color: #3b82f6;
            background: transparent;
            padding: 0.75rem 1.5rem;
            border-radius: 12px;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            text-decoration: none;
            display: flex;
            align-items: center;
        }

        .btn-outline-clean:hover {
            background: #f0f7ff;
            color: #2563eb;
            border-color: #2563eb;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.15);
        }

        .btn-solid-clean {
            background: #3b82f6;
            color: white;
            border: 2px solid #3b82f6;
            padding: 0.75rem 1.5rem;
            border-radius: 12px;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            text-decoration: none;
            display: flex;
            align-items: center;
        }

        .btn-solid-clean:hover {
            background: #2563eb;
            border-color: #2563eb;
            color: white;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.25);
        }

        /* Mobile Menu Button */
        .mobile-menu-btn {
            display: none;
            background: none;
            border: 2px solid #e2e8f0;
            color: #64748b;
            padding: 0.75rem;
            border-radius: 12px;
            transition: all 0.3s ease;
            width: 48px;
            height: 48px;
            cursor: pointer;
        }

        .mobile-menu-btn:hover {
            background: #f8fafc;
            border-color: #3b82f6;
            color: #3b82f6;
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .clean-navbar {
                padding: 0.5rem 0;
                min-height: 60px;
            }

            .brand-logo img {
                height: 32px;
            }

            .nav-icons {
                display: none;
            }

            .header-actions {
                gap: 0.75rem;
            }

            .action-btn {
                font-size: 1.1rem;
                padding: 0.5rem;
                width: 42px;
                height: 42px;
            }

            .mobile-menu-btn {
                display: flex;
                align-items: center;
                justify-content: center;
                width: 42px;
                height: 42px;
                padding: 0.5rem;
            }

            .desktop-actions {
                display: none;
            }

            .mobile-nav-overlay {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100vh;
                background: rgba(0, 0, 0, 0.5);
                z-index: 1040;
                opacity: 0;
                visibility: hidden;
                transition: all 0.3s ease;
            }

            .mobile-nav-overlay.show {
                opacity: 1;
                visibility: visible;
            }

            .mobile-nav-menu {
                position: fixed;
                top: 0;
                right: -100%;
                width: 280px;
                height: 100vh;
                background: white;
                z-index: 1050;
                padding: 2rem;
                transition: right 0.3s ease;
                box-shadow: -4px 0 20px rgba(0, 0, 0, 0.1);
                overflow-y: auto;
            }

            .mobile-nav-menu.show {
                right: 0;
            }

            .mobile-nav-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 2rem;
                padding-bottom: 1rem;
                border-bottom: 1px solid #e5e7eb;
            }

            .mobile-nav-close {
                background: none;
                border: none;
                font-size: 1.5rem;
                color: #6b7280;
                cursor: pointer;
                padding: 0.5rem;
            }

            .mobile-nav-links {
                display: flex;
                flex-direction: column;
                gap: 0.5rem;
                margin-bottom: 2rem;
            }

            .mobile-nav-link {
                color: #374151;
                text-decoration: none;
                padding: 1rem;
                border-radius: 12px;
                transition: all 0.3s ease;
                font-weight: 500;
                display: flex;
                align-items: center;
                gap: 0.75rem;
            }

            .mobile-nav-link:hover {
                background: #f8fafc;
                color: #3b82f6;
            }

            .mobile-dropdown-content {
                padding-left: 1rem;
                margin-top: 0.5rem;
                display: none;
            }

            .mobile-dropdown-content.show {
                display: block;
            }

            .mobile-auth-buttons {
                display: flex;
                flex-direction: column;
                gap: 0.75rem;
                margin-top: 2rem;
                padding-top: 2rem;
                border-top: 1px solid #e5e7eb;
            }
        }

        /* Container */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem;
        }

        @media (max-width: 576px) {
            .container {
                padding: 0 0.75rem;
            }
        }

        /* Animation enhancements */
        * {
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        .clean-header * {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Additional clean styles */
        a {
            text-decoration: none;
        }

        a:hover {
            text-decoration: none;
        }

        /* Tooltip */
        [title] {
            position: relative;
        }
    </style>
</head>
<body>
    <header class="clean-header">
        <div class="container">
            <nav class="clean-navbar d-flex justify-content-between align-items-center">
                <!-- Logo -->
                <a href="/" class="brand-logo">
                    <img src="{{ asset('images/logoutama.png') }}" alt="CariFreelance" />
                </a>

                <!-- Header Actions - All Right Aligned -->
                <div class="header-actions">
                    <!-- Navigation Icons (Desktop) -->
                    <div class="nav-icons d-none d-md-flex">
                        <!-- Beranda -->
                        <a href="/" class="nav-icon" title="Beranda">
                            <i class="fas fa-home"></i>
                        </a>

                        <!-- Tentang Kami Dropdown -->
                        <div class="nav-dropdown">
                            <button class="nav-icon dropdown-toggle" id="tentangToggle" title="Tentang Kami">
                                <i class="fas fa-info-circle"></i>
                            </button>
                            <div class="dropdown-menu-nav" id="tentangDropdown">
                                <a class="dropdown-item" href="/tentang/penjelasan">
                                    <i class="fas fa-file-alt"></i>
                                    Penjelasan
                                </a>
                                <a class="dropdown-item" href="/tentang/foto">
                                    <i class="fas fa-images"></i>
                                    Foto-foto
                                </a>
                            </div>
                        </div>

                        <!-- FAQ -->
                        <a href="/faq" class="nav-icon" title="FAQ">
                            <i class="fas fa-question-circle"></i>
                        </a>
                    </div>


                    <!-- Auth Buttons (Desktop) -->
                    <div class="auth-buttons d-none d-md-flex">
                        <a href="/login" class="btn-outline-clean">
                            Masuk
                        </a>
                        <a href="/register/step1" class="btn-solid-clean">
                            Daftar
                        </a>
                    </div>

                    <!-- Mobile Menu Button -->
                    <button class="mobile-menu-btn d-md-none" onclick="toggleMobileMenu()">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
            </nav>
        </div>
    </header>

    <!-- Mobile Navigation Overlay -->
    <div class="mobile-nav-overlay d-md-none" id="mobileNavOverlay" onclick="closeMobileMenu()"></div>

    <!-- Mobile Navigation Menu -->
    <div class="mobile-nav-menu d-md-none" id="mobileNavMenu">
        <div class="mobile-nav-header">
            <img src="{{ asset('images/logoutama.png') }}" alt="CariFreelance" style="height: 32px;" />
            <button class="mobile-nav-close" onclick="closeMobileMenu()">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <div class="mobile-nav-links">
            <a href="/" class="mobile-nav-link">
                <i class="fas fa-home"></i>
                Beranda
            </a>
            
            <div>
                <a href="#" class="mobile-nav-link" onclick="toggleMobileDropdown(event)">
                    <i class="fas fa-info-circle"></i>
                    Tentang Kami
                    <i class="fas fa-chevron-down ms-auto"></i>
                </a>
                <div class="mobile-dropdown-content">
                    <a href="/tentang/penjelasan" class="mobile-nav-link">
                        <i class="fas fa-file-alt"></i>
                        Penjelasan
                    </a>
                    <a href="/tentang/foto" class="mobile-nav-link">
                        <i class="fas fa-images"></i>
                        Foto-foto
                    </a>
                </div>
            </div>

            <a href="/faq" class="mobile-nav-link">
                <i class="fas fa-question-circle"></i>
                FAQ
            </a>

            <a href="/notification" class="mobile-nav-link">
                <i class="fas fa-bell"></i>
                Notifikasi
                <span class="notification-badge ms-auto">3</span>
            </a>

            <a href="/messages" class="mobile-nav-link">
                <i class="fas fa-envelope"></i>
                Pesan
                <span class="notification-badge ms-auto">5</span>
            </a>

            <a href="/projects" class="mobile-nav-link">
                <i class="fas fa-search"></i>
                Jelajahi Proyek
            </a>
        </div>

        <div class="mobile-auth-buttons">
            <a href="/login" class="btn-outline-clean">
                <i class="fas fa-sign-in-alt me-2"></i>
                Masuk
            </a>
            <a href="/register/step1" class="btn-solid-clean">
                <i class="fas fa-user-plus me-2"></i>
                Daftar
            </a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Tentang Kami dropdown functionality
        document.addEventListener('DOMContentLoaded', function() {
            const dropdownToggle = document.getElementById('tentangToggle');
            const dropdownMenu = document.getElementById('tentangDropdown');
            const dropdownParent = dropdownToggle.closest('.nav-dropdown');
            
            let hoverTimeout;
            let isOpen = false;

            // Function to show dropdown
            function showDropdown() {
                clearTimeout(hoverTimeout);
                dropdownMenu.classList.add('show');
                dropdownToggle.classList.add('active');
                isOpen = true;
            }

            // Function to hide dropdown
            function hideDropdown() {
                hoverTimeout = setTimeout(() => {
                    dropdownMenu.classList.remove('show');
                    dropdownToggle.classList.remove('active');
                    isOpen = false;
                }, 150);
            }

            // Click functionality
            dropdownToggle.addEventListener('click', function(e) {
                e.preventDefault();
                if (isOpen) {
                    hideDropdown();
                } else {
                    showDropdown();
                }
            });

            // Hover functionality
            dropdownParent.addEventListener('mouseenter', showDropdown);
            dropdownParent.addEventListener('mouseleave', hideDropdown);

            // Close when clicking outside
            document.addEventListener('click', function(e) {
                if (!dropdownParent.contains(e.target)) {
                    hideDropdown();
                }
            });
        });

        // Mobile menu functionality
        function toggleMobileMenu() {
            const overlay = document.getElementById('mobileNavOverlay');
            const menu = document.getElementById('mobileNavMenu');
            const menuBtn = document.querySelector('.mobile-menu-btn');
            
            overlay.classList.toggle('show');
            menu.classList.toggle('show');
            
            // Toggle hamburger to X
            const icon = menuBtn.querySelector('i');
            if (menu.classList.contains('show')) {
                icon.className = 'fas fa-times';
                document.body.style.overflow = 'hidden';
            } else {
                icon.className = 'fas fa-bars';
                document.body.style.overflow = '';
            }
        }

        function closeMobileMenu() {
            const overlay = document.getElementById('mobileNavOverlay');
            const menu = document.getElementById('mobileNavMenu');
            const menuBtn = document.querySelector('.mobile-menu-btn');
            
            overlay.classList.remove('show');
            menu.classList.remove('show');
            
            const icon = menuBtn.querySelector('i');
            icon.className = 'fas fa-bars';
            document.body.style.overflow = '';
        }

        function toggleMobileDropdown(event) {
            event.preventDefault();
            const dropdownContent = event.target.nextElementSibling;
            const chevron = event.target.querySelector('.fa-chevron-down');
            
            if (dropdownContent) {
                dropdownContent.classList.toggle('show');
                if (chevron) {
                    chevron.style.transform = dropdownContent.classList.contains('show') 
                        ? 'rotate(180deg)' : 'rotate(0deg)';
                }
            }
        }

        // Close mobile menu on escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeMobileMenu();
            }
        });

        // Close mobile menu on window resize
        window.addEventListener('resize', function() {
            if (window.innerWidth >= 768) {
                closeMobileMenu();
            }
        });

        // Enhanced interactions
        document.addEventListener('DOMContentLoaded', function() {
            // Add subtle animations to all buttons
            const buttons = document.querySelectorAll('.action-btn, .nav-icon, .btn-outline-clean, .btn-solid-clean');
            buttons.forEach(btn => {
                btn.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-1px)';
                });
                
                btn.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });
            });
        });
    </script>
</body>
</html>