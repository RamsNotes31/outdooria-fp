<?php

defined('BASEPATH') or exit('No direct script access allowed');

$ci = new CI_Controller();
$ci = &get_instance();
$ci->load->helper('url');


class Register extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Register_model');
    }

    public function index()
    {
        $data['title'] = 'Hikyu | Register';
        $this->load->view('templates/header', $data);
        $this->load->view('pages/login/register');
        $this->load->view('templates/footer');
    }

    public function register_action()
    {
        $data = array(
            'nama' => $this->input->post('nama'),
            'email' => $this->input->post('username'),
            'password' => $this->input->post('password'),
            'no_telepon' => $this->input->post('no_hp'),
            'alamat' => $this->input->post('alamat'),
        );

        $result = $this->Register_model->register($data);

        if ($result) {
            $this->load->library('upload');

            // Konfigurasi upload file
            $config['upload_path'] = './public/img/user/';
            $config['allowed_types'] = 'heic|jpg|jpeg|png';

            $this->upload->initialize($config);

            if (!$this->upload->do_upload('foto')) {
                $error = $this->upload->display_errors();

                // Hapus user jika file yang diupload bukan gambar yang diizinkan
                $this->db->where('email', $this->input->post('username'));
                $this->db->delete('users');

                redirect('../register');
            } else {
                $upload_data = $this->upload->data();
                $new_file_name = $this->input->post('nama') . $upload_data['file_ext'];
                rename($upload_data['full_path'], $upload_data['file_path'] . $new_file_name);

                $this->db->where('email', $this->input->post('username'));
                $this->db->update('users', array('foto_profil' => $new_file_name));
            }

            redirect('../login');
        } else {
            redirect('../register');
        }
    }
}
