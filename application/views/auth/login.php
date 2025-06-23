<div class="login-form-container">
  <div class="text-center mb-4">
    <img src="<?= base_url('assets/img/gallery-logo.png') ?>" alt="Logo" style="height:60px;">
    <h2 class="mt-2" style="font-weight:bold;">Selamat Datang</h2>
    <p>Login untuk mengakses sistem</p>
  </div>
  <?php echo form_open('auth/login', ['class' => 'needs-validation']); ?>
    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
    <div class="mb-3">
      <input type="text" name="username" class="form-control form-control-lg" placeholder="Username" aria-label="Username" required autofocus>
    </div>
    <div class="mb-3 position-relative">
      <input type="password" name="password" class="form-control form-control-lg" placeholder="Password" aria-label="Password" required>
      <a href="<?= base_url('auth/lupa_password') ?>" class="float-end small mt-1">Lupa Password?</a>
    </div>
    <div class="form-check mb-3">
      <input class="form-check-input" type="checkbox" id="rememberMe" name="remember_me" value="1">
      <label class="form-check-label" for="rememberMe">Remember Me</label>
    </div>
    <button type="submit" class="btn btn-primary w-100 py-2"><i class="fa fa-sign-in-alt me-2"></i> Login</button>
  <?php echo form_close(); ?>
  <div class="text-center mt-3">
    <a href="mailto:admin@email.com" class="small">Butuh bantuan? Hubungi Admin</a>
  </div>
</div>
