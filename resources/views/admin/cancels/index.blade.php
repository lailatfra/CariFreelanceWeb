@extends('admin.layouts.main')

@section('title', 'Manajemen Pembatalan Proyek')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Kelola Pembatalan Proyek</h1>
</div>

<!-- Dashboard Stats -->
<div class="row">
    <!-- Pending Review Card -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2" style="border-left: 4px solid #4e73df !important;">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Pending Review</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['total_pending'] ?? 8 }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clock fa-2x text-gray-400"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Approved This Month Card -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2" style="border-left: 4px solid #1cc88a !important;">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Disetujui Bulan Ini</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['total_approved_month'] ?? 15 }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-check fa-2x text-gray-400"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Rejected Card -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-danger shadow h-100 py-2" style="border-left: 4px solid #e74a3b !important;">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Ditolak</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['total_rejected'] ?? 3 }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-times fa-2x text-gray-400"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Refund Pending Card -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2" style="border-left: 4px solid #36b9cc !important;">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Refund Pending</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">Rp {{ number_format($stats['total_refund_pending'] ?? 45000000, 0, ',', '.') }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-money-bill-wave fa-2x text-gray-400"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Filters -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card shadow">
            <div class="card-header py-3 bg-gradient-primary">
                <h6 class="m-0 font-weight-bold text-white"><i class="fas fa-filter mr-2"></i>Filter Data</h6>
            </div>
            <div class="card-body">
                <form id="filterForm" method="GET" action="{{ route('admin.cancels.cancels') }}">
                    <div class="row">
                        <div class="col-md-3">
                            <label class="form-label font-weight-bold">Status</label>
                            <select name="status" id="filterStatus" class="form-control">
                                <option value="">Semua Status</option>
                                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                                <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label font-weight-bold">Tanggal Dari</label>
                            <input type="date" name="date_from" id="filterDateFrom" class="form-control" value="{{ request('date_from') }}">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label font-weight-bold">Tanggal Sampai</label>
                            <input type="date" name="date_to" id="filterDateTo" class="form-control" value="{{ request('date_to') }}">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label font-weight-bold">Pencarian</label>
                            <input type="text" name="search" id="filterSearch" class="form-control" placeholder="Nama client/proyek..." value="{{ request('search') }}">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-filter"></i> Filter</button>
                            <a href="{{ route('admin.cancels.cancels') }}" class="btn btn-outline-secondary"><i class="fas fa-undo"></i> Reset</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Tabel Pembatalan -->
<div class="card shadow mb-4">
    <div class="card-header py-3 bg-gradient-primary">
        <div class="d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-white"><i class="fas fa-ban mr-2"></i>Daftar Pembatalan Proyek</h6>
            <div>
                <button class="btn btn-sm btn-success mr-2" id="bulkApprove" style="display: none;"><i class="fas fa-check"></i> Setujui Terpilih</button>
                <button class="btn btn-sm btn-danger mr-2" id="bulkReject" style="display: none;"><i class="fas fa-times"></i> Tolak Terpilih</button>
                <a href="{{ route('admin.cancels.cancels') }}" class="btn btn-sm btn-outline-light"><i class="fas fa-sync-alt"></i> Refresh</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover" width="100%" cellspacing="0" id="cancellationTable">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="font-weight-bold text-gray-700">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="selectAll">
                                <label class="custom-control-label" for="selectAll"></label>
                            </div>
                        </th>
                        <th class="font-weight-bold text-gray-700">#</th>
                        <th class="font-weight-bold text-gray-700">ID User</th>
                        <th class="font-weight-bold text-gray-700">Nama Client</th>
                        <th class="font-weight-bold text-gray-700">Freelancer</th>
                        <th class="font-weight-bold text-gray-700">Alasan Pembatalan</th>
                        <th class="font-weight-bold text-gray-700">Bukti Pembatalan</th>
                        <th class="font-weight-bold text-gray-700">Progress Project</th>
                        <th class="font-weight-bold text-gray-700">Amount</th>
                        <th class="font-weight-bold text-gray-700">Status</th>
                        <th class="font-weight-bold text-gray-700">Tanggal Pengajuan</th>
                        <th class="font-weight-bold text-gray-700">Tanggal Konfirmasi</th>
                        <th class="font-weight-bold text-gray-700 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cancellations as $index => $cancellation)
                    @php
                    $project = $cancellation->project;
                    $acceptedProposal = $project->proposalls->where('status', 'accepted')->first();
                    $freelancer = $acceptedProposal->user ?? null;

                    // Hitung progress
                    $totalTimelines = $project->timelines->count();
                    $completedTimelines = $project->timelines->where('status', 'selesai')->count();
                    $progress = $totalTimelines > 0 ? round(($completedTimelines / $totalTimelines) * 100) : 0;

                    // Format amount dari proposal
                    $amount = $acceptedProposal ? $acceptedProposal->proposal_price : 0;
                    @endphp
                    <tr class="hover-row">
                        <td>
                            @if($cancellation->refund_status === 'pending')
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input cancellation-checkbox"
                                    id="check{{ $cancellation->id }}" value="{{ $cancellation->id }}">
                                <label class="custom-control-label" for="check{{ $cancellation->id }}"></label>
                            </div>
                            @endif
                        </td>
                        <td class="font-weight-bold">{{ ($cancellations->currentPage() - 1) * $cancellations->perPage() + $index + 1 }}</td>
                        <td>
                            <span class="badge badge-primary">{{ $cancellation->user->id ?? '-' }}</span>
                        </td>
                        <td>
                            <div class="font-weight-bold">{{ $cancellation->user->name ?? 'N/A' }}</div>
                            <small class="text-muted">{{ $cancellation->user->email ?? '-' }}</small>
                        </td>
                        <td>
                            @if($freelancer)
                            <div class="font-weight-bold">{{ $freelancer->name }}</div>
                            <small class="text-muted">{{ $freelancer->email }}</small>
                            @else
                            <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>
                            <small>{{ Str::limit($cancellation->reason, 50) }}</small>
                        </td>
                        <td>
                            @if($cancellation->evidence_files && count($cancellation->evidence_files) > 0)
                            <button type="button" class="btn btn-sm btn-outline-info"
                                onclick="viewEvidence({{ $cancellation->id }})">
                                <i class="fas fa-paperclip"></i>
                                {{ count($cancellation->evidence_files) }} File
                            </button>
                            @else
                            <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>
                            <div class="progress mb-1" style="height: 8px;">
                                <div class="progress-bar bg-info" style="width: {{ $progress }}%"></div>
                            </div>
                            <small class="text-muted">{{ $progress }}% ({{ $completedTimelines }}/{{ $totalTimelines }})</small>
                        </td>
                        <td>
                            <div class="font-weight-bold text-success">
                                Rp {{ number_format($amount, 0, ',', '.') }}
                            </div>
                        </td>
                        <td>
                            @php
                            // ✅ PERBAIKAN: Sesuaikan dengan ENUM values yang benar
                            $statusClass = [
                            'pending' => 'secondary',
                            'processed' => 'success', // ✅ processed untuk approved
                            'completed' => 'info', // ✅ completed mungkin untuk selesai
                            'approved' => 'success', // ❌ ini tidak akan terjadi di refund_status
                            'rejected' => 'danger' // ❌ ini tidak akan terjadi di refund_status
                            ][$cancellation->refund_status] ?? 'light';
                            @endphp
                            <span class="badge badge-{{ $statusClass }} px-3 py-2" style="font-size: 0.75rem;">
                                {{ strtoupper($cancellation->refund_status) }}
                            </span>
                        </td>
                        <td>
                            <small class="text-muted">
                                {{ $cancellation->cancelled_at ? $cancellation->cancelled_at->format('d M Y') : '-' }}
                            </small>
                        </td>
                        <td>
                            <small class="text-muted">
                                {{ $cancellation->processed_at ? $cancellation->processed_at->format('d M Y') : '-' }}
                            </small>
                        </td>
                        <td class="text-center">
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-sm btn-outline-primary"
                                    onclick="viewDetail({{ $cancellation->id }})" title="Lihat Detail">
                                    <i class="fas fa-eye"></i>
                                </button>

                                @if($cancellation->refund_status === 'pending')
                                <!-- ✅ TOMBOL APPROVE - BUKA MODAL UPLOAD -->
                                <button type="button" class="btn btn-sm btn-outline-success"
                                    onclick="showTransferProofModal({{ $cancellation->id }}, '{{ addslashes($cancellation->bank_name) }}', '{{ $cancellation->account_number }}', {{ $cancellation->refund_amount }}, '{{ addslashes($cancellation->project->title ?? 'N/A') }}')"
                                    title="Approve">
                                    <i class="fas fa-check"></i>
                                </button>

                                <!-- ✅ TOMBOL REJECT - BUKA MODAL ALASAN -->
                                <button type="button" class="btn btn-sm btn-outline-danger"
                                    onclick="showRejectModal({{ $cancellation->id }}, '{{ $cancellation->project->title ?? 'N/A' }}')"
                                    title="Reject">
                                    <i class="fas fa-times"></i>
                                </button>
                                @endif

                                @if($cancellation->refund_status === 'processed' && $cancellation->transfer_proof)
                                <!-- ✅ TOMBOL LIHAT BUKTI TRANSFER -->
                                <button type="button" class="btn btn-sm btn-outline-info"
                                    onclick="viewTransferProof('{{ Storage::url($cancellation->transfer_proof) }}')"
                                    title="Lihat Bukti Transfer">
                                    <i class="fas fa-receipt"></i>
                                </button>
                                @endif

                                @if($cancellation->rejection_reason)
                                <!-- ✅ TOMBOL LIHAT ALASAN PENOLAKAN -->
                                <button type="button" class="btn btn-sm btn-outline-warning"
                                    onclick="viewRejectionReason('{{ addslashes($cancellation->rejection_reason) }}')"
                                    title="Lihat Alasan Penolakan">
                                    <i class="fas fa-info-circle"></i>
                                </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-3">
            {{ $cancellations->links() }}
        </div>
    </div>
</div>



<!-- ✅ MODAL UPLOAD BUKTI TRANSFER (COMPACT VERSION) -->
<div id="transferProofModal" class="modal">
    <div class="modal-content">
        <div class="modal-header" style="background: linear-gradient(135deg, #059669 0%, #047857 100%);">
            <div class="modal-title-section">
                <h2 class="modal-title">
                    <i class="fas fa-upload"></i>
                    Upload Bukti Transfer
                </h2>
                <p class="modal-subtitle">Unggah bukti transfer refund untuk client</p>
            </div>
            <span class="close" onclick="closeModal('transferProofModal')">×</span>
        </div>

        <div class="modal-body">
            <form id="transferProofForm" enctype="multipart/form-data">
                <input type="hidden" id="transferCancellationId" name="cancellation_id">

                <!-- ✅ COMPACT FILE UPLOAD AREA -->
                <div style="margin-bottom: 20px; padding: 0 1.5rem;">
                    <label for="transferProofFile" class="form-label" style="display: block; margin-bottom: 8px;">
                        <strong>Bukti Transfer:</strong> <span style="color: #ef4444;">*</span>
                    </label>

                    <div class="upload-area-compact" id="uploadArea" style="border: 2px dashed #d1d5db; border-radius: 8px; padding: 1rem; text-align: center; cursor: pointer; transition: all 0.3s;">
                        <input
                            type="file"
                            id="transferProofFile"
                            name="transfer_proof"
                            accept="image/jpeg,image/jpg,image/png,application/pdf"
                            style="display: none;"
                            required>

                        <div id="uploadPlaceholder">
                            <i class="fas fa-cloud-upload-alt" style="font-size: 2rem; color: #9ca3af; margin-bottom: 0.5rem;"></i>
                            <p style="color: #6b7280; margin: 0; font-size: 14px;">Klik untuk upload file</p>
                            <p style="font-size: 11px; color: #9ca3af; margin: 4px 0 0 0;">JPG, PNG, PDF (Max. 5MB)</p>
                        </div>

                        <div id="uploadPreview" style="display: none;">
                            <div style="display: flex; align-items: center; justify-content: space-between; padding: 8px; background: #f0fdf4; border-radius: 6px;">
                                <div style="display: flex; align-items: center; gap: 8px; flex: 1; min-width: 0;">
                                    <i class="fas fa-file-image" style="color: #059669; font-size: 1.25rem;"></i>
                                    <span id="fileName" style="color: #059669; font-weight: 500; font-size: 13px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;"></span>
                                </div>
                                <button type="button" class="btn btn-sm" onclick="removeFile()" style="padding: 4px 8px; background: transparent; border: 1px solid #dc2626; color: #dc2626; border-radius: 4px; font-size: 12px;">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ✅ INFO REFUND (TETAP) -->
                <div class="project-info-card" style="margin-bottom: 0;">
                    <h4 style="margin: 0 0 12px 0; color: #1e293b; font-size: 15px;">
                        <i class="fas fa-money-bill-wave" style="color: #10b981;"></i>
                        Informasi Refund
                    </h4>
                    <div class="meta-item">
                        <i class="fas fa-university meta-icon"></i>
                        <span style="font-size: 13px;"><strong>Bank:</strong> <span id="transferBankName">-</span></span>
                    </div>
                    <div class="meta-item">
                        <i class="fas fa-credit-card meta-icon"></i>
                        <span style="font-size: 13px;"><strong>No. Rekening:</strong> <span id="transferAccountNumber">-</span></span>
                    </div>
                    <div class="meta-item" style="border-bottom: none;">
                        <i class="fas fa-dollar-sign meta-icon"></i>
                        <span style="font-size: 13px;"><strong>Jumlah Refund:</strong> <span id="transferAmount" style="color: #10b981; font-weight: 600;">-</span></span>
                    </div>
                </div>
            </form>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" onclick="closeModal('transferProofModal')" style="padding: 8px 16px; font-size: 14px;">
                <i class="fas fa-times"></i>
                Batal
            </button>
            <button type="button" class="btn btn-success" onclick="submitTransferProof()" style="padding: 8px 16px; font-size: 14px;">
                <i class="fas fa-check"></i>
                Konfirmasi & Setujui
            </button>
        </div>
    </div>
</div>

<!-- ✅ MODAL TOLAK PEMBATALAN (REJECT) - SUDAH ADA, TINGGAL UPDATE -->
<div id="rejectCancellationModal" class="modal">
    <div class="modal-content">
        <div class="modal-header" style="background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);">
            <div class="modal-title-section">
                <h2 class="modal-title">
                    <i class="fas fa-times-circle"></i>
                    Tolak Pembatalan Proyek
                </h2>
                <p class="modal-subtitle">Berikan alasan penolakan</p>
            </div>
            <span class="close" onclick="closeModal('rejectCancellationModal')">×</span>
        </div>

        <div class="modal-body">
            <form id="rejectCancellationForm">
                <input type="hidden" id="rejectCancellationId" name="cancellation_id">

                <div style="margin-bottom: 24px; padding: 0 1.5rem;">
                    <label for="rejectReason" class="form-label">
                        <strong>Alasan Penolakan:</strong> <span style="color: #ef4444;">*</span>
                    </label>
                    <textarea
                        id="rejectReason"
                        name="reason"
                        class="form-textarea"
                        rows="4"
                        placeholder="Jelaskan alasan mengapa pembatalan ditolak..."
                        required
                        minlength="10"
                        maxlength="500"
                        style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px;"></textarea>
                    <div style="font-size: 12px; color: #6b7280; margin-top: 5px;">Minimal 10 karakter diperlukan</div>
                    <div class="char-counter" style="text-align: right; font-size: 12px; color: #9ca3af; margin-top: 5px;">
                        Karakter: <span id="rejectCharCount">0</span>/500
                    </div>
                </div>

                <div class="project-info-card" style="margin-bottom: 0;">
                    <h4 style="margin: 0 0 12px 0; color: #1e293b;">
                        <i class="fas fa-info-circle" style="color: #3b82f6;"></i>
                        Informasi Proyek
                    </h4>
                    <div class="meta-item">
                        <i class="fas fa-tag meta-icon"></i>
                        <span><strong>Judul:</strong> <span id="rejectProjectTitle">-</span></span>
                    </div>
                </div>
            </form>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" onclick="closeModal('rejectCancellationModal')">
                <i class="fas fa-arrow-left"></i>
                Kembali
            </button>
            <button type="button" class="btn btn-danger" onclick="submitRejectCancellation()">
                <i class="fas fa-times"></i>
                Tolak Pembatalan
            </button>
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

    .table td {
        vertical-align: middle;
    }

    .account-id-container {
        min-width: 120px;
    }

    .account-id-badge {
        font-size: 0.75rem;
        padding: 0.25rem 0.5rem;
        margin-right: 0.25rem;
    }
    
.hover-row:hover { 
  background-color: #f8f9fc !important; 
  transition: background-color 0.2s ease; 
}
.table td { 
  vertical-align: middle; 
}
.account-id-container {
  min-width: 120px;
}
.account-id-badge {
  font-size: 0.75rem;
  padding: 0.25rem 0.5rem;
  margin-right: 0.25rem;
}

.modal {
        display: none;
        position: fixed;
        z-index: 9999;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        overflow-y: auto;           /* Tambahkan ini */
        padding: 40px 0;            /* Naikkan sedikit biar tidak terlalu mepet */
        box-sizing: border-box;
    }

    .modal.show {
        display: flex;              /* Tetap pakai flex saat show */
        opacity: 1;
    }

    .modal-content {
        background-color: #fff;
        border-radius: 12px;
        width: 90%;
        max-width: 600px;
        margin: 20px auto;          /* Ganti dari transform, pakai margin auto */
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        position: relative;
        max-height: calc(100vh - 80px);  /* Batasi tinggi maksimal */
        display: flex;
        flex-direction: column;
    }

    .modal-body {
        flex: 1;
        overflow-y: auto;           /* Pastikan body bisa scroll */
        padding: 2rem 1.5rem;       /* Tambahkan padding horizontal */
    }

    .modal-header {
        padding: 1.5rem 1.5rem 1rem;
        flex-shrink: 0;
    }

    .modal-footer {
        padding: 1rem 1.5rem 1.5rem;
        flex-shrink: 0;
        border-top: 1px solid #e5e7eb;
        background: #fff;           /* Pastikan footer tidak transparan */
        position: sticky;
        bottom: 0;
    }

.upload-area {
    transition: all 0.3s ease;
}

.upload-area:hover {
    border-color: #059669 !important;
    background: #f0fdf4;
}

.project-info-card {
    background: #f9fafb;
    border-radius: 8px;
    padding: 1.25rem;
    margin: 0 1.5rem;
    border: 1px solid #e5e7eb;
}

.meta-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.5rem 0;
    border-bottom: 1px solid #e5e7eb;
}

.meta-item:last-child {
    border-bottom: none;
}

.meta-icon {
    color: #6b7280;
    width: 20px;
    text-align: center;
}

.form-textarea {
    transition: border-color 0.2s, box-shadow 0.2s;
    width: 100%;
    padding: 12px;
    border: 1px solid #d1d5db;
    border-radius: 8px;
    font-size: 14px;
}

.form-textarea:focus {
    outline: none;
    border-color: #059669;
    box-shadow: 0 0 0 3px rgba(5, 150, 105, 0.1);
}

.char-counter {
    text-align: right;
    font-size: 12px;
    color: #9ca3af;
    margin-top: 5px;
}

/* ✅ COMPACT UPLOAD AREA STYLING */
.upload-area-compact {
    transition: all 0.3s ease;
}

.upload-area-compact:hover {
    border-color: #059669 !important;
    background: #f0fdf4;
}

.upload-area-compact #uploadPlaceholder {
    padding: 0;
}

.upload-area-compact #uploadPreview {
    padding: 0;
}

</style>
@endpush

@push('scripts')
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // CSRF Token untuk AJAX requests
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // Variabel global untuk menyimpan ID pembatalan yang sedang diproses
    let currentCancellationId = null;

    // Function untuk handle fetch errors
    async function handleFetch(url, options = {}) {
        try {
            const response = await fetch(url, {
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                ...options
            });

            // Check if response is JSON
            const contentType = response.headers.get('content-type');
            if (!contentType || !contentType.includes('application/json')) {
                // Jika bukan JSON, mungkin redirect ke login
                if (response.status === 401 || response.status === 419) {
                    throw new Error('Session expired. Please login again.');
                }
                throw new Error('Server returned non-JSON response');
            }

            const data = await response.json();

            if (!response.ok) {
                throw new Error(data.message || `HTTP error! status: ${response.status}`);
            }

            return data;
        } catch (error) {
            console.error('Fetch error:', error);

            // Check if it's an authentication issue
            if (error.message.includes('Session expired') || error.message.includes('419')) {
                showNotification('Session expired. Please login again.', 'error');
                // Redirect to login after 2 seconds
                setTimeout(() => {
                    window.location.href = '/login';
                }, 2000);
            } else {
                showNotification('Error: ' + error.message, 'error');
            }

            throw error;
        }
    }

    // Function untuk approve
    async function approveCancellation(id) {
        if (!confirm('Apakah Anda yakin ingin menyetujui pembatalan ini?')) {
            return;
        }

        try {
            const response = await fetch(`/admin/cancels/${id}/approve`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });

            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            const data = await response.json();

            if (data.success) {
                alert(data.message);
                location.reload();
            } else {
                alert('Error: ' + data.message);
            }

        } catch (error) {
            console.error('Error:', error);
            alert('Terjadi kesalahan: ' + error.message);
        }
    }

    // ✅ SHOW MODAL UPLOAD BUKTI TRANSFER
    function showTransferProofModal(id, bankName, accountNumber, amount) {
        currentCancellationId = id;

        // Set info di modal
        document.getElementById('transferCancellationId').value = id;
        document.getElementById('transferBankName').textContent = bankName || '-';
        document.getElementById('transferAccountNumber').textContent = accountNumber || '-';
        document.getElementById('transferAmount').textContent = 'Rp ' + Number(amount).toLocaleString('id-ID');

        // Reset form
        document.getElementById('transferProofForm').reset();
        document.getElementById('uploadPlaceholder').style.display = 'block';
        document.getElementById('uploadPreview').style.display = 'none';

        openModal('transferProofModal');
    }

    // ✅ SHOW MODAL REJECT
    function showRejectModal(id, projectTitle) {
        currentCancellationId = id;

        document.getElementById('rejectCancellationId').value = id;
        document.getElementById('rejectProjectTitle').textContent = projectTitle;
        document.getElementById('rejectReason').value = '';
        document.getElementById('rejectCharCount').textContent = '0';

        openModal('rejectCancellationModal');
    }

    // ✅ HANDLE FILE UPLOAD
    document.addEventListener('DOMContentLoaded', function() {
        const uploadArea = document.getElementById('uploadArea');
        const fileInput = document.getElementById('transferProofFile');

        if (uploadArea && fileInput) {
            // Click to upload
            uploadArea.addEventListener('click', () => fileInput.click());

            // Drag & drop
            uploadArea.addEventListener('dragover', (e) => {
                e.preventDefault();
                uploadArea.style.borderColor = '#059669';
                uploadArea.style.background = '#f0fdf4';
            });

            uploadArea.addEventListener('dragleave', () => {
                uploadArea.style.borderColor = '#d1d5db';
                uploadArea.style.background = 'transparent';
            });

            uploadArea.addEventListener('drop', (e) => {
                e.preventDefault();
                uploadArea.style.borderColor = '#d1d5db';
                uploadArea.style.background = 'transparent';

                const files = e.dataTransfer.files;
                if (files.length > 0) {
                    fileInput.files = files;
                    previewFile(files[0]);
                }
            });

            // File input change
            fileInput.addEventListener('change', function() {
                if (this.files.length > 0) {
                    previewFile(this.files[0]);
                }
            });
        }

        // Character counter for reject reason
        const rejectTextarea = document.getElementById('rejectReason');
        const rejectCharCounter = document.getElementById('rejectCharCount');

        if (rejectTextarea && rejectCharCounter) {
            rejectTextarea.addEventListener('input', function() {
                const count = this.value.length;
                rejectCharCounter.textContent = count;

                if (count < 10 || count > 500) {
                    this.style.borderColor = '#dc2626';
                    rejectCharCounter.style.color = '#dc2626';
                } else {
                    this.style.borderColor = '#059669';
                    rejectCharCounter.style.color = '#059669';
                }
            });
        }
    });

    // ✅ PREVIEW FILE
    // ✅ PREVIEW FILE (COMPACT VERSION)
function previewFile(file) {
    const uploadPlaceholder = document.getElementById('uploadPlaceholder');
    const uploadPreview = document.getElementById('uploadPreview');
    const fileName = document.getElementById('fileName');

    // Format nama file dan size
    const maxLength = 30;
    let displayName = file.name;
    if (displayName.length > maxLength) {
        const ext = displayName.split('.').pop();
        displayName = displayName.substring(0, maxLength - ext.length - 4) + '...' + ext;
    }
    
    fileName.textContent = displayName + ' (' + formatFileSize(file.size) + ')';
    uploadPlaceholder.style.display = 'none';
    uploadPreview.style.display = 'block';
}

    // ✅ REMOVE FILE
    function removeFile() {
        document.getElementById('transferProofFile').value = '';
        document.getElementById('uploadPlaceholder').style.display = 'block';
        document.getElementById('uploadPreview').style.display = 'none';
    }

    // ✅ SUBMIT TRANSFER PROOF
    async function submitTransferProof() {
        const fileInput = document.getElementById('transferProofFile');

        if (!fileInput.files || fileInput.files.length === 0) {
            showNotification('Harap upload bukti transfer terlebih dahulu!', 'error');
            return;
        }

        const file = fileInput.files[0];
        const maxSize = 5 * 1024 * 1024; // 5MB

        if (file.size > maxSize) {
            showNotification('Ukuran file maksimal 5MB!', 'error');
            return;
        }

        const submitBtn = event.target;
        const originalHTML = submitBtn.innerHTML;
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Mengupload...';

        try {
            const formData = new FormData();
            formData.append('transfer_proof', file);
            formData.append('_token', csrfToken);

            const response = await fetch(`/admin/cancels/${currentCancellationId}/approve`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: formData
            });

            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            const data = await response.json();

            if (data.success) {
                showNotification(data.message, 'success');
                closeModal('transferProofModal');
                setTimeout(() => location.reload(), 1500);
            } else {
                showNotification(data.message, 'error');
            }

        } catch (error) {
            console.error('Error:', error);
            showNotification('Terjadi kesalahan: ' + error.message, 'error');
        } finally {
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalHTML;
        }
    }

    // ✅ SUBMIT REJECT
    async function submitRejectCancellation() {
        const reason = document.getElementById('rejectReason').value.trim();

        if (!reason || reason.length < 10) {
            showNotification('Alasan penolakan minimal 10 karakter!', 'error');
            return;
        }

        if (!currentCancellationId) {
            showNotification('Error: ID pembatalan tidak valid!', 'error');
            return;
        }

        const submitBtn = event.target;
        const originalHTML = submitBtn.innerHTML;
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memproses...';

        try {
            const response = await fetch(`/admin/cancels/${currentCancellationId}/reject`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({
                    reason: reason
                })
            });

            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            const data = await response.json();

            if (data.success) {
                showNotification(data.message, 'success');
                closeModal('rejectCancellationModal');
                setTimeout(() => location.reload(), 1500);
            } else {
                showNotification(data.message, 'error');
            }

        } catch (error) {
            console.error('Error:', error);
            showNotification('Terjadi kesalahan: '.error.message, 'error');
        } finally {
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalHTML;
        }
    }

    // ✅ VIEW TRANSFER PROOF
    function viewTransferProof(url) {
        Swal.fire({
            title: 'Bukti Transfer',
            html: `<img src="${url}" alt="Transfer Proof" style="max-width: 100%; border-radius: 8px;">`,
            width: '600px',
            showCloseButton: true,
            showConfirmButton: false
        });
    }

    // ✅ VIEW REJECTION REASON
    function viewRejectionReason(reason) {
        Swal.fire({
            title: 'Alasan Penolakan',
            html: `<div class="text-left" style="max-height: 300px; overflow-y: auto;">
                <p style="white-space: pre-wrap;">${reason || 'Tidak ada alasan yang dicantumkan'}</p>
              </div>`,
            icon: 'info',
            confirmButtonText: 'Tutup',
            width: '600px'
        });
    }

    // ✅ FORMAT FILE SIZE
    function formatFileSize(bytes) {
        if (!bytes) return '0 Bytes';
        const k = 1024;
        const sizes = ['Bytes', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
    }


    async function rejectCancellation(id, reason) {
        try {
            const response = await fetch(`/admin/cancellations/${id}/reject`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({
                    reason: reason
                })
            });

            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            const contentType = response.headers.get('content-type');
            if (!contentType || !contentType.includes('application/json')) {
                const text = await response.text();
                console.error('Response bukan JSON:', text);
                throw new Error('Server tidak mengembalikan JSON');
            }

            const data = await response.json();

            if (data.success) {
                alert(data.message);
                location.reload();
            } else {
                alert('Error: ' + data.message);
            }

        } catch (error) {
            console.error('Error:', error);
            alert('Terjadi kesalahan: ' + error.message);
        }
    }

    // Function untuk submit persetujuan
    async function submitApproveCancellation() {
        if (!currentCancellationId) {
            showNotification('Error: ID pembatalan tidak valid!', 'error');
            return;
        }

        const submitBtn = document.querySelector('#confirmApproveModal .btn-success');
        const originalHTML = submitBtn.innerHTML;
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memproses...';

        try {
            const data = await handleFetch(`/admin/cancels/${currentCancellationId}/approve`, {
                method: 'POST',
                body: JSON.stringify({}) // Empty body since we don't need additional data
            });

            if (data.success) {
                showNotification(data.message, 'success');
                closeModal('confirmApproveModal');

                // Refresh halaman setelah 1.5 detik
                setTimeout(() => {
                    location.reload();
                }, 1500);
            } else {
                showNotification(data.message, 'error');
            }
        } catch (error) {
            console.error('Error:', error);
            // Error sudah dihandle di handleFetch
        } finally {
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalHTML;
        }
    }

    // Function untuk submit reject
    async function submitRejectCancellation() {
        const reason = document.getElementById('rejectReason').value.trim();

        if (!reason || reason.length < 10) {
            alert('Alasan penolakan minimal 10 karakter!');
            return;
        }

        if (!currentCancellationId) {
            alert('Error: ID pembatalan tidak valid!');
            return;
        }

        try {
            const response = await fetch(`/admin/cancels/${currentCancellationId}/reject`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({
                    reason: reason
                })
            });

            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            const data = await response.json();

            if (data.success) {
                alert(data.message);
                closeModal('rejectCancellationModal');
                location.reload();
            } else {
                alert('Error: ' + data.message);
            }

        } catch (error) {
            console.error('Error:', error);
            alert('Terjadi kesalahan: ' + error.message);
        }
    }

    // Function untuk melihat detail pembatalan
    async function viewDetail(id) {
        try {
            showLoading('Memuat detail...');

            const data = await handleFetch(`/admin/cancels/${id}`);

            if (data.success) {
                showDetailModal(data.data);
            } else {
                showNotification('Gagal memuat detail', 'error');
            }
        } catch (error) {
            console.error('Error:', error);
        } finally {
            hideLoading();
        }
    }

    // Function untuk melihat bukti
    async function viewEvidence(id) {
        try {
            showLoading('Memuat bukti...');

            const data = await handleFetch(`/admin/cancels/${id}`);

            if (data.success && data.data.evidence_files) {
                showEvidenceModal(data.data.evidence_files);
            } else {
                showNotification('Tidak ada bukti yang tersedia', 'info');
            }
        } catch (error) {
            console.error('Error:', error);
        } finally {
            hideLoading();
        }
    }

    // Function untuk melihat alasan penolakan
    function viewRejectionReason(reason) {
        Swal.fire({
            title: 'Alasan Penolakan',
            html: `<div class="text-left" style="max-height: 300px; overflow-y: auto;">
                <p style="white-space: pre-wrap;">${reason || 'Tidak ada alasan yang dicantumkan'}</p>
              </div>`,
            icon: 'info',
            confirmButtonText: 'Tutup',
            width: '600px'
        });
    }

    // Modal functions
    function showDetailModal(data) {
        let statusBadge = '';
        switch (data.refund_status) {
            case 'pending':
                statusBadge = '<span class="badge badge-secondary">PENDING</span>';
                break;
            case 'approved':
                statusBadge = '<span class="badge badge-success">APPROVED</span>';
                break;
            case 'rejected':
                statusBadge = '<span class="badge badge-danger">REJECTED</span>';
                break;
        }

        let filesHtml = '';
        if (data.evidence_files && data.evidence_files.length > 0) {
            filesHtml = '<h6 class="font-weight-bold mb-3">Bukti Pendukung:</h6>';
            data.evidence_files.forEach((file, index) => {
                const fileUrl = typeof file === 'string' ? file : (file.url || file.path);
                const fileName = typeof file === 'string' ? `File ${index + 1}` : (file.original_name || file.name || `File ${index + 1}`);

                filesHtml += `
                <div class="mb-2">
                    <i class="fas fa-file mr-2"></i>
                    <a href="${fileUrl}" target="_blank" class="text-decoration-none">${fileName}</a>
                </div>
            `;
            });
        } else {
            filesHtml = '<p class="text-muted">Tidak ada bukti pendukung yang diunggah.</p>';
        }

        const content = `
        <div class="row">
            <div class="col-md-6">
                <h6 class="font-weight-bold text-primary">Informasi Proyek</h6>
                <table class="table table-sm table-borderless">
                    <tr><td class="font-weight-bold">Judul Proyek:</td><td>${data.project?.title || 'N/A'}</td></tr>
                    <tr><td class="font-weight-bold">Status Pembatalan:</td><td>${statusBadge}</td></tr>
                    <tr><td class="font-weight-bold">Jumlah Refund:</td><td class="text-success font-weight-bold">Rp ${data.refund_amount ? data.refund_amount.toLocaleString('id-ID') : '0'}</td></tr>
                </table>
            </div>
            <div class="col-md-6">
                <h6 class="font-weight-bold text-primary">Informasi Client</h6>
                <table class="table table-sm table-borderless">
                    <tr><td class="font-weight-bold">Nama:</td><td>${data.user?.name || 'N/A'}</td></tr>
                    <tr><td class="font-weight-bold">Email:</td><td>${data.user?.email || '-'}</td></tr>
                    <tr><td class="font-weight-bold">Bank:</td><td>${data.bank_name || '-'}</td></tr>
                    <tr><td class="font-weight-bold">No. Rekening:</td><td>${data.account_number || '-'}</td></tr>
                </table>
            </div>
        </div>
        
        <hr>
        
        <h6 class="font-weight-bold text-primary">Alasan Pembatalan</h6>
        <div class="alert alert-light">
            <p class="mb-0" style="white-space: pre-wrap;">${data.reason || '-'}</p>
        </div>
        
        <hr>
        
        ${filesHtml}
    `;

        // Create modal dynamically atau gunakan modal yang sudah ada
        Swal.fire({
            title: 'Detail Pembatalan Proyek',
            html: content,
            width: '800px',
            showCloseButton: true,
            showConfirmButton: false
        });
    }

    function showEvidenceModal(evidenceFiles) {
        let evidenceHtml = '<div class="row">';

        evidenceFiles.forEach((file, index) => {
            const fileUrl = typeof file === 'string' ? file : (file.url || file.path);
            const fileName = typeof file === 'string' ? `File ${index + 1}` : (file.original_name || file.name || `File ${index + 1}`);
            const fileSize = file.size ? `(${formatFileSize(file.size)})` : '';

            evidenceHtml += `
            <div class="col-md-6 mb-3">
                <div class="card">
                    <div class="card-body text-center">
                        <i class="fas fa-file fa-3x mb-3 text-primary"></i>
                        <h6 class="card-title">${fileName}</h6>
                        <p class="text-muted small">${fileSize}</p>
                        <a href="${fileUrl}" class="btn btn-sm btn-outline-primary" target="_blank" download>
                            <i class="fas fa-download"></i> Download
                        </a>
                    </div>
                </div>
            </div>
        `;
        });

        evidenceHtml += '</div>';

        Swal.fire({
            title: 'Bukti Pendukung',
            html: evidenceHtml,
            width: '800px',
            showCloseButton: true,
            showConfirmButton: false
        });
    }

    function formatFileSize(bytes) {
        if (!bytes) return '0 Bytes';
        const k = 1024;
        const sizes = ['Bytes', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
    }

    function openModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.style.display = 'block';  // Ubah dari 'flex' ke 'block' dulu
        document.body.style.overflow = 'hidden';
        setTimeout(() => {
            modal.classList.add('show');
        }, 10);
    }
}

function closeModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.classList.remove('show');
        setTimeout(() => {
            modal.style.display = 'none';
            document.body.style.overflow = '';
        }, 300);
    }
}

    function showNotification(message, type = 'success') {
        Swal.fire({
            title: type === 'success' ? 'Sukses!' : 'Error!',
            text: message,
            icon: type,
            confirmButtonText: 'OK',
            timer: type === 'success' ? 3000 : null
        });
    }

    function showLoading(message = 'Loading...') {
        // Remove existing loading
        hideLoading();

        const loading = document.createElement('div');
        loading.id = 'custom-loading';
        loading.style.cssText = `
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.5);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 9999;
        color: white;
        font-size: 18px;
    `;

        loading.innerHTML = `
        <div class="text-center">
            <div class="spinner-border text-light mb-2"></div>
            <div>${message}</div>
        </div>
    `;

        document.body.appendChild(loading);
    }

    function hideLoading() {
        const loading = document.getElementById('custom-loading');
        if (loading) {
            loading.remove();
        }
    }

    // Character counter untuk form penolakan
    document.addEventListener('DOMContentLoaded', function() {
        const rejectTextarea = document.getElementById('rejectReason');
        const rejectCharCounter = document.getElementById('rejectCharCount');

        if (rejectTextarea && rejectCharCounter) {
            rejectTextarea.addEventListener('input', function() {
                const count = this.value.length;
                rejectCharCounter.textContent = count;

                if (count < 10 || count > 500) {
                    this.style.borderColor = '#dc2626';
                    rejectCharCounter.style.color = '#dc2626';
                } else {
                    this.style.borderColor = '#059669';
                    rejectCharCounter.style.color = '#059669';
                }
            });
        }

        // Bulk actions
        const selectAll = document.getElementById('selectAll');
        if (selectAll) {
            selectAll.addEventListener('change', function() {
                document.querySelectorAll('.cancellation-checkbox').forEach(cb => {
                    cb.checked = this.checked;
                });
                toggleBulkButtons();
            });
        }

        document.querySelectorAll('.cancellation-checkbox').forEach(cb => {
            cb.addEventListener('change', toggleBulkButtons);
        });
    });

    function toggleBulkButtons() {
        const checkedCount = document.querySelectorAll('.cancellation-checkbox:checked').length;
        const bulkApprove = document.getElementById('bulkApprove');
        const bulkReject = document.getElementById('bulkReject');

        if (bulkApprove && bulkReject) {
            if (checkedCount > 0) {
                bulkApprove.style.display = 'inline-block';
                bulkReject.style.display = 'inline-block';
            } else {
                bulkApprove.style.display = 'none';
                bulkReject.style.display = 'none';
            }
        }
    }

    // Close modal when clicking outside
    window.addEventListener('click', function(event) {
        const modals = document.querySelectorAll('.modal');
        modals.forEach(modal => {
            if (event.target === modal) {
                closeModal(modal.id);
            }
        });
    });
</script>
@endpush