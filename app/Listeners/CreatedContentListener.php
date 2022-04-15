<?php

namespace App\Listeners;

use App\Events\AuditLog\AuditHandlerEvent;
use App\Events\CreatedContentEvent;
use App\Models\AuditLog;

class CreatedContentListener
{
    /**
     * Handle the event.
     *
     * @param CreatedContentEvent $event
     * @return void
     *
     */
    public function handle(CreatedContentEvent $event)
    {
        try {
            if ($event->data->id) {
                event(new AuditHandlerEvent(
                    $event->module,
                    'created',
                    $event->data->id,
                    AuditLog::getReferenceName($event->module, $event->data),
                    'info'
                ));
            }
        } catch (\Exception $exception) {
            info($exception->getMessage());
        }
    }
}
