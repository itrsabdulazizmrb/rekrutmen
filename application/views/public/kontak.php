<div class="page-header min-vh-75 d-flex align-items-center" style="background-image: url('<?= base_url('assets/img/gallery-hero-bg.jpg') ?>'); background-size: cover; background-position: center;">
  <span class="mask bg-gradient-dark opacity-7"></span>
  <div class="container">
    <div class="row">
      <div class="col-md-10 mx-auto">
        <div class="text-center">
          <h1 class="text-white display-4 font-weight-bold mb-4">Hubungi Kami</h1>
          <p class="lead text-white fs-5 mb-4">Kami Siap Membantu Anda Terkait Proses Rekrutmen</p>
          <p class="text-white opacity-9 mb-5">Silakan hubungi tim rekrutmen kami jika Anda memiliki pertanyaan lebih lanjut.</p>
          <div class="row justify-content-center">
            <div class="col-md-8">
              <!-- <div class="card card-body bg-white bg-opacity-10 backdrop-blur border-0 shadow-lg py-3">
                <div class="row align-items-center">
                  <div class="col-md-4 text-center mb-3 mb-md-0">
                    <i class="fas fa-phone text-warning fa-2x mb-2"></i>
                    <h6 class="text-gray mb-0">Telepon Kami</h6>
                  </div>
                  <div class="col-md-4 text-center mb-3 mb-md-0">
                    <i class="fas fa-envelope text-warning fa-2x mb-2"></i>
                    <h6 class="text-gray mb-0">Email Kami</h6>
                  </div>
                  <div class="col-md-4 text-center">
                    <i class="fas fa-map-marker-alt text-warning fa-2x mb-2"></i>
                    <h6 class="text-gray mb-0">Kunjungi Kami</h6>
                  </div>
                </div>
              </div> -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="container">
  <div class="row mt-n6">
    <div class="col-md-12">
      <div class="card card-body blur shadow-blur mx-3 mx-md-4">
        <div class="row">
          <div class="col-md-7">
            <h3>Kirim Pesan</h3>
            <p class="text-sm">Jika Anda memiliki pertanyaan terkait lowongan, proses seleksi, atau kendala teknis, silakan isi formulir di bawah ini.</p>

            <?= form_open('kontak', ['class' => 'needs-validation']) ?>
              <div class="card-body p-0 my-3">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="name">Nama Lengkap <span class="text-danger">*</span></label>
                      <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Nama Lengkap" value="<?= set_value('name') ?>" required>
                      </div>
                      <?= form_error('name', '<small class="text-danger">', '</small>') ?>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="email">Email <span class="text-danger">*</span></label>
                      <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?= set_value('email') ?>" required>
                      </div>
                      <?= form_error('email', '<small class="text-danger">', '</small>') ?>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="subject">Subjek <span class="text-danger">*</span></label>
                  <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fas fa-tag"></i></span>
                    <input type="text" class="form-control" id="subject" name="subject" placeholder="Subjek" value="<?= set_value('subject') ?>" required>
                  </div>
                  <?= form_error('subject', '<small class="text-danger">', '</small>') ?>
                </div>
                <div class="form-group">
                  <label for="message">Pesan <span class="text-danger">*</span></label>
                  <textarea class="form-control" id="message" name="message" rows="5" placeholder="Tulis pesan Anda di sini..." required><?= set_value('message') ?></textarea>
                  <?= form_error('message', '<small class="text-danger">', '</small>') ?>
                </div>
                <div class="form-group mt-3">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="privacy_policy" name="privacy_policy" required>
                    <label class="form-check-label" for="privacy_policy">
                      Saya menyetujui <a href="#" class="text-success">Kebijakan Privasi</a> dan mengizinkan Tim Rekrutmen RSUD H. Abdul Aziz Marabahan untuk menghubungi saya.
                    </label>
                  </div>
                </div>
                <div class="row mt-4">
                  <div class="col-md-12">
                    <button type="submit" class="btn bg-gradient-primary">Kirim Pesan</button>
                  </div>
                </div>
              </div>
            <?= form_close() ?>
          </div>
          <div class="col-md-5">
            <div class="info-horizontal bg-gradient-primary border-radius-xl p-4 h-100">
              <div class="icon">
                <i class="fas fa-map-marker-alt text-white"></i>
              </div>
              <div class="description ps-3">
                <h5 class="text-white">Alamat</h5>
                <p class="text-white opacity-8">Bagian Kepegawaian RSUD H. Abdul Aziz Marabahan<br>Jl. Jenderal Sudirman No. 1<br>Marabahan, Kalimantan Selatan</p>
              </div>
              <div class="icon mt-4">
                <i class="fas fa-phone text-white"></i>
              </div>
              <div class="description ps-3">
                <h5 class="text-white">Telepon</h5>
                <p class="text-white opacity-8">(0511) 123-456</p>
              </div>
              <div class="icon mt-4">
                <i class="fas fa-envelope text-white"></i>
              </div>
              <div class="description ps-3">
                <h5 class="text-white">Email</h5>
                <p class="text-white opacity-8">rekrutmen@rsud-marabahan.go.id</p>
              </div>
              <div class="icon mt-4">
                <i class="fas fa-clock text-white"></i>
              </div>
              <div class="description ps-3">
                <h5 class="text-white">Jam Pelayanan</h5>
                <p class="text-white opacity-8">Senin - Jumat: 08:00 - 16:00 WITA</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row mt-4">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body p-4">
          <div class="row">
            <div class="col-md-12 text-center">
              <h3 class="mb-4">Lokasi Kami</h3>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="map-container">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3982.822369842634!2d114.765668314758!3d-3.39462799753714!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2de45d4d38e5d0e7%3A0x3b4c1e4b3e3e3e3!2sRSUD%20H.%20Abdul%20Aziz%20Marabahan!5e0!3m2!1sen!2sid!4v1625647417076!5m2!1sen!2sid" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row mt-4">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body p-4">
          <div class="row">
            <div class="col-md-12 text-center">
              <h3 class="mb-4">Pertanyaan Umum</h3>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="accordion" id="accordionFaq1">
                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                      Bagaimana cara mendaftar di sistem rekrutmen ini?
                    </button>
                  </h2>
                  <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionFaq1">
                    <div class="accordion-body">
                      Untuk mendaftar, klik tombol "Daftar" di halaman utama, lalu isi formulir dengan data yang valid. Setelah itu, Anda dapat melengkapi profil dan mulai melamar lowongan yang tersedia.
                    </div>
                  </div>
                </div>
                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                      Apakah ada biaya dalam proses rekrutmen?
                    </button>
                  </h2>
                  <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionFaq1">
                    <div class="accordion-body">
                      Seluruh proses rekrutmen di RSUD H. Abdul Aziz Marabahan tidak dipungut biaya apapun. Harap berhati-hati terhadap pihak yang meminta imbalan dalam bentuk apapun.
                    </div>
                  </div>
                </div>
                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                      Dokumen apa saja yang perlu disiapkan?
                    </button>
                  </h2>
                  <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionFaq1">
                    <div class="accordion-body">
                      Dokumen yang diperlukan biasanya mencakup KTP, CV, Ijazah, Transkrip Nilai, dan dokumen pendukung lainnya seperti STR (untuk tenaga kesehatan). Pastikan untuk memeriksa persyaratan spesifik pada setiap lowongan.
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="accordion" id="accordionFaq2">
                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingFour">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                      Bagaimana cara mengetahui status lamaran saya?
                    </button>
                  </h2>
                  <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionFaq2">
                    <div class="accordion-body">
                      Anda dapat memantau status lamaran Anda melalui dasbor pelamar setelah login ke akun Anda. Notifikasi penting terkait proses seleksi juga akan dikirimkan melalui email.
                    </div>
                  </div>
                </div>
                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingFive">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                      Apakah saya bisa melamar lebih dari satu posisi?
                    </button>
                  </h2>
                  <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#accordionFaq2">
                    <div class="accordion-body">
                      Ya, Anda dapat melamar beberapa posisi yang berbeda selama Anda memenuhi kualifikasi yang dipersyaratkan. Namun, kami sarankan untuk fokus pada posisi yang paling sesuai dengan keahlian dan minat Anda.
                    </div>
                  </div>
                </div>
                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingSix">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                      Siapa yang harus dihubungi jika ada kendala teknis?
                    </button>
                  </h2>
                  <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix" data-bs-parent="#accordionFaq2">
                    <div class="accordion-body">
                      Jika Anda mengalami kendala teknis saat menggunakan portal rekrutmen ini, silakan kirimkan email ke <a href="mailto:rekrutmen@rsud-marabahan.go.id">rekrutmen@rsud-marabahan.go.id</a> dengan menyertakan screenshot dan penjelasan detail mengenai kendala yang Anda hadapi.
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
