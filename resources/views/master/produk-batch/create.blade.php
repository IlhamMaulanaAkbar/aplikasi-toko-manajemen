@extends('layouts.app')

@section('title', 'Tambah Batch Produk')

@section('content')
    <div class="card">

        <div class="card-header">
            <h5 class="fw-semibold mb-0">
                Tambah Batch - {{ $produk->nama_produk }}
            </h5>
            <small class="text-muted">
                Kode Produk: {{ $produk->kode_produk }}
            </small>
        </div>

        <div class="card-body">

            <form action="{{ route('produk-batch.store', $produk) }}" method="POST">
                @csrf

                <div class="row">
                    <input type="hidden" name="id_produk" value="{{ $produk->id_produk }}">

                    {{-- Nomor Batch --}}
                    <div class="mb-3">
                        <label class="form-label">Nomor Batch</label>
                        <input type="text" name="nomor_batch"
                            class="form-control @error('nomor_batch') is-invalid @enderror" value="{{ old('nomor_batch') }}"
                            placeholder="Contoh: BATCH-001">

                        @error('nomor_batch')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Tanggal Expired --}}
                    <div class="mb-3">
                        <label class="form-label">Tanggal Expired</label>
                        <input type="date" name="tanggal_expired"
                            class="form-control @error('tanggal_expired') is-invalid @enderror"
                            value="{{ old('tanggal_expired') }}">

                        @error('tanggal_expired')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Stok Batch --}}
                    <div class="mb-3">
                        <label class="form-label">Jumlah Stok</label>
                        <input type="number" name="stok_batch"
                            class="form-control @error('stok_batch') is-invalid @enderror" value="{{ old('stok_batch') }}"
                            min="1" placeholder="Masukkan jumlah stok">

                        @error('stok_batch')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('produk-batch.index', $produk) }}" class="btn btn-secondary me-2">
                        Kembali
                    </a>

                    <button type="submit" class="btn btn-primary">
                        <i class="ti ti-device-floppy"></i> Simpan Batch
                    </button>
                </div>

            </form>

        </div>
    </div>
@endsection
