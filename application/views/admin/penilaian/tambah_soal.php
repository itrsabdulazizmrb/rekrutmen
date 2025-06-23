<?php

?>
<div class="row">
  <div class="col-12">
    <div class="card mb-4">
      <div class="card-header pb-0">
        <div class="d-flex justify-content-between align-items-center">
          <h6>Tambah Soal Baru</h6>
          <a href="<?= base_url('admin/soal-penilaian/' . $assessment->id) ?>" class="btn btn-sm btn-outline-primary">
            <i class="fas fa-arrow-left me-2"></i> Kembali ke Daftar Soal
          </a>
        </div>
        <p class="text-sm mb-0">
          <i class="fa fa-info-circle text-primary" aria-hidden="true"></i>
          <span class="font-weight-bold">Tambahkan soal baru untuk penilaian: <?= $assessment->judul ?></span>
        </p>
      </div>
      <div class="card-body">
        <?= form_open_multipart('admin/tambah-soal/' . $assessment->id, ['class' => 'needs-validation']) ?>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="question_type" class="form-control-label">Tipe Soal <span class="text-danger">*</span></label>
                <select id="question_type" name="question_type" class="form-control">
                  <option value="">Pilih Tipe Soal</option>
                  <option value="pilihan_ganda" <?= set_select('question_type', 'pilihan_ganda') ?>>Pilihan Ganda</option>
                  <!-- <option value="benar_salah" <?= set_select('question_type', 'benar_salah') ?>>Benar/Salah</option> -->
                  <option value="esai" <?= set_select('question_type', 'esai') ?>>Esai</option>
                  <!-- <option value="unggah_file" <?= set_select('question_type', 'unggah_file') ?>>Unggah File</option> -->
                </select>
                <?= form_error('question_type', '<small class="text-danger">', '</small>') ?>
                <small class="form-text text-muted">Pilih tipe soal yang sesuai.</small>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="points" class="form-control-label">Poin Soal <span class="text-danger">*</span></label>
                <input type="number" class="form-control" id="points" name="points" value="<?= set_value('points', 1) ?>" min="1" required>
                <?= form_error('points', '<small class="text-danger">', '</small>') ?>
                <small class="form-text text-muted">Berapa poin yang diberikan untuk soal ini.</small>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="question_text" class="form-control-label">Teks Soal <span class="text-danger">*</span></label>
                <textarea class="form-control" id="question_text" name="question_text" rows="6" required><?= set_value('question_text') ?></textarea>
                <?= form_error('question_text', '<small class="text-danger">', '</small>') ?>
                <small class="form-text text-muted">Tulis pertanyaan dengan jelas dan lengkap. Anda dapat menggunakan HTML untuk formatting.</small>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="question_image" class="form-control-label">Gambar Soal (Opsional)</label>
                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="question_image" name="question_image" accept="image/*">
                  <label class="custom-file-label" for="question_image">Pilih gambar...</label>
                </div>
                <small class="form-text text-muted">Format yang didukung: JPG, JPEG, PNG, GIF. Maksimal ukuran: 4MB.</small>

                <!-- Image Preview -->
                <div id="image-preview" class="mt-3" style="display: none;">
                  <div class="card" style="max-width: 300px;">
                    <img id="preview-img" src="" class="card-img-top" alt="Preview Gambar">
                    <div class="card-body p-2">
                      <small class="text-muted">Preview Gambar</small>
                      <button type="button" class="btn btn-sm btn-danger float-end" id="remove-image">
                        <i class="fas fa-times"></i>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="d-flex justify-content-end mt-4">
            <a href="<?= base_url('admin/soal-penilaian/' . $assessment->id) ?>" class="btn btn-light me-2">Batal</a>
            <button type="submit" class="btn btn-primary">
              <i class="fas fa-save me-2"></i> Simpan Soal
            </button>
          </div>
        <?= form_close() ?>
      </div>
    </div>
  </div>
</div>

<!-- Assessment Info Card -->
<div class="row">
  <div class="col-12">
    <div class="card mb-4">
      <div class="card-header pb-0">
        <h6>Informasi Penilaian</h6>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-6">
            <p class="text-xs text-secondary mb-1">Judul Penilaian:</p>
            <p class="text-sm mb-2"><?= $assessment->judul ?></p>
          </div>
          <div class="col-md-6">
            <p class="text-xs text-secondary mb-1">Tipe Penilaian:</p>
            <p class="text-sm mb-2"><?= $assessment->type_name ?></p>
          </div>
          <div class="col-md-6">
            <p class="text-xs text-secondary mb-1">Batas Waktu:</p>
            <p class="text-sm mb-2"><?= $assessment->batas_waktu ? $assessment->batas_waktu . ' menit' : 'Tidak ada batas waktu' ?></p>
          </div>
          <div class="col-md-6">
            <p class="text-xs text-secondary mb-1">Nilai Kelulusan:</p>
            <p class="text-sm mb-2"><?= $assessment->nilai_lulus ? $assessment->nilai_lulus . ' poin' : 'Tidak ditentukan' ?></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
$(document).ready(function() {
    
    if (typeof tinymce !== 'undefined') {
        tinymce.init({
            selector: '#question_text',
            height: 300,
            menubar: false,
            plugins: [
                'advlist autolink lists link image charmap print preview anchor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime media table paste code help wordcount'
            ],
            toolbar: 'undo redo | formatselect | bold italic backcolor | \
                     alignleft aligncenter alignright alignjustify | \
                     bullist numlist outdent indent | removeformat | help',
            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
        });
    }

    
    $('form').on('submit', function(e) {
        let isValid = true;

        
        $('input[required], select[required], textarea[required]').each(function() {
            if (!$(this).val()) {
                isValid = false;
                $(this).addClass('is-invalid');
            } else {
                $(this).removeClass('is-invalid');
            }
        });

        
        if (typeof tinymce !== 'undefined') {
            let content = tinymce.get('question_text').getContent();
            if (!content.trim()) {
                isValid = false;
                $('#question_text').addClass('is-invalid');
            }
        }

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

    
    $('#question_type').on('change', function() {
        let type = $(this).val();
        let helpText = '';

        switch(type) {
            case 'pilihan_ganda':
                helpText = 'Setelah menyimpan soal, Anda akan diarahkan untuk menambahkan opsi jawaban.';
                break;
            case 'benar_salah':
                helpText = 'Setelah menyimpan soal, Anda akan diarahkan untuk mengatur jawaban benar/salah.';
                break;
            case 'esai':
                helpText = 'Soal esai akan dinilai secara manual oleh admin.';
                break;
            case 'unggah_file':
                helpText = 'Peserta akan diminta untuk mengunggah file sebagai jawaban.';
                break;
        }

        if (helpText) {
            $(this).siblings('.form-text').text(helpText);
        }
    });

    
    $('#question_image').on('change', function() {
        const file = this.files[0];
        if (file) {
            
            const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
            if (!allowedTypes.includes(file.type)) {
                Swal.fire({
                    title: 'Format File Tidak Valid',
                    text: 'Hanya file gambar (JPG, JPEG, PNG, GIF) yang diperbolehkan.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
                $(this).val('');
                return;
            }

            
            if (file.size > 4 * 1024 * 1024) {
                Swal.fire({
                    title: 'Ukuran File Terlalu Besar',
                    text: 'Ukuran file maksimal adalah 4MB.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
                $(this).val('');
                return;
            }

            
            const reader = new FileReader();
            reader.onload = function(e) {
                $('#preview-img').attr('src', e.target.result);
                $('#image-preview').show();
            };
            reader.readAsDataURL(file);

            
            $(this).next('.custom-file-label').text(file.name);
        }
    });

    
    $('#remove-image').on('click', function() {
        $('#question_image').val('');
        $('#question_image').next('.custom-file-label').text('Pilih gambar...');
        $('#image-preview').hide();
    });
});
</script>
