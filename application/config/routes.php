<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'beranda';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// Rute untuk halaman publik
$route['lowongan'] = 'beranda/lowongan';
$route['lowongan/(:num)'] = 'beranda/detail_lowongan/$1';
$route['lowongan/detail/(:num)'] = 'beranda/detail_lowongan/$1';
$route['beranda/detail_lowongan/(:num)'] = 'beranda/detail_lowongan/$1';
$route['blog'] = 'beranda/blog';
$route['blog/(:any)'] = 'beranda/artikel/$1';
$route['tentang'] = 'beranda/tentang';
$route['kontak'] = 'beranda/kontak';
$route['cari'] = 'beranda/cari';

// Backward compatibility routes
$route['home/jobs'] = 'beranda/lowongan';
$route['home/search'] = 'beranda/cari';
$route['home/blog'] = 'beranda/blog';
$route['home/blog_post/(:any)'] = 'beranda/artikel/$1';
$route['jobs'] = 'beranda/lowongan';

// Rute untuk otentikasi
$route['login'] = 'auth/login';
$route['daftar'] = 'auth/daftar';
$route['logout'] = 'auth/logout';
$route['lupa-password'] = 'auth/lupa_password';
$route['reset-password/(:any)'] = 'auth/reset_password/$1';

// Rute untuk pelamar
$route['pelamar/dasbor'] = 'pelamar/dasbor';
$route['pelamar/profil'] = 'pelamar/profil';
$route['pelamar/lamaran'] = 'pelamar/lamaran';
$route['pelamar/lamar/(:num)'] = 'pelamar/lamar/$1';
$route['pelamar/detail-lamaran/(:num)'] = 'pelamar/detail_lamaran/$1';
$route['pelamar/penilaian'] = 'pelamar/penilaian';
$route['pelamar/ikuti-penilaian/(:num)/(:num)'] = 'pelamar/ikuti_penilaian/$1/$2';
$route['pelamar/ikuti-ujian/(:num)/(:num)'] = 'pelamar/ikuti_ujian/$1/$2';
$route['pelamar/mulai-ujian/(:num)'] = 'pelamar/mulai_ujian/$1';
$route['pelamar/test-mulai-ujian/(:num)'] = 'pelamar/test_mulai_ujian/$1';
$route['pelamar/test-json'] = 'pelamar/test_json';
$route['pelamar/detail_lamaran/(:num)'] = 'pelamar/detail_lamaran/$1';
$route['pelamar/kirim-penilaian'] = 'pelamar/kirim_penilaian';
$route['pelamar/kirim-penilaian-cat'] = 'pelamar/kirim_penilaian_cat';
$route['pelamar/perbarui_status_penilaian/(:num)/(:any)'] = 'pelamar/perbarui_status_penilaian/$1/$2';
$route['pelamar/ubah-password'] = 'pelamar/ubah_password';

// Rute untuk sistem CAT (Computer Adaptive Test)
$route['pelamar/cat-penilaian/(:num)/(:num)'] = 'pelamar/cat_penilaian/$1/$2';
$route['pelamar/cat-penilaian/(:num)/(:num)/(:num)'] = 'pelamar/cat_penilaian/$1/$2/$3';
$route['pelamar/simpan-jawaban-cat'] = 'pelamar/simpan_jawaban_cat';
$route['pelamar/tandai-ragu-cat'] = 'pelamar/tandai_ragu_cat';
$route['pelamar/dapatkan-status-navigasi-cat'] = 'pelamar/dapatkan_status_navigasi_cat';
$route['pelamar/get-question-cat'] = 'pelamar/get_question_cat';
$route['pelamar/log-security-violation'] = 'pelamar/log_security_violation';

// Rute untuk admin
$route['admin'] = 'admin/index';
$route['admin/dasbor'] = 'admin/dasbor';
$route['admin/pengguna'] = 'admin/pengguna';
$route['admin/tambah-pengguna'] = 'admin/tambah_pengguna';
$route['admin/edit-pengguna/(:num)'] = 'admin/edit_pengguna/$1';
$route['admin/hapus-pengguna/(:num)'] = 'admin/hapus_pengguna/$1';
$route['admin/aktifkan-pengguna/(:num)'] = 'admin/aktifkan_pengguna/$1';
$route['admin/nonaktifkan-pengguna/(:num)'] = 'admin/nonaktifkan_pengguna/$1';
$route['admin/reset-kata-sandi/(:num)'] = 'admin/reset_kata_sandi/$1';
$route['admin/profil-pelamar/(:num)'] = 'admin/profil_pelamar/$1';
$route['admin/lamaran-pelamar/(:num)'] = 'admin/lamaran_pelamar/$1';
$route['admin/lowongan'] = 'admin/lowongan';
$route['admin/tambah-lowongan'] = 'admin/tambahLowongan';
$route['admin/edit-lowongan/(:num)'] = 'admin/edit_lowongan/$1';
$route['admin/hapus-lowongan/(:num)'] = 'admin/hapus_lowongan/$1';
$route['admin/lamaran'] = 'admin/lamaran';
$route['admin/detail-lamaran/(:num)'] = 'admin/detail_lamaran/$1';
$route['admin/perbarui-status-lamaran/(:num)/(:any)'] = 'admin/perbarui_status_lamaran/$1/$2';
$route['admin/penilaian'] = 'admin/penilaian';
$route['admin/tambah-penilaian'] = 'admin/tambah_penilaian';
$route['admin/edit-penilaian/(:num)'] = 'admin/edit_penilaian/$1';
$route['admin/hapus-penilaian/(:num)'] = 'admin/hapus_penilaian/$1';
$route['admin/soal-penilaian/(:num)'] = 'admin/soal_penilaian/$1';
$route['admin/tambah-soal/(:num)'] = 'admin/tambah_soal/$1';
$route['admin/edit-soal/(:num)'] = 'admin/edit_soal/$1';
$route['admin/hapus-soal/(:num)'] = 'admin/hapus_soal/$1';
$route['admin/opsi-soal/(:num)'] = 'admin/opsi_soal/$1';
$route['admin/simpan-opsi-soal/(:num)'] = 'admin/simpan_opsi_soal/$1';
$route['admin/hapus-gambar-soal/(:num)'] = 'admin/hapus_gambar_soal/$1';
$route['admin/pratinjau-penilaian/(:num)'] = 'admin/pratinjau_penilaian/$1';
$route['admin/hasil-penilaian/(:num)'] = 'admin/hasil_penilaian/$1';
$route['admin/tetapkan-ke-pelamar/(:num)'] = 'admin/tetapkan_ke_pelamar/$1';

// Backward compatibility routes (English)
$route['admin/assessments'] = 'admin/penilaian';
$route['admin/add_question/(:num)'] = 'admin/tambah_soal/$1';
$route['admin/edit_question/(:num)'] = 'admin/edit_soal/$1';
$route['admin/delete_question/(:num)'] = 'admin/hapus_soal/$1';
$route['admin/question_options/(:num)'] = 'admin/opsi_soal/$1';

$route['admin/blog'] = 'admin/blog';
$route['admin/tambah-artikel'] = 'admin/tambah_artikel';
$route['admin/edit-artikel/(:num)'] = 'admin/edit_artikel/$1';
$route['admin/hapus-artikel/(:num)'] = 'admin/hapus_artikel/$1';
$route['admin/publikasi-artikel/(:num)'] = 'admin/publikasi_artikel/$1';
$route['admin/batalkan-publikasi-artikel/(:num)'] = 'admin/batalkan_publikasi_artikel/$1';
$route['admin/tambah-kategori-blog'] = 'admin/tambah_kategori_blog';
$route['admin/edit-kategori-blog'] = 'admin/edit_kategori_blog';
$route['admin/hapus-kategori-blog/(:num)'] = 'admin/hapus_kategori_blog/$1';
$route['admin/kategori'] = 'admin/kategori';
$route['admin/tambah-kategori-lowongan'] = 'admin/tambah_kategori_lowongan';
$route['admin/edit-kategori-lowongan'] = 'admin/edit_kategori_lowongan';
$route['admin/hapus-kategori-lowongan/(:num)'] = 'admin/hapus_kategori_lowongan/$1';
$route['admin/laporan'] = 'admin/laporan';
$route['admin/laporan-lowongan'] = 'admin/laporan_lowongan';
$route['admin/laporan-lamaran'] = 'admin/laporan_lamaran';
$route['admin/laporan-pelamar'] = 'admin/laporan_pelamar';
$route['admin/laporan-penilaian'] = 'admin/laporan_penilaian';
$route['admin/export-laporan'] = 'admin/export_laporan';
$route['admin/ubah-password'] = 'admin/ubah_password';

// Rute untuk impor
$route['impor'] = 'impor/index';
$route['impor/unduh-template/(:num)'] = 'impor/unduh_template/$1';
$route['impor/proses'] = 'impor/proses';

// Rute tambahan untuk penilaian (alias)
$route['admin/assessment_questions/(:num)'] = 'admin/soal_penilaian/$1';
$route['admin/add_assessment'] = 'admin/tambah_penilaian';
$route['admin/assessments'] = 'admin/penilaian';
$route['admin/add_question/(:num)'] = 'admin/tambah_soal/$1';
$route['admin/edit_assessment/(:num)'] = 'admin/edit_penilaian/$1';
$route['admin/delete_assessment/(:num)'] = 'admin/hapus_penilaian/$1';
$route['admin/assessment_results/(:num)'] = 'admin/hasilPenilaian/$1';
$route['admin/hasil-penilaian/(:num)'] = 'admin/hasilPenilaian/$1';
$route['admin/detail-hasil-penilaian/(:num)'] = 'admin/detailHasilPenilaian/$1';
$route['admin/update_nilai_jawaban'] = 'admin/update_nilai_jawaban';
$route['admin/save_question_options/(:num)'] = 'admin/simpanOpsiSoal/$1';
$route['admin/simpan-opsi-soal/(:num)'] = 'admin/simpan_opsi_soal/$1';
$route['admin/preview_assessment/(:num)'] = 'admin/previewPenilaian/$1';
$route['admin/assign_assessment_to_applicants/(:num)'] = 'admin/tetapkan_ke_pelamar/$1';

// Rute tambahan untuk lowongan (alias)
$route['admin/jobs'] = 'admin/lowongan';
$route['admin/add_job'] = 'admin/tambahLowongan';
$route['admin/edit_job/(:num)'] = 'admin/edit_lowongan/$1';
$route['admin/delete_job/(:num)'] = 'admin/hapus_lowongan/$1';
$route['admin/job_applications/(:num)'] = 'admin/lamaran_lowongan/$1';

// Rute untuk dokumen lowongan
$route['admin/dokumen_lowongan/(:num)'] = 'admin/dokumen_lowongan/$1';
$route['admin/tambah_dokumen_lowongan/(:num)'] = 'admin/tambah_dokumen_lowongan/$1';
$route['admin/edit_dokumen_lowongan/(:num)'] = 'admin/edit_dokumen_lowongan/$1';
$route['admin/hapus_dokumen_lowongan/(:num)'] = 'admin/hapus_dokumen_lowongan/$1';
$route['admin/atur_dokumen_default/(:num)'] = 'admin/atur_dokumen_default/$1';
$route['admin/hapus_semua_dokumen_lowongan/(:num)'] = 'admin/hapus_semua_dokumen_lowongan/$1';
$route['admin/download_dokumen_lamaran/(:num)'] = 'admin/unduh_dokumen_lamaran/$1';
$route['pelamar/download_dokumen/(:num)'] = 'pelamar/download_dokumen/$1';
$route['pelamar/download_dokumen_pelamar/(:num)'] = 'pelamar/download_dokumen_pelamar/$1';
$route['pelamar/hapus_dokumen_pelamar/(:num)'] = 'pelamar/hapus_dokumen_pelamar/$1';

// Rute tambahan untuk pelamar (alias)
$route['admin/profilPelamar/(:num)'] = 'admin/profilPelamar/$1';
$route['admin/recruiter_jobs/(:num)'] = 'admin/lowongan_rekruter/$1';
$route['admin/export_applicant_applications/(:num)'] = 'admin/ekspor_lamaran_pelamar/$1';
$route['admin/assign_assessment/(:num)'] = 'admin/atur_penilaian/$1';
$route['admin/assign_assessment/(:num)/(:num)'] = 'admin/atur_penilaian/$1/$2';
// Backward compatibility route for old applicant URLs
$route['applicant/application_details/(:num)'] = 'pelamar/detail_lamaran/$1';

// Rute tambahan untuk pengguna (alias)
$route['admin/edit_user/(:num)'] = 'admin/edit_pengguna/$1';
$route['admin/users'] = 'admin/pengguna';
