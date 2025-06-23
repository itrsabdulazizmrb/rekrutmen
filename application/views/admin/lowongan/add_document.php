<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
          <div class="d-flex align-items-center">
            <h6 class="mb-0">Tambah Dokumen Lowongan</h6>
            <a href="<?= base_url('admin/dokumen_lowongan/' . $job->id) ?>" class="btn btn-sm btn-secondary ms-auto">Kembali</a>
          </div>
        </div>
        <div class="card-body">
          <?= form_open('admin/tambah_dokumen_lowongan/' . $job->id) ?>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="jenis_dokumen" class="form-control-label">Jenis Dokumen</label>
                  <select class="form-control" id="jenis_dokumen" name="jenis_dokumen" required>
                    <option value="">Pilih Jenis Dokumen</option>
                    <option value="ktp">KTP (Kartu Tanda Penduduk)</option>
                    <option value="ijazah">Ijazah</option>
                    <option value="cv">CV / Resume</option>
                    <option value="transkrip">Transkrip Nilai</option>
                    <option value="sertifikat">Sertifikat</option>
                    <option value="foto">Pas Foto</option>
                    <option value="lainnya">Lainnya</option>
                  </select>
                  <?= form_error('jenis_dokumen', '<small class="text-danger">', '</small>') ?>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="nama_dokumen" class="form-control-label">Nama Dokumen</label>
                  <input class="form-control" type="text" id="nama_dokumen" name="nama_dokumen" required>
                  <?= form_error('nama_dokumen', '<small class="text-danger">', '</small>') ?>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="wajib" class="form-control-label">Wajib</label>
                  <select class="form-control" id="wajib" name="wajib" required>
                    <option value="1">Ya</option>
                    <option value="0">Tidak</option>
                  </select>
                  <?= form_error('wajib', '<small class="text-danger">', '</small>') ?>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="format_diizinkan" class="form-control-label">Format Diizinkan</label>
                  <input class="form-control" type="text" id="format_diizinkan" name="format_diizinkan" value="pdf|doc|docx|jpg|jpeg|png" required>
                  <small class="text-muted">Pisahkan dengan tanda | (pipe). Contoh: pdf|doc|docx</small>
                  <?= form_error('format_diizinkan', '<small class="text-danger">', '</small>') ?>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="ukuran_maksimal" class="form-control-label">Ukuran Maksimal (KB)</label>
                  <input class="form-control" type="number" id="ukuran_maksimal" name="ukuran_maksimal" value="2048" required>
                  <small class="text-muted">Dalam kilobyte (KB). 1 MB = 1024 KB</small>
                  <?= form_error('ukuran_maksimal', '<small class="text-danger">', '</small>') ?>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="deskripsi" class="form-control-label">Deskripsi</label>
              <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3"></textarea>
              <small class="text-muted">Petunjuk atau informasi tambahan untuk pelamar</small>
              <?= form_error('deskripsi', '<small class="text-danger">', '</small>') ?>
            </div>
            <div class="d-flex justify-content-end mt-4">
              <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
          <?= form_close() ?>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {
    
    $('#jenis_dokumen').change(function() {
      var jenis = $(this).val();
      var nama = '';
      
      switch(jenis) {
        case 'ktp':
          nama = 'KTP (Kartu Tanda Penduduk)';
          $('#format_diizinkan').val('pdf|jpg|jpeg|png');
          $('#ukuran_maksimal').val('1024');
          $('#deskripsi').val('Unggah scan atau foto KTP yang masih berlaku dan jelas terbaca.');
          break;
        case 'ijazah':
          nama = 'Ijazah Pendidikan Terakhir';
          $('#format_diizinkan').val('pdf');
          $('#ukuran_maksimal').val('2048');
          $('#deskripsi').val('Unggah scan ijazah pendidikan terakhir (minimal SMA/SMK/sederajat).');
          break;
        case 'cv':
          nama = 'Curriculum Vitae (CV)';
          $('#format_diizinkan').val('pdf|doc|docx');
          $('#ukuran_maksimal').val('2048');
          $('#deskripsi').val('Unggah CV terbaru yang berisi informasi pendidikan, pengalaman kerja, dan keahlian Anda.');
          break;
        case 'transkrip':
          nama = 'Transkrip Nilai';
          $('#format_diizinkan').val('pdf');
          $('#ukuran_maksimal').val('2048');
          $('#deskripsi').val('Unggah scan transkrip nilai pendidikan terakhir.');
          break;
        case 'sertifikat':
          nama = 'Sertifikat Pendukung';
          $('#format_diizinkan').val('pdf');
          $('#ukuran_maksimal').val('2048');
          $('#deskripsi').val('Unggah sertifikat pelatihan, kursus, atau sertifikasi yang relevan dengan posisi yang dilamar.');
          break;
        case 'foto':
          nama = 'Pas Foto';
          $('#format_diizinkan').val('jpg|jpeg|png');
          $('#ukuran_maksimal').val('1024');
          $('#deskripsi').val('Unggah pas foto terbaru dengan latar belakang berwarna (ukuran 4x6).');
          break;
      }
      
      if (nama) {
        $('#nama_dokumen').val(nama);
      }
    });
  });
</script>
