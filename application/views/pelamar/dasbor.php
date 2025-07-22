<div class="row">
  <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
    <div class="card">
      <div class="card-body p-3">
        <div class="row">
          <div class="col-8">
            <div class="numbers">
              <p class="text-sm mb-0 text-uppercase font-weight-bold">Kelengkapan Profil</p>
              <h5 class="font-weight-bolder"><?= $profile_completion ?>%</h5>
              <div class="progress mt-2" style="height: 6px;">
                <div class="progress-bar bg-gradient-<?= $profile_completion < 50 ? 'danger' : ($profile_completion < 80 ? 'warning' : 'success') ?>" role="progressbar" style="width: <?= $profile_completion ?>%;" aria-valuenow="<?= $profile_completion ?>" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
              <?php if ($profile_completion < 100) : ?>
                <p class="mb-0 mt-2">
                  <a href="<?= base_url('pelamar/profil') ?>" class="text-primary text-sm font-weight-bolder">Lengkapi profil Anda</a>
                </p>
              <?php else : ?>
                <p class="mb-0 mt-2">
                  <span class="text-success text-sm font-weight-bolder">Profil lengkap!</span>
                </p>
              <?php endif; ?>
            </div>
          </div>
          <div class="col-4 text-end">
            <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
              <i class="ni ni-single-02 text-lg opacity-10" aria-hidden="true"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
    <div class="card">
      <div class="card-body p-3">
        <div class="row">
          <div class="col-8">
            <div class="numbers">
              <p class="text-sm mb-0 text-uppercase font-weight-bold">Lamaran Saya</p>
              <h5 class="font-weight-bolder"><?= count($applications) ?></h5>
              <p class="mb-0">
                <?php
                $pending = 0;
                foreach ($applications as $app) {
                  if ($app->status == 'menunggu') $pending++;
                }
                ?>
                <span class="text-warning text-sm font-weight-bolder"><?= $pending ?></span>
                menunggu review
              </p>
            </div>
          </div>
          <div class="col-4 text-end">
            <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
              <i class="ni ni-single-copy-04 text-lg opacity-10" aria-hidden="true"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-4 col-sm-6">
    <div class="card">
      <div class="card-body p-3">
        <div class="row">
          <div class="col-8">
            <div class="numbers">
              <p class="text-sm mb-0 text-uppercase font-weight-bold">Hari Ini</p>
              <h5 class="font-weight-bolder"><?= date('d M Y') ?></h5>
              <p class="mb-0">
                <span class="text-success text-sm font-weight-bolder"><?= date('l') ?></span>
              </p>
            </div>
          </div>
          <div class="col-4 text-end">
            <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
              <i class="ni ni-calendar-grid-58 text-lg opacity-10" aria-hidden="true"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row mt-4">
  <div class="col-lg-8 mb-lg-0 mb-4">
    <div class="card">
      <div class="card-header pb-0">
        <h6>Lowongan Rekomendasi</h6>
        <p class="text-sm mb-0">
          <i class="fa fa-check text-info" aria-hidden="true"></i>
          <span class="font-weight-bold">Lowongan yang sesuai dengan profil Anda</span>
        </p>
      </div>
      <div class="card-body px-0 pt-0 pb-2">
        <div class="table-responsive p-0">
          <table class="table align-items-center mb-0">
            <thead>
              <tr>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Pekerjaan</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Lokasi</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jenis</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Batas Waktu</th>
                <th class="text-secondary opacity-7"></th>
              </tr>
            </thead>
            <tbody>
              <?php if (empty($recommended_jobs)) : ?>
                <tr>
                  <td colspan="5" class="text-center py-4">Tidak ada lowongan rekomendasi. Lengkapi profil Anda untuk mendapatkan rekomendasi yang dipersonalisasi.</td>
                </tr>
              <?php else : ?>
                <?php foreach ($recommended_jobs as $job) : ?>
                  <tr>
                    <td>
                      <div class="d-flex px-2 py-1">
                        <!-- <div>
                          <img src="<?= base_url('assets/img/small-logos/logo-company.svg') ?>" class="avatar avatar-sm me-3" alt="job">
                        </div> -->
                        <div class="d-flex flex-column justify-content-center">
                          <h6 class="mb-0 text-sm"><?= $job->judul ?></h6>
                          <!-- <p class="text-xs text-secondary mb-0"><?= $job->nama ?></p> -->
                        </div>
                      </div>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0"><?= $job->lokasi ?></p>
                    </td>
                    <td class="align-middle text-center text-sm">
                      <span class="badge badge-sm bg-gradient-<?= $job->jenis_pekerjaan == 'penuh_waktu' ? 'success' : ($job->jenis_pekerjaan == 'paruh_waktu' ? 'info' : ($job->jenis_pekerjaan == 'kontrak' ? 'warning' : 'secondary')) ?>"><?= ucfirst(str_replace('_', ' ', $job->jenis_pekerjaan)) ?></span>
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold"><?= date('d M Y', strtotime($job->batas_waktu)) ?></span>
                    </td>
                    <td class="align-middle">
                      <a href="<?= base_url('lowongan/detail/' . $job->id) ?>" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Lihat pekerjaan">
                        Lihat Detail
                      </a>
                    </td>
                  </tr>
                <?php endforeach; ?>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-4">
    <div class="card h-100">
      <div class="card-header pb-0">
        <h6>Status Lamaran</h6>
        <p class="text-sm">
          <i class="fa fa-arrow-up text-success" aria-hidden="true"></i>
          <span class="font-weight-bold">Lamaran terbaru Anda</span>
        </p>
      </div>
      <div class="card-body p-3">
        <div class="timeline timeline-one-side">
          <?php if (empty($applications)) : ?>
            <div class="timeline-block mb-3">
              <span class="timeline-step">
                <i class="ni ni-bell-55 text-info"></i>
              </span>
              <div class="timeline-content">
                <h6 class="text-dark text-sm font-weight-bold mb-0">Belum ada lamaran</h6>
                <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">Mulai melamar pekerjaan untuk melihat status lamaran Anda di sini.</p>
                <a href="<?= base_url('lowongan') ?>" class="btn btn-sm btn-primary mt-3">Jelajahi Lowongan</a>
              </div>
            </div>
          <?php else : ?>
            <?php
            $count = 0;
            foreach (array_slice($applications, 0, 5) as $app) :
              $count++;
            ?>
              <div class="timeline-block mb-3">
                <span class="timeline-step">
                  <i class="ni ni-<?= $app->status == 'menunggu' ? 'bell-55 text-warning' : ($app->status == 'direview' ? 'check-bold text-info' : ($app->status == 'seleksi' ? 'trophy text-success' : ($app->status == 'wawancara' ? 'chat-round text-primary' : ($app->status == 'diterima' ? 'check-bold text-success' : 'fat-remove text-danger')))) ?>"></i>
                </span>
                <div class="timeline-content">
                  <h6 class="text-dark text-sm font-weight-bold mb-0"><?= $app->job_title ?></h6>
                  <p class="text-secondary font-weight-bold text-xs mt-1 mb-0"><?= date('d M Y', strtotime($app->tanggal_lamaran)) ?></p>
                  <span class="badge badge-sm bg-gradient-<?= $app->status == 'menunggu' ? 'warning' : ($app->status == 'direview' ? 'info' : ($app->status == 'seleksi' ? 'success' : ($app->status == 'wawancara' ? 'primary' : ($app->status == 'diterima' ? 'success' : 'danger')))) ?> mt-2"><?= ucfirst($app->status) ?></span>
                  <a href="<?= base_url('pelamar/detail_lamaran/' . $app->id) ?>" class="btn btn-link text-primary text-sm mb-0 ps-0 ms-0 mt-2">Lihat Detail</a>
                </div>
              </div>
            <?php endforeach; ?>
            <?php if (count($applications) > 5) : ?>
              <div class="text-center mt-4">
                <a href="<?= base_url('pelamar/lamaran') ?>" class="btn btn-sm btn-primary">Lihat Semua Lamaran</a>
              </div>
            <?php endif; ?>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var profileCompletion = <?= $profile_completion ?>;
    if (profileCompletion < 80) {
        Swal.fire({
            title: 'Lengkapi Profil Anda',
            text: 'Kelengkapan profil Anda baru ' + profileCompletion + '%. Untuk melanjutkan, harap lengkapi profil Anda hingga minimal 80%.',
            icon: 'warning',
            confirmButtonText: 'Lengkapi Sekarang',
            allowOutsideClick: false,
            allowEscapeKey: false,
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '<?= base_url('pelamar/profil') ?>';
            }
        });
    }
});
</script>
