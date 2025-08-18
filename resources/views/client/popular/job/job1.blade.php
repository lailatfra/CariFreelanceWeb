@extends('client.layout.client-layout') 
@section('title', 'Dicari: Freelancer untuk Pembuatan Full Website & Sistem Informasi - CariFreelance') 
@section('content') 
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dicari: Freelancer untuk Pembuatan Full Website & Sistem Informasi - CariFreelance</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet"/>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            line-height: 1.6;
            color: #1a1a1a;
            background-color: #fafbfc;
        }

/* Ganti CSS untuk navigation di job1.blade.php */

/* Navigation Categories */
.nav-container {
    background: white;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    position: sticky;
    top: -1px;
    z-index: 100;
    width: 100vw;
    margin: 0;
    padding: 0;
    transition: all 0.3s ease;
    border-bottom: 1px solid #e1e8ed;
}

.nav-container.scrolled {
    box-shadow: 0 4px 20px rgba(0,0,0,0.15);
    top: 60px;
}

.nav {
    max-width: 100%;
    margin: 0;
    padding: 0 15px;
}

.nav-list {
    display: flex;
    list-style: none;
    overflow-x: auto;
    padding: 4px 0;
    gap: 8px;
    scrollbar-width: none;
    -ms-overflow-style: none;
    align-items: center;
}

.nav-list::-webkit-scrollbar {
    display: none;
}

.nav-item {
    white-space: nowrap;
    cursor: pointer;
    padding: 8px 15px;
    border-radius: 20px;
    transition: all 0.3s ease;
    font-weight: 500;
    color: #666;
    background: transparent;
    border: none;
    min-height: 36px;
    display: flex;
    align-items: center;
}

.nav-item:hover, .nav-item.active {
    background: transparent;
    color: #1DA1F2;
    text-shadow: 0 0 10px rgba(29, 161, 242, 0.6);
    box-shadow: none;
    transform: translateY(-1px);
}

.nav-link {
    text-decoration: none;
    color: inherit;
    display: block;
    font-size: 14px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.nav-item:hover .nav-link,
.nav-item.active .nav-link {
    color: #1DA1F2;
    text-shadow: 0 0 10px rgba(29, 161, 242, 0.6);
}

        /* Breadcrumb */


/* Ganti CSS untuk breadcrumb-container di job1.blade.php */
/* Ganti CSS untuk breadcrumb-container di job1.blade.php */
.breadcrumb-container {
    max-width: 1400px;
    margin: 0;
    margin-left: 40px;
    padding: 0 20px;
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 14px;
    color: #666;
    flex-wrap: wrap;
   padding-top: 25px;
}

/* Responsive untuk mobile */
@media (max-width: 768px) {
    .breadcrumb-container {
        padding: 12px 16px;
    }
}

        .breadcrumb-link {
            color: #1d9bf0;
            text-decoration: none;
            font-weight: 500;
        }

        .breadcrumb-link:hover {
            text-decoration: underline;
        }

        .breadcrumb-separator {
            color: #9ca3af;
        }

        .breadcrumb-current {
            color: #6b7280;
            font-weight: 500;
        }

        /* Main Container */
        .main-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 32px 24px;
            display: grid;
            grid-template-columns: 1fr 320px;
            gap: 32px;
        }

        /* Content Section */
        .content-section {
            min-width: 0;
        }

        /* Job Header */
        .job-header {
            background: white;
            border-radius: 12px;
            padding: 32px;
            margin-bottom: 24px;
            border: 1px solid #e1e8ed;
        }

        .job-title {
            font-size: 28px;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 16px;
            line-height: 1.3;
        }

        .job-meta {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .meta-item {
            font-size: 14px;
            color: #6b7280;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .badge-urgent {
            background: #fef2f2;
            color: #dc2626;
        }

        .badge-expert {
            background: #f0f9ff;
            color: #0284c7;
        }

        .badge-flexible {
            background: #fefce8;
            color: #ca8a04;
        }

        /* Image Gallery */
        .image-gallery {
            background: white;
            border-radius: 12px;
            padding: 24px;
            margin-bottom: 24px;
            border: 1px solid #e1e8ed;
        }

        .main-image-container {
            position: relative;
            margin-bottom: 16px;
            border-radius: 8px;
            overflow: hidden;
        }

        .main-image {
            width: 100%;
            height: 320px;
            object-fit: cover;
            display: block;
        }

        .image-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(29, 155, 240, 0.1) 0%, rgba(0, 0, 0, 0.1) 100%);
        }

        .image-counter {
            position: absolute;
            top: 16px;
            left: 16px;
            background: rgba(0,0,0,0.8);
            color: white;
            padding: 6px 12px;
            border-radius: 16px;
            font-size: 12px;
            font-weight: 600;
        }

        .thumbnail-gallery {
            display: flex;
            gap: 12px;
            overflow-x: auto;
            padding: 8px 0;
        }

        .thumbnail {
            width: 80px;
            height: 60px;
            object-fit: cover;
            border-radius: 6px;
            cursor: pointer;
            opacity: 0.7;
            transition: all 0.2s ease;
            flex-shrink: 0;
            border: 2px solid transparent;
        }

        .thumbnail.active,
        .thumbnail:hover {
            opacity: 1;
            border-color: #1d9bf0;
        }

        /* Tabs */
        .tabs {
            background: white;
            border-radius: 12px;
            border: 1px solid #e1e8ed;
            margin-bottom: 24px;
            overflow: hidden;
        }

        .tab-list {
            display: flex;
            border-bottom: 1px solid #e1e8ed;
        }

        .tab {
            flex: 1;
            padding: 16px 24px;
            text-align: center;
            cursor: pointer;
            font-weight: 600;
            color: #6b7280;
            transition: all 0.2s ease;
            border-bottom: 2px solid transparent;
        }

        .tab.active {
            color: #1d9bf0;
            border-bottom-color: #1d9bf0;
            background: rgba(29, 155, 240, 0.05);
        }

        .tab:hover:not(.active) {
            color: #374151;
            background: rgba(0, 0, 0, 0.02);
        }

        .tab-content {
            padding: 32px;
        }

        /* Project Description */
        .project-intro {
            text-align: center;
            margin-bottom: 32px;
        }

        .project-intro h2 {
            font-size: 24px;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 12px;
        }

        .project-intro p {
            font-size: 16px;
            color: #6b7280;
            max-width: 600px;
            margin: 0 auto;
        }

        /* Reference Section */
        .reference-section {
            background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
            border: 1px solid #bae6fd;
            border-radius: 12px;
            padding: 24px;
            margin-bottom: 32px;
        }

        .reference-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 16px;
        }

        .reference-header h3 {
            font-size: 18px;
            font-weight: 700;
            color: #0c4a6e;
        }

        .reference-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 12px;
        }

        .reference-item {
            background: white;
            padding: 12px 16px;
            border-radius: 8px;
            color: #374151;
            font-weight: 500;
            text-align: center;
            border: 1px solid #e5e7eb;
            transition: all 0.2s ease;
        }

        .reference-item:hover {
            border-color: #1d9bf0;
            color: #1d9bf0;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(29, 155, 240, 0.15);
        }

        /* Content Sections */
        .content-section-block {
            margin-bottom: 32px;
        }

        .section-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 20px;
        }

        .section-header h3 {
            font-size: 20px;
            font-weight: 700;
            color: #1a1a1a;
        }

        .section-header i {
            font-size: 20px;
            color: #1d9bf0;
        }

        .grid-layout {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 16px;
        }

        .card-item {
            background: #fafbfc;
            border: 1px solid #e1e8ed;
            border-radius: 10px;
            padding: 20px;
            transition: all 0.2s ease;
        }

        .card-item:hover {
            border-color: #1d9bf0;
            box-shadow: 0 4px 12px rgba(29, 155, 240, 0.1);
            transform: translateY(-2px);
        }

        .card-item h4 {
            font-size: 16px;
            font-weight: 600;
            color: #1d9bf0;
            margin-bottom: 8px;
        }

        .card-item p {
            font-size: 14px;
            color: #6b7280;
            line-height: 1.5;
        }

        /* Workflow Section */
        .workflow-section {
            background: white;
            border: 1px solid #e1e8ed;
            border-radius: 12px;
            padding: 32px;
            margin-top: 32px;
        }

        .workflow-steps {
            display: grid;
            gap: 20px;
        }

        .workflow-step {
            display: flex;
            align-items: flex-start;
            gap: 16px;
            padding: 20px;
            background: #fafbfc;
            border: 1px solid #e1e8ed;
            border-radius: 10px;
            transition: all 0.2s ease;
        }

        .workflow-step:hover {
            border-color: #1d9bf0;
            box-shadow: 0 4px 12px rgba(29, 155, 240, 0.1);
        }

        .step-number {
            background: linear-gradient(135deg, #1d9bf0 0%, #0ea5e9 100%);
            color: white;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 14px;
            flex-shrink: 0;
        }

        .step-content h4 {
            font-size: 16px;
            font-weight: 600;
            color: #1a1a1a;
            margin-bottom: 4px;
        }

        .step-content p {
            font-size: 14px;
            color: #6b7280;
            line-height: 1.5;
        }

        /* Important Note */
        .important-note {
            background: linear-gradient(135deg, #fefce8 0%, #fef3c7 100%);
            border: 1px solid #fbbf24;
            border-radius: 12px;
            padding: 24px;
            margin: 24px 0;
            text-align: center;
        }

        .important-note .icon {
            font-size: 32px;
            color: #d97706;
            margin-bottom: 12px;
        }

        .important-note p {
            color: #92400e;
            font-weight: 500;
            font-size: 16px;
            line-height: 1.5;
        }

        /* Sidebar */
        .sidebar {
            position: sticky;
            top: 120px;
            height: fit-content;
        }

        .sidebar-card {
            background: white;
            border: 1px solid #e1e8ed;
            border-radius: 12px;
            overflow: hidden;
        }

        .budget-header {
            background: linear-gradient(135deg, #dcfce7 0%, #bbf7d0 100%);
            padding: 24px;
            text-align: center;
            border-bottom: 1px solid #e1e8ed;
        }

        .budget-icon {
            width: 48px;
            height: 48px;
            background: #16a34a;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 12px;
            color: white;
            font-size: 20px;
        }

        .budget-title {
            font-size: 18px;
            font-weight: 700;
            color: #15803d;
            margin-bottom: 8px;
        }

        .budget-description {
            font-size: 14px;
            color: #16a34a;
            line-height: 1.4;
        }

        .budget-details {
            padding: 24px;
        }

        .budget-amount {
            text-align: center;
            margin-bottom: 24px;
        }

        .budget-label {
            font-size: 14px;
            color: #6b7280;
            margin-bottom: 8px;
        }

        .budget-price {
            font-size: 32px;
            font-weight: 700;
            color: #1d9bf0;
        }

        .deadline-info {
            text-align: center;
            font-size: 14px;
            color: #6b7280;
            margin-bottom: 24px;
        }

        .action-buttons {
            display: flex;
            flex-direction: column;
            gap: 12px;
            margin-bottom: 20px;
        }

        .btn {
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.2s ease;
            text-align: center;
            text-decoration: none;
            display: block;
        }

        .btn-primary {
            background: #1d9bf0;
            color: white;
            border: none;
        }

        .btn-primary:hover {
            background: #1e40af;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(29, 155, 240, 0.3);
        }

        .btn-secondary {
            background: white;
            color: #1d9bf0;
            border: 2px solid #1d9bf0;
        }

        .btn-secondary:hover {
            background: #1d9bf0;
            color: white;
        }

        .action-icons {
            display: flex;
            justify-content: center;
            gap: 24px;
            padding-top: 20px;
            border-top: 1px solid #e1e8ed;
        }

        .action-icon {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 4px;
            color: #6b7280;
            font-size: 12px;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .action-icon:hover {
            color: #1d9bf0;
        }

        .action-icon i {
            font-size: 16px;
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .main-container {
                grid-template-columns: 1fr;
                padding: 24px 16px;
            }

            .sidebar {
                position: static;
            }
        }

        @media (max-width: 768px) {
            .nav {
                padding: 0 16px;
            }

            .breadcrumb-container {
                padding: 12px 16px;
            }

            .job-header,
            .image-gallery,
            .tab-content,
            .workflow-section {
                padding: 24px;
            }

            .job-title {
                font-size: 24px;
            }

            .main-image {
                height: 240px;
            }

            .grid-layout {
                grid-template-columns: 1fr;
            }

            .tab-list {
                flex-direction: column;
            }

            .tab {
                text-align: left;
            }
        }

        @media (max-width: 480px) {
            .main-container {
                padding: 16px 12px;
            }

            .job-header,
            .image-gallery,
            .tab-content {
                padding: 16px;
            }

            .budget-details {
                padding: 16px;
            }
        }
    </style>
</head>
<body>
    <!-- Category Navigation -->
    <div class="nav-container">
        <nav class="nav">
            <ul class="nav-list">
                <li class="nav-item active"><a href="/popular" class="nav-link">Pekerjaan Popular</a></li>
                <li class="nav-item"><a href="/grafis" class="nav-link">Grafis & Desain</a></li>
                <li class="nav-item"><a href="/penulisan" class="nav-link">Penulisan & Penerjemahan</a></li>
                <li class="nav-item"><a href="/web-development" class="nav-link">Web dan Pemrograman</a></li>
                <li class="nav-item"><a href="#" class="nav-link">Visual dan Audio</a></li>
                <li class="nav-item"><a href="#" class="nav-link">Pemasaran dan Periklanan</a></li>
                <li class="nav-item"><a href="#" class="nav-link">Bisnis</a></li>
            </ul>
        </nav>
    </div>

    <!-- Breadcrumb -->
    <div class="breadcrumb">
        <div class="breadcrumb-container">
            <a href="/home" class="breadcrumb-link">Semua Kategori</a>
            <span class="breadcrumb-separator">›</span>
            <a href="/popular" class="breadcrumb-link">Pekerjaan Popular</a>
            <span class="breadcrumb-separator">›</span>
            <a href="/web">
            <span class="breadcrumb-current">Web Development</span>
            </a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-container">
        <!-- Content Section -->
        <div class="content-section">
            <!-- Job Header -->
            <div class="job-header">
                <h1 class="job-title">Dicari: Freelancer untuk Pembuatan Website E-Commerce Brand Clothing</h1>
                <div class="job-meta">
                    <div class="meta-item">
                        <i class="fas fa-clock"></i>
                        <span>Diposting 2 hari yang lalu</span>
                    </div>
                    <div class="badge badge-urgent">
                        <i class="fas fa-exclamation-circle"></i>
                        <span>Segera</span>
                    </div>
                    <div class="badge badge-expert">Expert Level</div>
                    <div class="badge badge-flexible">Budget Fleksibel</div>
                </div>
            </div>

            <!-- Image Gallery -->
            <div class="image-gallery">
                <div class="main-image-container">
                    <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=800&h=400&fit=crop" alt="Website Development Project" class="main-image">
                    <div class="image-overlay"></div>
                    <div class="image-counter">1 / 6</div>
                </div>
                
                <div class="thumbnail-gallery">
                    <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=160&h=120&fit=crop" alt="Thumbnail 1" class="thumbnail active">
                    <img src="https://images.unsplash.com/photo-1467232004584-a241de8bcf5d?w=160&h=120&fit=crop" alt="Thumbnail 2" class="thumbnail">
                    <img src="https://images.unsplash.com/photo-1551650975-87deedd944c3?w=160&h=120&fit=crop" alt="Thumbnail 3" class="thumbnail">
                    <img src="https://images.unsplash.com/photo-1517077304055-6e89abbf09b0?w=160&h=120&fit=crop" alt="Thumbnail 4" class="thumbnail">
                    <img src="https://images.unsplash.com/photo-1555066931-4365d14bab8c?w=160&h=120&fit=crop" alt="Thumbnail 5" class="thumbnail">
                    <img src="https://images.unsplash.com/photo-1498050108023-c5249f4df085?w=160&h=120&fit=crop" alt="Thumbnail 6" class="thumbnail">
                </div>
            </div>

            <!-- Tabs -->
            <div class="tabs">
                <div class="tab-list">
                    <div class="tab active">Deskripsi Proyek</div>

                </div>

                <div class="tab-content">
                    <!-- Project Introduction -->
                    <div class="project-intro">
                        <h2>Website E-Commerce untuk Brand Clothing Lokal</h2>
                        <p>Saya memiliki brand clothing lokal bernama "UrbanStyle" yang sudah berjalan 2 tahun. Selama ini saya hanya jual melalui Instagram dan marketplace, tapi sekarang saya ingin punya website sendiri untuk meningkatkan profesionalitas dan kontrol penuh atas bisnis saya.</p>
                    </div>

                    <!-- Project Description -->
                    <div class="content-section-block">
                        <div class="section-header">
                            <i class="fas fa-info-circle"></i>
                            <h3>Detail Kebutuhan Proyek</h3>
                        </div>
                        <div style="background: #f8f9ff; border: 1px solid #e1e8ed; border-radius: 12px; padding: 24px; margin-bottom: 24px;">
                            <h4 style="color: #1d9bf0; font-size: 18px; font-weight: 600; margin-bottom: 16px;">Tentang Bisnis Saya:</h4>
                            <ul style="color: #374151; line-height: 1.6; margin-left: 20px; margin-bottom: 16px;">
                                <li>Brand clothing lokal "UrbanStyle" fokus streetwear untuk anak muda</li>
                                <li>Sudah punya followers Instagram 15K+ dan customer tetap</li>
                                <li>Produk: T-shirt, hoodie, kemeja, celana, aksesoris</li>
                                <li>Rata-rata 50-100 transaksi per bulan</li>
                                <li>Harga produk berkisar Rp 75.000 - Rp 350.000</li>
                            </ul>
                            
                            <h4 style="color: #1d9bf0; font-size: 18px; font-weight: 600; margin-bottom: 16px;">Yang Saya Inginkan di Website:</h4>
                            <ul style="color: #374151; line-height: 1.6; margin-left: 20px;">
                                <li><strong>Katalog Produk Lengkap:</strong> Showcase semua koleksi dengan foto berkualitas tinggi, multiple angles, size chart</li>
                                <li><strong>Shopping Cart & Checkout:</strong> Keranjang belanja yang user-friendly dengan proses checkout yang mudah</li>
                                <li><strong>Payment Gateway:</strong> Integrasi dengan Midtrans untuk pembayaran (VA, e-wallet, kartu kredit)</li>
                                <li><strong>Sistem Inventory:</strong> Tracking stok otomatis, notifikasi habis stok, variant produk (size, warna)</li>
                                <li><strong>Customer Account:</strong> Member registration, order history, wishlist, loyalty points</li>
                                <li><strong>Admin Panel:</strong> Kelola produk, order, customer, laporan penjualan</li>
                                <li><strong>Blog Section:</strong> Untuk konten fashion tips, behind the scenes, news update</li>
                                <li><strong>Instagram Integration:</strong> Feed Instagram otomatis di homepage</li>
                                <li><strong>Lookbook Gallery:</strong> Showcase styling dan campaign foto</li>
                                <li><strong>Size Guide:</strong> Panduan ukuran yang detail untuk setiap kategori produk</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Requirements -->
                    <div class="content-section-block">
                        <div class="section-header">
                            <i class="fas fa-check-circle"></i>
                            <h3>Yang Saya Butuhkan dari Freelancer</h3>
                        </div>
                        <div class="grid-layout">
                            <div class="card-item">
                                <h4>E-Commerce Experience</h4>
                                <p>Punya pengalaman membuat toko online dengan sistem pembayaran dan inventory management</p>
                            </div>
                            <div class="card-item">
                                <h4>Modern Design Skills</h4>
                                <p>Bisa membuat design yang trendy, sesuai target market anak muda, mobile-first</p>
                            </div>
                            <div class="card-item">
                                <h4>Payment Integration</h4>
                                <p>Berpengalaman integrasi payment gateway (Midtrans, Xendit, dll) dan sistem notifikasi</p>
                            </div>
                            <div class="card-item">
                                <h4>SEO & Performance</h4>
                                <p>Website yang fast loading, SEO friendly, dan optimal untuk Google ranking</p>
                            </div>
                            <div class="card-item">
                                <h4>Admin Panel Lengkap</h4>
                                <p>Dashboard admin yang user-friendly untuk kelola produk, pesanan, dan laporan</p>
                            </div>
                            <div class="card-item">
                                <h4>Post-Launch Support</h4>
                                <p>Training penggunaan admin panel, dokumentasi lengkap, dan support 1-2 bulan</p>
                            </div>
                        </div>
                    </div>

                    <!-- Technologies -->
                    <div class="content-section-block">
                        <div class="section-header">
                            <i class="fas fa-tools"></i>
                            <h3>Teknologi yang Diharapkan</h3>
                        </div>
                        <div class="grid-layout">
                            <div class="card-item">
                                <h4>Backend Framework</h4>
                                <p>Laravel atau CodeIgniter 4 untuk sistem yang robust dan aman</p>
                            </div>
                            <div class="card-item">
                                <h4>Database</h4>
                                <p>MySQL untuk menyimpan data produk, customer, dan transaksi</p>
                            </div>
                            <div class="card-item">
                                <h4>Frontend Modern</h4>
                                <p>TailwindCSS atau Bootstrap 5 untuk responsive design yang menarik</p>
                            </div>
                            <div class="card-item">
                                <h4>Payment & API</h4>
                                <p>Midtrans payment gateway, Instagram Basic Display API, WhatsApp Business API</p>
                            </div>
                        </div>
                    </div>

                    <!-- Important Note -->
                    <div class="important-note">
                        <div class="icon">
                            <i class="fas fa-info-circle"></i>
                        </div>
                        <p>Saya sudah siapkan semua aset seperti logo, foto produk, dan konten. Budget fleksibel sesuai dengan fitur dan kualitas yang ditawarkan. Timeline ideal 4-6 minggu. Mari diskusi detail! 🙏</p>
                    </div>

                    <!-- Workflow -->
                    <div class="workflow-section">
                        <div class="section-header">
                            <i class="fas fa-tasks"></i>
                            <h3>Proses Kerja yang Diharapkan</h3>
                        </div>
                        <div class="workflow-steps">
                            <div class="workflow-step">
                                <div class="step-number">1</div>
                                <div class="step-content">
                                    <h4>Konsultasi & Planning</h4>
                                    <p>Diskusi detail tentang brand, target market, fitur yang dibutuhkan, dan timeline project</p>
                                </div>
                            </div>
                            <div class="workflow-step">
                                <div class="step-number">2</div>
                                <div class="step-content">
                                    <h4>Design & Prototype</h4>
                                    <p>Saya approve design mockup, wireframe, dan user flow sebelum development dimulai</p>
                                </div>
                            </div>
                            <div class="workflow-step">
                                <div class="step-number">3</div>
                                <div class="step-content">
                                    <h4>Development & Testing</h4>
                                    <p>Proses coding dengan update progress mingguan, testing fitur per fitur sampai sempurna</p>
                                </div>
                            </div>
                            <div class="workflow-step">
                                <div class="step-number">4</div>
                                <div class="step-content">
                                    <h4>Launch & Training</h4>
                                    <p>Go-live website, training penggunaan admin panel, dan support awal 1-2 bulan</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="sidebar">
            <div class="sidebar-card">
                <!-- Budget Header -->
                <div class="budget-header">
                    <div class="budget-icon">
                        <i class="fas fa-wallet"></i>
                    </div>
                    <div class="budget-title">Budget Tersedia</div>
                    <div class="budget-description">Saya sudah menyiapkan budget untuk project ini dan siap membayar sesuai kualitas hasil kerja!</div>
                </div>

                <!-- Budget Details -->
                <div class="budget-details">
                    <div class="budget-amount">
                        <div class="budget-label">Budget Awal</div>
                        <div class="budget-price">Rp5.000.000+</div>
                    </div>
                    
                    <div class="deadline-info">
                        <i class="fas fa-calendar-alt"></i>
                        Timeline: 4-6 minggu
                    </div>
                    


                    <div class="action-icons">
                        <div class="action-icon">
                            <i class="far fa-bookmark"></i>
                            <span>Simpan</span>
                        </div>
                        <div class="action-icon">
                            <i class="fas fa-share-alt"></i>
                            <span>Bagikan</span>
                        </div>
                        <div class="action-icon">
                            <i class="fas fa-flag"></i>
                            <span>Laporkan</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Additional Info Card -->
            <div class="sidebar-card" style="margin-top: 20px;">
                <div style="padding: 24px;">
                    <h3 style="font-size: 18px; font-weight: 700; color: #1a1a1a; margin-bottom: 16px;">Info Tambahan</h3>
                    
                    <div style="margin-bottom: 16px;">
                        <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
                            <span style="color: #6b7280; font-size: 14px;">Kategori</span>
                            <span style="color: #1a1a1a; font-weight: 500; font-size: 14px;">Web Development</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
                            <span style="color: #6b7280; font-size: 14px;">Level</span>
                            <span style="color: #1a1a1a; font-weight: 500; font-size: 14px;">Expert</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
                            <span style="color: #6b7280; font-size: 14px;">Durasi</span>
                            <span style="color: #1a1a1a; font-weight: 500; font-size: 14px;">Fleksibel</span>
                        </div>
                        <div style="display: flex; justify-content: space-between;">
                            <span style="color: #6b7280; font-size: 14px;">Lokasi</span>
                            <span style="color: #1a1a1a; font-weight: 500; font-size: 14px;">Remote</span>
                        </div>
                    </div>

                    <div style="border-top: 1px solid #e1e8ed; padding-top: 16px;">
                        <h4 style="font-size: 16px; font-weight: 600; color: #1a1a1a; margin-bottom: 12px;">Skills yang Dibutuhkan</h4>
                        <div class="reference-grid">
                            <span style="background: #f0f9ff; color: #0284c7; padding: 4px 8px; border-radius: 12px; font-size: 12px; font-weight: 500;">Laravel</span>
                            <span style="background: #f0f9ff; color: #0284c7; padding: 4px 8px; border-radius: 12px; font-size: 12px; font-weight: 500;">E-Commerce</span>
                            <span style="background: #f0f9ff; color: #0284c7; padding: 4px 8px; border-radius: 12px; font-size: 12px; font-weight: 500;">Payment Gateway</span>
                            <span style="background: #f0f9ff; color: #0284c7; padding: 4px 8px; border-radius: 12px; font-size: 12px; font-weight: 500;">TailwindCSS</span>
                            <span style="background: #f0f9ff; color: #0284c7; padding: 4px 8px; border-radius: 12px; font-size: 12px; font-weight: 500;">Responsive Design</span>
                            <span style="background: #f0f9ff; color: #0284c7; padding: 4px 8px; border-radius: 12px; font-size: 12px; font-weight: 500;">Admin Panel</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Navigation functionality
        document.querySelectorAll('.nav-item').forEach(item => {
            item.addEventListener('click', function() {
                document.querySelectorAll('.nav-item').forEach(nav => nav.classList.remove('active'));
                this.classList.add('active');
            });
        });

        // Tab functionality
        document.querySelectorAll('.tab').forEach(tab => {
            tab.addEventListener('click', function() {
                document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
                this.classList.add('active');
                
                // Here you can add logic to show different content based on selected tab
                console.log('Tab selected:', this.textContent);
            });
        });

        // Thumbnail gallery functionality
        document.querySelectorAll('.thumbnail').forEach((thumb, index) => {
            thumb.addEventListener('click', function() {
                document.querySelectorAll('.thumbnail').forEach(t => t.classList.remove('active'));
                this.classList.add('active');
                
                // Update main image
                const mainImage = document.querySelector('.main-image');
                mainImage.src = this.src.replace('w=160&h=120', 'w=800&h=400');
                
                // Update image counter
                const counter = document.querySelector('.image-counter');
                counter.textContent = `${index + 1} / 6`;
            });
        });

        // Action buttons functionality
        document.querySelector('.btn-primary').addEventListener('click', function() {
            // Add loading state
            const originalText = this.innerHTML;
            this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Mengirim...';
            this.disabled = true;
            
            // Simulate API call
            setTimeout(() => {
                this.innerHTML = originalText;
                this.disabled = false;
                alert('Proposal berhasil dikirim!');
            }, 2000);
        });

        document.querySelector('.btn-secondary').addEventListener('click', function() {
            alert('Fitur chat akan segera tersedia!');
        });

        // Action icons functionality
        document.querySelectorAll('.action-icon').forEach(icon => {
            icon.addEventListener('click', function() {
                const action = this.querySelector('span').textContent;
                
                if (action === 'Simpan') {
                    const bookmarkIcon = this.querySelector('i');
                    if (bookmarkIcon.classList.contains('far')) {
                        bookmarkIcon.classList.remove('far');
                        bookmarkIcon.classList.add('fas');
                        this.style.color = '#1d9bf0';
                        this.querySelector('span').textContent = 'Tersimpan';
                    } else {
                        bookmarkIcon.classList.remove('fas');
                        bookmarkIcon.classList.add('far');
                        this.style.color = '';
                        this.querySelector('span').textContent = 'Simpan';
                    }
                } else if (action === 'Bagikan') {
                    if (navigator.share) {
                        navigator.share({
                            title: 'Dicari: Freelancer untuk Pembuatan Full Website & Sistem Informasi',
                            text: 'Project menarik untuk web developer!',
                            url: window.location.href
                        });
                    } else {
                        // Fallback for browsers that don't support Web Share API
                        navigator.clipboard.writeText(window.location.href);
                        alert('Link berhasil disalin ke clipboard!');
                    }
                } else if (action === 'Laporkan') {
                    alert('Terima kasih atas laporan Anda. Tim kami akan meninjau konten ini.');
                }
            });
        });

        // Smooth scrolling for internal links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
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

        // Enhanced card hover effects
        document.querySelectorAll('.card-item, .workflow-step').forEach(item => {
            item.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-4px)';
            });
            
            item.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });

        // Add intersection observer for animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        // Observe elements for animation
        document.querySelectorAll('.card-item, .workflow-step').forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(20px)';
            el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            observer.observe(el);
        });

        // Initialize page
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Professional job page loaded successfully');
        });
    </script>
</body>
</html>
@endsection