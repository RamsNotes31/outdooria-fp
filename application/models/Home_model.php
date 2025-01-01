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
        $this->db->select('IFNULL(users.nama, "Deleted User") AS nama_user, foto_profil, alat_pendakian.nama_alat, feedback.komentar, feedback.rating, feedback.tanggal_feedback, feedback.foto');
        $this->db->from('feedback');
        $this->db->join('alat_pendakian', 'feedback.id_alat = alat_pendakian.id_alat');
        $this->db->join('users', 'feedback.id_user = users.id_user', 'left');
        $this->db->where('feedback.rating >', 4);
        $this->db->order_by('RAND()');
        $this->db->limit($limit);
        $query = $this->db->get();

        return $query->num_rows() > 0 ? $query->result() : [];
    }

    public function get_average_rating()
    {
        $this->db->select_avg('rating', 'average_rating');
        $query = $this->db->get('feedback');
        return $query->row()->average_rating;
    }


    public function count_feedback()
    {
        $this->db->select('COUNT(*) as count_feedback');
        $query = $this->db->get('feedback');
        return $query->row()->count_feedback;
    }

    public function get_admin_details()
    {

        $this->db->where('nama_admin !=', 'bot');
        $this->db->select('nama_admin, foto_admin, email_admin, no_telp_admin');
        $query = $this->db->get('admin');

        return $query->result();
    }
}
