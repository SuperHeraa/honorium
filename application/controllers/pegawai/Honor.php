<?php

class Honor extends CI_Controller
{
    // fungsi agar user harus login dulu
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        block_admin();
        $this->load->model('m_honor');
    }
    public function index()
    {

        $data['title'] = 'Dashboard Pegawai';
        $this->load->view('template_pegawai/header');
        $this->load->view('template_pegawai/sidebar');
        $this->load->view('pegawai/vhonor', $data);
        $this->load->view('template_pegawai/footer');
    }

    public function show()
    {
        $date = date('m');
        $year = date('Y');
        $bulantahun = $date . $year;

        $idp = $this->session->userdata('id_pegawai');
        $result = $this->m_honor->showData($idp, $bulantahun);

        echo json_encode($result);
    }

    public function search()
    {
        $bulantahun = $this->input->post('search');
        $idp = $this->session->userdata('id_pegawai');
        $data = $this->m_honor->showData($idp, $bulantahun);
        echo json_encode($data);
    }

    public function slip()
    {
        $bulantahun = $this->input->post('slip_bulantahun');
        var_dump($bulantahun);
    }
}
