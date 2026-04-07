<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookStore — @yield('title', 'Toko Buku Online')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        :root {
            --cream: #F5F0E8;
            --ink: #1A1208;
            --amber: #C8860A;
            --amber-light: #E8A020;
            --warm-gray: #8C8074;
            --border: #D9CFC0;
            --paper: #FDFAF5;
            --shadow: rgba(26, 18, 8, 0.08);
        }

        * { box-sizing: border-box; }

        body {
            font-family: 'DM Sans', sans-serif;
            background-color: var(--cream);
            color: var(--ink);
            font-weight: 300;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* ── NAVBAR ── */
        .site-nav {
            background-color: var(--ink);
            border-bottom: 2px solid var(--amber);
            padding: 0;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .site-nav .container {
            display: flex;
            align-items: stretch;
            gap: 0;
            min-height: 62px;
        }

        .nav-brand {
            font-family: 'Playfair Display', serif;
            font-size: 1.45rem;
            font-weight: 700;
            color: var(--cream) !important;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 0 28px 0 0;
            border-right: 1px solid rgba(255,255,255,0.08);
            letter-spacing: -0.3px;
            white-space: nowrap;
            transition: color 0.2s;
        }
        .nav-brand:hover { color: var(--amber-light) !important; }

        .nav-brand .brand-icon {
            width: 32px;
            height: 32px;
            background: var(--amber);
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            flex-shrink: 0;
        }

        .nav-links {
            display: flex;
            align-items: center;
            list-style: none;
            margin: 0;
            padding: 0 0 0 24px;
            gap: 4px;
            flex: 1;
        }

        .nav-links .nav-item a {
            font-family: 'DM Sans', sans-serif;
            font-size: 0.82rem;
            font-weight: 500;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: rgba(245, 240, 232, 0.65) !important;
            text-decoration: none;
            padding: 8px 14px;
            border-radius: 5px;
            transition: all 0.2s;
            white-space: nowrap;
        }
        .nav-links .nav-item a:hover {
            color: var(--cream) !important;
            background: rgba(200, 134, 10, 0.18);
        }

        .nav-search {
            display: flex;
            align-items: center;
            gap: 0;
            margin: 10px 16px;
        }
        .nav-search input {
            background: rgba(255,255,255,0.07);
            border: 1px solid rgba(255,255,255,0.12);
            border-right: none;
            border-radius: 6px 0 0 6px;
            color: var(--cream);
            font-family: 'DM Sans', sans-serif;
            font-size: 0.83rem;
            padding: 6px 14px;
            outline: none;
            width: 180px;
            transition: all 0.2s;
        }
        .nav-search input::placeholder { color: rgba(245,240,232,0.35); }
        .nav-search input:focus {
            background: rgba(255,255,255,0.11);
            border-color: var(--amber);
            width: 220px;
        }
        .nav-search button {
            background: var(--amber);
            border: 1px solid var(--amber);
            border-radius: 0 6px 6px 0;
            color: var(--ink);
            font-family: 'DM Sans', sans-serif;
            font-size: 0.82rem;
            font-weight: 500;
            padding: 6px 14px;
            cursor: pointer;
            transition: background 0.2s;
            white-space: nowrap;
        }
        .nav-search button:hover { background: var(--amber-light); }

        .nav-auth {
            display: flex;
            align-items: center;
            list-style: none;
            margin: 0;
            padding: 0;
            gap: 6px;
            border-left: 1px solid rgba(255,255,255,0.08);
            padding-left: 16px;
        }

        .nav-auth .nav-item a {
            font-size: 0.82rem;
            font-weight: 500;
            letter-spacing: 0.05em;
            color: rgba(245,240,232,0.65) !important;
            text-decoration: none;
            padding: 7px 12px;
            border-radius: 5px;
            transition: all 0.2s;
            white-space: nowrap;
        }
        .nav-auth .nav-item a:hover {
            color: var(--cream) !important;
            background: rgba(200,134,10,0.18);
        }

        /* Tombol Daftar */
        .nav-auth .btn-register {
            background: var(--amber) !important;
            color: var(--ink) !important;
            border-radius: 5px;
            font-weight: 500;
        }
        .nav-auth .btn-register:hover {
            background: var(--amber-light) !important;
        }

        /* ── TOMBOL LOGOUT ── */
        .btn-logout {
            display: flex;
            align-items: center;
            gap: 6px;
            background: rgba(220, 53, 69, 0.15);
            border: 1px solid rgba(220, 53, 69, 0.4);
            border-radius: 5px;
            color: #FF8080 !important;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.82rem;
            font-weight: 500;
            letter-spacing: 0.04em;
            padding: 6px 13px;
            cursor: pointer;
            transition: all 0.2s;
            white-space: nowrap;
            text-transform: uppercase;
        }
        .btn-logout:hover {
            background: rgba(220, 53, 69, 0.85) !important;
            border-color: #dc3545 !important;
            color: #fff !important;
        }

        /* Info user di navbar */
        .nav-user-info {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 5px 10px;
            border-radius: 5px;
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.08);
        }
        .nav-user-avatar {
            width: 28px;
            height: 28px;
            background: var(--amber);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.75rem;
            font-weight: 700;
            color: var(--ink);
            flex-shrink: 0;
        }
        .nav-user-name {
            font-size: 0.8rem;
            color: rgba(245,240,232,0.8);
            font-weight: 400;
            max-width: 100px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        /* ── MAIN CONTENT ── */
        .main-content {
            flex: 1;
            padding: 36px 0 48px;
        }

        /* ── ALERTS ── */
        .alert {
            border-radius: 8px;
            border: none;
            font-size: 0.88rem;
            font-weight: 400;
            padding: 12px 18px;
            margin-bottom: 20px;
        }
        .alert-success {
            background: #EAF5EB;
            color: #1E5C23;
            border-left: 3px solid #3A9E44;
        }
        .alert-danger {
            background: #FDECEA;
            color: #8B1A1A;
            border-left: 3px solid #D94040;
        }

        /* ── BOOK CARDS ── */
        .card-book {
            background: var(--paper);
            border: 1px solid var(--border);
            border-radius: 10px;
            overflow: hidden;
            transition: transform 0.22s, box-shadow 0.22s;
            box-shadow: 0 2px 8px var(--shadow);
        }
        .card-book:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 28px rgba(26,18,8,0.13);
        }
        .card-book img {
            height: 200px;
            object-fit: cover;
            width: 100%;
        }

        /* ── FOOTER ── */
        .site-footer {
            background-color: var(--ink);
            border-top: 2px solid var(--amber);
            padding: 28px 0;
            margin-top: auto;
        }
        .site-footer .footer-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            flex-wrap: wrap;
        }
        .site-footer .footer-brand {
            font-family: 'Playfair Display', serif;
            font-size: 1.1rem;
            color: var(--cream);
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .site-footer .footer-brand span { color: var(--amber); }
        .site-footer .footer-copy {
            font-size: 0.78rem;
            color: rgba(245,240,232,0.4);
            letter-spacing: 0.04em;
        }
        .site-footer .footer-links {
            display: flex;
            gap: 20px;
        }
        .site-footer .footer-links a {
            font-size: 0.78rem;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            color: rgba(245,240,232,0.45);
            text-decoration: none;
            transition: color 0.2s;
        }
        .site-footer .footer-links a:hover { color: var(--amber-light); }

        /* ── RESPONSIVE ── */
        @media (max-width: 900px) {
            .site-nav .container {
                flex-wrap: wrap;
                padding: 10px 16px;
                gap: 8px;
            }
            .nav-brand { border-right: none; padding-right: 0; }
            .nav-links, .nav-auth { padding-left: 0; border: none; }
            .nav-search input { width: 130px; }
            .nav-search input:focus { width: 160px; }
            .site-footer .footer-inner { justify-content: center; text-align: center; }
            .site-footer .footer-links { justify-content: center; }
            .nav-user-info { display: none; }
        }
    </style>
</head>
<body>

{{-- ═══════════════════════ NAVBAR ═══════════════════════ --}}
<nav class="site-nav">
  <div class="container">

    <a class="nav-brand" href="/">
      <span class="brand-icon">📚</span>
      BookStore
    </a>

    <ul class="nav-links">
      <li class="nav-item"><a href="/">Home</a></li>
      <li class="nav-item"><a href="/about">About</a></li>
      <li class="nav-item"><a href="/contact">Contact</a></li>
    </ul>

    <form class="nav-search" action="/books/search" method="GET">
      <input type="search" name="q" placeholder="Cari judul, pengarang…" autocomplete="off">
      <button type="submit">Cari</button>
    </form>

    <ul class="nav-auth">
      @guest
        {{-- Belum login --}}
        <li class="nav-item"><a href="/login">Masuk</a></li>
        <li class="nav-item"><a href="/register" class="btn-register">Daftar</a></li>
      @else
        {{-- Sudah login --}}
        <li class="nav-item"><a href="/cart">🛒 Keranjang</a></li>
        <li class="nav-item"><a href="/orders">Pesanan</a></li>

        {{-- Info user --}}
        <li class="nav-item">
          <div class="nav-user-info">
            <div class="nav-user-avatar">
              {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>
            <span class="nav-user-name">{{ auth()->user()->name }}</span>
          </div>
        </li>

        {{-- Tombol Logout --}}
        <li class="nav-item">
          <form method="POST" action="/logout" style="margin:0">
            @csrf
            <button type="submit" class="btn-logout"
                    onclick="return confirm('Yakin ingin keluar?')">
              {{-- Icon logout --}}
              <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" 
                   fill="currentColor" viewBox="0 0 16 16">
                <path fill-rule="evenodd" 
                      d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 
                         .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 
                         9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 
                         1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z"/>
                <path fill-rule="evenodd" 
                      d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 
                         0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 
                         2.146a.5.5 0 0 0 .708.708l3-3z"/>
              </svg>
              Keluar
            </button>
          </form>
        </li>
      @endguest
    </ul>

  </div>
</nav>

{{-- ═══════════════════════ CONTENT ═══════════════════════ --}}
<main class="main-content">
  <div class="container">

    @if(session('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
    @endif

    @if(session('error'))
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
    @endif

    @yield('content')

  </div>
</main>

{{-- ═══════════════════════ FOOTER ═══════════════════════ --}}
<footer class="site-footer">
  <div class="container">
    <div class="footer-inner">
      <div class="footer-brand">
        📚 Book<span>Store</span>
      </div>
      
      <p class="footer-copy mb-0">&copy; {{ date('Y') }} BookStore. All rights reserved.</p>
    </div>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>