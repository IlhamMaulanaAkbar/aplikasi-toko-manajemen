<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use App\Models\PermintaanBarang;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class PermintaanBarangController extends Controller
{
    public function index()
    {
        $permintaanBarang = PermintaanBarang::with('produk')->latest()->get();
        return view('transaksi.permintaan-barang.index', compact('permintaanBarang'));
    }

    public function create()
    {
        $produkList = Produk::all();
        return view('transaksi.permintaan-barang.create', compact('produkList'));
    }

    public function edit(PermintaanBarang $permintaanBarang)
    {
        if ($permintaanBarang->status !== 'Menunggu') {
            return redirect()
                ->route('permintaan-barang.index')
                ->with('error', 'Permintaan yang sudah diproses tidak dapat diedit');
        }

        $produkList = Produk::all();

        return view('transaksi.permintaan-barang.edit', [
            'permintaanBarang' => $permintaanBarang,
            'produkList' => $produkList
        ]);
    }

    public function update(Request $request, PermintaanBarang $permintaanBarang)
    {
        if ($permintaanBarang->status !== 'Menunggu') {
            return redirect()
                ->route('permintaan-barang.index')
                ->with('error', 'Permintaan yang sudah diproses tidak dapat diubah');
        }

        $request->validate([
            'id_produk' => 'required|exists:produk,id_produk',
            'tanggal_permintaan' => 'required|date',
            'jumlah_diminta' => 'required|integer|min:1',
            'keterangan' => 'nullable|string|max:255'
        ]);

        $permintaanBarang->update([
            'id_produk' => $request->id_produk,
            'tanggal_permintaan' => $request->tanggal_permintaan,
            'jumlah_diminta' => $request->jumlah_diminta,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()
            ->route('permintaan-barang.index')
            ->with('success', 'Permintaan berhasil diperbarui');
    }


    public function store(Request $request)
    {
        $request->validate([
            'id_produk' => 'required|exists:produk,id_produk',
            'tanggal_permintaan' => 'required|date',
            'jumlah_diminta' => 'required|integer|min:1',
        ]);

        PermintaanBarang::create([
            'id_produk' => $request->id_produk,
            'tanggal_permintaan' => $request->tanggal_permintaan,
            'jumlah_diminta' => $request->jumlah_diminta,
            'status' => 'Menunggu',
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('permintaan-barang.index')
            ->with('success', 'Permintaan berhasil dibuat dan menunggu persetujuan');
    }

    public function approve(PermintaanBarang $permintaanBarang)
    {
        $userRole = Auth::user()->role->nama_role ?? null;

        if (!in_array($userRole, ['Manajer Toko', 'Super Admin'])) {
            abort(403);
        }


        if ($permintaanBarang->status !== 'Menunggu') {
            return back()->with('error', 'Permintaan sudah diproses');
        }

        $permintaanBarang->update([
            'status' => 'Disetujui'
        ]);

        return redirect()
            ->route('permintaan-barang.pdf', $permintaanBarang)
            ->with('success', 'Permintaan disetujui');
    }


    public function reject(PermintaanBarang $permintaanBarang)
    {
        $userRole = Auth::user()->role->nama_role ?? null;

        if (!in_array($userRole, ['Manajer Toko', 'Super Admin'])) {
            abort(403);
        }


        if ($permintaanBarang->status !== 'Menunggu') {
            return back()->with('error', 'Permintaan sudah diproses');
        }

        $permintaanBarang->update([
            'status' => 'Ditolak'
        ]);

        return back()->with('success', 'Permintaan ditolak');
    }

    public function generatePdf(PermintaanBarang $permintaanBarang)
    {
        if ($permintaanBarang->status !== 'Disetujui') {
            abort(403);
        }

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView(
            'transaksi.permintaan-barang.surat',
            compact('permintaanBarang')
        );

        return $pdf->stream(
            'Surat_Persetujuan_' . $permintaanBarang->id_permintaan . '.pdf'
        );
    }


    public function destroy(PermintaanBarang $permintaanBarang)
    {
        if ($permintaanBarang->status === 'Disetujui') {
            return back()->with('error', 'Permintaan yang sudah disetujui tidak bisa dihapus');
        }

        $permintaanBarang->delete();

        return back()->with('success', 'Data berhasil dihapus');
    }
}
