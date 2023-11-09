<div class="container-fluid">
    <?= $this->session->flashdata('message'); ?>
    <div class="card">
        <div class="card-body shadow">
            <h5 class="card-title fw-semibold mb-4"><?= $title ?></h5>
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
                </div>
            </form>
            <hr class="dashed">

            <?php if ((isset($_GET['bulan']) && $_GET['bulan'] != '') && isset($_GET['tahun']) && $_GET['tahun'] != '') {
                $bulan = $_GET['bulan'];
                $tahun = $_GET['tahun'];
                $bulantahun = $bulan . $tahun;
            } else {
                $bulan = date('m');
                $tahun = date('Y');
                $bulantahun = $bulan . $tahun;
            } ?>

            <div class="alert alert-primary text-dark" role="alert">
                Data Honor Pegawai Bulan: <strong><?= bulan($bulan) ?></strong> Tahun: <strong><?= $tahun ?></strong>
            </div>
            <div class="table-responsive">
                <?php if (count($honor) != 0) { ?>
                    <div class="d-flex justify-content-end mb-3">
                        <a href="<?= base_url('admin/honorpegawai/kegiatan') ?>" id="addKegiatan" class="btn btn-dark btn-sm me-2"><i class="ti ti-plus"></i> Tambah honor kegiatan</a>
                        <!-- <button class="btn btn-dark btn-sm" onclick="printPage()"><i class="ti ti-printer"></i> Print</button> -->
                    </div>
                    <form action="<?= base_url('admin/honorpegawai/arsip') ?>" method="post" id="honorList">
                        <input type="hidden" name="bulantahun" value="<?= $bulantahun ?>">
                        <div class="form-check mb-3" style="display: inline-block;">
                            <input class="form-check-input border-dark" type="checkbox" id="checkAll">
                            <label id="label_check" class="form-check-label" for="checkAll">
                                Check All
                            </label>
                        </div>
                        <div class="ms-3" style="display: inline-block;">
                            <button id="arsipkan" name="submitBtn" type="submit" class="btn btn-dark btn-sm">Arsipkan</button>
                        </div>
                        <p class="text-danger peringatan">*Data Belum Diarsipkan</p>
                        <table class="table table-bordered table-hover table-sm" id="tabel_honor">
                            <thead>
                                <tr class="bg-dark text-light">
                                    <th>#</th>
                                    <th>No</th>
                                    <th>Nama Pegawai</th>
                                    <th>Mengajar</th>
                                    <th>Jabatan</th>
                                    <th>Transport</th>
                                    <th>Kegiatan</th>
                                    <th>Total</th>
                                    <th class="text-center">#</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($honor as $hn) : ?>

                                    <!-- hitung honor -->
                                    <?php

                                    $arsip = $this->db->get_where('tb_arsip', ['idp' => $hn->id_pegawai, 'bulantahun' => $bulantahun])->row_array();

                                    $honor_jam = $hn->total_jam * $perjam['honor'];
                                    $honor_jabatan = $hn->total_honor_jabatan;
                                    $honor_transport = $hn->honor_transport * $hn->hadir;
                                    $honor_kegiatan = $hn->total_honor_kegiatan;

                                    if ($hn->walas == 1) {
                                        $honor_jabatan += $walas['honor'];
                                    }

                                    $total_honor = $honor_jam + $honor_jabatan + $honor_transport + $honor_kegiatan;

                                    ?>

                                    <tr>
                                        <?php if (is_null($arsip)) { ?>
                                            <td><input id="checkArsip" class="form-check-input" name="id_pegawai[]" type="checkbox" value="<?= $hn->id_pegawai ?>" onclick="return false"></td>
                                        <?php } else { ?>
                                            <td><input id="checkArsip" class="form-check-input" name="id_pegawai[]" type="checkbox" <?= $arsip['bulantahun'] == $bulantahun && $arsip['idp'] == $hn->id_pegawai  ? 'checked disabled'  : '' ?> value="<?= $hn->id_pegawai ?>" onclick="return false"></td>
                                        <?php } ?>
                                        <td><?= $no++ ?></td>
                                        <td><?= $hn->nama_pegawai ?></td>
                                        <td>Rp. <?= rupiah($honor_jam) ?></td>
                                        <td>Rp. <?= rupiah($honor_jabatan) ?></td>
                                        <td>Rp. <?= rupiah($honor_transport) ?></td>
                                        <td>Rp. <?= rupiah($honor_kegiatan) ?></td>
                                        <td>Rp. <?= rupiah($total_honor) ?></td>
                                        <td class="text-center">
                                            <?php
                                            $month = date('m');
                                            $year = date('Y');
                                            $month_param = $bulan . $year < $month . $year;
                                            if ($month_param) { ?>
                                                -
                                            <?php } else { ?>
                                                <a href="<?= base_url('admin/honorpegawai/detail/') . $hn->id_pegawai . '/' . $bulantahun ?>" class="btn btn-info btn-sm" data-bs-toggle="tooltip" data-bs-placement="right" title="Detail"><i class="ti ti-eye-check"></i></button>
                                                <?php } ?>
                                        </td>
                                    </tr>
            </div>



        <?php endforeach; ?>
        </tbody>
        </table>
        </form>
    <?php } else { ?>
        <strong>Data yang dicari tidak tersedia!</strong>
    <?php } ?>
        </div>

        <div id="printerDiv" style="display:none"></div>
        <!-- BATAS -->
    </div>
</div>
</div>
<script>
    function printPage() {
        var div = document.getElementById("printerDiv");
        div.innerHTML = '<iframe src="<?= base_url('admin/honorpegawai/print') ?>" onload="this.contentWindow.print();"></iframe>';
    }
</script>