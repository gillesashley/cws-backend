<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WithdrawalController extends Controller
{
    public function index(): View|Application|Factory|RedirectResponse
    {
        try {
            $token = session('token');

            if (!$token) {
                throw new Exception('No API token available');
            }

            $url = config('app.api_url') . '/reward-withdrawals?include=user.constituency&' . implode('&', ["page=" . request()->input('page', 1), 'withPath=/admin/view-transactions']);

            $response = Http::withToken($token)->get($url);

            if ($response->successful()) {
                $withdrawals = $response->json('data', []);

                if (!is_array($withdrawals)) {
                    throw new Exception('Unexpected response format');
                }

                $meta = $response->json('meta', []);

                return view('points-and-payment.view-transaction', compact('withdrawals', 'meta'));
            } else {
                throw new Exception('API request failed: ' . $response->body());
            }
        } catch (Exception $e) {
            Log::error('Error in WithdrawalController@index: ' . $e->getMessage());
            return back()
                ->withException($e)
                ->with('error', 'An error occurred while fetching withdrawal requests. Please try again later.');
        }
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
        $status = $request->input('status');
        $rejectionReason = $request->input('rejection_reason');

        $response = Http::withToken($request->user()->api_token)
            ->put(config('app.api_url') . '/reward-withdrawals/' . $id, [
                'status' => $status,
                'rejection_reason' => $rejectionReason
            ]);

        if ($response->successful()) {
            $message = $status === 'approved' ? 'Withdrawal request approved successfully' : 'Withdrawal request declined successfully';
            return redirect()->route('admin.withdrawals.index')->with('success', $message);
        }

        $ex = $response->toException();
        Log::info($response->reason());
        debug($ex);
        return back()->withInput()->with('error', 'Failed to update withdrawal request')->with(
            'error',
            $response->reason()
        );
    }
}
