<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class BulkJobSeeder extends Seeder
{
    public function run()
    {
        $db = \Config\Database::connect();
        
        // 3 Existing Companies
        $companies = [1, 2, 3];
        
        // Use a broader range assuming they exist, or fetch valid IDs first?
        // Based on debug_db, we have ~22 wilayah and ~58 klasifikasi.
        // We will randomly pick from IDs 1-20 for now to be safe, or higher up to limit.
        // Or better, let's just hardcode some good pairs to ensure quality data.
        
        $jobs = [
            ['Software Engineer / Programmer', 'Mengembangkan aplikasi web dan mobile.', 17], // IT
            ['HRD Manager / Personalia', 'Mengelola rekrutmen dan kinerja karyawan.', 16], // HR
            ['Marketing Communication', 'Merancang strategi komunikasi pemasaran.', 3], // Media
            ['Senior Accountant', 'Membuat laporan keuangan tahunan.', 1], // Akuntansi
            ['Data Analyst', 'Menganalisis data bisnis untuk keputusan strategis.', 17], // IT
            ['Customer Service', 'Melayani keluhan dan pertanyaan pelanggan.', 5], // CS
            ['Gudang / Warehouse Staff', 'Operasional keluar masuk barang.', 20], // Logistik
            ['Legal Staff', 'Menangani dokumen hukum perusahaan.', 19], // Hukum
            ['Sales Motoris', 'Menjual produk ke toko-toko retail.', 6], // Sales
            ['Graphic Designer', 'Membuat konten visual untuk sosial media.', 9], // Desain
            ['Civil Engineer', 'Mengawasi proyek konstruksi bangunan.', 7], // Konstruksi
            ['Farm Manager', 'Mengelola operasional perkebunan.', 12], // Pertanian
            ['Dokter Umum', 'Melayani pasien di klinik perusahaan.', 14], // Medis
            ['Guru Bahasa Inggris', 'Mengajar kelas bahasa inggris untuk karyawan.', 10], // Pendidikan
            ['Teknisi Listrik', 'Maintenance instalasi listrik gedung.', 11], // Teknik
            ['Resepsionis', 'Menerima tamu dan telepon.', 2], // Admin
            ['Content Writer', 'Menulis artikel untuk blog perusahaan.', 3], // Media
            ['Financial Advisor', 'Memberikan saran investasi kepada klien.', 4], // Finance
            ['Chef / Koki', 'Memasak makanan untuk kantin perusahaan.', 15], // Hospitality
            ['Security / Satpam', 'Menjaga keamanan lingkungan kerja.', 13], // Pemerintahan/Pertahanan equivalent
        ];

        // Valid Wilayah IDs from database
        $validWilayahIds = [11, 25, 24, 7, 19, 18, 30, 27, 28, 26, 8, 3, 1, 4, 5, 2, 6, 29, 9, 22, 21, 10];
        
        echo "Inserting 20 diverse jobs...\n";
        
        foreach ($jobs as $index => $job) {
            $companyId = $companies[$index % 3]; // Distribute 1, 2, 3
            
            // Random attributes
            $wilayahId = $validWilayahIds[array_rand($validWilayahIds)];
            $gajiMin = rand(4, 8) * 1000000;
            $gajiMax = $gajiMin + rand(1, 5) * 1000000;
            
            $data = [
                'perusahaan_id' => $companyId,
                'judul' => $job[0],
                'deskripsi' => $job[1],
                'klasifikasi_id' => $job[2],
                'wilayah_id' => $wilayahId,
                'tipe_pekerjaan' => 'Full Time',
                'gaji_min' => $gajiMin,
                'gaji_max' => $gajiMax,
                'status_pekerjaan' => 'open',
                'create_date_post' => date('Y-m-d'),
                'end_date_post' => date('Y-m-d', strtotime('+30 days')),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'pendidikan' => 'S1',
                'pengalaman' => '1-3 Tahun'
            ];
            
            // Allow insert to fail gracefully if FK issue (though IDs should be valid)
            try {
                $db->table('lowongan_pekerjaan')->insert($data);
                echo ".";
            } catch (\Exception $e) {
                echo "x";
            }
        }
        
        echo "\nDone!\n";
    }
}
