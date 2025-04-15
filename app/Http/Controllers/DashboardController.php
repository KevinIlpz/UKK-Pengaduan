<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    public function userDashboard(Request $request)
    {
        $query = Report::with(['user'])
        ->withCount('likes');

        if ($request->filled('search')) {
            $query->where('description', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        $sortOrder = $request->get('sort', 'desc');
        $query->orderBy('created_at', $sortOrder);

        $reports = $query->paginate(10)->withQueryString();

        return view('dashboard.user.user', compact('reports'));
    }


    public function headDashboard()
{
    $reportTypes = ['KEJAHATAN', 'PEMBANGUNAN', 'SOSIAL'];

    $completedReports = Report::where('status', 'SELESAI')
        ->select('type', DB::raw('count(*) as total'))
        ->groupBy('type')
        ->pluck('total', 'type');

    $uncompletedReports = Report::where('status', '!=', 'SELESAI')
        ->select('type', DB::raw('count(*) as total'))
        ->groupBy('type')
        ->pluck('total', 'type');

    foreach ($reportTypes as $type) {
        if (!isset($completedReports[$type])) {
            $completedReports[$type] = 0;
        }
        if (!isset($uncompletedReports[$type])) {
            $uncompletedReports[$type] = 0;
        }
    }

    $completedReports = collect($completedReports)->sortKeys();
    $uncompletedReports = collect($uncompletedReports)->sortKeys();

    $completedReportsByType = $completedReports;
    $uncompletedReportsByType = $uncompletedReports;

    $totalUsers = User::where('role', 'user')->count();
    $totalStaff = User::where('role', 'staff')->count();
    $totalReports = Report::count();
    $onprogressReports = Report::where('status', 'PROSES')->count();
    $complaintsPerProvince = Report::select('province', DB::raw('count(*) as total'))
        ->groupBy('province')
        ->pluck('total', 'province');

    return view('dashboard.head.head', compact(
        'totalUsers',
        'totalStaff',
        'totalReports',
        'onprogressReports',
        'complaintsPerProvince',
        'completedReportsByType',
        'uncompletedReportsByType',
        'reportTypes'
    ));
}

}
