<?php echo form_open('auth/reset_password/' . $token, ['class' => 'needs-validation']); ?>
<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
  <div class="mb-3">
    <input type="password" name="password" class="form-control form-control-lg" placeholder="New Password" aria-label="New Password" required>
    <small class="text-muted">Password must be at least 6 characters long</small>
  </div>
  <div class="mb-3">
    <input type="password" name="confirm_password" class="form-control form-control-lg" placeholder="Confirm New Password" aria-label="Confirm New Password" required>
  </div>
  <div class="text-center">
    <button type="submit" class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0">Reset Password</button>
  </div>
<?= form_close() ?>
