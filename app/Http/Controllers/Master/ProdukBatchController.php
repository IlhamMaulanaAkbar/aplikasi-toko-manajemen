<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Models\ProdukBatch;
use Illuminate\Http\Request;

class ProdukBatchController extends Controller
{
    public function index(Produk $produk)
    {
        $batch = $produk->batch()
            ->orderBy('tanggal_expired', 'asc')
            ->get();

        return view('master.produk-batch.index', [
            'produk' => $produk,
            'batch' => $batch,
        ]);
    }

    public function create(Produk $produk)
    {
        $produk->load('batch');

        return view('master.produk-batch.create', [
            'produk' => $produk,
        ]);
    }

    public function store(Request $request, Produk $produk)
    {
        $request->validate([
            'id_produk' => 'required',
            'nomor_batch' => 'required',
            'tanggal_expired' => 'required|date',
            'stok_batch' => 'required|numeric|min:1'
        ]);

        ProdukBatch::create([
            'id_produk' => $request->id_produk,
            'nomor_batch' => $request->nomor_batch,
            'tanggal_expired' => $request->tanggal_expired,
            'stok_batch' => $request->stok_batch,
        ]);

        $this->updateStokProduk($produk);
        return redirect()->route('produk-batch.index', $produk)->with('success', 'Batch berhasil ditambahkan');
    }

    public function edit(ProdukBatch $batch)
    {
        return view('master.produk-batch.edit', [
            'batch' => $batch,
        ]);
    }

    public function update(Request $request, ProdukBatch $batch)
    {
        $request->validate([
            'nomor_batch' => 'required',
            'tanggal_expired' => 'required|date',
            'stok_batch' => 'required|numeric|min:0'
        ]);

        $batch->update($request->only([
            'nomor_batch',
            'tanggal_expired',
            'stok_batch'
        ]));

        $this->updateStokProduk($batch->produk);

        return redirect()
            ->route('produk-batch.index', $batch->id_produk)
            ->with('success', 'Batch berhasil diperbarui');
    }

    public function destroy(ProdukBatch $batch)
    {
        $produk = $batch->produk;

        $batch->delete();

        $this->updateStokProduk($produk);

        return back()->with('success', 'Batch berhasil dihapus');
    }

    private function updateStokProduk(Produk $produk)
    {
        $produk->update([
            'stok' => $produk->batch()->sum('stok_batch')
        ]);
    }
}
