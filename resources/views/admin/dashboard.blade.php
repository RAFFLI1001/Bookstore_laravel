@extends('layouts.admin')
@section('title', 'Dashboard Admin')
@section('content')

<div class="mb-4">
  <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
    <div class="card-body p-4" style="background: linear-gradient(120deg, #1e293b 0%, #0f172a 100%);">
      <div class="row align-items-center">
        <div class="col-md-8">
          <h4 class="text-white fw-bold mb-2">Selamat Datang, {{ auth()->user()->name }}! 👋</h4>
          <p class="text-white-50 mb-0 small">Berikut adalah ringkasan aktivitas toko buku Anda hari ini.</p>
        </div>
        <div class="col-md-4 text-md-end mt-3 mt-md-0">
          <div class="bg-white bg-opacity-10 rounded-3 p-2 d-inline-block">
            <span class="text-white small">
              📅 {{ date('d F Y') }}
            </span>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row g-3 mb-4">
  <div class="col-sm-6 col-xl-3">
    <div class="card border-0 shadow-sm rounded-3 hover-card">
      <div class="card-body p-3">
        <div class="d-flex align-items-center justify-content-between">
          <div>
            <span class="text-muted small text-uppercase fw-semibold">Total Buku</span>
            <h2 class="fw-bold mt-2 mb-0">{{ $totalBooks }}</h2>
            <small class="text-success">
              <span>↑ 12%</span>
            </small>
          </div>
          <div class="rounded-3 p-3" style="background: rgba(59, 130, 246, 0.1);">
            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#3b82f6" stroke-width="2">
              <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/>
              <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/>
            </svg>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-sm-6 col-xl-3">
    <div class="card border-0 shadow-sm rounded-3 hover-card">
      <div class="card-body p-3">
        <div class="d-flex align-items-center justify-content-between">
          <div>
            <span class="text-muted small text-uppercase fw-semibold">Total User</span>
            <h2 class="fw-bold mt-2 mb-0">{{ $totalUsers }}</h2>
            <small class="text-success">
              <span>↑ 8%</span>
            </small>
          </div>
          <div class="rounded-3 p-3" style="background: rgba(16, 185, 129, 0.1);">
            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="2">
              <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
              <circle cx="12" cy="7" r="4"/>
            </svg>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-sm-6 col-xl-3">
    <div class="card border-0 shadow-sm rounded-3 hover-card">
      <div class="card-body p-3">
        <div class="d-flex align-items-center justify-content-between">
          <div>
            <span class="text-muted small text-uppercase fw-semibold">Total Pesanan</span>
            <h2 class="fw-bold mt-2 mb-0">{{ $totalOrders }}</h2>
            <small class="text-danger">
              <span>↓ 3%</span>
            </small>
          </div>
          <div class="rounded-3 p-3" style="background: rgba(245, 158, 11, 0.1);">
            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#f59e0b" stroke-width="2">
              <circle cx="9" cy="21" r="1"/>
              <circle cx="20" cy="21" r="1"/>
              <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/>
            </svg>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-sm-6 col-xl-3">
    <div class="card border-0 shadow-sm rounded-3 hover-card">
      <div class="card-body p-3">
        <div class="d-flex align-items-center justify-content-between">
          <div>
            <span class="text-muted small text-uppercase fw-semibold">Pesan Baru</span>
            <h2 class="fw-bold mt-2 mb-0">{{ $totalMessages }}</h2>
            <small class="text-warning">
              <span>Perlu ditindak</span>
            </small>
          </div>
          <div class="rounded-3 p-3" style="background: rgba(239, 68, 68, 0.1);">
            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#ef4444" stroke-width="2">
              <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
            </svg>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="card border-0 shadow-sm rounded-3">
  <div class="card-header bg-white border-0 pt-4 px-4">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
      <div>
        <h5 class="fw-bold mb-0">📋 Pesanan Terbaru</h5>
        <p class="text-muted small mb-0 mt-1">Daftar pesanan yang masuk</p>
      </div>
    </div>
  </div>

  <div class="card-body p-0">
    <div class="table-responsive">
      <table class="table table-hover align-middle mb-0">
        <thead style="background: #f8fafc; border-bottom: 2px solid #e2e8f0;">
          <tr>
            <th class="ps-4 py-3 border-0" style="font-size: 0.7rem; font-weight: 700; color: #475569; text-transform: uppercase;">ID</th>
            <th class="py-3 border-0" style="font-size: 0.7rem; font-weight: 700; color: #475569; text-transform: uppercase;">Customer</th>
            <th class="py-3 border-0" style="font-size: 0.7rem; font-weight: 700; color: #475569; text-transform: uppercase;">Total</th>
            <th class="py-3 border-0" style="font-size: 0.7rem; font-weight: 700; color: #475569; text-transform: uppercase;">Status</th>
            <th class="pe-4 py-3 border-0" style="font-size: 0.7rem; font-weight: 700; color: #475569; text-transform: uppercase;">Tanggal</th>
          </tr>
        </thead>
        <tbody>
          @foreach($recentOrders as $order)
          <tr>
            <td class="ps-4 py-3">
              <span class="fw-semibold" style="font-size: 0.85rem;">#{{ $order->id }}</span>
            </td>
            <td class="py-3">
              <div class="d-flex align-items-center gap-2">
                <div class="rounded-circle d-flex align-items-center justify-content-center text-white fw-bold" 
                     style="width: 32px; height: 32px; background: linear-gradient(135deg, #667eea, #764ba2); font-size: 0.7rem;">
                  {{ strtoupper(substr($order->user->name, 0, 1)) }}
                </div>
                <span style="font-size: 0.85rem;">{{ $order->user->name }}</span>
              </div>
            </td>
            <td class="py-3">
              <span class="fw-bold" style="color: #10b981; font-size: 0.85rem;">
                Rp {{ number_format($order->total_price, 0, ',', '.') }}
              </span>
            </td>
            <td class="py-3">
              @php
                $status = [
                  'pending' => ['label' => 'Pending', 'class' => 'warning'],
                  'processing' => ['label' => 'Diproses', 'class' => 'info'],
                  'completed' => ['label' => 'Selesai', 'class' => 'success'],
                  'cancelled' => ['label' => 'Dibatalkan', 'class' => 'danger']
                ];
                $s = $status[$order->status] ?? ['label' => $order->status, 'class' => 'secondary'];
              @endphp
              <span class="badge rounded-pill px-3 py-1" 
                    style="background: rgba({{ $s['class'] == 'warning' ? '245,158,11' : ($s['class'] == 'info' ? '14,165,233' : ($s['class'] == 'success' ? '16,185,129' : '239,68,68')) }}, 0.1); 
                           color: {{ $s['class'] == 'warning' ? '#d97706' : ($s['class'] == 'info' ? '#0284c7' : ($s['class'] == 'success' ? '#059669' : '#dc2626')) }};
                           font-size: 0.7rem;">
                {{ $s['label'] }}
              </span>
            </td>
            <td class="pe-4 py-3">
              <span style="font-size: 0.8rem; color: #64748b;">
                {{ $order->created_at->format('d/m/Y') }}
              </span>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

<style>
  .hover-card {
    transition: all 0.3s ease;
  }
  
  .hover-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.02) !important;
  }
  

  .table tbody tr {
    transition: all 0.2s ease;
    border-bottom: 1px solid #f1f5f9;
  }
  
  .table tbody tr:hover {
    background: #f8fafc;
  }
  
  .table-responsive::-webkit-scrollbar {
    height: 6px;
  }
  
  .table-responsive::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 10px;
  }
  
  .table-responsive::-webkit-scrollbar-thumb {
    background: #cbd5e1;
    border-radius: 10px;
  }
</style>

@endsection