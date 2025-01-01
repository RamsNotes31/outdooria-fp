<?php

defined('BASEPATH') or exit('No direct script access allowed');


class Register extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Register_model');

        $this->load->library('form_validation');
        $this->load->library('session');
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
            'jenkel' => $this->input->post('jenkel'),
            'no_telepon' => $this->input->post('no_hp'),
            'alamat' => $this->input->post('alamat'),
        );

        $result = $this->Register_model->register($data);

        if ($result) {
            $this->session->set_flashdata('success', 'Akun berhasil dibuat!');
            $this->load->library('upload');

            $config['upload_path'] = './public/img/user/';
            $config['allowed_types'] = 'heic|jpg|jpeg|png';
            $config['file_name'] = $this->input->post('nama'); 

            $this->upload->initialize($config);

            if ($_FILES['foto']['name']) {
                if (!$this->upload->do_upload('foto')) {
                    $error = $this->upload->display_errors();

                    $this->db->where('email', $this->input->post('username'));
                    $this->db->delete('users');

                    $this->session->set_flashdata('error', 'Maaf, file yang diupload tidak sesuai! ' . $error);
                    redirect('../register');
                } else {
                    $upload_data = $this->upload->data();
                    $new_file_name = $this->input->post('nama') . $upload_data['file_ext'];
                    rename($upload_data['full_path'], $upload_data['file_path'] . $new_file_name);

                    $this->db->where('email', $this->input->post('username'));
                    $this->db->update('users', array('foto_profil' => $new_file_name));
                }
            } else {
                $this->db->where('email', $this->input->post('username'));
                $this->db->update('users', array('foto_profil' => 'default.png'));
            }

            redirect('../login');
        } else {
            $this->session->set_flashdata('error', 'Akun gagal dibuat!');
            redirect('../register');
        }
    }
}
