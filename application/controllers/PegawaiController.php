<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PegawaiController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('sess_pegawai')) {
            redirect("AuthLogin");
        }

        $this->load->library('form_validation', 'session');
        $this->load->helper(array('form', 'url'));
        $this->load->model('PegawaiModel');
        $this->load->model('AdminModel');
        // $this->load->model('MainModel'); 
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        $session_data = $this->session->userdata('sess_pegawai');
        $datacontent['session'] = $session_data;
        $datacontent['informasiAkun'] = $this->AdminModel->get_pengguna_by_id($session_data['id_user']);
        $this->template->view('template/pegawai/main_content', 2, $datacontent);
    }

    public function dashboard()
    {
        $session_data = $this->session->userdata('sess_pegawai');
        $datacontent['session'] = $session_data;
        $datacontent['informasiAkun'] = $this->AdminModel->get_pengguna_by_id($session_data['id_user']);
        $this->template->view('template/pegawai/main_content', 2, $datacontent);
    }

    public function pengajuan_izin_belajar()
    {
        $session_data = $this->session->userdata('sess_pegawai');
        $datacontent['session'] = $session_data;
        $this->template->view('template/pegawai/pengajuan_izin_belajar', 2, $datacontent);
    }

    public function pengajuan_pensiun()
    {
        $session_data = $this->session->userdata('sess_pegawai');
        $datacontent['session'] = $session_data;
        $this->template->view('template/pegawai/pengajuan_pensiun', 2, $datacontent);
    }

    public function validate_format_file($file, $message)
    {
        $formatFile  = explode('.', $_FILES[$file]['name']);
        $ext = strtolower(end($formatFile));

        if (($ext === 'pdf' || $ext === 'doc' || $ext === 'docx') && $_FILES[$file]["size"] > 0) {
            $config['upload_path'] = "./assets/img";
            $config['allowed_types'] = '*';
            $config['max_size'] = '8192';

            $this->load->library('upload', $config);
            $this->upload->do_upload($file);
        } else {
            echo $message;
            return $message;
        }
    }

    public function submit_pengajuan_izin_belajar()
    {
        if (empty($this->validate_format_file('dok_ijazah_terakhir', "Format file Ijazah Terakhir salah!"))) {
            $data1 = array('upload_data' => $this->upload->data());
            $datafile1 = $data1['upload_data']['file_name'];
            if (empty($this->validate_format_file('dok_surat_dinas', "Format file Surat dari Dinas salah!"))) {
                $data2 = array('upload_data' => $this->upload->data());
                $datafile2 = $data2['upload_data']['file_name'];
                if (empty($this->validate_format_file('dok_surat_humdis', "Format file Surat Hukuman Disiplin salah!"))) {
                    $data3 = array('upload_data' => $this->upload->data());
                    $datafile3 = $data3['upload_data']['file_name'];

                    $session_data = $this->session->userdata('sess_pegawai');
                    $data['id_user'] = $session_data['id_user'];

                    $data['nama_instansi_pendidikan'] = $this->input->post('nama_instansi_pendidikan');
                    $data['jenjang_pendidikan'] = $this->input->post('jenjang_pendidikan');
                    $data['status_pengajuan'] = 'MENUNGGU KONFIRMASI';
                    $data['tgl_pengajuan'] = date("Y-m-d H:i:s");
                    $data['dok_ijazah_terakhir'] = $datafile1;
                    $data['dok_surat_dinas'] = $datafile2;
                    $data['dok_surat_humdis'] = $datafile3;
                    $this->PegawaiModel->tambah_pengajuan_izin_belajar($data);
                }
            }
        }
    }

    public function status_izin_belajar()
    {
        $session_data = $this->session->userdata('sess_pegawai');
        $datacontent['session'] = $session_data;
        $this->template->view('template/pegawai/status_izin_belajar', 2, $datacontent);
    }

    public function submit_pengajuan_pensiun()
    {
        $session_data = $this->session->userdata('sess_pegawai');
        $result = $this->PegawaiModel->get_tanggapan_aju_pensiun($session_data['id_user']);

        if (!empty($result) && $result[0]['status_pengajuan'] === 'MENUNGGU KONFIRMASI') {
            $message = "Tidak bisa melakukan pengajuan, karena masih MENUNGGU KONFIRMASI pengajuan sebelumnya!";
            echo $message;
            return $message;
        } else if (!empty($result) && $result[0]['status_pengajuan'] === 'DITERIMA') {
            $message = "Tidak bisa melakukan pengajuan, karena pengajuan pensiun anda sebelumnya sudah DITERIMA!";
            echo $message;
            return $message;
        } else if (empty($result) || $result[0]['status_pengajuan'] === 'DITOLAK') {
            if (empty($this->validate_format_file('dok_kk', "Format file Kartu Keluarga salah!"))) {
                $data1 = array('upload_data' => $this->upload->data());
                $datafile1 = $data1['upload_data']['file_name'];
                if (empty($this->validate_format_file('dok_akte_anak', "Format file Akte Anak salah!"))) {
                    $data2 = array('upload_data' => $this->upload->data());
                    $datafile2 = $data2['upload_data']['file_name'];
                    if (empty($this->validate_format_file('dok_buku_nikah', "Format file Buku Nikah salah!"))) {
                        $data3 = array('upload_data' => $this->upload->data());
                        $datafile3 = $data3['upload_data']['file_name'];

                        $session_data = $this->session->userdata('sess_pegawai');
                        $data['id_user'] = $session_data['id_user'];

                        $data['tmt_pensiun'] = $this->input->post('tmt_pensiun');
                        $data['status_pengajuan'] = 'MENUNGGU KONFIRMASI';
                        $data['tgl_pengajuan'] = date("Y-m-d H:i:s");
                        $data['dok_kk'] = $datafile1;
                        $data['dok_akte_anak'] = $datafile2;
                        $data['dok_buku_nikah'] = $datafile3;

                        $this->PegawaiModel->tambah_pengajuan_pensiun($data);
                    }
                }
            }
        }
    }

    public function status_pensiun()
    {
        $session_data = $this->session->userdata('sess_pegawai');
        $datacontent['session'] = $session_data;
        $this->template->view('template/pegawai/status_pensiun', 2, $datacontent);
    }

    public function konfirmasi_selesai_magang()
    {
        $data['id_pengajuan'] = $this->input->post('id_pengajuan');
        $data['status_selesai'] = $this->input->post('status_selesai');
        $res = $this->PegawaiModel->update_konfirmasi_selesai_magang($data);
        echo json_encode($res);
    }

    public function get_tanggapan_pengajuan_izin_belajar()
    {
        $session_data = $this->session->userdata('sess_pegawai');
        $data = $session_data['id_user'];
        $result = $this->PegawaiModel->get_tanggapan_aju_izin_belajar($data);
        echo json_encode($result);
    }


    public function get_tanggapan_pengajuan_pensiun()
    {
        $session_data = $this->session->userdata('sess_pegawai');
        $data = $session_data['id_user'];
        $result = $this->PegawaiModel->get_tanggapan_aju_pensiun($data);
        echo json_encode($result);
    }

    public function cetak_hasil_magang()
    {
        $session_data = $this->session->userdata('sess_pegawai');
        $datacontent['session'] = $session_data;
        $this->template->view('template/pegawai/cetak_hasil_magang', 2, $datacontent);
    }
    public function get_selesai_magang()
    {
        $session_data = $this->session->userdata('sess_pegawai');
        $data = $session_data['id_user'];
        $result = $this->PegawaiModel->get_selesai_magang_userid($data);
        echo json_encode($result);
    }

    public function get_rekap_selesai_magang()
    {
        $session_data = $this->session->userdata('sess_pegawai');
        $data = $session_data['id_user'];
        $result = $this->PegawaiModel->get_rekap_selesai_magang_userid($data);
        echo json_encode($result);
    }

    public function change_password()
    {
        $session_data = $this->session->userdata('sess_pegawai');
        $idUser = $session_data['id_user'];
        $user = $this->AdminModel->get_pengguna_by_id($idUser);
        
        $oldpass = md5($this->input->post('oldpass'));
        if ($oldpass != $user[0]['password']) {
            echo "Password lama tidak sesuai!";
            return;
        }

        if (!empty($this->input->post('newpass')) && strlen($this->input->post('newpass')) < 8) {
            echo "Password baru minimal 8 karakter!";
            return;
        }

        if ($this->input->post('newpass') != $this->input->post('confnewpass')) {
            echo "Konfirmasi password baru tidak sesuai!";
            return;
        }

        $this->AdminModel->change_password($idUser, md5($this->input->post('newpass')));

        echo 'success';
        return;
    }
}
