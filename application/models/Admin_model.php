<?php
class Admin_model extends CI_Model
{
    public function get_name_by_id($id)
    {
        $this->db->where('id_user', $id);
        $result = $this->db->get('users')->row();
        return $result ? $result->nama : null;
    }

    public function get_alat_by_id($id)
    {
        $this->db->where('id_alat', $id);
        $result = $this->db->get('alat_pendakian')->row();
        return $result ? $result->nama_alat : null;
    }

    public function get_all_alat_pendakian()
    {
        $result = $this->db->get('alat_pendakian')->result();
        return $result;
    }

    public function get_all_favorites()
    {
        $this->db->select('favorit.id_favorit, users.nama AS nama_user, alat_pendakian.nama_alat, favorit.tanggal_ditambahkan');
        $this->db->from('favorit');
        $this->db->join('users', 'users.id_user = favorit.id_user', 'left');
        $this->db->join('alat_pendakian', 'alat_pendakian.id_alat = favorit.id_alat', 'left');
        $this->db->order_by('favorit.tanggal_ditambahkan', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_all_feedbacks()
    {
        $this->db->select('feedback.*, users.nama AS nama_user, alat_pendakian.nama_alat, penyewaan.id_penyewaan');
        $this->db->from('feedback');
        $this->db->join('penyewaan', 'feedback.id_penyewaan = penyewaan.id_penyewaan', 'left');
        $this->db->join('users', 'users.id_user = feedback.id_user', 'left');
        $this->db->join('alat_pendakian', 'alat_pendakian.id_alat = feedback.id_alat', 'left');
        $this->db->order_by('feedback.tanggal_feedback', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_all_users()
    {
        $this->db->select('users.*');
        $this->db->from('users');
        $this->db->order_by('users.id_user', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_all_admins()
    {
        $this->db->select('admin.*');
        $this->db->from('admin');
        $this->db->order_by('admin.id_admin', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_all_rentals()
    {
        $this->db->select('penyewaan.*, users.nama as nama_user, alat_pendakian.nama_alat');
        $this->db->from('penyewaan');
        $this->db->join('users', 'penyewaan.id_user = users.id_user');
        $this->db->join('seri', 'penyewaan.seri_alat = seri.seri_alat');
        $this->db->join('alat_pendakian', 'seri.id_alat = alat_pendakian.id_alat');
        $this->db->order_by('penyewaan.id_penyewaan', 'DESC');
        $query = $this->db->get();
        return $query->result(); // Mengembalikan sebagai objek
    }

    public function tambah_admin($data)
    {
        $this->db->query(
            "CALL tambah_admin(?, ?, ?, ?, ?, ?)",
            array(
                $data['nama_admin'],
                $data['email_admin'],
                $data['no_telp_admin'],
                $data['password_admin'],
                $data['jenis_kelamin'],
                $data['foto_admin']
            )
        );

        // Periksa apakah query berhasil
        return $this->db->affected_rows() > 0;
    }

    public function get_admin_by_nama($nama)
    {
        $this->db->where('nama_admin', $nama);
        $result = $this->db->get('admin')->row();
        return $result ? $result->id_admin : null;
    }


    public function get_admin_by_id($id)
    {
        $this->db->where('id_admin', $id);
        $result = $this->db->get('admin')->row();
        return $result;
    }

    public function delete_admin_by_session_name()
    {
        // Get the session 'nama'
        $nama = $this->session->userdata('nama_admin');

        if (empty($nama)) {
            return false; // No session 'nama', cannot proceed
        }

        // Fetch the user's profile photo filename from the database
        $this->db->select('foto_admin');
        $this->db->where('nama_admin', $nama);
        $query = $this->db->get('admin');
        $foto_admin = $query->row()->foto_admin ?? null;

        if ($foto_admin && $foto_admin !== 'default.png') {
            // Construct the file path
            $file_path = './public/img/admin/' . $foto_admin;

            // Attempt to delete the file if it exists
            if (file_exists($file_path)) {
                unlink($file_path);
            }
        }

        // Disable foreign key checks temporarily
        $this->db->query('SET FOREIGN_KEY_CHECKS = 0');

        // Perform the deletion
        $this->db->where('nama_admin', $nama);
        $result = $this->db->delete('admin');

        // Re-enable foreign key checks
        $this->db->query('SET FOREIGN_KEY_CHECKS = 1');

        return $result; // Return deletion status
    }

    public function update_user($id_admin, $data)
    {
        $this->db->where('id_admin', $id_admin);
        $this->db->update('admin', $data);
    }

    public function delete_foto_by_session_name()
    {
        $nama = $this->session->userdata('nama_admin');

        if (empty($nama)) {
            return false; // No session 'nama', cannot proceed
        }

        // Fetch the user's profile photo filename from the database
        $this->db->select('foto_admin');
        $this->db->where('nama_admin', $nama);
        $query = $this->db->get('admin');
        $foto_admin = $query->row()->foto_admin ?? null;



        // Update the foto_admin to default.png
        $this->db->set('foto_admin', 'default.png');
        $this->db->where('nama_admin', $nama);
        $result = $this->db->update('admin');

        return $result; // Return deletion status
    }
}
