<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4"><?= $title ?></h5>
            <!-- BATAS -->
            <div class="card shadow-lg">
                <div class="card-header bg-dark" style="--bs-bg-opacity: .2;">
                    <h5>Filter Data Kehadiran</h5>
                </div>
                <div class="card-body">
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
                            <button class="btn btn-dark me-2">Generate</button>
                            <a href="##" class="btn btn-warning" onClick="history.go(-1); return false;">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>


            <?php if ((isset($_GET['bulan']) && $_GET['bulan'] != '') && isset($_GET['tahun']) && $_GET['tahun'] != '') {
                $bulan = $_GET['bulan'];
                $tahun = $_GET['tahun'];
                $bulantahun = $bulan . $tahun;
            } else {
                $bulan = date('m');
                $tahun = date('Y');
                $bulantahun = $bulan . $tahun;
            } ?>

            <div class="alert alert-success text-dark" role="alert">
                Input Kehadiran Pegawai Bulan: <strong><?= bulan($bulan) ?></strong> Tahun: <strong><?= $tahun ?></strong>
            </div>
            <?php $jumlah_data = count($input_absensi);
            if ($jumlah_data != 0) { ?>
                <form method="POST" action="<?= base_url('admin/absensi/insert_batch') ?>">
                    <table class="table table-bordered table-hover table-sm text-dark border-primary">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Nama Pegawai</th>
                                <th>Hadir</th>
                                <th>Sakit</th>
                                <th>Izin</th>
                                <th>Alfa</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($input_absensi as $abs) : ?>
                                <tr class="text-center">
                                    <input type="hidden" name="bulantahun[]" class="form-control" value="<?= $bulantahun ?>">
                                    <input type="hidden" name="id_pegawai[]" class="form-control" value="<?= $abs->id_pegawai ?>">
                                    <td style="width:5%"><?= $no++ ?></td>
                                    <td class="text-start"><?= $abs->nama_pegawai ?></td>
                                    <td style="width:8%"><input class="form-control border-primary" type="number" name="hadir[]" value=""></td>
                                    <td style="width:8%"><input class="form-control border-primary" type="number" name="izin[]" value=""></td>
                                    <td style="width:8%"><input class="form-control border-primary" type="number" name="sakit[]" value=""></td>
                                    <td style="width:8%"><input class="form-control border-primary" type="number" name="alfa[]" value=""></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <div class="mb-3 d-flex justify-content-end">
                        <button class="btn btn-dark" type="submit">Simpan</button>
                    </div>
                </form>
            <?php } else { ?>
                <strong>Data untuk bulan dan tahun yang dipilih sudah di inputkan!</strong>
            <?php } ?>
            <!-- BATAS -->
        </div>
    </div>
</div>