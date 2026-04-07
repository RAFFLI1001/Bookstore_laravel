@extends('layouts.app')
@section('title', $book->title)
@section('content')
<div class="row">
  <div class="col-md-4">
    @if($book->cover)
      <img src="{{ asset('storage/'.$book->cover) }}" class="img-fluid rounded shadow">
    @else
      <div class="bg-secondary rounded d-flex align-items-center justify-content-center" style="height:300px">
        <span class="text-white" style="font-size:5rem">📖</span>
      </div>
    @endif
  </div>
  <div class="col-md-8">
    <h2>{{ $book->title }}</h2>
    <p class="text-muted">oleh {{ $book->author }}</p>
    <table class="table table-sm w-auto">
      <tr><td>Kategori</td><td>: {{ $book->category->name }}</td></tr>
      <tr><td>Penerbit</td><td>: {{ $book->publisher }}</td></tr>
      <tr><td>Tahun</td><td>: {{ $book->year }}</td></tr>
      <tr><td>Stok</td><td>: {{ $book->stock }}</td></tr>
    </table>
    <h3 class="text-success">{{ $book->formatted_price }}</h3>
    <p>{{ $book->description }}</p>
    @auth
      @if($book->stock > 0)
        <form method="POST" action="/cart/add">
          @csrf
          <input type="hidden" name="book_id" value="{{ $book->id }}">
          <button class="btn btn-success btn-lg">🛒 Tambah ke Keranjang</button>
        </form>
      @else
        <button class="btn btn-secondary btn-lg" disabled>Stok Habis</button>
      @endif
    @else
      <a href="/login" class="btn btn-outline-primary">Login untuk Membeli</a>
    @endauth
  </div>
</div>
@endsection