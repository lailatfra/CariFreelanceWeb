    <!DOCTYPE html>
    <html lang="id">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Profile Client - CariFreelance</title>
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
        background: #ffffff;
        min-height: 100vh;
        position: relative;
        overflow-x: hidden;
    }

    /* Subtle background pattern matching login page */
    body::before {
        content: '';
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: 
            radial-gradient(circle at 20% 50%, rgba(29, 161, 242, 0.02) 0%, transparent 50%),
            radial-gradient(circle at 80% 20%, rgba(13, 122, 201, 0.02) 0%, transparent 50%),
            radial-gradient(circle at 40% 80%, rgba(29, 161, 242, 0.02) 0%, transparent 50%);
        z-index: -1;
    }

    /* Floating particles */
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
        background: rgba(29, 161, 242, 0.08);
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

    /* Header Section with Blue Theme */
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
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255, 255, 255, 0.08) 0%, transparent 70%);
        animation: rotate 30s linear infinite;
        z-index: 1;
    }

    .form-header::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: url('data:image/svg+xml,<svg width="40" height="40" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg"><g fill="none" fill-rule="evenodd"><g fill="%23ffffff" fill-opacity="0.03"><circle cx="20" cy="20" r="2"/></g></svg>');
        animation: backgroundMove 25s linear infinite;
        z-index: 1;
    }

    @keyframes rotate {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }

    @keyframes backgroundMove {
        from { transform: translate(0, 0); }
        to { transform: translate(40px, 40px); }
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
        opacity: 0.95;
        margin-bottom: 0;
        transform: translateY(30px);
        animation: fadeInUp 0.8s ease 0.2s forwards;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    /* Form Container with Blue Accents */
    .form-container {
        background: white;
        border-radius: 20px;
        box-shadow: 
            0 15px 40px rgba(0, 0, 0, 0.08),
            0 6px 20px rgba(0, 0, 0, 0.06),
            0 2px 8px rgba(0, 0, 0, 0.04),
            inset 0 1px 0 rgba(255, 255, 255, 0.9);
        padding: 40px;
        margin: -40px auto 60px;
        max-width: 800px;
        position: relative;
        z-index: 3;
        transform: translateY(30px);
        opacity: 0;
        animation: fadeInUp 0.8s ease 0.4s forwards;
        border: 1px solid rgba(0, 0, 0, 0.04);
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
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    }

    .form-title .subtitle {
        color: #666;
        font-size: 1rem;
    }

    /* Form Groups with Blue Theme */
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
        border: 2px solid rgba(0, 0, 0, 0.08);
        border-radius: 12px;
        padding: 15px 20px;
        font-size: 1rem;
        transition: all 0.3s ease;
        background: #ffffff;
        box-shadow: 
            0 2px 6px rgba(0, 0, 0, 0.04),
            inset 0 1px 0 rgba(255, 255, 255, 0.9);
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

    /* Submit Button with Blue Theme */
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
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        transition: left 0.6s;
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

    /* Error Messages with Blue Theme */
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

    /* Input Focus Effects with Blue Theme */
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

    /* Progress Indicator with Blue Theme */
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

    /* Character Counter */
    .char-counter {
        font-size: 0.875rem;
        color: #666;
        margin-top: 5px;
    }

    .char-counter.limit {
        color: #ff5252;
    }

    /* Preview Image Styling */
    #profilePreview {
        border: 2px solid rgba(29, 161, 242, 0.2);
        padding: 5px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    #profilePreview:hover {
        border-color: #1DA1F2;
        transform: scale(1.05);
        box-shadow: 0 6px 20px rgba(29, 161, 242, 0.2);
    }

    /* Dynamic particle animation */
    .dynamic-particle {
        position: fixed;
        background: rgba(29, 161, 242, 0.1);
        border-radius: 50%;
        z-index: 0;
        pointer-events: none;
        animation: floatUp 20s linear infinite;
    }

    @keyframes floatUp {
        0% {
            transform: translateY(0) rotate(0deg);
            opacity: 0;
        }
        10% { opacity: 1; }
        90% { opacity: 1; }
        100% {
            transform: translateY(-100vh) rotate(360deg);
            opacity: 0;
        }
    }
        </style>
    </head>

    <body>
        <!-- Header Section -->
    <section class="form-header">
        <div class="container">
            <div class="form-header-content">
                <h1><i class="fas fa-building me-3"></i>Lengkapi Profile Client</h1>
                <p>Buat profile perusahaan yang menarik untuk menarik freelancer terbaik</p>
            </div>
        </div>
    </section>

    <!-- Form Container -->
    <div class="container">
        <div class="form-container">
            <div class="form-title">
                <h2>Informasi Perusahaan</h2>
                <p class="subtitle">Isi data perusahaan Anda dengan lengkap dan akurat</p>
            </div>

            <!-- Progress Indicator -->
            <div class="progress-indicator">
                <div class="progress-dot active"></div>
                <div class="progress-dot"></div>
                <div class="progress-dot"></div>
                <div class="progress-dot"></div>
            </div>

            <form method="POST" action="{{ route('client.profile.store') }}" id="clientForm" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="company_name" class="form-label">
                        <i class="fas fa-building"></i>
                        Nama Perusahaan
                    </label>
                    <div class="input-group">
                        <input type="text" name="company_name" id="company_name" class="form-control"
                            placeholder="Nama Perusahaan">
                        <div class="input-focus-effect"></div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="tujuan" class="form-label">
                        <i class="fas fa-bullseye"></i>
                        Tujuan
                    </label>
                    <div class="input-group">
                        <input type="text" name="tujuan" id="tujuan" class="form-control"
                            placeholder="Contoh: Mencari freelancer untuk membangun website">
                        <div class="input-focus-effect"></div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="location" class="form-label">
                        <i class="fas fa-map-marker-alt"></i>
                        Lokasi
                    </label>
                    <div class="input-group">
                        <input type="text" name="location" id="location" class="form-control"
                            placeholder="Kota / Negara">
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
                        <i class="fas fa-info-circle"></i>
                        Bio
                    </label>
                    <div class="input-group">
                        <textarea name="bio" id="bio" class="form-control" rows="4"
                            placeholder="Tulis bio singkat tentang perusahaan Anda..."></textarea>
                        <div class="input-focus-effect"></div>
                    </div>
                    <small class="char-counter">
                        <span id="bioCount">0</span>/500 karakter
                    </small>
                </div>

                <div class="form-group">
                    <label for="profile_photo" class="form-label">
                        <i class="fas fa-image"></i>
                        Foto Profil / Logo Perusahaan (berupa jpg, png, atau jpeg max. 2MB)
                    </label>
                    <div class="input-group">
                        <input type="file" name="profile_photo" id="profile_photo" class="form-control"
                            accept="image/png, image/jpeg, image/jpg">
                        <div class="input-focus-effect"></div>
                    </div>

                    <!-- Preview -->
                    <div class="mt-3 text-center">
                        <img id="profilePreview"
                            src="{{ asset('images/default-avatar.png') }}"
                            alt="Preview Foto Profil"
                            class="img-fluid rounded"
                            style="max-width: 150px; border: 2px solid #ddd; padding: 5px;">
                    </div>
                </div>

                <div class="submit-container">
                    <button type="submit" class="btn-submit" id="submitBtn">
                        <i class="fas fa-save me-2"></i>
                        Simpan
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
            document.getElementById('profile_photo').addEventListener('change', function(event) {
                let preview = document.getElementById('profilePreview');
                let file = event.target.files[0];
                if (file) {
                    let reader = new FileReader();
                    reader.onload = function(e) {
                        preview.src = e.target.result;
                    }
                    reader.readAsDataURL(file);
                } else {
                    preview.src = "{{ asset('images/default-avatar.png') }}";
                }
            });

            document.addEventListener('DOMContentLoaded', function() {
                const form = document.getElementById('clientForm');
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
                        bioCount.parentElement.classList.add('limit');
                        this.classList.add('error');
                    } else {
                        bioCount.parentElement.classList.remove('limit');
                        this.classList.remove('error');
                    }
                });

                // Progress indicator update
                function updateProgress() {
                    let filledCount = 0;

                    formInputs.forEach(input => {
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

                // URL validation for website
                const websiteInput = document.getElementById('website');
                websiteInput.addEventListener('blur', function() {
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