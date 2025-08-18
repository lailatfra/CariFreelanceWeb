@extends('client.layout.client-layout') 
@section('title', 'Posting Lowongan Pekerjaan - CariFreelance') 
@section('content') 
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posting Lowongan Pekerjaan - CariFreelance</title>
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

        /* Navigation Categories - Consistent with job1.blade.php */
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

        /* Breadcrumb - Consistent with job1.blade.php */
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
            max-width: 1000px;
            margin: 0 auto;
            padding: 32px 24px;
        }

        /* Page Header */
        .page-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .page-title {
            font-size: 32px;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 12px;
        }

        .page-subtitle {
            font-size: 18px;
            color: #6b7280;
            max-width: 600px;
            margin: 0 auto;
        }

        /* Form Container */
        .form-container {
            background: white;
            border: 1px solid #e1e8ed;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        /* Form Steps */
        .form-steps {
            display: flex;
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            border-bottom: 1px solid #e1e8ed;
            padding: 0;
        }

        .step {
            flex: 1;
            text-align: center;
            padding: 20px 16px;
            position: relative;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .step.active {
            background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
            color: #1d4ed8;
        }

        .step.completed {
            background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
            color: #047857;
        }

        .step:not(:last-child)::after {
            content: '';
            position: absolute;
            right: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 1px;
            height: 40%;
            background: #e1e8ed;
        }

        .step-number {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: #e5e7eb;
            color: #6b7280;
            font-weight: 700;
            font-size: 14px;
            margin-bottom: 8px;
            transition: all 0.3s ease;
        }

        .step.active .step-number {
            background: #1d9bf0;
            color: white;
        }

        .step.completed .step-number {
            background: #10b981;
            color: white;
        }

        .step-title {
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 4px;
        }

        .step-desc {
            font-size: 12px;
            opacity: 0.7;
        }

        /* Form Content */
        .form-content {
            padding: 40px;
        }

        .form-section {
            display: none;
        }

        .form-section.active {
            display: block;
        }

        /* Section Headers */
        .section-header {
            margin-bottom: 24px;
        }

        .section-title {
            font-size: 24px;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 8px;
        }

        .section-subtitle {
            font-size: 16px;
            color: #6b7280;
        }

        /* Form Groups */
        .form-group {
            margin-bottom: 24px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
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
        .form-select,
        .form-textarea {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.3s ease;
            background: white;
        }

        .form-input:focus,
        .form-select:focus,
        .form-textarea:focus {
            outline: none;
            border-color: #1d9bf0;
            box-shadow: 0 0 0 3px rgba(29, 155, 240, 0.1);
        }

        .form-textarea {
            min-height: 120px;
            resize: vertical;
        }

        .form-textarea.large {
            min-height: 200px;
        }

        /* File Upload */
        .file-upload-area {
            border: 2px dashed #d1d5db;
            border-radius: 8px;
            padding: 40px;
            text-align: center;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .file-upload-area:hover,
        .file-upload-area.dragover {
            border-color: #1d9bf0;
            background: rgba(29, 155, 240, 0.05);
        }

        .file-upload-icon {
            font-size: 48px;
            color: #9ca3af;
            margin-bottom: 16px;
        }

        .file-upload-text {
            color: #6b7280;
            margin-bottom: 8px;
        }

        .file-upload-hint {
            font-size: 12px;
            color: #9ca3af;
        }

        .file-input {
            display: none;
        }

        /* Uploaded Files */
        .uploaded-files {
            margin-top: 16px;
        }

        .uploaded-file {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px 16px;
            background: #f8fafc;
            border: 1px solid #e1e8ed;
            border-radius: 8px;
            margin-bottom: 8px;
        }

        .file-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .file-icon {
            color: #1d9bf0;
        }

        .file-details {
            font-size: 14px;
        }

        .file-name {
            font-weight: 500;
            color: #374151;
        }

        .file-size {
            font-size: 12px;
            color: #6b7280;
        }

        .remove-file {
            color: #dc2626;
            cursor: pointer;
            padding: 4px;
            border-radius: 4px;
            transition: all 0.2s ease;
        }

        .remove-file:hover {
            background: #fef2f2;
        }

        /* Tags Input */
        .tags-container {
            border: 1px solid #d1d5db;
            border-radius: 8px;
            padding: 8px;
            min-height: 46px;
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            align-items: center;
            cursor: text;
        }

        .tags-container:focus-within {
            border-color: #1d9bf0;
            box-shadow: 0 0 0 3px rgba(29, 155, 240, 0.1);
        }

        .tag-item {
            background: #1d9bf0;
            color: white;
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 12px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .tag-remove {
            cursor: pointer;
            font-size: 10px;
            opacity: 0.8;
        }

        .tag-remove:hover {
            opacity: 1;
        }

        .tag-input {
            border: none;
            outline: none;
            flex: 1;
            min-width: 100px;
            font-size: 14px;
            padding: 4px;
        }

        /* Budget Section */
        .budget-options {
            display: grid;
            gap: 16px;
        }

        .budget-option {
            border: 1px solid #d1d5db;
            border-radius: 8px;
            padding: 20px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .budget-option:hover {
            border-color: #1d9bf0;
        }

        .budget-option.selected {
            border-color: #1d9bf0;
            background: rgba(29, 155, 240, 0.05);
        }

        .budget-option-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 8px;
        }

        .budget-radio {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            border: 2px solid #d1d5db;
            position: relative;
            transition: all 0.3s ease;
        }

        .budget-option.selected .budget-radio {
            border-color: #1d9bf0;
        }

        .budget-option.selected .budget-radio::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: #1d9bf0;
        }

        .budget-title {
            font-size: 16px;
            font-weight: 600;
            color: #1a1a1a;
        }

        .budget-description {
            font-size: 14px;
            color: #6b7280;
        }

        /* Range Inputs */
        .range-inputs {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
            margin-top: 16px;
        }

        /* Navigation Buttons */
        .form-navigation {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 40px;
            padding-top: 24px;
            border-top: 1px solid #e1e8ed;
        }

        .btn {
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-secondary {
            background: white;
            color: #6b7280;
            border: 1px solid #d1d5db;
        }

        .btn-secondary:hover {
            background: #f9fafb;
            border-color: #9ca3af;
        }

        .btn-primary {
            background: #1d9bf0;
            color: white;
            border: 1px solid #1d9bf0;
        }

        .btn-primary:hover {
            background: #1e40af;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(29, 155, 240, 0.3);
        }

        .btn-success {
            background: #10b981;
            color: white;
            border: 1px solid #10b981;
        }

        .btn-success:hover {
            background: #047857;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
        }

        /* Progress Indicator */
        .progress-bar {
            height: 4px;
            background: #e5e7eb;
            border-radius: 2px;
            overflow: hidden;
            margin-bottom: 32px;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(135deg, #1d9bf0 0%, #0ea5e9 100%);
            border-radius: 2px;
            transition: width 0.5s ease;
        }

        /* Help Text */
        .help-text {
            font-size: 12px;
            color: #6b7280;
            margin-top: 4px;
        }

        .character-count {
            font-size: 12px;
            color: #9ca3af;
            text-align: right;
            margin-top: 4px;
        }

        /* Success Modal Styles */
        .success-modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .success-modal-overlay.show {
            opacity: 1;
            visibility: visible;
        }

        .success-modal-content {
            background: white;
            border-radius: 16px;
            max-width: 500px;
            width: 90%;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.25);
            transform: scale(0.9) translateY(-20px);
            transition: transform 0.3s ease;
        }

        .success-modal-overlay.show .success-modal-content {
            transform: scale(1) translateY(0);
        }

        .success-modal-body {
            padding: 48px 40px;
            text-align: center;
        }

        .success-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #10b981 0%, #047857 100%);
            border-radius: 50%;
            margin: 0 auto 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            animation: scaleIn 0.5s ease 0.2s both;
        }

        .success-icon i {
            font-size: 32px;
            color: white;
        }

        .success-title {
            font-size: 24px;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 12px;
            animation: slideUp 0.5s ease 0.3s both;
        }

        .success-message {
            color: #6b7280;
            margin-bottom: 32px;
            line-height: 1.5;
            font-size: 16px;
            animation: slideUp 0.5s ease 0.4s both;
        }

        .success-buttons {
            display: flex;
            gap: 12px;
            justify-content: center;
            animation: slideUp 0.5s ease 0.5s both;
        }

        @keyframes scaleIn {
            from {
                transform: scale(0);
                opacity: 0;
            }
            to {
                transform: scale(1);
                opacity: 1;
            }
        }

        @keyframes slideUp {
            from {
                transform: translateY(20px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .nav {
                padding: 0 16px;
            }

            .breadcrumb-container {
                padding: 12px 16px;
            }

            .main-container {
                padding: 24px 16px;
            }

            .form-content {
                padding: 24px;
            }

            .form-row {
                grid-template-columns: 1fr;
            }

            .range-inputs {
                grid-template-columns: 1fr;
            }

            .form-steps {
                flex-direction: column;
            }

            .step:not(:last-child)::after {
                display: none;
            }

            .page-title {
                font-size: 24px;
            }

            .section-title {
                font-size: 20px;
            }
        }

        @media (max-width: 480px) {
            .form-navigation {
                flex-direction: column;
                gap: 12px;
            }

            .btn {
                width: 100%;
                justify-content: center;
            }

            .success-modal-body {
                padding: 32px 24px;
            }

            .success-buttons {
                flex-direction: column;
            }

            .success-buttons .btn {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <!-- Category Navigation -->
    <div class="nav-container">
        <nav class="nav">
            <ul class="nav-list">
                <li class="nav-item"><a href="/popular" class="nav-link">Pekerjaan Popular</a></li>
                <li class="nav-item"><a href="/grafis" class="nav-link">Grafis & Desain</a></li>
                <li class="nav-item"><a href="/penulisan" class="nav-link">Penulisan & Penerjemahan</a></li>
                <li class="nav-item"><a href="/web-development" class="nav-link">Web dan Pemrograman</a></li>
                <li class="nav-item"><a href="#" class="nav-link">Visual dan Audio</a></li>
                <li class="nav-item"><a href="#" class="nav-link">Pemasaran dan Periklanan</a></li>
                <li class="nav-item"><a href="#" class="nav-link">Bisnis</a></li>
            </ul>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="main-container">
        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-title">Posting Lowongan Pekerjaan</h1>
            <p class="page-subtitle">Buat lowongan pekerjaan yang menarik untuk mendapatkan freelancer terbaik sesuai kebutuhan proyek Anda</p>
        </div>

        <!-- Progress Bar -->
        <div class="progress-bar">
            <div class="progress-fill" id="progressFill" style="width: 33.33%"></div>
        </div>

        <!-- Form Container -->
        <div class="form-container">
            <!-- Form Steps -->
            <div class="form-steps">
                <div class="step active" data-step="1">
                    <div class="step-number">1</div>
                    <div class="step-title">Detail Proyek</div>
                    <div class="step-desc">Informasi dasar proyek</div>
                </div>
                <div class="step" data-step="2">
                    <div class="step-number">2</div>
                    <div class="step-title">Deskripsi & File</div>
                    <div class="step-desc">Detail kebutuhan & lampiran</div>
                </div>
                <div class="step" data-step="3">
                    <div class="step-number">3</div>
                    <div class="step-title">Budget & Timeline</div>
                    <div class="step-desc">Anggaran & waktu pengerjaan</div>
                </div>
            </div>

            <!-- Form Content -->
            <form id="postJobForm" class="form-content">
                <!-- Step 1: Project Details -->
                <div class="form-section active" data-section="1">
                    <div class="section-header">
                        <h2 class="section-title">Informasi Dasar Proyek</h2>
                        <p class="section-subtitle">Berikan informasi yang jelas tentang proyek Anda untuk menarik freelancer yang tepat</p>
                    </div>

                    <div class="form-group">
                        <label for="projectTitle" class="form-label required">Judul Proyek</label>
                        <input type="text" id="projectTitle" name="projectTitle" class="form-input" placeholder="Contoh: Dicari: Freelancer untuk Pembuatan Website E-Commerce" required>
                        <div class="character-count">0/100 karakter</div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="category" class="form-label required">Kategori</label>
                            <select id="category" name="category" class="form-select" required>
                                <option value="">Pilih Kategori</option>
                                <option value="web-development">Web Development</option>
                                <option value="mobile-development">Mobile Development</option>
                                <option value="graphic-design">Grafis & Desain</option>
                                <option value="writing">Penulisan & Penerjemahan</option>
                                <option value="marketing">Pemasaran & Periklanan</option>
                                <option value="business">Bisnis</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="subcategory" class="form-label">Sub Kategori</label>
                            <select id="subcategory" name="subcategory" class="form-select">
                                <option value="">Pilih Sub Kategori</option>
                                <option value="ecommerce">E-Commerce</option>
                                <option value="company-profile">Company Profile</option>
                                <option value="blog">Blog/Portal Berita</option>
                                <option value="landing-page">Landing Page</option>
                                <option value="web-app">Web Application</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="experienceLevel" class="form-label required">Level Pengalaman</label>
                            <select id="experienceLevel" name="experienceLevel" class="form-select" required>
                                <option value="">Pilih Level</option>
                                <option value="entry">Entry Level - Freelancer pemula</option>
                                <option value="intermediate">Intermediate - Berpengalaman 1-3 tahun</option>
                                <option value="expert">Expert - Berpengalaman 3+ tahun</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="projectType" class="form-label required">Jenis Proyek</label>
                            <select id="projectType" name="projectType" class="form-select" required>
                                <option value="">Pilih Jenis</option>
                                <option value="one-time">Sekali jalan</option>
                                <option value="ongoing">Berkelanjutan</option>
                                <option value="contract">Kontrak jangka panjang</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="skills" class="form-label required">Skills yang Dibutuhkan</label>
                        <div class="tags-container" id="skillsContainer">
                            <input type="text" class="tag-input" placeholder="Ketik skill dan tekan Enter...">
                        </div>
                        <div class="help-text">Contoh: Laravel, PHP, JavaScript, MySQL, TailwindCSS</div>
                    </div>
                </div>

                <!-- Step 2: Description & Files -->
                <div class="form-section" data-section="2">
                    <div class="section-header">
                        <h2 class="section-title">Deskripsi Proyek & Lampiran</h2>
                        <p class="section-subtitle">Jelaskan detail kebutuhan proyek Anda dengan lengkap</p>
                    </div>

                    <div class="form-group">
                        <label for="projectDescription" class="form-label required">Deskripsi Proyek</label>
                        <textarea id="projectDescription" name="projectDescription" class="form-textarea large" placeholder="Jelaskan secara detail tentang proyek Anda, apa yang ingin dicapai, fitur-fitur yang dibutuhkan, dan ekspektasi hasil akhir..." required></textarea>
                        <div class="character-count">0/2000 karakter</div>
                        <div class="help-text">Semakin detail deskripsi Anda, semakin mudah freelancer memahami kebutuhan proyek</div>
                    </div>

                    <div class="form-group">
                        <label for="requirements" class="form-label">Persyaratan Khusus</label>
                        <textarea id="requirements" name="requirements" class="form-textarea" placeholder="Tuliskan persyaratan khusus seperti pengalaman dengan teknologi tertentu, portfolio yang dibutuhkan, sertifikasi, dll..."></textarea>
                        <div class="help-text">Opsional - Persyaratan tambahan yang harus dipenuhi freelancer</div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Lampiran File (Opsional)</label>
                        <div class="file-upload-area" onclick="document.getElementById('fileInput').click()">
                            <div class="file-upload-icon">
                                <i class="fas fa-cloud-upload-alt"></i>
                            </div>
                            <div class="file-upload-text">Klik untuk upload file atau drag & drop</div>
                            <div class="file-upload-hint">PDF, DOC, JPG, PNG - Max 10MB per file</div>
                        </div>
                        <input type="file" id="fileInput" class="file-input" multiple accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                        <div class="uploaded-files" id="uploadedFiles"></div>
                        <div class="help-text">Upload brief, mockup, referensi, atau dokumen pendukung lainnya</div>
                    </div>

                    <div class="form-group">
                        <label for="deliverables" class="form-label required">Hasil yang Diharapkan</label>
                        <textarea id="deliverables" name="deliverables" class="form-textarea" placeholder="Jelaskan hasil akhir yang diharapkan, format file, dokumentasi yang diperlukan, dll..." required></textarea>
                        <div class="help-text">Contoh: Source code, dokumentasi teknis, panduan penggunaan, file database, dll.</div>
                    </div>
                </div>

                <!-- Step 3: Budget & Timeline -->
                <div class="form-section" data-section="3">
                    <div class="section-header">
                        <h2 class="section-title">Budget & Timeline</h2>
                        <p class="section-subtitle">Tentukan anggaran dan waktu pengerjaan proyek</p>
                    </div>

                    <div class="form-group">
                        <label class="form-label required">Tipe Budget</label>
                        <div class="budget-options">
                            <div class="budget-option" data-budget="fixed">
                                <div class="budget-option-header">
                                    <div class="budget-radio"></div>
                                    <div class="budget-title">Fixed Price</div>
                                </div>
                                <div class="budget-description">Budget tetap untuk keseluruhan proyek</div>
                                <div class="range-inputs" style="display: none;">
                                    <div class="form-group">
                                        <label class="form-label">Budget Fixed (Rp)</label>
                                        <input type="number" name="fixedBudget" class="form-input" placeholder="5000000">
                                    </div>
                                </div>
                            </div>

                            <div class="budget-option" data-budget="range">
                                <div class="budget-option-header">
                                    <div class="budget-radio"></div>
                                    <div class="budget-title">Budget Range</div>
                                </div>
                                <div class="budget-description">Rentang budget yang fleksibel</div>
                                <div class="range-inputs" style="display: none;">
                                    <div class="form-group">
                                        <label class="form-label">Budget Minimum (Rp)</label>
                                        <input type="number" name="minBudget" class="form-input" placeholder="3000000">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Budget Maximum (Rp)</label>
                                        <input type="number" name="maxBudget" class="form-input" placeholder="7000000">
                                    </div>
                                </div>
                            </div>

                            <div class="budget-option" data-budget="hourly">
                                <div class="budget-option-header">
                                    <div class="budget-radio"></div>
                                    <div class="budget-title">Hourly Rate</div>
                                </div>
                                <div class="budget-description">Bayar per jam kerja</div>
                                <div class="range-inputs" style="display: none;">
                                    <div class="form-group">
                                        <label class="form-label">Rate per Jam (Rp)</label>
                                        <input type="number" name="hourlyRate" class="form-input" placeholder="150000">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Estimasi Total Jam</label>
                                        <input type="number" name="estimatedHours" class="form-input" placeholder="40">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="timeline" class="form-label required">Timeline Pengerjaan</label>
                            <select id="timeline" name="timeline" class="form-select" required>
                                <option value="">Pilih Timeline</option>
                                <option value="1-week">Kurang dari 1 minggu</option>
                                <option value="1-2-weeks">1-2 minggu</option>
                                <option value="2-4-weeks">2-4 minggu</option>
                                <option value="1-2-months">1-2 bulan</option>
                                <option value="2-3-months">2-3 bulan</option>
                                <option value="3-months-plus">Lebih dari 3 bulan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="urgency" class="form-label">Tingkat Urgensi</label>
                            <select id="urgency" name="urgency" class="form-select">
                                <option value="normal">Normal</option>
                                <option value="urgent">Segera</option>
                                <option value="asap">Sangat Mendesak</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="milestones" class="form-label">Milestone Pembayaran (Opsional)</label>
                        <textarea id="milestones" name="milestones" class="form-textarea" placeholder="Contoh:&#10;- 30% - Setelah approval design mockup&#10;- 40% - Setelah development selesai&#10;- 30% - Setelah testing dan go-live"></textarea>
                        <div class="help-text">Bagi pembayaran menjadi beberapa tahap untuk meminimalisir risiko</div>
                    </div>

                    <div class="form-group">
                        <label for="additionalInfo" class="form-label">Informasi Tambahan</label>
                        <textarea id="additionalInfo" name="additionalInfo" class="form-textarea" placeholder="Tambahkan informasi lain yang menurut Anda penting untuk diketahui freelancer..."></textarea>
                        <div class="help-text">Opsional - Informasi tambahan seperti preferensi komunikasi, meeting schedule, dll.</div>
                    </div>
                </div>

                <!-- Navigation Buttons -->
                <div class="form-navigation">
                    <button type="button" class="btn btn-secondary" id="prevBtn" style="visibility: hidden;">
                        <i class="fas fa-arrow-left"></i>
                        Sebelumnya
                    </button>
                    
                    <div style="flex: 1; text-align: center;">
                        <span id="stepIndicator" style="color: #6b7280; font-size: 14px;">Step 1 dari 3</span>
                    </div>

                    <button type="button" class="btn btn-primary" id="nextBtn">
                        Selanjutnya
                        <i class="fas fa-arrow-right"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Success Modal -->
    <div id="successModal" class="success-modal-overlay">
        <div class="success-modal-content">
            <div class="success-modal-body">
                <div class="success-icon">
                    <i class="fas fa-check"></i>
                </div>
                <h3 class="success-title">Lowongan Berhasil Diposting!</h3>
                <p class="success-message">Proyek Anda telah dipublikasikan dan freelancer dapat mulai mengajukan proposal. Anda akan mendapat notifikasi via email ketika ada freelancer yang tertarik.</p>
                <div class="success-buttons">
                    <button class="btn btn-secondary" onclick="window.location.href='/my-projects'">Kelola Proyek</button>
                    <button class="btn btn-primary" onclick="window.location.href='/web-development'">Lihat Lowongan</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Global variables
        let currentStep = 1;
        const totalSteps = 3;
        let uploadedFiles = [];
        let skills = [];

        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            initializeForm();
        });

        function initializeForm() {
            // Character counters
            setupCharacterCounters();
            
            // File upload
            setupFileUpload();
            
            // Skills tags
            setupSkillsTags();
            
            // Budget options
            setupBudgetOptions();
            
            // Form navigation
            setupFormNavigation();
            
            // Auto-save draft (optional)
            setupAutoSave();
        }

        // Character counters
        function setupCharacterCounters() {
            const fields = [
                { id: 'projectTitle', max: 100 },
                { id: 'projectDescription', max: 2000 }
            ];

            fields.forEach(field => {
                const element = document.getElementById(field.id);
                const counter = element.parentNode.querySelector('.character-count');
                
                if (element && counter) {
                    element.addEventListener('input', function() {
                        const length = this.value.length;
                        counter.textContent = `${length}/${field.max} karakter`;
                        
                        if (length > field.max * 0.9) {
                            counter.style.color = '#dc2626';
                        } else if (length > field.max * 0.8) {
                            counter.style.color = '#f59e0b';
                        } else {
                            counter.style.color = '#9ca3af';
                        }
                    });
                }
            });
        }

        // File upload functionality
        function setupFileUpload() {
            const fileInput = document.getElementById('fileInput');
            const uploadArea = document.querySelector('.file-upload-area');
            const uploadedFilesContainer = document.getElementById('uploadedFiles');

            // Click to upload
            fileInput.addEventListener('change', handleFiles);

            // Drag and drop
            uploadArea.addEventListener('dragover', function(e) {
                e.preventDefault();
                this.classList.add('dragover');
            });

            uploadArea.addEventListener('dragleave', function(e) {
                e.preventDefault();
                this.classList.remove('dragover');
            });

            uploadArea.addEventListener('drop', function(e) {
                e.preventDefault();
                this.classList.remove('dragover');
                const files = Array.from(e.dataTransfer.files);
                handleFileArray(files);
            });

            function handleFiles(e) {
                const files = Array.from(e.target.files);
                handleFileArray(files);
            }

            function handleFileArray(files) {
                files.forEach(file => {
                    if (validateFile(file)) {
                        uploadedFiles.push({
                            file: file,
                            id: Date.now() + Math.random()
                        });
                        displayUploadedFile(file, uploadedFiles[uploadedFiles.length - 1].id);
                    }
                });
                fileInput.value = ''; // Reset input
            }

            function validateFile(file) {
                const maxSize = 10 * 1024 * 1024; // 10MB
                const allowedTypes = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'image/jpeg', 'image/jpg', 'image/png'];

                if (file.size > maxSize) {
                    alert(`File ${file.name} terlalu besar. Maximum 10MB.`);
                    return false;
                }

                if (!allowedTypes.includes(file.type)) {
                    alert(`File ${file.name} tidak didukung. Hanya PDF, DOC, JPG, PNG yang diizinkan.`);
                    return false;
                }

                return true;
            }

            function displayUploadedFile(file, id) {
                const fileElement = document.createElement('div');
                fileElement.className = 'uploaded-file';
                fileElement.innerHTML = `
                    <div class="file-info">
                        <i class="fas fa-file file-icon"></i>
                        <div class="file-details">
                            <div class="file-name">${file.name}</div>
                            <div class="file-size">${formatFileSize(file.size)}</div>
                        </div>
                    </div>
                    <div class="remove-file" onclick="removeFile(${id})">
                        <i class="fas fa-times"></i>
                    </div>
                `;
                uploadedFilesContainer.appendChild(fileElement);
            }

            window.removeFile = function(id) {
                uploadedFiles = uploadedFiles.filter(f => f.id !== id);
                // Remove from DOM
                event.target.closest('.uploaded-file').remove();
            };

            function formatFileSize(bytes) {
                if (bytes === 0) return '0 Bytes';
                const k = 1024;
                const sizes = ['Bytes', 'KB', 'MB', 'GB'];
                const i = Math.floor(Math.log(bytes) / Math.log(k));
                return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
            }
        }

        // Skills tags functionality
        function setupSkillsTags() {
            const skillsContainer = document.getElementById('skillsContainer');
            const tagInput = skillsContainer.querySelector('.tag-input');

            tagInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter' && this.value.trim()) {
                    e.preventDefault();
                    addSkill(this.value.trim());
                    this.value = '';
                }
            });

            tagInput.addEventListener('keydown', function(e) {
                if (e.key === 'Backspace' && this.value === '' && skills.length > 0) {
                    removeSkill(skills.length - 1);
                }
            });

            function addSkill(skill) {
                if (!skills.includes(skill) && skills.length < 10) {
                    skills.push(skill);
                    displaySkill(skill, skills.length - 1);
                }
            }

            function displaySkill(skill, index) {
                const tagElement = document.createElement('div');
                tagElement.className = 'tag-item';
                tagElement.innerHTML = `
                    ${skill}
                    <span class="tag-remove" onclick="removeSkill(${index})">×</span>
                `;
                skillsContainer.insertBefore(tagElement, tagInput);
            }

            window.removeSkill = function(index) {
                skills.splice(index, 1);
                refreshSkillsDisplay();
            };

            function refreshSkillsDisplay() {
                // Remove all tag items
                skillsContainer.querySelectorAll('.tag-item').forEach(el => el.remove());
                // Re-add all skills
                skills.forEach((skill, index) => {
                    displaySkill(skill, index);
                });
            }
        }

        // Budget options functionality
        function setupBudgetOptions() {
            document.querySelectorAll('.budget-option').forEach(option => {
                option.addEventListener('click', function() {
                    // Remove selected from all
                    document.querySelectorAll('.budget-option').forEach(opt => {
                        opt.classList.remove('selected');
                        opt.querySelector('.range-inputs').style.display = 'none';
                    });
                    
                    // Add selected to current
                    this.classList.add('selected');
                    this.querySelector('.range-inputs').style.display = 'grid';
                });
            });
        }

        // Form navigation
        function setupFormNavigation() {
            const nextBtn = document.getElementById('nextBtn');
            const prevBtn = document.getElementById('prevBtn');

            nextBtn.addEventListener('click', function() {
                if (validateCurrentStep()) {
                    if (currentStep < totalSteps) {
                        nextStep();
                    } else {
                        submitForm();
                    }
                }
            });

            prevBtn.addEventListener('click', function() {
                if (currentStep > 1) {
                    prevStep();
                }
            });

            // Step indicators
            document.querySelectorAll('.step').forEach(step => {
                step.addEventListener('click', function() {
                    const stepNumber = parseInt(this.dataset.step);
                    if (stepNumber < currentStep || validateStepsUpTo(stepNumber - 1)) {
                        goToStep(stepNumber);
                    }
                });
            });
        }

        function nextStep() {
            currentStep++;
            updateFormDisplay();
        }

        function prevStep() {
            currentStep--;
            updateFormDisplay();
        }

        function goToStep(step) {
            currentStep = step;
            updateFormDisplay();
        }

        function updateFormDisplay() {
            // Update sections
            document.querySelectorAll('.form-section').forEach(section => {
                section.classList.remove('active');
            });
            document.querySelector(`[data-section="${currentStep}"]`).classList.add('active');

            // Update step indicators
            document.querySelectorAll('.step').forEach(step => {
                const stepNumber = parseInt(step.dataset.step);
                step.classList.remove('active', 'completed');
                
                if (stepNumber === currentStep) {
                    step.classList.add('active');
                } else if (stepNumber < currentStep) {
                    step.classList.add('completed');
                }
            });

            // Update navigation buttons
            const nextBtn = document.getElementById('nextBtn');
            const prevBtn = document.getElementById('prevBtn');
            const stepIndicator = document.getElementById('stepIndicator');

            prevBtn.style.visibility = currentStep === 1 ? 'hidden' : 'visible';
            
            if (currentStep === totalSteps) {
                nextBtn.innerHTML = '<i class="fas fa-paper-plane"></i> Posting Lowongan';
                nextBtn.className = 'btn btn-success';
            } else {
                nextBtn.innerHTML = 'Selanjutnya <i class="fas fa-arrow-right"></i>';
                nextBtn.className = 'btn btn-primary';
            }

            stepIndicator.textContent = `Step ${currentStep} dari ${totalSteps}`;

            // Update progress bar
            const progress = (currentStep / totalSteps) * 100;
            document.getElementById('progressFill').style.width = `${progress}%`;

            // Scroll to top
            document.querySelector('.form-container').scrollIntoView({ behavior: 'smooth' });
        }

        function validateCurrentStep() {
            const currentSection = document.querySelector(`[data-section="${currentStep}"]`);
            const requiredFields = currentSection.querySelectorAll('[required]');
            let isValid = true;

            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    field.style.borderColor = '#dc2626';
                    isValid = false;
                    
                    // Reset border color on input
                    field.addEventListener('input', function() {
                        this.style.borderColor = '#d1d5db';
                    }, { once: true });
                }
            });

            // Additional validations
            if (currentStep === 1 && skills.length === 0) {
                alert('Mohon tambahkan minimal 1 skill yang dibutuhkan');
                isValid = false;
            }

            if (currentStep === 3) {
                const selectedBudget = document.querySelector('.budget-option.selected');
                if (!selectedBudget) {
                    alert('Mohon pilih tipe budget');
                    isValid = false;
                }
            }

            if (!isValid) {
                // Scroll to first invalid field
                const firstInvalid = currentSection.querySelector('[required][style*="border-color: rgb(220, 38, 38)"]');
                if (firstInvalid) {
                    firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    firstInvalid.focus();
                }
            }

            return isValid;
        }

        function validateStepsUpTo(step) {
            // Simplified validation for step navigation
            return true; // Allow navigation for better UX
        }

        function submitForm() {
            // Show loading state
            const nextBtn = document.getElementById('nextBtn');
            nextBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memposting...';
            nextBtn.disabled = true;

            // Collect form data
            const formData = collectFormData();
            console.log('Form data:', formData);

            // Simulate API call
            setTimeout(() => {
                nextBtn.innerHTML = '<i class="fas fa-paper-plane"></i> Posting Lowongan';
                nextBtn.disabled = false;
                
                // Show success modal
                document.getElementById('successModal').classList.add('show');
            }, 2000);
        }

        function collectFormData() {
            const formData = new FormData();
            
            // Basic form fields
            const form = document.getElementById('postJobForm');
            const inputs = form.querySelectorAll('input, select, textarea');
            
            inputs.forEach(input => {
                if (input.name && input.value) {
                    formData.append(input.name, input.value);
                }
            });

            // Skills array
            formData.append('skills', JSON.stringify(skills));

            // Files
            uploadedFiles.forEach((fileObj, index) => {
                formData.append(`file_${index}`, fileObj.file);
            });

            return formData;
        }

        // Auto-save functionality
        function setupAutoSave() {
            const form = document.getElementById('postJobForm');
            let autoSaveTimer;

            form.addEventListener('input', function() {
                clearTimeout(autoSaveTimer);
                autoSaveTimer = setTimeout(saveAsDraft, 3000); // Save after 3 seconds of inactivity
            });

            function saveAsDraft() {
                const draftData = {
                    projectTitle: document.getElementById('projectTitle').value,
                    category: document.getElementById('category').value,
                    projectDescription: document.getElementById('projectDescription').value,
                    skills: skills,
                    currentStep: currentStep
                };
                
                localStorage.setItem('jobPostDraft', JSON.stringify(draftData));
                
                // Show brief success message
                const indicator = document.getElementById('stepIndicator');
                const originalText = indicator.textContent;
                indicator.innerHTML = '<i class="fas fa-check" style="color: #10b981;"></i> Draft tersimpan';
                indicator.style.color = '#10b981';
                
                setTimeout(() => {
                    indicator.textContent = originalText;
                    indicator.style.color = '#6b7280';
                }, 2000);
            }
        }

        // Load draft on page load
        function loadDraft() {
            const draft = localStorage.getItem('jobPostDraft');
            if (draft) {
                const draftData = JSON.parse(draft);
                
                if (confirm('Ditemukan draft yang tersimpan. Apakah ingin melanjutkan?')) {
                    // Load draft data
                    document.getElementById('projectTitle').value = draftData.projectTitle || '';
                    document.getElementById('category').value = draftData.category || '';
                    document.getElementById('projectDescription').value = draftData.projectDescription || '';
                    skills = draftData.skills || [];
                    
                    // Refresh skills display
                    skills.forEach((skill, index) => {
                        const skillsContainer = document.getElementById('skillsContainer');
                        const tagElement = document.createElement('div');
                        tagElement.className = 'tag-item';
                        tagElement.innerHTML = `
                            ${skill}
                            <span class="tag-remove" onclick="removeSkill(${index})">×</span>
                        `;
                        skillsContainer.insertBefore(tagElement, skillsContainer.querySelector('.tag-input'));
                    });
                    
                    // Go to saved step
                    if (draftData.currentStep) {
                        goToStep(draftData.currentStep);
                    }
                }
            }
        }

        // Load draft when page loads
        document.addEventListener('DOMContentLoaded', function() {
            loadDraft();
        });

        // Clear draft when form is successfully submitted
        window.clearDraft = function() {
            localStorage.removeItem('jobPostDraft');
        };

        // Close success modal
        document.getElementById('successModal').addEventListener('click', function(e) {
            if (e.target === this) {
                this.classList.remove('show');
                clearDraft();
                // Redirect after closing
                setTimeout(() => {
                    window.location.href = '/web-development';
                }, 300);
            }
        });

        // Close modal with escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                const modal = document.getElementById('successModal');
                if (modal.classList.contains('show')) {
                    modal.classList.remove('show');
                    clearDraft();
                    setTimeout(() => {
                        window.location.href = '/web-development';
                    }, 300);
                }
            }
        });
    </script>
</body>
</html>
@endsection