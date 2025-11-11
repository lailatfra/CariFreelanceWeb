@extends('client.layout.client-layout')
@section('title', 'Pembayaran Berhasil - CariFreelance')
@section('content')
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Berhasil</title>
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
        
        .success-card {
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 16px;
            padding: 48px 32px;
            text-align: center;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            width: 100%;
        }
        
        .success-icon {
            width: 80px;
            height: 80px;
            background: #10b981;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 24px;
            animation: pulse 2s infinite;
        }
        
        .success-icon i {
            color: white;
            font-size: 2.5rem;
        }
        
        @keyframes pulse {
            0% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7); }
            70% { box-shadow: 0 0 0 10px rgba(16, 185, 129, 0); }
            100% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0); }
        }
        
        .success-title {
            font-size: 2rem;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 16px;
        }
        
        .success-message {
            color: #6b7280;
            font-size: 1.1rem;
            line-height: 1.6;
            margin-bottom: 32px;
        }
        
        .payment-details {
            background: #f9fafb;
            border-radius: 12px;
            padding: 24px;
            margin: 32px 0;
            text-align: left;
        }
        
        .payment-details h3 {
            color: #1f2937;
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
            border-bottom: 1px solid #e5e7eb;
        }
        
        .detail-row:last-child {
            border-bottom: none;
            font-weight: 600;
            color: #10b981;
            font-size: 1.1rem;
        }
        
        .detail-label {
            color: #6b7280;
            font-size: 0.875rem;
        }
        
        .detail-value {
            color: #1f2937;
            font-weight: 500;
            font-size: 0.875rem;
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
        
        .next-steps {
            background: #dbeafe;
            border-radius: 12px;
            padding: 20px;
            margin: 24px 0;
            text-align: left;
        }
        
        .next-steps h4 {
            color: #1d4ed8;
            margin-bottom: 12px;
            font-size: 1rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .next-steps ul {
            color: #4b5563;
            font-size: 0.875rem;
            line-height: 1.6;
            margin: 0;
            padding-left: 20px;
        }
        
        .next-steps li {
            margin-bottom: 8px;
        }
        
        @media (max-width: 768px) {
            .container1 {
                padding: 16px;
            }
            
            .success-card {
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
        <div class="success-card">
            <div class="success-icon">
                <i class="bi bi-check-lg"></i>
            </div>
            
            <h1 class="success-title">Pembayaran Berhasil!</h1>
            
            <p class="success-message">
                Terima kasih! Pembayaran Anda telah berhasil diproses. 
                Freelancer <strong>{{ $payment->freelancer->name }}</strong> telah dipilih untuk mengerjakan proyek Anda.
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
                    <span class="detail-label">Tanggal Pembayaran</span>
                    <span class="detail-value">{{ $payment->paid_at->format('d F Y, H:i') }} WIB</span>
                </div>
                
                <div class="detail-row">
                    <span class="detail-label">Total Pembayaran</span>
                    <span class="detail-value">Rp {{ number_format($payment->amount, 0, ',', '.') }}</span>
                </div>
            </div>
            
            <div class="next-steps">
                <h4>
                    <i class="bi bi-list-check"></i>
                    Langkah Selanjutnya
                </h4>
                <ul>
                    <li>Freelancer akan segera memulai pekerjaan pada proyek Anda</li>
                    <li>Anda dapat memantau progress melalui halaman Job Board</li>
                    <li>Komunikasi dengan freelancer melalui fitur chat</li>
                    <li>Review dan approve hasil pekerjaan saat selesai</li>
                </ul>
            </div>
            
            <div class="action-buttons">
                <a href="{{ route('projek') }}" class="btn btn-primary">
                    <i class="bi bi-kanban"></i>
                    Lihat Job Board
                </a>
                <a href="#" onclick="openChat({{ $payment->project_id }})" class="btn btn-secondary">
                    <i class="bi bi-chat-dots"></i>
                    Chat dengan Freelancer
                </a>
            </div>
        </div>
    </div>
    
    <script>
        function openChat(projectId) {
            // Redirect to chat with freelancer
            window.location.href = `/chat/freelancer/${projectId}`;
        }
        
        // Show success notification
        setTimeout(() => {
            const notification = document.createElement('div');
            notification.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                background: #10b981;
                color: white;
                padding: 16px 20px;
                border-radius: 8px;
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
                z-index: 1000;
                font-weight: 600;
            `;
            notification.innerHTML = '<i class="bi bi-check-circle"></i> Freelancer berhasil dipilih!';
            document.body.appendChild(notification);
            
            setTimeout(() => {
                notification.remove();
            }, 5000);
        }, 500);
    </script>
</body>
</html>
@endsection