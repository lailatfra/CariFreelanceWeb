@extends('client.layout.client-layout')
@section('title', 'Pekerjaan Popular - CariFreelance')
@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <title>Jobboard</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet"/>
  <style>
    :root{
      --blue-700:#1d4ed8;
      --blue-800:#1e40af;
      --gray-200:#e5e7eb;
      --gray-500:#6b7280;
      --gray-600:#4b5563;
      --gray-700:#374151;
      --gray-50:#f9fafb;
      --bg:#f8fbff;
      --radius-sm:6px;
      --shadow-sm:0 1px 2px rgba(0,0,0,.06);
    }
    *{box-sizing:border-box}
    body{margin:0; background:var(--bg); font-family:'Inter',sans-serif; color:var(--gray-900);}
    button{cursor:pointer;background:none;border:none}
    main{padding:1rem 1.5rem; max-width:1280px; margin:0 auto}
    h1{color:var(--blue-700); font-weight:600; font-size:1.25rem;}
    .subtitle{color:var(--gray-700); font-size:.75rem; margin-bottom:1.5rem}
    .card{background:#fff; border:1px solid var(--gray-200); border-radius:var(--radius-sm); box-shadow:var(--shadow-sm);}
    .tabs{display:flex; gap:1.5rem; padding:0 1rem; border-bottom:1px solid var(--gray-200);}
    .tab{padding:.75rem 0; font-size:.75rem; color:var(--gray-500); border-bottom:2px solid transparent;}
    .tab[aria-current="page"]{color:var(--blue-700); font-weight:600; border-bottom-color:var(--blue-700);}
    .filters{display:flex; flex-direction:column; gap:.75rem; padding:.75rem 1rem; border-bottom:1px solid var(--gray-200);}
    @media(min-width:640px){.filters{flex-direction:row;align-items:center}.filters .spacer{margin-left:auto}}
    .sel{border:1px solid var(--gray-200); border-radius:4px; font-size:.75rem; color:var(--gray-500); padding:.5rem .75rem;}
    .post-btn{background:var(--blue-700); color:#fff; font-size:.75rem; font-weight:600; padding:.5rem .75rem; border-radius:4px;}
    .post-btn:hover{background:var(--blue-800)}
    .table-wrap{overflow-x:auto}
    table{width:97%; border-collapse:collapse; font-size:.75rem; margin:15px; color:var(--gray-700);}
    th,td{border:1px solid var(--gray-200); padding:.5rem; text-align:left}
    thead{background:var(--gray-50); color:var(--gray-600);}
    tbody tr:hover{background:var(--gray-50)}
    thead th:nth-child(1){width:3%} thead th:nth-child(2){width:40%} thead th:nth-child(3){width:15%} thead th:nth-child(4){width:15%} thead th:nth-child(5){width:10%} thead th:nth-child(6){width:17%}
    td a{color:var(--blue-700); text-decoration:none; font-weight:600}
    td a:hover{text-decoration:underline}
    .hidden{display:none}
  </style>
</head>
<body>
  <main>
    <h1 class="select-none">Jobboard</h1>
    <p class="subtitle">Posting pekerjaan yang anda butuhkan, dan pilih freelancer yang anda inginkan.</p>

    <section class="card">
      <!-- Tabs -->
      <div class="tabs">
        <button type="button" class="tab" data-tab="jobboard" aria-current="page">Jobboard</button>
        <button type="button" class="tab" data-tab="proses">Dalam Proses</button>
        <button type="button" class="tab" data-tab="selesai">Selesai</button>
      </div>

      <!-- Filters -->
      <div class="filters">
        <select class="sel"><option>Pilih kategori</option></select>
        <select class="sel"><option>Tipe pekerjaan</option></select>
        <div class="spacer"></div>
        <button type="button" class="post-btn">Posting Pekerjaan</button>
      </div>

      <!-- Table: Jobboard -->
      <div class="table-wrap tab-content" id="jobboard">
        <table>
          <thead>
            <tr>
              <th>No.</th>
              <th>Judul Pekerjaan</th>
              <th>Kategori</th>
              <th>Freelancer</th>
              <th>Budget (Rp)</th>
              <th>Tanggal diposting</th>
            </tr>
          </thead>
          <tbody>
            <tr><td>1</td><td>Freelancer untuk Pembuatan Website E-Commerce Brand Clothing</td><td>Web & Pemrograman</td><td><a href="/freelancer/1">Pilih</a></td><td>89.000</td><td>15/08/2025 16:42</td></tr>
            <tr><td>2</td><td>Talent Review Makanan Jakarta</td><td>Pemasaran</td><td><a href="/freelancer/2">Pilih</a></td><td>50.000</td><td>15/08/2025 16:20</td></tr>
            <tr><td>3</td><td>Customer Service Vietnam</td><td>Pemasaran</td><td><a href="/freelancer/3">Pilih</a></td><td>7.000.000</td><td>15/08/2025 15:15</td></tr>
            <tr><td>4</td><td>Dokumentasi Event Bandung</td><td>Fotografi & Videografi</td><td><a href="/freelancer/4">Pilih</a></td><td>200.000</td><td>15/08/2025 14:41</td></tr>
          </tbody>
        </table>
      </div>

      <!-- Table: Dalam Proses -->
      <div class="table-wrap tab-content hidden" id="proses">
        <table>
          <thead>
            <tr>
              <th>No.</th>
              <th>Judul Pekerjaan</th>
              <th>Freelancer</th>
              <th>Status</th>
              <th>Deadline</th>
            </tr>
          </thead>
          <tbody>
            <tr><td>1</td><td>Pembuatan Website Sekolah</td><td>Freelancer A</td><td>Dalam Proses</td><td>25/08/2025</td></tr>
            <tr><td>2</td><td>Desain Logo Startup</td><td>Freelancer B</td><td>Dalam Proses</td><td>28/08/2025</td></tr>
            <tr><td>3</td><td>Social Media Management</td><td>Freelancer C</td><td>Dalam Proses</td><td>30/08/2025</td></tr>
          </tbody>
        </table>
      </div>

      <!-- Table: Selesai -->
      <div class="table-wrap tab-content hidden" id="selesai">
        <table>
          <thead>
            <tr>
              <th>No.</th>
              <th>Judul Pekerjaan</th>
              <th>Freelancer</th>
              <th>Tanggal Selesai</th>
            </tr>
          </thead>
          <tbody>
            <tr><td>1</td><td>Video Animasi Produk</td><td>Freelancer X</td><td>10/08/2025</td></tr>
            <tr><td>2</td><td>Desain Banner Kampanye</td><td>Freelancer Y</td><td>08/08/2025</td></tr>
            <tr><td>3</td><td>Aplikasi POS Toko</td><td>Freelancer Z</td><td>05/08/2025</td></tr>
          </tbody>
        </table>
      </div>
    </section>
  </main>

  <script>
    const tabs = document.querySelectorAll('.tab');
    const contents = document.querySelectorAll('.tab-content');
    tabs.forEach(tab => {
      tab.addEventListener('click', () => {
        tabs.forEach(t => t.removeAttribute('aria-current'));
        tab.setAttribute('aria-current','page');
        contents.forEach(c => c.classList.add('hidden'));
        document.getElementById(tab.dataset.tab).classList.remove('hidden');
      });
    });
  </script>
</body>
</html>
@endsection
