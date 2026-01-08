@extends('layouts.admin')

@section('title', 'Manajemen Pesanan')

@section('content')
{{-- HEADER PAGE --}}
<div class="row mb-4">
    <div class="col-md-7">
        <h2 class="h3 fw-bold text-primary mb-1">
            <i class="bi bi-cart-check me-2"></i>Manajemen Pesanan
        </h2>
        <p class="text-muted small">Kelola dan pantau status transaksi pelanggan Anda secara real-time.</p>
    </div>
    <div class="col-md-5 text-md-end">
        <div class="d-inline-flex gap-2 mb-2">
            {{-- Badge Tanggal --}}
            <div class="badge bg-white text-dark border shadow-sm p-2 px-3 rounded-pill d-flex align-items-center">
                <i class="bi bi-calendar3 me-2 text-primary"></i> {{ date('d F Y') }}
            </div>

            {{-- Tombol Lihat Toko --}}
            <a href="/" target="_blank" class="btn btn-white border shadow-sm rounded-pill px-3 fw-bold d-flex align-items-center">
                <i class="bi bi-shop me-2 text-primary"></i> Lihat Toko
            </a>

            {{-- Tombol Keluar --}}
            <button type="button" class="btn btn-white border shadow-sm rounded-pill px-3 fw-bold text-danger d-flex align-items-center"
                onclick="event.preventDefault(); if(confirm('Yakin ingin keluar?')) document.getElementById('logout-form').submit();">
                <i class="bi bi-box-arrow-right me-2"></i> Keluar
            </button>
        </div>

        {{-- Form Logout --}}
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>
</div>

{{-- RINGKASAN STATISTIK (QUICK VIEW) --}}
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100 rounded-3">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0 bg-warning-subtle p-3 rounded-3">
                        <i class="bi bi-clock-history text-warning fs-4"></i>
                    </div>
                    <div class="ms-3">
                        <h6 class="text-muted mb-0 small fw-bold">PERLU DIPROSES</h6>
                        <h4 class="mb-0 fw-bold">{{ $pendingCount ?? 0 }}</h4>
                    </div>
                </div>
            </div>
            <div class="bg-warning py-1"></div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100 rounded-3">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0 bg-primary-subtle p-3 rounded-3">
                        <i class="bi bi-truck text-primary fs-4"></i>
                    </div>
                    <div class="ms-3">
                        <h6 class="text-muted mb-0 small fw-bold">SEDANG DIKIRIM</h6>
                        <h4 class="mb-0 fw-bold">{{ $shippedCount ?? 0 }}</h4>
                    </div>
                </div>
            </div>
            <div class="bg-primary py-1"></div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100 rounded-3">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0 bg-success-subtle p-3 rounded-3">
                        <i class="bi bi-cash-stack text-success fs-4"></i>
                    </div>
                    <div class="ms-3">
                        <h6 class="text-muted mb-0 small fw-bold">SELESAI (BULAN INI)</h6>
                        <h4 class="mb-0 fw-bold">{{ $completedCount ?? 0 }}</h4>
                    </div>
                </div>
            </div>
            <div class="bg-success py-1"></div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100 rounded-3 bg-primary text-white">
            <div class="card-body p-4">
                <h6 class="text-white-50 mb-1 small fw-bold">TOTAL PENDAPATAN</h6>
                <h4 class="mb-0 fw-bold text-white">Rp {{ number_format($totalRevenue ?? 0, 0, ',', '.') }}</h4>
            </div>
        </div>
    </div>
</div>

<div class="card shadow-sm border-0 overflow-hidden rounded-3">
    <div class="card-header bg-white pt-3 border-bottom-0">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
            <ul class="nav nav-pills custom-pills">
                <li class="nav-item">
                    <a class="nav-link {{ !request('status') ? 'active' : '' }}" href="{{ route('admin.orders.index') }}">Semua</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request('status') == 'pending' ? 'active' : '' }}" href="{{ route('admin.orders.index', ['status' => 'pending']) }}">Pending</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request('status') == 'processing' ? 'active' : '' }}" href="{{ route('admin.orders.index', ['status' => 'processing']) }}">Diproses</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request('status') == 'shipped' ? 'active' : '' }}" href="{{ route('admin.orders.index', ['status' => 'shipped']) }}">Dikirim</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request('status') == 'delivered' ? 'active' : '' }}" href="{{ route('admin.orders.index', ['status' => 'delivered']) }}">Selesai</a>
                </li>
            </ul>

            <form action="{{ route('admin.orders.index') }}" method="GET" class="d-flex gap-2">
                <div class="input-group input-group-sm">
                    <input type="text" name="search" class="form-control border-end-0" placeholder="Cari No. Order..." value="{{ request('search') }}">
                    <button type="submit" class="btn btn-primary border-start-0 px-3">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="card-body p-0 mt-2">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light border-bottom">
                    <tr>
                        <th class="ps-4 py-3">No. Order</th>
                        <th class="py-3">Customer</th>
                        <th class="py-3">Metode Pembayaran</th>
                        <th class="py-3">Total Tagihan</th>
                        <th class="py-3 text-center">Status</th>
                        <th class="text-end pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                        <tr>
                            <td class="ps-4">
                                <div class="fw-bold text-dark">#{{ $order->order_number }}</div>
                                <small class="text-muted">{{ $order->created_at->format('d/m/Y H:i') }}</small>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="bg-primary-subtle rounded-circle d-flex align-items-center justify-content-center me-2 shadow-sm" style="width: 35px; height: 35px;">
                                        <span class="fw-bold text-primary small">{{ strtoupper(substr($order->user->name, 0, 1)) }}</span>
                                    </div>
                                    <div>
                                        <div class="fw-semibold small text-dark">{{ $order->user->name }}</div>
                                        <div class="text-muted" style="font-size: 0.75rem;">{{ $order->user->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-light text-dark border px-3 rounded-pill fw-normal">{{ strtoupper($order->payment_method ?? 'Transfer') }}</span>
                            </td>
                            <td>
                                <div class="fw-bold text-primary">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</div>
                            </td>
                            <td class="text-center">
                                @php
                                    $statusClasses = [
                                        'pending'    => 'bg-warning-subtle text-warning border-warning-subtle',
                                        'processing' => 'bg-info-subtle text-info border-info-subtle',
                                        'shipped'    => 'bg-primary-subtle text-primary border-primary-subtle',
                                        'delivered'  => 'bg-success-subtle text-success border-success-subtle',
                                        'cancelled'  => 'bg-danger-subtle text-danger border-danger-subtle',
                                    ];
                                    $class = $statusClasses[$order->status] ?? 'bg-secondary text-white';
                                @endphp
                                <span class="badge {{ $class }} border px-3 py-2 rounded-pill shadow-none fw-bold" style="min-width: 90px;">
                                    {{ ucfirst($order->status == 'delivered' ? 'Selesai' : $order->status) }}
                                </span>
                            </td>
                            <td class="text-end pe-4">
                                <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-sm btn-white border px-3 rounded-pill shadow-sm fw-bold">
                                    <i class="bi bi-eye text-primary me-1"></i> Kelola
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <i class="bi bi-cart-x display-4 text-light-emphasis"></i>
                                <p class="mt-3 text-muted">Tidak ada pesanan yang ditemukan.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer bg-white py-3 border-top-0">
        <div class="d-flex justify-content-between align-items-center">
            <small class="text-muted">Menampilkan {{ $orders->firstItem() ?? 0 }} sampai {{ $orders->lastItem() ?? 0 }} dari {{ $orders->total() }} pesanan</small>
            {{ $orders->appends(request()->query())->links() }}
        </div>
    </div>
</div>

{{-- BANTUAN ADMIN --}}
<div class="card border-0 shadow-sm rounded-3 bg-primary-subtle mt-4">
    <div class="card-body p-3">
        <div class="d-flex align-items-center">
            <div class="flex-shrink-0 bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                <i class="bi bi-headset small"></i>
            </div>
            <p class="small text-dark-emphasis mb-0 ms-2">
                Pesanan bermasalah atau butuh konfirmasi manual? Hubungi <strong>Tokokamikami</strong> atau chat <a href="https://wa.me/6289619869600" class="text-decoration-none fw-bold">089619869600</a>.
            </p>
        </div>
    </div>
</div>

<style>
    .custom-pills .nav-link {
        color: #6c757d;
        font-weight: 500;
        font-size: 0.9rem;
        padding: 0.5rem 1.2rem;
        border-radius: 50px;
        transition: all 0.2s;
    }
    .custom-pills .nav-link.active {
        background-color: var(--bs-primary);
        color: white;
        box-shadow: 0 4px 8px rgba(13, 110, 253, 0.2);
    }
    .btn-white:hover { background-color: #f8f9fa; }
</style>
@endsection
