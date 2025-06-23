<div class="row">
  <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
    <div class="card">
      <div class="card-body p-3">
        <div class="row">
          <div class="col-8">
            <div class="numbers">
              <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Lowongan</p>
              <h5 class="font-weight-bolder"><?= isset($total_jobs) ? $total_jobs : 0 ?></h5>
              <p class="mb-0">
                <span class="text-success text-sm font-weight-bolder"><?= isset($active_jobs) ? $active_jobs : 0 ?></span>
                <span class="text-sm">Aktif</span>
              </p>
            </div>
          </div>
          <div class="col-4 text-end">
            <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
              <i class="ni ni-briefcase-24 text-lg opacity-10" aria-hidden="true"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
    <div class="card">
      <div class="card-body p-3">
        <div class="row">
          <div class="col-8">
            <div class="numbers">
              <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Lamaran</p>
              <h5 class="font-weight-bolder"><?= isset($total_applications) ? $total_applications : 0 ?></h5>
              <p class="mb-0">
                <span class="text-info text-sm font-weight-bolder"><?= isset($new_applications) ? $new_applications : 0 ?></span>
                <span class="text-sm">Hari Ini</span>
              </p>
            </div>
          </div>
          <div class="col-4 text-end">
            <div class="icon icon-shape bg-gradient-info shadow-info text-center rounded-circle">
              <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
    <div class="card">
      <div class="card-body p-3">
        <div class="row">
          <div class="col-8">
            <div class="numbers">
              <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Pelamar</p>
              <h5 class="font-weight-bolder"><?= isset($total_applicants) ? $total_applicants : 0 ?></h5>
              <p class="mb-0">
                <span class="text-success text-sm font-weight-bolder"><?= isset($active_applicants) ? $active_applicants : 0 ?></span>
                <span class="text-sm">Aktif</span>
              </p>
            </div>
          </div>
          <div class="col-4 text-end">
            <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
              <i class="ni ni-single-02 text-lg opacity-10" aria-hidden="true"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-sm-6">
    <div class="card">
      <div class="card-body p-3">
        <div class="row">
          <div class="col-8">
            <div class="numbers">
              <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Penilaian</p>
              <h5 class="font-weight-bolder"><?= isset($total_assessments) ? $total_assessments : 0 ?></h5>
              <p class="mb-0">
                <span class="text-warning text-sm font-weight-bolder"><?= isset($pending_assessments) ? $pending_assessments : 0 ?></span>
                <span class="text-sm">Menunggu</span>
              </p>
            </div>
          </div>
          <div class="col-4 text-end">
            <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
              <i class="ni ni-ruler-pencil text-lg opacity-10" aria-hidden="true"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row mt-4">
  <div class="col-lg-8 mb-lg-0 mb-4">
    <div class="card z-index-2 h-100">
      <div class="card-header pb-0 pt-3 bg-transparent">
        <h6 class="text-capitalize">Tren Lamaran</h6>
        <p class="text-sm mb-0">
          <?php
          $trend_percentage = isset($application_trend) ? $application_trend : 0;
          $trend_class = $trend_percentage >= 0 ? 'text-success' : 'text-danger';
          $trend_icon = $trend_percentage >= 0 ? 'fa-arrow-up' : 'fa-arrow-down';
          ?>
          <i class="fa <?= $trend_icon ?> <?= $trend_class ?>"></i>
          <span class="font-weight-bold"><?= abs($trend_percentage) ?>% <?= $trend_percentage >= 0 ? 'lebih tinggi' : 'lebih rendah' ?></span> dari bulan lalu
        </p>
      </div>
      <div class="card-body p-3">
        <div class="chart">
          <canvas id="chart-line" class="chart-canvas" height="300"></canvas>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-4">
    <div class="card h-100">
      <div class="card-header pb-0 p-3">
        <h6 class="mb-0">Status Lamaran</h6>
      </div>
      <div class="card-body p-3">
        <div class="chart">
          <canvas id="application-status-chart" class="chart-canvas" height="300"></canvas>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row mt-4">
  <div class="col-lg-8 mb-lg-0 mb-4">
    <div class="card">
      <div class="card-header pb-0 p-3">
        <div class="d-flex justify-content-between">
          <h6 class="mb-2">Lamaran Terbaru</h6>
          <a href="<?= base_url('admin/lamaran') ?>" class="btn btn-sm btn-primary">Lihat Semua</a>
        </div>
      </div>
      <div class="table-responsive">
        <table class="table align-items-center mb-0 datatable">
          <thead>
            <tr>
              <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Pelamar</th>
              <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Lowongan</th>
              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal</th>
              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
              <th class="text-secondary opacity-7"></th>
            </tr>
          </thead>
          <tbody>
            <?php if (isset($recent_applications) && !empty($recent_applications)) : ?>
              <?php foreach ($recent_applications as $application) : ?>
                <tr>
                  <td>
                    <div class="d-flex px-2 py-1">
                      <div>
                        <?php if (isset($application->profile_picture) && !empty($application->profile_picture)) : ?>
                          <img src="<?= base_url('uploads/profile_pictures/' . $application->profile_picture) ?>" class="avatar avatar-sm me-3" alt="<?= htmlspecialchars($application->applicant_name) ?>">
                        <?php else : ?>
                          <img src="<?= base_url('assets/img/team-2.jpg') ?>" class="avatar avatar-sm me-3" alt="Default Avatar">
                        <?php endif; ?>
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="mb-0 text-sm"><?= htmlspecialchars($application->applicant_name ?? 'N/A') ?></h6>
                        <p class="text-xs text-secondary mb-0"><?= htmlspecialchars($application->applicant_email ?? 'N/A') ?></p>
                      </div>
                    </div>
                  </td>
                  <td>
                    <p class="text-xs font-weight-bold mb-0"><?= htmlspecialchars($application->job_title ?? 'N/A') ?></p>
                  </td>
                  <td class="align-middle text-center">
                    <span class="text-secondary text-xs font-weight-bold">
                      <?= isset($application->tanggal_lamaran) ? date('d M Y', strtotime($application->tanggal_lamaran)) : 'N/A' ?>
                    </span>
                  </td>
                  <td class="align-middle text-center text-sm">
                    <?php
                    $status = $application->status ?? 'unknown';
                    $status_class = 'secondary';
                    switch($status) {
                      case 'menunggu':
                        $status_class = 'warning';
                        break;
                      case 'direview':
                        $status_class = 'info';
                        break;
                      case 'seleksi':
                        $status_class = 'primary';
                        break;
                      case 'wawancara':
                        $status_class = 'success';
                        break;
                      case 'diterima':
                        $status_class = 'success';
                        break;
                      case 'ditolak':
                        $status_class = 'danger';
                        break;
                    }
                    ?>
                    <span class="badge badge-sm bg-gradient-<?= $status_class ?>"><?= ucfirst($status) ?></span>
                  </td>
                  <td class="align-middle">
                    <a href="<?= base_url('admin/detail_lamaran/' . ($application->id ?? '#')) ?>" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Lihat detail">
                      Detail
                    </a>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php else : ?>
              <tr>
                <td colspan="5" class="text-center py-4">
                  <p class="text-muted mb-0">Belum ada lamaran terbaru</p>
                </td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>

    <!-- Notification Widget -->
    <!-- <div class="card mt-4">
      <div class="card-header pb-0 p-3">
        <div class="d-flex justify-content-between align-items-center">
          <h6 class="mb-0">Notifikasi Terbaru</h6>
          <a href="<?= base_url('admin/notifikasi') ?>" class="btn btn-link text-primary p-0">
            <i class="ni ni-bold-right"></i>
          </a>
        </div>
      </div>
      <div class="card-body p-3">
        <div id="dashboard-notifications" style="max-height: 250px; overflow-y: auto;">
          <div class="text-center py-3">
            <div class="spinner-border spinner-border-sm text-primary" role="status">
              <span class="visually-hidden">Loading...</span>
            </div>
            <p class="text-sm text-muted mt-2 mb-0">Memuat notifikasi...</p>
          </div>
        </div>
      </div>
    </div> -->

    <div class="card mt-4">
      <div class="card-header pb-0 p-3">
        <h6 class="mb-0">Aktivitas Terbaru</h6>
      </div>
      <div class="card-body p-3">
        <div class="timeline timeline-one-side">
          <?php if (isset($recent_activities) && !empty($recent_activities)) : ?>
            <?php foreach ($recent_activities as $activity) : ?>
              <div class="timeline-block mb-3">
                <span class="timeline-step">
                  <?php
                  $activity_type = $activity->type ?? 'default';
                  switch($activity_type) {
                    case 'job':
                      echo '<i class="ni ni-briefcase-24 text-primary"></i>';
                      break;
                    case 'application':
                      echo '<i class="ni ni-paper-diploma text-danger"></i>';
                      break;
                    case 'user':
                      echo '<i class="ni ni-single-02 text-success"></i>';
                      break;
                    case 'assessment':
                      echo '<i class="ni ni-ruler-pencil text-warning"></i>';
                      break;
                    default:
                      echo '<i class="ni ni-bell-55 text-info"></i>';
                      break;
                  }
                  ?>
                </span>
                <div class="timeline-content">
                  <h6 class="text-dark text-sm font-weight-bold mb-0"><?= htmlspecialchars($activity->description ?? 'Aktivitas baru') ?></h6>
                  <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">
                    <?= isset($activity->created_at) ? date('d M Y H:i', strtotime($activity->created_at)) : date('d M Y H:i') ?>
                  </p>
                </div>
              </div>
            <?php endforeach; ?>
          <?php else : ?>
            <div class="text-center py-4">
              <p class="text-muted mb-0">Belum ada aktivitas terbaru</p>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-4">
    <div class="card mb-4">
      <div class="card-header pb-0 p-3">
        <h6 class="mb-0">Jumlah Pelamar per Posisi</h6>
      </div>
      <div class="card-body p-3">
        <div class="chart">
          <canvas id="applications-per-job-chart" class="chart-canvas" height="250"></canvas>
        </div>
      </div>
    </div>

    <div class="card">
      <div class="card-header pb-0 p-3">
        <h6 class="mb-0">Kategori Lowongan</h6>
      </div>
      <div class="card-body p-3">
        <div class="chart mb-3">
          <canvas id="job-category-chart" class="chart-canvas" height="200"></canvas>
        </div>
        <ul class="list-group">
          <?php if (isset($job_categories) && !empty($job_categories)) : ?>
            <?php
            $colors = ['primary', 'success', 'warning', 'info', 'danger', 'secondary'];
            $color_index = 0;
            ?>
            <?php foreach ($job_categories as $category) : ?>
              <?php
              $color = $colors[$color_index % count($colors)];
              $color_index++;
              ?>
              <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                <div class="d-flex align-items-center">
                  <div class="icon icon-shape icon-sm me-3 bg-gradient-<?= $color ?> shadow text-center">
                    <i class="ni ni-tag text-white opacity-10"></i>
                  </div>
                  <div class="d-flex flex-column">
                    <h6 class="mb-1 text-dark text-sm"><?= htmlspecialchars($category->nama ?? 'N/A') ?></h6>
                    <span class="text-xs"><?= isset($category->jumlah_lowongan) ? $category->jumlah_lowongan : 0 ?> Lowongan</span>
                  </div>
                </div>
                <div class="d-flex">
                  <a href="<?= base_url('admin/lowongan?category=' . ($category->id ?? '')) ?>" class="btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto">
                    <i class="ni ni-bold-right" aria-hidden="true"></i>
                  </a>
                </div>
              </li>
            <?php endforeach; ?>
          <?php else : ?>
            <li class="list-group-item border-0 text-center py-3">
              <p class="text-muted mb-0">Belum ada kategori lowongan</p>
            </li>
          <?php endif; ?>
        </ul>
      </div>
    </div>
  </div>
</div>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    var ctx1 = document.getElementById("chart-line").getContext("2d");

    var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);
    gradientStroke1.addColorStop(1, 'rgba(94, 114, 228, 0.2)');
    gradientStroke1.addColorStop(0.2, 'rgba(94, 114, 228, 0.0)');
    gradientStroke1.addColorStop(0, 'rgba(94, 114, 228, 0)');

    new Chart(ctx1, {
      type: "line",
      data: {
        labels: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Ags", "Sep", "Okt", "Nov", "Des"],
        datasets: [{
          label: "Lamaran",
          tension: 0.4,
          borderWidth: 0,
          pointRadius: 0,
          borderColor: "#5e72e4",
          backgroundColor: gradientStroke1,
          borderWidth: 3,
          fill: true,
          data: [
            <?php
            if (isset($monthly_application_stats) && is_array($monthly_application_stats)) {
              for ($i = 1; $i <= 12; $i++) {
                echo isset($monthly_application_stats[$i]) ? $monthly_application_stats[$i] : 0;
                if ($i < 12) echo ', ';
              }
            } else {
              echo '0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0';
            }
            ?>
          ],
          maxBarThickness: 6
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
        interaction: {
          intersect: false,
          mode: 'index',
        },
        scales: {
          y: {
            grid: {
              drawBorder: false,
              display: true,
              drawOnChartArea: true,
              drawTicks: false,
              borderDash: [5, 5]
            },
            ticks: {
              display: true,
              padding: 10,
              color: '#666',
              font: {
                size: 11,
                family: "Open Sans",
                style: 'normal',
                lineHeight: 2
              },
            }
          },
          x: {
            grid: {
              drawBorder: false,
              display: false,
              drawOnChartArea: false,
              drawTicks: false,
              borderDash: [5, 5]
            },
            ticks: {
              display: true,
              color: '#666',
              padding: 20,
              font: {
                size: 11,
                family: "Open Sans",
                style: 'normal',
                lineHeight: 2
              },
            }
          },
        },
      },
    });

    var ctx2 = document.getElementById("job-category-chart").getContext("2d");
    new Chart(ctx2, {
      type: "doughnut",
      data: {
        labels: [
          <?php
          if (isset($job_categories) && !empty($job_categories)) {
            foreach ($job_categories as $index => $category) {
              echo '"' . htmlspecialchars($category->nama ?? 'N/A') . '"';
              if ($index < count($job_categories) - 1) echo ', ';
            }
          } else {
            echo '"Belum ada kategori"';
          }
          ?>
        ],
        datasets: [{
          label: "Lowongan",
          backgroundColor: ["#5e72e4", "#2dce89", "#f5365c", "#fb6340", "#11cdef", "#ffd600", "#8965e0", "#f3a4b5"],
          data: [
            <?php
            if (isset($job_categories) && !empty($job_categories)) {
              foreach ($job_categories as $index => $category) {
                echo isset($category->jumlah_lowongan) ? $category->jumlah_lowongan : 0;
                if ($index < count($job_categories) - 1) echo ', ';
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
            labels: {
              boxWidth: 10,
              font: {
                size: 10
              }
            }
          }
        },
        cutout: '60%'
      },
    });

    var ctx3 = document.getElementById("application-status-chart").getContext("2d");
    new Chart(ctx3, {
      type: "pie",
      data: {
        labels: ["Menunggu", "Direview", "Seleksi", "Wawancara", "Diterima"],
        datasets: [{
          label: "Pelamar",
          backgroundColor: ["#fb6340", "#11cdef", "#2dce89", "#5e72e4", "#2dce89"],
          data: [
            <?php
            if (isset($application_status_stats) && is_array($application_status_stats)) {
              $statuses = ['menunggu', 'direview', 'seleksi', 'wawancara', 'diterima'];
              foreach ($statuses as $index => $status) {
                echo isset($application_status_stats[$status]) ? $application_status_stats[$status] : 0;
                if ($index < count($statuses) - 1) echo ', ';
              }
            } else {
              echo '0, 0, 0, 0, 0';
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
            labels: {
              boxWidth: 10,
              font: {
                size: 10
              }
            }
          }
        },
      },
    });

    var ctx4 = document.getElementById("applications-per-job-chart").getContext("2d");
    new Chart(ctx4, {
      type: "bar",
      data: {
        labels: [
          <?php
          if (isset($applications_per_job) && !empty($applications_per_job)) {
            foreach ($applications_per_job as $index => $job) {
              $job_title = isset($job->judul) ? $job->judul : 'N/A';
              $short_title = strlen($job_title) > 20 ? substr($job_title, 0, 20) . '...' : $job_title;
              echo '"' . htmlspecialchars($short_title) . '"';
              if ($index < count($applications_per_job) - 1) echo ', ';
            }
          } else {
            echo '"Belum ada lowongan"';
          }
          ?>
        ],
        datasets: [{
          label: "Jumlah Pelamar",
          backgroundColor: "#5e72e4",
          data: [
            <?php
            if (isset($applications_per_job) && !empty($applications_per_job)) {
              foreach ($applications_per_job as $index => $job) {
                echo isset($job->jumlah_lamaran) ? $job->jumlah_lamaran : 0;
                if ($index < count($applications_per_job) - 1) echo ', ';
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
            display: false,
          }
        },
        scales: {
          y: {
            beginAtZero: true,
            grid: {
              drawBorder: false,
              display: true,
              drawOnChartArea: true,
              drawTicks: false,
              borderDash: [5, 5]
            },
            ticks: {
              precision: 0
            }
          },
          x: {
            grid: {
              drawBorder: false,
              display: false,
              drawOnChartArea: false,
              drawTicks: false
            },
            ticks: {
              font: {
                size: 10
              }
            }
          },
        },
      },
    });

    
    loadDashboardNotifications();
  });

  
  function loadDashboardNotifications() {
    fetch('<?= base_url("admin/api_notifikasi") ?>?limit=5', {
      method: 'GET',
      headers: {
        'X-Requested-With': 'XMLHttpRequest'
      }
    })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        updateDashboardNotifications(data.data);
      }
    })
    .catch(error => {
      console.error('Error loading dashboard notifications:', error);
      document.getElementById('dashboard-notifications').innerHTML = `
        <div class="text-center py-3">
          <i class="ni ni-fat-remove text-danger" style="font-size: 2rem;"></i>
          <p class="text-sm text-muted mt-2 mb-0">Gagal memuat notifikasi</p>
        </div>
      `;
    });
  }

  
  function updateDashboardNotifications(notifications) {
    const container = document.getElementById('dashboard-notifications');

    if (notifications.length === 0) {
      container.innerHTML = `
        <div class="text-center py-3">
          <i class="ni ni-check-bold text-success" style="font-size: 2rem;"></i>
          <p class="text-sm text-muted mt-2 mb-0">Tidak ada notifikasi baru</p>
        </div>
      `;
      return;
    }

    let html = '';
    notifications.forEach((notification, index) => {
      const timeAgo = getTimeAgo(notification.dibuat_pada);
      const iconClass = notification.icon || 'ni ni-bell-55';
      const colorClass = notification.warna || 'primary';
      const isUnread = notification.status === 'belum_dibaca';

      html += `
        <div class="d-flex align-items-start mb-3 ${isUnread ? 'bg-light rounded p-2' : ''}">
          <div class="icon icon-shape icon-sm bg-gradient-${colorClass} shadow text-center border-radius-md me-3">
            <i class="${iconClass} text-white opacity-10"></i>
          </div>
          <div class="flex-grow-1">
            <h6 class="mb-1 text-sm ${isUnread ? 'font-weight-bold' : ''}">
              ${escapeHtml(notification.judul)}
            </h6>
            <p class="text-xs text-secondary mb-1">
              ${escapeHtml(notification.pesan.substring(0, 60))}${notification.pesan.length > 60 ? '...' : ''}
            </p>
            <p class="text-xs text-secondary mb-0">
              <i class="fa fa-clock me-1"></i>
              ${timeAgo}
            </p>
          </div>
          ${notification.url_aksi ? `
            <a href="<?= base_url() ?>${notification.url_aksi}" class="btn btn-link text-primary p-0" onclick="markNotificationAsRead(${notification.id})">
              <i class="ni ni-bold-right"></i>
            </a>
          ` : ''}
        </div>
      `;

      
      if (index < notifications.length - 1) {
        html += '<hr class="my-2">';
      }
    });

    container.innerHTML = html;
  }

  
  if (typeof escapeHtml === 'undefined') {
    function escapeHtml(text) {
      const map = {
        '&': '&amp;',
        '<': '&lt;',
        '>': '&gt;',
        '"': '&quot;',
        "'": '&#039;'
      };
      return text.replace(/[&<>"']/g, function(m) { return map[m]; });
    }
  }

  
  if (typeof getTimeAgo === 'undefined') {
    function getTimeAgo(dateString) {
      const now = new Date();
      const date = new Date(dateString);
      const diffInSeconds = Math.floor((now - date) / 1000);

      if (diffInSeconds < 60) {
        return 'Baru saja';
      } else if (diffInSeconds < 3600) {
        const minutes = Math.floor(diffInSeconds / 60);
        return minutes + ' menit yang lalu';
      } else if (diffInSeconds < 86400) {
        const hours = Math.floor(diffInSeconds / 3600);
        return hours + ' jam yang lalu';
      } else {
        const days = Math.floor(diffInSeconds / 86400);
        return days + ' hari yang lalu';
      }
    }
  }
</script>
