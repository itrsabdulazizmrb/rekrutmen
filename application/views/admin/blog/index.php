<div class="row">
  <div class="col-12">
    <div class="card shadow-sm mb-4">
      <div class="card-header pb-0">
        <div class="d-flex justify-content-between align-items-center">
          <div>
            <h6 class="mb-1">Manajemen Blog</h6>
            <p class="text-sm mb-0">
              <i class="fa fa-info-circle text-primary" aria-hidden="true"></i>
              <span class="font-weight-bold">Kelola semua artikel blog di sini</span>
            </p>
          </div>
          <a href="<?= base_url('admin/tambah_artikel') ?>" class="btn btn-sm btn-primary">
            <i class="fas fa-plus me-2"></i> Tambah Artikel Baru
          </a>
        </div>
      </div>
      <div class="card-body p-0">

        <div class="table-responsive p-0">
          <?php if (empty($posts)) : ?>
            <div class="text-center py-5">
              <h4 class="text-secondary">Tidak ada artikel yang ditemukan</h4>
              <p class="text-muted">Mulai dengan menambahkan artikel blog baru.</p>
              <a href="<?= base_url('admin/tambah_artikel') ?>" class="btn btn-primary mt-3">Tambah Artikel Baru</a>
            </div>
          <?php else : ?>
            <table class="table align-items-center mb-0 datatable">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Artikel</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Kategori</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Dilihat</th>
                  <th class="text-secondary opacity-7"></th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($posts as $post) : ?>
                  <tr>
                    <td>
                      <div class="d-flex px-2 py-1">
                        <div>
                          <?php if ($post->gambar_utama) : ?>
                            <img src="<?= base_url('uploads/blog_images/' . $post->gambar_utama) ?>" class="avatar avatar-sm me-3" alt="post">
                          <?php else : ?>
                            <img src="<?= base_url('assets/img/small-logos/logo-blog.svg') ?>" class="avatar avatar-sm me-3" alt="post">
                          <?php endif; ?>
                        </div>
                        <div class="d-flex flex-column justify-content-center">
                          <h6 class="mb-0 text-sm"><?= $post->judul ?></h6>
                          <p class="text-xs text-secondary mb-0">Oleh: <?= $post->author_name ?></p>
                        </div>
                      </div>
                    </td>
                    <td>
                      <?php
                      $post_categories = $this->model_blog->dapatkan_kategori_artikel($post->id);
                      foreach ($post_categories as $category) :
                      ?>
                        <span class="badge badge-sm bg-gradient-info me-1"><?= $category->nama ?></span>
                      <?php endforeach; ?>
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold"><?= date('d M Y', strtotime($post->dibuat_pada)) ?></span>
                    </td>
                    <td class="align-middle text-center text-sm">
                      <span class="badge badge-sm bg-gradient-<?= $post->status == 'dipublikasi' ? 'success' : 'secondary' ?>"><?= $post->status == 'dipublikasi' ? 'Dipublikasikan' : 'Draft' ?></span>
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold"><?= $post->tampilan ?></span>
                    </td>
                    <td class="align-middle">
                      <div class="dropdown">
                        <button type="button" class="btn btn-sm btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                          <i class="fas fa-ellipsis-v"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end px-2 py-3" aria-labelledby="dropdownMenuButton">
                          <li><a class="dropdown-item border-radius-md" href="<?= base_url('blog/' . $post->slug) ?>" target="_blank"><i class="fas fa-eye me-2"></i> Lihat</a></li>
                          <li><a class="dropdown-item border-radius-md" href="<?= base_url('admin/edit_artikel/' . $post->id) ?>"><i class="fas fa-edit me-2"></i> Edit</a></li>
                          <?php if ($post->status == 'draft') : ?>
                            <li><a class="dropdown-item border-radius-md" href="<?= base_url('admin/publikasi_artikel/' . $post->id) ?>"><i class="fas fa-globe me-2"></i> Publikasikan</a></li>
                          <?php else : ?>
                            <li><a class="dropdown-item border-radius-md" href="<?= base_url('admin/batalkan_publikasi_artikel/' . $post->id) ?>"><i class="fas fa-file me-2"></i> Jadikan Draft</a></li>
                          <?php endif; ?>
                          <li>
                            <hr class="dropdown-divider">
                          </li>
                          <li>
                            <a class="dropdown-item border-radius-md text-danger btn-delete" href="<?= base_url('admin/hapus_artikel/' . $post->id) ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus artikel ini?');">
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

<div class="row mt-4">
  <div class="col-md-6">
    <div class="card shadow-sm">
      <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
          <h6 class="mb-0">Kategori Blog</h6>
          <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
            <i class="fas fa-plus me-2"></i> Tambah Kategori
          </button>
        </div>
      </div>
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table align-items-center mb-0 datatable">
            <thead>
              <tr>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jumlah Artikel</th>
                <th class="text-secondary opacity-7"></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($categories as $category) : ?>
                <tr>
                  <td>
                    <div class="d-flex px-2 py-1">
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="mb-0 text-sm"><?= $category->nama ?></h6>
                      </div>
                    </div>
                  </td>
                  <td class="align-middle text-center">
                    <span class="text-secondary text-xs font-weight-bold"><?= $this->model_kategori->hitung_artikel_berdasarkan_kategori($category->id) ?></span>
                  </td>
                  <td class="align-middle">
                    <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-bs-toggle="modal" data-bs-target="#editCategoryModal" data-id="<?= $category->id ?>" data-name="<?= $category->nama ?>" data-slug="<?= $category->slug ?>" data-description="<?= $category->deskripsi ?>">
                      Edit
                    </a>
                    <a href="<?= base_url('admin/hapus_kategori_blog/' . $category->id) ?>" class="text-danger font-weight-bold text-xs ms-2 btn-delete" onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?');">
                      Hapus
                    </a>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-6">
    <div class="card shadow-sm">
      <div class="card-header">
        <h6 class="mb-0">Statistik Blog</h6>
      </div>
      <div class="card-body">
        <div class="chart">
          <canvas id="blog-stats-chart" class="chart-canvas" height="300"></canvas>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Add Category Modal -->
<div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content shadow-sm">
      <div class="modal-header">
        <h5 class="modal-title" id="addCategoryModalLabel">Tambah Kategori Baru</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <?= form_open('admin/tambah_kategori_blog') ?>
        <div class="modal-body">
          <div class="form-group mb-3">
            <label for="category_name" class="form-label">Nama Kategori</label>
            <input type="text" class="form-control" id="category_name" name="name" required>
          </div>
          <div class="form-group mb-3">
            <label for="category_slug" class="form-label">Slug</label>
            <input type="text" class="form-control" id="category_slug" name="slug" required>
            <small class="text-muted">Akan dibuat otomatis dari nama kategori.</small>
          </div>
          <div class="form-group mb-3">
            <label for="category_description" class="form-label">Deskripsi</label>
            <textarea class="form-control" id="category_description" name="description" rows="3"></textarea>
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

<!-- Edit Category Modal -->
<div class="modal fade" id="editCategoryModal" tabindex="-1" role="dialog" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content shadow-sm">
      <div class="modal-header">
        <h5 class="modal-title" id="editCategoryModalLabel">Edit Kategori</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <?= form_open('admin/edit_kategori_blog') ?>
        <div class="modal-body">
          <input type="hidden" id="edit_category_id" name="id">
          <div class="form-group mb-3">
            <label for="edit_category_name" class="form-label">Nama Kategori</label>
            <input type="text" class="form-control" id="edit_category_name" name="name" required>
          </div>
          <div class="form-group mb-3">
            <label for="edit_category_slug" class="form-label">Slug</label>
            <input type="text" class="form-control" id="edit_category_slug" name="slug" required>
          </div>
          <div class="form-group mb-3">
            <label for="edit_category_description" class="form-label">Deskripsi</label>
            <textarea class="form-control" id="edit_category_description" name="description" rows="3"></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </div>
      <?= form_close() ?>
    </div>
  </div>
</div>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    
    var ctx = document.getElementById("blog-stats-chart").getContext("2d");
    new Chart(ctx, {
      type: "line",
      data: {
        labels: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Ags", "Sep", "Okt", "Nov", "Des"],
        datasets: [{
          label: "Artikel",
          tension: 0.4,
          borderWidth: 0,
          pointRadius: 0,
          borderColor: "#5e72e4",
          backgroundColor: "rgba(94, 114, 228, 0.3)",
          borderWidth: 3,
          fill: true,
          data: [10, 15, 8, 12, 7, 10, 15, 20, 25, 30, 25, 20],
          maxBarThickness: 6
        }, {
          label: "Dilihat",
          tension: 0.4,
          borderWidth: 0,
          pointRadius: 0,
          borderColor: "#2dce89",
          backgroundColor: "rgba(45, 206, 137, 0.3)",
          borderWidth: 3,
          fill: true,
          data: [50, 100, 80, 120, 70, 100, 150, 200, 250, 300, 250, 200],
          maxBarThickness: 6
        }],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: true,
          }
        },
        interaction: {
          intersect: false,
          mode: 'index',
        },
        scales: {
          y: {
            beginAtZero: true
          }
        },
      },
    });

    
    $('#category_name').on('input', function() {
      var name = $(this).val();
      var slug = name.toLowerCase()
        .replace(/[^a-z0-9\s-]/g, '')
        .replace(/\s+/g, '-')
        .replace(/-+/g, '-')
        .trim('-');
      $('#category_slug').val(slug);
    });

    
    $('#edit_category_name').on('input', function() {
      var name = $(this).val();
      var slug = name.toLowerCase()
        .replace(/[^a-z0-9\s-]/g, '')
        .replace(/\s+/g, '-')
        .replace(/-+/g, '-')
        .trim('-');
      $('#edit_category_slug').val(slug);
    });

    
    $('#editCategoryModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget);
      var id = button.data('id');
      var name = button.data('name');
      var slug = button.data('slug');
      var description = button.data('description');

      var modal = $(this);
      modal.find('#edit_category_id').val(id);
      modal.find('#edit_category_name').val(name);
      modal.find('#edit_category_slug').val(slug);
      modal.find('#edit_category_description').val(description);
    });
  });
</script>
