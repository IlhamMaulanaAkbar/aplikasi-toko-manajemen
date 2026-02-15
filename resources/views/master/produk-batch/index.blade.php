@extends('layouts.app')

@section('title', 'Batch Produk')

@section('content')
    <div class="card">

        <div class="card-header d-flex justify-content-between align-items-center">
            <div>
                <h5 class="fw-semibold mb-0">
                    Batch Produk - {{ $produk->nama_produk }}
                </h5>
                <small class="text-muted">
                    Total Stok: {{ $produk->total_stok }}
                </small>
            </div>

            <a href="{{ route('produk-batch.create', $produk) }}" class="btn btn-primary btn-sm">
                <i class="ti ti-plus"></i> Tambah Batch
            </a>
        </div>

        <div class="card-body">

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="table-light text-center">
                        <tr>
                            <th class="fs-2 fw-semibold mb-0">No</th>
                            <th class="fs-2 fw-semibold mb-0">Nomor Batch</th>
                            <th class="fs-2 fw-semibold mb-0">Tanggal Expired</th>
                            <th class="fs-2 fw-semibold mb-0">Stok</th>
                            <th class="fs-2 fw-semibold mb-0">Status</th>
                            <th class="fs-2 fw-semibold mb-0">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-center"> 
                        @forelse($batch as $i => $b)
                            @php
                                $hari = \Carbon\Carbon::now()->diffInDays($b->tanggal_expired, false);
                            @endphp

                            <tr>
                                <td class="fs-2 fw-medium mb-0">{{ $i + 1 }}</td>
                                <td class="fs-2 fw-medium mb-0">{{ $b->nomor_batch }}</td>
                                <td class="fs-2 fw-medium mb-0">
                                    {{ \Carbon\Carbon::parse($b->tanggal_expired)->format('d M Y') }}
                                </td>
                                <td class="fs-2 fw-medium mb-0">{{ $b->stok_batch }}</td>

                                <td class="fs-2 fw-medium mb-0">
                                    @if ($hari < 0)
                                        <span class="badge bg-danger">
                                            Expired
                                        </span>
                                    @elseif($hari <= 30)
                                        <span class="badge bg-warning">
                                            Hampir Expired
                                        </span>
                                    @else
                                        <span class="badge bg-success">
                                            Aman
                                        </span>
                                    @endif
                                </td>

                                <td>
                                    {{-- Edit --}}
                                    <a href="{{ route('produk-batch.edit', $b) }}" class="btn btn-warning btn-sm">
                                        <i class="ti ti-edit"></i>
                                    </a>

                                    {{-- Delete --}}
                                    <form action="{{ route('produk-batch.destroy', $b) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus batch ini?')">
                                            <i class="ti ti-trash"></i>
                                        </button>
                                    </form>
                                </td>



                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center fs-2 fw-medium mb-0">
                                    Belum ada batch
                                </td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
                <div class="d-flex justify-content-end">
                    <a href="{{ route('produk.index') }}" class="btn btn-secondary btn-sm me-2">
                        Kembali
                    </a>
                </div>
            </div>

        </div>
    </div>
@endsection
