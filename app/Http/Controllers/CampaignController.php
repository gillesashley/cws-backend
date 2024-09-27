<?php

namespace App\Http\Controllers;

use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CampaignController extends Controller
{
    public function index()
    {
        $response = Http::withToken(auth()->user()->api_token)->get(config('app.api_url') . '/campaign-messages');

        if ($response->successful()) {
            $campaigns = $response->json()['data'];
            return view('admin.campaigns.index', compact('campaigns'));
        }

        return back()->with('error', 'Unable to fetch campaigns');
    }

    public function create()
    {
        return view('admin.campaigns.create', ['regions' => Region::with('constituencies')->all()]);
    }

    public function store(Request $request)
    {
        $response = Http::withToken(auth()->user()->api_token)
            ->post(config('app.api_url') . '/campaign-messages', $request->all());

        if ($response->successful()) {
            return redirect()->route('admin.campaigns.index')->with('success', 'Campaign created successfully');
        }

        return back()->withInput()->with('error', 'Failed to create campaign');
    }

    public function show($id)
    {
        $response = Http::withToken(auth()->user()->api_token)->get(config('app.api_url') . '/campaign-messages/' . $id);

        if ($response->successful()) {
            $campaign = $response->json()['data'];
            return view('admin.campaigns.show', compact('campaign'));
        }

        return back()->with('error', 'Campaign not found');
    }

    public function edit($id)
    {
        $response = Http::withToken(auth()->user()->api_token)->get(config('app.api_url') . '/campaign-messages/' . $id);

        if ($response->successful()) {
            $campaign = $response->json()['data'];
            return view('admin.campaigns.edit', compact('campaign'));
        }

        return back()->with('error', 'Campaign not found');
    }

    public function update(Request $request, $id)
    {
        $response = Http::withToken(auth()->user()->api_token)
            ->put(config('app.api_url') . '/campaign-messages/' . $id, $request->all());

        if ($response->successful()) {
            return redirect()->route('admin.campaigns.index')->with('success', 'Campaign updated successfully');
        }

        return back()->withInput()->with('error', 'Failed to update campaign');
    }

    public function destroy($id)
    {
        $response = Http::withToken(auth()->user()->api_token)->delete(config('app.api_url') . '/campaign-messages/' . $id);

        if ($response->successful()) {
            return redirect()->route('admin.campaigns.index')->with('success', 'Campaign deleted successfully');
        }

        return back()->with('error', 'Failed to delete campaign');
    }
}
