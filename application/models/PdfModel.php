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

        public function getRekapBulananIzinBelajar($bln, $thn, $status, $pendidikan)
        {
            $this->db->select('u.*, i.*');
            $this->db->from('izin_belajar i');
            $this->db->join('user u', 'i.id_user = u.id_user');
            $this->db->where_not_in('i.status_pengajuan', 'MENUNGGU KONFIRMASI');

            if ($bln !== "all") {
                $this->db->where('month(i.tgl_pengajuan)', $bln);
            }

            if ($thn !== "all") {
                $this->db->where('year(i.tgl_pengajuan)', $thn);
            }

            if ($status !== "all") {
                $this->db->where('i.status_pengajuan', $status);
            }

            if ($pendidikan !== "all") {
                $this->db->where('i.jenjang_pendidikan', $pendidikan);
            }

            return $this->db->get()->result_array();
        }

        public function getRekapBulananPensiun($bln, $thn, $status, $gol)
        {
            $this->db->select('u.*, p.*, g.*');
            $this->db->from('pensiun p');
            $this->db->join('user u', 'p.id_user = u.id_user');
            $this->db->join('golongan g', 'g.id_golongan = u.id_golongan');
            $this->db->where_not_in('p.status_pengajuan', 'MENUNGGU KONFIRMASI');

            if ($bln !== "all") {
                $this->db->where('month(p.tgl_pengajuan)', $bln);
            }

            if ($thn !== "all") {
                $this->db->where('year(p.tgl_pengajuan)', $thn);
            }

            if ($status !== "all") {
                $this->db->where('p.status_pengajuan', $status);
            }

            if ($gol !== "all") {
                $this->db->where('g.id_golongan', $gol);
            }

            return $this->db->get()->result_array();
        }
    }
    ?>