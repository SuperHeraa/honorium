<?php

class Generatepdf extends CI_Controller
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

        $bulantahun = $this->input->post();
        var_dump($bulantahun);
        die;

        $data = array(
            "dataku" => array(
                'bulantahun' => $bulantahun
            )
        );

        $this->load->library('pdf');

        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->filename = "slip.pdf";
        $this->pdf->load_view('pegawai/slip', $data);
    }
}
