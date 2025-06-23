<div class="row">
  <div class="col-12">
    <div class="card mb-4">
      <div class="card-header pb-0">
        <div class="d-flex justify-content-between align-items-center">
          <div>
            <h6 class="mb-1">Manajemen Kategori Lowongan</h6>
            <p class="text-sm mb-0">
              <i class="fa fa-info-circle text-primary" aria-hidden="true"></i>
              <span class="font-weight-bold">Kelola kategori untuk mengorganisir lowongan pekerjaan</span>
            </p>
          </div>
          <div>
            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
              <i class="fas fa-plus me-2"></i> Tambah Kategori Baru
            </button>
          </div>
        </div>
      </div>
      <div class="card-body px-0 pt-0 pb-2">
        <?php if ($this->session->flashdata('success')) : ?>
          <div class="alert alert-success alert-dismissible fade show mx-3" role="alert">
            <span class="alert-icon"><i class="fas fa-check-circle"></i></span>
            <span class="alert-text"><?= $this->session->flashdata('success') ?></span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        <?php endif; ?>

        <?php if ($this->session->flashdata('error')) : ?>
          <div class="alert alert-danger alert-dismissible fade show mx-3" role="alert">
            <span class="alert-icon"><i class="fas fa-exclamation-triangle"></i></span>
            <span class="alert-text"><?= $this->session->flashdata('error') ?></span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        <?php endif; ?>

        <div class="table-responsive p-0">
          <?php if (empty($categories)) : ?>
            <div class="text-center py-5">
              <h4 class="text-secondary">Belum ada kategori</h4>
              <p class="text-muted">Tambahkan kategori pertama untuk mengorganisir lowongan pekerjaan.</p>
              <button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
                <i class="fas fa-plus me-2"></i> Tambah Kategori Baru
              </button>
            </div>
          <?php else : ?>
            <table class="table align-items-center mb-0 datatable">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kategori</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jumlah Lowongan</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal Dibuat</th>
                  <th class="text-secondary opacity-7">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($categories as $category) : ?>
                  <tr>
                    <td>
                      <div class="d-flex px-2 py-1">
                        <div class="d-flex flex-column justify-content-center">
                          <h6 class="mb-0 text-sm"><?= $category->nama ?></h6>
                          <?php if (!empty($category->deskripsi)) : ?>
                            <p class="text-xs text-secondary mb-0"><?= $category->deskripsi ?></p>
                          <?php endif; ?>
                        </div>
                      </div>
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold">
                        <?= isset($category_stats[$category->id]) ? $category_stats[$category->id] : 0 ?>
                      </span>
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold">
                        <?= date('d M Y', strtotime($category->dibuat_pada ?? $category->created_at ?? date('Y-m-d'))) ?>
                      </span>
                    </td>
                    <td class="align-middle">
                      <div class="dropdown">
                        <a href="#" class="text-secondary font-weight-bold text-xs" data-bs-toggle="dropdown" aria-expanded="false">
                          <i class="fas fa-ellipsis-v"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end px-2 py-3" aria-labelledby="dropdownMenuButton">
                          <li>
                            <a class="dropdown-item border-radius-md" href="javascript:void(0)"
                               data-bs-toggle="modal" data-bs-target="#editCategoryModal"
                               data-id="<?= $category->id ?>"
                               data-nama="<?= $category->nama ?>"
                               data-deskripsi="<?= $category->deskripsi ?>">
                              <i class="fas fa-edit me-2"></i> Edit
                            </a>
                          </li>
                          <li>
                            <hr class="dropdown-divider">
                          </li>
                          <li>
                            <a class="dropdown-item border-radius-md text-danger btn-delete"
                               href="<?= base_url('admin/hapus_kategori_lowongan/' . $category->id) ?>"
                               onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini? Kategori yang sedang digunakan tidak dapat dihapus.');">
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

<!-- Modal Tambah Kategori -->
<div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addCategoryModalLabel">Tambah Kategori Baru</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <?= form_open('admin/tambah_kategori_lowongan') ?>
        <div class="modal-body">
          <div class="form-group">
            <label for="nama" class="form-control-label">Nama Kategori <span class="text-danger">*</span></label>
            <input class="form-control" type="text" id="nama" name="nama" required>
          </div>
          <div class="form-group">
            <label for="deskripsi" class="form-control-label">Deskripsi</label>
            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3"></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      <?= form_close() ?>
    </div>
  </div>
</div>

<!-- Modal Edit Kategori -->
<div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editCategoryModalLabel">Edit Kategori</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <?= form_open('admin/edit_kategori_lowongan') ?>
        <input type="hidden" id="edit_category_id" name="id">
        <div class="modal-body">
          <div class="form-group">
            <label for="edit_nama" class="form-control-label">Nama Kategori <span class="text-danger">*</span></label>
            <input class="form-control" type="text" id="edit_nama" name="nama" required>
          </div>
          <div class="form-group">
            <label for="edit_deskripsi" class="form-control-label">Deskripsi</label>
            <textarea class="form-control" id="edit_deskripsi" name="deskripsi" rows="3"></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Perbarui</button>
        </div>
      <?= form_close() ?>
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
  // Edit Category Modal
  $('#editCategoryModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var id = button.data('id');
    var nama = button.data('nama');
    var deskripsi = button.data('deskripsi');

    var modal = $(this);
    modal.find('#edit_category_id').val(id);
    modal.find('#edit_nama').val(nama);
    modal.find('#edit_deskripsi').val(deskripsi);
  });
});
</script>
