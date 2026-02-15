<!DOCTYPE html>
<html>

<head>
    <title>Surat Persetujuan</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 14px;
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

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            padding: 6px;
        }

        .ttd {
            text-align: right;
            margin-top: 40px;
        }

        .qr {
            margin-top: 20px;
        }
    </style>
</head>

<body>

    {{-- ================== KOP SURAT ================== --}}
    <div class="kop">
        <img src="{{ public_path('assets/images/logos/logo-livi.jpg') }}" alt="Logo">
        <h2>LIVI - BEAUTY HOUSE</h2>
        <p>Jl. Sultan Adam No.4b, Antasan Kecil Tim., Kec. Banjarmasin Utara, <br>Kota Banjarmasin, Kalimantan Selatan
            70122</p>
        <p>Telepon: 0897-1900-008</p>
    </div>


    {{-- ================== JUDUL ================== --}}
    <div class="title">
        SURAT PERSETUJUAN PERMINTAAN BARANG
    </div>

    <p>
        Dengan ini menyatakan bahwa permintaan barang berikut telah disetujui:
    </p>

    <table>
        <tr>
            <td width="30%">Tanggal Permintaan</td>
            <td>: {{ \Carbon\Carbon::parse($permintaanBarang->tanggal_permintaan)->format('d M Y') }}</td>
        </tr>
        <tr>
            <td>Nama Produk</td>
            <td>: {{ $permintaanBarang->produk->nama_produk }}</td>
        </tr>
        <tr>
            <td>Jumlah Diminta</td>
            <td>: {{ $permintaanBarang->jumlah_diminta }}</td>
        </tr>
        <tr>
            <td>Keterangan</td>
            <td>: {{ $permintaanBarang->keterangan }}</td>
        </tr>
    </table>


    {{-- ================== TANDA TANGAN DIGITAL ================== --}}
    <div class="ttd">
        Banjarmasin, {{ now()->format('d M Y') }}
        <br><br>

        {{-- Jika ada gambar tanda tangan --}}
        @if ($ttd ?? false)
            <img src="{{ public_path('storage/ttd/' . $ttd) }}" width="120">
        @else
            <br><br><br>
        @endif

        <br>
        <p>Manajer</p>
    </div>

</body>

</html>
