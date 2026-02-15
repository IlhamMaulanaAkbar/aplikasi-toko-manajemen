<?php

namespace App\Http\Controllers\Laporan;

use App\Http\Controllers\Controller;
use App\Models\JenisBarang;
use App\Models\Produk;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ProdukController extends Controller
{
    public function index(Request $request)
    {
        $query = Produk::with(['jenis', 'satuan', 'batch']);

        // Filter jenis
        if ($request->filled('jenis')) {
            $query->where('id_jenis', $request->jenis);
        }

        $produk = $query->get();

        // Tambahkan stok_total & status ke model
        foreach ($produk as $item) {

            $item->stok_total = $item->batch->sum('stok_batch');

            if ($item->stok_total <= 0) {
                $item->status_stok = 'Habis';
            } elseif ($item->stok_total <= $item->stok_minimum) {
                $item->status_stok = 'Minimum';
            } else {
                $item->status_stok = 'Aman';
            }
        }

        // 🔥 Filter stok SETELAH dihitung
        if ($request->stok == 'minimum') {
            $produk = $produk->where('status_stok', 'Minimum');
        }

        if ($request->stok == 'aman') {
            $produk = $produk->where('status_stok', 'Aman');
        }

        $jenisBarang = JenisBarang::all();

        return view('laporan.produk.index', compact('produk', 'jenisBarang'));
    }


    public function print(Request $request)
    {
        $query = Produk::with(['jenis', 'satuan', 'batch']);

        // Filter jenis
        if ($request->filled('jenis')) {
            $query->where('id_jenis', $request->jenis);
        }

        $produk = $query->get();

        // Tambahkan stok_total & status ke model
        foreach ($produk as $item) {

            $item->stok_total = $item->batch->sum('stok_batch');

            if ($item->stok_total <= 0) {
                $item->status_stok = 'Habis';
            } elseif ($item->stok_total <= $item->stok_minimum) {
                $item->status_stok = 'Minimum';
            } else {
                $item->status_stok = 'Aman';
            }
        }

        // 🔥 Filter stok SETELAH dihitung
        if ($request->stok == 'minimum') {
            $produk = $produk->where('status_stok', 'Minimum');
        }

        if ($request->stok == 'aman') {
            $produk = $produk->where('status_stok', 'Aman');
        }

        $jenisBarang = JenisBarang::all();

        $pdf = Pdf::loadView('laporan.produk.print', compact('produk'))
            ->setPaper('A4', 'portrait');

        return $pdf->stream('laporan-produk.pdf');
    }
}
