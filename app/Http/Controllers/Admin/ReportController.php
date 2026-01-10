<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exports\SalesReportExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    /**
     * Menampilkan halaman laporan di browser
     */
    public function sales(Request $request)
    {
        $dateFrom = $request->date_from ?? now()->startOfMonth()->format('Y-m-d');
        $dateTo = $request->date_to ?? now()->format('Y-m-d');

        $summary = Order::whereIn('status', ['Delivered', 'Selesai', 'Processing'])
            ->whereBetween('created_at', [$dateFrom.' 00:00:00', $dateTo.' 23:59:59'])
            ->selectRaw('SUM(total_amount) as total_revenue, COUNT(*) as total_orders')
            ->first();

        $orders = Order::with('user')
            ->whereBetween('created_at', [$dateFrom.' 00:00:00', $dateTo.' 23:59:59'])
            ->latest()
            ->paginate(10);

        $byCategory = DB::table('order_items')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->select('categories.name', DB::raw('SUM(order_items.price * order_items.quantity) as total'))
            ->whereBetween('orders.created_at', [$dateFrom.' 00:00:00', $dateTo.' 23:59:59'])
            ->groupBy('categories.name')
            ->get();

        return view('admin.reports.sales', compact('orders', 'summary', 'byCategory', 'dateFrom', 'dateTo'));
    }

    /**
     * Menangani pengunduhan file Excel
     */
  public function exportExcel(Request $request)
{
    $dateFrom = $request->date_from ?? now()->startOfMonth()->format('Y-m-d');
    $dateTo = $request->date_to ?? now()->format('Y-m-d');

    // Gunakan Facade Excel untuk mendownload
    return \Maatwebsite\Excel\Facades\Excel::download(
        new SalesReportExport($dateFrom, $dateTo),
        'Laporan-Penjualan.xlsx'
    );
}
}
