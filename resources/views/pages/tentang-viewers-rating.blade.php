@extends('layouts.app')
@section('title', 'Rating & Review - CariFreelance')
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
        background: #f8f9fa;
    }

    /* Header Section */
    .rating-header {
        background: linear-gradient(135deg, #1DA1F2 0%, #1DA1F2 50%, #1DA1F2 100%);
        padding: 120px 0 80px;
        color: white;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .rating-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('https://images.unsplash.com/photo-1556745757-8d76bdb6984b?ixlib=rb-4.0.3&auto=format&fit=crop&w=1950&q=80') center/cover;
        opacity: 0.1;
        z-index: 1;
    }

    .rating-header-content {
        position: relative;
        z-index: 2;
    }

    .rating-header h1 {
        font-size: 3rem;
        font-weight: 700;
        margin-bottom: 1rem;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
    }

    .rating-header p {
        font-size: 1.2rem;
        opacity: 0.9;
        max-width: 600px;
        margin: 0 auto;
    }

    /* Stats Overview */
    .stats-overview {
        background: white;
        padding: 60px 0;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 40px;
        margin-top: 2rem;
    }

    .stat-item {
        text-align: center;
        padding: 20px;
        border-radius: 15px;
        background: linear-gradient(135deg, #1DA1F2 0%, #219ae6ff 100%);
        color: white;
        transform: translateY(20px);
        opacity: 0;
        transition: all 0.6s ease;
    }

    .stat-item.animate {
        transform: translateY(0);
        opacity: 1;
    }

    .stat-number {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 10px;
        display: block;
    }

    .stat-label {
        font-size: 1rem;
        opacity: 0.9;
    }

    /* Rating Overview Section */
    .rating-overview {
        padding: 80px 0;
        background: white;
    }

    .rating-summary {
        display: grid;
        grid-template-columns: 1fr 2fr;
        gap: 50px;
        margin-bottom: 60px;
    }

    .overall-rating {
        text-align: center;
        padding: 40px;
        background: linear-gradient(135deg, #1DA1F2 0%, #259ae2ff 100%);
        border-radius: 20px;
        color: white;
        transform: scale(0.9);
        opacity: 0;
        transition: all 0.6s ease;
    }

    .overall-rating.animate {
        transform: scale(1);
        opacity: 1;
    }

    .overall-score {
        font-size: 4rem;
        font-weight: 700;
        margin-bottom: 10px;
    }

    .overall-stars {
        font-size: 2rem;
        margin-bottom: 15px;
    }

    .overall-count {
        font-size: 1.1rem;
        opacity: 0.9;
    }

    .rating-breakdown {
        padding: 20px;
    }

    .rating-row {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
        opacity: 0;
        transform: translateX(30px);
        transition: all 0.6s ease;
    }

    .rating-row.animate {
        opacity: 1;
        transform: translateX(0);
    }

    .rating-stars {
        display: flex;
        margin-right: 15px;
        min-width: 120px;
    }

    .star {
        color: #ffc107;
        font-size: 1.2rem;
        margin-right: 2px;
    }

    .star.empty {
        color: #ddd;
    }

    .rating-bar {
        flex: 1;
        height: 10px;
        background: #e0e0e0;
        border-radius: 5px;
        margin-right: 15px;
        overflow: hidden;
    }

    .rating-fill {
        height: 100%;
        background: linear-gradient(135deg, #1DA1F2 0%, #1f9ae6ff 100%);
        border-radius: 5px;
        transition: width 1s ease;
    }

    .rating-count {
        min-width: 50px;
        text-align: right;
        font-weight: 600;
        color: #666;
    }

    /* Reviews Section */
    .reviews-section {
        padding: 80px 0;
        background: #f8f9fa;
    }

    .reviews-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
        gap: 30px;
        margin-top: 3rem;
    }

    .review-card {
        background: white;
        border-radius: 20px;
        padding: 30px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
        transform: translateY(30px);
        opacity: 0;
    }

    .review-card.animate {
        transform: translateY(0);
        opacity: 1;
    }

    .review-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px #1a4b69ff;
    }

    .review-header {
        display: flex;
        align-items: center;
        margin-bottom: 20px;
    }

    .reviewer-avatar {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: linear-gradient(135deg, #1DA1F2 0%, #219ce9ff 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.5rem;
        font-weight: 600;
        margin-right: 15px;
    }

    .reviewer-info h4 {
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 5px;
    }

    .review-stars {
        display: flex;
        margin-bottom: 5px;
    }

    .review-date {
        font-size: 0.9rem;
        color: #666;
    }

    .review-text {
        color: #555;
        line-height: 1.7;
        margin-bottom: 20px;
    }

    .review-project {
        background: #f8f9fa;
        padding: 15px;
        border-radius: 10px;
        border-left: 4px solid #1DA1F2;
    }

    .review-project h5 {
        font-size: 0.9rem;
        color: #1DA1F2;
        margin-bottom: 5px;
    }

    .review-project p {
        font-size: 0.9rem;
        color: #666;
        margin: 0;
    }

    /* Add Review Section */
    .add-review-section {
        padding: 80px 0;
        background: white;
    }

    .review-form {
        max-width: 800px;
        margin: 0 auto;
        background: white;
        padding: 40px;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        transform: translateY(30px);
        opacity: 0;
        transition: all 0.6s ease;
    }

    .review-form.animate {
        transform: translateY(0);
        opacity: 1;
    }

    .form-group {
        margin-bottom: 25px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: #333;
    }

    .form-control {
        width: 100%;
        padding: 15px;
        border: 2px solid #e0e0e0;
        border-radius: 10px;
        font-size: 1rem;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: #1DA1F2;
        outline: none;
        box-shadow: 0 0 0 3px rgba(0, 184, 148, 0.1);
    }

    .star-rating {
        display: flex;
        gap: 5px;
        margin-bottom: 20px;
    }

    .star-input {
        font-size: 2rem;
        color: #ddd;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .star-input:hover,
    .star-input.active {
        color: #ffc107;
        transform: scale(1.1);
    }

    .btn-submit {
        background: linear-gradient(135deg, #1DA1F2 0%, #2499e2ff 100%);
        color: white;
        padding: 15px 40px;
        border: none;
        border-radius: 50px;
        font-size: 1.1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 5px 15px rgba(0,184,148,0.3);
    }

    .btn-submit:hover {
        background: linear-gradient(135deg, #1DA1F2 0%, #2a99dfff 100%);
        transform: translateY(-2px);
        box-shadow: 0 8px 25px #1c5274ff;
    }

    .btn-submit:disabled {
        opacity: 0.6;
        cursor: not-allowed;
        transform: none;
    }

    /* Login Required Message */
    .login-required {
        background: linear-gradient(135deg, #ff6b6b 0%, #ee5a52 100%);
        color: white;
        padding: 20px;
        border-radius: 15px;
        text-align: center;
        margin-bottom: 30px;
    }

    .login-required h3 {
        margin-bottom: 10px;
    }

    .btn-login {
        background: white;
        color: #ff6b6b;
        padding: 10px 25px;
        border: none;
        border-radius: 25px;
        font-weight: 600;
        text-decoration: none;
        display: inline-block;
        margin-top: 10px;
        transition: all 0.3s ease;
    }

    .btn-login:hover {
        background: #f8f9fa;
        transform: translateY(-2px);
    }

    /* Filter Section */
    .filter-section {
        background: white;
        padding: 30px 0;
        border-bottom: 1px solid #e0e0e0;
    }

    .filter-buttons {
        display: flex;
        justify-content: center;
        gap: 15px;
        flex-wrap: wrap;
    }

    .filter-btn {
        padding: 10px 20px;
        background: transparent;
        border: 2px solid #e0e0e0;
        border-radius: 25px;
        color: #666;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .filter-btn.active {
        background: #1DA1F2;
        color: white;
        border-color: #1DA1F2;
    }

    .filter-btn:hover {
        border-color: #1DA1F2;
        color: #1DA1F2;
    }

    .filter-btn.active:hover {
        background: #1DA1F2;
        color: white;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .rating-header h1 {
            font-size: 2.5rem;
        }
        
        .rating-summary {
            grid-template-columns: 1fr;
            gap: 30px;
        }
        
        .reviews-grid {
            grid-template-columns: 1fr;
        }
        
        .review-form {
            padding: 30px 20px;
        }
        
        .filter-buttons {
            flex-direction: column;
            align-items: center;
        }
    }

    /* Loading Animation */
    .loading-spinner {
        display: inline-block;
        width: 20px;
        height: 20px;
        border: 2px solid #ffffff;
        border-radius: 50%;
        border-top-color: transparent;
        animation: spin 1s ease-in-out infinite;
    }

    @keyframes spin {
        to { transform: rotate(360deg); }
    }

    /* Success Message */
    .success-message {
        background: linear-gradient(135deg, #1DA1F2 0%, #1DA1F2 100%);
        color: white;
        padding: 20px;
        border-radius: 15px;
        text-align: center;
        margin-bottom: 30px;
        display: none;
    }

    .success-message.show {
        display: block;
        animation: slideInFromTop 0.5s ease-out;
    }

    @keyframes slideInFromTop {
        from {
            transform: translateY(-100%);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }
</style>

<!-- Header Section -->
<section class="rating-header">
    <div class="container">
        <div class="rating-header-content">
            <h1>Rating & Review</h1>
            <p>Lihat penilaian dari klien dan berikan review Anda untuk membantu freelancer lain</p>
        </div>
    </div>
</section>

<!-- Rating Overview -->
<section class="rating-overview">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-6 fw-bold">Overview Rating</h2>
            <p class="lead text-muted">Distribusi rating dari seluruh pengguna platform</p>
        </div>
        
        <div class="rating-summary">
            <div class="overall-rating">
                <div class="overall-score">4.8</div>
                <div class="overall-stars">
                    <span class="star">★</span>
                    <span class="star">★</span>
                    <span class="star">★</span>
                    <span class="star">★</span>
                    <span class="star">★</span>
                </div>
                <div class="overall-count">Berdasarkan 12,547 review</div>
            </div>
            
            <div class="rating-breakdown">
                <div class="rating-row" data-delay="0">
                    <div class="rating-stars">
                        <span class="star">★</span>
                        <span class="star">★</span>
                        <span class="star">★</span>
                        <span class="star">★</span>
                        <span class="star">★</span>
                    </div>
                    <div class="rating-bar">
                        <div class="rating-fill" data-width="75%"></div>
                    </div>
                    <div class="rating-count">9,410</div>
                </div>
                <div class="rating-row" data-delay="200">
                    <div class="rating-stars">
                        <span class="star">★</span>
                        <span class="star">★</span>
                        <span class="star">★</span>
                        <span class="star">★</span>
                        <span class="star empty">★</span>
                    </div>
                    <div class="rating-bar">
                        <div class="rating-fill" data-width="18%"></div>
                    </div>
                    <div class="rating-count">2,258</div>
                </div>
                <div class="rating-row" data-delay="400">
                    <div class="rating-stars">
                        <span class="star">★</span>
                        <span class="star">★</span>
                        <span class="star">★</span>
                        <span class="star empty">★</span>
                        <span class="star empty">★</span>
                    </div>
                    <div class="rating-bar">
                        <div class="rating-fill" data-width="4%"></div>
                    </div>
                    <div class="rating-count">502</div>
                </div>
                <div class="rating-row" data-delay="600">
                    <div class="rating-stars">
                        <span class="star">★</span>
                        <span class="star">★</span>
                        <span class="star empty">★</span>
                        <span class="star empty">★</span>
                        <span class="star empty">★</span>
                    </div>
                    <div class="rating-bar">
                        <div class="rating-fill" data-width="2%"></div>
                    </div>
                    <div class="rating-count">251</div>
                </div>
                <div class="rating-row" data-delay="800">
                    <div class="rating-stars">
                        <span class="star">★</span>
                        <span class="star empty">★</span>
                        <span class="star empty">★</span>
                        <span class="star empty">★</span>
                        <span class="star empty">★</span>
                    </div>
                    <div class="rating-bar">
                        <div class="rating-fill" data-width="1%"></div>
                    </div>
                    <div class="rating-count">126</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Filter Section -->
<section class="filter-section">
    <div class="container">
        <div class="filter-buttons">
            <button class="filter-btn active" data-filter="all">Semua Review</button>
            <button class="filter-btn" data-filter="5">5 Bintang</button>
            <button class="filter-btn" data-filter="4">4 Bintang</button>
            <button class="filter-btn" data-filter="3">3 Bintang</button>
            <button class="filter-btn" data-filter="2">2 Bintang</button>
            <button class="filter-btn" data-filter="1">1 Bintang</button>
        </div>
    </div>
</section>

<!-- Reviews Section -->
<section class="reviews-section">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-6 fw-bold">Review dari Klien</h2>
            <p class="lead text-muted">Pengalaman nyata dari klien yang telah menggunakan jasa freelancer</p>
        </div>
        
        <div class="reviews-grid">
            <div class="review-card" data-rating="5" data-delay="0">
                <div class="review-header">
                    <div class="reviewer-avatar">AM</div>
                    <div class="reviewer-info">
                        <h4>Ahmad Maulana</h4>
                        <div class="review-stars">
                            <span class="star">★</span>
                            <span class="star">★</span>
                            <span class="star">★</span>
                            <span class="star">★</span>
                            <span class="star">★</span>
                        </div>
                        <div class="review-date">2 hari yang lalu</div>
                    </div>
                </div>
                <div class="review-text">
                    Sangat puas dengan hasil website yang dibuat! Freelancer sangat profesional dan responsif. Proses pengerjaan sesuai deadline dan hasil melebihi ekspektasi. Akan menggunakan jasa lagi untuk proyek selanjutnya.
                </div>
                <div class="review-project">
                    <h5>Proyek: Website Company Profile</h5>
                    <p>Freelancer: Budi Santoso - Web Developer</p>
                </div>
            </div>
            
            <div class="review-card" data-rating="5" data-delay="200">
                <div class="review-header">
                    <div class="reviewer-avatar">SP</div>
                    <div class="reviewer-info">
                        <h4>Sari Putri</h4>
                        <div class="review-stars">
                            <span class="star">★</span>
                            <span class="star">★</span>
                            <span class="star">★</span>
                            <span class="star">★</span>
                            <span class="star">★</span>
                        </div>
                        <div class="review-date">5 hari yang lalu</div>
                    </div>
                </div>
                <div class="review-text">
                    Logo yang didesain sangat kreatif dan sesuai dengan brand identity perusahaan. Freelancer memberikan banyak pilihan desain dan sangat sabar dalam proses revisi. Highly recommended!
                </div>
                <div class="review-project">
                    <h5>Proyek: Logo Design & Branding</h5>
                    <p>Freelancer: Maya Indah - Graphic Designer</p>
                </div>
            </div>
            
            <div class="review-card" data-rating="4" data-delay="400">
                <div class="review-header">
                    <div class="reviewer-avatar">RH</div>
                    <div class="reviewer-info">
                        <h4>Riko Handoko</h4>
                        <div class="review-stars">
                            <span class="star">★</span>
                            <span class="star">★</span>
                            <span class="star">★</span>
                            <span class="star">★</span>
                            <span class="star empty">★</span>
                        </div>
                        <div class="review-date">1 minggu yang lalu</div>
                    </div>
                </div>
                <div class="review-text">
                    Kualitas video editing bagus dan sesuai brief yang diberikan. Sedikit terlambat dari deadline tapi hasil akhirnya memuaskan. Komunikasi lancar dan freelancer sangat kooperatif.
                </div>
                <div class="review-project">
                    <h5>Proyek: Video Promosi Produk</h5>
                    <p>Freelancer: Dani Pratama - Video Editor</p>
                </div>
            </div>
            
            <div class="review-card" data-rating="5" data-delay="600">
                <div class="review-header">
                    <div class="reviewer-avatar">LN</div>
                    <div class="reviewer-info">
                        <h4>Lisa Nurmalasari</h4>
                        <div class="review-stars">
                            <span class="star">★</span>
                            <span class="star">★</span>
                            <span class="star">★</span>
                            <span class="star">★</span>
                            <span class="star">★</span>
                        </div>
                        <div class="review-date">2 minggu yang lalu</div>
                    </div>
                </div>
                <div class="review-text">
                    Artikel yang ditulis sangat berkualitas dan SEO-friendly. Freelancer memahami target audience dengan baik dan mampu menyampaikan pesan dengan tepat. Akan order lagi untuk konten selanjutnya.
                </div>
                <div class="review-project">
                    <h5>Proyek: Content Writing & SEO</h5>
                    <p>Freelancer: Andi Wijaya - Content Writer</p>
                </div>
            </div>
            
            <div class="review-card" data-rating="4" data-delay="800">
                <div class="review-header">
                    <div class="reviewer-avatar">TK</div>
                    <div class="reviewer-info">
                        <h4>Tono Kurniawan</h4>
                        <div class="review-stars">
                            <span class="star">★</span>
                            <span class="star">★</span>
                            <span class="star">★</span>
                            <span class="star">★</span>
                            <span class="star empty">★</span>
                        </div>
                        <div class="review-date">3 minggu yang lalu</div>
                    </div>
                </div>
                <div class="review-text">
                    Aplikasi mobile yang dibuat cukup bagus dan user-friendly. Beberapa fitur perlu improvement tapi overall sudah sesuai requirement. Freelancer responsif dan komunikatif.
                </div>
                <div class="review-project">
                    <h5>Proyek: Mobile App Development</h5>
                    <p>Freelancer: Rizky Firmansyah - Mobile Developer</p>
                </div>
            </div>
            
            <div class="review-card" data-rating="5" data-delay="1000">
                <div class="review-header">
                    <div class="reviewer-avatar">MR</div>
                    <div class="reviewer-info">
                        <h4>Mira Rahayu</h4>
                        <div class="review-stars">
                            <span class="star">★</span>
                            <span class="star">★</span>
                            <span class="star">★</span>
                            <span class="star">★</span>
                            <span class="star">★</span>
                        </div>
                        <div class="review-date">1 bulan yang lalu</div>
                    </div>
                </div>
                <div class="review-text">
                    Kampanye digital marketing yang dijalankan sangat efektif! ROI meningkat signifikan dan target audience tercapai dengan baik. Strategi yang diberikan sangat tepat sasaran.
                </div>
                <div class="review-project">
                    <h5>Proyek: Digital Marketing Campaign</h5>
                    <p>Freelancer: Indra Permana - Digital Marketer</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Add Review Section -->
<section class="add-review-section">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-6 fw-bold">Berikan Review Anda</h2>
            <p class="lead text-muted">Bantu freelancer lain dengan memberikan review yang konstruktif</p>
        </div>
        
        <div class="review-form">
            <div class="success-message" id="successMessage">
                <h3>Review Berhasil Dikirim!</h3>
                <p>Terima kasih atas review Anda. Review akan membantu freelancer lain untuk berkembang.</p>
            </div>
            
            <!-- Check if user is logged in (simulate with JavaScript) -->
            <div class="login-required" id="loginRequired" style="display: none;">
                <h3>Login Diperlukan</h3>
                <p>Silakan login terlebih dahulu untuk memberikan review</p>
                <a href="#" class="btn-login">Login Sekarang</a>
            </div>
            
            <form id="reviewForm">
                <div class="form-group">
                    <label for="freelancerName">Nama Freelancer *</label>
                    <input type="text" id="freelancerName" class="form-control" placeholder="Masukkan nama freelancer" required>
                </div<div class="form-group">
                   <label for="projectTitle">Judul Proyek *</label>
                   <input type="text" id="projectTitle" class="form-control" placeholder="Masukkan judul proyek" required>
               </div>
               
               <div class="form-group">
                   <label for="rating">Rating *</label>
                   <div class="star-rating">
                       <span class="star-input" data-rating="1">★</span>
                       <span class="star-input" data-rating="2">★</span>
                       <span class="star-input" data-rating="3">★</span>
                       <span class="star-input" data-rating="4">★</span>
                       <span class="star-input" data-rating="5">★</span>
                   </div>
                   <input type="hidden" id="ratingValue" name="rating" required>
               </div>
               
               <div class="form-group">
                   <label for="reviewText">Review *</label>
                   <textarea id="reviewText" class="form-control" rows="5" placeholder="Ceritakan pengalaman Anda bekerja dengan freelancer ini..." required></textarea>
               </div>
               
               <div class="form-group">
                   <label for="projectCategory">Kategori Proyek</label>
                   <select id="projectCategory" class="form-control">
                       <option value="">Pilih kategori proyek</option>
                       <option value="web-development">Web Development</option>
                       <option value="mobile-development">Mobile Development</option>
                       <option value="graphic-design">Graphic Design</option>
                       <option value="content-writing">Content Writing</option>
                       <option value="digital-marketing">Digital Marketing</option>
                       <option value="video-editing">Video Editing</option>
                       <option value="data-entry">Data Entry</option>
                       <option value="translation">Translation</option>
                       <option value="others">Lainnya</option>
                   </select>
               </div>
               
               <div class="form-group">
                   <label for="projectBudget">Budget Proyek</label>
                   <select id="projectBudget" class="form-control">
                       <option value="">Pilih range budget</option>
                       <option value="under-1m">Di bawah Rp 1.000.000</option>
                       <option value="1m-5m">Rp 1.000.000 - Rp 5.000.000</option>
                       <option value="5m-10m">Rp 5.000.000 - Rp 10.000.000</option>
                       <option value="10m-25m">Rp 10.000.000 - Rp 25.000.000</option>
                       <option value="above-25m">Di atas Rp 25.000.000</option>
                   </select>
               </div>
               
               <div class="form-group">
                   <label for="completionTime">Waktu Penyelesaian</label>
                   <input type="text" id="completionTime" class="form-control" placeholder="Contoh: 2 minggu, 1 bulan">
               </div>
               
               <div class="form-group">
                   <label for="recommendation">Rekomendasi</label>
                   <select id="recommendation" class="form-control">
                       <option value="">Apakah Anda merekomendasikan freelancer ini?</option>
                       <option value="yes">Ya, saya merekomendasikan</option>
                       <option value="maybe">Mungkin, tergantung proyek</option>
                       <option value="no">Tidak, saya tidak merekomendasikan</option>
                   </select>
               </div>
               
               <div class="text-center">
                   <button type="submit" class="btn-submit">
                       <span class="submit-text">Kirim Review</span>
                       <span class="loading-spinner" style="display: none;"></span>
                   </button>
               </div>
           </form>
       </div>
   </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
   // Animation on scroll
   const observerOptions = {
       threshold: 0.1,
       rootMargin: '0px 0px -50px 0px'
   };
   
   const observer = new IntersectionObserver(function(entries) {
       entries.forEach(entry => {
           if (entry.isIntersecting) {
               const element = entry.target;
               const delay = element.dataset.delay || 0;
               
               setTimeout(() => {
                   element.classList.add('animate');
               }, delay);
           }
       });
   }, observerOptions);
   
   // Observe all animated elements
   document.querySelectorAll('.stat-item, .overall-rating, .rating-row, .review-card, .review-form').forEach(el => {
       observer.observe(el);
   });
   
   // Counter animation for stats
   function animateCounter(element, target) {
       let current = 0;
       const increment = target / 100;
       const timer = setInterval(() => {
           current += increment;
           if (current >= target) {
               element.textContent = target.toLocaleString();
               clearInterval(timer);
           } else {
               element.textContent = Math.floor(current).toLocaleString();
           }
       }, 20);
   }
   
   // Start counter animation when stats are visible
   document.querySelectorAll('.stat-number').forEach(counter => {
       const target = parseInt(counter.dataset.count);
       observer.observe(counter.closest('.stat-item'));
       
       counter.closest('.stat-item').addEventListener('animationstart', () => {
           animateCounter(counter, target);
       });
   });
   
   // Rating bar animation
   document.querySelectorAll('.rating-fill').forEach(bar => {
       const width = bar.dataset.width;
       observer.observe(bar.closest('.rating-row'));
       
       bar.closest('.rating-row').addEventListener('animationstart', () => {
           setTimeout(() => {
               bar.style.width = width;
           }, 500);
       });
   });
   
   // Star rating functionality
   const starInputs = document.querySelectorAll('.star-input');
   const ratingValue = document.getElementById('ratingValue');
   
   starInputs.forEach((star, index) => {
       star.addEventListener('click', () => {
           const rating = index + 1;
           ratingValue.value = rating;
           
           starInputs.forEach((s, i) => {
               if (i < rating) {
                   s.classList.add('active');
               } else {
                   s.classList.remove('active');
               }
           });
       });
       
       star.addEventListener('mouseover', () => {
           const rating = index + 1;
           
           starInputs.forEach((s, i) => {
               if (i < rating) {
                   s.style.color = '#ffc107';
               } else {
                   s.style.color = '#ddd';
               }
           });
       });
   });
   
   document.querySelector('.star-rating').addEventListener('mouseleave', () => {
       const currentRating = parseInt(ratingValue.value) || 0;
       
       starInputs.forEach((s, i) => {
           if (i < currentRating) {
               s.style.color = '#ffc107';
           } else {
               s.style.color = '#ddd';
           }
       });
   });
   
   // Filter functionality
   const filterButtons = document.querySelectorAll('.filter-btn');
   const reviewCards = document.querySelectorAll('.review-card');
   
   filterButtons.forEach(button => {
       button.addEventListener('click', () => {
           const filter = button.dataset.filter;
           
           // Update active button
           filterButtons.forEach(btn => btn.classList.remove('active'));
           button.classList.add('active');
           
           // Filter reviews
           reviewCards.forEach(card => {
               const cardRating = card.dataset.rating;
               
               if (filter === 'all' || cardRating === filter) {
                   card.style.display = 'block';
                   card.style.animation = 'fadeIn 0.5s ease-in';
               } else {
                   card.style.display = 'none';
               }
           });
       });
   });
   
   // Form submission
   const reviewForm = document.getElementById('reviewForm');
   const successMessage = document.getElementById('successMessage');
   const submitButton = document.querySelector('.btn-submit');
   const submitText = document.querySelector('.submit-text');
   const loadingSpinner = document.querySelector('.loading-spinner');
   
   // Simulate user login check
   const isLoggedIn = true; // Change to false to show login required message
   const loginRequired = document.getElementById('loginRequired');
   
   if (!isLoggedIn) {
       loginRequired.style.display = 'block';
       reviewForm.style.display = 'none';
   }
   
   reviewForm.addEventListener('submit', function(e) {
       e.preventDefault();
       
       // Show loading state
       submitButton.disabled = true;
       submitText.style.display = 'none';
       loadingSpinner.style.display = 'inline-block';
       
       // Simulate API call
       setTimeout(() => {
           // Hide loading state
           submitButton.disabled = false;
           submitText.style.display = 'inline-block';
           loadingSpinner.style.display = 'none';
           
           // Show success message
           successMessage.classList.add('show');
           
           // Reset form
           reviewForm.reset();
           ratingValue.value = '';
           starInputs.forEach(star => star.classList.remove('active'));
           
           // Hide success message after 5 seconds
           setTimeout(() => {
               successMessage.classList.remove('show');
           }, 5000);
           
           // Scroll to success message
           successMessage.scrollIntoView({ behavior: 'smooth' });
       }, 2000);
   });
   
   // Add CSS animation keyframes
   const style = document.createElement('style');
   style.textContent = `
       @keyframes fadeIn {
           from { opacity: 0; transform: translateY(20px); }
           to { opacity: 1; transform: translateY(0); }
       }
   `;
   document.head.appendChild(style);
});
</script>

@endsection