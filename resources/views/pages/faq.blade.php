@extends('layouts.app')
@section('title', 'FAQ - CariFreelance')
@section('content')

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
        background-color: #f8f9fa;
    }

    /* Header Section */
    .page-header {
        background: linear-gradient(135deg, #1DA1F2 0%, #1d95dfff 50%, #2398e0ff 100%);
        color: white;
        padding: 120px 0 80px;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .page-header::before {
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

    .page-header-content {
        position: relative;
        z-index: 2;
    }

    .page-header h1 {
        font-size: 3rem;
        font-weight: 700;
        margin-bottom: 1rem;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
    }

    .page-header p {
        font-size: 1.2rem;
        opacity: 0.9;
        max-width: 600px;
        margin: 0 auto;
    }

    /* Main Content */
    .main-content {
        padding: 80px 0;
    }

    .content-wrapper {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }

    /* FAQ Section */
    .faq-section {
        background: white;
        border-radius: 20px;
        padding: 60px 40px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        margin-bottom: 60px;
    }

    .faq-section h2 {
        font-size: 2.5rem;
        font-weight: 700;
        color: #333;
        margin-bottom: 3rem;
        text-align: center;
        position: relative;
    }

    .faq-section h2::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        width: 80px;
        height: 4px;
        background: linear-gradient(135deg, #1DA1F2 0%, #2192d8ff 100%);
        border-radius: 2px;
    }

    .faq-container {
        max-width: 800px;
        margin: 0 auto;
    }

    .faq-item {
        background: #f8f9fa;
        border-radius: 15px;
        margin-bottom: 20px;
        overflow: hidden;
        transition: all 0.3s ease;
        border: 2px solid transparent;
    }

    .faq-item:hover {
        border-color: #1DA1F2;
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0,184,148,0.15);
    }

    .faq-question {
        background: linear-gradient(135deg, #1DA1F2 0%, #2099e4ff 100%);
        color: white;
        padding: 20px 25px;
        cursor: pointer;
        font-weight: 600;
        font-size: 1.1rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        position: relative;
        overflow: hidden;
    }

    .faq-question::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.1), transparent);
        transition: left 0.5s ease;
    }

    .faq-question:hover::before {
        left: 100%;
    }

    .faq-toggle {
        width: 30px;
        height: 30px;
        background: rgba(255,255,255,0.2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
        font-size: 1.2rem;
        font-weight: bold;
    }

    .faq-item.active .faq-toggle {
        background: rgba(255,255,255,0.3);
        transform: rotate(45deg);
    }

    .faq-answer {
        max-height: 0;
        overflow: hidden;
        transition: all 0.4s ease;
        background: white;
    }

    .faq-item.active .faq-answer {
        max-height: 500px;
        padding: 25px;
    }

    .faq-answer-content {
        color: #555;
        line-height: 1.7;
        font-size: 1rem;
    }

    .faq-answer-content p {
        margin-bottom: 15px;
    }

    .faq-answer-content ul {
        margin-left: 20px;
        margin-bottom: 15px;
    }

    .faq-answer-content li {
        margin-bottom: 8px;
        color: #666;
    }

    /* Contact Section */
    .contact-section {
        background: linear-gradient(135deg, #1DA1F2 0%, #2695daff 50%, #2e9ee4ff 100%);
        color: white;
        padding: 60px 40px;
        border-radius: 20px;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .contact-section::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
        animation: float 6s ease-in-out infinite;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(-20px) rotate(180deg); }
    }

    .contact-content {
        position: relative;
        z-index: 2;
    }

    .contact-section h2 {
        font-size: 2.2rem;
        font-weight: 700;
        margin-bottom: 1rem;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
    }

    .contact-section p {
        font-size: 1.1rem;
        margin-bottom: 2rem;
        opacity: 0.9;
    }

    .contact-button {
        display: inline-block;
        background: white;
        color: #1DA1F2;
        padding: 15px 40px;
        border-radius: 50px;
        text-decoration: none;
        font-weight: 600;
        font-size: 1.1rem;
        transition: all 0.3s ease;
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        border: 2px solid white;
    }

    .contact-button:hover {
        background: transparent;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.3);
    }

    /* Animation Classes */
    .fade-in {
        opacity: 0;
        transform: translateY(30px);
        transition: all 0.6s ease;
    }

    .fade-in.visible {
        opacity: 1;
        transform: translateY(0);
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .page-header h1 {
            font-size: 2.2rem;
        }

        .faq-section,
        .contact-section {
            padding: 40px 20px;
            margin-bottom: 40px;
        }

        .faq-section h2 {
            font-size: 2rem;
        }

        .faq-question {
            padding: 15px 20px;
            font-size: 1rem;
        }

        .faq-answer-content {
            font-size: 0.9rem;
        }

        .contact-section h2 {
            font-size: 1.8rem;
        }

        .contact-button {
            padding: 12px 30px;
            font-size: 1rem;
        }
    }

    @media (max-width: 480px) {
        .content-wrapper {
            padding: 0 15px;
        }

        .page-header {
            padding: 100px 0 60px;
        }

        .main-content {
            padding: 60px 0;
        }

        .faq-section,
        .contact-section {
            padding: 30px 15px;
        }
    }
</style>

<!-- Page Header -->
<section class="page-header">
    <div class="page-header-content">
        <h1 class="fade-in">Pertanyaan Umum</h1>
        <p class="fade-in">Temukan jawaban untuk pertanyaan yang sering diajukan seputar CariFreelance</p>
    </div>
</section>

<!-- Main Content -->
<main class="main-content">
    <div class="content-wrapper">
        
        <!-- FAQ Section -->
        <section class="faq-section fade-in">
            <h2>FAQ CariFreelance</h2>
            
            <div class="faq-container">
                <div class="faq-item">
                    <div class="faq-question">
                        <span>Bagaimana cara saya mulai sebagai freelancer di CariFreelance?</span>
                        <span class="faq-toggle">+</span>
                    </div>
                    <div class="faq-answer">
                        <div class="faq-answer-content">
                            <p>Untuk memulai sebagai freelancer di CariFreelance, ikuti langkah-langkah berikut:</p>
                            <ul>
                                <li>Daftar akun dengan mengklik tombol "Daftar" di halaman utama</li>
                                <li>Pilih opsi "Menjadi Freelancer" saat proses pendaftaran</li>
                                <li>Lengkapi profil Anda dengan informasi yang akurat dan menarik</li>
                                <li>Upload portfolio terbaik Anda untuk menunjukkan keahlian</li>
                                <li>Verifikasi akun melalui email dan nomor telepon</li>
                                <li>Mulai mencari dan melamar proyek yang sesuai dengan keahlian Anda</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question">
                        <span>Apakah klien harus membayar di awal saat memposting proyek?</span>
                        <span class="faq-toggle">+</span>
                    </div>
                    <div class="faq-answer">
                        <div class="faq-answer-content">
                            <p>Tidak, klien tidak perlu membayar di awal saat memposting proyek. Sistem pembayaran kami bekerja sebagai berikut:</p>
                            <ul>
                                <li>Klien dapat memposting proyek secara gratis</li>
                                <li>Pembayaran dilakukan setelah memilih freelancer yang tepat</li>
                                <li>Dana akan diamankan melalui sistem escrow kami</li>
                                <li>Pembayaran akan dirilis kepada freelancer setelah pekerjaan selesai dan disetujui</li>
                                <li>Jika tidak puas, klien dapat mengajukan refund dengan syarat dan ketentuan yang berlaku</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question">
                        <span>Apa itu sistem escrow di CariFreelance?</span>
                        <span class="faq-toggle">+</span>
                    </div>
                    <div class="faq-answer">
                        <div class="faq-answer-content">
                            <p>Sistem escrow adalah layanan keamanan pembayaran yang melindungi baik klien maupun freelancer:</p>
                            <ul>
                                <li>Dana klien akan disimpan secara aman oleh CariFreelance</li>
                                <li>Freelancer mendapat jaminan bahwa pembayaran tersedia</li>
                                <li>Dana akan dirilis setelah pekerjaan selesai dan disetujui</li>
                                <li>Jika terjadi dispute, tim mediasi kami akan membantu menyelesaikan</li>
                                <li>Sistem ini memastikan transaksi yang aman dan terpercaya</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question">
                        <span>Apakah saya bisa meminta revisi pekerjaan?</span>
                        <span class="faq-toggle">+</span>
                    </div>
                    <div class="faq-answer">
                        <div class="faq-answer-content">
                            <p>Ya, Anda bisa meminta revisi pekerjaan sesuai dengan ketentuan yang telah disepakati:</p>
                            <ul>
                                <li>Jumlah revisi gratis biasanya sudah ditentukan di awal proyek</li>
                                <li>Revisi tambahan dapat dikenakan biaya sesuai kesepakatan</li>
                                <li>Revisi harus sesuai dengan scope pekerjaan yang telah ditentukan</li>
                                <li>Komunikasikan kebutuhan revisi dengan jelas kepada freelancer</li>
                                <li>Revisi mayor yang mengubah scope akan dikenakan biaya tambahan</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question">
                        <span>Bagaimana cara menarik saldo hasil kerja saya?</span>
                        <span class="faq-toggle">+</span>
                    </div>
                    <div class="faq-answer">
                        <div class="faq-answer-content">
                            <p>Proses penarikan saldo sangat mudah dan cepat:</p>
                            <ul>
                                <li>Masuk ke dashboard freelancer Anda</li>
                                <li>Pilih menu "Saldo" atau "Withdraw"</li>
                                <li>Pilih metode penarikan (transfer bank, e-wallet, dll)</li>
                                <li>Masukkan jumlah yang ingin ditarik (minimal Rp 100.000)</li>
                                <li>Konfirmasi penarikan dengan PIN atau OTP</li>
                                <li>Dana akan diproses dalam 1-3 hari kerja</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question">
                        <span>Apakah bisa menghubungi freelancer sebelum memilih?</span>
                        <span class="faq-toggle">+</span>
                    </div>
                    <div class="faq-answer">
                        <div class="faq-answer-content">
                            <p>Tentu saja! Komunikasi adalah kunci kesuksesan proyek:</p>
                            <ul>
                                <li>Anda dapat mengirim pesan langsung kepada freelancer</li>
                                <li>Diskusikan detail proyek sebelum memulai</li>
                                <li>Tanyakan tentang pengalaman dan portfolio mereka</li>
                                <li>Pastikan freelancer memahami kebutuhan Anda</li>
                                <li>Sepakati timeline dan deliverable yang jelas</li>
                                <li>Gunakan sistem chat terintegrasi untuk komunikasi yang aman</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question">
                        <span>Berapa lama waktu yang dibutuhkan untuk menyelesaikan proyek?</span>
                        <span class="faq-toggle">+</span>
                    </div>
                    <div class="faq-answer">
                        <div class="faq-answer-content">
                            <p>Waktu penyelesaian proyek bervariasi tergantung pada kompleksitas dan jenis pekerjaan:</p>
                            <ul>
                                <li>Proyek sederhana: 1-3 hari kerja</li>
                                <li>Proyek menengah: 1-2 minggu</li>
                                <li>Proyek kompleks: 2-4 minggu atau lebih</li>
                                <li>Timeline akan disepakati bersama freelancer sebelum memulai</li>
                                <li>Anda dapat memantau progress melalui dashboard</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question">
                        <span>Bagaimana jika saya tidak puas dengan hasil pekerjaan?</span>
                        <span class="faq-toggle">+</span>
                    </div>
                    <div class="faq-answer">
                        <div class="faq-answer-content">
                            <p>Kami menyediakan beberapa opsi jika Anda tidak puas dengan hasil pekerjaan:</p>
                            <ul>
                                <li>Komunikasikan ketidakpuasan Anda kepada freelancer</li>
                                <li>Minta revisi sesuai dengan ketentuan yang disepakati</li>
                                <li>Hubungi tim mediasi kami untuk bantuan penyelesaian</li>
                                <li>Ajukan refund jika pekerjaan tidak sesuai spesifikasi</li>
                                <li>Sistem escrow melindungi dana Anda selama proses berlangsung</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Contact Section -->
        <section class="contact-section fade-in">
            <div class="contact-content">
                <h2>Butuh Bantuan Lainnya?</h2>
                <p>Masih ada pertanyaan? Tim customer service kami siap membantu Anda 24/7</p>
                <a href="/contact" class="contact-button">Hubungi Kami</a>
            </div>
        </section>

    </div>
</main>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // FAQ Toggle functionality
        const faqItems = document.querySelectorAll('.faq-item');
        
        faqItems.forEach(item => {
            const question = item.querySelector('.faq-question');
            const answer = item.querySelector('.faq-answer');
            const toggle = item.querySelector('.faq-toggle');
            
            question.addEventListener('click', function() {
                const isActive = item.classList.contains('active');
                
                // Close all other FAQ items
                faqItems.forEach(otherItem => {
                    if (otherItem !== item) {
                        otherItem.classList.remove('active');
                        otherItem.querySelector('.faq-toggle').textContent = '+';
                    }
                });
                
                // Toggle current item
                if (isActive) {
                    item.classList.remove('active');
                    toggle.textContent = '+';
                } else {
                    item.classList.add('active');
                    toggle.textContent = '×';
                }
            });
        });
        
        // Scroll animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };
        
        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, observerOptions);
        
        // Observe elements for animation
        document.querySelectorAll('.fade-in').forEach(el => {
            observer.observe(el);
        });
        
        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
        
        // Add hover effects to FAQ items
        faqItems.forEach(item => {
            item.addEventListener('mouseenter', function() {
                if (!this.classList.contains('active')) {
                    this.style.transform = 'translateY(-2px)';
                }
            });
            
            item.addEventListener('mouseleave', function() {
                if (!this.classList.contains('active')) {
                    this.style.transform = 'translateY(0)';
                }
            });
        });
    });
</script>

@endsection