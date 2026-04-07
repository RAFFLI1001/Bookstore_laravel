<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin — @yield('title')</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      background: #f0f2f5;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    /* Sidebar Styles */
    .sidebar {
      width: 260px;
      background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
      color: #e2e8f0;
      transition: all 0.3s ease;
      position: sticky;
      top: 0;
      height: 100vh;
      overflow-y: auto;
    }

    .sidebar::-webkit-scrollbar {
      width: 5px;
    }

    .sidebar::-webkit-scrollbar-track {
      background: #1e293b;
    }

    .sidebar::-webkit-scrollbar-thumb {
      background: #475569;
      border-radius: 5px;
    }

    .sidebar-header {
      padding: 1.5rem 1.25rem;
      border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .sidebar-header h5 {
      font-size: 1.25rem;
      font-weight: 600;
      margin-bottom: 0.25rem;
    }

    .sidebar-header small {
      font-size: 0.7rem;
      opacity: 0.7;
    }

    /* User Profile Card */
    .user-card {
      background: rgba(255, 255, 255, 0.05);
      margin: 1.25rem;
      padding: 0.75rem;
      border-radius: 12px;
      transition: all 0.2s;
    }

    .user-card:hover {
      background: rgba(255, 255, 255, 0.08);
    }

    .user-avatar {
      width: 42px;
      height: 42px;
      background: linear-gradient(135deg, #3b82f6, #2563eb);
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: bold;
      font-size: 1rem;
    }

    /* Navigation */
    .nav-menu {
      padding: 0 0.75rem;
    }

    .nav-link-custom {
      display: flex;
      align-items: center;
      gap: 0.75rem;
      padding: 0.7rem 1rem;
      color: #cbd5e1;
      text-decoration: none;
      border-radius: 10px;
      transition: all 0.2s;
      font-size: 0.9rem;
      font-weight: 500;
    }

    .nav-link-custom i {
      width: 22px;
      font-size: 1.1rem;
    }

    .nav-link-custom:hover {
      background: rgba(59, 130, 246, 0.15);
      color: white;
      transform: translateX(3px);
    }

    .nav-link-custom.active {
      background: linear-gradient(135deg, #3b82f6, #2563eb);
      color: white;
      box-shadow: 0 4px 10px rgba(59, 130, 246, 0.3);
    }

    /* Main Content */
    .main-content {
      flex: 1;
      overflow-y: auto;
      background: #f8fafc;
    }

    /* Top Bar */
    .top-bar {
      background: white;
      padding: 1rem 2rem;
      border-bottom: 1px solid #e2e8f0;
      margin-bottom: 1.5rem;
      border-radius: 0;
    }

    /* Alert Styles */
    .alert-custom {
      border-radius: 12px;
      border: none;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    /* Responsive */
    @media (max-width: 768px) {
      .sidebar {
        width: 70px;
      }
      
      .sidebar-header h5, .sidebar-header small, 
      .user-card .user-info, .nav-link-custom span {
        display: none;
      }
      
      .user-card {
        justify-content: center;
      }
      
      .nav-link-custom {
        justify-content: center;
      }
      
      .nav-link-custom i {
        margin: 0;
      }
      
      .top-bar h4 {
        font-size: 1rem;
      }
    }
  </style>
</head>
<body>
<div class="d-flex" style="min-height: 100vh">
  
  {{-- Sidebar --}}
  <aside class="sidebar">
    <div class="sidebar-header d-flex flex-column align-items-center">

  <h4 style="font-weight: 800; margin-bottom: 0.25rem; font-size: 1.5rem;"> BookStore</h4>
</div>

    {{-- User Profile --}}
    <div class="user-card d-flex align-items-center gap-2">
      <div class="user-avatar">
        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
      </div>
      <div class="user-info" style="flex: 1">
        <div style="font-size: 0.85rem; font-weight: 600;">{{ auth()->user()->name }}</div>
      </div>
    </div>

    {{-- Navigation Menu --}}
    <nav class="nav-menu">
      <a href="/admin/dashboard" 
         class="nav-link-custom {{ request()->is('admin/dashboard') ? 'active' : '' }}">
        <i class="fas fa-tachometer-alt"></i>
        <span>Dashboard</span>
      </a>
      
      <a href="/admin/categories" 
         class="nav-link-custom {{ request()->is('admin/categories*') ? 'active' : '' }}">
        <i class="fas fa-tags"></i>
        <span>Kategori</span>
      </a>
      
      <a href="/admin/books" 
         class="nav-link-custom {{ request()->is('admin/books*') ? 'active' : '' }}">
        <i class="fas fa-book"></i>
        <span>Buku</span>
      </a>
      
      <a href="/admin/users" 
         class="nav-link-custom {{ request()->is('admin/users') ? 'active' : '' }}">
        <i class="fas fa-users"></i>
        <span>User</span>
      </a>
      
      <a href="/admin/orders" 
         class="nav-link-custom {{ request()->is('admin/orders') ? 'active' : '' }}">
        <i class="fas fa-shopping-cart"></i>
        <span>Pesanan</span>
      </a>
    </nav>

    <div style="padding: 1rem;">
      <hr style="border-color: rgba(255,255,255,0.1); margin: 1rem 0;">
      
      {{-- Logout Button --}}
      <form method="POST" action="/logout">
        @csrf
        <button type="submit" 
                class="btn w-100 d-flex align-items-center justify-content-center gap-2"
                style="background: rgba(239, 68, 68, 0.2); color: #fca5a5; border: none; padding: 0.7rem; border-radius: 10px; font-size: 0.9rem; font-weight: 500; transition: all 0.2s;"
                onmouseover="this.style.background='rgba(239, 68, 68, 0.3)'"
                onmouseout="this.style.background='rgba(239, 68, 68, 0.2)'"
                onclick="return confirm('Yakin ingin logout?')">
          <i class="fas fa-sign-out-alt"></i>
          <span>Logout</span>
        </button>
      </form>
    </div>
  </aside>

  {{-- Main Content --}}
  <main class="main-content">
    {{-- Top Bar --}}
    <div class="top-bar d-flex justify-content-between align-items-center">
      <h4 class="mb-0" style="font-weight: 600; color: #1e293b;">
        @yield('title')
      </h4>
      <div class="text-muted small">
        <i class="far fa-calendar-alt me-1"></i>
        {{ date('d F Y') }}
      </div>
    </div>

    {{-- Content Area --}}
    <div class="px-4 pb-4">
      {{-- Alert Notifications --}}
      @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show alert-custom" role="alert">
          <i class="fas fa-check-circle me-2"></i>
          {{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
      @endif
      
      @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show alert-custom" role="alert">
          <i class="fas fa-exclamation-circle me-2"></i>
          {{ session('error') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
      @endif

      @yield('content')
    </div>
  </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>