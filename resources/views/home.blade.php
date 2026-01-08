@extends('layouts.app')

@section('title', 'Beranda - Toko Premium')

@section('content')

<style>
    /* Warna Deep Navy & Slate (Elegan, tidak mencolok) */
    .hero-gradient {
        background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
        position: relative;
    }

    .text-soft-glow {
        color: #fbbf24;
        text-shadow: 0 0 15px rgba(251, 191, 36, 0.2);
    }

    /* Video Frame Styling */
    .video-frame {
        padding: 8px;
        background: rgba(255, 255, 255, 0.03);
        border-radius: 24px;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
    }

    .main-video {
        height: 480px;
        object-fit: cover;
        border-radius: 18px;
    }

    /* Button Styling */
    .btn-premium-gold {
        background: #fbbf24;
        border: none;
        color: #0f172a;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-premium-gold:hover {
        background: #f59e0b;
        transform: translateY(-2px);
        box-shadow: 0 10px 15px -3px rgba(251, 191, 36, 0.3);
    }

    /* Card Styling */
    .card-premium {
        transition: all 0.3s ease;
        border: 1px solid #f1f5f9;
    }

    .card-premium:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.05) !important;
        border-color: #fbbf24;
    }

    /* Carousel Customization */
    .carousel-indicators [data-bs-target] {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background-color: #fbbf24;
    }
</style>

{{-- HERO SECTION --}}
<section class="hero-gradient text-white py-5 position-relative">
    <div class="container py-lg-5">
        <div class="row align-items-center g-5">
            {{-- KIRI: TEKS --}}
            <div class="col-lg-4 text-center text-lg-start">
                <span class="badge bg-white bg-opacity-10 text-white mb-3 px-3 py-2 rounded-pill border border-white border-opacity-25">
                    ✨ Koleksi Eksklusif 2026
                </span>
                <h1 class="display-4 fw-bold mb-3">
                    Gaya Hidup <br>
                    <span class="text-soft-glow">Lebih Berkelas</span>
                </h1>
                <p class="lead text-white-50 mb-4 fs-5">
                    Kualitas premium dalam satu genggaman.
                </p>
                <div class="d-flex gap-3 justify-content-center justify-content-lg-start">
                    <a href="{{ route('catalog.index') }}" class="btn btn-premium-gold btn-lg px-4 py-3 rounded-3 shadow">
                        Jelajahi Produk
                    </a>
                </div>
            </div>

            {{-- KANAN: SATU BINGKAI DUA VIDEO --}}
            <div class="col-lg-8">
                <div class="combined-video-frame">
                    <div class="video-flex-container">
                        <video autoplay loop muted playsinline class="unified-video border-end-v">
                            <source src="{{ asset('images/toko.mp4') }}" type="video/mp4">
                        </video>
                        <video autoplay loop muted playsinline class="unified-video">
                            <source src="{{ asset('images/toko2.mp4') }}" type="video/mp4">
                        </video>
                    </div>
                    {{-- Overlay pemanis agar terlihat menyatu --}}
                    <div class="frame-reflection"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    /* Bingkai Utama */
    .combined-video-frame {
        position: relative;
        padding: 6px;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 24px;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        overflow: hidden;
        box-shadow: 0 30px 60px -12px rgba(0, 0, 0, 0.5);
    }

    /* Kontainer Flex agar video menempel */
    .video-flex-container {
        display: flex;
        border-radius: 18px;
        overflow: hidden;
        background: #000;
    }

    .unified-video {
        width: 50%; /* Masing-masing ambil setengah lebar */
        height: 450px;
        object-fit: cover;
        transition: transform 0.6s ease;
    }

    /* Garis tipis pemisah antar video agar tetap rapi */
    .border-end-v {
        border-right: 2px solid rgba(255, 255, 255, 0.1);
    }

    /* Efek kilauan kaca di atas bingkai agar realistis */
    .frame-reflection {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 50%);
        pointer-events: none;
        z-index: 2;
    }

    .combined-video-frame:hover .unified-video {
        transform: scale(1.05);
    }

    /* Penyesuaian HP */
    @media (max-width: 768px) {
        .unified-video {
            height: 300px;
        }
        .video-flex-container {
            flex-direction: column; /* Jadi tumpuk atas bawah di HP agar tidak kekecilan */
        }
        .unified-video {
            width: 100%;
        }
        .border-end-v {
            border-right: none;
            border-bottom: 2px solid rgba(255, 255, 255, 0.1);
        }
    }
</style>

{{-- KATEGORI --}}
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold h1 text-dark">Kategori Pilihan</h2>
            <div class="bg-warning mx-auto mt-2" style="width: 50px; height: 3px;"></div>
        </div>

        <div class="row g-4 justify-content-center">
            @foreach($categories as $category)
                <div class="col-6 col-md-4 col-lg-2 text-center">
                    <a href="{{ route('catalog.index', ['category' => $category->slug]) }}" class="text-decoration-none">
                        <div class="card border-0 shadow-sm card-premium py-4 rounded-4">
                            <img src="{{ $category->image_url }}" class="rounded-circle mx-auto mb-3" width="70" height="70" style="object-fit:cover;">
                            <h6 class="fw-bold text-dark mb-0 px-2">{{ $category->name }}</h6>
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
        <div class="d-flex justify-content-between align-items-center mb-5">
            <h2 class="fw-bold h2">Terpopuler</h2>
            <a href="{{ route('catalog.index') }}" class="text-primary text-decoration-none fw-semibold">
                Lihat Semua Produk <i class="bi bi-arrow-right ms-1"></i>
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

{{-- WHATSAPP --}}
<section class="py-5 bg-white border-top">
    <div class="container text-center">
        <h2 class="fw-bold mb-3">Ada Pertanyaan?</h2>
        <p class="text-muted mb-4 fs-5">Hubungi layanan pelanggan kami untuk bantuan lebih lanjut.</p>
        <a href="https://wa.me/6289619869600" target="_blank" class="btn btn-dark btn-lg px-5 py-3 rounded-pill fw-bold shadow-sm">
            <i class="bi bi-whatsapp me-2 text-success"></i> Chat Admin
        </a>
    </div>
</section>

@endsection
