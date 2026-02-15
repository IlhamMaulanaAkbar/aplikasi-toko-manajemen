@extends('layouts.app')

@section('title', 'Laporan Barang Expired')

@section('content')
    <div>

        {{-- BUTTON PRINT --}}
        <div class="d-flex justify-content-end">
            <a href="{{ route('laporan.barang-expired.print', request()->query()) }}" target="_blank"
                class="btn btn-danger btn-sm mb-3 me-2">
                <i class="ti ti-printer fs-2"></i>
                Cetak PDF
            </a>
        </div>

        <div class="card">
            <div class="card-body">

                <h5 class="card-title fw-semibold mb-4">
                    Laporan Barang Expired
                </h5>

                {{-- FILTER --}}
                <form method="GET" class="row mb-4 g-2 d-flex justify-content-center">

                    <div class="col-md-3">
                        <select name="year" class="form-select form-select-sm border-primary"
                            onchange="this.form.submit()">
                            <option value="">-- Semua Tahun --</option>
                            @foreach ($years as $year)
                                <option value="{{ $year }}" @selected(request('year') == $year)>
                                    {{ $year }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3">
                        <select name="month" class="form-select form-select-sm border-primary"
                            onchange="this.form.submit()">
                            <option value="">-- Semua Bulan --</option>
                            @foreach ($months as $num => $bulan)
                                <option value="{{ $num }}" @selected(request('month') == $num)>
                                    {{ $bulan }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-2">
                        <a href="{{ route('laporan.barang-expired.index') }}" class="btn btn-sm btn-primary w-100">
                            Reset
                        </a>
                    </div>

                </form>

                {{-- TABLE --}}
                @if ($barangExpired->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-striped nowrap">
                            <thead>
                                <tr class="text-center">
                                    <th class="fs-2 fw-semibold">No</th>
                                    <th class="fs-2 fw-semibold">Tanggal</th>
                                    <th class="fs-2 fw-semibold">Nama Produk</th>
                                    <th class="fs-2 fw-semibold">Batch</th>
                                    <th class="fs-2 fw-semibold">Jumlah</th>
                                    <th class="fs-2 fw-semibold">Tujuan</th>
                                    <th class="fs-2 fw-semibold">Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($barangExpired as $be)
                                    <tr class="text-center">
                                        <td class="fs-2 fw-medium mb-0">
                                            {{ $loop->iteration }}
                                        </td>

                                        <td class="fs-2 fw-medium mb-0">
                                            {{ \Carbon\Carbon::parse($be->tanggal_dicatat)->format('d M Y') }}
                                        </td>

                                        <td class="fs-2 fw-medium mb-0">
                                            {{ $be->batch->produk->nama_produk }}
                                        </td>

                                        <td class="fs-2 fw-medium mb-0">
                                            {{ $be->batch->nomor_batch }}
                                        </td>

                                        <td class="fs-2 fw-medium mb-0">
                                            <span class="badge bg-danger">
                                                -{{ $be->jumlah }}
                                            </span>
                                        </td>

                                        <td class="fs-2 fw-medium mb-0">
                                            <span class="badge bg-danger">
                                                {{ $be->status }}
                                            </span>
                                        </td>

                                        <td class="fs-2 fw-medium mb-0">
                                            {{ $be->keterangan ?? '-' }}
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="alert alert-info mb-0">
                        Tidak ada data barang expired.
                    </div>
                @endif

            </div>
        </div>
    </div>
@endsection
