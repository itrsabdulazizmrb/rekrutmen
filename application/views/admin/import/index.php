<div class="row">
  <div class="col-12">
    <div class="card mb-4">
      <div class="card-header pb-0">
        <div class="d-flex justify-content-between align-items-center">
          <h6>Import Soal Pilihan Ganda</h6>
          <a href="<?= base_url('admin/assessments') ?>" class="btn btn-sm btn-outline-primary">
            <i class="fas fa-arrow-left me-2"></i> Kembali ke Daftar Penilaian
          </a>
        </div>
        <p class="text-sm mb-0">
          <i class="fa fa-info-circle text-primary" aria-hidden="true"></i>
          <span class="font-weight-bold">Import soal pilihan ganda dari file Excel</span>
        </p>
      </div>
      <div class="card-body">
        <?php if ($this->session->flashdata('success')) : ?>
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <span class="alert-icon"><i class="fas fa-check-circle"></i></span>
            <span class="alert-text"><?= $this->session->flashdata('success') ?></span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        <?php endif; ?>

        <?php if ($this->session->flashdata('error')) : ?>
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <span class="alert-icon"><i class="fas fa-exclamation-circle"></i></span>
            <span class="alert-text"><?= $this->session->flashdata('error') ?></span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        <?php endif; ?>

        <div class="row">
          <div class="col-md-6">
            <div class="card">
              <div class="card-header pb-0">
                <h6>Langkah 1: Download Template</h6>
              </div>
              <div class="card-body">
                <p class="text-sm">Download template Excel untuk mengisi soal pilihan ganda.</p>

                <div class="form-group">
                  <label for="assessment_template" class="form-control-label">Pilih Penilaian (Opsional)</label>
                  <select class="form-control" id="assessment_template">
                    <option value="">-- Template Umum --</option>
                    <?php foreach ($assessments as $assessment) : ?>
                      <option value="<?= $assessment->id ?>"><?= $assessment->title ?></option>
                    <?php endforeach; ?>
                  </select>
                  <small class="text-muted">Pilih penilaian untuk menyertakan informasi penilaian pada template</small>
                </div>

                <div class="mt-3">
                  <button type="button" id="download_template" class="btn btn-primary">
                    <i class="fas fa-download me-2"></i> Download Template
                  </button>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-6">
            <div class="card">
              <div class="card-header pb-0">
                <h6>Langkah 2: Import Soal</h6>
              </div>
              <div class="card-body">
                <?= form_open_multipart('import/process', ['id' => 'import_form']) ?>
                  <div class="form-group">
                    <label for="assessment_id" class="form-control-label">Pilih Penilaian <span class="text-danger">*</span></label>
                    <select class="form-control" id="assessment_id" name="assessment_id" required>
                      <option value="">-- Pilih Penilaian --</option>
                      <?php foreach ($assessments as $assessment) : ?>
                        <option value="<?= $assessment->id ?>"><?= $assessment->title ?></option>
                      <?php endforeach; ?>
                    </select>
                    <small class="text-muted">Pilih penilaian yang akan ditambahkan soal</small>
                  </div>

                  <div class="form-group mt-3">
                    <label for="excel_file" class="form-control-label">File Excel <span class="text-danger">*</span></label>
                    <input type="file" class="form-control" id="excel_file" name="excel_file" accept=".xlsx, .xls" required>
                    <small class="text-muted">Upload file Excel yang sudah diisi dengan soal (format .xlsx atau .xls)</small>
                  </div>

                  <div class="mt-3">
                    <button type="submit" class="btn btn-success">
                      <i class="fas fa-file-import me-2"></i> Import Soal
                    </button>
                  </div>
                <?= form_close() ?>
              </div>
            </div>
          </div>
        </div>

        <div class="row mt-4">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header pb-0">
                <h6>Petunjuk Import Soal</h6>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <h6 class="text-uppercase text-sm">Format Template</h6>
                    <ul class="text-sm">
                      <li>Template berisi kolom: No, Pertanyaan, Opsi A-D, Kunci Jawaban, dan Bobot</li>
                      <li>Kunci jawaban harus diisi dengan huruf A, B, C, atau D</li>
                      <li>Bobot soal harus diisi dengan angka 1-10</li>
                      <li>Semua kolom harus diisi dengan benar</li>
                      <li>Jangan mengubah format template</li>
                    </ul>
                  </div>
                  <div class="col-md-6">
                    <h6 class="text-uppercase text-sm">Tips Import</h6>
                    <ul class="text-sm">
                      <li>Pastikan semua soal sudah diisi dengan lengkap</li>
                      <li>Periksa kembali kunci jawaban sebelum import</li>
                      <li>Ukuran file maksimal 2MB</li>
                      <li>Hanya file Excel (.xlsx, .xls) yang diperbolehkan</li>
                      <li>Jika terjadi error, periksa pesan error dan perbaiki file Excel</li>
                    </ul>
                  </div>
                </div>

                <div class="alert alert-info mt-3" role="alert">
                  <h6 class="alert-heading mb-1">Catatan Penting</h6>
                  <p class="mb-0">Fitur import ini hanya mendukung soal pilihan ganda dengan 4 opsi jawaban. Untuk jenis soal lain, silakan tambahkan secara manual melalui menu Kelola Soal.</p>
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
  document.addEventListener('DOMContentLoaded', function() {
    // Download template
    document.getElementById('download_template').addEventListener('click', function() {
      var assessmentId = document.getElementById('assessment_template').value;
      var url = '<?= base_url('import/download_template') ?>';

      if (assessmentId) {
        url += '/' + assessmentId;
      }

      window.location.href = url;
    });

    // Form validation
    document.getElementById('import_form').addEventListener('submit', function(e) {
      var assessmentId = document.getElementById('assessment_id').value;
      var excelFile = document.getElementById('excel_file').value;

      if (!assessmentId) {
        e.preventDefault();
        Swal.fire({
          icon: 'warning',
          title: 'Perhatian',
          text: 'Pilih penilaian terlebih dahulu',
          confirmButtonText: 'OK'
        });
        return false;
      }

      if (!excelFile) {
        e.preventDefault();
        Swal.fire({
          icon: 'warning',
          title: 'Perhatian',
          text: 'Pilih file Excel terlebih dahulu',
          confirmButtonText: 'OK'
        });
        return false;
      }

      // Validasi ekstensi file
      var allowedExtensions = /(\.xlsx|\.xls)$/i;
      if (!allowedExtensions.exec(excelFile)) {
        e.preventDefault();
        Swal.fire({
          icon: 'error',
          title: 'Format File Salah',
          text: 'File harus berformat Excel (.xlsx atau .xls)',
          confirmButtonText: 'OK'
        });
        return false;
      }

      return true;
    });
  });
</script>
