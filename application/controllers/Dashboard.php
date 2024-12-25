<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Dashboard_model');
    }
    public function index()
    {
        $data['title'] = 'Hikyu | Dashboard';
        $this->load->view('templates/header4', $data);
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
        ];

        $data['perbandingan'] = $this->Dashboard_model->get_perbandingan_online_offline();
        $data['rentals'] = $this->Dashboard_model->get_rentals_pending();

        $data['rentalss'] = $this->Dashboard_model->get_rentals_sewa();

        // Ambil data jumlah penyewaan berdasarkan status
        $data['total_penyewaan'] = $this->Dashboard_model->get_total_penyewaannya();
        $data['batal'] = $this->Dashboard_model->get_status_count('batal');
        $data['menunggu'] = $this->Dashboard_model->get_status_count('menunggu');
        $data['disewa'] = $this->Dashboard_model->get_status_count('disewa');
        $data['selesai'] = $this->Dashboard_model->get_status_count('selesai');

        // Hitung persentase
        $data['percentages'] = [
            'batal' => ($data['batal'] / $data['total_penyewaan']) * 100,
            'menunggu' => ($data['menunggu'] / $data['total_penyewaan']) * 100,
            'disewa' => ($data['disewa'] / $data['total_penyewaan']) * 100,
            'selesai' => ($data['selesai'] / $data['total_penyewaan']) * 100,
        ];

        // Mengambil data dari model
        $data['total_stok'] = $this->Dashboard_model->get_total_stoks();
        $data['rusak'] = $this->Dashboard_model->get_stok_by_status('rusak');
        $data['dalam_perawatan'] = $this->Dashboard_model->get_stok_by_status('dalam perawatan');
        $data['disewa'] = $this->Dashboard_model->get_stok_by_status('disewa');
        $data['tersedia'] = $this->Dashboard_model->get_stok_by_status('tersedia');

        // Menghitung persentase
        $data['percentagess'] = [
            'rusak' => ($data['rusak'] / $data['total_stok']) * 100,
            'dalam_perawatan' => ($data['dalam_perawatan'] / $data['total_stok']) * 100,
            'disewa' => ($data['disewa'] / $data['total_stok']) * 100,
            'tersedia' => ($data['tersedia'] / $data['total_stok']) * 100,
        ];

        // Mengambil data dari model
        $data['total_stok'] = $this->Dashboard_model->get_total_stoks();
        $data['baru'] = $this->Dashboard_model->get_status_counts('baru');
        $data['baik'] = $this->Dashboard_model->get_status_counts('baik');
        $data['minus'] = $this->Dashboard_model->get_status_counts('minus');

        // Menghitung persentase
        $data['percentagesss'] = [
            'baru' => ($data['baru'] / $data['total_stok']) * 100,
            'baik' => ($data['baik'] / $data['total_stok']) * 100,
            'minus' => ($data['minus'] / $data['total_stok']) * 100,
        ];

        // Mengambil jumlah alat berdasarkan kategori dari model
        $data['kategori_counts'] = $this->Dashboard_model->get_kategori_counts();

        // Menghitung total alat
        $total_alat = 0;
        foreach ($data['kategori_counts'] as $kategori) {
            $total_alat += $kategori->total; // Menambahkan jumlah alat per kategori
        }

        // Menyimpan total alat ke dalam data untuk ditampilkan di view
        $data['total_alat'] = $total_alat;

        $data['bukti_pembayaranya'] = $this->Dashboard_model->get_all_bukti_pembayaran();
        $data['chat_img'] = $this->Dashboard_model->get_all_chat_img();

        $this->load->view('admin/dashboard', $data);

        $this->load->view('templates/footer');
    }

    public function accept($rental_id)
    {
        $this->Dashboard_model->update_status($rental_id, 'disewa');
        redirect('../dashboard'); // Pastikan ini menggunakan rute yang benar
    }

    public function reject($rental_id)
    {
        // Update the rental status to "Menunggu Batal"
        $this->Dashboard_model->update_status($rental_id, 'batal');

        // Redirect back to the rentals page
        redirect('../dashboard');
    }

    public function complete($rental_id)
    {
        // Update the rental status to "Menunggu Batal"
        $this->Dashboard_model->update_status($rental_id, 'selesai');

        // Redirect back to the rentals page
        redirect('../dashboard');
    }
}
