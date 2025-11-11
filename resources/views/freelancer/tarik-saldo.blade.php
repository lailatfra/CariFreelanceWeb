@extends('client.layout.client-layout')
@section('title', 'Ajukan Penarikan - Freelancer untuk Pembuatan Website E-Commerce - CariFreelance')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <title>Tarik Saldo - CariFreelance</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
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
      min-height: 100vh;
    }

    .container2 {
      max-width: 1200px;
      margin: 0 auto;
      padding: 24px;
    }

    .main {
      display: grid;
      grid-template-columns: 320px 1fr;
      gap: 32px;
      margin-top: 80px;
    }

    @media (max-width: 1024px) {
      .main {
        grid-template-columns: 1fr;
        gap: 24px;
      }
    }

    /* Schedule Announcement */
    .schedule-announcement {
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      z-index: 999;
      background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
      color: var(--white);
      padding: 16px 0;
      box-shadow: var(--shadow-lg);
      border-bottom: 3px solid rgba(255, 255, 255, 0.2);
    }

    .schedule-content {
      max-width: 1200px;
      margin: 0 auto;
      padding: 0 24px;
      display: flex;
      align-items: center;
      gap: 16px;
    }

    .schedule-icon {
      width: 48px;
      height: 48px;
      background: rgba(255, 255, 255, 0.2);
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 20px;
      flex-shrink: 0;
    }

    .schedule-text {
      flex: 1;
    }

    .schedule-title {
      font-size: 16px;
      font-weight: 700;
      margin-bottom: 4px;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .schedule-description {
      font-size: 14px;
      opacity: 0.9;
      line-height: 1.5;
    }

    .schedule-highlight {
      background: rgba(255, 255, 255, 0.25);
      padding: 2px 8px;
      border-radius: 6px;
      font-weight: 600;
    }

    .schedule-close {
      background: none;
      border: none;
      color: var(--white);
      font-size: 20px;
      cursor: pointer;
      padding: 8px;
      border-radius: 6px;
      transition: all 0.2s;
      flex-shrink: 0;
    }

    .schedule-close:hover {
      background: rgba(255, 255, 255, 0.1);
    }

    /* Live Status Indicator */
    .status-indicator {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      padding: 4px 12px;
      border-radius: 20px;
      font-size: 12px;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }

    .status-online {
      background: rgba(16, 185, 129, 0.2);
      color: #059669;
      border: 1px solid rgba(16, 185, 129, 0.3);
    }

    .status-offline {
      background: rgba(239, 68, 68, 0.2);
      color: #dc2626;
      border: 1px solid rgba(239, 68, 68, 0.3);
    }

    .status-dot {
      width: 8px;
      height: 8px;
      border-radius: 50%;
      animation: pulse 2s infinite;
    }

    .status-online .status-dot {
      background: #059669;
    }

    .status-offline .status-dot {
      background: #dc2626;
    }

    @keyframes pulse {
      0% { opacity: 1; }
      50% { opacity: 0.5; }
      100% { opacity: 1; }
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
      margin-top: 24px;
    }

    .quick-actions .card-content {
      padding: 20px;
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
    }

    .alert-warning {
      background: #fef3c7;
      border-color: var(--warning);
      color: #92400e;
    }

    .alert-info {
      background: var(--primary-light);
      border-color: var(--primary);
      color: #1e40af;
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

    .form-input {
      width: 100%;
      padding: 12px 16px;
      border: 1px solid var(--gray-300);
      border-radius: var(--radius-sm);
      font-size: 14px;
      background: var(--white);
      transition: all 0.2s ease;
      font-family: inherit;
    }

    .form-input:focus {
      outline: none;
      border-color: var(--primary);
      box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    .form-input::placeholder {
      color: var(--gray-400);
    }

    .form-help {
      font-size: 12px;
      color: var(--gray-500);
      margin-top: 6px;
    }

    .input-group {
      position: relative;
    }

    .input-prefix {
      position: absolute;
      left: 16px;
      top: 50%;
      transform: translateY(-50%);
      color: var(--gray-500);
      font-weight: 500;
    }

    .input-group .form-input {
      padding-left: 44px;
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
    }

    .btn-link {
      background: none;
      color: var(--primary);
      padding: 0;
      text-decoration: underline;
      font-weight: 500;
    }

    .btn-link:hover {
      color: var(--primary-dark);
    }

    /* Payment Methods */
    .payment-methods {
      display: grid;
      gap: 12px;
    }

    .payment-method {
      border: 2px solid var(--gray-200);
      border-radius: var(--radius-sm);
      padding: 16px;
      display: flex;
      align-items: center;
      gap: 12px;
      cursor: pointer;
      transition: all 0.2s ease;
      background: var(--white);
    }

    .payment-method:hover {
      border-color: var(--primary);
      background: var(--primary-light);
      transform: translateY(-1px);
      box-shadow: var(--shadow-sm);
    }

    .payment-method.selected {
      border-color: var(--primary);
      background: var(--primary-light);
      box-shadow: var(--shadow-md);
    }

    .payment-method input[type="radio"] {
      margin: 0;
      width: 18px;
      height: 18px;
      accent-color: var(--primary);
    }

    .payment-method-icon {
      width: 40px;
      height: 40px;
      display: flex;
      align-items: center;
      justify-content: center;
      border-radius: var(--radius-sm);
      font-size: 18px;
    }

    .payment-method-info {
      flex: 1;
    }

    .payment-method-name {
      font-weight: 600;
      font-size: 14px;
      margin-bottom: 4px;
      color: var(--gray-900);
    }

    .payment-method-details {
      font-size: 12px;
      color: var(--gray-500);
    }

    /* Transaction Items */
    .transaction-item {
      border: 1px solid var(--gray-200);
      border-radius: var(--radius-sm);
      padding: 20px;
      margin-bottom: 16px;
      background: var(--white);
      transition: all 0.2s ease;
    }

    .transaction-item:hover {
      box-shadow: var(--shadow-md);
      transform: translateY(-1px);
    }

    .transaction-header {
      display: flex;
      justify-content: space-between;
      align-items: flex-start;
      margin-bottom: 12px;
    }

    .transaction-amount {
      font-size: 18px;
      font-weight: 700;
      color: var(--gray-900);
    }

    .transaction-date {
      font-size: 12px;
      color: var(--gray-500);
      margin-top: 4px;
    }

    .transaction-details {
      font-size: 14px;
      color: var(--gray-600);
      margin-bottom: 12px;
      line-height: 1.5;
    }

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

    .status-pending {
      background: #fef3c7;
      color: #92400e;
    }

    .status-approved {
      background: #d1fae5;
      color: #047857;
    }

    .status-rejected {
      background: #fee2e2;
      color: #991b1b;
    }

    .status-processing {
      background: #dbeafe;
      color: #1e40af;
    }

    /* Modal */
    .modal {
      display: none;
      position: fixed;
      top: 40px;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.6);
      z-index: 1000;
      align-items: center;
      justify-content: center;
      backdrop-filter: blur(4px);
    }

    .modal.show {
      display: flex;
    }

    .modal-content {
      background: var(--white);
      border-radius: var(--radius);
      width: 90%;
      max-width: 600px;
      max-height: 90vh;
      overflow: hidden;
      box-shadow: var(--shadow-lg);
      animation: modalShow 0.3s ease;
    }

    @keyframes modalShow {
      from {
        opacity: 0;
        transform: scale(0.9) translateY(-20px);
      }
      to {
        opacity: 1;
        transform: scale(1) translateY(0);
      }
    }

    .modal-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 24px 24px 0;
      border-bottom: 1px solid var(--gray-200);
      margin-bottom: 24px;
    }

    .modal-title {
      font-size: 20px;
      font-weight: 600;
      color: var(--gray-900);
    }

    .modal-close {
      background: none;
      border: none;
      font-size: 24px;
      cursor: pointer;
      color: var(--gray-400);
      width: 32px;
      height: 32px;
      display: flex;
      align-items: center;
      justify-content: center;
      border-radius: 50%;
      transition: all 0.2s;
    }

    .modal-close:hover {
      background: var(--gray-100);
      color: var(--gray-600);
    }

    .modal-body {
      padding: 0 24px 24px;
      max-height: 60vh;
      overflow-y: auto;
    }

    /* Form Actions */
    .form-actions {
      display: flex;
      gap: 12px;
      margin-top: 32px;
      padding-top: 24px;
      border-top: 1px solid var(--gray-200);
    }

    @media (max-width: 640px) {
      .form-actions {
        flex-direction: column;
      }
      
      .btn {
        width: 100%;
      }
    }

    /* Loading State */
    .loading {
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 40px;
      color: var(--gray-500);
    }

    .spinner {
      animation: spin 1s linear infinite;
      margin-right: 12px;
    }

    @keyframes spin {
      from { transform: rotate(0deg); }
      to { transform: rotate(360deg); }
    }

    /* Empty State */
    .empty-state {
      text-align: center;
      padding: 60px 24px;
      color: var(--gray-500);
    }

    .empty-state i {
      font-size: 48px;
      margin-bottom: 16px;
      opacity: 0.3;
    }

    /* Responsive */
    @media (max-width: 576px) {
      .container2 {
          padding: 16px;
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
      
      .payment-method {
        padding: 12px;
      }

      .schedule-content {
        flex-direction: column;
        text-align: center;
        gap: 12px;
      }

      .schedule-icon {
        width: 40px;
        height: 40px;
        font-size: 18px;
      }

      .schedule-title {
        font-size: 15px;
      }

      .schedule-description {
        font-size: 13px;
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


<div class="container2">
  <div class="main">
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
          
          <div class="balance-amount">Rp 2.450.000</div>
          <div class="balance-subtitle">
            Siap untuk ditarik
          </div>
          
          <div class="balance-grid">
            <div class="balance-item">
              <div class="label">Total Pendapatan</div>
              <div class="value">Rp 4.200.000</div>
            </div>
            <div class="balance-item">
              <div class="label">Sedang Diproses</div>
              <div class="value">Rp 500.000</div>
            </div>
          </div>
        </div>
      </div>

      <!-- Quick Actions -->
      <div class="card quick-actions">
        <div class="card-content">
          <h3 style="font-size: 16px; font-weight: 600; margin: 0 0 16px; color: var(--gray-900);">Aksi Cepat</h3>
          <div class="action-grid">
            <button class="btn btn-secondary" onclick="showTransactionHistory()">
              <i class="fas fa-history"></i> Riwayat Transaksi
            </button>
            <button class="btn btn-secondary" onclick="showPaymentMethods()">
              <i class="fas fa-credit-card"></i> Kelola Metode Pembayaran
            </button>
            <a href="#" class="btn btn-secondary">
              <i class="fas fa-chart-line"></i> Laporan Penghasilan
            </a>
          </div>
        </div>
      </div>
    </aside>

    <!-- Main Content -->
    <main>
      <!-- Payment Method Alert -->
      <div class="alert alert-warning" id="paymentAlert" style="display: none;">
        <i class="fas fa-exclamation-triangle"></i>
        <div>
          <strong>Metode pembayaran belum diatur!</strong><br>
          Anda perlu menambahkan metode pembayaran sebelum dapat melakukan penarikan saldo.
          <button class="btn-link" onclick="showPaymentMethods()" style="margin-left: 8px;">Tambahkan sekarang</button>
        </div>
      </div>

      <!-- Schedule Alert -->
      <div class="alert alert-info" id="scheduleAlert">
        <i class="fas fa-info-circle"></i>
        <div>
          <strong>Informasi Jadwal Penarikan:</strong><br>
          Admin hanya memproses penarikan pada <strong>Hari Senin (09:00-18:00 WIB)</strong>. 
          Pengajuan saat ini akan diproses pada <span id="nextProcessDate"></span>.
        </div>
      </div>

      <!-- Breadcrumb -->
      <nav class="breadcrumb">
        <a href="#"><i class="fas fa-home" style="margin-right: 4px;"></i>Beranda</a>
        <span class="breadcrumb-separator">/</span>
        <a href="#">Profil Freelancer</a>
        <span class="breadcrumb-separator">/</span>
        <span style="font-weight: 600; color: var(--gray-900);">Tarik Saldo</span>
      </nav>

      <!-- Page Header -->
      <div class="page-header">
        <h1 class="page-title">Tarik Saldo</h1>
        <p class="page-description">Ajukan penarikan saldo Anda. Setiap permintaan akan direview oleh tim admin dalam 1-3 hari kerja untuk memastikan keamanan transaksi.</p>
      </div>

      <!-- Withdrawal Form -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">
            <i class="fas fa-wallet" style="margin-right: 8px; color: var(--primary);"></i>
            Form Penarikan Saldo
          </h3>
          <p class="card-subtitle">Lengkapi informasi di bawah untuk mengajukan penarikan</p>
        </div>
        
        <div class="card-content">
          <form id="withdrawForm">
            <div class="form-section">
              <div class="form-section-title">
                <i class="fas fa-money-bill-wave"></i>
                Jumlah Penarikan
              </div>
              
              <div class="form-group">
                <label class="form-label" for="amount">Nominal yang ingin ditarik</label>
                <div class="input-group">
                  <span class="input-prefix">Rp</span>
                  <input type="text" id="amount" class="form-input" placeholder="0" oninput="formatCurrency(this)" />
                </div>
                <div class="form-help">Minimum penarikan: Rp 50.000 | Maksimum: Rp 2.450.000</div>
              </div>
            </div>

            <div class="form-section">
              <div class="form-section-title">
                <i class="fas fa-university"></i>
                Metode Pembayaran
              </div>
              
              <div class="form-group">
                <div class="payment-methods">
                  <div class="payment-method selected" onclick="selectPaymentMethod(this)">
                    <input type="radio" name="payment_method" value="bca" checked />
                    <div class="payment-method-icon" style="background: #e3f2fd; color: #1565c0;">
                      <i class="fas fa-university"></i>
                    </div>
                    <div class="payment-method-info">
                      <div class="payment-method-name">Bank BCA</div>
                      <div class="payment-method-details">****1234 - Ahmad Rizki</div>
                    </div>
                  </div>
                  
                  <div class="payment-method" onclick="selectPaymentMethod(this)">
                    <input type="radio" name="payment_method" value="mandiri" />
                    <div class="payment-method-icon" style="background: #fff3e0; color: #f57c00;">
                      <i class="fas fa-university"></i>
                    </div>
                    <div class="payment-method-info">
                      <div class="payment-method-name">Bank Mandiri</div>
                      <div class="payment-method-details">****5678 - Ahmad Rizki</div>
                    </div>
                  </div>
                  
                  <div class="payment-method" onclick="showPaymentMethods()">
                    <div class="payment-method-icon" style="background: #e8f5e8; color: var(--success);">
                      <i class="fas fa-plus"></i>
                    </div>
                    <div class="payment-method-info">
                      <div class="payment-method-name">Tambah Metode Baru</div>
                      <div class="payment-method-details">Bank Transfer, E-wallet, dll</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="form-section">
              <div class="form-section-title">
                <i class="fas fa-sticky-note"></i>
                Catatan Tambahan
              </div>
              
              <div class="form-group">
                <label class="form-label" for="notes">Catatan (Opsional)</label>
                <textarea id="notes" class="form-input" rows="3" placeholder="Tambahkan catatan jika diperlukan..."></textarea>
              </div>
            </div>

            <div class="alert alert-info">
              <i class="fas fa-info-circle"></i>
              <div>
                <strong>Informasi Penting:</strong><br>
                • Penarikan akan diproses dalam 1-3 jam kerja pada hari Senin <br>
                • Pastikan data rekening sudah benar untuk menghindari kesalahan transfer<br>
                • Jika saldo belum masuk pada hari kerja penarikan, maka proses penarikan akan dilanjutkan pada minggu berikutnya <br>
                • Admin akan review setiap permintaan untuk memastikan keamanan<br>

              </div>
            </div>

            <div class="form-actions">
              <button type="submit" class="btn btn-primary">
                <i class="fas fa-paper-plane"></i> Ajukan Penarikan
              </button>
              <button type="button" class="btn btn-secondary" onclick="resetForm()">
                <i class="fas fa-undo"></i> Reset Form
              </button>
            </div>
          </form>
        </div>
      </div>
    </main>
  </div>
</div>

<!-- Transaction History Modal -->
<div id="transactionModal" class="modal">
  <div class="modal-content">
    <div class="modal-header">
      <h3 class="modal-title">
        <i class="fas fa-history" style="margin-right: 8px; color: var(--primary);"></i>
        Riwayat Transaksi
      </h3>
      <button class="modal-close" onclick="hideModal('transactionModal')">&times;</button>
    </div>
    <div class="modal-body">
      <div id="transactionList">
        <div class="loading">
          <i class="fas fa-spinner spinner"></i>
          <p>Memuat data transaksi...</p>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Payment Methods Modal -->
<div id="paymentModal" class="modal">
  <div class="modal-content">
    <div class="modal-header">
      <h3 class="modal-title">
        <i class="fas fa-credit-card" style="margin-right: 8px; color: var(--primary);"></i>
        Kelola Metode Pembayaran
      </h3>
      <button class="modal-close" onclick="hideModal('paymentModal')">&times;</button>
    </div>
    <div class="modal-body">
      <div style="margin-bottom: 24px;">
        <button class="btn btn-primary" style="width: 100%;">
          <i class="fas fa-plus"></i> Tambah Metode Pembayaran Baru
        </button>
      </div>

      <div>
        <h4 style="margin: 0 0 16px; font-size: 16px; font-weight: 600; color: var(--gray-900);">Metode Tersimpan</h4>
        
        <div class="payment-method" style="margin-bottom: 12px;">
          <div class="payment-method-icon" style="background: #e3f2fd; color: #1565c0;">
            <i class="fas fa-university"></i>
          </div>
          <div class="payment-method-info">
            <div class="payment-method-name">Bank BCA</div>
            <div class="payment-method-details">1234567890 - Ahmad Rizki</div>
          </div>
          <button class="btn btn-secondary" style="padding: 8px 16px; font-size: 12px;">
            <i class="fas fa-edit"></i> Edit
          </button>
        </div>

        <div class="payment-method">
          <div class="payment-method-icon" style="background: #fff3e0; color: #f57c00;">
            <i class="fas fa-university"></i>
          </div>
          <div class="payment-method-info">
            <div class="payment-method-name">Bank Mandiri</div>
            <div class="payment-method-details">0987654321 - Ahmad Rizki</div>
          </div>
          <button class="btn btn-secondary" style="padding: 8px 16px; font-size: 12px;">
            <i class="fas fa-edit"></i> Edit
          </button>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
// Check if user has payment methods (simulate API call)
let hasPaymentMethods = true; // Change to false to test

// Function to check if current time is within admin schedule
function isAdminOnline() {
  const now = new Date();
  const day = now.getDay(); // 0 = Sunday, 1 = Monday, etc.
  const hour = now.getHours();
  
  // Admin is online on Monday (1) between 9 AM and 6 PM
  return day === 1 && hour >= 9 && hour < 18;
}

// Function to get next processing date
function getNextProcessDate() {
  const now = new Date();
  const day = now.getDay();
  const hour = now.getHours();
  
  let nextMonday = new Date(now);
  
  if (day === 1 && hour < 18) {
    // If it's Monday and before 6 PM, next processing is today
    if (hour >= 9) {
      return 'hari ini (sedang dalam jam operasional)';
    } else {
      return 'hari ini mulai jam 09:00 WIB';
    }
  } else {
    // Calculate next Monday
    let daysUntilMonday = (8 - day) % 7;
    if (daysUntilMonday === 0) daysUntilMonday = 7; // If today is Monday after 6 PM
    
    nextMonday.setDate(now.getDate() + daysUntilMonday);
    
    const options = { 
      weekday: 'long', 
      year: 'numeric', 
      month: 'long', 
      day: 'numeric' 
    };
    return nextMonday.toLocaleDateString('id-ID', options) + ' jam 09:00 WIB';
  }
}

// Function to update admin status
function updateAdminStatus() {
  const statusIndicator = document.getElementById('adminStatus');
  const statusText = document.getElementById('statusText');
  const isOnline = isAdminOnline();
  
  if (isOnline) {
    statusIndicator.className = 'status-indicator status-online';
    statusText.textContent = 'ONLINE';
  } else {
    statusIndicator.className = 'status-indicator status-offline';
    statusText.textContent = 'OFFLINE';
  }
}

// Function to hide schedule announcement
function hideScheduleAnnouncement() {
  const announcement = document.getElementById('scheduleAnnouncement');
  announcement.style.display = 'none';
  
  // Adjust main content margin
  document.querySelector('.main').style.marginTop = '32px';
  
  // Store in session to remember user preference
  sessionStorage.setItem('scheduleAnnouncementHidden', 'true');
}

document.addEventListener('DOMContentLoaded', function() {
  // Check if announcement was previously hidden
  if (sessionStorage.getItem('scheduleAnnouncementHidden') === 'true') {
    hideScheduleAnnouncement();
  }
  
  // Update admin status
  updateAdminStatus();
  
  // Update next processing date
  const nextProcessElement = document.getElementById('nextProcessDate');
  if (nextProcessElement) {
    nextProcessElement.textContent = getNextProcessDate();
  }
  
  // Update status every minute
  setInterval(updateAdminStatus, 60000);
  
  if (!hasPaymentMethods) {
    document.getElementById('paymentAlert').style.display = 'flex';
    document.getElementById('withdrawForm').style.opacity = '0.5';
    document.getElementById('withdrawForm').style.pointerEvents = 'none';
  }
});

function formatCurrency(input) {
  let value = input.value.replace(/[^\d]/g, '');
  if (value) {
    value = parseInt(value).toLocaleString('id-ID');
  }
  input.value = value;
}

function selectPaymentMethod(element) {
  // Remove selected class from all methods
  document.querySelectorAll('.payment-method').forEach(method => {
    method.classList.remove('selected');
  });
  
  // Add selected class to clicked method (except the "add new" option)
  if (!element.onclick.toString().includes('showPaymentMethods')) {
    element.classList.add('selected');
    
    // Check the radio button
    const radio = element.querySelector('input[type="radio"]');
    if (radio) {
      radio.checked = true;
    }
  }
}

function showTransactionHistory() {
  document.getElementById('transactionModal').classList.add('show');
  
  // Simulate loading transaction data
  setTimeout(() => {
    document.getElementById('transactionList').innerHTML = `
      <div class="transaction-item">
        <div class="transaction-header">
          <div>
            <div class="transaction-amount">Rp 500.000</div>
            <div class="transaction-date">29 Agustus 2025, 14:30</div>
          </div>
          <span class="status-badge status-pending">
            <i class="fas fa-clock"></i>
            Menunggu Approval
          </span>
        </div>
        <div class="transaction-details">Bank BCA ****1234 • Catatan: Penarikan untuk proyek website toko online</div>
      </div>
      
      <div class="transaction-item">
        <div class="transaction-header">
          <div>
            <div class="transaction-amount">Rp 750.000</div>
            <div class="transaction-date">25 Agustus 2025, 09:15</div>
          </div>
          <span class="status-badge status-processing">
            <i class="fas fa-spinner fa-spin"></i>
            Sedang Diproses
          </span>
        </div>
        <div class="transaction-details">Bank Mandiri ****5678 • Admin: Dalam proses transfer</div>
      </div>
      
      <div class="transaction-item">
        <div class="transaction-header">
          <div>
            <div class="transaction-amount">Rp 1.200.000</div>
            <div class="transaction-date">22 Agustus 2025, 10:20</div>
          </div>
          <span class="status-badge status-approved">
            <i class="fas fa-check-circle"></i>
            Selesai
          </span>
        </div>
        <div class="transaction-details">Bank BCA ****1234 • Berhasil ditransfer</div>
      </div>
      
      <div class="transaction-item">
        <div class="transaction-header">
          <div>
            <div class="transaction-amount">Rp 300.000</div>
            <div class="transaction-date">20 Agustus 2025, 16:45</div>
          </div>
          <span class="status-badge status-rejected">
            <i class="fas fa-times-circle"></i>
            Ditolak
          </span>
        </div>
        <div class="transaction-details">Bank BCA ****1234 • Alasan: Proyek belum selesai sepenuhnya, silakan lengkapi deliverable terlebih dahulu</div>
      </div>
      
      <div class="transaction-item">
        <div class="transaction-header">
          <div>
            <div class="transaction-amount">Rp 850.000</div>
            <div class="transaction-date">18 Agustus 2025, 13:10</div>
          </div>
          <span class="status-badge status-approved">
            <i class="fas fa-check-circle"></i>
            Selesai
          </span>
        </div>
        <div class="transaction-details">Bank Mandiri ****5678 • Berhasil ditransfer</div>
      </div>
    `;
  }, 1500);
}

function showPaymentMethods() {
  document.getElementById('paymentModal').classList.add('show');
}

function hideModal(modalId) {
  const modal = document.getElementById(modalId);
  modal.classList.remove('show');
}

function resetForm() {
  document.getElementById('withdrawForm').reset();
  document.getElementById('amount').value = '';
  
  // Reset payment method selection
  document.querySelectorAll('.payment-method').forEach(method => {
    method.classList.remove('selected');
  });
  document.querySelector('.payment-method').classList.add('selected');
  document.querySelector('input[name="payment_method"]').checked = true;
}

// Handle form submission
document.getElementById('withdrawForm').addEventListener('submit', function(e) {
  e.preventDefault();
  
  const amount = document.getElementById('amount').value.replace(/[^\d]/g, '');
  const paymentMethod = document.querySelector('input[name="payment_method"]:checked');
  const notes = document.getElementById('notes').value;
  
  if (!hasPaymentMethods) {
    alert('Silakan tambahkan metode pembayaran terlebih dahulu!');
    return;
  }
  
  if (!amount || parseInt(amount) < 50000) {
    alert('Jumlah minimum penarikan adalah Rp 50.000');
    return;
  }
  
  if (parseInt(amount) > 2450000) {
    alert('Jumlah melebihi saldo yang tersedia');
    return;
  }
  
  if (!paymentMethod) {
    alert('Pilih metode pembayaran');
    return;
  }
  
  // Check if admin is currently processing withdrawals
  const isOnline = isAdminOnline();
  let confirmMessage = `Apakah Anda yakin ingin mengajukan penarikan sebesar ${document.getElementById('amount').value}?\n\n`;
  
  if (!isOnline) {
    confirmMessage += `⚠️ Admin sedang OFFLINE. Pengajuan akan diproses pada ${getNextProcessDate()}.`;
  } else {
    confirmMessage += `✅ Admin sedang ONLINE. Pengajuan akan segera diproses.`;
  }
  
  if (!confirm(confirmMessage)) {
    return;
  }
  
  // Simulate API call
  const submitBtn = document.querySelector('#withdrawForm button[type="submit"]');
  const originalContent = submitBtn.innerHTML;
  submitBtn.disabled = true;
  submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memproses...';
  
  setTimeout(() => {
    // Show success message
    const successAlert = document.createElement('div');
    successAlert.className = 'alert alert-success';
    successAlert.innerHTML = `
      <i class="fas fa-check-circle"></i>
      <div>
        <strong>Permintaan berhasil diajukan!</strong><br>
        Penarikan sebesar ${document.getElementById('amount').value} telah diajukan. 
        ${isOnline ? 'Admin sedang online dan akan memproses segera.' : `Akan diproses pada ${getNextProcessDate()}.`}
      </div>
    `;
    
    // Insert success message before the form
    const form = document.querySelector('.card');
    form.parentNode.insertBefore(successAlert, form);
    
    // Scroll to success message
    successAlert.scrollIntoView({ behavior: 'smooth', block: 'center' });
    
    // Reset form and button
    resetForm();
    submitBtn.disabled = false;
    submitBtn.innerHTML = originalContent;
    
    // Remove success message after 7 seconds
    setTimeout(() => {
      successAlert.remove();
    }, 7000);
  }, 2000);
});

// Close modal when clicking outside
document.querySelectorAll('.modal').forEach(modal => {
  modal.addEventListener('click', function(e) {
    if (e.target === modal) {
      modal.classList.remove('show');
    }
  });
});

// Add keyboard support for modals
document.addEventListener('keydown', function(e) {
  if (e.key === 'Escape') {
    document.querySelectorAll('.modal.show').forEach(modal => {
      modal.classList.remove('show');
    });
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

// Add loading states to buttons
document.querySelectorAll('.btn').forEach(btn => {
  btn.addEventListener('click', function(e) {
    if (this.type !== 'submit' && !this.disabled) {
      // Add subtle loading effect for non-submit buttons
      this.style.transform = 'scale(0.98)';
      setTimeout(() => {
        this.style.transform = '';
      }, 100);
    }
  });
});

// Auto-format currency input on paste
document.getElementById('amount').addEventListener('paste', function(e) {
  setTimeout(() => {
    formatCurrency(this);
  }, 10);
});

// Add form validation feedback
document.getElementById('amount').addEventListener('input', function() {
  const value = this.value.replace(/[^\d]/g, '');
  const numValue = parseInt(value) || 0;
  const helpText = this.parentNode.nextElementSibling;
  
  if (numValue > 0 && numValue < 50000) {
    helpText.style.color = 'var(--error)';
    helpText.innerHTML = '<i class="fas fa-exclamation-circle"></i> Minimum penarikan: Rp 50.000';
  } else if (numValue > 2450000) {
    helpText.style.color = 'var(--error)';
    helpText.innerHTML = '<i class="fas fa-exclamation-circle"></i> Jumlah melebihi saldo tersedia';
  } else {
    helpText.style.color = 'var(--gray-500)';
    helpText.innerHTML = 'Minimum penarikan: Rp 50.000 | Maksimum: Rp 2.450.000';
  }
});

// Add animation when cards come into view
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
</script>

</body>
</html>
@endsection