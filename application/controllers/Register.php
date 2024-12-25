<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Register extends CI_Controller
{
    public function index()
    {
        $data['title'] = 'Hikyu | Register';
        $this->load->view('templates/header', $data);
        $this->load->view('pages/login/register');
        $this->load->view('templates/footer');
    }
}
