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

        $lowongan = (new \App\Models\LowonganModel())->where('status_pekerjaan', 'open')->findAll();
        return view('dashboard/pelamar', [
            'klasifikasi' => $klasifikasi,
            'wilayah' => $wilayah,
            'lowongan' => $lowongan
        ]);
    }
}
