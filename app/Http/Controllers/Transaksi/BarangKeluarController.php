<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use App\Models\BarangKeluar;
use App\Models\Produk;
use App\Models\ProdukBatch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangKeluarController extends Controller
{
    public function index()
    {
        $barangKeluar = BarangKeluar::with('batch.produk')
            ->orderBy('tanggal_keluar', 'desc')
            ->get();

        return view('transaksi.barang-keluar.index', [
            'barangKeluar' => $barangKeluar,
        ]);
    }

    public function create()
    {
        $produk = Produk::with('batch')->get();

        return view('transaksi.barang-keluar.create', [
            'produk' => $produk,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_batch' => 'required|exists:produk_batch,id_batch',
            'tanggal_keluar' => 'required|date',
            'jumlah' => 'required|numeric|min:1',
            'tujuan' => 'required|string|max:255',
            'keterangan' => 'nullable|string'
        ]);

        DB::transaction(function () use ($request) {

            // Lock batch biar aman dari race condition
            $batch = ProdukBatch::lockForUpdate()
                ->with('produk')
                ->findOrFail($request->id_batch);

            if ($batch->stok_batch < $request->jumlah) {
                throw new \Exception('Stok batch tidak mencukupi.');
            }

            // Simpan transaksi
            BarangKeluar::create([
                'id_batch' => $batch->id_batch,
                'tanggal_keluar' => $request->tanggal_keluar,
                'jumlah' => $request->jumlah,
                'tujuan' => $request->tujuan,
                'keterangan' => $request->keterangan,
            ]);

            // Kurangi stok batch
            $batch->decrement('stok_batch', $request->jumlah);

            // Update stok produk utama
            $batch->produk->update([
                'stok' => $batch->produk->batch()->sum('stok_batch')
            ]);
        });

        return redirect()
            ->route('barang-keluar.index')
            ->with('success', 'Barang keluar berhasil ditambahkan');
    }

    public function edit(BarangKeluar $barangKeluar)
    {
        $produk = Produk::with('batch')->get();

        return view('transaksi.barang-keluar.edit', [
            'barangKeluar' => $barangKeluar->load('batch.produk'),
            'produk' => $produk,
        ]);
    }

    public function update(Request $request, BarangKeluar $barangKeluar)
    {
        $request->validate([
            'id_batch' => 'required|exists:produk_batch,id_batch',
            'tanggal_keluar' => 'required|date',
            'jumlah' => 'required|numeric|min:1',
            'tujuan' => 'required|string|max:255',
            'keterangan' => 'nullable|string'
        ]);

        DB::transaction(function () use ($request, $barangKeluar) {

            // Lock batch lama
            $batchLama = ProdukBatch::lockForUpdate()
                ->with('produk')
                ->findOrFail($barangKeluar->id_batch);

            // Kembalikan stok lama
            $batchLama->increment('stok_batch', $barangKeluar->jumlah);

            // Update stok produk lama
            $batchLama->produk->update([
                'stok' => $batchLama->produk->batch()->sum('stok_batch')
            ]);

            // Lock batch baru
            $batchBaru = ProdukBatch::lockForUpdate()
                ->with('produk')
                ->findOrFail($request->id_batch);

            // Cek stok batch baru
            if ($batchBaru->stok_batch < $request->jumlah) {
                throw new \Exception('Stok batch tidak mencukupi.');
            }

            // Kurangi stok baru
            $batchBaru->decrement('stok_batch', $request->jumlah);

            // Update stok produk baru
            $batchBaru->produk->update([
                'stok' => $batchBaru->produk->batch()->sum('stok_batch')
            ]);

            // Update data transaksi
            $barangKeluar->update([
                'id_batch' => $request->id_batch,
                'tanggal_keluar' => $request->tanggal_keluar,
                'jumlah' => $request->jumlah,
                'tujuan' => $request->tujuan,
                'keterangan' => $request->keterangan,
            ]);
        });

        return redirect()
            ->route('barang-keluar.index')
            ->with('success', 'Data barang keluar berhasil diperbarui');
    }


    public function destroy(BarangKeluar $barangKeluar)
    {
        DB::transaction(function () use ($barangKeluar) {

            $batch = ProdukBatch::lockForUpdate()
                ->with('produk')
                ->findOrFail($barangKeluar->id_batch);

            // Kembalikan stok batch
            $batch->increment('stok_batch', $barangKeluar->jumlah);

            // Update stok produk
            $batch->produk->update([
                'stok' => $batch->produk->batch()->sum('stok_batch')
            ]);

            $barangKeluar->delete();
        });

        return back()->with('success', 'Data barang keluar dihapus');
    }
}
