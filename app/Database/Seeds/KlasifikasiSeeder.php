<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class KlasifikasiSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['nama_klasifikasi' => 'Akuntansi'],
            ['nama_klasifikasi' => 'Administrasi & Dukungan Perkantoran'],
            ['nama_klasifikasi' => 'Periklanan, Seni & Media'],
            ['nama_klasifikasi' => 'Perbankan & Layanan Finansial'],
            ['nama_klasifikasi' => 'Call Center & Layanan Konsumen'],
            ['nama_klasifikasi' => 'Manajemen Umum'],
            ['nama_klasifikasi' => 'Konstruksi'],
            ['nama_klasifikasi' => 'Konsultasi & Strategi'],
            ['nama_klasifikasi' => 'Desain & Arsitektur'],
            ['nama_klasifikasi' => 'Pendidikan & Pelatihan'],
            ['nama_klasifikasi' => 'Teknik'],
            ['nama_klasifikasi' => 'Pertanian, Hewan & Konservasi'],
            ['nama_klasifikasi' => 'Pemerintahan & Pertahanan'],
            ['nama_klasifikasi' => 'Kesehatan & Medis'],
            ['nama_klasifikasi' => 'Hospitaliti & Pariwisata'],
            ['nama_klasifikasi' => 'Sumber Daya Manusia & Perekrutan'],
            ['nama_klasifikasi' => 'Teknologi Informasi & Komunikasi'],
            ['nama_klasifikasi' => 'Asuransi & Dana Pensiun'],
            ['nama_klasifikasi' => 'Hukum'],
            ['nama_klasifikasi' => 'Manufaktur, Transportasi & Logistik'],
            ['nama_klasifikasi' => 'Pemasaran & Komunikasi'],
            ['nama_klasifikasi' => 'Pertambangan, Sumber Daya Alam & Energi'],
            ['nama_klasifikasi' => 'Real Estat & Properti'],
            ['nama_klasifikasi' => 'Ritel & Produk Konsumen'],
            ['nama_klasifikasi' => 'Penjualan'],
            ['nama_klasifikasi' => 'Sains & Teknologi'],
            ['nama_klasifikasi' => 'Pekerjaan Lepas'],
            ['nama_klasifikasi' => 'Olahraga & Rekreasi'],
            ['nama_klasifikasi' => 'Keterampilan & Jasa'],
        ];

        $this->db->table('klasifikasi_pekerjaan')->insertBatch($data);
    }
}
