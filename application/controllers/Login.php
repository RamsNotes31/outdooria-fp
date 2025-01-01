<?php
defined('BASEPATH') or
    header("Location: error");

class Login extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Login_model');
        $this->load->helper('url');
        $this->load->library('session');
    }

    public function index()
    {
        $data['title'] = 'Hikyu | Login';
        $this->load->view('templates/header', $data);
        $this->load->view('pages/login/login');
        $this->load->view('templates/footer');
    }

    public function login_action()

    {
        $this->load->library('session');
        $email = $this->input->post('email', TRUE);
        $password = $this->input->post('password', TRUE);
        $this->input->set_cookie(array(
            'name'   => 'email',
            'value'  => $email,
            'expire' => 2592000 
        ));
        $this->input->set_cookie(array(
            'name'   => 'password',
            'value'  => $password,
            'expire' => 2592000 
        ));

        if (empty($email) || empty($password)) {
            $this->session->set_flashdata('error', 'Email dan password tidak boleh kosong!');
            redirect('../login');
            return;
        }

        $result = $this->Login_model->login($email, $password);

        if ($result) {
            $this->load->library('session');
            $session_data = [
                'role' => $result->role, 
                'nama' => $result->nama, 
                'logged_in' => TRUE, 
                'cek' => false 
            ];

            $this->session->set_userdata($session_data);

            if ($result->role == 'admin') {
                redirect('../dashboard');
            } else {
                redirect('../home');
            }
        } else {
            $this->session->set_flashdata('error', 'Email atau password salah!');
            redirect('../login');
        }
    }
}
