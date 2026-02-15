<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\JenisBarang;
use Illuminate\Http\Request;

class JenisBarangController extends Controller
{
    public function index()
    {
        $jenisBarang = JenisBarang::all()->sortByDesc('created_at');
        return view('master.jenis-barang.index', [
            'jenisBarang' => $jenisBarang,
        ]);
    }

    public function create()
    {
        return view('master.jenis-barang.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_jenis' => 'required|unique:jenis_barang,nama_jenis',
            'keterangan' => 'nullable'
        ]);

        JenisBarang::create([
            'nama_jenis' => $request->nama_jenis,
            'keterangan' => $request->keterangan
        ]);

        return redirect()->route('jenis-barang.index')
            ->with('success', 'Jenis barang berhasil ditambahkan');
    }

    public function edit(JenisBarang $jenisBarang)
    {
        return view('master.jenis-barang.edit', [
            'jenisBarang' => $jenisBarang,
        ]);
    }

    public function update(Request $request, JenisBarang $jenisBarang)
    {

        $request->validate([
            'nama_jenis' => 'required|unique:jenis_barang,nama_jenis,' . $jenisBarang->id_jenis . ',id_jenis',
            'keterangan' => 'nullable'
        ]);

        $jenisBarang->update([
            'nama_jenis' => $request->nama_jenis,
            'keterangan' => $request->keterangan
        ]);

        return redirect()->route('jenis-barang.index')
            ->with('success', 'Jenis barang berhasil diperbarui');
    }

    public function destroy(JenisBarang $jenisBarang)
    {
        if ($jenisBarang->produk()->count() > 0) {
            return back()->with('error', 'Jenis barang tidak bisa dihapus karena masih digunakan produk');
        }

        $jenisBarang->delete();

        return redirect()->route('jenis-barang.index')
            ->with('success', 'Jenis barang berhasil dihapus');
    }
}
