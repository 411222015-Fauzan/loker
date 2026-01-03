<?php

namespace App\Controllers;

use App\Models\LamaranModel;

class Perusahaan extends BaseController
{
    public function lamaranMasuk()
    {
        $data['lamaran'] = (new LamaranModel())
            ->select('lamaran_pekerjaan.*, users.email, lowongan_pekerjaan.judul')
            ->join('users','users.id=lamaran_pekerjaan.pelamar_id')
            ->join('lowongan_pekerjaan','lowongan_pekerjaan.id=lamaran_pekerjaan.lowongan_id')
            ->findAll();

        return view('perusahaan/lamaran', $data);
    }

    public function review($id)
    {
        (new LamaranModel())->update($id, ['status_review' => 'reviewed']);
        return redirect()->back()->with('success','Lamaran ditandai reviewed');
    }

    // Show company profile form
    public function profile()
    {
        $model = new \App\Models\PerusahaanModel();
        $profile = $model->where('user_id', session('id'))->first();

        return view('perusahaan/profile', ['profile' => $profile]);
    }

    // Save company profile
    public function save()
    {
        $m = new \App\Models\PerusahaanModel();
        $post = $this->request->getPost();

        $data = [
            'user_id' => session('id'),
            'nama_perusahaan' => $post['nama_perusahaan'] ?? null,
            'no_telp' => $post['no_telp'] ?? null,
            'bidang' => $post['bidang'] ?? null,
            'deskripsi' => $post['deskripsi'] ?? null,
            'alamat' => $post['alamat'] ?? null,
            'wilayah_id' => $post['wilayah_id'] ?? null,
            'website' => $post['website'] ?? null
        ];

        $existing = $m->where('user_id', session('id'))->first();
        if ($existing) {
            $m->update($existing['id'], $data);
        } else {
            $m->insert($data);
        }

        return redirect()->to('/dashboard')->with('success', 'Profil perusahaan tersimpan');
    }

    public function closeLowongan($id)
    {
        $model = new \App\Models\LowonganModel();
        $l = $model->find($id);
        if (!$l || $l['perusahaan_id'] != (new \App\Models\PerusahaanModel())->where('user_id', session('id'))->first()['id']) {
            return redirect()->back()->with('error', 'Akses ditolak');
        }

        $model->update($id, ['status_pekerjaan' => 'closed']);
        return redirect()->back()->with('success', 'Lowongan ditutup');
    }

    public function changePassword()
    {
        $post = $this->request->getPost();
        $old_password = $post['old_password'] ?? '';
        $new_password = $post['new_password'] ?? '';
        $confirm_password = $post['confirm_password'] ?? '';

        // Validate inputs
        if (!$old_password || !$new_password || !$confirm_password) {
            return redirect()->back()->with('error', 'Semua field password harus diisi');
        }

        if ($new_password !== $confirm_password) {
            return redirect()->back()->with('error', 'Password baru dan konfirmasi tidak cocok');
        }

        if (strlen($new_password) < 6) {
            return redirect()->back()->with('error', 'Password baru minimal 6 karakter');
        }

        // Fetch user from database
        $userModel = new \App\Models\UserModel();
        $user = $userModel->find(session('id'));

        if (!$user) {
            return redirect()->back()->with('error', 'User tidak ditemukan');
        }

        // Verify old password
        if (!password_verify($old_password, $user['password'])) {
            return redirect()->back()->with('error', 'Password lama tidak sesuai');
        }

        // Update password
        $userModel->update(session('id'), [
            'password' => password_hash($new_password, PASSWORD_BCRYPT)
        ]);

        return redirect()->to('/perusahaan/profile')->with('success', 'Password berhasil diubah');
    }
}
