<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes" />
    <title>BKK SMK Muhammadiyah Kandanghaur - Bukti Pendaftaran</title>
    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome 6 (Free) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <!-- Google Font: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,600;14..32,700;14..32,800;14..32,900&display=swap" rel="stylesheet" />
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/dist/img/logoKotak.png') }}">
    <style>
        * { font-family: 'Inter', sans-serif; }
        body { background: #f0f8ff; }
        .glass-nav { background: rgba(255,255,255,0.78); backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px); }
        .brand-image { height: 52px; width: auto; max-height: 52px; object-fit: contain; }
        .card-glass { background: rgba(255,255,255,0.88); backdrop-filter: blur(4px); border: 1px solid rgba(220, 235, 250, 0.6); }
        .gradient-header { background: linear-gradient(135deg, #0a4b8a, #2b8cdf); }
        .btn-primary-custom { background: #0b6bcb; transition: all 0.2s; }
        .btn-primary-custom:hover { background: #1a7fdf; transform: scale(1.02); box-shadow: 0 4px 20px rgba(11, 107, 203, 0.3); }
        .btn-success-custom { background: #28a745; transition: all 0.2s; }
        .btn-success-custom:hover { background: #34ce57; transform: scale(1.02); box-shadow: 0 4px 20px rgba(40, 167, 69, 0.3); }
        .btn-secondary-custom { background: #e8f0fe; color: #0a4b8a; transition: all 0.2s; }
        .btn-secondary-custom:hover { background: #d4e4fc; transform: scale(1.02); }
        .badge-success { background: #28a745; color: white; }
        .badge-warning { background: #ffc107; color: #1a3f6a; }
        .badge-danger { background: #dc3545; color: white; }
        .qr-wrapper { background: white; padding: 20px; border-radius: 20px; display: inline-block; box-shadow: 0 8px 30px rgba(11, 107, 203, 0.08); border: 1px solid #e9f0f8; }
        .qr-wrapper svg { display: block; margin: 0 auto; }
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #e6f3ff; border-radius: 10px; }
        ::-webkit-scrollbar-thumb { background: #2b8cdf; border-radius: 10px; }
        @media (max-width: 480px) {
            .brand-image { height: 44px; max-height: 44px; }
        }
        .card-hover { transition: all 0.3s ease; }
        .card-hover:hover { transform: translateY(-4px); box-shadow: 0 20px 50px rgba(11, 107, 203, 0.1); }
        /* Animasi fade-in untuk action div */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .fade-in-up { animation: fadeInUp 0.5s ease forwards; }
        /* Custom checkbox */
        .custom-checkbox { appearance: none; width: 20px; height: 20px; border: 2px solid #b8d4f0; border-radius: 6px; cursor: pointer; transition: all 0.2s; position: relative; flex-shrink: 0; }
        .custom-checkbox:checked { background: #0b6bcb; border-color: #0b6bcb; }
        .custom-checkbox:checked::after { content: "✓"; color: white; font-size: 14px; font-weight: 700; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); }
        .custom-checkbox:focus { outline: none; box-shadow: 0 0 0 3px rgba(11, 107, 203, 0.15); }
    </style>
</head>
<body>

    <div class="min-h-screen flex flex-col">

        <!-- ====== NAVBAR ====== -->
        <nav class="glass-nav border-b border-[#dcebfa] sticky top-0 z-50 shadow-sm">
            <div class="max-w-7xl mx-auto px-3 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16 md:h-20">
                    <a href="/" class="flex items-center gap-2 flex-shrink-0">
                        <img src="{{ asset('assets/dist/img/logobkk.png') }}" alt="BKK Logo" class="brand-image" />
                        <span class="text-[#0a4b8a] font-bold text-base sm:text-lg hidden xs:inline-block">BKK SMK</span>
                    </a>
                    <a href="/" class="btn-secondary-custom px-4 py-2 rounded-full text-sm font-semibold flex items-center gap-2 transition">
                        <i class="fas fa-home"></i> <span class="hidden xs:inline">Home</span>
                    </a>
                </div>
            </div>
        </nav>

        <!-- ====== MAIN CONTENT ====== -->
        <main class="flex-1 max-w-3xl w-full mx-auto px-3 sm:px-6 lg:px-8 py-6 md:py-10">

            <!-- Header -->
            <div class="text-center mb-6 md:mb-8">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-[#e6f3ff] mb-3">
                    <i class="fas fa-file-alt text-[#2b8cdf] text-2xl"></i>
                </div>
                <h1 class="text-2xl sm:text-3xl font-extrabold text-[#0a4b8a] tracking-tight">Bukti Pendaftaran</h1>
                <p class="text-[#4a7fa8] text-sm mt-1">BKK SMK Muhammadiyah Kandanghaur</p>
                <div class="w-20 h-1 bg-gradient-to-r from-[#0b6bcb] to-[#5ba6f0] mx-auto mt-3 rounded-full"></div>
            </div>

            <!-- ====== CARD UTAMA ====== -->
            <div class="card-glass rounded-3xl shadow-xl shadow-[#0b6bcb]/5 border-[#dcebfa] overflow-hidden card-hover">
                <div class="gradient-header px-5 sm:px-8 py-4 flex items-center justify-between">
                    <h5 class="text-white font-bold text-base flex items-center gap-2">
                        <i class="fas fa-check-circle"></i> Konfirmasi Pendaftaran
                    </h5>
                    <span class="text-white/70 text-xs flex items-center gap-1">
                        <i class="fas fa-calendar-alt"></i> {{ Carbon\Carbon::parse($pendaftaran->pendaftaran_created_at)->setTimezone('Asia/Jakarta')->translatedFormat('d M Y') }}
                    </span>
                </div>

                <div class="p-5 sm:p-8">

                    <!-- ====== STATUS HEADER ====== -->
                    <div class="flex flex-col sm:flex-row items-center justify-between gap-3 mb-6 pb-4 border-b border-[#e9f0f8]">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 rounded-full bg-[#e6f3ff] flex items-center justify-center">
                                <i class="fas fa-user-check text-[#0b6bcb] text-xl"></i>
                            </div>
                            <div>
                                <p class="text-[#4a7fa8] text-xs font-semibold uppercase tracking-wider">Status Pendaftaran</p>
                                @if($pendaftaran->status_bayar == 'sudah')
                                    <span class="badge-success px-4 py-1.5 rounded-full text-sm font-semibold inline-flex items-center gap-1.5 mt-0.5">
                                        <i class="fas fa-check-circle"></i> LUNAS
                                    </span>
                                @else
                                    <span class="badge-warning px-4 py-1.5 rounded-full text-sm font-semibold inline-flex items-center gap-1.5 mt-0.5">
                                        <i class="fas fa-clock"></i> MENUNGGU
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="text-center sm:text-right">
                            <p class="text-[#4a7fa8] text-xs">Tanggal Daftar</p>
                            <p class="text-[#0a4b8a] font-semibold text-sm">{{ Carbon\Carbon::parse($pendaftaran->pendaftaran_created_at)->setTimezone('Asia/Jakarta')->translatedFormat('d F Y H:i') }}</p>
                        </div>
                    </div>

                    <!-- ====== DOKUMEN PERNYATAAN ====== -->
                    <div class="text-center mb-6">
                        <div class="inline-block bg-[#e6f3ff] px-4 py-2 rounded-full text-sm text-[#0a4b8a] font-semibold">
                            <i class="fas fa-file-signature mr-2"></i> Dokumen Pernyataan
                        </div>
                        <p class="text-[#1a3f6a] mt-3 text-sm">Dokumen ini menyatakan bahwa :</p>
                    </div>

                    <!-- ====== TABEL DATA ====== -->
                    <div class="overflow-x-auto bg-[#f8fcff] rounded-2xl border border-[#e9f0f8]">
                        <table class="w-full">
                            <tbody>
                                <tr class="border-b border-[#e9f0f8]">
                                    <td class="py-3 px-4 text-sm font-semibold text-[#1a3f6a] w-[35%]">Code Registrasi</td>
                                    <td class="py-3 text-[#4a7fa8] w-[5%]">:</td>
                                    <td class="py-3 pr-4 font-bold text-[#0a4b8a] text-sm font-mono tracking-wider flex items-center gap-2 flex-wrap">
                                        <span id="code_pendaftaran">{{ $pendaftaran->code_pendaftaran }}</span>
                                        <button onclick="copyToClipboard()" class="text-[#0b6bcb] hover:text-[#1a7fdf] transition text-sm" title="Salin ke clipboard">
                                            <i class="fas fa-copy"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr class="border-b border-[#e9f0f8]">
                                    <td class="py-3 px-4 text-sm font-semibold text-[#1a3f6a]">Nama Lengkap</td>
                                    <td class="py-3 text-[#4a7fa8]">:</td>
                                    <td class="py-3 pr-4 font-bold text-[#0a4b8a]">{{ $pendaftaran->nama }}</td>
                                </tr>
                                <tr class="border-b border-[#e9f0f8]">
                                    <td class="py-3 px-4 text-sm font-semibold text-[#1a3f6a]">No WhatsApp</td>
                                    <td class="py-3 text-[#4a7fa8]">:</td>
                                    <td class="py-3 pr-4 font-bold text-[#0a4b8a]">{{ $pendaftaran->nomor_wa }}</td>
                                </tr>
                                <tr class="border-b border-[#e9f0f8]">
                                    <td class="py-3 px-4 text-sm font-semibold text-[#1a3f6a]">Asal Sekolah</td>
                                    <td class="py-3 text-[#4a7fa8]">:</td>
                                    <td class="py-3 pr-4 font-bold text-[#0a4b8a]">{{ $pendaftaran->nama_sekolah ?: '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="py-3 px-4 text-sm font-semibold text-[#1a3f6a]">Status Pembayaran</td>
                                    <td class="py-3 text-[#4a7fa8]">:</td>
                                    <td class="py-3 pr-4">
                                        @if($pendaftaran->status_bayar == 'sudah')
                                            <span class="badge-success px-4 py-1.5 rounded-full text-xs font-semibold inline-flex items-center gap-1.5">
                                                <i class="fas fa-check-circle"></i> {{ $pendaftaran->status_bayar }}
                                            </span>
                                        @else
                                            <span class="badge-warning px-4 py-1.5 rounded-full text-xs font-semibold inline-flex items-center gap-1.5">
                                                <i class="fas fa-clock"></i> {{ $pendaftaran->status_bayar }}
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- ====== PERUSAHAAN ====== -->
                    <div class="mt-6 text-center bg-gradient-to-r from-[#e6f3ff] to-[#f0f8ff] rounded-2xl p-4 border border-[#dcebfa]">
                        <p class="text-[#4a7fa8] text-sm font-medium">Telah mendaftar sebagai calon pelamar pada :</p>
                        <p class="text-[#0a4b8a] font-extrabold text-lg mt-1">{{ $pendaftaran->nama_loker }}</p>
                    </div>

                    <!-- ====== SYARAT & KETENTUAN ====== -->
                    <div class="mt-6 bg-[#f5faff] rounded-2xl p-4 border border-[#dcebfa]">
                        <label class="flex items-start gap-3 cursor-pointer group">
                            <input type="checkbox" id="agreeTerms" onchange="toggleActionDiv()" class="custom-checkbox mt-0.5">
                            <div>
                                <span class="text-[#1a3f6a] text-sm font-semibold group-hover:text-[#0a4b8a] transition">
                                    <i class="fas fa-gavel mr-1.5 text-[#0b6bcb]"></i>
                                    Syarat dan Ketentuan berlaku
                                </span>
                                <p class="text-[#4a7fa8] text-xs mt-1">(centang untuk menyetujuinya)</p>
                            </div>
                        </label>
                        <div class="mt-3 text-center text-[#4a7fa8] text-xs border-t border-[#dcebfa] pt-3">
                            <i class="fas fa-info-circle mr-1 text-[#0b6bcb]"></i>
                            Kesiapan dan kesungguhan mengikuti seleksi. Jika mengundurkan diri pada tahapan seleksi dinyatakan gugur.
                        </div>
                    </div>

                    <!-- ====== ACTION DIV (hidden dulu) ====== -->
                    <div id="actionDiv" class="mt-6 hidden fade-in-up">
                        <div class="bg-[#e6f3ff] rounded-2xl p-5 border border-[#b8d4f0]">
                            @php
                                $grupWaLink = $pendaftaran->grup_wa;
                                if (!preg_match("~^(?:f|ht)tps?://~i", $grupWaLink)) {
                                    $grupWaLink = $grupWaLink;
                                }
                            @endphp

                            <!-- QR Code -->
                            <div class="text-center">
                                <p class="font-bold text-[#0a4b8a] text-sm flex items-center justify-center gap-2">
                                    <i class="fas fa-qrcode text-[#2b8cdf] text-lg"></i> QR Code Tiket
                                </p>
                                <div class="qr-wrapper mt-2">
                                    {!! QrCode::size(120)->backgroundColor(255,255,255)->generate($grupWaLink) !!}
                                </div>
                                <p class="text-[#4a7fa8] text-xs mt-2">Scan untuk bergabung dengan grup WhatsApp</p>
                            </div>

                            <!-- Tombol Aksi -->
                            <div class="mt-4 flex flex-col sm:flex-row items-center justify-center gap-3">
                                <a href="{{ $grupWaLink }}" target="_blank" class="btn-success-custom text-white px-6 py-2.5 rounded-full text-sm font-semibold flex items-center gap-2 shadow-md shadow-[#28a745]/20 transition w-full sm:w-auto justify-center">
                                    <i class="fab fa-whatsapp"></i> Gabung Grup WhatsApp
                                </a>
                                <form action="print_bukti_transfer" method="post" class="w-full sm:w-auto">
                                    @csrf
                                    <input type="hidden" name="code_pendaftaran" value="{{ $pendaftaran->code_pendaftaran }}">
                                    <button class="btn-primary-custom text-white px-6 py-2.5 rounded-full text-sm font-semibold flex items-center gap-2 shadow-md shadow-[#0b6bcb]/20 transition w-full sm:w-auto justify-center" formtarget="_blank" type="submit">
                                        <i class="fas fa-print"></i> Cetak
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- ====== TOMBOL KEMBALI ====== -->
            <div class="mt-6 text-center">
                <a href="/" class="btn-secondary-custom px-6 py-2.5 rounded-full text-sm font-semibold inline-flex items-center gap-2 transition">
                    <i class="fas fa-arrow-left"></i> Kembali ke Beranda
                </a>
            </div>

        </main>

        <!-- ====== FOOTER ====== -->
        <footer class="bg-white/80 backdrop-blur-sm border-t border-[#dcebfa] mt-8 md:mt-12">
            <div class="max-w-7xl mx-auto px-3 sm:px-6 lg:px-8 py-4 md:py-5 flex flex-col sm:flex-row justify-between items-center gap-2 text-xs sm:text-sm text-[#1a3f6a]">
                <div class="flex items-center gap-2 flex-wrap justify-center text-center sm:text-left">
                    <span><i class="far fa-copyright mr-1"></i> 2024-2025</span>
                    <a href="https://bkk.smkmuhkandanghaur.sch.id" class="font-semibold text-[#0b6bcb] hover:underline">Nikko Adrian</a>
                    <span class="hidden xs:inline">·</span>
                    <span class="text-xs">All rights reserved.</span>
                </div>
                <div class="flex items-center gap-3 text-[#0b6bcb]">
                    <span class="text-[10px] sm:text-xs font-medium text-[#1a3f6a]">Ikuti kami</span>
                    <a target="_blank" href="https://www.instagram.com/smkmuhkandanghaur/" class="hover:text-[#C13584] transition"><i class="fab fa-instagram text-base sm:text-lg"></i></a>
                    <a target="_blank" href="https://www.facebook.com/smkmuhkandanghaur" class="hover:text-[#1877F2] transition"><i class="fab fa-facebook text-base sm:text-lg"></i></a>
                    <a target="_blank" href="https://www.tiktok.com/@smkmuhkandanghaur" class="hover:text-black transition"><i class="fab fa-tiktok text-base sm:text-lg"></i></a>
                    <span class="text-[10px] sm:text-xs font-medium text-[#1a3f6a] hidden xs:inline">@smkmuhkandanghaur</span>
                </div>
            </div>
        </footer>

    </div>

    <!-- ====== SCRIPTS ====== -->
    <script>
        function copyToClipboard() {
            const codeText = document.getElementById('code_pendaftaran').innerText;
            const textarea = document.createElement('textarea');
            textarea.value = codeText;
            document.body.appendChild(textarea);
            textarea.select();
            document.execCommand('copy');
            document.body.removeChild(textarea);
            
            // Feedback visual
            const btn = event.target.closest('button');
            const originalIcon = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-check text-green-500"></i>';
            setTimeout(() => {
                btn.innerHTML = originalIcon;
            }, 2000);
            
            // Alert modern
            const toast = document.createElement('div');
            toast.className = 'fixed bottom-4 right-4 bg-[#0a4b8a] text-white px-6 py-3 rounded-2xl shadow-lg text-sm font-semibold flex items-center gap-2 z-50 animate-fade-in-up';
            toast.innerHTML = '<i class="fas fa-check-circle text-green-400"></i> Code Registrasi berhasil disalin!';
            document.body.appendChild(toast);
            setTimeout(() => {
                toast.remove();
            }, 3000);
        }

        function toggleActionDiv() {
            const checkbox = document.getElementById("agreeTerms");
            const actionDiv = document.getElementById("actionDiv");
            if (checkbox.checked) {
                actionDiv.style.display = "block";
                actionDiv.classList.add("fade-in-up");
            } else {
                actionDiv.style.display = "none";
            }
        }
    </script>

</body>
</html>