<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class NonApprovePurchaseOrderImport implements ToCollection, WithHeadingRow, SkipsEmptyRows
{
    protected $purchase_order;

    public function headingRow(): int
    {
        return 1;
    }

    public function collection(Collection $rows)
    {
        return $rows;
    }
}
