<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="<?= base_url('assets/img/apple-icon.png') ?>">
  <link rel="icon" type="image/png" href="<?= base_url('assets/img/gallery-logo.png') ?>">
  <title>
    <?= $title ?> - Gallery Kembang Ilung Admin
  </title>
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-svg.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
  <link id="pagestyle" href="<?= base_url('assets/css/argon-dashboard.css?v=2.1.0') ?>" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap5.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.min.css">
  <link href="<?= base_url('assets/css/custom.css') ?>" rel="stylesheet" />
</head>

<body class="g-sidenav-show bg-gray-100">
  <div class="min-height-300 bg-gradient-dark position-absolute w-100"></div>
  <aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href="<?= base_url('beranda/index') ?>">
        <img src="<?= base_url('assets/img/gallery-logo.png') ?>" class="navbar-brand-img h-100" alt="gallery_logo">
        <span class="ms-1 font-weight-bold text-dark">Gallery Kembang Ilung</span>
      </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link <?= $this->uri->segment(2) == 'dasbor' ? 'active' : '' ?>" href="<?= base_url('admin/dasbor') ?>">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-tv-2 text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Dasbor</span>
          </a>
        </li>


       
        
        <?php if (in_array($this->session->userdata('role'), ['admin', 'hrd', 'staff'])) : ?>
          <li class="nav-item">
          <a class="nav-link <?= $this->uri->segment(2) == 'lowongan' || $this->uri->segment(2) == 'tambahLowongan' || $this->uri->segment(2) == 'edit_lowongan' ? 'active' : '' ?>" href="<?= base_url('admin/lowongan') ?>">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-briefcase-24 text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Manajemen Lowongan</span>
          </a>
        </li>
        <?php endif; ?>
        <?php if (in_array($this->session->userdata('role'), ['admin', 'staff'])) : ?>
        <li class="nav-item">
          <a class="nav-link <?= $this->uri->segment(2) == 'pengguna' ? 'active' : '' ?>" href="<?= base_url('admin/pengguna') ?>">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fas fa-users text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Manajemen Pengguna</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= $this->uri->segment(2) == 'blog' ? 'active' : '' ?>" href="<?= base_url('admin/blog') ?>">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fas fa-newspaper text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Artikel & Blog</span>
          </a>
        </li>
        <?php endif; ?>
         <li class="nav-item">
          <a class="nav-link <?= $this->uri->segment(2) == 'lamaran' || $this->uri->segment(2) == 'detail_lamaran' ? 'active' : '' ?>" href="<?= base_url('admin/lamaran') ?>">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-single-copy-04 text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Lamaran</span>
          </a>
        </li>
        <?php if (in_array($this->session->userdata('role'), ['admin', 'hrd', 'staff'])) : ?>
        <li class="nav-item">
          <a class="nav-link <?= $this->uri->segment(2) == 'penilaian' ? 'active' : '' ?>" href="<?= base_url('admin/penilaian') ?>">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-ruler-pencil text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Penilaian</span>
          </a>
        </li>
        <?php endif; ?>
        <?php if (in_array($this->session->userdata('role'), ['admin','direktur'])) : ?>
        <li class="nav-item">
          <a class="nav-link <?= $this->uri->segment(2) == 'laporan' ? 'active' : '' ?>" href="<?= base_url('admin/laporan') ?>">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-chart-bar-32 text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Laporan</span>
          </a>
        </li>
        <?php endif; ?>
        <!-- <li class="nav-item">
          <a class="nav-link <?= $this->uri->segment(2) == 'kategori' ? 'active' : '' ?>" href="<?= base_url('admin/kategori') ?>">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-tag text-warning text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Kategori Lowongan</span>
          </a>
        </li> -->
        <?php if ($this->session->userdata('role') == 'admin'): ?>
          <!-- aktifkan ketika dibutuhkan tutorial -->
        <!-- <li class="nav-item">
          <a class="nav-link <?= $this->uri->segment(2) == 'tutorial' ? 'active' : '' ?>" href="<?= base_url('admin/tutorial') ?>">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-book-bookmark text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Tutorial & Dokumentasi</span>
          </a>
        </li> -->
        <?php endif; ?>
        <!-- Notifikasi masih pengembangan -->
        <!-- <li class="nav-item">
          <a class="nav-link <?= $this->uri->segment(2) == 'notifikasi' ? 'active' : '' ?>" href="<?= base_url('admin/notifikasi') ?>">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-bell-55 text-primary text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Notifikasi</span>
            <span id="sidebar-notification-badge" class="badge badge-sm bg-gradient-warning ms-auto" style="display: none;">0</span>
          </a>
        </li> -->
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Halaman Akun</h6>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= $this->uri->segment(2) == 'profil' ? 'active' : '' ?>" href="<?= base_url('admin/profil') ?>">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-single-02 text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Profil</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= base_url('auth/logout') ?>">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-button-power text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Keluar</span>
          </a>
        </li>
      </ul>
    </div>
  </aside>
  <main class="main-content position-relative border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="<?= base_url('admin/dasbor') ?>">Admin</a></li>
            <li class="breadcrumb-item text-sm text-white active" aria-current="page"><?= $title ?></li>
          </ol>
          <h6 class="font-weight-bolder text-white mb-0"><?= $title ?></h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
          </div>
          <ul class="navbar-nav  justify-content-end">
            <li class="nav-item d-flex align-items-center">
              <a href="<?= base_url('admin/profil') ?>" class="nav-link text-white font-weight-bold px-0">
                <i class="fa fa-user me-sm-1"></i>
                <span class="d-sm-inline d-none"><?= $this->session->userdata('full_name') ?></span>
              </a>
            </li>
            <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line bg-white"></i>
                  <i class="sidenav-toggler-line bg-white"></i>
                  <i class="sidenav-toggler-line bg-white"></i>
                </div>
              </a>
            </li>
            <li class="nav-item px-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-white p-0">
                <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
              </a>
            </li>
            <li class="nav-item dropdown pe-2 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-white p-0 position-relative" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa fa-bell cursor-pointer"></i>
                <span id="header-notification-badge" class="badge badge-sm bg-gradient-danger position-absolute top-0 start-100 translate-middle rounded-pill" style="display: none;">0</span>
              </a>
              <ul class="dropdown-menu dropdown-menu-end px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton" style="min-width: 350px; max-height: 400px; overflow-y: auto;">
                <li class="dropdown-header d-flex justify-content-between align-items-center">
                  <h6 class="mb-0">Notifikasi</h6>
                  <div>
                    <button type="button" class="btn btn-link text-primary p-0 me-2" onclick="markAllNotificationsAsRead()" title="Tandai semua dibaca">
                      <i class="ni ni-check-bold"></i>
                    </button>
                    <a href="<?= base_url('admin/notifikasi') ?>" class="btn btn-link text-primary p-0" title="Lihat semua">
                      <i class="ni ni-bold-right"></i>
                    </a>
                  </div>
                </li>
                <li><hr class="dropdown-divider"></li>
                <div id="notification-dropdown-content">
                  <li class="text-center py-3">
                    <div class="spinner-border spinner-border-sm text-primary" role="status">
                      <span class="visually-hidden">Loading...</span>
                    </div>
                    <p class="text-sm text-muted mt-2 mb-0">Memuat notifikasi...</p>
                  </li>
                </div>
                <li><hr class="dropdown-divider"></li>
                <li class="text-center">
                  <a href="<?= base_url('admin/notifikasi') ?>" class="btn btn-link text-primary text-sm">
                    Lihat Semua Notifikasi
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid py-4">
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

      <!-- Notification System JavaScript -->
      <script>
        
        let notificationUpdateInterval;
        let lastNotificationCheck = new Date();

        
        document.addEventListener('DOMContentLoaded', function() {
          loadNotifications();
          startNotificationPolling();

          
          document.getElementById('dropdownMenuButton').addEventListener('click', function() {
            loadNotifications();
          });
        });

        
        function loadNotifications() {
          fetch('<?= base_url("admin/api_notifikasi") ?>?limit=5&status=belum_dibaca', {
            method: 'GET',
            headers: {
              'X-Requested-With': 'XMLHttpRequest'
            }
          })
          .then(response => response.json())
          .then(data => {
            if (data.success) {
              updateNotificationDropdown(data.data);
              updateNotificationBadges(data.unread_count);
            }
          })
          .catch(error => {
            console.error('Error loading notifications:', error);
          });
        }

        
        function updateNotificationDropdown(notifications) {
          const container = document.getElementById('notification-dropdown-content');

          if (notifications.length === 0) {
            container.innerHTML = `
              <li class="text-center py-3">
                <i class="ni ni-check-bold text-success" style="font-size: 2rem;"></i>
                <p class="text-sm text-muted mt-2 mb-0">Tidak ada notifikasi baru</p>
              </li>
            `;
            return;
          }

          let html = '';
          notifications.forEach(notification => {
            const timeAgo = getTimeAgo(notification.dibuat_pada);
            const iconClass = notification.icon || 'ni ni-bell-55';
            const colorClass = notification.warna || 'primary';

            html += `
              <li class="mb-2">
                <a class="dropdown-item border-radius-md" href="${notification.url_aksi ? '<?= base_url() ?>' + notification.url_aksi : 'javascript:;'}" onclick="markNotificationAsRead(${notification.id})">
                  <div class="d-flex py-1">
                    <div class="my-auto">
                      <div class="icon icon-shape icon-sm bg-gradient-${colorClass} shadow text-center border-radius-md me-3">
                        <i class="${iconClass} text-white opacity-10"></i>
                      </div>
                    </div>
                    <div class="d-flex flex-column justify-content-center">
                      <h6 class="text-sm font-weight-bold mb-1">
                        ${escapeHtml(notification.judul)}
                      </h6>
                      <p class="text-xs text-secondary mb-0">
                        ${escapeHtml(notification.pesan.substring(0, 80))}${notification.pesan.length > 80 ? '...' : ''}
                      </p>
                      <p class="text-xs text-secondary mb-0">
                        <i class="fa fa-clock me-1"></i>
                        ${timeAgo}
                      </p>
                    </div>
                  </div>
                </a>
              </li>
            `;
          });

          container.innerHTML = html;
        }

        
        function updateNotificationBadges(count) {
          const headerBadge = document.getElementById('header-notification-badge');
          const sidebarBadge = document.getElementById('sidebar-notification-badge');

          if (count > 0) {
            headerBadge.textContent = count > 99 ? '99+' : count;
            headerBadge.style.display = 'block';

            if (sidebarBadge) {
              sidebarBadge.textContent = count > 99 ? '99+' : count;
              sidebarBadge.style.display = 'inline-block';
            }
          } else {
            headerBadge.style.display = 'none';
            if (sidebarBadge) {
              sidebarBadge.style.display = 'none';
            }
          }
        }

        
        function markNotificationAsRead(notificationId) {
          fetch('<?= base_url("admin/tandai_dibaca_notifikasi/") ?>' + notificationId, {
            method: 'POST',
            headers: {
              'X-Requested-With': 'XMLHttpRequest'
            }
          })
          .then(response => response.json())
          .then(data => {
            if (data.success) {
              updateNotificationBadges(data.unread_count);
            }
          })
          .catch(error => {
            console.error('Error marking notification as read:', error);
          });
        }

        
        function markAllNotificationsAsRead() {
          fetch('<?= base_url("admin/tandai_semua_dibaca_notifikasi") ?>', {
            method: 'POST',
            headers: {
              'X-Requested-With': 'XMLHttpRequest'
            }
          })
          .then(response => response.json())
          .then(data => {
            if (data.success) {
              updateNotificationBadges(0);
              loadNotifications(); 
            }
          })
          .catch(error => {
            console.error('Error marking all notifications as read:', error);
          });
        }

        
        function startNotificationPolling() {
          
          notificationUpdateInterval = setInterval(function() {
            loadNotifications();
          }, 30000);
        }

        
        function stopNotificationPolling() {
          if (notificationUpdateInterval) {
            clearInterval(notificationUpdateInterval);
          }
        }

        
        function escapeHtml(text) {
          const map = {
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#039;'
          };
          return text.replace(/[&<>"']/g, function(m) { return map[m]; });
        }

        
        function getTimeAgo(dateString) {
          const now = new Date();
          const date = new Date(dateString);
          const diffInSeconds = Math.floor((now - date) / 1000);

          if (diffInSeconds < 60) {
            return 'Baru saja';
          } else if (diffInSeconds < 3600) {
            const minutes = Math.floor(diffInSeconds / 60);
            return minutes + ' menit yang lalu';
          } else if (diffInSeconds < 86400) {
            const hours = Math.floor(diffInSeconds / 3600);
            return hours + ' jam yang lalu';
          } else {
            const days = Math.floor(diffInSeconds / 86400);
            return days + ' hari yang lalu';
          }
        }

        
        window.addEventListener('beforeunload', function() {
          stopNotificationPolling();
        });
      </script>
