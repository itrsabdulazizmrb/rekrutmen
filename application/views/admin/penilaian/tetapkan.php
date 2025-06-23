<div class="row">
  <div class="col-12">
    <div class="card mb-4">
      <div class="card-header pb-0">
        <div class="d-flex justify-content-between align-items-center">
          <h6>Tetapkan Penilaian ke Pelamar</h6>
          <div>
            <a href="<?= base_url('admin/soal_penilaian/' . $assessment->id) ?>" class="btn btn-sm btn-outline-primary">
              <i class="fas fa-arrow-left me-2"></i> Kembali ke Daftar Soal
            </a>
          </div>
        </div>
        <p class="text-sm mb-0">
          <i class="fa fa-info-circle text-primary" aria-hidden="true"></i>
          <span class="font-weight-bold">Pilih pelamar yang akan diberikan penilaian ini</span>
        </p>
      </div>
      <div class="card-body">
        <!-- Assessment Info -->
        <div class="row mb-4">
          <div class="col-md-12">
            <h6 class="text-uppercase text-sm">Informasi Penilaian</h6>
            <div class="p-3 border rounded">
              <h5 class="mb-2"><?= $assessment->judul ?></h5>
              <p class="mb-2"><?= $assessment->deskripsi ?></p>
              <div class="row">
                <div class="col-md-4">
                  <p class="mb-1"><strong>Jenis:</strong> <?= $assessment->type_name ?></p>
                </div>
                <div class="col-md-4">
                  <p class="mb-1"><strong>Batas Waktu:</strong> <?= $assessment->batas_waktu ? $assessment->batas_waktu . ' menit' : 'Tidak ada' ?></p>
                </div>
                <div class="col-md-4">
                  <p class="mb-1"><strong>Nilai Kelulusan:</strong> <?= $assessment->nilai_lulus ? $assessment->nilai_lulus . '%' : 'Tidak ditentukan' ?></p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <?php if ($job) : ?>
          <div class="alert alert-info" role="alert">
            <strong>Info!</strong> Penilaian ini terkait dengan lowongan <strong><?= $job->judul ?></strong>. Hanya pelamar untuk lowongan ini yang ditampilkan.
          </div>
        <?php endif; ?>

        <!-- Applicants Form -->
        <?php if (empty($applications)) : ?>
          <div class="alert alert-warning" role="alert">
            <strong>Perhatian!</strong> Tidak ada pelamar yang tersedia untuk ditetapkan penilaian ini.
            <?php if (!$job) : ?>
              <p>Coba tetapkan penilaian ini ke lowongan terlebih dahulu.</p>
            <?php endif; ?>
          </div>
        <?php else : ?>
          <?= form_open('', ['class' => 'needs-validation']) ?>

            <div class="table-responsive">
              <table class="table align-items-center mb-0 datatable">
                <thead>
                  <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="width: 50px;">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="select-all">
                      </div>
                    </th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Pelamar</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Lowongan</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tanggal Lamaran</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($applications as $application) : ?>
                    <?php
                      
                      $is_assigned = $this->model_penilaian->cek_penilaian_sudah_ditetapkan($application->id, $assessment->id);
                    ?>
                    <tr>
                      <td>
                        <div class="form-check ms-3">
                          <input class="form-check-input applicant-checkbox" type="checkbox" name="application_ids[]" value="<?= $application->id ?>" <?= $is_assigned ? 'disabled checked' : '' ?>>
                        </div>
                      </td>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm"><?= $application->applicant_name ?></h6>
                            <p class="text-xs text-secondary mb-0"><?= $application->applicant_email ?></p>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0"><?= isset($application->job_title) ? $application->job_title : 'Tidak tersedia' ?></p>
                      </td>
                      <td>
                        <span class="badge badge-sm bg-gradient-<?= $application->status == 'Pending' ? 'secondary' : ($application->status == 'Direview' ? 'info' : ($application->status == 'Seleksi' ? 'primary' : ($application->status == 'Wawancara' ? 'warning' : ($application->status == 'Diterima' ? 'success' : 'danger')))) ?>"><?= $application->status ?></span>
                        <?php if ($is_assigned) : ?>
                          <span class="badge badge-sm bg-gradient-success ms-1">Sudah Ditetapkan</span>
                        <?php endif; ?>
                      </td>
                      <td>
                        <span class="text-secondary text-xs font-weight-bold"><?= isset($application->tanggal_lamaran) ? date('d M Y', strtotime($application->tanggal_lamaran)) : (isset($application->dibuat_pada) ? date('d M Y', strtotime($application->dibuat_pada)) : 'Tidak tersedia') ?></span>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>

            <!-- Form Action Section - Layout yang Diperbaiki -->
            <div class="mt-4 pt-3 border-top">
              <div class="row">
                <div class="col-md-8">
                  <div class="mb-3">
                    <label for="tanggal_penilaian" class="form-label font-weight-bold">Tanggal & Waktu Penilaian</label>
                    <input type="datetime-local" class="form-control" id="tanggal_penilaian" name="tanggal_penilaian" required>
                    <small class="form-text text-muted">Pilih tanggal dan waktu pelaksanaan penilaian.</small>
                  </div>
                </div>
                <div class="col-md-4 d-flex align-items-center">
                  <button type="submit" class="btn btn-primary w-100" style="height: 38px;">
                    <i class="fas fa-check me-2"></i> Tetapkan Penilaian
                  </button>
                </div>
              </div>
            </div>
          <?= form_close() ?>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    
    const selectAllCheckbox = document.getElementById('select-all');
    const applicantCheckboxes = document.querySelectorAll('.applicant-checkbox:not([disabled])');

    if (selectAllCheckbox) {
      selectAllCheckbox.addEventListener('change', function() {
        applicantCheckboxes.forEach(checkbox => {
          checkbox.checked = selectAllCheckbox.checked;
        });
      });
    }

    
    applicantCheckboxes.forEach(checkbox => {
      checkbox.addEventListener('change', function() {
        const allChecked = Array.from(applicantCheckboxes).every(cb => cb.checked);
        const someChecked = Array.from(applicantCheckboxes).some(cb => cb.checked);

        selectAllCheckbox.checked = allChecked;
        selectAllCheckbox.indeterminate = someChecked && !allChecked;
      });
    });
  });
</script>