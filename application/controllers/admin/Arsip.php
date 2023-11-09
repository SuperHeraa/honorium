<?php

class Arsip extends CI_Controller
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

        $data['title'] = 'Arsip Honor Pegawai';
        $data['arsip'] = $this->modelHonor->data_arsip($bulantahun)->result();
        $data['perjam'] = $this->db->get_where('rw_jam', ['bulantahun' => $bulantahun])->row_array();
        $data['walas'] = $this->db->get_where('tb_honorjam', ['id' => 2])->row_array();


        // data detail



        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('admin/varsip', $data);
        $this->load->view('template/footer');
    }

    public function detail($id, $bulantahun)
    {
        $data['honorWalas'] = $this->db->get_where('tb_arsip', ['idp' => $id, 'bulantahun' => $bulantahun])->row_array();
        $data['arsip_pegawai'] = $this->modelArsip->get_arsip($id, $bulantahun)->row_array();
        $data['jam'] = $this->modelArsip->detail_jam($id, $bulantahun)->result();
        $data['jumlah_jam'] = $this->db->query("SELECT SUM(jumlah_jam) as jmlJam FROM rw_jam WHERE id_pegawai=$id && bulantahun=$bulantahun")->row_array();
        $data['perjam'] = $this->db->get_where('rw_jam', ['id_pegawai' => $id, 'bulantahun' => $bulantahun])->row_array();
        $data['jabatan'] = $this->modelArsip->detail_jabatan($id, $bulantahun)->result();
        $data['jml_jabatan'] = $this->db->query("SELECT SUM(honor_jabatan) as jmlJab FROM rw_jabatan WHERE id_pegawai=$id && bulantahun=$bulantahun")->row_array();
        $data['kegiatan'] = $this->modelArsip->detail_kegiatan($id, $bulantahun)->result();
        $data['jumlah_kegiatan'] = $this->modelArsip->jmlkegiatan($id, $bulantahun)->row_array();


        $data['title'] = 'Detail Honor Pegawai';
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('admin/vdetailArsip', $data);
        $this->load->view('template/footer');
    }

    public function manage()
    {
        $data['arsip'] = $this->db->query("SELECT * FROM tb_arsip GROUP BY bulantahun ASC")->result();
        $data['title'] = 'Manajemen Arsip';
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('admin/varsipmanage', $data);
        $this->load->view('template/footer');
    }

    public function hapus_arsip($bulantahun)
    {
        $where = [
            'bulantahun' => $bulantahun
        ];

        // hapus data tb arsip
        $this->db->where($where);
        $this->db->delete('tb_arsip');

        // hapus data rw_jam
        $this->db->where($where);
        $this->db->delete('rw_jam');

        // hapus data rw_jabatan
        $this->db->where($where);
        $this->db->delete('rw_jabatan');

        // hapus data kegiatan
        $this->db->where($where);
        $this->db->delete('tb_honor_kegiatan');

        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show flash" role="alert">
        Data berhasil di hapus!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>');
        redirect('admin/arsip/manage');
    }

    public function reset_arsip()
    {
        $this->db->truncate('tb_arsip');
        $this->db->truncate('rw_jam');
        $this->db->truncate('rw_jabatan');

        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        Data Arsip Berhasil Di Reset!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>');
        redirect('admin/arsip/manage');
    }
}
