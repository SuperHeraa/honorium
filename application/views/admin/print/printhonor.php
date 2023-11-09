<?php if ((isset($_GET['bulan']) && $_GET['bulan'] != '') && isset($_GET['tahun']) && $_GET['tahun'] != '') {
    $bulan = $_GET['bulan'];
    $tahun = $_GET['tahun'];
    $bulantahun = $bulan . $tahun;
} else {
    $bulan = date('m');
    $tahun = date('Y');
    $bulantahun = $bulan . $tahun;
} ?>
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

            .bulantahun {
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
                <h3 class="text-center text-bolder">LAPORAN DATA HONOR PEGAWAI</h3>
                <h5>SMK CITRA MANDIRI GURANTENG</h5>
            </td>
            <td style="width: 120px;"></td>
        </tr>
    </table>

    <div class="bulantahun mb-3">
        <?php
        $bulan = substr($bultah, 0, 2);
        $tahun = substr($bultah, 2, 6);
        ?>
        Bulan : <?= bulan($bulan) ?><br>
        Tahun : <?= $tahun ?>
    </div>


    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pegawai</th>
                <th>Mengajar</th>
                <th>Jabatan</th>
                <th>Transport</th>
                <th>Kegiatan</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            foreach ($honor as $hn) : ?>

                <!-- hitung honor -->
                <?php
                $honorPerjam = $this->db->get_where('rw_jam', ['id_pegawai' => $hn->idp, 'bulantahun' => $bultah])->row_array();
                $honor_jam = is_null($honorPerjam) ? 0 : $hn->total_jam * $honorPerjam['honor_perjam'];
                $honor_jabatan = $hn->total_honor_jabatan;
                $honor_transport = $hn->honor_transport * $hn->hadir;
                $honor_kegiatan = $hn->total_honor_kegiatan;

                if ($hn->status_walas == 1) {
                    $honor_jabatan += $hn->honor_walas;
                }

                $total_honor = $honor_jam + $honor_jabatan + $honor_transport + $honor_kegiatan;

                ?>

                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $hn->nama_pegawai ?></td>
                    <td>Rp. <?= rupiah($honor_jam) ?></td>
                    <td>Rp. <?= rupiah($honor_jabatan) ?></td>
                    <td>Rp. <?= rupiah($honor_transport) ?></td>
                    <td>Rp. <?= rupiah($honor_kegiatan) ?></td>
                    <td>Rp. <?= rupiah($total_honor) ?></td>
                </tr>

            <?php endforeach; ?>
        </tbody>
    </table>
</body>


<script>
    window.print();
</script>