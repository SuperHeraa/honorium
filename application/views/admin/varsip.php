<div class="container-fluid">
    <div class="card shadow-lg">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4"><?= $title ?></h5>
            <hr>
            <!-- BATAS -->
            <form class="row g-3 form-inline">
                <div class="col-auto">
                    <label class="col-form-label">Bulan</label>
                </div>
                <div class="col-auto">
                    <select name="bulan" class="form-select" aria-label="Default select example">
                        <option selected value="">-- Pilih Bulan -- </option>
                        <option value="01">Januari</option>
                        <option value="02">Februari</option>
                        <option value="03">Maret</option>
                        <option value="04">April</option>
                        <option value="05">Mei</option>
                        <option value="06">Juni</option>
                        <option value="07">Juli</option>
                        <option value="08">Agustus</option>
                        <option value="09">Septmber</option>
                        <option value="10">Oktober</option>
                        <option value="11">November</option>
                        <option value="12">Desember</option>
                    </select>
                </div>
                <div class="col-auto">
                    <label class="col-form-label">Tahun</label>
                </div>
                <div class="col-auto">
                    <select name="tahun" class="form-select" aria-label="Default select example">
                        <option selected value="">-- Pilih Tahun --</option>
                        <?php $tahun = date('Y');
                        for ($i = 2022; $i < $tahun + 3; $i++) { ?>
                            <option value="<?= $i ?>"><?= $i ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-auto ms-auto">
                    <button class="btn btn-dark me-2">Tampilkan</button>
            </form>

            <?php if ((isset($_GET['bulan']) && $_GET['bulan'] != '') && isset($_GET['tahun']) && $_GET['tahun'] != '') {
                $bulan = $_GET['bulan'];
                $tahun = $_GET['tahun'];
                $bulantahun = $bulan . $tahun;
            } else {
                $bulan = date('m');
                $tahun = date('Y');
                $bulantahun = $bulan . $tahun;
            } ?>

        </div>
        <hr class="dashed">
        <div class="d-flex justify-content-end mb-3">
            <a href="<?= base_url('admin/arsip/manage') ?>" class="btn btn-dark btn-sm"><i class="ti ti-settings"></i> Manage</a>
        </div>
        <div class="alert alert-primary text-dark" role="alert">
            Arsip Bulan: <strong><?= bulan($bulan) ?></strong> Tahun: <strong><?= $tahun ?></strong>
        </div>
        <div class="mb3">
            <?php if (count($arsip) != 0) { ?>
                <table class="table table-bordered table-sm table-hover" id="tbArsip">
                    <thead>
                        <tr class="bg-dark text-light">
                            <th style="width: 5%;">No</th>
                            <th>Nama Pegawai</th>
                            <th>Total Honor</th>
                            <th style="width: 5%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($arsip as $key) : ?>

                            <?php
                            $honorWalas = 0;
                            if ($key->status_walas == 1) {
                                $honorWalas = $key->honor_walas;
                            }
                            $honorJab = $key->total_honor_jabatan + $honorWalas;
                            $honorJam = $key->total_jam * $perjam['honor_perjam'];
                            $honorKeg = $key->total_honor_kegiatan;
                            $honorTrans = $key->honor_transport * $key->hadir;

                            $totalHonor = $honorJab + $honorJam + $honorKeg + $honorTrans;
                            ?>


                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $key->nama_pegawai ?></td>
                                <td>Rp. <?= rupiah($totalHonor) ?></td>
                                <td>
                                    <a href="<?= base_url('admin/arsip/detail/') . $key->idp . '/' . $bulantahun ?>" class="btn btn-info btn-sm" data-bs-toggle="tooltip" data-bs-placement="right" title="Detail"><i class="ti ti-eye-check"></i></a>
                                    <!-- <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#detail<?= $key->idp ?>"><i class="ti ti-eye-check"></i></button> -->
                                </td>
                            </tr>

                        <?php endforeach ?>
                    </tbody>
                </table>
            <?php } else { ?>
                <strong class="text-dark">Data yang dicari tidak tersedia!</strong>
            <?php } ?>
        </div>
        <!-- BATAS -->
    </div>
</div>