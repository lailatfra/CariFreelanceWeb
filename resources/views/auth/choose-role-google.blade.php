<!DOCTYPE html>
<html lang="id">
<!-- choose role  -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CariFreelance - Daftar Sebagai</title>
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
        radial-gradient(circle at 20% 50%, rgba(29, 161, 242, 0.02) 0%, transparent 50%),
        radial-gradient(circle at 80% 20%, rgba(13, 122, 201, 0.02) 0%, transparent 50%),
        radial-gradient(circle at 40% 80%, rgba(29, 161, 242, 0.02) 0%, transparent 50%);
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
    color: #1DA1F2;
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

/* Card Header dengan gaya sama seperti welcome section */
.card-header-custom {
    background: 
        linear-gradient(135deg, 
            rgba(29, 161, 242, 0.9) 0%, 
            rgba(13, 122, 201, 0.95) 50%,
            rgba(29, 161, 242, 0.9) 100%),
        url('https://images.unsplash.com/photo-1556761175-b413da4baf72?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1374&q=80');
    background-size: cover;
    background-position: center;
    color: white;
    padding: 40px 30px;
    text-align: center;
    position: relative;
    overflow: hidden;
    box-shadow: inset 0 -3px 10px rgba(0, 0, 0, 0.1);
}

.card-header-custom::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle, rgba(255, 255, 255, 0.08) 0%, transparent 70%);
    animation: rotate 30s linear infinite;
}

.card-header-custom::after {
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

.card-header-custom h3 {
    margin: 0;
    font-weight: 800;
    font-size: 2rem;
    text-shadow: 0 3px 6px rgba(0, 0, 0, 0.2);
    position: relative;
    z-index: 2;
    animation: titleSlide 0.8s ease-out;
}

@keyframes titleSlide {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.card-header-custom .subtitle {
    margin-top: 15px;
    opacity: 0.95;
    font-size: 0.95rem;
    font-weight: 400;
    position: relative;
    z-index: 2;
    animation: subtitleFade 1s ease-out 0.3s both;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    line-height: 1.5;
}

@keyframes subtitleFade {
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 0.95;
        transform: translateY(0);
    }
}

.card-body-custom {
    padding: 45px 50px;
    background: #ffffff;
    box-shadow: inset 0 3px 10px rgba(0, 0, 0, 0.02);
}

.roles-container {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 30px;
    margin-bottom: 30px;
}

.role-option {
    background: #ffffff;
    border: 2px solid rgba(0, 0, 0, 0.08);
    border-radius: 15px;
    padding: 35px 25px;
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    cursor: pointer;
    position: relative;
    overflow: hidden;
    height: 300px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    text-align: center;
    box-shadow: 
        0 3px 12px rgba(0, 0, 0, 0.06),
        0 1px 3px rgba(0, 0, 0, 0.08);
}

.role-option::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(29, 161, 242, 0.1), transparent);
    transition: left 0.6s;
}

.role-option::after {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 0;
    height: 0;
    background: radial-gradient(circle, rgba(29, 161, 242, 0.1) 0%, transparent 70%);
    border-radius: 50%;
    transform: translate(-50%, -50%);
    transition: all 0.6s ease;
    z-index: 1;
}

.role-option:hover::before {
    left: 100%;
}

.role-option:hover::after {
    width: 300px;
    height: 300px;
}

.role-option:hover {
    border-color: #1DA1F2;
    transform: translateY(-8px) scale(1.02);
    box-shadow: 
        0 15px 35px rgba(29, 161, 242, 0.15),
        0 6px 20px rgba(29, 161, 242, 0.1);
}

.role-option.selected {
    border-color: #1DA1F2;
    background: linear-gradient(135deg, rgba(29, 161, 242, 0.05) 0%, rgba(13, 122, 201, 0.05) 100%);
    transform: translateY(-5px) scale(1.02);
    box-shadow: 
        0 12px 30px rgba(29, 161, 242, 0.2),
        0 6px 15px rgba(29, 161, 242, 0.15);
    animation: selectedPulse 2s ease-in-out infinite;
}

@keyframes selectedPulse {
    0%, 100% { 
        box-shadow: 
            0 12px 30px rgba(29, 161, 242, 0.2),
            0 6px 15px rgba(29, 161, 242, 0.15);
    }
    50% { 
        box-shadow: 
            0 15px 40px rgba(29, 161, 242, 0.25),
            0 8px 20px rgba(29, 161, 242, 0.2);
    }
}

.role-option.selected .role-icon {
    color: #1DA1F2;
    transform: scale(1.15);
    animation: iconBounce 1.2s ease-in-out infinite;
}

@keyframes iconBounce {
    0%, 100% { transform: scale(1.15) translateY(0); }
    50% { transform: scale(1.2) translateY(-5px); }
}

.role-icon {
    font-size: 56px;
    margin-bottom: 20px;
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    display: block;
    position: relative;
    z-index: 2;
    color: #666;
}

.role-title {
    font-size: 24px;
    font-weight: 700;
    margin-bottom: 12px;
    color: #333;
    position: relative;
    z-index: 2;
    transition: all 0.3s ease;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
}

.role-description {
    color: #666;
    font-size: 15px;
    line-height: 1.6;
    margin: 0;
    position: relative;
    z-index: 2;
    transition: all 0.3s ease;
}

.radio-custom {
    position: absolute;
    top: 20px;
    right: 20px;
    width: 24px;
    height: 24px;
    accent-color: #1DA1F2;
    transform: scale(1.3);
    z-index: 3;
    transition: all 0.3s ease;
}

.radio-custom:checked {
    animation: radioCheck 0.5s ease-out;
}

@keyframes radioCheck {
    0% { transform: scale(1.3); }
    50% { transform: scale(1.6); }
    100% { transform: scale(1.3); }
}

/* Individual role animations */
.client-option {
    animation: slideInLeft 0.8s ease-out;
}

.freelancer-option {
    animation: slideInRight 0.8s ease-out;
}

@keyframes slideInLeft {
    from {
        opacity: 0;
        transform: translateX(-50px) translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateX(0) translateY(0);
    }
}

@keyframes slideInRight {
    from {
        opacity: 0;
        transform: translateX(50px) translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateX(0) translateY(0);
    }
}

/* Enhanced Submit Button dengan gaya login */
.submit-btn {
    width: 100%;
    padding: 14px;
    background: linear-gradient(135deg, #1DA1F2 0%, #0d7ac9 50%, #1976d2 100%);
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
        0 4px 15px rgba(29, 161, 242, 0.25),
        0 2px 6px rgba(29, 161, 242, 0.15);
}

.submit-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
    transition: left 0.6s;
}

.submit-btn:hover::before {
    left: 100%;
}

.submit-btn:hover {
    transform: translateY(-2px);
    box-shadow: 
        0 8px 25px rgba(29, 161, 242, 0.3),
        0 4px 12px rgba(29, 161, 242, 0.2);
}

.submit-btn:active {
    transform: translateY(-1px);
    transition: all 0.1s ease;
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

.submit-btn-container {
    animation: buttonSlideUp 1s ease-out 0.5s both;
}

@keyframes buttonSlideUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Icon colors mengikuti tema biru */
.client-icon {
    color: #1DA1F2;
}

.freelancer-icon {
    color: #0d7ac9;
}

/* Floating icon animation */
@keyframes iconFloat {
    0%, 100% { transform: translateY(0px) scale(1); }
    33% { transform: translateY(-8px) scale(1.05); }
    66% { transform: translateY(-4px) scale(1.02); }
}

/* Responsive Design */
@media (max-width: 768px) {
    .back-home-btn {
        top: 15px;
        left: 15px;
        padding: 8px 14px;
        font-size: 0.85rem;
    }

    .register-container {
        padding: 15px 10px;
    }

    .register-card {
        margin: 10px;
        border-radius: 16px;
    }

    .card-header-custom {
        padding: 30px 25px;
    }

    .card-header-custom h3 {
        font-size: 1.7rem;
    }

    .card-header-custom .subtitle {
        font-size: 0.9rem;
    }

    .card-body-custom {
        padding: 35px 30px;
    }

    .roles-container {
        grid-template-columns: 1fr;
        gap: 20px;
    }

    .role-option {
        height: auto;
        padding: 30px 25px;
    }

    .client-option, .freelancer-option {
        animation: slideInUp 0.8s ease-out;
    }

    @keyframes slideInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .role-icon {
        font-size: 48px;
    }

    .role-title {
        font-size: 20px;
    }

    .role-description {
        font-size: 14px;
    }
}

@media (max-width: 576px) {
    .card-header-custom {
        padding: 25px 20px;
    }

    .card-header-custom h3 {
        font-size: 1.5rem;
    }

    .card-header-custom .subtitle {
        font-size: 0.85rem;
    }

    .card-body-custom {
        padding: 30px 25px;
    }

    .role-option {
        padding: 25px 20px;
    }

    .role-icon {
        font-size: 42px;
    }

    .role-title {
        font-size: 18px;
    }

    .role-description {
        font-size: 13px;
    }

    .submit-btn {
        font-size: 1rem;
        padding: 12px;
    }
}

/* Enhanced ripple effect styles */
@keyframes ripple {
    to {
        transform: scale(4);
        opacity: 0;
    }
}

/* Enhanced shake animation for errors */
@keyframes shake {
    0%, 100% { transform: translateX(0); }
    25% { transform: translateX(-5px); }
    75% { transform: translateX(5px); }
}
</style>
</head>
<body>

<!-- Floating particles -->
<div class="particles">
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
</div>

<div class="register-container">
    <div class="card register-card">
        <div class="card-header-custom">
            <h3><i class="fas fa-user-plus me-3"></i>Daftar Sebagai</h3>
            <div class="subtitle">Pilih peran yang sesuai dengan kebutuhan Anda</div>
        </div>
        
        <div class="card-body-custom">
            <form method="POST" action="{{ route('register.saveRole') }}">
                @csrf

                <div class="roles-container">
                    <div class="role-option client-option" onclick="selectRole('client')" id="clientOption">
                        <input class="radio-custom" type="radio" name="role" id="client" value="client" required>
                        <i class="fas fa-user-tie role-icon client-icon"></i>
                        <div class="role-title">Client</div>
                        <p class="role-description">
                            Saya ingin mencari freelancer berbakat untuk menyelesaikan proyek dan mewujudkan ide bisnis saya
                        </p>
                    </div>

                    <div class="role-option freelancer-option" onclick="selectRole('freelancer')" id="freelancerOption">
                        <input class="radio-custom" type="radio" name="role" id="freelancer" value="freelancer" required>
                        <i class="fas fa-laptop-code role-icon freelancer-icon"></i>
                        <div class="role-title">Freelancer</div>
                        <p class="role-description">
                            Saya ingin menawarkan keahlian dan jasa profesional untuk membantu klien mencapai tujuan mereka
                        </p>
                    </div>
                </div>

                <div class="d-grid submit-btn-container">
                    <button type="submit" class="submit-btn">
                        <i class="fas fa-arrow-right me-2"></i>
                        Lanjutkan Pendaftaran
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function selectRole(role) {
        // Remove selected class from all options
        document.querySelectorAll('.role-option').forEach(option => {
            option.classList.remove('selected');
        });
        
        // Add selected class to clicked option with enhanced animation
        const selectedOption = document.getElementById(role + 'Option');
        selectedOption.classList.add('selected');
        
        // Add ripple effect
        const ripple = document.createElement('div');
        ripple.style.cssText = `
            position: absolute;
            border-radius: 50%;
            background: rgba(29, 161, 242, 0.3);
            pointer-events: none;
            transform: scale(0);
            animation: ripple 0.8s ease-out;
            z-index: 1;
        `;
        
        const rect = selectedOption.getBoundingClientRect();
        const size = Math.max(rect.width, rect.height);
        ripple.style.width = ripple.style.height = size + 'px';
        ripple.style.left = '50%';
        ripple.style.top = '50%';
        ripple.style.marginLeft = -size/2 + 'px';
        ripple.style.marginTop = -size/2 + 'px';
        
        selectedOption.appendChild(ripple);
        
        // Remove ripple after animation
        setTimeout(() => {
            if (ripple.parentNode) {
                ripple.parentNode.removeChild(ripple);
            }
        }, 800);
        
        // Check the radio button
        document.getElementById(role).checked = true;
        
        // Trigger radio check animation
        document.getElementById(role).style.animation = 'none';
        setTimeout(() => {
            document.getElementById(role).style.animation = 'radioCheck 0.5s ease-out';
        }, 10);
    }

    // Add click handlers for radio buttons
    document.addEventListener('DOMContentLoaded', function() {
        const radioButtons = document.querySelectorAll('input[name="role"]');
        
        radioButtons.forEach(radio => {
            radio.addEventListener('change', function() {
                selectRole(this.value);
            });
        });

        // Add staggered entrance animation
        const roleOptions = document.querySelectorAll('.role-option');
        roleOptions.forEach((option, index) => {
            option.style.animationDelay = `${index * 0.2}s`;
        });

        // Add floating animation to icons on load
        setTimeout(() => {
            const roleIcons = document.querySelectorAll('.role-icon');
            roleIcons.forEach(icon => {
                icon.style.animation = 'iconFloat 3s ease-in-out infinite';
            });
        }, 1000);

        // Add particle effect on selection
        function createParticles(element) {
            for (let i = 0; i < 6; i++) {
                const particle = document.createElement('div');
                particle.style.cssText = `
                    position: absolute;
                    width: 6px;
                    height: 6px;
                    background: #1DA1F2;
                    border-radius: 50%;
                    pointer-events: none;
                    z-index: 1000;
                `;
                
                const rect = element.getBoundingClientRect();
                const centerX = rect.left + rect.width / 2;
                const centerY = rect.top + rect.height / 2;
                
                particle.style.left = centerX + 'px';
                particle.style.top = centerY + 'px';
                
                document.body.appendChild(particle);
                
                const angle = (i / 6) * Math.PI * 2;
                const distance = 100;
                const endX = centerX + Math.cos(angle) * distance;
                const endY = centerY + Math.sin(angle) * distance;
                
                particle.animate([
                    { transform: 'translate(0, 0) scale(1)', opacity: 1 },
                    { transform: `translate(${endX - centerX}px, ${endY - centerY}px) scale(0)`, opacity: 0 }
                ], {
                    duration: 800,
                    easing: 'ease-out'
                }).onfinish = () => particle.remove();
            }
        }

        // Enhanced selectRole function with particles
        window.selectRoleWithEffect = function(role) {
            selectRole(role);
            const selectedOption = document.getElementById(role + 'Option');
            createParticles(selectedOption);
        };
    });
</script>
</body>
</html>