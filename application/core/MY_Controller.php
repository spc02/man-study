<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
    protected $user;
    public function __construct() {
        parent::__construct();
        $this->user = $this->session->userdata('user');
        
        // Security Headers
        $this->output->set_header('X-Frame-Options: SAMEORIGIN');
        $this->output->set_header('X-XSS-Protection: 1; mode=block');
        $this->output->set_header('X-Content-Type-Options: nosniff');
    }
    protected function require_login($roles = array()) {
        if (!$this->user) { $this->session->set_flashdata('error', 'Silakan masuk terlebih dahulu.'); redirect('login'); }
        if (isset($this->user['force_change_password']) && $this->user['force_change_password'] == 1) {
            $current_class = strtolower($this->router->fetch_class());
            $current_method = strtolower($this->router->fetch_method());
            if ($current_class !== 'auth' || $current_method !== 'change_password') {
                $this->session->set_flashdata('error', 'Silakan ubah password bawaan Anda demi keamanan.');
                redirect('auth/change_password');
            }
        }
        if ($roles && !in_array($this->user['role_slug'], $roles, TRUE)) show_error('Anda tidak memiliki akses ke halaman ini.', 403, 'Akses ditolak');
    }
    protected function render($view, $data = array()) {
        $data['current_user'] = $this->user;
        $data['title'] = isset($data['title']) ? $data['title'] : 'MAN 1 Magelang Alumni';
        
        $notif = 0;
        if ($this->user) {
            if (in_array($this->user['role_slug'], ['super_admin', 'tu'])) {
                $notif += $this->db->where('verification_status', 'pending')->count_all_results('alumni');
                $notif += $this->db->where('status', 'pending')->count_all_results('legalisir');
            } else if ($this->user['role_slug'] === 'alumni') {
                $a = $this->db->get_where('alumni', ['user_id' => $this->user['id']])->row();
                if ($a) {
                    $notif += $this->db->where('alumni_id', $a->id)->where('status', 'completed')->count_all_results('legalisir');
                }
            }
        }
        $data['notification_count'] = $notif;

        $this->load->view('layouts/header', $data); $this->load->view('layouts/sidebar', $data); $this->load->view($view, $data); $this->load->view('layouts/footer', $data);
    }
    protected function activity($action, $module, $reference_id = NULL) {
        if ($this->user) $this->db->insert('log_activity', array('user_id'=>$this->user['id'], 'action'=>$action, 'module'=>$module, 'reference_id'=>$reference_id, 'ip_address'=>$this->input->ip_address()));
    }
}
