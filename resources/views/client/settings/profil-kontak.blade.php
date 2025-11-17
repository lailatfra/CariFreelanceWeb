@extends('client.layout.client-layout')
@section('title', 'Contact Information - CariFreelance')
@section('content')
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Contact Information - CariFreelance</title>
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
            <li><a href="{{ route('profile-akun') }}" ><i class="fas fa-user text-xs"></i><span>Informasi Akun</span></a></li>
            <li><a href="{{ route('profile-kontak') }}" class="active-link"><i class="fas fa-id-card-alt text-xs"></i><span>Informasi Kontak</span></a></li>
            <li><a href="{{ route('manage-akun') }}"><i class="fas fa-lock text-xs"></i><span>Manajemen Akun</span></a></li>
        </ul>
    </section>
    <section>
        <br><h2>Rating</h2>
        <ul>
            <li><a href="{{ route('rating') }}"><i class="fas fa-star text-xs"></i><span>Rating Freelancer</span></a></li>
        </ul>
    </section>
</aside>

    <section class="flex-1">
        <!-- Success/Error Messages -->
        <div id="messageContainer"></div>

        <!-- Company Information -->
        <article>
            <div class="section-toggle" onclick="toggleSection('companyInfo')">
                <header>
                    <h3>Informasi Perusahaan</h3>
                    <p>Bagikan detail tentang bisnis dan industri Anda untuk membantu freelancer memahami kebutuhan Anda.</p>
                </header>
                <i class="fas fa-chevron-down toggle-icon" id="companyInfoIcon"></i>
            </div>
            <div class="section-content hidden" id="companyInfo">
                <form id="companyInfoForm">
                    @csrf
                    <div class="form-group">
                        <label for="company_name" class="label">Nama Perusahaan</label>
                        <input type="text" id="company_name" name="company_name" class="form-control" placeholder="Masukkan nama perusahaan">
                    </div>

                    <div class="form-group">
                        <label for="industry" class="label">Industri</label>
                        <input type="text" id="industry" name="industry" class="form-control" placeholder="Contoh: Teknologi, Retail, Pendidikan">
                    </div>

                    <div class="form-group">
                        <label for="company_size" class="label">Ukuran Perusahaan</label>
                        <select id="company_size" name="company_size" class="form-control">
                            <option value="">Pilih ukuran perusahaan</option>
                            <option value="1-10">1-10 karyawan</option>
                            <option value="11-50">11-50 karyawan</option>
                            <option value="51-200">51-200 karyawan</option>
                            <option value="201-500">201-500 karyawan</option>
                            <option value="500+">500+ karyawan</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="company_description" class="label">Deskripsi Perusahaan</label>
                        <textarea id="company_description" name="company_description" class="form-control" placeholder="Ceritakan tentang perusahaan Anda, produk/layanan yang ditawarkan, dan nilai unik yang dimiliki"></textarea>
                        <div class="char-counter">
                            <span id="companyDescCount">0</span>/1000 karakter
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="website" class="label">Website Perusahaan</label>
                        <input type="url" id="website" name="website" class="form-control" placeholder="https://example.com">
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-primary">Simpan Informasi Perusahaan</button>
                    </div>
                </form>
            </div>
        </article>

        <!-- Vision & Mission -->
        <article>
            <div class="section-toggle" onclick="toggleSection('visionMission')">
                <header>
                    <h3>Visi & Misi Perusahaan</h3>
                    <p>Bagikan visi dan misi perusahaan untuk menunjukkan nilai dan tujuan bisnis Anda.</p>
                </header>
                <i class="fas fa-chevron-down toggle-icon" id="visionMissionIcon"></i>
            </div>
            <div class="section-content hidden" id="visionMission">
                <form id="visionMissionForm">
                    @csrf
                    <div class="form-group">
                        <label for="company_vision" class="label">Visi Perusahaan</label>
                        <textarea id="company_vision" name="company_vision" class="form-control" placeholder="Apa visi jangka panjang perusahaan Anda?"></textarea>
                        <div class="char-counter">
                            <span id="visionCount">0</span>/500 karakter
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="company_mission" class="label">Misi Perusahaan</label>
                        <textarea id="company_mission" name="company_mission" class="form-control" placeholder="Apa misi dan tujuan utama perusahaan Anda?"></textarea>
                        <div class="char-counter">
                            <span id="missionCount">0</span>/500 karakter
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="company_values" class="label">Nilai-nilai Perusahaan</label>
                        <textarea id="company_values" name="company_values" class="form-control" placeholder="Nilai-nilai apa yang dianut perusahaan Anda?"></textarea>
                        <div class="char-counter">
                            <span id="valuesCount">0</span>/500 karakter
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="company_goals" class="label">Tujuan Perusahaan</label>
                        <textarea id="company_goals" name="company_goals" class="form-control" placeholder="Apa tujuan spesifik yang ingin dicapai perusahaan?"></textarea>
                        <div class="char-counter">
                            <span id="goalsCount">0</span>/500 karakter
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-primary">Simpan Visi & Misi</button>
                    </div>
                </form>
            </div>
        </article>

        <!-- Communication Preferences -->
        <article>
            <div class="section-toggle" onclick="toggleSection('communication')">
                <header>
                    <h3>Preferensi Komunikasi</h3>
                    <p>Beri tahu freelancer tentang gaya komunikasi dan ketersediaan waktu yang Anda sukai.</p>
                </header>
                <i class="fas fa-chevron-down toggle-icon" id="communicationIcon"></i>
            </div>
            <div class="section-content hidden" id="communication">
                <form id="communicationForm">
                    @csrf
                    <div class="form-group">
                        <label class="label">Platform Komunikasi yang Disukai</label>
                        <div class="checkbox-group">
                            <label class="checkbox-label">
                                <input type="checkbox" name="communication_platforms[]" value="whatsapp"> WhatsApp
                            </label>
                            <label class="checkbox-label">
                                <input type="checkbox" name="communication_platforms[]" value="email"> Email
                            </label>
                            <label class="checkbox-label">
                                <input type="checkbox" name="communication_platforms[]" value="telegram"> Telegram
                            </label>
                            <label class="checkbox-label">
                                <input type="checkbox" name="communication_platforms[]" value="zoom"> Zoom
                            </label>
                            <label class="checkbox-label">
                                <input type="checkbox" name="communication_platforms[]" value="google_meet"> Google Meet
                            </label>
                            <label class="checkbox-label">
                                <input type="checkbox" name="communication_platforms[]" value="slack"> Slack
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="update_frequency" class="label">Frekuensi Update yang Diinginkan</label>
                        <select id="update_frequency" name="update_frequency" class="form-control">
                            <option value="">Pilih frekuensi update</option>
                            <option value="daily">Harian</option>
                            <option value="weekly">Mingguan</option>
                            <option value="biweekly">Dua kali seminggu</option>
                            <option value="monthly">Bulanan</option>
                            <option value="as_needed">Sesuai kebutuhan</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="timezone" class="label">Zona Waktu</label>
                        <select id="timezone" name="timezone" class="form-control">
                            <option value="">Pilih zona waktu</option>
                            <option value="WIB">WIB (UTC+7)</option>
                            <option value="WITA">WITA (UTC+8)</option>
                            <option value="WIT">WIT (UTC+9)</option>
                            <option value="other">Lainnya</option>
                        </select>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-primary">Simpan Preferensi</button>
                    </div>
                </form>
            </div>
        </article>

        <!-- Social Media -->
        <article>
            <div class="section-toggle" onclick="toggleSection('socialMedia')">
                <header>
                    <h3>Media Sosial</h3>
                    <p>Tautkan akun media sosial perusahaan untuk meningkatkan kredibilitas dan transparansi.</p>
                </header>
                <i class="fas fa-chevron-down toggle-icon" id="socialMediaIcon"></i>
            </div>
            <div class="section-content hidden" id="socialMedia">
                <form id="socialMediaForm">
                    @csrf
                    <div class="social-media-grid">
                        <div class="form-group">
                            <label for="social_website" class="label">Website</label>
                            <input type="url" id="social_website" name="social_website" class="form-control" placeholder="https://website-perusahaan.com">
                        </div>

                        <div class="form-group">
                            <label for="social_linkedin" class="label">LinkedIn</label>
                            <input type="url" id="social_linkedin" name="social_linkedin" class="form-control" placeholder="https://linkedin.com/company/...">
                        </div>

                        <div class="form-group">
                            <label for="social_instagram" class="label">Instagram</label>
                            <input type="url" id="social_instagram" name="social_instagram" class="form-control" placeholder="https://instagram.com/...">
                        </div>

                        <div class="form-group">
                            <label for="social_facebook" class="label">Facebook</label>
                            <input type="url" id="social_facebook" name="social_facebook" class="form-control" placeholder="https://facebook.com/...">
                        </div>

                        <div class="form-group">
                            <label for="social_twitter" class="label">Twitter</label>
                            <input type="url" id="social_twitter" name="social_twitter" class="form-control" placeholder="https://twitter.com/...">
                        </div>

                        <div class="form-group">
                            <label for="social_youtube" class="label">YouTube</label>
                            <input type="url" id="social_youtube" name="social_youtube" class="form-control" placeholder="https://youtube.com/...">
                        </div>

                        <div class="form-group">
                            <label for="social_tiktok" class="label">TikTok</label>
                            <input type="url" id="social_tiktok" name="social_tiktok" class="form-control" placeholder="https://tiktok.com/...">
                        </div>

                        <div class="form-group">
                            <label for="social_other" class="label">Media Sosial Lainnya</label>
                            <input type="text" id="social_other" name="social_other" class="form-control" placeholder="Platform lain yang digunakan">
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-primary">Simpan Media Sosial</button>
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
            } else {
                counter.classList.remove('limit');
            }
        });
    }

    // Initialize character counters
    document.addEventListener('DOMContentLoaded', function() {
        setupCharacterCounter('company_description', 'companyDescCount', 1000);
        setupCharacterCounter('company_vision', 'visionCount', 500);
        setupCharacterCounter('company_mission', 'missionCount', 500);
        setupCharacterCounter('company_values', 'valuesCount', 500);
        setupCharacterCounter('company_goals', 'goalsCount', 500);

        // Load existing data
        loadClientInfo();
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

    // Load client additional info
    async function loadClientInfo() {
        try {
            const response = await fetch('{{ route("client.additional-info.get") }}');
            const result = await response.json();
            
            if (result.success && result.data) {
                const data = result.data;
                
                // Company Information
                if (data.company_name) document.getElementById('company_name').value = data.company_name;
                if (data.industry) document.getElementById('industry').value = data.industry;
                if (data.company_size) document.getElementById('company_size').value = data.company_size;
                if (data.company_description) document.getElementById('company_description').value = data.company_description;
                if (data.website) document.getElementById('website').value = data.website;
                
                // Vision & Mission
                if (data.company_vision) document.getElementById('company_vision').value = data.company_vision;
                if (data.company_mission) document.getElementById('company_mission').value = data.company_mission;
                if (data.company_values) document.getElementById('company_values').value = data.company_values;
                if (data.company_goals) document.getElementById('company_goals').value = data.company_goals;
                
                // Communication Preferences
                if (data.communication_platforms) {
                    const platforms = JSON.parse(data.communication_platforms);
                    platforms.forEach(platform => {
                        const checkbox = document.querySelector(`input[name="communication_platforms[]"][value="${platform}"]`);
                        if (checkbox) checkbox.checked = true;
                    });
                }
                if (data.update_frequency) document.getElementById('update_frequency').value = data.update_frequency;
                if (data.timezone) document.getElementById('timezone').value = data.timezone;
                
                // Social Media
                if (data.social_website) document.getElementById('social_website').value = data.social_website;
                if (data.social_linkedin) document.getElementById('social_linkedin').value = data.social_linkedin;
                if (data.social_instagram) document.getElementById('social_instagram').value = data.social_instagram;
                if (data.social_facebook) document.getElementById('social_facebook').value = data.social_facebook;
                if (data.social_twitter) document.getElementById('social_twitter').value = data.social_twitter;
                if (data.social_youtube) document.getElementById('social_youtube').value = data.social_youtube;
                if (data.social_tiktok) document.getElementById('social_tiktok').value = data.social_tiktok;
                if (data.social_other) document.getElementById('social_other').value = data.social_other;
            }
        } catch (error) {
            console.error('Error loading client info:', error);
        }
    }

    // Form submissions
    document.getElementById('companyInfoForm').addEventListener('submit', async function(e) {
        e.preventDefault();
        await submitForm(this, '{{ route("client.additional-info.company") }}', 'Informasi perusahaan berhasil disimpan!');
    });

    document.getElementById('visionMissionForm').addEventListener('submit', async function(e) {
        e.preventDefault();
        await submitForm(this, '{{ route("client.additional-info.vision-mission") }}', 'Visi & Misi berhasil disimpan!');
    });

    document.getElementById('communicationForm').addEventListener('submit', async function(e) {
        e.preventDefault();
        await submitForm(this, '{{ route("client.additional-info.communication") }}', 'Preferensi komunikasi berhasil disimpan!');
    });

    document.getElementById('socialMediaForm').addEventListener('submit', async function(e) {
        e.preventDefault();
        await submitForm(this, '{{ route("client.additional-info.social-media") }}', 'Media sosial berhasil disimpan!');
    });

    // Generic form submission function
    async function submitForm(form, url, successMessage) {
        const formData = new FormData(form);
        const submitButton = form.querySelector('button[type="submit"]');
        const originalText = submitButton.textContent;
        
        try {
            submitButton.textContent = 'Menyimpan...';
            submitButton.disabled = true;
            
            const response = await fetch(url, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });
            
            const result = await response.json();
            
            if (result.success) {
                showMessage(successMessage, 'success');
            } else {
                showMessage(result.message, 'error');
            }
        } catch (error) {
            showMessage('Terjadi kesalahan. Silakan coba lagi.', 'error');
            console.error('Error:', error);
        } finally {
            submitButton.textContent = originalText;
            submitButton.disabled = false;
        }
    }
</script>
</body>
</html>
@endsection