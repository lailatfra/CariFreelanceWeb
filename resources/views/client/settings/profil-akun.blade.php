@extends('client.layout.client-layout')
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
            width: 16rem; /* 256px */
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
        /* Button */
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
        
                /* Navigation Categories - Same styling from original */
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
    margin-top: -1.5rem !important; /* Tambahkan ini untuk menghilangkan gap atas */
    
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
            <div class="card" aria-label="Account information form">
                <header>
                    <h3>Informasi akun</h3>
                    <p>Atur informasi dasar akun Anda</p>
                </header>
                <div class="avatar-container">
                    <img src="https://placehold.co/96x96/8DA4F1/FFFFFF/png?text=User+Avatar" alt="User avatar">
                    <button aria-label="Edit avatar"><i class="fas fa-pen text-xs"></i></button>
                </div>
                <form novalidate>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <div class="username-box">
                            <input type="text" id="username" value="lk6obm9l">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class=".label" for="displayname">Nama yang digunakan untuk ditampilkan di sistem</label>
                        <p>Nama tersebut harus terdengar formal untuk membangun kredibilitas Anda</p>
                        <input class="input" type="text" id="displayname" value="lk6obm9l">
                    </div>
                    <div class="form-group">
                        <label class=".label">Tanggal lahir</label>
                        <div class="dob-select">
                            <select aria-label="Tanggal">
                                <option disabled selected>Tanggal</option>
                                @for($i=1; $i<=31; $i++)
                                    <option>{{ $i }}</option>
                                @endfor
                            </select>
                            <select aria-label="Bulan">
                                <option disabled selected>Bulan</option>
                                <option>Januari</option><option>Februari</option><option>Maret</option>
                                <option>April</option><option>Mei</option><option>Juni</option>
                                <option>Juli</option><option>Agustus</option><option>September</option>
                                <option>Oktober</option><option>November</option><option>Desember</option>
                            </select>
                            <select aria-label="Tahun">
                                <option disabled selected>Tahun</option>
                                @for($y=2024; $y>=2000; $y--)
                                    <option>{{ $y }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div style="text-align: right;">
                        <button type="submit" class="btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </section>
    </main>
</body>
</html>
@endsection
