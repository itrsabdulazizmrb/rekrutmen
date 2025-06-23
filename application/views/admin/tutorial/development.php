<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header pb-0">
        <div class="d-flex align-items-center">
          <div class="icon icon-shape icon-sm bg-gradient-primary shadow text-center border-radius-md me-3">
            <i class="ni ni-laptop text-white opacity-10"></i>
          </div>
          <div>
            <h6 class="mb-0">Development Guide</h6>
            <p class="text-sm mb-0">Panduan lengkap pengembangan sistem SIREK</p>
          </div>
        </div>
      </div>
      <div class="card-body">

        <div class="row">
          <div class="col-12">
            <h5 class="text-gradient text-primary">📁 Struktur Proyek</h5>
            <p>SIREK menggunakan framework CodeIgniter 3 dengan struktur MVC (Model-View-Controller):</p>

            <div class="file-tree">
              <div class="folder">sirek/</div>
              <ul>
                <li><span class="folder">application/</span>
                  <ul>
                    <li><span class="folder">controllers/</span> - Logic aplikasi dan routing</li>
                    <li><span class="folder">models/</span> - Interaksi dengan database</li>
                    <li><span class="folder">views/</span> - Template dan tampilan UI</li>
                    <li><span class="folder">config/</span> - Konfigurasi aplikasi</li>
                    <li><span class="folder">libraries/</span> - Custom libraries</li>
                    <li><span class="folder">helpers/</span> - Helper functions</li>
                  </ul>
                </li>
                <li><span class="folder">assets/</span>
                  <ul>
                    <li><span class="folder">css/</span> - Stylesheet files</li>
                    <li><span class="folder">js/</span> - JavaScript files</li>
                    <li><span class="folder">img/</span> - Images dan icons</li>
                  </ul>
                </li>
                <li><span class="folder">uploads/</span> - File uploads (CV, foto profil)</li>
                <li><span class="file">index.php</span> - Entry point aplikasi</li>
              </ul>
            </div>

            <hr class="horizontal dark">

            <h5 class="text-gradient text-primary">🚀 Setup & Instalasi</h5>

            <div class="step-item">
              <div class="step-number">1</div>
              <div>
                <h6>Persiapan Environment</h6>
                <p>Pastikan server memiliki:</p>
                <ul>
                  <li>PHP 7.4 atau lebih tinggi</li>
                  <li>MySQL 5.7 atau MariaDB 10.2+</li>
                  <li>Apache/Nginx web server</li>
                  <li>Composer (optional untuk dependencies)</li>
                </ul>
              </div>
            </div>

            <div class="step-item">
              <div class="step-number">2</div>
              <div>
                <h6>Clone Repository</h6>
                <div class="code-block">
git clone https://github.com/username/sirek.git
cd sirek
                </div>
              </div>
            </div>

            <div class="step-item">
              <div class="step-number">3</div>
              <div>
                <h6>Konfigurasi Database</h6>
                <p>Edit file <code>application/config/database.php</code>:</p>
                <div class="code-block">
$db['default'] = array(
    'dsn'      => '',
    'hostname' => 'localhost',
    'username' => 'your_username',
    'password' => 'your_password',
    'database' => 'sirek_db',
    'dbdriver' => 'mysqli',
    'dbprefix' => '',
    'pconnect' => FALSE,
    'db_debug' => (ENVIRONMENT !== 'production'),
    'cache_on' => FALSE,
    'cachedir' => '',
    'char_set' => 'utf8',
    'dbcollat' => 'utf8_general_ci',
);
                </div>
              </div>
            </div>

            <div class="step-item">
              <div class="step-number">4</div>
              <div>
                <h6>Import Database</h6>
                <p>Import file SQL yang tersedia di folder <code>database/</code>:</p>
                <div class="code-block">
mysql -u username -p sirek_db < database/sirek_structure.sql
mysql -u username -p sirek_db < database/sirek_data.sql
                </div>
              </div>
            </div>

            <div class="step-item">
              <div class="step-number">5</div>
              <div>
                <h6>Konfigurasi Base URL</h6>
                <p>Edit file <code>application/config/config.php</code>:</p>
                <div class="code-block">
$config['base_url'] = 'http://localhost/sirek/';
                </div>
              </div>
            </div>

            <hr class="horizontal dark">

            <h5 class="text-gradient text-primary">🗄️ Database Schema</h5>
            <p>Struktur database utama SIREK:</p>

            <div class="row">
              <div class="col-md-6">
                <h6>📋 Tabel Utama</h6>
                <ul>
                  <li><strong>pengguna</strong> - Data user (admin, pelamar, recruiter)</li>
                  <li><strong>lowongan_pekerjaan</strong> - Data lowongan kerja</li>
                  <li><strong>lamaran_pekerjaan</strong> - Data lamaran pelamar</li>
                  <li><strong>penilaian_pelamar</strong> - Hasil assessment</li>
                  <li><strong>kategori_pekerjaan</strong> - Kategori lowongan</li>
                </ul>
              </div>
              <div class="col-md-6">
                <h6>🔗 Relasi Penting</h6>
                <ul>
                  <li>pengguna → lamaran_pekerjaan (1:N)</li>
                  <li>lowongan_pekerjaan → lamaran_pekerjaan (1:N)</li>
                  <li>kategori_pekerjaan → lowongan_pekerjaan (1:N)</li>
                  <li>lamaran_pekerjaan → penilaian_pelamar (1:1)</li>
                </ul>
              </div>
            </div>

            <hr class="horizontal dark">

            <h5 class="text-gradient text-primary">⚙️ Konfigurasi Environment</h5>

            <div class="row">
              <div class="col-md-6">
                <h6>Development Mode</h6>
                <div class="code-block">
// index.php
define('ENVIRONMENT', 'development');

// config/config.php
$config['log_threshold'] = 4;
                </div>
              </div>
              <div class="col-md-6">
                <h6>Production Mode</h6>
                <div class="code-block">
// index.php
define('ENVIRONMENT', 'production');

// config/config.php
$config['log_threshold'] = 1;
                </div>
              </div>
            </div>

            <div class="alert alert-info">
              <strong>💡 Tips:</strong>
              <ul class="mb-0">
                <li>Gunakan <code>ENVIRONMENT = 'development'</code> saat development</li>
                <li>Set folder <code>uploads/</code> permission ke 755</li>
                <li>Enable mod_rewrite untuk clean URLs</li>
                <li>Backup database secara berkala</li>
              </ul>
            </div>

          </div>
        </div>

      </div>
    </div>
  </div>
</div>
