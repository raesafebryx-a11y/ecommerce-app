@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<style>
    /* 1. BACKGROUND CONSISTENCY */
    body { background-color: #f8fafc; }

    /* 2. PREMIUM NAV BAR (Sama dengan Katalog & Detail) */
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

    /* 3. CART CARD STYLING */
    .premium-card {
        border: none;
        border-radius: 25px;
        background: white;
        box-shadow: 0 15px 35px rgba(0,0,0,0.03);
        overflow: hidden;
    }

    .table thead {
        background-color: #f8fafc;
        border-bottom: 2px solid #f1f5f9;
    }

    .table thead th {
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 1px;
        color: #64748b;
        padding: 20px;
    }

    .product-img-wrapper {
        width: 80px;
        height: 80px;
        border-radius: 15px;
        overflow: hidden;
        background: #f8fafc;
        border: 1px solid #f1f5f9;
    }

    /* 4. BUTTONS & ACCENTS */
    .btn-premium-action {
        background: #020617;
        color: white;
        border: none;
        border-radius: 15px;
        padding: 15px;
        font-weight: 700;
        transition: 0.3s;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .btn-premium-action:hover {
        background: #fbbf24;
        color: #020617;
        box-shadow: 0 10px 20px rgba(251, 191, 36, 0.3);
    }

    .text-gold {
        color: #b45309;
        font-weight: 700;
    }

    .qty-input {
        width: 80px;
        border-radius: 10px;
        border: 1px solid #e2e8f0;
        font-weight: 700;
        text-align: center;
    }
</style>

<div class="container py-4">

    {{-- TOP NAVIGATION (Konsisten) --}}
    <div class="catalog-nav d-flex justify-content-between align-items-center animate__animated animate__fadeInDown">
        <div class="d-flex align-items-center gap-3">
            <a href="{{ route('catalog.index') }}" class="btn-nav-back shadow-sm">
                <i class="bi bi-arrow-left"></i> Kembali Belanja
            </a>
            <div class="vr d-none d-md-block" style="height: 30px; opacity: 0.1;"></div>
            <h5 class="mb-0 fw-bold text-dark"><i class="bi bi-bag-check-fill me-2 text-warning"></i>Keranjang Saya</h5>
        </div>
    </div>

    <div class="row g-4">
        {{-- DAFTAR PRODUK --}}
        <div class="col-lg-8 animate__animated animate__fadeInLeft">
            <div class="premium-card">
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead>
                            <tr>
                                <th class="ps-4">Produk Detail</th>
                                <th>Harga</th>
                                <th class="text-center">Jumlah</th>
                                <th>Subtotal</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $totalNormal = 0; @endphp
                            @forelse($cart->items as $item)
                                @php
                                    $hargaFinal = $item->product->discount_price > 0 ? $item->product->discount_price : $item->product->price;
                                    $subtotal = $hargaFinal * $item->quantity;
                                    $totalNormal += $subtotal;
                                @endphp
                                <tr>
                                    <td class="ps-4 py-4">
                                        <div class="d-flex align-items-center">
                                            <div class="product-img-wrapper me-3">
                                                @if($item->product->primaryImage)
                                                    <img src="{{ asset('storage/' . $item->product->primaryImage->image_path) }}" class="w-100 h-100" style="object-fit: cover;">
                                                @else
                                                    <div class="w-100 h-100 d-flex align-items-center justify-content-center">
                                                        <i class="bi bi-image text-muted"></i>
                                                    </div>
                                                @endif
                                            </div>
                                            <div>
                                                <div class="fw-bold text-dark fs-6">{{ $item->product->name }}</div>
                                                <small class="text-muted text-uppercase" style="font-size: 0.7rem; letter-spacing: 1px;">{{ $item->product->category->name }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        @if($item->product->discount_price > 0)
                                            <div class="text-dark fw-bold">Rp {{ number_format($item->product->discount_price, 0, ',', '.') }}</div>
                                            <small class="text-muted text-decoration-line-through">Rp {{ number_format($item->product->price, 0, ',', '.') }}</small>
                                        @else
                                            <div class="fw-bold">Rp {{ number_format($item->product->price, 0, ',', '.') }}</div>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <input type="number" class="qty-input py-1 shadow-none" value="{{ $item->quantity }}" min="1">
                                    </td>
                                    <td class="fw-bold text-dark">
                                        Rp {{ number_format($subtotal, 0, ',', '.') }}
                                    </td>
                                    <td class="text-center pe-4">
                                        <form action="{{ route('cart.destroy', $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger border-0 rounded-circle p-2">
                                                <i class="bi bi-trash3-fill"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5">
                                        <div class="py-4">
                                            <img src="https://cdn-icons-png.flaticon.com/512/11329/11329060.png" width="120" class="mb-3 opacity-25">
                                            <h5 class="fw-bold text-muted">Keranjang Anda Masih Kosong</h5>
                                            <p class="text-muted small mb-4">Temukan gadget impian Anda di katalog kami.</p>
                                            <a href="{{ route('catalog.index') }}" class="btn-nav-back shadow-sm">Mulai Belanja</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- RINGKASAN BELANJA --}}
        <div class="col-lg-4 animate__animated animate__fadeInRight">
            <div class="premium-card p-4">
                <h6 class="fw-bold text-dark text-uppercase mb-4" style="letter-spacing: 1px;">Ringkasan Pesanan</h6>

                <div class="d-flex justify-content-between mb-3">
                    <span class="text-muted">Total Barang</span>
                    <span class="fw-bold text-dark">{{ $cart->items->sum('quantity') }} Unit</span>
                </div>

                <div class="d-flex justify-content-between mb-3">
                    <span class="text-muted">Subtotal Harga</span>
                    <span class="fw-bold text-dark">Rp {{ number_format($totalNormal, 0, ',', '.') }}</span>
                </div>

                <hr class="my-4 opacity-10">

                <div class="d-flex justify-content-between align-items-center mb-5">
                    <span class="fw-bold text-dark fs-5">Total Tagihan</span>
                    <span class="fw-black fs-4 text-gold">
                        Rp {{ number_format($totalNormal, 0, ',', '.') }}
                    </span>
                </div>

                <a href="{{ route('checkout.index') }}" class="btn btn-premium-action w-100 shadow-sm {{ $totalNormal == 0 ? 'disabled' : '' }}">
                    Proses Checkout <i class="bi bi-arrow-right ms-2"></i>
                </a>

                <p class="text-center mt-3 mb-0">
                    <small class="text-muted"><i class="bi bi-shield-check me-1"></i> Transaksi Aman & Terenkripsi</small>
                </p>
            </div>
        </div>
    </div>
</div>

@endsection
