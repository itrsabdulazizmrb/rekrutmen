<div class="row">
  <div class="col-12">
    <div class="card shadow-sm mb-4">
      <div class="card-header pb-0">
        <div class="d-flex justify-content-between align-items-center">
          <div>
            <h6 class="mb-1">Lamaran dari <?= $user->nama_lengkap ?></h6>
            <p class="text-sm mb-0">
              <i class="fa fa-info-circle text-primary" aria-hidden="true"></i>
              <span class="font-weight-bold">Daftar semua lamaran yang diajukan oleh pelamar ini</span>
            </p>
          </div>
          <div>
            <a href="<?= base_url('admin/profil_pelamar/' . $user->id) ?>" class="btn btn-sm btn-outline-primary me-2">
              <i class="fas fa-arrow-left me-2"></i> Kembali ke Profil
            </a>
            <a href="<?= base_url('admin/ekspor_lamaran_pelamar/' . $user->id) ?>" class="btn btn-sm btn-success">
              <i class="fas fa-file-excel me-2"></i> Ekspor Excel
            </a>
          </div>
        </div>
      </div>
      <div class="card-body p-0">
        <div class="table-responsive p-0" style="min-height: 300px; overflow-y: auto;">
          <?php if (empty($applications)) : ?>
            <div class="text-center py-5">
              <h4 class="text-secondary">Tidak ada lamaran yang ditemukan</h4>
              <p class="text-muted">Pelamar ini belum mengajukan lamaran pekerjaan.</p>
            </div>
          <?php else : ?>
            <table class="table align-items-center mb-0 datatable">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-4">Lowongan</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-4">Tanggal Lamaran</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-4">Status</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Penilaian</th>
                  <th class="text-secondary opacity-7"></th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($applications as $application) : ?>
                  <tr>
                    <td>
                      <div class="d-flex px-2 py-1">
                        <div class="d-flex flex-column justify-content-center">
                          <h6 class="mb-0 text-sm"><?= $application->job_title ?></h6>
                          <p class="text-xs text-secondary mb-0">
                            <span class="badge bg-gradient-<?= isset($application->job_type) ? ($application->job_type == 'full-time' ? 'primary' : ($application->job_type == 'part-time' ? 'info' : ($application->job_type == 'contract' ? 'warning' : 'secondary'))) : 'secondary' ?> badge-sm">
                              <?= isset($application->job_type) ? ($application->job_type == 'full-time' ? 'Full Time' : ($application->job_type == 'part-time' ? 'Part Time' : ($application->job_type == 'contract' ? 'Kontrak' : 'Magang'))) : 'Tidak tersedia' ?>
                            </span>
                            <span class="ms-1"><?= isset($application->location) ? $application->location : 'Tidak tersedia' ?></span>
                          </p>
                        </div>
                      </div>
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold"><?= date('d M Y', strtotime($application->tanggal_lamaran)) ?></span>
                    </td>
                    <td class="align-middle text-center">
                      <div class="dropdown">
                        <button class="btn btn-sm bg-gradient-<?= $application->status == 'pending' ? 'warning' : ($application->status == 'reviewed' ? 'info' : ($application->status == 'interview' ? 'primary' : ($application->status == 'diterima' ? 'success' : 'danger'))) ?> dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                          <?= $application->status == 'pending' ? 'Pending' : ($application->status == 'reviewed' ? 'Direview' : ($application->status == 'interview' ? 'Wawancara' : ($application->status == 'diterima' ? 'Diterima' : 'Ditolak'))) ?>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                          <li><a class="dropdown-item status-update" href="javascript:void(0)" data-id="<?= $application->id ?>" data-status="pending" data-name="<?= $user->nama_lengkap ?>">Pending</a></li>
                          <li><a class="dropdown-item status-update" href="javascript:void(0)" data-id="<?= $application->id ?>" data-status="reviewed" data-name="<?= $user->nama_lengkap ?>">Direview</a></li>
                          <li><a class="dropdown-item status-update" href="javascript:void(0)" data-id="<?= $application->id ?>" data-status="interview" data-name="<?= $user->nama_lengkap ?>">Wawancara</a></li>
                          <li><a class="dropdown-item status-update" href="javascript:void(0)" data-id="<?= $application->id ?>" data-status="diterima" data-name="<?= $user->nama_lengkap ?>">Diterima</a></li>
                          <li><hr class="dropdown-divider"></li>
                          <li><a class="dropdown-item text-danger status-update" href="javascript:void(0)" data-id="<?= $application->id ?>" data-status="ditolak" data-name="<?= $user->nama_lengkap ?>">Ditolak</a></li>
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
                          <li><a class="dropdown-item border-radius-md" href="<?= base_url('admin/atur_penilaian/' . $application->id_pekerjaan . '/' . $application->id) ?>"><i class="fas fa-tasks me-2"></i> Atur Penilaian</a></li>
                          <li><a class="dropdown-item border-radius-md" href="<?= base_url('admin/editPelamar/' . $application->id) ?>"><i class="fas fa-edit me-2"></i> Edit</a></li>
                          <li>
                            <hr class="dropdown-divider">
                          </li>
                          <li>
                            <a class="dropdown-item border-radius-md text-danger btn-delete" href="javascript:void(0)" data-id="<?= $application->id ?>" data-name="<?= $user->nama_lengkap ?>">
                              <i class="fas fa-trash me-2"></i> Hapus
                            </a>
                          </li>
                          <li><a class="dropdown-item border-radius-md" href="<?= base_url('admin/unduhCV/' . $application->id) ?>"><i class="fas fa-download me-2"></i> Unduh CV</a></li>
                          <li><a class="dropdown-item border-radius-md" href="<?= base_url('admin/cetakPelamar/' . $application->id) ?>"><i class="fas fa-print me-2"></i> Cetak Lamaran</a></li>
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
    

    
    const statusUpdateLinks = document.querySelectorAll('.status-update');
    statusUpdateLinks.forEach(function(link) {
      link.addEventListener('click', function(e) {
        e.preventDefault();

        const applicationId = this.getAttribute('data-id');
        const status = this.getAttribute('data-status');
        const applicantName = this.getAttribute('data-name');

        
        let statusText = '';
        let confirmButtonColor = '#3085d6';

        switch(status) {
          case 'pending':
            statusText = 'Pending';
            confirmButtonColor = '#fb6340'; 
            break;
          case 'reviewed':
            statusText = 'Direview';
            confirmButtonColor = '#11cdef'; 
            break;
          case 'interview':
            statusText = 'Wawancara';
            confirmButtonColor = '#5e72e4'; 
            break;
          case 'diterima':
            statusText = 'Diterima';
            confirmButtonColor = '#2dce89'; 
            break;
          case 'ditolak':
            statusText = 'Ditolak';
            confirmButtonColor = '#f5365c'; 
            break;
          default:
            statusText = status;
        }

        Swal.fire({
          title: 'Konfirmasi Perubahan Status',
          text: `Apakah Anda yakin ingin mengubah status lamaran ${applicantName} menjadi "${statusText}"?`,
          icon: status === 'ditolak' ? 'warning' : 'question',
          showCancelButton: true,
          confirmButtonColor: confirmButtonColor,
          cancelButtonColor: '#6c757d',
          confirmButtonText: 'Ya, Ubah Status',
          cancelButtonText: 'Batal'
        }).then((result) => {
          if (result.isConfirmed) {
            window.location.href = `<?= base_url('admin/perbaruiStatusPelamar/') ?>${applicationId}/${status}`;
          }
        });
      });
    });

    
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
            window.location.href = `<?= base_url('admin/hapusPelamar/') ?>${applicationId}`;
          }
        });
      });
    });
  });
</script>
