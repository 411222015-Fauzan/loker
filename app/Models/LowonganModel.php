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
            ->where('status_pekerjaan', 'open');

        if ($keyword) {
            $builder->like('judul', $keyword);
        }
        if ($klasifikasi) {
            $builder->where('klasifikasi_id', $klasifikasi);
        }
        if ($wilayah) {
            $builder->where('wilayah_id', $wilayah);
        }

        return $builder->findAll();
    }
}
