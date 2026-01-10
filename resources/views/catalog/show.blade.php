@extends('layouts.app')

@section('title', $product->name)

@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<style>
    /* 1. BACKGROUND YANG SAMA DENGAN KATALOG */
    body {
        background-color: #f8fafc;
    }

    /* 2. PREMIUM TOP NAVIGATION (Sama dengan Katalog) */
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

    /* 3. PRODUCT CARD STYLING */
    .product-detail-card {
        border: none;
        border-radius: 30px;
        overflow: hidden;
        background: white;
        box-shadow: 0 20px 40px rgba(0,0,0,0.04);
    }

    .image-container {
        background: #ffffff;
        padding: 2rem;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100%;
        min-height: 450px;
    }

    .thumbnail-img {
        width: 70px;
        height: 70px;
        object-fit: cover;
        border-radius: 12px;
        cursor: pointer;
        transition: 0.3s;
        border: 2px solid transparent;
    }

    .thumbnail-img:hover, .thumbnail-img.active {
        border-color: #fbbf24;
        transform: translateY(-3px);
    }

    /* 4. TEXT & BUTTON STYLING */
    .text-gold {
        color: #b45309;
        font-weight: 700;
    }

    .price-tag {
        font-size: 2.5rem;
        font-weight: 800;
        color: #020617;
        letter-spacing: -1px;
    }

    .btn-premium-cart {
        background: #020617;
        color: white;
        border: none;
        border-radius: 15px;
        padding: 15px 30px;
        font-weight: 700;
        transition: 0.4s;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .btn-premium-cart:hover {
        background: #fbbf24;
        color: #020617;
        box-shadow: 0 10px 20px rgba(251, 191, 36, 0.4);
        transform: translateY(-3px);
    }

    .breadcrumb-item a {
        color: #64748b;
        text-decoration: none;
        font-weight: 500;
    }

    .breadcrumb-item.active {
        color: #fbbf24;
        font-weight: 700;
    }

    .stock-indicator {
        padding: 8px 16px;
        border-radius: 100px;
        font-size: 0.85rem;
        font-weight: 600;
    }
</style>

<div class="container py-4">

    {{-- TOP BAR (Konsisten dengan Katalog) --}}
    <div class="catalog-nav d-flex justify-content-between align-items-center animate__animated animate__fadeInDown">
        <div class="d-flex align-items-center gap-3">
            <a href="{{ route('catalog.index') }}" class="btn-nav-back shadow-sm">
                <i class="bi bi-arrow-left"></i> Kembali ke Katalog
            </a>
            <div class="vr d-none d-md-block" style="height: 30px; opacity: 0.1;"></div>

            <nav aria-label="breadcrumb" class="d-none d-md-block">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('catalog.index') }}">Katalog</a></li>
                    <li class="breadcrumb-item active">{{ Str::limit($product->name, 20) }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row g-4 animate__animated animate__fadeIn">
        {{-- SISI KIRI: GAMBAR PRODUK --}}
        <div class="col-lg-6">
            <div class="product-detail-card shadow-sm h-100">
                <div class="image-container position-relative">
                    <img src="{{ $product->image_url }}"
                         id="main-image"
                         class="img-fluid animate__animated animate__zoomIn"
                         alt="{{ $product->name }}"
                         style="max-height: 400px; object-fit: contain;">

                    @if($product->has_discount)
                        <span class="badge bg-danger position-absolute top-0 start-0 m-4 px-3 py-2 rounded-pill shadow">
                            Save {{ $product->discount_percentage }}%
                        </span>
                    @endif
                </div>

                @if($product->images->count() > 1)
                <div class="p-4 border-top">
                    <div class="d-flex gap-3 justify-content-center">
                        @foreach($product->images as $image)
                            <img src="{{ asset('storage/' . $image->image_path) }}"
                                 class="thumbnail-img shadow-sm"
                                 onclick="changeImage(this.src, this)">
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>

        {{-- SISI KANAN: INFORMASI PRODUK --}}
        <div class="col-lg-6">
            <div class="product-detail-card p-4 p-md-5 h-100">
                {{-- Kategori --}}
                <span class="text-gold text-uppercase small mb-2 d-block" style="letter-spacing: 2px;">
                    {{ $product->category->name }}
                </span>

                {{-- Judul --}}
                <h1 class="fw-bold text-dark mb-3 display-6">{{ $product->name }}</h1>

                {{-- Harga --}}
                <div class="mb-4 d-flex align-items-center gap-3">
                    <span class="price-tag">{{ $product->formatted_price }}</span>
                    @if($product->has_discount)
                        <span class="text-muted text-decoration-line-through fs-5">
                            {{ $product->formatted_original_price }}
                        </span>
                    @endif
                </div>

                {{-- Status Stok --}}
                <div class="mb-4">
                    @if($product->stock > 10)
                        <span class="stock-indicator bg-success bg-opacity-10 text-success">
                            <i class="bi bi-shield-check me-2"></i>Stok Tersedia Aman
                        </span>
                    @elseif($product->stock > 0)
                        <span class="stock-indicator bg-warning bg-opacity-10 text-warning">
                            <i class="bi bi-exclamation-circle me-2"></i>Stok Terbatas (Hanya {{ $product->stock }})
                        </span>
                    @else
                        <span class="stock-indicator bg-danger bg-opacity-10 text-danger">
                            <i class="bi bi-x-circle me-2"></i>Saat Ini Habis
                        </span>
                    @endif
                </div>

                <hr class="my-4 opacity-10">

                {{-- Form Add to Cart --}}
                <form action="{{ route('cart.add') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">

                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <label class="small fw-bold text-muted mb-2">JUMLAH</label>
                            <div class="input-group shadow-sm" style="border-radius: 12px; overflow: hidden;">
                                <button type="button" class="btn btn-light border-0" onclick="decrementQty()">-</button>
                                <input type="number" name="quantity" id="quantity"
                                       value="1" min="1" max="{{ $product->stock }}"
                                       class="form-control text-center border-0 fw-bold" readonly>
                                <button type="button" class="btn btn-light border-0" onclick="incrementQty()">+</button>
                            </div>
                        </div>
                        <div class="col-md-8 d-flex align-items-end">
                            <button type="submit" class="btn btn-premium-cart w-100 shadow"
                                    @if($product->stock == 0) disabled @endif>
                                <i class="bi bi-bag-plus-fill me-2"></i> Tambah Ke Keranjang
                            </button>
                        </div>
                    </div>
                </form>

                {{-- Wishlist & Action --}}
                <div class="d-flex gap-2 mb-5">
                    @auth
                        <button onclick="toggleWishlist({{ $product->id }})"
                                class="btn btn-outline-danger border-0 rounded-pill px-4 fw-bold">
                            <i class="bi {{ auth()->user()->hasInWishlist($product) ? 'bi-heart-fill' : 'bi-heart' }} me-2"></i>
                            Sukai Produk
                        </button>
                    @endauth
                </div>

                {{-- Deskripsi --}}
                <div class="description-box">
                    <h6 class="fw-bold text-dark text-uppercase mb-3" style="letter-spacing: 1px;">Deskripsi Produk</h6>
                    <div class="text-muted lh-lg" style="font-size: 0.95rem;">
                        {!! nl2br(e($product->description)) !!}
                    </div>
                </div>

                <div class="row mt-5 g-3">
                    <div class="col-6">
                        <div class="p-3 bg-light rounded-4 text-center">
                            <i class="bi bi-box-seam text-warning mb-2 d-block fs-4"></i>
                            <span class="small text-muted d-block">Berat Produk</span>
                            <span class="fw-bold">{{ $product->weight }} gram</span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="p-3 bg-light rounded-4 text-center">
                            <i class="bi bi-shield-lock text-warning mb-2 d-block fs-4"></i>
                            <span class="small text-muted d-block">Kode Produk</span>
                            <span class="fw-bold">PROD-{{ $product->id }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function changeImage(src, element) {
        document.getElementById('main-image').src = src;
        // Reset and Set active thumbnail
        document.querySelectorAll('.thumbnail-img').forEach(img => img.classList.remove('active'));
        element.classList.add('active');

        // Trigger Animation
        const mainImg = document.getElementById('main-image');
        mainImg.classList.remove('animate__zoomIn');
        void mainImg.offsetWidth; // trigger reflow
        mainImg.classList.add('animate__zoomIn');
    }

    function incrementQty() {
        const input = document.getElementById('quantity');
        const max = parseInt(input.max);
        if (parseInt(input.value) < max) {
            input.value = parseInt(input.value) + 1;
        }
    }

    function decrementQty() {
        const input = document.getElementById('quantity');
        if (parseInt(input.value) > 1) {
            input.value = parseInt(input.value) - 1;
        }
    }
</script>
@endpush
@endsection
