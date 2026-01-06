{{-- ================================================
     FILE: resources/views/home.blade.php
     FUNGSI: Halaman utama website
     ================================================ --}}

@extends('layouts.app')

@section('title', 'Beranda')

@section('content')

{{-- HERO --}}
<section class="hero-gradient text-white py-5 position-relative overflow-hidden">
    <div class="container position-relative">
        <div class="row align-items-center min-vh-75">
            <div class="col-lg-6">
                <span class="badge bg-light text-primary mb-3 px-3 py-2 rounded-pill">
                    🔥 Belanja Paling Hemat
                </span>

                <h1 class="display-4 fw-bold mb-3">
                    Belanja Online <span class="text-warning">Murah & Cepat</span>
                </h1>

                <p class="lead opacity-75 mb-4">
                    Produk berkualitas, harga bersahabat, dan gratis ongkir pembelian pertama.
                </p>

                <div class="d-flex gap-3">
                    <a href="{{ route('catalog.index') }}" class="btn btn-warning btn-lg shadow">
                        <i class="bi bi-bag me-2"></i> Mulai Belanja
                    </a>
                    <a href="#produk" class="btn btn-outline-light btn-lg">
                        Lihat Produk
                    </a>
                </div>
            </div>

            <div class="col-lg-6 d-none d-lg-block text-center">
                <video autoplay loop muted playsinline
                       class="rounded-4 shadow-lg"
                       style="max-width:100%">
                    <source src="{{ asset('images/hangker.mp4') }}" type="video/mp4">
                </video>
            </div>
        </div>
    </div>
</section>

{{-- KATEGORI --}}
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center fw-bold mb-5">Kategori Populer</h2>

        <div class="row g-4 justify-content-center">
            @foreach($categories as $category)
                <div class="col-6 col-md-4 col-lg-2">
                    <a href="{{ route('catalog.index', ['category' => $category->slug]) }}"
                       class="text-decoration-none text-dark">
                        <div class="card border-0 shadow-sm text-center h-100 category-card">
                            <div class="card-body">
                                <img src="{{ $category->image_url }}"
                                     alt="{{ $category->name }}"
                                     class="rounded-circle mb-3 shadow-sm"
                                     width="70" height="70"
                                     style="object-fit:cover">
                                <h6 class="fw-semibold mb-1">{{ $category->name }}</h6>
                                <small class="text-muted">{{ $category->products_count }} produk</small>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- PRODUK UNGGULAN --}}
<section class="py-5" id="produk">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold mb-0">🔥 Produk Unggulan</h2>
            <a href="{{ route('catalog.index') }}" class="btn btn-outline-primary rounded-pill">
                Lihat Semua <i class="bi bi-arrow-right"></i>
            </a>
        </div>

        <div class="row g-4">
            @foreach($featuredProducts as $product)
                <div class="col-6 col-md-4 col-lg-3">
                    @include('partials.product-card', ['product' => $product])
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- PROMO --}}
<section class="py-5 bg-dark text-white">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-6">
                <div class="card bg-warning text-dark border-0 h-100 shadow">
                    <div class="card-body d-flex flex-column justify-content-center">
                        <h3 class="fw-bold">⚡ Flash Sale</h3>
                        <p>Diskon hingga 50% untuk produk pilihan</p>
                        <a href="#" class="btn btn-dark w-fit">Lihat Promo</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card bg-primary text-white border-0 h-100 shadow">
                    <div class="card-body d-flex flex-column justify-content-center">
                        <h3 class="fw-bold">🎁 Member Baru</h3>
                        <p>Voucher Rp50.000 untuk pembelian pertama</p>
                        <a href="{{ route('register') }}" class="btn btn-light w-fit">
                            Daftar Sekarang
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- PRODUK TERBARU --}}
<section class="py-5">
    <div class="container">
        <h2 class="text-center fw-bold mb-4">Produk Terbaru</h2>

        <div class="row g-4">
            @foreach($latestProducts as $product)
                <div class="col-6 col-md-4 col-lg-3">
                    @include('partials.product-card', ['product' => $product])
                </div>
            @endforeach
        </div>
    </div>
</section>

@endsection
