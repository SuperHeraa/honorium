
<?php
class M_honor extends CI_Model
{
    public function showData($idp, $bulantahun)
    {

        // $jabatan = $this->db->get_where('rw_jabatan', ['id_pegawai' => $idp, 'bulantahun' => '092023'])->result();
        // $kegiatan = $this->db->get_where('tb_honor_kegiatan', ['id_pegawai' => $idp, 'bulantahun' => '092023'])->result();
        // $pegawai = $this->db->get_where('tb_arsip', ['idp' => $idp, 'bulantahun' => '092023'])->row_array();
        // $transport = $pegawai['jarak_transport'];
        // $honor_transport = $pegawai['honor_transport'];
        // $walas = $pegawai['status_walas'];
        // $honor_walas = $pegawai['honor_walas'];
        // $absensi = $this->db->get_where('tb_absensi', ['id_pegawai' => $idp, 'bulantahun' => '092023'])->row_array();
        // $hadir = $absensi['hadir'];



        // $this->db->select("honor_perjam");
        // $this->db->from('rw_jam');
        // $this->db->where(array('id_pegawai' => $idp, 'bulantahun' => '092023'));
        // $honor = $this->db->get()->row_array();
        // $perjam = 0;
        // is_null($honor['honor_perjam']) ? $perjam : $perjam = $honor['honor_perjam'];

        // $honor_jabatan = $this->db->query("SELECT SUM(honor_jabatan) as total_honor FROM rw_jabatan WHERE id_pegawai =$idp && bulantahun='092023'")->row_array();
        // $honor_kegatan = $this->db->query("SELECT SUM(honor_kegiatan) as total_honor_kegiatan FROM tb_honor_kegiatan WHERE id_pegawai =$idp && bulantahun='092023'")->row_array();
        // $total_jam = $this->db->query("SELECT SUM(jumlah_jam) as total FROM rw_jam WHERE id_pegawai =$idp && bulantahun='092023'")->row_array();

        // $totJam = $total_jam['total'];
        // is_null($totJam) ? $totJam = 0 : $totJam;

        // // hitung total honor
        // $total_mengajar = $perjam * $totJam;
        // $upah_jabatan = $honor_jabatan['total_honor'];
        // is_null($upah_jabatan) ? $upah_jabatan = 0 : $upah_jabatan;
        // $total_jabatan = 0;
        // $walas == 1 ? $total_jabatan = $upah_jabatan + $honor_walas : $total_jabatan = $upah_jabatan;
        // $total_transport = $honor_transport * $hadir;
        // $total_kegiatan = 0;
        // is_null($honor_kegatan['total_honor_kegiatan']) ? $total_kegiatan : $total_kegiatan = $honor_kegatan['total_honor_kegiatan'];

        // $total_keseluruhan = $total_mengajar + $total_jabatan + $total_transport + $total_kegiatan;



        // $other = [
        //     'hadir' => $hadir,
        //     'honor_perjam' => $perjam

        // ];

        // $status_walas = [
        //     'status_walas' => $walas,
        //     'honor_walas' => $honor_walas
        // ];

        // $hitung = [
        //     'total_mengajar' => $total_mengajar,
        //     'total_jabatan' => $total_jabatan,
        //     'total_transport' => $total_transport,
        //     'total_kegiatan'  => $total_kegiatan,
        //     'total_keseluruhan' => $total_keseluruhan
        // ];


        $jabatan = $this->db->get_where('rw_jabatan', ['id_pegawai' => $idp, 'bulantahun' => $bulantahun])->result();
        $jam_mengajar = $this->db->get_where('rw_jam', ['id_pegawai' => $idp, 'bulantahun' => $bulantahun])->result();
        $kegiatan = $this->db->get_where('tb_honor_kegiatan', ['id_pegawai' => $idp, 'bulantahun' => $bulantahun])->result();

        // =======================================================================================================
        $arsip = $this->db->get_where('tb_arsip', ['idp' => $idp, 'bulantahun' => $bulantahun])->row_array();
        $status_walas = $arsip['status_walas'];
        $honor_walas = $arsip['honor_walas'];
        $hadir = $arsip['hadir'];
        $jarak = $arsip['jarak_transport'];
        $honor_transport = $arsip['honor_transport'];
        if (is_null($status_walas)) {
            $status_walas = 0;
        }
        if (is_null($honor_walas)) {
            $honor_walas = 0;
        }
        if (is_null($hadir)) {
            $hadir = 0;
        }
        if (is_null($jarak)) {
            $jarak = 0;
        }
        if (is_null($honor_transport)) {
            $honor_transport = 0;
        }
        $other = [
            'status_walas' => $status_walas,
            'honor_walas'   => $honor_walas,
            'hadir' => $hadir,
            'jarak_transport' => $jarak,
            'honor_transport' => $honor_transport
        ];

        // =========================================================================================================

        // =========================================================================================================
        // mengambil data sum jumlah jam
        $total_jam = $this->db->query("SELECT SUM(jumlah_jam) as totalJam FROM rw_jam WHERE id_pegawai=$idp && bulantahun=$bulantahun")->row_array();
        $jumlah_jam = $total_jam['totalJam'];
        if (is_null($jumlah_jam)) {
            $jumlah_jam = 0;
        }

        // ambill honor perjam
        $cek_id = $this->db->get_where('rw_jam', ['id_pegawai' => $idp, 'bulantahun' => $bulantahun])->num_rows();
        $honor_perjam = 0;
        if ($cek_id > 0) {
            $honor = $this->db->select('honor_perjam')
                ->where(array('id_pegawai' => $idp, 'bulantahun' => $bulantahun))
                ->get('rw_jam')->row_array();
            $honor_perjam = $honor['honor_perjam'];
        }


        // hitung total honor jabatan
        $honor_jabatan = $this->db->query("SELECT SUM(honor_jabatan) as totalHonorJabatan FROM rw_jabatan WHERE id_pegawai=$idp && bulantahun=$bulantahun")->row_array();
        $total_honorJabatan = $honor_jabatan['totalHonorJabatan'];
        $wali_kelas = $arsip['honor_walas'];
        if (is_null($total_honorJabatan)) {
            $total_honorJabatan = 0;
        }
        if (is_null($wali_kelas)) {
            $wali_kelas = 0;
        }
        $total_jabatan = $total_honorJabatan + $wali_kelas;

        // hitung total honor Mengajar ( RUMUS : jumlah jam * honor_perjam )
        $total_jam = $jumlah_jam * $honor_perjam;

        // hitung total honor transport ( RUMUS : honor transport * kehadiran )
        $total_transport = $arsip['honor_transport'] * $arsip['hadir'];

        // hitung total honor kegiatan
        $honor_kegiatan = $this->db->query("SELECT SUM(honor_kegiatan) as totalKegiatan FROM tb_honor_kegiatan WHERE id_pegawai=$idp && bulantahun=$bulantahun")->row_array();
        $total_kegiatan = $honor_kegiatan['totalKegiatan'];
        if (is_null($total_kegiatan)) {
            $total_kegiatan = 0;
        }

        //hitung total keseluruhan pendapatan
        $total_pendapatan = $total_jabatan + $total_kegiatan + $total_jam + $total_transport;


        // masukan ke array
        $hitungan = [
            'jumlah_jam' => $jumlah_jam,
            'perjam'    => $honor_perjam,
            'total_jabatan' => $total_jabatan,
            'total_kegiatan'    => $total_kegiatan,
            'total_jam' => $total_jam,
            'total_transport'   => $total_transport,
            'total_pendapatan'  => $total_pendapatan

        ];

        // =========================================================================================================

        $data = [
            'jabatan'   => $jabatan,
            'jam'       => $jam_mengajar,
            'other'     => $other,
            'kegiatan'  => $kegiatan,
            'hitungan'  => $hitungan,
            'bulantahun' => $bulantahun
        ];

        return $data;
    }
}
