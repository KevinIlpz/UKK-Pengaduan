<?php

namespace App\Exports;

use App\Models\Report;
use Maatwebsite\Excel\Concerns\FromCollection;
use Carbon\Carbon;

class AllReportsExportMonth implements FromCollection
{
    public function collection()
    {
        $startDate = Carbon::now()->subMonth();
        return Report::where('created_at', '>=', $startDate)->get();
    }
}

