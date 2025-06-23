<div class="page-header min-vh-50 d-flex align-items-center" style="background-image: url('<?= base_url('assets/img/gallery-hero-bg.jpg') ?>'); background-size: cover; background-position: center;">
  <span class="mask bg-gradient-dark opacity-7"></span>
  <div class="container">
    <div class="row">
      <div class="col-md-10 mx-auto">
        <div class="text-center">
          <h1 class="text-white display-5 font-weight-bold mb-4">Lowongan Pekerjaan</h1>
          <!-- <p class="lead text-white fs-6 mb-4">Temukan Informasi Lengkap Produk Anyaman Eceng Gondok Pilihan Anda</p> -->
          <!-- <div class="row justify-content-center">
            <div class="col-md-8">
              <div class="card card-body bg-white bg-opacity-10 backdrop-blur border-0 shadow-lg py-3">
                <div class="row align-items-center">
                  <div class="col-md-4 text-center mb-3 mb-md-0">
                    <i class="fas fa-info-circle text-warning fa-2x mb-2"></i>
                    <h6 class="text-white mb-0">Detail Lengkap</h6>
                  </div>
                  <div class="col-md-4 text-center mb-3 mb-md-0">
                    <i class="fas fa-star text-warning fa-2x mb-2"></i>
                    <h6 class="text-white mb-0">Kualitas Terjamin</h6>
                  </div>
                  <div class="col-md-4 text-center">
                    <i class="fas fa-shopping-cart text-warning fa-2x mb-2"></i>
                    <h6 class="text-white mb-0">Mudah Dipesan</h6>
                  </div>
                </div>
              </div>
            </div>
          </div> -->
        </div>
      </div>
    </div>
  </div>
</div>

<div class="container mt-n6">
  <div class="row">
    <div class="col-lg-8">
      <div class="card">
        <div class="card-body p-4">
          <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
              <h3 class="mb-0"><?= $job->judul ?></h3>
              <p class="text-sm mb-0">Diposting pada <?= date('d M Y', strtotime($job->dibuat_pada)) ?></p>
            </div>
            <div>
              <span class="badge bg-gradient-<?= $job->jenis_pekerjaan == 'penuh_waktu' ? 'success' : ($job->jenis_pekerjaan == 'paruh_waktu' ? 'info' : ($job->jenis_pekerjaan == 'kontrak' ? 'warning' : 'secondary')) ?> job-badge"><?= $job->jenis_pekerjaan == 'penuh_waktu' ? 'Full Time' : ($job->jenis_pekerjaan == 'paruh_waktu' ? 'Part Time' : ($job->jenis_pekerjaan == 'kontrak' ? 'Kontrak' : 'Magang')) ?></span>
              <?php if ($job->unggulan) : ?>
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
                  <p class="text-sm mb-0">Lokasi: <span class="font-weight-bold"><?= $job->lokasi ?></span></p>
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
              <?php if ($job->rentang_gaji) : ?>
                <div class="d-flex align-items-center mb-2">
                  <div class="icon icon-shape icon-xs bg-gradient-primary shadow text-center">
                    <i class="fas fa-money-bill-wave opacity-10"></i>
                  </div>
                  <div class="ms-2">
                    <p class="text-sm mb-0">Kisaran Gaji: <span class="font-weight-bold"><?= $job->rentang_gaji ?></span></p>
                  </div>
                </div>
              <?php endif; ?>
              <div class="d-flex align-items-center mb-2">
                <div class="icon icon-shape icon-xs bg-gradient-primary shadow text-center">
                  <i class="fas fa-calendar opacity-10"></i>
                </div>
                <div class="ms-2">
                  <p class="text-sm mb-0">Batas Lamaran: <span class="font-weight-bold"><?= date('d M Y', strtotime($job->batas_waktu)) ?></span></p>
                </div>
              </div>
              <div class="d-flex align-items-center mb-2">
                <div class="icon icon-shape icon-xs bg-gradient-primary shadow text-center">
                  <i class="fas fa-users opacity-10"></i>
                </div>
                <div class="ms-2">
                  <p class="text-sm mb-0">Jumlah Posisi: <span class="font-weight-bold"><?= $job->jumlah_lowongan ?></span></p>
                </div>
              </div>
            </div>
          </div>

          <div class="mb-4">
            <h5>Deskripsi Pekerjaan</h5>
            <div class="p-3 bg-gray-100 rounded">
              <?= nl2br($job->deskripsi) ?>
            </div>
          </div>

          <div class="mb-4">
            <h5>Persyaratan</h5>
            <div class="p-3 bg-gray-100 rounded">
              <?= nl2br($job->persyaratan) ?>
            </div>
          </div>

          <div class="mb-4">
            <h5>Tanggung Jawab</h5>
            <div class="p-3 bg-gray-100 rounded">
              <?= nl2br($job->tanggung_jawab) ?>
            </div>
          </div>

          <div class="d-flex justify-content-between align-items-center mt-5">
            <a href="<?= base_url('lowongan') ?>" class="btn btn-outline-primary">Kembali ke Daftar Lowongan</a>
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
            <a href="https://twitter.com/intent/tweet?url=<?= current_url() ?>&text=<?= $job->judul ?> - SIREK" target="_blank" class="btn btn-twitter btn-icon-only me-2">
              <span class="btn-inner--icon"><i class="fab fa-twitter"></i></span>
            </a>
            <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?= current_url() ?>" target="_blank" class="btn btn-linkedin btn-icon-only me-2">
              <span class="btn-inner--icon"><i class="fab fa-linkedin"></i></span>
            </a>
            <a href="https://wa.me/?text=<?= $job->judul ?> - <?= current_url() ?>" target="_blank" class="btn btn-whatsapp btn-icon-only me-2">
              <span class="btn-inner--icon"><i class="fab fa-whatsapp"></i></span>
            </a>
            <a href="mailto:?subject=<?= $job->judul ?> - SIREK&body=Lihat lowongan pekerjaan ini: <?= current_url() ?>" class="btn btn-google-plus btn-icon-only">
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
              <small>Belum punya akun? <a href="<?= base_url('auth/daftar') ?>">Daftar sekarang</a></small>
            </div>
          <?php endif; ?>
        </div>
      </div>

      <!-- Company Info Card -->
      <div class="card mt-4">
        <div class="card-body p-4">
          <h5 class="mb-3">Tentang Gallery Kembang Ilung</h5>
          <div class="text-center mb-3">
            <img src="<?= base_url('assets/img/gallery-logo.png') ?>" alt="Gallery Kembang Ilung Logo" class="img-fluid rounded-circle" style="width: 100px; height: 100px; object-fit: cover;">
          </div>
          <h6 class="text-center mb-3 text-gray">Gallery Kembang Ilung</h6>
          <p class="text-sm">Gallery Kembang Ilung adalah destinasi wisata seni kerajinan tradisional yang mengkhususkan diri pada anyaman eceng gondok. Kami melestarikan warisan budaya Indonesia melalui produk kerajinan berkualitas tinggi yang dibuat oleh pengrajin lokal berpengalaman.</p>
          <div class="d-flex align-items-center mb-2">
            <div class="icon icon-shape icon-xs bg-gradient-success shadow text-center">
              <i class="fas fa-leaf opacity-10"></i>
            </div>
            <div class="ms-2">
              <p class="text-sm mb-0">Spesialisasi: Anyaman Eceng Gondok & Kerajinan Tradisional</p>
            </div>
          </div>
          <div class="d-flex align-items-center mb-2">
            <div class="icon icon-shape icon-xs bg-gradient-success shadow text-center">
              <i class="fas fa-map-marker-alt opacity-10"></i>
            </div>
            <div class="ms-2">
              <p class="text-sm mb-0">Lokasi: Desa Banyu Hirang, Amuntai Selatan, Kalimantan Selatan</p>
            </div>
          </div>
          <div class="d-flex align-items-center mb-2">
            <div class="icon icon-shape icon-xs bg-gradient-success shadow text-center">
              <i class="fas fa-hands opacity-10"></i>
            </div>
            <div class="ms-2">
              <p class="text-sm mb-0">Pengrajin: 25+ Master Pengrajin Berpengalaman</p>
            </div>
          </div>
          <div class="d-flex align-items-center mb-2">
            <div class="icon icon-shape icon-xs bg-gradient-success shadow text-center">
              <i class="fas fa-award opacity-10"></i>
            </div>
            <div class="ms-2">
              <p class="text-sm mb-0">Penghargaan: Produk Unggulan Daerah Kalimantan Selatan</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Related Jobs Card -->
      <!-- <div class="card mt-4">
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
                  <h6 class="mb-0 text-sm"><?= $related_job->judul ?></h6>
                  <p class="text-xs text-secondary mb-0"><?= $related_job->lokasi ?></p>
                  <a href="<?= base_url('lowongan/detail/' . $related_job->id) ?>" class="text-primary text-sm">Lihat Detail</a>
                </div>
              </div>
              <hr class="horizontal dark my-3">
            <?php endforeach; ?>
          <?php endif; ?>
        </div>
      </div> -->
    </div>
  </div>
</div>
