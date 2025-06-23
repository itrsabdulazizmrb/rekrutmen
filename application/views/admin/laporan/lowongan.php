<!-- Content Wrapper -->
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card my-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
          <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
            <h6 class="text-white text-capitalize ps-3">Laporan Lowongan Pekerjaan</h6>
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
                  <form method="GET" action="<?= base_url('admin/laporan_lowongan') ?>" id="filter-form">
                    <div class="row">
                      <div class="col-md-2">
                        <div class="input-group input-group-outline mb-3">
                          <!-- <label class="form-label">Periode</label> -->
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

                      <div class="col-md-2">
                        <div class="input-group input-group-outline mb-3">
                          <!-- <label class="form-label">Kategori</label> -->
                          <select class="form-control" name="kategori">
                            <option value="">Semua Kategori</option>
                            <?php foreach ($categories as $category) : ?>
                              <option value="<?= $category->id ?>" <?= $filters['kategori'] == $category->id ? 'selected' : '' ?>><?= $category->nama ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                      </div>

                      <div class="col-md-2">
                        <div class="input-group input-group-outline mb-3">
                          <!-- <label class="form-label">Status</label> -->
                          <select class="form-control" name="status">
                            <option value="">Semua Status</option>
                            <option value="aktif" <?= $filters['status'] == 'aktif' ? 'selected' : '' ?>>Aktif</option>
                            <option value="nonaktif" <?= $filters['status'] == 'nonaktif' ? 'selected' : '' ?>>Nonaktif</option>
                            <option value="expired" <?= $filters['status'] == 'expired' ? 'selected' : '' ?>>Expired</option>
                          </select>
                        </div>
                      </div>

                      <div class="col-md-2">
                        <div class="input-group input-group-outline mb-3">
                          <!-- <label class="form-label">Lokasi</label> -->
                          <select class="form-control" name="lokasi">
                            <option value="">Semua Lokasi</option>
                            <?php foreach ($locations as $location) : ?>
                              <option value="<?= $location->lokasi ?>" <?= $filters['lokasi'] == $location->lokasi ? 'selected' : '' ?>><?= $location->lokasi ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-12">
                        <button type="submit" class="btn bg-gradient-primary me-2">
                          <i class="material-icons me-1"></i>Filter
                        </button>
                        <a href="<?= base_url('admin/laporan_lowongan') ?>" class="btn btn-outline-secondary me-2">
                          <i class="material-icons me-1"></i>Reset
                        </a>
                        <button type="button" class="btn bg-gradient-info" onclick="printReport()">
                          <i class="material-icons me-1"></i>Cetak Laporan
                        </button>
                        <!-- <button type="button" class="btn bg-gradient-success me-2" onclick="exportData('excel')">
                          <i class="material-icons me-1">file_download</i>Excel
                        </button>
                        <button type="button" class="btn bg-gradient-danger me-2" onclick="exportData('pdf')">
                          <i class="material-icons me-1">picture_as_pdf</i>PDF
                        </button>
                        <button type="button" class="btn bg-gradient-info" onclick="printReport()">
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
                  <h3 class="text-primary"><?= count($lowongan) ?></h3>
                  <p class="mb-0">Total Lowongan</p>
                </div>
              </div>
            </div>
            <div class="col-md-3 mb-3">
              <div class="card">
                <div class="card-body text-center">
                  <h3 class="text-success"><?= count(array_filter($lowongan, function($l) { return $l->status == 'aktif'; })) ?></h3>
                  <p class="mb-0">Lowongan Aktif</p>
                </div>
              </div>
            </div>
            <div class="col-md-3 mb-3">
              <div class="card">
                <div class="card-body text-center">
                  <h3 class="text-warning"><?= count(array_filter($lowongan, function($l) { return $l->status == 'nonaktif'; })) ?></h3>
                  <p class="mb-0">Lowongan Nonaktif</p>
                </div>
              </div>
            </div>
            <div class="col-md-3 mb-3">
              <div class="card">
                <div class="card-body text-center">
                  <h3 class="text-danger"><?= count(array_filter($lowongan, function($l) { return strtotime($l->batas_waktu) < time(); })) ?></h3>
                  <p class="mb-0">Lowongan Expired</p>
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
                  <h6>Statistik Berdasarkan Kategori</h6>
                </div>
                <div class="card-body">
                  <canvas id="categoryChart" width="400" height="200"></canvas>
                </div>
              </div>
            </div>
          </div>

          <!-- Data Table -->
          <div class="px-3">
            <div class="table-responsive p-0">
              <table class="table align-items-center mb-0" id="lowonganTable">
                <thead>
                  <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Judul Lowongan</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kategori</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Lokasi</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal Dibuat</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Batas Waktu</th>
                    <!-- <th class="text-secondary opacity-7">Aksi</th> -->
                  </tr>
                </thead>
                <tbody>
                  <?php $no = 1; foreach ($lowongan as $job) : ?>
                  <tr>
                    <td class="ps-4">
                      <p class="text-xs font-weight-bold mb-0"><?= $no++ ?></p>
                    </td>
                    <td>
                      <div class="d-flex px-2 py-1">
                        <div class="d-flex flex-column justify-content-center">
                          <h6 class="mb-0 text-sm"><?= $job->judul ?></h6>
                          <p class="text-xs text-secondary mb-0"><?= character_limiter($job->deskripsi, 50) ?></p>
                        </div>
                      </div>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0"><?= $job->kategori_nama ?: 'Tidak ada kategori' ?></p>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0"><?= $job->lokasi ?></p>
                    </td>
                    <td>
                      <?php if ($job->status == 'aktif') : ?>
                        <span class="badge badge-sm bg-gradient-success">Aktif</span>
                      <?php elseif ($job->status == 'nonaktif') : ?>
                        <span class="badge badge-sm bg-gradient-warning">Nonaktif</span>
                      <?php else : ?>
                        <span class="badge badge-sm bg-gradient-danger">Expired</span>
                      <?php endif; ?>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0"><?= date('d/m/Y', strtotime($job->dibuat_pada)) ?></p>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0"><?= date('d/m/Y', strtotime($job->batas_waktu)) ?></p>
                    </td>
                    <!-- <td class="align-middle">
                      <a href="<?= base_url('admin/detail_lowongan/' . $job->id) ?>" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Lihat detail">
                      <button type="submit" class="btn bg-gradient-success">
                      <i class="fas fa-eye opacity-10"></i> Detail</i>
                      </button>
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




const statusCtx = document.getElementById('statusChart').getContext('2d');
const statusChart = new Chart(statusCtx, {
  type: 'doughnut',
  data: {
    labels: <?= json_encode(array_column($statistik_lowongan['berdasarkan_status'], 'status')) ?>,
    datasets: [{
      data: <?= json_encode(array_column($statistik_lowongan['berdasarkan_status'], 'jumlah')) ?>,
      backgroundColor: ['#4CAF50', '#FF9800', '#F44336']
    }]
  },
  options: {
    responsive: true,
    maintainAspectRatio: false
  }
});


const categoryCtx = document.getElementById('categoryChart').getContext('2d');
const categoryChart = new Chart(categoryCtx, {
  type: 'bar',
  data: {
    labels: <?= json_encode(array_column($statistik_lowongan['berdasarkan_kategori'], 'kategori')) ?>,
    datasets: [{
      label: 'Jumlah Lowongan',
      data: <?= json_encode(array_column($statistik_lowongan['berdasarkan_kategori'], 'jumlah')) ?>,
      backgroundColor: '#2196F3'
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
  window.open('<?= base_url('admin/export_laporan?jenis=lowongan') ?>&' + params.toString());
}

function printReport() {
    // Get current filters
    const form = document.getElementById('filter-form');
    const formData = new FormData(form);
    const params = new URLSearchParams(formData);
    
    // Open print window
    window.open('<?= base_url('admin/print_laporan_lowongan') ?>?' + params.toString(), '_blank');
}
</script>
