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
        return $query->result();
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
        $nama = $this->session->userdata('nama_admin');

        if (empty($nama)) {
            return false;
        }

        $this->db->select('foto_admin');
        $this->db->where('nama_admin', $nama);
        $query = $this->db->get('admin');
        $foto_admin = $query->row()->foto_admin ?? null;

        if ($foto_admin && $foto_admin !== 'default.png') {
            $file_path = './public/img/admin/' . $foto_admin;

            if (file_exists($file_path)) {
                unlink($file_path);
            }
        }

        $this->db->query('SET FOREIGN_KEY_CHECKS = 0');

        $this->db->where('nama_admin', $nama);
        $result = $this->db->delete('admin');

        $this->db->query('SET FOREIGN_KEY_CHECKS = 1');

        return $result;
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
            return false;
        }

        $this->db->select('foto_admin');
        $this->db->where('nama_admin', $nama);
        $query = $this->db->get('admin');
        $foto_admin = $query->row()->foto_admin ?? null;



        $this->db->set('foto_admin', 'default.png');
        $this->db->where('nama_admin', $nama);
        $result = $this->db->update('admin');

        return $result;
    }

    public function get_all_seri()
    {
        $this->db->select('seri.*, alat_pendakian.nama_alat');
        $this->db->from('seri');
        $this->db->join('alat_pendakian', 'seri.id_alat = alat_pendakian.id_alat');
        $this->db->order_by('seri.seri_alat', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }


    public function seri_alat_hapus($seri_alat)
    {
        $this->db->query('SET FOREIGN_KEY_CHECKS = 0');

        $this->db->where('seri_alat', $seri_alat);
        $this->db->delete('seri');


        $this->db->query('SET FOREIGN_KEY_CHECKS = 1');

        return true;
    }

    public function get_id_alat($seri_alat)
    {
        $this->db->select('id_alat');
        $this->db->from('seri');
        $this->db->where('seri_alat', $seri_alat);
        $query = $this->db->get();
        return $query->row()->id_alat ?? null;
    }





    public function get_enum_kondisi()
    {
        return [
            '2' => 'Baik',
            '3' => 'Minus',
            '1' => 'Baru'
        ];
    }

    public function get_enum_status()
    {
        return [
            '1' => 'tersedia',
            '3' => 'dalam perawatan',
            '4' => 'Rusak'
        ];
    }

    public function get_status_excluding_waiting()
    {
        $status = $this->get_enum_status();
        unset($status['0']);
        return $status;
    }

    public function update_seri($id, $data)
    {
        $this->db->where('seri_alat', $id);
        return $this->db->update('seri', $data);
    }

    public function get_nama_alat($id_alat)
    {
        $this->db->select('nama_alat');
        $this->db->from('alat_pendakian');
        $this->db->where('id_alat', $id_alat);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function getNamaAlat()
    {
        $this->db->select('id_alat, nama_alat');
        $query = $this->db->get('alat_pendakian');
        return $query->result();
    }

    public function callProcedureTambahSeri($p_id_alat, $p_kondisi, $p_status_produk)
    {
        $query = "CALL tambah_seri(?, ?, ?)";
        return $this->db->query($query, [$p_id_alat, $p_kondisi, $p_status_produk]);
    }

    public function get_id_produk($nama)
    {
        $this->db->select('id_alat');
        $this->db->from('alat_pendakian');
        $this->db->where('nama_alat', $nama);
        $query = $this->db->get();
        return $query->row()->id_alat ?? null;
    }

    public function getDistinctUsers()
    {
        $this->db->select('chat.id_user, users.nama');
        $this->db->from('chat');
        $this->db->join('users', 'chat.id_user = users.id_user');
        $this->db->distinct();
        return $this->db->get()->result_array();
    }

    public function getallinformasi()
    {
        $this->db->select('*');
        $this->db->from('informasi_pendakian');
        $query = $this->db->get();
        return $query->result();
    }

    public function getallalat()
    {
        $this->db->select('*');
        $this->db->from('alat_pendakian');
        $query = $this->db->get();
        return $query->result();
    }

    public function hapus_alat($id)
    {
        $this->db->query('SET FOREIGN_KEY_CHECKS = 0');
        $this->db->where('id_alat', $id);
        $this->db->delete('alat_pendakian');

        $this->db->where('id_alat', $id);
        $this->db->delete('seri');

        $this->db->query('SET FOREIGN_KEY_CHECKS = 1');

        return true;
    }

    public function hapus_informasi($id_informasi)
    {
        $this->db->where('id_informasi', $id_informasi);
        return $this->db->delete('informasi_pendakian');
    }


    public function tambah_informasi($data)
    {
        $result = $this->db->query("CALL tambah_informasi_pendakian(?, ?, ?, ?, ?, ?)", [
            $data['id_admin'],
            $data['nama_gunung'],
            $data['lokasi'],
            $data['harga_biaya'],
            $data['deskripsi'],
            $data['foto_gunung']
        ]);

        return $result;
    }

    public function delete_foto_info($id_informasi)
    {
        $nama = $this->session->userdata('nama_admin');

        if (empty($nama)) {
            return false;
        }


        $this->db->select('foto_gunung');
        $this->db->where('id_informasi', $id_informasi);
        $query = $this->db->get('informasi_pendakian');
        $foto_gunung = $query->row()->foto_gunung ?? null;


        $this->db->set('foto_gunung', 'default.jpg');
        $this->db->where('id_informasi', $id_informasi);
        $result = $this->db->update('informasi_pendakian');

        return $result;
    }




    public function update_informasi($id, $data)
    {
        $this->db->where('id_informasi', $id);
        return $this->db->update('informasi_pendakian', $data);
    }

    public function get_informasi_by_id($id_informasi)
    {
        $query = $this->db->get_where('informasi_pendakian', ['id_informasi' => $id_informasi]);
        return $query->row_array();
    }

    public function get_id_admin($nama_admin)
    {
        $query = $this->db->get_where('admin', ['nama_admin' => $nama_admin]);
        $row = $query->row_array();
        return $row ? $row['id_admin'] : null;
    }


    public function getKategoriOptions()
    {
        $query = $this->db->query("SHOW COLUMNS FROM alat_pendakian LIKE 'kategori'");
        $row = $query->row_array();
        preg_match("/^enum\((.*)\)$/", $row['Type'], $matches);
        $enum = str_getcsv($matches[1], ',', "'");
        return $enum;
    }

    public function insertAlatWithProcedure($data)
    {
        $query = "CALL tambah_alat_pendakian(?, ?, ?, ?, ?, ?)";
        $this->db->query($query, [
            $data['nama'],
            $data['kategori'],
            $data['stok'],
            $data['harga_sewa'],
            $data['foto'],
            $data['deskripsi']
        ]);
    }

    public function get_alats_by_id($id)
    {
        $query = $this->db->get_where('alat_pendakian', ['id_alat' => $id]);
        return $query->row_array();
    }

    public function delete_foto_produk($id)
    {
        $nama = $this->session->userdata('nama_admin');

        if (empty($nama)) {
            return false;
        }

        $this->db->select('foto_produk');
        $this->db->where('id_alat', $id);
        $query = $this->db->get('alat_pendakian');
        $foto_produk = $query->row()->foto_produk ?? null;


        $this->db->set('foto_produk', 'default.jpg');
        $this->db->where('id_alat', $id);
        $result = $this->db->update('alat_pendakian');

        return $result;
    }

    public function getAlatById($id)
    {
        return $this->db->get_where('alat_pendakian', ['id_alat' => $id])->row_array();
    }

    public function updateAlat($id, $data)
    {
        $this->db->where('id_alat', $id);
        return $this->db->update('alat_pendakian', $data);
    }

    public function deleteOldPhoto($filename)
    {
        $file_path = './public/img/produk/' . $filename;
        if ($filename !== 'default.jpg' && file_exists($file_path)) {
            unlink($file_path);
        }
    }
}
