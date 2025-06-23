<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_notifications_table extends CI_Migration {

    public function up() {
        // Create notifications table
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'id_pengguna' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'comment' => 'ID pengguna yang menerima notifikasi'
            ),
            'judul' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'comment' => 'Judul notifikasi'
            ),
            'pesan' => array(
                'type' => 'TEXT',
                'comment' => 'Isi pesan notifikasi'
            ),
            'jenis' => array(
                'type' => 'ENUM',
                'constraint' => array('lamaran_baru', 'status_lamaran', 'sistem', 'registrasi_pengguna', 'jadwal_interview', 'penilaian', 'lowongan_baru'),
                'default' => 'sistem',
                'comment' => 'Jenis notifikasi'
            ),
            'prioritas' => array(
                'type' => 'ENUM',
                'constraint' => array('rendah', 'normal', 'tinggi', 'urgent'),
                'default' => 'normal',
                'comment' => 'Tingkat prioritas notifikasi'
            ),
            'status' => array(
                'type' => 'ENUM',
                'constraint' => array('belum_dibaca', 'dibaca', 'diarsipkan'),
                'default' => 'belum_dibaca',
                'comment' => 'Status baca notifikasi'
            ),
            'id_referensi' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'null' => TRUE,
                'comment' => 'ID referensi ke tabel terkait (lamaran, lowongan, dll)'
            ),
            'tabel_referensi' => array(
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => TRUE,
                'comment' => 'Nama tabel referensi'
            ),
            'url_aksi' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE,
                'comment' => 'URL untuk aksi notifikasi'
            ),
            'icon' => array(
                'type' => 'VARCHAR',
                'constraint' => '50',
                'default' => 'ni ni-bell-55',
                'comment' => 'Icon notifikasi'
            ),
            'warna' => array(
                'type' => 'VARCHAR',
                'constraint' => '20',
                'default' => 'primary',
                'comment' => 'Warna notifikasi (primary, success, warning, danger, info)'
            ),
            'dibaca_pada' => array(
                'type' => 'TIMESTAMP',
                'null' => TRUE,
                'comment' => 'Waktu notifikasi dibaca'
            ),
            'kedaluwarsa_pada' => array(
                'type' => 'TIMESTAMP',
                'null' => TRUE,
                'comment' => 'Waktu kedaluwarsa notifikasi'
            ),
            'dibuat_oleh' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'null' => TRUE,
                'comment' => 'ID pengguna yang membuat notifikasi'
            ),
            'dibuat_pada' => array(
                'type' => 'TIMESTAMP',
                'default' => 'CURRENT_TIMESTAMP',
                'comment' => 'Waktu notifikasi dibuat'
            ),
            'diperbarui_pada' => array(
                'type' => 'TIMESTAMP',
                'default' => 'CURRENT_TIMESTAMP',
                'on update' => 'CURRENT_TIMESTAMP',
                'comment' => 'Waktu notifikasi diperbarui'
            )
        ));

        // Set primary key
        $this->dbforge->add_key('id', TRUE);

        // Add indexes for better performance
        $this->dbforge->add_key('id_pengguna');
        $this->dbforge->add_key('jenis');
        $this->dbforge->add_key('status');
        $this->dbforge->add_key('prioritas');
        $this->dbforge->add_key('dibuat_pada');
        $this->dbforge->add_key(array('id_referensi', 'tabel_referensi'));

        // Create the table
        $this->dbforge->create_table('notifikasi', TRUE);

        // Add foreign key constraints
        $this->db->query('ALTER TABLE `notifikasi` ADD CONSTRAINT `fk_notifikasi_pengguna` FOREIGN KEY (`id_pengguna`) REFERENCES `pengguna` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT');
        $this->db->query('ALTER TABLE `notifikasi` ADD CONSTRAINT `fk_notifikasi_dibuat_oleh` FOREIGN KEY (`dibuat_oleh`) REFERENCES `pengguna` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT');

        // Create notification settings table
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'id_pengguna' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE
            ),
            'jenis_notifikasi' => array(
                'type' => 'VARCHAR',
                'constraint' => '50'
            ),
            'aktif' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 1
            ),
            'email_notifikasi' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 0
            ),
            'whatsapp_notifikasi' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 0
            ),
            'dibuat_pada' => array(
                'type' => 'TIMESTAMP',
                'default' => 'CURRENT_TIMESTAMP'
            ),
            'diperbarui_pada' => array(
                'type' => 'TIMESTAMP',
                'default' => 'CURRENT_TIMESTAMP',
                'on update' => 'CURRENT_TIMESTAMP'
            )
        ));

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_key('id_pengguna');
        $this->dbforge->add_key('jenis_notifikasi');
        $this->dbforge->create_table('pengaturan_notifikasi', TRUE);

        // Add foreign key for notification settings
        $this->db->query('ALTER TABLE `pengaturan_notifikasi` ADD CONSTRAINT `fk_pengaturan_notifikasi_pengguna` FOREIGN KEY (`id_pengguna`) REFERENCES `pengguna` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT');

        // Insert default notification settings for existing users
        $this->db->query("
            INSERT INTO pengaturan_notifikasi (id_pengguna, jenis_notifikasi, aktif, email_notifikasi, whatsapp_notifikasi)
            SELECT p.id, 'lamaran_baru', 1, 1, 0 FROM pengguna p WHERE p.role = 'admin'
            UNION ALL
            SELECT p.id, 'status_lamaran', 1, 1, 0 FROM pengguna p WHERE p.role IN ('admin', 'pelamar')
            UNION ALL
            SELECT p.id, 'sistem', 1, 1, 0 FROM pengguna p
            UNION ALL
            SELECT p.id, 'registrasi_pengguna', 1, 1, 0 FROM pengguna p WHERE p.role = 'admin'
            UNION ALL
            SELECT p.id, 'jadwal_interview', 1, 1, 0 FROM pengguna p
            UNION ALL
            SELECT p.id, 'penilaian', 1, 1, 0 FROM pengguna p
            UNION ALL
            SELECT p.id, 'lowongan_baru', 1, 1, 0 FROM pengguna p WHERE p.role = 'pelamar'
        ");

        // Create sample notifications for testing
        $this->db->query("
            INSERT INTO notifikasi (id_pengguna, judul, pesan, jenis, prioritas, icon, warna, url_aksi)
            SELECT
                p.id,
                'Selamat Datang di SIREK!',
                'Terima kasih telah bergabung dengan sistem rekrutmen SIREK. Silakan lengkapi profil Anda untuk pengalaman yang lebih baik.',
                'sistem',
                'normal',
                'ni ni-check-bold',
                'success',
                'admin/profil'
            FROM pengguna p
            WHERE p.role = 'admin'
            LIMIT 1
        ");
    }

    public function down() {
        // Drop foreign key constraints first
        $this->db->query('ALTER TABLE `pengaturan_notifikasi` DROP FOREIGN KEY `fk_pengaturan_notifikasi_pengguna`');
        $this->db->query('ALTER TABLE `notifikasi` DROP FOREIGN KEY `fk_notifikasi_pengguna`');
        $this->db->query('ALTER TABLE `notifikasi` DROP FOREIGN KEY `fk_notifikasi_dibuat_oleh`');

        // Drop tables
        $this->dbforge->drop_table('pengaturan_notifikasi');
        $this->dbforge->drop_table('notifikasi');
    }
}
