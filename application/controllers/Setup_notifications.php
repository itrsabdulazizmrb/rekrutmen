<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setup_notifications extends CI_Controller {

    public function __construct() {
        parent::__construct();

        // Check if user is admin
        if (!$this->session->userdata('logged_in') || $this->session->userdata('role') != 'admin') {
            redirect('auth');
        }

        $this->load->database();
    }

    public function index() {
        echo "<h2>SIREK Notification System Setup</h2>";
        echo "<p>This will create the necessary database tables for the notification system.</p>";

        try {
            // Check if tables already exist
            if ($this->db->table_exists('notifikasi')) {
                echo "<p style='color: green;'>✅ Notification tables already exist!</p>";
                echo "<p><a href='" . base_url('admin/notifikasi') . "'>Go to Notifications</a></p>";
                return;
            }

            echo "<p>Creating notification tables...</p>";

            // Create notifications table
            $this->db->query("
                CREATE TABLE `notifikasi` (
                    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
                    `id_pengguna` int(11) unsigned NOT NULL COMMENT 'ID pengguna yang menerima notifikasi',
                    `judul` varchar(255) NOT NULL COMMENT 'Judul notifikasi',
                    `pesan` text NOT NULL COMMENT 'Isi pesan notifikasi',
                    `jenis` enum('lamaran_baru','status_lamaran','sistem','registrasi_pengguna','jadwal_interview','penilaian','lowongan_baru') NOT NULL DEFAULT 'sistem' COMMENT 'Jenis notifikasi',
                    `prioritas` enum('rendah','normal','tinggi','urgent') NOT NULL DEFAULT 'normal' COMMENT 'Tingkat prioritas notifikasi',
                    `status` enum('belum_dibaca','dibaca','diarsipkan') NOT NULL DEFAULT 'belum_dibaca' COMMENT 'Status baca notifikasi',
                    `id_referensi` int(11) unsigned DEFAULT NULL COMMENT 'ID referensi ke tabel terkait (lamaran, lowongan, dll)',
                    `tabel_referensi` varchar(50) DEFAULT NULL COMMENT 'Nama tabel referensi',
                    `url_aksi` varchar(255) DEFAULT NULL COMMENT 'URL untuk aksi notifikasi',
                    `icon` varchar(50) NOT NULL DEFAULT 'ni ni-bell-55' COMMENT 'Icon notifikasi',
                    `warna` varchar(20) NOT NULL DEFAULT 'primary' COMMENT 'Warna notifikasi (primary, success, warning, danger, info)',
                    `dibaca_pada` timestamp NULL DEFAULT NULL COMMENT 'Waktu notifikasi dibaca',
                    `kedaluwarsa_pada` timestamp NULL DEFAULT NULL COMMENT 'Waktu kedaluwarsa notifikasi',
                    `dibuat_oleh` int(11) unsigned DEFAULT NULL COMMENT 'ID pengguna yang membuat notifikasi',
                    `dibuat_pada` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Waktu notifikasi dibuat',
                    `diperbarui_pada` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Waktu notifikasi diperbarui',
                    PRIMARY KEY (`id`),
                    KEY `idx_id_pengguna` (`id_pengguna`),
                    KEY `idx_jenis` (`jenis`),
                    KEY `idx_status` (`status`),
                    KEY `idx_prioritas` (`prioritas`),
                    KEY `idx_dibuat_pada` (`dibuat_pada`),
                    KEY `idx_referensi` (`id_referensi`,`tabel_referensi`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Tabel notifikasi sistem'
            ");

            echo "<p style='color: green;'>✅ Notifications table created successfully!</p>";

            // Create notification settings table
            $this->db->query("
                CREATE TABLE `pengaturan_notifikasi` (
                    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
                    `id_pengguna` int(11) unsigned NOT NULL,
                    `jenis_notifikasi` varchar(50) NOT NULL,
                    `aktif` tinyint(1) NOT NULL DEFAULT '1',
                    `email_notifikasi` tinyint(1) NOT NULL DEFAULT '0',
                    `whatsapp_notifikasi` tinyint(1) NOT NULL DEFAULT '0',
                    `dibuat_pada` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                    `diperbarui_pada` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                    PRIMARY KEY (`id`),
                    KEY `idx_id_pengguna` (`id_pengguna`),
                    KEY `idx_jenis_notifikasi` (`jenis_notifikasi`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Pengaturan notifikasi pengguna'
            ");

            echo "<p style='color: green;'>✅ Notification settings table created successfully!</p>";

            // Insert default settings for existing users
            $users = $this->db->get('pengguna')->result();
            $notification_types = ['lamaran_baru', 'status_lamaran', 'sistem', 'registrasi_pengguna', 'jadwal_interview', 'penilaian', 'lowongan_baru'];

            foreach ($users as $user) {
                foreach ($notification_types as $type) {
                    $aktif = 1;
                    $email_notifikasi = 0;

                    // Admin gets all notifications
                    if ($user->role == 'admin') {
                        $aktif = 1;
                        $email_notifikasi = ($type == 'lamaran_baru' || $type == 'sistem') ? 1 : 0;
                    }
                    // Pelamar gets relevant notifications
                    elseif ($user->role == 'pelamar') {
                        $aktif = in_array($type, ['status_lamaran', 'jadwal_interview', 'penilaian', 'lowongan_baru']) ? 1 : 0;
                        $email_notifikasi = ($type == 'status_lamaran' || $type == 'jadwal_interview') ? 1 : 0;
                    }

                    $this->db->insert('pengaturan_notifikasi', [
                        'id_pengguna' => $user->id,
                        'jenis_notifikasi' => $type,
                        'aktif' => $aktif,
                        'email_notifikasi' => $email_notifikasi,
                        'whatsapp_notifikasi' => 0
                    ]);
                }
            }

            echo "<p style='color: green;'>✅ Default notification settings created for " . count($users) . " users!</p>";

            // Create welcome notification for current admin
            $current_user_id = $this->session->userdata('user_id');
            $this->db->insert('notifikasi', [
                'id_pengguna' => $current_user_id,
                'judul' => 'Sistem Notifikasi SIREK Aktif!',
                'pesan' => 'Selamat! Sistem notifikasi SIREK telah berhasil diaktifkan. Anda akan menerima notifikasi untuk lamaran baru, update status, dan aktivitas sistem lainnya.',
                'jenis' => 'sistem',
                'prioritas' => 'normal',
                'icon' => 'ni ni-check-bold',
                'warna' => 'success',
                'url_aksi' => 'admin/notifikasi'
            ]);

            echo "<p style='color: green;'>✅ Welcome notification created!</p>";

            echo "<div style='background: #d4edda; border: 1px solid #c3e6cb; color: #155724; padding: 15px; border-radius: 5px; margin: 20px 0;'>";
            echo "<h3>🎉 Setup Completed Successfully!</h3>";
            echo "<p>The notification system is now ready to use!</p>";
            echo "<p><a href='" . base_url('admin/notifikasi') . "' class='btn btn-success'>Go to Notifications</a></p>";
            echo "</div>";

        } catch (Exception $e) {
            echo "<div style='background: #f8d7da; border: 1px solid #f5c6cb; color: #721c24; padding: 15px; border-radius: 5px; margin: 20px 0;'>";
            echo "<h3>❌ Setup Failed</h3>";
            echo "<p><strong>Error:</strong> " . $e->getMessage() . "</p>";
            echo "</div>";
        }
    }
}
