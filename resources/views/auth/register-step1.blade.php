<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - CariFreelance</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            overflow-x: hidden;
            min-height: 100vh;
            background: #ffffff;
            position: relative;
        }

        /* Subtle background pattern for texture */
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: 
                radial-gradient(circle at 20% 50%, rgba(0, 184, 148, 0.02) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(102, 126, 234, 0.02) 0%, transparent 50%),
                radial-gradient(circle at 40% 80%, rgba(118, 75, 162, 0.02) 0%, transparent 50%);
            z-index: -1;
        }

        /* Floating particles with minimal opacity */
        .particles {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
        }

        .particle {
            position: absolute;
            background: rgba(0, 184, 148, 0.08);
            border-radius: 50%;
            animation: floatParticle 20s infinite linear;
        }

        .particle:nth-child(1) { width: 3px; height: 3px; left: 10%; animation-delay: 0s; }
        .particle:nth-child(2) { width: 4px; height: 4px; left: 20%; animation-delay: 3s; }
        .particle:nth-child(3) { width: 2px; height: 2px; left: 30%; animation-delay: 6s; }
        .particle:nth-child(4) { width: 3px; height: 3px; left: 40%; animation-delay: 9s; }
        .particle:nth-child(5) { width: 4px; height: 4px; left: 50%; animation-delay: 12s; }
        .particle:nth-child(6) { width: 3px; height: 3px; left: 60%; animation-delay: 15s; }

        @keyframes floatParticle {
            0% { 
                transform: translateY(100vh) rotate(0deg); 
                opacity: 0; 
            }
            10% { opacity: 1; }
            90% { opacity: 1; }
            100% { 
                transform: translateY(-100px) rotate(360deg); 
                opacity: 0; 
            }
        }

        /* Back to Home Button */
        .back-home-btn {
            position: fixed;
            top: 20px;
            left: 20px;
            z-index: 1000;
            background: #ffffff;
            border: 1px solid rgba(0, 0, 0, 0.08);
            border-radius: 50px;
            padding: 8px 16px;
            color: #333;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            box-shadow: 
                0 4px 20px rgba(0, 0, 0, 0.08),
                0 1px 3px rgba(0, 0, 0, 0.12);
            animation: slideInFromLeft 1s ease-out;
        }

        .back-home-btn:hover {
            background: #ffffff;
            transform: translateY(-2px);
            box-shadow: 
                0 6px 25px rgba(0, 0, 0, 0.12),
                0 3px 6px rgba(0, 0, 0, 0.15);
            color: #00B894;
        }

        @keyframes slideInFromLeft {
            from {
                opacity: 0;
                transform: translateX(-100px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        /* Main Container */
        .register-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px 15px;
            animation: containerFadeIn 1.2s ease-out;
            position: relative;
            z-index: 1;
        }

        @keyframes containerFadeIn {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .register-card {
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 
                0 15px 40px rgba(0, 0, 0, 0.08),
                0 6px 20px rgba(0, 0, 0, 0.06),
                0 2px 8px rgba(0, 0, 0, 0.04),
                inset 0 1px 0 rgba(255, 255, 255, 0.9);
            overflow: hidden;
            width: 100%;
            max-width: 950px;
            min-height: 650px;
            height: auto;
            animation: cardSlideUp 1.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            border: 1px solid rgba(0, 0, 0, 0.04);
        }

        @keyframes cardSlideUp {
            from { 
                opacity: 0; 
                transform: translateY(40px) scale(0.96); 
            }
            to { 
                opacity: 1; 
                transform: translateY(0) scale(1); 
            }
        }

        /* Welcome Section with Background Image */
        .welcome-section {
            background: 
                linear-gradient(135deg, 
                    rgba(0, 184, 148, 0.9) 0%, 
                    rgba(0, 167, 131, 0.95) 50%,
                    rgba(0, 153, 112, 0.9) 100%),
                url('https://images.unsplash.com/photo-1557804506-669a67965ba0?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            color: white;
            padding: 40px 30px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            position: relative;
            overflow: hidden;
            box-shadow: inset -3px 0 10px rgba(0, 0, 0, 0.1);
            min-height: 650px;
        }

        .welcome-section::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.08) 0%, transparent 70%);
            animation: rotate 30s linear infinite;
        }

        .welcome-section::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('data:image/svg+xml,<svg width="40" height="40" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg"><g fill="none" fill-rule="evenodd"><g fill="%23ffffff" fill-opacity="0.03"><circle cx="20" cy="20" r="2"/></g></svg>');
            animation: backgroundMove 25s linear infinite;
        }

        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        @keyframes backgroundMove {
            from { transform: translate(0, 0); }
            to { transform: translate(40px, 40px); }
        }

        .logo-container {
            position: relative;
            z-index: 3;
            margin-bottom: 25px;
            animation: logoFloat 4s ease-in-out infinite;
        }

        @keyframes logoFloat {
            0%, 100% { 
                transform: translateY(0px); 
                filter: drop-shadow(0 6px 15px rgba(0, 0, 0, 0.2));
            }
            50% { 
                transform: translateY(-6px); 
                filter: drop-shadow(0 10px 20px rgba(0, 0, 0, 0.3));
            }
        }

        .logo-container img {
            height: 70px;
            width: auto;
            filter: brightness(0) invert(1);
        }

        .welcome-text {
            position: relative;
            z-index: 3;
        }

        .welcome-text h1 {
            font-size: 2rem;
            font-weight: 800;
            margin-bottom: 15px;
            animation: textSlide 1s ease-out 0.5s both;
            text-shadow: 0 3px 6px rgba(0, 0, 0, 0.2);
        }

        .welcome-text p {
            font-size: 0.95rem;
            opacity: 0.95;
            line-height: 1.5;
            animation: textSlide 1s ease-out 0.7s both;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            max-width: 100%;
            word-wrap: break-word;
        }

        @keyframes textSlide {
            from { 
                opacity: 0; 
                transform: translateX(-30px); 
            }
            to { 
                opacity: 1; 
                transform: translateX(0); 
            }
        }

        /* Form Section */
        .form-section {
            padding: 45px 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background: #ffffff;
            box-shadow: inset 3px 0 10px rgba(0, 0, 0, 0.02);
            min-height: 650px;
        }

        .form-title {
            text-align: center;
            margin-bottom: 35px;
            animation: titleFloat 1s ease-out 0.3s both;
        }

        @keyframes titleFloat {
            from { 
                opacity: 0; 
                transform: translateY(-20px); 
            }
            to { 
                opacity: 1; 
                transform: translateY(0); 
            }
        }

        .form-title h2 {
            color: #333;
            font-weight: 800;
            font-size: 2rem;
            margin-bottom: 10px;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .form-title p {
            color: #666;
            font-size: 1rem;
        }

        /* Enhanced Form Styling */
        .form-group {
            margin-bottom: 20px;
            position: relative;
            animation: formSlide 0.8s ease-out both;
        }

        .form-group:nth-child(1) { animation-delay: 0.4s; }
        .form-group:nth-child(2) { animation-delay: 0.5s; }
        .form-group:nth-child(3) { animation-delay: 0.6s; }
        .form-group:nth-child(4) { animation-delay: 0.7s; }

        @keyframes formSlide {
            from { 
                opacity: 0; 
                transform: translateX(20px); 
            }
            to { 
                opacity: 1; 
                transform: translateX(0); 
            }
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-weight: 700;
            font-size: 0.95rem;
        }

        .form-control-custom {
            width: 100%;
            padding: 14px 18px;
            border: 2px solid rgba(0, 0, 0, 0.08);
            border-radius: 12px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: #ffffff;
            box-shadow: 
                0 2px 6px rgba(0, 0, 0, 0.04),
                inset 0 1px 0 rgba(255, 255, 255, 0.9);
        }

        .form-control-custom:focus {
            outline: none;
            border-color: #00B894;
            background: #ffffff;
            transform: translateY(-1px);
            box-shadow: 
                0 6px 20px rgba(0, 184, 148, 0.15),
                0 0 0 3px rgba(0, 184, 148, 0.1),
                inset 0 1px 0 rgba(255, 255, 255, 1);
        }

        .form-control-custom:hover {
            border-color: rgba(0, 184, 148, 0.3);
            box-shadow: 
                0 3px 12px rgba(0, 0, 0, 0.08),
                inset 0 1px 0 rgba(255, 255, 255, 1);
        }

        /* Error message styling */
        .text-danger {
            font-size: 0.85rem;
            margin-top: 5px;
            color: #dc3545;
            font-weight: 500;
        }

        /* Enhanced Button Styling */
        .btn-register {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #00B894 0%, #00a783 50%, #009970 100%);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 1.1rem;
            font-weight: 700;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            animation: buttonFloat 0.8s ease-out 0.8s both;
            box-shadow: 
                0 4px 15px rgba(0, 184, 148, 0.25),
                0 2px 6px rgba(0, 184, 148, 0.15);
            margin-bottom: 20px;
        }

        @keyframes buttonFloat {
            from { 
                opacity: 0; 
                transform: translateY(20px); 
            }
            to { 
                opacity: 1; 
                transform: translateY(0); 
            }
        }

        .btn-register::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.6s;
        }

        .btn-register:hover::before {
            left: 100%;
        }

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 
                0 8px 25px rgba(0, 184, 148, 0.3),
                0 4px 12px rgba(0, 184, 148, 0.2);
        }

        .btn-register:active {
            transform: translateY(-1px);
        }

        /* Enhanced Google Button */
        .btn-google {
            width: 100%;
            padding: 12px;
            background: #ffffff;
            color: #333;
            border: 2px solid rgba(0, 0, 0, 0.08);
            border-radius: 12px;
            font-size: 1rem;
            font-weight: 600;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            animation: googleButtonFloat 0.8s ease-out 0.9s both;
            box-shadow: 
                0 3px 12px rgba(0, 0, 0, 0.06),
                0 1px 3px rgba(0, 0, 0, 0.08);
            text-decoration: none;
        }

        @keyframes googleButtonFloat {
            from { 
                opacity: 0; 
                transform: translateY(20px); 
            }
            to { 
                opacity: 1; 
                transform: translateY(0); 
            }
        }

        .btn-google:hover {
            background: #ffffff;
            border-color: #dc3545;
            transform: translateY(-1px);
            box-shadow: 
                0 6px 20px rgba(220, 53, 69, 0.15),
                0 3px 8px rgba(0, 0, 0, 0.1);
            color: #333;
            text-decoration: none;
        }

        .divider {
            text-align: center;
            margin: 25px 0;
            position: relative;
            animation: dividerFade 0.8s ease-out 1s both;
        }

        @keyframes dividerFade {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .divider::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(0, 0, 0, 0.1), transparent);
        }

        .divider span {
            background: #ffffff;
            padding: 0 20px;
            color: #666;
            font-size: 0.9rem;
            font-weight: 600;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.04);
        }

        /* Login Link Styling */
        .login-link {
            text-align: center;
            margin-top: 25px;
            padding-bottom: 10px;
            animation: loginLinkFloat 0.8s ease-out 1.1s both;
        }

        @keyframes loginLinkFloat {
            from { 
                opacity: 0; 
                transform: translateY(20px); 
            }
            to { 
                opacity: 1; 
                transform: translateY(0); 
            }
        }

        .login-link p {
            margin: 0;
            color: #666;
            font-size: 0.95rem;
        }

        .login-link-text {
            color: #00B894;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            position: relative;
        }

        .login-link-text::before {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -2px;
            left: 0;
            background: linear-gradient(90deg, #00B894, #00a783);
            transition: width 0.3s ease;
        }

        .login-link-text:hover {
            color: #00a783;
            text-decoration: none;
            transform: translateY(-1px);
        }

        .login-link-text:hover::before {
            width: 100%;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .back-home-btn {
                top: 15px;
                left: 15px;
                padding: 8px 14px;
                font-size: 0.85rem;
            }

            .register-card {
                margin: 10px;
                min-height: 600px;
                border-radius: 16px;
            }

            .welcome-section {
                padding: 30px 25px;
                min-height: 320px;
            }

            .form-section {
                padding: 35px 30px;
                min-height: 450px;
            }

            .welcome-text h1 {
                font-size: 1.7rem;
            }

            .welcome-text p {
                font-size: 0.9rem;
            }

            .form-title h2 {
                font-size: 1.6rem;
            }

            .logo-container img {
                height: 55px;
            }

            .register-container {
                padding: 15px 10px;
            }

            .form-group {
                margin-bottom: 18px;
            }

            .form-title {
                margin-bottom: 25px;
            }
        }

        @media (max-width: 576px) {
            .welcome-section {
                padding: 25px 20px;
                min-height: 300px;
            }

            .form-section {
                padding: 30px 25px;
                min-height: 420px;
            }

            .welcome-text h1 {
                font-size: 1.5rem;
            }

            .welcome-text p {
                font-size: 0.85rem;
            }

            .form-title h2 {
                font-size: 1.4rem;
            }

            .logo-container img {
                height: 50px;
            }

            .register-card {
                min-height: 550px;
            }

            .form-group {
                margin-bottom: 16px;
            }

            .divider {
                margin: 20px 0;
            }

            .login-link {
                margin-top: 20px;
            }
        }

        @media (max-height: 700px) {
            .register-container {
                padding: 15px;
            }
            
            .register-card {
                min-height: auto;
                height: auto;
            }
            
            .welcome-section {
                padding: 25px 30px;
                min-height: auto;
            }
            
            .form-section {
                padding: 30px 40px;
                min-height: auto;
            }
            
            .form-group {
                margin-bottom: 16px;
            }
            
            .form-title {
                margin-bottom: 20px;
            }

            .login-link {
                margin-top: 15px;
            }
        }
    </style>
</head>
<body>
    <!-- Floating Particles -->
    <div class="particles">
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
    </div>

    <!-- Back to Home Button -->
    <a href="/" class="back-home-btn">
        <i class="fas fa-arrow-left me-2"></i>
        Kembali ke Beranda
    </a>

    <div class="register-container">
        <div class="register-card">
            <div class="row g-0 h-100">
                <!-- Welcome Section -->
                <div class="col-lg-6">
                    <div class="welcome-section h-100">
                        <!-- <div class="logo-container">
                            <img src="{{ asset('images/logoutama.png') }}" alt="CariFreelance Logo">
                        </div> -->
                        <div class="welcome-text">
                            <h1>Bergabung Bersama Kami!</h1>
                            <p>Mulai perjalanan freelance Anda atau temukan talenta terbaik untuk proyek impian Anda. Bergabunglah dengan ribuan profesional di platform CariFreelance yang terpercaya.</p>
                        </div>
                    </div>
                </div>

                <!-- Form Section -->
                <div class="col-lg-6">
                    <div class="form-section">
                        <div class="form-title">
                            <h2>Buat Akun Baru</h2>
                            <p>Lengkapi form di bawah untuk memulai</p>
                        </div>

                        <!-- Register Form -->
                        <form method="POST" action="{{ route('register.step1.post') }}">
                            @csrf

                            <div class="form-group">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" name="name" class="form-control-custom" value="{{ old('name') }}" required autofocus 
                                       placeholder="Masukkan nama lengkap Anda">
                                @error('name') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-label">Email Aktif</label>
                                <input type="email" name="email" class="form-control-custom" value="{{ old('email') }}" required 
                                       placeholder="Masukkan email aktif Anda">
                                @error('email') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-label">Kata Sandi</label>
                                <input type="password" name="password" class="form-control-custom" required 
                                       placeholder="Buat kata sandi yang kuat">
                                @error('password') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-label">Konfirmasi Kata Sandi</label>
                                <input type="password" name="password_confirmation" class="form-control-custom" required 
                                       placeholder="Ulangi kata sandi Anda">
                            </div>

                            <button type="submit" class="btn-register">
                                <i class="fas fa-user-plus me-2"></i>
                                Lanjut ke Tahap Berikutnya
                            </button>
                        </form>

                        <!-- Divider -->
                        <div class="divider">
                            <span>atau daftar dengan</span>
                        </div>

                        <!-- Google Register -->
                        <a href="{{ route('google.redirect') }}" class="btn-google">
                            <i class="fab fa-google" style="color: #dc3545;"></i>
                            Daftar dengan Google
                        </a>

                        <!-- Login Link -->
                        <div class="login-link">
                            <p>Sudah punya akun? <a href="/login" class="login-link-text">Masuk disini</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Enhanced interactive effects (same as login page)
        document.addEventListener('DOMContentLoaded', function() {
            // Form input animations
            const inputs = document.querySelectorAll('.form-control-custom');
            
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.style.transform = 'scale(1.01)';
                    this.parentElement.style.transformOrigin = 'center';
                });
                
                input.addEventListener('blur', function() {
                    this.parentElement.style.transform = 'scale(1)';
                });

                // Typing animation effect
                input.addEventListener('input', function() {
                    this.style.transform = 'translateY(-1px)';
                    setTimeout(() => {
                        this.style.transform = 'translateY(-1px)';
                    }, 100);
                });
            });

            // Enhanced button ripple effect
            const buttons = document.querySelectorAll('.btn-register, .btn-google');
            
            buttons.forEach(button => {
                button.addEventListener('click', function(e) {
                    const ripple = document.createElement('span');
                    const rect = this.getBoundingClientRect();
                    const size = Math.max(rect.width, rect.height);
                    const x = e.clientX - rect.left - size / 2;
                    const y = e.clientY - rect.top - size / 2;
                    
                    ripple.style.width = ripple.style.height = size + 'px';
                    ripple.style.left = x + 'px';
                    ripple.style.top = y + 'px';
                    ripple.style.position = 'absolute';
                    ripple.style.borderRadius = '50%';
                    ripple.style.background = 'rgba(255, 255, 255, 0.6)';
                    ripple.style.transform = 'scale(0)';
                    ripple.style.animation = 'ripple 0.6s ease-out';
                    ripple.style.pointerEvents = 'none';
                    ripple.style.zIndex = '1';
                    
                    this.appendChild(ripple);
                    
                    setTimeout(() => {
                        ripple.remove();
                    }, 600);
                });
            });

            // CSS for ripple animation
            const style = document.createElement('style');
            style.textContent = `
                @keyframes ripple {to {
                       transform: scale(4);
                       opacity: 0;
                   }
               }
           `;
           document.head.appendChild(style);

           // Parallax effect for welcome section
           const welcomeSection = document.querySelector('.welcome-section');
           if (welcomeSection) {
               window.addEventListener('scroll', function() {
                   const scrolled = window.pageYOffset;
                   const rate = scrolled * -0.5;
                   welcomeSection.style.transform = `translateY(${rate}px)`;
               });
           }

           // Interactive particle system
           const particles = document.querySelectorAll('.particle');
           particles.forEach((particle, index) => {
               particle.addEventListener('mouseover', function() {
                   this.style.background = `rgba(0, 184, 148, 0.${Math.floor(Math.random() * 3) + 2})`;
                   this.style.transform = 'scale(1.5)';
                   this.style.transition = 'all 0.3s ease';
               });
               
               particle.addEventListener('mouseout', function() {
                   this.style.background = 'rgba(0, 184, 148, 0.08)';
                   this.style.transform = 'scale(1)';
               });
           });

           // Form validation with enhanced feedback
           const form = document.querySelector('form');
           if (form) {
               form.addEventListener('submit', function(e) {
                   const submitButton = this.querySelector('.btn-register');
                   submitButton.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Memproses...';
                   submitButton.disabled = true;
                   
                   // Re-enable if form validation fails
                   setTimeout(() => {
                       if (!form.checkValidity()) {
                           submitButton.innerHTML = '<i class="fas fa-user-plus me-2"></i>Lanjut ke Tahap Berikutnya';
                           submitButton.disabled = false;
                       }
                   }, 100);
               });
           }

           // Enhanced password strength indicator
           const passwordInput = document.querySelector('input[name="password"]');
           const confirmPasswordInput = document.querySelector('input[name="password_confirmation"]');
           
           if (passwordInput) {
               passwordInput.addEventListener('input', function() {
                   const password = this.value;
                   const strength = getPasswordStrength(password);
                   
                   // Remove existing strength indicator
                   const existingIndicator = this.parentElement.querySelector('.password-strength');
                   if (existingIndicator) {
                       existingIndicator.remove();
                   }
                   
                   // Add strength indicator
                   if (password.length > 0) {
                       const strengthIndicator = document.createElement('div');
                       strengthIndicator.className = 'password-strength';
                       strengthIndicator.style.cssText = `
                           margin-top: 5px;
                           height: 3px;
                           border-radius: 2px;
                           transition: all 0.3s ease;
                           background: linear-gradient(90deg, 
                               ${strength.color} ${strength.percentage}%, 
                               rgba(0,0,0,0.1) ${strength.percentage}%);
                       `;
                       this.parentElement.appendChild(strengthIndicator);
                   }
               });
           }

           // Password confirmation matching
           if (confirmPasswordInput) {
               confirmPasswordInput.addEventListener('input', function() {
                   const password = passwordInput.value;
                   const confirmPassword = this.value;
                   
                   // Remove existing match indicator
                   const existingIndicator = this.parentElement.querySelector('.password-match');
                   if (existingIndicator) {
                       existingIndicator.remove();
                   }
                   
                   if (confirmPassword.length > 0) {
                       const matchIndicator = document.createElement('div');
                       matchIndicator.className = 'password-match';
                       const isMatch = password === confirmPassword;
                       
                       matchIndicator.style.cssText = `
                           margin-top: 5px;
                           font-size: 0.8rem;
                           color: ${isMatch ? '#28a745' : '#dc3545'};
                           font-weight: 500;
                       `;
                       matchIndicator.innerHTML = `<i class="fas fa-${isMatch ? 'check' : 'times'} me-1"></i>${isMatch ? 'Kata sandi cocok' : 'Kata sandi tidak cocok'}`;
                       
                       this.parentElement.appendChild(matchIndicator);
                   }
               });
           }

           // Smooth scroll for back to home
           const backHomeBtn = document.querySelector('.back-home-btn');
           if (backHomeBtn) {
               backHomeBtn.addEventListener('mouseenter', function() {
                   this.style.transform = 'translateY(-3px) scale(1.05)';
               });
               
               backHomeBtn.addEventListener('mouseleave', function() {
                   this.style.transform = 'translateY(0) scale(1)';
               });
           }

           // Dynamic background based on time
           const currentHour = new Date().getHours();
           const welcomeSection = document.querySelector('.welcome-section');
           
           if (currentHour >= 18 || currentHour <= 6) {
               // Evening/night theme
               welcomeSection.style.background = `
                   linear-gradient(135deg, 
                       rgba(26, 35, 126, 0.9) 0%, 
                       rgba(21, 101, 192, 0.95) 50%,
                       rgba(13, 71, 161, 0.9) 100%),
                   url('https://images.unsplash.com/photo-1519389950473-47ba0277781c?ixlib=rb-4.0.3&auto=format&fit=crop&w=1470&q=80')
               `;
           }
       });

       // Password strength calculation function
       function getPasswordStrength(password) {
           let score = 0;
           let feedback = [];
           
           // Length check
           if (password.length >= 8) score += 25;
           else feedback.push('minimal 8 karakter');
           
           // Uppercase check
           if (/[A-Z]/.test(password)) score += 25;
           else feedback.push('huruf besar');
           
           // Lowercase check
           if (/[a-z]/.test(password)) score += 25;
           else feedback.push('huruf kecil');
           
           // Number or special character check
           if (/[\d\W]/.test(password)) score += 25;
           else feedback.push('angka/simbol');
           
           // Determine color and message
           let color, message;
           if (score <= 25) {
               color = '#dc3545';
               message = 'Lemah';
           } else if (score <= 50) {
               color = '#fd7e14';
               message = 'Cukup';
           } else if (score <= 75) {
               color = '#ffc107';
               message = 'Baik';
           } else {
               color = '#28a745';
               message = 'Kuat';
           }
           
           return {
               score: score,
               percentage: score,
               color: color,
               message: message,
               feedback: feedback
           };
       }

       // Auto-resize textarea effect for inputs
       const inputs = document.querySelectorAll('.form-control-custom');
       inputs.forEach(input => {
           input.addEventListener('focus', function() {
               this.style.boxShadow = '0 0 0 3px rgba(0, 184, 148, 0.1), 0 6px 20px rgba(0, 184, 148, 0.15)';
           });
           
           input.addEventListener('blur', function() {
               this.style.boxShadow = '0 2px 6px rgba(0, 0, 0, 0.04)';
           });
       });

       // Loading animation for page transition
       window.addEventListener('beforeunload', function() {
           document.body.style.opacity = '0';
           document.body.style.transform = 'scale(0.98)';
           document.body.style.transition = 'all 0.3s ease';
       });
   </script>
</body>
</html>