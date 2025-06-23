<div class="row">
  <div class="col-md-8 mx-auto">
    <div class="card">
      <div class="card-header pb-0">
        <div class="d-flex align-items-center">
          <p class="mb-0">Lamar Pekerjaan</p>
          <a href="<?= base_url('lowongan/detail/' . $job->id) ?>" class="btn btn-primary btn-sm ms-auto">Kembali ke Detail Lowongan</a>
        </div>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-12">
            <h5 class="mb-3"><?= $job->judul ?></h5>
            <div class="d-flex mb-4">
              <span class="badge badge-sm bg-gradient-<?= $job->jenis_pekerjaan == 'penuh_waktu' ? 'success' : ($job->jenis_pekerjaan == 'paruh_waktu' ? 'info' : ($job->jenis_pekerjaan == 'kontrak' ? 'warning' : 'secondary')) ?> me-2"><?= $job->jenis_pekerjaan == 'penuh_waktu' ? 'Penuh Waktu' : ($job->jenis_pekerjaan == 'paruh_waktu' ? 'Paruh Waktu' : ($job->jenis_pekerjaan == 'kontrak' ? 'Kontrak' : 'Magang')) ?></span>
              <span class="badge badge-sm bg-gradient-dark me-2"><?= $job->lokasi ?></span>
              <span class="badge badge-sm bg-gradient-danger">Batas: <?= date('d M Y', strtotime($job->batas_waktu)) ?></span>
            </div>
            <p class="text-sm mb-0"><?= substr(strip_tags($job->deskripsi), 0, 200) ?>...</p>
          </div>
        </div>

        <hr class="horizontal dark">

        <?= form_open_multipart('pelamar/lamar/' . $job->id) ?>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="cover_letter" class="form-control-label">Surat Lamaran</label>
                <textarea class="form-control" id="cover_letter" name="cover_letter" rows="6" placeholder="Tuliskan surat lamaran Anda di sini..."><?= set_value('cover_letter') ?></textarea>
                <?= form_error('cover_letter', '<small class="text-danger">', '</small>') ?>
                <small class="form-text text-muted">Jelaskan mengapa Anda tertarik dengan posisi ini dan mengapa Anda adalah kandidat yang tepat.</small>
              </div>
            </div>
          </div>

          <?php if (empty($document_requirements)) : ?>
          <!-- Default resume upload if no document requirements are defined -->
          <div class="row mt-3">
            <div class="col-md-12">
              <div class="form-group">
                <label for="resume" class="form-control-label">Resume</label>
                <?php if ($profile && $profile->cv) : ?>
                  <div class="d-flex align-items-center mb-3">
                    <div>
                      <i class="ni ni-single-copy-04 text-primary me-2"></i>
                      <span><?= $profile->cv ?></span>
                    </div>
                    <a href="<?= base_url('uploads/resumes/' . $profile->cv) ?>" class="btn btn-sm btn-outline-primary ms-auto" target="_blank">Lihat</a>
                  </div>
                  <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" id="use_existing_resume" name="use_existing_resume" value="1" checked>
                    <label class="form-check-label" for="use_existing_resume">
                      Gunakan resume yang sudah ada
                    </label>
                  </div>
                  <div id="new_resume_upload" style="display: none;">
                    <input class="form-control" type="file" id="resume" name="resume">
                    <small class="form-text text-muted">Format yang diizinkan: PDF, DOC, DOCX. Ukuran maksimal: 2MB.</small>
                  </div>
                <?php else : ?>
                  <input class="form-control" type="file" id="resume" name="resume">
                  <small class="form-text text-muted">Format yang diizinkan: PDF, DOC, DOCX. Ukuran maksimal: 2MB.</small>
                <?php endif; ?>
              </div>
            </div>
          </div>
          <?php else : ?>
          <!-- Document requirements defined by admin -->
          <div class="row mt-3">
            <div class="col-md-12">
              <div class="alert alert-info" role="alert">
                <h6 class="alert-heading mb-1"><i class="fas fa-info-circle me-2"></i>Dokumen Persyaratan</h6>
                <p class="mb-0 text-sm">Silakan unggah dokumen-dokumen berikut sesuai dengan persyaratan lowongan.</p>
              </div>

              <?php foreach ($document_requirements as $req) : ?>
              <div class="form-group mb-3">
                <label for="document_<?= $req->id ?>" class="form-control-label">
                  <?= $req->nama_dokumen ?>
                  <?php if ($req->wajib == 1) : ?>
                  <span class="text-danger">*</span>
                  <?php else : ?>
                  <span class="text-muted">(Opsional)</span>
                  <?php endif; ?>
                </label>

                <?php
                
                $existing_doc = null;
                if (!empty($documents)) {
                    foreach ($documents as $doc) {
                        if ($doc->jenis_dokumen == $req->jenis_dokumen) {
                            $existing_doc = $doc;
                            break;
                        }
                    }
                }

                
                if ($req->jenis_dokumen == 'cv' && $profile && $profile->cv) :
                ?>
                <div class="d-flex align-items-center mb-3">
                  <div>
                    <i class="ni ni-single-copy-04 text-primary me-2"></i>
                    <span><?= $profile->cv ?></span>
                  </div>
                  <a href="<?= base_url('uploads/cv/' . $profile->cv) ?>" class="btn btn-sm btn-outline-primary ms-auto" target="_blank">Lihat</a>
                </div>
                <div class="form-check mb-3">
                  <input class="form-check-input" type="checkbox" id="use_existing_cv_<?= $req->id ?>" name="use_existing_cv_<?= $req->id ?>" value="1" checked>
                  <label class="form-check-label" for="use_existing_cv_<?= $req->id ?>">
                    Gunakan CV yang sudah ada
                  </label>
                </div>
                <div id="new_cv_upload_<?= $req->id ?>" style="display: none;">
                  <input class="form-control" type="file" id="document_<?= $req->id ?>" name="document_<?= $req->id ?>">
                </div>
                <?php
                
                elseif ($existing_doc) :
                ?>
                <div class="d-flex align-items-center mb-3">
                  <div>
                    <i class="ni ni-single-copy-04 text-primary me-2"></i>
                    <span><?= $existing_doc->nama_dokumen ?></span>
                  </div>
                  <a href="<?= base_url('pelamar/download_dokumen_pelamar/' . $existing_doc->id) ?>" class="btn btn-sm btn-outline-primary ms-auto" target="_blank">Lihat</a>
                </div>
                <div class="form-check mb-3">
                  <input class="form-check-input" type="checkbox" id="use_existing_doc_<?= $req->id ?>" name="use_existing_doc_<?= $req->id ?>" value="<?= $existing_doc->id ?>" checked>
                  <label class="form-check-label" for="use_existing_doc_<?= $req->id ?>">
                    Gunakan <?= $req->nama_dokumen ?> yang sudah ada
                  </label>
                </div>
                <div id="new_doc_upload_<?= $req->id ?>" style="display: none;">
                  <input class="form-control" type="file" id="document_<?= $req->id ?>" name="document_<?= $req->id ?>">
                </div>
                <?php else : ?>
                <input class="form-control" type="file" id="document_<?= $req->id ?>" name="document_<?= $req->id ?>" <?= ($req->wajib == 1) ? 'required' : '' ?>>
                <?php endif; ?>

                <small class="form-text text-muted">
                  <?= $req->deskripsi ? $req->deskripsi . '<br>' : '' ?>
                  Format yang diizinkan: <?= strtoupper(str_replace('|', ', ', $req->format_diizinkan)) ?>.
                  Ukuran maksimal: <?= round($req->ukuran_maksimal / 1024, 1) ?> MB.
                </small>
              </div>
              <?php endforeach; ?>
            </div>
          </div>
          <?php endif; ?>

          <div class="row mt-4">
            <div class="col-md-12">
              <div class="form-group">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="terms_agreement" name="terms_agreement" value="1" required>
                  <label class="form-check-label" for="terms_agreement">
                    Saya menyatakan bahwa semua informasi yang saya berikan adalah benar dan akurat.
                  </label>
                </div>
              </div>
            </div>
          </div>

          <div class="d-flex justify-content-end mt-4">
            <a href="<?= base_url('lowongan/detail/' . $job->id) ?>" class="btn btn-light me-2">Batal</a>
            <button type="submit" class="btn btn-primary">Kirim Lamaran</button>
          </div>
        <?= form_close() ?>
      </div>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    
    const useExistingResumeCheckbox = document.getElementById('use_existing_resume');
    const newResumeUpload = document.getElementById('new_resume_upload');

    if (useExistingResumeCheckbox) {
      useExistingResumeCheckbox.addEventListener('change', function() {
        if (this.checked) {
          newResumeUpload.style.display = 'none';
        } else {
          newResumeUpload.style.display = 'block';
        }
      });
    }

    
    const useExistingCvCheckboxes = document.querySelectorAll('[id^="use_existing_cv_"]');

    useExistingCvCheckboxes.forEach(function(checkbox) {
      const id = checkbox.id.split('_').pop();
      const newCvUpload = document.getElementById('new_cv_upload_' + id);

      if (checkbox && newCvUpload) {
        checkbox.addEventListener('change', function() {
          if (this.checked) {
            newCvUpload.style.display = 'none';
          } else {
            newCvUpload.style.display = 'block';
          }
        });
      }
    });

    
    const useExistingDocCheckboxes = document.querySelectorAll('[id^="use_existing_doc_"]');

    useExistingDocCheckboxes.forEach(function(checkbox) {
      const id = checkbox.id.split('_').pop();
      const newDocUpload = document.getElementById('new_doc_upload_' + id);

      if (checkbox && newDocUpload) {
        checkbox.addEventListener('change', function() {
          if (this.checked) {
            newDocUpload.style.display = 'none';
          } else {
            newDocUpload.style.display = 'block';
          }
        });
      }
    });
  });
</script>
