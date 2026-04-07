@extends('layouts.app')
@section('title', 'Contact')

@section('content')
<div class="d-flex align-items-center justify-content-center" style="min-height: 100vh;">
  <div class="col-md-7">
    <div class="card border-0 shadow-lg rounded-4">
      
      <div class="card-body p-5">
        
        <div class="text-center mb-4">
          <div style="font-size: 3rem;">📬</div>
          <h3 class="fw-bold mt-2">Hubungi Kami</h3>
          <p class="text-muted">Kami siap membantu Anda</p>
        </div>

        @if(session('success'))
          <div class="alert alert-success text-center">
            {{ session('success') }}
          </div>
        @endif

        @if($errors->any())
          <div class="alert alert-danger text-center">
            {{ $errors->first() }}
          </div>
        @endif

        <form method="POST" action="/contact">
          @csrf

          <div class="row">
            <div class="col-md-6 mb-3">
              <label class="form-label fw-semibold">Nama</label>
              <input type="text" name="name" class="form-control rounded-3" 
                     value="{{ old('name', auth()->user()->name ?? '') }}" 
                     placeholder="Masukkan nama" required>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label fw-semibold">Email</label>
              <input type="email" name="email" class="form-control rounded-3" 
                     value="{{ old('email', auth()->user()->email ?? '') }}" 
                     placeholder="Masukkan email" required>
            </div>
          </div>

          <div class="mb-3">
            <label class="form-label fw-semibold">Subjek</label>
            <input type="text" name="subject" class="form-control rounded-3" 
                   value="{{ old('subject') }}" 
                   placeholder="Masukkan subjek pesan" required>
          </div>

          <div class="mb-4">
            <label class="form-label fw-semibold">Pesan</label>
            <textarea name="message" class="form-control rounded-3" 
                      rows="5" placeholder="Tulis pesan Anda di sini..." 
                      required>{{ old('message') }}</textarea>
          </div>

          <button class="btn btn-primary w-100 rounded-3 fw-semibold">
            📨 Kirim Pesan
          </button>
        </form>

        <hr class="my-4">

        <div class="text-center">
          <h5 class="fw-semibold mb-3">📍 Informasi Kontak</h5>
          <div class="row">
            <div class="col-md-4 mb-2">
              <div style="font-size: 1.5rem;">📧</div>
              <small class="text-muted">Email</small>
              <p class="mb-0 small">admin@bookstore.com</p>
            </div>
            <div class="col-md-4 mb-2">
              <div style="font-size: 1.5rem;">📱</div>
              <small class="text-muted">WhatsApp</small>
              <p class="mb-0 small">+62 812-3456-7890</p>
            </div>
            <div class="col-md-4 mb-2">
              <div style="font-size: 1.5rem;">🕐</div>
              <small class="text-muted">Jam Operasional</small>
              <p class="mb-0 small">Senin–Sabtu, 08.00–17.00 WIB</p>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>
@endsection