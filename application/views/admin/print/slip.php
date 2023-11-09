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

            .pagebreak {
                page-break-before: always;
            }

            @page {
                margin: 0.3in 0.3in 0.3in 0.3in !important;

            }

            table {
                color: #000 !important;
            }

            .bulantahun {
                color: #000 !important;
            }

            body {
                -webkit-print-color-adjust: exact;
                font-family: Arial, Helvetica, sans-serif !important;
                font-size: 15px !important;
                color: #000 !important;
            }

            .detail {
                background-color: powderblue !important;
            }
        }
    </style>

</head>
<?php
$bulan = substr($bultah, 0, 2);
$tahun = substr($bultah, 2, 6);
?>

<body>
    <?php foreach ($honor as $key) : ?>
        <div class="square">
            <strong>SLIP GAJI SEKOLAH MENENGAH KEJURUAN CITRA MANDIRI</strong><br>
            <span>Kp. Cikerenceng Rt/Rw. 03/11 Ds. Guranteng</span><br>
            <span>Telp.082317406363</span>
            <div class="row mt-3 border-top border-bottom border-dark py-2">
                <div class="col">
                    Nama : <?= $key->nama_pegawai ?><br>
                    Alamat : <?= $key->alamat ?>
                </div>
                <div class="col d-flex justify-content-center">
                    Bulan : <?= bulan($bulan) . ' ' . $tahun ?><br>
                </div>
            </div>
            <div class="row mt-3 detail py-2 px-2 mb-3">
                <div class="col d-flex justify-content-center">
                    <strong>Keterangan</strong>
                </div>
                <div class="col d-flex justify-content-end">
                    <strong>Jumlah</strong>
                </div>
            </div>
            <div class="row mb-2 border-bottom border-info"> <!-- Honor Jam Mengajar -->
                <?php
                $perJam = $this->db->get_where('rw_jam', ['id_pegawai' => $key->idp, 'bulantahun' => $bultah])->row_array();
                $cekjam = is_null($key->total_jam);

                $honor_perjam = 0;
                if (!is_null($perJam)) {
                    $honor_perjam = $perJam['honor_perjam'];
                }

                $totjam = 0;
                if (!$cekjam) {
                    $totjam = $key->total_jam;
                }

                $honor_mengajar = $totjam * $honor_perjam;
                ?>
                <div class="col">
                    <i class="ti ti-chevron-right"></i> <strong>Mengajar</strong> (<?= $totjam ?>)<br>
                    <i class="ti ti-chevron-right"></i> <?= $totjam ?> * <?= rupiah($honor_perjam) ?>
                </div>
                <div class="col d-flex justify-content-end">
                    <strong>Rp. <?= rupiah($honor_mengajar) ?></strong>
                </div>
            </div>
            <div class="row mb-2 border-bottom border-info"><!-- Honor Transport -->
                <?php $honorTransport = $key->honor_transport * $key->hadir; ?>
                <div class="col">
                    <i class="ti ti-chevron-right"></i> <strong>Transport</strong> (<?= $key->jarak_transport ?>)<br>
                    <i class="ti ti-chevron-right"></i> Rp. <?= rupiah($key->honor_transport) ?> * <?= $key->hadir . ' (Kehadiran)' ?>
                </div>
                <div class="col d-flex justify-content-end">
                    <strong>Rp. <?= rupiah($honorTransport) ?></strong>
                </div>
            </div>
            <div class="row mb-2 border-bottom border-info"> <!-- Honor Jabatan -->
                <?php
                $jabatan = $this->db->get_where('rw_jabatan', ['id_pegawai' => $key->idp, 'bulantahun' => $bultah])->result();
                ?>
                <div class="col">
                    <i class="ti ti-chevron-right"></i> <strong>Jabatan</strong><br>
                    <?php foreach ($jabatan as $jb) : ?>
                        <i class="ti ti-chevron-right"></i> <?= $jb->nama_jabatan ?> ( <?= rupiah($jb->honor_jabatan) ?> )<br>
                    <?php endforeach ?>
                    <?= $key->status_walas == 1 ? '<i class="ti ti-chevron-right"></i> Walas (' . rupiah($key->honor_walas) . ')' : ''   ?>
                </div>
                <div class="col d-flex justify-content-end">
                    <strong>Rp. <?= rupiah($key->total_honor_jabatan + $key->honor_walas) ?></strong>
                </div>
            </div>
            <?php
            $kegiatan = $this->db->get_where('tb_honor_kegiatan', ['id_pegawai' => $key->idp, 'bulantahun' => $bultah])->result();
            if (count($kegiatan) != 0) { ?><!-- Honor Kegiatan -->
                <div class="row mb-2 border-bottom border-info">
                    <div class="col">
                        <i class="ti ti-chevron-right"></i> <strong>Kegiatan</strong><br>
                        <?php foreach ($kegiatan as $kg) : ?>
                            <i class="ti ti-chevron-right"></i> <?= $kg->nama_kegiatan ?> ( <?= rupiah($kg->honor_kegiatan) ?> )<br>
                        <?php endforeach ?>
                    </div>
                    <div class="col d-flex justify-content-end">
                        <strong>Rp. <?= rupiah($key->total_honor_kegiatan) ?></strong>
                    </div>
                </div>
            <?php } ?>
            <div class="row mt-3 detail py-2 px-2"><!-- Total Honor -->
                <?php
                $honorWalas = 0;
                if ($key->status_walas == 1) {
                    $honorWalas = $key->honor_walas;
                }
                $total = $honor_mengajar + $honorTransport + $key->total_honor_jabatan + $key->total_honor_kegiatan + $honorWalas;
                ?>
                <div class="col">
                    <strong>Total : <strong class="text-italic"><?= ucwords(terbilang($total) . ' rupiah') ?></strong></strong>
                </div>
                <div class="col d-flex justify-content-end">
                    <strong>Rp. <?= rupiah($total) ?></strong>
                </div>
            </div>
            <div class="ttd">
                <table class="table table-borderless table-lg mt-3">
                    <tr>
                        <td>Mengetahui</td>
                    </tr>
                    <tr>
                        <td>.....................</td>
                    </tr>
                </table>
            </div>
            <hr class="dashed">
        </div>
        <div class="pagebreak"> </div>
    <?php endforeach; ?>
</body>