<?php

namespace App\Controllers;

use App\Models\PelamarModel;

class Pelamar extends BaseController
{
    public function profile()
    {
        $m = new PelamarModel();
        $profile = $m->where('user_id', session('id'))->first();

        return view('pelamar/profile', ['profile' => $profile]);
    }

    public function save()
    {
        $m = new PelamarModel();
        $post = $this->request->getPost();
        $data = [
            'user_id' => session('id'),
            'nama_lengkap' => $post['nama_lengkap'] ?? null,
            'no_hp' => $post['no_hp'] ?? null,
            'alamat' => $post['alamat'] ?? null,
        ];

        // handle foto upload
        $foto = $this->request->getFile('foto');
        if ($foto && $foto->isValid() && !$foto->hasMoved()) {
            $name = $foto->getRandomName();
            $foto->move(WRITEPATH . 'uploads', $name);
            $data['foto'] = $name;
        }

        $existing = $m->where('user_id', session('id'))->first();
        if ($existing) {
            $m->update($existing['id'], $data);
        } else {
            $m->insert($data);
        }

        return redirect()->to('/dashboard')->with('success', 'Profil pelamar tersimpan');
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

        return redirect()->to('/pelamar/profile')->with('success', 'Password berhasil diubah');
    }
}
