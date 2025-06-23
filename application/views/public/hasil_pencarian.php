<div class="page-header min-vh-50" style="background-image: url('<?= base_url('assets/img/search-bg.jpg') ?>');">
  <span class="mask bg-gradient-dark opacity-6"></span>
  <div class="container">
    <div class="row">
      <div class="col-md-8 mx-auto">
        <div class="text-center">
          <h1 class="text-white">Hasil Pencarian</h1>
          <p class="lead text-white">Hasil pencarian untuk: "<?= $search_query ?>"</p>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="container">
  <div class="row mt-n6">
    <div class="col-md-12">
      <div class="card card-body blur shadow-blur mx-3 mx-md-4">
        <form action="<?= base_url('cari') ?>" method="get">
          <div class="row">
            <div class="col-md-10">
              <div class="input-group">
                <span class="input-group-text"><i class="fas fa-search"></i></span>
                <input type="text" class="form-control" name="q" placeholder="Cari lowongan..." value="<?= $search_query ?>">
              </div>
            </div>
            <div class="col-md-2">
              <button type="submit" class="btn bg-gradient-primary w-100">Cari</button>
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
          <h5 class="mb-0">Hasil Pencarian</h5>
          <p class="text-sm mb-0">
            <?php if (!empty($jobs)) : ?>
              Ditemukan <?= count($jobs) ?> lowongan untuk "<?= $search_query ?>"
            <?php else : ?>
              Tidak ditemukan lowongan untuk "<?= $search_query ?>"
            <?php endif; ?>
          </p>
        </div>
        <div class="card-body p-3">
          <?php if (empty($jobs)) : ?>
            <div class="text-center py-5">
              <h4 class="text-secondary">Tidak ada lowongan yang ditemukan</h4>
              <p class="text-muted">Silakan coba dengan kata kunci yang berbeda atau kembali ke halaman lowongan.</p>
              <a href="<?= base_url('lowongan') ?>" class="btn btn-primary mt-3">Lihat Semua Lowongan</a>
            </div>
          <?php else : ?>
            <div class="row">
              <?php foreach ($jobs as $job) : ?>
                <div class="col-md-6 mb-4">
                  <div class="card job-card h-100">
                    <div class="card-body">
                      <div class="d-flex justify-content-between mb-2">
                        <span class="badge bg-gradient-<?= $job->jenis_pekerjaan == 'full-time' ? 'success' : ($job->jenis_pekerjaan == 'part-time' ? 'info' : ($job->jenis_pekerjaan == 'contract' ? 'warning' : 'secondary')) ?> job-badge"><?= $job->jenis_pekerjaan == 'full-time' ? 'Full Time' : ($job->jenis_pekerjaan == 'part-time' ? 'Part Time' : ($job->jenis_pekerjaan == 'contract' ? 'Kontrak' : 'Magang')) ?></span>
                        <?php if ($job->unggulan) : ?>
                          <span class="badge bg-gradient-primary job-badge">Unggulan</span>
                        <?php endif; ?>
                      </div>
                      <h5 class="card-title"><?= $job->judul ?></h5>
                      <p class="card-text text-sm mb-1"><i class="fas fa-building me-1"></i> <?= $job->company_name ?? 'SIREK Company' ?></p>
                      <p class="card-text text-sm mb-1"><i class="fas fa-map-marker-alt me-1"></i> <?= $job->lokasi ?></p>
                      <p class="card-text text-sm mb-1"><i class="fas fa-tag me-1"></i> <?= $job->category_name ?></p>
                      <?php if ($job->rentang_gaji) : ?>
                        <p class="card-text text-sm mb-1"><i class="fas fa-money-bill-wave me-1"></i> <?= $job->rentang_gaji ?></p>
                      <?php endif; ?>
                      <p class="card-text text-sm mb-3"><i class="fas fa-calendar me-1"></i> Batas: <?= date('d M Y', strtotime($job->batas_waktu)) ?></p>

                      <div class="d-flex justify-content-between align-items-center mt-3">
                        <a href="<?= base_url('lowongan/' . $job->id) ?>" class="btn btn-outline-primary btn-sm">Lihat Detail</a>
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
              <h5>Tidak menemukan yang Anda cari?</h5>
              <p class="text-sm">Jika Anda tidak menemukan lowongan yang sesuai, Anda dapat:</p>
              <ul class="text-sm">
                <li>Mencoba kata kunci yang berbeda</li>
                <li>Melihat semua lowongan yang tersedia</li>
                <li>Membuat profil dan mengaktifkan notifikasi lowongan</li>
                <li>Menghubungi tim kami untuk bantuan</li>
              </ul>
              <div class="mt-4">
                <a href="<?= base_url('lowongan') ?>" class="btn btn-outline-primary me-2">Lihat Semua Lowongan</a>
                <a href="<?= base_url('kontak') ?>" class="btn btn-outline-secondary">Hubungi Kami</a>
              </div>
            </div>
            <div class="col-md-6">
              <h5>Tips Pencarian</h5>
              <div class="p-3 bg-gray-100 rounded">
                <p class="text-sm mb-2"><strong>Gunakan kata kunci yang spesifik</strong> - Misalnya, "developer java senior" daripada hanya "developer".</p>
                <p class="text-sm mb-2"><strong>Coba variasi kata kunci</strong> - Beberapa lowongan mungkin menggunakan istilah yang berbeda untuk posisi yang sama.</p>
                <p class="text-sm mb-2"><strong>Gunakan filter</strong> - Anda dapat memfilter hasil berdasarkan lokasi, tipe pekerjaan, atau kategori di halaman lowongan.</p>
                <p class="text-sm mb-0"><strong>Daftar untuk notifikasi</strong> - Dapatkan pemberitahuan saat lowongan baru yang sesuai dengan kriteria Anda tersedia.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
