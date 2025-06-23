<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Blog extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    // Dapatkan semua artikel
    public function dapatkan_artikel_semua() {
        $this->db->select('post_blog.*, pengguna.nama_lengkap as author_name');
        $this->db->from('post_blog');
        $this->db->join('pengguna', 'pengguna.id = post_blog.id_penulis', 'left');
        $this->db->order_by('post_blog.id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    // Dapatkan artikel berdasarkan ID
    public function dapatkan_artikel($id) {
        $this->db->select('post_blog.*, pengguna.nama_lengkap as author_name');
        $this->db->from('post_blog');
        $this->db->join('pengguna', 'pengguna.id = post_blog.id_penulis', 'left');
        $this->db->where('post_blog.id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    // Dapatkan artikel berdasarkan slug
    public function dapatkan_artikel_dari_slug($slug) {
        $this->db->select('post_blog.*, pengguna.nama_lengkap as author_name');
        $this->db->from('post_blog');
        $this->db->join('pengguna', 'pengguna.id = post_blog.id_penulis', 'left');
        $this->db->where('post_blog.slug', $slug);
        $query = $this->db->get();
        return $query->row();
    }

    // Tambah artikel baru
    public function tambah_artikel($data) {
        $this->db->insert('post_blog', $data);
        return $this->db->insert_id();
    }

    // Perbarui artikel
    public function perbarui_artikel($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('post_blog', $data);
    }

    // Hapus artikel
    public function hapus_artikel($id) {
        $this->db->where('id', $id);
        return $this->db->delete('post_blog');
    }

    // Dapatkan artikel terbaru
    public function dapatkan_artikel_terbaru($limit) {
        $this->db->select('post_blog.*, pengguna.nama_lengkap as author_name');
        $this->db->from('post_blog');
        $this->db->join('pengguna', 'pengguna.id = post_blog.id_penulis', 'left');
        $this->db->where('post_blog.status', 'dipublikasi');
        $this->db->order_by('post_blog.dibuat_pada', 'DESC');
        $this->db->limit($limit);
        $query = $this->db->get();
        return $query->result();
    }

    // Dapatkan artikel terpublikasi dengan paginasi
    public function dapatkan_artikel_terpublikasi($limit, $start) {
        $this->db->select('post_blog.*, pengguna.nama_lengkap as author_name');
        $this->db->from('post_blog');
        $this->db->join('pengguna', 'pengguna.id = post_blog.id_penulis', 'left');
        $this->db->where('post_blog.status', 'dipublikasi');
        $this->db->order_by('post_blog.dibuat_pada', 'DESC');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result();
    }

    // Hitung artikel terpublikasi
    public function hitung_artikel_terpublikasi() {
        $this->db->where('status', 'dipublikasi');
        return $this->db->count_all_results('post_blog');
    }

    // Hitung total artikel
    public function hitung_artikel() {
        return $this->db->count_all('post_blog');
    }

    // Tambah kategori artikel
    public function tambah_kategori_artikel($post_id, $category_id) {
        $data = array(
            'id_post' => $post_id,
            'id_kategori' => $category_id
        );
        return $this->db->insert('kategori_post_blog', $data);
    }

    // Hapus semua kategori artikel
    public function hapus_semua_kategori_artikel($post_id) {
        $this->db->where('id_post', $post_id);
        return $this->db->delete('kategori_post_blog');
    }

    // Dapatkan kategori artikel
    public function dapatkan_kategori_artikel($post_id) {
        $this->db->select('kategori_blog.*');
        $this->db->from('kategori_post_blog');
        $this->db->join('kategori_blog', 'kategori_blog.id = kategori_post_blog.id_kategori', 'left');
        $this->db->where('kategori_post_blog.id_post', $post_id);
        $query = $this->db->get();
        return $query->result();
    }

    // Dapatkan artikel berdasarkan kategori
    public function dapatkan_artikel_berdasarkan_kategori($category_id, $limit = null) {
        $this->db->select('post_blog.*, pengguna.nama_lengkap as author_name');
        $this->db->from('post_blog');
        $this->db->join('kategori_post_blog', 'kategori_post_blog.id_post = post_blog.id', 'left');
        $this->db->join('pengguna', 'pengguna.id = post_blog.id_penulis', 'left');
        $this->db->where('kategori_post_blog.id_kategori', $category_id);
        $this->db->where('post_blog.status', 'dipublikasi');
        $this->db->order_by('post_blog.dibuat_pada', 'DESC');

        if ($limit) {
            $this->db->limit($limit);
        }

        $query = $this->db->get();
        return $query->result();
    }

    // Dapatkan artikel terkait
    public function dapatkan_artikel_terkait($post_id, $limit) {
        // Dapatkan kategori artikel saat ini
        $categories = $this->dapatkan_kategori_artikel($post_id);
        $category_ids = array();

        foreach ($categories as $category) {
            $category_ids[] = $category->id;
        }

        if (empty($category_ids)) {
            // Jika tidak ada kategori, tampilkan artikel terbaru
            $this->db->select('post_blog.*, pengguna.nama_lengkap as author_name');
            $this->db->from('post_blog');
            $this->db->join('pengguna', 'pengguna.id = post_blog.id_penulis', 'left');
            $this->db->where('post_blog.id !=', $post_id);
            $this->db->where('post_blog.status', 'dipublikasi');
            $this->db->order_by('post_blog.dibuat_pada', 'DESC');
            $this->db->limit($limit);
            $query = $this->db->get();
            return $query->result();
        } else {
            // Jika ada kategori, tampilkan artikel dengan kategori yang sama
            $this->db->select('post_blog.*, pengguna.nama_lengkap as author_name');
            $this->db->from('post_blog');
            $this->db->join('kategori_post_blog', 'kategori_post_blog.id_post = post_blog.id', 'left');
            $this->db->join('pengguna', 'pengguna.id = post_blog.id_penulis', 'left');
            $this->db->where('post_blog.id !=', $post_id);
            $this->db->where('post_blog.status', 'dipublikasi');
            $this->db->where_in('kategori_post_blog.id_kategori', $category_ids);
            $this->db->group_by('post_blog.id');
            $this->db->order_by('post_blog.dibuat_pada', 'DESC');
            $this->db->limit($limit);
            $query = $this->db->get();
            return $query->result();
        }
    }

    // Tambah dilihat
    public function tambah_dilihat($post_id) {
        $this->db->set('tampilan', 'tampilan+1', FALSE);
        $this->db->where('id', $post_id);
        return $this->db->update('post_blog');
    }

    // Cari artikel
    public function cari_artikel($keyword) {
        $this->db->select('post_blog.*, pengguna.nama_lengkap as author_name');
        $this->db->from('post_blog');
        $this->db->join('pengguna', 'pengguna.id = post_blog.id_penulis', 'left');
        $this->db->where('post_blog.status', 'dipublikasi');
        $this->db->group_start();
        $this->db->like('post_blog.judul', $keyword);
        $this->db->or_like('post_blog.konten', $keyword);
        $this->db->group_end();
        $this->db->order_by('post_blog.dibuat_pada', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
}
