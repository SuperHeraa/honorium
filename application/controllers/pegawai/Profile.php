<?php

class Profile extends CI_Controller
{
    // fungsi agar user harus login dulu
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        block_admin();
        $this->load->model('m_profile');
    }
    public function index()
    {
        $idp = $this->session->userdata('id_pegawai');

        $data['title'] = 'Dashboard Pegawai';
        $data['pegawai'] = $this->m_profile->my_profile($idp);
        $data['jabatan'] = $this->m_profile->jabatan($idp);
        $data['jam'] = $this->m_profile->jam($idp);
        $this->load->view('template_pegawai/header');
        $this->load->view('template_pegawai/sidebar');
        $this->load->view('pegawai/vprofile', $data);
        $this->load->view('template_pegawai/footer');
    }

    public function get_update()
    {

        $idp = $this->session->userdata('id_pegawai');
        $data = $this->db->query("SELECT * FROM tb_pegawai WHERE id_pegawai = $idp ")->row_array();
        echo json_encode($data);
    }

    public function update()
    {
        $idp = $this->session->userdata('id_pegawai');
        $username = htmlspecialchars($this->input->post('username'));
        $query = $this->db->get_where('tb_pegawai', ['id_pegawai' => $idp])->row_array();
        $newUsername = $query['username'];

        $data = array(
            'db' => $this->m_profile->update_username($idp, $username),
            'username' => $newUsername,
            'msg' => '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        Username berhasil di update!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>'
        );
        echo json_encode($data);
    }

    public function upload_img()
    {
        $idp = $this->session->userdata('id_pegawai');
        $pegawai = $this->db->get_where('tb_pegawai', ['id_pegawai' => $idp])->row_array();
        $old_image = $pegawai['image'];

        if (isset($_POST['image'])) {

            $lokasi_direktori = 'assets/images/profile/';
            if ($old_image != 'default_avatar.png') {
                unlink(FCPATH . $lokasi_direktori . $old_image);
            }

            $data = $_POST["image"];
            $image_array_1 = explode(";", $data);
            $image_array_2 = explode(",", $image_array_1[1]);
            $data = base64_decode($image_array_2[1]);

            $imageDb = time() . '.png';
            $imageName = $lokasi_direktori . time() . '.png';
            file_put_contents($imageName, $data);

            $showImage = base_url('assets/images/profile/') . $imageDb;

            $this->db->set('image', $imageDb);
            $this->db->where('id_pegawai', $idp);
            $this->db->update('tb_pegawai');

            echo '<img src="' . $showImage . '" class="rounded mx-auto d-block sahdow" width="150">';
        }
    }

    public function cek_username()
    {
        $username = $this->input->post('username');
        $count = $this->m_profile->cekUsername($username);
        if ($count == TRUE) {
            echo json_encode(false);
        } else {
            echo json_encode(true);
        }
    }

    public function cek_password()
    {
        $password = $this->input->post('oldPass');
        $cek = $this->m_profile->cekPassword($password);

        if ($cek == TRUE) {
            echo json_encode(true);
        } else {
            echo json_encode(false);
        }
    }

    public function update_pass()
    {
        $idp = $this->session->userdata('id_pegawai');
        $newPass = $this->input->post('newPass');
        $result = $this->m_profile->updatePass($idp, $newPass);

        $status = "";
        if ($result == true) {
            $status = "success";
        } else {
            $status = "failed";
        }

        $data = [
            'status' => $status,
            'msg' => '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        Password berhasil di update!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>'
        ];

        echo json_encode($data);
    }
}
