<div class="container-fluid">
    <?= $this->session->flashdata('message'); ?>

    <div class="card shadow-lg">
        <div class="card-header bg-dark" style="--bs-bg-opacity: .2;">
            <div class="row">
                <div class="col-6">
                    <h5>Daftar Pegawai</h5>
                </div>
                <div class="col-6 d-flex justify-content-end">
                    <a href="<?= base_url('admin/datapegawai/tambah_pegawai') ?>" class="btn btn-dark btn-sm me-2"><i class="ti ti-plus"></i> Tambah</a>
                    <button class="btn btn-dark btn-sm" onclick="printPage()"><i class="ti ti-printer"></i> Print</button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered text-dark" id="tablePegawai">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Jenis Kelamin</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Status</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($pegawai as $pg) : ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $pg->nama_pegawai ?></td>
                            <td><?= $pg->jenis_kelamin == 'L' ? 'Laki-Laki' : 'Perempuan' ?></td>
                            <td><?= $pg->alamat ?></td>
                            <td><?= $pg->hak_akses == 1 ? 'Admin' : 'Pegawai' ?></td>
                            <td>
                                <a href="<?= base_url('admin/datapegawai/detail/') . $pg->id_pegawai ?>" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="Detail"><i class="ti ti-eye-check"></i></a>
                                <a href="<?= base_url('admin/datapegawai/editP/') . $pg->id_pegawai ?>" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Edit"><i class="ti ti-edit"></i></a>
                                <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapusPegawai<?= $pg->id_pegawai ?>"><i class="ti ti-trash"></i></button>
                            </td>
                        </tr>

                        <!-- ModalDELET PEGAWAI -->
                        <div class="modal fade" id="hapusPegawai<?= $pg->id_pegawai ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Hapus Item</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="fst-italic">
                                            Data yang tersimpan atas nama <strong><?= $pg->nama_pegawai ?></strong>, <br>
                                            seperti Absensi, jabatan dst.. Akan hilang!<br>
                                        </div>
                                        <br>
                                        Anda yakin akan menghapus data ini ?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Tidak</button>
                                        <a href="<?= base_url('admin/datapegawai/hapus_pegawai/') . $pg->id_pegawai ?>" class="btn btn-danger">YA</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div id="printerDiv" style="display:none"></div>
    <!-- BATAS -->
</div>
</div>
</div>

<script>
    function printPage() {
        var div = document.getElementById("printerDiv");
        div.innerHTML = '<iframe src="<?= base_url('admin/datapegawai/print') ?>" onload="this.contentWindow.print();"></iframe>';
    }
</script>