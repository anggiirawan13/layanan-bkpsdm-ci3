<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AdminController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('sess_admin')) {
            //  redirect("login", 'refresh');
            redirect("AuthLogin");
        }

        $this->load->model('AdminModel');
        $this->load->model('MainModel');
        //  $this->load->library('form_validation', 'session');
    }

    public function index()
    {
        $session_data = $this->session->userdata('sess_admin');
        $datacontent['session'] = $session_data;
        $datacontent['rekapUser'] = $this->AdminModel->get_count_pengguna();
        $datacontent['rekapKonfirmasiBelajar'] = $this->AdminModel->get_count_konfirmasi_aju_izin_belajar();
        $datacontent['rekapKonfirmasiPensiun'] = $this->AdminModel->get_count_konfirmasi_aju_pensiun();
        $this->template->view('template/admin/main_content', 1, $datacontent);
    }

    public function dashboard()
    {
        $session_data = $this->session->userdata('sess_admin');
        $datacontent['session'] = $session_data;
        $datacontent['rekapUser'] = $this->AdminModel->get_count_pengguna();
        $datacontent['rekapKonfirmasiBelajar'] = $this->AdminModel->get_count_konfirmasi_aju_izin_belajar();
        $datacontent['rekapKonfirmasiPensiun'] = $this->AdminModel->get_count_konfirmasi_aju_pensiun();
        $this->template->view('template/admin/main_content', 1, $datacontent);
    }

    public function daftar_pengguna()
    {
        $session_data = $this->session->userdata('sess_admin');
        $datacontent['session'] = $session_data;
        $datacontent['golongan'] = $this->AdminModel->get_golongan();
        $this->template->view('template/admin/daftar_pengguna', 1, $datacontent);
    }

    public function tambah_pengguna()
    {
        $username = $this->input->post('username');
        $nip = $this->input->post('nip');

        $checkUsername = $this->AdminModel->get_pengguna_by_username($username);
        if (!empty($checkUsername)) {
            echo "Username sudah ada!";
            return;
        }

        $checkNIP = $this->AdminModel->get_pengguna_by_nip($nip);
        if (!empty($checkNIP)) {
            echo "NIP sudah ada!";
            return;
        }

        if (!empty($this->input->post('password')) && strlen($this->input->post('password')) < 8) {
            echo "Password minimal 8 karakter!";
            return;
        }

        $data['username'] = $username;
        $data['password'] = md5($this->input->post('password'));
        $data['nip'] = $nip;
        $data['nama_pegawai'] = $this->input->post('nama_pegawai');
        $data['jabatan'] = $this->input->post('jabatan');
        $data['unit_kerja'] = $this->input->post('unit_kerja');
        $data['id_golongan'] = $this->input->post('nama_golongan');
        $data['id_role'] = 2;
        $data['date_created'] = date("Y-m-d H:i:s");

        $result = $this->AdminModel->tambah_user($data);
        echo json_encode($result);
    }


    public function get_all_pengguna()
    {
        $result = $this->AdminModel->get_pengguna();
        echo json_encode($result);
    }

    public function get_nama_pengguna()
    {
        $id_user = $this->input->get('id_user');
        $result = $this->AdminModel->get_pengguna_by_id($id_user);
        echo json_encode($result);
    }

    public function update_pengguna()
    {
        $data = $this->AdminModel->get_pengguna_by_id($this->input->post('id_user'));
        $username = $this->input->post('username');
        $nip = $this->input->post('nip');

        $checkUsername = $this->AdminModel->get_pengguna_by_username($username);
        if (!empty($checkUsername) && $checkUsername[0]['username'] !== $data[0]['username']) {
            echo "Username sudah ada!";
            return;
        }

        $checkNIP = $this->AdminModel->get_pengguna_by_nip($nip);
        if (!empty($checkNIP) && $checkNIP[0]['nip'] !== $data[0]['nip']) {
            echo "NIP sudah ada!";
            return;
        }

        if (!empty($this->input->post('password')) && strlen($this->input->post('password')) < 8) {
            echo "Password minimal 8 karakter!";
            return;
        }

        $password = $this->input->post('password');
        if ($password !== $data[0]['password']) {
            $password = md5($this->input->post('password'));
        }

        $data['id_user'] = $this->input->post('id_user');
        $data['username'] = $this->input->post('username');
        $data['password'] = $password;
        $data['nip'] = $this->input->post('nip');
        $data['nama_pegawai'] = $this->input->post('nama_pegawai');
        $data['jabatan'] = $this->input->post('jabatan');
        $data['unit_kerja'] = $this->input->post('unit_kerja');
        $data['id_golongan'] = $this->input->post('nama_golongan');
        $res = $this->AdminModel->update_user_by_id($data);

        echo 'success';
    }

    public function hapus_pengguna()
    {
        $id_user = $this->input->post('id_user');
        $res = $this->AdminModel->hapus_pengguna($id_user);
        echo json_encode($res);
    }


    public function daftar_konfirmasi_izin_belajar()
    {
        $session_data = $this->session->userdata('sess_admin');
        $datacontent['session'] = $session_data;
        $this->template->view('template/admin/daftar_konfirmasi_izin_belajar', 1, $datacontent);
    }

    public function daftar_konfirmasi_pensiun()
    {
        $session_data = $this->session->userdata('sess_admin');
        $datacontent['session'] = $session_data;
        $this->template->view('template/admin/daftar_konfirmasi_pensiun', 1, $datacontent);
    }

    public function get_konfirmasi_pengajuan_izin_belajar()
    {
        $session_data = $this->session->userdata('sess_admin');
        $data['session'] = $session_data;
        $result = $this->AdminModel->get_konfirmasi_aju_izin_belajar($data);
        echo json_encode($result);
    }

    public function get_konfirmasi_pengajuan_pensiun()
    {
        $session_data = $this->session->userdata('sess_admin');
        $data['session'] = $session_data;
        $result = $this->AdminModel->get_konfirmasi_aju_pensiun($data);
        echo json_encode($result);
    }

    public function get_nama_aju_izin_belajar()
    {
        $id_izin_belajar = $this->input->get('id_izin_belajar');
        $result = $this->AdminModel->get_nama_aju_izin_belajar_byid($id_izin_belajar);
        echo json_encode($result);
    }

    public function get_nama_aju_pensiun()
    {
        $id_pensiun = $this->input->get('id_pensiun');
        $result = $this->AdminModel->get_nama_aju_pensiun_byid($id_pensiun);
        echo json_encode($result);
    }


    public function update_disposisi_izin_belajar()
    {
        $session_data = $this->session->userdata('sess_admin');
        $datacontent['session'] = $session_data;
        $this->template->view('template/admin/update_disposisi_izin_belajar', 1, $datacontent);
    }

    public function rekap_izin_belajar()
    {
        $session_data = $this->session->userdata('sess_admin');
        $datacontent['session'] = $session_data;
        $this->template->view('template/admin/rekap_izin_belajar', 1, $datacontent);
    }

    public function rekap_pensiun()
    {
        $session_data = $this->session->userdata('sess_admin');
        $datacontent['session'] = $session_data;
        $datacontent['golongan'] = $this->AdminModel->get_golongan();
        $this->template->view('template/admin/rekap_pensiun', 1, $datacontent);
    }

    public function get_rekap_bulanan_pengajuan()
    {
        $session_data = $this->session->userdata('sess_admin');
        $data['session'] = $session_data;
        $tahun = $this->input->GET('tahun');
        $bulan = $this->input->GET('bulan');
        $result = $this->AdminModel->get_rekap_bulan_aju($bulan, $tahun);
        echo json_encode($result);
    }

    public function get_all_rekap_pengajuan()
    {
        $session_data = $this->session->userdata('sess_admin');
        $data['session'] = $session_data;
        $result = $this->AdminModel->get_all_rekap_aju($data);
        echo json_encode($result);
    }

    public function terima_aju_izin_belajar()
    {
        $data['id_izin_belajar'] = $this->input->post('id_izin_belajar');
        $data['tgl_disposisi_bkpsdm'] = $this->input->post('tgl_disposisi_bkpsdm');
        $data['tgl_disposisi_sekda'] = $this->input->post('tgl_disposisi_sekda');
        $data['status_pengajuan'] = 'DITERIMA';
        $result = $this->AdminModel->terima_aju_izin_belajar($data);

        echo json_encode($result);
    }

    public function terima_aju_pensiun()
    {
        $data['id_pensiun'] = $this->input->post('id_pensiun');
        $data['tgl_asistentiga'] = $this->input->post('tgl_asistentiga');
        $data['tgl_disposisi_sekda'] = $this->input->post('tgl_disposisi_sekda');
        $data['tgl_disposisi_bkn_pusat'] = $this->input->post('tgl_disposisi_bkn_pusat');
        $data['status_pengajuan'] = 'DITERIMA';
        $result = $this->AdminModel->terima_aju_pensiun($data);

        echo json_encode($result);
    }

    public function tolak_pengajuan_izin_belajar()
    {
        $data['id_izin_belajar'] = $this->input->post('id_izin_belajar');
        $data['status_pengajuan'] = $this->input->post('status_pengajuan');
        $result = $this->AdminModel->tolak_aju_izin_belajar($data);
        echo json_encode($data);
    }

    public function tolak_pengajuan_pensiun()
    {
        $data['id_pensiun'] = $this->input->post('id_pensiun');
        $data['status_pengajuan'] = $this->input->post('status_pengajuan');
        $result = $this->AdminModel->tolak_aju_pensiun($data);
        echo json_encode($data);
    }

    public function get_all_rekap_izin_belajar()
    {
        $session_data = $this->session->userdata('sess_admin');
        $data['session'] = $session_data;
        $result = $this->AdminModel->get_all_rekap_izin_belajar($data);
        echo json_encode($result);
    }

    public function get_rekap_bulanan_izin_belajar()
    {
        $session_data = $this->session->userdata('sess_admin');
        $data['session'] = $session_data;
        $tahun = $this->input->GET('tahun');
        $bulan = $this->input->GET('bulan');
        $status = $this->input->GET('status');
        $pendidikan = $this->input->GET('pendidikan');
        $result = $this->AdminModel->get_rekap_bulan_izin_belajar($bulan, $tahun, $status, $pendidikan);
        echo json_encode($result);
    }

    public function get_all_rekap_pensiun()
    {
        $session_data = $this->session->userdata('sess_admin');
        $data['session'] = $session_data;
        $result = $this->AdminModel->get_all_rekap_pensiun($data);
        echo json_encode($result);
    }

    public function get_rekap_bulanan_pensiun()
    {
        $session_data = $this->session->userdata('sess_admin');
        $data['session'] = $session_data;
        $tahun = $this->input->GET('tahun');
        $bulan = $this->input->GET('bulan');
        $status = $this->input->GET('status');
        $golongan = $this->input->GET('nama_golongan');
        $result = $this->AdminModel->get_rekap_bulan_pensiun($bulan, $tahun, $status, $golongan);
        echo json_encode($result);
    }

    public function get_tahun_izin_belajar()
    {
        $result = $this->AdminModel->get_jumlah_tahun_izin_belajar();
        echo json_encode($result);
    }

    public function get_grafik_aju_izin_belajar()
    {
        $terima = $this->AdminModel->get_terima_izin_belajar();
        $tolak = $this->AdminModel->get_tolak_izin_belajar();
        $statistik['DITERIMA'] = $terima[0]['status_aju_izin_belajar'];
        $statistik['DITOLAK'] = $tolak[0]['status_aju_izin_belajar'];
        echo json_encode($statistik);
    }

    public function get_tahun_pensiun()
    {
        $result = $this->AdminModel->get_jumlah_tahun_pensiun();
        echo json_encode($result);
    }

    public function get_grafik_aju_pensiun()
    {
        $terima = $this->AdminModel->get_terima_pensiun();
        $tolak = $this->AdminModel->get_tolak_pensiun();
        $statistik1['DITERIMA'] = $terima[0]['status_aju_pensiun'];
        $statistik1['DITOLAK'] = $tolak[0]['status_aju_pensiun'];
        echo json_encode($statistik1);
    }
}
