<?php

namespace App\Exports;

use App\Models\Report;
use Maatwebsite\Excel\Concerns\FromCollection;
use Carbon\Carbon;

class AllReportsExportWeek implements FromCollection
{
    /**
     * Mengembalikan data laporan dari 1 minggu terakhir.
     */
    public function collection()
    {
        $startDate = Carbon::now()->subWeek();
        return Report::where('created_at', '>=', $startDate)->get();
    }
}
