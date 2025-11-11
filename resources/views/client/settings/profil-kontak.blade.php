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
        <article>
            <header>
                <h3>Informasi kontak</h3>
                <p>Agar kami dapat menghubungi Anda</p>
            </header>
            <form>
                <label for="email" class="label">Kontak email</label>
                <div style="display:flex;gap:1rem;align-items:center;">
                    <input type="email" id="email" value="lailatulfitria6619@gmail.com" readonly class="form-input">
                    <button type="button" class="btn-link">Ubah</button>
                </div>

                <label for="phone" class="label">Kontak telepon</label>
                <p class="text-muted">Jika menggunakan nomor luar negri, silahkan hubungi customer service kami untuk memverifikasi.</p>
                <div style="display:flex;gap:0.75rem;">
                    <input type="tel" id="phone" placeholder="Masukan nomor telepon" class="form-input">
                    <button type="submit" class="btn-primary">Konfirmasi</button>
                </div>
            </form>
        </article>

        <article>
            <header>
                <h3>Informasi alamat</h3>
                <p>Sebagai data jika suatu saat kami perlu mengirimkan sesuatu dan dokumen kepada Anda</p>
            </header>
            <form>
                <fieldset>
                    <legend>Alamat sekarang</legend>
                    <div class="radio-group">
                        <label class="radio-label active" for="indonesia">
                            <input type="radio" id="indonesia" name="alamat" checked> Indonesia
                        </label>
                        <label class="radio-label" for="luar-negeri">
                            <input type="radio" id="luar-negeri" name="alamat"> Di luar negeri
                        </label>
                    </div>
                </fieldset>
                <div>
                    <label for="alamat-lengkap">Alamat lengkap</label>
                    <input type="text" id="alamat-lengkap" placeholder="Masukan alamat detail Anda" class="form-input">
                </div>
                <div class="grid-2">
                    <div>
                        <label for="kode-pos">Kode Pos</label>
                        <input type="text" id="kode-pos" placeholder="Kode Pos" class="form-input">
                    </div>
                    <div>
                        <label for="kelurahan">Kelurahan</label>
                        <input type="text" id="kelurahan" placeholder="masukan kecamatan" class="form-input">
                    </div>
                    <div>
                        <label for="kecamatan">Kecamatan</label>
                        <input type="text" id="kecamatan" placeholder="masukan kabupaten" class="form-input">
                    </div>
                    <div>
                        <label for="city">City</label>
                        <input type="text" id="city" value="Jawa Timur" class="form-input">
                    </div>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn-primary">Simpan</button>
                </div>
            </form>
        </article>
    </section>
</main>

</body>
</html>
@endsection
