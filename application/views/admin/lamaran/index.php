<div class="row">
  <div class="col-12">
    <div class="card shadow-sm mb-4">
      <div class="card-header pb-0">
        <div class="d-flex justify-content-between align-items-center">
          <div>
            <h6 class="mb-1">Manajemen Lamaran</h6>
            <p class="text-sm mb-0">
              <i class="fa fa-info-circle text-primary" aria-hidden="true"></i>
              <span class="font-weight-bold">Kelola semua lamaran pekerjaan di sini</span>
            </p>
          </div>
        </div>
      </div>
      <div class="card-body p-0">

        <div class="table-responsive p-0" style="min-height: 500px; overflow-y: auto;">
          <?php if (empty($applications)) : ?>
            <div class="text-center py-5">
              <h4 class="text-secondary">Tidak ada lamaran yang ditemukan</h4>
              <p class="text-muted">Coba ubah filter atau cari dengan kata kunci yang berbeda.</p>
            </div>
          <?php else : ?>
            <table class="table align-items-center mb-0 datatable">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Pelamar</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Lowongan</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal Lamaran</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Penilaian</th>
                  <th class="text-secondary opacity-7"></th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($applications as $application) : ?>
                  <tr>
                    <td>
                      <div class="d-flex px-2 py-1">
                        <div>
                          <?php if ($application->profile_picture) : ?>
                            <img src="<?= base_url('uploads/profile_pictures/' . $application->profile_picture) ?>" class="avatar avatar-sm me-3" alt="user1">
                          <?php else : ?>
                            <img src="<?= base_url('assets/img/team-2.jpg') ?>" class="avatar avatar-sm me-3" alt="user1">
                          <?php endif; ?>
                        </div>
                        <div class="d-flex flex-column justify-content-center">
                          <h6 class="mb-0 text-sm"><?= $application->applicant_name ?></h6>
                          <p class="text-xs text-secondary mb-0"><?= $application->applicant_email ?></p>
                        </div>
                      </div>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0"><?= $application->job_title ?></p>
                      <p class="text-xs text-secondary mb-0"><?= date('d M Y', strtotime($application->deadline)) ?></p>
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold"><?= date('d M Y', strtotime($application->tanggal_lamaran)) ?></span>
                    </td>
                    <td class="align-middle text-center">
                      <div class="dropdown">
                        <button class="btn btn-sm bg-gradient-<?=
                          $application->status == 'menunggu' ? 'secondary' :
                          ($application->status == ' direview' ? 'warning' :
                          ($application->status == 'seleksi' ? 'info' :
                          ($application->status == 'wawancara' || $application->status == 'interview' ? 'primary' :
                          ($application->status == 'diterima' ? 'success' :
                          ($application->status == 'ditolak' ? 'danger' : 'info')))))
                        ?> dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                          <?=
                          $application->status == 'menunggu' ? 'Menunggu' :
                          ($application->status == 'direview' ? 'Direview' :
                          ($application->status == 'seleksi' ? 'Seleksi' :
                          ($application->status == 'wawancara' ? 'Wawancara' :
                          ($application->status == 'interview' ? 'Wawancara' :
                          ($application->status == 'diterima' ? 'Diterima' :
                          ($application->status == 'ditolak' ? 'Ditolak' : $application->status))))))
                          ?>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                          <?php if (in_array($this->session->userdata('role'), ['admin', 'staff'])) : ?>
                          <li><a class="dropdown-item status-update" href="javascript:void(0)" data-id="<?= $application->id ?>" data-status="menunggu" data-name="<?= $application->applicant_name ?>">Menunggu</a></li>
                          <li><a class="dropdown-item status-update" href="javascript:void(0)" data-id="<?= $application->id ?>" data-status="direview" data-name="<?= $application->applicant_name ?>">Direview</a></li>
                          <li><a class="dropdown-item status-update" href="javascript:void(0)" data-id="<?= $application->id ?>" data-status="seleksi" data-name="<?= $application->applicant_name ?>">Seleksi</a></li>
                          <?php endif; ?>
                          <?php if (in_array($this->session->userdata('role'), ['hrd'])) : ?>
                          <li><a class="dropdown-item status-update" href="javascript:void(0)" data-id="<?= $application->id ?>" data-status="wawancara" data-name="<?= $application->applicant_name ?>">Wawancara</a></li>
                          <?php endif; ?>
                          <?php if (in_array($this->session->userdata('role'), ['direktur'])) : ?>
                          <li><a class="dropdown-item status-update" href="javascript:void(0)" data-id="<?= $application->id ?>" data-status="diterima" data-name="<?= $application->applicant_name ?>">Diterima</a></li>
                          <li><hr class="dropdown-divider"></li>
                          <li><a class="dropdown-item text-danger status-update" href="javascript:void(0)" data-id="<?= $application->id ?>" data-status="ditolak" data-name="<?= $application->applicant_name ?>">Ditolak</a></li>
                          <?php endif; ?>

                        </ul>
                      </div>
                    </td>
                    <td class="align-middle text-center">
                      <?php
                      
                      $assessment_count = $this->model_penilaian->hitung_penilaian_pelamar($application->id);
                      $completed_count = $this->model_penilaian->hitung_penilaian_selesai($application->id);
                      ?>
                      <?php if ($assessment_count > 0) : ?>
                        <span class="badge badge-sm bg-gradient-<?= $completed_count == $assessment_count ? 'success' : 'warning' ?>">
                          <?= $completed_count ?>/<?= $assessment_count ?> Selesai
                        </span>
                      <?php else : ?>
                        <span class="badge badge-sm bg-gradient-secondary">Tidak Ada</span>
                      <?php endif; ?>
                    </td>
                    <td class="align-middle">
                      <div class="dropdown">
                        <button type="button" class="btn btn-sm btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                          <i class="fas fa-ellipsis-v"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end px-2 py-3" aria-labelledby="dropdownMenuButton">
                          <li><a class="dropdown-item border-radius-md" href="<?= base_url('admin/detail_lamaran/' . $application->id) ?>"><i class="fas fa-eye me-2"></i> Lihat Detail</a></li>
                          <?php if (in_array($this->session->userdata('role'), ['admin','staff','hrd'])) : ?>
                          <li><a class="dropdown-item border-radius-md" href="<?= base_url('admin/atur_penilaian/' . $application->id_pekerjaan . '/' . $application->id) ?>"><i class="fas fa-tasks me-2"></i> Atur Penilaian</a></li>
                          <!-- <li><a class="dropdown-item border-radius-md" href="<?= base_url('admin/editPelamar/' . $application->id) ?>"><i class="fas fa-edit me-2"></i> Edit</a></li> -->
                          <li>
                            <hr class="dropdown-divider">
                          </li>
                          <li>
                            <a class="dropdown-item border-radius-md text-danger btn-delete" href="javascript:void(0)" data-id="<?= $application->id ?>" data-name="<?= $application->applicant_name ?>">
                              <i class="fas fa-trash me-2"></i> Hapus
                            </a>
                          </li>
                          <li><a class="dropdown-item border-radius-md" href="<?= base_url('admin/unduhCV/' . $application->id) ?>"><i class="fas fa-download me-2"></i> Unduh CV</a></li>
                          <li><a class="dropdown-item border-radius-md" href="<?= base_url('admin/cetakPelamar/' . $application->id) ?>"><i class="fas fa-print me-2"></i> Cetak Lamaran</a></li>
                          <?php endif; ?>
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
    <div class="card">
      <div class="card-header pb-0">
        <h6>Statistik Lamaran</h6>
      </div>
      <div class="card-body p-3">
        <div class="chart">
          <canvas id="application-stats-chart" class="chart-canvas" height="300"></canvas>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="card">
      <div class="card-header pb-0">
        <h6>Tren Lamaran Bulanan</h6>
      </div>
      <div class="card-body p-3">
        <div class="chart">
          <canvas id="monthly-applications-chart" class="chart-canvas" height="300"></canvas>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    
    if (typeof flatpickr !== 'undefined') {
      flatpickr("#date_range", {
        mode: "range",
        dateFormat: "d/m/Y",
      });
    }

    
    var ctx1 = document.getElementById("application-stats-chart").getContext("2d");

    
    var menungguCount = <?= $application_status_stats['menunggu'] ?? 0 ?>;
    var direviewCount = <?= $application_status_stats['direview'] ?? 0 ?>;
    var seleksiCount = <?= $application_status_stats['seleksi'] ?? 0 ?> + <?= $application_status_stats['shortlisted'] ?? 0 ?> + <?= $application_status_stats['offered'] ?? 0 ?> + <?= $application_status_stats['ditolak'] ?? 0 ?> + <?= $application_status_stats['rejected'] ?? 0 ?>;
    var wawancaraCount = <?= $application_status_stats['wawancara'] ?? 0 ?> + <?= $application_status_stats['interviewed'] ?? 0 ?> + <?= $application_status_stats['interview'] ?? 0 ?>;
    var diterimaCount = <?= $application_status_stats['hired'] ?? 0 ?> + <?= $application_status_stats['diterima'] ?? 0 ?>;
    var ditolakCount = <?= $application_status_stats['ditolak'] ?? 0 ?>;

    new Chart(ctx1, {
      type: "pie",
      data: {
        labels: ["Menunggu", "Direview", "Seleksi", "Wawancara", "Diterima", "Ditolak"],
        datasets: [{
          label: "Pelamar",
          backgroundColor: ["#8593B0", "#ffd600", "#11cdef", "#5e72e4", "#2dce89", "#DC5035"],
          data: [menungguCount, direviewCount, seleksiCount, wawancaraCount, diterimaCount, ditolakCount],
          borderWidth: 0
        }],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            position: 'right',
            labels: {
              padding: 15,
              boxWidth: 12,
              font: {
                size: 11
              }
            }
          },
          tooltip: {
            callbacks: {
              label: function(context) {
                var label = context.label || '';
                var value = context.raw || 0;
                var total = context.dataset.data.reduce((a, b) => a + b, 0);
                var percentage = Math.round((value / total) * 100);
                return label + ': ' + value + ' pelamar (' + percentage + '%)';
              },
              title: function(context) {
                var status = context[0].label;
                var statusDesc = '';

                switch(status) {
                  case 'Menunggu':
                    statusDesc = 'Lamaran baru yang belum diproses';
                    break;
                  case 'Direview':
                    statusDesc = 'Lamaran sedang dalam proses review';
                    break;
                  case 'Seleksi':
                    statusDesc = 'Pelamar dalam tahap seleksi';
                    break;
                  case 'Wawancara':
                    statusDesc = 'Pelamar dalam tahap wawancara';
                    break;
                  case 'Diterima':
                    statusDesc = 'Pelamar telah diterima';
                    break;
                  case 'Ditolak':
                  statusDesc = 'Pelamar telah ditolak';
                  break;
                }

                return 'Status: ' + status + '\n' + statusDesc;
              }
            },
            padding: 10,
            backgroundColor: 'rgba(0, 0, 0, 0.7)',
            titleFont: {
              size: 13,
              weight: 'bold'
            },
            bodyFont: {
              size: 12
            }
          }
        },
      },
    });

    
    var ctx2 = document.getElementById("monthly-applications-chart").getContext("2d");

    var gradientStroke = ctx2.createLinearGradient(0, 230, 0, 50);
    gradientStroke.addColorStop(1, 'rgba(94, 114, 228, 0.3)');
    gradientStroke.addColorStop(0.2, 'rgba(94, 114, 228, 0.15)');
    gradientStroke.addColorStop(0, 'rgba(94, 114, 228, 0)');

    new Chart(ctx2, {
      type: "line",
      data: {
        labels: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Ags", "Sep", "Okt", "Nov", "Des"],
        datasets: [{
          label: "Lamaran",
          tension: 0.4,
          borderWidth: 0,
          pointRadius: 2,
          pointBackgroundColor: "#5e72e4",
          borderColor: "#5e72e4",
          backgroundColor: gradientStroke,
          borderWidth: 3,
          fill: true,
          data: [
            <?= $monthly_application_stats[1] ?? 0 ?>,
            <?= $monthly_application_stats[2] ?? 0 ?>,
            <?= $monthly_application_stats[3] ?? 0 ?>,
            <?= $monthly_application_stats[4] ?? 0 ?>,
            <?= $monthly_application_stats[5] ?? 0 ?>,
            <?= $monthly_application_stats[6] ?? 0 ?>,
            <?= $monthly_application_stats[7] ?? 0 ?>,
            <?= $monthly_application_stats[8] ?? 0 ?>,
            <?= $monthly_application_stats[9] ?? 0 ?>,
            <?= $monthly_application_stats[10] ?? 0 ?>,
            <?= $monthly_application_stats[11] ?? 0 ?>,
            <?= $monthly_application_stats[12] ?? 0 ?>
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
          },
          tooltip: {
            callbacks: {
              title: function(context) {
                var index = context[0].dataIndex;
                var labels = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
                return labels[index];
              }
            }
          }
        },
        interaction: {
          intersect: false,
          mode: 'index',
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
            }
          }
        },
      },
    });

    
    const statusUpdateLinks = document.querySelectorAll('.status-update');
    statusUpdateLinks.forEach(function(link) {
      link.addEventListener('click', function(e) {
        e.preventDefault();

        const applicationId = this.getAttribute('data-id');
        const status = this.getAttribute('data-status');
        const applicantName = this.getAttribute('data-name');

        
        let statusText = '';
        let confirmButtonColor = '#3085d6';

        switch(status) {
          case 'menunggu':
            statusText = 'Menunggu';
            confirmButtonColor = '#fb6340'; 
            break;
          case 'reviewed':
            statusText = 'Direview';
            confirmButtonColor = '#11cdef'; 
            break;
          case 'seleksi':
            statusText = 'Seleksi';
            confirmButtonColor = '#ffd600'; 
            break;
          case 'wawancara':
            statusText = 'Wawancara';
            confirmButtonColor = '#5e72e4'; 
            break;
          case 'diterima':
            statusText = 'Diterima';
            confirmButtonColor = '#2dce89'; 
            break;
          case 'ditolak':
            statusText = 'Ditolak';
            confirmButtonColor = '#f5365c'; 
            break;
          default:
            statusText = status.charAt(0).toUpperCase() + status.slice(1);
            confirmButtonColor = '#11cdef'; 
        }

        Swal.fire({
          title: 'Konfirmasi Perubahan Status',
          text: `Apakah Anda yakin ingin mengubah status lamaran ${applicantName} menjadi "${statusText}"?`,
          icon: status === 'ditolak' ? 'warning' : 'question',
          showCancelButton: true,
          confirmButtonColor: confirmButtonColor,
          cancelButtonColor: '#6c757d',
          confirmButtonText: 'Ya, Ubah Status',
          cancelButtonText: 'Batal'
        }).then((result) => {
          if (result.isConfirmed) {
            window.location.href = `<?= base_url('admin/perbaruiStatusPelamar/') ?>${applicationId}/${status}`;
          }
        });
      });
    });

    
    const deleteButtons = document.querySelectorAll('.btn-delete');
    deleteButtons.forEach(function(button) {
      button.addEventListener('click', function(e) {
        e.preventDefault();

        const applicationId = this.getAttribute('data-id');
        const applicantName = this.getAttribute('data-name');

        Swal.fire({
          title: 'Konfirmasi Hapus',
          text: `Apakah Anda yakin ingin menghapus lamaran dari ${applicantName}? Tindakan ini tidak dapat dibatalkan.`,
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#f5365c',
          cancelButtonColor: '#3085d6',
          confirmButtonText: 'Ya, Hapus!',
          cancelButtonText: 'Batal'
        }).then((result) => {
          if (result.isConfirmed) {
            window.location.href = `<?= base_url('admin/hapusPelamar/') ?>${applicationId}`;
          }
        });
      });
    });
  });
</script>