@extends('layouts.app')

@section('title', 'Edit Permintaan Barang')

@section('content')
    <div class="card">

        <div class="card-header">
            <h5 class="fw-semibold mb-0">Edit Permintaan Barang</h5>
        </div>

        <div class="card-body">
            <form action="{{ route('permintaan-barang.update', $permintaanBarang) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label>Produk</label>
                        <select name="id_produk" class="form-control" required>
                            @foreach ($produkList as $produk)
                                <option value="{{ $produk->id_produk }}"
                                    {{ $permintaanBarang->id_produk == $produk->id_produk ? 'selected' : '' }}>
                                    {{ $produk->nama_produk }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Tanggal Permintaan</label>
                        <input type="date" name="tanggal_permintaan" value="{{ $permintaanBarang->tanggal_permintaan }}"
                            class="form-control" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Jumlah Diminta</label>
                        <input type="number" name="jumlah_diminta" value="{{ $permintaanBarang->jumlah_diminta }}"
                            class="form-control" min="1" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Keterangan</label>
                        <textarea name="keterangan" class="form-control">{{ $permintaanBarang->keterangan }}</textarea>
                    </div>

                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('permintaan-barang.index') }}" class="btn btn-secondary me-2">
                        Kembali
                    </a>
                    <button type="submit" class="btn btn-primary">
                        Update
                    </button>
                </div>

            </form>
        </div>

    </div>
@endsection
