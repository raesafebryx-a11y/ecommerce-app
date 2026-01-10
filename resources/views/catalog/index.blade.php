@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<style>
    body { background-color: #f8fafc; }

    /* 1. TOP NAVIGATION BAR */
    .catalog-nav {
        background: white;
        border-radius: 20px;
        padding: 15px 25px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.03);
        margin-bottom: 30px;
    }

    .btn-nav-back {
        background: #fff;
        border: 1px solid #e2e8f0;
        color: #020617;
        font-weight: 700;
        padding: 10px 20px;
        border-radius: 100px;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-nav-back:hover {
        background: #f8fafc;
        border-color: #fbbf24;
        color: #fbbf24;
        transform: translateX(-5px);
    }

    /* 2. FILTER & CARD STYLING */
    .filter-card {
        border: none;
        border-radius: 25px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.04);
    }

    .category-link {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 12px 15px;
        border-radius: 15px;
        color: #64748b;
        text-decoration: none;
        transition: all 0.3s;
        margin-bottom: 5px;
    }

    .category-link:hover, .category-link.active {
        background: rgba(251, 191, 36, 0.1);
        color: #b45309;
        font-weight: 600;
    }

    .btn-apply {
        background: #020617;
        color: white;
        border-radius: 15px;
        padding: 12px;
        font-weight: 600;
        border: none;
        transition: 0.3s;
    }

    .btn-apply:hover {
        background: #fbbf24;
        color: #020617;
    }
</style>

<div class="container py-4">

    <div class="catalog-nav d-flex justify-content-between align-items-center animate__animated animate__fadeInDown">
        <div class="d-flex align-items-center gap-3">
            <a href="/" class="btn-nav-back shadow-sm">
                <i class="bi bi-house-door-fill"></i> Lihat Toko
            </a>
            <div class="vr d-none d-md-block" style="height: 30px; opacity: 0.1;"></div>
            <h5 class="mb-0 fw-bold text-dark d-none d-md-block">Katalog Produk</h5>
        </div>

        <div class="d-flex gap-2">
            @auth
                @if(auth()->user()->is_admin)
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-primary btn-sm rounded-pill px-3 fw-bold shadow-sm">
                        <i class="bi bi-speedometer2 me-1"></i> Dashboard
                    </a>
                @endif
            @endauth
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-3">
            <div class="card filter-card p-3 sticky-top" style="top: 20px;">
                <div class="card-body">
                    <h6 class="fw-bold mb-4 text-uppercase" style="letter-spacing: 1px;">Filter Produk</h6>

                    <form action="{{ route('catalog.index') }}" method="GET">
                        @if(request('q')) <input type="hidden" name="q" value="{{ request('q') }}"> @endif

                        <div class="mb-4">
                            <label class="small fw-bold text-muted mb-2 d-block">KATEGORI</label>
                            <div class="scroll-area" style="max-height: 300px; overflow-y: auto;">
                                <a href="{{ route('catalog.index') }}" class="category-link {{ !request('category') ? 'active' : '' }}">
                                    <span>Semua Kategori</span>
                                    <i class="bi bi-grid-fill"></i>
                                </a>
                                @foreach($categories as $cat)
                                    <a href="{{ route('catalog.index', ['category' => $cat->slug]) }}"
                                       class="category-link {{ request('category') == $cat->slug ? 'active' : '' }}">
                                        <span class="text-truncate">{{ $cat->name }}</span>
                                        <span class="badge bg-light text-dark rounded-pill">{{ $cat->products_count }}</span>
                                    </a>
                                @endforeach
                            </div>
                        </div>

                        <hr class="opacity-10">

                        <div class="mb-4">
                            <label class="small fw-bold text-muted mb-3 d-block">RENTANG HARGA</label>
                            <div class="input-group input-group-sm mb-2 shadow-sm">
                                <span class="input-group-text bg-white border-end-0 text-muted">Rp</span>
                                <input type="number" name="min_price" class="form-control border-start-0" placeholder="Min" value="{{ request('min_price') }}">
                            </div>
                            <div class="input-group input-group-sm mb-3 shadow-sm">
                                <span class="input-group-text bg-white border-end-0 text-muted">Rp</span>
                                <input type="number" name="max_price" class="form-control border-start-0" placeholder="Max" value="{{ request('max_price') }}">
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn-apply shadow">
                                Terapkan Filter
                            </button>
                            <a href="{{ route('catalog.index') }}" class="btn btn-link btn-sm text-muted text-decoration-none">Reset Filter</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-9">
            <div class="d-flex justify-content-between align-items-center mb-4 px-2">
                <div>
                    <p class="text-muted small mb-0">Menampilkan {{ $products->count() }} produk dari total {{ $products->total() }}</p>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <span class="small text-muted d-none d-sm-block">Urutan:</span>
                    <form method="GET">
                        @foreach(request()->except('sort') as $key => $value)
                            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                        @endforeach
                        <select name="sort" class="form-select form-select-sm rounded-pill border-0 shadow-sm" onchange="this.form.submit()">
                            <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Terbaru</option>
                            <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Termurah</option>
                            <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Termahal</option>
                        </select>
                    </form>
                </div>
            </div>

            <div class="row g-4">
                @forelse($products as $product)
                    <div class="col-sm-6 col-md-4 animate__animated animate__fadeInUp">
                        <x-product-card :product="$product" />
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <img src="https://cdn-icons-png.flaticon.com/512/6134/6134065.png" width="120" class="mb-3 opacity-50">
                        <h5 class="fw-bold">Produk Tidak Ditemukan</h5>
                        <p class="text-muted">Coba gunakan filter atau kata kunci lain.</p>
                    </div>
                @endforelse
            </div>

            <div class="d-flex justify-content-center mt-5">
                {{ $products->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
</div>

@endsection
