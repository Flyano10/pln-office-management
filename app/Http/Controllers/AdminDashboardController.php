<?php

namespace App\Http\Controllers;

use App\Models\PlnOffice;
use App\Models\User;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalOffices = PlnOffice::count();
        $totalUsers = User::where('role', 'user')->count();
        $officesByType = PlnOffice::selectRaw('office_type, count(*) as count')
            ->groupBy('office_type')
            ->get();
        $recentOffices = PlnOffice::latest()->limit(5)->get();

        return view('admin.dashboard', compact('totalOffices', 'totalUsers', 'officesByType', 'recentOffices'));
    }
}
