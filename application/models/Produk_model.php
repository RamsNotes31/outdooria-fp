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
            alat_pendakian.kategori,
            alat_pendakian.harga_sewa,
            alat_pendakian.stok,
            COALESCE(AVG(feedback.rating), 0) AS rata_rata_rating
        ');
        $this->db->from('alat_pendakian');
        $this->db->join('feedback', 'feedback.id_alat = alat_pendakian.id_alat', 'left'); // Left join untuk tetap menampilkan produk tanpa feedback
        $this->db->group_by('alat_pendakian.id_alat'); // Kelompokkan berdasarkan ID alat
        $this->db->order_by('RAND()'); // Acak produk
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
            alat_pendakian.kategori,
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
            alat_pendakian.kategori,
        alat_pendakian.stok,
        alat_pendakian.deskripsi,
        COALESCE(AVG(feedback.rating), 0) AS rata_rata_rating
    ');
        $this->db->from('alat_pendakian');
        $this->db->join('feedback', 'feedback.id_alat = alat_pendakian.id_alat', 'left');
        $this->db->where_not_in('alat_pendakian.id_alat', $this->uri->segment(3)); // Filter tidak termasuk id alat yang sedang diakses
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

    public function get_all_kategori()
    {
        $this->db->distinct();
        $this->db->select('kategori'); // Ambil hanya kolom alat_pendakian
        $this->db->from('alat_pendakian'); // Nama tabel Anda
        return $this->db->get()->result();
    }

    // Mendapatkan data produk dengan data tambahan untuk sorting
    public function get_produk_with_criteria($kategori, $search, $sort)
    {
        $this->db->select('
            alat_pendakian.id_alat,
            alat_pendakian.nama_alat,
            alat_pendakian.harga_sewa,
            alat_pendakian.kategori,
            alat_pendakian.stok,
            alat_pendakian.foto_produk,
            favorit_count.favorit_count,
            popularity_count.popularity_count,
            feedback.rata_rata_rating
        ');
        $this->db->from('alat_pendakian');

        // Subquery untuk favorit
        $this->db->join(
            '
            (SELECT id_alat, COUNT(*) AS favorit_count
             FROM favorit
             GROUP BY id_alat
            ) favorit_count',
            'favorit_count.id_alat = alat_pendakian.id_alat',
            'left'
        );

        // Subquery untuk popularitas (penyewaan)
        $this->db->join(
            '
            (SELECT seri.id_alat, COUNT(*) AS popularity_count
             FROM penyewaan
             JOIN seri ON penyewaan.seri_alat = seri.seri_alat
             GROUP BY seri.id_alat
            ) popularity_count',
            'popularity_count.id_alat = alat_pendakian.id_alat',
            'left'
        );

        // Subquery untuk rating
        $this->db->join(
            '
            (SELECT id_alat, AVG(rating) AS rata_rata_rating
             FROM feedback
             GROUP BY id_alat
            ) feedback',
            'feedback.id_alat = alat_pendakian.id_alat',
            'left'
        );

        // Filter berdasarkan kategori
        if (!empty($kategori) && $kategori !== '0') {
            $this->db->where('alat_pendakian.kategori', $kategori);
        }

        // Filter berdasarkan pencarian
        if (!empty($search)) {
            $this->db->like('alat_pendakian.nama_alat', $search);
        }

        // Sorting berdasarkan pilihan
        if ($sort) {
            if ($sort == '1') { // Harga naik
                $this->db->order_by('alat_pendakian.harga_sewa', 'ASC');
            } elseif ($sort == '2') { // Harga turun
                $this->db->order_by('alat_pendakian.harga_sewa', 'DESC');
            } elseif ($sort == '3') { // Popularitas
                $this->db->order_by('popularity_count', 'DESC');
            } elseif ($sort == '4') { // Rating
                $this->db->order_by('rata_rata_rating', 'DESC');
            } elseif ($sort == '5') { // Favorit
                $this->db->order_by('favorit_count', 'DESC');
            } else { // Acak
                $this->db->order_by('rand()');
            }
        } else {
            $this->db->order_by('rand()');
        }

        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_all_foto_alat()
    {
        $this->db->select('view_foto_alat.*');
        $this->db->from('view_foto_alat');
        $query = $this->db->get();
        return $query->result_array();
    }



    public function tambah_favorit($id_user, $id_alat)
    {
        $this->db->select('id_user, id_alat'); // Pastikan kolom sesuai dengan database
        $this->db->from('favorit'); // Ganti 'favorit' dengan nama tabel favorit Anda
        $this->db->where('id_user', $id_user);
        $this->db->where('id_alat', $id_alat);
        $query = $this->db->get();
        if ($query->num_rows() > 0) { // Jika data ada
            $this->db->where('id_user', $id_user);
            $this->db->where('id_alat', $id_alat);
            $this->db->delete('favorit');
        } else { // Jika data tidak ada
            $this->db->query("CALL tambah_favorit(?, ?)", array($id_user, $id_alat));
        }
    }

    public function get_favorit_by_user($id_user)
    {
        $this->db->select('id_alat'); // Pilih kolom id_alat
        $this->db->from('favorit'); // Tabel favorit
        $this->db->where('id_user', $id_user); // Kondisi berdasarkan id_user
        $query = $this->db->get();

        return $query->result_array(); // Kembalikan daftar alat favorit
    }


    public function tambah_feedback($id_user, $id_alat, $komentar, $rating)
    {
        // Panggil stored procedure menggunakan CALL
        $this->db->query("CALL tambah_feedback(?, ?, ?, ?)", array($id_user, $id_alat, $komentar, $rating));

        // Periksa apakah query berhasil
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    // Metode untuk mendapatkan ID alat berdasarkan nama alat
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

    public function get_id_by_name($nama)
    {
        $this->db->select('id_user');
        $this->db->from('users');
        $this->db->where('nama', $nama);
        $query = $this->db->get();

        return $query->num_rows() > 0 ? $query->row()->id_user : null;
    }

    public function get_price($seri_alat)
    {
        $this->db->select('harga_sewa');
        $this->db->from('alat_pendakian');
        $this->db->join('seri', 'alat_pendakian.id_alat = seri.id_alat');
        $this->db->where('seri.seri_alat', $seri_alat);
        $query = $this->db->get();

        return $query->num_rows() > 0 ? $query->row()->harga_sewa : 0;
    }

    public function add_rental($id_user, $seri_alat, $tanggal_pemesanan, $tanggal_pengembalian, $total_harga)
    {
        $query = $this->db->query(
            "CALL tambah_penyewaan(?, ?, ?, ?, ?)",
            [$id_user, $seri_alat, $tanggal_pemesanan, $tanggal_pengembalian, $total_harga]
        );

        return $this->db->affected_rows() > 0;
    }
}
