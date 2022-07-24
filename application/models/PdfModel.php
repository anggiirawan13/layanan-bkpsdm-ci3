    <?php

    if (!defined('BASEPATH'))
        exit('No direct script access allowed');

    class PdfModel extends CI_Model
    {

        public function getContent($data)
        {
            // $this->db->select(array('p.*, u.instansi, n.nama_peserta, n.nim_peserta'));
            // $this->db->join('user u', 'p.id_user = u.id_user');
            // $this->db->join('nama_peserta n', 'n.id_user = u.id_user');
            // $this->db->from('pengajuan p');
            // $this->db->where('p.id_pengajuan', $data);
            // $query = $this->db->get();
            // return $query->row_array();
            $sql = "SELECT p.* , u.instansi, u.jurusan, n.nama_peserta, n.nim_peserta, k.nama_bidang from pengajuan p 
                    JOIN user u ON p.id_user = u.id_user
                    JOIN nama_peserta n ON n.id_user = u.id_user
                    JOIN kuota_magang k ON k.id_bidang = n.id_bidang
                    where n.nama_peserta != '' AND p.id_pengajuan =" . $data;
            $res = $this->db->query($sql);
            return $res->result_array();
        }

        public function getTerimaAjuIzinBelajar($data)
        {
            $sql = "SELECT u.*, i.*, g.*
                    from izin_belajar i 
                    LEFT JOIN user u ON i.id_user = u.id_user
                    LEFT JOIN golongan g ON g.id_golongan = u.id_golongan
                    where i.id_izin_belajar =" . $data;
            $res = $this->db->query($sql);
            return $res->result_array();
        }

        public function getTerimaAjuPensiun($data)
        {
            $sql = "SELECT u.*, p.*, g.*
                    from pensiun p 
                    LEFT JOIN user u ON p.id_user = u.id_user
                    LEFT JOIN golongan g ON g.id_golongan = u.id_golongan
                    where p.id_pensiun =" . $data;
            $res = $this->db->query($sql);
            return $res->result_array();
        }

        public function getTolakAjuIzinBelajar($data)
        {
            $sql = "SELECT u.*, i.*, g.*
                    from izin_belajar i 
                    LEFT JOIN user u ON i.id_user = u.id_user
                    LEFT JOIN golongan g ON g.id_golongan = u.id_golongan
                    where i.id_izin_belajar =" . $data;
            $res = $this->db->query($sql);
            return $res->result_array();
        }

        public function getRekapBulananIzinBelajar($bln, $thn, $status = false, $pendidikan = false)
        {
            $sql = "SELECT u.*, i.*
                    FROM izin_belajar i
                    LEFT JOIN user u ON i.id_user = u.id_user
                    where i.status_pengajuan = '". $status . "' AND i.jenjang_pendidikan = '" . $pendidikan . "' AND month(i.tgl_pengajuan) = " . $bln . " AND year(i.tgl_pengajuan) =" . $thn;
            $res = $this->db->query($sql);
            return $res->result_array();
        }

        public function getRekapBulananPensiun($bln, $thn, $status = false, $gol = false)
        {
            $sql = "SELECT u.*, p.*, g.*
                    FROM pensiun p
                    LEFT JOIN user u ON p.id_user = u.id_user
                    LEFT JOIN golongan g ON g.id_golongan = u.id_golongan
                    where p.status_pengajuan = '". $status . "' AND g.id_golongan = '" . $gol . "' AND month(p.tgl_pengajuan) = " . $bln . " AND year(p.tgl_pengajuan) =" . $thn;
            $res = $this->db->query($sql);
            return $res->result_array();
        }
       
    }
    ?>