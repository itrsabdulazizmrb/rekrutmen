<div class="page-header min-vh-75 d-flex align-items-center" style="background-image: url('<?= base_url('assets/img/gallery-hero-bg.jpg') ?>'); background-size: cover; background-position: center;">
  <span class="mask bg-gradient-dark opacity-7"></span>
  <div class="container">
    <div class="row">
      <div class="col-md-10 mx-auto">
        <div class="text-center">
          <h1 class="text-white display-4 font-weight-bold mb-4">Blog Gallery Kembang Ilung</h1>
          <p class="lead text-white fs-5 mb-4">Cerita, Tips, dan Inspirasi Dunia Kerajinan Tradisional</p>
          <p class="text-white opacity-9 mb-5">Jelajahi Artikel Menarik Seputar Seni Anyaman dan Budaya Lokal</p>
          <div class="row justify-content-center">
            <div class="col-md-8">
              <!-- <div class="card card-body bg-white bg-opacity-10 backdrop-blur border-0 shadow-lg py-3">
                <div class="row align-items-center">
                  <div class="col-md-4 text-center mb-3 mb-md-0">
                    <i class="fas fa-book-open text-warning fa-2x mb-2"></i>
                    <h6 class="text-gray mb-0">Artikel Edukatif</h6>
                  </div>
                  <div class="col-md-4 text-center mb-3 mb-md-0">
                    <i class="fas fa-lightbulb text-warning fa-2x mb-2"></i>
                    <h6 class="text-gray mb-0">Tips & Inspirasi</h6>
                  </div>
                  <div class="col-md-4 text-center">
                    <i class="fas fa-newspaper text-warning fa-2x mb-2"></i>
                    <h6 class="text-gray mb-0">Berita Terkini</h6>
                  </div>
                </div>
              </div> -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="container">
  <div class="row mt-n6">
    <div class="col-md-12">
      <div class="card card-body blur shadow-blur mx-3 mx-md-4">
        <form action="<?= base_url('blog') ?>" method="get">
          <div class="row">
            <div class="col-md-10">
              <div class="input-group">
                <span class="input-group-text"><i class="fas fa-search"></i></span>
                <input type="text" class="form-control" name="q" placeholder="Cari artikel..." value="<?= $this->input->get('q') ?>">
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
    <div class="col-lg-8">
      <div class="row">
        <?php if (empty($posts)) : ?>
          <div class="col-12">
            <div class="card">
              <div class="card-body text-center py-5">
                <h4 class="text-secondary">Tidak ada artikel yang ditemukan</h4>
                <p class="text-muted">Silakan coba dengan kata kunci yang berbeda atau kembali lagi nanti.</p>
              </div>
            </div>
          </div>
        <?php else : ?>
          <?php foreach ($posts as $post) : ?>
            <div class="col-md-6 mb-4">
              <div class="card blog-card h-100">
                <div class="card-header p-0 mx-3 mt-3 position-relative z-index-1">
                  <a href="<?= base_url('blog/' . $post->slug) ?>" class="d-block">
                    <?php if ($post->gambar_utama) : ?>
                      <img src="<?= base_url('uploads/blog_images/' . $post->gambar_utama) ?>" class="img-fluid border-radius-lg blog-featured-image" alt="<?= $post->judul ?>">
                    <?php else : ?>
                      <img src="<?= base_url('assets/img/blog-placeholder.jpg') ?>" class="img-fluid border-radius-lg blog-featured-image" alt="<?= $post->judul ?>">
                    <?php endif; ?>
                  </a>
                </div>
                <div class="card-body pt-3">
                  <h5 class="mb-0"><a href="<?= base_url('blog/' . $post->slug) ?>" class="text-dark"><?= $post->judul ?></a></h5>
                  <p class="text-sm mt-2 mb-0">
                    <i class="fas fa-user me-1"></i> <?= $post->author_name ?>
                    <span class="mx-2">|</span>
                    <i class="fas fa-calendar me-1"></i> <?= date('d M Y', strtotime($post->dibuat_pada)) ?>
                  </p>
                  <p class="text-sm mt-3 mb-3"><?= character_limiter(strip_tags($post->konten), 150) ?></p>
                  <a href="<?= base_url('blog/' . $post->slug) ?>" class="text-primary text-sm font-weight-bold">Baca selengkapnya</a>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        <?php endif; ?>
      </div>

      <!-- Pagination -->
      <div class="row mt-4">
        <div class="col-md-12">
          <nav aria-label="Page navigation">
            <?= $pagination ?>
          </nav>
        </div>
      </div>
    </div>

    <div class="col-lg-4">
      <!-- Categories -->
      <div class="card">
        <div class="card-header pb-0">
          <h5 class="mb-0">Kategori</h5>
        </div>
        <div class="card-body pt-2">
          <ul class="list-group">
            <?php foreach ($categories as $category) : ?>
              <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                <div class="d-flex align-items-center">
                  <div class="icon icon-shape icon-sm bg-gradient-primary shadow text-center me-2">
                    <i class="fas fa-tag text-white opacity-10"></i>
                  </div>
                  <a href="<?= base_url('blog?category=' . $category->id) ?>" class="text-dark"><?= $category->nama ?></a>
                </div>
                <div>
                  <span class="badge badge-sm bg-gradient-primary">0</span>
                </div>
              </li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>

      <!-- Recent Posts -->
      <div class="card mt-4">
        <div class="card-header pb-0">
          <h5 class="mb-0">Artikel Terbaru</h5>
        </div>
        <div class="card-body pt-2">
          <?php
          // Get recent posts from controller data instead of calling model directly
          if (isset($recent_posts) && !empty($recent_posts)) :
            foreach ($recent_posts as $recent_post) :
          ?>
            <div class="d-flex mt-3">
              <div>
                <div class="avatar avatar-sm bg-gradient-primary shadow text-center rounded-circle">
                  <i class="fas fa-newspaper text-white opacity-10"></i>
                </div>
              </div>
              <div class="ms-3">
                <a href="<?= base_url('blog/' . $recent_post->slug) ?>" class="text-dark">
                  <h6 class="mb-0 text-sm"><?= $recent_post->judul ?></h6>
                </a>
                <p class="text-xs text-secondary mb-0"><?= date('d M Y', strtotime($recent_post->dibuat_pada)) ?></p>
              </div>
            </div>
            <hr class="horizontal dark my-3">
          <?php
            endforeach;
          else :
          ?>
            <p class="text-sm text-muted">Belum ada artikel terbaru.</p>
          <?php endif; ?>
        </div>
      </div>

      <!-- Subscribe -->
      <div class="card mt-4">
        <div class="card-header p-3 pb-0">
          <h5 class="mb-0">Berlangganan</h5>
          <p class="text-sm mb-0">Dapatkan artikel terbaru langsung ke email Anda</p>
        </div>
        <div class="card-body p-3">
          <form action="<?= base_url('beranda/berlangganan') ?>" method="post">
            <div class="mb-3">
              <input type="email" class="form-control" name="email" placeholder="Email Anda" required>
            </div>
            <button type="submit" class="btn bg-gradient-primary w-100">Berlangganan</button>
          </form>
        </div>
      </div>

      <!-- Tags -->
      <div class="card mt-4">
        <div class="card-header pb-0">
          <h5 class="mb-0">Tag Populer</h5>
        </div>
        <div class="card-body pt-2">
          <div class="d-flex flex-wrap">
            <a href="<?= base_url('blog?tag=rekrutmen') ?>" class="badge bg-gradient-primary me-2 mb-2">Rekrutmen</a>
            <a href="<?= base_url('blog?tag=karir') ?>" class="badge bg-gradient-info me-2 mb-2">Karir</a>
            <a href="<?= base_url('blog?tag=wawancara') ?>" class="badge bg-gradient-success me-2 mb-2">Wawancara</a>
            <a href="<?= base_url('blog?tag=cv') ?>" class="badge bg-gradient-warning me-2 mb-2">CV</a>
            <a href="<?= base_url('blog?tag=tips') ?>" class="badge bg-gradient-danger me-2 mb-2">Tips</a>
            <a href="<?= base_url('blog?tag=hr') ?>" class="badge bg-gradient-dark me-2 mb-2">HR</a>
            <a href="<?= base_url('blog?tag=teknologi') ?>" class="badge bg-gradient-secondary me-2 mb-2">Teknologi</a>
            <a href="<?= base_url('blog?tag=remote') ?>" class="badge bg-gradient-light text-dark me-2 mb-2">Remote</a>
            <a href="<?= base_url('blog?tag=freelance') ?>" class="badge bg-gradient-primary me-2 mb-2">Freelance</a>
            <a href="<?= base_url('blog?tag=startup') ?>" class="badge bg-gradient-info me-2 mb-2">Startup</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
