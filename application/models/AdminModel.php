<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AdminModel extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function tambah_user($data)
    {
        $this->db->set('username', $data['username']);
        $this->db->set('password', $data['password']);
        $this->db->set('nip', $data['nip']);
        $this->db->set('nama_pegawai', $data['nama_pegawai']);
        $this->db->set('jabatan', $data['jabatan']);
        $this->db->set('unit_kerja', $data['unit_kerja']);
        $this->db->set('id_golongan', $data['id_golongan']);
        $this->db->set('id_role', $data['id_role']);
        $this->db->set('date_created', $data['date_created']);
        $this->db->insert('user');
        $this->db->insert_id();
    }

    // public function tambah_pegawai($data)
    // {
    //     $this->db->set('nip', $data['nip']);
    //     $this->db->set('nama_pegawai', $data['nama_pegawai']);
    //     $this->db->set('jabatan', $data['jabatan']);
    //     $this->db->set('unit_kerja', $data['unit_kerja']);
    //     $this->db->set('id_golongan', $data['id_golongan']);
    //     $this->db->insert('pegawai');
    //     $this->db->insert_id();
    // }


    public function get_pengguna()
    {
        $sql = "SELECT u.*, g.nama_golongan
        FROM user u
        LEFT JOIN golongan g ON g.id_golongan = u.id_golongan 
        WHERE u.id_role ='2'";
        $res = $this->db->query($sql);
        return $res->result_array();
    }

    public function get_pengguna_by_username($username)
    {
        $sql = "SELECT username
        FROM user
        WHERE username = '" . $username . "'";
        $res = $this->db->query($sql);
        return $res->result_array();
    }

    public function get_pengguna_by_nip($nip)
    {
        $sql = "SELECT nip
        FROM user
        WHERE nip = '" . $nip . "'";
        $res = $this->db->query($sql);
        return $res->result_array();
    }

    public function get_pengguna_by_id($data)
    {
        $sql = "SELECT u.*, g.nama_golongan
        FROM user u 
        LEFT JOIN golongan g ON g.id_golongan = u.id_golongan
        WHERE u.id_user =" . $data;
        $res = $this->db->query($sql);
        return $res->result_array();
    }

    public function update_user_by_id($data)
    {
        $this->db->set('username', $data['username']);
        $this->db->set('password', $data['password']);
        $this->db->set('nip', $data['nip']);
        $this->db->set('nama_pegawai', $data['nama_pegawai']);
        $this->db->set('jabatan', $data['jabatan']);
        $this->db->set('unit_kerja', $data['unit_kerja']);
        $this->db->set('id_golongan', $data['id_golongan']);
        $this->db->where('id_user', $data['id_user']);
        $this->db->update('user');
    }

    // public function update_pengguna_by_id($data)
    // {
    // 	$sql = "UPDATE user set username = '".$data['username']."', fullname = '".$data['fullname']."', id_role = '".$data['id_role']."' WHERE id_user = ".$data['id_user'];
    // 	$res = $this->db->query($sql);
    // 	return $res;
    // }

    public function hapus_pengguna($data)
    {
        $this->db->where('id_user', $data);
        $this->db->delete('user');
    }

    public function get_konfirmasi_aju_izin_belajar()
    {
        $this->db->select('u.*, i.*');
        $this->db->from('izin_belajar i');
        $this->db->join('user u', 'u.id_user = i.id_user');
        $this->db->where('i.status_pengajuan', 'MENUNGGU KONFIRMASI');
        return $this->db->get()->result();
    }

    public function get_konfirmasi_aju_pensiun()
    {
        $this->db->select('u.*, p.*, g.*');
        $this->db->from('pensiun p');
        $this->db->join('user u', 'p.id_user = u.id_user');
        $this->db->join('golongan g', 'u.id_golongan = g.id_golongan');
        $this->db->where('p.status_pengajuan', 'MENUNGGU KONFIRMASI');
        return $this->db->get()->result();
    }

    public function get_all_rekap_aju()
    {
        $sql = "SELECT p.*, u.*, h.tanggal_mulai_magang, h.tanggal_selesai_magang 
                from pengajuan p
                LEFT JOIN user u ON p.id_user = u.id_user
                LEFT JOIN selesai_magang h ON p.id_pengajuan = h.id_pengajuan
                where status_pengajuan != 'MENUNGGU KONFIRMASI' ";
        $res = $this->db->query($sql);
        return $res->result_array();
    }

    public function get_nama_aju_izin_belajar_byid($data)
    {
        $sql = "SELECT i.id_izin_belajar, u.id_user, i.tgl_disposisi_bkpsdm, i.tgl_disposisi_sekda
        from izin_belajar i
        JOIN user u ON i.id_user = u.id_user
        WHERE i.id_izin_belajar ='$data'";
        $res = $this->db->query($sql);
        return $res->result_array();
    }

    public function get_nama_aju_pensiun_byid($data)
    {
        $sql = "SELECT p.id_pensiun, u.id_user, p.tgl_asistentiga, p.tgl_disposisi_sekda, p.tgl_disposisi_bkn_pusat
        from pensiun p
        JOIN user u ON p.id_user = u.id_user
        WHERE p.id_pensiun ='$data'";
        $res = $this->db->query($sql);
        return $res->result_array();
    }

    public function terima_aju_izin_belajar($data)
    {
        $this->db->set('status_pengajuan', $data['status_pengajuan']);
        $this->db->set('tgl_disposisi_bkpsdm', $data['tgl_disposisi_bkpsdm']);
        $this->db->set('tgl_disposisi_sekda', $data['tgl_disposisi_sekda']);
        $this->db->where('id_izin_belajar', $data['id_izin_belajar']);
        $this->db->update('izin_belajar');
    }

    public function tolak_aju_izin_belajar($data)
    {
        $this->db->set('status_pengajuan', $data['status_pengajuan']);
        $this->db->where('id_izin_belajar', $data['id_izin_belajar']);
        $this->db->update('izin_belajar');
    }

    public function terima_aju_pensiun($data)
    {
        $this->db->set('status_pengajuan', $data['status_pengajuan']);
        $this->db->set('tgl_asistentiga', $data['tgl_asistentiga']);
        $this->db->set('tgl_disposisi_sekda', $data['tgl_disposisi_sekda']);
        $this->db->set('tgl_disposisi_bkn_pusat', $data['tgl_disposisi_bkn_pusat']);
        $this->db->where('id_pensiun', $data['id_pensiun']);
        $this->db->update('pensiun');
    }

    public function tolak_aju_pensiun($data)
    {
        $this->db->set('status_pengajuan', $data['status_pengajuan']);
        $this->db->where('id_pensiun', $data['id_pensiun']);
        $this->db->update('pensiun');
    }

    public function get_golongan()
    {
        $sql = "SELECT * from golongan";
        $res = $this->db->query($sql);
        return $res->result_array();
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

    public function get_jumlah_tahun_izin_belajar()
    {
        $sql = "SELECT year(tgl_pengajuan) as jumlahtahun, COUNT(id_izin_belajar) as jumlahdata From izin_belajar Group By year(tgl_pengajuan)";
        $res = $this->db->query($sql);
        return $res->result_array();
    }

    public function get_jumlah_tahun_pensiun()
    {
        $sql = "SELECT year(tgl_pengajuan) as jumlahtahun, COUNT(id_pensiun) as jumlahdata From pensiun Group By year(tgl_pengajuan)";
        $res = $this->db->query($sql);
        return $res->result_array();
    }

    public function get_terima_izin_belajar()
    {
        $sql = "SELECT COUNT(status_pengajuan) as status_aju_izin_belajar FROM izin_belajar WHERE status_pengajuan = 'DITERIMA'";
        $res = $this->db->query($sql);
        return $res->result_array();
    }

    public function get_tolak_izin_belajar()
    {
        $sql = "SELECT COUNT(status_pengajuan) as status_aju_izin_belajar FROM izin_belajar WHERE status_pengajuan = 'DITOLAK'";
        $res = $this->db->query($sql);
        return $res->result_array();
    }

    public function get_terima_pensiun()
    {
        $sql = "SELECT COUNT(status_pengajuan) as status_aju_pensiun FROM pensiun WHERE status_pengajuan = 'DITERIMA'";
        $res = $this->db->query($sql);
        return $res->result_array();
    }

    public function get_tolak_pensiun()
    {
        $sql = "SELECT COUNT(status_pengajuan) as status_aju_pensiun FROM pensiun WHERE status_pengajuan = 'DITOLAK'";
        $res = $this->db->query($sql);
        return $res->result_array();
    }

    public function get_count_pengguna()
    {
        $sql = "SELECT COUNT(u.id_user) AS rekap
        FROM user u
        LEFT JOIN golongan g ON g.id_golongan = u.id_golongan 
        WHERE u.id_role ='2'";
        $res = $this->db->query($sql);
        return $res->result_array();
    }

    public function get_count_konfirmasi_aju_izin_belajar()
    {
        $this->db->select('COUNT(u.id_user) AS rekap');
        $this->db->from('izin_belajar i');
        $this->db->join('user u', 'u.id_user = i.id_user');
        $this->db->where_not_in('i.status_pengajuan', 'MENUNGGU KONFIRMASI');
        return $this->db->get()->result();
    }

    public function get_count_konfirmasi_aju_pensiun()
    {
        $this->db->select('COUNT(u.id_user) AS rekap');
        $this->db->from('pensiun p');
        $this->db->join('user u', 'p.id_user = u.id_user');
        $this->db->join('golongan g', 'u.id_golongan = g.id_golongan');
        $this->db->where_not_in('p.status_pengajuan', 'MENUNGGU KONFIRMASI');
        return $this->db->get()->result();
    }

    public function get_user_konfirmasi_aju_pensiun($id)
    {
        $sql = "SELECT id_user 
        FROM pensiun 
        WHERE status_pengajuan = 'MENUNGGU KONFIRMASI' 
        AND id_pensiun = '" . $id . "'";

        $res = $this->db->query($sql);
        return $res->result_array();
    }

    public function change_password($id, $pass) {
        $sql = "UPDATE user SET password = '" . $pass . "' WHERE id_user = '" . $id . "'";
        $res = $this->db->query($sql);
    }
}
