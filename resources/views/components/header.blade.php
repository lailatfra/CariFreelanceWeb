<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CariFreelance - Enhanced Navbar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .dropdown-menu-enhanced {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border: none;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            padding: 12px;
            min-width: 260px;
            margin-top: 8px;
            transform: translateY(-10px);
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .dropdown-menu-enhanced.show {
            transform: translateY(0);
            opacity: 1;
            visibility: visible;
        }

        .dropdown-item-enhanced {
            background: white;
            border-radius: 8px;
            padding: 10px 15px;
            margin-bottom: 6px;
            border: 1px solid rgba(0, 184, 148, 0.1);
            transition: all 0.3s ease;
            text-decoration: none;
            color: #333;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        .dropdown-item-enhanced:hover {
            background: linear-gradient(135deg, #00B894 0%, #00a783 100%);
            color: white;
            transform: translateY(-1px);
            box-shadow: 0 4px 15px rgba(0, 184, 148, 0.3);
        }

        .dropdown-item-enhanced::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .dropdown-item-enhanced:hover::before {
            left: 100%;
        }

        .dropdown-item-enhanced h6 {
            margin: 0 0 2px 0;
            font-weight: 600;
            font-size: 14px;
        }

        .dropdown-item-enhanced p {
            margin: 0;
            font-size: 12px;
            opacity: 0.7;
        }

        .dropdown-item-enhanced i {
            margin-right: 10px;
            font-size: 16px;
            color: #00B894;
            transition: color 0.3s ease;
            width: 20px;
            text-align: center;
        }

        .dropdown-item-enhanced:hover i {
            color: white;
        }

        .nav-link-dropdown {
            position: relative;
        }

        .nav-link-dropdown::after {
            content: '\f107';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            margin-left: 8px;
            transition: transform 0.3s ease;
        }

        .nav-link-dropdown.active::after {
            transform: rotate(180deg);
        }

        .navbar-brand img {
            transition: all 0.3s ease;
        }

        .navbar-shrink {
            padding: 6px 0 !important;
            background: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(10px);
        }

        .navbar-shrink .navbar-brand img {
            height: 42px !important;
        }

        @media (max-width: 991px) {
            .dropdown-menu-enhanced {
                position: static;
                transform: none;
                opacity: 1;
                visibility: visible;
                box-shadow: none;
                background: transparent;
                padding: 10px 0;
            }

            .dropdown-item-enhanced {
                margin-bottom: 5px;
            }
        }
    </style>
</head>
<body>
    <nav id="mainNavbar" class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top"
         style="transition: all 0.3s ease; padding: 12px 0;">
        <div class="container d-flex justify-content-between align-items-center">
            <!-- Logo -->
            <a class="navbar-brand me-4" href="/">
<img src="{{ asset('images/logoutama.png') }}" alt="CariFreelance" style="height: 52px;">
            </a>

            <!-- Mobile Toggle -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navbar Menu -->
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav align-items-center" style="gap: 22px;">
                    <!-- Beranda -->
                    <li class="nav-item">
                        <a class="nav-link" href="/" style="
                            font-weight: 600;
                            color: #000;
                            padding: 6px 14px;
                            border-radius: 30px;
                            transition: all 0.3s ease;"
                            onmouseover="this.style.backgroundColor='#e8fdf7'; this.style.boxShadow='0 4px 12px rgba(0,0,0,0.08)'"
                            onmouseout="this.style.backgroundColor='transparent'; this.style.boxShadow='none'">
                            Beranda
                        </a>
                    </li>

                    <!-- Tentang Kami (Enhanced Dropdown) -->
                    <li class="nav-item dropdown position-relative">
                        <a class="nav-link nav-link-dropdown" href="#" id="tentangToggle" role="button"
                           style="font-weight: 600; color: #000; padding: 6px 14px; border-radius: 30px; transition: all 0.3s ease;"
                           onmouseover="this.style.backgroundColor='#e8fdf7'; this.style.boxShadow='0 4px 12px rgba(0,0,0,0.08)'"
                           onmouseout="this.style.backgroundColor='transparent'; this.style.boxShadow='none'">
                            Tentang Kami
                        </a>
                        <div class="dropdown-menu dropdown-menu-enhanced" id="tentangDropdown">
                            <a class="dropdown-item-enhanced" href="/tentang/penjelasan">
                                <i class="fas fa-info-circle"></i>
                                <div>
                                    <h6>Penjelasan</h6>
                                    <p>Penjelasan terkait web Cari Freelance</p>
                                </div>
                            </a>
                            <a class="dropdown-item-enhanced" href="/tentang/foto">
                                <i class="fas fa-images"></i>
                                <div>
                                    <h6>Foto-foto</h6>
                                    <p>Beberapa foto web CariFreelance</p>
                                </div>
                            </a>
                            <a class="dropdown-item-enhanced" href="/tentang/viewers-rating">
                                <i class="fas fa-star"></i>
                                <div>
                                    <h6>Viewers/rating</h6>
                                    <p>Beberapa foto web CariFreelance</p>
                                </div>
                            </a>
                        </div>
                    </li>

                    <!-- FAQ (Tanpa Dropdown) -->
                    <li class="nav-item">
                        <a class="nav-link" href="/faq"
                           style="font-weight: 600; color: #000; padding: 6px 14px; border-radius: 30px; transition: all 0.3s ease;"
                           onmouseover="this.style.backgroundColor='#e8fdf7'; this.style.boxShadow='0 4px 12px rgba(0,0,0,0.08)'"
                           onmouseout="this.style.backgroundColor='transparent'; this.style.boxShadow='none'">
                            FAQ
                        </a>
                    </li>

                    <!-- Auth Buttons -->
                    <li class="nav-item">
                        <a class="btn" href="/login"
                           style="border: 2px solid #00B894; color: #00B894; border-radius: 30px; padding: 6px 20px;
                           font-weight: 500; transition: all 0.3s ease;"
                           onmouseover="this.style.backgroundColor='#e8fdf7'; this.style.boxShadow='0 4px 12px rgba(0,0,0,0.1)';"
                           onmouseout="this.style.backgroundColor='transparent'; this.style.boxShadow='none';">
                            Masuk
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="btn" href="/register/step1"
                           style="background-color: #00B894; color: white; border-radius: 30px; padding: 6px 20px;
                           font-weight: 500; transition: all 0.3s ease;"
                           onmouseover="this.style.backgroundColor='#00a783'; this.style.boxShadow='0 4px 12px rgba(0,0,0,0.1)';"
                           onmouseout="this.style.backgroundColor='#00B894'; this.style.boxShadow='none';">
                            Daftar
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Enhanced dropdown functionality
        document.addEventListener('DOMContentLoaded', function() {
            const dropdownToggle = document.getElementById('tentangToggle');
            const dropdownMenu = document.getElementById('tentangDropdown');
            const dropdownParent = dropdownToggle.closest('.dropdown');
            
            let hoverTimeout;
            let isOpen = false;

            // Function to show dropdown
            function showDropdown() {
                clearTimeout(hoverTimeout);
                dropdownMenu.classList.add('show');
                dropdownToggle.classList.add('active');
                dropdownToggle.setAttribute('aria-expanded', 'true');
                isOpen = true;
            }

            // Function to hide dropdown
            function hideDropdown() {
                hoverTimeout = setTimeout(() => {
                    dropdownMenu.classList.remove('show');
                    dropdownToggle.classList.remove('active');
                    dropdownToggle.setAttribute('aria-expanded', 'false');
                    isOpen = false;
                }, 100);
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

            // Prevent dropdown from closing when clicking inside
            dropdownMenu.addEventListener('click', function(e) {
                e.stopPropagation();
            });
        });

        // Navbar shrink on scroll
        window.addEventListener('scroll', function () {
            const navbar = document.getElementById('mainNavbar');
            if (window.scrollY > 40) {
                navbar.classList.add('navbar-shrink');
            } else {
                navbar.classList.remove('navbar-shrink');
            }
        });
    </script>
</body>
</html>