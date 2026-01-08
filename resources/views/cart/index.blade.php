@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h3 class="fw-bold mb-4"><i class="bi bi-cart3 me-2"></i>Keranjang Belanja</h3>

    <div class="row">
        {{-- DAFTAR PRODUK --}}
        <div class="col-lg-8">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4 py-3">Produk</th>
                                <th class="py-3">Harga</th>
                                <th class="py-3 text-center">Jumlah</th>
                                <th class="py-3">Subtotal</th>
                                <th class="py-3 text-center"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $totalNormal = 0; @endphp
                            @forelse($cart->items as $item)
                                @php
                                    // Hitung harga final (cek jika ada diskon)
                                    $hargaFinal = $item->product->discount_price > 0 ? $item->product->discount_price : $item->product->price;
                                    $subtotal = $hargaFinal * $item->quantity;
                                    $totalNormal += $subtotal;
                                @endphp
                                <tr>
                                    <td class="ps-4">
                                        <div class="d-flex align-items-center">
                                            @if($item->product->primaryImage)
                                                <img src="{{ asset('storage/' . $item->product->primaryImage->image_path) }}" class="rounded shadow-sm me-3" width="70" height="70" style="object-fit: cover;">
                                            @else
                                                <div class="bg-light rounded me-3 d-flex align-items-center justify-content-center" style="width: 70px; height: 70px;">
                                                    <i class="bi bi-image text-muted"></i>
                                                </div>
                                            @endif
                                            <div>
                                                <div class="fw-bold text-dark">{{ $item->product->name }}</div>
                                                <small class="text-muted">{{ $item->product->category->name }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        @if($item->product->discount_price > 0)
                                            <div class="text-primary fw-bold">Rp {{ number_format($item->product->discount_price, 0, ',', '.') }}</div>
                                            <small class="text-muted text-decoration-line-through">Rp {{ number_format($item->product->price, 0, ',', '.') }}</small>
                                        @else
                                            <div class="fw-bold">Rp {{ number_format($item->product->price, 0, ',', '.') }}</div>
                                        @endif
                                    </td>
                                    <td class="text-center" style="width: 120px;">
                                        <input type="number" class="form-control form-control-sm text-center shadow-none" value="{{ $item->quantity }}" min="1">
                                    </td>
                                    <td class="fw-bold text-primary">
                                        {{-- Perbaikan Subtotal --}}
                                        Rp {{ number_format($subtotal, 0, ',', '.') }}
                                    </td>
                                    <td class="text-center pe-4">
                                        <form action="{{ route('cart.destroy', $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger border-0">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5">
                                        <i class="bi bi-cart-x display-1 text-muted opacity-25"></i>
                                        <p class="mt-3 text-muted">Keranjang Anda masih kosong.</p>
                                        <a href="{{ route('catalog.index') }}" class="btn btn-primary rounded-pill px-4">Mulai Belanja</a>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- RINGKASAN BELANJA --}}
        <div class="col-lg-4">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-header bg-white py-3 border-bottom-0">
                    <h5 class="mb-0 fw-bold">Ringkasan Belanja</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-2">
                        <span>Total Harga ({{ $cart->items->sum('quantity') }} barang)</span>
                        <span class="fw-semibold">Rp {{ number_format($totalNormal, 0, ',', '.') }}</span>
                    </div>

                    <hr class="text-muted opacity-10">

                    <div class="d-flex justify-content-between mb-4">
                        <span class="fw-bold">Total</span>
                        <span class="fw-bold text-primary fs-5">
                            {{-- Perbaikan Total Akhir --}}
                            Rp {{ number_format($totalNormal, 0, ',', '.') }}
                        </span>
                    </div>

                    <a href="{{ route('checkout.index') }}" class="btn btn-primary w-100 btn-lg fw-bold mb-2 shadow-sm {{ $totalNormal == 0 ? 'disabled' : '' }}">
                        <i class="bi bi-credit-card me-2"></i>Checkout
                    </a>
                    <a href="{{ route('catalog.index') }}" class="btn btn-outline-secondary w-100 border-0 mt-1">
                        <i class="bi bi-arrow-left me-2"></i>Lanjut Belanja
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
