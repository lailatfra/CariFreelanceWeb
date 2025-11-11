@extends('client.layout.client-layout')
@section('title', 'Contact Information - CariFreelance')
@section('content')

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Halaman Profil - Klien</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
  <style>
    :root {
      --blue-700: #1d4ed8;
      --blue-800: #1e40af;
      --green-600: #059669;
      --green-700: #047857;
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

    /* Enhanced Modal Styles - Similar to Jobboard */
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

    .radio-group {
      display: flex;
      flex-direction: column;
      gap: 8px;
    }

    .radio-item {
      display: flex;
      align-items: center;
      gap: 8px;
      padding: 8px;
      cursor: pointer;
    }

    .radio-item input[type="radio"] {
      width: auto;
      margin: 0;
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
      background: var(--green-600);
    }
    
                /* Navigation Categories - Same styling from original */
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
      <!-- Avatar Wrapper -->
      <div class="avatar-wrapper" style="text-align: center; margin-bottom: 10px;">
        @if($clientProfile->profile_photo && $clientProfile->profile_photo !== 'profile_photos/default.png')
          <img src="{{ asset('storage/' . $clientProfile->profile_photo) }}"
            alt="Foto Profil"
            class="avatar-img rounded-circle"
            style="width:80px; height:80px; object-fit:cover;">
        @else
          <div class="avatar"
            style="width:80px; height:80px; line-height:80px; border-radius:50%; background:#007bff; color:#fff; font-size:28px; margin:0 auto;">
            {{ strtoupper(substr($clientProfile->user->name, 0, 1)) }}
          </div>
        @endif
      </div>

      <h2>
        {{ $clientProfile->user->name }}
        <span class="profile-badge">
          {{ ucfirst($clientProfile->user->role) }}
        </span>
      </h2>

      <p>{{ $clientProfile->user->email }}</p>

      <ul>
        @if($clientProfile->location)
        <li>
          <i class="fas fa-map-marker-alt"></i>
          {{ $clientProfile->location }}
        </li>
        @endif

        @if($clientProfile->company_name)
        <li>
          <i class="fas fa-building"></i>
          {{ $clientProfile->company_name }}
        </li>
        @endif

        @if($clientProfile->tujuan)
        <li>
          <i class="fas fa-briefcase"></i>
          {{ $clientProfile->tujuan }}
        </li>
        @endif

        @if($clientProfile->bio)
        <li>
          <i class="fas fa-clock"></i>
          <div>
            <strong>Tentang</strong><br>
            <span>{{ $clientProfile->bio }}</span>
          </div>
        </li>
        @endif
      </ul>

      <a href="/profile/akun">
      <button>
        Edit Profil Saya <i class="fas fa-pencil"></i>
      </button>
      </a>
      
      <a href="/posting">
      <button>
        Posting Pekerjaan Saya <i class="fas fa-plus"></i>
      </button>
      </a>

      <a href="/profile/job">
      <button>
        Lihat Daftar Job Saya <i class="fas fa-list"></i>
      </button>
      </a>

    </section>

    <!-- Right content -->
    <section>
      <div class="alert">
        <div>
          <strong>Lengkapi profil klien Anda</strong> untuk menarik freelancer terbaik <br>
          dan membangun kepercayaan dengan penyedia layanan.
        </div>
        <button onclick="location.href='#checklist'">Lengkapi</button>
      </div>

      <nav class="breadcrumb">
        <span>Beranda</span> / <span class="font-semibold">Profil Klien Saya</span>
      </nav>

      <h1>Hai 👋 Mari bantu freelancer mengenal Anda lebih baik</h1>
      <p class="description">Lengkapi profil Anda untuk membangun kepercayaan dengan freelancer dan mendapatkan proposal yang lebih baik. Profil yang detail membantu freelancer memahami kebutuhan bisnis dan gaya kerja Anda.</p>

      <div id="checklist" class="checklist">
        <h2>Daftar Periksa Profil Klien</h2>
        
        <div class="checklist-item">
          <div class="left">
            <div class="icon"><i class="fas fa-building"></i></div>
            <div>
              <h3>Tambahkan informasi perusahaan</h3>
              <p>Bagikan detail tentang bisnis dan industri Anda untuk membantu freelancer memahami kebutuhan Anda.</p>
            </div>
          </div>
          <span class="status-blue" onclick="openModal('companyModal')">Tambah</span>
        </div>
        
        <div class="checklist-item">
          <div class="left">
            <div class="icon"><i class="fas fa-eye"></i></div>
            <div>
              <h3>Visi & Misi Perusahaan</h3>
              <p>Bagikan visi dan misi perusahaan untuk menunjukkan nilai dan tujuan bisnis Anda.</p>
            </div>
          </div>
          <span class="status-blue" onclick="openModal('visionModal')">Tambah</span>
        </div>
        
        <div class="checklist-item">
          <div class="left">
            <div class="icon"><i class="fas fa-comments"></i></div>
            <div>
              <h3>Atur preferensi komunikasi</h3>
              <p>Beri tahu freelancer tentang gaya komunikasi dan ketersediaan waktu yang Anda sukai.</p>
            </div>
          </div>
          <span class="status-blue" onclick="openModal('communicationModal')">Tambah</span>
        </div>
        
        <div class="checklist-item">
          <div class="left">
            <div class="icon"><i class="fas fa-share-alt"></i></div>
            <div>
              <h3>Tambahkan Media Sosial</h3>
              <p>Tautkan akun media sosial perusahaan untuk meningkatkan kredibilitas dan transparansi.</p>
            </div>
          </div>
          <span class="status-blue" onclick="openModal('socialModal')">Tambah</span>
        </div>
      </div>
    </section>
  </main>

  <!-- Company Modal -->
  <div id="companyModal" class="modal">
    <div class="modal-content">
      <div class="modal-header">
        <h2>Informasi Perusahaan</h2>
        <button class="modal-close" onclick="closeModal('companyModal')">&times;</button>
      </div>
      <div class="modal-body">
        <form id="companyForm">
          <div class="form-group">
            <label for="companyName">Nama Perusahaan</label>
            <input type="text" id="companyName" name="company_name" placeholder="Masukkan nama perusahaan">
          </div>
          <div class="form-group">
            <label for="industry">Industri</label>
            <select id="industry"name="industry">
              <option value="">Pilih industri</option>
              <option value="teknologi">Teknologi</option>
              <option value="keuangan">Keuangan</option>
              <option value="kesehatan">Kesehatan</option>
              <option value="pendidikan">Pendidikan</option>
              <option value="retail">Retail</option>
              <option value="manufaktur">Manufaktur</option>
              <option value="lainnya">Lainnya</option>
            </select>
          </div>
          <div class="form-group">
            <label for="companySize">Ukuran Perusahaan</label>
            <select id="companySize" name="company_size">
              <option value="">Pilih ukuran perusahaan</option>
              <option value="1-10">1-10 karyawan</option>
              <option value="11-50">11-50 karyawan</option>
              <option value="51-200">51-200 karyawan</option>
              <option value="201-1000">201-1000 karyawan</option>
              <option value="1000+">1000+ karyawan</option>
            </select>
          </div>
          <div class="form-group">
            <label for="companyDescription">Deskripsi Perusahaan</label>
            <textarea id="companyDescription" name="company_description" placeholder="Ceritakan tentang perusahaan Anda"></textarea>
          </div>
          <div class="form-group">
            <label for="website">Website Perusahaan</label>
            <input type="url" id="website" name="website" placeholder="https://example.com">
          </div>
          <div class="form-actions">
            <button type="button" class="btn btn-secondary" onclick="closeModal('companyModal')">Batal</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Vision Modal -->
  <div id="visionModal" class="modal">
    <div class="modal-content">
      <div class="modal-header">
        <h2>Visi & Misi Perusahaan</h2>
        <button class="modal-close" onclick="closeModal('visionModal')">&times;</button>
      </div>
      <div class="modal-body">
        <form id="visionForm">
          <div class="form-group">
            <label for="companyVision">Visi Perusahaan</label>
            <textarea id="companyVision" placeholder="Tuliskan visi perusahaan Anda..."></textarea>
          </div>
          <div class="form-group">
            <label for="companyMission">Misi Perusahaan</label>
            <textarea id="companyMission" placeholder="Tuliskan misi perusahaan Anda..."></textarea>
          </div>
          <div class="form-group">
            <label for="companyValues">Nilai-Nilai Perusahaan</label>
            <textarea id="companyValues" placeholder="Tuliskan nilai-nilai yang dijunjung tinggi perusahaan..."></textarea>
          </div>
          <div class="form-group">
            <label for="companyGoals">Target/Goals Perusahaan</label>
            <textarea id="companyGoals" placeholder="Apa yang ingin dicapai perusahaan dalam 1-3 tahun ke depan?"></textarea>
          </div>
          <div class="form-actions">
            <button type="button" class="btn btn-secondary" onclick="closeModal('visionModal')">Batal</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Communication Modal -->
  <div id="communicationModal" class="modal">
    <div class="modal-content">
      <div class="modal-header">
        <h2>Preferensi Komunikasi</h2>
        <button class="modal-close" onclick="closeModal('communicationModal')">&times;</button>
      </div>
      <div class="modal-body">
        <form id="communicationForm">
          <div class="form-group">
            <label>Platform Komunikasi Preferensi</label>
            <div class="checkbox-group">
              <div class="checkbox-item">
                <input type="checkbox" id="email" name="communication" value="email">
                <label for="email">Email</label>
              </div>
              <div class="checkbox-item">
                <input type="checkbox" id="whatsapp" name="communication" value="whatsapp">
                <label for="whatsapp">WhatsApp</label>
              </div>
              <div class="checkbox-item">
                <input type="checkbox" id="slack" name="communication" value="slack">
                <label for="slack">Slack</label>
              </div>
              <div class="checkbox-item">
                <input type="checkbox" id="teams" name="communication" value="teams">
                <label for="teams">Microsoft Teams</label>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label>Frekuensi Update Progress</label>
            <div class="radio-group">
              <div class="radio-item">
                <input type="radio" id="daily" name="frequency" value="daily">
                <label for="daily">Harian</label>
              </div>
              <div class="radio-item">
                <input type="radio" id="weekly" name="frequency" value="weekly">
                <label for="weekly">Mingguan</label>
              </div>
              <div class="radio-item">
                <input type="radio" id="biweekly" name="frequency" value="biweekly">
                <label for="biweekly">Bi-weekly</label>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="timezone">Zona Waktu</label>
            <select id="timezone">
              <option value="WIB">WIB (UTC+7)</option>
              <option value="WITA">WITA (UTC+8)</option>
              <option value="WIT">WIT (UTC+9)</option>
            </select>
          </div>
          <div class="form-actions">
            <button type="button" class="btn btn-secondary" onclick="closeModal('communicationModal')">Batal</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Social Media Modal -->
  <div id="socialModal" class="modal">
    <div class="modal-content">
      <div class="modal-header">
        <h2>Media Sosial Perusahaan</h2>
        <button class="modal-close" onclick="closeModal('socialModal')">&times;</button>
      </div>
      <div class="modal-body">
        <form id="socialForm">
          <div class="form-group">
            <label for="websiteUrl">Website Resmi</label>
            <input type="url" id="websiteUrl" placeholder="https://perusahaan.com">
          </div>
          <div class="form-group">
            <label for="linkedin">LinkedIn</label>
            <input type="url" id="linkedin" placeholder="https://linkedin.com/company/nama-perusahaan">
          </div>
          <div class="form-group">
            <label for="instagram">Instagram</label>
            <input type="url" id="instagram" placeholder="https://instagram.com/nama-perusahaan">
          </div>
          <div class="form-group">
            <label for="facebook">Facebook</label>
            <input type="url" id="facebook" placeholder="https://facebook.com/nama-perusahaan">
          </div>
          <div class="form-group">
            <label for="twitter">Twitter/X</label>
            <input type="url" id="twitter" placeholder="https://twitter.com/nama-perusahaan">
          </div>
          <div class="form-group">
            <label for="youtube">YouTube</label>
            <input type="url" id="youtube" placeholder="https://youtube.com/c/nama-perusahaan">
          </div>
          <div class="form-group">
            <label for="tiktok">TikTok</label>
            <input type="url" id="tiktok" placeholder="https://tiktok.com/@nama-perusahaan">
          </div>
          <div class="form-group">
            <label for="otherSocial">Media Sosial Lainnya</label>
            <textarea id="otherSocial" placeholder="Tuliskan link media sosial lainnya yang relevan..."></textarea>
          </div>
          <div class="form-actions">
            <button type="button" class="btn btn-secondary" onclick="closeModal('socialModal')">Batal</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script>
    // Get CSRF token
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

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
        const modalId = e.target.id;
        closeModal(modalId);
      }
    });

    // Close modal with Escape key
    document.addEventListener('keydown', function(e) {
      if (e.key === 'Escape') {
        const activeModal = document.querySelector('.modal.active');
        if (activeModal) {
          closeModal(activeModal.id);
        }
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

    // Form submission - Company Info
    document.getElementById('companyForm').addEventListener('submit', function(e) {
      e.preventDefault();
      
      const form = this;
      const formData = new FormData(form);
      
      const companyName = formData.get('company_name');
      const industry = formData.get('industry');
      
      // Validation
      if (!companyName || companyName.trim() === '') {
        showNotification('Nama perusahaan wajib diisi!', 'error');
        return;
      }
      
      if (!industry) {
        showNotification('Industri wajib dipilih!', 'error');
        return;
      }

      // Send request
      fetch('/client/update-company-info', {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': csrfToken,
          'Accept': 'application/json',
        },
        body: formData
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          const button = document.querySelector('.checklist-item:nth-child(1) span');
          if (button) {
            button.textContent = 'Selesai';
            button.className = 'status-blue';
          }
          
          showNotification(data.message, 'success');
          closeModal('companyModal');
          form.reset();
          updateProgress();
        } else {
          showNotification(data.message || 'Terjadi kesalahan', 'error');
        }
      })
      .catch(error => {
        console.error('Error:', error);
        showNotification('Terjadi kesalahan saat menyimpan data', 'error');
      });
    });

    // Form submission - Vision & Mission
    document.getElementById('visionForm').addEventListener('submit', function(e) {
      e.preventDefault();
      
      const vision = document.getElementById('companyVision').value.trim();
      const mission = document.getElementById('companyMission').value.trim();
      const values = document.getElementById('companyValues').value.trim();
      const goals = document.getElementById('companyGoals').value.trim();
      
      if (!vision) {
        showNotification('Visi perusahaan wajib diisi!', 'error');
        return;
      }
      
      if (!mission) {
        showNotification('Misi perusahaan wajib diisi!', 'error');
        return;
      }

      fetch('/client/update-vision-mission', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': csrfToken,
          'Accept': 'application/json',
        },
        body: JSON.stringify({
          company_vision: vision,
          company_mission: mission,
          company_values: values,
          company_goals: goals
        })
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          const button = document.querySelector('.checklist-item:nth-child(2) span');
          if (button) {
            button.textContent = 'Selesai';
            button.className = 'status-blue';
          }
          
          showNotification(data.message, 'success');
          closeModal('visionModal');
          this.reset();
          updateProgress();
        } else {
          showNotification(data.message || 'Terjadi kesalahan', 'error');
        }
      })
      .catch(error => {
        console.error('Error:', error);
        showNotification('Terjadi kesalahan saat menyimpan data', 'error');
      });
    });

    // Form submission - Communication
    document.getElementById('communicationForm').addEventListener('submit', function(e) {
      e.preventDefault();
      
      const platforms = [];
      const checkedBoxes = document.querySelectorAll('input[name="communication"]:checked');
      checkedBoxes.forEach(cb => platforms.push(cb.value));
      
      const frequencyEl = document.querySelector('input[name="frequency"]:checked');
      const frequency = frequencyEl ? frequencyEl.value : null;
      const timezone = document.getElementById('timezone').value;
      
      if (platforms.length === 0) {
        showNotification('Pilih minimal satu platform komunikasi!', 'error');
        return;
      }

      fetch('/client/update-communication', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': csrfToken,
          'Accept': 'application/json',
        },
        body: JSON.stringify({
          communication_platforms: platforms,
          update_frequency: frequency,
          timezone: timezone
        })
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          const button = document.querySelector('.checklist-item:nth-child(3) span');
          if (button) {
            button.textContent = 'Selesai';
            button.className = 'status-blue';
          }
          
          showNotification(data.message, 'success');
          closeModal('communicationModal');
          this.reset();
          updateProgress();
        } else {
          showNotification(data.message || 'Terjadi kesalahan', 'error');
        }
      })
      .catch(error => {
        console.error('Error:', error);
        showNotification('Terjadi kesalahan saat menyimpan data', 'error');
      });
    });

    // Form submission - Social Media
    document.getElementById('socialForm').addEventListener('submit', function(e) {
      e.preventDefault();
      
      const websiteUrl = document.getElementById('websiteUrl').value.trim();
      const linkedin = document.getElementById('linkedin').value.trim();
      const instagram = document.getElementById('instagram').value.trim();
      const facebook = document.getElementById('facebook').value.trim();
      const twitter = document.getElementById('twitter').value.trim();
      const youtube = document.getElementById('youtube').value.trim();
      const tiktok = document.getElementById('tiktok').value.trim();
      const otherSocial = document.getElementById('otherSocial').value.trim();
      
      const socialLinks = [];
      if (websiteUrl) socialLinks.push('Website');
      if (linkedin) socialLinks.push('LinkedIn');
      if (instagram) socialLinks.push('Instagram');
      if (facebook) socialLinks.push('Facebook');
      
      if (socialLinks.length === 0) {
        showNotification('Tambahkan minimal satu media sosial!', 'error');
        return;
      }

      fetch('/client/update-social-media', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': csrfToken,
          'Accept': 'application/json',
        },
        body: JSON.stringify({
          social_website: websiteUrl,
          social_linkedin: linkedin,
          social_instagram: instagram,
          social_facebook: facebook,
          social_twitter: twitter,
          social_youtube: youtube,
          social_tiktok: tiktok,
          social_other: otherSocial
        })
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          const button = document.querySelector('.checklist-item:nth-child(4) span');
          if (button) {
            button.textContent = 'Selesai';
            button.className = 'status-blue';
          }
          
          showNotification(`${data.message} (${socialLinks.join(', ')})`, 'success');
          closeModal('socialModal');
          this.reset();
          updateProgress();
        } else {
          showNotification(data.message || 'Terjadi kesalahan', 'error');
        }
      })
      .catch(error => {
        console.error('Error:', error);
        showNotification('Terjadi kesalahan saat menyimpan data', 'error');
      });
    });

    // Progress tracking
    function updateProgress() {
      const completedItems = document.querySelectorAll('.checklist-item span.status-blue').length;
      const totalItems = 4;
      
      if (completedItems === totalItems) {
        const alert = document.querySelector('.alert');
        if (alert) {
          alert.innerHTML = `
            <div>
              <strong>🎉 Profil Anda sudah lengkap!</strong><br>
              Sekarang Anda siap untuk mulai bekerja sama dengan freelancer terbaik.
            </div>
            <button onclick="location.href='/client/home'">Lihat Dashboard</button>
          `;
          alert.style.borderColor = '#10b981';
          alert.style.backgroundColor = '#ecfdf5';
          alert.style.color = '#065f46';
        }
        
        showNotification('Selamat! Profil Anda sudah 100% lengkap!', 'success');
      }
    }

    // Load existing data from database
    function loadExistingData() {
      fetch('/client/get-info', {
        method: 'GET',
        headers: {
          'X-CSRF-TOKEN': csrfToken,
          'Accept': 'application/json',
        }
      })
      .then(response => response.json())
      .then(result => {
        if (result.success && result.data) {
          const data = result.data;
          
          // Update button status for each completed section
          if (data.company_name) {
            const button1 = document.querySelector('.checklist-item:nth-child(1) span');
            if (button1) {
              button1.textContent = 'Selesai';
              button1.className = 'status-blue';
            }
          }
          
          if (data.company_vision) {
            const button2 = document.querySelector('.checklist-item:nth-child(2) span');
            if (button2) {
              button2.textContent = 'Selesai';
              button2.className = 'status-blue';
            }
          }
          
          if (data.communication_platforms && data.communication_platforms.length > 0) {
            const button3 = document.querySelector('.checklist-item:nth-child(3) span');
            if (button3) {
              button3.textContent = 'Selesai';
              button3.className = 'status-blue';
            }
          }
          
          if (data.social_website || data.social_linkedin || data.social_instagram || data.social_facebook) {
            const button4 = document.querySelector('.checklist-item:nth-child(4) span');
            if (button4) {
              button4.textContent = 'Selesai';
              button4.className = 'status-blue';
            }
          }
          
          updateProgress();
        }
      })
      .catch(error => {
        console.error('Error loading data:', error);
        // Tidak perlu menampilkan notif error di sini, karena bisa jadi memang belum ada data
      });
    }

    // Form validation and enhancement
    document.addEventListener('DOMContentLoaded', function() {
      // Load existing data
      loadExistingData();

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

      // URL validation for social media inputs
      const urlInputs = document.querySelectorAll('input[type="url"]');
      urlInputs.forEach(input => {
        input.addEventListener('blur', function() {
          if (this.value && !isValidUrl(this.value)) {
            this.style.borderColor = '#ef4444';
            showNotification('Format URL tidak valid!', 'error');
          }
        });
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

    // Handle radio styling
    document.querySelectorAll('.radio-item').forEach(item => {
      item.addEventListener('click', function(e) {
        if (e.target.type !== 'radio') {
          const radio = this.querySelector('input[type="radio"]');
          if (radio) {
            radio.checked = true;
          }
        }
      });
    });
  </script>

</body>

</html>

@endsection