@extends('layouts.main_admin')

@section('title', 'Daftar Tes Interview')

@section('link')
<style>
    /* Tabel ringkas agar seluruh kolom, termasuk menu CRUD, muat di layar desktop. */
    #table_tes {
        font-size: 0.82rem;
    }
    #table_tes th,
    #table_tes td {
        padding: 0.55rem 0.45rem;
        white-space: normal;
    }
    #table_tes th {
        white-space: nowrap;
    }
</style>
@endsection

@section('content')
<div class="page-head">
    <div>
        <nav class="crumbs">
            <a href="/home">Admin</a>
            <i class="fa-solid fa-chevron-right"></i>
            <span>Daftar Tes Interview</span>
        </nav>
        <h1>Daftar Peserta Tes Interview</h1>
        <p>Kelola data peserta, jadwal, perangkat, dan link interview.</p>
    </div>
    <div class="page-actions d-flex flex-wrap gap-2">
        <a href="{{ route('tes.index') }}" target="_blank" rel="noopener" class="btn btn-light">
            <i class="fa-solid fa-eye"></i> Lihat Halaman Publik
        </a>
        <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#modal_import_tes">
            <i class="fa-solid fa-file-import"></i> Import Excel
        </button>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal_tambah_tes">
            <i class="fa-solid fa-plus"></i> Tambah Peserta
        </button>
    </div>
</div>

@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Periksa kembali data yang diisi:</strong>
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('error'))
    <div class="alert alert-warning">{{ session('error') }}</div>
@endif

<div class="panel">
    <div class="panel-head">
        <div>
            <h2>Filter Pencarian</h2>
            <p>Cari peserta berdasarkan nomor tes, nama, sekolah, hari, waktu, atau perangkat.</p>
        </div>
    </div>

    <div class="panel-body">
        <form method="GET" action="{{ route('tes.admin') }}" class="row g-2 align-items-end">
            <div class="col-sm-6 col-lg-2">
                <label for="filter_no_tes" class="form-label small fw-semibold">No Tes</label>
                <input type="text" id="filter_no_tes" name="no_tes" value="{{ request('no_tes') }}" class="form-control form-control-sm" placeholder="0255">
            </div>
            <div class="col-sm-6 col-lg-2">
                <label for="filter_nama" class="form-label small fw-semibold">Nama Lengkap</label>
                <input type="text" id="filter_nama" name="nama_lengkap" value="{{ request('nama_lengkap') }}" class="form-control form-control-sm" placeholder="Nama peserta">
            </div>
            <div class="col-sm-6 col-lg-2">
                <label for="filter_sekolah" class="form-label small fw-semibold">Asal Sekolah</label>
                <input type="text" id="filter_sekolah" name="asal_sekolah" value="{{ request('asal_sekolah') }}" class="form-control form-control-sm" placeholder="Nama sekolah">
            </div>
            <div class="col-sm-6 col-lg-2">
                <label for="filter_hari" class="form-label small fw-semibold">Hari</label>
                <select id="filter_hari" name="hari" class="form-select form-select-sm">
                    <option value="">-- Semua --</option>
                    @foreach ($hariOptions as $hari)
                        <option value="{{ $hari }}" @selected(request('hari') === $hari)>{{ $hari }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-6 col-lg-2">
                <label for="filter_waktu" class="form-label small fw-semibold">Waktu</label>
                <select id="filter_waktu" name="waktu" class="form-select form-select-sm">
                    <option value="">-- Semua --</option>
                    @foreach ($waktuOptions as $waktu)
                        <option value="{{ $waktu }}" @selected(request('waktu') === $waktu)>{{ $waktu }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-6 col-lg-2">
                <label for="filter_perangkat" class="form-label small fw-semibold">Perangkat</label>
                <select id="filter_perangkat" name="perangkat" class="form-select form-select-sm">
                    <option value="">-- Semua --</option>
                    @foreach ($perangkatOptions as $perangkat)
                        <option value="{{ $perangkat }}" @selected(request('perangkat') === $perangkat)>{{ $perangkat }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-12 d-flex flex-wrap gap-2 pt-1">
                <button type="submit" class="btn btn-primary btn-sm">
                    <i class="fa-solid fa-magnifying-glass"></i> Cari
                </button>
                <a href="{{ route('tes.admin') }}" class="btn btn-light btn-sm">
                    <i class="fa-solid fa-rotate-left"></i> Reset
                </a>
                <span class="ms-auto align-self-center text-muted small">
                    {{ $peserta->total() }} peserta ditemukan
                </span>
            </div>
        </form>
    </div>
</div>

<div class="panel">
    <div class="panel-head">
        <div>
            <h2>Data Peserta Tes</h2>
            <p>Gunakan tombol edit/hapus pada kolom menu untuk mengubah data.</p>
        </div>
        <span class="count-chip"><i class="fa-solid fa-clipboard-list"></i> {{ $peserta->total() }} peserta</span>
    </div>

    @php
        $baseQuery = collect(request()->query())->except('page')->all();
        $activeSort = in_array(request('sort'), ['no_tes', 'nama_lengkap', 'asal_sekolah', 'email', 'hari', 'waktu', 'perangkat'], true)
            ? request('sort')
            : 'no_tes';
        $activeDir = strtolower((string) request('dir')) === 'desc' ? 'desc' : 'asc';
        $sortLink = fn (string $column) => route('tes.admin', array_merge($baseQuery, [
            'sort' => $column,
            'dir' => ($activeSort === $column && $activeDir === 'asc') ? 'desc' : 'asc',
        ]));
        $sortIcon = fn (string $column) => $activeSort !== $column
            ? 'fa-sort'
            : ($activeDir === 'asc' ? 'fa-sort-up' : 'fa-sort-down');
    @endphp

    <div class="panel-body panel-body--flush">
        <form id="form_bulk_hapus_tes" action="{{ route('tes.bulk-destroy') }}" method="POST" class="d-none">
            @csrf
            @method('DELETE')
        </form>

        <div class="d-flex align-items-center gap-2 px-3 pt-3">
            <button type="submit" form="form_bulk_hapus_tes" id="btn_bulk_hapus_tes" class="btn btn-soft-danger btn-sm" disabled>
                <i class="fa-solid fa-trash-can"></i> Hapus Terpilih (<span id="jumlah_terpilih_tes">0</span>)
            </button>
            <span class="text-muted small">Centang data yang ingin dihapus sekaligus.</span>
        </div>

        <div class="table-responsive">
            <table class="table bkk-table align-middle" id="table_tes">
                <thead>
                    <tr>
                        <th style="width: 36px;">
                            <input type="checkbox" id="cek_semua_tes" class="form-check-input" title="Pilih semua peserta">
                        </th>
                        <th>No</th>
                        <th>
                            <a href="{{ $sortLink('no_tes') }}" class="text-reset text-decoration-none">
                                No Tes <i class="fa-solid {{ $sortIcon('no_tes') }} text-muted"></i>
                            </a>
                        </th>
                        <th>
                            <a href="{{ $sortLink('nama_lengkap') }}" class="text-reset text-decoration-none">
                                Nama Lengkap <i class="fa-solid {{ $sortIcon('nama_lengkap') }} text-muted"></i>
                            </a>
                        </th>
                        <th>
                            <a href="{{ $sortLink('asal_sekolah') }}" class="text-reset text-decoration-none">
                                Asal Sekolah <i class="fa-solid {{ $sortIcon('asal_sekolah') }} text-muted"></i>
                            </a>
                        </th>
                        <th>
                            <a href="{{ $sortLink('email') }}" class="text-reset text-decoration-none">
                                Email <i class="fa-solid {{ $sortIcon('email') }} text-muted"></i>
                            </a>
                        </th>
                        <th>
                            <a href="{{ $sortLink('hari') }}" class="text-reset text-decoration-none">
                                Hari <i class="fa-solid {{ $sortIcon('hari') }} text-muted"></i>
                            </a>
                        </th>
                        <th>
                            <a href="{{ $sortLink('waktu') }}" class="text-reset text-decoration-none">
                                Waktu <i class="fa-solid {{ $sortIcon('waktu') }} text-muted"></i>
                            </a>
                        </th>
                        <th>
                            <a href="{{ $sortLink('perangkat') }}" class="text-reset text-decoration-none">
                                Perangkat <i class="fa-solid {{ $sortIcon('perangkat') }} text-muted"></i>
                            </a>
                        </th>
                        <th>Link</th>
                        <th data-orderable="false">Menu</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($peserta as $item)
                        <tr>
                            <td>
                                <input type="checkbox" class="form-check-input cek_peserta_tes" name="ids[]"
                                       value="{{ $item->id }}" form="form_bulk_hapus_tes"
                                       aria-label="Pilih {{ $item->nama_lengkap }}">
                            </td>
                            <td>{{ $peserta->firstItem() + $loop->index }}</td>
                            <td class="fw-semibold">{{ $item->no_tes }}</td>
                            <td>{{ $item->nama_lengkap }}</td>
                            <td>{{ $item->asal_sekolah ?? '-' }}</td>
                            <td>{{ $item->email ?? '-' }}</td>
                            <td>{{ $item->hari ?? '-' }}</td>
                            <td>{{ $item->waktu ?? '-' }}</td>
                            <td>{{ $item->perangkat ?? '-' }}</td>
                            <td>
                                @if ($item->link)
                                    <a href="{{ $item->link }}" target="_blank" rel="noopener noreferrer" class="btn btn-sm btn-outline-primary">
                                        <i class="fa-solid fa-video"></i> Interview
                                    </a>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                <div class="action-group">
                                    <button type="button"
                                            class="btn btn-warning btn-icon btn-edit-tes"
                                            title="Edit peserta"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modal_edit_tes"
                                            data-action="{{ route('tes.update', $item->id) }}"
                                            data-no_tes="{{ $item->no_tes }}"
                                            data-nama_lengkap="{{ $item->nama_lengkap }}"
                                            data-asal_sekolah="{{ $item->asal_sekolah }}"
                                            data-email="{{ $item->email }}"
                                            data-hari="{{ $item->hari }}"
                                            data-waktu="{{ $item->waktu }}"
                                            data-perangkat="{{ $item->perangkat }}"
                                            data-link="{{ $item->link }}">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                    <form action="{{ route('tes.destroy', $item->id) }}" method="POST" class="d-inline form-hapus-tes">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-soft-danger btn-icon" title="Hapus peserta">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="11" class="text-center py-4 text-muted">
                                Belum ada data peserta tes. Tambahkan manual atau import file Excel/CSV.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if ($peserta->hasPages())
        <div class="panel-body">
            {{ $peserta->appends(request()->query())->links('pagination::bootstrap-5') }}
        </div>
    @endif
</div>

{{-- Modal Tambah --}}
<div class="modal fade" id="modal_tambah_tes" tabindex="-1" aria-labelledby="modal_tambah_tesLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('tes.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_tambah_tesLabel">Tambah Peserta Tes</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <label class="form-label">No Tes <span class="text-danger">*</span></label>
                            <input type="text" name="no_tes" class="form-control" value="{{ old('no_tes') }}" placeholder="Contoh: 0255" required>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" name="nama_lengkap" class="form-control" value="{{ old('nama_lengkap') }}" required>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label">Asal Sekolah</label>
                            <input type="text" name="asal_sekolah" class="form-control" value="{{ old('asal_sekolah') }}">
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label">Hari</label>
                            <input type="text" name="hari" class="form-control" value="{{ old('hari') }}" placeholder="Contoh: HARI PERTAMA">
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label">Waktu</label>
                            <input type="text" name="waktu" class="form-control" value="{{ old('waktu') }}" placeholder="Contoh: 09:00 - 09:20">
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label">Perangkat</label>
                            <input type="text" name="perangkat" class="form-control" value="{{ old('perangkat') }}" placeholder="Contoh: COMP 01">
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label">Link Interview</label>
                            <input type="url" name="link" class="form-control" value="{{ old('link') }}" placeholder="https://interview.kitahq.com/...">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Modal Edit --}}
<div class="modal fade" id="modal_edit_tes" tabindex="-1" aria-labelledby="modal_edit_tesLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <form id="form_edit_tes" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_edit_tesLabel">Edit Peserta Tes</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <label class="form-label">No Tes <span class="text-danger">*</span></label>
                            <input type="text" name="no_tes" class="form-control" required>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" name="nama_lengkap" class="form-control" required>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label">Asal Sekolah</label>
                            <input type="text" name="asal_sekolah" class="form-control">
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control">
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label">Hari</label>
                            <input type="text" name="hari" class="form-control">
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label">Waktu</label>
                            <input type="text" name="waktu" class="form-control">
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label">Perangkat</label>
                            <input type="text" name="perangkat" class="form-control">
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label">Link Interview</label>
                            <input type="url" name="link" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Modal Import --}}
<div class="modal fade" id="modal_import_tes" tabindex="-1" aria-labelledby="modal_import_tesLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('tes.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_import_tesLabel">Import Peserta Tes</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-2">Urutan kolom file Excel/CSV:</p>
                    <div class="table-responsive mb-3">
                        <table class="table table-sm table-bordered mb-0 small text-nowrap" style="min-width: 720px;">
                            <thead class="table-light">
                                <tr>
                                    <th>no_tes</th>
                                    <th>nama_lengkap</th>
                                    <th>asal_sekolah</th>
                                    <th>email</th>
                                    <th>hari</th>
                                    <th>waktu</th>
                                    <th>perangkat</th>
                                    <th>link</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>0255</td>
                                    <td>ADITIYA</td>
                                    <td>SMKN 1 GABUSWETAN</td>
                                    <td>yaa9024@gmail.com</td>
                                    <td>HARI PERTAMA</td>
                                    <td>09:00 - 09:20</td>
                                    <td>COMP 01</td>
                                    <td>https://interview.kitahq.com/...</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">File Excel/CSV <span class="text-danger">*</span></label>
                        <input type="file" name="file" class="form-control" accept=".xlsx,.xls,.csv" required>
                    </div>
                    <p class="text-muted small mb-0">
                        Baris pertama boleh berisi nama kolom seperti di atas atau langsung data.
                        No tes yang sudah ada akan diperbarui, no tes baru akan ditambahkan.
                        Maksimal 5000 baris per file.
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">
                        <i class="fa-solid fa-file-import"></i> Import
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
document.addEventListener('DOMContentLoaded', function () {
    var editModal = document.getElementById('modal_edit_tes');
    if (editModal) {
        editModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            var form = document.getElementById('form_edit_tes');
            if (!button || !form) return;

            form.action = button.getAttribute('data-action') || '';

            ['no_tes', 'nama_lengkap', 'asal_sekolah', 'email', 'hari', 'waktu', 'perangkat', 'link'].forEach(function (field) {
                var input = form.querySelector('[name="' + field + '"]');
                if (input) {
                    input.value = button.getAttribute('data-' + field) || '';
                }
            });
        });
    }

    document.querySelectorAll('.form-hapus-tes').forEach(function (form) {
        form.addEventListener('submit', function (event) {
            event.preventDefault();
            Swal.fire({
                title: 'Hapus peserta tes?',
                text: 'Data peserta akan dihapus permanen.',
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

    var cekSemua = document.getElementById('cek_semua_tes');
    var cekPeserta = Array.prototype.slice.call(document.querySelectorAll('.cek_peserta_tes'));
    var btnBulkHapus = document.getElementById('btn_bulk_hapus_tes');
    var jumlahTerpilih = document.getElementById('jumlah_terpilih_tes');
    var formBulkHapus = document.getElementById('form_bulk_hapus_tes');

    function jumlahPesertaTerpilih() {
        return cekPeserta.filter(function (checkbox) {
            return checkbox.checked;
        }).length;
    }

    function perbaruiPilihanTes() {
        var terpilih = jumlahPesertaTerpilih();

        if (jumlahTerpilih) jumlahTerpilih.textContent = terpilih;
        if (btnBulkHapus) btnBulkHapus.disabled = terpilih === 0;

        if (cekSemua) {
            cekSemua.checked = terpilih > 0 && terpilih === cekPeserta.length;
            cekSemua.indeterminate = terpilih > 0 && terpilih < cekPeserta.length;
        }
    }

    if (cekSemua) {
        cekSemua.addEventListener('change', function () {
            cekPeserta.forEach(function (checkbox) {
                checkbox.checked = cekSemua.checked;
            });
            perbaruiPilihanTes();
        });
    }

    cekPeserta.forEach(function (checkbox) {
        checkbox.addEventListener('change', perbaruiPilihanTes);
    });

    if (btnBulkHapus && formBulkHapus) {
        btnBulkHapus.addEventListener('click', function (event) {
            event.preventDefault();

            var terpilih = jumlahPesertaTerpilih();
            if (terpilih === 0) return;

            Swal.fire({
                title: 'Hapus ' + terpilih + ' peserta tes?',
                text: 'Semua data yang dipilih akan dihapus permanen.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33d4d',
                cancelButtonColor: '#6b7c93',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then(function (result) {
                if (result.isConfirmed) {
                    formBulkHapus.submit();
                }
            });
        });
    }
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

@if ($errors->any())
    Swal.fire({
        icon: 'error',
        title: 'Data belum lengkap',
        text: @json($errors->first())
    });
@endif
</script>
@endsection
