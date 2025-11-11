@extends('client.layout.client-layout') 
@section('title', 'Edit Proyek - CariFreelance') 
@section('content') 

<style>
    .nav-container {
        background: #f8fafc;
        border-bottom: 1px solid #e2e8f0;
        padding: 0;
        margin-bottom: 2rem;
    }

    .nav {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 1rem;
    }

    .nav-list {
        display: flex;
        list-style: none;
        margin: 0;
        padding: 0;
        overflow-x: auto;
    }

    .nav-item {
        white-space: nowrap;
    }

    .nav-link {
        display: block;
        padding: 1rem 1.5rem;
        color: #64748b;
        text-decoration: none;
        border-bottom: 3px solid transparent;
        transition: all 0.3s ease;
    }

    .nav-link:hover {
        color: #3b82f6;
        border-bottom-color: #3b82f6;
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
        
        .form-actions {
            flex-direction: column;
        }
    }
</style>

<!-- Category Navigation -->
<div class="nav-container">
    <nav class="nav">
        <ul class="nav-list">
            <li class="nav-item"><a href="/popular" class="nav-link">Pekerjaan Populer</a></li>
            <li class="nav-item"><a href="/grafis" class="nav-link">Grafis & Desain</a></li>
            <li class="nav-item"><a href="/dokumen" class="nav-link">Dokumen & PPT</a></li>
            <li class="nav-item"><a href="#" class="nav-link">Web & App</a></li>
            <li class="nav-item"><a href="#" class="nav-link">Video Editing</a></li>
            <li class="nav-item"><a href="#" class="nav-link">Animasi & Motion Graphic</a></li>
            <li class="nav-item"><a href="#" class="nav-link">Data & Analisis</a></li>
        </ul>
    </nav>
</div>

<!-- Main Content -->
<div class="main-container">
    <!-- Breadcrumb -->
    <div class="breadcrumb">
        <a href="{{ route('projects.my') }}">Proyek Saya</a> / Edit Proyek
    </div>

    <!-- Page Header -->
    <div class="page-header">
        <h1 class="page-title">Edit Proyek</h1>
        <p class="page-subtitle">Perbarui informasi proyek Anda untuk mendapatkan freelancer terbaik</p>
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
        <form id="editProjectForm" method="POST" action="{{ route('projects.update', $project) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <!-- Section 1: Basic Information -->
            <div class="form-section">
                <h3 class="section-title">Informasi Dasar</h3>
                
                <div class="form-group">
                    <label for="title" class="form-label required">Judul Proyek</label>
                    <input type="text" id="title" name="title" class="form-input"
                           value="{{ old('title', $project->title) }}"
                           placeholder="Contoh: Dicari: Freelancer untuk Pembuatan Website E-Commerce" 
                           maxlength="100" required>
                    <div class="character-count">
                        <span id="titleCount">{{ strlen(old('title', $project->title)) }}</span>/100 karakter
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="category" class="form-label required">Kategori</label>
                        <select id="category" name="category" class="form-select" required>
                            <option value="">Pilih Kategori</option>
                            <option value="web-development" {{ old('category', $project->category) == 'web-development' ? 'selected' : '' }}>Web Development</option>
                            <option value="mobile-development" {{ old('category', $project->category) == 'mobile-development' ? 'selected' : '' }}>Mobile Development</option>
                            <option value="graphic-design" {{ old('category', $project->category) == 'graphic-design' ? 'selected' : '' }}>Grafis & Desain</option>
                            <option value="writing" {{ old('category', $project->category) == 'writing' ? 'selected' : '' }}>Penulisan & Penerjemahan</option>
                            <option value="marketing" {{ old('category', $project->category) == 'marketing' ? 'selected' : '' }}>Pemasaran & Periklanan</option>
                            <option value="business" {{ old('category', $project->category) == 'business' ? 'selected' : '' }}>Bisnis</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="subcategory" class="form-label">Sub Kategori</label>
                        <select id="subcategory" name="subcategory" class="form-select">
                            <option value="">Pilih Sub Kategori</option>
                            <option value="ecommerce" {{ old('subcategory', $project->subcategory) == 'ecommerce' ? 'selected' : '' }}>E-Commerce</option>
                            <option value="company-profile" {{ old('subcategory', $project->subcategory) == 'company-profile' ? 'selected' : '' }}>Company Profile</option>
                            <option value="blog" {{ old('subcategory', $project->subcategory) == 'blog' ? 'selected' : '' }}>Blog/Portal Berita</option>
                            <option value="landing-page" {{ old('subcategory', $project->subcategory) == 'landing-page' ? 'selected' : '' }}>Landing Page</option>
                            <option value="web-app" {{ old('subcategory', $project->subcategory) == 'web-app' ? 'selected' : '' }}>Web Application</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="experience_level" class="form-label required">Level Pengalaman</label>
                        <select id="experience_level" name="experience_level" class="form-select" required>
                            <option value="">Pilih Level</option>
                            <option value="entry" {{ old('experience_level', $project->experience_level) == 'entry' ? 'selected' : '' }}>Entry</option>
                            <option value="intermediate" {{ old('experience_level', $project->experience_level) == 'intermediate' ? 'selected' : '' }}>Intermediate</option>
                            <option value="expert" {{ old('experience_level', $project->experience_level) == 'expert' ? 'selected' : '' }}>Expert</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="project_type" class="form-label required">Jenis Proyek</label>
                        <select id="project_type" name="project_type" class="form-select" required>
                            <option value="">Pilih Jenis</option>
                            <option value="one-time" {{ old('project_type', $project->project_type) == 'one-time' ? 'selected' : '' }}>Sekali jalan</option>
                            <option value="ongoing" {{ old('project_type', $project->project_type) == 'ongoing' ? 'selected' : '' }}>Berkelanjutan</option>
                            <option value="contract" {{ old('project_type', $project->project_type) == 'contract' ? 'selected' : '' }}>Kontrak jangka panjang</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="skills" class="form-label required">Skills yang Dibutuhkan</label>
                    <div class="tags-container" id="skillsContainer">
                        <input type="text" class="tag-input" id="skillInput" placeholder="Ketik skill dan tekan Enter...">
                    </div>
                    <div class="help-text">Contoh: Laravel, PHP, JavaScript, MySQL, TailwindCSS</div>
                    <input type="hidden" name="skills_required" id="skillsRequired" value="{{ old('skills_required', is_array($project->skills_required) ? implode(',', $project->skills_required) : '') }}">
                </div>
            </div>

            <!-- Section 2: Project Details -->
            <div class="form-section">
                <h3 class="section-title">Detail Proyek</h3>
                
                <div class="form-group">
                    <label for="description" class="form-label required">Deskripsi Proyek</label>
                    <textarea id="description" name="description" class="form-textarea large" required 
                              placeholder="Jelaskan detail proyek Anda secara lengkap...">{{ old('description', $project->description) }}</textarea>
                </div>

                <div class="form-group">
                    <label for="requirements" class="form-label">Persyaratan Khusus</label>
                    <textarea id="requirements" name="requirements" class="form-textarea" 
                              placeholder="Persyaratan khusus atau kualifikasi yang dibutuhkan...">{{ old('requirements', $project->requirements) }}</textarea>
                </div>

                <div class="form-group">
                    <label for="deliverables" class="form-label required">Hasil yang Diharapkan</label>
                    <textarea id="deliverables" name="deliverables" class="form-textarea" required
                              placeholder="Apa saja yang diharapkan sebagai hasil akhir proyek...">{{ old('deliverables', $project->deliverables) }}</textarea>
                </div>

                <div class="form-group">
                    <label class="form-label">Lampiran File</label>
                    
                    <!-- Existing Files -->
                    @if($project->attachments && count($project->attachments) > 0)
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
                        <div class="file-upload-text">Klik untuk upload file baru atau drag & drop</div>
                        <div class="file-upload-hint">PDF, DOC, JPG, PNG - Max 10MB per file</div>
                    </div>
                    <input type="file" id="fileInput" class="file-input" name="attachments[]" multiple
                           accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
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
                        <div class="budget-option" data-budget="hourly" onclick="selectBudgetType('hourly')">
                            <h4>Tarif Per Jam</h4>
                            <p>Bayar berdasarkan waktu yang dihabiskan</p>
                        </div>
                        <div class="budget-option" data-budget="range" onclick="selectBudgetType('range')">
                            <h4>Rentang Budget</h4>
                            <p>Tentukan budget minimum dan maksimum</p>
                        </div>
                    </div>
                    <input type="hidden" name="budget_type" id="budgetType" value="{{ old('budget_type', $project->budget_type) }}">
                </div>

                <!-- Fixed Budget Details -->
                <div class="budget-details" id="fixedBudgetDetails">
                    <div class="form-group">
                        <label for="fixed_budget" class="form-label required">Budget Tetap (Rp)</label>
                        <input type="number" id="fixed_budget" name="fixed_budget" class="form-input" 
                               value="{{ old('fixed_budget', $project->fixed_budget) }}"
                               placeholder="5000000" min="0">
                    </div>
                </div>

                <!-- Range Budget Details -->
                <div class="budget-details" id="rangeBudgetDetails">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="min_budget" class="form-label required">Budget Minimum (Rp)</label>
                            <input type="number" id="min_budget" name="min_budget" class="form-input" 
                                   value="{{ old('min_budget', $project->min_budget) }}"
                                   placeholder="2000000" min="0">
                        </div>
                        <div class="form-group">
                            <label for="max_budget" class="form-label required">Budget Maksimum (Rp)</label>
                            <input type="number" id="max_budget" name="max_budget" class="form-input" 
                                   value="{{ old('max_budget', $project->max_budget) }}"
                                   placeholder="10000000" min="0">
                        </div>
                    </div>
                </div>

                <!-- Hourly Budget Details -->
                <div class="budget-details" id="hourlyBudgetDetails">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="hourly_rate" class="form-label required">Tarif Per Jam (Rp)</label>
                            <input type="number" id="hourly_rate" name="hourly_rate" class="form-input" 
                                   value="{{ old('hourly_rate', $project->hourly_rate) }}"
                                   placeholder="150000" min="0">
                        </div>
                        <div class="form-group">
                            <label for="estimated_hours" class="form-label">Estimasi Jam Kerja</label>
                            <input type="number" id="estimated_hours" name="estimated_hours" class="form-input" 
                                   value="{{ old('estimated_hours', $project->estimated_hours) }}"
                                   placeholder="40" min="0">
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="timeline" class="form-label required">Timeline Pengerjaan</label>
                        <select id="timeline" name="timeline" class="form-select" required>
                            <option value="">Pilih Timeline</option>
                            <option value="1-week" {{ old('timeline', $project->timeline) == '1-week' ? 'selected' : '' }}>Kurang dari 1 minggu</option>
                            <option value="1-2-weeks" {{ old('timeline', $project->timeline) == '1-2-weeks' ? 'selected' : '' }}>1-2 minggu</option>
                            <option value="2-4-weeks" {{ old('timeline', $project->timeline) == '2-4-weeks' ? 'selected' : '' }}>2-4 minggu</option>
                            <option value="1-2-months" {{ old('timeline', $project->timeline) == '1-2-months' ? 'selected' : '' }}>1-2 bulan</option>
                            <option value="2-3-months" {{ old('timeline', $project->timeline) == '2-3-months' ? 'selected' : '' }}>2-3 bulan</option>
                            <option value="3-months-plus" {{ old('timeline', $project->timeline) == '3-months-plus' ? 'selected' : '' }}>Lebih dari 3 bulan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="urgency" class="form-label">Tingkat Urgensi</label>
                        <select id="urgency" name="urgency" class="form-select">
                            <option value="normal" {{ old('urgency', $project->urgency) == 'normal' ? 'selected' : '' }}>Normal</option>
                            <option value="urgent" {{ old('urgency', $project->urgency) == 'urgent' ? 'selected' : '' }}>Segera</option>
                            <option value="asap" {{ old('urgency', $project->urgency) == 'asap' ? 'selected' : '' }}>Sangat Mendesak</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="deadline" class="form-label">Deadline Proyek</label>
                    <input type="date" id="deadline" name="deadline" class="form-input" 
                           value="{{ old('deadline', $project->deadline ? $project->deadline->format('Y-m-d') : '') }}"
                           min="{{ date('Y-m-d') }}">
                </div>

                <div class="form-group">
                    <label for="milestones" class="form-label">Milestone Pembayaran (Opsional)</label>
                    <textarea id="milestones" name="milestones" class="form-textarea"
                              placeholder="Jelaskan tahapan pembayaran jika ada...">{{ old('milestones', $project->milestones) }}</textarea>
                </div>

                <div class="form-group">
                    <label for="additional_info" class="form-label">Informasi Tambahan</label>
                    <textarea id="additional_info" name="additional_info" class="form-textarea"
                              placeholder="Informasi tambahan yang perlu diketahui freelancer...">{{ old('additional_info', $project->additional_info) }}</textarea>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="form-actions">
                <a href="{{ route('projects.my') }}" class="btn btn-secondary">
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
            </div>
        </form>

        <!-- Delete Section -->
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
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
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
        } else if (type === 'hourly') {
            document.getElementById('hourlyBudgetDetails').style.display = 'block';
        } else if (type === 'range') {
            document.getElementById('rangeBudgetDetails').style.display = 'block';
        }
    };

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
            html += `
                <div style="display: flex; justify-content: space-between; align-items: center; padding: 0.5rem; background: #f8fafc; border-radius: 6px; margin-top: 0.5rem;">
                    <span style="font-size: 0.875rem; color: #374151;">
                        <i class="fas fa-file"></i> ${file.name} (${size} MB)
                    </span>
                </div>
            `;
        }
        
        if (fileList) {
            fileList.innerHTML = html;
        }
    }

    // Remove existing file
    window.removeExistingFile = function(index) {
        if (confirm('Apakah Anda yakin ingin menghapus file ini?')) {
            document.getElementById('attachment-' + index).style.display = 'none';
            
            // Add hidden input to track removed files
            const hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = 'remove_attachments[]';
            hiddenInput.value = index;
            document.getElementById('editProjectForm').appendChild(hiddenInput);
        }
    };

    // Initialize budget type if already selected
    const selectedBudgetType = document.getElementById('budgetType').value;
    if (selectedBudgetType) {
        selectBudgetType(selectedBudgetType);
    }
});
</script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

@endsection