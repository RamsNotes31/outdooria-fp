<?php
class Chatting_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }


    public function get_id_by_name($nama)
    {
        $this->db->where('nama', $nama);
        $result = $this->db->get('users')->row();
        return $result ? $result->id_user : null;
    }

    public function get_nama_user($id_user)
    {
        $this->db->where('id_user', $id_user);
        $result = $this->db->get('users')->row(); 
        return $result ? $result->nama : null;  
    }


    public function get_id_by_name_admin($nama)
    {
        $this->db->where('nama_admin', $nama);
        $result = $this->db->get('admin')->row();
        return $result ? $result->id_admin : null; 
    }

    public function insert_chat($data)
    {
        $this->db->query(
            "CALL tambah_chat(?, ?, ?, ?, ?)",
            array(
                $data['id_user'],
                $data['id_admin'],
                $data['role'],
                $data['pesan'],
                $data['foto_chat']
            )
        );

        return $this->db->affected_rows() > 0;
    }


    public function get_all_chats($id_user)
    {
        $this->db->select('chat.*, users.foto_profil, users.nama as nama_user, admin.foto_admin, admin.nama_admin as nama_admin, id_chat');
        $this->db->from('chat');
        $this->db->join('users', 'chat.id_user = users.id_user', 'left');
        $this->db->join('admin', 'chat.id_admin = admin.id_admin', 'left');
        $this->db->where('chat.id_user', $id_user);
        $this->db->order_by('chat.tanggal_kirim', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function delete_chat($id_chat)
    {
        $this->db->where('id_chat', $id_chat);
        $query = $this->db->get('chat');
        $chat = $query->row();

        if ($chat && $chat->foto_chat) {
            $file_path = './public/img/chat/' . $chat->foto_chat;
            if (file_exists($file_path)) {
                unlink($file_path);
            }
        }

        $this->db->where('id_chat', $id_chat);
        return $this->db->delete('chat');
    }

    public function delete_chat_files($id_chat)
    {
        $this->db->where('id_chat', $id_chat);
        $query = $this->db->get('chat');
        $chat = $query->row();

        if ($chat && $chat->foto_chat) {
            $file_path = './public/img/chat/' . $chat->foto_chat;
            if (file_exists($file_path)) {
                unlink($file_path);
            }
        }

        $data = array('foto_chat' => null);
        $this->db->where('id_chat', $id_chat);
        return $this->db->update('chat', $data);
    }

    public function update_chat($id_chat, $data)
    {
        $this->db->where('id_chat', $id_chat);
        return $this->db->update('chat', $data);
    }
}
