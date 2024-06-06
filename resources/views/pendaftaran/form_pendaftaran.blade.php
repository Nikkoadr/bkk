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
                        <img src="{{ asset('assets/dist/img/BKK.png') }}" alt="dosq" class="brand-image">
                        <span class="brand-text font-weight-bold">Smkmuhkandanghaur</span>
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
                                    <h5>Nama Perusahaan : </h5>
                                    <h6><b>{{ $data->nama_loker }}</b></h6>
                                    <h5>Deskripsi :</h5>
                                    <h6><b>{{ $data->deskripsi }}</b></h6>
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
                                        <input type="hidden" name="id_loker" value="{{ $data->id_loker }}">
                                        <div class="card-body pt-0">
                                            <div class="form-group">
                                                <label for="code_pendaftaran">Code Pendaftaran</label>
                                                <input type="text" class="form-control @error('code_pendaftaran') is-invalid @enderror" id="code_pendaftaran" name="code_pendaftaran" value="" readonly required oninput="this.value = this.value.toUpperCase()">
                                                @error('code_pendaftaran')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="example@gmail.com" required>
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="nomor_wa">Nomor Whatsapp</label>
                                                <input type="number" class="form-control @error('nomor_wa') is-invalid @enderror" id="nomor_wa" name="nomor_wa" placeholder="081222222222" required>
                                                @error('nomor_wa')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="nama">Nama Lengkap</label>
                                                <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" placeholder="Nama" required oninput="this.value = this.value.toUpperCase()">
                                                @error('nama')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="nomor_nik">Nomor NIK</label>
                                                <input type="number" class="form-control @error('nomor_nik') is-invalid @enderror" id="nomor_nik" name="nomor_nik" placeholder="Nomor NIK" oninput="this.value = this.value.toUpperCase()">
                                                @error('nomor_nik')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="npwp">NPWP</label>
                                                <input type="text" class="form-control @error('npwp') is-invalid @enderror" id="npwp" name="npwp" placeholder="NPWP" oninput="this.value = this.value.toUpperCase()">
                                                @error('npwp')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="tempat_lahir">Tempat Lahir</label>
                                                <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror" id="tempat_lahir" name="tempat_lahir" placeholder="Tempat Lahir" oninput="this.value = this.value.toUpperCase()">
                                                @error('tempat_lahir')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="tanggal_lahir">Tanggal Lahir</label>
                                                <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" id="tanggal_lahir" name="tanggal_lahir">
                                                @error('tanggal_lahir')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="jenis_kelamin">Jenis Kelamin</label>
                                                <select class="form-control @error('jenis_kelamin') is-invalid @enderror" id="jenis_kelamin" name="jenis_kelamin" required>
                                                    <option value="L">Laki-Laki</option>
                                                    <option value="P">Perempuan</option>
                                                </select>
                                                @error('jenis_kelamin')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="status_perkawinan">Status Perkawinan</label>
                                                <select class="form-control @error('status_perkawinan') is-invalid @enderror" id="status_perkawinan" name="status_perkawinan" required>
                                                    <option value="BELUM MENIKAH">BELUM MENIKAH</option>
                                                    <option value="MENIKAH">MENIKAH</option>
                                                </select>
                                                @error('status_perkawinan')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="jenis_pendidikan_terakhir">Jenis Pendidikan Terakhir</label>
                                                <select class="form-control @error('jenis_pendidikan_terakhir') is-invalid @enderror" id="jenis_pendidikan_terakhir" name="jenis_pendidikan_terakhir" required>
                                                    <option value="MA">MA</option>
                                                    <option value="MAK">MAK</option>
                                                    <option value="SMA">SMA</option>
                                                    <option value="SMK">SMK</option>
                                                </select>
                                                @error('jenis_pendidikan_terakhir')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="npsn">NPSN</label>
                                                <input type="number" class="form-control @error('npsn') is-invalid @enderror" id="npsn" name="npsn" placeholder="NPSN" oninput="this.value = this.value.toUpperCase()">
                                                @error('npsn')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="nama_sekolah">Nama Sekolah</label>
                                                <input type="text" class="form-control @error('nama_sekolah') is-invalid @enderror" id="nama_sekolah" name="nama_sekolah" placeholder="Nama Sekolah" oninput="this.value = this.value.toUpperCase()">
                                                @error('nama_sekolah')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="jurusan_pendidikan">Jurusan Pendidikan</label>
                                                <input type="text" class="form-control @error('jurusan_pendidikan') is-invalid @enderror" id="jurusan_pendidikan" name="jurusan_pendidikan" placeholder="Jurusan Pendidikan" oninput="this.value = this.value.toUpperCase()">
                                                @error('jurusan_pendidikan')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="kota_asal_sekolah">Kota Asal Sekolah</label>
                                                <input type="text" class="form-control @error('kota_asal_sekolah') is-invalid @enderror" id="kota_asal_sekolah" name="kota_asal_sekolah" placeholder="Kota Asal Sekolah" oninput="this.value = this.value.toUpperCase()">
                                                @error('kota_asal_sekolah')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="tahun_lulus">Tahun Lulus</label>
                                                <input type="number" class="form-control @error('tahun_lulus') is-invalid @enderror" id="tahun_lulus" name="tahun_lulus" placeholder="Tahun Lulus" oninput="this.value = this.value.toUpperCase()">
                                                @error('tahun_lulus')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="nilai_rata_rata_ijazah">Nilai Rata-Rata Ijazah</label>
                                                <input type="text" class="form-control @error('nilai_rata_rata_ijazah') is-invalid @enderror" id="nilai_rata_rata_ijazah" name="nilai_rata_rata_ijazah" placeholder="Nilai Rata-Rata Ijazah" oninput="this.value = this.value.toUpperCase()">
                                                @error('nilai_rata_rata_ijazah')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="nilai_rata_rata_matematika">Nilai Rata-Rata Matematika</label>
                                                <input type="text" class="form-control @error('nilai_rata_rata_matematika') is-invalid @enderror" id="nilai_rata_rata_matematika" name="nilai_rata_rata_matematika" placeholder="Nilai Rata-Rata Matematika" oninput="this.value = this.value.toUpperCase()">
                                                @error('nilai_rata_rata_matematika')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="blok">Blok</label>
                                                <input type="text" class="form-control @error('blok') is-invalid @enderror" id="blok" name="blok" placeholder="Blok" oninput="this.value = this.value.toUpperCase()">
                                                @error('blok')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="rt">RT</label>
                                                <input type="number" class="form-control @error('rt') is-invalid @enderror" id="rt" name="rt" placeholder="RT" oninput="this.value = this.value.toUpperCase()">
                                                @error('rt')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="rw">RW</label>
                                                <input type="number" class="form-control @error('rw') is-invalid @enderror" id="rw" name="rw" placeholder="RW" oninput="this.value = this.value.toUpperCase()">
                                                @error('rw')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="desa">Desa</label>
                                                <input type="text" class="form-control @error('desa') is-invalid @enderror" id="desa" name="desa" placeholder="Desa" oninput="this.value = this.value.toUpperCase()">
                                                @error('desa')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="kecamatan">Kecamatan</label>
                                                <input type="text" class="form-control @error('kecamatan') is-invalid @enderror" id="kecamatan" name="kecamatan" placeholder="Kecamatan" oninput="this.value = this.value.toUpperCase()">
                                                @error('kecamatan')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="kabupaten">Kabupaten</label>
                                                <input type="text" class="form-control @error('kabupaten') is-invalid @enderror" id="kabupaten" name="kabupaten" placeholder="Kabupaten" oninput="this.value = this.value.toUpperCase()">
                                                @error('kabupaten')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="kode_pos">Kode Pos</label>
                                                <input type="text" class="form-control @error('kode_pos') is-invalid @enderror" id="kode_pos" name="kode_pos" placeholder="Kode Pos" oninput="this.value = this.value.toUpperCase()">
                                                @error('kode_pos')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="domisili">Domisili</label>
                                                <input type="text" class="form-control @error('domisili') is-invalid @enderror" id="domisili" name="domisili" placeholder="Domisili" oninput="this.value = this.value.toUpperCase()">
                                                @error('domisili')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="tinggi_badan">Tinggi Badan</label>
                                                <input type="number" class="form-control @error('tinggi_badan') is-invalid @enderror" id="tinggi_badan" name="tinggi_badan" placeholder="Tinggi Badan" oninput="this.value = this.value.toUpperCase()">
                                                @error('tinggi_badan')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="berat_badan">Berat Badan</label>
                                                <input type="number" class="form-control @error('berat_badan') is-invalid @enderror" id="berat_badan" name="berat_badan" placeholder="Berat Badan" oninput="this.value = this.value.toUpperCase()">
                                                @error('berat_badan')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="pengalaman_kerja">Pengalaman Kerja</label>
                                                <input type="text" class="form-control @error('pengalaman_kerja') is-invalid @enderror" id="pengalaman_kerja" name="pengalaman_kerja" placeholder="Pengalaman Kerja" oninput="this.value = this.value.toUpperCase()">
                                                @error('pengalaman_kerja')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="pernah_mengikuti_reqrutment_calon_karyawan">Pernah Mengikuti Recruitment Calon Karyawan</label>
                                                <select class="form-control @error('pernah_mengikuti_reqrutment_calon_karyawan') is-invalid @enderror" id="pernah_mengikuti_reqrutment_calon_karyawan" name="pernah_mengikuti_reqrutment_calon_karyawan">
                                                    <option value="BELUM PERNAH">BELUM PERNAH</option>
                                                    <option value="SUDAH PERNAH">SUDAH PERNAH</option>
                                                </select>
                                                @error('pernah_mengikuti_reqrutment_calon_karyawan')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="pernah_bekerja">Pernah Bekerja</label>
                                                <select class="form-control @error('pernah_bekerja') is-invalid @enderror" id="pernah_bekerja" name="pernah_bekerja">
                                                    <option value="BELUM PERNAH">BELUM PERNAH</option>
                                                    <option value="SUDAH PERNAH">SUDAH PERNAH</option>
                                                </select>
                                                @error('pernah_bekerja')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="source">Sumber Informasi</label>
                                                <input type="text" class="form-control @error('source') is-invalid @enderror" id="source" name="source" value="BKK SMK MUHAMMADIYAH KANDANGHAUR" placeholder="Sumber Informasi" oninput="this.value = this.value.toUpperCase()">
                                                @error('source')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="nama_kordinator">Nama Kordinator</label>
                                                <input type="text" class="form-control @error('nama_kordinator') is-invalid @enderror" id="nama_kordinator" value="ADI SAFRUDIN" name="nama_kordinator" placeholder="Nama Kordinator" oninput="this.value = this.value.toUpperCase()">
                                                @error('nama_kordinator')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="vaksin_1">Vaksin 1</label>
                                                <select class="form-control @error('vaksin_1') is-invalid @enderror" id="vaksin_1" name="vaksin_1">
                                                    <option value="sudah">Sudah</option>
                                                    <option value="belum">Belum</option>
                                                </select>
                                                @error('vaksin_1')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="jenis_vaksin_1">Jenis Vaksin 1</label>
                                                <select class="form-control @error('jenis_vaksin_1') is-invalid @enderror" id="jenis_vaksin_1" name="jenis_vaksin_1">
                                                    <option value="SINOVAC">SINOVAC</option>
                                                    <option value="VAKSIN COVID-19 BIO DARMA">VAKSIN COVID-19 BIO DARMA</option>
                                                    <option value="ASTRAZENECA">ASTRAZENECA</option>
                                                    <option value="SINOPHARM">SINOPHARM</option>
                                                    <option value="MODERNA">MODERNA</option>
                                                    <option value="PFIZER">PFIZER</option>
                                                    <option value="SPUTNIK V">SPUTNIK V</option>
                                                    <option value="INDOVAC">INDOVAC</option>
                                                    <option value="INAVAC">INAVAC</option>
                                                </select>
                                                @error('jenis_vaksin_1')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="tanggal_vaksin_1">Tanggal Vaksin 1</label>
                                                <input type="date" class="form-control @error('tanggal_vaksin_1') is-invalid @enderror" id="tanggal_vaksin_1" name="tanggal_vaksin_1">
                                                @error('tanggal_vaksin_1')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="lokasi_vaksin_1">Lokasi Vaksin 1</label>
                                                <input type="text" class="form-control @error('lokasi_vaksin_1') is-invalid @enderror" id="lokasi_vaksin_1" name="lokasi_vaksin_1" placeholder="Lokasi Vaksin 1" oninput="this.value = this.value.toUpperCase()">
                                                @error('lokasi_vaksin_1')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="vaksin_2">Vaksin 2</label>
                                                <select class="form-control @error('vaksin_2') is-invalid @enderror" id="vaksin_2" name="vaksin_2">
                                                    <option value="sudah">Sudah</option>
                                                    <option value="belum">Belum</option>
                                                </select>
                                                @error('vaksin_2')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="jenis_vaksin_2">Jenis Vaksin 2</label>
                                                <select class="form-control @error('jenis_vaksin_2') is-invalid @enderror" id="jenis_vaksin_2" name="jenis_vaksin_2">
                                                    <option value="SINOVAC">SINOVAC</option>
                                                    <option value="VAKSIN COVID-19 BIO DARMA">VAKSIN COVID-19 BIO DARMA</option>
                                                    <option value="ASTRAZENECA">ASTRAZENECA</option>
                                                    <option value="SINOPHARM">SINOPHARM</option>
                                                    <option value="MODERNA">MODERNA</option>
                                                    <option value="PFIZER">PFIZER</option>
                                                    <option value="SPUTNIK V">SPUTNIK V</option>
                                                    <option value="INDOVAC">INDOVAC</option>
                                                    <option value="INAVAC">INAVAC</option>
                                                </select>
                                                @error('jenis_vaksin_2')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="tanggal_vaksin_2">Tanggal Vaksin 2</label>
                                                <input type="date" class="form-control @error('tanggal_vaksin_2') is-invalid @enderror" id="tanggal_vaksin_2" name="tanggal_vaksin_2">
                                                @error('tanggal_vaksin_2')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="lokasi_vaksin_2">Lokasi Vaksin 2</label>
                                                <input type="text" class="form-control @error('lokasi_vaksin_2') is-invalid @enderror" id="lokasi_vaksin_2" name="lokasi_vaksin_2" placeholder="Lokasi Vaksin 2" oninput="this.value = this.value.toUpperCase()">
                                                @error('lokasi_vaksin_2')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="vaksin_3">Vaksin 3</label>
                                                <select class="form-control @error('vaksin_3') is-invalid @enderror" id="vaksin_3" name="vaksin_3">
                                                    <option value="sudah">Sudah</option>
                                                    <option value="belum">Belum</option>
                                                </select>
                                                @error('vaksin_3')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="jenis_vaksin_3">Jenis Vaksin 3</label>
                                                <select class="form-control @error('jenis_vaksin_3') is-invalid @enderror" id="jenis_vaksin_3" name="jenis_vaksin_3">
                                                    <option value="SINOVAC">SINOVAC</option>
                                                    <option value="VAKSIN COVID-19 BIO DARMA">VAKSIN COVID-19 BIO DARMA</option>
                                                    <option value="ASTRAZENECA">ASTRAZENECA</option>
                                                    <option value="SINOPHARM">SINOPHARM</option>
                                                    <option value="MODERNA">MODERNA</option>
                                                    <option value="PFIZER">PFIZER</option>
                                                    <option value="SPUTNIK V">SPUTNIK V</option>
                                                    <option value="INDOVAC">INDOVAC</option>
                                                    <option value="INAVAC">INAVAC</option>
                                                </select>
                                                @error('jenis_vaksin_3')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="tanggal_vaksin_3">Tanggal Vaksin 3</label>
                                                <input type="date" class="form-control @error('tanggal_vaksin_3') is-invalid @enderror" id="tanggal_vaksin_3" name="tanggal_vaksin_3">
                                                @error('tanggal_vaksin_3')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="lokasi_vaksin_3">Lokasi Vaksin 3</label>
                                                <input type="text" class="form-control @error('lokasi_vaksin_3') is-invalid @enderror" id="lokasi_vaksin_3" name="lokasi_vaksin_3" placeholder="Lokasi Vaksin 3" oninput="this.value = this.value.toUpperCase()">
                                                @error('lokasi_vaksin_3')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                            <a class="btn btn-secondary" href="/">Kembali</a>
                                            <button type="submit" class="btn btn-primary float-right">Daftar</button>
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
            <a href="https://bkk.smkmuhkandanghaur.sch.id">Nikko Adrian</a>.</strong
            >
            All rights reserved.
        </footer>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
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
                return `${loker}-${day}-${month}-${year}-${hours}${minutes}${seconds}-${randomNumber}`;
            }

            let codeInput = document.getElementById('code_pendaftaran');
            codeInput.value = generateUniqueCode();
        });
    </script>
    </body>
    </html>
