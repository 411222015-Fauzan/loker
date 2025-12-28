<?php

namespace App\Models;

use CodeIgniter\Model;

class PelamarModel extends Model
{
    protected $table = 'pelamar_profiles';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'user_id',
        'nama_lengkap',
        'no_hp',
        'tanggal_lahir',
        'alamat',
        'pendidikan',
        'pengalaman',
        'skill',
        'foto'
    ];

    protected $useTimestamps = true;
}
