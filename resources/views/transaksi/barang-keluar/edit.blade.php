@extends('layouts.app')

@section('title', 'Edit Barang Keluar')

@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="fw-semibold mb-0">Edit Barang Keluar</h5>
        </div>

        <div class="card-body">
            @php
                $tujuanList = [
                    'Penjualan' => 'Penjualan',
                    'Reseller' => 'Reseller',
                    'Cabang' => 'Cabang',
                    'Tester' => 'Tester',
                    'Retur' => 'Retur Supplier',
                    'Penyesuaian' => 'Penyesuaian Stok',
                ];
            @endphp

            <form action="{{ route('barang-keluar.update', $barangKeluar->id_keluar) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">

                    {{-- Produk --}}
                    <div class="col-md-6 mb-3">
                        <label>Produk</label>
                        <select id="produkSelect" class="form-control">
                            <option value="">-- Pilih Produk --</option>
                            @foreach ($produk as $p)
                                <option value="{{ $p->id_produk }}"
                                    {{ $barangKeluar->batch->produk->id_produk == $p->id_produk ? 'selected' : '' }}>
                                    {{ $p->nama_produk }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Batch --}}
                    <div class="col-md-6 mb-3">
                        <label>Batch</label>
                        <select name="id_batch" id="batchSelect" class="form-control" required>
                            <option value="">-- Pilih Batch --</option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Tanggal Keluar</label>
                        <input type="date" name="tanggal_keluar" class="form-control"
                            value="{{ $barangKeluar->tanggal_keluar }}" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Jumlah</label>
                        <input type="number" name="jumlah" class="form-control" min="1"
                            value="{{ $barangKeluar->jumlah }}" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Tujuan Barang Keluar</label>
                        <select name="tujuan" class="form-control" required>
                            <option value="">-- Pilih Tujuan Barang Keluar --</option>
                            @foreach ($tujuanList as $value => $label)
                                <option value="{{ $value }}" {{ $barangKeluar->tujuan == $value ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Keterangan</label>
                        <textarea name="keterangan" class="form-control">{{ $barangKeluar->keterangan }}</textarea>
                    </div>

                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('barang-keluar.index') }}" class="btn btn-secondary me-2">
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
        const selectedBatchId = "{{ $barangKeluar->id_batch }}";

        function loadBatch(produkId) {
            const batchSelect = document.getElementById('batchSelect');
            batchSelect.innerHTML = '<option value="">-- Pilih Batch --</option>';

            const selectedProduk = produk.find(p => p.id_produk == produkId);

            if (selectedProduk) {
                selectedProduk.batch.forEach(function(batch) {

                    // Tampilkan juga batch yang sedang dipakai meskipun stoknya 0
                    if (batch.stok_batch > 0 || batch.id_batch == selectedBatchId) {

                        const selected = batch.id_batch == selectedBatchId ? 'selected' : '';

                        batchSelect.innerHTML += `
                            <option value="${batch.id_batch}" ${selected}>
                                ${batch.nomor_batch} (Stok: ${batch.stok_batch})
                            </option>
                        `;
                    }
                });
            }
        }

        document.getElementById('produkSelect').addEventListener('change', function() {
            loadBatch(this.value);
        });

        // Load otomatis saat halaman pertama kali dibuka
        window.onload = function() {
            loadBatch(document.getElementById('produkSelect').value);
        };
    </script>
@endsection
