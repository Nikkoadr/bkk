@extends('layouts.main_admin')

@section('link')
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"><h1 class="m-0">Status Pelamar</h1></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/home">Admin</a></li>
                        <li class="breadcrumb-item active">Data pelamar</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="filter_loker">Filter Nama PT</label>
                                    <select id="filter_loker" class="form-control">
                                        <option value="">-- Semua PT --</option>
                                        @foreach(\App\Models\Loker::all() as $loker)
                                            <option value="{{ $loker->nama_loker }}">{{ $loker->nama_loker }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="filter_bayar">Filter Status Bayar</label>
                                    <select id="filter_bayar" class="form-control">
                                        <option value="">-- Semua Status --</option>
                                        <option value="sudah">Sudah Bayar</option>
                                        <option value="menunggu">Menunggu</option>
                                        <option value="belum">Belum Bayar</option>
                                    </select>
                                </div>
                            </div>

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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
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

$(document).ready(function() {

    function renderStatusBadge(status) {
        switch(status) {
            case 'sudah':
                return '<span class="badge bg-success">Sudah</span>';
            case 'menunggu':
                return '<span class="badge bg-warning text-dark">Menunggu</span>';
            case 'belum':
                return '<span class="badge bg-danger">Belum</span>';
            default:
                return '<span class="badge bg-secondary">Unknown</span>';
        }
    }

    let table = $('#tabel_pelamar').DataTable({
        responsive: true,
        lengthChange: true,
        autoWidth: true,
        processing: true,
        serverSide: true,
        searching: true,
        ajax: {
            url: '/get_data_pelamar',
            type: 'GET',
            data: function (d) {
                d.filter_loker = $('#filter_loker').val();
                d.filter_bayar = $('#filter_bayar').val();
            }
        },
        order: [
            [2, 'asc'],
            [4, 'asc']
        ],
        lengthMenu: [
            [10, 25, 50, -1],
            [10, 25, 50, "Semua"]
        ],
        columns: [
            { 
                data: null, 
                orderable: false, 
                searchable: false, 
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            { data: 'code_pendaftaran', name: 'code_pendaftaran' },
            { data: 'nama', name: 'nama' },
            { 
                data: 'nomor_wa', 
                name: 'nomor_wa',
                render: function(data, type, row) {
                    var nomor = data.startsWith('0') ? '62' + data.substring(1) : data;
                    var message = `Assalamu'alaikum Wr Wb ka.\nKami dari BKK SMK Muhammadiyah ingin mengonfirmasi status pendaftaran kaka *${row.code_pendaftaran}*. Mohon balas chat kami. Terimakasih.`;
                    return `<a href="https://wa.me/${nomor}?text=${encodeURIComponent(message)}" target="_blank">${data}</a>`;
                }
            },
            { 
                data: 'status_bayar', 
                name: 'status_bayar',
                render: function(data, type, row) {
                    let badge = renderStatusBadge(data);
                    if (data !== 'sudah') {
                        badge += ` <button class="btn btn-sm btn-success update-status" data-id="${row.id}">
                                    <i class="fa-solid fa-check"></i>
                                  </button>`;
                    }
                    return badge;
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

    $('#filter_loker, #filter_bayar').on('change', function () {
        table.ajax.reload();
    });

    $('#tabel_pelamar').on('click', '.delete-btn', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        deleteConfirmation(id);
    });

    $('#tabel_pelamar').on('click', '.update-status', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        Swal.fire({
            title: 'Konfirmasi?',
            text: "Anda yakin ingin mengubah status pembayaran menjadi sudah?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, konfirmasi!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/update_status_pembayaran/' + id,
                    type: 'POST',
                    data: { _token: '{{ csrf_token() }}' },
                    success: function(response) {
                        if (response.success) {
                            Swal.fire('Berhasil!', response.message, 'success');
                            table.ajax.reload(null, false);
                        } else {
                            Swal.fire('Gagal!', response.message, 'error');
                        }
                    },
                    error: function() {
                        Swal.fire('Gagal!', 'Terjadi kesalahan saat memproses permintaan.', 'error');
                    }
                });
            }
        });
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
            window.location.href = '{{ url("hapus_pelamar") }}/' + id;
        }
    });
}
</script>
@endsection
