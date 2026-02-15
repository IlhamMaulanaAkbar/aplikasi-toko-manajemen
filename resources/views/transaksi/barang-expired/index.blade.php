@extends('layouts.app')

@section('title', 'Barang Expired')

@section('content')
    <div class="card">

        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="fw-semibold mb-0">Data Barang Expired</h5>

            <a href="{{ route('barang-expired.create') }}" class="btn btn-primary btn-sm">
                <i class="ti ti-plus"></i> Tambah
            </a>
        </div>

        <div class="card-body">

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered text-center">
                    <thead class="table-light">
                        <tr>
                            <th class="fs-2 fw-semibold mb-0">No</th>
                            <th class="fs-2 fw-semibold mb-0">Tanggal Dicatat</th>
                            <th class="fs-2 fw-semibold mb-0">Produk</th>
                            <th class="fs-2 fw-semibold mb-0">Batch</th>
                            <th class="fs-2 fw-semibold mb-0">Jumlah</th>
                            <th class="fs-2 fw-semibold mb-0">Status</th>
                            <th class="fs-2 fw-semibold mb-0">Keterangan</th>
                            <th class="fs-2 fw-semibold mb-0">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($barangExpired as $i => $be)
                            <tr>
                                <td class="fs-2 fw-medium mb-0">{{ $i + 1 }}</td>
                                <td class="fs-2 fw-medium mb-0">{{ \Carbon\Carbon::parse($be->tanggal_dicatat)->format('d M Y') }}</td>
                                <td class="fs-2 fw-medium mb-0">{{ $be->batch->produk->nama_produk ?? '-' }}</td>
                                <td class="fs-2 fw-medium mb-0">{{ $be->batch->nomor_batch ?? '-' }}</td>
                                <td class="fs-2 fw-medium mb-0">{{ $be->jumlah }}</td>
                                <td class="fs-2 fw-medium mb-0">
                                    <span class="badge bg-danger">
                                        {{ $be->status }}
                                    </span>
                                </td>
                                <td class="fs-2 fw-medium mb-0">{{ $be->keterangan }}</td>
                                <td>
                                    <a href="{{ route('barang-expired.edit', $be) }}" class="btn btn-warning btn-sm">
                                        <i class="ti ti-edit"></i>
                                    </a>

                                    <form action="{{ route('barang-expired.destroy', $be) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus data ini?')">
                                            <i class="ti ti-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8">Belum ada data</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection
