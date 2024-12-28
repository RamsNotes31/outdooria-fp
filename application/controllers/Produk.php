<?php
defined('BASEPATH') or
    header("Location: error");



class Produk extends CI_Controller

{

    public function __construct()
    {
        parent::__construct();
        // $this->load->model('Produk_model');
        $this->load->library('session');
        $this->load->model('Produk_model');
    }
    public function index()
    {
        $this->load->library('session');

        $data['title'] = 'Hikyu | Rental';
        $this->load->model('Produk_model');

        // Ambil parameter dari form
        $kategori = $this->input->post('kategori');
        $search = $this->input->post('search');
        $sort = $this->input->post('sort');

        // Ambil data alat pendakian (kategori)
        $data['alat_pendakian'] = $this->Produk_model->get_all_kategori();

        // Ambil produk berdasarkan filter
        $data['produks'] = $this->Produk_model->get_produk_with_criteria($kategori, $search, $sort);

        if (empty($data['produks'])) {
            log_message('error', 'No produk data available for view.');
        }
        $data['img_alat'] = $this->Produk_model->get_all_foto_alat();

        $nama = $this->session->userdata('nama');
        $id_user = $this->Produk_model->get_id_by_name($nama);
        $favorit = $this->Produk_model->get_favorit_by_user($id_user); // Ambil daftar favorit user
        $data['favorit'] = array_column($favorit, 'id_alat'); // Ambil hanya ID alat dari daftar favorit

        $this->load->view('templates/header', $data);
        $this->load->view('pages/rental/rental', $data); // Kirim data ke view
        $this->load->view('templates/footer');
    }


    // Menampilkan detail produk berdasarkan id_produk
    public function detail($product_id = null)
    {
        $this->load->library('session');
        if (is_null($product_id)) {
            redirect('../produk');
            return;
        }

        $this->load->model('Produk_model');
        $data['title'] = 'Hikyu | Produk Detail';
        $this->load->view('templates/header', $data);
        $data['product'] = $this->Produk_model->get_product_details($product_id);
        $data['series'] = $this->Produk_model->get_available_series($product_id);
        $data['products'] = $this->Produk_model->get_random_products(4);
        $data['reviews'] = $this->Produk_model->get_reviews_by_product($product_id);

        $nama = $this->session->userdata('nama');
        $id_user = $this->Produk_model->get_id_by_name($nama);
        $favorit = $this->Produk_model->get_favorit_by_user($id_user); // Ambil daftar favorit user
        $data['favorit'] = array_column($favorit, 'id_alat'); // Ambil hanya ID alat dari daftar favorit

        // Ambil data dari model
        $data['s'] = $this->Produk_model->get_total_feedback_by_alat($product_id);

        // Contoh: Hitung rata-rata rating untuk produk (dummy value, sesuaikan dengan logika Anda)
        $data['product']['rata_rata_rating'] = $this->Produk_model->get_average_rating_by_alat($product_id) ?? 0;
        $data['d'] = $this->Produk_model->join_popularity_count($product_id);
        $data['t'] = $this->Produk_model->join_favorit_count($product_id);

        $this->load->view('pages/rental/detail', $data);
        $this->load->view('templates/footer');
    }

    public function wishlist($product_id = null)
    {
        $this->load->library('session');

        $nama = $this->session->userdata('nama'); // Ambil nama dari session


        $role = $this->session->userdata('role');

        // Validasi apakah user sudah login

        // Validasi role admin
        if ($role === 'admin') {
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            if (!$nama) {
                // Jika user tidak login, arahkan ke halaman login
                redirect('../login');
            }
        }

        if ($product_id === null) {
            // Jika product_id tidak valid, arahkan kembali dengan pesan error
            $this->session->set_flashdata('error', 'Produk tidak valid.');
            redirect('../produk');
        }

        // Ambil ID User dari database berdasarkan nama
        $this->load->model('Produk_model'); // Pastikan model User_model sudah dibuat
        $id_user = $this->Produk_model->get_id_by_name($nama);

        if (!$id_user) {
            // Jika tidak ditemukan, redirect dengan pesan error
            $this->session->set_flashdata('error', 'User tidak ditemukan.');
            redirect('../produk');
        }

        // Panggil model untuk menambahkan favorit
        $this->load->model('Produk_model');
        $this->Produk_model->tambah_favorit($id_user, $product_id);

        // Redirect kembali ke halaman sebelumnya dengan pesan sukses
        $this->session->set_flashdata('success', 'Produk berhasil ditambahkan ke favorit.');
        redirect($_SERVER['HTTP_REFERER']);
    }

    // public function give_feedback($id_alat)
    // {
    //     // Cek apakah user sudah login
    //     if (!$this->session->userdata('nama')) {
    //         redirect('../login'); // Redirect ke login jika belum login
    //     }

    //     // Ambil ID user dari session
    //     $nama_user = $this->session->userdata('nama');
    //     $id_user = $this->Akun_model->get_id_by_name($nama_user);

    //     if (!$id_user) {
    //         redirect('../akun'); // Redirect jika user tidak ditemukan
    //     }

    //     // Cek apakah user pernah menyewa alat ini dengan status selesai
    //     $rentals = $this->Feedback_model->check_user_rental_status($id_user, $id_alat);
    //     if (empty($rentals)) {
    //         $this->session->set_flashdata('error', 'Anda harus menyewa alat ini terlebih dahulu dan menyelesaikan penyewaan untuk memberikan feedback.');
    //         redirect('../home');
    //     }

    //     // Filter penyewaan yang belum diberikan feedback
    //     $valid_rentals = [];
    //     foreach ($rentals as $rental) {
    //         if (!$this->Feedback_model->check_feedback_exists_for_rental($rental->id_penyewaan)) {
    //             $valid_rentals[] = $rental->id_penyewaan;
    //         }
    //     }

    //     if (empty($valid_rentals)) {
    //         $this->session->set_flashdata('error', 'Anda sudah memberikan feedback untuk semua penyewaan alat ini.');
    //         redirect('../home');
    //     }

    //     // Tampilkan form feedback untuk penyewaan terakhir yang valid
    //     $data['title'] = 'Berikan Feedback';
    //     $data['id_alat'] = $id_alat;
    //     $data['id_penyewaan'] = $valid_rentals[0]; // Ambil penyewaan pertama yang valid
    //     $this->load->view('templates/header', $data);
    //     redirect('../produk/detail/' . $id_alat);
    //     $this->load->view('templates/footer', $data);
    // }

    // public function review()
    // {
    //     // Load session library
    //     $this->load->library('session');

    //     // Ambil nama user dari session
    //     $nama_user = $this->session->userdata('nama');
    //     $role = $this->session->userdata('role');

    //     // Validasi apakah user sudah login


    //     // Validasi role admin
    //     if ($role === 'admin') {
    //         redirect($_SERVER['HTTP_REFERER']);
    //     } else {
    //         if (empty($nama_user)) {
    //             $this->session->set_flashdata('error', 'Anda harus login untuk memberikan review.');
    //             redirect('../login');
    //         }
    //     }


    //     // Ambil ID user berdasarkan nama
    //     $id_user = $this->Produk_model->get_id_by_name($nama_user);

    //     // Validasi jika user tidak ditemukan
    //     if (!$id_user) {
    //         $this->session->set_flashdata('error', 'Gagal menemukan ID pengguna.');
    //         redirect('../login');
    //     }

    //     $nama_alat = $this->input->post('nama_alat');
    //     // Ambil ID alat berdasarkan nama produk
    //     $product_id = $this->Produk_model->get_id_by_product($nama_alat);

    //     // Validasi apakah ID alat ditemukan
    //     if (is_null($product_id)) {
    //         $this->session->set_flashdata('error', 'Produk yang Anda review tidak valid.');
    //         redirect('../produk');
    //     }

    //     // Ambil data dari form
    //     $rating = $this->input->post('rating');
    //     $comment = $this->input->post('comment');

    //     // Validasi input
    //     if (empty($rating) || empty($comment) || empty($product_id) || empty($id_user)) {
    //         $this->session->set_flashdata('error', 'Semua field wajib diisi.');
    //         redirect($_SERVER['HTTP_REFERER']);
    //     }

    //     // Simpan data ke database menggunakan model
    //     $is_inserted = $this->Produk_model->tambah_feedback($id_user, $product_id, $comment, $rating);

    //     // Berikan feedback kepada user
    //     if ($is_inserted) {
    //         $this->session->set_flashdata('success', 'Review berhasil ditambahkan.');
    //     } else {
    //         $this->session->set_flashdata('error', 'Terjadi kesalahan saat menambahkan review.');
    //     }

    //     redirect($_SERVER['HTTP_REFERER']);
    // }

    public function submit()
    {
        // Validasi apakah user sudah login dan bukan admin
        $nama_user = $this->session->userdata('nama');
        $role = $this->session->userdata('role');

        if (empty($nama_user)) {
            $this->session->set_flashdata('error', 'Anda harus login untuk melakukan booking.');
            redirect('../login');
        }

        if ($role === 'admin') {
            $this->session->set_flashdata('error', 'Admin tidak dapat melakukan booking.');
            redirect($_SERVER['HTTP_REFERER']);
        }

        // Ambil ID user berdasarkan nama
        $id_user = $this->Produk_model->get_id_by_name($nama_user);

        if (!$id_user) {
            $this->session->set_flashdata('error', 'Pengguna tidak ditemukan.');
            redirect('../login');
        }

        // Ambil data dari form
        $seri_alat = htmlspecialchars($this->input->post('itemSelect', true));
        $bookingDate = $this->input->post('bookingDate', true);
        $returnDate = $this->input->post('returnDate', true);

        // Validasi format tanggal
        if (!$this->is_valid_date($bookingDate) || !$this->is_valid_date($returnDate)) {
            $this->session->set_flashdata('error', 'Format tanggal tidak valid.');
            redirect($_SERVER['HTTP_REFERER']);
        }

        // Validasi input
        if (empty($seri_alat) || empty($bookingDate) || empty($returnDate)) {
            $this->session->set_flashdata('error', 'Semua kolom harus diisi.');
            redirect($_SERVER['HTTP_REFERER']);
        }

        // Fetch the price
        $total_harga = $this->Produk_model->get_price($seri_alat);

        if ($total_harga <= 0) {
            $this->session->set_flashdata('error', 'Harga produk tidak ditemukan.');
            redirect($_SERVER['HTTP_REFERER']);
        }

        // Format ulang tanggal (jika diperlukan untuk database)
        $bookingDate = date('Y-m-d', strtotime($bookingDate));
        $returnDate = date('Y-m-d', strtotime($returnDate));

        // Set status dan bukti pembayaran

        // Simpan ke database
        $result = $this->Produk_model->add_rental(
            $id_user,
            $seri_alat,
            $bookingDate,
            $returnDate,
            $total_harga
        );

        if ($result) {
            $inv = $this->Produk_model->get_latest_penyewaan_by_user($id_user, $seri_alat);

            $this->session->set_flashdata('success', 'Penyewaan berhasil ditambahkan.');
            redirect(base_url('invoice/kode/' . $inv)); // Redirect ke halaman invoice

        } else {
            $this->session->set_flashdata('error', 'Terjadi kesalahan saat menambahkan penyewaan.');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    private function is_valid_date($date)
    {
        $d = DateTime::createFromFormat('Y-m-d', $date);
        return $d && $d->format('Y-m-d') === $date;
    }
}
