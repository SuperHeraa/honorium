<div class="container d-flex justify-content-center align-items-center">
    <div class="row" id="kolom">
        <div class="col-sm-12 col-md-6 col-lg-6">
            <div class="card w-80">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <img src="<?= base_url('assets/images/products/') . 'user.png' ?>" width="60">
                        </div>
                        <div class="col d-flex align-items-center justify-content-end">
                            <a href="<?= base_url('pegawai/profile') ?>" class="btn btn-dark custom">Profil</a>

                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-6">
            <div class="card w-80">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <img src="<?= base_url('assets/images/products/') . 'money-bag.png' ?>" width="60">
                        </div>
                        <div class="col d-flex align-items-center justify-content-end">
                            <a href="<?= base_url('pegawai/honor') ?>" class="btn btn-dark custom" id="honor">Honor</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-6">
            <div class="card w-80">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <img src="<?= base_url('assets/images/products/') . 'logout.png' ?>" width="60">
                        </div>
                        <div class="col d-flex align-items-center justify-content-end">
                            <a href="<?= base_url('welcome/logout') ?>" class="btn btn-danger custom">Logout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>