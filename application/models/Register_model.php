<?php
defined('BASEPATH') or
    header("Location: index.html");

class Register_model extends CI_Model
{
    public function register($data)
    {
        $existingUserQuery = "SELECT * FROM users WHERE nama = ? OR email = ? OR no_telepon = ? OR password = ?";
        $existingUserBindings = [
            $data['nama'],
            $data['email'],
            $data['no_telepon'],
            $data['password']
        ];
        $existingUser = $this->db->query($existingUserQuery, $existingUserBindings)->row();

        if ($existingUser) {
            $this->session->set_flashdata('error', 'Nama, email, no telepon, atau password sudah ada atau dipakai.');
            redirect('../register');
        }

        $query = "CALL tambah_user(?, ?, ?, ?, ?, ?, ?)";
        $bindings = [
            $data['nama'],
            $data['email'],
            $data['password'],
            $data['jenkel'],
            $data['no_telepon'],
            $data['alamat'],
            $data['foto_profil'],
        ];
        return $this->db->query($query, $bindings);
    }
}
