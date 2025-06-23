<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_document_tables extends CI_Migration {

    public function up() {
        // Create dokumen_lowongan table (job document requirements)
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'id_lowongan' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE
            ),
            'jenis_dokumen' => array(
                'type' => 'VARCHAR',
                'constraint' => '50'
            ),
            'nama_dokumen' => array(
                'type' => 'VARCHAR',
                'constraint' => '100'
            ),
            'wajib' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 1
            ),
            'format_diizinkan' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'default' => 'pdf|doc|docx|jpg|jpeg|png'
            ),
            'ukuran_maksimal' => array(
                'type' => 'INT',
                'constraint' => 11,
                'default' => 2048 // 2MB
            ),
            'deskripsi' => array(
                'type' => 'TEXT',
                'null' => TRUE
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
        $this->dbforge->add_key('id_lowongan');
        $this->dbforge->create_table('dokumen_lowongan');

        // Create dokumen_lamaran table (application documents)
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'id_lamaran' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE
            ),
            'id_dokumen_lowongan' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'null' => TRUE
            ),
            'jenis_dokumen' => array(
                'type' => 'VARCHAR',
                'constraint' => '50'
            ),
            'nama_file' => array(
                'type' => 'VARCHAR',
                'constraint' => '255'
            ),
            'ukuran_file' => array(
                'type' => 'INT',
                'constraint' => 11
            ),
            'tipe_file' => array(
                'type' => 'VARCHAR',
                'constraint' => '50'
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
        $this->dbforge->add_key('id_lamaran');
        $this->dbforge->add_key('id_dokumen_lowongan');
        $this->dbforge->create_table('dokumen_lamaran');

        // Add foreign key constraints
        $this->db->query('ALTER TABLE `dokumen_lowongan` ADD CONSTRAINT `fk_dokumen_lowongan_lowongan` FOREIGN KEY (`id_lowongan`) REFERENCES `lowongan_pekerjaan` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT');
        $this->db->query('ALTER TABLE `dokumen_lamaran` ADD CONSTRAINT `fk_dokumen_lamaran_lamaran` FOREIGN KEY (`id_lamaran`) REFERENCES `lamaran_pekerjaan` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT');
        $this->db->query('ALTER TABLE `dokumen_lamaran` ADD CONSTRAINT `fk_dokumen_lamaran_dokumen_lowongan` FOREIGN KEY (`id_dokumen_lowongan`) REFERENCES `dokumen_lowongan` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT');
    }

    public function down() {
        // Drop foreign key constraints first
        $this->db->query('ALTER TABLE `dokumen_lamaran` DROP FOREIGN KEY `fk_dokumen_lamaran_dokumen_lowongan`');
        $this->db->query('ALTER TABLE `dokumen_lamaran` DROP FOREIGN KEY `fk_dokumen_lamaran_lamaran`');
        $this->db->query('ALTER TABLE `dokumen_lowongan` DROP FOREIGN KEY `fk_dokumen_lowongan_lowongan`');

        // Drop tables
        $this->dbforge->drop_table('dokumen_lamaran');
        $this->dbforge->drop_table('dokumen_lowongan');
    }
}
