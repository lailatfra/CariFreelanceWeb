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
        <div class="card border-left-warning shadow h-100 py-2" style="border-left: 4px solid #f6c23e !important;">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pending Review</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            @php
                                $pendingCount = 0;
                                foreach($cancellations as $cancellation) {
                                    if($cancellation->refund_status === 'pending') {
                                        $pendingCount++;
                                    }
                                }
                                echo $pendingCount;
                            @endphp
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clock fa-2x text-gray-400"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Approved Card -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2" style="border-left: 4px solid #1cc88a !important;">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Disetujui</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            @php
                                $processedCount = 0;
                                foreach($cancellations as $cancellation) {
                                    if($cancellation->refund_status === 'processed') {
                                        $processedCount++;
                                    }
                                }
                                echo $processedCount;
                            @endphp
                        </div>
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
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            @php
                                $rejectedCount = 0;
                                foreach($cancellations as $cancellation) {
                                    if($cancellation->refund_status === 'completed') {
                                        $rejectedCount++;
                                    }
                                }
                                echo $rejectedCount;
                            @endphp
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-times fa-2x text-gray-400"></i>
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
                        <div class="col-md-12">
                            <label class="form-label font-weight-bold">Status</label>
                            <select name="status" id="filterStatus" class="form-control">
                                <option value="">Semua Status</option>
                                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="processed" {{ request('status') == 'processed' ? 'selected' : '' }}>Approved</option>
                                <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Rejected</option>
                            </select>
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
                        <th class="font-weight-bold text-gray-700">Bukti</th>
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

                    // SINKRONISASI STATUS: completed di database = rejected di tampilan
                    $displayText = strtoupper($cancellation->refund_status);
                    $statusClass = 'secondary';
                    
                    if ($cancellation->refund_status === 'pending') {
                        $statusClass = 'warning';
                        $displayText = 'PENDING';
                    } 
                    elseif ($cancellation->refund_status === 'processed') {
                        $displayText = 'APPROVED';
                        $statusClass = 'success';
                    }
                    elseif ($cancellation->refund_status === 'completed') {
                        $displayText = 'REJECTED';
                        $statusClass = 'danger';
                    }
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
                        <td class="font-weight-bold">{{ $loop->iteration }}</td>
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
                            @if(strlen($cancellation->reason) > 50)
                            <br>
                            <button type="button" class="btn btn-sm btn-outline-info mt-1" 
                                onclick="viewFullReason('{{ addslashes($cancellation->reason) }}')">
                                <i class="fas fa-eye"></i> Lihat Lengkap
                            </button>
                            @endif
                        </td>
                        <td>
                            @if($cancellation->evidence_files && count($cancellation->evidence_files) > 0)
                                @php
                                    $evidenceFiles = $cancellation->evidence_files;
                                    
                                    // Cari file gambar pertama untuk thumbnail
                                    $imageFile = null;
                                    foreach($evidenceFiles as $file) {
                                        if (is_array($file)) {
                                            $fileName = $file['original_name'] ?? $file['name'] ?? '';
                                            $filePath = $file['path'] ?? $file['url'] ?? '';
                                        } else {
                                            $fileName = $file;
                                            $filePath = $file;
                                        }
                                        
                                        $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
                                        if (in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
                                            $imageFile = $filePath;
                                            break;
                                        }
                                    }
                                @endphp
                                
                                @if($imageFile)
                                    @php
                                        $fileUrl = Storage::url($imageFile);
                                    @endphp
                                    <div class="text-center">
                                        <img src="{{ $fileUrl }}" 
                                             alt="Bukti Pembatalan" 
                                             class="img-thumbnail" 
                                             style="width: 60px; height: 60px; object-fit: cover; cursor: pointer;"
                                             onclick="zoomImage('{{ $fileUrl }}')"
                                             title="Klik untuk zoom">
                                    </div>
                                @else
                                    <span class="text-muted">File tersedia</span>
                                @endif
                                
                                <!-- Tombol untuk lihat semua bukti -->
                                <div class="text-center mt-1">
                                    <button type="button" class="btn btn-sm btn-outline-primary" 
                                        onclick="viewAllEvidence({{ $cancellation->id }})">
                                        <i class="fas fa-folder-open"></i> Lihat Semua
                                    </button>
                                </div>
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
                            <span class="badge badge-{{ $statusClass }} px-3 py-2" style="font-size: 0.75rem;">
                                {{ $displayText }}
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
                                @if($cancellation->refund_status === 'pending')
                                <!-- TOMBOL APPROVE - BUKA MODAL UPLOAD -->
                                <button type="button" class="btn btn-sm btn-outline-success"
                                    onclick="showTransferProofModal({{ $cancellation->id }}, '{{ addslashes($cancellation->bank_name) }}', '{{ $cancellation->account_number }}', {{ $cancellation->refund_amount }}, '{{ addslashes($cancellation->project->title ?? 'N/A') }}')"
                                    title="Approve">
                                    <i class="fas fa-check"></i>
                                </button>

                                <!-- TOMBOL REJECT - BUKA MODAL ALASAN -->
                                <button type="button" class="btn btn-sm btn-outline-danger"
                                    onclick="showRejectModal({{ $cancellation->id }}, '{{ $cancellation->project->title ?? 'N/A' }}')"
                                    title="Reject">
                                    <i class="fas fa-times"></i>
                                </button>
                                @endif

                                @if($cancellation->refund_status === 'processed' && $cancellation->transfer_proof)
                                <!-- TOMBOL LIHAT BUKTI TRANSFER -->
                                <button type="button" class="btn btn-sm btn-outline-info"
                                    onclick="viewTransferProof('{{ Storage::url($cancellation->transfer_proof) }}')"
                                    title="Lihat Bukti Transfer">
                                    <i class="fas fa-receipt"></i>
                                </button>
                                @endif

                                @if($cancellation->rejection_reason)
                                <!-- TOMBOL LIHAT ALASAN PENOLAKAN -->
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

<!-- MODAL UPLOAD BUKTI TRANSFER -->
<div class="modal fade" id="transferProofModal" tabindex="-1" role="dialog" aria-labelledby="transferProofModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 500px;">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title">
                    <i class="fas fa-upload mr-2"></i>
                    Upload Bukti Transfer
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="transferProofForm" enctype="multipart/form-data">
                    <input type="hidden" id="transferCancellationId" name="cancellation_id">

                    <!-- FILE UPLOAD AREA -->
                    <div class="mb-3">
                        <label for="transferProofFile" class="form-label font-weight-bold">
                            Bukti Transfer <span class="text-danger">*</span>
                        </label>

                        <div id="uploadArea" class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center cursor-pointer transition-all duration-300 bg-gray-50 hover:bg-green-50 hover:border-green-300">
                            <input
                                type="file"
                                id="transferProofFile"
                                name="transfer_proof"
                                accept="image/jpeg,image/jpg,image/png,application/pdf"
                                class="hidden"
                                required>

                            <div id="uploadPlaceholder">
                                <i class="fas fa-cloud-upload-alt fa-2x text-gray-400 mb-2"></i>
                                <p class="text-gray-600 font-medium mb-1">Klik untuk upload file</p>
                                <p class="text-gray-500 text-sm">JPG, PNG, PDF (Max. 5MB)</p>
                            </div>

                            <div id="uploadPreview" class="hidden">
                                <div class="flex items-center justify-between p-3 bg-green-50 rounded-lg border border-green-200">
                                    <div class="flex items-center gap-2 flex-1 min-w-0">
                                        <i class="fas fa-file-image text-green-600"></i>
                                        <span id="fileName" class="text-green-700 font-medium text-sm truncate"></span>
                                    </div>
                                    <button type="button" onclick="removeFile()" class="bg-transparent border border-red-500 text-red-500 rounded px-2 py-1 text-xs cursor-pointer hover:bg-red-50">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- INFO REFUND -->
                    <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                        <h6 class="font-semibold text-gray-800 mb-3 flex items-center gap-2">
                            <i class="fas fa-money-bill-wave text-green-600"></i>
                            Informasi Refund
                        </h6>
                        <div class="flex items-center gap-2 py-2 border-b border-gray-200 text-sm">
                            <i class="fas fa-university text-gray-500 w-4 text-center"></i>
                            <span><strong>Bank:</strong> <span id="transferBankName">-</span></span>
                        </div>
                        <div class="flex items-center gap-2 py-2 border-b border-gray-200 text-sm">
                            <i class="fas fa-credit-card text-gray-500 w-4 text-center"></i>
                            <span><strong>No. Rekening:</strong> <span id="transferAccountNumber">-</span></span>
                        </div>
                        <div class="flex items-center gap-2 py-2 text-sm">
                            <i class="fas fa-dollar-sign text-gray-500 w-4 text-center"></i>
                            <span><strong>Jumlah Refund:</strong> <span id="transferAmount" class="text-green-600 font-semibold">-</span></span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fas fa-times mr-1"></i> Batal
                </button>
                <button type="button" class="btn btn-success" onclick="submitTransferProof()">
                    <i class="fas fa-check mr-1"></i> Konfirmasi
                </button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL TOLAK PEMBATALAN -->
<div class="modal fade" id="rejectCancellationModal" tabindex="-1" role="dialog" aria-labelledby="rejectCancellationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 500px;">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">
                    <i class="fas fa-times-circle mr-2"></i>
                    Tolak Pembatalan
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="rejectCancellationForm">
                    <input type="hidden" id="rejectCancellationId" name="cancellation_id">

                    <div class="mb-4">
                        <label for="rejectReason" class="form-label font-weight-bold">
                            Alasan Penolakan <span class="text-danger">*</span>
                        </label>
                        <textarea
                            id="rejectReason"
                            name="reason"
                            rows="4"
                            placeholder="Jelaskan alasan mengapa pembatalan ditolak..."
                            required
                            minlength="10"
                            maxlength="500"
                            class="form-control"></textarea>
                        <div class="text-muted text-xs mt-1">Minimal 10 karakter diperlukan</div>
                        <div class="text-right text-gray-500 text-xs mt-1">
                            Karakter: <span id="rejectCharCount">0</span>/500
                        </div>
                    </div>

                    <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                        <h6 class="font-semibold text-gray-800 mb-3 flex items-center gap-2">
                            <i class="fas fa-info-circle text-blue-600"></i>
                            Informasi Proyek
                        </h6>
                        <div class="flex items-center gap-2 py-2 text-sm">
                            <i class="fas fa-tag text-gray-500 w-4 text-center"></i>
                            <span><strong>Judul:</strong> <span id="rejectProjectTitle">-</span></span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fas fa-arrow-left mr-1"></i> Kembali
                </button>
                <button type="button" class="btn btn-danger" onclick="submitRejectCancellation()">
                    <i class="fas fa-times mr-1"></i> Tolak
                </button>
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

    .table td {
        vertical-align: middle;
        font-size: 0.875rem;
    }

    /* Modal Styling untuk posisi tengah */
    .modal {
        background-color: rgba(0, 0, 0, 0.5);
    }

    .modal-dialog-centered {
        display: flex;
        align-items: center;
        min-height: calc(100% - 1rem);
    }

    .modal-content {
        border: none;
        border-radius: 10px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    }

    .modal-header {
        border-radius: 10px 10px 0 0;
        border-bottom: 1px solid rgba(255,255,255,0.1);
    }

    .modal-footer {
        border-top: 1px solid #e9ecef;
        border-radius: 0 0 10px 10px;
    }

    /* Custom styling untuk upload area */
    .border-2 {
        border-width: 2px;
    }
    
    .border-dashed {
        border-style: dashed;
    }
    
    .hidden {
        display: none;
    }

    #uploadArea:hover {
        border-color: #059669 !important;
        background: #f0fdf4 !important;
    }
</style>
@endpush

@push('scripts')
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // CSRF Token untuk AJAX requests
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    let currentCancellationId = null;

    // ✅ SHOW MODAL UPLOAD BUKTI TRANSFER
    function showTransferProofModal(id, bankName, accountNumber, amount) {
        currentCancellationId = id;
        document.getElementById('transferCancellationId').value = id;
        document.getElementById('transferBankName').textContent = bankName || '-';
        document.getElementById('transferAccountNumber').textContent = accountNumber || '-';
        document.getElementById('transferAmount').textContent = 'Rp ' + Number(amount).toLocaleString('id-ID');
        document.getElementById('transferProofForm').reset();
        document.getElementById('uploadPlaceholder').style.display = 'block';
        document.getElementById('uploadPreview').style.display = 'none';
        
        // Show Bootstrap modal - sekarang di tengah layar
        $('#transferProofModal').modal('show');
    }

    // ✅ SHOW MODAL REJECT
    function showRejectModal(id, projectTitle) {
        currentCancellationId = id;
        document.getElementById('rejectCancellationId').value = id;
        document.getElementById('rejectProjectTitle').textContent = projectTitle;
        document.getElementById('rejectReason').value = '';
        document.getElementById('rejectCharCount').textContent = '0';
        
        // Show Bootstrap modal - sekarang di tengah layar
        $('#rejectCancellationModal').modal('show');
    }

    // ✅ HANDLE FILE UPLOAD
    document.addEventListener('DOMContentLoaded', function() {
        const uploadArea = document.getElementById('uploadArea');
        const fileInput = document.getElementById('transferProofFile');

        if (uploadArea && fileInput) {
            uploadArea.addEventListener('click', () => fileInput.click());
            uploadArea.addEventListener('dragover', (e) => {
                e.preventDefault();
                uploadArea.style.borderColor = '#059669';
                uploadArea.style.background = '#f0fdf4';
            });
            uploadArea.addEventListener('dragleave', () => {
                uploadArea.style.borderColor = '#d1d5db';
                uploadArea.style.background = '#f9fafb';
            });
            uploadArea.addEventListener('drop', (e) => {
                e.preventDefault();
                uploadArea.style.borderColor = '#d1d5db';
                uploadArea.style.background = '#f9fafb';
                const files = e.dataTransfer.files;
                if (files.length > 0) {
                    fileInput.files = files;
                    previewFile(files[0]);
                }
            });
            fileInput.addEventListener('change', function() {
                if (this.files.length > 0) previewFile(this.files[0]);
            });
        }

        // Character counter
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
    function previewFile(file) {
        const uploadPlaceholder = document.getElementById('uploadPlaceholder');
        const uploadPreview = document.getElementById('uploadPreview');
        const fileName = document.getElementById('fileName');

        const maxLength = 25;
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

    // ✅ SUBMIT TRANSFER PROOF - LOGIKA TETAP SAMA
    async function submitTransferProof() {
        const fileInput = document.getElementById('transferProofFile');
        if (!fileInput.files || fileInput.files.length === 0) {
            showNotification('Harap upload bukti transfer terlebih dahulu!', 'error');
            return;
        }

        const file = fileInput.files[0];
        const maxSize = 5 * 1024 * 1024;
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
                headers: {'X-CSRF-TOKEN': csrfToken},
                body: formData
            });

            const data = await response.json();
            if (data.success) {
                showNotification(data.message, 'success');
                $('#transferProofModal').modal('hide');
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

    // ✅ SUBMIT REJECT - LOGIKA TETAP SAMA
    async function submitRejectCancellation() {
        const reason = document.getElementById('rejectReason').value.trim();
        if (!reason || reason.length < 10) {
            showNotification('Alasan penolakan minimal 10 karakter!', 'error');
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
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({reason: reason})
            });

            const data = await response.json();
            if (data.success) {
                showNotification(data.message, 'success');
                $('#rejectCancellationModal').modal('hide');
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

    // ✅ FORMAT FILE SIZE
    function formatFileSize(bytes) {
        if (!bytes) return '0 Bytes';
        const k = 1024;
        const sizes = ['Bytes', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
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

    // FUNGSI LAINNYA TETAP SAMA...
    function viewFullReason(reason) {
        Swal.fire({
            title: 'Alasan Pembatalan Lengkap',
            html: `<div class="text-left" style="max-height: 400px; overflow-y: auto;">
                <p style="white-space: pre-wrap; line-height: 1.6;">${reason || 'Tidak ada alasan yang dicantumkan'}</p>
            </div>`,
            icon: 'info',
            confirmButtonText: 'Tutup',
            width: '600px'
        });
    }

    function viewAllEvidence(cancellationId) {
        // ... kode tetap sama
    }

    function showEvidenceModal(evidenceFiles) {
        // ... kode tetap sama
    }

    function zoomImage(imageUrl) {
        // ... kode tetap sama
    }

    function zoomImageFull(imageUrl) {
        // ... kode tetap sama
    }

    function viewTransferProof(url) {
        // ... kode tetap sama
    }

    function viewRejectionReason(reason) {
        // ... kode tetap sama
    }
</script>
@endpush