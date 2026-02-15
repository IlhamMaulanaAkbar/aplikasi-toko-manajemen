@extends('layouts.app')

@section('title', 'Livi - Beauty House')
@section('content')
    <div>
        <div class="row">

            {{-- TOTAL PRODUK --}}
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-0 shadow-sm rounded-1 overflow-hidden">
                    <div class="d-flex align-items-center p-3 border-start border-4 border-primary">
                        <div class="grow">
                            <p class="fs-1 text-primary text-uppercase fw-semibold mb-1 small">
                                Total Produk
                            </p>
                            <h4 class="fw-bold mb-0">
                                {{ $totalProduk }}
                            </h4>
                        </div>
                    </div>
                </div>
            </div>

            {{-- TOTAL BARANG MASUK --}}
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-0 shadow-sm rounded-1 overflow-hidden">
                    <div class="d-flex align-items-center p-3 border-start border-4 border-success">
                        <div class="grow">
                            <p class="fs-1 text-success text-uppercase fw-semibold mb-1 small">
                                Barang Masuk
                            </p>
                            <h4 class="fw-bold mb-0">
                                {{ $totalMasuk }}
                            </h4>
                        </div>
                    </div>
                </div>
            </div>

            {{-- TOTAL BARANG KELUAR --}}
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-0 shadow-sm rounded-1 overflow-hidden">
                    <div class="d-flex align-items-center p-3 border-start border-4 border-danger">
                        <div class="grow">
                            <p class="fs-1 text-danger text-uppercase fw-semibold mb-1 small">
                                Barang Keluar
                            </p>
                            <h4 class="fw-bold mb-0">
                                {{ $totalKeluar }}
                            </h4>
                        </div>
                    </div>
                </div>
            </div>

            {{-- TOTAL PERMINTAAN --}}
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-0 shadow-sm rounded-1 overflow-hidden">
                    <div class="d-flex align-items-center p-3 border-start border-4 border-warning">
                        <div class="grow">
                            <p class="fs-1 text-warning text-uppercase fw-semibold mb-1 small">
                                Permintaan Barang
                            </p>
                            <h4 class="fw-bold mb-0">
                                {{ $totalPermintaan }}
                            </h4>
                        </div>
                    </div>
                </div>
            </div>


            {{-- CHART --}}
            <div class="col-lg-8">
                <div class="card w-100">
                    <div class="card-body">
                        <div class="d-md-flex align-items-center">
                            <div>
                                <h4 class="card-title">Monitoring Barang</h4>
                                <p class="card-subtitle">
                                    Grafik Barang Masuk & Barang Keluar (7 Hari Terakhir)
                                </p>
                            </div>
                        </div>

                        <div id="sales-overview" class="mt-4 mx-n6"></div>
                    </div>
                </div>
            </div>

            {{-- PERMINTAAN --}}
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-0">Perkembangan Permintaan</h4>
                    </div>

                    <div class="comment-widgets scrollable mb-2 common-widget" style="height: 420px" data-simplebar="">

                        @forelse($permintaanTerbaru as $permintaan)
                            <div class="d-flex flex-row comment-row border-bottom p-3 gap-3">

                                <div>
                                    <span class="btn btn-primary rounded-circle round-48 hstack justify-content-center">
                                        <i class="ti ti-package fs-6 text-white"></i>
                                    </span>
                                </div>

                                <div class="comment-text w-100">
                                    <h6 class="mb-1 fs-2 fw-medium">
                                        {{ $permintaan->produk->nama_produk ?? '-' }}
                                        ({{ $permintaan->jumlah_diminta }} pcs)
                                    </h6>

                                    <p class="mb-1 fs-2 text-muted">
                                        Stok Saat Ini :
                                        {{ $permintaan->produk->total_stok ?? 0 }}
                                    </p>

                                    @php
                                        $badgeClass = match ($permintaan->status) {
                                            'Menunggu' => 'bg-warning',
                                            'Disetujui' => 'bg-success',
                                            'Ditolak' => 'bg-danger',
                                            default => 'bg-warning',
                                        };
                                    @endphp

                                    <span class="badge {{ $badgeClass }}">
                                        {{ ucfirst($permintaan->status) }}
                                    </span>

                                    <span class="text-muted fw-normal fs-2 d-block mt-2 text-end">
                                        {{ $permintaan->created_at->format('d M Y H:i') }}
                                    </span>
                                </div>
                            </div>

                        @empty
                            <div class="p-4 text-center text-muted">
                                Belum ada permintaan barang
                            </div>
                        @endforelse

                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {

            var options = {
                chart: {
                    type: 'area',
                    height: 350,
                    toolbar: {
                        show: false
                    }
                },
                stroke: {
                    curve: 'smooth'
                },
                dataLabels: {
                    enabled: false
                },
                series: [{
                        name: 'Barang Masuk',
                        data: @json($barangMasukChart->pluck('total'))
                    },
                    {
                        name: 'Barang Keluar',
                        data: @json($barangKeluarChart->pluck('total'))
                    }
                ],
                xaxis: {
                    categories: @json($barangMasukChart->pluck('tanggal'))
                },
                colors: ['#5D87FF', '#FA896B'],
                fill: {
                    type: "gradient",
                    gradient: {
                        shadeIntensity: 1,
                        opacityFrom: 0.5,
                        opacityTo: 0.1
                    }
                }
            };

            var chart = new ApexCharts(document.querySelector("#sales-overview"), options);
            chart.render();

        });
    </script>
@endsection
