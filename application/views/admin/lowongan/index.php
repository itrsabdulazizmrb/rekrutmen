<div class="row">
  <div class="col-12">
    <div class="card shadow-sm mb-4">
      <div class="card-header pb-0">
        <div class="d-flex justify-content-between align-items-center">
          <div>
            <h6 class="mb-1">Manajemen Lowongan Pekerjaan</h6>
            <p class="text-sm mb-0">
              <i class="fa fa-info-circle text-primary" aria-hidden="true"></i>
              <span class="font-weight-bold">Kelola semua lowongan pekerjaan di sini</span>
            </p>
          </div>
          <div>
            <a href="<?= base_url('admin/tambahLowongan') ?>" class="btn btn-sm btn-primary me-2">
              <i class="fas fa-plus me-2"></i> Tambah Lowongan Baru
            </a>
            <a href="<?= base_url('admin/kategori') ?>" class="btn btn-sm btn-info">
              <i class="fas fa-tasks me-2"></i> Kategori Lowongan
            </a>
          </div>

        </div>
      </div>
      <div class="card-body p-0">
        <div class="table-responsive p-0" style="min-height: 500px; overflow-y: auto;">
          <?php if (empty($jobs)) : ?>
            <div class="text-center py-5">
              <h4 class="text-secondary">Tidak ada lowongan yang ditemukan</h4>
              <p class="text-muted">Mulai dengan menambahkan lowongan pekerjaan baru.</p>
              <a href="<?= base_url('admin/tambahLowongan') ?>" class="btn btn-primary mt-3">Tambah Lowongan Baru</a>
            </div>
          <?php else : ?>
            <table class="table align-items-center mb-0 datatable">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Lowongan</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Kategori</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Lokasi</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tipe</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Batas Waktu</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Pelamar</th>
                  <th class="text-secondary opacity-7"></th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($jobs as $job) : ?>
                  <tr>
                    <td>
                      <div class="d-flex px-2 py-1">
                        <!-- <div>
                          <img src="<?= base_url('assets/img/small-logos/logo-company.svg') ?>" class="avatar avatar-sm me-3" alt="job">
                        </div> -->
                        <div class="d-flex flex-column justify-content-center">
                          <h6 class="mb-0 text-sm"><?= $job->judul ?></h6>
                          <p class="text-xs text-secondary mb-0">Dibuat oleh: <?= $job->created_by_name ?></p>
                        </div>
                      </div>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0"><?= $job->category_name ?></p>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0"><?= $job->lokasi ?></p>
                    </td>
                    <td class="align-middle text-center text-sm">
                      <span class="badge badge-sm bg-gradient-<?= $job->jenis_pekerjaan == 'penuh_waktu' ? 'success' : ($job->jenis_pekerjaan == 'paruh_waktu' ? 'info' : ($job->jenis_pekerjaan == 'kontrak' ? 'warning' : 'secondary')) ?>"><?= $job->jenis_pekerjaan == 'penuh_waktu' ? 'Full Time' : ($job->jenis_pekerjaan == 'paruh_waktu' ? 'Part Time' : ($job->jenis_pekerjaan == 'kontrak' ? 'Kontrak' : 'Magang')) ?></span>
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold"><?= date('d M Y', strtotime($job->batas_waktu)) ?></span>
                    </td>
                    <td class="align-middle text-center text-sm">
                      <span class="badge badge-sm bg-gradient-<?= $job->status == 'aktif' ? 'success' : ($job->status == 'draft' ? 'secondary' : 'danger') ?>"><?= $job->status == 'aktif' ? 'Aktif' : ($job->status == 'draft' ? 'Draft' : 'Tidak Aktif') ?></span>
                    </td>
                    <td class="align-middle text-center">
                      <?php
                      $applicant_count = $this->model_lamaran->hitung_lamaran_berdasarkan_lowongan($job->id);
                      ?>
                      <a href="<?= base_url('admin/lamaran_lowongan/' . $job->id) ?>" class="text-secondary font-weight-bold text-xs">
                        <?= $applicant_count ?> Pelamar
                      </a>
                    </td>
                    <td class="align-middle">
                      <div class="dropdown">
                        <button type="button" class="btn btn-sm btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                          <i class="fas fa-ellipsis-v"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end px-2 py-3" aria-labelledby="dropdownMenuButton">
                          <li><a class="dropdown-item border-radius-md" href="<?= base_url('lowongan/detail/' . $job->id) ?>" target="_blank"><i class="fas fa-eye me-2"></i> Lihat</a></li>
                          <li><a class="dropdown-item border-radius-md" href="<?= base_url('admin/edit_lowongan/' . $job->id) ?>"><i class="fas fa-edit me-2"></i> Edit</a></li>
                          <li><a class="dropdown-item border-radius-md" href="<?= base_url('admin/dokumen_lowongan/' . $job->id) ?>"><i class="fas fa-file-alt me-2"></i> Kelola Dokumen Persyaratan</a></li>
                          <li><a class="dropdown-item border-radius-md" href="<?= base_url('admin/lamaran_lowongan/' . $job->id) ?>"><i class="fas fa-users me-2"></i> Lihat Pelamar</a></li>
                          <li><a class="dropdown-item border-radius-md" href="<?= base_url('admin/atur_penilaian/' . $job->id) ?>"><i class="fas fa-tasks me-2"></i> Atur Penilaian</a></li>
                          <li>
                            <hr class="dropdown-divider">
                          </li>
                          <li>
                            <a class="dropdown-item border-radius-md text-danger btn-delete" href="<?= base_url('admin/hapus_lowongan/' . $job->id) ?>" data-confirm-message="Apakah Anda yakin ingin menghapus lowongan ini?">
                              <i class="fas fa-trash me-2"></i> Hapus
                            </a>
                          </li>
                        </ul>
                      </div>
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
  <div class="col-md-6">
    <div class="card shadow-sm">
      <div class="card-header">
        <h6 class="mb-0">Statistik Lowongan</h6>
      </div>
      <div class="card-body">
        <div class="chart">
          <canvas id="job-stats-chart" class="chart-canvas" height="300"></canvas>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="card shadow-sm">
      <div class="card-header">
        <h6 class="mb-0">Lowongan Berdasarkan Kategori</h6>
      </div>
      <div class="card-body">
        <div class="chart">
          <canvas id="job-category-chart" class="chart-canvas" height="300"></canvas>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    
    var ctx1 = document.getElementById("job-stats-chart").getContext("2d");
    new Chart(ctx1, {
      type: "bar",
      data: {
        labels: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Ags", "Sep", "Okt", "Nov", "Des"],
        datasets: [{
          label: "Lowongan Dibuat",
          backgroundColor: "#5e72e4",
          data: [
            <?php
            if (isset($monthly_job_stats) && !empty($monthly_job_stats)) {
              for ($i = 1; $i <= 12; $i++) {
                echo isset($monthly_job_stats[$i]) ? $monthly_job_stats[$i] : 0;
                if ($i < 12) echo ', ';
              }
            } else {
              echo '0,0,0,0,0,0,0,0,0,0,0,0';
            }
            ?>
          ],
        }],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: false,
          }
        },
        scales: {
          y: {
            beginAtZero: true
          }
        },
      },
    });

    
    var ctx2 = document.getElementById("job-category-chart").getContext("2d");
    new Chart(ctx2, {
      type: "doughnut",
      data: {
        labels: [
          <?php
          if (isset($job_stats_by_category) && !empty($job_stats_by_category)) {
            foreach ($job_stats_by_category as $index => $category) {
              echo '"' . (isset($category->kategori) ? $category->kategori : 'Tidak Berkategori') . '"';
              if ($index < count($job_stats_by_category) - 1) echo ', ';
            }
          } else {
            echo '"Belum ada data"';
          }
          ?>
        ],
        datasets: [{
          label: "Lowongan",
          backgroundColor: ["#5e72e4", "#2dce89", "#fb6340", "#11cdef", "#f5365c", "#8898aa", "#ffd600", "#8965e0"],
          data: [
            <?php
            if (isset($job_stats_by_category) && !empty($job_stats_by_category)) {
              foreach ($job_stats_by_category as $index => $category) {
                echo isset($category->jumlah) ? $category->jumlah : 0;
                if ($index < count($job_stats_by_category) - 1) echo ', ';
              }
            } else {
              echo '0';
            }
            ?>
          ],
        }],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            position: 'right',
          }
        },
      },
    });
  });
</script>




