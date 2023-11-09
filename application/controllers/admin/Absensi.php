<?php

class Absensi extends CI_Controller
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

        $data['title'] = 'Absensi';
        $data['absensi'] = $this->modelAbsensi->get_absensi($bulantahun)->result();
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('admin/vabsensi', $data);
        $this->load->view('template/footer');
    }

    public function insert_batch()
    {
        // insert batch kehadiran
        $result = array();

        foreach ($this->input->post('id_pegawai') as $key => $val) {

            // mengambil data dari method post
            $hadir = $this->input->post('hadir');
            $izin = $this->input->post('izin');
            $sakit = $this->input->post('sakit');
            $alfa = $this->input->post('alfa');

            if ($sakit == '') {
                $sakit = 0;
            } elseif ($izin == '') {
                $izin = 0;
            } elseif ($alfa == '') {
                $alfa = 0;
            } elseif ($hadir == '') {
                $hadir = 0;
            }

            $result[] = array(
                'id_pegawai'    => $this->input->post('id_pegawai')[$key],
                'bulantahun'    => $this->input->post('bulantahun')[$key],
                'hadir'    => $hadir[$key],
                'izin'    => $izin[$key],
                'sakit'    => $sakit[$key],
                'alfa'    => $alfa[$key],
            );
        }
        $this->db->insert_batch('tb_absensi', $result);

        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        Data Baru Berhasil Ditambahkan!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>');
        redirect('admin/absensi');
    }

    public function input()
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

        $data['title'] = 'Input Kehadiran Pegawai';
        $data['input_absensi'] = $this->db->query("SELECT * FROM tb_pegawai WHERE NOT EXISTS (SELECT * FROM tb_absensi WHERE bulantahun='$bulantahun' AND tb_pegawai.id_pegawai=tb_absensi.id_pegawai) ORDER BY tb_pegawai.nama_pegawai")->result();
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('admin/vinputabsensi', $data);
        $this->load->view('template/footer');
    }


    public function edit($id, $bulantahun)
    {
        $hadir = $this->input->post('hadir');
        $sakit = $this->input->post('sakit');
        $izin = $this->input->post('izin');
        $alfa = $this->input->post('alfa');

        $where = array('id_pegawai' => $id, 'bulantahun' => $bulantahun);
        $data = array(
            'hadir' => $hadir,
            'sakit' => $sakit,
            'izin'  => $izin,
            'alfa'  => $alfa
        );

        $this->modelAbsensi->edit($where, $data, 'tb_absensi');
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show flash" role="alert">
        Data Berhasil di Update!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>');
        redirect('admin/absensi');
    }

    public function manage()
    {
        $data['absensi'] = $this->db->query("SELECT * FROM tb_absensi GROUP BY bulantahun ASC")->result();
        $data['title'] = 'Manajemen Absensi';
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('admin/vabsenmanage', $data);
        $this->load->view('template/footer');
    }

    public function hapus_absen($bulantahun)
    {
        $this->db->where(array('bulantahun' => $bulantahun));
        $this->db->delete('tb_absensi');

        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show flash" role="alert">
        Data berhasil di hapus!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>');
        redirect('admin/absensi/manage');
    }

    public function reset_absen()
    {
        $this->db->truncate('tb_absensi');

        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        Data Arsip Berhasil Di Reset!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>');
        redirect('admin/absensi/manage');
    }
}
