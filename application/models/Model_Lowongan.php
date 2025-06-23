<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Lowongan extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    // Dapatkan semua lowongan
    public function dapatkan_lowongan_semua() {
        $this->db->select('lowongan_pekerjaan.*, kategori_pekerjaan.nama as category_name, pengguna.nama_lengkap as created_by_name');
        $this->db->from('lowongan_pekerjaan');
        $this->db->join('kategori_pekerjaan', 'kategori_pekerjaan.id = lowongan_pekerjaan.id_kategori', 'left');
        $this->db->join('pengguna', 'pengguna.id = lowongan_pekerjaan.dibuat_oleh', 'left');
        $this->db->order_by('lowongan_pekerjaan.id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    // Dapatkan lowongan berdasarkan ID
    public function dapatkan_lowongan($id) {
        $this->db->select('lowongan_pekerjaan.*, kategori_pekerjaan.nama as category_name, pengguna.nama_lengkap as created_by_name');
        $this->db->from('lowongan_pekerjaan');
        $this->db->join('kategori_pekerjaan', 'kategori_pekerjaan.id = lowongan_pekerjaan.id_kategori', 'left');
        $this->db->join('pengguna', 'pengguna.id = lowongan_pekerjaan.dibuat_oleh', 'left');
        $this->db->where('lowongan_pekerjaan.id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    // Tambah lowongan baru
    public function tambah_lowongan($data) {
        $this->db->insert('lowongan_pekerjaan', $data);
        return $this->db->insert_id();
    }

    // Perbarui lowongan
    public function perbarui_lowongan($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('lowongan_pekerjaan', $data);
    }

    // Hapus lowongan
    public function hapus_lowongan($id) {
        $this->db->where('id', $id);
        return $this->db->delete('lowongan_pekerjaan');
    }

    // Hitung total lowongan
    public function hitung_lowongan() {
        return $this->db->count_all('lowongan_pekerjaan');
    }

    // Hitung lowongan aktif
    public function hitung_lowongan_aktif($filters = []) {
        $this->db->from('lowongan_pekerjaan');
        $this->db->join('kategori_pekerjaan', 'kategori_pekerjaan.id = lowongan_pekerjaan.id_kategori', 'left');
        $this->db->where('lowongan_pekerjaan.status', 'aktif');
        $this->db->where('lowongan_pekerjaan.batas_waktu >=', date('Y-m-d'));

        // Apply filters
        if (!empty($filters['category'])) {
            $this->db->where('lowongan_pekerjaan.id_kategori', $filters['category']);
        }
        if (!empty($filters['location'])) {
            $this->db->where('lowongan_pekerjaan.lokasi', $filters['location']);
        }
        if (!empty($filters['job_type'])) {
            $this->db->where('lowongan_pekerjaan.jenis_pekerjaan', $filters['job_type']);
        }
        if (!empty($filters['search'])) {
            $this->db->group_start();
            $this->db->like('lowongan_pekerjaan.judul', $filters['search']);
            $this->db->or_like('lowongan_pekerjaan.deskripsi', $filters['search']);
            $this->db->or_like('lowongan_pekerjaan.persyaratan', $filters['search']);
            $this->db->or_like('kategori_pekerjaan.nama', $filters['search']);
            $this->db->group_end();
        }

        return $this->db->count_all_results();
    }

    // Dapatkan lowongan aktif dengan paginasi
    public function dapatkan_lowongan_aktif($limit, $start, $filters = []) {
        $this->db->select('lowongan_pekerjaan.*, kategori_pekerjaan.nama as category_name');
        $this->db->from('lowongan_pekerjaan');
        $this->db->join('kategori_pekerjaan', 'kategori_pekerjaan.id = lowongan_pekerjaan.id_kategori', 'left');
        $this->db->where('lowongan_pekerjaan.status', 'aktif');
        $this->db->where('lowongan_pekerjaan.batas_waktu >=', date('Y-m-d'));

        // Apply filters
        if (!empty($filters['category'])) {
            $this->db->where('lowongan_pekerjaan.id_kategori', $filters['category']);
        }
        if (!empty($filters['location'])) {
            $this->db->where('lowongan_pekerjaan.lokasi', $filters['location']);
        }
        if (!empty($filters['job_type'])) {
            $this->db->where('lowongan_pekerjaan.jenis_pekerjaan', $filters['job_type']);
        }
        if (!empty($filters['search'])) {
            $this->db->group_start();
            $this->db->like('lowongan_pekerjaan.judul', $filters['search']);
            $this->db->or_like('lowongan_pekerjaan.deskripsi', $filters['search']);
            $this->db->or_like('lowongan_pekerjaan.persyaratan', $filters['search']);
            $this->db->or_like('kategori_pekerjaan.nama', $filters['search']);
            $this->db->group_end();
        }

        // Apply sorting
        $sort = isset($filters['sort']) ? $filters['sort'] : 'newest';
        switch ($sort) {
            case 'oldest':
                $this->db->order_by('lowongan_pekerjaan.dibuat_pada', 'ASC');
                break;
            case 'deadline':
                $this->db->order_by('lowongan_pekerjaan.batas_waktu', 'ASC');
                break;
            case 'title':
                $this->db->order_by('lowongan_pekerjaan.judul', 'ASC');
                break;
            case 'newest':
            default:
                $this->db->order_by('lowongan_pekerjaan.dibuat_pada', 'DESC');
                break;
        }

        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result();
    }

    // Dapatkan lowongan unggulan
    public function dapatkan_lowongan_unggulan($limit) {
        $this->db->select('lowongan_pekerjaan.*, kategori_pekerjaan.nama as category_name');
        $this->db->from('lowongan_pekerjaan');
        $this->db->join('kategori_pekerjaan', 'kategori_pekerjaan.id = lowongan_pekerjaan.id_kategori', 'left');
        $this->db->where('lowongan_pekerjaan.status', 'aktif');
        $this->db->where('lowongan_pekerjaan.unggulan', 1);
        $this->db->where('lowongan_pekerjaan.batas_waktu >=', date('Y-m-d'));
        $this->db->order_by('lowongan_pekerjaan.id', 'DESC');
        $this->db->limit($limit);
        $query = $this->db->get();
        return $query->result();
    }

    // Dapatkan lokasi unik dari lowongan aktif
    public function dapatkan_lokasi_unik() {
        $this->db->select('lokasi');
        $this->db->from('lowongan_pekerjaan');
        $this->db->where('status', 'aktif');
        $this->db->where('batas_waktu >=', date('Y-m-d'));
        $this->db->where('lokasi !=', '');
        $this->db->where('lokasi IS NOT NULL');
        $this->db->distinct();
        $this->db->order_by('lokasi', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    // Dapatkan lowongan terkait
    public function dapatkan_lowongan_terkait($id, $id_kategori, $limit) {
        $this->db->select('lowongan_pekerjaan.*, kategori_pekerjaan.nama as category_name');
        $this->db->from('lowongan_pekerjaan');
        $this->db->join('kategori_pekerjaan', 'kategori_pekerjaan.id = lowongan_pekerjaan.id_kategori', 'left');
        $this->db->where('lowongan_pekerjaan.id !=', $id);
        $this->db->where('lowongan_pekerjaan.status', 'aktif');
        $this->db->where('lowongan_pekerjaan.batas_waktu >=', date('Y-m-d'));

        if ($id_kategori) {
            $this->db->where('lowongan_pekerjaan.id_kategori', $id_kategori);
        }

        $this->db->order_by('lowongan_pekerjaan.id', 'DESC');
        $this->db->limit($limit);
        $query = $this->db->get();
        return $query->result();
    }

    // Dapatkan lowongan rekomendasi untuk pelamar
    public function dapatkan_lowongan_rekomendasi($user_id, $limit) {
        // Dapatkan profil pelamar
        $this->db->where('id_pengguna', $user_id);
        $query = $this->db->get('profil_pelamar');
        $profile = $query->row();

        // Jika profil ditemukan dan memiliki skills
        if ($profile && $profile->keahlian) {
            $skills = explode(',', $profile->keahlian);
            $skills_array = array_map('trim', $skills);

            $this->db->select('lowongan_pekerjaan.*, kategori_pekerjaan.nama as category_name');
            $this->db->from('lowongan_pekerjaan');
            $this->db->join('kategori_pekerjaan', 'kategori_pekerjaan.id = lowongan_pekerjaan.id_kategori', 'left');
            $this->db->where('lowongan_pekerjaan.status', 'aktif');
            $this->db->where('lowongan_pekerjaan.batas_waktu >=', date('Y-m-d'));

            // Cari lowongan yang sesuai dengan skills
            $this->db->group_start();
            foreach ($skills_array as $skill) {
                $this->db->or_like('lowongan_pekerjaan.persyaratan', $skill);
                $this->db->or_like('lowongan_pekerjaan.deskripsi', $skill);
            }
            $this->db->group_end();

            // Cek apakah sudah melamar
            // Dapatkan daftar lowongan yang sudah dilamar
            $this->db->reset_query();
            $this->db->select('id_pekerjaan');
            $this->db->from('lamaran_pekerjaan');
            $this->db->where('id_pelamar', $user_id);
            $applied_query = $this->db->get();
            $applied_jobs = $applied_query->result_array();

            // Reset query dan mulai query utama lagi
            $this->db->reset_query();
            $this->db->select('lowongan_pekerjaan.*, kategori_pekerjaan.nama as category_name');
            $this->db->from('lowongan_pekerjaan');
            $this->db->join('kategori_pekerjaan', 'kategori_pekerjaan.id = lowongan_pekerjaan.id_kategori', 'left');
            $this->db->where('lowongan_pekerjaan.status', 'aktif');
            $this->db->where('lowongan_pekerjaan.batas_waktu >=', date('Y-m-d'));

            // Cari lowongan yang sesuai dengan skills
            $this->db->group_start();
            foreach ($skills_array as $skill) {
                $this->db->or_like('lowongan_pekerjaan.persyaratan', $skill);
                $this->db->or_like('lowongan_pekerjaan.deskripsi', $skill);
            }
            $this->db->group_end();

            // Hanya tambahkan kondisi where_not_in jika ada lamaran
            if (!empty($applied_jobs)) {
                $applied_job_ids = array_column($applied_jobs, 'id_pekerjaan');
                $this->db->where_not_in('lowongan_pekerjaan.id', $applied_job_ids);
            }

            $this->db->order_by('lowongan_pekerjaan.id', 'DESC');
            $this->db->limit($limit);
            $query = $this->db->get();
            return $query->result();
        } else {
            // Jika tidak ada profil atau skills, tampilkan lowongan terbaru
            // Reset query terlebih dahulu
            $this->db->reset_query();

            // Dapatkan daftar lowongan yang sudah dilamar
            $this->db->select('id_pekerjaan');
            $this->db->from('lamaran_pekerjaan');
            $this->db->where('id_pelamar', $user_id);
            $applied_query = $this->db->get();
            $applied_jobs = $applied_query->result_array();

            // Reset query dan mulai query utama lagi
            $this->db->reset_query();
            $this->db->select('lowongan_pekerjaan.*, kategori_pekerjaan.nama as category_name');
            $this->db->from('lowongan_pekerjaan');
            $this->db->join('kategori_pekerjaan', 'kategori_pekerjaan.id = lowongan_pekerjaan.id_kategori', 'left');
            $this->db->where('lowongan_pekerjaan.status', 'aktif');
            $this->db->where('lowongan_pekerjaan.batas_waktu >=', date('Y-m-d'));

            // Hanya tambahkan kondisi where_not_in jika ada lamaran
            if (!empty($applied_jobs)) {
                $applied_job_ids = array_column($applied_jobs, 'id_pekerjaan');
                $this->db->where_not_in('lowongan_pekerjaan.id', $applied_job_ids);
            }

            $this->db->order_by('lowongan_pekerjaan.id', 'DESC');
            $this->db->limit($limit);
            $query = $this->db->get();
            return $query->result();
        }
    }

    // Cari lowongan
    public function cari_lowongan($keyword) {
        $this->db->select('lowongan_pekerjaan.*, kategori_pekerjaan.nama as category_name');
        $this->db->from('lowongan_pekerjaan');
        $this->db->join('kategori_pekerjaan', 'kategori_pekerjaan.id = lowongan_pekerjaan.id_kategori', 'left');
        $this->db->where('lowongan_pekerjaan.status', 'aktif');
        $this->db->where('lowongan_pekerjaan.batas_waktu >=', date('Y-m-d'));
        $this->db->group_start();
        $this->db->like('lowongan_pekerjaan.judul', $keyword);
        $this->db->or_like('lowongan_pekerjaan.deskripsi', $keyword);
        $this->db->or_like('lowongan_pekerjaan.persyaratan', $keyword);
        $this->db->or_like('lowongan_pekerjaan.tanggung_jawab', $keyword);
        $this->db->or_like('lowongan_pekerjaan.lokasi', $keyword);
        $this->db->or_like('kategori_pekerjaan.nama', $keyword);
        $this->db->group_end();
        $this->db->order_by('lowongan_pekerjaan.id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    // Dapatkan lowongan berdasarkan recruiter
    public function dapatkan_lowongan_recruiter($user_id) {
        $this->db->select('lowongan_pekerjaan.*, kategori_pekerjaan.nama as category_name');
        $this->db->from('lowongan_pekerjaan');
        $this->db->join('kategori_pekerjaan', 'kategori_pekerjaan.id = lowongan_pekerjaan.id_kategori', 'left');
        $this->db->where('lowongan_pekerjaan.dibuat_oleh', $user_id);
        $this->db->order_by('lowongan_pekerjaan.id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    // Dapatkan statistik lowongan berdasarkan status
    public function dapatkan_statistik_status() {
        $this->db->select('status, COUNT(*) as jumlah');
        $this->db->from('lowongan_pekerjaan');
        $this->db->group_by('status');
        $query = $this->db->get();
        return $query->result();
    }

    // Dapatkan statistik lowongan berdasarkan kategori
    public function dapatkan_statistik_kategori() {
        $this->db->select('kategori_pekerjaan.nama as kategori, COUNT(*) as jumlah');
        $this->db->from('lowongan_pekerjaan');
        $this->db->join('kategori_pekerjaan', 'kategori_pekerjaan.id = lowongan_pekerjaan.id_kategori', 'left');
        $this->db->group_by('lowongan_pekerjaan.id_kategori');
        $this->db->order_by('jumlah', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    // Dapatkan statistik lowongan bulanan untuk tahun tertentu
    public function dapatkan_statistik_bulanan($year = null) {
        if (!$year) {
            $year = date('Y');
        }

        $this->db->select('MONTH(dibuat_pada) as bulan, COUNT(*) as jumlah');
        $this->db->from('lowongan_pekerjaan');
        $this->db->where('YEAR(dibuat_pada)', $year);
        $this->db->group_by('MONTH(dibuat_pada)');
        $this->db->order_by('bulan', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    // Hitung lowongan berdasarkan status
    public function hitung_lowongan_berdasarkan_status($status) {
        $this->db->where('status', $status);
        return $this->db->count_all_results('lowongan_pekerjaan');
    }
}
