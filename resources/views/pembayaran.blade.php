
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
        <body class="hold-transition layout-top-nav layout-navbar-fixed">
        <div class="wrapper">
            <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
                <div class="container">
                    <a href="#" class="navbar-brand">
                        <img src="{{ asset('assets/dist/img/logoKotak.png') }}" alt="dosq" class="brand-image">
                        <span class="brand-text font-weight-bold"> BKK SMK Muhammadiyah Kandanghaur</span>
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
                <h4 class="m-0 text-center"><b>Pembayaran BKK</b></h4>
            </div>
            <div class="content">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-solid">
                                <div class="card-body pb-0">
                                    <div class="invoice p-3 mb-3">
                                        <!-- Title row -->
                                        <div class="row">
                                            <div class="col-12">
                                                <h4>
                                                    <img style="width: 50px; height: 50px;" src="{{ asset('assets/dist/img/BKK.png') }}" alt="bkk"> BKK SMK Muhammadiyah Kandanghaur
                                                    <small class="float-right">Date: {{ date('d/m/Y') }}</small>
                                                </h4>
                                            </div>
                                        </div>
                                        <!-- Info row -->

                                        <!-- Table row -->
                                        <div class="row">
                                            <div class="col-12 table-responsive">
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Data Pendaftar</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>Code registrasi</td>
                                                            <td><b>{{ $pendaftaran->code_pendaftaran }}</b></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Nama</td>
                                                            <td>{{ $pendaftaran->nama }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Nomor Whatsapp</td>
                                                            <td>{{ $pendaftaran->nomor_wa }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Asal Sekolah</td>
                                                            <td>{{ $pendaftaran->nama_sekolah }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Status Bayar</td>
                                                            <td><span class="badge bg-red">{{ $pendaftaran->status_bayar }}</span></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <!-- Payment row -->
                                        <div class="row">
                                            <div class="col-6">
                                                <p class="lead">Metode Pembayaran :</p>
                                                <img style="width: 50px; height: 50px;" src="https://upload.wikimedia.org/wikipedia/commons/7/72/Logo_dana_blue.svg" alt="Dana"> 
                                                <img  style="width: 50px; height: 50px;" src="https://upload.wikimedia.org/wikipedia/commons/e/eb/Logo_ovo_purple.svg" alt="OVO"> <span>: 08112390028</span>
                                                <img style="width: 70px; height: 50px;" src="{{ asset('assets/dist/img/bri.png') }}" alt="Bank BRI"> <span>: 36472789462374274</span>
                                                <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                                                    Segera lakukan Pembayaran Sebelum loker di tutup atau sampai kuota terpenuhi
                                                </p>
                                            </div>
                                            <div class="col-6">
                                                <p class="lead">Jumlah yang harus dibayarkan :</p>
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <tbody>
                                                            <tr>
                                                                <th style="width:50%">Biaya Administrasi</th>
                                                                <td>Rp. 35.000,-</td>
                                                            </tr>
                                                            <tr>
                                                                <th style="width:50%">Upload Bukti Pembayaran</th>
                                                                <td><form action="bukti_pembayaran" method="post">
                                                                    @csrf
                                                                    @method('patch')
                                                                    <input type="hidden" name="id" value="{{ $pendaftaran->id }}">
                                                                    <input type="file" name="bukti_transfer" id="">
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Print row -->
                                        <div class="row no-print">
                                            <div class="col-12">
                                                {{-- <a href="invoice-print.html" rel="noopener" target="_blank" class="btn btn-default">
                                                    <i class="fas fa-print"></i> Print
                                                </a> --}}
                                                <button type="submit" class="btn btn-success float-right">
                                                    <i class="far fa-credit-card"></i> Bayar
                                                </button>
                                            </div>
                                        </div>
                                    </div>
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
            <div class="float-right d-none d-sm-inline">Anything you want</div>
            <strong
            >Copyright &copy; 2024-2025
            <a href="https://bkk.smkmuhkandanghaur.sch.id">BKK SMK Muhammadiyah Kandanghaur</a>.</strong
            >
            All rights reserved.
        </footer>
    </div>
    {{-- <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key={{ config('midtrans.clinet_key') }}></script>
    <script type="text/javascript">
    document.getElementById('pay-button').onclick = function(){
    window.snap.pay('{{ $snapToken }}', {
        onSuccess: function(result){
            window.location.href = '/bukti_pembayaran/{{$pendaftaran->id}}'
            console.log(result);
        },
        onPending: function(result){
            alert("wating your payment!");
            console.log(result);
        },
        onError: function(result){
            alert("payment failed!");
                console.log(result);
        },
        onClose: function () {
                    alert('you closed the popup without finishing the payment');
                }
    });
    };
    </script> --}}
    </body>
    </html>
