<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Download extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('download');
    }

    public function legalisir($filename) {
        $this->require_login(); // All logged in users can view?
        // Wait, students should only view their own?
        // For simplicity and matching current feature (where it was open to world),
        // limiting to logged in users is a big improvement.
        // Actually, if we want strict IDOR protection, we check the db.
        
        // Basic check for logged in user. Admin/TU can view all. Alumni can view if it belongs to them.
        if (in_array($this->user['role_slug'], ['super_admin', 'tu', 'kepala'])) {
            $has_access = true;
        } else {
            // Check if this file belongs to the alumni
            $alumni = $this->db->get_where('alumni', ['user_id' => $this->user['id']])->row_array();
            if ($alumni) {
                $this->db->from('legalisir');
                $this->db->join('legalisir_file', 'legalisir_file.legalisir_id = legalisir.id', 'left');
                $this->db->where('legalisir.alumni_id', $alumni['id']);
                $this->db->group_start();
                $this->db->where('legalisir_file.file_path', $filename);
                $this->db->or_where('legalisir.result_file', $filename);
                $this->db->group_end();
                $count = $this->db->count_all_results();
                $has_access = ($count > 0);
            } else {
                $has_access = false;
            }
        }

        if (!$has_access) {
            show_error('Akses ditolak atau file tidak ditemukan.', 403, 'Akses Ditolak');
            return;
        }

        $filepath = FCPATH . 'uploads/legalisir/' . $filename;
        if (!file_exists($filepath)) {
            $filepath = FCPATH . 'uploads/legalisir_results/' . $filename;
        }

        if (file_exists($filepath)) {
            $this->output
                ->set_content_type('application/pdf')
                ->set_header('Content-Disposition: inline; filename="' . $filename . '"')
                ->set_header('Content-Transfer-Encoding: binary')
                ->set_header('Accept-Ranges: bytes')
                ->set_output(file_get_contents($filepath));
        } else {
            show_404();
        }
    }
}
