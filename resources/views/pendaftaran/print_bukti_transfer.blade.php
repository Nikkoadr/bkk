<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/dist/img/logoKotak.png') }}">
    <title>Bukti Pendaftaran {{ $pendaftaran->code_pendaftaran }}</title>
    <style>
        /* Reset default */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'DejaVu Sans', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        /* ===== UKURAN SETENGAH A4 (A5 Landscape) ===== */
        .print-container {
            width: 210mm;  /* A4 width */
            height: 148mm; /* A5 height (setengah A4) */
            background: white;
            padding: 10mm 12mm;
            margin: 0 auto;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            border-radius: 4px;
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        /* ===== HEADER ===== */
        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 2px solid #0a4b8a;
            padding-bottom: 8px;
            margin-bottom: 10px;
        }
        .header .logo-left {
            height: 55px;
            width: auto;
        }
        .header .logo-right {
            height: 55px;
            width: auto;
        }
        .header .title-group {
            text-align: center;
            flex: 1;
        }
        .header .title-group h3 {
            font-size: 14px;
            font-weight: 800;
            color: #0a4b8a;
            margin: 0;
            letter-spacing: 0.5px;
        }
        .header .title-group p {
            font-size: 11px;
            font-weight: 600;
            color: #1a5f8a;
            margin: 2px 0 0 0;
        }

        /* ===== KODE REGISTRASI ===== */
        .code-box {
            background: #e6f3ff;
            border: 1px dashed #0b6bcb;
            border-radius: 6px;
            padding: 6px 12px;
            text-align: center;
            margin-bottom: 10px;
        }
        .code-box .label {
            font-size: 9px;
            font-weight: 700;
            color: #4a7fa8;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .code-box .code {
            font-size: 16px;
            font-weight: 900;
            color: #0a4b8a;
            font-family: 'Courier New', monospace;
            letter-spacing: 1px;
        }

        /* ===== TABLE ===== */
        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin: 8px 0;
            font-size: 11px;
        }
        .info-table td {
            padding: 5px 8px;
            border-bottom: 1px solid #e9f0f8;
        }
        .info-table .label-cell {
            font-weight: 700;
            color: #1a3f6a;
            width: 35%;
            background: #f8fcff;
        }
        .info-table .value-cell {
            font-weight: 600;
            color: #0a4b8a;
        }
        .info-table .status-badge {
            display: inline-block;
            padding: 2px 14px;
            border-radius: 20px;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
        }
        .status-badge.sudah {
            background: #28a745;
            color: white;
        }
        .status-badge.menunggu {
            background: #ffc107;
            color: #1a3f6a;
        }
        .status-badge.belum {
            background: #dc3545;
            color: white;
        }

        /* ===== PERUSAHAAN ===== */
        .company-box {
            background: #f0f8ff;
            border: 1px solid #dcebfa;
            border-radius: 6px;
            padding: 8px 12px;
            text-align: center;
            margin: 8px 0;
        }
        .company-box .label {
            font-size: 9px;
            font-weight: 600;
            color: #4a7fa8;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .company-box .name {
            font-size: 13px;
            font-weight: 800;
            color: #0a4b8a;
            margin-top: 2px;
        }
        .company-box .date {
            font-size: 10px;
            color: #4a7fa8;
            margin-top: 2px;
        }

        /* ===== QR CODE ===== */
        .qr-section {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
            margin: 6px 0;
            padding: 6px 0;
            border-top: 1px solid #e9f0f8;
            border-bottom: 1px solid #e9f0f8;
        }
        .qr-section .qr-wrapper {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .qr-section .qr-wrapper svg {
            width: 70px !important;
            height: 70px !important;
        }
        .qr-section .qr-label {
            font-size: 8px;
            color: #4a7fa8;
            margin-top: 2px;
        }
        .qr-section .info-text {
            font-size: 9px;
            color: #1a3f6a;
            line-height: 1.4;
            max-width: 60%;
        }
        .qr-section .info-text strong {
            color: #0a4b8a;
        }

        /* ===== FOOTER ===== */
        .footer {
            text-align: center;
            margin-top: auto;
            padding-top: 8px;
            border-top: 1px solid #e9f0f8;
            font-size: 9px;
            color: #4a7fa8;
        }
        .footer .motto {
            font-weight: 700;
            color: #0a4b8a;
            font-size: 10px;
            letter-spacing: 0.5px;
        }
        .footer .note {
            font-size: 8px;
            color: #6a8fa8;
            margin-top: 2px;
        }

        /* ===== RESPONSIVE ===== */
        @media print {
            body {
                background: white;
                padding: 0;
                display: block;
            }
            .print-container {
                width: 100%;
                height: auto;
                min-height: 148mm;
                box-shadow: none;
                border-radius: 0;
                padding: 8mm 10mm;
                margin: 0;
            }
            .no-print {
                display: none !important;
            }
        }

        @media (max-width: 500px) {
            .print-container {
                width: 100%;
                height: auto;
                min-height: auto;
                padding: 8mm 6mm;
            }
            .header .logo-left, .header .logo-right {
                height: 40px;
            }
            .header .title-group h3 {
                font-size: 12px;
            }
            .code-box .code {
                font-size: 13px;
            }
            .info-table {
                font-size: 10px;
            }
            .qr-section {
                flex-direction: column;
                gap: 8px;
            }
            .qr-section .info-text {
                max-width: 100%;
                text-align: center;
            }
            .company-box .name {
                font-size: 12px;
            }
        }

        /* Tombol print (hanya tampil di layar) */
        .print-btn {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background: #0b6bcb;
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 50px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            box-shadow: 0 4px 20px rgba(11, 107, 203, 0.3);
            transition: all 0.2s;
            z-index: 999;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .print-btn:hover {
            background: #1a7fdf;
            transform: scale(1.03);
        }
        .print-btn i {
            font-size: 16px;
        }
        @media print {
            .print-btn {
                display: none !important;
            }
        }
    </style>
</head>
<body>

    <!-- ===== TOMBOL PRINT (hanya di layar) ===== -->
    <button class="print-btn no-print" onclick="window.print()">
        <i class="fas fa-print"></i> Cetak / Print
    </button>

    <!-- ===== KONTEN CETAK ===== -->
    <div class="print-container">

        <!-- ===== HEADER ===== -->
        <div class="header">
            <img src="{{ asset('assets/dist/img/logoKotak_kecil.png') }}" alt="Logo" class="logo-left">
            <div class="title-group">
                <h3>BUKTI PENDAFTARAN</h3>
                <p>BKK SMK Muhammadiyah Kandanghaur</p>
            </div>
            <img src="{{ asset('assets/dist/img/BKK_kecil.png') }}" alt="BKK Logo" class="logo-right">
        </div>

        <!-- ===== CODE REGISTRASI ===== -->
        <div class="code-box">
            <div class="label">Kode Registrasi</div>
            <div class="code">{{ $pendaftaran->code_pendaftaran }}</div>
        </div>

        <!-- ===== TABEL DATA ===== -->
        <table class="info-table">
            <tr>
                <td class="label-cell">Nama Lengkap</td>
                <td class="value-cell">{{ $pendaftaran->nama }}</td>
            </tr>
            <tr>
                <td class="label-cell">No WhatsApp</td>
                <td class="value-cell">{{ $pendaftaran->nomor_wa }}</td>
            </tr>
            <tr>
                <td class="label-cell">Asal Sekolah</td>
                <td class="value-cell">{{ $pendaftaran->nama_sekolah ?: '-' }}</td>
            </tr>
            <tr>
                <td class="label-cell">Status Pembayaran</td>
                <td class="value-cell">
                    @if($pendaftaran->status_bayar == 'sudah')
                        <span class="status-badge sudah"><i class="fas fa-check-circle"></i> LUNAS</span>
                    @elseif($pendaftaran->status_bayar == 'menunggu')
                        <span class="status-badge menunggu"><i class="fas fa-clock"></i> MENUNGGU</span>
                    @else
                        <span class="status-badge belum"><i class="fas fa-times-circle"></i> BELUM</span>
                    @endif
                </td>
            </tr>
        </table>

        <!-- ===== PERUSAHAAN ===== -->
        <div class="company-box">
            <div class="label">Telah mendaftar sebagai calon pelamar pada</div>
            <div class="name">{{ $pendaftaran->nama_loker }}</div>
            <div class="date">
                <i class="fas fa-calendar-alt"></i>
                {{ Carbon\Carbon::parse($pendaftaran->pendaftaran_created_at)->setTimezone('Asia/Jakarta')->translatedFormat('d F Y, H:i') }} WIB
            </div>
        </div>

        <!-- ===== QR CODE ===== -->
        <div class="qr-section">
            <div class="qr-wrapper">
                {!! QrCode::size(80)->backgroundColor(255,255,255)->generate('https://bkk.smkmuhkandanghaur.sch.id/scan/'.$pendaftaran->code_pendaftaran) !!}
                <span class="qr-label">Scan untuk verifikasi</span>
            </div>
            <div class="info-text">
                <strong>Catatan:</strong> Simpan bukti pendaftaran ini sebagai syarat mengikuti proses recruitment perusahaan. 
                Jika mengundurkan diri pada tahapan seleksi, dinyatakan <strong>GUGUR</strong>.
            </div>
        </div>

        <!-- ===== FOOTER ===== -->
        <div class="footer">
            <div class="motto">✦ Bergerak Maju Menjadi Yang Terdepan ✦</div>
            <div class="note">Bukti ini dicetak secara otomatis oleh sistem BKK SMK Muhammadiyah Kandanghaur</div>
        </div>

    </div>

    <!-- Font Awesome untuk icon (hanya di layar) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />

    <script>
        // Auto print jika diperlukan (opsional)
        // window.print();
    </script>

</body>
</html>