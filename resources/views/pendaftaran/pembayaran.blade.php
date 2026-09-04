
    <!DOCTYPE html>
    <html lang="en">
    <head><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes" />
    <title>BKK SMK Muhammadiyah Kandanghaur - Pembayaran</title>
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
        .card-glass { background: rgba(255,255,255,0.85); backdrop-filter: blur(4px); border: 1px solid rgba(220, 235, 250, 0.6); }
        .gradient-header { background: linear-gradient(135deg, #0a4b8a, #2b8cdf); }
        .btn-primary-custom { background: #0b6bcb; transition: all 0.2s; }
        .btn-primary-custom:hover { background: #1a7fdf; transform: scale(1.02); box-shadow: 0 4px 20px rgba(11, 107, 203, 0.3); }
        .btn-secondary-custom { background: #e8f0fe; color: #0a4b8a; transition: all 0.2s; }
        .btn-secondary-custom:hover { background: #d4e4fc; transform: scale(1.02); }
        .badge-success { background: #28a745; color: white; }
        .badge-warning { background: #ffc107; color: #1a3f6a; }
        .badge-danger { background: #dc3545; color: white; }
        .input-custom:focus { border-color: #2b8cdf; box-shadow: 0 0 0 3px rgba(43, 140, 223, 0.15); outline: none; }
        .input-custom { transition: all 0.2s; }
        .qr-wrapper { background: white; padding: 20px; border-radius: 20px; display: inline-block; box-shadow: 0 8px 30px rgba(11, 107, 203, 0.08); border: 1px solid #e9f0f8; }
        .qr-wrapper svg { display: block; margin: 0 auto; }
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #e6f3ff; border-radius: 10px; }
        ::-webkit-scrollbar-thumb { background: #2b8cdf; border-radius: 10px; }
        @media (max-width: 480px) {
            .brand-image { height: 44px; max-height: 44px; }
        }
        /* Animasi pulse untuk status menunggu */
        @keyframes pulse-warning {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.7; }
        }
        .animate-pulse-warning { animation: pulse-warning 1.5s ease-in-out infinite; }
        /* Hover effect card */
        .card-hover { transition: all 0.3s ease; }
        .card-hover:hover { transform: translateY(-4px); box-shadow: 0 20px 50px rgba(11, 107, 203, 0.1); }
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
        <main class="flex-1 max-w-4xl w-full mx-auto px-3 sm:px-6 lg:px-8 py-6 md:py-10">

            <!-- Header -->
            <div class="text-center mb-6 md:mb-8">
                <h1 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-[#0a4b8a] tracking-tight flex items-center justify-center gap-3">
                    <i class="fas fa-credit-card text-[#2b8cdf]"></i>
                    Proses Pembayaran
                </h1>
                <p class="text-[#4a7fa8] text-sm mt-1">BKK SMK Muhammadiyah Kandanghaur</p>
                <div class="w-20 h-1 bg-gradient-to-r from-[#0b6bcb] to-[#5ba6f0] mx-auto mt-3 rounded-full"></div>
            </div>

            <!-- ====== CARD UTAMA ====== -->
            <div class="card-glass rounded-3xl shadow-xl shadow-[#0b6bcb]/5 border-[#dcebfa] overflow-hidden card-hover">
                <div class="gradient-header px-5 sm:px-8 py-4 flex items-center justify-between">
                    <h5 class="text-white font-bold text-base flex items-center gap-2">
                        <i class="fas fa-receipt"></i> Detail Pendaftaran
                    </h5>
                    <span class="text-white/70 text-xs flex items-center gap-1">
                        <i class="fas fa-clock"></i> {{ date('d M Y') }}
                    </span>
                </div>

                <div class="p-5 sm:p-8">

                    <!-- ====== TABEL DATA ====== -->
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <tbody>
                                <tr class="border-b border-[#e9f0f8]">
                                    <td class="py-3 pr-4 text-sm font-semibold text-[#1a3f6a] w-[35%]">Code Registrasi</td>
                                    <td class="py-3 px-2 text-[#4a7fa8] w-[5%]">:</td>
                                    <td class="py-3 pl-4 font-bold text-[#0a4b8a] text-sm sm:text-base font-mono tracking-wider">{{ $pendaftaran->code_pendaftaran }}</td>
                                </tr>
                                <tr class="border-b border-[#e9f0f8]">
                                    <td class="py-3 pr-4 text-sm font-semibold text-[#1a3f6a]">Nama Lengkap</td>
                                    <td class="py-3 px-2 text-[#4a7fa8]">:</td>
                                    <td class="py-3 pl-4 font-bold text-[#0a4b8a]">{{ $pendaftaran->nama }}</td>
                                </tr>
                                <tr class="border-b border-[#e9f0f8]">
                                    <td class="py-3 pr-4 text-sm font-semibold text-[#1a3f6a]">No WhatsApp</td>
                                    <td class="py-3 px-2 text-[#4a7fa8]">:</td>
                                    <td class="py-3 pl-4 font-bold text-[#0a4b8a]">{{ $pendaftaran->nomor_wa }}</td>
                                </tr>
                                <tr class="border-b border-[#e9f0f8]">
                                    <td class="py-3 pr-4 text-sm font-semibold text-[#1a3f6a]">Asal Sekolah</td>
                                    <td class="py-3 px-2 text-[#4a7fa8]">:</td>
                                    <td class="py-3 pl-4 font-bold text-[#0a4b8a]">{{ $pendaftaran->nama_sekolah ?: '-' }}</td>
                                </tr>
                                <tr class="border-b border-[#e9f0f8]">
                                    <td class="py-3 pr-4 text-sm font-semibold text-[#1a3f6a]">Perusahaan</td>
                                    <td class="py-3 px-2 text-[#4a7fa8]">:</td>
                                    <td class="py-3 pl-4 font-bold text-[#0a4b8a]">{{ $pendaftaran->nama_loker }}</td>
                                </tr>
                                <tr class="border-b border-[#e9f0f8]">
                                    <td class="py-3 pr-4 text-sm font-semibold text-[#1a3f6a]">Status Pembayaran</td>
                                    <td class="py-3 px-2 text-[#4a7fa8]">:</td>
                                    <td class="py-3 pl-4">
                                        @if($pendaftaran->status_bayar == 'sudah')
                                            <span class="badge-success px-4 py-1.5 rounded-full text-xs font-semibold inline-flex items-center gap-1.5">
                                                <i class="fas fa-check-circle"></i> {{ $pendaftaran->status_bayar }}
                                            </span>
                                        @elseif($pendaftaran->status_bayar == 'menunggu')
                                            <span class="badge-warning px-4 py-1.5 rounded-full text-xs font-semibold inline-flex items-center gap-1.5 animate-pulse-warning">
                                                <i class="fas fa-clock"></i> {{ $pendaftaran->status_bayar }}
                                            </span>
                                        @else
                                            <span class="badge-danger px-4 py-1.5 rounded-full text-xs font-semibold inline-flex items-center gap-1.5">
                                                <i class="fas fa-times-circle"></i> {{ $pendaftaran->status_bayar }}
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-3 pr-4 text-sm font-semibold text-[#1a3f6a]">Administrasi</td>
                                    <td class="py-3 px-2 text-[#4a7fa8]">:</td>
                                    <td class="py-3 pl-4 font-bold text-[#0a4b8a] text-lg">Rp {{ number_format($bayar->administrasi, 0, ',', '.') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <hr class="my-6 border-[#dcebfa]" />

                    <!-- ====== METODE PEMBAYARAN ====== -->
                    <div>
                        <h6 class="font-bold text-[#0a4b8a] text-base flex items-center gap-2 mb-3">
                            <i class="fas fa-university text-[#2b8cdf]"></i> Metode Pembayaran
                        </h6>
                        <div class="bg-[#f5faff] rounded-2xl p-4 sm:p-5 border border-[#dcebfa]">
                            <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4">
                                <div class="flex items-center gap-4">
                                    <img style="width: 80px; height: 80px; border-radius: 14px; object-fit: contain; background: white; padding: 8px; border: 1px solid #e9f0f8;" 
                                         src="https://upload.wikimedia.org/wikipedia/commons/a/ac/SeaBank.svg" alt="SeaBank">
                                    <div>
                                        <div class="font-bold text-[#0a4b8a] text-lg tracking-wider">901818696473</div>
                                        <div class="text-[#4a7fa8] text-sm">a.n Solihun</div>
                                    </div>
                                </div>
                                <div class="sm:ml-auto flex items-center gap-2 text-xs text-[#4a7fa8] bg-white px-3 py-1.5 rounded-full border border-[#dcebfa]">
                                    <i class="fas fa-check-circle text-[#28a745]"></i> Bank Terverifikasi
                                </div>
                            </div>
                            <div class="mt-3 text-sm text-[#4a7fa8] flex items-center gap-2">
                                <i class="fas fa-info-circle text-[#0b6bcb]"></i>
                                Transfer sesuai nominal administrasi di atas
                            </div>
                        </div>
                    </div>

                    <!-- ====== QR CODE / UPLOAD BUKTI ====== -->
                    @if($pendaftaran->status_bayar == 'sudah' || $pendaftaran->status_bayar == 'menunggu')
                        <div class="mt-6 text-center">
                            <p class="font-bold text-[#0a4b8a] text-sm flex items-center justify-center gap-2">
                                <i class="fas fa-qrcode text-[#2b8cdf] text-lg"></i> QR Code Tiket
                            </p>
                            <div class="qr-wrapper mt-2">
                                {!! QrCode::size(130)->backgroundColor(255,255,255)->generate('https://bkk.smkmuhkandanghaur.sch.id/scan/'.$pendaftaran->code_pendaftaran) !!}
                            </div>
                            <p class="text-[#4a7fa8] text-xs mt-2">Scan untuk verifikasi kehadiran</p>
                        </div>
                    @else
                        <div class="mt-6">
                            <div class="bg-blue-50 border-l-4 border-[#0b6bcb] text-[#0a4b8a] p-4 rounded-2xl flex items-start gap-3">
                                <i class="fas fa-info-circle text-[#0b6bcb] text-lg mt-0.5"></i>
                                <div>
                                    <strong>Lakukan pembayaran</strong> dan upload bukti transfer di bawah ini
                                </div>
                            </div>

                            <form action="/bukti_pembayaran" method="post" enctype="multipart/form-data" class="mt-4">
                                @csrf
                                @method('put')
                                <input type="hidden" name="id" value="{{ $pendaftaran->id }}">
                                
                                <label for="bukti_transfer" class="font-semibold text-[#1a3f6a] text-sm flex items-center gap-2">
                                    <i class="fas fa-upload text-[#0b6bcb]"></i> Upload Bukti Pembayaran
                                    <span class="text-red-500">*</span>
                                </label>
                                
                                <div class="flex flex-col sm:flex-row gap-2 mt-2">
                                    <div class="flex-1 relative">
                                        <input type="file" 
                                               class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" 
                                               id="bukti_transfer" 
                                               required 
                                               name="bukti_transfer"
                                               onchange="document.getElementById('file-label').textContent = this.files[0]?.name || 'Pilih file bukti transfer'">
                                        <div class="w-full bg-white border-2 border-dashed border-[#d4e8fc] rounded-2xl px-4 py-3 text-sm text-[#4a7fa8] transition hover:border-[#0b6bcb]">
                                            <i class="fas fa-cloud-upload-alt mr-2 text-[#0b6bcb]"></i>
                                            <span id="file-label">Pilih file bukti transfer</span>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn-primary-custom text-white px-6 py-3 rounded-2xl text-sm font-semibold flex items-center justify-center gap-2 shadow-md shadow-[#0b6bcb]/20 transition flex-shrink-0">
                                        <i class="fas fa-upload"></i> Upload
                                    </button>
                                </div>
                                <p class="text-[#4a7fa8] text-xs mt-2">
                                    <i class="fas fa-file-image mr-1"></i> Format: JPG, PNG, PDF (max 2MB)
                                </p>
                            </form>

                            <div class="mt-4 bg-[#e6f3ff] rounded-2xl p-4 border border-[#b8d4f0] text-center">
                                <i class="fas fa-clock text-[#0b6bcb] mr-2"></i>
                                <span class="text-[#1a3f6a] text-sm">Segera lakukan Pembayaran sebelum loker ditutup atau kuota terpenuhi</span>
                            </div>
                        </div>
                    @endif

                </div>
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

    <!-- ====== SCRIPT ====== -->
    <script>
        // Untuk menampilkan nama file yang dipilih
        document.addEventListener('DOMContentLoaded', function() {
            const fileInput = document.getElementById('bukti_transfer');
            if (fileInput) {
                fileInput.addEventListener('change', function(e) {
                    const label = document.getElementById('file-label');
                    if (this.files && this.files[0]) {
                        label.textContent = this.files[0].name;
                    } else {
                        label.textContent = 'Pilih file bukti transfer';
                    }
                });
            }
        });
    </script>

</body>
</html>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>BKK SMK Muhammadiyah Kandanghaur</title>
        <link
        rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"/>
        <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free-6.5.2-web/css/all.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
        <link rel="icon" type="image/x-icon" href="{{ asset('assets/dist/img/logoKotak.png') }}">
    </head>
        <body class="hold-transition layout-top-nav layout-navbar-fixed" style="font-family:'Times New Roman', Times, serif">
        <div class="wrapper">
            <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
                <div class="container">
                    <a href="/" class="navbar-brand">
                        <img src="{{ asset('assets/dist/img/logobkk.png') }}" alt="dosq" class="brand-image">
                    </a>
                </div>
            </nav>
        <div class="content-wrapper">
            <div class="content-header">
            </div>
            <div class="content">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-solid">
                                <div class="card-body pb-0">
                                    <h3 class="text-center">
                                        <b>Proses Pembayaran</b>
                                    </h3>
                                    <h5 class="text-center">BKK SMK Muhammadiyah Kandanghaur</h5>
                                    <hr>
                                    <table class="table table-striped">
                                        <tr>
                                            <td><b>Code Registrasi</b></td>
                                            <td><b>:</b></td>
                                            <td><b>{{ $pendaftaran -> code_pendaftaran }}</b</td>
                                        </tr>
                                        <tr>
                                            <td><b>Nama</b></td>
                                            <td><b>:</b></td>
                                            <td><b>{{ $pendaftaran -> nama }}</b</td>
                                        </tr>
                                        <tr>
                                            <td><b>No Whatsapp</b></td>
                                            <td><b>:</b></td>
                                            <td><b>{{ $pendaftaran -> nomor_wa }}</b></td>
                                        </tr>
                                        <tr>
                                            <td><b>Asal Sekolah</b></td>
                                            <td><b>:</b></td>
                                            <td><b>{{ $pendaftaran -> nama_sekolah }}</b></td>
                                        </tr>
                                        <tr>
                                            <td><b>Perusahaan</b></td>
                                            <td><b>:</b></td>
                                            <td><b>{{ $pendaftaran -> nama_loker }}</b></td>
                                        </tr>
                                        <tr>
                                            <td><b>Status Pembayaran</b></td>
                                            <td><b>:</b></td>
                                            <td>
                                            @if( $pendaftaran -> status_bayar  == 'sudah')
                                                <span class="badge bg-green">{{ $pendaftaran -> status_bayar }}</span>
                                            @elseif($pendaftaran -> status_bayar  == 'menunggu')
                                                <span class="badge bg-yellow">{{ $pendaftaran -> status_bayar }}</span>
                                            @else
                                                <span class="badge bg-red">{{ $pendaftaran -> status_bayar }}</span>
                                            @endif</td>
                                        </tr>
                                        <tr>
                                            <td><b>Administrasi</b></td>
                                            <td><b>:</b></td>
                                            <td><b>{{ number_format($bayar->administrasi, 0, ',', '.') }}</b></td>
                                        </tr>
                                    </table>
                                    <hr>
                                    <div class="col-12 m-1">
                                        <p class="lead">Metode Pembayaran :</p>
                                        <table>
                                            <tr>
                                                <td><img style="width: 90px; height: 90px;" src="https://upload.wikimedia.org/wikipedia/commons/a/ac/SeaBank.svg" alt="seabank"> <span>: <b>901202801345</b></span></td>
                                                {{-- <td><img style="width: 70px; height: 50px;" src="{{ asset('assets/dist/img/bri.png') }}" alt="Bank BRI"> <span>: 36472789462374274</span></td> --}}
                                            </tr>
                                        </table>
                                    </div>
                                    @if($pendaftaran -> status_bayar  == 'sudah')
                                        <p class="text-center m-3">{!! QrCode::size(100)->backgroundColor(255,255,255)->generate('https://bkk.smkmuhkandanghaur.sch.id/scan/'.$pendaftaran->code_pendaftaran) !!}</p>
                                    @elseif($pendaftaran -> status_bayar  == 'menunggu')
                                        <p class="text-center m-3">{!! QrCode::size(100)->backgroundColor(255,255,255)->generate('https://bkk.smkmuhkandanghaur.sch.id/scan/'.$pendaftaran->code_pendaftaran) !!}</p>
                                    @else
                                        <div class="col-12">
                                            <form action="/bukti_pembayaran" method="post" enctype="multipart/form-data">
                                                @csrf
                                                @method('put')
                                                <input type="hidden" name="id" value="{{ $pendaftaran->id }}">
                                                <label for="">Upload Bukti pembayaran :</label>
                                                <div class="input-group mb-3">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="bukti_transfer" required name="bukti_transfer">
                                                        <label class="custom-file-label" for="bukti_transfer" >Upload File</label>
                                                    </div>
                                                    <div class="input-group-append">
                                                        <button class="btn btn-primary" type="submit">Upload</button>
                                                    </div>
                                                </div>
                                            </form>
                                            <p class="text-center text-muted well well-sm shadow-none" style="margin-top: 10px;">
                                                Segera lakukan Pembayaran Sebelum loker di tutup atau sampai kuota terpenuhi
                                            </p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <footer class="main-footer">
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 2.1.0
            </div>
            <strong
            >Copyright &copy; 2024-2025
            <a href="https://bkk.smkmuhkandanghaur.sch.id">Nikko Adrian</a>.</strong
            >
            All rights reserved.
        </footer>
    </div>
    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <script>
    $(function () {
        bsCustomFileInput.init();
    });
    </script>
    </body>
    </html>
