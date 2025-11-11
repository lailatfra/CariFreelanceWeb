@extends('client.layout.client-layout')
@section('title', 'Pembayaran Freelancer - CariFreelance')
@section('content')
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran - {{ $proposal->user->name }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <style>
        .container1 {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        
        .header {
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 24px;
            margin-bottom: 24px;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.06);
        }
        
        .profile-section {
            display: flex;
            align-items: center;
            gap: 24px;
            margin-bottom: 16px;
        }
        
        .profile-avatar {
            width: 100px;
            height: 100px;
            border-radius: 8px;
            background: #1d4ed8;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 36px;
            font-weight: bold;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }
        
        .profile-info h1 {
            font-size: 1.8rem;
            font-weight: 600;
            margin-bottom: 8px;
            color: #1f2937;
        }
        
        .profile-info .title {
            font-size: 1rem;
            color: #6b7280;
            margin-bottom: 12px;
        }
        
        .verified-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #dbeafe;
            color: #1d4ed8;
            padding: 6px 12px;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
        }
        
        .main-content1 {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 24px;
        }
        
        .card {
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.06);
        }
        
        .card h2 {
            font-size: 1.25rem;
            margin-bottom: 16px;
            color: #1f2937;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .card h2 i {
            color: #1d4ed8;
            font-size: 1.1rem;
        }
        
        .payment-showcase {
            background: #f0f9ff;
            border-radius: 6px;
            padding: 16px;
            margin: 16px 0;
            border-left: 4px solid #1d4ed8;
        }
        
        .payment-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 12px;
        }
        
        .payment-description {
            color: #4b5563;
            line-height: 1.6;
            margin-bottom: 12px;
            font-size: 0.875rem;
        }
        
        .pricing-section {
            text-align: center;
            background: #059669;
            color: white;
            border-radius: 6px;
            padding: 20px;
            margin: 20px 0;
        }
        
        .price {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 8px;
        }
        
        .price-label {
            font-size: 0.875rem;
            opacity: 0.9;
            margin-bottom: 12px;
        }
        
        .btn-primary {
            background: #1d4ed8;
            color: white;
            padding: 12px 20px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: background-color 0.2s ease;
            border: none;
            cursor: pointer;
            font-size: 0.875rem;
            width: 100%;
        }
        
        .btn-primary:hover {
            background: #1e40af;
        }
        
        .btn-primary:disabled {
            background: #9ca3af;
            cursor: not-allowed;
        }
        
        .payment-loading {
            display: none;
            text-align: center;
            padding: 20px;
            color: #6b7280;
        }
        
        .payment-loading.show {
            display: block;
        }
        
        .spinner {
            border: 2px solid #f3f3f3;
            border-top: 2px solid #1d4ed8;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            animation: spin 1s linear infinite;
            display: inline-block;
            margin-right: 8px;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        .project-info {
            background: #f8fafc;
            padding: 16px;
            border-radius: 8px;
            margin: 16px 0;
        }
        
        .project-info h4 {
            color: #1f2937;
            margin-bottom: 12px;
            font-size: 1rem;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        
        .project-details {
            color: #6b7280;
            font-size: 0.875rem;
            line-height: 1.5;
            margin-bottom: 8px;
        }
        
        .security-note {
            background: #fef3c7;
            border-left: 4px solid #eab308;
            padding: 12px;
            border-radius: 6px;
            margin: 16px 0;
        }
        
        .security-note h4 {
            color: #92400e;
            margin-bottom: 8px;
            font-size: 0.875rem;
            font-weight: 600;
        }
        
        .security-note p {
            color: #92400e;
            font-size: 0.75rem;
            margin: 0;
            line-height: 1.4;
        }
        
        .payment-guarantee {
            background: #dcfce7;
            border-left: 4px solid #10b981;
            padding: 12px;
            border-radius: 6px;
            margin: 16px 0;
        }
        
        .payment-guarantee h4 {
            color: #065f46;
            margin-bottom: 8px;
            font-size: 0.875rem;
            font-weight: 600;
        }
        
        .payment-guarantee p {
            color: #065f46;
            font-size: 0.75rem;
            margin: 0;
            line-height: 1.4;
        }
        
        @media (max-width: 768px) {
            .main-content1 {
                grid-template-columns: 1fr;
            }
            
            .profile-section {
                flex-direction: column;
                text-align: center;
            }
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
.payment-invoice {
    background: #ffffff;
    border: 2px solid #f1f5f9;
    border-radius: 12px;
    overflow: hidden;
    margin-bottom: 20px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
}

.invoice-header {
    background: #f8fafc;
    border-bottom: 1px solid #e2e8f0;
    padding: 20px 24px;
    text-align: center;
}

.invoice-title {
    font-size: 1.2rem;
    font-weight: 700;
    color: #1e293b;
    margin: 0 0 4px 0;
}

.invoice-subtitle {
    font-size: 0.875rem;
    color: #64748b;
    margin: 0;
}

.invoice-body {
    padding: 24px;
}

.invoice-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 16px 0;
    border-bottom: 1px solid #f1f5f9;
    font-size: 0.95rem;
}

.invoice-row:last-child {
    border-bottom: none;
}

.invoice-row.total-row {
    border-top: 2px solid #e2e8f0;
    padding: 20px 0 0 0;
    margin-top: 16px;
    font-weight: 600;
    font-size: 1.1rem;
    color: #1e293b;
}

.row-label {
    display: flex;
    align-items: center;
    gap: 10px;
    color: #475569;
}

.row-label i {
    width: 18px;
    height: 18px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #64748b;
    font-size: 0.9rem;
}

.row-value {
    color: #1e293b;
    font-weight: 500;
}

.total-row .row-label {
    color: #1e293b;
    font-weight: 600;
}

.total-row .row-value {
    color: #059669;
    font-weight: 700;
    font-size: 1.25rem;
}

/* Admin Fee Badge */
.fee-badge {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    background: #f0f9ff;
    color: #0369a1;
    padding: 3px 8px;
    border-radius: 6px;
    font-size: 0.7rem;
    font-weight: 600;
    margin-left: 8px;
}

.fee-badge i {
    font-size: 0.6rem;
}

/* Info Note */
.payment-info {
    background: #fef7cd;
    border: 1px solid #fde047;
    border-radius: 8px;
    padding: 16px;
    margin-top: 16px;
    font-size: 0.85rem;
    color: #a16207;
    display: flex;
    align-items: flex-start;
    gap: 10px;
}

.payment-info i {
    color: #ca8a04;
    margin-top: 2px;
    flex-shrink: 0;
}

/* Button Styles - Update existing */
.btn-primary {
    background: linear-gradient(135deg, #1d4ed8 0%, #2563eb 100%);
    color: white;
    padding: 16px 24px;
    border-radius: 10px;
    text-decoration: none;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
    font-size: 0.95rem;
    width: 100%;
    box-shadow: 0 4px 14px rgba(29, 78, 216, 0.25);
}

.btn-primary:hover {
    transform: translateY(-1px);
    box-shadow: 0 6px 20px rgba(29, 78, 216, 0.35);
}

.btn-primary:disabled {
    background: #9ca3af;
    cursor: not-allowed;
    transform: none;
    box-shadow: none;
}

/* Loading Animation - Update existing */
.payment-loading {
    display: none;
    text-align: center;
    padding: 16px;
    color: #6b7280;
    font-size: 0.9rem;
}

.payment-loading.show {
    display: block;
}

.spinner {
    border: 2px solid #f3f3f3;
    border-top: 2px solid #1d4ed8;
    border-radius: 50%;
    width: 18px;
    height: 18px;
    animation: spin 1s linear infinite;
    display: inline-block;
    margin-right: 8px;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

/* Back Link - Update existing */
.back-link {
    text-align: center;
    margin-top: 16px;
}

.back-link a {
    color: #64748b;
    font-size: 0.875rem;
    text-decoration: none;
    transition: color 0.2s ease;
    display: inline-flex;
    align-items: center;
    gap: 6px;
}

.back-link a:hover {
    color: #1d4ed8;
}

/* Responsive Design */
@media (max-width: 768px) {
    .invoice-body {
        padding: 16px;
    }
    
    .invoice-row {
        padding: 12px 0;
        font-size: 0.9rem;
    }
    
    .total-row .row-value {
        font-size: 1.1rem;
    }
    
    .payment-info {
        font-size: 0.8rem;
        padding: 12px;
    }
}

    </style>
    
    <!-- Midtrans Snap.js -->
    <script type="text/javascript"
            src="https://app.sandbox.midtrans.com/snap/snap.js"
            data-client-key="{{ config('midtrans.client_key') }}"></script>
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
    <div class="container1">
        <!-- Header Section -->
        <div class="header">
            <div class="profile-section">
                <div class="profile-avatar">
                    {{ strtoupper(substr($proposal->user->name, 0, 2)) }}
                </div>
                <div class="profile-info">
                    <h1>Pembayaran untuk {{ $proposal->user->name }}</h1>
                    <p class="title">{{ optional($proposal->user->freelancerProfile)->title ?? 'Freelancer' }}</p>
                    <div style="display: flex; align-items: center; gap: 12px; flex-wrap: wrap;">
                        <span class="verified-badge">
                            <i class="bi bi-shield-check"></i>
                            Verified
                        </span>
                        <span style="color: #10b981; font-weight: 600; font-size: 0.875rem; display: flex; align-items: center; gap: 4px;">
                            <i class="bi bi-circle-fill" style="font-size: 0.5rem;"></i>
                            Siap Bekerja
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-content1">
            <!-- Left Column -->
            <div>
                <!-- Project Details -->
                <div class="card">
                    <h2><i class="bi bi-briefcase"></i> Detail Proyek</h2>
                    <div class="payment-showcase">
                        <div class="payment-title">{{ $proposal->project->title }}</div>
                        <div class="payment-description">
                            {{ $proposal->proposal_description }}
                        </div>
                    </div>
                    
                    <div class="project-info">
                        <h4><i class="bi bi-info-circle"></i> Informasi Proyek</h4>
                        <div class="project-details">
                            <strong>Kategori:</strong> {{ $proposal->project->category }}<br>
                            <strong>Timeline:</strong> {{ $proposal->project->timeline_duration ?? '-' }} Minggu<br>
                            <strong>Tingkat Pengalaman:</strong> {{ ucfirst($proposal->project->experience_level ?? 'Intermediate') }}
                        </div>
                    </div>
                </div>

                <!-- Proposal Details -->
                @if($proposal->experience || $proposal->additional_message)
                <div class="card">
                    <h2><i class="bi bi-trophy"></i> Detail Proposal</h2>
                    
                    @if($proposal->experience)
                    <div style="margin-bottom: 16px;">
                        <h4 style="color: #1f2937; margin-bottom: 8px;">Pengalaman Relevan</h4>
                        <p style="color: #4b5563; line-height: 1.6; font-size: 0.875rem;">{{ $proposal->experience }}</p>
                    </div>
                    @endif
                    
                    @if($proposal->additional_message)
                    <div>
                        <h4 style="color: #1f2937; margin-bottom: 8px;">Pesan dari Freelancer</h4>
                        <p style="color: #4b5563; line-height: 1.6; font-size: 0.875rem;">{{ $proposal->additional_message }}</p>
                    </div>
                    @endif
                </div>
                @endif

                <!-- Security Information -->
                <div class="card">
                    <h2><i class="bi bi-shield-check"></i> Keamanan Pembayaran</h2>
                    
                    <div class="security-note">
                        <h4><i class="bi bi-lock"></i> Pembayaran Aman</h4>
                        <p>Transaksi Anda dilindungi dengan enkripsi SSL dan diproses melalui Midtrans, payment gateway terpercaya di Indonesia.</p>
                    </div>
                    
                    <div class="payment-guarantee">
                        <h4><i class="bi bi-check-circle"></i> Garansi Uang Kembali</h4>
                        <p>Jika freelancer tidak memenuhi komitmen, Anda berhak mendapatkan refund 100% sesuai dengan terms & conditions.</p>
                    </div>
                </div>
            </div>

            <!-- Right Column - Payment Section -->
            <div>
                <!-- Payment Summary -->
                <div class="card">
                    <h2><i class="bi bi-credit-card"></i> Ringkasan Pembayaran</h2>
                    
<div class="payment-invoice">
    <div class="invoice-header">
        <h3 class="invoice-title">Invoice Pembayaran</h3>
        <p class="invoice-subtitle">CariFreelance Platform</p>
    </div>
    
    <div class="invoice-body">
        <!-- Service Fee -->
        <div class="invoice-row">
            <div class="row-label">
                <i class="bi bi-briefcase"></i>
                <span>Jasa Freelancer</span>
            </div>
            <div class="row-value">Rp {{ number_format($serviceAmount, 0, ',', '.') }}</div>
        </div>
        
        <!-- Admin Fee -->
        <div class="invoice-row">
            <div class="row-label">
                <i class="bi bi-gear"></i>
                <span>Biaya Admin ({{ \App\Http\Controllers\PaymentController::ADMIN_FEE_PERCENTAGE }}%)</span>
                <span class="fee-badge">
                    <i class="bi bi-info-circle"></i>
                    Platform Fee
                </span>
            </div>
            <div class="row-value">Rp {{ number_format($adminFee, 0, ',', '.') }}</div>
        </div>
        
        <!-- Total -->
        <div class="invoice-row total-row">
            <div class="row-label">
                <i class="bi bi-calculator"></i>
                <span>Total Pembayaran</span>
            </div>
            <div class="row-value">Rp {{ number_format($totalAmount, 0, ',', '.') }}</div>
        </div>
    </div>
</div>

<div class="payment-info">
    <i class="bi bi-info-circle"></i>
    <div>
        <strong>Biaya Admin Platform:</strong><br>
        Biaya {{ \App\Http\Controllers\PaymentController::ADMIN_FEE_PERCENTAGE }}% digunakan untuk keamanan transaksi, pemeliharaan sistem, dan layanan pelanggan 24/7.
    </div>
</div>
    <div class="payment-loading" id="paymentLoading">
        <div class="spinner"></div>
        Memproses pembayaran...
    </div>
    
    <button type="button" id="payNowBtn" class="btn-primary">
        <i class="bi bi-credit-card"></i>
        Bayar Sekarang - Rp {{ number_format($totalAmount, 0, ',', '.') }}
    </button>
    
    <div class="back-link">
        <a href="{{ route('projek') }}">
            <i class="bi bi-arrow-left"></i> Kembali ke Job Board
        </a>
    </div>
    <!-- SAMPAI SINI -->
    
</div>
                
                <!-- Payment Methods -->
                <div class="card">
                    <h2><i class="bi bi-wallet"></i> Metode Pembayaran</h2>
                    <div style="color: #6b7280; font-size: 0.875rem; line-height: 1.5;">
                        <p>Kami menerima berbagai metode pembayaran:</p>
                        <ul style="margin: 12px 0; padding-left: 20px;">
                            <li>Kartu Kredit/Debit (Visa, Mastercard)</li>
                            <li>Bank Transfer (BCA, BNI, BRI, Mandiri)</li>
                            <li>E-Wallet (GoPay, OVO, DANA)</li>
                            <li>Virtual Account</li>
                            <li>Alfamart/Indomaret</li>
                        </ul>
                    </div>
                </div>

                <!-- Freelancer Info -->
                <div class="card">
                    <h2><i class="bi bi-person-check"></i> Info Freelancer</h2>
                    
                    <div style="background: #f8fafc; padding: 16px; border-radius: 8px;">
                        <h4 style="color: #1f2937; margin-bottom: 8px; font-size: 1rem;">{{ $proposal->user->name }}</h4>
                        <p style="color: #6b7280; font-size: 0.8rem; margin-bottom: 12px;">
                            {{ optional($proposal->user->freelancerProfile)->title ?? 'Professional Freelancer' }}
                        </p>
                        
                        @if($proposal->skills && count($proposal->skills) > 0)
                        <div style="margin-bottom: 12px;">
                            <span style="font-size: 0.75rem; color: #6b7280; margin-bottom: 6px; display: block;">Keahlian:</span>
                            <div style="display: flex; gap: 4px; flex-wrap: wrap;">
                                @foreach(array_slice($proposal->skills, 0, 3) as $skill)
                                    <span style="background: #f3f4f6; color: #374151; padding: 2px 6px; border-radius: 4px; font-size: 0.65rem;">{{ $skill }}</span>
                                @endforeach
                            </div>
                        </div>
                        @endif
                        
                        <div style="display: flex; justify-content: space-between; font-size: 0.75rem; color: #6b7280;">
                            <span><i class="bi bi-star-fill" style="color: #eab308;"></i> 4.9 (127 reviews)</span>
                            <span><i class="bi bi-folder"></i> 89 proyek</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script>
        document.addEventListener('DOMContentLoaded', function() {
            const payNowBtn = document.getElementById('payNowBtn');
            const paymentLoading = document.getElementById('paymentLoading');

            payNowBtn.addEventListener('click', function() {
                // Disable button and show loading
                payNowBtn.disabled = true;
                paymentLoading.classList.add('show');
                payNowBtn.innerHTML = '<div class="spinner"></div> Memproses...';

                // Process payment
                fetch(`{{ route('payment.process', $proposal) }}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Open Midtrans Snap popup
                        snap.pay(data.snap_token, {
                            onSuccess: function(result) {
                                console.log('Payment success:', result);
                                // Check payment status and redirect
                                checkPaymentStatus(data.payment_id);
                            },
                            onPending: function(result) {
                                console.log('Payment pending:', result);
                                window.location.href = `{{ url('/payment') }}/${data.payment_id}/pending`;
                            },
                            onError: function(result) {
                                console.log('Payment error:', result);
                                window.location.href = `{{ url('/payment') }}/${data.payment_id}/failed`;
                            },
                            onClose: function() {
                                console.log('Payment popup closed');
                                // Re-enable button
                                payNowBtn.disabled = false;
                                paymentLoading.classList.remove('show');
                                // Updated button text with total amount
                                payNowBtn.innerHTML = '<i class="bi bi-credit-card"></i> Bayar Sekarang - Rp {{ number_format($totalAmount, 0, ',', '.') }}';
                            }
                        });
                    } else {
                        alert('Gagal memproses pembayaran: ' + data.message);
                        // Re-enable button
                        payNowBtn.disabled = false;
                        paymentLoading.classList.remove('show');
                        // Updated button text with total amount
                        payNowBtn.innerHTML = '<i class="bi bi-credit-card"></i> Bayar Sekarang - Rp {{ number_format($totalAmount, 0, ',', '.') }}';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat memproses pembayaran');
                    // Re-enable button
                    payNowBtn.disabled = false;
                    paymentLoading.classList.remove('show');
                    // Updated button text with total amount
                    payNowBtn.innerHTML = '<i class="bi bi-credit-card"></i> Bayar Sekarang - Rp {{ number_format($totalAmount, 0, ',', '.') }}';
                });
            });

            function checkPaymentStatus(paymentId) {
                fetch(`{{ url('/payment') }}/${paymentId}/check-status`)
                .then(response => response.json())
                .then(data => {
                    if (data.success && data.redirect_url) {
                        window.location.href = data.redirect_url;
                    } else {
                        window.location.href = `{{ route('projek') }}`;
                    }
                })
                .catch(error => {
                    console.error('Error checking payment status:', error);
                    window.location.href = `{{ route('projek') }}`;
                });
            }
        });
    </script>
</body>
</html>
@endsection