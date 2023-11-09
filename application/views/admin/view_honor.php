<div class="container-fluid">
    <div class="card">
        <?= $this->session->flashdata('message'); ?>
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4"><?= $title; ?></h5>
            <!-- BATAS -->

            <div class="alert alert-success m-4" role="alert">
                <h4 class="alert-heading fw-semibold text-dark">Rp. <?= rupiah($honorPerJam['honor']); ?> <sup>/Jam</sup></h4>
                <hr>
                <p class="text-dark fs-4">Sesuai putusan dari pihak yayasan, setiap Guru yang mengajar akan diberikan upah sebesar harga diatas untuk setiap jam nya. Apabila ada perubahan, tekan tombol "Ubah Nominal" di bawah.</p>
                <button class="btn btn-dark btn-sm" data-bs-toggle="modal" data-bs-target="#editNominal">Ubah Nominal</button>

                <!-- Modal Edit Nominal -->
                <div class="modal fade" id="editNominal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">UBAH ITEM</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="<?= base_url('admin/datahonor/editNominal/') . $honorPerJam['id'] ?>">
                                    <div class="form-group">
                                        <label for="nominal" class="text-dark form-label">Honor Per Jam</label>
                                        <input type="text" name="nominal" class="form-control" id="nominal" value="<?= rupiah($honorPerJam['honor']) ?>" onkeypress="return hanyaAngka(event)" onkeyup="convertToRupiah(this)">
                                    </div>
                                    <div class="d-flex justify-content-end mt-3">
                                        <button type="button" class="btn btn-dark me-2" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="alert alert-primary m-4 text-dark" role="alert">
                <div class="row">
                    <div class="col-6">
                        <strong>Rp. <?= rupiah($honorWalas['honor']) ?></strong> - Sebagai honor bagi guru yang menjadi wali kelas
                    </div>
                    <div class="col-6 d-flex justify-content-end">
                        <button class="btn btn-sm btn-dark" data-bs-toggle="modal" data-bs-target="#honorwalas">Ubah Nominal</button>
                    </div>
                </div>
                <!-- Modal Edit Nominal HONOR -->
                <div class="modal fade" id="honorwalas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">UBAH ITEM</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="<?= base_url('admin/datahonor/edithonorwalas/') . $honorWalas['id']  ?>">
                                    <div class="form-group">
                                        <label for="nominal" class="text-dark form-label">Honor Walas</label>
                                        <input type="text" name="nominalhonor" class="form-control" value="<?= rupiah($honorWalas['honor']) ?>" onkeypress="return hanyaAngka(event)" onkeyup="convertToRupiah(this)">
                                    </div>
                                    <div class="d-flex justify-content-end mt-3">
                                        <button type="button" class="btn btn-dark me-2" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card m-4 shadow-lg">
                <div class="card-header bg-dark" style="--bs-bg-opacity: .2;">
                    <div class="row">
                        <div class="col-6">
                            <h5 class="text-dark">Honor Jabatan</h5>
                        </div>
                        <div class="col-6 d-flex justify-content-end">
                            <button type="button" class="btn btn-dark btn-sm" data-bs-toggle="modal" data-bs-target="#tambahJabatan"> Tambah</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered text-dark" id="myTable">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Jabatan</th>
                                <th scope="col">Jumlah Honor</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($jabatan as $jb) : ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $jb->nama_jabatan; ?></td>
                                    <td>Rp. <?= number_format($jb->honor_jabatan, 0, ',', '.') ?></td>
                                    <td>
                                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editJabatan<?= $jb->id_jabatan ?>">Edit</button>
                                        <button type=" button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapusJabatan<?= $jb->id_jabatan ?>">Hapus</button>
                                    </td>
                                </tr>


                                <!-- MODAL HAPUS JABATAN-->
                                <div class="modal fade" id="hapusJabatan<?= $jb->id_jabatan ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">HAPUS ITEM</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body text-dark">
                                                Anda yakin akan menghapus data ini ?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Tidak</button>
                                                <a href="<?= base_url('admin/datahonor/hapus_jabatan/') . $jb->id_jabatan ?>" class="btn btn-danger">YA</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- MODAL EDIT JABATAN-->
                                <div class="modal fade" id="editJabatan<?= $jb->id_jabatan ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">EDIT ITEM</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="post" action="<?= base_url('admin/datahonor/edit_jabatan/') . $jb->id_jabatan ?>">
                                                    <div class="form-group">
                                                        <label class="form-label">Jabatan</label>
                                                        <input type="text" name="jabatan" class="form-control" value="<?= $jb->nama_jabatan ?>" required>
                                                    </div>
                                                    <div class="mt-2">
                                                        <label class="form-label">Honor</label>
                                                        <div class="input-group">
                                                            <span class="input-group-text text-dark" id="basic-addon1">Rp.</span>
                                                            <input type="text" class="form-control" name="honor" value="<?= rupiah($jb->honor_jabatan); ?>" id="inlineFormInputGroupUsername2" onkeypress="return hanyaAngka(event)" onkeyup="convertToRupiah(this);" required>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex justify-content-end mt-3">
                                                        <button type="button" class="btn btn-dark me-2" data-bs-dismiss="modal">Tidak</button>
                                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                    <!-- Modal Tambah Jabatan-->
                    <div class="modal fade" id="tambahJabatan" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Tambah Jabatan</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">

                                    <form method="post" action="<?= base_url() . 'admin/datahonor/add_jabatan' ?>">
                                        <div class="form-group">
                                            <label class="form-label">Jabatan</label>
                                            <input type="text" name="jabatan" class="form-control" required>
                                        </div>
                                        <div class="mt-2">
                                            <label class="form-label">Honor</label>
                                            <div class="input-group">
                                                <span class="input-group-text text-dark" id="basic-addon1">Rp.</span>
                                                <input type="text" class="form-control" name="honor" id="inlineFormInputGroupUsername2" onkeypress="return hanyaAngka(event)" onkeyup="convertToRupiah(this);" required>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-end mt-3">
                                            <button type="button" class="btn btn-dark me-2" data-bs-dismiss="modal">Tidak</button>
                                            <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- HONOR TRANSPORT -->
            <div class="card m-4 shadow-lg">
                <div class="card-header bg-dark" style="--bs-bg-opacity: .2;">
                    <div class="row">
                        <div class="col-6">
                            <h5>Honor Transport</h5>
                        </div>
                        <div class="col-6 d-flex justify-content-end">
                            <button type="button" class="btn btn-dark btn-sm" data-bs-toggle="modal" data-bs-target="#tambahJarak"><i class="fas fa-plus-square"></i> Tambah</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered text-dark" id="tabel_jarak">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Jarak Tempuh</th>
                                <th scope="col">Jumlah Honor</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($transport as $ts) : ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $ts->jarak; ?></td>
                                    <td>Rp. <?= number_format($ts->honor_transport, 0, ',', '.') ?></td>
                                    <td>
                                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editJarak<?= $ts->id_transport ?>">Edit</button>
                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapusJarak<?= $ts->id_transport ?>">Hapus</button>
                                    </td>
                                </tr>

                                <!-- MODAL HAPUS JARAK-->
                                <div class="modal fade" id="hapusJarak<?= $ts->id_transport ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">HAPUS ITEM</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body text-dark">
                                                Anda yakin akan menghapus data ini ?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Tidak</button>
                                                <a href="<?= base_url('admin/datahonor/hapus_jarak/') . $ts->id_transport ?>" class="btn btn-danger">YA</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- MODAL EDIT JARAK-->
                                <div class="modal fade" id="editJarak<?= $ts->id_transport ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">EDIT ITEM</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body text-dark">
                                                <form method="post" action="<?= base_url('admin/datahonor/edit_jarak/') . $ts->id_transport ?>">
                                                    <div class="form-group">
                                                        <label class="form-label">Jarak Tempuh (KM)</label>
                                                        <input type="text" name="jarak" class="form-control" value="<?= $ts->jarak ?>" required>
                                                    </div>
                                                    <div class="mt-2">
                                                        <label class="form-label">Honor</label>
                                                        <div class="input-group">
                                                            <span class="input-group-text text-dark" id="basic-addon1">Rp.</span>
                                                            <input type="text" class="form-control" name="honor" value="<?= rupiah($ts->honor_transport); ?>" id="inlineFormInputGroupUsername2" onkeypress="return hanyaAngka(event)" onkeyup="convertToRupiah(this);" required>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex justify-content-end mt-3">
                                                        <button type="button" class="btn btn-dark me-2" data-bs-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
                <div class="modal fade" id="tambahJarak" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Tambah Jarak Tempuh</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">

                                <form method="post" action="<?= base_url() . 'admin/datahonor/add_jarak' ?>">
                                    <div class="form-group">
                                        <label>Jarak Tempuh (KM)</label>
                                        <input type="text" name="jarak" class="form-control" required>
                                    </div>
                                    <div class="mt-2">
                                        <label class="form-label">Honor</label>
                                        <div class="input-group">
                                            <span class="input-group-text text-dark" id="basic-addon1">Rp.</span>
                                            <input type="text" name="honor" class="form-control" id="inlineFormInputGroupUsername2" onkeypress="return hanyaAngka(event)" onkeyup="convertToRupiah(this);" required>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-end mt-3">
                                        <button type="button" class="btn btn-dark me-2" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- HONOR JAM MENGAJAR -->
            <div class="card m-4 shadow-lg">
                <div class="card-header bg-dark" style="--bs-bg-opacity: .2;">
                    <div class="row">
                        <div class="col-6">
                            <h5>Honor Jam Mengajar</h5>
                        </div>
                        <div class="col-6 d-flex justify-content-end">
                            <button class="btn btn-dark btn-sm" data-bs-toggle="modal" data-bs-target="#tambahMapel">Tambah</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered text-dark" id="myTableMapel">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Mapel</th>
                                <th scope="col">Jumlah Jam</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($jamPelajaran as $jp) : ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $jp->nama_mapel ?></td>
                                    <td><?= $jp->jumlah_jam ?></td>
                                    <td>
                                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editJam<?= $jp->id_jam ?>">Edit</button>
                                        <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapusMapel<?= $jp->id_jam ?>">Hapus</button>
                                    </td>
                                </tr>


                                <!-- MODAL HAPUS MAPEL / JAM MENGAJAR-->
                                <div class="modal fade" id="hapusMapel<?= $jp->id_jam ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">HAPUS ITEM</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Anda yakin akan menghapus data ini ?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Tidak</button>
                                                <a href="<?= base_url('admin/datahonor/hapus_jamNgajar/') . $jp->id_jam ?>" class="btn btn-danger">YA</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- MODAL EDIT MAPEL / JAM MENGAJAR-->
                                <div class="modal fade" id="editJam<?= $jp->id_jam ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">EDIT ITEM</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="post" action="<?= base_url('admin/datahonor/edit_jamNgajar/') . $jp->id_jam ?>">
                                                    <div class="mb-3">
                                                        <label class="form-label">Nama Mapel (Per Kelas)</label>
                                                        <input type="text" name="mapel" class="form-control" value="<?= $jp->nama_mapel ?>" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Jumlah Jam</label>
                                                        <input type="text" class="form-control" name="jumlah_jam" value="<?= $jp->jumlah_jam; ?>" id="inlineFormInputGroupUsername2" onkeypress="return hanyaAngka(event)" required>
                                                    </div>
                                                    <div class="d-flex justify-content-end mt-3">
                                                        <button type="button" class="btn btn-dark me-2" data-bs-dismiss="modal">Tidak</button>
                                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <!-- Modal Tambah MAPEL / JAM MENGAJAR-->
                <div class="modal fade" id="tambahMapel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Tambah Jam Mengajar</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="<?= base_url() . 'admin/datahonor/add_jamNgajar' ?>">
                                    <div class="mb-3">
                                        <label class="form-label">Nama Mapel (Per Kelas)</label>
                                        <input type="text" name="nama_mapel" class="form-control" placeholder="Contoh: Matematika kelas 10" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Jumlah Jam</label>
                                        <input type="text" name="jumlah_jam" class="form-control" id="inlineFormInputGroupUsername2" onkeypress="return hanyaAngka(event)" required>
                                    </div>
                                    <div class="d-flex justify-content-end mt-3">
                                        <button type="button" class="btn btn-dark me-2" data-bs-dismiss="modal">Tidak</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- BATAS -->
        </div>
    </div>
</div>