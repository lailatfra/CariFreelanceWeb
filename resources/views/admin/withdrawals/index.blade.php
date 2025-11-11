@extends('admin.layouts.main')

@section('title', 'Manajemen Penarikan Dana')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Kelola Penarikan Dana</h1>
</div>

<!-- Dashboard Stats -->
<div class="row">
  <!-- Pending Card -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-primary shadow h-100 py-2" style="border-left: 4px solid #4e73df !important;">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Pending</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['total_pending'] ?? 5 }}</div>
          </div>
          <div class="col-auto">
            <i class="fas fa-clock fa-2x text-gray-400"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Approved Today Card -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-success shadow h-100 py-2" style="border-left: 4px solid #1cc88a !important;">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Disetujui Hari Ini</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['total_approved_today'] ?? 2 }}</div>
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
            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Total Ditolak</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['total_rejected'] ?? 3 }}</div>
          </div>
          <div class="col-auto">
            <i class="fas fa-times fa-2x text-gray-400"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Total Amount Pending Card -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-info shadow h-100 py-2" style="border-left: 4px solid #36b9cc !important;">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Amount Pending</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp {{ number_format($stats['total_amount_pending'] ?? 25000000, 0, ',', '.') }}</div>
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
        <form id="filterForm">
          <div class="row">
            <div class="col-md-3">
              <label class="form-label font-weight-bold">Status</label>
              <select name="status" class="form-control">
                <option value="">Semua Status</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
              </select>
            </div>
            <div class="col-md-3">
              <label class="form-label font-weight-bold">Tanggal Dari</label>
              <input type="date" name="date_from" class="form-control" value="{{ request('date_from') }}">
            </div>
            <div class="col-md-3">
              <label class="form-label font-weight-bold">Tanggal Sampai</label>
              <input type="date" name="date_to" class="form-control" value="{{ request('date_to') }}">
            </div>
          </div>
          <div class="row mt-3">
            <div class="col-md-12">
              <button type="submit" class="btn btn-primary"><i class="fas fa-filter"></i> Filter</button>
              <a href="{{ route('admin.withdrawals.index') }}" class="btn btn-outline-secondary"><i class="fas fa-undo"></i> Reset</a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Withdrawals Table -->
<div class="card shadow mb-4">
  <div class="card-header py-3 bg-gradient-primary">
    <div class="d-flex justify-content-between align-items-center">
      <h6 class="m-0 font-weight-bold text-white"><i class="fas fa-money-check-alt mr-2"></i>Daftar Penarikan Dana</h6>
      <div>
        <button class="btn btn-sm btn-success mr-2" id="bulkApprove" style="display: none;"><i class="fas fa-check"></i> Setujui Terpilih</button>
        <button class="btn btn-sm btn-danger mr-2" id="bulkReject" style="display: none;"><i class="fas fa-times"></i> Tolak Terpilih</button>
        <a href="{{ route('admin.withdrawals.index') }}" class="btn btn-sm btn-outline-light"><i class="fas fa-sync-alt"></i> Refresh</a>
      </div>
    </div>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered table-hover" width="100%" cellspacing="0">
        <thead class="bg-gray-200">
          <tr>
            <th class="font-weight-bold text-gray-700">
              <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="selectAll">
                <label class="custom-control-label" for="selectAll"></label>
              </div>
            </th>
            <th class="font-weight-bold text-gray-700">#</th>
            <th class="font-weight-bold text-gray-700">Freelancer</th>
            <th class="font-weight-bold text-gray-700">Amount</th>
            <th class="font-weight-bold text-gray-700">Bank Details</th>
            <th class="font-weight-bold text-gray-700">Status</th>
            <th class="font-weight-bold text-gray-700">Tanggal</th>
            <th class="font-weight-bold text-gray-700 text-center">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @php
          $mockWithdrawals = [
            [
              'id' => 1,
              'freelancer_name' => 'Ahmad Rizki',
              'freelancer_email' => 'ahmad.rizki@email.com',
              'amount' => 1500000,
              'bank_name' => 'Bank BCA',
              'account_number' => '1234567890',
              'account_name' => 'Ahmad Rizki',
              'status' => 'pending',
              'created_at' => '2024-09-20 14:30:00'
            ],
            [
              'id' => 2,
              'freelancer_name' => 'Sari Wijaya',
              'freelancer_email' => 'sari.wijaya@email.com',
              'amount' => 2500000,
              'bank_name' => 'Bank Mandiri',
              'account_number' => '9876543210',
              'account_name' => 'Sari Wijaya',
              'status' => 'pending',
              'created_at' => '2024-09-19 10:15:00'
            ],
            [
              'id' => 3,
              'freelancer_name' => 'Budi Santoso',
              'freelancer_email' => 'budi.santoso@email.com',
              'amount' => 1000000,
              'bank_name' => 'Bank BNI',
              'account_number' => '1122334455',
              'account_name' => 'Budi Santoso',
              'status' => 'approved',
              'created_at' => '2024-09-18 16:45:00',
              'approved_at' => '2024-09-19 09:30:00',
              'approved_by' => 'Admin Supervisor'
            ],
            [
              'id' => 4,
              'freelancer_name' => 'Diana Putri',
              'freelancer_email' => 'diana.putri@email.com',
              'amount' => 2000000,
              'bank_name' => 'Bank BRI',
              'account_number' => '5566778899',
              'account_name' => 'Diana Putri',
              'status' => 'rejected',
              'created_at' => '2024-09-17 09:20:00',
              'rejected_at' => '2024-09-18 14:15:00',
              'rejected_by' => 'Admin Manager',
              'rejection_reason' => 'Informasi rekening tidak valid'
            ]
          ];
          @endphp

          @forelse($mockWithdrawals as $index => $withdrawal)
          <tr class="hover-row">
            <td>
              @if($withdrawal['status'] === 'pending')
              <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input withdrawal-checkbox" id="check{{ $withdrawal['id'] }}" value="{{ $withdrawal['id'] }}">
                <label class="custom-control-label" for="check{{ $withdrawal['id'] }}"></label>
              </div>
              @endif
            </td>
            <td class="font-weight-bold">{{ $index + 1 }}</td>
            <td>
              <div class="d-flex align-items-center">
                <div class="mr-3">
                  <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center" style="width: 35px; height: 35px;">
                    <i class="fas fa-user"></i>
                  </div>
                </div>
                <div>
                  <div class="font-weight-bold">{{ Str::limit($withdrawal['freelancer_name'], 25) }}</div>
                  <small class="text-muted">{{ Str::limit($withdrawal['freelancer_email'], 30) }}</small>
                </div>
              </div>
            </td>
            <td>
              <div class="font-weight-bold text-success">Rp {{ number_format($withdrawal['amount'], 0, ',', '.') }}</div>
            </td>
            <td>
              <div class="d-flex align-items-center">
                <div class="mr-2">
                  <div class="rounded bg-info text-white d-flex align-items-center justify-content-center" style="width: 25px; height: 25px; font-size: 0.7rem;">
                    <i class="fas fa-university"></i>
                  </div>
                </div>
                <div>
                  <div class="font-weight-bold small text-primary">{{ $withdrawal['account_number'] }}</div>
                  <small class="text-muted">{{ $withdrawal['bank_name'] }}</small><br>
                  <small class="text-dark">{{ $withdrawal['account_name'] }}</small>
                </div>
              </div>
            </td>
            <td>
              @php
              $statusClass = match($withdrawal['status']) {
                'pending' => 'secondary',
                'approved' => 'success',
                'rejected' => 'danger',
                default => 'light'
              };
              @endphp
              <span class="badge badge-{{ $statusClass }} px-3 py-2" style="font-size: 0.75rem;">
                {{ strtoupper($withdrawal['status']) }}
              </span>
              
              @if($withdrawal['status'] === 'approved' && isset($withdrawal['approved_at']))
                <div class="mt-1">
                  <small class="text-success">
                    <i class="fas fa-user-check"></i> {{ $withdrawal['approved_by'] }}<br>
                    <i class="fas fa-clock"></i> {{ date('d/m/y H:i', strtotime($withdrawal['approved_at'])) }}
                  </small>
                </div>
              @elseif($withdrawal['status'] === 'rejected' && isset($withdrawal['rejected_at']))
                <div class="mt-1">
                  <small class="text-danger">
                    <i class="fas fa-user-times"></i> {{ $withdrawal['rejected_by'] }}<br>
                    <i class="fas fa-clock"></i> {{ date('d/m/y H:i', strtotime($withdrawal['rejected_at'])) }}
                  </small>
                </div>
              @endif
            </td>
            <td>
              <small class="text-muted">{{ date('M d, Y', strtotime($withdrawal['created_at'])) }}</small>
            </td>
            <td class="text-center">
              <div class="btn-group" role="group">
                <button type="button" class="btn btn-sm btn-outline-primary" onclick="viewDetail({{ $withdrawal['id'] }})" title="Lihat Detail">
                  <i class="fas fa-eye"></i>
                </button>
                
                @if($withdrawal['status'] === 'pending')
                  <button type="button" class="btn btn-sm btn-outline-success" onclick="approveWithdrawal({{ $withdrawal['id'] }})" title="Approve">
                    <i class="fas fa-check"></i>
                  </button>
                  <button type="button" class="btn btn-sm btn-outline-danger" onclick="rejectWithdrawal({{ $withdrawal['id'] }})" title="Reject">
                    <i class="fas fa-times"></i>
                  </button>
                @elseif($withdrawal['status'] === 'rejected')
                  <button type="button" class="btn btn-sm btn-outline-info" onclick="viewRejectionReason({{ $withdrawal['id'] }}, '{{ isset($withdrawal['rejection_reason']) ? addslashes($withdrawal['rejection_reason']) : '' }}')" title="Lihat Alasan">
                    <i class="fas fa-info-circle"></i>
                  </button>
                @endif


              </div>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="8" class="text-center py-4">
              <div class="text-muted">
                <i class="fas fa-money-check-alt fa-3x mb-3" style="color: #e3e6f0;"></i>
                <h5>Tidak ada penarikan dana ditemukan</h5>
                <p>Belum ada data penarikan dana saat ini.</p>
              </div>
            </td>
          </tr>
          @endforelse
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

<!-- Detail Modal -->
<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header bg-gradient-primary text-white">
        <h5 class="modal-title" id="detailModalLabel">Detail Penarikan Dana</h5>
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

<!-- Approve Modal -->
<div class="modal fade" id="approveModal" tabindex="-1" role="dialog" aria-labelledby="approveModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header bg-gradient-success text-white">
        <h5 class="modal-title" id="approveModalLabel"><i class="fas fa-check mr-2"></i>Setujui Penarikan Dana</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="approveForm" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="alert alert-success"><i class="fas fa-info-circle"></i> Pastikan transfer sudah berhasil sebelum menyetujui penarikan.</div>
          
          <!-- Informasi Rekening Tujuan -->
          <div class="card bg-light border-success mb-4">
            <div class="card-header bg-success text-white py-2">
              <h6 class="mb-0"><i class="fas fa-university mr-2"></i>Informasi Rekening Tujuan</h6>
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
                      <td class="font-weight-bold text-muted">Jumlah Transfer:</td>
                      <td id="transferAmount" class="font-weight-bold text-success">-</td>
                    </tr>
                  </table>
                </div>
              </div>
              <div class="mt-2 p-2 bg-warning bg-opacity-10 rounded">
                <small class="text-warning">
                  <i class="fas fa-exclamation-triangle mr-1"></i>
                  <strong>Penting:</strong> Pastikan transfer sudah berhasil sebelum menyetujui.
                </small>
              </div>
            </div>
          </div>
          
          <!-- Amount -->
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label class="font-weight-bold">Jumlah Penarikan</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Rp</span>
                  </div>
                  <input type="number" name="amount" class="form-control" id="withdrawalAmount" readonly>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="font-weight-bold">Fee Admin (3%)</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Rp</span>
                  </div>
                  <input type="number" name="admin_fee" class="form-control" id="adminFee" readonly>
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

          <!-- Catatan -->
          <div class="form-group">
            <label class="font-weight-bold">Catatan (Opsional)</label>
            <textarea name="notes" class="form-control" rows="3" placeholder="Tambahkan catatan untuk freelancer..."></textarea>
          </div>
        </div>
        <div class="modal-footer bg-light">
          <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-success"><i class="fas fa-check"></i> Setujui & Konfirmasi Transfer</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Reject Modal -->
<div class="modal fade" id="rejectModal" tabindex="-1" role="dialog" aria-labelledby="rejectModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-gradient-danger text-white">
        <h5 class="modal-title" id="rejectModalLabel"><i class="fas fa-times mr-2"></i>Tolak Penarikan Dana</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="rejectForm">
        <div class="modal-body">
          <div class="alert alert-danger"><i class="fas fa-exclamation-triangle"></i> Berikan alasan penolakan yang jelas.</div>
          <div class="form-group">
            <label class="font-weight-bold">Alasan Penolakan <span class="text-danger">*</span></label>
            <textarea name="rejection_reason" class="form-control" rows="4" placeholder="Masukkan alasan mengapa penarikan tidak disetujui..." required></textarea>
          </div>
          <div class="form-group">
            <label class="font-weight-bold">Saran Solusi</label>
            <textarea name="suggested_solution" class="form-control" rows="3" placeholder="Berikan saran untuk menyelesaikan masalah..."></textarea>
          </div>
        </div>
        <div class="modal-footer bg-light">
          <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-danger"><i class="fas fa-times"></i> Tolak Penarikan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Rejection Reason Modal -->
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
</style>
@endpush

@push('scripts')
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
// Data mock untuk testing
// Data mock untuk testing - lanjutan
const mockWithdrawalsData = {
  1: {
    id: 1,
    freelancer_name: 'Ahmad Rizki',
    freelancer_email: 'ahmad.rizki@email.com',
    amount: 1500000,
    admin_fee: 45000,
    bank_name: 'Bank BCA',
    account_number: '1234567890',
    account_name: 'Ahmad Rizki',
    status: 'pending',
    created_at: '2024-09-20 14:30:00'
  },
  2: {
    id: 2,
    freelancer_name: 'Sari Wijaya',
    freelancer_email: 'sari.wijaya@email.com',
    amount: 2500000,
    admin_fee: 75000,
    bank_name: 'Bank Mandiri',
    account_number: '9876543210',
    account_name: 'Sari Wijaya',
    status: 'pending',
    created_at: '2024-09-19 10:15:00'
  },
  3: {
    id: 3,
    freelancer_name: 'Budi Santoso',
    freelancer_email: 'budi.santoso@email.com',
    amount: 1000000,
    admin_fee: 30000,
    bank_name: 'Bank BNI',
    account_number: '1122334455',
    account_name: 'Budi Santoso',
    status: 'approved',
    created_at: '2024-09-18 16:45:00',
    approved_at: '2024-09-19 09:30:00',
    approved_by: 'Admin Supervisor'
  },
  4: {
    id: 4,
    freelancer_name: 'Diana Putri',
    freelancer_email: 'diana.putri@email.com',
    amount: 2000000,
    admin_fee: 60000,
    bank_name: 'Bank BRI',
    account_number: '5566778899',
    account_name: 'Diana Putri',
    status: 'rejected',
    created_at: '2024-09-17 09:20:00',
    rejected_at: '2024-09-18 14:15:00',
    rejected_by: 'Admin Manager',
    rejection_reason: 'Informasi rekening tidak valid'
  }
};

// Variable untuk menyimpan ID saat ini
let currentWithdrawalId = null;

// Fungsi untuk melihat detail penarikan
window.viewDetail = function(id) {
  console.log('viewDetail called with ID:', id);
  
  const data = mockWithdrawalsData[id];
  if (!data) {
    console.error('Data not found for ID:', id);
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

  const content = `
    <div class="row">
      <div class="col-md-6">
        <h6 class="font-weight-bold text-primary">Informasi Freelancer</h6>
        <table class="table table-sm table-borderless">
          <tr><td class="font-weight-bold">Nama:</td><td>${data.freelancer_name}</td></tr>
          <tr><td class="font-weight-bold">Email:</td><td>${data.freelancer_email}</td></tr>
        </table>
      </div>
      <div class="col-md-6">
        <h6 class="font-weight-bold text-primary">Detail Penarikan</h6>
        <table class="table table-sm table-borderless">
          <tr><td class="font-weight-bold">ID:</td><td>#${data.id}</td></tr>
          <tr><td class="font-weight-bold">Jumlah:</td><td><span class="text-success font-weight-bold">Rp ${data.amount.toLocaleString('id-ID')}</span></td></tr>
          <tr><td class="font-weight-bold">Fee Admin:</td><td><span class="text-warning font-weight-bold">Rp ${data.admin_fee.toLocaleString('id-ID')}</span></td></tr>
          <tr><td class="font-weight-bold">Status:</td><td>${statusBadge}</td></tr>
          <tr><td class="font-weight-bold">Tanggal:</td><td>${new Date(data.created_at).toLocaleDateString('id-ID', {day: 'numeric', month: 'long', year: 'numeric', hour: '2-digit', minute: '2-digit'})}</td></tr>
        </table>
      </div>
    </div>
    
    <hr>
    
    <h6 class="font-weight-bold text-primary">Informasi Bank</h6>
    <div class="card bg-light">
      <div class="card-body">
        <div class="row">
          <div class="col-md-4">
            <strong>Bank:</strong><br>
            ${data.bank_name}
          </div>
          <div class="col-md-4">
            <strong>Nomor Rekening:</strong><br>
            <span class="text-primary font-weight-bold">${data.account_number}</span>
          </div>
          <div class="col-md-4">
            <strong>Nama Pemilik:</strong><br>
            ${data.account_name}
          </div>
        </div>
      </div>
    </div>
    
    ${data.rejection_reason ? `
    <hr>
    <h6 class="font-weight-bold text-primary">Alasan Penolakan</h6>
    <div class="alert alert-danger">
      <p class="mb-0">${data.rejection_reason}</p>
    </div>
    ` : ''}
  `;

  console.log('Setting modal content and showing modal...');
  document.getElementById('detailContent').innerHTML = content;
  
  try {
    $('#detailModal').modal('show');
    console.log('Modal shown using jQuery');
  } catch (error) {
    console.error('Error showing modal with jQuery:', error);
  }
};

// Fungsi untuk approve penarikan
window.approveWithdrawal = function(id) {
  console.log('approveWithdrawal called with ID:', id);
  
  const data = mockWithdrawalsData[id];
  if (!data) {
    Swal.fire('Error', 'Data tidak ditemukan!', 'error');
    return;
  }

  currentWithdrawalId = id;
  
  // Reset form
  document.getElementById('approveForm').reset();
  
  // Set informasi rekening
  document.getElementById('accountHolderName').textContent = data.account_name || data.freelancer_name;
  document.getElementById('bankName').textContent = data.bank_name;
  document.getElementById('accountNumber').textContent = data.account_number || 'Tidak tersedia';
  document.getElementById('transferAmount').textContent = 'Rp ' + data.amount.toLocaleString('id-ID');
  
  // Set nilai
  document.getElementById('withdrawalAmount').value = data.amount;
  document.getElementById('adminFee').value = data.admin_fee;
  
  // Reset preview image
  document.getElementById('imagePreview').style.display = 'none';
  document.querySelector('.custom-file-label').textContent = 'Pilih file gambar bukti transfer...';
  
  try {
    $('#approveModal').modal('show');
    console.log('Approve modal shown');
  } catch (error) {
    console.error('Error showing approve modal:', error);
  }
};

// Fungsi untuk reject penarikan
window.rejectWithdrawal = function(id) {
  console.log('rejectWithdrawal called with ID:', id);
  
  currentWithdrawalId = id;
  document.getElementById('rejectForm').reset();
  
  try {
    $('#rejectModal').modal('show');
    console.log('Reject modal shown');
  } catch (error) {
    console.error('Error showing reject modal:', error);
  }
};

// Fungsi untuk melihat alasan penolakan
window.viewRejectionReason = function(id, reason) {
  console.log('viewRejectionReason called with ID:', id);
  
  const content = `
    <div class="alert alert-danger">
      <h6 class="alert-heading"><i class="fas fa-exclamation-triangle"></i> Penarikan Ditolak</h6>
      <hr>
      <p><strong>Alasan Penolakan:</strong></p>
      <p class="mb-0">${reason || 'Alasan tidak tersedia'}</p>
    </div>
  `;
  
  document.getElementById('rejectionReasonContent').innerHTML = content;
  
  try {
    $('#rejectionReasonModal').modal('show');
    console.log('Rejection reason modal shown');
  } catch (error) {
    console.error('Error showing rejection reason modal:', error);
  }
};

// Fungsi untuk menghapus preview image
window.removeImage = function() {
  document.getElementById('transferProof').value = '';
  document.getElementById('imagePreview').style.display = 'none';
  document.querySelector('.custom-file-label').textContent = 'Pilih file gambar bukti transfer...';
};

// Event handlers
$(document).ready(function() {
  console.log('Document ready');
  
  // File input change handler
  $('#transferProof').on('change', function(e) {
    const file = e.target.files[0];
    if (file) {
      // Update label
      document.querySelector('.custom-file-label').textContent = file.name;
      
      // Show preview
      const reader = new FileReader();
      reader.onload = function(e) {
        document.getElementById('previewImg').src = e.target.result;
        document.getElementById('imagePreview').style.display = 'block';
      };
      reader.readAsDataURL(file);
    }
  });

  // Event handler untuk form approve
  $('#approveForm').on('submit', function(e) {
    e.preventDefault();
    
    if (!currentWithdrawalId) {
      Swal.fire('Error', 'ID penarikan tidak valid!', 'error');
      return;
    }

    const formData = new FormData(this);
    const transferProof = formData.get('transfer_proof');
    
    if (!transferProof || transferProof.size === 0) {
      Swal.fire('Error', 'Bukti transfer harus diupload!', 'error');
      return;
    }
    
    Swal.fire({
      title: 'Konfirmasi Persetujuan',
      text: 'Apakah Anda yakin ingin menyetujui penarikan ini?',
      icon: 'question',
      showCancelButton: true,
      confirmButtonColor: '#28a745',
      cancelButtonColor: '#6c757d',
      confirmButtonText: 'Ya, Setujui',
      cancelButtonText: 'Batal'
    }).then((result) => {
      if (result.isConfirmed) {
        // Simulate API call
        setTimeout(() => {
          Swal.fire({
            title: 'Berhasil!',
            text: 'Penarikan telah disetujui dan freelancer akan mendapat notifikasi.',
            icon: 'success'
          });
          $('#approveModal').modal('hide');
          // Refresh page or update UI
          location.reload();
        }, 1000);
      }
    });
  });

  // Event handler untuk form reject
  $('#rejectForm').on('submit', function(e) {
    e.preventDefault();
    
    if (!currentWithdrawalId) {
      Swal.fire('Error', 'ID penarikan tidak valid!', 'error');
      return;
    }

    const reason = $(this).find('[name="rejection_reason"]').val();
    if (!reason.trim()) {
      Swal.fire('Error', 'Alasan penolakan harus diisi!', 'error');
      return;
    }

    Swal.fire({
      title: 'Konfirmasi Penolakan',
      text: 'Apakah Anda yakin ingin menolak penarikan ini?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#dc3545',
      cancelButtonColor: '#6c757d',
      confirmButtonText: 'Ya, Tolak',
      cancelButtonText: 'Batal'
    }).then((result) => {
      if (result.isConfirmed) {
        // Simulate API call
        setTimeout(() => {
          Swal.fire({
            title: 'Berhasil!',
            text: 'Penarikan telah ditolak dan notifikasi akan dikirim ke freelancer.',
            icon: 'success'
          });
          $('#rejectModal').modal('hide');
          // Refresh page or update UI
          location.reload();
        }, 1000);
      }
    });
  });

  // Checkbox functionality untuk bulk actions
  $('#selectAll').on('change', function() {
    $('.withdrawal-checkbox').prop('checked', this.checked);
    toggleBulkButtons();
  });

  $('.withdrawal-checkbox').on('change', function() {
    toggleBulkButtons();
  });

  function toggleBulkButtons() {
    const checkedCount = $('.withdrawal-checkbox:checked').length;
    if (checkedCount > 0) {
      $('#bulkApprove, #bulkReject').show();
    } else {
      $('#bulkApprove, #bulkReject').hide();
    }
  }

  // Bulk actions
  $('#bulkApprove').on('click', function() {
    const checkedIds = $('.withdrawal-checkbox:checked').map(function() {
      return $(this).val();
    }).get();
    
    if (checkedIds.length === 0) {
      Swal.fire('Warning', 'Pilih minimal satu penarikan!', 'warning');
      return;
    }

    Swal.fire({
      title: 'Konfirmasi Bulk Approve',
      text: `Apakah Anda yakin ingin menyetujui ${checkedIds.length} penarikan sekaligus?`,
      icon: 'question',
      showCancelButton: true,
      confirmButtonColor: '#28a745',
      cancelButtonColor: '#6c757d',
      confirmButtonText: 'Ya, Setujui Semua',
      cancelButtonText: 'Batal'
    }).then((result) => {
      if (result.isConfirmed) {
        // Simulate API call
        setTimeout(() => {
          Swal.fire({
            title: 'Berhasil!',
            text: `${checkedIds.length} penarikan telah disetujui.`,
            icon: 'success'
          });
          location.reload();
        }, 1000);
      }
    });
  });

  $('#bulkReject').on('click', function() {
    const checkedIds = $('.withdrawal-checkbox:checked').map(function() {
      return $(this).val();
    }).get();
    
    if (checkedIds.length === 0) {
      Swal.fire('Warning', 'Pilih minimal satu penarikan!', 'warning');
      return;
    }

    Swal.fire({
      title: 'Konfirmasi Bulk Reject',
      text: `Apakah Anda yakin ingin menolak ${checkedIds.length} penarikan sekaligus?`,
      icon: 'warning',
      input: 'textarea',
      inputLabel: 'Alasan Penolakan',
      inputPlaceholder: 'Masukkan alasan penolakan...',
      inputValidator: (value) => {
        if (!value) {
          return 'Alasan penolakan harus diisi!'
        }
      },
      showCancelButton: true,
      confirmButtonColor: '#dc3545',
      cancelButtonColor: '#6c757d',
      confirmButtonText: 'Ya, Tolak Semua',
      cancelButtonText: 'Batal'
    }).then((result) => {
      if (result.isConfirmed) {
        // Simulate API call
        setTimeout(() => {
          Swal.fire({
            title: 'Berhasil!',
            text: `${checkedIds.length} penarikan telah ditolak.`,
            icon: 'success'
          });
          location.reload();
        }, 1000);
      }
    });
  });
});
</script>
@endpush