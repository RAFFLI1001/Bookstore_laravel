@extends('layouts.app')
@section('title', 'Keranjang Belanja')
@section('content')

<div class="cart-header mb-4">
    <p class="page-eyebrow">Belanja</p>
    <h1 class="page-title">Keranjang Belanja</h1>
</div>

@if($carts->isEmpty())
  <div class="empty-cart">
    <div class="empty-icon">🛒</div>
    <h3>Keranjang masih kosong</h3>
    <p>Yuk temukan buku favorit kamu!</p>
    <a href="/" class="book-btn">Jelajahi Buku</a>
  </div>

@else
<div class="cart-layout">

    {{-- ── KIRI: Tabel Buku ── --}}
    <div class="cart-items">
        <div class="cart-section-label">Ringkasan Item</div>
        <div class="cart-table-wrap">
            <table class="cart-table">
                <thead>
                    <tr>
                        <th>Buku</th>
                        <th>Harga</th>
                        <th>Qty</th>
                        <th>Subtotal</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($carts as $cart)
                    <tr>
                        <td class="td-title">{{ $cart->book->title }}</td>
                        <td>{{ $cart->book->formatted_price }}</td>
                      <td>
    <form action="/cart/update/{{ $cart->id }}" method="POST"
          class="qty-control d-flex align-items-center justify-content-center">
        @csrf
        @method('PATCH')

        <button type="button" class="qty-btn minus"
            onclick="this.nextElementSibling.stepDown()">−</button>

        <input type="number" name="quantity"
               value="{{ $cart->quantity }}"
               min="1"
               class="qty-input">

        <button type="button" class="qty-btn plus"
            onclick="this.previousElementSibling.stepUp()">+</button>

        <button class="qty-save">✔</button>
    </form>
</td>
                        <td class="td-subtotal">Rp {{ number_format($cart->subtotal, 0, ',', '.') }}</td>
                        <td>
                            <form method="POST" action="/cart/{{ $cart->id }}">
                                @csrf @method('DELETE')
                                <button class="btn-hapus" title="Hapus">✕</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3" class="tf-label">Total Pembayaran</td>
                        <td colspan="2" class="tf-total">Rp {{ number_format($total, 0, ',', '.') }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    {{-- ── KANAN: Checkout ── --}}
    <div class="checkout-panel">
        <div class="cart-section-label">Checkout</div>

        <form method="POST" action="/checkout">
            @csrf

            {{-- Alamat --}}
            <div class="field-group">
                <label class="field-label">Alamat Pengiriman</label>
                <textarea name="shipping_address" class="field-input" rows="3" required>{{ auth()->user()->address }}</textarea>
            </div>

            {{-- Catatan --}}
            <div class="field-group">
                <label class="field-label">Catatan <span class="field-optional">(opsional)</span></label>
                <textarea name="note" class="field-input" rows="2" placeholder="Instruksi khusus untuk penjual…"></textarea>
            </div>

            {{-- Metode Pembayaran --}}
            <div class="field-group">
                <label class="field-label">Metode Pembayaran</label>
                <div class="payment-options">

                    {{-- Bank Transfer --}}
                    <label class="payment-card" id="card-bank">
                        <input type="radio" name="payment_method" value="bank_transfer" required>
                        <div class="payment-card-inner">
                            <div class="payment-icon bank-icon">🏦</div>
                            <div class="payment-info">
                                <span class="payment-name">Transfer Bank</span>
                                <span class="payment-desc">BCA · BRI · Mandiri · BNI</span>
                            </div>
                            <div class="payment-check">✓</div>
                        </div>
                    </label>

                    {{-- QRIS --}}
                    <label class="payment-card" id="card-qris">
                        <input type="radio" name="payment_method" value="qris" required>
                        <div class="payment-card-inner">
                            <div class="payment-icon qris-icon">⬛</div>
                            <div class="payment-info">
                                <span class="payment-name">QRIS</span>
                                <span class="payment-desc">GoPay · OVO · Dana · ShopeePay</span>
                            </div>
                            <div class="payment-check">✓</div>
                        </div>
                    </label>

                </div>

                {{-- Detail Bank (muncul jika pilih bank) --}}
                <div class="bank-detail" id="bank-detail">
                    <p class="bank-detail-title">Rekening Tujuan Transfer</p>
                    <div class="bank-list">
                        <div class="bank-row">
                            <span class="bank-name">BCA</span>
                            <span class="bank-number">1234567890</span>
                            <span class="bank-holder">a/n BookStore</span>
                        </div>
                        <div class="bank-row">
                            <span class="bank-name">BRI</span>
                            <span class="bank-number">0987654321</span>
                            <span class="bank-holder">a/n BookStore</span>
                        </div>
                        <div class="bank-row">
                            <span class="bank-name">Mandiri</span>
                            <span class="bank-number">1122334455</span>
                            <span class="bank-holder">a/n BookStore</span>
                        </div>
                    </div>
                    <p class="bank-note">⚠ Pesanan dikonfirmasi setelah bukti transfer dikirim ke admin.</p>
                </div>

                {{-- Detail QRIS (muncul jika pilih qris) --}}
                <div class="qris-detail" id="qris-detail">
                    <p class="bank-detail-title">Scan QR Code</p>
                    <div class="qris-placeholder">
                        <div class="qr-mock">
                            <div class="qr-inner">QR</div>
                        </div>
                        <p class="qris-note">QR Code akan tampil setelah pesanan dibuat.<br>Berlaku selama <strong>15 menit</strong>.</p>
                    </div>
                </div>
            </div>

            {{-- Summary --}}
            <div class="order-summary">
                <div class="summary-row">
                    <span>Subtotal</span>
                    <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                </div>
                <div class="summary-row">
                    <span>Ongkir</span>
                    <span class="text-muted">Gratis</span>
                </div>
                <div class="summary-row summary-total">
                    <span>Total</span>
                    <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                </div>
            </div>

            <button type="submit" class="btn-checkout">Buat Pesanan →</button>
        </form>
    </div>

</div>
@endif

<style>
/* ── PAGE HEADER ── */
.page-eyebrow {
    font-size: 0.72rem;
    font-weight: 500;
    letter-spacing: 0.16em;
    text-transform: uppercase;
    color: var(--amber);
    margin-bottom: 6px;
}
.page-title {
    font-family: 'Playfair Display', serif;
    font-size: 1.9rem;
    font-weight: 700;
    color: var(--ink);
    margin: 0;
}

/* ── EMPTY STATE ── */
.empty-cart {
    text-align: center;
    padding: 60px 20px;
    color: var(--warm-gray);
}
.empty-icon { font-size: 3.5rem; margin-bottom: 16px; }
.empty-cart h3 {
    font-family: 'Playfair Display', serif;
    font-size: 1.4rem;
    color: var(--ink);
    margin-bottom: 8px;
}
.empty-cart p { font-size: 0.9rem; margin-bottom: 20px; }

/* ── LAYOUT ── */
.cart-layout {
    display: grid;
    grid-template-columns: 1fr 380px;
    gap: 28px;
    align-items: start;
}
@media (max-width: 860px) {
    .cart-layout { grid-template-columns: 1fr; }
}

.cart-section-label {
    font-size: 0.72rem;
    font-weight: 500;
    letter-spacing: 0.14em;
    text-transform: uppercase;
    color: var(--warm-gray);
    margin-bottom: 12px;
}

/* ── TABLE ── */
.cart-table-wrap {
    background: var(--paper);
    border: 1px solid var(--border);
    border-radius: 10px;
    overflow: hidden;
}
.cart-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 0.88rem;
}
.cart-table thead th {
    background: rgba(26,18,8,0.04);
    padding: 11px 16px;
    font-size: 0.72rem;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    color: var(--warm-gray);
    font-weight: 500;
    border-bottom: 1px solid var(--border);
    text-align: left;
}
.cart-table tbody tr {
    border-bottom: 1px solid var(--border);
    transition: background 0.15s;
}
.cart-table tbody tr:last-child { border-bottom: none; }
.cart-table tbody tr:hover { background: rgba(200,134,10,0.04); }
.cart-table td { padding: 13px 16px; vertical-align: middle; }
.td-title { font-weight: 500; color: var(--ink); }
.td-subtotal { font-weight: 600; color: var(--ink); }

.qty-badge {
    display: inline-block;
    background: rgba(26,18,8,0.07);
    border-radius: 4px;
    padding: 2px 9px;
    font-size: 0.82rem;
    font-weight: 500;
}

.btn-hapus {
    background: none;
    border: 1px solid #ddd;
    border-radius: 5px;
    color: #c0392b;
    font-size: 0.75rem;
    width: 28px; height: 28px;
    cursor: pointer;
    transition: all 0.15s;
    display: flex; align-items: center; justify-content: center;
}
.btn-hapus:hover { background: #fdecea; border-color: #c0392b; }

.cart-table tfoot td {
    padding: 13px 16px;
    border-top: 2px solid var(--border);
}
.tf-label {
    font-size: 0.82rem;
    font-weight: 500;
    letter-spacing: 0.06em;
    text-transform: uppercase;
    color: var(--warm-gray);
}
.tf-total {
    font-family: 'Playfair Display', serif;
    font-size: 1.15rem;
    font-weight: 700;
    color: var(--ink);
}

/* ── CHECKOUT PANEL ── */
.checkout-panel {
    background: var(--paper);
    border: 1px solid var(--border);
    border-radius: 10px;
    padding: 22px 22px 24px;
    position: sticky;
    top: 80px;
}

.field-group { margin-bottom: 18px; }
.field-label {
    display: block;
    font-size: 0.78rem;
    font-weight: 500;
    letter-spacing: 0.06em;
    text-transform: uppercase;
    color: var(--warm-gray);
    margin-bottom: 7px;
}
.field-optional { font-weight: 400; text-transform: none; letter-spacing: 0; }
.field-input {
    width: 100%;
    background: var(--cream);
    border: 1px solid var(--border);
    border-radius: 7px;
    padding: 9px 12px;
    font-family: 'DM Sans', sans-serif;
    font-size: 0.88rem;
    color: var(--ink);
    resize: vertical;
    outline: none;
    transition: border-color 0.2s;
}
.field-input:focus { border-color: var(--amber); }

/* ── PAYMENT OPTIONS ── */
.payment-options {
    display: flex;
    flex-direction: column;
    gap: 10px;
    margin-bottom: 12px;
}
.payment-card {
    cursor: pointer;
    border: 1.5px solid var(--border);
    border-radius: 8px;
    transition: border-color 0.18s, background 0.18s;
    background: var(--cream);
    display: block;
}
.payment-card:has(input:checked) {
    border-color: var(--amber);
    background: rgba(200,134,10,0.06);
}
.payment-card input[type="radio"] { display: none; }
.payment-card-inner {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px 14px;
}
.payment-icon {
    font-size: 1.4rem;
    width: 38px; height: 38px;
    border-radius: 8px;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
}
.bank-icon { background: #EBF5FB; }
.qris-icon { background: #F0F0F0; font-size: 1rem; letter-spacing: -1px; }
.payment-info {
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 2px;
}
.payment-name {
    font-size: 0.88rem;
    font-weight: 500;
    color: var(--ink);
}
.payment-desc {
    font-size: 0.73rem;
    color: var(--warm-gray);
}
.payment-check {
    font-size: 0.75rem;
    font-weight: 700;
    color: var(--amber);
    opacity: 0;
    transition: opacity 0.18s;
}
.payment-card:has(input:checked) .payment-check { opacity: 1; }

/* ── BANK DETAIL ── */
.bank-detail, .qris-detail {
    display: none;
    background: var(--cream);
    border: 1px dashed var(--border);
    border-radius: 8px;
    padding: 14px 16px;
    margin-top: 4px;
    animation: fadeSlide 0.2s ease;
}
.bank-detail.active, .qris-detail.active { display: block; }

@keyframes fadeSlide {
    from { opacity: 0; transform: translateY(-6px); }
    to   { opacity: 1; transform: translateY(0); }
}

.bank-detail-title {
    font-size: 0.72rem;
    font-weight: 500;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    color: var(--warm-gray);
    margin-bottom: 10px;
}
.bank-list { display: flex; flex-direction: column; gap: 8px; }
.bank-row {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 0.83rem;
}
.bank-name {
    font-weight: 600;
    color: var(--ink);
    width: 56px;
    flex-shrink: 0;
}
.bank-number {
    font-family: 'Courier New', monospace;
    font-size: 0.85rem;
    background: rgba(26,18,8,0.06);
    padding: 2px 8px;
    border-radius: 4px;
    letter-spacing: 0.05em;
}
.bank-holder { font-size: 0.75rem; color: var(--warm-gray); }
.bank-note {
    font-size: 0.75rem;
    color: #856404;
    background: #fff8e1;
    border-radius: 5px;
    padding: 7px 10px;
    margin: 12px 0 0;
}

/* ── QRIS DETAIL ── */
.qris-placeholder { text-align: center; padding: 8px 0 4px; }
.qr-mock {
    width: 90px; height: 90px;
    border: 3px solid var(--ink);
    border-radius: 8px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 10px;
    background: white;
    position: relative;
}
.qr-inner {
    font-size: 1.1rem;
    font-weight: 700;
    color: var(--warm-gray);
    letter-spacing: 1px;
}
.qris-note { font-size: 0.78rem; color: var(--warm-gray); line-height: 1.55; }

/* ── ORDER SUMMARY ── */
.order-summary {
    border-top: 1px solid var(--border);
    padding-top: 14px;
    margin-top: 18px;
    margin-bottom: 18px;
    display: flex;
    flex-direction: column;
    gap: 8px;
}
.summary-row {
    display: flex;
    justify-content: space-between;
    font-size: 0.86rem;
    color: var(--warm-gray);
}
.summary-total {
    font-family: 'Playfair Display', serif;
    font-size: 1.05rem;
    font-weight: 700;
    color: var(--ink);
    border-top: 1px solid var(--border);
    padding-top: 10px;
    margin-top: 2px;
}

/* ── SUBMIT BUTTON ── */
.btn-checkout {
    width: 100%;
    background: var(--amber);
    color: var(--ink);
    border: none;
    border-radius: 8px;
    padding: 13px 20px;
    font-family: 'DM Sans', sans-serif;
    font-size: 0.9rem;
    font-weight: 600;
    letter-spacing: 0.04em;
    cursor: pointer;
    transition: background 0.2s, transform 0.15s;
}
.btn-checkout:hover { background: var(--amber-light); transform: scale(1.01); }


.qty-control {
    display: flex;
    align-items: center;   /* vertical tengah */
    justify-content: center; /* horizontal tengah */
    gap: 6px;
}

/* semua tombol dibuat sama tinggi */
.qty-btn,
.qty-save {
    width: 30px;
    height: 30px;
}

/* tombol + - */
.qty-btn {
    border-radius: 50%;
    border: 1px solid var(--border);
    background: var(--paper);
    display: flex;
    align-items: center;
    justify-content: center;
}

/* input */
.qty-input {
    width: 45px;
    height: 30px;
    text-align: center;
    border-radius: 6px;
    border: 1px solid var(--border);
}

/* tombol cek */
.qty-save {
    border-radius: 6px;
    background: var(--amber);
    display: flex;
    align-items: center;
    justify-content: center;
}

.cart-table td:nth-child(3),
.cart-table th:nth-child(3) {
    text-align: center;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const radios = document.querySelectorAll('input[name="payment_method"]');
    const bankDetail = document.getElementById('bank-detail');
    const qrisDetail = document.getElementById('qris-detail');

    radios.forEach(radio => {
        radio.addEventListener('change', function () {
            bankDetail.classList.remove('active');
            qrisDetail.classList.remove('active');
            if (this.value === 'bank_transfer') bankDetail.classList.add('active');
            if (this.value === 'qris') qrisDetail.classList.add('active');
        });
    });
});
</script>

@endsection