<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Gunung extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Gunung_model');
    }
    public function index()
    {
        $data['title'] = 'Hikyu | Gunung';
        $this->load->view('templates/header', $data);
        $this->load->model('Gunung_model');
        $data['gunungs'] = $this->Gunung_model->get_all_informasi_pendakian();
        if (empty($data['gunungs'])) {
            log_message('error', 'No Gunung data available for view.');
        }
        $kategori = $this->input->post('kategori');
        $search = $this->input->post('search');
        $lokasi = $this->input->post('lokasi');  // Ambil lokasi dari form

        // Ambil lokasi unik dari database untuk dropdown
        $data['lokasi_options'] = $this->Gunung_model->get_all_lokasi();

        // Ambil data informasi pendakian berdasarkan filter
        $data['informasi'] = $this->Gunung_model->get_filtered_informasi($kategori, $search, $lokasi);
        if (empty($data['informasi']) or empty($data['lokasi_list'])) {
            log_message('error', 'No Gunung data available for view.');
        }

        $data['img_gunung'] = $this->Gunung_model->get_all_foto_gunung();
        $this->load->view('pages/infor/gunung', $data);
        $this->load->view('templates/footer');
    }

    public function info($id_informasi = null)
    {
        if (is_null($id_informasi)) {
            redirect('../gunung');
            return;
        }

        $this->load->model('Gunung_model');
        $data['title'] = 'Hikyu | Gunung Info';
        $this->load->view('templates/header', $data);
        $data['detail'] = $this->Gunung_model->get_informasi_by_id($id_informasi);
        // if (empty($data['detail'])) {
        //     redirect('../gunung');
        // }
        $data['gunungs'] = $this->Gunung_model->get_informasi_pendakian(6);
        // if (empty($data['gunungs'])) {
        //     redirect('../gunung');
        // }
        $this->load->view('pages/infor/info', $data);
        $this->load->view('templates/footer');
    }
}
