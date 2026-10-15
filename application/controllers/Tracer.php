<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Tracer extends MY_Controller {
 public function __construct(){parent::__construct();$this->load->model('Crud_model');}
    public function index() {
        $this->require_login();
        if ($this->user['role_slug'] === 'alumni') {
            return $this->form();
        }
        $this->db->select('tracer.*, alumni.name')->join('alumni', 'alumni.id=tracer.alumni_id');
        $this->render('tracer/index', array('title' => 'Tracer Study', 'items' => $this->db->get('tracer')->result_array()));
    }

    public function detail($id) {
        $this->require_login(array('super_admin', 'tu', 'kepala'));
        
        $this->db->select('tracer.*, alumni.name, alumni.nisn, alumni.nik, tahun_lulus.name as graduation_year');
        $this->db->join('alumni', 'alumni.id=tracer.alumni_id');
        $this->db->join('tahun_lulus', 'tahun_lulus.id=alumni.tahun_lulus_id', 'left');
        $tracer = $this->db->get_where('tracer', array('tracer.id' => $id))->row_array();
        
        if (!$tracer) {
            show_404();
        }

        $existing_answers = array();
        $jawabans = $this->db->get_where('jawaban', array('tracer_id' => $tracer['id']))->result_array();
        foreach ($jawabans as $j) {
            $existing_answers[$j['pertanyaan_id']] = $j['answer'];
        }

        $q = $this->db->where('is_active', 1)->order_by('sort_order')->get('pertanyaan')->result_array();
        $grouped = array();
        foreach($q as $x) {
            $cat = empty($x['category']) ? 'Umum' : $x['category'];
            $grouped[$cat][] = $x;
        }

        $this->render('tracer/detail', array(
            'title' => 'Detail Tracer Study - ' . $tracer['name'],
            'tracer' => $tracer,
            'grouped_questions' => $grouped,
            'existing_answers' => $existing_answers
        ));
    }


    public function form() {
        $this->require_login(array('alumni'));
        $a = $this->db->get_where('alumni', array('user_id' => $this->user['id']))->row_array();
        
        $tracer = $this->db->get_where('tracer', array('alumni_id' => $a['id']))->row_array();
        $existing_answers = array();
        if ($tracer) {
            $jawabans = $this->db->get_where('jawaban', array('tracer_id' => $tracer['id']))->result_array();
            foreach ($jawabans as $j) {
                $existing_answers[$j['pertanyaan_id']] = $j['answer'];
            }
        }

        $q = $this->db->where('is_active', 1)->order_by('sort_order')->get('pertanyaan')->result_array();
        
        $grouped = array();
        foreach($q as $x) {
            $cat = empty($x['category']) ? 'Umum' : $x['category'];
            $grouped[$cat][] = $x;
        }
        
        if ($this->input->method(TRUE) === 'POST') {
            $this->db->replace('tracer', array('alumni_id' => $a['id'], 'status' => 'submitted', 'submitted_at' => date('Y-m-d H:i:s')));
            $tid = $this->db->get_where('tracer', array('alumni_id' => $a['id']))->row()->id;
            
            // Hapus jawaban lama jika ada untuk menghindari data yatim piatu
            $this->db->where('tracer_id', $tid)->delete('jawaban');

            foreach ($q as $x) {
                $v = $this->input->post('q_' . $x['id'], TRUE);
                if ($v !== NULL && $v !== '') {
                    $this->db->replace('jawaban', array('tracer_id' => $tid, 'pertanyaan_id' => $x['id'], 'answer' => is_array($v) ? implode(', ', $v) : $v));
                }
            }
            
            $this->activity($tracer ? 'Memperbarui tracer' : 'Mengisi tracer', 'tracer', $tid);
            $this->session->set_flashdata('success', $tracer ? 'Tracer study berhasil diperbarui.' : 'Tracer study berhasil dikirim.');
            redirect('tracer');
        }
        
        $this->render('tracer/form', array(
            'title' => $tracer ? 'Perbarui Tracer Study' : 'Isi Tracer Study', 
            'grouped_questions' => $grouped,
            'existing_answers' => $existing_answers,
            'is_update' => !!$tracer
        ));
    }

    public function questions() {
        $this->require_login(array('super_admin'));
        if ($this->input->method(TRUE) === 'POST') {
            $data = array(
                'question' => $this->input->post('question', TRUE),
                'type' => $this->input->post('type', TRUE),
                'options' => $this->input->post('options', TRUE),
                'sort_order' => (int)$this->input->post('sort_order'),
                'category' => $this->input->post('category', TRUE),
                'parent_id' => $this->input->post('parent_id') ? (int)$this->input->post('parent_id') : NULL,
                'parent_value' => $this->input->post('parent_value', TRUE),
                'question_key' => $this->input->post('question_key', TRUE)
            );
            $this->Crud_model->save('pertanyaan', $data);
            redirect('tracer/questions');
        }
        $this->render('tracer/questions', array('title' => 'Pertanyaan Tracer', 'items' => $this->Crud_model->all('pertanyaan', 'sort_order')));
    }

    public function dashboard() {
        $this->require_login(array('super_admin', 'tu'));
        
        $count_by_key = function($key) {
            $q = $this->db->get_where('pertanyaan', ['question_key' => $key])->row();
            if (!$q) return [];
            
            $res = $this->db->select('answer, COUNT(*) as total')
                ->where('pertanyaan_id', $q->id)
                ->where('answer !=', '')
                ->group_by('answer')
                ->get('jawaban')->result_array();
                
            $data = [];
            foreach($res as $r) {
                $data[$r['answer']] = (int)$r['total'];
            }
            return $data;
        };

        $avg_by_key = function($key) {
            $q = $this->db->get_where('pertanyaan', ['question_key' => $key])->row();
            if (!$q) return 0;
            
            // Extract the first number from string e.g. "5 (Sangat Baik)" -> 5
            $res = $this->db->select('AVG(CAST(SUBSTRING_INDEX(answer, " ", 1) AS UNSIGNED)) as avg_val')
                ->where('pertanyaan_id', $q->id)
                ->where('answer !=', '')
                ->get('jawaban')->row();
            return $res ? round((float)$res->avg_val, 2) : 0;
        };

        $data = [
            'title' => 'Dashboard Analitik Tracer Study',
            'uni_type' => $count_by_key('uni_type'),
            'uni_path_ptn' => $count_by_key('uni_path_ptn'),
            'job_industry' => $count_by_key('job_industry'),
            'job_salary' => $count_by_key('job_salary'),
            'job_wait_time' => $count_by_key('job_wait_time'),
            'job_relevance' => $count_by_key('job_relevance'),
            'biz_field' => $count_by_key('biz_field'),
            'biz_turnover' => $count_by_key('biz_turnover'),
            'eval_relevance' => $avg_by_key('eval_relevance'),
            'eval_teacher' => $avg_by_key('eval_teacher'),
            'eval_facility' => $avg_by_key('eval_facility'),
            'eval_admin' => $avg_by_key('eval_admin'),
            'eval_prep' => $avg_by_key('eval_prep'),
            'eval_satisfaction' => $avg_by_key('eval_satisfaction'),
        ];
        
        $this->render('tracer/dashboard', $data);
    }

    public function export_excel() {
        $this->require_login(array('super_admin', 'tu'));
        
        $questions = $this->db->where('is_active', 1)->order_by('sort_order')->get('pertanyaan')->result_array();
        
        $this->db->select('tracer.*, alumni.name, alumni.nisn, tahun_lulus.name as graduation_year');
        $this->db->join('alumni', 'alumni.id=tracer.alumni_id');
        $this->db->join('tahun_lulus', 'tahun_lulus.id=alumni.tahun_lulus_id', 'left');
        $this->db->order_by('tracer.submitted_at', 'DESC');
        $tracers = $this->db->get('tracer')->result_array();
        
        $filename = "Data_Tracer_Study_" . date('Y-m-d') . ".csv";
        
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        
        $output = fopen('php://output', 'w');
        // UTF-8 BOM for Excel to read characters properly
        fputs($output, "\xEF\xBB\xBF");
        
        $headers = array('Nama Alumni', 'NISN', 'Tahun Lulus', 'Tanggal Isi');
        foreach ($questions as $q) {
            $headers[] = $q['question'];
        }
        fputcsv($output, $headers);
        
        foreach ($tracers as $t) {
            $answers = $this->db->get_where('jawaban', array('tracer_id' => $t['id']))->result_array();
            $ans_map = array();
            foreach ($answers as $a) {
                $ans_map[$a['pertanyaan_id']] = $a['answer'];
            }
            
            $row = array(
                $t['name'], 
                $t['nisn'], 
                $t['graduation_year'], 
                $t['submitted_at']
            );
            
            foreach ($questions as $q) {
                $row[] = isset($ans_map[$q['id']]) ? $ans_map[$q['id']] : '';
            }
            fputcsv($output, $row);
        }
        fclose($output);
        exit;
    }
}
