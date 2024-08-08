<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApplicationSetupController extends Controller
{
    public function  banners()
    {
        return view('application-setup.banners');
    }

    public function events()
    {
        return view('application-setup.events');
    }

    public function manifesto()
    {
        return view('application-setup.manifesto');
    }
}
