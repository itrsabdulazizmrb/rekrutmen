<div class="row">
  <div class="col-12">
    <div class="card mb-4">
      <div class="card-header pb-0">
        <h6>Penilaian Saya</h6>
        <p class="text-sm mb-0">
          <i class="fa fa-info-circle text-primary" aria-hidden="true"></i>
          <span class="font-weight-bold">Pantau semua penilaian untuk lamaran pekerjaan Anda</span>
        </p>
      </div>
      <div class="card-body px-0 pt-0 pb-2">
        <div class="table-responsive p-0">
          <?php if (empty($assessments)) : ?>
            <div class="text-center py-5">
              <h4 class="text-secondary">Tidak ada penilaian ditemukan</h4>
              <p class="text-muted">Anda belum memiliki penilaian yang ditetapkan untuk Anda.</p>
              <a href="<?= base_url('pelamar/lamaran') ?>" class="btn btn-primary mt-3">Lihat Lamaran Saya</a>
            </div>
          <?php else : ?>
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Penilaian</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Lowongan</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jenis</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nilai</th>
                  <th class="text-secondary opacity-7"></th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($assessments as $assessment) : ?>
                  <tr>
                    <td>
                      <div class="d-flex px-2 py-1">
                        <div>
                          <div class="icon icon-shape icon-sm bg-gradient-info shadow text-center me-2">
                            <i class="ni ni-ruler-pencil text-white opacity-10"></i>
                          </div>
                        </div>
                        <div class="d-flex flex-column justify-content-center">
                          <h6 class="mb-0 text-sm"><?= $assessment->assessment_title ?></h6>
                        </div>
                      </div>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0"><?= $assessment->job_title ?></p>
                    </td>
                    <td class="align-middle text-center text-sm">
                      <span class="badge badge-sm bg-gradient-primary"><?= $assessment->type_name ?></span>
                    </td>
                    <td class="align-middle text-center text-sm">
                      <?php if ($assessment->status == 'belum_mulai' || $assessment->status == 'not_started') : ?>
                        <span class="badge badge-sm bg-gradient-secondary">Belum Dimulai</span>
                      <?php elseif ($assessment->status == 'sedang_berlangsung' || $assessment->status == 'in_progress') : ?>
                        <span class="badge badge-sm bg-gradient-warning">Sedang Berlangsung</span>
                      <?php elseif ($assessment->status == 'selesai' || $assessment->status == 'completed') : ?>
                        <span class="badge badge-sm bg-gradient-success">Selesai</span>
                      <?php elseif ($assessment->status == 'sudah_dinilai' || $assessment->status == 'graded') : ?>
                        <span class="badge badge-sm bg-gradient-info">Sudah Dinilai</span>
                      <?php endif; ?>
                    </td>
                    <td class="align-middle text-center">
                      <?php if (($assessment->status == 'sudah_dinilai' || $assessment->status == 'graded') && $assessment->nilai !== null) : ?>
                        <span class="text-secondary text-xs font-weight-bold"><?= $assessment->nilai ?></span>
                      <?php else : ?>
                        <span class="text-secondary text-xs font-weight-bold">-</span>
                      <?php endif; ?>
                    </td>
                    <td class="align-middle">
                      <?php if ($assessment->status == 'belum_mulai' || $assessment->status == 'not_started' || $assessment->status == 'sedang_berlangsung' || $assessment->status == 'in_progress') : ?>
                        <div class="d-flex flex-column text-start" style="min-width: 220px;">
                          <?php if ($assessment->tanggal_penilaian) : ?>
                            <span class="text-xs text-secondary mb-1">
                              Jadwal: <?= date('d F Y H:i', strtotime($assessment->tanggal_penilaian)) ?>
                              <span class="text-info font-weight-bold countdown-timer" id="countdown-<?= $assessment->id_penilaian ?>-<?= $assessment->id_lamaran ?>" data-scheduled-time="<?= strtotime($assessment->tanggal_penilaian) * 1000 ?>"></span>
                            </span>
                          <?php endif; ?>
                          <?php if ($assessment->tanggal_penilaian && strtotime($assessment->tanggal_penilaian) > time()) : ?>
                            <button class="btn btn-sm btn-secondary mt-1 w-100 start-button" disabled id="start-button-<?= $assessment->id_penilaian ?>-<?= $assessment->id_lamaran ?>" data-assessment-id="<?= $assessment->id_penilaian ?>" data-application-id="<?= $assessment->id_lamaran ?>">
                              Belum Waktunya
                            </button>
                          <?php else : ?>
                            <a href="<?= base_url('pelamar/ikuti-penilaian/' . $assessment->id_penilaian . '/' . $assessment->id_lamaran) ?>" class="btn btn-sm btn-primary mt-1 w-100 start-button" id="start-button-<?= $assessment->id_penilaian ?>-<?= $assessment->id_lamaran ?>" data-assessment-id="<?= $assessment->id_penilaian ?>" data-application-id="<?= $assessment->id_lamaran ?>">
                              <?= ($assessment->status == 'belum_mulai' || $assessment->status == 'not_started') ? 'Ikuti Penilaian' : 'Lanjutkan' ?>
                            </a>
                          <?php endif; ?>
                        </div>
                      <?php else : ?>
                        <a href="<?= base_url('pelamar/detail-lamaran/' . $assessment->id_lamaran) ?>" class="text-secondary font-weight-bold text-xs">
                          Lihat Lamaran
                        </a>
                      <?php endif; ?>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row mt-4">
  <div class="col-12">
    <div class="card">
      <div class="card-header pb-0">
        <h6>Panduan Penilaian</h6>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-6">
            <div class="d-flex align-items-center mb-3">
              <span class="badge badge-sm bg-gradient-secondary me-3">Belum Dimulai</span>
              <p class="text-xs mb-0">Anda belum memulai penilaian ini.</p>
            </div>
            <div class="d-flex align-items-center mb-3">
              <span class="badge badge-sm bg-gradient-warning me-3">Sedang Berlangsung</span>
              <p class="text-xs mb-0">Anda telah memulai tetapi belum menyelesaikan penilaian ini.</p>
            </div>
          </div>
          <div class="col-md-6">
            <div class="d-flex align-items-center mb-3">
              <span class="badge badge-sm bg-gradient-success me-3">Selesai</span>
              <p class="text-xs mb-0">Anda telah menyelesaikan penilaian ini dan sedang menunggu penilaian.</p>
            </div>
            <div class="d-flex align-items-center mb-3">
              <span class="badge badge-sm bg-gradient-info me-3">Sudah Dinilai</span>
              <p class="text-xs mb-0">Penilaian ini telah dinilai dan nilai Anda sudah tersedia.</p>
            </div>
          </div>
        </div>

        <div class="alert alert-info mt-3" role="alert">
          <h6 class="alert-heading mb-1">Tips Penilaian</h6>
          <ul class="mb-0 ps-4">
            <li>Pastikan Anda memiliki koneksi internet yang stabil sebelum memulai penilaian.</li>
            <li>Beberapa penilaian memiliki batas waktu. Setelah dimulai, Anda harus menyelesaikannya dalam waktu yang ditentukan.</li>
            <li>Baca semua pertanyaan dengan seksama sebelum menjawab.</li>
            <li>Untuk penilaian teknis, pastikan Anda memahami persyaratan sebelum mengerjakan.</li>
            <li>Untuk pertanyaan pilihan ganda, eliminasi jawaban yang jelas-jelas salah terlebih dahulu.</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const timers = document.querySelectorAll('.countdown-timer');

    function updateCountdown() {
        const now = new Date().getTime();

        timers.forEach(timer => {
            const scheduledTime = parseInt(timer.dataset.scheduledTime);
            const closureTime = scheduledTime + (3 * 60 * 60 * 1000); // 3 hours after scheduled time
            const distanceToStart = scheduledTime - now;
            const distanceToClosure = closureTime - now;

            const assessmentId = timer.id.split('-')[1];
            const applicationId = timer.id.split('-')[2];
            const startButton = document.getElementById(`start-button-${assessmentId}-${applicationId}`);

            let countdownText = '';

            if (distanceToStart > 0) {
                // Case 1: Before scheduled start time
                const days = Math.floor(distanceToStart / (1000 * 60 * 60 * 24));
                const hours = Math.floor((distanceToStart % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((distanceToStart % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((distanceToStart % (1000 * 60)) / 1000);

                if (days > 0) {
                    countdownText += days + "h ";
                }
                countdownText += hours + "j " + minutes + "m " + seconds + "d ";
                timer.innerHTML = `(${countdownText} lagi)`;
                
                if (startButton) {
                    startButton.disabled = true;
                    startButton.classList.remove('btn-primary');
                    startButton.classList.add('btn-secondary');
                    startButton.innerHTML = 'Belum Waktunya';
                    startButton.href = '#';
                }

            } else if (distanceToClosure > 0) {
                // Case 2: After scheduled start time, but before closure time
                const hours = Math.floor((distanceToClosure % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((distanceToClosure % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((distanceToClosure % (1000 * 60)) / 1000);

                countdownText = hours + "j " + minutes + "m " + seconds + "d ";
                timer.innerHTML = `(${countdownText} sisa)`;

                if (startButton) {
                    // Button should be active if it's within this window
                    startButton.disabled = false;
                    startButton.classList.remove('btn-secondary', 'btn-danger');
                    startButton.classList.add('btn-primary');
                    // Keep the original text if it was 'Lanjutkan', otherwise set to 'Ikuti Penilaian'
                    // Note: This relies on the server-rendered initial state for 'Lanjutkan'
                    if (!startButton.innerHTML.includes('Lanjutkan')) {
                        startButton.innerHTML = 'Ikuti Penilaian';
                    }
                    startButton.href = `<?= base_url('pelamar/ikuti-penilaian/') ?>${assessmentId}/${applicationId}`;
                }

            } else {
                // Case 3: After closure time
                timer.innerHTML = 'Waktu sudah habis!';
                if (startButton) {
                    startButton.disabled = true;
                    startButton.classList.remove('btn-primary', 'btn-secondary');
                    startButton.classList.add('btn-danger');
                    startButton.innerHTML = 'Waktu sudah habis';
                    startButton.href = '#';
                }
            }
        });
    }

    updateCountdown();

    setInterval(updateCountdown, 1000);
});
</script>
