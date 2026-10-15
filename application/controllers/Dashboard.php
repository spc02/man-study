<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

    public function index() {
        $this->require_login();
        
        if ($this->user['role_slug'] === 'alumni') {
            return $this->alumni();
        }
        
        $d = array(
            'title' => 'Dashboard',
            'stats' => array(
                'total_alumni' => $this->db->count_all('alumni'),
                'total_tracer' => $this->db->count_all('tracer'),
                'total_legalisir' => $this->db->count_all('legalisir'),
                'total_pengguna' => $this->db->count_all('users')
            )
        );
        
        $d['years'] = $this->db->select('tahun_lulus.name label, COUNT(alumni.id) total')
            ->join('alumni', 'alumni.tahun_lulus_id=tahun_lulus.id', 'left')
            ->group_by('tahun_lulus.id')
            ->order_by('tahun_lulus.name')
            ->get('tahun_lulus')->result_array();
            
        $d['status'] = $this->db->select('status_alumni.name label, COUNT(alumni.id) total')
            ->join('alumni', 'alumni.status_alumni_id=status_alumni.id', 'left')
            ->group_by('status_alumni.id')
            ->get('status_alumni')->result_array();

        // -------------------------------------------------------------
        // Tracer Study Analytics (Optimized)
        // -------------------------------------------------------------
        
        $keys = ['uni_type', 'uni_path_ptn', 'job_industry', 'job_salary', 'job_wait_time', 'job_relevance', 'biz_field', 'biz_turnover'];
        $avg_keys = ['eval_relevance', 'eval_teacher', 'eval_facility', 'eval_admin', 'eval_prep', 'eval_satisfaction'];
        
        foreach ($keys as $k) $d[$k] = [];
        foreach ($avg_keys as $k) $d[$k] = 0;
        
        $questions = $this->db->where('question_key IS NOT NULL')->where('is_active', 1)->get('pertanyaan')->result_array();
        $q_map = [];
        foreach ($questions as $q) {
            $q_map[$q['id']] = $q['question_key'];
        }
        
        if (!empty($q_map)) {
            $q_ids = array_keys($q_map);
            
            // 1 Query to count all answers
            $res = $this->db->select('pertanyaan_id, answer, COUNT(*) as total')
                ->where_in('pertanyaan_id', $q_ids)
                ->where('answer !=', '')
                ->group_by('pertanyaan_id, answer')
                ->get('jawaban')->result_array();
                
            foreach ($res as $r) {
                $k = $q_map[$r['pertanyaan_id']];
                if (in_array($k, $keys)) {
                    $d[$k][$r['answer']] = (int)$r['total'];
                }
            }
            
            // 1 Query to average all answers
            $avg_res = $this->db->select('pertanyaan_id, AVG(CAST(SUBSTRING_INDEX(answer, " ", 1) AS UNSIGNED)) as avg_val')
                ->where_in('pertanyaan_id', $q_ids)
                ->where('answer !=', '')
                ->group_by('pertanyaan_id')
                ->get('jawaban')->result_array();
                
            foreach ($avg_res as $r) {
                $k = $q_map[$r['pertanyaan_id']];
                if (in_array($k, $avg_keys)) {
                    $d[$k] = round((float)$r['avg_val'], 2);
                }
            }
        }

        $this->render('dashboard/admin', $d);
    }

    private function alumni() {
        $a = $this->db->get_where('alumni', array('user_id' => $this->user['id']))->row_array();
        
        $d = array(
            'title' => 'Dashboard Alumni',
            'alumni' => $a,
            'tracer' => $a ? $this->db->get_where('tracer', array('alumni_id' => $a['id']))->row_array() : NULL,
            'legalisir' => $a ? $this->db->order_by('id', 'DESC')->get_where('legalisir', array('alumni_id' => $a['id']))->result_array() : array()
        );
        
        $this->render('dashboard/alumni', $d);
    }
}
