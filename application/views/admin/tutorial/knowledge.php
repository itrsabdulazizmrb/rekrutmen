<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header pb-0">
        <div class="d-flex align-items-center">
          <div class="icon icon-shape icon-sm bg-gradient-info shadow text-center border-radius-md me-3">
            <i class="fas fa-book text-white opacity-10"></i>
          </div>
          <div>
            <h6 class="mb-0">Knowledge Base</h6>
            <p class="text-sm mb-0">Standar coding, konvensi, dan best practices sistem rekrutmen RSUD H. Abdul Aziz Marabahan</p>
          </div>
        </div>
      </div>
      <div class="card-body">
        
        <div class="row">
          <div class="col-12">
            <h5 class="text-gradient text-info">📋 Coding Standards</h5>
            
            <div class="row">
              <div class="col-md-6">
                <h6>🐘 PHP Standards</h6>
                <ul>
                  <li>Gunakan PSR-1 dan PSR-12 coding standards</li>
                  <li>Nama class menggunakan PascalCase</li>
                  <li>Nama method dan variable menggunakan camelCase</li>
                  <li>Nama file menggunakan snake_case</li>
                  <li>Selalu gunakan php opening tag</li>
                  <li>Indentasi menggunakan 4 spaces</li>
                </ul>
                
                <div class="code-block">
// ✅ Good
class Model_Pengguna extends CI_Model {
    public function dapatkanPengguna($id) {
        $this->db->where('id', $id);
        return $this->db->get('pengguna')->row();
    }
}

// ❌ Bad
class model_pengguna extends CI_Model {
    public function DapatkanPengguna($id) {
        $this->db->where('id',$id);
        return $this->db->get('pengguna')->row();
    }
}
                </div>
              </div>
              
              <div class="col-md-6">
                <h6>🌐 HTML/CSS Standards</h6>
                <ul>
                  <li>Gunakan semantic HTML5 elements</li>
                  <li>Class names menggunakan kebab-case</li>
                  <li>Gunakan Bootstrap 5 classes</li>
                  <li>Responsive design first</li>
                  <li>Accessibility considerations</li>
                </ul>
                
                <div class="code-block">
<!-- ✅ Good -->
<div class="card-header pb-0">
  <h6 class="mb-0">Title</h6>
</div>

<!-- ❌ Bad -->
<div class="cardHeader">
  <h6 class="mb0">Title</h6>
</div>
                </div>
              </div>
            </div>
            
            <hr class="horizontal dark">
            
            <h5 class="text-gradient text-info">📁 File Organization</h5>
            
            <div class="row">
              <div class="col-md-6">
                <h6>📂 Naming Conventions</h6>
                <ul>
                  <li><strong>Controllers:</strong> PascalCase (Admin.php)</li>
                  <li><strong>Models:</strong> Model_Nama.php</li>
                  <li><strong>Views:</strong> snake_case.php</li>
                  <li><strong>CSS/JS:</strong> kebab-case.css</li>
                  <li><strong>Images:</strong> kebab-case.jpg</li>
                </ul>
              </div>
              
              <div class="col-md-6">
                <h6>🗂️ Folder Structure</h6>
                <div class="code-block">
views/
├── admin/
│   ├── dashboard.php
│   ├── lowongan/
│   │   ├── index.php
│   │   ├── tambah.php
│   │   └── edit.php
│   └── tutorial/
│       ├── index.php
│       ├── development.php
│       └── crud.php
└── templates/
    ├── admin_header.php
    └── admin_footer.php
                </div>
              </div>
            </div>
            
            <hr class="horizontal dark">
            
            <h5 class="text-gradient text-info">🔒 Security Best Practices</h5>
            
            <div class="row">
              <div class="col-md-6">
                <h6>🛡️ Input Validation</h6>
                <div class="code-block">
// Form validation
$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
$this->form_validation->set_rules('nama', 'Nama', 'required|min_length[3]|max_length[100]');

// XSS Protection
echo htmlspecialchars($user_input, ENT_QUOTES, 'UTF-8');

// SQL Injection Prevention
$this->db->where('id', $id);
$this->db->get('table_name');
                </div>
              </div>
              
              <div class="col-md-6">
                <h6>🔐 Authentication</h6>
                <div class="code-block">
// Session check
if (!$this->session->userdata('logged_in')) {
    redirect('auth');
}

// Role-based access
if ($this->session->userdata('role') != 'admin') {
    show_404();
}

// CSRF Protection
$this->load->library('form_validation');
                </div>
              </div>
            </div>
            
            <hr class="horizontal dark">
            
            <h5 class="text-gradient text-info">🗃️ Database Conventions</h5>
            
            <div class="row">
              <div class="col-md-6">
                <h6>📊 Table Naming</h6>
                <ul>
                  <li>Gunakan snake_case untuk nama tabel</li>
                  <li>Nama tabel dalam bentuk plural</li>
                  <li>Primary key selalu 'id'</li>
                  <li>Foreign key: nama_tabel_id</li>
                  <li>Timestamp: created_at, updated_at</li>
                </ul>
                
                <div class="code-block">
-- ✅ Good
CREATE TABLE lowongan_pekerjaan (
    id INT PRIMARY KEY AUTO_INCREMENT,
    judul VARCHAR(255) NOT NULL,
    id_kategori INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- ❌ Bad
CREATE TABLE LokerJob (
    LokerID INT PRIMARY KEY,
    Title VARCHAR(255),
    CategoryID INT
);
                </div>
              </div>
              
              <div class="col-md-6">
                <h6>🔗 Relationships</h6>
                <ul>
                  <li>One-to-Many: Foreign key di child table</li>
                  <li>Many-to-Many: Junction table</li>
                  <li>Gunakan ON DELETE CASCADE dengan hati-hati</li>
                  <li>Index pada foreign keys</li>
                </ul>
                
                <div class="code-block">
-- One-to-Many
ALTER TABLE lamaran_pekerjaan 
ADD FOREIGN KEY (id_pekerjaan) 
REFERENCES lowongan_pekerjaan(id);

-- Many-to-Many
CREATE TABLE kategori_post_blog (
    id INT PRIMARY KEY AUTO_INCREMENT,
    id_post INT,
    id_kategori INT,
    FOREIGN KEY (id_post) REFERENCES blog_posts(id),
    FOREIGN KEY (id_kategori) REFERENCES kategori_blog(id)
);
                </div>
              </div>
            </div>
            
            <hr class="horizontal dark">
            
            <h5 class="text-gradient text-info">🐛 Troubleshooting Guide</h5>
            
            <div class="row">
              <div class="col-md-6">
                <h6>❗ Common Issues</h6>
                
                <div class="alert alert-danger">
                  <strong>Error 404 - Page Not Found</strong>
                  <ul class="mb-0 mt-2">
                    <li>Check controller method exists</li>
                    <li>Verify URL routing</li>
                    <li>Check file permissions</li>
                    <li>Ensure proper case sensitivity</li>
                  </ul>
                </div>
                
                <div class="alert alert-warning">
                  <strong>Database Connection Error</strong>
                  <ul class="mb-0 mt-2">
                    <li>Check database.php config</li>
                    <li>Verify MySQL service running</li>
                    <li>Check username/password</li>
                    <li>Ensure database exists</li>
                  </ul>
                </div>
              </div>
              
              <div class="col-md-6">
                <h6>🔧 Debug Tips</h6>
                
                <div class="code-block">
// Enable error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

// CodeIgniter debugging
log_message('debug', 'Debug message');
var_dump($variable);
print_r($array);

// Database debugging
echo $this->db->last_query();
echo $this->db->_error_message();
                </div>
                
                <div class="alert alert-info">
                  <strong>💡 Performance Tips</strong>
                  <ul class="mb-0 mt-2">
                    <li>Use database indexing</li>
                    <li>Implement pagination</li>
                    <li>Optimize images</li>
                    <li>Enable caching</li>
                    <li>Minimize database queries</li>
                  </ul>
                </div>
              </div>
            </div>
            
            <hr class="horizontal dark">
            
            <h5 class="text-gradient text-info">📚 Resources & References</h5>
            
            <div class="row">
              <div class="col-md-6">
                <h6>📖 Documentation</h6>
                <ul>
                  <li><a href="https://codeigniter.com/userguide3/" target="_blank">CodeIgniter 3 User Guide</a></li>
                  <li><a href="https://getbootstrap.com/docs/5.0/" target="_blank">Bootstrap 5 Documentation</a></li>
                  <li><a href="https://www.php.net/manual/" target="_blank">PHP Manual</a></li>
                  <li><a href="https://dev.mysql.com/doc/" target="_blank">MySQL Documentation</a></li>
                </ul>
              </div>
              
              <div class="col-md-6">
                <h6>🛠️ Tools</h6>
                <ul>
                  <li>VS Code dengan PHP extensions</li>
                  <li>XAMPP/WAMP untuk local development</li>
                  <li>phpMyAdmin untuk database management</li>
                  <li>Git untuk version control</li>
                  <li>Postman untuk API testing</li>
                </ul>
              </div>
            </div>
            
            <div class="alert alert-success">
              <strong>🎯 Quick Reference:</strong>
              <div class="row mt-2">
                <div class="col-md-6">
                  <strong>File Locations:</strong>
                  <ul class="mb-0">
                    <li>Config: <code>application/config/</code></li>
                    <li>Controllers: <code>application/controllers/</code></li>
                    <li>Models: <code>application/models/</code></li>
                    <li>Views: <code>application/views/</code></li>
                  </ul>
                </div>
                <div class="col-md-6">
                  <strong>Common Functions:</strong>
                  <ul class="mb-0">
                    <li><code>base_url()</code> - Get base URL</li>
                    <li><code>redirect()</code> - Redirect to URL</li>
                    <li><code>$this->load->view()</code> - Load view</li>
                    <li><code>$this->input->post()</code> - Get POST data</li>
                  </ul>
                </div>
              </div>
            </div>
            
          </div>
        </div>
        
      </div>
    </div>
  </div>
</div>
