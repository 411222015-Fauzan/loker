<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class WilayahSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['nama_wilayah' => 'Jakarta Pusat'],
            ['nama_wilayah' => 'Jakarta Utara'],
            ['nama_wilayah' => 'Jakarta Barat'],
            ['nama_wilayah' => 'Jakarta Selatan'],
            ['nama_wilayah' => 'Jakarta Timur'],
            ['nama_wilayah' => 'Kepulauan Seribu'],
            ['nama_wilayah' => 'Bogor (Kota)'],
            ['nama_wilayah' => 'Bogor (Kabupaten)'],
            ['nama_wilayah' => 'Depok'],
            ['nama_wilayah' => 'Tangerang (Kota)'],
            ['nama_wilayah' => 'Tangerang (Kabupaten)'],
            ['nama_wilayah' => 'Tangerang Selatan'],
            ['nama_wilayah' => 'Bekasi (Kota)'],
            ['nama_wilayah' => 'Bekasi (Kabupaten)'],
            ['nama_wilayah' => 'Cileduk'],
            ['nama_wilayah' => 'Cibinong'],
            ['nama_wilayah' => 'Cikarang'],
            ['nama_wilayah' => 'Serpong'],
            ['nama_wilayah' => 'BSD City'],
        ];

        $this->db->table('wilayah')->insertBatch($data);
    }
}
