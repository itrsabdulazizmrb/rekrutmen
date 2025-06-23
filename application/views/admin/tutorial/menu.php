<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header pb-0">
        <div class="d-flex align-items-center">
          <div class="icon icon-shape icon-sm bg-gradient-warning shadow text-center border-radius-md me-3">
            <i class="fas fa-bars text-white opacity-10"></i>
          </div>
          <div>
            <h6 class="mb-0">Menu Management Tutorial</h6>
            <p class="text-sm mb-0">Panduan menambahkan menu baru dan konfigurasi routing</p>
          </div>
        </div>
      </div>
      <div class="card-body">
        
        <div class="row">
          <div class="col-12">
            <h5 class="text-gradient text-warning">🧭 Menambahkan Menu Baru</h5>
            <p>Tutorial ini menunjukkan cara menambahkan menu item baru ke admin sidebar.</p>
            
            <div class="step-item">
              <div class="step-number">1</div>
              <div>
                <h6>Edit Admin Header Template</h6>
                <p>Buka file <code>application/views/templates/admin_header.php</code> dan tambahkan menu item baru:</p>
                <div class="code-block">
&lt;li class="nav-item"&gt;
  &lt;a class="nav-link &lt;?= $this->uri->segment(2) == 'nama_menu' ? 'active' : '' ?&gt;" href="&lt;?= base_url('admin/nama_menu') ?&gt;"&gt;
    &lt;div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center"&gt;
      &lt;i class="ni ni-icon-name text-primary text-sm opacity-10"&gt;&lt;/i&gt;
    &lt;/div&gt;
    &lt;span class="nav-link-text ms-1"&gt;Nama Menu&lt;/span&gt;
  &lt;/a&gt;
&lt;/li&gt;
                </div>
              </div>
            </div>
            
            <div class="step-item">
              <div class="step-number">2</div>
              <div>
                <h6>Tambahkan Controller Method</h6>
                <p>Tambahkan method baru di <code>application/controllers/Admin.php</code>:</p>
                <div class="code-block">
public function nama_menu() {
    $data['title'] = 'Nama Menu';
    $this->load->view('templates/admin_header', $data);
    $this->load->view('admin/nama_menu/index', $data);
    $this->load->view('templates/admin_footer');
}
                </div>
              </div>
            </div>
            
            <div class="step-item">
              <div class="step-number">3</div>
              <div>
                <h6>Buat View Template</h6>
                <p>Buat folder dan file view di <code>application/views/admin/nama_menu/index.php</code>:</p>
                <div class="code-block">
&lt;div class="row"&gt;
  &lt;div class="col-12"&gt;
    &lt;div class="card"&gt;
      &lt;div class="card-header pb-0"&gt;
        &lt;h6&gt;Nama Menu&lt;/h6&gt;
      &lt;/div&gt;
      &lt;div class="card-body"&gt;
        &lt;p&gt;Konten halaman menu baru&lt;/p&gt;
      &lt;/div&gt;
    &lt;/div&gt;
  &lt;/div&gt;
&lt;/div&gt;
                </div>
              </div>
            </div>
            
            <hr class="horizontal dark">
            
            <h5 class="text-gradient text-warning">🎨 Icon Guidelines</h5>
            <p>SIREK menggunakan Nucleo Icons. Berikut panduan pemilihan icon:</p>
            
            <div class="row">
              <div class="col-md-6">
                <h6>📋 Icon untuk Modul Data</h6>
                <ul>
                  <li><code>ni-briefcase-24</code> - Lowongan/Jobs</li>
                  <li><code>ni-single-copy-04</code> - Lamaran/Applications</li>
                  <li><code>ni-single-02</code> - Pengguna/Users</li>
                  <li><code>ni-ruler-pencil</code> - Penilaian/Assessment</li>
                  <li><code>ni-tag</code> - Kategori/Categories</li>
                </ul>
              </div>
              <div class="col-md-6">
                <h6>⚙️ Icon untuk Utilitas</h6>
                <ul>
                  <li><code>ni-tv-2</code> - Dashboard</li>
                  <li><code>ni-chart-bar-32</code> - Laporan/Reports</li>
                  <li><code>ni-book-bookmark</code> - Tutorial/Docs</li>
                  <li><code>ni-settings-gear-65</code> - Settings</li>
                  <li><code>ni-button-power</code> - Logout</li>
                </ul>
              </div>
            </div>
            
            <hr class="horizontal dark">
            
            <h5 class="text-gradient text-warning">🔐 Permission & Access Control</h5>
            
            <div class="step-item">
              <div class="step-number">1</div>
              <div>
                <h6>Tambahkan Role Check</h6>
                <p>Tambahkan pengecekan role di controller method:</p>
                <div class="code-block">
public function nama_menu() {
    if ($this->session->userdata('role') != 'admin') {
        show_404();
    }
    
    $data['title'] = 'Nama Menu';
    $this->load->view('templates/admin_header', $data);
    $this->load->view('admin/nama_menu/index', $data);
    $this->load->view('templates/admin_footer');
}
                </div>
              </div>
            </div>
            
            <div class="step-item">
              <div class="step-number">2</div>
              <div>
                <h6>Conditional Menu Display</h6>
                <p>Tampilkan menu berdasarkan role di template:</p>
                <div class="code-block">
&lt;?php if ($this->session->userdata('role') == 'admin') : ?&gt;
  &lt;li class="nav-item"&gt;
    &lt;a class="nav-link" href="&lt;?= base_url('admin/nama_menu') ?&gt;"&gt;
      &lt;div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center"&gt;
        &lt;i class="ni ni-icon-name text-primary text-sm opacity-10"&gt;&lt;/i&gt;
      &lt;/div&gt;
      &lt;span class="nav-link-text ms-1"&gt;Nama Menu&lt;/span&gt;
    &lt;/a&gt;
  &lt;/li&gt;
&lt;?php endif; ?&gt;
                </div>
              </div>
            </div>
            
            <hr class="horizontal dark">
            
            <h5 class="text-gradient text-warning">🛣️ Routing Configuration</h5>
            
            <div class="step-item">
              <div class="step-number">1</div>
              <div>
                <h6>Default Routing</h6>
                <p>CodeIgniter menggunakan routing otomatis: <code>controller/method/parameter</code></p>
                <div class="code-block">
URL: admin/nama_menu
Controller: Admin.php
Method: nama_menu()
                </div>
              </div>
            </div>
            
            <div class="step-item">
              <div class="step-number">2</div>
              <div>
                <h6>Custom Routes (Optional)</h6>
                <p>Edit <code>application/config/routes.php</code> untuk custom routing:</p>
                <div class="code-block">
$route['admin/custom-url'] = 'admin/nama_menu';
$route['admin/menu/(:num)'] = 'admin/nama_menu/detail/$1';
                </div>
              </div>
            </div>
            
            <hr class="horizontal dark">
            
            <h5 class="text-gradient text-warning">📱 Responsive Menu</h5>
            <p>Menu SIREK sudah responsive. Berikut struktur yang digunakan:</p>
            
            <div class="code-block">
&lt;aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs"&gt;
  &lt;div class="sidenav-header"&gt;
    &lt;!-- Logo dan brand --&gt;
  &lt;/div&gt;
  
  &lt;div class="collapse navbar-collapse w-auto"&gt;
    &lt;ul class="navbar-nav"&gt;
      &lt;!-- Menu items --&gt;
    &lt;/ul&gt;
  &lt;/div&gt;
&lt;/aside&gt;
            </div>
            
            <div class="alert alert-warning">
              <strong>⚠️ Penting:</strong>
              <ul class="mb-0">
                <li>Selalu test menu di mobile dan desktop</li>
                <li>Pastikan active state berfungsi dengan benar</li>
                <li>Gunakan icon yang konsisten dengan tema</li>
                <li>Implementasi proper access control</li>
                <li>Test dengan berbagai role user</li>
              </ul>
            </div>
            
            <hr class="horizontal dark">
            
            <h5 class="text-gradient text-warning">🎯 Menu Organization</h5>
            
            <div class="row">
              <div class="col-md-6">
                <h6>📊 Main Modules</h6>
                <ul>
                  <li>Dashboard</li>
                  <li>Lamaran</li>
                  <li>Penilaian</li>
                  <li>Manajemen Lowongan</li>
                  <li>Artikel & Blog</li>
                </ul>
              </div>
              <div class="col-md-6">
                <h6>⚙️ System Modules</h6>
                <ul>
                  <li>Manajemen Pengguna</li>
                  <li>Laporan</li>
                  <li>Tutorial & Dokumentasi</li>
                  <li>Profil</li>
                  <li>Keluar</li>
                </ul>
              </div>
            </div>
            
            <div class="alert alert-info">
              <strong>💡 Tips Menu:</strong>
              <ul class="mb-0">
                <li>Kelompokkan menu berdasarkan fungsi</li>
                <li>Gunakan separator untuk membagi grup menu</li>
                <li>Prioritaskan menu yang sering digunakan</li>
                <li>Gunakan nama menu yang jelas dan deskriptif</li>
                <li>Implementasi breadcrumb untuk navigasi yang lebih baik</li>
              </ul>
            </div>
            
          </div>
        </div>
        
      </div>
    </div>
  </div>
</div>
