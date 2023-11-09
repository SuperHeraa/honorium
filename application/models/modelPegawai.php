<?php

class ModelPegawai extends CI_Model
{

    public function store_pegawai($data, $table)
    {
        $this->db->insert($table, $data);
    }

    public function hapus_pegawai($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }
    public function hapus_tmp_jam($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }
    public function hapus_tmp_jabatan($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }

    public function hapus_honor_kegiatan($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }

    public function hapus_absensi($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }

    public function get_data_for_edit($id)
    {
        $this->db->select('*');
        $this->db->from('tb_pegawai');
        $this->db->join('tb_transport', 'tb_transport.id_transport = tb_pegawai.id_transport');
        $this->db->join('tmp_jam', 'tmp_jam.id_pegawai = tb_pegawai.id_pegawai', 'left');
        $this->db->join('tmp_jabatan', 'tmp_jabatan.id_pegawai = tb_pegawai.id_pegawai', 'left');
        $this->db->where('tb_pegawai.id_pegawai', $id);
        return $this->db->get();
    }


    public function jamNow($id)
    {
        $this->db->select('*');
        $this->db->from('tmp_jam');
        $this->db->join('tb_jam_mengajar', 'tmp_jam.id_jam = tb_jam_mengajar.id_jam', 'left');
        $this->db->where('tmp_jam.id_pegawai', $id);
        return $this->db->get();
    }

    public function update_pegawai($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    public function jabNow($id)
    {
        $this->db->select('*');
        $this->db->from('tmp_jabatan');
        $this->db->join('tb_jabatan', 'tmp_jabatan.id_jabatan = tb_jabatan.id_jabatan', 'left');
        $this->db->where('tmp_jabatan.id_pegawai', $id);
        return $this->db->get();
    }

    public function get_allData($id)
    {
        $this->db->select('*');
        $this->db->from('tb_pegawai');
        $this->db->join('tb_transport', 'tb_transport.id_transport = tb_pegawai.id_transport');
        $this->db->where('tb_pegawai.id_pegawai', $id);
        return $this->db->get();
    }

    public function get_jabatan($id)
    {
        $this->db->select('*');
        $this->db->from('tmp_jabatan');
        $this->db->join('tb_jabatan', 'tb_jabatan.id_jabatan = tmp_jabatan.id_jabatan');
        $this->db->where('tmp_jabatan.id_pegawai', $id);
        return $this->db->get();
    }

    public function get_jam($id)
    {
        $this->db->select('*');
        $this->db->from('tmp_jam');
        $this->db->join('tb_jam_mengajar', 'tb_jam_mengajar.id_jam = tmp_jam.id_jam');
        $this->db->where('id_pegawai', $id);
        return $this->db->get();
    }

    public function jml_jam($id)
    {
        $this->db->select("
        tb_jam_mengajar.id_jam,
        SUM(tb_jam_mengajar.jumlah_jam) as jmlJam,

        tmp_jam.id_jam,
        tmp_jam.id_pegawai

        FROM tb_jam_mengajar JOIN tmp_jam ON tb_jam_mengajar.id_jam=tmp_jam.id_jam WHERE tmp_jam.id_pegawai='$id'
        ");

        $query = $this->db->get();
        return $query->row_array();
    }

    public function print()
    {
        $query = $this->db->query("
        SELECT tb_pegawai.nama_pegawai, tb_pegawai.walas, tb_pegawai.id_pegawai, tb_pegawai.jenis_kelamin, tb_pegawai.alamat, tb_transport.jarak,
        (SELECT count(id_pegawai) FROM tmp_jabatan WHERE tmp_jabatan.id_pegawai = tb_pegawai.id_pegawai) as totalPegawai,
        (SELECT count(id_pegawai)FROM tmp_jam WHERE tmp_jam.id_pegawai = tb_pegawai.id_pegawai) as totalMapel
    FROM tb_pegawai
    JOIN tb_transport ON tb_transport.id_transport=tb_pegawai.id_transport
    ORDER BY tb_pegawai.nama_pegawai
        ");

        return $query;
    }
};
