<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Pelamar extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    // Dapatkan profil pelamar berdasarkan user ID
    public function dapatkan_profil($user_id) {
        $this->db->where('id_pengguna', $user_id);
        $query = $this->db->get('profil_pelamar');
        return $query->row();
    }

    // Buat profil kosong untuk pelamar baru
    public function buat_profil($user_id) {
        $data = array(
            'id_pengguna' => $user_id
        );
        return $this->db->insert('profil_pelamar', $data);
    }

    // Tambah profil pelamar dengan data
    public function tambah_profil($data) {
        return $this->db->insert('profil_pelamar', $data);
    }

    // Perbarui profil pelamar
    public function perbarui_profil($user_id, $data) {
        $this->db->where('id_pengguna', $user_id);
        return $this->db->update('profil_pelamar', $data);
    }

    // Hapus profil pelamar
    public function hapus_profil($user_id) {
        $this->db->where('id_pengguna', $user_id);
        return $this->db->delete('profil_pelamar');
    }

    // Dapatkan persentase kelengkapan profil
    public function dapatkan_persentase_kelengkapan_profil($user_id) {
        $this->db->where('id_pengguna', $user_id);
        $query = $this->db->get('profil_pelamar');
        $profile = $query->row();

        if (!$profile) {
            return 0;
        }

        $total_fields = 7; // Jumlah field yang dihitung (tanggal_lahir, jenis_kelamin, pendidikan, pengalaman, keahlian, cv, url_linkedin)
        $filled_fields = 0;

        if (!empty($profile->tanggal_lahir)) $filled_fields++;
        if (!empty($profile->jenis_kelamin)) $filled_fields++;
        if (!empty($profile->pendidikan)) $filled_fields++;
        if (!empty($profile->pengalaman)) $filled_fields++;
        if (!empty($profile->keahlian)) $filled_fields++;
        if (!empty($profile->cv)) $filled_fields++;
        if (!empty($profile->url_linkedin)) $filled_fields++;

        return round(($filled_fields / $total_fields) * 100);
    }

    // Dapatkan pelamar berdasarkan skills
    public function dapatkan_pelamar_berdasarkan_skills($skills) {
        $skills_array = explode(',', $skills);
        $skills_array = array_map('trim', $skills_array);

        $this->db->select('profil_pelamar.*, pengguna.nama_lengkap, pengguna.email, pengguna.foto_profil');
        $this->db->from('profil_pelamar');
        $this->db->join('pengguna', 'pengguna.id = profil_pelamar.id_pengguna', 'left');

        $this->db->group_start();
        foreach ($skills_array as $skill) {
            $this->db->or_like('profil_pelamar.keahlian', $skill);
        }
        $this->db->group_end();

        $query = $this->db->get();
        return $query->result();
    }

    // Dapatkan pelamar berdasarkan pendidikan
    public function dapatkan_pelamar_berdasarkan_pendidikan($education) {
        $this->db->select('profil_pelamar.*, pengguna.nama_lengkap, pengguna.email, pengguna.foto_profil');
        $this->db->from('profil_pelamar');
        $this->db->join('pengguna', 'pengguna.id = profil_pelamar.id_pengguna', 'left');
        $this->db->like('profil_pelamar.pendidikan', $education);
        $query = $this->db->get();
        return $query->result();
    }

    // Dapatkan pelamar berdasarkan pengalaman
    public function dapatkan_pelamar_berdasarkan_pengalaman($experience) {
        $this->db->select('profil_pelamar.*, pengguna.nama_lengkap, pengguna.email, pengguna.foto_profil');
        $this->db->from('profil_pelamar');
        $this->db->join('pengguna', 'pengguna.id = profil_pelamar.id_pengguna', 'left');
        $this->db->like('profil_pelamar.pengalaman', $experience);
        $query = $this->db->get();
        return $query->result();
    }

    // Cari pelamar
    public function cari_pelamar($keyword) {
        $this->db->select('profil_pelamar.*, pengguna.nama_lengkap, pengguna.email, pengguna.foto_profil');
        $this->db->from('profil_pelamar');
        $this->db->join('pengguna', 'pengguna.id = profil_pelamar.id_pengguna', 'left');
        $this->db->group_start();
        $this->db->like('pengguna.nama_lengkap', $keyword);
        $this->db->or_like('pengguna.email', $keyword);
        $this->db->or_like('profil_pelamar.keahlian', $keyword);
        $this->db->or_like('profil_pelamar.pendidikan', $keyword);
        $this->db->or_like('profil_pelamar.pengalaman', $keyword);
        $this->db->group_end();
        $query = $this->db->get();
        return $query->result();
    }

    // Dapatkan pelamar dengan paginasi
    public function dapatkan_pelamar_paginasi($limit, $start) {
        $this->db->select('profil_pelamar.*, pengguna.nama_lengkap, pengguna.email, pengguna.foto_profil, pengguna.status');
        $this->db->from('profil_pelamar');
        $this->db->join('pengguna', 'pengguna.id = profil_pelamar.id_pengguna', 'left');
        $this->db->order_by('pengguna.id', 'DESC');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result();
    }

    // Hitung total pelamar
    public function hitung_pelamar() {
        $this->db->from('profil_pelamar');
        $this->db->join('pengguna', 'pengguna.id = profil_pelamar.id_pengguna', 'left');
        return $this->db->count_all_results();
    }
}
