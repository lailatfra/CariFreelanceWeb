@extends('client.layout.client-layout')
@section('title', 'Pekerjaan Popular - CariFreelance')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <title>Pilih Freelancer - CariFreelance</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet"/>
  <style>
    :root{
      --blue-700:#1d4ed8;
      --blue-800:#1e40af;
      --blue-600:#2563eb;
      --blue-100:#dbeafe;
      --green-600:#059669;
      --green-700:#047857;
      --green-100:#dcfce7;
      --yellow-500:#eab308;
      --yellow-100:#fef3c7;
      --gray-200:#e5e7eb;
      --gray-300:#d1d5db;
      --gray-400:#9ca3af;
      --gray-500:#6b7280;
      --gray-600:#4b5563;
      --gray-700:#374151;
      --gray-800:#1f2937;
      --gray-900:#111827;
      --gray-50:#f9fafb;
      --bg:#f8fbff;
      --radius-sm:6px;
      --radius-md:8px;
      --shadow-sm:0 1px 2px rgba(0,0,0,.06);
      --shadow-md:0 4px 6px -1px rgba(0,0,0,.1), 0 2px 4px -1px rgba(0,0,0,.06);
    }
    *{box-sizing:border-box}
    body{margin:0; background:var(--bg); font-family:'Inter',sans-serif; color:var(--gray-900);}
    button{cursor:pointer;background:none;border:none}
    main{padding:1rem 1.5rem; max-width:1280px; margin:0 auto}
    
    .breadcrumb{
      font-size:.75rem;
      color:var(--gray-500);
      margin-bottom:1rem;
    }
    .breadcrumb a{
      color:var(--blue-700);
      text-decoration:none;
    }
    .breadcrumb a:hover{text-decoration:underline}
    
    .header{
      margin-bottom:2rem;
    }
    .job-title{
      color:var(--blue-700); 
      font-weight:600; 
      font-size:1.5rem;
      margin-bottom:.5rem;
    }
    .job-info{
      background:#fff;
      border:1px solid var(--gray-200);
      border-radius:var(--radius-md);
      padding:1rem;
      margin-bottom:1.5rem;
      display:grid;
      grid-template-columns:repeat(auto-fit, minmax(200px, 1fr));
      gap:1rem;
      box-shadow:var(--shadow-sm);
    }
    .info-item{
      display:flex;
      align-items:center;
      gap:.5rem;
      font-size:.875rem;
    }
    .info-item i{
      color:var(--blue-600);
      width:16px;
    }
    .info-value{
      font-weight:500;
      color:var(--gray-700);
    }
    .budget-highlight{
      color:var(--green-600);
      font-weight:600;
      font-size:1.125rem;
    }
    
    h1{
      color:var(--gray-800); 
      font-weight:600; 
      font-size:1.25rem;
      margin-bottom:.5rem;
    }
    .subtitle{
      color:var(--gray-600); 
      font-size:.875rem; 
      margin-bottom:1.5rem
    }
    
    .card{
      background:#fff; 
      border:1px solid var(--gray-200); 
      border-radius:var(--radius-md); 
      box-shadow:var(--shadow-sm);
      overflow:hidden;
    }
    
    .filters{
      display:flex; 
      flex-direction:column; 
      gap:.75rem; 
      padding:1rem; 
      border-bottom:1px solid var(--gray-200);
      background:var(--gray-50);
    }
    @media(min-width:640px){
      .filters{flex-direction:row;align-items:center}
      .filters .spacer{margin-left:auto}
    }
    .sel{
      border:1px solid var(--gray-200); 
      border-radius:4px; 
      font-size:.75rem; 
      color:var(--gray-600); 
      padding:.5rem .75rem;
      background:#fff;
    }
    .back-btn{
      background:var(--gray-200); 
      color:var(--gray-700); 
      font-size:.75rem; 
      font-weight:500; 
      padding:.5rem .75rem; 
      border-radius:4px;
    }
    .back-btn:hover{background:var(--gray-300)}
    
    .freelancer-list{
      padding:0;
    }
    .freelancer-card{
      border-bottom:1px solid var(--gray-200);
      padding:1.5rem;
      transition:background-color 0.2s;
    }
    .freelancer-card:hover{
      background:var(--gray-50);
    }
    .freelancer-card:last-child{
      border-bottom:none;
    }
    
    .freelancer-header{
      display:flex;
      align-items:flex-start;
      justify-content:space-between;
      margin-bottom:1rem;
      flex-wrap:wrap;
      gap:1rem;
    }
    .freelancer-info{
      flex:1;
      min-width:0;
    }
    .freelancer-name{
      font-size:1.125rem;
      font-weight:600;
      color:var(--gray-800);
      margin-bottom:.25rem;
      display:flex;
      align-items:center;
      gap:.5rem;
    }
    .verified-badge{
      background:var(--blue-100);
      color:var(--blue-700);
      font-size:.625rem;
      font-weight:600;
      padding:.125rem .375rem;
      border-radius:12px;
      text-transform:uppercase;
    }
    .freelancer-title{
      color:var(--gray-600);
      font-size:.875rem;
      margin-bottom:.5rem;
    }
    .freelancer-stats{
      display:flex;
      gap:1rem;
      font-size:.75rem;
      color:var(--gray-500);
      flex-wrap:wrap;
    }
    .stat-item{
      display:flex;
      align-items:center;
      gap:.25rem;
    }
    .stat-item i{
      color:var(--yellow-500);
    }
    
    .freelancer-actions{
      display:flex;
      flex-direction:column;
      align-items:flex-end;
      gap:.5rem;
    }
    .price{
      font-size:1.125rem;
      font-weight:600;
      color:var(--green-600);
    }
    .hire-btn{
      background:var(--blue-700);
      color:#fff;
      font-size:.75rem;
      font-weight:600;
      padding:.5rem 1rem;
      border-radius:4px;
      white-space:nowrap;
    }
    .hire-btn:hover{background:var(--blue-800)}
    .view-btn{
      background:transparent;
      color:var(--blue-700);
      font-size:.75rem;
      font-weight:500;
      padding:.25rem .5rem;
      border:1px solid var(--blue-200);
      border-radius:4px;
      white-space:nowrap;
    }
    .view-btn:hover{background:var(--blue-50)}
    
    .freelancer-skills{
      margin-bottom:1rem;
    }
    .skills-list{
      display:flex;
      gap:.5rem;
      flex-wrap:wrap;
    }
    .skill-tag{
      background:var(--gray-100);
      color:var(--gray-700);
      font-size:.625rem;
      font-weight:500;
      padding:.25rem .5rem;
      border-radius:12px;
    }
    
    .freelancer-description{
      color:var(--gray-600);
      font-size:.875rem;
      line-height:1.5;
      margin-bottom:1rem;
    }
    
    .proposal-info{
      background:var(--blue-50);
      border-radius:var(--radius-sm);
      padding:.75rem;
      margin-bottom:1rem;
    }
    .proposal-title{
      font-size:.75rem;
      font-weight:600;
      color:var(--blue-700);
      margin-bottom:.25rem;
      text-transform:uppercase;
    }
    .proposal-text{
      font-size:.875rem;
      color:var(--gray-700);
      line-height:1.4;
    }
    
    .status-indicator{
      display:inline-flex;
      align-items:center;
      gap:.25rem;
      font-size:.625rem;
      font-weight:500;
      padding:.125rem .375rem;
      border-radius:12px;
    }
    .status-online{
      background:var(--green-100);
      color:var(--green-700);
    }
    .status-busy{
      background:var(--yellow-100);
      color:var(--yellow-700);
    }
    
    .no-data{
      text-align:center;
      padding:3rem 1rem;
      color:var(--gray-500);
    }
    .no-data i{
      font-size:3rem;
      margin-bottom:1rem;
      color:var(--gray-300);
    }
  </style>
</head>
<body>
  <main>
  <div class="breadcrumb">
    <a href="/jobboard">Jobboard</a> / <span>Pilih Freelancer</span>
  </div>

  <div class="header">
    <h2 class="job-title">Freelancer untuk Pembuatan Website E-Commerce "UrbanStyle"</h2>
    <div class="job-info">
      <div class="info-item">
        <i class="fas fa-tag"></i>
        <span class="info-value">Web & Pemrograman</span>
      </div>
      <div class="info-item">
        <i class="fas fa-money-bill-wave"></i>
        <span class="info-value budget-highlight">Budget: Fleksibel</span>
      </div>
      <div class="info-item">
        <i class="fas fa-calendar"></i>
        <span class="info-value">15/08/2025 16:42</span>
      </div>
      <div class="info-item">
        <i class="fas fa-clock"></i>
        <span class="info-value">Timeline: 4-6 Minggu</span>
      </div>
    </div>
  </div>

  <section class="card">
    <div class="filters">
      <select class="sel">
        <option>Urutkan berdasarkan</option>
        <option>Harga Terendah</option>
        <option>Harga Tertinggi</option>
        <option>Rating Tertinggi</option>
        <option>Paling Berpengalaman</option>
      </select>
      <select class="sel">
        <option>Semua Status</option>
        <option>Online</option>
        <option>Sibuk</option>
      </select>
      <div class="spacer"></div>
      <button type="button" class="back-btn" onclick="history.back()">
        <i class="fas fa-arrow-left"></i> Kembali
      </button>
    </div>

    <div class="freelancer-list">
      <!-- Freelancer 1 -->
      <div class="freelancer-card">
        <div class="freelancer-header">
          <div class="freelancer-info">
            <div class="freelancer-name">
              Ahmad Rizki Pratama
              <span class="verified-badge">Verified</span>
              <span class="status-indicator status-online">
                <i class="fas fa-circle"></i> Online
              </span>
            </div>
            <div class="freelancer-title">Full Stack Web Developer</div>
            <div class="freelancer-stats">
              <div class="stat-item"><i class="fas fa-star"></i> 4.9 (127 reviews)</div>
              <div class="stat-item"><i class="fas fa-briefcase"></i> 89 proyek selesai</div>
              <div class="stat-item"><i class="fas fa-map-marker-alt"></i> Jakarta, Indonesia</div>
              <div class="stat-item"><i class="fas fa-clock"></i> 3 tahun pengalaman</div>
            </div>
          </div>
          <div class="freelancer-actions">
            <div class="price">Rp 15.000.000</div>
            <button class="hire-btn">Pilih Freelancer</button>
            <button class="view-btn"><a href="/freelancer1">Lihat Profil</a></button>
          </div>
        </div>
        <div class="proposal-info">
          <div class="proposal-title">Proposal untuk proyek ini:</div>
          <div class="proposal-text">
            Saya berpengalaman membuat website e-commerce berbasis Laravel dengan integrasi Midtrans. 
            Untuk UrbanStyle, saya akan membangun katalog produk lengkap (T-shirt, hoodie, kemeja, celana, aksesoris), 
            shopping cart, sistem inventory otomatis, serta admin panel user-friendly. 
            Estimasi waktu pengerjaan 5 minggu.
          </div>
        </div>
        <div class="freelancer-skills">
          <div class="skills-list">
            <span class="skill-tag">Laravel</span>
            <span class="skill-tag">MySQL</span>
            <span class="skill-tag">TailwindCSS</span>
            <span class="skill-tag">Midtrans</span>
            <span class="skill-tag">E-commerce</span>
            <span class="skill-tag">SEO</span>
          </div>
        </div>
        <div class="freelancer-description">
          Spesialis pembuatan e-commerce dengan fitur lengkap: wishlist, loyalty points, dan integrasi Instagram API. 
          Fokus pada performa, keamanan, dan desain modern.
        </div>
      </div>

      <!-- Freelancer 2 -->
      <div class="freelancer-card">
        <div class="freelancer-header">
          <div class="freelancer-info">
            <div class="freelancer-name">
              Sinta Dewi Maharani
              <span class="verified-badge">Verified</span>
              <span class="status-indicator status-online">
                <i class="fas fa-circle"></i> Online
              </span>
            </div>
            <div class="freelancer-title">Web Developer & UI/UX Designer</div>
            <div class="freelancer-stats">
              <div class="stat-item"><i class="fas fa-star"></i> 4.8 (95 reviews)</div>
              <div class="stat-item"><i class="fas fa-briefcase"></i> 67 proyek selesai</div>
              <div class="stat-item"><i class="fas fa-map-marker-alt"></i> Bandung, Indonesia</div>
              <div class="stat-item"><i class="fas fa-clock"></i> 2 tahun pengalaman</div>
            </div>
          </div>
          <div class="freelancer-actions">
            <div class="price">Rp 18.000.000</div>
            <button class="hire-btn">Pilih Freelancer</button>
            <button class="view-btn">Lihat Profil</button>
          </div>
        </div>
        <div class="proposal-info">
          <div class="proposal-title">Proposal untuk proyek ini:</div>
          <div class="proposal-text">
            Saya akan membuat website e-commerce UrbanStyle dengan desain modern, mobile-first, dan fokus pada UX. 
            Fitur termasuk lookbook gallery, size guide interaktif, dan blog section untuk konten fashion. 
            Timeline pengerjaan 6 minggu.
          </div>
        </div>
        <div class="freelancer-skills">
          <div class="skills-list">
            <span class="skill-tag">CodeIgniter 4</span>
            <span class="skill-tag">Bootstrap 5</span>
            <span class="skill-tag">UI/UX Design</span>
            <span class="skill-tag">Instagram API</span>
            <span class="skill-tag">E-commerce</span>
          </div>
        </div>
        <div class="freelancer-description">
          Menggabungkan skill coding dan design untuk hasil website yang fungsional sekaligus menarik. 
          Berpengalaman optimasi conversion rate untuk brand fashion lokal.
        </div>
      </div>
      </div>
    </section>
  </main>

  <script>
    // Add any interactive functionality here if needed
    document.querySelectorAll('.hire-btn').forEach(btn => {
      btn.addEventListener('click', function() {
        const freelancerName = this.closest('.freelancer-card').querySelector('.freelancer-name').textContent.trim();
        if(confirm(`Apakah Anda yakin ingin memilih ${freelancerName.split('\n')[0]} untuk proyek ini?`)) {
          alert('Freelancer berhasil dipilih! Anda akan diarahkan ke halaman kontrak.');
        }
      });
    });

    
  </script>
</body>
</html>
@endsection