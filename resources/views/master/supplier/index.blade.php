@extends('layouts.app')

@section('title', 'Supplier')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title fw-semibold mb-0">Data Supplier</h5>
            <a href="{{ route('supplier.create') }}" class="btn btn-primary btn-sm">
                <i class="ti ti-plus"></i> Tambah
            </a>
        </div>

        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered align-middle text-center">
                    <thead class="table-light">
                        <tr>
                            <th class="fs-2 fw-semibold mb-0">No</th>
                            <th class="fs-2 fw-semibold mb-0">Kode</th>
                            <th class="fs-2 fw-semibold mb-0">Nama Supplier</th>
                            <th class="fs-2 fw-semibold mb-0">Telepon</th>
                            <th class="fs-2 fw-semibold mb-0">Email</th>
                            <th class="fs-2 fw-semibold mb-0">Kontak Person</th>
                            <th class="fs-2 fw-semibold mb-0">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($supplier as $s)
                            <tr>
                                <td class="fs-2 fw-medium mb-0">{{ $loop->iteration }}</td>
                                <td class="fs-2 fw-medium mb-0">{{ $s->kode_supplier }}</td>
                                <td class="fs-2 fw-medium mb-0">{{ $s->nama_supplier }}</td>
                                <td class="fs-2 fw-medium mb-0">{{ $s->no_telepon ?? '-' }}</td>
                                <td class="fs-2 fw-medium mb-0">{{ $s->email ?? '-' }}</td>
                                <td class="fs-2 fw-medium mb-0">{{ $s->kontak_person ?? '-' }}</td>
                                <td>
                                    <a href="{{ route('supplier.edit', $s) }}" class="btn btn-warning btn-sm">
                                        <i class="ti ti-edit"></i>
                                    </a>
                                    <form action="{{ route('supplier.destroy', $s) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm"
                                            onclick="return confirm('Hapus supplier ini?')">
                                            <i class="ti ti-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted">Data supplier belum tersedia</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
