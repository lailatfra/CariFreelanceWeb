@extends('admin.layouts.main')

@section('title', 'Freelancer')

@section('content')
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Kelola Freelancer</h1>
  </div>

  <!-- Success Alert -->
  @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show shadow-sm mb-4" role="alert">
      <i class="fas fa-check-circle mr-2"></i>
      <strong>Berhasil!</strong> {{ session('success') }}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  @endif

  

  <!-- Status Distribution Chart -->
  <div class="row">
    <div class="col-xl-12 col-lg-12">
      <div class="card shadow mb-4">
        <div class="card-header py-3 bg-primary">
          <h6 class="m-0 font-weight-bold text-white">Distribusi Status Freelancer</h6>
        </div>
        <div class="card-body">
          <div class="chart-container" style="position: relative; height: 300px;">
            <canvas id="statusChart"></canvas>
          </div>
          <!-- Fallback -->
          <div id="status-fallback" style="display: none;">
            <div class="row text-center mt-3">
              <div class="col-4">
                <div class="border rounded p-3 mb-2" style="border: 2px solid #858796 !important;">
                  <i class="fas fa-clock fa-2x mb-2 text-gray-400"></i><br>
                  <small class="text-muted font-weight-bold">MENUNGGU</small><br>
                  <strong class="h4 text-secondary">{{ $freelancers->where('status', 'pending')->count() ?? 0 }}</strong>
                </div>
              </div>
              <div class="col-4">
                <div class="border rounded p-3 mb-2" style="border: 2px solid #36b9cc !important;">
                  <i class="fas fa-check-circle fa-2x mb-2 text-gray-400"></i><br>
                  <small class="text-muted font-weight-bold">DISETUJUI</small><br>
                  <strong class="h4 text-info">{{ $freelancers->where('status', 'approved')->count() ?? 0 }}</strong>
                </div>
              </div>
              <div class="col-4">
                <div class="border rounded p-3 mb-2" style="border: 2px solid #5a5c69 !important;">
                  <i class="fas fa-times-circle fa-2x mb-2 text-gray-400"></i><br>
                  <small class="text-muted font-weight-bold">DITOLAK</small><br>
                  <strong class="h4 text-dark">{{ $freelancers->where('status', 'rejected')->count() ?? 0 }}</strong>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Freelancers Table -->
  <div class="card shadow mb-4">
    <div class="card-header py-3 bg-gradient-primary">
      <div class="row align-items-center">
        <div class="col">
          <h6 class="m-0 font-weight-bold text-white">
            <i class="fas fa-users mr-2"></i>Daftar Freelancer
          </h6>
        </div>
        <div class="col-auto">
          <div class="dropdown">
            <!-- <button class="btn btn-light btn-sm dropdown-toggle shadow-sm" type="button" data-toggle="dropdown">
              <i class="fas fa-filter"></i> Filter Status
            </button> -->
            <div class="dropdown-menu">
              <a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['status' => 'all']) }}">
                <i class="fas fa-list mr-2"></i>Semua Status
              </a>
              <a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['status' => 'pending']) }}">
                <i class="fas fa-clock mr-2 text-secondary"></i>Menunggu
              </a>
              <a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['status' => 'approved']) }}">
                <i class="fas fa-check-circle mr-2 text-info"></i>Disetujui
              </a>
              <a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['status' => 'rejected']) }}">
                <i class="fas fa-times-circle mr-2 text-dark"></i>Ditolak
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
                <i class="fas fa-user mr-1"></i>Nama
              </th>
              <th class="font-weight-bold text-gray-700">
                <i class="fas fa-envelope mr-1"></i>Email
              </th>
              <th class="font-weight-bold text-gray-700">
                <i class="fas fa-info-circle mr-1"></i>Status
              </th>
              <th class="font-weight-bold text-gray-700">
                <i class="fas fa-calendar mr-1"></i>Tanggal Bergabung
              </th>
              <th class="font-weight-bold text-center text-gray-700">
                <i class="fas fa-cogs mr-1"></i>Aksi
              </th>
            </tr>
          </thead>
          <tbody>
            @forelse($freelancers as $index => $freelancer)
            <tr class="hover-row">
              <td class="font-weight-bold">
                @if(method_exists($freelancers, 'currentPage'))
                  {{ ($freelancers->currentPage() - 1) * $freelancers->perPage() + $index + 1 }}
                @else
                  {{ $index + 1 }}
                @endif
              </td>
              <td>
                <div class="d-flex align-items-center">
                  <div class="mr-3">
                    <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                      <i class="fas fa-user"></i>
                    </div>
                  </div>
                  <div>
                    <div class="font-weight-bold">{{ $freelancer->name }}</div>
                    <small class="text-muted">ID: {{ $freelancer->id }}</small>
                  </div>
                </div>
              </td>
              <td>
                <span class="text-primary">{{ $freelancer->email }}</span>
              </td>
              <td>
                @php
                  $statusClass = match($freelancer->status) {
                    'pending' => 'secondary',
                    'approved' => 'info',
                    'rejected' => 'dark',
                    default => 'light'
                  };
                  $statusIcon = match($freelancer->status) {
                    'pending' => 'clock',
                    'approved' => 'check-circle',
                    'rejected' => 'times-circle',
                    default => 'question-circle'
                  };
                @endphp
                <span class="badge badge-{{ $statusClass }} px-3 py-2" style="font-size: 0.8rem;">
                  <i class="fas fa-{{ $statusIcon }} mr-1"></i>
                  {{ strtoupper($freelancer->status) }}
                </span>
              </td>
              <td>
                <small class="text-muted">
                  <i class="fas fa-calendar mr-1"></i>
                  {{ $freelancer->created_at ? $freelancer->created_at->format('M d, Y') : 'N/A' }}
                </small>
              </td>
              <td class="text-center">
                <form action="{{ route('admin.freelancers.status', $freelancer->id) }}" method="POST" class="d-inline-block">
                  @csrf
                  <div class="input-group input-group-sm" style="width: 200px; margin: 0 auto;">
                    <select name="status" class="form-control form-control-sm" style="border-radius: 0.25rem 0 0 0.25rem;">
                      <option value="pending" {{ $freelancer->status == 'pending' ? 'selected' : '' }}>
                        🕐 Menunggu
                      </option>
                      <option value="approved" {{ $freelancer->status == 'approved' ? 'selected' : '' }}>
                        ✅ Disetujui
                      </option>
                      <option value="rejected" {{ $freelancer->status == 'rejected' ? 'selected' : '' }}>
                        ❌ Ditolak
                      </option>
                    </select>
                    <div class="input-group-append">
                      <button type="submit" class="btn btn-primary btn-sm shadow-sm" style="border-radius: 0 0.25rem 0.25rem 0;">
                        <i class="fas fa-save"></i> Perbarui
                      </button>
                    </div>
                  </div>
                </form>
                <div class="mt-2">
                  <button class="btn btn-outline-primary btn-sm mr-1" title="Lihat Detail">
                    <i class="fas fa-eye"></i>
                  </button>
                </div>
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="6" class="text-center py-4">
                <div class="text-muted">
                  <i class="fas fa-users fa-3x mb-3" style="color: #e3e6f0;"></i>
                  <h5>Tidak ada freelancer ditemukan</h5>
                  <p>Belum ada data freelancer saat ini.</p>
                </div>
              </td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>
      
      <!-- Pagination -->
      @if(method_exists($freelancers, 'links'))
        <div class="d-flex justify-content-center mt-4">
          {{ $freelancers->appends(request()->query())->links() }}
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

.card {
    transition: all 0.2s ease;
    border: 1px solid #e3e6f0;
}

.card:hover {
    box-shadow: 0 0.25rem 0.5rem rgba(0, 0, 0, 0.1) !important;
}

.btn {
    transition: all 0.2s ease;
}

.btn:hover {
    transform: translateY(-1px);
}

.badge {
    font-weight: 600;
    letter-spacing: 0.5px;
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

.alert {
    border: none;
    border-radius: 8px;
}

.input-group-sm > .form-control,
.input-group-sm > .input-group-prepend > .btn,
.input-group-sm > .input-group-append > .btn {
    font-size: 0.8rem;
}

.chart-container {
    position: relative;
}

.bg-gradient-primary {
    background: linear-gradient(90deg, #a2b3e5ff 0%, #0c1636ff 100%);
}

.card-header {
    border-bottom: 1px solid #e3e6f0;
}

.text-gray-400 {
    color: #858796 !important;
}

.text-gray-700 {
    color: #5a5c69 !important;
}

.text-gray-800 {
    color: #3d3d3d !important;
}

@media (max-width: 768px) {
  .table-responsive {
    border: none;
  }
  
  .card-header .row {
    flex-direction: column;
    gap: 10px;
  }
  
  .input-group {
    width: 100% !important;
  }
}
</style>
@endpush

@push('scripts')
<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.min.js"></script>

<script>
let statusChart = null;

function showFallback() {
    const fallback = document.getElementById('status-fallback');
    const canvas = document.getElementById('statusChart');
    if (fallback && canvas) {
        fallback.style.display = 'block';
        canvas.parentElement.style.display = 'none';
    }
}

function createStatusChart() {
    const element = document.getElementById('statusChart');
    if (!element) {
        showFallback();
        return false;
    }

    try {
        const ctx = element.getContext('2d');
        
        if (statusChart) {
            statusChart.destroy();
        }

        const pendingCount = {{ $freelancers->where('status', 'pending')->count() ?? 0 }};
        const approvedCount = {{ $freelancers->where('status', 'approved')->count() ?? 0 }};
        const rejectedCount = {{ $freelancers->where('status', 'rejected')->count() ?? 0 }};
        
        statusChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Menunggu', 'Disetujui', 'Ditolak'],
                datasets: [{
                    data: [pendingCount, approvedCount, rejectedCount],
                    backgroundColor: ['#858796', '#36b9cc', '#5a5c69'],
                    borderWidth: 3,
                    borderColor: '#ffffff',
                    hoverBackgroundColor: ['#717384', '#2c9faf', '#484954'],
                    hoverBorderColor: '#ffffff',
                    hoverBorderWidth: 3
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
                            font: {
                                size: 12,
                                weight: '500'
                            },
                            usePointStyle: true,
                            pointStyle: 'circle',
                            color: '#5a5c69'
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(90, 92, 105, 0.9)',
                        titleColor: 'white',
                        bodyColor: 'white',
                        borderColor: '#5a5c69',
                        borderWidth: 1,
                        cornerRadius: 8,
                        callbacks: {
                            label: function(context) {
                                const label = context.label || '';
                                const value = context.parsed || 0;
                                const total = pendingCount + approvedCount + rejectedCount;
                                const percentage = total > 0 ? ((value / total) * 100).toFixed(1) : 0;
                                return `${label}: ${value} (${percentage}%)`;
                            }
                        }
                    }
                },
                cutout: '60%',
                animation: {
                    animateRotate: true,
                    duration: 800
                }
            }
        });
        
        return true;
    } catch (error) {
        console.error('Error creating status chart:', error);
        showFallback();
        return false;
    }
}

document.addEventListener('DOMContentLoaded', function() {
    setTimeout(function() {
        if (typeof Chart === 'undefined') {
            showFallback();
            return;
        }
        createStatusChart();
    }, 100);
});

window.addEventListener('resize', function() {
    if (statusChart) {
        statusChart.resize();
    }
});
</script>
@endpush