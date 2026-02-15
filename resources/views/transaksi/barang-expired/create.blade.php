@extends('layouts.app')

@section('title', 'Tambah Barang Expired')

@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="fw-semibold mb-0">Tambah Barang Expired</h5>
        </div>

        <div class="card-body">
            <form action="{{ route('barang-expired.store') }}" method="POST">
                @csrf

                <div class="row">


                    <div class="col-md-6 mb-3">
                        <label>Produk</label>
                        <select id="produkSelect" class="form-control">
                            <option value="">-- Pilih Produk --</option>
                            @foreach ($produk as $p)
                                <option value="{{ $p->id_produk }}">
                                    {{ $p->nama_produk }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Batch</label>
                        <select name="id_batch" id="batchSelect" class="form-control" required>
                            <option value="">-- Pilih Batch --</option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Tanggal Dicatat</label>
                        <input type="date" name="tanggal_dicatat" class="form-control" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Jumlah</label>
                        <input type="number" name="jumlah" class="form-control" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select">
                            <option value="Dimusnahkan">Dimusnahkan</option>
                            <option value="Dikembalikan">Dikembalikan</option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Keterangan</label>
                        <textarea name="keterangan" class="form-control"></textarea>
                    </div>

                </div>
                <div class="d-flex justify-content-end">
                    <a href="{{ route('barang-expired.index') }}" class="btn btn-secondary me-2">
                        Kembali
                    </a>
                    <button type="submit" class="btn btn-primary">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
    <script>
        const produk = @json($produk);

        document.getElementById('produkSelect').addEventListener('change', function() {

            const produkId = this.value;
            const batchSelect = document.getElementById('batchSelect');

            batchSelect.innerHTML = '<option value="">-- Pilih Batch --</option>';

            const selectedProduk = produk.find(p => p.id_produk == produkId);

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
