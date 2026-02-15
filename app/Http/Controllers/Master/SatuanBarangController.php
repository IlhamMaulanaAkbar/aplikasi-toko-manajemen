<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\SatuanBarang;
use Illuminate\Http\Request;

class SatuanBarangController extends Controller
{
    public function index()
    {
        $satuanBarang = SatuanBarang::all()->sortByDesc('created_at');
        return view('master.satuan-barang.index', [
            'satuanBarang' => $satuanBarang,
        ]);
    }

    public function create()
    {
        return view('master.satuan-barang.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_satuan' => 'required|unique:satuan_barang,nama_satuan',
            'keterangan'  => 'nullable'
        ]);

        SatuanBarang::create([
            'nama_satuan' => $request->nama_satuan,
            'keterangan'  => $request->keterangan
        ]);

        return redirect()->route('satuan-barang.index')
            ->with('success', 'Satuan barang berhasil ditambahkan');
    }

    public function edit(SatuanBarang $satuanBarang)
    {
        return view('master.satuan-barang.edit', [
            'satuanBarang' => $satuanBarang,
        ]);
    }

    public function update(Request $request, SatuanBarang $satuanBarang)
    {
        $request->validate([
            'nama_satuan' => 'required|unique:satuan_barang,nama_satuan,'
                . $satuanBarang->id_satuan . ',id_satuan',
            'keterangan'  => 'nullable'
        ]);

        $satuanBarang->update([
            'nama_satuan' => $request->nama_satuan,
            'keterangan'  => $request->keterangan
        ]);

        return redirect()->route('satuan-barang.index')
            ->with('success', 'Satuan barang berhasil diperbarui');
    }

    public function destroy(SatuanBarang $satuanBarang)
    {
        if ($satuanBarang->produk()->count() > 0) {
            return back()->with(
                'error',
                'Satuan barang tidak bisa dihapus karena masih digunakan produk'
            );
        }

        $satuanBarang->delete();

        return redirect()->route('satuan-barang.index')
            ->with('success', 'Satuan barang berhasil dihapus');
    }
}
