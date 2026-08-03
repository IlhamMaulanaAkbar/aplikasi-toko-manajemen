@extends('layouts.app')

@section('title', 'Edit Supplier')

@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="card-title fw-semibold mb-0">Edit Supplier</h5>
        </div>

        <div class="card-body">
            <form action="{{ route('supplier.update', $supplier) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Kode Supplier</label>
                        <input type="text" name="kode_supplier"
                            class="form-control @error('kode_supplier') is-invalid @enderror"
                            value="{{ old('kode_supplier', $supplier->kode_supplier) }}" required>
                        @error('kode_supplier')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Nama Supplier</label>
                        <input type="text" name="nama_supplier"
                            class="form-control @error('nama_supplier') is-invalid @enderror"
                            value="{{ old('nama_supplier', $supplier->nama_supplier) }}" required>
                        @error('nama_supplier')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">No Telepon</label>
                        <input type="text" name="no_telepon"
                            class="form-control @error('no_telepon') is-invalid @enderror"
                            value="{{ old('no_telepon', $supplier->no_telepon) }}">
                        @error('no_telepon')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Email</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                            value="{{ old('email', $supplier->email) }}">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Kontak Person</label>
                        <input type="text" name="kontak_person"
                            class="form-control @error('kontak_person') is-invalid @enderror"
                            value="{{ old('kontak_person', $supplier->kontak_person) }}">
                        @error('kontak_person')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Keterangan</label>
                        <textarea name="keterangan" rows="3" class="form-control @error('keterangan') is-invalid @enderror">{{ old('keterangan', $supplier->keterangan) }}</textarea>
                        @error('keterangan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 mb-3">
                        <label class="form-label fw-semibold">Alamat</label>
                        <textarea name="alamat" rows="3" class="form-control @error('alamat') is-invalid @enderror">{{ old('alamat', $supplier->alamat) }}</textarea>
                        @error('alamat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('supplier.index') }}" class="btn btn-secondary btn-sm">
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
