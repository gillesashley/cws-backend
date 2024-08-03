<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    public function index()
    {
        Log::info('Dashboard controller index method called');

        $user = session('user');

        if (!$user) {
            Log::error('User not found in session');
            return redirect()->route('login')->with('error', 'Please log in to access the dashboard.');
        }

        // Mock analytics data
        $analyticsData = [
            'total_users' => 1000,
            'active_campaigns' => 5,
            'total_engagement' => 10000,
            'recent_activities' => [
                ['type' => 'New User', 'description' => 'John Doe joined'],
                ['type' => 'Campaign Launch', 'description' => 'Summer Initiative started'],
                ['type' => 'High Engagement', 'description' => 'Post reached 1000 views'],
            ]
        ];

        return view('dashboard.index', compact('user', 'analyticsData'));
    }

    public function campaignMonitor()
    {
        return view('dashboard.campaign-monitor');
    }
}
