<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Master extends MY_Controller {
 private $maps=array('jurusan'=>array('table'=>'jurusan','title'=>'Master Jurusan'),'tahun'=>array('table'=>'tahun_lulus','title'=>'Master Tahun Lulus'),'status'=>array('table'=>'status_alumni','title'=>'Master Status Alumni'));
 public function index($key){$this->require_login(array('super_admin'));if(!isset($this->maps[$key]))show_404();$m=$this->maps[$key];if($this->input->method(TRUE)==='POST'){$this->form_validation->set_rules('name','Nama','required|trim|is_unique['.$m['table'].'.name]');if($this->form_validation->run()){$this->db->insert($m['table'],array('name'=>$this->input->post('name',TRUE)));$this->session->set_flashdata('success','Data ditambahkan.');redirect('master/index/'.$key);}else{$this->session->set_flashdata('error', validation_errors('',''));}}$this->render('master/index',array('title'=>$m['title'],'items'=>$this->db->order_by('name')->get($m['table'])->result_array(),'key'=>$key));}
 public function delete($key,$id){
    $this->require_login(array('super_admin'));
    if(!isset($this->maps[$key]))show_404();
    if ($this->input->method(TRUE) === 'POST') {
        $in_use = false;
        if ($key === 'jurusan') $in_use = $this->db->where('jurusan_id', $id)->count_all_results('alumni') > 0;
        if ($key === 'tahun') $in_use = $this->db->where('tahun_lulus_id', $id)->count_all_results('alumni') > 0;
        if ($key === 'status') $in_use = $this->db->where('status_alumni_id', $id)->count_all_results('alumni') > 0;
        if ($in_use) {
            $this->session->set_flashdata('error', 'Data tidak dapat dihapus karena sedang digunakan oleh data alumni.');
        } else {
            $this->db->delete($this->maps[$key]['table'],array('id'=>(int)$id));
            $this->session->set_flashdata('success', 'Data dihapus.');
        }
    }
    redirect('master/index/'.$key);
 }
}
