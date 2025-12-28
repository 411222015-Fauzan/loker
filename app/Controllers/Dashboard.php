<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function index()
    {
        if (session('role') == 'perusahaan') {
            return view('dashboard/perusahaan');
        }
        return view('dashboard/pelamar');
    }
}
