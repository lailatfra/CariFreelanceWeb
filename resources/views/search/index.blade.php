@extends('client.layout.client-layout')
@section('title', 'Search Results - CariFreelance')
@section('content')

<style>
    /* Reuse styles from web-development */
    .job-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 20px;
        margin-bottom: 40px;
    }

    .job-card {
        background: white;
        border: 1px solid #e9ecef;
        border-radius: 10px;
        overflow: hidden;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .job-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    .job-card-content {
        padding: 20px;
    }

    .freelancer-info {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 15px;
    }

    .freelancer-avatar {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        object-fit: cover;
    }

    .freelancer-name {
        font-weight: 600;
        font-size: 14px;
        color: #333;
    }

    .response-time {
        font-size: 12px;
        color: #999;
    }

    .job-image {
        width: 100%;
        height: 140px;
        object-fit: cover;
        border-radius: 6px;
        margin-bottom: 15px;
    }

    .job-title {
        font-weight: 600;
        font-size: 14px;
        color: #333;
        margin-bottom: 8px;
        line-height: 1.4;
    }

    .job-stats {
        font-size: 12px;
        color: #666;
        margin-bottom: 10px;
    }

    .rating {
        color: #ffc107;
    }

    .job-badges {
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
        margin-bottom: 15px;
    }

    .badge {
        font-size: 11px;
        padding: 4px 8px;
        border-radius: 12px;
        font-weight: 600;
    }

    .badge-urgent {
        background: #ffe6e6;
        color: #dc3545;
    }

    .badge-expert {
        background: #cce5ff;
        color: #0066cc;
    }

    .badge-flexible {
        background: #fff3cd;
        color: #856404;
    }

    .badge-rehire {
        background: #d1ecf1;
        color: #0c5460;
    }

    .job-price {
        text-align: right;
        color: #1DA1F2;
        font-weight: 700;
        font-size: 14px;
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: #666;
        background: white;
        border-radius: 10px;
        margin-top: 20px;
    }

    .empty-state i {
        font-size: 48px;
        margin-bottom: 16px;
        opacity: 0.5;
        color: #1DA1F2;
    }

    .empty-state h3 {
        margin-bottom: 8px;
        font-size: 1.3rem;
        color: #333;
    }

    .sidebar-link {
        text-decoration: none;
        color: #333;
        display: block;
        padding: 12px 20px;
        border-radius: 8px;
        transition: all 0.3s ease;
        margin-bottom: 5px;
    }

    .sidebar-link:hover {
        background: #f8f9fa;
        color: #1DA1F2;
    }

    .sidebar-link.active {
        background: #1DA1F2;
        color: white;
    }

    .loading-spinner {
        text-align: center;
        padding: 60px 20px;
        color: #64748b;
    }
    
    .loading-spinner i {
        color: #1DA1F2;
        margin-bottom: 15px;
    }
    
    .loading-spinner p {
        font-size: 1rem;
        font-weight: 500;
    }
    
    .empty-state .btn {
        padding: 10px 24px;
        border-radius: 8px;
        font-weight: 600;
        border: none;
        background: #1DA1F2;
        color: white;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .empty-state .btn:hover {
        background: #0d7ac9;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(29, 161, 242, 0.3);
    }

    .search-info {
        background: #f8fafc;
        padding: 0.75rem 1rem;
        border-radius: 8px;
        margin-bottom: 1rem;
        color: #64748b;
        font-size: 0.9rem;
    }

    .search-input:disabled {
        background-color: #f8f9fa;
        cursor: not-allowed;
        opacity: 0.6;
    }

    .search-input.disabled-state {
        background-color: #e9ecef;
        color: #6c757d;
        cursor: not-allowed;
    }

    /* Override header search to be active on this page */
    body .search-input {
        cursor: text !important;
        pointer-events: all !important;
    }
</style>

<div class="container-fluid mt-4">
    <div class="row mt-4">

        {{-- SIDEBAR --}}
        <div class="col-md-3">
            <div class="bg-white rounded p-3 shadow-sm">
                <h6 class="mb-3">Filter Pencarian</h6>

                <a href="javascript:void(0)" onclick="changeCategories('project')"
                   class="sidebar-link {{ $category == 'project' ? 'active' : '' }}" id="tab-project">
                    <i class="fas fa-briefcase me-2"></i> Proyek
                </a>

                <a href="javascript:void(0)" onclick="changeCategories('kategori')"
                   class="sidebar-link {{ $category == 'kategori' ? 'active' : '' }}" id="tab-kategori">
                    <i class="fas fa-tags me-2"></i> Kategori
                </a>
            </div>
        </div>

        {{-- KANAN / OUTPUT SEARCH --}}
        <div class="col-md-9">
            <div id="loading-spinner" class="loading-spinner" style="display:none;">
                <i class="fas fa-spinner fa-spin fa-2x"></i>
                <p>Mencari proyek...</p>
            </div>

            {{-- SEMUA HASIL (proyek atau kategori) akan di-render ke sini oleh JavaScript --}}
            <div id="result-area">
                <!-- Konten awal akan di-render oleh JS pada DOMContentLoaded -->
            </div>

            <script>
                window.initialProjects = @json($projects ?? collect());
                window.initialCategory  = '{{ $category }}';
                window.allProjects = []; // Menyimpan semua project untuk filter client-side
            </script>

        </div>

    </div>
</div>

<script>
let searchTimer = null;
let currentCategory = '{{ $category }}';

// Data semua kategori
const allCategoriesData = [
    {
        title: "Pekerjaan Popular",
        subtitle: "Kategori pekerjaan yang paling banyak dicari dan diminati oleh klien kami",
        sidebarTitle: "Pekerjaan Popular",
        sidebarItems: [
            { name: "Website Development", route: "popular.category", params: { subcategory: "website-development" } },
            { name: "Mobile App Development", route: "popular.category", params: { subcategory: "mobile-app-development" } },
            { name: "Logo Design", route: "popular.category", params: { subcategory: "logo-design" } },
            { name: "Video Editing", route: "popular.category", params: { subcategory: "video-editing" } }
        ],
        categories: [
            {
                title: "Website Development",
                description: "Jasa pembuatan website profesional",
                image: "https://images.unsplash.com/photo-1461749280684-dccba630e2f6?w=500&h=300&fit=crop",
                route: "popular.category",
                params: { subcategory: "website-development" }
            },
            {
                title: "Mobile App Development",
                description: "Aplikasi Android dan iOS",
                image: "https://images.unsplash.com/photo-1512941937669-90a1b58e7e9c?w=500&h=300&fit=crop",
                route: "popular.category",
                params: { subcategory: "mobile-app-development" }
            },
            {
                title: "Logo Design",
                description: "Desain logo kreatif dan profesional",
                image: "https://images.unsplash.com/photo-1561070791-2526d30994b5?w=500&h=300&fit=crop",
                route: "popular.category",
                params: { subcategory: "logo-design" }
            },
            {
                title: "Video Editing",
                description: "Edit video berkualitas tinggi",
                image: "https://images.unsplash.com/photo-1574717024653-61fd2cf4d44d?w=500&h=300&fit=crop",
                route: "popular.category",
                params: { subcategory: "video-editing" }
            }
        ]
    },
    {
        title: "Grafis & Desain",
        subtitle: "Solusi desain grafis profesional untuk kebutuhan bisnis dan personal Anda",
        sidebarTitle: "Grafis & Desain",
        sidebarItems: [
            { name: "Logo Design", route: "grafis.category", params: { subcategory: "logo-design" } },
            { name: "Brand Identity", route: "grafis.category", params: { subcategory: "brand-identity" } },
            { name: "Packaging Design", route: "grafis.category", params: { subcategory: "packaging-design" } },
            { name: "Ilustrasi Gambar", route: "grafis.category", params: { subcategory: "ilustrasi-gambar" } },
            { name: "Stiker Design", route: "grafis.category", params: { subcategory: "stiker-design" } }
        ],
        categories: [
            {
                title: "Logo Design",
                description: "Desain logo profesional dan berkesan",
                image: "https://images.unsplash.com/photo-1561070791-2526d30994b5?w=500&h=300&fit=crop",
                route: "grafis.category",
                params: { subcategory: "logo-design" }
            },
            {
                title: "Brand Identity",
                description: "Identitas visual yang konsisten",
                image: "https://images.unsplash.com/photo-1558655146-9f40138edfeb?w=500&h=300&fit=crop",
                route: "grafis.category",
                params: { subcategory: "brand-identity" }
            },
            {
                title: "Packaging Design",
                description: "Desain kemasan yang menarik",
                image: "https://images.unsplash.com/photo-1586953208448-b95a79798f07?w=500&h=300&fit=crop",
                route: "grafis.category",
                params: { subcategory: "packaging-design" }
            },
            {
                title: "Ilustrasi Gambar",
                description: "Ilustrasi custom dan artwork",
                image: "https://images.unsplash.com/photo-1513475382585-d06e58bcb0e0?w=500&h=300&fit=crop",
                route: "grafis.category",
                params: { subcategory: "ilustrasi-gambar" }
            }
        ]
    },
    {
        title: "Dokumen & PPT",
        subtitle: "Solusi lengkap untuk kebutuhan dokumen bisnis dan presentasi profesional Anda",
        sidebarTitle: "Dokumen & PPT",
        sidebarItems: [
            { name: "Desain Presentasi", route: "dokumen.category", params: { subcategory: "desain-presentasi" } },
            { name: "Format Dokumen", route: "dokumen.category", params: { subcategory: "format-dokumen" } }
        ],
        categories: [
            {
                title: "Desain Presentasi",
                description: "Slide presentasi yang menarik dan profesional",
                image: "https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=500&h=300&fit=crop",
                route: "dokumen.category",
                params: { subcategory: "desain-presentasi" }
            },
            {
                title: "Format Dokumen",
                description: "Dokumen rapi, konsisten, dan siap digunakan secara profesional",
                image: "https://images.unsplash.com/photo-1586281380349-632531db7ed4?w=500&h=300&fit=crop",
                route: "dokumen.category",
                params: { subcategory: "format-dokumen" }
            }
        ]
    },
    {
        title: "Video Editing",
        subtitle: "Layanan editing video profesional dan color grading untuk menghasilkan konten berkualitas tinggi",
        sidebarTitle: "Video Editing",
        sidebarItems: [
            { name: "Video Editing", route: "video.category", params: { subcategory: "video-editing" } },
            { name: "Color Grading", route: "video.category", params: { subcategory: "color-grading" } }
        ],
        categories: [
            {
                title: "Video Editing",
                description: "Editing video profesional untuk semua jenis konten",
                image: "https://images.unsplash.com/photo-1574717024653-61fd2cf4d44d?w=500&h=300&fit=crop",
                route: "video.category",
                params: { subcategory: "video-editing" }
            },
            {
                title: "Color Grading",
                description: "Koreksi warna dan grading untuk tampilan sinematik",
                image: "https://images.unsplash.com/photo-1478720568477-152d9b164e26?w=500&h=300&fit=crop",
                route: "video.category",
                params: { subcategory: "color-grading" }
            }
        ]
    },
    {
        title: "Web & App Services",
        subtitle: "Layanan pengembangan website dan aplikasi yang profesional untuk berbagai kebutuhan bisnis Anda",
        sidebarTitle: "Web & App Services",
        sidebarItems: [
            { name: "Website Development", route: "web-app.category", params: { subcategory: "website-development" } },
            { name: "E-commerce Development", route: "web-app.category", params: { subcategory: "ecommerce-development" } },
            { name: "Mobile App Development", route: "web-app.category", params: { subcategory: "mobile-app-development" } },
            { name: "UI/UX Design", route: "web-app.category", params: { subcategory: "ui-ux-design" } }
        ],
        categories: [
            {
                title: "Website Development",
                description: "Pembuatan website profesional dan modern",
                image: "https://images.unsplash.com/photo-1547658719-da2b51169166?w=500&h=300&fit=crop",
                route: "web-app.category",
                params: { subcategory: "website-development" }
            },
            {
                title: "E-commerce Development",
                description: "Toko online dan marketplace",
                image: "https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?w=500&h=300&fit=crop",
                route: "web-app.category",
                params: { subcategory: "ecommerce-development" }
            },
            {
                title: "Mobile App Development",
                description: "Aplikasi Android dan iOS",
                image: "https://images.unsplash.com/photo-1512941937669-90a1b58e7e9c?w=500&h=300&fit=crop",
                route: "web-app.category",
                params: { subcategory: "mobile-app-development" }
            },
            {
                title: "UI/UX Design",
                description: "Desain antarmuka pengguna yang menarik",
                image: "https://images.unsplash.com/photo-1559526324-4b87b5e36e44?w=500&h=300&fit=crop",
                route: "web-app.category",
                params: { subcategory: "ui-ux-design" }
            }
        ]
    }
];

// Fungsi untuk generate URL berdasarkan route name dan parameters
function generateRouteUrl(routeName, params = {}) {
    const routeTemplates = {
        'popular.category': '/popular/{subcategory}',
        'grafis.category': '/grafis/{subcategory}',
        'dokumen.category': '/dokumen/{subcategory}',
        'video.category': '/video/{subcategory}',
        'web-app.category': '/web-app/{subcategory}'
    };
    
    let url = routeTemplates[routeName] || '#';
    
    // Replace parameters in URL
    Object.keys(params).forEach(key => {
        url = url.replace(`{${key}}`, params[key]);
    });
    
    return url;
}

document.addEventListener('DOMContentLoaded', function() {
    // Initialize based on current category
    if (currentCategory === 'kategori') {
        renderAllCategories();
    } else {
        // Load initial projects for 'project' category
        const urlParams = new URLSearchParams(window.location.search);
        const keyword = urlParams.get('q') || '';
        
        // SELALU gunakan AJAX search untuk memastikan data konsisten
        if (keyword) {
            // Jika ada keyword, lakukan pencarian
            performLiveSearch(keyword);
        } else {
            // Jika tidak ada keyword, load semua project via AJAX
            performLiveSearch('');
        }
    }
    
    // Setup header search - HANYA LIVE SEARCH, TIDAK REDIRECT
    setupHeaderSearch();
    updateURL();
});

function setupHeaderSearch() {
    const headerSearchDesktop = document.getElementById('live-search-desktop');
    const headerSearchMobile = document.getElementById('live-search-mobile');
    
    // Prevent form submission - HANYA LIVE SEARCH
    const searchFormDesktop = document.querySelector('form[action*="search"]');
    const searchFormMobile = document.querySelector('.mobile-search-form');
    
    if (searchFormDesktop) {
        searchFormDesktop.addEventListener('submit', function(e) {
            e.preventDefault();
            const keyword = headerSearchDesktop ? headerSearchDesktop.value.trim() : '';
            handleLiveSearch(keyword);
        });
    }
    
    if (searchFormMobile) {
        searchFormMobile.addEventListener('submit', function(e) {
            e.preventDefault();
            const keyword = headerSearchMobile ? headerSearchMobile.value.trim() : '';
            handleLiveSearch(keyword);
        });
    }
    
    if (headerSearchDesktop) {
        headerSearchDesktop.removeAttribute('readonly');
        headerSearchDesktop.style.cursor = 'text';
        
        const urlParams = new URLSearchParams(window.location.search);
        const keyword = urlParams.get('q') || '';
        headerSearchDesktop.value = keyword;
        
        // HANYA LIVE SEARCH, tidak ada redirect
        headerSearchDesktop.addEventListener('input', function() {
            handleLiveSearch(this.value);
        });
        
        // Enter key juga hanya trigger live search
        headerSearchDesktop.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                handleLiveSearch(this.value);
            }
        });

        // Focus dan select text agar mudah diinput - TIDAK REDIRECT
        headerSearchDesktop.addEventListener('click', function() {
            this.select();
        });
    }
    
    if (headerSearchMobile) {
        headerSearchMobile.removeAttribute('readonly');
        headerSearchMobile.style.cursor = 'text';
        
        const urlParams = new URLSearchParams(window.location.search);
        const keyword = urlParams.get('q') || '';
        headerSearchMobile.value = keyword;
        
        // HANYA LIVE SEARCH, tidak ada redirect
        headerSearchMobile.addEventListener('input', function() {
            handleLiveSearch(this.value);
        });
        
        // Enter key juga hanya trigger live search
        headerSearchMobile.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                handleLiveSearch(this.value);
            }
        });

        // Focus dan select text agar mudah diinput - TIDAK REDIRECT
        headerSearchMobile.addEventListener('click', function() {
            this.select();
        });
    }
}

function handleLiveSearch(keyword) {
    clearTimeout(searchTimer);
    
    const trimmedKeyword = keyword.trim();
    
    searchTimer = setTimeout(() => {
        performLiveSearch(trimmedKeyword);
    }, 300);
}

function performLiveSearch(keyword) {
    updateURL(keyword);
    
    if (currentCategory === 'project') {
        // Search projects via AJAX - LIVE SEARCH (baik dengan keyword maupun kosong)
        showLoadingSpinner();
        fetch(`{{ route('searchbar-ajax') }}?q=${encodeURIComponent(keyword)}&category=${currentCategory}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                hideLoadingSpinner();
                renderProjects(data.projects);
                updateSearchInfo(data.count);
                
                // Simpan project untuk filter client-side nanti
                window.allProjects = data.projects || [];
            })
            .catch(error => {
                hideLoadingSpinner();
                console.error('Error:', error);
                showError();
            });
    } else {
        // Search categories - frontend filtering - LIVE SEARCH
        if (!keyword.trim()) {
            renderAllCategories();
            updateSearchInfo(allCategoriesData.reduce((total, cat) => total + cat.categories.length, 0));
        } else {
            renderFilteredCategories(keyword);
            const filteredCount = filterCategories(keyword).reduce((total, cat) => total + cat.categories.length, 0);
            updateSearchInfo(filteredCount);
        }
    }
}

function loadAllProjects() {
    showLoadingSpinner();
    // Gunakan endpoint yang sama dengan search, tapi dengan parameter kosong
    fetch(`{{ route('searchbar-ajax') }}?q=&category=project`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            hideLoadingSpinner();
            window.allProjects = data.projects || [];
            renderProjects(window.allProjects);
            updateSearchInfo(data.count);
        })
        .catch(error => {
            hideLoadingSpinner();
            console.error('Error:', error);
            showError();
        });
}

function filterCategories(keyword = '') {
    if (!keyword.trim()) {
        return allCategoriesData;
    }
    
    const lowerKeyword = keyword.toLowerCase();
    const filtered = [];
    
    allCategoriesData.forEach(category => {
        const filteredSubcategories = category.categories.filter(subcat => 
            subcat.title.toLowerCase().includes(lowerKeyword) ||
            subcat.description.toLowerCase().includes(lowerKeyword) ||
            category.title.toLowerCase().includes(lowerKeyword)
        );
        
        if (filteredSubcategories.length > 0) {
            filtered.push({
                ...category,
                categories: filteredSubcategories
            });
        }
    });
    
    return filtered;
}

function renderAllCategories() {
    const resultArea = document.getElementById('result-area');
    
    let html = `
        <div class="categories-content-area">
            <div class="categories-content-header">
                <h2 class="categories-content-title">Semua Kategori</h2>
                <p class="categories-content-subtitle">Jelajahi berbagai kategori pekerjaan yang tersedia</p>
            </div>
    `;
    
    // Render semua kategori dengan struktur yang sama
    allCategoriesData.forEach(category => {
        html += `
            <div class="category-section">
                <h3 class="category-section-title">${category.title}</h3>
                <p class="category-section-subtitle">${category.subtitle}</p>
                <div class="categories-grid">
        `;
        
        category.categories.forEach(subcat => {
            const url = generateRouteUrl(subcat.route, subcat.params);
            html += `
                <div class="category-card">
                    <a href="${url}" class="category-link" data-route="${subcat.route}">
                        <img src="${subcat.image}" alt="${subcat.title}" class="category-image">
                        <div class="category-overlay">
                            <h3 class="category-title">${subcat.title}</h3>
                            <p class="category-description">${subcat.description}</p>
                        </div>
                    </a>
                </div>
            `;
        });
        
        html += `
                </div>
            </div>
        `;
    });
    
    html += `</div>`;
    resultArea.innerHTML = html;
    setupCategoriesNavigation();
}

function renderFilteredCategories(keyword) {
    const filteredCategories = filterCategories(keyword);
    const resultArea = document.getElementById('result-area');
    
    if (filteredCategories.length === 0) {
        resultArea.innerHTML = `
            <div class="empty-state" style="grid-column: 1 / -1;">
                <i class="fas fa-search"></i>
                <h3>Tidak ada kategori ditemukan</h3>
                <p>Coba gunakan kata kunci lain seperti "web development", "logo design", dll</p>
            </div>
        `;
        return;
    }
    
    let html = `
        <div class="categories-content-area">
            <div class="categories-content-header">
                <h2 class="categories-content-title">Hasil Pencarian: "${keyword}"</h2>
                <p class="categories-content-subtitle">Ditemukan ${filteredCategories.reduce((total, cat) => total + cat.categories.length, 0)} kategori</p>
            </div>
    `;
    
    filteredCategories.forEach(category => {
        html += `
            <div class="category-section">
                <h3 class="category-section-title">${category.title}</h3>
                <div class="categories-grid">
        `;
        
        category.categories.forEach(subcat => {
            const url = generateRouteUrl(subcat.route, subcat.params);
            html += `
                <div class="category-card">
                    <a href="${url}" class="category-link" data-route="${subcat.route}">
                        <img src="${subcat.image}" alt="${subcat.title}" class="category-image">
                        <div class="category-overlay">
                            <h3 class="category-title">${subcat.title}</h3>
                            <p class="category-description">${subcat.description}</p>
                        </div>
                    </a>
                </div>
            `;
        });
        
        html += `
                </div>
            </div>
        `;
    });
    
    html += `</div>`;
    resultArea.innerHTML = html;
}

function renderProjects(projects) {
    const resultArea = document.getElementById('result-area');
    
    if (!projects || projects.length === 0) {
        resultArea.innerHTML = `
            <div class="empty-state" style="grid-column: 1 / -1;">
                <i class="fas fa-search"></i>
                <h3>Tidak ada proyek ditemukan</h3>
                <p>Coba gunakan kata kunci lain</p>
            </div>`;
        return;
    }
    
    let html = '<div class="job-grid">';
    
    projects.forEach(project => {
        html += renderProjectCard(project);
    });
    
    html += '</div>';
    resultArea.innerHTML = html;
}

function renderProjectCard(project) {
    let mediaHtml = '';
    
    // Cek main_attachment terlebih dahulu - SAMA PERSIS dengan output search
    if (project.main_attachment) {
        const att = project.main_attachment;
        if (att.file_type === 'image') {
            mediaHtml = `<img src="${att.url}" alt="${project.title}" class="job-image" onerror="this.style.display='none'">`;
        } else if (att.file_type === 'video') {
            mediaHtml = `
                <div style="position: relative; width: 100%; height: 140px; border-radius: 6px; overflow: hidden; margin-bottom: 15px; background: #f8f9fa;">
                    <video class="job-image" style="width: 100%; height: 100%; object-fit: cover;" muted>
                        <source src="${att.url}" type="${att.mime_type || 'video/mp4'}">
                    </video>
                    <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background: rgba(0,0,0,0.7); border-radius: 50%; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; color: white;">
                        <i class="fas fa-play" style="font-size: 14px; margin-left: 2px;"></i>
                    </div>
                </div>`;
        } else if (att.file_type === 'document') {
            mediaHtml = `
                <div style="position: relative; width: 100%; height: 140px; background: #f8f9fa; border-radius: 6px; margin-bottom: 15px; display: flex; flex-direction: column; align-items: center; justify-content: center; border: 2px dashed #e1e8ed;">
                    <i class="fas fa-file" style="font-size: 32px; color: #6c757d; margin-bottom: 8px;"></i>
                    <div style="font-size: 11px; color: #6c757d; font-weight: 600;">
                        ${(att.extension || 'FILE').toUpperCase()} DOCUMENT
                    </div>
                </div>`;
        }
    } else if (project.image_url) {
        // Gunakan image_url jika ada - SAMA dengan output search
        mediaHtml = `<img src="${project.image_url}" alt="${project.title}" class="job-image" onerror="this.style.display='none'">`;
    } else {
        // Default image jika tidak ada media - SAMA dengan output search
        mediaHtml = `
            <div style="width: 100%; height: 140px; background: #f8f9fa; border-radius: 6px; margin-bottom: 15px; display: flex; align-items: center; justify-content: center; color: #6c757d;">
                <i class="fas fa-image" style="font-size: 32px;"></i>
            </div>`;
    }
    
    let badgesHtml = '';
    
    // Badge urgency - SAMA PERSIS dengan output search
    if (project.urgency === 'urgent' || project.urgency === 'asap') {
        badgesHtml += `<span class="badge badge-urgent">${project.urgency === 'asap' ? 'Sangat Mendesak' : 'Segera'}</span>`;
    }
    
    // Badge budget type - SAMA PERSIS dengan output search
    const budgetLabel = project.budget_type === 'fixed' ? 'Fixed Budget' : 
                       (project.budget_type === 'hourly' ? 'Per Jam' : 'Budget Range');
    badgesHtml += `<span class="badge badge-flexible">${budgetLabel}</span>`;
    
    // Badge project type - SAMA PERSIS dengan output search
    if (project.project_type === 'ongoing') {
        badgesHtml += `<span class="badge badge-rehire">Berkelanjutan</span>`;
    }
    
    // Pastikan semua field ada default value - SAMA PERSIS dengan output search
    const userName = project.user?.name || project.user_name || 'Anonim';
    const userAvatar = project.user?.avatar || project.user_avatar || `https://ui-avatars.com/api/?name=${encodeURIComponent(userName)}&background=random`;
    const postedAt = project.posted_at || project.created_at || 'Baru saja';
    const experienceLevel = project.experience_level || 'entry';
    
    // Format budget - SAMA PERSIS dengan output search
    let formattedBudget = 'Rp 0';
    if (project.formatted_budget) {
        formattedBudget = project.formatted_budget;
    } else if (project.budget) {
        formattedBudget = `Rp ${Number(project.budget).toLocaleString('id-ID')}`;
    }
    
    // Rating info - SAMA PERSIS dengan output search
    let ratingHtml = '';
    if (project.rating) {
        ratingHtml = `<i class="fas fa-star rating"></i> ${project.rating}`;
    } else {
        ratingHtml = `<i class="fas fa-star rating"></i> Baru`;
    }
    
    return `
        <article class="job-card">
            <div class="job-card-content">
                <a href="/projects/${project.id}" style="text-decoration: none; color: inherit;">
                    <div class="freelancer-info">
                        <img src="${userAvatar}" alt="${userName}" class="freelancer-avatar" onerror="this.src='https://ui-avatars.com/api/?name=Anonim&background=random'">
                        <div>
                            <div class="freelancer-name">${userName}</div>
                            <div class="response-time">${postedAt}</div>
                        </div>
                    </div>
                    
                    ${mediaHtml}
                    
                    <h3 class="job-title">${project.title.length > 60 ? project.title.substring(0, 60) + '...' : project.title}</h3>
                    
                    <p class="job-stats">
                        ${ratingHtml}
                        • ${project.budget_type === 'fixed' ? 'Budget Tersedia' : 'Budget Fleksibel'}
                        • ${experienceLevel.charAt(0).toUpperCase() + experienceLevel.slice(1)}
                    </p>
                    
                    <div class="job-badges">
                        ${badgesHtml}
                    </div>
                    
                    <p class="job-price">
                        Mulai<br>${formattedBudget}
                    </p>
                </a>
            </div>
        </article>`;
}

function changeCategories(category) {
    currentCategory = category;
    
    document.querySelectorAll('.sidebar-link').forEach(link => {
        link.classList.remove('active');
    });
    document.getElementById(`tab-${category}`).classList.add('active');
    
    const headerSearch = document.getElementById('live-search-desktop') || document.getElementById('live-search-mobile');
    const currentKeyword = headerSearch ? headerSearch.value.trim() : '';
    
    // UPDATE URL TANPA REDIRECT - hanya ganti parameter category
    updateURL(currentKeyword);
    
    if (category === 'kategori') {
        if (!currentKeyword) {
            renderAllCategories();
            updateSearchInfo(allCategoriesData.reduce((total, cat) => total + cat.categories.length, 0));
        } else {
            renderFilteredCategories(currentKeyword);
            const filteredCount = filterCategories(currentKeyword).reduce((total, cat) => total + cat.categories.length, 0);
            updateSearchInfo(filteredCount);
        }
    } else {
        // SELALU gunakan AJAX search untuk project category
        performLiveSearch(currentKeyword || '');
    }
}

function updateURL(keyword = '') {
    const url = new URL(window.location);
    url.searchParams.set('category', currentCategory);
    
    if (keyword) {
        url.searchParams.set('q', keyword);
    } else {
        url.searchParams.delete('q');
    }
    
    // UPDATE URL TANPA RELOAD PAGE
    window.history.replaceState({}, '', url);
}

function updateSearchInfo(count) {
    // Anda bisa menambahkan elemen untuk menampilkan jumlah hasil jika diperlukan
    console.log(`Jumlah hasil: ${count}`);
}

function showLoadingSpinner() {
    document.getElementById('loading-spinner').style.display = 'block';
}

function hideLoadingSpinner() {
    document.getElementById('loading-spinner').style.display = 'none';
}

function showError() {
    const resultArea = document.getElementById('result-area');
    resultArea.innerHTML = `
        <div class="empty-state">
            <i class="fas fa-exclamation-triangle"></i>
            <h3>Terjadi Kesalahan</h3>
            <p>Silakan coba lagi</p>
        </div>`;
}

function setupCategoriesNavigation() {
    // Navigation items
    document.querySelectorAll('.categories-nav-item').forEach(item => {
        item.addEventListener('click', function() {
            document.querySelectorAll('.categories-nav-item').forEach(nav => nav.classList.remove('active'));
            this.classList.add('active');
            
            const categoryType = this.getAttribute('data-category');
            filterCategoriesByType(categoryType);
        });
    });

    // Category cards - Hanya untuk UI, tidak redirect
    document.addEventListener('click', function(e) {
        if (e.target.closest('.category-link')) {
            const route = e.target.closest('.category-link').getAttribute('data-route');
            console.log('Category clicked:', route);
            // Bisa ditambahkan logic untuk filter berdasarkan kategori jika diperlukan
        }
    });

    // Sidebar links
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('categories-sidebar-link')) {
            document.querySelectorAll('.categories-sidebar-link').forEach(link => {
                link.classList.remove('active');
            });
            e.target.classList.add('active');
            
            const route = e.target.getAttribute('data-route');
            filterCategoriesByRoute(route);
        }
    });
}

// Fungsi untuk filter kategori berdasarkan type
function filterCategoriesByType(categoryType) {
    const resultArea = document.getElementById('result-area');
    
    if (categoryType === 'all') {
        renderAllCategories();
        return;
    }
    
    const categoryMap = {
        'popular': 'Pekerjaan Popular',
        'grafis': 'Grafis & Desain',
        'dokumen': 'Dokumen & PPT',
        'web-app': 'Web & App Services',
        'video': 'Video Editing'
    };
    
    const categoryTitle = categoryMap[categoryType];
    const filteredCategory = allCategoriesData.find(cat => cat.title === categoryTitle);
    
    if (!filteredCategory) {
        renderAllCategories();
        return;
    }
    
    let html = `
        <div class="categories-content-area">
            <div class="categories-content-header">
                <h2 class="categories-content-title">${filteredCategory.title}</h2>
                <p class="categories-content-subtitle">${filteredCategory.subtitle}</p>
            </div>
            <div class="categories-grid">
    `;
    
    filteredCategory.categories.forEach(subcat => {
        const url = generateRouteUrl(subcat.route, subcat.params);
        html += `
            <div class="category-card">
                <a href="${url}" class="category-link" data-route="${subcat.route}">
                    <img src="${subcat.image}" alt="${subcat.title}" class="category-image">
                    <div class="category-overlay">
                        <h3 class="category-title">${subcat.title}</h3>
                        <p class="category-description">${subcat.description}</p>
                    </div>
                </a>
            </div>
        `;
    });
    
    html += `</div></div>`;
    resultArea.innerHTML = html;
}

// Fungsi untuk filter kategori berdasarkan route
function filterCategoriesByRoute(route) {
    const resultArea = document.getElementById('result-area');
    
    // Cari kategori yang sesuai dengan route
    for (const category of allCategoriesData) {
        const subcategory = category.categories.find(subcat => subcat.route === route);
        if (subcategory) {
            let html = `
                <div class="categories-content-area">
                    <div class="categories-content-header">
                        <h2 class="categories-content-title">${subcategory.title}</h2>
                        <p class="categories-content-subtitle">${subcategory.description}</p>
                    </div>
                    <div class="categories-grid">
                        <div class="category-card">
                            <a href="javascript:void(0)" class="category-link" data-route="${subcategory.route}">
                                <img src="${subcategory.image}" alt="${subcategory.title}" class="category-image">
                                <div class="category-overlay">
                                    <h3 class="category-title">${subcategory.title}</h3>
                                    <p class="category-description">${subcategory.description}</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            `;
            resultArea.innerHTML = html;
            return;
        }
    }
    
    // Jika tidak ditemukan, tampilkan semua
    renderAllCategories();
}
</script>

<style>
    /* Kategori Styles - Sama seperti halaman kategori */
    .categories-hero {
        background: 
            linear-gradient(135deg, rgba(29, 161, 242, 0.8) 0%, rgba(13, 122, 201, 0.8) 50%, rgba(29, 161, 242, 0.8) 100%),
            url('https://images.unsplash.com/photo-1522202176988-66273c2fd55f?w=1920&h=1080&fit=crop&crop=center') center/cover;
        min-height: 250px;
        display: flex;
        align-items: center;
        position: relative;
        overflow: hidden;
        margin: 0;
        padding: 0;
        width: 100%;
        border-radius: 15px;
        margin-bottom: 25px;
    }

    .categories-hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000"><defs><radialGradient id="a"><stop offset="0" stop-color="%23ffffff" stop-opacity="0.1"/><stop offset="1" stop-color="%23ffffff" stop-opacity="0"/></radialGradient></defs><circle cx="200" cy="200" r="100" fill="url(%23a)"/><circle cx="800" cy="300" r="150" fill="url(%23a)"/><circle cx="600" cy="600" r="80" fill="url(%23a)"/></svg>') no-repeat center/cover;
        animation: float 20s ease-in-out infinite;
    }

    .categories-hero-content {
        max-width: 100%;
        width: 100%;
        margin: 0;
        padding: 40px 20px;
        text-align: center;
        position: relative;
        z-index: 2;
    }

    .categories-hero h1 {
        font-size: 2.5rem;
        font-weight: 700;
        color: white;
        margin-bottom: 15px;
        animation: slideInDown 1s ease-out;
    }

    .categories-hero p {
        font-size: 1.1rem;
        color: rgba(255, 255, 255, 0.9);
        margin-bottom: 20px;
        animation: slideInUp 1s ease-out 0.3s both;
    }

    .categories-nav-container {
        background: white;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        border-radius: 15px;
        margin-bottom: 25px;
        overflow: hidden;
    }

    .categories-nav {
        max-width: 100%;
        margin: 0 auto;
        padding: 0 20px;
    }

    .categories-nav-list {
        display: flex;
        list-style: none;
        overflow-x: auto;
        padding: 4px 0;
        gap: 60px;
        scrollbar-width: none;
        -ms-overflow-style: none;
        align-items: center;
        justify-content: center;
        flex-wrap: nowrap;
    }

    .categories-nav-list::-webkit-scrollbar {
        display: none;
    }

    .categories-nav-item {
        white-space: nowrap;
        cursor: pointer;
        padding: 12px 20px;
        border-radius: 20px;
        transition: all 0.3s ease;
        font-weight: 500;
        color: #666;
        background: transparent;
        border: none;
        min-height: 40px;
        display: flex;
        align-items: center;
        flex-shrink: 0;
    }

    .categories-nav-item:hover, 
    .categories-nav-item.active {
        background: transparent;
        color: #1DA1F2;
        text-shadow: 0 0 10px rgba(29, 161, 242, 0.6);
        box-shadow: none;
        transform: translateY(-1px);
    }

    .categories-nav-link {
        text-decoration: none;
        color: inherit;
        display: block;
        font-size: 14px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .categories-nav-item:hover .categories-nav-link,
    .categories-nav-item.active .categories-nav-link {
        color: #1DA1F2;
        text-shadow: 0 0 10px rgba(29, 161, 242, 0.6);
    }

    .categories-layout {
        display: flex;
        gap: 25px;
        min-height: calc(100vh - 400px);
    }

    .categories-sidebar {
        width: 280px;
        background: white;
        border-radius: 15px;
        padding: 25px 20px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        height: fit-content;
        position: sticky;
        top: 80px;
    }

    .categories-sidebar-title {
        font-size: 1.3rem;
        font-weight: 700;
        color: #333;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .categories-sidebar-title::before {
        content: '▼';
        color: #1DA1F2;
        font-size: 0.8rem;
    }

    .categories-sidebar-menu {
        list-style: none;
    }

    .categories-sidebar-item {
        margin-bottom: 6px;
    }

    .categories-sidebar-link {
        display: block;
        padding: 12px 15px;
        color: #666;
        text-decoration: none;
        border-radius: 8px;
        transition: all 0.3s ease;
        font-weight: 500;
        font-size: 14px;
    }

    .categories-sidebar-link:hover,
    .categories-sidebar-link.active {
        background: linear-gradient(135deg, #1DA1F2, #0d7ac9);
        color: white;
        transform: translateX(5px);
    }

    .categories-content-area {
        flex: 1;
        background: white;
        border-radius: 15px;
        padding: 30px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    }

    .categories-content-header {
        margin-bottom: 25px;
    }

    .categories-content-title {
        font-size: 2rem;
        font-weight: 700;
        color: #333;
        margin-bottom: 8px;
    }

    .categories-content-subtitle {
        color: #666;
        font-size: 1rem;
    }

    .categories-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 18px;
        margin-bottom: 35px;
    }

    .category-card {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
        cursor: pointer;
        position: relative;
        height: 170px;
        border: 1px solid #e9ecef;
    }

    .category-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(29, 161, 242, 0.8), rgba(13, 122, 201, 0.8));
        opacity: 0;
        transition: opacity 0.3s ease;
        z-index: 1;
    }

    .category-card:hover::before {
        opacity: 1;
    }

    .category-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(29, 161, 242, 0.2);
    }

    .category-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .category-card:hover .category-image {
        transform: scale(1.05);
    }

    .category-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(transparent, rgba(0,0,0,0.7));
        padding: 18px;
        z-index: 2;
    }

    .category-title {
        color: white;
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 4px;
        text-shadow: 0 2px 10px rgba(0,0,0,0.5);
    }

    .category-description {
        color: rgba(255, 255, 255, 0.9);
        font-size: 0.85rem;
        text-shadow: 0 2px 10px rgba(0,0,0,0.5);
    }

    .category-link {
        display: block;
        width: 100%;
        height: 100%;
        text-decoration: none;
        color: inherit;
        position: relative;
    }

    @media (max-width: 1024px) {
        .categories-layout {
            flex-direction: column;
            gap: 20px;
        }

        .categories-sidebar {
            width: 100%;
            order: 2;
            position: static;
            padding: 20px 15px;
        }

        .categories-content-area {
            order: 1;
            padding: 25px;
        }

        .categories-grid {
            grid-template-columns: 1fr;
            gap: 15px;
        }

        .category-card {
            height: 160px;
        }

        .categories-nav-list {
            gap: 10px;
        }

        .categories-nav-item {
            padding: 8px 15px;
        }
    }

    @media (max-width: 768px) {
        .categories-hero h1 {
            font-size: 2rem;
        }
        
        .categories-hero p {
            font-size: 1rem;
        }
        
        .categories-nav-list {
            padding: 6px 0;
            gap: 8px;
        }

        .categories-nav-item {
            padding: 8px 12px;
            min-height: 35px;
        }

        .categories-nav-link {
            font-size: 14px;
        }
        
        .categories-content-title {
            font-size: 1.7rem;
        }

        .categories-content-area {
            padding: 20px;
        }

        .categories-sidebar {
            padding: 18px 15px;
        }

        .categories-sidebar-title {
            font-size: 1.2rem;
        }

        .categories-hero {
            min-height: 200px;
        }

        .categories-hero-content {
            padding: 30px 15px;
        }
    }
    /* Category Section Styles */
.category-section {
    margin-bottom: 40px;
}

.category-section-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: #333;
    margin-bottom: 8px;
}

.category-section-subtitle {
    color: #666;
    font-size: 0.95rem;
    margin-bottom: 20px;
}

.category-badge {
    position: absolute;
    top: 12px;
    right: 12px;
    background: rgba(29, 161, 242, 0.9);
    color: white;
    padding: 4px 12px;
    border-radius: 12px;
    font-size: 0.75rem;
    font-weight: 600;
    z-index: 3;
}
</style>

<!-- HAPUS BAGIAN INI -->
<div id="categories-section" style="display: none;">
    <!-- Hero Section -->
    <section class="categories-hero">
        <div class="categories-hero-content">
            <h1>Kategori Pekerjaan</h1>
            <p>Temukan berbagai kategori pekerjaan yang tersedia di platform kami</p>
        </div>
    </section>

    <!-- Navigation -->
    <!-- <div class="categories-nav-container">
        <nav class="categories-nav">
            <ul class="categories-nav-list">
                <li class="categories-nav-item active" data-category="popular">
                    <a href="javascript:void(0)" class="categories-nav-link">Pekerjaan Populer</a>
                </li>
                <li class="categories-nav-item" data-category="grafis">
                    <a href="javascript:void(0)" class="categories-nav-link">Grafis & Desain</a>
                </li>
                <li class="categories-nav-item" data-category="dokumen">
                    <a href="javascript:void(0)" class="categories-nav-link">Dokumen & PPT</a>
                </li>
                <li class="categories-nav-item" data-category="web-app">
                    <a href="javascript:void(0)" class="categories-nav-link">Web & App</a>
                </li>
                <li class="categories-nav-item" data-category="video">
                    <a href="javascript:void(0)" class="categories-nav-link">Video Editing</a>
                </li>
            </ul>
        </nav>
    </div> -->

    <!-- Main Layout -->
    <div class="categories-layout">
        <!-- Sidebar -->
        <aside class="categories-sidebar">
            <div class="categories-sidebar-title" id="categories-sidebar-title">Pekerjaan Popular</div>
            <ul class="categories-sidebar-menu" id="categories-sidebar-menu">
                <!-- Sidebar content akan diisi oleh JavaScript -->
            </ul>
        </aside>

        <!-- Main Content Area -->
        <main class="categories-content-area">
            <div class="categories-content-header">
                <h2 class="categories-content-title" id="categories-content-title">Pekerjaan Popular</h2>
                <p class="categories-content-subtitle" id="categories-content-subtitle">Kategori pekerjaan yang paling banyak dicari dan diminati oleh klien kami</p>
            </div>

            <!-- Categories Grid -->
            <div class="categories-grid animate-on-scroll" id="categories-grid">
                <!-- Categories content akan diisi oleh JavaScript -->
            </div>
        </main>
    </div>
</div>
@endsection