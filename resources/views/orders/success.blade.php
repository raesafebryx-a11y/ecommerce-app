@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<style>
    :root {
        --deep-navy: #020617;
        --luxury-gold: #fbbf24;
        --success-green: #10b981;
    }

    body { background-color: #f8fafc; }

    .success-card {
        max-width: 600px;
        margin: 50px auto;
        border: none;
        border-radius: 30px;
        background: white;
        box-shadow: 0 20px 50px rgba(0,0,0,0.05);
        overflow: hidden;
    }

    .success-header {
        background: linear-gradient(135deg, var(--deep-navy) 0%, #0f172a 100%);
        padding: 50px 20px;
        color: white;
        position: relative;
    }

    .check-icon-wrapper {
        width: 80px;
        height: 80px;
        background: var(--success-green);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        margin: 0 auto 20px;
        font-size: 2.5rem;
        border: 5px solid rgba(255, 255, 255, 0.2);
        box-shadow: 0 0 20px rgba(16, 185, 129, 0.4);
    }

    .order-number-badge {
        background: rgba(251, 191, 36, 0.15);
        color: var(--luxury-gold);
        padding: 8px 20px;
        border-radius: 100px;
        font-weight: 700;
        font-size: 0.9rem;
        display: inline-block;
        margin-top: 10px;
        border: 1px solid rgba(251, 191, 36, 0.3);
    }

    .btn-view-order {
        background: var(--deep-navy);
        color: white;
        border-radius: 15px;
        padding: 14px 30px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: 0.3s;
        border: none;
        width: 100%;
    }

    .btn-view-order:hover {
        background: var(--luxury-gold);
        color: var(--deep-navy);
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(251, 191, 36, 0.3);
    }

    .btn-back-home {
        color: #64748b;
        font-weight: 600;
        text-decoration: none;
        transition: 0.3s;
        display: inline-block;
        margin-top: 20px;
    }

    .btn-back-home:hover {
        color: var(--deep-navy);
    }

    /* Confetti Effect Simple */
    .confetti {
        position: absolute;
        width: 10px;
        height: 10px;
        background-color: var(--luxury-gold);
        opacity: 0.7;
    }
</style>

<div class="container">
    <div class="success-card animate__animated animate__zoomIn">
        {{-- Header dengan Icon --}}
        <div class="success-header text-center">
            <div class="check-icon-wrapper animate__animated animate__bounceIn animate__delay-1s">
                <i class="bi bi-check-lg"></i>
            </div>
            <h1 class="h3 fw-bold mb-1">Pembayaran Berhasil!</h1>
            <div class="order-number-badge">
                ID Pesanan: #{{ $order->order_number }}
            </div>
        </div>

        {{-- Body --}}
        <div class="card-body p-5 text-center">
            <h5 class="fw-bold text-dark mb-3">Terima Kasih Atas Kepercayaan Anda</h5>
            <p class="text-muted mb-5">
                Pesanan Anda telah kami terima dan saat ini sedang dalam antrean untuk segera dikemas oleh tim logistik kami.
            </p>

            <div class="d-grid gap-2">
                <a href="{{ route('orders.show', $order) }}" class="btn btn-view-order shadow-sm">
                    <i class="bi bi-receipt me-2"></i> Rincian Pesanan
                </a>
            </div>

            <a href="{{ route('catalog.index') }}" class="btn btn-back-home">
                <i class="bi bi-arrow-left me-2"></i> Kembali ke Galeri Produk
            </a>
        </div>

        {{-- Footer/Note --}}
        <div class="card-footer bg-light border-0 py-4 text-center">
            <p class="small text-muted mb-0">
                <i class="bi bi-shield-check text-success me-1"></i> Transaksi Anda terproteksi secara enkripsi end-to-end.
            </p>
        </div>
    </div>
</div>

{{-- Script untuk efek kembang api kecil (Opsional) --}}
<script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.5.1/dist/confetti.browser.min.js"></script>
<script>
    var end = Date.now() + (2 * 1000);
    var colors = ['#fbbf24', '#020617', '#ffffff'];

    (function frame() {
      confetti({
        particleCount: 3,
        angle: 60,
        spread: 55,
        origin: { x: 0 },
        colors: colors
      });
      confetti({
        particleCount: 3,
        angle: 120,
        spread: 55,
        origin: { x: 1 },
        colors: colors
      });

      if (Date.now() < end) {
        requestAnimationFrame(frame);
      }
    }());
</script>

@endsection
