<?php

namespace App\Listeners;

use App\Events\AuditLog\AuditHandlerEvent;
use App\Events\DeletedContentEvent;
use AuditLog;
use Exception;

class DeletedContentListener
{

    /**
     * Handle the event.
     *
     * @param DeletedContentEvent $event
     * @return void
     *
     */
    public function handle(DeletedContentEvent $event)
    {
        try {
            if ($event->data->id) {
                event(new AuditHandlerEvent(
                    $event->module,
                    'deleted',
                    $event->data->id,
                    AuditLog::getReferenceName($event->module, $event->data),
                    'danger'
                ));
            }
        } catch (Exception $exception) {
            info($exception->getMessage());
        }
    }
}
