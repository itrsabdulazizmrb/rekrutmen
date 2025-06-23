<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header pb-0">
        <div class="d-flex align-items-center">
          <div class="icon icon-shape icon-sm bg-gradient-success shadow text-center border-radius-md me-3">
            <i class="ni ni-settings-gear-65 text-white opacity-10"></i>
          </div>
          <div>
            <h6 class="mb-0">CRUD Generator</h6>
            <p class="text-sm mb-0">Generate CRUD code otomatis untuk modul baru</p>
          </div>
        </div>
      </div>
      <div class="card-body">

        <div class="row">
          <div class="col-md-4">
            <div class="card">
              <div class="card-header pb-0">
                <h6 class="text-sm">⚙️ Configuration</h6>
              </div>
              <div class="card-body">
                <div class="form-group mb-3">
                  <label for="module-name" class="form-control-label">Module Name:</label>
                  <input type="text" class="form-control" id="module-name" placeholder="e.g., Product, Category">
                </div>

                <div class="form-group mb-3">
                  <label for="table-name" class="form-control-label">Table Name:</label>
                  <input type="text" class="form-control" id="table-name" placeholder="e.g., products, categories">
                </div>

                <div class="form-group mb-3">
                  <label class="form-control-label">Fields:</label>
                  <div id="fields-container">
                    <div class="field-row mb-2">
                      <div class="row">
                        <div class="col-6">
                          <input type="text" class="form-control form-control-sm" placeholder="Field name" value="name">
                        </div>
                        <div class="col-4">
                          <select class="form-control form-control-sm">
                            <option value="varchar">VARCHAR</option>
                            <option value="text">TEXT</option>
                            <option value="int">INT</option>
                            <option value="date">DATE</option>
                            <option value="enum">ENUM</option>
                          </select>
                        </div>
                        <div class="col-2">
                          <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeField(this)">×</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <button type="button" class="btn btn-sm btn-outline-primary" onclick="addField()">+ Add Field</button>
                </div>

                <div class="form-group mb-3">
                  <label class="form-control-label">Options:</label>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="with-timestamps" checked>
                    <label class="form-check-label" for="with-timestamps">Include Timestamps</label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="with-status" checked>
                    <label class="form-check-label" for="with-status">Include Status Field</label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="with-validation">
                    <label class="form-check-label" for="with-validation">Advanced Validation</label>
                  </div>
                </div>

                <button class="btn btn-success w-100" onclick="generateCRUD()">
                  <i class="ni ni-settings"></i> Generate CRUD
                </button>
              </div>
            </div>
          </div>

          <div class="col-md-8">
            <div class="card">
              <div class="card-header pb-0">
                <div class="d-flex justify-content-between">
                  <h6 class="text-sm">📄 Generated Code</h6>
                  <div>
                    <select class="form-control form-control-sm" id="code-type-selector" onchange="showGeneratedCode()">
                      <option value="sql">SQL Table</option>
                      <option value="model">Model</option>
                      <option value="controller">Controller</option>
                      <option value="view-index">View - Index</option>
                      <option value="view-form">View - Form</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <div id="generated-code-container">
                  <div class="text-center text-muted py-5">
                    <i class="ni ni-bulb-61 text-warning" style="font-size: 3rem;"></i>
                    <p class="mt-3">Configure your module and click "Generate CRUD" to see the code</p>
                  </div>
                </div>

                <div class="mt-3" id="action-buttons" style="display: none;">
                  <button class="btn btn-primary btn-sm" onclick="copyGeneratedCode()">
                    <i class="ni ni-single-copy-04"></i> Copy Code
                  </button>
                  <button class="btn btn-info btn-sm" onclick="downloadCode()">
                    <i class="ni ni-cloud-download-95"></i> Download
                  </button>
                  <button class="btn btn-warning btn-sm" onclick="previewCode()">
                    <i class="ni ni-tv-2"></i> Preview
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>

<script>
let generatedCodes = {};

function addField() {
  const container = document.getElementById('fields-container');
  const fieldRow = document.createElement('div');
  fieldRow.className = 'field-row mb-2';
  fieldRow.innerHTML = `
    <div class="row">
      <div class="col-6">
        <input type="text" class="form-control form-control-sm" placeholder="Field name">
      </div>
      <div class="col-4">
        <select class="form-control form-control-sm">
          <option value="varchar">VARCHAR</option>
          <option value="text">TEXT</option>
          <option value="int">INT</option>
          <option value="date">DATE</option>
          <option value="enum">ENUM</option>
        </select>
      </div>
      <div class="col-2">
        <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeField(this)">×</button>
      </div>
    </div>
  `;
  container.appendChild(fieldRow);
}

function removeField(button) {
  button.closest('.field-row').remove();
}

function generateCRUD() {
  const moduleName = document.getElementById('module-name').value;
  const tableName = document.getElementById('table-name').value;

  if (!moduleName || !tableName) {
    alert('Please fill in module name and table name');
    return;
  }

  const fields = getFields();
  const options = getOptions();

  // Generate all code types
  generatedCodes.sql = generateSQL(tableName, fields, options);
  generatedCodes.model = generateModel(moduleName, tableName, fields);
  generatedCodes.controller = generateController(moduleName, tableName);
  generatedCodes['view-index'] = generateViewIndex(moduleName, fields);
  generatedCodes['view-form'] = generateViewForm(moduleName, fields);

  // Show the first code type
  document.getElementById('code-type-selector').value = 'sql';
  showGeneratedCode();
  document.getElementById('action-buttons').style.display = 'block';
}

function getFields() {
  const fieldRows = document.querySelectorAll('.field-row');
  const fields = [];

  fieldRows.forEach(row => {
    const name = row.querySelector('input').value;
    const type = row.querySelector('select').value;
    if (name) {
      fields.push({ name, type });
    }
  });

  return fields;
}

function getOptions() {
  return {
    timestamps: document.getElementById('with-timestamps').checked,
    status: document.getElementById('with-status').checked,
    validation: document.getElementById('with-validation').checked
  };
}

function generateSQL(tableName, fields, options) {
  let sql = `CREATE TABLE \`${tableName}\` (\n`;
  sql += `  \`id\` int(11) NOT NULL AUTO_INCREMENT,\n`;

  fields.forEach(field => {
    let fieldType = field.type;
    if (fieldType === 'varchar') fieldType = 'varchar(255)';
    if (fieldType === 'enum') fieldType = "enum('active','inactive')";

    sql += `  \`${field.name}\` ${fieldType}`;
    if (field.type === 'varchar' || field.type === 'text') {
      sql += ' NOT NULL';
    }
    sql += ',\n';
  });

  if (options.status) {
    sql += `  \`status\` enum('active','inactive') DEFAULT 'active',\n`;
  }

  if (options.timestamps) {
    sql += `  \`created_at\` timestamp DEFAULT CURRENT_TIMESTAMP,\n`;
    sql += `  \`updated_at\` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,\n`;
  }

  sql += `  PRIMARY KEY (\`id\`)\n`;
  sql += `) ENGINE=InnoDB DEFAULT CHARSET=utf8;`;

  return sql;
}

function generateModel(moduleName, tableName, fields) {
  const className = 'Model_' + moduleName;
  const methodPrefix = moduleName.toLowerCase();

  let code = '&lt;?php\n';
  code += 'defined(\'BASEPATH\') OR exit(\'No direct script access allowed\');\n\n';
  code += 'class ' + className + ' extends CI_Model {\n\n';
  code += '    public function __construct() {\n';
  code += '        parent::__construct();\n';
  code += '    }\n\n';
  code += '    public function get_all_' + methodPrefix + '() {\n';
  code += '        \\$this->db->order_by(\'id\', \'DESC\');\\n';
  code += '        \\$query = \\$this->db->get(\'' + tableName + '\');\\n';
  code += '        return \\$query->result();\\n';
  code += '    }\n\n';
  code += '    public function get_' + methodPrefix + '_by_id(\\$id) {\\n';
  code += '        \\$this->db->where(\'id\', \\$id);\\n';
  code += '        \\$query = \\$this->db->get(\'' + tableName + '\');\\n';
  code += '        return \\$query->row();\\n';
  code += '    }\\n\\n';
  code += '    public function insert_' + methodPrefix + '(\\$data) {\\n';
  code += '        \\$this->db->insert(\'' + tableName + '\', \\$data);\\n';
  code += '        return \\$this->db->insert_id();\\n';
  code += '    }\\n\\n';
  code += '    public function update_' + methodPrefix + '(\\$id, \\$data) {\\n';
  code += '        \\$this->db->where(\'id\', \\$id);\\n';
  code += '        return \\$this->db->update(\'' + tableName + '\', \\$data);\\n';
  code += '    }\\n\\n';
  code += '    public function delete_' + methodPrefix + '(\\$id) {\\n';
  code += '        \\$this->db->where(\'id\', \\$id);\\n';
  code += '        return \\$this->db->delete(\'' + tableName + '\');\\n';
  code += '    }\\n\\n';
  code += '    public function count_' + methodPrefix + '() {\\n';
  code += '        return \\$this->db->count_all(\'' + tableName + '\');\\n';
  code += '    }\\n';
  code += '}';

  return code;
}

function generateController(moduleName, tableName) {
  const methodPrefix = moduleName.toLowerCase();
  const modelName = 'model_' + methodPrefix;

  let code = '// Add these methods to Admin.php controller\\n\\n';
  code += 'public function ' + methodPrefix + '() {\\n';
  code += '    \\$data[\'items\'] = \\$this->' + modelName + '->get_all_' + methodPrefix + '();\\n';
  code += '    \\$data[\'title\'] = \'' + moduleName + ' Management\';\\n';
  code += '    \\$this->load->view(\'templates/admin_header\', \\$data);\\n';
  code += '    \\$this->load->view(\'admin/' + methodPrefix + '/index\', \\$data);\\n';
  code += '    \\$this->load->view(\'templates/admin_footer\');\\n';
  code += '}\\n\\n';

  code += 'public function add_' + methodPrefix + '() {\\n';
  code += '    if (\\$this->input->post()) {\\n';
  code += '        \\$this->form_validation->set_rules(\'name\', \'Name\', \'required|min_length[3]\');\\n\\n';
  code += '        if (\\$this->form_validation->run() == TRUE) {\\n';
  code += '            \\$data = array(\\n';
  code += '                \'name\' => \\$this->input->post(\'name\'),\\n';
  code += '                \'description\' => \\$this->input->post(\'description\'),\\n';
  code += '                \'status\' => \\$this->input->post(\'status\') ? \'active\' : \'inactive\',\\n';
  code += '                \'created_at\' => date(\'Y-m-d H:i:s\')\\n';
  code += '            );\\n\\n';
  code += '            if (\\$this->' + modelName + '->insert_' + methodPrefix + '(\\$data)) {\\n';
  code += '                \\$this->session->set_flashdata(\'success\', \'' + moduleName + ' berhasil ditambahkan\');\\n';
  code += '            } else {\\n';
  code += '                \\$this->session->set_flashdata(\'error\', \'Gagal menambahkan ' + methodPrefix + '\');\\n';
  code += '            }\\n';
  code += '            redirect(\'admin/' + methodPrefix + '\');\\n';
  code += '        }\\n';
  code += '    }\\n\\n';
  code += '    \\$data[\'title\'] = \'Add ' + moduleName + '\';\\n';
  code += '    \\$this->load->view(\'templates/admin_header\', \\$data);\\n';
  code += '    \\$this->load->view(\'admin/' + methodPrefix + '/add\', \\$data);\\n';
  code += '    \\$this->load->view(\'templates/admin_footer\');\\n';
  code += '}\\n\\n';

  code += 'public function edit_' + methodPrefix + '(\\$id) {\\n';
  code += '    \\$data[\'item\'] = \\$this->' + modelName + '->get_' + methodPrefix + '_by_id(\\$id);\\n\\n';
  code += '    if (!\\$data[\'item\']) {\\n';
  code += '        show_404();\\n';
  code += '    }\\n\\n';
  code += '    if (\\$this->input->post()) {\\n';
  code += '        \\$this->form_validation->set_rules(\'name\', \'Name\', \'required|min_length[3]\');\\n\\n';
  code += '        if (\\$this->form_validation->run() == TRUE) {\\n';
  code += '            \\$update_data = array(\\n';
  code += '                \'name\' => \\$this->input->post(\'name\'),\\n';
  code += '                \'description\' => \\$this->input->post(\'description\'),\\n';
  code += '                \'status\' => \\$this->input->post(\'status\') ? \'active\' : \'inactive\',\\n';
  code += '                \'updated_at\' => date(\'Y-m-d H:i:s\')\\n';
  code += '            );\\n\\n';
  code += '            if (\\$this->' + modelName + '->update_' + methodPrefix + '(\\$id, \\$update_data)) {\\n';
  code += '                \\$this->session->set_flashdata(\'success\', \'' + moduleName + ' berhasil diperbarui\');\\n';
  code += '            } else {\\n';
  code += '                \\$this->session->set_flashdata(\'error\', \'Gagal memperbarui ' + methodPrefix + '\');\\n';
  code += '            }\\n';
  code += '            redirect(\'admin/' + methodPrefix + '\');\\n';
  code += '        }\\n';
  code += '    }\\n\\n';
  code += '    \\$data[\'title\'] = \'Edit ' + moduleName + '\';\\n';
  code += '    \\$this->load->view(\'templates/admin_header\', \\$data);\\n';
  code += '    \\$this->load->view(\'admin/' + methodPrefix + '/edit\', \\$data);\\n';
  code += '    \\$this->load->view(\'templates/admin_footer\');\\n';
  code += '}\\n\\n';

  code += 'public function delete_' + methodPrefix + '(\\$id) {\\n';
  code += '    \\$item = \\$this->' + modelName + '->get_' + methodPrefix + '_by_id(\\$id);\\n\\n';
  code += '    if (!\\$item) {\\n';
  code += '        show_404();\\n';
  code += '    }\\n\\n';
  code += '    if (\\$this->' + modelName + '->delete_' + methodPrefix + '(\\$id)) {\\n';
  code += '        \\$this->session->set_flashdata(\'success\', \'' + moduleName + ' berhasil dihapus\');\\n';
  code += '    } else {\\n';
  code += '        \\$this->session->set_flashdata(\'error\', \'Gagal menghapus ' + methodPrefix + '\');\\n';
  code += '    }\\n\\n';
  code += '    redirect(\'admin/' + methodPrefix + '\');\\n';
  code += '}';

  return code;
}

function generateViewIndex(moduleName, fields) {
  const methodPrefix = moduleName.toLowerCase();

  let tableHeaders = '';
  let tableRows = '';

  fields.forEach(field => {
    tableHeaders += '                &lt;th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"&gt;' + field.name.charAt(0).toUpperCase() + field.name.slice(1) + '&lt;/th&gt;\\n';
    tableRows += '                  &lt;td&gt;\\n                    &lt;p class="text-xs text-secondary mb-0"&gt;&lt;?= htmlspecialchars(\\$item-&gt;' + field.name + ') ?&gt;&lt;/p&gt;\\n                  &lt;/td&gt;\\n';
  });

  let code = '&lt;div class="row"&gt;\\n';
  code += '  &lt;div class="col-12"&gt;\\n';
  code += '    &lt;div class="card"&gt;\\n';
  code += '      &lt;div class="card-header pb-0"&gt;\\n';
  code += '        &lt;div class="d-flex justify-content-between"&gt;\\n';
  code += '          &lt;h6&gt;' + moduleName + ' Management&lt;/h6&gt;\\n';
  code += '          &lt;a href="&lt;?= base_url(\'admin/add_' + methodPrefix + '\') ?&gt;" class="btn btn-primary btn-sm"&gt;\\n';
  code += '            &lt;i class="ni ni-fat-add"&gt;&lt;/i&gt; Add ' + moduleName + '\\n';
  code += '          &lt;/a&gt;\\n';
  code += '        &lt;/div&gt;\\n';
  code += '      &lt;/div&gt;\\n';
  code += '      &lt;div class="card-body px-0 pt-0 pb-2"&gt;\\n';
  code += '        &lt;div class="table-responsive p-0"&gt;\\n';
  code += '          &lt;table class="table align-items-center mb-0"&gt;\\n';
  code += '            &lt;thead&gt;\\n';
  code += '              &lt;tr&gt;\\n';
  code += tableHeaders;
  code += '                &lt;th class="text-secondary opacity-7"&gt;Actions&lt;/th&gt;\\n';
  code += '              &lt;/tr&gt;\\n';
  code += '            &lt;/thead&gt;\\n';
  code += '            &lt;tbody&gt;\\n';
  code += '              &lt;?php foreach (\\$items as \\$item) : ?&gt;\\n';
  code += '                &lt;tr&gt;\\n';
  code += tableRows;
  code += '                  &lt;td class="align-middle"&gt;\\n';
  code += '                    &lt;a href="&lt;?= base_url(\'admin/edit_' + methodPrefix + '/\' . \\$item-&gt;id) ?&gt;" class="btn btn-sm btn-outline-warning"&gt;Edit&lt;/a&gt;\\n';
  code += '                    &lt;a href="&lt;?= base_url(\'admin/delete_' + methodPrefix + '/\' . \\$item-&gt;id) ?&gt;" class="btn btn-sm btn-outline-danger" onclick="return confirm(\'Are you sure?\')"&gt;Delete&lt;/a&gt;\\n';
  code += '                  &lt;/td&gt;\\n';
  code += '                &lt;/tr&gt;\\n';
  code += '              &lt;?php endforeach; ?&gt;\\n';
  code += '            &lt;/tbody&gt;\\n';
  code += '          &lt;/table&gt;\\n';
  code += '        &lt;/div&gt;\\n';
  code += '      &lt;/div&gt;\\n';
  code += '    &lt;/div&gt;\\n';
  code += '  &lt;/div&gt;\\n';
  code += '&lt;/div&gt;';

  return code;
}

function generateViewForm(moduleName, fields) {
  const methodPrefix = moduleName.toLowerCase();

  let formFields = '';
  fields.forEach(field => {
    if (field.type === 'text') {
      formFields += '          &lt;div class="form-group mb-3"&gt;\\n';
      formFields += '            &lt;label for="' + field.name + '" class="form-control-label"&gt;' + field.name.charAt(0).toUpperCase() + field.name.slice(1) + '&lt;/label&gt;\\n';
      formFields += '            &lt;textarea class="form-control" id="' + field.name + '" name="' + field.name + '" rows="3"&gt;&lt;/textarea&gt;\\n';
      formFields += '          &lt;/div&gt;\\n';
    } else {
      formFields += '          &lt;div class="form-group mb-3"&gt;\\n';
      formFields += '            &lt;label for="' + field.name + '" class="form-control-label"&gt;' + field.name.charAt(0).toUpperCase() + field.name.slice(1) + '&lt;/label&gt;\\n';
      formFields += '            &lt;input type="text" class="form-control" id="' + field.name + '" name="' + field.name + '" required&gt;\\n';
      formFields += '          &lt;/div&gt;\\n';
    }
  });

  let code = '&lt;div class="row"&gt;\\n';
  code += '  &lt;div class="col-md-8"&gt;\\n';
  code += '    &lt;div class="card"&gt;\\n';
  code += '      &lt;div class="card-header pb-0"&gt;\\n';
  code += '        &lt;h6&gt;Add ' + moduleName + '&lt;/h6&gt;\\n';
  code += '      &lt;/div&gt;\\n';
  code += '      &lt;div class="card-body"&gt;\\n';
  code += '        &lt;?= form_open() ?&gt;\\n';
  code += formFields;
  code += '          &lt;div class="form-check form-switch mb-3"&gt;\\n';
  code += '            &lt;input class="form-check-input" type="checkbox" id="status" name="status" value="1" checked&gt;\\n';
  code += '            &lt;label class="form-check-label" for="status"&gt;Active&lt;/label&gt;\\n';
  code += '          &lt;/div&gt;\\n\\n';
  code += '          &lt;div class="form-group"&gt;\\n';
  code += '            &lt;button type="submit" class="btn btn-primary"&gt;\\n';
  code += '              &lt;i class="ni ni-check-bold"&gt;&lt;/i&gt; Save\\n';
  code += '            &lt;/button&gt;\\n';
  code += '            &lt;a href="&lt;?= base_url(\'admin/' + methodPrefix + '\') ?&gt;" class="btn btn-secondary"&gt;\\n';
  code += '              &lt;i class="ni ni-bold-left"&gt;&lt;/i&gt; Cancel\\n';
  code += '            &lt;/a&gt;\\n';
  code += '          &lt;/div&gt;\\n';
  code += '        &lt;?= form_close() ?&gt;\\n';
  code += '      &lt;/div&gt;\\n';
  code += '    &lt;/div&gt;\\n';
  code += '  &lt;/div&gt;\\n';
  code += '&lt;/div&gt;';

  return code;
}

function showGeneratedCode() {
  const codeType = document.getElementById('code-type-selector').value;
  const container = document.getElementById('generated-code-container');

  if (generatedCodes[codeType]) {
    container.innerHTML =
      '&lt;div class="bg-gray-100 border-radius-lg p-3"&gt;' +
        '&lt;pre style="white-space: pre-wrap; margin: 0; font-family: \'Courier New\', monospace; font-size: 12px;"&gt;' + generatedCodes[codeType] + '&lt;/pre&gt;' +
      '&lt;/div&gt;';
  }
}

function copyGeneratedCode() {
  const codeType = document.getElementById('code-type-selector').value;
  const code = generatedCodes[codeType];

  navigator.clipboard.writeText(code).then(() => {
    alert('Code copied to clipboard!');
  });
}

function downloadCode() {
  const codeType = document.getElementById('code-type-selector').value;
  const code = generatedCodes[codeType];
  const moduleName = document.getElementById('module-name').value;

  const blob = new Blob([code], { type: 'text/plain' });
  const url = window.URL.createObjectURL(blob);
  const a = document.createElement('a');
  a.href = url;
  a.download = moduleName + '_' + codeType + '.txt';
  a.click();
  window.URL.revokeObjectURL(url);
}

function previewCode() {
  const codeType = document.getElementById('code-type-selector').value;
  const code = generatedCodes[codeType];

  const newWindow = window.open('', '_blank');
  newWindow.document.write(
    '&lt;html&gt;' +
      '&lt;head&gt;&lt;title&gt;Code Preview&lt;/title&gt;&lt;/head&gt;' +
      '&lt;body style="font-family: monospace; padding: 20px;"&gt;' +
        '&lt;pre&gt;' + code + '&lt;/pre&gt;' +
      '&lt;/body&gt;' +
    '&lt;/html&gt;'
  );
}
</script>
