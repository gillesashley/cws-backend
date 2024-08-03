<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SupportController extends Controller
{
    public function index()
    {
        return view('support.index');
    }

    public function adminProfile()
    {
        return view('support.profile');
    }
}
