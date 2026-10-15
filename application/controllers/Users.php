<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends MY_Controller {

    public function __construct() {
        parent::__construct();
        // Hanya super_admin yang boleh mengakses halaman ini
        $this->require_login(array('super_admin'));
    }

    public function index() {
        // Ambil data users kecuali alumni (asumsi role_id 4 = alumni)
        $this->db->select('users.*, roles.name as role_name');
        $this->db->from('users');
        $this->db->join('roles', 'roles.id = users.role_id');
        $this->db->where('users.role_id !=', 4);
        $this->db->order_by('users.name', 'ASC');
        $users = $this->db->get()->result_array();

        $data = array(
            'title' => 'Manajemen User',
            'users' => $users
        );

        $this->render('users/index', $data);
    }

    public function create() {
        if ($this->input->method(TRUE) === 'POST') {
            $this->form_validation->set_rules('name', 'Nama Lengkap', 'required|trim');
            $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[users.username]');
            $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[users.email]');
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
            $this->form_validation->set_rules('role_id', 'Role', 'required|numeric');

            if ($this->form_validation->run()) {
                $insert_data = array(
                    'name' => $this->input->post('name', TRUE),
                    'username' => $this->input->post('username', TRUE),
                    'email' => $this->input->post('email', TRUE),
                    'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                    'role_id' => $this->input->post('role_id', TRUE),
                    'is_active' => $this->input->post('is_active') ? 1 : 0
                );

                $this->db->insert('users', $insert_data);
                $this->session->set_flashdata('success', 'User berhasil ditambahkan.');
                redirect('users');
            }
        }

        // Ambil data role kecuali alumni
        $roles = $this->db->where('id !=', 4)->get('roles')->result_array();
        
        $data = array(
            'title' => 'Tambah User',
            'roles' => $roles
        );

        $this->render('users/create', $data);
    }

    public function edit($id) {
        $user = $this->db->get_where('users', array('id' => $id, 'role_id !=' => 4))->row_array();
        
        if (!$user) {
            show_404();
        }

        if ($this->input->method(TRUE) === 'POST') {
            $this->form_validation->set_rules('name', 'Nama Lengkap', 'required|trim');
            
            // Validasi username dan email unique, kecuali punya sendiri
            $username_rule = 'required|trim';
            if ($this->input->post('username') !== $user['username']) {
                $username_rule .= '|is_unique[users.username]';
            }
            $this->form_validation->set_rules('username', 'Username', $username_rule);
            
            $email_rule = 'required|trim|valid_email';
            if ($this->input->post('email') !== $user['email']) {
                $email_rule .= '|is_unique[users.email]';
            }
            $this->form_validation->set_rules('email', 'Email', $email_rule);
            
            $this->form_validation->set_rules('role_id', 'Role', 'required|numeric');

            // Password bersifat opsional pada saat edit
            if ($this->input->post('password')) {
                $this->form_validation->set_rules('password', 'Password', 'min_length[6]');
            }

            if ($this->form_validation->run()) {
                $update_data = array(
                    'name' => $this->input->post('name', TRUE),
                    'username' => $this->input->post('username', TRUE),
                    'email' => $this->input->post('email', TRUE),
                    'role_id' => $this->input->post('role_id', TRUE),
                    'is_active' => $this->input->post('is_active') ? 1 : 0
                );

                if ($this->input->post('password')) {
                    $update_data['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
                }

                $this->db->where('id', $id);
                $this->db->update('users', $update_data);
                
                $this->session->set_flashdata('success', 'Data user berhasil diperbarui.');
                redirect('users');
            }
        }

        // Ambil data role kecuali alumni
        $roles = $this->db->where('id !=', 4)->get('roles')->result_array();
        
        $data = array(
            'title' => 'Edit User',
            'user' => $user,
            'roles' => $roles
        );

        $this->render('users/edit', $data);
    }

    public function delete($id) {
        // Jangan biarkan super_admin menghapus akunnya sendiri
        if ($id == $this->session->userdata('user')['id']) {
            $this->session->set_flashdata('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
            redirect('users');
        }

        $user = $this->db->get_where('users', array('id' => $id, 'role_id !=' => 4))->row_array();
        
        if ($user) {
            $this->db->where('id', $id);
            $this->db->delete('users');
            $this->session->set_flashdata('success', 'User berhasil dihapus.');
        } else {
            $this->session->set_flashdata('error', 'User tidak ditemukan atau tidak dapat dihapus.');
        }

        redirect('users');
    }
}
