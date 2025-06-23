<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header pb-0">
        <div class="d-flex align-items-center">
          <div class="icon icon-shape icon-sm bg-gradient-warning shadow text-center border-radius-md me-3">
            <i class="ni ni-world-2 text-white opacity-10"></i>
          </div>
          <div>
            <h6 class="mb-0">API Documentation</h6>
            <p class="text-sm mb-0">REST API endpoints dan cara penggunaannya</p>
          </div>
        </div>
      </div>
      <div class="card-body">
        
        <div class="row">
          <div class="col-12">
            <div class="alert alert-info">
              <strong>📡 SIREK API Overview</strong><br>
              SIREK menyediakan REST API untuk integrasi dengan aplikasi eksternal. API menggunakan JSON format dan autentikasi token.
            </div>
            
            <h5 class="text-gradient text-warning mb-3">🔐 Authentication</h5>
            
            <div class="card mb-4">
              <div class="card-header pb-0">
                <h6 class="text-sm">Login & Get Token</h6>
              </div>
              <div class="card-body">
                <div class="bg-gray-100 border-radius-lg p-3 mb-3">
                  <strong>POST</strong> <code>/api/auth/login</code>
                </div>
                
                <h6 class="text-sm">Request Body:</h6>
                <div class="bg-gray-100 border-radius-lg p-3 mb-3">
                  <pre class="mb-0"><code>{
  "email": "admin@sirek.com",
  "password": "password123"
}</code></pre>
                </div>
                
                <h6 class="text-sm">Response:</h6>
                <div class="bg-gray-100 border-radius-lg p-3 mb-3">
                  <pre class="mb-0"><code>{
  "status": "success",
  "message": "Login successful",
  "data": {
    "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9...",
    "user": {
      "id": 1,
      "name": "Administrator",
      "email": "admin@sirek.com",
      "role": "admin"
    }
  }
}</code></pre>
                </div>
                
                <div class="alert alert-warning">
                  <strong>⚠️ Important:</strong> Include token in Authorization header: <code>Bearer {token}</code>
                </div>
              </div>
            </div>
            
            <hr class="horizontal dark">
            
            <h5 class="text-gradient text-warning mb-3">💼 Jobs API</h5>
            
            <div class="row">
              <div class="col-md-6">
                <div class="card mb-4">
                  <div class="card-header pb-0">
                    <h6 class="text-sm">Get All Jobs</h6>
                  </div>
                  <div class="card-body">
                    <div class="bg-gray-100 border-radius-lg p-3 mb-3">
                      <strong>GET</strong> <code>/api/jobs</code>
                    </div>
                    
                    <h6 class="text-sm">Query Parameters:</h6>
                    <ul class="text-sm">
                      <li><code>page</code> - Page number (default: 1)</li>
                      <li><code>limit</code> - Items per page (default: 10)</li>
                      <li><code>status</code> - Job status (active/inactive)</li>
                      <li><code>category</code> - Category ID</li>
                    </ul>
                    
                    <h6 class="text-sm">Example:</h6>
                    <div class="bg-gray-100 border-radius-lg p-3">
                      <pre class="mb-0"><code>GET /api/jobs?page=1&limit=5&status=active</code></pre>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="col-md-6">
                <div class="card mb-4">
                  <div class="card-header pb-0">
                    <h6 class="text-sm">Get Job by ID</h6>
                  </div>
                  <div class="card-body">
                    <div class="bg-gray-100 border-radius-lg p-3 mb-3">
                      <strong>GET</strong> <code>/api/jobs/{id}</code>
                    </div>
                    
                    <h6 class="text-sm">Response:</h6>
                    <div class="bg-gray-100 border-radius-lg p-3">
                      <pre class="mb-0"><code>{
  "status": "success",
  "data": {
    "id": 1,
    "title": "Software Developer",
    "description": "Job description...",
    "requirements": "Requirements...",
    "salary_min": 5000000,
    "salary_max": 8000000,
    "location": "Jakarta",
    "category": {
      "id": 1,
      "name": "IT & Technology"
    },
    "created_at": "2024-01-15T10:30:00Z"
  }
}</code></pre>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="card mb-4">
              <div class="card-header pb-0">
                <h6 class="text-sm">Create New Job</h6>
              </div>
              <div class="card-body">
                <div class="bg-gray-100 border-radius-lg p-3 mb-3">
                  <strong>POST</strong> <code>/api/jobs</code>
                </div>
                
                <h6 class="text-sm">Request Body:</h6>
                <div class="bg-gray-100 border-radius-lg p-3">
                  <pre class="mb-0"><code>{
  "title": "Frontend Developer",
  "description": "We are looking for a skilled Frontend Developer...",
  "requirements": "- 2+ years experience with React\n- Knowledge of TypeScript",
  "salary_min": 6000000,
  "salary_max": 9000000,
  "location": "Jakarta",
  "category_id": 1,
  "deadline": "2024-12-31",
  "status": "active"
}</code></pre>
                </div>
              </div>
            </div>
            
            <hr class="horizontal dark">
            
            <h5 class="text-gradient text-warning mb-3">📋 Applications API</h5>
            
            <div class="row">
              <div class="col-md-6">
                <div class="card mb-4">
                  <div class="card-header pb-0">
                    <h6 class="text-sm">Get Applications</h6>
                  </div>
                  <div class="card-body">
                    <div class="bg-gray-100 border-radius-lg p-3 mb-3">
                      <strong>GET</strong> <code>/api/applications</code>
                    </div>
                    
                    <h6 class="text-sm">Query Parameters:</h6>
                    <ul class="text-sm">
                      <li><code>job_id</code> - Filter by job ID</li>
                      <li><code>status</code> - Application status</li>
                      <li><code>date_from</code> - Start date (YYYY-MM-DD)</li>
                      <li><code>date_to</code> - End date (YYYY-MM-DD)</li>
                    </ul>
                  </div>
                </div>
              </div>
              
              <div class="col-md-6">
                <div class="card mb-4">
                  <div class="card-header pb-0">
                    <h6 class="text-sm">Update Application Status</h6>
                  </div>
                  <div class="card-body">
                    <div class="bg-gray-100 border-radius-lg p-3 mb-3">
                      <strong>PUT</strong> <code>/api/applications/{id}/status</code>
                    </div>
                    
                    <h6 class="text-sm">Request Body:</h6>
                    <div class="bg-gray-100 border-radius-lg p-3">
                      <pre class="mb-0"><code>{
  "status": "interview",
  "notes": "Scheduled for interview on..."
}</code></pre>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            <hr class="horizontal dark">
            
            <h5 class="text-gradient text-warning mb-3">📊 Statistics API</h5>
            
            <div class="card mb-4">
              <div class="card-header pb-0">
                <h6 class="text-sm">Dashboard Statistics</h6>
              </div>
              <div class="card-body">
                <div class="bg-gray-100 border-radius-lg p-3 mb-3">
                  <strong>GET</strong> <code>/api/stats/dashboard</code>
                </div>
                
                <h6 class="text-sm">Response:</h6>
                <div class="bg-gray-100 border-radius-lg p-3">
                  <pre class="mb-0"><code>{
  "status": "success",
  "data": {
    "total_jobs": 25,
    "active_jobs": 18,
    "total_applications": 150,
    "new_applications": 12,
    "monthly_stats": {
      "1": 10,
      "2": 15,
      "3": 20
    }
  }
}</code></pre>
                </div>
              </div>
            </div>
            
            <hr class="horizontal dark">
            
            <h5 class="text-gradient text-warning mb-3">🔧 Error Handling</h5>
            
            <div class="row">
              <div class="col-md-6">
                <h6 class="text-sm">HTTP Status Codes</h6>
                <ul class="text-sm">
                  <li><code>200</code> - Success</li>
                  <li><code>201</code> - Created</li>
                  <li><code>400</code> - Bad Request</li>
                  <li><code>401</code> - Unauthorized</li>
                  <li><code>403</code> - Forbidden</li>
                  <li><code>404</code> - Not Found</li>
                  <li><code>422</code> - Validation Error</li>
                  <li><code>500</code> - Server Error</li>
                </ul>
              </div>
              
              <div class="col-md-6">
                <h6 class="text-sm">Error Response Format</h6>
                <div class="bg-gray-100 border-radius-lg p-3">
                  <pre class="mb-0"><code>{
  "status": "error",
  "message": "Validation failed",
  "errors": {
    "title": ["Title is required"],
    "email": ["Email format is invalid"]
  }
}</code></pre>
                </div>
              </div>
            </div>
            
            <div class="alert alert-success mt-4">
              <strong>💡 Tips untuk API Usage:</strong>
              <ul class="mb-0">
                <li>Selalu include Content-Type: application/json header</li>
                <li>Gunakan HTTPS untuk production environment</li>
                <li>Implement rate limiting untuk mencegah abuse</li>
                <li>Log semua API requests untuk monitoring</li>
                <li>Gunakan pagination untuk data yang besar</li>
              </ul>
            </div>
            
          </div>
        </div>
        
      </div>
    </div>
  </div>
</div>
