{{-- ================================================
     FILE: resources/views/partials/footer.blade.php
     FUNGSI: Footer Website - Versi Premium & Serasi
     ================================================ --}}

<footer class="footer-premium pt-5 pb-4 mt-5">
    <div class="container">
        <div class="row g-4 mb-5">
            {{-- Brand & Description --}}
            <div class="col-lg-4 col-md-12">
                <div class="mb-4">
                    <h4 class="text-white fw-bold mb-3 d-flex align-items-center">
                        <div class="brand-icon-footer me-2">
                            @auth
                                <img src="{{ auth()->user()->avatar_url }}" alt="Logo" class="avatar-img-footer">
                            @else
                                <i class="bi bi-bag-heart-fill"></i>
                            @endauth
                        </div>
                        <span class="text-white">Toko</span><span class="text-gold">kamikami</span>
                    </h4>
                    <p class="text-slate pe-lg-5 lh-lg">
                        Destinasi belanja online pilihan untuk produk berkualitas tinggi dengan standar premium. Nikmati pengalaman berbelanja yang tenang, aman, dan berkelas bersama kami.
                    </p>
                </div>

                {{-- Social Media --}}
                <div class="d-flex gap-2">
                    <a href="#" class="social-icon"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="social-icon"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="social-icon"><i class="bi bi-tiktok"></i></a>
                    <a href="#" class="social-icon"><i class="bi bi-whatsapp"></i></a>
                </div>
            </div>

            {{-- Quick Links --}}
            <div class="col-lg-2 col-6">
                <h6 class="text-white fw-bold mb-4 text-uppercase small tracking-wider">Navigasi</h6>
                <ul class="list-unstyled footer-links">
                    <li class="mb-3">
                        <a href="{{ route('catalog.index') }}">Katalog Produk</a>
                    </li>
                    <li class="mb-3">
                        <a href="#">Tentang Kami</a>
                    </li>
                    <li class="mb-3">
                        <a href="#">Testimoni</a>
                    </li>
                </ul>
            </div>

            {{-- Bantuan --}}
            <div class="col-lg-2 col-6">
                <h6 class="text-white fw-bold mb-4 text-uppercase small tracking-wider">Dukungan</h6>
                <ul class="list-unstyled footer-links">
                    <li class="mb-3">
                        <a href="#">Lacak Pesanan</a>
                    </li>
                    <li class="mb-3">
                        <a href="#">FAQ</a>
                    </li>
                    <li class="mb-3">
                        <a href="#">Syarat & Ketentuan</a>
                    </li>
                </ul>
            </div>

            {{-- Contact Info --}}
            <div class="col-lg-4 col-md-12">
                <h6 class="text-white fw-bold mb-4 text-uppercase small tracking-wider">Hubungi Kami</h6>
                <div class="contact-card-footer p-4 rounded-4">
                    <div class="d-flex align-items-start mb-3">
                        <i class="bi bi-geo-alt-fill text-gold fs-5 me-3"></i>
                        <span class="text-slate">Jl. Tarate No. 123, Pasirluyu, Kec. Regol, Kota Bandung</span>
                    </div>
                    <div class="d-flex align-items-center mb-3">
                        <i class="bi bi-whatsapp text-gold fs-5 me-3"></i>
                        <span class="text-slate">0896-1986-9600</span>
                    </div>
                    <div class="d-flex align-items-center">
                        <i class="bi bi-envelope-at-fill text-gold fs-5 me-3"></i>
                        <span class="text-slate">tokokamikami@gmail.com</span>
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
                <div class="d-flex justify-content-center justify-content-md-end gap-3 text-slate opacity-50">
                    <i class="bi bi-credit-card-2-back fs-4"></i>
                    <i class="bi bi-wallet2 fs-4"></i>
                    <i class="bi bi-truck fs-4"></i>
                </div>
            </div>
        </div>
    </div>
</footer>

<style>
    /* Sinkronisasi Warna dengan Hero & Navbar */
    .footer-premium {
        background-color: #0f172a; /* Navy Slate yang sama */
        border-top: 5px solid #fbbf24; /* Aksen Gold lembut */
    }

    .text-gold { color: #fbbf24; }
    .text-slate { color: #94a3b8; }

    /* Avatar di Brand Footer */
    .brand-icon-footer {
        background: #fbbf24;
        width: 32px;
        height: 32px;
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
        border: 1.5px solid white;
    }

    /* Links Hover */
    .footer-links a {
        color: #94a3b8;
        text-decoration: none;
        transition: all 0.3s ease;
        display: inline-block;
        font-size: 0.95rem;
    }

    .footer-links a:hover {
        color: #352a0e !important;
        transform: translateX(5px);
    }

    /* Social Icons Modern */
    .social-icon {
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(255, 255, 255, 0.05);
        color: #94a3b8;
        border-radius: 10px;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .social-icon:hover {
        background: #48453d;
        color: #0f172a !important;
        transform: translateY(-3px);
    }

    /* Contact Card */
    .contact-card-footer {
        background: rgba(255, 255, 255, 0.03);
        border: 1px solid rgba(255, 255, 255, 0.05);
    }

    .tracking-wider {
        letter-spacing: 1px;
    }
</style>
