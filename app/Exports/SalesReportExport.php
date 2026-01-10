<?php

namespace App\Exports;

use App\Models\Order;
// Pastikan tidak ada spasi sebelum atau sesudah baris use di bawah ini
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\Exportable;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SalesReportExport implements FromQuery, WithMapping, WithHeadings, ShouldAutoSize, WithStyles
{
    use Exportable; // Pastikan tertulis persis seperti ini

    protected $dateFrom;
    protected $dateTo;

    public function __construct($dateFrom, $dateTo)
    {
        $this->dateFrom = $dateFrom;
        $this->dateTo = $dateTo;
    }

    public function query()
    {
        return Order::query()
            ->with('user')
            ->whereBetween('created_at', [$this->dateFrom . ' 00:00:00', $this->dateTo . ' 23:59:59']);
    }

    public function headings(): array
    {
        return ['ID Pesanan', 'Tanggal', 'Nama Customer', 'Email', 'Total', 'Status'];
    }

    public function map($order): array
    {
        return [
            $order->order_number ?? '-',
            $order->created_at ? $order->created_at->format('d/m/Y H:i') : '-',
            optional($order->user)->name ?? 'Customer Umum',
            optional($order->user)->email ?? '-',
            (float) $order->total_amount,
            strtoupper($order->status),
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}
