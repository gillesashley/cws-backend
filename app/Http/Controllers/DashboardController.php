<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function index()
    {
        Log::info('Dashboard controller index method called');

        $apiToken = Session::get('api_token');

        if (!$apiToken) {
            Log::error('API token not found in session');
            return redirect()->route('login')->with('error', 'Please log in to access the dashboard.');
        }

        try {
            $response = Http::withToken($apiToken)->get(config('app.api_url') . '/analytics');

            if ($response->successful()) {
                $analyticsData = $response->json();
                return view('dashboard.index', compact('analyticsData'));
            } else {
                Log::error('Failed to fetch analytics data', ['status' => $response->status()]);
                return view('dashboard.index')->with('error', 'Failed to fetch analytics data. Please try again later.');
            }
        } catch (\Exception $e) {
            Log::error('Error fetching analytics data', ['error' => $e->getMessage()]);
            return view('dashboard.index')->with('error', 'An error occurred while fetching data. Please try again later.');
        }
    }
}
