<div class="row">
  <div class="col-md-8 mx-auto">
    <div class="card">
      <div class="card-header pb-0">
        <div class="d-flex align-items-center">
          <p class="mb-0">Ubah Password</p>
          <a href="<?= base_url('pelamar/profil') ?>" class="btn btn-primary btn-sm ms-auto">Kembali ke Profil</a>
        </div>
      </div>
      <div class="card-body">
        <?= form_open('pelamar/ubah-password', ['class' => 'needs-validation']) ?>
          <div class="form-group">
            <label for="current_password" class="form-control-label">Password Saat Ini</label>
            <input type="password" name="current_password" id="current_password" class="form-control" required>
            <?= form_error('current_password', '<small class="text-danger">', '</small>') ?>
          </div>

          <div class="form-group mt-3">
            <label for="new_password" class="form-control-label">Password Baru</label>
            <input type="password" name="new_password" id="new_password" class="form-control" data-password-strength required>
            <small class="text-muted">Password harus minimal 6 karakter</small>
            <?= form_error('new_password', '<small class="text-danger">', '</small>') ?>
          </div>

          <div class="form-group mt-3">
            <label for="confirm_password" class="form-control-label">Konfirmasi Password Baru</label>
            <input type="password" name="confirm_password" id="confirm_password" class="form-control" required>
            <?= form_error('confirm_password', '<small class="text-danger">', '</small>') ?>
          </div>

          <div class="alert alert-info mt-4" role="alert">
            <h6 class="alert-heading mb-1">Panduan Password</h6>
            <ul class="mb-0 ps-4">
              <li>Gunakan minimal 8 karakter</li>
              <li>Sertakan minimal satu huruf besar</li>
              <li>Sertakan minimal satu huruf kecil</li>
              <li>Sertakan minimal satu angka atau karakter khusus</li>
              <li>Hindari menggunakan informasi pribadi</li>
              <li>Jangan gunakan ulang password dari website lain</li>
            </ul>
          </div>

          <div class="d-flex justify-content-end mt-4">
            <button type="submit" class="btn btn-primary">Ubah Password</button>
          </div>
        <?= form_close() ?>
      </div>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    
    const passwordInput = document.getElementById('new_password');
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

        
        if (password.length >= 8) strength += 25;

        
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
