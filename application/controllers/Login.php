<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Login_model');
        $this->load->helper('url');
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

        // Validasi input kosong
        if (empty($email) || empty($password)) {
            $this->session->set_flashdata('error', 'Email dan password tidak boleh kosong!');
            redirect('../login');
            return;
        }

        $result = $this->Login_model->login($email, $password);

        if ($result) {
            $this->load->library('session');
            // Simpan data login ke dalam session
            $session_data = [
                'role' => $result->role, // Role: user/admin
                'nama' => $result->nama, // User name
                'logged_in' => TRUE // Status login
            ];

            $this->session->set_userdata($session_data);

            // Redirect berdasarkan role
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
