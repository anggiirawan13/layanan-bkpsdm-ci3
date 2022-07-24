<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AuthLogin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation', 'session');
    }

    public function index()
    {
        $this->form_validation->set_rules('userb', 'Nip', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim|callback_check_database');

        if ($this->form_validation->run() == false) {

            $data['title'] = 'Login | Layanan Sub Bidang BKPSDM Kota Palembang';
            $this->load->view('template/login', $data);
            //   $this->template->loginpage();
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
        $sess_name = array(1 => "sess_admin");
        if ($result) {

            $sess_array = array();
            foreach ($result as $row) {

                $sess_array = array(
                    'id_user' => $row->id_user,
                    'username' => $row->username,
                    'fullname' => $row->fullname,
                    'id_role' => $row->id_role,
                );

                $this->session->set_userdata($sess_name[$row->id_role], $sess_array);

            }
            return TRUE;
        } else {
            $this->form_validation->set_message('check_database', 'Invalid username or password');
            return false;
        }
    }

    // public function register()
    // {
    //     $this->form_validation->set_rules('fullname', 'FullName', 'required|trim');
    //     $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[user.username]', [
    //         'is_unique' => 'This username has already registered!'
    //     ]);
    //     $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[4]|matches[password2]', [
    //         'matches' => 'Password dont match',
    //         'min_length' => 'Password too short!'
    //     ]);
    //     if ($this->form_validation->run() == false) {
    //         $data['title'] = 'Register';
    //         $this->load->view('register', $data);
    //     } else {
    //         $data = [
    //             'name' => htmlspecialchars($this->input->post('name', true)),
    //             'username' => htmlspecialchars($this->input->post('username', true)),
    //             'password' => md5($this->input->post('password1')),
    //             // 'image' => 'default.jpg',
    //             'id_role' => 2,
    //         ];

    //         $this->db->insert('user', $data);
    //         $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Congratulation! your account has been created. Please Login!</div>');
    //         redirect('login');
    //     }
    // }

    public function logout()
    {
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('id_role');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">You Have been Logout !</div>');
        redirect('login');
    }
}
