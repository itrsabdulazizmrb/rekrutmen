<!-- Content Wrapper -->
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card my-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
          <div class="bg-gradient-warning shadow-warning border-radius-lg pt-4 pb-3">
            <h6 class="text-white text-capitalize ps-3">Laporan Penilaian</h6>
          </div>
        </div>
        <div class="card-body px-0 pb-2">

          <!-- Filter Section -->
          <div class="row mb-4 px-3">
            <div class="col-12">
              <div class="card">
                <div class="card-header pb-0">
                  <h6>Filter Laporan</h6>
                </div>
                <div class="card-body">
                  <form method="GET" action="<?= base_url('admin/laporan_penilaian') ?>" id="filter-form">
                    <div class="row">
                      <div class="col-md-2">
                        <div class="input-group input-group-outline mb-3">
                          <!-- <label class="form-label">Periode</label> -->
                          <select class="form-control" name="periode" onchange="toggleDateRange()">
                            <option value="semua" <?= $filters['periode'] == 'semua' ? 'selected' : '' ?>>Semua Data</option>
                            <option value="hari" <?= $filters['periode'] == 'hari' ? 'selected' : '' ?>>Hari Ini</option>
                            <option value="minggu" <?= $filters['periode'] == 'minggu' ? 'selected' : '' ?>>Minggu Ini</option>
                            <option value="bulan" <?= $filters['periode'] == 'bulan' ? 'selected' : '' ?>>Bulan Ini</option>
                            <option value="tahun" <?= $filters['periode'] == 'tahun' ? 'selected' : '' ?>>Tahun Ini</option>
                            <option value="custom" <?= (!empty($filters['tanggal_mulai']) && !empty($filters['tanggal_selesai'])) ? 'selected' : '' ?>>Custom</option>
                          </select>
                        </div>
                      </div>

                      <div class="col-md-2" id="date-range" style="display: <?= (!empty($filters['tanggal_mulai']) && !empty($filters['tanggal_selesai'])) ? 'block' : 'none' ?>;">
                        <div class="input-group input-group-outline mb-3">
                          <label class="form-label">Tanggal Mulai</label>
                          <input type="date" class="form-control" name="tanggal_mulai" value="<?= $filters['tanggal_mulai'] ?>">
                        </div>
                      </div>

                      <div class="col-md-2" id="date-range-end" style="display: <?= (!empty($filters['tanggal_mulai']) && !empty($filters['tanggal_selesai'])) ? 'block' : 'none' ?>;">
                        <div class="input-group input-group-outline mb-3">
                          <label class="form-label">Tanggal Selesai</label>
                          <input type="date" class="form-control" name="tanggal_selesai" value="<?= $filters['tanggal_selesai'] ?>">
                        </div>
                      </div>

                      <div class="col-md-3">
                        <div class="input-group input-group-outline mb-3">
                          <!-- <label class="form-label">Penilaian</label> -->
                          <select class="form-control" name="penilaian">
                            <option value="">Semua Penilaian</option>
                            <?php foreach ($penilaian_list as $assessment) : ?>
                              <option value="<?= $assessment->id ?>" <?= $filters['penilaian'] == $assessment->id ? 'selected' : '' ?>><?= $assessment->judul ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                      </div>

                      <div class="col-md-3">
                        <div class="input-group input-group-outline mb-3">
                          <!-- <label class="form-label">Lowongan</label> -->
                          <select class="form-control" name="lowongan">
                            <option value="">Semua Lowongan</option>
                            <?php foreach ($lowongan_list as $job) : ?>
                              <option value="<?= $job->id ?>" <?= $filters['lowongan'] == $job->id ? 'selected' : '' ?>><?= $job->judul ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-12">
                        <button type="submit" class="btn bg-gradient-warning me-2">
                          <i class="material-icons me-1"></i>Filter
                        </button>
                        <a href="<?= base_url('admin/laporan_penilaian') ?>" class="btn btn-outline-secondary me-2">
                          <i class="material-icons me-1"></i>Reset
                        </a>
                        <button type="button" class="btn bg-gradient-info" onclick="printReport()">
                          <i class="material-icons me-1"></i>Cetak Laporan
                        </button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>

          <!-- Statistics Cards -->
          <div class="row mb-4 px-3">
            <div class="col-md-2 mb-3">
              <div class="card">
                <div class="card-body text-center">
                  <h3 class="text-warning"><?= count($hasil_penilaian) ?></h3>
                  <p class="mb-0">Total Peserta</p>
                </div>
              </div>
            </div>
            <div class="col-md-2 mb-3">
              <div class="card">
                <div class="card-body text-center">
                  <h3 class="text-success"><?= $tingkat_kelulusan['peserta_lulus'] ?></h3>
                  <p class="mb-0">Lulus</p>
                </div>
              </div>
            </div>
            <div class="col-md-2 mb-3">
              <div class="card">
                <div class="card-body text-center">
                  <h3 class="text-danger"><?= $tingkat_kelulusan['peserta_tidak_lulus'] ?></h3>
                  <p class="mb-0">Tidak Lulus</p>
                </div>
              </div>
            </div>
            <div class="col-md-3 mb-3">
              <div class="card">
                <div class="card-body text-center">
                  <h3 class="text-info"><?= $tingkat_kelulusan['tingkat_kelulusan'] ?>%</h3>
                  <p class="mb-0">Tingkat Kelulusan</p>
                </div>
              </div>
            </div>
            <div class="col-md-3 mb-3">
              <div class="card">
                <div class="card-body text-center">
                  <h3 class="text-primary">
                    <?php
                    $completed = array_filter($hasil_penilaian, function($h) { return $h->status == 'selesai'; });
                    echo count($completed) > 0 ? round(array_sum(array_column($completed, 'nilai')) / count($completed), 1) : 0;
                    ?>
                  </h3>
                  <p class="mb-0">Rata-rata Skor</p>
                </div>
              </div>
            </div>
          </div>

          <!-- Charts Section -->
          <div class="row mb-4 px-3">
            <div class="col-md-6 mb-3">
              <div class="card">
                <div class="card-header pb-0">
                  <h6>Statistik Berdasarkan Status</h6>
                </div>
                <div class="card-body">
                  <canvas id="statusChart" width="400" height="200"></canvas>
                </div>
              </div>
            </div>
            <div class="col-md-6 mb-3">
              <div class="card">
                <div class="card-header pb-0">
                  <h6>Distribusi Waktu Pengerjaan</h6>
                </div>
                <div class="card-body">
                  <canvas id="timeChart" width="400" height="200"></canvas>
                </div>
              </div>
            </div>
          </div>

          <!-- Assessment Performance Table -->
          <div class="row mb-4 px-3">
            <div class="col-12">
              <div class="card">
                <div class="card-header pb-0">
                  <h6>Performa Per Penilaian</h6>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table align-items-center mb-0">
                      <thead>
                        <tr>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Penilaian</th>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Total Peserta</th>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Rata-rata Skor</th>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tingkat Kelulusan</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($statistik_penilaian['rata_rata_per_penilaian'] as $assessment_stat) : ?>
                        <tr>
                          <td>
                            <h6 class="mb-0 text-sm"><?= $assessment_stat->penilaian ?></h6>
                          </td>
                          <td>
                            <p class="text-xs font-weight-bold mb-0"><?= $assessment_stat->total_peserta ?></p>
                          </td>
                          <td>
                            <span class="badge badge-sm bg-gradient-<?= $assessment_stat->rata_rata_skor >= 70 ? 'success' : 'warning' ?>">
                              <?= round($assessment_stat->rata_rata_skor, 1) ?>
                            </span>
                          </td>
                          <td>
                            <div class="progress-wrapper w-75 mx-auto">
                              <div class="progress-info">
                                <div class="progress-percentage">
                                  <span class="text-xs font-weight-bold">
                                    <?php
                                    $pass_rate = $assessment_stat->rata_rata_skor >= 70 ? 100 : round(($assessment_stat->rata_rata_skor / 70) * 100, 1);
                                    echo $pass_rate;
                                    ?>%
                                  </span>
                                </div>
                              </div>
                              <div class="progress">
                                <div class="progress-bar bg-gradient-<?= $assessment_stat->rata_rata_skor >= 70 ? 'success' : 'warning' ?>"
                                     style="width: <?= $pass_rate ?>%"></div>
                              </div>
                            </div>
                          </td>
                        </tr>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Data Table -->
          <div class="px-3">
            <div class="table-responsive p-0">
              <table class="table align-items-center mb-0" id="penilaianTable">
                <thead>
                  <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Pelamar</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Penilaian</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Lowongan</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Skor</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Waktu Pengerjaan</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal</th>
                    <!-- <th class="text-secondary opacity-7">Aksi</th> -->
                  </tr>
                </thead>
                <tbody>
                  <?php $no = 1; foreach ($hasil_penilaian as $result) : ?>
                  <tr>
                    <td class="ps-4">
                      <p class="text-xs font-weight-bold mb-0"><?= $no++ ?></p>
                    </td>
                    <td>
                      <div class="d-flex px-2 py-1">
                        <div class="d-flex flex-column justify-content-center">
                          <h6 class="mb-0 text-sm"><?= $result->pelamar_nama ?></h6>
                        </div>
                      </div>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0"><?= $result->penilaian_judul ?></p>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0"><?= $result->lowongan_judul ?: '-' ?></p>
                    </td>
                    <td>
                      <?php if ($result->status == 'selesai') : ?>
                        <span class="badge badge-sm bg-gradient-<?= $result->nilai >= 70 ? 'success' : 'danger' ?>">
                          <?= $result->nilai ?>
                        </span>
                      <?php else : ?>
                        <span class="badge badge-sm bg-gradient-secondary">-</span>
                      <?php endif; ?>
                    </td>
                    <td>
                      <?php
                      $status_class = '';
                      $status_text = '';
                      switch($result->status) {
                        case 'belum_mulai':
                          $status_class = 'bg-gradient-secondary';
                          $status_text = 'Belum Mulai';
                          break;
                        case 'sedang_mengerjakan':
                          $status_class = 'bg-gradient-warning';
                          $status_text = 'Sedang Mengerjakan';
                          break;
                        case 'selesai':
                          $status_class = 'bg-gradient-success';
                          $status_text = 'Selesai';
                          break;
                        default:
                          $status_class = 'bg-gradient-secondary';
                          $status_text = ucfirst($result->status);
                      }
                      ?>
                      <span class="badge badge-sm <?= $status_class ?>"><?= $status_text ?></span>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0">
                        <?php
                        if (isset($result->waktu_pengerjaan) && $result->waktu_pengerjaan) {
                          echo $result->waktu_pengerjaan . ' menit';
                        } elseif (isset($result->waktu_mulai) && isset($result->waktu_selesai) && $result->waktu_mulai && $result->waktu_selesai) {
                          $waktu_pengerjaan = round((strtotime($result->waktu_selesai) - strtotime($result->waktu_mulai)) / 60);
                          echo $waktu_pengerjaan . ' menit';
                        } else {
                          echo '<span class="text-muted">-</span>';
                        }
                        ?>
                      </p>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0">
                        <?php
                        if (isset($result->tanggal_mulai) && $result->tanggal_mulai) {
                          echo date('d/m/Y H:i', strtotime($result->tanggal_mulai));
                        } elseif (isset($result->waktu_mulai) && $result->waktu_mulai) {
                          echo date('d/m/Y H:i', strtotime($result->waktu_mulai));
                        } else {
                          echo '<span class="text-muted">-</span>';
                        }
                        ?>
                      </p>
                    </td>
                    <!-- <td class="align-middle text-center">
                      <a href="<?= base_url('admin/detail-hasil-penilaian/' . $result->id) ?>"
                         class="btn btn-sm btn-outline-info me-1"
                         data-bs-toggle="tooltip"
                         data-bs-placement="top"
                         title="Lihat Detail Hasil Penilaian">
                        <i class="fas fa-eye"></i> Detail
                      </a>
                    </td> -->
                  </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>

<!-- Include Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

function toggleDateRange() {
  const periode = document.querySelector('select[name="periode"]').value;
  const dateRange = document.getElementById('date-range');
  const dateRangeEnd = document.getElementById('date-range-end');

  if (periode === 'custom') {
    dateRange.style.display = 'block';
    dateRangeEnd.style.display = 'block';
  } else {
    dateRange.style.display = 'none';
    dateRangeEnd.style.display = 'none';
  }
}




$(document).ready(function() {
  
  var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
  var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl);
  });
});


const statusCtx = document.getElementById('statusChart').getContext('2d');
const statusChart = new Chart(statusCtx, {
  type: 'doughnut',
  data: {
    labels: <?= json_encode(array_column($statistik_penilaian['berdasarkan_status'], 'status')) ?>,
    datasets: [{
      data: <?= json_encode(array_column($statistik_penilaian['berdasarkan_status'], 'jumlah')) ?>,
      backgroundColor: ['#9E9E9E', '#FF9800', '#4CAF50']
    }]
  },
  options: {
    responsive: true,
    maintainAspectRatio: false
  }
});


const timeCtx = document.getElementById('timeChart').getContext('2d');
const timeChart = new Chart(timeCtx, {
  type: 'bar',
  data: {
    labels: <?= json_encode(array_column($statistik_penilaian['distribusi_waktu'], 'kategori_waktu')) ?>,
    datasets: [{
      label: 'Jumlah Peserta',
      data: <?= json_encode(array_column($statistik_penilaian['distribusi_waktu'], 'jumlah')) ?>,
      backgroundColor: '#FF9800'
    }]
  },
  options: {
    responsive: true,
    maintainAspectRatio: false,
    scales: {
      y: {
        beginAtZero: true
      }
    }
  }
});


function exportData(format) {
  const params = new URLSearchParams(window.location.search);
  params.set('export', format);
  window.open('<?= base_url('admin/export_laporan?jenis=penilaian') ?>&' + params.toString());
}

function printReport() {
    // Get current filters
    const form = document.getElementById('filter-form');
    const formData = new FormData(form);
    const params = new URLSearchParams(formData);
    
    // Open print window
    window.open('<?= base_url('admin/print_laporan_penilaian') ?>?' + params.toString(), '_blank');
}
</script>
