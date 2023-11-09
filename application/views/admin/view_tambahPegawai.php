<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4"><?= $title; ?></h5>
            <!-- BATAS -->
            <div class="row">
                <div class="col-6">
                    <form method="post" action="<?= base_url('admin/datapegawai/store_pegawai') ?>">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Nama</label>
                            <input type="text" class="form-control" name="nama" placeholder="Masukan Nama" required>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Alamat</label>
                            <input type="text" class="form-control" name="alamat" placeholder="Masukan Alamat" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jenis Kelamin</label>
                            <select class="form-select" name="jenis_kelamin" aria-label="Default select example" required>
                                <option selected value="">-- Pilih --</option>
                                <option value="L">Laki-Laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jarak Tempuh</label>
                            <select class="form-select" name="jarak" aria-label="Default select example" required>
                                <option selected value="">-- Pilih --</option>
                                <?php foreach ($jarak_tempuh as $jt) : ?>
                                    <option value="<?= $jt->id_transport ?>"><?= $jt->jarak ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select class="form-select" name="hak_akses" aria-label="Default select example" required>
                                <option selected value="">-- Pilih --</option>
                                <?php foreach ($hak_akses as $role) : ?>
                                    <option value="<?= $role->hak_akses ?>"><?= $role->keterangan ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" class="form-control" name="username" placeholder="Username">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" placeholder="Password" minlength="8">
                        </div>
                </div>
                <div class="col-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Mapel Yang Tersedia</h5>
                            <hr>
                            <?php foreach ($jam_mengajar as $jm) : ?>
                                <div class="form-check">
                                    <input class="form-check-input border-dark" name="id_jam[]" type="checkbox" value="<?= $jm->id_jam ?>">
                                    <label class="form-check-label">
                                        <?= $jm->nama_mapel ?>
                                    </label>
                                </div>
                            <?php endforeach; ?>
                            <div class="text-danger mt-2 fst-italic">*Kosongkan bila tidak mengajar</div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Jabatan Yang Tersedia</h5>
                            <hr>
                            <?php foreach ($jabatan as $jb) : ?>
                                <div class="form-check">
                                    <input class="form-check-input border-dark" name="id_jabatan[]" type="checkbox" value="<?= $jb->id_jabatan ?>">
                                    <label class="form-check-label">
                                        <?= $jb->nama_jabatan ?>
                                    </label>
                                    <?php echo form_error('id_jabatan'); ?>
                                </div>
                            <?php endforeach; ?>
                            <div class="text-danger mt-2 fst-italic">*Kosongkan bila tidak menjabat</div>
                        </div>
                    </div>
                    <div class="mb-3 ms-4">
                        <div class="form-check">
                            <input class="form-check-input border-dark" name="walas" type="checkbox" value="1">
                            <label class="form-check-label">
                                Menjabat Sebagai Walas
                            </label>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <a href="<?= base_url('admin/datapegawai') ?>" type="button" class="btn btn-secondary me-2">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
                </form>
            </div>
            ..
            <!-- BATAS -->
        </div>
    </div>
</div>