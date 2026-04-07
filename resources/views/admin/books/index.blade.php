@extends('layouts.admin')
@section('title', 'Kelola Buku')
@section('content')

<div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
  <div>
    <h4 class="fw-bold mb-1" style="color: #1e293b;">
      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="display: inline; margin-right: 8px;">
        <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/>
        <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/>
      </svg>
      Kelola Buku
    </h4>
    <p class="text-muted small mb-0">Kelola daftar buku yang tersedia di toko Anda</p>
  </div>
  <a href="/admin/books/create" class="btn btn-primary rounded-3 shadow-sm px-4 py-2">
    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="display: inline; margin-right: 6px;">
      <line x1="12" y1="5" x2="12" y2="19"/>
      <line x1="5" y1="12" x2="19" y2="12"/>
    </svg>
    Tambah Buku
  </a>
</div>

<div class="row g-3 mb-4">
  <div class="col-md-3">
    <div class="card border-0 shadow-sm rounded-3">
      <div class="card-body p-3">
        <div class="d-flex justify-content-between align-items-center">
          <div>
            <span class="text-muted small text-uppercase fw-semibold">Total Buku</span>
            <h3 class="fw-bold mt-1 mb-0" style="color: #3b82f6;">{{ $books->count() }}</h3>
          </div>
          <div class="rounded-3 p-2" style="background: rgba(59, 130, 246, 0.1);">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#3b82f6" stroke-width="2">
              <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/>
              <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/>
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
            <span class="text-muted small text-uppercase fw-semibold">Total Stok</span>
            <h3 class="fw-bold mt-1 mb-0" style="color: #10b981;">{{ $books->sum('stock') }}</h3>
          </div>
          <div class="rounded-3 p-2" style="background: rgba(16, 185, 129, 0.1);">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="2">
              <rect x="2" y="7" width="20" height="14" rx="2" ry="2"/>
              <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/>
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
            <span class="text-muted small text-uppercase fw-semibold">Kategori</span>
            <h3 class="fw-bold mt-1 mb-0" style="color: #f59e0b;">{{ $books->groupBy('category_id')->count() }}</h3>
          </div>
          <div class="rounded-3 p-2" style="background: rgba(245, 158, 11, 0.1);">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#f59e0b" stroke-width="2">
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
            <span class="text-muted small text-uppercase fw-semibold">Stok Habis</span>
            <h3 class="fw-bold mt-1 mb-0" style="color: #ef4444;">{{ $books->where('stock', 0)->count() }}</h3>
          </div>
          <div class="rounded-3 p-2" style="background: rgba(239, 68, 68, 0.1);">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#ef4444" stroke-width="2">
              <circle cx="12" cy="12" r="10"/>
              <line x1="12" y1="8" x2="12" y2="12"/>
              <line x1="12" y1="16" x2="12.01" y2="16"/>
            </svg>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="card border-0 shadow-sm rounded-3">
  <div class="card-header bg-white border-0 pt-4 px-4">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
      <h5 class="fw-bold mb-0" style="color: #1e293b;">Daftar Buku</h5>
      
      <div class="position-relative" style="width: 280px;">
        <svg class="position-absolute top-50 start-0 translate-middle-y ms-3" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="2" style="z-index: 5;">
          <circle cx="11" cy="11" r="8"/>
          <line x1="21" y1="21" x2="16.65" y2="16.65"/>
        </svg>
        <input type="text" id="searchInput" class="form-control rounded-3" 
               style="padding-left: 38px; border: 1px solid #e2e8f0; font-size: 0.85rem;"
               placeholder="Cari judul atau penulis...">
        <svg id="clearSearch" class="position-absolute top-50 end-0 translate-middle-y me-3" 
             width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="2" 
             style="cursor: pointer; display: none; z-index: 5;">
          <line x1="18" y1="6" x2="6" y2="18"/>
          <line x1="6" y1="6" x2="18" y2="18"/>
        </svg>
      </div>
    </div>
  </div>
  
  <div class="card-body p-0">
    <div class="table-responsive">
      <table class="table table-hover align-middle mb-0" id="bookTable">
        <thead style="background: #f8fafc; border-bottom: 2px solid #e2e8f0;">
          <tr>
            <th class="ps-4 py-3 border-0" style="font-size: 0.7rem; font-weight: 700; color: #475569; text-transform: uppercase; width: 60px;">No</th>
            <th class="py-3 border-0" style="font-size: 0.7rem; font-weight: 700; color: #475569; text-transform: uppercase; width: 80px;">Cover</th>
            <th class="py-3 border-0" style="font-size: 0.7rem; font-weight: 700; color: #475569; text-transform: uppercase;">Judul Buku</th>
            <th class="py-3 border-0" style="font-size: 0.7rem; font-weight: 700; color: #475569; text-transform: uppercase;">Penulis</th>
            <th class="py-3 border-0" style="font-size: 0.7rem; font-weight: 700; color: #475569; text-transform: uppercase;">Kategori</th>
            <th class="py-3 border-0" style="font-size: 0.7rem; font-weight: 700; color: #475569; text-transform: uppercase;">Harga</th>
            <th class="py-3 border-0" style="font-size: 0.7rem; font-weight: 700; color: #475569; text-transform: uppercase;">Stok</th>
            <th class="pe-4 py-3 border-0" style="font-size: 0.7rem; font-weight: 700; color: #475569; text-transform: uppercase; width: 150px;">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse($books as $book)
          <tr style="border-bottom: 1px solid #f1f5f9;">
            <td class="ps-4 py-3">
              <span class="fw-semibold" style="font-size: 0.85rem; color: #64748b;">{{ $loop->iteration }}</span>
            </td>
            <td class="py-3">
              @if($book->cover)
                <img src="{{ asset('storage/'.$book->cover) }}" 
                     width="45" height="55" 
                     style="object-fit: cover; border-radius: 8px; box-shadow: 0 2px 6px rgba(0,0,0,0.1);">
              @else
                <div class="rounded d-flex align-items-center justify-content-center" 
                     style="width: 45px; height: 55px; background: #f1f5f9; border-radius: 8px;">
                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="2">
                    <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/>
                    <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/>
                  </svg>
                </div>
              @endif
            </td>
            <td class="py-3">
              <div>
                <span class="fw-semibold" style="font-size: 0.9rem; color: #1e293b;">{{ $book->title }}</span>
                <small class="text-muted d-block" style="font-size: 0.65rem;">ID: {{ $book->id }}</small>
              </div>
            </td>
            <td class="py-3">
              <div class="d-flex align-items-center gap-2">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#64748b" stroke-width="2">
                  <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                  <circle cx="12" cy="7" r="4"/>
                </svg>
                <span style="font-size: 0.85rem; color: #475569;">{{ $book->author }}</span>
              </div>
            </td>
            <td class="py-3">
              <span class="badge rounded-pill px-3 py-1" 
                    style="background: rgba(139, 92, 246, 0.1); color: #7c3aed; font-size: 0.7rem; font-weight: 500;">
                {{ $book->category->name }}
              </span>
            </td>
            <td class="py-3">
              <span class="fw-bold" style="color: #10b981; font-size: 0.9rem;">
                {{ $book->formatted_price }}
              </span>
            </td>
            <td class="py-3">
              @if($book->stock > 10)
                <span class="badge rounded-pill px-3 py-1" 
                      style="background: rgba(16, 185, 129, 0.12); color: #059669; font-size: 0.7rem; font-weight: 600;">
                  📦 {{ $book->stock }} tersisa
                </span>
              @elseif($book->stock > 0)
                <span class="badge rounded-pill px-3 py-1" 
                      style="background: rgba(245, 158, 11, 0.12); color: #d97706; font-size: 0.7rem; font-weight: 600;">
                  ⚠️ Stok {{ $book->stock }}
                </span>
              @else
                <span class="badge rounded-pill px-3 py-1" 
                      style="background: rgba(239, 68, 68, 0.12); color: #dc2626; font-size: 0.7rem; font-weight: 600;">
                  ❌ Habis
                </span>
              @endif
             </td>
            <td class="pe-4 py-3">
              <div class="d-flex gap-2">
                <a href="/admin/books/{{ $book->id }}/edit" 
                   class="btn-edit" 
                   style="display: inline-flex; align-items: center; gap: 6px; padding: 6px 14px; 
                          background: linear-gradient(135deg, #fef3c7, #fde68a); 
                          color: #d97706; border: none; border-radius: 8px; 
                          font-size: 0.75rem; font-weight: 600; text-decoration: none;
                          transition: all 0.2s ease;">
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M17 3l4 4-7 7H10v-4l7-7z"/>
                    <path d="M4 20h16"/>
                  </svg>
                  Edit
                </a>
                
                <form method="POST" action="/admin/books/{{ $book->id }}" 
                      class="d-inline delete-form">
                  @csrf 
                  @method('DELETE')
                  <button type="button" class="btn-delete" 
                          data-id="{{ $book->id }}"
                          data-title="{{ $book->title }}"
                          style="display: inline-flex; align-items: center; gap: 6px; padding: 6px 14px; 
                                 background: linear-gradient(135deg, #fee2e2, #fecaca); 
                                 color: #dc2626; border: none; border-radius: 8px; 
                                 font-size: 0.75rem; font-weight: 600;
                                 transition: all 0.2s ease;">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                      <polyline points="3 6 5 6 21 6"/>
                      <path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>
                      <line x1="10" y1="11" x2="10" y2="17"/>
                      <line x1="14" y1="11" x2="14" y2="17"/>
                    </svg>
                    Hapus
                  </button>
                </form>
              </div>
             </td>
          </tr>
          @empty
          <tr>
            <td colspan="8" class="text-center py-5">
              <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="#cbd5e1" stroke-width="1.5" style="margin-bottom: 16px;">
                <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/>
                <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/>
              </svg>
              <p class="text-muted mb-0">Belum ada buku</p>
              <a href="/admin/books/create" class="btn btn-sm btn-primary mt-3 rounded-3">Tambah Buku</a>
            </td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
  
  @if($books->count() > 0)
  <div class="card-footer bg-white border-0 pt-0 pb-4 px-4">
    <div class="d-flex justify-content-between align-items-center">
      <small class="text-muted" id="resultCount">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="display: inline; margin-right: 4px;">
          <circle cx="12" cy="12" r="10"/>
          <line x1="12" y1="8" x2="12" y2="12"/>
          <line x1="12" y1="16" x2="12.01" y2="16"/>
        </svg>
        Menampilkan {{ $books->count() }} buku
      </small>
    </div>
  </div>
  @endif
</div>

<style>
  .btn-edit:hover {
    transform: translateY(-2px);
    filter: brightness(0.98);
    box-shadow: 0 4px 10px rgba(245, 158, 11, 0.2);
    cursor: pointer;
  }
  
  .btn-delete:hover {
    transform: translateY(-2px);
    filter: brightness(0.98);
    box-shadow: 0 4px 10px rgba(220, 38, 38, 0.2);
    cursor: pointer;
  }

  .form-control:focus {
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    outline: none;
  }
  
  .table tbody tr:hover {
    background: #f8fafc;
  }
</style>

<script>
  const searchInput = document.getElementById('searchInput');
  const clearBtn = document.getElementById('clearSearch');
  const tableRows = document.querySelectorAll('#bookTable tbody tr');
  const resultCountSpan = document.getElementById('resultCount');
  
  function updateSearch() {
    const searchText = searchInput.value.toLowerCase();
    let visibleCount = 0;
    
    tableRows.forEach(row => {
      const text = row.textContent.toLowerCase();
      const isVisible = text.includes(searchText);
      row.style.display = isVisible ? '' : 'none';
      if (isVisible) visibleCount++;
    });
    
    if (resultCountSpan) {
      if (searchText) {
        resultCountSpan.innerHTML = `
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="display: inline; margin-right: 4px;">
            <circle cx="11" cy="11" r="8"/>
            <line x1="21" y1="21" x2="16.65" y2="16.65"/>
          </svg>
          Menampilkan ${visibleCount} dari ${tableRows.length} buku
        `;
      } else {
        resultCountSpan.innerHTML = `
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="display: inline; margin-right: 4px;">
            <circle cx="12" cy="12" r="10"/>
            <line x1="12" y1="8" x2="12" y2="12"/>
            <line x1="12" y1="16" x2="12.01" y2="16"/>
          </svg>
          Menampilkan ${tableRows.length} buku
        `;
      }
    }
    
    if (clearBtn) {
      clearBtn.style.display = searchText ? 'block' : 'none';
    }
  }
  
  if (searchInput) {
    searchInput.addEventListener('keyup', updateSearch);
  }
  
  if (clearBtn) {
    clearBtn.addEventListener('click', function() {
      searchInput.value = '';
      updateSearch();
      searchInput.focus();
    });
  }
  
  const deleteButtons = document.querySelectorAll('.btn-delete');
  deleteButtons.forEach(btn => {
    btn.addEventListener('click', function(e) {
      const bookTitle = this.getAttribute('data-title');
      const form = this.closest('form');
      
      const confirmed = confirm(`⚠️ Yakin ingin menghapus buku "${bookTitle}"?\n\nData buku akan dihapus secara permanen.`);
      if (confirmed) {
        form.submit();
      }
    });
  });
</script>

@endsection