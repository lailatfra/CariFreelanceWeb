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
        <form id="filterForm" method="GET" action="{{ route('admin.cancels.index') }}">
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
              <a href="{{ route('admin.cancels.index') }}" class="btn btn-outline-secondary"><i class="fas fa-undo"></i> Reset</a>
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
        <a href="{{ route('admin.cancels.index') }}" class="btn btn-sm btn-outline-light"><i class="fas fa-sync-alt"></i> Refresh</a>
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
            <th class="font-weight-bold text-gray-700">Client & Proyek</th>
            <th class="font-weight-bold text-gray-700">Freelancer</th>
            <th class="font-weight-bold text-gray-700">ID Rekening</th>
            <th class="font-weight-bold text-gray-700">Amount</th>
            <th class="font-weight-bold text-gray-700">Progress</th>
            <th class="font-weight-bold text-gray-700">Status</th>
            <th class="font-weight-bold text-gray-700">Tanggal</th>
            <th class="font-weight-bold text-gray-700 text-center">Aksi</th>
          </tr>
        </thead>
        <tbody id="tableBody">
          <!-- Data akan dimuat via JavaScript setelah filter -->
        </tbody>
      </table>
    </div>
    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-3">
      <nav aria-label="Pagination">
        <ul class="pagination">
          <li class="page-item"><a class="page-link" href="#" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
          <li class="page-item active"><a class="page-link" href="#">1</a></li>
          <li class="page-item"><a class="page-link" href="#">2</a></li>
          <li class="page-item"><a class="page-link" href="#">3</a></li>
          <li class="page-item"><a class="page-link" href="#" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>
        </ul>
      </nav>
    </div>
  </div>
</div>

<!-- Modal Detail -->
<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header bg-gradient-primary text-white">
        <h5 class="modal-title" id="detailModalLabel">Detail Pembatalan Proyek</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="detailContent">
        <div class="text-center py-4">
          <div class="spinner-border text-primary" role="status">
            <span class="sr-only">Loading...</span>
          </div>
          <p class="mt-2">Loading...</p>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal Bukti Files -->
<div class="modal fade" id="evidenceModal" tabindex="-1" role="dialog" aria-labelledby="evidenceModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header bg-gradient-info text-white">
        <h5 class="modal-title" id="evidenceModalLabel"><i class="fas fa-paperclip"></i> Bukti Pendukung Pembatalan Proyek</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="evidenceContent">
        <div class="text-center py-4">
          <div class="spinner-border text-info" role="status">
            <span class="sr-only">Loading...</span>
          </div>
          <p class="mt-2">Loading bukti pendukung...</p>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal Approve -->
<div class="modal fade" id="approveModal" tabindex="-1" role="dialog" aria-labelledby="approveModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header bg-gradient-success text-white">
        <h5 class="modal-title" id="approveModalLabel"><i class="fas fa-check mr-2"></i>Setujui Pembatalan Proyek</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="approveForm" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="alert alert-success"><i class="fas fa-info-circle"></i> Refund akan diproses dan freelancer akan diberi peringatan.</div>
          
          <!-- Informasi Rekening Tujuan -->
          <div class="card bg-light border-info mb-4">
            <div class="card-header bg-info text-white py-2">
              <h6 class="mb-0"><i class="fas fa-university mr-2"></i>Informasi Rekening Tujuan Refund</h6>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                  <table class="table table-sm table-borderless mb-0">
                    <tr>
                      <td class="font-weight-bold text-muted" style="width: 40%;">Nama Pemilik:</td>
                      <td id="accountHolderName" class="font-weight-bold">-</td>
                    </tr>
                    <tr>
                      <td class="font-weight-bold text-muted">Bank:</td>
                      <td id="bankName" class="font-weight-bold text-primary">-</td>
                    </tr>
                  </table>
                </div>
                <div class="col-md-6">
                  <table class="table table-sm table-borderless mb-0">
                    <tr>
                      <td class="font-weight-bold text-muted" style="width: 40%;">No. Rekening:</td>
                      <td id="accountNumber" class="font-weight-bold text-success">-</td>
                    </tr>
                    <tr>
                      <td class="font-weight-bold text-muted">ID Akun:</td>
                      <td id="accountId" class="font-weight-bold text-secondary">-</td>
                    </tr>
                  </table>
                </div>
              </div>
              <div class="mt-2 p-2 bg-warning bg-opacity-10 rounded">
                <small class="text-warning">
                  <i class="fas fa-exclamation-triangle mr-1"></i>
                  <strong>Penting:</strong> Pastikan nomor rekening sudah benar sebelum melakukan transfer.
                </small>
              </div>
            </div>
          </div>
          
          <!-- Refund Amount -->
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label class="font-weight-bold">Jumlah Refund</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Rp</span>
                  </div>
                  <input type="number" name="refund_amount" class="form-control" id="refundAmount" readonly>
                </div>
                <small class="text-muted">Jumlah akan dihitung berdasarkan progress dan kebijakan refund</small>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="font-weight-bold">Perhitungan Refund</label>
                <div class="card bg-light">
                  <div class="card-body p-3">
                    <small class="text-muted">
                      <strong>Formula:</strong><br>
                      Nilai Proyek × (100% - Progress) × 70%<br>
                      <div id="refundCalculation" class="mt-2 text-primary">
                        <!-- Akan diisi via JavaScript -->
                      </div>
                    </small>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Upload Bukti Transfer -->
          <div class="form-group">
            <label class="font-weight-bold">Upload Bukti Transfer <span class="text-danger">*</span></label>
            <div class="custom-file mb-2">
              <input type="file" name="transfer_proof" class="custom-file-input" id="transferProof" accept="image/*" required>
              <label class="custom-file-label" for="transferProof">Pilih file gambar bukti transfer...</label>
            </div>
            <small class="text-muted">
              <i class="fas fa-info-circle text-info"></i> 
              Format yang didukung: JPG, PNG, GIF. Maksimal ukuran 5MB.
            </small>
            
            <!-- Preview Image -->
            <div id="imagePreview" style="display: none;" class="mt-3">
              <label class="font-weight-bold text-muted small">Preview:</label><br>
              <div class="border rounded p-2" style="max-width: 300px;">
                <img id="previewImg" src="" alt="Preview" class="img-fluid rounded" style="max-height: 200px;">
                <div class="mt-2 text-center">
                  <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeImage()">
                    <i class="fas fa-trash"></i> Hapus
                  </button>
                </div>
              </div>
            </div>
          </div>

          <!-- Catatan untuk Client -->
          <div class="form-group">
            <label class="font-weight-bold">Catatan untuk Client</label>
            <textarea name="client_notes" class="form-control" rows="3" placeholder="Catatan yang akan dikirim ke client..."></textarea>
          </div>
          
          <!-- Tindakan terhadap Freelancer -->
          <div class="form-group">
            <label class="font-weight-bold">Tindakan terhadap Freelancer</label>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="warn_freelancer" id="warnFreelancer" checked>
              <label class="form-check-label" for="warnFreelancer">Beri peringatan ke freelancer</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="reduce_rating" id="reduceRating">
              <label class="form-check-label" for="reduceRating">Kurangi rating freelancer</label>
            </div>
          </div>
        </div>
        <div class="modal-footer bg-light">
          <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-success"><i class="fas fa-check"></i> Setujui & Proses Refund</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Reject -->
<div class="modal fade" id="rejectModal" tabindex="-1" role="dialog" aria-labelledby="rejectModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-gradient-danger text-white">
        <h5 class="modal-title" id="rejectModalLabel"><i class="fas fa-times mr-2"></i>Tolak Pembatalan Proyek</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="rejectForm">
        <div class="modal-body">
          <div class="alert alert-danger"><i class="fas fa-exclamation-triangle"></i> Berikan alasan penolakan yang jelas dan saran solusi.</div>
          <div class="form-group">
            <label class="font-weight-bold">Alasan Penolakan <span class="text-danger">*</span></label>
            <textarea name="rejection_reason" class="form-control" rows="4" placeholder="Masukkan alasan mengapa pembatalan tidak disetujui..." required></textarea>
          </div>
          <div class="form-group">
            <label class="font-weight-bold">Saran Solusi</label>
            <textarea name="suggested_solution" class="form-control" rows="3" placeholder="Berikan saran untuk menyelesaikan masalah..."></textarea>
          </div>
          <div class="form-group">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="escalate_to_mediation" id="escalateMediation">
              <label class="form-check-label" for="escalateMediation">Escalate ke tim mediasi</label>
            </div>
          </div>
        </div>
        <div class="modal-footer bg-light">
          <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-danger"><i class="fas fa-times"></i> Tolak Pembatalan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Alasan Penolakan -->
<div class="modal fade" id="rejectionReasonModal" tabindex="-1" role="dialog" aria-labelledby="rejectionReasonModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-gradient-danger text-white">
        <h5 class="modal-title" id="rejectionReasonModalLabel"><i class="fas fa-info-circle mr-2"></i>Alasan Penolakan</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="rejectionReasonContent">
        <!-- Konten alasan akan dimuat di sini -->
      </div>
      <div class="modal-footer bg-light">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
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
}
.account-id-container {
  min-width: 120px;
}
.account-id-badge {
  font-size: 0.75rem;
  padding: 0.25rem 0.5rem;
  margin-right: 0.25rem;
}
</style>
@endpush

@push('scripts')
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
// Data mock untuk testing
const mockCancellationsData = {
  1: { 
    id: 1,
    account_id: 'ACC-0012345678',
    bank_name: 'BCA',
    account_number: '1234567890',
    account_holder_name: 'PT. Digital Solutions',
    project_title: 'Aplikasi E-commerce Mobile',
    client_name: 'PT. Digital Solutions',
    client_email: 'contact@digitalsolutions.com',
    freelancer_name: 'Ahmad Rizki',
    freelancer_email: 'ahmad.rizki@email.com',
    project_value: 15000000,
    progress_percentage: 30,
    refund_amount: 10500000,
    reason: 'Freelancer tidak responsif selama 2 minggu dan tidak ada progress yang signifikan',
    status: 'pending',
    evidence_files: [
      {type: 'image', name: 'chat_history.png', size: '245 KB', url: '#'},
      {type: 'pdf', name: 'email_followup.pdf', size: '156 KB', url: '#'},
      {type: 'image', name: 'project_dashboard.png', size: '389 KB', url: '#'}
    ],
    created_at: '2024-09-20 14:30:00'
  },
  2: { 
    id: 2,
    account_id: 'ACC-0098765432',
    bank_name: 'Mandiri',
    account_number: '0987654321',
    account_holder_name: 'CV. Maju Bersama',
    project_title: 'Website Company Profile',
    client_name: 'CV. Maju Bersama',
    client_email: 'info@majubersama.com',
    freelancer_name: 'Sari Wijaya',
    freelancer_email: 'sari.wijaya@email.com',
    project_value: 5000000,
    progress_percentage: 60,
    refund_amount: 2000000,
    reason: 'Hasil tidak sesuai dengan requirement dan revisi tidak kunjung selesai',
    status: 'pending',
    evidence_files: [
      {type: 'image', name: 'screenshot1.png', size: '300 KB', url: '#'},
      {type: 'image', name: 'screenshot2.png', size: '320 KB', url: '#'},
      {type: 'pdf', name: 'revision_notes.pdf', size: '180 KB', url: '#'},
      {type: 'doc', name: 'requirements.doc', size: '200 KB', url: '#'},
      {type: 'image', name: 'mockup.png', size: '450 KB', url: '#'}
    ],
    created_at: '2024-09-19 10:15:00'
  },
  3: { 
    id: 3,
    account_id: 'ACC-1122334455',
    bank_name: 'BNI',
    account_number: '1122334455',
    account_holder_name: 'Startup Innovation',
    project_title: 'Logo & Brand Identity',
    client_name: 'Startup Innovation',
    client_email: 'hello@startupinnovation.id',
    freelancer_name: 'Budi Santoso',
    freelancer_email: 'budi.santoso@email.com',
    project_value: 3000000,
    progress_percentage: 80,
    refund_amount: 600000,
    reason: 'Perubahan strategi bisnis perusahaan',
    status: 'approved',
    evidence_files: [],
    created_at: '2024-09-18 16:45:00',
    approved_at: '2024-09-19 09:30:00',
    approved_by: 'Admin Supervisor'
  },
  4: {
    id: 4,
    account_id: 'ACC-9988776655',
    bank_name: 'BRI',
    account_number: '9988776655',
    account_holder_name: 'Tech Startup Ltd',
    project_title: 'Mobile App Development',
    client_name: 'Tech Startup Ltd',
    client_email: 'tech@startup.com',
    freelancer_name: 'Diana Putri',
    freelancer_email: 'diana.putri@email.com',
    project_value: 8000000,
    progress_percentage: 15,
    refund_amount: 6800000,
    reason: 'Kualitas coding sangat buruk dan tidak memenuhi standar',
    status: 'rejected',
    evidence_files: [
      {type: 'image', name: 'error_screenshot.png', size: '280 KB', url: '#'},
      {type: 'pdf', name: 'code_review.pdf', size: '190 KB', url: '#'}
    ],
    created_at: '2024-09-17 09:20:00',
    rejected_at: '2024-09-18 14:15:00',
    rejected_by: 'Admin Manager',
    rejection_reason: 'Bukti tidak cukup kuat, perlu mediasi dengan freelancer'
  }
};

// Variable untuk menyimpan ID saat ini
let currentCancellationId = null;
let filteredData = Object.values(mockCancellationsData);

// Fungsi untuk memfilter data
function filterData() {
  const status = document.getElementById('filterStatus').value;
  const dateFrom = document.getElementById('filterDateFrom').value;
  const dateTo = document.getElementById('filterDateTo').value;
  const search = document.getElementById('filterSearch').value.toLowerCase();
  
  filteredData = Object.values(mockCancellationsData).filter(item => {
    // Filter status
    if (status && item.status !== status) {
      return false;
    }
    
    // Filter tanggal
    const itemDate = new Date(item.created_at);
    if (dateFrom) {
      const fromDate = new Date(dateFrom);
      if (itemDate < fromDate) return false;
    }
    if (dateTo) {
      const toDate = new Date(dateTo);
      toDate.setHours(23, 59, 59, 999); // Set ke akhir hari
      if (itemDate > toDate) return false;
    }
    
    // Filter pencarian
    if (search) {
      const searchIn = `${item.client_name} ${item.project_title} ${item.freelancer_name}`.toLowerCase();
      if (!searchIn.includes(search)) return false;
    }
    
    return true;
  });
  
  renderTable();
}

// Fungsi untuk merender tabel
function renderTable() {
  const tbody = document.getElementById('tableBody');
  
  if (filteredData.length === 0) {
    tbody.innerHTML = `
      <tr>
        <td colspan="10" class="text-center py-4">
          <div class="text-muted">
            <i class="fas fa-ban fa-3x mb-3" style="color: #e3e6f0;"></i>
            <h5>Tidak ada data ditemukan</h5>
            <p>Silakan ubah filter pencarian.</p>
          </div>
        </td>
      </tr>
    `;
    return;
  }
  
  let html = '';
  filteredData.forEach((cancellation, index) => {
    const statusClass = {
      'pending': 'secondary',
      'approved': 'success',
      'rejected': 'danger'
    }[cancellation.status] || 'light';
    
    let statusInfo = '';
    if (cancellation.status === 'approved' && cancellation.approved_at) {
      statusInfo = `
        <div class="mt-1">
          <small class="text-success">
            <i class="fas fa-user-check"></i> ${cancellation.approved_by}<br>
            <i class="fas fa-clock"></i> ${new Date(cancellation.approved_at).toLocaleDateString('id-ID')}
          </small>
        </div>
      `;
    } else if (cancellation.status === 'rejected' && cancellation.rejected_at) {
      statusInfo = `
        <div class="mt-1">
          <small class="text-danger">
            <i class="fas fa-user-times"></i> ${cancellation.rejected_by}<br>
            <i class="fas fa-clock"></i> ${new Date(cancellation.rejected_at).toLocaleDateString('id-ID')}
          </small>
        </div>
      `;
    }
    
    html += `
      <tr class="hover-row">
        <td>
          ${cancellation.status === 'pending' ? `
            <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input cancellation-checkbox" id="check${cancellation.id}" value="${cancellation.id}">
              <label class="custom-control-label" for="check${cancellation.id}"></label>
            </div>
          ` : ''}
        </td>
        <td class="font-weight-bold">${index + 1}</td>
        <td>
          <div class="d-flex align-items-center">
            <div class="mr-3">
              <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center" style="width: 35px; height: 35px;">
                <i class="fas fa-user-tie"></i>
              </div>
            </div>
            <div>
              <div class="font-weight-bold">${cancellation.client_name.length > 25 ? cancellation.client_name.substring(0, 25) + '...' : cancellation.client_name}</div>
              <small class="text-muted">${cancellation.client_email.length > 30 ? cancellation.client_email.substring(0, 30) + '...' : cancellation.client_email}</small><br>
              <small class="text-primary font-weight-bold">${cancellation.project_title.length > 30 ? cancellation.project_title.substring(0, 30) + '...' : cancellation.project_title}</small>
            </div>
          </div>
        </td>
        <td>
          <div class="font-weight-bold">${cancellation.freelancer_name.length > 20 ? cancellation.freelancer_name.substring(0, 20) + '...' : cancellation.freelancer_name}</div>
          <small class="text-muted">${cancellation.freelancer_email.length > 25 ? cancellation.freelancer_email.substring(0, 25) + '...' : cancellation.freelancer_email}</small>
        </td>
        <td>
          <div class="d-flex align-items-center">
            <div class="mr-2">
              <div class="rounded bg-info text-white d-flex align-items-center justify-content-center" style="width: 25px; height: 25px; font-size: 0.7rem;">
                <i class="fas fa-university"></i>
              </div>
            </div>
            <div>
              <div class="font-weight-bold small text-primary">${cancellation.account_id}</div>
              <small class="text-muted">${cancellation.bank_name}</small>
            </div>
          </div>
        </td>
        <td>
          <div class="font-weight-bold text-success">Rp ${(cancellation.project_value/1000000).toFixed(1)}M</div>
          
        </td>
        <td>
          <div class="progress mb-1" style="height: 8px;">
            <div class="progress-bar bg-info" style="width: ${cancellation.progress_percentage}%"></div>
          </div>
          <small class="text-muted">${cancellation.progress_percentage}%</small>
        </td>
        <td>
          <span class="badge badge-${statusClass} px-3 py-2" style="font-size: 0.75rem;">
            ${cancellation.status.toUpperCase()}
          </span>
          ${statusInfo}
        </td>
        <td>
          <small class="text-muted">${new Date(cancellation.created_at).toLocaleDateString('id-ID', {year: 'numeric', month: 'short', day: 'numeric'})}</small>
        </td>
        <td class="text-center">
          <div class="btn-group" role="group">
            <button type="button" class="btn btn-sm btn-outline-primary" onclick="viewDetail(${cancellation.id})" title="Lihat Detail">
              <i class="fas fa-eye"></i>
            </button>
            
            ${cancellation.status === 'pending' ? `
              <button type="button" class="btn btn-sm btn-outline-success" onclick="approveCancellation(${cancellation.id})" title="Approve">
                <i class="fas fa-check"></i>
              </button>
              <button type="button" class="btn btn-sm btn-outline-danger" onclick="rejectCancellation(${cancellation.id})" title="Reject">
                <i class="fas fa-times"></i>
              </button>
            ` : ''}
            
            ${cancellation.status === 'rejected' ? `
              <button type="button" class="btn btn-sm btn-outline-info" onclick="viewRejectionReason(${cancellation.id}, '${cancellation.rejection_reason ? cancellation.rejection_reason.replace(/'/g, "\\'") : ''}')" title="Lihat Alasan">
                <i class="fas fa-info-circle"></i>
              </button>
            ` : ''}

            ${cancellation.evidence_files && cancellation.evidence_files.length > 0 ? `
              <button type="button" class="btn btn-sm btn-outline-secondary" onclick="viewEvidence(${cancellation.id})" title="Lihat Semua Bukti">
                <i class="fas fa-paperclip"></i>
                <small>${cancellation.evidence_files.length}</small>
              </button>
            ` : ''}
          </div>
        </td>
      </tr>
    `;
  });
  
  tbody.innerHTML = html;
  
  // Re-attach checkbox events
  attachCheckboxEvents();
}

// Fungsi untuk attach checkbox events
function attachCheckboxEvents() {
  document.getElementById('selectAll').addEventListener('change', function() {
    document.querySelectorAll('.cancellation-checkbox').forEach(cb => {
      cb.checked = this.checked;
    });
    toggleBulkButtons();
  });

  document.querySelectorAll('.cancellation-checkbox').forEach(cb => {
    cb.addEventListener('change', toggleBulkButtons);
  });
}

function toggleBulkButtons() {
  const checkedCount = document.querySelectorAll('.cancellation-checkbox:checked').length;
  const bulkButtons = document.querySelectorAll('#bulkApprove, #bulkReject');
  
  if (checkedCount > 0) {
    bulkButtons.forEach(btn => btn.style.display = 'inline-block');
  } else {
    bulkButtons.forEach(btn => btn.style.display = 'none');
  }
}

// Fungsi untuk melihat detail pembatalan
window.viewDetail = function(id) {
  const data = mockCancellationsData[id];
  if (!data) {
    Swal.fire('Error', 'Data tidak ditemukan!', 'error');
    return;
  }

  let statusBadge = '';
  switch(data.status) {
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
    data.evidence_files.forEach(file => {
      const iconClass = file.type === 'image' ? 'fa-image text-primary' : 
                       file.type === 'pdf' ? 'fa-file-pdf text-danger' : 'fa-file-alt text-secondary';
      filesHtml += `
        <div class="mb-2">
          <i class="fas ${iconClass} mr-2"></i>
          <a href="${file.url}" target="_blank" class="text-decoration-none">${file.name}</a>
          <small class="text-muted">(${file.size})</small>
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
          <tr><td class="font-weight-bold">Judul Proyek:</td><td>${data.project_title}</td></tr>
          <tr><td class="font-weight-bold">Nilai Proyek:</td><td>Rp ${data.project_value.toLocaleString('id-ID')}</td></tr>
          <tr><td class="font-weight-bold">Progress:</td><td>${data.progress_percentage}%</td></tr>
          <tr><td class="font-weight-bold">Refund Amount:</td><td class="text-danger font-weight-bold">Rp ${data.refund_amount.toLocaleString('id-ID')}</td></tr>
          <tr><td class="font-weight-bold">Status:</td><td>${statusBadge}</td></tr>
        </table>
      </div>
      <div class="col-md-6">
        <h6 class="font-weight-bold text-primary">Informasi Client & Freelancer</h6>
        <table class="table table-sm table-borderless">
          <tr><td class="font-weight-bold">Client:</td><td>${data.client_name}<br><small class="text-muted">${data.client_email}</small></td></tr>
          <tr><td class="font-weight-bold">Freelancer:</td><td>${data.freelancer_name}<br><small class="text-muted">${data.freelancer_email}</small></td></tr>
          <tr><td class="font-weight-bold">ID Rekening:</td><td>${data.account_id} (${data.bank_name})</td></tr>
        </table>
      </div>
    </div>
    
    <hr>
    
    <h6 class="font-weight-bold text-primary">Alasan Pembatalan</h6>
    <div class="alert alert-light">
      <p class="mb-0">${data.reason}</p>
    </div>
    
    <hr>
    
    ${filesHtml}
  `;

  document.getElementById('detailContent').innerHTML = content;
  $('#detailModal').modal('show');
};

// Fungsi untuk melihat bukti evidence
window.viewEvidence = function(id) {
  const data = mockCancellationsData[id];
  if (!data || !data.evidence_files || data.evidence_files.length === 0) {
    Swal.fire('Info', 'Tidak ada bukti pendukung untuk pembatalan ini.', 'info');
    return;
  }

  let evidenceHtml = '<div class="row">';
  
  data.evidence_files.forEach((file, index) => {
    const iconClass = file.type === 'image' ? 'fa-image text-primary' : 
                     file.type === 'pdf' ? 'fa-file-pdf text-danger' : 'fa-file-alt text-secondary';
    
    evidenceHtml += `
      <div class="col-md-6 mb-3">
        <div class="card">
          <div class="card-body text-center">
            <i class="fas ${iconClass} fa-3x mb-3"></i>
            <h6 class="card-title">${file.name}</h6>
            <p class="text-muted small">${file.size}</p>
            <a href="${file.url}" class="btn btn-sm btn-outline-primary" target="_blank">
              <i class="fas fa-download"></i> Download
            </a>
          </div>
        </div>
      </div>
    `;
  });
  
  evidenceHtml += '</div>';
  
  document.getElementById('evidenceContent').innerHTML = evidenceHtml;
  $('#evidenceModal').modal('show');
};

// Fungsi untuk approve pembatalan
window.approveCancellation = function(id) {
  const data = mockCancellationsData[id];
  if (!data) {
    Swal.fire('Error', 'Data tidak ditemukan!', 'error');
    return;
  }

  currentCancellationId = id;
  
  // Reset form
  document.getElementById('approveForm').reset();
  
  // Set informasi rekening
  document.getElementById('accountHolderName').textContent = data.account_holder_name || data.client_name;
  document.getElementById('bankName').textContent = data.bank_name;
  document.getElementById('accountNumber').textContent = data.account_number || 'Tidak tersedia';
  document.getElementById('accountId').textContent = data.account_id;
  
  // Hitung refund berdasarkan formula
  const refundPolicy = 0.7; // 70% dari sisa pekerjaan
  const remainingWork = (100 - data.progress_percentage) / 100;
  const calculatedRefund = Math.round(data.project_value * remainingWork * refundPolicy);
  
  // Set nilai refund
  document.getElementById('refundAmount').value = calculatedRefund;
  
  // Tampilkan perhitungan
  const calculationText = `
    <strong>Detail:</strong><br>
    Rp ${data.project_value.toLocaleString('id-ID')} × (100% - ${data.progress_percentage}%) × 70%<br>
    = Rp ${data.project_value.toLocaleString('id-ID')} × ${(remainingWork * 100).toFixed(0)}% × 70%<br>
    = <strong>Rp ${calculatedRefund.toLocaleString('id-ID')}</strong>
  `;
  document.getElementById('refundCalculation').innerHTML = calculationText;
  
  // Reset preview image
  document.getElementById('imagePreview').style.display = 'none';
  document.querySelector('.custom-file-label').textContent = 'Pilih file gambar bukti transfer...';
  
  $('#approveModal').modal('show');
};

// Fungsi untuk reject pembatalan
window.rejectCancellation = function(id) {
  currentCancellationId = id;
  document.getElementById('rejectForm').reset();
  $('#rejectModal').modal('show');
};

// Fungsi untuk melihat alasan penolakan
window.viewRejectionReason = function(id, reason) {
  const content = `
    <div class="alert alert-danger">
      <h6 class="alert-heading"><i class="fas fa-exclamation-triangle"></i> Pembatalan Ditolak</h6>
      <hr>
      <p><strong>Alasan Penolakan:</strong></p>
      <p class="mb-0">${reason || 'Alasan tidak tersedia'}</p>
    </div>
  `;
  
  document.getElementById('rejectionReasonContent').innerHTML = content;
  $('#rejectionReasonModal').modal('show');
};

// Image preview functionality
window.removeImage = function() {
  document.getElementById('transferProof').value = '';
  document.getElementById('imagePreview').style.display = 'none';
  document.querySelector('.custom-file-label').textContent = 'Pilih file gambar bukti transfer...';
};

// Event listeners
$(document).ready(function() {
  // Initial render
  renderTable();
  
  // Filter form submit
  document.getElementById('filterForm').addEventListener('submit', function(e) {
    e.preventDefault();
    filterData();
  });
  
  // Real-time filter
  document.getElementById('filterStatus').addEventListener('change', filterData);
  document.getElementById('filterDateFrom').addEventListener('change', filterData);
  document.getElementById('filterDateTo').addEventListener('change', filterData);
  document.getElementById('filterSearch').addEventListener('input', function() {
    // Debounce search input
    clearTimeout(this.searchTimeout);
    this.searchTimeout = setTimeout(filterData, 300);
  });

  // File upload preview
  document.getElementById('transferProof').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = function(e) {
        document.getElementById('previewImg').src = e.target.result;
        document.getElementById('imagePreview').style.display = 'block';
      };
      reader.readAsDataURL(file);
      document.querySelector('.custom-file-label').textContent = file.name;
    }
  });

  // Form submissions
  $('#approveForm').on('submit', function(e) {
    e.preventDefault();
    
    if (!currentCancellationId) {
      Swal.fire('Error', 'ID pembatalan tidak valid!', 'error');
      return;
    }

    Swal.fire({
      title: 'Konfirmasi Persetujuan',
      text: 'Apakah Anda yakin ingin menyetujui pembatalan ini?',
      icon: 'question',
      showCancelButton: true,
      confirmButtonColor: '#28a745',
      cancelButtonColor: '#6c757d',
      confirmButtonText: 'Ya, Setujui',
      cancelButtonText: 'Batal'
    }).then((result) => {
      if (result.isConfirmed) {
        // Update status in mock data
        mockCancellationsData[currentCancellationId].status = 'approved';
        mockCancellationsData[currentCancellationId].approved_at = new Date().toISOString();
        mockCancellationsData[currentCancellationId].approved_by = 'Admin';
        
        Swal.fire({
          title: 'Berhasil!',
          text: 'Pembatalan telah disetujui dan refund akan diproses.',
          icon: 'success'
        });
        $('#approveModal').modal('hide');
        filterData(); // Refresh table
      }
    });
  });

  $('#rejectForm').on('submit', function(e) {
    e.preventDefault();
    
    if (!currentCancellationId) {
      Swal.fire('Error', 'ID pembatalan tidak valid!', 'error');
      return;
    }

    const reason = $(this).find('[name="rejection_reason"]').val();
    if (!reason.trim()) {
      Swal.fire('Error', 'Alasan penolakan harus diisi!', 'error');
      return;
    }

    Swal.fire({
      title: 'Konfirmasi Penolakan',
      text: 'Apakah Anda yakin ingin menolak pembatalan ini?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#dc3545',
      cancelButtonColor: '#6c757d',
      confirmButtonText: 'Ya, Tolak',
      cancelButtonText: 'Batal'
    }).then((result) => {
      if (result.isConfirmed) {
        // Update status in mock data
        mockCancellationsData[currentCancellationId].status = 'rejected';
        mockCancellationsData[currentCancellationId].rejected_at = new Date().toISOString();
        mockCancellationsData[currentCancellationId].rejected_by = 'Admin';
        mockCancellationsData[currentCancellationId].rejection_reason = reason;
        
        Swal.fire({
          title: 'Berhasil!',
          text: 'Pembatalan telah ditolak dan notifikasi akan dikirim ke client.',
          icon: 'success'
        });
        $('#rejectModal').modal('hide');
        filterData(); // Refresh table
      }
    });
  });
});
</script>
@endpush