@extends('client.layout.client-layout')
@section('title', 'Penarikan Saldo')
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
        grid-template-columns: 320px 1fr;
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
    }

    .card:hover {
        box-shadow: var(--shadow-md);
    }

    .card-header {
        padding: 24px 24px 0;
        border-bottom: 1px solid var(--gray-100);
        margin-bottom: 24px;
    }

    .card-title {
        font-size: 18px;
        font-weight: 600;
        color: var(--gray-900);
        margin-bottom: 8px;
    }

    .card-subtitle {
        font-size: 14px;
        color: var(--gray-500);
    }

    .card-content {
        padding: 24px;
    }

    /* Balance Card */
    .balance-card {
        background: var(--white);
        color: var(--gray-800);
        border: 2px solid var(--primary);
        position: relative;
        overflow: hidden;
        margin-bottom: 24px;
    }

    .balance-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--primary) 0%, #60a5fa 50%, var(--primary-dark) 100%);
        z-index: 1;
    }

    .balance-card .card-content {
        position: relative;
        z-index: 2;
    }

    .balance-header {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 16px;
    }

    .balance-icon {
        width: 40px;
        height: 40px;
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--white);
        font-size: 18px;
    }

    .balance-title {
        font-size: 16px;
        font-weight: 600;
        color: var(--gray-900);
        margin: 0;
    }

    .balance-amount {
        font-size: 36px;
        font-weight: 700;
        margin: 16px 0;
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .balance-subtitle {
        font-size: 14px;
        color: var(--gray-600);
        margin-bottom: 24px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .balance-subtitle::before {
        content: '';
        width: 8px;
        height: 8px;
        background: var(--success);
        border-radius: 50%;
    }

    .balance-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
        padding-top: 24px;
        border-top: 1px solid var(--gray-200);
    }

    .balance-item {
        text-align: center;
        padding: 16px 12px;
        background: var(--gray-50);
        border-radius: var(--radius-sm);
        border: 1px solid var(--gray-200);
        transition: all 0.2s ease;
    }

    .balance-item:hover {
        background: var(--primary-light);
        border-color: var(--primary);
        transform: translateY(-1px);
    }

    .balance-item .label {
        font-size: 12px;
        color: var(--gray-500);
        margin-bottom: 8px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-weight: 500;
    }

    .balance-item .value {
        font-size: 16px;
        font-weight: 700;
        color: var(--gray-900);
    }

    /* Quick Actions */
    .quick-actions {
        margin-bottom: 24px;
    }

    .action-grid {
        display: grid;
        gap: 12px;
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

    /* Table Styles */
    .table-wrapper {
        overflow-x: auto;
        margin-top: 24px;
    }

    .custom-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 14px;
    }

    .custom-table thead th {
        background: var(--gray-50);
        padding: 16px 20px;
        text-align: left;
        font-weight: 600;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: var(--gray-600);
        border-bottom: 2px solid var(--gray-200);
    }

    .custom-table tbody td {
        padding: 20px;
        border-bottom: 1px solid var(--gray-100);
        color: var(--gray-800);
        vertical-align: middle;
    }

    .custom-table tbody tr {
        transition: background-color 0.2s ease;
    }

    .custom-table tbody tr:hover {
        background: var(--gray-50);
    }

    .custom-table tbody tr:last-child td {
        border-bottom: none;
    }

    .withdrawal-id {
        font-weight: 600;
        color: var(--primary);
        font-family: 'Courier New', monospace;
        font-size: 13px;
    }

    .date-cell {
        display: flex;
        align-items: center;
        gap: 8px;
        color: var(--gray-700);
        font-size: 14px;
    }

    .date-cell i {
        color: var(--gray-400);
    }

    .amount-cell {
        font-weight: 700;
        color: var(--success);
        font-size: 16px;
    }

    .bank-info {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .bank-name {
        font-weight: 600;
        color: var(--gray-800);
        font-size: 14px;
    }

    .account-number {
        font-size: 12px;
        color: var(--gray-500);
        font-family: 'Courier New', monospace;
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

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 60px 24px;
        color: var(--gray-500);
    }

    .empty-state-icon {
        width: 80px;
        height: 80px;
        margin: 0 auto 24px;
        background: var(--gray-50);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 36px;
        color: var(--gray-300);
    }

    .empty-state-text {
        font-size: 16px;
        margin-bottom: 24px;
        font-weight: 500;
    }

    /* Pagination */
    .pagination-wrapper {
        padding: 24px;
        border-top: 1px solid var(--gray-200);
        display: flex;
        justify-content: center;
    }

    .pagination {
        display: flex;
        gap: 8px;
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .page-item .page-link {
        border: 1px solid var(--gray-200);
        border-radius: var(--radius-sm);
        color: var(--gray-700);
        padding: 8px 12px;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.2s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        min-width: 40px;
    }

    .page-item .page-link:hover {
        background: var(--gray-50);
        border-color: var(--primary);
        color: var(--primary);
    }

    .page-item.active .page-link {
        background: var(--primary);
        border-color: var(--primary);
        color: white;
    }

    .page-item.disabled .page-link {
        opacity: 0.5;
        pointer-events: none;
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .main-grid {
            grid-template-columns: 1fr;
            gap: 24px;
        }
    }

    @media (max-width: 768px) {
        .container2 {
            padding: 0 16px;
        }

        .page-title {
            font-size: 24px;
        }

        .balance-amount {
            font-size: 28px;
        }

        .card-content {
            padding: 20px;
        }

        .custom-table {
            font-size: 13px;
        }

        .custom-table thead {
            display: none;
        }

        .custom-table tbody tr {
            display: block;
            margin-bottom: 16px;
            border: 1px solid var(--gray-200);
            border-radius: var(--radius);
            padding: 16px;
        }

        .custom-table tbody td {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid var(--gray-100);
        }

        .custom-table tbody td:before {
            content: attr(data-label);
            font-weight: 600;
            color: var(--gray-600);
            font-size: 12px;
            text-transform: uppercase;
        }

        .custom-table tbody td:last-child {
            border-bottom: none;
        }

        .balance-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 576px) {
        .withdrawal-wrapper {
            padding: 16px 0;
        }

        .balance-card {
            margin-bottom: 16px;
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
        <div class="main-grid">
            <!-- Sidebar -->
            <aside>
                <!-- Balance Card -->
                <div class="card balance-card">
                    <div class="card-content">
                        <div class="balance-header">
                            <div class="balance-icon">
                                <i class="fas fa-wallet"></i>
                            </div>
                            <h2 class="balance-title">Saldo Tersedia</h2>
                        </div>
                        
                        <div class="balance-amount">{{ $wallet->formatted_balance }}</div>
                        <div class="balance-subtitle">
                            Siap untuk ditarik
                        </div>
                        
                        <div class="balance-grid">
                            <div class="balance-item">
                                <div class="label">Sedang Diproses</div>
                                <div class="value">Rp {{ number_format($wallet->pending_balance, 0, ',', '.') }}</div>
                            </div>
                            <div class="balance-item">
                                <div class="label">Total Penarikan</div>
                                <div class="value">{{ $withdrawals->total() }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="card quick-actions">
                    <div class="card-content">
                        <h3 style="font-size: 16px; font-weight: 600; margin: 0 0 16px; color: var(--gray-900);">Aksi Cepat</h3>
                        <div class="action-grid">
                            <a href="{{ route('freelancer.withdrawals.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus-circle"></i> Ajukan Penarikan
                            </a>
                            <button class="btn btn-secondary">
                                <i class="fas fa-chart-line"></i> Laporan Penghasilan
                            </button>
                        </div>
                    </div>
                </div>
            </aside>

            <!-- Main Content -->
            <main>
                <!-- Alerts -->
                @if(session('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i>
                    <div>{{ session('success') }}</div>
                    <button type="button" class="close" data-dismiss="alert">
                        <span>&times;</span>
                    </button>
                </div>
                @endif

                @if(session('error'))
                <div class="alert alert-error">
                    <i class="fas fa-exclamation-circle"></i>
                    <div>{{ session('error') }}</div>
                    <button type="button" class="close" data-dismiss="alert">
                        <span>&times;</span>
                    </button>
                </div>
                @endif

                <!-- Breadcrumb -->
                <nav class="breadcrumb">
                    <a href="#"><i class="fas fa-home" style="margin-right: 4px;"></i>Beranda</a>
                    <span class="breadcrumb-separator">/</span>
                    <a href="#">Profil Freelancer</a>
                    <span class="breadcrumb-separator">/</span>
                    <span style="font-weight: 600; color: var(--gray-900);">Penarikan Saldo</span>
                </nav>

                <!-- Page Header -->
                <div class="page-header">
                    <h1 class="page-title">Riwayat Penarikan Saldo</h1>
                    <p class="page-description">Pantau semua transaksi penarikan saldo Anda. Setiap permintaan akan direview dalam 1-3 hari kerja.</p>
                </div>

                <!-- Withdrawal History -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-history" style="margin-right: 8px; color: var(--primary);"></i>
                            Daftar Penarikan
                        </h3>
                        <p class="card-subtitle">Semua transaksi penarikan saldo Anda</p>
                    </div>
                    
                    <div class="table-wrapper">
                        <table class="custom-table">
                            <thead>
                                <tr>
                                    <th>ID Penarikan</th>
                                    <th>Tanggal</th>
                                    <th>Jumlah</th>
                                    <th>Informasi Bank</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($withdrawals as $withdrawal)
                                <tr>
                                    <td data-label="ID Penarikan">
                                        <span class="withdrawal-id">{{ $withdrawal->withdrawal_id }}</span>
                                    </td>
                                    <td data-label="Tanggal">
                                        <div class="date-cell">
                                            <i class="far fa-calendar-alt"></i>
                                            {{ $withdrawal->created_at->format('d M Y H:i') }}
                                        </div>
                                    </td>
                                    <td data-label="Jumlah">
                                        <span class="amount-cell">{{ $withdrawal->formatted_amount }}</span>
                                    </td>
                                    <td data-label="Informasi Bank">
                                        <div class="bank-info">
                                            <span class="bank-name">{{ $withdrawal->bank_name }}</span>
                                            <span class="account-number">{{ $withdrawal->account_number }}</span>
                                        </div>
                                    </td>
                                    <td data-label="Status">
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
                                    </td>
                                    <td data-label="Aksi">
                                        <a href="{{ route('freelancer.withdrawals.show', $withdrawal) }}" class="btn btn-secondary" style="padding: 8px 16px; font-size: 13px;">
                                            <i class="fas fa-eye"></i> Detail
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6">
                                        <div class="empty-state">
                                            <div class="empty-state-icon">
                                                <i class="fas fa-inbox"></i>
                                            </div>
                                            <p class="empty-state-text">Belum ada riwayat penarikan</p>
                                            <a href="{{ route('freelancer.withdrawals.create') }}" class="btn btn-primary">
                                                <i class="fas fa-plus-circle"></i>
                                                Buat Penarikan Pertama
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if($withdrawals->hasPages())
                    <div class="pagination-wrapper">
                        {{ $withdrawals->links() }}
                    </div>
                    @endif
                </div>
            </main>
        </div>
    </div>
</div>

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

    // Add smooth scrolling
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
});
</script>
@endpush
@endsection