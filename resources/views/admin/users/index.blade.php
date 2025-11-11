@extends('admin.layouts.main')

@section('title', 'All Users')

@section('content')
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Kelola User</h1>
  </div>

  <div class="row">
    <!-- Total Users Card -->
    <div class="col-xl-4 col-md-4 mb-4">
      <div class="card border-left-primary shadow h-100 py-2" style="border-left: 4px solid #4e73df !important;">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                Total Pengguna</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">
                {{ $users->total() ?? 0 }}
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-users fa-2x text-gray-400"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Clients Card -->
    <div class="col-xl-4 col-md-4 mb-4">
      <div class="card border-left-info shadow h-100 py-2" style="border-left: 4px solid #36b9cc !important;">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
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
    <div class="col-xl-4 col-md-4 mb-4">
      <div class="card border-left-secondary shadow h-100 py-2" style="border-left: 4px solid #858796 !important;">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">
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
  </div>

  <!-- Charts Row -->
  <div class="row">
    <!-- User Registration Chart -->
    <div class="col-xl-8 col-lg-8">
      <div class="card shadow mb-4">
        <div class="card-header py-3 bg-primary">
          <div class="d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-white">Statistik Registrasi Pengguna</h6>
            <div class="d-flex align-items-center">
              <label class="text-white mb-0 mr-2 small">Tahun:</label>
              <select class="form-control form-control-sm" id="yearSelector" style="width: auto;">
                <option value="2024" selected>2024</option>
                <option value="2023">2023</option>
                <option value="2022">2022</option>
              </select>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="chart-container" style="position: relative; height: 320px;">
            <canvas id="userRegistrationChart"></canvas>
          </div>
          <!-- Fallback jika chart tidak muncul -->
          <div id="registration-fallback" style="display: none;">
            <h5 class="text-center mb-3 text-gray-600">Registrasi Pengguna Bulanan</h5>
            <div class="row text-center">
              <div class="col-2 mb-2">
                <div class="border rounded p-2" style="border-color: #e3e6f0;">
                  <small class="text-muted">Jan</small><br>
                  <strong class="text-primary">5</strong>
                </div>
              </div>
              <div class="col-2 mb-2">
                <div class="border rounded p-2" style="border-color: #e3e6f0;">
                  <small class="text-muted">Feb</small><br>
                  <strong class="text-primary">8</strong>
                </div>
              </div>
              <div class="col-2 mb-2">
                <div class="border rounded p-2" style="border-color: #e3e6f0;">
                  <small class="text-muted">Mar</small><br>
                  <strong class="text-primary">12</strong>
                </div>
              </div>
              <div class="col-2 mb-2">
                <div class="border rounded p-2" style="border-color: #e3e6f0;">
                  <small class="text-muted">Apr</small><br>
                  <strong class="text-primary">7</strong>
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
                  <strong class="text-primary">11</strong>
                </div>
              </div>
              <div class="col-2 mb-2">
                <div class="border rounded p-2" style="border-color: #e3e6f0;">
                  <small class="text-muted">Aug</small><br>
                  <strong class="text-primary">13</strong>
                </div>
              </div>
              <div class="col-2 mb-2">
                <div class="border rounded p-2" style="border-color: #e3e6f0;">
                  <small class="text-muted">Sep</small><br>
                  <strong class="text-primary">6</strong>
                </div>
              </div>
              <div class="col-2 mb-2">
                <div class="border rounded p-2" style="border-color: #e3e6f0;">
                  <small class="text-muted">Oct</small><br>
                  <strong class="text-primary">10</strong>
                </div>
              </div>
              <div class="col-2 mb-2">
                <div class="border rounded p-2" style="border-color: #e3e6f0;">
                  <small class="text-muted">Nov</small><br>
                  <strong class="text-primary">14</strong>
                </div>
              </div>
              <div class="col-2 mb-2">
                <div class="border rounded p-2" style="border-color: #e3e6f0;">
                  <small class="text-muted">Dec</small><br>
                  <strong class="text-primary">8</strong>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- User Types Distribution -->
    <div class="col-xl-4 col-lg-4">
      <div class="card shadow mb-4">
        <div class="card-header py-3 bg-gradient-primary">
          <h6 class="m-0 font-weight-bold text-white">Distribusi Jenis Pengguna</h6>
        </div>
        <div class="card-body">
          <div class="chart-container" style="position: relative; height: 245px;">
            <canvas id="userTypesChart"></canvas>
          </div>
          <!-- Fallback jika chart tidak muncul -->
          <div id="types-fallback" style="display: none;">
            <div class="row text-center mt-2">
              <div class="col-6">
                <div class="border rounded p-3 mb-2" style="border: 2px solid #36b9cc;">
                  <i class="fas fa-user-tie fa-2x text-info mb-2"></i><br>
                  <small class="text-muted font-weight-bold">KLIEN</small><br>
                  <strong class="h4 text-info">{{ $clientCount ?? 0 }}</strong>
                </div>
              </div>
              <div class="col-6">
                <div class="border rounded p-3 mb-2" style="border: 2px solid #858796;">
                  <i class="fas fa-user-cog fa-2x text-secondary mb-2"></i><br>
                  <small class="text-muted font-weight-bold">FREELANCER</small><br>
                  <strong class="h4 text-secondary">{{ $freelancerCount ?? 0 }}</strong>
                </div>
              </div>
            </div>
          </div>
          <div class="mt-4 text-center small">
            <span class="mr-3">
              <i class="fas fa-circle text-info"></i> Klien
            </span>
            <span class="mr-2">
              <i class="fas fa-circle text-secondary"></i> Freelancer
            </span>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Users List -->
  <div class="card shadow mb-4">
    <div class="card-header py-3 bg-gradient-primary">
      <div class="d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-white">
          <i class="fas fa-users mr-2"></i>Daftar Pengguna
        </h6>
        <div>
          <button type="button" class="btn btn-sm btn-light mr-2" data-toggle="modal" data-target="#createUserModal">
            <i class="fas fa-plus"></i> Tambah Pengguna
          </button>
          <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-outline-light">
            <i class="fas fa-sync-alt"></i> Refresh
          </a>
        </div>
      </div>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered table-hover" width="100%" cellspacing="0">
          <thead class="bg-gray-200">
            <tr>
              <th class="font-weight-bold text-gray-700">#</th>
              <th class="font-weight-bold text-gray-700">Nama</th>
              <th class="font-weight-bold text-gray-700">Email</th>
              <th class="font-weight-bold text-gray-700">Role</th>
              <th class="font-weight-bold text-gray-700">Bergabung</th>
              <th class="font-weight-bold text-gray-700 text-center">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse($users as $index => $user)
              <tr class="hover-row">
                <td class="font-weight-bold">{{ $users->firstItem() + $index }}</td>
                <td>
                  <div class="d-flex align-items-center">
                    <div class="mr-3">
                      <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center" style="width: 35px; height: 35px;">
                        <i class="fas fa-user"></i>
                      </div>
                    </div>
                    <div>
                      <div class="font-weight-bold">{{ $user->name }}</div>
                      <small class="text-muted">ID: {{ $user->id }}</small>
                    </div>
                  </div>
                </td>
                <td>
                  <span class="text-primary">{{ $user->email }}</span>
                </td>
                <td>
                  @php
                    $roleClass = match($user->role) {
                      'client' => 'info',
                      'freelancer' => 'secondary',
                      'admin' => 'primary',
                      default => 'light'
                    };
                  @endphp
                  <span class="badge badge-{{ $roleClass }} px-3 py-2" style="font-size: 0.8rem;">
                    {{ ucfirst($user->role ?? 'user') }}
                  </span>
                </td>
                <td>
                  <small class="text-muted">
                    <i class="fas fa-calendar mr-1"></i>
                    {{ $user->created_at->format('M d, Y') }}
                  </small>
                </td>
                <td class="text-center">
                  <div class="btn-group" role="group">
                    <button type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#editUserModal" onclick="editUser({{ $user->id }}, '{{ $user->name }}', '{{ $user->email }}', '{{ $user->role }}')" title="Edit">
                      <i class="fas fa-edit"></i>
                    </button>
                    <button type="button" class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#deleteUserModal" onclick="deleteUser({{ $user->id }}, '{{ $user->name }}')" title="Hapus">
                      <i class="fas fa-trash"></i>
                    </button>
                  </div>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="6" class="text-center py-4">
                  <div class="text-muted">
                    <i class="fas fa-users fa-3x mb-3" style="color: #e3e6f0;"></i>
                    <h5>Tidak ada pengguna ditemukan</h5>
                    <p>Belum ada data pengguna saat ini.</p>
                  </div>
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
      <div class="d-flex justify-content-center mt-3">
        {{ $users->links() }}
      </div>
    </div>
  </div>

  <!-- Create User Modal -->
  <div class="modal fade" id="createUserModal" tabindex="-1" role="dialog" aria-labelledby="createUserModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title" id="createUserModalLabel">
            <i class="fas fa-plus mr-2"></i>Tambah Pengguna Baru
          </h5>
          <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="/admin/users" method="POST">
          @csrf
          <div class="modal-body">
            <div class="form-group">
              <label for="create_name" class="font-weight-bold">Nama</label>
              <input type="text" class="form-control" id="create_name" name="name" required>
            </div>
            <div class="form-group">
              <label for="create_email" class="font-weight-bold">Email</label>
              <input type="email" class="form-control" id="create_email" name="email" required>
            </div>
            <div class="form-group">
              <label for="create_role" class="font-weight-bold">Role</label>
              <select class="form-control" id="create_role" name="role" required>
                <option value="">Pilih Role</option>
                <option value="admin">Admin</option>
                <option value="client">Client</option>
                <option value="freelancer">Freelancer</option>
              </select>
            </div>
            <div class="form-group">
              <label for="create_password" class="font-weight-bold">Password</label>
              <input type="password" class="form-control" id="create_password" name="password" required>
            </div>
            <div class="form-group">
              <label for="create_password_confirmation" class="font-weight-bold">Konfirmasi Password</label>
              <input type="password" class="form-control" id="create_password_confirmation" name="password_confirmation" required>
            </div>
          </div>
          <div class="modal-footer bg-light">
            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">
              <i class="fas fa-save mr-1"></i>Buat Pengguna
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Edit User Modal -->
  <div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-info text-white">
          <h5 class="modal-title" id="editUserModalLabel">
            <i class="fas fa-edit mr-2"></i>Edit Pengguna
          </h5>
          <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="" method="POST" id="editUserForm">
          @csrf
          @method('PUT')
          <div class="modal-body">
            <div class="form-group">
              <label for="edit_name" class="font-weight-bold">Nama</label>
              <input type="text" class="form-control" id="edit_name" name="name" required>
            </div>
            <div class="form-group">
              <label for="edit_email" class="font-weight-bold">Email</label>
              <input type="email" class="form-control" id="edit_email" name="email" required>
            </div>
            <div class="form-group">
              <label for="edit_role" class="font-weight-bold">Role</label>
              <select class="form-control" id="edit_role" name="role" required>
                <option value="admin">Admin</option>
                <option value="client">Client</option>
                <option value="freelancer">Freelancer</option>
              </select>
            </div>
            <div class="form-group">
              <label for="edit_password" class="font-weight-bold">Password <small class="text-muted">(kosongkan jika tidak ingin mengubah)</small></label>
              <input type="password" class="form-control" id="edit_password" name="password">
            </div>
            <div class="form-group">
              <label for="edit_password_confirmation" class="font-weight-bold">Konfirmasi Password</label>
              <input type="password" class="form-control" id="edit_password_confirmation" name="password_confirmation">
            </div>
          </div>
          <div class="modal-footer bg-light">
            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-info">
              <i class="fas fa-save mr-1"></i>Update Pengguna
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Delete User Modal -->
  <div class="modal fade" id="deleteUserModal" tabindex="-1" role="dialog" aria-labelledby="deleteUserModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-danger text-white">
          <h5 class="modal-title" id="deleteUserModalLabel">
            <i class="fas fa-trash mr-2"></i>Hapus Pengguna
          </h5>
          <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="" method="POST" id="deleteUserForm">
          @csrf
          @method('DELETE')
          <div class="modal-body">
            <div class="alert alert-danger">
              <i class="fas fa-exclamation-triangle mr-2"></i>
              <strong>Peringatan!</strong> Tindakan ini tidak dapat dibatalkan.
            </div>
            <p>Apakah Anda yakin ingin menghapus pengguna <strong id="deleteUserName"></strong>?</p>
          </div>
          <div class="modal-footer bg-light">
            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-danger">
              <i class="fas fa-trash mr-1"></i>Hapus Pengguna
            </button>
          </div>
        </form>
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

.modal-header {
    border-bottom: 1px solid rgba(255,255,255,0.2);
}

.modal-footer {
    border-top: 1px solid #e3e6f0;
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

#yearSelector {
    background-color: rgba(255,255,255,0.9);
    border: 1px solid rgba(255,255,255,0.3);
    color: #5a5c69;
    font-size: 0.85rem;
}

#yearSelector:focus {
    background-color: white;
    border-color: #4e73df;
    box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
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
    
    .btn-group {
        width: 100%;
    }
    
    .btn-group .btn {
        flex: 1;
    }
}
</style>
@endpush

@push('scripts')
<!-- Chart.js dari CDNJS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.min.js"></script>

<script>
// Variabel global untuk menyimpan chart instances
let userRegistrationChart = null;
let userTypesChart = null;

// Data untuk 12 bulan penuh (contoh data, seharusnya dari server)
const fullYearData = {
    2024: [5, 8, 12, 7, 15, 9, 11, 13, 6, 10, 14, 8],
    2023: [4, 6, 9, 8, 12, 7, 10, 11, 5, 9, 12, 6],
    2022: [3, 5, 7, 6, 10, 5, 8, 9, 4, 7, 10, 5]
};

const monthLabels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

// Fungsi untuk menampilkan fallback jika chart gagal
function showFallback(chartType = 'all') {
    console.log('Showing fallback for:', chartType);
    
    if (chartType === 'all' || chartType === 'registration') {
        const registrationFallback = document.getElementById('registration-fallback');
        const registrationCanvas = document.getElementById('userRegistrationChart');
        if (registrationFallback && registrationCanvas) {
            registrationFallback.style.display = 'block';
            registrationCanvas.parentElement.style.display = 'none';
        }
    }
    
    if (chartType === 'all' || chartType === 'types') {
        const typesFallback = document.getElementById('types-fallback');
        const typesCanvas = document.getElementById('userTypesChart');
        if (typesFallback && typesCanvas) {
            typesFallback.style.display = 'block';
            typesCanvas.parentElement.style.display = 'none';
        }
    }
}

// Fungsi untuk membuat User Registration Chart
function createUserRegistrationChart(year = 2024) {
    const registrationElement = document.getElementById('userRegistrationChart');
    if (!registrationElement) {
        console.error('User registration chart canvas not found');
        showFallback('registration');
        return false;
    }

    try {
        const ctx = registrationElement.getContext('2d');
        
        if (userRegistrationChart) {
            userRegistrationChart.destroy();
        }
        
        const data = fullYearData[year] || fullYearData[2024];
        
        userRegistrationChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: monthLabels,
                datasets: [{
                    label: 'Pengguna Terdaftar',
                    data: data,
                    backgroundColor: 'rgba(78, 115, 223, 0.8)',
                    borderColor: '#4e73df',
                    borderWidth: 1,
                    borderRadius: 4,
                    borderSkipped: false
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1,
                            callback: function(value) {
                                return Math.floor(value) === value ? value : '';
                            },
                            color: '#858796'
                        },
                        grid: {
                            color: 'rgba(0,0,0,0.1)'
                        }
                    },
                    x: {
                        ticks: {
                            color: '#858796'
                        },
                        grid: {
                            color: 'rgba(0,0,0,0.1)'
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
                        cornerRadius: 8
                    }
                }
            }
        });
        
        console.log('User registration chart created successfully for year:', year);
        return true;
    } catch (error) {
        console.error('Error creating user registration chart:', error);
        showFallback('registration');
        return false;
    }
}

// Fungsi untuk membuat User Types Chart
function createUserTypesChart(clientCount, freelancerCount) {
    const typesElement = document.getElementById('userTypesChart');
    if (!typesElement) {
        console.error('User types chart canvas not found');
        showFallback('types');
        return false;
    }

    try {
        const ctx = typesElement.getContext('2d');
        
        if (userTypesChart) {
            userTypesChart.destroy();
        }
        
        const total = clientCount + freelancerCount;
        
        userTypesChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Klien', 'Freelancer'],
                datasets: [{
                    data: [clientCount, freelancerCount],
                    backgroundColor: ['#36b9cc', '#858796'],
                    borderWidth: 3,
                    borderColor: '#ffffff',
                    hoverBackgroundColor: ['#2c9faf', '#717384'],
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
                    duration: 800
                }
            }
        });
        
        console.log('User types chart created successfully');
        return true;
    } catch (error) {
        console.error('Error creating user types chart:', error);
        showFallback('types');
        return false;
    }
}

// Event listener untuk year selector
document.addEventListener('DOMContentLoaded', function() {
    const yearSelector = document.getElementById('yearSelector');
    if (yearSelector) {
        yearSelector.addEventListener('change', function() {
            const selectedYear = parseInt(this.value);
            createUserRegistrationChart(selectedYear);
        });
    }
});

// Modal functions
function editUser(id, name, email, role) {
    document.getElementById('edit_name').value = name;
    document.getElementById('edit_email').value = email;
    document.getElementById('edit_role').value = role;
    document.getElementById('editUserForm').action = `/admin/users/${id}`;
}

function deleteUser(id, name) {
    document.getElementById('deleteUserName').textContent = name;
    document.getElementById('deleteUserForm').action = `/admin/users/${id}`;
}

// Inisialisasi charts setelah DOM loaded
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM loaded, initializing user charts...');
    
    setTimeout(function() {
        if (typeof Chart === 'undefined') {
            console.error('Chart.js tidak berhasil dimuat');
            showFallback('all');
            return;
        }
        
        console.log('Chart.js loaded successfully, version:', Chart.version);
        
        try {
            // Data dari server dengan fallback values
            const clientCount = {{ $clientCount ?? 0 }};
            const freelancerCount = {{ $freelancerCount ?? 0 }};
            
            console.log('User Data:', { clientCount, freelancerCount });
            
            // Membuat chart dengan tahun default 2024
            const registrationSuccess = createUserRegistrationChart(2024);
            const typesSuccess = createUserTypesChart(clientCount, freelancerCount);
            
            if (!registrationSuccess && !typesSuccess) {
                console.log('Both charts failed, showing all fallbacks');
            } else {
                console.log('Charts initialized:', { registrationSuccess, typesSuccess });
            }
            
        } catch (error) {
            console.error('Error in chart initialization:', error);
            showFallback('all');
        }
    }, 100);
});

// Responsive chart resize handler
window.addEventListener('resize', function() {
    setTimeout(function() {
        if (userRegistrationChart) {
            userRegistrationChart.resize();
        }
        if (userTypesChart) {
            userTypesChart.resize();
        }
    }, 100);
});
</script>
@endpush