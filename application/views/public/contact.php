<div class="page-header min-vh-50" style="background-image: url('<?= base_url('assets/img/contact-bg.jpg') ?>');">
  <span class="mask bg-gradient-dark opacity-6"></span>
  <div class="container">
    <div class="row">
      <div class="col-md-8 mx-auto">
        <div class="text-center">
          <h1 class="text-white">Hubungi Kami</h1>
          <p class="lead text-white">Kami siap membantu Anda dengan pertanyaan atau kebutuhan rekrutmen Anda</p>
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
            <p class="text-sm">Isi formulir di bawah ini dan tim kami akan menghubungi Anda sesegera mungkin.</p>
            
            <?= form_open('home/contact', ['class' => 'needs-validation']) ?>
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
                      Saya menyetujui <a href="#">Kebijakan Privasi</a> dan mengizinkan RSUD H. Abdul Aziz Marabahan untuk menghubungi saya.
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
                <p class="text-white opacity-8">Jl. Jenderal Sudirman No. 10, Marabahan<br>Kalimantan Selatan, 70513<br>Indonesia</p>
              </div>
              <div class="icon mt-4">
                <i class="fas fa-phone text-white"></i>
              </div>
              <div class="description ps-3">
                <h5 class="text-white">Telepon</h5>
                <p class="text-white opacity-8">(0511) 4799118</p>
              </div>
              <div class="icon mt-4">
                <i class="fas fa-envelope text-white"></i>
              </div>
              <div class="description ps-3">
                <h5 class="text-white">Email</h5>
                <p class="text-white opacity-8">bludrsudhabdulazizmarabahan@gmail.com</p>
              </div>
              <div class="icon mt-4">
                <i class="fas fa-clock text-white"></i>
              </div>
              <div class="description ps-3">
                <h5 class="text-white">Jam Kerja</h5>
                <p class="text-white opacity-8">Senin - Jumat: 09:00 - 17:00<br>Sabtu: 09:00 - 13:00<br>Minggu: Tutup</p>
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
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.2904357243077!2d106.82796841476913!3d-6.227483395493522!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f3e8708c5825%3A0xbca490d21bba1b37!2sJl.%20H.%20R.%20Rasuna%20Said%2C%20Karet%20Kuningan%2C%20Kecamatan%20Setiabudi%2C%20Kota%20Jakarta%20Selatan%2C%20Daerah%20Khusus%20Ibukota%20Jakarta!5e0!3m2!1sid!2sid!4v1625647417076!5m2!1sid!2sid" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
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
                      Untuk mendaftar, klik tombol "Daftar" di halaman beranda atau halaman login. Isi formulir pendaftaran dengan informasi yang diperlukan, seperti nama, email, dan password. Setelah mendaftar, Anda dapat melengkapi profil Anda dan mulai melamar pekerjaan.
                    </div>
                  </div>
                </div>
                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                      Apakah ada biaya untuk melamar?
                    </button>
                  </h2>
                  <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionFaq1">
                    <div class="accordion-body">
                      Tidak, seluruh proses rekrutmen di RSUD H. Abdul Aziz Marabahan tidak dipungut biaya apapun. Hati-hati terhadap penipuan yang mengatasnamakan kami.
                    </div>
                  </div>
                </div>
                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                      Bagaimana cara melamar pekerjaan?
                    </button>
                  </h2>
                  <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionFaq1">
                    <div class="accordion-body">
                      Setelah login, Anda dapat mencari lowongan pekerjaan yang tersedia. Klik pada lowongan yang Anda minati, lalu klik tombol "Lamar Sekarang". Pastikan Anda telah melengkapi profil dan dokumen yang diperlukan sebelum mengirimkan lamaran.
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
                      Dokumen apa saja yang perlu disiapkan?
                    </button>
                  </h2>
                  <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionFaq2">
                    <div class="accordion-body">
                      Persyaratan dokumen dapat bervariasi tergantung pada posisi yang dilamar. Namun, secara umum Anda perlu menyiapkan CV, KTP, ijazah, transkrip nilai, dan dokumen pendukung lainnya seperti STR atau sertifikat keahlian.
                    </div>
                  </div>
                </div>
                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingFive">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                      Bagaimana saya bisa mengetahui status lamaran saya?
                    </button>
                  </h2>
                  <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#accordionFaq2">
                    <div class="accordion-body">
                      Anda dapat melacak status lamaran Anda melalui dasbor pelamar setelah Anda login. Kami juga akan mengirimkan notifikasi melalui email mengenai perkembangan proses seleksi.
                    </div>
                  </div>
                </div>
                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingSix">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                      Siapa yang harus dihubungi jika ada pertanyaan?
                    </button>
                  </h2>
                  <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix" data-bs-parent="#accordionFaq2">
                    <div class="accordion-body">
                      Jika Anda memiliki pertanyaan lebih lanjut, silakan gunakan formulir kontak di halaman ini atau hubungi bagian kepegawaian kami melalui email di rekrutmen@rsud-marabahan.go.id.
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
