@extends('freelancer.layout.freelancer-layout')
@section('title', 'Detail Penarikan Saldo')
@section('content')

<style>
    :root {
        --primary: #3b82f6;
        --primary-dark: #2563eb;
        --primary-light: #eff6ff;
        --secondary: #64748b;
        --success: #10b981;
        --warning: #f59e0b;
        --error: #ef4444;
        --gray-50: #f8fafc;
        --gray-100: #f1f5f9;
        --gray-200: #e2e8f0;
        --gray-300: #cbd5e1;
        --gray-400: #94a3b8;
        --gray-500: #64748b;
        --gray-600: #475569;
        --gray-700: #334155;
        --gray-800: #1e293b;
        --gray-900: #0f172a;
        --white: #ffffff;
        --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
        --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
        --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
        --radius: 12px;
        --radius-sm: 8px;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        color: var(--gray-800);
        line-height: 1.6;
        font-size: 14px;
    }

    .withdrawal-wrapper {
        min-height: 100vh;
        padding: 24px 0;
    }

    .container2 {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 24px;
    }

    .main-grid {
        display: grid;
        grid-template-columns: 1fr 320px;
        gap: 32px;
        margin-top: 24px;
    }

    /* Navigation Categories */
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

    /* Cards */
    .card {
        background: var(--white);
        border-radius: var(--radius);
        box-shadow: var(--shadow-sm);
        border: 1px solid var(--gray-200);
        overflow: hidden;
        transition: all 0.2s ease;
        margin-bottom: 24px;
    }

    .card:hover {
        box-shadow: var(--shadow-md);
    }

    .card-header {
        padding: 24px 24px 20px;
        border-bottom: 1px solid var(--gray-100);
    }

    .card-title {
        font-size: 18px;
        font-weight: 600;
        color: var(--gray-900);
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .card-subtitle {
        font-size: 14px;
        color: var(--gray-500);
    }

    .card-content {
        padding: 24px;
    }

    /* Breadcrumb */
    .breadcrumb {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 14px;
        color: var(--gray-500);
        margin-bottom: 24px;
    }

    .breadcrumb a {
        color: var(--primary);
        text-decoration: none;
        transition: color 0.2s;
    }

    .breadcrumb a:hover {
        color: var(--primary-dark);
    }

    .breadcrumb-separator {
        color: var(--gray-300);
    }

    /* Page Header */
    .page-header {
        margin-bottom: 32px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .page-title-section {
        flex: 1;
    }

    .page-title {
        font-size: 28px;
        font-weight: 700;
        color: var(--gray-900);
        margin-bottom: 8px;
    }

    .page-description {
        font-size: 16px;
        color: var(--gray-600);
        line-height: 1.6;
    }

    /* Alerts */
    .alert {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        padding: 16px 20px;
        border-radius: var(--radius-sm);
        font-size: 14px;
        line-height: 1.5;
        margin-bottom: 24px;
        border: 1px solid;
        position: relative;
    }

    .alert-success {
        background: #f0fdf4;
        border-color: var(--success);
        color: #047857;
    }

    .alert-info {
        background: var(--primary-light);
        border-color: var(--primary);
        color: #1e40af;
    }

    .alert-error {
        background: #fef2f2;
        border-color: var(--error);
        color: #991b1b;
    }

    .alert i {
        margin-top: 2px;
        font-size: 16px;
    }

    .alert .close {
        position: absolute;
        top: 12px;
        right: 12px;
        background: none;
        border: none;
        color: inherit;
        opacity: 0.6;
        cursor: pointer;
        font-size: 20px;
        padding: 4px;
        line-height: 1;
        transition: opacity 0.2s;
    }

    .alert .close:hover {
        opacity: 1;
    }

    /* Buttons */
    .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 12px 20px;
        border-radius: var(--radius-sm);
        font-size: 14px;
        font-weight: 500;
        text-decoration: none;
        cursor: pointer;
        border: none;
        transition: all 0.2s ease;
        font-family: inherit;
        white-space: nowrap;
    }

    .btn-primary {
        background: var(--primary);
        color: var(--white);
        box-shadow: var(--shadow-sm);
    }

    .btn-primary:hover {
        background: var(--primary-dark);
        box-shadow: var(--shadow-md);
        transform: translateY(-1px);
        color: var(--white);
        text-decoration: none;
    }

    .btn-secondary {
        background: var(--white);
        color: var(--gray-700);
        border: 1px solid var(--gray-300);
    }

    .btn-secondary:hover {
        background: var(--gray-50);
        border-color: var(--gray-400);
        color: var(--gray-700);
        text-decoration: none;
    }

    .btn-success {
        background: var(--success);
        color: var(--white);
        box-shadow: var(--shadow-sm);
    }

    .btn-success:hover {
        background: #059669;
        box-shadow: var(--shadow-md);
        transform: translateY(-1px);
        color: var(--white);
        text-decoration: none;
    }

    .btn-sm {
        padding: 8px 16px;
        font-size: 13px;
    }

    /* Info Grid */
    .info-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
        margin-bottom: 24px;
    }

    .info-item {
        text-align: center;
        padding: 20px 16px;
        background: var(--gray-50);
        border-radius: var(--radius-sm);
        border: 1px solid var(--gray-200);
        transition: all 0.2s ease;
    }

    .info-item:hover {
        background: var(--primary-light);
        border-color: var(--primary);
        transform: translateY(-2px);
    }

    .info-item .label {
        font-size: 12px;
        color: var(--gray-500);
        margin-bottom: 8px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-weight: 500;
    }

    .info-item .value {
        font-size: 16px;
        font-weight: 700;
        color: var(--gray-900);
    }

    .info-item .value.status {
        display: inline-block;
    }

    /* Amount Display */
    .amount-display {
        text-align: center;
        padding: 32px 24px;
        background: linear-gradient(135deg, var(--success) 0%, #059669 100%);
        border-radius: var(--radius);
        margin-bottom: 24px;
    }

    .amount-label {
        font-size: 14px;
        color: rgba(255, 255, 255, 0.9);
        margin-bottom: 8px;
        font-weight: 500;
    }

    .amount-value {
        font-size: 40px;
        font-weight: 700;
        color: var(--white);
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    /* Bank Info */
    .bank-info-card {
        background: var(--gray-50);
        border: 1px solid var(--gray-200);
        border-radius: var(--radius-sm);
        padding: 20px;
        margin-bottom: 24px;
    }

    .bank-info-title {
        font-size: 14px;
        font-weight: 600;
        color: var(--gray-700);
        margin-bottom: 16px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .bank-detail {
        display: flex;
        justify-content: space-between;
        padding: 12px 0;
        border-bottom: 1px solid var(--gray-200);
    }

    .bank-detail:last-child {
        border-bottom: none;
    }

    .bank-detail .label {
        font-size: 13px;
        color: var(--gray-600);
    }

    .bank-detail .value {
        font-size: 14px;
        font-weight: 600;
        color: var(--gray-900);
        font-family: 'Courier New', monospace;
    }

    /* Status Timeline */
    .timeline {
        position: relative;
        padding-left: 40px;
    }

    .timeline-item {
        position: relative;
        padding-bottom: 32px;
        opacity: 0.5;
        transition: opacity 0.3s ease;
    }

    .timeline-item:last-child {
        padding-bottom: 0;
    }

    .timeline-item.active,
    .timeline-item.completed {
        opacity: 1;
    }

    .timeline-item::before {
        content: '';
        position: absolute;
        left: -28px;
        top: 32px;
        width: 2px;
        height: calc(100% - 12px);
        background: var(--gray-200);
    }

    .timeline-item:last-child::before {
        display: none;
    }

    .timeline-icon {
        position: absolute;
        left: -40px;
        top: 0;
        width: 28px;
        height: 28px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 12px;
        border: 3px solid white;
        box-shadow: 0 0 0 2px var(--gray-200);
        transition: all 0.3s ease;
    }

    .timeline-item.active .timeline-icon,
    .timeline-item.completed .timeline-icon {
        box-shadow: 0 0 0 2px var(--primary), 0 2px 8px rgba(59, 130, 246, 0.3);
    }

    .timeline-content h6 {
        font-size: 15px;
        font-weight: 600;
        margin-bottom: 4px;
        color: var(--gray-900);
    }

    .timeline-content small {
        font-size: 13px;
        color: var(--gray-500);
    }

    /* Status Badges */
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .status-badge.pending {
        background: #fef3c7;
        color: #92400e;
    }

    .status-badge.approved {
        background: #dbeafe;
        color: #1e40af;
    }

    .status-badge.rejected {
        background: #fee2e2;
        color: #991b1b;
    }

    .status-badge.completed {
        background: #d1fae5;
        color: #065f46;
    }

    /* Proof Image */
    .proof-container {
        background: var(--gray-50);
        border: 2px dashed var(--gray-300);
        border-radius: var(--radius);
        padding: 24px;
        text-align: center;
    }

    .proof-image-wrapper {
        position: relative;
        display: inline-block;
        margin-bottom: 16px;
    }

    .proof-image {
        max-width: 100%;
        max-height: 400px;
        border-radius: var(--radius-sm);
        box-shadow: var(--shadow-md);
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .proof-image:hover {
        transform: scale(1.02);
        box-shadow: var(--shadow-lg);
    }

    .proof-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.5);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease;
        border-radius: var(--radius-sm);
        color: white;
    }

    .proof-image-wrapper:hover .proof-overlay {
        opacity: 1;
    }

    .proof-actions {
        display: flex;
        gap: 12px;
        justify-content: center;
        margin-top: 16px;
    }

    .proof-info {
        margin-top: 12px;
        font-size: 13px;
        color: var(--gray-600);
    }

    /* Info Box */
    .info-box {
        padding: 20px;
        background: var(--gray-50);
        border: 1px solid var(--gray-200);
        border-left: 4px solid var(--primary);
        border-radius: var(--radius-sm);
        margin-bottom: 24px;
    }

    .info-box-title {
        font-size: 14px;
        font-weight: 600;
        color: var(--gray-900);
        margin-bottom: 12px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .info-box-content {
        font-size: 13px;
        color: var(--gray-700);
        line-height: 1.6;
    }

    /* Help Card */
    .help-card {
        border-left: 4px solid var(--primary);
    }

    .help-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .help-list li {
        padding: 10px 0;
        font-size: 13px;
        color: var(--gray-700);
        line-height: 1.6;
        display: flex;
        align-items: flex-start;
        gap: 10px;
    }

    .help-list li:before {
        content: '•';
        color: var(--primary);
        font-weight: bold;
        font-size: 18px;
        line-height: 1;
    }

    /* Modal */
    .modal-content {
        border: none;
        border-radius: var(--radius);
        box-shadow: var(--shadow-lg);
    }

    .modal-header {
        background: var(--primary);
        color: white;
        border-radius: var(--radius) var(--radius) 0 0;
        padding: 20px 24px;
        border-bottom: none;
    }

    .modal-title {
        font-size: 18px;
        font-weight: 600;
    }

    .modal-body {
        padding: 0;
    }

    .modal-body img {
        width: 100%;
        height: auto;
        border-radius: 0;
    }

    .modal-footer {
        border-top: 1px solid var(--gray-200);
        padding: 16px 24px;
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .main-grid {
            grid-template-columns: 1fr;
            gap: 24px;
        }

        .info-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 768px) {
        .container2 {
            padding: 0 16px;
        }

        .page-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 16px;
        }

        .page-title {
            font-size: 24px;
        }

        .amount-value {
            font-size: 32px;
        }

        .card-content {
            padding: 20px;
        }

        .info-grid {
            grid-template-columns: 1fr;
            gap: 12px;
        }

        .btn {
            width: 100%;
        }
    }

    @media (max-width: 576px) {
        .withdrawal-wrapper {
            padding: 16px 0;
        }

        .amount-value {
            font-size: 28px;
        }
    }
</style>

<!-- Navigation Categories -->
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

<div class="withdrawal-wrapper">
    <div class="container2">
        <!-- Breadcrumb -->
        <nav class="breadcrumb">
            <a href="#"><i class="fas fa-home" style="margin-right: 4px;"></i>Beranda</a>
            <span class="breadcrumb-separator">/</span>
            <a href="{{ route('freelancer.withdrawals.index') }}">Penarikan Saldo</a>
            <span class="breadcrumb-separator">/</span>
            <span style="font-weight: 600; color: var(--gray-900);">Detail Penarikan</span>
        </nav>

        <!-- Page Header -->
        <div class="page-header">
            <div class="page-title-section">
                <h1 class="page-title">Detail Penarikan Saldo</h1>
                <p class="page-description">Informasi lengkap tentang transaksi penarikan saldo Anda</p>
            </div>
            <a href="{{ route('freelancer.withdrawals.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>

        <!-- Success Alert -->
        @if($withdrawal->isCompleted())
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i>
            <div>
                <strong>Transfer Berhasil!</strong> Dana telah ditransfer ke rekening Anda.
                @if($withdrawal->proof_image)
                <a href="#proofSection" class="alert-link ml-2">Lihat Bukti Transfer</a>
                @endif
            </div>
            <button type="button" class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
        </div>
        @endif

        <div class="main-grid">
            <!-- Main Content -->
            <main>
                <!-- Amount Card -->
                <div class="card">
                    <div class="amount-display">
                        <div class="amount-label">Jumlah Penarikan</div>
                        <div class="amount-value">{{ $withdrawal->formatted_amount }}</div>
                    </div>
                </div>

                <!-- Withdrawal Info Card -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-info-circle" style="color: var(--primary);"></i>
                            Informasi Penarikan
                        </h3>
                        <p class="card-subtitle">Detail lengkap transaksi penarikan saldo</p>
                    </div>
                    
                    <div class="card-content">
                        <div class="info-grid">
                            <div class="info-item">
                                <div class="label">ID Penarikan</div>
                                <div class="value" style="font-family: 'Courier New', monospace; color: var(--primary);">
                                    {{ $withdrawal->withdrawal_id }}
                                </div>
                            </div>
                            <div class="info-item">
                                <div class="label">Tanggal Pengajuan</div>
                                <div class="value">{{ $withdrawal->created_at->format('d M Y H:i') }}</div>
                            </div>
                            <div class="info-item">
                                <div class="label">Status</div>
                                <div class="value status">
                                    <span class="status-badge {{ $withdrawal->status }}">
                                        @if($withdrawal->status === 'pending')
                                            <i class="fas fa-clock"></i> Menunggu
                                        @elseif($withdrawal->status === 'approved')
                                            <i class="fas fa-check"></i> Disetujui
                                        @elseif($withdrawal->status === 'rejected')
                                            <i class="fas fa-times"></i> Ditolak
                                        @elseif($withdrawal->status === 'completed')
                                            <i class="fas fa-check-double"></i> Selesai
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="bank-info-card">
                            <div class="bank-info-title">
                                <i class="fas fa-university"></i>
                                Informasi Rekening Bank
                            </div>
                            <div class="bank-detail">
                                <span class="label">Nama Bank</span>
                                <span class="value">{{ $withdrawal->bank_name }}</span>
                            </div>
                            <div class="bank-detail">
                                <span class="label">Nomor Rekening</span>
                                <span class="value">{{ $withdrawal->account_number }}</span>
                            </div>
                            <div class="bank-detail">
                                <span class="label">Nama Pemilik</span>
                                <span class="value">{{ $withdrawal->account_holder_name }}</span>
                            </div>
                        </div>

                        @if($withdrawal->isApproved() || $withdrawal->isCompleted())
                        <div class="alert alert-info" style="margin-bottom: 0;">
                            <i class="fas fa-info-circle"></i>
                            <div>
                                <strong>
                                    @if($withdrawal->isApproved())
                                        Penarikan disetujui!
                                    @else
                                        Penarikan selesai!
                                    @endif
                                </strong><br>
                                @if($withdrawal->isApproved())
                                    Dana akan segera ditransfer ke rekening Anda.
                                @else
                                    Dana telah ditransfer ke rekening Anda.
                                @endif
                            </div>
                        </div>
                        @endif

                        @if($withdrawal->isRejected())
                        <div class="alert alert-error" style="margin-bottom: 0;">
                            <i class="fas fa-exclamation-triangle"></i>
                            <div>
                                <strong>Penarikan ditolak!</strong><br>
                                @if($withdrawal->admin_notes)
                                    <span style="font-size: 13px;">Alasan: {{ $withdrawal->admin_notes }}</span>
                                @else
                                    <span style="font-size: 13px;">Tidak ada alasan yang diberikan.</span>
                                @endif
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Proof Image Card -->
                @if($withdrawal->isCompleted() && $withdrawal->proof_image)
                <div class="card" id="proofSection">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-receipt" style="color: var(--success);"></i>
                            Bukti Transfer
                        </h3>
                        <p class="card-subtitle">Bukti transfer dari admin pada {{ $withdrawal->processed_at->format('d M Y H:i') }}</p>
                    </div>
                    
                    <div class="card-content">
                        <div class="proof-container">
                            <div class="proof-image-wrapper">
                                <img src="{{ asset('storage/' . $withdrawal->proof_image) }}" 
                                     alt="Bukti Transfer" 
                                     class="proof-image"
                                     data-toggle="modal" 
                                     data-target="#proofModal">
                                <div class="proof-overlay">
                                    <i class="fas fa-search-plus fa-2x"></i>
                                </div>
                            </div>
                            <div class="proof-actions">
                                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#proofModal">
                                    <i class="fas fa-search-plus"></i> Lihat Ukuran Penuh
                                </button>
                                <a href="{{ asset('storage/' . $withdrawal->proof_image) }}" 
                                   download 
                                   class="btn btn-success btn-sm">
                                    <i class="fas fa-download"></i> Download Bukti
                                </a>
                            </div>
                            <div class="proof-info">
                                <i class="fas fa-info-circle"></i>
                                Bukti transfer dari admin pada {{ $withdrawal->processed_at->format('d M Y H:i') }}
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Processing History -->
                @if($withdrawal->processed_at)
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-history" style="color: var(--primary);"></i>
                            Riwayat Proses
                        </h3>
                        <p class="card-subtitle">Informasi pemrosesan penarikan</p>
                    </div>
                    
                    <div class="card-content">
                        <div class="info-box">
                            <div class="info-box-title">
                                <i class="fas fa-user-shield"></i>
                                Detail Pemrosesan
                            </div>
                            <div class="info-box-content">
                                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                                    <div>
                                        <div style="font-size: 12px; color: var(--gray-500); margin-bottom: 4px;">Diproses Oleh</div>
                                        <div style="font-weight: 600; color: var(--gray-900);">
                                            {{ $withdrawal->processedBy ? $withdrawal->processedBy->name : 'Admin' }}
                                        </div>
                                    </div>
                                    <div>
                                        <div style="font-size: 12px; color: var(--gray-500); margin-bottom: 4px;">Tanggal Diproses</div>
                                        <div style="font-weight: 600; color: var(--gray-900);">
                                            {{ $withdrawal->processed_at->format('d M Y H:i') }}
                                        </div>
                                    </div>
                                </div>

                                @if($withdrawal->admin_notes)
                                <div style="margin-top: 16px; padding-top: 16px; border-top: 1px solid var(--gray-200);">
                                    <div style="font-size: 12px; color: var(--gray-500); margin-bottom: 4px;">
                                        @if($withdrawal->isRejected())
                                            Alasan Penolakan
                                        @else
                                            Catatan Admin
                                        @endif
                                    </div>
                                    <div style="padding: 12px 16px; background: {{ $withdrawal->isRejected() ? '#fef2f2' : '#eff6ff' }}; border-left: 4px solid {{ $withdrawal->isRejected() ? 'var(--error)' : 'var(--primary)' }}; border-radius: var(--radius-sm); font-weight: 500; color: var(--gray-700);">
                                        <i class="fas {{ $withdrawal->isRejected() ? 'fa-exclamation-triangle' : 'fa-sticky-note' }} mr-2"></i>
                                        {{ $withdrawal->admin_notes }}
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </main>

            <!-- Sidebar -->
            <aside>
                <!-- Status Timeline -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-tasks" style="color: var(--primary);"></i>
                            Status Penarikan
                        </h3>
                    </div>
                    
                    <div class="card-content">
                        <div class="timeline">
                            <!-- Pending -->
                            <div class="timeline-item {{ $withdrawal->isPending() ? 'active' : 'completed' }}">
                                <div class="timeline-icon {{ $withdrawal->isPending() ? 'bg-warning' : 'bg-success' }}" style="background: {{ $withdrawal->isPending() ? 'var(--warning)' : 'var(--success)' }};">
                                    <i class="fas fa-clock"></i>
                                </div>
                                <div class="timeline-content">
                                    <h6>Menunggu Verifikasi</h6>
                                    <small>{{ $withdrawal->created_at->format('d M Y H:i') }}</small>
                                </div>
                            </div>

                            <!-- Approved -->
                            <div class="timeline-item {{ $withdrawal->isApproved() || $withdrawal->isCompleted() ? 'completed' : '' }}">
                                <div class="timeline-icon" style="background: {{ $withdrawal->isApproved() || $withdrawal->isCompleted() ? 'var(--success)' : 'var(--gray-400)' }};">
                                    <i class="fas fa-check"></i>
                                </div>
                                <div class="timeline-content">
                                    <h6>Disetujui</h6>
                                    @if($withdrawal->processed_at && ($withdrawal->isApproved() || $withdrawal->isCompleted()))
                                        <small>{{ $withdrawal->processed_at->format('d M Y H:i') }}</small>
                                    @else
                                        <small>Menunggu...</small>
                                    @endif
                                </div>
                            </div>

                            <!-- Completed -->
                            <div class="timeline-item {{ $withdrawal->isCompleted() ? 'completed' : '' }}">
                                <div class="timeline-icon" style="background: {{ $withdrawal->isCompleted() ? 'var(--success)' : 'var(--gray-400)' }};">
                                    <i class="fas fa-check-double"></i>
                                </div>
                                <div class="timeline-content">
                                    <h6>Transfer Selesai</h6>
                                    @if($withdrawal->isCompleted())
                                        <small>{{ $withdrawal->processed_at->format('d M Y H:i') }}</small>
                                    @else
                                        <small>Menunggu...</small>
                                    @endif
                                </div>
                            </div>

                            <!-- Rejected (if applicable) -->
                            @if($withdrawal->isRejected())
                            <div class="timeline-item completed">
                                <div class="timeline-icon" style="background: var(--error);">
                                    <i class="fas fa-times"></i>
                                </div>
                                <div class="timeline-content">
                                    <h6>Ditolak</h6>
                                    <small>{{ $withdrawal->processed_at->format('d M Y H:i') }}</small>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Estimated Time -->
                @if($withdrawal->isPending() || $withdrawal->isApproved())
                <div class="card" style="border-left: 4px solid var(--warning);">
                    <div class="card-content">
                        <h6 style="font-size: 16px; font-weight: 600; color: var(--warning); margin-bottom: 12px; display: flex; align-items: center; gap: 8px;">
                            <i class="fas fa-clock"></i>
                            Estimasi Waktu
                        </h6>
                        <p style="margin: 0; font-size: 14px; color: var(--gray-700); line-height: 1.6;">
                            Penarikan akan diproses dalam <strong>1-3 hari kerja</strong> setelah disetujui.
                        </p>
                    </div>
                </div>
                @endif

                <!-- Help Card -->
                <div class="card help-card">
                    <div class="card-content">
                        <h6 style="font-size: 16px; font-weight: 600; color: var(--primary); margin-bottom: 12px; display: flex; align-items: center; gap: 8px;">
                            <i class="fas fa-question-circle"></i>
                            Butuh Bantuan?
                        </h6>
                        <p style="font-size: 13px; color: var(--gray-700); margin-bottom: 16px; line-height: 1.6;">
                            Jika ada pertanyaan mengenai penarikan Anda, silakan hubungi tim support kami.
                        </p>
                        <a href="#" class="btn btn-primary" style="width: 100%; justify-content: center;">
                            <i class="fas fa-envelope"></i> Hubungi Support
                        </a>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</div>

<!-- Proof Image Modal -->
@if($withdrawal->isCompleted() && $withdrawal->proof_image)
<div class="modal fade" id="proofModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-receipt" style="margin-right: 8px;"></i>Bukti Transfer
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" style="background: none; border: none; font-size: 28px; line-height: 1; opacity: 0.8; cursor: pointer;">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img src="{{ asset('storage/' . $withdrawal->proof_image) }}" 
                     alt="Bukti Transfer">
            </div>
            <div class="modal-footer">
                <a href="{{ asset('storage/' . $withdrawal->proof_image) }}" 
                   download 
                   class="btn btn-success">
                    <i class="fas fa-download"></i> Download Bukti
                </a>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fas fa-times"></i> Tutup
                </button>
            </div>
        </div>
    </div>
</div>
@endif

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto-hide alerts after 5 seconds
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        setTimeout(() => {
            alert.style.transition = 'all 0.3s ease';
            alert.style.opacity = '0';
            alert.style.transform = 'translateY(-10px)';
            setTimeout(() => alert.remove(), 300);
        }, 5000);
    });

    // Close button for alerts
    document.querySelectorAll('.alert .close').forEach(btn => {
        btn.addEventListener('click', function() {
            const alert = this.closest('.alert');
            alert.style.transition = 'all 0.3s ease';
            alert.style.opacity = '0';
            alert.style.transform = 'translateY(-10px)';
            setTimeout(() => alert.remove(), 300);
        });
    });

    // Sticky navigation scroll effect
    let lastScroll = 0;
    const navContainer = document.querySelector('.nav-container');
    
    window.addEventListener('scroll', () => {
        const currentScroll = window.pageYOffset;
        
        if (currentScroll > 100) {
            navContainer.classList.add('scrolled');
        } else {
            navContainer.classList.remove('scrolled');
        }
        
        lastScroll = currentScroll;
    });

    // Add smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Add loading states to buttons
    document.querySelectorAll('.btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            if (this.type !== 'submit' && !this.disabled && !this.classList.contains('close')) {
                this.style.transform = 'scale(0.98)';
                setTimeout(() => {
                    this.style.transform = '';
                }, 100);
            }
        });
    });

    // Animation when cards come into view
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.animation = 'slideInUp 0.6s ease forwards';
            }
        });
    }, observerOptions);

    // Observe all cards
    document.querySelectorAll('.card').forEach(card => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        observer.observe(card);
    });

    // Add slideInUp animation
    const style = document.createElement('style');
    style.textContent = `
        @keyframes slideInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    `;
    document.head.appendChild(style);

    // Timeline animation
    const timelineItems = document.querySelectorAll('.timeline-item');
    timelineItems.forEach((item, index) => {
        setTimeout(() => {
            if (item.classList.contains('active') || item.classList.contains('completed')) {
                item.style.opacity = '1';
            }
        }, index * 150);
    });
});
</script>
@endpush
@endsection