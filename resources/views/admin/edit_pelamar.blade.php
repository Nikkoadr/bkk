@extends('layouts.main_admin')
@section('link')
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">Edit Pelamar</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/home">Admin</a></li>
            <li class="breadcrumb-item">Data Pelamar</li>
            <li class="breadcrumb-item active">edit Pelamar</li>
        </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
            <div class="row">
        <div class="col-12">
        <div class="card">
            <!-- /.card-header -->
            <div class="card-body">
                <form action="/update_pelamar/{{ $data->id }}" method="post">
                    @csrf
                    @method('put')
                    <div class="card-body pt-0">
                        <div class="form-group">
                            <label for="code_pendaftaran">Code Pendaftaran</label>
                            <input type="text" class="form-control @error('code_pendaftaran') is-invalid @enderror" id="code_pendaftaran" name="code_pendaftaran" value="{{ $data->code_pendaftaran }}" readonly required oninput="this.value = this.value.toUpperCase()">
                            @error('code_pendaftaran')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="status_bayar">Status Bayar</label>
                            <select class="form-control @error('status_bayar') is-invalid @enderror" id="status_bayar" name="status_bayar">
                                <option value="sudah" {{ old('status_bayar', $data->status_bayar) == 'sudah' ? 'selected' : '' }}>Sudah</option>
                                <option value="menunggu" {{ old('status_bayar', $data->status_bayar) == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                                <option value="belum" {{ old('status_bayar', $data->status_bayar) == 'belum' ? 'selected' : '' }}>Belum</option>
                            </select>
                            @error('status_bayar')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ $data->email }}" required>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="nomor_wa">Nomor Whatsapp</label>
                            <input type="number" class="form-control @error('nomor_wa') is-invalid @enderror" id="nomor_wa" name="nomor_wa" value="{{ $data->nomor_wa }}" required>
                            @error('nomor_wa')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama Lengkap</label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" required value="{{ $data->nama }}" oninput="this.value = this.value.toUpperCase()">
                            @error('nama')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="nomor_nik">Nomor NIK</label>
                            <input type="number" class="form-control @error('nomor_nik') is-invalid @enderror" id="nomor_nik" name="nomor_nik" value="{{ $data->nomor_nik }}" oninput="this.value = this.value.toUpperCase()">
                            @error('nomor_nik')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="npwp">NPWP</label>
                            <input type="text" class="form-control @error('npwp') is-invalid @enderror" id="npwp" name="npwp" value="{{ $data->npwp }}" oninput="this.value = this.value.toUpperCase()">
                            @error('npwp')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="tempat_lahir">Tempat Lahir</label>
                            <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror" id="tempat_lahir" name="tempat_lahir" value="{{ $data->tempat_lahir }}" oninput="this.value = this.value.toUpperCase()">
                            @error('tempat_lahir')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="tanggal_lahir">Tanggal Lahir</label>
                            <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" value="{{ $data->tanggal_lahir }}" id="tanggal_lahir" name="tanggal_lahir">
                            @error('tanggal_lahir')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="jenis_kelamin">Jenis Kelamin</label>
                            <select class="form-control @error('jenis_kelamin') is-invalid @enderror" id="jenis_kelamin" name="jenis_kelamin" required>
                                <option value="L" {{ old('jenis_kelamin', $data->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-Laki</option>
                                <option value="P" {{ old('jenis_kelamin', $data->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
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
                                <option value="BELUM MENIKAH" {{ old('status_perkawinan', $data->status_perkawinan) == 'BELUM MENIKAH' ? 'selected' : '' }}>BELUM MENIKAH</option>
                                <option value="MENIKAH" {{ old('status_perkawinan', $data->status_perkawinan) == 'MENIKAH' ? 'selected' : '' }}>MENIKAH</option>
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
                                <option value="MA" {{ old('jenis_pendidikan_terakhir', $data->jenis_pendidikan_terakhir) == 'MA' ? 'selected' : '' }}>MA</option>
                                <option value="MAK" {{ old('jenis_pendidikan_terakhir', $data->jenis_pendidikan_terakhir) == 'MAK' ? 'selected' : '' }}>MAK</option>
                                <option value="SMA" {{ old('jenis_pendidikan_terakhir', $data->jenis_pendidikan_terakhir) == 'SMA' ? 'selected' : '' }}>SMA</option>
                                <option value="SMK" {{ old('jenis_pendidikan_terakhir', $data->jenis_pendidikan_terakhir) == 'SMK' ? 'selected' : '' }}>SMK</option>
                            </select>
                            @error('jenis_pendidikan_terakhir')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="npsn">NPSN</label>
                            <input type="number" class="form-control @error('npsn') is-invalid @enderror" id="npsn" name="npsn" value="{{ $data->npsn }}" oninput="this.value = this.value.toUpperCase()">
                            @error('npsn')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="nama_sekolah">Nama Sekolah</label>
                            <input type="text" class="form-control @error('nama_sekolah') is-invalid @enderror" id="nama_sekolah" name="nama_sekolah" value="{{ $data->nama_sekolah }}" oninput="this.value = this.value.toUpperCase()">
                            @error('nama_sekolah')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="jurusan_pendidikan">Jurusan Pendidikan</label>
                            <input type="text" class="form-control @error('jurusan_pendidikan') is-invalid @enderror" id="jurusan_pendidikan" name="jurusan_pendidikan" value="{{ $data->jurusan_pendidikan }}" oninput="this.value = this.value.toUpperCase()">
                            @error('jurusan_pendidikan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="kota_asal_sekolah">Kota Asal Sekolah</label>
                            <input type="text" class="form-control @error('kota_asal_sekolah') is-invalid @enderror" id="kota_asal_sekolah" name="kota_asal_sekolah" value="{{ $data->kota_asal_sekolah }}" oninput="this.value = this.value.toUpperCase()">
                            @error('kota_asal_sekolah')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="tahun_lulus">Tahun Lulus</label>
                            <input type="number" class="form-control @error('tahun_lulus') is-invalid @enderror" id="tahun_lulus" name="tahun_lulus" value="{{ $data->tahun_lulus }}" oninput="this.value = this.value.toUpperCase()">
                            @error('tahun_lulus')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="nilai_rata_rata_ijazah">Nilai Rata-Rata Ijazah</label>
                            <input type="text" class="form-control @error('nilai_rata_rata_ijazah') is-invalid @enderror" id="nilai_rata_rata_ijazah" name="nilai_rata_rata_ijazah" value="{{ $data->nilai_rata_rata_ijazah }}" oninput="this.value = this.value.toUpperCase()">
                            @error('nilai_rata_rata_ijazah')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="nilai_rata_rata_matematika">Nilai Rata-Rata Matematika</label>
                            <input type="text" class="form-control @error('nilai_rata_rata_matematika') is-invalid @enderror" id="nilai_rata_rata_matematika" name="nilai_rata_rata_matematika" value="{{ $data->nilai_rata_rata_matematika }}" oninput="this.value = this.value.toUpperCase()">
                            @error('nilai_rata_rata_matematika')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="blok">Blok</label>
                            <input type="text" class="form-control @error('blok') is-invalid @enderror" id="blok" name="blok" value="{{ $data->blok }}" oninput="this.value = this.value.toUpperCase()">
                            @error('blok')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="rt">RT</label>
                            <input type="number" class="form-control @error('rt') is-invalid @enderror" id="rt" name="rt" value="{{ $data->rt }}" oninput="this.value = this.value.toUpperCase()">
                            @error('rt')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="rw">RW</label>
                            <input type="number" class="form-control @error('rw') is-invalid @enderror" id="rw" name="rw" value="{{ $data->rw }}" oninput="this.value = this.value.toUpperCase()">
                            @error('rw')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="desa">Desa</label>
                            <input type="text" class="form-control @error('desa') is-invalid @enderror" id="desa" name="desa" value="{{ $data->desa }}" oninput="this.value = this.value.toUpperCase()">
                            @error('desa')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="kecamatan">Kecamatan</label>
                            <input type="text" class="form-control @error('kecamatan') is-invalid @enderror" id="kecamatan" name="kecamatan" value="{{ $data->kecamatan }}" oninput="this.value = this.value.toUpperCase()">
                            @error('kecamatan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="kabupaten">Kabupaten</label>
                            <input type="text" class="form-control @error('kabupaten') is-invalid @enderror" id="kabupaten" name="kabupaten" value="{{ $data->kabupaten }}" oninput="this.value = this.value.toUpperCase()">
                            @error('kabupaten')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="kode_pos">Kode Pos</label>
                            <input type="text" class="form-control @error('kode_pos') is-invalid @enderror" id="kode_pos" name="kode_pos" value="{{ $data->kode_pos }}" oninput="this.value = this.value.toUpperCase()">
                            @error('kode_pos')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="domisili">Domisili</label>
                            <input type="text" class="form-control @error('domisili') is-invalid @enderror" id="domisili" name="domisili" value="{{ $data->domisili }}" oninput="this.value = this.value.toUpperCase()">
                            @error('domisili')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="tinggi_badan">Tinggi Badan</label>
                            <input type="number" class="form-control @error('tinggi_badan') is-invalid @enderror" id="tinggi_badan" name="tinggi_badan" value="{{ $data->tinggi_badan }}" oninput="this.value = this.value.toUpperCase()">
                            @error('tinggi_badan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="berat_badan">Berat Badan</label>
                            <input type="number" class="form-control @error('berat_badan') is-invalid @enderror" id="berat_badan" name="berat_badan" value="{{ $data->berat_badan }}" oninput="this.value = this.value.toUpperCase()">
                            @error('berat_badan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="pengalaman_kerja">Pengalaman Kerja</label>
                            <input type="text" class="form-control @error('pengalaman_kerja') is-invalid @enderror" id="pengalaman_kerja" name="pengalaman_kerja" value="{{ $data->pengalaman_kerja }}" oninput="this.value = this.value.toUpperCase()">
                            @error('pengalaman_kerja')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="pernah_mengikuti_reqrutment_calon_karyawan">Pernah Mengikuti Recruitment Calon Karyawan</label>
                            <select class="form-control @error('pernah_mengikuti_reqrutment_calon_karyawan') is-invalid @enderror" id="pernah_mengikuti_reqrutment_calon_karyawan" name="pernah_mengikuti_reqrutment_calon_karyawan">
                                <option value="BELUM PERNAH"{{ old('pernah_mengikuti_reqrutment_calon_karyawan', $data->pernah_mengikuti_reqrutment_calon_karyawan) == 'BELUM PERNAH' ? 'selected' : '' }}>BELUM PERNAH</option>
                                <option value="SUDAH PERNAH"{{ old('pernah_mengikuti_reqrutment_calon_karyawan', $data->pernah_mengikuti_reqrutment_calon_karyawan) == 'SUDAH PERNAH' ? 'selected' : '' }}>SUDAH PERNAH</option>
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
                                <option value="BELUM PERNAH" {{ old('pernah_bekerja', $data->pernah_bekerja) == 'BELUM PERNAH' ? 'selected' : '' }}>BELUM PERNAH</option>
                                <option value="SUDAH PERNAH" {{ old('pernah_bekerja', $data->pernah_bekerja) == 'SUDAH PERNAH' ? 'selected' : '' }}>SUDAH PERNAH</option>
                            </select>
                            @error('pernah_bekerja')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
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
                        @if('1'=='1')
                            <div class="form-group">
                                <label for="vaksin_1">Vaksin 1</label>
                                <select class="form-control @error('vaksin_1') is-invalid @enderror" id="vaksin_1" name="vaksin_1">
                                    <option value="" {{ old('vaksin_1', $data->vaksin_1) == '' ? 'selected' : '' }}>Pilih status vaksin</option>
                                    <option value="sudah" {{ old('vaksin_1', $data->vaksin_1) == 'sudah' ? 'selected' : '' }}>Sudah</option>
                                    <option value="belum" {{ old('vaksin_1', $data->vaksin_1) == 'belum' ? 'selected' : '' }}>Belum</option>
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
                                    <option value="" {{ old('jenis_vaksin_1', $data->jenis_vaksin_1) == '' ? 'selected' : '' }}>Pilih jenis vaksin</option>
                                    <option value="SINOVAC" {{ old('jenis_vaksin_1', $data->jenis_vaksin_1) == 'SINOVAC' ? 'selected' : '' }}>SINOVAC</option>
                                    <option value="VAKSIN COVID-19 BIO DARMA" {{ old('jenis_vaksin_1', $data->jenis_vaksin_1) == 'VAKSIN COVID-19 BIO DARMA' ? 'selected' : '' }}>VAKSIN COVID-19 BIO DARMA</option>
                                    <option value="ASTRAZENECA" {{ old('jenis_vaksin_1', $data->jenis_vaksin_1) == 'ASTRAZENECA' ? 'selected' : '' }}>ASTRAZENECA</option>
                                    <option value="SINOPHARM" {{ old('jenis_vaksin_1', $data->jenis_vaksin_1) == 'SINOPHARM' ? 'selected' : '' }}>SINOPHARM</option>
                                    <option value="MODERNA" {{ old('jenis_vaksin_1', $data->jenis_vaksin_1) == 'MODERNA' ? 'selected' : '' }}>MODERNA</option>
                                    <option value="PFIZER" {{ old('jenis_vaksin_1', $data->jenis_vaksin_1) == 'PFIZER' ? 'selected' : '' }}>PFIZER</option>
                                    <option value="SPUTNIK V" {{ old('jenis_vaksin_1', $data->jenis_vaksin_1) == 'SPUTNIK V' ? 'selected' : '' }}>SPUTNIK V</option>
                                    <option value="INDOVAC" {{ old('jenis_vaksin_1', $data->jenis_vaksin_1) == 'INDOVAC' ? 'selected' : '' }}>INDOVAC</option>
                                    <option value="INAVAC" {{ old('jenis_vaksin_1', $data->jenis_vaksin_1) == 'INAVAC' ? 'selected' : '' }}>INAVAC</option>
                                </select>
                                @error('jenis_vaksin_1')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="tanggal_vaksin_1">Tanggal Vaksin 1</label>
                                <input type="date" class="form-control @error('tanggal_vaksin_1') is-invalid @enderror" id="tanggal_vaksin_1" name="tanggal_vaksin_1" value="{{$data->tanggal_vaksin_1}}">
                                @error('tanggal_vaksin_1')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="lokasi_vaksin_1">Lokasi Vaksin 1</label>
                                <input type="text" class="form-control @error('lokasi_vaksin_1') is-invalid @enderror" id="lokasi_vaksin_1" name="lokasi_vaksin_1" placeholder="Lokasi Vaksin 1" value="{{$data->lokasi_vaksin_1}}" oninput="this.value = this.value.toUpperCase()">
                                @error('lokasi_vaksin_1')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="vaksin_2">Vaksin 2</label>
                                <select class="form-control @error('vaksin_2') is-invalid @enderror" id="vaksin_2" name="vaksin_2">
                                    <option value="" {{ old('vaksin_2', $data->vaksin_2) == '' ? 'selected' : '' }}>Pilih status vaksin</option>
                                    <option value="sudah" {{ old('vaksin_2', $data->vaksin_2) == 'sudah' ? 'selected' : '' }}>Sudah</option>
                                    <option value="belum" {{ old('vaksin_2', $data->vaksin_2) == 'belum' ? 'selected' : '' }}>Belum</option>
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
                                    <option value="" {{ old('jenis_vaksin_2', $data->jenis_vaksin_2) == '' ? 'selected' : '' }}>Pilih jenis vaksin</option>
                                    <option value="SINOVAC" {{ old('jenis_vaksin_2', $data->jenis_vaksin_2) == 'SINOVAC' ? 'selected' : '' }}>SINOVAC</option>
                                    <option value="VAKSIN COVID-19 BIO DARMA" {{ old('jenis_vaksin_2', $data->jenis_vaksin_2) == 'VAKSIN COVID-19 BIO DARMA' ? 'selected' : '' }}>VAKSIN COVID-19 BIO DARMA</option>
                                    <option value="ASTRAZENECA" {{ old('jenis_vaksin_2', $data->jenis_vaksin_2) == 'ASTRAZENECA' ? 'selected' : '' }}>ASTRAZENECA</option>
                                    <option value="SINOPHARM" {{ old('jenis_vaksin_2', $data->jenis_vaksin_2) == 'SINOPHARM' ? 'selected' : '' }}>SINOPHARM</option>
                                    <option value="MODERNA" {{ old('jenis_vaksin_2', $data->jenis_vaksin_2) == 'MODERNA' ? 'selected' : '' }}>MODERNA</option>
                                    <option value="PFIZER" {{ old('jenis_vaksin_2', $data->jenis_vaksin_2) == 'PFIZER' ? 'selected' : '' }}>PFIZER</option>
                                    <option value="SPUTNIK V" {{ old('jenis_vaksin_2', $data->jenis_vaksin_2) == 'SPUTNIK V' ? 'selected' : '' }}>SPUTNIK V</option>
                                    <option value="INDOVAC" {{ old('jenis_vaksin_2', $data->jenis_vaksin_2) == 'INDOVAC' ? 'selected' : '' }}>INDOVAC</option>
                                    <option value="INAVAC" {{ old('jenis_vaksin_2', $data->jenis_vaksin_2) == 'INAVAC' ? 'selected' : '' }}>INAVAC</option>
                                </select>
                                @error('jenis_vaksin_2')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="tanggal_vaksin_2">Tanggal Vaksin 2</label>
                                <input type="date" class="form-control @error('tanggal_vaksin_2') is-invalid @enderror" id="tanggal_vaksin_2" name="tanggal_vaksin_2" value="{{$data->tanggal_vaksin_2 }}">
                                @error('tanggal_vaksin_2')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="lokasi_vaksin_2">Lokasi Vaksin 2</label>
                                <input type="text" class="form-control @error('lokasi_vaksin_2') is-invalid @enderror" id="lokasi_vaksin_2" name="lokasi_vaksin_2" placeholder="Lokasi Vaksin 2" value="{{$data->lokasi_vaksin_2}}" oninput="this.value = this.value.toUpperCase()">
                                @error('lokasi_vaksin_2')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="vaksin_3">Vaksin 3</label>
                                <select class="form-control @error('vaksin_3') is-invalid @enderror" id="vaksin_3" name="vaksin_3">
                                    <option value="" {{ old('vaksin_3', $data->vaksin_3) == '' ? 'selected' : '' }}>Pilih status vaksin</option>
                                    <option value="sudah" {{ old('vaksin_3', $data->vaksin_3) == 'sudah' ? 'selected' : '' }}>Sudah</option>
                                    <option value="belum" {{ old('vaksin_3', $data->vaksin_3) == 'belum' ? 'selected' : '' }}>Belum</option>
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
                                    <option value="" {{ old('jenis_vaksin_3', $data->jenis_vaksin_3) == '' ? 'selected' : '' }}>Pilih jenis vaksin</option>
                                    <option value="SINOVAC" {{ old('jenis_vaksin_3', $data->jenis_vaksin_3) == 'SINOVAC' ? 'selected' : '' }}>SINOVAC</option>
                                    <option value="VAKSIN COVID-19 BIO DARMA" {{ old('jenis_vaksin_3', $data->jenis_vaksin_3) == 'VAKSIN COVID-19 BIO DARMA' ? 'selected' : '' }}>VAKSIN COVID-19 BIO DARMA</option>
                                    <option value="ASTRAZENECA" {{ old('jenis_vaksin_3', $data->jenis_vaksin_3) == 'ASTRAZENECA' ? 'selected' : '' }}>ASTRAZENECA</option>
                                    <option value="SINOPHARM" {{ old('jenis_vaksin_3', $data->jenis_vaksin_3) == 'SINOPHARM' ? 'selected' : '' }}>SINOPHARM</option>
                                    <option value="MODERNA" {{ old('jenis_vaksin_3', $data->jenis_vaksin_3) == 'MODERNA' ? 'selected' : '' }}>MODERNA</option>
                                    <option value="PFIZER" {{ old('jenis_vaksin_3', $data->jenis_vaksin_3) == 'PFIZER' ? 'selected' : '' }}>PFIZER</option>
                                    <option value="SPUTNIK V" {{ old('jenis_vaksin_3', $data->jenis_vaksin_3) == 'SPUTNIK V' ? 'selected' : '' }}>SPUTNIK V</option>
                                    <option value="INDOVAC" {{ old('jenis_vaksin_3', $data->jenis_vaksin_3) == 'INDOVAC' ? 'selected' : '' }}>INDOVAC</option>
                                    <option value="INAVAC" {{ old('jenis_vaksin_3', $data->jenis_vaksin_3) == 'INAVAC' ? 'selected' : '' }}>INAVAC</option>
                                </select>
                                @error('jenis_vaksin_3')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="tanggal_vaksin_3">Tanggal Vaksin 3</label>
                                <input type="date" class="form-control @error('tanggal_vaksin_3') is-invalid @enderror" id="tanggal_vaksin_3" name="tanggal_vaksin_3" value="{{$data->tanggal_vaksin_3}}">
                                @error('tanggal_vaksin_3')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="lokasi_vaksin_3">Lokasi Vaksin 3</label>
                                <input type="text" class="form-control @error('lokasi_vaksin_3') is-invalid @enderror" id="lokasi_vaksin_3" name="lokasi_vaksin_3" placeholder="Lokasi Vaksin 3" value="{{$data->lokasi_vaksin_3}}" oninput="this.value = this.value.toUpperCase()">
                                @error('lokasi_vaksin_3')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        @endif
                    </div>
                        <a class="btn btn-secondary" href="/status_pelamar">Kembali</a>
                        <button type="submit" class="btn btn-primary float-right">Edit</button>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
@section('script')
<script>
@if (session()->has('success'))
var Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 5000
});
    Toast.fire({
    icon: 'success',
    title: '{{ session('success') }}'
    })
@endif
</script>
<script>
document.querySelectorAll('.konfirmasi').forEach(function(element) {
    element.addEventListener('click', function (event) {
        event.preventDefault();
        const url = this.getAttribute('href');
        Swal.fire({
            text: "Anda yakin ingin menghapus data ini?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        });
    });
});
</script>
@endsection
