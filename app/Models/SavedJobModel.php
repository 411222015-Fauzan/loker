<?php

namespace App\Models;

use CodeIgniter\Model;

class SavedJobModel extends Model
{
    protected $table = 'saved_jobs';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'lowongan_id'];
    protected $useTimestamps = true;

    public function getSavedJobs($userId)
    {
        return $this->select('saved_jobs.id as saved_id, lowongan_pekerjaan.*, perusahaan_profiles.nama_perusahaan, perusahaan_profiles.logo, wilayah.nama_wilayah')
            ->join('lowongan_pekerjaan', 'lowongan_pekerjaan.id = saved_jobs.lowongan_id')
            ->join('perusahaan_profiles', 'perusahaan_profiles.id = lowongan_pekerjaan.perusahaan_id')
            ->join('wilayah', 'wilayah.id = lowongan_pekerjaan.wilayah_id')
            ->where('saved_jobs.user_id', $userId)
            ->findAll();
    }
}
