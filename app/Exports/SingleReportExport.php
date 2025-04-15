<?php

// app/Exports/SingleReportExport.php

namespace App\Exports;

use App\Models\Report;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SingleReportExport implements FromArray, WithHeadings
{
    protected $report;

    public function __construct(Report $report)
    {
        $this->report = $report->load('user', 'responseProgress.staff'); 
    }

    public function array(): array
    {
        return [
            [
                $this->report->id,
                $this->report->description,
                $this->report->status,
                $this->report->user?->name ?? 'Tidak diketahui',
                $this->report->responseProgress?->staff?->name ?? 'Tidak Ditindaklanjuti',
                $this->report->created_at->format('Y-m-d H:i:s'),
            ]
        ];
    }

    public function headings(): array
    {
        return [
            'ID',
            'Judul',
            'Status',
            'Pelapor',
            'Ditangani Oleh',
            'Tanggal Dibuat',
        ];
    }
}
