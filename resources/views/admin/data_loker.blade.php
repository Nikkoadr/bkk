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
        <h1 class="m-0">Data Loker</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/home">Admin</a></li>
            <li class="breadcrumb-item active">Data Loker</li>
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
            <div class="card-header">
            <button type="button" class="btn btn-success m-1" data-toggle="modal" data-target="#modal_tambah_loker"><i class="fa-solid fa-address-card"></i> Tambah Loker</button>
            @include('layouts.partials.modal_tambah_loker')
            </div>
            <!-- /.card-header -->
            <div class="card-body">
            <table id="table_loker" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama loker</th>
                        <th>Deskripsi</th>
                        <th>Administrasi</th>
                        <th>Status Loker</th>
                        <th>grup WA</th>
                        <th data-orderable="false">Menu</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ( $data_loker as $data )
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $data->nama_loker }}</td>
                        <td>{{ $data->deskripsi }}</td>
                        <td>{{ $data->administrasi }}</td>
                        
                        <td>@if($data -> status_loker == 'aktif')
                            <span class="badge bg-green">Aktif</span>
                        @else
                            <span class="badge bg-red">Tidak Aktif</span>
                        @endif</td>
                        <td>{{ $data->grup_wa }}</td>
                        <td width="10%" style="text-align: center">
                            <div style="display: inline;">
                                <form action="/download_pelamar/{{ $data->id_loker }}" method="post">
                                @csrf
                                @method('put')
                                <button class="btn btn-primary" type="submit"><i class="fa-solid fa-file-arrow-down"></i></button>
                                </form>
                                <a class="btn btn-info" href="/edit_loker/{{ $data->id_loker }}"><i class="fa-solid fa-pen-to-square"></i></a>
                                <a class="btn btn-danger konfirmasi" href="/hapus_loker/{{ $data->id_loker }}"><i class="fa-solid fa-trash-can"></i></a>
                                
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
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
<!-- DataTables  & Plugins -->
<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('assets/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('assets/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<script src="{{ asset('assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#deskripsi'))
        .catch(error => {
            console.error(error);
        });
</script>
<script>
$(function () {
    bsCustomFileInput.init();
});
</script>
<script>
$(function () {
$("#table_loker").DataTable({
    "responsive": true, 
    "lengthChange": true, 
    "autoWidth": true, 
    "pageLength": 50,
    "aLengthMenu": [
        [25, 50, 100, 200, -1],
        [25, 50, 100, 200, "All"]
    ],
    "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
}).buttons().container().appendTo('#table_loker_wrapper .col-md-6:eq(0)');
});
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
