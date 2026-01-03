<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddNoTelpToPerusahaanProfiles extends Migration
{
    public function up()
    {
        $fields = [
            'no_telp' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true,
            ],
        ];

        $this->forge->addColumn('perusahaan_profiles', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('perusahaan_profiles', 'no_telp');
    }
}
