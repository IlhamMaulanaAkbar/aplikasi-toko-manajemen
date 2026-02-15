@extends('layouts.app')

@section('title', 'Satuan Barang')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h5 class="card-title fw-semibold">Satuan Barang</h5>
            <a href="{{ route('satuan-barang.create') }}" class="btn btn-primary btn-sm">
                <i class="ti ti-plus"></i> Tambah
            </a>
        </div>

        <div class="card-body table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-light text-center">
                    <tr>
                        <th class="fs-2 fw-semibold mb-0">No</th>
                        <th class="fs-2 fw-semibold mb-0">Nama Satuan</th>
                        <th class="fs-2 fw-semibold mb-0">Keterangan</th>
                        <th class="fs-2 fw-semibold mb-0">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($satuanBarang as $sb)
                        <tr class="text-center">
                            <td class="fs-2 fw-medium mb-0">{{ $loop->iteration }}</td>
                            <td class="fs-2 fw-medium mb-0">{{ $sb->nama_satuan }}</td>
                            <td class="fs-2 fw-medium mb-0">{{ $sb->keterangan ?? '-' }}</td>
                            <td>
                                <a href="{{ route('satuan-barang.edit', $sb) }}" class="btn btn-warning btn-sm">
                                    <i class="ti ti-edit"></i>
                                </a>

                                <form action="{{ route('satuan-barang.destroy', $sb) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm"
                                        onclick="return confirm('Hapus jenis barang ini?')">
                                        <i class="ti ti-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach


                    @if ($satuanBarang->count() == 0)
                        <tr>
                            <td colspan="6" class="text-center text-muted">
                                Data satuan barang belum tersedia
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
