<?php
// app/Http/Controllers/Admin/OrderController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Menampilkan daftar semua pesanan untuk admin.
     * Dilengkapi filter by status.
     */
    public function index()
{
    $stats = [
        'perlu_diproses' => \App\Models\Order::whereIn('status', ['Pending', 'Processing', 'pending', 'processing'])->count(),
        'sedang_dikirim' => \App\Models\Order::whereIn('status', ['Shipped', 'shipped', 'Dikirim'])->count(),
        'selesai'        => \App\Models\Order::whereIn('status', ['Delivered', 'delivered', 'Selesai'])
                            ->whereMonth('created_at', now()->month)
                            ->count(),
        'total_pendapatan' => \App\Models\Order::whereIn('status', ['Delivered', 'delivered', 'Selesai'])->sum('total_amount'),
    ];

    // GANTI ->get() MENJADI ->paginate(10)
    $orders = \App\Models\Order::with('user')->latest()->paginate(10);

    return view('admin.orders.index', compact('stats', 'orders'));
}

    /**
     * Detail order untuk admin.
     */
    public function show(Order $order)
    {
        // Load item produk dan data user
        $order->load(['items.product', 'user']);
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Update status pesanan (misal: kirim barang)
     * Handle otomatis pengembalian stok jika status diubah jadi Cancelled.
     */
    public function updateStatus(Request $request, Order $order)
    {
        // Validasi status yang dikirim form
        $request->validate([
            'status' => 'required|in:processing,completed,cancelled'
        ]);

        $oldStatus = $order->status;
        $newStatus = $request->status;

        // ============================================================
        // LOGIKA RESTOCK (PENTING!)
        // ============================================================
        // Jika admin membatalkan pesanan, stok barang harus dikembalikan ke gudang.
        // Syarat:
        // 1. Status baru adalah 'cancelled'
        // 2. Status lama BUKAN 'cancelled' (agar tidak restock 2x kalau tombol ditekan berkali-kali)
        // ============================================================
        if ($newStatus === 'cancelled' && $oldStatus !== 'cancelled') {
            foreach ($order->items as $item) {
                // increment() adalah operasi atomik (thread-safe) di level database.
                // SQL-nya kurang lebih: UPDATE products SET stock = stock + X WHERE id = Y
                // Ini aman dari Race Condition jika ada transaksi bersamaan.
                $item->product->increment('stock', $item->quantity);
            }
        }

        // Update status di database
        $order->update(['status' => $newStatus]);

        return back()->with('success', "Status pesanan diperbarui menjadi $newStatus");
    }
}
