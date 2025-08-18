<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CariFreelance - Daftar Sebagai</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            min-height: 100vh;
            padding-top: 100px;
        }

        .register-container {
            max-width: 950px;
            margin: 0 auto;
            padding: 20px;
        }

        .register-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border: none;
            overflow: hidden;
            position: relative;
        }

        .register-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #00B894, #00a783);
        }

        .card-header-custom {
            background: linear-gradient(135deg, #00B894 0%, #00a783 100%);
            color: white;
            padding: 30px;
            text-align: center;
            border: none;
            position: relative;
            overflow: hidden;
        }

        .card-header-custom::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            animation: headerGlow 4s ease-in-out infinite;
        }

        @keyframes headerGlow {
            0%, 100% { transform: translateX(-10px) translateY(-10px) scale(1); }
            50% { transform: translateX(10px) translateY(10px) scale(1.05); }
        }

        .card-header-custom h3 {
            margin: 0;
            font-weight: 700;
            font-size: 28px;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
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
            margin-top: 10px;
            opacity: 0.9;
            font-size: 16px;
            font-weight: 400;
            position: relative;
            z-index: 2;
            animation: subtitleFade 1s ease-out 0.3s both;
        }

        @keyframes subtitleFade {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 0.9;
                transform: translateY(0);
            }
        }

        .card-body-custom {
            padding: 40px;
        }

        .roles-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            margin-bottom: 30px;
        }

        .role-option {
            background: white;
            border: 2px solid #e9ecef;
            border-radius: 15px;
            padding: 30px 25px;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            cursor: pointer;
            position: relative;
            overflow: hidden;
            height: 280px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            text-align: center;
        }

        .role-option::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(0, 184, 148, 0.1), transparent);
            transition: left 0.6s;
        }

        .role-option::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background: radial-gradient(circle, rgba(0, 184, 148, 0.1) 0%, transparent 70%);
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
            border-color: #00B894;
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 15px 35px rgba(0, 184, 148, 0.2);
        }

        .role-option.selected {
            border-color: #00B894;
            background: linear-gradient(135deg, rgba(0, 184, 148, 0.05) 0%, rgba(0, 167, 131, 0.05) 100%);
            transform: translateY(-5px) scale(1.02);
            box-shadow: 0 12px 30px rgba(0, 184, 148, 0.25);
            animation: selectedPulse 2s ease-in-out infinite;
        }

        @keyframes selectedPulse {
            0%, 100% { box-shadow: 0 12px 30px rgba(0, 184, 148, 0.25); }
            50% { box-shadow: 0 15px 40px rgba(0, 184, 148, 0.35); }
        }

        .role-option.selected .role-icon {
            color: #00B894;
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
        }

        .role-title {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 12px;
            color: #333;
            position: relative;
            z-index: 2;
            transition: all 0.3s ease;
        }

        .role-description {
            color: #6c757d;
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
            accent-color: #00B894;
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

        .submit-btn {
            background: linear-gradient(135deg, #00B894 0%, #00a783 100%);
            border: none;
            border-radius: 50px;
            padding: 18px 50px;
            font-size: 16px;
            font-weight: 600;
            color: white;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative;
            overflow: hidden;
            box-shadow: 0 6px 20px rgba(0, 184, 148, 0.2);
        }

        .submit-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.6s;
        }

        .submit-btn::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            transform: translate(-50%, -50%);
            transition: all 0.4s ease;
        }

        .submit-btn:hover::before {
            left: 100%;
        }

        .submit-btn:hover::after {
            width: 300px;
            height: 300px;
        }

        .submit-btn:hover {
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 12px 30px rgba(0, 184, 148, 0.35);
            background: linear-gradient(135deg, #00a783 0%, #009973 100%);
        }

        .submit-btn:active {
            transform: translateY(-1px) scale(1.02);
            transition: all 0.1s ease;
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

        .client-icon {
            color: #007bff;
        }

        .freelancer-icon {
            color: #28a745;
        }

        @media (max-width: 768px) {
            .register-container {
                padding: 15px;
            }

            .roles-container {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .role-option {
                height: auto;
                padding: 25px 20px;
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

            .card-header-custom {
                padding: 25px 20px;
            }

            .card-header-custom h3 {
                font-size: 24px;
            }

            .card-body-custom {
                padding: 30px 20px;
            }

            .role-icon {
                font-size: 48px;
            }

            .role-title {
                font-size: 20px;
            }
        }

        /* Animation for page load */
        .register-card {
            animation: slideInUp 0.6s ease-out;
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
    </style>
</head>
<body>
    <!-- Your existing navbar here -->
    
    <div class="register-container">
        <div class="card register-card">
            <div class="card-header-custom">
                <h3><i class="fas fa-user-plus me-3"></i>Daftar Sebagai</h3>
                <div class="subtitle">Pilih peran yang sesuai dengan kebutuhan Anda</div>
            </div>
            
            <div class="card-body-custom">
                <form method="POST" action="{{ route('register.step2.post') }}">
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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
                background: rgba(0, 184, 148, 0.3);
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

        // Add ripple keyframes
        if (!document.querySelector('#ripple-styles')) {
            const rippleStyle = document.createElement('style');
            rippleStyle.id = 'ripple-styles';
            rippleStyle.textContent = `
                @keyframes ripple {
                    to {
                        transform: scale(2);
                        opacity: 0;
                    }
                }
            `;
            document.head.appendChild(rippleStyle);
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
                        background: #00B894;
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

        // Add floating keyframes
        const style = document.createElement('style');
        style.textContent = `
            @keyframes iconFloat {
                0%, 100% { transform: translateY(0px) scale(1); }
                33% { transform: translateY(-8px) scale(1.05); }
                66% { transform: translateY(-4px) scale(1.02); }
            }
        `;
        document.head.appendChild(style);
    </script>
</body>
</html>