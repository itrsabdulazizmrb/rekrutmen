<?= form_open('auth/forgot_password', ['class' => 'needs-validation']) ?>
  <div class="mb-3">
    <input type="email" name="email" class="form-control form-control-lg" placeholder="Email" aria-label="Email" required>
  </div>
  <div class="text-center">
    <button type="submit" class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0">Reset Password</button>
  </div>
<?= form_close() ?>
