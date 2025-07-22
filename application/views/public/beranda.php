<div class="page-header min-vh-75 d-flex align-items-center" style="background-image: url('<?= base_url('assets/img/gallery-hero-bg.jpg') ?>'); background-size: cover; background-position: center;">
  <span class="mask bg-gradient-dark opacity-7"></span>
  <div class="container">
    <div class="row">
      <div class="col-md-10 mx-auto">
        <div class="text-center">
          <h1 class="text-white display-4 font-weight-bold mb-4">Rekrutmen RSUD H. Abdul Aziz Marabahan</h1>
          <p class="lead text-white fs-5 mb-4">Selamat Datang di Portal Karir Resmi RSUD H. Abdul Aziz Marabahan</p>
          <p class="text-white opacity-9 mb-5">Temukan Peluang Karir Terbaik Anda dan Bergabunglah Bersama Kami</p>

          <!-- <div class="row justify-content-center mb-5">
            <div class="col-md-8">
              <div class="card card-body bg-white bg-opacity-10 backdrop-blur border-0 shadow-lg py-3">
                <div class="row align-items-center">
                  <div class="col-md-4 text-center mb-3 mb-md-0">
                    <i class="fas fa-leaf text-warning fa-2x mb-2"></i>
                    <h6 class="text-gray mb-0">Ramah Lingkungan</h6>
                  </div>
                  <div class="col-md-4 text-center mb-3 mb-md-0">
                    <i class="fas fa-hands text-warning fa-2x mb-2"></i>
                    <h6 class="text-gray mb-0">Kerajinan Tangan</h6>
                  </div>
                  <div class="col-md-4 text-center">
                    <i class="fas fa-heart text-warning fa-2x mb-2"></i>
                    <h6 class="text-gray mb-0">Warisan Budaya</h6>
                  </div>
                </div>
              </div>
            </div>
          </div> -->

          <div class="row justify-content-center">
            <div class="col-md-6">
              <a href="<?= base_url('lowongan') ?>" class="btn btn-lg bg-gradient-primary text-white me-3 mb-3">
                <i class="fas fa-briefcase me-2"></i>Lihat Lowongan
              </a>
              <a href="<?= base_url('tentang') ?>" class="btn btn-lg btn-outline-white mb-3">
                <i class="fas fa-info-circle me-2"></i>Tentang Kami
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="container">
  <div class="row mt-n6">
    <div class="col-md-4">
      <div class="card move-on-hover">
        <div class="card-body text-center">
          <div class="icon icon-shape icon-lg bg-gradient-primary shadow text-center border-radius-lg">
            <i class="fas fa-search opacity-10"></i>
          </div>
          <h5 class="mt-3 mb-0">Cari Lowongan</h5>
          <p>Temukan berbagai posisi yang sesuai dengan keahlian dan minat Anda.</p>
          <a href="<?= base_url('lowongan') ?>" class="btn btn-outline-primary mt-3">Mulai Mencari</a>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card move-on-hover">
        <div class="card-body text-center">
          <div class="icon icon-shape icon-lg bg-gradient-success shadow text-center border-radius-lg">
            <i class="fas fa-user-plus opacity-10"></i>
          </div>
          <h5 class="mt-3 mb-0">Daftar Akun</h5>
          <p>Buat akun untuk melamar pekerjaan dan mengelola profil karir Anda.</p>
          <a href="<?= base_url('auth/daftar') ?>" class="btn btn-outline-primary mt-3">Daftar Sekarang</a>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card move-on-hover">
        <div class="card-body text-center">
          <div class="icon icon-shape icon-lg bg-gradient-warning shadow text-center border-radius-lg">
            <i class="fas fa-file-alt opacity-10"></i>
          </div>
          <h5 class="mt-3 mb-0">Proses Rekrutmen</h5>
          <p>Pelajari tahapan-tahapan dalam proses seleksi kami untuk persiapan yang lebih baik.</p>
          <a href="<?= base_url('kontak') ?>" class="btn btn-outline-primary mt-3">Lihat Proses</a>
        </div>
      </div>
    </div>
  </div>

  <div class="row mt-5">
    <div class="col-12">
      <div class="card card-body border-0 shadow-xl mt-n5">
        <h3 class="text-center">Lowongan Terbaru</h3>
        <p class="text-center">Jangan lewatkan kesempatan untuk bergabung dengan tim kami</p>

        <div class="row mt-4">
          <?php if (empty($latest_jobs)) : ?>
            <p class="text-center">Saat ini belum ada lowongan terbaru.</p>
          <?php else : ?>
            <?php foreach ($latest_jobs as $job) : ?>
              <div class="col-md-4 mb-4">
                <div class="card h-100">
                  <div class="card-body pt-3">
                    <span class="badge bg-gradient-<?= $job->jenis_pekerjaan == 'penuh_waktu' ? 'success' : 'info' ?> mb-2"><?= $job->jenis_pekerjaan == 'penuh_waktu' ? 'Penuh Waktu' : 'Paruh Waktu' ?></span>
                    <h5><?= $job->judul ?></h5>
                    <p class="mb-0 text-sm"><i class="fas fa-map-marker-alt me-1"></i> <?= $job->lokasi ?></p>
                    <p class="mb-0 text-sm"><i class="fas fa-calendar-alt me-1"></i> Batas: <?= date('d M Y', strtotime($job->batas_waktu)) ?></p>
                    <div class="d-flex align-items-center mt-3">
                      <a href="<?= base_url('lowongan/detail/' . $job->id) ?>" class="btn btn-outline-primary btn-sm mb-0">Lihat Detail</a>
                    </div>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
          <?php endif; ?>
        </div>

        <div class="text-center mt-4">
          <a href="<?= base_url('lowongan') ?>" class="btn bg-gradient-primary">Lihat Semua Lowongan</a>
        </div>
      </div>
    </div>
  </div>

  <div class="row mt-5">
    <div class="col-md-6">
      <div class="card">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
          <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
            <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">Latest Blog Posts</h4>
          </div>
        </div>
        <div class="card-body">
          <?php if (empty($latest_posts)) : ?>
            <p class="text-center">No blog posts available at the moment.</p>
          <?php else : ?>
            <?php foreach ($latest_posts as $post) : ?>
              <div class="d-flex mt-4">
                <div>
                  <div class="avatar avatar-xl bg-gradient-dark shadow text-center border-radius-xl">
                    <i class="fas fa-newspaper text-white opacity-10"></i>
                  </div>
                </div>
                <div class="ms-3">
                  <h6 class="mb-0"><?= $post->judul ?></h6>
                  <p class="text-sm mb-0"><i class="fas fa-user me-1"></i> <?= $post->author_name ?></p>
                  <p class="text-sm mb-0"><i class="fas fa-calendar me-1"></i> <?= date('d M Y', strtotime($post->dibuat_pada)) ?></p>
                  <a href="<?= base_url('blog/' . $post->slug) ?>" class="text-primary text-sm font-weight-bold mb-0">Read more</a>
                </div>
              </div>
              <hr class="horizontal dark">
            <?php endforeach; ?>
          <?php endif; ?>

          <div class="text-center mt-4">
            <a href="<?= base_url('blog') ?>" class="btn btn-outline-primary btn-sm mb-0">View All Posts</a>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="card">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
          <div class="bg-gradient-success shadow-success border-radius-lg py-3 pe-1">
            <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">Mengapa Bergabung Dengan Kami</h4>
          </div>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <div class="info">
                <div class="icon icon-sm">
                  <i class="fas fa-user-md text-primary"></i>
                </div>
                <h5 class="font-weight-bolder mt-3">Lingkungan Profesional</h5>
                <p>Bekerja dalam lingkungan yang mendukung pengembangan profesionalisme dan keahlian.</p>
              </div>
            </div>
            <div class="col-md-6">
              <div class="info">
                <div class="icon icon-sm">
                  <i class="fas fa-users text-primary"></i>
                </div>
                <h5 class="font-weight-bolder mt-3">Kerja Tim Solid</h5>
                <p>Berkolaborasi dengan tim yang solid dan berdedikasi dalam memberikan pelayanan terbaik.</p>
              </div>
            </div>
          </div>
          <div class="row mt-4">
            <div class="col-md-6">
              <div class="info">
                <div class="icon icon-sm">
                  <i class="fas fa-chart-line text-primary"></i>
                </div>
                <h5 class="font-weight-bolder mt-3">Jenjang Karir</h5>
                <p>Kami menyediakan jalur karir yang jelas dan kesempatan untuk berkembang.</p>
              </div>
            </div>
            <div class="col-md-6">
              <div class="info">
                <div class="icon icon-sm">
                  <i class="fas fa-heartbeat text-primary"></i>
                </div>
                <h5 class="font-weight-bolder mt-3">Kontribusi Sosial</h5>
                <p>Berikan dampak positif bagi masyarakat melalui pelayanan kesehatan yang berkualitas.</p>
              </div>
            </div>
          </div> 
          <div class="text-center mt-4">
            <a href="<?= base_url('tentang') ?>" class="btn btn-outline-primary btn-sm mb-0">Pelajari Lebih Lanjut</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
