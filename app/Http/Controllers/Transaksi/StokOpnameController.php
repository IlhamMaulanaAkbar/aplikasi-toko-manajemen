<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Models\ProdukBatch;
use App\Models\StokOpname;
use Illuminate\Http\Request;

class StokOpnameController extends Controller
{
    public function index()
    {
        $stokOpname = StokOpname::with('batch.produk')
            ->orderBy('tanggal_opname', 'desc')
            ->get();

        return view('transaksi.stok-opname.index', compact('stokOpname'));
    }

    public function create()
    {
        $produk = Produk::with('batch')->get();

        return view('transaksi.stok-opname.create', compact('produk'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_batch' => 'required|exists:produk_batch,id_batch',
            'tanggal_opname' => 'required|date',
            'stok_fisik' => 'required|integer|min:0',
            'keterangan' => 'nullable|string|max:255',
        ]);

        $batch = ProdukBatch::findOrFail($request->id_batch);
        $stokSistem = $batch->stok_batch;

        StokOpname::create([
            'id_batch' => $batch->id_batch,
            'tanggal_opname' => $request->tanggal_opname,
            'stok_sistem' => $stokSistem,
            'stok_fisik' => $request->stok_fisik,
            'selisih' => $request->stok_fisik - $stokSistem,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('stok-opname.index')
            ->with('success', 'Stok opname berhasil ditambahkan');
    }

    public function edit(StokOpname $stokOpname)
    {
        $produk = Produk::with('batch')->get();

        return view('transaksi.stok-opname.edit', [
            'stokOpname' => $stokOpname->load('batch.produk'),
            'produk' => $produk,
        ]);
    }

    public function update(Request $request, StokOpname $stokOpname)
    {
        $request->validate([
            'id_batch' => 'required|exists:produk_batch,id_batch',
            'tanggal_opname' => 'required|date',
            'stok_fisik' => 'required|integer|min:0',
            'keterangan' => 'nullable|string|max:255',
        ]);

        $batch = ProdukBatch::findOrFail($request->id_batch);
        $stokSistem = $batch->stok_batch;

        $stokOpname->update([
            'id_batch' => $batch->id_batch,
            'tanggal_opname' => $request->tanggal_opname,
            'stok_sistem' => $stokSistem,
            'stok_fisik' => $request->stok_fisik,
            'selisih' => $request->stok_fisik - $stokSistem,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('stok-opname.index')
            ->with('success', 'Stok opname berhasil diperbarui');
    }

    public function destroy(StokOpname $stokOpname)
    {
        $stokOpname->delete();

        return back()->with('success', 'Stok opname berhasil dihapus');
    }
}
