<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddFieldsToLowongan extends Migration
{
    public function up()
    {
        $fields = [
            'pendidikan' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null'       => true,
                'after'      => 'deskripsi'
            ],
            'pengalaman' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null'       => true,
                'after'      => 'pendidikan'
            ],
        ];
        $this->forge->addColumn('lowongan_pekerjaan', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('lowongan_pekerjaan', 'pendidikan');
        $this->forge->dropColumn('lowongan_pekerjaan', 'pengalaman');
    }
}
