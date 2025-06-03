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
                    <a href="/" class="navbar-brand">
                        <img src="{{ asset('assets/dist/img/logobkk.png') }}" alt="dosq" class="brand-image">
                    </a>

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
                        <div class="col-lg-5">
                            <div class="card">
                                <div class="card-header bg-info">
                                    <h5 class="card-title m-0 text-bold">Info Loker</h5>
                                </div>
                                <div class="card-body">
                                    <h5>Nama Perusahaan : </h5>
                                    <h5><b>{{ $data->nama_loker }}</b></h5>
                                    <h5>Posisi : {{ $data->posisi }}</h5>
                                    <h5>Kualifikasi :</h5>
                                    <h6>{!! $data->deskripsi !!}</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="card">
                                <div class="card-header bg-primary">
                                    <h5 class="card-title m-0 text-bold">Form Pendaftaran</h5>
                                </div>
                                <div class="card-body">
                                    <form action="/bayar" method="post">
                                        @csrf
                                        <input type="hidden" name="id_loker" value="{{ $data->id_loker }}">
                                        <div class="card-body pt-0">
                                            <div class="form-group">
                                                <label for="code_pendaftaran">Code Pendaftaran </label>
                                                <input type="text" class="form-control @error('code_pendaftaran') is-invalid @enderror" id="code_pendaftaran" name="code_pendaftaran" value="" readonly required oninput="this.value = this.value.toUpperCase()">
                                                @error('code_pendaftaran')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Email<span style="color: red">*</span></label>
                                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="example@gmail.com" required>
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="nomor_wa">Nomor Whatsapp<span style="color: red">*</span></label>
                                                <input type="number" class="form-control @error('nomor_wa') is-invalid @enderror" id="nomor_wa" name="nomor_wa" placeholder="081222222222" required>
                                                @error('nomor_wa')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="nama">Nama Lengkap<span style="color: red">*</span></label>
                                                <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" placeholder="Nama" required oninput="this.value = this.value.toUpperCase()">
                                                @error('nama')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="nomor_nik">Nomor NIK<span style="color: red">*</span></label>
                                                <input type="number" class="form-control @error('nomor_nik') is-invalid @enderror" id="nomor_nik" name="nomor_nik" placeholder="Nomor NIK" oninput="this.value = this.value.toUpperCase()">
                                                @error('nomor_nik')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            @if($data->form_npwp =='aktif')
                                            <div class="form-group">
                                                <label for="npwp">NPWP</label>
                                                <input type="text" class="form-control @error('npwp') is-invalid @enderror" id="npwp" name="npwp" placeholder="NPWP" oninput="this.value = this.value.toUpperCase()">
                                                @error('npwp')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            @endif
                                            <div class="form-group">
                                                <label for="sim">SIM</label>
                                                <select class="form-control @error('sim') is-invalid @enderror" name="sim" id="sim">
                                                    <option value="">Tidak Ada</option>
                                                    <option value="D">D</option>
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
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="tempat_lahir">Tempat Lahir<span style="color: red">*</span></label>
                                                <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror" id="tempat_lahir" name="tempat_lahir" placeholder="Tempat Lahir" oninput="this.value = this.value.toUpperCase()" required>
                                                @error('tempat_lahir')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="tanggal_lahir">Tanggal Lahir<span style="color: red">*</span></label>
                                                <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" id="tanggal_lahir" name="tanggal_lahir" required>
                                                @error('tanggal_lahir')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="jenis_kelamin">Jenis Kelamin<span style="color: red">*</span></label>
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
                                                <label for="status_perkawinan">Status Perkawinan<span style="color: red">*</span></label>
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
                                                <label for="jenis_pendidikan_terakhir">Jenis Pendidikan Terakhir<span style="color: red">*</span></label>
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
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            @if($data->form_npsn =='aktif')
                                            <div class="form-group">
                                                <label for="npsn">NPSN</label>
                                                <input type="number" class="form-control @error('npsn') is-invalid @enderror" id="npsn" name="npsn" placeholder="NPSN" oninput="this.value = this.value.toUpperCase()">
                                                @error('npsn')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            @endif
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
                                            @if($data->form_nilai_ijazah == 'aktif')
                                                <div class="form-group">
                                                <label for="nilai_rata_rata_ijazah">Nilai Rata-Rata Ijazah</label>
                                                <input type="text" class="form-control @error('nilai_rata_rata_ijazah') is-invalid @enderror" id="nilai_rata_rata_ijazah" name="nilai_rata_rata_ijazah" placeholder="Nilai Rata-Rata Ijazah" oninput="this.value = this.value.toUpperCase()">
                                                @error('nilai_rata_rata_ijazah')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            @endif
                                            @if($data->form_nilai_matematika == "aktif")
                                            <div class="form-group">
                                                <label for="nilai_rata_rata_matematika">Nilai Rata-Rata Matematika</label>
                                                <input type="text" class="form-control @error('nilai_rata_rata_matematika') is-invalid @enderror" id="nilai_rata_rata_matematika" name="nilai_rata_rata_matematika" placeholder="Nilai Rata-Rata Matematika" oninput="this.value = this.value.toUpperCase()">
                                                @error('nilai_rata_rata_matematika')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            @endif
                                            
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
                                            @if($data->form_domisili == 'aktif')
                                            <div class="form-group">
                                                <label for="domisili">Domisili</label>
                                                <input type="text" class="form-control @error('domisili') is-invalid @enderror" id="domisili" name="domisili" placeholder="Domisili" oninput="this.value = this.value.toUpperCase()">
                                                @error('domisili')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            @endif
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
                                                <label for="posisi_yang_dilamar">Posisi yang Dilamar</label>
                                                <input type="text" class="form-control @error('posisi_yang_dilamar') is-invalid @enderror" id="posisi_yang_dilamar" name="posisi_yang_dilamar" placeholder="Posisi yang Dilamar" oninput="this.value = this.value.toUpperCase()">
                                                @error('posisi_yang_dilamar')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="pengalaman_kerja">Pengalaman  (Bukan PKL)</label>
                                                <input type="text" class="form-control @error('pengalaman_kerja') is-invalid @enderror" id="pengalaman_kerja" name="pengalaman_kerja" placeholder="Pengalaman Kerja" oninput="this.value = this.value.toUpperCase()">
                                                @error('pengalaman_kerja')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            @if($data->form_pernah_mengikuti_reqrutment_calon_karyawan == 'aktif')
                                                <div class="form-group">
                                                    <label for="pernah_mengikuti_reqrutment_calon_karyawan">Pernah Mengikuti Recruitment Calon Karyawan {{ $data->nama_loker }}</label>
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
                                            @endif
                                            @if($data->form_pernah_bekerja == 'aktif')
                                                <div class="form-group">
                                                <label for="pernah_bekerja">Pernah Bekerja {{ $data->nama_loker }}</label>
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
                                            @endif
                                            <div class="form-group">
                                                <label for="source">Sumber Informasi</label>
                                                <input readonly type="text" class="form-control @error('source') is-invalid @enderror" id="source" name="source" value="BKK SMK MUHAMMADIYAH KANDANGHAUR" placeholder="Sumber Informasi" oninput="this.value = this.value.toUpperCase()">
                                                @error('source')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="nama_kordinator">Nama Kordinator</label>
                                                <input readonly type="text" class="form-control @error('nama_kordinator') is-invalid @enderror" id="nama_kordinator" value="ADI SAFRUDIN" name="nama_kordinator" placeholder="Nama Kordinator" oninput="this.value = this.value.toUpperCase()">
                                                @error('nama_kordinator')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            @if($data->form_vaksin == 'aktif')
                                                <div class="form-group">
                                                    <label for="vaksin_1">Vaksin 1</label>
                                                    <select class="form-control @error('vaksin_1') is-invalid @enderror" id="vaksin_1" name="vaksin_1">
                                                        <option value="" {{ old('vaksin_1') == '' ? 'selected' : '' }}>Pilih status vaksin</option>
                                                        <option value="sudah" {{ old('vaksin_1') == 'sudah' ? 'selected' : '' }}>Sudah</option>
                                                        <option value="belum" {{ old('vaksin_1') == 'belum' ? 'selected' : '' }}>Belum</option>
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
                                                        <option value="" {{ old('jenis_vaksin_1') == '' ? 'selected' : '' }}>Pilih jenis vaksin</option>
                                                        <option value="SINOVAC" {{ old('jenis_vaksin_1') == 'SINOVAC' ? 'selected' : '' }}>SINOVAC</option>
                                                        <option value="VAKSIN COVID-19 BIO DARMA" {{ old('jenis_vaksin_1') == 'VAKSIN COVID-19 BIO DARMA' ? 'selected' : '' }}>VAKSIN COVID-19 BIO DARMA</option>
                                                        <option value="ASTRAZENECA" {{ old('jenis_vaksin_1') == 'ASTRAZENECA' ? 'selected' : '' }}>ASTRAZENECA</option>
                                                        <option value="SINOPHARM" {{ old('jenis_vaksin_1') == 'SINOPHARM' ? 'selected' : '' }}>SINOPHARM</option>
                                                        <option value="MODERNA" {{ old('jenis_vaksin_1') == 'MODERNA' ? 'selected' : '' }}>MODERNA</option>
                                                        <option value="PFIZER" {{ old('jenis_vaksin_1') == 'PFIZER' ? 'selected' : '' }}>PFIZER</option>
                                                        <option value="SPUTNIK V" {{ old('jenis_vaksin_1') == 'SPUTNIK V' ? 'selected' : '' }}>SPUTNIK V</option>
                                                        <option value="INDOVAC" {{ old('jenis_vaksin_1') == 'INDOVAC' ? 'selected' : '' }}>INDOVAC</option>
                                                        <option value="INAVAC" {{ old('jenis_vaksin_1') == 'INAVAC' ? 'selected' : '' }}>INAVAC</option>
                                                    </select>
                                                    @error('jenis_vaksin_1')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label for="tanggal_vaksin_1">Tanggal Vaksin 1</label>
                                                    <input type="date" class="form-control @error('tanggal_vaksin_1') is-invalid @enderror" id="tanggal_vaksin_1" name="tanggal_vaksin_1" value="{{ old('tanggal_vaksin_1') }}">
                                                    @error('tanggal_vaksin_1')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label for="lokasi_vaksin_1">Lokasi Vaksin 1</label>
                                                    <input type="text" class="form-control @error('lokasi_vaksin_1') is-invalid @enderror" id="lokasi_vaksin_1" name="lokasi_vaksin_1" placeholder="Lokasi Vaksin 1" value="{{ old('lokasi_vaksin_1') }}" oninput="this.value = this.value.toUpperCase()">
                                                    @error('lokasi_vaksin_1')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label for="vaksin_2">Vaksin 2</label>
                                                    <select class="form-control @error('vaksin_2') is-invalid @enderror" id="vaksin_2" name="vaksin_2">
                                                        <option value="" {{ old('vaksin_2') == '' ? 'selected' : '' }}>Pilih status vaksin</option>
                                                        <option value="sudah" {{ old('vaksin_2') == 'sudah' ? 'selected' : '' }}>Sudah</option>
                                                        <option value="belum" {{ old('vaksin_2') == 'belum' ? 'selected' : '' }}>Belum</option>
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
                                                        <option value="" {{ old('jenis_vaksin_2') == '' ? 'selected' : '' }}>Pilih jenis vaksin</option>
                                                        <option value="SINOVAC" {{ old('jenis_vaksin_2') == 'SINOVAC' ? 'selected' : '' }}>SINOVAC</option>
                                                        <option value="VAKSIN COVID-19 BIO DARMA" {{ old('jenis_vaksin_2') == 'VAKSIN COVID-19 BIO DARMA' ? 'selected' : '' }}>VAKSIN COVID-19 BIO DARMA</option>
                                                        <option value="ASTRAZENECA" {{ old('jenis_vaksin_2') == 'ASTRAZENECA' ? 'selected' : '' }}>ASTRAZENECA</option>
                                                        <option value="SINOPHARM" {{ old('jenis_vaksin_2') == 'SINOPHARM' ? 'selected' : '' }}>SINOPHARM</option>
                                                        <option value="MODERNA" {{ old('jenis_vaksin_2') == 'MODERNA' ? 'selected' : '' }}>MODERNA</option>
                                                        <option value="PFIZER" {{ old('jenis_vaksin_2') == 'PFIZER' ? 'selected' : '' }}>PFIZER</option>
                                                        <option value="SPUTNIK V" {{ old('jenis_vaksin_2') == 'SPUTNIK V' ? 'selected' : '' }}>SPUTNIK V</option>
                                                        <option value="INDOVAC" {{ old('jenis_vaksin_2') == 'INDOVAC' ? 'selected' : '' }}>INDOVAC</option>
                                                        <option value="INAVAC" {{ old('jenis_vaksin_2') == 'INAVAC' ? 'selected' : '' }}>INAVAC</option>
                                                    </select>
                                                    @error('jenis_vaksin_2')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label for="tanggal_vaksin_2">Tanggal Vaksin 2</label>
                                                    <input type="date" class="form-control @error('tanggal_vaksin_2') is-invalid @enderror" id="tanggal_vaksin_2" name="tanggal_vaksin_2" value="{{ old('tanggal_vaksin_2') }}">
                                                    @error('tanggal_vaksin_2')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label for="lokasi_vaksin_2">Lokasi Vaksin 2</label>
                                                    <input type="text" class="form-control @error('lokasi_vaksin_2') is-invalid @enderror" id="lokasi_vaksin_2" name="lokasi_vaksin_2" placeholder="Lokasi Vaksin 2" value="{{ old('lokasi_vaksin_2') }}" oninput="this.value = this.value.toUpperCase()">
                                                    @error('lokasi_vaksin_2')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label for="vaksin_3">Vaksin 3</label>
                                                    <select class="form-control @error('vaksin_3') is-invalid @enderror" id="vaksin_3" name="vaksin_3">
                                                        <option value="" {{ old('vaksin_3') == '' ? 'selected' : '' }}>Pilih status vaksin</option>
                                                        <option value="sudah" {{ old('vaksin_3') == 'sudah' ? 'selected' : '' }}>Sudah</option>
                                                        <option value="belum" {{ old('vaksin_3') == 'belum' ? 'selected' : '' }}>Belum</option>
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
                                                        <option value="" {{ old('jenis_vaksin_3') == '' ? 'selected' : '' }}>Pilih jenis vaksin</option>
                                                        <option value="SINOVAC" {{ old('jenis_vaksin_3') == 'SINOVAC' ? 'selected' : '' }}>SINOVAC</option>
                                                        <option value="VAKSIN COVID-19 BIO DARMA" {{ old('jenis_vaksin_3') == 'VAKSIN COVID-19 BIO DARMA' ? 'selected' : '' }}>VAKSIN COVID-19 BIO DARMA</option>
                                                        <option value="ASTRAZENECA" {{ old('jenis_vaksin_3') == 'ASTRAZENECA' ? 'selected' : '' }}>ASTRAZENECA</option>
                                                        <option value="SINOPHARM" {{ old('jenis_vaksin_3') == 'SINOPHARM' ? 'selected' : '' }}>SINOPHARM</option>
                                                        <option value="MODERNA" {{ old('jenis_vaksin_3') == 'MODERNA' ? 'selected' : '' }}>MODERNA</option>
                                                        <option value="PFIZER" {{ old('jenis_vaksin_3') == 'PFIZER' ? 'selected' : '' }}>PFIZER</option>
                                                        <option value="SPUTNIK V" {{ old('jenis_vaksin_3') == 'SPUTNIK V' ? 'selected' : '' }}>SPUTNIK V</option>
                                                        <option value="INDOVAC" {{ old('jenis_vaksin_3') == 'INDOVAC' ? 'selected' : '' }}>INDOVAC</option>
                                                        <option value="INAVAC" {{ old('jenis_vaksin_3') == 'INAVAC' ? 'selected' : '' }}>INAVAC</option>
                                                    </select>
                                                    @error('jenis_vaksin_3')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label for="tanggal_vaksin_3">Tanggal Vaksin 3</label>
                                                    <input type="date" class="form-control @error('tanggal_vaksin_3') is-invalid @enderror" id="tanggal_vaksin_3" name="tanggal_vaksin_3" value="{{ old('tanggal_vaksin_3') }}">
                                                    @error('tanggal_vaksin_3')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label for="lokasi_vaksin_3">Lokasi Vaksin 3</label>
                                                    <input type="text" class="form-control @error('lokasi_vaksin_3') is-invalid @enderror" id="lokasi_vaksin_3" name="lokasi_vaksin_3" placeholder="Lokasi Vaksin 3" value="{{ old('lokasi_vaksin_3') }}" oninput="this.value = this.value.toUpperCase()">
                                                    @error('lokasi_vaksin_3')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            @endif
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
