@extends('client.layout.client-layout')
@section('title', 'CariFreelance Account Info - CariFreelance')
@section('content')

<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
        .input[type="text"], select {
            border: 1px solid #CBD5E1;
            background-color: white;
            border-radius: 0.375rem;
            padding: 0.5rem 0.75rem;
            font-size: 0.875rem;
            color: #1E293B;
            width: 100%;
            outline: none;
        }
        .input[type="text"]:focus, select:focus {
            border-color: #2563EB;
            box-shadow: 0 0 0 2px #2563EB33;
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
        .dob-select {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
        }
        .dob-select select {
            width: 8rem;
        }
        .dob-select select:nth-child(2) {
            width: 10rem;
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
        
        .alert {
            padding: 1rem;
            margin-bottom: 1rem;
            border-radius: 0.375rem;
            font-size: 0.875rem;
        }
        .alert-success {
            background-color: #D1FAE5;
            color: #065F46;
            border: 1px solid #A7F3D0;
        }
        .alert-error {
            background-color: #FEE2E2;
            color: #991B1B;
            border: 1px solid #FECACA;
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
                    <li><a href="{{ route('profile-akun') }}" class="active-link"><i class="fas fa-user text-xs"></i><span>Informasi Akun</span></a></li>
                    <li><a href="{{ route('profile-kontak') }}"><i class="fas fa-id-card-alt text-xs"></i><span>Informasi Kontak</span></a></li>
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

        <!-- Content -->
        <section class="flex-1">
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            @if(session('error'))
            <div class="alert alert-error">
                {{ session('error') }}
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

            <div class="card" aria-label="Account information form">
                <header>
                    <h3>Informasi akun</h3>
                    <p>Atur informasi dasar akun Anda</p>
                </header>

                <!-- Avatar Upload Form -->
                <form action="{{ route('profile-akun.avatar') }}" method="POST" enctype="multipart/form-data" id="avatarForm">
                    @csrf
                    <div class="avatar-container">
                        <img src="{{ $clientProfile && $clientProfile->profile_photo 
                            ? asset('storage/' . $clientProfile->profile_photo) 
                            : 'https://placehold.co/96x96/8DA4F1/FFFFFF/png?text=' . strtoupper(substr($user->name ?? 'U', 0, 1)) }}" 
                            alt="User avatar" id="avatarPreview">
                        <button type="button" aria-label="Edit avatar" onclick="document.getElementById('avatarInput').click()">
                            <i class="fas fa-pen text-xs"></i>
                        </button>
                        <input type="file" id="avatarInput" name="avatar" accept="image/*" style="display: none;">
                    </div>
                </form>

                <!-- Account Info Form -->
                <form action="{{ route('profile-akun.update') }}" method="POST">
                    @csrf
                    
                    <div class="form-group">
                        <label for="username" class="label">Username</label>
                        <div class="username-box">
                            <input type="text" id="username" name="username" value="{{ old('username', $user->username ?? '') }}" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="label" for="displayname">Nama yang digunakan untuk ditampilkan di sistem</label>
                        <p style="margin-bottom: 0.5rem;">Nama tersebut harus terdengar formal untuk membangun kredibilitas Anda</p>
                        <input class="input" type="text" id="displayname" name="display_name" value="{{ old('display_name', $user->name ?? '') }}" required>
                    </div>

                    <div class="form-group">
                        <label class="label">Tanggal lahir</label>
                        @php
                            $birthDate = $user->birth_date ? \Carbon\Carbon::parse($user->birth_date) : null;
                        @endphp
                        <div class="dob-select">
                            <select aria-label="Tanggal" name="birth_date">
                                <option value="" disabled {{ !$birthDate ? 'selected' : '' }}>Tanggal</option>
                                @for($i=1; $i<=31; $i++)
                                    <option value="{{ $i }}" {{ $birthDate && $birthDate->day == $i ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>
                            <select aria-label="Bulan" name="birth_month">
                                <option value="" disabled {{ !$birthDate ? 'selected' : '' }}>Bulan</option>
                                @php
                                    $months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                                @endphp
                                @foreach($months as $index => $month)
                                    <option value="{{ $index + 1 }}" {{ $birthDate && $birthDate->month == ($index + 1) ? 'selected' : '' }}>{{ $month }}</option>
                                @endforeach
                            </select>
                            <select aria-label="Tahun" name="birth_year">
                                <option value="" disabled {{ !$birthDate ? 'selected' : '' }}>Tahun</option>
                                @for($y=date('Y'); $y>=1900; $y--)
                                    <option value="{{ $y }}" {{ $birthDate && $birthDate->year == $y ? 'selected' : '' }}>{{ $y }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="label" for="company_name">Nama Perusahaan</label>
                        <input class="input" type="text" id="company_name" name="company_name" value="{{ old('company_name', $clientProfile->company_name ?? $additionalInfo->company_name ?? '') }}">
                    </div>

                    <div class="form-group">
                        <label class="label" for="industry">Industri</label>
                        <input class="input" type="text" id="industry" name="industry" value="{{ old('industry', $additionalInfo->industry ?? '') }}" placeholder="e.g., Technology, Fashion, Finance">
                    </div>

                    <div class="form-group">
                        <label class="label" for="company_size">Ukuran Perusahaan</label>
                        <select id="company_size" name="company_size">
                            <option value="" disabled {{ !($additionalInfo->company_size ?? null) ? 'selected' : '' }}>Pilih ukuran perusahaan</option>
                            <option value="1-10" {{ ($additionalInfo->company_size ?? '') == '1-10' ? 'selected' : '' }}>1-10 karyawan</option>
                            <option value="11-50" {{ ($additionalInfo->company_size ?? '') == '11-50' ? 'selected' : '' }}>11-50 karyawan</option>
                            <option value="51-200" {{ ($additionalInfo->company_size ?? '') == '51-200' ? 'selected' : '' }}>51-200 karyawan</option>
                            <option value="201-500" {{ ($additionalInfo->company_size ?? '') == '201-500' ? 'selected' : '' }}>201-500 karyawan</option>
                            <option value="500+" {{ ($additionalInfo->company_size ?? '') == '500+' ? 'selected' : '' }}>500+ karyawan</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="label" for="phone">Nomor Telepon</label>
                        <input class="input" type="text" id="phone" name="phone" value="{{ old('phone', $clientProfile->phone ?? '') }}" placeholder="+62 812 3456 7890">
                    </div>

                    <div class="form-group">
                        <label class="label" for="location">Lokasi</label>
                        <input class="input" type="text" id="location" name="location" value="{{ old('location', $clientProfile->location ?? '') }}" placeholder="Jakarta, Indonesia">
                    </div>

                    <div class="form-group">
                        <label class="label" for="website">Website Perusahaan</label>
                        <input class="input" type="text" id="website" name="website" value="{{ old('website', $additionalInfo->website ?? '') }}" placeholder="https://example.com">
                    </div>

                    <div class="form-group">
                        <label class="label" for="bio">Bio / Deskripsi Singkat</label>
                        <textarea class="input" id="bio" name="bio" rows="4" style="resize: vertical;" placeholder="Ceritakan sedikit tentang perusahaan Anda...">{{ old('bio', $clientProfile->bio ?? '') }}</textarea>
                    </div>

                    <div style="text-align: right;">
                        <button type="submit" class="btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </section>
    </main>

    <script>
        // Auto-submit avatar form when file is selected
        document.getElementById('avatarInput').addEventListener('change', function(e) {
            if (this.files && this.files[0]) {
                // Preview image
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('avatarPreview').src = e.target.result;
                };
                reader.readAsDataURL(this.files[0]);
                
                // Submit form
                document.getElementById('avatarForm').submit();
            }
        });

        // Auto-hide alerts after 5 seconds
        setTimeout(function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                alert.style.transition = 'opacity 0.5s';
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 500);
            });
        }, 5000);
    </script>
</body>
</html>
@endsection