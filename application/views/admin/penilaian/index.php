
<div class="row">
  <div class="col-12">
    <div class="card shadow-sm mb-4">
      <div class="card-header pb-0">
        <div class="d-flex justify-content-between align-items-center">
          <div>
            <h6 class="mb-1">Manajemen Penilaian</h6>
            <p class="text-sm mb-0">
              <i class="fa fa-info-circle text-primary" aria-hidden="true"></i>
              <span class="font-weight-bold">Kelola semua penilaian untuk proses rekrutmen</span>
            </p>
          </div>
          <div>
            <a href="<?= base_url('admin/tambah_penilaian') ?>" class="btn btn-sm btn-primary me-2">
              <i class="fas fa-plus me-2"></i> Tambah Penilaian Baru
            </a>
            <a href="#" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#manageQuestionsModal">
              <i class="fas fa-tasks me-2"></i> Kelola Soal Penilaian
            </a>
          </div>
        </div>
      </div>
      <div class="card-body p-0">

        <div class="table-responsive p-0" style="min-height: 500px; overflow-y: auto;">
          <?php if (empty($assessments)) : ?>
            <div class="text-center py-5">
              <h4 class="text-secondary">Tidak ada penilaian yang ditemukan</h4>
              <p class="text-muted">Mulai dengan menambahkan penilaian baru.</p>
              <a href="<?= base_url('admin/tambah_penilaian') ?>" class="btn btn-primary mt-3">Tambah Penilaian Baru</a>
            </div>
          <?php else : ?>
            <table class="table align-items-center mb-0 datatable">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Penilaian</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tipe</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Lowongan</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jumlah Soal</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Batas Waktu</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Pelamar</th>
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
                          <h6 class="mb-0 text-sm"><?= $assessment->judul ?></h6>
                          <p class="text-xs text-secondary mb-0">Dibuat oleh: <?= $assessment->created_by_name ?></p>
                        </div>
                      </div>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0"><?= $assessment->type_name ?></p>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0"><?= $assessment->job_title ?? 'Semua Lowongan' ?></p>
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold">
                        <?= $assessment->question_count ?> Soal
                      </span>
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold"><?= $assessment->batas_waktu ? $assessment->batas_waktu . ' menit' : 'Tidak ada' ?></span>
                    </td>
                    <td class="align-middle text-center">
                      <?php
                      $applicant_count = $this->model_penilaian->hitung_pelamar_penilaian($assessment->id);
                      $completed_count = $this->model_penilaian->hitung_penyelesaian_penilaian($assessment->id);
                      ?>
                      <a href="<?= base_url('admin/hasil-penilaian/' . $assessment->id) ?>" class="text-secondary font-weight-bold text-xs">
                        <?= $completed_count ?>/<?= $applicant_count ?> Selesai
                      </a>
                    </td>
                    <td class="align-middle">
                      <div class="dropdown">
                        <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton<?= $assessment->id ?>" data-bs-toggle="dropdown" aria-expanded="false">
                          <i class="fas fa-ellipsis-v"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end px-2 py-3" aria-labelledby="dropdownMenuButton<?= $assessment->id ?>">
                          <li><a class="dropdown-item border-radius-md" href="<?= base_url('admin/soal_penilaian/' . $assessment->id) ?>"><i class="fas fa-list me-2"></i> Kelola Soal</a></li>
                          <li><a class="dropdown-item border-radius-md" href="<?= base_url('admin/hasil-penilaian/' . $assessment->id) ?>"><i class="fas fa-chart-bar me-2"></i> Lihat Hasil</a></li>
                          <li><a class="dropdown-item border-radius-md" href="<?= base_url('admin/tetapkan-ke-pelamar/' . $assessment->id) ?>"><i class="fas fa-user-plus me-2"></i> Tetapkan ke Pelamar</a></li>
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
        <h6>Penilaian Berdasarkan Tipe</h6>
      </div>
      <div class="card-body p-3">
        <div class="chart">
          <canvas id="assessment-type-chart" class="chart-canvas" height="300"></canvas>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="card">
      <div class="card-header pb-0">
        <h6>Tingkat Penyelesaian Penilaian</h6>
      </div>
      <div class="card-body p-3">
        <div class="chart">
          <canvas id="assessment-completion-chart" class="chart-canvas" height="300"></canvas>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    
    var dropdownElementList = [].slice.call(document.querySelectorAll('[data-bs-toggle="dropdown"]'))
    var dropdownList = dropdownElementList.map(function (dropdownToggleEl) {
      return new bootstrap.Dropdown(dropdownToggleEl)
    });

    
    var ctx1 = document.getElementById("assessment-type-chart").getContext("2d");
    new Chart(ctx1, {
      type: "doughnut",
      data: {
        labels: [
          <?php foreach ($chart_data['type_stats'] as $index => $stat): ?>
            "<?= $stat->type_name ?>"<?= $index < count($chart_data['type_stats']) - 1 ? ',' : '' ?>
          <?php endforeach; ?>
        ],
        datasets: [{
          label: "Penilaian",
          backgroundColor: ["#5e72e4", "#2dce89", "#fb6340", "#11cdef", "#f5365c", "#6f42c1", "#fd7e14"],
          data: [
            <?php foreach ($chart_data['type_stats'] as $index => $stat): ?>
              <?= $stat->count ?><?= $index < count($chart_data['type_stats']) - 1 ? ',' : '' ?>
            <?php endforeach; ?>
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

    
    var ctx2 = document.getElementById("assessment-completion-chart").getContext("2d");
    new Chart(ctx2, {
      type: "bar",
      data: {
        labels: [
          <?php foreach ($chart_data['completion_stats'] as $index => $stat): ?>
            "<?= substr($stat->judul, 0, 20) . (strlen($stat->judul) > 20 ? '...' : '') ?>"<?= $index < count($chart_data['completion_stats']) - 1 ? ',' : '' ?>
          <?php endforeach; ?>
        ],
        datasets: [
          {
            label: "Ditugaskan",
            backgroundColor: "#5e72e4",
            data: [
              <?php foreach ($chart_data['completion_stats'] as $index => $stat): ?>
                <?= $stat->total_assigned ?><?= $index < count($chart_data['completion_stats']) - 1 ? ',' : '' ?>
              <?php endforeach; ?>
            ],
          },
          {
            label: "Selesai",
            backgroundColor: "#2dce89",
            data: [
              <?php foreach ($chart_data['completion_stats'] as $index => $stat): ?>
                <?= $stat->completed ?><?= $index < count($chart_data['completion_stats']) - 1 ? ',' : '' ?>
              <?php endforeach; ?>
            ],
          }
        ],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            position: 'top',
          }
        },
        scales: {
          y: {
            beginAtZero: true
          }
        },
      },
    });
  });
</script>

<!-- Modal Kelola Soal Penilaian -->
<div class="modal fade" id="manageQuestionsModal" tabindex="-1" role="dialog" aria-labelledby="manageQuestionsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="manageQuestionsModalLabel">Pilih Penilaian untuk Kelola Soal</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p class="text-sm mb-3">Silakan pilih penilaian yang ingin Anda kelola soal-soalnya:</p>

        <div class="form-group">
          <label for="assessment-select" class="form-control-label">Penilaian</label>
          <select class="form-control" id="assessment-select">
            <option value="">-- Pilih Penilaian --</option>
            <?php foreach ($assessments as $assessment) : ?>
              <option value="<?= $assessment->id ?>"><?= $assessment->judul ?> (<?= $assessment->type_name ?>)</option>
            <?php endforeach; ?>
          </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-primary" id="btn-manage-questions" disabled>Kelola Soal</button>
      </div>
    </div>
  </div>
</div>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    
    const assessmentSelect = document.getElementById('assessment-select');
    const btnManageQuestions = document.getElementById('btn-manage-questions');

    assessmentSelect.addEventListener('change', function() {
      btnManageQuestions.disabled = !this.value;
    });

    btnManageQuestions.addEventListener('click', function() {
      const assessmentId = assessmentSelect.value;
      if (assessmentId) {
        window.location.href = '<?= base_url('admin/soal_penilaian/') ?>' + assessmentId;
      }
    });
  });
</script>
