<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Akun_model extends CI_Model
{

    /**
     * Delete user account based on session 'nama'
     * 
     * @return bool True if deletion was successful, False otherwise
     */
    public function delete_user_by_session_name()
    {
        // Get the session 'nama'
        $nama = $this->session->userdata('nama');

        if (empty($nama)) {
            return false; // No session 'nama', cannot proceed
        }

        // Fetch the user's profile photo filename from the database
        $this->db->select('foto_profil');
        $this->db->where('nama', $nama);
        $query = $this->db->get('users');
        $foto_profil = $query->row()->foto_profil ?? null;

        if ($foto_profil && $foto_profil !== 'default.png') {
            // Construct the file path
            $file_path = './public/img/user/' . $foto_profil;

            // Attempt to delete the file if it exists
            if (file_exists($file_path)) {
                unlink($file_path);
            }
        }

        // Disable foreign key checks temporarily
        $this->db->query('SET FOREIGN_KEY_CHECKS = 0');

        // Perform the deletion
        $this->db->where('nama', $nama);
        $result = $this->db->delete('users');

        // Re-enable foreign key checks
        $this->db->query('SET FOREIGN_KEY_CHECKS = 1');

        return $result; // Return deletion status
    }

    public function delete_foto_by_session_name()
    {
        $nama = $this->session->userdata('nama');

        if (empty($nama)) {
            return false; // No session 'nama', cannot proceed
        }

        // Fetch the user's profile photo filename from the database
        $this->db->select('foto_profil');
        $this->db->where('nama', $nama);
        $query = $this->db->get('users');
        $foto_profil = $query->row()->foto_profil ?? null;



        // Update the foto_profil to default.png
        $this->db->set('foto_profil', 'default.png');
        $this->db->where('nama', $nama);
        $result = $this->db->update('users');

        return $result; // Return deletion status
    }

    // Function to get user by 'nama'
    public function get_user_by_name($nama)
    {
        $this->db->where('nama', $nama);
        $query = $this->db->get('users');
        return $query->row_array(); // Return a single row as an array
    }

    public function get_user_by_names($names)
    {
        $this->db->select('foto_profil, nama, tanggal_daftar');
        $this->db->where('LOWER(nama)', strtolower($names)); // Membandingkan secara case-insensitive
        $query = $this->db->get('users');
        return $query->row_array(); // Mengembalikan satu baris sebagai array
    }

    // Function to update user data
    public function update_user($id_user, $data)
    {
        $this->db->where('id_user', $id_user);
        $this->db->update('users', $data);
    }

    public function get_admin_by_name($name)
    {
        // Pilih kolom termasuk foto_admin
        $this->db->select('id_admin, nama_admin, email_admin, no_telp_admin, foto_admin, tanggal_ditambahkan');
        $this->db->where('LOWER(nama_admin)', strtolower($name)); // Case-insensitive
        $query = $this->db->get('admin');
        return $query->row_array();
    }

    // public function get_id_by_name($nama)
    // {
    //     $this->db->select('id_user');
    //     $this->db->from('users');
    //     $this->db->where('nama', $nama);
    //     $query = $this->db->get();

    //     return $query->num_rows() > 0 ? $query->row()->id_user : null;
    // }

    
    public function get_id_by_name($nama)
    {
        $this->db->where('nama', $nama);
        $result = $this->db->get('users')->row();
        return $result ? $result->id_user : null; // Return user ID if exists
    }

    public function get_feedback_by_user($id_user)
    {
        $this->db->select('feedback.id_feedback, feedback.id_user, feedback.id_alat, feedback.komentar, feedback.rating, feedback.tanggal_feedback, alat_pendakian.nama_alat');
        $this->db->from('feedback');
        $this->db->join('alat_pendakian', 'feedback.id_alat = alat_pendakian.id_alat');
        $this->db->where('feedback.id_user', $id_user); // Gunakan id_user, bukan nama
        $query = $this->db->get();

        return $query->result_array(); // Kembalikan semua data sebagai array
    }

    public function delete_feedback($id_feedback)
    {
        $this->db->where('id_feedback', $id_feedback);
        return $this->db->delete('feedback'); // Menghapus data dan mengembalikan status
    }

    public function update_feedback($id_feedback, $data)
    {
        $this->db->where('id_feedback', $id_feedback);
        return $this->db->update('feedback', $data); // Memperbarui data dan mengembalikan status
    }

    public function get_favorite_items($id_user)
    {
        $this->db->select('alat_pendakian.id_alat, alat_pendakian.nama_alat, alat_pendakian.foto_produk');
        $this->db->from('favorit');
        $this->db->join('alat_pendakian', 'favorit.id_alat = alat_pendakian.id_alat');
        $this->db->where('favorit.id_user', $id_user);
        $this->db->order_by('favorit.tanggal_ditambahkan', 'DESC');
        $query = $this->db->get();
        return $query->result_array(); // Kembalikan semua data sebagai array
    }

    public function delete_favorite_item($id_user, $id_alat)
    {
        $this->db->where('id_user', $id_user);
        $this->db->where('id_alat', $id_alat);
        return $this->db->delete('favorit'); // Hapus data dan kembalikan status
    }

    public function get_user_by_id($id_user)
    {
        $this->db->where('id_user', $id_user);
        return $this->db->get('users')->row(); // Returns the user object
    }

    
}
