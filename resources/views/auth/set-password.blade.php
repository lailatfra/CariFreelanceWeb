<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Password - CariFreelance</title>
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
.back-btn {
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

.back-btn:hover {
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
.password-container {
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

.password-card {
    background: #ffffff;
    border-radius: 20px;
    box-shadow: 
        0 25px 60px rgba(0, 0, 0, 0.12),
        0 10px 30px rgba(0, 0, 0, 0.08),
        0 4px 15px rgba(0, 0, 0, 0.06),
        inset 0 1px 0 rgba(255, 255, 255, 0.9);
    overflow: hidden;
    width: 100%;
    max-width: 500px;
    animation: cardSlideUp 1.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    border: 1px solid rgba(0, 0, 0, 0.04);
    position: relative;
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

/* Header Section */
.password-header {
    background: linear-gradient(135deg, 
                rgba(29, 161, 242, 0.9) 0%, 
                rgba(13, 122, 201, 0.95) 50%,
                rgba(29, 161, 242, 0.9) 100%);
    color: white;
    padding: 40px 30px;
    text-align: center;
    position: relative;
    overflow: hidden;
}

.password-header::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: 
        radial-gradient(circle at 30% 40%, rgba(255, 255, 255, 0.12) 0%, transparent 60%),
        radial-gradient(circle at 70% 60%, rgba(255, 255, 255, 0.08) 0%, transparent 50%);
    animation: rotate 40s linear infinite;
}

@keyframes rotate {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}

.password-header h2 {
    font-size: 2rem;
    font-weight: 900;
    margin-bottom: 10px;
    position: relative;
    z-index: 2;
    animation: titleSlide 1.2s ease-out 0.5s both;
    text-shadow: 
        0 4px 8px rgba(0, 0, 0, 0.25),
        0 2px 4px rgba(0, 0, 0, 0.15);
}

.password-header p {
    font-size: 1rem;
    opacity: 0.96;
    position: relative;
    z-index: 2;
    animation: titleSlide 1.2s ease-out 0.7s both;
    text-shadow: 
        0 3px 6px rgba(0, 0, 0, 0.15),
        0 1px 3px rgba(0, 0, 0, 0.1);
}

@keyframes titleSlide {
    from { 
        opacity: 0; 
        transform: translateY(-25px); 
    }
    to { 
        opacity: 1; 
        transform: translateY(0); 
    }
}

/* Step indicator */
.step-indicator {
    position: absolute;
    top: 15px;
    right: 20px;
    background: rgba(255, 255, 255, 0.2);
    padding: 8px 16px;
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: 600;
    z-index: 3;
    animation: stepFloat 1s ease-out 0.3s both;
}

@keyframes stepFloat {
    from { 
        opacity: 0; 
        transform: translateX(25px); 
    }
    to { 
        opacity: 1; 
        transform: translateX(0); 
    }
}

/* Form Section */
.password-form {
    padding: 50px 40px;
    animation: formFadeIn 1s ease-out 0.8s both;
}

@keyframes formFadeIn {
    from { 
        opacity: 0; 
        transform: translateY(25px); 
    }
    to { 
        opacity: 1; 
        transform: translateY(0); 
    }
}

.form-group {
    margin-bottom: 25px;
    position: relative;
    animation: formSlide 1s ease-out both;
}

.form-group:nth-child(1) { animation-delay: 0.9s; }
.form-group:nth-child(2) { animation-delay: 1s; }

@keyframes formSlide {
    from { 
        opacity: 0; 
        transform: translateX(25px); 
    }
    to { 
        opacity: 1; 
        transform: translateX(0); 
    }
}

.form-label {
    display: block;
    margin-bottom: 10px;
    color: #2c3e50;
    font-weight: 700;
    font-size: 0.95rem;
    transition: color 0.3s ease;
}

.form-control-custom {
    width: 100%;
    padding: 16px 20px;
    border: 2px solid rgba(0, 0, 0, 0.06);
    border-radius: 14px;
    font-size: 1rem;
    font-weight: 500;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    background: #ffffff;
    box-shadow: 
        0 3px 10px rgba(0, 0, 0, 0.06),
        inset 0 1px 0 rgba(255, 255, 255, 1);
    position: relative;
}

.form-control-custom:focus {
    outline: none;
    border-color: #1DA1F2;
    background: #ffffff;
    transform: translateY(-2px);
    box-shadow: 
        0 8px 25px rgba(29, 161, 242, 0.18),
        0 0 0 4px rgba(29, 161, 242, 0.12),
        inset 0 1px 0 rgba(255, 255, 255, 1);
}

.form-control-custom:hover {
    border-color: rgba(29, 161, 242, 0.4);
    transform: translateY(-1px);
    box-shadow: 
        0 5px 15px rgba(0, 0, 0, 0.1),
        inset 0 1px 0 rgba(255, 255, 255, 1);
}

/* Password strength indicator */
.password-strength {
    margin-top: 8px;
    height: 4px;
    border-radius: 2px;
    background: rgba(0, 0, 0, 0.1);
    overflow: hidden;
    transition: all 0.3s ease;
}

.strength-fill {
    height: 100%;
    border-radius: 2px;
    transition: all 0.3s ease;
    background: linear-gradient(90deg, #dc3545, #fd7e14, #ffc107, #28a745);
    background-size: 400% 100%;
}

.strength-text {
    font-size: 0.8rem;
    margin-top: 5px;
    font-weight: 600;
    transition: color 0.3s ease;
}

/* Password match indicator */
.password-match {
    margin-top: 8px;
    font-size: 0.85rem;
    font-weight: 500;
    transition: all 0.3s ease;
}

/* Enhanced Button Styling */
.btn-continue {
    width: 100%;
    padding: 16px;
    background: linear-gradient(135deg, #1DA1F2 0%, #0d7ac9 50%, #1976d2 100%);
    color: white;
    border: none;
    border-radius: 14px;
    font-size: 1.1rem;
    font-weight: 700;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    overflow: hidden;
    animation: buttonFloat 1s ease-out 1.1s both;
    box-shadow: 
        0 6px 20px rgba(29, 161, 242, 0.3),
        0 3px 8px rgba(29, 161, 242, 0.2);
    margin-bottom: 20px;
    background-size: 200% 200%;
}

@keyframes buttonFloat {
    from { 
        opacity: 0; 
        transform: translateY(25px); 
    }
    to { 
        opacity: 1; 
        transform: translateY(0); 
    }
}

.btn-continue::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, 
        transparent, 
        rgba(255, 255, 255, 0.4), 
        transparent);
    transition: left 0.8s ease;
}

.btn-continue:hover::before {
    left: 100%;
}

.btn-continue:hover {
    transform: translateY(-3px);
    box-shadow: 
        0 10px 30px rgba(29, 161, 242, 0.35),
        0 6px 15px rgba(29, 161, 242, 0.25);
    background-position: 100% 100%;
}

.btn-continue:active {
    transform: translateY(-1px);
    transition: all 0.1s ease;
}

.btn-continue:disabled {
    opacity: 0.7;
    cursor: not-allowed;
    transform: none;
    box-shadow: 
        0 3px 8px rgba(29, 161, 242, 0.15);
}

/* Progress indicator */
.progress-steps {
    display: flex;
    justify-content: center;
    gap: 10px;
    margin-top: 20px;
    animation: progressFloat 1s ease-out 1.2s both;
}

@keyframes progressFloat {
    from { 
        opacity: 0; 
        transform: translateY(15px); 
    }
    to { 
        opacity: 1; 
        transform: translateY(0); 
    }
}

.step {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background: rgba(29, 161, 242, 0.3);
    transition: all 0.3s ease;
}

.step.active {
    background: #1DA1F2;
    transform: scale(1.2);
    box-shadow: 0 0 10px rgba(29, 161, 242, 0.5);
}

.step.completed {
    background: #28a745;
    transform: scale(1.1);
}

/* Security tips */
.security-tips {
    background: rgba(29, 161, 242, 0.05);
    border-left: 4px solid #1DA1F2;
    padding: 15px;
    border-radius: 8px;
    margin-top: 25px;
    animation: tipsFloat 1s ease-out 1.3s both;
}

@keyframes tipsFloat {
    from { 
        opacity: 0; 
        transform: translateY(15px); 
    }
    to { 
        opacity: 1; 
        transform: translateY(0); 
    }
}

.security-tips h6 {
    color: #1DA1F2;
    font-weight: 700;
    margin-bottom: 10px;
    font-size: 0.9rem;
}

.security-tips ul {
    margin: 0;
    padding-left: 20px;
    font-size: 0.85rem;
    color: #5a6c7d;
}

.security-tips li {
    margin-bottom: 4px;
    font-weight: 500;
}

/* Responsive Design */
@media (max-width: 768px) {
    .back-btn {
        top: 15px;
        left: 15px;
        padding: 8px 14px;
        font-size: 0.85rem;
    }

    .password-card {
        margin: 10px;
        border-radius: 16px;
        max-width: 450px;
    }

    .password-header {
        padding: 30px 25px;
    }

    .password-header h2 {
        font-size: 1.7rem;
    }

    .password-form {
        padding: 40px 30px;
    }

    .form-group {
        margin-bottom: 22px;
    }
}

@media (max-width: 576px) {
    .password-card {
        max-width: 400px;
    }

    .password-header {
        padding: 25px 20px;
    }

    .password-header h2 {
        font-size: 1.5rem;
    }

    .password-form {
        padding: 35px 25px;
    }

    .form-control-custom {
        padding: 14px 18px;
    }

    .btn-continue {
        padding: 14px;
        font-size: 1rem;
    }
}

/* Loading animation */
.btn-continue.loading {
    pointer-events: none;
}

.btn-continue.loading::after {
    content: '';
    position: absolute;
    width: 20px;
    height: 20px;
    border: 2px solid transparent;
    border-top: 2px solid white;
    border-radius: 50%;
    animation: spin 1s linear infinite;
    right: 20px;
    top: 50%;
    transform: translateY(-50%);
}

@keyframes spin {
    0% { transform: translateY(-50%) rotate(0deg); }
    100% { transform: translateY(-50%) rotate(360deg); }
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

    <!-- Back Button -->
    <a href="#" onclick="history.back()" class="back-btn">
        <i class="fas fa-arrow-left me-2"></i>
        Kembali
    </a>

    <div class="password-container">
        <div class="password-card">
            <!-- Header Section -->
            <div class="password-header">
                <div class="step-indicator">
                    <i class="fas fa-key me-1"></i>
                    Langkah 2
                </div>
                <h2>Buat Password</h2>
                <p>Buat password yang kuat untuk mengamankan akun Anda</p>
            </div>

            <!-- Form Section -->
            <div class="password-form">
                <form action="{{ route('register.savePassword') }}" method="POST" id="passwordForm">
                    @csrf
                    
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-lock me-2"></i>
                            Password Baru
                        </label>
                        <input type="password" class="form-control-custom" name="password" id="password" required 
                               placeholder="Masukkan password yang kuat">
                        <div class="password-strength" id="strengthBar" style="display: none;">
                            <div class="strength-fill" id="strengthFill"></div>
                        </div>
                        <div class="strength-text" id="strengthText"></div>
                        @error('password') 
                            <div class="text-danger mt-2">
                                <i class="fas fa-exclamation-triangle me-1"></i>
                                {{ $message }}
                            </div> 
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-check-circle me-2"></i>
                            Konfirmasi Password
                        </label>
                        <input type="password" class="form-control-custom" name="password_confirmation" id="confirmPassword" required 
                               placeholder="Ulangi password yang sama">
                        <div class="password-match" id="matchIndicator"></div>
                    </div>

                    <button type="submit" class="btn-continue" id="submitBtn" disabled>
                        <i class="fas fa-arrow-right me-2"></i>
                        Lanjut ke Tahap Berikutnya
                    </button>
                </form>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const passwordInput = document.getElementById('password');
            const confirmPasswordInput = document.getElementById('confirmPassword');
            const strengthBar = document.getElementById('strengthBar');
            const strengthFill = document.getElementById('strengthFill');
            const strengthText = document.getElementById('strengthText');
            const matchIndicator = document.getElementById('matchIndicator');
            const submitBtn = document.getElementById('submitBtn');
            const form = document.getElementById('passwordForm');

            // Password strength calculator
            function calculatePasswordStrength(password) {
                let score = 0;
                let feedback = [];
                
                // Length check
                if (password.length >= 8) {
                    score += 25;
                } else {
                    feedback.push('minimal 8 karakter');
                }
                
                // Uppercase check
                if (/[A-Z]/.test(password)) {
                    score += 25;
                } else {
                    feedback.push('huruf besar');
                }
                
                // Lowercase check
                if (/[a-z]/.test(password)) {
                    score += 25;
                } else {
                    feedback.push('huruf kecil');
                }
                
                // Number or special character check
                if (/[\d\W]/.test(password)) {
                    score += 25;
                } else {
                    feedback.push('angka/simbol');
                }
                
                return { score, feedback };
            }

            // Update password strength indicator
            function updatePasswordStrength() {
                const password = passwordInput.value;
                
                if (password.length === 0) {
                    strengthBar.style.display = 'none';
                    strengthText.textContent = '';
                    return;
                }

                strengthBar.style.display = 'block';
                const { score, feedback } = calculatePasswordStrength(password);
                
                // Update strength bar
                strengthFill.style.width = score + '%';
                
                // Update colors and text based on strength
                let color, text, bgPosition;
                if (score <= 25) {
                    color = '#dc3545';
                    text = 'Lemah';
                    bgPosition = '0%';
                } else if (score <= 50) {
                    color = '#fd7e14';
                    text = 'Cukup';
                    bgPosition = '33%';
                } else if (score <= 75) {
                    color = '#ffc107';
                    text = 'Baik';
                    bgPosition = '66%';
                } else {
                    color = '#28a745';
                    text = 'Kuat';
                    bgPosition = '100%';
                }
                
                strengthFill.style.backgroundPosition = bgPosition + ' 0%';
                strengthText.style.color = color;
                
                if (feedback.length > 0) {
                    strengthText.innerHTML = `<i class="fas fa-info-circle me-1"></i>${text} - Tambahkan: ${feedback.join(', ')}`;
                } else {
                    strengthText.innerHTML = `<i class="fas fa-check-circle me-1"></i>${text} - Password aman!`;
                }

                checkFormValidity();
            }

            // Check password confirmation match
            function checkPasswordMatch() {
                const password = passwordInput.value;
                const confirmPassword = confirmPasswordInput.value;
                
                if (confirmPassword.length === 0) {
                    matchIndicator.innerHTML = '';
                    return;
                }
                
                const isMatch = password === confirmPassword;
                const color = isMatch ? '#28a745' : '#dc3545';
                const icon = isMatch ? 'check' : 'times';
                const text = isMatch ? 'Password cocok!' : 'Password tidak cocok';
                
                matchIndicator.style.color = color;
                matchIndicator.innerHTML = `<i class="fas fa-${icon} me-1"></i>${text}`;
                
                checkFormValidity();
            }

            // Check if form is valid and enable/disable submit button
            function checkFormValidity() {
                const password = passwordInput.value;
                const confirmPassword = confirmPasswordInput.value;
                const { score } = calculatePasswordStrength(password);
                const isMatch = password === confirmPassword;
                const isValid = score >= 75 && isMatch && password.length > 0 && confirmPassword.length > 0;
                
                submitBtn.disabled = !isValid;
                
                if (isValid) {
                    submitBtn.classList.remove('btn-secondary');
                    submitBtn.style.opacity = '1';
                    submitBtn.style.cursor = 'pointer';
                } else {
                    submitBtn.style.opacity = '0.7';
                    submitBtn.style.cursor = 'not-allowed';
                }
            }

            // Event listeners
            passwordInput.addEventListener('input', updatePasswordStrength);
            confirmPasswordInput.addEventListener('input', checkPasswordMatch);

            // Form submission with loading state
            form.addEventListener('submit', function(e) {
                const submitButton = this.querySelector('.btn-continue');
                submitButton.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Memproses...';
                submitButton.classList.add('loading');
                submitButton.disabled = true;
            });

            // Input focus effects
            const inputs = document.querySelectorAll('.form-control-custom');
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.style.transform = 'scale(1.01)';
                    this.parentElement.style.transformOrigin = 'center';
                });
                
                input.addEventListener('blur', function() {
                    this.parentElement.style.transform = 'scale(1)';
                });
            });

            // Interactive particles
            const particles = document.querySelectorAll('.particle');
            particles.forEach((particle, index) => {
                particle.addEventListener('mouseover', function() {
                    this.style.background = `rgba(29, 161, 242, 0.${Math.floor(Math.random() * 3) + 2})`;
                    this.style.transform = 'scale(1.5)';
                    this.style.transition = 'all 0.3s ease';
                });
                
                particle.addEventListener('mouseout', function() {
                    this.style.background = 'rgba(0, 184, 148, 0.08)';
                    this.style.transform = 'scale(1)';
                });
            });

            // Enhanced back button interaction
            const backBtn = document.querySelector('.back-btn');
            if (backBtn) {
                backBtn.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-3px) scale(1.05)';
                });
                
                backBtn.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0) scale(1)';
                });
            }
        });
    </script>
</body>
</html>