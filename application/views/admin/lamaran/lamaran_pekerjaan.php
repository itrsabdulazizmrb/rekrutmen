<div class="row">
  <div class="col-12">
    <div class="card mb-4">
      <div class="card-header pb-0">
        <div class="d-flex justify-content-between align-items-center">
          <h6>Lamaran untuk "<?= $job->judul ?>"</h6>
          <div>
            <a href="<?= base_url('admin/lowongan') ?>" class="btn btn-sm btn-outline-primary me-2">
              <i class="fas fa-arrow-left me-2"></i> Kembali ke Daftar Lowongan
            </a>
            <a href="<?= base_url('admin/ekspor_lamaran_pekerjaan/' . $job->id) ?>" class="btn btn-sm btn-success">
              <i class="fas fa-file-excel me-2"></i> Ekspor Excel
            </a>
          </div>
        </div>
        <p class="text-sm mb-0">
          <i class="fa fa-info-circle text-primary" aria-hidden="true"></i>
          <span class="font-weight-bold">Kelola semua lamaran untuk lowongan ini</span>
        </p>
      </div>
      <div class="card-body px-0 pt-0 pb-2">
        <div class="table-responsive p-0">
          <?php if (empty($applications)) : ?>
            <div class="text-center py-5">
              <h4 class="text-secondary">Tidak ada lamaran yang ditemukan</h4>
              <p class="text-muted">Belum ada pelamar untuk lowongan ini.</p>
            </div>
          <?php else : ?>
            <table class="table align-items-center mb-0 datatable">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Pelamar</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tanggal Lamaran</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Penilaian</th>
                  <th class="text-secondary opacity-7"></th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($applications as $application) : ?>
                  <tr>
                    <td>
                      <div class="d-flex px-2 py-1">
                        <div>
                          <?php if ($application->profile_picture) : ?>
                            <img src="<?= base_url('uploads/profile/' . $application->profile_picture) ?>" class="avatar avatar-sm me-3" alt="user1">
                          <?php else : ?>
                            <img src="<?= base_url('assets/img/default-avatar.png') ?>" class="avatar avatar-sm me-3" alt="user1">
                          <?php endif; ?>
                        </div>
                        <div class="d-flex flex-column justify-content-center">
                          <h6 class="mb-0 text-sm"><?= $application->applicant_name ?></h6>
                          <p class="text-xs text-secondary mb-0"><?= $application->applicant_email ?></p>
                        </div>
                      </div>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0"><?= date('d M Y', strtotime($application->application_date)) ?></p>
                      <p class="text-xs text-secondary mb-0"><?= date('H:i', strtotime($application->application_date)) ?></p>
                    </td>
                    <td class="align-middle text-center text-sm">
                      <div class="dropdown">
                        <a href="#" class="badge badge-sm bg-gradient-<?= $application->status == 'pending' ? 'warning' : ($application->status == 'reviewed' ? 'info' : ($application->status == 'interview' ? 'primary' : ($application->status == 'diterima' ? 'success' : 'danger'))) ?> dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                          <?= $application->status == 'pending' ? 'Pending' : ($application->status == 'reviewed' ? 'Direview' : ($application->status == 'interview' ? 'Wawancara' : ($application->status == 'diterima' ? 'Diterima' : 'Ditolak'))) ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end px-2 py-3" aria-labelledby="dropdownMenuButton">
                          <li><a class="dropdown-item" href="<?= base_url('admin/perbarui_status_lamaran/' . $application->id . '/pending') ?>">Pending</a></li>
                          <li><a class="dropdown-item" href="<?= base_url('admin/perbarui_status_lamaran/' . $application->id . '/reviewed') ?>">Direview</a></li>
                          <li><a class="dropdown-item" href="<?= base_url('admin/perbarui_status_lamaran/' . $application->id . '/interview') ?>">Wawancara</a></li>
                          <li><a class="dropdown-item text-success" href="<?= base_url('admin/perbarui_status_lamaran/' . $application->id . '/diterima') ?>">Diterima</a></li>
                          <li><a class="dropdown-item text-danger" href="<?= base_url('admin/perbarui_status_lamaran/' . $application->id . '/ditolak') ?>">Ditolak</a></li>
                        </ul>
                      </div>
                    </td>
                    <td class="align-middle text-center">
                      <?php
                      
                      $assessment_count = $this->model_penilaian->hitung_penilaian_pelamar($application->id);
                      $completed_count = $this->model_penilaian->hitung_penilaian_selesai($application->id);
                      ?>
                      <?php if ($assessment_count > 0) : ?>
                        <span class="badge badge-sm bg-gradient-<?= $completed_count == $assessment_count ? 'success' : 'warning' ?>">
                          <?= $completed_count ?>/<?= $assessment_count ?> Selesai
                        </span>
                      <?php else : ?>
                        <span class="badge badge-sm bg-gradient-secondary">Tidak Ada</span>
                      <?php endif; ?>
                    </td>
                    <td class="align-middle">
                      <div class="dropdown">
                        <a href="#" class="text-secondary font-weight-bold text-xs" data-bs-toggle="dropdown" aria-expanded="false">
                          <i class="fas fa-ellipsis-v"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end px-2 py-3" aria-labelledby="dropdownMenuButton">
                          <li><a class="dropdown-item border-radius-md" href="<?= base_url('admin/detail_lamaran/' . $application->id) ?>"><i class="fas fa-eye me-2"></i> Lihat Detail</a></li>
                          <li><a class="dropdown-item border-radius-md" href="<?= base_url('admin/atur_penilaian/' . $application->job_id . '/' . $application->id) ?>"><i class="fas fa-tasks me-2"></i> Atur Penilaian</a></li>
                          <li><a class="dropdown-item border-radius-md" href="<?= base_url('admin/unduhCV/' . $application->id) ?>"><i class="fas fa-download me-2"></i> Unduh CV</a></li>
                          <li>
                            <hr class="dropdown-divider">
                          </li>
                          <li>
                            <a class="dropdown-item border-radius-md text-danger btn-delete" href="javascript:void(0)" data-id="<?= $application->id ?>" data-name="<?= $application->applicant_name ?>">
                              <i class="fas fa-trash me-2"></i> Hapus
                            </a>
                          </li>
                        </ul>
                      </div>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          <?php endif; ?>
        </div>
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

        const applicationId = this.getAttribute('data-id');
        const applicantName = this.getAttribute('data-name');

        Swal.fire({
          title: 'Konfirmasi Hapus',
          text: `Apakah Anda yakin ingin menghapus lamaran dari ${applicantName}? Tindakan ini tidak dapat dibatalkan.`,
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#f5365c',
          cancelButtonColor: '#3085d6',
          confirmButtonText: 'Ya, Hapus!',
          cancelButtonText: 'Batal'
        }).then((result) => {
          if (result.isConfirmed) {
            window.location.href = `<?= base_url('admin/hapus_lamaran/') ?>${applicationId}`;
          }
        });
      });
    });
  });
</script>
