@extends('admin.layouts.main')

@section('title', 'Detail Penarikan')

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

    .withdrawal-wrapper {
        padding: 24px 0;
    }

    .main-grid {
        display: grid;
        grid-template-columns: 1fr 320px;
        gap: 32px;
        margin-top: 24px;
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

    /* Page Header */
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 32px;
    }

    .page-title-section h1 {
        font-size: 28px;
        font-weight: 700;
        color: var(--gray-900);
        margin-bottom: 8px;
    }

    .page-description {
        font-size: 16px;
        color: var(--gray-600);
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
        transform: translateY(-1px);
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
    }

    .btn-danger {
        background: var(--error);
        color: var(--white);
        box-shadow: var(--shadow-sm);
    }

    .btn-danger:hover {
        background: #dc2626;
        box-shadow: var(--shadow-md);
        transform: translateY(-1px);
        color: var(--white);
    }

    .btn-block {
        width: 100%;
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

    /* Bank Info & User Info */
    .info-box {
        background: var(--gray-50);
        border: 1px solid var(--gray-200);
        border-radius: var(--radius-sm);
        padding: 20px;
        margin-bottom: 24px;
    }

    .info-box-title {
        font-size: 14px;
        font-weight: 600;
        color: var(--gray-700);
        margin-bottom: 16px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .info-detail {
        display: flex;
        justify-content: space-between;
        padding: 12px 0;
        border-bottom: 1px solid var(--gray-200);
    }

    .info-detail:last-child {
        border-bottom: none;
    }

    .info-detail .label {
        font-size: 13px;
        color: var(--gray-600);
    }

    .info-detail .value {
        font-size: 14px;
        font-weight: 600;
        color: var(--gray-900);
        text-align: right;
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

    /* Action Card */
    .action-card {
        border-left: 4px solid var(--warning);
    }

    .action-grid {
        display: grid;
        gap: 12px;
    }

    /* Wallet Info Card */
    .wallet-info-card {
        border-left: 4px solid var(--primary);
    }

    .wallet-item {
        margin-bottom: 20px;
    }

    .wallet-item:last-child {
        margin-bottom: 0;
    }

    .wallet-item .label {
        font-size: 12px;
        color: var(--gray-500);
        margin-bottom: 4px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .wallet-item .value {
        font-size: 20px;
        font-weight: 700;
    }

    /* Alert Styles */
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
    }

    .alert-info {
        background: var(--primary-light);
        border-color: var(--primary);
        color: #1e40af;
    }

    .alert-danger {
        background: #fef2f2;
        border-color: var(--error);
        color: #991b1b;
    }

    /* Modal Improvements */
    .modal-content {
        border: none;
        border-radius: var(--radius);
        box-shadow: var(--shadow-lg);
    }

    .modal-header {
        padding: 20px 24px;
        border-bottom: 1px solid var(--gray-200);
    }

    .modal-body {
        padding: 24px;
    }

    .modal-footer {
        padding: 16px 24px;
        border-top: 1px solid var(--gray-200);
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
        .page-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 16px;
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
        .amount-value {
            font-size: 28px;
        }
    }
</style>

<div class="withdrawal-wrapper">
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="page-title-section">
                <h1>
                    <i class="fas fa-file-invoice mr-2"></i>Detail Penarikan Saldo
                </h1>
                <p class="page-description">Informasi lengkap tentang transaksi penarikan saldo freelancer</p>
            </div>
            <a href="{{ route('admin.withdrawals.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>

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
                                <div class="value" style="font-family: 'Courier New', monospace; color: var(--primary); font-size: 14px;">
                                    {{ $withdrawal->withdrawal_id }}
                                </div>
                            </div>
                            <div class="info-item">
                                <div class="label">Tanggal Pengajuan</div>
                                <div class="value" style="font-size: 14px;">{{ $withdrawal->created_at->format('d M Y H:i') }}</div>
                            </div>
                            <div class="info-item">
                                <div class="label">Status</div>
                                <div class="value">{!! $withdrawal->status_badge !!}</div>
                            </div>
                        </div>

                        <div class="info-box">
                            <div class="info-box-title">
                                <i class="fas fa-user"></i>
                                Informasi Freelancer
                            </div>
                            <div class="info-detail">
                                <span class="label">Nama Lengkap</span>
                                <span class="value">{{ $withdrawal->user->name }}</span>
                            </div>
                            <div class="info-detail">
                                <span class="label">Email</span>
                                <span class="value">{{ $withdrawal->user->email }}</span>
                            </div>
                        </div>

                        <div class="info-box">
                            <div class="info-box-title">
                                <i class="fas fa-university"></i>
                                Informasi Rekening Bank
                            </div>
                            <div class="info-detail">
                                <span class="label">Nama Bank</span>
                                <span class="value">{{ $withdrawal->bank_name }}</span>
                            </div>
                            <div class="info-detail">
                                <span class="label">Nomor Rekening</span>
                                <span class="value" style="font-family: 'Courier New', monospace;">{{ $withdrawal->account_number }}</span>
                            </div>
                            <div class="info-detail">
                                <span class="label">Nama Pemilik</span>
                                <span class="value">{{ $withdrawal->account_holder_name }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Proof Image Card -->
                @if($withdrawal->isCompleted() && $withdrawal->proof_image)
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-receipt" style="color: var(--success);"></i>
                            Bukti Transfer
                        </h3>
                        <p class="card-subtitle">Bukti transfer yang telah diunggah</p>
                    </div>
                    
                    <div class="card-content">
                        <div class="proof-container">
                            <div class="proof-image-wrapper">
                                <a href="{{ asset('storage/' . $withdrawal->proof_image) }}" target="_blank">
                                    <img src="{{ asset('storage/' . $withdrawal->proof_image) }}" 
                                         alt="Bukti Transfer" 
                                         class="proof-image">
                                </a>
                            </div>
                            <div class="proof-info">
                                <i class="fas fa-info-circle"></i>
                                Klik gambar untuk melihat ukuran penuh • Diunggah pada {{ $withdrawal->processed_at->format('d M Y H:i') }}
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
                @endif
            </main>

            <!-- Sidebar -->
            <aside>
                <!-- Quick Actions -->
                @if($withdrawal->status === 'pending' || $withdrawal->status === 'approved')
                <div class="card action-card">
                    <div class="card-content">
                        <h6 style="font-size: 16px; font-weight: 600; color: var(--warning); margin-bottom: 16px; display: flex; align-items: center; gap: 8px;">
                            <i class="fas fa-tasks"></i>
                            Aksi Cepat
                        </h6>
                        <div class="action-grid">
                            @if($withdrawal->status === 'pending')
                            <button type="button" 
                                    class="btn btn-success" 
                                    data-toggle="modal" 
                                    data-target="#approveModal">
                                <i class="fas fa-check"></i> Setujui Penarikan
                            </button>
                            
                            <button type="button" 
                                    class="btn btn-danger" 
                                    data-toggle="modal" 
                                    data-target="#rejectModal">
                                <i class="fas fa-times"></i> Tolak Penarikan
                            </button>
                            @endif

                            <button type="button" 
                                    class="btn btn-primary" 
                                    data-toggle="modal" 
                                    data-target="#completeModal">
                                <i class="fas fa-check-double"></i> Selesaikan Transfer
                            </button>
                        </div>
                    </div>
                </div>
                @endif

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
                                <div class="timeline-icon" style="background: {{ $withdrawal->isPending() ? 'var(--warning)' : 'var(--success)' }};">
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

                <!-- Wallet Info -->
                <div class="card wallet-info-card">
                    <div class="card-content">
                        <h6 style="font-size: 16px; font-weight: 600; color: var(--primary); margin-bottom: 16px; display: flex; align-items: center; gap: 8px;">
                            <i class="fas fa-wallet"></i>
                            Informasi Wallet Freelancer
                        </h6>
                        <div class="wallet-item">
                            <div class="label">Saldo Tersedia</div>
                            <div class="value" style="color: var(--success);">
                                {{ $withdrawal->wallet->formatted_balance }}
                            </div>
                        </div>
                        <div class="wallet-item">
                            <div class="label">Saldo Dalam Proses</div>
                            <div class="value" style="color: var(--warning);">
                                Rp {{ number_format($withdrawal->wallet->pending_balance, 0, ',', '.') }}
                            </div>
                        </div>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</div>

<!-- Approve Modal -->
<div class="modal fade" id="approveModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background: var(--success); color: white; border-radius: var(--radius) var(--radius) 0 0;">
                <h5 class="modal-title">
                    <i class="fas fa-check-circle mr-2"></i>Setujui Penarikan
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" style="opacity: 1;">
                    <span>&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.withdrawals.approve', $withdrawal) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menyetujui penarikan ini?</p>
                    <div class="alert alert-info">
                        <strong>ID:</strong> {{ $withdrawal->withdrawal_id }}<br>
                        <strong>Freelancer:</strong> {{ $withdrawal->user->name }}<br>
                        <strong>Jumlah:</strong> {{ $withdrawal->formatted_amount }}<br>
                        <strong>Bank:</strong> {{ $withdrawal->bank_name }} - {{ $withdrawal->account_number }}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fas fa-times"></i> Batal
                    </button>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-check"></i> Ya, Setujui
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Reject Modal -->
<div class="modal fade" id="rejectModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background: var(--error); color: white; border-radius: var(--radius) var(--radius) 0 0;">
                <h5 class="modal-title">
                    <i class="fas fa-times-circle mr-2"></i>Tolak Penarikan
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" style="opacity: 1;">
                    <span>&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.withdrawals.reject', $withdrawal) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menolak penarikan ini?</p>
                    <div class="alert alert-danger">
                        <strong>ID:</strong> {{ $withdrawal->withdrawal_id }}<br>
                        <strong>Freelancer:</strong> {{ $withdrawal->user->name }}<br>
                        <strong>Jumlah:</strong> {{ $withdrawal->formatted_amount }}
                    </div>
                    <div class="form-group">
                        <label for="admin_notes" class="font-weight-bold">
                            Alasan Penolakan <span class="text-danger">*</span>
                        </label>
                        <textarea name="admin_notes" 
                                  id="admin_notes" 
                                  class="form-control" 
                                  rows="3" 
                                  placeholder="Masukkan alasan penolakan..."
                                  required
                                  style="border: 1px solid var(--gray-300); border-radius: var(--radius-sm); padding: 12px; font-size: 14px;"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fas fa-times"></i> Batal
                    </button>
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-ban"></i> Ya, Tolak
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Complete Modal -->
<div class="modal fade" id="completeModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background: var(--primary); color: white; border-radius: var(--radius) var(--radius) 0 0;">
                <h5 class="modal-title">
                    <i class="fas fa-check-double mr-2"></i>Selesaikan Penarikan
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" style="opacity: 1;">
                    <span>&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.withdrawals.complete', $withdrawal) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="alert alert-info">
                        <h6 class="font-weight-bold">Informasi Transfer:</h6>
                        <strong>ID:</strong> {{ $withdrawal->withdrawal_id }}<br>
                        <strong>Freelancer:</strong> {{ $withdrawal->user->name }}<br>
                        <strong>Jumlah:</strong> {{ $withdrawal->formatted_amount }}<br>
                        <strong>Bank:</strong> {{ $withdrawal->bank_name }}<br>
                        <strong>No. Rekening:</strong> {{ $withdrawal->account_number }}<br>
                        <strong>Atas Nama:</strong> {{ $withdrawal->account_holder_name }}
                    </div>

                    <div class="form-group">
                        <label for="proof_image" class="font-weight-bold">
                            Bukti Transfer <span class="text-danger">*</span>
                        </label>
                        <div class="custom-file">
                            <input type="file" 
                                   name="proof_image" 
                                   class="custom-file-input" 
                                   id="proof_image"
                                   accept="image/*"
                                   required
                                   onchange="previewImage(this)">
                            <label class="custom-file-label" for="proof_image">
                                Pilih file bukti transfer...
                            </label>
                        </div>
                        <small class="form-text text-muted">
                            Format: JPG, JPEG, PNG (Max: 2MB)
                        </small>
                        <div id="imagePreview" class="mt-3 text-center" style="display: none;">
                            <img src="" alt="Preview" class="img-fluid rounded shadow" style="max-height: 300px;">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="admin_notes_complete" class="font-weight-bold">
                            Catatan (Opsional)
                        </label>
                        <textarea name="admin_notes" 
                                  id="admin_notes_complete" 
                                  class="form-control" 
                                  rows="2" 
                                  placeholder="Catatan tambahan (opsional)..."
                                  style="border: 1px solid var(--gray-300); border-radius: var(--radius-sm); padding: 12px; font-size: 14px;"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fas fa-times"></i> Batal
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-paper-plane"></i> Selesaikan Transfer
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
function previewImage(input) {
    const preview = document.getElementById('imagePreview');
    const img = preview.querySelector('img');
    const label = input.nextElementSibling;
    
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            img.src = e.target.result;
            preview.style.display = 'block';
        }
        
        reader.readAsDataURL(input.files[0]);
        label.textContent = input.files[0].name;
    }
}

// Animation when cards come into view
document.addEventListener('DOMContentLoaded', function() {
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

    // Button click animation
    document.querySelectorAll('.btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            if (this.type !== 'submit' && !this.disabled) {
                this.style.transform = 'scale(0.98)';
                setTimeout(() => {
                    this.style.transform = '';
                }, 100);
            }
        });
    });
});
</script>
@endpush