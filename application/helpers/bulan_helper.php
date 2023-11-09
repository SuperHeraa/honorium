<?php
function bulan($nomor)
{
    if ($nomor === '01') {
        $nama_bulan = 'Januari';
        return $nama_bulan;
    } elseif ($nomor === '02') {
        $nama_bulan = 'Februari';
        return $nama_bulan;
    } elseif ($nomor === '03') {
        $nama_bulan = 'Maret';
        return $nama_bulan;
    } elseif ($nomor === '04') {
        $nama_bulan = 'April';
        return $nama_bulan;
    } elseif ($nomor === '05') {
        $nama_bulan = 'Mei';
        return $nama_bulan;
    } elseif ($nomor === '06') {
        $nama_bulan = 'Juni';
        return $nama_bulan;
    } elseif ($nomor === '07') {
        $nama_bulan = 'Juli';
        return $nama_bulan;
    } elseif ($nomor == '08') {
        $nama_bulan = 'Agustus';
        return $nama_bulan;
    } elseif ($nomor == '09') {
        $nama_bulan = 'September';
        return $nama_bulan;
    } elseif ($nomor == '10') {
        $nama_bulan = 'Oktober';
        return $nama_bulan;
    } elseif ($nomor == '11') {
        $nama_bulan = 'November';
        return $nama_bulan;
    } elseif ($nomor == '12') {
        $nama_bulan = 'Desember';
        return $nama_bulan;
    }
}
