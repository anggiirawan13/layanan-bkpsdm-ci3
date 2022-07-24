<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MainController extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->load->model('MainModel');
    }
    public function index()
    {

        if ($this->session->userdata('sess_admin')) {
            redirect("AdminController", 'refresh');
        } else if ($this->session->userdata('sess_pegawai')) {
            redirect("PegawaiController", 'refresh');
        } else if ($this->session->userdata('sess_atasan')) {
            redirect("AtasanController", 'refresh');
        } else {
            redirect("AuthLogin");
        }
    }

    public function logout()
    {
        // $id_user = "";
        if ($this->session->userdata('sess_admin')) {
            $this->session->unset_userdata('sess_admin');
        } else if ($this->session->userdata('sess_pegawai')) {
            $this->session->unset_userdata('sess_pegawai');
        } else if ($this->session->userdata('sess_atasan')) {
            $this->session->unset_userdata('sess_atasan');
        }

        redirect('AuthLogin', 'refresh');
    }

}
