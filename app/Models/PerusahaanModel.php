<?php

namespace App\Models;

use CodeIgniter\Model;

class PerusahaanModel extends Model
{
    protected $table = 'perusahaan_profiles';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'user_id',
        'nama_perusahaan',
        'bidang',
        'deskripsi',
        'alamat',
        'wilayah_id',
        'logo',
        'website'
    ];

    protected $useTimestamps = true;
}
