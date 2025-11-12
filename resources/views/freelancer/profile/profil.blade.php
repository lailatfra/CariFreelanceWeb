@extends('freelancer.layout.freelancer-layout') 
@section('title', 'Profile Information - CariFreelance')
@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Halaman Profil - Freelancer</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  
  <style>
    :root {
      --blue-700: #1d4ed8;
      --blue-800: #1e40af;
      --green-600: #2563eb;
      --green-700: #1d4ed8;
      --yellow-600: #d97706;
      --yellow-700: #b45309;
      --red-600: #dc2626;
      --red-700: #b91c1c;
      --purple-600: #7c3aed;
      --purple-700: #6d28d9;
      --orange-600: #ea580c;
      --orange-700: #c2410c;
      --gray-200: #e5e7eb;
      --gray-300: #d1d5db;
      --gray-500: #6b7280;
      --gray-600: #4b5563;
      --gray-700: #374151;
      --gray-900: #111827;
      --gray-50: #f9fafb;
      --bg: #f8fbff;
      --radius-sm: 6px;
      --shadow-sm: 0 1px 2px rgba(0, 0, 0, .06);
      --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    }

    body {
      background: #fff;
      color: #1f2937;
      font-family: Arial, sans-serif;
      margin: 0;
      line-height: 1.8; 
      font-size: 15px;  
    }

    .main {
      width: 100%;
      margin: auto;
      padding: 40px 28px;
      display: grid;
      gap: 32px;
    }
    @media (min-width: 768px) {
      .main {
        grid-template-columns: 1fr 2fr;
      }
    }

    .profile-card {
      border: 1px solid #d1d5db;
      border-radius: 10px;
      padding: 32px;
      font-size: 15px;
    }
    .profile-card .avatar {
      width: 90px;
      height: 90px;
      border-radius: 9999px;
      background: #2563eb;
      color: white;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 36px;
      font-weight: 600;
      margin: auto;
      background-size: cover;
      background-position: center;
    }
    .profile-card h2 {
      text-align: center;
      margin: 16px 0 8px;
      font-size: 22px;
      font-weight: 600;
    }
    .profile-card p {
      text-align: center;
      font-size: 14px;
      color: #6b7280;
      margin: 0 0 20px;
    }
    .profile-card ul {
      list-style: none;
      padding: 0;
      margin: 0;
      font-size: 15px;
      color: #374151;
    }
    .profile-card ul li {
      display: flex;
      gap: 12px;
      padding: 14px 0;
      border-bottom: 1px solid #d1d5db;
      align-items: flex-start;
    }
    .profile-card ul li:last-child {
      border-bottom: none;
    }
    .profile-card ul li i {
      color: #6b7280;
      font-size: 16px;
      margin-top: 2px;
    }
    .profile-card button {
      width: 100%;
      border: 1px solid #d1d5db;
      border-radius: 8px;
      padding: 12px;
      font-size: 15px;
      color: #374151;
      background: white;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      margin-top: 12px;
    }
    .profile-card button:hover {
      background: #f9fafb;
    }
    .profile-card .btn-primary {
      background: #2563eb;
      color: white;
      border-color: #2563eb;
    }
    .profile-card .btn-primary:hover {
      background: #1d4ed8;
    }

    .alert {
      border: 1px solid #93c5fd;
      background: #eff6ff;
      border-radius: 8px;
      padding: 16px;
      font-size: 14px;
      color: #1e3a8a;
      display: flex;
      justify-content: space-between;
      line-height: 1.7;
      margin-bottom: 24px;
    }
    .alert button {
      background: none;
      border: none;
      font-size: 14px;
      font-weight: 600;
      color: #1e3a8a;
      cursor: pointer;
    }
    .alert button:hover {
      text-decoration: underline;
    }

    .breadcrumb {
      font-size: 14px;
      color: #4b5563;
      margin: 18px 0;
      display: flex;
      gap: 6px;
    }

    h1 {
      font-size: 22px;
      font-weight: 800;
      margin-bottom: 10px;
    }
    p.description {
      font-size: 14px;
      color: #4b5563;
      max-width: 680px;
      margin-bottom: 28px;
      line-height: 1.8;
    }

    /* Checklist */
    .checklist {
      border: 1px solid #d1d5db;
      border-radius: 10px;
      padding: 20px;
      width: 100%;
      font-size: 14px;
    }
    .checklist h2 {
      font-size: 16px;
      font-weight: 600;
      margin-bottom: 16px;
    }
    .checklist-item {
      border: 1px solid #d1d5db;
      border-radius: 8px;
      padding: 16px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 16px;
    }
    .checklist-item:last-child {
      margin-bottom: 0;
    }
    .checklist-item .left {
      display: flex;
      gap: 16px;
      align-items: center;
    }
    .checklist-item .icon {
      border: 1px solid #d1d5db;
      border-radius: 9999px;
      padding: 12px;
      color: #374151;
    }
    .checklist-item h3 {
      font-size: 14px;
      font-weight: 600;
      margin-bottom: 6px;
    }
    .checklist-item p {
      font-size: 13px;
      color: #6b7280;
      margin: 0;
      max-width: 340px;
      line-height: 1.7;
    }
    .checklist-item span {
      font-size: 14px;
      cursor: pointer;
      padding: 6px 12px;
      border-radius: 4px;
      transition: all 0.2s ease;
    }
    .checklist-item .status-gray {
      color: #9ca3af;
      background: #f9fafb;
      border: 1px solid #d1d5db;
    }
    .checklist-item .status-gray:hover {
      background: #f3f4f6;
    }
    .checklist-item .status-blue {
      color: #2563eb;
      font-weight: 600;
      background: #eff6ff;
      border: 1px solid #93c5fd;
    }
    .checklist-item .status-blue:hover {
      background: #dbeafe;
    }
    .checklist-item .status-green {
      color: #2563eb;
      font-weight: 600;
      background: #eff6ff;
      border: 1px solid #93c5fd;
    }
    .profile-badge {
      display: inline-block;
      background: #2563eb;
      color: white;
      padding: 4px 12px;
      border-radius: 20px;
      font-size: 12px;
      font-weight: 600;
      margin-left: 8px;
    }
    .skill-tag {
      display: inline-block;
      background: #f3f4f6;
      color: #374151;
      padding: 4px 8px;
      border-radius: 16px;
      font-size: 12px;
      margin: 2px 4px 2px 0;
    }
    .rating {
      color: #f59e0b;
    }
    .profile-btn {
      width: 100%;
      border: 1px solid #d1d5db;
      border-radius: 8px;
      padding: 12px;
      font-size: 15px;
      color: #374151;
      background: white;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      margin-top: 12px;
      text-decoration: none;
      transition: background-color 0.2s ease;
    }

    .profile-btn:hover {
      background: #f9fafb;
      color: #374151;
      text-decoration: none;
    }

    /* Enhanced Modal Styles */
    .modal {
      display: none;
      position: fixed;
      z-index: 1000;
      left: 0;
      top: 40px;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5);
      opacity: 0;
      transition: opacity 0.3s ease;
    }

    .modal.active {
      display: flex;
      justify-content: center;
      align-items: center;
      opacity: 1;
    }

    .modal-content {
      background-color: #fefefe;
      margin: 5% auto;
      padding: 0;
      border: none;
      border-radius: 12px;
      width: 90%;
      max-width: 600px;
      max-height: 85vh;
      overflow-y: auto;
      position: relative;
      box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
      transform: translateY(20px);
      transition: transform 0.3s ease;
    }

    .modal.active .modal-content {
      transform: translateY(0);
    }

    .modal-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin: 0;
      padding: 24px 24px 16px 24px;
      border-bottom: 1px solid #e5e7eb;
    }

    .modal-header h2 {
      font-size: 1.25rem;
      font-weight: 600;
      margin: 0;
      color: var(--blue-700);
    }

    .modal-close {
      background: none;
      border: none;
      font-size: 28px;
      cursor: pointer;
      color: var(--gray-500);
      padding: 0;
      width: 32px;
      height: 32px;
      display: flex;
      align-items: center;
      justify-content: center;
      line-height: 1;
      transition: color 0.2s;
    }

    .modal-close:hover {
      color: var(--gray-700);
    }

    .modal-body {
      padding: 24px;
    }

    .form-group {
      margin-bottom: 20px;
    }

    .form-group label {
      display: block;
      margin-bottom: 6px;
      font-weight: 600;
      color: #374151;
      font-size: 14px;
    }

    .form-group input,
    .form-group textarea,
    .form-group select {
      width: 100%;
      padding: 12px;
      border: 1px solid #d1d5db;
      border-radius: 6px;
      font-size: 14px;
      font-family: inherit;
      transition: border-color 0.2s ease;
      box-sizing: border-box;
    }

    .form-group input:focus,
    .form-group textarea:focus,
    .form-group select:focus {
      outline: none;
      border-color: #2563eb;
      box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }

    .form-group textarea {
      resize: vertical;
      min-height: 100px;
    }

    .form-actions {
      display: flex;
      gap: 12px;
      justify-content: flex-end;
      margin-top: 24px;
      padding-top: 16px;
      border-top: 1px solid #e5e7eb;
    }

    .btn {
      padding: 10px 20px;
      border-radius: 6px;
      font-size: 14px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.2s ease;
      border: none;
    }

    .btn-primary {
      background: #2563eb;
      color: white;
    }

    .btn-primary:hover {
      background: #1d4ed8;
    }

    .btn-secondary {
      background: #f9fafb;
      color: #374151;
      border: 1px solid #d1d5db;
    }

    .btn-secondary:hover {
      background: #f3f4f6;
    }

    .checkbox-group {
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
    }

    .checkbox-item {
      display: flex;
      align-items: center;
      gap: 6px;
      background: #f9fafb;
      padding: 6px 12px;
      border: 1px solid #d1d5db;
      border-radius: 20px;
      font-size: 13px;
      cursor: pointer;
      transition: all 0.2s ease;
    }

    .checkbox-item:hover {
      background: #f3f4f6;
    }

    .checkbox-item input[type="checkbox"] {
      width: auto;
      margin: 0;
    }

    .checkbox-item input[type="checkbox"]:checked + label {
      font-weight: 600;
    }

    /* Notification */
    .notification {
      position: fixed;
      top: 20px;
      right: 20px;
      background: var(--green-600);
      color: white;
      padding: 15px 20px;
      border-radius: 6px;
      box-shadow: var(--shadow-md);
      z-index: 1001;
      display: none;
      transform: translateX(100%);
      transition: transform 0.3s ease;
    }

    .notification.show {
      display: block;
      transform: translateX(0);
    }

    .notification.error {
      background: var(--red-600);
    }

    .notification.success {
      background: var(--blue-700);
    }
    /* Navigation Categories - Same as Home Page */
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
    gap: 90px; /* Same large gap as home page */
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

/* Responsive - same as home page */
@media (max-width: 1024px) {
    .nav {
        padding: 0 15px;
        justify-content: flex-start;
    }
    
    .nav-list {
        justify-content: flex-start;
        gap: 15px;
    }
}

@media (max-width: 768px) {
    .nav-container {
        top: 56px;
    }

    .nav {
        padding: 0 10px;
    }

    .nav-list {
        gap: 10px;
        padding: 6px 0;
        justify-content: flex-start;
    }

    .nav-item {
        padding: 8px 12px;
        min-height: 36px;
    }

    .nav-link {
        font-size: 14px;
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

<!-- Notification -->
<div id="notification" class="notification">
  <div id="notificationMessage"></div>
</div>

<main class="main">
  <!-- Profile card -->
  <section class="profile-card">
    @if($freelancerProfile->profile_photo)
      <div class="avatar" style="background-image: url('{{ Storage::url($freelancerProfile->profile_photo) }}');"></div>
    @else
      <div class="avatar">{{ strtoupper(substr($freelancerProfile->full_name ?? 'U', 0, 1)) }}</div>
    @endif
    
    <h2>{{ $freelancerProfile->full_name ?? 'Nama Belum Diatur' }} <span class="profile-badge">FREELANCER</span></h2>
    <p>{{ $freelancerProfile->user->email ?? 'Email tidak tersedia' }}</p>
    
    <ul>
      <li>
        <i class="fas fa-map-marker-alt"></i> 
        Berlokasi di {{ $freelancerProfile->location ?? 'Lokasi belum diatur' }}
      </li>
      <li>
        <i class="fas fa-user-clock"></i> 
        Freelancer sejak {{ $freelancerProfile->user->created_at ? $freelancerProfile->user->created_at->format('F Y') : 'Tidak diketahui' }}
      </li>
      <li>
        <i class="fas fa-code"></i> 
        {{ $freelancerProfile->headline ?? $freelancerProfile->category ?? 'Kategori belum diatur' }}
      </li>
      @if($freelancerProfile->rating && $freelancerProfile->review_count)
      <li>
        <i class="fas fa-star rating"></i> 
        {{ number_format($freelancerProfile->rating, 1) }}/5 ({{ $freelancerProfile->review_count }} ulasan)
      </li>
      @endif
      @if($freelancerProfile->project_count)
      <li>
        <i class="fas fa-briefcase"></i> 
        {{ $freelancerProfile->project_count }} proyek diselesaikan
      </li>
      @endif
      @if($freelancerProfile->hourly_rate)
      <li>
        <i class="fas fa-dollar-sign"></i> 
        Mulai dari Rp{{ number_format($freelancerProfile->hourly_rate, 0, ',', '.') }}/jam
      </li>
      @endif
      
      {{-- Saldo - Ini perlu disesuaikan dengan sistem wallet Anda --}}
      <li>
        <i class="fas fa-wallet"></i> 
        <div>
          <strong>Saldo Tersedia</strong><br>
          <span style="color: #2563eb; font-weight: 600; font-size: 16px;">Rp {{ number_format(0, 0, ',', '.') }}</span>
        </div>
      </li>
      
      @if($freelancerProfile->skills)
      <li>
        <i class="fas fa-tags"></i>
        <div>
          <strong>Keahlian</strong><br>
          @php
            $skillsArray = explode(',', $freelancerProfile->skills);
          @endphp
          @foreach($skillsArray as $skill)
            <span class="skill-tag">{{ trim($skill) }}</span>
          @endforeach
        </div>
      </li>
      @endif
      
      @if($freelancerProfile->bio)
      <li>
        <i class="fas fa-clock"></i>
        <div>
          <strong>Tentang</strong><br>
          <span>{{ Str::limit($freelancerProfile->bio, 150) }}</span>
        </div>
      </li>
      @endif
    </ul>

    <button>
      <i class="fas fa-edit"></i> Edit Profil Saya
    </button>

    <a href="{{ route('freelancer.profile.public', $freelancerProfile->user_id) }}" 
       class="profile-btn" target="_blank">
       <i class="fas fa-eye"></i> Lihat profil publik
    </a>

    <button>
      <i class="fas fa-briefcase"></i> Lihat Proyek Saya
    </button>

    <button style="background: #f59e0b; border-color: #f59e0b; color: white;" onmouseover="this.style.background='#d97706'" onmouseout="this.style.background='#f59e0b'">
      <i class="fas fa-money-bill-wave"></i> Tarik Saldo
    </button>

  </section>

  <!-- Right content -->
  <section>
    <div class="alert">
      <div><strong>Lengkapi profil freelancer Anda</strong> untuk mendapatkan lebih banyak klien <br> dan menampilkan keahlian profesional Anda.</div>
      <button onclick="location.href='#checklist'">Lengkapi</button>
    </div>

    <nav class="breadcrumb">
      <span>Beranda</span> / <span class="font-semibold">Profil Freelancer Saya</span>
    </nav>

    <h1>Hai 👋 Mari bantu klien menemukan bakat Anda</h1>
    <p class="description">Bangun profil yang menarik untuk menampilkan keahlian Anda dan menarik klien berkualitas. Profil yang lengkap meningkatkan peluang Anda untuk dipekerjakan dan membangun kepercayaan dengan calon klien.</p>

    <div id="checklist" class="checklist">
      <h2>Daftar Periksa Profil Freelancer</h2>
      
      {{-- Ringkasan Penghasilan --}}
      <div class="checklist-item" style="background: #eff6ff; border-color: #2563eb;">
        <div class="left">
          <div class="icon" style="background: #2563eb; color: white; border-color: #2563eb;"><i class="fas fa-chart-line"></i></div>
          <div>
            <h3 style="color: #2563eb;">Ringkasan Penghasilan</h3>
            <p style="color: #1d4ed8;">Total penghasilan bulan ini: <strong>Rp {{ number_format(4200000, 0, ',', '.') }}</strong> | Saldo dapat ditarik: <strong>Rp {{ number_format(2450000, 0, ',', '.') }}</strong></p>
          </div>
        </div>
        <span style="color: #2563eb; font-weight: 600;">Aktif</span>
      </div>
      
      {{-- Bio --}}
      <div class="checklist-item">
        <div class="left">
          <div class="icon"><i class="fas fa-pen"></i></div>
          <div>
            <h3>Tulis bio yang menarik</h3>
            <p>Buat deskripsi detail tentang pengalaman dan keahlian Anda.</p>
          </div>
        </div>
        <span class="{{ $freelancerProfile->bio ? 'status-blue' : 'status-blue' }}" onclick="openModal('bioModal')">
          Tambah
        </span>
      </div>
      
      {{-- Keahlian --}}
      <div class="checklist-item">
        <div class="left">
          <div class="icon"><i class="fas fa-cogs"></i></div>
          <div>
            <h3>Daftarkan keahlian Anda</h3>
            <p>Tambahkan keahlian dan teknologi yang Anda kuasai.</p>
          </div>
        </div>
        <span class="{{ $freelancerProfile->skills ? 'status-blue' : 'status-blue' }}" onclick="openModal('skillsModal')">
          Tambah
        </span>
      </div>
      
      {{-- Portfolio --}}
      <div class="checklist-item">
        <div class="left">
          <div class="icon"><i class="fas fa-folder-open"></i></div>
          <div>
            <h3>Unggah sampel portofolio</h3>
            <p>Tampilkan karya terbaik Anda untuk mendemonstrasikan kemampuan.</p>
          </div>
        </div>
        <span class="{{ $freelancerProfile->portofolio_link ? 'status-blue' : 'status-blue' }}" onclick="openModal('portfolioModal')">
          Tambah
        </span>
      </div>
      
      {{-- Sertifikat & Pendidikan --}}
      <div class="checklist-item">
        <div class="left">
          <div class="icon"><i class="fas fa-certificate"></i></div>
          <div>
            <h3>Tambahkan sertifikat & pendidikan</h3>
            <p>Sertakan sertifikat yang relevan dan latar belakang pendidikan.</p>
          </div>
        </div>
        <span class="status-blue" onclick="openModal('educationModal')">Tambah</span>
      </div>
      
      {{-- Tarif --}}
      <!-- <div class="checklist-item">
        <div class="left">
          <div class="icon"><i class="fas fa-dollar-sign"></i></div>
          <div>
            <h3>Tentukan tarif layanan</h3>
            <p>Atur tarif per jam atau per proyek sesuai keahlian Anda.</p>
          </div>
        </div>
        <span class="{{ $freelancerProfile->hourly_rate ? 'status-blue' : 'status-blue' }}" onclick="openModal('rateModal')">
          Tambah
        </span>
      </div> -->
    </div>
  </section>
</main>

<!-- Bio Modal -->
<div id="bioModal" class="modal">
  <div class="modal-content">
    <div class="modal-header">
      <h2>Bio & Pengalaman</h2>
      <button class="modal-close" onclick="closeModal('bioModal')">&times;</button>
    </div>
    <div class="modal-body">
      <form id="bioForm">
        <div class="form-group">
          <label for="bio">Bio/Deskripsi Diri</label>
          <textarea id="bio" placeholder="Ceritakan tentang diri Anda, pengalaman, dan keahlian yang Anda miliki..."></textarea>
        </div>
        <div class="form-group">
          <label for="experience">Pengalaman Kerja</label>
          <textarea id="experience" placeholder="Jelaskan pengalaman kerja relevan Anda..."></textarea>
        </div>
        <div class="form-group">
          <label for="headline">Headline/Tagline</label>
          <input type="text" id="headline" placeholder="Contoh: Full Stack Developer | UI/UX Designer">
        </div>
        <div class="form-actions">
          <button type="button" class="btn btn-secondary" onclick="closeModal('bioModal')">Batal</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Skills Modal -->
<div id="skillsModal" class="modal">
  <div class="modal-content">
    <div class="modal-header">
      <h2>Keahlian & Teknologi</h2>
      <button class="modal-close" onclick="closeModal('skillsModal')">&times;</button>
    </div>
    <div class="modal-body">
      <form id="skillsForm">
        <div class="form-group">
          <label>Pilih Keahlian Utama</label>
          <div class="checkbox-group">
            <div class="checkbox-item">
              <input type="checkbox" id="webdev" name="skills" value="Web Development">
              <label for="webdev">Web Development</label>
            </div>
            <div class="checkbox-item">
              <input type="checkbox" id="mobiledev" name="skills" value="Mobile Development">
              <label for="mobiledev">Mobile Development</label>
            </div>
            <div class="checkbox-item">
              <input type="checkbox" id="uiux" name="skills" value="UI/UX Design">
              <label for="uiux">UI/UX Design</label>
            </div>
            <div class="checkbox-item">
              <input type="checkbox" id="graphicdesign" name="skills" value="Graphic Design">
              <label for="graphicdesign">Graphic Design</label>
            </div>
            <div class="checkbox-item">
              <input type="checkbox" id="dataentry" name="skills" value="Data Entry">
              <label for="dataentry">Data Entry</label>
            </div>
            <div class="checkbox-item">
              <input type="checkbox" id="contentwriting" name="skills" value="Content Writing">
              <label for="contentwriting">Content Writing</label>
            </div>
            <div class="checkbox-item">
              <input type="checkbox" id="digitalmarketing" name="skills" value="Digital Marketing">
              <label for="digitalmarketing">Digital Marketing</label>
            </div>
            <div class="checkbox-item">
              <input type="checkbox" id="seo" name="skills" value="SEO">
              <label for="seo">SEO</label>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label for="customSkills">Keahlian Lainnya</label>
          <input type="text" id="customSkills" placeholder="Pisahkan dengan koma, contoh: Python, JavaScript, Photoshop">
        </div>
        <div class="form-group">
          <label for="experienceLevel">Level Pengalaman</label>
          <select id="experienceLevel">
            <option value="">Pilih level pengalaman</option>
            <option value="beginner">Pemula (0-1 tahun)</option>
            <option value="intermediate">Menengah (2-4 tahun)</option>
            <option value="expert">Ahli (5+ tahun)</option>
          </select>
        </div>
        <div class="form-actions">
          <button type="button" class="btn btn-secondary" onclick="closeModal('skillsModal')">Batal</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Portfolio Modal -->
<div id="portfolioModal" class="modal">
  <div class="modal-content">
    <div class="modal-header">
      <h2>Portfolio & Karya</h2>
      <button class="modal-close" onclick="closeModal('portfolioModal')">&times;</button>
    </div>
    <div class="modal-body">
      <form id="portfolioForm">
        <div class="form-group">
          <label for="portfolioTitle">Judul Portfolio</label>
          <input type="text" id="portfolioTitle" placeholder="Contoh: Website E-commerce untuk Toko Fashion">
        </div>
        <div class="form-group">
          <label for="portfolioDescription">Deskripsi Proyek</label>
          <textarea id="portfolioDescription" placeholder="Jelaskan proyek yang telah Anda kerjakan, teknologi yang digunakan, dan hasil yang dicapai..."></textarea>
        </div>
        <div class="form-group">
          <label for="portfolioLink">Link Portfolio/Demo</label>
          <input type="url" id="portfolioLink" placeholder="https://portfolio-anda.com atau https://github.com/username/project">
        </div>
        <div class="form-group">
          <label for="portfolioCategory">Kategori</label>
          <select id="portfolioCategory">
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
          <label for="portfolioTech">Teknologi/Tools yang Digunakan</label>
          <input type="text" id="portfolioTech" placeholder="Contoh: React, Node.js, MongoDB, Figma">
        </div>
        <div class="form-actions">
          <button type="button" class="btn btn-secondary" onclick="closeModal('portfolioModal')">Batal</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Education Modal -->
<div id="educationModal" class="modal">
  <div class="modal-content">
    <div class="modal-header">
      <h2>Pendidikan & Sertifikat</h2>
      <button class="modal-close" onclick="closeModal('educationModal')">&times;</button>
    </div>
    <div class="modal-body">
      <form id="educationForm">
        <div class="form-group">
          <label for="education">Pendidikan Terakhir</label>
          <input type="text" id="education" placeholder="Contoh: S1 Teknik Informatika - Universitas Indonesia">
        </div>
        <div class="form-group">
          <label for="graduationYear">Tahun Lulus</label>
          <input type="number" id="graduationYear" placeholder="2020" min="1990" max="2030">
        </div>
        <div class="form-group">
          <label for="certifications">Sertifikat yang Dimiliki</label>
          <textarea id="certifications" placeholder="Daftarkan sertifikat relevan yang Anda miliki, seperti sertifikat online course, sertifikat profesi, dll..."></textarea>
        </div>
        <div class="form-group">
          <label for="courses">Kursus Online</label>
          <textarea id="courses" placeholder="Sebutkan kursus online yang pernah Anda ikuti (Udemy, Coursera, dll.)"></textarea>
        </div>
        <div class="form-group">
          <label for="languages">Bahasa yang Dikuasai</label>
          <div class="checkbox-group">
            <div class="checkbox-item">
              <input type="checkbox" id="indonesian" name="languages" value="Bahasa Indonesia">
              <label for="indonesian">Bahasa Indonesia</label>
            </div>
            <div class="checkbox-item">
              <input type="checkbox" id="english" name="languages" value="English">
              <label for="english">English</label>
            </div>
            <div class="checkbox-item">
              <input type="checkbox" id="mandarin" name="languages" value="Mandarin">
              <label for="mandarin">Mandarin</label>
            </div>
            <div class="checkbox-item">
              <input type="checkbox" id="japanese" name="languages" value="Japanese">
              <label for="japanese">Japanese</label>
            </div>
          </div>
        </div>
        <div class="form-actions">
          <button type="button" class="btn btn-secondary" onclick="closeModal('educationModal')">Batal</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Rate Modal -->
<div id="rateModal" class="modal">
  <div class="modal-content">
    <div class="modal-header">
      <h2>Tarif & Layanan</h2>
      <button class="modal-close" onclick="closeModal('rateModal')">&times;</button>
    </div>
    <div class="modal-body">
      <form id="rateForm">
        <div class="form-group">
          <label for="hourlyRate">Tarif per Jam (Rp)</label>
          <input type="number" id="hourlyRate" placeholder="50000" min="10000" step="5000">
          <small style="color: #6b7280; font-size: 12px;">Minimum Rp 10.000/jam</small>
        </div>
        <div class="form-group">
          <label for="projectRate">Tarif per Proyek (Opsional)</label>
          <input type="number" id="projectRate" placeholder="500000" min="50000" step="25000">
          <small style="color: #6b7280; font-size: 12px;">Untuk proyek dengan scope tetap</small>
        </div>
        <div class="form-group">
          <label>Tipe Layanan</label>
          <div class="checkbox-group">
            <div class="checkbox-item">
              <input type="checkbox" id="hourlyWork" name="serviceType" value="hourly">
              <label for="hourlyWork">Kerja per Jam</label>
            </div>
            <div class="checkbox-item">
              <input type="checkbox" id="projectWork" name="serviceType" value="project">
              <label for="projectWork">Proyek Fixed Price</label>
            </div>
            <div class="checkbox-item">
              <input type="checkbox" id="partTime" name="serviceType" value="part-time">
              <label for="partTime">Part-time</label>
            </div>
            <div class="checkbox-item">
              <input type="checkbox" id="fullTime" name="serviceType" value="full-time">
              <label for="fullTime">Full-time</label>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label for="availability">Ketersediaan</label>
          <select id="availability">
            <option value="">Pilih ketersediaan</option>
            <option value="full-time">Full-time (40+ jam/minggu)</option>
            <option value="part-time">Part-time (20-40 jam/minggu)</option>
            <option value="weekends">Weekend saja</option>
            <option value="flexible">Fleksibel</option>
          </select>
        </div>
        <div class="form-group">
          <label for="responseTime">Waktu Respon</label>
          <select id="responseTime">
            <option value="">Pilih waktu respon</option>
            <option value="1-hour">Dalam 1 jam</option>
            <option value="few-hours">Beberapa jam</option>
            <option value="1-day">Dalam 1 hari</option>
            <option value="2-3-days">2-3 hari</option>
          </select>
        </div>
        <div class="form-actions">
          <button type="button" class="btn btn-secondary" onclick="closeModal('rateModal')">Batal</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  // Get CSRF Token
  function getCsrfToken() {
    return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
  }

  // Modal functionality
  function openModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
      modal.style.display = 'flex';
      document.body.style.overflow = 'hidden';
      requestAnimationFrame(() => {
        modal.classList.add('active');
      });
    }
  }

  function closeModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
      modal.classList.remove('active');
      document.body.style.overflow = '';
      setTimeout(() => {
        if (!modal.classList.contains('active')) {
          modal.style.display = 'none';
        }
      }, 300);
    }
  }

  // Close modal when clicking outside
  document.addEventListener('click', function(e) {
    if (e.target.classList.contains('modal')) {
      closeModal(e.target.id);
    }
  });

  // Close modal with Escape key
  document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
      const activeModal = document.querySelector('.modal.active');
      if (activeModal) closeModal(activeModal.id);
    }
  });

  // Notification system
  function showNotification(message, type = 'success') {
    const notification = document.getElementById('notification');
    const messageEl = document.getElementById('notificationMessage');
    
    if (!notification || !messageEl) return;
    
    messageEl.textContent = message;
    notification.className = `notification show ${type}`;
    
    setTimeout(() => {
      notification.classList.remove('show');
    }, 3000);
  }

  // Bio Form Submission
  document.getElementById('bioForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const bio = document.getElementById('bio').value.trim();
    const experience = document.getElementById('experience').value.trim();
    const headline = document.getElementById('headline').value.trim();
    
    if (!bio) {
      showNotification('Bio wajib diisi!', 'error');
      return;
    }
    
    if (bio.length < 50) {
      showNotification('Bio minimal 50 karakter!', 'error');
      return;
    }

    console.log('Sending bio data:', { bio, experience, headline }); // Debug

    fetch('{{ route("freelancer.updateBio") }}', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': getCsrfToken(),
        'Accept': 'application/json'
      },
      body: JSON.stringify({ bio, experience, headline })
    })
    .then(response => {
      console.log('Response status:', response.status); // Debug
      if (!response.ok) {
        return response.json().then(err => Promise.reject(err));
      }
      return response.json();
    })
    .then(data => {
      console.log('Response data:', data); // Debug
      if (data.success) {
        showNotification(data.message, 'success');
        closeModal('bioModal');
        this.reset();
        setTimeout(() => location.reload(), 1000);
      } else {
        showNotification(data.message, 'error');
      }
    })
    .catch(error => {
      console.error('Error:', error);
      showNotification(error.message || 'Terjadi kesalahan saat menyimpan data', 'error');
    });
  });

  // Skills Form Submission
  document.getElementById('skillsForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const skills = [];
    const checkedBoxes = document.querySelectorAll('input[name="skills"]:checked');
    checkedBoxes.forEach(cb => skills.push(cb.value));
    
    const customSkills = document.getElementById('customSkills').value.trim();
    const experienceLevel = document.getElementById('experienceLevel').value;
    
    if (skills.length === 0 && !customSkills) {
      showNotification('Pilih minimal satu keahlian!', 'error');
      return;
    }

    console.log('Sending skills data:', { skills, custom_skills: customSkills, experience_level: experienceLevel });

    fetch('{{ route("freelancer.updateSkills") }}', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': getCsrfToken(),
        'Accept': 'application/json'
      },
      body: JSON.stringify({
        skills: skills,
        custom_skills: customSkills,
        experience_level: experienceLevel
      })
    })
    .then(response => {
      if (!response.ok) {
        return response.json().then(err => Promise.reject(err));
      }
      return response.json();
    })
    .then(data => {
      if (data.success) {
        showNotification(data.message, 'success');
        closeModal('skillsModal');
        this.reset();
        setTimeout(() => location.reload(), 1000);
      } else {
        showNotification(data.message, 'error');
      }
    })
    .catch(error => {
      console.error('Error:', error);
      showNotification(error.message || 'Terjadi kesalahan saat menyimpan data', 'error');
    });
  });

  // Portfolio Form Submission
  document.getElementById('portfolioForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const title = document.getElementById('portfolioTitle').value.trim();
    const description = document.getElementById('portfolioDescription').value.trim();
    const link = document.getElementById('portfolioLink').value.trim();
    const category = document.getElementById('portfolioCategory').value;
    const tech = document.getElementById('portfolioTech').value.trim();
    
    if (!title || !description) {
      showNotification('Judul dan deskripsi portfolio wajib diisi!', 'error');
      return;
    }
    
    if (link && !isValidUrl(link)) {
      showNotification('Format URL tidak valid!', 'error');
      return;
    }

    fetch('{{ route("freelancer.updatePortfolio") }}', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': getCsrfToken(),
        'Accept': 'application/json'
      },
      body: JSON.stringify({
        portfolio_title: title,
        portfolio_description: description,
        portfolio_link: link,
        portfolio_category: category,
        portfolio_tech: tech
      })
    })
    .then(response => {
      if (!response.ok) {
        return response.json().then(err => Promise.reject(err));
      }
      return response.json();
    })
    .then(data => {
      if (data.success) {
        showNotification(data.message, 'success');
        closeModal('portfolioModal');
        this.reset();
        setTimeout(() => location.reload(), 1000);
      } else {
        showNotification(data.message, 'error');
      }
    })
    .catch(error => {
      console.error('Error:', error);
      showNotification(error.message || 'Terjadi kesalahan saat menyimpan data', 'error');
    });
  });

  // Education Form Submission
  document.getElementById('educationForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const education = document.getElementById('education').value.trim();
    const graduationYear = document.getElementById('graduationYear').value;
    const certifications = document.getElementById('certifications').value.trim();
    const courses = document.getElementById('courses').value.trim();
    
    const languages = [];
    const languageBoxes = document.querySelectorAll('input[name="languages"]:checked');
    languageBoxes.forEach(cb => languages.push(cb.value));
    
    if (!education) {
      showNotification('Pendidikan terakhir wajib diisi!', 'error');
      return;
    }

    fetch('{{ route("freelancer.updateEducation") }}', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': getCsrfToken(),
        'Accept': 'application/json'
      },
      body: JSON.stringify({
        education: education,
        graduation_year: graduationYear,
        certifications: certifications,
        courses: courses,
        languages: languages
      })
    })
    .then(response => {
      if (!response.ok) {
        return response.json().then(err => Promise.reject(err));
      }
      return response.json();
    })
    .then(data => {
      if (data.success) {
        showNotification(data.message, 'success');
        closeModal('educationModal');
        this.reset();
        setTimeout(() => location.reload(), 1000);
      } else {
        showNotification(data.message, 'error');
      }
    })
    .catch(error => {
      console.error('Error:', error);
      showNotification(error.message || 'Terjadi kesalahan saat menyimpan data', 'error');
    });
  });

  // Rate Form Submission
  document.getElementById('rateForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const hourlyRate = document.getElementById('hourlyRate').value;
    const projectRate = document.getElementById('projectRate').value;
    const availability = document.getElementById('availability').value;
    const responseTime = document.getElementById('responseTime').value;
    
    const serviceTypes = [];
    const serviceBoxes = document.querySelectorAll('input[name="serviceType"]:checked');
    serviceBoxes.forEach(cb => serviceTypes.push(cb.value));
    
    if (!hourlyRate && !projectRate) {
      showNotification('Atur minimal satu jenis tarif!', 'error');
      return;
    }
    
    if (hourlyRate && hourlyRate < 10000) {
      showNotification('Tarif per jam minimal Rp 10.000!', 'error');
      return;
    }

    fetch('{{ route("freelancer.updateRate") }}', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': getCsrfToken(),
        'Accept': 'application/json'
      },
      body: JSON.stringify({
        hourly_rate: hourlyRate,
        project_rate: projectRate,
        service_types: serviceTypes,
        availability: availability,
        response_time: responseTime
      })
    })
    .then(response => {
      if (!response.ok) {
        return response.json().then(err => Promise.reject(err));
      }
      return response.json();
    })
    .then(data => {
      if (data.success) {
        showNotification(data.message, 'success');
        closeModal('rateModal');
        this.reset();
        setTimeout(() => location.reload(), 1000);
      } else {
        showNotification(data.message, 'error');
      }
    })
    .catch(error => {
      console.error('Error:', error);
      showNotification(error.message || 'Terjadi kesalahan saat menyimpan data', 'error');
    });
  });

  // URL validation helper
  function isValidUrl(string) {
    try {
      new URL(string);
      return true;
    } catch (_) {
      return false;
    }
  }

  // Form enhancements
  document.addEventListener('DOMContentLoaded', function() {
    // Add input validation styles
    const inputs = document.querySelectorAll('input, textarea, select');
    inputs.forEach(input => {
      input.addEventListener('blur', function() {
        if (this.hasAttribute('required') && !this.value.trim()) {
          this.style.borderColor = '#ef4444';
        } else {
          this.style.borderColor = '#d1d5db';
        }
      });

      input.addEventListener('input', function() {
        if (this.style.borderColor === 'rgb(239, 68, 68)') {
          this.style.borderColor = '#d1d5db';
        }
      });
    });

    // Auto-resize textareas
    const textareas = document.querySelectorAll('textarea');
    textareas.forEach(textarea => {
      textarea.addEventListener('input', function() {
        this.style.height = 'auto';
        this.style.height = this.scrollHeight + 'px';
      });
    });

    // Handle checkbox styling
    document.querySelectorAll('.checkbox-item').forEach(item => {
      item.addEventListener('click', function(e) {
        if (e.target.type !== 'checkbox') {
          const checkbox = this.querySelector('input[type="checkbox"]');
          if (checkbox) {
            checkbox.checked = !checkbox.checked;
          }
        }
      });
    });
  });
</script>

</body>
</html>

@endsection