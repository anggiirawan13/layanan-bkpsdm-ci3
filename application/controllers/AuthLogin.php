<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AuthLogin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation', 'session');
        $this->load->helper(array('form', 'url'));
        // $this->load->model('PegawaiModel');
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim|callback_check_database');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Login Page';
            $this->load->view('template/login', $data);
        } else {
            redirect('MainController', 'refresh');
        }
    }

    function check_database($password)
    {
        //Field validation succeeded.  Validate against database
        $username = $this->input->post('username');

        //query the database
        $result = $this->AuthModel->login($username, md5($password));
        $sess_name = array(1 => "sess_admin", 2 => "sess_pegawai", 3 => "sess_atasan");
        if ($result) {

            $sess_array = array();
            foreach ($result as $row) {

                $sess_array = array(
                    'id_user' => $row->id_user,
                    'username' => $row->username,
                    'nip' => $row->nip,
                    'nama_pegawai' => $row->nama_pegawai,
                    'id_role' => $row->id_role,
                    'date_created' => $row->date_created,
                );

                $this->session->set_userdata($sess_name[$row->id_role], $sess_array);

                /*
                $data_log['id_user'] = $row->id_user;
                $data_log['id_staff'] = $row->id_staff;
                $data_log['aktivitas'] = "Login ke sistem";
                $res_log = $this->LogModel->insert($data_log); */
            }
            return TRUE;
        } else {
            $this->form_validation->set_message('check_database', 'Invalid username or password');
            return false;
        }
        
    }

    public function logout()
    {
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('id_role');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">You Have been Logout !</div>');
        redirect("AuthLogin");
    }
}
