<!-- Content Wrapper -->
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card my-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
          <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
            <h6 class="text-white text-capitalize ps-3">Laporan & Statistik</h6>
          </div>
        </div>
        <div class="card-body px-0 pb-2">
          
          <!-- Summary Cards -->
          <div class="row mb-4 px-3">
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
              <div class="card">
                <div class="card-header p-3 pt-2">
                  <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                    <i class="material-icons opacity-10"></i>
                  </div>
                  <div class="text-end pt-1">
                    <p class="text-sm mb-0 text-capitalize">Total Lowongan</p>
                    <h4 class="mb-0"><?= number_format($summary['total_lowongan']) ?></h4>
                  </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-3">
                  <p class="mb-0"><span class="text-success text-sm font-weight-bolder"><?= number_format($summary['lowongan_aktif']) ?> </span>lowongan aktif</p>
                </div>
              </div>
            </div>
            
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
              <div class="card">
                <div class="card-header p-3 pt-2">
                  <div class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                    <i class="material-icons opacity-10"></i>
                  </div>
                  <div class="text-end pt-1">
                    <p class="text-sm mb-0 text-capitalize">Total Lamaran</p>
                    <h4 class="mb-0"><?= number_format($summary['total_lamaran']) ?></h4>
                  </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-3">
                  <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+<?= number_format($summary['lamaran_bulan_ini']) ?> </span>bulan ini</p>
                </div>
              </div>
            </div>
            
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
              <div class="card">
                <div class="card-header p-3 pt-2">
                  <div class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                    <i class="material-icons opacity-10"></i>
                  </div>
                  <div class="text-end pt-1">
                    <p class="text-sm mb-0 text-capitalize">Total Pelamar</p>
                    <h4 class="mb-0"><?= number_format($summary['total_pelamar']) ?></h4>
                  </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-3">
                  <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+<?= number_format($summary['pelamar_baru_bulan_ini']) ?> </span>pelamar baru</p>
                </div>
              </div>
            </div>
            
            <div class="col-xl-3 col-sm-6">
              <div class="card">
                <div class="card-header p-3 pt-2">
                  <div class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
                    <i class="material-icons opacity-10"></i>
                  </div>
                  <div class="text-end pt-1">
                    <p class="text-sm mb-0 text-capitalize">Total Penilaian</p>
                    <h4 class="mb-0"><?= number_format($summary['total_penilaian']) ?></h4>
                  </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-3">
                  <p class="mb-0"><span class="text-success text-sm font-weight-bolder"><?= number_format($summary['penilaian_selesai']) ?> </span>selesai</p>
                </div>
              </div>
            </div>
          </div>

          <!-- Report Menu -->
          <div class="row px-3">
            <div class="col-12">
              <h5 class="mb-3">Menu Laporan</h5>
            </div>
            
            <div class="col-lg-3 col-md-6 mb-4">
              <div class="card h-100">
                <div class="card-body text-center">
                  <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md mb-3 mx-auto">
                    <i class="fas fa-tasks opacity-10"></i>
                  </div>
                  <h5 class="card-title">Laporan Lowongan</h5>
                  <!-- <p class="card-text">Laporan lengkap tentang lowongan pekerjaan berdasarkan periode, kategori, status, dan lokasi.</p> -->
                  <a href="<?= base_url('admin/laporan_lowongan') ?>" class="btn bg-gradient-primary">Lihat Laporan</a>
                </div>
              </div>
            </div>
            
            <div class="col-lg-3 col-md-6 mb-4">
              <div class="card h-100">
                <div class="card-body text-center">
                  <div class="icon icon-shape bg-gradient-success shadow text-center border-radius-md mb-3 mx-auto">
                    <i class="fas fa-tasks opacity-10"></i>
                  </div>
                  <h5 class="card-title">Laporan Lamaran</h5>
                  <!-- <p class="card-text">Analisis lamaran berdasarkan status, conversion rate, dan statistik per lowongan.</p> -->
                  <a href="<?= base_url('admin/laporan_lamaran') ?>" class="btn bg-gradient-success">Lihat Laporan</a>
                </div>
              </div>
            </div>
            
            <div class="col-lg-3 col-md-6 mb-4">
              <div class="card h-100">
                <div class="card-body text-center">
                  <div class="icon icon-shape bg-gradient-info shadow text-center border-radius-md mb-3 mx-auto">
                    <i class="fas fa-tasks opacity-10"></i>
                  </div>
                  <h5 class="card-title">Laporan Pelamar</h5>
                  <!-- <p class="card-text">Data pelamar berdasarkan registrasi, lokasi, pendidikan, dan aktivitas login.</p> -->
                  <a href="<?= base_url('admin/laporan_pelamar') ?>" class="btn bg-gradient-info">Lihat Laporan</a>
                </div>
              </div>
            </div>
            
            <div class="col-lg-3 col-md-6 mb-4">
              <div class="card h-100">
                <div class="card-body text-center">
                  <div class="icon icon-shape bg-gradient-warning shadow text-center border-radius-md mb-3 mx-auto">
                    <i class="fas fa-tasks opacity-10"></i>
                  </div>
                  <h5 class="card-title">Laporan Penilaian</h5>
                  <!-- <p class="card-text">Hasil penilaian, skor rata-rata, tingkat kelulusan, dan waktu pengerjaan.</p> -->
                  <a href="<?= base_url('admin/laporan_penilaian') ?>" class="btn bg-gradient-warning">Lihat Laporan</a>
                </div>
              </div>
            </div>
          </div>

          <!-- Quick Actions -->
          <!-- <div class="row px-3 mt-4">
            <div class="col-12">
              <div class="card">
                <div class="card-header pb-0">
                  <h6>Aksi Cepat</h6>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-3 mb-2">
                      <button class="btn btn-outline-primary w-100" onclick="exportAllReports('excel')">
                        <i class="material-icons me-2">file_download</i>Export Excel
                      </button>
                    </div>
                    <div class="col-md-3 mb-2">
                      <button class="btn btn-outline-danger w-100" onclick="exportAllReports('pdf')">
                        <i class="material-icons me-2">picture_as_pdf</i>Export PDF
                      </button>
                    </div>
                    <div class="col-md-3 mb-2">
                      <button class="btn btn-outline-success w-100" onclick="printSummary()">
                        <i class="material-icons me-2">print</i>Cetak Ringkasan
                      </button>
                    </div>
                    <div class="col-md-3 mb-2">
                      <button class="btn btn-outline-info w-100" onclick="refreshData()">
                        <i class="material-icons me-2">refresh</i>Refresh Data
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div> -->

        </div>
      </div>
    </div>
  </div>
</div>

<script>
function exportAllReports(format) {
  Swal.fire({
    title: 'Export Semua Laporan',
    text: 'Apakah Anda yakin ingin mengexport semua laporan dalam format ' + format.toUpperCase() + '?',
    icon: 'question',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Ya, Export!',
    cancelButtonText: 'Batal'
  }).then((result) => {
    if (result.isConfirmed) {
      
      Swal.fire({
        title: 'Memproses...',
        text: 'Sedang mengexport laporan, mohon tunggu.',
        allowOutsideClick: false,
        didOpen: () => {
          Swal.showLoading();
        }
      });
      
      
      setTimeout(() => {
        Swal.fire('Berhasil!', 'Laporan berhasil diexport.', 'success');
      }, 2000);
    }
  });
}

function printSummary() {
  window.print();
}

function refreshData() {
  Swal.fire({
    title: 'Refresh Data',
    text: 'Memperbarui data laporan...',
    allowOutsideClick: false,
    didOpen: () => {
      Swal.showLoading();
    }
  });
  
  setTimeout(() => {
    location.reload();
  }, 1000);
}
</script>
