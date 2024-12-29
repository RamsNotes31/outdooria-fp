<?php
defined('BASEPATH') or
    header("Location: error");

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

        $nama = $this->session->userdata('nama'); // Ambil nama dari session

        if ($nama !== $data['invoice']['nama']) {
            redirect('../produk');
        }

        if (!$data['invoice']) {
            redirect('../produk');
        }

        $data['title'] = 'Hikyu | Invoice';

        $data['feedbacks'] = $this->Invoice_model->get_feedback_with_user(3);

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
        $this->load->model('Invoice_model');  // Load model penyewaan
        // Ambil data form
        $nama_alat = $this->input->post('nama_alat');
        $id_penyewaan = $this->input->post('id_penyewaan');
        $nama_alat = $this->input->post('nama_alat');

        // Ambil nama user dari session
        $nama_user = $this->session->userdata('nama');
        $role = $this->session->userdata('role');

        // Validasi apakah user sudah login
        if (empty($nama_user)) {
            $this->session->set_flashdata('error', 'Anda harus login untuk memberikan review.');
            redirect('../login');
        }

        // Validasi role admin
        if ($role === 'admin') {
            redirect('../home');
        }

        $product_id = $this->Invoice_model->get_id_by_product($nama_alat);
        if (is_null($product_id)) {
            $this->session->set_flashdata('error', 'Produk yang Anda review tidak valid.');
            redirect($_SERVER['HTTP_REFERER']);
        }

        // Ambil ID user berdasarkan nama
        $id_user = $this->Invoice_model->get_id_by_name($nama_user);

        // Validasi jika user tidak ditemukan
        if (!$id_user) {
            $this->session->set_flashdata('error', 'Gagal menemukan ID pengguna.');
            redirect('../login');
        }

        // Proses upload bukti pembayaran
        $upload_status = $this->Invoice_model->upload_bukti_pembayaran($id_penyewaan);


        if ($upload_status === true) {
            // Jika upload berhasil
            $this->session->set_flashdata('up', 'Bukti pembayaran berhasil diupload.');

            $message = "<strong>Detail Invoice</strong> <br><br>Invoice: #" . $id_penyewaan . "<br> Nama: " . $nama_user . "<br> Alat: " . $nama_alat . "<br> Tanggal Sewa: " . date('d F Y', strtotime($this->Invoice_model->get_invoice_by_id($id_penyewaan)['tanggal_penyewaan'])) . "<br> Tanggal Balik: " . date('d F Y', strtotime($this->Invoice_model->get_invoice_by_id($id_penyewaan)['tanggal_pengembalian'])) . "<br> Harga: Rp. " . number_format($this->Invoice_model->get_invoice_by_id($id_penyewaan)['total_harga'], 0, ',', '.') . "<br>";

            $data = [
                'id_user' => $id_user,
                'id_admin' => 1165,
                'role' => "user",
                'pesan' => $message,
                'foto_chat' => null,
            ];

            // Simpan data ke database menggunakan stored procedure
            if ($this->Invoice_model->insert_chat_auto($data)) {
                $this->session->set_flashdata('success', 'Pesan berhasil dikirim.');
                // Update foto_chat di tabel chat
                $this->db->set('foto_chat', $this->Invoice_model->get_invoice_by_id($id_penyewaan)['bukti_pembayaran']);
                $this->db->where('id_user', $id_user);
                $this->db->where('pesan', $message);
                $this->db->update('chat');

                $dataa = [
                    'id_user' => $id_user,
                    'id_admin' => 1165,
                    'role' => "admin",
                    'pesan' => "Baik, pesanan telah kami terima, silahkan datang untuk mengambil alat tersebut untuk kami proses lebih lanjut. Terima kasih.",
                    'foto_chat' => null,
                ];
                if ($this->Invoice_model->insert_chat_auto($dataa)) {
                    redirect(base_url('chatting'));
                } else {
                    redirect($_SERVER['HTTP_REFERER']);
                }
            } else {
                $this->session->set_flashdata('error', 'Gagal mengirim pesan.');
            }
        } else {
            // Jika upload gagal
            $this->session->set_flashdata('ga', 'Gagal mengupload bukti pembayaran: ' . $upload_status);
            redirect(base_url('invoice/bukti/' . $id_penyewaan));
        }
    }


    public function review()
    {
        // Load session library
        $this->load->library('session');
        $this->load->library('upload'); // Untuk upload file gambar

        // Ambil nama user dari session
        $nama_user = $this->session->userdata('nama');
        $role = $this->session->userdata('role');

        // Validasi apakah user sudah login
        if (empty($nama_user)) {
            $this->session->set_flashdata('error', 'Anda harus login untuk memberikan review.');
            redirect('../login');
        }

        // Validasi role admin
        if ($role === 'admin') {
            redirect('../home');
        }

        // Ambil ID user berdasarkan nama
        $id_user = $this->Invoice_model->get_id_by_name($nama_user);

        // Validasi jika user tidak ditemukan
        if (!$id_user) {
            $this->session->set_flashdata('error', 'Gagal menemukan ID pengguna.');
            redirect('../login');
        }



        // Ambil data form
        $nama_alat = $this->input->post('nama_alat');
        $id_penyewaan = $this->input->post('id_penyewaan');
        $rating = $this->input->post('rating');
        $comment = $this->input->post('comment');

        $cekfeed = $this->Invoice_model->check_feedback_exists_for_rental($id_penyewaan);

        if ($cekfeed) {
            $this->session->set_flashdata('sudah', 'Anda sudah memberikan review untuk penyewaan kali ini ini.');
            redirect($_SERVER['HTTP_REFERER']);
        }

        // Validasi apakah ID alat ditemukan
        $product_id = $this->Invoice_model->get_id_by_product($nama_alat);
        if (is_null($product_id)) {
            $this->session->set_flashdata('error', 'Produk yang Anda review tidak valid.');
            redirect($_SERVER['HTTP_REFERER']);
        }

        // Validasi input rating dan komentar
        if (empty($rating) || empty($comment)) {
            $this->session->set_flashdata('error', 'Semua field wajib diisi.');
            redirect($_SERVER['HTTP_REFERER']);
        }

        // Proses upload foto
        $foto = null;
        if (!empty($_FILES['photo']['name'])) {
            $config['upload_path'] = './public/img/feedback/';
            $config['allowed_types'] = 'jpeg|jpg|png|heic';
            $config['file_name'] = $nama_user . '_' . $id_penyewaan; // Nama file berdasarkan id_feedback

            $this->upload->initialize($config);

            if ($this->upload->do_upload('photo')) {
                // Ambil nama file yang diupload
                $foto = $this->upload->data('file_name');
            } else {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect($_SERVER['HTTP_REFERER']);
            }
        }

        // Simpan data feedback ke database
        $is_inserted = $this->Invoice_model->tambah_feedback($id_user, $product_id, $id_penyewaan, $comment, $rating, $foto);

        // Berikan feedback kepada user
        if ($is_inserted) {
            $this->session->set_flashdata('successs', 'Review berhasil ditambahkan.');
        } else {
            $this->session->set_flashdata('errorr', 'Terjadi kesalahan saat menambahkan review.');
        }

        redirect($_SERVER['HTTP_REFERER']);
    }
}
