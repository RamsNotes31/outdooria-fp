<?php
defined('BASEPATH') or
    header("Location: error");

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Admin_model');
        $this->load->library('session');
        $this->load->library('form_validation');
    }

    public function index()
    {
        redirect('../dashboard');
    }

    public function data_favorit()
    {
        $data['title'] = 'Hikyu | Favorit';
        $this->load->view('templates/header4', $data);

        // Ambil data favorit
        $data['favorites'] = $this->Admin_model->get_all_favorites();

        $this->load->view('admin/fav', $data);
        $this->load->view('templates/footer');
    }

    public function data_feedback()
    {
        $data['title'] = 'Hikyu | Feedback';
        $this->load->view('templates/header4', $data);

        $data['feedbacks'] = $this->Admin_model->get_all_feedbacks();

        $this->load->view('admin/feedback', $data);
        $this->load->view('templates/footer');
    }

    public function data_users()
    {
        $data['title'] = 'Hikyu | User';
        $this->load->view('templates/header4', $data);

        $data['users'] = $this->Admin_model->get_all_users();

        $this->load->view('admin/users', $data);
        $this->load->view('templates/footer');
    }

    public function data_admin()
    {
        $data['title'] = 'Hikyu | Admin';
        $this->load->view('templates/header4', $data);

        $data['users'] = $this->Admin_model->get_all_admins();

        $this->load->view('admin/admin', $data);
        $this->load->view('templates/footer');
    }

    public function data_penyewaan()
    {
        $data['title'] = 'Hikyu | Penyewaan';

        $this->load->view('templates/header4', $data);

        $data['penyewaans'] = $this->Admin_model->get_all_rentals();

        $this->load->view('admin/sewa', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        $data['title'] = 'Hikyu | Tambah Admin';
        $this->load->view('templates/header4', $data);
        $this->load->view('admin/tadmin');
        $this->load->view('templates/footer');
    }

    public function tambah_data()
    {
        $this->load->library('upload');

        // Ambil data dari form
        $nama_admin = $this->input->post('nama', true);
        $email_admin = $this->input->post('username', true);
        $no_telp_admin = $this->input->post('no_hp', true);
        $password_admin = $this->input->post('password');
        $jenis_kelamin = $this->input->post('jenkel', true);
        $foto_admin = 'default.png';

        // Proses upload foto jika ada
        if (!empty($_FILES['foto']['name'])) {
            $config['upload_path'] = './public/img/admin/';
            $config['allowed_types'] = 'jpeg|jpg|png|heic';
            $config['file_name'] = strtolower(str_replace(' ', '_', $nama_admin));

            $this->upload->initialize($config);

            if ($this->upload->do_upload('foto')) {
                $foto_admin = $this->upload->data('file_name');
            } else {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect(base_url('admin/tambah'));
            }
        }

        // Data untuk stored procedure
        $data = [
            'nama_admin' => $nama_admin,
            'email_admin' => $email_admin,
            'no_telp_admin' => $no_telp_admin,
            'password_admin' => $password_admin,
            'jenis_kelamin' => $jenis_kelamin,
            'foto_admin' => $foto_admin
        ];

        // Panggil model untuk menyimpan data
        $is_added = $this->Admin_model->tambah_admin($data);

        if ($is_added) {
            $this->session->set_flashdata('success', 'Admin berhasil ditambahkan.');
        } else {
            $this->session->set_flashdata('error', 'Gagal menambahkan admin.');
        }

        redirect(base_url('admin/data_admin'));
    }

    public function ubah_data()
    {
        $data['title'] = 'Hikyu | Ubah Data';
        $this->load->view('templates/header4', $data);

        $nama = $this->session->userdata('nama_admin');
        $id_admin = $this->Admin_model->get_admin_by_nama($nama);

        $data['mimin'] = $this->Admin_model->get_admin_by_id($id_admin);

        $this->load->view('admin/eadmin', $data);

        $this->load->view('templates/footer');
    }



    public function hapus()
    {
        $nama = $this->session->userdata('nama_admin');

        if (empty($nama)) {
            return false; // No session 'nama', cannot proceed
        }

        // Fetch the user's profile photo filename from the database
        $this->db->select('foto_admin');
        $this->db->where('nama_admin', $nama);
        $query = $this->db->get('admin');
        $foto_admin = $query->row()->foto_admin ?? null;

        if ($foto_admin && $foto_admin !== 'default.png') {
            // Construct the file path
            $file_path = './public/img/admin/' . $foto_admin;

            // Attempt to delete the file if it exists
            if (file_exists($file_path)) {
                unlink($file_path);
            }
        }

        $result = $this->Admin_model->delete_admin_by_session_name();

        if ($result) {
            $this->session->set_flashdata('success', 'Akun berhasil dihapus.');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus akun.');
        }

        // Redirect ke halaman lain
        redirect('../logout');
    }

    public function ubah()
    {
        if ($this->input->post()) {
            $this->load->library('form_validation');

            // Validasi form
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
            $this->form_validation->set_rules('confirmpassword', 'Ulangi Password', 'required|matches[password]');

            if ($this->form_validation->run() == FALSE) {
                // Redirect kembali jika validasi gagal
                redirect($_SERVER['HTTP_REFERER']);
            } else {
                // Pastikan pengguna login
                if (!$this->session->userdata('nama_admin')) {
                    redirect('../login');
                }

                // Dapatkan ID pengguna dari session
                $nama = $this->session->userdata('nama_admin');
                $id_admin = $this->Admin_model->get_admin_by_nama($nama);
                if (!$id_admin) {
                    redirect('../login'); // Jika pengguna tidak ditemukan
                }

                // Ambil data pengguna lama
                $admin_data = $this->Admin_model->get_admin_by_id($id_admin);

                // Data untuk update
                $data = array(
                    'nama_admin' => $this->input->post('nama'),
                    'no_telp_admin' => $this->input->post('no_hp'),
                    'email_admin' => $this->input->post('username'),
                    'jenis_kelamin' => $this->input->post('jenkel'),
                );

                // Perbarui password hanya jika berbeda
                if ($this->input->post('password') !== $admin_data->password_admin) {
                    $data['password_admin'] = $this->input->post('password'); // Simpan password terenkripsi
                }

                // Proses unggah file foto baru
                if (!empty($_FILES['foto']['name'])) {
                    // Hapus foto lama jika ada dan bukan default
                    if (!empty($admin_data->foto_admin) && $admin_data->foto_admin !== 'default.png') {
                        $old_photo_path = './public/img/admin/' . $admin_data->foto_admin;
                        if (file_exists($old_photo_path)) {
                            unlink($old_photo_path);
                        }
                    }

                    // Config upload
                    $nama_file = strtolower(preg_replace('/[^a-zA-Z0-9]/', '_', $this->input->post('nama')));
                    $config['upload_path'] = './public/img/admin/';
                    $config['allowed_types'] = 'jpg|png|jpeg|heic';
                    $config['file_name'] = $nama_file;

                    $this->load->library('upload', $config);

                    if ($this->upload->do_upload('foto')) {
                        $data['foto_admin'] = $this->upload->data('file_name');
                    } else {
                        // Handle error jika upload gagal
                        redirect($_SERVER['HTTP_REFERER']);
                    }
                }

                // Update ke database
                $this->Admin_model->update_user($id_admin, $data);

                // Update session nama jika nama berubah
                if ($this->session->userdata('nama_admin') !== $data['nama_admin']) {
                    $this->session->set_userdata('nama_admin', $data['nama_admin']);
                }

                // Redirect ke halaman profil
                redirect($_SERVER['HTTP_REFERER']);
            }
        }
    }

    public function deleteFoto()
    {
        $nama = $this->session->userdata('nama_admin');

        if (empty($nama)) {
            return false; // No session 'nama', cannot proceed
        }

        // Fetch the user's profile photo filename from the database
        $this->db->select('foto_admin');
        $this->db->where('nama_admin', $nama);
        $query = $this->db->get('admin');
        $foto_admin = $query->row()->foto_admin ?? null;

        if ($foto_admin) {
            // Construct the file path
            $file_path = './public/img/admin/' . $foto_admin;
            // Attempt to delete the file if it exists
            if (file_exists($file_path)) {
                unlink($file_path);
            }
        }

        // Update the foto_admin to default.png
        $this->db->set('foto_admin', 'default.png');
        $this->db->where('nama_admin', $nama);
        $result = $this->db->update('admin');
        $result = $this->Admin_model->delete_foto_by_session_name();


        if ($result) {
            $this->session->set_flashdata('success', 'Foto berhasil dihapus dan diubah menjadi default.');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus foto.');
        }

        // Redirect ke halaman lain
        redirect($_SERVER['HTTP_REFERER']);
    }


    public function data_seri_alat()
    {
        $data['title'] = 'Hikyu | Seri Alat';
        $this->load->view('templates/header4', $data);

        $data['series'] = $this->Admin_model->get_all_seri();

        $this->load->view('admin/seri', $data);

        $this->load->view('templates/footer');
    }

    public function hapus_seri($seri_alat = null)
    {
        if (is_null($seri_alat)) {
            redirect('admin/data_seri_alat');
        }

        $id_alat = $this->Admin_model->get_id_alat($seri_alat);

        $this->Admin_model->seri_alat_hapus($seri_alat, $id_alat);

        redirect('admin/data_seri_alat');
    }

    public function ubah_seri($seri_alat)
    {
        $data['title'] = 'Hikyu | Edit Seri';
        $this->load->view('templates/header4', $data);

        // Redirect jika $seri_alat kosong
        if (!$seri_alat) {
            redirect('admin/data_seri_alat');
        }

        // Ambil data produk berdasarkan seri alat
        $data['product'] = $this->db->get_where('seri', ['seri_alat' => $seri_alat])->row_array();
        if (!$data['product']) {
            redirect('admin/data_seri_alat');
        }

        // Ambil data enum kondisi dan status dari model
        $data['kondisi'] = $this->Admin_model->get_enum_kondisi();
        $data['status'] = $this->Admin_model->get_status_excluding_waiting();

        // Ambil nama alat berdasarkan ID alat yang diambil dari URI segment ke-4
        $id_alat = $this->Admin_model->get_id_alat($seri_alat);
        $data['produk'] = $this->Admin_model->get_nama_alat($id_alat);

        // Load view
        $this->load->view('admin/eseri', $data);
        $this->load->view('templates/footer');
    }

    public function update_seri_alat($seri_alat)
    {
        // Validasi input form
        if (!$seri_alat || !$this->input->post('kondisi') || !$this->input->post('status')) {
            $this->session->set_flashdata('error', 'Data tidak valid. Pastikan semua field diisi.');
            redirect($_SERVER['HTTP_REFERER']);
        }

        // Data yang akan diupdate berdasarkan input dari form
        $data = [
            'kondisi' => $this->input->post('kondisi'), // Ambil nilai kondisi dari form
            'status_produk' => $this->input->post('status') // Ambil nilai status dari form
        ];

        // Proses update data ke database
        $this->Admin_model->update_seri($seri_alat, $data);

        // Redirect kembali ke halaman data seri alat
        redirect('admin/data_seri_alat');
    }

    public function tambah_seri_alat()
    {
        $data['title'] = 'Hikyu | Tambah Seri';
        $this->load->view('templates/header4', $data);

        $data['nama_alat'] = $this->Admin_model->getNamaAlat(); // Get nama_alat from database
        $data['kondisi'] = ['baru', 'baik', 'minus']; // Enum values for kondisi
        $data['status'] = ['tersedia', 'dalam perawatan', 'rusak']; // Enum values for status

        $this->load->view('admin/tseri', $data);

        $this->load->view('templates/footer');
    }

    public function tambah_data_seri()
    {
        $this->form_validation->set_rules('nama_alat', 'Nama Alat', 'required');
        // $this->form_validation->set_rules('kategori', 'Kondisi', 'required');
        //$this->form_validation->set_rules('status', 'Status', 'required');
        $this->form_validation->set_rules('jumlah', 'Jumlah', 'required|integer');

        if ($this->form_validation->run() == FALSE) {
            redirect($_SERVER['HTTP_REFERER']);
        } else {

            $p_id_alat = $this->input->post('nama_alat');
            $p_kondisi = $this->input->post('kategori');
            $p_status_produk = $this->input->post('status');
            $p_jumlah = $this->input->post('jumlah');

            $this->db->set('stok', 'stok + ' . (int)$p_jumlah, FALSE);
            $this->db->where('id_alat', $p_id_alat);
            $this->db->update('alat_pendakian');

            for ($i = 0; $i < $p_jumlah; $i++) {
                $this->Admin_model->callProcedureTambahSeri($p_id_alat, 'baru','tersedia');
            }

            redirect('admin/data_seri_alat');
        }
    }

    public function data_chat()
    {
        $data['title'] = 'Hikyu | Data Chat';
        $this->load->view('templates/header4', $data);

        $data['users'] = $this->Admin_model->getDistinctUsers();

        $this->load->view('admin/chat', $data);
        $this->load->view('templates/footer');
    }

    public function chat_detail($id_user)
    {
        $data['title'] = 'Hikyu | Chat Detail';
        $this->load->view('templates/header4', $data);

        $this->load->model('Chatting_model');

        // Ambil data chat
        $data['chats'] = $this->Chatting_model->get_all_chats($id_user);

        // Ambil nama user
        $data['users'] = $this->Chatting_model->get_nama_user($id_user);

        // Jika nama user tidak ditemukan, tampilkan pesan error
        if (!$data['users']) {
            $data['error_message'] = "User tidak ditemukan!";
        }

        $this->load->view('admin/detail', $data);
        $this->load->view('templates/footer');
    }
}
