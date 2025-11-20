@extends('admin.layouts.main')

@section('title', 'Wallet Admin - CariFreelance')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">
    <i class="fas fa-wallet mr-2"></i>Wallet Admin
  </h1>
</div>

<!-- Balance Cards -->
<div class="row mb-4">
  <!-- Service Balance Card -->
  <div class="col-xl-4 col-md-6 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
              Saldo Service (Untuk Freelancer)
            </div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">
              {{ $wallet->formatted_service_balance }}
            </div>
            <small class="text-muted">Saldo yang akan ditransfer ke freelancer</small>
          </div>
          <div class="col-auto">
            <i class="fas fa-hand-holding-usd fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Admin Fee Balance Card -->
  <div class="col-xl-4 col-md-6 mb-4">
    <div class="card border-left-success shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
              Saldo Admin Fee (Keuntungan)
            </div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">
              {{ $wallet->formatted_admin_fee_balance }}
            </div>
            <small class="text-muted">Keuntungan platform dari biaya admin 2.5%</small>
          </div>
          <div class="col-auto">
            <i class="fas fa-chart-line fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Total Balance Card -->
  <div class="col-xl-4 col-md-6 mb-4">
    <div class="card border-left-info shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
              Total Saldo
            </div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">
              {{ $wallet->formatted_total_balance }}
            </div>
            <small class="text-muted">Total keseluruhan saldo platform</small>
          </div>
          <div class="col-auto">
            <i class="fas fa-wallet fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Transaction History -->
<div class="card shadow mb-4">
  <div class="card-header py-3 bg-gradient-primary">
    <div class="row align-items-center">
      <div class="col">
        <h6 class="m-0 font-weight-bold text-white">
          <i class="fas fa-history mr-2"></i>Riwayat Transaksi
        </h6>
      </div>
      <div class="col-auto">
        <div class="dropdown">
          <button class="btn btn-light btn-sm dropdown-toggle shadow-sm" type="button" data-toggle="dropdown">
            <i class="fas fa-filter"></i> Filter Tipe
          </button>
          <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item" href="{{ route('admin.wallet.index') }}">
              <i class="fas fa-list mr-2"></i>Semua Transaksi
            </a>
            <a class="dropdown-item" href="{{ route('admin.wallet.index', ['type' => 'credit_service']) }}">
              <i class="fas fa-arrow-down mr-2 text-info"></i>Saldo Service Masuk
            </a>
            <a class="dropdown-item" href="{{ route('admin.wallet.index', ['type' => 'credit_admin_fee']) }}">
              <i class="fas fa-arrow-down mr-2 text-success"></i>Admin Fee Masuk
            </a>
            <a class="dropdown-item" href="{{ route('admin.wallet.index', ['type' => 'debit_transfer']) }}">
              <i class="fas fa-arrow-up mr-2 text-warning"></i>Transfer Keluar
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered table-hover" width="100%" cellspacing="0">
        <thead class="bg-gray-200">
          <tr>
            <th class="font-weight-bold text-gray-700">#</th>
            <th class="font-weight-bold text-gray-700">
              <i class="fas fa-calendar mr-1"></i>Tanggal
            </th>
            <th class="font-weight-bold text-gray-700">
              <i class="fas fa-tag mr-1"></i>Tipe
            </th>
            <th class="font-weight-bold text-gray-700">
              <i class="fas fa-money-bill mr-1"></i>Jumlah
            </th>
            <th class="font-weight-bold text-gray-700">
              <i class="fas fa-info-circle mr-1"></i>Deskripsi
            </th>
            <th class="font-weight-bold text-gray-700">
              <i class="fas fa-balance-scale mr-1"></i>Saldo Setelah
            </th>
          </tr>
        </thead>
        <tbody>
          @forelse($transactions as $index => $transaction)
          <tr class="hover-row">
            <td class="font-weight-bold">
              {{ ($transactions->currentPage() - 1) * $transactions->perPage() + $index + 1 }}
            </td>
            <td>
              <small class="text-muted">
                <i class="fas fa-calendar mr-1"></i>
                {{ $transaction->created_at->format('d M Y') }}<br>
                <i class="fas fa-clock mr-1"></i>
                {{ $transaction->created_at->format('H:i') }}
              </small>
            </td>
            <td>
              <div class="d-flex align-items-center">
                <i class="fas {{ $transaction->type_icon }} mr-2"></i>
                {!! $transaction->type_badge !!}
              </div>
            </td>
            <td>
              <span class="font-weight-bold {{ $transaction->type === 'debit_transfer' ? 'text-warning' : 'text-success' }}" style="font-size: 1rem;">
                @if($transaction->type === 'debit_transfer')
                  - {{ $transaction->formatted_amount }}
                @else
                  + {{ $transaction->formatted_amount }}
                @endif
              </span>
            </td>
            <td>
              <small>{{ $transaction->description }}</small>
              @if($transaction->payment)
                <br><span class="badge badge-sm badge-secondary">Payment #{{ $transaction->payment->payment_id }}</span>
              @endif
              @if($transaction->withdrawal)
                <br><span class="badge badge-sm badge-secondary">Withdrawal #{{ $transaction->withdrawal->withdrawal_id }}</span>
              @endif
            </td>
            <td>
              <div style="font-size: 0.85rem;">
                <strong class="text-primary">Service:</strong> Rp {{ number_format($transaction->service_balance_after, 0, ',', '.') }}<br>
                <strong class="text-success">Admin Fee:</strong> Rp {{ number_format($transaction->admin_fee_balance_after, 0, ',', '.') }}<br>
                <strong class="text-info">Total:</strong> Rp {{ number_format($transaction->total_balance_after, 0, ',', '.') }}
              </div>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="6" class="text-center py-4">
              <div class="text-muted">
                <i class="fas fa-inbox fa-3x mb-3" style="color: #e3e6f0;"></i>
                <h5>Belum ada transaksi</h5>
                <p>Transaksi wallet akan muncul di sini</p>
              </div>
            </td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <!-- Pagination -->
    @if($transactions->hasPages())
    <div class="d-flex justify-content-center mt-4">
      {{ $transactions->appends(request()->query())->links() }}
    </div>
    @endif
  </div>
</div>

@endsection

@push('styles')
<style>
.hover-row:hover {
  background-color: #f8f9fc !important;
  transition: background-color 0.2s ease;
}

.bg-gradient-primary {
  background: linear-gradient(90deg, #a2b3e5ff 0%, #0c1636ff 100%);
}

.table th {
  border-top: none;
  border-bottom: 2px solid #dee2e6;
  font-size: 0.85rem;
  letter-spacing: 0.5px;
  background-color: #f8f9fc;
  vertical-align: middle;
}

.table td {
  border-top: 1px solid #e3e6f0;
  vertical-align: middle;
}

.badge {
  font-weight: 600;
  letter-spacing: 0.5px;
}
</style>
@endpush
