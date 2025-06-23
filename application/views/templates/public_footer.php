    <footer class="footer py-5">
      <div class="container">
        <div class="row">
          <!-- About Section -->
          <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
            <h6 class="text-uppercase mb-4">Gallery Kembang Ilung</h6>
            <p class="mb-4">Galeri seni yang menampilkan karya-karya terbaik dari seniman lokal dan internasional. Kami berkomitmen untuk mempromosikan seni dan budaya.</p>
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
            <h6 class="text-uppercase mb-4">Menu Utama</h6>
            <ul class="footer-links list-unstyled">
              <li class="mb-2"><a href="<?= base_url() ?>" class="text-decoration-none">Beranda</a></li>
              <li class="mb-2"><a href="<?= base_url('gallery') ?>" class="text-decoration-none">Galeri</a></li>
              <li class="mb-2"><a href="<?= base_url('exhibitions') ?>" class="text-decoration-none">Pameran</a></li>
              <li class="mb-2"><a href="<?= base_url('artists') ?>" class="text-decoration-none">Seniman</a></li>
              <li class="mb-2"><a href="<?= base_url('about') ?>" class="text-decoration-none">Tentang Kami</a></li>
            </ul>
          </div>

          <!-- Services -->
          <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
            <h6 class="text-uppercase mb-4">Layanan</h6>
            <ul class="footer-links list-unstyled">
              <li class="mb-2"><a href="<?= base_url('collections') ?>" class="text-decoration-none">Koleksi Seni</a></li>
              <li class="mb-2"><a href="<?= base_url('events') ?>" class="text-decoration-none">Acara & Workshop</a></li>
              <li class="mb-2"><a href="<?= base_url('rental') ?>" class="text-decoration-none">Sewa Ruang</a></li>
              <li class="mb-2"><a href="<?= base_url('consultation') ?>" class="text-decoration-none">Konsultasi Seni</a></li>
              <li class="mb-2"><a href="<?= base_url('contact') ?>" class="text-decoration-none">Hubungi Kami</a></li>
            </ul>
          </div>

          <!-- Contact Info -->
          <div class="col-lg-3 col-md-6">
            <h6 class="text-uppercase mb-4">Kontak</h6>
            <ul class="footer-links list-unstyled">
              <li class="mb-2">
                <i class="fas fa-map-marker-alt me-2 text-primary"></i>
                <span>Desa Banyu Hirang, Kecamatan Amuntai Selatan, Kabupaten Hulu Sungai Tengah, Kalimantan Selatan</span>
              </li>
              <li class="mb-2">
                <i class="fas fa-phone me-2 text-primary"></i>
                <span>+62 21 1234 5678</span>
              </li>
              <li class="mb-2">
                <i class="fas fa-envelope me-2 text-primary"></i>
                <span>info@gallerykembangilung.com</span>
              </li>
              <li class="mb-2">
                <i class="fas fa-clock me-2 text-primary"></i>
                <span>Senin - Minggu: 08:00 - 17:00</span>
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
                © <script>document.write(new Date().getFullYear())</script> Radina. All rights reserved.
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
