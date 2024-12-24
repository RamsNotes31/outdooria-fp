<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function index()
    {
        $data['title'] = 'Hikyu | Login';
        $this->load->view('templates/header', $data);
        $this->load->view('pages/login/login');
        $this->load->view('templates/footer');
    }
}
