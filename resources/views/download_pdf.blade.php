<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bukti Pendaftaran {{ $code_pendaftaran }}</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
        }
        .content {
            width: 80%;
            margin: 0 auto;
        }
        .text-center {
            text-align: center;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        .table, .table th, .table td {
            border: 1px solid black;
        }
        .table th, .table td {
            padding: 10px;
        }
        .badge {
            display: inline-block;
            padding: 0.5em;
            font-size: 0.75em;
            color: white;
        }
        .badge.bg-green {
            background-color: green;
        }
        .badge.bg-yellow {
            background-color: yellow;
        }
    </style>
</head>
<body>
    <div class="content">
    <h3 class="text-center">
        <img src="{{ asset('assets/dist/img/BKK.png') }}" alt="Left Logo" style="height: 70px; float: left; margin-right: 10px;">
        <b>Bukti Pendaftaran</b>
        <img src="{{ asset('assets/dist/img/logoKotak.png') }}" alt="Right Logo" style="height: 70px; float: right; margin-left: 10px;">
    </h3>
        <h5 class="text-center">BKK SMK Muhammadiyah Kandanghaur</h5>
        <hr>
        <p class="text-center"><b>Code Registrasi: {{ $code_pendaftaran }}</b></p>

        <p class="mt-3 mb-5 text-center">Dokumen ini menyatakan bahwa :</p>
        <table class="table">
            <tr>
                <th>Nama</th>
                <td>{{ $nama }}</td>
            </tr>
            <tr>
                <th>No Whatsapp</th>
                <td>{{ $nomor_wa }}</td>
            </tr>
            <tr>
                <th>Nama Sekolah</th>
                <td>{{ $nama_sekolah }}</td>
            </tr>
            <tr>
                <th>Status Pembayaran</th>
                <td>
                {{ $status_bayar }}
                </td>
            </tr>
        </table>
        <p class="mt-4 mb-3 text-center">Telah mendaftar sebagai calon pelamar pada :</p>
        <p class="text-center"><b>Perusahaan: {{ $nama_loker }}</b></p>
        <p class="text-center"><b>Pada tanggal : {{ $pendaftaran_created_at }}</b></p>
        <p class="text-center">Simpan bukti pendaftaran ini. Sebagai syarat mengikuti proses recruitment perusahaan.</p>
        <div class="text-center">
            <img src="{{ $qr_code_path }}" alt="QR Code">
        </div>
    </div>
</body>
</html>