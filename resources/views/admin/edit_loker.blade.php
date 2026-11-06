@extends('layouts.main_admin')

@section('title', 'Edit Loker')

@section('content')
@php
    $toggles = [
        'form_npwp' => ['label' => 'NPWP', 'icon' => 'fa-solid fa-id-card'],
        'form_npsn' => ['label' => 'NPSN', 'icon' => 'fa-solid fa-school'],
        'form_nilai_ijazah' => ['label' => 'Nilai Ijazah', 'icon' => 'fa-solid fa-award'],
        'form_nilai_matematika' => ['label' => 'Nilai Matematika', 'icon' => 'fa-solid fa-calculator'],
        'form_domisili' => ['label' => 'Domisili', 'icon' => 'fa-solid fa-location-dot'],
        'form_pernah_mengikuti_reqrutment_calon_karyawan' => ['label' => 'Riwayat Rekrutmen', 'icon' => 'fa-solid fa-clock-rotate-left'],
        'form_pernah_bekerja' => ['label' => 'Riwayat Bekerja', 'icon' => 'fa-solid fa-briefcase'],
        'form_vaksin' => ['label' => 'Data Vaksin', 'icon' => 'fa-solid fa-syringe'],
    ];
@endphp

<div class="page-head">
    <div>
        <nav class="crumbs">
            <a href="/home">Admin</a>
            <i class="fa-solid fa-chevron-right"></i>
            <a href="{{ route('data_loker') }}">Data Loker</a>
            <i class="fa-solid fa-chevron-right"></i>
            <span>Edit</span>
        </nav>
        <h1>Edit Loker</h1>
        <p>Perbarui informasi lowongan {{ $data->nama_loker }} — {{ $data->posisi }}.</p>
    </div>
    <div class="page-actions">
        <a href="{{ route('data_loker') }}" class="btn btn-light">
            <i class="fa-solid fa-arrow-left"></i>
            Kembali
        </a>
    </div>
</div>

<div class="panel">
    <div class="panel-head">
        <div>
            <h2>Detail Lowongan</h2>
            <p>Perubahan akan langsung tampil di halaman pendaftaran.</p>
        </div>
        @if ($data->status_loker === 'aktif')
            <span class="pill pill-success">Aktif</span>
        @else
            <span class="pill pill-muted">Tidak Aktif</span>
        @endif
    </div>

    <div class="panel-body">
        <form action="/update_loker/{{ $data->id_loker }}" method="post">
            @csrf
            @method('put')

            <div class="form-section"><i class="fa-solid fa-circle-info"></i> Informasi Utama</div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nama_loker">Nama Perusahaan</label>
                        <input type="text" class="form-control" name="nama_loker" id="nama_loker" value="{{ $data->nama_loker }}" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="posisi">Posisi</label>
                        <input type="text" class="form-control" name="posisi" id="posisi" value="{{ $data->posisi }}" required>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="deskripsi">Deskripsi / Kualifikasi</label>
                <textarea class="form-control" name="deskripsi" id="deskripsi" required>{{ $data->deskripsi }}</textarea>
                <span class="text-muted" style="display:block;margin-top:.35rem;font-size:.74rem;">
                    Gunakan editor untuk memformat daftar syarat agar rapi saat ditampilkan ke pendaftar.
                </span>
            </div>

            <div class="form-section"><i class="fa-solid fa-sliders"></i> Detail &amp; Publikasi</div>

            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="administrasi">Administrasi (Rp)</label>
                        <input type="number" class="form-control" name="administrasi" id="administrasi" value="{{ $data->administrasi }}" required>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="status_loker">Status Loker</label>
                        <select class="form-select" name="status_loker" id="status_loker" required>
                            <option value="aktif" {{ $data->status_loker == 'aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="tidak aktif" {{ $data->status_loker == 'tidak aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="grup_wa">Link Grup WA</label>
                        <input type="text" class="form-control" name="grup_wa" id="grup_wa" value="{{ $data->grup_wa }}" required>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="created_at">Dibuat Pada</label>
                        <input type="text" class="form-control" name="created_at" id="created_at" value="{{ \Carbon\Carbon::parse($data->created_at)->format('d M Y H:i') }}" readonly>
                    </div>
                </div>
            </div>

            <div class="form-section"><i class="fa-solid fa-list-check"></i> Field yang Tampil di Formulir Pendaftar</div>

            <div class="row">
                @foreach ($toggles as $field => $meta)
                    <div class="col-md-6 col-lg-3">
                        <div class="form-group">
                            <label><i class="{{ $meta['icon'] }} mr-1"></i> {{ $meta['label'] }}</label>
                            <div class="radio-row">
                                <label class="radio-pill">
                                    <input type="radio" name="{{ $field }}" value="aktif" {{ $data->{$field} == 'aktif' ? 'checked' : '' }} required>
                                    <span>Tampil</span>
                                </label>
                                <label class="radio-pill is-off">
                                    <input type="radio" name="{{ $field }}" value="tidak aktif" {{ $data->{$field} == 'tidak aktif' ? 'checked' : '' }} required>
                                    <span>Sembunyi</span>
                                </label>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="form-actions">
                <a href="{{ route('data_loker') }}" class="btn btn-light">Batal</a>
                <button type="submit" class="btn btn-primary">
                    <i class="fa-solid fa-floppy-disk"></i>
                    Update Loker
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('script')
<script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#deskripsi'))
        .catch(function (error) {
            console.error(error);
        });

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
@endsection
