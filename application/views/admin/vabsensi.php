<div class="container-fluid">
    <?= $this->session->flashdata('message') ?>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4"><?= $title ?></h5>
            <hr class="dashed">
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
        <hr class="dashed">
        <div class="d-flex justify-content-end mb-3 me-2">
            <a href="<?= base_url('admin/absensi/manage') ?>" class="btn btn-dark btn-sm"><i class="ti ti-settings"></i> Manage</a>
        </div>
        <div class="alert alert-primary text-dark" role="alert">
            Kehadiran Bulan: <strong><?= bulan($bulan) ?></strong> Tahun: <strong><?= $tahun ?></strong>
        </div>
        <?php if (count($absensi) > 0) { ?>
            <table class="table table-bordered table-hover table-sm">
                <thead class="bg-dark text-light">
                    <tr>
                        <th>No</th>
                        <th>Nama Pegawai</th>
                        <th class="text-center">Hadir</th>
                        <th class="text-center">Sakit</th>
                        <th class="text-center">Izin</th>
                        <th class="text-center">Alfa</th>
                        <th class="text-center">#</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($absensi as $abs) : ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td class="text-start"><?= $abs->nama_pegawai ?></td>
                            <td class="text-center"><?= $abs->hadir ?></td>
                            <td class="text-center"><?= $abs->sakit ?></td>
                            <td class="text-center"><?= $abs->izin ?></td>
                            <td class="text-center"><?= $abs->alfa ?></td>
                            <td class="text-center">
                                <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#edit<?= $abs->id_pegawai ?>" title="Edit"><i class="ti ti-edit"></i></button>
                            </td>
                        </tr>
                        <!-- Modal Edit-->
                        <div class="modal fade" id="edit<?= $abs->id_pegawai ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">Edit Data</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="<?= 'absensi/edit/' . $abs->id_pegawai . '/' . $bulantahun ?>" method="POST">
                                            <div class="row">
                                                <div class="col">
                                                    <label class="form-label">Hadir</label>
                                                    <input type="number" name="hadir" value="<?= $abs->hadir ?>" class="form-control">
                                                </div>
                                                <div class="col">
                                                    <label class="form-label">Sakit</label>
                                                    <input type="number" name="sakit" value="<?= $abs->sakit ?>" class="form-control">
                                                </div>
                                                <div class="col">
                                                    <label class="form-label">Izin</label>
                                                    <input type="number" name="izin" value="<?= $abs->izin ?>" class="form-control">
                                                </div>
                                                <div class="col">
                                                    <label class="form-label">Alfa</label>
                                                    <input type="number" name="alfa" value="<?= $abs->alfa ?>" class="form-control">
                                                </div>
                                            </div>

                                            <div class="d-flex justify-content-end mt-5">
                                                <button type="button" class="btn btn-danger me-2" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-dark">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php } else { ?>
            <strong>Data yang dicari tidak ada</strong>
        <?php } ?>

        <!-- BATAS -->
    </div>
</div>