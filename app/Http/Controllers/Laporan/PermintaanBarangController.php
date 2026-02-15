<?php

namespace App\Http\Controllers\Laporan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PermintaanBarang;
use App\Models\ProdukBatch;
use Barryvdh\DomPDF\Facade\Pdf;

class PermintaanBarangController extends Controller
{
    public function index(Request $request)
    {
        $query = PermintaanBarang::with('produk')
            ->orderBy('updated_at', 'desc');

        // Filter Tahun (dari updated_at)
        if ($request->filled('year')) {
            $query->whereYear('updated_at', $request->year);
        }

        // Filter Bulan (dari updated_at)
        if ($request->filled('month')) {
            $query->whereMonth('updated_at', $request->month);
        }

        // Filter Status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $permintaanBarang = $query->get();

        // Ambil daftar tahun unik dari updated_at
        $years = PermintaanBarang::selectRaw('YEAR(updated_at) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');

        // Daftar bulan
        $months = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',
        ];

        $statuses = ['Menunggu', 'Disetujui', 'Ditolak'];

        return view('laporan.permintaan-barang.index', [
            'permintaanBarang' => $permintaanBarang,
            'years' => $years,
            'months' => $months,
            'statuses' => $statuses,
        ]);
    }

    public function print(Request $request)
    {
        $query = PermintaanBarang::with('batch.produk')
            ->orderBy('updated_at', 'desc');

        // Filter Tahun (dari updated_at)
        if ($request->filled('year')) {
            $query->whereYear('updated_at', $request->year);
        }

        // Filter Bulan (dari updated_at)
        if ($request->filled('month')) {
            $query->whereMonth('updated_at', $request->month);
        }

        // Filter Status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $permintaanBarang = $query->get();

        // Ambil daftar tahun unik dari updated_at
        $years = PermintaanBarang::selectRaw('YEAR(updated_at) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');

        // Daftar bulan
        $months = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',
        ];

        $statuses = ['Menunggu', 'Disetujui', 'Ditolak'];

        $permintaanBarang = $query->get();

        $pdf = Pdf::loadView(
            'laporan.permintaan-barang.print',
            [
                'permintaanBarang' => $permintaanBarang,
                'years' => $years,
                'months' => $months,
                'statuses' => $statuses,
            ]
        )->setPaper('A4', 'portrait');

        return $pdf->stream('laporan-permintaan-barang.pdf');
    }
}
