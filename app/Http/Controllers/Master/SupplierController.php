<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
        $supplier = Supplier::orderBy('created_at', 'desc')->get();

        return view('master.supplier.index', compact('supplier'));
    }

    public function create()
    {
        return view('master.supplier.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_supplier' => 'required|string|max:30|unique:supplier,kode_supplier',
            'nama_supplier' => 'required|string|max:100',
            'alamat' => 'nullable|string',
            'no_telepon' => 'nullable|string|max:30',
            'email' => 'nullable|email|max:100',
            'kontak_person' => 'nullable|string|max:100',
            'keterangan' => 'nullable|string|max:255',
        ]);

        Supplier::create($request->only([
            'kode_supplier',
            'nama_supplier',
            'alamat',
            'no_telepon',
            'email',
            'kontak_person',
            'keterangan',
        ]));

        return redirect()->route('supplier.index')
            ->with('success', 'Supplier berhasil ditambahkan');
    }

    public function edit(Supplier $supplier)
    {
        return view('master.supplier.edit', compact('supplier'));
    }

    public function update(Request $request, Supplier $supplier)
    {
        $request->validate([
            'kode_supplier' => 'required|string|max:30|unique:supplier,kode_supplier,' . $supplier->id_supplier . ',id_supplier',
            'nama_supplier' => 'required|string|max:100',
            'alamat' => 'nullable|string',
            'no_telepon' => 'nullable|string|max:30',
            'email' => 'nullable|email|max:100',
            'kontak_person' => 'nullable|string|max:100',
            'keterangan' => 'nullable|string|max:255',
        ]);

        $supplier->update($request->only([
            'kode_supplier',
            'nama_supplier',
            'alamat',
            'no_telepon',
            'email',
            'kontak_person',
            'keterangan',
        ]));

        return redirect()->route('supplier.index')
            ->with('success', 'Supplier berhasil diperbarui');
    }

    public function destroy(Supplier $supplier)
    {
        if ($supplier->barangMasuk()->count() > 0) {
            return back()->with('error', 'Supplier tidak bisa dihapus karena masih digunakan barang masuk');
        }

        $supplier->delete();

        return redirect()->route('supplier.index')
            ->with('success', 'Supplier berhasil dihapus');
    }
}
