<div class="container-fluid">
    <?= $this->session->flashdata('message') ?>
    <div class="card mb-3">
        <div class="card-body shadow-lg">
            <h5 class="card-title fw-semibold mb-4">Passwordku</h5>
            <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#pwku">Reset</button>

            <!-- Modal Passwordku-->
            <div class="modal fade" id="pwku" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Reset Password</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="<?= base_url('admin/ubahpassword/myreset/') ?>" method="POST">
                                <div class="mb-3">
                                    <label class="form-label">Password Baru</label>
                                    <input type="password" class="form-control pw" name="mypass" minlength="8" required>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input border-dark swpass" type="checkbox">
                                    <label class="form-check-label" for="flexSwitchCheckChecked">Lihat Password</label>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button type="button" class="btn btn-secondary me-2 batal" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-dark">Konfirmasi</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body shadow-lg">
            <h5 class="card-title fw-semibold mb-4"><?= $title ?></h5>
            <!-- BATAS -->
            <table class="table table-bordered table-hover text-dark" id="tbreset">
                <thead>
                    <tr class="fw-semibold">
                        <th style="width: 5%">No</th>
                        <th>Nama</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($pegawai as $key) : ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $key->nama_pegawai ?></td>
                            <td><button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#resetpw<?= $key->id_pegawai ?>">Reset</button></td>
                        </tr>

                        <!-- Modal -->
                        <div class="modal fade" id="resetpw<?= $key->id_pegawai ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">Reset Password</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="<?= base_url('admin/ubahpassword/reset/') . $key->id_pegawai ?>" method="POST">
                                            <div class="mb-3">
                                                <label class="form-label">Password Baru</label>
                                                <input type="password" class="form-control pw" name="new_password" minlength="8" required>
                                            </div>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input border-dark swpass" type="checkbox">
                                                <label class="form-check-label" for="flexSwitchCheckChecked">Lihat Password</label>
                                            </div>
                                            <div class="d-flex justify-content-end">
                                                <button type="button" class="btn btn-secondary me-2 batal" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-dark">Konfirmasi</button>
                                            </div>
                                        </form>
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
<script type="text/javascript">
    $(document).ready(function(e) {

        $(".swpass").click(function() {
            if ($(this).is(':checked')) {
                $(".pw").attr('type', 'text');
            } else {
                $(".pw").attr('type', 'password');
            }
        })

        $(".batal").click(function() {
            $(".pw").attr('type', 'password');
            $(".pw").val('');
            $(".swpass").prop('checked', false);
        });
    });
</script>