<!DOCTYPE html>
<html>

<head>
    <title>Laporan Stok Produk</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }

        .kop {
            text-align: center;
            border-bottom: 2px solid black;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .kop img {
            float: center;
            width: 70px;
            height: auto;
            margin-top: 10px;
            /* margin-left: 5px; */
            /* margin-right: 80px; */
        }

        .kop h2 {
            margin: 0;
        }

        .kop p {
            margin: 2px;
            font-size: 12px;
        }

        .title {
            text-align: center;
            font-weight: bold;
            font-size: 16px;
            margin: 20px 0;
            text-decoration: underline;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 6px;
            text-align: center;
        }

        .text-left {
            text-align: left;
        }
    </style>
</head>

<body>
    <div class="kop">
        <img src="{{ public_path('assets/images/logos/logo-livi.jpg') }}" alt="Logo">
        <h2>LIVI - BEAUTY HOUSE</h2>
        <p>Jl. Sultan Adam No.4b, Antasan Kecil Tim., Kec. Banjarmasin Utara, <br>Kota Banjarmasin, Kalimantan Selatan
            70122</p>
        <p>Telepon: 0897-1900-008</p>
    </div>


    {{-- ================== JUDUL ================== --}}
    <div class="title">
        LAPORAN STOK PRODUK
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode</th>
                <th>Nama Produk</th>
                <th>Brand</th>
                <th>Jenis</th>
                <th>Satuan</th>
                <th>Total Stok</th>
                <th>Stok Minimum</th>
                <th>Status Stok</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($produk as $i => $p)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $p->kode_produk }}</td>
                    <td>{{ $p->nama_produk }}</td>
                    <td>{{ $p->brand }}</td>
                    <td>{{ $p->jenis->nama_jenis }}</td>
                    <td>{{ $p->satuan->nama_satuan }}</td>
                    <td>{{ $p->stok_total }}</td>
                    <td>{{ $p->stok_minimum }}</td>
                    <td>{{ $p->status_stok }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <br><br>

    <div style="text-align:right;">
        Banjarmasin, {{ now()->format('d M Y') }}
        <br><br><br><br><br>
        <strong>Manajer</strong>
    </div>

</body>

</html>
