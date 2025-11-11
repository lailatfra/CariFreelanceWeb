@extends('freelancer.layout.freelancer-layout') 
@section('title', 'Notifikasi - CariFreelance') 
@section('content') 
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifikasi - CariFreelance</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            overflow-x: hidden;
            background-color: #f8f9fa;
        }

        /* Hide all scrollbars */
        ::-webkit-scrollbar {
            display: none;
        }
        
        html, body {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        /* Main Container */
        .main-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Page Header */
        .page-header {
            background: white;
            border-radius: 15px;
            padding: 25px;
            margin: 20px 0;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            border-left: 4px solid #1DA1F2;
        }

        .page-title {
            font-size: 2rem;
            font-weight: 700;
            color: #333;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .page-subtitle {
            color: #666;
            font-size: 1rem;
            margin: 0;
        }

        .notification-icon {
            color: #1DA1F2;
            font-size: 1.8rem;
        }

        /* Notification Stats */
        .notification-stats {
            display: flex;
            gap: 20px;
            margin: 20px 0;
            flex-wrap: wrap;
        }

        .stat-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            flex: 1;
            min-width: 200px;
            text-align: center;
            box-shadow: 0 4px 15px rgba(0,0,0,0.06);
            transition: all 0.3s ease;
            border-top: 3px solid transparent;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        }

        .stat-card.unread {
            border-top-color: #1DA1F2;
        }

        .stat-card.read {
            border-top-color: #28a745;
        }

        .stat-card.total {
            border-top-color: #6f42c1;
        }

        .stat-number {
            font-size: 2rem;
            font-weight: 700;
            color: #1DA1F2;
            margin-bottom: 5px;
        }

        .stat-label {
            color: #666;
            font-size: 0.9rem;
            font-weight: 500;
        }

        /* Filter Tabs */
        .filter-tabs {
            display: flex;
            gap: 10px;
            margin: 20px 0;
            flex-wrap: wrap;
        }

        .filter-tab {
            padding: 10px 20px;
            border: 2px solid #e9ecef;
            border-radius: 25px;
            background: white;
            color: #666;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            white-space: nowrap;
            position: relative;
        }

        .filter-tab.active {
            background: #1DA1F2;
            color: white;
            border-color: #1DA1F2;
            box-shadow: 0 4px 15px rgba(29, 161, 242, 0.3);
        }

        .filter-tab:hover:not(.active) {
            border-color: #1DA1F2;
            color: #1DA1F2;
            transform: translateY(-1px);
        }

        .filter-tab .badge {
            background: #dc3545;
            color: white;
            font-size: 10px;
            padding: 2px 6px;
            border-radius: 10px;
            margin-left: 5px;
            position: absolute;
            top: -5px;
            right: -5px;
        }

        .filter-tab.active .badge {
            background: rgba(255,255,255,0.3);
        }

        /* Action Bar */
        .action-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 20px 0;
            flex-wrap: wrap;
            gap: 15px;
        }

        .bulk-actions {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .bulk-checkbox {
            margin-right: 10px;
        }

        .bulk-btn {
            padding: 8px 16px;
            border: 1px solid #ddd;
            border-radius: 6px;
            background: white;
            color: #666;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .bulk-btn:hover {
            border-color: #1DA1F2;
            color: #1DA1F2;
        }

        .mark-all-read {
            background: #1DA1F2;
            color: white;
            border-color: #1DA1F2;
        }

        .mark-all-read:hover {
            background: #0d7ac9;
        }

        /* Notifications List */
        .notifications-container {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        }

        .notification-item {
            padding: 20px;
            border-bottom: 1px solid #f0f0f0;
            transition: all 0.3s ease;
            cursor: pointer;
            position: relative;
        }

        .notification-item:last-child {
            border-bottom: none;
        }

        .notification-item:hover {
            background: #f8f9ff;
        }

        .notification-item.unread {
            background: #fff8f0;
            border-left: 4px solid #1DA1F2;
        }

        .notification-item.unread:hover {
            background: #fff5e6;
        }

        .notification-content {
            display: flex;
            gap: 15px;
            align-items: flex-start;
        }

        .notification-avatar {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            object-fit: cover;
            flex-shrink: 0;
        }

        .notification-icon-wrapper {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            flex-shrink: 0;
        }

        .notification-icon-wrapper.success {
            background: #d4edda;
            color: #155724;
        }

        .notification-icon-wrapper.info {
            background: #d1ecf1;
            color: #0c5460;
        }

        .notification-icon-wrapper.warning {
            background: #fff3cd;
            color: #856404;
        }

        .notification-icon-wrapper.error {
            background: #f8d7da;
            color: #721c24;
        }

        .notification-icon-wrapper.primary {
            background: #cce5ff;
            color: #004085;
        }

        .notification-details {
            flex: 1;
        }

        .notification-title {
            font-weight: 600;
            font-size: 15px;
            color: #333;
            margin-bottom: 5px;
            line-height: 1.4;
        }

        .notification-message {
            color: #666;
            font-size: 14px;
            line-height: 1.5;
            margin-bottom: 8px;
        }

        .notification-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 12px;
            color: #999;
        }

        .notification-time {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .notification-actions {
            display: flex;
            gap: 10px;
            opacity: 0;
            transition: all 0.3s ease;
        }

        .notification-item:hover .notification-actions {
            opacity: 1;
        }

        .action-btn {
            padding: 4px 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            background: white;
            color: #666;
            font-size: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .action-btn:hover {
            border-color: #1DA1F2;
            color: #1DA1F2;
        }

        .action-btn.primary {
            background: #1DA1F2;
            color: white;
            border-color: #1DA1F2;
        }

        .action-btn.primary:hover {
            background: #0d7ac9;
        }

        .unread-indicator {
            position: absolute;
            top: 20px;
            right: 20px;
            width: 10px;
            height: 10px;
            background: #28a745;
            border-radius: 50%;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.2); opacity: 0.7; }
            100% { transform: scale(1); opacity: 1; }
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #666;
        }

        .empty-state i {
            font-size: 4rem;
            color: #ddd;
            margin-bottom: 20px;
        }

        .empty-state h3 {
            font-size: 1.2rem;
            margin-bottom: 10px;
            color: #666;
        }

        .empty-state p {
            font-size: 0.9rem;
            color: #999;
        }

        /* Priority Badges */
        .priority-badge {
            font-size: 10px;
            padding: 2px 6px;
            border-radius: 10px;
            margin-left: 8px;
            font-weight: 600;
        }

        .priority-badge.urgent {
            background: #dc3545;
            color: white;
        }

        .priority-badge.high {
            background: #fd7e14;
            color: white;
        }

        .priority-badge.normal {
            background: #6c757d;
            color: white;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .main-container {
                padding: 0 10px;
            }

            .page-header {
                padding: 20px 15px;
                margin: 10px 0;
            }

            .page-title {
                font-size: 1.5rem;
                flex-direction: column;
                text-align: center;
                gap: 10px;
            }

            .notification-stats {
                flex-direction: column;
            }

            .stat-card {
                min-width: unset;
            }

            .filter-tabs {
                justify-content: center;
            }

            .action-bar {
                flex-direction: column;
                align-items: stretch;
            }

            .bulk-actions {
                justify-content: center;
            }

            .notification-content {
                gap: 10px;
            }

            .notification-avatar,
            .notification-icon-wrapper {
                width: 40px;
                height: 40px;
            }

            .notification-meta {
                flex-direction: column;
                align-items: flex-start;
                gap: 5px;
            }
        }

                       /* Navigation Categories - Same styling from original */
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

    </style>
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
    <!-- Main Content -->
    <div class="main-container">
        <!-- Page Header -->

        <!-- Filter Tabs -->
        <div class="filter-tabs">
            <button class="filter-tab active">
                <i class="fas fa-list"></i> Semua
                <span class="badge">40</span>
            </button>
            <button class="filter-tab">
                <i class="fas fa-envelope"></i> Belum Dibaca
                <span class="badge">8</span>
            </button>
            <button class="filter-tab">
                <i class="fas fa-briefcase"></i> Proyek Baru
            </button>
            <button class="filter-tab">
                <i class="fas fa-credit-card"></i> Pembayaran
            </button>
            <button class="filter-tab">
                <i class="fas fa-comments"></i> Pesan
            </button>
            <button class="filter-tab">
                <i class="fas fa-cog"></i> Sistem
            </button>
        </div>

        <!-- Action Bar -->
        <div class="action-bar">
            <div class="bulk-actions">
                <input type="checkbox" class="bulk-checkbox" id="selectAll">
                <label for="selectAll" style="margin-right: 15px; color: #666; font-size: 14px;">Pilih Semua</label>
                <button class="bulk-btn">
                    <i class="fas fa-check"></i> Tandai Terpilih
                </button>
                <button class="bulk-btn">
                    <i class="fas fa-trash"></i> Hapus Terpilih
                </button>
            </div>
            <button class="bulk-btn mark-all-read">
                <i class="fas fa-check-double"></i> Tandai Semua Dibaca
            </button>
        </div>

        <!-- Notifications List -->
        <div class="notifications-container">
            <!-- New Project Invitation -->
            <div class="notification-item unread">
                <div class="unread-indicator"></div>
                <div class="notification-content">
                    <img src="https://images.unsplash.com/photo-1494790108755-2616b612b829?w=64&h=64&fit=crop&crop=face" alt="Client" class="notification-avatar">
                    <div class="notification-details">
                        <div class="notification-title">
                            Undangan Proyek Baru
                            <span class="priority-badge urgent">URGENT</span>
                        </div>
                        <div class="notification-message">sarah_tech mengundang Anda untuk mengerjakan proyek "Aplikasi Mobile E-commerce" dengan budget Rp 15.000.000 dan deadline 30 hari</div>
                        <div class="notification-meta">
                            <div class="notification-time">
                                <i class="fas fa-clock"></i>
                                2 menit yang lalu
                            </div>
                            <div class="notification-actions">
                                <button class="action-btn primary">Lihat Detail</button>
                                <button class="action-btn">Ajukan Proposal</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Proposal Accepted -->
            <div class="notification-item unread">
                <div class="unread-indicator"></div>
                <div class="notification-content">
                    <div class="notification-icon-wrapper success">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="notification-details">
                        <div class="notification-title">Proposal Diterima!</div>
                        <div class="notification-message">Selamat! Proposal Anda untuk proyek "Website Company Profile" telah diterima oleh john_doe. Proyek dimulai hari ini.</div>
                        <div class="notification-meta">
                            <div class="notification-time">
                                <i class="fas fa-clock"></i>
                                10 menit yang lalu
                            </div>
                            <div class="notification-actions">
                                <button class="action-btn primary">Mulai Proyek</button>
                                <button class="action-btn">Chat Client</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Payment Received -->
            <div class="notification-item unread">
                <div class="unread-indicator"></div>
                <div class="notification-content">
                    <div class="notification-icon-wrapper success">
                        <i class="fas fa-money-bill-wave"></i>
                    </div>
                    <div class="notification-details">
                        <div class="notification-title">Pembayaran Diterima</div>
                        <div class="notification-message">Pembayaran sebesar Rp 2.500.000 untuk proyek "Logo Design Perusahaan" telah masuk ke saldo Anda. Saldo sekarang Rp 8.750.000</div>
                        <div class="notification-meta">
                            <div class="notification-time">
                                <i class="fas fa-clock"></i>
                                1 jam yang lalu
                            </div>
                            <div class="notification-actions">
                                <button class="action-btn">Lihat Saldo</button>
                                <button class="action-btn">Withdraw</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Client Feedback -->
            <div class="notification-item unread">
                <div class="unread-indicator"></div>
                <div class="notification-content">
                    <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=64&h=64&fit=crop&crop=face" alt="Client" class="notification-avatar">
                    <div class="notification-details">
                        <div class="notification-title">Review dan Rating Baru</div>
                        <div class="notification-message">mike_wilson memberikan rating ⭐⭐⭐⭐⭐ (5.0) untuk proyek "Sistem Manajemen Inventory": "Pekerjaan sangat memuaskan, tepat waktu dan sesuai ekspektasi!"</div>
                        <div class="notification-meta">
                            <div class="notification-time">
                                <i class="fas fa-clock"></i>
                                2 jam yang lalu
                            </div>
                            <div class="notification-actions">
                                <button class="action-btn">Lihat Review</button>
                                <button class="action-btn">Balas</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Deadline Reminder -->
            <div class="notification-item unread">
                <div class="unread-indicator"></div>
                <div class="notification-content">
                    <div class="notification-icon-wrapper warning">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                    <div class="notification-details">
                        <div class="notification-title">
                            Pengingat Deadline
                            <span class="priority-badge high">PENTING</span>
                        </div>
                        <div class="notification-message">Proyek "Aplikasi Web Custom" akan berakhir dalam 2 hari (24 Januari 2025). Pastikan untuk menyelesaikan dan mengirim hasil kerja sebelum deadline.</div>
                        <div class="notification-meta">
                            <div class="notification-time">
                                <i class="fas fa-clock"></i>
                                3 jam yang lalu
                            </div>
                            <div class="notification-actions">
                                <button class="action-btn primary">Lihat Proyek</button>
                                <button class="action-btn">Kirim Progress</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Client Message -->
            <div class="notification-item">
                <div class="notification-content">
                    <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=64&h=64&fit=crop&crop=face" alt="Client" class="notification-avatar">
                    <div class="notification-details">
                        <div class="notification-title">Pesan dari Client</div>
                        <div class="notification-message">amanda_design mengirim pesan: "Halo, saya sudah review hasil kerja kemarin. Ada beberapa revisi kecil yang perlu diperbaiki. Bisa kita diskusi?"</div>
                        <div class="notification-meta">
                            <div class="notification-time">
                                <i class="fas fa-clock"></i>
                                5 jam yang lalu
                            </div>
                            <div class="notification-actions">
                                <button class="action-btn primary">Buka Chat</button>
                                <button class="action-btn">Lihat Revisi</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Milestone Completed -->
            <div class="notification-item">
                <div class="notification-content">
                    <div class="notification-icon-wrapper info">
                        <i class="fas fa-flag-checkered"></i>
                    </div>
                    <div class="notification-details">
                        <div class="notification-title">Milestone Selesai</div>
                        <div class="notification-message">Milestone "Design UI/UX" untuk proyek "Aplikasi Mobile E-commerce" telah diselesaikan. Pembayaran Rp 5.000.000 akan segera diproses.</div>
                        <div class="notification-meta">
                            <div class="notification-time">
                                <i class="fas fa-clock"></i>
                                1 hari yang lalu
                            </div>
                            <div class="notification-actions">
                                <button class="action-btn">Lihat Milestone</button>
                                <button class="action-btn">Lanjut ke Tahap Berikutnya</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- New Bid Opportunity -->
            <div class="notification-item unread">
                <div class="unread-indicator"></div>
                <div class="notification-content">
                    <div class="notification-icon-wrapper primary">
                        <i class="fas fa-bullhorn"></i>
                    </div>
                    <div class="notification-details">
                        <div class="notification-title">Proyek Baru Sesuai Keahlian</div>
                        <div class="notification-message">Ada 3 proyek baru di kategori "Web Development" yang sesuai dengan keahlian Anda: "Toko Online Fashion", "Portal Berita", dan "Sistem CRM"</div>
                        <div class="notification-meta">
                            <div class="notification-time">
                                <i class="fas fa-clock"></i>
                                6 jam yang lalu
                            </div>
                            <div class="notification-actions">
                                <button class="action-btn primary">Lihat Proyek</button>
                                <button class="action-btn">Tandai Dibaca</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Platform Update -->
            <div class="notification-item">
                <div class="notification-content">
                    <div class="notification-icon-wrapper info">
                        <i class="fas fa-megaphone"></i>
                    </div>
                    <div class="notification-details">
                        <div class="notification-title">Update Platform: Fitur Time Tracking</div>
                        <div class="notification-message">Fitur baru time tracking telah tersedia! Sekarang Anda dapat melacak waktu kerja secara otomatis dan memberikan transparansi lebih kepada client.</div>
                        <div class="notification-meta">
                            <div class="notification-time">
                                <i class="fas fa-clock"></i>
                                2 hari yang lalu
                            </div>
                            <div class="notification-actions">
                                <button class="action-btn">Pelajari Lebih Lanjut</button>
                                <button class="action-btn">Aktifkan Fitur</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Filter tabs functionality
        document.querySelectorAll('.filter-tab').forEach(tab => {
            tab.addEventListener('click', function() {
                document.querySelectorAll('.filter-tab').forEach(t => t.classList.remove('active'));
                this.classList.add('active');
                
                console.log('Filter changed to:', this.textContent.trim());
            });
        });

        // Select all functionality
        document.getElementById('selectAll').addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('.notification-item input[type="checkbox"]');
            checkboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
        });

        // Mark all as read
        document.querySelector('.mark-all-read').addEventListener('click', function() {
            document.querySelectorAll('.notification-item.unread').forEach(item => {
                item.classList.remove('unread');
                const indicator = item.querySelector('.unread-indicator');
                if (indicator) {
                    indicator.remove();
                }
            });
            
            // Update stats
            document.querySelector('.stat-card.unread .stat-number').textContent = '0';
            document.querySelector('.stat-card.read .stat-number').textContent = '40';
            
            console.log('All notifications marked as read');
        });

        // Individual notification actions
        document.querySelectorAll('.action-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.stopPropagation();
                console.log('Action clicked:', this.textContent.trim());
                
                if (this.textContent.includes('Tandai Dibaca')) {
                    const notificationItem = this.closest('.notification-item');
                    if (notificationItem.classList.contains('unread')) {
                        notificationItem.classList.remove('unread');
                        const indicator = notificationItem.querySelector('.unread-indicator');
                        if (indicator) {
                            indicator.remove();
                        }
                        
                        // Update unread count
                        const unreadCount = document.querySelector('.stat-card.unread .stat-number');
                        const readCount = document.querySelector('.stat-card.read .stat-number');
                        unreadCount.textContent = parseInt(unreadCount.textContent) - 1;
                        readCount.textContent = parseInt(readCount.textContent) + 1;
                    }
                }
            });
        });

        // Notification item click
        document.querySelectorAll('.notification-item').forEach(item => {
            item.addEventListener('click', function() {
                console.log('Notification clicked');
            });
        });

        // Bulk actions
        document.querySelectorAll('.bulk-btn:not(.mark-all-read)').forEach(btn => {
            btn.addEventListener('click', function() {
                console.log('Bulk action:', this.textContent.trim());
            });
        });

        // Auto-mark notifications as read when clicked
        document.querySelectorAll('.notification-item.unread').forEach(item => {
            item.addEventListener('click', function() {
                setTimeout(() => {
                    if (this.classList.contains('unread')) {
                        this.classList.remove('unread');
                        const indicator = this.querySelector('.unread-indicator');
                        if (indicator) {
                            indicator.remove();
                        }
                        
                        // Update counts
                        const unreadCount = document.querySelector('.stat-card.unread .stat-number');
                        const readCount = document.querySelector('.stat-card.read .stat-number');
                        unreadCount.textContent = parseInt(unreadCount.textContent) - 1;
                        readCount.textContent = parseInt(readCount.textContent) + 1;
                    }
                }, 1000);
            });
        });
    </script>
</body>
</html>
@endsection