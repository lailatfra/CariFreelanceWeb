@extends('client.layout.client-layout') 
@section('title', 'Proyek Saya - CariFreelance') 
@section('content') 

<style>
    .nav-container {
        background: #f8fafc;
        border-bottom: 1px solid #e2e8f0;
        padding: 0;
        margin-bottom: 2rem;
    }

    .nav {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 1rem;
    }

    .nav-list {
        display: flex;
        list-style: none;
        margin: 0;
        padding: 0;
        overflow-x: auto;
    }

    .nav-item {
        white-space: nowrap;
    }

    .nav-link {
        display: block;
        padding: 1rem 1.5rem;
        color: #64748b;
        text-decoration: none;
        border-bottom: 3px solid transparent;
        transition: all 0.3s ease;
    }

    .nav-link:hover {
        color: #3b82f6;
        border-bottom-color: #3b82f6;
    }

    .main-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 1rem;
    }

    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
    }

    .page-title {
        font-size: 2rem;
        font-weight: 700;
        color: #1e293b;
        margin: 0;
    }

    .page-subtitle {
        color: #64748b;
        font-size: 1rem;
        margin-top: 0.5rem;
    }

    .header-actions {
        display: flex;
        gap: 1rem;
        align-items: center;
    }

    .btn {
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        font-weight: 500;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        cursor: pointer;
        border: none;
        font-size: 0.875rem;
        transition: all 0.2s ease;
    }

    .btn-primary {
        background: linear-gradient(90deg, #3b82f6, #1d4ed8);
        color: white;
    }

    .btn-primary:hover {
        background: linear-gradient(90deg, #2563eb, #1e40af);
        transform: translateY(-1px);
    }

    .btn-secondary {
        background: #f1f5f9;
        color: #64748b;
        border: 1px solid #e2e8f0;
    }

    .btn-secondary:hover {
        background: #e2e8f0;
        color: #475569;
    }

    .btn-sm {
        padding: 0.5rem 1rem;
        font-size: 0.75rem;
    }

    /* Filter & Stats */
    .stats-filters {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        padding: 1.5rem;
        margin-bottom: 2rem;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 1.5rem;
        margin-bottom: 1.5rem;
    }

    .stat-card {
        text-align: center;
        padding: 1rem;
        background: #f8fafc;
        border-radius: 8px;
        border: 1px solid #e2e8f0;
    }

    .stat-number {
        font-size: 1.5rem;
        font-weight: 700;
        color: #1e293b;
        display: block;
    }

    .stat-label {
        font-size: 0.75rem;
        color: #64748b;
        margin-top: 0.25rem;
    }

    .filters {
        display: flex;
        gap: 1rem;
        align-items: center;
    }

    .filter-select {
        padding: 0.5rem 1rem;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        font-size: 0.875rem;
        background: white;
    }

    /* Projects Grid */
    .projects-grid {
        display: grid;
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .project-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        padding: 1.5rem;
        transition: all 0.3s ease;
        border: 1px solid #e2e8f0;
    }

    .project-card:hover {
        box-shadow: 0 10px 25px -3px rgba(0, 0, 0, 0.1);
        transform: translateY(-2px);
    }

    .project-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 1rem;
    }

    .project-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: #1e293b;
        margin: 0 0 0.5rem 0;
        line-height: 1.4;
    }

    .project-meta {
        display: flex;
        gap: 1rem;
        font-size: 0.75rem;
        color: #64748b;
        margin-bottom: 1rem;
    }

    .project-status {
        display: inline-flex;
        align-items: center;
        gap: 0.25rem;
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 500;
        margin-left: auto;
    }

    .status-draft {
        background: #f3f4f6;
        color: #6b7280;
    }

    .status-open {
        background: #dcfce7;
        color: #16a34a;
    }

    .status-in_progress {
        background: #dbeafe;
        color: #2563eb;
    }

    .status-completed {
        background: #f0f9ff;
        color: #0284c7;
    }

    .status-cancelled {
        background: #fee2e2;
        color: #dc2626;
    }

    .project-description {
        color: #4b5563;
        font-size: 0.875rem;
        line-height: 1.5;
        margin-bottom: 1rem;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .project-details {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
        margin-bottom: 1rem;
    }

    .detail-item {
        display: flex;
        flex-direction: column;
    }

    .detail-label {
        font-size: 0.75rem;
        color: #6b7280;
        font-weight: 500;
        margin-bottom: 0.25rem;
    }

    .detail-value {
        font-size: 0.875rem;
        color: #374151;
        font-weight: 600;
    }

    .project-skills {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        margin-bottom: 1rem;
    }

    .skill-tag {
        background: #eff6ff;
        color: #2563eb;
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 500;
    }

    .project-actions {
        display: flex;
        gap: 0.75rem;
        align-items: center;
        padding-top: 1rem;
        border-top: 1px solid #f3f4f6;
    }

    .btn-edit {
        background: #3b82f6;
        color: white;
    }

    .btn-edit:hover {
        background: #2563eb;
    }

    .btn-delete {
        background: #ef4444;
        color: white;
    }

    .btn-delete:hover {
        background: #dc2626;
    }

    .btn-view {
        background: #f1f5f9;
        color: #64748b;
        border: 1px solid #e2e8f0;
    }

    .btn-view:hover {
        background: #e2e8f0;
        color: #475569;
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }

    .empty-icon {
        font-size: 4rem;
        color: #d1d5db;
        margin-bottom: 1rem;
    }

    .empty-title {
        font-size: 1.5rem;
        font-weight: 600;
        color: #374151;
        margin-bottom: 0.5rem;
    }

    .empty-text {
        color: #6b7280;
        margin-bottom: 2rem;
        line-height: 1.6;
    }

    /* Success/Error Messages */
    .alert {
        padding: 1rem;
        border-radius: 8px;
        margin-bottom: 1.5rem;
        font-size: 0.875rem;
    }

    .alert-success {
        background: #dcfce7;
        border: 1px solid #bbf7d0;
        color: #15803d;
    }

    .alert-error {
        background: #fef2f2;
        border: 1px solid #fecaca;
        color: #dc2626;
    }

    /* Pagination */
    .pagination-wrapper {
        display: flex;
        justify-content: center;
        margin-top: 2rem;
    }

    @media (max-width: 768px) {
        .page-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 1rem;
        }

        .header-actions {
            width: 100%;
            justify-content: stretch;
        }

        .filters {
            flex-direction: column;
            align-items: stretch;
            gap: 0.5rem;
        }

        .project-details {
            grid-template-columns: 1fr;
        }

        .project-actions {
            flex-wrap: wrap;
        }

        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }
</style>

<!-- Category Navigation -->
<div class="nav-container">
    <nav class="nav">
        <ul class="nav-list">
            <li class="nav-item"><a href="/popular" class="nav-link">Pekerjaan Populer</a></li>
            <li class="nav-item"><a href="/grafis" class="nav-link">Grafis & Desain</a></li>
            <li class="nav-item"><a href="/dokumen" class="nav-link">Dokumen & PPT</a></li>
            <li class="nav-item"><a href="#" class="nav-link">Web & App</a></li>
            <li class="nav-item"><a href="#" class="nav-link">Video Editing</a></li>
            <li class="nav-item"><a href="#" class="nav-link">Animasi & Motion Graphic</a></li>
            <li class="nav-item"><a href="#" class="nav-link">Data & Analisis</a></li>
        </ul>
    </nav>
</div>

<!-- Main Content -->
<div class="main-container">
    <!-- Page Header -->
    <div class="page-header">
        <div>
            <h1 class="page-title">Proyek Saya</h1>
            <p class="page-subtitle">Kelola semua proyek yang sudah Anda posting</p>
        </div>
        <div class="header-actions">
            <a href="{{ route('posting.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Posting Proyek Baru
            </a>
        </div>
    </div>

    <!-- Success/Error Messages -->
    @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-error">
            <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
        </div>
    @endif

    <!-- Stats & Filters -->
    <div class="stats-filters">
        <div class="stats-grid">
            <div class="stat-card">
                <span class="stat-number">{{ $projects->where('status', 'open')->count() }}</span>
                <span class="stat-label">Proyek Aktif</span>
            </div>
            <div class="stat-card">
                <span class="stat-number">{{ $projects->where('status', 'draft')->count() }}</span>
                <span class="stat-label">Draft</span>
            </div>
            <div class="stat-card">
                <span class="stat-number">{{ $projects->where('status', 'completed')->count() }}</span>
                <span class="stat-label">Selesai</span>
            </div>
            <div class="stat-card">
                <span class="stat-number">{{ $projects->total() }}</span>
                <span class="stat-label">Total Proyek</span>
            </div>
        </div>

        <div class="filters">
            <label style="font-size: 0.875rem; color: #374151; font-weight: 500;">Filter:</label>
            <select class="filter-select" onchange="filterProjects(this.value)">
                <option value="all">Semua Proyek</option>
                <option value="draft">Draft</option>
                <option value="open">Terbuka</option>
                <option value="in_progress">Sedang Berlangsung</option>
                <option value="completed">Selesai</option>
                <option value="cancelled">Dibatalkan</option>
            </select>
            <select class="filter-select" onchange="sortProjects(this.value)">
                <option value="newest">Terbaru</option>
                <option value="oldest">Terlama</option>
                <option value="title">Judul (A-Z)</option>
                <option value="budget">Budget</option>
            </select>
        </div>
    </div>

    <!-- Projects Grid -->
    @if($projects->count() > 0)
        <div class="projects-grid">
            @foreach($projects as $project)
                <div class="project-card" data-status="{{ $project->status }}">
                    <div class="project-header">
                        <div>
                            <h3 class="project-title">{{ $project->title }}</h3>
                            <div class="project-meta">
                                <span><i class="fas fa-calendar-alt"></i> {{ $project->created_at->diffForHumans() }}</span>
                                <span><i class="fas fa-folder"></i> {{ ucfirst(str_replace('-', ' ', $project->category)) }}</span>
                                @if($project->deadline)
                                    <span><i class="fas fa-clock"></i> Deadline: {{ $project->deadline->format('d M Y') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="project-status status-{{ $project->status }}">
                            @switch($project->status)
                                @case('draft')
                                    <i class="fas fa-file-alt"></i> Draft
                                    @break
                                @case('open')
                                    <i class="fas fa-eye"></i> Terbuka
                                    @break
                                @case('in_progress')
                                    <i class="fas fa-spinner"></i> Berlangsung
                                    @break
                                @case('completed')
                                    <i class="fas fa-check-circle"></i> Selesai
                                    @break
                                @case('cancelled')
                                    <i class="fas fa-times-circle"></i> Dibatalkan
                                    @break
                                @default
                                    {{ $project->status }}
                            @endswitch
                        </div>
                    </div>

                    <p class="project-description">{{ $project->description }}</p>

                    <div class="project-details">
                        <div class="detail-item">
                            <span class="detail-label">Budget</span>
                            <span class="detail-value">{{ $project->formatted_budget }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Timeline</span>
                            <span class="detail-value">{{ $project->timeline_text }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Level</span>
                            <span class="detail-value">{{ ucfirst($project->experience_level) }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Urgensi</span>
                            <span class="detail-value">{{ $project->urgency_text }}</span>
                        </div>
                    </div>

                    @if($project->skills_required && count($project->skills_required) > 0)
                        <div class="project-skills">
                            @foreach(array_slice($project->skills_required, 0, 5) as $skill)
                                <span class="skill-tag">{{ $skill }}</span>
                            @endforeach
                            @if(count($project->skills_required) > 5)
                                <span class="skill-tag">+{{ count($project->skills_required) - 5 }} lainnya</span>
                            @endif
                        </div>
                    @endif

                    <div class="project-actions">
                        <a href="{{ route('projects.edit', $project) }}" class="btn btn-sm btn-edit">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        
                        <form method="POST" action="{{ route('projects.destroy', $project) }}" 
                              style="display: inline;" 
                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus proyek {{ $project->title }}? Tindakan ini tidak dapat dibatalkan.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-delete">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        </form>

                        @if($project->status !== 'draft')
                            <a href="#" class="btn btn-sm btn-view">
                                <i class="fas fa-eye"></i> Lihat Proposal
                            </a>
                        @endif

                        <div style="margin-left: auto; font-size: 0.75rem; color: #6b7280;">
                            @if($project->status === 'draft')
                                <i class="fas fa-edit"></i> Belum dipublish
                            @else
                                <i class="fas fa-calendar"></i> Dipublish {{ $project->posted_at->diffForHumans() }}
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="pagination-wrapper">
            {{ $projects->links() }}
        </div>
    @else
        <!-- Empty State -->
        <div class="empty-state">
            <div class="empty-icon">
                <i class="fas fa-folder-open"></i>
            </div>
            <h3 class="empty-title">Belum Ada Proyek</h3>
            <p class="empty-text">
                Anda belum memposting proyek apapun. Mulai posting proyek pertama Anda dan temukan freelancer terbaik untuk membantu bisnis Anda.
            </p>
            <a href="{{ route('posting.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Posting Proyek Pertama
            </a>
        </div>
    @endif
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Filter projects by status
    window.filterProjects = function(status) {
        const cards = document.querySelectorAll('.project-card');
        
        cards.forEach(card => {
            if (status === 'all' || card.dataset.status === status) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    };

    // Sort projects
    window.sortProjects = function(sortBy) {
        const grid = document.querySelector('.projects-grid');
        const cards = Array.from(document.querySelectorAll('.project-card'));
        
        if (!grid || cards.length === 0) return;

        cards.sort((a, b) => {
            switch(sortBy) {
                case 'newest':
                    // Default order (newest first)
                    return 0;
                case 'oldest':
                    // Reverse current order
                    return 0;
                case 'title':
                    const titleA = a.querySelector('.project-title').textContent.toLowerCase();
                    const titleB = b.querySelector('.project-title').textContent.toLowerCase();
                    return titleA.localeCompare(titleB);
                case 'budget':
                    // This would require more complex logic to parse budget values
                    return 0;
                default:
                    return 0;
            }
        });

        // Re-append sorted cards
        if (sortBy === 'title') {
            cards.forEach(card => grid.appendChild(card));
        }
    };
});
</script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

@endsection