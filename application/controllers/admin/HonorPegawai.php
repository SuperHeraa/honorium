<?php

class HonorPegawai extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        block_users();
    }
    public function index()
    {
        if ((isset($_GET['bulan']) && $_GET['bulan'] != '') && isset($_GET['tahun']) && $_GET['tahun'] != '') {
            $bulan = $_GET['bulan'];
            $tahun = $_GET['tahun'];
            $bulantahun = $bulan . $tahun;
        } else {
            $bulan = date('m');
            $tahun = date('Y');
            $bulantahun = $bulan . $tahun;
        }

        $data['honor'] = $this->modelHonor->honor_pegawai($bulantahun)->result();
        // $data['detail_honor'] = $this->modelHonor->honor_pegawai($bulantahun)->result();
        $data['perjam'] = $this->db->get_where('tb_honorjam', ['id' => 1])->row_array();
        $data['walas'] = $this->db->get_where('tb_honorjam', ['id' => 2])->row_array();
        $data['arsip'] = $this->db->get('tb_arsip')->row_array();

        $data['title'] = 'Honor Pegawai';
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('admin/vpayhonor', $data);
        $this->load->view('template/footer');
    }

    public function kegiatan()
    {

        $data['pegawai'] = $this->db->get('tb_pegawai')->result();

        $data['title'] = 'Tambah Honor Kegiatan';
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('admin/vhonorKegiatan', $data);
        $this->load->view('template/footer');
    }

    public function store_kegiatan()
    {
        $id_pegawai = $this->input->post('id_pegawai');
        $nama_kegiatan = $this->input->post('nama_kegiatan');
        $honor_kegiatan = $this->input->post('honor_kegiatan');
        $bulan = $this->input->post('bulan');
        $tahun = $this->input->post('tahun');
        $bulantahun = $bulan . $tahun;

        $jmlData = count($nama_kegiatan);

        for ($i = 0; $i < $jmlData; $i++) {
            $this->db->insert(
                'tb_honor_kegiatan',
                [
                    'id_pegawai'    => $id_pegawai,
                    'bulantahun'    => $bulantahun,
                    'nama_kegiatan' => $nama_kegiatan[$i],
                    'honor_kegiatan'   => reset_rupiah($honor_kegiatan[$i]),
                ]
            );
        }
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Data Kegiatan Berhasil Ditambahkan!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>');
        $this->kegiatan();
    }

    public function detail($id, $bulantahun)
    {

        $data['pegawai'] = $this->modelHonor->detail_pegawai($id, $bulantahun)->row_array();
        $data['jam'] = $this->modelHonor->detail_jam($id)->result();
        $data['jumlah_jam'] = $this->db->query("SELECT SUM(jumlah_jam) as jmlJam FROM tmp_jam WHERE id_pegawai=$id")->row_array();
        $data['perjam'] = $this->db->get_where('tb_honorjam', ['id' => 1])->row_array();
        $data['jabatan'] = $this->modelHonor->detail_jabatan($id)->result();
        $data['jml_jabatan'] = $this->db->query("SELECT SUM(honor) as jmlJab FROM tmp_jabatan WHERE id_pegawai=$id")->row_array();
        $data['kegiatan'] = $this->modelHonor->detail_kegiatan($id, $bulantahun)->result();
        $data['jumlah_kegiatan'] = $this->modelHonor->jmlkegiatan($id, $bulantahun)->row_array();
        $data['honorWalas'] = $this->db->get_where('tb_honorjam', ['id' => 2])->row_array();


        $data['title'] = 'Detail Honor Pegawai';
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('admin/vdetailHonor', $data);
        $this->load->view('template/footer');
    }

    // Arsipkan Data
    public function arsip()
    {
        $id = $this->input->post('id_pegawai');
        $jml_data = count($id);
        $bulantahun = $this->input->post('bulantahun');
        $honor_perjam = $this->db->get_where('tb_honorjam', ['id' => 1])->row_array();

        if ($id != null) {

            for ($i = 0; $i < $jml_data; $i++) {

                $idp = $this->input->post('id_pegawai[' . $i . ']');
                $rw_pg = $this->db->query("SELECT * FROM tb_pegawai JOIN tb_transport ON tb_pegawai.id_transport=tb_transport.id_transport WHERE tb_pegawai.id_pegawai = $idp")->row_array();
                $kehadiran = $this->db->query("SELECT hadir FROM tb_absensi WHERE bulantahun=$bulantahun AND id_pegawai=$idp")->row_array();
                $walas = $this->db->get_where('tb_honorjam', ['id' => 2])->row_array();
                $honor_walas = 0;
                if ($rw_pg['walas'] == 1) {
                    $honor_walas = $walas['honor'];
                }
                $datas[$i] = array(
                    'bulantahun'    => $bulantahun,
                    'idp'    => $this->input->post('id_pegawai[' . $i . ']'),
                    'jarak_transport'   => $rw_pg['jarak'],
                    'honor_transport'   => $rw_pg['honor_transport'],
                    'status_walas'  => $rw_pg['walas'],
                    'hadir'         => $kehadiran['hadir'],
                    'honor_walas'   => $honor_walas
                );
                $this->db->insert('tb_arsip', $datas[$i]);

                $data_jam = $this->db->query("SELECT * FROM tmp_jam JOIN tb_jam_mengajar ON tmp_jam.id_jam=tb_jam_mengajar.id_jam WHERE tmp_jam.id_pegawai = $idp")->result();
                foreach ($data_jam as $jam) {
                    $datajam[$i] = array(
                        'bulantahun'    => $bulantahun,
                        'id_pegawai'    => $jam->id_pegawai,
                        'mapel'         => $jam->nama_mapel,
                        'jumlah_jam'    => $jam->jumlah_jam,
                        'honor_perjam'   => $honor_perjam['honor']
                    );

                    $this->db->insert('rw_jam', $datajam[$i]);
                }

                //insert data riwayat jabatan
                $rw_jab = $this->db->query("SELECT * FROM tmp_jabatan JOIN tb_jabatan ON tb_jabatan.id_jabatan=tmp_jabatan.id_jabatan WHERE tmp_jabatan.id_pegawai = $idp")->result();
                foreach ($rw_jab as $jab) {
                    $dataJab[$i] = array(
                        'bulantahun'    => $bulantahun,
                        'id_pegawai'    => $jab->id_pegawai,
                        'nama_jabatan'  => $jab->nama_jabatan,
                        'honor_jabatan' => $jab->honor
                    );

                    $this->db->insert('rw_jabatan', $dataJab[$i]);
                }
            }

            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show flash" role="alert">
            Berhasil!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>');
            redirect('admin/honorpegawai');
        }
    }

    public function print()
    {
        if ((isset($_GET['bulan']) && $_GET['bulan'] != '') && isset($_GET['tahun']) && $_GET['tahun'] != '') {
            $bulan = $_GET['bulan'];
            $tahun = $_GET['tahun'];
            $bulantahun = $bulan . $tahun;
        } else {
            $bulan = date('m');
            $tahun = date('Y');
            $bulantahun = $bulan . $tahun;
        }
        $data['honor'] = $this->modelHonor->honor_pegawai($bulantahun)->result();
        $data['detail_honor'] = $this->modelHonor->honor_pegawai($bulantahun)->result();
        $data['perjam'] = $this->db->get_where('tb_honorjam', ['id' => 1])->row_array();
        $data['walas'] = $this->db->get_where('tb_honorjam', ['id' => 2])->row_array();
        $data['arsip'] = $this->db->get('tb_arsip')->row_array();

        $this->load->view('admin/print/printhonor', $data);
    }
}
