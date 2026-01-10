{{-- ================================================
     FILE: resources/views/partials/footer.blade.php
     FUNGSI: Footer Website - Versi Premium & Sinkron
     ================================================ --}}

<footer class="footer-premium pt-5 pb-4 mt-5">
    {{-- Aksen Glow Halus di Sudut Footer --}}
    <div class="footer-glow"></div>

    <div class="container position-relative" style="z-index: 2;">
        <div class="row g-4 mb-5">
            {{-- Brand & Description --}}
            <div class="col-lg-4 col-md-12">
                <div class="mb-4">
                    <h4 class="text-white fw-bold mb-3 d-flex align-items-center">
                        <div class="brand-icon-footer me-3 shadow-sm">
                            @auth
                                <img src="{{ auth()->user()->avatar_url }}" alt="Logo" class="avatar-img-footer">
                            @else
                                <i class="bi bi-bag-heart-fill text-dark fs-5"></i>
                            @endauth
                        </div>
                        <span class="text-white">Toko</span><span class="text-gold">kamikami</span>
                    </h4>
                    <p class="text-slate pe-lg-5 lh-lg">
                        Destinasi belanja online pilihan untuk produk berkualitas tinggi dengan standar premium. Nikmati pengalaman berbelanja yang tenang, aman, dan berkelas bersama kami.
                    </p>
                </div>

                {{-- Social Media Modern --}}
                <div class="d-flex gap-3">
                    <a href="#" class="social-icon"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="social-icon"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="social-icon"><i class="bi bi-tiktok"></i></a>
                    <a href="#" class="social-icon"><i class="bi bi-whatsapp"></i></a>
                </div>
            </div>

            {{-- Quick Links --}}
            <div class="col-lg-2 col-6">
                <h6 class="text-gold fw-bold mb-4 text-uppercase small tracking-widest">Navigasi</h6>
                <ul class="list-unstyled footer-links">
                    <li class="mb-3">
                        <a href="{{ route('catalog.index') }}"><i class="bi bi-chevron-right small me-1"></i> Katalog Produk</a>
                    </li>
                    <li class="mb-3">
                        <a href="#"><i class="bi bi-chevron-right small me-1"></i> Tentang Kami</a>
                    </li>
                    <li class="mb-3">
                        <a href="#"><i class="bi bi-chevron-right small me-1"></i> Testimoni</a>
                    </li>
                </ul>
            </div>

            {{-- Bantuan --}}
            <div class="col-lg-2 col-6">
                <h6 class="text-gold fw-bold mb-4 text-uppercase small tracking-widest">Dukungan</h6>
                <ul class="list-unstyled footer-links">
                    <li class="mb-3">
                        <a href="#"><i class="bi bi-chevron-right small me-1"></i> Lacak Pesanan</a>
                    </li>
                    <li class="mb-3">
                        <a href="#"><i class="bi bi-chevron-right small me-1"></i> FAQ</a>
                    </li>
                    <li class="mb-3">
                        <a href="#"><i class="bi bi-chevron-right small me-1"></i> Syarat & Ketentuan</a>
                    </li>
                </ul>
            </div>

            {{-- Contact Info --}}
            <div class="col-lg-4 col-md-12">
                <h6 class="text-gold fw-bold mb-4 text-uppercase small tracking-widest">Hubungi Kami</h6>
                <div class="contact-card-footer p-4 rounded-4 border-gold-subtle">
                    <div class="d-flex align-items-start mb-3">
                        <i class="bi bi-geo-alt-fill text-gold fs-5 me-3"></i>
                        <span class="text-slate small">Jl. Tarate No. 123, Pasirluyu, Kec. Regol, Kota Bandung</span>
                    </div>
                    <div class="d-flex align-items-center mb-3">
                        <i class="bi bi-whatsapp text-gold fs-5 me-3"></i>
                        <span class="text-slate small">0896-1986-9600</span>
                    </div>
                    <div class="d-flex align-items-center">
                        <i class="bi bi-envelope-at-fill text-gold fs-5 me-3"></i>
                        <span class="text-slate small">tokokamikami@gmail.com</span>
                    </div>
                </div>
            </div>
        </div>

        <hr class="my-4 border-white opacity-10">

        <div class="row align-items-center py-2">
            <div class="col-md-6 text-center text-md-start">
                <p class="text-slate mb-0 small">
                    &copy; {{ date('Y') }} <span class="text-white fw-bold">tokokamikami</span>. Eksklusif & Terpercaya.
                </p>
            </div>
            <div class="col-md-6 text-center text-md-end mt-3 mt-md-0">
                <div class="d-flex justify-content-center justify-content-md-end gap-3 text-gold opacity-75">
                    <i class="bi bi-credit-card-2-back-fill fs-4"></i>
                    <i class="bi bi-wallet2 fs-4"></i>
                    <i class="bi bi-truck fs-4"></i>
                </div>
            </div>
        </div>
    </div>
</footer>

<style>
    /* 1. WARNA UTAMA SINKRON DENGAN HOME/KATALOG */
    .footer-premium {
        background-color: #020617; /* Deep Navy yang konsisten */
        position: relative;
        overflow: hidden;
        border-top: 1px solid rgba(251, 191, 36, 0.2);
    }

    .footer-glow {
        position: absolute;
        top: 0;
        right: 0;
        width: 300px;
        height: 300px;
        background: radial-gradient(circle, rgba(251, 191, 36, 0.05) 0%, transparent 70%);
        z-index: 1;
    }

    .text-gold { color: #fbbf24; }
    .text-slate { color: #94a3b8; }
    .tracking-widest { letter-spacing: 2px; }

    /* 2. BRAND ICON */
    .brand-icon-footer {
        background: #fbbf24;
        width: 38px;
        height: 38px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        overflow: hidden;
    }

    .avatar-img-footer {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border: 2px solid #020617;
    }

    /* 3. LINKS HOVER ANIMATION */
    .footer-links a {
        color: #94a3b8;
        text-decoration: none;
        transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        display: inline-block;
        font-size: 0.9rem;
    }

    .footer-links a:hover {
        color: #fbbf24 !important;
        transform: translateX(8px);
    }

    /* 4. SOCIAL ICONS GLASSMORPHISM */
    .social-icon {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(255, 255, 255, 0.05);
        color: #ffffff;
        border-radius: 12px;
        text-decoration: none;
        transition: all 0.3s ease;
        border: 1px solid rgba(255, 255, 255, 0.05);
    }

    .social-icon:hover {
        background: #fbbf24;
        color: #020617 !important;
        transform: translateY(-5px) rotate(8deg);
        box-shadow: 0 10px 20px rgba(251, 191, 36, 0.3);
    }

    /* 5. CONTACT CARD (MATCH WITH CATEGORY CARDS) */
    .contact-card-footer {
        background: rgba(255, 255, 255, 0.02);
        border: 1px solid rgba(251, 191, 36, 0.1);
        backdrop-filter: blur(5px);
    }

    .border-gold-subtle {
        border-left: 3px solid #fbbf24 !important;
    }
</style>
