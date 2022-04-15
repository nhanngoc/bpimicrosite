<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class APOErrorDataFromViewExport implements FromView
{

    public function __construct($data, $view)
    {
        $this->data = $data;
        $this->view = $view;
    }

    public function view(): View
    {
        return View($this->view)->with('errorData', $this->data);
    }
}
