@extends('admin.layouts.main')
@section('title', 'All Projects')
@section('content')
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Kelola Proyek</h1>
  </div>

  <!-- Total Projects Card -->
  <div class="row">
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2" style="border-left: 4px solid #4e73df !important;">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                Total Projects</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">
                {{ $projects->total() ?? 0 }}
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-project-diagram fa-2x text-gray-400"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Projects List -->
  <div class="card shadow mb-4">
    <div class="card-header py-3 bg-gradient-primary">
      <div class="d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-white">
          <i class="fas fa-list mr-2"></i>Projects List
        </h6>
        <div>
          <button type="button" class="btn btn-sm btn-light mr-2" data-toggle="modal" data-target="#createProjectModal">
            <i class="fas fa-plus"></i> Create Project
          </button>
          <a href="{{ route('admin.projects.index') }}" class="btn btn-sm btn-outline-light">
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
              <th class="font-weight-bold text-gray-700">No.</th>
              <th class="font-weight-bold text-gray-700">User</th>
              <th class="font-weight-bold text-gray-700">Title</th>
              <th class="font-weight-bold text-gray-700">Category</th>
              <th class="font-weight-bold text-gray-700">Subcategory</th>
              <th class="font-weight-bold text-gray-700">Experience Level</th>
              <th class="font-weight-bold text-gray-700">Project Type</th>
              <th class="font-weight-bold text-gray-700">Description</th>
              <th class="font-weight-bold text-gray-700">Budget Type</th>
              <th class="font-weight-bold text-gray-700">Payment Method</th>
              <th class="font-weight-bold text-gray-700">DP %</th>
              <th class="font-weight-bold text-gray-700">Fixed Budget</th>
              <th class="font-weight-bold text-gray-700">Urgency</th>
              <th class="font-weight-bold text-gray-700">Posted At</th>
              <th class="font-weight-bold text-gray-700">Deadline</th>
              <th class="font-weight-bold text-gray-700">Created At</th>
              <th class="font-weight-bold text-gray-700 text-center">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse($projects as $index => $project)
              <tr class="hover-row">
                <td class="font-weight-bold">{{ $projects->firstItem() + $index }}</td>
                <td>
                  <div class="d-flex align-items-center">
                    <div class="mr-3">
                      <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center" style="width: 35px; height: 35px;">
                        <i class="fas fa-user"></i>
                      </div>
                    </div>
                    <div>
                      <div class="font-weight-bold">{{ $project->user->name ?? 'N/A' }}</div>
                      <small class="text-muted">User ID: {{ $project->user_id ?? 'N/A' }}</small>
                    </div>
                  </div>
                </td>
                <td>
                  <span class="text-primary font-weight-bold">{{ $project->title ?? '-' }}</span>
                </td>
                <td>
                  <span class="badge badge-info px-2 py-1" style="font-size: 0.75rem;">
                    {{ $project->category ?? '-' }}
                  </span>
                </td>
                <td>{{ $project->subcategory ?? '-' }}</td>
                <td>
                  <span class="badge badge-secondary px-2 py-1" style="font-size: 0.75rem;">
                    {{ $project->experience_level ?? '-' }}
                  </span>
                </td>
                <td>
                  <span class="badge badge-primary px-2 py-1" style="font-size: 0.75rem;">
                    {{ $project->project_type ?? '-' }}
                  </span>
                </td>
                <td>
                  <small class="text-muted">
                    {{ Str::limit($project->description, 50) ?? '-' }}
                  </small>
                </td>
                <td>
                  <span class="badge badge-success px-2 py-1" style="font-size: 0.75rem;">
                    {{ $project->budget_type ?? '-' }}
                  </span>
                </td>
                <td>{{ $project->payment_method ?? '-' }}</td>
                <td>
                  <span class="badge badge-warning px-2 py-1" style="font-size: 0.75rem;">
                    {{ $project->dp_percentage ? $project->dp_percentage.'%' : '-' }}
                  </span>
                </td>
                <td>
                  <span class="text-success font-weight-bold">
                    {{ $project->fixed_budget ? '$'.number_format($project->fixed_budget, 2) : '-' }}
                  </span>
                </td>
                <td>
                  @php
                    $urgencyClass = match($project->urgency) {
                      'urgent' => 'danger',
                      'high' => 'warning',
                      'normal' => 'info',
                      default => 'secondary'
                    };
                  @endphp
                  <span class="badge badge-{{ $urgencyClass }} px-2 py-1" style="font-size: 0.75rem;">
                    {{ $project->urgency ?? '-' }}
                  </span>
                </td>
                <td>
                  <small class="text-muted">
                    <i class="fas fa-calendar mr-1"></i>
                    {{ $project->posted_at ? $project->posted_at->format('M d, Y') : '-' }}
                  </small>
                </td>
                <td>
                  <small class="text-muted">
                    <i class="fas fa-clock mr-1"></i>
                    {{ $project->deadline ? $project->deadline->format('M d, Y') : '-' }}
                  </small>
                </td>
                <td>
                  <small class="text-muted">
                    <i class="fas fa-calendar-check mr-1"></i>
                    {{ $project->created_at ? $project->created_at->format('M d, Y') : '-' }}
                  </small>
                </td>
                <td class="text-center">
                  <div class="btn-group" role="group">
                    <button type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#editProjectModal" onclick="editProject({{ $project->id }}, '{{ addslashes($project->title ?? '') }}')" title="Edit">
                      <i class="fas fa-edit"></i>
                    </button>
                    <button type="button" class="btn btn-sm btn-outline-danger" data-toggle="modal" data-target="#deleteProjectModal" onclick="deleteProject({{ $project->id }}, '{{ addslashes($project->title ?? '') }}')" title="Delete">
                      <i class="fas fa-trash"></i>
                    </button>
                  </div>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="18" class="text-center py-4">
                  <div class="text-muted">
                    <i class="fas fa-project-diagram fa-3x mb-3" style="color: #e3e6f0;"></i>
                    <h5>No projects found</h5>
                    <p>Belum ada data project saat ini.</p>
                  </div>
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
      <div class="d-flex justify-content-center mt-3">
        {{ $projects->links() }}
      </div>
    </div>
  </div>

  <!-- Create Project Modal -->
  <div class="modal fade" id="createProjectModal" tabindex="-1" role="dialog" aria-labelledby="createProjectModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title" id="createProjectModalLabel">
            <i class="fas fa-plus mr-2"></i>Buat Proyek Baru
          </h5>
          <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="/admin/projects" method="POST">
          @csrf
          <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
            
            <!-- Basic Information -->
            <div class="mb-4">
              <h6 class="font-weight-bold text-primary mb-3">Informasi Dasar</h6>
              
              <div class="form-group">
                <label for="create_project_title" class="font-weight-bold">Judul Proyek <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="create_project_title" name="title" placeholder="Contoh: Dicari: Freelancer untuk Pembuatan Website E-Commerce" maxlength="100" required>
                <small class="text-muted">Maksimal 100 karakter</small>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="create_category" class="font-weight-bold">Kategori <span class="text-danger">*</span></label>
                    <select class="form-control" id="create_category" name="category" required>
                      <option value="">Pilih Kategori</option>
                      <option value="pekerjaan-popular">Pekerjaan Popular</option>
                      <option value="grafis-desain">Grafis & Desain</option>
                      <option value="dokumen-ppt">Dokumen & PPT</option>
                      <option value="web-app">Web & App</option>
                      <option value="video-editing">Video Editing</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="create_subcategory" class="font-weight-bold">Sub Kategori</label>
                    <select class="form-control" id="create_subcategory" name="subcategory">
                      <option value="">Pilih Sub Kategori</option>
                    </select>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label for="create_project_type" class="font-weight-bold">Jenis Proyek <span class="text-danger">*</span></label>
                <select class="form-control" id="create_project_type" name="project_type" required>
                  <option value="">Pilih Jenis</option>
                  <option value="one-time">Sekali jalan</option>
                </select>
              </div>

              <div class="form-group">
                <label for="create_skills" class="font-weight-bold">Skills yang Dibutuhkan <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="create_skills" name="skills_required" placeholder="Laravel, PHP, JavaScript, MySQL">
                <small class="text-muted">Pisahkan dengan koma</small>
              </div>
            </div>

            <!-- Project Details -->
            <div class="mb-4">
              <h6 class="font-weight-bold text-primary mb-3">Detail Proyek</h6>
              
              <div class="form-group">
                <label for="create_description" class="font-weight-bold">Deskripsi Proyek <span class="text-danger">*</span></label>
                <textarea class="form-control" id="create_description" name="description" rows="4" placeholder="Jelaskan detail proyek Anda secara lengkap..." required></textarea>
              </div>

              <div class="form-group">
                <label for="create_requirements" class="font-weight-bold">Persyaratan Khusus</label>
                <textarea class="form-control" id="create_requirements" name="requirements" rows="3" placeholder="Persyaratan khusus atau kualifikasi yang dibutuhkan..."></textarea>
              </div>

              <div class="form-group">
                <label for="create_deliverables" class="font-weight-bold">Hasil yang Diharapkan <span class="text-danger">*</span></label>
                <textarea class="form-control" id="create_deliverables" name="deliverables" rows="3" placeholder="Apa saja yang diharapkan sebagai hasil akhir proyek..." required></textarea>
              </div>
            </div>

            <!-- Budget & Timeline -->
            <div class="mb-4">
              <h6 class="font-weight-bold text-primary mb-3">Budget & Timeline</h6>
              
              <div class="form-group">
                <label class="font-weight-bold">Tipe Budget <span class="text-danger">*</span></label>
                <div class="row">
                  <div class="col-md-6">
                    <div class="card border-primary" style="cursor: pointer;" onclick="selectCreateBudgetType('fixed')">
                      <div class="card-body text-center p-3">
                        <input type="radio" name="budget_type" value="fixed" id="create_budget_fixed" hidden>
                        <h6 class="mb-2">Budget Tetap</h6>
                        <small class="text-muted">Bayar sejumlah tetap untuk seluruh proyek</small>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="card border-secondary" style="cursor: pointer;" onclick="selectCreateBudgetType('range')">
                      <div class="card-body text-center p-3">
                        <input type="radio" name="budget_type" value="range" id="create_budget_range" hidden>
                        <h6 class="mb-2">Rentang Budget</h6>
                        <small class="text-muted">Tentukan budget minimum dan maksimum</small>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div id="create_fixed_budget_group" style="display: none;">
                <div class="form-group">
                  <label for="create_fixed_budget" class="font-weight-bold">Budget Tetap (Rp) <span class="text-danger">*</span></label>
                  <input type="number" class="form-control" id="create_fixed_budget" name="fixed_budget" placeholder="5000000" min="0">
                </div>
              </div>

              <div id="create_range_budget_group" style="display: none;">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="create_min_budget" class="font-weight-bold">Budget Minimum (Rp) <span class="text-danger">*</span></label>
                      <input type="number" class="form-control" id="create_min_budget" name="min_budget" placeholder="2000000" min="0">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="create_max_budget" class="font-weight-bold">Budget Maksimum (Rp) <span class="text-danger">*</span></label>
                      <input type="number" class="form-control" id="create_max_budget" name="max_budget" placeholder="10000000" min="0">
                    </div>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label class="font-weight-bold">Metode Pembayaran <span class="text-danger">*</span></label>
                <div class="row">
                  <div class="col-md-6">
                    <div class="custom-control custom-radio">
                      <input type="radio" class="custom-control-input" id="create_payment_full" name="payment_method" value="full" checked>
                      <label class="custom-control-label" for="create_payment_full">
                        <strong>Bayar Lunas</strong><br>
                        <small class="text-muted">Pembayaran 100% di awal</small>
                      </label>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="custom-control custom-radio">
                      <input type="radio" class="custom-control-input" id="create_payment_dp" name="payment_method" value="dp_and_final">
                      <label class="custom-control-label" for="create_payment_dp">
                        <strong>DP + Pelunasan</strong><br>
                        <small class="text-muted">DP di awal, sisa di akhir</small>
                      </label>
                    </div>
                  </div>
                </div>
              </div>

              <div class="form-group" id="create_dp_group" style="display: none;">
                <label for="create_dp_percentage" class="font-weight-bold">Persentase DP (%) <span class="text-danger">*</span></label>
                <select class="form-control" id="create_dp_percentage" name="dp_percentage">
                  <option value="">Pilih Persentase DP</option>
                  <option value="30">30% - 70%</option>
                  <option value="40">40% - 60%</option>
                  <option value="50">50% - 50%</option>
                  <option value="60">60% - 40%</option>
                </select>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="create_timeline_type" class="font-weight-bold">Jenis Timeline <span class="text-danger">*</span></label>
                    <select class="form-control" id="create_timeline_type" name="timeline_type" required>
                      <option value="weekly">Mingguan</option>
                      <option value="daily">Harian</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="create_timeline_duration" class="font-weight-bold">Durasi Pengerjaan <span class="text-danger">*</span></label>
                    <select class="form-control" id="create_timeline_duration" name="timeline_duration" required>
                      <option value="">Pilih Durasi</option>
                      <option value="1">1 Minggu</option>
                      <option value="2">2 Minggu</option>
                      <option value="3">3 Minggu</option>
                      <option value="4">4 Minggu (1 Bulan)</option>
                      <option value="6">6 Minggu</option>
                      <option value="8">8 Minggu (2 Bulan)</option>
                      <option value="12">12 Minggu (3 Bulan)</option>
                    </select>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label for="create_deadline" class="font-weight-bold">Deadline Proyek</label>
                <input type="date" class="form-control" id="create_deadline" name="deadline" readonly style="background-color: #f8f9fa;">
                <small class="text-muted">Deadline otomatis dihitung berdasarkan durasi pengerjaan</small>
              </div>
            </div>

            <div class="alert alert-info">
              <i class="fas fa-info-circle mr-2"></i>
              <strong>Info:</strong> Setelah dibuat, Anda dapat mengedit proyek untuk menambahkan detail lainnya seperti lampiran file.
            </div>
          </div>
          <div class="modal-footer bg-light">
            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary" onclick="handleCreateProject(event)">
              <i class="fas fa-save mr-1"></i>Buat Proyek
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Edit Project Modal -->
  <div class="modal fade" id="editProjectModal" tabindex="-1" role="dialog" aria-labelledby="editProjectModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header bg-info text-white">
          <h5 class="modal-title" id="editProjectModalLabel">
            <i class="fas fa-edit mr-2"></i>Edit Proyek
          </h5>
          <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="" method="POST" id="editProjectForm">
          @csrf
          @method('PUT')
          <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
            
            <!-- Basic Information -->
            <div class="mb-4">
              <h6 class="font-weight-bold text-info mb-3">Informasi Dasar</h6>
              
              <div class="form-group">
                <label for="edit_project_title" class="font-weight-bold">Judul Proyek <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="edit_project_title" name="title" maxlength="100" required>
                <small class="text-muted">Maksimal 100 karakter</small>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="edit_category" class="font-weight-bold">Kategori <span class="text-danger">*</span></label>
                    <select class="form-control" id="edit_category" name="category" required>
                      <option value="">Pilih Kategori</option>
                      <option value="pekerjaan-popular">Pekerjaan Popular</option>
                      <option value="grafis-desain">Grafis & Desain</option>
                      <option value="dokumen-ppt">Dokumen & PPT</option>
                      <option value="web-app">Web & App</option>
                      <option value="video-editing">Video Editing</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="edit_subcategory" class="font-weight-bold">Sub Kategori</label>
                    <select class="form-control" id="edit_subcategory" name="subcategory">
                      <option value="">Pilih Sub Kategori</option>
                    </select>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label for="edit_project_type" class="font-weight-bold">Jenis Proyek <span class="text-danger">*</span></label>
                <select class="form-control" id="edit_project_type" name="project_type" required>
                  <option value="">Pilih Jenis</option>
                  <option value="one-time">Sekali jalan</option>
                </select>
              </div>

              <div class="form-group">
                <label for="edit_skills" class="font-weight-bold">Skills yang Dibutuhkan <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="edit_skills" name="skills_required" placeholder="Laravel, PHP, JavaScript, MySQL">
                <small class="text-muted">Pisahkan dengan koma</small>
              </div>
            </div>

            <!-- Project Details -->
            <div class="mb-4">
              <h6 class="font-weight-bold text-info mb-3">Detail Proyek</h6>
              
              <div class="form-group">
                <label for="edit_description" class="font-weight-bold">Deskripsi Proyek <span class="text-danger">*</span></label>
                <textarea class="form-control" id="edit_description" name="description" rows="4" required></textarea>
              </div>

              <div class="form-group">
                <label for="edit_requirements" class="font-weight-bold">Persyaratan Khusus</label>
                <textarea class="form-control" id="edit_requirements" name="requirements" rows="3"></textarea>
              </div>

              <div class="form-group">
                <label for="edit_deliverables" class="font-weight-bold">Hasil yang Diharapkan <span class="text-danger">*</span></label>
                <textarea class="form-control" id="edit_deliverables" name="deliverables" rows="3" required></textarea>
              </div>
            </div>

            <!-- Budget & Timeline -->
            <div class="mb-4">
              <h6 class="font-weight-bold text-info mb-3">Budget & Timeline</h6>
              
              <div class="form-group">
                <label class="font-weight-bold">Tipe Budget <span class="text-danger">*</span></label>
                <div class="row">
                  <div class="col-md-6">
                    <div class="card border-info" style="cursor: pointer;" onclick="selectEditBudgetType('fixed')">
                      <div class="card-body text-center p-3">
                        <input type="radio" name="budget_type" value="fixed" id="edit_budget_fixed" hidden>
                        <h6 class="mb-2">Budget Tetap</h6>
                        <small class="text-muted">Bayar sejumlah tetap untuk seluruh proyek</small>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="card border-secondary" style="cursor: pointer;" onclick="selectEditBudgetType('range')">
                      <div class="card-body text-center p-3">
                        <input type="radio" name="budget_type" value="range" id="edit_budget_range" hidden>
                        <h6 class="mb-2">Rentang Budget</h6>
                        <small class="text-muted">Tentukan budget minimum dan maksimum</small>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div id="edit_fixed_budget_group" style="display: none;">
                <div class="form-group">
                  <label for="edit_fixed_budget" class="font-weight-bold">Budget Tetap (Rp) <span class="text-danger">*</span></label>
                  <input type="number" class="form-control" id="edit_fixed_budget" name="fixed_budget" min="0">
                </div>
              </div>

              <div id="edit_range_budget_group" style="display: none;">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="edit_min_budget" class="font-weight-bold">Budget Minimum (Rp) <span class="text-danger">*</span></label>
                      <input type="number" class="form-control" id="edit_min_budget" name="min_budget" min="0">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="edit_max_budget" class="font-weight-bold">Budget Maksimum (Rp) <span class="text-danger">*</span></label>
                      <input type="number" class="form-control" id="edit_max_budget" name="max_budget" min="0">
                    </div>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label class="font-weight-bold">Metode Pembayaran <span class="text-danger">*</span></label>
                <div class="row">
                  <div class="col-md-6">
                    <div class="custom-control custom-radio">
                      <input type="radio" class="custom-control-input" id="edit_payment_full" name="payment_method" value="full">
                      <label class="custom-control-label" for="edit_payment_full">
                        <strong>Bayar Lunas</strong><br>
                        <small class="text-muted">Pembayaran 100% di awal</small>
                      </label>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="custom-control custom-radio">
                      <input type="radio" class="custom-control-input" id="edit_payment_dp" name="payment_method" value="dp_and_final">
                      <label class="custom-control-label" for="edit_payment_dp">
                        <strong>DP + Pelunasan</strong><br>
                        <small class="text-muted">DP di awal, sisa di akhir</small>
                      </label>
                    </div>
                  </div>
                </div>
              </div>

              <div class="form-group" id="edit_dp_group" style="display: none;">
                <label for="edit_dp_percentage" class="font-weight-bold">Persentase DP (%) <span class="text-danger">*</span></label>
                <select class="form-control" id="edit_dp_percentage" name="dp_percentage">
                  <option value="">Pilih Persentase DP</option>
                  <option value="30">30% - 70%</option>
                  <option value="40">40% - 60%</option>
                  <option value="50">50% - 50%</option>
                  <option value="60">60% - 40%</option>
                </select>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="edit_timeline_type" class="font-weight-bold">Jenis Timeline <span class="text-danger">*</span></label>
                    <select class="form-control" id="edit_timeline_type" name="timeline_type" required>
                      <option value="weekly">Mingguan</option>
                      <option value="daily">Harian</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="edit_timeline_duration" class="font-weight-bold">Durasi Pengerjaan <span class="text-danger">*</span></label>
                    <select class="form-control" id="edit_timeline_duration" name="timeline_duration" required>
                      <option value="">Pilih Durasi</option>
                      <option value="1">1 Minggu</option>
                      <option value="2">2 Minggu</option>
                      <option value="3">3 Minggu</option>
                      <option value="4">4 Minggu (1 Bulan)</option>
                      <option value="6">6 Minggu</option>
                      <option value="8">8 Minggu (2 Bulan)</option>
                      <option value="12">12 Minggu (3 Bulan)</option>
                    </select>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label for="edit_deadline" class="font-weight-bold">Deadline Proyek</label>
                <input type="date" class="form-control" id="edit_deadline" name="deadline" readonly style="background-color: #f8f9fa;">
                <small class="text-muted">Deadline otomatis dihitung berdasarkan durasi pengerjaan</small>
              </div>
            </div>

            <div class="alert alert-warning">
              <i class="fas fa-exclamation-triangle mr-2"></i>
              <strong>Perhatian:</strong> Perubahan akan mempengaruhi data proyek yang sudah ada. Pastikan semua informasi telah benar sebelum menyimpan.
            </div>
          </div>
          <div class="modal-footer bg-light">
            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-info" onclick="handleEditProject(event)">
              <i class="fas fa-save mr-1"></i>Update Proyek
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Delete Project Modal -->
  <div class="modal fade" id="deleteProjectModal" tabindex="-1" role="dialog" aria-labelledby="deleteProjectModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-danger text-white">
          <h5 class="modal-title" id="deleteProjectModalLabel">
            <i class="fas fa-trash mr-2"></i>Hapus Proyek
          </h5>
          <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="" method="POST" id="deleteProjectForm">
          @csrf
          @method('DELETE')
          <div class="modal-body">
            <div class="alert alert-danger">
              <i class="fas fa-exclamation-triangle mr-2"></i>
              <strong>Peringatan!</strong> Tindakan ini tidak dapat dibatalkan.
            </div>
            <p>Apakah Anda yakin ingin menghapus proyek <strong id="deleteProjectName"></strong>?</p>
            <div class="alert alert-warning">
              <i class="fas fa-info-circle mr-2"></i>
              Menghapus proyek akan menghapus semua data terkait termasuk proposal dan komunikasi.
            </div>
          </div>
          <div class="modal-footer bg-light">
            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-danger" onclick="handleDeleteProject(event)">
              <i class="fas fa-trash mr-1"></i>Hapus Proyek
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

/* Custom alert styling - keeping original styling for notifications */
.custom-alert {
    position: fixed;
    top: 20px;
    right: 20px;
    z-index: 9999;
    padding: 15px 20px;
    border-radius: 8px;
    color: white;
    font-weight: 500;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    transform: translateX(400px);
    transition: all 0.3s ease;
    max-width: 350px;
    word-wrap: break-word;
}

.custom-alert.show {
    transform: translateX(0);
}

.custom-alert.success {
    background: linear-gradient(135deg, #28a745, #20c997);
}

.custom-alert.info {
    background: linear-gradient(135deg, #17a2b8, #20c997);
}

.custom-alert.warning {
    background: linear-gradient(135deg, #ffc107, #fd7e14);
    color: #212529;
}

.custom-alert.danger {
    background: linear-gradient(135deg, #dc3545, #e74c3c);
}
</style>
@endpush

@push('scripts')
<script>
let alertTimeout;

// Function to show custom alert - keeping original functionality
function showCustomAlert(message, type = 'success') {
    // Clear existing timeout
    if (alertTimeout) {
        clearTimeout(alertTimeout);
    }
    
    // Remove existing alerts
    document.querySelectorAll('.custom-alert').forEach(alert => {
        alert.remove();
    });
    
    // Create alert element
    const alert = document.createElement('div');
    alert.className = `custom-alert ${type}`;
    alert.innerHTML = `
        <div class="d-flex justify-content-between align-items-center">
            <span>${message}</span>
            <button type="button" class="ml-2 text-white" style="background: none; border: none; font-size: 18px; cursor: pointer;" onclick="this.parentElement.parentElement.remove()">
                <i class="fas fa-times"></i>
            </button>
        </div>
    `;
    
    document.body.appendChild(alert);
    
    // Show alert
    setTimeout(() => {
        alert.classList.add('show');
    }, 100);
    
    // Auto remove after 4 seconds
    alertTimeout = setTimeout(() => {
        alert.classList.remove('show');
        setTimeout(() => {
            alert.remove();
        }, 300);
    }, 4000);
}

// Modal functions for projects
function editProject(id, title) {
    document.getElementById('edit_project_title').value = title;
    document.getElementById('editProjectForm').action = `/admin/projects/${id}`;
}

function deleteProject(id, title) {
    document.getElementById('deleteProjectName').textContent = title;
    document.getElementById('deleteProjectForm').action = `/admin/projects/${id}`;
}

// Handle form submissions with original logic
function handleCreateProject(event) {
    event.preventDefault();
    const projectTitle = document.getElementById('create_project_title').value;
    
    if (projectTitle && projectTitle.trim() !== '') {
        showCustomAlert(`✅ Project "${projectTitle}" has been created successfully!`, 'success');
        console.log('Create project:', { title: projectTitle });
        // Close modal
        $('#createProjectModal').modal('hide');
        // Reset form
        document.getElementById('create_project_title').value = '';
    } else {
        showCustomAlert('⚠️ Project title cannot be empty!', 'warning');
    }
}

function handleEditProject(event) {
    event.preventDefault();
    const newTitle = document.getElementById('edit_project_title').value;
    const oldTitle = document.getElementById('edit_project_title').getAttribute('data-original-title') || 'Project';
    
    if (newTitle && newTitle.trim() !== '') {
        showCustomAlert(`✏️ Project "${oldTitle}" has been updated to "${newTitle}"!`, 'info');
        console.log('Edit project:', { oldTitle: oldTitle, newTitle: newTitle });
        // Close modal
        $('#editProjectModal').modal('hide');
    } else {
        showCustomAlert('⚠️ Project title cannot be empty!', 'warning');
    }
}

function handleDeleteProject(event) {
    event.preventDefault();
    const projectTitle = document.getElementById('deleteProjectName').textContent;
    
    showCustomAlert(`🗑️ Project "${projectTitle}" has been deleted permanently!`, 'danger');
    console.log('Delete project:', { title: projectTitle });
    // Close modal
    $('#deleteProjectModal').modal('hide');
}

// Enhanced edit function to store original title
function editProject(id, title) {
    document.getElementById('edit_project_title').value = title;
    document.getElementById('edit_project_title').setAttribute('data-original-title', title);
    document.getElementById('editProjectForm').action = `/admin/projects/${id}`;
}

// Add data attributes to rows for easier identification (optional)
document.addEventListener('DOMContentLoaded', function() {
    const rows = document.querySelectorAll('tbody tr');
    rows.forEach(row => {
        const idCell = row.cells[1]; // ID column
        if (idCell && idCell.textContent.trim()) {
            row.setAttribute('data-project-id', idCell.textContent.trim());
        }
    });
});

// Page load success message
window.addEventListener('load', function() {
    showCustomAlert('📋 Projects page loaded successfully!', 'success');
});
</script>
@endpush