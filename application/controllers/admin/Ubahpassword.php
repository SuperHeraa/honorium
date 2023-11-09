<?php

class Ubahpassword extends CI_Controller
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
        $idku = $this->session->userdata('id_pegawai');
        $data['pegawai'] = $this->db->query("SELECT * FROM tb_pegawai WHERE id_pegawai != $idku ORDER BY nama_pegawai")->result();

        $data['title'] = 'Reset Password Pegawai';
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('admin/vubahpass', $data);
        $this->load->view('template/footer');
    }

    public function reset($id)
    {
        $where = array('id_pegawai' => $id);
        $newPass = password_hash($this->input->post('new_password'), PASSWORD_DEFAULT);

        $this->db->where($where);
        $this->db->update('tb_pegawai', array('password' => $newPass));

        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show flash" role="alert">
        Password Berhasil Diperbarui!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>');
        redirect('admin/ubahpassword');
    }

    public function myreset()
    {
        $id = $this->session->userdata('id_pegawai');
        $myPass = password_hash($this->input->post('mypass'), PASSWORD_DEFAULT);

        $this->db->where(array('id_pegawai' => $id));
        $this->db->update('tb_pegawai', array('password' => $myPass));

        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show flash" role="alert">
        Password Berhasil Diperbarui!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>');
        redirect('admin/ubahpassword');
    }
}
