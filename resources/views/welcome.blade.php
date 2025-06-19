<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>BKK SMK Muhammadiyah Kandanghaur</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"/>
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free-6.5.2-web/css/all.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css') }}"/>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/dist/img/logoKotak.png') }}">
</head>
<body class="hold-transition layout-top-nav layout-navbar-fixed">
<div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
        <div class="container">
            <a href="/" class="navbar-brand">
                <img src="{{ asset('assets/dist/img/logobkk.png') }}" alt="Logo BKK" class="brand-image">
            </a>
            <ul class="navbar-nav ms-auto">
                @if (Route::has('login'))
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home') }}">{{ __('Home') }}</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">Register</a>
                            </li>
                        @endif
                    @endauth
                @endif
            </ul>
        </div>
    </nav>

    <!-- Content Wrapper -->
    <div class="content-wrapper">
        <div class="content-header">
            <h5 class="m-0 text-center"><b>LOWONGAN PEKERJAAN</b></h5>
        </div>

        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        @if (session('notif'))
                            <div class="alert alert-info">{{ session('notif') }}</div>
                        @endif
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif

                        <div class="card card-solid">
                            @php
                                $loker_aktif = $loker->where('status_loker', 'aktif');
                            @endphp

                            @if($loker_aktif->isEmpty())
                                        <h3 class="text-center m-2"><b><i>LOWONGAN KERJA BELUM TERSEDIA</i></b></h3>
                            @else
                                <div class="card-body pb-0">
                                    <div class="row">
                                        @foreach ($loker_aktif as $data)
                                            <div class="col-md-6 d-flex align-items-stretch flex-column">
                                                <div class="card bg-light d-flex flex-fill">
                                                    <div class="card-header text-muted border-bottom-0">
                                                        Nama Perusahaan
                                                    </div>
                                                    <div class="card-body pt-0">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <h5><b>{{ $data->nama_loker }}</b></h5>
                                                                <p>Posisi: {{ $data->posisi }}</p>
                                                            </div>
                                                            <div class="col-6">
                                                                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/95/Instagram_logo_2022.svg/600px-Instagram_logo_2022.svg.png" width="20" height="20" alt="Instagram">
                                                                <a target="_blank" href="https://www.instagram.com/bkk.smkmuhkandanghaur/">Instagram BKK</a><br>
                                                                <img src="https://upload.wikimedia.org/wikipedia/commons/b/b9/2023_Facebook_icon.svg" width="20" height="20" alt="Facebook">
                                                                <a target="_blank" href="https://whatsapp.com/channel/0029VaxngoMA89MrPXjbFq1n">Saluran WhatsApp BKK</a><br>
                                                            </div>
                                                            <div class="col-6">
                                                                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/8/83/Telegram_2019_Logo.svg/1024px-Telegram_2019_Logo.svg.png" width="20" height="20" alt="Telegram">
                                                                <a target="_blank" href="https://t.me/grupinfoloker28">Telegram Grup</a><br>
                                                                <img src="https://play-lh.googleusercontent.com/bYtqbOcTYOlgc6gqZ2rwb8lptHuwlNE75zYJu6Bn076-hTmvd96HH-6v7S0YUAAJXoJN" width="20" height="20" alt="WhatsApp">
                                                                <a target="_blank" href="https://wa.me/628112390028">WhatsApp</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer">
                                                        <div class="row">
                                                            <div class="col-7 d-flex align-items-center">
                                                                <p class="mb-0">Bergerak Maju Menjadi Yang Terdepan</p>
                                                            </div>
                                                            <div class="col-5 text-right">
                                                                <form action="form_daftar" method="POST">
                                                                    @csrf
                                                                    <input type="hidden" name="id_loker" value="{{ $data->id_loker }}">
                                                                    <button class="btn btn-primary" type="submit">
                                                                        <i class="fas fa-user"></i> Daftar
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Form Cari Kode Pendaftaran -->
                    <div class="col-12 mt-4">
                        <form action="/cari" method="POST">
                            @csrf
                            <div class="input-group mb-3">
                                <input type="text" name="code_pendaftaran" class="form-control" placeholder="Masukkan kode pendaftaran di sini">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit">Cari</button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
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
</body>
</html>
