@extends('layouts.app')

@section('title', 'Edit Batch Produk')

@section('content')
    <div class="card">

        <div class="card-header">
            <h5 class="fw-semibold mb-0">
                Edit Batch - {{ $batch->produk->nama_produk }}
            </h5>
            <small class="text-muted">
                Kode Produk: {{ $batch->produk->kode_produk }}
            </small>
        </div>

        <div class="card-body">

            <form action="{{ route('produk-batch.update', $batch) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">

                    {{-- Nomor Batch --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nomor Batch</label>
                        <input type="text" name="nomor_batch"
                            class="form-control @error('nomor_batch') is-invalid @enderror"
                            value="{{ old('nomor_batch', $batch->nomor_batch) }}">

                        @error('nomor_batch')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Tanggal Expired --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Tanggal Expired</label>
                        <input type="date" name="tanggal_expired"
                            class="form-control @error('tanggal_expired') is-invalid @enderror"
                            value="{{ old('tanggal_expired', $batch->tanggal_expired) }}">

                        @error('tanggal_expired')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Stok Batch --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Jumlah Stok</label>
                        <input type="number" name="stok_batch" min="0"
                            class="form-control @error('stok_batch') is-invalid @enderror"
                            value="{{ old('stok_batch', $batch->stok_batch) }}">

                        @error('stok_batch')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('produk-batch.index', $batch->produk) }}" class="btn btn-secondary btn-sm me-2">
                        Kembali
                    </a>

                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class="ti ti-device-floppy"></i> Update Batch
                    </button>
                </div>

            </form>

        </div>
    </div>
@endsection
