<div class="row">
  <div class="col-12">
    <div class="card mb-4">
      <div class="card-header pb-0">
        <div class="d-flex justify-content-between align-items-center">
          <h6>Edit Pengguna</h6>
          <a href="<?= base_url('admin/pengguna') ?>" class="btn btn-sm btn-outline-primary">
            <i class="fas fa-arrow-left me-2"></i> Kembali ke Daftar Pengguna
          </a>
        </div>
        <p class="text-sm mb-0">
          <i class="fa fa-info-circle text-primary" aria-hidden="true"></i>
          <span class="font-weight-bold">Edit informasi pengguna</span>
        </p>
      </div>
      <div class="card-body">
        <?= form_open_multipart('admin/edit_pengguna/' . $user->id, ['class' => 'needs-validation']) ?>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="nama_lengkap" class="form-control-label">Nama Lengkap <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="<?= set_value('nama_lengkap', $user->nama_lengkap) ?>" required>
                <?= form_error('nama_lengkap', '<small class="text-danger">', '</small>') ?>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="email" class="form-control-label">Email <span class="text-danger">*</span></label>
                <input type="email" class="form-control" id="email" name="email" value="<?= set_value('email', $user->email) ?>" required>
                <?= form_error('email', '<small class="text-danger">', '</small>') ?>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="nama_pengguna" class="form-control-label">Nama Pengguna <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="nama_pengguna" name="nama_pengguna" value="<?= set_value('nama_pengguna', $user->nama_pengguna) ?>" required readonly>
                <?= form_error('nama_pengguna', '<small class="text-danger">', '</small>') ?>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="role" class="form-control-label">Role <span class="text-danger">*</span></label>
                <select class="form-control" id="role" name="role" required>
                  <option value="">Pilih Role</option>
                  <option value="admin" <?= set_select('role', 'admin', ($user->role == 'admin')) ?>>Admin</option>
                  <option value="pelamar" <?= set_select('role', 'pelamar', ($user->role == 'pelamar')) ?>>Pelamar</option>
                  <option value="staff" <?= set_select('role', 'staff', ($user->role == 'staff')) ?>>Staff</option>
                  <option value="hrd" <?= set_select('role', 'hrd', ($user->role == 'hrd')) ?>>HRD</option>
                  <option value="direktur" <?= set_select('role', 'direktur', ($user->role == 'direktur')) ?>>Direktur</option>
                </select>
                <?= form_error('role', '<small class="text-danger">', '</small>') ?>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="telepon" class="form-control-label">Nomor Telepon</label>
                <input type="text" class="form-control" id="telepon" name="telepon" value="<?= set_value('telepon', $user->telepon) ?>">
                <?= form_error('telepon', '<small class="text-danger">', '</small>') ?>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <div class="form-group">
                <label for="alamat" class="form-control-label">Alamat</label>
                <textarea class="form-control" id="alamat" name="alamat" rows="1"><?= set_value('alamat', $user->alamat) ?></textarea>
                <?= form_error('alamat', '<small class="text-danger">', '</small>') ?>
              </div>
              </div>
            </div>
          </div>


          <div class="row">
            <div class="col-md-12">
              <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="status" name="status" value="aktif" <?= set_checkbox('status', 'aktif', ($user->status == 'aktif')) ?>>
                <label class="form-check-label" for="status">Aktifkan Pengguna</label>
              </div>
            </div>
          </div>

          <div class="row mt-4">
            <div class="col-md-12">
              <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
              <a href="<?= base_url('admin/reset_kata_sandi/' . $user->id) ?>" class="btn btn-warning">Reset Kata Sandi</a>
              <a href="<?= base_url('admin/pengguna') ?>" class="btn btn-secondary">Batal</a>
            </div>
          </div>
        <?= form_close() ?>
      </div>
    </div>
  </div>
</div>

<div class="row mt-4">
  <div class="col-md-6">
    <div class="card">
      <div class="card-header pb-0">
        <h6>Informasi Pengguna</h6>
      </div>
      <div class="card-body">
        <p class="text-sm mb-1">
          <strong>ID Pengguna:</strong> <?= $user->id ?>
        </p>
        <p class="text-sm mb-1">
          <strong>Tanggal Daftar:</strong> <?= date('d M Y H:i', strtotime($user->dibuat_pada)) ?>
        </p>
        <p class="text-sm mb-1">
          <strong>Terakhir Diperbarui:</strong> <?= date('d M Y H:i', strtotime($user->diperbarui_pada)) ?>
        </p>
        <p class="text-sm mb-1">
          <strong>Login Terakhir:</strong> <?= $user->login_terakhir ? date('d M Y H:i', strtotime($user->login_terakhir)) : 'Belum Pernah' ?>
        </p>
        <p class="text-sm mb-1">
          <strong>IP Terakhir:</strong> <?= $user->ip_terakhir ?? 'Tidak Tersedia' ?>
        </p>
        <p class="text-sm mb-1">
          <strong>Status:</strong> <span class="badge badge-sm bg-gradient-<?= ($user->status == 'aktif') ? 'success' : 'secondary' ?>"><?= ($user->status == 'aktif') ? 'Aktif' : 'Tidak Aktif' ?></span>
        </p>
      </div>
    </div>
  </div>

  <?php if ($user->role == 'pelamar') : ?>
    <div class="col-md-6">
      <div class="card">
        <div class="card-header pb-0">
          <div class="d-flex justify-content-between align-items-center">
            <h6>Lamaran Terbaru</h6>
            <a href="<?= base_url('admin/lamaran_pelamar/' . $user->id) ?>" class="btn btn-sm btn-primary">
              <i class="fas fa-list me-2"></i> Lihat Semua
            </a>
          </div>
        </div>
        <div class="card-body">
          <?php
          
          $CI =& get_instance();
          
          $applications = $CI->model_lamaran->dapatkan_lamaran_pelamar($user->id);
          
          if (count($applications) > 5) {
            $applications = array_slice($applications, 0, 5);
          }
          if (empty($applications)) :
          ?>
            <p class="text-center">Belum ada lamaran yang dikirimkan.</p>
          <?php else : ?>
            <div class="table-responsive">
              <table class="table align-items-center mb-0">
                <thead>
                  <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Lowongan</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($applications as $application) : ?>
                    <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm"><?= $application->judul_pekerjaan ?></h6>
                          </div>
                        </div>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold"><?= date('d M Y', strtotime($application->tanggal_lamaran)) ?></span>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <span class="badge badge-sm bg-gradient-<?= $application->status == 'pending' ? 'warning' : ($application->status == 'reviewed' ? 'info' : ($application->status == 'shortlisted' ? 'success' : ($application->status == 'interviewed' ? 'primary' : ($application->status == 'offered' ? 'warning' : ($application->status == 'hired' ? 'success' : 'danger'))))) ?>"><?= ucfirst($application->status) ?></span>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  <?php elseif ($user->role == 'recruiter') : ?>
    <div class="col-md-6">
      <div class="card">
        <div class="card-header pb-0">
          <div class="d-flex justify-content-between align-items-center">
            <h6>Lowongan yang Dikelola</h6>
            <a href="<?= base_url('admin/pekerjaan_rekruter/' . $user->id) ?>" class="btn btn-sm btn-primary">
              <i class="fas fa-list me-2"></i> Lihat Semua
            </a>
          </div>
        </div>
        <div class="card-body">
          <?php
          
          $CI =& get_instance();
          
          $jobs = $CI->model_lowongan->dapatkan_lowongan_rekruter($user->id);
          
          if (count($jobs) > 5) {
            $jobs = array_slice($jobs, 0, 5);
          }
          if (empty($jobs)) :
          ?>
            <p class="text-center">Belum ada lowongan yang dikelola.</p>
          <?php else : ?>
            <div class="table-responsive">
              <table class="table align-items-center mb-0">
                <thead>
                  <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Lowongan</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Batas Waktu</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($jobs as $job) : ?>
                    <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm"><?= $job->judul ?></h6>
                          </div>
                        </div>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold"><?= date('d M Y', strtotime($job->batas_waktu)) ?></span>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <span class="badge badge-sm bg-gradient-<?= $job->status == 'active' ? 'success' : ($job->status == 'draft' ? 'secondary' : 'danger') ?>"><?= $job->status == 'active' ? 'Aktif' : ($job->status == 'draft' ? 'Draft' : 'Tidak Aktif') ?></span>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  <?php endif; ?>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    
    const roleSelect = document.getElementById('role');
    const originalRole = '<?= $user->role ?>';

    roleSelect.addEventListener('change', function() {
      if (this.value !== originalRole) {
        const selectElement = this;

        Swal.fire({
          title: 'Konfirmasi Perubahan role',
          text: 'Mengubah role pengguna dapat memengaruhi akses dan data mereka. Apakah Anda yakin ingin melanjutkan?',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya, Ubah role',
          cancelButtonText: 'Batal'
        }).then((result) => {
          if (!result.isConfirmed) {
            selectElement.value = originalRole;
          }
        });
      }
    });
  });
</script>
