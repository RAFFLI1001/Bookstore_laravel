@extends('layouts.app')
@section('title', 'Login')

@section('content')
<div class="d-flex align-items-center justify-content-center" style="min-height: 100vh;">
  <div class="col-md-5">
    <div class="card border-0 shadow-lg rounded-4">
      
      <div class="card-body p-5">
        
        <div class="text-center mb-4">
          <h3 class="fw-bold">Selamat Datang 👋</h3>
          <p class="text-muted">Silakan login ke akun kamu</p>
        </div>

        @if($errors->any())
          <div class="alert alert-danger text-center">
            {{ $errors->first() }}
          </div>
        @endif

        <form method="POST" action="/login">
          @csrf

          <div class="mb-3">
            <label class="form-label fw-semibold">Email</label>
            <input type="email" name="email" class="form-control rounded-3" placeholder="Masukkan email" required>
          </div>

          <div class="mb-3">
            <label class="form-label fw-semibold">Password</label>
            <input type="password" name="password" class="form-control rounded-3" placeholder="Masukkan password" required>
          </div>

          <button class="btn btn-primary w-100 rounded-3 fw-semibold">
            Login
          </button>
        </form>

        <div class="text-center mt-4">
          <small class="text-muted">
            Belum punya akun? 
            <a href="/register" class="text-decoration-none fw-semibold">Daftar</a>
          </small>
        </div>

      </div>
    </div>
  </div>
</div>
@endsection