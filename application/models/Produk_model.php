<?php
class Produk_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_produk_with_feedback()
    {
        $this->db->select('
            alat_pendakian.foto_produk,
            alat_pendakian.id_alat,
            alat_pendakian.nama_alat,
            alat_pendakian.harga_sewa,
            alat_pendakian.stok,
            COALESCE(AVG(feedback.rating), 0) AS rata_rata_rating
        ');
        $this->db->from('alat_pendakian');
        $this->db->join('feedback', 'feedback.id_alat = alat_pendakian.id_alat', 'left'); // Left join untuk tetap menampilkan produk tanpa feedback
        $this->db->group_by('alat_pendakian.id_alat'); // Kelompokkan berdasarkan ID alat
        $query = $this->db->get();

        // Debugging
        if (!$query->num_rows()) {
            log_message('error', 'No data retrieved from alat_pendakian.');
        }

        return $query->result(); // Pastikan selalu mengembalikan array
    }

    public function get_produk_by_id($id_alat)
    {
        $this->db->where('id_alat', $id_alat);
        $query = $this->db->get('produk');  // Gantilah 'produk' dengan nama tabel produk Anda
        return $query->row_array();
    }

    public function get_product_details($product_id)
    {
        $this->db->select('
            alat_pendakian.foto_produk,
            alat_pendakian.id_alat,
            alat_pendakian.nama_alat,
            alat_pendakian.harga_sewa,
            alat_pendakian.stok,
            alat_pendakian.deskripsi,
            COALESCE(AVG(feedback.rating), 0) AS rata_rata_rating
        ');
        $this->db->from('alat_pendakian');
        $this->db->join('feedback', 'feedback.id_alat = alat_pendakian.id_alat', 'left'); // Left join untuk tetap menampilkan produk tanpa feedback
        $this->db->where('alat_pendakian.id_alat', $product_id);
        return $this->db->get()->row_array();
    }

    public function get_available_series($product_id)
    {
        $this->db->select('seri_alat, kondisi, status_produk');
        $this->db->from('seri');
        $this->db->where('id_alat', $product_id);
        $this->db->where('status_produk', 'tersedia');
        return $this->db->get()->result_array();
    }

    public function get_random_products($limit = 4)
    {
        $this->db->select('
        alat_pendakian.foto_produk,
        alat_pendakian.id_alat,
        alat_pendakian.nama_alat,
        alat_pendakian.harga_sewa,
        alat_pendakian.stok,
        alat_pendakian.deskripsi,
        COALESCE(AVG(feedback.rating), 0) AS rata_rata_rating
    ');
        $this->db->from('alat_pendakian');
        $this->db->join('feedback', 'feedback.id_alat = alat_pendakian.id_alat', 'left');
        $this->db->group_by('alat_pendakian.id_alat');
        $this->db->order_by('RAND()'); // Urutan acak
        $this->db->limit($limit); // Batasi jumlah produk
        return $this->db->get()->result_array();
    }

    public function get_reviews_by_product($product_id)
    {
        $this->db->select('feedback.rating, feedback.komentar, users.nama, users.foto_profil, feedback.tanggal_feedback');
        $this->db->from('feedback');
        $this->db->join('users', 'users.id_user = feedback.id_user');  // Sesuaikan nama kolom
        $this->db->where('feedback.id_alat', $product_id);  // Filter berdasarkan id produk
        $this->db->order_by('feedback.tanggal_feedback', 'DESC');  // Urutkan berdasarkan waktu ulasan terbaru
        return $this->db->get()->result_array();
    }
}
