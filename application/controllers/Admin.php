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

        $nama_admin = $this->input->post('nama', true);
        $email_admin = $this->input->post('username', true);
        $no_telp_admin = $this->input->post('no_hp', true);
        $password_admin = $this->input->post('password');
        $jenis_kelamin = $this->input->post('jenkel', true);
        $foto_admin = 'default.png';

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

        $data = [
            'nama_admin' => $nama_admin,
            'email_admin' => $email_admin,
            'no_telp_admin' => $no_telp_admin,
            'password_admin' => $password_admin,
            'jenis_kelamin' => $jenis_kelamin,
            'foto_admin' => $foto_admin
        ];

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
            return false;
        }

        $this->db->select('foto_admin');
        $this->db->where('nama_admin', $nama);
        $query = $this->db->get('admin');
        $foto_admin = $query->row()->foto_admin ?? null;

        if ($foto_admin && $foto_admin !== 'default.png') {
            $file_path = './public/img/admin/' . $foto_admin;

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

        redirect('../logout');
    }

    public function ubah()
    {
        if ($this->input->post()) {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
            $this->form_validation->set_rules('confirmpassword', 'Ulangi Password', 'required|matches[password]');

            if ($this->form_validation->run() == FALSE) {
                redirect($_SERVER['HTTP_REFERER']);
            } else {
                if (!$this->session->userdata('nama_admin')) {
                    redirect('../login');
                }

                $nama = $this->session->userdata('nama_admin');
                $id_admin = $this->Admin_model->get_admin_by_nama($nama);
                if (!$id_admin) {
                    redirect('../login');
                }

                $admin_data = $this->Admin_model->get_admin_by_id($id_admin);

                $data = array(
                    'nama_admin' => $this->input->post('nama'),
                    'no_telp_admin' => $this->input->post('no_hp'),
                    'email_admin' => $this->input->post('username'),
                    'jenis_kelamin' => $this->input->post('jenkel'),
                );

                if ($this->input->post('password') !== $admin_data->password_admin) {
                    $data['password_admin'] = $this->input->post('password');
                }

                if (!empty($_FILES['foto']['name'])) {
                    if (!empty($admin_data->foto_admin) && $admin_data->foto_admin !== 'default.png') {
                        $old_photo_path = './public/img/admin/' . $admin_data->foto_admin;
                        if (file_exists($old_photo_path)) {
                            unlink($old_photo_path);
                        }
                    }

                    $nama_file = strtolower(preg_replace('/[^a-zA-Z0-9]/', '_', $this->input->post('nama')));
                    $config['upload_path'] = './public/img/admin/';
                    $config['allowed_types'] = 'jpg|png|jpeg|heic';
                    $config['file_name'] = $nama_file;

                    $this->load->library('upload', $config);

                    if ($this->upload->do_upload('foto')) {
                        $data['foto_admin'] = $this->upload->data('file_name');
                    } else {
                        redirect($_SERVER['HTTP_REFERER']);
                    }
                }

                $this->Admin_model->update_user($id_admin, $data);

                if ($this->session->userdata('nama_admin') !== $data['nama_admin']) {
                    $this->session->set_userdata('nama_admin', $data['nama_admin']);
                }

                redirect($_SERVER['HTTP_REFERER']);
            }
        }
    }

    public function deleteFoto()
    {
        $nama = $this->session->userdata('nama_admin');

        if (empty($nama)) {
            return false;
        }

        $this->db->select('foto_admin');
        $this->db->where('nama_admin', $nama);
        $query = $this->db->get('admin');
        $foto_admin = $query->row()->foto_admin ?? null;

        if ($foto_admin) {
            $file_path = './public/img/admin/' . $foto_admin;
            if (file_exists($file_path)) {
                unlink($file_path);
            }
        }

        $this->db->set('foto_admin', 'default.png');
        $this->db->where('nama_admin', $nama);
        $result = $this->db->update('admin');
        $result = $this->Admin_model->delete_foto_by_session_name();


        if ($result) {
            $this->session->set_flashdata('success', 'Foto berhasil dihapus dan diubah menjadi default.');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus foto.');
        }

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

        if (!$seri_alat) {
            redirect('admin/data_seri_alat');
        }

        $data['product'] = $this->db->get_where('seri', ['seri_alat' => $seri_alat])->row_array();
        if (!$data['product']) {
            redirect('admin/data_seri_alat');
        }

        $data['kondisi'] = $this->Admin_model->get_enum_kondisi();
        $data['status'] = $this->Admin_model->get_status_excluding_waiting();

        $id_alat = $this->Admin_model->get_id_alat($seri_alat);
        $data['produk'] = $this->Admin_model->get_nama_alat($id_alat);

        $this->load->view('admin/eseri', $data);
        $this->load->view('templates/footer');
    }

    public function update_seri_alat($seri_alat)
    {
        if (!$seri_alat || !$this->input->post('kondisi') || !$this->input->post('status')) {
            $this->session->set_flashdata('error', 'Data tidak valid. Pastikan semua field diisi.');
            redirect($_SERVER['HTTP_REFERER']);
        }

        $data = [
            'kondisi' => $this->input->post('kondisi'),
            'status_produk' => $this->input->post('status')
        ];


        $this->Admin_model->update_seri($seri_alat, $data);

        redirect('admin/data_seri_alat');
    }

    public function tambah_seri_alat()
    {
        $data['title'] = 'Hikyu | Tambah Seri';
        $this->load->view('templates/header4', $data);

        $data['nama_alat'] = $this->Admin_model->getNamaAlat();
        $data['kondisi'] = ['baru', 'baik', 'minus'];
        $data['status'] = ['tersedia', 'dalam perawatan', 'rusak'];

        $this->load->view('admin/tseri', $data);

        $this->load->view('templates/footer');
    }

    public function tambah_data_seri()
    {
        $this->form_validation->set_rules('nama_alat', 'Nama Alat', 'required');

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
                $this->Admin_model->callProcedureTambahSeri($p_id_alat, 'baru', 'tersedia');
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

        $data['chats'] = $this->Chatting_model->get_all_chats($id_user);

        $data['users'] = $this->Chatting_model->get_nama_user($id_user);

        if (!$data['users']) {
            $data['error_message'] = "User tidak ditemukan!";
        }

        $this->load->view('admin/detail', $data);
        $this->load->view('templates/footer');
    }

    public function data_informasi()
    {
        $data['title'] = 'Hikyu | Data Informasi';
        $this->load->view('templates/header4', $data);
        $data['info'] = $this->Admin_model->getallinformasi();
        $this->load->view('admin/informasi', $data);
        $this->load->view('templates/footer');
    }

    public function tinformasi()
    {
        $data['title'] = 'Hikyu | Tambah Informasi';
        $this->load->view('templates/header4', $data);
        $this->load->view('admin/tinformasi', $data);
        $this->load->view('templates/footer');
    }


    public function data_alat()
    {
        $data['title'] = 'Hikyu | Data Alat';
        $this->load->view('templates/header4', $data);
        $data['alat'] = $this->Admin_model->getallalat();
        $this->load->view('admin/alat', $data);
        $this->load->view('templates/footer');
    }

    public function dinformasi($id_informasi)
    {
        $this->load->model('Admin_model');
        $informasi = $this->Admin_model->get_informasi_by_id($id_informasi);

        if ($informasi) {
            $path = './public/img/gunung/' . $informasi['foto_gunung'];
            if (file_exists($path) && $informasi['foto_gunung'] !== 'default.jpg') {
                unlink($path);
            }

            if ($this->Admin_model->hapus_informasi($id_informasi)) {
                $this->session->set_flashdata('success', 'Data informasi berhasil dihapus.');
            } else {
                $this->session->set_flashdata('error', 'Gagal menghapus data informasi.');
            }
        } else {
            $this->session->set_flashdata('error', 'Data informasi tidak ditemukan.');
        }

        redirect('admin/data_informasi');
    }


    public function dalat($id_alat)
    {
        if ($this->Admin_model->hapus_alat($id_alat)) {
            $this->session->set_flashdata('success', 'Data informasi berhasil dihapus.');
            redirect('admin/data_alat');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus data informasi.');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function tambah_informasi()
    {
        $this->load->library('upload');
        $this->load->model('Admin_model');
        $nama_admin = $this->session->userdata('nama_admin');
        $id_admin = $this->Admin_model->get_id_admin($nama_admin);
        $gunung = $this->input->post('admin', TRUE);

        $this->form_validation->set_rules('admin', 'Nama Gunung', 'required|alpha_numeric_spaces');
        $this->form_validation->set_rules('lokasi', 'Lokasi', 'required');
        $this->form_validation->set_rules('harga_biaya', 'Harga Biaya', 'required|numeric');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect($_SERVER['HTTP_REFERER']);
        }

        $config['upload_path']   = './public/img/gunung/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['file_name']     = strtolower(str_replace(' ', '_', $gunung));

        $this->upload->initialize($config);

        if (!$this->upload->do_upload('foto')) {
            $foto = 'default.jpg';
        } else {
            $upload_data = $this->upload->data();
            $foto = $upload_data['file_name'];
        }

        $data = [
            'id_admin'     => $id_admin,
            'nama_gunung'  => $gunung,
            'lokasi'       => $this->input->post('lokasi', TRUE),
            'harga_biaya'  => $this->input->post('harga_biaya', TRUE),
            'deskripsi'    => $this->input->post('deskripsi', TRUE),
            'foto_gunung'  => $foto,
        ];

        if ($this->Admin_model->tambah_informasi($data)) {
            $this->session->set_flashdata('success', 'Informasi pendakian berhasil ditambahkan.');
        } else {
            $this->session->set_flashdata('error', 'Gagal menambahkan informasi pendakian.');
        }

        redirect('admin/data_informasi');
    }

    public function einformasi($id_informasi)
    {
        $data['title'] = 'Hikyu | Edit Alat';
        $this->load->view('templates/header4', $data);
        $data['alat'] = $this->Admin_model->get_informasi_by_id($id_informasi);
        $this->load->view('admin/einformasi', $data);
        $this->load->view('templates/footer');
    }

    public function deleteInfo($id_informasi)
    {
        $nama = $this->session->userdata('nama_admin');

        if (empty($nama)) {
            return false;
        }

        $this->db->select('foto_gunung');
        $this->db->where('id_informasi', $id_informasi);
        $query = $this->db->get('informasi_pendakian');
        $foto_gunung = $query->row()->foto_gunung ?? null;

        if ($foto_gunung) {
            $file_path = './public/img/gunung/' . $foto_gunung;
            $informasi = $this->Admin_model->get_informasi_by_id($id_informasi);
            if (file_exists($file_path) && $informasi['foto_gunung'] !== 'default.jpg') {
                unlink($file_path);
            }
        }

        $this->db->set('foto_gunung', 'default.jpg');
        $this->db->where('id_informasi', $id_informasi);
        $result = $this->db->update('informasi_pendakian');
        $result = $this->Admin_model->delete_foto_info($id_informasi);


        if ($result) {
            $this->session->set_flashdata('success', 'Foto berhasil dihapus dan diubah menjadi default.');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus foto.');
        }

        redirect($_SERVER['HTTP_REFERER']);
    }

    public function edit_informasi()
    {
        $this->load->library('upload');
        $this->load->model('Admin_model');

        $id_info = $this->input->post('id_informasi');
        $nama_admin = $this->session->userdata('nama_admin');
        $nama_gunung = $this->input->post('admin');
        $harga_biaya = $this->input->post('harga_biaya');
        $lokasi = $this->input->post('lokasi');
        $deskripsi = $this->input->post('deskripsi');

        $id_admin =  $this->input->post('nama');
        $informasi = $this->Admin_model->get_informasi_by_id($id_info);

        $foto_gunung = $informasi['foto_gunung'];

        $config['upload_path'] = './public/img/gunung/';
        $config['allowed_types'] = 'jpeg|jpg|png|heic';
        $config['file_name'] = $nama_gunung;

        $this->upload->initialize($config);

        if (!empty($_FILES['foto']['name']) && $this->upload->do_upload('foto')) {
            $file_path = './public/img/gunung/' . $informasi['foto_gunung'];
            if (file_exists($file_path) && $informasi['foto_gunung'] !== 'default.jpg') {
                unlink($file_path);
            }

            $file_data = $this->upload->data();
            $foto_gunung = $file_data['file_name'];
        }

        $data = [
            'id_admin' => $id_admin,
            'nama_gunung' => $nama_gunung,
            'harga_biaya' => $harga_biaya,
            'lokasi' => $lokasi,
            'deskripsi' => $deskripsi,
            'foto_gunung' => $foto_gunung,
        ];

        $result = $this->Admin_model->update_informasi($id_info, $data);

        if ($result) {
            $this->session->set_flashdata('success', 'Data berhasil diperbarui.');
        } else {
            $this->session->set_flashdata('error', 'Gagal memperbarui data.');
        }

        redirect('admin/data_informasi');
    }

    public function talat()
    {
        $data['title'] = 'Hikyu | Tambah Alat';
        $this->load->view('templates/header4', $data);
        $data['kategori_options'] = $this->Admin_model->getKategoriOptions();
        $this->load->view('admin/talat', $data);
        $this->load->view('templates/footer');
    }

    public function tambahData()
    {
        $this->form_validation->set_rules('nama', 'Nama Alat', 'required');
        $this->form_validation->set_rules('kategori', 'Kategori', 'required');
        $this->form_validation->set_rules('stok', 'Stok', 'required|numeric');
        $this->form_validation->set_rules('harga_sewa', 'Harga Sewa', 'required|numeric');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->talat();
        } else {
            $foto = $this->uploadFoto();
            $data = [
                'nama' => $this->input->post('nama'),
                'kategori' => $this->input->post('kategori'),
                'stok' => $this->input->post('stok'),
                'harga_sewa' => $this->input->post('harga_sewa'),
                'foto' => $foto,
                'deskripsi' => $this->input->post('deskripsi'),
            ];

            try {
                $this->Admin_model->insertAlatWithProcedure($data);
                $this->session->set_flashdata('success', 'Data alat berhasil ditambahkan.');
                redirect('admin/data_alat');
            } catch (Exception $e) {
                $this->session->set_flashdata('error', 'Terjadi kesalahan: ' . $e->getMessage());
                $this->talat();
            }
        }
    }

    private function uploadFoto()
    {
        $config['upload_path'] = './public/img/produk/';
        $config['allowed_types'] = 'jpeg|jpg|png|heic';
        $config['file_name'] = $this->input->post('nama');

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('foto')) {
            return $this->upload->data('file_name');
        } else {
            return 'default.jpg';
        }
    }

    public function ealat($id)
    {
        $data['title'] = 'Hikyu | Edit Alat';
        $this->load->view('templates/header4', $data);
        $data['kategori_options'] = $this->Admin_model->getKategoriOptions();

        $data['data'] = $this->Admin_model->getAlatById($id);

        if (!$data['data']) {
            $this->session->set_flashdata('error', 'Data alat tidak ditemukan.');
            redirect('admin/data_alat');
        }

        $this->load->view('admin/ealat', $data);
        $this->load->view('templates/footer');
    }

    public function deleteAlat($id)
    {
        $nama = $this->session->userdata('nama_admin');

        if (empty($nama)) {
            return false;
        }

        $this->db->select('foto_produk');
        $this->db->where('id_alat', $id);
        $query = $this->db->get('alat_pendakian');
        $foto_produk = $query->row()->foto_produk ?? null;

        if ($foto_produk) {
            $file_path = './public/img/produk/' . $foto_produk;
            $informasi = $this->Admin_model->get_alats_by_id($id);
            if (file_exists($file_path) && $informasi['foto_produk'] !== 'default.jpg') {
                unlink($file_path);
            }
        }

        $this->db->set('foto_produk', 'default.jpg');
        $this->db->where('id_alat', $id);
        $result = $this->db->update('alat_pendakian');
        $result = $this->Admin_model->delete_foto_produk($id);


        if ($result) {
            $this->session->set_flashdata('success', 'Foto berhasil dihapus dan diubah menjadi default.');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus foto.');
        }

        redirect($_SERVER['HTTP_REFERER']);
    }

    public function updateAlat()
    {
        $id = $this->input->post('id_alat');

        $this->form_validation->set_rules('nama', 'Nama Alat', 'required');
        $this->form_validation->set_rules('kategori', 'Kategori', 'required');
        $this->form_validation->set_rules('stok', 'Stok', 'required|numeric');
        $this->form_validation->set_rules('harga_sewa', 'Harga Sewa', 'required|numeric');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->ealat($id);
        } else {
            $alat = $this->Admin_model->getAlatById($id);

            $foto = $this->uploadFotos();
            if ($foto && $foto !== 'default.jpg') {
                $this->Admin_model->deleteOldPhoto($alat['foto_produk']);
            } else {
                $foto = $alat['foto_produk'];
            }

            $data = [
                'nama_alat' => $this->input->post('nama'),
                'kategori' => $this->input->post('kategori'),
                'stok' => $this->input->post('stok'),
                'harga_sewa' => $this->input->post('harga_sewa'),
                'deskripsi' => $this->input->post('deskripsi'),
                'foto_produk' => $foto
            ];

            if ($this->Admin_model->updateAlat($id, $data)) {
                $this->session->set_flashdata('success', 'Data alat berhasil diperbarui.');
                redirect('admin/data_alat');
            } else {
                $this->session->set_flashdata('error', 'Terjadi kesalahan saat memperbarui data.');
                $this->ealat($id);
            }
        }
    }

    private function uploadFotos()
    {
        $config['upload_path'] = './public/img/produk/';
        $config['allowed_types'] = 'jpeg|jpg|png|heic';
        $config['file_name'] = $this->input->post('nama');

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('foto')) {
            return $this->upload->data('file_name');
        } else {
            return null;
        }
    }
}
