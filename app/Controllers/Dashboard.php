<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function index()
    {
        $role = session('role');

        // Load shared data
        $klasifikasi = (new \App\Models\KlasifikasiModel())->findAll();
        $wilayah = (new \App\Models\WilayahModel())->findAll();

        if ($role == 'perusahaan') {
            // if company profile missing, redirect to profile form
            $perusahaan = (new \App\Models\PerusahaanModel())->where('user_id', session('id'))->first();
            if (!$perusahaan) {
                return redirect()->to('/perusahaan/profile');
            }

            $my_lowongan = (new \App\Models\LowonganModel())->where('perusahaan_id', $perusahaan['id'])->findAll();

            return view('dashboard/perusahaan', [
                'klasifikasi' => $klasifikasi,
                'wilayah' => $wilayah,
                'my_lowongan' => $my_lowongan
            ]);
        }

        // Pelamar dashboard shows search + available lowongan
        $pelamar = (new \App\Models\PelamarModel())->where('user_id', session('id'))->first();
        if (!$pelamar) {
            return redirect()->to('/pelamar/profile');
        }

        // Fetch data similar to Home Page
        $lowonganModel = new \App\Models\LowonganModel();
        
        $rekomendasi = $lowonganModel
            ->select('lowongan_pekerjaan.*, perusahaan_profiles.nama_perusahaan, perusahaan_profiles.logo, wilayah.nama_wilayah')
            ->join('perusahaan_profiles', 'perusahaan_profiles.id = lowongan_pekerjaan.perusahaan_id')
            ->join('wilayah', 'wilayah.id = lowongan_pekerjaan.wilayah_id')
            ->where('lowongan_pekerjaan.status_pekerjaan', 'open')
            ->orderBy('lowongan_pekerjaan.created_at', 'DESC')
            ->limit(5)
            ->find();

        $latest = $lowonganModel
            ->select('lowongan_pekerjaan.*, perusahaan_profiles.nama_perusahaan, perusahaan_profiles.logo, wilayah.nama_wilayah')
            ->join('perusahaan_profiles', 'perusahaan_profiles.id = lowongan_pekerjaan.perusahaan_id')
            ->join('wilayah', 'wilayah.id = lowongan_pekerjaan.wilayah_id')
            ->where('lowongan_pekerjaan.status_pekerjaan', 'open')
            ->orderBy('lowongan_pekerjaan.created_at', 'DESC')
            ->limit(10)
            ->find();

        return view('dashboard/pelamar', [
            'klasifikasi' => $klasifikasi,
            'wilayah' => $wilayah,
            'rekomendasi' => $rekomendasi,
            'latest' => $latest,
            'pelamar' => $pelamar
        ]);
    }
}
