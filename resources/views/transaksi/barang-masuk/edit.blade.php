@extends('layouts.app')

@section('title', 'Edit Barang Masuk')

@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="fw-semibold mb-0">Edit Barang Masuk</h5>
        </div>

        <div class="card-body">

            <form action="{{ route('barang-masuk.update', $barangMasuk->id_masuk) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">

                    {{-- PRODUK --}}
                    <div class="col-md-6 mb-3">
                        <label>Produk</label>
                        <select id="produkSelect" class="form-control">
                            <option value="">-- Pilih Produk --</option>
                            @foreach ($produk as $p)
                                <option value="{{ $p->id_produk }}"
                                    {{ $barangMasuk->batch->id_produk == $p->id_produk ? 'selected' : '' }}>
                                    {{ $p->nama_produk }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- BATCH --}}
                    <div class="col-md-6 mb-3">
                        <label>Batch</label>
                        <select name="id_batch" id="batchSelect" class="form-control" required>
                        </select>
                    </div>

                    {{-- TANGGAL --}}
                    <div class="col-md-6 mb-3">
                        <label>Tanggal Masuk</label>
                        <input type="date" name="tanggal_masuk" value="{{ $barangMasuk->tanggal_masuk }}"
                            class="form-control" required>
                    </div>

                    {{-- JUMLAH --}}
                    <div class="col-md-6 mb-3">
                        <label>Jumlah</label>
                        <input type="number" name="jumlah" value="{{ $barangMasuk->jumlah }}" class="form-control"
                            min="1" required>
                    </div>

                    {{-- SUPPLIER --}}
                    <div class="col-md-6 mb-3">
                        <label>Supplier</label>
                        <input type="text" name="supplier" value="{{ $barangMasuk->supplier }}" class="form-control"
                            required>
                    </div>

                    {{-- KETERANGAN --}}
                    <div class="col-md-6 mb-3">
                        <label>Keterangan</label>
                        <textarea name="keterangan" class="form-control">{{ $barangMasuk->keterangan }}</textarea>
                    </div>

                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('barang-masuk.index') }}" class="btn btn-secondary me-2">
                        Kembali
                    </a>
                    <button type="submit" class="btn btn-primary">
                        Update
                    </button>
                </div>

            </form>

        </div>
    </div>

    <script>
        const produk = @json($produk);
        const selectedBatch = {{ $barangMasuk->id_batch }};

        function loadBatch(produkId) {
            const batchSelect = document.getElementById('batchSelect');
            batchSelect.innerHTML = '<option value="">-- Pilih Batch --</option>';

            const selectedProduk = produk.find(p => p.id_produk == produkId);

            if (selectedProduk) {
                selectedProduk.batch.forEach(function(batch) {

                    let selected = batch.id_batch == selectedBatch ? 'selected' : '';

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

        // Load batch saat pertama kali halaman dibuka
        loadBatch(document.getElementById('produkSelect').value);
    </script>
@endsection
