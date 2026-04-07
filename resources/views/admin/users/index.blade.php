@extends('layouts.admin')
@section('title', 'Daftar User')
@section('content')


<div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
  <div>
    <h4 class="fw-bold mb-1" style="color: #1e293b;">
      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="display: inline; margin-right: 8px;">
        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
        <circle cx="12" cy="7" r="4"/>
      </svg>
      Daftar User
    </h4>
    <p class="text-muted small mb-0">Kelola data pengguna yang terdaftar di toko Anda</p>
  </div>
  <div class="d-flex gap-2">
    <span class="badge rounded-pill px-3 py-2" style="background: rgba(59, 130, 246, 0.1); color: #3b82f6; font-size: 0.8rem;">
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="display: inline; margin-right: 4px;">
        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
        <circle cx="12" cy="7" r="4"/>
      </svg>
      Total: {{ $users->count() }} User
    </span>
  </div>
</div>

<div class="row g-3 mb-4">
  <div class="col-md-3">
    <div class="card border-0 shadow-sm rounded-3">
      <div class="card-body p-3">
        <div class="d-flex justify-content-between align-items-center">
          <div>
            <span class="text-muted small text-uppercase fw-semibold">Total User</span>
            <h3 class="fw-bold mt-1 mb-0" style="color: #3b82f6;">{{ $users->count() }}</h3>
          </div>
          <div class="rounded-3 p-2" style="background: rgba(59, 130, 246, 0.1);">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#3b82f6" stroke-width="2">
              <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
              <circle cx="12" cy="7" r="4"/>
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
            <span class="text-muted small text-uppercase fw-semibold">User Aktif</span>
            <h3 class="fw-bold mt-1 mb-0" style="color: #10b981;">{{ $users->count() }}</h3>
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
  <div class="col-md-3">
    <div class="card border-0 shadow-sm rounded-3">
      <div class="card-body p-3">
        <div class="d-flex justify-content-between align-items-center">
          <div>
            <span class="text-muted small text-uppercase fw-semibold">Telepon Terisi</span>
            <h3 class="fw-bold mt-1 mb-0" style="color: #f59e0b;">{{ $users->whereNotNull('phone')->count() }}</h3>
          </div>
          <div class="rounded-3 p-2" style="background: rgba(245, 158, 11, 0.1);">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#f59e0b" stroke-width="2">
              <rect x="5" y="2" width="14" height="20" rx="2" ry="2"/>
              <line x1="12" y1="18" x2="12.01" y2="18"/>
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
            <span class="text-muted small text-uppercase fw-semibold">Bulan Ini</span>
            <h3 class="fw-bold mt-1 mb-0" style="color: #8b5cf6;">{{ $users->filter(function($user) { return $user->created_at->month == now()->month; })->count() }}</h3>
          </div>
          <div class="rounded-3 p-2" style="background: rgba(139, 92, 246, 0.1);">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#8b5cf6" stroke-width="2">
              <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
              <line x1="16" y1="2" x2="16" y2="6"/>
              <line x1="8" y1="2" x2="8" y2="6"/>
              <line x1="3" y1="10" x2="21" y2="10"/>
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
      <h5 class="fw-bold mb-0" style="color: #1e293b;">📋 Daftar User Terdaftar</h5>

      <div class="position-relative" style="width: 280px;">
        <svg class="position-absolute top-50 start-0 translate-middle-y ms-3" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="2" style="z-index: 5;">
          <circle cx="11" cy="11" r="8"/>
          <line x1="21" y1="21" x2="16.65" y2="16.65"/>
        </svg>
        <input type="text" id="searchInput" class="form-control rounded-3" 
               style="padding-left: 38px; border: 1px solid #e2e8f0; font-size: 0.85rem;"
               placeholder="Cari nama atau email...">
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
      <table class="table table-hover align-middle mb-0" id="userTable">
        <thead style="background: #f8fafc; border-bottom: 2px solid #e2e8f0;">
          <tr>
            <th class="ps-4 py-3 border-0" style="font-size: 0.7rem; font-weight: 700; color: #475569; text-transform: uppercase; width: 60px;">No</th>
            <th class="py-3 border-0" style="font-size: 0.7rem; font-weight: 700; color: #475569; text-transform: uppercase;">User</th>
            <th class="py-3 border-0" style="font-size: 0.7rem; font-weight: 700; color: #475569; text-transform: uppercase;">Email</th>
            <th class="py-3 border-0" style="font-size: 0.7rem; font-weight: 700; color: #475569; text-transform: uppercase;">No Telepon</th>
            <th class="py-3 border-0" style="font-size: 0.7rem; font-weight: 700; color: #475569; text-transform: uppercase;">Alamat</th>
            <th class="pe-4 py-3 border-0" style="font-size: 0.7rem; font-weight: 700; color: #475569; text-transform: uppercase; width: 130px;">Bergabung</th>
          </tr>
        </thead>
        <tbody>
          @forelse($users as $user)
          <tr style="border-bottom: 1px solid #f1f5f9;">
            <td class="ps-4 py-3">
              <span class="fw-semibold" style="font-size: 0.85rem; color: #64748b;">{{ $loop->iteration }}</span>
            </td>
            <td class="py-3">
              <div class="d-flex align-items-center gap-3">
                <div class="rounded-circle d-flex align-items-center justify-content-center text-white fw-bold" 
                     style="width: 40px; height: 40px; background: linear-gradient(135deg, #667eea, #764ba2); font-size: 1rem;">
                  {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>
                <div>
                  <span class="fw-semibold" style="font-size: 0.9rem; color: #1e293b;">{{ $user->name }}</span>
                  <small class="text-muted d-block" style="font-size: 0.65rem;">ID: {{ $user->id }}</small>
                </div>
              </div>
            </td>
            <td class="py-3">
              <div class="d-flex align-items-center gap-2">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#64748b" stroke-width="2">
                  <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                  <polyline points="22,6 12,13 2,6"/>
                </svg>
                <span style="font-size: 0.85rem; color: #475569;">{{ $user->email }}</span>
              </div>
            </td>
            <td class="py-3">
              @if($user->phone)
                <span class="badge rounded-pill px-3 py-1" 
                      style="background: rgba(16, 185, 129, 0.1); color: #059669; font-size: 0.75rem; font-weight: 500;">
                  📱 {{ $user->phone }}
                </span>
              @else
                <span class="badge rounded-pill px-3 py-1" 
                      style="background: rgba(100, 116, 139, 0.08); color: #64748b; font-size: 0.7rem; font-weight: 500;">
                  ❌ Belum diisi
                </span>
              @endif
            </td>
            <td class="py-3">
              @if($user->address)
                <div class="d-flex align-items-start gap-2">
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#64748b" stroke-width="2" style="margin-top: 2px;">
                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                    <circle cx="12" cy="10" r="3"/>
                  </svg>
                  <span style="font-size: 0.8rem; color: #475569;" title="{{ $user->address }}">
                    {{ Str::limit($user->address, 35) }}
                  </span>
                </div>
              @else
                <span class="text-muted" style="font-size: 0.8rem;">
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="display: inline; margin-right: 4px;">
                    <circle cx="12" cy="12" r="10"/>
                    <line x1="12" y1="8" x2="12" y2="12"/>
                    <line x1="12" y1="16" x2="12.01" y2="16"/>
                  </svg>
                  Belum diisi
                </span>
              @endif
            </td>
            <td class="pe-4 py-3">
              <div>
                <div class="d-flex align-items-center gap-1" style="font-size: 0.8rem; color: #475569;">
                  <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                    <line x1="16" y1="2" x2="16" y2="6"/>
                    <line x1="8" y1="2" x2="8" y2="6"/>
                    <line x1="3" y1="10" x2="21" y2="10"/>
                  </svg>
                  <span>{{ $user->created_at->format('d/m/Y') }}</span>
                </div>
                <small class="text-muted" style="font-size: 0.65rem;">
                  {{ $user->created_at->format('H:i') }} WIB
                </small>
              </div>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="6" class="text-center py-5">
              <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="#cbd5e1" stroke-width="1.5" style="margin-bottom: 16px;">
                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                <circle cx="12" cy="7" r="4"/>
              </svg>
              <p class="text-muted mb-0">Belum ada user terdaftar</p>
            </td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
  
  @if($users->count() > 0)
  <div class="card-footer bg-white border-0 pt-0 pb-4 px-4">
    <div class="d-flex justify-content-between align-items-center">
      <small class="text-muted" id="resultCount">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="display: inline; margin-right: 4px;">
          <circle cx="12" cy="12" r="10"/>
          <line x1="12" y1="8" x2="12" y2="12"/>
          <line x1="12" y1="16" x2="12.01" y2="16"/>
        </svg>
        Menampilkan {{ $users->count() }} user
      </small>
    </div>
  </div>
  @endif
</div>

<style>

  .form-control:focus {
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    outline: none;
  }
  

  .table tbody tr:hover {
    background: #f8fafc;
  }
  
  .table tbody tr {
    transition: all 0.2s ease;
  }
</style>

<script>
  const searchInput = document.getElementById('searchInput');
  const clearBtn = document.getElementById('clearSearch');
  const tableRows = document.querySelectorAll('#userTable tbody tr');
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
          Menampilkan ${visibleCount} dari ${tableRows.length} user
        `;
      } else {
        resultCountSpan.innerHTML = `
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="display: inline; margin-right: 4px;">
            <circle cx="12" cy="12" r="10"/>
            <line x1="12" y1="8" x2="12" y2="12"/>
            <line x1="12" y1="16" x2="12.01" y2="16"/>
          </svg>
          Menampilkan ${tableRows.length} user
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
</script>

@endsection