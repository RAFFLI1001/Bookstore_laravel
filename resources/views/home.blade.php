@extends('layouts.app')
@section('title', 'Home')
@section('content')


<div class="home-hero mb-5">
    <div class="hero-text">
        <p class="hero-eyebrow">Koleksi Pilihan</p>
        <h1 class="hero-title">Buku Terbaru<br><em>untuk Anda</em></h1>
        <p class="hero-sub">Temukan buku terbaik dari berbagai genre — fiksi, sains, bisnis, dan lebih banyak lagi.</p>
    </div>
    <div class="hero-ornament">
        <span>✦</span>
    </div>
</div>


<div class="section-label mb-4">
    <span class="section-line"></span>
    <span class="section-tag">{{ $books->count() }} Judul Tersedia</span>
    <span class="section-line"></span>
</div>

<div class="book-grid">
    @foreach($books as $book)
    <article class="book-card">
        <a href="/books/{{ $book->id }}" class="book-cover-link">
            @if($book->cover)
                <img src="{{ asset('storage/'.$book->cover) }}" class="book-cover" alt="{{ $book->title }}">
            @else
                <div class="book-cover book-cover-placeholder">
                    <span>📖</span>
                </div>
            @endif
            <div class="book-cover-overlay">
                <span class="overlay-cta">Lihat Detail →</span>
            </div>
        </a>

        <div class="book-body">
            <span class="book-category">{{ $book->category->name }}</span>
            <h3 class="book-title">
                <a href="/books/{{ $book->id }}">{{ $book->title }}</a>
            </h3>
            <p class="book-author">{{ $book->author }}</p>
        </div>

        <div class="book-footer">
            <span class="book-price">{{ $book->formatted_price }}</span>
            <a href="/books/{{ $book->id }}" class="book-btn">Detail</a>
        </div>

    </article>
    @endforeach
</div>

<style>
.home-hero {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    padding: 40px 0 32px;
    border-bottom: 1px solid var(--border);
    position: relative;
    overflow: hidden;
}
.home-hero::before {
    content: '';
    position: absolute;
    right: -60px; top: -60px;
    width: 280px; height: 280px;
    background: radial-gradient(circle, rgba(200,134,10,0.07) 0%, transparent 70%);
    pointer-events: none;
}
.hero-eyebrow {
    font-size: 0.75rem;
    font-weight: 500;
    letter-spacing: 0.18em;
    text-transform: uppercase;
    color: var(--amber);
    margin-bottom: 10px;
}
.hero-title {
    font-family: 'Playfair Display', serif;
    font-size: clamp(2rem, 4vw, 3rem);
    font-weight: 700;
    line-height: 1.15;
    color: var(--ink);
    margin-bottom: 14px;
    letter-spacing: -0.5px;
}
.hero-title em {
    font-style: italic;
    color: var(--amber);
}
.hero-sub {
    font-size: 0.92rem;
    color: var(--warm-gray);
    max-width: 420px;
    line-height: 1.65;
    margin: 0;
}
.hero-ornament {
    font-size: 4rem;
    color: rgba(200,134,10,0.15);
    line-height: 1;
    user-select: none;
    padding-top: 10px;
}

.section-label {
    display: flex;
    align-items: center;
    gap: 14px;
}
.section-line {
    flex: 1;
    height: 1px;
    background: var(--border);
}
.section-tag {
    font-size: 0.72rem;
    font-weight: 500;
    letter-spacing: 0.14em;
    text-transform: uppercase;
    color: var(--warm-gray);
    white-space: nowrap;
}

.book-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(210px, 1fr));
    gap: 24px;
}

.book-card {
    background: var(--paper);
    border: 1px solid var(--border);
    border-radius: 10px;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    transition: transform 0.22s ease, box-shadow 0.22s ease;
    box-shadow: 0 2px 8px rgba(26,18,8,0.06);
}
.book-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 14px 32px rgba(26,18,8,0.12);
}

.book-cover-link {
    display: block;
    position: relative;
    overflow: hidden;
    flex-shrink: 0;
}
.book-cover {
    width: 100%;
    height: 210px;
    object-fit: cover;
    display: block;
    transition: transform 0.32s ease;
}
.book-cover-placeholder {
    height: 210px;
    background: linear-gradient(135deg, #2a2016 0%, #3d3020 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2.8rem;
}
.book-card:hover .book-cover { transform: scale(1.04); }

.book-cover-overlay {
    position: absolute;
    inset: 0;
    background: rgba(26,18,8,0.45);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.22s;
}
.book-card:hover .book-cover-overlay { opacity: 1; }
.overlay-cta {
    font-size: 0.8rem;
    font-weight: 500;
    letter-spacing: 0.08em;
    color: var(--cream);
    border: 1px solid rgba(245,240,232,0.6);
    padding: 7px 16px;
    border-radius: 4px;
    background: rgba(200,134,10,0.25);
}

.book-body {
    padding: 14px 16px 8px;
    flex: 1;
}
.book-category {
    display: inline-block;
    font-size: 0.67rem;
    font-weight: 500;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    color: var(--amber);
    background: rgba(200,134,10,0.1);
    border-radius: 3px;
    padding: 2px 7px;
    margin-bottom: 8px;
}
.book-title {
    font-family: 'Playfair Display', serif;
    font-size: 0.98rem;
    font-weight: 700;
    line-height: 1.35;
    margin-bottom: 5px;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
.book-title a {
    color: var(--ink);
    text-decoration: none;
    transition: color 0.2s;
}
.book-title a:hover { color: var(--amber); }
.book-author {
    font-size: 0.78rem;
    color: var(--warm-gray);
    margin: 0;
}

.book-footer {
    padding: 10px 16px 14px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    border-top: 1px solid var(--border);
    gap: 8px;
}
.book-price {
    font-family: 'Playfair Display', serif;
    font-size: 1rem;
    font-weight: 700;
    color: var(--ink);
}
.book-btn {
    font-size: 0.75rem;
    font-weight: 500;
    letter-spacing: 0.06em;
    text-transform: uppercase;
    color: var(--ink);
    background: var(--amber);
    border: none;
    border-radius: 5px;
    padding: 6px 14px;
    text-decoration: none;
    transition: background 0.2s, transform 0.15s;
    white-space: nowrap;
}
.book-btn:hover {
    background: #E8A020;
    color: var(--ink);
    transform: scale(1.03);
}

@media (max-width: 576px) {
    .book-grid { grid-template-columns: repeat(2, 1fr); gap: 14px; }
    .hero-ornament { display: none; }
    .hero-title { font-size: 1.7rem; }
}
</style>

@endsection