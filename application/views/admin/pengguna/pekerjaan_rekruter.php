<div class="row">
  <div class="col-12">
    <div class="card mb-4">
      <div class="card-header pb-0">
        <div class="d-flex justify-content-between align-items-center">
          <div>
            <h6 class="mb-1">Lowongan yang Dikelola oleh <?= $user->nama_lengkap ?></h6>
            <p class="text-sm mb-0">
              <i class="fa fa-info-circle text-primary" aria-hidden="true"></i>
              <span class="font-weight-bold">Daftar semua lowongan yang dibuat oleh rekruter ini</span>
            </p>
          </div>
          <a href="<?= base_url('admin/edit_pengguna/' . $user->id) ?>" class="btn btn-sm btn-secondary">
            <i class="fas fa-arrow-left me-2"></i> Kembali
          </a>
        </div>
      </div>
      <div class="card-body px-0 pt-0 pb-2">
        <?php if (empty($jobs)) : ?>
          <div class="text-center py-4">
            <p class="text-muted">Belum ada lowongan yang dikelola oleh rekruter ini.</p>
          </div>
        <?php else : ?>
          <div class="table-responsive p-0">
            <table class="table align-items-center mb-0 datatable">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Lowongan</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Kategori</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Batas Waktu</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Pelamar</th>
                  <th class="text-secondary opacity-7"></th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($jobs as $job) : ?>
                  <tr>
                    <td>
                      <div class="d-flex px-2 py-1">
                        <div class="d-flex flex-column justify-content-center">
                          <h6 class="mb-0 text-sm"><?= $job->judul ?></h6>
                          <p class="text-xs text-secondary mb-0"><?= $job->lokasi ?></p>
                        </div>
                      </div>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0"><?= $job->nama_kategori ?? 'Tidak Dikategorikan' ?></p>
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold"><?= date('d M Y', strtotime($job->batas_waktu)) ?></span>
                    </td>
                    <td class="align-middle text-center text-sm">
                      <span class="badge badge-sm bg-gradient-<?= $job->status == 'active' ? 'success' : ($job->status == 'draft' ? 'secondary' : 'danger') ?>"><?= $job->status == 'active' ? 'Aktif' : ($job->status == 'draft' ? 'Draft' : 'Tidak Aktif') ?></span>
                    </td>
                    <td class="align-middle text-center">
                      <?php
                      $applicant_count = $this->model_lamaran->hitung_lamaran_berdasarkan_lowongan($job->id);
                      ?>
                      <a href="<?= base_url('admin/lamaran_lowongan/' . $job->id) ?>" class="text-secondary font-weight-bold text-xs">
                        <?= $applicant_count ?> Pelamar
                      </a>
                    </td>
                    <td class="align-middle">
                      <div class="dropdown">
                        <a href="#" class="text-secondary font-weight-bold text-xs" data-bs-toggle="dropdown" aria-expanded="false">
                          <i class="fas fa-ellipsis-v"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end px-2 py-3" aria-labelledby="dropdownMenuButton">
                          <li><a class="dropdown-item border-radius-md" href="<?= base_url('admin/edit_lowongan/' . $job->id) ?>"><i class="fas fa-edit me-2"></i> Edit</a></li>
                          <li><a class="dropdown-item border-radius-md" href="<?= base_url('admin/lamaran_lowongan/' . $job->id) ?>"><i class="fas fa-users me-2"></i> Lihat Pelamar</a></li>
                          <li>
                            <hr class="dropdown-divider">
                          </li>
                          <li><a class="dropdown-item border-radius-md text-danger btn-delete" href="javascript:void(0)" data-id="<?= $job->id ?>" data-name="<?= $job->judul ?>"><i class="fas fa-trash me-2"></i> Hapus</a></li>
                        </ul>
                      </div>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    
    const deleteButtons = document.querySelectorAll('.btn-delete');
    deleteButtons.forEach(function(button) {
      button.addEventListener('click', function(e) {
        e.preventDefault();

        const jobId = this.getAttribute('data-id');
        const jobName = this.getAttribute('data-name');

        Swal.fire({
          title: 'Konfirmasi Hapus',
          text: `Apakah Anda yakin ingin menghapus lowongan "${jobName}"? Tindakan ini tidak dapat dibatalkan.`,
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#f5365c',
          cancelButtonColor: '#3085d6',
          confirmButtonText: 'Ya, Hapus!',
          cancelButtonText: 'Batal'
        }).then((result) => {
          if (result.isConfirmed) {
            window.location.href = `<?= base_url('admin/hapus_lowongan/') ?>${jobId}`;
          }
        });
      });
    });
  });
</script>
