<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    public function headDashboard()
    {
        $totalUsers = User::where('role', 'user')->count();
        $totalStaff = User::where('role', 'staff')->count();
        $totalReports = Report::count();
        $pendingReports = Report::where('status', 'PROSES')->count();

        $complaintsPerProvince = Report::select('province', DB::raw('count(*) as total'))
            ->groupBy('province')
            ->pluck('total', 'province');

        return view('dashboard.head.head', compact(
            'totalUsers',
            'totalStaff',
            'totalReports',
            'pendingReports',
            'complaintsPerProvince'
        ));
    }
}
