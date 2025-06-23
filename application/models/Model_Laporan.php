<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Laporan extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    // ========== RINGKASAN LAPORAN ==========

    public function dapatkan_ringkasan_laporan() {
        $data = [];

        // Total lowongan
        $this->db->from('lowongan_pekerjaan');
        $data['total_lowongan'] = $this->db->count_all_results();

        // Lowongan aktif
        $this->db->where('status', 'aktif');
        $this->db->where('batas_waktu >=', date('Y-m-d'));
        $this->db->from('lowongan_pekerjaan');
        $data['lowongan_aktif'] = $this->db->count_all_results();

        // Total lamaran
        $this->db->from('lamaran_pekerjaan');
        $data['total_lamaran'] = $this->db->count_all_results();

        // Lamaran bulan ini
        $this->db->where('MONTH(tanggal_lamaran)', date('m'));
        $this->db->where('YEAR(tanggal_lamaran)', date('Y'));
        $this->db->from('lamaran_pekerjaan');
        $data['lamaran_bulan_ini'] = $this->db->count_all_results();

        // Total pelamar
        $this->db->where('role', 'pelamar');
        $this->db->from('pengguna');
        $data['total_pelamar'] = $this->db->count_all_results();

        // Pelamar baru bulan ini
        $this->db->where('role', 'pelamar');
        $this->db->where('MONTH(dibuat_pada)', date('m'));
        $this->db->where('YEAR(dibuat_pada)', date('Y'));
        $this->db->from('pengguna');
        $data['pelamar_baru_bulan_ini'] = $this->db->count_all_results();

        // Total penilaian
        $this->db->from('penilaian');
        $data['total_penilaian'] = $this->db->count_all_results();

        // Penilaian selesai
        $this->db->where('status', 'selesai');
        $this->db->from('penilaian_pelamar');
        $data['penilaian_selesai'] = $this->db->count_all_results();

        return $data;
    }

    // ========== LAPORAN LOWONGAN ==========

    public function laporan_lowongan($filters = []) {
        $this->db->select('lowongan_pekerjaan.*, kategori_pekerjaan.nama as kategori_nama');
        $this->db->from('lowongan_pekerjaan');
        $this->db->join('kategori_pekerjaan', 'kategori_pekerjaan.id = lowongan_pekerjaan.id_kategori', 'left');

        // Apply filters
        if (!empty($filters['tanggal_mulai']) && !empty($filters['tanggal_selesai'])) {
            $this->db->where('lowongan_pekerjaan.dibuat_pada >=', $filters['tanggal_mulai']);
            $this->db->where('lowongan_pekerjaan.dibuat_pada <=', $filters['tanggal_selesai']);
        } elseif (!empty($filters['periode'])) {
            $this->_apply_periode_filter('lowongan_pekerjaan.dibuat_pada', $filters['periode']);
        }

        if (!empty($filters['kategori'])) {
            $this->db->where('lowongan_pekerjaan.id_kategori', $filters['kategori']);
        }

        if (!empty($filters['status'])) {
            $this->db->where('lowongan_pekerjaan.status', $filters['status']);
        }

        if (!empty($filters['lokasi'])) {
            $this->db->where('lowongan_pekerjaan.lokasi', $filters['lokasi']);
        }

        $this->db->order_by('lowongan_pekerjaan.dibuat_pada', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function statistik_lowongan($filters = []) {
        $data = [];

        // Statistik berdasarkan status
        $this->db->select('status, COUNT(*) as jumlah');
        $this->db->from('lowongan_pekerjaan');
        $this->_apply_lowongan_filters($filters);
        $this->db->group_by('status');
        $data['berdasarkan_status'] = $this->db->get()->result();

        // Statistik berdasarkan kategori
        $this->db->select('kategori_pekerjaan.nama as kategori, COUNT(*) as jumlah');
        $this->db->from('lowongan_pekerjaan');
        $this->db->join('kategori_pekerjaan', 'kategori_pekerjaan.id = lowongan_pekerjaan.id_kategori', 'left');
        $this->_apply_lowongan_filters($filters);
        $this->db->group_by('lowongan_pekerjaan.id_kategori');
        $data['berdasarkan_kategori'] = $this->db->get()->result();

        // Statistik berdasarkan lokasi
        $this->db->select('lokasi, COUNT(*) as jumlah');
        $this->db->from('lowongan_pekerjaan');
        $this->_apply_lowongan_filters($filters);
        $this->db->where('lokasi IS NOT NULL');
        $this->db->where('lokasi !=', '');
        $this->db->group_by('lokasi');
        $data['berdasarkan_lokasi'] = $this->db->get()->result();

        return $data;
    }

    public function dapatkan_lokasi_lowongan() {
        $this->db->select('lokasi');
        $this->db->from('lowongan_pekerjaan');
        $this->db->where('lokasi IS NOT NULL');
        $this->db->where('lokasi !=', '');
        $this->db->distinct();
        $this->db->order_by('lokasi', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    // ========== LAPORAN LAMARAN ==========

    public function laporan_lamaran($filters = []) {
        $this->db->select('lamaran_pekerjaan.*, lowongan_pekerjaan.judul as lowongan_judul,
                          pengguna.nama_lengkap as pelamar_nama');
        $this->db->from('lamaran_pekerjaan');
        $this->db->join('lowongan_pekerjaan', 'lowongan_pekerjaan.id = lamaran_pekerjaan.id_pekerjaan', 'left');
        $this->db->join('pengguna', 'pengguna.id = lamaran_pekerjaan.id_pelamar', 'left');

        // Apply filters
        if (!empty($filters['tanggal_mulai']) && !empty($filters['tanggal_selesai'])) {
            $this->db->where('lamaran_pekerjaan.tanggal_lamaran >=', $filters['tanggal_mulai']);
            $this->db->where('lamaran_pekerjaan.tanggal_lamaran <=', $filters['tanggal_selesai']);
        } elseif (!empty($filters['periode'])) {
            $this->_apply_periode_filter('lamaran_pekerjaan.tanggal_lamaran', $filters['periode']);
        }

        if (!empty($filters['status'])) {
            $this->db->where('lamaran_pekerjaan.status', $filters['status']);
        }

        if (!empty($filters['lowongan'])) {
            $this->db->where('lamaran_pekerjaan.id_pekerjaan', $filters['lowongan']);
        }

        $this->db->order_by('lamaran_pekerjaan.tanggal_lamaran', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function statistik_lamaran($filters = []) {
        $data = [];

        // Statistik berdasarkan status
        $this->db->select('status, COUNT(*) as jumlah');
        $this->db->from('lamaran_pekerjaan');
        $this->_apply_lamaran_filters($filters);
        $this->db->group_by('status');
        $data['berdasarkan_status'] = $this->db->get()->result();

        // Statistik berdasarkan lowongan
        $this->db->select('lowongan_pekerjaan.judul as lowongan, COUNT(*) as jumlah');
        $this->db->from('lamaran_pekerjaan');
        $this->db->join('lowongan_pekerjaan', 'lowongan_pekerjaan.id = lamaran_pekerjaan.id_pekerjaan', 'left');
        $this->_apply_lamaran_filters($filters);
        $this->db->group_by('lamaran_pekerjaan.id_pekerjaan');
        $this->db->order_by('jumlah', 'DESC');
        $this->db->limit(10);
        $data['berdasarkan_lowongan'] = $this->db->get()->result();

        // Statistik bulanan
        $this->db->select('MONTH(tanggal_lamaran) as bulan, YEAR(tanggal_lamaran) as tahun, COUNT(*) as jumlah');
        $this->db->from('lamaran_pekerjaan');
        $this->_apply_lamaran_filters($filters);
        $this->db->group_by('YEAR(tanggal_lamaran), MONTH(tanggal_lamaran)');
        $this->db->order_by('tahun DESC, bulan DESC');
        $this->db->limit(12);
        $data['berdasarkan_bulan'] = $this->db->get()->result();

        return $data;
    }

    public function conversion_rate_lamaran($filters = []) {
        // Total lamaran
        $this->db->from('lamaran_pekerjaan');
        $this->_apply_lamaran_filters($filters);
        $total_lamaran = $this->db->count_all_results();

        // Lamaran diterima
        $this->db->from('lamaran_pekerjaan');
        $this->_apply_lamaran_filters($filters);
        $this->db->where('status', 'diterima');
        $lamaran_diterima = $this->db->count_all_results();

        // Lamaran ditolak
        $this->db->from('lamaran_pekerjaan');
        $this->_apply_lamaran_filters($filters);
        $this->db->where('status', 'ditolak');
        $lamaran_ditolak = $this->db->count_all_results();

        return [
            'total_lamaran' => $total_lamaran,
            'lamaran_diterima' => $lamaran_diterima,
            'lamaran_ditolak' => $lamaran_ditolak,
            'conversion_rate' => $total_lamaran > 0 ? round(($lamaran_diterima / $total_lamaran) * 100, 2) : 0,
            'rejection_rate' => $total_lamaran > 0 ? round(($lamaran_ditolak / $total_lamaran) * 100, 2) : 0
        ];
    }

    public function dapatkan_daftar_lowongan() {
        $this->db->select('id, judul');
        $this->db->from('lowongan_pekerjaan');
        $this->db->order_by('judul', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    // ========== HELPER METHODS ==========

    private function _apply_periode_filter($field, $periode) {
        switch ($periode) {
            case 'hari':
                $this->db->where("DATE($field)", date('Y-m-d'));
                break;
            case 'minggu':
                $this->db->where("WEEK($field)", date('W'));
                $this->db->where("YEAR($field)", date('Y'));
                break;
            case 'bulan':
                $this->db->where("MONTH($field)", date('m'));
                $this->db->where("YEAR($field)", date('Y'));
                break;
            case 'tahun':
                $this->db->where("YEAR($field)", date('Y'));
                break;
        }
    }

    private function _apply_lowongan_filters($filters) {
        if (!empty($filters['tanggal_mulai']) && !empty($filters['tanggal_selesai'])) {
            $this->db->where('lowongan_pekerjaan.dibuat_pada >=', $filters['tanggal_mulai']);
            $this->db->where('lowongan_pekerjaan.dibuat_pada <=', $filters['tanggal_selesai']);
        } elseif (!empty($filters['periode'])) {
            $this->_apply_periode_filter('lowongan_pekerjaan.dibuat_pada', $filters['periode']);
        }
    }

    private function _apply_lamaran_filters($filters) {
        if (!empty($filters['tanggal_mulai']) && !empty($filters['tanggal_selesai'])) {
            $this->db->where('lamaran_pekerjaan.tanggal_lamaran >=', $filters['tanggal_mulai']);
            $this->db->where('lamaran_pekerjaan.tanggal_lamaran <=', $filters['tanggal_selesai']);
        } elseif (!empty($filters['periode'])) {
            $this->_apply_periode_filter('lamaran_pekerjaan.tanggal_lamaran', $filters['periode']);
        }
    }

    // ========== LAPORAN PELAMAR ==========

    public function laporan_pelamar($filters = []) {
        $this->db->select('pengguna.*, profil_pelamar.pendidikan, COUNT(lamaran_pekerjaan.id) as total_lamaran');
        $this->db->from('pengguna');
        $this->db->join('profil_pelamar', 'profil_pelamar.id_pengguna = pengguna.id', 'left');
        $this->db->join('lamaran_pekerjaan', 'lamaran_pekerjaan.id_pelamar = pengguna.id', 'left');
        $this->db->where('pengguna.role', 'pelamar');

        // Apply filters
        if (!empty($filters['tanggal_mulai']) && !empty($filters['tanggal_selesai'])) {
            $this->db->where('pengguna.dibuat_pada >=', $filters['tanggal_mulai']);
            $this->db->where('pengguna.dibuat_pada <=', $filters['tanggal_selesai']);
        } elseif (!empty($filters['periode'])) {
            $this->_apply_periode_filter('pengguna.dibuat_pada', $filters['periode']);
        }

        if (!empty($filters['lokasi'])) {
            $this->db->where('pengguna.alamat LIKE', '%' . $filters['lokasi'] . '%');
        }

        if (!empty($filters['pendidikan'])) {
            $this->db->where('profil_pelamar.pendidikan', $filters['pendidikan']);
        }

        $this->db->group_by('pengguna.id');
        $this->db->order_by('pengguna.dibuat_pada', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function statistik_pelamar($filters = []) {
        $data = [];

        // Statistik berdasarkan pendidikan
        $this->db->select('profil_pelamar.pendidikan, COUNT(*) as jumlah');
        $this->db->from('pengguna');
        $this->db->join('profil_pelamar', 'profil_pelamar.id_pengguna = pengguna.id', 'left');
        $this->db->where('pengguna.role', 'pelamar');
        $this->_apply_pelamar_filters($filters);
        $this->db->where('profil_pelamar.pendidikan IS NOT NULL');
        $this->db->where('profil_pelamar.pendidikan !=', '');
        $this->db->group_by('profil_pelamar.pendidikan');
        $data['berdasarkan_pendidikan'] = $this->db->get()->result();

        // Statistik berdasarkan lokasi (dari alamat)
        $this->db->select('SUBSTRING_INDEX(alamat, ",", -1) as lokasi, COUNT(*) as jumlah');
        $this->db->from('pengguna');
        $this->db->where('role', 'pelamar');
        $this->_apply_pelamar_filters($filters);
        $this->db->where('alamat IS NOT NULL');
        $this->db->where('alamat !=', '');
        $this->db->group_by('lokasi');
        $this->db->order_by('jumlah', 'DESC');
        $this->db->limit(10);
        $data['berdasarkan_lokasi'] = $this->db->get()->result();

        // Statistik registrasi bulanan
        $this->db->select('MONTH(dibuat_pada) as bulan, YEAR(dibuat_pada) as tahun, COUNT(*) as jumlah');
        $this->db->from('pengguna');
        $this->db->where('role', 'pelamar');
        $this->_apply_pelamar_filters($filters);
        $this->db->group_by('YEAR(dibuat_pada), MONTH(dibuat_pada)');
        $this->db->order_by('tahun DESC, bulan DESC');
        $this->db->limit(12);
        $data['registrasi_bulanan'] = $this->db->get()->result();

        return $data;
    }

    public function aktivitas_login_pelamar($filters = []) {
        $this->db->select('pengguna.nama_lengkap, pengguna.email, pengguna.login_terakhir,
                          COUNT(lamaran_pekerjaan.id) as total_lamaran');
        $this->db->from('pengguna');
        $this->db->join('lamaran_pekerjaan', 'lamaran_pekerjaan.id_pelamar = pengguna.id', 'left');
        $this->db->where('pengguna.role', 'pelamar');

        if (!empty($filters['tanggal_mulai']) && !empty($filters['tanggal_selesai'])) {
            $this->db->where('pengguna.login_terakhir >=', $filters['tanggal_mulai']);
            $this->db->where('pengguna.login_terakhir <=', $filters['tanggal_selesai']);
        } elseif (!empty($filters['periode'])) {
            $this->_apply_periode_filter('pengguna.login_terakhir', $filters['periode']);
        }

        $this->db->group_by('pengguna.id');
        $this->db->order_by('pengguna.login_terakhir', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    // ========== LAPORAN PENILAIAN ==========

    public function laporan_hasil_penilaian($filters = []) {
        $this->db->select('penilaian_pelamar.id,
                          penilaian_pelamar.status,
                          penilaian_pelamar.nilai,
                          penilaian_pelamar.waktu_mulai,
                          penilaian_pelamar.waktu_selesai,
                          penilaian_pelamar.dibuat_pada,
                          penilaian.judul as penilaian_judul,
                          pengguna.nama_lengkap as pelamar_nama,
                          lowongan_pekerjaan.judul as lowongan_judul,
                          penilaian_pelamar.waktu_mulai as tanggal_mulai,
                          CASE
                            WHEN penilaian_pelamar.waktu_mulai IS NOT NULL AND penilaian_pelamar.waktu_selesai IS NOT NULL
                            THEN TIMESTAMPDIFF(MINUTE, penilaian_pelamar.waktu_mulai, penilaian_pelamar.waktu_selesai)
                            ELSE NULL
                          END as waktu_pengerjaan');
        $this->db->from('penilaian_pelamar');
        $this->db->join('penilaian', 'penilaian.id = penilaian_pelamar.id_penilaian', 'left');
        $this->db->join('lamaran_pekerjaan', 'lamaran_pekerjaan.id = penilaian_pelamar.id_lamaran', 'left');
        $this->db->join('pengguna', 'pengguna.id = lamaran_pekerjaan.id_pelamar', 'left');
        $this->db->join('lowongan_pekerjaan', 'lowongan_pekerjaan.id = lamaran_pekerjaan.id_pekerjaan', 'left');

        // Apply filters - jika tidak ada filter periode, tampilkan semua data
        if (!empty($filters['tanggal_mulai']) && !empty($filters['tanggal_selesai'])) {
            $this->db->where('DATE(penilaian_pelamar.waktu_mulai) >=', $filters['tanggal_mulai']);
            $this->db->where('DATE(penilaian_pelamar.waktu_mulai) <=', $filters['tanggal_selesai']);
        } elseif (!empty($filters['periode']) && $filters['periode'] != 'semua') {
            $this->_apply_periode_filter('penilaian_pelamar.waktu_mulai', $filters['periode']);
        }

        if (!empty($filters['penilaian'])) {
            $this->db->where('penilaian_pelamar.id_penilaian', $filters['penilaian']);
        }

        if (!empty($filters['lowongan'])) {
            $this->db->where('lamaran_pekerjaan.id_pekerjaan', $filters['lowongan']);
        }

        $this->db->order_by('penilaian_pelamar.dibuat_pada', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }



    public function statistik_penilaian($filters = []) {
        $data = [];

        // Statistik berdasarkan status
        $this->db->select('status, COUNT(*) as jumlah');
        $this->db->from('penilaian_pelamar');
        $this->_apply_penilaian_filters($filters);
        $this->db->group_by('status');
        $data['berdasarkan_status'] = $this->db->get()->result();

        // Rata-rata skor per penilaian
        $this->db->select('penilaian.judul as penilaian, AVG(penilaian_pelamar.nilai) as rata_rata_skor,
                          COUNT(penilaian_pelamar.id) as total_peserta');
        $this->db->from('penilaian_pelamar');
        $this->db->join('penilaian', 'penilaian.id = penilaian_pelamar.id_penilaian', 'left');
        $this->_apply_penilaian_filters($filters);
        $this->db->where('penilaian_pelamar.status', 'selesai');
        $this->db->group_by('penilaian_pelamar.id_penilaian');
        $data['rata_rata_per_penilaian'] = $this->db->get()->result();

        // Distribusi waktu pengerjaan (dalam menit)
        $this->db->select('CASE
                          WHEN TIMESTAMPDIFF(MINUTE, waktu_mulai, waktu_selesai) <= 30 THEN "0-30 menit"
                          WHEN TIMESTAMPDIFF(MINUTE, waktu_mulai, waktu_selesai) <= 60 THEN "31-60 menit"
                          WHEN TIMESTAMPDIFF(MINUTE, waktu_mulai, waktu_selesai) <= 120 THEN "61-120 menit"
                          ELSE "Lebih dari 120 menit"
                          END as kategori_waktu, COUNT(*) as jumlah');
        $this->db->from('penilaian_pelamar');
        $this->_apply_penilaian_filters($filters);
        $this->db->where('status', 'selesai');
        $this->db->where('waktu_mulai IS NOT NULL');
        $this->db->where('waktu_selesai IS NOT NULL');
        $this->db->group_by('kategori_waktu');
        $data['distribusi_waktu'] = $this->db->get()->result();

        return $data;
    }

    public function tingkat_kelulusan_penilaian($filters = []) {
        // Total peserta
        $this->db->from('penilaian_pelamar');
        $this->_apply_penilaian_filters($filters);
        $total_peserta = $this->db->count_all_results();

        // Peserta lulus (nilai >= 70)
        $this->db->from('penilaian_pelamar');
        $this->_apply_penilaian_filters($filters);
        $this->db->where('nilai >=', 70);
        $this->db->where('status', 'selesai');
        $peserta_lulus = $this->db->count_all_results();

        // Peserta tidak lulus
        $this->db->from('penilaian_pelamar');
        $this->_apply_penilaian_filters($filters);
        $this->db->where('nilai <', 70);
        $this->db->where('status', 'selesai');
        $peserta_tidak_lulus = $this->db->count_all_results();

        return [
            'total_peserta' => $total_peserta,
            'peserta_lulus' => $peserta_lulus,
            'peserta_tidak_lulus' => $peserta_tidak_lulus,
            'tingkat_kelulusan' => $total_peserta > 0 ? round(($peserta_lulus / $total_peserta) * 100, 2) : 0
        ];
    }

    public function dapatkan_daftar_penilaian() {
        $this->db->select('id, judul');
        $this->db->from('penilaian');
        $this->db->order_by('judul', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    // ========== HELPER METHODS TAMBAHAN ==========

    private function _apply_pelamar_filters($filters) {
        if (!empty($filters['tanggal_mulai']) && !empty($filters['tanggal_selesai'])) {
            $this->db->where('pengguna.dibuat_pada >=', $filters['tanggal_mulai']);
            $this->db->where('pengguna.dibuat_pada <=', $filters['tanggal_selesai']);
        } elseif (!empty($filters['periode'])) {
            $this->_apply_periode_filter('pengguna.dibuat_pada', $filters['periode']);
        }
    }

    private function _apply_penilaian_filters($filters) {
        if (!empty($filters['tanggal_mulai']) && !empty($filters['tanggal_selesai'])) {
            $this->db->where('penilaian_pelamar.waktu_mulai >=', $filters['tanggal_mulai']);
            $this->db->where('penilaian_pelamar.waktu_mulai <=', $filters['tanggal_selesai']);
        } elseif (!empty($filters['periode'])) {
            $this->_apply_periode_filter('penilaian_pelamar.waktu_mulai', $filters['periode']);
        }
    }
}
