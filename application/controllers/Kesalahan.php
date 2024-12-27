<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kesalahan extends CI_Controller
{
    public function index()
    {
        $data['title'] = 'Hikyu | Error';
        $this->load->view('templates/header3', $data);
        $this->load->view('pages/error/error');
        $this->load->view('templates/footer');
    }
}
