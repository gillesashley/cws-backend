<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class PointsAndPaymentController extends Controller
{
    public function index()
    {
        return view('points-and-payment.index');
    }

    public function viewTransactions(): View|Factory|Application
    {
        return view('points-and-payment.view-transaction');
    }
}
