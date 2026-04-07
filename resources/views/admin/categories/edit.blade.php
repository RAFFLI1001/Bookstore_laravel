@extends('layouts.admin')
@section('title', 'Edit Kategori')
@section('content')
<div class="row">
  <div class="col-md-6">
    <h3>Edit Kategori</h3>
    @if($errors->any())
      <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif
    <form method="POST" action="/admin/categories/{{ $category->id }}">
      @csrf @method('PUT')
      <div class="mb-3">
        <label class="form-label">Nama Kategori</label>
        <input type="text" name="name" class="form-control" value="{{ old('name', $category->name) }}" required>
      </div>
      <button class="btn btn-warning">Update</button>
      <a href="/admin/categories" class="btn btn-secondary">Batal</a>
    </form>
  </div>
</div>
@endsection