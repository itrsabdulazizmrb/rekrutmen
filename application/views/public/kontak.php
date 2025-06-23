<div class="page-header min-vh-75 d-flex align-items-center" style="background-image: url('<?= base_url('assets/img/gallery-hero-bg.jpg') ?>'); background-size: cover; background-position: center;">
  <span class="mask bg-gradient-dark opacity-7"></span>
  <div class="container">
    <div class="row">
      <div class="col-md-10 mx-auto">
        <div class="text-center">
          <h1 class="text-white display-4 font-weight-bold mb-4">Hubungi Kami</h1>
          <p class="lead text-white fs-5 mb-4">Kami Siap Membantu dan Melayani Anda</p>
          <p class="text-white opacity-9 mb-5">Kunjungi Gallery Kembang Ilung atau Hubungi Kami untuk Informasi Lebih Lanjut</p>
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
            <p class="text-sm">Hubungi kami untuk konsultasi produk, pemesanan custom, atau informasi workshop anyaman eceng gondok.</p>

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
                      Saya menyetujui <a href="#" class="text-success">Kebijakan Privasi</a> dan mengizinkan Gallery Kembang Ilung untuk menghubungi saya.
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
                <p class="text-white opacity-8">Desa Banyu Hirang<br>Kecamatan Amuntai Selatan<br>Kabupaten Hulu Sungai Tengah<br>Kalimantan Selatan</p>
              </div>
              <div class="icon mt-4">
                <i class="fas fa-phone text-white"></i>
              </div>
              <div class="description ps-3">
                <h5 class="text-white">Telepon</h5>
                <p class="text-white opacity-8">+62 21 1234 5678<br>+62 812 3456 7890</p>
              </div>
              <div class="icon mt-4">
                <i class="fas fa-envelope text-white"></i>
              </div>
              <div class="description ps-3">
                <h5 class="text-white">Email</h5>
                <p class="text-white opacity-8">info@gallerykembangilung.com<br>galeri@kembangilung.com</p>
              </div>
              <div class="icon mt-4">
                <i class="fas fa-clock text-white"></i>
              </div>
              <div class="description ps-3">
                <h5 class="text-white">Jam Buka</h5>
                <p class="text-white opacity-8">Senin - Minggu: 08:00 - 17:00<br>Hari Libur Nasional: Tutup</p>
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
                      Apa itu Gallery Kembang Ilung?
                    </button>
                  </h2>
                  <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionFaq1">
                    <div class="accordion-body">
                      Gallery Kembang Ilung adalah destinasi wisata seni kerajinan tradisional yang mengkhususkan diri pada anyaman eceng gondok. Kami melestarikan warisan budaya Indonesia melalui produk kerajinan berkualitas tinggi yang dibuat oleh pengrajin lokal berpengalaman.
                    </div>
                  </div>
                </div>
                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                      Bagaimana cara memesan produk kerajinan?
                    </button>
                  </h2>
                  <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionFaq1">
                    <div class="accordion-body">
                      Anda dapat memesan produk melalui website kami atau datang langsung ke galeri. Pilih produk yang diinginkan, tentukan jumlah dan spesifikasi, lalu hubungi kami melalui WhatsApp atau formulir kontak. Kami juga menerima pesanan custom sesuai kebutuhan Anda.
                    </div>
                  </div>
                </div>
                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                      Apakah tersedia workshop anyaman eceng gondok?
                    </button>
                  </h2>
                  <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionFaq1">
                    <div class="accordion-body">
                      Ya, kami menyelenggarakan workshop anyaman eceng gondok secara rutin. Workshop dipandu langsung oleh master pengrajin berpengalaman. Peserta akan belajar teknik dasar hingga mahir membuat berbagai produk anyaman. Daftar melalui website atau hubungi kami langsung.
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
                      Berapa lama waktu pembuatan produk custom?
                    </button>
                  </h2>
                  <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionFaq2">
                    <div class="accordion-body">
                      Waktu pembuatan produk custom bervariasi tergantung kompleksitas dan ukuran pesanan. Umumnya membutuhkan 1-3 minggu untuk produk sederhana dan 3-6 minggu untuk produk kompleks seperti furniture. Kami akan memberikan estimasi waktu yang akurat saat konsultasi pesanan.
                    </div>
                  </div>
                </div>
                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingFive">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                      Apakah produk dapat dikirim ke luar daerah?
                    </button>
                  </h2>
                  <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#accordionFaq2">
                    <div class="accordion-body">
                      Ya, kami melayani pengiriman ke seluruh Indonesia melalui jasa ekspedisi terpercaya. Biaya pengiriman akan disesuaikan dengan berat, ukuran, dan tujuan pengiriman. Untuk produk besar seperti furniture, kami menggunakan kargo khusus untuk memastikan keamanan produk.
                    </div>
                  </div>
                </div>
                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingSix">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                      Bagaimana cara merawat produk anyaman eceng gondok?
                    </button>
                  </h2>
                  <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix" data-bs-parent="#accordionFaq2">
                    <div class="accordion-body">
                      Produk anyaman eceng gondok mudah dirawat. Bersihkan dengan kain lembab secara berkala, hindari terkena air berlebihan, dan simpan di tempat kering. Untuk furniture, gunakan pelindung dari sinar matahari langsung. Dengan perawatan yang baik, produk dapat bertahan puluhan tahun.
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
