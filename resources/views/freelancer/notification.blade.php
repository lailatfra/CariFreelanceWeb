@extends('freelancer.layout.freelancer-layout') 
@section('title', 'Notifikasi - CariFreelance') 
@section('content')
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet"/>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: #f8f9fa;
            min-height: 100vh;
            padding: 20px 0;
        }

        .notification-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Navigation Categories */
        .nav-container {
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            position: sticky;
            top: -1px;
            z-index: 100;
            width: 100%;
            margin: 0 0 25px 0;
            padding: 0;
            transition: all 0.3s ease;
            border-radius: 16px;
        }

        .nav-container.scrolled {
            box-shadow: 0 4px 20px rgba(0,0,0,0.15);
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
            padding: 12px 0;
            gap: 30px;
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
            padding: 12px 20px;
            border-radius: 20px;
            transition: all 0.3s ease;
            font-weight: 500;
            color: #666;
            background: transparent;
            border: none;
            min-height: 40px;
            display: flex;
            align-items: center;
            flex-shrink: 0;
            position: relative;
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
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .nav-item:hover .nav-link,
        .nav-item.active .nav-link {
            color: #1DA1F2;
            text-shadow: 0 0 10px rgba(29, 161, 242, 0.6);
        }

        .nav-link i {
            font-size: 16px;
        }

        .nav-link .badge,
        .nav-link .badge-unread {
            background: rgba(239, 68, 68, 0.15);
            color: #ef4444;
            font-size: 11px;
            padding: 3px 8px;
            border-radius: 10px;
            font-weight: 700;
            margin-left: 4px;
        }

        .nav-item.active .nav-link .badge,
        .nav-item.active .nav-link .badge-unread {
            background: rgba(29, 161, 242, 0.2);
            color: #1DA1F2;
        }

        /* Search and Filter Bar */
        .filter-bar {
            background: white;
            border-radius: 16px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
            align-items: center;
        }

        .search-box {
            flex: 1;
            min-width: 250px;
            position: relative;
        }

        .search-box input {
            width: 100%;
            padding: 12px 45px 12px 45px;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            font-size: 14px;
            transition: all 0.3s;
        }

        .search-box input:focus {
            outline: none;
            border-color: #1DA1F2;
            box-shadow: 0 0 0 3px rgba(29, 161, 242, 0.1);
        }

        .search-box i {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
        }

        .clear-search {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #94a3b8;
            cursor: pointer;
            display: none;
        }

        .search-box input:not(:placeholder-shown) ~ .clear-search {
            display: block;
        }

        .sort-select {
            padding: 12px 40px 12px 16px;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            font-size: 14px;
            cursor: pointer;
            background: white;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%23475569' d='M6 9L1 4h10z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 12px center;
        }

        /* Action Bar */
        .action-bar {
            background: white;
            border-radius: 16px;
            padding: 16px 20px;
            margin-bottom: 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .info-text {
            color: #64748b;
            font-size: 14px;
            font-weight: 500;
        }

        .info-text strong {
            color: #1DA1F2;
            font-weight: 700;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s;
        }

        .btn-primary {
            background: linear-gradient(135deg, #1DA1F2 0%, #0d7ac9 50%, #1976d2 100%);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(29, 161, 242, 0.4);
        }

        .btn-secondary {
            background: #f1f5f9;
            color: #475569;
        }

        .btn-secondary:hover {
            background: #e2e8f0;
        }

        /* Notification List */
        .notification-list {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }

        .notification {
            padding: 24px;
            border-bottom: 1px solid #f1f5f9;
            cursor: pointer;
            transition: all 0.3s;
            position: relative;
        }

        .notification:hover {
            background: #fafbfc;
            transform: translateX(4px);
        }

        .notification:last-child {
            border-bottom: none;
        }

        .notification.unread {
            background: linear-gradient(90deg, #eff6ff 0%, #fff 100%);
        }

        .notification.unread::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 4px;
            background: linear-gradient(135deg, #1DA1F2 0%, #0d7ac9 50%, #1976d2 100%);
        }

        .notification.selected {
            background: #f8fafc;
            border-left: 4px solid #1DA1F2;
        }

        .notif-content {
            display: flex;
            gap: 18px;
            align-items: start;
        }

        .notif-checkbox {
            margin-top: 4px;
        }

        .notif-checkbox input {
            width: 18px;
            height: 18px;
            cursor: pointer;
            accent-color: #1DA1F2;
        }

        .notif-icon {
            width: 48px;
            height: 48px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            font-size: 20px;
            position: relative;
        }

        .notif-icon.success { 
            background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
            color: #059669; 
        }
        .notif-icon.error { 
            background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
            color: #dc2626; 
        }
        .notif-icon.warning { 
            background: linear-gradient(135deg, #fed7aa 0%, #fdba74 100%);
            color: #d97706; 
        }
        .notif-icon.info { 
            background: linear-gradient(135deg, #e0e7ff 0%, #c7d2fe 100%);
            color: #4f46e5; 
        }

        .priority-badge {
            position: absolute;
            top: -4px;
            right: -4px;
            width: 20px;
            height: 20px;
            background: #ef4444;
            border-radius: 50%;
            border: 2px solid white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
            color: white;
        }

        .notif-body {
            flex: 1;
            min-width: 0;
        }

        .notif-header {
            display: flex;
            justify-content: space-between;
            align-items: start;
            margin-bottom: 8px;
        }

        .notif-title {
            font-weight: 700;
            font-size: 16px;
            color: #1e293b;
            margin-bottom: 4px;
        }

        .notif-category {
            display: inline-block;
            padding: 4px 12px;
            background: #f1f5f9;
            color: #64748b;
            font-size: 11px;
            font-weight: 600;
            border-radius: 6px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .notif-message {
            font-size: 14px;
            color: #475569;
            line-height: 1.6;
            margin-bottom: 12px;
        }

        .notif-meta {
            display: flex;
            align-items: center;
            gap: 16px;
            flex-wrap: wrap;
            margin-bottom: 12px;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 13px;
            color: #64748b;
        }

        .meta-item i {
            color: #94a3b8;
        }

        .notif-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
        }

        .notif-actions {
            display: flex;
            gap: 8px;
            opacity: 0;
            transition: opacity 0.3s;
        }

        .notification:hover .notif-actions {
            opacity: 1;
        }

        .btn-action {
            padding: 8px 16px;
            background: linear-gradient(135deg, #1DA1F2 0%, #0d7ac9 50%, #1976d2 100%);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .btn-action:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(29, 161, 242, 0.4);
        }

        .btn-action.secondary {
            background: #f1f5f9;
            color: #475569;
        }

        .btn-action.secondary:hover {
            background: #e2e8f0;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .btn-action.danger {
            background: #fee2e2;
            color: #dc2626;
        }

        .btn-action.danger:hover {
            background: #fecaca;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 80px 20px;
        }

        .empty-icon {
            width: 120px;
            height: 120px;
            margin: 0 auto 24px;
            background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .empty-icon i {
            font-size: 48px;
            color: #cbd5e0;
        }

        .empty-state h3 {
            font-size: 22px;
            color: #475569;
            margin-bottom: 12px;
            font-weight: 700;
        }

        .empty-state p {
            font-size: 15px;
            color: #94a3b8;
            max-width: 400px;
            margin: 0 auto;
        }

        /* Bulk Actions Bar */
        .bulk-actions-bar {
            position: fixed;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%) translateY(100px);
            background: linear-gradient(135deg, #1DA1F2 0%, #0d7ac9 50%, #1976d2 100%);
            color: white;
            padding: 16px 24px;
            border-radius: 16px;
            box-shadow: 0 12px 40px rgba(29, 161, 242, 0.4);
            display: flex;
            align-items: center;
            gap: 20px;
            z-index: 1000;
            opacity: 0;
            transition: all 0.3s;
        }

        .bulk-actions-bar.show {
            transform: translateX(-50%) translateY(0);
            opacity: 1;
        }

        .bulk-info {
            font-weight: 600;
            font-size: 14px;
        }

        .bulk-actions {
            display: flex;
            gap: 10px;
        }

        .bulk-actions button {
            padding: 8px 16px;
            background: rgba(255, 255, 255, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: white;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }

        .bulk-actions button:hover {
            background: rgba(255, 255, 255, 0.3);
        }

        /* Pagination */
        .pagination-wrapper {
            margin-top: 20px;
            display: flex;
            justify-content: center;
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .notification-container {
                padding: 0 12px;
            }

            .nav {
                padding: 0 10px;
            }

            .nav-list {
                gap: 10px;
                padding: 8px 0;
                justify-content: flex-start;
            }

            .nav-item {
                padding: 10px 16px;
                min-height: 36px;
            }

            .nav-link {
                font-size: 13px;
            }
            
            .nav-link i {
                font-size: 14px;
            }

            .filter-bar {
                flex-direction: column;
                align-items: stretch;
            }

            .search-box {
                min-width: 100%;
            }

            .action-bar {
                flex-direction: column;
                align-items: stretch;
                gap: 12px;
            }

            .action-buttons {
                width: 100%;
                justify-content: space-between;
            }

            .notification {
                padding: 16px;
            }

            .notif-content {
                gap: 12px;
            }

            .notif-checkbox {
                display: none;
            }

            .notif-footer {
                flex-direction: column;
                align-items: flex-start;
            }

            .notif-actions {
                opacity: 1;
                width: 100%;
            }

            .btn-action {
                flex: 1;
                justify-content: center;
            }

            .bulk-actions-bar {
                left: 12px;
                right: 12px;
                transform: translateX(0) translateY(100px);
                flex-direction: column;
                align-items: stretch;
            }

            .bulk-actions-bar.show {
                transform: translateX(0) translateY(0);
            }

            .bulk-actions {
                width: 100%;
            }

            .bulk-actions button {
                flex: 1;
            }
        }
    </style>
</head>
<body>

        <!-- Category Navigation -->
        <div class="nav-container">
            <nav class="nav">
                <ul class="nav-list">
                    <li class="nav-item {{ !request()->has('filter') || request()->get('filter') === 'all' ? 'active' : '' }}">
                        <a href="{{ route('notifications.index') }}" class="nav-link">
                            <i class="fas fa-inbox"></i> Semua
                            @if($stats['total'] > 0)
                            <span class="badge">{{ $stats['total'] }}</span>
                            @endif
                        </a>
                    </li>
                    <li class="nav-item {{ request()->get('filter') === 'unread' ? 'active' : '' }}">
                        <a href="{{ route('notifications.index', ['filter' => 'unread']) }}" class="nav-link">
                            <i class="fas fa-envelope"></i> Belum Dibaca
                            @if($stats['unread'] > 0)
                            <span class="badge-unread">{{ $stats['unread'] }}</span>
                            @endif
                        </a>
                    </li>
                    <li class="nav-item {{ request()->get('filter') === 'proposals' ? 'active' : '' }}">
                        <a href="{{ route('notifications.index', ['filter' => 'proposals']) }}" class="nav-link">
                            <i class="fas fa-briefcase"></i> Proposal
                        </a>
                    </li>
                    <li class="nav-item {{ request()->get('filter') === 'projects' ? 'active' : '' }}">
                        <a href="{{ route('notifications.index', ['filter' => 'projects']) }}" class="nav-link">
                            <i class="fas fa-folder"></i> Proyek
                        </a>
                    </li>
                    <li class="nav-item {{ request()->get('filter') === 'payments' ? 'active' : '' }}">
                        <a href="{{ route('notifications.index', ['filter' => 'payments']) }}" class="nav-link">
                            <i class="fas fa-wallet"></i> Pembayaran
                        </a>
                    </li>
                    <li class="nav-item {{ request()->get('filter') === 'messages' ? 'active' : '' }}">
                        <a href="{{ route('notifications.index', ['filter' => 'messages']) }}" class="nav-link">
                            <i class="fas fa-comments"></i> Pesan
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    <div class="notification-container">
        <!-- Search and Filter Bar -->
        <div class="filter-bar">
            <div class="search-box">
                <i class="fas fa-search"></i>
                <input type="text" id="searchInput" placeholder="Cari notifikasi...">
                <button class="clear-search" id="clearSearch">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <select class="sort-select" id="sortSelect">
                <option value="newest">Terbaru</option>
                <option value="oldest">Terlama</option>
                <option value="unread">Belum Dibaca</option>
                <option value="priority">Prioritas</option>
            </select>
        </div>

        <!-- Action Bar -->
        <div class="action-bar">
            <div class="info-text">
                <strong>{{ $stats['unread'] }}</strong> belum dibaca dari <strong>{{ $stats['total'] }}</strong> total notifikasi
            </div>
            <div class="action-buttons">
                <button class="btn btn-secondary" id="selectAll">
                    <i class="fas fa-check-square"></i>
                    <span>Pilih Semua</span>
                </button>
                <button class="btn btn-primary mark-all-read">
                    <i class="fas fa-check-double"></i>
                    <span>Tandai Semua Dibaca</span>
                </button>
            </div>
        </div>

        <!-- Notification List -->
        <div class="notification-list" id="notificationList">
            @forelse($notifications as $notification)
            <div class="notification {{ !$notification->is_read ? 'unread' : '' }}" data-id="{{ $notification->id }}" data-type="{{ $notification->type }}">
                <div class="notif-content">
                    <div class="notif-checkbox">
                        <input type="checkbox" class="notification-select">
                    </div>

                    <div class="notif-icon-wrapper">
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
                        @elseif($notification->type === 'message_received')
                            <div class="notif-icon info">
                                <i class="fas fa-comment-dots"></i>
                            </div>
                        @else
                            <div class="notif-icon info">
                                <i class="fas fa-info-circle"></i>
                            </div>
                        @endif
                        @if(!$notification->is_read)
                        <div class="priority-badge">
                            <i class="fas fa-circle"></i>
                        </div>
                        @endif
                    </div>
                    
                    <div class="notif-body">
                        <div class="notif-header">
                            <div>
                                <div class="notif-title">{{ $notification->title }}</div>
                                <span class="notif-category">{{ ucfirst(str_replace('_', ' ', $notification->type)) }}</span>
                            </div>
                        </div>

                        <div class="notif-message">{{ $notification->message }}</div>

                        <div class="notif-meta">
                            <div class="meta-item">
                                <i class="fas fa-clock"></i>
                                <span>{{ $notification->time_ago }}</span>
                            </div>
                            @if(isset($notification->data['project_title']))
                            <div class="meta-item">
                                <i class="fas fa-folder"></i>
                                <span>{{ $notification->data['project_title'] }}</span>
                            </div>
                            @endif
                        </div>

                        <div class="notif-footer">
                            <div class="notif-actions">
                                @if($notification->action_url !== '#')
                                <a href="{{ $notification->action_url }}" class="btn-action">
                                    <i class="fas fa-arrow-right"></i>
                                    @if($notification->type === 'proposal_accepted')
                                        Mulai Kerja
                                    @elseif($notification->type === 'project_revision')
                                        Lihat Revisi
                                    @elseif($notification->type === 'payment_received')
                                        Lihat Saldo
                                    @elseif($notification->type === 'message_received')
                                        Balas Pesan
                                    @else
                                        Lihat Detail
                                    @endif
                                </a>
                                @endif
                                @if(!$notification->is_read)
                                <button class="btn-action secondary mark-read" data-id="{{ $notification->id }}">
                                    <i class="fas fa-check"></i>
                                    Tandai Dibaca
                                </button>
                                @endif
                                <button class="btn-action danger delete-notif" data-id="{{ $notification->id }}">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="empty-state">
                <div class="empty-icon">
                    <i class="fas fa-bell-slash"></i>
                </div>
                <h3>Belum Ada Notifikasi</h3>
                <p>Notifikasi akan muncul di sini saat ada update dari client</p>
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($notifications->hasPages())
        <div class="pagination-wrapper">
            {{ $notifications->links() }}
        </div>
        @endif

        <!-- Bulk Actions Bar -->
        <div class="bulk-actions-bar" id="bulkActionsBar">
            <div class="bulk-info">
                <span id="selectedCount">0</span> notifikasi dipilih
            </div>
            <div class="bulk-actions">
                <button id="bulkMarkRead">
                    <i class="fas fa-check"></i> Tandai Dibaca
                </button>
                <button id="bulkDelete">
                    <i class="fas fa-trash"></i> Hapus
                </button>
                <button id="bulkCancel">
                    <i class="fas fa-times"></i> Batal
                </button>
            </div>
        </div>
    </div>

    <script>
        const token = '{{ csrf_token() }}';
        let selectedNotifications = new Set();

        // Search Functionality
        const searchInput = document.getElementById('searchInput');
        const clearSearch = document.getElementById('clearSearch');

        searchInput.addEventListener('input', function() {
            const query = this.value.toLowerCase();
            const notifications = document.querySelectorAll('.notification');
            
            notifications.forEach(notif => {
                const title = notif.querySelector('.notif-title').textContent.toLowerCase();
                const message = notif.querySelector('.notif-message').textContent.toLowerCase();
                
                if (title.includes(query) || message.includes(query)) {
                    notif.style.display = 'block';
                } else {
                    notif.style.display = 'none';
                }
            });
        });

        clearSearch.addEventListener('click', function() {
            searchInput.value = '';
            searchInput.dispatchEvent(new Event('input'));
        });

        // Sort Functionality
        const sortSelect = document.getElementById('sortSelect');
        sortSelect.addEventListener('change', function() {
            const notificationList = document.getElementById('notificationList');
            const notifications = Array.from(document.querySelectorAll('.notification'));
            
            notifications.sort((a, b) => {
                switch(this.value) {
                    case 'newest':
                        return b.dataset.id - a.dataset.id;
                    case 'oldest':
                        return a.dataset.id - b.dataset.id;
                    case 'unread':
                        return b.classList.contains('unread') - a.classList.contains('unread');
                    default:
                        return 0;
                }
            });
            
            notifications.forEach(notif => notificationList.appendChild(notif));
        });

        // Select All Functionality
        const selectAllBtn = document.getElementById('selectAll');
        let allSelected = false;

        selectAllBtn.addEventListener('click', function() {
            const checkboxes = document.querySelectorAll('.notification-select');
            allSelected = !allSelected;
            
            checkboxes.forEach(checkbox => {
                checkbox.checked = allSelected;
                const notification = checkbox.closest('.notification');
                if (allSelected) {
                    notification.classList.add('selected');
                    selectedNotifications.add(notification.dataset.id);
                } else {
                    notification.classList.remove('selected');
                    selectedNotifications.clear();
                }
            });
            
            updateBulkActionsBar();
            this.innerHTML = allSelected 
                ? '<i class="fas fa-square"></i><span>Batal Pilih</span>' 
                : '<i class="fas fa-check-square"></i><span>Pilih Semua</span>';
        });

        // Individual Checkbox Selection
        document.querySelectorAll('.notification-select').forEach(checkbox => {
            checkbox.addEventListener('change', function(e) {
                e.stopPropagation();
                const notification = this.closest('.notification');
                const id = notification.dataset.id;
                
                if (this.checked) {
                    notification.classList.add('selected');
                    selectedNotifications.add(id);
                } else {
                    notification.classList.remove('selected');
                    selectedNotifications.delete(id);
                }
                
                updateBulkActionsBar();
            });
        });

        // Update Bulk Actions Bar
        function updateBulkActionsBar() {
            const bulkBar = document.getElementById('bulkActionsBar');
            const count = selectedNotifications.size;
            
            document.getElementById('selectedCount').textContent = count;
            
            if (count > 0) {
                bulkBar.classList.add('show');
            } else {
                bulkBar.classList.remove('show');
            }
        }

        // Bulk Mark as Read
        document.getElementById('bulkMarkRead')?.addEventListener('click', async function() {
            if (selectedNotifications.size === 0) return;
            
            for (const id of selectedNotifications) {
                try {
                    await fetch(`/notifications/${id}/read`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': token
                        }
                    });
                } catch (err) {
                    console.error('Error marking notification as read:', err);
                }
            }
            
            location.reload();
        });

        // Bulk Delete
        document.getElementById('bulkDelete')?.addEventListener('click', async function() {
            if (selectedNotifications.size === 0) return;
            
            if (!confirm(`Hapus ${selectedNotifications.size} notifikasi yang dipilih?`)) return;
            
            for (const id of selectedNotifications) {
                const notification = document.querySelector(`[data-id="${id}"]`);
                if (notification) {
                    notification.style.transition = 'all 0.3s';
                    notification.style.opacity = '0';
                    notification.style.transform = 'translateX(-20px)';
                    
                    setTimeout(() => {
                        notification.remove();
                    }, 300);
                }
            }
            
            selectedNotifications.clear();
            updateBulkActionsBar();
        });

        // Bulk Cancel
        document.getElementById('bulkCancel')?.addEventListener('click', function() {
            document.querySelectorAll('.notification-select').forEach(checkbox => {
                checkbox.checked = false;
                checkbox.closest('.notification').classList.remove('selected');
            });
            
            selectedNotifications.clear();
            updateBulkActionsBar();
            
            selectAllBtn.innerHTML = '<i class="fas fa-check-square"></i><span>Pilih Semua</span>';
            allSelected = false;
        });

        // Mark All as Read
        document.querySelector('.mark-all-read')?.addEventListener('click', async function() {
            if (!confirm('Tandai semua notifikasi sebagai sudah dibaca?')) return;
            
            const btn = this;
            btn.disabled = true;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memproses...';
            
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
                } else {
                    throw new Error('Failed to mark all as read');
                }
            } catch (err) {
                alert('Gagal menandai notifikasi');
                btn.disabled = false;
                btn.innerHTML = '<i class="fas fa-check-double"></i> Tandai Semua Dibaca';
            }
        });

        // Mark Single as Read
        document.querySelectorAll('.mark-read').forEach(btn => {
            btn.addEventListener('click', async function(e) {
                e.stopPropagation();
                const id = this.dataset.id;
                
                this.disabled = true;
                this.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
                
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
                        
                        const priorityBadge = notif.querySelector('.priority-badge');
                        if (priorityBadge) {
                            priorityBadge.remove();
                        }
                        
                        this.remove();
                    } else {
                        throw new Error('Failed to mark as read');
                    }
                } catch (err) {
                    alert('Gagal menandai notifikasi');
                    this.disabled = false;
                    this.innerHTML = '<i class="fas fa-check"></i> Tandai Dibaca';
                }
            });
        });

        // Delete Single Notification
        document.querySelectorAll('.delete-notif').forEach(btn => {
            btn.addEventListener('click', async function(e) {
                e.stopPropagation();
                
                if (!confirm('Hapus notifikasi ini?')) return;
                
                const notification = this.closest('.notification');
                notification.style.transition = 'all 0.3s';
                notification.style.opacity = '0';
                notification.style.transform = 'translateX(-20px)';
                
                setTimeout(() => {
                    notification.remove();
                    
                    const remainingNotifs = document.querySelectorAll('.notification');
                    if (remainingNotifs.length === 0) {
                        document.getElementById('notificationList').innerHTML = `
                            <div class="empty-state">
                                <div class="empty-icon">
                                    <i class="fas fa-bell-slash"></i>
                                </div>
                                <h3>Belum Ada Notifikasi</h3>
                                <p>Notifikasi akan muncul di sini saat ada update dari client</p>
                            </div>
                        `;
                    }
                }, 300);
            });
        });

        // Click Notification to View
        document.querySelectorAll('.notification').forEach(notif => {
            notif.addEventListener('click', function(e) {
                if (e.target.closest('.btn-action') || 
                    e.target.closest('.notification-select') ||
                    e.target.closest('.delete-notif')) {
                    return;
                }
                
                const link = this.querySelector('a.btn-action');
                if (link) {
                    window.location.href = link.href;
                }
            });
        });

        // Keyboard Shortcuts
        document.addEventListener('keydown', function(e) {
            if ((e.ctrlKey || e.metaKey) && e.key === 'a') {
                e.preventDefault();
                selectAllBtn.click();
            }
            
            if (e.key === 'Escape' && selectedNotifications.size > 0) {
                document.getElementById('bulkCancel').click();
            }
            
            if ((e.ctrlKey || e.metaKey) && e.key === '/') {
                e.preventDefault();
                searchInput.focus();
            }
        });

        // Notification Animation on Load
        document.addEventListener('DOMContentLoaded', function() {
            const notifications = document.querySelectorAll('.notification');
            notifications.forEach((notif, index) => {
                notif.style.opacity = '0';
                notif.style.transform = 'translateY(20px)';
                
                setTimeout(() => {
                    notif.style.transition = 'all 0.4s ease';
                    notif.style.opacity = '1';
                    notif.style.transform = 'translateY(0)';
                }, index * 50);
            });
        });
    </script>
</body>
</html>
@endsection