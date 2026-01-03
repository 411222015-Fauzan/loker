<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        $data = [
            'klasifikasi' => (new \App\Models\KlasifikasiModel())->findAll(),
            'wilayah' => (new \App\Models\WilayahModel())->findAll(),
            'lowongan' => (new \App\Models\LowonganModel())->where('status_pekerjaan', 'open')->findAll(),
            'perusahaan' => (new \App\Models\PerusahaanModel())->findAll()
        ];
        return view('welcome_message', $data);
    }
}
