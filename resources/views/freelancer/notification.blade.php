@extends('freelancer.layout.freelancer-layout') 
@section('title', 'Notifikasi - CariFreelance') 
@section('content')
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: #f5f7fa;
            color: #2d3748;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
            padding: 40px 20px;
        }

        .header {
            margin-bottom: 30px;
        }

        .header h1 {
            font-size: 28px;
            font-weight: 700;
            color: #1a202c;
            margin-bottom: 8px;
        }

        .header p {
            color: #718096;
            font-size: 14px;
        }

        .tabs {
            display: flex;
            gap: 8px;
            margin-bottom: 20px;
            overflow-x: auto;
            padding-bottom: 2px;
        }

        .tab {
            padding: 10px 20px;
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            color: #4a5568;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            white-space: nowrap;
            transition: all 0.2s;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .tab:hover {
            background: #f7fafc;
            border-color: #1d9bf0;
        }

        .tab.active {
            background: #1d9bf0;
            color: white;
            border-color: #1d9bf0;
        }

        .badge {
            background: #e53e3e;
            color: white;
            font-size: 11px;
            padding: 2px 6px;
            border-radius: 10px;
            font-weight: 600;
        }

        .tab.active .badge {
            background: rgba(255,255,255,0.3);
        }

        .actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .btn {
            padding: 10px 16px;
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            color: #4a5568;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .btn:hover {
            background: #f7fafc;
            border-color: #cbd5e0;
        }

        .btn-primary {
            background: #1d9bf0;
            color: white;
            border-color: #1d9bf0;
        }

        .btn-primary:hover {
            background: #1a8cd8;
        }

        .notification-list {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }

        .notification {
            padding: 20px;
            border-bottom: 1px solid #f7fafc;
            cursor: pointer;
            transition: background 0.2s;
            position: relative;
        }

        .notification:hover {
            background: #f7fafc;
        }

        .notification:last-child {
            border-bottom: none;
        }

        .notification.unread {
            background: #eff6ff;
        }

        .notification.unread::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 4px;
            background: #1d9bf0;
        }

        .notif-content {
            display: flex;
            gap: 16px;
        }

        .notif-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            font-size: 18px;
        }

        .notif-icon.success { background: #d1fae5; color: #059669; }
        .notif-icon.error { background: #fee2e2; color: #dc2626; }
        .notif-icon.warning { background: #fed7aa; color: #d97706; }
        .notif-icon.info { background: #dbeafe; color: #1d4ed8; }

        .notif-body {
            flex: 1;
        }

        .notif-title {
            font-weight: 600;
            font-size: 15px;
            color: #1a202c;
            margin-bottom: 4px;
        }

        .notif-message {
            font-size: 14px;
            color: #4a5568;
            line-height: 1.5;
            margin-bottom: 8px;
        }

        .notif-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .notif-time {
            font-size: 12px;
            color: #a0aec0;
        }

        .notif-actions {
            display: flex;
            gap: 8px;
            opacity: 0;
            transition: opacity 0.2s;
        }

        .notification:hover .notif-actions {
            opacity: 1;
        }

        .btn-action {
            padding: 6px 12px;
            background: #1d9bf0;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 12px;
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
        }

        .btn-action:hover {
            background: #1a8cd8;
        }

        .btn-action.secondary {
            background: #e2e8f0;
            color: #4a5568;
        }

        .btn-action.secondary:hover {
            background: #cbd5e0;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
        }

        .empty-state i {
            font-size: 48px;
            color: #cbd5e0;
            margin-bottom: 16px;
        }

        .empty-state h3 {
            font-size: 18px;
            color: #4a5568;
            margin-bottom: 8px;
        }

        .empty-state p {
            font-size: 14px;
            color: #a0aec0;
        }

        @media (max-width: 768px) {
            .container {
                padding: 20px 10px;
            }

            .header h1 {
                font-size: 24px;
            }

            .actions {
                flex-direction: column;
                gap: 10px;
                align-items: stretch;
            }

            .notif-content {
                gap: 12px;
            }

            .notif-footer {
                flex-direction: column;
                align-items: flex-start;
                gap: 8px;
            }

            .notif-actions {
                opacity: 1;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>Notifikasi</h1>
            <p>Update terbaru dari proyek dan proposal Anda</p>
        </div>

        <!-- Filter Tabs -->
        <div class="tabs">
            <a href="{{ route('notifications.index') }}" class="tab {{ $filter === 'all' ? 'active' : '' }}">
                <i class="fas fa-inbox"></i> Semua
                @if($stats['total'] > 0)
                <span class="badge">{{ $stats['total'] }}</span>
                @endif
            </a>
            <a href="{{ route('notifications.index', ['filter' => 'unread']) }}" class="tab {{ $filter === 'unread' ? 'active' : '' }}">
                <i class="fas fa-envelope"></i> Belum Dibaca
                @if($stats['unread'] > 0)
                <span class="badge">{{ $stats['unread'] }}</span>
                @endif
            </a>
            <a href="{{ route('notifications.index', ['filter' => 'proposals']) }}" class="tab {{ $filter === 'proposals' ? 'active' : '' }}">
                <i class="fas fa-briefcase"></i> Proposal
            </a>
            <a href="{{ route('notifications.index', ['filter' => 'projects']) }}" class="tab {{ $filter === 'projects' ? 'active' : '' }}">
                <i class="fas fa-folder"></i> Proyek
            </a>
            <a href="{{ route('notifications.index', ['filter' => 'payments']) }}" class="tab {{ $filter === 'payments' ? 'active' : '' }}">
                <i class="fas fa-wallet"></i> Pembayaran
            </a>
        </div>

        <!-- Actions -->
        <div class="actions">
            <div style="color: #718096; font-size: 14px;">
                {{ $stats['unread'] }} belum dibaca dari {{ $stats['total'] }} total
            </div>
            <button class="btn btn-primary mark-all-read">
                <i class="fas fa-check-double"></i> Tandai Semua Dibaca
            </button>
        </div>

        <!-- Notification List -->
        <div class="notification-list">
            @forelse($notifications as $notification)
            <div class="notification {{ !$notification->is_read ? 'unread' : '' }}" data-id="{{ $notification->id }}">
                <div class="notif-content">
                    @if($notification->type === 'proposal_accepted')
                        <div class="notif-icon success">
                            <i class="fas fa-check-circle"></i>
                        </div>
                    @elseif($notification->type === 'proposal_rejected')
                        <div class="notif-icon error">
                            <i class="fas fa-times-circle"></i>
                        </div>
                    @elseif($notification->type === 'project_revision')
                        <div class="notif-icon warning">
                            <i class="fas fa-edit"></i>
                        </div>
                    @elseif($notification->type === 'payment_received')
                        <div class="notif-icon success">
                            <i class="fas fa-money-bill-wave"></i>
                        </div>
                    @elseif($notification->type === 'project_approved')
                        <div class="notif-icon success">
                            <i class="fas fa-thumbs-up"></i>
                        </div>
                    @else
                        <div class="notif-icon info">
                            <i class="fas fa-info-circle"></i>
                        </div>
                    @endif
                    
                    <div class="notif-body">
                        <div class="notif-title">{{ $notification->title }}</div>
                        <div class="notif-message">{{ $notification->message }}</div>
                        <div class="notif-footer">
                            <div class="notif-time">
                                <i class="fas fa-clock"></i> {{ $notification->time_ago }}
                            </div>
                            <div class="notif-actions">
                                @if($notification->action_url !== '#')
                                <a href="{{ $notification->action_url }}" class="btn-action">
                                    @if($notification->type === 'proposal_accepted')
                                        Mulai Kerja
                                    @elseif($notification->type === 'project_revision')
                                        Lihat Revisi
                                    @elseif($notification->type === 'payment_received')
                                        Lihat Saldo
                                    @else
                                        Lihat
                                    @endif
                                </a>
                                @endif
                                @if(!$notification->is_read)
                                <button class="btn-action secondary mark-read" data-id="{{ $notification->id }}">
                                    <i class="fas fa-check"></i>
                                </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="empty-state">
                <i class="fas fa-bell-slash"></i>
                <h3>Belum Ada Notifikasi</h3>
                <p>Notifikasi akan muncul di sini saat ada update dari client</p>
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($notifications->hasPages())
        <div style="margin-top: 20px;">
            {{ $notifications->links() }}
        </div>
        @endif
    </div>

    <script>
        const token = '{{ csrf_token() }}';
        
        // Mark all as read
        document.querySelector('.mark-all-read')?.addEventListener('click', async function() {
            if (!confirm('Tandai semua notifikasi sebagai sudah dibaca?')) return;
            
            try {
                const res = await fetch('{{ route("notifications.mark-all-read") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token
                    }
                });
                
                if (res.ok) {
                    location.reload();
                }
            } catch (err) {
                alert('Gagal menandai notifikasi');
            }
        });

        // Mark single as read
        document.querySelectorAll('.mark-read').forEach(btn => {
            btn.addEventListener('click', async function(e) {
                e.stopPropagation();
                const id = this.dataset.id;
                
                try {
                    const res = await fetch(`/notifications/${id}/read`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': token
                        }
                    });
                    
                    if (res.ok) {
                        const notif = this.closest('.notification');
                        notif.classList.remove('unread');
                        this.remove();
                    }
                } catch (err) {
                    alert('Gagal menandai notifikasi');
                }
            });
        });

        // Click notification to view
        document.querySelectorAll('.notification').forEach(notif => {
            notif.addEventListener('click', function(e) {
                if (e.target.closest('.btn-action')) return;
                
                const link = this.querySelector('a.btn-action');
                if (link) {
                    window.location.href = link.href;
                }
            });
        });
    </script>
</body>
</html>
@endsection