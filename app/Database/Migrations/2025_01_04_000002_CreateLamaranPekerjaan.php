<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateLamaranPekerjaan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [ 'type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true ],
            'lowongan_id' => [ 'type' => 'INT', 'constraint' => 11, 'unsigned' => true ],
            'pelamar_id' => [ 'type' => 'INT', 'constraint' => 11, 'unsigned' => true ],
            'cv_file' => [ 'type' => 'VARCHAR', 'constraint' => 255, 'null' => true ],
            'status_review' => [ 'type' => 'ENUM', 'constraint' => ['pending','reviewed','rejected'], 'default' => 'pending' ],
            'created_at' => [ 'type' => 'DATETIME', 'null' => true ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('lamaran_pekerjaan', true);
    }

    public function down()
    {
        $this->forge->dropTable('lamaran_pekerjaan');
    }
}
