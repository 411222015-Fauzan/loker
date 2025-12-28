<?php

namespace App\Controllers;

class Page extends BaseController
{
    public function about()
    {
        return view('pages/about');
    }

    public function contact()
    {
        return view('pages/contact');
    }
}
