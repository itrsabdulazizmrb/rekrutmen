<div class="row">
  <div class="col-md-8">
    <div class="card">
      <div class="card-header pb-0">
        <div class="d-flex align-items-center">
          <p class="mb-0">Detail Lamaran</p>
          <a href="<?= base_url('pelamar/lamaran') ?>" class="btn btn-primary btn-sm ms-auto">Kembali ke Lamaran</a>
        </div>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-12">
            <h6 class="mb-3"><?= $job->judul ?></h6>
            <div class="d-flex mb-4">
              <span class="badge badge-sm bg-gradient-<?= $job->jenis_pekerjaan == 'penuh_waktu' ? 'success' : ($job->jenis_pekerjaan == 'paruh_waktu' ? 'info' : ($job->jenis_pekerjaan == 'kontrak' ? 'warning' : 'secondary')) ?> me-2"><?= ucfirst(str_replace('_', ' ', $job->jenis_pekerjaan)) ?></span>
              <span class="text-sm me-3"><i class="ni ni-pin-3 me-1"></i> <?= $job->lokasi ?></span>
              <span class="text-sm"><i class="ni ni-calendar-grid-58 me-1"></i> Dilamar pada <?= date('d M Y', strtotime($application->tanggal_lamaran)) ?></span>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <div class="timeline timeline-one-side">
              <div class="timeline-block mb-3">
                <span class="timeline-step">
                  <i class="ni ni-send text-primary"></i>
                </span>
                <div class="timeline-content">
                  <h6 class="text-dark text-sm font-weight-bold mb-0">Lamaran Dikirim</h6>
                  <p class="text-secondary font-weight-bold text-xs mt-1 mb-0"><?= date('d M Y H:i', strtotime($application->tanggal_lamaran)) ?></p>
                </div>
              </div>

              <?php if ($application->status != 'menunggu') : ?>
                <div class="timeline-block mb-3">
                  <span class="timeline-step">
                    <i class="ni ni-check-bold text-info"></i>
                  </span>
                  <div class="timeline-content">
                    <h6 class="text-dark text-sm font-weight-bold mb-0">Lamaran Ditinjau</h6>
                    <p class="text-secondary font-weight-bold text-xs mt-1 mb-0"><?= date('d M Y', strtotime($application->diperbarui_pada)) ?></p>
                  </div>
                </div>
              <?php endif; ?>

              <?php if (in_array($application->status, ['seleksi', 'wawancara', 'ditawari', 'diterima'])) : ?>
                <div class="timeline-block mb-3">
                  <span class="timeline-step">
                    <i class="ni ni-trophy text-success"></i>
                  </span>
                  <div class="timeline-content">
                    <h6 class="text-dark text-sm font-weight-bold mb-0">Masuk Seleksi</h6>
                    <p class="text-secondary font-weight-bold text-xs mt-1 mb-0"><?= date('d M Y', strtotime($application->diperbarui_pada)) ?></p>
                  </div>
                </div>
              <?php endif; ?>

              <?php if (in_array($application->status, ['wawancara', 'ditawari', 'diterima'])) : ?>
                <div class="timeline-block mb-3">
                  <span class="timeline-step">
                    <i class="ni ni-chat-round text-primary"></i>
                  </span>
                  <div class="timeline-content">
                    <h6 class="text-dark text-sm font-weight-bold mb-0">Wawancara</h6>
                    <p class="text-secondary font-weight-bold text-xs mt-1 mb-0"><?= date('d M Y', strtotime($application->diperbarui_pada)) ?></p>
                  </div>
                </div>
              <?php endif; ?>

              <?php if (in_array($application->status, ['ditawari', 'diterima'])) : ?>
                <div class="timeline-block mb-3">
                  <span class="timeline-step">
                    <i class="ni ni-tie-bow text-warning"></i>
                  </span>
                  <div class="timeline-content">
                    <h6 class="text-dark text-sm font-weight-bold mb-0">Pekerjaan Ditawarkan</h6>
                    <p class="text-secondary font-weight-bold text-xs mt-1 mb-0"><?= date('d M Y', strtotime($application->diperbarui_pada)) ?></p>
                  </div>
                </div>
              <?php endif; ?>

              <?php if ($application->status == 'diterima') : ?>
                <div class="timeline-block mb-3">
                  <span class="timeline-step">
                    <i class="ni ni-check-bold text-success"></i>
                  </span>
                  <div class="timeline-content">
                    <h6 class="text-dark text-sm font-weight-bold mb-0">Diterima</h6>
                    <p class="text-secondary font-weight-bold text-xs mt-1 mb-0"><?= date('d M Y', strtotime($application->diperbarui_pada)) ?></p>
                  </div>
                </div>
              <?php endif; ?>

              <?php if ($application->status == 'ditolak') : ?>
                <div class="timeline-block mb-3">
                  <span class="timeline-step">
                    <i class="ni ni-fat-remove text-danger"></i>
                  </span>
                  <div class="timeline-content">
                    <h6 class="text-dark text-sm font-weight-bold mb-0">Lamaran Ditolak</h6>
                    <p class="text-secondary font-weight-bold text-xs mt-1 mb-0"><?= date('d M Y', strtotime($application->diperbarui_pada)) ?></p>
                    <p class="text-sm mt-2 mb-0">Terima kasih atas minat Anda. Kami mendorong Anda untuk melamar posisi lain yang sesuai dengan keterampilan dan pengalaman Anda.</p>
                  </div>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </div>

        <hr class="horizontal dark">

        <div class="row">
          <div class="col-md-12">
            <h6 class="mb-3">Surat Lamaran</h6>
            <div class="p-3 bg-light rounded">
              <?= nl2br($application->surat_lamaran) ?>
            </div>
          </div>
        </div>

        <hr class="horizontal dark">

        <div class="row">
          <div class="col-md-12">
            <h6 class="mb-3">Dokumen Lamaran</h6>

            <?php if (!empty($documents)) : ?>
              <div class="table-responsive">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Dokumen</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Jenis</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Ukuran</th>
                      <th class="text-secondary opacity-7"></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($documents as $doc) : ?>
                      <tr>
                        <td>
                          <div class="d-flex px-2 py-1">
                            <div>
                              <i class="ni ni-single-copy-04 text-primary me-3"></i>
                            </div>
                            <div class="d-flex flex-column justify-content-center">
                              <h6 class="mb-0 text-sm"><?= $doc->nama_dokumen ?? $doc->jenis_dokumen ?></h6>
                            </div>
                          </div>
                        </td>
                        <td>
                          <p class="text-xs font-weight-bold mb-0"><?= strtoupper(pathinfo($doc->nama_file, PATHINFO_EXTENSION)) ?></p>
                        </td>
                        <td>
                          <p class="text-xs font-weight-bold mb-0"><?= round($doc->ukuran_file / 1024, 2) ?> MB</p>
                        </td>
                        <td class="align-middle">
                          <a href="<?= base_url('pelamar/view_dokumen/' . $doc->id) ?>" class="btn btn-link text-secondary mb-0" target="_blank">
                            <i class="fa fa-eye text-xs"></i> Lihat
                          </a>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            <?php elseif ($application->cv) : ?>
              <!-- Legacy support for old applications with just a CV -->
              <a href="<?= base_url('uploads/cv/' . $application->cv) ?>" class="btn btn-outline-primary btn-sm" target="_blank">
                <i class="ni ni-single-copy-04 me-2"></i> Lihat CV
              </a>
            <?php else : ?>
              <p class="text-muted">Tidak ada dokumen yang dilampirkan.</p>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-4">
    <div class="card">
      <div class="card-header pb-0">
        <h6>Status Lamaran</h6>
      </div>
      <div class="card-body">
        <div class="d-flex align-items-center">
          <div>
            <span class="badge badge-lg bg-gradient-<?= $application->status == 'menunggu' ? 'warning' : ($application->status == 'direview' ? 'info' : ($application->status == 'seleksi' ? 'success' : ($application->status == 'wawancara' ? 'primary' : ($application->status == 'ditawari' ? 'warning' : ($application->status == 'diterima' ? 'success' : 'danger'))))) ?> mb-3"><?= ucfirst($application->status) ?></span>
          </div>
        </div>
        <p class="text-sm">
          <?php if ($application->status == 'menunggu') : ?>
            Lamaran Anda sedang dalam proses peninjauan. Kami akan memberi tahu Anda setelah ada pembaruan.
          <?php elseif ($application->status == 'direview') : ?>
            Lamaran Anda telah ditinjau oleh tim rekrutmen kami. Kami akan menghubungi Anda segera untuk langkah selanjutnya.
          <?php elseif ($application->status == 'seleksi') : ?>
            Selamat! Anda telah masuk dalam tahap seleksi untuk posisi ini. Kami akan menghubungi Anda segera untuk menjadwalkan wawancara.
            <?php if (!empty($assessments)) : ?>
              <div class="mt-3">
                <?php if (count($assessments) == 1 && ($assessments[0]->status == 'not_started' || $assessments[0]->status == 'in_progress')) : ?>
                  <a href="<?= base_url('pelamar/ikuti_penilaian/' . $assessments[0]->assessment_id . '/' . $assessments[0]->application_id) ?>" class="btn btn-primary btn-sm">Ikuti Seleksi</a>
                <?php else : ?>
                  <a href="<?= base_url('pelamar/penilaian') ?>" class="btn btn-primary btn-sm">Lihat Seleksi</a>
                <?php endif; ?>
              </div>
            <?php endif; ?>
          <?php elseif ($application->status == 'wawancara') : ?>
            Anda telah menyelesaikan tahap wawancara. Kami sedang mengevaluasi semua kandidat dan akan segera menghubungi Anda.
          <?php elseif ($application->status == 'ditawari') : ?>
            Selamat! Anda telah ditawari posisi ini. Silakan periksa email Anda untuk detail penawaran.
          <?php elseif ($application->status == 'diterima') : ?>
            Selamat! Anda telah diterima untuk posisi ini. Selamat bergabung dengan tim kami!
          <?php elseif ($application->status == 'ditolak') : ?>
            Kami menghargai minat Anda pada posisi ini. Sayangnya, kami telah memutuskan untuk melanjutkan dengan kandidat lain saat ini.
          <?php endif; ?>
        </p>
      </div>
    </div>

    <?php if (!empty($assessments)) : ?>
      <div class="card mt-4">
        <div class="card-header pb-0">
          <h6>Penilaian</h6>
        </div>
        <div class="card-body">
          <?php foreach ($assessments as $assessment) : ?>
            <div class="d-flex align-items-center mb-3">
              <div>
                <div class="icon icon-shape icon-sm bg-gradient-info shadow text-center">
                  <i class="ni ni-ruler-pencil text-white opacity-10"></i>
                </div>
              </div>
              <div class="ms-3">
                <h6 class="mb-0 text-sm"><?= $assessment->assessment_title ?></h6>
                <p class="text-xs text-secondary mb-0"><?= $assessment->type_name ?></p>
                <?php if ($assessment->status == 'not_started') : ?>
                  <a href="<?= base_url('pelamar/ikuti_penilaian/' . $assessment->assessment_id . '/' . $assessment->application_id) ?>" class="btn btn-sm btn-primary mt-2">Ikuti Penilaian</a>
                <?php elseif ($assessment->status == 'in_progress') : ?>
                  <a href="<?= base_url('pelamar/ikuti_penilaian/' . $assessment->assessment_id . '/' . $assessment->application_id) ?>" class="btn btn-sm btn-warning mt-2">Lanjutkan Penilaian</a>
                <?php elseif ($assessment->status == 'completed') : ?>
                  <span class="badge badge-sm bg-gradient-success mt-2">Selesai</span>
                <?php elseif ($assessment->status == 'graded') : ?>
                  <span class="badge badge-sm bg-gradient-info mt-2">Nilai: <?= $assessment->score ?></span>
                <?php endif; ?>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    <?php endif; ?>

    <div class="card mt-4">
      <div class="card-header pb-0">
        <h6>Detail Lowongan</h6>
      </div>
      <div class="card-body">
        <p class="text-sm mb-1"><strong>Jenis Pekerjaan:</strong> <?= ucfirst(str_replace('-', ' ', $job->jenis_pekerjaan)) ?></p>
        <p class="text-sm mb-1"><strong>Lokasi:</strong> <?= $job->lokasi ?></p>
        <?php if ($job->rentang_gaji) : ?>
          <p class="text-sm mb-1"><strong>Kisaran Gaji:</strong> <?= $job->rentang_gaji ?></p>
        <?php endif; ?>
        <p class="text-sm mb-3"><strong>Batas Waktu:</strong> <?= date('d M Y', strtotime($job->batas_waktu)) ?></p>

        <a href="<?= base_url('lowongan/detail/' . $job->id) ?>" class="btn btn-outline-primary btn-sm">Lihat Detail Lengkap</a>
      </div>
    </div>
  </div>
</div>
