<?php

class ModelHonor extends CI_Model
{

    public function get_data($table)
    {
        return $this->db->get($table);
    }

    public function get_data_transport()
    {

        $query = $this->db->query("SELECT * FROM tb_transport WHERE id_transport != 1");
        return $query;
        // return $this->db->get($table);
    }

    public function get_data_jamPelajaran($table)
    {
        return $this->db->get($table);
    }

    public function add_jabatan($data, $table)
    {
        $this->db->insert($table, $data);
    }

    public function hapusJabatan($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }

    public function hapus_tmpJabatan($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }

    public function edit_jabatan($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    public function add_jarak($data, $table)
    {
        $this->db->insert($table, $data);
    }

    public function hapus_jarak($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }

    public function edit_jarak($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    public function add_jamNgajar($data, $table)
    {
        $this->db->insert($table, $data);
    }

    public function hapus_jamNgajar($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }

    public function hapus_tmp_jam($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }

    public function edit_jamNgajar($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    public function edit_nominal($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }


    public function honor_pegawai($bulantahun)
    {
        $query = $this->db->query("
        SELECT tb_pegawai.id_pegawai, tb_pegawai.walas, tb_pegawai.nama_pegawai, tb_transport.honor_transport, tb_absensi.bulantahun, tb_absensi.hadir,
	            (SELECT SUM(jumlah_jam) FROM tmp_jam WHERE tmp_jam.id_pegawai = tb_pegawai.id_pegawai) AS total_jam,
                (SELECT SUM(honor) FROM tmp_jabatan WHERE tmp_jabatan.id_pegawai = tb_pegawai.id_pegawai) AS total_honor_jabatan,
                (SELECT SUM(honor_kegiatan) FROM tb_honor_kegiatan WHERE tb_honor_kegiatan.id_pegawai = tb_pegawai.id_pegawai AND tb_honor_kegiatan.bulantahun = '$bulantahun') AS total_honor_kegiatan
        FROM tb_pegawai
        JOIN tb_transport ON tb_transport.id_transport=tb_pegawai.id_transport
        JOIN tb_absensi ON tb_absensi.id_pegawai=tb_pegawai.id_pegawai
        WHERE tb_absensi.bulantahun='$bulantahun'
        ORDER BY tb_pegawai.nama_pegawai ASC;
        
        ");
        return $query;
    }

    public function storeKegiatan($data, $table)
    {
        $this->db->insert($table, $data);
    }

    public function detail_pegawai($id, $bulantahun)
    {

        $this->db->select('*');
        $this->db->from('tb_pegawai');
        $this->db->join('tb_transport', 'tb_transport.id_transport=tb_pegawai.id_transport');
        $this->db->join('tb_absensi', 'tb_absensi.id_pegawai=tb_pegawai.id_pegawai');
        $where = array('tb_pegawai.id_pegawai' => $id, 'tb_absensi.bulantahun' => $bulantahun);
        $this->db->where($where);
        return $this->db->get();
    }

    public function detail_jam($id)
    {
        $this->db->select('*');
        $this->db->from('tb_jam_mengajar');
        $this->db->join('tmp_jam', 'tmp_jam.id_jam=tb_jam_mengajar.id_jam');
        $this->db->where('tmp_jam.id_pegawai', $id);
        return $this->db->get();
    }

    public function detail_jabatan($id)
    {
        $this->db->select('*');
        $this->db->from('tb_jabatan');
        $this->db->join('tmp_jabatan', 'tmp_jabatan.id_jabatan=tb_jabatan.id_jabatan');
        $this->db->where('tmp_jabatan.id_pegawai', $id);
        return $this->db->get();
    }

    public function detail_kegiatan($id, $bulantahun)
    {
        $this->db->select('*');
        $this->db->from('tb_honor_kegiatan');
        $where = array('id_pegawai' => $id, 'bulantahun' => $bulantahun);
        $this->db->where($where);
        return $this->db->get();
    }

    public function jmlkegiatan($id, $bulantahun)
    {
        $this->db->select('SUM(honor_kegiatan) as jmlKeg');
        $this->db->from('tb_honor_kegiatan');
        $where = array('id_pegawai' => $id, 'bulantahun' => $bulantahun);
        $this->db->where($where);
        return $this->db->get();
    }

    public function data_arsip($bulantahun)
    {
        $query = $this->db->query("
        SELECT tb_arsip.id, tb_arsip.idp, tb_arsip.jarak_transport, tb_arsip.honor_transport, tb_pegawai.nama_pegawai, tb_pegawai.alamat, tb_arsip.hadir, tb_arsip.bulantahun, tb_arsip.status_walas, tb_arsip.honor_transport, tb_arsip.honor_walas,
            (SELECT SUM(jumlah_jam) FROM rw_jam WHERE rw_jam.id_pegawai = tb_arsip.idp && rw_jam.bulantahun = '$bulantahun') AS total_jam,
            (SELECT SUM(honor_jabatan) FROM rw_jabatan WHERE rw_jabatan.id_pegawai = tb_arsip.idp && rw_jabatan.bulantahun = '$bulantahun') AS total_honor_jabatan,
            (SELECT SUM(honor_kegiatan) FROM tb_honor_kegiatan WHERE tb_honor_kegiatan.id_pegawai = tb_arsip.idp && tb_honor_kegiatan.bulantahun = '$bulantahun') AS total_honor_kegiatan
        FROM tb_arsip
        JOIN tb_pegawai ON tb_pegawai.id_pegawai=tb_arsip.idp
        WHERE tb_arsip.bulantahun='$bulantahun'
        ORDER BY tb_pegawai.nama_pegawai ASC
        ");

        return $query;
    }
}
