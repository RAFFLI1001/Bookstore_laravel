@extends('layouts.app')
@section('title', 'Hasil Pencarian')
@section('content')
<h3 class="mb-3">
  Hasil pencarian: <em>"{{ $query }}"</em>
  <small class="text-muted fs-6">({{ $books->count() }} buku ditemukan)</small>
</h3>

@if($books->isEmpty())
  <div class="alert alert-warning">
    Tidak ada buku yang cocok dengan "<strong>{{ $query }}</strong>".
    <a href="/">Lihat semua buku</a>
  </div>
@else
<div class="row">
  @foreach($books as $book)
  <div class="col-md-3 mb-4">
    <div class="card h-100 shadow-sm">
      @if($book->cover)
        <img src="{{ asset('storage/'.$book->cover) }}" class="card-img-top" style="height:200px;object-fit:cover" alt="{{ $book->title }}">
      @else
        <div class="bg-secondary d-flex align-items-center justify-content-center" style="height:200px">
          <span class="text-white fs-1">📖</span>
        </div>
      @endif
      <div class="card-body">
        <h6 class="card-title">{{ $book->title }}</h6>
        <p class="card-text text-muted small">{{ $book->author }}</p>
        <p class="card-text fw-bold text-success">{{ $book->formatted_price }}</p>
        <span class="badge bg-secondary">{{ $book->category->name }}</span>
      </div>
      <div class="card-footer">
        <a href="/books/{{ $book->id }}" class="btn btn-sm btn-primary w-100">Lihat Detail</a>
      </div>
    </div>
  </div>
  @endforeach
</div>
@endif
@endsection 