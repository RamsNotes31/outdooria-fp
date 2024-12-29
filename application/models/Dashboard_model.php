<?php
class Dashboard_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_total_pendapatan()
    {
        // Tabel `transactions` dengan kolom `amount`
        $this->db->select_sum('total_harga');
        $this->db->where_in('status_sewa', ['disewa', 'selesai']);
        $query = $this->db->get('penyewaan');
        return $query->row()->total_harga ?? 0; // Pastikan ada nilai default jika tidak ada data
    }


    public function get_total_admin()
    {
        // Tabel `users` dengan kolom `role` untuk menentukan admin
        $query = $this->db->get('admin');
        return $query->num_rows() ?? 0;
    }

    public function get_total_penyewaan()
    {
        // Tabel `rentals` untuk data penyewaan
        $query = $this->db->get('penyewaan');
        return $query->num_rows() ?? 0;
    }

    public function get_total_users()
    {
        // Tabel `users` untuk data pengguna
        $query = $this->db->get('users');
        return $query->num_rows() ?? 0;
    }

    public function get_total_alat()
    {
        // Tabel `equipment` untuk data alat
        $query = $this->db->get('alat_pendakian');
        return $query->num_rows() ?? 0;
    }

    public function get_total_stok()
    {
        // Tabel `equipment` untuk data alat
        $this->db->select_sum('stok');
        $query = $this->db->get('alat_pendakian');
        return $query->row()->stok ?? 0;
    }

    public function get_total_informasi()
    {
        // Tabel `information` untuk data informasi
        $query = $this->db->get('informasi_pendakian');
        return $query->num_rows() ?? 0;
    }

    public function get_total_favorit()
    {
        // Tabel `favorites` untuk data favorit
        $query = $this->db->get('favorit');
        return $query->num_rows() ?? 0;
    }

    public function get_total_feedback()
    {
        // Tabel `feedback` untuk data feedback
        $query = $this->db->get('feedback');
        return $query->num_rows() ?? 0;
    }

    // Fungsi untuk menghitung pembelian online dan offline
    public function get_perbandingan_online_offline()
    {
        // Hitung jumlah transaksi online (bukti_pembayaran tidak null)
        $this->db->where('bukti_pembayaran !=', NULL);
        $this->db->from('penyewaan');
        $online = $this->db->count_all_results();

        // Hitung jumlah transaksi offline (bukti_pembayaran null)
        $this->db->where('bukti_pembayaran', NULL);
        $this->db->from('penyewaan');
        $offline = $this->db->count_all_results();

        // Total transaksi
        $total = $online + $offline;

        // Menghitung persentase online dan offline
        $online_percentage = ($total > 0) ? round(($online / $total) * 100, 2) : 0;
        $offline_percentage = ($total > 0) ? round(($offline / $total) * 100, 2) : 0;

        // Mengembalikan hasil dalam array
        return [
            'online' => $online,
            'offline' => $offline,
            'online_percentage' => $online_percentage,
            'offline_percentage' => $offline_percentage,
            'total' => $total
        ];
    }

    // Get the most popular tools based on rental frequency
    public function get_alat_terlaris()
    {
        $this->db->select('alat_pendakian.nama_alat, COUNT(penyewaan.seri_alat) as total_rented');
        $this->db->from('penyewaan');
        $this->db->join('seri', 'penyewaan.seri_alat = seri.seri_alat');
        $this->db->join('alat_pendakian', 'seri.id_alat = alat_pendakian.id_alat');
        $this->db->group_by('alat_pendakian.id_alat');
        $this->db->order_by('total_rented', 'DESC');
        $this->db->limit(1);
        $result = $this->db->get()->result();
        if (empty($result)) {
            return [
                'nama_alat' => '-',
                'total_rented' => 0
            ];
        }
        return $result;
    }

    // Get the highest-rated tools based on feedback
    public function get_rating_tertinggi()
    {
        $this->db->select('alat_pendakian.nama_alat, AVG(feedback.rating) as average_rating');
        $this->db->from('feedback');
        $this->db->join('alat_pendakian', 'feedback.id_alat = alat_pendakian.id_alat');
        $this->db->group_by('alat_pendakian.id_alat');
        $this->db->order_by('average_rating', 'DESC');
        $this->db->limit(1);
        $result = $this->db->get()->result();
        if (empty($result)) {
            return [
                'nama_alat' => '-',
                'average_rating' => 0
            ];
        }
        return $result;
    }

    // Get the top 5 favorite tools based on user preferences
    public function get_top_favorit()
    {
        $this->db->select('alat_pendakian.nama_alat, COUNT(favorit.id_favorit) as total_favorites');
        $this->db->from('favorit');
        $this->db->join('alat_pendakian', 'favorit.id_alat = alat_pendakian.id_alat');
        $this->db->group_by('alat_pendakian.id_alat');
        $this->db->order_by('total_favorites', 'DESC');
        $this->db->limit(1);
        $result = $this->db->get()->result();
        if (empty($result)) {
            return [
                'nama_alat' => '-',
                'total_favorites' => 0
            ];
        }
        return $result;
    }

    // Get the top 5 admins with the most recent interactions
    public function get_top_admin()
    {
        $this->db->select('admin.nama_admin, COUNT(informasi_pendakian.id_admin) as total_posts');
        $this->db->from('informasi_pendakian');
        $this->db->join('admin', 'informasi_pendakian.id_admin = admin.id_admin');
        $this->db->group_by('admin.id_admin');
        $this->db->order_by('total_posts', 'DESC');
        $this->db->limit(1); // Limit to top admin
        $result = $this->db->get()->result();

        if (empty($result)) {
            return [
                'nama_admin' => '-',
                'total_posts' => 0
            ];
        }
        return $result;
    }



    // Get the top 5 users with the most rental transactions
    public function get_top_user()
    {
        $this->db->select('users.nama, COUNT(penyewaan.id_penyewaan) as total_rentals');
        $this->db->from('penyewaan');
        $this->db->join('users', 'penyewaan.id_user = users.id_user');
        $this->db->group_by('users.nama');
        $this->db->order_by('total_rentals', 'DESC');
        $this->db->limit(1);
        $result = $this->db->get()->result();
        if (empty($result)) {
            return [
                'nama' => '-',
                'total_rentals' => 0
            ];
        }
        return $result;
    }

    // Get the items with the most stock
    public function get_stok_terbanyak()
    {
        $this->db->select('alat_pendakian.nama_alat, alat_pendakian.stok');
        $this->db->from('alat_pendakian');
        $this->db->order_by('alat_pendakian.stok', 'DESC');
        $this->db->limit(1);
        $result = $this->db->get()->result();
        if (empty($result)) {
            return [
                'nama_alat' => '-',
                'stok' => 0
            ];
        }
        return $result;
    }

    public function get_rentals_pending()
    {
        $this->db->select('penyewaan.*, users.nama as nama_user, alat_pendakian.nama_alat');
        $this->db->from('penyewaan');
        $this->db->join('users', 'penyewaan.id_user = users.id_user');
        $this->db->join('seri', 'penyewaan.seri_alat = seri.seri_alat AND seri.status_produk = "menunggu"');
        $this->db->join('alat_pendakian', 'seri.id_alat = alat_pendakian.id_alat');
        $this->db->where('penyewaan.status_sewa', 'menunggu');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_rentals_sewa()
    {
        $this->db->select('penyewaan.*, users.nama as nama_user, alat_pendakian.nama_alat');
        $this->db->from('penyewaan');
        $this->db->join('users', 'penyewaan.id_user = users.id_user');
        $this->db->join('seri', 'penyewaan.seri_alat = seri.seri_alat AND seri.status_produk = "disewa"');
        $this->db->join('alat_pendakian', 'seri.id_alat = alat_pendakian.id_alat');
        $this->db->where('penyewaan.status_sewa', 'disewa');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function update_status($rental_id, $status)
    {
        // Validate inputs (optional but recommended)


        // Update the rental status in the 'penyewaan' table
        $this->db->where('id_penyewaan', $rental_id);
        $this->db->update('penyewaan', ['status_sewa' => $status]);

        // Return true if one row was affected (status updated)
        return $this->db->affected_rows() > 0;
    }

    public function get_total_penyewaannya()
    {
        return $this->db->count_all('penyewaan');
    }

    public function get_status_count($status)
    {
        $this->db->where('status_sewa', $status);
        return $this->db->count_all_results('penyewaan');
    }

    // Mengambil total stok
    public function get_total_stoks()
    {
        $this->db->select('COUNT(*) as total');
        $this->db->from('seri');
        $query = $this->db->get();
        return $query->row()->total;
    }

    // Mengambil jumlah stok berdasarkan status
    public function get_stok_by_status($status)
    {
        $this->db->select('COUNT(*) as total');
        $this->db->from('seri');
        $this->db->where('status_produk', $status);
        $query = $this->db->get();
        return $query->row()->total;
    }


    public function get_status_counts($kondisi)
    {
        $this->db->select('COUNT(*) as total');
        $this->db->from('seri');
        $this->db->where('kondisi', $kondisi);
        $query = $this->db->get();
        return $query->row()->total;
    }

    public function get_kategori_counts()
    {
        // Mengambil kategori alat dari tabel alat_pendakian
        $this->db->select('kategori, COUNT(*) as total');
        $this->db->from('alat_pendakian'); // Mengambil data dari tabel seri
        $this->db->group_by('kategori'); // Mengelompokkan berdasarkan kategori
        $query = $this->db->get();
        return $query->result(); // Mengembalikan data hasil query
    }

    public function get_all_bukti_pembayaran()
    {
        $this->db->select('view_bukti_pembayaran.*');
        $this->db->from('view_bukti_pembayaran');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_all_chat_img()
    {
        $this->db->select('view_foto_chat.*');
        $this->db->from('view_foto_chat');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_user_statistics()
    {
        $query = $this->db->query("
            SELECT 
                COUNT(*) AS total_users,
                SUM(jenis_kelamin = 'L') AS total_male,
                SUM(jenis_kelamin = 'P') AS total_female,
                SUM(jenis_kelamin = 'O') AS total_other,
                ROUND((SUM(jenis_kelamin = 'L') / COUNT(*)) * 100, 2) AS male_percentage,
                ROUND((SUM(jenis_kelamin = 'P') / COUNT(*)) * 100, 2) AS female_percentage,
                ROUND((SUM(jenis_kelamin = 'O') / COUNT(*)) * 100, 2) AS other_percentage
            FROM users
        ");
        return $query->row_array(); // Kembalikan data sebagai array
    }

    public function get_admin_statistics()
    {
        $query = $this->db->query("
            SELECT 
                COUNT(*) AS total_admins,
                SUM(jenis_kelamin = 'L') AS total_male,
                SUM(jenis_kelamin = 'P') AS total_female,
                SUM(jenis_kelamin = 'O') AS total_other,
                ROUND((SUM(jenis_kelamin = 'L') / COUNT(*)) * 100, 2) AS male_percentage,
                ROUND((SUM(jenis_kelamin = 'P') / COUNT(*)) * 100, 2) AS female_percentage,
                ROUND((SUM(jenis_kelamin = 'O') / COUNT(*)) * 100, 2) AS other_percentage
            FROM admin
        ");
        return $query->row_array(); // Kembalikan data sebagai array
    }

    // Get top admin who has replied the most
    public function get_top_admin_chat()
    {
        $this->db->select('a.nama_admin, COUNT(p.id_chat) AS total_replies');
        $this->db->from('chat p');
        $this->db->join('admin a', 'p.id_admin = a.id_admin');
        $this->db->group_by('p.id_admin');
        $this->db->order_by('total_replies', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row_array();  // Return the first result (top admin)
    }

    // Get top user who has the most feedback and highest average rating
    public function get_top_user_feedback()
    {
        $this->db->select('u.nama AS user_name, COUNT(f.id_feedback) AS total_feedback, AVG(f.rating) AS average_rating');
        $this->db->from('feedback f');
        $this->db->join('users u', 'f.id_user = u.id_user');
        $this->db->group_by('f.id_user');
        $this->db->order_by('total_feedback', 'DESC');
        $this->db->order_by('average_rating', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row_array();  // Return the first result (top user)
    }

    // Get top admin who posted the most information
    public function get_top_admin_posting()
    {
        $this->db->select('a.nama_admin, COUNT(ip.id_informasi) AS total_posting');
        $this->db->from('informasi_pendakian ip');
        $this->db->join('admin a', 'ip.id_admin = a.id_admin');
        $this->db->group_by('ip.id_admin');
        $this->db->order_by('total_posting', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row_array();  // Return the first result (top admin)
    }

    // Get top user who rented the most items and the most rented item
    public function get_top_user_rented_item()
    {
        $this->db->select('users.nama AS nama_user, alat_pendakian.nama_alat, COUNT(penyewaan.id_penyewaan) AS jumlah_disewa');
        $this->db->from('penyewaan');
        $this->db->join('users', 'penyewaan.id_user = users.id_user');
        $this->db->join('seri', 'penyewaan.seri_alat = seri.seri_alat');
        $this->db->join('alat_pendakian', 'seri.id_alat = alat_pendakian.id_alat');
        $this->db->group_by('users.id_user, alat_pendakian.id_alat');
        $this->db->order_by('jumlah_disewa', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row_array();  // Return the first result (top user and rented item)
    }

    // Mendapatkan total pendapatan berdasarkan bulan dan tahun saat ini
    public function get_pendapatan_bulanan_bulan_ini()
    {
        $this->db->select_sum('total_harga');
        $this->db->from('penyewaan');
        $this->db->where_in('status_sewa', ['disewa', 'selesai']);
        $this->db->where('YEAR(tanggal_penyewaan)', date('Y'));  // Filter berdasarkan tahun saat ini
        $this->db->where('MONTH(tanggal_penyewaan)', date('m'));  // Filter berdasarkan bulan saat ini
        $query = $this->db->get();
        return $query->row()->total_harga;  // Mengambil hasil total pendapatan
    }

    // Mendapatkan pendapatan bulanan berdasarkan bulan dan tahun saat ini
}
