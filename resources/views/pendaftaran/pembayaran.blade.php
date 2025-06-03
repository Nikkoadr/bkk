
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
