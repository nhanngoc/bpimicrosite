<?php

namespace App\Events;

use Illuminate\Http\Request;
use Illuminate\Queue\SerializesModels;

class UpdatedContentEvent extends Event
{
    use SerializesModels;

    /**
     * @var string
     */
    public $module;

    /**
     * @var Request
     */
    public $request;

    /**
     * @var \Eloquent|false
     */
    public $data;

    /**
     * CreatedContentEvent constructor.
     *
     * @param string $module
     * @param Request $request
     * @param \Eloquent|false|\stdClass $data
     */
    public function __construct($module, $request, $data)
    {
        $this->module = $module;
        $this->request = $request;
        $this->data = $data;
    }
}
