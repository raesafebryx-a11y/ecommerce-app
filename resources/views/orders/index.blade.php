@extends('layouts.app')

@section('title', 'Pesanan Saya')

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
    .order-nav {
        background: white;
        border-radius: 20px;
        padding: 15px 25px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.03);
        margin-bottom: 30px;
    }

    /* Card & Table Styling */
    .premium-card {
        border: none;
        border-radius: 25px;
        background: white;
        box-shadow: 0 10px 30px rgba(0,0,0,0.04);
        overflow: hidden;
    }

    .table thead th {
        background-color: #ffffff;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 1.5px;
        font-weight: 800;
        color: #64748b;
        padding: 20px;
        border-bottom: 2px solid #f1f5f9;
    }

    .table tbody td {
        padding: 20px;
        color: #1e293b;
    }

    /* Status Badges Premium */
    .badge-premium {
        padding: 8px 16px;
        border-radius: 100px;
        font-weight: 700;
        font-size: 0.7rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* Button Detail */
    .btn-detail-order {
        background: white;
        border: 2px solid var(--deep-navy);
        color: var(--deep-navy);
        font-weight: 700;
        border-radius: 100px;
        padding: 6px 20px;
        transition: 0.3s;
        font-size: 0.85rem;
    }

    .btn-detail-order:hover {
        background: var(--deep-navy);
        color: white;
        transform: translateY(-2px);
    }

    /* Empty State */
    .empty-order-card {
        padding: 80px 20px;
        background: white;
        border-radius: 30px;
        text-align: center;
    }

    .icon-empty-wrapper {
        width: 100px;
        height: 100px;
        background: #f1f5f9;
        color: #94a3b8;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        margin: 0 auto 25px;
        font-size: 3rem;
    }
</style>

<div class="container py-4">

    {{-- TOP NAVIGATION --}}
    <div class="order-nav d-flex justify-content-between align-items-center animate__animated animate__fadeInDown">
        <div class="d-flex align-items-center gap-3">
            <a href="{{ route('profile.edit') }}" class="btn btn-outline-dark border-0 rounded-circle p-2">
                <i class="bi bi-person-circle fs-5"></i>
            </a>
            <div class="vr" style="height: 30px; opacity: 0.1;"></div>
            <h5 class="mb-0 fw-bold text-dark">Riwayat Belanja</h5>
        </div>
        <div class="d-none d-md-block">
            <span class="text-muted small fw-medium">Total Pesanan: <strong>{{ $orders->total() }}</strong></span>
        </div>
    </div>

    @if($orders->count())
    <div class="card premium-card animate__animated animate__fadeInUp">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th class="ps-4">No. Order</th>
                            <th>Tanggal Transaksi</th>
                            <th class="text-center">Status</th>
                            <th>Total Pembayaran</th>
                            <th class="text-end pe-4">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                        <tr>
                            <td class="ps-4">
                                <span class="fw-bold text-dark">#{{ $order->order_number }}</span>
                            </td>
                            <td>
                                <div class="small fw-semibold text-muted">
                                    <i class="bi bi-calendar-event me-1"></i> {{ $order->created_at->format('d M Y') }}
                                </div>
                                <div class="text-muted" style="font-size: 0.75rem;">
                                    {{ $order->created_at->format('H:i') }} WIB
                                </div>
                            </td>
                            <td class="text-center">
                                @php
                                    $statusClasses = [
                                        'pending'    => 'bg-warning-subtle text-warning border border-warning-subtle',
                                        'processing' => 'bg-info-subtle text-info border border-info-subtle',
                                        'shipped'    => 'bg-primary-subtle text-primary border border-primary-subtle',
                                        'delivered'  => 'bg-success-subtle text-success border border-success-subtle',
                                        'cancelled'  => 'bg-danger-subtle text-danger border border-danger-subtle'
                                    ];
                                    $statusLabels = [
                                        'pending'    => 'Menunggu',
                                        'processing' => 'Diproses',
                                        'shipped'    => 'Dikirim',
                                        'delivered'  => 'Diterima',
                                        'cancelled'  => 'Dibatalkan'
                                    ];
                                    $class = $statusClasses[$order->status] ?? 'bg-light text-dark';
                                    $label = $statusLabels[$order->status] ?? ucfirst($order->status);
                                @endphp
                                <span class="badge-premium {{ $class }}">
                                    {{ $label }}
                                </span>
                            </td>
                            <td class="fw-bold text-primary">
                                Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                            </td>
                            <td class="text-end pe-4">
                                <a href="{{ route('orders.show', $order) }}" class="btn btn-detail-order shadow-sm">
                                    Lihat Detail
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @if($orders->hasPages())
        <div class="card-footer bg-white py-4 border-0">
            {{ $orders->links() }}
        </div>
        @endif
    </div>
    @else
    {{-- EMPTY STATE --}}
    <div class="empty-order-card animate__animated animate__zoomIn">
        <div class="icon-empty-wrapper">
            <i class="bi bi-bag-x"></i>
        </div>
        <h3 class="fw-bold text-dark mb-2">Belum Ada Pesanan</h3>
        <p class="text-muted mb-4 mx-auto" style="max-width: 400px;">
            Anda belum melakukan transaksi apapun. Mari mulai jelajahi koleksi produk eksklusif kami hari ini!
        </p>
        <a href="{{ route('catalog.index') }}" class="btn btn-dark rounded-pill px-5 py-3 fw-bold shadow-sm">
            Mulai Belanja Sekarang
        </a>
    </div>
    @endif
</div>

@endsection
