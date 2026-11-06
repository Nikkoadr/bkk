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

<div class="modal fade" id="modal_tambah_loker" tabindex="-1" aria-labelledby="modalTambahLokerLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <div>
                    <h5 class="modal-title" id="modalTambahLokerLabel">
                        <i class="fa-solid fa-building-circle-check"></i>
                        Form Input Loker
                    </h5>
                    <p class="modal-sub">Lengkapi informasi lowongan dan pilih field yang tampil di formulir pendaftar.</p>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>

            <div class="modal-body">
                <form action="{{ route('tambah_loker') }}" method="POST">
                    @csrf

                    <div class="form-section"><i class="fa-solid fa-circle-info"></i> Informasi Loker</div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama_loker"><i class="fa-solid fa-building mr-1"></i> Nama Perusahaan <span class="text-danger">*</span></label>
                                <input type="text" name="nama_loker" id="nama_loker" class="form-control" placeholder="cth: PT. Astra Honda Motor" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="posisi"><i class="fa-solid fa-briefcase mr-1"></i> Posisi <span class="text-danger">*</span></label>
                                <input type="text" name="posisi" id="posisi" class="form-control" placeholder="cth: Operator Produksi" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="deskripsi"><i class="fa-solid fa-file-lines mr-1"></i> Deskripsi / Kualifikasi</label>
                        <textarea name="deskripsi" id="deskripsi" class="form-control" placeholder="Syarat, kualifikasi, dan info loker..."></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="administrasi"><i class="fa-solid fa-money-bill-wave mr-1"></i> Administrasi (Rp) <span class="text-danger">*</span></label>
                                <input type="number" min="0" name="administrasi" id="administrasi" class="form-control" placeholder="50000" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="status_loker"><i class="fa-solid fa-toggle-on mr-1"></i> Status Loker <span class="text-danger">*</span></label>
                                <select name="status_loker" id="status_loker" class="form-select">
                                    <option value="aktif">Aktif</option>
                                    <option value="tidak aktif">Tidak Aktif</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="grup_wa"><i class="fa-brands fa-whatsapp mr-1" style="color:#0f9d68;"></i> Link Grup WA <span class="text-danger">*</span></label>
                                <input type="url" name="grup_wa" id="grup_wa" class="form-control" placeholder="https://chat.whatsapp.com/..." required>
                            </div>
                        </div>
                    </div>

                    <div class="form-section"><i class="fa-solid fa-sliders"></i> Field yang Tampil di Formulir Pendaftar</div>

                    <div class="row">
                        @foreach ($toggles as $field => $meta)
                            <div class="col-md-6 col-lg-3">
                                <div class="form-group">
                                    <label><i class="{{ $meta['icon'] }} mr-1"></i> {{ $meta['label'] }}</label>
                                    <div class="radio-row">
                                        <label class="radio-pill">
                                            <input type="radio" name="{{ $field }}" value="aktif" checked>
                                            <span>Tampil</span>
                                        </label>
                                        <label class="radio-pill is-off">
                                            <input type="radio" name="{{ $field }}" value="tidak aktif">
                                            <span>Sembunyi</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="form-actions">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fa-solid fa-floppy-disk"></i>
                            Simpan Loker
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
