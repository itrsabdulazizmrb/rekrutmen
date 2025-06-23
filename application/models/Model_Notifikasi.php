<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Notifikasi extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    // Dapatkan semua notifikasi untuk pengguna tertentu
    public function dapatkan_notifikasi_pengguna($id_pengguna, $limit = 20, $offset = 0, $status = null) {
        $this->db->select('n.*, p.nama_lengkap as dibuat_oleh_nama');
        $this->db->from('notifikasi n');
        $this->db->join('pengguna p', 'p.id = n.dibuat_oleh', 'left');
        $this->db->where('n.id_pengguna', $id_pengguna);
        
        if ($status !== null) {
            $this->db->where('n.status', $status);
        }
        
        // Filter notifikasi yang belum kedaluwarsa
        $this->db->where('(n.kedaluwarsa_pada IS NULL OR n.kedaluwarsa_pada > NOW())');
        
        $this->db->order_by('n.dibuat_pada', 'DESC');
        $this->db->limit($limit, $offset);
        
        $query = $this->db->get();
        return $query->result();
    }

    // Hitung notifikasi belum dibaca
    public function hitung_notifikasi_belum_dibaca($id_pengguna) {
        $this->db->where('id_pengguna', $id_pengguna);
        $this->db->where('status', 'belum_dibaca');
        $this->db->where('(kedaluwarsa_pada IS NULL OR kedaluwarsa_pada > NOW())');
        return $this->db->count_all_results('notifikasi');
    }

    // Dapatkan notifikasi berdasarkan ID
    public function dapatkan_notifikasi($id) {
        $this->db->select('n.*, p.nama_lengkap as dibuat_oleh_nama');
        $this->db->from('notifikasi n');
        $this->db->join('pengguna p', 'p.id = n.dibuat_oleh', 'left');
        $this->db->where('n.id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    // Buat notifikasi baru
    public function buat_notifikasi($data) {
        // Validasi data wajib
        $required_fields = ['id_pengguna', 'judul', 'pesan'];
        foreach ($required_fields as $field) {
            if (!isset($data[$field]) || empty($data[$field])) {
                return false;
            }
        }

        // Set default values
        $notification_data = array(
            'id_pengguna' => $data['id_pengguna'],
            'judul' => $data['judul'],
            'pesan' => $data['pesan'],
            'jenis' => isset($data['jenis']) ? $data['jenis'] : 'sistem',
            'prioritas' => isset($data['prioritas']) ? $data['prioritas'] : 'normal',
            'status' => 'belum_dibaca',
            'id_referensi' => isset($data['id_referensi']) ? $data['id_referensi'] : null,
            'tabel_referensi' => isset($data['tabel_referensi']) ? $data['tabel_referensi'] : null,
            'url_aksi' => isset($data['url_aksi']) ? $data['url_aksi'] : null,
            'icon' => isset($data['icon']) ? $data['icon'] : $this->dapatkan_icon_default($data['jenis'] ?? 'sistem'),
            'warna' => isset($data['warna']) ? $data['warna'] : $this->dapatkan_warna_default($data['jenis'] ?? 'sistem'),
            'kedaluwarsa_pada' => isset($data['kedaluwarsa_pada']) ? $data['kedaluwarsa_pada'] : null,
            'dibuat_oleh' => isset($data['dibuat_oleh']) ? $data['dibuat_oleh'] : null
        );

        $this->db->insert('notifikasi', $notification_data);
        return $this->db->insert_id();
    }

    // Buat notifikasi untuk multiple pengguna
    public function buat_notifikasi_massal($data, $id_pengguna_array) {
        $notification_ids = array();
        
        foreach ($id_pengguna_array as $id_pengguna) {
            $data['id_pengguna'] = $id_pengguna;
            $notification_id = $this->buat_notifikasi($data);
            if ($notification_id) {
                $notification_ids[] = $notification_id;
            }
        }
        
        return $notification_ids;
    }

    // Tandai notifikasi sebagai dibaca
    public function tandai_dibaca($id, $id_pengguna = null) {
        $this->db->set('status', 'dibaca');
        $this->db->set('dibaca_pada', 'NOW()', FALSE);
        $this->db->where('id', $id);
        
        if ($id_pengguna !== null) {
            $this->db->where('id_pengguna', $id_pengguna);
        }
        
        return $this->db->update('notifikasi');
    }

    // Tandai semua notifikasi sebagai dibaca
    public function tandai_semua_dibaca($id_pengguna) {
        $this->db->set('status', 'dibaca');
        $this->db->set('dibaca_pada', 'NOW()', FALSE);
        $this->db->where('id_pengguna', $id_pengguna);
        $this->db->where('status', 'belum_dibaca');
        return $this->db->update('notifikasi');
    }

    // Hapus notifikasi
    public function hapus_notifikasi($id, $id_pengguna = null) {
        $this->db->where('id', $id);
        if ($id_pengguna !== null) {
            $this->db->where('id_pengguna', $id_pengguna);
        }
        return $this->db->delete('notifikasi');
    }

    // Arsipkan notifikasi
    public function arsipkan_notifikasi($id, $id_pengguna = null) {
        $this->db->set('status', 'diarsipkan');
        $this->db->where('id', $id);
        if ($id_pengguna !== null) {
            $this->db->where('id_pengguna', $id_pengguna);
        }
        return $this->db->update('notifikasi');
    }

    // Bersihkan notifikasi lama
    public function bersihkan_notifikasi_lama($hari = 30) {
        $this->db->where('dibuat_pada <', date('Y-m-d H:i:s', strtotime("-{$hari} days")));
        $this->db->where('status', 'dibaca');
        return $this->db->delete('notifikasi');
    }

    // Dapatkan statistik notifikasi
    public function dapatkan_statistik_notifikasi($id_pengguna) {
        $stats = array();
        
        // Total notifikasi
        $this->db->where('id_pengguna', $id_pengguna);
        $stats['total'] = $this->db->count_all_results('notifikasi');
        
        // Belum dibaca
        $this->db->where('id_pengguna', $id_pengguna);
        $this->db->where('status', 'belum_dibaca');
        $stats['belum_dibaca'] = $this->db->count_all_results('notifikasi');
        
        // Dibaca
        $this->db->where('id_pengguna', $id_pengguna);
        $this->db->where('status', 'dibaca');
        $stats['dibaca'] = $this->db->count_all_results('notifikasi');
        
        // Diarsipkan
        $this->db->where('id_pengguna', $id_pengguna);
        $this->db->where('status', 'diarsipkan');
        $stats['diarsipkan'] = $this->db->count_all_results('notifikasi');
        
        // Per jenis
        $this->db->select('jenis, COUNT(*) as jumlah');
        $this->db->where('id_pengguna', $id_pengguna);
        $this->db->group_by('jenis');
        $query = $this->db->get('notifikasi');
        $stats['per_jenis'] = $query->result();
        
        return $stats;
    }

    // Helper: Dapatkan icon default berdasarkan jenis
    private function dapatkan_icon_default($jenis) {
        $icons = array(
            'lamaran_baru' => 'ni ni-briefcase-24',
            'status_lamaran' => 'ni ni-check-bold',
            'sistem' => 'ni ni-settings-gear-65',
            'registrasi_pengguna' => 'ni ni-single-02',
            'jadwal_interview' => 'ni ni-calendar-grid-58',
            'penilaian' => 'ni ni-trophy',
            'lowongan_baru' => 'ni ni-badge'
        );
        
        return isset($icons[$jenis]) ? $icons[$jenis] : 'ni ni-bell-55';
    }

    // Helper: Dapatkan warna default berdasarkan jenis
    private function dapatkan_warna_default($jenis) {
        $colors = array(
            'lamaran_baru' => 'info',
            'status_lamaran' => 'success',
            'sistem' => 'warning',
            'registrasi_pengguna' => 'primary',
            'jadwal_interview' => 'info',
            'penilaian' => 'success',
            'lowongan_baru' => 'primary'
        );
        
        return isset($colors[$jenis]) ? $colors[$jenis] : 'primary';
    }

    // Dapatkan pengaturan notifikasi pengguna
    public function dapatkan_pengaturan_notifikasi($id_pengguna) {
        $this->db->where('id_pengguna', $id_pengguna);
        $query = $this->db->get('pengaturan_notifikasi');
        return $query->result();
    }

    // Perbarui pengaturan notifikasi
    public function perbarui_pengaturan_notifikasi($id_pengguna, $jenis_notifikasi, $data) {
        $this->db->where('id_pengguna', $id_pengguna);
        $this->db->where('jenis_notifikasi', $jenis_notifikasi);
        
        $existing = $this->db->get('pengaturan_notifikasi')->row();
        
        if ($existing) {
            $this->db->where('id', $existing->id);
            return $this->db->update('pengaturan_notifikasi', $data);
        } else {
            $data['id_pengguna'] = $id_pengguna;
            $data['jenis_notifikasi'] = $jenis_notifikasi;
            $this->db->insert('pengaturan_notifikasi', $data);
            return $this->db->insert_id();
        }
    }

    // Cek apakah pengguna mengaktifkan jenis notifikasi tertentu
    public function cek_pengaturan_aktif($id_pengguna, $jenis_notifikasi) {
        $this->db->where('id_pengguna', $id_pengguna);
        $this->db->where('jenis_notifikasi', $jenis_notifikasi);
        $this->db->where('aktif', 1);
        $query = $this->db->get('pengaturan_notifikasi');
        return $query->num_rows() > 0;
    }
}
