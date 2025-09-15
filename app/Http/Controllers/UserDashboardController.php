<?php

namespace App\Http\Controllers;

use App\Models\PlnOffice;
use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
    public function index()
    {
        $totalOffices = PlnOffice::count();
        $officesByType = PlnOffice::selectRaw('office_type, count(*) as count')
            ->groupBy('office_type')
            ->get();
        $recentOffices = PlnOffice::latest()->limit(5)->get();

        return view('user.dashboard', compact('totalOffices', 'officesByType', 'recentOffices'));
    }
}
