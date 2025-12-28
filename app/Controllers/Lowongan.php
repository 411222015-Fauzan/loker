<?php

namespace App\Controllers;

use App\Models\LowonganModel;
use App\Models\KlasifikasiModel;
use App\Models\WilayahModel;

class Lowongan extends BaseController
{
    public function index()
    {
        $data = [
            'lowongan' => (new LowonganModel())->where('status_pekerjaan','open')->findAll(),
            'klasifikasi' => (new KlasifikasiModel())->findAll(),
            'wilayah' => (new WilayahModel())->findAll()
        ];
        return view('lowongan/index', $data);
    }

    public function search()
    {
        $data['lowongan'] = (new LowonganModel())->search(
            $this->request->getGet('keyword'),
            $this->request->getGet('klasifikasi'),
            $this->request->getGet('wilayah')
        );
        return view('lowongan/index', $data);
    }

    public function detail($id)
    {
        $data['lowongan'] = (new LowonganModel())
            ->select('lowongan_pekerjaan.*, perusahaan_profiles.nama_perusahaan')
            ->join('perusahaan_profiles','perusahaan_profiles.id=lowongan_pekerjaan.perusahaan_id')
            ->find($id);

        return view('lowongan/detail', $data);
    }
}
