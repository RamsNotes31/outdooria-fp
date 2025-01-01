<?php
defined('BASEPATH') or
    header("Location: error");

class Logout extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('cookie');
    }
    public function index()
    {
        delete_cookie('email');
        delete_cookie('password');

        $this->session->sess_destroy();
        redirect('../login');
    }

    public function logout()
    {
        delete_cookie('email');
        delete_cookie('password');
        $this->session->sess_destroy();
        redirect('../login');
    }
}
