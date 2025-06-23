<?= form_open('auth/register', ['class' => 'needs-validation']) ?>
  <div class="mb-3">
    <input type="text" name="full_name" class="form-control form-control-lg" placeholder="Full Name" aria-label="Full Name" value="<?= set_value('full_name') ?>" required>
  </div>
  <div class="mb-3">
    <input type="text" name="username" class="form-control form-control-lg" placeholder="Username" aria-label="Username" value="<?= set_value('username') ?>" required>
  </div>
  <div class="mb-3">
    <input type="email" name="email" class="form-control form-control-lg" placeholder="Email" aria-label="Email" value="<?= set_value('email') ?>" required>
  </div>
  <div class="mb-3">
    <input type="password" name="password" class="form-control form-control-lg" placeholder="Password" aria-label="Password" required>
    <small class="text-muted">Password must be at least 6 characters long</small>
  </div>
  <div class="mb-3">
    <input type="password" name="confirm_password" class="form-control form-control-lg" placeholder="Confirm Password" aria-label="Confirm Password" required>
  </div>
  <div class="form-check form-check-info text-start">
    <input class="form-check-input" type="checkbox" name="terms" id="terms" required>
    <label class="form-check-label" for="terms">
      I agree to the <a href="javascript:;" class="text-dark font-weight-bolder">Terms and Conditions</a>
    </label>
  </div>
  <div class="text-center">
    <button type="submit" class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0">Sign up</button>
  </div>
<?= form_close() ?>
