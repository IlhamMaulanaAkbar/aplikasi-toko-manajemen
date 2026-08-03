@extends('layouts.app')

@section('title', 'Stok Opname')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="fw-semibold mb-0">Data Stok Opname</h5>
            <a href="{{ route('stok-opname.create') }}" class="btn btn-primary btn-sm">
                <i class="ti ti-plus"></i> Tambah
            </a>
        </div>

        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered text-center align-middle">
                    <thead class="table-light">
                        <tr>
                            <th class="fs-2 fw-semibold mb-0">No</th>
                            <th class="fs-2 fw-semibold mb-0">Tanggal</th>
                            <th class="fs-2 fw-semibold mb-0">Produk</th>
                            <th class="fs-2 fw-semibold mb-0">Batch</th>
                            <th class="fs-2 fw-semibold mb-0">Stok Sistem</th>
                            <th class="fs-2 fw-semibold mb-0">Stok Fisik</th>
                            <th class="fs-2 fw-semibold mb-0">Selisih</th>
                            <th class="fs-2 fw-semibold mb-0">Keterangan</th>
                            <th class="fs-2 fw-semibold mb-0">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($stokOpname as $so)
                            <tr>
                                <td class="fs-2 fw-medium mb-0">{{ $loop->iteration }}</td>
                                <td class="fs-2 fw-medium mb-0">{{ \Carbon\Carbon::parse($so->tanggal_opname)->format('d M Y') }}</td>
                                <td class="fs-2 fw-medium mb-0">{{ $so->batch->produk->nama_produk ?? '-' }}</td>
                                <td class="fs-2 fw-medium mb-0">{{ $so->batch->nomor_batch ?? '-' }}</td>
                                <td class="fs-2 fw-medium mb-0">{{ $so->stok_sistem }}</td>
                                <td class="fs-2 fw-medium mb-0">{{ $so->stok_fisik }}</td>
                                <td class="fs-2 fw-medium mb-0">
                                    <span class="badge {{ $so->selisih < 0 ? 'bg-danger' : 'bg-success' }}">
                                        {{ $so->selisih }}
                                    </span>
                                </td>
                                <td class="fs-2 fw-medium mb-0">{{ $so->keterangan ?? '-' }}</td>
                                <td>
                                    <a href="{{ route('stok-opname.edit', $so) }}" class="btn btn-warning btn-sm">
                                        <i class="ti ti-edit"></i>
                                    </a>
                                    <form action="{{ route('stok-opname.destroy', $so) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm"
                                            onclick="return confirm('Hapus stok opname ini?')">
                                            <i class="ti ti-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center text-muted">Data stok opname belum tersedia</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
