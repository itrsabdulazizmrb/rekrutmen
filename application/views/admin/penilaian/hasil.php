<div class="row">
  <div class="col-12">
    <div class="card mb-4">
      <div class="card-header pb-0">
        <div class="d-flex justify-content-between align-items-center">
          <h6>Hasil Penilaian: <?= $assessment->judul ?></h6>
          <div>
            <a href="<?= base_url('admin/penilaian') ?>" class="btn btn-sm btn-outline-primary me-2">
              <i class="fas fa-arrow-left me-2"></i> Kembali ke Daftar Penilaian
            </a>
            <a href="<?= base_url('admin/soal_penilaian/' . $assessment->id) ?>" class="btn btn-sm btn-outline-info">
              <i class="fas fa-tasks me-2"></i> Kelola Soal
            </a>
          </div>
        </div>
        <p class="text-sm mb-0">
          <i class="fa fa-info-circle text-primary" aria-hidden="true"></i>
          <span class="font-weight-bold">Lihat hasil penilaian dari semua pelamar</span>
        </p>
      </div>
      <div class="card-body">
        <div class="row mb-4">
          <div class="col-md-4">
            <div class="card card-body border">
              <div class="d-flex align-items-center">
                <div class="icon icon-shape icon-md bg-gradient-primary shadow text-center">
                  <i class="fas fa-users opacity-10"></i>
                </div>
                <div class="ms-3">
                  <p class="text-sm mb-0">Total Pelamar</p>
                  <h5 class="font-weight-bolder mb-0"><?= $stats['total_applicants'] ?></h5>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card card-body border">
              <div class="d-flex align-items-center">
                <div class="icon icon-shape icon-md bg-gradient-success shadow text-center">
                  <i class="fas fa-check-circle opacity-10"></i>
                </div>
                <div class="ms-3">
                  <p class="text-sm mb-0">Selesai</p>
                  <h5 class="font-weight-bolder mb-0"><?= $stats['completed'] ?></h5>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card card-body border">
              <div class="d-flex align-items-center">
                <div class="icon icon-shape icon-md bg-gradient-info shadow text-center">
                  <i class="fas fa-chart-line opacity-10"></i>
                </div>
                <div class="ms-3">
                  <p class="text-sm mb-0">Rata-rata Skor</p>
                  <h5 class="font-weight-bolder mb-0"><?= $stats['avg_score'] ?>%</h5>
                </div>
              </div>
            </div>
          </div>
        </div>

        <?php if (empty($results)) : ?>
          <div class="alert alert-info" role="alert">
            <strong>Info!</strong> Belum ada pelamar yang mengikuti penilaian ini.
          </div>
        <?php else : ?>
          <div class="table-responsive">
            <table class="table align-items-center mb-0 datatable">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Pelamar</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Lowongan</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Skor</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Waktu Mulai</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Waktu Selesai</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal Ujian</th>
                  <th class="text-secondary opacity-7"></th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($results as $result) : ?>
                  <tr>
                    <td>
                      <div class="d-flex px-2 py-1">
                        <div class="d-flex flex-column justify-content-center">
                          <h6 class="mb-0 text-sm"><?= $result->full_name ?></h6>
                          <p class="text-xs text-secondary mb-0"><?= $result->email ?></p>
                        </div>
                      </div>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0"><?= isset($result->job_title) ? $result->job_title : 'Tidak tersedia' ?></p>
                    </td>
                    <td class="align-middle text-center text-sm">
                      <span class="badge badge-sm bg-gradient-<?= $result->status == 'belum_mulai' ? 'secondary' : ($result->status == 'sedang_berlangsung' ? 'warning' : ($result->status == 'selesai' ? 'success' : 'info')) ?>"><?= $result->status == 'belum_mulai' ? 'Belum Dimulai' : ($result->status == 'sedang_berlangsung' ? 'Sedang Dikerjakan' : ($result->status == 'selesai' ? 'Selesai' : 'Sudah Dinilai')) ?></span>
                    </td>
                    <td class="align-middle text-center">
                      <?php if ($result->status == 'selesai' || $result->status == 'sudah_dinilai') : ?>
                        <span class="text-secondary text-xs font-weight-bold"><?= $result->nilai ?? 0 ?>%</span>
                      <?php else : ?>
                        <span class="text-secondary text-xs font-weight-bold">-</span>
                      <?php endif; ?>
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold"><?= $result->waktu_mulai ? date('d M Y H:i', strtotime($result->waktu_mulai)) : '-' ?></span>
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold"><?= $result->waktu_selesai ? date('d M Y H:i', strtotime($result->waktu_selesai)) : '-' ?></span>
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold"><?= $result->tanggal_penilaian ? date('d M Y H:i', strtotime($result->tanggal_penilaian)) : '-' ?></span>
                    </td>
                    <td class="align-middle">
                      <?php if ($result->status == 'selesai' || $result->status == 'sudah_dinilai') : ?>
                        <a href="<?= base_url('admin/detail-hasil-penilaian/' . $result->id) ?>" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Lihat Detail Hasil Penilaian">
                          <i class="fas fa-eye"></i> Detail
                        </a>
                      <?php endif; ?>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>

<div class="row mt-4">
  <div class="col-md-6">
    <div class="card">
      <div class="card-header pb-0">
        <h6>Distribusi Skor</h6>
      </div>
      <div class="card-body">
        <div class="chart">
          <canvas id="score-distribution-chart" class="chart-canvas" height="300"></canvas>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="card">
      <div class="card-header pb-0">
        <h6>Status Penilaian</h6>
      </div>
      <div class="card-body">
        <div class="chart">
          <canvas id="assessment-status-chart" class="chart-canvas" height="300"></canvas>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    
    var scoreCtx = document.getElementById('score-distribution-chart').getContext('2d');

    
    var scoreRanges = {
      '0-20': 0,
      '21-40': 0,
      '41-60': 0,
      '61-80': 0,
      '81-100': 0
    };

    <?php foreach ($results as $result) : ?>
      <?php if ($result->status == 'selesai' || $result->status == 'sudah_dinilai') : ?>
        <?php
        $score = $result->nilai ?? 0;
        if ($score <= 20) : ?>
          scoreRanges['0-20']++;
        <?php elseif ($score <= 40) : ?>
          scoreRanges['21-40']++;
        <?php elseif ($score <= 60) : ?>
          scoreRanges['41-60']++;
        <?php elseif ($score <= 80) : ?>
          scoreRanges['61-80']++;
        <?php else : ?>
          scoreRanges['81-100']++;
        <?php endif; ?>
      <?php endif; ?>
    <?php endforeach; ?>

    new Chart(scoreCtx, {
      type: 'bar',
      data: {
        labels: ['0-20%', '21-40%', '41-60%', '61-80%', '81-100%'],
        datasets: [{
          label: 'Jumlah Pelamar',
          data: [
            scoreRanges['0-20'],
            scoreRanges['21-40'],
            scoreRanges['41-60'],
            scoreRanges['61-80'],
            scoreRanges['81-100']
          ],
          backgroundColor: [
            'rgba(245, 54, 92, 0.5)',
            'rgba(255, 214, 0, 0.5)',
            'rgba(17, 205, 239, 0.5)',
            'rgba(45, 206, 137, 0.5)',
            'rgba(45, 206, 137, 0.8)'
          ],
          borderColor: [
            'rgba(245, 54, 92, 1)',
            'rgba(255, 214, 0, 1)',
            'rgba(17, 205, 239, 1)',
            'rgba(45, 206, 137, 1)',
            'rgba(45, 206, 137, 1)'
          ],
          borderWidth: 1
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
          y: {
            beginAtZero: true,
            ticks: {
              precision: 0
            }
          }
        }
      }
    });

    
    var statusCtx = document.getElementById('assessment-status-chart').getContext('2d');

    
    var statusCounts = {
      'belum_mulai': 0,
      'sedang_berlangsung': 0,
      'selesai': 0,
      'sudah_dinilai': 0
    };

    <?php foreach ($results as $result) : ?>
      statusCounts['<?= $result->status ?>']++;
    <?php endforeach; ?>

    new Chart(statusCtx, {
      type: 'pie',
      data: {
        labels: ['Belum Dimulai', 'Sedang Dikerjakan', 'Selesai', 'Sudah Dinilai'],
        datasets: [{
          data: [
            statusCounts['belum_mulai'],
            statusCounts['sedang_berlangsung'],
            statusCounts['selesai'],
            statusCounts['sudah_dinilai']
          ],
          backgroundColor: [
            'rgba(133, 147, 176, 0.7)',
            'rgba(255, 214, 0, 0.7)',
            'rgba(45, 206, 137, 0.7)',
            'rgba(17, 205, 239, 0.7)'
          ],
          borderColor: [
            'rgba(133, 147, 176, 1)',
            'rgba(255, 214, 0, 1)',
            'rgba(45, 206, 137, 1)',
            'rgba(17, 205, 239, 1)'
          ],
          borderWidth: 1
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false
      }
    });
  });
</script>
