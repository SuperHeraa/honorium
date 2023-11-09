<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4"><?= $title ?></h5>
            <!-- BATAS -->
            <div class="row">
                <div class="col-4">
                    <a href="<?= base_url('admin/datapegawai') ?>" class="p-4 text-center bg-light-primary card shadow-none rounded-2">
                        <img src="<?= base_url('assets/images/products/') ?>icon-user-male.svg" width="50" height="50" class="mb-6 mx-auto" alt="">
                        <p class="fw-semibold text-primary mb-1">Pegawai</p>
                        <h4 class="fw-semibold text-primary mb-0"><?= $pegawai ?></h4>
                    </a>
                </div>
                <div class="col-4">
                    <a href="<?= base_url('admin/datahonor') ?>" class="p-4 text-center bg-light-warning card shadow-none rounded-2">
                        <img src="<?= base_url('assets/images/products/') ?>icon-briefcase.svg" width="50" height="50" class="mb-6 mx-auto" alt="">
                        <p class="fw-semibold text-warning mb-1">Jabatan</p>
                        <h4 class="fw-semibold text-warning mb-0"><?= $jabatan ?></h4>
                    </a>
                </div>
                <div class="col-4">
                    <a href="<?= base_url('admin/datahonor') ?>" class="p-4 text-center bg-light-danger card shadow-none rounded-2">
                        <img src="<?= base_url('assets/images/products/') ?>icon-favorites.svg" width="50" height="50" class="mb-6 mx-auto" alt="">
                        <p class="fw-semibold text-danger mb-1">Mapel</p>
                        <h4 class="fw-semibold text-danger mb-0"><?= $mapel ?></h4>
                    </a>
                </div>
            </div>
            <!-- BATAS -->
        </div>
    </div>
</div>