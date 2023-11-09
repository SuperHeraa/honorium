<nav class="navbar bg-dark navbar-dark mb-4 shadow">
    <div class="container-fluid">
        <a href="<?= base_url('pegawai/dashboard') ?>" class="navbar-brand"><i class="ti ti-home-move"></i> Honorium</a>
        <div class="d-flex">
            <h6 class="text-light"><?= $this->session->userdata('username') ?></h6>
        </div>
    </div>
</nav>