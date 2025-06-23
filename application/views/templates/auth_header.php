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

<body>
  <main class="main-content mt-0">
    <section>
      <div class="page-header min-vh-100">
        <div class="container">
          <div class="row">
            <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column mx-lg-0 mx-auto">
              <div class="card card-plain">
                <div class="card-header pb-0 text-start">
                  <h4 class="font-weight-bolder"><?= $title ?></h4>
                  <p class="mb-0">
                    <?php if ($title == 'Login') : ?>
                      Masuk ke akun SIREK RSHAA anda
                    <?php elseif ($title == 'Daftar') : ?>
                      Daftar akun SIREK RSHAA
                    <?php elseif ($title == 'Lupa Password') : ?>
                      Masukkan email Anda untuk reset password
                    <?php elseif ($title == 'Reset Password') : ?>
                      Masukkan password baru Anda
                    <?php endif; ?>
                  </p>
                </div>
                <div class="card-body">
                  <?php if ($this->session->flashdata('success')) : ?>
                    <div class="alert alert-success alert-dismissible fade show d-none" role="alert">
                      <?= $this->session->flashdata('success') ?>
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                  <?php endif; ?>

                  <?php if ($this->session->flashdata('error')) : ?>
                    <div class="alert alert-danger alert-dismissible fade show d-none" role="alert">
                      <?= $this->session->flashdata('error') ?>
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                  <?php endif; ?>

                  <?php if (validation_errors()) : ?>
                    <div class="alert alert-danger alert-dismissible fade show d-none" role="alert">
                      <?= validation_errors() ?>
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <script>
                      document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                          icon: 'error',
                          title: 'Validasi Error',
                          html: '<?= str_replace(array("\r", "\n"), '', addslashes(validation_errors())) ?>',
                          confirmButtonText: 'OK'
                        });
                      });
                    </script>
                  <?php endif; ?>
