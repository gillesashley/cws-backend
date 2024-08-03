<?php

namespace App\Http\Controllers;

use App\Models\Constituency;
use App\Models\Region;
use Illuminate\Http\Request;

class GeoLocationController extends Controller
{
    public function index()
    {
        $regions = Region::all();
        $constituencies = Constituency::with('region')->get();
        return view('geo-location.index', compact('regions', 'constituencies'));
    }
}
