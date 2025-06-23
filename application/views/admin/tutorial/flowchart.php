<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header pb-0">
        <div class="d-flex align-items-center">
          <div class="icon icon-shape icon-sm bg-gradient-info shadow text-center border-radius-md me-3">
            <i class="ni ni-vector text-white opacity-10"></i>
          </div>
          <div>
            <h6 class="mb-0">Interactive Flowcharts</h6>
            <p class="text-sm mb-0">Visual representation of SIREK system processes and workflows</p>
          </div>
        </div>
      </div>
      <div class="card-body">

        <!-- Flowchart Navigation -->
        <div class="row mb-4">
          <div class="col-12">
            <div class="nav-wrapper position-relative">
              <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="flowchart-tabs" role="tablist">
                <li class="nav-item" role="presentation">
                  <a class="nav-link mb-0 px-0 py-1 active" id="development-tab" data-bs-toggle="tab" href="#development-flow" role="tab" aria-controls="development-flow" aria-selected="true">
                    <i class="ni ni-laptop"></i>
                    <span class="ms-1">Development Workflow</span>
                  </a>
                </li>
                <li class="nav-item" role="presentation">
                  <a class="nav-link mb-0 px-0 py-1" id="crud-tab" data-bs-toggle="tab" href="#crud-flow" role="tab" aria-controls="crud-flow" aria-selected="false">
                    <i class="ni ni-app"></i>
                    <span class="ms-1">CRUD Operations</span>
                  </a>
                </li>
                <li class="nav-item" role="presentation">
                  <a class="nav-link mb-0 px-0 py-1" id="auth-tab" data-bs-toggle="tab" href="#auth-flow" role="tab" aria-controls="auth-flow" aria-selected="false">
                    <i class="ni ni-lock-circle-open"></i>
                    <span class="ms-1">Authentication</span>
                  </a>
                </li>
                <li class="nav-item" role="presentation">
                  <a class="nav-link mb-0 px-0 py-1" id="application-tab" data-bs-toggle="tab" href="#application-flow" role="tab" aria-controls="application-flow" aria-selected="false">
                    <i class="ni ni-briefcase-24"></i>
                    <span class="ms-1">Application Process</span>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>

        <!-- Flowchart Content -->
        <div class="tab-content" id="flowchart-content">

          <!-- Development Workflow -->
          <div class="tab-pane fade show active" id="development-flow" role="tabpanel" aria-labelledby="development-tab">
            <div class="row">
              <div class="col-md-8">
                <div class="card">
                  <div class="card-header pb-0">
                    <h6 class="text-sm">🔄 Development Workflow</h6>
                  </div>
                  <div class="card-body">
                    <div id="development-flowchart" class="flowchart-container">
                      <!-- Development flowchart will be rendered here -->
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="card">
                  <div class="card-header pb-0">
                    <h6 class="text-sm">📋 Step Details</h6>
                  </div>
                  <div class="card-body">
                    <div id="development-details" class="step-details">
                      <div class="text-center text-muted">
                        <i class="ni ni-bulb-61 text-warning" style="font-size: 2rem;"></i>
                        <p class="mt-2">Click on any step in the flowchart to see detailed information</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- CRUD Operations -->
          <div class="tab-pane fade" id="crud-flow" role="tabpanel" aria-labelledby="crud-tab">
            <div class="row">
              <div class="col-md-8">
                <div class="card">
                  <div class="card-header pb-0">
                    <h6 class="text-sm">🗃️ CRUD Operations Flow</h6>
                  </div>
                  <div class="card-body">
                    <div id="crud-flowchart" class="flowchart-container">
                      <!-- CRUD flowchart will be rendered here -->
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="card">
                  <div class="card-header pb-0">
                    <h6 class="text-sm">📋 Operation Details</h6>
                  </div>
                  <div class="card-body">
                    <div id="crud-details" class="step-details">
                      <div class="text-center text-muted">
                        <i class="ni ni-bulb-61 text-warning" style="font-size: 2rem;"></i>
                        <p class="mt-2">Click on any operation to see implementation details</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Authentication Flow -->
          <div class="tab-pane fade" id="auth-flow" role="tabpanel" aria-labelledby="auth-tab">
            <div class="row">
              <div class="col-md-8">
                <div class="card">
                  <div class="card-header pb-0">
                    <h6 class="text-sm">🔐 Authentication Flow</h6>
                  </div>
                  <div class="card-body">
                    <div id="auth-flowchart" class="flowchart-container">
                      <!-- Auth flowchart will be rendered here -->
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="card">
                  <div class="card-header pb-0">
                    <h6 class="text-sm">📋 Security Details</h6>
                  </div>
                  <div class="card-body">
                    <div id="auth-details" class="step-details">
                      <div class="text-center text-muted">
                        <i class="ni ni-bulb-61 text-warning" style="font-size: 2rem;"></i>
                        <p class="mt-2">Click on any step to see security implementation details</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Application Process -->
          <div class="tab-pane fade" id="application-flow" role="tabpanel" aria-labelledby="application-tab">
            <div class="row">
              <div class="col-md-8">
                <div class="card">
                  <div class="card-header pb-0">
                    <h6 class="text-sm">💼 Application Process Flow</h6>
                  </div>
                  <div class="card-body">
                    <div id="application-flowchart" class="flowchart-container">
                      <!-- Application flowchart will be rendered here -->
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="card">
                  <div class="card-header pb-0">
                    <h6 class="text-sm">📋 Process Details</h6>
                  </div>
                  <div class="card-body">
                    <div id="application-details" class="step-details">
                      <div class="text-center text-muted">
                        <i class="ni ni-bulb-61 text-warning" style="font-size: 2rem;"></i>
                        <p class="mt-2">Click on any stage to see process details</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>

      </div>
    </div>
  </div>
</div>

<!-- Flowchart Styles -->
<style>
.flowchart-container {
  min-height: 500px;
  background: #f8f9fa;
  border-radius: 0.5rem;
  padding: 1rem;
  position: relative;
  overflow-x: auto;
}

.flowchart-node {
  background: white;
  border: 2px solid #e9ecef;
  border-radius: 0.5rem;
  padding: 0.75rem 1rem;
  margin: 0.5rem;
  cursor: pointer;
  transition: all 0.3s ease;
  position: relative;
  display: inline-block;
  min-width: 120px;
  text-align: center;
  box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.flowchart-node:hover {
  transform: translateY(-2px);
  box-shadow: 0 4px 8px rgba(0,0,0,0.15);
  border-color: #5e72e4;
}

.flowchart-node.active {
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  color: white;
  border-color: #667eea;
}

.flowchart-node.start {
  background: linear-gradient(135deg, #11cdef 0%, #1171ef 100%);
  color: white;
  border-color: #11cdef;
}

.flowchart-node.end {
  background: linear-gradient(135deg, #2dce89 0%, #2dcecc 100%);
  color: white;
  border-color: #2dce89;
}

.flowchart-node.decision {
  background: linear-gradient(135deg, #fb6340 0%, #fbb140 100%);
  color: white;
  border-color: #fb6340;
  transform: rotate(45deg);
  margin: 1rem;
}

.flowchart-node.decision .node-content {
  transform: rotate(-45deg);
}

.flowchart-arrow {
  position: absolute;
  width: 2px;
  background: #6c757d;
  z-index: 1;
}

.flowchart-arrow::after {
  content: '';
  position: absolute;
  bottom: -5px;
  left: -3px;
  width: 0;
  height: 0;
  border-left: 4px solid transparent;
  border-right: 4px solid transparent;
  border-top: 8px solid #6c757d;
}

.flowchart-row {
  display: flex;
  justify-content: center;
  align-items: center;
  margin: 1rem 0;
  flex-wrap: wrap;
}

.flowchart-connector {
  width: 50px;
  height: 2px;
  background: #6c757d;
  margin: 0 1rem;
  position: relative;
}

.flowchart-connector::after {
  content: '';
  position: absolute;
  right: -5px;
  top: -3px;
  width: 0;
  height: 0;
  border-left: 8px solid #6c757d;
  border-top: 4px solid transparent;
  border-bottom: 4px solid transparent;
}

.step-details {
  max-height: 500px;
  overflow-y: auto;
}

.step-detail-card {
  background: #f8f9fa;
  border-radius: 0.5rem;
  padding: 1rem;
  margin-bottom: 1rem;
}

.step-detail-card h6 {
  color: #5e72e4;
  margin-bottom: 0.5rem;
}

.code-snippet {
  background: #2d3748;
  color: #e2e8f0;
  padding: 0.75rem;
  border-radius: 0.375rem;
  font-family: 'Courier New', monospace;
  font-size: 0.875rem;
  margin: 0.5rem 0;
  overflow-x: auto;
}

@media (max-width: 768px) {
  .flowchart-row {
    flex-direction: column;
  }

  .flowchart-connector {
    width: 2px;
    height: 30px;
    margin: 0.5rem 0;
    transform: rotate(90deg);
  }

  .flowchart-node {
    margin: 0.25rem;
    min-width: 100px;
  }
}
</style>

<!-- Flowchart JavaScript -->
<script>
// Flowchart Data Definitions
const flowchartData = {
  development: {
    title: 'SIREK Development Workflow',
    nodes: [
      {
        id: 'planning',
        title: 'Planning & Analysis',
        type: 'start',
        description: 'Requirements gathering and system analysis',
        details: {
          title: '📋 Planning & Analysis Phase',
          content: 'This phase involves understanding business requirements, analyzing user needs, and creating technical specifications.',
          steps: [
            'Gather business requirements',
            'Analyze user stories',
            'Create technical specifications',
            'Design database schema',
            'Plan development timeline'
          ],
          code: '// Example: Requirements documentation\n' +
                'const requirements = {\n' +
                '  functional: ["User authentication", "Job posting", "Application management"],\n' +
                '  nonFunctional: ["Performance", "Security", "Scalability"]\n' +
                '};'
        }
      },
      {
        id: 'design',
        title: 'System Design',
        type: 'normal',
        description: 'Architecture and UI/UX design',
        details: {
          title: '🎨 System Design Phase',
          content: 'Creating system architecture, database design, and user interface mockups.',
          steps: [
            'Design system architecture',
            'Create database ERD',
            'Design UI/UX mockups',
            'Define API endpoints',
            'Plan security measures'
          ],
          code: '// Example: Database design\n' +
                'CREATE TABLE users (\n' +
                '  id INT PRIMARY KEY AUTO_INCREMENT,\n' +
                '  email VARCHAR(255) UNIQUE,\n' +
                '  role ENUM("admin", "recruiter", "applicant")\n' +
                ');'
        }
      },
      {
        id: 'development',
        title: 'Development',
        type: 'normal',
        description: 'Coding and implementation',
        details: {
          title: '💻 Development Phase',
          content: 'Implementation of features using CodeIgniter 3 framework following MVC pattern.',
          steps: [
            'Setup development environment',
            'Create database tables',
            'Implement models',
            'Build controllers',
            'Design views',
            'Integrate frontend'
          ],
          code: '// Example: Controller implementation\n' +
                'class Admin extends CI_Controller {\n' +
                '  public function __construct() {\n' +
                '    parent::__construct();\n' +
                '    $this->load->model("model_user");\n' +
                '  }\n' +
                '}'
        }
      },
      {
        id: 'testing',
        title: 'Testing',
        type: 'normal',
        description: 'Quality assurance and testing',
        details: {
          title: '🧪 Testing Phase',
          content: 'Comprehensive testing to ensure system reliability and security.',
          steps: [
            'Unit testing',
            'Integration testing',
            'Security testing',
            'Performance testing',
            'User acceptance testing'
          ],
          code: '// Example: PHPUnit test\n' +
                'class UserTest extends PHPUnit\\Framework\\TestCase {\n' +
                '  public function testUserLogin() {\n' +
                '    $result = $this->auth->login("test@example.com", "password");\n' +
                '    $this->assertTrue($result);\n' +
                '  }\n' +
                '}'
        }
      },
      {
        id: 'deployment',
        title: 'Deployment',
        type: 'end',
        description: 'Production deployment and monitoring',
        details: {
          title: '🚀 Deployment Phase',
          content: 'Deploying the application to production environment with proper monitoring.',
          steps: [
            'Prepare production environment',
            'Configure web server',
            'Deploy application files',
            'Setup database',
            'Configure monitoring',
            'Go live'
          ],
          code: '// Example: Production config\n' +
                'define("ENVIRONMENT", "production");\n' +
                '$config["base_url"] = "https://sirek.example.com/";\n' +
                '$config["log_threshold"] = 1;'
        }
      }
    ],
    connections: [
      { from: 'planning', to: 'design' },
      { from: 'design', to: 'development' },
      { from: 'development', to: 'testing' },
      { from: 'testing', to: 'deployment' }
    ]
  },

  crud: {
    title: 'CRUD Operations Flow',
    nodes: [
      {
        id: 'request',
        title: 'HTTP Request',
        type: 'start',
        description: 'User initiates CRUD operation',
        details: {
          title: '🌐 HTTP Request',
          content: 'User sends HTTP request to perform CRUD operation through web interface.',
          steps: [
            'User clicks button/submits form',
            'Browser sends HTTP request',
            'Request routed to controller',
            'Controller method called'
          ],
          code: '// Example: Form submission\n' +
                '&lt;form method="POST" action="&lt;?= base_url("admin/create_job") ?&gt;"&gt;\n' +
                '  &lt;input type="text" name="title" required&gt;\n' +
                '  &lt;button type="submit"&gt;Create Job&lt;/button&gt;\n' +
                '&lt;/form&gt;'
        }
      },
      {
        id: 'validation',
        title: 'Input Validation',
        type: 'decision',
        description: 'Validate user input',
        details: {
          title: '✅ Input Validation',
          content: 'Server-side validation ensures data integrity and security.',
          steps: [
            'Check required fields',
            'Validate data types',
            'Check business rules',
            'Sanitize input data'
          ],
          code: '// Example: CodeIgniter validation\n' +
                '$this->form_validation->set_rules("title", "Job Title", "required|min_length[3]");\n' +
                '$this->form_validation->set_rules("email", "Email", "required|valid_email");\n' +
                'if ($this->form_validation->run() == FALSE) {\n' +
                '  // Show validation errors\n' +
                '}'
        }
      },
      {
        id: 'model',
        title: 'Model Operation',
        type: 'normal',
        description: 'Database interaction through model',
        details: {
          title: '🗃️ Model Operation',
          content: 'Model handles database operations using CodeIgniter Active Record.',
          steps: [
            'Load appropriate model',
            'Call model method',
            'Execute database query',
            'Return result'
          ],
          code: '// Example: Model method\n' +
                'public function create_job($data) {\n' +
                '  $this->db->insert("jobs", $data);\n' +
                '  return $this->db->insert_id();\n' +
                '}\n\n' +
                '// Controller usage\n' +
                '$job_id = $this->model_job->create_job($data);'
        }
      },
      {
        id: 'response',
        title: 'HTTP Response',
        type: 'end',
        description: 'Return result to user',
        details: {
          title: '📤 HTTP Response',
          content: 'System returns appropriate response with success/error message.',
          steps: [
            'Process operation result',
            'Set flash message',
            'Redirect or reload view',
            'Display feedback to user'
          ],
          code: '// Example: Response handling\n' +
                'if ($result) {\n' +
                '  $this->session->set_flashdata("success", "Job created successfully");\n' +
                '  redirect("admin/jobs");\n' +
                '} else {\n' +
                '  $this->session->set_flashdata("error", "Failed to create job");\n' +
                '}'
        }
      }
    ],
    connections: [
      { from: 'request', to: 'validation' },
      { from: 'validation', to: 'model', condition: 'Valid' },
      { from: 'validation', to: 'response', condition: 'Invalid' },
      { from: 'model', to: 'response' }
    ]
  }
};

// Initialize flowcharts when page loads
document.addEventListener('DOMContentLoaded', function() {
  renderFlowchart('development', 'development-flowchart', 'development-details');
  renderFlowchart('crud', 'crud-flowchart', 'crud-details');

  // Initialize other flowcharts when tabs are clicked
  document.getElementById('auth-tab').addEventListener('click', function() {
    setTimeout(() => renderAuthFlowchart(), 100);
  });

  document.getElementById('application-tab').addEventListener('click', function() {
    setTimeout(() => renderApplicationFlowchart(), 100);
  });
});

function renderFlowchart(type, containerId, detailsId) {
  const container = document.getElementById(containerId);
  const data = flowchartData[type];

  if (!container || !data) return;

  let html = '&lt;div class="text-center mb-3"&gt;&lt;h6 class="text-primary"&gt;' + data.title + '&lt;/h6&gt;&lt;/div&gt;';

  // Render nodes in rows
  const nodesPerRow = Math.ceil(Math.sqrt(data.nodes.length));
  for (let i = 0; i < data.nodes.length; i += nodesPerRow) {
    html += '&lt;div class="flowchart-row"&gt;';

    const rowNodes = data.nodes.slice(i, i + nodesPerRow);
    rowNodes.forEach((node, index) => {
      html += '&lt;div class="flowchart-node ' + node.type + '" data-node="' + node.id + '" data-type="' + type + '"&gt;';
      html += '  &lt;div class="node-content"&gt;';
      html += '    &lt;strong&gt;' + node.title + '&lt;/strong&gt;';
      html += '    &lt;br&gt;&lt;small&gt;' + node.description + '&lt;/small&gt;';
      html += '  &lt;/div&gt;';
      html += '&lt;/div&gt;';

      // Add connector if not last in row
      if (index < rowNodes.length - 1) {
        html += '&lt;div class="flowchart-connector"&gt;&lt;/div&gt;';
      }
    });

    html += '&lt;/div&gt;';

    // Add vertical connector if not last row
    if (i + nodesPerRow < data.nodes.length) {
      html += '&lt;div class="d-flex justify-content-center"&gt;&lt;div class="flowchart-connector" style="transform: rotate(90deg); margin: 1rem 0;"&gt;&lt;/div&gt;&lt;/div&gt;';
    }
  }

  container.innerHTML = html;

  // Add click handlers
  container.querySelectorAll('.flowchart-node').forEach(node => {
    node.addEventListener('click', function() {
      const nodeId = this.getAttribute('data-node');
      const flowType = this.getAttribute('data-type');
      showNodeDetails(flowType, nodeId, detailsId);

      // Update active state
      container.querySelectorAll('.flowchart-node').forEach(n => n.classList.remove('active'));
      this.classList.add('active');
    });
  });
}

function showNodeDetails(flowType, nodeId, detailsId) {
  const data = flowchartData[flowType];
  const node = data.nodes.find(n => n.id === nodeId);
  const detailsContainer = document.getElementById(detailsId);

  if (!node || !detailsContainer) return;

  let html = '&lt;div class="step-detail-card"&gt;';
  html += '  &lt;h6&gt;' + node.details.title + '&lt;/h6&gt;';
  html += '  &lt;p&gt;' + node.details.content + '&lt;/p&gt;';

  if (node.details.steps) {
    html += '  &lt;h6 class="mt-3"&gt;Steps:&lt;/h6&gt;';
    html += '  &lt;ol&gt;';
    node.details.steps.forEach(step => {
      html += '    &lt;li&gt;' + step + '&lt;/li&gt;';
    });
    html += '  &lt;/ol&gt;';
  }

  if (node.details.code) {
    html += '  &lt;h6 class="mt-3"&gt;Code Example:&lt;/h6&gt;';
    html += '  &lt;div class="code-snippet"&gt;' + node.details.code + '&lt;/div&gt;';
  }

  html += '&lt;/div&gt;';

  detailsContainer.innerHTML = html;
}

// Authentication Flowchart
function renderAuthFlowchart() {
  const container = document.getElementById('auth-flowchart');
  const detailsContainer = document.getElementById('auth-details');

  if (!container) return;

  const authData = {
    title: 'SIREK Authentication Flow',
    nodes: [
      {
        id: 'login_form',
        title: 'Login Form',
        type: 'start',
        description: 'User enters credentials',
        details: {
          title: '🔐 Login Form',
          content: 'User interface for entering login credentials with proper validation.',
          steps: [
            'Display login form',
            'User enters email/password',
            'Client-side validation',
            'Form submission'
          ],
          code: '// Login form HTML\n' +
                '&lt;form method="POST" action="&lt;?= base_url("auth/login") ?&gt;"&gt;\n' +
                '  &lt;input type="email" name="email" required&gt;\n' +
                '  &lt;input type="password" name="password" required&gt;\n' +
                '  &lt;button type="submit"&gt;Login&lt;/button&gt;\n' +
                '&lt;/form&gt;'
        }
      },
      {
        id: 'validate_input',
        title: 'Validate Input',
        type: 'decision',
        description: 'Server-side validation',
        details: {
          title: '✅ Input Validation',
          content: 'Server validates submitted credentials for security and data integrity.',
          steps: [
            'Check required fields',
            'Validate email format',
            'Check password strength',
            'Sanitize input data'
          ],
          code: '// Validation in controller\n' +
                '$this->form_validation->set_rules("email", "Email", "required|valid_email");\n' +
                '$this->form_validation->set_rules("password", "Password", "required|min_length[6]");\n' +
                'if ($this->form_validation->run() == FALSE) {\n' +
                '  $this->load->view("auth/login");\n' +
                '}'
        }
      },
      {
        id: 'check_credentials',
        title: 'Check Credentials',
        type: 'normal',
        description: 'Verify against database',
        details: {
          title: '🔍 Credential Verification',
          content: 'System checks provided credentials against stored user data in database.',
          steps: [
            'Query user by email',
            'Verify password hash',
            'Check account status',
            'Validate user role'
          ],
          code: '// Model method for authentication\n' +
                'public function authenticate($email, $password) {\n' +
                '  $user = $this->db->where("email", $email)->get("users")->row();\n' +
                '  if ($user && password_verify($password, $user->password)) {\n' +
                '    return $user;\n' +
                '  }\n' +
                '  return false;\n' +
                '}'
        }
      },
      {
        id: 'create_session',
        title: 'Create Session',
        type: 'normal',
        description: 'Establish user session',
        details: {
          title: '🎫 Session Management',
          content: 'Create secure session for authenticated user with appropriate permissions.',
          steps: [
            'Generate session ID',
            'Store user data in session',
            'Set session timeout',
            'Create security tokens'
          ],
          code: '// Session creation\n' +
                '$session_data = array(\n' +
                '  "user_id" => $user->id,\n' +
                '  "email" => $user->email,\n' +
                '  "role" => $user->role,\n' +
                '  "logged_in" => TRUE\n' +
                ');\n' +
                '$this->session->set_userdata($session_data);'
        }
      },
      {
        id: 'redirect_dashboard',
        title: 'Redirect to Dashboard',
        type: 'end',
        description: 'Access granted',
        details: {
          title: '🏠 Dashboard Access',
          content: 'User successfully authenticated and redirected to appropriate dashboard.',
          steps: [
            'Set success message',
            'Determine redirect URL',
            'Log login activity',
            'Redirect to dashboard'
          ],
          code: '// Successful login redirect\n' +
                '$this->session->set_flashdata("success", "Login successful");\n' +
                'if ($user->role == "admin") {\n' +
                '  redirect("admin/dashboard");\n' +
                '} else {\n' +
                '  redirect("user/dashboard");\n' +
                '}'
        }
      },
      {
        id: 'login_failed',
        title: 'Login Failed',
        type: 'end',
        description: 'Access denied',
        details: {
          title: '❌ Authentication Failed',
          content: 'Invalid credentials provided, access denied with appropriate error message.',
          steps: [
            'Log failed attempt',
            'Set error message',
            'Increment failure count',
            'Return to login form'
          ],
          code: '// Failed login handling\n' +
                '$this->session->set_flashdata("error", "Invalid email or password");\n' +
                'log_message("info", "Failed login attempt for: " . $email);\n' +
                'redirect("auth/login");'
        }
      }
    ]
  };

  renderCustomFlowchart(authData, container, detailsContainer, 'auth');
}

// Application Process Flowchart
function renderApplicationFlowchart() {
  const container = document.getElementById('application-flowchart');
  const detailsContainer = document.getElementById('application-details');

  if (!container) return;

  const appData = {
    title: 'Job Application Process Flow',
    nodes: [
      {
        id: 'job_posted',
        title: 'Job Posted',
        type: 'start',
        description: 'New job opportunity published',
        details: {
          title: '📢 Job Posted',
          content: 'HR team publishes new job opening with detailed requirements and qualifications.',
          steps: [
            'Create job posting',
            'Set requirements',
            'Define deadline',
            'Publish to portal'
          ],
          code: '// Job posting creation\n' +
                '$job_data = array(\n' +
                '  "title" => "Software Developer",\n' +
                '  "description" => "Job description...",\n' +
                '  "requirements" => "Requirements...",\n' +
                '  "deadline" => "2024-12-31",\n' +
                '  "status" => "active"\n' +
                ');'
        }
      },
      {
        id: 'application_submitted',
        title: 'Application Submitted',
        type: 'normal',
        description: 'Candidate applies for position',
        details: {
          title: '📝 Application Submitted',
          content: 'Job seeker submits application with required documents and information.',
          steps: [
            'Fill application form',
            'Upload CV/Resume',
            'Upload cover letter',
            'Submit application'
          ],
          code: '// Application submission\n' +
                '$application_data = array(\n' +
                '  "job_id" => $job_id,\n' +
                '  "applicant_name" => $name,\n' +
                '  "email" => $email,\n' +
                '  "cv_file" => $cv_path,\n' +
                '  "status" => "submitted",\n' +
                '  "applied_at" => date("Y-m-d H:i:s")\n' +
                ');'
        }
      },
      {
        id: 'initial_review',
        title: 'Initial Review',
        type: 'decision',
        description: 'HR reviews application',
        details: {
          title: '👀 Initial Review',
          content: 'HR team conducts initial screening of application and documents.',
          steps: [
            'Review application form',
            'Check CV/Resume',
            'Verify qualifications',
            'Make initial decision'
          ],
          code: '// Update application status\n' +
                '$this->db->where("id", $application_id);\n' +
                '$this->db->update("applications", array(\n' +
                '  "status" => "under_review",\n' +
                '  "reviewed_by" => $hr_id,\n' +
                '  "reviewed_at" => date("Y-m-d H:i:s")\n' +
                '));'
        }
      },
      {
        id: 'interview_scheduled',
        title: 'Interview Scheduled',
        type: 'normal',
        description: 'Candidate invited for interview',
        details: {
          title: '📅 Interview Scheduled',
          content: 'Qualified candidates are invited for interview process.',
          steps: [
            'Schedule interview',
            'Send invitation email',
            'Prepare interview questions',
            'Set interview panel'
          ],
          code: '// Schedule interview\n' +
                '$interview_data = array(\n' +
                '  "application_id" => $app_id,\n' +
                '  "interview_date" => $date,\n' +
                '  "interview_time" => $time,\n' +
                '  "interviewer_id" => $interviewer_id,\n' +
                '  "status" => "scheduled"\n' +
                ');'
        }
      },
      {
        id: 'interview_conducted',
        title: 'Interview Conducted',
        type: 'normal',
        description: 'Interview process completed',
        details: {
          title: '🎤 Interview Conducted',
          content: 'Interview panel evaluates candidate through structured interview process.',
          steps: [
            'Conduct interview',
            'Evaluate responses',
            'Score candidate',
            'Document feedback'
          ],
          code: '// Interview evaluation\n' +
                '$evaluation = array(\n' +
                '  "technical_score" => $tech_score,\n' +
                '  "communication_score" => $comm_score,\n' +
                '  "overall_score" => $overall,\n' +
                '  "feedback" => $feedback,\n' +
                '  "recommendation" => $recommendation\n' +
                ');'
        }
      },
      {
        id: 'final_decision',
        title: 'Final Decision',
        type: 'decision',
        description: 'Accept or reject candidate',
        details: {
          title: '⚖️ Final Decision',
          content: 'Management makes final hiring decision based on interview evaluation.',
          steps: [
            'Review interview scores',
            'Consider team fit',
            'Check references',
            'Make final decision'
          ],
          code: '// Final decision update\n' +
                'if ($overall_score >= $passing_score) {\n' +
                '  $status = "accepted";\n' +
                '  $this->sendOfferLetter($application_id);\n' +
                '} else {\n' +
                '  $status = "rejected";\n' +
                '  $this->sendRejectionEmail($application_id);\n' +
                '}'
        }
      },
      {
        id: 'offer_sent',
        title: 'Offer Sent',
        type: 'end',
        description: 'Job offer extended',
        details: {
          title: '🎉 Offer Sent',
          content: 'Successful candidate receives job offer with terms and conditions.',
          steps: [
            'Prepare offer letter',
            'Include salary details',
            'Set start date',
            'Send official offer'
          ],
          code: '// Send offer letter\n' +
                '$offer_data = array(\n' +
                '  "salary" => $salary,\n' +
                '  "start_date" => $start_date,\n' +
                '  "benefits" => $benefits,\n' +
                '  "offer_expires" => $expiry_date\n' +
                ');\n' +
                '$this->email->send_offer_letter($offer_data);'
        }
      },
      {
        id: 'application_rejected',
        title: 'Application Rejected',
        type: 'end',
        description: 'Application unsuccessful',
        details: {
          title: '❌ Application Rejected',
          content: 'Candidate informed of unsuccessful application with feedback.',
          steps: [
            'Prepare rejection email',
            'Include feedback',
            'Thank for interest',
            'Send notification'
          ],
          code: '// Send rejection email\n' +
                '$rejection_data = array(\n' +
                '  "reason" => $rejection_reason,\n' +
                '  "feedback" => $constructive_feedback,\n' +
                '  "future_opportunities" => true\n' +
                ');\n' +
                '$this->email->send_rejection_email($rejection_data);'
        }
      }
    ]
  };

  renderCustomFlowchart(appData, container, detailsContainer, 'application');
}

function renderCustomFlowchart(data, container, detailsContainer, type) {
  let html = '&lt;div class="text-center mb-3"&gt;&lt;h6 class="text-primary"&gt;' + data.title + '&lt;/h6&gt;&lt;/div&gt;';

  // Render nodes in a more complex flow
  if (type === 'auth') {
    // Linear flow for authentication
    html += '&lt;div class="flowchart-row"&gt;';
    data.nodes.slice(0, 3).forEach((node, index) => {
      html += '&lt;div class="flowchart-node ' + node.type + '" data-node="' + node.id + '" data-type="' + type + '"&gt;';
      html += '  &lt;div class="node-content"&gt;&lt;strong&gt;' + node.title + '&lt;/strong&gt;&lt;br&gt;&lt;small&gt;' + node.description + '&lt;/small&gt;&lt;/div&gt;';
      html += '&lt;/div&gt;';
      if (index < 2) html += '&lt;div class="flowchart-connector"&gt;&lt;/div&gt;';
    });
    html += '&lt;/div&gt;';

    // Decision branches
    html += '&lt;div class="d-flex justify-content-center"&gt;&lt;div class="flowchart-connector" style="transform: rotate(90deg); margin: 1rem 0;"&gt;&lt;/div&gt;&lt;/div&gt;';
    html += '&lt;div class="flowchart-row"&gt;';
    data.nodes.slice(3).forEach((node, index) => {
      html += '&lt;div class="flowchart-node ' + node.type + '" data-node="' + node.id + '" data-type="' + type + '"&gt;';
      html += '  &lt;div class="node-content"&gt;&lt;strong&gt;' + node.title + '&lt;/strong&gt;&lt;br&gt;&lt;small&gt;' + node.description + '&lt;/small&gt;&lt;/div&gt;';
      html += '&lt;/div&gt;';
      if (index === 0) html += '&lt;div style="width: 100px;"&gt;&lt;/div&gt;';
    });
    html += '&lt;/div&gt;';
  } else {
    // Complex flow for application process
    const rows = [
      [0, 1], // Job posted, Application submitted
      [2], // Initial review
      [3, 4], // Interview scheduled, conducted
      [5], // Final decision
      [6, 7] // Offer sent, Rejected
    ];

    rows.forEach((rowIndices, rowIndex) => {
      html += '&lt;div class="flowchart-row"&gt;';
      rowIndices.forEach((nodeIndex, index) => {
        const node = data.nodes[nodeIndex];
        html += '&lt;div class="flowchart-node ' + node.type + '" data-node="' + node.id + '" data-type="' + type + '"&gt;';
        html += '  &lt;div class="node-content"&gt;&lt;strong&gt;' + node.title + '&lt;/strong&gt;&lt;br&gt;&lt;small&gt;' + node.description + '&lt;/small&gt;&lt;/div&gt;';
        html += '&lt;/div&gt;';
        if (index < rowIndices.length - 1) html += '&lt;div class="flowchart-connector"&gt;&lt;/div&gt;';
      });
      html += '&lt;/div&gt;';

      if (rowIndex < rows.length - 1) {
        html += '&lt;div class="d-flex justify-content-center"&gt;&lt;div class="flowchart-connector" style="transform: rotate(90deg); margin: 1rem 0;"&gt;&lt;/div&gt;&lt;/div&gt;';
      }
    });
  }

  container.innerHTML = html;

  // Add click handlers
  container.querySelectorAll('.flowchart-node').forEach(node => {
    node.addEventListener('click', function() {
      const nodeId = this.getAttribute('data-node');
      const flowType = this.getAttribute('data-type');
      const nodeData = data.nodes.find(n => n.id === nodeId);

      if (nodeData) {
        showCustomNodeDetails(nodeData, detailsContainer);
      }

      // Update active state
      container.querySelectorAll('.flowchart-node').forEach(n => n.classList.remove('active'));
      this.classList.add('active');
    });
  });
}

function showCustomNodeDetails(node, detailsContainer) {
  let html = '&lt;div class="step-detail-card"&gt;';
  html += '  &lt;h6&gt;' + node.details.title + '&lt;/h6&gt;';
  html += '  &lt;p&gt;' + node.details.content + '&lt;/p&gt;';

  if (node.details.steps) {
    html += '  &lt;h6 class="mt-3"&gt;Steps:&lt;/h6&gt;';
    html += '  &lt;ol&gt;';
    node.details.steps.forEach(step => {
      html += '    &lt;li&gt;' + step + '&lt;/li&gt;';
    });
    html += '  &lt;/ol&gt;';
  }

  if (node.details.code) {
    html += '  &lt;h6 class="mt-3"&gt;Code Example:&lt;/h6&gt;';
    html += '  &lt;div class="code-snippet"&gt;' + node.details.code + '&lt;/div&gt;';
  }

  html += '&lt;/div&gt;';

  detailsContainer.innerHTML = html;
}
</script>
