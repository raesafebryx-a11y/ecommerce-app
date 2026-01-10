@extends('layouts.app')

@section('title', '  Tokokamikami Premium')

@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<style>
    /* 1. RESET & UTILITY */
    :root {
        --premium-gold: #fbbf24;
        --deep-navy: #020617;
    }

    /* Mencegah icon raksasa secara permanen */
    svg, .bi {
        width: 1.25rem !important;
        height: 1.25rem !important;
        vertical-align: -0.25em;
    }

    /* 2. HERO CINEMATIC REFINEMENT */
    .hero-wrapper {
        position: relative;
        height: 100vh;
        width: 100%;
        overflow: hidden;
        background: var(--deep-navy);
    }

    .hero-video {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        min-width: 100%;
        min-height: 100%;
        object-fit: cover;
        z-index: 0;
        filter: saturate(1.2) brightness(0.7);
    }

    .hero-overlay {
        position: absolute;
        inset: 0;
        background: radial-gradient(circle at 20% 50%, rgba(2, 6, 23, 0.9) 0%, rgba(2, 6, 23, 0.3) 100%);
        z-index: 1;
    }

    .hero-content {
        position: relative;
        z-index: 2;
        height: 100%;
        display: flex;
        align-items: center;
    }

    /* 3. TYPOGRAPHY ART */
    .display-hero {
        font-size: clamp(2.5rem, 6vw, 4.5rem);
        font-weight: 800;
        line-height: 1.1;
        letter-spacing: -2px;
    }

    .text-gold-gradient {
        background: linear-gradient(135deg, #fff 0%, var(--premium-gold) 50%, #f59e0b 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-size: 200% auto;
        animation: shineText 4s infinite linear;
    }

    @keyframes shineText {
        to { background-position: 200% center; }
    }

    /* 4. BUTTON PREMIUM EVOLUTION */
    .btn-lux {
        position: relative;
        padding: 18px 45px;
        background: var(--premium-gold);
        color: var(--deep-navy) !important;
        font-weight: 700;
        border-radius: 100px;
        text-transform: uppercase;
        letter-spacing: 2px;
        overflow: hidden;
        transition: all 0.4s ease;
        border: none;
        z-index: 1;
    }

    .btn-lux::before {
        content: '';
        position: absolute;
        top: 0; left: -100%;
        width: 100%; height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);
        transition: 0.5s;
        z-index: -1;
    }

    .btn-lux:hover::before { left: 100%; }

    .btn-lux:hover {
        transform: scale(1.05);
        box-shadow: 0 15px 40px rgba(251, 191, 36, 0.5);
    }

    /* 5. CATEGORY FLOATING CARDS */
    .glass-card {
        background: rgba(255, 255, 255, 0.03);
        backdrop-filter: blur(15px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 24px;
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
    }

    .glass-card:hover {
        background: rgba(255, 255, 255, 0.08);
        transform: translateY(-15px);
        border-color: var(--premium-gold);
    }

    .img-circle-container {
        width: 90px;
        height: 90px;
        padding: 5px;
        background: linear-gradient(45deg, var(--premium-gold), transparent);
        border-radius: 50%;
        margin: 0 auto;
    }

    /* 6. SECTION DIVIDER CURVE */
    .curve-divider {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        line-height: 0;
        z-index: 3;
    }

    .curve-divider svg {
        position: relative;
        display: block;
        width: calc(100% + 1.3px);
        height: 60px;
        fill: #ffffff; /* Warna menyambung ke section kategori */
    }
</style>

<div class="hero-wrapper">
    <video autoplay muted loop playsinline class="hero-video">
        <source src="{{ asset('images/toko.mp4') }}" type="video/mp4">
    </video>
    <div class="hero-overlay"></div>

    <div class="container hero-content">
        <div class="row align-items-center">
            <div class="col-lg-8 animate__animated animate__fadeInUp">
                <span class="d-inline-block py-2 px-4 rounded-pill mb-4" style="background: rgba(251, 191, 36, 0.15); color: var(--premium-gold); border: 1px solid var(--premium-gold); font-weight: 600;">
                    <i class="bi bi-stars me-2"></i>BELANJA DI TOKOKAMIKAMI
                </span>
                <h1 class="display-hero text-white mb-4">
                    Tingkatkan Hidup Anda dengan <br>
                    <span class="text-gold-gradient">Tokokamikami</span>
                </h1>
                <p class="text-white-50 fs-4 mb-5" style="max-width: 600px; font-weight: 300;">
                    Destinasi eksklusif bagi para pecinta teknologi. Temukan kurasi gadget flagship dunia dalam satu genggaman.
                </p>
                <div class="d-flex gap-4 align-items-center">
                    <a href="{{ route('catalog.index') }}" class="btn-lux">
                        Lihat Produk
                    </a>
                    <a href="#produk" class="text-white text-decoration-none fw-bold border-bottom border-warning pb-1">
                        Lihat Pilihan <i class="bi bi-arrow-right ms-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="curve-divider">
        <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
            <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V120H0V95.83C51.17,70.9,118.52,93.63,205,94.8,268.31,95.66,281.28,63.88,321.39,56.44Z"></path>
        </svg>
    </div>
</div>

<section class="py-5" style="background: #020617; position: relative; z-index: 4; border-top: 1px solid rgba(251, 191, 36, 0.1);">
    {{-- Dekorasi background agar senada dengan hero --}}
    <div style="position: absolute; bottom: 0; left: 0; width: 300px; height: 300px; background: radial-gradient(circle, rgba(251, 191, 36, 0.03) 0%, transparent 70%); z-index: 0;"></div>

    <div class="container py-4 position-relative" style="z-index: 1;">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="fw-bold display-5" style="background: linear-gradient(135deg, #fff 0%, #fbbf24 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Kategori Pilihan</h2>
            <p style="color: rgba(255,255,255,0.6); font-weight: 300;">Pilih kebutuhan teknologi Anda berdasarkan kategori</p>
            <div class="mx-auto mt-3" style="width: 60px; height: 3px; background: #fbbf24; border-radius: 10px;"></div>
        </div>

        <div class="row g-4 justify-content-center">
            @foreach($categories as $category)
                <div class="col-6 col-md-3 col-lg-2" data-aos="zoom-in" data-aos-delay="{{ $loop->index * 50 }}">
                    <a href="{{ route('catalog.index', ['category' => $category->slug]) }}" class="text-decoration-none">
                        <div class="card glass-card p-4 text-center h-100 shadow-sm" style="background: rgba(255, 255, 255, 0.03); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 24px; transition: all 0.4s ease;">
                            <div class="img-circle-container mb-3 shadow" style="width: 90px; height: 90px; padding: 5px; background: linear-gradient(45deg, #fbbf24, transparent); border-radius: 50%; margin: 0 auto;">
                                <img src="{{ $category->image_url }}" class="rounded-circle w-100 h-100" style="object-fit: cover; border: 3px solid #020617;">
                            </div>
                            <h6 class="fw-bold mt-2 mb-0" style="color: #ffffff; letter-spacing: 0.5px;">{{ $category->name }}</h6>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>

<style>
    /* Hover effect khusus kategori agar serasi dengan produk */
    .glass-card:hover {
        background: rgba(255, 255, 255, 0.08) !important;
        transform: translateY(-10px);
        border-color: #fbbf24 !important;
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.5) !important;
    }

    .glass-card:hover h6 {
        color: #fbbf24 !important;
    }

    .glass-card:hover .img-circle-container {
        transform: scale(1.05);
        background: linear-gradient(45deg, #fbbf24, #ffffff) !important;
    }
</style>
<section class="py-5" id="produk" style="background: #020617; position: relative; overflow: hidden;">
    {{-- Aksen Cahaya di Background (Agar tidak flat) --}}
    <div style="position: absolute; top: -10%; right: -5%; width: 400px; height: 400px; background: radial-gradient(circle, rgba(251, 191, 36, 0.05) 0%, transparent 70%); z-index: 0;"></div>

    <div class="container position-relative" style="z-index: 1;">
        <div class="row align-items-end mb-5">
            <div class="col-md-7" data-aos="fade-right">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div style="width: 50px; height: 3px; background: #fbbf24; border-radius: 10px;"></div>
                    <span class="text-warning fw-bold text-uppercase" style="letter-spacing: 3px; font-size: 0.85rem;">Trending Now</span>
                </div>
                <h2 class="fw-bold display-5 text-white mt-2">
                    Produk <span style="background: linear-gradient(135deg, #fff 0%, #fbbf24 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Terpopuler</span>
                </h2>
            </div>
            <div class="col-md-5 text-md-end mt-4" data-aos="fade-left">
                <a href="{{ route('catalog.index') }}" class="btn btn-outline-warning px-5 py-2 rounded-pill fw-bold" style="border-width: 2px; transition: 0.3s;">
                    Lihat Semua Produk <i class="bi bi-arrow-right ms-2"></i>
                </a>
            </div>
        </div>

        <div class="row g-4">
            @foreach($featuredProducts as $product)
                <div class="col-6 col-md-4 col-lg-3" data-aos="zoom-in" data-aos-delay="{{ $loop->index * 100 }}">
                    {{-- Container Card dengan Efek Glassmorphism --}}
                    <div class="h-100 p-2 rounded-4" style="background: rgba(255, 255, 255, 0.03); border: 1px solid rgba(255, 255, 255, 0.05); transition: 0.4s;" onmouseover="this.style.backgroundColor='rgba(255, 255, 255, 0.07)'; this.style.borderColor='#fbbf24';" onmouseout="this.style.backgroundColor='rgba(255, 255, 255, 0.03)'; this.style.borderColor='rgba(255, 255, 255, 0.05)';">
                        @include('partials.product-card', ['product' => $product])
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<style>
    /* Tambahan agar tombol Lihat Semua Produk lebih cantik */
    .btn-outline-warning:hover {
        background-color: #fbbf24 !important;
        color: #020617 !important;
        box-shadow: 0 0 20px rgba(251, 191, 36, 0.4);
    }

    /* Memastikan card produk di dalamnya memiliki teks putih jika diletakkan di bg gelap */
    #produk .card-title, #produk .product-name {
        color: #ffffff !important;
    }
    #produk .text-muted {
        color: rgba(255,255,255,0.5) !important;
    }
</style>

<a href="https://wa.me/6289619869600" class="whatsapp-float shadow-lg" target="_blank">
    <i class="bi bi-whatsapp"></i>
</a>

<style>
    .whatsapp-float {
        position: fixed;
        bottom: 30px;
        right: 30px;
        background: #25d366;
        color: white;
        width: 65px;
        height: 65px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 32px;
        z-index: 9999;
        text-decoration: none;
        box-shadow: 0 0 20px rgba(37, 211, 102, 0.5);
    }
    .whatsapp-float:hover {
        transform: scale(1.1) rotate(10deg);
        background: #128c7e;
    }
</style>

@endsection
