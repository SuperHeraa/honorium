<?php

class DataHonor extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    is_logged_in();
    block_users();
  }
  public function index()
  {

    $data['jabatan'] = $this->modelHonor->get_data('tb_jabatan')->result();
    $data['transport'] = $this->modelHonor->get_data_transport()->result();
    $data['jamPelajaran'] = $this->modelHonor->get_data_jamPelajaran('tb_jam_mengajar')->result();
    $data['honorPerJam'] = $this->db->get_where('tb_honorjam', ['id' => 1])->row_array();
    $data['honorWalas'] = $this->db->get_where('tb_honorjam', ['id' => 2])->row_array();
    $data['title'] = 'Data Honor';

    $this->load->view('template/header', $data);
    $this->load->view('template/sidebar');
    $this->load->view('admin/view_honor', $data);
    $this->load->view('template/footer');
  }

  public function add_jabatan()
  {

    $jabatan = htmlspecialchars($this->input->post('jabatan'));
    $honor =  htmlspecialchars(reset_rupiah($this->input->post('honor')));

    $data = array(
      'nama_jabatan'  => $jabatan,
      'honor_jabatan' => $honor
    );

    $this->modelHonor->add_jabatan($data, 'tb_jabatan');
    $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        Data Baru Berhasil Ditambahkan!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>');
    redirect('admin/datahonor');
  }

  public function hapus_jabatan($id)
  {

    $where = array('id_jabatan' => $id);

    if ($id) {

      $this->modelHonor->hapusJabatan($where, 'tb_jabatan');
      $this->modelHonor->hapus_tmpJabatan($where, 'tmp_jabatan');
      $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Data berhasil dihapus!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>');
      redirect('admin/datahonor');
    } else {
      $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            GAGAL : Kesalah menghapus data!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>');
      redirect('admin/datahonor');
    }
  }

  public function edit_jabatan($id)
  {

    $jabatan = htmlspecialchars($this->input->post('jabatan'));
    $honor = htmlspecialchars(reset_rupiah($this->input->post('honor')));

    $data = array(
      'nama_jabatan'  => $jabatan,
      'honor_jabatan' => $honor
    );

    $where = array('id_jabatan' => $id);

    $this->modelHonor->edit_jabatan($where, $data, 'tb_jabatan');
    $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        Data berhasil diupdate!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>');
    redirect('admin/datahonor');
  }

  public function add_jarak()
  {
    $jarak = htmlspecialchars($this->input->post('jarak'));
    $honor = htmlspecialchars(reset_rupiah($this->input->post('honor')));

    $data = array(
      'jarak'             =>  $jarak,
      'honor_transport'   => $honor
    );

    $this->modelHonor->add_jarak($data, 'tb_transport');
    $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        Data Baru Berhasil Ditambahkan!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>');
    redirect('admin/datahonor');
  }

  public function hapus_jarak($id)
  {

    // Jika ada user menggunakan id jarak ini, maka ubah menjadi id default 1

    $cek_jarak = $this->db->get_where('tb_pegawai', ['id_transport' => $id])->result();

    foreach ($cek_jarak as $key) {
      $where = array(
        'id_pegawai' => $key->id_pegawai
      );
      $data = array(
        'id_transport' => 1
      );

      $this->db->where($where);
      $this->db->update('tb_pegawai', $data);
    }

    // lalu hapus jarak yang dipilih

    $where_id = array('id_transport' => $id);

    $this->modelHonor->hapus_jarak($where_id, 'tb_transport');
    $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        Data berhasil dihapus!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>');
    redirect('admin/datahonor');
  }

  public function edit_jarak($id)
  {

    $jarak = htmlspecialchars($this->input->post('jarak'));
    $honor = htmlspecialchars(reset_rupiah($this->input->post('honor')));

    $data = array(
      'jarak'             =>  $jarak,
      'honor_transport'   => $honor
    );
    $where = array('id_transport' => $id);
    $this->modelHonor->edit_jarak($where, $data, 'tb_transport');
    $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        Data berhasil di update!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>');
    redirect('admin/datahonor');
  }

  public function add_jamNgajar()
  {

    $mapel = htmlspecialchars($this->input->post('nama_mapel'));
    $jam = htmlspecialchars($this->input->post('jumlah_jam'));
    $data = array(
      'nama_mapel'    => $mapel,
      'jumlah_jam'    => $jam
    );

    $this->modelHonor->add_jamNgajar($data, 'tb_jam_mengajar');
    $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        Data Baru Berhasil Ditambahkan!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>');
    redirect('admin/datahonor');
  }

  public function hapus_jamNgajar($id)
  {
    $where = array('id_jam' => $id);
    $this->modelHonor->hapus_jamNgajar($where, 'tb_jam_mengajar');
    $this->modelHonor->hapus_tmp_jam($where, 'tmp_jam');
    $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        Data Berhasil Di Update!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>');
    redirect('admin/datahonor');
  }

  public function edit_jamNgajar($id)
  {

    $mapel = htmlspecialchars($this->input->post('mapel'));
    $jam = htmlspecialchars($this->input->post('jumlah_jam'));
    $data = array(
      'nama_mapel'    => $mapel,
      'jumlah_jam'    => $jam
    );
    $where = array('id_jam' => $id);
    $this->modelHonor->edit_jamNgajar($where, $data, 'tb_jam_mengajar');
    $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        Data Berhasil du update!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>');
    redirect('admin/datahonor');
  }

  public function editNominal($id)
  {
    $nominal = reset_rupiah($this->input->post('nominal'));
    $data = array('honor'   =>  $nominal);
    $where = array('id' =>  $id);
    $this->modelHonor->edit_nominal($where, $data, 'tb_honorjam');
    $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        Data berhasil di update!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>');
    redirect('admin/datahonor');
  }

  public function edithonorwalas($id)
  {
    $honor = reset_rupiah($this->input->post('nominalhonor'));

    $this->db->where(array('id' => $id));
    $this->db->update('tb_honorjam', array('honor' => $honor));
    $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show flash" role="alert">
    Data berhasil di update!
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>');
    redirect('admin/datahonor');
  }
}
