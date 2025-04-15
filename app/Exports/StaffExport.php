<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StaffExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return User::where('role', 'staff')
            ->select('id', 'name', 'email', 'created_at')
            ->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nama',
            'Email',
            'Dibuat pada',
        ];
    }
}
