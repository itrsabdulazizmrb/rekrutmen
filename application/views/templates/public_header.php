<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="<?= base_url('assets/img/apple-icon.png') ?>">
  <link rel="icon" type="image/png" href="<?= base_url('assets/img/gallery-logo.png') ?>">
  <title>
    <?= $title ?> - Rekrutmen RSUD H. Abdul Aziz Marabahan
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- CSS Files -->
  <link id="pagestyle" href="<?= base_url('assets/css/argon-dashboard.css?v=2.1.0') ?>" rel="stylesheet" />
  <!-- SweetAlert2 CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.min.css">
  <!-- Custom CSS -->
  <link href="<?= base_url('assets/css/custom.css') ?>" rel="stylesheet" />
</head>

<body class="g-sidenav-show bg-gray-100">
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg position-absolute top-0 z-index-3 w-100 shadow-none my-3 navbar-transparent mt-4">
    <div class="container">
      <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 text-white" href="<?= base_url() ?>">
        Rekrutmen RSUD H. Abdul Aziz Marabahan 
      </a>
      <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon mt-2">
          <span class="navbar-toggler-bar bar1"></span>
          <span class="navbar-toggler-bar bar2"></span>
          <span class="navbar-toggler-bar bar3"></span>
        </span>
      </button>
      <div class="collapse navbar-collapse" id="navigation">
        <ul class="navbar-nav mx-auto">
          <!-- <li class="nav-item">
            <a class="nav-link d-flex align-items-center me-2 <?= $this->uri->segment(2) == '' ? 'active' : '' ?>" href="<?= base_url() ?>">
              <i class="fa fa-home opacity-6 text-white me-1"></i>
              Beranda
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link me-2 <?= $this->uri->segment(2) == 'lowongan' ? 'active' : '' ?>" href="<?= base_url('lowongan') ?>">
              <i class="fa fa-briefcase opacity-6 text-white me-1"></i>
              Lowongan
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link me-2 <?= $this->uri->segment(2) == 'blog' ? 'active' : '' ?>" href="<?= base_url('blog') ?>">
              <i class="fa fa-newspaper opacity-6 text-white me-1"></i>
              Artikel
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link me-2 <?= $this->uri->segment(2) == 'tentang' ? 'active' : '' ?>" href="<?= base_url('tentang') ?>">
              <i class="fa fa-info-circle opacity-6 text-white me-1"></i>
              Tentang Kami
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link me-2 <?= $this->uri->segment(2) == 'kontak' ? 'active' : '' ?>" href="<?= base_url('kontak') ?>">
              <i class="fa fa-envelope opacity-6 text-white me-1"></i>
              Kontak
            </a>
          </li> -->
        </ul>
        <ul class="navbar-nav d-lg-block d-none">
          <?php if ($this->session->userdata('logged_in')) : ?>
            <li class="nav-item">
              <a href="<?= $this->session->userdata('role') == 'pelamar' ? base_url('pelamar/dasbor') : base_url('admin/dasbor') ?>" class="btn btn-sm mb-0 me-1 bg-gradient-light">Dasbor</a>
            </li>
          <?php else : ?>
            <li class="nav-item">
              <a href="<?= base_url('auth') ?>" class="btn btn-sm mb-0 me-1 bg-gradient-light">Login</a>
              <a href="<?= base_url('auth/daftar') ?>" class="btn btn-sm mb-0 me-1 bg-gradient-primary">Daftar</a>
            </li>
          <?php endif; ?>
        </ul>
      </div>
    </div>
  </nav>
  <!-- End Navbar -->

  <main class="main-content mt-0">
    <?php if ($this->session->flashdata('success')) : ?>
      <div class="alert alert-success alert-dismissible fade show position-fixed top-0 end-0 m-3 d-none" role="alert" style="z-index: 9999;">
        <?= $this->session->flashdata('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    <?php endif; ?>

    <?php if ($this->session->flashdata('error')) : ?>
      <div class="alert alert-danger alert-dismissible fade show position-fixed top-0 end-0 m-3 d-none" role="alert" style="z-index: 9999;">
        <?= $this->session->flashdata('error') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    <?php endif; ?>
