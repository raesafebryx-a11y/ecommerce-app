@extends('layouts.app')

@section('content')

{{-- HEADER PAGE --}}
<div class="row mb-2">
    <div class="col-md-5">
    </div>
<div class="col-md-5 text-md-end">
        <div class="d-inline-flex gap-2">
    {{-- Ke Halaman Depan Toko --}}
    <a href="/" class="btn btn-white border shadow-sm rounded-pill px-3 fw-bold btn-sm">
        <i class="bi bi-shop me-1 text-primary"></i> Lihat Toko
    </a>

    {{-- Keluar ke Halaman Login --}}
    <button type="button" class="btn btn-white border shadow-sm rounded-pill px-3 fw-bold text-danger btn-sm"
        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="bi bi-box-arrow-right me-1"></i> Keluar
    </button>
</div>

<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
    @csrf
</form>

{{-- Form Logout --}}
<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
    @csrf
</form>

        {{-- Form Logout --}}
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>
</div>
<div class="container py-5">
    {{-- HEADER PAGE (Hanya Muncul Jika Login sebagai Admin) --}}
    @auth
        @if(auth()->user()->is_admin)
        <div class="row mb-4">
            <div class="col-md-7">
                <h2 class="h3 fw-bold text-primary mb-1">
                    <i class="bi bi-eye me-2"></i>Mode Pratinjau Toko
                </h2>
                <p class="text-muted small">Anda sedang melihat tampilan toko dari sisi pelanggan.</p>
            </div>
            <div class="col-md-5 text-md-end">
                <div class="d-inline-flex gap-2">
                    {{-- Badge Tanggal --}}
                    <div class="badge bg-white text-dark border shadow-sm p-2 px-3 rounded-pill d-flex align-items-center">
                        <i class="bi bi-calendar3 me-2 text-primary"></i> {{ date('d F Y') }}
                    </div>

                    {{-- Tombol Kembali ke Admin (Pengganti Lihat Toko) --}}
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-white border shadow-sm rounded-pill px-3 fw-bold d-flex align-items-center text-primary">
                        <i class="bi bi-speedometer2 me-2"></i> Dashboard Admin
                    </a>

                    {{-- Tombol Keluar --}}
                    <button type="button" class="btn btn-white border shadow-sm rounded-pill px-3 fw-bold text-danger d-flex align-items-center"
                        onclick="event.preventDefault(); if(confirm('Yakin ingin keluar?')) document.getElementById('logout-form').submit();">
                        <i class="bi bi-box-arrow-right me-2"></i> Keluar
                    </button>
                </div>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
            </div>
        </div>
        @endif
    @endauth

    <div class="row g-4">
        {{-- SIDEBAR FILTER --}}
        <div class="col-lg-3">
            <div class="card border-0 shadow-sm sticky-top" style="top: 20px;">
                <div class="card-header bg-white py-3 border-bottom-0">
                    <h5 class="card-title mb-0 fw-bold"><i class="bi bi-filter-left me-2"></i>Filter Produk</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('catalog.index') }}" method="GET">
                        @if(request('q')) <input type="hidden" name="q" value="{{ request('q') }}"> @endif

                        {{-- Filter Kategori --}}
                        <div class="mb-4">
                            <label class="form-label fw-semibold mb-3">Kategori</label>
                            <div class="category-list scroll-area" style="max-height: 250px; overflow-y: auto;">
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="category" id="cat-all" value=""
                                        {{ !request('category') ? 'checked' : '' }} onchange="this.form.submit()">
                                    <label class="form-check-label text-secondary" for="cat-all">Semua Kategori</label>
                                </div>
                                @foreach($categories as $cat)
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="radio" name="category" id="cat-{{ $cat->slug }}" value="{{ $cat->slug }}"
                                            {{ request('category') == $cat->slug ? 'checked' : '' }}
                                            onchange="this.form.submit()">
                                        <label class="form-check-label d-flex justify-content-between align-items-center" for="cat-{{ $cat->slug }}">
                                            <span>{{ $cat->name }}</span>
                                            <span class="badge rounded-pill bg-light text-dark fw-normal">{{ $cat->products_count }}</span>
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <hr class="text-muted opacity-25">

                        {{-- Filter Harga --}}
                        <div class="mb-4">
                            <label class="form-label fw-semibold mb-3">Rentang Harga (Rp)</label>
                            <div class="input-group input-group-sm mb-2">
                                <span class="input-group-text bg-light border-end-0">Min</span>
                                <input type="number" name="min_price" class="form-control border-start-0" placeholder="0" value="{{ request('min_price') }}">
                            </div>
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text bg-light border-end-0">Max</span>
                                <input type="number" name="max_price" class="form-control border-start-0" placeholder="Tanpa batas" value="{{ request('max_price') }}">
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary shadow-sm rounded-pill">
                                <i class="bi bi-sliders me-1"></i> Terapkan
                            </button>
                            <a href="{{ route('catalog.index') }}" class="btn btn-light btn-sm text-muted rounded-pill">Reset Filter</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- PRODUCT GRID --}}
        <div class="col-lg-9">
            {{-- Header Toolbar --}}
            <div class="card border-0 shadow-sm mb-4 rounded-3">
                <div class="card-body py-3 d-flex flex-column flex-md-row justify-content-between align-items-md-center">
                    <div>
                        <h4 class="fw-bold mb-1">Katalog Produk</h4>
                        <p class="text-muted small mb-0">Menampilkan {{ $products->count() }} produk dari total {{ $products->total() }}</p>
                    </div>

                    <div class="mt-3 mt-md-0 d-flex align-items-center">
                        <span class="text-muted small me-2 flex-nowrap">Urutkan:</span>
                        <form method="GET" class="d-inline-block">
                            @foreach(request()->except('sort') as $key => $value)
                                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                            @endforeach
                            <select name="sort" class="form-select form-select-sm border-0 bg-light fw-semibold rounded-pill" onchange="this.form.submit()" style="cursor: pointer;">
                                <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Terbaru</option>
                                <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Harga Terendah</option>
                                <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Harga Tertinggi</option>
                            </select>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Grid --}}
            <div class="row g-4">
                @forelse($products as $product)
                    <div class="col-sm-6 col-md-4">
                        <x-product-card :product="$product" />
                    </div>
                @empty
                    <div class="col-12">
                        <div class="text-center py-5">
                            <i class="bi bi-search-heart text-muted display-1"></i>
                            <h5 class="mt-3">Ups! Produk tidak ditemukan</h5>
                            <p class="text-muted">Coba sesuaikan filter atau kata kunci pencarian Anda.</p>
                            <a href="{{ route('catalog.index') }}" class="btn btn-primary rounded-pill px-4">Lihat Semua Produk</a>
                        </div>
                    </div>
                @endforelse
            </div>

            {{-- Pagination --}}
            <div class="d-flex justify-content-center mt-5">
                {{ $products->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
</div>

<style>
    .btn-white { background-color: #fff; border-color: #dee2e6; color: #212529; }
    .btn-white:hover { background-color: #f8f9fa; border-color: #dee2e6; }
</style>
@endsection
