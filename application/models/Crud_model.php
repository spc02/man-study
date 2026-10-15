<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Crud_model extends CI_Model {
    public function all($table, $order = 'id DESC') { return $this->db->order_by($order)->get($table)->result_array(); }
    public function find($table, $id) { return $this->db->get_where($table, array('id'=>(int)$id))->row_array(); }
    public function save($table, $data, $id = NULL) { if ($id) { $this->db->where('id',(int)$id)->update($table,$data); return $id; } $this->db->insert($table,$data); return $this->db->insert_id(); }
    public function delete($table, $id) { return $this->db->delete($table, array('id'=>(int)$id)); }
}
