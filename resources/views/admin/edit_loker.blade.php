@extends('layouts.main_admin')
@section('link')
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <style>
        .form-group {
            margin-bottom: 15px;
        }
        .form-check {
            display: flex;
            align-items: center;
            margin-right: 20px;
        }
        .form-group > div {
            display: flex;
            flex-wrap: wrap;
        }
        .form-check-label {
            margin-left: 5px;
        }
    </style>
@endsection
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">Edit Loker</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/home">Admin</a></li>
            <li class="breadcrumb-item">Data Loker</li>
            <li class="breadcrumb-item active">edit loker</li>
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
                <form action="/update_loker/{{ $data->id_loker }}" method="post">
                    @csrf
                    @method('put')
                    
                    <div class="form-group">
                        <label for="nama_loker">Nama loker : </label>
                        <input type="text" class="form-control" name="nama_loker" id="nama_loker" value="{{ $data->nama_loker }}" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi : </label>
                        <textarea class="form-control" name="deskripsi" id="deskripsi" rows="4" required>{{ $data->deskripsi }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="status_loker">Status loker : </label>
                        <select class="form-control" name="status_loker" id="status_loker" required>
                            <option value="aktif" {{ $data->status_loker == 'aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="tidak aktif" {{ $data->status_loker == 'tidak aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="form_npwp">Form NPWP : </label>
                        <div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="form_npwp" id="form_npwp_aktif" value="aktif" {{ $data->form_npwp == 'aktif' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="form_npwp_aktif">Aktif</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="form_npwp" id="form_npwp_tidak_aktif" value="tidak aktif" {{ $data->form_npwp == 'tidak aktif' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="form_npwp_tidak_aktif">Tidak Aktif</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="form_npsn">Form NPSN : </label>
                        <div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="form_npsn" id="form_npsn_aktif" value="aktif" {{ $data->form_npsn == 'aktif' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="form_npsn_aktif">Aktif</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="form_npsn" id="form_npsn_tidak_aktif" value="tidak aktif" {{ $data->form_npsn == 'tidak aktif' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="form_npsn_tidak_aktif">Tidak Aktif</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="form_nilai_ijazah">Form Nilai Ijazah : </label>
                        <div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="form_nilai_ijazah" id="form_nilai_ijazah_aktif" value="aktif" {{ $data->form_nilai_ijazah == 'aktif' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="form_nilai_ijazah_aktif">Aktif</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="form_nilai_ijazah" id="form_nilai_ijazah_tidak_aktif" value="tidak aktif" {{ $data->form_nilai_ijazah == 'tidak aktif' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="form_nilai_ijazah_tidak_aktif">Tidak Aktif</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="form_nilai_matematika">Form Nilai Matematika : </label>
                        <div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="form_nilai_matematika" id="form_nilai_matematika_aktif" value="aktif" {{ $data->form_nilai_matematika == 'aktif' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="form_nilai_matematika_aktif">Aktif</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="form_nilai_matematika" id="form_nilai_matematika_tidak_aktif" value="tidak aktif" {{ $data->form_nilai_matematika == 'tidak aktif' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="form_nilai_matematika_tidak_aktif">Tidak Aktif</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="form_pernah_mengikuti_reqrutment_calon_karyawan">Form Pernah Mengikuti Rekrutmen Calon Karyawan di {{ $data->nama_loker }} : </label>
                        <div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="form_pernah_mengikuti_reqrutment_calon_karyawan" id="form_pernah_mengikuti_reqrutment_calon_karyawan_aktif" value="aktif" {{ $data->form_pernah_mengikuti_reqrutment_calon_karyawan == 'aktif' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="form_pernah_mengikuti_reqrutment_calon_karyawan_aktif">Aktif</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="form_pernah_mengikuti_reqrutment_calon_karyawan" id="form_pernah_mengikuti_reqrutment_calon_karyawan_tidak_aktif" value="tidak aktif" {{ $data->form_pernah_mengikuti_reqrutment_calon_karyawan == 'tidak aktif' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="form_pernah_mengikuti_reqrutment_calon_karyawan_tidak_aktif">Tidak Aktif</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="form_pernah_bekerja">Form Pernah Bekerja di {{ $data->nama_loker }} : </label>
                        <div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="form_pernah_bekerja" id="form_pernah_bekerja_aktif" value="aktif" {{ $data->form_pernah_bekerja == 'aktif' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="form_pernah_bekerja_aktif">Aktif</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="form_pernah_bekerja" id="form_pernah_bekerja_tidak_aktif" value="tidak aktif" {{ $data->form_pernah_bekerja == 'tidak aktif' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="form_pernah_bekerja_tidak_aktif">Tidak Aktif</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="form_vaksin">Form Vaksin : </label>
                        <div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="form_vaksin" id="form_vaksin_aktif" value="aktif" {{ $data->form_vaksin == 'aktif' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="form_vaksin_aktif">Aktif</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="form_vaksin" id="form_vaksin_tidak_aktif" value="tidak aktif" {{ $data->form_vaksin == 'tidak aktif' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="form_vaksin_tidak_aktif">Tidak Aktif</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="grup_wa">Grup WA:</label>
                        <input type="text" class="form-control" name="grup_wa" id="grup_wa" value="{{ $data->grup_wa }}" required>
                    </div>

                    <div class="form-group">
                        <label for="created_at">Created at:</label>
                        <input type="text" class="form-control" name="created_at" id="created_at" value="{{ \Carbon\Carbon::parse($data->created_at)->format('d M Y H:i') }}" readonly>
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">Update Loker</button>
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
<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('deskripsi');
</script>
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
