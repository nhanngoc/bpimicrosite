<?php

namespace App\Listeners\ACL;

use App\Events\ACL\RoleAssignmentEvent;
use Auth;
class RoleAssignmentListener
{

    /**
     * Handle the event.
     *
     * @param  RoleAssignmentEvent $event
     * @return void
     *
     * @throws \Exception
     */
    public function handle(RoleAssignmentEvent $event)
    {
        info('Role ' . $event->role->name . ' assigned to user ' . $event->user->getFullName());
        $permissions = $event->role->permissions;
        $permissions['superuser']     = $event->user->super_user;
        $permissions['manage_supers'] = $event->user->manage_supers;

        $event->user->permissions = $permissions;
        $event->user->save();
    }
}
