{{-- ================================================
     FILE: resources/views/home.blade.php
     FUNGSI: Halaman utama website - VERSI MENYALA 🔥
     ================================================ --}}

@extends('layouts.app')

@section('title', 'Beranda - Toko Paling Menyala')

@section('content')

<style>
    /* Custom Styling untuk Efek Menyala */
    .hero-gradient {
        background: linear-gradient(135deg, #1a1a1a 0%, #3a0ca3 100%);
        position: relative;
    }

    .text-glow {
        text-shadow: 0 0 15px rgba(255, 215, 0, 0.5);
    }

    .card-menyala {
        transition: all 0.3s ease-in-out;
        border: 1px solid rgba(0,0,0,0.05);
    }

    .card-menyala:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(58, 12, 163, 0.15) !important;
        border-color: #3a0ca3;
    }

    .btn-gradient-warning {
        background: linear-gradient(45deg, #f7b733, #fc4a1a);
        border: none;
        color: white;
        font-weight: bold;
    }

    .btn-gradient-warning:hover {
        background: linear-gradient(45deg, #fc4a1a, #f7b733);
        transform: scale(1.05);
        color: white;
    }

    .floating-anim {
        animation: floating 3s ease-in-out infinite;
    }

    @keyframes floating {
        0% { transform: translate(0, 0px); }
        50% { transform: translate(0, 15px); }
        100% { transform: translate(0, -0px); }
    }
</style>

{{-- HERO SECTION --}}
<section class="hero-gradient text-white py-5 position-relative overflow-hidden">
    <div class="container position-relative py-5">
        <div class="row align-items-center min-vh-75">
            <div class="col-lg-6">
                <span class="badge bg-warning text-dark mb-3 px-3 py-2 rounded-pill fw-bold animate__animated animate__fadeInDown">
                    🚀 KUALITAS ELITE, HARGA SULIT
                </span>

                <h1 class="display-3 fw-black mb-3 animate__animated animate__fadeInLeft">
                    Belanja Online <br>
                    <span class="text-warning text-glow">Makin Menyala!</span> 🔥
                </h1>

                <p class="lead opacity-75 mb-4 fs-4">
                    Gak usah pusing harga. Produk premium, layanan bintang lima,
                    dan <strong>gratis ongkir</strong> tanpa drama!
                </p>

                <div class="d-flex gap-3 animate__animated animate__fadeInUp animate__delay-1s">
                    <a href="{{ route('catalog.index') }}" class="btn btn-gradient-warning btn-lg px-4 py-3 shadow-lg">
                        <i class="bi bi-rocket-takeoff me-2"></i> Gass Belanja!
                    </a>
                    <a href="#produk" class="btn btn-outline-light btn-lg px-4 py-3">
                        Cek Katalog
                    </a>
                </div>
            </div>

            <div class="col-lg-6 d-none d-lg-block text-center floating-anim">
                <div class="position-relative">
                    {{-- Efek Cahaya di Belakang Video --}}
                    <div class="position-absolute top-50 start-50 translate-middle bg-primary rounded-circle opacity-25 blur-3xl"
                         style="width: 400px; height: 400px; filter: blur(80px);"></div>

                    <video autoplay loop muted playsinline
                           class="rounded-5 shadow-2xl border border-warning border-4"
                           style="max-width:90%; position: relative; z-index: 1;">
                        <source src="{{ asset('images/toko.mp4') }}" type="video/mp4">
                    </video>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- KATEGORI POPULER --}}
<section class="py-5 bg-white">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold display-6">Pilih Sesuai <span class="text-primary">Vibesmu</span></h2>
            <div class="bg-primary mx-auto" style="width: 80px; height: 5px; border-radius: 10px;"></div>
        </div>

        <div class="row g-4 justify-content-center">
            @foreach($categories as $category)
                <div class="col-6 col-md-4 col-lg-2">
                    <a href="{{ route('catalog.index', ['category' => $category->slug]) }}"
                       class="text-decoration-none text-dark">
                        <div class="card border-0 shadow-sm text-center h-100 card-menyala py-3">
                            <div class="card-body">
                                <div class="mb-3 position-relative">
                                    <img src="{{ $category->image_url }}"
                                         alt="{{ $category->name }}"
                                         class="rounded-circle shadow"
                                         width="80" height="80"
                                         style="object-fit:cover; border: 3px solid #f8f9fa">
                                </div>
                                <h6 class="fw-bold mb-1">{{ $category->name }}</h6>
                                <span class="badge bg-light text-muted">{{ $category->products_count }} Items</span>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- FLASH SALE BANNER --}}
<section class="py-4">
    <div class="container">
        <div class="rounded-5 p-4 p-lg-5 text-white shadow-lg"
             style="background: linear-gradient(90deg, #ff416c, #ff4b2b);">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h2 class="display-5 fw-bold mb-2">⚡ FLASH SALE KEBUT!</h2>
                    <p class="mb-0 fs-5">Siapa cepat dia dapat, diskon ugal-ugalan sampai 70%!</p>
                </div>
                <div class="col-md-4 text-md-end mt-3 mt-md-0">
                    <a href="#" class="btn btn-light btn-lg rounded-pill fw-bold px-5 py-3 text-danger shadow">
                        Sikat Sekarang!
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- PRODUK UNGGULAN --}}
<section class="py-5" id="produk">
    <div class="container">
        <div class="d-flex justify-content-between align-items-end mb-4">
            <div>
                <h2 class="fw-bold mb-0 display-6">🔥 Produk <span class="text-danger">Paling Hot</span></h2>
                <p class="text-muted">Jangan sampai kehabisan, Abangku!</p>
            </div>
            <a href="{{ route('catalog.index') }}" class="btn btn-link text-primary fw-bold text-decoration-none">
                Lihat Semua <i class="bi bi-arrow-right-circle-fill ms-2"></i>
            </a>
        </div>

        <div class="row g-4">
            @foreach($featuredProducts as $product)
                <div class="col-6 col-md-4 col-lg-3 animate__animated animate__fadeIn">
                    @include('partials.product-card', ['product' => $product])
                </div>
            @endforeach
        </div>
    </div>
</section>

<section class="py-5 bg-dark position-relative overflow-hidden">
    {{-- Dekorasi Cahaya --}}
    <div class="position-absolute bottom-0 start-50 translate-middle-x w-100 h-100"
         style="background: radial-gradient(circle at bottom, rgba(25, 135, 84, 0.15) 0%, transparent 70%); pointer-events: none;">
    </div>

    <div class="container py-5 text-center text-white position-relative" style="z-index: 2;">
        <div class="mb-4">
            <div class="d-inline-block p-4 rounded-circle bg-success bg-opacity-10 mb-3 border border-success border-opacity-25">
                <i class="bi bi-whatsapp text-success display-1 animate__animated animate__pulse animate__infinite"></i>
            </div>

            <h2 class="display-5 fw-bold mb-3">Tanya-Tanya <span class="text-success">Admin Tokokamikami</span> Sekarang!</h2>
            <p class="lead mb-4 opacity-75 mx-auto" style="max-width: 600px;">
                Gak perlu simpan nomor! Klik tombol di bawah untuk langsung chat Admin mengenai stok, promo, atau bantuan belanja.
            </p>
        </div>

        <div class="d-flex justify-content-center">
            {{-- Link WhatsApp dengan nomor 089619869600 --}}
            <a href="https://wa.me/6289619869600?text=Halo%20Admin%2C%20saya%20mau%20tanya%20produknya%20dong!"
               target="_blank"
               class="btn btn-success btn-lg px-5 py-3 rounded-pill fw-bold shadow-lg transform-hover d-flex align-items-center">
                <i class="bi bi-chat-dots-fill me-3 fs-3"></i>
                <div class="text-start">
                    <small class="d-block lh-1 opacity-75" style="font-size: 0.7rem;">CHAT SEKARANG</small>
                    <span>0896-1986-9600</span>
                </div>
            </a>
        </div>

        <div class="mt-5 row justify-content-center g-3 opacity-75">
            <div class="col-auto">
                <span class="badge rounded-pill bg-light text-dark px-3 py-2">
                    <i class="bi bi-clock-history me-1 text-success"></i> Respon Cepat
                </span>
            </div>
            <div class="col-auto">
                <span class="badge rounded-pill bg-light text-dark px-3 py-2">
                    <i class="bi bi-shield-check me-1 text-success"></i> Amanah
                </span>
            </div>
            <div class="col-auto">
                <span class="badge rounded-pill bg-light text-dark px-3 py-2">
                    <i class="bi bi-emoji-smile me-1 text-success"></i> Ramah
                </span>
            </div>
        </div>
    </div>
</section>

@endsection
