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
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        min-height: 100vh;
    }

    .verification-section {
        padding: 120px 20px;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        position: relative;
        overflow: hidden;
    }

    .verification-section::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(0, 184, 148, 0.1) 0%, transparent 70%);
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
        box-shadow: 0 20px 60px rgba(0, 184, 148, 0.1);
        text-align: center;
        position: relative;
        overflow: hidden;
        border: 1px solid rgba(0, 184, 148, 0.1);
    }

    .verification-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(135deg, #00B894 0%, #00A085 50%, #008F75 100%);
    }

    .verification-icon {
        width: 100px;
        height: 100px;
        background: linear-gradient(135deg, #00B894 0%, #00A085 50%, #008F75 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 30px;
        font-size: 3rem;
        color: white;
        box-shadow: 0 10px 30px rgba(0, 184, 148, 0.3);
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0% { transform: scale(1); box-shadow: 0 10px 30px rgba(0, 184, 148, 0.3); }
        50% { transform: scale(1.05); box-shadow: 0 15px 40px rgba(0, 184, 148, 0.4); }
        100% { transform: scale(1); box-shadow: 0 10px 30px rgba(0, 184, 148, 0.3); }
    }

    .verification-title {
        font-size: 2.2rem;
        font-weight: 700;
        color: #333;
        margin-bottom: 20px;
        background: linear-gradient(135deg, #00B894 0%, #00A085 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .verification-message {
        font-size: 1.1rem;
        color: #666;
        margin-bottom: 35px;
        line-height: 1.7;
    }

    .resend-form {
        margin-top: 30px;
    }

    .btn-resend {
        background: linear-gradient(135deg, #00B894 0%, #00A085 100%);
        color: white;
        padding: 15px 35px;
        border-radius: 50px;
        border: none;
        font-weight: 600;
        font-size: 1rem;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 8px 25px rgba(0, 184, 148, 0.3);
        position: relative;
        overflow: hidden;
    }

    .btn-resend:hover {
        background: linear-gradient(135deg, #00A085 0%, #008F75 100%);
        transform: translateY(-2px);
        box-shadow: 0 12px 35px rgba(0, 184, 148, 0.4);
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
        background: linear-gradient(135deg, #00d4aa 0%, #00B894 100%);
        color: white;
        padding: 20px 30px;
        border-radius: 15px;
        margin-top: 25px;
        border: none;
        box-shadow: 0 8px 25px rgba(0, 212, 170, 0.3);
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
        background: rgba(0, 184, 148, 0.05);
        border: 1px solid rgba(0, 184, 148, 0.1);
        border-radius: 15px;
        padding: 25px;
        margin-top: 30px;
        text-align: left;
    }

    .email-tips h5 {
        color: #00B894;
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
        color: #00B894;
        font-weight: bold;
        flex-shrink: 0;
        margin-top: 2px;
    }

    .back-link {
        margin-top: 30px;
        padding-top: 25px;
        border-top: 1px solid #e9ecef;
    }

    .back-link a {
        color: #00B894;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .back-link a:hover {
        color: #00A085;
        transform: translateX(-5px);
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