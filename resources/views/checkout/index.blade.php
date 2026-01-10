@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<style>
    /* Sinkronisasi Tema Luxury */
    :root {
        --deep-navy: #020617;
        --luxury-gold: #fbbf24;
        --soft-bg: #f8fafc;
    }

    body { background-color: var(--soft-bg); }

    /* Navigasi Top Bar */
    .checkout-nav {
        background: white;
        border-radius: 20px;
        padding: 15px 25px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.03);
        margin-bottom: 30px;
    }

    /* Card Styling */
    .premium-card {
        border: none;
        border-radius: 25px;
        background: white;
        box-shadow: 0 10px 30px rgba(0,0,0,0.04);
    }

    /* Form Input Premium */
    .premium-label {
        font-size: 0.75rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: #64748b;
        margin-bottom: 8px;
    }

    .premium-input {
        border-radius: 12px !important;
        padding: 12px 16px !important;
        border: 1px solid #e2e8f0 !important;
        background-color: #f8fafc !important;
        transition: all 0.3s ease;
    }

    .premium-input:focus {
        background-color: #fff !important;
        border-color: var(--luxury-gold) !important;
        box-shadow: 0 0 0 4px rgba(251, 191, 36, 0.1) !important;
    }

    /* Summary Item */
    .cart-item-row {
        padding: 10px 0;
        border-bottom: 1px dashed #e2e8f0;
    }
    .cart-item-row:last-child { border-bottom: none; }

    /* Button Action */
    .btn-checkout-final {
        background: var(--deep-navy);
        color: white;
        border: none;
        border-radius: 15px;
        padding: 16px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: 0.3s;
    }

    .btn-checkout-final:hover {
        background: var(--luxury-gold);
        color: var(--deep-navy);
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(251, 191, 36, 0.3);
    }
</style>

<div class="container py-4">

    {{-- TOP NAVIGATION --}}
    <div class="checkout-nav d-flex justify-content-between align-items-center animate__animated animate__fadeInDown">
        <div class="d-flex align-items-center gap-3">
            <a href="{{ route('cart.index') }}" class="btn btn-outline-dark border-0 rounded-circle p-2">
                <i class="bi bi-arrow-left fs-5"></i>
            </a>
            <div class="vr" style="height: 30px; opacity: 0.1;"></div>
            <h5 class="mb-0 fw-bold text-dark">Selesaikan Pesanan</h5>
        </div>
        <div class="d-none d-md-block">
            <span class="badge bg-warning-subtle text-warning px-3 py-2 rounded-pill">
                <i class="bi bi-shield-lock-fill me-1"></i> Pembayaran Aman
            </span>
        </div>
    </div>

    <form action="{{ route('checkout.store') }}" method="POST">
        @csrf

        <div class="row g-4">
            <div class="col-lg-8 animate__animated animate__fadeInLeft">
                <div class="card premium-card">
                    <div class="card-body p-4 p-md-5">
                        <div class="d-flex align-items-center mb-4 gap-3">
                            <div class="bg-primary-subtle p-2 rounded-3">
                                <i class="bi bi-truck text-primary fs-4"></i>
                            </div>
                            <h2 class="h5 fw-bold mb-0">Informasi Pengiriman</h2>
                        </div>

                        <div class="row g-4">
                            <div class="col-md-6">
                                <label for="name" class="premium-label">Nama Lengkap Penerima</label>
                                <input type="text" name="name" id="name" class="form-control premium-input"
                                    value="{{ auth()->user()->name }}" placeholder="Contoh: Budi Santoso" required>
                            </div>

                            <div class="col-md-6">
                                <label for="phone" class="premium-label">Nomor WhatsApp</label>
                                <input type="text" name="phone" id="phone" class="form-control premium-input"
                                    placeholder="Contoh: 08123456789" required>
                            </div>

                            <div class="col-12">
                                <label for="address" class="premium-label">Alamat Lengkap & Kode Pos</label>
                                <textarea name="address" id="address" rows="4" class="form-control premium-input"
                                    placeholder="Tuliskan nama jalan, nomor rumah, RT/RW, Kec, Kota, dan Kode Pos" required></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- INFORMASI PEMBAYARAN (Preview Only) --}}
                <div class="card premium-card mt-4">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center gap-3">
                            <i class="bi bi-info-circle text-warning fs-4"></i>
                            <p class="mb-0 small text-muted">Metode pembayaran akan muncul setelah Anda menekan tombol <strong>Buat Pesanan</strong>.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 animate__animated animate__fadeInRight">
                <div class="card premium-card sticky-top" style="top: 1.5rem;">
                    <div class="card-body p-4">
                        <h2 class="h5 fw-bold mb-4">Ringkasan Pesanan</h2>

                        <div class="mb-4" style="max-height: 350px; overflow-y: auto;">
                            @foreach($cart->items as $item)
                            <div class="cart-item-row d-flex justify-content-between align-items-center">
                                <div class="pe-3">
                                    <h6 class="mb-0 small fw-bold text-dark">{{ $item->product->name }}</h6>
                                    <small class="text-muted">{{ $item->quantity }} x Rp{{ number_format($item->product->price, 0, ',', '.') }}</small>
                                </div>
                                <span class="fw-bold text-primary small">Rp{{ number_format($item->subtotal, 0, ',', '.') }}</span>
                            </div>
                            @endforeach
                        </div>

                        <div class="bg-light p-3 rounded-4 mb-4">
                            <div class="d-flex justify-content-between mb-2 small">
                                <span class="text-muted">Subtotal Produk</span>
                                <span class="text-dark fw-bold">Rp{{ number_format($cart->items->sum('subtotal'), 0, ',', '.') }}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-0 small">
                                <span class="text-muted">Biaya Pengiriman</span>
                                <span class="text-success fw-bold small">Akan dihitung</span>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <span class="h6 mb-0 fw-bold">Total Tagihan</span>
                            <span class="h4 mb-0 fw-bold text-primary">Rp{{ number_format($cart->items->sum('subtotal'), 0, ',', '.') }}</span>
                        </div>

                        <button type="submit" class="btn btn-checkout-final w-100 shadow-sm">
                            Buat Pesanan Sekarang <i class="bi bi-arrow-right ms-2"></i>
                        </button>

                        <p class="text-center mt-3 mb-0 small text-muted">
                            <i class="bi bi-patch-check-fill text-primary me-1"></i> Jaminan Produk Original 100%
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

@endsection
