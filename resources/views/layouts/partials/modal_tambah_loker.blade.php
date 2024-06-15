<style>
    .form-check {
        display: inline-block;
        margin-right: 20px; /* Adjust the margin as needed */
    }
</style>
<div class="modal fade" id="modal_tambah_loker">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Form Input Loker</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="tambah_loker" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nama_loker">Nama Loker</label>
                        <input type="text" name="nama_loker" id="nama_loker" class="form-control" placeholder="Nama loker" required>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea name="deskripsi" id="deskripsi" class="form-control" placeholder="Deskripsi loker"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="status_loker">Status Loker</label>
                        <select name="status_loker" id="status_loker" class="form-control">
                            <option value="aktif">Aktif</option>
                            <option value="tidak aktif">Tidak Aktif</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="form_npwp">Form NPWP :</label>
                        <div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="form_npwp" id="form_npwp_aktif" value="aktif" required>
                                <label class="form-check-label"  for="form_npwp_aktif">Aktif</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="form_npwp" id="form_npwp_tidak_aktif" value="tidak aktif" required>
                                <label class="form-check-label" for="form_npwp_tidak_aktif">Tidak Aktif</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="form_npsn">Form NPSN :</label>
                        <div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="form_npsn" id="form_npsn_aktif" value="aktif" required>
                                <label class="form-check-label" for="form_npsn_aktif">Aktif</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="form_npsn" id="form_npsn_tidak_aktif" value="tidak aktif" required>
                                <label class="form-check-label" for="form_npsn_tidak_aktif">Tidak Aktif</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="form_nilai_ijazah">Form Nilai Ijazah :</label>
                        <div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="form_nilai_ijazah" id="form_nilai_ijazah_aktif" value="aktif" required>
                                <label class="form-check-label" for="form_nilai_ijazah_aktif">Aktif</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="form_nilai_ijazah" id="form_nilai_ijazah_tidak_aktif" value="tidak aktif" required>
                                <label class="form-check-label" for="form_nilai_ijazah_tidak_aktif">Tidak Aktif</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="form_nilai_matematika">Form Nilai Matematika :</label>
                        <div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="form_nilai_matematika" id="form_nilai_matematika_aktif" value="aktif" required>
                                <label class="form-check-label" for="form_nilai_matematika_aktif">Aktif</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="form_nilai_matematika" id="form_nilai_matematika_tidak_aktif" value="tidak aktif" required>
                                <label class="form-check-label" for="form_nilai_matematika_tidak_aktif">Tidak Aktif</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="form_pernah_mengikuti_reqrutment_calon_karyawan">Form Pernah Mengikuti Rekrutmen Calon Karyawan :</label>
                        <div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="form_pernah_mengikuti_reqrutment_calon_karyawan" id="form_pernah_mengikuti_reqrutment_calon_karyawan_aktif" value="aktif" required>
                                <label class="form-check-label" for="form_pernah_mengikuti_reqrutment_calon_karyawan_aktif">Aktif</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="form_pernah_mengikuti_reqrutment_calon_karyawan" id="form_pernah_mengikuti_reqrutment_calon_karyawan_tidak_aktif" value="tidak aktif" required>
                                <label class="form-check-label" for="form_pernah_mengikuti_reqrutment_calon_karyawan_tidak_aktif">Tidak Aktif</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="form_pernah_bekerja">Form Pernah Bekerja :</label>
                        <div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="form_pernah_bekerja" id="form_pernah_bekerja_aktif" value="aktif" required>
                                <label class="form-check-label" for="form_pernah_bekerja_aktif">Aktif</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="form_pernah_bekerja" id="form_pernah_bekerja_tidak_aktif" value="tidak aktif" required>
                                <label class="form-check-label" for="form_pernah_bekerja_tidak_aktif">Tidak Aktif</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="form_vaksin">Form Vaksin :</label>
                        <div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="form_vaksin" id="form_vaksin_aktif" value="aktif" required>
                                <label class="form-check-label" for="form_vaksin_aktif">Aktif</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="form_vaksin" id="form_vaksin_tidak_aktif" value="tidak aktif" required>
                                <label class="form-check-label" for="form_vaksin_tidak_aktif">Tidak Aktif</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="grup_wa">Grup WA</label>
                        <input type="text" name="grup_wa" id="grup_wa" class="form-control" placeholder="Grup WA" required>
                    </div>
                    <button type="submit" class="btn btn-primary float-right">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>