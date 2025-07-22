    <footer class="footer py-5">
      <div class="container">
        <div class="row">
          <!-- About Section -->
          <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
            <h6 class="text-uppercase mb-4">Rekrutmen RSUD H. Abdul Aziz Marabahan</h6>
            <p class="mb-4">Sistem rekrutmen online untuk menjaring tenaga profesional yang berintegritas dan kompeten untuk bergabung bersama kami.</p>
            <div class="social-icons">
              <a href="#" class="btn btn-icon-only btn-pill btn-facebook me-2" type="button" aria-label="Facebook">
                <span class="btn-inner--icon"><i class="fab fa-facebook"></i></span>
              </a>
              <a href="#" class="btn btn-icon-only btn-pill btn-twitter me-2" type="button" aria-label="Twitter">
                <span class="btn-inner--icon"><i class="fab fa-twitter"></i></span>
              </a>
              <a href="#" class="btn btn-icon-only btn-pill btn-instagram me-2" type="button" aria-label="Instagram">
                <span class="btn-inner--icon"><i class="fab fa-instagram"></i></span>
              </a>
              <a href="#" class="btn btn-icon-only btn-pill btn-linkedin" type="button" aria-label="LinkedIn">
                <span class="btn-inner--icon"><i class="fab fa-linkedin"></i></span>
              </a>
            </div>
          </div>

          <!-- Quick Links -->
          <div class="col-lg-2 col-md-6 mb-4 mb-lg-0">
            <h6 class="text-uppercase mb-4">Tautan Cepat</h6>
            <ul class="footer-links list-unstyled">
              <li class="mb-2"><a href="<?= base_url() ?>" class="text-decoration-none">Beranda</a></li>
              <li class="mb-2"><a href="<?= base_url('lowongan') ?>" class="text-decoration-none">Lowongan</a></li>
              <li class="mb-2"><a href="<?= base_url('blog') ?>" class="text-decoration-none">Blog</a></li>
              <li class="mb-2"><a href="<?= base_url('tentang') ?>" class="text-decoration-none">Tentang Kami</a></li>
              <li class="mb-2"><a href="<?= base_url('kontak') ?>" class="text-decoration-none">Kontak</a></li>
            </ul>
          </div>

          <!-- Services -->
          <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
            <h6 class="text-uppercase mb-4">Informasi</h6>
            <ul class="footer-links list-unstyled">
              <li class="mb-2"><a href="#" class="text-decoration-none">Proses Rekrutmen</a></li>
              <li class="mb-2"><a href="#" class="text-decoration-none">Pertanyaan Umum (FAQ)</a></li>
              <li class="mb-2"><a href="#" class="text-decoration-none">Kebijakan Privasi</a></li>
              <li class="mb-2"><a href="#" class="text-decoration-none">Syarat & Ketentuan</a></li>
            </ul>
          </div>

          <!-- Contact Info -->
          <div class="col-lg-3 col-md-6">
            <h6 class="text-uppercase mb-4">Kontak</h6>
            <ul class="footer-links list-unstyled">
              <li class="mb-2">
                <i class="fas fa-map-marker-alt me-2 text-primary"></i>
                <span>Jl. Jenderal Sudirman No. 1, Marabahan, Kalimantan Selatan</span>
              </li>
              <li class="mb-2">
                <i class="fas fa-phone me-2 text-primary"></i>
                <span>(0511) 123-456</span>
              </li>
              <li class="mb-2">
                <i class="fas fa-envelope me-2 text-primary"></i>
                <span>rekrutmen@rsud-marabahan.go.id</span>
              </li>
              <li class="mb-2">
                <i class="fas fa-clock me-2 text-primary"></i>
                <span>Senin - Jumat: 08:00 - 16:00 WITA</span>
              </li>
            </ul>
          </div>
        </div>

        <!-- Copyright Section -->
        <hr class="horizontal dark mt-5 mb-4">
        <div class="row">
          <div class="col-12">
            <div class="text-center">
              <p class="mb-0 text-muted">
                © <script>document.write(new Date().getFullYear())</script> RSUD H. Abdul Aziz Marabahan. All rights reserved.
              </p>
            </div>
          </div>
        </div>
      </div>
    </footer>
  </main>

  <!--   Core JS Files   -->
  <script src="<?= base_url('assets/js/core/popper.min.js') ?>"></script>
  <script src="<?= base_url('assets/js/core/bootstrap.min.js') ?>"></script>
  <script src="<?= base_url('assets/js/plugins/perfect-scrollbar.min.js') ?>"></script>
  <script src="<?= base_url('assets/js/plugins/smooth-scrollbar.min.js') ?>"></script>

  <!-- Custom scripts -->
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }

    // Add base URL for JavaScript
    var baseUrl = '<?= base_url() ?>';
  </script>

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
