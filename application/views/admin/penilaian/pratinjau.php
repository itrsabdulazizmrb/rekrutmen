<?php

?>
<div class="row">
  <div class="col-12">
    <div class="card mb-4">
      <div class="card-header pb-0">
        <div class="d-flex justify-content-between align-items-center">
          <h6>Pratinjau Penilaian: <?= $assessment->judul ?></h6>
          <div>
            <a href="<?= base_url('admin/soal_penilaian/' . $assessment->id) ?>" class="btn btn-sm btn-outline-primary me-2">
              <i class="fas fa-edit me-2"></i> Kelola Soal
            </a>
            <a href="<?= base_url('admin/penilaian') ?>" class="btn btn-sm btn-outline-primary">
              <i class="fas fa-arrow-left me-2"></i> Kembali
            </a>
          </div>
        </div>
        <p class="text-sm mb-0">
          <i class="fa fa-info-circle text-primary" aria-hidden="true"></i>
          Pratinjau penilaian seperti yang akan dilihat oleh peserta
        </p>
      </div>
    </div>
  </div>
</div>

<!-- Assessment Info -->
<div class="row">
  <div class="col-12">
    <div class="card mb-4">
      <div class="card-header pb-0">
        <h6>Informasi Penilaian</h6>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-8">
            <h5 class="mb-3"><?= $assessment->judul ?></h5>
            <p class="text-sm mb-3"><?= $assessment->deskripsi ?></p>
            
            <?php if ($assessment->petunjuk) : ?>
              <div class="alert alert-info">
                <h6 class="alert-heading"><i class="fas fa-info-circle me-2"></i>Petunjuk Pengerjaan:</h6>
                <p class="mb-0"><?= nl2br($assessment->petunjuk) ?></p>
              </div>
            <?php endif; ?>
          </div>
          <div class="col-md-4">
            <div class="card border">
              <div class="card-body">
                <h6 class="card-title">Detail Penilaian</h6>
                <ul class="list-unstyled mb-0">
                  <li class="mb-2">
                    <i class="fas fa-clock text-primary me-2"></i>
                    <strong>Batas Waktu:</strong> <?= $assessment->batas_waktu ? $assessment->batas_waktu . ' menit' : 'Tidak terbatas' ?>
                  </li>
                  <li class="mb-2">
                    <i class="fas fa-trophy text-warning me-2"></i>
                    <strong>Nilai Lulus:</strong> <?= $assessment->nilai_lulus ? $assessment->nilai_lulus . ' poin' : 'Tidak ditentukan' ?>
                  </li>
                  <li class="mb-2">
                    <i class="fas fa-redo text-info me-2"></i>
                    <strong>Percobaan:</strong> <?= $assessment->maksimal_percobaan ?> kali
                  </li>
                  <li class="mb-2">
                    <i class="fas fa-question-circle text-success me-2"></i>
                    <strong>Total Soal:</strong> <?= count($questions) ?> soal
                  </li>
                  <li>
                    <i class="fas fa-star text-danger me-2"></i>
                    <strong>Total Poin:</strong> <?= array_sum(array_column($questions, 'poin')) ?> poin
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Questions Preview -->
<div class="row">
  <div class="col-12">
    <div class="card mb-4">
      <div class="card-header pb-0">
        <h6>Pratinjau Soal (<?= count($questions) ?> soal)</h6>
      </div>
      <div class="card-body">
        <?php if (!empty($questions)) : ?>
          <?php foreach ($questions as $index => $question) : ?>
            <div class="question-item mb-4 p-3 border rounded">
              <div class="d-flex justify-content-between align-items-start mb-3">
                <h6 class="mb-0">Soal <?= $index + 1 ?></h6>
                <div class="text-end">
                  <span class="badge bg-gradient-info"><?= ucfirst(str_replace('_', ' ', $question->jenis_soal)) ?></span>
                  <span class="badge bg-gradient-success"><?= $question->poin ?> poin</span>
                </div>
              </div>
              
              <div class="question-text mb-3">
                <?= $question->teks_soal ?>
              </div>
              
              <?php if ($question->jenis_soal == 'pilihan_ganda' || $question->jenis_soal == 'benar_salah') : ?>
                <div class="options">
                  <h6 class="text-sm mb-2">Pilihan Jawaban:</h6>
                  <?php if (!empty($question->options)) : ?>
                    <?php foreach ($question->options as $opt_index => $option) : ?>
                      <div class="form-check mb-2">
                        <input class="form-check-input" type="radio" name="question_<?= $question->id ?>" disabled>
                        <label class="form-check-label <?= $option->benar ? 'text-success fw-bold' : '' ?>">
                          <?= chr(65 + $opt_index) ?>. <?= $option->teks_pilihan ?>
                          <?php if ($option->benar) : ?>
                            <i class="fas fa-check-circle text-success ms-2"></i>
                          <?php endif; ?>
                        </label>
                      </div>
                    <?php endforeach; ?>
                  <?php else : ?>
                    <p class="text-muted small">Opsi jawaban belum diatur</p>
                  <?php endif; ?>
                </div>
              <?php elseif ($question->jenis_soal == 'esai') : ?>
                <div class="essay-area">
                  <h6 class="text-sm mb-2">Area Jawaban Esai:</h6>
                  <textarea class="form-control" rows="4" placeholder="Peserta akan mengetik jawaban di sini..." disabled></textarea>
                </div>
              <?php elseif ($question->jenis_soal == 'unggah_file') : ?>
                <div class="upload-area">
                  <h6 class="text-sm mb-2">Area Unggah File:</h6>
                  <div class="border border-dashed p-3 text-center text-muted">
                    <i class="fas fa-cloud-upload-alt fa-2x mb-2"></i>
                    <p class="mb-0">Peserta akan mengunggah file jawaban di sini</p>
                  </div>
                </div>
              <?php endif; ?>
            </div>
          <?php endforeach; ?>
        <?php else : ?>
          <div class="text-center py-4">
            <i class="fas fa-question-circle fa-3x text-secondary mb-3"></i>
            <h6 class="text-secondary">Belum ada soal</h6>
            <p class="text-xs text-secondary mb-3">Tambahkan soal untuk melihat pratinjau penilaian</p>
            <a href="<?= base_url('admin/tambah_soal/' . $assessment->id) ?>" class="btn btn-primary btn-sm">
              <i class="fas fa-plus me-2"></i> Tambah Soal
            </a>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>

<script>
$(document).ready(function() {
    
    $('#printPreview').on('click', function() {
        window.print();
    });
});


document.addEventListener('DOMContentLoaded', function() {
    const style = document.createElement('style');
    style.textContent = `
        @media print {
            .btn, .card-header .d-flex > div:last-child {
                display: none !important;
            }
            .card {
                border: 1px solid #dee2e6 !important;
                box-shadow: none !important;
            }
        }
    `;
    document.head.appendChild(style);
});
</script>
