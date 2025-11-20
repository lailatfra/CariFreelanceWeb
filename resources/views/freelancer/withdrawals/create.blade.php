@extends('client.layout.client-layout')
@section('title', 'Ajukan Penarikan Saldo')
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
        border: 2px solid var(--success);
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
        background: linear-gradient(90deg, var(--success) 0%, #34d399 50%, var(--success) 100%);
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
        background: linear-gradient(135deg, var(--success), #059669);
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
        font-size: 32px;
        font-weight: 700;
        margin: 12px 0;
        background: linear-gradient(135deg, var(--success) 0%, #059669 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .balance-subtitle {
        font-size: 13px;
        color: var(--gray-600);
        margin-bottom: 20px;
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

    .balance-divider {
        height: 1px;
        background: var(--gray-200);
        margin: 20px 0;
    }

    .balance-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 12px 0;
    }

    .balance-item .label {
        font-size: 13px;
        color: var(--gray-600);
        font-weight: 500;
    }

    .balance-item .value {
        font-size: 16px;
        font-weight: 700;
        color: var(--warning);
    }

    /* Info Card */
    .info-card {
        border-left: 4px solid var(--primary);
    }

    .info-card .card-content {
        padding: 20px;
    }

    .info-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .info-list li {
        padding: 10px 0;
        font-size: 13px;
        color: var(--gray-700);
        line-height: 1.6;
        display: flex;
        align-items: flex-start;
        gap: 10px;
    }

    .info-list li:before {
        content: '•';
        color: var(--primary);
        font-weight: bold;
        font-size: 18px;
        line-height: 1;
    }

    .info-list li strong {
        color: var(--gray-900);
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

    .btn-primary:disabled {
        background: var(--gray-400);
        cursor: not-allowed;
        transform: none;
        box-shadow: none;
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

    /* Form Styles */
    .form-section {
        margin-bottom: 32px;
    }

    .form-section:last-child {
        margin-bottom: 0;
    }

    .form-section-title {
        font-size: 16px;
        font-weight: 600;
        color: var(--gray-900);
        margin-bottom: 16px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .form-group {
        margin-bottom: 24px;
    }

    .form-label {
        display: block;
        font-size: 14px;
        font-weight: 500;
        color: var(--gray-700);
        margin-bottom: 8px;
    }

    .form-label .required {
        color: var(--error);
        margin-left: 4px;
    }

    .form-input,
    .form-select {
        width: 100%;
        padding: 12px 16px;
        border: 1px solid var(--gray-300);
        border-radius: var(--radius-sm);
        font-size: 14px;
        background: var(--white);
        transition: all 0.2s ease;
        font-family: inherit;
    }

    .form-input:focus,
    .form-select:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    .form-input::placeholder {
        color: var(--gray-400);
    }

    .form-input.is-invalid,
    .form-select.is-invalid {
        border-color: var(--error);
    }

    .form-input.is-invalid:focus,
    .form-select.is-invalid:focus {
        box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
    }

    .form-help {
        font-size: 12px;
        color: var(--gray-500);
        margin-top: 6px;
    }

    .invalid-feedback {
        font-size: 12px;
        color: var(--error);
        margin-top: 6px;
        display: block;
    }

    .input-group {
        position: relative;
        display: flex;
    }

    .input-prefix {
        display: flex;
        align-items: center;
        padding: 12px 16px;
        background: var(--gray-50);
        border: 1px solid var(--gray-300);
        border-right: none;
        border-radius: var(--radius-sm) 0 0 var(--radius-sm);
        color: var(--gray-600);
        font-weight: 500;
        font-size: 14px;
    }

    .input-group .form-input {
        border-radius: 0 var(--radius-sm) var(--radius-sm) 0;
    }

    /* Alert */
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

    .alert i {
        margin-top: 2px;
        font-size: 16px;
    }

    /* Form Actions */
    .form-actions {
        display: flex;
        gap: 12px;
        margin-top: 32px;
        padding-top: 24px;
        border-top: 1px solid var(--gray-200);
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

        .page-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 16px;
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

        .form-actions {
            flex-direction: column;
        }
        
        .btn {
            width: 100%;
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
        <!-- Breadcrumb -->
        <nav class="breadcrumb">
            <a href="#"><i class="fas fa-home" style="margin-right: 4px;"></i>Beranda</a>
            <span class="breadcrumb-separator">/</span>
            <a href="{{ route('freelancer.withdrawals.index') }}">Penarikan Saldo</a>
            <span class="breadcrumb-separator">/</span>
            <span style="font-weight: 600; color: var(--gray-900);">Ajukan Penarikan</span>
        </nav>

        <!-- Page Header -->
        <div class="page-header">
            <div class="page-title-section">
                <h1 class="page-title">Ajukan Penarikan Saldo</h1>
                <p class="page-description">Lengkapi formulir di bawah untuk mengajukan penarikan saldo Anda.</p>
            </div>
            <a href="{{ route('freelancer.withdrawals.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>

        <div class="main-grid">
            <!-- Main Form -->
            <main>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-money-check-alt" style="margin-right: 8px; color: var(--primary);"></i>
                            Form Penarikan
                        </h3>
                        <p class="card-subtitle">Pastikan semua informasi yang Anda masukkan sudah benar</p>
                    </div>
                    
                    <div class="card-content">
                        <form action="{{ route('freelancer.withdrawals.store') }}" method="POST">
                            @csrf

                            <div class="form-section">
                                <div class="form-section-title">
                                    <i class="fas fa-wallet"></i>
                                    Jumlah Penarikan
                                </div>
                                
                                <div class="form-group">
                                    <label class="form-label" for="amount">
                                        Nominal yang ingin ditarik<span class="required">*</span>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-prefix">Rp</span>
                                        <input type="number" 
                                            name="amount" 
                                            id="amount" 
                                            class="form-input @error('amount') is-invalid @enderror" 
                                            value="{{ old('amount') }}"
                                            min="50000"
                                            max="{{ $wallet->balance }}"
                                            step="1000"
                                            placeholder="Masukkan jumlah"
                                            required>
                                    </div>
                                    <div class="form-help">
                                        Minimum penarikan: Rp 50.000 | Maksimum: {{ $wallet->formatted_balance }}
                                    </div>
                                    @error('amount')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-section">
                                <div class="form-section-title">
                                    <i class="fas fa-university"></i>
                                    Informasi Rekening Bank
                                </div>
                                
                                <div class="form-group">
                                    <label class="form-label" for="bank_name">
                                        Nama Bank<span class="required">*</span>
                                    </label>
                                    <select name="bank_name" 
                                            id="bank_name" 
                                            class="form-select @error('bank_name') is-invalid @enderror" 
                                            required>
                                        <option value="">-- Pilih Bank --</option>
                                        <option value="BCA" {{ old('bank_name') == 'BCA' ? 'selected' : '' }}>BCA</option>
                                        <option value="Mandiri" {{ old('bank_name') == 'Mandiri' ? 'selected' : '' }}>Mandiri</option>
                                        <option value="BNI" {{ old('bank_name') == 'BNI' ? 'selected' : '' }}>BNI</option>
                                        <option value="BRI" {{ old('bank_name') == 'BRI' ? 'selected' : '' }}>BRI</option>
                                        <option value="CIMB Niaga" {{ old('bank_name') == 'CIMB Niaga' ? 'selected' : '' }}>CIMB Niaga</option>
                                        <option value="Danamon" {{ old('bank_name') == 'Danamon' ? 'selected' : '' }}>Danamon</option>
                                        <option value="Permata" {{ old('bank_name') == 'Permata' ? 'selected' : '' }}>Permata</option>
                                        <option value="BSI" {{ old('bank_name') == 'BSI' ? 'selected' : '' }}>BSI</option>
                                        <option value="BTN" {{ old('bank_name') == 'BTN' ? 'selected' : '' }}>BTN</option>
                                    </select>
                                    @error('bank_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="form-label" for="account_number">
                                        Nomor Rekening<span class="required">*</span>
                                    </label>
                                    <input type="text" 
                                        name="account_number" 
                                        id="account_number" 
                                        class="form-input @error('account_number') is-invalid @enderror" 
                                        value="{{ old('account_number') }}"
                                        placeholder="Contoh: 1234567890"
                                        required>
                                    @error('account_number')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="form-label" for="account_holder_name">
                                        Nama Pemilik Rekening<span class="required">*</span>
                                    </label>
                                    <input type="text" 
                                        name="account_holder_name" 
                                        id="account_holder_name" 
                                        class="form-input @error('account_holder_name') is-invalid @enderror" 
                                        value="{{ old('account_holder_name', Auth::user()->name) }}"
                                        placeholder="Sesuai dengan rekening bank"
                                        required>
                                    <div class="form-help">Pastikan nama sesuai dengan yang tertera di rekening bank</div>
                                    @error('account_holder_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="alert alert-info">
                                <i class="fas fa-info-circle"></i>
                                <div>
                                    <strong>Informasi Penting:</strong><br>
                                    • Penarikan akan diproses dalam 1-3 hari kerja<br>
                                    • Pastikan data rekening bank sudah benar untuk menghindari kesalahan transfer<br>
                                    • Anda hanya dapat mengajukan 1 penarikan dalam satu waktu<br>
                                    • Dana akan ditransfer ke rekening yang Anda daftarkan
                                </div>
                            </div>

                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-paper-plane"></i> Ajukan Penarikan
                                </button>
                                <a href="{{ route('freelancer.withdrawals.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-times"></i> Batal
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </main>

            <!-- Sidebar -->
            <aside>
                <!-- Balance Card -->
                <div class="card balance-card">
                    <div class="card-content">
                        <div class="balance-header">
                            <div class="balance-icon">
                                <i class="fas fa-wallet"></i>
                            </div>
                            <h2 class="balance-title">Informasi Saldo</h2>
                        </div>
                        
                        <div class="balance-amount">{{ $wallet->formatted_balance }}</div>
                        <div class="balance-subtitle">
                            Saldo tersedia untuk ditarik
                        </div>
                        
                        <div class="balance-divider"></div>
                        
                        <div class="balance-item">
                            <div class="label">Saldo Dalam Proses</div>
                            <div class="value">Rp {{ number_format($wallet->pending_balance, 0, ',', '.') }}</div>
                        </div>
                    </div>
                </div>

                <!-- Info Card -->
                <div class="card info-card">
                    <div class="card-content">
                        <h3 style="font-size: 16px; font-weight: 600; margin: 0 0 16px; color: var(--gray-900); display: flex; align-items: center; gap: 8px;">
                            <i class="fas fa-exclamation-triangle" style="color: var(--primary);"></i>
                            Ketentuan Penarikan
                        </h3>
                        <ul class="info-list">
                            <li>Minimum penarikan adalah <strong>Rp 50.000</strong></li>
                            <li>Penarikan akan diproses dalam <strong>1-3 hari kerja</strong></li>
                            <li>Pastikan data rekening bank Anda <strong>sudah benar</strong></li>
                            <li>Anda hanya dapat mengajukan <strong>1 penarikan dalam satu waktu</strong></li>
                            <li>Dana akan ditransfer ke rekening yang Anda daftarkan</li>
                        </ul>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
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

    // Form validation feedback
    const amountInput = document.getElementById('amount');
    const helpText = amountInput.parentNode.nextElementSibling;
    const maxAmount = {{ $wallet->balance }};
    
    amountInput.addEventListener('input', function() {
        const value = parseInt(this.value) || 0;
        
        if (value > 0 && value < 50000) {
            helpText.style.color = 'var(--error)';
            helpText.innerHTML = '<i class="fas fa-exclamation-circle"></i> Minimum penarikan: Rp 50.000';
        } else if (value > maxAmount) {
            helpText.style.color = 'var(--error)';
            helpText.innerHTML = '<i class="fas fa-exclamation-circle"></i> Jumlah melebihi saldo tersedia';
        } else {
            helpText.style.color = 'var(--gray-500)';
            helpText.innerHTML = 'Minimum penarikan: Rp 50.000 | Maksimum: {{ $wallet->formatted_balance }}';
        }
    });

    // Add loading states to buttons
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

    // Form submit loading state
    const form = document.querySelector('form');
    form.addEventListener('submit', function(e) {
        const submitBtn = this.querySelector('button[type="submit"]');
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memproses...';
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

    // Auto-format account number (remove non-numeric characters)
    const accountNumberInput = document.getElementById('account_number');
    accountNumberInput.addEventListener('input', function() {
        this.value = this.value.replace(/[^0-9]/g, '');
    });

    // Bank selection indicator
    const bankSelect = document.getElementById('bank_name');
    bankSelect.addEventListener('change', function() {
        if (this.value) {
            this.style.borderColor = 'var(--success)';
            setTimeout(() => {
                this.style.borderColor = '';
            }, 1000);
        }
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

    // Show success message animation if redirected from success
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('success')) {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }
});
</script>
@endpush
@endsection