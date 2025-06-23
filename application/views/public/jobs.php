<div class="page-header min-vh-50" style="background-image: url('<?= base_url('assets/img/career-bg.jpg') ?>');">
  <span class="mask bg-gradient-dark opacity-6"></span>
  <div class="container">
    <div class="row">
      <div class="col-md-8 mx-auto">
        <div class="text-center">
          <h1 class="text-white">Lowongan Pekerjaan</h1>
          <p class="lead text-white">Temukan peluang karir yang sesuai dengan keahlian dan minat Anda</p>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="container">
  <div class="row mt-n6">
    <div class="col-md-12">
      <div class="card card-body blur shadow-blur mx-3 mx-md-4">
        <form id="job-filter-form" action="<?= base_url('lowongan') ?>" method="get">
          <div class="row">
            <div class="col-md-3">
              <div class="input-group">
                <span class="input-group-text"><i class="fas fa-search"></i></span>
                <input type="text" class="form-control" name="q" placeholder="Cari lowongan..." value="<?= $this->input->get('q') ?>">
              </div>
            </div>
            <div class="col-md-3">
              <select class="form-control" id="filter-category" name="category">
                <option value="">Semua Kategori</option>
                <?php foreach ($categories as $category) : ?>
                  <option value="<?= $category->id ?>" <?= $this->input->get('category') == $category->id ? 'selected' : '' ?>><?= $category->nama ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="col-md-2">
              <select class="form-control" id="filter-location" name="location">
                <option value="">Semua Lokasi</option>
                <option value="Jakarta" <?= $this->input->get('location') == 'Jakarta' ? 'selected' : '' ?>>Jakarta</option>
                <option value="Bandung" <?= $this->input->get('location') == 'Bandung' ? 'selected' : '' ?>>Bandung</option>
                <option value="Surabaya" <?= $this->input->get('location') == 'Surabaya' ? 'selected' : '' ?>>Surabaya</option>
                <option value="Medan" <?= $this->input->get('location') == 'Medan' ? 'selected' : '' ?>>Medan</option>
                <option value="Makassar" <?= $this->input->get('location') == 'Makassar' ? 'selected' : '' ?>>Makassar</option>
                <option value="Remote" <?= $this->input->get('location') == 'Remote' ? 'selected' : '' ?>>Remote</option>
              </select>
            </div>
            <div class="col-md-2">
              <select class="form-control" id="filter-job-type" name="job_type">
                <option value="">Semua Tipe</option>
                <option value="full-time" <?= $this->input->get('job_type') == 'full-time' ? 'selected' : '' ?>>Full Time</option>
                <option value="part-time" <?= $this->input->get('job_type') == 'part-time' ? 'selected' : '' ?>>Part Time</option>
                <option value="contract" <?= $this->input->get('job_type') == 'contract' ? 'selected' : '' ?>>Kontrak</option>
                <option value="internship" <?= $this->input->get('job_type') == 'internship' ? 'selected' : '' ?>>Magang</option>
              </select>
            </div>
            <div class="col-md-2">
              <button type="submit" class="btn bg-gradient-primary w-100">Filter</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="row mt-4">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header p-3">
          <h5 class="mb-0">Daftar Lowongan Pekerjaan</h5>
          <p class="text-sm mb-0">
            <?php if (!empty($jobs)) : ?>
              Menampilkan <?= count($jobs) ?> dari <?= $total_jobs ?> lowongan
            <?php else : ?>
              Tidak ada lowongan yang tersedia
            <?php endif; ?>
          </p>
        </div>
        <div class="card-body p-3">
          <?php if (empty($jobs)) : ?>
            <div class="text-center py-5">
              <h4 class="text-secondary">Tidak ada lowongan yang ditemukan</h4>
              <p class="text-muted">Silakan coba dengan filter yang berbeda atau kembali lagi nanti.</p>
            </div>
          <?php else : ?>
            <div class="row">
              <?php foreach ($jobs as $job) : ?>
                <div class="col-md-6 mb-4">
                  <div class="card job-card h-100">
                    <div class="card-body">
                      <div class="d-flex justify-content-between mb-2">
                        <span class="badge bg-gradient-<?= $job->job_type == 'full-time' ? 'success' : ($job->job_type == 'part-time' ? 'info' : ($job->job_type == 'contract' ? 'warning' : 'secondary')) ?> job-badge"><?= $job->job_type == 'full-time' ? 'Full Time' : ($job->job_type == 'part-time' ? 'Part Time' : ($job->job_type == 'contract' ? 'Kontrak' : 'Magang')) ?></span>
                        <?php if ($job->featured) : ?>
                          <span class="badge bg-gradient-primary job-badge">Unggulan</span>
                        <?php endif; ?>
                      </div>
                      <h5 class="card-title"><?= $job->title ?></h5>
                      <p class="card-text text-sm mb-1"><i class="fas fa-building me-1"></i> <?= $job->company_name ?? 'SIREK Company' ?></p>
                      <p class="card-text text-sm mb-1"><i class="fas fa-map-marker-alt me-1"></i> <?= $job->location ?></p>
                      <p class="card-text text-sm mb-1"><i class="fas fa-tag me-1"></i> <?= $job->category_name ?></p>
                      <?php if ($job->salary_range) : ?>
                        <p class="card-text text-sm mb-1"><i class="fas fa-money-bill-wave me-1"></i> <?= $job->salary_range ?></p>
                      <?php endif; ?>
                      <p class="card-text text-sm mb-3"><i class="fas fa-calendar me-1"></i> Batas: <?= date('d M Y', strtotime($job->deadline)) ?></p>

                      <div class="d-flex justify-content-between align-items-center mt-3">
                        <a href="<?= base_url('home/job_details/' . $job->id) ?>" class="btn btn-outline-primary btn-sm">Lihat Detail</a>
                        <?php if ($this->session->userdata('logged_in') && $this->session->userdata('role') == 'pelamar') : ?>
                          <a href="<?= base_url('pelamar/lamar/' . $job->id) ?>" class="btn btn-primary btn-sm">Lamar Sekarang</a>
                        <?php else : ?>
                          <a href="<?= base_url('auth') ?>" class="btn btn-primary btn-sm">Login untuk Melamar</a>
                        <?php endif; ?>
                      </div>
                    </div>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>

            <!-- Pagination -->
            <div class="row mt-4">
              <div class="col-md-12">
                <nav aria-label="Page navigation">
                  <?= $pagination ?>
                </nav>
              </div>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>

  <div class="row mt-4">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-md-6">
              <h5>Mengapa Bergabung dengan Kami?</h5>
              <p class="text-sm">SIREK menawarkan lingkungan kerja yang dinamis dan mendukung pengembangan karir Anda. Kami menghargai inovasi, kolaborasi, dan pertumbuhan profesional.</p>
              <ul class="text-sm">
                <li>Paket kompensasi yang kompetitif</li>
                <li>Kesempatan pengembangan karir</li>
                <li>Lingkungan kerja yang inklusif</li>
                <li>Program kesejahteraan karyawan</li>
                <li>Keseimbangan kehidupan kerja</li>
              </ul>
            </div>
            <div class="col-md-6">
              <h5>Proses Rekrutmen</h5>
              <div class="timeline timeline-one-side">
                <div class="timeline-block mb-3">
                  <span class="timeline-step">
                    <i class="ni ni-send text-primary"></i>
                  </span>
                  <div class="timeline-content">
                    <h6 class="text-dark text-sm font-weight-bold mb-0">Pengiriman Lamaran</h6>
                    <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">Kirim CV dan surat lamaran Anda</p>
                  </div>
                </div>
                <div class="timeline-block mb-3">
                  <span class="timeline-step">
                    <i class="ni ni-check-bold text-info"></i>
                  </span>
                  <div class="timeline-content">
                    <h6 class="text-dark text-sm font-weight-bold mb-0">Seleksi Berkas</h6>
                    <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">Evaluasi kualifikasi dan pengalaman</p>
                  </div>
                </div>
                <div class="timeline-block mb-3">
                  <span class="timeline-step">
                    <i class="ni ni-ruler-pencil text-warning"></i>
                  </span>
                  <div class="timeline-content">
                    <h6 class="text-dark text-sm font-weight-bold mb-0">Penilaian</h6>
                    <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">Tes kemampuan teknis dan non-teknis</p>
                  </div>
                </div>
                <div class="timeline-block mb-3">
                  <span class="timeline-step">
                    <i class="ni ni-chat-round text-success"></i>
                  </span>
                  <div class="timeline-content">
                    <h6 class="text-dark text-sm font-weight-bold mb-0">Wawancara</h6>
                    <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">Diskusi dengan tim rekrutmen dan departemen terkait</p>
                  </div>
                </div>
                <div class="timeline-block">
                  <span class="timeline-step">
                    <i class="ni ni-trophy text-primary"></i>
                  </span>
                  <div class="timeline-content">
                    <h6 class="text-dark text-sm font-weight-bold mb-0">Penawaran Kerja</h6>
                    <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">Negosiasi dan penandatanganan kontrak</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
