<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AtasanController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('sess_atasan')) {
            redirect("AuthLogin");
        }

        $this->load->library('form_validation', 'session');
        $this->load->helper(array('form', 'url'));
        $this->load->model('AtasanModel');
        $this->load->model('AdminModel');
        // $this->load->model('MainModel'); 
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        $session_data = $this->session->userdata('sess_atasan');
        $datacontent['session'] = $session_data;
        $datacontent['rekapBelajar'] = $this->AtasanModel->get_count_rekap_izin_belajar();
        $datacontent['rekapPensiun'] = $this->AtasanModel->get_count_rekap_pensiun();
        $this->template->view('template/atasan/main_content', 3, $datacontent);
    }

    public function dashboard()
    {
        $session_data = $this->session->userdata('sess_atasan');
        $datacontent['session'] = $session_data;
        $datacontent['rekapBelajar'] = $this->AtasanModel->get_count_rekap_izin_belajar();
        $datacontent['rekapPensiun'] = $this->AtasanModel->get_count_rekap_pensiun();
        $this->template->view('template/atasan/main_content', 3, $datacontent);
    }


    public function rekap_izin_belajar()
    {
        $session_data = $this->session->userdata('sess_atasan');
        $datacontent['session'] = $session_data;
        $this->template->view('template/atasan/rekap_izin_belajar', 3, $datacontent);
    }

    public function get_all_rekap_izin_belajar()
    {
        $session_data = $this->session->userdata('sess_atasan');
        $data['session'] = $session_data;
        $result = $this->AtasanModel->get_all_rekap_izin_belajar($data);
        echo json_encode($result);
    }

    public function get_rekap_bulanan_izin_belajar()
    {
        $session_data = $this->session->userdata('sess_atasan');
        $data['session'] = $session_data;
        $tahun = $this->input->GET('tahun');
        $bulan = $this->input->GET('bulan');
        $status = $this->input->GET('status');
        $pendidikan = $this->input->GET('pendidikan');
        $result = $this->AtasanModel->get_rekap_bulan_izin_belajar($bulan, $tahun, $status, $pendidikan);
        echo json_encode($result);
    }

    public function get_all_rekap_pensiun()
    {
        $session_data = $this->session->userdata('sess_atasan');
        $data['session'] = $session_data;
        $result = $this->AtasanModel->get_all_rekap_pensiun($data);
        echo json_encode($result);
    }

    public function get_rekap_bulanan_pensiun()
    {
        $session_data = $this->session->userdata('sess_atasan');
        $data['session'] = $session_data;
        $tahun = $this->input->GET('tahun');
        $bulan = $this->input->GET('bulan');
        $status = $this->input->GET('status');
        $golongan = $this->input->GET('nama_golongan');
        $result = $this->AtasanModel->get_rekap_bulan_pensiun($bulan, $tahun, $status, $golongan);
        echo json_encode($result);
    }

    public function rekap_pensiun()
    {
        $session_data = $this->session->userdata('sess_atasan');
        $datacontent['session'] = $session_data;
        $datacontent['golongan'] = $this->AdminModel->get_golongan();
        $this->template->view('template/atasan/rekap_pensiun', 3, $datacontent);
    }
}
