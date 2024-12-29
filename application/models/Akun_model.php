<?php
defined('BASEPATH') or
    header("Location: error");

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
        $this->db->select('foto_profil, nama, tanggal_daftar, jenis_kelamin');
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



    // public function get_id_by_names($nama)
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
        $this->db->select('feedback.id_feedback, feedback.id_user, feedback.id_alat, feedback.komentar, feedback.rating, feedback.tanggal_feedback, feedback.foto, alat_pendakian.nama_alat');
        $this->db->from('feedback');
        $this->db->join('alat_pendakian', 'feedback.id_alat = alat_pendakian.id_alat');
        $this->db->where('feedback.id_user', $id_user); // Gunakan id_user, bukan nama
        $query = $this->db->get();

        return $query->result_array(); // Kembalikan semua data sebagai array
    }

    public function delete_feedback($id_feedback)
    {
        // Hapus foto jika ada
        $this->db->where('id_feedback', $id_feedback);
        $feedback = $this->db->get('feedback')->row();
        if ($feedback->foto) {
            $file_path = './public/img/feedback/' . $feedback->foto;
            if (file_exists($file_path)) {
                unlink($file_path);
            }
        }

        $this->db->where('id_feedback', $id_feedback);

        return $this->db->delete('feedback'); // Menghapus data dan mengembalikan status
    }

    public function delete_feedback_foto($id_feedback)
    {
        $this->db->where('id_feedback', $id_feedback);
        $feedback = $this->db->get('feedback')->row();
        if ($feedback->foto) {
            $file_path = './public/img/feedback/' . $feedback->foto;
            if (file_exists($file_path)) {
                unlink($file_path);
            }
        }
        $this->db->where('id_feedback', $id_feedback);
        $this->db->set('foto', null);
        if ($this->db->update('feedback')) { // Menghapus foto dan mengembalikan status
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function get_feedback_photo($id_feedback)
    {
        $this->db->select('foto');
        $this->db->from('feedback');
        $this->db->where('id_feedback', $id_feedback);
        $query = $this->db->get();
        $result = $query->row();
        return $result ? $result->foto : null;
    }

    public function get_feedback_penyewaan($id_feedback)
    {
        $this->db->select('id_penyewaan');
        $this->db->from('feedback');
        $this->db->where('id_feedback', $id_feedback);
        $query = $this->db->get();
        $result = $query->row();
        return $result ? $result->id_penyewaan : null;
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

    public function get_riwayat_penyewaan($id_user)
    {
        $this->db->select('
        alat_pendakian.nama_alat,
        penyewaan.seri_alat,
        penyewaan.tanggal_penyewaan,
        penyewaan.tanggal_pengembalian,
        penyewaan.total_harga,
        penyewaan.status_sewa,
        penyewaan.bukti_pembayaran  ,
        penyewaan.id_penyewaan
    ');
        $this->db->from('penyewaan');
        $this->db->join('seri', 'penyewaan.seri_alat = seri.seri_alat', 'left');
        $this->db->join('alat_pendakian', 'seri.id_alat = alat_pendakian.id_alat', 'left');
        $this->db->where('penyewaan.id_user', $id_user);
        $query = $this->db->get();
        return $query->result(); // Mengembalikan array objek hasil query
    }

    public function get_feedback_stats($id_user)
    {
        $this->db->select('COUNT(*) AS total_feedback, AVG(rating) AS rata_rata_feedback');
        $this->db->from('feedback');
        $this->db->where('id_user', $id_user);
        $query = $this->db->get();
        return $query->row(); // Mengembalikan total dan rata-rata feedback
    }

    public function get_total_penyewaan($id_user)
    {
        $this->db->select('COUNT(*) AS total_penyewaan');
        $this->db->from('penyewaan');
        $this->db->where('id_user', $id_user);
        $this->db->where('status_sewa', 'selesai');
        $query = $this->db->get();
        return $query->row(); // Mengembalikan total penyewaan
    }

    public function get_top_barang($id_user)
    {
        $this->db->select('alat_pendakian.nama_alat, COUNT(penyewaan.id_penyewaan) AS jumlah_disewa');
        $this->db->from('penyewaan');
        $this->db->join('seri', 'penyewaan.seri_alat = seri.seri_alat', 'left');
        $this->db->join('alat_pendakian', 'seri.id_alat = alat_pendakian.id_alat', 'left');
        $this->db->where('penyewaan.id_user', $id_user);
        $this->db->where('status_sewa', 'selesai');
        $this->db->group_by('alat_pendakian.id_alat');
        $this->db->order_by('jumlah_disewa', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row(); // Mengembalikan barang yang paling sering disewa
    }

    // Mendapatkan ID admin dari nama_admin
    public function get_id_admin_by_name($nama_admin)
    {
        $this->db->select('id_admin');
        $this->db->from('admin');
        $this->db->where('nama_admin', $nama_admin);
        $query = $this->db->get();
        return $query->row(); // Mengembalikan ID admin sebagai objek
    }

    // Menampilkan jumlah informasi pendakian yang diposting oleh ID admin
    public function get_total_informasi_pendakian($id_admin)
    {
        $this->db->select('COUNT(*) AS total_informasi');
        $this->db->from('informasi_pendakian');
        $this->db->where('id_admin', $id_admin);
        $query = $this->db->get();
        return $query->row(); // Mengembalikan jumlah informasi sebagai objek
    }

    // Menampilkan jumlah chat dari ID admin tertentu
    public function get_total_chats_by_admin($id_admin)
    {
        $this->db->select('COUNT(*) AS total_chats');
        $this->db->from('chat');
        $this->db->where('id_admin', $id_admin);
        $query = $this->db->get();
        return $query->row(); // Mengembalikan jumlah chat sebagai objek
    }

    public function get_admin_by_name($name)
    {
        // Pilih kolom termasuk foto_admin
        $this->db->select('id_admin, nama_admin, email_admin, no_telp_admin, foto_admin, tanggal_ditambahkan, jenis_kelamin');
        $this->db->where('LOWER(nama_admin)', strtolower($name)); // Case-insensitive
        $query = $this->db->get('admin');
        return $query->row_array();
    }
}
