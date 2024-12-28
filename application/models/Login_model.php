<?php
defined('BASEPATH') or
    header("Location: error");

class Login_model extends CI_Model
{
    public function login($email, $password)
    {
        // Cek di tabel users
        $this->db->where('email', $email);
        $this->db->where('password', $password); // Cocokkan langsung password
        $query = $this->db->get('users');

        if ($query->num_rows() == 1) {
            $user = $query->row();
            $user->role = 'user';
            return $user;
        }

        // Cek di tabel admin
        $this->db->where('email_admin', $email);
        $this->db->where('password_admin', $password); // Cocokkan langsung password
        $query = $this->db->get('admin');

        if ($query->num_rows() == 1) {
            $admin = $query->row();
            $admin->role = 'admin';
            return $admin;
        }

        // Jika tidak ditemukan di kedua tabel
        return false;
    }
}
