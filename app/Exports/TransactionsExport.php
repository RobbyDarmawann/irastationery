<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize; // Agar lebar kolom otomatis
use Maatwebsite\Excel\Concerns\WithStyles; // Untuk styling header
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TransactionsExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    protected $month;
    protected $year;

    public function __construct($month, $year)
    {
        $this->month = $month;
        $this->year = $year;
    }

    // 1. Ambil Data dari Database (Query)
    public function query()
    {
        return Order::query()
            ->with(['user', 'items.product'])
            ->where('status', 'completed')
            ->whereMonth('created_at', $this->month)
            ->whereYear('created_at', $this->year);
    }

    // 2. Tentukan Judul Kolom (Header Excel)
    public function headings(): array
    {
        return [
            'ID Pesanan',
            'Tanggal',
            'Pelanggan',
            'Email Pelanggan',
            'Item Produk',
            'Total Harga'
        ];
    }

    // 3. Format Data per Baris (Mapping)
    // Di sini kita atur data apa yang masuk ke kolom mana
    public function map($order): array
    {
        // Gabungkan nama produk jadi satu string rapi
        $itemList = $order->items->map(function($item) {
            $name = $item->product ? $item->product->nama_produk : 'Produk Dihapus';
            return $name . " (" . $item->quantity . "x)";
        })->implode(', ');

        return [
            '#' . $order->id,
            $order->created_at->format('d-m-Y H:i'),
            $order->user->nama_lengkap ?? 'Guest',
            $order->user->email ?? '-',
            $itemList,
            $order->total_price
        ];
    }

    // 4. Style Tambahan (Bold Header & Warna Orange Gelap)
    public function styles(Worksheet $sheet)
    {
        return [
            // Style baris pertama (Header)
            1 => [
                'font' => [
                    'bold' => true, 
                    'size' => 12,
                    'color' => ['rgb' => 'FFFFFF'], // Teks Putih
                ],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'CC5500'], // Orange Gelap (Burnt Orange)
                ],
            ],
        ];
    }
}