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
        'end_date_post',
        'pendidikan',
        'pengalaman'
    ];

    protected $useTimestamps = true;

    // Pencarian lowongan
    // Pencarian lowongan
    public function search($keyword = null, $klasifikasi = null, $wilayah = null)
    {
        $builder = $this->select('lowongan_pekerjaan.*, perusahaan_profiles.nama_perusahaan, perusahaan_profiles.logo, wilayah.nama_wilayah, klasifikasi_pekerjaan.nama_klasifikasi')
            ->join('perusahaan_profiles', 'perusahaan_profiles.id = lowongan_pekerjaan.perusahaan_id')
            ->join('wilayah', 'wilayah.id = lowongan_pekerjaan.wilayah_id')
            ->join('klasifikasi_pekerjaan', 'klasifikasi_pekerjaan.id = lowongan_pekerjaan.klasifikasi_id')
            ->where('lowongan_pekerjaan.status_pekerjaan', 'open');

        if ($keyword && $keyword != '#') {
            $builder->groupStart()
                ->like('lowongan_pekerjaan.judul', $keyword)
                ->orLike('perusahaan_profiles.nama_perusahaan', $keyword)
                ->groupEnd();
        }
        if ($klasifikasi && $klasifikasi != '#') {
            $k = (new KlasifikasiModel())->find($klasifikasi);
            if ($k) {
                $builder->where('klasifikasi_pekerjaan.nama_klasifikasi', $k['nama_klasifikasi']);
            } else {
                // If finding by ID failed (maybe it's a name passed directly? or just bad ID)
                // Try searching by name just in case
                $builder->groupStart()
                    ->where('lowongan_pekerjaan.klasifikasi_id', $klasifikasi)
                    ->orLike('klasifikasi_pekerjaan.nama_klasifikasi', $klasifikasi)
                    ->groupEnd();
            }
        }
        if ($wilayah && $wilayah != '#') {
            $w = (new WilayahModel())->find($wilayah);
            if ($w) {
                $builder->where('wilayah.nama_wilayah', $w['nama_wilayah']);
            } else {
                 $builder->groupStart()
                    ->where('lowongan_pekerjaan.wilayah_id', $wilayah)
                    ->orLike('wilayah.nama_wilayah', $wilayah)
                    ->groupEnd();
            }
        }

        return $builder->orderBy('lowongan_pekerjaan.created_at', 'DESC')->findAll();
    }
}
