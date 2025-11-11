@extends('client.layout.client-layout')
@section('title', 'Pembayaran Tertunda - CariFreelance')
@section('content')
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Tertunda</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        .container1 {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            min-height: 60vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .pending-card {
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 16px;
            padding: 48px 32px;
            text-align: center;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            width: 100%;
        }
        
        .pending-icon {
            width: 80px;
            height: 80px;
            background: #eab308;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 24px;
            animation: pulse 2s infinite;
        }
        
        .pending-icon i {
            color: white;
            font-size: 2.5rem;
        }
        
        @keyframes pulse {
            0% { box-shadow: 0 0 0 0 rgba(234, 179, 8, 0.7); }
            70% { box-shadow: 0 0 0 10px rgba(234, 179, 8, 0); }
            100% { box-shadow: 0 0 0 0 rgba(234, 179, 8, 0); }
        }
        
        .pending-title {
            font-size: 2rem;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 16px;
        }
        
        .pending-message {
            color: #6b7280;
            font-size: 1.1rem;
            line-height: 1.6;
            margin-bottom: 32px;
        }
        
        .payment-details {
            background: #fef3c7;
            border-radius: 12px;
            padding: 24px;
            margin: 32px 0;
            text-align: left;
            border: 1px solid #fde68a;
        }
        
        .payment-details h3 {
            color: #92400e;
            font-size: 1.1rem;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .detail-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid #fde68a;
        }
        
        .detail-row:last-child {
            border-bottom: none;
            font-weight: 600;
            color: #92400e;
            font-size: 1.1rem;
        }
        
        .detail-label {
            color: #92400e;
            font-size: 0.875rem;
        }
        
        .detail-value {
            color: #92400e;
            font-weight: 500;
            font-size: 0.875rem;
        }
        
        .status-check {
            background: #f0f9ff;
            border-radius: 12px;
            padding: 20px;
            margin: 24px 0;
            text-align: left;
        }
        
        .status-check h4 {
            color: #1d4ed8;
            margin-bottom: 12px;
            font-size: 1rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .status-check p {
            color: #4b5563;
            font-size: 0.875rem;
            line-height: 1.6;
            margin-bottom: 16px;
        }
        
        .auto-check {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #f8fafc;
            padding: 12px 16px;
            border-radius: 8px;
            border: 1px solid #e2e8f0;
        }
        
        .auto-check-text {
            color: #6b7280;
            font-size: 0.875rem;
        }
        
        .spinner {
            border: 2px solid #f3f3f3;
            border-top: 2px solid #1d4ed8;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            animation: spin 1s linear infinite;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        .action-buttons {
            display: flex;
            gap: 16px;
            justify-content: center;
            flex-wrap: wrap;
        }
        
        .btn {
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s ease;
            font-size: 0.875rem;
        }
        
        .btn-primary {
            background: #1d4ed8;
            color: white;
        }
        
        .btn-primary:hover {
            background: #1e40af;
            color: white;
        }
        
        .btn-secondary {
            background: #f3f4f6;
            color: #374151;
            border: 1px solid #d1d5db;
        }
        
        .btn-secondary:hover {
            background: #e5e7eb;
            color: #374151;
        }
        
        .instructions {
            background: #f9fafb;
            border-radius: 12px;
            padding: 20px;
            margin: 24px 0;
            text-align: left;
        }
        
        .instructions h4 {
            color: #1f2937;
            margin-bottom: 12px;
            font-size: 1rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .instructions ul {
            color: #4b5563;
            font-size: 0.875rem;
            line-height: 1.6;
            margin: 0;
            padding-left: 20px;
        }
        
        .instructions li {
            margin-bottom: 8px;
        }
        
        @media (max-width: 768px) {
            .container1 {
                padding: 16px;
            }
            
            .pending-card {
                padding: 32px 20px;
            }
            
            .action-buttons {
                flex-direction: column;
            }
            
            .btn {
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <div class="container1">
        <div class="pending-card">
            <div class="pending-icon">
                <i class="bi bi-clock-history"></i>
            </div>
            
            <h1 class="pending-title">Pembayaran Tertunda</h1>
            
            <p class="pending-message">
                Pembayaran Anda sedang diproses. Silakan selesaikan pembayaran melalui metode yang Anda pilih.
                Status akan otomatis terupdate setelah pembayaran berhasil.
            </p>
            
            <div class="payment-details">
                <h3>
                    <i class="bi bi-receipt"></i>
                    Detail Pembayaran
                </h3>
                
                <div class="detail-row">
                    <span class="detail-label">ID Pembayaran</span>
                    <span class="detail-value">{{ $payment->payment_id }}</span>
                </div>
                
                <div class="detail-row">
                    <span class="detail-label">Proyek</span>
                    <span class="detail-value">{{ $payment->project->title }}</span>
                </div>
                
                <div class="detail-row">
                    <span class="detail-label">Freelancer</span>
                    <span class="detail-value">{{ $payment->freelancer->name }}</span>
                </div>
                
                <div class="detail-row">
                    <span class="detail-label">Tanggal Order</span>
                    <span class="detail-value">{{ $payment->created_at->format('d F Y, H:i') }} WIB</span>
                </div>
                
                <div class="detail-row">
                    <span class="detail-label">Total Pembayaran</span>
                    <span class="detail-value">Rp {{ number_format($payment->amount, 0, ',', '.') }}</span>
                </div>
            </div>
            
            <div class="status-check">
                <h4>
                    <i class="bi bi-arrow-clockwise"></i>
                    Pengecekan Status Otomatis
                </h4>
                <p>
                    Sistem akan secara otomatis mengecek status pembayaran Anda setiap beberapa detik. 
                    Anda akan diarahkan ke halaman sukses begitu pembayaran berhasil dikonfirmasi.
                </p>
                
                <div class="auto-check">
                    <span class="auto-check-text">Mengecek status pembayaran...</span>
                    <div class="spinner"></div>
                </div>
            </div>
            
            <div class="instructions">
                <h4>
                    <i class="bi bi-info-circle"></i>
                    Instruksi Pembayaran
                </h4>
                <ul>
                    <li>Selesaikan pembayaran melalui metode yang telah Anda pilih</li>
                    <li>Tunggu konfirmasi dari bank/payment gateway</li>
                    <li>Status akan otomatis terupdate dalam beberapa menit</li>
                    <li>Jika ada masalah, silakan hubungi customer support</li>
                </ul>
            </div>
            
            <div class="action-buttons">
                <button onclick="checkPaymentStatus()" class="btn btn-primary">
                    <i class="bi bi-arrow-clockwise"></i>
                    Cek Status Manual
                </button>
                <a href="{{ route('projek') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i>
                    Kembali ke Job Board
                </a>
            </div>
        </div>
    </div>
    
    <script>
        let checkInterval;
        
        function checkPaymentStatus() {
            const paymentId = '{{ $payment->payment_id }}';
            
            fetch(`/payment/${paymentId}/check-status`, {
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    if (data.payment_status === 'success') {
                        window.location.href = data.redirect_url;
                    } else if (data.payment_status === 'failed') {
                        window.location.href = data.redirect_url;
                    }
                    // Jika masih pending, tetap di halaman ini
                }
            })
            .catch(error => {
                console.error('Error checking payment status:', error);
            });
        }
        
        // Auto check every 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            checkInterval = setInterval(checkPaymentStatus, 5000);
        });
        
        // Stop checking when page is hidden
        document.addEventListener('visibilitychange', function() {
            if (document.hidden) {
                if (checkInterval) {
                    clearInterval(checkInterval);
                }
            } else {
                checkInterval = setInterval(checkPaymentStatus, 5000);
            }
        });
        
        // Cleanup interval on page unload
        window.addEventListener('beforeunload', function() {
            if (checkInterval) {
                clearInterval(checkInterval);
            }
        });
    </script>
</body>
</html>
@endsection