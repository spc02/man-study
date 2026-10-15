<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Legalisir extends MY_Controller {
 public function index() {
        $this->require_login();
        
        if ($this->user['role_slug'] === 'alumni') {
            $a = $this->db->get_where('alumni', array('user_id' => $this->user['id']))->row_array();
            if ($a) {
                $has_tracer = $this->db->get_where('tracer', array('alumni_id' => $a['id'], 'status' => 'submitted'))->num_rows();
                if (!$has_tracer) {
                    $this->session->set_flashdata('error', 'Anda harus mengisi Tracer Study terlebih dahulu sebelum dapat mengajukan Legalisir.');
                    redirect('tracer');
                }
            }
        }
        
        // Setup query builder AFTER get_where calls
        $this->db->select('legalisir.*, alumni.name, legalisir_file.file_path as diploma_file')
                 ->join('alumni', 'alumni.id=legalisir.alumni_id')
                 ->join('legalisir_file', 'legalisir_file.legalisir_id=legalisir.id', 'left');
        if ($this->user['role_slug'] === 'alumni') {
            $this->db->where('alumni.user_id', $this->user['id']);
        }
        
        $this->render('legalisir/index', array(
            'title' => 'Legalisir Ijazah',
            'items' => $this->db->order_by('legalisir.id', 'DESC')->get('legalisir')->result_array()
        ));
    }

    public function create() {
        $this->require_login(array('alumni'));
        $a = $this->db->get_where('alumni', array('user_id' => $this->user['id']))->row();
        
        // Wajib mengisi Tracer Study dulu
        if ($a) {
            $has_tracer = $this->db->get_where('tracer', array('alumni_id' => $a->id, 'status' => 'submitted'))->num_rows();
            if (!$has_tracer) {
                $this->session->set_flashdata('error', 'Anda harus mengisi Tracer Study terlebih dahulu sebelum dapat mengajukan Legalisir.');
                redirect('tracer');
            }
        }
        
        if ($this->input->method(TRUE) === 'POST') {
            $this->form_validation->set_rules('quantity', 'Jumlah', 'required|integer|greater_than[0]');
            if ($this->form_validation->run()) {
                $file = '';
                if (!empty($_FILES['diploma']['name'])) {
                    $config = array('upload_path' => './uploads/legalisir/', 'allowed_types' => 'pdf', 'max_size' => 5120, 'encrypt_name' => TRUE);
                    if (!is_dir($config['upload_path'])) mkdir($config['upload_path'], 0755, TRUE);
                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload('diploma')) {
                        $this->session->set_flashdata('error', $this->upload->display_errors('', ''));
                        redirect('legalisir/create');
                    }
                    $file = $this->upload->data('file_name');
                }
                $this->db->insert('legalisir', array('alumni_id' => $a->id, 'quantity' => (int)$this->input->post('quantity'), 'notes' => $this->input->post('notes', TRUE), 'status' => 'pending'));
                $id = $this->db->insert_id();
                if ($file) $this->db->insert('legalisir_file', array('legalisir_id' => $id, 'file_path' => $file));
                $this->activity('Mengajukan legalisir', 'legalisir', $id);
                $this->session->set_flashdata('success', 'Pengajuan legalisir terkirim.');
                redirect('legalisir');
            }
        }
        $this->render('legalisir/create', array('title' => 'Ajukan Legalisir'));
    }
    public function status($id) {
        $this->require_login(array('super_admin', 'tu'));
        
        if ($this->input->method(TRUE) === 'POST') {
            $status = $this->input->post('status', TRUE);
            if (!in_array($status, array('processing', 'completed', 'rejected'), TRUE)) show_404();
            
            $update_data = array(
                'status' => $status,
                'processed_by' => $this->user['id'],
                'processed_at' => date('Y-m-d H:i:s')
            );

            // Jika status diubah menjadi completed, wajib ada file PDF yang diunggah
            if ($status === 'completed') {
                if (!empty($_FILES['result_file']['name'])) {
                    $config = array(
                        'upload_path' => './uploads/legalisir_results/',
                        'allowed_types' => 'pdf',
                        'max_size' => 5120,
                        'encrypt_name' => TRUE
                    );
                    if (!is_dir($config['upload_path'])) mkdir($config['upload_path'], 0755, TRUE);
                    
                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload('result_file')) {
                        $this->session->set_flashdata('error', $this->upload->display_errors('', ''));
                        redirect('legalisir');
                    }
                    $update_data['result_file'] = $this->upload->data('file_name');
                } else {
                    $this->session->set_flashdata('error', 'File hasil legalisir (PDF) wajib diunggah.');
                    redirect('legalisir');
                }
            }

            $this->db->where('id', (int)$id)->update('legalisir', $update_data);
            $this->activity('Status ' . $status, 'legalisir', $id);
            
            $this->session->set_flashdata('success', 'Status pengajuan berhasil diperbarui.');
        }
        redirect('legalisir');
    }
}
