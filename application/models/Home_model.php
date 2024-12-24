<?php
class Home_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_feedback_with_user($limit = 3)
    {
        $this->db->select('users.nama AS nama_user, alat_pendakian.nama_alat, feedback.komentar, feedback.rating, feedback.tanggal_feedback');
        $this->db->from('feedback');
        $this->db->join('alat_pendakian', 'feedback.id_alat = alat_pendakian.id_alat');
        $this->db->join('users', 'feedback.id_user = users.id_user'); // Join ke tabel users
        $this->db->where('feedback.rating >', 4); // Filter rating > 4
        $this->db->order_by('RAND()'); // Urutkan secara acak
        $this->db->limit($limit); // Batasi jumlah data
        $query = $this->db->get();

        return $query->num_rows() > 0 ? $query->result() : [];
        // Pastikan selalu mengembalikan array
    }

    public function get_average_rating()
    {
        $this->db->select_avg('rating', 'average_rating'); // Mengambil rata-rata kolom rating
        $query = $this->db->get('feedback'); // Dari tabel feedback
        return $query->row()->average_rating; // Mengembalikan rata-rata rating
    }
}