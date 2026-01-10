@extends('layouts.app')

@section('title', 'Detail Pesanan #' . $order->order_number)

@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<style>
    :root {
        --deep-navy: #020617;
        --luxury-gold: #fbbf24;
    }

    body { background-color: #f8fafc; }

    /* Premium Card & Layout */
    .premium-invoice-card {
        border: none;
        border-radius: 30px;
        background: white;
        box-shadow: 0 15px 40px rgba(0,0,0,0.04);
        overflow: hidden;
    }

    .invoice-header {
        background: linear-gradient(135deg, var(--deep-navy) 0%, #0f172a 100%);
        padding: 40px;
        color: white;
    }

    .text-gold { color: var(--luxury-gold) !important; }

    /* Badge Status Custom */
    .status-badge-lg {
        padding: 10px 24px;
        border-radius: 100px;
        font-weight: 700;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    /* Table Styling */
    .invoice-table thead th {
        background-color: #f8fafc;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 1px;
        font-weight: 800;
        color: #64748b;
        padding: 15px 20px;
        border: none;
    }

    .invoice-table tbody td {
        padding: 20px;
        border-bottom: 1px solid #f1f5f9;
    }

    /* Shipping Info Box */
    .shipping-box {
        background: #f8fafc;
        border-radius: 20px;
        padding: 25px;
        border-left: 5px solid var(--luxury-gold);
    }

    /* Payment Button */
    .btn-pay-premium {
        background: var(--luxury-gold);
        color: var(--deep-navy);
        border: none;
        border-radius: 15px;
        padding: 18px 40px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: 0.3s;
    }

    .btn-pay-premium:hover {
        background: #f59e0b;
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(251, 191, 36, 0.3);
    }

    .grayscale-logos span {
        font-size: 0.9rem;
        font-weight: 800;
        color: #94a3b8;
        letter-spacing: 1px;
    }
</style>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-9 animate__animated animate__fadeIn">

            {{-- TOMBOL KEMBALI --}}
            <div class="mb-4">
                <a href="{{ route('orders.index') }}" class="text-decoration-none text-muted fw-bold small">
                    <i class="bi bi-arrow-left me-2"></i> KEMBALI KE RIWAYAT PESANAN
                </a>
            </div>

            <div class="premium-invoice-card shadow-lg">

                {{-- HEADER INVOICE --}}
                <div class="invoice-header">
                    <div class="row align-items-center">
                        <div class="col-md-7">
                            <span class="text-gold small fw-bold text-uppercase opacity-75">Electronic Invoice</span>
                            <h1 class="h2 mb-1 fw-bold text-white">#{{ $order->order_number }}</h1>
                            <p class="mb-0 opacity-75 small">
                                <i class="bi bi-calendar3 me-2"></i>{{ $order->created_at->format('d F Y, H:i') }} WIB
                            </p>
                        </div>
                        <div class="col-md-5 text-md-end mt-3 mt-md-0">
                            @php
                                $statusClasses = [
                                    'pending' => 'bg-warning text-dark',
                                    'processing' => 'bg-info text-dark',
                                    'shipped' => 'bg-primary text-white',
                                    'delivered' => 'bg-success text-white',
                                    'cancelled' => 'bg-danger text-white'
                                ];
                                $class = $statusClasses[$order->status] ?? 'bg-secondary text-white';
                            @endphp
                            <span class="status-badge-lg {{ $class }} shadow-sm">
                                <i class="bi bi-patch-check-fill me-2"></i>{{ ucfirst($order->status) }}
                            </span>
                        </div>
                    </div>
                </div>

                {{-- DETAIL PRODUK --}}
                <div class="card-body p-4 p-md-5">
                    <h3 class="h6 fw-bold text-dark text-uppercase mb-4" style="letter-spacing: 1px;">
                        <i class="bi bi-box-seam me-2 text-gold"></i>Ringkasan Produk
                    </h3>

                    <div class="table-responsive">
                        <table class="table invoice-table align-middle">
                            <thead>
                                <tr>
                                    <th>Item Produk</th>
                                    <th class="text-center">Jumlah</th>
                                    <th class="text-end">Harga Satuan</th>
                                    <th class="text-end">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->items as $item)
                                <tr>
                                    <td>
                                        <span class="fw-bold text-dark d-block">{{ $item->product_name }}</span>
                                        <small class="text-muted">ID: PROD-{{ $item->product_id }}</small>
                                    </td>
                                    <td class="text-center fw-bold">{{ $item->quantity }}x</td>
                                    <td class="text-end">Rp{{ number_format($item->discount_price ?? $item->price, 0, ',', '.') }}</td>
                                    <td class="text-end fw-bold">Rp{{ number_format($item->subtotal, 0, ',', '.') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="border-top-0">
                                @if($order->shipping_cost > 0)
                                <tr>
                                    <td colspan="3" class="text-end py-3 text-muted">Ongkos Pengiriman:</td>
                                    <td class="text-end py-3 fw-semibold">Rp{{ number_format($order->shipping_cost, 0, ',', '.') }}</td>
                                </tr>
                                @endif
                                <tr>
                                    <td colspan="3" class="text-end py-4 border-0">
                                        <span class="h6 fw-bold text-uppercase mb-0">Total Pembayaran</span>
                                    </td>
                                    <td class="text-end py-4 border-0">
                                        <span class="h4 mb-0 fw-bold text-primary">
                                            Rp{{ number_format($order->total_amount, 0, ',', '.') }}
                                        </span>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

                {{-- ALAMAT & INFORMASI PEMBAYARAN --}}
                <div class="card-body p-4 p-md-5 border-top bg-light bg-opacity-50">
                    <div class="row g-4">
                        <div class="col-md-7">
                            <h3 class="h6 fw-bold text-uppercase mb-3" style="letter-spacing: 1px;">
                                <i class="bi bi-geo-alt me-2 text-gold"></i>Destinasi Pengiriman
                            </h3>
                            <div class="shipping-box shadow-sm">
                                <h6 class="fw-bold mb-1">{{ $order->shipping_name }}</h6>
                                <p class="text-primary fw-semibold small mb-2">
                                    <i class="bi bi-whatsapp me-1"></i>{{ $order->shipping_phone }}
                                </p>
                                <p class="text-muted small mb-0 lh-base">
                                    {{ $order->shipping_address }}
                                </p>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <h3 class="h6 fw-bold text-uppercase mb-3" style="letter-spacing: 1px;">
                                <i class="bi bi-shield-lock me-2 text-gold"></i>Metode Pembayaran
                            </h3>
                            <div class="p-4 rounded-4 border bg-white shadow-sm h-100 d-flex flex-column align-items-center justify-content-center">
                                <div class="text-center">
                                    <div class="mb-2">
                                        <i class="bi bi-credit-card-2-back text-primary" style="font-size: 2.5rem;"></i>
                                    </div>
                                    <span class="fw-bold d-block text-dark small text-uppercase">Otomatis & Aman</span>
                                    <div class="d-flex flex-wrap justify-content-center gap-1 mt-2">
                                        <span class="badge bg-light text-muted border" style="font-size: 0.65rem;">BCA</span>
                                        <span class="badge bg-light text-muted border" style="font-size: 0.65rem;">QRIS</span>
                                        <span class="badge bg-light text-muted border" style="font-size: 0.65rem;">GOPAY</span>
                                    </div>
                                    <small class="text-muted d-block mt-2" style="font-size: 0.6rem;">Pilihan bank tersedia setelah klik bayar</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- TOMBOL BAYAR (Hanya jika pending) --}}
                @if($order->status === 'pending' && $order->snap_token)
                <div class="card-body p-5 border-top text-center animate__animated animate__pulse animate__infinite animate__slow">
                    <p class="text-muted mb-4 small">
                        Klik tombol di bawah untuk memilih metode pembayaran dan menyelesaikan transaksi.
                    </p>
                    <button id="pay-button" class="btn btn-pay-premium shadow">
                        <i class="bi bi-wallet2 me-2"></i> Bayar Sekarang
                    </button>

                    <div class="mt-5">
                        <p class="small text-muted mb-3 text-uppercase fw-bold" style="letter-spacing: 1.5px; font-size: 0.7rem;">Dukungan Pembayaran Otomatis:</p>
                        <div class="d-flex justify-content-center flex-wrap gap-4 grayscale-logos opacity-50">
                            <span>BCA</span>
                            <span>MANDIRI</span>
                            <span>BNI</span>
                            <span>GOPAY</span>
                            <span>QRIS</span>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

{{-- Snap.js Integration --}}
@if($order->snap_token)
@push('scripts')
<script src="{{ config('midtrans.snap_url') }}" data-client-key="{{ config('midtrans.client_key') }}"></script>
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function () {
        const payButton = document.getElementById('pay-button');
        if (payButton) {
            payButton.addEventListener('click', function () {
                payButton.disabled = true;
                payButton.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span> MEMPROSES...';

                window.snap.pay('{{ $order->snap_token }}', {
                    onSuccess: function (result) { window.location.href = '{{ route("orders.success", $order) }}'; },
                    onPending: function (result) { window.location.href = '{{ route("orders.pending", $order) }}'; },
                    onError: function (result) {
                        alert('Pembayaran Gagal! Silakan coba lagi.');
                        payButton.disabled = false;
                        payButton.innerHTML = '<i class="bi bi-wallet2 me-2"></i> BAYAR SEKARANG';
                    },
                    onClose: function () {
                        payButton.disabled = false;
                        payButton.innerHTML = '<i class="bi bi-wallet2 me-2"></i> BAYAR SEKARANG';
                    }
                });
            });
        }
    });
</script>
@endpush
@endif

@endsection
