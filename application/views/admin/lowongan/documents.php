<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
          <div class="d-flex align-items-center">
            <h6 class="mb-0">Kelola Dokumen Lowongan</h6>
            <div class="ms-auto">
              <a href="<?= base_url('admin/tambah_dokumen_lowongan/' . $job->id) ?>" class="btn btn-sm btn-primary">Tambah Dokumen</a>
              <a href="<?= base_url('admin/atur_dokumen_default/' . $job->id) ?>" class="btn btn-sm btn-info">Atur Dokumen Default</a>
              <a href="<?= base_url('admin/hapus_semua_dokumen_lowongan/' . $job->id) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus semua dokumen lowongan ini?')">Hapus Semua</a>
              <a href="<?= base_url('admin/edit_lowongan/' . $job->id) ?>" class="btn btn-sm btn-secondary">Kembali ke Lowongan</a>
            </div>
          </div>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="px-4 py-3">
            <h6 class="mb-3">Informasi Lowongan</h6>
            <div class="row">
              <div class="col-md-6">
                <p class="text-sm mb-1"><strong>Judul:</strong> <?= $job->judul ?></p>
                <p class="text-sm mb-1"><strong>Lokasi:</strong> <?= $job->lokasi ?></p>
                <p class="text-sm mb-1"><strong>Jenis Pekerjaan:</strong> <?= $job->jenis_pekerjaan ?></p>
              </div>
              <div class="col-md-6">
                <p class="text-sm mb-1"><strong>Status:</strong> <?= $job->status ?></p>
                <p class="text-sm mb-1"><strong>Batas Waktu:</strong> <?= date('d M Y', strtotime($job->batas_waktu)) ?></p>
                <p class="text-sm mb-1"><strong>Jumlah Posisi:</strong> <?= $job->jumlah_lowongan ?></p>
              </div>
            </div>
          </div>
          <hr class="horizontal dark my-2">
          <div class="table-responsive p-0">
            <table class="table align-items-center mb-0 datatable" id="documents-table">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Dokumen</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Jenis</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Wajib</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Format Diizinkan</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Ukuran Maks</th>
                  <th class="text-secondary opacity-7">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php if (empty($documents)) : ?>
                  <tr>
                    <td colspan="6" class="text-center py-4">
                      <p class="text-sm mb-0">Belum ada dokumen yang ditentukan untuk lowongan ini.</p>
                      <p class="text-xs text-secondary mb-0">Klik "Tambah Dokumen" untuk menambahkan persyaratan dokumen atau "Atur Dokumen Default" untuk menggunakan pengaturan standar.</p>
                    </td>
                  </tr>
                <?php else : ?>
                  <?php foreach ($documents as $doc) : ?>
                    <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div>
                            <i class="ni ni-single-copy-04 text-primary me-3 font-size-lg"></i>
                          </div>
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm"><?= $doc->nama_dokumen ?></h6>
                            <p class="text-xs text-secondary mb-0"><?= $doc->deskripsi ? $doc->deskripsi : 'Tidak ada deskripsi' ?></p>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0"><?= $doc->jenis_dokumen ?></p>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <?php if ($doc->wajib == 1) : ?>
                          <span class="badge badge-sm bg-gradient-success">Wajib</span>
                        <?php else : ?>
                          <span class="badge badge-sm bg-gradient-secondary">Opsional</span>
                        <?php endif; ?>
                      </td>
                      <td class="align-middle text-center">
                        <p class="text-xs font-weight-bold mb-0"><?= $doc->format_diizinkan ?></p>
                      </td>
                      <td class="align-middle text-center">
                        <p class="text-xs font-weight-bold mb-0"><?= round($doc->ukuran_maksimal / 1024, 1) ?> MB</p>
                      </td>
                      <td class="align-middle">
                        <div class="dropdown">
                          <button class="btn btn-link text-secondary mb-0" id="dropdownMenuButton<?= $doc->id ?>" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-ellipsis-v text-xs"></i>
                          </button>
                          <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton<?= $doc->id ?>">
                            <li><a class="dropdown-item" href="<?= base_url('admin/edit_dokumen_lowongan/' . $doc->id) ?>">Edit</a></li>
                            <li><a class="dropdown-item text-danger" href="<?= base_url('admin/hapus_dokumen_lowongan/' . $doc->id) ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus dokumen ini?')">Hapus</a></li>
                          </ul>
                        </div>
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
  </div>
</div>


