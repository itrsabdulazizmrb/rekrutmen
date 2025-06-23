      <footer class="footer pt-3">
        <div class="container-fluid">
          <div class="row align-items-center justify-content-lg-between">
            <div class="col-lg-6 mb-lg-0 mb-4">
              <div class="copyright text-center text-sm text-muted text-lg-start">
                © <script>
                  document.write(new Date().getFullYear())
                </script>,
                dibuat dengan<i class="fa fa-heart"></i> oleh
                <a href="javascript:;" class="font-weight-bold">Radina</a>
              </div>
            </div>
            <div class="col-lg-6">
              <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                <li class="nav-item">
                  <a href="<?= base_url() ?>" class="nav-link text-muted">Home</a>
                </li>
                <li class="nav-item">
                  <a href="<?= base_url('home/tentang') ?>" class="nav-link text-muted">About Us</a>
                </li>
                <li class="nav-item">
                  <a href="<?= base_url('home/blog') ?>" class="nav-link text-muted">Blog</a>
                </li>
                <li class="nav-item">
                  <a href="<?= base_url('home/kontak') ?>" class="nav-link pe-0 text-muted">Contact</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </main>

  <!--   Core JS Files   -->
  <script src="<?= base_url('assets/js/core/popper.min.js') ?>"></script>
  <script src="<?= base_url('assets/js/core/bootstrap.min.js') ?>"></script>
  <script src="<?= base_url('assets/js/plugins/perfect-scrollbar.min.js') ?>"></script>
  <script src="<?= base_url('assets/js/plugins/smooth-scrollbar.min.js') ?>"></script>
  <script src="<?= base_url('assets/js/plugins/chartjs.min.js') ?>"></script>

  <!-- Custom scripts -->
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
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
