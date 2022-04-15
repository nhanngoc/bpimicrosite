<?php

namespace App\Listeners;

use App\Events\AuditLog\AuditHandlerEvent;
use App\Events\UpdatedContentEvent;
use AuditLog;
use Exception;

class UpdatedContentListener
{

    /**
     * Handle the event.
     *
     * @param UpdatedContentEvent $event
     * @return void
     *
     */
    public function handle(UpdatedContentEvent $event)
    {
        try {
            if ($event->data->id) {
                event(new AuditHandlerEvent(
                    $event->module,
                    'updated',
                    $event->data->id,
                    AuditLog::getReferenceName($event->module, $event->data),
                    'primary'
                ));
            }
        } catch (Exception $exception) {
            info($exception->getMessage());
        }
    }
}
