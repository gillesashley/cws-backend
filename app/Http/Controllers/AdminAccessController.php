<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminAccessController extends Controller
{
    public function index()
    {
        return view('admin.access-control.index');
    }
}
