<?php echo form_open('auth/lupa_password', ['class' => 'needs-validation']); ?>
<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
  <div class="mb-3">
    <input type="email" name="email" class="form-control form-control-lg" placeholder="Email" aria-label="Email" required>
  </div>
  <div class="text-center">
    <button type="submit" class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0">Reset Password</button>
  </div>
<?= form_close() ?>
