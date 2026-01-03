<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddTimestampsToLamaran extends Migration
{
    public function up()
    {
        $fields = [
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ];
        $this->forge->addColumn('lamaran_pekerjaan', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('lamaran_pekerjaan', ['created_at', 'updated_at']);
    }
}
