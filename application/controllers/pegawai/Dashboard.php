<?php

class Dashboard extends CI_Controller
{
    // fungsi agar user harus login dulu
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        block_admin();
    }
    public function index()
    {

        $data['title'] = 'Dashboard Pegawai';
        $this->load->view('template_pegawai/header');
        $this->load->view('template_pegawai/sidebar');
        $this->load->view('pegawai/vdashboard', $data);
        $this->load->view('template_pegawai/footer');
    }
}
