<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePelamarProfiles extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [ 'type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true ],
            'user_id' => [ 'type' => 'INT', 'constraint' => 11, 'unsigned' => true ],
            'nama_lengkap' => [ 'type' => 'VARCHAR', 'constraint' => 255, 'null' => true ],
            'no_hp' => [ 'type' => 'VARCHAR', 'constraint' => 50, 'null' => true ],
            'tanggal_lahir' => [ 'type' => 'DATE', 'null' => true ],
            'alamat' => [ 'type' => 'VARCHAR', 'constraint' => 255, 'null' => true ],
            'pendidikan' => [ 'type' => 'VARCHAR', 'constraint' => 255, 'null' => true ],
            'pengalaman' => [ 'type' => 'TEXT', 'null' => true ],
            'skill' => [ 'type' => 'TEXT', 'null' => true ],
            'foto' => [ 'type' => 'VARCHAR', 'constraint' => 255, 'null' => true ],
            'created_at' => [ 'type' => 'DATETIME', 'null' => true ],
            'updated_at' => [ 'type' => 'DATETIME', 'null' => true ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('pelamar_profiles', true);
    }

    public function down()
    {
        $this->forge->dropTable('pelamar_profiles');
    }
}
