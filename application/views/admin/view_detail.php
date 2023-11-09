<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <h5 class="card-title fw-semibold mb-4"><?= $title; ?></h5>
                </div>
                <div class="col-6 d-flex justify-content-end fw-semibold">
                    <a href="<?= base_url('admin/datapegawai') ?>"><i class="ti ti-chevron-left"></i> Kembali</a>
                </div>
            </div>
            <!-- BATAS -->

            <div class="row">
                <div class="col-4">
                    <div class="card mt-4 ml-4 p-4 shadow-lg border border-end-0 border-top-0 border-start-0 border-3 border-primary">
                        <div class="col-12 mt-4">
                            <img src="<?= base_url('assets/') ?>images/profile/default_avatar.png" class="rounded-circle mx-auto d-block" style="width: 50%;">
                        </div>
                        <div class="col-12 text-center mt-4 text-secondary">
                            <h3><?= $pegawai['nama_pegawai'] ?></h3>
                            <p class="text-dark"><i class="ti ti-award"></i> <?= $pegawai['hak_akses'] == 1 ? 'Admin' : 'Pegawai' ?></p>
                        </div>
                    </div>

                </div>
                <div class="col-8">
                    <div class="card mt-4 mr-4 p-4 shadow-lg">
                        <table class="table">
                            <tr>
                                <td>Alamat</td>
                                <td><?= $pegawai['alamat'] ?></td>
                            </tr>
                            <tr>
                                <th>Status Walas</th>
                                <td><?= $pegawai['walas'] == 1 ? '<span class="badge bg-success">Menjabat</span>' : '<span class="badge bg-dark text-light">Tidak Menjabat</span>' ?></td>
                            </tr>
                            <tr>
                                <th>Jenis Kelamin</th>
                                <td> <?= $pegawai['jenis_kelamin'] == 'P' ? 'Perempuan' : 'Laki - Laki' ?> </td>
                            </tr>
                            <tr>
                                <th>Jabatan</th>
                                <td>
                                    <?php if ($jml_jab_dipilih == 0) { ?>
                                        <span class="text-danger fw-semibold">Tidak ada Data</span>
                                    <?php } else { ?>
                                        <?php foreach ($jabatan as $jab) : ?>
                                            <i class="ti ti-chevron-right"></i> <?= $jab->nama_jabatan ?> <br>
                                        <?php endforeach; ?>
                                    <?php } ?>

                                </td>
                            </tr>
                            <tr>
                                <th>Mata Pelajaran</th>
                                <td>
                                    <?php if ($jml_jam_dipilih == 0) { ?>
                                        <span class="text-danger fw-semibold">Tidak ada Data</span>
                                    <?php } else { ?>
                                        <?php foreach ($jam as $jm) : ?>
                                            <i class="ti ti-chevron-right"></i> <?= $jm->nama_mapel ?> - <span class="text-primary fw-semibold">(<?= $jm->jumlah_jam ?> JAM ) </span><br>
                                        <?php endforeach; ?>
                                    <?php } ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Jumlah Jam</th>
                                <td> <?= $jml_jam_dipilih == 0 ? '<span class="text-danger fw-semibold">Tidak ada data</span>' : $jml_jam['jmlJam'] . ' JAM' ?></td>
                            </tr>
                            <tr>
                                <th>Jarak Tempuh</th>
                                <td> <?= $pegawai['jarak'] ?> </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <br>



            </div>


            <!-- BATAS -->
        </div>
    </div>
</div>