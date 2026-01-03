<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePerusahaanProfiles extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true
            ],
            'user_id' => [ 'type' => 'INT', 'constraint' => 11, 'unsigned' => true ],
            'nama_perusahaan' => [ 'type' => 'VARCHAR', 'constraint' => 255, 'null' => true ],
            'no_telp' => [ 'type' => 'VARCHAR', 'constraint' => 50, 'null' => true ],
            'bidang' => [ 'type' => 'VARCHAR', 'constraint' => 255, 'null' => true ],
            'deskripsi' => [ 'type' => 'TEXT', 'null' => true ],
            'alamat' => [ 'type' => 'VARCHAR', 'constraint' => 255, 'null' => true ],
            'wilayah_id' => [ 'type' => 'INT', 'constraint' => 11, 'null' => true ],
            'logo' => [ 'type' => 'VARCHAR', 'constraint' => 255, 'null' => true ],
            'website' => [ 'type' => 'VARCHAR', 'constraint' => 255, 'null' => true ],
            'created_at' => [ 'type' => 'DATETIME', 'null' => true ],
            'updated_at' => [ 'type' => 'DATETIME', 'null' => true ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('perusahaan_profiles', true);
    }

    public function down()
    {
        $this->forge->dropTable('perusahaan_profiles');
    }
}
