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

    /* Navigation Categories */
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

    /* Data Display Styles */
    .data-display {
      background: #f9fafb;
      padding: 12px;
      border-radius: 6px;
      margin-bottom: 12px;
      border: 1px solid #e5e7eb;
    }

    .data-display strong {
      color: #374151;
      display: block;
      margin-bottom: 4px;
      font-size: 13px;
    }

    .data-display p {
      margin: 0;
      color: #6b7280;
      font-size: 14px;
      line-height: 1.6;
    }

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

      <button onclick="location.href='{{ route('freelancer-profile-akun') }}'">
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
        <button onclick="location.href='{{ route('freelancer-profile-akun') }}'">Lengkapi</button>
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
          <span class="status-blue" onclick="openModal('bioModal')">Lihat/Edit</span>
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
          <span class="status-blue" onclick="openModal('skillsModal')">Lihat/Edit</span>
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
          <span class="status-blue" onclick="openModal('portfolioModal')">Lihat/Edit</span>
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
          <span class="status-blue" onclick="openModal('educationModal')">Lihat/Edit</span>
        </div>
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
        <div id="bioDataDisplay"></div>
        <div class="form-actions">
          <button type="button" class="btn btn-secondary" onclick="closeModal('bioModal')">Tutup</button>
          <button type="button" class="btn btn-primary" onclick="location.href='{{ route('freelancer-profile-akun') }}'">Edit</button>
        </div>
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
        <div id="skillsDataDisplay"></div>
        <div class="form-actions">
          <button type="button" class="btn btn-secondary" onclick="closeModal('skillsModal')">Tutup</button>
          <button type="button" class="btn btn-primary" onclick="location.href='{{ route('freelancer-profile-akun') }}'">Edit</button>
        </div>
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
        <div id="portfolioDataDisplay"></div>
        <div class="form-actions">
          <button type="button" class="btn btn-secondary" onclick="closeModal('portfolioModal')">Tutup</button>
          <button type="button" class="btn btn-primary" onclick="location.href='{{ route('freelancer-profile-akun') }}'">Edit</button>
        </div>
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
        <div id="educationDataDisplay"></div>
        <div class="form-actions">
          <button type="button" class="btn btn-secondary" onclick="closeModal('educationModal')">Tutup</button>
          <button type="button" class="btn btn-primary" onclick="location.href='{{ route('freelancer-profile-akun') }}'">Edit</button>
        </div>
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
        
        // Load and display existing data when modal opens
        displayExistingData(modalId);
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

    // Display existing data in modals
    let existingData = null;

    function displayExistingData(modalId) {
      if (!existingData) {
        // Show empty state message
        const displays = {
          'bioModal': document.getElementById('bioDataDisplay'),
          'skillsModal': document.getElementById('skillsDataDisplay'),
          'portfolioModal': document.getElementById('portfolioDataDisplay'),
          'educationModal': document.getElementById('educationDataDisplay')
        };
        
        const display = displays[modalId];
        if (display) {
          display.innerHTML = '<p style="color: #6b7280; font-size: 14px; text-align: center; padding: 20px;">Belum ada data yang tersimpan</p>';
        }
        return;
      }

      if (modalId === 'bioModal') {
        const display = document.getElementById('bioDataDisplay');
        let html = '<div><h3 style="font-size: 16px; font-weight: 600; margin-bottom: 16px; color: #374151;">Bio & Pengalaman</h3>';
        
        if (existingData.bio) {
          html += `<div class="data-display"><strong>Bio/Deskripsi Diri:</strong><p>${existingData.bio}</p></div>`;
        }
        if (existingData.experience) {
          html += `<div class="data-display"><strong>Pengalaman Kerja:</strong><p>${existingData.experience}</p></div>`;
        }
        if (existingData.headline) {
          html += `<div class="data-display"><strong>Headline/Tagline:</strong><p>${existingData.headline}</p></div>`;
        }
        
        if (!existingData.bio && !existingData.experience && !existingData.headline) {
          html = '<p style="color: #6b7280; font-size: 14px; text-align: center; padding: 20px;">Belum ada data yang tersimpan</p>';
        } else {
          html += '</div>';
        }
        display.innerHTML = html;
      }

      if (modalId === 'skillsModal') {
        const display = document.getElementById('skillsDataDisplay');
        let html = '<div><h3 style="font-size: 16px; font-weight: 600; margin-bottom: 16px; color: #374151;">Keahlian & Teknologi</h3>';
        
        if (existingData.skills) {
          html += `<div class="data-display"><strong>Keahlian:</strong><p>${existingData.skills}</p></div>`;
        }
        if (existingData.experience_level) {
          const levelLabels = {
            'beginner': 'Pemula (0-1 tahun)',
            'intermediate': 'Menengah (2-4 tahun)',
            'expert': 'Ahli (5+ tahun)'
          };
          html += `<div class="data-display"><strong>Level Pengalaman:</strong><p>${levelLabels[existingData.experience_level] || existingData.experience_level}</p></div>`;
        }
        
        if (!existingData.skills && !existingData.experience_level) {
          html = '<p style="color: #6b7280; font-size: 14px; text-align: center; padding: 20px;">Belum ada data yang tersimpan</p>';
        } else {
          html += '</div>';
        }
        display.innerHTML = html;
      }

      if (modalId === 'portfolioModal') {
        const display = document.getElementById('portfolioDataDisplay');
        let html = '<div><h3 style="font-size: 16px; font-weight: 600; margin-bottom: 16px; color: #374151;">Portfolio & Karya</h3>';
        
        if (existingData.portfolio_title) {
          html += `<div class="data-display"><strong>Judul Portfolio:</strong><p>${existingData.portfolio_title}</p></div>`;
        }
        if (existingData.portfolio_description) {
          html += `<div class="data-display"><strong>Deskripsi Proyek:</strong><p>${existingData.portfolio_description}</p></div>`;
        }
        if (existingData.portofolio_link) {
          html += `<div class="data-display"><strong>Link Portfolio:</strong><p><a href="${existingData.portofolio_link}" target="_blank" style="color: #2563eb;">${existingData.portofolio_link}</a></p></div>`;
        }
        if (existingData.portfolio_category) {
          html += `<div class="data-display"><strong>Kategori:</strong><p>${existingData.portfolio_category}</p></div>`;
        }
        if (existingData.portfolio_tech) {
          html += `<div class="data-display"><strong>Teknologi/Tools:</strong><p>${existingData.portfolio_tech}</p></div>`;
        }
        
        if (!existingData.portfolio_title && !existingData.portfolio_description) {
          html = '<p style="color: #6b7280; font-size: 14px; text-align: center; padding: 20px;">Belum ada data yang tersimpan</p>';
        } else {
          html += '</div>';
        }
        display.innerHTML = html;
      }

      if (modalId === 'educationModal') {
        const display = document.getElementById('educationDataDisplay');
        let html = '<div><h3 style="font-size: 16px; font-weight: 600; margin-bottom: 16px; color: #374151;">Pendidikan & Sertifikat</h3>';
        
        if (existingData.education) {
          html += `<div class="data-display"><strong>Pendidikan Terakhir:</strong><p>${existingData.education}</p></div>`;
        }
        if (existingData.graduation_year) {
          html += `<div class="data-display"><strong>Tahun Lulus:</strong><p>${existingData.graduation_year}</p></div>`;
        }
        if (existingData.certifications) {
          html += `<div class="data-display"><strong>Sertifikat:</strong><p>${existingData.certifications}</p></div>`;
        }
        if (existingData.courses) {
          html += `<div class="data-display"><strong>Kursus Online:</strong><p>${existingData.courses}</p></div>`;
        }
        if (existingData.languages && Array.isArray(existingData.languages)) {
          html += `<div class="data-display"><strong>Bahasa yang Dikuasai:</strong><p>${existingData.languages.join(', ')}</p></div>`;
        }
        
        if (!existingData.education && !existingData.certifications) {
          html = '<p style="color: #6b7280; font-size: 14px; text-align: center; padding: 20px;">Belum ada data yang tersimpan</p>';
        } else {
          html += '</div>';
        }
        display.innerHTML = html;
      }
    }

    // Load existing data from database
    function loadExistingData() {
      fetch('/freelancer/additional-info', {
        method: 'GET',
        headers: {
          'X-CSRF-TOKEN': getCsrfToken(),
          'Accept': 'application/json',
        }
      })
      .then(response => response.json())
      .then(result => {
        if (result.success && result.data) {
          existingData = result.data;
          console.log('Loaded freelancer data:', existingData);
        }
      })
      .catch(error => {
        console.error('Error loading data:', error);
      });
    }

    // Load data on page load
    document.addEventListener('DOMContentLoaded', function() {
      loadExistingData();
    });
  </script>

</body>
</html>

@endsection