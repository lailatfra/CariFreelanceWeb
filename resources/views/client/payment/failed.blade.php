@extends('client.layout.client-layout')
@section('title', 'Pembayaran Gagal - CariFreelance')
@section('content')
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Gagal</title>
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
        
        .failed-card {
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 16px;
            padding: 48px 32px;
            text-align: center;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            width: 100%;
        }
        
        .failed-icon {
            width: 80px;
            height: 80px;
            background: #dc2626;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 24px;
        }
        
        .failed-icon i {
            color: white;
            font-size: 2.5rem;
        }
        
        .failed-title {
            font-size: 2rem;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 16px;
        }
        
        .failed-message {
            color: #6b7280;
            font-size: 1.1rem;
            line-height: 1.6;
            margin-bottom: 32px;
        }
        
        .payment-details {
            background: #fef2f2;
            border-radius: 12px;
            padding: 24px;
            margin: 32px 0;
            text-align: left;
            border: 1px solid #fecaca;
        }
        
        .payment-details h3 {
            color: #991b1b;
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
            border-bottom: 1px solid #fecaca;
        }
        
        .detail-row:last-child {
            border-bottom: none;
            font-weight: 600;
            color: #991b1b;
            font-size: 1.1rem;
        }
        
        .detail-label {
            color: #991b1b;
            font-size: 0.875rem;
        }
        
        .detail-value {
            color: #991b1b;
            font-weight: 500;
            font-size: 0.875rem;
        }
        
        .error-reasons {
            background: #f9fafb;
            border-radius: 12px;
            padding: 20px;
            margin: 24px 0;
            text-align: left;
        }
        
        .error-reasons h4 {
            color: #1f2937;
            margin-bottom: 12px;
            font-size: 1rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .error-reasons ul {
            color: #4b5563;
            font-size: 0.875rem;
            line-height: 1.6;
            margin: 0;
            padding-left: 20px;
        }
        
        .error-reasons li {
            margin-bottom: 8px;
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
        
        .btn-danger {
            background: #dc2626;
            color: white;
        }
        
        .btn-danger:hover {
            background: #b91c1c;
            color: white;
        }
        
        .help-section {
            background: #f0f9ff;
            border-radius: 12px;
            padding: 20px;
            margin: 24px 0;
            text-align: left;
        }
        
        .help-section h4 {
            color: #1d4ed8;
            margin-bottom: 12px;
            font-size: 1rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .help-section p {
            color: #4b5563;
            font-size: 0.875rem;
            line-height: 1.6;
            margin: 0;
        }
        
        .help-contact {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-top: 12px;
        }
        
        .contact-item {
            display: flex;
            align-items: center;
            gap: 6px;
            color: #1d4ed8;
            font-size: 0.875rem;
            text-decoration: none;
        }
        
        .contact-item:hover {
            color: #1e40af;
            text-decoration: underline;
        }
        
        @media (max-width: 768px) {
            .container1 {
                padding: 16px;
            }
            
            .failed-card {
                padding: 32px 20px;
            }
            
            .action-buttons {
                flex-direction: column;
            }
            
            .btn {
                justify-content: center;
            }
            
            .help-contact {
                flex-direction: column;
                align-items: flex-start;
                gap: 8px;
            }
        }
    </style>
</head>
<body>
    <div class="container1">
        <div class="failed-card">
            <div class="failed-icon">
                <i class="bi bi-x-lg"></i>
            </div>
            
            <h1 class="failed-title">Pembayaran Gagal</h1>
            
            <p class="failed-message">
                Maaf, terjadi masalah saat memproses pembayaran Anda. 
                Proposal freelancer masih tersedia dan Anda dapat mencoba melakukan pembayaran ulang.
            </p>
            
            <div class="payment-details">
                <h3>
                    <i class="bi bi-exclamation-triangle"></i>
                    Detail Transaksi Gagal
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
                    <span class="detail-label">Waktu Gagal</span>
                    <span class="detail-value">{{ $payment->updated_at->format('d F Y, H:i') }} WIB</span>
                </div>
                
                <div class="detail-row">
                    <span class="detail-label">Status</span>
                    <span class="detail-value">{{ strtoupper($payment->status) }}</span>
                </div>
            </div>
            
            <div class="error-reasons">
                <h4>
                    <i class="bi bi-question-circle"></i>
                    Kemungkinan Penyebab Gagal
                </h4>
                <ul>
                    <li>Saldo kartu/rekening tidak mencukupi</li>
                    <li>Koneksi internet terputus saat transaksi</li>
                    <li>Kartu kredit/debit diblokir atau expired</li>
                    <li>Informasi pembayaran yang dimasukkan salah</li>
                    <li>Batas transaksi harian terlampaui</li>
                    <li>Server bank sedang maintenance</li>
                </ul>
            </div>
            
            <div class="action-buttons">
                <a href="{{ route('payment.show', $payment->proposal) }}" class="btn btn-primary">
                    <i class="bi bi-arrow-clockwise"></i>
                    Coba Bayar Lagi
                </a>
                <a href="{{ route('freelancer.proposal.show', $payment->proposal) }}" class="btn btn-secondary">
                    <i class="bi bi-eye"></i>
                    Lihat Proposal
                </a>
                <a href="{{ route('projek') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i>
                    Kembali ke Job Board
                </a>
            </div>
            
            <div class="help-section">
                <h4>
                    <i class="bi bi-headset"></i>
                    Butuh Bantuan?
                </h4>
                <p>
                    Jika Anda mengalami kesulitan atau memerlukan bantuan lebih lanjut, 
                    tim customer support kami siap membantu Anda.
                </p>
                <div class="help-contact">
                    <a href="mailto:support@carifreelance.com" class="contact-item">
                        <i class="bi bi-envelope"></i>
                        support@carifreelance.com
                    </a>
                    <a href="tel:+6281234567890" class="contact-item">
                        <i class="bi bi-telephone"></i>
                        +62 812 3456 7890
                    </a>
                    <a href="#" class="contact-item">
                        <i class="bi bi-chat-dots"></i>
                        Live Chat
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        // Show error notification
        setTimeout(() => {
            const notification = document.createElement('div');
            notification.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                background: #dc2626;
                color: white;
                padding: 16px 20px;
                border-radius: 8px;
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
                z-index: 1000;
                font-weight: 600;
            `;
            notification.innerHTML = '<i class="bi bi-exclamation-triangle"></i> Pembayaran gagal diproses';
            document.body.appendChild(notification);
            
            setTimeout(() => {
                notification.remove();
            }, 5000);
        }, 500);
    </script>
</body>
</html>
@endsection