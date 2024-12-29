<?php
defined('BASEPATH') or
    header("Location: error");

class Invoice_model extends CI_Model
{

    public function get_latest_penyewaan_by_user($id_invoice)
    {
        $this->db->select('penyewaan.*, users.nama AS nama_user, alat_pendakian.nama_alat');
        $this->db->join('users', 'users.id_user = penyewaan.id_user', 'left'); // Join tabel users
        $this->db->join('seri', 'seri.seri_alat = penyewaan.seri_alat', 'left'); // Join tabel seri
        $this->db->join('alat_pendakian', 'alat_pendakian.id_alat = seri.id_alat', 'left'); // Join tabel alat_pendakian
        $this->db->where('penyewaan.id_penyewaan', $id_invoice); // Filter berdasarkan id_penyewaan
        $query = $this->db->get('penyewaan');
        return $query->row_array(); // Ambil data sebagai array
    }

    public function get_latest_penyewaan_by_users($id_user, $seri_alat)
    {
        $this->db->select('id_penyewaan');
        $this->db->where('id_user', $id_user); // Filter berdasarkan ID user
        $this->db->where('seri_alat', $seri_alat); // Filter berdasarkan seri alat
        $this->db->order_by('tanggal_penyewaan', 'DESC'); // Urutkan berdasarkan tanggal penyewaan terbaru
        $this->db->limit(1); // Ambil hanya 1 data
        $query = $this->db->get('penyewaan');
        return $query->row_array(); // Kembalikan hasil sebagai array
    }

    public function get_invoice_by_id($id_penyewaan)
    {
        $this->db->select('penyewaan.*, users.nama, alat_pendakian.nama_alat');
        $this->db->join('users', 'users.id_user = penyewaan.id_user');
        $this->db->join('seri', 'seri.seri_alat = penyewaan.seri_alat');
        $this->db->join('alat_pendakian', 'alat_pendakian.id_alat = seri.id_alat');
        $this->db->where('penyewaan.id_penyewaan', $id_penyewaan);
        $query = $this->db->get('penyewaan');
        return $query->row_array();
    }

    public function upload_bukti_pembayaran($id_penyewaan)
    {

        $this->load->library('session');
        $nama = $this->session->userdata('nama');
        $config['upload_path']   = './public/img/bukti/'; // Lokasi folder upload
        $config['allowed_types'] = 'jpg|jpeg|png|heic';  // Jenis file yang diperbolehkan
        $config['file_name']     = $id_penyewaan . '_' . $nama;       // Nama file akan sesuai dengan id_penyewaan

        $this->load->library('upload', $config);       // Load library upload dengan konfigurasi

        if ($this->upload->do_upload('image')) {
            // Jika berhasil upload, ambil nama file dan simpan ke database
            $data = $this->upload->data();             // Data file yang diupload
            $file_name = $data['file_name'];           // Nama file hasil upload

            // Copy file ke folder chat
            copy('./public/img/bukti/' . $file_name, './public/img/chat/' . $file_name);

            // Update nama file bukti pembayaran di database
            $this->db->set('bukti_pembayaran', $file_name);
            $this->db->where('id_penyewaan', $id_penyewaan);
            $this->db->update('penyewaan');

            return true; // Upload berhasil
        } else {
            return false; // Upload gagal
        }
    }

    public function get_feedback_with_user($limit = 3)
    {
        $this->db->select('IFNULL(users.nama, "Deleted User") AS nama_user, IFNULL(foto_profil, "deleted.jpg") AS foto_profil, alat_pendakian.nama_alat, feedback.komentar, feedback.rating, feedback.tanggal_feedback, feedback.foto');
        $this->db->from('feedback');
        $this->db->join('alat_pendakian', 'feedback.id_alat = alat_pendakian.id_alat');
        $this->db->join('users', 'feedback.id_user = users.id_user', 'left'); // Join ke tabel users dengan left join
        $this->db->where('feedback.rating <=', 5); // Filter rating > 4
        $this->db->order_by('tanggal_feedback', 'DESC'); // Urutkan berdasarkan tanggal terbaru
        $this->db->limit($limit); // Batasi jumlah data
        $query = $this->db->get();

        return $query->num_rows() > 0 ? $query->result() : [];
        // Pastikan selalu mengembalikan array
    }

    public function get_id_by_name($nama)
    {
        $this->db->select('id_user');
        $this->db->from('users');
        $this->db->where('nama', $nama);
        $query = $this->db->get();

        return $query->num_rows() > 0 ? $query->row()->id_user : null;
    }

    public function get_id_by_product($nama_alat)
    {
        $this->db->select('id_alat'); // Pastikan kolom sesuai dengan database
        $this->db->from('alat_pendakian'); // Nama tabel alat
        $this->db->where('nama_alat', $nama_alat);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row()->id_alat; // Kembalikan ID alat
        } else {
            return null; // Jika tidak ditemukan
        }
    }

    public function check_feedback_exists_for_rental($id_penyewaan)
    {
        $this->db->select('id_feedback');
        $this->db->from('feedback');
        $this->db->where('id_penyewaan', $id_penyewaan);
        $query = $this->db->get();
        return $query->row(); // Mengembalikan feedback jika ada
    }

    public function tambah_feedback($id_user, $product_id, $id_penyewaan, $comment, $rating, $foto)
    {
        // Panggil stored procedure menggunakan CALL
        $this->db->query("CALL tambah_feedback(?, ?, ?, ?, ?, ?)", array($id_user, $product_id, $id_penyewaan, $comment, $rating, $foto));

        // Periksa apakah query berhasil
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function insert_chat_auto($data)
    {
        $this->db->query(
            "CALL tambah_chat(?, ?, ?, ?, ?)",
            array(
                $data['id_user'],
                $data['id_admin'],
                $data['role'],
                $data['pesan'],
                $data['foto_chat']
            )
        );

        // Periksa apakah query berhasil
        return $this->db->affected_rows() > 0;
    }
}
