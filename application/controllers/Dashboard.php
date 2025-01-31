<?php
defined('BASEPATH') or
    header("Location: error");

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Dashboard_model');
        $this->load->library('session');
    }
    public function index()
    {
        $data['title'] = 'Hikyu | Dashboard';
        $this->load->view('templates/header4', $data);

        if (!$this->session->userdata('role') || $this->session->userdata('role') != 'admin') {
            redirect('../login');
        }

        $this->load->model('Dashboard_model');

        $data = [
            'total_pendapatan' => $this->Dashboard_model->get_total_pendapatan(),
            'total_admin' => $this->Dashboard_model->get_total_admin(),
            'total_penyewaan' => $this->Dashboard_model->get_total_penyewaan(),
            'total_users' => $this->Dashboard_model->get_total_users(),
            'total_alat' => $this->Dashboard_model->get_total_alat(),
            'total_stok' => $this->Dashboard_model->get_total_stok(),
            'total_informasi' => $this->Dashboard_model->get_total_informasi(),
            'total_favorit' => $this->Dashboard_model->get_total_favorit(),
            'total_feedback' => $this->Dashboard_model->get_total_feedback(),

            'alat_terlaris' => $this->Dashboard_model->get_alat_terlaris(),
            'rating_tertinggi' => $this->Dashboard_model->get_rating_tertinggi(),
            'top_favorit' => $this->Dashboard_model->get_top_favorit(),
            'top_admin' => $this->Dashboard_model->get_top_admin(),
            'stok_terbanyak' => $this->Dashboard_model->get_stok_terbanyak(),
            'top_user' => $this->Dashboard_model->get_top_user(),

            'top_admin_chat' => $this->Dashboard_model->get_top_admin_chat(),
            'top_user_feedback' => $this->Dashboard_model->get_top_user_feedback(),
            'top_admin_posting' => $this->Dashboard_model->get_top_admin_posting(),
            'top_user_rented_item' => $this->Dashboard_model->get_top_user_rented_item(),

            'pendapatan_bulanan' => $this->Dashboard_model->get_pendapatan_bulanan_bulan_ini(),
        ];

        $data['perbandingan'] = $this->Dashboard_model->get_perbandingan_online_offline();
        $data['rentals'] = $this->Dashboard_model->get_rentals_pending();

        $data['rentalss'] = $this->Dashboard_model->get_rentals_sewa();

        $data['total_penyewaan'] = $this->Dashboard_model->get_total_penyewaannya();
        $data['batal'] = $this->Dashboard_model->get_status_count('batal');
        $data['menunggu'] = $this->Dashboard_model->get_status_count('menunggu');
        $data['disewa'] = $this->Dashboard_model->get_status_count('disewa');
        $data['selesai'] = $this->Dashboard_model->get_status_count('selesai');

        $data['percentages'] = [
            'batal' => $data['total_penyewaan'] > 0 ? ($data['batal'] / $data['total_penyewaan']) * 100 : 0,
            'menunggu' => $data['total_penyewaan'] > 0 ? ($data['menunggu'] / $data['total_penyewaan']) * 100 : 0,
            'disewa' => $data['total_penyewaan'] > 0 ? ($data['disewa'] / $data['total_penyewaan']) * 100 : 0,
            'selesai' => $data['total_penyewaan'] > 0 ? ($data['selesai'] / $data['total_penyewaan']) * 100 : 0,
        ];

        $data['total_stok'] = $this->Dashboard_model->get_total_stoks();
        $data['rusak'] = $this->Dashboard_model->get_stok_by_status('rusak');
        $data['dalam_perawatan'] = $this->Dashboard_model->get_stok_by_status('dalam perawatan');
        $data['disewa'] = $this->Dashboard_model->get_stok_by_status('disewa');
        $data['tersedia'] = $this->Dashboard_model->get_stok_by_status('tersedia');

        $data['percentagess'] = [
            'rusak' => $data['total_stok'] > 0 ? ($data['rusak'] / $data['total_stok']) * 100 : 0,
            'dalam_perawatan' => $data['total_stok'] > 0 ? ($data['dalam_perawatan'] / $data['total_stok']) * 100 : 0,
            'disewa' => $data['total_stok'] > 0 ? ($data['disewa'] / $data['total_stok']) * 100 : 0,
            'tersedia' => $data['total_stok'] > 0 ? ($data['tersedia'] / $data['total_stok']) * 100 : 0,
        ];
        $data['total_stok'] = $this->Dashboard_model->get_total_stoks();
        $data['baru'] = $this->Dashboard_model->get_status_counts('baru');
        $data['baik'] = $this->Dashboard_model->get_status_counts('baik');
        $data['minus'] = $this->Dashboard_model->get_status_counts('minus');

        $data['percentagesss'] = [
            'baru' => $data['total_stok'] > 0 ? ($data['baru'] / $data['total_stok']) * 100 : 0,
            'baik' => $data['total_stok'] > 0 ? ($data['baik'] / $data['total_stok']) * 100 : 0,
            'minus' => $data['total_stok'] > 0 ? ($data['minus'] / $data['total_stok']) * 100 : 0,
        ];

        $data['kategori_counts'] = $this->Dashboard_model->get_kategori_counts();

        $total_alat = 0;
        foreach ($data['kategori_counts'] as $kategori) {
            $total_alat += $kategori->total;
        }

        $data['total_alat'] = $total_alat;

        $data['bukti_pembayaranya'] = $this->Dashboard_model->get_all_bukti_pembayaran();
        $data['chat_img'] = $this->Dashboard_model->get_all_chat_img();

        $data['user_statistics'] = $this->Dashboard_model->get_user_statistics();
        $data['admin_statistics'] = $this->Dashboard_model->get_admin_statistics();

        $this->load->view('admin/dashboard', $data);

        $this->load->view('templates/footer');
    }

    public function accept($rental_id)
    {
        $this->Dashboard_model->update_status($rental_id, 'disewa');
        redirect('../dashboard');
    }

    public function reject($rental_id)
    {
        $this->Dashboard_model->update_status($rental_id, 'batal');

        redirect('../dashboard');
    }

    public function complete($rental_id)
    {
        $this->Dashboard_model->update_status($rental_id, 'selesai');

        redirect('../dashboard');
    }
}
