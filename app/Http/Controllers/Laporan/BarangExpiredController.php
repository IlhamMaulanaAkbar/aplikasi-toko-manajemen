<?php

namespace App\Http\Controllers\Laporan;

use App\Http\Controllers\Controller;
use App\Models\BarangExpired;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class BarangExpiredController extends Controller
{
    public function index(Request $request)
    {
        $query = BarangExpired::with('batch.produk')
            ->orderBy('updated_at', 'desc');

        // Filter Tahun (dari updated_at)
        if ($request->filled('year')) {
            $query->whereYear('updated_at', $request->year);
        }

        // Filter Bulan (dari updated_at)
        if ($request->filled('month')) {
            $query->whereMonth('updated_at', $request->month);
        }

        $barangExpired = $query->get();

        // Ambil daftar tahun unik dari updated_at
        $years = BarangExpired::selectRaw('YEAR(updated_at) as year')
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

        return view('laporan.barang-expired.index', [
            'barangExpired' => $barangExpired,
            'years' => $years,
            'months' => $months,
        ]);
    }

    public function print(Request $request)
    {
        $query = BarangExpired::with('batch.produk')
            ->orderBy('updated_at', 'desc');

        // Filter Tahun (dari updated_at)
        if ($request->filled('year')) {
            $query->whereYear('updated_at', $request->year);
        }

        // Filter Bulan (dari updated_at)
        if ($request->filled('month')) {
            $query->whereMonth('updated_at', $request->month);
        }

        $barangExpired = $query->get();

        // Ambil daftar tahun unik dari updated_at
        $years = BarangExpired::selectRaw('YEAR(updated_at) as year')
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

        $barangExpired = $query->get();

        $pdf = Pdf::loadView(
            'laporan.barang-expired.print',
            [
                'barangExpired' => $barangExpired,
                'years' => $years,
                'months' => $months,
            ]
        )->setPaper('A4', 'portrait');

        return $pdf->stream('laporan-barang-expired.pdf');
    }
}
