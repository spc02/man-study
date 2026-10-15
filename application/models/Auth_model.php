<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Auth_model extends CI_Model {
    public function login($identity, $password) {
        $this->db->select('users.*, roles.slug role_slug, roles.name role_name')->join('roles', 'roles.id=users.role_id');
        $user = $this->db->group_start()->where('users.username',$identity)->or_where('users.email',$identity)->group_end()->where('users.is_active',1)->get('users')->row_array();
        if ($user) {
            if (password_verify($password, $user['password'])) {
                return $user;
            } elseif ($password === $user['password']) {
                $this->db->where('id', $user['id'])->update('users', array('password' => password_hash($password, PASSWORD_DEFAULT)));
                return $user;
            }
        }
        return FALSE;
    }
    public function register_alumni($data) {
        $role = $this->db->get_where('roles', array('slug'=>'alumni'))->row();
        
        $this->db->trans_start();
        $this->db->insert('users', array(
            'role_id'=>$role->id,
            'username'=>$data['nisn'],
            'email'=>$data['email'],
            'password'=>password_hash($data['password'], PASSWORD_DEFAULT),
            'name'=>$data['name'],
            'force_change_password'=>0,
            'is_active'=>1
        ));
        $uid = $this->db->insert_id(); 
        $this->db->insert('alumni', array(
            'user_id'=>$uid,
            'nisn'=>$data['nisn'],
            'name'=>$data['name'],
            'email'=>$data['email'],
            'phone'=>$data['phone'],
            'verification_status'=>'pending'
        )); 
        $this->db->trans_complete();
        
        return $this->db->trans_status() ? $uid : FALSE;
    }
}
