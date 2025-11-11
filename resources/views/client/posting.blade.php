@extends('client.layout.client-layout') 
@section('title', ($isEdit ? 'Edit Proyek' : 'Posting Lowongan Pekerjaan') . ' - CariFreelance') 
@section('content') 

<style>

                /* Navigation Categories - Same styling from original */
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
        }

        .nav-container.scrolled {
            box-shadow: 0 4px 20px rgba(0,0,0,0.15);
            top: 60px;
        }

        .nav {
            max-width: 100%;
            margin: 0 auto;
            padding: 0 20px;
        }

        .nav-list {
            display: flex;
            list-style: none;
            overflow-x: auto;
            padding: 4px 0;
            gap: 90px;
            scrollbar-width: none;
            -ms-overflow-style: none;
            align-items: center;
            justify-content: center;
            flex-wrap: nowrap;
        }

        .nav-list::-webkit-scrollbar {
            display: none;
        }

        .nav-item {
            white-space: nowrap;
            cursor: pointer;
            padding: 8px 20px;
            border-radius: 20px;
            transition: all 0.3s ease;
            font-weight: 500;
            color: #666;
            background: transparent;
            border: none;
            min-height: 36px;
            display: flex;
            align-items: center;
            flex-shrink: 0;
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


    .main-container {
        max-width: 800px;
        margin: 0 auto;
        padding: 0 1rem;
    }

    .page-header {
        text-align: center;
        margin-bottom: 2rem;
    }

    .page-title {
        font-size: 2rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 0.5rem;
    }

    .page-subtitle {
        color: #64748b;
        font-size: 1.1rem;
        line-height: 1.6;
    }

    .form-container {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        padding: 2rem;
        margin-bottom: 2rem;
    }

    .section-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: #1e293b;
        margin-bottom: 1.5rem;
        padding-bottom: 0.5rem;
        border-bottom: 2px solid #e2e8f0;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
    }

    .form-label {
        display: block;
        font-weight: 600;
        color: #374151;
        margin-bottom: 0.5rem;
        font-size: 0.875rem;
    }

    .form-label.required::after {
        content: " *";
        color: #ef4444;
    }

    .form-input, .form-select, .form-textarea {
        width: 100%;
        padding: 0.75rem;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        font-size: 0.875rem;
        transition: border-color 0.2s ease;
    }

    .form-input:focus, .form-select:focus, .form-textarea:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    .form-textarea {
        min-height: 120px;
        resize: vertical;
    }

    .form-textarea.large {
        min-height: 180px;
    }

    .character-count {
        text-align: right;
        font-size: 0.75rem;
        color: #6b7280;
        margin-top: 0.25rem;
    }

    .help-text {
        font-size: 0.75rem;
        color: #6b7280;
        margin-top: 0.25rem;
    }

    /* Tags/Skills Input */
    .tags-container {
        border: 1px solid #d1d5db;
        border-radius: 8px;
        padding: 0.5rem;
        min-height: 60px;
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        align-items: flex-start;
    }

    .tags-container:focus-within {
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    .tag-input {
        border: none;
        outline: none;
        flex: 1;
        min-width: 120px;
        padding: 0.25rem;
        font-size: 0.875rem;
    }

    .skill-tag {
        background: #3b82f6;
        color: white;
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        font-size: 0.75rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .skill-tag .remove-tag {
        cursor: pointer;
        font-size: 0.875rem;
        opacity: 0.8;
    }

    .skill-tag .remove-tag:hover {
        opacity: 1;
    }

    /* Budget Options */
    .budget-options {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1rem;
        margin-bottom: 1.5rem;
    }

    .budget-option {
        border: 2px solid #e5e7eb;
        border-radius: 12px;
        padding: 1.5rem;
        cursor: pointer;
        transition: all 0.3s ease;
        text-align: center;
    }

    .budget-option:hover {
        border-color: #3b82f6;
        background: #f8fafc;
    }

    .budget-option.selected {
        border-color: #3b82f6;
        background: #eff6ff;
    }

    .budget-option h4 {
        margin: 0 0 0.5rem 0;
        color: #1e293b;
        font-weight: 600;
    }

    .budget-option p {
        margin: 0;
        color: #64748b;
        font-size: 0.875rem;
    }

    .budget-details {
        display: none;
        margin-top: 1rem;
        padding: 1rem;
        background: #f8fafc;
        border-radius: 8px;
    }

    .budget-details.active {
        display: block;
    }

    /* Payment Options */
    .payment-options {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
        margin-bottom: 1rem;
    }

    .payment-option {
        border: 2px solid #e5e7eb;
        border-radius: 12px;
        padding: 1.5rem;
        cursor: pointer;
        transition: all 0.3s ease;
        text-align: center;
        position: relative;
    }

    .payment-option:hover {
        border-color: #3b82f6;
        background: #f8fafc;
    }

    .payment-option input[type="radio"] {
        position: absolute;
        opacity: 0;
        width: 0;
        height: 0;
    }

    .payment-option label {
        cursor: pointer;
        display: block;
        width: 100%;
        margin: 0;
    }

    .payment-option h4 {
        margin: 0.5rem 0;
        color: #1e293b;
        font-weight: 600;
    }

    .payment-option p {
        margin: 0;
        color: #64748b;
        font-size: 0.875rem;
    }

    .payment-option.selected {
        border-color: #3b82f6;
        background: #eff6ff;
    }

    /* DP Percentage Group */
    #dpPercentageGroup {
        margin-top: 1rem;
        padding: 1rem;
        background: #f8fafc;
        border-radius: 8px;
        border: 1px solid #e2e8f0;
    }

    /* File Upload */
    .file-upload-area {
        border: 2px dashed #d1d5db;
        border-radius: 8px;
        padding: 2rem;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .file-upload-area:hover {
        border-color: #3b82f6;
        background: #f8fafc;
    }

    .file-upload-icon {
        font-size: 2rem;
        color: #9ca3af;
        margin-bottom: 0.5rem;
    }

    .file-upload-text {
        color: #374151;
        font-weight: 500;
        margin-bottom: 0.25rem;
    }

    .file-upload-hint {
        color: #6b7280;
        font-size: 0.875rem;
    }

    .file-input {
        display: none;
    }

    .existing-files {
        margin-top: 1rem;
    }

    .existing-file-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.5rem;
        background: #f8fafc;
        border-radius: 6px;
        margin-bottom: 0.5rem;
    }

    .file-remove-btn {
        color: #ef4444;
        cursor: pointer;
        font-size: 0.875rem;
        padding: 0.25rem 0.5rem;
        border-radius: 4px;
        transition: background 0.2s;
    }

    .file-remove-btn:hover {
        background: #fee2e2;
    }

    /* Buttons */
    .form-actions {
        display: flex;
        gap: 1rem;
        justify-content: center;
        margin-top: 2rem;
        padding-top: 2rem;
        border-top: 1px solid #e5e7eb;
    }

    .btn {
        padding: 0.75rem 2rem;
        border-radius: 8px;
        font-weight: 500;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        cursor: pointer;
        border: none;
        font-size: 0.875rem;
        transition: all 0.2s ease;
    }

    .btn-primary {
        background: linear-gradient(90deg, #3b82f6, #1d4ed8);
        color: white;
    }

    .btn-primary:hover {
        background: linear-gradient(90deg, #2563eb, #1e40af);
        transform: translateY(-1px);
    }

    .btn-secondary {
        background: #f1f5f9;
        color: #64748b;
        border: 1px solid #e2e8f0;
    }

    .btn-secondary:hover {
        background: #e2e8f0;
        color: #475569;
    }

    .btn-danger {
        background: #ef4444;
        color: white;
    }

    .btn-danger:hover {
        background: #dc2626;
        transform: translateY(-1px);
    }

    .error-message {
        background: #fef2f2;
        border: 1px solid #fecaca;
        color: #dc2626;
        padding: 0.75rem;
        border-radius: 8px;
        margin-bottom: 1rem;
        font-size: 0.875rem;
    }

    .breadcrumb {
        margin-bottom: 1rem;
    }

    .breadcrumb a {
        color: #3b82f6;
        text-decoration: none;
    }

    .breadcrumb a:hover {
        text-decoration: underline;
    }

    .delete-section {
        border-top: 1px solid #e5e7eb;
        padding-top: 2rem;
        margin-top: 2rem;
    }

    .delete-warning {
        background: #fef3f2;
        border: 1px solid #fecaca;
        color: #b91c1c;
        padding: 1rem;
        border-radius: 8px;
        margin-bottom: 1rem;
    }

    @media (max-width: 768px) {
        .form-row {
            grid-template-columns: 1fr;
        }
        
        .budget-options {
            grid-template-columns: 1fr;
        }

        .payment-options {
            grid-template-columns: 1fr;
        }
        
        .form-actions {
            flex-direction: column;
        }
    }
</style>

           <!-- Category Navigation -->
    <div class="nav-container">
        <nav class="nav">
            <ul class="nav-list">
                <li class="nav-item {{ request()->is('popular*') ? 'active' : '' }}">
                    <a href="/popular" class="nav-link">Pekerjaan Populer</a>
                </li>
                <li class="nav-item {{ request()->is('grafis*') ? 'active' : '' }}">
                    <a href="/grafis" class="nav-link">Grafis & Desain</a>
                </li>
                <li class="nav-item {{ request()->is('dokumen*') ? 'active' : '' }}">
                    <a href="/dokumen" class="nav-link">Dokumen & PPT</a>
                </li>
                <li class="nav-item {{ request()->is('web*') ? 'active' : '' }}">
                    <a href="/web" class="nav-link">Web & App</a>
                </li>
                <li class="nav-item {{ request()->is('video*') ? 'active' : '' }}">
                    <a href="/video" class="nav-link">Video Editing</a>
                </li>
            </ul>
        </nav>
    </div>

<!-- Main Content -->
<div class="main-container" style="margin-top: 40px;">

    <!-- Page Header -->
    <div class="page-header">
        <h1 class="page-title">{{ $pageTitle }}</h1>
        <p class="page-subtitle">{{ $pageSubtitle }}</p>
    </div>

    <!-- Error Messages -->
    @if($errors->any())
        <div class="error-message">
            <ul style="margin: 0; padding-left: 1rem;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(session('error'))
        <div class="error-message">
            {{ session('error') }}
        </div>
    @endif

    <!-- Form Container -->
    <div class="form-container">
        <form id="{{ $isEdit ? 'editProjectForm' : 'postJobForm' }}" 
              method="POST" 
              action="{{ $isEdit ? route('projects.update', $project) : route('posting.store') }}" 
              enctype="multipart/form-data">
            @csrf
            @if($isEdit)
                @method('PUT')
            @endif
            
            <!-- Section 1: Basic Information -->
            <div class="form-section">
                <h3 class="section-title">Informasi Dasar</h3>
                
                <div class="form-group">
                    <label for="title" class="form-label required">Judul Proyek</label>
                    <input type="text" id="title" name="title" class="form-input"
                           value="{{ old('title', $isEdit ? $project->title : '') }}"
                           placeholder="Contoh: Dicari: Freelancer untuk Pembuatan Website E-Commerce" 
                           maxlength="100" required>
                    <div class="character-count">
                        <span id="titleCount">{{ strlen(old('title', $isEdit ? $project->title : '')) }}</span>/100 karakter
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="category" class="form-label required">Kategori</label>
                        <select id="category" name="category" class="form-select" required>
                            <option value="">Pilih Kategori</option>
                            <option value="pekerjaan-popular" {{ old('category', $isEdit ? $project->category : '') == 'pekerjaan-popular' ? 'selected' : '' }}>Pekerjaan Popular</option>
                            <option value="grafis-desain" {{ old('category', $isEdit ? $project->category : '') == 'grafis-desain' ? 'selected' : '' }}>Grafis & Desain</option>
                            <option value="dokumen-ppt" {{ old('category', $isEdit ? $project->category : '') == 'dokumen-ppt' ? 'selected' : '' }}>Dokumen & PPT</option>
                            <option value="web-app" {{ old('category', $isEdit ? $project->category : '') == 'web-app' ? 'selected' : '' }}>Web & App</option>
                            <option value="video-editing" {{ old('category', $isEdit ? $project->category : '') == 'video-editing' ? 'selected' : '' }}>Video Editing</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="subcategory" class="form-label">Sub Kategori</label>
                        <select id="subcategory" name="subcategory" class="form-select">
                            <option value="">Pilih Sub Kategori</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">

                    <div class="form-group">
                        <label for="project_type" class="form-label required">Jenis Proyek</label>
                        <select id="project_type" name="project_type" class="form-select" required>
                            <option value="">Pilih Jenis</option>
                            <option value="one-time" {{ old('project_type', $isEdit ? $project->project_type : '') == 'one-time' ? 'selected' : '' }}>Sekali jalan</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="skills" class="form-label required">Skills yang Dibutuhkan</label>
                    <div class="tags-container" id="skillsContainer">
                        <input type="text" class="tag-input" id="skillInput" placeholder="Ketik skill dan tekan Enter...">
                    </div>
                    <div class="help-text">Contoh: Laravel, PHP, JavaScript, MySQL, TailwindCSS</div>
                    <input type="hidden" name="skills_required" id="skillsRequired" 
                           value="{{ old('skills_required', $isEdit ? (is_array($project->skills_required) ? implode(',', $project->skills_required) : $project->skills_required) : '') }}">
                </div>
            </div>

            <!-- Section 2: Project Details -->
            <div class="form-section">
                <h3 class="section-title">Detail Proyek</h3>
                
                <div class="form-group">
                    <label for="description" class="form-label required">Deskripsi Proyek</label>
                    <textarea id="description" name="description" class="form-textarea large" required 
                              placeholder="Jelaskan detail proyek Anda secara lengkap...">{{ old('description', $isEdit ? $project->description : '') }}</textarea>
                </div>

                <div class="form-group">
                    <label for="requirements" class="form-label">Persyaratan Khusus</label>
                    <textarea id="requirements" name="requirements" class="form-textarea" 
                              placeholder="Persyaratan khusus atau kualifikasi yang dibutuhkan...">{{ old('requirements', $isEdit ? $project->requirements : '') }}</textarea>
                </div>

                <div class="form-group">
                    <label for="deliverables" class="form-label required">Hasil yang Diharapkan</label>
                    <textarea id="deliverables" name="deliverables" class="form-textarea" required
                              placeholder="Apa saja yang diharapkan sebagai hasil akhir proyek...">{{ old('deliverables', $isEdit ? $project->deliverables : '') }}</textarea>
                </div>

                <div class="form-group">
                    <label class="form-label">Lampiran File {{ $isEdit ? '' : '(Opsional)' }}</label>
                    
                    <!-- Existing Files - Only show in edit mode -->
                    @if($isEdit && $project->attachments && count($project->attachments) > 0)
                    <div class="existing-files">
                        <h5 style="margin-bottom: 0.5rem; color: #374151;">File yang sudah ada:</h5>
                        @foreach($project->attachments as $index => $attachment)
                        <div class="existing-file-item" id="attachment-{{ $index }}">
                            <span style="font-size: 0.875rem; color: #374151;">
                                <i class="fas fa-file"></i> {{ $attachment['original_name'] ?? 'File' }}
                                @if(isset($attachment['size']))
                                    ({{ number_format($attachment['size'] / 1024 / 1024, 2) }} MB)
                                @endif
                            </span>
                            <span class="file-remove-btn" onclick="removeExistingFile({{ $index }})">
                                <i class="fas fa-times"></i> Hapus
                            </span>
                        </div>
                        @endforeach
                    </div>
                    @endif
                    
                    <!-- Upload New Files -->
                    <div class="file-upload-area" onclick="document.getElementById('fileInput').click()">
                        <div class="file-upload-icon"><i class="fas fa-cloud-upload-alt"></i></div>
                        <div class="file-upload-text">Klik untuk upload file {{ $isEdit ? 'baru ' : '' }}atau drag & drop</div>
                        <div class="file-upload-hint">
                            <strong>Gambar:</strong> JPG, PNG, GIF, WEBP (Max 10MB)<br>
                            <strong>Video:</strong> MP4, MOV, AVI, WMV, FLV, WEBM (Max 50MB)<br>
                            <strong>Dokumen:</strong> PDF, DOC, DOCX (Max 10MB)
                        </div>
                    </div>
                    <input type="file" id="fileInput" class="file-input" name="attachments[]" multiple
                           accept=".pdf,.doc,.docx,.jpg,.jpeg,.png,.gif,.webp,.mp4,.mov,.avi,.wmv,.flv,.webm">
                    <div id="fileList" style="margin-top: 0.5rem;"></div>
                </div>
            </div>

            <!-- Section 3: Budget & Timeline -->
            <div class="form-section">
                <h3 class="section-title">Budget & Timeline</h3>
                
                <div class="form-group">
                    <label class="form-label required">Tipe Budget</label>
                    <div class="budget-options">
                        <div class="budget-option" data-budget="fixed" onclick="selectBudgetType('fixed')">
                            <h4>Budget Tetap</h4>
                            <p>Bayar sejumlah tetap untuk seluruh proyek</p>
                        </div>
                        <div class="budget-option" data-budget="range" onclick="selectBudgetType('range')">
                            <h4>Rentang Budget</h4>
                            <p>Tentukan budget minimum dan maksimum</p>
                        </div>
                    </div>
                    <input type="hidden" name="budget_type" id="budgetType" 
                           value="{{ old('budget_type', $isEdit ? $project->budget_type : '') }}">
                </div>

                <!-- Fixed Budget Details -->
                <div class="budget-details" id="fixedBudgetDetails">
                    <div class="form-group">
                        <label for="fixed_budget" class="form-label required">Budget Tetap (Rp)</label>
                        <input type="number" id="fixed_budget" name="fixed_budget" class="form-input" 
                               value="{{ old('fixed_budget', $isEdit ? $project->fixed_budget : '') }}"
                               placeholder="5000000" min="0">
                    </div>
                </div>

                <!-- Range Budget Details -->
                <div class="budget-details" id="rangeBudgetDetails">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="min_budget" class="form-label required">Budget Minimum (Rp)</label>
                            <input type="number" id="min_budget" name="min_budget" class="form-input" 
                                   value="{{ old('min_budget', $isEdit ? $project->min_budget : '') }}"
                                   placeholder="2000000" min="0">
                        </div>
                        <div class="form-group">
                            <label for="max_budget" class="form-label required">Budget Maksimum (Rp)</label>
                            <input type="number" id="max_budget" name="max_budget" class="form-input" 
                                   value="{{ old('max_budget', $isEdit ? $project->max_budget : '') }}"
                               placeholder="10000000" min="0">
                        </div>
                    </div>
                </div>

                <!-- Payment Method -->
                <div class="form-group">
                    <label class="form-label required">Metode Pembayaran</label>
                    <div class="payment-options">
                        <div class="payment-option">
                            <input type="radio" id="payment_full" name="payment_method" value="full" 
                                   {{ old('payment_method', $isEdit ? $project->payment_method : 'full') == 'full' ? 'checked' : '' }}>
                            <label for="payment_full">
                                <h4>Bayar Lunas</h4>
                                <p>Pembayaran 100% di awal</p>
                            </label>
                        </div>
                        <div class="payment-option">
                            <input type="radio" id="payment_dp" name="payment_method" value="dp_and_final" 
                                   {{ old('payment_method', $isEdit ? $project->payment_method : '') == 'dp_and_final' ? 'checked' : '' }}>
                            <label for="payment_dp">
                                <h4>DP + Pelunasan</h4>
                                <p>DP di awal, sisa di akhir</p>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- DP Percentage (shown when DP option selected) -->
                <div class="form-group" id="dpPercentageGroup" style="display: none;">
                    <label for="dp_percentage" class="form-label required">Persentase DP (%)</label>
                    <select id="dp_percentage" name="dp_percentage" class="form-select">
                        <option value="">Pilih Persentase DP</option>
                        <option value="30" {{ old('dp_percentage', $isEdit ? $project->dp_percentage : '') == '30' ? 'selected' : '' }}>30% - 70%</option>
                        <option value="40" {{ old('dp_percentage', $isEdit ? $project->dp_percentage : '') == '40' ? 'selected' : '' }}>40% - 60%</option>
                        <option value="50" {{ old('dp_percentage', $isEdit ? $project->dp_percentage : '') == '50' ? 'selected' : '' }}>50% - 50%</option>
                        <option value="60" {{ old('dp_percentage', $isEdit ? $project->dp_percentage : '') == '60' ? 'selected' : '' }}>60% - 40%</option>
                    </select>
                    <div class="help-text">DP akan dibayar di awal, sisanya setelah proyek selesai</div>
                </div>

                <div class="form-group">
                    <label for="timeline_type" class="form-label required">Jenis Timeline</label>
                    <select id="timeline_type" name="timeline_type" class="form-select" required>
                        <option value="weekly" {{ old('timeline_type', $isEdit ? $project->timeline_type : '') == 'weekly' ? 'selected' : '' }}>Mingguan</option>
                        <option value="daily" {{ old('timeline_type', $isEdit ? $project->timeline_type : '') == 'daily' ? 'selected' : '' }}>Harian</option>
                    </select>
                </div>

                <!-- Timeline Selection -->
                <div class="form-group">
                    <label for="timeline_duration" class="form-label required">Durasi Pengerjaan</label>
                    <select id="timeline_duration" name="timeline_duration" class="form-select" required>
                        <option value="">Pilih Durasi</option>
                        <option value="1" {{ old('timeline_duration', $isEdit ? $project->timeline_duration : '') == '1' ? 'selected' : '' }}>1 Minggu</option>
                        <option value="2" {{ old('timeline_duration', $isEdit ? $project->timeline_duration : '') == '2' ? 'selected' : '' }}>2 Minggu</option>
                        <option value="3" {{ old('timeline_duration', $isEdit ? $project->timeline_duration : '') == '3' ? 'selected' : '' }}>3 Minggu</option>
                        <option value="4" {{ old('timeline_duration', $isEdit ? $project->timeline_duration : '') == '4' ? 'selected' : '' }}>4 Minggu (1 Bulan)</option>
                        <option value="6" {{ old('timeline_duration', $isEdit ? $project->timeline_duration : '') == '6' ? 'selected' : '' }}>6 Minggu</option>
                        <option value="8" {{ old('timeline_duration', $isEdit ? $project->timeline_duration : '') == '8' ? 'selected' : '' }}>8 Minggu (2 Bulan)</option>
                        <option value="12" {{ old('timeline_duration', $isEdit ? $project->timeline_duration : '') == '12' ? 'selected' : '' }}>12 Minggu (3 Bulan)</option>
                        <option value="16" {{ old('timeline_duration', $isEdit ? $project->timeline_duration : '') == '16' ? 'selected' : '' }}>16 Minggu (4 Bulan)</option>
                        <option value="24" {{ old('timeline_duration', $isEdit ? $project->timeline_duration : '') == '24' ? 'selected' : '' }}>24 Minggu (6 Bulan)</option>
                    </select>
                </div>

                <!-- Auto-calculated Deadline -->
                <div class="form-group">
                    <label for="deadline" class="form-label required">Deadline Proyek</label>
                    <input type="date" id="deadline" name="deadline" class="form-input" 
                           value="{{ old('deadline', $isEdit && $project->deadline ? $project->deadline->format('Y-m-d') : '') }}"
                           readonly style="background-color: #f9fafb; cursor: not-allowed;">
                    <div class="help-text">Deadline otomatis dihitung berdasarkan durasi pengerjaan yang dipilih</div>
                </div>



                <div class="form-group">
                    <label for="additional_info" class="form-label">Informasi Tambahan</label>
                    <textarea id="additional_info" name="additional_info" class="form-textarea"
                              placeholder="Informasi tambahan yang perlu diketahui freelancer...">{{ old('additional_info', $isEdit ? $project->additional_info : '') }}</textarea>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="form-actions">
                @if($isEdit)
                    <a href="{{ route('projek') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                    @if($project->status === 'draft')
                    <button type="submit" name="action" value="publish" class="btn btn-primary">
                        <i class="fas fa-paper-plane"></i> Update & Publish
                    </button>
                    @endif
                    <button type="submit" name="action" value="update" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update Proyek
                    </button>
                @else

                    <button type="submit" name="action" value="publish" class="btn btn-primary">
                        <i class="fas fa-paper-plane"></i> Posting Lowongan
                    </button>
                @endif
            </div>
        </form>

        <!-- Delete Section - Only show in edit mode -->
        @if($isEdit)
        <div class="delete-section">
            <h3 class="section-title" style="color: #dc2626;">Zona Bahaya</h3>
            <div class="delete-warning">
                <strong>Peringatan!</strong> Tindakan ini tidak dapat dibatalkan. Menghapus proyek akan menghilangkan semua data termasuk proposal yang masuk.
            </div>
            <form method="POST" action="{{ route('projects.destroy', $project) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus proyek ini? Tindakan ini tidak dapat dibatalkan.')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    <i class="fas fa-trash"></i> Hapus Proyek
                </button>
            </form>
        </div>
        @endif
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Dynamic Subcategory Data
    const subcategoryData = {
        'pekerjaan-popular': [
            { value: 'website-development', text: 'Website Development' },
            { value: 'mobile-app-development', text: 'Mobile App Development' },
            { value: 'logo-design', text: 'Logo Design' },
            { value: 'video-editing', text: 'Video Editing' }
        ],
        'grafis-desain': [
            { value: 'logo-design', text: 'Logo Design' },
            { value: 'brand-identity', text: 'Brand Identity' },
            { value: 'packaging-design', text: 'Packaging Design' },
            { value: 'ilustrasi-gambar', text: 'Ilustrasi Gambar' },
            { value: 'stiker-design', text: 'Stiker Design' }
        ],
        'dokumen-ppt': [
            { value: 'document-creation', text: 'Pembuatan Dokumen' },
            { value: 'presentation-design', text: 'Desain Presentasi' },
            { value: 'data-entry', text: 'Entri Data' },
            { value: 'transcription', text: 'Transkripsi' }
        ], 
        'web-app': [
            { value: 'website-development', text: 'Website Development' },
            { value: 'mobile-app-development', text: 'Mobile App Development' },
            { value: 'ecommerce-development', text: 'E-commerce Development' },
            { value: 'web-maintenance', text: 'Web Maintenance' }
        ],
        'video-editing': [
            { value: 'video-editing', text: 'Video Editing' },
            { value: 'animation', text: 'Animasi' },
            { value: 'motion-graphics', text: 'Motion Graphics' },
            { value: 'video-production', text: 'Video Production' }
        ]
    };

    // Category change handler
    const categorySelect = document.getElementById('category');
    const subcategorySelect = document.getElementById('subcategory');

    categorySelect.addEventListener('change', function() {
        const selectedCategory = this.value;
        
        // Clear subcategory options
        subcategorySelect.innerHTML = '<option value="">Pilih Sub Kategori</option>';
        
        // Add new subcategory options based on selected category
        if (selectedCategory && subcategoryData[selectedCategory]) {
            subcategoryData[selectedCategory].forEach(function(subcategory) {
                const option = document.createElement('option');
                option.value = subcategory.value;
                option.textContent = subcategory.text;
                subcategorySelect.appendChild(option);
            });
        }
    });

    // Initialize subcategory if category is already selected (for old values or edit mode)
    if (categorySelect.value) {
        categorySelect.dispatchEvent(new Event('change'));
        // Set old/existing subcategory value if exists
        const existingSubcategory = '{{ old("subcategory", $isEdit ? $project->subcategory : "") }}';
        if (existingSubcategory) {
            setTimeout(() => {
                subcategorySelect.value = existingSubcategory;
            }, 100);
        }
    }

    // Skills Management
    const skillsContainer = document.getElementById('skillsContainer');
    const skillInput = document.getElementById('skillInput');
    const skillsRequired = document.getElementById('skillsRequired');
    let skills = [];

    // Load existing skills
    const existingSkills = skillsRequired.value;
    if (existingSkills) {
        skills = existingSkills.split(',').filter(skill => skill.trim());
        renderSkills();
    }

    skillInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            addSkill();
        }
    });

    function addSkill() {
        const skill = skillInput.value.trim();
        if (skill && !skills.includes(skill)) {
            skills.push(skill);
            skillInput.value = '';
            renderSkills();
            updateSkillsInput();
        }
    }

    function removeSkill(skillToRemove) {
        skills = skills.filter(skill => skill !== skillToRemove);
        renderSkills();
        updateSkillsInput();
    }

    function renderSkills() {
        const existingTags = skillsContainer.querySelectorAll('.skill-tag');
        existingTags.forEach(tag => tag.remove());

        skills.forEach(skill => {
            const tag = document.createElement('div');
            tag.className = 'skill-tag';
            tag.innerHTML = `
                ${skill}
                <span class="remove-tag" onclick="removeSkill('${skill}')">&times;</span>
            `;
            skillsContainer.insertBefore(tag, skillInput);
        });
    }

    function updateSkillsInput() {
        skillsRequired.value = skills.join(',');
    }

    window.removeSkill = removeSkill;

    // Character count for title
    const titleInput = document.getElementById('title');
    const titleCount = document.getElementById('titleCount');
    
    if (titleInput && titleCount) {
        titleInput.addEventListener('input', function() {
            titleCount.textContent = this.value.length;
        });
    }

    // Budget type selection
    window.selectBudgetType = function(type) {
        document.querySelectorAll('.budget-option').forEach(option => {
            option.classList.remove('selected');
        });
        
        document.querySelector(`[data-budget="${type}"]`).classList.add('selected');
        document.getElementById('budgetType').value = type;
        
        document.querySelectorAll('.budget-details').forEach(detail => {
            detail.style.display = 'none';
        });
        
        if (type === 'fixed') {
            document.getElementById('fixedBudgetDetails').style.display = 'block';
        } else if (type === 'range') {
            document.getElementById('rangeBudgetDetails').style.display = 'block';
        }
    };

    // Payment method selection
    const paymentRadios = document.querySelectorAll('input[name="payment_method"]');
    const dpPercentageGroup = document.getElementById('dpPercentageGroup');

    paymentRadios.forEach(radio => {
        radio.addEventListener('change', function() {
            if (this.value === 'dp_and_final') {
                dpPercentageGroup.style.display = 'block';
                document.getElementById('dp_percentage').required = true;
            } else {
                dpPercentageGroup.style.display = 'none';
                document.getElementById('dp_percentage').required = false;
                document.getElementById('dp_percentage').value = '';
            }

            // Update visual styling for payment options
            document.querySelectorAll('.payment-option').forEach(option => {
                option.classList.remove('selected');
            });
            this.closest('.payment-option').classList.add('selected');
        });
    });

    // Timeline duration and auto-calculate deadline
    const timelineDuration = document.getElementById('timeline_duration');
    const deadlineInput = document.getElementById('deadline');

    timelineDuration.addEventListener('change', function() {
        const weeks = parseInt(this.value);
        if (weeks) {
            const today = new Date();
            const deadline = new Date(today.getTime() + (weeks * 7 * 24 * 60 * 60 * 1000));
            
            // Format date to YYYY-MM-DD
            const year = deadline.getFullYear();
            const month = String(deadline.getMonth() + 1).padStart(2, '0');
            const day = String(deadline.getDate()).padStart(2, '0');
            
            deadlineInput.value = `${year}-${month}-${day}`;
        } else {
            deadlineInput.value = '';
        }
    });

    // Initialize all existing values
    // Payment method
    const selectedPaymentMethod = document.querySelector('input[name="payment_method"]:checked');
    if (selectedPaymentMethod) {
        selectedPaymentMethod.dispatchEvent(new Event('change'));
    }

    // Timeline
    if (timelineDuration.value) {
        timelineDuration.dispatchEvent(new Event('change'));
    }

    // Budget type
    const selectedBudgetType = document.getElementById('budgetType').value;
    if (selectedBudgetType) {
        selectBudgetType(selectedBudgetType);
    }

    // File upload handling
    const fileInput = document.getElementById('fileInput');
    const fileList = document.getElementById('fileList');

    if (fileInput) {
        fileInput.addEventListener('change', function() {
            displaySelectedFiles();
        });
    }

    function displaySelectedFiles() {
        const files = fileInput.files;
        let html = '';
        
        for (let i = 0; i < files.length; i++) {
            const file = files[i];
            const size = (file.size / 1024 / 1024).toFixed(2);
            const fileType = getFileType(file.type, file.name);
            const icon = getFileIcon(fileType, file.type);
            
            html += `
                <div class="file-item" style="display: flex; justify-content: space-between; align-items: center; padding: 0.75rem; background: #f8fafc; border-radius: 8px; margin-top: 0.5rem; border: 1px solid #e2e8f0;">
                    <div style="display: flex; align-items: center; gap: 0.75rem;">
                        <div style="width: 32px; height: 32px; background: ${getFileColor(fileType)}; border-radius: 6px; display: flex; align-items: center; justify-content: center; color: white;">
                            <i class="${icon}"></i>
                        </div>
                        <div>
                            <div style="font-size: 0.875rem; color: #374151; font-weight: 500;">
                                ${file.name}
                            </div>
                            <div style="font-size: 0.75rem; color: #6b7280;">
                                ${size} MB • ${fileType.toUpperCase()}
                            </div>
                        </div>
                    </div>
                    <div style="display: flex; align-items: center; gap: 0.5rem;">
                        ${fileType === 'image' ? `<div class="file-preview" style="width: 32px; height: 32px; border-radius: 4px; overflow: hidden; border: 1px solid #e5e7eb;"><img src="${URL.createObjectURL(file)}" style="width: 100%; height: 100%; object-fit: cover;"></div>` : ''}
                        <span class="file-status" style="color: #10b981; font-size: 0.75rem;">
                            <i class="fas fa-check-circle"></i> Ready
                        </span>
                    </div>
                </div>
            `;
        }
        
        if (fileList) {
            fileList.innerHTML = html;
        }
    }

    function getFileType(mimeType, fileName) {
        const imageTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp'];
        const videoTypes = ['video/mp4', 'video/mov', 'video/avi', 'video/wmv', 'video/flv', 'video/webm'];
        const documentTypes = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
        
        if (imageTypes.includes(mimeType)) return 'image';
        if (videoTypes.includes(mimeType)) return 'video';
        if (documentTypes.includes(mimeType)) return 'document';
        
        const ext = fileName.split('.').pop().toLowerCase();
        if (['jpg', 'jpeg', 'png', 'gif', 'webp'].includes(ext)) return 'image';
        if (['mp4', 'mov', 'avi', 'wmv', 'flv', 'webm'].includes(ext)) return 'video';
        if (['pdf', 'doc', 'docx'].includes(ext)) return 'document';
        
        return 'other';
    }

    function getFileIcon(fileType, mimeType) {
        switch (fileType) {
            case 'image': return 'fas fa-image';
            case 'video': return 'fas fa-video';
            case 'document':
                if (mimeType === 'application/pdf') return 'fas fa-file-pdf';
                if (mimeType.includes('word')) return 'fas fa-file-word';
                return 'fas fa-file-alt';
            default: return 'fas fa-file';
        }
    }

    function getFileColor(fileType) {
        switch (fileType) {
            case 'image': return '#10b981';
            case 'video': return '#ef4444';
            case 'document': return '#3b82f6';
            default: return '#6b7280';
        }
    }

    // Remove existing file (for edit mode)
    @if($isEdit)
    window.removeExistingFile = function(index) {
        if (confirm('Apakah Anda yakin ingin menghapus file ini?')) {
            document.getElementById('attachment-' + index).style.display = 'none';
            
            // Add hidden input to track removed files
            const hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = 'remove_attachments[]';
            hiddenInput.value = index;
            document.getElementById('{{ $isEdit ? 'editProjectForm' : 'postJobForm' }}').appendChild(hiddenInput);
        }
    };
    @endif

    // Show success modal if needed (for create mode)
    @if(!$isEdit && session('success') && session('action') === 'publish')
        // You can add success modal logic here if needed
        alert('{{ session('success') }}');
    @endif
});
</script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

@endsection