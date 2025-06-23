<div class="container mt-7">
  <div class="row">
    <div class="col-lg-8">
      <div class="card">
        <div class="card-body p-4">
          <h2 class="mb-3"><?= $post->title ?></h2>

          <div class="d-flex align-items-center mb-4">
            <div class="avatar avatar-sm rounded-circle bg-gradient-primary">
              <i class="fas fa-user text-white"></i>
            </div>
            <div class="ms-2">
              <span class="text-sm"><?= $post->author_name ?></span>
              <span class="text-sm text-secondary ms-2">|</span>
              <span class="text-sm text-secondary ms-2"><?= date('d M Y', strtotime($post->created_at)) ?></span>
            </div>
          </div>

          <?php if ($post->featured_image) : ?>
            <div class="mb-4">
              <img src="<?= base_url('uploads/blog_images/' . $post->featured_image) ?>" class="img-fluid rounded" alt="<?= $post->title ?>">
            </div>
          <?php endif; ?>

          <div class="mb-4">
            <?php if (!empty($post_categories)) : ?>
              <div class="mb-3">
                <?php foreach ($post_categories as $category) : ?>
                  <a href="<?= base_url('home/blog?category=' . $category->id) ?>" class="badge bg-gradient-primary me-2"><?= $category->name ?></a>
                <?php endforeach; ?>
              </div>
            <?php endif; ?>

            <div class="blog-content">
              <?= $post->content ?>
            </div>
          </div>

          <!-- Share Post -->
          <div class="mt-5">
            <h5 class="mb-3">Bagikan Artikel Ini</h5>
            <div class="d-flex">
              <a href="https://www.facebook.com/sharer/sharer.php?u=<?= current_url() ?>" target="_blank" class="btn btn-facebook btn-icon-only me-2">
                <span class="btn-inner--icon"><i class="fab fa-facebook"></i></span>
              </a>
              <a href="https://twitter.com/intent/tweet?url=<?= current_url() ?>&text=<?= $post->title ?> - SIREK" target="_blank" class="btn btn-twitter btn-icon-only me-2">
                <span class="btn-inner--icon"><i class="fab fa-twitter"></i></span>
              </a>
              <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?= current_url() ?>" target="_blank" class="btn btn-linkedin btn-icon-only me-2">
                <span class="btn-inner--icon"><i class="fab fa-linkedin"></i></span>
              </a>
              <a href="https://wa.me/?text=<?= $post->title ?> - <?= current_url() ?>" target="_blank" class="btn btn-whatsapp btn-icon-only me-2">
                <span class="btn-inner--icon"><i class="fab fa-whatsapp"></i></span>
              </a>
              <a href="mailto:?subject=<?= $post->title ?> - SIREK&body=Baca artikel ini: <?= current_url() ?>" class="btn btn-google-plus btn-icon-only">
                <span class="btn-inner--icon"><i class="fas fa-envelope"></i></span>
              </a>
            </div>
          </div>
        </div>
      </div>

      <!-- Author Info -->
      <div class="card mt-4">
        <div class="card-body p-4">
          <div class="d-flex">
            <div class="avatar avatar-xl rounded-circle bg-gradient-primary">
              <i class="fas fa-user text-white"></i>
            </div>
            <div class="ms-3">
              <h5 class="mb-0"><?= $post->author_name ?></h5>
              <p class="text-sm text-secondary mb-2">Penulis</p>
              <p class="text-sm mb-0">Spesialis rekrutmen dan pengembangan karir dengan pengalaman lebih dari 5 tahun di industri HR dan teknologi.</p>
            </div>
          </div>
        </div>
      </div>

      

      <!-- Comment system will be implemented in future updates -->
      <div class="card mt-4">
        <div class="card-body p-4 text-center">
          <h5 class="mb-3">Sistem Komentar</h5>
          <p class="text-muted">Fitur komentar akan segera tersedia dalam pembaruan mendatang.</p>
        </div>
      </div>
    </div>

    <div class="col-lg-4">
      <!-- Search -->
      <div class="card">
        <div class="card-body p-3">
          <form action="<?= base_url('blog') ?>" method="get">
            <div class="input-group">
              <span class="input-group-text"><i class="fas fa-search"></i></span>
              <input type="text" class="form-control" name="q" placeholder="Cari artikel...">
              <button type="submit" class="btn btn-primary">Cari</button>
            </div>
          </form>
        </div>
      </div>

      <!-- Categories -->
      <div class="card mt-4">
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

      <!-- Related Posts -->
      <div class="card mt-4">
        <div class="card-header pb-0">
          <h5 class="mb-0">Artikel Terkait</h5>
        </div>
        <div class="card-body pt-2">
          <?php if (empty($related_posts)) : ?>
            <p class="text-sm">Tidak ada artikel terkait saat ini.</p>
          <?php else : ?>
            <?php foreach ($related_posts as $related_post) : ?>
              <div class="d-flex mt-3">
                <div>
                  <div class="avatar avatar-sm bg-gradient-primary shadow text-center rounded-circle">
                    <i class="fas fa-newspaper text-white opacity-10"></i>
                  </div>
                </div>
                <div class="ms-3">
                  <a href="<?= base_url('blog/' . $related_post->slug) ?>" class="text-dark">
                    <h6 class="mb-0 text-sm"><?= $related_post->title ?></h6>
                  </a>
                  <p class="text-xs text-secondary mb-0"><?= date('d M Y', strtotime($related_post->created_at)) ?></p>
                </div>
              </div>
              <hr class="horizontal dark my-3">
            <?php endforeach; ?>
          <?php endif; ?>
        </div>
      </div>

      <!-- Tags -->
      <div class="card mt-4">
        <div class="card-header pb-0">
          <h5 class="mb-0">Tag</h5>
        </div>
        <div class="card-body pt-2">
          <div class="d-flex flex-wrap">
            <a href="<?= base_url('home/blog?tag=rekrutmen') ?>" class="badge bg-gradient-primary me-2 mb-2">Rekrutmen</a>
            <a href="<?= base_url('home/blog?tag=karir') ?>" class="badge bg-gradient-info me-2 mb-2">Karir</a>
            <a href="<?= base_url('home/blog?tag=wawancara') ?>" class="badge bg-gradient-success me-2 mb-2">Wawancara</a>
            <a href="<?= base_url('home/blog?tag=cv') ?>" class="badge bg-gradient-warning me-2 mb-2">CV</a>
            <a href="<?= base_url('home/blog?tag=tips') ?>" class="badge bg-gradient-danger me-2 mb-2">Tips</a>
          </div>
        </div>
      </div>

      <!-- Subscribe -->
      <div class="card mt-4">
        <div class="card-header p-3 pb-0">
          <h5 class="mb-0">Berlangganan</h5>
          <p class="text-sm mb-0">Dapatkan artikel terbaru langsung ke email Anda</p>
        </div>
        <div class="card-body p-3">
          <form action="<?= base_url('home/subscribe') ?>" method="post">
            <div class="mb-3">
              <input type="email" class="form-control" name="email" placeholder="Email Anda" required>
            </div>
            <button type="submit" class="btn bg-gradient-primary w-100">Berlangganan</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
