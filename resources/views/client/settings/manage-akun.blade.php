@extends('client.layout.client-layout')
@section('title', 'Manajemen Akun - CariFreelance')
@section('content')

<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>Manajemen Akun - CariFreelance</title>
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
            margin-bottom: 2rem;
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

        form .form-group {
            margin-bottom: 1.5rem;
        }

        label {
            margin-bottom: 0.25rem;
            display: block;
            font-weight: 600;
            color: #1E293B;
            user-select: none;
        }

        input[type="password"] {
            border: 1px solid #CBD5E1;
            background-color: white;
            border-radius: 0.375rem;
            padding: 0.5rem 0.75rem;
            font-size: 0.875rem;
            color: #1E293B;
            width: 100%;
            outline: none;
        }

        input[type="password"]:focus {
            border-color: #2563EB;
            box-shadow: 0 0 0 2px #2563EB33;
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

        .btn-danger {
            background-color: #DC2626;
            color: white;
            font-weight: 600;
            font-size: 0.875rem;
            padding: 0.5rem 1.25rem;
            border-radius: 0.375rem;
            border: none;
            cursor: pointer;
        }

        .btn-danger:hover {
            background-color: #B91C1C;
        }

        .nav-container {
            background: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: -1px;
            z-index: 100;
            width: 100vw;

            margin: 0 !important;
            margin-left: -1.5rem !important;
            margin-right: -1.5rem !important;
            margin-top: -1.5rem !important;
            /* Tambahkan ini untuk menghilangkan gap atas */

            padding: 0;
            transition: all 0.3s ease;
        }

        .nav-container.scrolled {
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
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

        .nav-item:hover,
        .nav-item.active {
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
                    <li><a href="{{ route('profile-akun') }}"><i class="fas fa-user text-xs"></i><span>Informasi Akun</span></a></li>
                    <li><a href="{{ route('profile-kontak') }}"><i class="fas fa-id-card-alt text-xs"></i><span>Informasi Kontak</span></a></li>
                    <li><a href="{{ route('manage-akun') }}" class="active-link"><i class="fas fa-lock text-xs"></i><span>Manajemen Akun</span></a></li>
                </ul>
            </section>
            <section>
                <br>
                <h2>Rating</h2>
                <ul>
                    <li><a href="{{ route('rating') }}"><i class="fas fa-star text-xs"></i><span>Rating Freelancer</span></a></li>
                </ul>
            </section>
        </aside>

        <!-- Content -->
        <section class="flex-1">
            <!-- Ubah Password -->
            <!-- <div class="card">
                <header>
                    <h3>Ubah Password</h3>
                    <p>Pastikan menggunakan password yang kuat dan unik</p>
                </header>
                <form>
                    <div class="form-group">
                        <label for="current_password">Password Lama</label>
                        <input type="password" id="current_password" placeholder="Masukkan password lama">
                    </div>
                    <div class="form-group">
                        <label for="new_password">Password Baru</label>
                        <input type="password" id="new_password" placeholder="Masukkan password baru">
                    </div>
                    <div class="form-group">
                        <label for="confirm_password">Konfirmasi Password Baru</label>
                        <input type="password" id="confirm_password" placeholder="Ulangi password baru">
                    </div>
                    <div style="text-align: right;">
                        <button type="submit" class="btn-primary">Simpan</button>
                    </div>
                </form>
            </div> -->


            <!-- Ubah Password -->
            <div class="card">
                <header>
                    <h3>Reset Password</h3>
                    <p>Link reset password akan terkirim ke email yang anda gunakan untuk login. klik link di email yang anda gunakan untuk login untuk melanjutkan.</p>
                </header>

                {{-- Pesan setelah link terkirim --}}
                @if (session('status'))
                    <div class="alert alert-success mt-2">
                        Link verifikasi telah dikirim ke email 
                        <strong>{{ auth()->user()->email }}</strong>. 
                        Silakan cek inbox atau folder spam.
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="form-group mb-3">
                        <label for="email">Email Anda</label>
                        <input 
                            type="email" 
                            id="email" 
                            class="form-control" 
                            value="{{ auth()->user()->email }}" 
                            disabled
                        >
                    </div><br>

                    <button type="submit" class="btn btn-primary w-100">
                        Kirim Link Reset Password
                    </button>
                </form>
            </div>


            <!-- <div class="card">
                <form action="{{ route('account.deactivate') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menonaktifkan akun? Anda tidak bisa login lagi.');">
                    @csrf
                    <button type="submit" class="btn btn-danger">
                        Nonaktifkan Akun
                    </button>
                </form>

            </div> -->


            <!-- Hapus Akun -->
            <!-- <div class="card">
                <header>
                    <h3>Hapus Akun</h3>
                    <p>Tindakan ini tidak dapat dibatalkan. Semua data Anda akan dihapus permanen.</p>
                </header>
                <form>
                    <div class="form-group">
                        <label for="delete_password">Konfirmasi Password</label>
                        <input type="password" id="delete_password" placeholder="Masukkan password Anda">
                    </div>
                    <div style="text-align: right;">
                        <button type="submit" class="btn-danger">Hapus Akun</button>
                    </div>
                </form>
            </div> -->
        </section>
    </main>
</body>

</html>
@endsection