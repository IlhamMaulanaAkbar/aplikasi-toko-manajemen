@extends('layouts.app')

@section('title', 'Jenis Barang')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h5 class="card-title fw-semibold">Jenis Barang</h5>
            <a href="{{ route('jenis-barang.create') }}" class="btn btn-primary btn-sm">
                <i class="ti ti-plus"></i> Tambah
            </a>
        </div>

        <div class="card-body table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-light text-center">
                    <tr>
                        <th class="fs-2 fw-semibold mb-0">No</th>
                        <th class="fs-2 fw-semibold mb-0">Nama Jenis</th>
                        <th class="fs-2 fw-semibold mb-0">Keterangan</th>
                        <th class="fs-2 fw-semibold mb-0">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($jenisBarang as $jb)
                        <tr class="text-center">
                            <td class="fs-2 fw-medium mb-0">{{ $loop->iteration }}</td>
                            <td class="fs-2 fw-medium mb-0">{{ $jb->nama_jenis }}</td>
                            <td class="fs-2 fw-medium mb-0">{{ $jb->keterangan ?? '-' }}</td>
                            <td>
                                <a href="{{ route('jenis-barang.edit', $jb) }}" class="btn btn-warning btn-sm">
                                    <i class="ti ti-edit"></i>
                                </a>

                                <form action="{{ route('jenis-barang.destroy', $jb) }}" method="POST" class="d-inline">
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


                    @if ($jenisBarang->count() == 0)
                        <tr>
                            <td colspan="6" class="text-center text-muted">
                                Data jenis barang belum tersedia
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
