@extends('layouts.app')

@section('title', 'Edit Jenis Barang')

@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="card-title fw-semibold">Edit Jenis Barang</h5>
        </div>

        <div class="card-body">
            <form action="{{ route('jenis-barang.update', $jenisBarang) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama Jenis Barang</label>
                    <input type="text" name="nama_jenis" class="form-control @error('nama_jenis') is-invalid @enderror"
                        value="{{ old('nama_jenis', $jenisBarang->nama_jenis) }}" required>

                    @error('nama_jenis')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Keterangan</label>
                    <textarea name="keterangan" rows="3" class="form-control @error('keterangan') is-invalid @enderror">{{ old('keterangan', $jenisBarang->keterangan) }}</textarea>

                    @error('keterangan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('jenis-barang.index') }}" class="btn btn-secondary btn-sm">
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
