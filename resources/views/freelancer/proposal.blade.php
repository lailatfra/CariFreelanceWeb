@extends('client.layout.client-layout') 
@section('title', 'Ajukan Proposal - Freelancer untuk Pembuatan Website E-Commerce - CariFreelance') 
@section('content') 
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajukan Proposal - Freelancer untuk Pembuatan Website E-Commerce - CariFreelance</title>
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

        /* Navigation Categories - Same as job1.blade.php */
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

        /* Breadcrumb - Same as job1.blade.php */
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

        /* Page Header */
        .page-header {
            background: white;
            border-radius: 12px;
            padding: 32px;
            margin-bottom: 24px;
            border: 1px solid #e1e8ed;
        }

        .page-title {
            font-size: 28px;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 8px;
            line-height: 1.3;
        }

        .page-subtitle {
            color: #6b7280;
            font-size: 16px;
            margin-bottom: 16px;
        }

        .job-reference {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 16px;
            background: #f0f9ff;
            border: 1px solid #bae6fd;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .job-reference-icon {
            width: 40px;
            height: 40px;
            background: #1d9bf0;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }

        .job-reference-content h4 {
            font-size: 16px;
            font-weight: 600;
            color: #1a1a1a;
            margin-bottom: 4px;
        }

        .job-reference-content p {
            font-size: 14px;
            color: #6b7280;
        }

        /* Form Sections */
        .form-section {
            background: white;
            border-radius: 12px;
            padding: 32px;
            margin-bottom: 24px;
            border: 1px solid #e1e8ed;
        }

        .section-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 24px;
            padding-bottom: 16px;
            border-bottom: 1px solid #e1e8ed;
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

        .section-description {
            color: #6b7280;
            font-size: 14px;
            margin-bottom: 20px;
            line-height: 1.5;
        }

        /* Form Elements */
        .form-group {
            margin-bottom: 24px;
        }

        .form-label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 8px;
        }

        .form-label.required::after {
            content: ' *';
            color: #dc2626;
        }

        .form-input,
        .form-textarea,
        .form-select {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #e1e8ed;
            border-radius: 8px;
            font-size: 14px;
            color: #1a1a1a;
            background: white;
            transition: all 0.2s ease;
        }

        .form-input:focus,
        .form-textarea:focus,
        .form-select:focus {
            outline: none;
            border-color: #1d9bf0;
            box-shadow: 0 0 0 3px rgba(29, 155, 240, 0.1);
        }

        .form-textarea {
            min-height: 120px;
            resize: vertical;
        }

        .form-help {
            font-size: 12px;
            color: #6b7280;
            margin-top: 6px;
        }

        /* Price Input */
        .price-input-group {
            position: relative;
        }

        .price-prefix {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #6b7280;
            font-weight: 600;
            pointer-events: none;
        }

        .price-input {
            padding-left: 48px;
            font-size: 16px;
            font-weight: 600;
        }

        /* Timeline Grid */
        .timeline-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 12px;
        }

        .timeline-option {
            display: flex;
            align-items: center;
            padding: 12px 16px;
            border: 2px solid #e1e8ed;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s ease;
            background: white;
        }

        .timeline-option:hover {
            border-color: #1d9bf0;
            background: #f0f9ff;
        }

        .timeline-option.selected {
            border-color: #1d9bf0;
            background: #f0f9ff;
            color: #1d9bf0;
            font-weight: 600;
        }

        .timeline-option input[type="radio"] {
            margin-right: 8px;
        }

        /* Skills Tags */
        .skills-container {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-bottom: 12px;
        }

        .skill-tag {
            background: #f0f9ff;
            color: #1d9bf0;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
            border: 1px solid #bae6fd;
        }

        .skill-input {
            flex: 1;
            min-width: 200px;
        }

        /* File Upload */
        .file-upload-area {
            border: 2px dashed #e1e8ed;
            border-radius: 8px;
            padding: 32px;
            text-align: center;
            background: #fafbfc;
            transition: all 0.2s ease;
            cursor: pointer;
        }

        .file-upload-area:hover {
            border-color: #1d9bf0;
            background: #f0f9ff;
        }

        .file-upload-area.dragover {
            border-color: #1d9bf0;
            background: #f0f9ff;
        }

        .file-upload-icon {
            font-size: 32px;
            color: #6b7280;
            margin-bottom: 12px;
        }

        .file-upload-area:hover .file-upload-icon {
            color: #1d9bf0;
        }

        .file-list {
            margin-top: 16px;
        }

        .file-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 8px 12px;
            background: #f8f9fa;
            border-radius: 6px;
            margin-bottom: 8px;
        }

        .file-info {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .file-remove {
            color: #dc2626;
            cursor: pointer;
            padding: 4px;
        }

        .file-remove:hover {
            color: #991b1b;
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
            margin-bottom: 20px;
        }

        .sidebar-card-header {
            background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
            padding: 20px;
            border-bottom: 1px solid #e1e8ed;
        }

        .sidebar-card-title {
            font-size: 16px;
            font-weight: 700;
            color: #0c4a6e;
            margin-bottom: 8px;
        }

        .sidebar-card-content {
            padding: 20px;
        }

        /* Action Buttons */
        .action-buttons {
            display: flex;
            flex-direction: column;
            gap: 12px;
            margin-top: 32px;
        }

        .btn {
            padding: 14px 24px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.2s ease;
            text-align: center;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            border: none;
        }

        .btn-primary {
            background: linear-gradient(135deg, #1d9bf0 0%, #0ea5e9 100%);
            color: white;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #0ea5e9 0%, #0284c7 100%);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(29, 155, 240, 0.35);
        }

        .btn-secondary {
            background: white;
            color: #6b7280;
            border: 2px solid #e1e8ed;
        }

        .btn-secondary:hover {
            border-color: #6b7280;
            color: #374151;
            transform: translateY(-1px);
        }

        /* Progress Steps */
        .progress-steps {
            display: flex;
            justify-content: space-between;
            margin-bottom: 32px;
            position: relative;
        }

        .progress-steps::before {
            content: '';
            position: absolute;
            top: 15px;
            left: 15px;
            right: 15px;
            height: 2px;
            background: #e1e8ed;
            z-index: 1;
        }

        .progress-steps::after {
            content: '';
            position: absolute;
            top: 15px;
            left: 15px;
            width: 33.33%;
            height: 2px;
            background: #1d9bf0;
            z-index: 2;
            transition: width 0.3s ease;
        }

        .step {
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
            z-index: 3;
        }

        .step-number {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: white;
            border: 2px solid #e1e8ed;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 14px;
            color: #6b7280;
            margin-bottom: 8px;
        }

        .step.active .step-number {
            background: #1d9bf0;
            border-color: #1d9bf0;
            color: white;
        }

        .step.completed .step-number {
            background: #16a34a;
            border-color: #16a34a;
            color: white;
        }

        .step-label {
            font-size: 12px;
            color: #6b7280;
            text-align: center;
        }

        .step.active .step-label {
            color: #1d9bf0;
            font-weight: 600;
        }

        /* Tips Section */
        .tips-section {
            background: linear-gradient(135deg, #fefce8 0%, #fef3c7 100%);
            border: 1px solid #fbbf24;
            border-radius: 12px;
            padding: 20px;
        }

        .tips-header {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 12px;
        }

        .tips-header i {
            color: #d97706;
            font-size: 18px;
        }

        .tips-header h4 {
            color: #92400e;
            font-size: 16px;
            font-weight: 600;
        }

        .tips-list {
            list-style: none;
            margin: 0;
        }

        .tips-list li {
            color: #92400e;
            font-size: 14px;
            margin-bottom: 8px;
            padding-left: 20px;
            position: relative;
        }

        .tips-list li::before {
            content: '✓';
            position: absolute;
            left: 0;
            color: #d97706;
            font-weight: bold;
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

            .page-header,
            .form-section {
                padding: 24px;
            }

            .page-title {
                font-size: 24px;
            }

            .timeline-grid {
                grid-template-columns: 1fr;
            }

            .progress-steps {
                flex-direction: column;
                gap: 16px;
            }

            .progress-steps::before,
            .progress-steps::after {
                display: none;
            }
        }

        @media (max-width: 480px) {
            .main-container {
                padding: 16px 12px;
            }

            .page-header,
            .form-section {
                padding: 16px;
            }

            .sidebar-card-content {
                padding: 16px;
            }
        }

        /* Loading Animation */
        .loading {
            position: relative;
        }

        .loading::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 20px;
            height: 20px;
            border: 2px solid rgba(255,255,255,0.3);
            border-top: 2px solid white;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: translate(-50%, -50%) rotate(0deg); }
            100% { transform: translate(-50%, -50%) rotate(360deg); }
        }

        /* Success Animation */
        .success-checkmark {
            display: inline-block;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: #16a34a;
            position: relative;
        }

        .success-checkmark::after {
            content: '';
            position: absolute;
            top: 6px;
            left: 8px;
            width: 4px;
            height: 8px;
            border: solid white;
            border-width: 0 2px 2px 0;
            transform: rotate(45deg);
        }
    </style>
</head>
<body>
    <!-- Category Navigation -->
    <div class="nav-container">
        <nav class="nav">
            <ul class="nav-list">
                <li class="nav-item"><a href="/freelancer/popular" class="nav-link">Pekerjaan Populer</a></li>
                <li class="nav-item"><a href="/freelancer/grafis" class="nav-link">Grafis & Desain</a></li>
                <li class="nav-item"><a href="/penulisan" class="nav-link">Dokumen & PPT</a></li>
                <li class="nav-item"><a href="#" class="nav-link">Web & App</a></li>
                <li class="nav-item"><a href="#" class="nav-link">Video Editing</a></li>
                <li class="nav-item"><a href="#" class="nav-link">Animasi & Motion Graphic</a></li>
                <li class="nav-item"><a href="#" class="nav-link">Data & Analisis</a></li>
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
            <a href="/job/123" class="breadcrumb-link">Detail Pekerjaan</a>
            <span class="breadcrumb-separator">›</span>
            <span class="breadcrumb-current">Ajukan Proposal</span>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-container">
        <!-- Content Section -->
        <div class="content-section">
            <!-- Progress Steps -->
            <div class="progress-steps">
                <div class="step completed">
                    <div class="step-number">1</div>
                    <div class="step-label">Lihat Pekerjaan</div>
                </div>
                <div class="step active">
                    <div class="step-number">2</div>
                    <div class="step-label">Ajukan Proposal</div>
                </div>
                <div class="step">
                    <div class="step-number">3</div>
                    <div class="step-label">Menunggu Respon</div>
                </div>
            </div>

            <!-- Page Header -->
            <div class="page-header">
                <h1 class="page-title">Ajukan Proposal Anda</h1>
                <p class="page-subtitle">Tunjukkan mengapa Anda adalah pilihan terbaik untuk mengerjakan proyek ini</p>
                
                <div class="job-reference">
                    <div class="job-reference-icon">
                        <i class="fas fa-briefcase"></i>
                    </div>
                    <div class="job-reference-content">
                        <h4>Website E-Commerce Brand Clothing</h4>
                        <p>Budget: Rp 5.000.000+ • Timeline: 4-6 minggu • Expert Level</p>
                    </div>
                </div>
            </div>

            <form id="proposalForm" method="POST" action="/submit-proposal" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="job_id" value="123">

                <!-- Proposal Description -->
                <div class="form-section">
                    <div class="section-header">
                        <i class="fas fa-edit"></i>
                        <h3>Deskripsi Proposal</h3>
                    </div>
                    <p class="section-description">
                        Jelaskan bagaimana Anda akan mengerjakan proyek ini dan mengapa client harus memilih Anda
                    </p>

                    <div class="form-group">
                        <label for="proposal_title" class="form-label required">Judul Proposal</label>
                        <input type="text" id="proposal_title" name="proposal_title" class="form-input" 
                               placeholder="Contoh: Website E-Commerce Modern dengan Laravel & Payment Gateway Lengkap" required>
                        <div class="form-help">Buat judul yang menarik dan spesifik sesuai kebutuhan client</div>
                    </div>

                    <div class="form-group">
                        <label for="proposal_description" class="form-label required">Penjelasan Detail Proposal</label>
                        <textarea id="proposal_description" name="proposal_description" class="form-textarea" 
                                  placeholder="Jelaskan secara detail bagaimana Anda akan mengerjakan proyek ini:

• Analisis kebutuhan dan perencanaan
• Teknologi yang akan digunakan 
• Fitur-fitur yang akan dibangun
• Timeline pengerjaan
• Mengapa Anda cocok untuk proyek ini
• Pengalaman relevan yang Anda miliki" required></textarea>
                        <div class="form-help">Minimal 200 kata. Semakin detail dan spesifik, semakin baik peluang Anda</div>
                    </div>
                </div>

                <!-- Pricing & Timeline -->
<div class="form-section">
    <div class="section-header">
        <i class="fas fa-calculator"></i>
        <h3>Penawaran Harga</h3>
    </div>
    <p class="section-description">
        Berikan penawaran harga yang kompetitif dan realistis sesuai scope pekerjaan
    </p>

    @if($project->budget_type === 'fixed')
        <!-- Fixed Budget - Tampilkan harga fixed dan sembunyikan form input -->
        <div class="form-group">
            <label class="form-label required">Harga yang Ditentukan Client</label>
            <div class="price-input-group">
                <span class="price-prefix">Rp</span>
                <input type="text" class="form-input price-input"
                    value="Rp {{ number_format($project->fixed_budget, 0, ',', '.') }}" 
                    readonly style="background-color: #f9fafb; cursor: not-allowed;">
            </div>
            <div class="form-help" style="color: #16a34a;">
                <i class="fas fa-info-circle"></i> 
                Client telah menentukan harga tetap untuk proyek ini. Anda harus mengajukan proposal dengan harga ini.
            </div>
            <!-- Hidden input untuk mengirim nilai fixed budget -->
            <input type="hidden" name="proposal_price" value="{{ $project->fixed_budget }}">
        </div>
    @elseif($project->budget_type === 'range')
        <!-- Range Budget - Tampilkan range dan form input -->
        <div class="form-group">
            <div style="background: #f0f9ff; padding: 16px; border-radius: 8px; margin-bottom: 16px; border: 1px solid #bae6fd;">
                <h4 style="font-size: 14px; color: #0c4a6e; margin-bottom: 8px; font-weight: 600;">
                    <i class="fas fa-info-circle"></i> Range Budget Client
                </h4>
                <div style="display: flex; gap: 20px; font-size: 14px;">
                    <div>
                        <span style="color: #6b7280;">Minimum:</span>
                        <span style="font-weight: 600; color: #16a34a;">Rp {{ number_format($project->min_budget, 0, ',', '.') }}</span>
                    </div>
                    <div>
                        <span style="color: #6b7280;">Maksimum:</span>
                        <span style="font-weight: 600; color: #16a34a;">Rp {{ number_format($project->max_budget, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>

            <label for="proposal_price" class="form-label required">Harga Penawaran Anda</label>
            <div class="price-input-group">
                <span class="price-prefix">Rp</span>
                <input type="number" id="proposal_price" name="proposal_price" class="form-input price-input"
                    placeholder="Masukkan harga penawaran" 
                    min="{{ $project->min_budget }}" 
                    max="{{ $project->max_budget }}" 
                    required
                    oninput="validatePriceRange(this)"
                    onblur="formatPriceInput(this)">
            </div>
            <div class="form-help">
                Masukkan harga antara Rp {{ number_format($project->min_budget, 0, ',', '.') }} - Rp {{ number_format($project->max_budget, 0, ',', '.') }}
            </div>
            <div id="priceValidationMessage" style="font-size: 12px; margin-top: 5px;"></div>
        </div>
    @else
        <!-- Fallback untuk budget type lainnya -->
        <div class="form-group">
            <label for="proposal_price" class="form-label required">Harga Penawaran</label>
            <div class="price-input-group">
                <span class="price-prefix">Rp</span>
                <input type="number" id="proposal_price" name="proposal_price" class="form-input price-input"
                    placeholder="5000000" min="100000" step="50000" required>
            </div>
            <div class="form-help">Berikan penawaran harga yang kompetitif</div>
        </div>
    @endif
</div>

                <!-- Skills & Experience -->
                <div class="form-section">
                    <div class="section-header">
                        <i class="fas fa-star"></i>
                        <h3>Keahlian & Pengalaman</h3>
                    </div>
                    <p class="section-description">
                        Tunjukkan skills dan pengalaman yang relevan dengan proyek ini
                    </p>

                    <div class="form-group">
                        <label for="skills" class="form-label">Skills yang Relevan</label>
                        <div class="skills-container" id="skillsContainer">
                            <span class="skill-tag">Laravel</span>
                            <span class="skill-tag">E-Commerce</span>
                            <span class="skill-tag">Payment Gateway</span>
                            <span class="skill-tag">TailwindCSS</span>
                            <span class="skill-tag">Responsive Design</span>
                            <span class="skill-tag">Admin Panel</span>
                        </div>
                        <input type="text" id="skills" class="form-input skill-input" 
                               placeholder="Tambahkan skill lain yang relevan (tekan Enter)">
                        <div class="form-help">Klik tag untuk menghapus, atau tambahkan skill baru</div>
                    </div>

                    <div class="form-group">
                        <label for="experience" class="form-label">Pengalaman Relevan</label>
                        <textarea id="experience" name="experience" class="form-textarea" 
                                  placeholder="Ceritakan pengalaman Anda yang relevan:

• Proyek e-commerce yang pernah dikerjakan
• Klien atau brand yang pernah ditangani
• Teknologi yang pernah digunakan
• Tantangan yang berhasil diselesaikan
• Link portfolio atau contoh hasil kerja"></textarea>
                        <div class="form-help">Sertakan link portfolio atau contoh kerja yang relevan</div>
                    </div>
                </div>

                <!-- Portfolio & Files -->
                <div class="form-section">
                    <div class="section-header">
                        <i class="fas fa-folder-open"></i>
                        <h3>Portfolio & File Pendukung</h3>
                    </div>
                    <p class="section-description">
                        Upload portfolio atau file yang mendukung proposal Anda (opsional)
                    </p>

                    <div class="form-group">
                        <label for="portfolio_links" class="form-label">Link Portfolio</label>
                        <input type="url" id="portfolio_links" name="portfolio_links" class="form-input" 
                               placeholder="https://yourportfolio.com atau https://github.com/username">
                        <div class="form-help">Link ke portfolio, GitHub, atau website yang menampilkan hasil kerja Anda</div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Upload File (CV, Portfolio, Mock-up)</label>
                        <div class="file-upload-area" id="fileUploadArea">
                            <div class="file-upload-icon">
                                <i class="fas fa-cloud-upload-alt"></i>
                            </div>
                            <p><strong>Klik untuk upload file</strong> atau drag & drop di sini</p>
                            <p style="font-size: 12px; color: #6b7280; margin-top: 8px;">
                                Format: PDF, DOC, DOCX, JPG, PNG (Max 5MB per file)
                            </p>
                        </div>
                        <input type="file" id="fileInput" name="files[]" multiple accept=".pdf,.doc,.docx,.jpg,.jpeg,.png" style="display: none;">
                        <div class="file-list" id="fileList"></div>
                    </div>
                </div>

                <!-- Additional Message -->
                <div class="form-section">
                    <div class="section-header">
                        <i class="fas fa-comment"></i>
                        <h3>Pesan Tambahan</h3>
                    </div>
                    <p class="section-description">
                        Ada yang ingin Anda sampaikan kepada client?
                    </p>

                    <div class="form-group">
                        <label for="additional_message" class="form-label">Pesan untuk Client</label>
                        <textarea id="additional_message" name="additional_message" class="form-textarea" 
                                  placeholder="Contoh:
• Saya siap untuk diskusi lebih detail kapan saja
• Saya bisa memberikan revisi hingga client puas
• Saya akan memberikan dokumentasi lengkap dan training
• Saya bisa mulai mengerjakan dalam 1-2 hari"></textarea>
                        <div class="form-help">Tunjukkan komitmen dan profesionalisme Anda</div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="action-buttons">
                    <button type="submit" class="btn btn-primary" id="submitBtn">
                        <i class="fas fa-paper-plane"></i>
                        <span>Kirim Proposal</span>
                    </button>
                    <a href="/job/123" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i>
                        <span>Kembali ke Detail Pekerjaan</span>
                    </a>
                </div>
            </form>
        </div>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Job Summary -->
<div class="sidebar-card">
    <div class="sidebar-card-header">
        <h4 class="sidebar-card-title">Ringkasan Pekerjaan</h4>
    </div>
    <div class="sidebar-card-content">
        <div style="margin-bottom: 16px;">
            <h5 style="font-size: 14px; font-weight: 600; color: #1a1a1a; margin-bottom: 8px;">
                {{ $project->title }}
            </h5>
            <p style="font-size: 12px; color: #6b7280; line-height: 1.4;">
                {{ \Illuminate\Support\Str::limit($project->description, 80, '...') }}
            </p>
        </div>

        <div style="display: grid; grid-template-columns: 1fr; gap: 12px; font-size: 12px;">
            <div>
                <span style="color: #6b7280;">Budget:</span>
                <div style="font-weight: 600; color: #16a34a;">
                    @if($project->budget_type === 'fixed')
                        Rp {{ number_format($project->fixed_budget, 0, ',', '.') }}
                    @elseif($project->budget_type === 'range')
                        Rp {{ number_format($project->min_budget, 0, ',', '.') }} - Rp {{ number_format($project->max_budget, 0, ',', '.') }}
                    @else
                        Rp {{ number_format($project->fixed_budget ?? 0, 0, ',', '.') }}+
                    @endif
                </div>
            </div>
            <div>
                <span style="color: #6b7280;">Jenis Budget:</span>
                <div style="font-weight: 600; color: #1a1a1a;">
                    @if($project->budget_type === 'fixed')
                        Harga Tetap
                    @elseif($project->budget_type === 'range')
                        Rentang Harga
                    @else
                        {{ $project->budget_type }}
                    @endif
                </div>
            </div>
            <div>
                <span style="color: #6b7280;">Timeline:</span>
                <div style="font-weight: 600; color: #1a1a1a;">
                    {{ $project->timeline_duration }} minggu
                </div>
            </div>
        </div>
    </div>
</div>

            <!-- Tips Card -->
            <div class="sidebar-card">
                <div class="tips-section">
                    <div class="tips-header">
                        <i class="fas fa-lightbulb"></i>
                        <h4>Tips Proposal Terbaik</h4>
                    </div>
                    <ul class="tips-list">
                        <li>Baca detail kebutuhan dengan cermat</li>
                        <li>Sebutkan teknologi spesifik yang akan digunakan</li>
                        <li>Berikan contoh pekerjaan yang relevan</li>
                        <li>Jelaskan timeline secara detail</li>
                        <li>Tunjukkan pemahaman tentang bisnis client</li>
                        <li>Tawarkan nilai tambah yang unik</li>
                    </ul>
                </div>
            </div>

            <!-- Competition Info -->
            <div class="sidebar-card">
                <div class="sidebar-card-content">
                    <div style="text-align: center; margin-bottom: 16px;">
                        <div style="width: 48px; height: 48px; background: #f0f9ff; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 12px;">
                            <i class="fas fa-users" style="color: #1d9bf0; font-size: 20px;"></i>
                        </div>
                        <h4 style="font-size: 16px; font-weight: 600; color: #1a1a1a; margin-bottom: 8px;">
                            Info Kompetisi
                        </h4>
                    </div>
                    
                    <div style="background: #fafbfc; padding: 16px; border-radius: 8px; border: 1px solid #e1e8ed;">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                            <span style="color: #6b7280; font-size: 14px;">Proposal Masuk:</span>
                            <span style="font-weight: 600; color: #1d9bf0;">7 proposal</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                            <span style="color: #6b7280; font-size: 14px;">Rata-rata Harga:</span>
                            <span style="font-weight: 600; color: #1a1a1a;">Rp 4.5jt</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span style="color: #6b7280; font-size: 14px;">Waktu Tersisa:</span>
                            <span style="font-weight: 600; color: #dc2626;">3 hari</span>
                        </div>
                    </div>
                    
                    <div style="margin-top: 12px; padding: 12px; background: #fef2f2; border: 1px solid #fecaca; border-radius: 6px;">
                        <p style="font-size: 12px; color: #dc2626; text-align: center; margin: 0;">
                            <i class="fas fa-exclamation-circle" style="margin-right: 4px;"></i>
                            Kirim proposal secepatnya untuk peluang terbaik!
                        </p>
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

        // Timeline selection
        document.querySelectorAll('input[name="timeline"]').forEach(radio => {
            radio.addEventListener('change', function() {
                document.querySelectorAll('.timeline-option').forEach(option => 
                    option.classList.remove('selected'));
                this.closest('.timeline-option').classList.add('selected');
            });
        });

        // Skills management
        let skills = ['Laravel', 'E-Commerce', 'Payment Gateway', 'TailwindCSS', 'Responsive Design', 'Admin Panel'];

        function updateSkillsDisplay() {
            const container = document.getElementById('skillsContainer');
            const skillTags = container.querySelectorAll('.skill-tag');
            skillTags.forEach(tag => {
                if (!tag.classList.contains('permanent')) {
                    tag.remove();
                }
            });

            skills.forEach(skill => {
                const tag = document.createElement('span');
                tag.className = 'skill-tag';
                tag.textContent = skill;
                tag.addEventListener('click', () => {
                    skills = skills.filter(s => s !== skill);
                    updateSkillsDisplay();
                    updateSkillsInput();
                });
                container.appendChild(tag);
            });
        }

        function updateSkillsInput() {
            // Create hidden input for skills
            const existingInput = document.querySelector('input[name="skills"]');
            if (existingInput) existingInput.remove();
            
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'skills';
            input.value = JSON.stringify(skills);
            document.getElementById('proposalForm').appendChild(input);
        }

        document.getElementById('skills').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                const skill = this.value.trim();
                if (skill && !skills.includes(skill)) {
                    skills.push(skill);
                    updateSkillsDisplay();
                    updateSkillsInput();
                }
                this.value = '';
            }
        });

        // Initialize skills
        updateSkillsDisplay();
        updateSkillsInput();

        // File upload functionality
        const fileUploadArea = document.getElementById('fileUploadArea');
        const fileInput = document.getElementById('fileInput');
        const fileList = document.getElementById('fileList');
        let uploadedFiles = [];

        fileUploadArea.addEventListener('click', () => fileInput.click());

        fileUploadArea.addEventListener('dragover', (e) => {
            e.preventDefault();
            fileUploadArea.classList.add('dragover');
        });

        fileUploadArea.addEventListener('dragleave', () => {
            fileUploadArea.classList.remove('dragover');
        });

        fileUploadArea.addEventListener('drop', (e) => {
            e.preventDefault();
            fileUploadArea.classList.remove('dragover');
            handleFiles(e.dataTransfer.files);
        });

        fileInput.addEventListener('change', (e) => {
            handleFiles(e.target.files);
        });

        function handleFiles(files) {
            Array.from(files).forEach(file => {
                if (file.size <= 5 * 1024 * 1024) { // 5MB limit
                    uploadedFiles.push(file);
                    addFileToList(file);
                } else {
                    showToast(`File ${file.name} terlalu besar (max 5MB)`, 'error');
                }
            });
        }

        function addFileToList(file) {
            const fileItem = document.createElement('div');
            fileItem.className = 'file-item';
            
            fileItem.innerHTML = `
                <div class="file-info">
                    <i class="fas fa-file"></i>
                    <span>${file.name}</span>
                    <span style="font-size: 12px; color: #6b7280;">(${formatFileSize(file.size)})</span>
                </div>
                <i class="fas fa-times file-remove"></i>
            `;

            fileItem.querySelector('.file-remove').addEventListener('click', () => {
                uploadedFiles = uploadedFiles.filter(f => f !== file);
                fileItem.remove();
            });

            fileList.appendChild(fileItem);
        }

        function formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
        }

        // Price formatting
        document.getElementById('proposal_price').addEventListener('input', function() {
            let value = this.value.replace(/\D/g, '');
            if (value) {
                this.value = parseInt(value);
            }
        });

        // Form submission
        document.getElementById('proposalForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const submitBtn = document.getElementById('submitBtn');
            const originalContent = submitBtn.innerHTML;
            
            // Validation
            const requiredFields = this.querySelectorAll('[required]');
            let isValid = true;
            
            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    isValid = false;
                    field.style.borderColor = '#dc2626';
                    setTimeout(() => field.style.borderColor = '', 3000);
                }
            });
            
            if (!isValid) {
                showToast('Mohon lengkapi semua field yang wajib diisi', 'error');
                return;
            }
            
            // Show loading state
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> <span>Mengirim Proposal...</span>';
            submitBtn.disabled = true;
            
            // Simulate API call
            setTimeout(() => {
                // Success state
                submitBtn.innerHTML = '<div class="success-checkmark"></div> <span>Proposal Terkirim!</span>';
                submitBtn.style.background = '#16a34a';
                
                showToast('Proposal berhasil dikirim! Client akan meninjau proposal Anda.', 'success');
                
                // Update progress steps
                document.querySelector('.step.active').classList.remove('active');
                document.querySelector('.step.active').classList.add('completed');
                document.querySelectorAll('.step')[2].classList.add('active');
                
                // Redirect after delay
                setTimeout(() => {
                    window.location.href = '/my-proposals';
                }, 2000);
                
            }, 2000);
        });

        // Toast notification function
        function showToast(message, type = 'info') {
            const toast = document.createElement('div');
            toast.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                background: ${type === 'success' ? '#16a34a' : type === 'error' ? '#dc2626' : type === 'warning' ? '#d97706' : '#1d9bf0'};
                color: white;
                padding: 16px 24px;
                border-radius: 8px;
                font-weight: 600;
                box-shadow: 0 8px 25px rgba(0,0,0,0.15);
                z-index: 1000;
                opacity: 0;
                transform: translateX(100%);
                transition: all 0.3s ease;
                max-width: 350px;
                line-height: 1.4;
            `;
            toast.textContent = message;
            
            document.body.appendChild(toast);
            
            // Animate in
            setTimeout(() => {
                toast.style.opacity = '1';
                toast.style.transform = 'translateX(0)';
            }, 100);
            
            // Animate out and remove
            setTimeout(() => {
                toast.style.opacity = '0';
                toast.style.transform = 'translateX(100%)';
                setTimeout(() => document.body.removeChild(toast), 300);
            }, 4000);
        }

        // Character count for textareas
        document.querySelectorAll('textarea').forEach(textarea => {
            const maxLength = textarea.getAttribute('maxlength');
            if (maxLength) {
                const counter = document.createElement('div');
                counter.style.cssText = 'font-size: 12px; color: #6b7280; text-align: right; margin-top: 4px;';
                counter.textContent = `0/${maxLength}`;
                textarea.parentNode.appendChild(counter);
                
                textarea.addEventListener('input', () => {
                    counter.textContent = `${textarea.value.length}/${maxLength}`;
                    if (textarea.value.length > maxLength * 0.9) {
                        counter.style.color = '#dc2626';
                    } else {
                        counter.style.color = '#6b7280';
                    }
                });
            }
        });

        // Auto-resize textareas
        document.querySelectorAll('textarea').forEach(textarea => {
            textarea.addEventListener('input', function() {
                this.style.height = 'auto';
                this.style.height = this.scrollHeight + 'px';
            });
        });

        // Form auto-save (to localStorage)
        const formElements = document.querySelectorAll('#proposalForm input, #proposalForm textarea');
        
        formElements.forEach(element => {
            // Load saved data
            const saved = localStorage.getItem(`proposal_${element.name}`);
            if (saved && element.type !== 'file') {
                element.value = saved;
            }
            
            // Save on change
            element.addEventListener('input', () => {
                localStorage.setItem(`proposal_${element.name}`, element.value);
            });
        });

        // Clear auto-save on successful submission
        document.getElementById('proposalForm').addEventListener('submit', () => {
            setTimeout(() => {
                formElements.forEach(element => {
                    localStorage.removeItem(`proposal_${element.name}`);
                });
            }, 3000);
        });

        // Initialize page
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Proposal page loaded successfully');
            
            // Add entrance animations
            const elements = ['.page-header', '.form-section', '.sidebar-card'];
            elements.forEach((selector, index) => {
                const elementsList = document.querySelectorAll(selector);
                elementsList.forEach((element, elemIndex) => {
                    element.style.opacity = '0';
                    element.style.transform = 'translateY(30px)';
                    setTimeout(() => {
                        element.style.transition = 'all 0.6s ease';
                        element.style.opacity = '1';
                        element.style.transform = 'translateY(0)';
                    }, (index * 100) + (elemIndex * 50));
                });
            });
        });

        // Price validation based on budget type
document.addEventListener('DOMContentLoaded', function() {
    const proposalPriceInput = document.getElementById('proposal_price');
    
    @if($project->budget_type === 'range')
    if (proposalPriceInput) {
        proposalPriceInput.addEventListener('input', function() {
            const minBudget = {{ $project->min_budget }};
            const maxBudget = {{ $project->max_budget }};
            const currentValue = parseInt(this.value) || 0;
            
            if (currentValue < minBudget) {
                this.style.borderColor = '#dc2626';
                showToast(`Harga minimal adalah Rp ${minBudget.toLocaleString('id-ID')}`, 'error');
            } else if (currentValue > maxBudget) {
                this.style.borderColor = '#dc2626';
                showToast(`Harga maksimal adalah Rp ${maxBudget.toLocaleString('id-ID')}`, 'error');
            } else {
                this.style.borderColor = '#16a34a';
            }
        });
        
        proposalPriceInput.addEventListener('blur', function() {
            const minBudget = {{ $project->min_budget }};
            const maxBudget = {{ $project->max_budget }};
            let currentValue = parseInt(this.value) || 0;
            
            if (currentValue < minBudget) {
                this.value = minBudget;
                showToast(`Harga telah disesuaikan ke minimum: Rp ${minBudget.toLocaleString('id-ID')}`, 'warning');
            } else if (currentValue > maxBudget) {
                this.value = maxBudget;
                showToast(`Harga telah disesuaikan ke maksimum: Rp ${maxBudget.toLocaleString('id-ID')}`, 'warning');
            }
            
            this.style.borderColor = '#e1e8ed';
        });
    }
    @endif
});

// Price validation based on budget type
function validatePriceRange(input) {
    const minBudget = {{ $project->min_budget }};
    const maxBudget = {{ $project->max_budget }};
    const currentValue = parseInt(input.value) || 0;
    const validationMessage = document.getElementById('priceValidationMessage');
    
    if (!input.value) {
        input.style.borderColor = '#e1e8ed';
        validationMessage.innerHTML = '';
        return false;
    }
    
    if (currentValue < minBudget) {
        input.style.borderColor = '#dc2626';
        validationMessage.innerHTML = `<span style="color: #dc2626;"><i class="fas fa-exclamation-circle"></i> Harga minimal adalah Rp ${minBudget.toLocaleString('id-ID')}</span>`;
        return false;
    } else if (currentValue > maxBudget) {
        input.style.borderColor = '#dc2626';
        validationMessage.innerHTML = `<span style="color: #dc2626;"><i class="fas fa-exclamation-circle"></i> Harga maksimal adalah Rp ${maxBudget.toLocaleString('id-ID')}</span>`;
        return false;
    } else {
        input.style.borderColor = '#16a34a';
        validationMessage.innerHTML = `<span style="color: #16a34a;"><i class="fas fa-check-circle"></i> Harga penawaran sesuai range budget</span>`;
        return true;
    }
}

// Format price input on blur
function formatPriceInput(input) {
    const minBudget = {{ $project->min_budget }};
    const maxBudget = {{ $project->max_budget }};
    let currentValue = parseInt(input.value) || 0;
    
    // Auto-adjust jika di luar range
    if (currentValue < minBudget) {
        input.value = minBudget;
        showToast(`Harga telah disesuaikan ke minimum: Rp ${minBudget.toLocaleString('id-ID')}`, 'warning');
    } else if (currentValue > maxBudget) {
        input.value = maxBudget;
        showToast(`Harga telah disesuaikan ke maksimum: Rp ${maxBudget.toLocaleString('id-ID')}`, 'warning');
    }
    
    // Update validation message
    validatePriceRange(input);
}

// Form submission validation
document.getElementById('proposalForm').addEventListener('submit', function(e) {
    @if($project->budget_type === 'range')
    const priceInput = document.getElementById('proposal_price');
    if (priceInput && !validatePriceRange(priceInput)) {
        e.preventDefault();
        showToast('Harap masukkan harga penawaran dalam range yang ditentukan', 'error');
        priceInput.focus();
        return false;
    }
    @endif
});

// Initialize price validation on page load
document.addEventListener('DOMContentLoaded', function() {
    const proposalPriceInput = document.getElementById('proposal_price');
    
    @if($project->budget_type === 'range')
    if (proposalPriceInput) {
        // Set placeholder dengan format yang jelas
        proposalPriceInput.placeholder = `Contoh: ${({{ $project->min_budget }} + {{ $project->max_budget }}) / 2}`;
        
        // Validasi real-time
        proposalPriceInput.addEventListener('input', function() {
            validatePriceRange(this);
        });
        
        proposalPriceInput.addEventListener('focus', function() {
            this.style.borderColor = '#1d9bf0';
        });
    }
    @endif
});

// Form submission validation
document.getElementById('proposalForm').addEventListener('submit', function(e) {
    @if($project->budget_type === 'range')
    const priceInput = document.getElementById('proposal_price');
    if (priceInput && !validatePriceRange(priceInput)) {
        e.preventDefault();
        showToast('Harap masukkan harga penawaran dalam range yang ditentukan', 'error');
        return false;
    }
    @endif
});

// Auto-format price input
document.addEventListener('DOMContentLoaded', function() {
    const proposalPriceInput = document.getElementById('proposal_price');
    
    if (proposalPriceInput) {
        proposalPriceInput.addEventListener('blur', function() {
            @if($project->budget_type === 'range')
            const minBudget = {{ $project->min_budget }};
            const maxBudget = {{ $project->max_budget }};
            let currentValue = parseInt(this.value) || 0;
            
            if (currentValue < minBudget) {
                this.value = minBudget;
                showToast(`Harga telah disesuaikan ke minimum: Rp ${minBudget.toLocaleString('id-ID')}`, 'warning');
            } else if (currentValue > maxBudget) {
                this.value = maxBudget;
                showToast(`Harga telah disesuaikan ke maksimum: Rp ${maxBudget.toLocaleString('id-ID')}`, 'warning');
            }
            @endif
            
            // Format number with dots
            if (this.value) {
                const formattedValue = parseInt(this.value).toLocaleString('id-ID');
                this.value = parseInt(this.value); // Tetap simpan sebagai number untuk submit
            }
        });
        
        proposalPriceInput.addEventListener('focus', function() {
            this.style.borderColor = '#1d9bf0';
        });
    }
});
    </script>
</body>
</html>
@endsection