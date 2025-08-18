<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CariFreelance - Clean Header</title>
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

        /* Search Bar Styles */
        .search-container {
            flex: 1;
            max-width: 500px;
            margin: 0 2rem;
            position: relative;
        }

        .search-input {
            width: 100%;
            padding: 0.75rem 1rem 0.75rem 3rem;
            border: 2px solid #e2e8f0;
            border-radius: 50px;
            background: #f8fafc;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            outline: none;
        }

        .search-input:focus {
            border-color: #3b82f6;
            background: #ffffff;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .search-input::placeholder {
            color: #94a3b8;
        }

        .search-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #64748b;
            font-size: 1rem;
        }

        .search-btn {
            position: absolute;
            right: 0.5rem;
            top: 50%;
            transform: translateY(-50%);
            background: #3b82f6;
            color: white;
            border: none;
            border-radius: 50px;
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
            transition: all 0.3s ease;
        }

        .search-btn:hover {
            background: #2563eb;
            transform: translateY(-50%) translateY(-1px);
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
            border: none;
            color: #64748b;
            font-size: 1.25rem;
            padding: 0.75rem;
            border-radius: 12px;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .action-btn:hover {
            background: #f1f5f9;
            color: #3b82f6;
            transform: translateY(-1px);
        }

        .notification-badge {
            position: absolute;
            top: 0.5rem;
            right: 0.5rem;
            background: #ef4444;
            color: white;
            font-size: 0.75rem;
            padding: 0.125rem 0.375rem;
            border-radius: 50px;
            min-width: 18px;
            height: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
        }

        /* Profile Button */
        .profile-container {
            position: relative;
        }

        .profile-btn {
            background: none;
            border: 2px solid #e2e8f0;
            color: #374151;
            padding: 0.5rem;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 45px;
            height: 45px;
            transition: all 0.3s ease;
            cursor: pointer;
            font-size: 1.1rem;
        }

        .profile-btn:hover,
        .profile-btn.show {
            border-color: #3b82f6;
            color: #3b82f6;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.15);
        }

        /* Enhanced Dropdown Menu */
        .profile-container .dropdown-menu {
            background: white;
            border: 1px solid #e2e8f0;
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
        }

        .profile-container .dropdown-item {
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
        }

        .profile-container .dropdown-item:hover {
            background: #f8fafc;
            color: #1f2937;
            transform: translateX(4px);
        }

        .profile-container .dropdown-item.text-danger {
            color: #dc2626;
        }

        .profile-container .dropdown-item.text-danger:hover {
            background: #fef2f2;
            color: #b91c1c;
        }

        .profile-container .dropdown-divider {
            margin: 0.5rem 1rem;
            border-color: #e5e7eb;
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
        }

        .mobile-menu-btn:hover {
            background: #f1f5f9;
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

            .search-container {
                display: none;
            }

            .header-actions {
                gap: 0.5rem;
            }

            .action-btn {
                font-size: 1.1rem;
                padding: 0.5rem;
            }

            .profile-btn {
                width: 40px;
                height: 40px;
            }

            .mobile-menu-btn {
                display: block;
            }

            .desktop-actions {
                display: none;
            }
        }

        /* Mobile Search (when needed) */
        .mobile-search {
            display: none;
            padding: 1rem;
            background: white;
            border-bottom: 1px solid #e2e8f0;
        }

        @media (max-width: 768px) {
            .mobile-search.show {
                display: block;
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
    </style>
</head>
<body>
    <header class="clean-header">
        <div class="container">
            <nav class="clean-navbar d-flex justify-content-between align-items-center">
                {{-- Logo --}}
                <a href="/client/home" class="brand-logo">
                    <img src="{{ asset('images/logoutama.png') }}" alt="CariFreelance" />
                </a>

                {{-- Search Bar (Desktop) --}}
                <div class="search-container d-none d-md-block">
                    <div class="position-relative">
                        <i class="fas fa-search search-icon"></i>
                        <input type="text" class="search-input" placeholder="Cari freelancer, proyek, atau keahlian...">
                        <button type="button" class="search-btn">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>

                {{-- Header Actions --}}
                <div class="header-actions">
                    {{-- Desktop Actions --}}
                    <div class="desktop-actions d-none d-md-flex align-items-center" style="gap: 1rem;">
                        {{-- Notifications --}}
                        <a href="/notification">
                        <button class="action-btn position-relative" title="Notifikasi">
                            <i class="fas fa-bell"></i>
                            <span class="notification-badge">3</span>
                        </button>
                        </a>

                        {{-- Messages --}}
                        <button class="action-btn position-relative" title="Pesan">
                            <i class="fas fa-envelope"></i>
                            <span class="notification-badge">5</span>
                        </button>

                        {{-- Projects --}}
                        <a href="/profile/job">
                        <button class="action-btn" title="Proyek">
                            <i class="fas fa-folder-open"></i>
                        </button>
                    </div>

                    {{-- Profile Dropdown --}}
                    <div class="profile-container dropdown">
                        <button class="profile-btn dropdown-toggle" type="button" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user"></i>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="profileDropdown">
                            <li>
                                <a class="dropdown-item" href="{{ route('profile') }}">
                                    <i class="fas fa-user"></i>
                                    Profil Saya
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('profile-akun') }}">
                                    <i class="fas fa-cog"></i>
                                    Pengaturan
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-credit-card"></i>
                                    Pembayaran
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-chart-line"></i>
                                    Laporan
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="d-inline w-100">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="fas fa-sign-out-alt"></i>
                                        Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>

                    {{-- Mobile Menu Button --}}
                    <button class="mobile-menu-btn d-md-none" type="button" onclick="toggleMobileSearch()">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </nav>
        </div>

        {{-- Mobile Search --}}
        <div class="mobile-search" id="mobileSearch">
            <div class="container">
                <div class="position-relative">
                    <i class="fas fa-search search-icon"></i>
                    <input type="text" class="search-input" placeholder="Cari freelancer atau proyek...">
                    <button type="button" class="search-btn">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </div>
    </header>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Mobile search toggle
        function toggleMobileSearch() {
            const mobileSearch = document.getElementById('mobileSearch');
            mobileSearch.classList.toggle('show');
        }

        // Enhanced dropdown behavior
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize Bootstrap dropdown
            const dropdownElementList = [].slice.call(document.querySelectorAll('[data-bs-toggle="dropdown"]'));
            const dropdownList = dropdownElementList.map(function (dropdownToggleEl) {
                return new bootstrap.Dropdown(dropdownToggleEl);
            });

            const dropdownToggle = document.querySelector('.profile-btn');
            const dropdownMenu = document.querySelector('.profile-container .dropdown-menu');
            
            if (dropdownToggle && dropdownMenu) {
                // Manual dropdown toggle as backup
                dropdownToggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    
                    // Toggle dropdown manually if Bootstrap doesn't work
                    const isOpen = dropdownMenu.classList.contains('show');
                    
                    // Close all other dropdowns first
                    document.querySelectorAll('.dropdown-menu.show').forEach(menu => {
                        if (menu !== dropdownMenu) {
                            menu.classList.remove('show');
                        }
                    });
                    
                    // Toggle current dropdown
                    if (isOpen) {
                        dropdownMenu.classList.remove('show');
                        dropdownToggle.classList.remove('show');
                    } else {
                        dropdownMenu.classList.add('show');
                        dropdownToggle.classList.add('show');
                    }
                });
                
                // Close dropdown when clicking outside
                document.addEventListener('click', function(e) {
                    if (!dropdownToggle.contains(e.target) && !dropdownMenu.contains(e.target)) {
                        dropdownMenu.classList.remove('show');
                        dropdownToggle.classList.remove('show');
                    }
                });

                // Close dropdown when pressing Escape
                document.addEventListener('keydown', function(e) {
                    if (e.key === 'Escape') {
                        dropdownMenu.classList.remove('show');
                        dropdownToggle.classList.remove('show');
                    }
                });
            }

            // Search input enhancements
            const searchInputs = document.querySelectorAll('.search-input');
            searchInputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.style.transform = 'translateY(-1px)';
                });
                
                input.addEventListener('blur', function() {
                    this.parentElement.style.transform = 'translateY(0)';
                });
            });
        });

        // Smooth scroll behavior
        document.documentElement.style.scrollBehavior = 'smooth';
    </script>
</body>
</html>