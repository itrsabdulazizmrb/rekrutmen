<div class="row">
  <div class="col-12">
    <div class="card mb-4">
      <div class="card-header pb-0">
        <div class="d-flex justify-content-between align-items-center">
          <div>
            <h6>Detail Hasil Penilaian</h6>
            <p class="text-sm mb-0">
              <i class="fa fa-info-circle text-primary" aria-hidden="true"></i>
              <span class="font-weight-bold">Detail jawaban dan hasil penilaian pelamar</span>
            </p>
          </div>
          <div>
            <a href="<?= base_url('admin/hasil-penilaian/' . $assessment->id) ?>" class="btn btn-sm btn-outline-primary">
              <i class="fas fa-arrow-left me-2"></i> Kembali ke Hasil Penilaian
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Informasi Pelamar dan Penilaian -->
<div class="row">
  <div class="col-md-6">
    <div class="card mb-4">
      <div class="card-header pb-0">
        <h6>Informasi Pelamar</h6>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-sm-4">
            <p class="text-sm font-weight-bold mb-1">Nama:</p>
          </div>
          <div class="col-sm-8">
            <p class="text-sm mb-1"><?= $applicant_assessment->applicant_name ?></p>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-4">
            <p class="text-sm font-weight-bold mb-1">Email:</p>
          </div>
          <div class="col-sm-8">
            <p class="text-sm mb-1"><?= $applicant_assessment->applicant_email ?></p>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-4">
            <p class="text-sm font-weight-bold mb-1">Lowongan:</p>
          </div>
          <div class="col-sm-8">
            <p class="text-sm mb-1"><?= $applicant_assessment->job_title ?></p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-6">
    <div class="card mb-4">
      <div class="card-header pb-0">
        <h6>Informasi Penilaian</h6>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-sm-4">
            <p class="text-sm font-weight-bold mb-1">Judul:</p>
          </div>
          <div class="col-sm-8">
            <p class="text-sm mb-1"><?= $applicant_assessment->assessment_title ?></p>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-4">
            <p class="text-sm font-weight-bold mb-1">Jenis:</p>
          </div>
          <div class="col-sm-8">
            <p class="text-sm mb-1"><?= $applicant_assessment->type_name ?></p>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-4">
            <p class="text-sm font-weight-bold mb-1">Status:</p>
          </div>
          <div class="col-sm-8">
            <span class="badge badge-sm bg-gradient-<?= $applicant_assessment->status == 'belum_mulai' ? 'secondary' : ($applicant_assessment->status == 'sedang_berlangsung' ? 'warning' : ($applicant_assessment->status == 'selesai' ? 'success' : 'info')) ?>">
              <?= $applicant_assessment->status == 'belum_mulai' ? 'Belum Dimulai' : ($applicant_assessment->status == 'sedang_berlangsung' ? 'Sedang Berlangsung' : ($applicant_assessment->status == 'selesai' ? 'Selesai' : 'Sudah Dinilai')) ?>
            </span>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-4">
            <p class="text-sm font-weight-bold mb-1">Nilai:</p>
          </div>
          <div class="col-sm-8">
            <p class="text-sm mb-1">
              <?php if ($applicant_assessment->nilai !== null) : ?>
                <span class="text-<?= $applicant_assessment->nilai >= $applicant_assessment->passing_score ? 'success' : 'danger' ?> font-weight-bold">
                  <?= $applicant_assessment->nilai ?>%
                </span>
                <?php if ($applicant_assessment->passing_score) : ?>
                  <small class="text-muted">(Nilai Lulus: <?= $applicant_assessment->passing_score ?>%)</small>
                <?php endif; ?>
              <?php else : ?>
                <span class="text-muted">Belum dinilai</span>
              <?php endif; ?>
            </p>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-4">
            <p class="text-sm font-weight-bold mb-1">Waktu Mulai:</p>
          </div>
          <div class="col-sm-8">
            <p class="text-sm mb-1"><?= $applicant_assessment->waktu_mulai ? date('d/m/Y H:i', strtotime($applicant_assessment->waktu_mulai)) : '-' ?></p>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-4">
            <p class="text-sm font-weight-bold mb-1">Waktu Selesai:</p>
          </div>
          <div class="col-sm-8">
            <p class="text-sm mb-1"><?= $applicant_assessment->waktu_selesai ? date('d/m/Y H:i', strtotime($applicant_assessment->waktu_selesai)) : '-' ?></p>
          </div>
        </div>
        <?php if ($applicant_assessment->status == 'selesai') : ?>
          <div class="row mt-3">
            <div class="col-12">
              <button type="button" class="btn btn-sm btn-success" onclick="konfirmasiTandaiSudahDinilai(<?= $applicant_assessment->id ?>)">
                <i class="fas fa-check-circle me-2"></i> Tandai Sudah Dinilai
              </button>
            </div>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>

<!-- Detail Jawaban -->
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header pb-0">
        <h6>Detail Jawaban Pelamar</h6>
        <p class="text-sm mb-0">
          <i class="fa fa-info-circle text-primary" aria-hidden="true"></i>
          <span class="font-weight-bold">Jawaban yang diberikan oleh pelamar untuk setiap pertanyaan</span>
        </p>
      </div>
      <div class="card-body">
        <?php if (empty($questions_with_answers)) : ?>
          <div class="text-center py-5">
            <h4 class="text-secondary">Tidak ada pertanyaan ditemukan</h4>
            <p class="text-muted">Penilaian ini belum memiliki pertanyaan atau pelamar belum menjawab.</p>
          </div>
        <?php else : ?>
          <?php foreach ($questions_with_answers as $index => $question) : ?>
            <div class="card mb-3 border">
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-start mb-3">
                  <h6 class="mb-0">Pertanyaan <?= $index + 1 ?></h6>
                  <?php if ($question->jenis_soal == 'pilihan_ganda' || $question->jenis_soal == 'benar_salah') : ?>
                    <span class="badge badge-sm bg-gradient-<?= isset($question->is_correct) && $question->is_correct ? 'success' : 'danger' ?>">
                      <?= isset($question->is_correct) && $question->is_correct ? 'Benar' : 'Salah' ?>
                    </span>
                  <?php endif; ?>
                </div>

                <div class="mb-3">
                  <p class="text-sm mb-2"><strong>Pertanyaan:</strong></p>
                  <p class="text-sm"><?= $question->teks_soal ?></p>
                </div>

                <?php if ($question->jenis_soal == 'pilihan_ganda' || $question->jenis_soal == 'benar_salah') : ?>
                  <div class="mb-3">
                    <p class="text-sm mb-2"><strong>Pilihan Jawaban:</strong></p>
                    <?php if (isset($question->options) && !empty($question->options)) : ?>
                      <?php foreach ($question->options as $option) : ?>
                        <div class="form-check mb-1">
                          <input class="form-check-input" type="radio" disabled
                                 <?= ($question->id_pilihan_terpilih == $option->id) ? 'checked' : '' ?>>
                          <label class="form-check-label text-sm
                                 <?= ($question->id_pilihan_terpilih == $option->id) ? 'font-weight-bold' : '' ?>
                                 <?= $option->benar ? 'text-success' : '' ?>">
                            <?= $option->teks_pilihan ?>
                            <?php if ($option->benar) : ?>
                              <i class="fas fa-check text-success ms-2"></i>
                            <?php endif; ?>
                          </label>
                        </div>
                      <?php endforeach; ?>
                    <?php endif; ?>
                  </div>

                  <div class="mb-2">
                    <p class="text-sm mb-1"><strong>Jawaban Pelamar:</strong></p>
                    <p class="text-sm <?= isset($question->is_correct) && $question->is_correct ? 'text-success' : 'text-danger' ?>">
                      <?= $question->selected_option_text ?? 'Tidak dijawab' ?>
                    </p>
                  </div>

                <?php elseif ($question->jenis_soal == 'esai' || $question->jenis_soal == 'uraian') : ?>
                  <div class="mb-3">
                    <p class="text-sm mb-1"><strong>Jawaban Pelamar:</strong></p>
                    <div class="border rounded p-3 bg-light">
                      <p class="text-sm mb-0"><?= $question->teks_jawaban ?? 'Tidak dijawab' ?></p>
                    </div>
                  </div>

                  <?php if (!empty($question->teks_jawaban)) : ?>
                    <div class="mb-2">
                      <p class="text-sm mb-1"><strong>Penilaian Manual:</strong></p>
                      <div class="row align-items-center">
                        <div class="col-md-4">
                          <div class="input-group input-group-sm">
                            <input type="number" class="form-control" id="score_<?= $question->id ?>"
                                   min="0" max="<?= $question->poin ?>"
                                   value="<?= isset($question->nilai_manual) ? $question->nilai_manual : $question->poin ?>"
                                   placeholder="0-<?= $question->poin ?>">
                            <span class="input-group-text">/ <?= $question->poin ?></span>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <button type="button" class="btn btn-sm btn-success"
                                  onclick="konfirmasiSimpanNilai(<?= $question->answer_id ?>, <?= $question->id ?>, <?= $question->poin ?>)">
                            <i class="fas fa-save me-1"></i> Simpan Nilai
                          </button>
                        </div>
                        <div class="col-md-4">
                          <?php if (isset($question->tanggal_dinilai) && $question->tanggal_dinilai) : ?>
                            <small class="text-muted">
                              Dinilai: <?= date('d/m/Y H:i', strtotime($question->tanggal_dinilai)) ?>
                            </small>
                          <?php endif; ?>
                        </div>
                      </div>
                    </div>
                  <?php endif; ?>
                <?php endif; ?>
              </div>
            </div>
          <?php endforeach; ?>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>

<script>
function konfirmasiSimpanNilai(answerId, questionId, maxScore) {
    const scoreInput = document.getElementById('score_' + questionId);
    const score = parseInt(scoreInput.value);

    // Validasi nilai
    if (isNaN(score) || score < 0 || score > maxScore) {
        Swal.fire({
            icon: 'error',
            title: 'Nilai Tidak Valid',
            text: `Nilai harus antara 0 sampai ${maxScore}`,
            confirmButtonText: 'OK'
        });
        return;
    }

    // Tampilkan konfirmasi dengan SweetAlert2
    Swal.fire({
        title: 'Konfirmasi Penilaian',
        text: `Apakah Anda yakin ingin memberikan nilai ${score} untuk jawaban ini?`,
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Simpan',
        cancelButtonText: 'Batal',
        allowOutsideClick: false,
        allowEscapeKey: false
    }).then((result) => {
        if (result.isConfirmed) {
            // Kirim request AJAX
            $.ajax({
                url: '<?= base_url('admin/update_nilai_jawaban') ?>',
                type: 'POST',
                dataType: 'json',
                data: {
                    answer_id: answerId,
                    nilai: score
                },
                success: function(data) {
                    if (data.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: 'Nilai berhasil disimpan',
                            timer: 1500,
                            showConfirmButton: false
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: data.message || 'Terjadi kesalahan saat menyimpan nilai',
                            confirmButtonText: 'OK'
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                    console.error('Status:', status);
                    console.error('Response:', xhr.responseText);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Terjadi kesalahan koneksi: ' + error,
                        confirmButtonText: 'OK'
                    });
                }
            });
        }
    });
}

function konfirmasiTandaiSudahDinilai(applicantAssessmentId) {
    Swal.fire({
        title: 'Konfirmasi Penilaian',
        html: `
            <div class="text-start px-3">
                <div class="mb-3">
                    <p class="mb-2 fs-6 text-dark">Apakah Anda yakin ingin mengunci penilaian ini?</p>
                </div>
                <div class="alert alert-info border-0 shadow-sm">
                    <div class="d-flex align-items-start">
                        <i class="fas fa-exclamation-triangle text-primary me-3 mt-1"></i>
                        <div>
                            <strong class="text-primary">Perhatian!</strong>
                            <p class="mb-0 small mt-1">
                                Tindakan ini akan mengunci penilaian secara permanen dan tidak dapat dibatalkan. 
                                Nilai akan langsung dikirimkan ke pelamar.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        `,
        icon: 'question',
        iconColor: '#6c757d',
        showCancelButton: true,
        confirmButtonColor: '#28a745',
        cancelButtonColor: '#6c757d',
        confirmButtonText: '<i class="fas fa-lock me-2"></i>Ya, Kunci Penilaian',
        cancelButtonText: '<i class="fas fa-times me-2"></i>Batal',
        customClass: {
            popup: 'swal2-popup-enhanced shadow-lg',
            title: 'swal2-title-enhanced fw-bold text-dark',
            htmlContainer: 'swal2-html-enhanced',
            confirmButton: 'btn btn-success btn-lg px-4 me-2 shadow-sm',
            cancelButton: 'btn btn-secondary btn-lg px-4 shadow-sm',
            actions: 'swal2-actions-enhanced gap-2'
        },
        buttonsStyling: false,
        reverseButtons: true,
        focusConfirm: false,
        focusCancel: true,
        backdrop: `
            rgba(0, 0, 0, 0.6)
            left top
            no-repeat
        `,
        showClass: {
            popup: 'animate__animated animate__fadeInDown animate__faster'
        },
        hideClass: {
            popup: 'animate__animated animate__fadeOutUp animate__faster'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            // Loading animation dengan progress bar
            Swal.fire({
                title: 'Memproses Penilaian',
                html: `
                    <div class="text-center">
                        <div class="spinner-border text-primary mb-3" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <p class="text-muted mb-0">Mohon tunggu, sedang mengunci penilaian...</p>
                    </div>
                `,
                allowOutsideClick: false,
                allowEscapeKey: false,
                showConfirmButton: false,
                customClass: {
                    popup: 'swal2-loading-enhanced',
                    title: 'fw-bold text-primary'
                },
                backdrop: `
                    rgba(0, 0, 0, 0.7)
                    left top
                    no-repeat
                `,
                didOpen: () => {
                    // Optional: Add timeout untuk user experience yang lebih baik
                    setTimeout(() => {
                        window.location.href = '<?= base_url('admin/tandai_penilaian_sudah_dinilai/') ?>' + applicantAssessmentId;
                    }, 1000);
                }
            });
        }
    }).catch((error) => {
        // Error handling
        console.error('Error in confirmation dialog:', error);
        Swal.fire({
            title: 'Terjadi Kesalahan',
            text: 'Mohon coba lagi atau hubungi administrator sistem.',
            icon: 'error',
            confirmButtonText: 'OK',
            customClass: {
                confirmButton: 'btn btn-danger'
            },
            buttonsStyling: false
        });
    });
}
</script>