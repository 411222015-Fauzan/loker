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
}
