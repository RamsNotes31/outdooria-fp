<?php
defined('BASEPATH') or
    header("Location: error");

class Login_model extends CI_Model
{
    public function login($email, $password)
    {
        $this->db->where('email', $email);
        $this->db->where('password', $password);
        $query = $this->db->get('users');

        if ($query->num_rows() == 1) {
            $user = $query->row();
            $user->role = 'user';
            return $user;
        }

        $this->db->where('email_admin', $email);
        $this->db->where('password_admin', $password);
        $query = $this->db->get('admin');

        if ($query->num_rows() == 1) {
            $admin = $query->row();
            $admin->role = 'admin';
            $this->session->set_userdata('nama_admin', $admin->nama_admin);
            return $admin;
        }


        return false;
    }
}
