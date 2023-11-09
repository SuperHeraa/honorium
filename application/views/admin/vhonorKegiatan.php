<div class="container-fluid">
    <div class="card shadow">
        <div class="flash">
            <?= $this->session->flashdata('message'); ?>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <h5 class="card-title fw-semibold mb-4"><?= $title; ?></h5>
                </div>
                <div class="col d-flex justify-content-end fw-semibold">
                    <a href="##" onClick="history.go(-1); return false;"><i class="ti ti-chevron-left"></i> Kembali</a>
                </div>

            </div>
            <hr>
            <!-- BATAS -->
            <form method="post" action="<?= base_url('admin/honorpegawai/store_kegiatan') ?>">
                <div class="mb-4">
                    <div class="row">
                        <label for="id_pegawai" class="form-label">Nama Pegawai</label>
                        <div class="col">
                            <input type="hidden" class="form-control" name="id_pegawai" id="id_pegawai">
                            <input type="text" class="form-control bg-dark" name="nama_pegawai" id="nama_pegawai" placeholder="belum tersedia" style="--bs-bg-opacity: .1;" onkeydown="event.preventDefault()" required>
                        </div>
                        <div class="col">
                            <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#cariPegawai">CARI</button>
                        </div>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-auto">
                        <label class="col-form-label">Bulan</label>
                    </div>
                    <div class="col-auto">
                        <select name="bulan" class="form-select" aria-label="Default select example" required>
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
                        <select name="tahun" class="form-select" aria-label="Default select example" required>
                            <option selected value="">-- Pilih Tahun --</option>
                            <?php $tahun = date('Y');
                            for ($i = 2022; $i < $tahun + 3; $i++) { ?>
                                <option value="<?= $i ?>"><?= $i ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="mb-4" id="groupKegiatan">
                    <div class="row mb-3">
                        <div class="col-3">
                            <label class="form-label">Nama Kegiatan</label>
                            <input type="text" class="form-control" name="nama_kegiatan[]" maxlength="20" required>
                        </div>
                        <div class="col-3">
                            <label class="form-label">Honor</label>
                            <div class="input-group">
                                <span class="input-group-text text-dark" id="basic-addon1">Rp.</span>
                                <input type="text" class="form-control" name="honor_kegiatan[]" onkeypress="return hanyaAngka(event)" onkeyup="convertToRupiah(this);" required>
                            </div>
                        </div>
                        <div class="col mt-1">
                            <br>
                            <button type="button" id="addMore" class="btn btn-success mt-1"><i class="ti ti-plus"></i></button>
                        </div>
                    </div>
                </div>


                <div class="col-6 d-flex justify-content-end">
                    <button type="submit" class="btn btn-dark ">Simpan</button>
                </div>
            </form>
            <!-- BATAS -->
        </div>
    </div>
</div>

<!-- Modal Cari Pegawai-->
<div class="modal fade" id="cariPegawai" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cari Pegawai</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-hover table-bordered border-dark table-sm" id="tbPilihPegawai" style="--bs-border-opacity: .3;">
                    <thead>
                        <tr>
                            <th style="width: 0%;">#</th>
                            <th>Nama</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($pegawai as $key) : ?>
                            <tr id="row_pegawai" data-id_pegawai="<?= $key->id_pegawai ?>" data-nama="<?= $key->nama_pegawai ?>">
                                <td><?= $no++ ?></td>
                                <td><?= $key->nama_pegawai ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>