<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Kategori extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function dapatkan_kategori_lowongan() {
        $this->db->order_by('nama', 'ASC');
        $query = $this->db->get('kategori_pekerjaan');
        return $query->result();
    }

    public function dapatkan_kategori_lowongan_dari_id($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('kategori_pekerjaan');
        return $query->row();
    }

    public function tambah_kategori_lowongan($data) {
        $this->db->insert('kategori_pekerjaan', $data);
        return $this->db->insert_id();
    }

    public function perbarui_kategori_lowongan($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('kategori_pekerjaan', $data);
    }

    public function hapus_kategori_lowongan($id) {
        $this->db->where('id', $id);
        return $this->db->delete('kategori_pekerjaan');
    }

    public function dapatkan_kategori_blog() {
        $this->db->order_by('nama', 'ASC');
        $query = $this->db->get('kategori_blog');
        return $query->result();
    }

    public function dapatkan_kategori_blog_dari_id($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('kategori_blog');
        return $query->row();
    }

    public function tambah_kategori_blog($data) {
        $this->db->insert('kategori_blog', $data);
        return $this->db->insert_id();
    }

    public function perbarui_kategori_blog($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('kategori_blog', $data);
    }

    public function hapus_kategori_blog($id) {
        $this->db->where('id', $id);
        return $this->db->delete('kategori_blog');
    }

    public function hitung_lowongan_berdasarkan_kategori($category_id) {
        $this->db->where('id_kategori', $category_id);
        $query = $this->db->get('lowongan_pekerjaan');
        return $query->num_rows();
    }

    public function hitung_artikel_berdasarkan_kategori($category_id) {
        $this->db->from('kategori_post_blog');
        $this->db->where('id_kategori', $category_id);
        return $this->db->count_all_results();
    }

    public function dapatkan_kategori_lowongan_dengan_jumlah() {
        $this->db->select('kategori_pekerjaan.*, COUNT(lowongan_pekerjaan.id) as jumlah_lowongan');
        $this->db->from('kategori_pekerjaan');
        $this->db->join('lowongan_pekerjaan', 'lowongan_pekerjaan.id_kategori = kategori_pekerjaan.id', 'left');
        $this->db->group_by('kategori_pekerjaan.id');
        $this->db->order_by('jumlah_lowongan', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function dapatkan_kategori_blog_dengan_jumlah() {
        $this->db->select('kategori_blog.*, COUNT(kategori_post_blog.id_post) as post_count');
        $this->db->from('kategori_blog');
        $this->db->join('kategori_post_blog', 'kategori_post_blog.id_kategori = kategori_blog.id', 'left');
        $this->db->group_by('kategori_blog.id');
        $this->db->order_by('kategori_blog.nama', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }
}
