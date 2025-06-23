<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Penilaian extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    // Dapatkan semua penilaian
    public function dapatkan_semua_penilaian() {
        $this->db->select('penilaian.*, jenis_penilaian.nama as type_name, pengguna.nama_lengkap as created_by_name');
        $this->db->from('penilaian');
        $this->db->join('jenis_penilaian', 'jenis_penilaian.id = penilaian.id_jenis', 'left');
        $this->db->join('pengguna', 'pengguna.id = penilaian.dibuat_oleh', 'left');
        $this->db->order_by('penilaian.id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    // Dapatkan penilaian berdasarkan ID
    public function dapatkan_penilaian($id) {
        $this->db->select('penilaian.*, jenis_penilaian.nama as type_name, pengguna.nama_lengkap as created_by_name');
        $this->db->from('penilaian');
        $this->db->join('jenis_penilaian', 'jenis_penilaian.id = penilaian.id_jenis', 'left');
        $this->db->join('pengguna', 'pengguna.id = penilaian.dibuat_oleh', 'left');
        $this->db->where('penilaian.id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    // Tambah penilaian baru
    public function tambah_penilaian($data) {
        $this->db->insert('penilaian', $data);
        return $this->db->insert_id();
    }

    // Perbarui penilaian
    public function perbarui_penilaian($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('penilaian', $data);
    }

    // Hapus penilaian
    public function hapus_penilaian($id) {
        $this->db->where('id', $id);
        return $this->db->delete('penilaian');
    }

    // Dapatkan jenis penilaian
    public function dapatkan_jenis_penilaian() {
        $query = $this->db->get('jenis_penilaian');
        return $query->result();
    }

    // Dapatkan soal penilaian
    public function dapatkan_soal_penilaian($assessment_id) {
        $this->db->where('id_penilaian', $assessment_id);
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get('soal');
        return $query->result();
    }

    // Dapatkan soal berdasarkan ID
    public function dapatkan_soal($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('soal');
        return $query->row();
    }

    // Tambah soal baru
    public function tambah_soal($data) {
        $this->db->insert('soal', $data);
        return $this->db->insert_id();
    }

    // Perbarui soal
    public function perbarui_soal($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('soal', $data);
    }

    // Hapus soal
    public function hapus_soal($id) {
        // Dapatkan data soal untuk menghapus gambar jika ada
        $this->db->select('gambar_soal');
        $this->db->where('id', $id);
        $query = $this->db->get('soal');
        $soal = $query->row();

        // Hapus file gambar jika ada
        if ($soal && $soal->gambar_soal) {
            $file_path = FCPATH . 'uploads/gambar_soal/' . $soal->gambar_soal;
            if (file_exists($file_path)) {
                unlink($file_path);
            }
        }

        // Hapus data soal dari database
        $this->db->where('id', $id);
        return $this->db->delete('soal');
    }

    // Dapatkan opsi soal
    public function dapatkan_opsi_soal($question_id) {
        $this->db->where('id_soal', $question_id);
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get('pilihan_soal');
        return $query->result();
    }

    // Tambah opsi soal
    public function tambah_opsi_soal($data) {
        $this->db->insert('pilihan_soal', $data);
        return $this->db->insert_id();
    }

    // Hapus gambar soal
    public function hapus_gambar_soal($id) {
        // Dapatkan data soal untuk menghapus gambar
        $this->db->select('gambar_soal');
        $this->db->where('id', $id);
        $query = $this->db->get('soal');
        $soal = $query->row();

        if ($soal && $soal->gambar_soal) {
            // Hapus file gambar
            $file_path = FCPATH . 'uploads/gambar_soal/' . $soal->gambar_soal;
            if (file_exists($file_path)) {
                unlink($file_path);
            }

            // Update database untuk menghapus referensi gambar
            $this->db->where('id', $id);
            $this->db->update('soal', array('gambar_soal' => NULL));

            return true;
        }

        return false;
    }

    // Perbarui opsi soal
    public function perbarui_opsi_soal($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('pilihan_soal', $data);
    }

    // Hapus opsi soal
    public function hapus_opsi_soal($id) {
        $this->db->where('id', $id);
        return $this->db->delete('pilihan_soal');
    }

    // Dapatkan penilaian pelamar
    public function dapatkan_penilaian_pelamar($application_id) {
        $this->db->select('penilaian_pelamar.*, penilaian.judul as assessment_title, penilaian.deskripsi as description, penilaian.nilai_lulus as passing_score, jenis_penilaian.nama as type_name');
        $this->db->from('penilaian_pelamar');
        $this->db->join('penilaian', 'penilaian.id = penilaian_pelamar.id_penilaian', 'left');
        $this->db->join('jenis_penilaian', 'jenis_penilaian.id = penilaian.id_jenis', 'left');
        $this->db->where('penilaian_pelamar.id_lamaran', $application_id);
        $query = $this->db->get();
        return $query->result();
    }

    // Dapatkan penilaian pelamar spesifik
    public function dapatkan_penilaian_pelamar_spesifik($application_id, $assessment_id) {
        $this->db->select('penilaian_pelamar.*, penilaian.judul as assessment_title, penilaian.deskripsi as description, penilaian.nilai_lulus as passing_score, jenis_penilaian.nama as type_name, lamaran_pekerjaan.id_pelamar');
        $this->db->from('penilaian_pelamar');
        $this->db->join('penilaian', 'penilaian.id = penilaian_pelamar.id_penilaian', 'left');
        $this->db->join('jenis_penilaian', 'jenis_penilaian.id = penilaian.id_jenis', 'left');
        $this->db->join('lamaran_pekerjaan', 'lamaran_pekerjaan.id = penilaian_pelamar.id_lamaran', 'left');
        $this->db->where('penilaian_pelamar.id_lamaran', $application_id);
        $this->db->where('penilaian_pelamar.id_penilaian', $assessment_id);
        $query = $this->db->get();
        return $query->row();
    }

    // Dapatkan semua penilaian pelamar
    public function dapatkan_semua_penilaian_pelamar($user_id) {
        $this->db->select('penilaian_pelamar.*, penilaian.judul as assessment_title, penilaian.deskripsi as description, penilaian.nilai_lulus as passing_score, lamaran_pekerjaan.id_pekerjaan as job_id, lowongan_pekerjaan.judul as job_title, jenis_penilaian.nama as type_name');
        $this->db->from('penilaian_pelamar');
        $this->db->join('penilaian', 'penilaian.id = penilaian_pelamar.id_penilaian', 'left');
        $this->db->join('jenis_penilaian', 'jenis_penilaian.id = penilaian.id_jenis', 'left');
        $this->db->join('lamaran_pekerjaan', 'lamaran_pekerjaan.id = penilaian_pelamar.id_lamaran', 'left');
        $this->db->join('lowongan_pekerjaan', 'lowongan_pekerjaan.id = lamaran_pekerjaan.id_pekerjaan', 'left');
        $this->db->where('lamaran_pekerjaan.id_pelamar', $user_id);
        $this->db->order_by('penilaian_pelamar.id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    // Tambah penilaian pelamar
    public function tambah_penilaian_pelamar($data) {
        $this->db->insert('penilaian_pelamar', $data);
        return $this->db->insert_id();
    }

    // Perbarui status penilaian pelamar
    public function perbarui_status_penilaian_pelamar($id, $status) {
        $update_data = array('status' => $status);

        // Set waktu_mulai when starting assessment
        if ($status == 'sedang_berlangsung' || $status == 'sedang_mengerjakan') {
            $update_data['waktu_mulai'] = date('Y-m-d H:i:s');
            $update_data['status'] = 'sedang_mengerjakan'; // Normalize to database enum
        }

        // Set waktu_selesai when completing assessment
        if ($status == 'selesai') {
            $update_data['waktu_selesai'] = date('Y-m-d H:i:s');
        }

        $this->db->where('id', $id);
        $result = $this->db->update('penilaian_pelamar', $update_data);

        // Log untuk debugging
        if (!$result) {
            log_message('error', 'Failed to update penilaian_pelamar status for ID: ' . $id . ' with status: ' . $status);
        } else {
            log_message('info', 'Successfully updated penilaian_pelamar ID: ' . $id . ' to status: ' . $status . ' with waktu_mulai: ' . (isset($update_data['waktu_mulai']) ? $update_data['waktu_mulai'] : 'not set'));
        }

        return $result;
    }

    // Perbaiki data waktu_mulai yang kosong untuk status sedang_mengerjakan
    public function perbaiki_waktu_mulai_kosong() {
        // Update records yang status sedang_mengerjakan tapi waktu_mulai kosong
        $this->db->set('waktu_mulai', 'dibuat_pada', FALSE);
        $this->db->where('status', 'sedang_mengerjakan');
        $this->db->where('waktu_mulai IS NULL');
        $result1 = $this->db->update('penilaian_pelamar');

        // Update records yang status selesai tapi waktu_mulai kosong
        $this->db->set('waktu_mulai', 'dibuat_pada', FALSE);
        $this->db->where('status', 'selesai');
        $this->db->where('waktu_mulai IS NULL');
        $result2 = $this->db->update('penilaian_pelamar');

        return ['sedang_mengerjakan' => $this->db->affected_rows(), 'selesai' => $result2 ? $this->db->affected_rows() : 0];
    }

    // Tambah jawaban pelamar
    public function tambah_jawaban_pelamar($data) {
        $this->db->insert('jawaban_pelamar', $data);
        return $this->db->insert_id();
    }

    // Update nilai jawaban pelamar (untuk soal esai)
    public function update_nilai_jawaban($answer_id, $nilai, $dinilai_oleh) {
        $data = array(
            'nilai' => $nilai,
            'dinilai_oleh' => $dinilai_oleh,
            'tanggal_dinilai' => date('Y-m-d H:i:s')
        );

        $this->db->where('id', $answer_id);
        return $this->db->update('jawaban_pelamar', $data);
    }

    // Dapatkan jawaban pelamar
    public function dapatkan_jawaban_pelamar($applicant_assessment_id) {
        $this->db->select('jawaban_pelamar.*, soal.teks_soal as question_text, soal.jenis_soal as question_type, soal.poin as points');
        $this->db->from('jawaban_pelamar');
        $this->db->join('soal', 'soal.id = jawaban_pelamar.id_soal', 'left');
        $this->db->where('jawaban_pelamar.id_penilaian_pelamar', $applicant_assessment_id);
        $query = $this->db->get();
        return $query->result();
    }

    // Hitung skor penilaian pelamar
    public function hitung_skor_penilaian_pelamar($applicant_assessment_id) {
        $total_points = 0;
        $earned_points = 0;

        // Dapatkan semua jawaban pelamar dengan detail soal
        $this->db->select('jawaban_pelamar.id, jawaban_pelamar.id_soal, jawaban_pelamar.teks_jawaban, jawaban_pelamar.id_pilihan_terpilih, jawaban_pelamar.unggah_file, jawaban_pelamar.nilai, soal.poin as points, soal.jenis_soal, pilihan_soal.benar as is_correct');
        $this->db->from('jawaban_pelamar');
        $this->db->join('soal', 'soal.id = jawaban_pelamar.id_soal', 'left');
        $this->db->join('pilihan_soal', 'pilihan_soal.id = jawaban_pelamar.id_pilihan_terpilih', 'left');
        $this->db->where('jawaban_pelamar.id_penilaian_pelamar', $applicant_assessment_id);
        $query = $this->db->get();
        $answers = $query->result();

        // Dapatkan semua soal dalam penilaian untuk menghitung total poin
        $this->db->select('soal.id, soal.poin, soal.jenis_soal');
        $this->db->from('soal');
        $this->db->join('penilaian_pelamar', 'penilaian_pelamar.id_penilaian = soal.id_penilaian', 'inner');
        $this->db->where('penilaian_pelamar.id', $applicant_assessment_id);
        $all_questions_query = $this->db->get();
        $all_questions = $all_questions_query->result();

        // Hitung total poin dari semua soal
        foreach ($all_questions as $question) {
            $total_points += $question->poin;
        }

        // Hitung poin yang diperoleh
        foreach ($answers as $answer) {
            // Untuk soal pilihan ganda dan benar/salah
            if (($answer->jenis_soal == 'pilihan_ganda' || $answer->jenis_soal == 'benar_salah') && $answer->is_correct == 1) {
                $earned_points += $answer->points;
            }
            // Untuk soal esai, gunakan nilai manual jika ada, atau berikan poin penuh sementara
            elseif ($answer->jenis_soal == 'esai' && !empty($answer->teks_jawaban)) {
                if ($answer->nilai !== null) {
                    // Gunakan nilai manual dari admin
                    $earned_points += $answer->nilai;
                } else {
                    // Berikan poin penuh sementara jika belum dinilai manual
                    $earned_points += $answer->points;
                }
            }
            // Untuk soal upload file, gunakan nilai manual jika ada, atau berikan poin penuh
            elseif ($answer->jenis_soal == 'unggah_file' && !empty($answer->unggah_file)) {
                if ($answer->nilai !== null) {
                    // Gunakan nilai manual dari admin
                    $earned_points += $answer->nilai;
                } else {
                    // Berikan poin penuh sementara jika belum dinilai manual
                    $earned_points += $answer->points;
                }
            }
        }

        // Perbarui skor di database
        $score = ($total_points > 0) ? round(($earned_points / $total_points) * 100) : 0;
        $this->db->where('id', $applicant_assessment_id);
        $this->db->update('penilaian_pelamar', array('nilai' => $score));

        return $score;
    }

    // Tetapkan penilaian ke lowongan
    public function tetapkan_penilaian_ke_lowongan($job_id, $assessment_id) {
        $data = array(
            'id_pekerjaan' => $job_id,
            'id_penilaian' => $assessment_id
        );
        return $this->db->insert('penilaian_pekerjaan', $data);
    }

    // Hapus penilaian dari lowongan
    public function hapus_penilaian_dari_lowongan($job_id, $assessment_id) {
        $this->db->where('id_pekerjaan', $job_id);
        $this->db->where('id_penilaian', $assessment_id);
        return $this->db->delete('penilaian_pekerjaan');
    }

    // Cek apakah penilaian sudah digunakan oleh pelamar
    public function cek_penilaian_digunakan($assessment_id) {
        $this->db->where('id_penilaian', $assessment_id);
        $query = $this->db->get('penilaian_pelamar');
        return ($query->num_rows() > 0);
    }

    // Dapatkan lowongan yang terkait dengan penilaian
    public function dapatkan_lowongan_penilaian($assessment_id) {
        $this->db->select('penilaian_pekerjaan.*, lowongan_pekerjaan.judul as job_title');
        $this->db->from('penilaian_pekerjaan');
        $this->db->join('lowongan_pekerjaan', 'lowongan_pekerjaan.id = penilaian_pekerjaan.id_pekerjaan', 'left');
        $this->db->where('penilaian_pekerjaan.id_penilaian', $assessment_id);
        $query = $this->db->get();
        return $query->row();
    }

    // Hitung jumlah soal dalam penilaian
    public function hitung_soal_penilaian($assessment_id) {
        $this->db->where('id_penilaian', $assessment_id);
        return $this->db->count_all_results('soal');
    }

    // Hitung jumlah pelamar yang ditugaskan penilaian
    public function hitung_pelamar_penilaian($assessment_id) {
        $this->db->where('id_penilaian', $assessment_id);
        return $this->db->count_all_results('penilaian_pelamar');
    }

    // Hitung jumlah pelamar yang telah menyelesaikan penilaian
    public function hitung_penyelesaian_penilaian($assessment_id) {
        $this->db->where('id_penilaian', $assessment_id);
        $this->db->where('status', 'selesai');
        return $this->db->count_all_results('penilaian_pelamar');
    }

    // Dapatkan penilaian aktif
    public function dapatkan_penilaian_aktif() {
        $this->db->select('penilaian.*, jenis_penilaian.nama as type_name');
        $this->db->from('penilaian');
        $this->db->join('jenis_penilaian', 'jenis_penilaian.id = penilaian.id_jenis', 'left');
        $this->db->where('penilaian.aktif', 1);
        $this->db->order_by('penilaian.judul', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    // Dapatkan penilaian untuk lowongan tertentu
    public function dapatkan_penilaian_lowongan($job_id) {
        $this->db->select('penilaian_pekerjaan.*, penilaian.judul as assessment_title, jenis_penilaian.nama as type_name');
        $this->db->from('penilaian_pekerjaan');
        $this->db->join('penilaian', 'penilaian.id = penilaian_pekerjaan.id_penilaian', 'left');
        $this->db->join('jenis_penilaian', 'jenis_penilaian.id = penilaian.id_jenis', 'left');
        $this->db->where('penilaian_pekerjaan.id_pekerjaan', $job_id);
        $query = $this->db->get();
        return $query->result();
    }

    // Hapus semua penilaian dari lowongan
    public function hapus_semua_penilaian_lowongan($job_id) {
        $this->db->where('id_pekerjaan', $job_id);
        return $this->db->delete('penilaian_pekerjaan');
    }

    // Cek apakah penilaian sudah ditetapkan ke pelamar
    public function cek_penilaian_sudah_ditetapkan($application_id, $assessment_id) {
        $this->db->where('id_lamaran', $application_id);
        $this->db->where('id_penilaian', $assessment_id);
        $query = $this->db->get('penilaian_pelamar');
        return ($query->num_rows() > 0);
    }

    // Hitung jumlah penilaian yang ditetapkan ke pelamar
    public function hitung_penilaian_pelamar($application_id) {
        $this->db->where('id_lamaran', $application_id);
        return $this->db->count_all_results('penilaian_pelamar');
    }

    // Hitung jumlah penilaian yang telah diselesaikan oleh pelamar
    public function hitung_penilaian_selesai($application_id) {
        $this->db->where('id_lamaran', $application_id);
        $this->db->where('status', 'selesai');
        return $this->db->count_all_results('penilaian_pelamar');
    }

    // Hitung total penilaian
    public function hitung_penilaian() {
        return $this->db->count_all('penilaian');
    }

    // Hitung penilaian yang telah diselesaikan
    public function hitung_penilaian_selesai_semua() {
        $this->db->where('status', 'selesai');
        return $this->db->count_all_results('penilaian_pelamar');
    }

    // Hitung penilaian yang menunggu (belum diselesaikan)
    public function hitung_penilaian_menunggu() {
        $this->db->where('status', 'menunggu');
        return $this->db->count_all_results('penilaian_pelamar');
    }

    // Dapatkan statistik penilaian berdasarkan bulan
    public function dapatkan_statistik_penilaian_bulanan($year) {
        $this->db->select('MONTH(dibuat_pada) as month, COUNT(*) as count');
        $this->db->from('penilaian_pelamar');
        $this->db->where('YEAR(dibuat_pada)', $year);
        $this->db->group_by('MONTH(dibuat_pada)');
        $query = $this->db->get();
        return $query->result();
    }

    // Dapatkan statistik skor penilaian
    public function dapatkan_statistik_skor_penilaian() {
        $this->db->select('FLOOR(nilai/10)*10 as score_range, COUNT(*) as count');
        $this->db->from('penilaian_pelamar');
        $this->db->where('status', 'selesai');
        $this->db->group_by('FLOOR(nilai/10)');
        $this->db->order_by('score_range', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    // Dapatkan hasil penilaian
    public function dapatkan_hasil_penilaian($assessment_id) {
        $this->db->select('penilaian_pelamar.*, pengguna.nama_lengkap as full_name, pengguna.email, lamaran_pekerjaan.id as application_id, lowongan_pekerjaan.judul as job_title');
        $this->db->from('penilaian_pelamar');
        $this->db->join('lamaran_pekerjaan', 'lamaran_pekerjaan.id = penilaian_pelamar.id_lamaran', 'left');
        $this->db->join('pengguna', 'pengguna.id = lamaran_pekerjaan.id_pelamar', 'left');
        $this->db->join('lowongan_pekerjaan', 'lowongan_pekerjaan.id = lamaran_pekerjaan.id_pekerjaan', 'left');
        $this->db->where('penilaian_pelamar.id_penilaian', $assessment_id);
        $this->db->order_by('penilaian_pelamar.nilai', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    // Dapatkan detail penilaian pelamar berdasarkan ID
    public function dapatkan_detail_penilaian_pelamar($applicant_assessment_id) {
        $this->db->select('penilaian_pelamar.*, penilaian.judul as assessment_title, penilaian.deskripsi as description, penilaian.nilai_lulus as passing_score, jenis_penilaian.nama as type_name, lamaran_pekerjaan.id_pelamar, pengguna.nama_lengkap as applicant_name, pengguna.email as applicant_email, lowongan_pekerjaan.judul as job_title');
        $this->db->from('penilaian_pelamar');
        $this->db->join('penilaian', 'penilaian.id = penilaian_pelamar.id_penilaian', 'left');
        $this->db->join('jenis_penilaian', 'jenis_penilaian.id = penilaian.id_jenis', 'left');
        $this->db->join('lamaran_pekerjaan', 'lamaran_pekerjaan.id = penilaian_pelamar.id_lamaran', 'left');
        $this->db->join('pengguna', 'pengguna.id = lamaran_pekerjaan.id_pelamar', 'left');
        $this->db->join('lowongan_pekerjaan', 'lowongan_pekerjaan.id = lamaran_pekerjaan.id_pekerjaan', 'left');
        $this->db->where('penilaian_pelamar.id', $applicant_assessment_id);
        $query = $this->db->get();
        return $query->row();
    }

    // Dapatkan soal dengan jawaban pelamar
    public function dapatkan_soal_dengan_jawaban_pelamar($applicant_assessment_id) {
        $this->db->select('soal.*, jawaban_pelamar.id as answer_id, jawaban_pelamar.teks_jawaban, jawaban_pelamar.id_pilihan_terpilih, jawaban_pelamar.nilai as nilai_manual, jawaban_pelamar.tanggal_dinilai, jawaban_pelamar.ditandai_ragu, pilihan_soal.teks_pilihan as selected_option_text, pilihan_soal.benar as is_correct');
        $this->db->from('soal');
        $this->db->join('jawaban_pelamar', 'jawaban_pelamar.id_soal = soal.id AND jawaban_pelamar.id_penilaian_pelamar = ' . $applicant_assessment_id, 'left');
        $this->db->join('pilihan_soal', 'pilihan_soal.id = jawaban_pelamar.id_pilihan_terpilih', 'left');
        $this->db->join('penilaian_pelamar', 'penilaian_pelamar.id = ' . $applicant_assessment_id, 'inner');
        $this->db->where('soal.id_penilaian', 'penilaian_pelamar.id_penilaian', false);
        $this->db->order_by('soal.id', 'ASC');
        $query = $this->db->get();
        $questions = $query->result();

        // Get all options for each question
        foreach ($questions as &$question) {
            if ($question->jenis_soal == 'pilihan_ganda' || $question->jenis_soal == 'benar_salah') {
                $question->options = $this->dapatkan_opsi_soal($question->id);
            }
        }

        return $questions;
    }

    // Dapatkan soal untuk mode CAT dengan urutan yang sudah diacak
    public function dapatkan_soal_cat($applicant_assessment_id) {
        // Cek apakah sudah ada urutan soal yang tersimpan
        $this->db->select('urutan_soal_pelamar.urutan, soal.*, jawaban_pelamar.id as answer_id, jawaban_pelamar.teks_jawaban, jawaban_pelamar.id_pilihan_terpilih, jawaban_pelamar.ditandai_ragu');
        $this->db->from('urutan_soal_pelamar');
        $this->db->join('soal', 'soal.id = urutan_soal_pelamar.id_soal', 'inner');
        $this->db->join('jawaban_pelamar', 'jawaban_pelamar.id_soal = soal.id AND jawaban_pelamar.id_penilaian_pelamar = ' . $applicant_assessment_id, 'left');
        $this->db->where('urutan_soal_pelamar.id_penilaian_pelamar', $applicant_assessment_id);
        $this->db->order_by('urutan_soal_pelamar.urutan', 'ASC');
        $query = $this->db->get();
        $questions = $query->result();

        // Jika belum ada urutan soal, buat urutan baru
        if (empty($questions)) {
            $this->buat_urutan_soal_acak($applicant_assessment_id);
            // Ambil ulang setelah urutan dibuat
            return $this->dapatkan_soal_cat($applicant_assessment_id);
        }

        // Get all options for each question
        foreach ($questions as &$question) {
            if ($question->jenis_soal == 'pilihan_ganda' || $question->jenis_soal == 'benar_salah') {
                $question->options = $this->dapatkan_opsi_soal($question->id);
            }
        }

        return $questions;
    }

    // Buat urutan soal acak untuk pelamar
    public function buat_urutan_soal_acak($applicant_assessment_id) {
        // Dapatkan ID penilaian dari penilaian_pelamar
        $this->db->select('id_penilaian');
        $this->db->where('id', $applicant_assessment_id);
        $query = $this->db->get('penilaian_pelamar');
        $assessment_data = $query->row();

        if (!$assessment_data) {
            return false;
        }

        // Dapatkan semua soal untuk penilaian ini
        $this->db->select('id');
        $this->db->where('id_penilaian', $assessment_data->id_penilaian);
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get('soal');
        $questions = $query->result();

        if (empty($questions)) {
            return false;
        }

        // Acak urutan soal
        $question_ids = array_column($questions, 'id');
        shuffle($question_ids);

        // Simpan urutan soal ke database
        $batch_data = array();
        foreach ($question_ids as $index => $question_id) {
            $batch_data[] = array(
                'id_penilaian_pelamar' => $applicant_assessment_id,
                'id_soal' => $question_id,
                'urutan' => $index + 1,
                'dibuat_pada' => date('Y-m-d H:i:s')
            );
        }

        return $this->db->insert_batch('urutan_soal_pelamar', $batch_data);
    }

    // Dapatkan soal berdasarkan nomor urutan untuk mode CAT
    public function dapatkan_soal_cat_berdasarkan_urutan($applicant_assessment_id, $urutan) {
        $this->db->select('urutan_soal_pelamar.urutan, soal.*, jawaban_pelamar.id as answer_id, jawaban_pelamar.teks_jawaban, jawaban_pelamar.id_pilihan_terpilih, jawaban_pelamar.ditandai_ragu');
        $this->db->from('urutan_soal_pelamar');
        $this->db->join('soal', 'soal.id = urutan_soal_pelamar.id_soal', 'inner');
        $this->db->join('jawaban_pelamar', 'jawaban_pelamar.id_soal = soal.id AND jawaban_pelamar.id_penilaian_pelamar = ' . $applicant_assessment_id, 'left');
        $this->db->where('urutan_soal_pelamar.id_penilaian_pelamar', $applicant_assessment_id);
        $this->db->where('urutan_soal_pelamar.urutan', $urutan);
        $query = $this->db->get();
        $question = $query->row();

        if ($question && ($question->jenis_soal == 'pilihan_ganda' || $question->jenis_soal == 'benar_salah')) {
            $question->options = $this->dapatkan_opsi_soal($question->id);
        }

        return $question;
    }

    // Dapatkan total soal untuk mode CAT
    public function dapatkan_total_soal_cat($applicant_assessment_id) {
        $this->db->where('id_penilaian_pelamar', $applicant_assessment_id);
        return $this->db->count_all_results('urutan_soal_pelamar');
    }

    // Simpan atau perbarui jawaban untuk mode CAT
    public function simpan_jawaban_cat($data) {
        // Cek apakah jawaban sudah ada
        $this->db->where('id_penilaian_pelamar', $data['id_penilaian_pelamar']);
        $this->db->where('id_soal', $data['id_soal']);
        $existing = $this->db->get('jawaban_pelamar')->row();

        if ($existing) {
            // Update jawaban yang sudah ada
            $this->db->where('id', $existing->id);
            return $this->db->update('jawaban_pelamar', $data);
        } else {
            // Insert jawaban baru
            return $this->db->insert('jawaban_pelamar', $data);
        }
    }

    // Tandai soal sebagai ragu-ragu
    public function tandai_soal_ragu($applicant_assessment_id, $question_id, $ragu = 1) {
        // Cek apakah jawaban sudah ada
        $this->db->where('id_penilaian_pelamar', $applicant_assessment_id);
        $this->db->where('id_soal', $question_id);
        $existing = $this->db->get('jawaban_pelamar')->row();

        $data = array('ditandai_ragu' => $ragu);

        if ($existing) {
            // Update jawaban yang sudah ada
            $this->db->where('id', $existing->id);
            return $this->db->update('jawaban_pelamar', $data);
        } else {
            // Insert jawaban baru dengan hanya flag ragu
            $data['id_penilaian_pelamar'] = $applicant_assessment_id;
            $data['id_soal'] = $question_id;
            $data['dibuat_pada'] = date('Y-m-d H:i:s');
            return $this->db->insert('jawaban_pelamar', $data);
        }
    }

    // Dapatkan status jawaban untuk navigasi CAT
    public function dapatkan_status_jawaban_cat($applicant_assessment_id) {
        $this->db->select('urutan_soal_pelamar.urutan, urutan_soal_pelamar.id_soal, jawaban_pelamar.id_pilihan_terpilih, jawaban_pelamar.teks_jawaban, jawaban_pelamar.unggah_file, jawaban_pelamar.ditandai_ragu');
        $this->db->from('urutan_soal_pelamar');
        $this->db->join('jawaban_pelamar', 'jawaban_pelamar.id_soal = urutan_soal_pelamar.id_soal AND jawaban_pelamar.id_penilaian_pelamar = ' . $applicant_assessment_id, 'left');
        $this->db->where('urutan_soal_pelamar.id_penilaian_pelamar', $applicant_assessment_id);
        $this->db->order_by('urutan_soal_pelamar.urutan', 'ASC');
        $query = $this->db->get();
        $results = $query->result();

        $status = array();
        foreach ($results as $result) {
            $answered = false;
            if ($result->id_pilihan_terpilih || $result->teks_jawaban || $result->unggah_file) {
                $answered = true;
            }

            $status[] = array(
                'urutan' => $result->urutan,
                'id_soal' => $result->id_soal,
                'dijawab' => $answered,
                'ditandai_ragu' => $result->ditandai_ragu ? true : false
            );
        }

        return $status;
    }

    // Cek apakah penilaian menggunakan mode CAT
    public function cek_mode_cat($assessment_id) {
        $this->db->select('mode_cat, acak_soal');
        $this->db->where('id', $assessment_id);
        $query = $this->db->get('penilaian');
        $result = $query->row();

        return $result ? $result : (object)array('mode_cat' => 0, 'acak_soal' => 0);
    }

    // Dapatkan penilaian pelamar berdasarkan ID
    public function dapatkan_penilaian_pelamar_by_id($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('penilaian_pelamar');
        return $query->row();
    }

    // Dapatkan rata-rata skor penilaian
    public function dapatkan_rata_rata_skor($assessment_id) {
        $this->db->select_avg('nilai', 'score');
        $this->db->from('penilaian_pelamar');
        $this->db->where('id_penilaian', $assessment_id);
        $this->db->where('status', 'selesai');
        $query = $this->db->get();
        $result = $query->row();
        return $result->score ? round($result->score) : 0;
    }

    // Dapatkan pelamar penilaian (untuk tampilan edit)
    public function dapatkan_pelamar_penilaian($assessment_id, $limit = null) {
        $this->db->select('penilaian_pelamar.*, pengguna.nama_lengkap as applicant_name, pengguna.email as applicant_email, lamaran_pekerjaan.id as application_id, lowongan_pekerjaan.judul as job_title');
        $this->db->from('penilaian_pelamar');
        $this->db->join('lamaran_pekerjaan', 'lamaran_pekerjaan.id = penilaian_pelamar.id_lamaran', 'left');
        $this->db->join('pengguna', 'pengguna.id = lamaran_pekerjaan.id_pelamar', 'left');
        $this->db->join('lowongan_pekerjaan', 'lowongan_pekerjaan.id = lamaran_pekerjaan.id_pekerjaan', 'left');
        $this->db->where('penilaian_pelamar.id_penilaian', $assessment_id);
        $this->db->order_by('penilaian_pelamar.id', 'DESC');

        if ($limit !== null) {
            $this->db->limit($limit);
        }

        $query = $this->db->get();
        return $query->result();
    }
}
