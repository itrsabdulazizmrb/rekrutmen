<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header pb-0">
        <div class="d-flex align-items-center">
          <div class="icon icon-shape icon-sm bg-gradient-success shadow text-center border-radius-md me-3">
            <i class="ni ni-app text-white opacity-10"></i>
          </div>
          <div>
            <h6 class="mb-0">CRUD Operations Tutorial</h6>
            <p class="text-sm mb-0">Panduan lengkap membuat operasi CRUD baru dengan contoh praktis</p>
          </div>
        </div>
      </div>
      <div class="card-body">

        <div class="row">
          <div class="col-12">
            <h5 class="text-gradient text-success mb-3">📝 Tutorial CRUD: Membuat Modul "Kategori Lowongan"</h5>
            <p class="mb-4">Tutorial ini akan menunjukkan cara membuat modul CRUD lengkap menggunakan contoh "Kategori Lowongan" yang sudah ada di SIREK.</p>

            <div class="alert alert-success">
              <strong>💡 Yang akan dipelajari:</strong>
              <ul class="mb-0">
                <li>Membuat tabel database</li>
                <li>Membuat Model untuk operasi database</li>
                <li>Menambahkan method di Controller</li>
                <li>Membuat View untuk tampilan</li>
                <li>Implementasi form validation</li>
              </ul>
            </div>

            <hr class="horizontal dark">

            <h6 class="text-success">🗄️ Langkah 1: Buat Tabel Database</h6>
            <p>Pertama, buat tabel di database MySQL:</p>

            <div class="bg-gray-100 border-radius-lg p-3 mb-3">
              <pre class="mb-0"><code>CREATE TABLE `kategori_pekerjaan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `deskripsi` text,
  `status` enum('aktif','nonaktif') DEFAULT 'aktif',
  `dibuat_pada` timestamp DEFAULT CURRENT_TIMESTAMP,
  `diperbarui_pada` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;</code></pre>
            </div>

            <hr class="horizontal dark">

            <h6 class="text-success">📄 Langkah 2: Buat Model</h6>
            <p>Buat file <code>application/models/Model_Kategori.php</code>:</p>

            <div class="bg-gray-100 border-radius-lg p-3 mb-3">
              <pre class="mb-0"><code>&lt;?php
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
}</code></pre>
            </div>

            <hr class="horizontal dark">

            <h6 class="text-success">🎮 Langkah 3: Tambah Method di Controller</h6>
            <p>Load model di constructor dan tambahkan method di <code>application/controllers/Admin.php</code>:</p>

            <div class="bg-gray-100 border-radius-lg p-3 mb-3">
              <pre class="mb-0"><code>// Di constructor, tambahkan:
$this->load->model('model_kategori');

// Method untuk menampilkan daftar kategori
public function kategori() {
    $data['categories'] = $this->model_kategori->dapatkan_kategori_lowongan();
    $data['title'] = 'Kategori Lowongan';
    $this->load->view('templates/admin_header', $data);
    $this->load->view('admin/kategori/index', $data);
    $this->load->view('templates/admin_footer');
}

// Method untuk menambah kategori baru
public function tambah_kategori() {
    if ($this->input->post()) {
        $this->form_validation->set_rules('nama', 'Nama Kategori', 'required');

        if ($this->form_validation->run() == TRUE) {
            $data = array(
                'nama' => $this->input->post('nama'),
                'deskripsi' => $this->input->post('deskripsi'),
                'status' => $this->input->post('status') ? 'aktif' : 'nonaktif'
            );

            if ($this->model_kategori->tambah_kategori_lowongan($data)) {
                $this->session->set_flashdata('success', 'Kategori berhasil ditambahkan');
            } else {
                $this->session->set_flashdata('error', 'Gagal menambahkan kategori');
            }
            redirect('admin/kategori');
        }
    }

    $data['title'] = 'Tambah Kategori';
    $this->load->view('templates/admin_header', $data);
    $this->load->view('admin/kategori/tambah', $data);
    $this->load->view('templates/admin_footer');
}</code></pre>
            </div>

            <hr class="horizontal dark">

            <h6 class="text-success">🖼️ Langkah 4: Buat View Index</h6>
            <p>Buat folder <code>admin/kategori/</code> dan file <code>index.php</code> di dalamnya:</p>

            <div class="bg-gray-100 border-radius-lg p-3 mb-3">
              <pre class="mb-0"><code>&lt;div class="row"&gt;
  &lt;div class="col-12"&gt;
    &lt;div class="card"&gt;
      &lt;div class="card-header pb-0"&gt;
        &lt;div class="d-flex justify-content-between"&gt;
          &lt;h6&gt;Daftar Kategori Lowongan&lt;/h6&gt;
          &lt;a href="&lt;?= base_url('admin/tambah_kategori') ?&gt;" class="btn btn-primary btn-sm"&gt;
            &lt;i class="ni ni-fat-add"&gt;&lt;/i&gt; Tambah Kategori
          &lt;/a&gt;
        &lt;/div&gt;
      &lt;/div&gt;
      &lt;div class="card-body px-0 pt-0 pb-2"&gt;
        &lt;div class="table-responsive p-0"&gt;
          &lt;table class="table align-items-center mb-0"&gt;
            &lt;thead&gt;
              &lt;tr&gt;
                &lt;th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"&gt;Nama&lt;/th&gt;
                &lt;th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"&gt;Deskripsi&lt;/th&gt;
                &lt;th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"&gt;Status&lt;/th&gt;
                &lt;th class="text-secondary opacity-7"&gt;Aksi&lt;/th&gt;
              &lt;/tr&gt;
            &lt;/thead&gt;
            &lt;tbody&gt;
              &lt;?php foreach ($categories as $category) : ?&gt;
                &lt;tr&gt;
                  &lt;td&gt;
                    &lt;div class="d-flex px-2 py-1"&gt;
                      &lt;div class="d-flex flex-column justify-content-center"&gt;
                        &lt;h6 class="mb-0 text-sm"&gt;&lt;?= htmlspecialchars($category-&gt;nama) ?&gt;&lt;/h6&gt;
                      &lt;/div&gt;
                    &lt;/div&gt;
                  &lt;/td&gt;
                  &lt;td&gt;
                    &lt;p class="text-xs text-secondary mb-0"&gt;&lt;?= htmlspecialchars($category-&gt;deskripsi) ?&gt;&lt;/p&gt;
                  &lt;/td&gt;
                  &lt;td&gt;
                    &lt;span class="badge badge-sm bg-gradient-&lt;?= $category-&gt;status == 'aktif' ? 'success' : 'secondary' ?&gt;"&gt;
                      &lt;?= ucfirst($category-&gt;status) ?&gt;
                    &lt;/span&gt;
                  &lt;/td&gt;
                  &lt;td class="align-middle"&gt;
                    &lt;a href="&lt;?= base_url('admin/edit_kategori/' . $category-&gt;id) ?&gt;" class="btn btn-sm btn-outline-warning mb-0"&gt;Edit&lt;/a&gt;
                    &lt;a href="&lt;?= base_url('admin/hapus_kategori/' . $category-&gt;id) ?&gt;" class="btn btn-sm btn-outline-danger mb-0" onclick="return confirm('Yakin hapus?')"&gt;Hapus&lt;/a&gt;
                  &lt;/td&gt;
                &lt;/tr&gt;
              &lt;?php endforeach; ?&gt;
            &lt;/tbody&gt;
          &lt;/table&gt;
        &lt;/div&gt;
      &lt;/div&gt;
    &lt;/div&gt;
  &lt;/div&gt;
&lt;/div&gt;</code></pre>
            </div>

            <hr class="horizontal dark">

            <h6 class="text-success">📝 Langkah 5: Buat Form Tambah</h6>
            <p>Buat file <code>application/views/admin/kategori/tambah.php</code>:</p>

            <div class="bg-gray-100 border-radius-lg p-3 mb-4">
              <pre class="mb-0"><code>&lt;div class="row"&gt;
  &lt;div class="col-md-8"&gt;
    &lt;div class="card"&gt;
      &lt;div class="card-header pb-0"&gt;
        &lt;h6&gt;Tambah Kategori Lowongan&lt;/h6&gt;
      &lt;/div&gt;
      &lt;div class="card-body"&gt;
        &lt;?= form_open() ?&gt;
          &lt;div class="form-group mb-3"&gt;
            &lt;label for="nama" class="form-control-label"&gt;Nama Kategori&lt;/label&gt;
            &lt;input type="text" class="form-control" id="nama" name="nama" required&gt;
            &lt;?= form_error('nama', '&lt;small class="text-danger"&gt;', '&lt;/small&gt;') ?&gt;
          &lt;/div&gt;

          &lt;div class="form-group mb-3"&gt;
            &lt;label for="deskripsi" class="form-control-label"&gt;Deskripsi&lt;/label&gt;
            &lt;textarea class="form-control" id="deskripsi" name="deskripsi" rows="3"&gt;&lt;/textarea&gt;
          &lt;/div&gt;

          &lt;div class="form-check form-switch mb-3"&gt;
            &lt;input class="form-check-input" type="checkbox" id="status" name="status" value="1" checked&gt;
            &lt;label class="form-check-label" for="status"&gt;Aktif&lt;/label&gt;
          &lt;/div&gt;

          &lt;div class="form-group"&gt;
            &lt;button type="submit" class="btn btn-primary"&gt;
              &lt;i class="ni ni-check-bold"&gt;&lt;/i&gt; Simpan
            &lt;/button&gt;
            &lt;a href="&lt;?= base_url('admin/kategori') ?&gt;" class="btn btn-secondary"&gt;
              &lt;i class="ni ni-bold-left"&gt;&lt;/i&gt; Batal
            &lt;/a&gt;
          &lt;/div&gt;
        &lt;?= form_close() ?&gt;
      &lt;/div&gt;
    &lt;/div&gt;
  &lt;/div&gt;
&lt;/div&gt;</code></pre>
            </div>

            <hr class="horizontal dark">

            <h6 class="text-success">🔗 Langkah 6: Tambah Menu Navigation</h6>
            <p>Tambahkan menu di <code>application/views/templates/admin_header.php</code>:</p>

            <div class="bg-gray-100 border-radius-lg p-3 mb-4">
              <pre class="mb-0"><code>&lt;li class="nav-item"&gt;
  &lt;a class="nav-link &lt;?= $this->uri-&gt;segment(2) == 'kategori' ? 'active' : '' ?&gt;" href="&lt;?= base_url('admin/kategori') ?&gt;"&gt;
    &lt;div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center"&gt;
      &lt;i class="ni ni-tag text-info text-sm opacity-10"&gt;&lt;/i&gt;
    &lt;/div&gt;
    &lt;span class="nav-link-text ms-1"&gt;Kategori Lowongan&lt;/span&gt;
  &lt;/a&gt;
&lt;/li&gt;</code></pre>
            </div>

            <hr class="horizontal dark">

            <h5 class="text-gradient text-success">🎯 Tips & Best Practices</h5>

            <div class="row">
              <div class="col-md-6">
                <div class="card h-100">
                  <div class="card-body">
                    <h6 class="text-success">✅ Yang Harus Dilakukan</h6>
                    <ul class="text-sm">
                      <li>Gunakan form validation CodeIgniter</li>
                      <li>Sanitize output dengan <code>htmlspecialchars()</code></li>
                      <li>Gunakan Active Record untuk query database</li>
                      <li>Implementasi error handling yang baik</li>
                      <li>Tambahkan confirmation untuk delete</li>
                      <li>Gunakan flash messages untuk feedback</li>
                      <li>Konsisten dengan naming convention</li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="card h-100">
                  <div class="card-body">
                    <h6 class="text-danger">❌ Yang Harus Dihindari</h6>
                    <ul class="text-sm">
                      <li>Output data langsung tanpa sanitasi</li>
                      <li>Hardcode SQL queries</li>
                      <li>Lupa validasi di server-side</li>
                      <li>Expose sensitive data</li>
                      <li>Tidak handle edge cases</li>
                      <li>Tidak menggunakan CSRF protection</li>
                      <li>Inconsistent error handling</li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>

            <div class="alert alert-info mt-4">
              <strong>🚀 Tips Lanjutan:</strong>
              <ul class="mb-0">
                <li><strong>DataTables:</strong> Gunakan untuk tabel dengan data banyak</li>
                <li><strong>Soft Delete:</strong> Implementasi untuk data penting</li>
                <li><strong>Search & Filter:</strong> Tambahkan functionality pencarian</li>
                <li><strong>AJAX:</strong> Gunakan untuk operasi tanpa reload halaman</li>
                <li><strong>Pagination:</strong> Implementasi untuk performa yang baik</li>
                <li><strong>Caching:</strong> Cache query yang sering digunakan</li>
              </ul>
            </div>

            <div class="alert alert-warning">
              <strong>⚠️ Catatan Penting:</strong><br>
              Setelah membuat CRUD baru, jangan lupa untuk:
              <ol class="mb-0 mt-2">
                <li>Test semua functionality (Create, Read, Update, Delete)</li>
                <li>Validasi form dengan data yang salah</li>
                <li>Test dengan berbagai role user</li>
                <li>Pastikan responsive di mobile</li>
                <li>Check security (XSS, SQL Injection)</li>
              </ol>
            </div>

          </div>
        </div>

      </div>
    </div>
  </div>
</div>
