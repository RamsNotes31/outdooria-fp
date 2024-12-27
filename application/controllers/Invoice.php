<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Invoice extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('Invoice_model');
    }

    public function index()
    {
        redirect('../produk');
    }

    public function kode($id_penyewaan = null)
    {
        if ($id_penyewaan === null) {
            redirect('../produk');
        }

        $this->load->model('Invoice_model'); // Load model invoice

        // Ambil data penyewaan berdasarkan ID
        $data['invoice'] = $this->Invoice_model->get_invoice_by_id($id_penyewaan);

        if (!$data['invoice']) {
            redirect('../produk');
        }

        $data['title'] = 'Hikyu | Invoice';

        // Load tampilan invoice
        $this->load->view('templates/header', $data);
        $this->load->view('pages/hist/checkout', $data);
        $this->load->view('templates/footer', $data);
    }

    public function batal()
    {
        $id_penyewaan = $this->uri->segment(3);
        $this->db->set('status_sewa', 'batal');
        $this->db->where('id_penyewaan', $id_penyewaan);
        $this->db->update('penyewaan');
        redirect('../invoice/kode/' . $id_penyewaan);
    }
    public function bukti()
    {
        $id_penyewaan = $this->uri->segment(3); // Ambil id_penyewaan dari URI segment
        $this->load->model('Invoice_model');  // Load model penyewaan

        // Proses upload bukti pembayaran
        $upload_status = $this->Invoice_model->upload_bukti_pembayaran($id_penyewaan);

        if ($upload_status === true) {
            // Jika upload berhasil
            $this->session->set_flashdata('success', 'Bukti pembayaran berhasil diupload.');
            redirect(base_url('invoice/kode/' . $id_penyewaan));
        } else {
            // Jika upload gagal
            $this->session->set_flashdata('error', 'Gagal mengupload bukti pembayaran: ' . $upload_status);
            redirect(base_url('invoice/bukti/' . $id_penyewaan));
        }
    }
}
