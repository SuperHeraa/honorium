<div class="container-fluid">
    <?= $this->session->flashdata('message') ?>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <h5 class="card-title fw-semibold mb-4"><?= $title ?></h5>
                </div>
                <div class="col d-flex justify-content-end">
                    <a href="##" onClick="history.go(-1); return false;"><i class="ti ti-chevron-left"></i> Kembali</a>
                </div>
            </div>
            <hr class="dashed">
            <div class="d-flex justify-content-end mb-3">
                <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#resetArsip">Reset Absensi</button>
            </div>
            <!-- BATAS -->
            <table class="table table-bordered" id="tb_manage">
                <thead>
                    <tr>
                        <th style="width: 5%;">No</th>
                        <th>Bulan</th>
                        <th>Tahun</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($absensi as $key) : ?>
                        <?php
                        $bulan = substr($key->bulantahun, 0, 2);
                        $tahun = substr($key->bulantahun, 2, 6);
                        ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= bulan($bulan) ?></td>
                            <td><?= $tahun ?></td>
                            <td><button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#konfirHapus<?= $key->bulantahun ?>"><i class="ti ti-trash"></i></button></td>
                        </tr>

                        <!-- Modal  Konfirmasi HApus-->
                        <div class="modal fade" id="konfirHapus<?= $key->bulantahun ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Hapus Item</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <strong> Data Absensi bulan <?= bulan($bulan) ?> Tahun <?= $tahun ?>.</strong><br>
                                        Apakah anda yakin menghapus item ini ?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">TIDAK</button>
                                        <a href="<?= base_url('admin/absensi/hapus_absen/') . $key->bulantahun ?>" class="btn btn-dark">YA</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php endforeach ?>
                </tbody>
            </table>
            <!-- BATAS -->
        </div>
    </div>
</div>

<!-- Modal Reset Arsip -->
<div class="modal fade" id="resetArsip" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Hapus Item</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <strong>Semua data Absensi akan dkosongkan!</strong><br>
                Apakah anda ingin melanjutkan ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">TIDAK</button>
                <a href="<?= base_url('admin/absensi/reset_absen/') ?>" class=" btn btn-dark">RESET</a>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#tb_manage').DataTable({
            searching: true,
            paging: true,
            info: false,
            responsive: true,
            rowReorder: {
                selector: 'td:nth-child(2)'
            }
        });
    });
</script>