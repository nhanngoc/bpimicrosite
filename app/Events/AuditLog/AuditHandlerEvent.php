<?php

namespace App\Events\AuditLog;

use App\Events\Event;
use Auth;
use Illuminate\Queue\SerializesModels;

class AuditHandlerEvent extends Event
{
    use SerializesModels;

    /**
     * @var mixed
     */
    public $module;

    /**
     * @var mixed
     */
    public $action;

    /**
     * @var mixed
     */
    public $referenceId;

    /**
     * @var mixed
     */
    public $referenceUser;

    /**
     * @var string
     */
    public $referenceName;

    /**
     * @var string
     */
    public $type;

    /**
     * AuditHandlerEvent constructor.
     * @param string $module
     * @param string $action
     * @param int $reference_id
     * @param null $reference_name
     * @param string $type
     * @param int $reference_user
     */
    public function __construct($module, $action, $reference_id, $reference_name, $type, $reference_user = 0)
    {

        if ($reference_user === 0 && Auth::check()) {
            $reference_user = Auth::user()->getKey();
        }
        $this->module = $module;
        $this->action = $action;
        $this->referenceUser = $reference_user;
        $this->referenceId = $reference_id;
        $this->referenceName = $reference_name;
        $this->type = $type;
    }
}
