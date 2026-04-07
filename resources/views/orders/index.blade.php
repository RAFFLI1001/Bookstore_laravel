@extends('layouts.app')
@section('title', 'Pesanan Saya')
@section('content')

<div class="mb-4">
  <p class="page-eyebrow">Akun Saya</p>
  <h1 class="page-title">Pesanan Saya</h1>
</div>

@forelse($orders as $order)
@php
  $statusColor = match($order->status) {
    'pending'    => 'warning',
    'processing' => 'primary',
    'shipped'    => 'info',
    'delivered'  => 'success',
    'cancelled'  => 'danger',
    default      => 'secondary'
  };
  $statusLabel = match($order->status) {
    'pending'    => '⏳ Menunggu Verifikasi Admin',
    'processing' => '⚙️ Pesanan Diterima & Diproses',
    'shipped'    => '🚚 Dalam Pengiriman',
    'delivered'  => '✅ Pesanan Tiba',
    'cancelled'  => '❌ Pesanan Ditolak',
    default      => $order->status
  };
  $paymentLabel = match($order->payment_method) {
    'bank_transfer' => '🏦 Transfer Bank',
    'qris'          => '⬛ QRIS',
    default         => str_replace('_', ' ', $order->payment_method)
  };
@endphp

<div class="card mb-4 shadow-sm">

  {{-- Header --}}
  <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-2">
    <div>
      <strong>Order #{{ $order->id }}</strong>
      <span class="text-muted ms-2 small">
        {{ $order->created_at->format('d M Y, H:i') }} WIB
      </span>
    </div>
    <span class="badge bg-{{ $statusColor }} px-3 py-2" style="font-size:0.82rem">
      {{ $statusLabel }}
    </span>
  </div>

  {{-- Body --}}
  <div class="card-body">

    {{-- Progress Bar Status --}}
    @if($order->status !== 'cancelled')
    <div class="mb-4">
      @php
        $steps = ['pending','processing','shipped','delivered'];
        $currentStep = array_search($order->status, $steps);
      @endphp
      <div class="d-flex justify-content-between position-relative" 
           style="padding: 0 10px">
        {{-- Garis progress --}}
        <div style="position:absolute;top:14px;left:10%;right:10%;height:3px;background:#dee2e6;z-index:0">
          <div style="height:100%;background:var(--amber, #C8860A);
                      width:{{ $currentStep === false ? 0 : ($currentStep / (count($steps)-1)) * 100 }}%;
                      transition:width 0.3s"></div>
        </div>
        @foreach($steps as $i => $step)
        @php
          $done    = $currentStep !== false && $i <= $currentStep;
          $current = $currentStep !== false && $i === $currentStep;
          $labels  = ['pending'=>'Menunggu','processing'=>'Diproses','shipped'=>'Dikirim','delivered'=>'Tiba'];
        @endphp
        <div class="text-center" style="z-index:1;flex:1">
          <div class="mx-auto rounded-circle d-flex align-items-center justify-content-center mb-1"
               style="width:28px;height:28px;font-size:0.7rem;font-weight:700;
                      background:{{ $done ? '#C8860A' : '#dee2e6' }};
                      color:{{ $done ? 'white' : '#888' }};
                      border:2px solid {{ $current ? '#C8860A' : ($done ? '#C8860A' : '#dee2e6') }}">
            {{ $done ? '✓' : ($i + 1) }}
          </div>
          <div style="font-size:0.68rem;color:{{ $done ? '#C8860A' : '#888' }};font-weight:{{ $current ? '600' : '400' }}">
            {{ $labels[$step] }}
          </div>
        </div>
        @endforeach
      </div>
    </div>
    @endif

    {{-- Tabel Buku --}}
    <table class="table table-sm mb-3">
      <thead class="table-light">
        <tr>
          <th>Buku</th>
          <th>Harga</th>
          <th>Qty</th>
          <th class="text-end">Subtotal</th>
        </tr>
      </thead>
      <tbody>
        @foreach($order->orderItems as $item)
        <tr>
          <td>{{ $item->book->title }}</td>
          <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
          <td>{{ $item->quantity }}</td>
          <td class="text-end">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>

    <div class="row g-3">
      <div class="col-md-5">
        <p class="small text-muted mb-1 fw-bold text-uppercase" style="font-size:0.7rem">
          Alamat Pengiriman
        </p>
        <p class="small mb-0">{{ $order->shipping_address }}</p>
      </div>
      <div class="col-md-3">
        <p class="small text-muted mb-1 fw-bold text-uppercase" style="font-size:0.7rem">
          Metode Bayar
        </p>
        <p class="small mb-0">{{ $paymentLabel }}</p>
      </div>
      <div class="col-md-4 text-md-end">
        <p class="small text-muted mb-1 fw-bold text-uppercase" style="font-size:0.7rem">
          Total Pembayaran
        </p>
        <h5 class="fw-bold mb-0" style="color:var(--amber, #C8860A)">
          Rp {{ number_format($order->total_price, 0, ',', '.') }}
        </h5>
      </div>
    </div>

    @if($order->note)
    <div class="mt-3 p-2 rounded bg-light">
      <small class="text-muted">📝 Catatan: {{ $order->note }}</small>
    </div>
    @endif
  </div>

  {{-- Footer berdasarkan status --}}
  <div class="card-footer">
    @if($order->status === 'pending')
      <div class="alert alert-warning mb-0 py-2 small">
        ⏳ <strong>Menunggu verifikasi admin.</strong>
        Pesanan kamu sedang ditinjau. Harap tunggu konfirmasi.
      </div>

    @elseif($order->status === 'processing')
      <div class="alert alert-primary mb-0 py-2 small">
        ⚙️ <strong>Pesanan diterima!</strong>
        Admin sedang memproses pesananmu. Segera dikirim.
      </div>

    @elseif($order->status === 'shipped')
      <div class="alert alert-info mb-0 py-2 small">
        🚚 <strong>Pesanan sedang dikirim.</strong>
        Siapkan pembayaran <strong>{{ $paymentLabel }}</strong> saat kurir tiba.
      </div>

    @elseif($order->status === 'delivered')
      <div class="alert alert-success mb-0 py-2 small">
        ✅ <strong>Pesanan telah tiba!</strong>
        Terima kasih sudah berbelanja di BookStore.
      </div>

    @elseif($order->status === 'cancelled')
      <div class="alert alert-danger mb-0 py-2 small">
        ❌ <strong>Pesanan ditolak oleh admin.</strong>
        Stok buku telah dikembalikan. Silakan hubungi admin jika ada pertanyaan.
      </div>
    @endif
  </div>

</div>
@empty
<div class="text-center py-5" style="color:var(--warm-gray)">
  <div style="font-size:3.5rem">📦</div>
  <h4 style="font-family:'Playfair Display',serif">Belum ada pesanan</h4>
  <p class="small">Yuk mulai belanja buku favoritmu!</p>
  <a href="/" class="btn btn-warning">Jelajahi Buku</a>
</div>
@endforelse

<style>
.page-eyebrow {
    font-size: 0.72rem;
    font-weight: 500;
    letter-spacing: 0.16em;
    text-transform: uppercase;
    color: var(--amber, #C8860A);
    margin-bottom: 6px;
}
.page-title {
    font-family: 'Playfair Display', serif;
    font-size: 1.9rem;
    font-weight: 700;
    margin: 0;
}
</style>

@endsection