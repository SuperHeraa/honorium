<?php

class Other extends CI_Controller
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

        $data['pegawai'] = $this->db->get_where('tb_pegawai', ['id_pegawai' => $this->session->userdata('id_pegawai')])->row_array();
        $data['title'] = 'Lainya';

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('admin/vlainya', $data);
        $this->load->view('template/footer');
    }

    public function backup()
    {
        $this->load->dbutil();
        $this->load->helper('file');

        $config = array(
            'format'    => 'zip',
            'filename'    => 'honorium.sql'
        );

        $backup = $this->dbutil->backup($config);
        $name = 'backup-' . date("ymdHis") . '-db.zip';
        $save = FCPATH . 'backup_db/' . $name;
        write_file($save, $backup);

        $this->load->helper('download');
        force_download('backup_db/' . $name, NULL);

        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show flash" role="alert">
        Database Berhasil di Backup!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>');
        redirect('admin/other');
    }

    public function restoredb()
    {
        $fupload = $_FILES['berkas'];
        $nama_file = $_FILES['berkas']['name'];


        // jika bukan file sql
        $fix_name = 'honorium.sql';
        if ($nama_file != $fix_name) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            File tidak sesuai!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>');
            redirect('admin/other');
        } else {
            if (isset($fupload)) {
                $lokasi_file = $fupload['tmp_name'];
                $direktori = "restoredb/$nama_file";
                move_uploaded_file($lokasi_file, "$direktori");
            } else {
                echo 'upload gagal';
            }
        }

        //restore database
        $isi_file = file_get_contents($direktori);
        $string_query = rtrim($isi_file, "\n;");
        $array_query = explode(";", $string_query);

        foreach ($array_query as $query) {
            $this->db->query($query);
        }
        unlink("restoredb/" . $nama_file);
        $this->load->view('admin/vrestoresuccess');
    }

    public function upload()
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

            echo '<img src="' . $showImage . '" class="img-fluid" width="100">';
        }
    }


    public function resetApp()
    {
        // hapus data

        $this->db->truncate('tb_pegawai');
        $this->db->truncate('rw_jabatan');
        $this->db->truncate('rw_jam');
        $this->db->truncate('tb_absensi');
        $this->db->truncate('tb_arsip');
        $this->db->truncate('tb_honor_kegiatan');
        $this->db->truncate('tb_jabatan');
        $this->db->truncate('tb_jam_mengajar');
        $this->db->truncate('tb_transport');
        $this->db->truncate('tmp_jabatan');
        $this->db->truncate('tmp_jam');

        // insert data default admin

        $pw_admin = password_hash('admin', PASSWORD_DEFAULT);
        $admin = [
            'nama_pegawai' => 'Administrator',
            'jenis_kelamin' => 'L',
            'alamat' => 'Ciamis',
            'id_transport' => 1,
            'image' => 'default_avatar.png',
            'username'  => 'admin',
            'password'  => $pw_admin,
            'hak_akses' => 1
        ];

        $this->db->insert('tb_pegawai', $admin);

        // insert jarak default
        $transport = [
            'jarak' => '0 KM',
            'honor_transport' => 0
        ];

        $this->db->insert('tb_transport', $transport);

        $this->session->sess_destroy();

        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        Aplikasi Selesai Direset!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>');
        redirect('welcome');
    }
}
