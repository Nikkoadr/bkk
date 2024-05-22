    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>BKK SMK Muhammadiyah Kandanghaur</title>
        <link
        rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"/>
        <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css') }}" />
        <link rel="icon" type="image/x-icon" href="{{ asset('assets/dist/img/logoKotak.png') }}">
    </head>
        <body class="hold-transition layout-top-nav layout-navbar-fixed">
        <div class="wrapper">
            <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
                <div class="container">
                    <a href="#" class="navbar-brand">
                        <img src="{{ asset('assets/dist/img/logoKotak.png') }}" alt="dosq" class="brand-image img-circle elevation-1" style="opacity: .8">
                        <span class="brand-text font-weight-bold"> BKK SMK Muhammadiyah Kandanghaur</span>
                    </a>
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">Masuk</a>
                                </li>
                            @endif
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </nav>
            <div class="content-wrapper">
                <div class="content-header">
                    <div class="container">
                        <div class="row mb-2">
                            <div class="col-sm-12">
                                <h1 class="m-0 text-center">Nama Loker : <b>PT. Astra Honda Motor Tbk</b></h1>
                            </div>
                        </div>
                    </div>
                </div>
            <div class="content">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-header bg-info">
                                    <h5 class="card-title m-0 text-bold">Info Loker</h5>
                                </div>
                                <div class="card-body">
                                    <h5>test123</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-header bg-primary">
                                    <h5 class="card-title m-0 text-bold">Form Pendaftaran</h5>
                                </div>
                                <div class="card-body">
                                    <form action="/daftar" method="post">
                                        @csrf
                                        <div class="card-body pt-0">
                                            <div class="form-group">
                                                <label for="nama">Nama Lengkap</label>
                                                <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="nomor_wa">Nomor Whatsapp</label>
                                                <input type="number" class="form-control" id="nomor_wa" name="nomor_wa" placeholder="081222222222" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Email Aktif</label>
                                                <input type="email" class="form-control" id="email" name="email" placeholder="merudipantara02@gmail.com" required>
                                            </div>
                                            <button type="submit" class="btn btn-primary float-right">Daftar</button>
                                        </div>
                                    </form>
                                </div>
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
    </body>
    </html>
