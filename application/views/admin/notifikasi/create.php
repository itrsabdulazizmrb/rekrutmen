<div class="row">
  <div class="col-md-8">
    <div class="card">
      <div class="card-header pb-0">
        <div class="d-flex align-items-center">
          <div class="icon icon-shape icon-sm bg-gradient-primary shadow text-center border-radius-md me-3">
            <i class="ni ni-fat-add text-white opacity-10"></i>
          </div>
          <div>
            <h6 class="mb-0">Buat Notifikasi Baru</h6>
            <p class="text-sm mb-0">Kirim notifikasi kepada pengguna tertentu</p>
          </div>
        </div>
      </div>
      <div class="card-body">

        <?= form_open('admin/buat_notifikasi', ['class' => 'needs-validation', 'novalidate' => '']) ?>

          <!-- Penerima -->
          <div class="form-group mb-3">
            <label for="id_pengguna" class="form-control-label">Penerima Notifikasi <span class="text-danger">*</span></label>
            <select class="form-control" id="id_pengguna" name="id_pengguna" required>
              <option value="">Pilih Penerima</option>
              <?php foreach ($users as $user): ?>
                <option value="<?= $user->id ?>" <?= set_select('id_pengguna', $user->id) ?>>
                  <?= htmlspecialchars($user->nama_lengkap) ?> (<?= ucfirst($user->role) ?>)
                </option>
              <?php endforeach; ?>
            </select>
            <?= form_error('id_pengguna', '<div class="text-danger text-sm">', '</div>') ?>
          </div>

          <!-- Judul -->
          <div class="form-group mb-3">
            <label for="judul" class="form-control-label">Judul Notifikasi <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="judul" name="judul" value="<?= set_value('judul') ?>" placeholder="Masukkan judul notifikasi" required maxlength="255">
            <?= form_error('judul', '<div class="text-danger text-sm">', '</div>') ?>
          </div>

          <!-- Pesan -->
          <div class="form-group mb-3">
            <label for="pesan" class="form-control-label">Pesan Notifikasi <span class="text-danger">*</span></label>
            <textarea class="form-control" id="pesan" name="pesan" rows="4" placeholder="Masukkan isi pesan notifikasi" required><?= set_value('pesan') ?></textarea>
            <?= form_error('pesan', '<div class="text-danger text-sm">', '</div>') ?>
          </div>

          <!-- Jenis dan Prioritas -->
          <div class="row">
            <div class="col-md-6">
              <div class="form-group mb-3">
                <label for="jenis" class="form-control-label">Jenis Notifikasi <span class="text-danger">*</span></label>
                <select class="form-control" id="jenis" name="jenis" required>
                  <option value="">Pilih Jenis</option>
                  <option value="lamaran_baru" <?= set_select('jenis', 'lamaran_baru') ?>>Lamaran Baru</option>
                  <option value="status_lamaran" <?= set_select('jenis', 'status_lamaran') ?>>Status Lamaran</option>
                  <option value="sistem" <?= set_select('jenis', 'sistem') ?>>Sistem</option>
                  <option value="registrasi_pengguna" <?= set_select('jenis', 'registrasi_pengguna') ?>>Registrasi Pengguna</option>
                  <option value="jadwal_interview" <?= set_select('jenis', 'jadwal_interview') ?>>Jadwal Interview</option>
                  <option value="penilaian" <?= set_select('jenis', 'penilaian') ?>>Penilaian</option>
                  <option value="lowongan_baru" <?= set_select('jenis', 'lowongan_baru') ?>>Lowongan Baru</option>
                </select>
                <?= form_error('jenis', '<div class="text-danger text-sm">', '</div>') ?>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group mb-3">
                <label for="prioritas" class="form-control-label">Prioritas <span class="text-danger">*</span></label>
                <select class="form-control" id="prioritas" name="prioritas" required>
                  <option value="">Pilih Prioritas</option>
                  <option value="rendah" <?= set_select('prioritas', 'rendah') ?>>Rendah</option>
                  <option value="normal" <?= set_select('prioritas', 'normal') ?> selected>Normal</option>
                  <option value="tinggi" <?= set_select('prioritas', 'tinggi') ?>>Tinggi</option>
                  <option value="urgent" <?= set_select('prioritas', 'urgent') ?>>Urgent</option>
                </select>
                <?= form_error('prioritas', '<div class="text-danger text-sm">', '</div>') ?>
              </div>
            </div>
          </div>

          <!-- URL Aksi (Opsional) -->
          <div class="form-group mb-3">
            <label for="url_aksi" class="form-control-label">URL Aksi (Opsional)</label>
            <input type="text" class="form-control" id="url_aksi" name="url_aksi" value="<?= set_value('url_aksi') ?>" placeholder="admin/lamaran/detail/123">
            <small class="form-text text-muted">URL yang akan dibuka ketika notifikasi diklik (tanpa base_url)</small>
          </div>

          <!-- Tanggal Kedaluwarsa (Opsional) -->
          <div class="form-group mb-3">
            <label for="kedaluwarsa_pada" class="form-control-label">Tanggal Kedaluwarsa (Opsional)</label>
            <input type="datetime-local" class="form-control" id="kedaluwarsa_pada" name="kedaluwarsa_pada" value="<?= set_value('kedaluwarsa_pada') ?>">
            <small class="form-text text-muted">Notifikasi akan otomatis disembunyikan setelah tanggal ini</small>
          </div>

          <!-- Submit Buttons -->
          <div class="form-group">
            <button type="submit" class="btn btn-primary">
              <i class="ni ni-send"></i> Kirim Notifikasi
            </button>
            <a href="<?= base_url('admin/notifikasi') ?>" class="btn btn-secondary">
              <i class="ni ni-bold-left"></i> Kembali
            </a>
          </div>

        <?= form_close() ?>

      </div>
    </div>
  </div>

  <!-- Preview Card -->
  <div class="col-md-4">
    <div class="card">
      <div class="card-header pb-0">
        <h6 class="mb-0">Preview Notifikasi</h6>
        <p class="text-sm mb-0">Pratinjau tampilan notifikasi</p>
      </div>
      <div class="card-body">
        <div id="notification-preview" class="border rounded p-3">
          <div class="d-flex align-items-start">
            <div class="icon icon-shape icon-sm bg-gradient-primary shadow text-center border-radius-md me-3">
              <i id="preview-icon" class="ni ni-bell-55 text-white opacity-10"></i>
            </div>
            <div class="flex-grow-1">
              <h6 id="preview-title" class="mb-1 text-sm font-weight-bold">Judul Notifikasi</h6>
              <p id="preview-message" class="text-xs text-secondary mb-2">Pesan notifikasi akan muncul di sini...</p>
              <div class="d-flex align-items-center">
                <span id="preview-type" class="badge badge-sm bg-gradient-primary me-2">Jenis</span>
                <span id="preview-priority" class="badge badge-sm bg-gradient-secondary">Prioritas</span>
              </div>
            </div>
          </div>
        </div>

        <!-- Notification Type Guide -->
        <div class="mt-4">
          <h6 class="text-sm font-weight-bold">Panduan Jenis Notifikasi:</h6>
          <ul class="text-xs text-secondary">
            <li><strong>Lamaran Baru:</strong> Notifikasi untuk admin ketika ada lamaran baru</li>
            <li><strong>Status Lamaran:</strong> Update status lamaran untuk pelamar</li>
            <li><strong>Sistem:</strong> Notifikasi sistem umum</li>
            <li><strong>Registrasi Pengguna:</strong> Notifikasi pengguna baru</li>
            <li><strong>Jadwal Interview:</strong> Pemberitahuan jadwal wawancara</li>
            <li><strong>Penilaian:</strong> Hasil penilaian atau tes</li>
            <li><strong>Lowongan Baru:</strong> Informasi lowongan terbaru</li>
          </ul>
        </div>

        <!-- Priority Guide -->
        <div class="mt-3">
          <h6 class="text-sm font-weight-bold">Tingkat Prioritas:</h6>
          <ul class="text-xs text-secondary">
            <li><span class="badge badge-sm bg-gradient-secondary">Rendah:</span> Informasi umum</li>
            <li><span class="badge badge-sm bg-gradient-primary">Normal:</span> Notifikasi standar</li>
            <li><span class="badge badge-sm bg-gradient-warning">Tinggi:</span> Perlu perhatian</li>
            <li><span class="badge badge-sm bg-gradient-danger">Urgent:</span> Segera ditangani</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>

<script>

document.addEventListener('DOMContentLoaded', function() {
  const titleInput = document.getElementById('judul');
  const messageInput = document.getElementById('pesan');
  const typeSelect = document.getElementById('jenis');
  const prioritySelect = document.getElementById('prioritas');

  const previewTitle = document.getElementById('preview-title');
  const previewMessage = document.getElementById('preview-message');
  const previewType = document.getElementById('preview-type');
  const previewPriority = document.getElementById('preview-priority');
  const previewIcon = document.getElementById('preview-icon');

  
  const typeIcons = {
    'lamaran_baru': 'ni ni-briefcase-24',
    'status_lamaran': 'ni ni-check-bold',
    'sistem': 'ni ni-settings-gear-65',
    'registrasi_pengguna': 'ni ni-single-02',
    'jadwal_interview': 'ni ni-calendar-grid-58',
    'penilaian': 'ni ni-trophy',
    'lowongan_baru': 'ni ni-badge'
  };

  
  const typeColors = {
    'lamaran_baru': 'info',
    'status_lamaran': 'success',
    'sistem': 'warning',
    'registrasi_pengguna': 'primary',
    'jadwal_interview': 'info',
    'penilaian': 'success',
    'lowongan_baru': 'primary'
  };

  
  const priorityColors = {
    'rendah': 'secondary',
    'normal': 'primary',
    'tinggi': 'warning',
    'urgent': 'danger'
  };

  function updatePreview() {
    
    const title = titleInput.value || 'Judul Notifikasi';
    previewTitle.textContent = title;

    
    const message = messageInput.value || 'Pesan notifikasi akan muncul di sini...';
    previewMessage.textContent = message.length > 100 ? message.substring(0, 100) + '...' : message;

    
    const type = typeSelect.value;
    if (type) {
      previewType.textContent = typeSelect.options[typeSelect.selectedIndex].text;
      previewType.className = 'badge badge-sm bg-gradient-' + (typeColors[type] || 'primary') + ' me-2';

      
      if (typeIcons[type]) {
        previewIcon.className = typeIcons[type] + ' text-white opacity-10';
      }
    } else {
      previewType.textContent = 'Jenis';
      previewType.className = 'badge badge-sm bg-gradient-primary me-2';
    }

    
    const priority = prioritySelect.value;
    if (priority) {
      previewPriority.textContent = prioritySelect.options[prioritySelect.selectedIndex].text;
      previewPriority.className = 'badge badge-sm bg-gradient-' + (priorityColors[priority] || 'secondary');
    } else {
      previewPriority.textContent = 'Prioritas';
      previewPriority.className = 'badge badge-sm bg-gradient-secondary';
    }
  }

  
  titleInput.addEventListener('input', updatePreview);
  messageInput.addEventListener('input', updatePreview);
  typeSelect.addEventListener('change', updatePreview);
  prioritySelect.addEventListener('change', updatePreview);

  
  updatePreview();
});


(function() {
  'use strict';
  window.addEventListener('load', function() {
    var forms = document.getElementsByClassName('needs-validation');
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();
</script>
