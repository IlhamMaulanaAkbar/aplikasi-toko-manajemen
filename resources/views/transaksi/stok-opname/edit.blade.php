@extends('layouts.app')

@section('title', 'Edit Stok Opname')

@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="fw-semibold mb-0">Edit Stok Opname</h5>
        </div>

        <div class="card-body">
            <form action="{{ route('stok-opname.update', $stokOpname) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Produk</label>
                        <select id="produkSelect" class="form-control">
                            <option value="">-- Pilih Produk --</option>
                            @foreach ($produk as $p)
                                <option value="{{ $p->id_produk }}"
                                    {{ $stokOpname->batch->id_produk == $p->id_produk ? 'selected' : '' }}>
                                    {{ $p->nama_produk }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Batch</label>
                        <select name="id_batch" id="batchSelect"
                            class="form-control @error('id_batch') is-invalid @enderror" required></select>
                        @error('id_batch')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Tanggal Opname</label>
                        <input type="date" name="tanggal_opname"
                            class="form-control @error('tanggal_opname') is-invalid @enderror"
                            value="{{ old('tanggal_opname', $stokOpname->tanggal_opname) }}" required>
                        @error('tanggal_opname')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Stok Fisik</label>
                        <input type="number" name="stok_fisik"
                            class="form-control @error('stok_fisik') is-invalid @enderror"
                            value="{{ old('stok_fisik', $stokOpname->stok_fisik) }}" min="0" required>
                        @error('stok_fisik')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-12 mb-3">
                        <label>Keterangan</label>
                        <textarea name="keterangan" class="form-control @error('keterangan') is-invalid @enderror">{{ old('keterangan', $stokOpname->keterangan) }}</textarea>
                        @error('keterangan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('stok-opname.index') }}" class="btn btn-secondary me-2">Kembali</a>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const produk = @json($produk);
        const selectedBatch = @json(old('id_batch', $stokOpname->id_batch));

        function loadBatch(produkId) {
            const selectedProduk = produk.find(p => p.id_produk == produkId);
            const batchSelect = document.getElementById('batchSelect');

            batchSelect.innerHTML = '<option value="">-- Pilih Batch --</option>';

            if (selectedProduk) {
                selectedProduk.batch.forEach(function(batch) {
                    const selected = batch.id_batch == selectedBatch ? 'selected' : '';
                    batchSelect.innerHTML += `
                        <option value="${batch.id_batch}" ${selected}>
                            ${batch.nomor_batch} (Stok: ${batch.stok_batch})
                        </option>
                    `;
                });
            }
        }

        document.getElementById('produkSelect').addEventListener('change', function() {
            loadBatch(this.value);
        });

        loadBatch(document.getElementById('produkSelect').value);
    </script>
@endsection
