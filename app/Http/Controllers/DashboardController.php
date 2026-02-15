<?php

namespace App\Http\Controllers;

use App\Models\BarangMasuk;
use App\Models\BarangKeluar;
use App\Models\PermintaanBarang;
use App\Models\BarangExpired;
use App\Models\Produk;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Grafik 7 hari terakhir
        $barangMasukChart = BarangMasuk::select(
            DB::raw('DATE(tanggal_masuk) as tanggal'),
            DB::raw('SUM(jumlah) as total')
        )
            ->whereDate('tanggal_masuk', '>=', now()->subDays(7))
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get();

        $barangKeluarChart = BarangKeluar::select(
            DB::raw('DATE(tanggal_keluar) as tanggal'),
            DB::raw('SUM(jumlah) as total')
        )
            ->whereDate('tanggal_keluar', '>=', now()->subDays(7))
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get();

        // Ringkasan
        $totalMasuk = BarangMasuk::sum('jumlah');
        $totalKeluar = BarangKeluar::sum('jumlah');
        $totalExpired = BarangExpired::sum('jumlah');
        $totalPermintaan = PermintaanBarang::count();
        $totalProduk = Produk::count();

        // Permintaan terbaru
        $permintaanTerbaru = PermintaanBarang::with(['produk'])
            ->latest()
            ->take(3)
            ->get();

        return view('dashboard.index', compact(
            'barangMasukChart',
            'barangKeluarChart',
            'totalMasuk',
            'totalKeluar',
            'totalExpired',
            'totalPermintaan',
            'totalProduk',
            'permintaanTerbaru',
        ));
    }
}
