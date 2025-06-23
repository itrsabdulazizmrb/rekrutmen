<div class="row">
  <div class="col-12">
    <div class="card shadow-sm mb-4">
      <div class="card-header pb-0">
        <div class="d-flex justify-content-between align-items-center">
          <div>
            <h6 class="mb-1">Atur Penilaian</h6>
            <p class="text-sm mb-0">
              <i class="fa fa-info-circle text-primary" aria-hidden="true"></i>
              <span class="font-weight-bold">
                <?php if (isset($application)) : ?>
                  Tetapkan penilaian untuk pelamar: <?= $application->applicant_name ?> (<?= $job->judul ?>)
                <?php else : ?>
                  Tetapkan penilaian untuk lowongan: <?= $job->judul ?>
                <?php endif; ?>
              </span>
            </p>
          </div>
          <?php if (isset($application)) : ?>
            <a href="<?= base_url('admin/detail_lamaran/' . $application->id) ?>" class="btn btn-sm btn-outline-primary">
              <i class="fas fa-arrow-left me-2"></i> Kembali ke Detail Lamaran
            </a>
          <?php else : ?>
            <a href="<?= base_url('admin/lowongan') ?>" class="btn btn-sm btn-outline-primary">
              <i class="fas fa-arrow-left me-2"></i> Kembali ke Daftar Lowongan
            </a>
          <?php endif; ?>
        </div>
      </div>
      <div class="card-body">
        <?php if (empty($assessments)) : ?>
          <div class="alert alert-warning" role="alert">
            <strong>Perhatian!</strong> Belum ada penilaian aktif yang tersedia.
            <a href="<?= base_url('admin/tambah_penilaian') ?>" class="alert-link">Tambahkan penilaian baru</a> terlebih dahulu.
          </div>
        <?php else : ?>
          <form action="" method="post">
            <!-- CSRF Token -->
            <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>" />

            <div class="table-responsive">
              <table class="table align-items-center mb-0">
                <thead>
                  <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="width: 50px;">Pilih</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Penilaian</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Jenis</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Batas Waktu</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nilai Kelulusan</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($assessments as $assessment) : ?>
                    <tr>
                      <td class="align-middle text-center">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" name="assessment_ids[]" value="<?= $assessment->id ?>"
                            <?php
                            
                            $is_assigned = false;                            if (isset($application) && !empty($applicant_assessments)) {
                              foreach ($applicant_assessments as $app_assessment) {
                                if ($app_assessment->id == $assessment->id) {
                                  $is_assigned = true;
                                  break;
                                }
                              }
                            } elseif (!empty($assigned_assessments)) {
                              foreach ($assigned_assessments as $ass_assessment) {
                                if ($ass_assessment->id == $assessment->id) {
                                  $is_assigned = true;
                                  break;
                                }
                              }
                            }
                            echo $is_assigned ? 'checked' : '';
                            ?>
                          >
                        </div>
                      </td>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm"><?= $assessment->judul ?></h6>
                            <p class="text-xs text-secondary mb-0"><?= substr($assessment->deskripsi, 0, 100) . (strlen($assessment->deskripsi) > 100 ? '...' : '') ?></p>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0"><?= $assessment->type_name ?></p>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0"><?= $assessment->batas_waktu ? $assessment->batas_waktu . ' menit' : 'Tidak ada' ?></p>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0"><?= $assessment->nilai_lulus ? $assessment->nilai_lulus . '%' : 'Tidak ada' ?></p>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>

            <div class="d-flex justify-content-end mt-4">
              <button type="submit" name="submit" value="1" class="btn btn-primary">
                <i class="fas fa-save me-2"></i> Simpan Pengaturan Penilaian
              </button>
            </div>
          </form>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>
