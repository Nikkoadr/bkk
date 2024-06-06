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
                        <input type="text" name="nama_loker" id="nama_loker" class="form-control" placeholder="Nama loker">
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
                        <label for="grup_wa">Grup WA</label>
                        <input type="text" name="grup_wa" id="grup_wa" class="form-control" placeholder="Grup WA">
                    </div>
                    <button type="submit" class="btn btn-primary float-right">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>