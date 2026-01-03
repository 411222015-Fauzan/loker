<?php

namespace App\Models;

use CodeIgniter\Model;

class LowonganModel extends Model
{
    protected $table = 'lowongan_pekerjaan';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'perusahaan_id',
        'judul',
        'deskripsi',
        'klasifikasi_id',
        'wilayah_id',
        'tipe_pekerjaan',
        'gaji_min',
        'gaji_max',
        'status_pekerjaan',
        'create_date_post',
        'end_date_post'
    ];

    protected $useTimestamps = true;

    // Pencarian lowongan
    public function search($keyword = null, $klasifikasi = null, $wilayah = null)
    {
        $builder = $this->select('lowongan_pekerjaan.*, perusahaan_profiles.nama_perusahaan')
            ->join('perusahaan_profiles', 'perusahaan_profiles.id = lowongan_pekerjaan.perusahaan_id')
            ->where('lowongan_pekerjaan.status_pekerjaan', 'open');

        if ($keyword) {
            $builder->like('lowongan_pekerjaan.judul', $keyword);
        }
        if ($klasifikasi) {
            $builder->where('lowongan_pekerjaan.klasifikasi_id', $klasifikasi);
        }
        if ($wilayah) {
            $builder->where('lowongan_pekerjaan.wilayah_id', $wilayah);
        }

        return $builder->findAll();
    }
}
