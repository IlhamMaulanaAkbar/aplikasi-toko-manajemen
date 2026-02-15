@extends('layouts.app')

@section('title', 'Tambah Satuan Barang')

@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="card-title fw-semibold">Tambah Satuan Barang</h5>
        </div>

        <div class="card-body">
            <form action="{{ route('satuan-barang.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama satuan Barang</label>
                    <input type="text" name="nama_satuan" class="form-control @error('nama_satuan') is-invalid @enderror"
                        value="{{ old('nama_satuan') }}" placeholder="Contoh: Pcs, Box, Pack, dll" required>

                    @error('nama_satuan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Keterangan</label>
                    <textarea name="keterangan" rows="3" class="form-control @error('keterangan') is-invalid @enderror"
                        placeholder="Opsional">{{ old('keterangan') }}</textarea>

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
                        <i class="ti ti-device-floppy"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
