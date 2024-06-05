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
                        <img src="{{ asset('assets/dist/img/BKK.png') }}" alt="dosq" class="brand-image">
                        <span class="brand-text font-weight-bold"> BKK</span>
                        <span class="brand-text font-weight-bold"> Smkmuhkandanghaur</span>
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
                <h4 class="m-0 text-center"><b>LOWONGAN PEKERJAAN</b></h4>
            </div>
            <div class="content">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            @if (session('notif'))
                                <div class="alert alert-info">
                                    {{ session('notif') }}
                                </div>
                            @endif
                            <div class="card card-solid">
                            @php
                                $loker_aktif = $loker->filter(function ($data) {
                                    return $data->status_loker == 'aktif';
                                });
                            @endphp
                            @if($loker_aktif->isEmpty())
                            <H1 class="text-center">Tidak Ada Loker Yang Dibuka</H1>
                            @else
                                <div class="card-body pb-0">
                                    <div class="row">
                                            @foreach ($loker_aktif as $data)
                                                <div class="col-md-6 d-flex align-items-stretch flex-column">
                                                    <div class="card bg-light d-flex flex-fill">
                                                        <div class="card-header text-muted border-bottom-0">
                                                            Nama Loker
                                                        </div>
                                                        <div class="card-body pt-0">
                                                            <div class="row">
                                                                <div class="col-7">
                                                                    <h2 class="lead"><b>{{ $data->nama_loker }}</b></h2>
                                                                    <p class="text-muted text-sm"><b>Deskripsi: </b> {{ $data->deskripsi }}</p>
                                                                    <ul class="ml-4 mb-0 fa-ul text-muted">
                                                                        <li class="small"><span class="fa-li"><i class="fa-solid fa-users"></i></span> Jumlah Pendaftar : {{ $data->jumlah_pendaftar }}</li>
                                                                    </ul>
                                                                </div>
                                                                <div class="col-4 text-center">
                                                                    <img src="{{ asset('assets/dist/img/BKK.png') }}" alt="user-avatar" class="img-box img-fluid">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="card-footer">
                                                            <div class="text-right">
                                                                <form action="form_daftar" method="POST">
                                                                    @csrf
                                                                    <input type="hidden" name="id_loker" value="{{ $data->id_loker }}">
                                                                    <button class="btn btn-primary" type="submit"><i class="fas fa-user"></i> Daftar</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                                <!-- /.card-body -->
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
    </body>
    </html>
