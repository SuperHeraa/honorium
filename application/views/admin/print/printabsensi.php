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

            body {
                -webkit-print-color-adjust: exact;
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

        }
    </style>

</head>

<body>
    <table class="table bordered border-dark text-dark">
        <tr class="text-center">
            <td style="width: 120px"><img src="<?= base_url('assets/images/logos/logo.png') ?>" style="width: 120px;"></td>
            <td>
                <h3 class="text-center text-bolder">LAPORAN DATA KEHADIRAN PEGAWAI</h3>
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
                <th>Hadir</th>
                <th>Sakit</th>
                <th>Izin</th>
                <th>Alfa</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            foreach ($absensi as $key) : ?>

                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $key->nama_pegawai ?></td>
                    <td><?= $key->hadir ?></td>
                    <td><?= $key->sakit ?></td>
                    <td><?= $key->izin ?></td>
                    <td><?= $key->alfa ?></td>
                </tr>

            <?php endforeach; ?>
        </tbody>
    </table>
</body>


<script>
    window.print();
</script>