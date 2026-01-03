<?php

namespace App\Controllers;

use App\Models\LowonganModel;
use App\Models\KlasifikasiModel;
use App\Models\WilayahModel;

class Lowongan extends BaseController
{
    public function index()
    {
        // Mendapatkan lowongan rekomendasi (misal: 5 random atau terbaru)
        $rekomendasi = (new LowonganModel())
            ->select('lowongan_pekerjaan.*, perusahaan_profiles.nama_perusahaan, perusahaan_profiles.logo, wilayah.nama_wilayah')
            ->join('perusahaan_profiles', 'perusahaan_profiles.id = lowongan_pekerjaan.perusahaan_id')
            ->join('wilayah', 'wilayah.id = lowongan_pekerjaan.wilayah_id')
            ->where('lowongan_pekerjaan.status_pekerjaan', 'open')
            ->orderBy('lowongan_pekerjaan.created_at', 'DESC')
            ->limit(5)
            ->find();

        // Mendapatkan lowongan terbaru (semua)
        $latest = (new LowonganModel())
            ->select('lowongan_pekerjaan.*, perusahaan_profiles.nama_perusahaan, perusahaan_profiles.logo, wilayah.nama_wilayah')
            ->join('perusahaan_profiles', 'perusahaan_profiles.id = lowongan_pekerjaan.perusahaan_id')
            ->join('wilayah', 'wilayah.id = lowongan_pekerjaan.wilayah_id')
            ->where('lowongan_pekerjaan.status_pekerjaan', 'open')
            ->orderBy('lowongan_pekerjaan.created_at', 'DESC')
            ->limit(10) // Limit biar tidak keberatan di awal
            ->find();

        $data = [
            'rekomendasi' => $rekomendasi,
            'latest' => $latest,
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
        $pengalaman = $this->request->getGet('pengalaman');

        $data = [
            'lowongan' => (new LowonganModel())->search($keyword, $klasifikasiId, $wilayahId, $pengalaman),
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
        $lowongan = (new LowonganModel())
            ->select('lowongan_pekerjaan.*, perusahaan_profiles.nama_perusahaan, perusahaan_profiles.logo, perusahaan_profiles.no_telp, perusahaan_profiles.website, wilayah.nama_wilayah, users.email as email_perusahaan')
            ->join('perusahaan_profiles', 'perusahaan_profiles.id=lowongan_pekerjaan.perusahaan_id')
            ->join('wilayah', 'wilayah.id=lowongan_pekerjaan.wilayah_id')
            ->join('users', 'users.id=perusahaan_profiles.user_id')
            ->find($id);

        if (!$lowongan) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        // Lowongan Terkait (Same Classification, exclude current)
        $terkait = (new LowonganModel())
            ->select('lowongan_pekerjaan.*, perusahaan_profiles.nama_perusahaan, perusahaan_profiles.logo, wilayah.nama_wilayah')
            ->join('perusahaan_profiles', 'perusahaan_profiles.id=lowongan_pekerjaan.perusahaan_id')
            ->join('wilayah', 'wilayah.id=lowongan_pekerjaan.wilayah_id')
            ->where('lowongan_pekerjaan.klasifikasi_id', $lowongan['klasifikasi_id'])
            ->where('lowongan_pekerjaan.id !=', $id)
            ->where('lowongan_pekerjaan.status_pekerjaan', 'open')
            ->limit(3)
            ->find();

        $data = [
            'lowongan' => $lowongan,
            'terkait' => $terkait,
            // Sidebar Data
            'klasifikasi' => (new KlasifikasiModel())->findAll(),
            'wilayah' => (new WilayahModel())->findAll()
        ];

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

        // Validate required foreign keys
        if (empty($post['wilayah_id']) || empty($post['klasifikasi_id'])) {
            return redirect()->back()->with('error', 'Wilayah dan Klasifikasi harus dipilih')->withInput();
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
            'pendidikan' => $post['pendidikan'] ?? null,
            'pengalaman' => $post['pengalaman'] ?? null,
            'status_pekerjaan' => 'open'
        ];

        $model = new LowonganModel();
        $model->insert($data);

        return redirect()->to('/dashboard')->with('success', 'Lowongan berhasil diposting');
    }
    public function edit($id)
    {
        if (session('role') != 'perusahaan') {
            return redirect()->to('/login')->with('error', 'Akses ditolak');
        }

        $model = new LowonganModel();
        $lowongan = $model->find($id);

        if (!$lowongan) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        // Verify ownership
        $perusahaan = (new \App\Models\PerusahaanModel())->where('user_id', session('id'))->first();
        if ($lowongan['perusahaan_id'] != $perusahaan['id']) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses untuk mengedit lowongan ini.');
        }

        $data = [
            'l' => $lowongan,
            'klasifikasi' => (new KlasifikasiModel())->findAll(),
            'wilayah' => (new WilayahModel())->findAll()
        ];

        return view('lowongan/edit', $data);
    }

    public function update($id)
    {
        if (session('role') != 'perusahaan') {
            return redirect()->to('/login')->with('error', 'Akses ditolak');
        }

        $model = new LowonganModel();
        $lowongan = $model->find($id);

        if (!$lowongan) {
            return redirect()->back()->with('error', 'Lowongan tidak ditemukan');
        }

        // Verify ownership
        $perusahaan = (new \App\Models\PerusahaanModel())->where('user_id', session('id'))->first();
        if ($lowongan['perusahaan_id'] != $perusahaan['id']) {
            return redirect()->back()->with('error', 'Akses ditolak');
        }

        $post = $this->request->getPost();

        $data = [
            'judul' => $post['judul'] ?? $lowongan['judul'],
            'deskripsi' => $post['deskripsi'] ?? $lowongan['deskripsi'],
            'klasifikasi_id' => $post['klasifikasi_id'] ?? $lowongan['klasifikasi_id'],
            'wilayah_id' => $post['wilayah_id'] ?? $lowongan['wilayah_id'],
            'tipe_pekerjaan' => $post['tipe_pekerjaan'] ?? $lowongan['tipe_pekerjaan'],
            'gaji_min' => $post['gaji_min'] ?? $lowongan['gaji_min'],
            'gaji_max' => $post['gaji_max'] ?? $lowongan['gaji_max'],
            'pendidikan' => $post['pendidikan'] ?? $lowongan['pendidikan'],
            'pengalaman' => $post['pengalaman'] ?? $lowongan['pengalaman'],
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $model->update($id, $data);

        return redirect()->to('/dashboard')->with('success', 'Lowongan berhasil diperbarui');
    }
}
