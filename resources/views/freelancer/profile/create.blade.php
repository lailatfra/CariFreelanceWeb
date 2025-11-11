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

.form-header {
    background: 
        linear-gradient(135deg, rgba(29, 161, 242, 0.9) 0%, rgba(13, 122, 201, 0.95) 50%, rgba(29, 161, 242, 0.9) 100%),
        url('https://images.unsplash.com/photo-1522071820081-009f0129c71c?ixlib=rb-4.0.3&auto=format&fit=crop&w=1950&q=80');
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
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
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
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
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
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
    background: linear-gradient(135deg, #1DA1F2 0%, #0d7ac9 50%, #1976d2 100%);
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

        .form-group:nth-child(2) {
            animation-delay: 0.1s;
        }

        .form-group:nth-child(3) {
            animation-delay: 0.2s;
        }

        .form-group:nth-child(4) {
            animation-delay: 0.3s;
        }

        .form-group:nth-child(5) {
            animation-delay: 0.4s;
        }

        .form-group:nth-child(6) {
            animation-delay: 0.5s;
        }

        .form-label {
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

.form-label i {
    color: #1DA1F2;
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
    border-color: #1DA1F2;
    box-shadow: 
        0 6px 20px rgba(29, 161, 242, 0.15),
        0 0 0 3px rgba(29, 161, 242, 0.1),
        inset 0 1px 0 rgba(255, 255, 255, 1);
    background: white;
    transform: translateY(-2px);
    outline: none;
}


.form-control:hover {
    border-color: rgba(29, 161, 242, 0.3);
    background: white;
    box-shadow: 
        0 3px 12px rgba(0, 0, 0, 0.08),
        inset 0 1px 0 rgba(255, 255, 255, 1);
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
    background: linear-gradient(135deg, #1DA1F2 0%, #0d7ac9 50%, #1976d2 100%);
    color: white;
    border: none;
    padding: 15px 50px;
    border-radius: 50px;
    font-size: 1.1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 
        0 4px 15px rgba(29, 161, 242, 0.25),
        0 2px 6px rgba(29, 161, 242, 0.15);
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
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .btn-submit:hover::before {
            left: 100%;
        }


.btn-submit:hover {
    background: linear-gradient(135deg, #0d7ac9 0%, #1976d2 50%, #1565c0 100%);
    transform: translateY(-3px);
    box-shadow: 
        0 8px 25px rgba(29, 161, 242, 0.3),
        0 4px 12px rgba(29, 161, 242, 0.2);
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
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }

            100% {
                transform: scale(1);
            }
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
    background: linear-gradient(135deg, #1DA1F2 0%, #0d7ac9 100%);
    transition: width 0.3s ease;
}

        .form-control:focus+.input-focus-effect {
            width: 100%;
        }

        /* Floating Labels Effect */
        .floating-label {
            position: relative;
        }

        .floating-label .form-control:focus+.form-label,
        .floating-label .form-control:not(:placeholder-shown)+.form-label {
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
    background: linear-gradient(135deg, #1DA1F2 0%, #0d7ac9 100%);
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

            0%,
            100% {
                transform: translateX(0);
            }

            25% {
                transform: translateX(-5px);
            }

            75% {
                transform: translateX(5px);
            }
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
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
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

            <form method="POST" action="{{ route('freelancer.profile.store') }}" id="freelancerForm" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="full_name" class="form-label">
                        <i class="fas fa-user"></i> Nama Lengkap
                    </label>
                    <input type="text" name="full_name" id="full_name" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="username" class="form-label">
                        <i class="fas fa-at"></i> Username
                    </label>
                    <input type="text" name="username" id="username" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="headline" class="form-label">
                        <i class="fas fa-briefcase"></i> Headline
                    </label>
                    <input type="text" name="headline" id="headline" class="form-control" placeholder="Contoh: Web Developer | Graphic Designer">
                </div>

                <div class="form-group">
                    <label for="location" class="form-label">
                        <i class="fas fa-map-marker-alt"></i> Lokasi
                    </label>
                    <input type="text" name="location" id="location" class="form-control">
                </div>

                <!-- <div class="form-group">
                    <label for="category" class="form-label">
                        <i class="fas fa-layer-group"></i> Kategori Utama
                    </label>
                    <input type="text" name="category" id="category" class="form-control">
                </div> -->

                <div class="form-group">
                    <label for="subskills" class="form-label">
                        <i class="fas fa-code"></i> Subskills
                    </label>
                    <input type="text" name="subskills" id="subskills" class="form-control" placeholder="Pisahkan dengan koma, contoh: Laravel, React, UI/UX">
                </div>

                <!-- <div class="form-group">
                    <label for="skills" class="form-label">
                        <i class="fas fa-tools"></i> Keahlian Utama
                    </label>
                    <input type="text" name="skills" id="skills" class="form-control" required>
                </div> -->

                <div class="form-group">
                    <label for="experience_years" class="form-label">
                        <i class="fas fa-calendar-alt"></i> Tahun Pengalaman
                    </label>
                    <input type="number" name="experience_years" id="experience_years" class="form-control" min="0" max="50">
                </div>

                <div class="form-group">
                    <label for="portofolio_link" class="form-label">
                        <i class="fas fa-link"></i> Link Portofolio
                    </label>
                    <input type="url" name="portofolio_link" id="portofolio_link" class="form-control">
                </div>

                <div class="form-group">
                    <label for="phone" class="form-label">
                        <i class="fas fa-phone"></i> Nomor HP
                    </label>
                    <input type="text" name="phone" id="phone" class="form-control">
                </div>

                <div class="form-group">
                    <label for="profile_photo" class="form-label">
                        <i class="fas fa-image"></i> Foto Profil
                    </label>
                    <input type="file" name="profile_photo" id="profile_photo" class="form-control">
                </div>

                <!-- <div class="form-group">
                    <label for="identity_document" class="form-label">
                        <i class="fas fa-id-card"></i> Dokumen Identitas (KTP/SIM)
                    </label>
                    <input type="file" name="identity_document" id="identity_document" class="form-control">
                </div> -->

                <!-- <div class="form-group">
                    <label for="npwp" class="form-label">
                        <i class="fas fa-file-invoice"></i> NPWP
                    </label>
                    <input type="text" name="npwp" id="npwp" class="form-control">
                </div> -->

                <!-- <div class="form-group">
                    <label for="hourly_rate" class="form-label">
                        <i class="fas fa-money-bill"></i> Tarif per Jam
                    </label>
                    <input type="number" name="hourly_rate" id="hourly_rate" class="form-control">
                </div> -->

                <!-- <div class="form-group">
                    <label for="languages" class="form-label">
                        <i class="fas fa-language"></i> Bahasa
                    </label>
                    <input type="text" name="languages" id="languages" class="form-control" placeholder="Contoh: Indonesia, English">
                </div> -->

                <!-- <div class="form-group">
                    <label for="work_type" class="form-label">
                        <i class="fas fa-laptop-house"></i> Jenis Pekerjaan
                    </label>
                    <input type="text" name="work_type" id="work_type" class="form-control" placeholder="Remote / Onsite / Hybrid">
                </div> -->

                <div class="form-group">
                    <label for="bio" class="form-label">
                        <i class="fas fa-user"></i> Bio
                    </label>
                    <textarea name="bio" id="bio" class="form-control" rows="4" maxlength="500"></textarea>
                    <small class="text-muted"><span id="bioCount">0</span>/500 karakter</small>
                </div>

                <div class="submit-container">
                    <button type="submit" class="btn-submit">
                        <i class="fas fa-save me-2"></i> Simpan Profile
                    </button>
                </div>
            </form>

            <!-- Error Messages -->
            @if ($errors->any())
            <div class="alert alert-danger mt-3">
                <h6><i class="fas fa-exclamation-triangle me-2"></i>Terjadi Kesalahan:</h6>
                <ul>
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
                submitBtn.classList.add('loading');
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Menyimpan...';
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
                errorAlert.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
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