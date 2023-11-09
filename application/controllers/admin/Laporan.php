<?php

class Laporan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        block_users();
    }
    public function index()
    {

        $data['title'] = 'Pelaporan';
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('admin/vlaporan', $data);
        $this->load->view('template/footer');
    }

    public function print_pengambilan($bulantahun)
    {
        $data['bultah'] = $bulantahun;
        $data['pegawai'] = $this->db->get('tb_pegawai')->result();
        $this->load->view('admin/print/printpengambilan', $data);
    }

    public function print_absensi($bulantahun)
    {

        $data['absensi'] = $this->modelAbsensi->get_absensi($bulantahun)->result();
        $data['bultah'] = $bulantahun;
        $this->load->view('admin/print/printabsensi', $data);
    }
    public function print_honor($bulantahun)
    {

        $data['bultah'] = $bulantahun;
        $data['honor'] = $this->modelHonor->data_arsip($bulantahun)->result();
        $data['perjam'] = $this->db->get_where('tb_honorjam', ['id' => 1])->row_array();
        $data['walas'] = $this->db->get_where('tb_honorjam', ['id' => 2])->row_array();
        $data['arsip'] = $this->db->get('tb_arsip')->row_array();

        $this->load->view('admin/print/printhonor', $data);
    }

    public function print_slip($bulantahun)
    {
        $data['bultah'] = $bulantahun;
        $data['honor'] = $this->modelHonor->data_arsip($bulantahun)->result();
        $this->load->view('admin/print/slip', $data);
    }
}
