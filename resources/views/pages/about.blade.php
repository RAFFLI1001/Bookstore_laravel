@extends('layouts.app')
@section('title', 'About Us')

@section('content')
<div class="d-flex align-items-center justify-content-center" style="min-height: 100vh;">
  <div class="col-md-8">
    <div class="card border-0 shadow-lg rounded-4">
      
      <div class="card-body p-5">
        
        <div class="text-center mb-4">
          <div style="font-size: 4rem;">📚</div>
          <h3 class="fw-bold mt-3">Tentang BookStore</h3>
          <p class="text-muted">Toko buku online terpercaya sejak 2024</p>
        </div>

        <p class="lead text-center text-muted mb-4">
          BookStore adalah toko buku online terpercaya yang menyediakan berbagai koleksi buku
          berkualitas dengan harga terjangkau.
        </p>

        <hr class="my-4">

        <div class="row text-start mt-3">
          <div class="col-md-6 mb-4">
            <h5 class="fw-semibold mb-3">🎯 Misi Kami</h5>
            <p class="text-muted" style="text-align: justify;">
              Menyediakan akses mudah ke buku-buku berkualitas untuk semua kalangan,
              dari novel, buku pendidikan, teknologi, hingga buku agama dan bisnis.
            </p>
          </div>
          <div class="col-md-6 mb-4">
            <h5 class="fw-semibold mb-3">🌟 Mengapa Kami?</h5>
            <ul class="text-muted ps-3">
              <li class="mb-2">📖 Koleksi buku lengkap & beragam</li>
              <li class="mb-2">💰 Harga kompetitif</li>
              <li class="mb-2">💳 Payment at Delivery — bayar saat buku tiba</li>
              <li class="mb-2">🚚 Pengiriman ke seluruh Indonesia</li>
            </ul>
          </div>
        </div>

        <hr class="my-4">

        <div class="row text-center mt-3">
          <div class="col-md-4 mb-3">
            <h3 class="text-primary fw-bold mb-1">500+</h3>
            <p class="text-muted small">Koleksi Buku</p>
          </div>
          <div class="col-md-4 mb-3">
            <h3 class="text-success fw-bold mb-1">1.000+</h3>
            <p class="text-muted small">Pelanggan Puas</p>
          </div>
          <div class="col-md-4 mb-3">
            <h3 class="text-warning fw-bold mb-1">5+</h3>
            <p class="text-muted small">Kategori Buku</p>
          </div>
        </div>

        <div class="text-center mt-4 pt-3">
          <a href="/register" class="btn btn-primary rounded-3 fw-semibold px-4">
            Gabung Sekarang 📖
          </a>
        </div>

      </div>
    </div>
  </div>
</div>
@endsection