<style>
    #modal_tambah_loker .modal-content { border: none; border-radius: 1rem; overflow: hidden; }
    #modal_tambah_loker .modal-header {
        background: linear-gradient(135deg, #0a4b8a, #2b8cdf);
        color: #fff; border-bottom: none; padding: 1.1rem 1.5rem;
    }
    #modal_tambah_loker .modal-header .close { color: #fff; opacity: .8; text-shadow: none; }
    #modal_tambah_loker .modal-header .close:hover { opacity: 1; }
    #modal_tambah_loker .modal-body { padding: 1.5rem; background: #f8fcff; }
    #modal_tambah_loker .section-title {
        font-size: .8rem; font-weight: 700; text-transform: uppercase; letter-spacing: .5px;
        color: #0a4b8a; margin: 1.25rem 0 .75rem; padding-bottom: .4rem;
        border-bottom: 2px solid #d4e8fc; display: flex; align-items: center; gap: .5rem;
    }
    #modal_tambah_loker .section-title:first-child { margin-top: 0; }
    #modal_tambah_loker .form-group label { font-weight: 600; color: #1a3f6a; font-size: .9rem; }
    #modal_tambah_loker .form-control { border-radius: .6rem; border-color: #cfe3f8; }
    #modal_tambah_loker .form-control:focus { border-color: #2b8cdf; box-shadow: 0 0 0 3px rgba(43,140,223,.15); }
    #modal_tambah_loker .toggle-group { display: flex; gap: .5rem; flex-wrap: wrap; }
    #modal_tambah_loker .toggle-group .btn { border-radius: 50px; font-size: .8rem; font-weight: 600; padding: .35rem 1rem; }
    #modal_tambah_loker .toggle-group .btn-outline-success.active,
    #modal_tambah_loker .toggle-group input:checked + .btn-outline-success { background: #28a745; color: #fff; }
    #modal_tambah_loker .toggle-group .btn-outline-secondary.active,
    #modal_tambah_loker .toggle-group input:checked + .btn-outline-secondary { background: #6c757d; color: #fff; }
    #modal_tambah_loker .btn-submit {
        background: linear-gradient(135deg, #0a4b8a, #2b8cdf); border: none; border-radius: 50px;
        padding: .6rem 2rem; font-weight: 700; transition: all .2s;
    }
    #modal_tambah_loker .btn-submit:hover { transform: scale(1.03); box-shadow: 0 4px 16px rgba(11,107,203,.35); }
</style>
<div class="modal fade" id="modal_tambah_loker">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="fa-solid fa-building-circle-check mr-2"></i> Form Input Loker</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="tambah_loker" method="POST">
                    @csrf
                    <div class="section-title"><i class="fa-solid fa-circle-info"></i> Informasi Loker</div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama_loker"><i class="fa-solid fa-building mr-1 text-primary"></i> Nama Perusahaan <span class="text-danger">*</span></label>
                                <input type="text" name="nama_loker" id="nama_loker" class="form-control" placeholder="cth: PT. Astra Honda Motor" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="posisi"><i class="fa-solid fa-briefcase mr-1 text-primary"></i> Posisi <span class="text-danger">*</span></label>
                                <input type="text" name="posisi" id="posisi" class="form-control" placeholder="cth: Operator Produksi" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi"><i class="fa-solid fa-file-lines mr-1 text-primary"></i> Deskripsi / Kualifikasi</label>
                        <textarea name="deskripsi" id="deskripsi" class="form-control" placeholder="Syarat, kualifikasi, dan info loker..."></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="administrasi"><i class="fa-solid fa-money-bill-wave mr-1 text-primary"></i> Administrasi (Rp) <span class="text-danger">*</span></label>
                                <input type="number" min="0" name="administrasi" id="administrasi" class="form-control" placeholder="50000" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="status_loker"><i class="fa-solid fa-toggle-on mr-1 text-primary"></i> Status Loker <span class="text-danger">*</span></label>
                                <select name="status_loker" id="status_loker" class="form-control">
                                    <option value="aktif">Aktif</option>
                                    <option value="tidak aktif">Tidak Aktif</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="grup_wa"><i class="fa-brands fa-whatsapp mr-1 text-success"></i> Link Grup WA <span class="text-danger">*</span></label>
                                <input type="url" name="grup_wa" id="grup_wa" class="form-control" placeholder="https://chat.whatsapp.com/..." required>
                            </div>
                        </div>
                    </div>

                    <div class="section-title"><i class="fa-solid fa-sliders"></i> Field yang Tampil di Formulir Pendaftar</div>
                    <div class="row">
                        @php
                            $toggles = [
                                'form_npwp' => 'NPWP',
                                'form_npsn' => 'NPSN',
                                'form_nilai_ijazah' => 'Nilai Ijazah',
                                'form_nilai_matematika' => 'Nilai Matematika',
                                'form_domisili' => 'Domisili',
                                'form_pernah_mengikuti_reqrutment_calon_karyawan' => 'Riwayat Rekrutmen',
                                'form_pernah_bekerja' => 'Riwayat Bekerja',
                                'form_vaksin' => 'Data Vaksin',
                            ];
                        @endphp
                        @foreach($toggles as $field => $label)
                        <div class="col-md-6 col-lg-3">
                            <div class="form-group">
                                <label>{{ $label }}</label>
                                <div class="toggle-group btn-group btn-group-toggle" data-toggle="buttons">
                                    <label class="btn btn-outline-success active">
                                        <input type="radio" name="{{ $field }}" value="aktif" checked autocomplete="off"> Tampil
                                    </label>
                                    <label class="btn btn-outline-secondary">
                                        <input type="radio" name="{{ $field }}" value="tidak aktif" autocomplete="off"> Sembunyi
                                    </label>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <div class="text-right mt-3">
                        <button type="button" class="btn btn-light mr-2" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary btn-submit"><i class="fa-solid fa-floppy-disk mr-1"></i> Simpan Loker</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
