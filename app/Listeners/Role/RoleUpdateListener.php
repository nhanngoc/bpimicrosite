<?php

namespace App\Listeners\Role;

use App\Events\Role\RoleUpdateEvent;
use Auth;

class RoleUpdateListener
{
    /**
     * Handle the event.
     *
     * @param  RoleUpdateEvent $event
     * @return void
     *
     * @throws \Exception
     */
    public function handle(RoleUpdateEvent $event)
    {
        info('Role ' . $event->role->name . ' updated; rebuilding permission sets');

        $permissions = $event->role->permissions;

        foreach ($event->role->users()->get() as $user) {
            $permissions['superuser']     = $user->super_user;
            $permissions['manage_supers'] = $user->manage_supers;

            $user->permissions = $permissions;
            $user->save();
        }

        cache()->forget(md5('cache-dashboard-menu-' . Auth::user()->getKey()));
    }
}
