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
                <h3 class="text-center text-bolder">DOKUMEN PENGAMBILAN HONOR</h3>
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
            <tr class="my-table">
                <th style="width:5%">No</th>
                <th>Nama Pegawai</th>
                <th style="width:5%">#</th>
                <th>Tanda Tangan</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            $no_x = 1;
            foreach ($pegawai as $pg) : ?>
                <tr class="my-table">
                    <td><?= $no++ ?></td>
                    <td><?= $pg->nama_pegawai ?></td>
                    <td><?= $no_x++ ?></td>
                    <td></td>
                </tr>

            <?php endforeach; ?>
        </tbody>
    </table>
</body>


<script>
    window.print();
</script>