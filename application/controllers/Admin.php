<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Admin
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
 * @property Model_Kategori $model_kategori
 * @property Model_Blog $model_blog
 * @property CI_Email $email
 */
class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('fonnte');
        if (
            !$this->session->userdata('logged_in') ||
            !in_array($this->session->userdata('role'), ['admin', 'staff', 'hrd', 'direktur'])
        ) {
            redirect('auth');
        }

        $this->load->model('model_pengguna');
        $this->load->model('model_lowongan');
        $this->load->model('model_lamaran');
        $this->load->model('model_penilaian');
        $this->load->model('model_blog');
        $this->load->model('model_kategori');
        $this->load->model('model_pelamar');
        $this->load->model('model_dokumen');
        $this->load->model('model_notifikasi');

        $this->load->library('pagination');
        $this->load->library('form_validation');
        $this->load->library('upload');
    }

    
    private function check_admin_access() {
    if (!in_array($this->session->userdata('role'), ['admin', 'staff', 'hrd', 'direktur'])) {
        $this->session->set_flashdata('error', 'Akses ditolak. Hanya admin yang dapat mengakses halaman ini.');
        redirect('admin/dasbor');
    }
    }

    public function index() {
        redirect('admin/dasbor');
    }

    public function dasbor() {
        $data['total_jobs'] = $this->model_lowongan->hitung_lowongan();
        $data['active_jobs'] = $this->model_lowongan->hitung_lowongan_aktif();
        $data['total_applications'] = $this->model_lamaran->hitung_lamaran();
        $data['new_applications'] = $this->model_lamaran->hitung_lamaran_baru();
        $data['total_applicants'] = $this->model_pengguna->hitung_pelamar();
        $data['active_applicants'] = $this->model_pengguna->hitung_pelamar_aktif();
        $data['total_assessments'] = $this->model_penilaian->hitung_penilaian();
        $data['pending_assessments'] = $this->model_penilaian->hitung_penilaian_menunggu();

        $data['recent_applications'] = $this->model_lamaran->dapatkan_lamaran_terbaru_detail(5);

        $data['job_categories'] = $this->model_kategori->dapatkan_kategori_lowongan_dengan_jumlah();

        $current_year = date('Y');
        $monthly_stats = $this->model_lamaran->dapatkan_statistik_lamaran_bulanan($current_year);

        $monthly_data = array_fill(1, 12, 0);

        foreach ($monthly_stats as $stat) {
            $monthly_data[$stat->month] = $stat->count;
        }

        $data['monthly_application_stats'] = $monthly_data;

        $current_month = date('n');
        $previous_month = $current_month > 1 ? $current_month - 1 : 12;
        $current_month_count = isset($monthly_data[$current_month]) ? $monthly_data[$current_month] : 0;
        $previous_month_count = isset($monthly_data[$previous_month]) ? $monthly_data[$previous_month] : 0;

        if ($previous_month_count > 0) {
            $data['application_trend'] = round((($current_month_count - $previous_month_count) / $previous_month_count) * 100, 1);
        } else {
            $data['application_trend'] = $current_month_count > 0 ? 100 : 0;
        }

        $data['application_status_stats'] = [
            'menunggu' => $this->model_lamaran->hitung_lamaran_berdasarkan_status('menunggu'),
            'direview' => $this->model_lamaran->hitung_lamaran_berdasarkan_status('direview'),
            'seleksi' => $this->model_lamaran->hitung_lamaran_berdasarkan_status('seleksi'),
            'wawancara' => $this->model_lamaran->hitung_lamaran_berdasarkan_status('wawancara'),
            'diterima' => $this->model_lamaran->hitung_lamaran_berdasarkan_status('diterima')
        ];

        $data['applications_per_job'] = $this->model_lamaran->dapatkan_jumlah_lamaran_per_lowongan(5);

        $data['recent_activities'] = $this->model_lamaran->dapatkan_aktivitas_terbaru(5);

        $data['title'] = 'Dasbor Admin';
        $this->load->view('templates/admin_header', $data);
        $this->load->view('admin/dashboard', $data);
        $this->load->view('templates/admin_footer');
    }

    public function tutorial() {
        
        $this->check_admin_access();

        $data['title'] = 'Tutorial & Dokumentasi';
        $this->load->view('templates/admin_header', $data);
        $this->load->view('admin/tutorial/index', $data);
        $this->load->view('templates/admin_footer');
    }



    
    public function lowongan() {
        
        $data['jobs'] = $this->model_lowongan->dapatkan_lowongan_semua();

        
        $data['job_stats_by_category'] = $this->model_lowongan->dapatkan_statistik_kategori();

        
        $current_year = date('Y');
        $monthly_stats = $this->model_lowongan->dapatkan_statistik_bulanan($current_year);

        
        $monthly_data = array_fill(1, 12, 0);

        
        foreach ($monthly_stats as $stat) {
            $monthly_data[$stat->bulan] = $stat->jumlah;
        }

        $data['monthly_job_stats'] = $monthly_data;

        
        $data['title'] = 'Manajemen Lowongan';
        $this->load->view('templates/admin_header', $data);
        $this->load->view('admin/lowongan/index', $data);
        $this->load->view('templates/admin_footer');
    }



    
    public function tambahLowongan() {
        
        $data['categories'] = $this->model_kategori->dapatkan_kategori_lowongan();

        
        $this->form_validation->set_rules('title', 'Judul', 'trim|required');
        $this->form_validation->set_rules('description', 'Deskripsi', 'trim|required');
        $this->form_validation->set_rules('requirements', 'Persyaratan', 'trim|required');
        $this->form_validation->set_rules('responsibilities', 'Tanggung Jawab', 'trim|required');
        $this->form_validation->set_rules('location', 'Lokasi', 'trim|required');
        $this->form_validation->set_rules('job_type', 'Tipe Pekerjaan', 'trim|required');
        $this->form_validation->set_rules('deadline', 'Batas Waktu', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            
            $data['title'] = 'Tambah Lowongan Baru';
            $this->load->view('templates/admin_header', $data);
            $this->load->view('admin/lowongan/add', $data);
            $this->load->view('templates/admin_footer');
        } else {
            
            $job_data = array(
                'judul' => $this->input->post('title'),
                'id_kategori' => $this->input->post('category_id'),
                'deskripsi' => $this->input->post('description'),
                'persyaratan' => $this->input->post('requirements'),
                'tanggung_jawab' => $this->input->post('responsibilities'),
                'lokasi' => $this->input->post('location'),
                'jenis_pekerjaan' => $this->input->post('job_type'),
                'rentang_gaji' => $this->input->post('salary_range'),
                'batas_waktu' => $this->input->post('deadline'),
                'jumlah_lowongan' => $this->input->post('vacancies'),
                'unggulan' => $this->input->post('featured') ? 1 : 0,
                'status' => $this->input->post('status'),
                'dibuat_oleh' => $this->session->userdata('user_id')
            );

            
            $job_id = $this->model_lowongan->tambah_lowongan($job_data);

            if ($job_id) {
                
                $this->session->set_flashdata('success', 'Lowongan berhasil ditambahkan.');

                
                if ($this->input->post('manage_documents') == '1') {
                    redirect('admin/dokumen_lowongan/' . $job_id);
                } else {
                    redirect('admin/lowongan');
                }
            } else {
                
                $this->session->set_flashdata('error', 'Gagal menambahkan lowongan. Silakan coba lagi.');
                redirect('admin/tambahLowongan');
            }
        }
    }

    public function edit_lowongan($id) {
        
        $data['job'] = $this->model_lowongan->dapatkan_lowongan($id);

        
        if (!$data['job']) {
            show_404();
        }

        
        $data['categories'] = $this->model_kategori->dapatkan_kategori_lowongan();

        
        $data['applications'] = $this->model_lamaran->dapatkan_lamaran_lowongan($id);

        
        $this->form_validation->set_rules('title', 'Judul', 'trim|required');
        $this->form_validation->set_rules('description', 'Deskripsi', 'trim|required');
        $this->form_validation->set_rules('requirements', 'Persyaratan', 'trim|required');
        $this->form_validation->set_rules('responsibilities', 'Tanggung Jawab', 'trim|required');
        $this->form_validation->set_rules('location', 'Lokasi', 'trim|required');
        $this->form_validation->set_rules('job_type', 'Tipe Pekerjaan', 'trim|required');
        $this->form_validation->set_rules('deadline', 'Batas Waktu', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            
            $data['title'] = 'Edit Lowongan';
            $this->load->view('templates/admin_header', $data);
            $this->load->view('admin/lowongan/edit', $data);
            $this->load->view('templates/admin_footer');
        } else {
            
            $job_data = array(
                'judul' => $this->input->post('title'),
                'id_kategori' => $this->input->post('category_id'),
                'deskripsi' => $this->input->post('description'),
                'persyaratan' => $this->input->post('requirements'),
                'tanggung_jawab' => $this->input->post('responsibilities'),
                'lokasi' => $this->input->post('location'),
                'jenis_pekerjaan' => $this->input->post('job_type'),
                'rentang_gaji' => $this->input->post('salary_range'),
                'batas_waktu' => $this->input->post('deadline'),
                'jumlah_lowongan' => $this->input->post('vacancies'),
                'unggulan' => $this->input->post('featured') ? 1 : 0,
                'status' => $this->input->post('status')
            );

            
            $result = $this->model_lowongan->perbarui_lowongan($id, $job_data);

            if ($result) {
                
                $this->session->set_flashdata('success', 'Lowongan berhasil diperbarui.');
                redirect('admin/lowongan');
            } else {
                
                $this->session->set_flashdata('error', 'Gagal memperbarui lowongan. Silakan coba lagi.');
                redirect('admin/edit_lowongan/' . $id);
            }
        }
    }

    public function hapus_lowongan($id) {
        
        $result = $this->model_lowongan->hapus_lowongan($id);

        if ($result) {
            
            $this->session->set_flashdata('success', 'Lowongan berhasil dihapus.');
        } else {
            
            $this->session->set_flashdata('error', 'Gagal menghapus lowongan. Silakan coba lagi.');
        }

        redirect('admin/lowongan');
    }

    
    public function lamaran() {
        
        $data['applications'] = $this->model_lamaran->dapatkan_lamaran_semua();

        
        $data['application_status_stats'] = [
            
            'pending' => $this->model_lamaran->hitung_lamaran_berdasarkan_status('pending'),
            'reviewed' => $this->model_lamaran->hitung_lamaran_berdasarkan_status('reviewed'),
            'shortlisted' => $this->model_lamaran->hitung_lamaran_berdasarkan_status('shortlisted'),
            'interviewed' => $this->model_lamaran->hitung_lamaran_berdasarkan_status('interviewed'),
            'offered' => $this->model_lamaran->hitung_lamaran_berdasarkan_status('offered'),
            'hired' => $this->model_lamaran->hitung_lamaran_berdasarkan_status('hired'),
            'rejected' => $this->model_lamaran->hitung_lamaran_berdasarkan_status('rejected'),

            
            'interview' => $this->model_lamaran->hitung_lamaran_berdasarkan_status('interview'),
            'diterima' => $this->model_lamaran->hitung_lamaran_berdasarkan_status('diterima'),
            'ditolak' => $this->model_lamaran->hitung_lamaran_berdasarkan_status('ditolak'),
            'seleksi' => $this->model_lamaran->hitung_lamaran_berdasarkan_status('seleksi'),
            'wawancara' => $this->model_lamaran->hitung_lamaran_berdasarkan_status('wawancara')
        ];

        
        $current_year = date('Y');
        $monthly_stats = $this->model_lamaran->dapatkan_statistik_lamaran_bulanan($current_year);

        
        $monthly_data = array_fill(1, 12, 0);

        
        foreach ($monthly_stats as $stat) {
            $monthly_data[$stat->month] = $stat->count;
        }

        $data['monthly_application_stats'] = $monthly_data;

        
        $data['title'] = 'Manajemen Lamaran';
        $this->load->view('templates/admin_header', $data);
        $this->load->view('admin/lamaran/index', $data);
        $this->load->view('templates/admin_footer');
    }

    public function detail_lamaran($id) {
        
        $data['application'] = $this->model_lamaran->dapatkan_lamaran($id);

        
        if (!$data['application']) {
            show_404();
        }

        
        $data['profile'] = $this->model_pelamar->dapatkan_profil($data['application']->id_pelamar);

        
        $data['applicant'] = $this->model_pengguna->dapatkan_pengguna($data['application']->id_pelamar);

        
        $data['job'] = $this->model_lowongan->dapatkan_lowongan($data['application']->id_pekerjaan);

        
        $data['assessments'] = $this->model_penilaian->dapatkan_penilaian_pelamar($id);

        
        $data['documents'] = $this->model_dokumen->dapatkan_dokumen_lamaran($id);

        
        $data['title'] = 'Detail Lamaran';
        $this->load->view('templates/admin_header', $data);
        $this->load->view('admin/lamaran/detail', $data);
        $this->load->view('templates/admin_footer');
    }

    public function perbarui_status_lamaran($id, $status) {
        
        $this->load->helper('fonnte');

        
        $notify = $this->input->get('notify') === '1';

        
        $catatan = $this->input->get('catatan');

        
        $application = $this->model_lamaran->dapatkan_lamaran($id);

        
        if (!$application) {
            show_404();
        }

        
        $job = $this->model_lowongan->dapatkan_lowongan($application->id_pekerjaan);

        
        $applicant = $this->model_pengguna->dapatkan_pengguna($application->id_pelamar);

        
        $data = [
            'status' => $status,
            'diperbarui_pada' => date('Y-m-d H:i:s')
        ];

        
        if (!empty($catatan)) {
            $data['catatan_admin'] = $catatan;
        }

        $result = $this->model_lamaran->perbarui_lamaran($id, $data);

        if ($result) {
            
            if ($notify && $applicant && $applicant->telepon) {
                $whatsapp_result = $this->kirim_notifikasi_whatsapp($applicant, $job, $status, $catatan);

                if ($whatsapp_result && isset($whatsapp_result['success']) && $whatsapp_result['success']) {
                    $this->session->set_flashdata('success', 'Status lamaran berhasil diperbarui menjadi ' . ucfirst($status) . ' dan notifikasi WhatsApp telah dikirim.');
                } else {
                    $this->session->set_flashdata('success', 'Status lamaran berhasil diperbarui menjadi ' . ucfirst($status) . ', tetapi gagal mengirim notifikasi WhatsApp.');
                    if ($whatsapp_result && isset($whatsapp_result['error'])) {
                        $this->session->set_flashdata('error', 'Error WhatsApp: ' . $whatsapp_result['error']);
                    }
                }
            } else {
                if (!$applicant->telepon) {
                    $this->session->set_flashdata('success', 'Status lamaran berhasil diperbarui menjadi ' . ucfirst($status) . '. Notifikasi WhatsApp tidak dikirim karena nomor telepon pelamar tidak tersedia.');
                } else {
                    $this->session->set_flashdata('success', 'Status lamaran berhasil diperbarui menjadi ' . ucfirst($status) . '.');
                }
            }
        } else {
            
            $this->session->set_flashdata('error', 'Gagal memperbarui status lamaran. Silakan coba lagi.');
        }

        redirect('admin/detail_lamaran/' . $id);
    }

    
    private function kirim_notifikasi_whatsapp($applicant, $job, $status, $catatan = '') {
        
        $message = dapatkan_pesan_status_lamaran($status, $job->judul, $applicant->nama_lengkap);

        
        if (!empty($catatan)) {
            $message .= "\n\n*Catatan dari HR:*\n" . $catatan;
        }

        
        $whatsapp_result = kirim_whatsapp($applicant->telepon, $message);

        return $whatsapp_result;
    }

    
    public function perbaruiStatusPelamar($id, $status) {
        
        $result = $this->model_lamaran->perbarui_status($id, $status);

        if ($result) {
            
            $this->buat_notifikasi_status_lamaran($id, $status);

            
            $this->session->set_flashdata('success', 'Status lamaran berhasil diperbarui menjadi ' . ucfirst($status) . '.');
        } else {
            
            $this->session->set_flashdata('error', 'Gagal memperbarui status lamaran. Silakan coba lagi.');
        }

        redirect('admin/lamaran');
    }



    
    public function tambah_catatan_lamaran($id) {
        
        $note = $this->input->post('note');

        
        $result = $this->model_lamaran->tambah_catatan_admin($id, $note);

        if ($result) {
            
            $this->session->set_flashdata('success', 'Catatan berhasil ditambahkan.');
        } else {
            
            $this->session->set_flashdata('error', 'Gagal menambahkan catatan. Silakan coba lagi.');
        }

        redirect('admin/detail_lamaran/' . $id);
    }

    
    public function editPelamar($id) {
        
        $data['application'] = $this->model_lamaran->dapatkan_lamaran($id);

        
        if (!$data['application']) {
            show_404();
        }

        
        $data['jobs'] = $this->model_lowongan->dapatkan_lowongan_aktif_semua();

        
        $data['profile'] = $this->model_pelamar->dapatkan_profil($data['application']->id_pelamar);

        
        $this->form_validation->set_rules('job_id', 'Lowongan', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required');

        if ($this->form_validation->run() == FALSE) {
            
            $data['title'] = 'Edit Lamaran';
            $this->load->view('templates/admin_header', $data);
            $this->load->view('admin/lamaran/edit', $data);
            $this->load->view('templates/admin_footer');
        } else {
            
            $application_data = array(
                'job_id' => $this->input->post('job_id'),
                'status' => $this->input->post('status'),
                'diperbarui_pada' => date('Y-m-d H:i:s')
            );

            
            $result = $this->model_lamaran->perbarui_lamaran($id, $application_data);

            if ($result) {
                
                $this->session->set_flashdata('success', 'Lamaran berhasil diperbarui.');
                redirect('admin/lamaran');
            } else {
                
                $this->session->set_flashdata('error', 'Gagal memperbarui lamaran. Silakan coba lagi.');
                redirect('admin/editPelamar/' . $id);
            }
        }
    }

    
    public function hapusPelamar($id) {
        
        $result = $this->model_lamaran->hapus_lamaran($id);

        if ($result) {
            
            $this->session->set_flashdata('success', 'Lamaran berhasil dihapus.');
        } else {
            
            $this->session->set_flashdata('error', 'Gagal menghapus lamaran. Silakan coba lagi.');
        }

        redirect('admin/lamaran');
    }

    
    public function unduhCV($id) {
        
        $application = $this->model_lamaran->dapatkan_lamaran($id);

        
        if (!$application) {
            show_404();
        }

        $cv_file = null;
        $file_path = null;

        
        if ($application->cv) {
            $cv_file = $application->cv;
            $file_path = './uploads/cv/' . $cv_file;
        } else {
            
            $profile = $this->model_pelamar->dapatkan_profil($application->id_pelamar);
            if ($profile && $profile->cv) {
                $cv_file = $profile->cv;
                $file_path = './uploads/cv/' . $cv_file;
            }
        }

        
        if (!$cv_file || !$file_path) {
            $this->session->set_flashdata('error', 'CV tidak ditemukan untuk lamaran ini.');
            redirect('admin/detail_lamaran/' . $id);
        }

        
        if (!file_exists($file_path)) {
            $this->session->set_flashdata('error', 'File CV tidak ditemukan di server.');
            redirect('admin/detail_lamaran/' . $id);
        }

        
        $file_info = pathinfo($file_path);
        $file_name = $application->applicant_name . '_CV.' . $file_info['extension'];

        
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . $file_name . '"');
        header('Content-Length: ' . filesize($file_path));
        readfile($file_path);
        exit;
    }

    
    public function unduhResume($id) {
        return $this->unduhCV($id);
    }

    
    public function unduh_resume($id) {
        return $this->unduhCV($id);
    }

    

    
    public function dokumen_lowongan($job_id) {
        
        $data['job'] = $this->model_lowongan->dapatkan_lowongan($job_id);

        
        if (!$data['job']) {
            show_404();
        }

        
        $data['documents'] = $this->model_dokumen->dapatkan_dokumen_lowongan($job_id);

        
        $data['title'] = 'Kelola Dokumen Lowongan';
        $this->load->view('templates/admin_header', $data);
        $this->load->view('admin/lowongan/documents', $data);
        $this->load->view('templates/admin_footer');
    }

    
    public function tambah_dokumen_lowongan($job_id) {
        
        $data['job'] = $this->model_lowongan->dapatkan_lowongan($job_id);

        
        if (!$data['job']) {
            show_404();
        }

        
        $this->form_validation->set_rules('jenis_dokumen', 'Jenis Dokumen', 'trim|required');
        $this->form_validation->set_rules('nama_dokumen', 'Nama Dokumen', 'trim|required');
        $this->form_validation->set_rules('wajib', 'Wajib', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            
            $data['title'] = 'Tambah Dokumen Lowongan';
            $this->load->view('templates/admin_header', $data);
            $this->load->view('admin/lowongan/add_document', $data);
            $this->load->view('templates/admin_footer');
        } else {
            
            $document_data = array(
                'id_lowongan' => $job_id,
                'jenis_dokumen' => $this->input->post('jenis_dokumen'),
                'nama_dokumen' => $this->input->post('nama_dokumen'),
                'wajib' => $this->input->post('wajib'),
                'format_diizinkan' => $this->input->post('format_diizinkan'),
                'ukuran_maksimal' => $this->input->post('ukuran_maksimal'),
                'deskripsi' => $this->input->post('deskripsi')
            );

            
            $document_id = $this->model_dokumen->tambah_dokumen_lowongan($document_data);

            if ($document_id) {
                
                $this->session->set_flashdata('success', 'Dokumen lowongan berhasil ditambahkan.');
                redirect('admin/dokumen_lowongan/' . $job_id);
            } else {
                
                $this->session->set_flashdata('error', 'Gagal menambahkan dokumen lowongan. Silakan coba lagi.');
                redirect('admin/tambah_dokumen_lowongan/' . $job_id);
            }
        }
    }

    
    public function edit_dokumen_lowongan($id) {
        
        $data['document'] = $this->model_dokumen->dapatkan_dokumen_lowongan_by_id($id);

        
        if (!$data['document']) {
            show_404();
        }

        
        $data['job'] = $this->model_lowongan->dapatkan_lowongan($data['document']->id_lowongan);

        
        $this->form_validation->set_rules('jenis_dokumen', 'Jenis Dokumen', 'trim|required');
        $this->form_validation->set_rules('nama_dokumen', 'Nama Dokumen', 'trim|required');
        $this->form_validation->set_rules('wajib', 'Wajib', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            
            $data['title'] = 'Edit Dokumen Lowongan';
            $this->load->view('templates/admin_header', $data);
            $this->load->view('admin/lowongan/edit_document', $data);
            $this->load->view('templates/admin_footer');
        } else {
            
            $document_data = array(
                'jenis_dokumen' => $this->input->post('jenis_dokumen'),
                'nama_dokumen' => $this->input->post('nama_dokumen'),
                'wajib' => $this->input->post('wajib'),
                'format_diizinkan' => $this->input->post('format_diizinkan'),
                'ukuran_maksimal' => $this->input->post('ukuran_maksimal'),
                'deskripsi' => $this->input->post('deskripsi')
            );

            
            $result = $this->model_dokumen->perbarui_dokumen_lowongan($id, $document_data);

            if ($result) {
                
                $this->session->set_flashdata('success', 'Dokumen lowongan berhasil diperbarui.');
                redirect('admin/dokumen_lowongan/' . $data['document']->id_lowongan);
            } else {
                
                $this->session->set_flashdata('error', 'Gagal memperbarui dokumen lowongan. Silakan coba lagi.');
                redirect('admin/edit_dokumen_lowongan/' . $id);
            }
        }
    }

    
    public function hapus_dokumen_lowongan($id) {
        
        $document = $this->model_dokumen->dapatkan_dokumen_lowongan_by_id($id);

        
        if (!$document) {
            show_404();
        }

        
        $result = $this->model_dokumen->hapus_dokumen_lowongan($id);

        if ($result) {
            
            $this->session->set_flashdata('success', 'Dokumen lowongan berhasil dihapus.');
        } else {
            
            $this->session->set_flashdata('error', 'Gagal menghapus dokumen lowongan. Silakan coba lagi.');
        }

        redirect('admin/dokumen_lowongan/' . $document->id_lowongan);
    }

    
    public function atur_dokumen_default($job_id) {
        
        $job = $this->model_lowongan->dapatkan_lowongan($job_id);

        
        if (!$job) {
            show_404();
        }

        
        if ($this->model_dokumen->cek_dokumen_lowongan_exists($job_id)) {
            $this->session->set_flashdata('error', 'Lowongan ini sudah memiliki persyaratan dokumen. Hapus semua dokumen terlebih dahulu untuk mengatur ulang.');
            redirect('admin/dokumen_lowongan/' . $job_id);
        }

        
        $default_documents = $this->model_dokumen->dapatkan_dokumen_default();

        
        $success = true;
        foreach ($default_documents as $document) {
            $document['id_lowongan'] = $job_id;
            $result = $this->model_dokumen->tambah_dokumen_lowongan($document);
            if (!$result) {
                $success = false;
            }
        }

        if ($success) {
            
            $this->session->set_flashdata('success', 'Dokumen default berhasil ditambahkan ke lowongan.');
        } else {
            
            $this->session->set_flashdata('error', 'Gagal menambahkan beberapa dokumen default. Silakan coba lagi.');
        }

        redirect('admin/dokumen_lowongan/' . $job_id);
    }

    
    public function hapus_semua_dokumen_lowongan($job_id) {
        
        $job = $this->model_lowongan->dapatkan_lowongan($job_id);

        
        if (!$job) {
            show_404();
        }

        
        $result = $this->model_dokumen->hapus_semua_dokumen_lowongan($job_id);

        if ($result) {
            
            $this->session->set_flashdata('success', 'Semua dokumen lowongan berhasil dihapus.');
        } else {
            
            $this->session->set_flashdata('error', 'Gagal menghapus dokumen lowongan. Silakan coba lagi.');
        }

        redirect('admin/dokumen_lowongan/' . $job_id);
    }



    
    public function unduh_dokumen_lamaran($id) {
        
        $document = $this->model_dokumen->dapatkan_dokumen_lamaran_by_id($id);

        
        if (!$document) {
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
            redirect('admin/detail_lamaran/' . $document->id_lamaran);
        }

        
        $file_info = pathinfo($file_path);
        $file_name = $document->jenis_dokumen . '_' . time() . '.' . $file_info['extension'];

        
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . $file_name . '"');
        header('Content-Length: ' . filesize($file_path));
        readfile($file_path);
        exit;
    }

    public function view_dokumen_lamaran($id) {
        $document = $this->model_dokumen->dapatkan_dokumen_lamaran_by_id($id);

        if (!$document) {
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
            redirect('admin/detail_lamaran/' . $document->id_lamaran);
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

    
    public function cetakPelamar($id) {
        
        $data['application'] = $this->model_lamaran->dapatkan_lamaran($id);

        
        if (!$data['application']) {
            show_404();
        }

        
        $data['profile'] = $this->model_pelamar->dapatkan_profil($data['application']->id_pelamar);

        
        $data['job'] = $this->model_lowongan->dapatkan_lowongan($data['application']->id_pekerjaan);

        
        $data['title'] = 'Cetak Lamaran';
        $this->load->view('admin/lamaran/print', $data);
    }

    
    public function lamaran_lowongan($job_id) {
        
        $data['job'] = $this->model_lowongan->dapatkan_lowongan($job_id);

        
        if (!$data['job']) {
            show_404();
        }

        
        $data['applications'] = $this->model_lamaran->dapatkan_lamaran_lowongan($job_id);

        
        $data['title'] = 'Lamaran untuk ' . $data['job']->title;
        $this->load->view('templates/admin_header', $data);
        $this->load->view('admin/lamaran/lamaran_pekerjaan', $data);
        $this->load->view('templates/admin_footer');
    }

    
    public function penilaian() {
        
        $assessments = $this->model_penilaian->dapatkan_semua_penilaian();

        
        foreach ($assessments as &$assessment) {
            $assessment->question_count = $this->model_penilaian->hitung_soal_penilaian($assessment->id);
        }
        $data['assessments'] = $assessments;

        
        $data['assessment_types'] = $this->model_penilaian->dapatkan_jenis_penilaian();

        
        $data['jobs'] = $this->model_lowongan->dapatkan_lowongan_aktif(100, 0);

        
        $data['chart_data'] = $this->dapatkan_data_chart_penilaian();

        
        $data['title'] = 'Manajemen Penilaian';
        $this->load->view('templates/admin_header', $data);
        $this->load->view('admin/penilaian/index', $data);
        $this->load->view('templates/admin_footer');
    }

    
    public function tambah_penilaian() {
        
        $data['assessment_types'] = $this->model_penilaian->dapatkan_jenis_penilaian();

        
        $data['jobs'] = $this->model_lowongan->dapatkan_lowongan_aktif(100, 0);

        
        $this->form_validation->set_rules('title', 'Judul', 'trim|required');
        $this->form_validation->set_rules('assessment_type_id', 'Jenis Penilaian', 'trim|required');
        $this->form_validation->set_rules('description', 'Deskripsi', 'trim|required');
        $this->form_validation->set_rules('time_limit', 'Batas Waktu', 'trim|numeric');
        $this->form_validation->set_rules('passing_score', 'Nilai Kelulusan', 'trim|numeric');

        if ($this->form_validation->run() == FALSE) {
            
            $data['title'] = 'Tambah Penilaian Baru';
            $this->load->view('templates/admin_header', $data);
            $this->load->view('admin/penilaian/tambah', $data);
            $this->load->view('templates/admin_footer');
        } else {
            
            $assessment_data = array(
                'judul' => $this->input->post('title'),
                'id_jenis' => $this->input->post('assessment_type_id'),
                'deskripsi' => $this->input->post('description'),
                'petunjuk' => $this->input->post('instructions'),
                'batas_waktu' => $this->input->post('time_limit'),
                'nilai_lulus' => $this->input->post('passing_score'),
                'maksimal_percobaan' => $this->input->post('max_attempts'),
                'aktif' => $this->input->post('is_active') ? 1 : 0,
                'acak_soal' => $this->input->post('acak_soal') ? 1 : 0,
                'mode_cat' => $this->input->post('mode_cat') ? 1 : 0,
                'dibuat_oleh' => $this->session->userdata('user_id'),
                'dibuat_pada' => date('Y-m-d H:i:s')
            );

            
            $assessment_id = $this->model_penilaian->tambah_penilaian($assessment_data);

            if ($assessment_id) {
                
                $job_id = $this->input->post('job_id');
                if (!empty($job_id)) {
                    $this->model_penilaian->tetapkan_penilaian_ke_lowongan($job_id, $assessment_id);
                }

                
                $this->session->set_flashdata('success', 'Penilaian berhasil ditambahkan.');
                redirect('admin/soal_penilaian/' . $assessment_id);
            } else {
                
                $this->session->set_flashdata('error', 'Gagal menambahkan penilaian. Silakan coba lagi.');
                redirect('admin/tambah_penilaian');
            }
        }
    }

    
    public function edit_penilaian($id) {
        
        $data['assessment'] = $this->model_penilaian->dapatkan_penilaian($id);

        
        if (!$data['assessment']) {
            show_404();
        }

        
        $data['assessment_types'] = $this->model_penilaian->dapatkan_jenis_penilaian();

        
        $data['jobs'] = $this->model_lowongan->dapatkan_lowongan_aktif(100, 0);

        
        $data['assigned_job'] = $this->model_penilaian->dapatkan_lowongan_penilaian($id);

        
        $this->form_validation->set_rules('title', 'Judul', 'trim|required');
        $this->form_validation->set_rules('assessment_type_id', 'Jenis Penilaian', 'trim|required');
        $this->form_validation->set_rules('description', 'Deskripsi', 'trim|required');
        $this->form_validation->set_rules('time_limit', 'Batas Waktu', 'trim|numeric');
        $this->form_validation->set_rules('passing_score', 'Nilai Kelulusan', 'trim|numeric');

        if ($this->form_validation->run() == FALSE) {
            
            $data['title'] = 'Edit Penilaian';
            $this->load->view('templates/admin_header', $data);
            $this->load->view('admin/penilaian/edit', $data);
            $this->load->view('templates/admin_footer');
        } else {
            
            $assessment_data = array(
                'judul' => $this->input->post('title'),
                'id_jenis' => $this->input->post('assessment_type_id'),
                'deskripsi' => $this->input->post('description'),
                'petunjuk' => $this->input->post('instructions'),
                'batas_waktu' => $this->input->post('time_limit'),
                'nilai_lulus' => $this->input->post('passing_score'),
                'maksimal_percobaan' => $this->input->post('max_attempts'),
                'aktif' => $this->input->post('is_active') ? 1 : 0,
                'acak_soal' => $this->input->post('acak_soal') ? 1 : 0,
                'mode_cat' => $this->input->post('mode_cat') ? 1 : 0,
                'diperbarui_pada' => date('Y-m-d H:i:s')
            );

            
            $result = $this->model_penilaian->perbarui_penilaian($id, $assessment_data);

            if ($result) {
                
                $job_id = $this->input->post('job_id');
                $current_job = $data['assigned_job'] ? $data['assigned_job']->job_id : null;

                
                if ($job_id != $current_job) {
                    
                    if ($current_job) {
                        $this->model_penilaian->hapus_penilaian_dari_lowongan($current_job, $id);
                    }

                    
                    if (!empty($job_id)) {
                        $this->model_penilaian->tetapkan_penilaian_ke_lowongan($job_id, $id);
                    }
                }

                
                $this->session->set_flashdata('success', 'Penilaian berhasil diperbarui.');
                redirect('admin/penilaian');
            } else {
                
                $this->session->set_flashdata('error', 'Gagal memperbarui penilaian. Silakan coba lagi.');
                redirect('admin/edit_penilaian/' . $id);
            }
        }
    }

    
    public function hapus_penilaian($id) {
        
        $assessment = $this->model_penilaian->dapatkan_penilaian($id);

        
        if (!$assessment) {
            show_404();
        }

        
        $has_applicants = $this->model_penilaian->cek_penilaian_digunakan($id);

        if ($has_applicants) {
            
            $this->session->set_flashdata('error', 'Penilaian tidak dapat dihapus karena sudah digunakan oleh pelamar.');
            redirect('admin/penilaian');
            return;
        }

        
        $result = $this->model_penilaian->hapus_penilaian($id);

        if ($result) {
            
            $this->session->set_flashdata('success', 'Penilaian berhasil dihapus.');
        } else {
            
            $this->session->set_flashdata('error', 'Gagal menghapus penilaian. Silakan coba lagi.');
        }

        redirect('admin/penilaian');
    }

    
    public function migrasi_status_lamaran() {
        
        $result = $this->model_lamaran->migrasi_status_lamaran();

        if ($result) {
            
            $this->session->set_flashdata('success', 'Status lamaran berhasil dimigrasi ke format baru.');
        } else {
            
            $this->session->set_flashdata('error', 'Gagal migrasi status lamaran. Silakan coba lagi.');
        }

        redirect('admin/lamaran');
    }

    
    public function atur_penilaian($job_id, $application_id = null) {
        
        $data['job'] = $this->model_lowongan->dapatkan_lowongan($job_id);

        
        if (!$data['job']) {
            show_404();
        }

        
        $data['assessments'] = $this->model_penilaian->dapatkan_penilaian_aktif();

        
        $data['assigned_assessments'] = $this->model_penilaian->dapatkan_penilaian_lowongan($job_id);

        
        if ($application_id) {
            $data['application'] = $this->model_lamaran->dapatkan_lamaran($application_id);

            
            if (!$data['application']) {
                show_404();
            }

            
            $data['applicant_assessments'] = $this->model_penilaian->dapatkan_penilaian_pelamar($application_id);
        }

        
        if ($this->input->post('submit')) {
            $assessment_ids = $this->input->post('assessment_ids');

            if ($application_id) {
                
                if (!empty($assessment_ids)) {
                    foreach ($assessment_ids as $assessment_id) {
                        
                        if (!$this->model_penilaian->cek_penilaian_sudah_ditetapkan($application_id, $assessment_id)) {
                            $applicant_assessment_data = array(
                                'id_lamaran' => $application_id,
                                'id_penilaian' => $assessment_id,
                                'status' => 'belum_mulai',
                                'ditugaskan_pada' => date('Y-m-d H:i:s'),
                                'ditugaskan_oleh' => $this->session->userdata('user_id'),
                                'dibuat_pada' => date('Y-m-d H:i:s')
                            );
                            $this->model_penilaian->tambah_penilaian_pelamar($applicant_assessment_data);
                        }
                    }
                    $this->session->set_flashdata('success', 'Penilaian berhasil ditetapkan kepada pelamar.');
                    redirect('admin/detail_lamaran/' . $application_id);
                } else {
                    $this->session->set_flashdata('error', 'Silakan pilih minimal satu penilaian.');
                }
            } else {
                
                
                $this->model_penilaian->hapus_semua_penilaian_lowongan($job_id);

                
                if (!empty($assessment_ids)) {
                    foreach ($assessment_ids as $assessment_id) {
                        $this->model_penilaian->tetapkan_penilaian_ke_lowongan($job_id, $assessment_id);
                    }
                    $this->session->set_flashdata('success', 'Penilaian berhasil ditetapkan untuk lowongan ini.');
                    redirect('admin/lowongan');
                } else {
                    $this->session->set_flashdata('error', 'Silakan pilih minimal satu penilaian.');
                }
            }
        }

        
        $data['title'] = 'Atur Penilaian';
        $this->load->view('templates/admin_header', $data);
        $this->load->view('admin/penilaian/atur', $data);
        $this->load->view('templates/admin_footer');
    }

    
    public function soal_penilaian($assessment_id) {
        
        $data['assessment'] = $this->model_penilaian->dapatkan_penilaian($assessment_id);

        
        if (!$data['assessment']) {
            show_404();
        }

        
        $data['questions'] = $this->model_penilaian->dapatkan_soal_penilaian($assessment_id);

        
        foreach ($data['questions'] as &$question) {
            if ($question->jenis_soal == 'pilihan_ganda' || $question->jenis_soal == 'benar_salah') {
                $options = $this->model_penilaian->dapatkan_opsi_soal($question->id);
                $question->option_count = count($options);
            } else {
                $question->option_count = 0;
            }
        }

        
        $data['title'] = 'Kelola Soal Penilaian';
        $this->load->view('templates/admin_header', $data);
        $this->load->view('admin/penilaian/soal', $data);
        $this->load->view('templates/admin_footer');
    }

    
    public function hasilPenilaian($assessment_id) {
        
        $data['assessment'] = $this->model_penilaian->dapatkan_penilaian($assessment_id);

        
        if (!$data['assessment']) {
            show_404();
        }

        
        $data['results'] = $this->model_penilaian->dapatkan_hasil_penilaian($assessment_id);

        
        $data['stats'] = [
            'total_applicants' => $this->model_penilaian->hitung_pelamar_penilaian($assessment_id),
            'completed' => $this->model_penilaian->hitung_penyelesaian_penilaian($assessment_id),
            'avg_score' => $this->model_penilaian->dapatkan_rata_rata_skor($assessment_id)
        ];

        
        $data['title'] = 'Hasil Penilaian';
        $this->load->view('templates/admin_header', $data);
        $this->load->view('admin/penilaian/hasil', $data);
        $this->load->view('templates/admin_footer');
    }

    
    public function detailHasilPenilaian($applicant_assessment_id) {
        
        $data['applicant_assessment'] = $this->model_penilaian->dapatkan_detail_penilaian_pelamar($applicant_assessment_id);

        
        if (!$data['applicant_assessment']) {
            show_404();
        }

        
        $data['assessment'] = $this->model_penilaian->dapatkan_penilaian($data['applicant_assessment']->id_penilaian);

        
        $data['questions_with_answers'] = $this->model_penilaian->dapatkan_soal_dengan_jawaban_pelamar($applicant_assessment_id);

        
        $data['applicant'] = $this->model_pengguna->dapatkan_pengguna($data['applicant_assessment']->id_pelamar);

        
        $data['title'] = 'Detail Hasil Penilaian Pelamar';
        $this->load->view('templates/admin_header', $data);
        $this->load->view('admin/penilaian/detail_hasil', $data);
        $this->load->view('templates/admin_footer');
    }

    
    public function update_nilai_jawaban() {
        
        header('Content-Type: application/json');

        
        $answer_id = $this->input->post('answer_id');
        $nilai = $this->input->post('nilai');

        
        if (!$answer_id || $nilai === null || $nilai === '') {
            echo json_encode(['status' => 'error', 'message' => 'Data tidak lengkap']);
            return;
        }

        
        if (!is_numeric($nilai) || $nilai < 0) {
            echo json_encode(['status' => 'error', 'message' => 'Nilai harus berupa angka positif']);
            return;
        }

        
        $user_id = $this->session->userdata('user_id');

        
        $result = $this->model_penilaian->update_nilai_jawaban($answer_id, $nilai, $user_id);

        if ($result) {
            
            $this->db->select('id_penilaian_pelamar');
            $this->db->where('id', $answer_id);
            $answer_query = $this->db->get('jawaban_pelamar');
            $answer = $answer_query->row();

            if ($answer) {
                
                $this->model_penilaian->hitung_skor_penilaian_pelamar($answer->id_penilaian_pelamar);
            }

            echo json_encode(['status' => 'success', 'message' => 'Nilai berhasil disimpan']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal menyimpan nilai']);
        }
    }

    
    public function previewPenilaian($assessment_id) {
        
        $data['assessment'] = $this->model_penilaian->dapatkan_penilaian($assessment_id);

        
        if (!$data['assessment']) {
            show_404();
        }

        
        $data['questions'] = $this->model_penilaian->dapatkan_soal_penilaian($assessment_id);
        foreach ($data['questions'] as &$question) {
            if ($question->jenis_soal == 'pilihan_ganda' || $question->jenis_soal == 'benar_salah') {
                $question->options = $this->model_penilaian->dapatkan_opsi_soal($question->id);
            }
        }

        
        $data['title'] = 'Pratinjau Penilaian';
        $data['preview_mode'] = true;
        $this->load->view('templates/admin_header', $data);
        $this->load->view('admin/penilaian/pratinjau', $data);
        $this->load->view('templates/admin_footer');
    }

    
    public function tetapkanPenilaian($assessment_id) {
        
        $data['assessment'] = $this->model_penilaian->dapatkan_penilaian($assessment_id);

        
        if (!$data['assessment']) {
            show_404();
        }

        
        
        $job_id = $this->model_penilaian->dapatkan_lowongan_penilaian($assessment_id);

        if ($job_id && isset($job_id->job_id)) {
            
            $data['applications'] = $this->model_lamaran->dapatkan_lamaran_lowongan($job_id->job_id);
            $data['job'] = $this->model_lowongan->dapatkan_lowongan($job_id->job_id);
        } else {
            
            $data['applications'] = $this->model_lamaran->dapatkan_semua_lamaran_aktif();
            $data['job'] = null;
        }

        
        if ($this->input->post()) {
            $application_ids = $this->input->post('application_ids');
            $tanggal_penilaian = $this->input->post('tanggal_penilaian');

            if (!empty($application_ids)) {
                $success_count = 0;
                $already_assigned = 0;

                foreach ($application_ids as $application_id) {
                    
                    if (!$this->model_penilaian->cek_penilaian_sudah_ditetapkan($application_id, $assessment_id)) {
                        $applicant_assessment_data = array(
                            'id_lamaran' => $application_id,
                            'id_penilaian' => $assessment_id,
                            'status' => 'belum_mulai',
                            'tanggal_penilaian' => $tanggal_penilaian,
                            'ditugaskan_pada' => date('Y-m-d H:i:s'),
                            'ditugaskan_oleh' => $this->session->userdata('user_id'),
                            'dibuat_pada' => date('Y-m-d H:i:s')
                        );
                        $this->model_penilaian->tambah_penilaian_pelamar($applicant_assessment_data);
                        $success_count++;
                    } else {
                        $already_assigned++;
                    }
                }

                if ($success_count > 0) {
                    $this->session->set_flashdata('success', $success_count . ' pelamar berhasil ditetapkan untuk penilaian ini.');
                }

                if ($already_assigned > 0) {
                    $this->session->set_flashdata('info', $already_assigned . ' pelamar sudah ditetapkan sebelumnya.');
                }

                redirect('admin/hasil-penilaian/' . $assessment_id);
            } else {
                $this->session->set_flashdata('error', 'Silakan pilih minimal satu pelamar.');
            }
        }

        
        $data['title'] = 'Tetapkan Penilaian ke Pelamar';
        $this->load->view('templates/admin_header', $data);
        $this->load->view('admin/penilaian/tetapkan', $data);
        $this->load->view('templates/admin_footer');
    }

    
    public function tambah_soal($assessment_id) {
        
        $data['assessment'] = $this->model_penilaian->dapatkan_penilaian($assessment_id);

        
        if (!$data['assessment']) {
            show_404();
        }

        
        $this->form_validation->set_rules('question_text', 'Teks Pertanyaan', 'trim|required');
        $this->form_validation->set_rules('question_type', 'Jenis Pertanyaan', 'trim|required');
        $this->form_validation->set_rules('points', 'Poin', 'trim|required|numeric');

        if ($this->form_validation->run() == FALSE) {
            
            $data['title'] = 'Tambah Soal Baru';
            $this->load->view('templates/admin_header', $data);
            $this->load->view('admin/penilaian/tambah_soal', $data);
            $this->load->view('templates/admin_footer');
        } else {
            
            $question_data = array(
                'id_penilaian' => $assessment_id,
                'teks_soal' => $this->input->post('question_text'),
                'jenis_soal' => $this->input->post('question_type'),
                'poin' => $this->input->post('points'),
                'dibuat_pada' => date('Y-m-d H:i:s')
            );

            
            if (!empty($_FILES['question_image']['name'])) {
                
                $upload_dir = 'uploads/gambar_soal';
                $upload_path = str_replace('\\', '/', realpath(FCPATH . $upload_dir));

                
                log_message('debug', 'FCPATH: ' . FCPATH);
                log_message('debug', 'Upload directory: ' . $upload_dir);
                log_message('debug', 'Full upload path: ' . $upload_path);
                log_message('debug', 'Directory exists: ' . (is_dir($upload_path) ? 'Yes' : 'No'));
                log_message('debug', 'Directory writable: ' . (is_writable($upload_path) ? 'Yes' : 'No'));

                
                if (!is_dir($upload_path)) {
                    if (!mkdir($upload_path, 0777, true)) {
                        log_message('error', 'Failed to create directory: ' . $upload_path);
                        $this->session->set_flashdata('error', 'Gagal membuat direktori upload: ' . $upload_path);
                        redirect('admin/tambah_soal/' . $assessment_id);
                        return;
                    }
                }

                
                if (!is_writable($upload_path)) {
                    if (!chmod($upload_path, 0777)) {
                        log_message('error', 'Failed to set directory permissions: ' . $upload_path);
                        $this->session->set_flashdata('error', 'Direktori tidak dapat ditulis: ' . $upload_path);
                        redirect('admin/tambah_soal/' . $assessment_id);
                        return;
                    }
                }

                
                $this->load->library('upload');

                
                $config = array(
                    'upload_path' => $upload_path,
                    'allowed_types' => 'gif|jpg|jpeg|png',
                    'max_size' => 4096, 
                    'file_name' => 'question_' . time() . '_' . rand(1000, 9999),
                    'overwrite' => FALSE,
                    'remove_spaces' => TRUE,
                    'encrypt_name' => FALSE
                );

                
                $this->upload->initialize($config);

                
                if ($this->upload->do_upload('question_image')) {
                    $upload_data = $this->upload->data();
                    $question_data['gambar_soal'] = $upload_data['file_name'];
                } else {
                    $error = $this->upload->display_errors();
                    log_message('error', 'Upload error: ' . $error);
                    log_message('error', 'Upload path used: ' . $config['upload_path']);
                    $this->session->set_flashdata('error', 'Gagal mengunggah gambar: ' . $error);
                    redirect('admin/tambah_soal/' . $assessment_id);
                    return;
                }
            }

            
            $question_id = $this->model_penilaian->tambah_soal($question_data);

            if ($question_id) {
                
                if ($this->input->post('question_type') == 'pilihan_ganda' || $this->input->post('question_type') == 'benar_salah') {
                    redirect('admin/opsi_soal/' . $question_id);
                } else {
                    
                    $this->session->set_flashdata('success', 'Soal berhasil ditambahkan.');
                    redirect('admin/soal_penilaian/' . $assessment_id);
                }
            } else {
                
                $this->session->set_flashdata('error', 'Gagal menambahkan soal. Silakan coba lagi.');
                redirect('admin/tambah_soal/' . $assessment_id);
            }
        }
    }

    
    public function opsi_soal($question_id) {
        
        $this->db->select('soal.*, penilaian.judul as assessment_title, penilaian.id as assessment_id');
        $this->db->from('soal');
        $this->db->join('penilaian', 'penilaian.id = soal.id_penilaian', 'left');
        $this->db->where('soal.id', $question_id);
        $query = $this->db->get();
        $data['question'] = $query->row();

        
        if (!$data['question']) {
            show_404();
        }

        
        $data['options'] = $this->model_penilaian->dapatkan_opsi_soal($question_id);

        
        $data['title'] = 'Kelola Opsi Soal';
        $this->load->view('templates/admin_header', $data);
        $this->load->view('admin/penilaian/opsi', $data);
        $this->load->view('templates/admin_footer');
    }

    
    public function simpan_opsi_soal($question_id) {
        
        $this->db->select('soal.*, penilaian.id as assessment_id');
        $this->db->from('soal');
        $this->db->join('penilaian', 'penilaian.id = soal.id_penilaian', 'left');
        $this->db->where('soal.id', $question_id);
        $query = $this->db->get();
        $question = $query->row();

        
        if (!$question) {
            show_404();
        }

        
        if ($question->jenis_soal == 'benar_salah') {
            
            $correct_option = $this->input->post('correct_option');

            
            $this->db->where('id_soal', $question_id);
            $this->db->delete('pilihan_soal');

            
            $true_option = array(
                'id_soal' => $question_id,
                'teks_pilihan' => 'Benar',
                'benar' => ($correct_option == 'true') ? 1 : 0,
                'dibuat_pada' => date('Y-m-d H:i:s')
            );
            $this->model_penilaian->tambah_opsi_soal($true_option);

            
            $false_option = array(
                'id_soal' => $question_id,
                'teks_pilihan' => 'Salah',
                'benar' => ($correct_option == 'false') ? 1 : 0,
                'dibuat_pada' => date('Y-m-d H:i:s')
            );
            $this->model_penilaian->tambah_opsi_soal($false_option);
        } else {
            
            $options = $this->input->post('options');
            $option_ids = $this->input->post('option_ids');
            $correct_option = $this->input->post('correct_option');

            
            if (empty($option_ids)) {
                
                $this->db->where('id_soal', $question_id);
                $this->db->delete('pilihan_soal');

                
                foreach ($options as $index => $option_text) {
                    if (trim($option_text) != '') {
                        $option_data = array(
                            'id_soal' => $question_id,
                            'teks_pilihan' => $option_text,
                            'benar' => ($index == $correct_option) ? 1 : 0,
                            'dibuat_pada' => date('Y-m-d H:i:s')
                        );
                        $this->model_penilaian->tambah_opsi_soal($option_data);
                    }
                }
            } else {
                
                foreach ($option_ids as $index => $option_id) {
                    if (isset($options[$index]) && trim($options[$index]) != '') {
                        $option_data = array(
                            'teks_pilihan' => $options[$index],
                            'benar' => ($index == $correct_option) ? 1 : 0,
                            'diperbarui_pada' => date('Y-m-d H:i:s')
                        );
                        $this->model_penilaian->perbarui_opsi_soal($option_id, $option_data);
                    }
                }

                
                for ($i = count($option_ids); $i < count($options); $i++) {
                    if (trim($options[$i]) != '') {
                        $option_data = array(
                            'id_soal' => $question_id,
                            'teks_pilihan' => $options[$i],
                            'benar' => ($i == $correct_option) ? 1 : 0,
                            'dibuat_pada' => date('Y-m-d H:i:s')
                        );
                        $this->model_penilaian->tambah_opsi_soal($option_data);
                    }
                }
            }
        }

        
        $this->session->set_flashdata('success', 'Opsi soal berhasil disimpan.');
        redirect('admin/soal_penilaian/' . $question->assessment_id);
    }

    
    public function simpanOpsiSoal($question_id) {
        
        return $this->simpan_opsi_soal($question_id);
    }

    
    private function dapatkan_data_chart_penilaian() {
        
        $this->db->select('jenis_penilaian.nama as type_name, COUNT(penilaian.id) as count');
        $this->db->from('penilaian');
        $this->db->join('jenis_penilaian', 'jenis_penilaian.id = penilaian.id_jenis', 'left');
        $this->db->group_by('penilaian.id_jenis');
        $this->db->order_by('count', 'DESC');
        $type_stats = $this->db->get()->result();

        
        $this->db->select('penilaian.judul, jenis_penilaian.nama as type_name,
                          COUNT(penilaian_pelamar.id) as total_assigned,
                          SUM(CASE WHEN penilaian_pelamar.status = "selesai" THEN 1 ELSE 0 END) as completed');
        $this->db->from('penilaian');
        $this->db->join('jenis_penilaian', 'jenis_penilaian.id = penilaian.id_jenis', 'left');
        $this->db->join('penilaian_pelamar', 'penilaian_pelamar.id_penilaian = penilaian.id', 'left');
        $this->db->group_by('penilaian.id');
        $this->db->having('total_assigned > 0');
        $this->db->order_by('total_assigned', 'DESC');
        $this->db->limit(5); 
        $completion_stats = $this->db->get()->result();

        return [
            'type_stats' => $type_stats,
            'completion_stats' => $completion_stats
        ];
    }

    

    
    public function edit_soal($question_id) {
        
        $this->db->select('soal.*, penilaian.judul as assessment_title, penilaian.id as assessment_id');
        $this->db->from('soal');
        $this->db->join('penilaian', 'penilaian.id = soal.id_penilaian', 'left');
        $this->db->where('soal.id', $question_id);
        $query = $this->db->get();
        $data['question'] = $query->row();

        
        if (!$data['question']) {
            show_404();
        }

        
        $this->form_validation->set_rules('question_text', 'Teks Pertanyaan', 'trim|required');
        $this->form_validation->set_rules('question_type', 'Jenis Pertanyaan', 'trim|required');
        $this->form_validation->set_rules('points', 'Poin', 'trim|required|numeric');

        if ($this->form_validation->run() == FALSE) {
            
            $data['title'] = 'Edit Soal';
            $this->load->view('templates/admin_header', $data);
            $this->load->view('admin/penilaian/edit_soal', $data);
            $this->load->view('templates/admin_footer');
        } else {
            
            $question_data = array(
                'teks_soal' => $this->input->post('question_text'),
                'jenis_soal' => $this->input->post('question_type'),
                'poin' => $this->input->post('points'),
                'diperbarui_pada' => date('Y-m-d H:i:s')
            );

            
            if ($_FILES['question_image']['name']) {
                
                $current_question = $this->model_penilaian->dapatkan_soal($question_id);

                
                $upload_path_full = FCPATH . 'uploads/gambar_soal/';

                if (!is_dir($upload_path_full)) {
                    if (!mkdir($upload_path_full, 0777, true)) {
                        $this->session->set_flashdata('error', 'Gagal membuat folder upload: ' . $upload_path_full);
                        redirect('admin/edit_soal/' . $question_id);
                        return;
                    }
                }

                
                if (!is_writable($upload_path_full)) {
                    $this->session->set_flashdata('error', 'Folder tidak dapat ditulis: ' . $upload_path_full);
                    redirect('admin/edit_soal/' . $question_id);
                    return;
                }

                
                $config['upload_path'] = $upload_path_full;
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['max_size'] = 4096; 
                $config['file_name'] = 'question_' . time() . '_' . rand(1000, 9999);
                $config['encrypt_name'] = FALSE;

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('question_image')) {
                    $upload_data = $this->upload->data();
                    $question_data['gambar_soal'] = $upload_data['file_name'];

                    
                    if ($current_question && $current_question->gambar_soal) {
                        $old_file_path = $upload_path_full . $current_question->gambar_soal;
                        if (file_exists($old_file_path)) {
                            unlink($old_file_path);
                        }
                    }
                } else {
                    $this->session->set_flashdata('error', 'Gagal mengunggah gambar: ' . $this->upload->display_errors());
                    redirect('admin/edit_soal/' . $question_id);
                    return;
                }
            }

            
            $result = $this->model_penilaian->perbarui_soal($question_id, $question_data);

            if ($result) {
                
                $this->session->set_flashdata('success', 'Soal berhasil diperbarui.');
                redirect('admin/soal_penilaian/' . $data['question']->assessment_id);
            } else {
                
                $this->session->set_flashdata('error', 'Gagal memperbarui soal. Silakan coba lagi.');
                redirect('admin/edit_soal/' . $question_id);
            }
        }
    }

    
    public function hapus_soal($question_id) {
        
        if (!$this->session->userdata('logged_in') || $this->session->userdata('role') != 'admin') {
            redirect('auth/login');
        }

        
        $this->db->select('soal.*, penilaian.id as assessment_id');
        $this->db->from('soal');
        $this->db->join('penilaian', 'penilaian.id = soal.id_penilaian', 'left');
        $this->db->where('soal.id', $question_id);
        $query = $this->db->get();
        $question = $query->row();

        if (!$question) {
            show_404();
        }

        
        $result = $this->model_penilaian->hapus_soal($question_id);

        if ($result) {
            $this->session->set_flashdata('success', 'Soal berhasil dihapus.');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus soal.');
        }

        redirect('admin/soal_penilaian/' . $question->assessment_id);
    }

    public function pratinjau_penilaian($assessment_id) {
        return $this->previewPenilaian($assessment_id);
    }

    public function hasil_penilaian($assessment_id) {
        return $this->hasilPenilaian($assessment_id);
    }



    public function hapus_gambar_soal($question_id) {
        
        if (!$this->session->userdata('logged_in') || $this->session->userdata('role') != 'admin') {
            redirect('auth/login');
        }

        $result = $this->model_penilaian->hapus_gambar_soal($question_id);

        if ($result) {
            echo json_encode(['status' => 'success', 'message' => 'Gambar soal berhasil dihapus.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal menghapus gambar soal.']);
        }
    }

    public function tetapkan_ke_pelamar($assessment_id) {
        return $this->tetapkanPenilaian($assessment_id);
    }

    
    public function pengguna() {
        
        $this->check_admin_access();

        
        $data['users'] = $this->model_pengguna->dapatkan_pengguna_semua();

        
        $data['user_stats'] = array(
            'admin_count' => $this->model_pengguna->hitung_pengguna_berdasarkan_role('admin'),
            'applicant_count' => $this->model_pengguna->hitung_pelamar(),
            'recruiter_count' => $this->model_pengguna->hitung_pengguna_berdasarkan_role('staff')
        );

        
        $data['title'] = 'Manajemen Pengguna';
        $this->load->view('templates/admin_header', $data);
        $this->load->view('admin/pengguna/index', $data);
        $this->load->view('templates/admin_footer');
    }

    
    public function tambah_pengguna() {
        
        $this->check_admin_access();

        
        $this->load->config('upload');

        
        $this->form_validation->set_rules('username', 'Username', 'trim|required|is_unique[pengguna.nama_pengguna]');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[pengguna.email]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');
        $this->form_validation->set_rules('role', 'Role', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Tambah Pengguna Baru';
            $this->load->view('templates/admin_header', $data);
            $this->load->view('admin/pengguna/tambah', $data);
            $this->load->view('templates/admin_footer');
        } else {
            
            $profile_picture = '';
            if (!empty($_FILES['profile_picture']['name'])) {
                
                $upload_dir = 'uploads/profile_pictures';
                $upload_path = str_replace('\\', '/', realpath(FCPATH . $upload_dir));

                
                if (!is_dir($upload_path)) {
                    if (!mkdir($upload_path, 0777, true)) {
                        $this->session->set_flashdata('error', 'Gagal membuat direktori upload: ' . $upload_path);
                        redirect('admin/tambah_pengguna');
                        return;
                    }
                }

                
                if (!is_writable($upload_path)) {
                    if (!chmod($upload_path, 0777)) {
                        $this->session->set_flashdata('error', 'Direktori tidak dapat ditulis: ' . $upload_path);
                        redirect('admin/tambah_pengguna');
                        return;
                    }
                }

                
                $this->load->library('upload');

                
                $config = $this->config->item('upload_config');
                $config['upload_path'] = $upload_path;

                
                $this->upload->initialize($config);

                
                if ($this->upload->do_upload('profile_picture')) {
                    $upload_data = $this->upload->data();
                    $profile_picture = $upload_data['file_name'];
                } else {
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('error', 'Gagal mengunggah gambar: ' . $error);
                    redirect('admin/tambah_pengguna');
                    return;
                }
            }

            
            $user_data = array(
                'nama_pengguna' => $this->input->post('username'),
                'email' => $this->input->post('email'),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'role' => $this->input->post('role'),
                'nama_lengkap' => $this->input->post('nama_lengkap'),
                'status' => $this->input->post('status') ? 'aktif' : 'nonaktif',
                'foto_profil' => $profile_picture,
                'dibuat_pada' => date('Y-m-d H:i:s')
            );

            
            $user_id = $this->model_pengguna->tambah_pengguna($user_data);

            if ($user_id) {
                $this->session->set_flashdata('success', 'Pengguna berhasil ditambahkan.');
                redirect('admin/pengguna');
            } else {
                $this->session->set_flashdata('error', 'Gagal menambahkan pengguna. Silakan coba lagi.');
                redirect('admin/tambah_pengguna');
            }
        }
    }

    
    public function edit_pengguna($id) {
        
        $this->check_admin_access();

        
        $data['user'] = $this->model_pengguna->dapatkan_pengguna($id);

        
        if (!$data['user']) {
            show_404();
        }

        
        $this->form_validation->set_rules('nama_pengguna', 'Username', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'trim|required');
        $this->form_validation->set_rules('role', 'Role', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            
            $data['title'] = 'Edit Pengguna';
            $this->load->view('templates/admin_header', $data);
            $this->load->view('admin/pengguna/edit', $data);
            $this->load->view('templates/admin_footer');
        } else {
            
            $user_data = array(
                'nama_pengguna' => $this->input->post('nama_pengguna'),
                'email' => $this->input->post('email'),
                'nama_lengkap' => $this->input->post('nama_lengkap'),
                'telepon' => $this->input->post('telepon'),
                'alamat' => $this->input->post('alamat'),
                'role' => $this->input->post('role'),
                'status' => $this->input->post('status') ? 'aktif' : 'nonaktif',
                'diperbarui_pada' => date('Y-m-d H:i:s')
            );

            
            if ($_FILES['profile_picture']['name']) {
                
                $upload_path = './uploads/profile_pictures/';

                
                if (!is_dir($upload_path)) {
                    mkdir($upload_path, 0755, true);
                }

                $config['upload_path'] = $upload_path;
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['max_size'] = 2048; 
                $config['file_name'] = 'profile_' . time();

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('profile_picture')) {
                    
                    if (isset($data['user']->foto_profil) && $data['user']->foto_profil) {
                        $old_file = $upload_path_full . $data['user']->foto_profil;
                        if (file_exists($old_file)) {
                            unlink($old_file);
                        }
                    }

                    $upload_data = $this->upload->data();
                    $user_data['foto_profil'] = $upload_data['file_name'];
                } else {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('admin/edit_pengguna/' . $id);
                }
            }

            
            $result = $this->model_pengguna->perbarui_pengguna($id, $user_data);

            if ($result) {
                
                if ($user_data['role'] == 'pelamar') {
                    $profile = $this->model_pelamar->dapatkan_profil($id);

                    if (!$profile) {
                        $profile_data = array(
                            'id_pengguna' => $id,
                            'dibuat_pada' => date('Y-m-d H:i:s')
                        );
                        $this->model_pelamar->tambah_profil($profile_data);
                    }
                }

                
                $this->session->set_flashdata('success', 'Informasi pengguna berhasil diperbarui.');
                redirect('admin/pengguna');
            } else {
                
                $this->session->set_flashdata('error', 'Gagal memperbarui informasi pengguna. Silakan coba lagi.');
                redirect('admin/edit_pengguna/' . $id);
            }
        }
    }

    
    public function hapus_pengguna($id) {
        
        $result = $this->model_pengguna->hapus_pengguna($id);

        if ($result) {
            
            $this->session->set_flashdata('success', 'Pengguna berhasil dihapus.');
        } else {
            
            $this->session->set_flashdata('error', 'Gagal menghapus pengguna. Silakan coba lagi.');
        }

        redirect('admin/pengguna');
    }

    
    public function aktifkan_pengguna($id) {
        
        $this->check_admin_access();

        $result = $this->model_pengguna->perbarui_pengguna($id, array('status' => 'aktif'));

        if ($result) {
            $this->session->set_flashdata('success', 'Pengguna berhasil diaktifkan.');
        } else {
            $this->session->set_flashdata('error', 'Gagal mengaktifkan pengguna. Silakan coba lagi.');
        }

        redirect('admin/pengguna');
    }

    
    public function nonaktifkan_pengguna($id) {
        
        $this->check_admin_access();

        $result = $this->model_pengguna->perbarui_pengguna($id, array('status' => 'nonaktif'));

        if ($result) {
            $this->session->set_flashdata('success', 'Pengguna berhasil dinonaktifkan.');
        } else {
            $this->session->set_flashdata('error', 'Gagal menonaktifkan pengguna. Silakan coba lagi.');
        }

        redirect('admin/pengguna');
    }

    
    public function reset_kata_sandi($id) {
        
        $new_password = substr(md5(uniqid(rand(), true)), 0, 8);

        
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        
        $result = $this->model_pengguna->perbarui_password($id, $hashed_password);

        if ($result) {
            
            $user = $this->model_pengguna->dapatkan_pengguna($id);

            
            $this->load->library('email');

            $this->email->from('noreply@sirek.com', 'SIREK System');
            $this->email->to($user->email);
            $this->email->subject('Password Reset');
            $this->email->message('Your password has been reset. Your new password is: ' . $new_password);

            if ($this->email->send()) {
                $this->session->set_flashdata('success', 'Password berhasil direset dan dikirim ke email pengguna.');
            } else {
                $this->session->set_flashdata('success', 'Password berhasil direset tetapi gagal mengirim email. Password baru: ' . $new_password);
            }
        } else {
            $this->session->set_flashdata('error', 'Gagal mereset password. Silakan coba lagi.');
        }

        redirect('admin/pengguna');
    }

    
    public function profil() {
        
        $user_id = $this->session->userdata('user_id');
        $data['user'] = $this->model_pengguna->dapatkan_pengguna($user_id);

        
        if (!$data['user']) {
            redirect('auth/login');
        }

        
        $data['title'] = 'Profil Saya';
        $this->load->view('templates/admin_header', $data);
        $this->load->view('admin/profil', $data);
        $this->load->view('templates/admin_footer');
    }

    
    public function ubah_password() {
        
        $this->form_validation->set_rules('current_password', 'Password Saat Ini', 'trim|required');
        $this->form_validation->set_rules('new_password', 'Password Baru', 'trim|required|min_length[6]');
        $this->form_validation->set_rules('confirm_password', 'Konfirmasi Password', 'trim|required|matches[new_password]');

        if ($this->form_validation->run() == FALSE) {
            
            $data['title'] = 'Ubah Password';
            $this->load->view('templates/admin_header', $data);
            $this->load->view('admin/ubah_password');
            $this->load->view('templates/admin_footer');
        } else {
            
            $user_id = $this->session->userdata('user_id');
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password');

            
            $user = $this->model_pengguna->dapatkan_pengguna($user_id);

            if (password_verify($current_password, $user->password)) {
                
                $this->model_pengguna->perbarui_password($user_id, password_hash($new_password, PASSWORD_DEFAULT));

                
                $this->session->set_flashdata('success', 'Password berhasil diubah.');
                redirect('admin/profil');
            } else {
                
                $this->session->set_flashdata('error', 'Password saat ini tidak benar.');
                redirect('admin/ubah-password');
            }
        }
    }

    
    public function profil_pelamar($id) {
        
        $data['user'] = $this->model_pengguna->dapatkan_pengguna($id);

        
        if (!$data['user'] || $data['user']->role != 'pelamar') {
            show_404();
        }

        
        $data['profile'] = $this->model_pelamar->dapatkan_profil($id);

        
        $data['documents'] = $this->model_dokumen->dapatkan_dokumen_pelamar($id);

        
        $data['title'] = 'Profil Pelamar';
        $this->load->view('templates/admin_header', $data);
        $this->load->view('admin/pengguna/profil_pelamar', $data);
        $this->load->view('templates/admin_footer');
    }

    
    public function profilPelamar($id) {
        
        $data['user'] = $this->model_pengguna->dapatkan_pengguna($id);

        
        if (!$data['user'] || $data['user']->role != 'pelamar') {
            show_404();
        }

        
        $data['profile'] = $this->model_pelamar->dapatkan_profil($id);

        
        $data['documents'] = $this->model_dokumen->dapatkan_dokumen_pelamar($id);

        
        $data['title'] = 'Profil Pelamar';
        $this->load->view('templates/admin_header', $data);
        $this->load->view('admin/pengguna/profil_pelamar', $data);
        $this->load->view('templates/admin_footer');
    }

    
    public function lamaran_pelamar($id) {
        
        $data['user'] = $this->model_pengguna->dapatkan_pengguna($id);

        
        if (!$data['user'] || $data['user']->role != 'pelamar') {
            show_404();
        }

        
        $data['applications'] = $this->model_lamaran->dapatkan_lamaran_pelamar($id);

        
        $data['title'] = 'Lamaran Pelamar';
        $this->load->view('templates/admin_header', $data);
        $this->load->view('admin/pengguna/lamaran_pelamar', $data);
        $this->load->view('templates/admin_footer');
    }

    
    public function ekspor_lamaran_pelamar($id) {
        
        $this->load->helper('phpspreadsheet');

        
        $user = $this->model_pengguna->dapatkan_pengguna($id);

        
        if (!$user || $user->role != 'pelamar') {
            show_404();
        }

        
        $applications = $this->model_lamaran->dapatkan_lamaran_pelamar($id);

        
        if (!load_phpspreadsheet()) {
            $this->session->set_flashdata('error', 'PhpSpreadsheet library tidak tersedia. Silakan hubungi administrator.');
            redirect('admin/lamaran_pelamar/' . $id);
        }

        
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        
        $spreadsheet->getProperties()
            ->setCreator('Sistem Rekrutmen')
            ->setLastModifiedBy('Admin')
            ->setTitle('Daftar Lamaran ' . $user->nama_lengkap)
            ->setSubject('Daftar Lamaran Pelamar')
            ->setDescription('Daftar lamaran yang diajukan oleh ' . $user->nama_lengkap);

        
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Lowongan');
        $sheet->setCellValue('C1', 'Tipe Pekerjaan');
        $sheet->setCellValue('D1', 'Lokasi');
        $sheet->setCellValue('E1', 'Tanggal Lamaran');
        $sheet->setCellValue('F1', 'Status');
        $sheet->setCellValue('G1', 'Penilaian');

        
        $headerStyle = [
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => '4E73DF'],
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ];

        $sheet->getStyle('A1:G1')->applyFromArray($headerStyle);

        
        $sheet->getColumnDimension('A')->setWidth(5);
        $sheet->getColumnDimension('B')->setWidth(40);
        $sheet->getColumnDimension('C')->setWidth(15);
        $sheet->getColumnDimension('D')->setWidth(20);
        $sheet->getColumnDimension('E')->setWidth(20);
        $sheet->getColumnDimension('F')->setWidth(15);
        $sheet->getColumnDimension('G')->setWidth(15);

        
        $row = 2;
        $no = 1;

        foreach ($applications as $application) {
            
            $assessment_count = $this->model_penilaian->hitung_penilaian_pelamar($application->id);
            $completed_count = $this->model_penilaian->hitung_penilaian_selesai($application->id);

            
            $job_type = $application->job_type == 'full_time' ? 'Full Time' :
                       ($application->job_type == 'part_time' ? 'Part Time' :
                       ($application->job_type == 'contract' ? 'Kontrak' : $application->job_type));

            
            $assessment_status = ($assessment_count > 0) ?
                                $completed_count . '/' . $assessment_count . ' Selesai' :
                                'Tidak Ada';

            
            $sheet->setCellValue('A' . $row, $no);
            $sheet->setCellValue('B' . $row, $application->job_title);
            $sheet->setCellValue('C' . $row, $job_type);
            $sheet->setCellValue('D' . $row, $application->location);
            $sheet->setCellValue('E' . $row, date('d M Y', strtotime($application->application_date)));
            $sheet->setCellValue('F' . $row, ucfirst($application->status));
            $sheet->setCellValue('G' . $row, $assessment_status);

            
            $rowStyle = [
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    ],
                ],
            ];

            $sheet->getStyle('A' . $row . ':G' . $row)->applyFromArray($rowStyle);

            $row++;
            $no++;
        }

        
        $sheet->insertNewRowBefore(1, 2);
        $sheet->mergeCells('A1:G1');
        $sheet->setCellValue('A1', 'DAFTAR LAMARAN ' . strtoupper($user->nama_lengkap));
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        
        $filename = 'Lamaran_' . str_replace(' ', '_', $user->nama_lengkap) . '_' . date('Y-m-d') . '.xlsx';
        download_excel_file($spreadsheet, $filename);
    }

    
    public function lowongan_rekruter($id) {
        
        $data['user'] = $this->model_pengguna->dapatkan_pengguna($id);

        
        if (!$data['user'] || ($data['user']->role != 'recruiter' && $data['user']->role != 'staff')) {
            show_404();
        }

        
        $data['jobs'] = $this->model_lowongan->dapatkan_lowongan_recruiter($id);

        
        $data['title'] = 'Lowongan yang Dikelola';
        $this->load->view('templates/admin_header', $data);
        $this->load->view('admin/pengguna/pekerjaan_rekruter', $data);
        $this->load->view('templates/admin_footer');
    }

    
    public function blog() {
        
        $this->check_admin_access();

        
        $data['posts'] = $this->model_blog->dapatkan_artikel_semua();

        
        $data['categories'] = $this->model_kategori->dapatkan_kategori_blog();

        
        $data['title'] = 'Manajemen Blog';
        $this->load->view('templates/admin_header', $data);
        $this->load->view('admin/blog/index', $data);
        $this->load->view('templates/admin_footer');
    }

    

    
    public function laporan() {
        
        $this->load->model('model_laporan');

        
        $data['summary'] = $this->model_laporan->dapatkan_ringkasan_laporan();

        
        $data['title'] = 'Laporan & Statistik';
        $this->load->view('templates/admin_header', $data);
        $this->load->view('admin/laporan/index', $data);
        $this->load->view('templates/admin_footer');
    }

    
    public function laporan_lowongan() {
        $this->load->model('model_laporan');

        
        $filters = [
            'periode' => $this->input->get('periode') ?: 'bulan',
            'tanggal_mulai' => $this->input->get('tanggal_mulai'),
            'tanggal_selesai' => $this->input->get('tanggal_selesai'),
            'kategori' => $this->input->get('kategori'),
            'status' => $this->input->get('status'),
            'lokasi' => $this->input->get('lokasi')
        ];

        
        $data['lowongan'] = $this->model_laporan->laporan_lowongan($filters);
        $data['statistik_lowongan'] = $this->model_laporan->statistik_lowongan($filters);
        $data['filters'] = $filters;

        
        $this->load->model('model_kategori');
        $data['categories'] = $this->model_kategori->dapatkan_kategori_lowongan();
        $data['locations'] = $this->model_laporan->dapatkan_lokasi_lowongan();

        $data['title'] = 'Laporan Lowongan Pekerjaan';
        $this->load->view('templates/admin_header', $data);
        $this->load->view('admin/laporan/lowongan', $data);
        $this->load->view('templates/admin_footer');
    }

    
    public function laporan_lamaran() {
        $this->load->model('model_laporan');

        
        $filters = [
            'periode' => $this->input->get('periode') ?: 'bulan',
            'tanggal_mulai' => $this->input->get('tanggal_mulai'),
            'tanggal_selesai' => $this->input->get('tanggal_selesai'),
            'status' => $this->input->get('status'),
            'lowongan' => $this->input->get('lowongan')
        ];

        
        $data['lamaran'] = $this->model_laporan->laporan_lamaran($filters);
        $data['statistik_lamaran'] = $this->model_laporan->statistik_lamaran($filters);
        $data['conversion_rate'] = $this->model_laporan->conversion_rate_lamaran($filters);
        $data['filters'] = $filters;

        
        $data['lowongan_list'] = $this->model_laporan->dapatkan_daftar_lowongan();

        $data['title'] = 'Laporan Lamaran';
        $this->load->view('templates/admin_header', $data);
        $this->load->view('admin/laporan/lamaran', $data);
        $this->load->view('templates/admin_footer');
    }

    
    public function laporan_pelamar() {
        $this->load->model('model_laporan');

        
        $filters = [
            'periode' => $this->input->get('periode') ?: 'bulan',
            'tanggal_mulai' => $this->input->get('tanggal_mulai'),
            'tanggal_selesai' => $this->input->get('tanggal_selesai'),
            'lokasi' => $this->input->get('lokasi'),
            'pendidikan' => $this->input->get('pendidikan')
        ];

        
        $data['pelamar'] = $this->model_laporan->laporan_pelamar($filters);
        $data['statistik_pelamar'] = $this->model_laporan->statistik_pelamar($filters);
        $data['aktivitas_login'] = $this->model_laporan->aktivitas_login_pelamar($filters);
        $data['filters'] = $filters;

        $data['title'] = 'Laporan Pelamar';
        $this->load->view('templates/admin_header', $data);
        $this->load->view('admin/laporan/pelamar', $data);
        $this->load->view('templates/admin_footer');
    }

    
    public function laporan_penilaian() {
        $this->load->model('model_laporan');

        
        $filters = [
            'periode' => $this->input->get('periode') ?: 'semua',
            'tanggal_mulai' => $this->input->get('tanggal_mulai'),
            'tanggal_selesai' => $this->input->get('tanggal_selesai'),
            'penilaian' => $this->input->get('penilaian'),
            'lowongan' => $this->input->get('lowongan')
        ];

        
        $data['hasil_penilaian'] = $this->model_laporan->laporan_hasil_penilaian($filters);
        $data['statistik_penilaian'] = $this->model_laporan->statistik_penilaian($filters);
        $data['tingkat_kelulusan'] = $this->model_laporan->tingkat_kelulusan_penilaian($filters);
        $data['filters'] = $filters;

        
        $data['penilaian_list'] = $this->model_laporan->dapatkan_daftar_penilaian();
        $data['lowongan_list'] = $this->model_laporan->dapatkan_daftar_lowongan();

        $data['title'] = 'Laporan Penilaian';
        $this->load->view('templates/admin_header', $data);
        $this->load->view('admin/laporan/penilaian', $data);
        $this->load->view('templates/admin_footer');
    }

    
    public function perbaiki_waktu_mulai() {
        $this->load->model('model_penilaian');

        $result = $this->model_penilaian->perbaiki_waktu_mulai_kosong();

        $this->session->set_flashdata('success',
            'Berhasil memperbaiki data waktu mulai: ' .
            $result['sedang_mengerjakan'] . ' data sedang mengerjakan, ' .
            $result['selesai'] . ' data selesai'
        );

        redirect('admin/laporan_penilaian');
    }

    
    public function export_laporan() {
        $this->load->model('model_laporan');

        $jenis = $this->input->get('jenis');
        $format = $this->input->get('format') ?: 'excel';

        
        $filters = [
            'periode' => $this->input->get('periode') ?: 'bulan',
            'tanggal_mulai' => $this->input->get('tanggal_mulai'),
            'tanggal_selesai' => $this->input->get('tanggal_selesai'),
            'kategori' => $this->input->get('kategori'),
            'status' => $this->input->get('status'),
            'lokasi' => $this->input->get('lokasi'),
            'lowongan' => $this->input->get('lowongan'),
            'penilaian' => $this->input->get('penilaian'),
            'pendidikan' => $this->input->get('pendidikan')
        ];

        switch ($jenis) {
            case 'lowongan':
                $data = $this->model_laporan->laporan_lowongan($filters);
                $filename = 'Laporan_Lowongan_' . date('Y-m-d_H-i-s');
                $this->_export_lowongan($data, $filename, $format);
                break;
            case 'lamaran':
                $data = $this->model_laporan->laporan_lamaran($filters);
                $filename = 'Laporan_Lamaran_' . date('Y-m-d_H-i-s');
                $this->_export_lamaran($data, $filename, $format);
                break;
            case 'pelamar':
                $data = $this->model_laporan->laporan_pelamar($filters);
                $filename = 'Laporan_Pelamar_' . date('Y-m-d_H-i-s');
                $this->_export_pelamar($data, $filename, $format);
                break;
            case 'penilaian':
                $data = $this->model_laporan->laporan_hasil_penilaian($filters);
                $filename = 'Laporan_Penilaian_' . date('Y-m-d_H-i-s');
                $this->_export_penilaian($data, $filename, $format);
                break;
            default:
                show_404();
        }
    }

    private function _export_lowongan($data, $filename, $format) {
        if ($format == 'excel') {
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="' . $filename . '.xls"');
            header('Cache-Control: max-age=0');

            echo '<table border="1">';
            echo '<tr>';
            echo '<th>No</th>';
            echo '<th>Judul Lowongan</th>';
            echo '<th>Kategori</th>';
            echo '<th>Lokasi</th>';
            echo '<th>Status</th>';
            echo '<th>Tanggal Dibuat</th>';
            echo '<th>Batas Waktu</th>';
            echo '</tr>';

            $no = 1;
            foreach ($data as $row) {
                echo '<tr>';
                echo '<td>' . $no++ . '</td>';
                echo '<td>' . $row->judul . '</td>';
                echo '<td>' . ($row->kategori_nama ?: 'Tidak ada kategori') . '</td>';
                echo '<td>' . $row->lokasi . '</td>';
                echo '<td>' . ucfirst($row->status) . '</td>';
                echo '<td>' . date('d/m/Y', strtotime($row->dibuat_pada)) . '</td>';
                echo '<td>' . date('d/m/Y', strtotime($row->batas_waktu)) . '</td>';
                echo '</tr>';
            }
            echo '</table>';
        }
    }

    private function _export_lamaran($data, $filename, $format) {
        if ($format == 'excel') {
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="' . $filename . '.xls"');
            header('Cache-Control: max-age=0');

            echo '<table border="1">';
            echo '<tr>';
            echo '<th>No</th>';
            echo '<th>Pelamar</th>';
            echo '<th>Lowongan</th>';
            echo '<th>Status</th>';
            echo '<th>Tanggal Lamaran</th>';
            echo '</tr>';

            $no = 1;
            foreach ($data as $row) {
                echo '<tr>';
                echo '<td>' . $no++ . '</td>';
                echo '<td>' . $row->pelamar_nama . '</td>';
                echo '<td>' . $row->lowongan_judul . '</td>';
                echo '<td>' . ucfirst($row->status) . '</td>';
                echo '<td>' . date('d/m/Y H:i', strtotime($row->tanggal_lamaran)) . '</td>';
                echo '</tr>';
            }
            echo '</table>';
        }
    }

    private function _export_pelamar($data, $filename, $format) {
        if ($format == 'excel') {
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="' . $filename . '.xls"');
            header('Cache-Control: max-age=0');

            echo '<table border="1">';
            echo '<tr>';
            echo '<th>No</th>';
            echo '<th>Nama Lengkap</th>';
            echo '<th>Email</th>';
            echo '<th>Pendidikan</th>';
            echo '<th>Total Lamaran</th>';
            echo '<th>Tanggal Daftar</th>';
            echo '<th>Last Login</th>';
            echo '</tr>';

            $no = 1;
            foreach ($data as $row) {
                echo '<tr>';
                echo '<td>' . $no++ . '</td>';
                echo '<td>' . $row->nama_lengkap . '</td>';
                echo '<td>' . $row->email . '</td>';
                echo '<td>' . ($row->pendidikan ?: '-') . '</td>';
                echo '<td>' . $row->total_lamaran . '</td>';
                echo '<td>' . date('d/m/Y', strtotime($row->dibuat_pada)) . '</td>';
                echo '<td>' . ($row->login_terakhir ? date('d/m/Y H:i', strtotime($row->login_terakhir)) : 'Belum pernah') . '</td>';
                echo '</tr>';
            }
            echo '</table>';
        }
    }

    private function _export_penilaian($data, $filename, $format) {
        if ($format == 'excel') {
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="' . $filename . '.xls"');
            header('Cache-Control: max-age=0');

            echo '<table border="1">';
            echo '<tr>';
            echo '<th>No</th>';
            echo '<th>Pelamar</th>';
            echo '<th>Penilaian</th>';
            echo '<th>Lowongan</th>';
            echo '<th>Nilai</th>';
            echo '<th>Status</th>';
            echo '<th>Waktu Pengerjaan (menit)</th>';
            echo '<th>Tanggal Mulai</th>';
            echo '<th>Tanggal Selesai</th>';
            echo '</tr>';

            $no = 1;
            foreach ($data as $row) {
                echo '<tr>';
                echo '<td>' . $no++ . '</td>';
                echo '<td>' . ($row->pelamar_nama ?: '-') . '</td>';
                echo '<td>' . ($row->penilaian_judul ?: '-') . '</td>';
                echo '<td>' . ($row->lowongan_judul ?: '-') . '</td>';
                echo '<td>' . ($row->status == 'selesai' && isset($row->nilai) ? $row->nilai : '-') . '</td>';
                echo '<td>' . ucfirst($row->status) . '</td>';
                echo '<td>' . (isset($row->waktu_pengerjaan) && $row->waktu_pengerjaan ? $row->waktu_pengerjaan : '-') . '</td>';
                echo '<td>' . (isset($row->waktu_mulai) && $row->waktu_mulai ? date('d/m/Y H:i', strtotime($row->waktu_mulai)) : '-') . '</td>';
                echo '<td>' . (isset($row->waktu_selesai) && $row->waktu_selesai ? date('d/m/Y H:i', strtotime($row->waktu_selesai)) : '-') . '</td>';
                echo '</tr>';
            }
            echo '</table>';
        }
    }

    
    public function tambah_artikel() {
        
        $data['categories'] = $this->model_kategori->dapatkan_kategori_blog();

        
        $this->form_validation->set_rules('title', 'Title', 'trim|required');
        $this->form_validation->set_rules('slug', 'Slug', 'trim|required|is_unique[post_blog.slug]');
        $this->form_validation->set_rules('content', 'Content', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            
            $data['title'] = 'Tambah Artikel Baru';
            $this->load->view('templates/admin_header', $data);
            $this->load->view('admin/blog/add', $data);
            $this->load->view('templates/admin_footer');
        } else {
            
            $post_data = array(
                'judul' => $this->input->post('title'),
                'slug' => $this->input->post('slug'),
                'konten' => $this->input->post('content'),
                'status' => $this->input->post('status'),
                'id_penulis' => $this->session->userdata('user_id'),
                'dibuat_pada' => date('Y-m-d H:i:s')
            );

            
            if ($_FILES['featured_image']['name']) {
                
                $upload_path = FCPATH . 'uploads/blog_images/';
                if (!is_dir($upload_path)) {
                    if (!mkdir($upload_path, 0777, true)) {
                        $error = "Failed to create directory: " . $upload_path;
                        $this->session->set_flashdata('error', $error);
                        redirect('admin/tambah_artikel');
                    }
                }

                
                if (!is_writable($upload_path)) {
                    $error = "Directory is not writable: " . $upload_path;
                    $this->session->set_flashdata('error', $error);
                    redirect('admin/tambah_artikel');
                }

                $upload_path_full = FCPATH . 'uploads/blog_images/';
                if (!is_dir($upload_path_full)) {
                    mkdir($upload_path_full, 0777, true);
                }

                $config['upload_path'] = realpath($upload_path_full) . '/';
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['max_size'] = 2048; 
                $config['file_name'] = 'blog_' . time();

                $this->upload->initialize($config);

                if ($this->upload->do_upload('featured_image')) {
                    $upload_data = $this->upload->data();
                    $post_data['gambar_utama'] = $upload_data['file_name'];
                } else {
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('error', $error);
                    redirect('admin/tambah_artikel');
                }
            }

            
            $post_id = $this->model_blog->tambah_artikel($post_data);

            if ($post_id) {
                
                $categories = $this->input->post('categories');
                if (!empty($categories)) {
                    foreach ($categories as $category_id) {
                        $this->model_blog->tambah_kategori_artikel($post_id, $category_id);
                    }
                }

                
                $this->session->set_flashdata('success', 'Artikel baru berhasil ditambahkan.');
                redirect('admin/blog');
            } else {
                
                $this->session->set_flashdata('error', 'Gagal menambahkan artikel. Silakan coba lagi.');
                redirect('admin/tambah_artikel');
            }
        }
    }

    
    public function edit_artikel($id) {
        
        $data['post'] = $this->model_blog->dapatkan_artikel($id);

        
        if (!$data['post']) {
            show_404();
        }

        
        $data['categories'] = $this->model_kategori->dapatkan_kategori_blog();

        
        $data['post_categories'] = $this->model_blog->dapatkan_kategori_artikel($id);
        $data['selected_categories'] = array();
        foreach ($data['post_categories'] as $category) {
            $data['selected_categories'][] = $category->id;
        }

        
        $this->form_validation->set_rules('title', 'Title', 'trim|required');
        $this->form_validation->set_rules('slug', 'Slug', 'trim|required');
        $this->form_validation->set_rules('content', 'Content', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            
            $data['title'] = 'Edit Artikel';
            $this->load->view('templates/admin_header', $data);
            $this->load->view('admin/blog/edit', $data);
            $this->load->view('templates/admin_footer');
        } else {
            
            $post_data = array(
                'judul' => $this->input->post('title'),
                'slug' => $this->input->post('slug'),
                'konten' => $this->input->post('content'),
                'status' => $this->input->post('status'),
                'diperbarui_pada' => date('Y-m-d H:i:s')
            );

            
            if ($_FILES['featured_image']['name']) {
                
                $upload_path = FCPATH . 'uploads/blog_images/';
                if (!is_dir($upload_path)) {
                    if (!mkdir($upload_path, 0777, true)) {
                        $error = "Failed to create directory: " . $upload_path;
                        $this->session->set_flashdata('error', $error);
                        redirect('admin/edit_artikel/' . $id);
                    }
                }

                
                if (!is_writable($upload_path)) {
                    $error = "Directory is not writable: " . $upload_path;
                    $this->session->set_flashdata('error', $error);
                    redirect('admin/edit_artikel/' . $id);
                }

                $config['upload_path'] = './uploads/blog_images/';
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['max_size'] = 2048; 
                $config['file_name'] = 'blog_' . time();

                $this->upload->initialize($config);

                if ($this->upload->do_upload('featured_image')) {
                    
                    if ($data['post']->gambar_utama) {
                        $old_file = './uploads/blog_images/' . $data['post']->gambar_utama;
                        if (file_exists($old_file)) {
                            unlink($old_file);
                        }
                    }

                    $upload_data = $this->upload->data();
                    $post_data['gambar_utama'] = $upload_data['file_name'];
                } else {
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('error', $error);
                    redirect('admin/edit_artikel/' . $id);
                }
            }

            
            $result = $this->model_blog->perbarui_artikel($id, $post_data);

            if ($result) {
                
                $this->model_blog->hapus_semua_kategori_artikel($id);
                $categories = $this->input->post('categories');
                if (!empty($categories)) {
                    foreach ($categories as $category_id) {
                        $this->model_blog->tambah_kategori_artikel($id, $category_id);
                    }
                }

                
                $this->session->set_flashdata('success', 'Artikel berhasil diperbarui.');
                redirect('admin/blog');
            } else {
                
                $this->session->set_flashdata('error', 'Gagal memperbarui artikel. Silakan coba lagi.');
                redirect('admin/edit_artikel/' . $id);
            }
        }
    }

    
    public function hapus_artikel($id) {
        
        $post = $this->model_blog->dapatkan_artikel($id);

        
        if (!$post) {
            show_404();
        }

        
        $result = $this->model_blog->hapus_artikel($id);

        if ($result) {
            
            if ($post->gambar_utama) {
                $file_path = './uploads/blog_images/' . $post->gambar_utama;
                if (file_exists($file_path)) {
                    unlink($file_path);
                }
            }

            
            $this->session->set_flashdata('success', 'Artikel berhasil dihapus.');
        } else {
            
            $this->session->set_flashdata('error', 'Gagal menghapus artikel. Silakan coba lagi.');
        }

        redirect('admin/blog');
    }

    
    public function publikasi_artikel($id) {
        $result = $this->model_blog->perbarui_artikel($id, array('status' => 'dipublikasi'));

        if ($result) {
            $this->session->set_flashdata('success', 'Artikel berhasil dipublikasikan.');
        } else {
            $this->session->set_flashdata('error', 'Gagal mempublikasikan artikel. Silakan coba lagi.');
        }

        redirect('admin/blog');
    }

    
    public function batalkan_publikasi_artikel($id) {
        $result = $this->model_blog->perbarui_artikel($id, array('status' => 'draft'));

        if ($result) {
            $this->session->set_flashdata('success', 'Artikel berhasil dijadikan draft.');
        } else {
            $this->session->set_flashdata('error', 'Gagal menjadikan artikel sebagai draft. Silakan coba lagi.');
        }

        redirect('admin/blog');
    }

    
    public function tambah_kategori_blog() {
        
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('slug', 'Slug', 'trim|is_unique[kategori_blog.slug]');

        if ($this->form_validation->run() == FALSE) {
            
            $this->session->set_flashdata('error', validation_errors());
            redirect('admin/blog');
        } else {
            
            $slug = $this->input->post('slug');

            
            if (empty($slug)) {
                $slug = url_title($this->input->post('name'), 'dash', TRUE);
            }

            $category_data = array(
                'nama' => $this->input->post('name'),
                'slug' => $slug,
                'deskripsi' => $this->input->post('description')
            );

            
            $result = $this->model_kategori->tambah_kategori_blog($category_data);

            if ($result) {
                
                $this->session->set_flashdata('success', 'Kategori blog berhasil ditambahkan.');
            } else {
                
                $this->session->set_flashdata('error', 'Gagal menambahkan kategori blog. Silakan coba lagi.');
            }

            redirect('admin/blog');
        }
    }

    
    public function edit_kategori_blog() {
        
        $id = $this->input->post('id');

        
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('slug', 'Slug', 'trim');

        if ($this->form_validation->run() == FALSE) {
            
            $this->session->set_flashdata('error', validation_errors());
            redirect('admin/blog');
        } else {
            
            $slug = $this->input->post('slug');

            
            if (empty($slug)) {
                $slug = url_title($this->input->post('name'), 'dash', TRUE);
            }

            $category_data = array(
                'nama' => $this->input->post('name'),
                'slug' => $slug,
                'deskripsi' => $this->input->post('description')
            );

            
            $result = $this->model_kategori->perbarui_kategori_blog($id, $category_data);

            if ($result) {
                
                $this->session->set_flashdata('success', 'Kategori blog berhasil diperbarui.');
            } else {
                
                $this->session->set_flashdata('error', 'Gagal memperbarui kategori blog. Silakan coba lagi.');
            }

            redirect('admin/blog');
        }
    }

    
    public function hapus_kategori_blog($id) {
        
        $result = $this->model_kategori->hapus_kategori_blog($id);

        if ($result) {
            
            $this->session->set_flashdata('success', 'Kategori blog berhasil dihapus.');
        } else {
            
            $this->session->set_flashdata('error', 'Gagal menghapus kategori blog. Silakan coba lagi.');
        }

        redirect('admin/blog');
    }

    

    
    public function kategori() {
        
        $data['categories'] = $this->model_kategori->dapatkan_kategori_lowongan();

        
        $data['category_stats'] = array();
        foreach ($data['categories'] as $category) {
            $data['category_stats'][$category->id] = $this->model_kategori->hitung_lowongan_berdasarkan_kategori($category->id);
        }

        
        $data['title'] = 'Manajemen Kategori Lowongan';
        $this->load->view('templates/admin_header', $data);
        $this->load->view('admin/kategori/index', $data);
        $this->load->view('templates/admin_footer');
    }

    
    public function tambah_kategori_lowongan() {
        
        $this->form_validation->set_rules('nama', 'Nama Kategori', 'trim|required');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'trim');

        if ($this->form_validation->run() == FALSE) {
            
            $this->session->set_flashdata('error', validation_errors());
            redirect('admin/kategori');
        } else {
            
            $category_data = array(
                'nama' => $this->input->post('nama'),
                'deskripsi' => $this->input->post('deskripsi'),
                'dibuat_pada' => date('Y-m-d H:i:s')
            );

            
            $result = $this->model_kategori->tambah_kategori_lowongan($category_data);

            if ($result) {
                
                $this->session->set_flashdata('success', 'Kategori lowongan berhasil ditambahkan.');
            } else {
                
                $this->session->set_flashdata('error', 'Gagal menambahkan kategori lowongan. Silakan coba lagi.');
            }

            redirect('admin/kategori');
        }
    }

    
    public function edit_kategori_lowongan() {
        
        $id = $this->input->post('id');

        
        $this->form_validation->set_rules('nama', 'Nama Kategori', 'trim|required');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'trim');

        if ($this->form_validation->run() == FALSE) {
            
            $this->session->set_flashdata('error', validation_errors());
            redirect('admin/kategori');
        } else {
            
            $category_data = array(
                'nama' => $this->input->post('nama'),
                'deskripsi' => $this->input->post('deskripsi'),
                'diperbarui_pada' => date('Y-m-d H:i:s')
            );

            
            $result = $this->model_kategori->perbarui_kategori_lowongan($id, $category_data);

            if ($result) {
                
                $this->session->set_flashdata('success', 'Kategori lowongan berhasil diperbarui.');
            } else {
                
                $this->session->set_flashdata('error', 'Gagal memperbarui kategori lowongan. Silakan coba lagi.');
            }

            redirect('admin/kategori');
        }
    }

    
    public function hapus_kategori_lowongan($id) {
        
        $job_count = $this->model_kategori->hitung_lowongan_berdasarkan_kategori($id);

        if ($job_count > 0) {
            
            $this->session->set_flashdata('error', 'Kategori tidak dapat dihapus karena masih digunakan oleh ' . $job_count . ' lowongan.');
            redirect('admin/kategori');
            return;
        }

        
        $result = $this->model_kategori->hapus_kategori_lowongan($id);

        if ($result) {
            
            $this->session->set_flashdata('success', 'Kategori lowongan berhasil dihapus.');
        } else {
            
            $this->session->set_flashdata('error', 'Gagal menghapus kategori lowongan. Silakan coba lagi.');
        }

        redirect('admin/kategori');
    }

    
    
    

    
    public function notifikasi() {
        $id_pengguna = $this->session->userdata('user_id');

        
        $status = $this->input->get('status');
        $jenis = $this->input->get('jenis');
        $page = $this->input->get('page') ? (int)$this->input->get('page') : 1;
        $limit = 20;
        $offset = ($page - 1) * $limit;

        
        $data['notifications'] = $this->model_notifikasi->dapatkan_notifikasi_pengguna($id_pengguna, $limit, $offset, $status);

        
        $data['stats'] = $this->model_notifikasi->dapatkan_statistik_notifikasi($id_pengguna);

        
        $data['settings'] = $this->model_notifikasi->dapatkan_pengaturan_notifikasi($id_pengguna);

        
        $data['current_page'] = $page;
        $data['total_pages'] = ceil($data['stats']['total'] / $limit);
        $data['status_filter'] = $status;
        $data['jenis_filter'] = $jenis;

        $data['title'] = 'Manajemen Notifikasi';
        $this->load->view('templates/admin_header', $data);
        $this->load->view('admin/notifikasi/index', $data);
        $this->load->view('templates/admin_footer');
    }

    
    public function api_notifikasi() {
        $this->output->set_content_type('application/json');

        $id_pengguna = $this->session->userdata('user_id');
        $limit = $this->input->get('limit') ? (int)$this->input->get('limit') : 10;
        $offset = $this->input->get('offset') ? (int)$this->input->get('offset') : 0;
        $status = $this->input->get('status');

        $notifications = $this->model_notifikasi->dapatkan_notifikasi_pengguna($id_pengguna, $limit, $offset, $status);
        $unread_count = $this->model_notifikasi->hitung_notifikasi_belum_dibaca($id_pengguna);

        $response = array(
            'success' => true,
            'data' => $notifications,
            'unread_count' => $unread_count
        );

        $this->output->set_output(json_encode($response));
    }

    
    public function tandai_dibaca_notifikasi($id) {
        $id_pengguna = $this->session->userdata('user_id');
        $result = $this->model_notifikasi->tandai_dibaca($id, $id_pengguna);

        if ($this->input->is_ajax_request()) {
            $this->output->set_content_type('application/json');
            $unread_count = $this->model_notifikasi->hitung_notifikasi_belum_dibaca($id_pengguna);

            $response = array(
                'success' => $result,
                'unread_count' => $unread_count
            );

            $this->output->set_output(json_encode($response));
        } else {
            if ($result) {
                $this->session->set_flashdata('success', 'Notifikasi berhasil ditandai sebagai dibaca.');
            } else {
                $this->session->set_flashdata('error', 'Gagal menandai notifikasi sebagai dibaca.');
            }
            redirect('admin/notifikasi');
        }
    }

    
    public function tandai_semua_dibaca_notifikasi() {
        $id_pengguna = $this->session->userdata('user_id');
        $result = $this->model_notifikasi->tandai_semua_dibaca($id_pengguna);

        if ($this->input->is_ajax_request()) {
            $this->output->set_content_type('application/json');
            $response = array(
                'success' => $result,
                'unread_count' => 0
            );
            $this->output->set_output(json_encode($response));
        } else {
            if ($result) {
                $this->session->set_flashdata('success', 'Semua notifikasi berhasil ditandai sebagai dibaca.');
            } else {
                $this->session->set_flashdata('error', 'Gagal menandai semua notifikasi sebagai dibaca.');
            }
            redirect('admin/notifikasi');
        }
    }

    
    public function hapus_notifikasi($id) {
        $id_pengguna = $this->session->userdata('user_id');
        $result = $this->model_notifikasi->hapus_notifikasi($id, $id_pengguna);

        if ($this->input->is_ajax_request()) {
            $this->output->set_content_type('application/json');
            $unread_count = $this->model_notifikasi->hitung_notifikasi_belum_dibaca($id_pengguna);

            $response = array(
                'success' => $result,
                'unread_count' => $unread_count
            );

            $this->output->set_output(json_encode($response));
        } else {
            if ($result) {
                $this->session->set_flashdata('success', 'Notifikasi berhasil dihapus.');
            } else {
                $this->session->set_flashdata('error', 'Gagal menghapus notifikasi.');
            }
            redirect('admin/notifikasi');
        }
    }

    
    public function buat_notifikasi() {
        
        $this->form_validation->set_rules('id_pengguna', 'Penerima', 'required');
        $this->form_validation->set_rules('judul', 'Judul', 'required|max_length[255]');
        $this->form_validation->set_rules('pesan', 'Pesan', 'required');
        $this->form_validation->set_rules('jenis', 'Jenis', 'required');
        $this->form_validation->set_rules('prioritas', 'Prioritas', 'required');

        if ($this->form_validation->run() == FALSE) {
            
            $data['users'] = $this->model_pengguna->dapatkan_pengguna_semua();

            $data['title'] = 'Buat Notifikasi Baru';
            $this->load->view('templates/admin_header', $data);
            $this->load->view('admin/notifikasi/create', $data);
            $this->load->view('templates/admin_footer');
        } else {
            $notification_data = array(
                'id_pengguna' => $this->input->post('id_pengguna'),
                'judul' => $this->input->post('judul'),
                'pesan' => $this->input->post('pesan'),
                'jenis' => $this->input->post('jenis'),
                'prioritas' => $this->input->post('prioritas'),
                'url_aksi' => $this->input->post('url_aksi'),
                'kedaluwarsa_pada' => $this->input->post('kedaluwarsa_pada'),
                'dibuat_oleh' => $this->session->userdata('user_id')
            );

            $result = $this->model_notifikasi->buat_notifikasi($notification_data);

            if ($result) {
                $this->session->set_flashdata('success', 'Notifikasi berhasil dibuat.');
                redirect('admin/notifikasi');
            } else {
                $this->session->set_flashdata('error', 'Gagal membuat notifikasi.');
                redirect('admin/buat_notifikasi');
            }
        }
    }

    
    public function buat_notifikasi_lamaran_baru($id_lamaran) {
        
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

    
    public function buat_notifikasi_status_lamaran($id_lamaran, $status_baru) {
        
        $lamaran = $this->model_lamaran->dapatkan_lamaran($id_lamaran);
        if (!$lamaran) return false;

        
        $lowongan = $this->model_lowongan->dapatkan_lowongan($lamaran->id_pekerjaan);
        if (!$lowongan) return false;

        
        $status_messages = array(
            'direview' => 'Lamaran Anda sedang ditinjau oleh tim HR.',
            'seleksi' => 'Selamat! Anda lolos ke tahap seleksi.',
            'wawancara' => 'Anda telah dijadwalkan untuk wawancara.',
            'diterima' => 'Selamat! Lamaran Anda diterima.',
            'ditolak' => 'Mohon maaf, lamaran Anda tidak dapat kami proses lebih lanjut.'
        );

        $pesan = isset($status_messages[$status_baru]) ? $status_messages[$status_baru] : "Status lamaran Anda telah diperbarui menjadi: " . ucfirst($status_baru);

        $notification_data = array(
            'id_pengguna' => $lamaran->id_pelamar,
            'judul' => 'Update Status Lamaran',
            'pesan' => "Status lamaran Anda untuk posisi {$lowongan->judul} telah diperbarui. {$pesan}",
            'jenis' => 'status_lamaran',
            'prioritas' => 'normal',
            'id_referensi' => $id_lamaran,
            'tabel_referensi' => 'lamaran_pekerjaan',
            'url_aksi' => 'pelamar/lamaran/' . $id_lamaran,
            'dibuat_oleh' => $this->session->userdata('user_id')
        );

        return $this->model_notifikasi->buat_notifikasi($notification_data);
    }

    /**
     * Tandai penilaian pelamar sebagai 'sudah_dinilai' dan perbarui skor.
     * @param int $applicant_assessment_id ID penilaian pelamar
     */
    public function tandai_penilaian_sudah_dinilai($applicant_assessment_id) {
        $this->check_admin_access(); // Pastikan hanya admin yang bisa mengakses

        $applicant_assessment = $this->model_penilaian->dapatkan_penilaian_pelamar_by_id($applicant_assessment_id);

        if (!$applicant_assessment) {
            $this->session->set_flashdata('error', 'Penilaian pelamar tidak ditemukan.');
            redirect('admin/penilaian');
            return;
        }

        // Perbarui status menjadi 'sudah_dinilai'
        $result = $this->model_penilaian->perbarui_status_penilaian_pelamar($applicant_assessment_id, 'sudah_dinilai');

        if ($result) {
            // Hitung ulang skor untuk memastikan skor terbaru tersimpan
            $final_score = $this->model_penilaian->hitung_skor_penilaian_pelamar($applicant_assessment_id);
            $this->db->where('id', $applicant_assessment_id);
            $this->db->update('penilaian_pelamar', array('nilai' => $final_score));

            // Dapatkan informasi pelamar dan penilaian untuk notifikasi
            $this->db->select('pengguna.*, penilaian.judul as assessment_title, lowongan_pekerjaan.judul as job_title');
            $this->db->from('penilaian_pelamar');
            $this->db->join('lamaran_pekerjaan', 'lamaran_pekerjaan.id = penilaian_pelamar.id_lamaran');
            $this->db->join('pengguna', 'pengguna.id = lamaran_pekerjaan.id_pelamar');
            $this->db->join('penilaian', 'penilaian.id = penilaian_pelamar.id_penilaian');
            $this->db->join('lowongan_pekerjaan', 'lowongan_pekerjaan.id = lamaran_pekerjaan.id_pekerjaan');
            $this->db->where('penilaian_pelamar.id', $applicant_assessment_id);
            $notification_data = $this->db->get()->row();

            // Kirim notifikasi WhatsApp jika nomor telepon tersedia
            if ($notification_data && $notification_data->telepon) {
                $message = "🌸 *Gallery Kembang Ilung - NOTIFIKASI HASIL PENILAIAN*\n\n";
                $message .= "Halo *{$notification_data->nama_lengkap}*,\n\n";
                $message .= "Penilaian Anda untuk posisi *\"{$notification_data->job_title}\"* telah selesai dinilai.\n\n";
                $message .= "*Detail Penilaian:*\n";
                $message .= "Judul: {$notification_data->assessment_title}\n";
                $message .= "Nilai: {$final_score}%\n\n";
                $message .= "*Status:* " . ($final_score >= 70 ? "LULUS ✅" : "TIDAK LULUS ❌") . "\n\n";
                $message .= "Silakan login ke akun SIREK Anda untuk melihat detail penilaian.\n\n";
                $message .= "*Informasi Kontak HR:*\n";
                $message .= "Telepon: +62 812 0000 0000\n";
                $message .= "Email: gallerykembangilung@mail.com\n\n";
                $message .= "Jika Anda memiliki pertanyaan lebih lanjut, jangan ragu untuk menghubungi kami.\n\n";
                $message .= "*Gallery Kembang Ilung*\n";
                $message .= "Desa Banyu Hirang, Kecamatan Amuntai Selatan, Kabupaten Hulu Sungai Tengah, Kalimantan Selatan\n\n";
                $message .= "_Pesan ini dikirim secara otomatis pada " . date('d-m-Y H:i') . "_";

                $whatsapp_result = kirim_whatsapp($notification_data->telepon, $message);

                if ($whatsapp_result && isset($whatsapp_result['success']) && $whatsapp_result['success']) {
                    $this->session->set_flashdata('success', 'Status penilaian berhasil diperbarui menjadi "Sudah Dinilai", skor telah diperbarui, dan notifikasi WhatsApp telah dikirim.');
                } else {
                    $this->session->set_flashdata('success', 'Status penilaian berhasil diperbarui menjadi "Sudah Dinilai" dan skor telah diperbarui, tetapi gagal mengirim notifikasi WhatsApp.');
                    if ($whatsapp_result && isset($whatsapp_result['error'])) {
                        $this->session->set_flashdata('error', 'Error WhatsApp: ' . $whatsapp_result['error']);
                    }
                }
            } else {
                $this->session->set_flashdata('success', 'Status penilaian berhasil diperbarui menjadi "Sudah Dinilai" dan skor telah diperbarui.');
                if (!$notification_data->telepon) {
                    $this->session->set_flashdata('info', 'Notifikasi WhatsApp tidak dikirim karena nomor telepon pelamar tidak tersedia.');
                }
            }
        } else {
            $this->session->set_flashdata('error', 'Gagal memperbarui status penilaian.');
        }

        redirect('admin/detailHasilPenilaian/' . $applicant_assessment_id);
    }

    public function print_laporan_lowongan() {
        $this->check_admin_access();
        
        // Get filters from query string
        $filters = $this->input->get();
        
        // Get data from model
        $this->load->model('Model_Laporan');
        $lowongan = $this->Model_Laporan->laporan_lowongan($filters);
        
        // Prepare data for view
        $data = [
            'title' => 'Laporan Lowongan Pekerjaan',
            'filters' => $this->_prepare_filters($filters),
            'content' => $this->load->view('admin/laporan/print/lowongan', ['lowongan' => $lowongan], true)
        ];
        
        // Load print template
        $this->load->view('admin/laporan/print_template', $data);
    }
    
    public function print_laporan_lamaran() {
        $this->check_admin_access();
        
        // Get filters from query string
        $filters = $this->input->get();
        
        // Get data from model
        $this->load->model('Model_Laporan');
        $lamaran = $this->Model_Laporan->laporan_lamaran($filters);
        
        // Prepare data for view
        $data = [
            'title' => 'Laporan Lamaran Pekerjaan',
            'filters' => $this->_prepare_filters($filters),
            'content' => $this->load->view('admin/laporan/print/lamaran', ['lamaran' => $lamaran], true)
        ];
        
        // Load print template
        $this->load->view('admin/laporan/print_template', $data);
    }
    
    public function print_laporan_pelamar() {
        $this->check_admin_access();
        
        // Get filters from query string
        $filters = $this->input->get();
        
        // Get data from model
        $this->load->model('Model_Laporan');
        $pelamar = $this->Model_Laporan->laporan_pelamar($filters);
        
        // Prepare data for view
        $data = [
            'title' => 'Laporan Data Pelamar',
            'filters' => $this->_prepare_filters($filters),
            'content' => $this->load->view('admin/laporan/print/pelamar', ['pelamar' => $pelamar], true)
        ];
        
        // Load print template
        $this->load->view('admin/laporan/print_template', $data);
    }
    
    public function print_laporan_penilaian() {
        $this->check_admin_access();
        
        // Get filters from query string
        $filters = $this->input->get();
        
        // Get data from model
        $this->load->model('Model_Laporan');
        $hasil_penilaian = $this->Model_Laporan->laporan_hasil_penilaian($filters);
        
        // Prepare data for view
        $data = [
            'title' => 'Laporan Hasil Penilaian',
            'filters' => $this->_prepare_filters($filters),
            'content' => $this->load->view('admin/laporan/print/penilaian', ['hasil_penilaian' => $hasil_penilaian], true)
        ];
        
        // Load print template
        $this->load->view('admin/laporan/print_template', $data);
    }
    
    private function _prepare_filters($filters) {
        $periode_text = '';
        
        if (!empty($filters['periode'])) {
            switch ($filters['periode']) {
                case 'hari':
                    $periode_text = 'Hari Ini';
                    break;
                case 'minggu':
                    $periode_text = 'Minggu Ini';
                    break;
                case 'bulan':
                    $periode_text = 'Bulan Ini';
                    break;
                case 'tahun':
                    $periode_text = 'Tahun Ini';
                    break;
                case 'custom':
                    $periode_text = 'Custom';
                    break;
            }
        }
        
        $filters['periode_text'] = $periode_text;
        return $filters;
    }

}
