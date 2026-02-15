@extends('layouts.app')

@section('title', 'Manajemen Produk')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h5 class="card-title fw-semibold">Manajemen Produk</h5>
            <a href="{{ route('produk.create') }}" class="btn btn-primary btn-sm">
                <i class="ti ti-plus"></i> Tambah
            </a>
        </div>

        <div class="card-body table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-light text-center">
                    <tr>
                        <th class="fs-2 fw-semibold mb-0">No</th>
                        <th class="fs-2 fw-semibold mb-0">Kode Produk</th>
                        <th class="fs-2 fw-semibold mb-0">Nama Produk</th>
                        <th class="fs-2 fw-semibold mb-0">Brand</th>
                        <th class="fs-2 fw-semibold mb-0">Jenis</th>
                        <th class="fs-2 fw-semibold mb-0">Satuan</th>
                        <th class="fs-2 fw-semibold mb-0">Stok</th>
                        <th class="fs-2 fw-semibold mb-0">Stok Minimum</th>
                        <th class="fs-2 fw-semibold mb-0">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($produk as $p)
                        <tr class="text-center">
                            <td class="fs-2 fw-medium mb-0">{{ $loop->iteration }}</td>
                            <td class="fs-2 fw-medium mb-0">{{ $p->kode_produk }}</td>
                            <td class="fs-2 fw-medium mb-0">{{ $p->nama_produk }}</td>
                            <td class="fs-2 fw-medium mb-0">{{ $p->brand }}</td>
                            <td class="fs-2 fw-medium mb-0">{{ $p->jenis->nama_jenis ?? '-' }}</td>
                            <td class="fs-2 fw-medium mb-0">{{ $p->satuan->nama_satuan ?? '-' }}</td>
                            <td class="fs-2 fw-medium mb-0">
                                <span class="badge bg-{{ $p->total_stok <= $p->stok_minimum ? 'danger' : 'success' }}">
                                    {{ $p->total_stok }}
                                </span>
                            </td>
                            <td class="fs-2 fw-medium mb-0">{{ $p->stok_minimum }}</td>
                            <td>
                                <a href="{{ route('produk-batch.index', $p) }}" class="btn btn-info btn-sm">
                                    <i class="ti ti-package"></i>
                                </a>

                                <a href="{{ route('produk.edit', $p) }}" class="btn btn-warning btn-sm">
                                    <i class="ti ti-edit"></i>
                                </a>

                                <form action="{{ route('produk.destroy', $p) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus produk ini?')">
                                        <i class="ti ti-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                    @if ($produk->count() == 0)
                        <tr>
                            <td colspan="9" class="text-center text-muted">
                                Data produk belum tersedia
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
