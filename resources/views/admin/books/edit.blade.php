@extends('layouts.admin')
@section('title', 'Edit Buku')
@section('content')
<h3>Edit Buku</h3>
@if($errors->any())
  <div class="alert alert-danger">{{ $errors->first() }}</div>
@endif
<form method="POST" action="/admin/books/{{ $book->id }}" enctype="multipart/form-data">
  @csrf @method('PUT')
  <div class="row">
    <div class="col-md-8">
      <div class="mb-3">
        <label class="form-label">Judul Buku <span class="text-danger">*</span></label>
        <input type="text" name="title" class="form-control" value="{{ old('title', $book->title) }}" required>
      </div>
      <div class="row">
        <div class="col-md-6 mb-3">
          <label class="form-label">Penulis <span class="text-danger">*</span></label>
          <input type="text" name="author" class="form-control" value="{{ old('author', $book->author) }}" required>
        </div>
        <div class="col-md-6 mb-3">
          <label class="form-label">Penerbit</label>
          <input type="text" name="publisher" class="form-control" value="{{ old('publisher', $book->publisher) }}">
        </div>
      </div>
      <div class="row">
        <div class="col-md-4 mb-3">
          <label class="form-label">Kategori <span class="text-danger">*</span></label>
          <select name="category_id" class="form-select" required>
            @foreach($categories as $cat)
              <option value="{{ $cat->id }}" {{ $book->category_id == $cat->id ? 'selected' : '' }}>
                {{ $cat->name }}
              </option>
            @endforeach
          </select>
        </div>
        <div class="col-md-4 mb-3">
          <label class="form-label">Tahun Terbit</label>
          <input type="number" name="year" class="form-control" value="{{ old('year', $book->year) }}">
        </div>
        <div class="col-md-4 mb-3">
          <label class="form-label">ISBN</label>
          <input type="text" name="isbn" class="form-control" value="{{ old('isbn', $book->isbn) }}">
        </div>
      </div>
      <div class="row">
        <div class="col-md-6 mb-3">
          <label class="form-label">Harga (Rp) <span class="text-danger">*</span></label>
          <input type="number" name="price" class="form-control" value="{{ old('price', $book->price) }}" required>
        </div>
        <div class="col-md-6 mb-3">
          <label class="form-label">Stok <span class="text-danger">*</span></label>
          <input type="number" name="stock" class="form-control" value="{{ old('stock', $book->stock) }}" required>
        </div>
      </div>
      <div class="mb-3">
        <label class="form-label">Deskripsi</label>
        <textarea name="description" class="form-control" rows="4">{{ old('description', $book->description) }}</textarea>
      </div>
    </div>
    <div class="col-md-4">
      <div class="mb-3">
        <label class="form-label">Cover Buku</label>
        @if($book->cover)
          <img src="{{ asset('storage/'.$book->cover) }}" class="img-fluid rounded mb-2" style="max-height:200px">
          <p class="text-muted small">Upload baru untuk mengganti cover</p>
        @endif
        <input type="file" name="cover" class="form-control" accept="image/*" onchange="previewCover(this)">
        <img id="cover-preview" src="#" class="img-fluid mt-2 rounded d-none" style="max-height:200px">
      </div>
    </div>
  </div>
  <button class="btn btn-warning">Update Buku</button>
  <a href="/admin/books" class="btn btn-secondary">Batal</a>
</form>
<script>
function previewCover(input) {
  const img = document.getElementById('cover-preview');
  if (input.files && input.files[0]) {
    const reader = new FileReader();
    reader.onload = e => { img.src = e.target.result; img.classList.remove('d-none'); };
    reader.readAsDataURL(input.files[0]);
  }
}
</script>
@endsection