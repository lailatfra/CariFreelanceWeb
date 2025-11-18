@extends('admin.layouts.main')

@section('title', 'Kelola Penarikan Saldo')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">
    <i class="fas fa-wallet mr-2"></i>Kelola Penarikan Saldo
  </h1>
</div>

<!-- Success/Error Alert -->
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show shadow-sm mb-4" role="alert">
  <i class="fas fa-check-circle mr-2"></i>
  <strong>Berhasil!</strong> {{ session('success') }}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif

@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show shadow-sm mb-4" role="alert">
  <i class="fas fa-exclamation-triangle mr-2"></i>
  <strong>Error!</strong> {{ session('error') }}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif

<!-- Statistics Cards -->
<div class="row mb-4">
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-warning shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
              Menunggu Verifikasi
            </div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">
              {{ $withdrawals->where('status', 'pending')->count() }}
            </div>
          </div>
          <div class="col-auto">
            <i class="fas fa-clock fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-info shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
              Disetujui
            </div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">
              {{ $withdrawals->where('status', 'approved')->count() }}
            </div>
          </div>
          <div class="col-auto">
            <i class="fas fa-check fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-success shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
              Selesai
            </div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">
              {{ $withdrawals->where('status', 'completed')->count() }}
            </div>
          </div>
          <div class="col-auto">
            <i class="fas fa-check-double fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-danger shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
              Ditolak
            </div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">
              {{ $withdrawals->where('status', 'rejected')->count() }}
            </div>
          </div>
          <div class="col-auto">
            <i class="fas fa-times fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Status Distribution Chart -->
<div class="row mb-4">
  <div class="col-xl-12">
    <div class="card shadow">
      <div class="card-header py-3 bg-gradient-primary">
        <h6 class="m-0 font-weight-bold text-white">
          <i class="fas fa-chart-pie mr-2"></i>Distribusi Status Penarikan
        </h6>
      </div>
      <div class="card-body">
        <div class="chart-container" style="position: relative; height: 300px;">
          <canvas id="statusChart"></canvas>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Withdrawals Table -->
<div class="card shadow mb-4">
  <div class="card-header py-3 bg-gradient-primary">
    <div class="row align-items-center">
      <div class="col">
        <h6 class="m-0 font-weight-bold text-white">
          <i class="fas fa-list mr-2"></i>Daftar Penarikan Saldo
        </h6>
      </div>
      <div class="col-auto">
        <div class="dropdown">
          <button class="btn btn-light btn-sm dropdown-toggle shadow-sm" type="button" data-toggle="dropdown">
            <i class="fas fa-filter"></i> Filter Status
          </button>
          <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item" href="{{ route('admin.withdrawals.index') }}">
              <i class="fas fa-list mr-2"></i>Semua Status
            </a>
            <a class="dropdown-item" href="{{ route('admin.withdrawals.index', ['status' => 'pending']) }}">
              <i class="fas fa-clock mr-2 text-warning"></i>Menunggu
            </a>
            <a class="dropdown-item" href="{{ route('admin.withdrawals.index', ['status' => 'approved']) }}">
              <i class="fas fa-check mr-2 text-info"></i>Disetujui
            </a>
            <a class="dropdown-item" href="{{ route('admin.withdrawals.index', ['status' => 'completed']) }}">
              <i class="fas fa-check-double mr-2 text-success"></i>Selesai
            </a>
            <a class="dropdown-item" href="{{ route('admin.withdrawals.index', ['status' => 'rejected']) }}">
              <i class="fas fa-times mr-2 text-danger"></i>Ditolak
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
              <i class="fas fa-id-card mr-1"></i>ID Penarikan
            </th>
            <th class="font-weight-bold text-gray-700">
              <i class="fas fa-user mr-1"></i>Freelancer
            </th>
            <th class="font-weight-bold text-gray-700">
              <i class="fas fa-money-bill mr-1"></i>Jumlah
            </th>
            <th class="font-weight-bold text-gray-700">
              <i class="fas fa-university mr-1"></i>Bank
            </th>
            <th class="font-weight-bold text-gray-700">
              <i class="fas fa-info-circle mr-1"></i>Status
            </th>
            <th class="font-weight-bold text-gray-700">
              <i class="fas fa-calendar mr-1"></i>Tanggal
            </th>
            <th class="font-weight-bold text-center text-gray-700">
              <i class="fas fa-cogs mr-1"></i>Aksi
            </th>
          </tr>
        </thead>
        <tbody>
          @forelse($withdrawals as $index => $withdrawal)
          <tr class="hover-row">
            <td class="font-weight-bold">
              {{ ($withdrawals->currentPage() - 1) * $withdrawals->perPage() + $index + 1 }}
            </td>
            <td>
              <span class="badge badge-secondary px-2 py-1" style="font-size: 0.75rem;">
                {{ $withdrawal->withdrawal_id }}
              </span>
            </td>
            <td>
              <div class="d-flex align-items-center">
                <div class="mr-3">
                  <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center" style="width: 35px; height: 35px;">
                    <i class="fas fa-user"></i>
                  </div>
                </div>
                <div>
                  <div class="font-weight-bold">{{ $withdrawal->user->name }}</div>
                  <small class="text-muted">{{ $withdrawal->user->email }}</small>
                </div>
              </div>
            </td>
            <td>
              <span class="font-weight-bold text-success" style="font-size: 1rem;">
                {{ $withdrawal->formatted_amount }}
              </span>
            </td>
            <td>
              <div class="font-weight-bold">{{ $withdrawal->bank_name }}</div>
              <small class="text-muted">{{ $withdrawal->account_number }}</small><br>
              <small class="text-muted">a/n {{ $withdrawal->account_holder_name }}</small>
            </td>
            <td>{!! $withdrawal->status_badge !!}</td>
            <td>
              <small class="text-muted">
                <i class="fas fa-calendar mr-1"></i>
                {{ $withdrawal->created_at->format('d M Y') }}<br>
                <i class="fas fa-clock mr-1"></i>
                {{ $withdrawal->created_at->format('H:i') }}
              </small>
            </td>
            <td class="text-center">
              <a href="{{ route('admin.withdrawals.show', $withdrawal) }}" 
                 class="btn btn-info btn-sm shadow-sm mb-1" 
                 title="Lihat Detail">
                <i class="fas fa-eye"></i> Detail
              </a>
              
              @if($withdrawal->status === 'pending')
              <button type="button" 
                      class="btn btn-success btn-sm shadow-sm mb-1" 
                      data-toggle="modal" 
                      data-target="#approveModal{{ $withdrawal->id }}"
                      title="Setujui">
                <i class="fas fa-check"></i> Setujui
              </button>
              
              <button type="button" 
                      class="btn btn-danger btn-sm shadow-sm mb-1" 
                      data-toggle="modal" 
                      data-target="#rejectModal{{ $withdrawal->id }}"
                      title="Tolak">
                <i class="fas fa-times"></i> Tolak
              </button>
              @endif

              @if($withdrawal->status === 'approved' || $withdrawal->status === 'pending')
              <button type="button" 
                      class="btn btn-primary btn-sm shadow-sm mb-1" 
                      data-toggle="modal" 
                      data-target="#completeModal{{ $withdrawal->id }}"
                      title="Selesaikan">
                <i class="fas fa-check-double"></i> Selesaikan
              </button>
              @endif
            </td>
          </tr>

          <!-- Approve Modal -->
          <div class="modal fade" id="approveModal{{ $withdrawal->id }}" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header bg-success text-white">
                  <h5 class="modal-title">
                    <i class="fas fa-check-circle mr-2"></i>Setujui Penarikan
                  </h5>
                  <button type="button" class="close text-white" data-dismiss="modal">
                    <span>&times;</span>
                  </button>
                </div>
                <form action="{{ route('admin.withdrawals.approve', $withdrawal) }}" method="POST">
                  @csrf
                  <div class="modal-body">
                    <p>Apakah Anda yakin ingin menyetujui penarikan ini?</p>
                    <div class="alert alert-info">
                      <strong>ID:</strong> {{ $withdrawal->withdrawal_id }}<br>
                      <strong>Freelancer:</strong> {{ $withdrawal->user->name }}<br>
                      <strong>Jumlah:</strong> {{ $withdrawal->formatted_amount }}<br>
                      <strong>Bank:</strong> {{ $withdrawal->bank_name }} - {{ $withdrawal->account_number }}
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                      <i class="fas fa-times mr-2"></i>Batal
                    </button>
                    <button type="submit" class="btn btn-success">
                      <i class="fas fa-check mr-2"></i>Ya, Setujui
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>

          <!-- Reject Modal -->
          <div class="modal fade" id="rejectModal{{ $withdrawal->id }}" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                  <h5 class="modal-title">
                    <i class="fas fa-times-circle mr-2"></i>Tolak Penarikan
                  </h5>
                  <button type="button" class="close text-white" data-dismiss="modal">
                    <span>&times;</span>
                  </button>
                </div>
                <form action="{{ route('admin.withdrawals.reject', $withdrawal) }}" method="POST">
                  @csrf
                  <div class="modal-body">
                    <p>Apakah Anda yakin ingin menolak penarikan ini?</p>
                    <div class="alert alert-warning">
                      <strong>ID:</strong> {{ $withdrawal->withdrawal_id }}<br>
                      <strong>Freelancer:</strong> {{ $withdrawal->user->name }}<br>
                      <strong>Jumlah:</strong> {{ $withdrawal->formatted_amount }}
                    </div>
                    <div class="form-group">
                      <label for="admin_notes{{ $withdrawal->id }}" class="font-weight-bold">
                        Alasan Penolakan <span class="text-danger">*</span>
                      </label>
                      <textarea name="admin_notes" 
                                id="admin_notes{{ $withdrawal->id }}" 
                                class="form-control" 
                                rows="3" 
                                placeholder="Masukkan alasan penolakan..."
                                required></textarea>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                      <i class="fas fa-times mr-2"></i>Batal
                    </button>
                    <button type="submit" class="btn btn-danger">
                      <i class="fas fa-ban mr-2"></i>Ya, Tolak
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>

          <!-- Complete Modal -->
          <div class="modal fade" id="completeModal{{ $withdrawal->id }}" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                  <h5 class="modal-title">
                    <i class="fas fa-check-double mr-2"></i>Selesaikan Penarikan
                  </h5>
                  <button type="button" class="close text-white" data-dismiss="modal">
                    <span>&times;</span>
                  </button>
                </div>
                <form action="{{ route('admin.withdrawals.complete', $withdrawal) }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="modal-body">
                    <div class="alert alert-info">
                      <h6 class="font-weight-bold">Informasi Transfer:</h6>
                      <strong>ID:</strong> {{ $withdrawal->withdrawal_id }}<br>
                      <strong>Freelancer:</strong> {{ $withdrawal->user->name }}<br>
                      <strong>Jumlah:</strong> {{ $withdrawal->formatted_amount }}<br>
                      <strong>Bank:</strong> {{ $withdrawal->bank_name }}<br>
                      <strong>No. Rekening:</strong> {{ $withdrawal->account_number }}<br>
                      <strong>Atas Nama:</strong> {{ $withdrawal->account_holder_name }}
                    </div>

                    <div class="form-group">
                      <label for="proof_image{{ $withdrawal->id }}" class="font-weight-bold">
                        Bukti Transfer <span class="text-danger">*</span>
                      </label>
                      <div class="custom-file">
                        <input type="file" 
                               name="proof_image" 
                               class="custom-file-input" 
                               id="proof_image{{ $withdrawal->id }}"
                               accept="image/*"
                               required
                               onchange="previewImage(this, 'preview{{ $withdrawal->id }}')">
                        <label class="custom-file-label" for="proof_image{{ $withdrawal->id }}">
                          Pilih file bukti transfer...
                        </label>
                      </div>
                      <small class="form-text text-muted">
                        Format: JPG, JPEG, PNG (Max: 2MB)
                      </small>
                      <div id="preview{{ $withdrawal->id }}" class="mt-3 text-center" style="display: none;">
                        <img src="" alt="Preview" class="img-fluid rounded shadow" style="max-height: 300px;">
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="admin_notes_complete{{ $withdrawal->id }}" class="font-weight-bold">
                        Catatan (Opsional)
                      </label>
                      <textarea name="admin_notes" 
                                id="admin_notes_complete{{ $withdrawal->id }}" 
                                class="form-control" 
                                rows="2" 
                                placeholder="Catatan tambahan (opsional)..."></textarea>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                      <i class="fas fa-times mr-2"></i>Batal
                    </button>
                    <button type="submit" class="btn btn-primary">
                      <i class="fas fa-paper-plane mr-2"></i>Selesaikan Transfer
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>

          @empty
          <tr>
            <td colspan="8" class="text-center py-4">
              <div class="text-muted">
                <i class="fas fa-inbox fa-3x mb-3" style="color: #e3e6f0;"></i>
                <h5>Tidak ada data penarikan</h5>
                <p>Belum ada permintaan penarikan saat ini.</p>
              </div>
            </td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <!-- Pagination -->
    @if($withdrawals->hasPages())
    <div class="d-flex justify-content-center mt-4">
      {{ $withdrawals->appends(request()->query())->links() }}
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

.btn {
  transition: all 0.2s ease;
}

.btn:hover {
  transform: translateY(-1px);
}

.modal-header {
  border-bottom: 1px solid #e3e6f0;
}

.modal-footer {
  border-top: 1px solid #e3e6f0;
}

.custom-file-label::after {
  content: "Browse";
}
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.min.js"></script>

<script>
// Preview image function
function previewImage(input, previewId) {
  const preview = document.getElementById(previewId);
  const img = preview.querySelector('img');
  const label = input.nextElementSibling;
  
  if (input.files && input.files[0]) {
    const reader = new FileReader();
    
    reader.onload = function(e) {
      img.src = e.target.result;
      preview.style.display = 'block';
    }
    
    reader.readAsDataURL(input.files[0]);
    label.textContent = input.files[0].name;
  }
}

// Chart
document.addEventListener('DOMContentLoaded', function() {
  const ctx = document.getElementById('statusChart');
  if (ctx) {
    new Chart(ctx, {
      type: 'doughnut',
      data: {
        labels: ['Menunggu', 'Disetujui', 'Selesai', 'Ditolak'],
        datasets: [{
          data: [
            {{ $withdrawals->where('status', 'pending')->count() }},
            {{ $withdrawals->where('status', 'approved')->count() }},
            {{ $withdrawals->where('status', 'completed')->count() }},
            {{ $withdrawals->where('status', 'rejected')->count() }}
          ],
          backgroundColor: ['#f6c23e', '#36b9cc', '#1cc88a', '#e74a3b'],
          borderWidth: 3,
          borderColor: '#ffffff'
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            position: 'bottom',
            labels: {
              padding: 20,
              font: { size: 12, weight: '500' },
              usePointStyle: true
            }
          }
        },
        cutout: '60%'
      }
    });
  }
});
</script>
@endpush