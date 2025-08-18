@extends('client.layout.client-layout') 
@section('title', 'Contact Information - CariFreelance')
@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <title>Profile Page</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <style>
    body {
      background: #fff;
      color: #1f2937;
      font-family: Arial, sans-serif;
      margin: 0;
      line-height: 1.8; 
      font-size: 15px;  
    }

    .main {
      width: 100%;
      margin: auto;
      padding: 40px 28px;
      display: grid;
      gap: 32px;
    }
    @media (min-width: 768px) {
      .main {
        grid-template-columns: 1fr 2fr;
      }
    }

    .profile-card {
      border: 1px solid #d1d5db; /* line lebih gelap */
      border-radius: 10px;
      padding: 32px;
      font-size: 15px;
    }
    .profile-card .avatar {
      width: 90px;
      height: 90px;
      border-radius: 9999px;
      background: #b91c1c;
      color: white;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 36px;
      font-weight: 600;
      margin: auto;
    }
    .profile-card h2 {
      text-align: center;
      margin: 16px 0 8px;
      font-size: 22px;
      font-weight: 600;
    }
    .profile-card p {
      text-align: center;
      font-size: 14px;
      color: #6b7280;
      margin: 0 0 20px;
    }
    .profile-card ul {
      list-style: none;
      padding: 0;
      margin: 0;
      font-size: 15px;
      color: #374151;
    }
    .profile-card ul li {
      display: flex;
      gap: 12px;
      padding: 14px 0;
      border-bottom: 1px solid #d1d5db; /* line lebih gelap */
      align-items: flex-start;
    }
    .profile-card ul li:last-child {
      border-bottom: none;
    }
    .profile-card ul li i {
      color: #6b7280;
      font-size: 16px;
      margin-top: 2px;
    }
    .profile-card button {
      width: 100%;
      border: 1px solid #d1d5db;
      border-radius: 8px;
      padding: 12px;
      font-size: 15px;
      color: #374151;
      background: white;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      margin-top: 12px;
    }
    .profile-card button:hover {
      background: #f9fafb;
    }

    .alert {
      border: 1px solid #93c5fd;
      background: #eff6ff;
      border-radius: 8px;
      padding: 16px;
      font-size: 14px;
      color: #1e3a8a;
      display: flex;
      justify-content: space-between;
      line-height: 1.7;
      margin-bottom: 24px;
    }
    .alert button {
      background: none;
      border: none;
      font-size: 14px;
      font-weight: 600;
      color: #1e3a8a;
      cursor: pointer;
    }
    .alert button:hover {
      text-decoration: underline;
    }

    .breadcrumb {
      font-size: 14px;
      color: #4b5563;
      margin: 18px 0;
      display: flex;
      gap: 6px;
    }

    h1 {
      font-size: 22px;
      font-weight: 800;
      margin-bottom: 10px;
    }
    p.description {
      font-size: 14px;
      color: #4b5563;
      max-width: 680px;
      margin-bottom: 28px;
      line-height: 1.8;
    }

    /* Checklist */
    .checklist {
      border: 1px solid #d1d5db; /* lebih gelap */
      border-radius: 10px;
      padding: 20px;
      width: 100%;
      font-size: 14px;
    }
    .checklist h2 {
      font-size: 16px;
      font-weight: 600;
      margin-bottom: 16px;
    }
    .checklist-item {
      border: 1px solid #d1d5db;
      border-radius: 8px;
      padding: 16px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 16px;
    }
    .checklist-item:last-child {
      margin-bottom: 0;
    }
    .checklist-item .left {
      display: flex;
      gap: 16px;
      align-items: center;
    }
    .checklist-item .icon {
      border: 1px solid #d1d5db;
      border-radius: 9999px;
      padding: 12px;
      color: #374151;
    }
    .checklist-item h3 {
      font-size: 14px;
      font-weight: 600;
      margin-bottom: 6px;
    }
    .checklist-item p {
      font-size: 13px;
      color: #6b7280;
      margin: 0;
      max-width: 340px;
      line-height: 1.7;
    }
    .checklist-item span {
      font-size: 14px;
    }
    .checklist-item .status-gray {
      color: #9ca3af;
    }
    .checklist-item .status-blue {
      color: #2563eb;
      font-weight: 600;
    }
  </style>
</head>
<body>

<main class="main">
  <!-- Profile card -->
  <section class="profile-card">
    <div class="avatar">L</div>
    <h2>Laila</h2>
    <p>lailatulfitria6818@gmail.com</p>
    <ul>
      <li><i class="fas fa-map-marker-alt"></i> Located in Indonesia</li>
      <li><i class="fas fa-user-clock"></i> Joined in August 2025</li>
      <li><i class="fas fa-building"></i> PT. Roleplay Malang</li>
      <li><i class="fas fa-clock"></i>
        <div>
          <strong>Catatan</strong><br>
          <span>Saya adalah pekerja bagian ... dari perusahaan ... sedang mencari ...</span>
        </div>
      </li>
    </ul>
    <button><i class="fas fa-eye"></i> Preview public profile</button>
    <button>Explore CariFreelance <i class="fas fa-arrow-right"></i></button>
  </section>

  <!-- Right content -->
  <section>
    <div class="alert">
      <div><strong>This is your profile</strong>, if you want to change <br> For your profile click here</div>
      <button>Dismiss</button>
    </div>

    <nav class="breadcrumb">
      <span>Home</span> / <span class="font-semibold">My Profile</span>
    </nav>

    <h1>Hi 👋 Let’s help freelancers get to know you</h1>
    <p class="description">Get the most out of Fiverr by sharing a bit more about yourself and how you prefer to work with freelancers.</p>

    <div class="checklist">
      <h2>Profile checklist</h2>
      <div class="checklist-item">
        <div class="left">
          <div class="icon"><i class="fas fa-bullseye"></i></div>
          <div>
            <h3>Share how you plan to use CariFreelance</h3>
            <p>Tell us if you’re here to find services or offer them.</p>
          </div>
        </div>
        <span class="status-gray">Add</span>
      </div>
      <div class="checklist-item">
        <div class="left">
          <div class="icon"><i class="fas fa-sync-alt"></i></div>
          <div>
            <h3>Set your communication preferences</h3>
            <p>Let freelancers know your collaboration preferences.</p>
          </div>
        </div>
        <span class="status-blue">Add</span>
      </div>
    </div>
  </section>
</main>

</body>
</html>

@endsection
