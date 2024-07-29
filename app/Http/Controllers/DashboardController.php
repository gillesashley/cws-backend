<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    public function index()
    {
        Log::info('Dashboard controller index method called');
        // Fetch analytics data from API
        $response = Http::withToken(auth()->user()->api_token)->get(config('app.api_url') . '/analytics');

        if ($response->successful()) {
            $analyticsData = $response->json();

            return view('dashboard.index', compact('analyticsData'));
        }

        // Handle error if API request fails
        return view('dashboard.index')->with('error', 'Unable to fetch analytics data');
    }
}
