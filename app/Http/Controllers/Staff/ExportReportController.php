<?php

namespace App\Http\Controllers\Staff;

use Illuminate\Http\Request;
use App\Models\Report;
use App\Exports\SingleReportExport;
use App\Http\Controllers\Controller;
use App\Exports\AllReportsExport;
use App\Exports\AllReportsExportMonth;
use App\Exports\AllReportsExportWeek;
use Maatwebsite\Excel\Facades\Excel;

class ExportReportController extends Controller
{
    public function exportAll()
    {
        return Excel::download(new AllReportsExport, 'laporan_semua.xlsx');
    }

    public function exportSingle(Report $report)
    {
        return Excel::download(new SingleReportExport($report), 'laporan_' . $report->id . '.xlsx');
    }

    public function exportLastMonth()
    {
        return Excel::download(new AllReportsExportMonth, 'laporan_bulan.xlsx');
    }

    public function exportLastWeek()
    {
        return Excel::download(new AllReportsExportWeek, 'laporan_minggu.xlsx');
    }
}
