@extends('layouts.app')

@section('title', 'Permintaan Barang')

@section('content')
    <div class="card">

        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="fw-semibold mb-0">Data Permintaan Barang</h5>

            <a href="{{ route('permintaan-barang.create') }}" class="btn btn-primary btn-sm">
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
                            <th class="fs-2 fw-semibold">No</th>
                            <th class="fs-2 fw-semibold">Tanggal</th>
                            <th class="fs-2 fw-semibold">Produk</th>
                            <th class="fs-2 fw-semibold">Jumlah</th>
                            <th class="fs-2 fw-semibold">Status</th>
                            <th class="fs-2 fw-semibold">Keterangan</th>
                            <th class="fs-2 fw-semibold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($permintaanBarang as $i => $item)
                            <tr>
                                <td class="fs-2 fw-medium">{{ $i + 1 }}</td>
                                <td class="fs-2 fw-medium">
                                    {{ \Carbon\Carbon::parse($item->tanggal_permintaan)->format('d M Y') }}
                                </td>
                                <td class="fs-2 fw-medium">
                                    {{ $item->produk->nama_produk }}
                                </td>
                                <td class="fs-2 fw-medium">
                                    {{ $item->jumlah_diminta }}
                                </td>

                                <td>
                                    @if ($item->status == 'Menunggu')
                                        <span class="badge bg-warning text-dark">Menunggu</span>
                                    @elseif($item->status == 'Disetujui')
                                        <span class="badge bg-success">Disetujui</span>
                                    @else
                                        <span class="badge bg-danger">Ditolak</span>
                                    @endif
                                </td>

                                <td class="fs-2 fw-medium">
                                    {{ $item->keterangan }}
                                </td>

                                <td>

                                    {{-- Jika Status Masih Menunggu --}}
                                    @if ($item->status == 'Menunggu')
                                        {{-- Cek Role --}}
                                        @if (auth()->user()->role->nama_role == 'Super Admin' || auth()->user()->role->nama_role == 'Manajer Toko')
                                            {{-- Approve --}}
                                            <form action="{{ route('permintaan-barang.approve', $item) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                <button class="btn btn-success btn-sm"
                                                    onclick="return confirm('Setujui permintaan ini?')">
                                                    <i class="ti ti-check"></i>
                                                </button>
                                            </form>

                                            {{-- Reject --}}
                                            <form action="{{ route('permintaan-barang.reject', $item) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                <button class="btn btn-secondary btn-sm"
                                                    onclick="return confirm('Tolak permintaan ini?')">
                                                    <i class="ti ti-x"></i>
                                                </button>
                                            </form>
                                        @endif

                                        {{-- Edit --}}
                                        <a href="{{ route('permintaan-barang.edit', $item) }}"
                                            class="btn btn-warning btn-sm">
                                            <i class="ti ti-edit"></i>
                                        </a>

                                        {{-- Hapus --}}
                                        <form action="{{ route('permintaan-barang.destroy', $item) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm"
                                                onclick="return confirm('Hapus data ini?')">
                                                <i class="ti ti-trash"></i>
                                            </button>
                                        </form>

                                        {{-- Jika Status Disetujui --}}
                                    @elseif ($item->status == 'Disetujui')
                                        <a href="{{ route('permintaan-barang.pdf', $item) }}" class="btn btn-info btn-sm">
                                            <i class="ti ti-file-text"></i> Lihat Surat
                                        </a>

                                        {{-- Jika Ditolak --}}
                                    @else
                                        <span class="text-muted">Ditolak</span>
                                    @endif

                                </td>


                            </tr>
                        @empty
                            <tr>
                                <td colspan="7">Belum ada data</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection
