<?php

class ModelArsip extends CI_Model
{
    public function get_arsip($id, $bulantahun)
    {
        $this->db->select('*');
        $this->db->from('tb_arsip');
        $this->db->join('tb_pegawai', 'tb_pegawai.id_pegawai=tb_arsip.idp');
        $where = array('tb_arsip.idp' => $id, 'tb_arsip.bulantahun' => $bulantahun);
        $this->db->where($where);
        return $this->db->get();
    }

    public function detail_jam($id, $bulantahun)
    {
        $this->db->select('*');
        $this->db->from('rw_jam');
        $where = array('rw_jam.id_pegawai' => $id, 'rw_jam.bulantahun' => $bulantahun);
        $this->db->where($where);
        return $this->db->get();
    }

    public function detail_jabatan($id, $bulantahun)
    {
        $this->db->select('*');
        $this->db->from('rw_jabatan');
        $where = array('rw_jabatan.id_pegawai' => $id, 'rw_jabatan.bulantahun' => $bulantahun);
        $this->db->where($where);
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
}
