<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Alumni extends MY_Controller {
 public function __construct(){parent::__construct();$this->load->model('Crud_model');}
 public function index(){ $this->require_login(array('super_admin','tu','kepala')); $this->db->select('alumni.*, jurusan.name jurusan, tahun_lulus.name tahun')->join('jurusan','jurusan.id=alumni.jurusan_id','left')->join('tahun_lulus','tahun_lulus.id=alumni.tahun_lulus_id','left'); $this->render('alumni/index',array('title'=>'Data Alumni','items'=>$this->db->order_by('alumni.id','DESC')->get('alumni')->result_array())); }
 public function verify($id){ 
     $this->require_login(array('super_admin','tu')); 
     if ($this->input->method(TRUE) === 'POST') {
         $status = $this->input->post('status', TRUE);
         if (in_array($status, array('verified', 'rejected'))) {
             $this->db->where('id',(int)$id)->update('alumni',array('verification_status'=>$status)); 
             $this->activity('Verifikasi '.$status,'alumni',$id); 
             $this->session->set_flashdata('success','Status alumni diperbarui.'); 
         }
     }
     redirect('alumni'); 
 }
 public function profile(){ 
     $this->require_login(array('alumni')); 
     $a=$this->db->get_where('alumni',array('user_id'=>$this->user['id']))->row_array(); 
     if($this->input->method(TRUE)==='POST'){ 
         $this->form_validation->set_rules('nik', 'NIK', 'required|numeric');
         $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
         $this->form_validation->set_rules('gender', 'Jenis Kelamin', 'required|in_list[L,P]');
         $this->form_validation->set_rules('phone', 'No. HP', 'required|numeric');
         $this->form_validation->set_rules('birth_place', 'Tempat Lahir', 'required|trim');
         $this->form_validation->set_rules('birth_date', 'Tanggal Lahir', 'required');
         $this->form_validation->set_rules('address', 'Alamat', 'required|trim');
         $this->form_validation->set_rules('jurusan_id', 'Jurusan', 'required|numeric');
         $this->form_validation->set_rules('tahun_lulus_id', 'Tahun Lulus', 'required|numeric');
         $this->form_validation->set_rules('status_alumni_id', 'Status Saat Ini', 'required|numeric');

         if ($this->form_validation->run()) {
             $fields=array('nik','gender','birth_place','birth_date','address','phone','email','jurusan_id','tahun_lulus_id','status_alumni_id'); 
             $data=array();foreach($fields as $f)$data[$f]=$this->input->post($f,TRUE);
             $this->db->where('id',$a['id'])->update('alumni',$data);
             $this->session->set_flashdata('success','Profil diperbarui.');
             redirect('alumni/profile'); 
         } else {
             $this->session->set_flashdata('error', validation_errors(' ', ' '));
         }
     } 
     $this->render('alumni/profile',array('title'=>'Lengkapi Profil','alumni'=>$a,'jurusan'=>$this->Crud_model->all('jurusan','name'),'tahun'=>$this->Crud_model->all('tahun_lulus','name DESC'),'status'=>$this->Crud_model->all('status_alumni','name'))); 
 }
    public function create() {
        $this->require_login(array('super_admin', 'tu'));
        if ($this->input->method(TRUE) === 'POST') {
            $this->form_validation->set_rules('nisn', 'NISN', 'required|trim|exact_length[10]|is_unique[alumni.nisn]');
            $this->form_validation->set_rules('name', 'Nama Lengkap', 'required|trim');
            $this->form_validation->set_rules('jurusan_id', 'Jurusan', 'required|numeric');
            $this->form_validation->set_rules('tahun_lulus_id', 'Tahun Lulus', 'required|numeric');

            if ($this->form_validation->run()) {
                $nisn = $this->input->post('nisn', TRUE);
                $name = $this->input->post('name', TRUE);
                
                $random_password = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 8);
                
                $this->db->trans_start();
                
                // Insert user
                $user_data = array(
                    'role_id' => 4,
                    'username' => $nisn,
                    'password' => password_hash($random_password, PASSWORD_DEFAULT),
                    'force_change_password' => 1,
                    'name' => $name,
                    'is_active' => 1
                );
                $this->db->insert('users', $user_data);
                $user_id = $this->db->insert_id();

                // Insert alumni
                $alumni_data = array(
                    'user_id' => $user_id,
                    'nisn' => $nisn,
                    'name' => $name,
                    'jurusan_id' => $this->input->post('jurusan_id', TRUE),
                    'tahun_lulus_id' => $this->input->post('tahun_lulus_id', TRUE),
                    'verification_status' => 'verified'
                );
                $this->db->insert('alumni', $alumni_data);
                
                $this->db->trans_complete();

                if ($this->db->trans_status() === FALSE) {
                    $this->session->set_flashdata('error', 'Gagal menambahkan data alumni.');
                } else {
                    // Simpan raw password di flashdata untuk ditampilkan hanya sekali
                    $this->session->set_flashdata('success', 'Alumni berhasil ditambahkan. Username: ' . $nisn . ' | Password: ' . $random_password);
                }
                redirect('alumni');
            }
        }

        $data = array(
            'title' => 'Tambah Data Alumni',
            'jurusan' => $this->Crud_model->all('jurusan', 'name'),
            'tahun' => $this->Crud_model->all('tahun_lulus', 'name DESC')
        );
        $this->render('alumni/create', $data);
    }

    public function import() {
        $this->require_login(array('super_admin', 'tu'));
        if (isset($_FILES['file']['name']) && $_FILES['file']['name'] != "") {
            $path = $_FILES['file']['tmp_name'];
            $file = fopen($path, "r");
            
            $is_header = true;
            $success = 0;
            $failed = 0;

            $this->db->trans_start();

            while (($row = fgetcsv($file, 10000, ",")) !== FALSE) {
                if ($is_header) {
                    $is_header = false;
                    continue;
                }

                // CSV Format: NISN, Nama Lengkap, ID Jurusan, ID Tahun Lulus
                if(count($row) >= 4) {
                    $nisn = trim($row[0]);
                    $name = trim($row[1]);
                    $jurusan_id = trim($row[2]);
                    $tahun_id = trim($row[3]);

                    // Check if NISN already exists
                    if (strlen($nisn) == 10 && $this->db->get_where('alumni', array('nisn' => $nisn))->num_rows() == 0) {
                        $random_password = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 8);
                        
                        $user_data = array(
                            'role_id' => 4,
                            'username' => $nisn,
                            'password' => password_hash($random_password, PASSWORD_DEFAULT),
                            'force_change_password' => 1,
                            'name' => $name,
                            'is_active' => 1
                        );
                        $this->db->insert('users', $user_data);
                        $user_id = $this->db->insert_id();

                        $alumni_data = array(
                            'user_id' => $user_id,
                            'nisn' => $nisn,
                            'name' => $name,
                            'jurusan_id' => $jurusan_id,
                            'tahun_lulus_id' => $tahun_id,
                            'verification_status' => 'verified'
                        );
                        $this->db->insert('alumni', $alumni_data);
                        $success++;
                    } else {
                        $failed++;
                    }
                }
            }
            fclose($file);
            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE) {
                $this->session->set_flashdata('error', 'Terjadi kesalahan sistem saat mengimpor data.');
            } else {
                $this->session->set_flashdata('success', "$success data berhasil diimpor. $failed data gagal/duplikat.");
            }
        } else {
            $this->session->set_flashdata('error', 'Silakan pilih file CSV terlebih dahulu.');
        }
        redirect('alumni');
    }

    public function credentials() {
        $this->require_login(array('super_admin', 'tu'));
        
        // Fetch alumni data with usernames
        $this->db->select('alumni.nisn, alumni.name, users.username');
        $this->db->from('alumni');
        $this->db->join('users', 'users.id = alumni.user_id');
        
        // Optional filter by year
        if ($this->input->get('tahun_id')) {
            $this->db->where('alumni.tahun_lulus_id', $this->input->get('tahun_id'));
        }
        
        $this->db->order_by('alumni.id', 'DESC');
        $alumni = $this->db->get()->result_array();

        $data = array(
            'title' => 'Cetak Akun Alumni',
            'alumni' => $alumni
        );

        $this->load->view('alumni/credentials', $data);
    }
}
