<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GeoLocationController extends Controller
{
    public function index()
    {
        return view('geo-location.index');
    }
}
