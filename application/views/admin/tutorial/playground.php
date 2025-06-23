<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header pb-0">
        <div class="d-flex align-items-center">
          <div class="icon icon-shape icon-sm bg-gradient-dark shadow text-center border-radius-md me-3">
            <i class="ni ni-laptop text-white opacity-10"></i>
          </div>
          <div>
            <h6 class="mb-0">Code Playground</h6>
            <p class="text-sm mb-0">Test dan eksperimen dengan code SIREK</p>
          </div>
        </div>
      </div>
      <div class="card-body">

        <div class="row">
          <div class="col-md-6">
            <h6 class="text-dark">📝 Code Editor</h6>
            <div class="form-group">
              <label for="code-type" class="form-control-label">Pilih Tipe Code:</label>
              <select class="form-control" id="code-type" onchange="loadTemplate()">
                <option value="model">Model Example</option>
                <option value="controller">Controller Example</option>
                <option value="view">View Example</option>
                <option value="validation">Form Validation</option>
                <option value="query">Database Query</option>
              </select>
            </div>

            <div class="form-group">
              <label for="code-editor" class="form-control-label">Code:</label>
              <textarea class="form-control" id="code-editor" rows="15" style="font-family: 'Courier New', monospace; font-size: 14px;"></textarea>
            </div>

            <div class="d-flex gap-2">
              <button class="btn btn-primary" onclick="formatCode()">
                <i class="ni ni-settings"></i> Format Code
              </button>
              <button class="btn btn-success" onclick="validateCode()">
                <i class="ni ni-check-bold"></i> Validate
              </button>
              <button class="btn btn-info" onclick="copyCode()">
                <i class="ni ni-single-copy-04"></i> Copy
              </button>
            </div>
          </div>

          <div class="col-md-6">
            <h6 class="text-dark">📋 Output & Tips</h6>
            <div id="output-panel" class="bg-gray-100 border-radius-lg p-3" style="min-height: 400px;">
              <div class="text-center text-muted">
                <i class="ni ni-bulb-61 text-warning" style="font-size: 2rem;"></i>
                <p class="mt-2">Pilih template code dan mulai eksperimen!</p>
              </div>
            </div>

            <div class="mt-3">
              <h6 class="text-dark">🎯 Quick Actions</h6>
              <div class="d-flex flex-wrap gap-2">
                <button class="btn btn-sm btn-outline-primary" onclick="loadExample('crud')">CRUD Example</button>
                <button class="btn btn-sm btn-outline-success" onclick="loadExample('validation')">Validation</button>
                <button class="btn btn-sm btn-outline-warning" onclick="loadExample('security')">Security</button>
                <button class="btn btn-sm btn-outline-info" onclick="loadExample('database')">Database</button>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>

<script>
const codeTemplates = {
  model: '&lt;?php\n' +
'defined(\'BASEPATH\') OR exit(\'No direct script access allowed\');\n\n' +
'class Model_Example extends CI_Model {\n\n' +
'    public function __construct() {\n' +
'        parent::__construct();\n' +
'    }\n\n' +
'    public function get_all_data() {\n' +
'        \\$this-&gt;db-&gt;order_by(\'id\', \'DESC\');\n' +
'        \\$query = \\$this-&gt;db-&gt;get(\'table_name\');\n' +
'        return \\$query-&gt;result();\n' +
'    }\n\n' +
'    public function get_by_id(\\$id) {\n' +
'        \\$this-&gt;db-&gt;where(\'id\', \\$id);\n' +
'        \\$query = \\$this-&gt;db-&gt;get(\'table_name\');\n' +
'        return \\$query-&gt;row();\n' +
'    }\n\n' +
'    public function insert_data(\\$data) {\n' +
'        \\$this-&gt;db-&gt;insert(\'table_name\', \\$data);\n' +
'        return \\$this-&gt;db-&gt;insert_id();\n' +
'    }\n\n' +
'    public function update_data(\\$id, \\$data) {\n' +
'        \\$this-&gt;db-&gt;where(\'id\', \\$id);\n' +
'        return \\$this-&gt;db-&gt;update(\'table_name\', \\$data);\n' +
'    }\n\n' +
'    public function delete_data(\\$id) {\n' +
'        \\$this-&gt;db-&gt;where(\'id\', \\$id);\n' +
'        return \\$this-&gt;db-&gt;delete(\'table_name\');\n' +
'    }\n' +
'}',

  controller: 'public function example_method() {\n' +
'    // Load model\n' +
'    \\$this-&gt;load-&gt;model(\'model_example\');\n\n' +
'    // Get data\n' +
'    \\$data[\'items\'] = \\$this-&gt;model_example-&gt;get_all_data();\n\n' +
'    // Set page title\n' +
'    \\$data[\'title\'] = \'Example Page\';\n\n' +
'    // Load views\n' +
'    \\$this-&gt;load-&gt;view(\'templates/admin_header\', \\$data);\n' +
'    \\$this-&gt;load-&gt;view(\'admin/example/index\', \\$data);\n' +
'    \\$this-&gt;load-&gt;view(\'templates/admin_footer\');\n' +
'}\n\n' +
'public function add_example() {\n' +
'    if (\\$this-&gt;input-&gt;post()) {\n' +
'        // Form validation\n' +
'        \\$this-&gt;form_validation-&gt;set_rules(\'name\', \'Name\', \'required|min_length[3]\');\n\n' +
'        if (\\$this-&gt;form_validation-&gt;run() == TRUE) {\n' +
'            \\$data = array(\n' +
'                \'name\' =&gt; \\$this-&gt;input-&gt;post(\'name\'),\n' +
'                \'description\' =&gt; \\$this-&gt;input-&gt;post(\'description\'),\n' +
'                \'created_at\' =&gt; date(\'Y-m-d H:i:s\')\n' +
'            );\n\n' +
'            if (\\$this-&gt;model_example-&gt;insert_data(\\$data)) {\n' +
'                \\$this-&gt;session-&gt;set_flashdata(\'success\', \'Data berhasil ditambahkan\');\n' +
'            } else {\n' +
'                \\$this-&gt;session-&gt;set_flashdata(\'error\', \'Gagal menambahkan data\');\n' +
'            }\n' +
'            redirect(\'admin/example\');\n' +
'        }\n' +
'    }\n' +
'}',

  view: '&lt;div class="row"&gt;\n' +
'  &lt;div class="col-12"&gt;\n' +
'    &lt;div class="card"&gt;\n' +
'      &lt;div class="card-header pb-0"&gt;\n' +
'        &lt;div class="d-flex justify-content-between"&gt;\n' +
'          &lt;h6&gt;Data Example&lt;/h6&gt;\n' +
'          &lt;button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addModal"&gt;\n' +
'            &lt;i class="ni ni-fat-add"&gt;&lt;/i&gt; Tambah Data\n' +
'          &lt;/button&gt;\n' +
'        &lt;/div&gt;\n' +
'      &lt;/div&gt;\n' +
'      &lt;div class="card-body px-0 pt-0 pb-2"&gt;\n' +
'        &lt;div class="table-responsive p-0"&gt;\n' +
'          &lt;table class="table align-items-center mb-0"&gt;\n' +
'            &lt;thead&gt;\n' +
'              &lt;tr&gt;\n' +
'                &lt;th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"&gt;Name&lt;/th&gt;\n' +
'                &lt;th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"&gt;Description&lt;/th&gt;\n' +
'                &lt;th class="text-secondary opacity-7"&gt;Actions&lt;/th&gt;\n' +
'              &lt;/tr&gt;\n' +
'            &lt;/thead&gt;\n' +
'            &lt;tbody&gt;\n' +
'              &lt;?php foreach (\\$items as \\$item) : ?&gt;\n' +
'                &lt;tr&gt;\n' +
'                  &lt;td&gt;\n' +
'                    &lt;h6 class="mb-0 text-sm"&gt;&lt;?= htmlspecialchars(\\$item-&gt;name) ?&gt;&lt;/h6&gt;\n' +
'                  &lt;/td&gt;\n' +
'                  &lt;td&gt;\n' +
'                    &lt;p class="text-xs text-secondary mb-0"&gt;&lt;?= htmlspecialchars(\\$item-&gt;description) ?&gt;&lt;/p&gt;\n' +
'                  &lt;/td&gt;\n' +
'                  &lt;td&gt;\n' +
'                    &lt;a href="&lt;?= base_url(\'admin/edit_example/\' . \\$item-&gt;id) ?&gt;" class="btn btn-sm btn-outline-warning"&gt;Edit&lt;/a&gt;\n' +
'                    &lt;a href="&lt;?= base_url(\'admin/delete_example/\' . \\$item-&gt;id) ?&gt;" class="btn btn-sm btn-outline-danger" onclick="return confirm(\'Yakin hapus?\')"&gt;Hapus&lt;/a&gt;\n' +
'                  &lt;/td&gt;\n' +
'                &lt;/tr&gt;\n' +
'              &lt;?php endforeach; ?&gt;\n' +
'            &lt;/tbody&gt;\n' +
'          &lt;/table&gt;\n' +
'        &lt;/div&gt;\n' +
'      &lt;/div&gt;\n' +
'    &lt;/div&gt;\n' +
'  &lt;/div&gt;\n' +
'&lt;/div&gt;',

  validation: '// Form validation rules\n' +
'\\$this-&gt;form_validation-&gt;set_rules(\'email\', \'Email\', \'required|valid_email|is_unique[users.email]\');\n' +
'\\$this-&gt;form_validation-&gt;set_rules(\'password\', \'Password\', \'required|min_length[8]\');\n' +
'\\$this-&gt;form_validation-&gt;set_rules(\'name\', \'Name\', \'required|min_length[3]|max_length[100]\');\n' +
'\\$this-&gt;form_validation-&gt;set_rules(\'phone\', \'Phone\', \'required|numeric|min_length[10]\');\n\n' +
'// Custom validation messages\n' +
'\\$this-&gt;form_validation-&gt;set_message(\'required\', \'{field} harus diisi\');\n' +
'\\$this-&gt;form_validation-&gt;set_message(\'valid_email\', \'{field} harus berupa email yang valid\');\n' +
'\\$this-&gt;form_validation-&gt;set_message(\'is_unique\', \'{field} sudah terdaftar\');\n' +
'\\$this-&gt;form_validation-&gt;set_message(\'min_length\', \'{field} minimal {param} karakter\');\n\n' +
'if (\\$this-&gt;form_validation-&gt;run() == FALSE) {\n' +
'    // Show validation errors\n' +
'    \\$this-&gt;session-&gt;set_flashdata(\'error\', validation_errors());\n' +
'} else {\n' +
'    // Process form data\n' +
'    \\$data = array(\n' +
'        \'email\' =&gt; \\$this-&gt;input-&gt;post(\'email\'),\n' +
'        \'password\' =&gt; password_hash(\\$this-&gt;input-&gt;post(\'password\'), PASSWORD_DEFAULT),\n' +
'        \'name\' =&gt; \\$this-&gt;input-&gt;post(\'name\'),\n' +
'        \'phone\' =&gt; \\$this-&gt;input-&gt;post(\'phone\')\n' +
'    );\n' +
'}',

  query: '// Basic queries\n' +
'\\$this-&gt;db-&gt;select(\'*\');\n' +
'\\$this-&gt;db-&gt;from(\'table_name\');\n' +
'\\$this-&gt;db-&gt;where(\'status\', \'active\');\n' +
'\\$this-&gt;db-&gt;order_by(\'created_at\', \'DESC\');\n' +
'\\$query = \\$this-&gt;db-&gt;get();\n\n' +
'// Join queries\n' +
'\\$this-&gt;db-&gt;select(\'a.*, b.name as category_name\');\n' +
'\\$this-&gt;db-&gt;from(\'articles a\');\n' +
'\\$this-&gt;db-&gt;join(\'categories b\', \'b.id = a.category_id\', \'left\');\n' +
'\\$this-&gt;db-&gt;where(\'a.status\', \'published\');\n' +
'\\$query = \\$this-&gt;db-&gt;get();\n\n' +
'// Complex where conditions\n' +
'\\$this-&gt;db-&gt;where(\'status\', \'active\');\n' +
'\\$this-&gt;db-&gt;where(\'created_at &gt;=\', date(\'Y-m-d\', strtotime(\'-30 days\')));\n' +
'\\$this-&gt;db-&gt;where_in(\'category_id\', array(1, 2, 3));\n' +
'\\$this-&gt;db-&gt;like(\'title\', \'search_term\');\n\n' +
'// Pagination\n' +
'\\$limit = 10;\n' +
'\\$offset = (\\$page - 1) * \\$limit;\n' +
'\\$this-&gt;db-&gt;limit(\\$limit, \\$offset);\n\n' +
'// Count total records\n' +
'\\$this-&gt;db-&gt;from(\'table_name\');\n' +
'\\$this-&gt;db-&gt;where(\'status\', \'active\');\n' +
'\\$total_records = \\$this-&gt;db-&gt;count_all_results();'
};

function loadTemplate() {
  const type = document.getElementById('code-type').value;
  const editor = document.getElementById('code-editor');
  editor.value = codeTemplates[type];

  updateOutput('Template loaded: ' + type.charAt(0).toUpperCase() + type.slice(1));
}

function formatCode() {
  const editor = document.getElementById('code-editor');
  let code = editor.value;

  // Simple formatting
  code = code.replace(/\s*{\s*/g, ' {\n    ');
  code = code.replace(/;\s*/g, ';\n    ');
  code = code.replace(/}\s*/g, '\n}\n\n');

  editor.value = code;
  updateOutput('Code formatted successfully!');
}

function validateCode() {
  const code = document.getElementById('code-editor').value;
  let issues = [];

  // Basic PHP syntax checks
  if (!code.includes('&lt;?php') && code.includes('\\$')) {
    issues.push('Missing PHP opening tag');
  }

  if (code.includes('\\$this-&gt;db-&gt;') && !code.includes('\\$query')) {
    issues.push('Database query without result assignment');
  }

  if (code.includes('form_validation') && !code.includes('set_rules')) {
    issues.push('Form validation without rules');
  }

  if (issues.length === 0) {
    updateOutput('✅ Code validation passed!', 'success');
  } else {
    updateOutput('⚠️ Issues found:\n' + issues.join('\n'), 'warning');
  }
}

function copyCode() {
  const editor = document.getElementById('code-editor');
  editor.select();
  document.execCommand('copy');
  updateOutput('📋 Code copied to clipboard!', 'info');
}

function loadExample(type) {
  const examples = {
    crud: 'model',
    validation: 'validation',
    security: 'validation',
    database: 'query'
  };

  document.getElementById('code-type').value = examples[type];
  loadTemplate();
}

function updateOutput(message, type = 'info') {
  const output = document.getElementById('output-panel');
  const alertClass = type === 'success' ? 'alert-success' :
                    type === 'warning' ? 'alert-warning' :
                    type === 'error' ? 'alert-danger' : 'alert-info';

  output.innerHTML =
    '&lt;div class="alert ' + alertClass + '"&gt;' +
      '&lt;pre style="white-space: pre-wrap; margin: 0;"&gt;' + message + '&lt;/pre&gt;' +
    '&lt;/div&gt;';
}

// Load default template
document.addEventListener('DOMContentLoaded', function() {
  loadTemplate();
});
</script>
