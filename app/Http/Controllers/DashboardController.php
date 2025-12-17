<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SparePart;
use App\Models\Service;
use App\Models\Transaction;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $stats = [
            'categories' => Category::count(),
            'spare_parts' => SparePart::count(),
            'services' => Service::count(),
            'transactions' => Transaction::whereDate('created_at', today())->count(),
        ];

        return view('dashboard', compact('stats'));
    }
}
