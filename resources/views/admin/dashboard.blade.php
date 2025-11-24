@extends('admin.layouts.main')

@section('title', 'Dashboard Admin')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">
    <i class="fas fa-tachometer-alt mr-2"></i>Dashboard Admin
  </h1>
</div>

<!-- Balance Cards -->
<div class="row mb-4">
  <!-- Total Balance Card -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-info shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
              Total Saldo Platform</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">
              {{ $totalBalance ?? 'Rp 0' }}
            </div>
            <small class="text-muted">Total keseluruhan saldo</small>
          </div>
          <div class="col-auto">
            <i class="fas fa-wallet fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Service Balance Card -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
              Saldo Service</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">
              {{ $serviceBalance ?? 'Rp 0' }}
            </div>
            <small class="text-muted">Untuk transfer freelancer</small>
          </div>
          <div class="col-auto">
            <i class="fas fa-hand-holding-usd fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Admin Fee Balance Card -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-success shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
              Saldo Admin Fee</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">
              {{ $adminFeeBalance ?? 'Rp 0' }}
            </div>
            <small class="text-muted">Keuntungan platform</small>
          </div>
          <div class="col-auto">
            <i class="fas fa-chart-line fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Total Revenue Card -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-warning shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
              Total Revenue</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">
              {{ $totalRevenue ?? 'Rp 0' }}
            </div>
            <small class="text-muted">Pendapatan keseluruhan</small>
          </div>
          <div class="col-auto">
            <i class="fas fa-money-bill-wave fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Statistics Cards -->
<div class="row">
  <!-- Clients Card -->
  <div class="col-xl-2 col-md-4 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
              Total Klien</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">
              {{ $clientCount ?? 0 }}
            </div>
          </div>
          <div class="col-auto">
            <i class="fas fa-user-tie fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Freelancers Card -->
  <div class="col-xl-2 col-md-4 mb-4">
    <div class="card border-left-info shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
              Total Freelancer</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">
              {{ $freelancerCount ?? 0 }}
            </div>
          </div>
          <div class="col-auto">
            <i class="fas fa-user-cog fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Projects Card -->
  <div class="col-xl-2 col-md-4 mb-4">
    <div class="card border-left-success shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
              Total Proyek</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">
              {{ $projectCount ?? 0 }}
            </div>
          </div>
          <div class="col-auto">
            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Proposals Card -->
  <div class="col-xl-2 col-md-4 mb-4">
    <div class="card border-left-secondary shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">
              Total Proposal</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">
              {{ $proposalCount ?? 0 }}
            </div>
          </div>
          <div class="col-auto">
            <i class="fas fa-file-alt fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Pending Withdrawals Card -->
  <div class="col-xl-2 col-md-4 mb-4">
    <div class="card border-left-warning shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
              Withdrawal Pending</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">
              {{ $pendingWithdrawals ?? 0 }}
            </div>
          </div>
          <div class="col-auto">
            <i class="fas fa-clock fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Transactions This Month Card -->
  <div class="col-xl-2 col-md-4 mb-4">
    <div class="card border-left-purple shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-purple text-uppercase mb-1">
              Transaksi Bulan Ini</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">
              {{ $recentTransactionsCount ?? 0 }}
            </div>
          </div>
          <div class="col-auto">
            <i class="fas fa-exchange-alt fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Recent Activity & Transactions Row -->
<div class="row">
  <!-- Recent Projects -->
  <div class="col-lg-6">
    <div class="card shadow mb-4">
      <div class="card-header py-3 bg-gradient-primary">
        <div class="d-flex justify-content-between align-items-center">
          <h6 class="m-0 font-weight-bold text-white">
            <i class="fas fa-clipboard-list mr-2"></i>Proyek Terbaru
          </h6>
          <a href="{{ route('admin.projects.index') ?? '#' }}" class="btn btn-sm btn-outline-light">
            <i class="fas fa-cog mr-1"></i>Kelola
          </a>
        </div>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered table-hover" width="100%" cellspacing="0">
            <thead class="bg-gray-200">
              <tr>
                <th class="font-weight-bold text-gray-700">Judul Proyek</th>
                <th class="font-weight-bold text-gray-700">Klien</th>
                <th class="font-weight-bold text-gray-700">Tanggal</th>
                <th class="font-weight-bold text-gray-700">Budget</th>
              </tr>
            </thead>
            <tbody>
              @if(isset($recentProjects) && count($recentProjects) > 0)
                @foreach($recentProjects as $project)
                  <tr class="hover-row">
                    <td>
                      <div class="font-weight-bold">{{ $project->title ?? 'N/A' }}</div>
                      @if($project->description)
                        <small class="text-muted">{{ Str::limit($project->description, 60) }}</small>
                      @endif
                    </td>
                    <td>
                      <div class="d-flex align-items-center">
                        <div class="mr-2">
                          <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center" style="width: 30px; height: 30px; font-size: 0.8rem;">
                            <i class="fas fa-user"></i>
                          </div>
                        </div>
                        <span class="font-weight-bold">{{ $project->client->name ?? 'N/A' }}</span>
                      </div>
                    </td>
                    <td>
                      <small class="text-muted">
                        <i class="fas fa-calendar mr-1"></i>
                        {{ $project->created_at ? $project->created_at->format('M d, Y') : 'N/A' }}
                      </small>
                    </td>
                    <td>
                      @php
                        $budget = 0;
                        if (isset($project->proposalls) && $project->proposalls->count() > 0) {
                          $budget = $project->proposalls->max('proposal_price') ?? 0;
                        }
                      @endphp
                      <span class="font-weight-bold text-success">
                        Rp {{ number_format($budget, 0, ',', '.') }}
                      </span>
                    </td>
                  </tr>
                @endforeach
              @else
                <tr>
                  <td colspan="4" class="text-center py-4">
                    <div class="text-muted">
                      <i class="fas fa-clipboard-list fa-3x mb-3" style="color: #e3e6f0;"></i>
                      <h5>Tidak ada proyek terbaru</h5>
                    </div>
                  </td>
                </tr>
              @endif
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <!-- Recent Transactions -->
  <div class="col-lg-6">
    <div class="card shadow mb-4">
      <div class="card-header py-3 bg-gradient-primary">
        <div class="d-flex justify-content-between align-items-center">
          <h6 class="m-0 font-weight-bold text-white">
            <i class="fas fa-history mr-2"></i>Riwayat Transaksi Terbaru
          </h6>
          <a href="{{ route('admin.wallet.index') ?? '#' }}" class="btn btn-sm btn-outline-light">
            <i class="fas fa-wallet mr-1"></i>Lihat Semua
          </a>
        </div>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered table-hover" width="100%" cellspacing="0">
            <thead class="bg-gray-200">
              <tr>
                <th class="font-weight-bold text-gray-700">#</th>
                <th class="font-weight-bold text-gray-700">Tanggal</th>
                <th class="font-weight-bold text-gray-700">Tipe</th>
                <th class="font-weight-bold text-gray-700">Jumlah</th>
                <th class="font-weight-bold text-gray-700">Deskripsi</th>
              </tr>
            </thead>
            <tbody>
              @if(isset($recentTransactions) && count($recentTransactions) > 0)
                @foreach($recentTransactions as $index => $transaction)
                  <tr class="hover-row">
                    <td class="font-weight-bold">{{ $index + 1 }}</td>
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
                        @if($transaction->type === 'credit_service')
                          <i class="fas fa-arrow-down text-info mr-2"></i>
                          <span class="badge badge-info">Service Masuk</span>
                        @elseif($transaction->type === 'credit_admin_fee')
                          <i class="fas fa-arrow-down text-success mr-2"></i>
                          <span class="badge badge-success">Admin Fee</span>
                        @elseif($transaction->type === 'debit_transfer')
                          <i class="fas fa-arrow-up text-warning mr-2"></i>
                          <span class="badge badge-warning">Transfer Keluar</span>
                        @else
                          <i class="fas fa-exchange-alt text-secondary mr-2"></i>
                          <span class="badge badge-secondary">{{ $transaction->type }}</span>
                        @endif
                      </div>
                    </td>
                    <td>
                      <span class="font-weight-bold {{ in_array($transaction->type, ['debit_transfer']) ? 'text-warning' : 'text-success' }}" style="font-size: 1rem;">
                        @if(in_array($transaction->type, ['debit_transfer']))
                          - Rp {{ number_format($transaction->amount, 0, ',', '.') }}
                        @else
                          + Rp {{ number_format($transaction->amount, 0, ',', '.') }}
                        @endif
                      </span>
                    </td>
                    <td>
                      <small>{{ $transaction->description }}</small>
                      @if($transaction->payment)
                        <br><span class="badge badge-sm badge-secondary">Payment #{{ $transaction->payment->payment_id ?? 'N/A' }}</span>
                      @endif
                      @if($transaction->withdrawal)
                        <br><span class="badge badge-sm badge-secondary">Withdrawal #{{ $transaction->withdrawal->withdrawal_id ?? 'N/A' }}</span>
                      @endif
                    </td>
                  </tr>
                @endforeach
              @else
                <tr>
                  <td colspan="5" class="text-center py-4">
                    <div class="text-muted">
                      <i class="fas fa-inbox fa-3x mb-3" style="color: #e3e6f0;"></i>
                      <h5>Belum ada transaksi</h5>
                      <p>Transaksi wallet akan muncul di sini</p>
                    </div>
                  </td>
                </tr>
              @endif
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@push('styles')
<style>
.hover-row:hover {
    background-color: #f8f9fc !important;
    transition: background-color 0.2s ease;
}

.card {
    transition: all 0.2s ease;
    border: 1px solid #e3e6f0;
}

.card:hover {
    box-shadow: 0 0.25rem 0.5rem rgba(0, 0, 0, 0.1) !important;
}

.bg-gradient-primary {
    background: linear-gradient(90deg, #4e73df 0%, #224abe 100%);
}

.bg-gradient-info {
    background: linear-gradient(90deg, #36b9cc 0%, #258391 100%);
}

.table th {
    border-top: none;
    border-bottom: 2px solid #dee2e6;
    font-size: 0.85rem;
    letter-spacing: 0.5px;
    background-color: #f8f9fc;
}

.table td {
    border-top: 1px solid #e3e6f0;
    vertical-align: middle;
}

.badge {
    font-weight: 600;
    letter-spacing: 0.5px;
}

.text-purple {
    color: #6f42c1 !important;
}
</style>
@endpush

@push('scripts')
<script>
// Update withdrawal stats with new month/year
function updateWithdrawalStats() {
    const month = document.getElementById('withdrawalMonth').value;
    const year = document.getElementById('withdrawalYear').value;
    
    // Redirect with new parameters
    const url = new URL(window.location.href);
    url.searchParams.set('withdrawal_month', month);
    url.searchParams.set('withdrawal_year', year);
    
    window.location.href = url.toString();
}
</script>
@endpush