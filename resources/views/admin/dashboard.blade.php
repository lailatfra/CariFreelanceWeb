@extends('admin.layouts.main')

@section('title', 'Dashboard')

@section('content')
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
  </div>

  <div class="row">
    <!-- Clients Card -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2" style="border-left: 4px solid #4e73df !important;">
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
              <i class="fas fa-user-tie fa-2x text-gray-400"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Freelancers Card -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-info shadow h-100 py-2" style="border-left: 4px solid #36b9cc !important;">
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
              <i class="fas fa-user-cog fa-2x text-gray-400"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Projects Card -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-secondary shadow h-100 py-2" style="border-left: 4px solid #858796 !important;">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">
                Total Proyek</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">
                {{ $projectCount ?? 0 }}
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-clipboard-list fa-2x text-gray-400"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Proposals Card -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-dark shadow h-100 py-2" style="border-left: 4px solid #5a5c69 !important;">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                Total Proposal</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">
                {{ $proposalCount ?? 0 }}
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-file-alt fa-2x text-gray-400"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Charts Row -->
  <div class="row">
    <!-- Project Statistics Chart -->
    <div class="col-xl-8 col-lg-8">
      <div class="card shadow mb-4">
        <div class="card-header py-3 bg-primary">
          <div class="d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-white">Statistik Proyek</h6>
            <div class="d-flex align-items-center">
              <label class="text-white mb-0 mr-2 small">Tahun:</label>
              <select class="form-control form-control-sm" id="projectYearSelector" style="width: auto;">
                <option value="2025" selected>2025</option>
                <option value="2024">2024</option>
                <option value="2023">2022</option>
              </select>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="chart-container" style="position: relative; height: 320px;">
            <canvas id="projectChart"></canvas>
          </div>
          <!-- Fallback jika chart tidak muncul -->
          <div id="project-fallback" style="display: none;">
            <h5 class="text-center mb-3 text-gray-600">Statistik Proyek Bulanan</h5>
            <div class="row text-center">
              <div class="col-2 mb-2">
                <div class="border rounded p-2" style="border-color: #e3e6f0;">
                  <small class="text-muted">Jan</small><br>
                  <strong class="text-primary">2</strong>
                </div>
              </div>
              <div class="col-2 mb-2">
                <div class="border rounded p-2" style="border-color: #e3e6f0;">
                  <small class="text-muted">Feb</small><br>
                  <strong class="text-primary">5</strong>
                </div>
              </div>
              <div class="col-2 mb-2">
                <div class="border rounded p-2" style="border-color: #e3e6f0;">
                  <small class="text-muted">Mar</small><br>
                  <strong class="text-primary">8</strong>
                </div>
              </div>
              <div class="col-2 mb-2">
                <div class="border rounded p-2" style="border-color: #e3e6f0;">
                  <small class="text-muted">Apr</small><br>
                  <strong class="text-primary">12</strong>
                </div>
              </div>
              <div class="col-2 mb-2">
                <div class="border rounded p-2" style="border-color: #e3e6f0;">
                  <small class="text-muted">May</small><br>
                  <strong class="text-primary">15</strong>
                </div>
              </div>
              <div class="col-2 mb-2">
                <div class="border rounded p-2" style="border-color: #e3e6f0;">
                  <small class="text-muted">Jun</small><br>
                  <strong class="text-primary">9</strong>
                </div>
              </div>
              <div class="col-2 mb-2">
                <div class="border rounded p-2" style="border-color: #e3e6f0;">
                  <small class="text-muted">Jul</small><br>
                  <strong class="text-primary">18</strong>
                </div>
              </div>
              <div class="col-2 mb-2">
                <div class="border rounded p-2" style="border-color: #e3e6f0;">
                  <small class="text-muted">Aug</small><br>
                  <strong class="text-primary">22</strong>
                </div>
              </div>
              <div class="col-2 mb-2">
                <div class="border rounded p-2" style="border-color: #e3e6f0;">
                  <small class="text-muted">Sep</small><br>
                  <strong class="text-primary">16</strong>
                </div>
              </div>
              <div class="col-2 mb-2">
                <div class="border rounded p-2" style="border-color: #e3e6f0;">
                  <small class="text-muted">Oct</small><br>
                  <strong class="text-primary">20</strong>
                </div>
              </div>
              <div class="col-2 mb-2">
                <div class="border rounded p-2" style="border-color: #e3e6f0;">
                  <small class="text-muted">Nov</small><br>
                  <strong class="text-primary">25</strong>
                </div>
              </div>
              <div class="col-2 mb-2">
                <div class="border rounded p-2" style="border-color: #e3e6f0;">
                  <small class="text-muted">Dec</small><br>
                  <strong class="text-primary">14</strong>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- User Registration Chart -->
    <div class="col-xl-4 col-lg-4">
      <div class="card shadow mb-4">
        <div class="card-header py-3 bg-gradient-primary">
          <h6 class="m-0 font-weight-bold text-white">Distribusi Pengguna</h6>
        </div>
        <div class="card-body">
          <div class="chart-container" style="position: relative; height: 245px;">
            <canvas id="userChart"></canvas>
          </div>
          <!-- Fallback jika chart tidak muncul -->
          <div id="user-fallback" style="display: none;">
            <div class="row text-center mt-3">
              <div class="col-6">
                <div class="border rounded p-3 mb-2" style="border: 2px solid #4e73df;">
                  <i class="fas fa-user-tie fa-2x text-primary mb-2"></i><br>
                  <small class="text-muted font-weight-bold">KLIEN</small><br>
                  <strong class="h4 text-primary">{{ $clientCount ?? 0 }}</strong>
                </div>
              </div>
              <div class="col-6">
                <div class="border rounded p-3 mb-2" style="border: 2px solid #36b9cc;">
                  <i class="fas fa-user-cog fa-2x text-info mb-2"></i><br>
                  <small class="text-muted font-weight-bold">FREELANCER</small><br>
                  <strong class="h4 text-info">{{ $freelancerCount ?? 0 }}</strong>
                </div>
              </div>
            </div>
          </div>
          <div class="mt-4 text-center small">
            <span class="mr-3">
              <i class="fas fa-circle text-primary"></i> Klien
            </span>
            <span class="mr-2">
              <i class="fas fa-circle text-info"></i> Freelancer
            </span>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Recent Activity -->
  <div class="row">
    <div class="col-lg-12">
      <div class="card shadow mb-4">
        <div class="card-header py-3 bg-gradient-primary">
          <div class="d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-white">
              <i class="fas fa-clipboard-list mr-2"></i>Proyek Terbaru
            </h6>
            <a href="{{ route('admin.projects.index') ?? '#' }}" class="btn btn-sm btn-outline-light">
              <i class="fas fa-cog mr-1"></i>Kelola Proyek
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
                  <th class="font-weight-bold text-gray-700">Tanggal Dibuat</th>
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
                          // Mengambil budget dari proposal_price di tabel proposals
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
                        <p>Belum ada proyek yang dibuat saat ini.</p>
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

.btn {
    transition: all 0.2s ease;
}

.btn:hover {
    transform: translateY(-1px);
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

.bg-gradient-primary {
    background: linear-gradient(90deg, #4e73df 0%, #224abe 100%);
}

.card-header {
    border-bottom: 1px solid #e3e6f0;
}

.text-gray-400 {
    color: #858796 !important;
}

.text-gray-600 {
    color: #6c757d !important;
}

.text-gray-700 {
    color: #5a5c69 !important;
}

.text-gray-800 {
    color: #3d3d3d !important;
}

#projectYearSelector {
    background-color: rgba(255,255,255,0.9);
    border: 1px solid rgba(255,255,255,0.3);
    color: #5a5c69;
    font-size: 0.85rem;
}

#projectYearSelector:focus {
    background-color: white;
    border-color: #4e73df;
    box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
}

.chart-container {
    position: relative;
}

@media (max-width: 768px) {
    .table-responsive {
        border: none;
    }
    
    .card-header .d-flex {
        flex-direction: column;
        gap: 15px;
        align-items: flex-start !important;
    }
}
</style>
@endpush

@push('scripts')
<!-- Chart.js dari CDNJS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.min.js"></script>

<script>
// Variabel global untuk menyimpan chart instances
let projectChart = null;
let userChart = null;

// Data untuk 12 bulan penuh untuk project statistics
const projectYearData = {
    2025: [2, 5, 8, 12, 15, 9, 18, 22, 16, 20, 25, 14],
    2024: [1, 3, 6, 9, 12, 7, 15, 18, 14, 17, 21, 11],
    2023: [1, 2, 4, 7, 9, 5, 12, 15, 11, 14, 17, 8]
};

const monthLabels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

// Fungsi untuk menampilkan fallback jika chart gagal
function showFallback(chartType = 'all') {
    console.log('Showing fallback for:', chartType);
    
    if (chartType === 'all' || chartType === 'project') {
        const projectFallback = document.getElementById('project-fallback');
        const projectCanvas = document.getElementById('projectChart');
        if (projectFallback && projectCanvas) {
            projectFallback.style.display = 'block';
            projectCanvas.parentElement.style.display = 'none';
        }
    }
    
    if (chartType === 'all' || chartType === 'user') {
        const userFallback = document.getElementById('user-fallback');
        const userCanvas = document.getElementById('userChart');
        if (userFallback && userCanvas) {
            userFallback.style.display = 'block';
            userCanvas.parentElement.style.display = 'none';
        }
    }
}

// Fungsi untuk membuat Project Chart dengan line chart seperti gambar referensi
function createProjectChart(year = 2025) {
    const projectElement = document.getElementById('projectChart');
    if (!projectElement) {
        console.error('Project chart canvas not found');
        showFallback('project');
        return false;
    }

    try {
        const ctx = projectElement.getContext('2d');
        
        if (projectChart) {
            projectChart.destroy();
        }
        
        const data = projectYearData[year] || projectYearData[2024];
        
        // Create gradient for area chart
        const gradient = ctx.createLinearGradient(0, 0, 0, 320);
        gradient.addColorStop(0, 'rgba(78, 115, 223, 0.8)');
        gradient.addColorStop(0.5, 'rgba(78, 115, 223, 0.4)');
        gradient.addColorStop(1, 'rgba(78, 115, 223, 0.1)');
        
        projectChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: monthLabels,
                datasets: [{
                    label: 'Proyek Dibuat',
                    data: data,
                    borderColor: '#4e73df',
                    backgroundColor: gradient,
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: '#4e73df',
                    pointBorderColor: '#ffffff',
                    pointBorderWidth: 3,
                    pointRadius: 5,
                    pointHoverRadius: 8,
                    pointHoverBackgroundColor: '#4e73df',
                    pointHoverBorderColor: '#ffffff',
                    pointHoverBorderWidth: 3
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: {
                    intersect: false,
                    mode: 'index'
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 5,
                            color: '#858796',
                            callback: function(value) {
                                return value;
                            }
                        },
                        grid: {
                            color: 'rgba(0,0,0,0.1)',
                            drawBorder: false
                        }
                    },
                    x: {
                        ticks: {
                            color: '#858796'
                        },
                        grid: {
                            display: false
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: 'rgba(90, 92, 105, 0.9)',
                        titleColor: 'white',
                        bodyColor: 'white',
                        borderColor: '#5a5c69',
                        borderWidth: 1,
                        cornerRadius: 8,
                        padding: 12,
                        callbacks: {
                            title: function(context) {
                                return 'Bulan ' + context[0].label + ' ' + year;
                            },
                            label: function(context) {
                                return 'Proyek: ' + context.parsed.y;
                            }
                        }
                    }
                }
            }
        });
        
        console.log('Project chart created successfully for year:', year);
        return true;
    } catch (error) {
        console.error('Error creating project chart:', error);
        showFallback('project');
        return false;
    }
}

// Fungsi untuk membuat User Chart (doughnut chart)
function createUserChart(clientCount, freelancerCount) {
    const userElement = document.getElementById('userChart');
    if (!userElement) {
        console.error('User chart canvas not found');
        showFallback('user');
        return false;
    }

    try {
        const ctx = userElement.getContext('2d');
        
        if (userChart) {
            userChart.destroy();
        }
        
        const total = clientCount + freelancerCount;
        
        userChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Klien', 'Freelancer'],
                datasets: [{
                    data: [clientCount, freelancerCount],
                    backgroundColor: ['#4e73df', '#36b9cc'],
                    borderWidth: 3,
                    borderColor: '#ffffff',
                    hoverBackgroundColor: ['#2e59d9', '#2c9faf'],
                    hoverBorderColor: '#ffffff',
                    hoverBorderWidth: 3
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
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
                                const percentage = total > 0 ? ((value / total) * 100).toFixed(1) : 0;
                                return `${label}: ${value} (${percentage}%)`;
                            }
                        }
                    }
                },
                cutout: '60%',
                animation: {
                    animateRotate: true,
                    duration: 1000
                }
            }
        });
        
        console.log('User chart created successfully');
        return true;
    } catch (error) {
        console.error('Error creating user chart:', error);
        showFallback('user');
        return false;
    }
}

// Event listener untuk year selector
document.addEventListener('DOMContentLoaded', function() {
    const yearSelector = document.getElementById('projectYearSelector');
    if (yearSelector) {
        yearSelector.addEventListener('change', function() {
            const selectedYear = parseInt(this.value);
            createProjectChart(selectedYear);
        });
    }
});

// Inisialisasi charts setelah DOM loaded
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM loaded, initializing dashboard charts...');
    
    setTimeout(function() {
        if (typeof Chart === 'undefined') {
            console.error('Chart.js tidak berhasil dimuat');
            showFallback('all');
            return;
        }
        
        console.log('Chart.js loaded successfully, version:', Chart.version);
        
        try {
            // Data dari server dengan fallback values
            const clientCount = {{ $clientCount ?? 5 }};
            const freelancerCount = {{ $freelancerCount ?? 8 }};
            
            console.log('Dashboard Data:', { clientCount, freelancerCount });
            
            // Create charts dengan tahun default 2024
            const projectSuccess = createProjectChart(2025);
            const userSuccess = createUserChart(clientCount, freelancerCount);
            
            if (!projectSuccess && !userSuccess) {
                console.log('Both charts failed, showing all fallbacks');
            } else {
                console.log('Dashboard charts initialized:', { projectSuccess, userSuccess });
            }
            
        } catch (error) {
            console.error('Error in dashboard chart initialization:', error);
            showFallback('all');
        }
    }, 100);
});

// Responsive chart resize handler
window.addEventListener('resize', function() {
    setTimeout(function() {
        if (projectChart) {
            projectChart.resize();
        }
        if (userChart) {
            userChart.resize();
        }
    }, 100);
});
</script>
@endpush