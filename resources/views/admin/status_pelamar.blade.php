@extends('layouts.main_admin')

@section('title', 'Status Pelamar')

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
            <span>Status Pelamar</span>
        </nav>
        <h1>Status Pelamar</h1>
        <p>Pantau pembayaran, verifikasi bukti transfer, dan data pelamar setiap lowongan.</p>
    </div>
</div>

<div class="panel">
    <div class="panel-head">
        <div>
            <h2>Daftar Pelamar</h2>
            <p>Gunakan filter untuk mempersempit data berdasarkan perusahaan atau status pembayaran.</p>
        </div>
        <span class="count-chip"><i class="fa-solid fa-users"></i> Data real-time</span>
    </div>

    <div class="panel-body" style="padding-bottom:.35rem;">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group mb-2">
                    <label for="filter_loker">Filter Nama PT</label>
                    <select id="filter_loker" class="form-select">
                        <option value="">Semua PT</option>
                        @foreach (\App\Models\Loker::orderBy('nama_loker')->get() as $loker)
                            <option value="{{ $loker->id_loker }}" {{ request('loker_id') == $loker->id_loker ? 'selected' : '' }}>
                                {{ $loker->nama_loker }} — {{ $loker->posisi }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-2">
                    <label for="filter_bayar">Filter Status Bayar</label>
                    <select id="filter_bayar" class="form-select">
                        <option value="">Semua Status</option>
                        <option value="sudah">Sudah Bayar</option>
                        <option value="menunggu">Menunggu</option>
                        <option value="belum">Belum Bayar</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="panel-body panel-body--flush">
        <table id="tabel_pelamar" class="table bkk-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Code</th>
                    <th>Nama Pendaftar</th>
                    <th>Nomor WhatsApp</th>
                    <th>Status Bayar</th>
                    <th>Bukti Transfer</th>
                    <th data-orderable="false">Menu</th>
                </tr>
            </thead>
        </table>
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
<script src="{{ asset('assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>

<script>
    // Notifikasi sukses saat halaman dimuat (jika ada session flash)
    function showSuccessToast(message) {
        if (typeof Swal === 'undefined') {
            return;
        }
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'success',
            title: message,
            showConfirmButton: false,
            timer: 5000,
            timerProgressBar: true
        });
    }

    document.addEventListener('DOMContentLoaded', function () {
        @if (session()->has('success'))
            if (typeof Swal !== 'undefined') {
                showSuccessToast(@json(session('success')));
            } else {
                document.addEventListener('swal:ready', function () {
                    showSuccessToast(@json(session('success')));
                });
            }
        @endif
    });
</script>

<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>

<script>
$(function () {
    if (typeof bsCustomFileInput !== 'undefined') {
        bsCustomFileInput.init();
    }

    function renderStatusBadge(status) {
        switch (status) {
            case 'sudah':
                return '<span class="pill pill-success">Sudah</span>';
            case 'menunggu':
                return '<span class="pill pill-warning">Menunggu</span>';
            case 'belum':
                return '<span class="pill pill-danger">Belum</span>';
            default:
                return '<span class="pill pill-muted">Unknown</span>';
        }
    }

    let table = $('#tabel_pelamar').DataTable({
        responsive: true,
        lengthChange: true,
        autoWidth: false,
        processing: true,
        serverSide: true,
        searching: true,
        ajax: {
            url: '/get_data_pelamar',
            type: 'GET',
            data: function (d) {
                d.filter_loker_id = $('#filter_loker').val();
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
        language: {
            search: "Cari:",
            lengthMenu: "Tampilkan _MENU_ data",
            info: "Menampilkan _START_–_END_ dari _TOTAL_ data",
            infoEmpty: "Tidak ada data",
            infoFiltered: "(difilter dari _MAX_ total data)",
            zeroRecords: "Data tidak ditemukan",
            processing: "Memuat data...",
            paginate: {
                first: "Awal",
                last: "Akhir",
                next: "Berikutnya",
                previous: "Sebelumnya"
            }
        },
        buttons: ["copy", "csv", "excel", "print", "colvis"],
        dom: '<"dt-top"lBf>rt<"dt-bottom"ip>',
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
                render: function (data, type, row) {
                    var nomor = data.startsWith('0') ? '62' + data.substring(1) : data;
                    var message = `Assalamu'alaikum Wr Wb ka.\nKami dari BKK SMK Muhammadiyah ingin mengonfirmasi status pendaftaran kaka *${row.code_pendaftaran}*. Mohon balas chat kami. Terimakasih.`;
                    return `<a href="https://wa.me/${nomor}?text=${encodeURIComponent(message)}" target="_blank" rel="noopener"><i class="fa-brands fa-whatsapp" style="color:#0f9d68;margin-right:.3rem;"></i>${data}</a>`;
                }
            },
            {
                data: 'status_bayar',
                name: 'status_bayar',
                render: function (data, type, row) {
                    let badge = renderStatusBadge(data);
                    if (data !== 'sudah') {
                        badge += ` <button class="btn btn-success btn-icon update-status" data-id="${row.id}" title="Tandai sudah bayar">
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
                render: function (data) {
                    var editUrl = '{{ route("edit_pelamar", ":id") }}'.replace(':id', data);
                    return `
                        <div class="action-group">
                            <a href="${editUrl}" class="btn btn-warning btn-icon" title="Edit pelamar">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <button class="btn btn-soft-danger btn-icon delete-btn" data-id="${data}" title="Hapus pelamar">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </div>
                    `;
                }
            }
        ]
    });

    $('#filter_loker, #filter_bayar').on('change', function () {
        table.ajax.reload();
    });

    $('#tabel_pelamar').on('click', '.delete-btn', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        deleteConfirmation(id);
    });

    $('#tabel_pelamar').on('click', '.update-status', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        Swal.fire({
            title: 'Konfirmasi pembayaran?',
            text: 'Status pembayaran akan diubah menjadi sudah bayar.',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#0b6bcb',
            cancelButtonColor: '#6b7c93',
            confirmButtonText: 'Ya, konfirmasi!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/update_status_pembayaran/' + id,
                    type: 'POST',
                    data: { _token: '{{ csrf_token() }}' },
                    success: function (response) {
                        if (response.success) {
                            Swal.fire('Berhasil!', response.message, 'success');
                            table.ajax.reload(null, false);
                        } else {
                            Swal.fire('Gagal!', response.message, 'error');
                        }
                    },
                    error: function () {
                        Swal.fire('Gagal!', 'Terjadi kesalahan saat memproses permintaan.', 'error');
                    }
                });
            }
        });
    });
});

function deleteConfirmation(id) {
    Swal.fire({
        title: 'Hapus data pelamar?',
        text: 'Data ini akan dihapus secara permanen.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33d4d',
        cancelButtonColor: '#6b7c93',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '{{ url("hapus_pelamar") }}/' + id,
                type: 'POST',
                data: { _token: '{{ csrf_token() }}', _method: 'DELETE' },
                success: function () {
                    Swal.fire('Berhasil!', 'Data pelamar berhasil dihapus.', 'success');
                    $('#tabel_pelamar').DataTable().ajax.reload(null, false);
                },
                error: function () {
                    Swal.fire('Gagal!', 'Terjadi kesalahan saat menghapus data.', 'error');
                }
            });
        }
    });
}
</script>
@endsection
