@extends('admin.layouts.main')

@section('title', 'Detail Penarikan')

@section('content')
<div class="container-fluid">
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">
      <i class="fas fa-file-invoice mr-2"></i>Detail Penarikan Saldo
    </h1>
    <a href="{{ route('admin.withdrawals.index') }}" class="btn btn-secondary shadow-sm">
      <i class="fas fa-arrow-left mr-2"></i>Kembali
    </a>
  </div>

  <div class="row">
    <!-- Main Information -->
    <div class="col-lg-8">
      <div class="card shadow mb-4">
        <div class="card-header py-3 bg-gradient-primary">
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
              <h2 class="font-weight-bold text-success mb-0">
                {{ $withdrawal->formatted_amount }}
              </h2>
            </div>
          </div>

          <hr>

          <h6 class="font-weight-bold text-gray-800 mb-3">
            <i class="fas fa-user mr-2"></i>Informasi Freelancer
          </h6>

          <div class="row mb-3">
            <div class="col-md-6">
              <small class="text-muted">Nama Lengkap</small>
              <p class="font-weight-bold mb-0">{{ $withdrawal->user->name }}</p>
            </div>
            <div class="col-md-6">
              <small class="text-muted">Email</small>
              <p class="font-weight-bold mb-0">{{ $withdrawal->user->email }}</p>
            </div>
          </div>

          <hr>

          <h6 class="font-weight-bold text-gray-800 mb-3">
            <i class="fas fa-university mr-2"></i>Informasi Rekening Bank
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

          @if($withdrawal->isCompleted() && $withdrawal->proof_image)
            <hr>
            <h6 class="font-weight-bold text-gray-800 mb-3">
              <i class="fas fa-receipt mr-2"></i>Bukti Transfer
            </h6>
            <div class="text-center">
              <a href="{{ asset('storage/' . $withdrawal->proof_image) }}" target="_blank">
                <img src="{{ asset('storage/' . $withdrawal->proof_image) }}" 
                     alt="Bukti Transfer" 
                     class="img-fluid rounded shadow"
                     style="max-width: 100%; max-height: 400px; cursor: pointer;">
              </a>
              <p class="text-muted mt-2">
                <small>
                  <i class="fas fa-info-circle mr-1"></i>
                  Klik gambar untuk melihat ukuran penuh
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

          @if($withdrawal->admin_notes)
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
      <!-- Quick Actions -->
      @if($withdrawal->status === 'pending' || $withdrawal->status === 'approved')
      <div class="card shadow mb-4">
        <div class="card-header py-3 bg-warning">
          <h6 class="m-0 font-weight-bold text-white">
            <i class="fas fa-tasks mr-2"></i>Aksi Cepat
          </h6>
        </div>
        <div class="card-body">
          @if($withdrawal->status === 'pending')
          <button type="button" 
                  class="btn btn-success btn-block mb-2" 
                  data-toggle="modal" 
                  data-target="#approveModal">
            <i class="fas fa-check mr-2"></i>Setujui Penarikan
          </button>
          
          <button type="button" 
                  class="btn btn-danger btn-block mb-2" 
                  data-toggle="modal" 
                  data-target="#rejectModal">
            <i class="fas fa-times mr-2"></i>Tolak Penarikan
          </button>
          @endif

          <button type="button" 
                  class="btn btn-primary btn-block" 
                  data-toggle="modal" 
                  data-target="#completeModal">
            <i class="fas fa-check-double mr-2"></i>Selesaikan Transfer
          </button>
        </div>
      </div>
      @endif

      <!-- Status Timeline -->
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-gray-800">
            <i class="fas fa-stream mr-2"></i>Status Timeline
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
                @if($withdrawal->isCompleted() && $withdrawal->processed_at)
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

      <!-- Wallet Info -->
      <div class="card shadow mb-4 border-left-info">
        <div class="card-body">
          <h6 class="font-weight-bold text-info mb-3">
            <i class="fas fa-wallet mr-2"></i>Informasi Wallet
          </h6>
          <div class="mb-3">
            <small class="text-muted d-block">Saldo Tersedia</small>
            <h5 class="font-weight-bold text-success mb-0">
              {{ $withdrawal->wallet->formatted_balance }}
            </h5>
          </div>
          <div>
            <small class="text-muted d-block">Saldo Dalam Proses</small>
            <h5 class="font-weight-bold text-warning mb-0">
              Rp {{ number_format($withdrawal->wallet->pending_balance, 0, ',', '.') }}
            </h5>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Approve Modal -->
<div class="modal fade" id="approveModal" tabindex="-1" role="dialog">
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
<div class="modal fade" id="rejectModal" tabindex="-1" role="dialog">
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
            <label for="admin_notes" class="font-weight-bold">
              Alasan Penolakan <span class="text-danger">*</span>
            </label>
            <textarea name="admin_notes" 
                      id="admin_notes" 
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
<div class="modal fade" id="completeModal" tabindex="-1" role="dialog">
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
            <label for="proof_image" class="font-weight-bold">
              Bukti Transfer <span class="text-danger">*</span>
            </label>
            <div class="custom-file">
              <input type="file" 
                     name="proof_image" 
                     class="custom-file-input" 
                     id="proof_image"
                     accept="image/*"
                     required
                     onchange="previewImage(this)">
              <label class="custom-file-label" for="proof_image">
                Pilih file bukti transfer...
              </label>
            </div>
            <small class="form-text text-muted">
              Format: JPG, JPEG, PNG (Max: 2MB)
            </small>
            <div id="imagePreview" class="mt-3 text-center" style="display: none;">
              <img src="" alt="Preview" class="img-fluid rounded shadow" style="max-height: 300px;">
            </div>
          </div>

          <div class="form-group">
            <label for="admin_notes_complete" class="font-weight-bold">
              Catatan (Opsional)
            </label>
            <textarea name="admin_notes" 
                      id="admin_notes_complete" 
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

@endsection

@push('styles')
<style>
.bg-gradient-primary {
  background: linear-gradient(90deg, #a2b3e5ff 0%, #0c1636ff 100%);
}

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

.btn {
  transition: all 0.2s ease;
}

.btn:hover {
  transform: translateY(-1px);
}

img {
  transition: transform 0.2s ease;
}

img:hover {
  transform: scale(1.02);
}
</style>
@endpush

@push('scripts')
<script>
function previewImage(input) {
  const preview = document.getElementById('imagePreview');
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
</script>
@endpush