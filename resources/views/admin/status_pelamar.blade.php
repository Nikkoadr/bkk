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
        <h1 class="m-0">Status Pelamar</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/home">Admin</a></li>
            <li class="breadcrumb-item active">Data pelamar</li>
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
            <table id="tabel_pelamar" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Code</th>
                        <th>Nama Pendaftar</th>
                        <th>Nomor Whatsapp</th>
                        <th>Status Bayar</th>
                        <th>Bukti Transfer</th>
                        <th data-orderable="false">Menu</th>
                    </tr>
                </thead>
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
<script>
$(function () {
    bsCustomFileInput.init();
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
    $(document).ready(function() {
    function renderStatusBadge(data) {
        const statusMap = {
            'sudah': { class: 'badge bg-success', text: 'Sudah' },
            'menunggu': { class: 'badge bg-warning text-dark', text: 'Menunggu' },
            'belum': { class: 'badge bg-danger', text: 'Belum' },
            'default': { class: 'badge bg-secondary', text: 'Unknown' }
        };
        const status = statusMap[data] || statusMap['default'];
        return `<span class="${status.class}">${status.text}</span>`;
    }

    $('#tabel_pelamar').DataTable({
        responsive: true,
        lengthChange: true,
        autoWidth: true,
        processing: true,
        serverSide: true,
        searching: true,
        ajax: {
            url: '{{ route("get_data_pelamar") }}',
            type: 'GET'
        },
        columns: [
            { data: null, orderable: false, searchable: false, 
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            { data: 'code_pendaftaran', name: 'code_pendaftaran' },
            { data: 'nama', name: 'nama' },
            { data: 'nomor_wa', name: 'nomor_wa' },
            { 
                data: 'status_bayar', 
                name: 'status_bayar',
                render: function (data) {
                    return renderStatusBadge(data);
                }
            },
            { data: 'bukti_transfer', name: 'bukti_transfer', orderable: false, searchable: false },
            { 
                data: 'id', 
                name: 'action', 
                orderable: false, 
                searchable: false,
                render: function(data) {
                    var editUrl = '{{ route("edit_pelamar", ":id") }}'.replace(':id', data);
                    return `
                        <a href="${editUrl}" class="btn btn-sm btn-primary">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <button class="btn btn-sm btn-danger delete-btn" data-id="${data}">
                            <i class="fa-solid fa-trash-can"></i>
                        </button>
                    `;
                }
            }
        ]
    });

    $('#tabel_pelamar').on('click', '.delete-btn', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        deleteConfirmation(id);
    });
});

function deleteConfirmation(id) {
    Swal.fire({
        title: 'Anda yakin?',
        text: "Data ini akan dihapus secara permanen!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            var url = '/hapus_pelamar/' + id;
            window.location.href = url;
        }
    });
}
</script>
@endsection
