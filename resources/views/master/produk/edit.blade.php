@extends('layouts.app')

@section('title', 'Edit Produk')

@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="card-title fw-semibold">Edit Produk</h5>
        </div>

        <div class="card-body">
            <form action="{{ route('produk.update', $produk->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">

                    {{-- Kode Produk --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Kode Produk</label>
                        <input type="text" name="kode_produk"
                            class="form-control @error('kode_produk') is-invalid @enderror"
                            value="{{ old('kode_produk', $produk->kode_produk) }}">

                        @error('kode_produk')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Nama Produk --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nama Produk</label>
                        <input type="text" name="nama_produk"
                            class="form-control @error('nama_produk') is-invalid @enderror"
                            value="{{ old('nama_produk', $produk->nama_produk) }}">

                        @error('nama_produk')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Brand --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Brand</label>
                        <input type="text" name="brand" class="form-control @error('brand') is-invalid @enderror"
                            value="{{ old('brand', $produk->brand) }}">

                        @error('brand')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Jenis --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Jenis Barang</label>
                        <select name="id_jenis" class="form-select @error('id_jenis') is-invalid @enderror">
                            <option value="">-- Pilih Jenis --</option>
                            @foreach ($jenisBarang as $j)
                                <option value="{{ $j->id_jenis }}"
                                    {{ old('id_jenis', $produk->id_jenis) == $j->id_jenis ? 'selected' : '' }}>
                                    {{ $j->nama_jenis }}
                                </option>
                            @endforeach
                        </select>

                        @error('id_jenis')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Satuan --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Satuan Barang</label>
                        <select name="id_satuan" class="form-select @error('id_satuan') is-invalid @enderror">
                            <option value="">-- Pilih Satuan --</option>
                            @foreach ($satuanBarang as $s)
                                <option value="{{ $s->id_satuan }}"
                                    {{ old('id_satuan', $produk->id_satuan) == $s->id_satuan ? 'selected' : '' }}>
                                    {{ $s->nama_satuan }}
                                </option>
                            @endforeach
                        </select>

                        @error('id_satuan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Stok Minimum --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Stok Minimum</label>
                        <input type="number" name="stok_minimum"
                            class="form-control @error('stok_minimum') is-invalid @enderror"
                            value="{{ old('stok_minimum', $produk->stok_minimum) }}">

                        @error('stok_minimum')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('produk.index') }}" class="btn btn-secondary me-2">
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
