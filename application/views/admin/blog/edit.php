<div class="row">
  <div class="col-12">
    <div class="card mb-4">
      <div class="card-header pb-0">
        <div class="d-flex justify-content-between align-items-center">
          <h6>Edit Artikel</h6>
          <a href="<?= base_url('admin/blog') ?>" class="btn btn-sm btn-outline-primary">
            <i class="fas fa-arrow-left me-2"></i> Kembali ke Daftar Artikel
          </a>
        </div>
        <p class="text-sm mb-0">
          <i class="fa fa-info-circle text-primary" aria-hidden="true"></i>
          <span class="font-weight-bold">Edit informasi artikel blog</span>
        </p>
      </div>
      <div class="card-body">
        <?= form_open_multipart('admin/edit_artikel/' . $post->id, ['class' => 'needs-validation']) ?>
          <div class="row">
            <div class="col-md-8">
              <div class="form-group">
                <label for="title" class="form-control-label">Judul Artikel <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="title" name="title" value="<?= set_value('title', $post->judul) ?>" required>
                <?= form_error('title', '<small class="text-danger">', '</small>') ?>
              </div>

              <div class="form-group mt-3">
                <label for="slug" class="form-control-label">Slug</label>
                <input type="text" class="form-control" id="slug" name="slug" value="<?= set_value('slug', $post->slug) ?>">
                <small class="text-muted">Biarkan kosong untuk menghasilkan slug otomatis dari judul.</small>
                <?= form_error('slug', '<small class="text-danger">', '</small>') ?>
              </div>

              <div class="form-group mt-3">
                <label for="content" class="form-control-label">Konten Artikel <span class="text-danger">*</span></label>
                <textarea class="form-control" id="content" name="content" rows="15" required><?= set_value('content', $post->konten) ?></textarea>
                <?= form_error('content', '<small class="text-danger">', '</small>') ?>
              </div>

              <div class="form-group mt-3">
                <label for="excerpt" class="form-control-label">Kutipan</label>
                <textarea class="form-control" id="excerpt" name="excerpt" rows="3"><?= set_value('excerpt', '') ?></textarea>
                <small class="text-muted">Ringkasan singkat dari artikel. Biarkan kosong untuk menghasilkan kutipan otomatis.</small>
                <?= form_error('excerpt', '<small class="text-danger">', '</small>') ?>
              </div>
            </div>

            <div class="col-md-4">
              <div class="card">
                <div class="card-body">
                  <h6 class="mb-3">Publikasi</h6>

                  <div class="form-group">
                    <label for="status" class="form-control-label">Status</label>
                    <select class="form-control" id="status" name="status">
                      <option value="draft" <?= set_select('status', 'draft', ($post->status == 'draft')) ?>>Draft</option>
                      <option value="dipublikasi" <?= set_select('status', 'dipublikasi', ($post->status == 'dipublikasi')) ?>>Publikasikan</option>
                    </select>
                  </div>

                  <div class="form-group mt-3">
                    <label for="featured_image" class="form-control-label">Gambar Unggulan</label>
                    <?php if ($post->gambar_utama) : ?>
                      <div class="mb-2">
                        <img src="<?= base_url('uploads/blog_images/' . $post->gambar_utama) ?>" class="img-fluid rounded" alt="Featured Image">
                      </div>
                    <?php endif; ?>
                    <input type="file" class="form-control" id="featured_image" name="featured_image" accept="image/*">
                    <small class="text-muted">Format yang diizinkan: JPG, JPEG, PNG. Maks 2MB.</small>
                  </div>

                  <div class="form-group mt-3">
                    <label for="categories" class="form-control-label">Kategori <span class="text-danger">*</span></label>
                    <select class="form-control" id="categories" name="categories[]" multiple required>
                      <?php
                      $post_category_ids = array_map(function($cat) {
                        return $cat->id;
                      }, $post_categories);

                      foreach ($categories as $category) :
                        $selected = in_array($category->id, $post_category_ids);
                      ?>
                        <option value="<?= $category->id ?>" <?= set_select('categories[]', $category->id, $selected) ?>><?= $category->nama ?></option>
                      <?php endforeach; ?>
                    </select>
                    <?= form_error('categories[]', '<small class="text-danger">', '</small>') ?>
                    <small class="text-muted">Tekan Ctrl (atau Cmd di Mac) untuk memilih beberapa kategori.</small>
                  </div>

                  <div class="form-group mt-3">
                    <label for="tags" class="form-control-label">Tag</label>
                    <input type="text" class="form-control" id="tags" name="tags" value="<?= set_value('tags', '') ?>">
                    <small class="text-muted">Pisahkan tag dengan koma (mis. rekrutmen, karir, wawancara).</small>
                  </div>

                  <!-- Comment system will be implemented in future updates -->

                  <!-- Featured article functionality will be implemented in future updates -->

                  <div class="d-grid gap-2 mt-4">
                    <button type="submit" name="save_draft" class="btn btn-secondary">Simpan sebagai Draft</button>
                    <button type="submit" name="publish" class="btn btn-primary">Publikasikan</button>
                  </div>
                </div>
              </div>

              <!-- SEO functionality will be implemented in future updates -->

              <div class="card mt-4">
                <div class="card-body">
                  <h6 class="mb-3">Informasi Artikel</h6>

                  <p class="text-sm mb-1">
                    <strong>Dibuat pada:</strong> <?= date('d M Y H:i', strtotime($post->dibuat_pada)) ?>
                  </p>
                  <p class="text-sm mb-1">
                    <strong>Diperbarui pada:</strong> <?= date('d M Y H:i', strtotime($post->diperbarui_pada)) ?>
                  </p>
                  <p class="text-sm mb-1">
                    <strong>Penulis:</strong> <?= $post->author_name ?>
                  </p>
                  <p class="text-sm mb-1">
                    <strong>Dilihat:</strong> <?= $post->tampilan ?> kali
                  </p>

                  <div class="d-grid mt-3">
                    <a href="<?= base_url('blog/' . $post->slug) ?>" class="btn btn-outline-primary btn-sm" target="_blank">Lihat Artikel</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <?= form_close() ?>
      </div>
    </div>
  </div>
</div>

<!-- Comment system will be implemented in future updates -->

<script>
  document.addEventListener('DOMContentLoaded', function() {
    
    if (typeof ClassicEditor !== 'undefined') {
      ClassicEditor.create(document.querySelector('#content'), {
        toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'insertTable', 'mediaEmbed', '|', 'undo', 'redo']
      }).catch(error => {
        console.error(error);
      });
    }

    
    const titleInput = document.getElementById('title');
    const slugInput = document.getElementById('slug');
    const originalSlug = slugInput.value;

    titleInput.addEventListener('keyup', function() {
      if (slugInput.value === originalSlug) {
        slugInput.value = generateSlug(this.value);
      }
    });

    function generateSlug(text) {
      return text.toString().toLowerCase()
        .replace(/\s+/g, '-')           
        .replace(/[^\w\-]+/g, '')       
        .replace(/\-\-+/g, '-')         
        .replace(/^-+/, '')             
        .replace(/-+$/, '');            
    }

    
    const form = document.querySelector('form');
    const saveAsDraftBtn = document.querySelector('button[name="save_draft"]');
    const publishBtn = document.querySelector('button[name="publish"]');
    const statusSelect = document.getElementById('status');

    saveAsDraftBtn.addEventListener('click', function(e) {
      e.preventDefault();
      statusSelect.value = 'draft';
      form.submit();
    });

    publishBtn.addEventListener('click', function(e) {
      e.preventDefault();
      statusSelect.value = 'dipublikasi';
      form.submit();
    });
  });
</script>
