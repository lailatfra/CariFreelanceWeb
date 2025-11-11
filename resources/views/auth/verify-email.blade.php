<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Email - CariFreelance</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>

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

/* Subtle background pattern untuk tekstur */
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

.verification-section {
    padding: 120px 20px;
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #ffffff;
    position: relative;
    overflow: hidden;
    z-index: 1;
}

.verification-section::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle, rgba(29, 161, 242, 0.1) 0%, transparent 70%);
    animation: float 6s ease-in-out infinite;
}

@keyframes float {
    0%, 100% { transform: translateY(0px) rotate(0deg); }
    50% { transform: translateY(-20px) rotate(180deg); }
}

.verification-container {
    width: 100%;
    max-width: 600px;
    margin: 0 auto;
    position: relative;
    z-index: 2;
}

.verification-card {
    background: white;
    border-radius: 20px;
    padding: 50px 40px;
    box-shadow: 
        0 15px 40px rgba(29, 161, 242, 0.08),
        0 6px 20px rgba(29, 161, 242, 0.06),
        0 2px 8px rgba(0, 0, 0, 0.04),
        inset 0 1px 0 rgba(255, 255, 255, 0.9);
    text-align: center;
    position: relative;
    overflow: hidden;
    border: 1px solid rgba(29, 161, 242, 0.1);
    animation: cardSlideUp 1.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
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

.verification-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(135deg, #1DA1F2 0%, #0d7ac9 50%, #1976d2 100%);
}

.verification-icon {
    width: 100px;
    height: 100px;
    background: linear-gradient(135deg, #1DA1F2 0%, #0d7ac9 50%, #1976d2 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 30px;
    font-size: 3rem;
    color: white;
    box-shadow: 0 10px 30px rgba(29, 161, 242, 0.3);
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0% { transform: scale(1); box-shadow: 0 10px 30px rgba(29, 161, 242, 0.3); }
    50% { transform: scale(1.05); box-shadow: 0 15px 40px rgba(29, 161, 242, 0.4); }
    100% { transform: scale(1); box-shadow: 0 10px 30px rgba(29, 161, 242, 0.3); }
}

.verification-title {
    font-size: 2.2rem;
    font-weight: 700;
    color: #333;
    margin-bottom: 20px;
    background: linear-gradient(135deg, #1DA1F2 0%, #0d7ac9 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
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

.verification-message {
    font-size: 1.1rem;
    color: #666;
    margin-bottom: 35px;
    line-height: 1.7;
    animation: messageSlide 0.8s ease-out 0.5s both;
}

@keyframes messageSlide {
    from { 
        opacity: 0; 
        transform: translateX(-30px); 
    }
    to { 
        opacity: 1; 
        transform: translateX(0); 
    }
}

.resend-form {
    margin-top: 30px;
    animation: formSlide 0.8s ease-out 0.7s both;
}

@keyframes formSlide {
    from { 
        opacity: 0; 
        transform: translateY(20px); 
    }
    to { 
        opacity: 1; 
        transform: translateY(0); 
    }
}

.btn-resend {
    background: linear-gradient(135deg, #1DA1F2 0%, #0d7ac9 50%, #1976d2 100%);
    color: white;
    padding: 15px 35px;
    border-radius: 50px;
    border: none;
    font-weight: 600;
    font-size: 1rem;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 
        0 8px 25px rgba(29, 161, 242, 0.25),
        0 2px 6px rgba(29, 161, 242, 0.15);
    position: relative;
    overflow: hidden;
}

.btn-resend:hover {
    background: linear-gradient(135deg, #0d7ac9 0%, #1976d2 100%);
    transform: translateY(-2px);
    box-shadow: 
        0 12px 35px rgba(29, 161, 242, 0.4),
        0 4px 12px rgba(29, 161, 242, 0.2);
    color: white;
}

.btn-resend:active {
    transform: translateY(0);
}

.btn-resend::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.5s;
}

.btn-resend:hover::before {
    left: 100%;
}

.success-alert {
    background: linear-gradient(135deg, #1DA1F2 0%, #0d7ac9 100%);
    color: white;
    padding: 20px 30px;
    border-radius: 15px;
    margin-top: 25px;
    border: none;
    box-shadow: 0 8px 25px rgba(29, 161, 242, 0.3);
    animation: slideInUp 0.5s ease-out;
    position: relative;
    overflow: hidden;
}

.success-alert::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="20" cy="20" r="2" fill="rgba(255,255,255,0.1)"><animate attributeName="r" values="2;5;2" dur="2s" repeatCount="indefinite"/></circle><circle cx="80" cy="30" r="3" fill="rgba(255,255,255,0.1)"><animate attributeName="r" values="3;6;3" dur="2.5s" repeatCount="indefinite"/></circle><circle cx="60" cy="70" r="2" fill="rgba(255,255,255,0.1)"><animate attributeName="r" values="2;4;2" dur="3s" repeatCount="indefinite"/></circle></svg>') repeat;
    opacity: 0.1;
}

.success-alert .alert-content {
    position: relative;
    z-index: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    font-weight: 600;
}

.success-icon {
    width: 24px;
    height: 24px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
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

.email-tips {
    background: rgba(29, 161, 242, 0.05);
    border: 1px solid rgba(29, 161, 242, 0.1);
    border-radius: 15px;
    padding: 25px;
    margin-top: 30px;
    text-align: left;
    animation: tipsSlide 0.8s ease-out 0.9s both;
}

@keyframes tipsSlide {
    from { 
        opacity: 0; 
        transform: translateY(20px); 
    }
    to { 
        opacity: 1; 
        transform: translateY(0); 
    }
}

.email-tips h5 {
    color: #1DA1F2;
    font-weight: 600;
    margin-bottom: 15px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.email-tips ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.email-tips li {
    padding: 8px 0;
    color: #666;
    display: flex;
    align-items: flex-start;
    gap: 10px;
}

.email-tips li::before {
    content: '✓';
    color: #1DA1F2;
    font-weight: bold;
    flex-shrink: 0;
    margin-top: 2px;
}

.back-link {
    margin-top: 30px;
    padding-top: 25px;
    border-top: 1px solid #e9ecef;
    animation: linkSlide 0.8s ease-out 1.1s both;
}

@keyframes linkSlide {
    from { 
        opacity: 0; 
        transform: translateX(-20px); 
    }
    to { 
        opacity: 1; 
        transform: translateX(0); 
    }
}

.back-link a {
    color: #1DA1F2;
    text-decoration: none;
    font-weight: 500;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    position: relative;
}

.back-link a::before {
    content: '';
    position: absolute;
    width: 0;
    height: 2px;
    bottom: -2px;
    left: 0;
    background: linear-gradient(90deg, #1DA1F2, #0d7ac9);
    transition: width 0.3s ease;
}

.back-link a:hover {
    color: #0d7ac9;
    transform: translateX(-5px);
}

.back-link a:hover::before {
    width: 100%;
}

/* Responsive Design */
@media (max-width: 768px) {
    .verification-section {
        padding: 80px 15px;
    }
    
    .verification-card {
        padding: 40px 25px;
    }
    
    .verification-title {
        font-size: 1.8rem;
    }
    
    .verification-message {
        font-size: 1rem;
    }
    
    .btn-resend {
        padding: 12px 25px;
        font-size: 0.9rem;
    }
}

@media (max-width: 480px) {
    .verification-section {
        padding: 60px 10px;
    }
    
    .verification-card {
        padding: 30px 20px;
    }
    
    .verification-icon {
        width: 80px;
        height: 80px;
        font-size: 2.5rem;
    }
    
    .verification-title {
        font-size: 1.6rem;
    }
    
    .email-tips {
        padding: 20px;
    }
}
</style>

<section class="verification-section">
    <div class="verification-container">
        <div class="verification-card">
                <div class="verification-icon">
                    <i class="fas fa-envelope-open"></i>
                </div>
                
                <h1 class="verification-title">Verifikasi Email Kamu</h1>
                
                <p class="verification-message">
                    Kami telah mengirimkan link verifikasi ke alamat email kamu.<br>
                    Silakan cek email dan klik link untuk melanjutkan menggunakan CariFreelance.
                </p>

                <form class="resend-form" method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit" class="btn-resend">
                        <i class="fas fa-paper-plane"></i>&nbsp;&nbsp;Kirim Ulang Email Verifikasi
                    </button>
                </form>

                @if (session('status') == 'verification-link-sent')
                    <div class="success-alert">
                        <div class="alert-content">
                            <div class="success-icon">
                                <i class="fas fa-check"></i>
                            </div>
                            Link verifikasi baru telah dikirim ke email kamu!
                        </div>
                    </div>
                @endif

                <div class="email-tips">
                    <h5>
                        <i class="fas fa-lightbulb"></i>
                        Tips Verifikasi Email
                    </h5>
                    <ul>
                        <li>Periksa folder spam atau junk mail jika email tidak ditemukan</li>
                        <li>Pastikan alamat email yang kamu daftarkan sudah benar</li>
                        <li>Link verifikasi berlaku selama 24 jam setelah dikirim</li>
                        <li>Hubungi customer service jika masih mengalami kendala</li>
                    </ul>
                </div>

                <div class="back-link">
                    <a href="{{ route('home') }}">
                        <i class="fas fa-arrow-left"></i>
                        Kembali ke Beranda
                    </a>
                </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add smooth animations
        const card = document.querySelector('.verification-card');
        const icon = document.querySelector('.verification-icon');
        
        // Initial animation
        card.style.opacity = '0';
        card.style.transform = 'translateY(30px)';
        
        setTimeout(() => {
            card.style.transition = 'all 0.8s ease';
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, 100);
        
        // Button click animation
        const resendBtn = document.querySelector('.btn-resend');
        if (resendBtn) {
            resendBtn.addEventListener('click', function() {
                this.style.transform = 'scale(0.95)';
                setTimeout(() => {
                    this.style.transform = '';
                }, 150);
            });
        }
        
        // Auto-hide success message after 5 seconds
        const successAlert = document.querySelector('.success-alert');
        if (successAlert) {
            setTimeout(() => {
                successAlert.style.transition = 'all 0.5s ease';
                successAlert.style.opacity = '0';
                successAlert.style.transform = 'translateY(-20px)';
                setTimeout(() => {
                    successAlert.style.display = 'none';
                }, 500);
            }, 5000);
        }
    });
</script>

</body>
</html>