<div class="row">
  <div class="col-12">
    <div class="card mb-4">
      <div class="card-header pb-0">
        <div class="d-flex justify-content-between align-items-center">
          <h6>Tambah Lowongan Baru</h6>
          <a href="<?= base_url('admin/lowongan') ?>" class="btn btn-sm btn-outline-primary">
            <i class="fas fa-arrow-left me-2"></i> Kembali ke Daftar Lowongan
          </a>
        </div>
        <p class="text-sm mb-0">
          <i class="fa fa-info-circle text-primary" aria-hidden="true"></i>
          <span class="font-weight-bold">Isi formulir di bawah ini untuk menambahkan lowongan pekerjaan baru</span>
        </p>
      </div>
      <div class="card-body">
        <?= form_open('admin/tambahLowongan', ['class' => 'needs-validation']) ?>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="title" class="form-control-label">Judul Lowongan <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="title" name="title" value="<?= set_value('title') ?>" required>
                <?= form_error('title', '<small class="text-danger">', '</small>') ?>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="category_id" class="form-control-label">Kategori <span class="text-danger">*</span></label>
                <select class="form-control" id="category_id" name="category_id" required>
                  <option value="">Pilih Kategori</option>
                  <?php foreach ($categories as $category) : ?>
                    <option value="<?= $category->id ?>" <?= set_select('category_id', $category->id) ?>><?= $category->nama ?></option>
                  <?php endforeach; ?>
                </select>
                <?= form_error('category_id', '<small class="text-danger">', '</small>') ?>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="description" class="form-control-label">Deskripsi Pekerjaan <span class="text-danger">*</span></label>
                <textarea class="form-control" id="description" name="description" rows="5" required><?= set_value('description') ?></textarea>
                <?= form_error('description', '<small class="text-danger">', '</small>') ?>
                <small class="text-muted">Jelaskan secara detail tentang posisi pekerjaan ini.</small>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="requirements" class="form-control-label">Persyaratan <span class="text-danger">*</span></label>
                <textarea class="form-control" id="requirements" name="requirements" rows="5" required><?= set_value('requirements') ?></textarea>
                <?= form_error('requirements', '<small class="text-danger">', '</small>') ?>
                <small class="text-muted">Jelaskan kualifikasi dan persyaratan yang dibutuhkan untuk posisi ini.</small>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="responsibilities" class="form-control-label">Tanggung Jawab <span class="text-danger">*</span></label>
                <textarea class="form-control" id="responsibilities" name="responsibilities" rows="5" required><?= set_value('responsibilities') ?></textarea>
                <?= form_error('responsibilities', '<small class="text-danger">', '</small>') ?>
                <small class="text-muted">Jelaskan tanggung jawab dan tugas-tugas untuk posisi ini.</small>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="location" class="form-control-label">Lokasi <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="location" name="location" value="<?= set_value('location') ?>" required>
                <?= form_error('location', '<small class="text-danger">', '</small>') ?>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="job_type" class="form-control-label">Tipe Pekerjaan <span class="text-danger">*</span></label>
                <select class="form-control" id="job_type" name="job_type" required>
                  <option value="">Pilih Tipe Pekerjaan</option>
                  <option value="full-time" <?= set_select('job_type', 'full-time') ?>>Full Time</option>
                  <option value="part-time" <?= set_select('job_type', 'part-time') ?>>Part Time</option>
                  <option value="contract" <?= set_select('job_type', 'contract') ?>>Kontrak</option>
                  <option value="internship" <?= set_select('job_type', 'internship') ?>>Magang</option>
                </select>
                <?= form_error('job_type', '<small class="text-danger">', '</small>') ?>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="salary_range" class="form-control-label">Kisaran Gaji</label>
                <input type="text" class="form-control" id="salary_range" name="salary_range" value="<?= set_value('salary_range') ?>">
                <small class="text-muted">Contoh: Rp 5.000.000 - Rp 8.000.000 per bulan</small>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="deadline" class="form-control-label">Batas Waktu Lamaran <span class="text-danger">*</span></label>
                <input type="date" class="form-control" id="deadline" name="deadline" value="<?= set_value('deadline') ?>" required>
                <?= form_error('deadline', '<small class="text-danger">', '</small>') ?>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="vacancies" class="form-control-label">Jumlah Posisi</label>
                <input type="number" class="form-control" id="vacancies" name="vacancies" value="<?= set_value('vacancies', 1) ?>" min="1">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="status" class="form-control-label">Status <span class="text-danger">*</span></label>
                <select class="form-control" id="status" name="status" required>
                  <option value="active" <?= set_select('status', 'active', true) ?>>Aktif</option>
                  <option value="draft" <?= set_select('status', 'draft') ?>>Draft</option>
                  <option value="inactive" <?= set_select('status', 'inactive') ?>>Tidak Aktif</option>
                </select>
                <?= form_error('status', '<small class="text-danger">', '</small>') ?>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="featured" name="featured" value="1" <?= set_checkbox('featured', '1') ?>>
                <label class="form-check-label" for="featured">Tampilkan sebagai Lowongan Unggulan</label>
              </div>
              <div class="form-check form-switch mt-2">
                <input class="form-check-input" type="checkbox" id="manage_documents" name="manage_documents" value="1" <?= set_checkbox('manage_documents', '1', true) ?>>
                <label class="form-check-label" for="manage_documents">Kelola dokumen persyaratan setelah menyimpan</label>
              </div>
            </div>
          </div>

          <div class="row mt-4">
            <div class="col-md-12">
              <button type="submit" class="btn btn-primary">Simpan Lowongan</button>
              <button type="reset" class="btn btn-secondary">Reset</button>
              <div class="alert alert-info mt-3">
                <i class="fas fa-info-circle me-2"></i>
                <strong>Catatan:</strong> Setelah menyimpan lowongan, Anda dapat mengelola dokumen persyaratan yang diperlukan untuk lamaran.
              </div>
            </div>
          </div>
        <?= form_close() ?>
      </div>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    
    if (typeof ClassicEditor !== 'undefined') {
      ClassicEditor.create(document.querySelector('#description')).catch(error => {
        console.error(error);
      });

      ClassicEditor.create(document.querySelector('#requirements')).catch(error => {
        console.error(error);
      });

      ClassicEditor.create(document.querySelector('#responsibilities')).catch(error => {
        console.error(error);
      });
    }

    
    const today = new Date().toISOString().split('T')[0];
    document.getElementById('deadline').setAttribute('min', today);
  });
</script>
