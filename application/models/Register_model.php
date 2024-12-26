<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Register_model extends CI_Model
{
    public function register($data)
    {
        // Check if user data already exists
        $existingUserQuery = "SELECT * FROM users WHERE nama = ? OR email = ? OR no_telepon = ? OR password = ?";
        $existingUserBindings = [
            $data['nama'],
            $data['email'],
            $data['no_telepon'],
            $data['password']
        ];
        $existingUser = $this->db->query($existingUserQuery, $existingUserBindings)->row();

        if ($existingUser) {
            redirect('../register');
        }

        // Proceed to register new user
        $query = "CALL tambah_user(?, ?, ?, ?, ?, ?)";
        $bindings = [
            $data['nama'],
            $data['email'],
            $data['password'],
            $data['no_telepon'],
            $data['alamat'],
            $data['foto_profil'],
        ];
        return $this->db->query($query, $bindings);
    }
}
