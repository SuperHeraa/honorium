<div class="container">
    <div id="msg"></div>
    <!-- Page Heading -->
    <div class="d-flex justify-content-center" id="uploaded_image">
        <img src="<?= base_url('assets/images/profile/') . $pegawai['image'] ?>" class="rounded mx-auto d-block sahdow" width="150">
    </div>
    <div class="text-center fs-6 mt-2">
        <strong><?= strtoupper($pegawai['nama_pegawai']) ?></strong>
    </div>
    <div class="d-flex justify-content-center mb-2">
        <a href="##" data-bs-toggle="modal" data-bs-target="#changePicture" class="link-dark me-2"><i class="ti ti-photo-edit"></i> <strong>Ubah Foto</strong></a> |
        <a href="##" data-bs-toggle="modal" data-bs-target="#edit_password" class="link-dark ms-2"><i class="ti ti-lock-open"></i><strong>Ubah Password</strong></a>
    </div>
    <div class="d-flex justify-content-center">
        username :
        <div id="show_username">

        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-sm-12 col-md-6 col-lg-6">
            <div class="card shadow-lg">
                <div class="card-body">
                    <div class="badge bg-dark mb-3">Jabatan</div><br>
                    <?php if (count($jabatan) == 0 && $pegawai['walas'] != 1) { ?>
                        <strong class="text-danger">Tidak Ada Data</strong>
                    <?php } else { ?>
                        <?php foreach ($jabatan as $key) : ?>
                            <i class="ti ti-chevron-right"></i> <?= $key->nama_jabatan  ?><br>
                        <?php endforeach; ?>
                    <?php } ?>
                    <?= $pegawai['walas'] == 1 ? ' <i class="ti ti-chevron-right"></i> Walas' : '' ?>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-6">
            <div class="card shadow-lg">
                <div class="card-body">
                    <div class="badge bg-dark mb-3">Jam Mengajar</div><br>
                    <?php if (count($jam) == 0) { ?>
                        <strong class="text-danger">Tidak Ada Data</strong>
                    <?php } else { ?>
                        <?php foreach ($jam as $key) : ?>
                            <i class="ti ti-chevron-right"></i> <?= $key->nama_mapel  ?><br>
                        <?php endforeach; ?>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card shadow-lg">
                <div class="card-body">
                    <div class="badge bg-dark mb-3">Informasi Akun</div><br>
                    <p class="lh-base">
                        <i class="ti ti-gender-bigender"></i> <?= $pegawai['jenis_kelamin'] == 'P' ? 'Perempuan' : 'Laki Laki' ?><br>
                        <i class="ti ti-map-pin"></i> <?= $pegawai['alamat'] ?><br>
                        <i class="ti ti-motorbike"></i> <?= $pegawai['jarak'] ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Username -->
<div class="modal fade" id="edit_username" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ubah Username</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <strong>Username saat ini : <?= $pegawai['username'] ?></strong>
                <form id="formUsername">
                    <div class="mb-3 mt-3">
                        <input type="text" name="username" class="form-control" id="username" aria-describedby="emailHelp" placeholder="Username Baru" required>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-primary btn-sm me-2" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-dark btnsm" id="btn_simpan">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal Edit Password -->
<div class="modal fade" id="edit_password" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ubah Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formUpdatePass">
                    <div class="mb-3">
                        <label class="form-label">Password Sekarang</label>
                        <input type="password" name="oldPass" class="form-control" id="oldPass" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password Baru</label>
                        <input type="password" name="newPass" class="form-control" id="newPass" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Konfirmasi Password</label>
                        <input type="password" name="newPass2" class="form-control" id="newPass2" aria-describedby="emailHelp">
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-primary btn-sm me-2" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-dark btnsm" id="savePass">Simpan</button>
                    </div>
                </form>
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
<script>
    $(document).ready(function() {
        tampil_username();

        // tampil username
        function tampil_username() {
            $.ajax({
                type: "POST",
                url: '<?= base_url(); ?>/pegawai/profile/get_update',
                async: true,
                dataType: "JSON",
                success: function(data) {
                    var html = '';
                    html += '<span>' + data.username + ' </span>' +
                        '<a href="##" data-bs-target="#edit_username" data-bs-toggle="modal"> <i class="ti ti-edit"></i></a>';
                    $("#show_username").html(html);

                }
            });
        }

        function clearForm() {
            $("#username").removeClass("is-valid");
            $("#oldPass").removeClass("is-valid");
            $("#newPass").removeClass("is-valid");
            $("#newPass2").removeClass("is-valid");

            $("#oldPass").val('');
            $("#newPass").val('');
            $("#newPass2").val('');
        }

        //update username
        $("#formUsername").validate({
            rules: {
                username: {
                    required: true,
                    remote: {
                        url: "<?= base_url('pegawai/profile/cek_username') ?>",
                        type: "post",
                        data: {
                            username: function() {
                                return $("#username").val();
                            }
                        }

                    }
                }
            },
            messages: {
                username: {
                    required: "Field tidak boleh kosong!",
                    remote: "Username sudah terdaftar"
                }
            },
            errorPlacement: function(error, element) {
                // Add the `invalid-feedback` class to the error element
                error.addClass("invalid-feedback");
                error.insertAfter(element);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass("is-invalid").removeClass("is-valid");
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).addClass("is-valid").removeClass("is-invalid");
            },
            submitHandler: function(form) {
                var username = $('#username').val();
                $.ajax({
                    type: "POST",
                    url: '<?= base_url(); ?>/pegawai/profile/update',
                    dataType: "JSON",
                    data: {
                        username: username
                    },
                    beforeSend: function() {
                        $("#overlay").fadeIn(300);
                        $('[name="username"]').val('');
                        $("#edit_username").modal('hide');
                    },
                    success: function(data) {
                        $("#overlay").fadeOut(300);
                        $("#show_username").html('username : ' + data.username);
                        $("#msg").html(data.msg);
                        tampil_username();
                        clearForm();
                    }
                });
            }
        });

        //update password
        $("#formUpdatePass").validate({
            rules: {
                oldPass: {
                    required: true,
                    remote: {
                        url: "<?= base_url('pegawai/profile/cek_password') ?>",
                        type: "post",
                        data: {
                            oldPass: function() {
                                return $("#oldPass").val();
                            }
                        }
                    }
                },
                newPass: {
                    required: true,
                    minlength: 8
                },
                newPass2: {
                    required: true,
                    minlength: 8,
                    equalTo: "#newPass"
                }
            },
            messages: {
                oldPass: {
                    required: "Field tidak boleh kosong!",
                    remote: "Password salah!"
                },
                newPass: {
                    required: "Field tidak boleh kosong!",
                    minlength: "Password setidaknya 8 karakter"
                },
                newPass2: {
                    required: "Field tidak boleh kosong!",
                    equalTo: "Password tidak sama!",
                    minlength: "Password setidaknya 8 karakter"
                }
            },
            errorPlacement: function(error, element) {
                // Add the `invalid-feedback` class to the error element
                error.addClass("invalid-feedback");
                error.insertAfter(element);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass("is-invalid").removeClass("is-valid");
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).addClass("is-valid").removeClass("is-invalid");
            },
            submitHandler: function(form) {
                var newPassword = $("#newPass").val();
                $.ajax({
                    type: "post",
                    url: "<?= base_url('pegawai/profile/update_pass') ?>",
                    dataType: "json",
                    data: {
                        newPass: newPassword
                    },
                    beforeSend: function() {
                        $("#overlay").fadeIn(300);
                        $("#edit_password").modal('hide');
                    },
                    success: function(data) {
                        $("#overlay").fadeOut(300);
                        $("#msg").html(data.msg);
                        clearForm();
                    }
                });
            }
        });
    });

    // form-username validation
    // $().ready(function() {

    // });


    //update password
    // $(document).ready(function() {
    //     $("#savePass").on('click', function() {
    //         var oldPass = $("#oldPass").val();
    //         var newPass = $("#newPass").val();
    //         $.ajax({
    //             type: "POST",
    //             url: '<?= base_url('pegawai/profile/changePass') ?>',
    //             dataType: "json",
    //             data: {
    //                 oldPass: oldPass,
    //                 newPass: newPass
    //             },
    //             success: function(data) {
    //                 console.log(data);
    //             }

    //         });
    //         return false;
    //     });
    // });

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
                    url: "<?= base_url('pegawai/profile/upload_img') ?>",
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