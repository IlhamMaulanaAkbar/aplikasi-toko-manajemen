<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Models\JenisBarang;
use App\Models\SatuanBarang;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index()
    {
        $produk = Produk::with(['jenis', 'satuan'])->get();
        return view('master.produk.index', compact('produk'));
    }

    public function create()
    {
        $jenisBarang = JenisBarang::all();
        $satuanBarang = SatuanBarang::all();
        return view('master.produk.create', compact('jenisBarang', 'satuanBarang'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_produk' => 'required|unique:produk,kode_produk',
            'nama_produk' => 'required',
            'id_jenis' => 'required',
            'id_satuan' => 'required',
        ]);

        Produk::create([
            'kode_produk' => $request->kode_produk,
            'nama_produk' => $request->nama_produk,
            'brand' => $request->brand,
            'id_jenis' => $request->id_jenis,
            'id_satuan' => $request->id_satuan,
            'stok' => 0, // default 0
            'stok_minimum' => $request->stok_minimum ?? 0,
        ]);

        return redirect()->route('produk.index')
            ->with('success', 'Produk berhasil ditambahkan');
    }

    public function edit($id)
    {
        $produk = Produk::findOrFail($id);
        $jenisBarang = JenisBarang::all();
        $satuanBarang = SatuanBarang::all();

        return view('master.produk.edit', compact(
            'produk',
            'jenisBarang',
            'satuanBarang'
        ));
    }

    public function update(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);

        $request->validate([
            'kode_produk' => 'required|unique:produk,kode_produk,' . $id . ',id_produk',
            'nama_produk' => 'required',
            'id_jenis_barang' => 'required',
            'id_satuan_barang' => 'required',
        ]);

        $produk->update($request->all());

        return redirect()->route('produk.index')
            ->with('success', 'Produk berhasil diperbarui');
    }

    public function destroy($id)
    {
        Produk::findOrFail($id)->delete();
        return redirect()->route('produk.index')
            ->with('success', 'Produk berhasil dihapus');
    }
}
