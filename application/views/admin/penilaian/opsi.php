<?php

?>
<div class="row">
  <div class="col-12">
    <div class="card mb-4">
      <div class="card-header pb-0">
        <div class="d-flex justify-content-between align-items-center">
          <h6>Kelola Opsi Soal</h6>
          <a href="<?= base_url('admin/soal-penilaian/' . $question->assessment_id) ?>" class="btn btn-sm btn-outline-primary">
            <i class="fas fa-arrow-left me-2"></i> Kembali ke Daftar Soal
          </a>
        </div>
        <p class="text-sm mb-0">
          <i class="fa fa-info-circle text-primary" aria-hidden="true"></i>
          Atur opsi jawaban untuk soal ini
        </p>
      </div>
    </div>
  </div>
</div>

<!-- Question Info Card -->
<div class="row">
  <div class="col-12">
    <div class="card mb-4">
      <div class="card-header pb-0">
        <h6>Informasi Soal</h6>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-8">
            <p class="text-xs text-secondary mb-1">Teks Soal:</p>
            <div class="border p-3 rounded">
              <?= $question->teks_soal ?>
            </div>
          </div>
          <div class="col-md-4">
            <p class="text-xs text-secondary mb-1">Tipe Soal:</p>
            <p class="text-sm mb-2">
              <?php
              switch($question->jenis_soal) {
                case 'pilihan_ganda':
                  echo 'Pilihan Ganda';
                  break;
                case 'benar_salah':
                  echo 'Benar/Salah';
                  break;
                default:
                  echo ucfirst($question->jenis_soal);
              }
              ?>
            </p>
            <p class="text-xs text-secondary mb-1">Poin:</p>
            <p class="text-sm mb-2"><?= $question->poin ?> poin</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Options Management -->
<div class="row">
  <div class="col-12">
    <div class="card mb-4">
      <div class="card-header pb-0">
        <h6>Opsi Jawaban</h6>
      </div>
      <div class="card-body">
        <?= form_open('admin/simpan-opsi-soal/' . $question->id, ['class' => 'needs-validation']) ?>

          <?php if ($question->jenis_soal == 'benar_salah') : ?>
            <!-- True/False Options -->
            <div class="form-group">
              <label class="form-control-label">Pilih Jawaban yang Benar <span class="text-danger">*</span></label>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="correct_option" id="true_option" value="true"
                       <?= (isset($options[0]) && $options[0]->teks_pilihan == 'Benar' && $options[0]->benar) ? 'checked' : '' ?> required>
                <label class="form-check-label" for="true_option">
                  Benar
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="correct_option" id="false_option" value="false"
                       <?= (isset($options[1]) && $options[1]->teks_pilihan == 'Salah' && $options[1]->benar) ? 'checked' : '' ?> required>
                <label class="form-check-label" for="false_option">
                  Salah
                </label>
              </div>
            </div>

          <?php else : ?>
            <!-- Multiple Choice Options -->
            <div id="options-container">
              <?php if (!empty($options)) : ?>
                <?php foreach ($options as $index => $option) : ?>
                  <div class="option-item mb-3">
                    <div class="row">
                      <div class="col-md-1">
                        <div class="form-check mt-2">
                          <input class="form-check-input" type="radio" name="correct_option" value="<?= $index ?>"
                                 <?= $option->benar ? 'checked' : '' ?> required>
                        </div>
                      </div>
                      <div class="col-md-10">
                        <input type="hidden" name="option_ids[]" value="<?= $option->id ?>">
                        <input type="text" class="form-control" name="options[]" value="<?= $option->teks_pilihan ?>"
                               placeholder="Masukkan teks opsi..." required>
                      </div>
                      <div class="col-md-1">
                        <button type="button" class="btn btn-danger btn-sm remove-option" onclick="removeOption(this)">
                          <i class="fas fa-trash"></i>
                        </button>
                      </div>
                    </div>
                  </div>
                <?php endforeach; ?>
              <?php else : ?>
                <!-- Default 4 options for new questions -->
                <?php for ($i = 0; $i < 4; $i++) : ?>
                  <div class="option-item mb-3">
                    <div class="row">
                      <div class="col-md-1">
                        <div class="form-check mt-2">
                          <input class="form-check-input" type="radio" name="correct_option" value="<?= $i ?>"
                                 <?= $i == 0 ? 'checked' : '' ?> required>
                        </div>
                      </div>
                      <div class="col-md-10">
                        <input type="text" class="form-control" name="options[]" value=""
                               placeholder="Masukkan teks opsi..." required>
                      </div>
                      <div class="col-md-1">
                        <button type="button" class="btn btn-danger btn-sm remove-option" onclick="removeOption(this)">
                          <i class="fas fa-trash"></i>
                        </button>
                      </div>
                    </div>
                  </div>
                <?php endfor; ?>
              <?php endif; ?>
            </div>

            <div class="mb-3">
              <button type="button" class="btn btn-outline-primary btn-sm" onclick="addOption()">
                <i class="fas fa-plus me-2"></i> Tambah Opsi
              </button>
            </div>

            <div class="alert alert-info">
              <i class="fas fa-info-circle me-2"></i>
              <strong>Petunjuk:</strong> Pilih radio button di sebelah kiri untuk menandai jawaban yang benar.
              Minimal harus ada 2 opsi jawaban.
            </div>
          <?php endif; ?>

          <div class="d-flex justify-content-end mt-4">
            <a href="<?= base_url('admin/soal-penilaian/' . $question->assessment_id) ?>" class="btn btn-light me-2">Batal</a>
            <button type="submit" class="btn btn-primary">
              <i class="fas fa-save me-2"></i> Simpan Opsi
            </button>
          </div>
        <?= form_close() ?>
      </div>
    </div>
  </div>
</div>

<script>
let optionCount = <?= !empty($options) ? count($options) : 4 ?>;

function addOption() {
    const container = document.getElementById('options-container');
    const optionHtml = `
        <div class="option-item mb-3">
            <div class="row">
                <div class="col-md-1">
                    <div class="form-check mt-2">
                        <input class="form-check-input" type="radio" name="correct_option" value="${optionCount}" required>
                    </div>
                </div>
                <div class="col-md-10">
                    <input type="text" class="form-control" name="options[]" value=""
                           placeholder="Masukkan teks opsi..." required>
                </div>
                <div class="col-md-1">
                    <button type="button" class="btn btn-danger btn-sm remove-option" onclick="removeOption(this)">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
        </div>
    `;
    container.insertAdjacentHTML('beforeend', optionHtml);
    optionCount++;
    updateRadioValues();
}

function removeOption(button) {
    const optionItems = document.querySelectorAll('.option-item');
    if (optionItems.length > 2) {
        button.closest('.option-item').remove();
        updateRadioValues();
    } else {
        Swal.fire({
            title: 'Tidak Dapat Menghapus',
            text: 'Minimal harus ada 2 opsi jawaban.',
            icon: 'warning',
            confirmButtonText: 'OK'
        });
    }
}

function updateRadioValues() {
    const radioButtons = document.querySelectorAll('input[name="correct_option"]');
    radioButtons.forEach((radio, index) => {
        radio.value = index;
    });
}

$(document).ready(function() {
    
    $('form').on('submit', function(e) {
        let isValid = true;

        <?php if ($question->jenis_soal == 'pilihan_ganda') : ?>
        
        let filledOptions = 0;
        $('input[name="options[]"]').each(function() {
            if ($(this).val().trim()) {
                filledOptions++;
            }
        });

        if (filledOptions < 2) {
            isValid = false;
            Swal.fire({
                title: 'Opsi Tidak Lengkap',
                text: 'Minimal harus ada 2 opsi jawaban yang diisi.',
                icon: 'warning',
                confirmButtonText: 'OK'
            });
        }

        
        if (!$('input[name="correct_option"]:checked').length) {
            isValid = false;
            Swal.fire({
                title: 'Jawaban Benar Belum Dipilih',
                text: 'Mohon pilih jawaban yang benar.',
                icon: 'warning',
                confirmButtonText: 'OK'
            });
        }
        <?php endif; ?>

        if (!isValid) {
            e.preventDefault();
        }
    });
});
</script>
