<?php
defined('BASEPATH') or
    header("Location: error");

class Akun extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model('Akun_model');
    }

    public function index()
    {
        $data['title'] = 'Hikyu | Profile';

        $this->load->view('templates/header2', $data);

        if (!$this->session->userdata('nama')) {
            redirect('../login');
        }

        $nama = $this->session->userdata('nama');

        $user = $this->Akun_model->get_user_by_name($nama);

        if ($user) {
            $data['user'] = $user;
            $id_user = $this->Akun_model->get_id_by_name($nama);

            if (!$id_user) {
                redirect('../akun');
            }

            $data['feedback_stats'] = $this->Akun_model->get_feedback_stats($id_user);
            $data['total_penyewaan'] = $this->Akun_model->get_total_penyewaan($id_user);
            $data['top_barang'] = $this->Akun_model->get_top_barang($id_user);

            $this->load->view('pages/setting/akun', $data);
        } else {
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
        $names = urldecode($names);
        $userr = $this->Akun_model->get_user_by_names($names);

        if ($userr) {
            $data['title'] = 'Hikyu | Profile';
            $data['user'] = $userr;

            $id_user = $this->Akun_model->get_id_by_name($names);

            if (!$id_user) {
                redirect('../akun');
            }

            $data['feedback_stats'] = $this->Akun_model->get_feedback_stats($id_user);
            $data['total_penyewaan'] = $this->Akun_model->get_total_penyewaan($id_user);
            $data['top_barang'] = $this->Akun_model->get_top_barang($id_user);


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

        if (!$this->session->userdata('nama')) {
            redirect('../login');
        }

        $nama = $this->session->userdata('nama');

        $user = $this->Akun_model->get_user_by_name($nama);

        if ($user) {
            $data['user'] = $user;
            $this->load->view('pages/setting/setting', $data);
        } else {

            redirect($_SERVER['HTTP_REFERER']);
        }

        $this->load->view('templates/footer', $data);
    }

    public function deleteFoto()
    {
        $nama = $this->session->userdata('nama');

        if (empty($nama)) {
            return false;
        }

        $this->db->select('foto_profil');
        $this->db->where('nama', $nama);
        $query = $this->db->get('users');
        $foto_profil = $query->row()->foto_profil ?? null;

        if ($foto_profil) {
            $file_path = './public/img/user/' . $foto_profil;
            if (file_exists($file_path)) {
                unlink($file_path);
            }
        }

        $this->db->set('foto_profil', 'default.png');
        $this->db->where('nama', $nama);
        $result = $this->db->update('users');
        $result = $this->Akun_model->delete_foto_by_session_name();


        if ($result) {
            $this->session->set_flashdata('success', 'Foto berhasil dihapus dan diubah menjadi default.');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus foto.');
        }

        redirect($_SERVER['HTTP_REFERER']);
    }

    public function delete()
    {
        $nama = $this->session->userdata('nama');

        if (empty($nama)) {
            return false;
        }

        $this->db->select('foto_profil');
        $this->db->where('nama', $nama);
        $query = $this->db->get('users');
        $foto_profil = $query->row()->foto_profil ?? null;

        if ($foto_profil && $foto_profil !== 'default.png') {
            $file_path = './public/img/user/' . $foto_profil;

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

        redirect('../logout');
    }

    public function update()
    {
        if ($this->input->post()) {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
            $this->form_validation->set_rules('ulangi_password', 'Ulangi Password', 'required|matches[password]');

            if ($this->form_validation->run() == FALSE) {
                redirect($_SERVER['HTTP_REFERER']);
            } else {
                if (!$this->session->userdata('nama')) {
                    redirect('../login');
                }

                $nama = $this->session->userdata('nama');
                $id_user = $this->Akun_model->get_id_by_name($nama);
                if (!$id_user) {
                    redirect('../login');
                }

                $user_data = $this->Akun_model->get_user_by_id($id_user);

                $data = array(
                    'nama' => $this->input->post('nama'),
                    'no_telepon' => $this->input->post('no_hp'),
                    'email' => $this->input->post('email'),
                    'jenis_kelamin' => $this->input->post('jenkel'),
                    'alamat' => $this->input->post('alamat'),
                );

                if ($this->input->post('password') !== $user_data->password) {
                    $data['password'] = $this->input->post('password');
                }

                if (!empty($_FILES['foto']['name'])) {
                    if (!empty($user_data->foto_profil) && $user_data->foto_profil !== 'default.png') {
                        $old_photo_path = './public/img/user/' . $user_data->foto_profil;
                        if (file_exists($old_photo_path)) {
                            unlink($old_photo_path);
                        }
                    }

                    $nama_file = strtolower(preg_replace('/[^a-zA-Z0-9]/', '_', $this->input->post('nama')));
                    $config['upload_path'] = './public/img/user/';
                    $config['allowed_types'] = 'jpg|png|jpeg|heic';
                    $config['file_name'] = $nama_file;

                    $this->load->library('upload', $config);

                    if ($this->upload->do_upload('foto')) {
                        $data['foto_profil'] = $this->upload->data('file_name');
                    } else {
                        redirect($_SERVER['HTTP_REFERER']);
                    }
                }

                $this->Akun_model->update_user($id_user, $data);

                if ($this->session->userdata('nama') !== $data['nama']) {
                    $this->session->set_userdata('nama', $data['nama']);
                }

                redirect($_SERVER['HTTP_REFERER']);
            }
        }
    }


    public function admin($name = null)
    {
        if ($name === null) {
            redirect($_SERVER['HTTP_REFERER']);
        }

        $this->load->model('Akun_model');

        $name = urldecode($name);
        $admin = $this->Akun_model->get_admin_by_name($name);

        if ($admin) {
            $data['title'] = 'Hikyu | Admin';
            $data['admin'] = $admin;

            $id_admin = $admin['id_admin'];

            $data['total_informasi'] = $this->Akun_model->get_total_informasi_pendakian($id_admin)->total_informasi;
            $data['total_chats'] = $this->Akun_model->get_total_chats_by_admin($id_admin)->total_chats;

            $this->load->view('templates/header', $data);
            $this->load->view('pages/setting/admin', $data);
            $this->load->view('templates/footer', $data);
        } else {
            redirect('../kesalahan');
        }
    }


    public function feedback()
    {
        $data['title'] = 'Hikyu | Feedback';

        if (!$this->session->userdata('nama')) {
            redirect('../login');
        }

        $nama = $this->session->userdata('nama');
        $id_user = $this->Akun_model->get_id_by_name($nama);

        if (!$id_user) {
            redirect('../akun');
        }

        $feed = $this->Akun_model->get_feedback_by_user($id_user);

        $data['feed'] = $feed;

        $this->load->view('templates/header2', $data);
        $this->load->view('pages/setting/feedback', $data);
        $this->load->view('templates/footer', $data);
    }

    public function hapusfeed($id_feedback)
    {
        $this->load->model('Akun_model');
        if ($this->Akun_model->delete_feedback($id_feedback)) {

            $this->db->where('id_feedback', $id_feedback);
            $feedback = $this->db->get('feedback')->row();
            if ($feedback->foto) {
                $file_path = './public/img/feedback/' . $feedback->foto;
                if (file_exists($file_path)) {
                    unlink($file_path);
                }
            }

            $this->session->set_flashdata('success', 'Feedback berhasil dihapus.');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus feedback.');
        }

        redirect('../akun/feedback');
    }



    public function editfeed($id_feedback)
    {
        $this->load->model('Akun_model');
        $nama = $this->session->userdata('nama');
        $id_sewa = $this->Akun_model->get_feedback_penyewaan($id_feedback);

        $data = [
            'rating' => $this->input->post('rating'),
            'komentar' => $this->input->post('comment'),
            'tanggal_feedback' => $this->input->post('tanggal_feedback')
        ];

        if (!empty($_FILES['foto']['name'])) {
            $config['upload_path'] = './public/img/feedback/';
            $config['allowed_types'] = 'jpg|jpeg|png|heic';
            $config['file_name'] = $nama . '_' . $id_sewa;


            $this->load->library('upload', $config);

            if ($this->upload->do_upload('foto')) {
                $uploaded_data = $this->upload->data();

                $old_photo = $this->Akun_model->get_feedback_photo($id_feedback);
                if ($old_photo && file_exists('./public/img/feedback/' . $old_photo)) {
                    unlink('./public/img/feedback/' . $old_photo);
                }

                $data['foto'] = $uploaded_data['file_name'];
            } else {
                $this->session->set_flashdata('error', 'Gagal mengunggah foto: ' . $this->upload->display_errors());
                redirect('../akun/feedback');
            }
        }

        if ($this->Akun_model->update_feedback($id_feedback, $data)) {
            $this->session->set_flashdata('success', 'Feedback berhasil diperbarui.');
        } else {
            $this->session->set_flashdata('error', 'Gagal memperbarui feedback.');
        }

        redirect('../akun/feedback');
    }



    public function hapusfoto($id_feedback)
    {
        $this->load->model('Akun_model');

        if ($this->Akun_model->delete_feedback_foto($id_feedback)) {
            $this->session->set_flashdata('success', 'Foto berhasil dihapus.');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus foto.');
        }
    }

    public function favorit()
    {
        $data['title'] = 'Hikyu | Favorit';

        $this->load->model('Akun_model');

        if (!$this->session->userdata('nama')) {
            redirect('../login');
        }

        $nama = $this->session->userdata('nama');
        $id_user = $this->Akun_model->get_id_by_name($nama);

        if (!$id_user) {
            redirect('../akun');
        }

        $data['products'] = $this->Akun_model->get_favorite_items($id_user);

        $this->load->view('templates/header2', $data);
        $this->load->view('pages/setting/favorit', $data);
        $this->load->view('templates/footer', $data);
    }

    public function hapusfavorit($id_alat)
    {
        $this->load->model('Akun_model');

        if (!$this->session->userdata('nama')) {
            redirect('../login');
        }

        $nama = $this->session->userdata('nama');
        $id_user = $this->Akun_model->get_id_by_name($nama);

        if (!$id_user) {
            redirect('../akun');
        }

        if ($this->Akun_model->delete_favorite_item($id_user, $id_alat)) {
            $this->session->set_flashdata('success', 'Alat berhasil dihapus dari favorit.');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus alat dari favorit.');
        }

        redirect('../akun/favorit');
    }

    public function riwayat()
    {
        $data['title'] = 'Hikyu | Riwayat';

        if (!$this->session->userdata('nama')) {
            redirect('../login');
        }

        $nama = $this->session->userdata('nama');
        $id_user = $this->Akun_model->get_id_by_name($nama);

        if (!$id_user) {
            redirect('../akun');
        }

        $riwayat = $this->Akun_model->get_riwayat_penyewaan($id_user);

        $data['riwayat'] = $riwayat;

        $this->load->view('templates/header2', $data);
        $this->load->view('pages/setting/riwayat', $data);
        $this->load->view('templates/footer', $data);
    }
}
