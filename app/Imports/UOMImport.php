<?php

namespace App\Imports;

use App\Models\UOM;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UOMImport implements ToModel, WithHeadingRow, SkipsEmptyRows
{
    public function headingRow(): int
    {
        return 1;
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $uom = UOM::where(['uom_code' => $row['int_meas_unit']])->first();

        if(!$uom) {
            return new UOM([
                'uom_code'         => $row['int_meas_unit'],
                'uom_text'         => $row['measurement_unit_text'],
                'description'      => $row['measurement_unit_text_description'],
                'author_id'        => \Auth::user()->id,
            ]);
        }
    }
}
