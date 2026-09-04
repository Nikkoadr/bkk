<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes" />
    <title>Bukti Pendaftaran {{ $pendaftaran->code_pendaftaran }}</title>
    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome 6 (Free) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/dist/img/logoKotak.png') }}">
    <style>
        body { background: #f0f8ff; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        @media print {
            body { background: white; }
            .no-print { display: none !important; }
            .print-card { box-shadow: none !important; border: 1px solid #ddd; }
            .print-card .header-bg { background: #0a4b8a !important; -webkit-print-color-adjust: exact !important; print-color-adjust: exact !important; }
            .badge-print { -webkit-print-color-adjust: exact !important; print-color-adjust: exact !important; }
            .qr-print { box-shadow: none !important; border: 1px solid #ddd; }
        }
        .brand-image { height: 50px; width: auto; }
        @media (max-width: 480px) {
            .brand-image { height: 40px; }
        }
    </style>
</head>
<body>

    <div class="min-h-screen flex flex-col items-center justify-center p-4">

        <!-- ====== CARD ====== -->
        <div class="print-card w-full max-w-2xl bg-white rounded-2xl shadow-lg shadow-[#0b6bcb]/10 overflow-hidden">

            <!-- Header -->
            <div class="header-bg bg-gradient-to-r from-[#0a4b8a] to-[#2b8cdf] px-6 py-4 flex items-center justify-between">
                <img src="{{ asset('assets/dist/img/logoKotak_kecil.png') }}" alt="Logo" class="h-12 w-auto">
                <div class="text-center text-white">
                    <h3 class="text-base font-extrabold tracking-wide">BUKTI PENDAFTARAN</h3>
                    <p class="text-xs text-white/80">BKK SMK Muhammadiyah Kandanghaur</p>
                </div>
                <img src="{{ asset('assets/dist/img/BKK_kecil.png') }}" alt="BKK" class="h-12 w-auto">
            </div>

            <!-- Body -->
            <div class="p-6">

                <!-- Code -->
                <div class="bg-[#e6f3ff] rounded-xl px-4 py-3 text-center border border-[#b8d4f0] mb-5">
                    <p class="text-[#4a7fa8] text-[10px] font-semibold uppercase tracking-wider">Kode Registrasi</p>
                    <div class="flex items-center justify-center gap-3">
                        <span class="text-lg font-extrabold text-[#0a4b8a] font-mono tracking-wider" id="code_pendaftaran">{{ $pendaftaran->code_pendaftaran }}</span>
                        <button onclick="copyToClipboard()" class="text-[#0b6bcb] hover:text-[#1a7fdf] transition text-sm no-print" title="Salin">
                            <i class="fas fa-copy"></i>
                        </button>
                    </div>
                </div>

                <!-- Status -->
                <div class="flex items-center justify-between border-b border-[#e9f0f8] pb-3 mb-4">
                    <span class="text-sm font-semibold text-[#1a3f6a]">Status Pembayaran</span>
                    @switch($pendaftaran->status_bayar)
                        @case('sudah')
                            <span class="badge-print bg-green-600 text-white px-4 py-1 rounded-full text-xs font-bold"><i class="fas fa-check-circle mr-1"></i> LUNAS</span>
                            @break
                        @case('menunggu')
                            <span class="badge-print bg-yellow-400 text-[#1a3f6a] px-4 py-1 rounded-full text-xs font-bold"><i class="fas fa-clock mr-1"></i> MENUNGGU</span>
                            @break
                        @default
                            <span class="badge-print bg-red-600 text-white px-4 py-1 rounded-full text-xs font-bold"><i class="fas fa-times-circle mr-1"></i> BELUM</span>
                    @endswitch
                </div>

                <!-- Data diri -->
                <div class="space-y-2 text-sm">
                    <div class="flex border-b border-[#e9f0f8] pb-2">
                        <span class="font-semibold text-[#1a3f6a] w-[30%]">Nama</span>
                        <span class="text-[#0a4b8a] font-medium">: {{ $pendaftaran->nama }}</span>
                    </div>
                    <div class="flex border-b border-[#e9f0f8] pb-2">
                        <span class="font-semibold text-[#1a3f6a] w-[30%]">No WhatsApp</span>
                        <span class="text-[#0a4b8a] font-medium">: {{ $pendaftaran->nomor_wa }}</span>
                    </div>
                    <div class="flex border-b border-[#e9f0f8] pb-2">
                        <span class="font-semibold text-[#1a3f6a] w-[30%]">Asal Sekolah</span>
                        <span class="text-[#0a4b8a] font-medium">: {{ $pendaftaran->nama_sekolah ?: '-' }}</span>
                    </div>
                    <div class="flex">
                        <span class="font-semibold text-[#1a3f6a] w-[30%]">Perusahaan</span>
                        <span class="text-[#0a4b8a] font-medium">: {{ $pendaftaran->nama_loker }}</span>
                    </div>
                </div>

                <!-- Tanggal -->
                <div class="mt-4 text-center text-xs text-[#4a7fa8] border-t border-[#e9f0f8] pt-3">
                    <i class="fas fa-calendar-alt mr-1"></i>
                    Mendaftar pada : {{ Carbon\Carbon::parse($pendaftaran->pendaftaran_created_at)->setTimezone('Asia/Jakarta')->translatedFormat('d F Y, H:i') }} WIB
                </div>

                <!-- Catatan -->
                <div class="mt-4 text-center text-[10px] text-[#4a7fa8] border-t border-[#e9f0f8] pt-3">
                    <p>Simpan bukti ini sebagai syarat mengikuti proses recruitment</p>
                    <p class="text-red-600 font-semibold mt-1">Jika mengundurkan diri pada tahapan seleksi, dinyatakan GUGUR</p>
                </div>

            </div>

            <!-- Footer -->
            <div class="bg-[#f5faff] px-6 py-2 text-center text-[10px] text-[#4a7fa8] border-t border-[#e9f0f8]">
                <span class="font-bold text-[#0a4b8a]">✦ Bergerak Maju Menjadi Yang Terdepan ✦</span>
            </div>

        </div>

    </div>

    <script>
        function copyToClipboard() {
            const code = document.getElementById('code_pendaftaran').innerText;
            const ta = document.createElement('textarea');
            ta.value = code;
            document.body.appendChild(ta);
            ta.select();
            document.execCommand('copy');
            document.body.removeChild(ta);
            alert('Kode registrasi berhasil disalin!');
        }
    </script>

</body>
</html>