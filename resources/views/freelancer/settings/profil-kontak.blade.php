@extends('freelancer.layout.freelancer-layout')
@section('title', 'Additional Information - CariFreelance')
@section('content')
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Additional Information - CariFreelance</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet"/>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f5f8fd;
            min-height: 100vh;
            color: #1e293b;
            margin: 0;
        }
        main {
            display: flex;
            max-width: 100%;
            margin: 1rem auto 0;
            padding: 0 1rem;
            gap: 2rem;
        }
        aside {
            width: 16rem; 
            flex-shrink: 0;
            font-size: 0.875rem;
            color: #475569;
        }
        aside h2 {
            margin-bottom: 0.75rem;
            font-weight: 600;
            color: #0F172A;
            font-size: 1rem;
            user-select: none;
        }
        aside ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        aside li a {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            border-radius: 0.375rem 0 0 0.375rem;
            padding: 0.5rem 1rem;
            text-decoration: none;
            color: inherit;
            transition: background 0.2s, color 0.2s;
        }
        aside li a:hover {
            background-color: #EFF6FF;
            color: #2563EB;
        }
        
        .active-link {
            border-right: 4px solid #3B82F6;
            background-color: #EFF6FF;
            color: #2563EB;
        }
        section.flex-1 {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }
        article {
            background: white;
            border-radius: 0.5rem;
            border: 1px solid #e2e8f0;
            padding: 1.5rem;
            box-shadow: 0 1px 2px rgba(0,0,0,0.05);
        }
        article header {
            margin-bottom: 1rem;
            border-bottom: 1px solid #e2e8f0;
            padding-bottom: 0.75rem;
        }
        article h3 {
            font-weight: 600;
            font-size: 0.875rem;
        }
        article p {
            font-size: 0.75rem;
            color: #64748b;
            margin-top: 0.25rem;
        }
        form {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }
        .label {
            display: block;
            font-size: 0.75rem;
            font-weight: 600;
            color: #475569;
            margin-bottom: 0.25rem;
        }

        .form-input {
            width: 100%;
            border-radius: 0.375rem;
            border: 1px solid #cbd5e1;
            padding: 0.6rem 0.9rem;
            font-size: 0.875rem;
            outline: none;
            background-color: white;
            color: #1e293b;
            transition: all 0.2s ease;
        }

        .form-input[readonly] {
            background-color: #f8fafc;
            color: #64748b;
            cursor: not-allowed;
        }

        .form-input:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 2px rgba(37, 99, 235, 0.3);
        }

        button {
            border: none;
            border-radius: 0.375rem;
            cursor: pointer;
        }
        .btn-link {
            color: #2563eb;
            font-weight: 600;
            font-size: 0.875rem;
            background: none;
            padding: 0;
        }
        .btn-link:hover {
            text-decoration: underline;
        }
        .btn-primary {
            background-color: #2563eb;
            color: white;
            font-size: 0.875rem;
            font-weight: 600;
            padding: 0.5rem 1rem;
        }
        .btn-primary:hover {
            background-color: #1d4ed8;
        }
        fieldset {
            border: none;
            padding: 0;
            margin: 0;
        }
        fieldset legend {
            font-size: 0.75rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }
        .radio-group {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }
        @media (min-width: 640px) {
            .radio-group {
                flex-direction: row;
            }
        }
        .radio-label {
            display: flex;
            align-items: center;
            flex: 1;
            border-radius: 0.375rem;
            padding: 0.5rem 0.75rem;
            font-size: 0.875rem;
            cursor: pointer;
            border: 1px solid #cbd5e1;
            background-color: white;
        }
        .radio-label input {
            margin-right: 0.5rem;
        }
        .radio-label.active {
            border-color: #2563eb;
            color: #2563eb;
            font-weight: 600;
        }
        .grid-2 {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1rem;
        }
        @media (min-width: 640px) {
            .grid-2 {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        .text-muted {
            font-size: 0.625rem;
            color: #94a3b8;
            margin-bottom: 0.25rem;
        }
        .form-actions {
            display: flex;
            justify-content: flex-end;
        }
        
        .nav-container {
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            position: sticky;
            top: -1px;
            z-index: 100;
            width: 100vw;
            margin: 0 !important;
            margin-left: -1.5rem !important;
            margin-right: -1.5rem !important;
            margin-top: -1.5rem !important;
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

        /* New styles for additional information sections */
        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-control {
            width: 100%;
            border-radius: 0.375rem;
            border: 1px solid #cbd5e1;
            padding: 0.6rem 0.9rem;
            font-size: 0.875rem;
            outline: none;
            background-color: white;
            color: #1e293b;
            transition: all 0.2s ease;
        }

        .form-control:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 2px rgba(37, 99, 235, 0.3);
        }

        textarea.form-control {
            resize: vertical;
            min-height: 100px;
        }

        .checkbox-group {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            margin-top: 0.5rem;
        }

        .checkbox-label {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.875rem;
            cursor: pointer;
        }

        .social-media-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1rem;
        }

        @media (min-width: 768px) {
            .social-media-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        .char-counter {
            font-size: 0.75rem;
            color: #64748b;
            margin-top: 0.25rem;
        }

        .char-counter.limit {
            color: #ef4444;
        }

        .success-message {
            background-color: #d1fae5;
            border: 1px solid #a7f3d0;
            color: #065f46;
            padding: 0.75rem;
            border-radius: 0.375rem;
            margin-bottom: 1rem;
            font-size: 0.875rem;
        }

        .error-message {
            background-color: #fee2e2;
            border: 1px solid #fecaca;
            color: #dc2626;
            padding: 0.75rem;
            border-radius: 0.375rem;
            margin-bottom: 1rem;
            font-size: 0.875rem;
        }

        .section-toggle {
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
        }

        .section-content {
            margin-top: 1rem;
        }

        .hidden {
            display: none;
        }

        .toggle-icon {
            transition: transform 0.3s ease;
        }

        .toggle-icon.rotated {
            transform: rotate(180deg);
        }

        /* Skills tags */
        .skills-container {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin-top: 0.5rem;
        }

        .skill-tag {
            background: #eff6ff;
            color: #2563eb;
            padding: 0.25rem 0.75rem;
            border-radius: 1rem;
            font-size: 0.75rem;
            border: 1px solid #dbeafe;
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }

        .skill-tag .remove {
            cursor: pointer;
            color: #64748b;
            font-size: 0.875rem;
        }

        .skill-tag .remove:hover {
            color: #ef4444;
        }

        /* Portfolio items */
        .portfolio-item {
            border: 1px solid #e2e8f0;
            border-radius: 0.5rem;
            padding: 1rem;
            margin-bottom: 1rem;
            background: #f8fafc;
        }

        .portfolio-item:last-child {
            margin-bottom: 0;
        }

        .portfolio-header {
            display: flex;
            justify-content: between;
            align-items: center;
            margin-bottom: 0.5rem;
        }

        .portfolio-title {
            font-weight: 600;
            font-size: 0.875rem;
            color: #1e293b;
        }

        .portfolio-category {
            background: #e0e7ff;
            color: #3730a3;
            padding: 0.25rem 0.5rem;
            border-radius: 0.25rem;
            font-size: 0.75rem;
        }

        .portfolio-description {
            font-size: 0.875rem;
            color: #64748b;
            margin-bottom: 0.5rem;
        }

        .portfolio-tech {
            font-size: 0.75rem;
            color: #475569;
        }

        .portfolio-link {
            color: #2563eb;
            font-size: 0.75rem;
            text-decoration: none;
        }

        .portfolio-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
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

    <main style="margin-top: 40px;">

    <!-- Sidebar -->
    <aside>
        <section class="mb-8">
            <h2>Akun Anda</h2>
                <ul>
                    <li><a href="{{ route('freelancer-profile-akun') }}"><i class="fas fa-user text-xs"></i><span>Informasi Akun</span></a></li>
                    <li><a href="{{ route('freelancer-profile-kontak') }}" class="active-link"><i class="fas fa-id-card-alt text-xs"></i><span>Informasi Kontak</span></a></li>
                    <li><a href="{{ route('freelancer-manage-akun') }}"><i class="fas fa-lock text-xs"></i><span>Manajemen Akun</span></a></li>
                </ul>
        </section>
    </aside>

    <section class="flex-1">
        <!-- Success/Error Messages -->
        <div id="messageContainer"></div>

        <!-- Bio & Experience -->
        <article>
            <div class="section-toggle" onclick="toggleSection('bioSection')">
                <header>
                    <h3>Tulis bio yang menarik</h3>
                    <p>Buat deskripsi detail tentang pengalaman dan keahlian Anda.</p>
                </header>
                <i class="fas fa-chevron-down toggle-icon" id="bioSectionIcon"></i>
            </div>
            <div class="section-content hidden" id="bioSection">
                <form id="bioForm">
                    @csrf
                    <div class="form-group">
                        <label for="bio" class="label">Bio/Deskripsi Diri</label>
                        <textarea id="bio" name="bio" class="form-control" placeholder="Ceritakan tentang diri Anda, pengalaman, dan keahlian yang Anda miliki..."></textarea>
                        <div class="char-counter">
                            <span id="bioCount">0</span>/1000 karakter
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="experience" class="label">Pengalaman Kerja</label>
                        <textarea id="experience" name="experience" class="form-control" placeholder="Jelaskan pengalaman kerja relevan Anda..."></textarea>
                        <div class="char-counter">
                            <span id="experienceCount">0</span>/500 karakter
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="headline" class="label">Headline/Tagline</label>
                        <input type="text" id="headline" name="headline" class="form-control" placeholder="Contoh: Full Stack Developer | UI/UX Designer">
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-primary">Simpan Bio & Pengalaman</button>
                    </div>
                </form>
            </div>
        </article>

        <!-- Skills -->
        <article>
            <div class="section-toggle" onclick="toggleSection('skillsSection')">
                <header>
                    <h3>Daftarkan keahlian Anda</h3>
                    <p>Tambahkan keahlian dan teknologi yang Anda kuasai.</p>
                </header>
                <i class="fas fa-chevron-down toggle-icon" id="skillsSectionIcon"></i>
            </div>
            <div class="section-content hidden" id="skillsSection">
                <form id="skillsForm">
                    @csrf
                    <div class="form-group">
                        <label class="label">Pilih Keahlian Utama</label>
                        <div class="checkbox-group">
                            <label class="checkbox-label">
                                <input type="checkbox" name="skills[]" value="Web Development"> Web Development
                            </label>
                            <label class="checkbox-label">
                                <input type="checkbox" name="skills[]" value="Mobile Development"> Mobile Development
                            </label>
                            <label class="checkbox-label">
                                <input type="checkbox" name="skills[]" value="UI/UX Design"> UI/UX Design
                            </label>
                            <label class="checkbox-label">
                                <input type="checkbox" name="skills[]" value="Graphic Design"> Graphic Design
                            </label>
                            <label class="checkbox-label">
                                <input type="checkbox" name="skills[]" value="Data Entry"> Data Entry
                            </label>
                            <label class="checkbox-label">
                                <input type="checkbox" name="skills[]" value="Content Writing"> Content Writing
                            </label>
                            <label class="checkbox-label">
                                <input type="checkbox" name="skills[]" value="Digital Marketing"> Digital Marketing
                            </label>
                            <label class="checkbox-label">
                                <input type="checkbox" name="skills[]" value="SEO"> SEO
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="customSkills" class="label">Keahlian Lainnya</label>
                        <input type="text" id="customSkills" class="form-control" placeholder="Pisahkan dengan koma, contoh: Python, JavaScript, Photoshop">
                        <div class="skills-container" id="customSkillsDisplay"></div>
                    </div>

                    <div class="form-group">
                        <label for="experienceLevel" class="label">Level Pengalaman</label>
                        <select id="experienceLevel" name="experience_level" class="form-control">
                            <option value="">Pilih level pengalaman</option>
                            <option value="beginner">Pemula (0-1 tahun)</option>
                            <option value="intermediate">Menengah (2-4 tahun)</option>
                            <option value="expert">Ahli (5+ tahun)</option>
                        </select>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-primary">Simpan Keahlian</button>
                    </div>
                </form>
            </div>
        </article>

        <!-- Portfolio -->
        <article>
            <div class="section-toggle" onclick="toggleSection('portfolioSection')">
                <header>
                    <h3>Unggah sampel portofolio</h3>
                    <p>Tampilkan karya terbaik Anda untuk mendemonstrasikan kemampuan.</p>
                </header>
                <i class="fas fa-chevron-down toggle-icon" id="portfolioSectionIcon"></i>
            </div>
            <div class="section-content hidden" id="portfolioSection">
                <form id="portfolioForm">
                    @csrf
                    <div class="form-group">
                        <label for="portfolio_title" class="label">Judul Portfolio</label>
                        <input type="text" id="portfolio_title" name="portfolio_title" class="form-control" placeholder="Contoh: Website E-commerce untuk Toko Fashion">
                    </div>

                    <div class="form-group">
                        <label for="portfolio_description" class="label">Deskripsi Proyek</label>
                        <textarea id="portfolio_description" name="portfolio_description" class="form-control" placeholder="Jelaskan proyek yang telah Anda kerjakan, teknologi yang digunakan, dan hasil yang dicapai..."></textarea>
                        <div class="char-counter">
                            <span id="portfolioDescCount">0</span>/500 karakter
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="portofolio_link" class="label">Link Portfolio/Demo</label>
                        <input type="url" id="portofolio_link" name="portofolio_link" class="form-control" placeholder="https://portfolio-anda.com atau https://github.com/username/project">
                    </div>

                    <div class="form-group">
                        <label for="portfolio_category" class="label">Kategori</label>
                        <select id="portfolio_category" name="portfolio_category" class="form-control">
                            <option value="">Pilih kategori</option>
                            <option value="web-development">Web Development</option>
                            <option value="mobile-app">Mobile App</option>
                            <option value="ui-ux-design">UI/UX Design</option>
                            <option value="graphic-design">Graphic Design</option>
                            <option value="content-writing">Content Writing</option>
                            <option value="digital-marketing">Digital Marketing</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="portfolio_tech" class="label">Teknologi/Tools yang Digunakan</label>
                        <input type="text" id="portfolio_tech" name="portfolio_tech" class="form-control" placeholder="Contoh: React, Node.js, MongoDB, Figma">
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-primary">Simpan Portfolio</button>
                    </div>
                </form>
            </div>
        </article>

        <!-- Education & Certifications -->
        <article>
            <div class="section-toggle" onclick="toggleSection('educationSection')">
                <header>
                    <h3>Tambahkan sertifikat & pendidikan</h3>
                    <p>Sertakan sertifikat yang relevan dan latar belakang pendidikan.</p>
                </header>
                <i class="fas fa-chevron-down toggle-icon" id="educationSectionIcon"></i>
            </div>
            <div class="section-content hidden" id="educationSection">
                <form id="educationForm">
                    @csrf
                    <div class="form-group">
                        <label for="education" class="label">Pendidikan Terakhir</label>
                        <input type="text" id="education" name="education" class="form-control" placeholder="Contoh: S1 Teknik Informatika - Universitas Indonesia">
                    </div>

                    <div class="form-group">
                        <label for="graduation_year" class="label">Tahun Lulus</label>
                        <input type="number" id="graduation_year" name="graduation_year" class="form-control" placeholder="2020" min="1990" max="2030">
                    </div>

                    <div class="form-group">
                        <label for="certifications" class="label">Sertifikat yang Dimiliki</label>
                        <textarea id="certifications" name="certifications" class="form-control" placeholder="Daftarkan sertifikat relevan yang Anda miliki, seperti sertifikat online course, sertifikat profesi, dll..."></textarea>
                        <div class="char-counter">
                            <span id="certificationsCount">0</span>/500 karakter
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="courses" class="label">Kursus Online</label>
                        <textarea id="courses" name="courses" class="form-control" placeholder="Sebutkan kursus online yang pernah Anda ikuti (Udemy, Coursera, dll.)"></textarea>
                        <div class="char-counter">
                            <span id="coursesCount">0</span>/500 karakter
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="label">Bahasa yang Dikuasai</label>
                        <div class="checkbox-group">
                            <label class="checkbox-label">
                                <input type="checkbox" name="languages[]" value="Bahasa Indonesia"> Bahasa Indonesia
                            </label>
                            <label class="checkbox-label">
                                <input type="checkbox" name="languages[]" value="English"> English
                            </label>
                            <label class="checkbox-label">
                                <input type="checkbox" name="languages[]" value="Mandarin"> Mandarin
                            </label>
                            <label class="checkbox-label">
                                <input type="checkbox" name="languages[]" value="Japanese"> Japanese
                            </label>
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-primary">Simpan Pendidikan & Sertifikat</button>
                    </div>
                </form>
            </div>
        </article>

        
    </section>
</main>

<script>
    // Toggle section visibility
    function toggleSection(sectionId) {
        const section = document.getElementById(sectionId);
        const icon = document.getElementById(sectionId + 'Icon');
        
        section.classList.toggle('hidden');
        icon.classList.toggle('rotated');
    }

    // Character counters
    function setupCharacterCounter(textareaId, counterId, maxLength) {
        const textarea = document.getElementById(textareaId);
        const counter = document.getElementById(counterId);
        
        textarea.addEventListener('input', function() {
            const count = this.value.length;
            counter.textContent = count;
            
            if (count > maxLength) {
                counter.classList.add('limit');
                this.style.borderColor = '#ef4444';
            } else {
                counter.classList.remove('limit');
                this.style.borderColor = '#cbd5e1';
            }
        });
    }

    // Custom skills management
    let customSkills = [];
    
    function addCustomSkill() {
        const input = document.getElementById('customSkills');
        const skill = input.value.trim();
        
        if (skill && !customSkills.includes(skill)) {
            customSkills.push(skill);
            updateCustomSkillsDisplay();
            input.value = '';
        }
    }
    
    function removeCustomSkill(skill) {
        customSkills = customSkills.filter(s => s !== skill);
        updateCustomSkillsDisplay();
    }
    
    function updateCustomSkillsDisplay() {
        const container = document.getElementById('customSkillsDisplay');
        container.innerHTML = customSkills.map(skill => `
            <div class="skill-tag">
                ${skill}
                <span class="remove" onclick="removeCustomSkill('${skill}')">&times;</span>
            </div>
        `).join('');
    }

    // Initialize character counters
    document.addEventListener('DOMContentLoaded', function() {
        setupCharacterCounter('bio', 'bioCount', 1000);
        setupCharacterCounter('experience', 'experienceCount', 500);
        setupCharacterCounter('portfolio_description', 'portfolioDescCount', 500);
        setupCharacterCounter('certifications', 'certificationsCount', 500);
        setupCharacterCounter('courses', 'coursesCount', 500);

        // Load existing data
        loadFreelancerInfo();

        // Custom skills input handler
        document.getElementById('customSkills').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                addCustomSkill();
            }
        });
    });

    // Show message
    function showMessage(message, type = 'success') {
        const messageContainer = document.getElementById('messageContainer');
        messageContainer.innerHTML = `
            <div class="${type === 'success' ? 'success-message' : 'error-message'}">
                ${message}
            </div>
        `;
        
        setTimeout(() => {
            messageContainer.innerHTML = '';
        }, 5000);
    }

    // Load freelancer additional info
    async function loadFreelancerInfo() {
        try {
            console.log('Loading freelancer info...');
            
            // Coba dengan URL langsung dulu untuk testing
            const response = await fetch('/freelancer/additional-info', {
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });
            
            console.log('Response status:', response.status);
            
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            
            const result = await response.json();
            console.log('API Response:', result);
            
            if (result.success && result.data) {
                const data = result.data;
                console.log('Profile data to process:', data);
                
                // Bio & Experience
                if (data.bio) {
                    document.getElementById('bio').value = data.bio;
                    document.getElementById('bioCount').textContent = data.bio.length;
                }
                if (data.experience) {
                    document.getElementById('experience').value = data.experience;
                    document.getElementById('experienceCount').textContent = data.experience.length;
                }
                if (data.headline) document.getElementById('headline').value = data.headline;
                
                // Skills
                if (data.skills) {
                    const skills = data.skills.split(',');
                    skills.forEach(skill => {
                        const trimmedSkill = skill.trim();
                        const checkbox = document.querySelector(`input[name="skills[]"][value="${trimmedSkill}"]`);
                        if (checkbox) {
                            checkbox.checked = true;
                        } else if (trimmedSkill && !customSkills.includes(trimmedSkill)) {
                            customSkills.push(trimmedSkill);
                        }
                    });
                    updateCustomSkillsDisplay();
                }
                if (data.experience_level) {
                    document.getElementById('experienceLevel').value = data.experience_level;
                }
                
                // Portfolio
                if (data.portfolio_title) document.getElementById('portfolio_title').value = data.portfolio_title;
                if (data.portfolio_description) {
                    document.getElementById('portfolio_description').value = data.portfolio_description;
                    document.getElementById('portfolioDescCount').textContent = data.portfolio_description.length;
                }
                if (data.portofolio_link) document.getElementById('portofolio_link').value = data.portofolio_link;
                if (data.portfolio_category) document.getElementById('portfolio_category').value = data.portfolio_category;
                if (data.portfolio_tech) document.getElementById('portfolio_tech').value = data.portfolio_tech;
                
                // Education & Certifications
                if (data.education) document.getElementById('education').value = data.education;
                if (data.graduation_year) document.getElementById('graduation_year').value = data.graduation_year;
                if (data.certifications) {
                    document.getElementById('certifications').value = data.certifications;
                    document.getElementById('certificationsCount').textContent = data.certifications.length;
                }
                if (data.courses) {
                    document.getElementById('courses').value = data.courses;
                    document.getElementById('coursesCount').textContent = data.courses.length;
                }
                
                // Languages
                if (data.languages) {
                    let languagesArray;
                    if (Array.isArray(data.languages)) {
                        languagesArray = data.languages;
                    } else {
                        try {
                            languagesArray = JSON.parse(data.languages);
                        } catch (e) {
                            languagesArray = data.languages.split(',');
                        }
                    }
                    
                    if (Array.isArray(languagesArray)) {
                        languagesArray.forEach(lang => {
                            const checkbox = document.querySelector(`input[name="languages[]"][value="${lang}"]`);
                            if (checkbox) checkbox.checked = true;
                        });
                    }
                }
                
                // Rate & Availability
                if (data.hourly_rate) document.getElementById('hourly_rate').value = data.hourly_rate;
                if (data.project_rate) document.getElementById('project_rate').value = data.project_rate;
                if (data.availability) document.getElementById('availability').value = data.availability;
                if (data.response_time) document.getElementById('response_time').value = data.response_time;
                
                // Service Types
                if (data.service_types) {
                    let serviceTypesArray;
                    if (Array.isArray(data.service_types)) {
                        serviceTypesArray = data.service_types;
                    } else {
                        try {
                            serviceTypesArray = JSON.parse(data.service_types);
                        } catch (e) {
                            serviceTypesArray = data.service_types.split(',');
                        }
                    }
                    
                    if (Array.isArray(serviceTypesArray)) {
                        serviceTypesArray.forEach(type => {
                            const checkbox = document.querySelector(`input[name="service_types[]"][value="${type}"]`);
                            if (checkbox) checkbox.checked = true;
                        });
                    }
                }
                
                console.log('Data loaded successfully');
                showMessage('Data profil berhasil dimuat', 'success');
            } else {
                console.log('No data found or success false');
                showMessage('Belum ada data profil. Silakan isi form di bawah.', 'info');
            }
        } catch (error) {
            console.error('Error loading freelancer info:', error);
            showMessage('Gagal memuat data profil: ' + error.message, 'error');
        }
    }

    // Form submissions
    document.getElementById('bioForm').addEventListener('submit', async function(e) {
        e.preventDefault();
        await submitForm(this, '/freelancer/additional-info/bio', 'Bio berhasil disimpan!');
    });

    document.getElementById('skillsForm').addEventListener('submit', async function(e) {
        e.preventDefault();
        
        // Combine checkbox skills with custom skills
        const formData = new FormData(this);
        customSkills.forEach(skill => {
            formData.append('skills[]', skill);
        });
        formData.append('custom_skills', customSkills.join(','));
        
        await submitFormWithData(formData, '/freelancer/additional-info/skills', 'Keahlian berhasil disimpan!');
    });

    document.getElementById('portfolioForm').addEventListener('submit', async function(e) {
        e.preventDefault();
        await submitForm(this, '/freelancer/additional-info/portfolio', 'Portfolio berhasil disimpan!');
    });

    document.getElementById('educationForm').addEventListener('submit', async function(e) {
        e.preventDefault();
        await submitForm(this, '/freelancer/additional-info/education', 'Pendidikan & sertifikat berhasil disimpan!');
    });

    document.getElementById('rateForm').addEventListener('submit', async function(e) {
        e.preventDefault();
        await submitForm(this, '/freelancer/additional-info/rate', 'Tarif berhasil disimpan!');
    });

    // Generic form submission function
    async function submitForm(form, url, successMessage) {
        const formData = new FormData(form);
        await submitFormWithData(formData, url, successMessage);
    }

    async function submitFormWithData(formData, url, successMessage) {
        const submitButton = document.querySelector(`form button[type="submit"]`);
        const originalText = submitButton.textContent;
        
        try {
            submitButton.textContent = 'Menyimpan...';
            submitButton.disabled = true;
            
            console.log('Submitting to:', url);
            const response = await fetch(url, {
                method: 'POST',
                body: formData,
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });
            
            console.log('Submit response status:', response.status);
            
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            
            const result = await response.json();
            console.log('Submit result:', result);
            
            if (result.success) {
                showMessage(successMessage, 'success');
                // Reload data setelah berhasil simpan
                setTimeout(() => loadFreelancerInfo(), 1000);
            } else {
                showMessage(result.message || 'Gagal menyimpan data', 'error');
            }
        } catch (error) {
            console.error('Submit error:', error);
            showMessage('Terjadi kesalahan. Silakan coba lagi.', 'error');
        } finally {
            submitButton.textContent = originalText;
            submitButton.disabled = false;
        }
    }
</script>
</body>
</html>
@endsection