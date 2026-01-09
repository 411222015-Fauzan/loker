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
    public function lamaran()
    {
        // History Lamaran
        $lamaran = (new \App\Models\LamaranModel())
            ->select('lamaran_pekerjaan.*, lowongan_pekerjaan.judul, perusahaan_profiles.nama_perusahaan, perusahaan_profiles.logo')
            ->join('lowongan_pekerjaan', 'lowongan_pekerjaan.id = lamaran_pekerjaan.lowongan_id')
            ->join('perusahaan_profiles', 'perusahaan_profiles.id = lowongan_pekerjaan.perusahaan_id')
            ->where('lamaran_pekerjaan.pelamar_id', session('id'))
            ->orderBy('lamaran_pekerjaan.created_at', 'DESC')
            ->findAll();

        return view('pelamar/lamaran', ['lamaran' => $lamaran]);
    }

    public function saved()
    {
        $saved = (new \App\Models\SavedJobModel())->getSavedJobs(session('id'));
        return view('pelamar/saved', ['saved' => $saved]);
    }

    public function saveJob($lowonganId)
    {
        $model = new \App\Models\SavedJobModel();
        
        // Check if already saved
        $exists = $model->where('user_id', session('id'))
                        ->where('lowongan_id', $lowonganId)
                        ->first();
        
        if (!$exists) {
            $model->insert([
                'user_id' => session('id'),
                'lowongan_id' => $lowonganId
            ]);
            return redirect()->back()->with('success', 'Lowongan berhasil disimpan');
        }

        return redirect()->back()->with('info', 'Lowongan sudah ada di daftar simpan');
    }

    public function deleteSavedJob($id)
    {
        $model = new \App\Models\SavedJobModel();
        $job = $model->find($id);

        if ($job && $job['user_id'] == session('id')) {
            $model->delete($id);
            return redirect()->back()->with('success', 'Lowongan dihapus dari daftar simpan');
        }

        return redirect()->back()->with('error', 'Gagal menghapus lowongan');
    }

    public function apply($lowonganId)
    {
        // Reusing existing logic or standardizing call? 
        // Assuming there is already an apply method or creating one if missing.
        // Wait, the detail view POSTs to /pelamar/apply/{id}. Let's check Routes or implement it here if missing.
        
        $file = $this->request->getFile('cv');
        if (!$file->isValid()) {
            return redirect()->back()->with('error', 'File CV tidak valid');
        }

        $name = $file->getRandomName();
        $file->move(FCPATH . 'uploads/cv', $name);

        (new \App\Models\LamaranModel())->insert([
            'pelamar_id' => session('id'),
            'lowongan_id' => $lowonganId,
            'cv_file' => $name,
            'status_review' => 'pending'
        ]);

        return redirect()->back()->with('success', 'Lamaran berhasil dikirim!');
    }
}
