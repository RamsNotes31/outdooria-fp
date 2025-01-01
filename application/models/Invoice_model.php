<?php
defined('BASEPATH') or
    header("Location: error");

class Invoice_model extends CI_Model
{

    public function get_latest_penyewaan_by_user($id_invoice)
    {
        $this->db->select('penyewaan.*, users.nama AS nama_user, alat_pendakian.nama_alat');
        $this->db->join('users', 'users.id_user = penyewaan.id_user', 'left');
        $this->db->join('seri', 'seri.seri_alat = penyewaan.seri_alat', 'left');
        $this->db->join('alat_pendakian', 'alat_pendakian.id_alat = seri.id_alat', 'left');
        $this->db->where('penyewaan.id_penyewaan', $id_invoice);
        $query = $this->db->get('penyewaan');
        return $query->row_array();
    }

    public function get_latest_penyewaan_by_users($id_user, $seri_alat)
    {
        $this->db->select('id_penyewaan');
        $this->db->where('id_user', $id_user);
        $this->db->where('seri_alat', $seri_alat);
        $this->db->order_by('tanggal_penyewaan', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('penyewaan');
        return $query->row_array();
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
        $config['upload_path']   = './public/img/bukti/';
        $config['allowed_types'] = 'jpg|jpeg|png|heic';

        $config['file_name']     = $id_penyewaan . '_' . $nama;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('image')) {
            $data = $this->upload->data();
            $file_name = $data['file_name'];


            copy('./public/img/bukti/' . $file_name, './public/img/chat/' . $file_name);

            $this->db->set('bukti_pembayaran', $file_name);
            $this->db->where('id_penyewaan', $id_penyewaan);
            $this->db->update('penyewaan');

            return true;
        } else {
            log_message('error', 'Upload gagal: ' . $this->upload->display_errors());
            return $this->upload->display_errors();
        }
    }


    public function get_feedback_with_user($limit = 3)
    {
        $this->db->select('IFNULL(users.nama, "Deleted User") AS nama_user, IFNULL(foto_profil, "deleted.jpg") AS foto_profil, alat_pendakian.nama_alat, feedback.komentar, feedback.rating, feedback.tanggal_feedback, feedback.foto');
        $this->db->from('feedback');
        $this->db->join('alat_pendakian', 'feedback.id_alat = alat_pendakian.id_alat');
        $this->db->join('users', 'feedback.id_user = users.id_user', 'left');
        $this->db->where('feedback.rating <=', 5);
        $this->db->order_by('tanggal_feedback', 'DESC');
        $this->db->limit($limit);
        $query = $this->db->get();

        return $query->num_rows() > 0 ? $query->result() : [];
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
        $this->db->select('id_alat');
        $this->db->from('alat_pendakian');
        $this->db->where('nama_alat', $nama_alat);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row()->id_alat;
        } else {
            return null;
        }
    }

    public function check_feedback_exists_for_rental($id_penyewaan)
    {
        $this->db->select('id_feedback');
        $this->db->from('feedback');
        $this->db->where('id_penyewaan', $id_penyewaan);
        $query = $this->db->get();
        return $query->row();
    }

    public function tambah_feedback($id_user, $product_id, $id_penyewaan, $comment, $rating, $foto)
    {
        ini_set('memory_limit', '-1');
        $this->db->query("CALL tambah_feedback(?, ?, ?, ?, ?, ?)", array($id_user, $product_id, $id_penyewaan, $comment, $rating, $foto));

        return $this->db->affected_rows() > 0;
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

        return $this->db->affected_rows() > 0;
    }
}
