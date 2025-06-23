<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Pelamar
 * @property CI_Session $session
 * @property CI_Input $input
 * @property CI_Upload $upload
 * @property CI_Form_validation $form_validation
 * @property CI_Security $security
 * @property CI_DB_query_builder $db
 * @property CI_Output $output
 * @property Model_Pengguna $model_pengguna
 * @property Model_Pelamar $model_pelamar
 * @property Model_Lowongan $model_lowongan
 * @property Model_Lamaran $model_lamaran
 * @property Model_Penilaian $model_penilaian
 * @property Model_Dokumen $model_dokumen
 * @property Model_Notifikasi $model_notifikasi
 */
class Pelamar extends CI_Controller {

    public function __construct() {
        parent::__construct();

        
        if (!$this->session->userdata('logged_in') || $this->session->userdata('role') != 'pelamar') {
            redirect('auth');
        }

        
        $this->load->model('model_pengguna');
        $this->load->model('model_pelamar');
        $this->load->model('model_lowongan');
        $this->load->model('model_lamaran');
        $this->load->model('model_penilaian');
        $this->load->model('model_dokumen');
        $this->load->model('model_notifikasi');

        
        $this->load->library('upload');
        $this->load->library('form_validation');

        
        if (!is_dir('./uploads/documents')) {
            mkdir('./uploads/documents', 0777, TRUE);
        }
    }

    public function index() {
        redirect('pelamar/dasbor');
    }

    public function dasbor() {
        
        $user_id = $this->session->userdata('user_id');
        $data['applications'] = $this->model_lamaran->dapatkan_lamaran_pelamar($user_id);

        
        $data['recommended_jobs'] = $this->model_lowongan->dapatkan_lowongan_rekomendasi($user_id, 5);

        
        $data['profile_completion'] = $this->model_pelamar->dapatkan_persentase_kelengkapan_profil($user_id);

        
        $data['title'] = 'Dasbor Pelamar';
        $this->load->view('templates/applicant_header', $data);
        $this->load->view('pelamar/dasbor', $data);
        $this->load->view('templates/applicant_footer');
    }

    public function profil() {
        
        $user_id = $this->session->userdata('user_id');
        $data['user'] = $this->model_pengguna->dapatkan_pengguna($user_id);
        $data['profile'] = $this->model_pelamar->dapatkan_profil($user_id);
        $data['documents'] = $this->model_dokumen->dapatkan_dokumen_pelamar($user_id);

        
        $default_docs = $this->model_dokumen->dapatkan_dokumen_default();
        $data['document_types'] = [];
        foreach ($default_docs as $doc) {
            $data['document_types'][$doc['jenis_dokumen']] = $doc;
        }

        
        $data['profile_completion'] = $this->model_pelamar->dapatkan_persentase_kelengkapan_profil($user_id);

        
        $this->form_validation->set_rules('full_name', 'Nama Lengkap', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('phone', 'Telepon', 'trim|required');
        $this->form_validation->set_rules('address', 'Alamat', 'trim|required');
        $this->form_validation->set_rules('date_of_birth', 'Tanggal Lahir', 'trim|required');
        $this->form_validation->set_rules('gender', 'Jenis Kelamin', 'trim|required');
        $this->form_validation->set_rules('education', 'Pendidikan', 'trim|required');
        $this->form_validation->set_rules('experience', 'Pengalaman', 'trim|required');
        $this->form_validation->set_rules('skills', 'Keahlian', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            
            $data['title'] = 'Profil Saya';
            $this->load->view('templates/applicant_header', $data);
            $this->load->view('pelamar/profil', $data);
            $this->load->view('templates/applicant_footer');
        } else {
            
            $user_data = array(
                'nama_lengkap' => $this->input->post('full_name'),
                'email' => $this->input->post('email'),
                'telepon' => $this->input->post('phone'),
                'alamat' => $this->input->post('address')
            );

            $profile_data = array(
                'tanggal_lahir' => $this->input->post('date_of_birth'),
                'jenis_kelamin' => $this->input->post('gender'),
                'pendidikan' => $this->input->post('education'),
                'pengalaman' => $this->input->post('experience'),
                'keahlian' => $this->input->post('skills'),
                'url_linkedin' => $this->input->post('linkedin_url'),
                'url_portofolio' => $this->input->post('portfolio_url')
            );

            
            if (!empty($_FILES['resume']['name'])) {
                
                $upload_path_full = FCPATH . 'uploads/cv/';
                if (!is_dir($upload_path_full)) {
                    mkdir($upload_path_full, 0777, true);
                }

                $config['upload_path'] = 'uploads/cv';
                $config['allowed_types'] = 'pdf|doc|docx';
                $config['max_size'] = 2048; 
                $config['file_name'] = 'cv_' . $user_id . '_' . time();
                $config['encrypt_name'] = FALSE;

                $this->upload->initialize($config);

                if ($this->upload->do_upload('resume')) {
                    $upload_data = $this->upload->data();
                    $profile_data['cv'] = $upload_data['file_name'];

                    
                    $document_data = [
                        'id_pengguna' => $user_id,
                        'jenis_dokumen' => 'cv',
                        'nama_dokumen' => 'Curriculum Vitae (CV)',
                        'nama_file' => $upload_data['file_name'],
                        'ukuran_file' => $upload_data['file_size'],
                        'tipe_file' => $upload_data['file_type']
                    ];

                    
                    $existing_doc = $this->model_dokumen->dapatkan_dokumen_pelamar_by_jenis($user_id, 'cv');
                    if ($existing_doc) {
                        $this->model_dokumen->perbarui_dokumen_pelamar($existing_doc->id, $document_data);
                    } else {
                        $this->model_dokumen->tambah_dokumen_pelamar($document_data);
                    }
                } else {
                    $this->session->set_flashdata('error', 'Gagal mengunggah CV: ' . $this->upload->display_errors());
                    redirect('pelamar/profil');
                }
            }

            
            if ($_FILES['profile_picture']['name']) {
                
                $upload_path_full = FCPATH . 'uploads/profile_pictures/';
                if (!is_dir($upload_path_full)) {
                    mkdir($upload_path_full, 0777, true);
                }

                $config['upload_path'] = 'uploads/profile_pictures';
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['max_size'] = 1024; 
                $config['file_name'] = 'profile_' . $user_id . '_' . time();

                $this->upload->initialize($config);

                if ($this->upload->do_upload('profile_picture')) {
                    $upload_data = $this->upload->data();
                    $user_data['foto_profil'] = $upload_data['file_name'];
                } else {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('pelamar/profil');
                }
            }

            
            $default_docs = $this->model_dokumen->dapatkan_dokumen_default();
            foreach ($default_docs as $doc_type) {
                $field_name = 'document_' . $doc_type['jenis_dokumen'];

                
                if ($doc_type['jenis_dokumen'] == 'cv') {
                    continue;
                }

                if ($_FILES[$field_name]['name']) {
                    
                    $upload_path_full = FCPATH . 'uploads/documents/';
                    if (!is_dir($upload_path_full)) {
                        mkdir($upload_path_full, 0777, true);
                    }

                    $config = [
                        'upload_path' => 'uploads/documents',
                        'allowed_types' => $doc_type['format_diizinkan'],
                        'max_size' => $doc_type['ukuran_maksimal'],
                        'file_name' => $doc_type['jenis_dokumen'] . '_' . $user_id . '_' . time()
                    ];

                    $this->upload->initialize($config);

                    if ($this->upload->do_upload($field_name)) {
                        $upload_data = $this->upload->data();

                        
                        $document_data = [
                            'id_pengguna' => $user_id,
                            'jenis_dokumen' => $doc_type['jenis_dokumen'],
                            'nama_dokumen' => $doc_type['nama_dokumen'],
                            'nama_file' => $upload_data['file_name'],
                            'ukuran_file' => $upload_data['file_size'],
                            'tipe_file' => $upload_data['file_type']
                        ];

                        
                        $existing_doc = $this->model_dokumen->dapatkan_dokumen_pelamar_by_jenis($user_id, $doc_type['jenis_dokumen']);
                        if ($existing_doc) {
                            
                            if (file_exists(FCPATH . 'uploads/documents/' . $existing_doc->nama_file)) {
                                unlink(FCPATH . 'uploads/documents/' . $existing_doc->nama_file);
                            }
                            $this->model_dokumen->perbarui_dokumen_pelamar($existing_doc->id, $document_data);
                        } else {
                            $this->model_dokumen->tambah_dokumen_pelamar($document_data);
                        }
                    } else {
                        $this->session->set_flashdata('error', $doc_type['nama_dokumen'] . ': ' . $this->upload->display_errors('', ''));
                    }
                }
            }

            
            $this->model_pengguna->perbarui_pengguna($user_id, $user_data);
            $this->model_pelamar->perbarui_profil($user_id, $profile_data);

            
            $this->session->set_userdata('full_name', $user_data['nama_lengkap']);
            $this->session->set_userdata('email', $user_data['email']);

            
            $this->session->set_flashdata('success', 'Profil berhasil diperbarui.');
            redirect('pelamar/profil');
        }
    }

    public function lamaran() {
        
        $user_id = $this->session->userdata('user_id');
        $data['applications'] = $this->model_lamaran->dapatkan_lamaran_pelamar($user_id);

        
        $data['title'] = 'Lamaran Saya';
        $this->load->view('templates/applicant_header', $data);
        $this->load->view('pelamar/lamaran', $data);
        $this->load->view('templates/applicant_footer');
    }

    public function lamar($job_id) {
        
        $data['job'] = $this->model_lowongan->dapatkan_lowongan($job_id);

        
        if (!$data['job'] || $data['job']->status != 'aktif') {
            show_404();
        }

        
        $user_id = $this->session->userdata('user_id');
        if ($this->model_lamaran->sudah_melamar($user_id, $job_id)) {
            $this->session->set_flashdata('error', 'Anda sudah melamar untuk lowongan ini.');
            redirect('lowongan/detail/' . $job_id);
        }

        
        $data['profile'] = $this->model_pelamar->dapatkan_profil($user_id);

        
        $data['documents'] = $this->model_dokumen->dapatkan_dokumen_pelamar($user_id);

        
        $data['document_requirements'] = $this->model_dokumen->dapatkan_dokumen_lowongan($job_id);

        
        $this->form_validation->set_rules('cover_letter', 'Surat Lamaran', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            
            $data['title'] = 'Lamar Lowongan';
            $this->load->view('templates/applicant_header', $data);
            $this->load->view('pelamar/lamar', $data);
            $this->load->view('templates/applicant_footer');
        } else {
            
            $application_data = array(
                'id_pekerjaan' => $job_id,
                'id_pelamar' => $user_id,
                'surat_lamaran' => $this->input->post('cover_letter')
            );

            
            if ($_FILES['resume']['name']) {
                
                $upload_path_full = FCPATH . 'uploads/cv/';
                if (!is_dir($upload_path_full)) {
                    mkdir($upload_path_full, 0777, true);
                }

                $config['upload_path'] = realpath($upload_path_full) . '/';
                $config['allowed_types'] = 'pdf|doc|docx';
                $config['max_size'] = 2048; 
                $config['file_name'] = 'cv_' . $user_id . '_' . time();

                $this->upload->initialize($config);

                if ($this->upload->do_upload('resume')) {
                    $upload_data = $this->upload->data();
                    $application_data['cv'] = $upload_data['file_name'];
                } else {
                    $this->session->set_flashdata('error', 'Gagal mengunggah CV: ' . $this->upload->display_errors());
                    redirect('pelamar/lamar/' . $job_id);
                }
            } else if ($data['profile']->cv) {
                
                $application_data['cv'] = $data['profile']->cv;
            } else {
                
                $cv_required = false;
                foreach ($data['document_requirements'] as $req) {
                    if ($req->jenis_dokumen == 'cv' && $req->wajib == 1) {
                        $cv_required = true;
                        break;
                    }
                }

                if ($cv_required) {
                    $this->session->set_flashdata('error', 'Silakan unggah CV Anda.');
                    redirect('pelamar/lamar/' . $job_id);
                }
            }

            
            $application_id = $this->model_lamaran->tambah_lamaran($application_data);

            if ($application_id) {
                
                $upload_errors = [];
                $missing_required_docs = [];

                
                if (!empty($data['document_requirements'])) {
                    foreach ($data['document_requirements'] as $req) {
                        $field_name = 'document_' . $req->id;
                        $use_existing_cv_field = 'use_existing_cv_' . $req->id;

                        
                        if ($req->jenis_dokumen == 'cv' && $data['profile']->cv && $this->input->post($use_existing_cv_field) == '1') {
                            
                            $document_data = [
                                'id_lamaran' => $application_id,
                                'id_dokumen_lowongan' => $req->id,
                                'jenis_dokumen' => $req->jenis_dokumen,
                                'nama_file' => $data['profile']->cv,
                                'ukuran_file' => 0, 
                                'tipe_file' => 'application/pdf' 
                            ];

                            $this->model_dokumen->tambah_dokumen_lamaran($document_data);
                            continue; 
                        }

                        
                        $use_existing_doc_field = 'use_existing_doc_' . $req->id;
                        if ($this->input->post($use_existing_doc_field)) {
                            $existing_doc_id = $this->input->post($use_existing_doc_field);
                            $existing_doc = $this->model_dokumen->dapatkan_dokumen_pelamar_by_id($existing_doc_id);

                            if ($existing_doc && $existing_doc->id_pengguna == $user_id) {
                                
                                $document_data = [
                                    'id_lamaran' => $application_id,
                                    'id_dokumen_lowongan' => $req->id,
                                    'jenis_dokumen' => $req->jenis_dokumen,
                                    'nama_file' => $existing_doc->nama_file,
                                    'ukuran_file' => $existing_doc->ukuran_file,
                                    'tipe_file' => $existing_doc->tipe_file
                                ];

                                $this->model_dokumen->tambah_dokumen_lamaran($document_data);
                                continue; 
                            }
                        }

                        
                        if (isset($_FILES[$field_name]) && $_FILES[$field_name]['name']) {
                            
                            $upload_path_full = FCPATH . 'uploads/documents/';
                            if (!is_dir($upload_path_full)) {
                                mkdir($upload_path_full, 0777, true);
                            }

                            $config = [
                                'upload_path' => 'uploads/documents',
                                'allowed_types' => $req->format_diizinkan,
                                'max_size' => $req->ukuran_maksimal,
                                'file_name' => $req->jenis_dokumen . '_' . $user_id . '_' . time()
                            ];

                            $this->upload->initialize($config);

                            if ($this->upload->do_upload($field_name)) {
                                $upload_data = $this->upload->data();

                                
                                $document_data = [
                                    'id_lamaran' => $application_id,
                                    'id_dokumen_lowongan' => $req->id,
                                    'jenis_dokumen' => $req->jenis_dokumen,
                                    'nama_file' => $upload_data['file_name'],
                                    'ukuran_file' => $upload_data['file_size'],
                                    'tipe_file' => $upload_data['file_type']
                                ];

                                $this->model_dokumen->tambah_dokumen_lamaran($document_data);
                            } else {
                                $upload_errors[] = $req->nama_dokumen . ': ' . $this->upload->display_errors('', '');
                            }
                        } else if ($req->wajib == 1) {
                            
                            
                            if (!($req->jenis_dokumen == 'cv' && $data['profile']->cv && $this->input->post($use_existing_cv_field) == '1')) {
                                $missing_required_docs[] = $req->nama_dokumen;
                            }
                        }
                    }
                }

                
                if (!empty($missing_required_docs)) {
                    
                    $this->model_lamaran->hapus_lamaran($application_id);

                    $this->session->set_flashdata('error', 'Dokumen wajib berikut belum diunggah: ' . implode(', ', $missing_required_docs));
                    redirect('pelamar/lamar/' . $job_id);
                }

                
                if (!empty($upload_errors)) {
                    
                    $this->model_lamaran->hapus_lamaran($application_id);

                    $this->session->set_flashdata('error', 'Terjadi kesalahan saat mengunggah dokumen: ' . implode('; ', $upload_errors));
                    redirect('pelamar/lamar/' . $job_id);
                }

                
                $this->buat_notifikasi_lamaran_baru($application_id);

                
                $this->session->set_flashdata('success', 'Lamaran Anda berhasil dikirim.');
                redirect('pelamar/lamaran');
            } else {
                
                $this->session->set_flashdata('error', 'Gagal mengirim lamaran. Silakan coba lagi.');
                redirect('pelamar/lamar/' . $job_id);
            }
        }
    }

    public function detail_lamaran($id) {
        
        $user_id = $this->session->userdata('user_id');
        $data['application'] = $this->model_lamaran->dapatkan_lamaran($id);

        
        if (!$data['application'] || $data['application']->id_pelamar != $user_id) {
            show_404();
        }

        
        $data['job'] = $this->model_lowongan->dapatkan_lowongan($data['application']->id_pekerjaan);

        
        $data['assessments'] = $this->model_penilaian->dapatkan_penilaian_pelamar($id);

        
        $data['documents'] = $this->model_dokumen->dapatkan_dokumen_lamaran($id);

        
        $data['title'] = 'Detail Lamaran';
        $this->load->view('templates/applicant_header', $data);
        $this->load->view('pelamar/detail_lamaran', $data);
        $this->load->view('templates/applicant_footer');
    }

    
    public function download_dokumen($id) {
        
        $document = $this->model_dokumen->dapatkan_dokumen_lamaran_by_id($id);

        
        if (!$document) {
            show_404();
        }

        
        $user_id = $this->session->userdata('user_id');
        $application = $this->model_lamaran->dapatkan_lamaran($document->id_lamaran);

        if (!$application || $application->id_pelamar != $user_id) {
            show_404();
        }

        
        $file_path = '';
        if ($document->jenis_dokumen == 'cv') {
            $file_path = './uploads/cv/' . $document->nama_file;
        } else {
            $file_path = './uploads/documents/' . $document->nama_file;
        }

        
        if (!file_exists($file_path)) {
            $this->session->set_flashdata('error', 'File dokumen tidak ditemukan.');
            redirect('pelamar/detail_lamaran/' . $document->id_lamaran);
        }

        
        $file_info = pathinfo($file_path);
        $file_name = $document->jenis_dokumen . '_' . time() . '.' . $file_info['extension'];

        
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . $file_name . '"');
        header('Content-Length: ' . filesize($file_path));
        readfile($file_path);
        exit;
    }

    
    public function download_dokumen_pelamar($id) {
        
        $document = $this->model_dokumen->dapatkan_dokumen_pelamar_by_id($id);

        
        if (!$document) {
            show_404();
        }

        
        $user_id = $this->session->userdata('user_id');
        if ($document->id_pengguna != $user_id) {
            show_404();
        }

        
        $file_path = '';
        if ($document->jenis_dokumen == 'cv') {
            $file_path = './uploads/cv/' . $document->nama_file;
        } else {
            $file_path = './uploads/documents/' . $document->nama_file;
        }

        
        if (!file_exists($file_path)) {
            $this->session->set_flashdata('error', 'File dokumen tidak ditemukan.');
            redirect('pelamar/profil');
        }

        
        $file_info = pathinfo($file_path);
        $file_name = $document->jenis_dokumen . '_' . time() . '.' . $file_info['extension'];

        
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . $file_name . '"');
        header('Content-Length: ' . filesize($file_path));
        readfile($file_path);
        exit;
    }

    
    public function hapus_dokumen_pelamar($id) {
        
        $document = $this->model_dokumen->dapatkan_dokumen_pelamar_by_id($id);

        
        if (!$document) {
            show_404();
        }

        
        $user_id = $this->session->userdata('user_id');
        if ($document->id_pengguna != $user_id) {
            show_404();
        }

        
        $file_path = '';
        if ($document->jenis_dokumen == 'cv') {
            $file_path = './uploads/cv/' . $document->nama_file;

            
            $this->model_pelamar->perbarui_profil($user_id, ['cv' => null]);
        } else {
            $file_path = './uploads/documents/' . $document->nama_file;
        }

        
        if (file_exists($file_path)) {
            unlink($file_path);
        }

        
        $this->model_dokumen->hapus_dokumen_pelamar($id);

        
        $this->session->set_flashdata('success', 'Dokumen berhasil dihapus.');
        redirect('pelamar/profil');
    }

    public function penilaian() {
        
        $user_id = $this->session->userdata('user_id');
        $data['assessments'] = $this->model_penilaian->dapatkan_semua_penilaian_pelamar($user_id);

        
        $data['title'] = 'Penilaian Saya';
        $this->load->view('templates/applicant_header', $data);
        $this->load->view('pelamar/penilaian', $data);
        $this->load->view('templates/applicant_footer');
    }

    public function ikuti_penilaian($assessment_id, $application_id) {
        
        $data['assessment'] = $this->model_penilaian->dapatkan_penilaian($assessment_id);

        
        if (!$data['assessment']) {
            show_404();
        }

        
        $user_id = $this->session->userdata('user_id');
        $data['applicant_assessment'] = $this->model_penilaian->dapatkan_penilaian_pelamar_spesifik($application_id, $assessment_id);

        
        if (!$data['applicant_assessment'] || $data['applicant_assessment']->id_pelamar != $user_id) {
            show_404();
        }

        
        $cat_settings = $this->model_penilaian->cek_mode_cat($assessment_id);
        $data['cat_mode'] = $cat_settings->mode_cat;
        $data['acak_soal'] = $cat_settings->acak_soal;

        
        if ($data['applicant_assessment']->status == 'belum_mulai') {
            
            // Check if assessment has a scheduled date
            if ($data['applicant_assessment']->tanggal_penilaian) {
                $current_time = strtotime(date('Y-m-d H:i:s'));
                $assessment_time = strtotime($data['applicant_assessment']->tanggal_penilaian);
                $closure_time = $assessment_time + (2 * 3600); // Add 2 hours (2 * 60 * 60 seconds)

                // If current time is before assessment time
                if ($current_time < $assessment_time) {
                    $this->session->set_flashdata('error', 'Penilaian ini belum dapat diikuti. Jadwal penilaian: ' . date('d F Y H:i', $assessment_time));
                    redirect('pelamar/penilaian');
                    return;
                } elseif ($current_time > $closure_time) {
                    // If current time is more than 2 hours past the scheduled time
                    $this->model_penilaian->perbarui_status_penilaian_pelamar($data['applicant_assessment']->id, 'ditutup'); // Update status to 'ditutup'
                    $this->session->set_flashdata('error', 'Penilaian ini telah ditutup karena melewati batas waktu pengerjaan yang ditentukan. Jadwal penilaian: ' . date('d F Y H:i', $assessment_time) . ' (Ditutup pada: ' . date('d F Y H:i', $closure_time) . ')');
                    redirect('pelamar/penilaian');
                    return;
                }
            }
            
            $data['questions'] = $this->model_penilaian->dapatkan_soal_penilaian($assessment_id);

            
            $data['title'] = 'Konfirmasi Mulai Ujian';
            $data['application_id'] = $application_id;
            $this->load->view('templates/applicant_header', $data);
            $this->load->view('pelamar/konfirmasi_mulai_ujian', $data);
            $this->load->view('templates/applicant_footer');
        } else {
            
            if ($data['cat_mode']) {
                redirect('pelamar/cat-penilaian/' . $assessment_id . '/' . $application_id . '/1');
            } else {
                redirect('pelamar/ikuti-ujian/' . $assessment_id . '/' . $application_id);
            }
        }
    }

    
    public function ikuti_ujian($assessment_id, $application_id) {
        
        $data['assessment'] = $this->model_penilaian->dapatkan_penilaian($assessment_id);

        
        if (!$data['assessment']) {
            show_404();
        }

        
        $user_id = $this->session->userdata('user_id');
        $data['applicant_assessment'] = $this->model_penilaian->dapatkan_penilaian_pelamar_spesifik($application_id, $assessment_id);

        
        if (!$data['applicant_assessment'] || $data['applicant_assessment']->id_pelamar != $user_id) {
            show_404();
        }

        
        if ($data['applicant_assessment']->status == 'belum_mulai') {
            redirect('pelamar/ikuti-penilaian/' . $assessment_id . '/' . $application_id);
        }

        
        $data['questions'] = $this->model_penilaian->dapatkan_soal_penilaian($assessment_id);

        
        $data['title'] = 'Ikuti Penilaian';
        $data['application_id'] = $application_id;
        $this->load->view('templates/applicant_header', $data);
        $this->load->view('pelamar/ikuti_penilaian', $data);
        $this->load->view('templates/applicant_footer');
    }

    public function cat_penilaian($assessment_id, $application_id, $question_number = 1) {
        
        $data['assessment'] = $this->model_penilaian->dapatkan_penilaian($assessment_id);

        
        if (!$data['assessment']) {
            show_404();
        }

        
        $user_id = $this->session->userdata('user_id');
        $data['applicant_assessment'] = $this->model_penilaian->dapatkan_penilaian_pelamar_spesifik($application_id, $assessment_id);

        
        if (!$data['applicant_assessment'] || $data['applicant_assessment']->id_pelamar != $user_id) {
            show_404();
        }

        
        $cat_settings = $this->model_penilaian->cek_mode_cat($assessment_id);
        if (!$cat_settings->mode_cat) {
            
            redirect('pelamar/ikuti-penilaian/' . $assessment_id . '/' . $application_id);
        }

        
        if ($data['applicant_assessment']->status == 'belum_mulai') {
            redirect('pelamar/ikuti-penilaian/' . $assessment_id . '/' . $application_id);
        }

        
        $total_questions = $this->model_penilaian->dapatkan_total_soal_cat($data['applicant_assessment']->id);
        if ($total_questions == 0) {
            $this->model_penilaian->buat_urutan_soal_acak($data['applicant_assessment']->id);
            $total_questions = $this->model_penilaian->dapatkan_total_soal_cat($data['applicant_assessment']->id);
        }

        
        if ($question_number < 1 || $question_number > $total_questions) {
            $question_number = 1;
        }

        
        $data['current_question'] = $this->model_penilaian->dapatkan_soal_cat_berdasarkan_urutan($data['applicant_assessment']->id, $question_number);
        $data['question_number'] = $question_number;
        $data['total_questions'] = $total_questions;
        $data['application_id'] = $application_id;

        
        $data['question_status'] = $this->model_penilaian->dapatkan_status_jawaban_cat($data['applicant_assessment']->id);

        
        $data['title'] = 'Ujian CAT - ' . $data['assessment']->judul;
        $this->load->view('pelamar/cat_penilaian', $data);
    }

    public function simpan_jawaban_cat() {
        
        $this->security->csrf_verify = FALSE;

        
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $applicant_assessment_id = $this->input->post('applicant_assessment_id');
        $question_id = $this->input->post('question_id');
        $answer_type = $this->input->post('answer_type');

        
        if (!$applicant_assessment_id || !$question_id || !$answer_type) {
            echo json_encode(['status' => 'error', 'message' => 'Data tidak lengkap']);
            return;
        }

        $answer_data = array(
            'id_penilaian_pelamar' => $applicant_assessment_id,
            'id_soal' => $question_id,
            'diperbarui_pada' => date('Y-m-d H:i:s')
        );

        
        if ($answer_type == 'pilihan_ganda') {
            $selected_option = $this->input->post('selected_option');
            if ($selected_option) {
                $answer_data['id_pilihan_terpilih'] = $selected_option;
                $answer_data['teks_jawaban'] = null;
                $answer_data['unggah_file'] = null;
            }
        } elseif ($answer_type == 'esai') {
            $text_answer = $this->input->post('text_answer');
            if ($text_answer) {
                $answer_data['teks_jawaban'] = $text_answer;
                $answer_data['id_pilihan_terpilih'] = null;
                $answer_data['unggah_file'] = null;
            }
        }

        
        $result = $this->model_penilaian->simpan_jawaban_cat($answer_data);

        if ($result) {
            echo json_encode(['status' => 'success', 'message' => 'Jawaban berhasil disimpan']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal menyimpan jawaban']);
        }
    }

    public function tandai_ragu_cat() {
        
        $this->security->csrf_verify = FALSE;

        
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $applicant_assessment_id = $this->input->post('applicant_assessment_id');
        $question_id = $this->input->post('question_id');
        $ragu = $this->input->post('ragu') ? 1 : 0;

        
        if (!$applicant_assessment_id || !$question_id) {
            echo json_encode(['status' => 'error', 'message' => 'Data tidak lengkap']);
            return;
        }

        $result = $this->model_penilaian->tandai_soal_ragu($applicant_assessment_id, $question_id, $ragu);

        if ($result) {
            echo json_encode(['status' => 'success', 'message' => 'Status ragu berhasil diperbarui']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal memperbarui status ragu']);
        }
    }

    public function dapatkan_status_navigasi_cat() {
        
        $this->security->csrf_verify = FALSE;

        
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $applicant_assessment_id = $this->input->post('applicant_assessment_id');

        if (!$applicant_assessment_id) {
            echo json_encode(['status' => 'error', 'message' => 'Data tidak lengkap']);
            return;
        }

        $status = $this->model_penilaian->dapatkan_status_jawaban_cat($applicant_assessment_id);
        echo json_encode(['status' => 'success', 'data' => $status]);
    }

    public function get_question_cat() {
        
        $this->security->csrf_verify = FALSE;

        
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $applicant_assessment_id = $this->input->post('applicant_assessment_id');
        $question_number = $this->input->post('question_number');

        if (!$applicant_assessment_id || !$question_number) {
            echo json_encode(['status' => 'error', 'message' => 'Data tidak lengkap']);
            return;
        }

        
        $user_id = $this->session->userdata('user_id');
        $applicant_assessment = $this->model_penilaian->dapatkan_penilaian_pelamar_by_id($applicant_assessment_id);

        if (!$applicant_assessment) {
            echo json_encode(['status' => 'error', 'message' => 'Penilaian tidak ditemukan']);
            return;
        }

        
        $lamaran = $this->model_lamaran->dapatkan_lamaran($applicant_assessment->id_lamaran);
        if (!$lamaran || $lamaran->id_pelamar != $user_id) {
            echo json_encode(['status' => 'error', 'message' => 'Akses ditolak']);
            return;
        }

        
        $question = $this->model_penilaian->dapatkan_soal_cat_berdasarkan_urutan($applicant_assessment_id, $question_number);

        if (!$question) {
            echo json_encode(['status' => 'error', 'message' => 'Soal tidak ditemukan']);
            return;
        }

        echo json_encode(['status' => 'success', 'question' => $question]);
    }

    public function log_security_violation() {
        
        $this->security->csrf_verify = FALSE;

        
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $applicant_assessment_id = $this->input->post('applicant_assessment_id');
        $violation = $this->input->post('violation');
        $timestamp = $this->input->post('timestamp');

        if (!$applicant_assessment_id || !$violation) {
            echo json_encode(['status' => 'error', 'message' => 'Data tidak lengkap']);
            return;
        }

        
        $user_id = $this->session->userdata('user_id');
        $applicant_assessment = $this->model_penilaian->dapatkan_penilaian_pelamar_by_id($applicant_assessment_id);

        if (!$applicant_assessment) {
            echo json_encode(['status' => 'error', 'message' => 'Penilaian tidak ditemukan']);
            return;
        }

        
        $lamaran = $this->model_lamaran->dapatkan_lamaran($applicant_assessment->id_lamaran);
        if (!$lamaran || $lamaran->id_pelamar != $user_id) {
            echo json_encode(['status' => 'error', 'message' => 'Akses ditolak']);
            return;
        }

        
        $log_data = array(
            'id_penilaian_pelamar' => $applicant_assessment_id,
            'id_pelamar' => $user_id,
            'violation_type' => $violation,
            'timestamp' => date('Y-m-d H:i:s', $timestamp ? $timestamp/1000 : time()),
            'ip_address' => $this->input->ip_address(),
            'user_agent' => $this->input->user_agent(),
            'created_at' => date('Y-m-d H:i:s')
        );

        
        $this->log_security_to_database($log_data);

        echo json_encode(['status' => 'success', 'message' => 'Violation logged']);
    }

    private function log_security_to_database($log_data) {
        try {
            
            $this->db->insert('log_security_violations', $log_data);
        } catch (Exception $e) {
            
            $log_message = date('Y-m-d H:i:s') . " - Security Violation: " .
                          "User ID: {$log_data['id_pelamar']}, " .
                          "Assessment ID: {$log_data['id_penilaian_pelamar']}, " .
                          "Violation: {$log_data['violation_type']}, " .
                          "IP: {$log_data['ip_address']}" . PHP_EOL;

            $log_file = APPPATH . 'logs/security_violations_' . date('Y-m-d') . '.log';
            file_put_contents($log_file, $log_message, FILE_APPEND | LOCK_EX);
        }
    }

    public function perbarui_status_penilaian($applicant_assessment_id, $status) {
        
        if (!$applicant_assessment_id || !$status) {
            $this->output->set_status_header(400);
            echo json_encode(['status' => 'error', 'message' => 'Parameter tidak lengkap']);
            return;
        }

        
        $result = $this->model_penilaian->perbarui_status_penilaian_pelamar($applicant_assessment_id, $status);

        if ($result) {
            echo json_encode(['status' => 'success']);
        } else {
            $this->output->set_status_header(500);
            echo json_encode(['status' => 'error', 'message' => 'Gagal memperbarui status']);
        }
    }

    
    public function mulai_ujian($applicant_assessment_id) {
        
        header('Cache-Control: no-cache, must-revalidate');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Content-Type: application/json; charset=utf-8');

        try {
            
            if (!$this->input->is_ajax_request() && !isset($_POST['test_mulai_ujian'])) {
                throw new Exception('Request tidak valid');
            }

            
            if (!$applicant_assessment_id || !is_numeric($applicant_assessment_id)) {
                throw new Exception('Parameter ID tidak valid');
            }

            
            $user_id = $this->session->userdata('user_id');
            if (!$user_id) {
                throw new Exception('Session tidak valid. Silakan login kembali.');
            }

            
            $this->load->model('model_penilaian');
            $this->load->model('model_lamaran');

            
            $applicant_assessment = $this->model_penilaian->dapatkan_penilaian_pelamar_by_id($applicant_assessment_id);

            if (!$applicant_assessment) {
                throw new Exception('Penilaian tidak ditemukan');
            }

            $lamaran = $this->model_lamaran->dapatkan_lamaran($applicant_assessment->id_lamaran);
            if (!$lamaran || $lamaran->id_pelamar != $user_id) {
                throw new Exception('Akses ditolak. Anda tidak memiliki izin untuk ujian ini.');
            }

            
            if ($applicant_assessment->status != 'belum_mulai') {
                throw new Exception('Ujian sudah dimulai atau selesai. Status saat ini: ' . $applicant_assessment->status);
            }

            
            $update_data = array(
                'status' => 'sedang_mengerjakan',
                'waktu_mulai' => date('Y-m-d H:i:s'),
                'diperbarui_pada' => date('Y-m-d H:i:s')
            );

            $this->db->where('id', $applicant_assessment_id);
            $result = $this->db->update('penilaian_pelamar', $update_data);

            if (!$result) {
                
                $db_error = $this->db->error();
                log_message('error', 'Database error saat memulai ujian: ' . json_encode($db_error));
                throw new Exception('Gagal memperbarui database. Error: ' . $db_error['message']);
            }

            
            $affected_rows = $this->db->affected_rows();
            if ($affected_rows == 0) {
                throw new Exception('Tidak ada data yang diperbarui. Mungkin ID tidak ditemukan.');
            }

            
            log_message('info', 'Ujian dimulai untuk penilaian_pelamar ID: ' . $applicant_assessment_id . ' pada ' . $update_data['waktu_mulai'] . ' oleh user ID: ' . $user_id);

            
            echo json_encode([
                'status' => 'success',
                'message' => 'Ujian berhasil dimulai',
                'waktu_mulai' => $update_data['waktu_mulai'],
                'applicant_assessment_id' => $applicant_assessment_id,
                'affected_rows' => $affected_rows
            ]);
            exit;

        } catch (Exception $e) {
            
            log_message('error', 'Error saat memulai ujian: ' . $e->getMessage() . ' | User ID: ' . ($user_id ?? 'unknown') . ' | Assessment ID: ' . $applicant_assessment_id);

            
            header('Content-Type: application/json; charset=utf-8');
            http_response_code(500);
            echo json_encode([
                'status' => 'error',
                'message' => $e->getMessage(),
                'debug_info' => [
                    'user_id' => $user_id ?? null,
                    'applicant_assessment_id' => $applicant_assessment_id,
                    'timestamp' => date('Y-m-d H:i:s')
                ]
            ]);
            exit;
        } catch (Error $e) {
            
            log_message('error', 'PHP Error saat memulai ujian: ' . $e->getMessage() . ' | File: ' . $e->getFile() . ' | Line: ' . $e->getLine());

            header('Content-Type: application/json; charset=utf-8');
            http_response_code(500);
            echo json_encode([
                'status' => 'error',
                'message' => 'Terjadi kesalahan sistem. Silakan coba lagi.',
                'debug_info' => [
                    'error_type' => 'PHP Error',
                    'file' => $e->getFile(),
                    'line' => $e->getLine(),
                    'timestamp' => date('Y-m-d H:i:s')
                ]
            ]);
            exit;
        }
    }

    
    public function test_json() {
        header('Content-Type: application/json; charset=utf-8');
        echo '{"status":"success","message":"JSON test berhasil","timestamp":"' . date('Y-m-d H:i:s') . '"}';
        exit;
    }

    
    public function test_mulai_ujian($applicant_assessment_id = null) {
        
        header('Cache-Control: no-cache, must-revalidate');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Content-Type: application/json; charset=utf-8');

        
        $response = [
            'status' => 'success',
            'message' => 'Test method berhasil',
            'data' => [
                'applicant_assessment_id' => $applicant_assessment_id,
                'timestamp' => date('Y-m-d H:i:s'),
                'user_id' => $this->session->userdata('user_id'),
                'is_ajax' => $this->input->is_ajax_request() ? 'yes' : 'no',
                'method' => $this->input->method(),
                'user_agent' => $this->input->user_agent(),
                'ip_address' => $this->input->ip_address()
            ]
        ];

        echo json_encode($response);
        exit; 
    }

    public function kirim_penilaian_cat() {
        
        $this->security->csrf_verify = FALSE;

        
        $assessment_id = $this->input->post('assessment_id');
        $application_id = $this->input->post('application_id');
        $applicant_assessment_id = $this->input->post('applicant_assessment_id');

        
        if (!$assessment_id || !$application_id || !$applicant_assessment_id) {
            $this->session->set_flashdata('error', 'Data penilaian tidak lengkap.');
            redirect('pelamar/penilaian');
            return;
        }

        
        $user_id = $this->session->userdata('user_id');
        $applicant_assessment = $this->model_penilaian->dapatkan_penilaian_pelamar_by_id($applicant_assessment_id);

        if (!$applicant_assessment) {
            $this->session->set_flashdata('error', 'Penilaian tidak ditemukan.');
            redirect('pelamar/penilaian');
            return;
        }

        $lamaran = $this->model_lamaran->dapatkan_lamaran($applicant_assessment->id_lamaran);
        if (!$lamaran || $lamaran->id_pelamar != $user_id) {
            $this->session->set_flashdata('error', 'Akses ditolak.');
            redirect('pelamar/penilaian');
            return;
        }

        
        $update_data = array(
            'status' => 'selesai',
            'waktu_selesai' => date('Y-m-d H:i:s'),
            'diperbarui_pada' => date('Y-m-d H:i:s')
        );

        $this->db->where('id', $applicant_assessment_id);
        $this->db->update('penilaian_pelamar', $update_data);

        
        $score = $this->model_penilaian->hitung_skor_penilaian_pelamar($applicant_assessment_id);

        
        $this->db->where('id', $applicant_assessment_id);
        $this->db->update('penilaian_pelamar', array('nilai' => $score));

        
        $log_data = array(
            'id_penilaian_pelamar' => $applicant_assessment_id,
            'id_pelamar' => $user_id,
            'violation_type' => 'Assessment completed successfully',
            'timestamp' => date('Y-m-d H:i:s'),
            'ip_address' => $this->input->ip_address(),
            'user_agent' => $this->input->user_agent(),
            'created_at' => date('Y-m-d H:i:s')
        );
        $this->log_security_to_database($log_data);

        
        $this->session->set_flashdata('success', 'Ujian CAT berhasil diselesaikan. Skor Anda: ' . $score . '%');
        redirect('pelamar/detail_lamaran/' . $application_id);
    }

    public function kirim_penilaian() {
        
        $assessment_id = $this->input->post('assessment_id');
        $application_id = $this->input->post('application_id');
        $applicant_assessment_id = $this->input->post('applicant_assessment_id');

        
        if (!$assessment_id || !$application_id || !$applicant_assessment_id) {
            $this->session->set_flashdata('error', 'Data penilaian tidak lengkap.');
            redirect('pelamar/penilaian');
            return;
        }

        
        $this->model_penilaian->perbarui_status_penilaian_pelamar($applicant_assessment_id, 'selesai');

        
        $questions = $this->model_penilaian->dapatkan_soal_penilaian($assessment_id);

        foreach ($questions as $question) {
            $answer_data = array(
                'id_penilaian_pelamar' => $applicant_assessment_id,
                'id_soal' => $question->id,
                'teks_jawaban' => null,
                'id_pilihan_terpilih' => null,
                'unggah_file' => null
            );

            
            if ($question->jenis_soal == 'pilihan_ganda' || $question->jenis_soal == 'multiple_choice') {
                $selected_option = $this->input->post('question_' . $question->id);
                if ($selected_option) {
                    $answer_data['id_pilihan_terpilih'] = $selected_option;
                }
            } else if ($question->jenis_soal == 'benar_salah' || $question->jenis_soal == 'true_false') {
                $selected_option = $this->input->post('question_' . $question->id);
                if ($selected_option) {
                    
                    $this->db->where('id_soal', $question->id);
                    if ($selected_option == 'true') {
                        $this->db->where('teks_pilihan', 'Benar');
                    } else {
                        $this->db->where('teks_pilihan', 'Salah');
                    }
                    $option_query = $this->db->get('pilihan_soal');
                    $option = $option_query->row();

                    if ($option) {
                        $answer_data['id_pilihan_terpilih'] = $option->id;
                    }
                }
            } else if ($question->jenis_soal == 'esai' || $question->jenis_soal == 'essay') {
                $text_answer = $this->input->post('question_' . $question->id);
                if ($text_answer && trim($text_answer) != '') {
                    $answer_data['teks_jawaban'] = trim($text_answer);
                }
            } else if ($question->jenis_soal == 'unggah_file' || $question->jenis_soal == 'file_upload') {
                
                $upload_path = FCPATH . 'uploads/answers/';
                if (!is_dir($upload_path)) {
                    mkdir($upload_path, 0777, true);
                }

                $config['upload_path'] = $upload_path;
                $config['allowed_types'] = 'pdf|doc|docx|jpg|jpeg|png';
                $config['max_size'] = 2048; 
                $config['file_name'] = 'answer_' . $applicant_assessment_id . '_' . $question->id . '_' . time();

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('question_' . $question->id)) {
                    $upload_data = $this->upload->data();
                    $answer_data['unggah_file'] = $upload_data['file_name'];
                }
            }

            
            if ($answer_data['id_pilihan_terpilih'] || $answer_data['teks_jawaban'] || $answer_data['unggah_file']) {
                $this->model_penilaian->tambah_jawaban_pelamar($answer_data);
            }
        }

        
        $score = $this->model_penilaian->hitung_skor_penilaian_pelamar($applicant_assessment_id);

        
        $this->session->set_flashdata('success', 'Penilaian berhasil dikirim. Skor Anda: ' . $score . '%');
        redirect('pelamar/detail_lamaran/' . $application_id);
    }

    public function ubah_password() {
        
        $this->form_validation->set_rules('current_password', 'Password Saat Ini', 'trim|required');
        $this->form_validation->set_rules('new_password', 'Password Baru', 'trim|required|min_length[6]');
        $this->form_validation->set_rules('confirm_password', 'Konfirmasi Password', 'trim|required|matches[new_password]');

        if ($this->form_validation->run() == FALSE) {
            
            $data['title'] = 'Ubah Password';
            $this->load->view('templates/applicant_header', $data);
            $this->load->view('pelamar/ubah_password');
            $this->load->view('templates/applicant_footer');
        } else {
            
            $user_id = $this->session->userdata('user_id');
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password');

            
            $user = $this->model_pengguna->dapatkan_pengguna($user_id);

            if (password_verify($current_password, $user->password)) {
                
                $this->model_pengguna->perbarui_password($user_id, password_hash($new_password, PASSWORD_DEFAULT));

                
                $this->session->set_flashdata('success', 'Password berhasil diubah.');
                redirect('pelamar/dasbor');
            } else {
                
                $this->session->set_flashdata('error', 'Password saat ini tidak benar.');
                redirect('pelamar/ubah_password');
            }
        }
    }

    
    private function buat_notifikasi_lamaran_baru($id_lamaran) {
        
        $lamaran = $this->model_lamaran->dapatkan_lamaran($id_lamaran);
        if (!$lamaran) return false;

        
        $lowongan = $this->model_lowongan->dapatkan_lowongan($lamaran->id_pekerjaan);
        if (!$lowongan) return false;

        
        $pelamar = $this->model_pengguna->dapatkan_pengguna($lamaran->id_pelamar);
        if (!$pelamar) return false;

        
        $admins = $this->model_pengguna->dapatkan_pengguna_berdasarkan_peran('admin');

        $notification_data = array(
            'judul' => 'Lamaran Baru Diterima',
            'pesan' => "Lamaran baru telah diterima untuk posisi {$lowongan->judul} dari {$pelamar->nama_lengkap}. Silakan tinjau dan proses lamaran ini.",
            'jenis' => 'lamaran_baru',
            'prioritas' => 'normal',
            'id_referensi' => $id_lamaran,
            'tabel_referensi' => 'lamaran_pekerjaan',
            'url_aksi' => 'admin/detail_lamaran/' . $id_lamaran,
            'dibuat_oleh' => null
        );

        
        $admin_ids = array_column($admins, 'id');
        return $this->model_notifikasi->buat_notifikasi_massal($notification_data, $admin_ids);
    }

    public function view_dokumen($id) {
        
        $document = $this->model_dokumen->dapatkan_dokumen_lamaran_by_id($id);

        
        if (!$document) {
            show_404();
        }

        
        $user_id = $this->session->userdata('user_id');
        $application = $this->model_lamaran->dapatkan_lamaran($document->id_lamaran);
        if (!$application || $application->id_pelamar != $user_id) {
            show_404();
        }

        
        $file_path = '';
        if ($document->jenis_dokumen == 'cv') {
            $file_path = './uploads/cv/' . $document->nama_file;
        } else {
            $file_path = './uploads/documents/' . $document->nama_file;
        }

        
        if (!file_exists($file_path)) {
            $this->session->set_flashdata('error', 'File dokumen tidak ditemukan.');
            redirect('pelamar/detail_lamaran/' . $document->id_lamaran);
        }

        
        $ext = strtolower(pathinfo($file_path, PATHINFO_EXTENSION));
        $mime_types = [
            'pdf' => 'application/pdf',
            'jpg' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'png' => 'image/png',
            'doc' => 'application/msword',
            'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        ];
        $content_type = isset($mime_types[$ext]) ? $mime_types[$ext] : 'application/octet-stream';

        
        header('Content-Type: ' . $content_type);
        header('Content-Disposition: inline; filename="' . $document->nama_file . '"');
        header('Content-Length: ' . filesize($file_path));
        readfile($file_path);
        exit;
    }
}
