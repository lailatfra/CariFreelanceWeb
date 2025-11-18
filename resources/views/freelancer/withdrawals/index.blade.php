@extends('client.layout.client-layout') 

@section('title', 'Penarikan Saldo')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-wallet mr-2"></i>Penarikan Saldo
        </h1>
        <a href="{{ route('freelancer.withdrawals.create') }}" class="btn btn-primary shadow-sm">
            <i class="fas fa-plus-circle mr-2"></i>Ajukan Penarikan
        </a>
    </div>

    <!-- Alerts -->
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
        <button type="button" class="close" data-dismiss="alert">
            <span>&times;</span>
        </button>
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fas fa-exclamation-circle mr-2"></i>{{ session('error') }}
        <button type="button" class="close" data-dismiss="alert">
            <span>&times;</span>
        </button>
    </div>
    @endif

    <!-- Wallet Balance Card -->
    <div class="row mb-4">
        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Saldo Tersedia
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $wallet->formatted_balance }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-wallet fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Saldo Dalam Proses
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                Rp {{ number_format($wallet->pending_balance, 0, ',', '.') }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clock fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Withdrawal History -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 bg-gradient-primary">
            <h6 class="m-0 font-weight-bold text-white">
                <i class="fas fa-history mr-2"></i>Riwayat Penarikan
            </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="bg-gray-200">
                        <tr>
                            <th>ID Penarikan</th>
                            <th>Tanggal</th>
                            <th>Jumlah</th>
                            <th>Bank</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($withdrawals as $withdrawal)
                        <tr>
                            <td class="font-weight-bold">{{ $withdrawal->withdrawal_id }}</td>
                            <td>{{ $withdrawal->created_at->format('d M Y H:i') }}</td>
                            <td class="font-weight-bold text-success">
                                {{ $withdrawal->formatted_amount }}
                            </td>
                            <td>
                                {{ $withdrawal->bank_name }}<br>
                                <small class="text-muted">{{ $withdrawal->account_number }}</small>
                            </td>
                            <td>{!! $withdrawal->status_badge !!}</td>
                            <td>
                                <a href="{{ route('freelancer.withdrawals.show', $withdrawal) }}" 
                                   class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i> Detail
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-4">
                                <i class="fas fa-inbox fa-3x text-gray-300 mb-3"></i>
                                <p class="text-muted">Belum ada riwayat penarikan</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($withdrawals->hasPages())
            <div class="d-flex justify-content-center mt-3">
                {{ $withdrawals->links() }}
            </div>
            @endif
        </div>
    </div>
</div>

@push('styles')
<style>
.bg-gradient-primary {
    background: linear-gradient(90deg, #4e73df 0%, #224abe 100%);
}
</style>
@endpush
@endsection