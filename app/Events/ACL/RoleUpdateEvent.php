<?php

namespace App\Events\ACL;


use App\Events\Event;
use App\Models\Role;
use Illuminate\Queue\SerializesModels;

class RoleUpdateEvent extends Event
{
    use SerializesModels;

    /**
     * @var Role
     */
    public $role;

    /**
     * RoleUpdateEvent constructor.
     *
     * @param Role $role
     */
    public function __construct(Role $role)
    {
        $this->role = $role;
    }
}
