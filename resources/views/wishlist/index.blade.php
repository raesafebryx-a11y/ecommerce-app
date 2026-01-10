{{-- resources/views/wishlist/index.blade.php --}}

@extends('layouts.app')
@section('title', 'Wishlist Saya')

@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<style>
    /* 1. BACKGROUND & LAYOUT CONSISTENCY */
    body { background-color: #f8fafc; }

    /* Navigasi Atas (Sama dengan Katalog/Cart/Profile) */
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

    /* 2. EMPTY STATE PREMIUM */
    .empty-wishlist-card {
        background: white;
        border: none;
        border-radius: 30px;
        box-shadow: 0 15px 35px rgba(0,0,0,0.03);
        padding: 80px 20px;
    }

    .heart-icon-wrapper {
        width: 100px;
        height: 100px;
        background: rgba(251, 191, 36, 0.1);
        color: #fbbf24;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        margin: 0 auto 25px;
        font-size: 3rem;
        animation: pulse-gold 2s infinite;
    }

    @keyframes pulse-gold {
        0% { box-shadow: 0 0 0 0 rgba(251, 191, 36, 0.4); }
        70% { box-shadow: 0 0 0 20px rgba(251, 191, 36, 0); }
        100% { box-shadow: 0 0 0 0 rgba(251, 191, 36, 0); }
    }

    .btn-premium-start {
        background: #020617;
        color: white;
        border-radius: 15px;
        padding: 12px 30px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: 0.3s;
        text-decoration: none;
        display: inline-block;
    }

    .btn-premium-start:hover {
        background: #fbbf24;
        color: #020617;
        box-shadow: 0 10px 20px rgba(251, 191, 36, 0.3);
        transform: translateY(-3px);
    }
</style>

<div class="container py-4">

    {{-- TOP BAR (Sesuai Identitas Toko) --}}
    <div class="catalog-nav d-flex justify-content-between align-items-center animate__animated animate__fadeInDown">
        <div class="d-flex align-items-center gap-3">
            <a href="{{ route('catalog.index') }}" class="btn-nav-back shadow-sm">
                <i class="bi bi-arrow-left"></i> Kembali Belanja
            </a>
            <div class="vr d-none d-md-block" style="height: 30px; opacity: 0.1;"></div>
            <h5 class="mb-0 fw-bold text-dark"><i class="bi bi-heart-fill text-danger me-2"></i>Wishlist Saya</h5>
        </div>
        <div class="d-none d-md-block">
            <span class="text-muted small fw-medium">Tersimpan: <strong>{{ $products->total() }} Produk</strong></span>
        </div>
    </div>

    @if($products->count())
        {{-- GRID PRODUK (Menggunakan x-product-card yang sudah kita buat) --}}
        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-4 animate__animated animate__fadeInUp">
            @foreach($products as $product)
                <div class="col">
                     <x-product-card :product="$product" />
                </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center mt-5">
            {{ $products->links() }}
        </div>
    @else
        {{-- EMPTY STATE PREMIUM --}}
        <div class="empty-wishlist-card text-center animate__animated animate__zoomIn">
            <div class="heart-icon-wrapper">
                <i class="bi bi-heart-fill"></i>
            </div>
            <h3 class="fw-bold text-dark mb-2">Wishlist Masih Kosong</h3>
            <p class="text-muted mb-4 mx-auto" style="max-width: 400px;">
                Sepertinya kamu belum menyimpan produk favoritmu. Jelajahi katalog kami dan temukan barang impianmu sekarang!
            </p>
            <a href="{{ route('catalog.index') }}" class="btn-premium-start shadow-sm">
                <i class="bi bi-search me-2"></i> Cari Produk Seru
            </a>
        </div>
    @endif
</div>

@endsection
