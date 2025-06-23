<?php

?>
<div class="row">
  <div class="col-12">
    <div class="card mb-4">
      <div class="card-header pb-0">
        <div class="d-flex justify-content-between align-items-center">
          <h6>Tambah Penilaian Baru</h6>
          <a href="<?= base_url('admin/penilaian') ?>" class="btn btn-sm btn-outline-primary">
            <i class="fas fa-arrow-left me-2"></i> Kembali ke Daftar Penilaian
          </a>
        </div>
        <p class="text-sm mb-0">
          <i class="fa fa-info-circle text-primary" aria-hidden="true"></i>
          Buat penilaian baru untuk proses rekrutmen
        </p>
      </div>
      <div class="card-body">
        <?= form_open('admin/tambah_penilaian', ['class' => 'needs-validation']) ?>
          <div class="row">
            <div class="col-md-8">
              <div class="form-group">
                <label for="title" class="form-control-label">Judul Penilaian <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="title" name="title" value="<?= set_value('title') ?>" required>
                <?= form_error('title', '<small class="text-danger">', '</small>') ?>
                <small class="form-text text-muted">Berikan judul yang jelas dan deskriptif untuk penilaian ini.</small>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="assessment_type_id" class="form-control-label">Tipe Penilaian <span class="text-danger">*</span></label>
                <select class="form-control" id="assessment_type_id" name="assessment_type_id" required>
                  <option value="">Pilih Tipe Penilaian</option>
                  <?php foreach ($assessment_types as $type) : ?>
                    <option value="<?= $type->id ?>" <?= set_select('assessment_type_id', $type->id) ?>><?= $type->nama ?></option>
                  <?php endforeach; ?>
                </select>
                <?= form_error('assessment_type_id', '<small class="text-danger">', '</small>') ?>
                <small class="form-text text-muted">Pilih kategori penilaian yang sesuai.</small>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="description" class="form-control-label">Deskripsi Penilaian</label>
                <textarea class="form-control" id="description" name="description" rows="4"><?= set_value('description') ?></textarea>
                <?= form_error('description', '<small class="text-danger">', '</small>') ?>
                <small class="form-text text-muted">Jelaskan tujuan dan cakupan penilaian ini.</small>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="time_limit" class="form-control-label">Batas Waktu (menit)</label>
                <input type="number" class="form-control" id="time_limit" name="time_limit" value="<?= set_value('time_limit') ?>" min="0">
                <?= form_error('time_limit', '<small class="text-danger">', '</small>') ?>
                <small class="form-text text-muted">Kosongkan jika tidak ada batas waktu.</small>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="passing_score" class="form-control-label">Nilai Kelulusan</label>
                <input type="number" class="form-control" id="passing_score" name="passing_score" value="<?= set_value('passing_score') ?>" min="0" max="100">
                <small class="text-muted">Nilai minimum untuk lulus penilaian ini (0-100).</small>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="max_attempts" class="form-control-label">Jumlah Percobaan Maksimum</label>
                <input type="number" class="form-control" id="max_attempts" name="max_attempts" value="<?= set_value('max_attempts', 1) ?>" min="1">
                <?= form_error('max_attempts', '<small class="text-danger">', '</small>') ?>
                <small class="form-text text-muted">Berapa kali peserta dapat mengulang penilaian.</small>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="instructions" class="form-control-label">Petunjuk Pengerjaan</label>
                <textarea class="form-control" id="instructions" name="instructions" rows="4"><?= set_value('instructions') ?></textarea>
                <?= form_error('instructions', '<small class="text-danger">', '</small>') ?>
                <small class="form-text text-muted">Berikan petunjuk yang jelas untuk peserta penilaian.</small>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-4">
              <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" <?= set_checkbox('is_active', '1', TRUE) ?>>
                <label class="form-check-label" for="is_active">Aktifkan Penilaian</label>
                <small class="form-text text-muted d-block">Penilaian yang aktif dapat digunakan dalam proses rekrutmen.</small>
              </div>
            </div>
            <!--
            <div class="col-md-4">
              <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="acak_soal" name="acak_soal" value="1" <?= set_checkbox('acak_soal', '1') ?>>
                <label class="form-check-label" for="acak_soal">Acak Urutan Soal</label>
                <small class="form-text text-muted d-block">Soal akan ditampilkan dalam urutan acak untuk setiap peserta.</small>
              </div>
            </div>
            -->
            <div class="col-md-4">
              <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="mode_cat" name="mode_cat" value="1" <?= set_checkbox('mode_cat', '1') ?>>
                <label class="form-check-label" for="mode_cat">Mode CAT (Computer Adaptive Test)</label>
                <small class="form-text text-muted d-block">Aktifkan interface ujian CAT dengan navigasi soal dan mode layar penuh.</small>
              </div>
            </div>
          </div>

          <div class="d-flex justify-content-end mt-4">
            <a href="<?= base_url('admin/penilaian') ?>" class="btn btn-light me-2">Batal</a>
            <button type="submit" class="btn btn-primary">
              <i class="fas fa-save me-2"></i> Simpan Penilaian
            </button>
          </div>
        <?= form_close() ?>
      </div>
    </div>
  </div>
</div>

<script>
$(document).ready(function() {
    
    $('#title').on('input', function() {
        let title = $(this).val();
        let slug = title.toLowerCase()
            .replace(/[^a-z0-9\s-]/g, '')
            .replace(/\s+/g, '-')
            .replace(/-+/g, '-')
            .trim('-');
        $('#slug').val(slug);
    });

    
    $('form').on('submit', function(e) {
        let isValid = true;

        
        $('input[required], select[required]').each(function() {
            if (!$(this).val()) {
                isValid = false;
                $(this).addClass('is-invalid');
            } else {
                $(this).removeClass('is-invalid');
            }
        });

        if (!isValid) {
            e.preventDefault();
            Swal.fire({
                title: 'Form Tidak Lengkap',
                text: 'Mohon lengkapi semua field yang wajib diisi.',
                icon: 'warning',
                confirmButtonText: 'OK'
            });
        }
    });
});
</script>
