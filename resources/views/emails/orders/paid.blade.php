{{-- resources/views/emails/orders/paid.blade.php --}}

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pesanan Dibayar</title>

    {{-- Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light py-4">

<div class="container">
    <div class="card shadow-sm">
        <div class="card-body">

            <h4 class="mb-3">
                Halo, {{ $order->user->name }}
            </h4>

            <p>
                Terima kasih! Pembayaran untuk pesanan
                <strong>#{{ $order->order_number }}</strong>
                telah kami terima.
                Kami sedang memproses pesanan Anda.
            </p>

            <table class="table table-bordered table-striped mt-4">
                <thead class="table-light">
                    <tr>
                        <th>Produk</th>
                        <th class="text-center">Qty</th>
                        <th class="text-end">Harga</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->items as $item)
                    <tr>
                        <td>{{ $item->product_name }}</td>
                        <td class="text-center">{{ $item->quantity }}</td>
                        <td class="text-end">
                            Rp {{ number_format($item->price, 0, ',', '.') }}
                        </td>
                    </tr>
                    @endforeach

                    <tr class="fw-bold">
                        <td colspan="2">Total</td>
                        <td class="text-end">
                            Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                        </td>
                    </tr>
                </tbody>
            </table>

            <div class="mt-4">
                <a href="{{ route('orders.show', $order) }}"
                   class="btn btn-primary">
                    Lihat Detail Pesanan
                </a>
            </div>

            <hr>

            <p class="text-muted small mb-0">
                Jika ada pertanyaan, silakan balas email ini.
            </p>

            <p class="mt-2 mb-0">
                Salam,<br>
                <strong>{{ config('app.name') }}</strong>
            </p>

        </div>
    </div>
</div>

</body>
</html>
