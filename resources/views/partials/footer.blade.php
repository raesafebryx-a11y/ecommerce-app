{{-- ================================================
     FILE: resources/views/partials/footer.blade.php
     FUNGSI: Footer Website - Versi Premium & Menyala
     ================================================ --}}

<footer class="bg-dark text-light pt-5 pb-4 mt-5 border-top border-warning border-4">
    <div class="container">
        <div class="row g-4 mb-5">
            {{-- Brand & Description --}}
            <div class="col-lg-4 col-md-12">
                <div class="mb-4">
                    <h4 class="text-white fw-bold mb-3 d-flex align-items-center">
                        <span class="bg-warning text-dark px-2 py-1 rounded me-2">
                            <i class="bi bi-bag-heart-fill"></i>
                        </span>
                        tokokami<span class="text-warning">kami</span>
                    </h4>
                    <p class="text-secondary pe-lg-5 lh-lg">
                        Destinasi belanja online nomor satu untuk produk berkualitas tinggi dengan harga yang tetap terjangkau. Nikmati pengalaman berbelanja yang mudah, cepat, dan aman bersama TokoKami!
                    </p>
                </div>

                {{-- Social Media dengan Efek Hover --}}
                <div class="d-flex gap-2">
                    <a href="#" class="btn btn-outline-light btn-sm rounded-circle social-icon"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="btn btn-outline-light btn-sm rounded-circle social-icon"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="btn btn-outline-light btn-sm rounded-circle social-icon"><i class="bi bi-tiktok"></i></a>
                    <a href="#" class="btn btn-outline-light btn-sm rounded-circle social-icon"><i class="bi bi-whatsapp"></i></a>
                </div>
            </div>

            {{-- Quick Links --}}
            <div class="col-lg-2 col-6">
                <h6 class="text-white fw-bold mb-4 text-uppercase small tracking-wider">Navigasi</h6>
                <ul class="list-unstyled footer-links">
                    <li class="mb-3">
                        <a href="{{ route('catalog.index') }}" class="text-secondary text-decoration-none">Katalog Produk</a>
                    </li>
                    <li class="mb-3">
                        <a href="#" class="text-secondary text-decoration-none">Promo Member</a>
                    </li>
                    <li class="mb-3">
                        <a href="#" class="text-secondary text-decoration-none">Tentang Kami</a>
                    </li>
                    <li class="mb-3">
                        <a href="#" class="text-secondary text-decoration-none">Testimoni</a>
                    </li>
                </ul>
            </div>

            {{-- Bantuan --}}
            <div class="col-lg-2 col-6">
                <h6 class="text-white fw-bold mb-4 text-uppercase small tracking-wider">Dukungan</h6>
                <ul class="list-unstyled footer-links">
                    <li class="mb-3">
                        <a href="#" class="text-secondary text-decoration-none">Cara Order</a>
                    </li>
                    <li class="mb-3">
                        <a href="#" class="text-secondary text-decoration-none">Lacak Pesanan</a>
                    </li>
                    <li class="mb-3">
                        <a href="#" class="text-secondary text-decoration-none">FAQ</a>
                    </li>
                    <li class="mb-3">
                        <a href="#" class="text-secondary text-decoration-none">Syarat & Ketentuan</a>
                    </li>
                </ul>
            </div>

            {{-- Contact Info --}}
            <div class="col-lg-4 col-md-12">
                <h6 class="text-white fw-bold mb-4 text-uppercase small tracking-wider">Hubungi Kami</h6>
                <div class="bg-secondary bg-opacity-10 p-4 rounded-4 border border-secondary border-opacity-25">
                    <div class="d-flex align-items-start mb-3">
                        <i class="bi bi-geo-alt-fill text-warning fs-5 me-3"></i>
                        <span class="text-secondary">Jl. Tarate No. 123, Pasirluyu, Kec. Regol, Kota Bandung</span>
                    </div>
                    <div class="d-flex align-items-center mb-3">
                        <i class="bi bi-whatsapp text-warning fs-5 me-3"></i>
                        <span class="text-secondary">0896-1986-9600</span>
                    </div>
                    <div class="d-flex align-items-center">
                        <i class="bi bi-envelope-at-fill text-warning fs-5 me-3"></i>
                        <span class="text-secondary">tokokamikami@gmail.com</span>
                    </div>
                </div>
            </div>
        </div>

        <hr class="my-4 border-secondary opacity-25">

        <div class="row align-items-center py-2">
            <div class="col-md-6 text-center text-md-start">
                <p class="text-secondary mb-0 small">
                    &copy; {{ date('Y') }} <span class="text-white fw-bold">tokokamikami</span>. Dibuat dengan <i class="bi bi-lightning-charge-fill text-warning"></i> untuk kepuasan anda.
                </p>
            </div>
            <div class="col-md-6 text-center text-md-end mt-3 mt-md-0">
                <div class="d-flex justify-content-center justify-content-md-end gap-3 opacity-75">
                    <i class="bi bi-credit-card-2-back fs-4"></i>
                    <i class="bi bi-wallet2 fs-4"></i>
                    <i class="bi bi-bank fs-4"></i>
                    <i class="bi bi-truck fs-4 text-warning"></i>
                </div>
            </div>
        </div>
    </div>
</footer>

<style>
    /* Styling Tambahan */
    .footer-links a {
        transition: all 0.3s ease;
        display: inline-block;
    }

    .footer-links a:hover {
        color: #ffc107 !important; /* Warna Warning */
        transform: translateX(8px);
    }

    .social-icon {
        width: 38px;
        height: 38px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
        border-color: rgba(255,255,255,0.1);
    }

    .social-icon:hover {
        background-color: #ffc107;
        border-color: #ffc107;
        color: #212529 !important;
        transform: translateY(-5px);
    }

    .tracking-wider {
        letter-spacing: 1.5px;
    }
</style>
