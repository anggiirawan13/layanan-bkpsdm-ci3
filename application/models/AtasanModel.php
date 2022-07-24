<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AtasanModel extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function get_all_rekap_izin_belajar()
    {
        $sql = "SELECT u.*, i.*
        from izin_belajar i
        JOIN user u ON u.id_user = i.id_user
        WHERE i.status_pengajuan != 'MENUNGGU KONFIRMASI'";
        $res = $this->db->query($sql);
        return $res->result_array();
    }

    public function get_all_rekap_pensiun()
    {
        $sql = "SELECT u.*, p.*, g.*
        from pensiun p
        JOIN user u ON u.id_user = p.id_user
        JOIN golongan g ON g.id_golongan = u.id_golongan
        WHERE p.status_pengajuan != 'MENUNGGU KONFIRMASI'";
        $res = $this->db->query($sql);
        return $res->result_array();
    }

    public function get_rekap_bulan_izin_belajar($bln, $thn, $status, $pendidikan)
    {
        $this->db->select('u.*, i.*');
        $this->db->from('izin_belajar i');
        $this->db->join('user u', 'i.id_user = u.id_user');
        $this->db->where_not_in('i.status_pengajuan', 'MENUNGGU KONFIRMASI');

        if (!empty($bln)) {
            $this->db->where('month(i.tgl_pengajuan)', $bln);
        }

        if (!empty($thn)) {
            $this->db->where('year(i.tgl_pengajuan)', $thn);
        }

        if (!empty($status)) {
            $this->db->where('i.status_pengajuan', $status);
        }

        if (!empty($pendidikan)) {
            $this->db->where('i.jenjang_pendidikan', $pendidikan);
        }

        return $this->db->get()->result_array();
    }



    public function get_rekap_bulan_pensiun($bln, $thn, $status, $gol)
    {
        $this->db->select('u.*, p.*, g.*');
        $this->db->from('pensiun p');
        $this->db->join('user u', 'p.id_user = u.id_user');
        $this->db->join('golongan g', 'g.id_golongan = u.id_golongan');
        $this->db->where_not_in('p.status_pengajuan', 'MENUNGGU KONFIRMASI');
        
        if (!empty($bln)) {
            $this->db->where('month(p.tgl_pengajuan)', $bln);
        }
        
        if (!empty($thn)) {
            $this->db->where('year(p.tgl_pengajuan)', $thn);
        }

        if (!empty($status)) {
            $this->db->where('p.status_pengajuan', $status);
        }

        if (!empty($gol)) {
            $this->db->where('g.id_golongan', $gol);
        }

        return $this->db->get()->result_array();
    }

    public function get_count_rekap_izin_belajar()
    {
        $sql = "SELECT COUNT(u.id_user) AS rekap
        from izin_belajar i
        JOIN user u ON u.id_user = i.id_user
        WHERE i.status_pengajuan != 'MENUNGGU KONFIRMASI'";
        $res = $this->db->query($sql);
        return $res->result_array();
    }

    public function get_count_rekap_pensiun()
    {
        $sql = "SELECT COUNT(u.id_user) AS rekap
        from pensiun p
        JOIN user u ON u.id_user = p.id_user
        JOIN golongan g ON g.id_golongan = u.id_golongan
        WHERE p.status_pengajuan != 'MENUNGGU KONFIRMASI'";
        $res = $this->db->query($sql);
        return $res->result_array();
    }
}
