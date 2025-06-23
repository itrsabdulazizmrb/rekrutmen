<div class="row">
  <div class="col-12">
    <div class="card mb-4">
      <div class="card-header pb-0">
        <div class="d-flex justify-content-between align-items-center">
          <h6>Tambah Pengguna Baru</h6>
          <a href="<?= base_url('admin/pengguna') ?>" class="btn btn-sm btn-outline-primary">
            <i class="fas fa-arrow-left me-2"></i> Kembali ke Daftar Pengguna
          </a>
        </div>
        <p class="text-sm mb-0">
          <i class="fa fa-info-circle text-primary" aria-hidden="true"></i>
          <span class="font-weight-bold">Isi formulir di bawah ini untuk menambahkan pengguna baru</span>
        </p>
      </div>
      <div class="card-body">
        <?= form_open_multipart('admin/tambah_pengguna', ['class' => 'needs-validation']) ?>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="nama_lengkap" class="form-control-label">Nama Lengkap <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="<?= set_value('nama_lengkap') ?>" required>
                <?= form_error('nama_lengkap', '<small class="text-danger">', '</small>') ?>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="email" class="form-control-label">Email <span class="text-danger">*</span></label>
                <input type="email" class="form-control" id="email" name="email" value="<?= set_value('email') ?>" required>
                <?= form_error('email', '<small class="text-danger">', '</small>') ?>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="username" class="form-control-label">Nama Pengguna <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="username" name="username" value="<?= set_value('username') ?>" required>
                <?= form_error('username', '<small class="text-danger">', '</small>') ?>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="peran" class="form-control-label">Role <span class="text-danger">*</span></label>
                <select class="form-control" id="role" name="role" required>
                  <option value="">Pilih Role</option>
                  <option value="admin" <?= set_select('role', 'admin') ?>>Admin</option>
                  <option value="pelamar" <?= set_select('role', 'pelamar') ?>>Pelamar</option>
                  <option value="staff" <?= set_select('role', 'staff') ?>>Staff</option>
                  <option value="hrd" <?= set_select('role', 'hrd') ?>>HRD</option>
                  <option value="direktur" <?= set_select('role', 'direktur') ?>>Direktur</option>
                </select>
                <?= form_error('role', '<small class="text-danger">', '</small>') ?>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="password" class="form-control-label">Kata Sandi <span class="text-danger">*</span></label>
                <input type="password" class="form-control" id="password" name="password" required>
                <?= form_error('password', '<small class="text-danger">', '</small>') ?>
                <small class="text-muted">Minimal 6 karakter, kombinasi huruf dan angka.</small>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="confirm_password" class="form-control-label">Konfirmasi Kata Sandi <span class="text-danger">*</span></label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                <?= form_error('confirm_password', '<small class="text-danger">', '</small>') ?>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="phone" class="form-control-label">Nomor Telepon</label>
                <input type="text" class="form-control" id="phone" name="phone" value="<?= set_value('phone') ?>">
                <?= form_error('phone', '<small class="text-danger">', '</small>') ?>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="profile_picture" class="form-control-label">Foto Profil</label>
                <input type="file" class="form-control" id="profile_picture" name="profile_picture" accept="image/*">
                <small class="text-muted">Format yang diizinkan: JPG, JPEG, PNG. Maks 1MB.</small>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="address" class="form-control-label">Alamat</label>
                <textarea class="form-control" id="address" name="address" rows="3"><?= set_value('address') ?></textarea>
                <?= form_error('address', '<small class="text-danger">', '</small>') ?>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="status" name="status" value="1" <?= set_checkbox('status', '1', true) ?>>
                <label class="form-check-label" for="status">Aktifkan Pengguna</label>
              </div>
            </div>
          </div>

          <!-- <div class="row">
            <div class="col-md-12">
              <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="kirim_email" name="kirim_email" value="1" <?= set_checkbox('kirim_email', '1', true) ?>>
                <label class="form-check-label" for="kirim_email">Kirim Email Notifikasi ke Pengguna</label>
              </div>
            </div>
          </div> -->

          <div class="row mt-4">
            <div class="col-md-12">
              <button type="submit" class="btn btn-primary">Simpan Pengguna</button>
              <button type="reset" class="btn btn-secondary">Reset</button>
            </div>
          </div>
        <?= form_close() ?>
      </div>
    </div>
  </div>
</div>

<div class="row mt-4">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header pb-0">
        <h6>Panduan Membuat Pengguna</h6>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-6">
            <h6 class="text-uppercase text-sm">Peran Pengguna</h6>
            <ul class="text-sm">
              <li><strong>Admin:</strong> Memiliki akses penuh ke semua fitur sistem, termasuk manajemen pengguna, lowongan, lamaran, penilaian, dan blog.</li>
              <li><strong>Pelamar:</strong> Dapat membuat profil, mencari dan melamar pekerjaan, mengikuti penilaian, dan melacak status lamaran.</li>
              <li><strong>Rekruter:</strong> Dapat membuat dan mengelola lowongan, meninjau lamaran, memberikan penilaian, dan berkomunikasi dengan pelamar.</li>
            </ul>
          </div>
          <div class="col-md-6">
            <h6 class="text-uppercase text-sm">Praktik Terbaik</h6>
            <ul class="text-sm">
              <li>Gunakan alamat email yang valid untuk memastikan pengguna dapat menerima notifikasi.</li>
              <li>Tetapkan kata sandi yang kuat dengan kombinasi huruf, angka, dan karakter khusus.</li>
              <li>Berikan peran yang sesuai dengan tanggung jawab pengguna.</li>
              <li>Nonaktifkan pengguna yang tidak lagi memerlukan akses ke sistem.</li>
              <li>Secara berkala tinjau dan perbarui informasi pengguna.</li>
            </ul>
          </div>
        </div>

        <div class="alert alert-info mt-3" role="alert">
          <strong>Catatan:</strong> Saat membuat pengguna baru, pastikan untuk memberitahu mereka tentang kredensial login mereka melalui saluran yang aman. Jika Anda mengaktifkan opsi "Kirim Email Notifikasi", sistem akan secara otomatis mengirimkan email dengan informasi login ke alamat email yang ditentukan.
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    
    const emailInput = document.getElementById('email');
    const usernameInput = document.getElementById('username');

    emailInput.addEventListener('blur', function() {
      if (!usernameInput.value && this.value) {
        
        const emailParts = this.value.split('@');
        if (emailParts.length > 0) {
          usernameInput.value = emailParts[0].toLowerCase().replace(/[^a-z0-9]/g, '');
        }
      }
    });

    
    const passwordInput = document.getElementById('password');
    const confirmPasswordInput = document.getElementById('confirm_password');

    if (passwordInput) {
      const strengthMeter = document.createElement('div');
      strengthMeter.classList.add('progress', 'mt-2');
      strengthMeter.style.height = '5px';

      const strengthBar = document.createElement('div');
      strengthBar.classList.add('progress-bar');
      strengthBar.style.width = '0%';

      strengthMeter.appendChild(strengthBar);

      const strengthText = document.createElement('small');
      strengthText.classList.add('text-muted', 'mt-1', 'd-block');

      passwordInput.parentNode.insertBefore(strengthMeter, passwordInput.nextSibling);
      passwordInput.parentNode.insertBefore(strengthText, strengthMeter.nextSibling);

      passwordInput.addEventListener('input', function() {
        const password = this.value;
        let strength = 0;

        
        if (password.length >= 6) strength += 25;

        
        if (/[A-Z]/.test(password)) strength += 25;

        
        if (/[a-z]/.test(password)) strength += 25;

        
        if (/[0-9!@#$%^&*]/.test(password)) strength += 25;

        
        strengthBar.style.width = strength + '%';

        if (strength < 25) {
          strengthBar.className = 'progress-bar bg-danger';
          strengthText.textContent = 'Sangat Lemah';
        } else if (strength < 50) {
          strengthBar.className = 'progress-bar bg-warning';
          strengthText.textContent = 'Lemah';
        } else if (strength < 75) {
          strengthBar.className = 'progress-bar bg-info';
          strengthText.textContent = 'Sedang';
        } else {
          strengthBar.className = 'progress-bar bg-success';
          strengthText.textContent = 'Kuat';
        }
      });

      
      confirmPasswordInput.addEventListener('input', function() {
        if (this.value === passwordInput.value) {
          this.classList.remove('is-invalid');
          this.classList.add('is-valid');
        } else {
          this.classList.remove('is-valid');
          this.classList.add('is-invalid');
        }
      });
    }
  });
</script>
