<!-- Content Wrapper -->
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card my-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
          <div class="bg-gradient-success shadow-success border-radius-lg pt-4 pb-3">
            <h6 class="text-white text-capitalize ps-3">Laporan Lamaran</h6>
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
                  <form method="GET" action="<?= base_url('admin/laporan_lamaran') ?>" id="filter-form">
                    <div class="row">
                      <div class="col-md-2">
                        <div class="input-group input-group-outline mb-3">
                          <select class="form-control" name="periode" onchange="toggleDateRange()">
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
                          <select class="form-control" name="status">
                            <option value="">Semua Status</option>
                            <option value="pending" <?= $filters['status'] == 'pending' ? 'selected' : '' ?>>Pending</option>
                            <option value="direview" <?= $filters['status'] == 'direview' ? 'selected' : '' ?>>Direview</option>
                            <option value="seleksi" <?= $filters['status'] == 'seleksi' ? 'selected' : '' ?>>Seleksi</option>
                            <option value="wawancara" <?= $filters['status'] == 'wawancara' ? 'selected' : '' ?>>Wawancara</option>
                            <option value="diterima" <?= $filters['status'] == 'diterima' ? 'selected' : '' ?>>Diterima</option>
                            <option value="ditolak" <?= $filters['status'] == 'ditolak' ? 'selected' : '' ?>>Ditolak</option>
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
                        <button type="submit" class="btn bg-gradient-success me-2">
                          <i class="material-icons me-1"></i>Filter
                        </button>
                        <a href="<?= base_url('admin/laporan_lamaran') ?>" class="btn btn-outline-secondary me-2">
                          <i class="material-icons me-1"></i>Reset
                        </a>
                        <button type="button" class="btn bg-gradient-info" onclick="printReport()">
                          <i class="material-icons me-1"></i>Cetak Laporan
                        </button>
                        <!-- <button type="button" class="btn bg-gradient-primary me-2" onclick="exportData('excel')">
                          <i class="material-icons me-1">file_download</i>Excel
                        </button>
                        <button type="button" class="btn bg-gradient-danger me-2" onclick="exportData('pdf')">
                          <i class="material-icons me-1">picture_as_pdf</i>PDF
                        </button> -->
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>

          <!-- Statistics Cards -->
          <div class="row mb-4 px-3">
            <div class="col-md-4 mb-3">
              <div class="card">
                <div class="card-body text-center">
                  <h3 class="text-primary"><?= count($lamaran) ?></h3>
                  <p class="mb-0">Total Lamaran</p>
                </div>
              </div>
            </div>
            <div class="col-md-4 mb-3">
              <div class="card">
                <div class="card-body text-center">
                  <h3 class="text-success"><?= $conversion_rate['lamaran_diterima'] ?></h3>
                  <p class="mb-0">Diterima</p>
                </div>
              </div>
            </div>
            <div class="col-md-4 mb-3">
              <div class="card">
                <div class="card-body text-center">
                  <h3 class="text-danger"><?= $conversion_rate['lamaran_ditolak'] ?></h3>
                  <p class="mb-0">Ditolak</p>
                </div>
              </div>
            </div>
            <!-- <div class="col-md-3 mb-3">
              <div class="card">
                <div class="card-body text-center">
                  <h3 class="text-info"><?= $conversion_rate['conversion_rate'] ?>%</h3>
                  <p class="mb-0">Conversion Rate</p>
                </div>
              </div>
            </div>
            <div class="col-md-3 mb-3">
              <div class="card">
                <div class="card-body text-center">
                  <h3 class="text-warning"><?= $conversion_rate['rejection_rate'] ?>%</h3>
                  <p class="mb-0">Rejection Rate</p>
                </div>
              </div>
            </div> -->
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
                  <h6>Trend Lamaran Bulanan</h6>
                </div>
                <div class="card-body">
                  <canvas id="monthlyChart" width="400" height="200"></canvas>
                </div>
              </div>
            </div>
          </div>

          <!-- Top Jobs Table -->
          <div class="row mb-4 px-3">
            <div class="col-12">
              <div class="card">
                <div class="card-header pb-0">
                  <h6>Top 10 Lowongan dengan Lamaran Terbanyak</h6>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table align-items-center mb-0">
                      <thead>
                        <tr>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Ranking</th>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Lowongan</th>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jumlah Lamaran</th>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Persentase</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $rank = 1; foreach ($statistik_lamaran['berdasarkan_lowongan'] as $job_stat) : ?>
                        <tr>
                          <td class="ps-4">
                            <p class="text-xs font-weight-bold mb-0"><?= $rank++ ?></p>
                          </td>
                          <td>
                            <h6 class="mb-0 text-sm"><?= $job_stat->lowongan ?></h6>
                          </td>
                          <td>
                            <p class="text-xs font-weight-bold mb-0"><?= $job_stat->jumlah ?></p>
                          </td>
                          <td>
                            <div class="progress-wrapper w-75 mx-auto">
                              <div class="progress-info">
                                <div class="progress-percentage">
                                  <span class="text-xs font-weight-bold"><?= round(($job_stat->jumlah / count($lamaran)) * 100, 1) ?>%</span>
                                </div>
                              </div>
                              <div class="progress">
                                <div class="progress-bar bg-gradient-info" style="width: <?= round(($job_stat->jumlah / count($lamaran)) * 100, 1) ?>%"></div>
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
              <table class="table align-items-center mb-0" id="lamaranTable">
                <thead>
                  <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Pelamar</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Lowongan</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal Lamaran</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $no = 1; foreach ($lamaran as $application) : ?>
                  <tr>
                    <td class="ps-4">
                      <p class="text-xs font-weight-bold mb-0"><?= $no++ ?></p>
                    </td>
                    <td>
                      <div class="d-flex px-2 py-1">
                        <div class="d-flex flex-column justify-content-center">
                          <h6 class="mb-0 text-sm"><?= $application->pelamar_nama ?></h6>
                        </div>
                      </div>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0"><?= $application->lowongan_judul ?></p>
                    </td>
                    <td>
                      <?php
                      $status_class = '';
                      $status_text = '';
                      switch($application->status) {
                        case 'pending':
                          $status_class = 'bg-gradient-secondary';
                          $status_text = 'Pending';
                          break;
                        case 'direview':
                          $status_class = 'bg-gradient-info';
                          $status_text = 'Direview';
                          break;
                        case 'seleksi':
                          $status_class = 'bg-gradient-warning';
                          $status_text = 'Seleksi';
                          break;
                        case 'wawancara':
                          $status_class = 'bg-gradient-primary';
                          $status_text = 'Wawancara';
                          break;
                        case 'diterima':
                          $status_class = 'bg-gradient-success';
                          $status_text = 'Diterima';
                          break;
                        case 'ditolak':
                          $status_class = 'bg-gradient-danger';
                          $status_text = 'Ditolak';
                          break;
                        default:
                          $status_class = 'bg-gradient-secondary';
                          $status_text = ucfirst($application->status);
                      }
                      ?>
                      <span class="badge badge-sm <?= $status_class ?>"><?= $status_text ?></span>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0"><?= date('d/m/Y H:i', strtotime($application->tanggal_lamaran)) ?></p>
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




const statusCtx = document.getElementById('statusChart').getContext('2d');
const statusChart = new Chart(statusCtx, {
  type: 'doughnut',
  data: {
    labels: <?= json_encode(array_column($statistik_lamaran['berdasarkan_status'], 'status')) ?>,
    datasets: [{
      data: <?= json_encode(array_column($statistik_lamaran['berdasarkan_status'], 'jumlah')) ?>,
      backgroundColor: ['#9E9E9E', '#2196F3', '#FF9800', '#9C27B0', '#4CAF50', '#F44336']
    }]
  },
  options: {
    responsive: true,
    maintainAspectRatio: false
  }
});


const monthlyCtx = document.getElementById('monthlyChart').getContext('2d');
const monthlyChart = new Chart(monthlyCtx, {
  type: 'line',
  data: {
    labels: <?= json_encode(array_map(function($item) { return date('M Y', mktime(0, 0, 0, $item->bulan, 1, $item->tahun)); }, $statistik_lamaran['berdasarkan_bulan'])) ?>,
    datasets: [{
      label: 'Jumlah Lamaran',
      data: <?= json_encode(array_column($statistik_lamaran['berdasarkan_bulan'], 'jumlah')) ?>,
      borderColor: '#4CAF50',
      backgroundColor: 'rgba(76, 175, 80, 0.1)',
      fill: true
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
  window.open('<?= base_url('admin/export_laporan?jenis=lamaran') ?>&' + params.toString());
}

function printReport() {
    // Get current filters
    const form = document.getElementById('filter-form');
    const formData = new FormData(form);
    const params = new URLSearchParams(formData);
    
    // Open print window
    window.open('<?= base_url('admin/print_laporan_lamaran') ?>?' + params.toString(), '_blank');
}
</script>
