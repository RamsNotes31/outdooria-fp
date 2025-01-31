<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Chatting extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('Chatting_model');
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = "Hikyu | Chatting";

        $this->load->library('session');

        $nama = $this->session->userdata('nama');
        $id_user = $this->Chatting_model->get_id_by_name($nama);

        if (!$nama) {
            redirect('../login');
        }

        $data['chats'] = $this->Chatting_model->get_all_chats($id_user);

        $this->load->view('templates/header', $data);
        $this->load->view('pages/chat/chatting', $data);
        $this->load->view('templates/footer');
    }

    public function send_message()
    {
        $message = $this->input->post('message');
        $nama = $this->session->userdata('nama');
        $role = $this->session->userdata('role');
        $id_user = $this->Chatting_model->get_id_by_name($nama);
        $id_admin = null;
        $foto_chat = null;

        if (!empty($_FILES['image']['name'])) {
            $config['upload_path'] = './public/img/chat/';
            $config['allowed_types'] = '*';
            $config['file_name'] = $nama . '_' . $role . '_' . time();

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('image')) {
                $foto_chat = $this->upload->data('file_name');
            } else {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect('../chatting');
            }
        } else {
            $this->form_validation->set_rules('message', 'Pesan', 'required|min_length[5]|max_length[255]');

            if ($this->form_validation->run() === FALSE) {
                $this->session->set_flashdata('error', 'Pesan gagal dikirim, silahkan coba lagi.');
                redirect('chatting');
            }
        }

        $data = [
            'id_user' => $id_user,
            'id_admin' => $id_admin,
            'role' => $role,
            'pesan' => $message,
            'foto_chat' => $foto_chat,
        ];

        if ($this->Chatting_model->insert_chat($data)) {
            $this->session->set_flashdata('success', 'Pesan berhasil dikirim.');
        } else {
            $this->session->set_flashdata('error', 'Gagal mengirim pesan.');
        }

        redirect('../chatting');
    }

    public function delete($id_chat)
    {
        if ($this->Chatting_model->delete_chat($id_chat)) {
            $this->session->set_flashdata('success', 'Pesan berhasil dihapus.');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus pesan.');
        }

        redirect('../chatting');
    }

    public function delete_admin($id_chat)
    {
        if ($this->Chatting_model->delete_chat($id_chat)) {
            $this->session->set_flashdata('success', 'Pesan berhasil dihapus.');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus pesan.');
        }

        redirect($_SERVER['HTTP_REFERER']);
    }

    public function edit($id_chat)
    {
        $message = $this->input->post('message');
        $nama = $this->session->userdata('nama');
        $foto_chat = null;
        $role = $this->session->userdata('role');

        if (!empty($_FILES['image']['name'])) {

            $config['upload_path'] = './public/img/chat/';
            $config['allowed_types'] = '*';
            $config['file_name'] = $nama . '_' . $role . '_' . time();

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('image')) {
                $foto_chat = $this->upload->data('file_name');
            } else {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect('../chatting');
            }
        } else {

            $this->form_validation->set_rules('message', 'Pesan', 'required|min_length[5]|max_length[255]');

            if ($this->form_validation->run() === FALSE) {
                $this->session->set_flashdata('error', 'Pesan gagal diupdate, silahkan coba lagi.');
                redirect('chatting');
            }
        }

        if (!empty($_FILES['image']['name'])) {
            $this->db->where('id_chat', $id_chat);
            $query = $this->db->get('chat');
            $chat = $query->row();

            if ($chat && $chat->foto_chat) {
                $file_path = './public/img/chat/' . $chat->foto_chat;
                if (file_exists($file_path)) {
                    unlink($file_path);
                }
            }

            $data = [
                'pesan' => $message,
                'foto_chat' => $foto_chat,
            ];
        } else {
            $data = [
                'pesan' => $message,
            ];
        }

        if ($this->Chatting_model->update_chat($id_chat, $data)) {
            $this->session->set_flashdata('success', 'Pesan berhasil diperbarui.');
        } else {
            $this->session->set_flashdata('error', 'Gagal memperbarui pesan.');
        }

        redirect('../chatting');
    }

    public function edit_admin($id_chat)
    {
        $message = $this->input->post('message');
        $nama = $this->session->userdata('nama');
        $foto_chat = null;
        $role = $this->session->userdata('role');

        if (!empty($_FILES['image']['name'])) {

            $config['upload_path'] = './public/img/chat/';
            $config['allowed_types'] = '*';
            $config['file_name'] = $nama . '_' . $role . '_' . time();

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('image')) {
                $foto_chat = $this->upload->data('file_name');
            } else {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect($_SERVER['HTTP_REFERER']);
            }
        } else {

            $this->form_validation->set_rules('message', 'Pesan', 'required|min_length[5]|max_length[255]');

            if ($this->form_validation->run() === FALSE) {
                $this->session->set_flashdata('error', 'Pesan gagal diupdate, silahkan coba lagi.');
                redirect($_SERVER['HTTP_REFERER']);
            }
        }

        if (!empty($_FILES['image']['name'])) {
            $this->db->where('id_chat', $id_chat);
            $query = $this->db->get('chat');
            $chat = $query->row();

            if ($chat && $chat->foto_chat) {
                $file_path = './public/img/chat/' . $chat->foto_chat;
                if (file_exists($file_path)) {
                    unlink($file_path);
                }
            }

            $data = [
                'pesan' => $message,
                'foto_chat' => $foto_chat,
            ];
        } else {
            $data = [
                'pesan' => $message,
            ];
        }

        if ($this->Chatting_model->update_chat($id_chat, $data)) {
            $this->session->set_flashdata('success', 'Pesan berhasil diperbarui.');
        } else {
            $this->session->set_flashdata('error', 'Gagal memperbarui pesan.');
        }

        redirect($_SERVER['HTTP_REFERER']);
    }

    public function hapusFile($id_chat)
    {
        if ($this->Chatting_model->delete_chat_files($id_chat)) {
            $this->session->set_flashdata('success', 'File berhasil dihapus.');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus file.');
        }

        redirect('../chatting');
    }

    public function hapusFile_admin($id_chat)
    {
        if ($this->Chatting_model->delete_chat_files($id_chat)) {
            $this->session->set_flashdata('success', 'File berhasil dihapus.');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus file.');
        }

        redirect($_SERVER['HTTP_REFERER']);
    }

    public function send_message_admin($id_users)
    {
        $message = $this->input->post('message');
        $nama = $this->session->userdata('nama_admin');
        $role = $this->session->userdata('role');
        $id_user = $id_users;
        $id_admin = $this->Chatting_model->get_id_by_name_admin($nama);
        $foto_chat = null;

        if (!empty($_FILES['image']['name'])) {
            $config['upload_path'] = './public/img/chat/';
            $config['allowed_types'] = '*';
            $config['file_name'] = $nama . '_' . $role . '_' . time();

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('image')) {
                $foto_chat = $this->upload->data('file_name');
            } else {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect($_SERVER['HTTP_REFERER']);
            }
        } else {
            $this->form_validation->set_rules('message', 'Pesan', 'required|min_length[5]|max_length[255]');

            if ($this->form_validation->run() === FALSE) {
                $this->session->set_flashdata('error', 'Pesan gagal dikirim, silahkan coba lagi.');
                redirect($_SERVER['HTTP_REFERER']);
            }
        }

        $data = [
            'id_user' => $id_user,
            'id_admin' => $id_admin,
            'role' => $role,
            'pesan' => $message,
            'foto_chat' => $foto_chat,
        ];

        if ($this->Chatting_model->insert_chat($data)) {
            $this->session->set_flashdata('success', 'Pesan berhasil dikirim.');
        } else {
            $this->session->set_flashdata('error', 'Gagal mengirim pesan.');
        }

        redirect($_SERVER['HTTP_REFERER']);
    }
}
