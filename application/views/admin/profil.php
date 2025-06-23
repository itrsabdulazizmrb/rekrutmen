<div class="row">
  <div class="col-md-8">
    <div class="card">
      <div class="card-header pb-0">
        <div class="d-flex align-items-center">
          <p class="mb-0">Profil Saya</p>
          <a href="<?= base_url('admin/edit_pengguna/' . $user->id) ?>" class="btn btn-primary btn-sm ms-auto">Edit Profil</a>
        </div>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label class="form-control-label">Nama Lengkap</label>
              <p class="form-control-static"><?= $user->nama_lengkap ?? 'Tidak tersedia' ?></p>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label class="form-control-label">Email</label>
              <p class="form-control-static"><?= $user->email ?? 'Tidak tersedia' ?></p>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label class="form-control-label">Username</label>
              <p class="form-control-static"><?= $user->nama_pengguna ?? 'Tidak tersedia' ?></p>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label class="form-control-label">Nomor Telepon</label>
              <p class="form-control-static"><?= isset($user->telepon) ? $user->telepon : 'Tidak tersedia' ?></p>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label class="form-control-label">Role</label>
              <p class="form-control-static">
                <?php if ($user->role == 'admin'): ?>
                  <span class="badge badge-sm bg-gradient-success">Administrator</span>
                <?php elseif ($user->role == 'staff'): ?>
                  <span class="badge badge-sm bg-gradient-info">Staff/Rekruter</span>
                <?php else: ?>
                  <span class="badge badge-sm bg-gradient-secondary"><?= ucfirst($user->role) ?></span>
                <?php endif; ?>
              </p>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label class="form-control-label">Alamat</label>
              <p class="form-control-static"><?= isset($user->alamat) ? $user->alamat : 'Tidak tersedia' ?></p>
            </div>
          </div>
        </div>
        <hr class="horizontal dark">
        <p class="text-uppercase text-sm">Informasi Akun</p>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label class="form-control-label">Status</label>
              <p class="form-control-static">
                <?php if ($user->status == 'aktif'): ?>
                  <span class="badge badge-sm bg-gradient-success">Aktif</span>
                <?php else: ?>
                  <span class="badge badge-sm bg-gradient-danger">Nonaktif</span>
                <?php endif; ?>
              </p>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label class="form-control-label">Terdaftar Sejak</label>
              <p class="form-control-static"><?= isset($user->dibuat_pada) ? date('d M Y H:i', strtotime($user->dibuat_pada)) : 'Tidak tersedia' ?></p>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label class="form-control-label">Login Terakhir</label>
              <p class="form-control-static"><?= isset($user->login_terakhir) ? date('d M Y H:i', strtotime($user->login_terakhir)) : 'Tidak tersedia' ?></p>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label class="form-control-label">Diperbarui Pada</label>
              <p class="form-control-static"><?= isset($user->diperbarui_pada) ? date('d M Y H:i', strtotime($user->diperbarui_pada)) : 'Tidak tersedia' ?></p>
            </div>
          </div>
        </div>
        <hr class="horizontal dark">
        <p class="text-uppercase text-sm">Keamanan</p>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label class="form-control-label">Password</label>
              <div class="d-flex align-items-center">
                <p class="form-control-static me-3">••••••••••••</p>
                <a href="<?= base_url('admin/ubah-password') ?>" class="btn btn-sm btn-outline-warning">
                  <i class="fas fa-key me-2"></i>Ubah Password
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="card card-profile">
      <img src="<?= base_url('assets/img/bg-profile.jpg') ?>" alt="Profile Cover" class="card-img-top">
      <div class="row justify-content-center">
        <div class="col-4 col-lg-4 order-lg-2">
          <div class="mt-n4 mt-lg-n6 mb-4 mb-lg-0">
            <a href="javascript:;">
              <img src="<?= $user->foto_profil ? base_url('uploads/profile_pictures/' . $user->foto_profil) : base_url('assets/img/team-2.jpg') ?>" class="rounded-circle img-fluid border border-2 border-white" style="width: 100px; height: 100px; object-fit: cover;">
            </a>
          </div>
        </div>
      </div>
      <div class="card-body pt-0">
        <div class="text-center mt-4">
          <h5><?= $user->nama_lengkap ?? 'Tidak tersedia' ?></h5>
          <div class="h6 font-weight-300">
            <i class="ni location_pin mr-2"></i><?= $user->email ?? 'Tidak tersedia' ?>
          </div>
          <div class="h6 mt-2">
            <i class="ni business_briefcase-24 mr-2"></i>
            <?php if ($user->role == 'admin'): ?>
              Administrator
            <?php elseif ($user->role == 'staff'): ?>
              Staff/Rekruter
            <?php else: ?>
              <?= ucfirst($user->role) ?>
            <?php endif; ?>
          </div>
          <div>
            <i class="ni education_hat mr-2"></i>Terdaftar sejak: <?= isset($user->dibuat_pada) ? date('d M Y', strtotime($user->dibuat_pada)) : 'Tidak tersedia' ?>
          </div>
        </div>
        <div class="d-flex justify-content-center mt-4">
          <a href="<?= base_url('admin/edit_pengguna/' . $user->id) ?>" class="btn btn-sm btn-primary me-2">
            <i class="fas fa-edit me-2"></i>Edit Profil
          </a>
          <a href="<?= base_url('admin/ubah-password') ?>" class="btn btn-sm btn-warning">
            <i class="fas fa-key me-2"></i>Ubah Password
          </a>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Additional Information Cards -->
<div class="row mt-4">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header pb-0">
        <h6>Informasi Sistem</h6>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-3">
            <div class="text-center">
              <h4 class="text-primary">
                <i class="fas fa-shield-alt"></i>
              </h4>
              <h6 class="mb-0">Keamanan</h6>
              <p class="text-sm">Akun Terlindungi</p>
            </div>
          </div>
          <div class="col-md-3">
            <div class="text-center">
              <h4 class="text-success">
                <i class="fas fa-check-circle"></i>
              </h4>
              <h6 class="mb-0">Status</h6>
              <p class="form-control-static">
                <?php if ($user->status == 'aktif'): ?>
                  <span class="badge badge-sm bg-gradient-success">Aktif</span>
                <?php else: ?>
                  <span class="badge badge-sm bg-gradient-danger">Nonaktif</span>
                <?php endif; ?>
              </p>            </div>
          </div>
          <div class="col-md-3">
            <div class="text-center">
              <h4 class="text-info">
                <i class="fas fa-user-cog"></i>
              </h4>
              <h6 class="mb-0">Akses</h6>
              <p class="form-control-static">
                <?php if ($user->role == 'admin'): ?>
                  <span class="badge badge-sm bg-gradient-success">Administrator</span>
                <?php elseif ($user->role == 'staff'): ?>
                  <span class="badge badge-sm bg-gradient-info">Staff/Rekruter</span>
                <?php else: ?>
                  <span class="badge badge-sm bg-gradient-secondary"><?= ucfirst($user->role) ?></span>
                <?php endif; ?>
              </p>            </div>
          </div>
          <div class="col-md-3">
            <div class="text-center">
              <h4 class="text-warning">
                <i class="fas fa-clock"></i>
              </h4>
              <h6 class="mb-0">Aktivitas</h6>
              <p class="form-control-static"><?= isset($user->login_terakhir) ? date('d M Y H:i', strtotime($user->login_terakhir)) : 'Tidak tersedia' ?></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
