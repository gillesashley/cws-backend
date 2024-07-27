<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WithdrawalController extends Controller
{
    public function index()
    {
        $response = Http::withToken(auth()->user()->api_token)->get(config('app.api_url') . '/reward-withdrawals');

        if ($response->successful()) {
            $withdrawals = $response->json()['data'];
            return view('admin.withdrawals.index', compact('withdrawals'));
        }

        return back()->with('error', 'Unable to fetch withdrawal requests');
    }

    public function show($id)
    {
        $response = Http::withToken(auth()->user()->api_token)->get(config('app.api_url') . '/reward-withdrawals/' . $id);

        if ($response->successful()) {
            $withdrawal = $response->json()['data'];
            return view('admin.withdrawals.show', compact('withdrawal'));
        }

        return back()->with('error', 'Withdrawal request not found');
    }

    public function update(Request $request, $id)
    {
        $response = Http::withToken(auth()->user()->api_token)
            ->put(config('app.api_url') . '/reward-withdrawals/' . $id, $request->all());

        if ($response->successful()) {
            return redirect()->route('admin.withdrawals.index')->with('success', 'Withdrawal request updated successfully');
        }

        return back()->withInput()->with('error', 'Failed to update withdrawal request');
    }
}
