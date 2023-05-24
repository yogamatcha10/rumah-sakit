<?php

namespace App\Exports;

use App\Models\Position;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportPositions implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Position::all();
    }
    public function headings(): array
    {
        return ["ID", "NAMA", "KETERANGAN", "SINKATAN", "DIBUAT", "DIUBAH"];
    }
}
