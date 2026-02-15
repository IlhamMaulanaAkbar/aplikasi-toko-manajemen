@extends('layouts.app')

@section('title', 'Permintaan Barang')

@section('content')
    <div>
        <div class="d-flex justify-content-end">
            <a href="{{ route('laporan.produk.print', request()->query()) }}" target="_blank"
                class="btn btn-danger btn-sm mb-3 me-2">
                <i class="ti ti-printer fs-2"></i>
                Cetak PDF
            </a>
        </div>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">
                    Laporan Stok Produk
                </h5>

                {{-- FILTER --}}
                <form method="GET" class="row mb-4 g-2 d-flex justify-content-center">

                    <div class="col-md-3">
                        <select name="jenis" class="form-select form-select-sm border-primary"
                            onchange="this.form.submit()">
                            <option value="">-- Semua Jenis --</option>
                            @foreach ($jenisBarang as $jenis)
                                <option value="{{ $jenis->id_jenis }}"
                                    {{ request('jenis') == $jenis->id_jenis ? 'selected' : '' }}>
                                    {{ $jenis->nama_jenis }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3">
                        <select name="stok" class="form-select form-select-sm border-primary"
                            onchange="this.form.submit()">
                            <option value="">-- Semua Stok --</option>
                            <option value="aman" {{ request('stok') == 'aman' ? 'selected' : '' }}>
                                Stok Aman
                            </option>
                            <option value="minimum" {{ request('stok') == 'minimum' ? 'selected' : '' }}>
                                Dibawah Minimum
                            </option>
                        </select>
                    </div>

                    <div class="col-md-2">
                        <a href="{{ route('laporan.produk.index') }}" class="btn btn-sm btn-primary w-100">
                            Reset
                        </a>
                    </div>

                </form>

                {{-- TABLE --}}
                @if ($produk->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-striped nowrap">
                            <thead>
                                <tr class="text-center">
                                    <th class="fs-2 fw-semibold">No</th>
                                    <th class="fs-2 fw-semibold">Kode Produk</th>
                                    <th class="fs-2 fw-semibold">Nama Produk</th>
                                    <th class="fs-2 fw-semibold">Brand</th>
                                    <th class="fs-2 fw-semibold">Jenis</th>
                                    <th class="fs-2 fw-semibold">Satuan</th>
                                    <th class="fs-2 fw-semibold">Total Stok</th>
                                    <th class="fs-2 fw-semibold">Stok Minimum</th>
                                    <th class="fs-2 fw-semibold">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($produk as $item)
                                    @php
                                        $isMinimum = $item['stok_total'] <= $item['stok_minimum'];
                                    @endphp


                                    <tr class="text-center">
                                        <td class="fs-2 fw-semibold">{{ $loop->iteration }}</td>
                                        <td class="fs-2 fw-semibold">{{ $item->kode_produk }}</td>
                                        <td class="fs-2 fw-semibold">{{ $item->nama_produk }}</td>
                                        <td class="fs-2 fw-semibold">{{ $item->brand}}</td>
                                        <td class="fs-2 fw-semibold">{{ $item->jenis->nama_jenis }}</td>
                                        <td class="fs-2 fw-semibold">{{ $item->satuan->nama_satuan }}</td>
                                        <td class="fs-2 fw-semibold">{{ $item->stok_total }}</td>
                                        <td class="fs-2 fw-semibold">{{ $item->stok_minimum }}</td>
                                        <td class="fs-2 fw-semibold">
                                            @if ($item->status_stok == 'Habis')
                                                <span class="badge bg-danger">Habis</span>
                                            @elseif($item->status_stok == 'Minimum')
                                                <span class="badge bg-warning">Minimum</span>
                                            @else
                                                <span class="badge bg-success">Aman</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="alert alert-info mb-0">
                        Tidak ada data produk.
                    </div>
                @endif

            </div>
        </div>
    </div>
@endsection
