@extends('layouts.main_admin')

@section('title', 'Data Loker')

@section('link')
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection

@section('content')
<div class="page-head">
    <div>
        <nav class="crumbs">
            <a href="/home">Admin</a>
            <i class="fa-solid fa-chevron-right"></i>
            <span>Data Loker</span>
        </nav>
        <h1>Data Loker</h1>
        <p>Kelola informasi lowongan, deskripsi, administrasi, dan grup WhatsApp pendaftar.</p>
    </div>
    <div class="page-actions">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal_tambah_loker">
            <i class="fa-solid fa-plus"></i>
            Tambah Loker
        </button>
    </div>
</div>

<div class="panel">
    <div class="panel-head">
        <div>
            <h2>Daftar Lowongan</h2>
            <p>Deskripsi ditampilkan ringkas; klik "Lihat detail" untuk membaca versi lengkapnya.</p>
        </div>
        <span class="count-chip"><i class="fa-solid fa-building"></i> {{ $data_loker->count() }} loker</span>
    </div>

    <div class="panel-body panel-body--flush">
        <div class="table-responsive">
            <table id="table_loker" class="table bkk-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Loker</th>
                        <th>Posisi</th>
                        <th>Deskripsi</th>
                        <th>Administrasi</th>
                        <th>Status</th>
                        <th>Grup WA</th>
                        <th data-orderable="false">Menu</th>
                        <th data-orderable="false">Hapus Pelamar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data_loker as $data)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <span class="table-company">{{ $data->nama_loker }}</span>
                                <span class="table-sub">{{ \Illuminate\Support\Str::limit($data->posisi, 40) }}</span>
                            </td>
                            <td>{{ $data->posisi }}</td>
                            <td>
                                <div class="desc-preview">
                                    {{ $data->deskripsi_plain !== '' ? \Illuminate\Support\Str::limit($data->deskripsi_plain, 110) : 'Belum ada deskripsi.' }}
                                </div>
                                @if ($data->deskripsi_plain !== '')
                                    <button type="button"
                                            class="btn-desc"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalDeskripsi"
                                            data-title="{{ $data->nama_loker }} — {{ $data->posisi }}"
                                            data-desc="{{ $data->deskripsi }}">
                                        <i class="fa-regular fa-eye"></i> Lihat detail
                                    </button>
                                @endif
                            </td>
                            <td>Rp {{ number_format($data->administrasi, 0, ',', '.') }}</td>
                            <td>
                                @if ($data->status_loker === 'aktif')
                                    <span class="pill pill-success">Aktif</span>
                                @else
                                    <span class="pill pill-muted">Tidak Aktif</span>
                                @endif
                            </td>
                            <td>
                                @if ($data->grup_wa)
                                    <a href="{{ $data->grup_wa }}" target="_blank" rel="noopener" class="btn btn-success btn-sm">
                                        <i class="fa-brands fa-whatsapp"></i> Gabung
                                    </a>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                <div class="action-group">
                                    <form action="/download_pelamar/{{ $data->id_loker }}" method="post" class="d-inline">
                                        @csrf
                                        @method('put')
                                        <button class="btn btn-info btn-icon" type="submit" title="Download data pelamar">
                                            <i class="fa-solid fa-file-arrow-down"></i>
                                        </button>
                                    </form>
                                    <a class="btn btn-warning btn-icon" href="/edit_loker/{{ $data->id_loker }}" title="Edit loker">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <form action="{{ route('hapus_loker', $data->id_loker) }}" method="post" class="d-inline form-hapus-loker">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-soft-danger btn-icon konfirmasi" type="submit" title="Hapus loker">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                            <td>
                                <form action="{{ route('hapus_seluruh_pelamar', $data->id_loker) }}" method="post" class="d-inline form-hapus-pelamar">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger btn-sm konfirmasi_hapus_pelamar" type="submit">
                                        <i class="fa-solid fa-user-xmark"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@include('layouts.partials.modal_tambah_loker')

{{-- Modal detail deskripsi: menampilkan HTML yang sudah disanitasi di server --}}
<div class="modal fade" id="modalDeskripsi" tabindex="-1" aria-labelledby="modalDeskripsiLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <div>
                    <h5 class="modal-title" id="modalDeskripsiLabel">
                        <i class="fa-solid fa-file-lines"></i>
                        <span>Deskripsi Loker</span>
                    </h5>
                    <p class="modal-sub">Informasi kualifikasi dan detail lowongan.</p>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                <div class="job-desc"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
{{-- DataTables & plugins --}}
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
<script src="{{ asset('assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/ckeditor.js"></script>

<script>
    ClassicEditor
        .create(document.querySelector('#deskripsi'))
        .catch(function (error) {
            console.error(error);
        });
</script>

<script>
$(function () {
    if (typeof bsCustomFileInput !== 'undefined') {
        bsCustomFileInput.init();
    }

    $("#table_loker").DataTable({
        "responsive": true,
        "lengthChange": true,
        "autoWidth": false,
        "pageLength": 50,
        "aLengthMenu": [
            [25, 50, 100, 200, -1],
            [25, 50, 100, 200, "Semua"]
        ],
        "language": {
            "search": "Cari:",
            "lengthMenu": "Tampilkan _MENU_ data",
            "info": "Menampilkan _START_–_END_ dari _TOTAL_ data",
            "infoEmpty": "Tidak ada data",
            "infoFiltered": "(difilter dari _MAX_ total data)",
            "zeroRecords": "Data tidak ditemukan",
            "paginate": {
                "first": "Awal",
                "last": "Akhir",
                "next": "Berikutnya",
                "previous": "Sebelumnya"
            }
        },
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
        "dom": '<"dt-top"lBf>rt<"dt-bottom"ip>'
    });
});
</script>

<script>
@if (session()->has('success'))
    Swal.fire({
        toast: true,
        position: 'top-end',
        icon: 'success',
        title: @json(session('success')),
        showConfirmButton: false,
        timer: 5000,
        timerProgressBar: true
    });
@endif
</script>

<script>
document.querySelectorAll('.form-hapus-loker').forEach(function (form) {
    form.addEventListener('submit', function (event) {
        event.preventDefault();
        Swal.fire({
            title: 'Hapus loker ini?',
            text: 'Data loker dan seluruh pelamarnya akan dihapus permanen.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33d4d',
            cancelButtonColor: '#6b7c93',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then(function (result) {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
});

document.querySelectorAll('.form-hapus-pelamar').forEach(function (form) {
    form.addEventListener('submit', function (event) {
        event.preventDefault();
        Swal.fire({
            title: 'Hapus seluruh pelamar?',
            text: 'Semua data pelamar pada loker ini akan dihapus permanen.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33d4d',
            cancelButtonColor: '#6b7c93',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then(function (result) {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
});
</script>
@endsection
