<?php
$bulan = date('m');
$tahun = date('Y');
$bulantahun = $bulan . $tahun;
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>css/styles.min.css" />

    <style>
        .dashed {
            border: none;
            height: 1px;
            background: #000;
            background: repeating-linear-gradient(90deg, #000, #000 6px, transparent 6px, transparent 12px);
        }

        @media print {
            @page {
                margin: 0.3in 0.3in 0.3in 0.3in !important;
                size: landscape;
                font-family: Arial, Helvetica, sans-serif;

            }


            thead {
                background-color: #dfe6e9 !important;
            }

            table {
                border-color: #000 !important;
                color: #000 !important;
            }


            body {
                -webkit-print-color-adjust: exact;
            }

        }
    </style>

</head>

<body>
    <table class="table border-dark">
        <tr class="text-center">
            <td style="width: 120px"><img src="<?= base_url('assets/images/logos/logo.png') ?>" style="width: 120px;"></td>
            <td>
                <h3 class="text-center text-bolder">LAPORAN DATA PEGAWAI</h3>
                <h5>SMK CITRA MANDIRI GURANTENG</h5>
            </td>
            <td style="width: 120px;"></td>
        </tr>
    </table>

    <table class="table table-bordered text-dark table-sm" id="tablePegawai">
        <thead>
            <tr>
                <th scope="col" class="text-center" style="width: 5%;">No</th>
                <th scope="col">Nama</th>
                <th scope="col">Jenis Kelamin</th>
                <th scope="col">Alamat</th>
                <th scope="col">Jarak Tempuh</th>
                <th scope="col">Jabatan</th>
                <th scope="col">Mata Pelajaran</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            foreach ($pegawai as $pg) : ?>
                <tr>
                    <td class="text-center"><?= $no++; ?></td>
                    <td><?= $pg->nama_pegawai ?></td>
                    <td><?= $pg->jenis_kelamin == 'L' ? 'Laki-Laki' : 'Perempuan' ?></td>
                    <td><?= $pg->alamat ?></td>
                    <td><?= $pg->jarak ?></td>
                    <td>
                        <?php
                        $datajabatan = $this->db->join('tb_jabatan', 'tb_jabatan.id_jabatan = tmp_jabatan.id_jabatan')->get_where('tmp_jabatan', ['tmp_jabatan.id_pegawai' => $pg->id_pegawai])->result();
                        $jml = count($datajabatan);
                        foreach ($datajabatan as $key) :
                        ?>
                            <i class="ti ti-chevron-right"></i> <?= $key->nama_jabatan ?><br>
                        <?php endforeach ?>
                        <?= $pg->walas == 1 ? '<i class="ti ti-chevron-right"></i> Walas' : '' ?>
                    </td>
                    <td>
                        <?php
                        $datamapel = $this->db->join('tb_jam_mengajar', 'tb_jam_mengajar.id_jam=tmp_jam.id_jam')->get_where('tmp_jam', ['tmp_jam.id_pegawai' => $pg->id_pegawai])->result();
                        foreach ($datamapel as $mapel) :
                        ?>
                            <i class="ti ti-chevron-right"></i> <?= $mapel->nama_mapel ?><br>
                        <?php endforeach ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>