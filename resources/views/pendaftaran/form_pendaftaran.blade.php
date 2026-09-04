<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>BKK SMK Muhammadiyah Kandanghaur</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback" />
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css') }}" />
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/dist/img/logoKotak.png') }}" />
    <style>
        /* ===== CSS UNTUK NUMBERING DI DESKRIPSI ===== */
        .desc-wrapper ul {
            list-style: none;
            counter-reset: item;
            padding-left: 0;
            margin: 4px 0 8px 0;
        }
        .desc-wrapper ul li {
            counter-increment: item;
            padding-left: 1.8rem;
            position: relative;
            margin-bottom: 2px;
        }
        .desc-wrapper ul li::before {
            content: counter(item) ".";
            position: absolute;
            left: 0;
            font-weight: 700;
            color: #0a4b8a;
        }
        /* Sub-list pakai huruf */
        .desc-wrapper ul ul {
            list-style: none;
            counter-reset: subitem;
            padding-left: 1.5rem;
            margin: 2px 0;
        }
        .desc-wrapper ul ul li {
            counter-increment: subitem;
            padding-left: 1.8rem;
            position: relative;
        }
        .desc-wrapper ul ul li::before {
            content: counter(item) "." counter(subitem);
            position: absolute;
            left: 0;
            font-weight: 600;
            color: #1a5f8a;
        }
        .desc-wrapper h6 {
            font-weight: 700;
            color: #0a4b8a;
            margin: 8px 0 4px 0;
        }
        .desc-wrapper strong {
            font-weight: 700;
            color: #0a4b8a;
        }
        .desc-wrapper p {
            margin: 4px 0;
        }
        /* Card info loker lebih rapi */
        .card-info-loker .card-body {
            padding: 20px 25px;
        }
        .card-info-loker .card-header {
            background: linear-gradient(135deg, #0a4b8a, #2b8cdf) !important;
            color: white !important;
        }
        .card-info-loker .card-header h5 {
            color: white !important;
        }
        .card-form .card-header {
            background: linear-gradient(135deg, #0a4b8a, #2b8cdf) !important;
            color: white !important;
        }
        .card-form .card-header h5 {
            color: white !important;
        }
        .btn-primary {
            background: #0b6bcb !important;
            border: none !important;
            transition: all 0.2s;
        }
        .btn-primary:hover {
            background: #1a7fdf !important;
            transform: scale(1.02);
        }
        .btn-secondary {
            background: #e8f0fe !important;
            color: #0a4b8a !important;
            border: none !important;
        }
        .btn-secondary:hover {
            background: #d4e4fc !important;
        }
        .brand-image {
            height: 50px;
            width: auto;
        }
        .main-footer {
            background: white;
            border-top: 1px solid #dcebfa;
        }
        .main-footer a {
            color: #0b6bcb;
        }
    </style>
</head>
<body class="hold-transition layout-top-nav layout-navbar-fixed">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand-md navbar-light navbar-white border-bottom border-light">
            <div class="container">
                <a href="/" class="navbar-brand">
                    <img src="{{ asset('assets/dist/img/logobkk.png') }}" alt="BKK Logo" class="brand-image">
                </a>
            </div>
        </nav>

        <!-- Content Wrapper -->
        <div class="content-wrapper" style="background: #f0f8ff;">
            <div class="content-header">
                <div class="container">
                    <div class="row mb-2">
                        <div class="col-12 text-center">
                            <h1 class="m-0 text-2xl font-bold" style="color: #0a4b8a;">Formulir Pendaftaran</h1>
                            <p style="color: #4a7fa8;">Lengkapi data diri Anda dengan benar</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="content">
                <div class="container">
                    <div class="row">
                        <!-- ====== INFO LOKER ====== -->
                        <div class="col-lg-5">
                            <div class="card card-info-loker shadow-sm">
                                <div class="card-header">
                                    <h5 class="card-title m-0"><i class="fas fa-briefcase mr-2"></i> Info Loker</h5>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label class="text-muted text-uppercase small font-weight-bold">Nama Perusahaan</label>
                                        <h4 class="font-weight-bold" style="color: #0a4b8a;">{{ $data->nama_loker }}</h4>
                                    </div>
                                    <div class="form-group">
                                        <label class="text-muted text-uppercase small font-weight-bold">Posisi</label>
                                        <h5 style="color: #1a5f8a;">{{ $data->posisi }}</h5>
                                    </div>
                                    <div class="form-group">
                                        <label class="text-muted text-uppercase small font-weight-bold">Kualifikasi</label>
                                        <div class="desc-wrapper">
                                            {!! $data->deskripsi !!}
                                        </div>
                                    </div>
                                    <div class="form-group pt-2 border-top">
                                        <label class="text-muted text-uppercase small font-weight-bold">Kode Pendaftaran</label>
                                        <div style="background: #e6f3ff; border-radius: 8px; padding: 10px 15px; border: 1px solid #b8d4f0;">
                                            <code id="code_pendaftaran" style="font-size: 1rem; font-weight: 700; color: #0a4b8a; display: block; text-align: center; letter-spacing: 1px; font-family: 'Courier New', monospace;"></code>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- ====== FORM PENDAFTARAN ====== -->
                        <div class="col-lg-7">
                            <div class="card card-form shadow-sm">
                                <div class="card-header">
                                    <h5 class="card-title m-0"><i class="fas fa-edit mr-2"></i> Form Pendaftaran</h5>
                                    <span class="float-right text-white-50 small">* wajib diisi</span>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('bayar') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="id_loker" value="{{ $data->id_loker }}">
                                        <input type="hidden" id="code_pendaftaran_input" name="code_pendaftaran" value="">

                                        <div class="row">
                                            <!-- Email -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="email">Email <span style="color: red;">*</span></label>
                                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="example@gmail.com" required>
                                                    @error('email')
                                                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <!-- Nomor WA -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="nomor_wa">Nomor WhatsApp <span style="color: red;">*</span></label>
                                                    <input type="number" class="form-control @error('nomor_wa') is-invalid @enderror" id="nomor_wa" name="nomor_wa" placeholder="081222222222" required>
                                                    @error('nomor_wa')
                                                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <!-- Nama Lengkap -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="nama">Nama Lengkap <span style="color: red;">*</span></label>
                                                    <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" placeholder="Nama Lengkap" required oninput="this.value = this.value.toUpperCase()">
                                                    @error('nama')
                                                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <!-- NIK -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="nomor_nik">Nomor NIK <span style="color: red;">*</span></label>
                                                    <input type="number" class="form-control @error('nomor_nik') is-invalid @enderror" id="nomor_nik" name="nomor_nik" placeholder="Nomor NIK" required>
                                                    @error('nomor_nik')
                                                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <!-- NPWP (conditional) -->
                                            @if($data->form_npwp == 'aktif')
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="npwp">NPWP</label>
                                                    <input type="text" class="form-control @error('npwp') is-invalid @enderror" id="npwp" name="npwp" placeholder="NPWP" oninput="this.value = this.value.toUpperCase()">
                                                    @error('npwp')
                                                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                                    @enderror
                                                </div>
                                            </div>
                                            @endif
                                            <!-- SIM -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="sim">SIM</label>
                                                    <select class="form-control @error('sim') is-invalid @enderror" name="sim" id="sim">
                                                        <option value="">Tidak Ada</option>
                                                        <option value="D">D</option>
                                                        <option value="C">C</option>
                                                        <option value="C1">C1</option>
                                                        <option value="C2">C2</option>
                                                        <option value="C3">C3</option>
                                                        <option value="A">A</option>
                                                        <option value="A UMUM">A UMUM</option>
                                                        <option value="B1">B1</option>
                                                        <option value="B2">B2</option>
                                                        <option value="B1 UMUM">B1 UMUM</option>
                                                        <option value="B2 UMUM">B2 UMUM</option>
                                                    </select>
                                                    @error('sim')
                                                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <!-- Tempat Lahir -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="tempat_lahir">Tempat Lahir <span style="color: red;">*</span></label>
                                                    <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror" id="tempat_lahir" name="tempat_lahir" placeholder="Tempat Lahir" oninput="this.value = this.value.toUpperCase()" required>
                                                    @error('tempat_lahir')
                                                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <!-- Tanggal Lahir -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="tanggal_lahir">Tanggal Lahir <span style="color: red;">*</span></label>
                                                    <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" id="tanggal_lahir" name="tanggal_lahir" required>
                                                    @error('tanggal_lahir')
                                                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <!-- Jenis Kelamin -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="jenis_kelamin">Jenis Kelamin <span style="color: red;">*</span></label>
                                                    <select class="form-control @error('jenis_kelamin') is-invalid @enderror" id="jenis_kelamin" name="jenis_kelamin" required>
                                                        <option value="L">Laki-Laki</option>
                                                        <option value="P">Perempuan</option>
                                                    </select>
                                                    @error('jenis_kelamin')
                                                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <!-- Status Perkawinan -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="status_perkawinan">Status Perkawinan <span style="color: red;">*</span></label>
                                                    <select class="form-control @error('status_perkawinan') is-invalid @enderror" id="status_perkawinan" name="status_perkawinan" required>
                                                        <option value="BELUM MENIKAH">BELUM MENIKAH</option>
                                                        <option value="MENIKAH">MENIKAH</option>
                                                    </select>
                                                    @error('status_perkawinan')
                                                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <!-- Jenis Pendidikan Terakhir -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="jenis_pendidikan_terakhir">Pendidikan Terakhir <span style="color: red;">*</span></label>
                                                    <select class="form-control @error('jenis_pendidikan_terakhir') is-invalid @enderror" id="jenis_pendidikan_terakhir" name="jenis_pendidikan_terakhir" required>
                                                        <option value="MA">MA</option>
                                                        <option value="MAK">MAK</option>
                                                        <option value="SMA">SMA</option>
                                                        <option value="SMK">SMK</option>
                                                        <option value="D1">D1</option>
                                                        <option value="D2">D2</option>
                                                        <option value="D3">D3</option>
                                                        <option value="S1">S1</option>
                                                        <option value="S2">S2</option>
                                                        <option value="S3">S3</option>
                                                    </select>
                                                    @error('jenis_pendidikan_terakhir')
                                                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <!-- NPSN (conditional) -->
                                            @if($data->form_npsn == 'aktif')
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="npsn">NPSN</label>
                                                    <input type="number" class="form-control @error('npsn') is-invalid @enderror" id="npsn" name="npsn" placeholder="NPSN">
                                                    @error('npsn')
                                                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                                    @enderror
                                                </div>
                                            </div>
                                            @endif
                                            <!-- Nama Sekolah -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="nama_sekolah">Nama Sekolah</label>
                                                    <input type="text" class="form-control @error('nama_sekolah') is-invalid @enderror" id="nama_sekolah" name="nama_sekolah" placeholder="Nama Sekolah" oninput="this.value = this.value.toUpperCase()">
                                                    @error('nama_sekolah')
                                                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <!-- Jurusan Pendidikan -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="jurusan_pendidikan">Jurusan Pendidikan</label>
                                                    <input type="text" class="form-control @error('jurusan_pendidikan') is-invalid @enderror" id="jurusan_pendidikan" name="jurusan_pendidikan" placeholder="Jurusan Pendidikan" oninput="this.value = this.value.toUpperCase()">
                                                    @error('jurusan_pendidikan')
                                                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <!-- Kota Asal Sekolah -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="kota_asal_sekolah">Kota Asal Sekolah</label>
                                                    <input type="text" class="form-control @error('kota_asal_sekolah') is-invalid @enderror" id="kota_asal_sekolah" name="kota_asal_sekolah" placeholder="Kota Asal Sekolah" oninput="this.value = this.value.toUpperCase()">
                                                    @error('kota_asal_sekolah')
                                                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <!-- Tahun Lulus -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="tahun_lulus">Tahun Lulus</label>
                                                    <input type="number" class="form-control @error('tahun_lulus') is-invalid @enderror" id="tahun_lulus" name="tahun_lulus" placeholder="Tahun Lulus">
                                                    @error('tahun_lulus')
                                                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <!-- Nilai Rata-rata Ijazah (conditional) -->
                                            @if($data->form_nilai_ijazah == 'aktif')
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="nilai_rata_rata_ijazah">Nilai Rata-Rata Ijazah</label>
                                                    <input type="text" class="form-control @error('nilai_rata_rata_ijazah') is-invalid @enderror" id="nilai_rata_rata_ijazah" name="nilai_rata_rata_ijazah" placeholder="Nilai Rata-Rata Ijazah">
                                                    @error('nilai_rata_rata_ijazah')
                                                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                                    @enderror
                                                </div>
                                            </div>
                                            @endif
                                            <!-- Nilai Matematika (conditional) -->
                                            @if($data->form_nilai_matematika == 'aktif')
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="nilai_rata_rata_matematika">Nilai Rata-Rata Matematika</label>
                                                    <input type="text" class="form-control @error('nilai_rata_rata_matematika') is-invalid @enderror" id="nilai_rata_rata_matematika" name="nilai_rata_rata_matematika" placeholder="Nilai Rata-Rata Matematika">
                                                    @error('nilai_rata_rata_matematika')
                                                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                                    @enderror
                                                </div>
                                            </div>
                                            @endif
                                        </div>

                                        <!-- ALAMAT -->
                                        <div class="row mt-3">
                                            <div class="col-12">
                                                <h6 class="font-weight-bold" style="color: #0a4b8a;"><i class="fas fa-map-pin mr-1"></i> Alamat Lengkap</h6>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="blok">Blok</label>
                                                    <input type="text" class="form-control @error('blok') is-invalid @enderror" id="blok" name="blok" placeholder="Blok" oninput="this.value = this.value.toUpperCase()">
                                                    @error('blok')
                                                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="rt">RT</label>
                                                    <input type="number" class="form-control @error('rt') is-invalid @enderror" id="rt" name="rt" placeholder="RT">
                                                    @error('rt')
                                                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="rw">RW</label>
                                                    <input type="number" class="form-control @error('rw') is-invalid @enderror" id="rw" name="rw" placeholder="RW">
                                                    @error('rw')
                                                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="desa">Desa</label>
                                                    <input type="text" class="form-control @error('desa') is-invalid @enderror" id="desa" name="desa" placeholder="Desa" oninput="this.value = this.value.toUpperCase()">
                                                    @error('desa')
                                                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="kecamatan">Kecamatan</label>
                                                    <input type="text" class="form-control @error('kecamatan') is-invalid @enderror" id="kecamatan" name="kecamatan" placeholder="Kecamatan" oninput="this.value = this.value.toUpperCase()">
                                                    @error('kecamatan')
                                                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="kabupaten">Kabupaten</label>
                                                    <input type="text" class="form-control @error('kabupaten') is-invalid @enderror" id="kabupaten" name="kabupaten" placeholder="Kabupaten" oninput="this.value = this.value.toUpperCase()">
                                                    @error('kabupaten')
                                                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="kode_pos">Kode Pos</label>
                                                    <input type="text" class="form-control @error('kode_pos') is-invalid @enderror" id="kode_pos" name="kode_pos" placeholder="Kode Pos">
                                                    @error('kode_pos')
                                                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                                    @enderror
                                                </div>
                                            </div>
                                            @if($data->form_domisili == 'aktif')
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="domisili">Domisili</label>
                                                    <input type="text" class="form-control @error('domisili') is-invalid @enderror" id="domisili" name="domisili" placeholder="Domisili" oninput="this.value = this.value.toUpperCase()">
                                                    @error('domisili')
                                                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                                    @enderror
                                                </div>
                                            </div>
                                            @endif
                                        </div>

                                        <!-- DATA FISIK & PENGALAMAN -->
                                        <div class="row mt-3">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="tinggi_badan">Tinggi Badan (cm)</label>
                                                    <input type="number" class="form-control @error('tinggi_badan') is-invalid @enderror" id="tinggi_badan" name="tinggi_badan" placeholder="170">
                                                    @error('tinggi_badan')
                                                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="berat_badan">Berat Badan (kg)</label>
                                                    <input type="number" class="form-control @error('berat_badan') is-invalid @enderror" id="berat_badan" name="berat_badan" placeholder="65">
                                                    @error('berat_badan')
                                                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="posisi_yang_dilamar">Posisi yang Dilamar</label>
                                                    <input type="text" class="form-control @error('posisi_yang_dilamar') is-invalid @enderror" id="posisi_yang_dilamar" name="posisi_yang_dilamar" placeholder="Posisi" oninput="this.value = this.value.toUpperCase()">
                                                    @error('posisi_yang_dilamar')
                                                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="pengalaman_kerja">Pengalaman Kerja (bukan PKL)</label>
                                                    <input type="text" class="form-control @error('pengalaman_kerja') is-invalid @enderror" id="pengalaman_kerja" name="pengalaman_kerja" placeholder="Pengalaman" oninput="this.value = this.value.toUpperCase()">
                                                    @error('pengalaman_kerja')
                                                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <!-- RECRUITMENT & BEKERJA (conditional) -->
                                        <div class="row mt-2">
                                            @if($data->form_pernah_mengikuti_reqrutment_calon_karyawan == 'aktif')
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="pernah_mengikuti_reqrutment_calon_karyawan">Pernah Ikut Recruitment {{ $data->nama_loker }}</label>
                                                    <select class="form-control @error('pernah_mengikuti_reqrutment_calon_karyawan') is-invalid @enderror" id="pernah_mengikuti_reqrutment_calon_karyawan" name="pernah_mengikuti_reqrutment_calon_karyawan">
                                                        <option value="BELUM PERNAH">BELUM PERNAH</option>
                                                        <option value="SUDAH PERNAH">SUDAH PERNAH</option>
                                                    </select>
                                                    @error('pernah_mengikuti_reqrutment_calon_karyawan')
                                                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                                    @enderror
                                                </div>
                                            </div>
                                            @endif
                                            @if($data->form_pernah_bekerja == 'aktif')
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="pernah_bekerja">Pernah Bekerja di {{ $data->nama_loker }}</label>
                                                    <select class="form-control @error('pernah_bekerja') is-invalid @enderror" id="pernah_bekerja" name="pernah_bekerja">
                                                        <option value="BELUM PERNAH">BELUM PERNAH</option>
                                                        <option value="SUDAH PERNAH">SUDAH PERNAH</option>
                                                    </select>
                                                    @error('pernah_bekerja')
                                                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                                    @enderror
                                                </div>
                                            </div>
                                            @endif
                                        </div>

                                        <!-- SOURCE & KOORDINATOR (readonly) -->
                                        <div class="row mt-2">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="source">Sumber Informasi</label>
                                                    <input readonly type="text" class="form-control" id="source" name="source" value="BKK SMK MUHAMMADIYAH KANDANGHAUR">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="nama_kordinator">Nama Koordinator</label>
                                                    <input readonly type="text" class="form-control" id="nama_kordinator" value="Adi Safrudin" name="nama_kordinator">
                                                </div>
                                            </div>
                                        </div>

                                        <!-- VAKSIN (conditional) -->
                                        @if($data->form_vaksin == 'aktif')
                                        <div class="row mt-3">
                                            <div class="col-12">
                                                <h6 class="font-weight-bold" style="color: #0a4b8a;"><i class="fas fa-syringe mr-1"></i> Data Vaksinasi</h6>
                                            </div>
                                            <!-- Vaksin 1 -->
                                            <div class="col-md-4">
                                                <div class="card p-2 border">
                                                    <label class="font-weight-bold" style="color: #0a4b8a;">Vaksin 1</label>
                                                    <select class="form-control @error('vaksin_1') is-invalid @enderror" name="vaksin_1">
                                                        <option value="">Pilih status</option>
                                                        <option value="sudah">Sudah</option>
                                                        <option value="belum">Belum</option>
                                                    </select>
                                                    <select class="form-control mt-2 @error('jenis_vaksin_1') is-invalid @enderror" name="jenis_vaksin_1">
                                                        <option value="">Jenis Vaksin</option>
                                                        <option value="SINOVAC">SINOVAC</option>
                                                        <option value="ASTRAZENECA">ASTRAZENECA</option>
                                                        <option value="SINOPHARM">SINOPHARM</option>
                                                        <option value="MODERNA">MODERNA</option>
                                                        <option value="PFIZER">PFIZER</option>
                                                    </select>
                                                    <input type="date" class="form-control mt-2 @error('tanggal_vaksin_1') is-invalid @enderror" name="tanggal_vaksin_1">
                                                    <input type="text" class="form-control mt-2 @error('lokasi_vaksin_1') is-invalid @enderror" name="lokasi_vaksin_1" placeholder="Lokasi" oninput="this.value = this.value.toUpperCase()">
                                                </div>
                                            </div>
                                            <!-- Vaksin 2 -->
                                            <div class="col-md-4">
                                                <div class="card p-2 border">
                                                    <label class="font-weight-bold" style="color: #0a4b8a;">Vaksin 2</label>
                                                    <select class="form-control @error('vaksin_2') is-invalid @enderror" name="vaksin_2">
                                                        <option value="">Pilih status</option>
                                                        <option value="sudah">Sudah</option>
                                                        <option value="belum">Belum</option>
                                                    </select>
                                                    <select class="form-control mt-2 @error('jenis_vaksin_2') is-invalid @enderror" name="jenis_vaksin_2">
                                                        <option value="">Jenis Vaksin</option>
                                                        <option value="SINOVAC">SINOVAC</option>
                                                        <option value="ASTRAZENECA">ASTRAZENECA</option>
                                                        <option value="SINOPHARM">SINOPHARM</option>
                                                        <option value="MODERNA">MODERNA</option>
                                                        <option value="PFIZER">PFIZER</option>
                                                    </select>
                                                    <input type="date" class="form-control mt-2 @error('tanggal_vaksin_2') is-invalid @enderror" name="tanggal_vaksin_2">
                                                    <input type="text" class="form-control mt-2 @error('lokasi_vaksin_2') is-invalid @enderror" name="lokasi_vaksin_2" placeholder="Lokasi" oninput="this.value = this.value.toUpperCase()">
                                                </div>
                                            </div>
                                            <!-- Vaksin 3 -->
                                            <div class="col-md-4">
                                                <div class="card p-2 border">
                                                    <label class="font-weight-bold" style="color: #0a4b8a;">Vaksin 3 (Booster)</label>
                                                    <select class="form-control @error('vaksin_3') is-invalid @enderror" name="vaksin_3">
                                                        <option value="">Pilih status</option>
                                                        <option value="sudah">Sudah</option>
                                                        <option value="belum">Belum</option>
                                                    </select>
                                                    <select class="form-control mt-2 @error('jenis_vaksin_3') is-invalid @enderror" name="jenis_vaksin_3">
                                                        <option value="">Jenis Vaksin</option>
                                                        <option value="SINOVAC">SINOVAC</option>
                                                        <option value="ASTRAZENECA">ASTRAZENECA</option>
                                                        <option value="SINOPHARM">SINOPHARM</option>
                                                        <option value="MODERNA">MODERNA</option>
                                                        <option value="PFIZER">PFIZER</option>
                                                    </select>
                                                    <input type="date" class="form-control mt-2 @error('tanggal_vaksin_3') is-invalid @enderror" name="tanggal_vaksin_3">
                                                    <input type="text" class="form-control mt-2 @error('lokasi_vaksin_3') is-invalid @enderror" name="lokasi_vaksin_3" placeholder="Lokasi" oninput="this.value = this.value.toUpperCase()">
                                                </div>
                                            </div>
                                        </div>
                                        @endif

                                        <!-- TOMBOL -->
                                        <div class="row mt-4">
                                            <div class="col-12">
                                                <a class="btn btn-secondary" href="/"><i class="fas fa-arrow-left"></i> Kembali</a>
                                                <button type="submit" class="btn btn-primary float-right"><i class="fas fa-paper-plane"></i> Daftar</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
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
            <strong>Copyright &copy; 2024-2025 <a href="https://bkk.smkmuhkandanghaur.sch.id">Nikko Adrian</a>.</strong>
            All rights reserved.
        </footer>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function generateUniqueCode() {
                let date = new Date();
                let loker = {{ $data->id_loker }};
                let year = date.getFullYear().toString().slice(-2);
                let month = ('0' + (date.getMonth() + 1)).slice(-2);
                let day = ('0' + date.getDate()).slice(-2);
                let hours = ('0' + date.getHours()).slice(-2);
                let minutes = ('0' + date.getMinutes()).slice(-2);
                let seconds = ('0' + date.getSeconds()).slice(-2);
                let randomNumber = Math.floor(Math.random() * 1000).toString().padStart(3, '0');
                return loker + '-' + day + '-' + month + '-' + year + '-' + hours + minutes + seconds + '-' + randomNumber;
            }

            let code = generateUniqueCode();
            document.getElementById('code_pendaftaran').textContent = code;
            document.getElementById('code_pendaftaran_input').value = code;
        });
    </script>
</body>
</html>