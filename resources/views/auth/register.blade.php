@extends('layouts.app')
@section('title', 'Registrasi')

@section('content')
<div class="d-flex align-items-center justify-content-center" style="min-height: 100vh;">
  <div class="col-md-5">
    <div class="card border-0 shadow-lg rounded-4">
      
      <div class="card-body p-5">
        
        <div class="text-center mb-4">
          <h3 class="fw-bold">Daftar Akun 📚</h3>
          <p class="text-muted">Bergabunglah bersama kami</p>
        </div>

        @if($errors->any())
          <div class="alert alert-danger text-center">
            {{ $errors->first() }}
          </div>
        @endif

        <form method="POST" action="/register">
          @csrf

          <div class="mb-3">
            <label class="form-label fw-semibold">Nama Lengkap</label>
            <input type="text" name="name" class="form-control rounded-3" 
                   placeholder="Masukkan nama lengkap" value="{{ old('name') }}" required>
          </div>

          <div class="mb-3">
            <label class="form-label fw-semibold">Email</label>
            <input type="email" name="email" class="form-control rounded-3" 
                   placeholder="Masukkan email" value="{{ old('email') }}" required>
          </div>

          <div class="mb-3">
            <label class="form-label fw-semibold">No Telepon</label>
            <div class="input-group">
              <span class="input-group-text rounded-start-3">+62</span>
              <input type="text" name="phone" class="form-control rounded-end-3" 
                     placeholder="81234567890" value="{{ old('phone') }}" required>
            </div>
          </div>

          <div class="mb-3">
            <label class="form-label fw-semibold">Alamat</label>
            <textarea name="address" class="form-control rounded-3" 
                      rows="2" placeholder="Masukkan alamat lengkap" required>{{ old('address') }}</textarea>
          </div>

          <div class="mb-3">
            <label class="form-label fw-semibold">Password</label>
            <input type="password" name="password" class="form-control rounded-3" 
                   placeholder="Masukkan password" required>
          </div>

          <div class="mb-3">
            <label class="form-label fw-semibold">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" class="form-control rounded-3" 
                   placeholder="Ulangi password" required>
          </div>

          <button class="btn btn-primary w-100 rounded-3 fw-semibold">
            Daftar
          </button>
        </form>

        <div class="text-center mt-4">
          <small class="text-muted">
            Sudah punya akun? 
            <a href="/login" class="text-decoration-none fw-semibold">Login</a>
          </small>
        </div>

      </div>
    </div>
  </div>
</div>
@endsection