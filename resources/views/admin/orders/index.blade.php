@extends('layouts.admin')
@section('title', 'Daftar Pesanan')
@section('content')

<div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
  <div>
    <h4 class="fw-bold mb-1" style="color: #1e293b;">
      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="display: inline; margin-right: 8px;">
        <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/>
        <line x1="3" y1="6" x2="21" y2="6"/>
        <path d="M16 10a4 4 0 0 1-8 0"/>
      </svg>
      Daftar Pesanan
    </h4>
    <p class="text-muted small mb-0">Kelola dan pantau semua pesanan pelanggan</p>
  </div>
  <div class="d-flex gap-2">
    <span class="badge rounded-pill px-3 py-2" style="background: rgba(59, 130, 246, 0.1); color: #3b82f6; font-size: 0.8rem;">
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="display: inline; margin-right: 4px;">
        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
        <circle cx="12" cy="7" r="4"/>
      </svg>
      Total: {{ $orders->count() }} Pesanan
    </span>
  </div>
</div>

<div class="row g-3 mb-4">
  <div class="col-md-3">
    <div class="card border-0 shadow-sm rounded-3">
      <div class="card-body p-3">
        <div class="d-flex justify-content-between align-items-center">
          <div>
            <span class="text-muted small text-uppercase fw-semibold">Menunggu</span>
            <h3 class="fw-bold mt-1 mb-0" style="color: #f59e0b;">{{ $orders->where('status', 'pending')->count() }}</h3>
          </div>
          <div class="rounded-3 p-2" style="background: rgba(245, 158, 11, 0.1);">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#f59e0b" stroke-width="2">
              <circle cx="12" cy="12" r="10"/>
              <line x1="12" y1="8" x2="12" y2="12"/>
              <line x1="12" y1="16" x2="12.01" y2="16"/>
            </svg>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="card border-0 shadow-sm rounded-3">
      <div class="card-body p-3">
        <div class="d-flex justify-content-between align-items-center">
          <div>
            <span class="text-muted small text-uppercase fw-semibold">Diproses</span>
            <h3 class="fw-bold mt-1 mb-0" style="color: #3b82f6;">{{ $orders->where('status', 'processing')->count() }}</h3>
          </div>
          <div class="rounded-3 p-2" style="background: rgba(59, 130, 246, 0.1);">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#3b82f6" stroke-width="2">
              <path d="M20 7h-4.18A3 3 0 0 0 16 5.18V4a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"/>
            </svg>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="card border-0 shadow-sm rounded-3">
      <div class="card-body p-3">
        <div class="d-flex justify-content-between align-items-center">
          <div>
            <span class="text-muted small text-uppercase fw-semibold">Dikirim</span>
            <h3 class="fw-bold mt-1 mb-0" style="color: #8b5cf6;">{{ $orders->where('status', 'shipped')->count() }}</h3>
          </div>
          <div class="rounded-3 p-2" style="background: rgba(139, 92, 246, 0.1);">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#8b5cf6" stroke-width="2">
              <path d="M1 3h22v14H1z"/>
              <path d="M5 21h14"/>
              <path d="M9 17v4"/>
              <path d="M15 17v4"/>
            </svg>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="card border-0 shadow-sm rounded-3">
      <div class="card-body p-3">
        <div class="d-flex justify-content-between align-items-center">
          <div>
            <span class="text-muted small text-uppercase fw-semibold">Selesai</span>
            <h3 class="fw-bold mt-1 mb-0" style="color: #10b981;">{{ $orders->where('status', 'delivered')->count() }}</h3>
          </div>
          <div class="rounded-3 p-2" style="background: rgba(16, 185, 129, 0.1);">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="2">
              <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
              <polyline points="22 4 12 14.01 9 11.01"/>
            </svg>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<div class="card border-0 shadow-sm rounded-3 mb-4">
  <div class="card-body p-3">
    <div class="d-flex gap-2 flex-wrap align-items-center">
      <span class="text-muted small fw-semibold me-2">Filter Status:</span>
      <a href="?status=" class="filter-btn {{ !request('status') ? 'active' : '' }}" 
         style="text-decoration: none; padding: 5px 12px; border-radius: 20px; font-size: 0.75rem; transition: all 0.2s;">
        📊 Semua
      </a>
      @foreach(['pending'=>'warning','processing'=>'primary','shipped'=>'info','delivered'=>'success','cancelled'=>'danger'] as $s => $c)
      <a href="?status={{ $s }}" 
         class="filter-btn {{ request('status') === $s ? 'active' : '' }}" 
         data-color="{{ $c }}"
         style="text-decoration: none; padding: 5px 12px; border-radius: 20px; font-size: 0.75rem; transition: all 0.2s;">
        @if($s == 'pending') ⏳ @elseif($s == 'processing') ⚙️ @elseif($s == 'shipped') 🚚 @elseif($s == 'delivered') ✅ @elseif($s == 'cancelled') ❌ @endif
        {{ ucfirst($s) }}
        <span class="ms-1" style="background: rgba(0,0,0,0.1); padding: 2px 6px; border-radius: 20px;">
          {{ $orders->where('status', $s)->count() }}
        </span>
      </a>
      @endforeach
    </div>
  </div>
</div>

@php
  $filtered = request('status') ? $orders->where('status', request('status')) : $orders;
@endphp

@forelse($filtered as $order)
@php
  $statusColor = match($order->status) {
    'pending'    => 'warning',
    'processing' => 'primary',
    'shipped'    => 'info',
    'delivered'  => 'success',
    'cancelled'  => 'danger',
    default      => 'secondary'
  };
  
  $statusBg = match($order->status) {
    'pending'    => 'rgba(245, 158, 11, 0.1)',
    'processing' => 'rgba(59, 130, 246, 0.1)',
    'shipped'    => 'rgba(139, 92, 246, 0.1)',
    'delivered'  => 'rgba(16, 185, 129, 0.1)',
    'cancelled'  => 'rgba(239, 68, 68, 0.1)',
    default      => 'rgba(100, 116, 139, 0.1)'
  };
  
  $statusTextColor = match($order->status) {
    'pending'    => '#d97706',
    'processing' => '#2563eb',
    'shipped'    => '#7c3aed',
    'delivered'  => '#059669',
    'cancelled'  => '#dc2626',
    default      => '#475569'
  };
  
  $statusLabel = match($order->status) {
    'pending'    => '⏳ Menunggu Verifikasi',
    'processing' => '⚙️ Sedang Diproses',
    'shipped'    => '🚚 Dikirim',
    'delivered'  => '✅ Terkirim',
    'cancelled'  => '❌ Ditolak',
    default      => $order->status
  };
  
  $paymentLabel = match($order->payment_method) {
    'bank_transfer' => '🏦 Transfer Bank',
    'qris'          => '📱 QRIS',
    default         => $order->payment_method
  };
@endphp

<div class="card border-0 shadow-sm rounded-3 mb-4 hover-card">
  <div class="card-header bg-white border-0 pt-4 px-4">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
      <div class="d-flex align-items-center gap-3">
        <div class="rounded-circle d-flex align-items-center justify-content-center" 
             style="width: 44px; height: 44px; background: linear-gradient(135deg, #667eea, #764ba2);">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2">
            <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/>
            <line x1="3" y1="6" x2="21" y2="6"/>
            <path d="M16 10a4 4 0 0 1-8 0"/>
          </svg>
        </div>
        <div>
          <div class="d-flex align-items-center gap-2 flex-wrap">
            <h5 class="fw-bold mb-0" style="color: #1e293b;">Order #{{ $order->id }}</h5>
            <span class="badge rounded-pill px-3 py-1" style="background: {{ $statusBg }}; color: {{ $statusTextColor }}; font-size: 0.7rem; font-weight: 600;">
              {{ $statusLabel }}
            </span>
          </div>
          <small class="text-muted">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="display: inline; margin-right: 4px;">
              <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
              <line x1="16" y1="2" x2="16" y2="6"/>
              <line x1="8" y1="2" x2="8" y2="6"/>
              <line x1="3" y1="10" x2="21" y2="10"/>
            </svg>
            {{ $order->created_at->format('d M Y H:i') }}
          </small>
        </div>
      </div>
    </div>
  </div>

  <div class="card-body p-4">
    <div class="row g-4">
      <div class="col-md-3">
        <div class="d-flex align-items-start gap-3">
          <div class="rounded-circle d-flex align-items-center justify-content-center text-white fw-bold" 
               style="width: 48px; height: 48px; background: linear-gradient(135deg, #667eea, #764ba2); font-size: 1.1rem;">
            {{ strtoupper(substr($order->user->name, 0, 1)) }}
          </div>
          <div>
            <div class="fw-semibold" style="color: #1e293b;">{{ $order->user->name }}</div>
            <small class="text-muted d-block">{{ $order->user->email }}</small>
            @if($order->user->phone)
              <small class="text-muted">📱 {{ $order->user->phone }}</small>
            @endif
          </div>
        </div>
      </div>


      <div class="col-md-4">
        <div class="p-2 rounded-3" style="background: #f8fafc;">
          <div class="d-flex align-items-center gap-2 mb-2">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#475569" stroke-width="2">
              <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/>
              <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/>
            </svg>
            <span class="small fw-semibold text-muted">Buku Dipesan</span>
          </div>
          @foreach($order->orderItems as $item)
          <div class="d-flex justify-content-between align-items-center mb-1">
            <span style="font-size: 0.8rem; color: #1e293b;">{{ Str::limit($item->book->title, 35) }}</span>
            <span class="badge rounded-pill" style="background: #e2e8f0; color: #475569; font-size: 0.65rem;">×{{ $item->quantity }}</span>
          </div>
          @endforeach
        </div>
      </div>


      <div class="col-md-2">
        <div class="p-2 rounded-3" style="background: #f8fafc;">
          <div class="d-flex align-items-center gap-2 mb-2">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#475569" stroke-width="2">
              <circle cx="12" cy="12" r="10"/>
              <path d="M12 6v6l4 2"/>
            </svg>
            <span class="small fw-semibold text-muted">Pembayaran</span>
          </div>
          <div class="small text-muted">{{ $paymentLabel }}</div>
          <div class="fw-bold mt-1" style="color: #10b981; font-size: 1rem;">
            Rp {{ number_format($order->total_price, 0, ',', '.') }}
          </div>
        </div>
      </div>


      <div class="col-md-3">
        <div class="p-2 rounded-3" style="background: #f8fafc;">
          <div class="d-flex align-items-center gap-2 mb-2">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#475569" stroke-width="2">
              <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
              <circle cx="12" cy="10" r="3"/>
            </svg>
            <span class="small fw-semibold text-muted">Alamat Pengiriman</span>
          </div>
          <div style="font-size: 0.75rem; color: #475569; line-height: 1.4;">
            {{ Str::limit($order->shipping_address, 50) }}
          </div>
          @if($order->note)
            <div class="mt-2 pt-1 border-top" style="font-size: 0.7rem; color: #f59e0b;">
              📝 Catatan: {{ $order->note }}
            </div>
          @endif
        </div>
      </div>
    </div>
  </div>

  <div class="card-footer bg-white border-0 pb-4 px-4 pt-0">
    <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">

      @if($order->status === 'pending')
      <div class="d-flex gap-2">
        <form method="POST" action="/admin/orders/{{ $order->id }}/terima">
          @csrf @method('PATCH')
          <button class="btn-terima" 
                  onclick="return confirm('Terima pesanan #{{ $order->id }}?')"
                  style="display: inline-flex; align-items: center; gap: 8px; padding: 8px 20px; 
                         background: linear-gradient(135deg, #10b981, #059669); 
                         color: white; border: none; border-radius: 10px; 
                         font-size: 0.75rem; font-weight: 600; transition: all 0.2s ease;">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <polyline points="20 6 9 17 4 12"/>
            </svg>
            Terima Pesanan
          </button>
        </form>

        <form method="POST" action="/admin/orders/{{ $order->id }}/tolak">
          @csrf @method('PATCH')
          <button class="btn-tolak" 
                  onclick="return confirm('Tolak pesanan #{{ $order->id }}? Stok akan dikembalikan.')"
                  style="display: inline-flex; align-items: center; gap: 8px; padding: 8px 20px; 
                         background: linear-gradient(135deg, #ef4444, #dc2626); 
                         color: white; border: none; border-radius: 10px; 
                         font-size: 0.75rem; font-weight: 600; transition: all 0.2s ease;">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <line x1="18" y1="6" x2="6" y2="18"/>
              <line x1="6" y1="6" x2="18" y2="18"/>
            </svg>
            Tolak Pesanan
          </button>
        </form>
      </div>
      @endif

      @if(in_array($order->status, ['processing', 'shipped']))
      <form method="POST" action="/admin/orders/{{ $order->id }}/status" 
            class="d-flex align-items-center gap-2">
        @csrf @method('PATCH')
        <span class="small text-muted">Update Status:</span>
        <select name="status" class="form-select form-select-sm rounded-3" 
                style="width: auto; border: 1px solid #e2e8f0; font-size: 0.75rem;"
                onchange="this.form.submit()">
          <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>⚙️ Processing</option>
          <option value="shipped" {{ $order->status === 'shipped' ? 'selected' : '' }}>🚚 Shipped</option>
          <option value="delivered" {{ $order->status === 'delivered' ? 'selected' : '' }}>✅ Delivered</option>
        </select>
      </form>
      @endif

      @if(in_array($order->status, ['delivered', 'cancelled']))
      <span class="small text-muted">
        @if($order->status === 'delivered')
          <span style="color: #10b981;">✅ Pesanan selesai</span>
        @else
          <span style="color: #dc2626;">❌ Pesanan ditolak</span>
        @endif
      </span>
      @endif

      <span class="small text-muted ms-auto">
        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="display: inline; margin-right: 4px;">
          <circle cx="12" cy="12" r="10"/>
          <line x1="12" y1="8" x2="12" y2="12"/>
          <line x1="12" y1="16" x2="12.01" y2="16"/>
        </svg>
        ID: #{{ $order->id }}
      </span>
    </div>
  </div>
</div>
@empty
<div class="card border-0 shadow-sm rounded-3">
  <div class="card-body text-center py-5">
    <svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="#cbd5e1" stroke-width="1.5" style="margin-bottom: 16px;">
      <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/>
      <line x1="3" y1="6" x2="21" y2="6"/>
      <path d="M16 10a4 4 0 0 1-8 0"/>
    </svg>
    <p class="text-muted mb-0">
      Tidak ada pesanan {{ request('status') ? 'dengan status ' . request('status') : '' }}
    </p>
  </div>
</div>
@endforelse

<style>
  .hover-card {
    transition: all 0.3s ease;
  }
  
  .hover-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 15px 35px -10px rgba(0, 0, 0, 0.1) !important;
  }
  
  .filter-btn {
    background: #f1f5f9;
    color: #475569;
    border: 1px solid #e2e8f0;
  }
  
  .filter-btn:hover {
    background: #e2e8f0;
    transform: translateY(-1px);
  }
  
  .filter-btn.active {
    background: #3b82f6;
    color: white;
    border-color: #3b82f6;
  }

  .btn-terima:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
    cursor: pointer;
  }
  
  .btn-tolak:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
    cursor: pointer;
  }
</style>

@endsection