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
}
