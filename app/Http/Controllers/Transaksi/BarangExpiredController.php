<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use App\Models\BarangExpired;
use App\Models\Produk;
use App\Models\ProdukBatch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangExpiredController extends Controller
{
    public function index()
    {
        $barangExpired = BarangExpired::with('batch.produk')->latest()->get();

        return view('transaksi.barang-expired.index', compact('barangExpired'));
    }

    public function create()
    {
        $produk = Produk::with('batch')->get();

        return view('transaksi.barang-expired.create', compact('produk'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_batch' => 'required|exists:produk_batch,id_batch',
            'tanggal_dicatat' => 'required|date',
            'jumlah' => 'required|integer|min:1',
            'keterangan' => 'nullable|string'
        ]);

        DB::transaction(function () use ($request) {

            $batch = ProdukBatch::findOrFail($request->id_batch);

            if ($request->jumlah > $batch->stok_batch) {
                throw new \Exception('Jumlah melebihi stok batch.');
            }

            $batch->decrement('stok_batch', $request->jumlah);

            BarangExpired::create([
                'id_batch' => $request->id_batch,
                'tanggal_dicatat' => $request->tanggal_dicatat,
                'jumlah' => $request->jumlah,
                'status' => $request->status,
                'keterangan' => $request->keterangan,
            ]);
        });

        return redirect()->route('barang-expired.index')
            ->with('success', 'Barang expired berhasil dicatat & stok dikurangi');
    }

    public function edit(BarangExpired $barangExpired)
    {
        $produk = Produk::with('batch')->get();

        return view('transaksi.barang-expired.edit', compact(
            'barangExpired',
            'produk'
        ));
    }

    public function update(Request $request, BarangExpired $barangExpired)
    {
        $request->validate([
            'id_batch' => 'required|exists:produk_batch,id_batch',
            'tanggal_dicatat' => 'required|date',
            'jumlah' => 'required|integer|min:1',
            'keterangan' => 'nullable|string'
        ]);

        DB::transaction(function () use ($request, $barangExpired) {

            $batch = ProdukBatch::findOrFail($request->id_batch);

            $batch->increment('stok_batch', $barangExpired->jumlah);

            if ($request->jumlah > $batch->stok_batch) {
                throw new \Exception('Jumlah melebihi stok batch.');
            }

            $batch->decrement('stok_batch', $request->jumlah);

            $barangExpired->update([
                'id_batch' => $request->id_batch,
                'tanggal_dicatat' => $request->tanggal_dicatat,
                'jumlah' => $request->jumlah,
                'status' => $request->status,
                'keterangan' => $request->keterangan,
            ]);
        });

        return redirect()->route('barang-expired.index')
            ->with('success', 'Data barang expired berhasil diperbarui & stok disesuaikan');
    }


    public function destroy(BarangExpired $barangExpired)
    {
        DB::transaction(function () use ($barangExpired) {

            $batch = $barangExpired->batch;

            // Kembalikan stok
            $batch->increment('stok_batch', $barangExpired->jumlah);

            $barangExpired->delete();
        });

        return redirect()->route('barang-expired.index')
            ->with('success', 'Data expired dihapus & stok dikembalikan');
    }
}
