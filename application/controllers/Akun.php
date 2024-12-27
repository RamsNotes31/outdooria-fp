<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Akun extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('Akun_model');

        // Load form validation library
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = 'Hikyu | Profile';

        $this->load->view('templates/header2', $data);

        // Check if the user is logged in (session 'nama' should be set)
        if (!$this->session->userdata('nama')) {
            // Redirect to login page if not logged in
            redirect('../login');
        }

        // Get the 'nama' from session
        $nama = $this->session->userdata('nama');

        // Fetch user data from the model based on 'nama'
        $user = $this->Akun_model->get_user_by_name($nama);

        if ($user) {
            // Pass user data to the view
            $data['user'] = $user;
            $this->load->view('pages/setting/akun', $data);
        } else {
            // If user not found, redirect to error page or login
            redirect('../akun');
        }

        $this->load->view('templates/footer', $data);
    }

    public function profil($names = null)
    {
        if ($names === null) {
            redirect($_SERVER['HTTP_REFERER']);
        }

        $this->load->model('Akun_model');
        $names = urldecode($names); // Decode nama dari URL jika sebelumnya di-encode
        $userr = $this->Akun_model->get_user_by_names($names);

        if ($userr) {
            $data['title'] = 'Hikyu | Profile';
            $data['user'] = $userr;

            $this->load->view('templates/header', $data);
            $this->load->view('pages/setting/akun', $data);
            $this->load->view('templates/footer', $data);
        } else {
            redirect('../kesalahan');
        }
    }

    public function ubah()
    {
        $data['title'] = 'Hikyu | Setting';

        $this->load->view('templates/header2', $data);

        // Check if the user is logged in (session 'nama' should be set)
        if (!$this->session->userdata('nama')) {
            // Redirect to login page if not logged in
            redirect('../login');
        }

        // Get the 'nama' from session
        $nama = $this->session->userdata('nama');

        // Fetch user data from the model based on 'nama'
        $user = $this->Akun_model->get_user_by_name($nama);

        if ($user) {
            // Pass user data to the view
            $data['user'] = $user;
            $this->load->view('pages/setting/setting', $data);
        } else {
            // If user not found, redirect to error page or login
            redirect($_SERVER['HTTP_REFERER']);
        }

        $this->load->view('templates/footer', $data);
    }

    public function deleteFoto()
    {
        $nama = $this->session->userdata('nama');

        if (empty($nama)) {
            return false; // No session 'nama', cannot proceed
        }

        // Fetch the user's profile photo filename from the database
        $this->db->select('foto_profil');
        $this->db->where('nama', $nama);
        $query = $this->db->get('users');
        $foto_profil = $query->row()->foto_profil ?? null;

        if ($foto_profil) {
            // Construct the file path
            $file_path = './public/img/user/' . $foto_profil;
            // Attempt to delete the file if it exists
            if (file_exists($file_path)) {
                unlink($file_path);
            }
        }

        // Update the foto_profil to default.png
        $this->db->set('foto_profil', 'default.png');
        $this->db->where('nama', $nama);
        $result = $this->db->update('users');
        $result = $this->Akun_model->delete_foto_by_session_name();


        if ($result) {
            $this->session->set_flashdata('success', 'Foto berhasil dihapus dan diubah menjadi default.');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus foto.');
        }

        // Redirect ke halaman lain
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function delete()
    {
        $nama = $this->session->userdata('nama');

        if (empty($nama)) {
            return false; // No session 'nama', cannot proceed
        }

        // Fetch the user's profile photo filename from the database
        $this->db->select('foto_profil');
        $this->db->where('nama', $nama);
        $query = $this->db->get('users');
        $foto_profil = $query->row()->foto_profil ?? null;

        if ($foto_profil && $foto_profil !== 'default.png') {
            // Construct the file path
            $file_path = './public/img/user/' . $foto_profil;

            // Attempt to delete the file if it exists
            if (file_exists($file_path)) {
                unlink($file_path);
            }
        }

        $result = $this->Akun_model->delete_user_by_session_name();

        if ($result) {
            $this->session->set_flashdata('success', 'Akun berhasil dihapus.');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus akun.');
        }

        // Redirect ke halaman lain
        redirect('../logout');
    }

    public function update()
    {
        // Check if form is submitted
        if ($this->input->post()) {
            // Validation for password matching
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
            $this->form_validation->set_rules('ulangi_password', 'Ulangi Password', 'required|matches[password]');

            if ($this->form_validation->run() == FALSE) {
                // Validation failed, load the view again with validation errors
                redirect($_SERVER['HTTP_REFERER']);
            } else {
                // Data to update
                $data = array(
                    'nama' => $this->input->post('nama'),
                    'no_telepon' => $this->input->post('no_hp'),
                    'email' => $this->input->post('email'),
                    'password' => $this->input->post('password'),
                    'alamat' => $this->input->post('alamat'),
                );

                // Check if a new photo is uploaded
                if (!empty($_FILES['foto']['name'])) {
                    // Ensure the user is logged in
                    if (!$this->session->userdata('nama')) {
                        redirect('../login'); // Redirect to login if not logged in
                    }

                    // Get user ID based on session name
                    $nama = $this->session->userdata('nama');
                    $id_user = $this->Akun_model->get_id_by_name($nama);

                    // Retrieve existing user data to check for old photo
                    $user_data = $this->Akun_model->get_user_by_id($id_user); // Method to get user data by ID

                    // Remove the old photo if it exists
                    if (!empty($user_data->foto_profil) && $user_data->foto_profil !== 'default.png') {
                        $old_photo_path = './public/img/user/' . $user_data->foto_profil;
                        if (file_exists($old_photo_path)) {
                            unlink($old_photo_path);
                        }
                    }

                    // Clean the filename
                    $nama_user = $this->input->post('nama');
                    $nama_file = strtolower(preg_replace('/[^a-zA-Z0-9]/', '_', $nama_user)); // Ensure valid filename

                    $config['upload_path'] = './public/img/user/';
                    $config['allowed_types'] = 'jpg|png|jpeg|heic';
                    $config['file_name'] = $nama_file; // Set file name

                    $this->load->library('upload', $config);

                    if ($this->upload->do_upload('foto')) {
                        $data['foto_profil'] = $this->upload->data('file_name'); // Save file name to the database
                    }
                }

                // Update the user data in the database
                $this->Akun_model->update_user($id_user, $data);

                // Update session 'nama' with the new name
                $this->session->set_userdata('nama', $data['nama']);

                // Redirect to profile or success page
                redirect($_SERVER['HTTP_REFERER']);
            }
        }
    }

    public function admin($name = null)
    {
        if ($name === null) {
            redirect($_SERVER['HTTP_REFERER']);
        }

        // Load Akun_model
        $this->load->model('Akun_model');

        $name = urldecode($name);
        // Ambil data admin dari model
        $admin = $this->Akun_model->get_admin_by_name($name);

        // Jika admin ditemukan
        if ($admin) {
            $data['title'] = 'Hikyu | Admin';
            $data['admin'] = $admin;

            // Load views
            $this->load->view('templates/header', $data);
            $this->load->view('pages/setting/admin', $data);
            $this->load->view('templates/footer', $data);
        } else {
            // Redirect jika admin tidak ditemukan
            redirect('../kesalahan');
        }
    }

    public function feedback()
    {
        $data['title'] = 'Hikyu | Feedback';

        // Cek apakah user sudah login
        if (!$this->session->userdata('nama')) {
            redirect('../login'); // Redirect ke login jika belum login
        }

        // Ambil nama user dari session
        $nama = $this->session->userdata('nama');
        $id_user = $this->Akun_model->get_id_by_name($nama);

        if (!$id_user) {
            redirect('../akun'); // Redirect jika user tidak ditemukan
        }

        // Ambil feedback berdasarkan id_user
        $feed = $this->Akun_model->get_feedback_by_user($id_user);

        // Kirim data ke view
        $data['feed'] = $feed;

        $this->load->view('templates/header2', $data);
        $this->load->view('pages/setting/feedback', $data);
        $this->load->view('templates/footer', $data);
    }

    public function hapusfeed($id_feedback)
    {
        $this->load->model('Akun_model'); // Load model

        // Menghapus feedback berdasarkan id_feedback
        if ($this->Akun_model->delete_feedback($id_feedback)) {
            $this->session->set_flashdata('success', 'Feedback berhasil dihapus.');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus feedback.');
        }

        redirect('../akun/feedback'); // Redirect ke halaman feedback
    }

    public function editfeed($id_feedback)
    {
        $this->load->model('Akun_model'); // Load model

        // Data yang akan diperbarui
        $data = [
            'rating' => $this->input->post('rating'),
            'komentar' => $this->input->post('comment'),
            'tanggal_feedback' => $this->input->post('tanggal_feedback')
        ];

        // Memperbarui feedback berdasarkan id_feedback
        if ($this->Akun_model->update_feedback($id_feedback, $data)) {
            $this->session->set_flashdata('success', 'Feedback berhasil diperbarui.');
        } else {
            $this->session->set_flashdata('error', 'Gagal memperbarui feedback.');
        }

        redirect('../akun/feedback'); // Redirect ke halaman feedback
    }

    public function favorit()
    {
        $data['title'] = 'Hikyu | Favorit';

        $this->load->model('Akun_model'); // Load model favorit

        // Cek apakah user sudah login
        if (!$this->session->userdata('nama')) {
            redirect('../login'); // Redirect ke login jika belum login
        }

        // Ambil nama user dari session
        $nama = $this->session->userdata('nama');
        $id_user = $this->Akun_model->get_id_by_name($nama);

        if (!$id_user) {
            redirect('../akun'); // Redirect jika user tidak ditemukan
        }

        $data['products'] = $this->Akun_model->get_favorite_items($id_user); // Ambil alat favorit

        $this->load->view('templates/header2', $data);
        $this->load->view('pages/setting/favorit', $data);
        $this->load->view('templates/footer', $data);
    }

    public function hapusfavorit($id_alat)
    {
        $this->load->model('Akun_model'); // Load model favorit

        // Cek apakah user sudah login
        if (!$this->session->userdata('nama')) {
            redirect('../login'); // Redirect ke login jika belum login
        }

        // Ambil nama user dari session
        $nama = $this->session->userdata('nama');
        $id_user = $this->Akun_model->get_id_by_name($nama);

        if (!$id_user) {
            redirect('../akun'); // Redirect jika user tidak ditemukan
        }

        // Hapus alat dari favorit
        if ($this->Akun_model->delete_favorite_item($id_user, $id_alat)) {
            $this->session->set_flashdata('success', 'Alat berhasil dihapus dari favorit.');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus alat dari favorit.');
        }

        redirect('akun/favorit'); // Redirect ke halaman favorit
    }
}
