<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class JobSeeder extends Seeder
{
    public function run()
    {
        $db = \Config\Database::connect();
        
        // Disable FK checks to allow truncate
        $db->query('SET FOREIGN_KEY_CHECKS = 0');
        
        // Clean up text
        echo "Truncating tables...\n";
        $db->table('saved_jobs')->truncate();
        $db->table('lamaran_pekerjaan')->truncate();
        $db->table('lowongan_pekerjaan')->truncate();
        
        $db->query('SET FOREIGN_KEY_CHECKS = 1');

        // Reference Data
        $perusahaanId = 1; // PT KING KONG
        $jakartaSelatanId = 4; // Use one of the duplicates as canonical
        
        $jobs = [
            [
                'judul' => 'Staff Accounting / Akuntansi',
                'deskripsi' => 'Mengelola laporan keuangan perusahaan.',
                'klasifikasi_id' => 1, // Akuntansi
                'wilayah_id' => $jakartaSelatanId,
                'pendidikan' => 'S1',
                'pengalaman' => '1 Tahun'
            ],
            [
                'judul' => 'IT Support',
                'deskripsi' => 'Maintenance hardware dan software.',
                'klasifikasi_id' => 17, // IT
                'wilayah_id' => $jakartaSelatanId,
                'pendidikan' => 'D3/S1',
                'pengalaman' => 'Fresh Graduate'
            ],
            [
                'judul' => 'Digital Marketing / Pemasaran Digital',
                'deskripsi' => 'Mengelola iklan online dan social media.',
                'klasifikasi_id' => 3, // Periklanan/Media
                'wilayah_id' => $jakartaSelatanId,
                'pendidikan' => 'S1',
                'pengalaman' => '2 Tahun'
            ],
            [
                'judul' => 'Admin Gudang / Warehouse Admin',
                'deskripsi' => 'Mencatat keluar masuk barang.',
                'klasifikasi_id' => 2, // Admin
                'wilayah_id' => $jakartaSelatanId,
                'pendidikan' => 'SMA/SMK',
                'pengalaman' => '1 Tahun'
            ],
             [
                'judul' => 'Sales Executive',
                'deskripsi' => 'Mencari klien baru.',
                'klasifikasi_id' => 6, // Management/Umum (proxy for Sales)
                'wilayah_id' => $jakartaSelatanId,
                'pendidikan' => 'D3',
                'pengalaman' => '1 Tahun'
            ],
        ];

        echo "Inserting fresh jobs...\n";
        foreach ($jobs as $job) {
            $data = [
                'perusahaan_id' => $perusahaanId,
                'judul' => $job['judul'],
                'deskripsi' => $job['deskripsi'],
                'klasifikasi_id' => $job['klasifikasi_id'],
                'wilayah_id' => $job['wilayah_id'],
                'tipe_pekerjaan' => 'Full Time',
                'gaji_min' => 5000000,
                'gaji_max' => 8000000,
                'status_pekerjaan' => 'open',
                'create_date_post' => date('Y-m-d'),
                'end_date_post' => date('Y-m-d', strtotime('+30 days')),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'pendidikan' => $job['pendidikan'],
                'pengalaman' => $job['pengalaman']
            ];
            $db->table('lowongan_pekerjaan')->insert($data);
        }
        
        echo "Done. 5 jobs inserted.\n";
    }
}
