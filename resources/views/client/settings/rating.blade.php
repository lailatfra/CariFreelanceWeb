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
        aside ul { list-style: none; padding: 0; margin: 0; }
        aside li a {
            display: flex; align-items: center; gap: 0.5rem;
            border-radius: 0.375rem 0 0 0.375rem;
            padding: 0.5rem 1rem; text-decoration: none; color: inherit;
            transition: background 0.2s, color 0.2s;
        }
        aside li a:hover { background-color: #EFF6FF; color: #2563EB; }
        .active-link { border-right: 4px solid #3B82F6; background-color: #EFF6FF; color: #2563EB; }

        section.flex-1 { flex: 1; margin-left: 2rem; }
        .card {
            border: 1px solid #E2E8F0; background: white; border-radius: 0.5rem;
            padding: 1.5rem; font-size: 0.875rem; color: #475569;
        }
        .card header { margin-bottom: 1.5rem; border-bottom: 1px solid #E2E8F0; padding-bottom: 0.75rem; }
        .card h3 { font-weight: 600; color: #0F172A; font-size: 1rem; user-select: none; }

        table { width: 100%; border-collapse: collapse; font-size: 0.875rem; margin-top: 1rem; }
        th, td { border: 1px solid #E2E8F0; padding: 0.75rem; text-align: left; vertical-align: top; }
        th { background-color: #F8FAFC; font-weight: 600; color: #1E293B; }

        .rating i.fas { color: #FBBF24; }   /* filled star */
        .rating i.far { color: #CBD5E1; }   /* empty star */

        .btn-sm {
            display: inline-flex; align-items: center; gap: .375rem;
            padding: .35rem .6rem; font-size: .75rem; font-weight: 600;
            border-radius: .375rem; text-decoration: none; border: 1px solid transparent;
        }
        .btn-edit { background: #E0F2FE; color: #0369A1; border-color: #BAE6FD; }
        .btn-edit:hover { background: #BAE6FD; }
        .btn-delete { background: #FEE2E2; color: #991B1B; border-color: #FCA5A5; }
        .btn-delete:hover { background: #FCA5A5; color: #7F1D1D; }


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
                    <li><a href="{{ route('profile-akun') }}"><i class="fas fa-user text-xs"></i><span>Informasi Akun</span></a></li>
                    <li><a href="{{ route('profile-kontak') }}"><i class="fas fa-id-card-alt text-xs"></i><span>Informasi Kontak</span></a></li>
                    <li><a href="{{ route('manage-akun') }}"><i class="fas fa-lock text-xs"></i><span>Manajemen Akun</span></a></li>
                </ul>
            </section>
            <section>
                <br><h2>Rating</h2>
                <ul>
                    <li><a href="{{ route('rating') }}" class="active-link"><i class="fas fa-star text-xs"></i><span>Rating Freelancer</span></a></li>
                </ul>
            </section>
        </aside>

        <!-- Content -->
        <section class="flex-1">
            <div class="card">
                <header>
                    <h3>Freelancer Favorit Anda</h3>
                </header>
                <table>
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Proyek</th>
                            <th>Review</th>
                            <th>Rating</th>
                            <th>Sejak Tgl</th>
                            <th>Edit</th>
                            <th>Hapus</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1.</td>
                            <td>Budi Santoso</td>
                            <td>Website Company Profile</td>
                            <td>Sangat puas dengan hasil website yang dibuat. Freelancer sangat profesional dan responsif. Pengerjaan sesuai deadline dan memberikan saran yang bermanfaat. Akan saya ajak lagi untuk proyek selanjutnya.</td>
                            <td class="rating">
                                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                            </td>
                            <td>15 Agustus 2025</td>
                            <td><a href="#" class="btn-sm btn-edit" title="Edit review 1"><i class="fas fa-pen"></i>Edit</a></td>
                            <td><a href="#" class="btn-sm btn-delete" title="Hapus review 1"><i class="fas fa-trash"></i>Hapus</a></td>
                        </tr>
                        <tr>
                            <td>2.</td>
                            <td>Siti Rahmawati</td>
                            <td>Landing Page UMKM</td>
                            <td>Copywriting rapi, tampilan ringan, dan konversi meningkat. Komunikasi lancar dari awal sampai publish.</td>
                            <td class="rating">
                                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i>
                            </td>
                            <td>12 Agustus 2025</td>
                            <td><a href="#" class="btn-sm btn-edit" title="Edit review 2"><i class="fas fa-pen"></i>Edit</a></td>
                            <td><a href="#" class="btn-sm btn-delete" title="Hapus review 2"><i class="fas fa-trash"></i>Hapus</a></td>
                        </tr>
                        <tr>
                            <td>3.</td>
                            <td>Andi Pratama</td>
                            <td>UI/UX Aplikasi Mobile</td>
                            <td>Desain konsisten dengan guideline dan handoff Figma sangat rapi. Revisi cepat dan solutif.</td>
                            <td class="rating">
                                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                            </td>
                            <td>30 Juli 2025</td>
                            <td><a href="#" class="btn-sm btn-edit" title="Edit review 3"><i class="fas fa-pen"></i>Edit</a></td>
                            <td><a href="#" class="btn-sm btn-delete" title="Hapus review 3"><i class="fas fa-trash"></i>Hapus</a></td>
                        </tr>
                        <tr>
                            <td>4.</td>
                            <td>Rina Oktaviani</td>
                            <td>Toko Online (Laravel)</td>
                            <td>Checkout, kurir, dan midtrans berjalan mulus. Dokumen instalasi jelas sehingga mudah dipelihara tim internal.</td>
                            <td class="rating">
                                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i>
                            </td>
                            <td>22 Juli 2025</td>
                            <td><a href="#" class="btn-sm btn-edit" title="Edit review 4"><i class="fas fa-pen"></i>Edit</a></td>
                            <td><a href="#" class="btn-sm btn-delete" title="Hapus review 4"><i class="fas fa-trash"></i>Hapus</a></td>
                        </tr>
                        <tr>
                            <td>5.</td>
                            <td>Dwi Kurniawan</td>
                            <td>Redesign Dashboard Admin</td>
                            <td>Performance naik signifikan. Komponen reusable dan kodenya bersih. Sangat recommended.</td>
                            <td class="rating">
                                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                            </td>
                            <td>10 Juli 2025</td>
                            <td><a href="#" class="btn-sm btn-edit" title="Edit review 5"><i class="fas fa-pen"></i>Edit</a></td>
                            <td><a href="#" class="btn-sm btn-delete" title="Hapus review 5"><i class="fas fa-trash"></i>Hapus</a></td>
                        </tr>
                        <tr>
                            <td>6.</td>
                            <td>Farhan Maulana</td>
                            <td>Integrasi Payment Gateway</td>
                            <td>API dihandle rapi, logging lengkap, dan error handling jelas. Dokumentasi teknis membantu tim QA.</td>
                            <td class="rating">
                                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i>
                            </td>
                            <td>28 Juni 2025</td>
                            <td><a href="#" class="btn-sm btn-edit" title="Edit review 6"><i class="fas fa-pen"></i>Edit</a></td>
                            <td><a href="#" class="btn-sm btn-delete" title="Hapus review 6"><i class="fas fa-trash"></i>Hapus</a></td>
                        </tr>
                        <tr>
                            <td>7.</td>
                            <td>Nabila Zahra</td>
                            <td>Logo & Brand Guidelines</td>
                            <td>Konsep kuat dan mudah diaplikasikan ke media sosial. Paket file lengkap beserta panduan ukuran & warna.</td>
                            <td class="rating">
                                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                            </td>
                            <td>12 Juni 2025</td>
                            <td><a href="#" class="btn-sm btn-edit" title="Edit review 7"><i class="fas fa-pen"></i>Edit</a></td>
                            <td><a href="#" class="btn-sm btn-delete" title="Hapus review 7"><i class="fas fa-trash"></i>Hapus</a></td>
                        </tr>
                        <tr>
                            <td>8.</td>
                            <td>Rudi Hartono</td>
                            <td>SEO & Performance</td>
                            <td>Core Web Vitals hijau semua. Traffic organik mulai naik dalam 3 minggu. Edukatif saat memberi insight.</td>
                            <td class="rating">
                                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i>
                            </td>
                            <td>30 Mei 2025</td>
                            <td><a href="#" class="btn-sm btn-edit" title="Edit review 8"><i class="fas fa-pen"></i>Edit</a></td>
                            <td><a href="#" class="btn-sm btn-delete" title="Hapus review 8"><i class="fas fa-trash"></i>Hapus</a></td>
                        </tr>
                        <tr>
                            <td>9.</td>
                            <td>Maya Lestari</td>
                            <td>Company Profile Multibahasa</td>
                            <td>Struktur konten jelas, dukungan i18n berjalan baik. Tim global kami terbantu dengan CMS yang mudah.</td>
                            <td class="rating">
                                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                            </td>
                            <td>18 Mei 2025</td>
                            <td><a href="#" class="btn-sm btn-edit" title="Edit review 9"><i class="fas fa-pen"></i>Edit</a></td>
                            <td><a href="#" class="btn-sm btn-delete" title="Hapus review 9"><i class="fas fa-trash"></i>Hapus</a></td>
                        </tr>
                        <tr>
                            <td>10.</td>
                            <td>Ahmad Fauzi</td>
                            <td>Microsite Event</td>
                            <td>Animasi halus, loading cepat, dan integrasi form pendaftaran tanpa masalah. Sukses dipakai saat acara.</td>
                            <td class="rating">
                                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i>
                            </td>
                            <td>05 Mei 2025</td>
                            <td><a href="#" class="btn-sm btn-edit" title="Edit review 10"><i class="fas fa-pen"></i>Edit</a></td>
                            <td><a href="#" class="btn-sm btn-delete" title="Hapus review 10"><i class="fas fa-trash"></i>Hapus</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
    </main>
</body>
</html>
@endsection
