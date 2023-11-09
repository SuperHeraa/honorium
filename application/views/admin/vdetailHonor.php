<div class="container-fluid">
    <div class="card shadow-lg">
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <h5 class="card-title fw-semibold mb-4"><?= $title ?></h5>
                </div>
                <div class="col d-flex justify-content-end">
                    <a href="<?= base_url('admin/honorpegawai') ?>"><i class="ti ti-chevron-left"></i> Kembali</a>
                </div>
            </div>
            <hr>
            <!-- BATAS -->
            <div class="text-uppercase fs-5 fw-bolder mb-3">
                <?= $pegawai['nama_pegawai'] ?>
            </div>
            <div class="mb-3">
                <p class="fs-4">Rincian Pendapatan</p>

                <div class="row">
                    <div class="col">
                        <div class="d-flex" style="height: auto;">
                            <div class="vr"></div>
                            <div class="ms-3">
                                <div class="fw-bold fs-4">
                                    <strong>Transport</strong>
                                </div>
                                <div class="fs-3 mb-3">
                                    <?php $total_transport = $pegawai['honor_transport'] * $pegawai['hadir'] ?>
                                    - Jarak Tempuh : <strong><?= $pegawai['jarak'] ?></strong> <br>
                                    - Honor : <strong>Rp. <?= rupiah($pegawai['honor_transport']) ?> * </strong> <?= $pegawai['hadir'] ?> <sup>(kehadiran)</sup><br>
                                    - Total : <strong class="text-primary">Rp. <?= rupiah($pegawai['honor_transport'] * $pegawai['hadir']) ?></strong>
                                </div>
                                <div class="fw-bold fs-4">
                                    <strong>Jam Mengajar</strong>
                                </div>
                                <?php if (count($jam) == 0) { ?>
                                    <span class="text-danger fw-bold">Tidak Ada Data!</span>
                                <?php } else { ?>
                                    <div class="fs-3 mb-3">
                                        - Mapel Yang Diambil :<br>
                                        <div class="ms-4">
                                            <?php $no = 1;
                                            foreach ($jam as $key) : ?>
                                                <?= $no++ ?>. <?= $key->nama_mapel ?> <strong>(<?= $key->jumlah_jam ?>)<sup>JAM</sup></strong><br>
                                            <?php endforeach; ?>
                                        </div>
                                        <?php $total_jam = $jumlah_jam['jmlJam'] * $perjam['honor']; ?>
                                        - Jumlah Jam : <strong><?= $jumlah_jam['jmlJam'] ?> JAM * </strong><?= rupiah($perjam['honor']) ?> <sup>(honor perjam)</sup><br>
                                        - Total : <strong class="text-primary">Rp. <?= rupiah($total_jam) ?></strong>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="d-flex" style="height: auto;">
                            <div class="vr"></div>
                            <div class="ms-3">
                                <div class="fw-bold fs-4">
                                    <strong>Jabatan</strong>
                                </div>
                                <div class="fs-3 mb-3">
                                    <?php if (count($jabatan) == 0) { ?>
                                        <span class="text-danger fw-bold">Tidak Ada Jabatan Khusus!</span> <br>
                                    <?php } else { ?>
                                        - Jabatan Yang Diambil : <br>
                                        <div class="ms-4">
                                            <?php $no = 1;
                                            foreach ($jabatan as $key) : ?>
                                                <?= $no++ ?>. <?= $key->nama_jabatan ?> : <strong>Rp. <?= rupiah($key->honor) ?></strong><br>
                                            <?php endforeach ?>
                                        </div>
                                    <?php } ?>
                                    <?php if ($pegawai['walas'] == 1) { ?>
                                        <?= '- Wali Kelas : ' . '<strong> Rp. ' . rupiah($honorWalas['honor']) . '</strong>' ?><br>
                                    <?php } ?>
                                    - Total : <strong class="text-primary">Rp. <?= $pegawai['walas'] == 1 ? rupiah($jml_jabatan['jmlJab'] + $honorWalas['honor']) : rupiah($jml_jabatan['jmlJab']) ?></strong>
                                </div>
                                <div class="fw-bold fs-4">
                                    <strong>Kegiatan</strong>
                                </div>
                                <div class="fs-3 mb-3">
                                    <?php if (count($kegiatan) == 0) { ?>
                                        <span class="text-danger fw-bold">Tidak Ada Data!</span>
                                    <?php } else { ?>
                                        - Daftar Kegiatan : <br>
                                        <div class="ms-4">
                                            <?php $no = 1;
                                            foreach ($kegiatan as $key) : ?>
                                                <?= $no++ ?>. <?= $key->nama_kegiatan ?> : <strong>Rp. <?= Rupiah($key->honor_kegiatan) ?></strong><br>
                                            <?php endforeach ?>
                                        </div>
                                        - Total : <strong class="text-primary"><?= rupiah($jumlah_kegiatan['jmlKeg']) ?></strong>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=" mt-3">
                        <?php
                        $jam = $jumlah_jam['jmlJam'] * $perjam['honor'];
                        $total_honor = $total_transport + $jam + $jml_jabatan['jmlJab'] + $jumlah_kegiatan['jmlKeg'] ?>
                        <p class="fs-5 fw-bold">Total Honor : Rp. <strong><?= $pegawai['walas'] == 1 ? rupiah($total_honor + $honorWalas['honor']) : rupiah($total_honor) ?></strong></p>
                    </div>
                </div>



            </div>
            <!-- BATAS -->
        </div>
    </div>
</div>