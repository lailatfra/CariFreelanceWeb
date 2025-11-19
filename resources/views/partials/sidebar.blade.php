<style>
/* Professional Blue Sidebar Styles */
.sidebar {
  position: fixed;
  top: 0;
  left: 0;
  height: 100vh;
  overflow-y: auto;
  z-index: 1030; 
  background: linear-gradient(180deg, #2c7dafff 0%, #1d75acff 50%, #1780c2 100%) !important;
  box-shadow: 3px 0 15px rgba(29, 161, 242, 0.2);
  border-right: 1px solid rgba(13, 139, 217, 0.3);
  width: 224px !important;
}

.sidebar-brand {
  background: rgba(255, 255, 255, 0.05) !important;
  padding: 25px 0 !important;
  margin-bottom: 10px;
  transition: all 0.3s ease;
  border-bottom: 1px solid rgba(255, 255, 255, 0.15);
  display: flex !important;
  justify-content: center !important;
  align-items: center !important;
}

.sidebar-brand:hover {
  background: rgba(255, 255, 255, 0.08) !important;
}

.sidebar-brand-icon {
  width: 100%;
  height: 60px;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: all 0.3s ease;
}

.sidebar-brand-icon img {
  max-width: 80%;
  max-height: 50px;
  object-fit: contain;
  filter: brightness(1.1) contrast(1.1);
  border: none !important;
  outline: none !important;
}

.sidebar-divider {
  border-top: 1px solid rgba(255, 255, 255, 0.25) !important;
  margin: 20px 15px !important;
}

#content-wrapper {
  margin-left: 224px;
}

.nav-item {
  margin-bottom: 5px;
}

.nav-link {
  color: rgba(255, 255, 255, 0.95) !important;
  padding: 12px 20px !important;
  border-radius: 8px;
  margin: 0 15px;
  transition: all 0.25s ease;
  position: relative;
  font-weight: 500;
  border-left: 3px solid transparent;
}

.nav-link:hover {
  background: rgba(255, 255, 255, 0.12) !important;
  color: white !important;
  border-left-color: rgba(255, 255, 255, 0.6);
  transform: translateX(2px);
}

.nav-link.active {
  background: rgba(255, 255, 255, 0.18) !important;
  color: white !important;
  font-weight: 600;
  border-left-color: white;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
}

.nav-link i {
  width: 18px;
  margin-right: 12px;
  font-size: 14px;
  color: rgba(255, 255, 255, 0.9);
  transition: all 0.25s ease;
}

.nav-link:hover i,
.nav-link.active i {
  color: white;
}

.nav-link span {
  font-size: 14px;
  letter-spacing: 0.3px;
}

/* Badge untuk notifikasi (opsional) */
.nav-badge {
  position: absolute;
  top: 8px;
  right: 15px;
  background: #ef4444;
  color: white;
  font-size: 10px;
  font-weight: 600;
  padding: 2px 6px;
  border-radius: 10px;
  min-width: 18px;
  text-align: center;
}

/* Special styling for logout */
.nav-item:last-child .nav-link {
  display: block;
  width: 93%;
  background: rgba(239, 68, 68, 0.15) !important;
  border-left: 3px solid rgba(239, 68, 68, 0.4);
  margin-left: 15px;
}

.nav-item:last-child .nav-link:hover {
  background: rgba(239, 68, 68, 0.25) !important;
  border-left-color: rgba(239, 68, 68, 0.7);
}

/* Responsive adjustments */
@media (max-width: 768px) {
  .sidebar {
    width: 224px !important;
  }
  
  .sidebar-brand-icon img {
    max-width: 70%;
    max-height: 40px;
  }
}

/* Animation for sidebar items */
.nav-item {
  opacity: 0;
  animation: fadeInUp 0.4s ease forwards;
}

.nav-item:nth-child(3) { animation-delay: 0.1s; }
.nav-item:nth-child(4) { animation-delay: 0.2s; }
.nav-item:nth-child(5) { animation-delay: 0.3s; }
.nav-item:nth-child(6) { animation-delay: 0.4s; }
.nav-item:nth-child(7) { animation-delay: 0.5s; }
.nav-item:nth-child(8) { animation-delay: 0.6s; }

@keyframes fadeInUp {
  from {
    opacity: 0;
    transform: translateY(15px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}
</style>

<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.dashboard') }}">
    <div class="sidebar-brand-icon">
      <img src="{{ asset('images/logoutama.png') }}" alt="Logo">
    </div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Dashboard -->
  <li class="nav-item">
    <a class="nav-link {{ Request::is('admin/dashboard') ? 'active' : '' }}" 
       href="{{ route('admin.dashboard') }}">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span>
    </a>
  </li>

  <!-- Users -->
  <li class="nav-item">
    <a class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}" 
       href="{{ route('admin.users.index') }}">
      <i class="fas fa-users"></i>
      <span>Kelola Users</span>
    </a>
  </li>

  <!-- Freelancers -->
  <li class="nav-item">
    <a class="nav-link {{ Request::is('admin/freelancers*') ? 'active' : '' }}" 
       href="{{ route('admin.freelancers.index') }}">
      <i class="fas fa-user-tie"></i>
      <span>Kelola Freelancer</span>
    </a>
  </li>

  <!-- Divider untuk grouping yang lebih baik -->
  <hr class="sidebar-divider">

  <!-- Projects -->
  <li class="nav-item">
    <a class="nav-link {{ request()->routeIs('admin.projects.*') ? 'active' : '' }}" 
       href="{{ route('admin.projects.index') }}">
      <i class="fas fa-clipboard-list"></i>
      <span>Kelola Proyek</span>
    </a>
  </li>

  <!-- Pembatalan Proyek -->
  <li class="nav-item">
    <a class="nav-link {{ Request::is('admin/cancels*') ? 'active' : '' }}" 
       href="{{ route('admin.cancels.cancels') }}">
      <i class="fas fa-ban"></i>
      <span>Pembatalan Proyek</span>
    </a>
  </li>

  <!-- Divider untuk Finance section -->
  <hr class="sidebar-divider">

  <!-- Penarikan Saldo (dengan badge notifikasi opsional) -->
  <li class="nav-item">
    <a class="nav-link {{ request()->routeIs('admin.withdrawals.*') ? 'active' : '' }}" 
       href="{{ route('admin.withdrawals.index') }}">
      <i class="fas fa-money-check-alt"></i>
      <span>Penarikan Saldo</span>
      @php
        $pendingCount = \App\Models\Withdrawal::where('status', 'pending')->count();
      @endphp
      @if($pendingCount > 0)
        <span class="nav-badge">{{ $pendingCount }}</span>
      @endif
    </a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">

  <!-- Logout -->
  <li class="nav-item">
    <a class="nav-link" href="{{ route('logout.admin') }}">
      <i class="fas fa-sign-out-alt"></i>
      <span>Logout</span>
    </a>
  </li>
</ul>