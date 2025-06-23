<div class="page-header min-vh-75 d-flex align-items-center" style="background-image: url('<?= base_url('assets/img/gallery-hero-bg.jpg') ?>'); background-size: cover; background-position: center;">
  <span class="mask bg-gradient-dark opacity-7"></span>
  <div class="container">
    <div class="row">
      <div class="col-md-10 mx-auto">
        <div class="text-center">
          <h1 class="text-white display-4 font-weight-bold mb-4">Gallery Kembang Ilung</h1>
          <p class="lead text-white fs-5 mb-4">Selamat Datang di Destinasi Seni Kerajinan Tradisional Indonesia</p>
          <p class="text-white opacity-9 mb-5">Jelajahi Keindahan Anyaman Eceng Gondok dan Nikmati Wisata Rumah Terapung</p>

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
              <a href="<?= base_url('#') ?>" class="btn btn-lg bg-gradient-primary text-white me-3 mb-3">
                <i class="fas fa-images me-2"></i>Lihat Galeri
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
            <i class="fas fa-palette opacity-10"></i>
          </div>
          <h5 class="mt-3 mb-0">Koleksi Seni</h5>
          <p>Jelajahi berbagai karya kerajinan anyaman eceng gondok dan mebel berkualitas tinggi.</p>
          <a href="<?= base_url('gallery') ?>" class="btn btn-outline-primary mt-3">Lihat Koleksi</a>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card move-on-hover">
        <div class="card-body text-center">
          <div class="icon icon-shape icon-lg bg-gradient-success shadow text-center border-radius-lg">
            <i class="fas fa-water opacity-10"></i>
          </div>
          <h5 class="mt-3 mb-0">Rumah Terapung</h5>
          <p>Nikmati pengalaman unik wisata alam dengan pemandangan yang memukau.</p>
          <a href="<?= base_url('wisata') ?>" class="btn btn-outline-primary mt-3">Kunjungi</a>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card move-on-hover">
        <div class="card-body text-center">
          <div class="icon icon-shape icon-lg bg-gradient-warning shadow text-center border-radius-lg">
            <i class="fas fa-graduation-cap opacity-10"></i>
          </div>
          <h5 class="mt-3 mb-0">Workshop</h5>
          <p>Pelajari teknik anyaman tradisional langsung dari para master pengrajin.</p>
          <a href="<?= base_url('workshop') ?>" class="btn btn-outline-primary mt-3">Daftar</a>
        </div>
      </div>
    </div>
  </div>

  <div class="row mt-5">
    <div class="col-12">
      <div class="card card-body border-0 shadow-xl mt-n5">
        <h3 class="text-center">Koleksi Unggulan</h3>
        <p class="text-center">Jelajahi karya kerajinan terbaik kami</p>

        <div class="row mt-4">
          <div class="col-md-4 mb-4">
            <div class="card h-100">
              <div class="card-header p-0 mx-3 mt-3 position-relative z-index-1">
                <div class="d-block blur-shadow-image">
                  <img src="<?= base_url('assets/img/gallery/keranjang.jpg') ?>" alt="Keranjang Anyaman" class="img-fluid shadow border-radius-lg">
                </div>
              </div>
              <div class="card-body pt-3">
                <span class="badge bg-gradient-success mb-2">Bestseller</span>
                <h5>Keranjang Anyaman Premium</h5>
                <p class="mb-0 text-sm"><i class="fas fa-leaf me-1"></i> Bahan: Eceng Gondok</p>
                <p class="mb-0 text-sm"><i class="fas fa-ruler me-1"></i> Ukuran: 30x25x20 cm</p>
                <p class="mb-0 text-sm"><i class="fas fa-star me-1"></i> Rating: 4.8/5</p>
                <div class="d-flex align-items-center mt-3">
                  <a href="<?= base_url('gallery/detail/1') ?>" class="btn btn-outline-primary btn-sm mb-0">Lihat Detail</a>
                  <span class="text-primary font-weight-bold ms-auto">Rp 150.000</span>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-4 mb-4">
            <div class="card h-100">
              <div class="card-header p-0 mx-3 mt-3 position-relative z-index-1">
                <div class="d-block blur-shadow-image">
                  <img src="<?= base_url('assets/img/gallery/set-meja.jpg') ?>" alt="Mebel Anyaman" class="img-fluid shadow border-radius-lg">
                </div>
              </div>
              <div class="card-body pt-3">
                <span class="badge bg-gradient-warning mb-2">Eksklusif</span>
                <h5>Set Meja Kursi Anyaman</h5>
                <p class="mb-0 text-sm"><i class="fas fa-leaf me-1"></i> Bahan: Eceng Gondok & Kayu</p>
                <p class="mb-0 text-sm"><i class="fas fa-users me-1"></i> Kapasitas: 4 Orang</p>
                <p class="mb-0 text-sm"><i class="fas fa-star me-1"></i> Rating: 4.9/5</p>
                <div class="d-flex align-items-center mt-3">
                  <a href="<?= base_url('gallery/detail/2') ?>" class="btn btn-outline-primary btn-sm mb-0">Lihat Detail</a>
                  <span class="text-primary font-weight-bold ms-auto">Rp 2.500.000</span>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-4 mb-4">
            <div class="card h-100">
              <div class="card-header p-0 mx-3 mt-3 position-relative z-index-1">
                <div class="d-block blur-shadow-image">
                  <img src="<?= base_url('assets/img/gallery/hiasan-dinding.jpg') ?>" alt="Dekorasi Anyaman" class="img-fluid shadow border-radius-lg">
                </div>
              </div>
              <div class="card-body pt-3">
                <span class="badge bg-gradient-info mb-2">Terbaru</span>
                <h5>Hiasan Dinding Anyaman</h5>
                <p class="mb-0 text-sm"><i class="fas fa-leaf me-1"></i> Bahan: Eceng Gondok</p>
                <p class="mb-0 text-sm"><i class="fas fa-palette me-1"></i> Desain: Motif Tradisional</p>
                <p class="mb-0 text-sm"><i class="fas fa-star me-1"></i> Rating: 4.7/5</p>
                <div class="d-flex align-items-center mt-3">
                  <a href="<?= base_url('gallery/detail/3') ?>" class="btn btn-outline-primary btn-sm mb-0">Lihat Detail</a>
                  <span class="text-primary font-weight-bold ms-auto">Rp 350.000</span>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="text-center mt-4">
          <a href="<?= base_url('gallery') ?>" class="btn bg-gradient-primary">Lihat Semua Koleksi</a>
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
            <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">Mengapa Memilih Kami</h4>
          </div>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <div class="info">
                <div class="icon icon-sm">
                  <i class="fas fa-leaf text-primary"></i>
                </div>
                <h5 class="font-weight-bolder mt-3">Ramah Lingkungan</h5>
                <p>Menggunakan bahan alami eceng gondok yang berkelanjutan dan tidak merusak lingkungan.</p>
              </div>
            </div>
            <div class="col-md-6">
              <div class="info">
                <div class="icon icon-sm">
                  <i class="fas fa-hands text-primary"></i>
                </div>
                <h5 class="font-weight-bolder mt-3">Kerajinan Tangan</h5>
                <p>Setiap produk dibuat dengan tangan terampil pengrajin berpengalaman puluhan tahun.</p>
              </div>
            </div>
          </div>
          <div class="row mt-4">
            <div class="col-md-6">
              <div class="info">
                <div class="icon icon-sm">
                  <i class="fas fa-award text-primary"></i>
                </div>
                <h5 class="font-weight-bolder mt-3">Kualitas Terjamin</h5>
                <p>Produk berkualitas tinggi dengan standar internasional dan tahan lama.</p>
              </div>
            </div>
            <div class="col-md-6">
              <div class="info">
                <div class="icon icon-sm">
                  <i class="fas fa-heart text-primary"></i>
                </div>
                <h5 class="font-weight-bolder mt-3">Warisan Budaya</h5>
                <p>Melestarikan tradisi anyaman Kalimantan Selatan dengan sentuhan modern.</p>
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
