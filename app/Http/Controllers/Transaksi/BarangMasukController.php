<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use App\Models\BarangMasuk;
use App\Models\Produk;
use App\Models\ProdukBatch;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangMasukController extends Controller
{
    public function index()
    {
        $barangMasuk = BarangMasuk::with('batch.produk', 'supplierData')
            ->orderBy('tanggal_masuk', 'desc')
            ->get();

        return view('transaksi.barang-masuk.index', compact('barangMasuk'));
    }

    public function create()
    {
        $produk = Produk::with('batch')->get();
        $supplier = Supplier::orderBy('nama_supplier')->get();

        return view('transaksi.barang-masuk.create', compact('produk', 'supplier'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_batch' => 'required|exists:produk_batch,id_batch',
            'id_supplier' => 'required|exists:supplier,id_supplier',
            'tanggal_masuk' => 'required|date',
            'jumlah' => 'required|numeric|min:1',
            'keterangan' => 'nullable|string'
        ]);

        DB::transaction(function () use ($request) {

            $supplier = Supplier::findOrFail($request->id_supplier);
            $batch = ProdukBatch::lockForUpdate()
                ->with('produk')
                ->findOrFail($request->id_batch);

            // Simpan transaksi
            BarangMasuk::create([
                'id_batch' => $batch->id_batch,
                'id_supplier' => $supplier->id_supplier,
                'tanggal_masuk' => $request->tanggal_masuk,
                'jumlah' => $request->jumlah,
                'supplier' => $supplier->nama_supplier,
                'keterangan' => $request->keterangan,
            ]);

            // Update stok batch
            $batch->increment('stok_batch', $request->jumlah);

            // Update stok produk
            $batch->produk->update([
                'stok' => $batch->produk->batch()->sum('stok_batch')
            ]);
        });

        return redirect()
            ->route('barang-masuk.index')
            ->with('success', 'Barang masuk berhasil ditambahkan');
    }

    public function edit(BarangMasuk $barangMasuk)
    {
        $produk = Produk::with('batch')->get();
        $supplier = Supplier::orderBy('nama_supplier')->get();

        return view('transaksi.barang-masuk.edit', [
            'barangMasuk' => $barangMasuk->load('batch.produk', 'supplierData'),
            'produk' => $produk,
            'supplier' => $supplier,
        ]);
    }

    public function update(Request $request, BarangMasuk $barangMasuk)
    {
        $request->validate([
            'id_batch' => 'required|exists:produk_batch,id_batch',
            'id_supplier' => 'required|exists:supplier,id_supplier',
            'tanggal_masuk' => 'required|date',
            'jumlah' => 'required|numeric|min:1',
            'keterangan' => 'nullable|string'
        ]);

        DB::transaction(function () use ($request, $barangMasuk) {

            $supplier = Supplier::findOrFail($request->id_supplier);

            // Lock batch lama
            $batchLama = ProdukBatch::lockForUpdate()
                ->with('produk')
                ->findOrFail($barangMasuk->id_batch);

            // Kembalikan stok lama dulu
            $batchLama->decrement('stok_batch', $barangMasuk->jumlah);

            // Ambil batch baru
            $batchBaru = ProdukBatch::lockForUpdate()
                ->with('produk')
                ->findOrFail($request->id_batch);

            // Tambahkan stok baru
            $batchBaru->increment('stok_batch', $request->jumlah);

            // Update data transaksi
            $barangMasuk->update([
                'id_batch' => $request->id_batch,
                'id_supplier' => $supplier->id_supplier,
                'tanggal_masuk' => $request->tanggal_masuk,
                'jumlah' => $request->jumlah,
                'supplier' => $supplier->nama_supplier,
                'keterangan' => $request->keterangan,
            ]);

            // Update stok produk lama
            $batchLama->produk->update([
                'stok' => $batchLama->produk->batch()->sum('stok_batch')
            ]);

            // Kalau batch beda produk, update juga produk baru
            if ($batchLama->produk->id_produk != $batchBaru->produk->id_produk) {
                $batchBaru->produk->update([
                    'stok' => $batchBaru->produk->batch()->sum('stok_batch')
                ]);
            }
        });

        return redirect()
            ->route('barang-masuk.index')
            ->with('success', 'Barang masuk berhasil diperbarui');
    }


    public function destroy(BarangMasuk $barangMasuk)
    {
        DB::transaction(function () use ($barangMasuk) {

            $batch = ProdukBatch::lockForUpdate()
                ->with('produk')
                ->findOrFail($barangMasuk->id_batch);

            $batch->decrement('stok_batch', $barangMasuk->jumlah);

            $batch->produk->update([
                'stok' => $batch->produk->batch()->sum('stok_batch')
            ]);

            $barangMasuk->delete();
        });

        return back()->with('success', 'Data barang masuk dihapus');
    }
}
