                </div>
                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                  <?php if ($title == 'Login') : ?>
                    <p class="mb-4 text-sm mx-auto">
                      Belum memiliki akun?
                      <a href="<?= base_url('auth/daftar') ?>" class="text-success text-gradient font-weight-bold">Daftar Sekarang</a>
                    </p>
                    <p class="mb-0 text-sm mx-auto">
                      <a href="<?= base_url('auth/lupa_password') ?>" class="text-success text-gradient font-weight-bold">Lupa Password?</a>
                    </p>
                  <?php elseif ($title == 'Daftar') : ?>
                    <p class="mb-4 text-sm mx-auto">
                      Sudah memiliki akun?
                      <a href="<?= base_url('auth') ?>" class="text-success text-gradient font-weight-bold">Masuk</a>
                    </p>
                  <?php elseif ($title == 'Lupa Password') : ?>
                    <p class="mb-0 text-sm mx-auto">
                      <a href="<?= base_url('auth') ?>" class="text-success text-gradient font-weight-bold">Kembali ke Login</a>
                    </p>
                  <?php elseif ($title == 'Reset Password') : ?>
                    <p class="mb-0 text-sm mx-auto">
                      <a href="<?= base_url('auth') ?>" class="text-success text-gradient font-weight-bold">Kembali ke Login</a>
                    </p>
                  <?php endif; ?>
                </div>
              </div>
            </div>
            <div class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 end-0 text-center justify-content-center flex-column">
              <div class="position-relative bg-gradient-success h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center overflow-hidden" style="background-image: url('<?= base_url('assets/img/gallery-auth-side-bg.jpg') ?>'); background-size: cover;">
                <span class="mask bg-gradient-success opacity-6"></span>
                <div class="position-relative">
                  <i class="fas fa-leaf text-warning fa-3x mb-3"></i>
                  <h4 class="text-white font-weight-bolder">Gallery Kembang Ilung</h4>
                  <p class="text-white mb-4">Destinasi seni kerajinan tradisional yang melestarikan warisan budaya Indonesia melalui anyaman eceng gondok berkualitas tinggi.</p>
                  <div class="d-flex justify-content-center">
                    <div class="text-center mx-2">
                      <i class="fas fa-hands text-warning fa-lg mb-1"></i>
                      <p class="text-white text-xs mb-0">Kerajinan Tangan</p>
                    </div>
                    <div class="text-center mx-2">
                      <i class="fas fa-heart text-warning fa-lg mb-1"></i>
                      <p class="text-white text-xs mb-0">Warisan Budaya</p>
                    </div>
                    <div class="text-center mx-2">
                      <i class="fas fa-award text-warning fa-lg mb-1"></i>
                      <p class="text-white text-xs mb-0">Kualitas Terjamin</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

  <!--   Core JS Files   -->
  <script src="<?= base_url('assets/js/core/popper.min.js') ?>"></script>
  <script src="<?= base_url('assets/js/core/bootstrap.min.js') ?>"></script>
  <script src="<?= base_url('assets/js/plugins/perfect-scrollbar.min.js') ?>"></script>
  <script src="<?= base_url('assets/js/plugins/smooth-scrollbar.min.js') ?>"></script>

  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>

  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="<?= base_url('assets/js/argon-dashboard.min.js?v=2.1.0') ?>"></script>

  <!-- SweetAlert2 JS -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.all.min.js"></script>

  <!-- Custom JS -->
  <script src="<?= base_url('assets/js/custom.js') ?>"></script>

  <!-- SweetAlert2 Initialization -->
  <script src="<?= base_url('assets/js/sweetalert-init.js') ?>"></script>
</body>

</html>
