<div class="row">
  <div class="col-md-8 mx-auto">
    <div class="card">
      <div class="card-header pb-0">
        <div class="d-flex align-items-center">
          <p class="mb-0">Ubah Password</p>
          <a href="<?= base_url('admin/profil') ?>" class="btn btn-primary btn-sm ms-auto">Kembali ke Profil</a>
        </div>
      </div>
      <div class="card-body">
        <?= form_open('admin/ubah-password', ['class' => 'needs-validation']) ?>
          <div class="form-group">
            <label for="current_password" class="form-control-label">Password Saat Ini</label>
            <input type="password" name="current_password" id="current_password" class="form-control" required>
            <?= form_error('current_password', '<small class="text-danger">', '</small>') ?>
          </div>
          
          <div class="form-group">
            <label for="new_password" class="form-control-label">Password Baru</label>
            <input type="password" name="new_password" id="new_password" class="form-control" required minlength="6">
            <small class="form-text text-muted">Password minimal 6 karakter</small>
            <?= form_error('new_password', '<small class="text-danger">', '</small>') ?>
          </div>
          
          <div class="form-group">
            <label for="confirm_password" class="form-control-label">Konfirmasi Password Baru</label>
            <input type="password" name="confirm_password" id="confirm_password" class="form-control" required>
            <?= form_error('confirm_password', '<small class="text-danger">', '</small>') ?>
          </div>
          
          <div class="d-flex justify-content-end">
            <a href="<?= base_url('admin/profil') ?>" class="btn btn-light me-2">Batal</a>
            <button type="submit" class="btn btn-primary">
              <i class="fas fa-save me-2"></i>Simpan Password
            </button>
          </div>
        <?= form_close() ?>
      </div>
    </div>
  </div>
</div>

<!-- Password Strength Indicator -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const newPasswordInput = document.getElementById('new_password');
    const confirmPasswordInput = document.getElementById('confirm_password');
    
    
    newPasswordInput.addEventListener('input', function() {
        const password = this.value;
        const strengthIndicator = document.getElementById('password-strength');
        
        if (password.length < 6) {
            this.setCustomValidity('Password minimal 6 karakter');
        } else {
            this.setCustomValidity('');
        }
    });
    
    
    confirmPasswordInput.addEventListener('input', function() {
        const newPassword = newPasswordInput.value;
        const confirmPassword = this.value;
        
        if (newPassword !== confirmPassword) {
            this.setCustomValidity('Password tidak cocok');
        } else {
            this.setCustomValidity('');
        }
    });
    
    
    const toggleButtons = document.querySelectorAll('.toggle-password');
    toggleButtons.forEach(button => {
        button.addEventListener('click', function() {
            const targetId = this.getAttribute('data-target');
            const targetInput = document.getElementById(targetId);
            const icon = this.querySelector('i');
            
            if (targetInput.type === 'password') {
                targetInput.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                targetInput.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });
    });
});
</script>

<!-- Enhanced form with show/hide password -->
<style>
.password-input-group {
    position: relative;
}

.password-toggle {
    position: absolute;
    right: 10px;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    color: #6c757d;
    cursor: pointer;
    z-index: 10;
}

.password-toggle:hover {
    color: #495057;
}

.form-control {
    padding-right: 40px;
}
</style>

<!-- Security Tips Card -->
<div class="row mt-4">
  <div class="col-md-8 mx-auto">
    <div class="card">
      <div class="card-header pb-0">
        <h6>Tips Keamanan Password</h6>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-6">
            <ul class="list-unstyled">
              <li class="mb-2">
                <i class="fas fa-check text-success me-2"></i>
                Gunakan minimal 6 karakter
              </li>
              <li class="mb-2">
                <i class="fas fa-check text-success me-2"></i>
                Kombinasi huruf besar dan kecil
              </li>
              <li class="mb-2">
                <i class="fas fa-check text-success me-2"></i>
                Sertakan angka dan simbol
              </li>
            </ul>
          </div>
          <div class="col-md-6">
            <ul class="list-unstyled">
              <li class="mb-2">
                <i class="fas fa-times text-danger me-2"></i>
                Jangan gunakan informasi pribadi
              </li>
              <li class="mb-2">
                <i class="fas fa-times text-danger me-2"></i>
                Hindari password yang mudah ditebak
              </li>
              <li class="mb-2">
                <i class="fas fa-times text-danger me-2"></i>
                Jangan bagikan password ke orang lain
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
