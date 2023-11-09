
<?php
class M_profile extends CI_Model
{

    function my_profile($idp)
    {
        $this->db->select('*');
        $this->db->from('tb_pegawai');
        $this->db->join('tb_transport', 'tb_transport.id_transport=tb_pegawai.id_transport');
        $this->db->where('tb_pegawai.id_pegawai', $idp);
        return $this->db->get()->row_array();
    }

    function jabatan($idp)
    {
        $this->db->select('*');
        $this->db->from('tmp_jabatan');
        $this->db->join('tb_jabatan', 'tb_jabatan.id_jabatan=tmp_jabatan.id_jabatan');
        $this->db->where('tmp_jabatan.id_pegawai', $idp);
        return $this->db->get()->result();
    }
    function jam($idp)
    {
        $this->db->select('*');
        $this->db->from('tmp_jam');
        $this->db->join('tb_jam_mengajar', 'tb_jam_mengajar.id_jam=tmp_jam.id_jam');
        $this->db->where('tmp_jam.id_pegawai', $idp);
        return $this->db->get()->result();
    }

    function update_username($idp, $username)
    {
        $this->db->set('username', $username);
        $this->db->where('id_pegawai', $idp);
        $hasil = $this->db->update('tb_pegawai');
        return $hasil;
    }

    function cekUsername($username)
    {
        $query = $this->db
            ->select('username')
            ->where('username', $username)
            ->get('tb_pegawai');
        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function cekPassword($password)
    {

        $findId = $this->db->get_where('tb_pegawai', ['id_pegawai' => $this->session->userdata('id_pegawai')])->row_array();
        $passNow = $findId['password'];

        if (password_verify($password, $passNow)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function updatePass($idp, $newPass)
    {
        $encrypt_pass = password_hash($newPass, PASSWORD_DEFAULT);
        $this->db->set('password', $encrypt_pass);
        $this->db->where('id_pegawai', $idp);
        $result = $this->db->update('tb_pegawai');
        return $result;
    }
}
