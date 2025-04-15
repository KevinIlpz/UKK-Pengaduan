<?php

namespace App\Exports;

use App\Models\Report;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AllReportsExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Report::with('responseProgress.staff')->get();
    }


    public function map($report): array
    {
        return [
            $report->id,
            $report->description,
            $report->status,
            $report->responseProgress?->staff?->name ?? 'Belum Ditindaklanjuti',
            $report->created_at->format('Y-m-d H:i:s'),
        ];
    }

    public function headings(): array
    {
        return [
            'ID',
            'Judul',
            'Status',
            'Ditangani Oleh',
            'Tanggal Dibuat',
        ];
    }
}
