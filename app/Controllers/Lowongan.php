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
        $keyword = $this->request->getGet('keyword');
        $klasifikasiId = $this->request->getGet('klasifikasi');
        $wilayahId = $this->request->getGet('wilayah');

        $data = [
            'lowongan' => (new LowonganModel())->search($keyword, $klasifikasiId, $wilayahId),
            'klasifikasi' => (new KlasifikasiModel())->findAll(),
            'wilayah' => (new WilayahModel())->findAll(),
            'keyword' => $keyword,
            'selected_klasifikasi' => $klasifikasiId,
            'selected_wilayah' => $wilayahId,
        ];

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

    public function store()
    {
        // only perusahaan can post
        if (session('role') != 'perusahaan') {
            return redirect()->to('/login')->with('error', 'Akses ditolak');
        }

        $post = $this->request->getPost();

        // find perusahaan profile linked to current user
        $perusahaan = (new \App\Models\PerusahaanModel())->where('user_id', session('id'))->first();
        if (!$perusahaan) {
            return redirect()->back()->with('error', 'Profil perusahaan tidak ditemukan. Lengkapi profil terlebih dahulu.');
        }

        $data = [
            'perusahaan_id' => $perusahaan['id'],
            'judul' => $post['judul'] ?? null,
            'deskripsi' => $post['deskripsi'] ?? null,
            'klasifikasi_id' => $post['klasifikasi_id'] ?? null,
            'wilayah_id' => $post['wilayah_id'] ?? null,
            'tipe_pekerjaan' => $post['tipe_pekerjaan'] ?? null,
            'gaji_min' => $post['gaji_min'] ?? null,
            'gaji_max' => $post['gaji_max'] ?? null,
            'status_pekerjaan' => 'open'
        ];

        $model = new LowonganModel();
        $model->insert($data);

        return redirect()->to('/dashboard')->with('success', 'Lowongan berhasil diposting');
    }
}
