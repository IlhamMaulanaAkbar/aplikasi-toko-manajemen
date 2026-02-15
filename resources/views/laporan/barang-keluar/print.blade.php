<!DOCTYPE html>
<html>

<head>
    <title>Laporan Barang Keluar</title>
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
        LAPORAN BARANG KELUAR
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Nama Produk</th>
                <th>Batch</th>
                <th>Jumlah</th>
                <th>Tujuan</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($barangKeluar as $key => $item)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $item->tanggal_keluar }}</td>
                    <td>{{ $item->batch->produk->nama_produk ?? '-' }}</td>
                    <td>{{ $item->batch->nomor_batch ?? '-' }}</td>
                    <td>{{ $item->jumlah }}</td>
                    <td>{{ $item->tujuan }}</td>
                    <td>{{ $item->keterangan }}</td>
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
