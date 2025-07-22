<div class="row">
  <div class="col-md-8">
    <div class="card">
      <div class="card-header pb-0">
        <div class="d-flex align-items-center">
          <p class="mb-0">Edit Profil</p>
          <a href="<?= base_url('pelamar/ubah-password') ?>" class="btn btn-primary btn-sm ms-auto">Ubah Password</a>
        </div>
      </div>
      <div class="card-body">
        <?= form_open_multipart('pelamar/profil', ['class' => 'needs-validation']) ?>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="full_name" class="form-control-label">Nama Lengkap</label>
                <input type="text" name="full_name" id="full_name" class="form-control" value="<?= set_value('full_name', $user->nama_lengkap) ?>" required>
                <?= form_error('full_name', '<small class="text-danger">', '</small>') ?>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="email" class="form-control-label">Alamat Email</label>
                <input type="email" name="email" id="email" class="form-control" value="<?= set_value('email', $user->email) ?>" required>
                <?= form_error('email', '<small class="text-danger">', '</small>') ?>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="phone" class="form-control-label">Nomor Telepon</label>
                <input type="text" name="phone" id="phone" class="form-control" value="<?= set_value('phone', $user->telepon) ?>" required>
                <?= form_error('phone', '<small class="text-danger">', '</small>') ?>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="date_of_birth" class="form-control-label">Tanggal Lahir</label>
                <input type="date" name="date_of_birth" id="date_of_birth" class="form-control" value="<?= set_value('date_of_birth', $profile->tanggal_lahir) ?>" required>
                <?= form_error('date_of_birth', '<small class="text-danger">', '</small>') ?>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="address" class="form-control-label">Alamat</label>
                <textarea name="address" id="address" class="form-control" rows="3" required><?= set_value('address', $user->alamat) ?></textarea>
                <?= form_error('address', '<small class="text-danger">', '</small>') ?>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="gender" class="form-control-label">Jenis Kelamin</label>
                <select name="gender" id="gender" class="form-control" required>
                  <option value="">Pilih Jenis Kelamin</option>
                  <option value="laki-laki" <?= set_select('gender', 'laki-laki', ($profile->jenis_kelamin == 'laki-laki')) ?>>Laki-laki</option>
                  <option value="perempuan" <?= set_select('gender', 'perempuan', ($profile->jenis_kelamin == 'perempuan')) ?>>Perempuan</option>
                </select>
                <?= form_error('gender', '<small class="text-danger">', '</small>') ?>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="profile_picture" class="form-control-label">Foto Profil</label>
                <input type="file" name="profile_picture" id="profile_picture" class="form-control" accept="image/*">
                <small class="text-muted">Ukuran maksimal: 1MB. Format yang diizinkan: JPG, JPEG, PNG</small>
              </div>
            </div>
          </div>
          <hr class="horizontal dark">
          <p class="text-uppercase text-sm">Informasi Profesional</p>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="education" class="form-control-label">Pendidikan</label>
                <textarea name="education" id="education" class="form-control" rows="3" placeholder="S1 Teknik Informatika Universitas Kalimantan Selatan" required><?= set_value('education', $profile->pendidikan) ?></textarea>
                <small class="text-muted">Masukkan latar belakang pendidikan Anda, termasuk gelar, institusi, dan tahun kelulusan.</small>
                <?= form_error('education', '<small class="text-danger">', '</small>') ?>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="experience" class="form-control-label">Pengalaman Kerja</label>
                <textarea name="experience" id="experience" class="form-control" rows="3" required><?= set_value('experience', $profile->pengalaman) ?></textarea>
                <small class="text-muted">Masukkan pengalaman kerja Anda, termasuk jabatan, perusahaan, dan periode kerja.</small>
                <?= form_error('experience', '<small class="text-danger">', '</small>') ?>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="skills" class="form-control-label">Keahlian</label>
                <textarea name="skills" id="skills" class="form-control" rows="3" required><?= set_value('skills', $profile->keahlian) ?></textarea>
                <small class="text-muted">Masukkan keahlian Anda, dipisahkan dengan koma (contoh: Anastesi, Bidan, Java, Php).</small>
                <?= form_error('skills', '<small class="text-danger">', '</small>') ?>
              </div>
            </div>
          </div>
          <hr class="horizontal dark">
          <p class="text-uppercase text-sm">Dokumen</p>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="resume" class="form-control-label">CV</label>
                <input type="file" name="resume" id="resume" class="form-control" accept=".pdf,.doc,.docx">
                <small class="text-muted">Ukuran maksimal: 2MB. Format yang diizinkan: PDF, DOC, DOCX</small>
              </div>
            </div>
            <div class="col-md-6">
              <?php if ($profile->cv) : ?>
                <div class="form-group">
                  <label class="form-control-label">CV Saat Ini</label>
                  <p class="mb-0"><?= $profile->cv ?></p>
                  <a href="<?= base_url('uploads/cv/' . $profile->cv) ?>" class="btn btn-sm btn-outline-primary mt-2" target="_blank">Lihat CV</a>
                </div>
              <?php endif; ?>
            </div>
          </div>

          <?php
          
          $uploaded_docs = [];
          if (!empty($documents)) {
              foreach ($documents as $doc) {
                  $uploaded_docs[$doc->jenis_dokumen] = $doc;
              }
          }

          
          foreach ($document_types as $doc_type_key => $doc_type) {
              
              if ($doc_type_key == 'cv') continue;
          ?>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="document_<?= $doc_type_key ?>" class="form-control-label"><?= $doc_type['nama_dokumen'] ?> <?= $doc_type['wajib'] ? '<span class="text-danger">*</span>' : '' ?></label>
                <input type="file" class="form-control" id="document_<?= $doc_type_key ?>" name="document_<?= $doc_type_key ?>" accept="<?= str_replace('|', ',', $doc_type['format_diizinkan']) ?>">
                <small class="text-muted">Format: <?= strtoupper(str_replace('|', ', ', $doc_type['format_diizinkan'])) ?>. Ukuran maksimal: <?= $doc_type['ukuran_maksimal']/1024 ?>MB</small>
              </div>
            </div>
            <div class="col-md-6">
              <?php if (isset($uploaded_docs[$doc_type_key])) : ?>
                <div class="form-group">
                  <label class="form-control-label"><?= $doc_type['nama_dokumen'] ?> Saat Ini</label>
                  <p class="mb-0"><?= $uploaded_docs[$doc_type_key]->nama_file ?></p>
                  <div class="mt-2">
                    <a href="<?= base_url('pelamar/download_dokumen_pelamar/' . $uploaded_docs[$doc_type_key]->id) ?>" class="btn btn-sm btn-outline-primary" target="_blank">Lihat Dokumen</a>
                    <a href="<?= base_url('pelamar/hapus_dokumen_pelamar/' . $uploaded_docs[$doc_type_key]->id) ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus dokumen ini?')">Hapus</a>
                  </div>
                </div>
              <?php endif; ?>
            </div>
          </div>
          <?php } ?>

          <hr class="horizontal dark">

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="linkedin_url" class="form-control-label">URL LinkedIn</label>
                <input type="url" name="linkedin_url" id="linkedin_url" class="form-control" value="<?= set_value('linkedin_url', $profile->url_linkedin) ?>">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="portfolio_url" class="form-control-label">URL Portfolio</label>
                <input type="url" name="portfolio_url" id="portfolio_url" class="form-control" value="<?= set_value('portfolio_url', $profile->url_portofolio) ?>">
              </div>
            </div>
          </div>

          <div class="d-flex justify-content-end mt-4">
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
          </div>
        <?= form_close() ?>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="card card-profile">
      <img src="<?= base_url('assets/img/bg-profile.jpg') ?>" alt="Profile Cover" class="card-img-top">
      <div class="row justify-content-center">
        <div class="col-4 col-lg-4 order-lg-2">
          <div class="mt-n4 mt-lg-n6 mb-4 mb-lg-0">
            <a href="javascript:;">
              <img src="<?= $user->foto_profil ? base_url('uploads/profile_pictures/' . $user->foto_profil) : base_url('assets/img/team-2.jpg') ?>" class="rounded-circle img-fluid border border-2 border-white" style="width: 100px; height: 100px; object-fit: cover;">
            </a>
          </div>
        </div>
      </div>
      <div class="card-body pt-0">
        <div class="text-center mt-4">
          <h5><?= $user->nama_lengkap ?></h5>
          <div class="h6 font-weight-300">
            <i class="ni location_pin mr-2"></i><?= $user->email ?>
          </div>
          <div class="h6 mt-2">
            <i class="ni business_briefcase-24 mr-2"></i>Pelamar
          </div>
          <div>
            <i class="ni education_hat mr-2"></i>Kelengkapan Profil: <?= $profile_completion ?>%
          </div>
        </div>
        <div class="progress mt-3" style="height: 6px;">
          <div class="progress-bar bg-gradient-<?= $profile_completion < 50 ? 'danger' : ($profile_completion < 80 ? 'warning' : 'success') ?>" role="progressbar" style="width: <?= $profile_completion ?>%;" aria-valuenow="<?= $profile_completion ?>" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
      </div>
    </div>
  </div>
</div>
