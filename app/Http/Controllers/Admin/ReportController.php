<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

// Import Library Excel dan Export Classes
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TransactionsExport;
use App\Exports\ProductsExport;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $month = $request->input('month', now()->month);
        $year = $request->input('year', now()->year);

        // Ambil Pesanan
        $orders = Order::with(['user', 'items.product'])
            ->where('status', 'completed')
            ->whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->latest()
            ->get();

        // Hitung Ringkasan
        $totalRevenue = $orders->sum('total_price');
        $totalTransactions = $orders->count();
        $totalItemsSold = $orders->sum(function ($order) {
            return $order->items->sum('quantity');
        });

        // Hitung Produk Terlaris
        $topProducts = OrderItem::whereHas('order', function($q) use ($month, $year) {
                $q->where('status', 'completed')
                  ->whereMonth('created_at', $month)
                  ->whereYear('created_at', $year);
            })
            ->select('product_id', DB::raw('SUM(quantity) as total_qty'), DB::raw('SUM(quantity * price) as total_income'))
            ->with('product')
            ->groupBy('product_id')
            ->orderByDesc('total_qty')
            ->get();

        return view('admin.reports.index', compact(
            'orders', 'topProducts', 
            'totalRevenue', 'totalTransactions', 'totalItemsSold', 
            'month', 'year'
        ));
    }

    /**
     * Export Transaksi ke .xlsx
     */
    public function exportTransactions(Request $request)
    {
        $month = $request->input('month', now()->month);
        $year = $request->input('year', now()->year);
        $dateName = Carbon::createFromDate($year, $month)->format('F_Y');
        
        // Menggunakan Library Excel dengan class export khusus
        return Excel::download(new TransactionsExport($month, $year), "Laporan_Transaksi_{$dateName}.xlsx");
    }

    /**
     * Export Produk ke .xlsx
     */
    public function exportProducts(Request $request)
    {
        $month = $request->input('month', now()->month);
        $year = $request->input('year', now()->year);
        $dateName = Carbon::createFromDate($year, $month)->format('F_Y');

        // Menggunakan Library Excel dengan class export khusus
        return Excel::download(new ProductsExport($month, $year), "Laporan_Produk_Terlaris_{$dateName}.xlsx");
    }
}