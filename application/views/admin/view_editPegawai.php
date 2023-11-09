<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4"><?= $title; ?></h5>
            <!-- BATAS -->
            <form method="post" action="<?= base_url('admin/datapegawai/update_pegawai/') . $idp ?>">
                <div class="row">
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Nama</label>
                            <input type="text" class="form-control" name="nama" placeholder="Masukan Nama" value="<?= $pegawai['nama_pegawai'] ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Alamat</label>
                            <input type="text" class="form-control" name="alamat" placeholder="Masukan Alamat" value="<?= $pegawai['alamat'] ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jenis Kelamin</label>
                            <select class="form-select" name="jenis_kelamin" aria-label="Default select example" required>
                                <option value="">-- Pilih --</option>
                                <option value="L" <?php if ($pegawai['jenis_kelamin'] == 'L') {; ?> selected='selected' <?php } ?>>Laki-Laki</option>
                                <option value="P" <?php if ($pegawai['jenis_kelamin'] == 'P') {; ?> selected='selected' <?php } ?>>Perempuan</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jarak Tempuh</label><br>
                            <select class="form-select" name="jarak" required>
                                <option selected value="">Pilih Data</option>
                                <?php foreach ($jarak_tempuh as $jt) : ?>
                                    <option <?php if ($pegawai['id_transport'] == $jt->id_transport) : ?> selected <?php endif; ?> value="<?= $jt->id_transport ?>"><?= $jt->jarak ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status</label><br>
                            <select class="form-select" name="hak_akses" required>
                                <option selected value="">Pilih Data</option>
                                <?php foreach ($hak_akses as $role) : ?>
                                    <option <?php if ($pegawai['hak_akses'] == $role->hak_akses) : ?> selected <?php endif; ?> value="<?= $role->hak_akses ?>"><?= $role->keterangan ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" class="form-control" value="<?= $pegawai['username'] ?>" name="username" placeholder="Username">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="card-title">Mapel Saat Ini</h5>
                                    </div>
                                    <div class="col-6 d-flex justify-content-end">
                                        <a data-bs-toggle="modal" data-bs-target="#newJam" class="btn btn-success btn-sm text-white">Tambah</a>
                                    </div>
                                </div>
                                <ol class="list-group list-group-numbered mt-2">
                                    <?php if ($hitung_tmp_jam == 0) : ?>
                                        <label>Tidak Ada Data!</label>
                                    <?php endif; ?>
                                    <?php foreach ($jam_now as $jn) : ?>
                                        <li class="list-group-item"><?= $jn->nama_mapel ?>&emsp;&emsp;
                                            <a class="text-danger" href="<?= base_url('admin/datapegawai/del_jam/') . $jn->id_tmp . '/' . $idp ?>"> hapus</a>
                                        </li>
                                    <?php endforeach; ?>
                                </ol>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="card-title">Jabatan Saat Ini</h5>
                                    </div>
                                    <div class="col-6 d-flex justify-content-end">
                                        <a data-bs-toggle="modal" data-bs-target="#newJab" class="btn btn-success btn-sm text-white">Tambah</a>
                                    </div>
                                </div>
                                <ol class="list-group list-group-numbered mt-2">
                                    <?php if ($hitung_tmp_jab == 0) : ?>
                                        <label>Tidak Ada Data!</label>
                                    <?php endif; ?>
                                    <?php foreach ($jab_now as $jabNow) : ?>
                                        <li class="list-group-item"><?= $jabNow->nama_jabatan ?>&emsp;&emsp;
                                            <a class="text-danger" href="<?= base_url('admin/datapegawai/del_jab/') . $jabNow->id_tmp . '/' . $idp ?>"> hapus</a>
                                        </li>
                                    <?php endforeach; ?>
                                </ol>
                            </div>
                        </div>
                        <div class="mb-3 ms-4">
                            <div class="form-check">
                                <input class="form-check-input border-dark" name="walas" <?= $pegawai['walas'] == 1 ? 'checked' : '' ?> type="checkbox" value="1">
                                <label class="form-check-label">
                                    Menjabat Sebagai Walas
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <a href="<?= base_url('admin/datapegawai') ?>" type="button" class="btn btn-dark me-2" data-dismiss="modal">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
            <!-- BATAS -->
        </div>
    </div>
</div>


<!-- Modal Tambah JAM-->
<div class="modal fade" id="newJam" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Mapel Tersedia</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </button>
            </div>
            <div class="modal-body ms-3">
                <form class="form-coontrol" method="post" action="<?= base_url('admin/datapegawai/newJam/') . $idp ?>">
                    <?php foreach ($jam_mengajar as $jm) : ?>
                        <div class="form-check">
                            <input class="form-check-input" name="id_jam[]" type="checkbox" value="<?= $jm->id_jam ?>">
                            <label class="form-check-label">
                                <?= $jm->nama_mapel ?>
                            </label>
                        </div>
                    <?php endforeach; ?>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-dark me-2" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Tambah Data JABATAN -->
<div class="modal fade" id="newJab" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Jabatan Tersedia</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body ms-3">
                <form class="form-coontrol" method="post" action="<?= base_url('admin/datapegawai/newJab/') . $idp ?>">
                    <?php foreach ($jabatan as $jb) : ?>
                        <div class="form-check">
                            <input class="form-check-input" name="id_jabatan[]" type="checkbox" value="<?= $jb->id_jabatan ?>">
                            <label class="form-check-label">
                                <?= $jb->nama_jabatan ?>
                            </label>
                        </div>
                    <?php endforeach; ?>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-dark me-2" data-bs-dismiss="modal">batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- BATAS -->