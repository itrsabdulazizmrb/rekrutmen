<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_dokumen_pelamar_table extends CI_Migration {

    public function up() {
        // Create dokumen_pelamar table (applicant documents)
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
            'jenis_dokumen' => array(
                'type' => 'VARCHAR',
                'constraint' => '50'
            ),
            'nama_dokumen' => array(
                'type' => 'VARCHAR',
                'constraint' => '100'
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
        $this->dbforge->add_key('id_pengguna');
        $this->dbforge->add_key('jenis_dokumen');
        
        // Create the table
        $this->dbforge->create_table('dokumen_pelamar', TRUE);
        
        // Add foreign key constraint
        $this->db->query('ALTER TABLE `dokumen_pelamar` ADD CONSTRAINT `fk_dokumen_pelamar_pengguna` FOREIGN KEY (`id_pengguna`) REFERENCES `pengguna` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT');
    }

    public function down() {
        // Drop foreign key constraint first
        $this->db->query('ALTER TABLE `dokumen_pelamar` DROP FOREIGN KEY `fk_dokumen_pelamar_pengguna`');
        
        // Drop the table
        $this->dbforge->drop_table('dokumen_pelamar', TRUE);
    }
}
