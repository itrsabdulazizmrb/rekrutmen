<!-- Content Wrapper -->
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card my-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
          <div class="bg-gradient-info shadow-info border-radius-lg pt-4 pb-3">
            <h6 class="text-white text-capitalize ps-3">Laporan Pelamar</h6>
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
                  <form method="GET" action="<?= base_url('admin/laporan_pelamar') ?>" id="filter-form">
                    <div class="row">
                      <div class="col-md-3">
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

                      <!-- <div class="col-md-3">
                        <div class="input-group input-group-outline mb-3">
                          <input type="text" class="form-control" name="lokasi" value="<?= $filters['lokasi'] ?>" placeholder="Masukkan lokasi...">
                        </div>
                      </div> -->

                      <div class="col-md-2">
                        <div class="input-group input-group-outline mb-3">
                          <select class="form-control" name="pendidikan">
                            <option value="">Semua Pendidikan</option>
                            <option value="SMA" <?= $filters['pendidikan'] == 'SMA' ? 'selected' : '' ?>>SMA</option>
                            <option value="D3" <?= $filters['pendidikan'] == 'D3' ? 'selected' : '' ?>>D3</option>
                            <option value="S1" <?= $filters['pendidikan'] == 'S1' ? 'selected' : '' ?>>S1</option>
                            <option value="S2" <?= $filters['pendidikan'] == 'S2' ? 'selected' : '' ?>>S2</option>
                            <option value="S3" <?= $filters['pendidikan'] == 'S3' ? 'selected' : '' ?>>S3</option>
                          </select>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-12">
                        <button type="submit" class="btn bg-gradient-info me-2">
                          <i class="material-icons me-1"></i>Filter
                        </button>
                        <a href="<?= base_url('admin/laporan_pelamar') ?>" class="btn btn-outline-secondary me-2">
                          <i class="material-icons me-1"></i>Reset
                        </a>
                        <button type="button" class="btn bg-gradient-info" onclick="printReport()">
                          <i class="material-icons me-1"></i>Cetak Laporan
                        </button>
                        <!-- <button type="button" class="btn bg-gradient-success me-2" onclick="exportData('excel')">
                          <i class="material-icons me-1"></i>Excel
                        </button>
                        <button type="button" class="btn bg-gradient-danger me-2" onclick="exportData('pdf')">
                          <i class="material-icons me-1">picture_as_pdf</i>PDF
                        </button>
                        <button type="button" class="btn bg-gradient-primary" onclick="printReport()">
                          <i class="material-icons me-1">print</i>Print
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
            <div class="col-md-3 mb-3">
              <div class="card">
                <div class="card-body text-center">
                  <h3 class="text-info"><?= count($pelamar) ?></h3>
                  <p class="mb-0">Total Pelamar</p>
                </div>
              </div>
            </div>
            <div class="col-md-3 mb-3">
              <div class="card">
                <div class="card-body text-center">
                  <h3 class="text-success"><?= count(array_filter($pelamar, function($p) { return $p->total_lamaran > 0; })) ?></h3>
                  <p class="mb-0">Pelamar Aktif</p>
                </div>
              </div>
            </div>
            <div class="col-md-3 mb-3">
              <div class="card">
                <div class="card-body text-center">
                  <h3 class="text-warning"><?= count(array_filter($pelamar, function($p) { return $p->total_lamaran == 0; })) ?></h3>
                  <p class="mb-0">Belum Melamar</p>
                </div>
              </div>
            </div>
            <div class="col-md-3 mb-3">
              <div class="card">
                <div class="card-body text-center">
                  <h3 class="text-primary"><?= count($pelamar) > 0 ? round(array_sum(array_column($pelamar, 'total_lamaran')) / count($pelamar), 1) : 0 ?></h3>
                  <p class="mb-0">Rata-rata Lamaran</p>
                </div>
              </div>
            </div>
          </div>

          <!-- Charts Section -->
          <div class="row mb-4 px-3">
            <div class="col-md-6 mb-3">
              <div class="card">
                <div class="card-header pb-0">
                  <h6>Statistik Berdasarkan Pendidikan</h6>
                </div>
                <div class="card-body">
                  <canvas id="educationChart" width="400" height="200"></canvas>
                </div>
              </div>
            </div>
            <div class="col-md-6 mb-3">
              <div class="card">
                <div class="card-header pb-0">
                  <h6>Trend Registrasi Bulanan</h6>
                </div>
                <div class="card-body">
                  <canvas id="registrationChart" width="400" height="200"></canvas>
                </div>
              </div>
            </div>
          </div>

          <!-- Top Locations Table -->
          <div class="row mb-4 px-3">
            <div class="col-12">
              <div class="card">
                <div class="card-header pb-0">
                  <h6>Top 10 Lokasi Pelamar</h6>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table align-items-center mb-0">
                      <thead>
                        <tr>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Ranking</th>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Lokasi</th>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jumlah Pelamar</th>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Persentase</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $rank = 1; foreach ($statistik_pelamar['berdasarkan_lokasi'] as $location_stat) : ?>
                        <tr>
                          <td class="ps-4">
                            <p class="text-xs font-weight-bold mb-0"><?= $rank++ ?></p>
                          </td>
                          <td>
                            <h6 class="mb-0 text-sm"><?= trim($location_stat->lokasi) ?></h6>
                          </td>
                          <td>
                            <p class="text-xs font-weight-bold mb-0"><?= $location_stat->jumlah ?></p>
                          </td>
                          <td>
                            <div class="progress-wrapper w-75 mx-auto">
                              <div class="progress-info">
                                <div class="progress-percentage">
                                  <span class="text-xs font-weight-bold"><?= round(($location_stat->jumlah / count($pelamar)) * 100, 1) ?>%</span>
                                </div>
                              </div>
                              <div class="progress">
                                <div class="progress-bar bg-gradient-info" style="width: <?= round(($location_stat->jumlah / count($pelamar)) * 100, 1) ?>%"></div>
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
              <table class="table align-items-center mb-0" id="pelamarTable">
                <thead>
                  <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Lengkap</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Email</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Pendidikan</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Total Lamaran</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal Daftar</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Last Login</th>
                    <!-- <th class="text-secondary opacity-7">Aksi</th> -->
                  </tr>
                </thead>
                <tbody>
                  <?php $no = 1; foreach ($pelamar as $applicant) : ?>
                  <tr>
                    <td class="ps-4">
                      <p class="text-xs font-weight-bold mb-0"><?= $no++ ?></p>
                    </td>
                    <td>
                      <div class="d-flex px-2 py-1">
                        <div class="d-flex flex-column justify-content-center">
                          <h6 class="mb-0 text-sm"><?= $applicant->nama_lengkap ?></h6>
                          <p class="text-xs text-secondary mb-0"><?= character_limiter($applicant->alamat, 30) ?></p>
                        </div>
                      </div>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0"><?= $applicant->email ?></p>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0"><?= $applicant->pendidikan ?: '-' ?></p>
                    </td>
                    <td>
                      <span class="badge badge-sm bg-gradient-<?= $applicant->total_lamaran > 0 ? 'success' : 'secondary' ?>">
                        <?= $applicant->total_lamaran ?>
                      </span>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0"><?= date('d/m/Y', strtotime($applicant->dibuat_pada)) ?></p>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0">
                        <?= $applicant->login_terakhir ? date('d/m/Y H:i', strtotime($applicant->login_terakhir)) : 'Belum pernah' ?>
                      </p>
                    </td>
                    <!-- <td class="align-middle">
                      <a href="<?= base_url('admin/profil_pelamar/' . $applicant->id) ?>" class="text-secondary font-weight-bold text-xs me-2" data-toggle="tooltip" data-original-title="Lihat profil">
                        <i class="material-icons">visibility</i>
                      </a>
                      <a href="<?= base_url('admin/lamaran_pelamar/' . $applicant->id) ?>" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Lihat lamaran">
                        <i class="material-icons">assignment</i>
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




const educationCtx = document.getElementById('educationChart').getContext('2d');
const educationChart = new Chart(educationCtx, {
  type: 'doughnut',
  data: {
    labels: <?= json_encode(array_column($statistik_pelamar['berdasarkan_pendidikan'], 'pendidikan')) ?>,
    datasets: [{
      data: <?= json_encode(array_column($statistik_pelamar['berdasarkan_pendidikan'], 'jumlah')) ?>,
      backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF']
    }]
  },
  options: {
    responsive: true,
    maintainAspectRatio: false
  }
});


const registrationCtx = document.getElementById('registrationChart').getContext('2d');
const registrationChart = new Chart(registrationCtx, {
  type: 'line',
  data: {
    labels: <?= json_encode(array_map(function($item) { return date('M Y', mktime(0, 0, 0, $item->bulan, 1, $item->tahun)); }, $statistik_pelamar['registrasi_bulanan'])) ?>,
    datasets: [{
      label: 'Registrasi Pelamar',
      data: <?= json_encode(array_column($statistik_pelamar['registrasi_bulanan'], 'jumlah')) ?>,
      borderColor: '#2196F3',
      backgroundColor: 'rgba(33, 150, 243, 0.1)',
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
  window.open('<?= base_url('admin/export_laporan?jenis=pelamar') ?>&' + params.toString());
}

function printReport() {
    // Get current filters
    const form = document.getElementById('filter-form');
    const formData = new FormData(form);
    const params = new URLSearchParams(formData);
    
    // Open print window
    window.open('<?= base_url('admin/print_laporan_pelamar') ?>?' + params.toString(), '_blank');
}
</script>
