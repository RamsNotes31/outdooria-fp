<?php
defined('BASEPATH') or exit('No direct script access allowed');



class Produk extends CI_Controller

{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Produk_model');
    }
    public function index()
    {
        $data['title'] = 'Hikyu | Rental';
        $this->load->view('templates/header', $data);
        $this->load->model('Produk_model');
        $data['produks'] = $this->Produk_model->get_produk_with_feedback(); // Ambil data produk dan rating
        if (empty($data['produks'])) {
            log_message('error', 'No produk data available for view.');
        }
        $this->load->view('pages/rental/rental', $data); // Kirim data ke view
        $this->load->view('templates/footer');
    }

    // Menampilkan detail produk berdasarkan id_produk
    public function detail($product_id = null)
    {
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
        $this->load->view('pages/rental/detail', $data);
        $this->load->view('templates/footer');
    }
}
