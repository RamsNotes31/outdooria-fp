<?php
class Gunung_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_all_informasi_pendakian()
    {
        $this->db->select('informasi_pendakian.id_informasi, informasi_pendakian.nama_gunung, informasi_pendakian.harga_biaya, informasi_pendakian.lokasi, informasi_pendakian.foto_gunung, admin.nama_admin, admin.foto_admin');
        $this->db->from('informasi_pendakian');
        $this->db->join('admin', 'admin.id_admin = informasi_pendakian.id_admin', 'left');
        $this->db->order_by('RAND()'); // Buat random
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_informasi_by_id($id_informasi)
    {
        $this->db->select('informasi_pendakian.id_informasi, informasi_pendakian.nama_gunung, informasi_pendakian.harga_biaya, informasi_pendakian.lokasi, informasi_pendakian.deskripsi, informasi_pendakian.foto_gunung, admin.nama_admin, admin.foto_admin');
        $this->db->from('informasi_pendakian');
        $this->db->join('admin', 'admin.id_admin = informasi_pendakian.id_admin', 'left');
        $this->db->where('informasi_pendakian.id_informasi', $id_informasi);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function get_informasi_pendakian($limit = 6)
    {
        $this->db->select('informasi_pendakian.id_informasi, informasi_pendakian.nama_gunung, informasi_pendakian.harga_biaya, informasi_pendakian.lokasi, informasi_pendakian.foto_gunung');
        $this->db->from('informasi_pendakian');
        $this->db->order_by('rand()');
        $this->db->limit($limit);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_all_lokasi()
    {
        $this->db->distinct();
        $this->db->select('lokasi');
        $this->db->order_by('rand()');
        $query = $this->db->get('informasi_pendakian');
        return $query->result_array(); // Pastikan hasilnya dalam bentuk array
    }

    public function get_filtered_informasi($kategori, $search, $lokasi)
    {
        $this->db->select('informasi_pendakian.id_informasi, informasi_pendakian.nama_gunung, informasi_pendakian.harga_biaya, informasi_pendakian.lokasi, informasi_pendakian.foto_gunung, admin.nama_admin, admin.foto_admin');
        $this->db->join('admin', 'admin.id_admin = informasi_pendakian.id_admin', 'left');
        $this->db->from('informasi_pendakian');
        $this->db->order_by('rand()'); // Acak

        // Filter berdasarkan kategori
        if ($kategori == '1') {
            $this->db->order_by('harga_biaya', 'ASC');  // Harga ascending
        } elseif ($kategori == '2') {
            $this->db->order_by('harga_biaya', 'DESC'); // Harga descending
        } elseif ($kategori == '3') {
            $this->db->order_by('tanggal_update', 'DESC'); // Terbaru
        } elseif ($kategori == '0') {
            $this->db->order_by('rand()'); // Acak
        }

        // Filter berdasarkan pencarian
        if (!empty($search)) {
            $this->db->like('nama_gunung', $search);
        }

        if (!empty($lokasi)) {
            $this->db->like('lokasi', $lokasi);  // Pencarian lokasi
        }

        $query = $this->db->get();
        return $query->result_array();
    }
}