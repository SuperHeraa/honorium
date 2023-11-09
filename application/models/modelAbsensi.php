<?php

class ModelAbsensi extends CI_Model
{

    public function get_absensi($bulantahun)
    {
        $this->db->select('*');
        $this->db->from('tb_absensi');
        $this->db->join('tb_pegawai', 'tb_pegawai.id_pegawai = tb_absensi.id_pegawai');
        $this->db->where('tb_absensi.bulantahun', $bulantahun);
        $this->db->order_by('tb_pegawai.nama_pegawai', 'ASC');
        return $this->db->get();
    }

    public function edit($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }
}
