<?php

namespace App\Listeners\AuditLog;

use App\Models\AuditHistory;
use App\Models\User;
use Illuminate\Auth\Events\Login;

class LoginListener
{
    /**
     * @var mixed
     */
    public $auditHistory;

    /**
     * AuditHandlerListener constructor.
     * @param AuditHistory $auditHistory
     *
     */
    public function __construct(AuditHistory $auditHistory)
    {
        $this->auditHistory = $auditHistory;
    }

    /**
     * Handle the event.
     *
     * @param  Login $event
     * @return void
     *
     */
    public function handle(Login $event)
    {
        /**
         * @var User $user
         */
        $user = $event->user;

        if ($user instanceof User) {
            if (isset($_SERVER['HTTP_USER_AGENT'])) {
                $this->auditHistory->user_agent = $_SERVER['HTTP_USER_AGENT'];
            }

            if (isset($_SERVER['REMOTE_ADDR'])) {
                $this->auditHistory->ip_address = $_SERVER['REMOTE_ADDR'];
            }

            $this->auditHistory->module = 'to the system';
            $this->auditHistory->action = 'logged in';
            $this->auditHistory->user_id = $user->id;
            $this->auditHistory->reference_user = 0;
            $this->auditHistory->reference_id = $user->id;
            $this->auditHistory->reference_name = $user->getFullName();
            $this->auditHistory->type = 'info';

            $this->auditHistory->save();
        }
    }
}
