<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PegawaiModel extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function tambah_pengajuan_izin_belajar($data)
    {
        // $this->db->set('nama', $data['nama']);
        // $this->db->set('tanggal_mulai', $data['tanggal_mulai']);
        // $this->db->set('tanggal_selesai', $data['tanggal_selesai']);
        // $this->db->set('proposal', $data['proposal']);
        // $this->db->set('id_user', $data['id_user']);
        $this->db->insert('izin_belajar', $data);
        $this->db->insert_id();
    }

    public function tambah_pengajuan_pensiun($data)
    {
        // $this->db->set('nama', $data['nama']);
        // $this->db->set('tanggal_mulai', $data['tanggal_mulai']);
        // $this->db->set('tanggal_selesai', $data['tanggal_selesai']);
        // $this->db->set('proposal', $data['proposal']);
        // $this->db->set('id_user', $data['id_user']);
        $this->db->insert('pensiun', $data);
        $this->db->insert_id();
    }

    public function get_tanggapan_aju_izin_belajar($data)
    {
        $sql = "SELECT u.*, i.*
        from izin_belajar i
        LEFT JOIN user u ON i.id_user = u.id_user
        WHERE i.id_user ='$data'";

        $res = $this->db->query($sql);
        return $res->result_array();
    }

    public function get_tanggapan_aju_pensiun($data)
    {
        $sql = "SELECT u.*, i.*
        from pensiun i
        LEFT JOIN user u ON i.id_user = u.id_user
        WHERE i.id_user ='$data' 
        ORDER BY i.id_pensiun DESC";

        $res = $this->db->query($sql);
        return $res->result_array();
    }
}
