@extends('layouts.app')

@section('title', 'Barang Masuk')

@section('content')
    <div class="card">

        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="fw-semibold mb-0">Data Barang Masuk</h5>

            <a href="{{ route('barang-masuk.create') }}" class="btn btn-primary btn-sm">
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
                            <th class="fs-2 fw-semibold mb-0">Tanggal</th>
                            <th class="fs-2 fw-semibold mb-0">Produk</th>
                            <th class="fs-2 fw-semibold mb-0">Batch</th>
                            <th class="fs-2 fw-semibold mb-0">Jumlah</th>
                            <th class="fs-2 fw-semibold mb-0">Supplier</th>
                            <th class="fs-2 fw-semibold mb-0">Keterangan</th>
                            <th class="fs-2 fw-semibold mb-0">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($barangMasuk as $i => $bm)
                            <tr>
                                <td class="fs-2 fw-medium mb-0">{{ $i + 1 }}</td>
                                <td class="fs-2 fw-medium mb-0">{{ \Carbon\Carbon::parse($bm->tanggal_masuk)->format('d M Y') }}</td>
                                <td class="fs-2 fw-medium mb-0">{{ $bm->batch->produk->nama_produk }}</td>
                                <td class="fs-2 fw-medium mb-0">{{ $bm->batch->nomor_batch }}</td>
                                <td class="fs-2 fw-medium mb-0">{{ $bm->jumlah }}</td>
                                <td class="fs-2 fw-medium mb-0">{{ $bm->supplier }}</td>
                                <td class="fs-2 fw-medium mb-0">{{ $bm->keterangan }}</td>
                                <td class="fs-2 fw-medium mb-0">
                                    <a href="{{ route('barang-masuk.edit', $bm) }}" class="btn btn-warning btn-sm">
                                        <i class="ti ti-edit"></i>
                                    </a>
                                    <form action="{{ route('barang-masuk.destroy', $bm) }}" method="POST"
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
                                <td colspan="8 fs-2 fw-medium mb-0">Belum ada data</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection
