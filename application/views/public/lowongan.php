<div class="page-header min-vh-75 d-flex align-items-center" style="background-image: url('<?= base_url('assets/img/gallery-hero-bg.jpg') ?>'); background-size: cover; background-position: center;">
  <span class="mask bg-gradient-dark opacity-7"></span>
  <div class="container">
    <div class="row">
      <div class="col-md-10 mx-auto">
        <div class="text-center">
          <h1 class="text-white display-4 font-weight-bold mb-4">Koleksi Kerajinan</h1>
          <p class="lead text-white fs-5 mb-4">Jelajahi Karya Seni Anyaman Eceng Gondok Terbaik</p>
          <p class="text-white opacity-9 mb-5">Temukan Kerajinan Berkualitas Tinggi dari Tangan Terampil Pengrajin Lokal</p>
          <div class="row justify-content-center">
            <!-- <div class="col-md-8">
              <div class="card card-body bg-white bg-opacity-10 backdrop-blur border-0 shadow-lg py-3">
                <div class="row align-items-center">
                  <div class="col-md-4 text-center mb-3 mb-md-0">
                    <i class="fas fa-palette text-warning fa-2x mb-2"></i>
                    <h6 class="text-gray mb-0">Seni Berkualitas</h6>
                  </div>
                  <div class="col-md-4 text-center mb-3 mb-md-0">
                    <i class="fas fa-leaf text-warning fa-2x mb-2"></i>
                    <h6 class="text-gray mb-0">Bahan Alami</h6>
                  </div>
                  <div class="col-md-4 text-center">
                    <i class="fas fa-award text-warning fa-2x mb-2"></i>
                    <h6 class="text-gray mb-0">Produk Unggulan</h6>
                  </div>
                </div>
              </div>
            </div> -->
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
        <form id="job-filter-form" action="<?= base_url('lowongan') ?>" method="get">
          <div class="row">
            <div class="col-md-3">
              <div class="input-group">
                <span class="input-group-text"><i class="fas fa-search"></i></span>
                <input type="text" class="form-control" name="q" id="search-input"
                       placeholder="Cari lowongan, posisi, perusahaan..."
                       value="<?= $this->input->get('q') ?>"
                       autocomplete="off">
              </div>
              <!-- Search suggestions dropdown -->
              <div id="search-suggestions" class="dropdown-menu w-100" style="display: none; max-height: 200px; overflow-y: auto;">
                <!-- Suggestions will be populated by JavaScript -->
              </div>
            </div>
            <div class="col-md-3">
              <select class="form-control" id="filter-category" name="category">
                <option value="">Semua Kategori</option>
                <?php foreach ($categories as $category) : ?>
                  <option value="<?= $category->id ?>" <?= $this->input->get('category') == $category->id ? 'selected' : '' ?>><?= $category->nama ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="col-md-2">
              <select class="form-control" id="filter-location" name="location">
                <option value="">Semua Lokasi</option>
                <?php if (!empty($locations)) : ?>
                  <?php foreach ($locations as $location) : ?>
                    <option value="<?= $location->lokasi ?>" <?= $this->input->get('location') == $location->lokasi ? 'selected' : '' ?>><?= $location->lokasi ?></option>
                  <?php endforeach; ?>
                <?php endif; ?>
              </select>
            </div>
            <div class="col-md-2">
              <select class="form-control" id="filter-job-type" name="job_type">
                <option value="">Semua Tipe</option>
                <option value="penuh_waktu" <?= $this->input->get('job_type') == 'penuh_waktu' ? 'selected' : '' ?>>Full Time</option>
                <option value="paruh_waktu" <?= $this->input->get('job_type') == 'paruh_waktu' ? 'selected' : '' ?>>Part Time</option>
                <option value="kontrak" <?= $this->input->get('job_type') == 'kontrak' ? 'selected' : '' ?>>Kontrak</option>
                <option value="magang" <?= $this->input->get('job_type') == 'magang' ? 'selected' : '' ?>>Magang</option>
              </select>
            </div>
            <div class="col-md-1">
              <button type="submit" class="btn bg-gradient-primary w-100">
                <i class="fas fa-search"></i>
              </button>
            </div>
            <div class="col-md-1">
              <button type="button" id="reset-filter" class="btn btn-outline-secondary w-100" title="Reset Filter">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="row mt-4">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header p-3">
          <div class="d-flex justify-content-between align-items-center">
            <div>
              <h5 class="mb-0">Daftar Lowongan Pekerjaan</h5>
              <p class="text-sm mb-0">
                <?php if (!empty($jobs)) : ?>
                  Menampilkan <?= count($jobs) ?> dari <?= $total_jobs ?> lowongan
                <?php else : ?>
                  Tidak ada lowongan yang tersedia
                <?php endif; ?>
              </p>
            </div>

            <!-- Active Filters -->
            <?php
            $active_filters = [];
            if ($this->input->get('q')) $active_filters[] = 'Pencarian: "' . $this->input->get('q') . '"';
            if ($this->input->get('category')) {
              foreach ($categories as $cat) {
                if ($cat->id == $this->input->get('category')) {
                  $active_filters[] = 'Kategori: ' . $cat->nama;
                  break;
                }
              }
            }
            if ($this->input->get('location')) $active_filters[] = 'Lokasi: ' . $this->input->get('location');
            if ($this->input->get('job_type')) {
              $job_type_labels = [
                'penuh_waktu' => 'Full Time',
                'paruh_waktu' => 'Part Time',
                'kontrak' => 'Kontrak',
                'magang' => 'Magang'
              ];
              $active_filters[] = 'Tipe: ' . $job_type_labels[$this->input->get('job_type')];
            }
            ?>

            <div class="text-end">
              <!-- Sorting dropdown -->
              <div class="mb-2">
                <small class="text-muted me-2">Urutkan:</small>
                <select class="form-select form-select-sm d-inline-block w-auto" id="sort-select" onchange="applySorting()">
                  <option value="newest" <?= $this->input->get('sort') == 'newest' ? 'selected' : '' ?>>Terbaru</option>
                  <option value="oldest" <?= $this->input->get('sort') == 'oldest' ? 'selected' : '' ?>>Terlama</option>
                  <option value="deadline" <?= $this->input->get('sort') == 'deadline' ? 'selected' : '' ?>>Deadline Terdekat</option>
                  <option value="title" <?= $this->input->get('sort') == 'title' ? 'selected' : '' ?>>Nama A-Z</option>
                </select>
              </div>

              <?php if (!empty($active_filters)) : ?>
                <div>
                  <small class="text-muted">Filter aktif:</small><br>
                  <?php foreach ($active_filters as $filter) : ?>
                    <span class="badge bg-gradient-info me-1 mb-1"><?= $filter ?></span>
                  <?php endforeach; ?>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
        <div class="card-body p-3">
          <?php if (empty($jobs)) : ?>
            <div class="text-center py-5">
              <h4 class="text-secondary">Tidak ada lowongan yang ditemukan</h4>
              <p class="text-muted">Silakan coba dengan filter yang berbeda atau kembali lagi nanti.</p>
            </div>
          <?php else : ?>
            <div class="row">
              <?php foreach ($jobs as $job) : ?>
                <div class="col-md-6 mb-4">
                  <div class="card job-card h-100">
                    <div class="card-body">
                      <div class="d-flex justify-content-between mb-2">
                        <span class="badge bg-gradient-<?= $job->jenis_pekerjaan == 'penuh_waktu' ? 'success' : ($job->jenis_pekerjaan == 'paruh_waktu' ? 'info' : ($job->jenis_pekerjaan == 'kontrak' ? 'warning' : 'secondary')) ?> job-badge"><?= $job->jenis_pekerjaan == 'penuh_waktu' ? 'Full Time' : ($job->jenis_pekerjaan == 'paruh_waktu' ? 'Part Time' : ($job->jenis_pekerjaan == 'kontrak' ? 'Kontrak' : 'Magang')) ?></span>
                        <?php if ($job->unggulan) : ?>
                          <span class="badge bg-gradient-primary job-badge">Unggulan</span>
                        <?php endif; ?>
                      </div>
                      <h5 class="card-title"><?= $job->judul ?></h5>
                      <p class="card-text text-sm mb-1"><i class="fas fa-building me-1"></i> <?= $job->company_name ?? 'SIREK Company' ?></p>
                      <p class="card-text text-sm mb-1"><i class="fas fa-map-marker-alt me-1"></i> <?= $job->lokasi ?></p>
                      <p class="card-text text-sm mb-1"><i class="fas fa-tag me-1"></i> <?= $job->category_name ?></p>
                      <?php if ($job->rentang_gaji) : ?>
                        <p class="card-text text-sm mb-1"><i class="fas fa-money-bill-wave me-1"></i> <?= $job->rentang_gaji ?></p>
                      <?php endif; ?>
                      <p class="card-text text-sm mb-3"><i class="fas fa-calendar me-1"></i> Batas: <?= date('d M Y', strtotime($job->batas_waktu)) ?></p>

                      <div class="d-flex justify-content-between align-items-center mt-3">
                        <a href="<?= base_url('lowongan/detail/' . $job->id) ?>" class="btn btn-outline-primary btn-sm">Lihat Detail</a>
                        <?php if ($this->session->userdata('logged_in') && $this->session->userdata('role') == 'pelamar') : ?>
                          <a href="<?= base_url('pelamar/lamar/' . $job->id) ?>" class="btn btn-primary btn-sm">Lamar Sekarang</a>
                        <?php else : ?>
                          <a href="<?= base_url('auth') ?>" class="btn btn-primary btn-sm">Login untuk Melamar</a>
                        <?php endif; ?>
                      </div>
                    </div>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>

            <!-- Pagination -->
            <div class="row mt-4">
              <div class="col-md-12">
                <nav aria-label="Page navigation">
                  <?= $pagination ?>
                </nav>

                <!-- Load More Button (Alternative to pagination) -->
                <?php if (count($jobs) >= 10 && count($jobs) < $total_jobs) : ?>
                  <div class="text-center mt-3">
                    <button type="button" id="load-more-btn" class="btn btn-outline-primary"
                            data-page="<?= ($this->uri->segment(2) ?: 0) + 10 ?>"
                            data-loading="false">
                      <i class="fas fa-plus me-2"></i>Muat Lebih Banyak
                    </button>
                    <div id="loading-spinner" class="spinner-border spinner-border-sm ms-2" style="display: none;"></div>
                  </div>
                <?php endif; ?>
              </div>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>

  <div class="row mt-4">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-md-6">
              <h5>Mengapa Bergabung dengan Kami?</h5>
              <p class="text-sm">SIREK menawarkan lingkungan kerja yang dinamis dan mendukung pengembangan karir Anda. Kami menghargai inovasi, kolaborasi, dan pertumbuhan profesional.</p>
              <ul class="text-sm">
                <li>Paket kompensasi yang kompetitif</li>
                <li>Kesempatan pengembangan karir</li>
                <li>Lingkungan kerja yang inklusif</li>
                <li>Program kesejahteraan karyawan</li>
                <li>Keseimbangan kehidupan kerja</li>
              </ul>
            </div>
            <div class="col-md-6">
              <h5>Proses Rekrutmen</h5>
              <div class="timeline timeline-one-side">
                <div class="timeline-block mb-3">
                  <span class="timeline-step">
                    <i class="ni ni-send text-primary"></i>
                  </span>
                  <div class="timeline-content">
                    <h6 class="text-dark text-sm font-weight-bold mb-0">Pengiriman Lamaran</h6>
                    <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">Kirim CV dan surat lamaran Anda</p>
                  </div>
                </div>
                <div class="timeline-block mb-3">
                  <span class="timeline-step">
                    <i class="ni ni-check-bold text-info"></i>
                  </span>
                  <div class="timeline-content">
                    <h6 class="text-dark text-sm font-weight-bold mb-0">Seleksi Berkas</h6>
                    <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">Evaluasi kualifikasi dan pengalaman</p>
                  </div>
                </div>
                <div class="timeline-block mb-3">
                  <span class="timeline-step">
                    <i class="ni ni-ruler-pencil text-warning"></i>
                  </span>
                  <div class="timeline-content">
                    <h6 class="text-dark text-sm font-weight-bold mb-0">Penilaian</h6>
                    <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">Tes kemampuan teknis dan non-teknis</p>
                  </div>
                </div>
                <div class="timeline-block mb-3">
                  <span class="timeline-step">
                    <i class="ni ni-chat-round text-success"></i>
                  </span>
                  <div class="timeline-content">
                    <h6 class="text-dark text-sm font-weight-bold mb-0">Wawancara</h6>
                    <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">Diskusi dengan tim rekrutmen dan departemen terkait</p>
                  </div>
                </div>
                <div class="timeline-block">
                  <span class="timeline-step">
                    <i class="ni ni-trophy text-primary"></i>
                  </span>
                  <div class="timeline-content">
                    <h6 class="text-dark text-sm font-weight-bold mb-0">Penawaran Kerja</h6>
                    <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">Negosiasi dan penandatanganan kontrak</p>
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Reset filter functionality
    const resetButton = document.getElementById('reset-filter');
    if (resetButton) {
        resetButton.addEventListener('click', function() {
            // Clear all form inputs
            const form = document.getElementById('job-filter-form');
            const inputs = form.querySelectorAll('input[type="text"], select');

            inputs.forEach(function(input) {
                if (input.tagName === 'SELECT') {
                    input.selectedIndex = 0;
                } else {
                    input.value = '';
                }
            });

            // Redirect to clean URL
            window.location.href = '<?= base_url('lowongan') ?>';
        });
    }

    // Auto-submit on filter change (optional - uncomment if needed)
    /*
    const filterSelects = document.querySelectorAll('#filter-category, #filter-location, #filter-job-type');
    filterSelects.forEach(function(select) {
        select.addEventListener('change', function() {
            document.getElementById('job-filter-form').submit();
        });
    });
    */

    // Search functionality
    const searchInput = document.getElementById('search-input');
    const suggestionsDiv = document.getElementById('search-suggestions');

    if (searchInput && suggestionsDiv) {
        // Search suggestions data
        const searchSuggestions = [
            'Programmer', 'Developer', 'Software Engineer', 'Web Developer',
            'Mobile Developer', 'Frontend Developer', 'Backend Developer',
            'UI/UX Designer', 'Graphic Designer', 'Digital Marketing',
            'Content Writer', 'Social Media Specialist', 'SEO Specialist',
            'Data Analyst', 'Business Analyst', 'Project Manager',
            'HR Manager', 'Sales Executive', 'Customer Service',
            'Accounting', 'Finance', 'Admin', 'Secretary'
        ];

        // Show suggestions on input
        searchInput.addEventListener('input', function() {
            const query = this.value.toLowerCase().trim();

            if (query.length >= 2) {
                const matches = searchSuggestions.filter(item =>
                    item.toLowerCase().includes(query)
                ).slice(0, 5);

                if (matches.length > 0) {
                    suggestionsDiv.innerHTML = matches.map(item =>
                        `<a href="#" class="dropdown-item" data-value="${item}">
                            <i class="fas fa-search me-2"></i>${item}
                        </a>`
                    ).join('');
                    suggestionsDiv.style.display = 'block';
                } else {
                    suggestionsDiv.style.display = 'none';
                }
            } else {
                suggestionsDiv.style.display = 'none';
            }
        });

        // Handle suggestion clicks
        suggestionsDiv.addEventListener('click', function(e) {
            e.preventDefault();
            if (e.target.classList.contains('dropdown-item')) {
                const value = e.target.getAttribute('data-value');
                searchInput.value = value;
                suggestionsDiv.style.display = 'none';
                document.getElementById('job-filter-form').submit();
            }
        });

        // Hide suggestions when clicking outside
        document.addEventListener('click', function(e) {
            if (!searchInput.contains(e.target) && !suggestionsDiv.contains(e.target)) {
                suggestionsDiv.style.display = 'none';
            }
        });

        // Search on Enter key
        searchInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                suggestionsDiv.style.display = 'none';
                document.getElementById('job-filter-form').submit();
            }
        });

        // Handle arrow keys for suggestion navigation
        let selectedIndex = -1;
        searchInput.addEventListener('keydown', function(e) {
            const suggestions = suggestionsDiv.querySelectorAll('.dropdown-item');

            if (e.key === 'ArrowDown') {
                e.preventDefault();
                selectedIndex = Math.min(selectedIndex + 1, suggestions.length - 1);
                updateSelection(suggestions);
            } else if (e.key === 'ArrowUp') {
                e.preventDefault();
                selectedIndex = Math.max(selectedIndex - 1, -1);
                updateSelection(suggestions);
            } else if (e.key === 'Enter' && selectedIndex >= 0) {
                e.preventDefault();
                suggestions[selectedIndex].click();
            }
        });

        function updateSelection(suggestions) {
            suggestions.forEach((item, index) => {
                if (index === selectedIndex) {
                    item.classList.add('active');
                } else {
                    item.classList.remove('active');
                }
            });
        }
    }

    // Highlight search terms in results
    const searchTerm = '<?= $this->input->get('q') ?>';
    if (searchTerm) {
        const jobCards = document.querySelectorAll('.job-card');
        jobCards.forEach(function(card) {
            const title = card.querySelector('.card-title');
            const content = card.querySelector('.card-text');

            if (title) {
                title.innerHTML = highlightText(title.innerHTML, searchTerm);
            }
        });
    }

    function highlightText(text, term) {
        if (!term) return text;
        const regex = new RegExp(`(${term})`, 'gi');
        return text.replace(regex, '<mark class="bg-warning">$1</mark>');
    }
});

// Sorting functionality
function applySorting() {
    const sortValue = document.getElementById('sort-select').value;
    const currentUrl = new URL(window.location.href);

    // Add or update sort parameter
    currentUrl.searchParams.set('sort', sortValue);

    // Redirect with new sort parameter
    window.location.href = currentUrl.toString();
}
</script>