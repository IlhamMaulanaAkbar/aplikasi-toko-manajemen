@extends('layouts.app')

@section('title', 'Retur Barang')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="fw-semibold mb-0">Data Retur Barang</h5>
            <a href="{{ route('retur-barang.create') }}" class="btn btn-primary btn-sm">
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
                            <th class="fs-2 fw-semibold mb-0">Jumlah</th>
                            <th class="fs-2 fw-semibold mb-0">Jenis Retur</th>
                            <th class="fs-2 fw-semibold mb-0">Tujuan Retur</th>
                            <th class="fs-2 fw-semibold mb-0">Keterangan</th>
                            <th class="fs-2 fw-semibold mb-0">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($returBarang as $rb)
                            <tr>
                                <td class="fs-2 fw-medium mb-0">{{ $loop->iteration }}</td>
                                <td class="fs-2 fw-medium mb-0">{{ \Carbon\Carbon::parse($rb->tanggal_retur)->format('d M Y') }}</td>
                                <td class="fs-2 fw-medium mb-0">{{ $rb->batch->produk->nama_produk ?? '-' }}</td>
                                <td class="fs-2 fw-medium mb-0">{{ $rb->batch->nomor_batch ?? '-' }}</td>
                                <td class="fs-2 fw-medium mb-0">{{ $rb->jumlah }}</td>
                                <td class="fs-2 fw-medium mb-0">{{ $rb->jenis_retur }}</td>
                                <td class="fs-2 fw-medium mb-0">{{ $rb->tujuan_retur }}</td>
                                <td class="fs-2 fw-medium mb-0">{{ $rb->keterangan ?? '-' }}</td>
                                <td>
                                    <a href="{{ route('retur-barang.edit', $rb) }}" class="btn btn-warning btn-sm">
                                        <i class="ti ti-edit"></i>
                                    </a>
                                    <form action="{{ route('retur-barang.destroy', $rb) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm"
                                            onclick="return confirm('Hapus retur barang ini?')">
                                            <i class="ti ti-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center text-muted">Data retur barang belum tersedia</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
