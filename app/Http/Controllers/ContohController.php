<?php

namespace App\Http\Controllers;

use App\Models\Produk; // Pastikan nama class model benar
use ArielMejiaDev\LarapexCharts\Facades\LarapexChart;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContohController extends Controller
{
    public function TampilContoh()
    {
        // Misalnya ini adalah variabel yang menentukan apakah user adalah admin atau bukan
        $isAdmin = Auth::user()->role === 'admin';

        // Ambil produk dari database dan kelompokkan berdasarkan tanggal
        $produkPerHariQuery = Produk::selectRaw('DATE(created_at) as date, COUNT(*) as total')
            ->groupBy('date')
            ->orderBy('date', 'asc');

        if (!$isAdmin) {
            $produkPerHariQuery->where('user_id', Auth::id());
        }

        $produkPerHari = $produkPerHariQuery->get();

        // Memisahkan data untuk grafik
        $dates = [];
        $totals = [];

        foreach ($produkPerHari as $item) {
            $dates[] = Carbon::parse($item->date)->format('Y-m-d'); // format tanggal
            $totals[] = $item->total;
        }

        // Membuat grafik menggunakan data yang diambil
        $chart = LarapexChart::barChart()
            ->setTitle('Produk Ditambahkan Per Hari')
            ->setSubtitle('Data Penambahan Produk Harian')
            ->addData('Jumlah Produk', $totals)
            ->setXAxis($dates);

        // Hitung total produk dengan filter user jika bukan admin
        $totalProductsQuery = Produk::query();
        if (!$isAdmin) {
            $totalProductsQuery->where('user_id', Auth::id());
        }
        $totalProducts = $totalProductsQuery->count();

        // Data tambahan untuk view
        $data = [
            'totalProducts' => $totalProducts, // Total produk dengan filter
            'salesToday' => 130, // Contoh data lainnya
            'totalRevanue' => 'Rp 75,000,000',
            'registeredUsers' => 350,
            'chart' => $chart // Pass chart ke view
        ];

        return view('contoh', $data);
    }
}
