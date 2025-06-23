<div class="row">
  <div class="col-12">
    <div class="card shadow-sm mb-4">
      <div class="card-header pb-0">
        <div class="d-flex justify-content-between align-items-center">
          <div>
            <h6 class="mb-1">Manajemen Pengguna</h6>
            <p class="text-sm mb-0">
              <i class="fa fa-info-circle text-primary" aria-hidden="true"></i>
              <span class="font-weight-bold">Kelola semua pengguna di sini</span>
            </p>
          </div>
          <a href="<?= base_url('admin/tambah_pengguna') ?>" class="btn btn-sm btn-primary">
            <i class="fas fa-plus me-2"></i> Tambah Pengguna Baru
          </a>
        </div>
      </div>
      <div class="card-body p-0">

        <div class="table-responsive p-0">
          <?php if (empty($users)) : ?>
            <div class="text-center py-5">
              <h4 class="text-secondary">Tidak ada pengguna yang ditemukan</h4>
              <p class="text-muted">Coba ubah filter atau cari dengan kata kunci yang berbeda.</p>
            </div>
          <?php else : ?>
            <table class="table align-items-center mb-0 datatable">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Pengguna</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Role</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal Daftar</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Login Terakhir</th>
                  <th class="text-secondary opacity-7"></th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($users as $user) : ?>
                  <tr>
                    <td>
                      <div class="d-flex px-2 py-1">
                        <div>
                          <?php if (isset($user->foto_profil) && $user->foto_profil) : ?>
                            <img src="<?= base_url('uploads/profile_pictures/' . $user->foto_profil) ?>" class="avatar avatar-sm me-3" alt="user1">
                          <?php else : ?>
                            <img src="<?= base_url('assets/img/team-2.jpg') ?>" class="avatar avatar-sm me-3" alt="user1">
                          <?php endif; ?>
                        </div>
                        <div class="d-flex flex-column justify-content-center">
                          <h6 class="mb-0 text-sm"><?= $user->nama_lengkap ?></h6>
                          <p class="text-xs text-secondary mb-0"><?= $user->email ?></p>
                        </div>
                      </div>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0">
                        <?= ucwords($user->role) ?>
                      </p>
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold"><?= date('d M Y', strtotime($user->dibuat_pada)) ?></span>
                    </td>
                    <td class="align-middle text-center text-sm">
                      <span class="badge badge-sm bg-gradient-<?= $user->status == 'aktif' ? 'success' : 'secondary' ?>"><?= $user->status == 'aktif' ? 'Aktif' : 'Tidak Aktif' ?></span>
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold"><?= $user->login_terakhir ? date('d M Y H:i', strtotime($user->login_terakhir)) : 'Belum Pernah' ?></span>
                    </td>
                    <td class="align-middle">
                      <div class="dropdown">
                        <button type="button" class="btn btn-sm btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                          <i class="fas fa-ellipsis-v"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end px-2 py-3" aria-labelledby="dropdownMenuButton">
                          <li><a class="dropdown-item border-radius-md" href="<?= base_url('admin/edit_pengguna/' . $user->id) ?>"><i class="fas fa-edit me-2"></i> Edit</a></li>
                          <?php if ($user->role == 'pelamar') : ?>
                            <li><a class="dropdown-item border-radius-md" href="<?= base_url('admin/profil_pelamar/' . $user->id) ?>"><i class="fas fa-user me-2"></i> Lihat Profil</a></li>
                            <li><a class="dropdown-item border-radius-md" href="<?= base_url('admin/lamaran_pelamar/' . $user->id) ?>"><i class="fas fa-file-alt me-2"></i> Lihat Lamaran</a></li>
                          <?php endif; ?>
                          <?php if ($user->status == 'aktif') : ?>
                            <li><a class="dropdown-item border-radius-md" href="<?= base_url('admin/nonaktifkan_pengguna/' . $user->id) ?>"><i class="fas fa-user-slash me-2"></i> Nonaktifkan</a></li>
                          <?php else : ?>
                            <li><a class="dropdown-item border-radius-md" href="<?= base_url('admin/aktifkan_pengguna/' . $user->id) ?>"><i class="fas fa-user-check me-2"></i> Aktifkan</a></li>
                          <?php endif; ?>
                          <li><a class="dropdown-item border-radius-md" href="<?= base_url('admin/reset_kata_sandi/' . $user->id) ?>"><i class="fas fa-key me-2"></i> Reset Kata Sandi</a></li>
                          <li>
                            <hr class="dropdown-divider">
                          </li>
                          <li>
                            <a class="dropdown-item border-radius-md text-danger btn-delete" href="javascript:void(0)" data-id="<?= $user->id ?>" data-name="<?= $user->nama_lengkap ?>">
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
    <div class="card">
      <div class="card-header pb-0">
        <h6>Pengguna Berdasarkan Peran</h6>
      </div>
      <div class="card-body p-3">
        <div class="chart">
          <canvas id="user-role-chart" class="chart-canvas" height="300"></canvas>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="card">
      <div class="card-header pb-0">
        <h6>Pendaftaran Pengguna Bulanan</h6>
      </div>
      <div class="card-body p-3">
        <div class="chart">
          <canvas id="user-registration-chart" class="chart-canvas" height="300"></canvas>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    
    var ctx1 = document.getElementById("user-role-chart").getContext("2d");
    new Chart(ctx1, {
      type: "doughnut",
      data: {
        labels: ["Pelamar", "Admin", "Rekruter"],
        datasets: [{
          label: "Pengguna",
          backgroundColor: ["#5e72e4", "#f5365c", "#2dce89"],
          data: [<?= $user_stats['applicant_count'] ?>, <?= $user_stats['admin_count'] ?>, <?= $user_stats['recruiter_count'] ?>],
        }],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            position: 'right',
          }
        },
      },
    });

    
    var ctx2 = document.getElementById("user-registration-chart").getContext("2d");
    new Chart(ctx2, {
      type: "bar",
      data: {
        labels: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Ags", "Sep", "Okt", "Nov", "Des"],
        datasets: [{
          label: "Pendaftaran",
          backgroundColor: "#5e72e4",
          data: [15, 20, 25, 30, 25, 20, 15, 20, 25, 30, 25, 20],
        }],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: false,
          }
        },
        scales: {
          y: {
            beginAtZero: true
          }
        },
      },
    });

    
    const deleteButtons = document.querySelectorAll('.btn-delete');
    deleteButtons.forEach(function(button) {
      button.addEventListener('click', function(e) {
        e.preventDefault();

        const userId = this.getAttribute('data-id');
        const userName = this.getAttribute('data-name');

        Swal.fire({
          title: 'Konfirmasi Hapus',
          text: `Apakah Anda yakin ingin menghapus pengguna ${userName}? Tindakan ini tidak dapat dibatalkan.`,
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#f5365c',
          cancelButtonColor: '#3085d6',
          confirmButtonText: 'Ya, Hapus!',
          cancelButtonText: 'Batal'
        }).then((result) => {
          if (result.isConfirmed) {
            window.location.href = `<?= base_url('admin/hapus_pengguna/') ?>${userId}`;
          }
        });
      });
    });
  });
</script>
