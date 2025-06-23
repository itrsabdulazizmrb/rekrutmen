<div class="page-header min-vh-80" style="background-image: url('<?= base_url('assets/img/recruitment-bg.jpg') ?>');">
  <span class="mask bg-gradient-dark opacity-6"></span>
  <div class="container">
    <div class="row">
      <div class="col-md-8 mx-auto">
        <div class="text-center">
          <h1 class="text-white">Find Your Dream Job</h1>
          <p class="lead text-white">Discover opportunities that match your skills and career goals</p>

          <div class="row mt-5">
            <div class="col-md-12">
              <div class="card card-body blur shadow-blur mx-3 mx-md-4">
                <form action="<?= base_url('cari') ?>" method="get">
                  <div class="row">
                    <div class="col-md-10">
                      <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                        <input type="text" class="form-control" name="q" placeholder="Search for jobs, keywords, companies...">
                      </div>
                    </div>
                    <div class="col-md-2">
                      <button type="submit" class="btn bg-gradient-primary w-100">Search</button>
                    </div>
                  </div>
                </form>
              </div>
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
          <h5 class="mt-3 mb-0">Find Jobs</h5>
          <p>Search and apply for jobs that match your skills and experience.</p>
          <a href="<?= base_url('lowongan') ?>" class="btn btn-outline-primary mt-3">Browse Jobs</a>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card move-on-hover">
        <div class="card-body text-center">
          <div class="icon icon-shape icon-lg bg-gradient-success shadow text-center border-radius-lg">
            <i class="fas fa-user-plus opacity-10"></i>
          </div>
          <h5 class="mt-3 mb-0">Create Profile</h5>
          <p>Build your professional profile to showcase your skills to employers.</p>
          <a href="<?= base_url('auth/register') ?>" class="btn btn-outline-primary mt-3">Sign Up</a>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card move-on-hover">
        <div class="card-body text-center">
          <div class="icon icon-shape icon-lg bg-gradient-warning shadow text-center border-radius-lg">
            <i class="fas fa-chart-line opacity-10"></i>
          </div>
          <h5 class="mt-3 mb-0">Track Progress</h5>
          <p>Monitor your application status and get updates on your job applications.</p>
          <a href="<?= base_url('auth') ?>" class="btn btn-outline-primary mt-3">Sign In</a>
        </div>
      </div>
    </div>
  </div>

  <div class="row mt-5">
    <div class="col-12">
      <div class="card card-body border-0 shadow-xl mt-n5">
        <h3 class="text-center">Featured Job Opportunities</h3>
        <p class="text-center">Explore our latest job openings</p>

        <div class="row mt-4">
          <?php if (empty($featured_jobs)) : ?>
            <div class="col-12 text-center">
              <p>No featured jobs available at the moment. Please check back later.</p>
            </div>
          <?php else : ?>
            <?php foreach ($featured_jobs as $job) : ?>
              <div class="col-md-4 mb-4">
                <div class="card h-100">
                  <div class="card-header p-0 mx-3 mt-3 position-relative z-index-1">
                    <div class="d-block blur-shadow-image">
                      <img src="<?= base_url('assets/img/company-logo.jpg') ?>" alt="img-blur-shadow" class="img-fluid shadow border-radius-lg">
                    </div>
                    <div class="colored-shadow" style="background-image: url('<?= base_url('assets/img/company-logo.jpg') ?>');"></div>
                  </div>
                  <div class="card-body pt-3">
                    <span class="badge bg-gradient-<?= $job->jenis_pekerjaan == 'full-time' ? 'success' : ($job->jenis_pekerjaan == 'part-time' ? 'info' : ($job->jenis_pekerjaan == 'contract' ? 'warning' : 'secondary')) ?> mb-2"><?= ucfirst(str_replace('-', ' ', $job->jenis_pekerjaan)) ?></span>
                    <h5><?= $job->judul ?></h5>
                    <p class="mb-0 text-sm"><i class="fas fa-map-marker-alt me-1"></i> <?= $job->lokasi ?></p>
                    <p class="mb-0 text-sm"><i class="fas fa-tag me-1"></i> <?= $job->category_name ?></p>
                    <p class="mb-0 text-sm"><i class="fas fa-calendar me-1"></i> Deadline: <?= date('d M Y', strtotime($job->batas_waktu)) ?></p>
                    <div class="d-flex align-items-center mt-3">
                      <a href="<?= base_url('home/job_details/' . $job->id) ?>" class="btn btn-outline-primary btn-sm mb-0">View Details</a>
                      <a href="<?= base_url('pelamar/lamar/' . $job->id) ?>" class="btn btn-primary btn-sm ms-auto mb-0">Apply Now</a>
                    </div>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
          <?php endif; ?>
        </div>

        <div class="text-center mt-4">
          <a href="<?= base_url('home/jobs') ?>" class="btn bg-gradient-primary">View All Jobs</a>
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
                  <h6 class="mb-0"><?= $post->title ?></h6>
                  <p class="text-sm mb-0"><i class="fas fa-user me-1"></i> <?= $post->author_name ?></p>
                  <p class="text-sm mb-0"><i class="fas fa-calendar me-1"></i> <?= date('d M Y', strtotime($post->created_at)) ?></p>
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
            <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">Why Choose Us</h4>
          </div>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <div class="info">
                <div class="icon icon-sm">
                  <i class="fas fa-search text-primary"></i>
                </div>
                <h5 class="font-weight-bolder mt-3">Smart Job Matching</h5>
                <p>Our AI-powered system matches your skills with the right opportunities.</p>
              </div>
            </div>
            <div class="col-md-6">
              <div class="info">
                <div class="icon icon-sm">
                  <i class="fas fa-user-shield text-primary"></i>
                </div>
                <h5 class="font-weight-bolder mt-3">Secure Applications</h5>
                <p>Your data and applications are protected with enterprise-grade security.</p>
              </div>
            </div>
          </div>
          <div class="row mt-4">
            <div class="col-md-6">
              <div class="info">
                <div class="icon icon-sm">
                  <i class="fas fa-chart-line text-primary"></i>
                </div>
                <h5 class="font-weight-bolder mt-3">Real-time Updates</h5>
                <p>Get instant notifications about your application status.</p>
              </div>
            </div>
            <div class="col-md-6">
              <div class="info">
                <div class="icon icon-sm">
                  <i class="fas fa-laptop text-primary"></i>
                </div>
                <h5 class="font-weight-bolder mt-3">Online Assessments</h5>
                <p>Showcase your skills through our integrated assessment platform.</p>
              </div>
            </div>
          </div>

          <div class="text-center mt-4">
            <a href="<?= base_url('home/about') ?>" class="btn btn-outline-primary btn-sm mb-0">Learn More</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
