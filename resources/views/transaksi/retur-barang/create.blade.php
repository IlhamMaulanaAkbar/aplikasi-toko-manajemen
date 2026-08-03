@extends('layouts.app')

@section('title', 'Tambah Retur Barang')

@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="fw-semibold mb-0">Tambah Retur Barang</h5>
        </div>

        <div class="card-body">
            <form action="{{ route('retur-barang.store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Produk</label>
                        <select id="produkSelect" class="form-control">
                            <option value="">-- Pilih Produk --</option>
                            @foreach ($produk as $p)
                                <option value="{{ $p->id_produk }}">{{ $p->nama_produk }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Batch</label>
                        <select name="id_batch" id="batchSelect"
                            class="form-control @error('id_batch') is-invalid @enderror" required>
                            <option value="">-- Pilih Batch --</option>
                        </select>
                        @error('id_batch')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Tanggal Retur</label>
                        <input type="date" name="tanggal_retur"
                            class="form-control @error('tanggal_retur') is-invalid @enderror"
                            value="{{ old('tanggal_retur') }}" required>
                        @error('tanggal_retur')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Jumlah</label>
                        <input type="number" name="jumlah" class="form-control @error('jumlah') is-invalid @enderror"
                            value="{{ old('jumlah') }}" min="1" required>
                        @error('jumlah')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Jenis Retur</label>
                        <input type="text" name="jenis_retur"
                            class="form-control @error('jenis_retur') is-invalid @enderror"
                            value="{{ old('jenis_retur') }}" required>
                        @error('jenis_retur')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Tujuan Retur</label>
                        <input type="text" name="tujuan_retur"
                            class="form-control @error('tujuan_retur') is-invalid @enderror"
                            value="{{ old('tujuan_retur') }}" required>
                        @error('tujuan_retur')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-12 mb-3">
                        <label>Keterangan</label>
                        <textarea name="keterangan" class="form-control @error('keterangan') is-invalid @enderror">{{ old('keterangan') }}</textarea>
                        @error('keterangan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('retur-barang.index') }}" class="btn btn-secondary me-2">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const produk = @json($produk);

        document.getElementById('produkSelect').addEventListener('change', function() {
            const selectedProduk = produk.find(p => p.id_produk == this.value);
            const batchSelect = document.getElementById('batchSelect');

            batchSelect.innerHTML = '<option value="">-- Pilih Batch --</option>';

            if (selectedProduk) {
                selectedProduk.batch.forEach(function(batch) {
                    batchSelect.innerHTML += `
                        <option value="${batch.id_batch}">
                            ${batch.nomor_batch} (Stok: ${batch.stok_batch})
                        </option>
                    `;
                });
            }
        });
    </script>
@endsection
