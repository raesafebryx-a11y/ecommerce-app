@extends('layouts.admin')

@section('title', 'Daftar Produk')

@section('content')
{{-- HEADER PAGE --}}
<div class="row mb-4">
    <div class="col-md-7">
        <h2 class="h3 fw-bold text-primary mb-1">
            <i class="bi bi-box-seam me-2"></i>Manajemen Produk
        </h2>
        <p class="text-muted small">Total {{ $products->total() }} produk terdaftar di sistem.</p>
    </div>
    <div class="col-md-5 text-md-end">
        <div class="d-inline-flex gap-2 mb-2">
            {{-- Badge Tanggal --}}
            <div class="badge bg-white text-dark border shadow-sm p-2 px-3 rounded-pill d-flex align-items-center">
                <i class="bi bi-calendar3 me-2 text-primary"></i> {{ date('d F Y') }}
            </div>

            {{-- Tombol Lihat Toko --}}
            <a href="/" target="_blank" class="btn btn-white border shadow-sm rounded-pill px-3 fw-bold d-flex align-items-center">
                <i class="bi bi-shop me-2 text-primary"></i> Lihat Toko
            </a>

            {{-- Tombol Keluar --}}
            <button type="button" class="btn btn-white border shadow-sm rounded-pill px-3 fw-bold text-danger d-flex align-items-center"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="bi bi-box-arrow-right me-2"></i> Keluar
            </button>
        </div>

        <div>
            <a href="{{ route('admin.products.create') }}" class="btn btn-primary shadow-sm rounded-pill px-4 fw-bold">
                <i class="bi bi-plus-lg me-1"></i> Tambah Produk Baru
            </a>
        </div>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
    </div>
</div>

{{-- FILTER & SEARCH --}}
<div class="card shadow-sm border-0 mb-4 rounded-3">
    <div class="card-body p-3">
        <form method="GET" action="{{ route('admin.products.index') }}" class="row g-2 align-items-center">
            <div class="col-md-5">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0 text-muted"><i class="bi bi-search"></i></span>
                    <input type="text" name="search" class="form-control border-start-0 ps-0 shadow-none"
                           placeholder="Cari nama produk..." value="{{ request('search') }}">
                </div>
            </div>
            <div class="col-md-3">
                <select name="category" class="form-select border-light-subtle shadow-none">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-light border w-100 fw-semibold text-primary rounded-pill">
                    <i class="bi bi-filter me-1"></i> Filter
                </button>
            </div>
            <div class="col-md-2 text-center">
                <a href="{{ route('admin.products.index') }}" class="btn btn-link btn-sm text-muted text-decoration-none">Reset</a>
            </div>
        </form>
    </div>
</div>

{{-- TABLE --}}
<div class="card shadow-sm border-0 overflow-hidden rounded-3">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light border-bottom">
                <tr>
                    <th class="ps-4 py-3" width="80">Gambar</th>
                    <th class="py-3">Info Produk</th>
                    <th class="py-3">Kategori</th>
                    <th class="py-3">Harga</th>
                    <th class="py-3 text-center">Stok</th>
                    <th class="py-3 text-center">Status</th>
                    <th class="py-3 text-end pe-4" width="180">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                <tr>
                    <td class="ps-4">
                        <img src="{{ $product->primaryImage?->image_url ?? asset('img/no-image.png') }}"
                             class="rounded border shadow-sm" width="60" height="60" style="object-fit: cover;">
                    </td>
                    <td>
                        <div class="fw-bold text-dark mb-0">{{ $product->name }}</div>
                        @if($product->is_featured)
                            <span class="badge bg-warning-subtle text-warning border border-warning-subtle smaller-badge">
                                <i class="bi bi-star-fill me-1"></i>Unggulan
                            </span>
                        @endif
                    </td>
                    <td>
                        <span class="text-secondary small fw-medium">{{ $product->category->name }}</span>
                    </td>
                    <td>
                        @if($product->discount_price && $product->discount_price < $product->price)
                            <div class="fw-bold text-primary">Rp {{ number_format($product->discount_price, 0, ',', '.') }}</div>
                            <small class="text-muted text-decoration-line-through">Rp {{ number_format($product->price, 0, ',', '.') }}</small>
                        @else
                            <div class="fw-bold text-primary">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                        @endif
                    </td>
                    <td class="text-center">
                        @if($product->stock <= 5)
                            <span class="text-danger fw-bold"><i class="bi bi-exclamation-triangle-fill me-1"></i>{{ $product->stock }}</span>
                        @else
                            <span class="text-dark fw-medium">{{ $product->stock }}</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <span class="badge rounded-pill {{ $product->is_active ? 'bg-success-subtle text-success border border-success-subtle' : 'bg-secondary-subtle text-secondary border border-secondary-subtle' }} px-3">
                            {{ $product->is_active ? 'Aktif' : 'Nonaktif' }}
                        </span>
                    </td>
                    <td class="text-end pe-4">
                        <div class="btn-group shadow-sm rounded overflow-hidden border">
                            <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-sm btn-white px-3" title="Edit">
                                <i class="bi bi-pencil-square text-warning"></i>
                            </a>
                            <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('Hapus produk ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-white px-3" title="Hapus">
                                    <i class="bi bi-trash3 text-danger"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center py-5">
                        <i class="bi bi-box-seam display-1 text-light-emphasis mb-3 d-block"></i>
                        <h5 class="text-muted">Produk tidak ditemukan</h5>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="d-flex justify-content-center mt-4">
    {{ $products->links('pagination::bootstrap-5') }}
</div>

<style>
    .smaller-badge { font-size: 0.65rem; padding: 2px 6px; }
    .btn-white { background: #fff; }
    .btn-white:hover { background-color: #f8f9fa; }
    .table-hover tbody tr:hover { background-color: rgba(13, 110, 253, 0.02); }
</style>
@endsection
