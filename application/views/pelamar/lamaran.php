<div class="row">
  <div class="col-12">
    <div class="card mb-4">
      <div class="card-header pb-0">
        <h6>Lamaran Saya</h6>
        <p class="text-sm mb-0">
          <i class="fa fa-info-circle text-primary" aria-hidden="true"></i>
          <span class="font-weight-bold">Pantau semua lamaran pekerjaan Anda</span>
        </p>
      </div>
      <div class="card-body px-0 pt-0 pb-2">
        <div class="table-responsive p-0">
          <?php if (empty($applications)) : ?>
            <div class="text-center py-5">
              <h4 class="text-secondary">Belum ada lamaran</h4>
              <p class="text-muted">Anda belum melamar pekerjaan apapun.</p>
              <a href="<?= base_url('lowongan') ?>" class="btn btn-primary mt-3">Telusuri Lowongan</a>
            </div>
          <?php else : ?>
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Lowongan</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Lokasi</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jenis</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal Melamar</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                  <th class="text-secondary opacity-7">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($applications as $application) : ?>
                  <tr>
                    <td>
                      <div class="d-flex px-2 py-1">
                        <div>
                          <!-- <img src="<?= base_url('assets/img/small-logos/logo-company.svg') ?>" class="avatar avatar-sm me-3" alt="job"> -->
                        </div>
                        <div class="d-flex flex-column justify-content-center">
                          <h6 class="mb-0 text-sm"><?= $application->job_title ?></h6>
                        </div>
                      </div>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0"><?= $application->location ?></p>
                    </td>
                    <td class="align-middle text-center text-sm">
                      <span class="badge badge-sm bg-gradient-<?= $application->job_type == 'full-time' ? 'success' : ($application->job_type == 'part-time' ? 'info' : ($application->job_type == 'contract' ? 'warning' : 'secondary')) ?>"><?= ucfirst(str_replace('-', ' ', $application->job_type)) ?></span>
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold"><?= date('d M Y', strtotime($application->tanggal_lamaran)) ?></span>
                    </td>
                    <td class="align-middle text-center text-sm">
                      <span class="badge badge-sm bg-gradient-<?= $application->status == 'menunggu' ? 'warning' : ($application->status == 'direview' ? 'info' : ($application->status == 'seleksi' ? 'success' : ($application->status == 'wawancara' ? 'primary' : ($application->status == 'ditawari' ? 'warning' : ($application->status == 'diterima' ? 'success' : 'danger'))))) ?>"><?= ucfirst($application->status) ?></span>
                    </td>
                    <td class="align-middle">
                        <a href="<?= base_url('pelamar/detail-lamaran/' . $application->id) ?>" class="btn btn-sm btn-outline-primary" data-toggle="tooltip" data-original-title="Lihat detail">
    <i class="fas fa-fw fa-eye"></i> Lihat Detail
  </a>
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

<div class="row mt-4">
  <div class="col-12">
    <div class="card">
      <div class="card-header pb-0">
        <h6>Panduan Status Lamaran</h6>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-6">
            <div class="d-flex align-items-center mb-3">
              <span class="badge badge-sm bg-gradient-warning me-3">Menunggu</span>
              <p class="text-xs mb-0">Lamaran Anda telah dikirim dan sedang menunggu untuk ditinjau.</p>
            </div>
            <div class="d-flex align-items-center mb-3">
              <span class="badge badge-sm bg-gradient-info me-3">Direview</span>
              <p class="text-xs mb-0">Lamaran Anda telah ditinjau oleh tim rekrutmen.</p>
            </div>
            <div class="d-flex align-items-center mb-3">
              <span class="badge badge-sm bg-gradient-success me-3">Seleksi</span>
              <p class="text-xs mb-0">Anda telah masuk dalam tahap seleksi untuk proses rekrutmen selanjutnya.</p>
            </div>
          </div>
          <div class="col-md-6">
            <div class="d-flex align-items-center mb-3">
              <span class="badge badge-sm bg-gradient-primary me-3">Wawancara</span>
              <p class="text-xs mb-0">Anda telah menyelesaikan tahap wawancara.</p>
            </div>
            <div class="d-flex align-items-center mb-3">
              <span class="badge badge-sm bg-gradient-warning me-3">Ditawari</span>
              <p class="text-xs mb-0">Anda telah ditawari posisi tersebut.</p>
            </div>
            <div class="d-flex align-items-center mb-3">
              <span class="badge badge-sm bg-gradient-success me-3">Diterima</span>
              <p class="text-xs mb-0">Anda telah menerima tawaran dan telah diterima bekerja.</p>
            </div>
            <div class="d-flex align-items-center">
              <span class="badge badge-sm bg-gradient-danger me-3">Ditolak</span>
              <p class="text-xs mb-0">Lamaran Anda tidak terpilih untuk posisi ini.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
