<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header pb-0">
        <div class="d-flex align-items-center">
          <div class="icon icon-shape icon-sm bg-gradient-primary shadow text-center border-radius-md me-3">
            <i class="ni ni-bell-55 text-white opacity-10"></i>
          </div>
          <div>
            <h6 class="mb-0">Manajemen Notifikasi</h6>
            <p class="text-sm mb-0">Kelola dan pantau semua notifikasi sistem</p>
          </div>
        </div>
        <div class="ms-auto">
          <a href="<?= base_url('admin/buat_notifikasi') ?>" class="btn btn-primary btn-sm">
            <i class="ni ni-fat-add"></i> Buat Notifikasi
          </a>
        </div>
      </div>
      <div class="card-body">
        
        <!-- Notification Statistics -->
        <div class="row mb-4">
          <div class="col-lg-3 col-md-6 mb-3">
            <div class="card bg-gradient-primary">
              <div class="card-body p-3">
                <div class="row">
                  <div class="col-8">
                    <div class="numbers">
                      <p class="text-white text-sm mb-0 text-capitalize font-weight-bold">Total</p>
                      <h5 class="text-white font-weight-bolder mb-0"><?= $stats['total'] ?></h5>
                    </div>
                  </div>
                  <div class="col-4 text-end">
                    <div class="icon icon-shape bg-white shadow text-center border-radius-md">
                      <i class="ni ni-collection text-dark text-lg opacity-10"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
          <div class="col-lg-3 col-md-6 mb-3">
            <div class="card bg-gradient-warning">
              <div class="card-body p-3">
                <div class="row">
                  <div class="col-8">
                    <div class="numbers">
                      <p class="text-white text-sm mb-0 text-capitalize font-weight-bold">Belum Dibaca</p>
                      <h5 class="text-white font-weight-bolder mb-0"><?= $stats['belum_dibaca'] ?></h5>
                    </div>
                  </div>
                  <div class="col-4 text-end">
                    <div class="icon icon-shape bg-white shadow text-center border-radius-md">
                      <i class="ni ni-bell-55 text-dark text-lg opacity-10"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
          <div class="col-lg-3 col-md-6 mb-3">
            <div class="card bg-gradient-success">
              <div class="card-body p-3">
                <div class="row">
                  <div class="col-8">
                    <div class="numbers">
                      <p class="text-white text-sm mb-0 text-capitalize font-weight-bold">Dibaca</p>
                      <h5 class="text-white font-weight-bolder mb-0"><?= $stats['dibaca'] ?></h5>
                    </div>
                  </div>
                  <div class="col-4 text-end">
                    <div class="icon icon-shape bg-white shadow text-center border-radius-md">
                      <i class="ni ni-check-bold text-dark text-lg opacity-10"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
          <div class="col-lg-3 col-md-6 mb-3">
            <div class="card bg-gradient-info">
              <div class="card-body p-3">
                <div class="row">
                  <div class="col-8">
                    <div class="numbers">
                      <p class="text-white text-sm mb-0 text-capitalize font-weight-bold">Diarsipkan</p>
                      <h5 class="text-white font-weight-bolder mb-0"><?= $stats['diarsipkan'] ?></h5>
                    </div>
                  </div>
                  <div class="col-4 text-end">
                    <div class="icon icon-shape bg-white shadow text-center border-radius-md">
                      <i class="ni ni-archive-2 text-dark text-lg opacity-10"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Filter and Actions -->
        <div class="row mb-3">
          <div class="col-md-6">
            <div class="btn-group" role="group">
              <a href="<?= base_url('admin/notifikasi') ?>" class="btn btn-outline-primary btn-sm <?= empty($status_filter) ? 'active' : '' ?>">
                Semua
              </a>
              <a href="<?= base_url('admin/notifikasi?status=belum_dibaca') ?>" class="btn btn-outline-warning btn-sm <?= $status_filter == 'belum_dibaca' ? 'active' : '' ?>">
                Belum Dibaca
              </a>
              <a href="<?= base_url('admin/notifikasi?status=dibaca') ?>" class="btn btn-outline-success btn-sm <?= $status_filter == 'dibaca' ? 'active' : '' ?>">
                Dibaca
              </a>
              <a href="<?= base_url('admin/notifikasi?status=diarsipkan') ?>" class="btn btn-outline-info btn-sm <?= $status_filter == 'diarsipkan' ? 'active' : '' ?>">
                Diarsipkan
              </a>
            </div>
          </div>
          <div class="col-md-6 text-end">
            <button type="button" class="btn btn-success btn-sm" onclick="markAllAsRead()">
              <i class="ni ni-check-bold"></i> Tandai Semua Dibaca
            </button>
          </div>
        </div>

        <!-- Notifications List -->
        <div class="table-responsive">
          <table class="table align-items-center mb-0">
            <thead>
              <tr>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Notifikasi</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Jenis</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Prioritas</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal</th>
                <th class="text-secondary opacity-7">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php if (!empty($notifications)): ?>
                <?php foreach ($notifications as $notification): ?>
                  <tr class="<?= $notification->status == 'belum_dibaca' ? 'bg-light' : '' ?>">
                    <td>
                      <div class="d-flex px-2 py-1">
                        <div>
                          <div class="icon icon-shape icon-sm bg-gradient-<?= $notification->warna ?> shadow text-center border-radius-md me-3">
                            <i class="<?= $notification->icon ?> text-white opacity-10"></i>
                          </div>
                        </div>
                        <div class="d-flex flex-column justify-content-center">
                          <h6 class="mb-0 text-sm <?= $notification->status == 'belum_dibaca' ? 'font-weight-bold' : '' ?>">
                            <?= htmlspecialchars($notification->judul) ?>
                          </h6>
                          <p class="text-xs text-secondary mb-0">
                            <?= character_limiter(htmlspecialchars($notification->pesan), 80) ?>
                          </p>
                          <?php if ($notification->dibuat_oleh_nama): ?>
                            <p class="text-xs text-secondary mb-0">
                              <i class="ni ni-single-02"></i> <?= htmlspecialchars($notification->dibuat_oleh_nama) ?>
                            </p>
                          <?php endif; ?>
                        </div>
                      </div>
                    </td>
                    <td>
                      <span class="badge badge-sm bg-gradient-<?= $notification->warna ?>">
                        <?= ucfirst(str_replace('_', ' ', $notification->jenis)) ?>
                      </span>
                    </td>
                    <td class="align-middle text-center text-sm">
                      <?php
                        $priority_colors = [
                          'rendah' => 'secondary',
                          'normal' => 'primary',
                          'tinggi' => 'warning',
                          'urgent' => 'danger'
                        ];
                        $priority_color = isset($priority_colors[$notification->prioritas]) ? $priority_colors[$notification->prioritas] : 'primary';
                      ?>
                      <span class="badge badge-sm bg-gradient-<?= $priority_color ?>">
                        <?= ucfirst($notification->prioritas) ?>
                      </span>
                    </td>
                    <td class="align-middle text-center">
                      <?php if ($notification->status == 'belum_dibaca'): ?>
                        <span class="badge badge-sm bg-gradient-warning">Belum Dibaca</span>
                      <?php elseif ($notification->status == 'dibaca'): ?>
                        <span class="badge badge-sm bg-gradient-success">Dibaca</span>
                      <?php else: ?>
                        <span class="badge badge-sm bg-gradient-info">Diarsipkan</span>
                      <?php endif; ?>
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold">
                        <?= date('d/m/Y H:i', strtotime($notification->dibuat_pada)) ?>
                      </span>
                      <?php if ($notification->dibaca_pada): ?>
                        <br><small class="text-success">Dibaca: <?= date('d/m/Y H:i', strtotime($notification->dibaca_pada)) ?></small>
                      <?php endif; ?>
                    </td>
                    <td class="align-middle">
                      <div class="btn-group" role="group">
                        <?php if ($notification->url_aksi): ?>
                          <a href="<?= base_url($notification->url_aksi) ?>" class="btn btn-link text-primary text-gradient px-2 mb-0" title="Buka">
                            <i class="ni ni-bold-right text-xs"></i>
                          </a>
                        <?php endif; ?>
                        
                        <?php if ($notification->status == 'belum_dibaca'): ?>
                          <button type="button" class="btn btn-link text-success text-gradient px-2 mb-0" onclick="markAsRead(<?= $notification->id ?>)" title="Tandai Dibaca">
                            <i class="ni ni-check-bold text-xs"></i>
                          </button>
                        <?php endif; ?>
                        
                        <button type="button" class="btn btn-link text-danger text-gradient px-2 mb-0" onclick="deleteNotification(<?= $notification->id ?>)" title="Hapus">
                          <i class="ni ni-fat-remove text-xs"></i>
                        </button>
                      </div>
                    </td>
                  </tr>
                <?php endforeach; ?>
              <?php else: ?>
                <tr>
                  <td colspan="6" class="text-center py-4">
                    <div class="text-center">
                      <i class="ni ni-bell-55 text-muted" style="font-size: 3rem;"></i>
                      <h6 class="text-muted mt-2">Tidak ada notifikasi</h6>
                      <p class="text-sm text-muted">Belum ada notifikasi yang tersedia saat ini.</p>
                    </div>
                  </td>
                </tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>

        <!-- Pagination -->
        <?php if ($total_pages > 1): ?>
          <div class="d-flex justify-content-center mt-4">
            <nav aria-label="Pagination">
              <ul class="pagination">
                <?php if ($current_page > 1): ?>
                  <li class="page-item">
                    <a class="page-link" href="<?= base_url('admin/notifikasi?page=' . ($current_page - 1) . ($status_filter ? '&status=' . $status_filter : '')) ?>">
                      <i class="ni ni-bold-left"></i>
                    </a>
                  </li>
                <?php endif; ?>
                
                <?php for ($i = max(1, $current_page - 2); $i <= min($total_pages, $current_page + 2); $i++): ?>
                  <li class="page-item <?= $i == $current_page ? 'active' : '' ?>">
                    <a class="page-link" href="<?= base_url('admin/notifikasi?page=' . $i . ($status_filter ? '&status=' . $status_filter : '')) ?>">
                      <?= $i ?>
                    </a>
                  </li>
                <?php endfor; ?>
                
                <?php if ($current_page < $total_pages): ?>
                  <li class="page-item">
                    <a class="page-link" href="<?= base_url('admin/notifikasi?page=' . ($current_page + 1) . ($status_filter ? '&status=' . $status_filter : '')) ?>">
                      <i class="ni ni-bold-right"></i>
                    </a>
                  </li>
                <?php endif; ?>
              </ul>
            </nav>
          </div>
        <?php endif; ?>

      </div>
    </div>
  </div>
</div>

<script>

function markAsRead(notificationId) {
  fetch('<?= base_url("admin/tandai_dibaca_notifikasi/") ?>' + notificationId, {
    method: 'POST',
    headers: {
      'X-Requested-With': 'XMLHttpRequest',
      'Content-Type': 'application/json'
    }
  })
  .then(response => response.json())
  .then(data => {
    if (data.success) {
      location.reload();
    } else {
      alert('Gagal menandai notifikasi sebagai dibaca');
    }
  })
  .catch(error => {
    console.error('Error:', error);
    alert('Terjadi kesalahan');
  });
}


function markAllAsRead() {
  if (confirm('Tandai semua notifikasi sebagai dibaca?')) {
    fetch('<?= base_url("admin/tandai_semua_dibaca_notifikasi") ?>', {
      method: 'POST',
      headers: {
        'X-Requested-With': 'XMLHttpRequest',
        'Content-Type': 'application/json'
      }
    })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        location.reload();
      } else {
        alert('Gagal menandai semua notifikasi sebagai dibaca');
      }
    })
    .catch(error => {
      console.error('Error:', error);
      alert('Terjadi kesalahan');
    });
  }
}


function deleteNotification(notificationId) {
  if (confirm('Hapus notifikasi ini?')) {
    fetch('<?= base_url("admin/hapus_notifikasi/") ?>' + notificationId, {
      method: 'POST',
      headers: {
        'X-Requested-With': 'XMLHttpRequest',
        'Content-Type': 'application/json'
      }
    })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        location.reload();
      } else {
        alert('Gagal menghapus notifikasi');
      }
    })
    .catch(error => {
      console.error('Error:', error);
      alert('Terjadi kesalahan');
    });
  }
}
</script>
