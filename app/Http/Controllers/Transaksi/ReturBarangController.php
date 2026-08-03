<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Models\ProdukBatch;
use App\Models\ReturBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class ReturBarangController extends Controller
{
    public function index()
    {
        $returBarang = ReturBarang::with('batch.produk')
            ->orderBy('tanggal_retur', 'desc')
            ->get();

        return view('transaksi.retur-barang.index', compact('returBarang'));
    }

    public function create()
    {
        $produk = Produk::with('batch')->get();

        return view('transaksi.retur-barang.create', compact('produk'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_batch' => 'required|exists:produk_batch,id_batch',
            'tanggal_retur' => 'required|date',
            'jumlah' => 'required|integer|min:1',
            'jenis_retur' => 'required|string|max:50',
            'tujuan_retur' => 'required|string|max:100',
            'keterangan' => 'nullable|string|max:255',
        ]);

        DB::transaction(function () use ($request) {
            $batch = ProdukBatch::lockForUpdate()
                ->with('produk')
                ->findOrFail($request->id_batch);

            if ($request->jumlah > $batch->stok_batch) {
                throw ValidationException::withMessages([
                    'jumlah' => 'Jumlah melebihi stok batch.',
                ]);
            }

            ReturBarang::create([
                'id_batch' => $batch->id_batch,
                'tanggal_retur' => $request->tanggal_retur,
                'jumlah' => $request->jumlah,
                'jenis_retur' => $request->jenis_retur,
                'tujuan_retur' => $request->tujuan_retur,
                'keterangan' => $request->keterangan,
            ]);

            $batch->decrement('stok_batch', $request->jumlah);
            $batch->produk->update([
                'stok' => $batch->produk->batch()->sum('stok_batch')
            ]);
        });

        return redirect()->route('retur-barang.index')
            ->with('success', 'Retur barang berhasil ditambahkan');
    }

    public function edit(ReturBarang $returBarang)
    {
        $produk = Produk::with('batch')->get();

        return view('transaksi.retur-barang.edit', [
            'returBarang' => $returBarang->load('batch.produk'),
            'produk' => $produk,
        ]);
    }

    public function update(Request $request, ReturBarang $returBarang)
    {
        $request->validate([
            'id_batch' => 'required|exists:produk_batch,id_batch',
            'tanggal_retur' => 'required|date',
            'jumlah' => 'required|integer|min:1',
            'jenis_retur' => 'required|string|max:50',
            'tujuan_retur' => 'required|string|max:100',
            'keterangan' => 'nullable|string|max:255',
        ]);

        DB::transaction(function () use ($request, $returBarang) {
            $batchLama = ProdukBatch::lockForUpdate()
                ->with('produk')
                ->findOrFail($returBarang->id_batch);

            $batchLama->increment('stok_batch', $returBarang->jumlah);

            $batchBaru = ProdukBatch::lockForUpdate()
                ->with('produk')
                ->findOrFail($request->id_batch);

            if ($request->jumlah > $batchBaru->stok_batch) {
                throw ValidationException::withMessages([
                    'jumlah' => 'Jumlah melebihi stok batch.',
                ]);
            }

            $batchBaru->decrement('stok_batch', $request->jumlah);

            $returBarang->update([
                'id_batch' => $batchBaru->id_batch,
                'tanggal_retur' => $request->tanggal_retur,
                'jumlah' => $request->jumlah,
                'jenis_retur' => $request->jenis_retur,
                'tujuan_retur' => $request->tujuan_retur,
                'keterangan' => $request->keterangan,
            ]);

            $batchLama->produk->update([
                'stok' => $batchLama->produk->batch()->sum('stok_batch')
            ]);

            if ($batchLama->produk->id_produk != $batchBaru->produk->id_produk) {
                $batchBaru->produk->update([
                    'stok' => $batchBaru->produk->batch()->sum('stok_batch')
                ]);
            }
        });

        return redirect()->route('retur-barang.index')
            ->with('success', 'Retur barang berhasil diperbarui');
    }

    public function destroy(ReturBarang $returBarang)
    {
        DB::transaction(function () use ($returBarang) {
            $batch = ProdukBatch::lockForUpdate()
                ->with('produk')
                ->findOrFail($returBarang->id_batch);

            $batch->increment('stok_batch', $returBarang->jumlah);
            $batch->produk->update([
                'stok' => $batch->produk->batch()->sum('stok_batch')
            ]);

            $returBarang->delete();
        });

        return back()->with('success', 'Retur barang berhasil dihapus');
    }
}
