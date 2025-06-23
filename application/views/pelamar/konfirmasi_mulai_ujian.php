<div class="row">
  <div class="col-12">
    <div class="card mb-4">
      <div class="card-header pb-0">
        <div class="d-flex justify-content-between align-items-center">
          <div>
            <h6 class="mb-0"><?= $assessment->judul ?></h6>
            <p class="text-sm mb-0">
              <i class="fa fa-info-circle text-primary" aria-hidden="true"></i>
              <span class="font-weight-bold">Penilaian <?= $assessment->type_name ?></span>
            </p>
          </div>
          <div class="text-end">
            <span class="badge badge-lg bg-gradient-info">Status: <?= ucfirst($applicant_assessment->status) ?></span>
          </div>
        </div>
      </div>
      <div class="card-body">

        <!-- Informasi Ujian -->
        <div class="row mb-4">
          <div class="col-md-8">
            <h5 class="text-primary mb-3">
              <i class="fas fa-clipboard-list me-2"></i>Informasi Ujian
            </h5>

            <?php if (isset($assessment->deskripsi) && !empty($assessment->deskripsi)) : ?>
            <div class="mb-3">
              <h6 class="text-dark">Deskripsi:</h6>
              <p class="text-muted"><?= nl2br(htmlspecialchars($assessment->deskripsi)) ?></p>
            </div>
            <?php endif; ?>

            <?php
            $instruksi = '';
            if (isset($assessment->instruksi) && !empty($assessment->instruksi)) {
              $instruksi = $assessment->instruksi;
            } elseif (isset($assessment->petunjuk) && !empty($assessment->petunjuk)) {
              $instruksi = $assessment->petunjuk;
            }

            if (!empty($instruksi)) : ?>
            <div class="mb-3">
              <h6 class="text-dark">Instruksi:</h6>
              <div class="text-muted"><?= nl2br(htmlspecialchars($instruksi)) ?></div>
            </div>
            <?php endif; ?>

            <div class="row">
              <div class="col-md-6">
                <div class="info-item mb-3">
                  <h6 class="text-dark mb-1">
                    <i class="fas fa-question-circle text-info me-2"></i>Jumlah Soal
                  </h6>
                  <p class="text-muted mb-0"><?= count($questions) ?> pertanyaan</p>
                </div>
              </div>

              <div class="col-md-6">
                <div class="info-item mb-3">
                  <h6 class="text-dark mb-1">
                    <i class="fas fa-clock text-warning me-2"></i>Batas Waktu
                  </h6>
                  <p class="text-muted mb-0">
                    <?= (isset($assessment->batas_waktu) && $assessment->batas_waktu) ? $assessment->batas_waktu . ' menit' : 'Tidak terbatas' ?>
                  </p>
                </div>
              </div>

              <div class="col-md-6">
                <div class="info-item mb-3">
                  <h6 class="text-dark mb-1">
                    <i class="fas fa-trophy text-success me-2"></i>Nilai Kelulusan
                  </h6>
                  <p class="text-muted mb-0">
                    <?= isset($assessment->nilai_lulus) ? $assessment->nilai_lulus . '%' : '70%' ?>
                  </p>
                </div>
              </div>

              <div class="col-md-6">
                <div class="info-item mb-3">
                  <h6 class="text-dark mb-1">
                    <i class="fas fa-redo text-primary me-2"></i>Maksimal Percobaan
                  </h6>
                  <p class="text-muted mb-0">
                    <?php
                    if (isset($assessment->maksimal_percobaan) && $assessment->maksimal_percobaan) {
                      echo $assessment->maksimal_percobaan . ' kali';
                    } elseif (isset($assessment->maks_percobaan) && $assessment->maks_percobaan) {
                      echo $assessment->maks_percobaan . ' kali';
                    } else {
                      echo 'Tidak terbatas';
                    }
                    ?>
                  </p>
                </div>
              </div>

              <?php if (isset($assessment->tanggal_penilaian) && !empty($assessment->tanggal_penilaian)) : ?>
              <div class="col-md-6">
                <div class="info-item mb-3">
                  <h6 class="text-dark mb-1">
                    <i class="fas fa-calendar-alt text-secondary me-2"></i>Jadwal Penilaian
                  </h6>
                  <p class="text-muted mb-0">
                    <?= date('d F Y H:i', strtotime($assessment->tanggal_penilaian)) ?>
                  </p>
                </div>
              </div>
              <?php endif; ?>
            </div>
          </div>

          <div class="col-md-4">
            <div class="card bg-gradient-light">
              <div class="card-body text-center">
                <h5 class="text-primary mb-3">
                  <i class="fas fa-exclamation-triangle me-2"></i>Perhatian!
                </h5>
                <ul class="list-unstyled text-start text-sm">
                  <li class="mb-2">
                    <i class="fas fa-check text-success me-2"></i>
                    Pastikan koneksi internet stabil
                  </li>
                  <li class="mb-2">
                    <i class="fas fa-check text-success me-2"></i>
                    Siapkan alat tulis jika diperlukan
                  </li>
                  <li class="mb-2">
                    <i class="fas fa-check text-success me-2"></i>
                    Ujian akan dimulai setelah tombol "Mulai Ujian" ditekan
                  </li>
                  <?php if (isset($assessment->batas_waktu) && $assessment->batas_waktu) : ?>
                  <li class="mb-2">
                    <i class="fas fa-clock text-warning me-2"></i>
                    Timer akan berjalan otomatis
                  </li>
                  <?php endif; ?>
                  <li class="mb-0">
                    <i class="fas fa-ban text-danger me-2"></i>
                    Jangan refresh atau tutup browser
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>

        <!-- Tombol Aksi -->
        <div class="text-center">
          <a href="<?= base_url('pelamar/penilaian') ?>" class="btn btn-outline-secondary me-3">
            <i class="fas fa-arrow-left me-2"></i>Kembali
          </a>

          <?php if ($applicant_assessment->status == 'belum_mulai') : ?>
            <button type="button" class="btn btn-success btn-lg" id="mulaiUjianBtn" onclick="mulaiUjian()">
              <i class="fas fa-play me-2"></i>Mulai Ujian
            </button>
            <!-- <button type="button" class="btn btn-info btn-sm ms-2" onclick="testJSON()">
              <i class="fas fa-bug me-2"></i>Test JSON
            </button>
            <button type="button" class="btn btn-warning btn-sm ms-1" onclick="testConnection()">
              <i class="fas fa-cog me-2"></i>Test Method
            </button> -->
          <?php elseif ($applicant_assessment->status == 'sedang_mengerjakan') : ?>
            <a href="<?= $cat_mode ? base_url('pelamar/cat-penilaian/' . $assessment->id . '/' . $application_id . '/1') : base_url('pelamar/lanjutkan-ujian/' . $assessment->id . '/' . $application_id) ?>" class="btn btn-warning btn-lg">
              <i class="fas fa-play me-2"></i>Lanjutkan Ujian
            </a>
          <?php else : ?>
            <span class="badge badge-lg bg-gradient-success">Ujian Telah Selesai</span>
          <?php endif; ?>
        </div>

      </div>
    </div>
  </div>
</div>

<script>
function mulaiUjian() {
  
  Swal.fire({
    title: 'Mulai Ujian?',
    text: 'Setelah Anda menekan "Ya", timer akan dimulai dan ujian tidak dapat dibatalkan.',
    icon: 'question',
    showCancelButton: true,
    confirmButtonColor: '#28a745',
    cancelButtonColor: '#6c757d',
    confirmButtonText: 'Ya, Mulai Ujian!',
    cancelButtonText: 'Batal',
    allowOutsideClick: false,
    allowEscapeKey: false
  }).then((result) => {
    if (result.isConfirmed) {
      
      const mulaiBtn = document.getElementById('mulaiUjianBtn');
      mulaiBtn.disabled = true;
      mulaiBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Memulai...';

      
      fetch('<?= base_url('pelamar/mulai-ujian/' . $applicant_assessment->id) ?>', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-Requested-With': 'XMLHttpRequest'
        }
      })
      .then(response => {
        console.log('Response status:', response.status);
        console.log('Response headers:', response.headers);
        console.log('Content-Type:', response.headers.get('content-type'));

        
        return response.text();
      })
      .then(text => {
        console.log('Raw response:', text);

        
        try {
          const data = JSON.parse(text);
          return data;
        } catch (e) {
          console.error('JSON parse error:', e);
          throw new Error('Response bukan JSON. Raw response: ' + text.substring(0, 200) + '...');
        }
      })
      .then(data => {
        console.log('Response data:', data);

        if (data.status === 'success') {
          
          Swal.fire({
            title: 'Ujian Dimulai!',
            text: 'Anda akan diarahkan ke halaman ujian.',
            icon: 'success',
            timer: 2000,
            timerProgressBar: true,
            showConfirmButton: false,
            allowOutsideClick: false,
            allowEscapeKey: false
          }).then(() => {
            
            <?php if ($cat_mode) : ?>
              window.location.href = '<?= base_url('pelamar/cat-penilaian/' . $assessment->id . '/' . $application_id . '/1') ?>';
            <?php else : ?>
              window.location.href = '<?= base_url('pelamar/ikuti-ujian/' . $assessment->id . '/' . $application_id) ?>';
            <?php endif; ?>
          });
        } else {
          
          console.error('Error response:', data);
          Swal.fire({
            title: 'Error!',
            text: data.message || 'Gagal memulai ujian. Silakan coba lagi.',
            icon: 'error',
            footer: data.debug_info ? 'Debug: ' + JSON.stringify(data.debug_info) : ''
          });
          resetButton();
        }
      })
      .catch(error => {
        console.error('Fetch error:', error);
        Swal.fire({
          title: 'Error!',
          text: 'Terjadi kesalahan koneksi: ' + error.message,
          icon: 'error',
          footer: 'Silakan periksa koneksi internet dan coba lagi.'
        });
        resetButton();
      });
    }
  });

  function resetButton() {
    const mulaiBtn = document.getElementById('mulaiUjianBtn');
    if (mulaiBtn) {
      mulaiBtn.disabled = false;
      mulaiBtn.innerHTML = '<i class="fas fa-play me-2"></i>Mulai Ujian';
    }
  }
}


function testJSON() {
  console.log('Testing simple JSON...');

  fetch('<?= base_url('pelamar/test-json') ?>', {
    method: 'GET'
  })
  .then(response => {
    console.log('JSON Test Response status:', response.status);
    console.log('JSON Test Content-Type:', response.headers.get('content-type'));

    return response.text();
  })
  .then(text => {
    console.log('JSON Test Raw response:', text);

    try {
      const data = JSON.parse(text);
      console.log('JSON Test Parsed data:', data);

      Swal.fire({
        title: 'Test JSON Berhasil!',
        html: `
          <div style="text-align: left;">
            <strong>Status:</strong> ${data.status}<br>
            <strong>Message:</strong> ${data.message}<br>
            <strong>Timestamp:</strong> ${data.timestamp}
          </div>
        `,
        icon: 'success'
      });
    } catch (e) {
      console.error('JSON Test parse error:', e);
      Swal.fire({
        title: 'Test JSON Gagal',
        html: `
          <div style="text-align: left;">
            <strong>Error:</strong> ${e.message}<br>
            <strong>Raw Response:</strong><br>
            <pre style="background: #f5f5f5; padding: 10px; border-radius: 5px; text-align: left; max-height: 200px; overflow-y: auto;">${text}</pre>
          </div>
        `,
        icon: 'error'
      });
    }
  })
  .catch(error => {
    console.error('JSON Test fetch error:', error);
    Swal.fire({
      title: 'Test JSON Error',
      text: 'Network error: ' + error.message,
      icon: 'error'
    });
  });
}


function testConnection() {
  console.log('Testing connection...');

  fetch('<?= base_url('pelamar/test-mulai-ujian/' . $applicant_assessment->id) ?>', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-Requested-With': 'XMLHttpRequest'
    }
  })
  .then(response => {
    console.log('Test Response status:', response.status);
    console.log('Test Response headers:', response.headers);
    console.log('Test Content-Type:', response.headers.get('content-type'));

    return response.text(); 
  })
  .then(text => {
    console.log('Test Raw response:', text);

    try {
      const data = JSON.parse(text);
      console.log('Test Parsed data:', data);

      Swal.fire({
        title: 'Test Connection',
        html: `
          <div style="text-align: left;">
            <strong>Status:</strong> ${data.status}<br>
            <strong>Message:</strong> ${data.message}<br>
            <strong>Data:</strong><br>
            <pre style="background: #f5f5f5; padding: 10px; border-radius: 5px; text-align: left;">${JSON.stringify(data.data, null, 2)}</pre>
          </div>
        `,
        icon: data.status === 'success' ? 'success' : 'error'
      });
    } catch (e) {
      console.error('Test JSON parse error:', e);
      Swal.fire({
        title: 'Test Connection Error',
        html: `
          <div style="text-align: left;">
            <strong>Error:</strong> Response bukan JSON<br>
            <strong>Raw Response:</strong><br>
            <pre style="background: #f5f5f5; padding: 10px; border-radius: 5px; text-align: left; max-height: 200px; overflow-y: auto;">${text}</pre>
          </div>
        `,
        icon: 'error'
      });
    }
  })
  .catch(error => {
    console.error('Test Fetch error:', error);
    Swal.fire({
      title: 'Test Connection Error',
      text: 'Network error: ' + error.message,
      icon: 'error'
    });
  });
}
</script>
