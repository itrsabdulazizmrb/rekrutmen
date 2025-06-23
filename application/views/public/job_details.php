<div class="container mt-7">
  <div class="row">
    <div class="col-lg-8">
      <div class="card">
        <div class="card-body p-4">
          <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
              <h3 class="mb-0"><?= $job->title ?></h3>
              <p class="text-sm mb-0">Diposting pada <?= date('d M Y', strtotime($job->created_at)) ?></p>
            </div>
            <div>
              <span class="badge bg-gradient-<?= $job->job_type == 'full-time' ? 'success' : ($job->job_type == 'part-time' ? 'info' : ($job->job_type == 'contract' ? 'warning' : 'secondary')) ?> job-badge"><?= $job->job_type == 'full-time' ? 'Full Time' : ($job->job_type == 'part-time' ? 'Part Time' : ($job->job_type == 'contract' ? 'Kontrak' : 'Magang')) ?></span>
              <?php if ($job->featured) : ?>
                <span class="badge bg-gradient-primary job-badge">Unggulan</span>
              <?php endif; ?>
            </div>
          </div>

          <div class="row mb-4">
            <div class="col-md-6">
              <div class="d-flex align-items-center mb-2">
                <div class="icon icon-shape icon-xs bg-gradient-primary shadow text-center">
                  <i class="fas fa-building opacity-10"></i>
                </div>
                <div class="ms-2">
                  <p class="text-sm mb-0">Perusahaan: <span class="font-weight-bold"><?= $job->company_name ?? 'SIREK Company' ?></span></p>
                </div>
              </div>
              <div class="d-flex align-items-center mb-2">
                <div class="icon icon-shape icon-xs bg-gradient-primary shadow text-center">
                  <i class="fas fa-map-marker-alt opacity-10"></i>
                </div>
                <div class="ms-2">
                  <p class="text-sm mb-0">Lokasi: <span class="font-weight-bold"><?= $job->location ?></span></p>
                </div>
              </div>
              <div class="d-flex align-items-center mb-2">
                <div class="icon icon-shape icon-xs bg-gradient-primary shadow text-center">
                  <i class="fas fa-tag opacity-10"></i>
                </div>
                <div class="ms-2">
                  <p class="text-sm mb-0">Kategori: <span class="font-weight-bold"><?= $job->category_name ?></span></p>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <?php if ($job->salary_range) : ?>
                <div class="d-flex align-items-center mb-2">
                  <div class="icon icon-shape icon-xs bg-gradient-primary shadow text-center">
                    <i class="fas fa-money-bill-wave opacity-10"></i>
                  </div>
                  <div class="ms-2">
                    <p class="text-sm mb-0">Kisaran Gaji: <span class="font-weight-bold"><?= $job->salary_range ?></span></p>
                  </div>
                </div>
              <?php endif; ?>
              <div class="d-flex align-items-center mb-2">
                <div class="icon icon-shape icon-xs bg-gradient-primary shadow text-center">
                  <i class="fas fa-calendar opacity-10"></i>
                </div>
                <div class="ms-2">
                  <p class="text-sm mb-0">Batas Lamaran: <span class="font-weight-bold"><?= date('d M Y', strtotime($job->deadline)) ?></span></p>
                </div>
              </div>
              <div class="d-flex align-items-center mb-2">
                <div class="icon icon-shape icon-xs bg-gradient-primary shadow text-center">
                  <i class="fas fa-users opacity-10"></i>
                </div>
                <div class="ms-2">
                  <p class="text-sm mb-0">Jumlah Posisi: <span class="font-weight-bold"><?= $job->vacancies ?></span></p>
                </div>
              </div>
            </div>
          </div>

          <div class="mb-4">
            <h5>Deskripsi Pekerjaan</h5>
            <div class="p-3 bg-gray-100 rounded">
              <?= nl2br($job->description) ?>
            </div>
          </div>

          <div class="mb-4">
            <h5>Persyaratan</h5>
            <div class="p-3 bg-gray-100 rounded">
              <?= nl2br($job->requirements) ?>
            </div>
          </div>

          <div class="mb-4">
            <h5>Tanggung Jawab</h5>
            <div class="p-3 bg-gray-100 rounded">
              <?= nl2br($job->responsibilities) ?>
            </div>
          </div>

          <div class="d-flex justify-content-between align-items-center mt-5">
            <a href="<?= base_url('home/jobs') ?>" class="btn btn-outline-primary">Kembali ke Daftar Lowongan</a>
            <?php if ($this->session->userdata('logged_in') && $this->session->userdata('role') == 'pelamar') : ?>
              <a href="<?= base_url('pelamar/lamar/' . $job->id) ?>" class="btn btn-primary">Lamar Sekarang</a>
            <?php else : ?>
              <a href="<?= base_url('auth') ?>" class="btn btn-primary">Login untuk Melamar</a>
            <?php endif; ?>
          </div>
        </div>
      </div>

      <!-- Share Job -->
      <div class="card mt-4">
        <div class="card-body p-4">
          <h5 class="mb-3">Bagikan Lowongan Ini</h5>
          <div class="d-flex">
            <a href="https://www.facebook.com/sharer/sharer.php?u=<?= current_url() ?>" target="_blank" class="btn btn-facebook btn-icon-only me-2">
              <span class="btn-inner--icon"><i class="fab fa-facebook"></i></span>
            </a>
            <a href="https://twitter.com/intent/tweet?url=<?= current_url() ?>&text=<?= $job->title ?> - SIREK" target="_blank" class="btn btn-twitter btn-icon-only me-2">
              <span class="btn-inner--icon"><i class="fab fa-twitter"></i></span>
            </a>
            <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?= current_url() ?>" target="_blank" class="btn btn-linkedin btn-icon-only me-2">
              <span class="btn-inner--icon"><i class="fab fa-linkedin"></i></span>
            </a>
            <a href="https://wa.me/?text=<?= $job->title ?> - <?= current_url() ?>" target="_blank" class="btn btn-whatsapp btn-icon-only me-2">
              <span class="btn-inner--icon"><i class="fab fa-whatsapp"></i></span>
            </a>
            <a href="mailto:?subject=<?= $job->title ?> - SIREK&body=Lihat lowongan pekerjaan ini: <?= current_url() ?>" class="btn btn-google-plus btn-icon-only">
              <span class="btn-inner--icon"><i class="fas fa-envelope"></i></span>
            </a>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-4">
      <!-- Apply Now Card -->
      <div class="card">
        <div class="card-body p-4">
          <h5 class="mb-3">Tertarik dengan Posisi Ini?</h5>
          <p class="text-sm mb-4">Jangan lewatkan kesempatan untuk bergabung dengan tim kami. Lamar sekarang!</p>
          <?php if ($this->session->userdata('logged_in') && $this->session->userdata('role') == 'pelamar') : ?>
            <a href="<?= base_url('pelamar/lamar/' . $job->id) ?>" class="btn btn-primary w-100">Lamar Sekarang</a>
          <?php else : ?>
            <a href="<?= base_url('auth') ?>" class="btn btn-primary w-100">Login untuk Melamar</a>
            <div class="text-center mt-3">
              <small>Belum punya akun? <a href="<?= base_url('auth/register') ?>">Daftar sekarang</a></small>
            </div>
          <?php endif; ?>
        </div>
      </div>

      <!-- Company Info Card -->
      <div class="card mt-4">
        <div class="card-body p-4">
          <h5 class="mb-3">Tentang Perusahaan</h5>
          <div class="text-center mb-3">
            <img src="<?= base_url('assets/img/company-logo.jpg') ?>" alt="Company Logo" class="img-fluid rounded-circle" style="width: 100px; height: 100px; object-fit: cover;">
          </div>
          <h6 class="text-center mb-3"><?= $job->company_name ?? 'SIREK Company' ?></h6>
          <p class="text-sm">SIREK adalah perusahaan teknologi terkemuka yang berfokus pada pengembangan solusi rekrutmen inovatif untuk berbagai industri.</p>
          <div class="d-flex align-items-center mb-2">
            <div class="icon icon-shape icon-xs bg-gradient-primary shadow text-center">
              <i class="fas fa-globe opacity-10"></i>
            </div>
            <div class="ms-2">
              <p class="text-sm mb-0">Website: <a href="https://www.sirek.com" target="_blank">www.sirek.com</a></p>
            </div>
          </div>
          <div class="d-flex align-items-center mb-2">
            <div class="icon icon-shape icon-xs bg-gradient-primary shadow text-center">
              <i class="fas fa-map-marker-alt opacity-10"></i>
            </div>
            <div class="ms-2">
              <p class="text-sm mb-0">Lokasi: Jakarta, Indonesia</p>
            </div>
          </div>
          <div class="d-flex align-items-center mb-2">
            <div class="icon icon-shape icon-xs bg-gradient-primary shadow text-center">
              <i class="fas fa-users opacity-10"></i>
            </div>
            <div class="ms-2">
              <p class="text-sm mb-0">Jumlah Karyawan: 100-500</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Related Jobs Card -->
      <div class="card mt-4">
        <div class="card-body p-4">
          <h5 class="mb-3">Lowongan Terkait</h5>
          <?php if (empty($related_jobs)) : ?>
            <p class="text-sm">Tidak ada lowongan terkait saat ini.</p>
          <?php else : ?>
            <?php foreach ($related_jobs as $related_job) : ?>
              <div class="d-flex align-items-center mb-3">
                <div class="icon icon-shape icon-sm bg-gradient-primary shadow text-center me-3">
                  <i class="fas fa-briefcase opacity-10"></i>
                </div>
                <div>
                  <h6 class="mb-0 text-sm"><?= $related_job->title ?></h6>
                  <p class="text-xs text-secondary mb-0"><?= $related_job->location ?></p>
                  <a href="<?= base_url('home/job_details/' . $related_job->id) ?>" class="text-primary text-sm">Lihat Detail</a>
                </div>
              </div>
              <hr class="horizontal dark my-3">
            <?php endforeach; ?>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</div>
