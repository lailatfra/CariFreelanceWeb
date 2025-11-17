@extends('freelancer.layout.freelancer-layout')
@section('title', 'CariFreelance Account Info - CariFreelance')
@section('content')

<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>CariFreelance Account Info - CariFreelance</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: "Inter", sans-serif;
            background-color: #F5F7FA;
            min-height: 100vh;
            color: #1E293B;
            margin: 0;
        }
        main {
            display: flex;
            max-width: 100%; 
            margin: 1rem auto 0 auto;
            padding: 0 1.5rem;
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
            margin-left: 2rem;
        }
        .card {
            border: 1px solid #E2E8F0;
            background: white;
            border-radius: 0.5rem;
            padding: 1.5rem;
            font-size: 0.875rem;
            color: #475569;
            margin-bottom: 1.5rem;
        }
        .card header {
            margin-bottom: 1.5rem;
            border-bottom: 1px solid #E2E8F0;
            padding-bottom: 0.75rem;
        }
        .card h3 {
            font-weight: 600;
            color: #0F172A;
            font-size: 1rem;
            user-select: none;
        }
        .card p {
            font-size: 0.75rem;
            color: #94A3B8;
            margin-top: 0.25rem;
            user-select: none;
        }
        
        .avatar-container {
            display: flex;
            justify-content: center;
            margin-bottom: 1.5rem;
            position: relative;
        }
        .avatar-container img {
            border-radius: 50%;
            width: 96px;
            height: 96px;
            object-fit: cover;
        }
        .avatar-container button {
            position: absolute;
            bottom: 0;
            right: 0;
            margin-bottom: -0.25rem;
            margin-right: -0.25rem;
            border-radius: 50%;
            background-color: #2563EB;
            padding: 0.5rem;
            color: white;
            border: none;
            cursor: pointer;
        }
        .avatar-container button:hover {
            background-color: #1D4ED8;
        }
        
        form .form-group {
            margin-bottom: 1.5rem;
        }
        .label {
            margin-bottom: 0.25rem;
            display: block;
            font-weight: 600;
            color: #1E293B;
            user-select: none;
        }
        .input[type="text"],
        .input[type="number"],
        .input[type="url"],
        .input[type="file"],
        textarea,
        select {
            border: 1px solid #CBD5E1;
            background-color: white;
            border-radius: 0.375rem;
            padding: 0.5rem 0.75rem;
            font-size: 0.875rem;
            color: #1E293B;
            width: 100%;
            outline: none;
            box-sizing: border-box;
        }
        .input[type="text"]:focus,
        .input[type="number"]:focus,
        .input[type="url"]:focus,
        textarea:focus,
        select:focus {
            border-color: #2563EB;
            box-shadow: 0 0 0 2px #2563EB33;
        }
        textarea {
            min-height: 100px;
            resize: vertical;
        }
        .username-box {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            border: 1px solid #CBD5E1;
            background-color: #F8FAFC;
            padding: 0.5rem 0.75rem;
            font-size: 0.875rem;
            color: #94A3B8;
            border-radius: 0.375rem;
        }
        .username-box input {
            margin-left: 0.25rem;
            min-width: 4rem;
            flex: 1;
            background: transparent;
            border: none;
            padding: 0;
            outline: none;
            color: #1E293B;
        }
        .btn-primary {
            background-color: #2563EB;
            color: white;
            font-weight: 600;
            font-size: 0.875rem;
            padding: 0.5rem 1.25rem;
            border-radius: 0.375rem;
            border: none;
            cursor: pointer;
        }
        .btn-primary:hover {
            background-color: #1D4ED8;
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
        .alert {
            padding: 1rem;
            border-radius: 0.375rem;
            margin-bottom: 1rem;
        }
        .alert-success {
            background-color: #D1FAE5;
            color: #065F46;
            border: 1px solid #10B981;
        }
        .alert-error {
            background-color: #FEE2E2;
            color: #991B1B;
            border: 1px solid #EF4444;
        }
        .grid-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }
        @media (max-width: 768px) {
            .grid-2 {
                grid-template-columns: 1fr;
            }
            main {
                flex-direction: column;
            }
            aside {
                width: 100%;
                margin-bottom: 1rem;
            }
            section.flex-1 {
                margin-left: 0;
            }
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
                    <li><a href="{{ route('freelancer-profile-akun') }}" class="active-link"><i class="fas fa-user text-xs"></i><span>Informasi Akun</span></a></li>
                    <li><a href="{{ route('freelancer-profile-kontak') }}"><i class="fas fa-id-card-alt text-xs"></i><span>Informasi Kontak</span></a></li>
                    <li><a href="{{ route('freelancer-manage-akun') }}"><i class="fas fa-lock text-xs"></i><span>Manajemen Akun</span></a></li>
                </ul>
            </section>
        </aside>

        <!-- Content -->
        <section class="flex-1">
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            @if($errors->any())
            <div class="alert alert-error">
                <ul style="margin: 0; padding-left: 1.25rem;">
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <!-- Form Tunggal untuk Semua Data -->
            <form action="{{ route('freelancer.profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Informasi Dasar -->
                <div class="card">
                    <header>
                        <h3>Informasi Dasar</h3>
                        <p>Atur informasi dasar akun Anda</p>
                    </header>
                    
                    <div class="avatar-container">
                        <img src="{{ $freelancerProfile->profile_photo ? asset('storage/' . $freelancerProfile->profile_photo) : 'https://placehold.co/96x96/8DA4F1/FFFFFF/png?text=' . strtoupper(substr($freelancerProfile->full_name, 0, 1)) }}" 
                             alt="User avatar" id="preview-avatar">
                        <button type="button" onclick="document.getElementById('profile_photo').click()" aria-label="Edit avatar">
                            <i class="fas fa-pen text-xs"></i>
                        </button>
                    </div>
                    <input type="file" id="profile_photo" name="profile_photo" style="display: none;" accept="image/*">

                    <div class="form-group">
                        <label class="label" for="username">Username</label>
                        <div class="username-box">
                            <span>@</span>
                            <input type="text" id="username" name="username" value="{{ old('username', $freelancerProfile->username) }}" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="label" for="full_name">Nama Lengkap</label>
                        <input class="input" type="text" id="full_name" name="full_name" value="{{ old('full_name', $freelancerProfile->full_name) }}" required>
                    </div>

                    <div class="form-group">
                        <label class="label" for="headline">Headline</label>
                        <p style="font-size: 0.75rem; color: #94A3B8; margin-top: 0.25rem;">Deskripsi singkat tentang keahlian Anda</p>
                        <input class="input" type="text" id="headline" name="headline" value="{{ old('headline', $freelancerProfile->headline) }}" placeholder="Contoh: Web Developer | Graphic Designer">
                    </div>

                    <div class="form-group">
                        <label class="label" for="location">Lokasi</label>
                        <input class="input" type="text" id="location" name="location" value="{{ old('location', $freelancerProfile->location) }}">
                    </div>
                </div>

                <!-- Keahlian & Pengalaman -->
                <div class="card">
                    <header>
                        <h3>Keahlian & Pengalaman</h3>
                        <p>Informasi tentang skill dan pengalaman kerja Anda</p>
                    </header>

                    <div class="form-group">
                        <label class="label" for="subskills">Sub-keahlian</label>
                        <textarea id="subskills" name="subskills" placeholder="Detail keahlian, contoh: Laravel, React, Vue.js, UI/UX Design">{{ old('subskills', $freelancerProfile->subskills) }}</textarea>
                    </div>

                    <div class="form-group">
                        <label class="label" for="experience_years">Tahun Pengalaman</label>
                        <input class="input" type="number" id="experience_years" name="experience_years" value="{{ old('experience_years', $freelancerProfile->experience_years) }}" min="0" max="50">
                    </div>
                </div>

                <!-- Bio -->
                <div class="card">
                    <header>
                        <h3>Bio & Profil Profesional</h3>
                        <p>Ceritakan tentang diri Anda kepada calon klien</p>
                    </header>

                    <div class="form-group">
                        <label class="label" for="bio">Bio</label>
                        <textarea id="bio" name="bio" rows="6" maxlength="1000" placeholder="Ceritakan tentang pengalaman, keahlian, dan apa yang membuat Anda berbeda...">{{ old('bio', $freelancerProfile->bio) }}</textarea>
                        <small style="color: #94A3B8;"><span id="bioCount">{{ strlen($freelancerProfile->bio ?? '') }}</span>/1000 karakter</small>
                    </div>
                </div>

                <!-- Kontak & Portofolio -->
                <div class="card">
                    <header>
                        <h3>Kontak & Portofolio</h3>
                        <p>Informasi kontak dan link portfolio Anda</p>
                    </header>

                    <div class="form-group">
                        <label class="label" for="phone">Nomor Telepon</label>
                        <input class="input" type="text" id="phone" name="phone" value="{{ old('phone', $freelancerProfile->phone) }}" placeholder="08xxxxxxxxxx">
                    </div>

                    <div class="form-group">
                        <label class="label" for="portofolio_link">Link Portfolio</label>
                        <input class="input" type="url" id="portofolio_link" name="portofolio_link" value="{{ old('portofolio_link', $freelancerProfile->portofolio_link) }}" placeholder="https://portfolio.com">
                    </div>
                </div>

                <!-- Tombol Simpan -->
                <div style="text-align: right;">
                    <button type="submit" class="btn-primary">
                        <i class="fas fa-save" style="margin-right: 0.5rem;"></i>
                        Simpan Semua Perubahan
                    </button>
                </div><br>
            </form>
        </section>
    </main>

    <script>
        // Preview avatar
        document.getElementById('profile_photo').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('preview-avatar').src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        });

        // Bio character counter
        const bioTextarea = document.getElementById('bio');
        const bioCount = document.getElementById('bioCount');
        
        bioTextarea.addEventListener('input', function() {
            bioCount.textContent = this.value.length;
        });
    </script>
</body>
</html>
@endsection