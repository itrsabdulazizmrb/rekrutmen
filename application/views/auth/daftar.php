<?php echo form_open('auth/daftar', ['class' => 'needs-validation']); ?>
<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
  <div class="mb-3">
    <input type="text" name="full_name" class="form-control form-control-lg" placeholder="Nama Lengkap" aria-label="Nama Lengkap" value="<?= set_value('full_name') ?>" required>
  </div>
  <div class="mb-3">
    <input type="text" name="username" class="form-control form-control-lg" placeholder="Username" aria-label="Username" value="<?= set_value('username') ?>" required>
  </div>
  <div class="mb-3">
    <input type="email" name="email" class="form-control form-control-lg" placeholder="Email" aria-label="Email" value="<?= set_value('email') ?>" required>
  </div>
  <div class="mb-3">
    <input type="password" name="password" class="form-control form-control-lg" placeholder="Password" aria-label="Password" required>
    <small class="text-muted">Password minimal 6 karakter</small>
  </div>
  <div class="mb-3">
    <input type="password" name="confirm_password" class="form-control form-control-lg" placeholder="Konfirmasi Password" aria-label="Konfirmasi Password" required>
  </div>
  <div class="form-check form-check-info text-start">
    <input class="form-check-input" type="checkbox" name="terms" id="terms" required>
    <label class="form-check-label" for="terms">
      Saya menyetujui <a href="javascript:;" class="text-dark font-weight-bolder">Syarat dan Ketentuan</a>
    </label>
  </div>
  <div class="text-center">
    <button type="submit" class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0">Daftar</button>
  </div>
<?= form_close() ?>
