<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bukti Pendaftaran {{ $pendaftaran->code_pendaftaran }}</title>
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
            <img src="{{ asset('assets/dist/img/logoKotak_kecil.png') }}" alt="Left Logo" style="height: 70px; float: left; margin-right: 10px;">
            <b>Bukti Pendaftaran</b>
            <img src="{{ asset('assets/dist/img/BKK_kecil.png') }}" alt="Right Logo" style="height: 70px; float: right; margin-left: 10px;">
        </h3>
        <h5 class="text-center">BKK SMK Muhammadiyah Kandanghaur</h5>
        <hr>
        <p class="text-center"><b>Code Registrasi: {{ $pendaftaran->code_pendaftaran }}</b></p>

        <p class="mt-3 mb-5 text-center">Dokumen ini menyatakan bahwa :</p>
        <table class="table">
            <tr>
                <th>Nama</th>
                <td>{{ $pendaftaran->nama }}</td>
            </tr>
            <tr>
                <th>No Whatsapp</th>
                <td>{{ $pendaftaran->nomor_wa }}</td>
            </tr>
            <tr>
                <th>Nama Sekolah</th>
                <td>{{ $pendaftaran->nama_sekolah }}</td>
            </tr>
            <tr>
                <th>Status Pembayaran</th>
                <td>
                {{ $pendaftaran->status_bayar }}
                </td>
            </tr>
        </table>
        <p class="mt-4 mb-3 text-center">Telah mendaftar sebagai calon pelamar pada :</p>
        <p class="text-center"><b>Perusahaan: {{ $pendaftaran->nama_loker }}</b></p>
        <p class="text-center"><b>Pada tanggal : {{ $pendaftaran->pendaftaran_created_at }}</b></p>
        <p class="text-center">Simpan bukti pendaftaran ini. Sebagai syarat mengikuti proses recruitment perusahaan.</p>
        <p class="text-center m-3">{!! QrCode::size(100)->backgroundColor(255,255,255)->generate('https://bkk.smkmuhkandanghaur.sch.id/cari/'.$pendaftaran->code_pendaftaran) !!}</p>
        <p class="text-center"><b>Bergerak Maju Menjadi Yang Terdepan</b></p>
    </div>
    <script> window.print(); </script>
</body>
</html>