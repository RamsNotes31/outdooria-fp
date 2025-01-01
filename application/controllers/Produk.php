<?php
defined('BASEPATH') or
    header("Location: error");



class Produk extends CI_Controller

{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('Produk_model');
    }
    public function index()
    {
        $this->load->library('session');

        $data['title'] = 'Hikyu | Rental';
        $this->load->model('Produk_model');

        $kategori = $this->input->post('kategori');
        $search = $this->input->post('search');
        $sort = $this->input->post('sort');

        $data['alat_pendakian'] = $this->Produk_model->get_all_kategori();

        $data['produks'] = $this->Produk_model->get_produk_with_criteria($kategori, $search, $sort);

        if (empty($data['produks'])) {
            log_message('error', 'No produk data available for view.');
        }
        $data['img_alat'] = $this->Produk_model->get_all_foto_alat();

        $nama = $this->session->userdata('nama');
        $id_user = $this->Produk_model->get_id_by_name($nama);
        $favorit = $this->Produk_model->get_favorit_by_user($id_user);
        $data['favorit'] = array_column($favorit, 'id_alat');

        $this->load->view('templates/header', $data);
        $this->load->view('pages/rental/rental', $data);
        $this->load->view('templates/footer');
    }


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
        $favorit = $this->Produk_model->get_favorit_by_user($id_user);
        $data['favorit'] = array_column($favorit, 'id_alat');

        $data['s'] = $this->Produk_model->get_total_feedback_by_alat($product_id);
        $data['product']['rata_rata_rating'] = $this->Produk_model->get_average_rating_by_alat($product_id) ?? 0;
        $data['d'] = $this->Produk_model->join_popularity_count($product_id);
        $data['t'] = $this->Produk_model->join_favorit_count($product_id);


        $order_by = $this->input->get('order_by') ?? 'terbaru';
        $valid_order_by = ['rating_tertinggi', 'rating_terendah', 'terlama', 'terbaru', 'gambar'];
        $order_by = in_array($order_by, $valid_order_by) ? $order_by : 'terbaru';

        $data['feedback'] = $this->Produk_model->get_feedback($product_id, $order_by);


        $data['feedback'] = $this->Produk_model->get_feedback($product_id, $order_by);

        $this->load->view('pages/rental/detail', $data);
        $this->load->view('templates/footer');
    }


    public function wishlist($product_id = null)
    {
        $this->load->library('session');

        $nama = $this->session->userdata('nama');


        $role = $this->session->userdata('role');


        if ($role === 'admin') {
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            if (!$nama) {
                redirect('../login');
            }
        }

        if ($product_id === null) {
            $this->session->set_flashdata('error', 'Produk tidak valid.');
            redirect('../produk');
        }

        $this->load->model('Produk_model');
        $id_user = $this->Produk_model->get_id_by_name($nama);

        if (!$id_user) {

            $this->session->set_flashdata('error', 'User tidak ditemukan.');
            redirect('../produk');
        }

        $this->load->model('Produk_model');
        $this->Produk_model->tambah_favorit($id_user, $product_id);

        $this->session->set_flashdata('success', 'Produk berhasil ditambahkan ke favorit.');
        redirect($_SERVER['HTTP_REFERER']);
    }


    public function submit()
    {
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

        $id_user = $this->Produk_model->get_id_by_name($nama_user);

        if (!$id_user) {
            $this->session->set_flashdata('error', 'Pengguna tidak ditemukan.');
            redirect('../login');
        }


        $seri_alat = htmlspecialchars($this->input->post('itemSelect', true));

        $id_alat = $this->input->post('id_alat', true);
        $bookingDate = $this->input->post('bookingDate', true);
        $returnDate = $this->input->post('returnDate', true);

        if (!$this->Produk_model->checkbook($id_user, $id_alat)) {
            $this->session->set_flashdata('error', 'Anda sudah memesan alat ini.');
            redirect($_SERVER['HTTP_REFERER']);
        }


        if (!$this->is_valid_date($bookingDate) || !$this->is_valid_date($returnDate)) {
            $this->session->set_flashdata('error', 'Format tanggal tidak valid.');
            redirect($_SERVER['HTTP_REFERER']);
        }

        if (empty($seri_alat) || empty($bookingDate) || empty($returnDate)) {
            $this->session->set_flashdata('error', 'Semua kolom harus diisi.');
            redirect($_SERVER['HTTP_REFERER']);
        }

        $total_harga = $this->Produk_model->get_price($seri_alat);

        if ($total_harga <= 0) {
            $this->session->set_flashdata('error', 'Harga produk tidak ditemukan.');
            redirect($_SERVER['HTTP_REFERER']);
        }

        $bookingDate = date('Y-m-d', strtotime($bookingDate));
        $returnDate = date('Y-m-d', strtotime($returnDate));


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
            redirect(base_url('invoice/kode/' . $inv));
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
