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
                        <label for="nama_loker">Nama loker:</label>
                        <input type="text" class="form-control" name="nama_loker" id="nama_loker" value="{{ $data->nama_loker }}" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi:</label>
                        <textarea class="form-control" name="deskripsi" id="deskripsi" rows="4" required>{{ $data->deskripsi }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="status_loker">Status loker:</label>
                        <select class="form-control" name="status_loker" id="status_loker" required>
                            <option value="aktif" {{ $data->status_loker == 'aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="tidak aktif" {{ $data->status_loker == 'tidak aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                        </select>
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
