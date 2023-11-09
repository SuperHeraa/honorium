<?php

class Dashboard extends CI_Controller
{
    // fungsi agar user harus login dulu
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        block_users();
    }
    public function index()
    {

        $pegawai = $this->db->query('SELECT * FROM tb_pegawai');
        $jabatan = $this->db->query('SELECT * FROM tb_jabatan');
        $mapel = $this->db->query('SELECT * FROM tb_jam_mengajar');

        $data['pegawai'] = $pegawai->num_rows();
        $data['jabatan'] = $jabatan->num_rows();
        $data['mapel'] = $mapel->num_rows();
        $data['title'] = 'Dashboard';
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('admin/vdashboard', $data);
        $this->load->view('template/footer');
    }
}
