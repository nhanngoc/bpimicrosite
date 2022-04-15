<?php

namespace App\Imports;

use App\Models\PortCode;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PortCodeImport implements ToModel, WithHeadingRow, SkipsEmptyRows
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
        
        set_time_limit(0);
        $port_code = PortCode::where(['port_code' => $row['polpod']])->first();
        if(!$port_code) {
            return new PortCode([
                'port_code'         => $row['polpod'],
                'description'       => $row['port_name'],
                'author_id'         => \Auth::user()->id,
            ]);
        }
    }
}
