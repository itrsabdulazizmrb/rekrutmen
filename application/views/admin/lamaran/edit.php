<div class="row">
  <div class="col-12">
    <div class="card mb-4">
      <div class="card-header pb-0">
        <div class="d-flex justify-content-between align-items-center">
          <h6>Edit Lamaran</h6>
          <a href="<?= base_url('admin/lamaran') ?>" class="btn btn-sm btn-outline-primary">
            <i class="fas fa-arrow-left me-2"></i> Kembali ke Daftar Lamaran
          </a>
        </div>
        <p class="text-sm mb-0">
          <i class="fa fa-info-circle text-primary" aria-hidden="true"></i>
          <span class="font-weight-bold">Edit informasi lamaran</span>
        </p>
      </div>
      <div class="card-body">
        <?= form_open('admin/edit_lamaran/' . $application->id, ['class' => 'needs-validation']) ?>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="job_id" class="form-control-label">Lowongan <span class="text-danger">*</span></label>
                <select class="form-control" id="job_id" name="job_id" required>
                  <option value="">Pilih Lowongan</option>
                  <?php foreach ($jobs as $job) : ?>
                    <option value="<?= $job->id ?>" <?= set_select('job_id', $job->id, ($application->id_pekerjaan == $job->id)) ?>><?= $job->judul ?></option>
                  <?php endforeach; ?>
                </select>
                <?= form_error('job_id', '<small class="text-danger">', '</small>') ?>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="status" class="form-control-label">Status <span class="text-danger">*</span></label>
                <select class="form-control" id="status" name="status" required>
                  <option value="">Pilih Status</option>
                  <option value="pending" <?= set_select('status', 'pending', ($application->status == 'pending')) ?>>Pending</option>
                  <option value="reviewed" <?= set_select('status', 'reviewed', ($application->status == 'reviewed')) ?>>Direview</option>
                  <option value="interview" <?= set_select('status', 'interview', ($application->status == 'interview')) ?>>Wawancara</option>
                  <option value="diterima" <?= set_select('status', 'diterima', ($application->status == 'diterima')) ?>>Diterima</option>
                  <option value="ditolak" <?= set_select('status', 'ditolak', ($application->status == 'ditolak')) ?>>Ditolak</option>
                </select>
                <?= form_error('status', '<small class="text-danger">', '</small>') ?>
              </div>
            </div>
          </div>
          
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="catatan_admin" class="form-control-label">Catatan Admin</label>
                <textarea class="form-control" id="catatan_admin" name="catatan_admin" rows="4" placeholder="Tambahkan catatan tentang lamaran ini..."><?= set_value('catatan_admin', $application->catatan_admin) ?></textarea>
                <?= form_error('catatan_admin', '<small class="text-danger">', '</small>') ?>
              </div>
            </div>
          </div>
          
          <div class="row">
            <div class="col-md-12">
              <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="kirim_notifikasi" name="kirim_notifikasi" value="1" <?= set_checkbox('kirim_notifikasi', '1', true) ?>>
                <label class="form-check-label" for="kirim_notifikasi">Kirim notifikasi ke pelamar</label>
              </div>
            </div>
          </div>
          
          <div class="row mt-4">
            <div class="col-md-12">
              <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
              <a href="<?= base_url('admin/lamaran') ?>" class="btn btn-secondary">Batal</a>
            </div>
          </div>
        <?= form_close() ?>
      </div>
    </div>
  </div>
</div>

<div class="row mt-4">
  <div class="col-md-6">
    <div class="card">
      <div class="card-header pb-0">
        <h6>Informasi Pelamar</h6>
      </div>
      <div class="card-body">
        <p class="text-sm mb-1">
          <strong>Nama:</strong> <?= $applicant->nama_lengkap ?>
        </p>
        <p class="text-sm mb-1">
          <strong>Email:</strong> <?= $applicant->email ?>
        </p>
        <p class="text-sm mb-1">
          <strong>Telepon:</strong> <?= $applicant->telepon ?? 'Tidak tersedia' ?>
        </p>
        <p class="text-sm mb-1">
          <strong>Tanggal Lamaran:</strong> <?= date('d M Y H:i', strtotime($application->tanggal_lamaran)) ?>
        </p>
        <div class="d-flex justify-content-center mt-3">
          <a href="<?= base_url('admin/profil_pelamar/' . $applicant->id) ?>" class="btn btn-sm btn-outline-primary">Lihat Profil Lengkap</a>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-6">
    <div class="card">
      <div class="card-header pb-0">
        <h6>Informasi Lowongan</h6>
      </div>
      <div class="card-body">
        <p class="text-sm mb-1">
          <strong>Judul:</strong> <?= $job->judul ?>
        </p>
        <p class="text-sm mb-1">
          <strong>Lokasi:</strong> <?= $job->lokasi ?>
        </p>
        <p class="text-sm mb-1">
          <strong>Tipe:</strong> <?= $job->jenis_pekerjaan ?>
        </p>
        <p class="text-sm mb-1">
          <strong>Batas Waktu:</strong> <?= date('d M Y', strtotime($job->batas_waktu)) ?>
        </p>
        <div class="d-flex justify-content-center mt-3">
          <a href="<?= base_url('admin/edit_lowongan/' . $job->id) ?>" class="btn btn-sm btn-outline-primary">Lihat Detail Lowongan</a>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    
    const statusSelect = document.getElementById('status');
    
    function updateStatusColor() {
      const status = statusSelect.value;
      statusSelect.className = 'form-control';
      
      if (status === 'pending') {
        statusSelect.classList.add('border-warning', 'text-warning');
      } else if (status === 'reviewed') {
        statusSelect.classList.add('border-info', 'text-info');
      } else if (status === 'interview') {
        statusSelect.classList.add('border-primary', 'text-primary');
      } else if (status === 'diterima') {
        statusSelect.classList.add('border-success', 'text-success');
      } else if (status === 'ditolak') {
        statusSelect.classList.add('border-danger', 'text-danger');
      }
    }
    
    statusSelect.addEventListener('change', updateStatusColor);
    updateStatusColor(); 
  });
</script>
