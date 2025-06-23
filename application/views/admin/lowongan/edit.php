<div class="row">
  <div class="col-12">
    <div class="card mb-4">
      <div class="card-header pb-0">
        <div class="d-flex justify-content-between align-items-center">
          <h6>Edit Lowongan</h6>
          <a href="<?= base_url('admin/lowongan') ?>" class="btn btn-sm btn-outline-primary">
            <i class="fas fa-arrow-left me-2"></i> Kembali ke Daftar Lowongan
          </a>
        </div>
        <p class="text-sm mb-0">
          <i class="fa fa-info-circle text-primary" aria-hidden="true"></i>
          <span class="font-weight-bold">Edit informasi lowongan pekerjaan</span>
        </p>
      </div>
      <div class="card-body">
        <?= form_open('admin/edit_lowongan/' . $job->id, ['class' => 'needs-validation']) ?>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="title" class="form-control-label">Judul Lowongan <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="title" name="title" value="<?= set_value('title', $job->judul) ?>" required>
                <?= form_error('title', '<small class="text-danger">', '</small>') ?>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="category_id" class="form-control-label">Kategori <span class="text-danger">*</span></label>
                <select class="form-control" id="category_id" name="category_id" required>
                  <option value="">Pilih Kategori</option>
                  <?php foreach ($categories as $category) : ?>
                    <option value="<?= $category->id ?>" <?= set_select('category_id', $category->id, ($job->id_kategori == $category->id)) ?>><?= $category->nama ?></option>
                  <?php endforeach; ?>
                </select>
                <?= form_error('category_id', '<small class="text-danger">', '</small>') ?>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="description" class="form-control-label">Deskripsi Pekerjaan <span class="text-danger">*</span></label>
                <textarea class="form-control" id="description" name="description" rows="5" required><?= set_value('description', $job->deskripsi) ?></textarea>
                <?= form_error('description', '<small class="text-danger">', '</small>') ?>
                <small class="text-muted">Jelaskan secara detail tentang posisi pekerjaan ini.</small>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="requirements" class="form-control-label">Persyaratan <span class="text-danger">*</span></label>
                <textarea class="form-control" id="requirements" name="requirements" rows="5" required><?= set_value('requirements', $job->persyaratan) ?></textarea>
                <?= form_error('requirements', '<small class="text-danger">', '</small>') ?>
                <small class="text-muted">Jelaskan kualifikasi dan persyaratan yang dibutuhkan untuk posisi ini.</small>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="responsibilities" class="form-control-label">Tanggung Jawab <span class="text-danger">*</span></label>
                <textarea class="form-control" id="responsibilities" name="responsibilities" rows="5" required><?= set_value('responsibilities', $job->tanggung_jawab) ?></textarea>
                <?= form_error('responsibilities', '<small class="text-danger">', '</small>') ?>
                <small class="text-muted">Jelaskan tanggung jawab dan tugas-tugas untuk posisi ini.</small>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="location" class="form-control-label">Lokasi <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="location" name="location" value="<?= set_value('location', $job->lokasi) ?>" required>
                <?= form_error('location', '<small class="text-danger">', '</small>') ?>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="job_type" class="form-control-label">Tipe Pekerjaan <span class="text-danger">*</span></label>
                <select class="form-control" id="job_type" name="job_type" required>
                  <option value="">Pilih Tipe Pekerjaan</option>
                  <option value="penuh_waktu" <?= set_select('job_type', 'penuh_waktu', ($job->jenis_pekerjaan == 'penuh_waktu')) ?>>Full Time</option>
                  <option value="paruh_waktu" <?= set_select('job_type', 'paruh_waktu', ($job->jenis_pekerjaan == 'paruh_waktu')) ?>>Part Time</option>
                  <option value="kontrak" <?= set_select('job_type', 'kontrak', ($job->jenis_pekerjaan == 'kontrak')) ?>>Kontrak</option>
                  <option value="magang" <?= set_select('job_type', 'magang', ($job->jenis_pekerjaan == 'magang')) ?>>Magang</option>
                </select>
                <?= form_error('job_type', '<small class="text-danger">', '</small>') ?>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="salary_range" class="form-control-label">Kisaran Gaji</label>
                <input type="text" class="form-control" id="salary_range" name="salary_range" value="<?= set_value('salary_range', $job->rentang_gaji) ?>">
                <small class="text-muted">Contoh: Rp 5.000.000 - Rp 8.000.000 per bulan</small>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="deadline" class="form-control-label">Batas Waktu Lamaran <span class="text-danger">*</span></label>
                <input type="date" class="form-control" id="deadline" name="deadline" value="<?= set_value('deadline', date('Y-m-d', strtotime($job->batas_waktu))) ?>" required>
                <?= form_error('deadline', '<small class="text-danger">', '</small>') ?>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="vacancies" class="form-control-label">Jumlah Posisi</label>
                <input type="number" class="form-control" id="vacancies" name="vacancies" value="<?= set_value('vacancies', $job->jumlah_lowongan) ?>" min="1">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="status" class="form-control-label">Status <span class="text-danger">*</span></label>
                <select class="form-control" id="status" name="status" required>
                  <option value="aktif" <?= set_select('status', 'aktif', ($job->status == 'aktif')) ?>>Aktif</option>
                  <option value="draft" <?= set_select('status', 'draft', ($job->status == 'draft')) ?>>Draft</option>
                  <option value="ditutup" <?= set_select('status', 'ditutup', ($job->status == 'ditutup')) ?>>Tidak Aktif</option>
                </select>
                <?= form_error('status', '<small class="text-danger">', '</small>') ?>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="featured" name="featured" value="1" <?= set_checkbox('featured', '1', ($job->unggulan == 1)) ?>>
                <label class="form-check-label" for="featured">Tampilkan sebagai Lowongan Unggulan</label>
              </div>
            </div>
          </div>

          <div class="row mt-4">
            <div class="col-md-12">
              <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
              <a href="<?= base_url('admin/dokumen_lowongan/' . $job->id) ?>" class="btn btn-info">Kelola Dokumen Persyaratan</a>
              <a href="<?= base_url('admin/lowongan') ?>" class="btn btn-secondary">Batal</a>
            </div>
          </div>
        <?= form_close() ?>
      </div>
    </div>
  </div>
</div>

<div class="row mt-4">
  <!-- <div class="col-md-6">
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
  </div> -->
  <div class="col-md-12">
    <div class="card">
      <div class="card-header pb-0">
        <h6>Pelamar Terbaru</h6>
      </div>
      <div class="card-body p-3">
        <?php
        
        $CI =& get_instance();
        $recent_applications = $CI->model_lamaran->dapatkan_lamaran_lowongan($job->id);
        
        if (count($recent_applications) > 5) {
            $recent_applications = array_slice($recent_applications, 0, 5);
        }
        if (empty($recent_applications)) :
        ?>
          <p class="text-center">Belum ada pelamar untuk lowongan ini.</p>
        <?php else : ?>
          <div class="table-responsive">
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Pelamar</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                  <th class="text-secondary opacity-7"></th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($recent_applications as $application) : ?>
                  <tr>
                    <td>
                      <div class="d-flex px-2 py-1">
                        <div>
                          <img src="<?= base_url('assets/img/team-2.jpg') ?>" class="avatar avatar-sm me-3" alt="user1">
                        </div>
                        <div class="d-flex flex-column justify-content-center">
                          <h6 class="mb-0 text-sm"><?= $application->applicant_name ?></h6>
                          <p class="text-xs text-secondary mb-0"><?= $application->applicant_email ?></p>
                        </div>
                      </div>
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold"><?= date('d M Y', strtotime($application->tanggal_lamaran)) ?></span>
                    </td>
                    <td class="align-middle text-center text-sm">
                      <span class="badge badge-sm bg-gradient-<?= $application->status == 'pending' ? 'warning' : ($application->status == 'reviewed' ? 'info' : ($application->status == 'shortlisted' ? 'success' : ($application->status == 'interviewed' ? 'primary' : ($application->status == 'offered' ? 'warning' : ($application->status == 'hired' ? 'success' : 'danger'))))) ?>"><?= ucfirst($application->status) ?></span>
                    </td>
                    <td class="align-middle">
                      <a href="<?= base_url('admin/application_details/' . $application->id) ?>" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                        Detail
                      </a>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
          <div class="text-center mt-3">
            <a href="<?= base_url('admin/lamaran_lowongan/' . $job->id) ?>" class="btn btn-sm btn-primary">Lihat Semua Pelamar</a>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    
    if (typeof ClassicEditor !== 'undefined') {
      ClassicEditor.create(document.querySelector('#description')).catch(error => {
        console.error(error);
      });

      ClassicEditor.create(document.querySelector('#requirements')).catch(error => {
        console.error(error);
      });

      ClassicEditor.create(document.querySelector('#responsibilities')).catch(error => {
        console.error(error);
      });
    }

    
    var ctx = document.getElementById("application-stats-chart").getContext("2d");
    new Chart(ctx, {
      type: "pie",
      data: {
        labels: ["Pending", "Reviewed", "Shortlisted", "Interviewed", "Offered", "Hired", "Rejected"],
        datasets: [{
          label: "Pelamar",
          backgroundColor: ["#fb6340", "#11cdef", "#2dce89", "#5e72e4", "#ffd600", "#2dce89", "#f5365c"],
          data: [5, 3, 2, 1, 0, 0, 1],
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
