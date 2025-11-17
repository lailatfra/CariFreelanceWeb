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

    .avatar-wrapper {
      text-align: center;
      margin-bottom: 16px;
    }

    .profile-card .avatar {
      width: 90px;
      height: 90px;
      border-radius: 9999px;
      background: #2563eb;
      color: white;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      font-size: 36px;
      font-weight: 600;
    }

    .avatar-img {
      width: 90px;
      height: 90px;
      border-radius: 9999px;
      object-fit: cover;
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

    .social-link {
      display: flex;
      align-items: center;
      gap: 8px;
      padding: 8px 0;
      color: #2563eb;
      text-decoration: none;
      font-size: 14px;
    }

    .social-link:hover {
      text-decoration: underline;
    }

    .social-link i {
      width: 20px;
    }

    .avatar-wrapper {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-bottom: 15px;
}

.avatar-img {
    width: 130px;      /* besarkan */
    height: 130px;     /* besarkan */
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid #ddd;
}

.avatar {
    width: 130px; 
    height: 130px;
    border-radius: 50%;
    background: #1e90ff;
    color: white;
    font-size: 50px;
    font-weight: bold;
    display: flex;
    justify-content: center;
    align-items: center;
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
      <!-- Avatar Wrapper - Centered -->
      <div class="avatar-wrapper">
        @if($clientProfile->profile_photo && $clientProfile->profile_photo !== 'profile_photos/default.png')
          <img src="{{ asset('storage/' . $clientProfile->profile_photo) }}"
            alt="Foto Profil"
            class="avatar-img">
        @else
          <div class="avatar">
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

      <a href="{{ route('profile-akun') }}">
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
        <button onclick="location.href='{{ route('profile-kontak') }}'">Lengkapi</button>
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
          <span class="status-blue" onclick="openModal('companyModal')">Lihat/Edit</span>
        </div>
        
        <div class="checklist-item">
          <div class="left">
            <div class="icon"><i class="fas fa-eye"></i></div>
            <div>
              <h3>Visi & Misi Perusahaan</h3>
              <p>Bagikan visi dan misi perusahaan untuk menunjukkan nilai dan tujuan bisnis Anda.</p>
            </div>
          </div>
          <span class="status-blue" onclick="openModal('visionModal')">Lihat/Edit</span>
        </div>
        
        <div class="checklist-item">
          <div class="left">
            <div class="icon"><i class="fas fa-comments"></i></div>
            <div>
              <h3>Atur preferensi komunikasi</h3>
              <p>Beri tahu freelancer tentang gaya komunikasi dan ketersediaan waktu yang Anda sukai.</p>
            </div>
          </div>
          <span class="status-blue" onclick="openModal('communicationModal')">Lihat/Edit</span>
        </div>
        
        <div class="checklist-item">
          <div class="left">
            <div class="icon"><i class="fas fa-share-alt"></i></div>
            <div>
              <h3>Tambahkan Media Sosial</h3>
              <p>Tautkan akun media sosial perusahaan untuk meningkatkan kredibilitas dan transparansi.</p>
            </div>
          </div>
          <span class="status-blue" onclick="openModal('socialModal')">Lihat/Edit</span>
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
        <!-- Display existing data -->
        <div id="companyDataDisplay"></div>
        
        <div class="form-actions">
          <button type="button" class="btn btn-secondary" onclick="closeModal('companyModal')">Tutup</button>
          <button type="button" class="btn btn-primary" onclick="location.href='{{ route('profile-kontak') }}'">Edit</button>
        </div>
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
        <!-- Display existing data -->
        <div id="visionDataDisplay"></div>
        
        <div class="form-actions">
          <button type="button" class="btn btn-secondary" onclick="closeModal('visionModal')">Tutup</button>
          <button type="button" class="btn btn-primary" onclick="location.href='{{ route('profile-kontak') }}'">Edit</button>
        </div>
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
        <!-- Display existing data -->
        <div id="communicationDataDisplay"></div>
        
        <div class="form-actions">
          <button type="button" class="btn btn-secondary" onclick="closeModal('communicationModal')">Tutup</button>
          <button type="button" class="btn btn-primary" onclick="location.href='{{ route('profile-kontak') }}'">Edit</button>
        </div>
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
        <!-- Display existing data -->
        <div id="socialDataDisplay"></div>
        
        <div class="form-actions">
          <button type="button" class="btn btn-secondary" onclick="closeModal('socialModal')">Tutup</button>
          <button type="button" class="btn btn-primary" onclick="location.href='{{ route('profile-kontak') }}'">Edit</button>
        </div>
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

    // Display existing data in modals
    let existingData = null;

    function displayExistingData(modalId) {
      if (!existingData) {
        // Show empty state message
        const displays = {
          'companyModal': document.getElementById('companyDataDisplay'),
          'visionModal': document.getElementById('visionDataDisplay'),
          'communicationModal': document.getElementById('communicationDataDisplay'),
          'socialModal': document.getElementById('socialDataDisplay')
        };
        
        const display = displays[modalId];
        if (display) {
          display.innerHTML = '<p style="color: #6b7280; font-size: 14px; text-align: center; padding: 20px;">Belum ada data yang tersimpan</p>';
        }
        return;
      }

      if (modalId === 'companyModal') {
        const display = document.getElementById('companyDataDisplay');
        let html = '<div><h3 style="font-size: 16px; font-weight: 600; margin-bottom: 16px; color: #374151;">Informasi Perusahaan</h3>';
        
        if (existingData.company_name) {
          html += `<div class="data-display"><strong>Nama Perusahaan:</strong><p>${existingData.company_name}</p></div>`;
        }
        if (existingData.industry) {
          html += `<div class="data-display"><strong>Industri:</strong><p>${existingData.industry}</p></div>`;
        }
        if (existingData.company_size) {
          html += `<div class="data-display"><strong>Ukuran Perusahaan:</strong><p>${existingData.company_size}</p></div>`;
        }
        if (existingData.company_description) {
          html += `<div class="data-display"><strong>Deskripsi:</strong><p>${existingData.company_description}</p></div>`;
        }
        if (existingData.website) {
          html += `<div class="data-display"><strong>Website:</strong><p><a href="${existingData.website}" target="_blank" style="color: #2563eb;">${existingData.website}</a></p></div>`;
        }
        
        html += '</div>';
        display.innerHTML = html;
      }

      if (modalId === 'visionModal') {
        const display = document.getElementById('visionDataDisplay');
        let html = '<div><h3 style="font-size: 16px; font-weight: 600; margin-bottom: 16px; color: #374151;">Visi & Misi Perusahaan</h3>';
        
        if (existingData.company_vision) {
          html += `<div class="data-display"><strong>Visi:</strong><p>${existingData.company_vision}</p></div>`;
        }
        if (existingData.company_mission) {
          html += `<div class="data-display"><strong>Misi:</strong><p>${existingData.company_mission}</p></div>`;
        }
        if (existingData.company_values) {
          html += `<div class="data-display"><strong>Nilai-nilai:</strong><p>${existingData.company_values}</p></div>`;
        }
        if (existingData.company_goals) {
          html += `<div class="data-display"><strong>Target/Goals:</strong><p>${existingData.company_goals}</p></div>`;
        }
        
        html += '</div>';
        display.innerHTML = html;
      }

      if (modalId === 'communicationModal') {
        const display = document.getElementById('communicationDataDisplay');
        let html = '<div><h3 style="font-size: 16px; font-weight: 600; margin-bottom: 16px; color: #374151;">Preferensi Komunikasi</h3>';
        
        if (existingData.communication_platforms) {
          try {
            const platforms = JSON.parse(existingData.communication_platforms);
            html += `<div class="data-display"><strong>Platform Komunikasi:</strong><p>${platforms.join(', ')}</p></div>`;
          } catch (e) {
            html += `<div class="data-display"><strong>Platform Komunikasi:</strong><p>${existingData.communication_platforms}</p></div>`;
          }
        }
        if (existingData.update_frequency) {
          html += `<div class="data-display"><strong>Frekuensi Update:</strong><p>${existingData.update_frequency}</p></div>`;
        }
        if (existingData.timezone) {
          html += `<div class="data-display"><strong>Zona Waktu:</strong><p>${existingData.timezone}</p></div>`;
        }
        
        html += '</div>';
        display.innerHTML = html;
      }

      if (modalId === 'socialModal') {
        const display = document.getElementById('socialDataDisplay');
        let html = '<div><h3 style="font-size: 16px; font-weight: 600; margin-bottom: 16px; color: #374151;">Media Sosial Perusahaan</h3>';
        
        const socials = [];
        if (existingData.social_website) socials.push({icon: 'fas fa-globe', name: 'Website', url: existingData.social_website});
        if (existingData.social_linkedin) socials.push({icon: 'fab fa-linkedin', name: 'LinkedIn', url: existingData.social_linkedin});
        if (existingData.social_instagram) socials.push({icon: 'fab fa-instagram', name: 'Instagram', url: existingData.social_instagram});
        if (existingData.social_facebook) socials.push({icon: 'fab fa-facebook', name: 'Facebook', url: existingData.social_facebook});
        if (existingData.social_twitter) socials.push({icon: 'fab fa-twitter', name: 'Twitter', url: existingData.social_twitter});
        if (existingData.social_youtube) socials.push({icon: 'fab fa-youtube', name: 'YouTube', url: existingData.social_youtube});
        if (existingData.social_tiktok) socials.push({icon: 'fab fa-tiktok', name: 'TikTok', url: existingData.social_tiktok});
        
        if (socials.length > 0) {
          socials.forEach(social => {
            html += `<a href="${social.url}" target="_blank" class="social-link"><i class="${social.icon}"></i><span>${social.name}: ${social.url}</span></a>`;
          });
        } else {
          html += '<p style="color: #6b7280; font-size: 14px;">Belum ada media sosial yang ditambahkan</p>';
        }
        
        if (existingData.social_other) {
          html += `<div class="data-display" style="margin-top: 12px;"><strong>Media Sosial Lainnya:</strong><p>${existingData.social_other}</p></div>`;
        }
        
        html += '</div>';
        display.innerHTML = html;
      }
    }

    // Form submission handlers removed - now view only

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
          existingData = result.data;
          
          // Update button status for completed sections
          updateButtonStatus(result.data);
        }
      })
      .catch(error => {
        console.error('Error loading data:', error);
      });
    }

    // Update button status based on data completion
    function updateButtonStatus(data) {
      if (data.company_name) {
        const button1 = document.querySelector('.checklist-item:nth-child(1) span');
        if (button1) {
          button1.textContent = 'Lihat/Edit';
          button1.className = 'status-blue';
        }
      }
      
      if (data.company_vision) {
        const button2 = document.querySelector('.checklist-item:nth-child(2) span');
        if (button2) {
          button2.textContent = 'Lihat/Edit';
          button2.className = 'status-blue';
        }
      }
      
      if (data.communication_platforms && data.communication_platforms.length > 0) {
        const button3 = document.querySelector('.checklist-item:nth-child(3) span');
        if (button3) {
          button3.textContent = 'Lihat/Edit';
          button3.className = 'status-blue';
        }
      }
      
      if (data.social_website || data.social_linkedin || data.social_instagram || data.social_facebook) {
        const button4 = document.querySelector('.checklist-item:nth-child(4) span');
        if (button4) {
          button4.textContent = 'Lihat/Edit';
          button4.className = 'status-blue';
        }
      }
    }

    // Form validation and enhancement
    document.addEventListener('DOMContentLoaded', function() {
      // Load existing data on page load
      loadExistingData();
    });
  </script>

</body>

</html>

@endsection