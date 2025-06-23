<div class="row">
  <div class="col-12">
    <div class="card mb-4">
      <div class="card-header pb-0">
        <div class="d-flex justify-content-between align-items-center">
          <div>
            <h6 class="mb-0"><?= $assessment->judul ?></h6>
            <p class="text-sm mb-0">
              <i class="fa fa-info-circle text-primary" aria-hidden="true"></i>
              <span class="font-weight-bold">Penilaian <?= $assessment->type_name ?></span>
            </p>
          </div>
          <?php if ($assessment->batas_waktu) : ?>
            <div class="bg-gradient-danger px-3 py-2 rounded text-white">
              <div class="d-flex align-items-center">
                <i class="ni ni-time-alarm me-2"></i>
                <span id="assessment-timer" data-time-limit="<?= $assessment->batas_waktu ?>"><?= $assessment->batas_waktu ?>:00</span>
              </div>
            </div>
          <?php endif; ?>
        </div>
      </div>
      <div class="card-body">
        <?php if ($assessment->deskripsi) : ?>
          <div class="alert alert-info" role="alert">
            <h6 class="alert-heading mb-1">Deskripsi Penilaian</h6>
            <p class="mb-0"><?= $assessment->deskripsi ?></p>
          </div>
        <?php endif; ?>

        <?php if (empty($questions)) : ?>
          <div class="text-center py-5">
            <h4 class="text-secondary">Tidak ada pertanyaan ditemukan</h4>
            <p class="text-muted">Penilaian ini belum memiliki pertanyaan.</p>
            <a href="<?= base_url('pelamar/penilaian') ?>" class="btn btn-primary mt-3">Kembali ke Daftar Penilaian</a>
          </div>
        <?php else : ?>
          <?= form_open('pelamar/kirim-penilaian', ['id' => 'assessment-form']) ?>
            <input type="hidden" name="assessment_id" value="<?= $assessment->id ?>">
            <input type="hidden" name="application_id" value="<?= $application_id ?>">
            <input type="hidden" name="applicant_assessment_id" value="<?= $applicant_assessment->id ?>">

            <?php $question_number = 1; ?>
            <?php foreach ($questions as $question) : ?>
              <div class="question-card mb-4">
                <h6 class="mb-3">Pertanyaan <?= $question_number ?>:</h6>

                <!-- Gambar Soal (jika ada) -->
                <?php if (!empty($question->gambar_soal)) : ?>
                  <div class="question-image mb-3">
                    <img src="<?= base_url('uploads/gambar_soal/' . $question->gambar_soal) ?>"
                         class="img-fluid rounded shadow-sm question-img"
                         alt="Gambar Soal <?= $question_number ?>"
                         style="max-width: 100%; height: auto; cursor: pointer;"
                         data-bs-toggle="modal"
                         data-bs-target="#imageModal<?= $question->id ?>">
                    <small class="text-muted d-block mt-1">
                      <i class="fas fa-search-plus"></i> Klik gambar untuk memperbesar
                    </small>
                  </div>

                  <!-- Modal untuk memperbesar gambar -->
                  <div class="modal fade" id="imageModal<?= $question->id ?>" tabindex="-1" aria-labelledby="imageModalLabel<?= $question->id ?>" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="imageModalLabel<?= $question->id ?>">Gambar Soal <?= $question_number ?></h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-center">
                          <img src="<?= base_url('uploads/gambar_soal/' . $question->gambar_soal) ?>"
                               class="img-fluid"
                               alt="Gambar Soal <?= $question_number ?>">
                        </div>
                      </div>
                    </div>
                  </div>
                <?php endif; ?>

                <!-- Teks Soal -->
                <div class="question-text mb-3">
                  <?= $question->teks_soal ?>
                </div>

                <?php if ($question->jenis_soal == 'pilihan_ganda' || $question->jenis_soal == 'multiple_choice') : ?>
                  <?php
                  
                  $this->db->where('id_soal', $question->id);
                  $options_query = $this->db->get('pilihan_soal');
                  $options = $options_query->result();
                  ?>

                  <?php foreach ($options as $option) : ?>
                    <div class="option-item mb-2 p-3 border rounded" data-question-id="<?= $question->id ?>" data-option-id="<?= $option->id ?>">
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="question_<?= $question->id ?>" id="option_<?= $option->id ?>" value="<?= $option->id ?>">
                        <label class="form-check-label" for="option_<?= $option->id ?>">
                          <?= $option->teks_pilihan ?>
                        </label>
                      </div>
                    </div>
                  <?php endforeach; ?>

                <?php elseif ($question->jenis_soal == 'benar_salah' || $question->jenis_soal == 'true_false') : ?>
                  <?php
                  
                  $this->db->where('id_soal', $question->id);
                  $options_query = $this->db->get('pilihan_soal');
                  $options = $options_query->result();
                  ?>

                  <?php if (!empty($options)) : ?>
                    <?php foreach ($options as $option) : ?>
                      <div class="option-item mb-2 p-3 border rounded" data-question-id="<?= $question->id ?>" data-option-id="<?= $option->id ?>">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="question_<?= $question->id ?>" id="option_<?= $option->id ?>" value="<?= $option->id ?>">
                          <label class="form-check-label" for="option_<?= $option->id ?>">
                            <?= $option->teks_pilihan ?>
                          </label>
                        </div>
                      </div>
                    <?php endforeach; ?>
                  <?php else : ?>
                    <!-- Fallback for true/false if no options in database -->
                    <div class="option-item mb-2 p-3 border rounded" data-question-id="<?= $question->id ?>" data-option-id="true">
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="question_<?= $question->id ?>" id="option_<?= $question->id ?>_true" value="true">
                        <label class="form-check-label" for="option_<?= $question->id ?>_true">
                          Benar
                        </label>
                      </div>
                    </div>
                    <div class="option-item mb-2 p-3 border rounded" data-question-id="<?= $question->id ?>" data-option-id="false">
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="question_<?= $question->id ?>" id="option_<?= $question->id ?>_false" value="false">
                        <label class="form-check-label" for="option_<?= $question->id ?>_false">
                          Salah
                        </label>
                      </div>
                    </div>
                  <?php endif; ?>

                <?php elseif ($question->jenis_soal == 'esai' || $question->jenis_soal == 'essay') : ?>
                  <div class="form-group">
                    <textarea name="question_<?= $question->id ?>" class="form-control" rows="5" placeholder="Ketik jawaban Anda di sini..."></textarea>
                  </div>

                <?php elseif ($question->jenis_soal == 'unggah_file' || $question->jenis_soal == 'file_upload') : ?>
                  <div class="form-group">
                    <input type="file" name="question_<?= $question->id ?>" class="form-control" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                    <small class="text-muted">Jenis file yang diizinkan: PDF, DOC, DOCX, JPG, JPEG, PNG. Ukuran maksimal: 2MB</small>
                  </div>
                <?php endif; ?>

                <div class="d-flex justify-content-between align-items-center mt-3">
                  <span class="badge bg-gradient-<?= ($question->jenis_soal == 'pilihan_ganda' || $question->jenis_soal == 'multiple_choice') ? 'primary' : (($question->jenis_soal == 'benar_salah' || $question->jenis_soal == 'true_false') ? 'info' : (($question->jenis_soal == 'esai' || $question->jenis_soal == 'essay') ? 'warning' : 'success')) ?>">
                    <?= ucfirst(str_replace('_', ' ', $question->jenis_soal)) ?>
                  </span>
                  <span class="text-xs text-muted">Poin: <?= $question->poin ?></span>
                </div>
              </div>

              <?php $question_number++; ?>
            <?php endforeach; ?>

            <div class="d-flex justify-content-between mt-4">
              <a href="<?= base_url('pelamar/penilaian') ?>" class="btn btn-outline-secondary">Batal</a>
              <button type="submit" class="btn btn-primary">Kirim Jawaban</button>
            </div>
          <?= form_close() ?>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>

<style>
.question-img {
    transition: transform 0.2s ease-in-out;
    border: 2px solid #e9ecef;
}

.question-img:hover {
    transform: scale(1.02);
    border-color: #007bff;
}

.question-card {
    border: 1px solid #e9ecef;
    border-radius: 8px;
    padding: 20px;
    background-color: #fff;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.question-image {
    text-align: center;
}

@media (max-width: 768px) {
    .question-img {
        max-width: 100%;
        height: auto;
    }

    .modal-dialog {
        margin: 10px;
    }
}
</style>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    
    
    console.log('Halaman ujian dimuat. Status: <?= $applicant_assessment->status ?>');

    
    const assessmentTimer = document.getElementById('assessment-timer');
    if (assessmentTimer) {
      const timeLimit = parseInt(assessmentTimer.getAttribute('data-time-limit')) * 60; 
      let timeRemaining = timeLimit;

      const timerInterval = setInterval(function() {
        timeRemaining--;

        const minutes = Math.floor(timeRemaining / 60);
        const seconds = timeRemaining % 60;

        assessmentTimer.textContent = minutes.toString().padStart(2, '0') + ':' + seconds.toString().padStart(2, '0');

        if (timeRemaining <= 300) { 
          assessmentTimer.classList.add('text-danger');
        }

        if (timeRemaining <= 0) {
          clearInterval(timerInterval);
          Swal.fire({
            icon: 'warning',
            title: 'Waktu Habis!',
            text: 'Penilaian Anda akan dikirimkan secara otomatis.',
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true
          }).then(() => {
            document.getElementById('assessment-form').submit();
          });
        }
      }, 1000);
    }

    
    const optionItems = document.querySelectorAll('.option-item');
    optionItems.forEach(function(item) {
      item.addEventListener('click', function() {
        const questionId = this.getAttribute('data-question-id');
        const optionId = this.getAttribute('data-option-id');
        const radioInput = document.querySelector('input[name="question_' + questionId + '"][value="' + optionId + '"]');

        
        const questionOptions = document.querySelectorAll('.option-item[data-question-id="' + questionId + '"]');
        questionOptions.forEach(function(option) {
          option.classList.remove('selected');
        });

        
        this.classList.add('selected');

        
        if (radioInput) {
          radioInput.checked = true;
        }
      });
    });
  });
</script>
