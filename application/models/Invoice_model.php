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
        $config['upload_path']   = './public/img/bukti/'; // Lokasi folder upload
        $config['allowed_types'] = 'jpg|jpeg|png|heic';  // Jenis file yang diperbolehkan
        $config['file_name']     = $id_penyewaan;       // Nama file akan sesuai dengan id_penyewaan
        $config['overwrite']     = true;               // Overwrite jika file dengan nama yang sama sudah ada

        $this->load->library('upload', $config);       // Load library upload dengan konfigurasi

        if ($this->upload->do_upload('image')) {
            // Jika berhasil upload, ambil nama file dan simpan ke database
            $data = $this->upload->data();             // Data file yang diupload
            $file_name = $data['file_name'];           // Nama file hasil upload

            // Update nama file bukti pembayaran di database
            $this->db->set('bukti_pembayaran', $file_name);
            $this->db->where('id_penyewaan', $id_penyewaan);
            $this->db->update('penyewaan');

            return true; // Upload berhasil
        } else {
            return false; // Upload gagal
        }
    }
}
