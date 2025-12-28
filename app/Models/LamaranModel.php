<?php

namespace App\Models;

use CodeIgniter\Model;

class LamaranModel extends Model
{
    protected $table = 'lamaran_pekerjaan';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'lowongan_id',
        'pelamar_id',
        'cv_file',
        'status_review'
    ];

    protected $useTimestamps = false;
}
