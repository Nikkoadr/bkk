
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>BKK SMK Muhammadiyah Kandanghaur</title>
        <link
        rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"/>
        <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free-6.5.2-web/css/all.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css') }}" />
        <link rel="icon" type="image/x-icon" href="{{ asset('assets/dist/img/logoKotak.png') }}">
    </head>
        <body class="hold-transition layout-top-nav layout-navbar-fixed" style="font-family:'Times New Roman', Times, serif">
        <div class="wrapper">
            <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
                <div class="container">
                    <a href="#" class="navbar-brand">
                        <img src="{{ asset('assets/dist/img/logoKotak.png') }}" alt="dosq" class="brand-image">
                        <span class="brand-text font-weight-bold">Smkmuhkandanghaur</span>
                    </a>
                    <ul class="navbar-nav ms-auto">
                        @if (Route::has('login'))
                            <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                                @auth
                                    <a class="nav-link" href="{{ route('home') }}">{{ __('Home') }}</a>
                                @else
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                                    @endif
                                @endauth
                            </div>
                        @endif
                    </ul>
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
                                        <b>Bukti Pendaftaran</b>
                                    </h3>
                                    <h5 class="text-center">BKK SMK Muhammadiyah Kandanghaur</h5>
                                    <hr>
                                    <p class="text-center"><b>Code Registrasi: {{ $pendaftaran -> code_pendaftaran }}</b></p>

                                    <p class="mt-3 mb-5 text-center">dokument ini menyatakan bahwa :</p>
                                    <table class="table">
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
                                            <td><b>Nama Sekolah</b></td>
                                            <td><b>:</b></td>
                                            <td><b>{{ $pendaftaran -> nama_sekolah }}</b></td>
                                        </tr>
                                        <tr>
                                            <td><b>Status Pembayaran</b></td>
                                            <td><b>:</b></td>
                                            <td>
                                            @if( $pendaftaran -> status_bayar  == 'sudah')
                                                <span class="badge bg-green">{{ $pendaftaran -> status_bayar }}</span>
                                            @else
                                                <span class="badge bg-yellow">{{ $pendaftaran -> status_bayar }}</span>
                                            @endif</td>
                                        </tr>
                                    </table>
                                    <p class="mt-4 mb-3 text-center">Telah mendaftar sebagai calon pelamar pada :</p>
                                    <p class="text-center"><b>Perusahaan: {{ $pendaftaran-> nama_loker }}</b></p>
                                    <p class="text-center"><b>Pada tanggal : {{ Carbon\Carbon::parse($pendaftaran->pendaftaran_created_at)->setTimezone('Asia/Jakarta')->translatedFormat('d F Y, H:i') }}</b></p>
                                    <p class="text-center">Simpan bukti pendaftaran ini. Sebagai syarat mengikuti proses recruitment perusahaan.</p>
                                    <p class="text-center m-3">{!! QrCode::size(100)->backgroundColor(255,255,255)->generate('https://bkk.smkmuhkandanghaur.sch.id/cari/'.$pendaftaran->code_pendaftaran) !!}</p>
                                        <form action="print_bukti_transfer" method="post">
                                            @csrf
                                            <input type="hidden" name="code_pendaftaran" value="{{ $pendaftaran -> code_pendaftaran }}">
                                            <div class="text-center m-2">
                                                <button class="btn btn-primary" type="submit">Print</button>
                                            </div>
                                        </form>
                                            @php
                                                $grupWaLink = $pendaftaran->grup_wa;
                                                if (!preg_match("~^(?:f|ht)tps?://~i", $grupWaLink)) {
                                                    $grupWaLink = $grupWaLink;
                                                }
                                            @endphp
                                    <p class="text-center"><a class="btn btn-success" href="{{ $grupWaLink }}" target="_blank">Join Grup Whatsapp</a></p>
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <footer class="main-footer">
            <div class="float-right d-none d-sm-inline">version 2.0</div>
            <strong
            >Copyright &copy; 2024-2025
            <a href="https://bkk.smkmuhkandanghaur.sch.id">Nikko Adrian</a>.</strong
            >
            All rights reserved.
        </footer>
    </div>
    </body>
    </html>
