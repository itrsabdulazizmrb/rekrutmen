<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Dokumen extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    // ===== DOKUMEN LOWONGAN (JOB DOCUMENT REQUIREMENTS) =====

    // Get all document requirements for a job
    public function dapatkan_dokumen_lowongan($job_id) {
        $this->db->where('id_lowongan', $job_id);
        $this->db->order_by('wajib', 'DESC'); // Required documents first
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get('dokumen_lowongan');
        return $query->result();
    }

    // Get a specific document requirement
    public function dapatkan_dokumen_lowongan_by_id($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('dokumen_lowongan');
        return $query->row();
    }

    // Add a new document requirement
    public function tambah_dokumen_lowongan($data) {
        $this->db->insert('dokumen_lowongan', $data);
        return $this->db->insert_id();
    }

    // Update a document requirement
    public function perbarui_dokumen_lowongan($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('dokumen_lowongan', $data);
    }

    // Delete a document requirement
    public function hapus_dokumen_lowongan($id) {
        $this->db->where('id', $id);
        return $this->db->delete('dokumen_lowongan');
    }

    // Delete all document requirements for a job
    public function hapus_semua_dokumen_lowongan($job_id) {
        $this->db->where('id_lowongan', $job_id);
        return $this->db->delete('dokumen_lowongan');
    }

    // Check if a job has document requirements
    public function cek_dokumen_lowongan_exists($job_id) {
        $this->db->where('id_lowongan', $job_id);
        $query = $this->db->get('dokumen_lowongan');
        return ($query->num_rows() > 0);
    }

    // ===== DOKUMEN LAMARAN (APPLICATION DOCUMENTS) =====

    // Get all documents for an application
    public function dapatkan_dokumen_lamaran($application_id) {
        $this->db->select('dokumen_lamaran.*, dokumen_lowongan.nama_dokumen, dokumen_lowongan.jenis_dokumen as jenis_dokumen_lowongan, dokumen_lowongan.wajib');
        $this->db->from('dokumen_lamaran');
        $this->db->join('dokumen_lowongan', 'dokumen_lowongan.id = dokumen_lamaran.id_dokumen_lowongan', 'left');
        $this->db->where('dokumen_lamaran.id_lamaran', $application_id);
        $this->db->order_by('dokumen_lowongan.wajib', 'DESC');
        $this->db->order_by('dokumen_lamaran.id', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    // Get a specific application document
    public function dapatkan_dokumen_lamaran_by_id($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('dokumen_lamaran');
        return $query->row();
    }

    // Add a new application document
    public function tambah_dokumen_lamaran($data) {
        $this->db->insert('dokumen_lamaran', $data);
        return $this->db->insert_id();
    }

    // Update an application document
    public function perbarui_dokumen_lamaran($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('dokumen_lamaran', $data);
    }

    // Delete an application document
    public function hapus_dokumen_lamaran($id) {
        $this->db->where('id', $id);
        return $this->db->delete('dokumen_lamaran');
    }

    // Check if a document requirement has been fulfilled for an application
    public function cek_dokumen_lamaran_exists($application_id, $document_requirement_id) {
        $this->db->where('id_lamaran', $application_id);
        $this->db->where('id_dokumen_lowongan', $document_requirement_id);
        $query = $this->db->get('dokumen_lamaran');
        return ($query->num_rows() > 0);
    }

    // Get missing required documents for an application
    public function dapatkan_dokumen_wajib_belum_upload($application_id, $job_id) {
        $this->db->select('dokumen_lowongan.*');
        $this->db->from('dokumen_lowongan');
        $this->db->where('dokumen_lowongan.id_lowongan', $job_id);
        $this->db->where('dokumen_lowongan.wajib', 1);
        $this->db->where_not_in('dokumen_lowongan.id',
            "SELECT id_dokumen_lowongan FROM dokumen_lamaran WHERE id_lamaran = $application_id AND id_dokumen_lowongan IS NOT NULL",
            FALSE
        );
        $query = $this->db->get();
        return $query->result();
    }

    // Get default document requirements
    public function dapatkan_dokumen_default() {
        return [
            [
                'jenis_dokumen' => 'ktp',
                'nama_dokumen' => 'KTP (Kartu Tanda Penduduk)',
                'wajib' => 1,
                'format_diizinkan' => 'pdf|jpg|jpeg|png',
                'ukuran_maksimal' => 1024,
                'deskripsi' => 'Unggah scan atau foto KTP yang masih berlaku dan jelas terbaca.'
            ],
            [
                'jenis_dokumen' => 'ijazah',
                'nama_dokumen' => 'Ijazah Pendidikan Terakhir',
                'wajib' => 1,
                'format_diizinkan' => 'pdf',
                'ukuran_maksimal' => 2048,
                'deskripsi' => 'Unggah scan ijazah pendidikan terakhir (minimal SMA/SMK/sederajat).'
            ],
            [
                'jenis_dokumen' => 'cv',
                'nama_dokumen' => 'Curriculum Vitae (CV)',
                'wajib' => 1,
                'format_diizinkan' => 'pdf|doc|docx',
                'ukuran_maksimal' => 2048,
                'deskripsi' => 'Unggah CV terbaru yang berisi informasi pendidikan, pengalaman kerja, dan keahlian Anda.'
            ],
            [
                'jenis_dokumen' => 'transkrip',
                'nama_dokumen' => 'Transkrip Nilai',
                'wajib' => 0,
                'format_diizinkan' => 'pdf',
                'ukuran_maksimal' => 2048,
                'deskripsi' => 'Unggah scan transkrip nilai pendidikan terakhir.'
            ],
            [
                'jenis_dokumen' => 'sertifikat',
                'nama_dokumen' => 'Sertifikat Pendukung',
                'wajib' => 0,
                'format_diizinkan' => 'pdf',
                'ukuran_maksimal' => 2048,
                'deskripsi' => 'Unggah sertifikat pelatihan, kursus, atau sertifikasi yang relevan dengan posisi yang dilamar.'
            ],
            [
                'jenis_dokumen' => 'foto',
                'nama_dokumen' => 'Pas Foto',
                'wajib' => 0,
                'format_diizinkan' => 'jpg|jpeg|png',
                'ukuran_maksimal' => 1024,
                'deskripsi' => 'Unggah pas foto terbaru dengan latar belakang berwarna (ukuran 4x6).'
            ]
        ];
    }

    // ===== DOKUMEN PELAMAR (APPLICANT DOCUMENTS) =====

    // Get all documents for an applicant
    public function dapatkan_dokumen_pelamar($user_id) {
        $this->db->where('id_pengguna', $user_id);
        $this->db->order_by('jenis_dokumen', 'ASC');
        $query = $this->db->get('dokumen_pelamar');
        return $query->result();
    }

    // Get a specific applicant document by ID
    public function dapatkan_dokumen_pelamar_by_id($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('dokumen_pelamar');
        return $query->row();
    }

    // Get a specific applicant document by type
    public function dapatkan_dokumen_pelamar_by_jenis($user_id, $jenis_dokumen) {
        $this->db->where('id_pengguna', $user_id);
        $this->db->where('jenis_dokumen', $jenis_dokumen);
        $query = $this->db->get('dokumen_pelamar');
        return $query->row();
    }

    // Add a new applicant document
    public function tambah_dokumen_pelamar($data) {
        $this->db->insert('dokumen_pelamar', $data);
        return $this->db->insert_id();
    }

    // Update an applicant document
    public function perbarui_dokumen_pelamar($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('dokumen_pelamar', $data);
    }

    // Delete an applicant document
    public function hapus_dokumen_pelamar($id) {
        $this->db->where('id', $id);
        return $this->db->delete('dokumen_pelamar');
    }

    // Check if an applicant has a specific document type
    public function cek_dokumen_pelamar_exists($user_id, $jenis_dokumen) {
        $this->db->where('id_pengguna', $user_id);
        $this->db->where('jenis_dokumen', $jenis_dokumen);
        $query = $this->db->get('dokumen_pelamar');
        return ($query->num_rows() > 0);
    }
}
