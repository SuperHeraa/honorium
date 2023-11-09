<?php

class DataPegawai extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        block_users();
    }
    public function index()
    {
        $data['pegawai'] = $this->db->query("SELECT * FROM tb_pegawai")->result();
        $data['title'] = 'Data Pegawai';

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('admin/view_pegawai', $data);
        $this->load->view('template/footer');
    }

    public function tambah_pegawai()
    {

        $data['jarak_tempuh'] = $this->db->query('SELECT * FROM tb_transport')->result();
        $data['jam_mengajar'] = $this->db->query('SELECT id_jam, nama_mapel FROM tb_jam_mengajar WHERE id_jam NOT IN (SELECT id_jam FROM tmp_jam)')->result();
        $data['jabatan'] = $this->db->query('SELECT id_jabatan, nama_jabatan FROM tb_jabatan WHERE id_jabatan NOT IN (SELECT id_jabatan FROM tmp_jabatan)')->result();
        $data['title'] = 'Tambah Pegawai';
        $data['hak_akses'] = $this->db->get('hak_akses')->result();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('admin/view_tambahPegawai', $data);
        $this->load->view('template/footer');
    }

    public function store_pegawai()
    {
        $nama = htmlspecialchars($this->input->post('nama'));
        $alamat = htmlspecialchars($this->input->post('alamat'));
        $gender = htmlspecialchars($this->input->post('jenis_kelamin'));
        $jarak = htmlspecialchars($this->input->post('jarak'));
        $walas = htmlspecialchars($this->input->post('walas'));
        $image = 'default_avatar.png';
        $hak_akses = $this->input->post('hak_akses');
        $username = htmlspecialchars($this->input->post('username'));
        $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);

        if ($walas == null) {
            $walas = 0;
        }

        $data = array(
            'nama_pegawai'      => $nama,
            'jenis_kelamin'     => $gender,
            'alamat'            => $alamat,
            'id_transport'      => $jarak,
            'walas'             => $walas,
            'image'             => $image,
            'username'          => $username,
            'password'          => $password,
            'hak_akses'         => $hak_akses
        );

        $this->modelPegawai->store_pegawai($data, 'tb_pegawai');

        // PROSES INSERT DATA JAM MENGAJAR DARI CHECK BOX 

        $id_pegawai = $this->db->insert_id(); // mengambil id_pegawai yang saat ini ditambahkan

        if ($this->input->post('id_jam') != null) {

            $checkbox_jamNgajar = count($this->input->post('id_jam'));

            for ($i = 0; $i < $checkbox_jamNgajar; $i++) {

                $id_jam = $this->input->post('id_jam[' . $i . ']');
                $jumlah_jam['data'] = $this->db->query("SELECT jumlah_jam FROM tb_jam_mengajar WHERE id_jam = $id_jam")->row_array(); // ambil data jumlah jam

                $datas[$i] = array(
                    'id_pegawai'    => $id_pegawai,
                    'id_jam'        => $this->input->post('id_jam[' . $i . ']'),
                    'jumlah_jam'    => $jumlah_jam['data']['jumlah_jam']
                );

                $this->db->insert('tmp_jam', $datas[$i]);
            }
        }

        // PROSES INSERT DATA JABATAN DARI CHECKBOX

        if ($this->input->post('id_jabatan') != null) {
            $check_jabatan = count($this->input->post('id_jabatan'));

            for ($i = 0; $i < $check_jabatan; $i++) {

                // cari honor setiap jabatan
                $id_jabatan = $this->input->post('id_jabatan[' . $i . ']');
                $honorJabatan['jab'] = $this->db->query("SELECT honor_jabatan FROM tb_jabatan WHERE id_jabatan = $id_jabatan")->row_array();

                $data_jabatan[$i] = array(
                    'id_pegawai'    => $id_pegawai,
                    'id_jabatan'    => $this->input->post('id_jabatan[' . $i . ']'),
                    'honor'         => $honorJabatan['jab']['honor_jabatan']
                );
                $this->db->insert('tmp_jabatan', $data_jabatan[$i]);
            }
        }

        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        Data Baru Berhasil Ditambahkan!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>');
        redirect('admin/datapegawai');
    }


    public function hapus_pegawai($id)
    {
        $where = array('id_pegawai' => $id);
        $this->modelPegawai->hapus_pegawai($where, 'tb_pegawai');
        $this->modelPegawai->hapus_tmp_jam($where, 'tmp_jam');
        $this->modelPegawai->hapus_tmp_jabatan($where, 'tmp_jabatan');
        $this->modelPegawai->hapus_honor_kegiatan($where, 'tb_honor_kegiatan');
        $this->modelPegawai->hapus_absensi($where, 'tb_absensi');

        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        Data Berhasi Dihapus!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>');
        redirect('admin/datapegawai');
    }


    public function editP($id)
    {
        $hitung_tmp_jam = $this->db->query("SELECT * FROM tmp_jam WHERE id_pegawai = '$id' ");
        $hitung_tmp_jab = $this->db->query("SELECT * FROM tmp_jabatan WHERE id_pegawai = '$id' ");

        $data['pegawai'] = $this->modelPegawai->get_data_for_edit($id)->row_array();
        $data['jarak_tempuh'] = $this->db->query('SELECT * FROM tb_transport')->result();
        $data['jam_mengajar'] = $this->db->query('SELECT id_jam, nama_mapel FROM tb_jam_mengajar WHERE id_jam NOT IN (SELECT id_jam FROM tmp_jam)')->result();
        $data['jabatan'] = $this->db->query('SELECT id_jabatan, nama_jabatan FROM tb_jabatan WHERE id_jabatan NOT IN (SELECT id_jabatan FROM tmp_jabatan)')->result();
        $data['jam_now'] = $this->modelPegawai->jamNow($id)->result();
        $data['jab_now'] = $this->modelPegawai->jabNow($id)->result();
        $data['title'] = 'Edit Data Pegawai';
        $data['hitung_tmp_jam'] = $hitung_tmp_jam->num_rows();
        $data['hitung_tmp_jab'] = $hitung_tmp_jab->num_rows();
        $data['idp'] = $id;
        $data['hak_akses'] = $this->db->get('hak_akses')->result();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('admin/view_editPegawai', $data);
        $this->load->view('template/footer');
    }

    public function update_pegawai($id)
    {
        $where = array('id_pegawai' => $id);
        $nama = htmlspecialchars($this->input->post('nama'));
        $alamat = htmlspecialchars($this->input->post('alamat'));
        $gender = $this->input->post('jenis_kelamin');
        $jarak = $this->input->post('jarak');
        $hak_akses = $this->input->post('hak_akses');
        $walas = $this->input->post('walas');
        $username = htmlspecialchars($this->input->post('username'));
        if ($walas == null) {
            $walas = 0;
        }
        $data = array(
            'nama_pegawai'  => $nama,
            'jenis_kelamin' => $gender,
            'alamat'        => $alamat,
            'id_transport'  => $jarak,
            'walas'         => $walas,
            'username'      => $username,
            'hak_akses'     => $hak_akses
        );

        $this->modelPegawai->update_pegawai($where, $data, 'tb_pegawai');

        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        Data Baru Berhasil Ditambahkan!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>');
        redirect('admin/datapegawai');
    }

    public function newJam($id_pegawai)
    {
        // PROSES UPDATE DATA JAM MENGAJAR DARI CHECKBOX

        if ($this->input->post('id_jam') != null) {
            $check_jam = count($this->input->post('id_jam'));

            for ($i = 0; $i < $check_jam; $i++) {
                $id_jam = $this->input->post('id_jam[' . $i . ']');
                $jumlah_jam['data'] = $this->db->query("SELECT jumlah_jam FROM tb_jam_mengajar WHERE id_jam = $id_jam")->row_array(); // ambil data jumlah jam
                $datas[$i] = array(
                    'id_pegawai'    => $id_pegawai,
                    'id_jam'        => $this->input->post('id_jam[' . $i . ']'),
                    'jumlah_jam'    =>  $jumlah_jam['data']['jumlah_jam']
                );
                $this->db->insert('tmp_jam', $datas[$i]);
            }
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Mpael Baru ditambahkan!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            redirect('admin/datapegawai/editP/' . $id_pegawai);
        }
        redirect('admin/datapegawai/editP/' . $id_pegawai);
    }

    public function newJab($id_pegawai)
    {
        // PROSES UPDATE DATA JABATAN DARI CHECKBOX

        if ($this->input->post('id_jabatan') != null) {
            $check_jab = count($this->input->post('id_jabatan'));

            for ($i = 0; $i < $check_jab; $i++) {
                $id_jabatan = $this->input->post('id_jabatan[' . $i . ']');
                $honorJabatan['jab'] = $this->db->query("SELECT honor_jabatan FROM tb_jabatan WHERE id_jabatan = $id_jabatan")->row_array();
                $datas[$i] = array(
                    'id_pegawai'    => $id_pegawai,
                    'id_jabatan'        => $this->input->post('id_jabatan[' . $i . ']'),
                    'honor'         => $honorJabatan['jab']['honor_jabatan']
                );
                $this->db->insert('tmp_jabatan', $datas[$i]);
            }
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Jabatan Baru ditambahkan!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            redirect('admin/datapegawai/editP/' . $id_pegawai);
        }
        redirect('admin/datapegawai/editP/' . $id_pegawai);
    }

    public function del_jam($idtmp, $idpg)
    {

        $where = array('id_tmp' => $idtmp);
        $this->db->where($where);
        $this->db->delete('tmp_jam');

        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        Mapel Dihapus!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>');
        redirect('admin/datapegawai/editP/' . $idpg);
    }

    public function del_jab($idtmp, $idpg)
    {
        $where = array('id_tmp' => $idtmp);
        $this->db->where($where);
        $this->db->delete('tmp_jabatan');

        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        Jabatan Dihapus!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>');
        redirect('admin/datapegawai/editP/' . $idpg);
    }


    public function detail($id)
    {

        $data['jml_jam'] = $this->modelPegawai->jml_jam($id);
        $data['jml_jam_dipilih'] = $this->db->query("SELECT * FROM tmp_jam WHERE id_pegawai = '$id' ")->num_rows();
        $data['jml_jab_dipilih'] = $this->db->query("SELECT * FROM tmp_jabatan WHERE id_pegawai = '$id' ")->num_rows();

        $data['title'] = 'Detail Pegawai';
        $data['pegawai'] = $this->modelPegawai->get_allData($id)->row_array();
        $data['jabatan'] = $this->modelPegawai->get_jabatan($id)->result();
        $data['jam'] = $this->modelPegawai->get_jam($id)->result();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('admin/view_detail', $data);
        $this->load->view('template/footer');
    }

    public function print()
    {
        $data['pegawai'] = $this->modelPegawai->print()->result();
        $this->load->view('admin/print/printpegawai', $data);
    }
}
