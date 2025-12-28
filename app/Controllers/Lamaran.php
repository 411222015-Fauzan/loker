<?php

namespace App\Controllers;

use App\Models\LamaranModel;

class Lamaran extends BaseController
{
    public function apply($lowongan_id)
    {
        $cv = $this->request->getFile('cv');
        $cvName = $cv->getRandomName();
        $cv->move('uploads/cv', $cvName);

        (new LamaranModel())->insert([
            'lowongan_id' => $lowongan_id,
            'pelamar_id' => session('id'),
            'cv_file' => $cvName
        ]);

        return redirect()->back()->with('success','Lamaran berhasil dikirim');
    }
}
