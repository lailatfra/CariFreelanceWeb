<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Freelancer - CariFreelance</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
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
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            min-height: 100vh;
        }

        /* Header Section */
        .form-header {
            background: linear-gradient(135deg, #00B894 0%, #00A085 50%, #008F75 100%);
            padding: 80px 0 60px;
            position: relative;
            overflow: hidden;
        }

        .form-header::before {
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

        .form-header-content {
            position: relative;
            z-index: 2;
            text-align: center;
            color: white;
        }

        .form-header h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
            opacity: 0;
            transform: translateY(30px);
            animation: fadeInUp 0.8s ease forwards;
        }

        .form-header p {
            font-size: 1.1rem;
            opacity: 0.9;
            margin-bottom: 0;
            transform: translateY(30px);
            animation: fadeInUp 0.8s ease 0.2s forwards;
        }

        /* Form Container */
        .form-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.1);
            padding: 40px;
            margin: -40px auto 60px;
            max-width: 800px;
            position: relative;
            z-index: 3;
            transform: translateY(30px);
            opacity: 0;
            animation: fadeInUp 0.8s ease 0.4s forwards;
        }

        .form-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(135deg, #00B894 0%, #00A085 50%, #008F75 100%);
            border-radius: 20px 20px 0 0;
        }

        /* Form Title */
        .form-title {
            text-align: center;
            margin-bottom: 40px;
        }

        .form-title h2 {
            font-size: 2rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 10px;
        }

        .form-title .subtitle {
            color: #666;
            font-size: 1rem;
        }

        /* Form Groups */
        .form-group {
            margin-bottom: 30px;
            position: relative;
            opacity: 0;
            transform: translateX(-20px);
            animation: slideInLeft 0.6s ease forwards;
        }

        .form-group:nth-child(2) { animation-delay: 0.1s; }
        .form-group:nth-child(3) { animation-delay: 0.2s; }
        .form-group:nth-child(4) { animation-delay: 0.3s; }
        .form-group:nth-child(5) { animation-delay: 0.4s; }
        .form-group:nth-child(6) { animation-delay: 0.5s; }

        .form-label {
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .form-label i {
            color: #00B894;
            width: 16px;
        }

        .form-control {
            border: 2px solid #e0e0e0;
            border-radius: 12px;
            padding: 15px 20px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: #fafafa;
        }

        .form-control:focus {
            border-color: #00B894;
            box-shadow: 0 0 0 0.2rem rgba(0, 184, 148, 0.15);
            background: white;
            transform: translateY(-2px);
        }

        .form-control:hover {
            border-color: #00A085;
            background: white;
        }

        textarea.form-control {
            resize: vertical;
            min-height: 120px;
        }

        /* Submit Button */
        .submit-container {
            text-align: center;
            margin-top: 40px;
            opacity: 0;
            transform: translateY(20px);
            animation: fadeInUp 0.6s ease 0.8s forwards;
        }

        .btn-submit {
            background: linear-gradient(135deg, #00B894 0%, #00A085 100%);
            color: white;
            border: none;
            padding: 15px 50px;
            border-radius: 50px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 8px 25px rgba(0,184,148,0.3);
            position: relative;
            overflow: hidden;
        }

        .btn-submit::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }

        .btn-submit:hover::before {
            left: 100%;
        }

        .btn-submit:hover {
            background: linear-gradient(135deg, #00A085 0%, #008F75 100%);
            transform: translateY(-3px);
            box-shadow: 0 12px 35px rgba(0,184,148,0.4);
        }

        .btn-submit:active {
            transform: translateY(-1px);
        }

        /* Error Messages */
        .alert {
            border-radius: 12px;
            border: none;
            margin-top: 20px;
            animation: slideInDown 0.5s ease;
        }

        .alert-danger {
            background: linear-gradient(135deg, #ff6b6b 0%, #ff5252 100%);
            color: white;
        }

        /* Success Animation */
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        .btn-submit.success {
            animation: pulse 0.6s ease;
            background: linear-gradient(135deg, #4caf50 0%, #45a049 100%);
        }

        /* Input Focus Effects */
        .input-group {
            position: relative;
        }

        .input-focus-effect {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(135deg, #00B894 0%, #00A085 100%);
            transition: width 0.3s ease;
        }

        .form-control:focus + .input-focus-effect {
            width: 100%;
        }

        /* Floating Labels Effect */
        .floating-label {
            position: relative;
        }

        .floating-label .form-control:focus + .form-label,
        .floating-label .form-control:not(:placeholder-shown) + .form-label {
            transform: translateY(-25px) scale(0.8);
            color: #00B894;
        }

        /* Progress Indicator */
        .progress-indicator {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-bottom: 30px;
        }

        .progress-dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: #e0e0e0;
            transition: all 0.3s ease;
        }

        .progress-dot.active {
            background: linear-gradient(135deg, #00B894 0%, #00A085 100%);
            transform: scale(1.2);
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes slideInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }

        .form-control.error {
            border-color: #ff5252;
            animation: shake 0.5s ease;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .form-container {
                margin: -20px 15px 40px;
                padding: 30px 20px;
            }
            
            .form-header h1 {
                font-size: 2rem;
            }
            
            .form-title h2 {
                font-size: 1.5rem;
            }
            
            .btn-submit {
                padding: 12px 40px;
                font-size: 1rem;
            }
        }

        /* Loading Animation */
        .btn-submit.loading {
            pointer-events: none;
        }

        .btn-submit.loading::after {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            margin: auto;
            border: 2px solid transparent;
            border-top-color: #ffffff;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Tooltip Effects */
        .tooltip-custom {
            position: relative;
            display: inline-block;
        }

        .tooltip-custom .tooltip-text {
            visibility: hidden;
            width: 200px;
            background-color: #333;
            color: #fff;
            text-align: center;
            border-radius: 6px;
            padding: 8px;
            position: absolute;
            z-index: 1;
            bottom: 125%;
            left: 50%;
            margin-left: -100px;
            opacity: 0;
            transition: opacity 0.3s;
            font-size: 0.9rem;
        }

        .tooltip-custom:hover .tooltip-text {
            visibility: visible;
            opacity: 1;
        }
    </style>
</head>
<body>
    <!-- Header Section -->
    <section class="form-header">
        <div class="container">
            <div class="form-header-content">
                <h1><i class="fas fa-user-edit me-3"></i>Lengkapi Profile Freelancer</h1>
                <p>Buat profile yang menarik untuk mendapatkan lebih banyak klien</p>
            </div>
        </div>
    </section>

    <!-- Form Container -->
    <div class="container">
        <div class="form-container">
            <div class="form-title">
                <h2>Informasi Freelancer</h2>
                <p class="subtitle">Isi data diri Anda dengan lengkap dan akurat</p>
            </div>

            <!-- Progress Indicator -->
            <div class="progress-indicator">
                <div class="progress-dot active"></div>
                <div class="progress-dot"></div>
                <div class="progress-dot"></div>
                <div class="progress-dot"></div>
                <div class="progress-dot"></div>
            </div>

            <form method="POST" action="{{ route('freelancer.profile.store') }}" id="freelancerForm">
                @csrf

                <div class="form-group">
                    <label for="skills" class="form-label">
                        <i class="fas fa-tools"></i>
                        Keahlian
                    </label>
                    <div class="input-group">
                        <input type="text" name="skills" id="skills" class="form-control" 
                               placeholder="Contoh: Desain Grafis, Web Development" required>
                        <div class="input-focus-effect"></div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="experience_years" class="form-label">
                        <i class="fas fa-calendar-alt"></i>
                        Tahun Pengalaman
                    </label>
                    <div class="input-group">
                        <input type="number" name="experience_years" id="experience_years" 
                               class="form-control" placeholder="Contoh: 2" min="0" max="50">
                        <div class="input-focus-effect"></div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="portofolio_link" class="form-label">
                        <i class="fas fa-link"></i>
                        Link Portofolio
                        <span class="tooltip-custom">
                            <i class="fas fa-question-circle text-muted ms-1"></i>
                            <span class="tooltip-text">Masukkan link ke website portofolio, Behance, atau Dribbble Anda</span>
                        </span>
                    </label>
                    <div class="input-group">
                        <input type="url" name="portofolio_link" id="portofolio_link" 
                               class="form-control" placeholder="https://portfolio.com/nama">
                        <div class="input-focus-effect"></div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="phone" class="form-label">
                        <i class="fas fa-phone"></i>
                        Nomor HP
                    </label>
                    <div class="input-group">
                        <input type="text" name="phone" id="phone" class="form-control" 
                               placeholder="08xxxxxxxxxx" pattern="[0-9]{10,13}">
                        <div class="input-focus-effect"></div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="bio" class="form-label">
                        <i class="fas fa-user"></i>
                        Bio
                    </label>
                    <div class="input-group">
                        <textarea name="bio" id="bio" class="form-control" rows="4" 
                                  placeholder="Ceritakan sedikit tentang pengalaman atau spesialisasi Anda..."></textarea>
                        <div class="input-focus-effect"></div>
                    </div>
                    <small class="text-muted">
                        <span id="bioCount">0</span>/500 karakter
                    </small>
                </div>

                <div class="submit-container">
                    <button type="submit" class="btn-submit" id="submitBtn">
                        <i class="fas fa-save me-2"></i>
                        Simpan Profile
                    </button>
                </div>
            </form>

            <!-- Error Messages -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <h6 class="mb-2"><i class="fas fa-exclamation-triangle me-2"></i>Terjadi Kesalahan:</h6>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('freelancerForm');
            const submitBtn = document.getElementById('submitBtn');
            const bioTextarea = document.getElementById('bio');
            const bioCount = document.getElementById('bioCount');
            const progressDots = document.querySelectorAll('.progress-dot');
            const formInputs = document.querySelectorAll('.form-control');

            // Bio character counter
            bioTextarea.addEventListener('input', function() {
                const count = this.value.length;
                bioCount.textContent = count;
                
                if (count > 500) {
                    bioCount.style.color = '#ff5252';
                    this.classList.add('error');
                } else {
                    bioCount.style.color = '#666';
                    this.classList.remove('error');
                }
            });

            // Progress indicator update
            function updateProgress() {
                let filledCount = 0;
                const requiredInputs = document.querySelectorAll('.form-control[required]');
                
                requiredInputs.forEach(input => {
                    if (input.value.trim() !== '') {
                        filledCount++;
                    }
                });

                // Update optional fields
                const optionalInputs = document.querySelectorAll('.form-control:not([required])');
                optionalInputs.forEach(input => {
                    if (input.value.trim() !== '') {
                        filledCount++;
                    }
                });

                progressDots.forEach((dot, index) => {
                    if (index < filledCount) {
                        dot.classList.add('active');
                    } else {
                        dot.classList.remove('active');
                    }
                });
            }

            // Add event listeners to all inputs
            formInputs.forEach(input => {
                input.addEventListener('input', updateProgress);
                input.addEventListener('blur', updateProgress);
            });

            // Form validation and submission
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                // Add loading state
                submitBtn.classList.add('loading');
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Menyimpan...';
                
                // Simulate form submission delay
                setTimeout(() => {
                    // Add success state
                    submitBtn.classList.remove('loading');
                    submitBtn.classList.add('success');
                    submitBtn.innerHTML = '<i class="fas fa-check me-2"></i>Tersimpan!';
                    
                    // Reset after 2 seconds and submit form
                    setTimeout(() => {
                        form.submit();
                    }, 1000);
                }, 1500);
            });

            // Input validation animations
            formInputs.forEach(input => {
                input.addEventListener('invalid', function() {
                    this.classList.add('error');
                    setTimeout(() => {
                        this.classList.remove('error');
                    }, 500);
                });

                input.addEventListener('input', function() {
                    if (this.checkValidity()) {
                        this.classList.remove('error');
                    }
                });
            });

            // Phone number formatting
            const phoneInput = document.getElementById('phone');
            phoneInput.addEventListener('input', function() {
                // Remove all non-numeric characters
                let value = this.value.replace(/\D/g, '');
                
                // Limit to 13 characters
                if (value.length > 13) {
                    value = value.substring(0, 13);
                }
                
                this.value = value;
            });

            // URL validation for portfolio
            const portfolioInput = document.getElementById('portofolio_link');
            portfolioInput.addEventListener('blur', function() {
                if (this.value && !this.value.startsWith('http')) {
                    this.value = 'https://' + this.value;
                }
            });

            // Smooth scroll to error messages
            const errorAlert = document.querySelector('.alert-danger');
            if (errorAlert) {
                errorAlert.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }

            // Initialize progress on page load
            updateProgress();

            // Add floating animation to form container
            const formContainer = document.querySelector('.form-container');
            let ticking = false;

            function updateFormFloat() {
                const scrolled = window.pageYOffset;
                const rate = scrolled * -0.5;
                
                if (!ticking) {
                    requestAnimationFrame(() => {
                        formContainer.style.transform = `translateY(${rate * 0.1}px)`;
                        ticking = false;
                    });
                    ticking = true;
                }
            }

            window.addEventListener('scroll', updateFormFloat);
        });
    </script>
</body>
</html>