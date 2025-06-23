<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
          <div class="d-flex align-items-center">
            <h6 class="mb-0">Edit Dokumen Lowongan</h6>
            <a href="<?= base_url('admin/dokumen_lowongan/' . $document->id_lowongan) ?>" class="btn btn-sm btn-secondary ms-auto">Kembali</a>
          </div>
        </div>
        <div class="card-body">
          <?= form_open('admin/edit_dokumen_lowongan/' . $document->id) ?>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="jenis_dokumen" class="form-control-label">Jenis Dokumen</label>
                  <select class="form-control" id="jenis_dokumen" name="jenis_dokumen" required>
                    <option value="">Pilih Jenis Dokumen</option>
                    <option value="ktp" <?= $document->jenis_dokumen == 'ktp' ? 'selected' : '' ?>>KTP (Kartu Tanda Penduduk)</option>
                    <option value="ijazah" <?= $document->jenis_dokumen == 'ijazah' ? 'selected' : '' ?>>Ijazah</option>
                    <option value="cv" <?= $document->jenis_dokumen == 'cv' ? 'selected' : '' ?>>CV / Resume</option>
                    <option value="transkrip" <?= $document->jenis_dokumen == 'transkrip' ? 'selected' : '' ?>>Transkrip Nilai</option>
                    <option value="sertifikat" <?= $document->jenis_dokumen == 'sertifikat' ? 'selected' : '' ?>>Sertifikat</option>
                    <option value="foto" <?= $document->jenis_dokumen == 'foto' ? 'selected' : '' ?>>Pas Foto</option>
                    <option value="lainnya" <?= $document->jenis_dokumen == 'lainnya' ? 'selected' : '' ?>>Lainnya</option>
                  </select>
                  <?= form_error('jenis_dokumen', '<small class="text-danger">', '</small>') ?>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="nama_dokumen" class="form-control-label">Nama Dokumen</label>
                  <input class="form-control" type="text" id="nama_dokumen" name="nama_dokumen" value="<?= $document->nama_dokumen ?>" required>
                  <?= form_error('nama_dokumen', '<small class="text-danger">', '</small>') ?>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="wajib" class="form-control-label">Wajib</label>
                  <select class="form-control" id="wajib" name="wajib" required>
                    <option value="1" <?= $document->wajib == 1 ? 'selected' : '' ?>>Ya</option>
                    <option value="0" <?= $document->wajib == 0 ? 'selected' : '' ?>>Tidak</option>
                  </select>
                  <?= form_error('wajib', '<small class="text-danger">', '</small>') ?>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="format_diizinkan" class="form-control-label">Format Diizinkan</label>
                  <input class="form-control" type="text" id="format_diizinkan" name="format_diizinkan" value="<?= $document->format_diizinkan ?>" required>
                  <small class="text-muted">Pisahkan dengan tanda | (pipe). Contoh: pdf|doc|docx</small>
                  <?= form_error('format_diizinkan', '<small class="text-danger">', '</small>') ?>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="ukuran_maksimal" class="form-control-label">Ukuran Maksimal (KB)</label>
                  <input class="form-control" type="number" id="ukuran_maksimal" name="ukuran_maksimal" value="<?= $document->ukuran_maksimal ?>" required>
                  <small class="text-muted">Dalam kilobyte (KB). 1 MB = 1024 KB</small>
                  <?= form_error('ukuran_maksimal', '<small class="text-danger">', '</small>') ?>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="deskripsi" class="form-control-label">Deskripsi</label>
              <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3"><?= $document->deskripsi ?></textarea>
              <small class="text-muted">Petunjuk atau informasi tambahan untuk pelamar</small>
              <?= form_error('deskripsi', '<small class="text-danger">', '</small>') ?>
            </div>
            <div class="d-flex justify-content-end mt-4">
              <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
          <?= form_close() ?>
        </div>
      </div>
    </div>
  </div>
</div>
