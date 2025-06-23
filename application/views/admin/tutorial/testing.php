<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header pb-0">
        <div class="d-flex align-items-center">
          <div class="icon icon-shape icon-sm bg-gradient-success shadow text-center border-radius-md me-3">
            <i class="ni ni-check-bold text-white opacity-10"></i>
          </div>
          <div>
            <h6 class="mb-0">Testing Guide</h6>
            <p class="text-sm mb-0">Panduan testing untuk memastikan kualitas code SIREK</p>
          </div>
        </div>
      </div>
      <div class="card-body">
        
        <div class="row">
          <div class="col-12">
            <h5 class="text-gradient text-success mb-3">🧪 Testing Strategy</h5>
            
            <div class="alert alert-success">
              <strong>🎯 Testing Goals:</strong><br>
              Memastikan semua fitur SIREK berfungsi dengan baik, aman, dan reliable melalui berbagai jenis testing.
            </div>
            
            <div class="row">
              <div class="col-md-4">
                <div class="card mb-4">
                  <div class="card-body text-center">
                    <div class="icon icon-shape icon-lg bg-gradient-primary shadow mx-auto mb-3">
                      <i class="ni ni-settings text-white opacity-10"></i>
                    </div>
                    <h6>Unit Testing</h6>
                    <p class="text-sm">Test individual functions dan methods</p>
                  </div>
                </div>
              </div>
              
              <div class="col-md-4">
                <div class="card mb-4">
                  <div class="card-body text-center">
                    <div class="icon icon-shape icon-lg bg-gradient-info shadow mx-auto mb-3">
                      <i class="ni ni-app text-white opacity-10"></i>
                    </div>
                    <h6>Integration Testing</h6>
                    <p class="text-sm">Test interaksi antar components</p>
                  </div>
                </div>
              </div>
              
              <div class="col-md-4">
                <div class="card mb-4">
                  <div class="card-body text-center">
                    <div class="icon icon-shape icon-lg bg-gradient-warning shadow mx-auto mb-3">
                      <i class="ni ni-world-2 text-white opacity-10"></i>
                    </div>
                    <h6>End-to-End Testing</h6>
                    <p class="text-sm">Test complete user workflows</p>
                  </div>
                </div>
              </div>
            </div>
            
            <hr class="horizontal dark">
            
            <h5 class="text-gradient text-success mb-3">🔧 Manual Testing Checklist</h5>
            
            <div class="card mb-4">
              <div class="card-header pb-0">
                <h6 class="text-sm">🔐 Authentication & Authorization</h6>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <h6 class="text-sm">Login Testing</h6>
                    <ul class="text-sm">
                      <li>✅ Valid credentials login</li>
                      <li>❌ Invalid email format</li>
                      <li>❌ Wrong password</li>
                      <li>❌ Non-existent user</li>
                      <li>✅ Remember me functionality</li>
                      <li>✅ Logout functionality</li>
                    </ul>
                  </div>
                  <div class="col-md-6">
                    <h6 class="text-sm">Role-based Access</h6>
                    <ul class="text-sm">
                      <li>✅ Admin access to all features</li>
                      <li>✅ Staff limited access</li>
                      <li>❌ Unauthorized page access</li>
                      <li>✅ Menu visibility by role</li>
                      <li>✅ Session timeout handling</li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="card mb-4">
              <div class="card-header pb-0">
                <h6 class="text-sm">💼 Job Management Testing</h6>
              </div>
              <div class="card-body">
                <div class="bg-gray-100 border-radius-lg p-3 mb-3">
                  <strong>Test Scenario: Create New Job</strong>
                  <ol class="mb-0 mt-2">
                    <li>Navigate to Jobs → Add New Job</li>
                    <li>Fill all required fields</li>
                    <li>Upload job image (optional)</li>
                    <li>Set deadline date</li>
                    <li>Click Save</li>
                    <li>Verify job appears in job list</li>
                    <li>Check job detail page</li>
                  </ol>
                </div>
                
                <div class="row">
                  <div class="col-md-6">
                    <h6 class="text-sm">Positive Tests</h6>
                    <ul class="text-sm">
                      <li>✅ Create job with all fields</li>
                      <li>✅ Create job with minimum required fields</li>
                      <li>✅ Edit existing job</li>
                      <li>✅ Delete job (with confirmation)</li>
                      <li>✅ Change job status</li>
                      <li>✅ Search and filter jobs</li>
                    </ul>
                  </div>
                  <div class="col-md-6">
                    <h6 class="text-sm">Negative Tests</h6>
                    <ul class="text-sm">
                      <li>❌ Submit empty form</li>
                      <li>❌ Invalid date format</li>
                      <li>❌ Upload invalid file type</li>
                      <li>❌ Exceed character limits</li>
                      <li>❌ Past deadline date</li>
                      <li>❌ SQL injection attempts</li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="card mb-4">
              <div class="card-header pb-0">
                <h6 class="text-sm">📋 Application Management Testing</h6>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <h6 class="text-sm">Application Flow</h6>
                    <ul class="text-sm">
                      <li>✅ View application list</li>
                      <li>✅ Filter by status/date</li>
                      <li>✅ View application details</li>
                      <li>✅ Download CV/documents</li>
                      <li>✅ Update application status</li>
                      <li>✅ Add assessment notes</li>
                    </ul>
                  </div>
                  <div class="col-md-6">
                    <h6 class="text-sm">Status Transitions</h6>
                    <ul class="text-sm">
                      <li>Pending → Review</li>
                      <li>Review → Interview</li>
                      <li>Interview → Accepted/Rejected</li>
                      <li>Email notifications sent</li>
                      <li>Status history tracking</li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            
            <hr class="horizontal dark">
            
            <h5 class="text-gradient text-success mb-3">🤖 Automated Testing</h5>
            
            <div class="card mb-4">
              <div class="card-header pb-0">
                <h6 class="text-sm">PHPUnit Setup</h6>
              </div>
              <div class="card-body">
                <h6 class="text-sm">1. Install PHPUnit</h6>
                <div class="bg-gray-100 border-radius-lg p-3 mb-3">
                  <pre class="mb-0"><code>composer require --dev phpunit/phpunit</code></pre>
                </div>
                
                <h6 class="text-sm">2. Create Test Configuration</h6>
                <div class="bg-gray-100 border-radius-lg p-3 mb-3">
                  <pre class="mb-0"><code>&lt;?xml version="1.0" encoding="UTF-8"?&gt;
&lt;phpunit bootstrap="tests/bootstrap.php"&gt;
    &lt;testsuites&gt;
        &lt;testsuite name="SIREK Tests"&gt;
            &lt;directory&gt;tests&lt;/directory&gt;
        &lt;/testsuite&gt;
    &lt;/testsuites&gt;
&lt;/phpunit&gt;</code></pre>
                </div>
                
                <h6 class="text-sm">3. Example Model Test</h6>
                <div class="bg-gray-100 border-radius-lg p-3">
                  <pre class="mb-0"><code>&lt;?php
class Model_Kategori_Test extends PHPUnit\Framework\TestCase {
    
    public function setUp(): void {
        // Setup test database
        $this->CI = &get_instance();
        $this->CI->load->model('model_kategori');
    }
    
    public function test_get_all_categories() {
        $categories = $this->CI->model_kategori->dapatkan_kategori_lowongan();
        $this->assertIsArray($categories);
    }
    
    public function test_create_category() {
        $data = [
            'nama' => 'Test Category',
            'deskripsi' => 'Test Description'
        ];
        
        $id = $this->CI->model_kategori->tambah_kategori_lowongan($data);
        $this->assertIsNumeric($id);
        $this->assertGreaterThan(0, $id);
    }
}</code></pre>
                </div>
              </div>
            </div>
            
            <hr class="horizontal dark">
            
            <h5 class="text-gradient text-success mb-3">🔍 Security Testing</h5>
            
            <div class="row">
              <div class="col-md-6">
                <div class="card mb-4">
                  <div class="card-header pb-0">
                    <h6 class="text-sm">🛡️ Input Validation</h6>
                  </div>
                  <div class="card-body">
                    <ul class="text-sm">
                      <li>XSS prevention testing</li>
                      <li>SQL injection attempts</li>
                      <li>CSRF token validation</li>
                      <li>File upload security</li>
                      <li>Input sanitization</li>
                      <li>Form validation bypass</li>
                    </ul>
                  </div>
                </div>
              </div>
              
              <div class="col-md-6">
                <div class="card mb-4">
                  <div class="card-header pb-0">
                    <h6 class="text-sm">🔐 Authentication Security</h6>
                  </div>
                  <div class="card-body">
                    <ul class="text-sm">
                      <li>Password strength requirements</li>
                      <li>Session hijacking prevention</li>
                      <li>Brute force protection</li>
                      <li>Account lockout mechanism</li>
                      <li>Secure password reset</li>
                      <li>Two-factor authentication</li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            
            <hr class="horizontal dark">
            
            <h5 class="text-gradient text-success mb-3">📱 Cross-browser & Device Testing</h5>
            
            <div class="row">
              <div class="col-md-4">
                <h6 class="text-sm">Desktop Browsers</h6>
                <ul class="text-sm">
                  <li>✅ Chrome (latest)</li>
                  <li>✅ Firefox (latest)</li>
                  <li>✅ Safari (latest)</li>
                  <li>✅ Edge (latest)</li>
                </ul>
              </div>
              
              <div class="col-md-4">
                <h6 class="text-sm">Mobile Devices</h6>
                <ul class="text-sm">
                  <li>✅ iOS Safari</li>
                  <li>✅ Android Chrome</li>
                  <li>✅ Responsive design</li>
                  <li>✅ Touch interactions</li>
                </ul>
              </div>
              
              <div class="col-md-4">
                <h6 class="text-sm">Screen Resolutions</h6>
                <ul class="text-sm">
                  <li>✅ 1920x1080 (Desktop)</li>
                  <li>✅ 1366x768 (Laptop)</li>
                  <li>✅ 768x1024 (Tablet)</li>
                  <li>✅ 375x667 (Mobile)</li>
                </ul>
              </div>
            </div>
            
            <div class="alert alert-info mt-4">
              <strong>🎯 Testing Best Practices:</strong>
              <ul class="mb-0">
                <li><strong>Test Early & Often:</strong> Implement testing dari awal development</li>
                <li><strong>Automate Repetitive Tests:</strong> Gunakan automated testing untuk regression</li>
                <li><strong>Test Real Scenarios:</strong> Test dengan data dan workflow yang realistic</li>
                <li><strong>Document Test Cases:</strong> Maintain test documentation yang up-to-date</li>
                <li><strong>Performance Testing:</strong> Test dengan load yang realistic</li>
                <li><strong>Security First:</strong> Prioritize security testing di setiap feature</li>
              </ul>
            </div>
            
          </div>
        </div>
        
      </div>
    </div>
  </div>
</div>
