@extends('freelancer.layout.freelancer-layout')

@section('title', 'Detail Penarikan Saldo')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-file-invoice mr-2"></i>Detail Penarikan Saldo
        </h1>
        <a href="{{ route('freelancer.withdrawals.index') }}" class="btn btn-secondary shadow-sm">
            <i class="fas fa-arrow-left mr-2"></i>Kembali
        </a>
    </div>

    <!-- Success Alert for Completed -->
    @if($withdrawal->isCompleted())
    <div class="alert alert-success alert-dismissible fade show shadow-sm mb-4" role="alert">
        <i class="fas fa-check-circle mr-2"></i>
        <strong>Transfer Berhasil!</strong> Dana telah ditransfer ke rekening Anda.
        @if($withdrawal->proof_image)
        <a href="#proofSection" class="alert-link ml-2">Lihat Bukti Transfer</a>
        @endif
        <button type="button" class="close" data-dismiss="alert">
            <span>&times;</span>
        </button>
    </div>
    @endif

    <div class="row">
        <!-- Main Information -->
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3 bg-primary">
                    <h6 class="m-0 font-weight-bold text-white">
                        <i class="fas fa-info-circle mr-2"></i>Informasi Penarikan
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <small class="text-muted">ID Penarikan</small>
                            <p class="font-weight-bold mb-0">{{ $withdrawal->withdrawal_id }}</p>
                        </div>
                        <div class="col-md-4">
                            <small class="text-muted">Tanggal Pengajuan</small>
                            <p class="font-weight-bold mb-0">{{ $withdrawal->created_at->format('d M Y H:i') }}</p>
                        </div>
                        <div class="col-md-4">
                            <small class="text-muted">Status</small>
                            <p class="mb-0">{!! $withdrawal->status_badge !!}</p>
                        </div>
                    </div>

                    <hr>

                    <div class="row mb-3">
                        <div class="col-md-12">
                            <small class="text-muted">Jumlah Penarikan</small>
                            <h3 class="font-weight-bold text-success mb-0">
                                {{ $withdrawal->formatted_amount }}
                            </h3>
                        </div>
                    </div>

                    <hr>

                    <h6 class="font-weight-bold text-gray-800 mb-3">
                        <i class="fas fa-university mr-2"></i>Informasi Rekening
                    </h6>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <small class="text-muted">Nama Bank</small>
                            <p class="font-weight-bold mb-0">{{ $withdrawal->bank_name }}</p>
                        </div>
                        <div class="col-md-4">
                            <small class="text-muted">Nomor Rekening</small>
                            <p class="font-weight-bold mb-0">{{ $withdrawal->account_number }}</p>
                        </div>
                        <div class="col-md-4">
                            <small class="text-muted">Nama Pemilik</small>
                            <p class="font-weight-bold mb-0">{{ $withdrawal->account_holder_name }}</p>
                        </div>
                    </div>

                    @if($withdrawal->isApproved() || $withdrawal->isCompleted())
                        <hr>
                        <div class="alert alert-info mb-0">
                            <i class="fas fa-info-circle mr-2"></i>
                            <strong>
                                @if($withdrawal->isApproved())
                                    Penarikan disetujui!
                                @else
                                    Penarikan selesai!
                                @endif
                            </strong>
                            @if($withdrawal->isApproved())
                                Dana akan segera ditransfer ke rekening Anda.
                            @else
                                Dana telah ditransfer ke rekening Anda.
                            @endif
                        </div>
                    @endif

                    @if($withdrawal->isRejected())
                        <hr>
                        <div class="alert alert-danger mb-0">
                            <i class="fas fa-exclamation-triangle mr-2"></i>
                            <strong>Penarikan ditolak!</strong>
                            @if($withdrawal->admin_notes)
                                <br>Alasan: {{ $withdrawal->admin_notes }}
                            @endif
                        </div>
                    @endif

                    @if($withdrawal->isCompleted() && $withdrawal->proof_image)
                        <hr id="proofSection">
                        <h6 class="font-weight-bold text-gray-800 mb-3">
                            <i class="fas fa-receipt mr-2"></i>Bukti Transfer
                        </h6>
                        <div class="text-center">
                            <div class="position-relative d-inline-block">
                                <img src="{{ asset('storage/' . $withdrawal->proof_image) }}" 
                                     alt="Bukti Transfer" 
                                     class="img-fluid rounded shadow mb-3"
                                     style="max-width: 100%; max-height: 500px; cursor: pointer;"
                                     data-toggle="modal" 
                                     data-target="#proofModal">
                                <div class="proof-overlay">
                                    <i class="fas fa-search-plus fa-2x"></i>
                                </div>
                            </div>
                            <div class="mt-3">
                                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#proofModal">
                                    <i class="fas fa-search-plus mr-2"></i>Lihat Ukuran Penuh
                                </button>
                                <a href="{{ asset('storage/' . $withdrawal->proof_image) }}" 
                                   download 
                                   class="btn btn-success btn-sm">
                                    <i class="fas fa-download mr-2"></i>Download Bukti
                                </a>
                            </div>
                            <p class="text-muted mt-2 mb-0">
                                <small>
                                    <i class="fas fa-info-circle mr-1"></i>
                                    Bukti transfer dari admin pada {{ $withdrawal->processed_at->format('d M Y H:i') }}
                                </small>
                            </p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Processing Information -->
            @if($withdrawal->processed_at)
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-gray-800">
                        <i class="fas fa-history mr-2"></i>Riwayat Proses
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <small class="text-muted">Diproses Oleh</small>
                            <p class="font-weight-bold mb-0">
                                {{ $withdrawal->processedBy ? $withdrawal->processedBy->name : 'Admin' }}
                            </p>
                        </div>
                        <div class="col-md-6">
                            <small class="text-muted">Tanggal Diproses</small>
                            <p class="font-weight-bold mb-0">
                                {{ $withdrawal->processed_at->format('d M Y H:i') }}
                            </p>
                        </div>
                    </div>

                    @if($withdrawal->admin_notes && !$withdrawal->isRejected())
                    <hr>
                    <div>
                        <small class="text-muted">Catatan Admin</small>
                        <div class="alert alert-info mt-2 mb-0">
                            <i class="fas fa-sticky-note mr-2"></i>
                            {{ $withdrawal->admin_notes }}
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Status Timeline -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-gray-800">
                        <i class="fas fa-tasks mr-2"></i>Status Penarikan
                    </h6>
                </div>
                <div class="card-body">
                    <div class="timeline">
                        <!-- Pending -->
                        <div class="timeline-item {{ $withdrawal->isPending() ? 'active' : 'completed' }}">
                            <div class="timeline-icon {{ $withdrawal->isPending() ? 'bg-warning' : 'bg-success' }}">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div class="timeline-content">
                                <h6 class="mb-0">Menunggu Verifikasi</h6>
                                <small class="text-muted">{{ $withdrawal->created_at->format('d M Y H:i') }}</small>
                            </div>
                        </div>

                        <!-- Approved -->
                        <div class="timeline-item {{ $withdrawal->isApproved() || $withdrawal->isCompleted() ? 'completed' : '' }}">
                            <div class="timeline-icon {{ $withdrawal->isApproved() || $withdrawal->isCompleted() ? 'bg-success' : 'bg-secondary' }}">
                                <i class="fas fa-check"></i>
                            </div>
                            <div class="timeline-content">
                                <h6 class="mb-0">Disetujui</h6>
                                @if($withdrawal->processed_at && ($withdrawal->isApproved() || $withdrawal->isCompleted()))
                                    <small class="text-muted">{{ $withdrawal->processed_at->format('d M Y H:i') }}</small>
                                @else
                                    <small class="text-muted">Menunggu...</small>
                                @endif
                            </div>
                        </div>

                        <!-- Completed -->
                        <div class="timeline-item {{ $withdrawal->isCompleted() ? 'completed' : '' }}">
                            <div class="timeline-icon {{ $withdrawal->isCompleted() ? 'bg-success' : 'bg-secondary' }}">
                                <i class="fas fa-check-double"></i>
                            </div>
                            <div class="timeline-content">
                                <h6 class="mb-0">Transfer Selesai</h6>
                                @if($withdrawal->isCompleted())
                                    <small class="text-muted">{{ $withdrawal->processed_at->format('d M Y H:i') }}</small>
                                @else
                                    <small class="text-muted">Menunggu...</small>
                                @endif
                            </div>
                        </div>

                        <!-- Rejected (if applicable) -->
                        @if($withdrawal->isRejected())
                        <div class="timeline-item completed">
                            <div class="timeline-icon bg-danger">
                                <i class="fas fa-times"></i>
                            </div>
                            <div class="timeline-content">
                                <h6 class="mb-0">Ditolak</h6>
                                <small class="text-muted">{{ $withdrawal->processed_at->format('d M Y H:i') }}</small>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Estimated Time -->
            @if($withdrawal->isPending() || $withdrawal->isApproved())
            <div class="card shadow mb-4 border-left-warning">
                <div class="card-body">
                    <h6 class="font-weight-bold text-warning mb-3">
                        <i class="fas fa-clock mr-2"></i>Estimasi Waktu
                    </h6>
                    <p class="mb-0">
                        Penarikan akan diproses dalam <strong>1-3 hari kerja</strong> setelah disetujui.
                    </p>
                </div>
            </div>
            @endif

            <!-- Help Card -->
            <div class="card shadow mb-4">
                <div class="card-body">
                    <h6 class="font-weight-bold text-primary mb-3">
                        <i class="fas fa-question-circle mr-2"></i>Butuh Bantuan?
                    </h6>
                    <p class="small mb-3">
                        Jika ada pertanyaan mengenai penarikan Anda, silakan hubungi tim support kami.
                    </p>
                    <a href="#" class="btn btn-sm btn-outline-primary btn-block">
                        <i class="fas fa-envelope mr-2"></i>Hubungi Support
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Proof Image Modal -->
@if($withdrawal->isCompleted() && $withdrawal->proof_image)
<div class="modal fade" id="proofModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">
                    <i class="fas fa-receipt mr-2"></i>Bukti Transfer
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body text-center p-0">
                <img src="{{ asset('storage/' . $withdrawal->proof_image) }}" 
                     alt="Bukti Transfer" 
                     class="img-fluid"
                     style="max-width: 100%; height: auto;">
            </div>
            <div class="modal-footer">
                <a href="{{ asset('storage/' . $withdrawal->proof_image) }}" 
                   download 
                   class="btn btn-success">
                    <i class="fas fa-download mr-2"></i>Download Bukti
                </a>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fas fa-times mr-2"></i>Tutup
                </button>
            </div>
        </div>
    </div>
</div>
@endif

@endsection

@push('styles')
<style>
.timeline {
    position: relative;
    padding-left: 30px;
}

.timeline-item {
    position: relative;
    padding-bottom: 30px;
    opacity: 0.5;
}

.timeline-item:last-child {
    padding-bottom: 0;
}

.timeline-item.active,
.timeline-item.completed {
    opacity: 1;
}

.timeline-item::before {
    content: '';
    position: absolute;
    left: -19px;
    top: 30px;
    width: 2px;
    height: calc(100% - 10px);
    background: #e3e6f0;
}

.timeline-item:last-child::before {
    display: none;
}

.timeline-icon {
    position: absolute;
    left: -30px;
    top: 0;
    width: 24px;
    height: 24px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 10px;
    border: 3px solid white;
    box-shadow: 0 0 0 2px #e3e6f0;
}

.timeline-content h6 {
    font-size: 14px;
    font-weight: 600;
}

.timeline-content small {
    font-size: 12px;
}

.position-relative {
    position: relative;
}

.proof-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.5);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
    border-radius: 0.25rem;
    color: white;
}

.position-relative:hover .proof-overlay {
    opacity: 1;
}

img[data-toggle="modal"] {
    cursor: pointer;
    transition: transform 0.2s ease;
}

img[data-toggle="modal"]:hover {
    transform: scale(1.02);
}

.btn {
    transition: all 0.2s ease;
}

.btn:hover {
    transform: translateY(-1px);
}
</style>
@endpush
