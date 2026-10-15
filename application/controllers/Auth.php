<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Auth extends MY_Controller {
    public function __construct(){ parent::__construct(); $this->load->model('Auth_model'); }
    public function login(){
        if ($this->user) redirect('dashboard');
        if ($this->input->method(TRUE)==='POST') {
            $this->form_validation->set_rules('identity','Email / Username','required|trim'); $this->form_validation->set_rules('password','Password','required');
            if ($this->form_validation->run()) { 
                $identity = $this->input->post('identity',TRUE);
                $u=$this->Auth_model->login($identity, $this->input->post('password',TRUE));
                if($u){ 
                    unset($u['password']); 
                    $this->session->set_userdata('user',$u); 
                    $this->db->where('id',$u['id'])->update('users',array('last_login'=>date('Y-m-d H:i:s'))); 
                    redirect('dashboard'); 
                }
                
                $this->session->set_flashdata('error','Email/username atau password tidak sesuai.'); redirect('login'); 
            }
        } $this->load->view('auth/login');
    }
    public function change_password() {
        if (!$this->user) redirect('login');
        if ($this->input->method(TRUE) === 'POST') {
            $this->form_validation->set_rules('new_password', 'Password Baru', 'required|min_length[8]');
            $this->form_validation->set_rules('confirm_password', 'Konfirmasi Password', 'required|matches[new_password]');
            if ($this->form_validation->run()) {
                $this->db->where('id', $this->user['id'])->update('users', array(
                    'password' => password_hash($this->input->post('new_password'), PASSWORD_DEFAULT),
                    'force_change_password' => 0
                ));
                $this->user['force_change_password'] = 0;
                $this->session->set_userdata('user', $this->user);
                $this->session->set_flashdata('success', 'Password berhasil diubah.');
                redirect('dashboard');
            }
        }
        $this->load->view('auth/change_password');
    }
    public function register(){
        if($this->input->method(TRUE)==='POST') { $this->form_validation->set_rules('nisn','NISN','required|numeric|exact_length[10]|is_unique[alumni.nisn]'); $this->form_validation->set_rules('name','Nama','required|trim'); $this->form_validation->set_rules('email','Email','required|valid_email|is_unique[users.email]'); $this->form_validation->set_rules('phone','Nomor WA','required'); $this->form_validation->set_rules('password','Password','required|min_length[8]'); $this->form_validation->set_rules('password_confirmation','Konfirmasi password','required|matches[password]');
            if($this->form_validation->run()){ 
                $result = $this->Auth_model->register_alumni($this->input->post(NULL,TRUE)); 
                if ($result) {
                    $this->session->set_flashdata('success','Registrasi berhasil. Akun Anda menunggu verifikasi admin.'); 
                    redirect('login'); 
                } else {
                    $this->session->set_flashdata('error','Registrasi gagal karena sistem.');
                }
            } 
        }
        $this->load->view('auth/register');
    }
    public function logout(){ $this->session->sess_destroy(); redirect('login'); }
}
