<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class NPOErrorDataFromViewExport implements FromView
{
    /**
     * @param array|collect $data
     * @param string $view //view name
     */
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
