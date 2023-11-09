<div class="container-fluid">
    <?= $this->session->flashdata('message') ?>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4"><?= $title ?></h5>
            <!-- BATAS -->
            <div class="row">
                <div class="col-sm-12 col-md-6">
                    <div class="card shadow">
                        <div class="card-body">
                            <img src="<?= base_url('assets/images/products/') ?>server.png" width="70" class="mb-2">
                            <h5 class="card-title">Backup & Restore</h5>
                            <p class="card-text">Backup & Restore Database Dari Server</p>
                            <button class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#confirmBackup">Backup</button>
                            <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#restoredb">Restore</button>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6">
                    <div class="card shadow">
                        <div class="card-body">
                            <img src="<?= base_url('assets/images/products/') ?>reset.png" width="70" class="mb-2">
                            <h5 class="card-title">Reset Aplikasi</h5>
                            <p class="card-text">Menghapus Semua Data (Setelan Pabrik)</p>
                            <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#confirmReset">Reset Sekarang</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="card shadow">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="d-inline">
                                        <div id="uploaded_image">
                                            <img src="<?= base_url('assets/images/profile/') ?><?= $pegawai['image'] ?>" class="img-fluid" width="100">
                                        </div>
                                    </div>
                                    <div class="d-inline d-flex justify-content-start">
                                        <button class="btn btn-dark btn-sm mt-2" data-bs-toggle="modal" data-bs-target="#changePicture">Ubah Gambar</button>
                                    </div>
                                </div>
                                <div class="col">
                                    <div id="spinner" class="spinner-border mt-5" role="status" style="display: none;">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- BATAS -->
        </div>
    </div>
</div>
</div>

<!-- Modal Croppie -->
<div class="modal fade" id="cropPicture" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Pangkas Gambar</h5>
                <button type="button" class="btn-close" id="cls" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col">
                        <div id="image_demo"></div>
                    </div>
                    <div class="col">
                        <button class="btn btn-dark crop_image"><i class="ti ti-upload"></i> Upload</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Akhir Modal Croppie -->

<!-- Modal Pilih Gambar -->
<div class="modal fade" id="changePicture" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Ubah Gambar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?= form_open_multipart('other/upload'); ?>
                <div class="mb-3">
                    <label for="formFileSm" class="form-label">Pilih Gambar Dari Perangkat</label>
                    <input class="form-control" type="file" name="upload_image" id="upload_image" accept="image/*">
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Akhir Modal Pilih Gambar -->

<!-- Modal Backup-->
<div class="modal fade" id="confirmBackup" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Konfirmasi Backup</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Backup Databse ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">TIDAK</button>
                <a href="<?= base_url('admin/other/backup') ?>" id="btBackup" class="btn btn-dark">YA</a>
            </div>
        </div>
    </div>
</div>
<!-- Modal Restore-->
<div class="modal fade" id="restoredb" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Restore Database</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('admin/other/restoredb') ?>" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        Proses Restore memerlukan waktu sedikit lama<br>Mohon tunggu sampai tampil halaman sukses!
                    </div>
                    <label class="form-label">Pilih File Database.sql</label>
                    <div class="input-group mb-3">
                        <input type="file" class="form-control" name="berkas" id="inputGroupFile02">
                    </div>
                    <div class="d-flex justify-content-end mt-3">
                        <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-dark">Restore</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Reset Aplikasi -->
<div class="modal fade" id="confirmReset" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Konfirmasi Reset</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <strong>Semua data akan dihapus!</strong><br>
                Apakah anda yakin?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">TIDAK</button>
                <a href="<?= base_url('admin/other/resetApp') ?>" class="btn btn-dark" id="loading">YA</a>
            </div>
        </div>
    </div>
</div>
<!-- Vertically centered modal -->
<div class="modal fade" id="load" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="d-flex flex-column align-items-center justify-content-center">
                    <div class="row">
                        <div class="spinner-border" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                    <div class="row">
                        <strong>Reset Sedang Berjalan</strong>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#tbriwayat').DataTable({
            searching: true,
            paging: true,
            info: false,
            responsive: true,
            rowReorder: {
                selector: 'td:nth-child(2)'
            }
        });

        $("#loading").click(function() {
            $("#confirmReset").modal('hide');
            $("#load").modal('show');
        });

        $("#btBackup").click(function() {
            $("#confirmBackup").modal('hide');
        });


        $("#cls").on('click', function() {
            var input = $("input[name=image]");
            var fileName = input.val();

            if (fileName) { // returns true if the string is not empty
                input.val('');
            }
        });


    });


    // croppie
    $(document).ready(function() {
        $image_crop = $('#image_demo').croppie({
            enableExif: true,
            viewport: {
                width: 200,
                height: 200,
                type: 'square' //circle
            },
            boundary: {
                width: 350,
                height: 350
            }
        });

        $('#upload_image').on('change', function() {
            var reader = new FileReader();
            reader.onload = function(event) {
                $image_crop.croppie('bind', {
                    url: event.target.result
                }).then(function() {
                    console.log('jQuery bind complete');
                });
            }
            reader.readAsDataURL(this.files[0]);
            $('#changePicture').modal('hide');
            $('#cropPicture').modal('show');
        });

        $('.crop_image').click(function(event) {
            $image_crop.croppie('result', {
                type: 'canvas',
                size: 'viewport'
            }).then(function(response) {
                $.ajax({
                    url: "<?= base_url('admin/other/upload') ?>",
                    type: "POST",
                    data: {
                        "image": response
                    },
                    beforeSend: function() {
                        $('#cropPicture').modal('hide');
                        $("#overlay").fadeIn(300);
                    },
                    success: function(data) {

                        setTimeout(function() {
                            $("#overlay").fadeOut(300);
                            $('#uploaded_image').html(data);
                        }, 500);

                    }
                });
            })
        });
    });
</script>