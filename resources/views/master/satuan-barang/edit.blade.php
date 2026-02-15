@extends('layouts.app')

@section('title', 'Edit Satuan Barang')

@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="card-title fw-semibold">Edit Satuan Barang</h5>
        </div>

        <div class="card-body">
            <form action="{{ route('satuan-barang.update', $satuanBarang) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama satuan Barang</label>
                    <input type="text" name="nama_satuan" class="form-control @error('nama_satuan') is-invalid @enderror"
                        value="{{ old('nama_satuan', $satuanBarang->nama_satuan) }}" required>

                    @error('nama_satuan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Keterangan</label>
                    <textarea name="keterangan" rows="3" class="form-control @error('keterangan') is-invalid @enderror">{{ old('keterangan', $satuanBarang->keterangan) }}</textarea>

                    @error('keterangan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('satuan-barang.index') }}" class="btn btn-secondary btn-sm">
                        <i class="ti ti-arrow-left"></i> Kembali
                    </a>

                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class="ti ti-device-floppy"></i> Update
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
