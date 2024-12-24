<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Error extends CI_Controller
{
    public function index()
    {
        $data['title'] = 'Hikyu | Error';
        $this->load->view('templates/header', $data);
        $this->load->view('pages/error/404');
        $this->load->view('templates/footer');
    }
}
